<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Admin\Model\Store;
use Modules\Admin\Model\Users;
use Modules\Plugin\Entities\Themes;
class StoreController extends BaseController
{
    protected $route = "admin.product";

    function index(Request $request)
    {
        $this->prepareSearch($request);
        $data['store'] = Store::where('type','main')->first();
        $data['stores'] = Store::where('type','brand')->get();
        $data['users'] = Users::with("UserRoles")->get();
        return Themes::render('admin::store.index', $data);

    }
    public function edit($id = null)
    {
        $model = new  Product();
        $record = empty($id)?[]: $model::with("details")->find($id);
        $theads = array_filter(config($this->route . '.theads'), function ($value) {
            if (!isset($value['editable']) || \Arr::get($value, 'editable')) {
                return $value;
            }
        });

        //Handel copy data
        if(request()->segment(3) == "copy")
        {
            unset($record->id);
        }
        $setting =  config($this->route . '.setting');
        $title = config($this->route . '.title');
        $link_update =  route('admin.product.update', [@$record->id ?? '']);
        return view('admin::product.edit', compact('record', 'theads', 'setting','link_update',  'title'));
    }
    public function update(Request $request, $id = null)
    {
        $status = $id ? 200 : 500;
        $doc = $request->toArray();
        $action = $doc["submit"]??"save";
        unset($doc["submit"]);
        unset($doc['delete_image']);
        if (count(request()->files) > 0) {
            $data_image =  $this->upload(request()->files, "upload/images");
            if ($data_image) {
                foreach ($data_image as $key => $path) {
                    $doc[$key] = $path;
                }
            }
        }
        else{
            if(!empty(request('delete_image')))
            {
                foreach(request('delete_image') as $k=>$v)
                {
                    $doc[$k] = "";
                }
            }

        }
        $model = new Store();
        $model::updateOrCreate(['id' => $id??1], $doc);
        if ($action == "save") {
            $url = route("admin.store");
            return redirect($url);
        } else {
            return redirect()->back();
        }
    }
    public function upload($value, $path_upload = NULL)
    {
        // if (empty($admin_group)) {
        //     $admin_group = json_decode(admin_group);
        // }
        $path_base =  "";
        if ($path_upload == "") {
            $path_upload = "upload/images";
            $path_image  =  $path_upload;
        } else {
            $path_image  =  $path_upload;
        }
        if (!file_exists($path_image)) {
            mkdir($path_image, 0777);
        }
        $data = array();
        foreach ($value as $n => $file) {
            if (is_array($file)) {
                $f_name = array();
                foreach ($file as $f) {
                    $name = $f->getClientOriginalName();
                    $path = $path_upload . '/' . $name;
                    $_parts = pathinfo($path);

                    $i = 1;
                    do {
                        $flg = file_exists($path_base . $path);
                        if ($flg) {
                            // $name = \h::alias_name($_parts['filename']) . '_' . $i . '.' . @$_parts['extension'];
                            $name = $_parts['filename'] . '_' . $i . '.' . @$_parts['extension'];
                            $path = $path_upload . '/' . $name;
                            $i++;
                        }
                    } while ($flg);

                    $f_name[] = $path;

                    $f->move($path_base . $path_upload, $name);
                }
                $data[$n]  = json_encode($f_name);
            } else {
                $name = $file->getClientOriginalName();
                $path = $path_upload . '/' . $name;
                $_parts = pathinfo($path);

                $i = 1;
                do {
                    $flg = file_exists($path_base . $path);
                    if ($flg) {
                        $name = $_parts['filename'] . '_' . $i . '.' . @$_parts['extension'];
                        $path = $path_upload . '/' . $name;
                        $i++;
                    }
                } while ($flg);
                $data[$n] = $path;
                $file->move($path_image, $name);
            }
        }
        return $data;
    }
    public function destroy($id)
    {
        $model = new Product;
        $record = $model::find($id);
        if (!empty($record)) {
            $record->delete();
        }

        return redirect()->back();
    }
    function export(Request $request)
    {
        $this->prepareSearch($request);
        $query = new  Product();
        $records = $query->filter()
            ->selectRaw('ROW_NUMBER() OVER(PARTITION BY id) AS row_num ,name,description,price,created_at')
            ->get();
        $head = ["STT", "TIÊU ĐỀ", "MÔ TẢ", "GIÁ", "DIỆN TÍCH"];
        $arr = array_merge([$head], $records->toArray());
        $fileName = 'file_quotation_' . date("d-m");
        if (file_exists(base_path("public/storage/export/" . $fileName . ".csv"))) {
            @unlink(base_path("public/storage/export/" . $fileName . ".csv"));
        }
        writeCsv($arr, base_path("public/storage/export/" . $fileName . ".csv"));
        return response()->download(base_path("public/storage/export/" . $fileName . ".csv"));
    }
}
