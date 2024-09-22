<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Admin\Model\Product;

class ProductController extends BaseController
{
    protected $route = "admin.product";
    public function __construct()
    {
        $this->route = 'admin.' . request()->segment(2);
        $this->slug = request()->segment(2);
        view()->share('model', $this->model);

        $this->config = config($this->route);
        view()->share("config",config($this->route));
        parent::__construct();
    }

    function index(Request $request)
    {
        $this->prepareSearch($request);
        $params = $request->all();
        $params['title'] = config($this->route.'.title');
        $refresh = ['route' => 'admin.product'];
        $filters = [
            [
                'name' => 'keywords',
                'placeholder' =>  __('Nhập tên hoặc mã hàng và nhấn Tìm kiếm'),
                'value' => request()->keywords
            ],
            [
                'name' => 'filter[product_category_id]',
                'field_name' => 'product_category_id',
                'type' => 'form_drop',
                'table' => 'product_category',
                'table_field' => ['key' => "id", "value" => "name"],

                'defaultValue' => true,
                'empty_value' => [""=>"---- Danh mục----"],
                'class' => 'text-left datatable-filter',
            ],
            [
                'name' => "search",
                'type' => "submit",
                'value' => "Tìm kiếm",
                'icon' => "<i class='fa fa-search'></i>"
            ]
        ];
        $childrenTabs = [
            // 'user.products' => 'Back',
        ];

        $buttons = [];
        if(check_rights("product","create"))
        {
            $buttons[] = [
                    'href' => route('admin.product.create'),
                    'class' => 'btnBlue please-wait',
                    'label' => 'Thêm hàng hóa',
                    'title' => __('Add new'),
                    'icon' => 'fa-plus'
            ];
        }

        // [
        //     'href' => route('admin.product.export'),
        //     'class' => 'btnBlue please-wait',
        //     'label' => 'Excel',
        //     'title' => __('Add new'),
        //     'icon' => 'fa-file'
        // ],

        $navs = config($this->route . '.navs');
        $theads = [];
        if (!empty(config($this->route . '.theads'))) {
            $theads = array_filter(config($this->route . '.theads'), function ($value) {
                if (!isset($value['viewable']) ||  \Arr::get($value, 'viewable')) {
                    return $value;
                }
            });
        }
        $links = [
            'copy' =>  'admin.product.copy',
            'edit' =>   'admin.product.edit',
            'delete' => 'admin.product.delete',
        ];
        $query = new  Product();
        $records = $query->filter(['keywords'=>request('keywords'),'filter'=>request('filter')])->paginate(request()->limit??10);
        return \Themes::render('datatable', [
            'params' => $params,
            'navs' => $navs,
            'filters' => $filters,
            'refresh' => $refresh,
            'buttons' => $buttons,
            'records' => $records,
            'theads' => $theads,
            'tfoots' => config($this->route . '.tfoots'),
            'links' => $links,
            'childrenTabs' => $childrenTabs,
        ], true);

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
        return \Themes::render('admin::product.edit', compact('record', 'theads', 'setting','link_update',  'title'));
    }
    public function update(Request $request, $id = null)
    {
        $status = $id ? 200 : 500;
        $doc = $request->toArray();
        $action = $doc["action"]??"save";
        unset($doc["action"]);
        unset($doc["delete_image"]);
        if (count(request()->files) > 0) {
            $data_image =  upload(request()->files, "upload/product");
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
            unset($doc['delete_image']);
        }
        if(isset( $doc['price'])) $doc['price'] = str_replace(",","", $doc['price']);
        if(isset( $doc['original_price'])) $doc['original_price'] = str_replace(",","", $doc['original_price']);
        $model = new Product();
        $old = Product::where('id', $id)->first();
        if(!empty($old))
        {
            if(isset( $doc['original_price']) && $old->original_price != $doc['original_price'])
            {
                Product::updateLog($old, "Điều chỉnh giá vốn từ ".number_format(intval($old->original_price))." thành ".number_format(intval($doc['original_price'])));
            }

            if(isset( $doc['price']) && $old->price != $doc['price'])
            {
                Product::updateLog($old, "Điều chỉnh giá bán từ ".number_format($old->price)." thành ".number_format(intval($doc['price'])));
            }

        }

        $record = $model::updateOrCreate(['id' => $id], $doc);
        if ($action == "save") {
            $url = route("admin.product");
            return redirect($url);
        } else {
            return redirect(route("admin.product.edit",$record->id));
        }
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
    public function upload_file()
    {
        $id = request('id');
        if ($id == '')
            $id_new =  md::save_data($func->table, array());
        else $id_new = $id;
        $data = self::upload(request()->files, request('path_upload'));
        return response()->json(array('sort' => request('sort'), 'id' => $id_new, 'image' => reset($data)));
    }
    function export(Request $request)
    {
        $this->prepareSearch($request);
        $query = new  Product();
        $records = $query->filter()
            ->selectRaw('ROW_NUMBER() OVER(PARTITION BY id) AS row_num ,name,sku,qty,original_price,price,qty_min_inventory,qty_max_inventory,description')
            ->get();

        $head = ["STT", "Tên hàng hóa", "Mã hàng hóa","Số lượng", "Giá vốn", "Giá bán", "Tồn kho tối thiếu", "Tồn kho tối đa", "Mô tả"];
        $arr = array_merge([$head], $records->toArray());
        $fileName = 'file_quotation_' . date("d-m");
        if (file_exists(base_path("public/storage/export/" . $fileName . ".csv"))) {
            @unlink(base_path("public/storage/export/" . $fileName . ".csv"));
        }
        writeCsv($arr, base_path("public/storage/export/" . $fileName . ".csv"));
        return response()->download(base_path("public/storage/export/" . $fileName . ".csv"));
    }
}
