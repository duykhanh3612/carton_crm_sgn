<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Admin\Model\Customer;
use Modules\Admin\Model\Order;
use Modules\Plugin\Entities\Themes as EntitiesThemes;

class CustomerController extends BaseController
{
    protected $route = "admin.customer";
    public function __construct()
    {
        $this->config = config($this->route);
        view()->share("config", config($this->route));
        parent::__construct();
    }
    function index(Request $request)
    {
        $this->prepareSearch($request);
        $params = $request->all();
        $params['title'] = config($this->route . '.title');
        $refresh = ['route' => 'admin.customer'];
        $filters = [
            [
                'name' => 'keywords',
                'placeholder' => __('Nhập Mã / Họ tên / SĐT và enter') . ':',
                'value' => request()->keywords
            ],
            [
                'name' => "search",
                'type' => "submit",
                'value' => "Tìm kiếm",
                'icon' => "<i class='fa fa-search'></i>"
            ]

        ];
        $childrenTabs = [
            // 'user.customers' => 'Back',
        ];
        $buttons = [
            [
                'href' => '#',
                'class' => 'btn btn-danger  please-wait btnNewCustomer',
                'label' => 'Tạo KH',
                'title' => __('Add new'),
                'icon' => 'fa-plus'
            ],
            // [
            //     'href' => route('admin.customer.export'),
            //     'class' => 'btn btn-success please-wait',
            //     'label' => 'Excel',
            //     'title' => __('Export Excel'),
            //     'icon' => 'fa-file'
            // ],
        ];
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
            'edit' =>   'admin.customer.edit',
            'delete' => 'admin.customer.delete',
        ];
        $query = new  customer();
        $records = $query->filter()->paginate(request()->limit);
        $includes = [
            "admin::customer.include"
        ];

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
            'includes' => $includes,
            'childrenTabs' => $childrenTabs,
        ],true);
    }
    public function edit($id = null)
    {
        $model = new  Customer();
        $record = empty($id) ? [] : $model->find($id);
        $theads = array_filter(config($this->route . '.theads'), function ($value) {
            if (!isset($value['editable']) || \Arr::get($value, 'editable')) {
                return $value;
            }
        });
        $setting =  config($this->route . '.setting');
        $title = config($this->route . '.title');
        $link_update =  route('admin.customer.update', [@$record->id ?? '']);
        if (request()->ajax()) {
            $result['code'] = 200;
            $result['success'] = true;
            $result['data'] = $record;
            return response()->json($result, 200, ['Content-type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }
        return view('admin::edit', compact('record', 'theads', 'setting', 'link_update',  'title'));
    }
    public function update(Request $request, $id = null)
    {
        if ($id == null) {
            $id = $request->id;
        }
        $doc = $request->toArray();
        $action = $doc["submit"] ?? "save";
        unset($doc["submit"]);

        if (count(request()->files) > 0) {
            $data_image =  $this->upload(request()->files, "upload/news");
            if ($data_image) {
                foreach ($data_image as $key => $path) {
                    $doc[$key] = $path;
                }
            }
        }
        if ($id == "") {
            $doc["created_by"] = auth()->user()->id;
        }
        if(@$doc['birthday']!="")
        {
            $doc['birthday'] = date("Y-m-d", strtotime(str_replace("/", "-", $doc['birthday'])));
        }
        $model = new Customer();
        if (method_exists($model, 'checkExists')) {
            $resultExist = $model::checkExists($doc);
            if ($resultExist['exist']) {
                if (request()->ajax()) {
                    $result['code'] = 201;
                    $result['success'] = true;
                    $result['message'] = $resultExist['message'];
                    return response()->json($result, 200, ['Content-type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
                } else {
                    return redirect()->back()->with("message", "Record is exist");
                }
            }
        }
        $customer =  $model::updateOrCreate(['id' => $id], $doc);
        if ($request->ajax()) {
            $result['code'] = 200;
            $result['success'] = true;
            $result['data'] = $customer;
            return response()->json($result, 200, ['Content-type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }
        if ($action == "save") {
            $url = route("admin.customer");
            return redirect($url);
        } else {
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request, $id = null)
    {
        if(request('ids'))
        {
            $model = $this->model["customer"];
            $ids = request('ids');
            $message = [];
            foreach($ids as $_id)
            {
                $record = $model::find($_id);
                $order = Order::where("customer_id",$_id)->count();

                if($order > 0)
                {
                    $message[] = "KH ". $record->full_name;
                    continue;
                }
                if (!empty($record)) {
                    $record->delete();
                    // $record->update(['deleted'=>1]);
                }
            }
            $mes = empty($message)?"Xóa thành công":(implode(",",$message)."đã có đơn hàng không thể xóa");
            if ($request->ajax()) {
                $result['code'] = 200;
                $result['success'] = true;
                $result['message'] = $mes;
                return response()->json($result, 200, ['Content-type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
            }
            else{
                return redirect()->back()->with("alert_message",  $mes);
            }


        }

        if(!empty($id))
        {
            $model = $this->model["customer"];
            $record = $model::find($id);
            $order = Order::where("customer_id",$id)->count();

            if($order > 0)
            {
                return redirect()->back()->with("alert_message_error",  "Khách hàng đã có đơn hàng không thể xóa");
            }
            if (!empty($record)) {
                $record->delete();
                // $record->update(['deleted'=>1]);
            }

            if ($request->ajax()) {
                $result['code'] = 200;
                $result['success'] = true;
                $result['data'] = "Xóa thành công";
                return response()->json($result, 200, ['Content-type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
            }
            else{
                return redirect()->back()->with("alert_message",  "Xóa thành công");
            }

        }

    }

    function export(Request $request)
    {
        $this->prepareSearch($request);
        $query = new Customer();
        $records = $query->selectRaw("ROW_NUMBER() OVER(PARTITION BY id) AS row_num , customers.code, `full_name`, `phone`,
            `email`,  `address`, `birthday`,(CASE `gender` WHEN 'true' THEN 'Nam' ELSE 'Nữ' END) as gender, customers.`shipping_address`")
            ->get();
        $head = ["STT", "MÃ", "kHÁCH HÀNG", "ĐIỆN THOẠI", "EMAIL", "ĐỊA CHỈ", "NGÀY SINH", "GIỚI TÍNH", "ĐỊA CHỈ GIAO HÀNG"];
        $arr = array_merge([$head], $records->toArray());
        $fileName = 'file_quotation_' . date("d-m");
        if (file_exists(base_path("public/storage/export/" . $fileName . ".csv"))) {
            @unlink(base_path("public/storage/export/" . $fileName . ".csv"));
        }
        writeCsv($arr, base_path("public/storage/export/" . $fileName . ".csv"));
        return response()->download(base_path("public/storage/export/" . $fileName . ".csv"));
    }
}
