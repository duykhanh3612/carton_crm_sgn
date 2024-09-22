<?php

namespace Modules\Api\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Admin\Model\Modules;
use App\Model\base_model;
use DB;

class CoreController extends BaseController
{
    public function getCore()
    {
        $page = request()->segment(2);
        $module = Modules::where("file", $page)->first();

        $table = $module->prefix ?? $module->file;
        $query_select = $module->columns != "" ? "id," . $module->columns : "*";

        if (empty($this->model[$table])) {
            $where  = '1=1';

            $search = Modules::search_where(['keywords' => request('keywords')], $where, $module->columns);
            $where  = $search['where'];
            if (request('deleted')) {
                $where .= " and (deleted=1)";
            } else {
                if ($module->soft_delete) {
                    $where .= " and (deleted=0 or deleted is null)";
                }
            }
            if (request('show_all')) {
                $records = base_model::find_all($table,  $where);
            } else {
                $records = base_model::paging($table,  $where, "id desc", 20, null, $query_select);
            }
        } else {
            $query = new $this->model[$table];
            if (method_exists($query, 'scopeSearch')) {
                $query = $query->search(request()->toArray());
            }
            if (request('deleted')) {
                $query = $query->whereRaw("($table.deleted=1)");
            } else {
                if ($module->soft_delete) {
                    $query = $query->whereRaw("($table.deleted=0 or $table.deleted is null)");
                }
            }
            $query = $query->selectRaw($query_select)->orderBy("id", "desc");
            if (request('show_all')) {
                $records =  $query->get();
            } else $records =  $query->paginate(20);
        }
        $records->transform(function ($item) {
            if (isset($item->image)) {
                $item->image = url(image_path($item->image));
            }
            if (isset($item->gallery)) {
                $galleries = json_decode($item->gallery, true);
                foreach ($galleries as &$gallery) {
                    if (isset($gallery['image'])) {
                        $gallery['image'] = url(image_path($gallery['image']));
                    }
                }
                $item->gallery = $galleries;
            }
            if (method_exists($item, 'transformData')) {
                $item->transformData($item);
            }
            return $item;
        });
        $result['data'] = $records;
        $result['code'] = 200;
        $result['success'] = true;
        if (!empty($this->model[$table])) {
            $query = new $this->model[$table];
            if (method_exists($query, 'getOptions')) {
                $result['options'] = $query->getOptions($records);
            }
        }

        return response()->json($result, 200, ['Content-type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }
    public function getCoreDetail($slug, &$data = null)
    {

        if ($slug == "null" || $slug == ""  || $slug == null) {
            $result = [
                'data' => [],
                'message' => "Empty"
            ];
            return response()->json($result, 200, ['Content-type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }
        $options = [];
        $page = request()->segment(2);
        $module = Modules::where("file", $page)->first();
        $table = $module->prefix ?? $module->file;
        $query_select =  $module->column_info != "" ? "id," . $module->column_info : "*";
        if (empty($this->model[$table])) {
            if (is_numeric($slug)) {
                $records = !empty($slug) ? base_model::find($table, "id = '$slug'", null, $query_select) : [];
            } else {
                $records = !empty($slug) ? base_model::find($table, "slug = '$slug'", null, $query_select) : [];
            }
        } else {
            $query = new $this->model[$table];
            $records = $query->selectRaw($query_select)->where(is_numeric($slug) ? "id" : "slug", $slug)->first();
            if (method_exists($query, 'getOptions')) {
                $result['options'] = $query->getOptions($options, $records);
            }
        }
        if (isset($records->image)) {
            $records->image = url(image_path($records->image));
        }
        if (isset($records->gallery)) {
            $galleries = json_decode($records->gallery, true);
            foreach ($galleries as &$gallery) {
                if (isset($gallery['image'])) {
                    $gallery['image'] = url(image_path($gallery['image']));
                }
            }
            $records->gallery = $galleries;
        }

        if (!empty($records)) {
            if (method_exists($records, 'transformData')) {
                $records->transformData($records);
            }
            if (method_exists($records, 'itemsData')) {
                $records->itemsData($records);
            }
        }

        get_response_code(true, response_bad_request, $result);
        $result['data'] = $records;
        if (!empty($options)) {
            $result['options'] = $options;
        }
        $data = $records;
        return response()->json($result, 200, ['Content-type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }
    public function printCore($slug)
    {
        if ($slug == "null" || $slug == ""  || $slug == null) {
            $result = [
                'data' => [],
                'message' => "Empty"
            ];
            return response()->json($result, 200, ['Content-type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }
        $page = request()->segment(2);
        $data = [];
        $this->getCoreDetail($slug, $data);

        $result['data'] = view("api::print." . $page, ['record' => $data])->render();
        return response()->json($result, 200, ['Content-type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
        // return view("api::print.".$page, ['record'=>$data]);
    }
    public function exportCore()
    {
        $page = request()->segment(2);
        $module = Modules::where("file", $page)->first();
        $table = $module->prefix ?? $module->file;
        $data = [];
        // $this->getCoreDetail($slug, $data);
        $query = new $this->model[$table];
        $data['items'] = $query->getItems(request('ids'));
        if(request('view'))
        {
            return view("api::print." . $page, $data);
        }
        $result['data'] = view("api::print." . $page,$data)->render();
        return response()->json($result, 200, ['Content-type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
        // return view("api::print.".$page, ['record'=>$data]);
    }
    public function getCorePart($slug = "")
    {
        $options = [];
        $page = request()->segment(2);
        $module = Modules::where("file", $page)->first();

        $table = $module->prefix ?? $module->file;
        $query_select =  $module->column_info != "" ? "id," . $module->column_info : "*";
        if (empty($this->model[$table])) {
            $where = '1=1';
            $search = Modules::search_where(['keywords' => request('keywords')], $where, $module->columns);
            $where  = $search['where'];
            $records = base_model::paging($table,  $where, null, 20, null, $query_select);
        } else {
            $where = '1=1';
            $search = Modules::search_where(['keywords' => request('keywords')], $where, $module->columns);
            $where  = $search['where'];
            $records = base_model::paging($table,  $where, null, 20, null, $query_select);
            $query = new $this->model[$table];
            $records->transform(function ($item) use ($query) {
                $arr = (array)$item;
                if (method_exists($query, 'transformDataPart')) {
                    $query->transformDataPart($arr);
                }
                return $arr;
            });
        }
        if (isset($records->image)) {
            $records->image = url(image_path($records->image));
        }
        if (isset($records->gallery)) {
            $galleries = json_decode($records->gallery, true);
            foreach ($galleries as &$gallery) {
                if (isset($gallery['image'])) {
                    $gallery['image'] = url(image_path($gallery['image']));
                }
            }
            $records->gallery = $galleries;
        }


        get_response_code(true, response_bad_request, $result);
        $result['data'] = $records;
        if (!empty($options)) {
            $result['options'] = $options['option'];
        }

        return response()->json($result, 200, ['Content-type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }
    public function getCoreUpdate($id = "")
    {
        $page = request()->segment(2);
        $module = Modules::where("file", $page)->first();
        $table = $module->prefix ?? $module->file;
        $query_select =  $module->column_info != "" ? "id," . $module->column_info : "*";

        if ($id == "") {
            $id = request("id");
        }

        $doc = request()->toArray();
        if(!$module->app_debug)
        {
            log_write($doc,"Core::Update::DATA","","start");
        }

        if (count(request()->files) > 0) {
            $data_image =  $this->upload(request()->files, "upload/news");

            if ($data_image) {
                foreach ($data_image as $key => $path) {
                    $doc[$key] = $path;
                }
            }
        }
        if ($id == null) {
            $doc["created_by"] = @auth()->user()->id;
        }

        unset($doc['token']);

        $fields = DB::connection()->getSchemaBuilder()->getColumnListing($table);
        foreach ($doc as $key => $value) {
            if (array_search($key, $fields) === false) {
                unset($doc[$key]);
            }
        }

        foreach ($doc as $k => $v) {
            if (is_array($v)) {
                $doc[$k] = json_encode($v);
            }
        }
        if (empty($this->model[$table])) {
            $doc = base_model::save_data($table, $doc, @$id);
            $records = base_model::find($table, "id='" . $doc . "'", null, $query_select);
        } else {
            $query = $this->model[$module->file];
            $doc = $query::updateOrCreate(['id' => $id], $doc);
            $query = new $this->model[$table];
            $records = $query->selectRaw($query_select)->where("id",  $doc->id)->first();
            if (method_exists($records, 'transformData')) {
                $records->transformData($records);
            }
            if (method_exists($records, 'itemsData')) {
                $records->itemsData($records);
            }
        }

        get_response_code(true, response_bad_request, $result);
        $result['data'] = $records;
        if (!empty($options)) {
            $result['options'] = $options;
        }

        if(!$module->app_debug)
        {
            log_write($result,"Core::Update::RESULT","","end");
        }
        return response()->json($result, 200, ['Content-type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }
    public function getCoreUpdateItem(Request $request, $id = "")
    {
        try {
            $page = request()->segment(2);
            $module = Modules::where("file", $page)->first();
            $table = $module->prefix ?? $module->file;
            $query_select =  $module->column_info != "" ? "id," . $module->column_info : "*";

            if (request('id') != "") {
                $id = request('id');
            }
            $doc = request()->toArray();

            // if (count(request()->files) > 0) {

            //     $data_image =  upload(request()->files, "upload/payment_request");

            //     if ($data_image) {
            //         foreach ($data_image as $key => $path) {
            //             $doc[$key] = $path;
            //         }
            //     }
            // }

            if (request("documents")) {
                $docs = [];
                $documents = request("documents");
                // if(!is_array($documents) && $documents!= "")
                // {
                //     $documents = json_decode($documents, true);
                // }
                foreach ($documents as $k => $d) {
                    // if (!empty($_FILES['documents']['name'][$k]['file'])) {
                    //     $fileName = time();//url_title(viet_decode($d['filename']), '-', true) . time();
                    //     $info = pathinfo($_FILES['documents']['name'][$k]['file']);
                    //     $ext =   $info['extension'];
                    //     $filePath = "public/upload/payment_request/" . $fileName . ".".$ext;

                    //     if(@move_uploaded_file($_FILES['documents']['tmp_name'][$k]['file'], $filePath)) {
                    //         $d['path_file'] = $filePath;
                    //         $d['ext'] = $ext;
                    //         $d['url'] = $filePath;
                    //         $d['url_preview'] = $filePath;
                    //     }
                    //     unset($d['file']);
                    // }
                    // dd(request()->file("documents")[0]['file']->getClientOriginalName());
                    if (!empty(request()->file("documents")[$k]['file'])) {
                        $d['path_file'] = upload_file(request()->file("documents")[$k]['file'], "upload/payment_request");
                    }
                    // if($d['deleted'])
                    // {
                    //     $d['path_file'] = "";
                    // }
                    $docs[] = $d;
                }
                $doc['documents'] = json_encode($docs);
            }

            $fields = DB::connection()->getSchemaBuilder()->getColumnListing($table);
            foreach ($doc as $key => $value) {
                if (array_search($key, $fields) === false) {
                    unset($doc[$key]);
                } else {
                    if (is_array($value)) {
                        $doc[$key] = json_encode($value);
                    }
                }
            }
            $items = $request->items ?? $request->details;
            if (empty($this->model[$table])) {
                // if (is_numeric($slug)) {
                //     $records = !empty($slug) ? base_model::find($table, "id = '$slug'", null, $query_select) : [];
                // } else {
                //     $records = !empty($slug) ? base_model::find($table, "slug = '$slug'", null, $query_select) : [];
                // }
            } else {
                $query = new $this->model[$table];
                $info =  $query::updateOrCreate(['id' => $id], $doc);
                $query::updateDetail($items, $info->id);

                // $records = $query->selectRaw($query_select)->where("id", $info->id)->first();
                // if (method_exists($records, 'itemsData')) {
                //     $records->itemsData($records);
                // }
            }

            $result['data'] =  $records ?? [];
            $result['code'] = 200;
            $result['success'] = true;
            return response()->json($result, 200, ['Content-type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
        } catch (\Throwable $e) {
            log_write_exception($e, "Api::getCoreUpdateItem");
            log_write($doc ?? [], "Api::Data");
            $result['code'] = 201;
            $result['data'] = $doc;
            $result['message'] = getThrowable($e);
            $result['success'] = false;
            return response()->json($result, 200, ['Content-type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }
    }
    public function deleteCore()
    {
        $page = request()->segment(2);
        $module = Modules::where("file", $page)->first();
        $table = $module->prefix ?? $module->file;
        $id = request("id");

        if (empty($this->model[$table])) {
            if ($module->soft_delete && !empty(request('deleted'))) {
                $records = base_model::remove($table, $id);
            } else {
                $records = base_model::save_data($table, ['deleted' => 1], $id);
            }
        } else {
            $model = $this->model[$module->file];

            if ($module->soft_delete && !empty(request('deleted'))) {
                $model::where('id', $id)->first()->delete();
            } else {
                $model::where('id', $id)->update(['deleted' => 1]);
            }
        }

        $result['code'] = 200;
        $result['success'] = true;
        return response()->json($result, 200, ['Content-type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }
}
