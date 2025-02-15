<?php

namespace Modules\Admin\Http\Controllers;

use App\Model\base_model;
use Illuminate\Http\Request;
use Modules\Admin\Model\Order;
use Modules\Admin\Model\Order\OrderDetail;
use Modules\Admin\Model\OrderLog;
use Modules\Admin\Model\GeoProvince;
use Modules\Admin\Model\Customer;
use Modules\Admin\Model\Product;
use Modules\Admin\Model\Product\ProductCategory;
use Modules\Admin\Model\Shipment;
use Modules\Plugin\Entities\Themes;
use App\Services\Maatwebsite\ExcelExport;


class OrderController extends BaseController
{
    protected $config_option = [];
    protected $route = "admin.order";
    protected $config;
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
        $refresh = ['route' => 'admin.order'];
        $filters = [
            [
                'name' => 'keywords',
                'placeholder' =>  __('Nhập mã đơn hoặc mã/họ tên/SĐT khách hàng/NCC và enter') . ':',
            ],
            [
                'name' => "search",
                'type' => "submit",
                'value' => "Tìm kiếm",
                'icon' => "<i class='fa fa-search'></i>"
            ],
            "children" => [
                "left" => [
                    [
                        'name' => 'filter[saler_id]',
                        'field_name' => 'saler_id',
                        'type' => 'form_drop',
                        'table' => 'users_group',
                        'table_field' => ['key' => "user_id", "value" => "user_name"],
                        'viewable' => 0,
                        'editable' => 1,
                        'defaultValue' => true,
                        'empty_value' => [""=>"----  Nhân viên  ----"],
                        'class' => 'text-left datatable-filter',
                    ],
                    [
                        'name' => "filter[status]",
                        'field_name' => 'status',
                        'type' => "form_drop",
                        'table' => 'order_status',
                        'table_field' => ['key' => "id", "value" => "name"],
                        'defaultValue' => true,
                        'empty_value' => [""=>"----  Trạng thái  ----"],
                        'class' => 'datatable-filter',
                    ],
                    [
                        'name' => "filter[status_payment]",
                        'field_name' => 'status_payment',
                        'type' => "option_items_keynum",
                        'empty_value' => [""=>"Chọn Tình trạng thanh toán"],
                        'option_key' => "status_payment",
                        'class' => 'datatable-filter',
                    ],
                ],
                "right" => [
                    [
                        'name' => "filter[date]",
                        'field_name' => 'date',
                        'type' => "choose_date",
                    ],
                ]

            ]
        ];
        $childrenTabs = [
            // 'user.orders' => 'Back',
        ];
        $buttons = [];
        if(check_rights(2,"create"))
        {
            $button =  [
                'href' => route('admin.order.create'),
                'class' => 'btnBlue please-wait',
                'label' => 'Tạo đơn hàng',
                'title' => __('Add new'),
                'icon' => 'fa-plus'
            ];
            array_push($buttons, $button);
        }
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
            'copy' =>   'admin.order.copy',
            'edit' =>   'admin.order.edit',
            'delete' => 'admin.order.delete',
        ];
        $query = new  Order();
        $records = $query->filter($request->filter??[])->paginate(request()->limit);
        $records->appends(request()->all());
        $summary = [
            'order' => $records->total(),
            'total' =>  (new  Order())->filter($request->filter??[])->sum("total"),
            'debt' =>  (new  Order())->filter($request->filter??[])->sum("debt")
        ];
        $includes = [
            "admin::order.modal"
        ];
        $footer_include = [
            "admin::order.summary"
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
            'footer_include' => $footer_include,
            'summary' => $summary,
            'childrenTabs' => $childrenTabs,
        ],true);
    }
    public function edit($id = null)
    {
        $model = new  Order();
        $record = $model::with("details")->with("customer")->find($id);
        $theads = array_filter(config($this->route . '.theads'), function ($value) {
            if (!isset($value['editable']) || \Arr::get($value, 'editable')) {
                return $value;
            }
        });
        $setting =  config($this->route . '.setting');
        $title = config($this->route . '.title');
        $option =[
            'shippers' => array_replace([''=>'--Tất cả--'], base_model::find_all("shipping_unit")->pluck("name","id")->toArray())
        ];
        if(request()->segment(3) == "copy")
        {
            $arr_reset = ["id","date","carrier_name","delivery_date","saler_id"];
            $record->status = 1;
            $record->discount_value = 0;
            $record->total_paid = 0;

            foreach($arr_reset as $key)
            {
                $record->{$key} = "";
            }
            $link_update =  route('admin.order.update.new');
        }
        else{
            $link_update =  route('admin.order.update', [@$record->id ?? '']);
        }
        return Themes::view('admin::order.edit', compact('record', 'theads', 'setting', 'link_update',  'title','option'));
    }
    function item()
    {
        $id = request('id');
        $data['order'] = Order::where("id", $id)->first();
        $data['records'] = OrderDetail::where("order_id", $id)->get();
        return view("admin::order.item", $data);
    }
    public function update(Request $request, $id = null)
    {

        $status = $id ? 200 : 500;
        $doc = $request->toArray();

        $action = $doc["submit"] ?? "save";
        unset($doc["submit"]);
        unset($doc["customer"]);
        unset($doc["item"]);
        if (count(request()->files) > 0) {
            $data_image =  $this->upload(request()->files, "upload/news");
            if ($data_image) {
                foreach ($data_image as $key => $path) {
                    $doc[$key] = $path;
                }
            }
        }
        $model = new Order();
        if ($id == null) {
            $doc['code'] = Order::renderCode();
            $doc['type'] = 1;
        }
        if(@$doc['delivery_date'] != "")
        {
            $doc['delivery_date'] = date("Y-m-d",strtotime(str_replace("/","-",$doc['delivery_date'])));
        }
        $doc['shipping_fee'] = convert_decimal(@$doc['shipping_fee']);

        $log_order = $model::where("id",$id)->first();
        if(empty($log_order))
        {
            $log_order = [];
        }

        $order_new = $model::updateOrCreate(['id' => $id], $doc);
        if ($items = request('item')) {
			\App\Helpers\LogHelper::write($items,"PO:".$order_new->id);
            foreach ($items as $itemID => $item) {
                if ($itemID != "id") {
                    if (@$item['deleted']) {
                        OrderDetail::where('id',  $itemID)->delete();
                    } else {
                        $product = Product::where("id", @$item['product_id'])->first();
                        if(!empty($product))
                        {
                            $t['order_id'] = $order_new->id;
                            $t['product_id'] =   $product->id;
                            $t['product_name'] =   $product->name;
                            $t['category'] =   $product->product_category_id;
                            $t['category_name'] =  ProductCategory::where("id", $product->product_category_id)->first()->name;
                            $t['sku'] = @$product->sku;
                            $t['description'] = $product->name;
                            $t['qty'] = convert_decimal(@$item['qty']);

                            $t['unit_price'] = convert_decimal(@$item['price']);
                            $t['total_price'] = convert_decimal(@$t['unit_price']) * convert_decimal($t['qty']);
                            $itemID = is_string($itemID) ? "" : $itemID;
                            OrderDetail::updateOrCreate(['id' =>  $itemID], $t);
                        }

                    }
                }
            }
        }

        Order::updateSummary($order_new);
        Order::updateLog($log_order, $order_new);
        return redirect("admin/order/edit/" . $order_new->id);
    }
    public function update_comment($id)
    {

        $order = Order::where('id', $id)->first();
        $log_order =  $order;
        if(!empty($order))
        {
            $order->note =  request('note');
            $order->save();
        }
        $log_order_changed = Order::where("id",$id)->first();
        Order::updateLog($log_order, $log_order_changed);
    }
    public function destroy($id)
    {
        $record = Order::find($id);
        if (!empty($record)) {
            $record->update(['deleted' => 1]);
        }

        return redirect()->back();
    }
    function updateStatus()
    {
        $orderId = request('order_id');
        $status = request('status');

        $order = Order::where("id", $orderId)->first();
        $log_order = $order;
		if(empty($order))
		{
			return response()->json(['success' => true,"message"=>"Cập nhật trạng thái thành công"]);
		}
        $order->status = $status;
        if ($status == 2) {
            $order->customer_phone = request('customer_phone');
            $order->shipping_province = request('shipping_province');
            $order->shipping_district = request('shipping_district');
            $order->shipping_address = request('shipping_address');
        }
        if ($status == 3) {
            $order->shippers = request('shippers');
            $order->delivery_date = date("Y-m-d", strtotime(str_replace("/", "-", request('delivery_date'))));
            $order->carrier_name = request('carrier_name');
            $order->shipping_comment = request('shipping_comment');
            $order->shipping_fee = convert_decimal(request('shipping_fee'));
        }

        if(!empty($order))
        {
            $order->save();
        }
        Order::updateSummary($order);

        $log_action = "";
        switch($status)
        {
            case 2:
                $log_action = "xác nhận";
                break;
            case 3:
                $log_action = "xác nhận giao hàng";
                break;
            case 4:
                $log_action = "xác nhận hoàn tất";
                break;
            case 5:
                $log_action = "xác nhận hủy";
                break;
            default:
                $log_action = "cập nhật";
                break;
        }
        //Handel Update Log
        Order::updateLog($log_order, $order, "đã $log_action đơn hàng ". $order->code, "user" , auth()->user());
        return response()->json(['success' => true,"message"=>"Cập nhật trạng thái thành công"]);
    }

    function updatePayment()
    {
        $order_id = request("order_id");
        $payment_new_value = request("payment_new_value");
        $payment_type = request("payment_type");

        $order = Order::where("id", $order_id)->first();
        $log_order = $order;
        if(empty($order))
        {
            $result = "Update fail";
            return response()->json($result, 201, ['Content-type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }
        $order->total_paid  = intval($payment_new_value);
        $order->debt  = intval($order->total) - $payment_new_value;
        $order->payments_type =  $payment_type;
        $order->cashier = auth()->user()->id;
        $order->update();

        $payments_name = "";
        switch ($payment_type) {
            case '1':
                $payments_name = "Tiền mặt";
                break;
                case '3':
                    $payments_name = "CK";
                    break;
                case '2':
                    $payments_name = "Thẻ";
                    break;

            default:
                # code...
                break;
        }

        $order_changed = Order::where("id", $order_id)->first();
        Order::updateLog($log_order, $order_changed, "Cập nhật thanh toán đơn hàng:".number_format($payment_new_value).". Hình thức thanh toán". $payments_name );
        Order::updateSummary($order);
        $result = [
            'success' => true,
            'message' =>__("Update success")
        ];
        return response()->json($result, 200, ['Content-type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }

    function updateDiscount()
    {
        $order_id = request("order_id");
        $discount_value = convert_decimal(request("discount_value"));
        $discount_type = request("discount_type");
        $discount_percent = request("discount_percent");
        $order = Order::where("id", $order_id)->first();
        $log_order = $order;
        if(empty($order))
        {
            $result = "Update fail";
            return response()->json($result, 201, ['Content-type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }
        $order->discount_value  = $discount_value;
        $order->total =  intval($order->subTotal) + intval($order->shipping_fee) - intval($discount_value);
        $order->debt =    $order->total - $order->total_paid;
        $order->discount_type  = $discount_type;
        $order->discount_percent =  $discount_percent;
        $order->update();
        Order::updateLog($log_order, $order, "Cập nhật giá đơn hàng ".number_format($discount_value));

        $result = "Update success";
        return response()->json($result, 200, ['Content-type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }
    function export(Request $request,$type = "csv")
    {
        if($type=="csv")
        {
            $this->prepareSearch($request);
            $query = new  Order();
            $records = $query->filter()
                ->selectRaw('ROW_NUMBER() OVER(PARTITION BY id) AS row_num ,name,district,price,area')
                ->get();
            $head = ["STT", "TIÊU ĐỀ", "QUẬN", "GIÁ", "DIỆN TÍCH"];
            $arr = array_merge([$head], $records->toArray());
            $fileName = 'file_quotation_' . date("d-m");
            if (file_exists(base_path("public/storage/export/" . $fileName . ".csv"))) {
                @unlink(base_path("public/storage/export/" . $fileName . ".csv"));
            }
            writeCsv($arr, base_path("public/storage/export/" . $fileName . ".csv"));
            return response()->download(base_path("public/storage/export/" . $fileName . ".csv"));
        }
        else if($type=="orders")
        {
            $ids = request("ids");
            $excel = new ExcelExport();
            if(empty($ids))
            {
                $query = new  Order();
                $records = $query->filter($request->filter??[]);
                $data['orders']  = $records->get();
                $data["records"] = OrderDetail::join("orders","orders.id","orders_detail.order_id")->whereIn("orders.id",$records->pluck("id")->toArray())->get();
            }
            else{
                $data['orders']  = Order::whereIn("orders.id",$ids)->get();
                $data["records"] = OrderDetail::join("orders","orders.id","orders_detail.order_id")->whereIn("orders.id",$ids)->get();
            }
            $data['startDate'] = request('startDate');
            $data['endDate'] = request('endDate');
            $file = "orders".time().".xlsx";
            if(request("preview"))
            {
                return view("admin::order.export.orders",$data);
            }
            if(request('type')=="json")
            {
                $excel->view("admin::order.export.orders", $data, $file,"asset");
                $result['file'] = url(env("APP_PATH")."storage/".$file);
                $result['name'] = $file;
                return response()->json($result, 200, ['Content-type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
            }
            return $excel->view("admin::order.export.orders",$data,$file);
        }
    }

    function print($id)
    {
        $data['order'] = Order::with("details")->with("customer")->with("sale")->find($id);
        return view("admin::order.print", $data);
    }
    function shipment()
    {
        $district = request("district_id");
        $price = request("price");
        if($district == "" || $district == 0)
        {
            $shipment =[
                'name' => "Khác",
                'fee' =>  $price * 0.1
            ];
        }
        else{
            $shipment = Shipment::where("district_id","like",'%"'.$district.'"%')->where("price_from","<=",$price)->where("price_to",">=",$price)->first();
            if(!empty($shipment))
            {
                $shipment->district_id = json_decode($shipment->district_id);
            }
            else{
                $shipment =[
                    'name' => "Khác",
                    'fee' =>  $price * 0.1
                ];
            }
        }
		//Handel Temp hide get calc fee sheep
        $shipment['fee'] = 0;
        $result['data'] =  $shipment ;
        $result['code'] = 200;
        $result['success'] = true;
        return response()->json($result, 200, ['Content-type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);

    }
}
