<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\FnModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Admin\Model\Pages;
use Modules\Admin\Model\Modules;
use Modules\Admin\Model\Struct;
use Modules\Admin\Model\PremaLink;
use App\Model\base_model;

class CoreController extends BaseController
{
    public $model = [
        'customer' => \Modules\Admin\Model\Customer::class,
        // 'product' => \Modules\Api\Model\Product::class,
        'product_category' => \Modules\Admin\Model\Product\ProductCategory::class,
        // 'profile' => \Modules\Api\Model\Users::class,
        // 'suppliers' => \Modules\Api\Model\Suppliers::class,
        'pages' => \Modules\Admin\Model\Pages::class,
        'users' => \Modules\Admin\Model\Users::class,
        'groups' => \Modules\Admin\Model\Groups::class,
    ];
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        $data['filter'] = $request->filter;
        $data['module'] = $this->module;
        $data['fields'] = $this->fn->module_fields($this->module->prefix ?? $this->module->file);
        $data['cols'] = json_decode($this->module->column_options);
        if (!$data['cols']) {
            $data['cols'] = $data['fields'];
        }
        $data['filters'] =  collect($data['cols'])->whereNotNull("filter")->toArray();



        if (empty($this->model[$this->table])) {

            $where = "1=1";
            if ($this->module->language) {
                $where .= " and language_code='" . (!empty(request('language_code')) ? request('language_code') : 'vi') . "'";
            }
            if (request('deleted')) {
                $where .= " and (deleted=1)";
            } else {
                if ($this->module->soft_delete) {
                    $where .= " and (deleted=0 or deleted is null)";
                }
            }

            if(auth()->user()->id != "1")
            {
                $where .= " and created_by = '".auth()->user()->id."'";
            }
            $search = Modules::search_where(['keywords'=>request('keywords'),'filter'=>request('filter')], $where, $this->module->columns);
            $where  = $search['where'];
            $order  = (request("sort_field") ?? "id") . " " . (request("sort_order") ?? "desc");
            $rows = base_model::paging($this->table, $where, $order, $GLOBALS['var']['limit_perpage']);

        } else {
            $query = new $this->model[$this->table];
            if (method_exists($query, 'scopeSearch')) {
                $query = $query->search(['keywords' => request('keywords'),'filter'=>request('filter')]);
            }
            if (request('deleted')) {
                $query = $query->whereRaw("($this->table.deleted=1)");
            } else {
                if ($this->module->soft_delete) {
                    $query = $query->whereRaw("($this->table.deleted=0 or $this->table.deleted is null)");
                }
            }
            // $query = $query->selectRaw($query_select);
            if (request('show_all')) {
                $rows =  $query->get();
            } else $rows =  $query->paginate(20);
        }



        $rows->appends(request()->all());
        $data['rows'] =  $rows;
        $data['add_link'] = current_url($GLOBALS['var']['act']) . '/update';
        // return  view("admin::core.index", $data);
        return \Themes::render("core.index",$data,true);
    }
    public function update($id = "")
    {
        $data['title'] = module_title();
        $data['cols'] = (object)Modules::getColumnOption($GLOBALS['var']['act'], "column_info_options");
        $data['row'] = !empty($id) ? base_model::find($this->table, "id = '$id'") : [];
        // $conditions = getFieldSelectById($id) . "=" . $id
        // $data['row'] = base_model::find($this->table, "")where(getFieldSelectById($id), $id)->where("language_code", $GLOBALS['lang']['code'])->first();
        // return view("admin::core.update", $data);
        if (request()->ajax()) {
            return view("plugin::carton-crm.core.update", $data );
        } else {
            return \Themes::render("core.update", $data, true);
        }
    }

    public function process(Request $request)
    {
        $id = request("id");
        $doc = $request->toArray();
        unset($doc["files"]);
        $action = $doc["action"] ?? "save";
        unset($doc["action"]);
        if (count(request()->files) > 0) {
            $data_image =  upload(request()->files, "upload/images");

            if ($data_image) {
                foreach ($data_image as $key => $path) {
                    $doc[$key] = $path;
                }
            }
        }
        foreach ($doc as $k => $v) {
            if (is_array($v)) {
                $doc[$k] = json_encode($v);
            }
        }
        if (empty($this->model[$this->module->file])) {
            if(empty($id))
            {
                $doc['created_by'] = auth()->user()->id;
                $doc['created_at'] = date("Y-m-d H:i:s");
            }
            $record = base_model::save_data($this->table, $doc, $id);
        } else {
            $model = $this->model[$this->module->file];
            if (method_exists($model, 'beforeUpdate')) {
                $res =  $model::beforeUpdate($doc);
                if(!@$res['success'])
                {
                    if(request()->ajax())
                    {
                        $result['code'] = 201;
                        $result['success'] = true;
                        $result['message'] = $res['message'];
                        return response()->json($result, 200, ['Content-type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
                    }
                    else{
                        return redirect()->back()->with("alert_message_error", $res['message']);
                    }
                }
            }
            if (method_exists($model, 'checkValidator')) {
                if ($validator = $model::checkValidator($request)) {
                    if (@$validator['error']) {
                       return $validator;
                    }
                }
            }
            if (method_exists($model, 'checkExists')) {
                $resultExist = $model::checkExists($doc);
                if ($resultExist['exist']) {
                    if (request()->ajax()) {
                        $result['code'] = 201;
                        $result['success'] = true;
                        $result['message'] = $resultExist['message'];
                        return response()->json($result, 200, ['Content-type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
                    } else {
                        return redirect()->back()->with("alert_message_error", $resultExist['message'])->withInput($doc);
                    }
                }
            }
            $result = $model::updateOrCreate(['id' => $id], $doc);
            $record = $result->id;
        }
        if (request()->ajax()) {
            $result['code'] = 200;
            $result['success'] = true;
            $result['message'] = __("update success");
            $result['data'] = $record;
            return response()->json($result, 200, ['Content-type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
        } else {
            if ($action == "save") {
                $url = url('admin/' . $this->module->file);
                return redirect($url);
            } else {
                $url = url('admin/' . $this->module->file . '/update/' .  $record );
                return redirect($url)->with('alert_message',__("update success"));
            }
        }
    }
    public function checkExists(Request $request)
    {
        $doc = $request->toArray();
        $model = $this->model[$this->module->file];
        $resultExist = $model::checkExists($doc);
        if ($resultExist['exist']) {
            $result['code'] = 201;
            $result['success'] = true;
            $result['data'] = $resultExist['message'];
            return response()->json($result, 200, ['Content-type' => 'application/json;charst=utf-8'], JSON_UNESCAPED_UNICODE);
        }
        else{
            $result['code'] = 200;
            $result['success'] = true;
            return response()->json($result, 200, ['Content-type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }
    }

    public function destroy($id = null)
    {
        try {
            if (empty($this->model[$this->module->file])) {
                if(request('ids'))
                {
                    $ids = request('ids');
                    foreach($ids as $_id)
                    {
                        base_model::remove($this->table, $_id);
                    }
                }
                if ($this->module->soft_delete && !empty(request('deleted'))) {
                    $records = base_model::save_data($this->table, ['deleted' => 1,'deleted_by'=>auth()->user()->id], $id);
                } else {
                    $records = base_model::remove($this->table, $id);
                }
            }
            else{
                $model = $this->model[$this->module->file];

                if(!empty($id))
                {
                    $record = $model::find($id);
                    if (!empty($record)) {
                        $record->delete();
                    }

                    // $model = $this->model[$this->module->file];

                    // if ($this->module->soft_delete && !empty(request('deleted'))) {
                    //     $model::where('id', $id)->first()->delete();
                    // } else {
                    //     $model::where('id', $id)->update(['deleted' => 1, 'deleted_by'=>auth()->user()->id]);
                    // }
                }
                if(request('ids'))
                {
                    $ids = request('ids');
                    foreach($ids as $_id)
                    {
                        $record = $model::find($_id);
                        if (!empty($record)) {
                            $record->delete();
                        }
                    }
                }
            }
            if (request()->ajax()) {
                $result['code'] = 200;
                $result['success'] = true;
                $result['data'] = $id;
                return response()->json($result, 200, ['Content-type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
            } else {
                return redirect(admin_url($this->module->file))->with("alert_message", __("delete_success"));;
            }
        } catch (\Throwable $e) {
            return $e;
        }
    }

    function slugAlias()
    {
        $result = Struct::slug_alias();
        return $result;
    }

    public function updateCategories()
    {
        $id = request('id');
        $table = $this->table . '_categories';
        $data['info'] = !empty($id) ? $this->fn->info($id, $table) : [];
        $data['rows'] = $this->fn->categories(request('q'), $table) ?? [];

        return view("admin::" . $this->table . ".update_categories", $data);
    }
    public function processCategories(Request $request)
    {
        if (empty($request->_token)) {
            return redirect()->back();
        }
        $table = $this->table . '_categories';
        $id = $request->id;
        $doc = $request->toArray();
        unset($doc['_token']);
        if (count(request()->files) > 0) {
            $data_image =  upload(request()->files, "upload/images");
            if ($data_image) {
                foreach ($data_image as $key => $path) {
                    $doc[$key] = $path;
                }
            }
        }
        $doc['slug'] = createdSlug($doc['name']);
        if (!empty($id)) {
            $doc['updated_by'] = $GLOBALS['user']['id'];
            $doc['updated_at'] = date(TIME_SQL);
        } else {
            $doc['created_by'] = $GLOBALS['user']['id'];
            $doc['created_at'] = date(TIME_SQL);
        }
        if (base_model::save_data($this->table . "_categories", $doc, $id)) {
            return redirect()->back()->with("message", "Success");
        }
    }
}
