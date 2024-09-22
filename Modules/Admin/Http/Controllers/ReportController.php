<?php


namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Admin\Model\Order;
use Modules\Admin\Model\Order\OrderDetail;
use Modules\Admin\Model\Payment;
use Modules\Admin\Model\Users;
class ReportController extends BaseController
{
    protected $route = "admin.order";
    function revenue(Request $request)
    {
        $box['count_order']  = Order::report()->count();
        $box['total_order']  = Order::report()->sum('total');
        $data['box'] = (object)$box;

        return \Themes::view('admin::report.revenue', $data);
    }

    function revenue_type(Request $request)
    {
        return $this->viewReport(request('type'));
    }
    function viewReport($type)
    {
        $box['count_order']  = Order::report()->count();
        $box['total_order']  = Order::report()->sum('total');
        $data['box'] = (object)$box;
        $data['users'] = Users::pluck("full_name","id")->toArray();
        request()->merge([
            'fromDate' =>  request('fromDate'),
            'toDate' => request('toDate'),
            'filter_type' => request('filter_type')
        ]);
        if ($type == "1") {
            //Sale
            $data['orders'] = Order::report()
                ->selectRaw("count(*) as total_order,sum(total) as total,saler_id,
            (SELECT count(*) FROM orders_detail where orders_detail.order_id in (select id from orders as s where s.saler_id = orders.saler_id ) ) AS total_order_detail
            ")
                ->with("sale")->groupBy("saler_id")->orderBy("total","desc")->get();
            return view('admin::report.revenue.sale', $data);
        } elseif ($type == 2) {

            $data['orders'] = Order::report()
                ->selectRaw("count(*) as total_order,sum(total) as total,store_id,
            (SELECT count(*) FROM orders_detail where orders_detail.order_id in (select id from orders as s where s.store_id = orders.store_id ) ) AS total_order_detail
            ")
                ->with("store")->groupBy("store_id")->get();
            return view('admin::report.revenue.store', $data);
        } elseif ($type == 4) {
            $query = OrderDetail::report()
                ->leftJoin("product_category","product_category.id","orders_detail.product_id")
                ->selectRaw("sum(qty) as qty,sum(total_price) as total_price,sku,product_id,product_category.id as category_id,product_category.name as category_name")
                ->whereIn("order_id",function($q){
                    $q->select("id")->from("orders")->where("deleted",0)->where("status","<>",5);
                    if(request('fromDate') && request('toDate'))
                    {
                        $formDate = date("Y-m-d", strtotime(str_replace('/', '-', request('fromDate'))));
                        $toDate = date("Y-m-d", strtotime(str_replace('/', '-',  request('toDate'))));
                        $q = $q->where("created_at", ">=",  $formDate . " 00:00:00");
                        $q = $q->where("created_at", "<=", $toDate . " 23:59:59");
                    }

                })
                ->with("product")->groupBy("product_id")->orderBy("total_price","desc");
            $product_category_id = request('product_category_id');
            if($product_category_id!= "")
            {
                $query = $query->where("product_category.id", $product_category_id);
            }
            $box['total_order']  = $query->get()->sum('total_price');
            $box['count_order']  = Order::report()->whereIn("id",function($q) use($product_category_id){
                $q->select("order_id")->from("orders_detail")
                ->leftJoin("product_category","product_category.id","orders_detail.product_id");
                if($product_category_id!= "")
                {
                    $q = $q->where("product_category.id", $product_category_id);
                }
            })->count();

            $data['box'] = (object)$box;
            $data['orders'] = $query->paginate(20);

            return view('admin::report.revenue.product', $data);
        } else {
            $data['orders'] = Order::report()->with("sale")->paginate(20);
            return view('admin::report.revenue.date', $data);
        }
    }

    function revenue_export()
    {
        $box['count_order']  = Order::report()->count();
        $box['total_order']  = Order::report()->sum('total');
        $type = request('type');
        $data['box'] = (object)$box;
        request()->merge([
            'fromDate' =>  request('fromDate'),
            'toDate' => request('toDate'),
            'filter_type' => request('filter_type')
        ]);
        if ($type == "1") {
            $records = Order::report()
                ->selectRaw("ROW_NUMBER() OVER(ORDER BY orders.id ASC) AS row_num,sale.full_name,sum(total) as total,count(*) as total_order,
                            (SELECT count(*) FROM orders_detail where orders_detail.order_id in (select id from orders as s where s.saler_id = orders.saler_id ) ) AS total_order_detail,
                            sum(total_paid),0 as order_cancel,0 as product_cancel
            ")
            ->join("users as sale", "sale.id", "saler_id")
            ->groupBy("saler_id")->get();
            if (!empty($records)) {
                $records = json_decode(json_encode($records), true);
            }
            //
            $head = ["STT", " Người bán", "Tiền bán hàng", "Số đơn hàng", "Hàng hóa bán", "Tiền trả hàng", "Đơn hàng trả", "Hàng hóa trả"];
            $arr = array_merge([$head], $records);
            $fileName = 'file_revenue_sale_' . date("d-m");
            if (file_exists(base_path("public/storage/export/" . $fileName . ".csv"))) {
                @unlink(base_path("public/storage/export/" . $fileName . ".csv"));
            }
            writeCsv($arr, base_path("public/storage/export/" . $fileName . ".csv"));
            return url("public/storage/export/" . $fileName . ".csv");
        } elseif ($type == 2) {
            $records  = Order::report()
                ->selectRaw("ROW_NUMBER() OVER(ORDER BY orders.id ASC) AS row_num,store.name,sum(total) as total,count(*) as total_order,
            (SELECT count(*) FROM orders_detail where orders_detail.order_id in (select id from orders as s where s.store_id = orders.store_id ) ) AS total_order_detail,
            sum(total_paid),0 as order_cancel,0 as product_cancel")
            ->join("store", "store.id", "store_id")
            ->groupBy("store_id")->get();
            if (!empty($records)) {
                $records = json_decode(json_encode($records), true);
                dd($records);
            }
            $head = ["STT", "Cửa hàng", "Tiền bán hàng", "Số đơn hàng", "Hàng hóa bán", "Tiền trả hàng", "Đơn hàng trả", "Hàng hóa trả"];
            $arr = array_merge([$head], $records);
            $fileName = 'file_revenue_store_' . date("d-m");
            if (file_exists(base_path("public/storage/export/" . $fileName . ".csv"))) {
                @unlink(base_path("public/storage/export/" . $fileName . ".csv"));
            }
            writeCsv($arr, base_path("public/storage/export/" . $fileName . ".csv"));
            return url("public/storage/export/" . $fileName . ".csv");
        } elseif ($type == 4) {
            $records = OrderDetail::report()
                ->selectRaw("ROW_NUMBER() OVER(ORDER BY orders_detail.id ASC) AS row_num,product.sku,product.name,count(*) as qty,
                sum(total_price) as total_price, 0 as qty_paid, 0 as total_paid")
                ->join("product", "product.id", "product_id")
                ->groupBy("product_id")->get();
                if (!empty($records)) {
                    $records = json_decode(json_encode($records), true);
                }
                $head = ["STT", "Mã hàng hóa", "Tên hàng hóa", "SL bán", "Tiền bán hàng", "SL trả", "Tiền trả hàng"];
                $arr = array_merge([$head], $records);
                $fileName = 'file_revenue_product_' . date("d-m");
                if (file_exists(base_path("public/storage/export/" . $fileName . ".csv"))) {
                    @unlink(base_path("public/storage/export/" . $fileName . ".csv"));
                }
                writeCsv($arr, base_path("public/storage/export/" . $fileName . ".csv"));
                return url("public/storage/export/" . $fileName . ".csv");
        } else {
            $records = Order::report()
                ->selectRaw('ROW_NUMBER() OVER(ORDER BY orders.id ASC) AS row_num,orders.code,orders.created_at,u1.full_name as carrier_name, c.name,qty,subTotal,discount_value,total, debt')
                ->join("users as u1", "u1.id", "cashier")
                ->join("customers as c", "c.id", "customer_id")
                ->get();
            if (!empty($records)) {
                $records = json_decode(json_encode($records), true);
            }

            $head = ["STT", " Đơn hàng", "Ngày bán", "Thu ngân", "Khách hàng", "Số lượng", "Thành tiền", "Giảm giá", "Tổng tiền", "Nợ"];
            $arr = array_merge([$head], $records);
            $fileName = 'file_revenue_date_' . date("d-m");
            if (file_exists(base_path("public/storage/export/" . $fileName . ".csv"))) {
                @unlink(base_path("public/storage/export/" . $fileName . ".csv"));
            }
            writeCsv($arr, base_path("public/storage/export/" . $fileName . ".csv"));
            return url("public/storage/export/" . $fileName . ".csv");
            // return response()->download(base_path("public/storage/export/" . $fileName . ".csv"));
        }
    }
    public function payment(Request $request)
    {
        $data['receipts'] = Payment::filter($request->filter??[])->where("total_paid",">",0)->get();
        $data['users'] = Users::pluck("full_name","id")->toArray();
        $data['payment'] = [
            1 => 'Tiền mặt',
            2 => 'Thẻ',
            3 => 'CK'
        ];
        view()->share("config", config("admin.payment"));
        return \Themes::view("admin::report.payment", $data);
    }
    public function paymentReceiptVoucher(Request $request)
    {
        request()->merge([
            'fromDate' =>  request('fromDate'),
            'toDate' => request('toDate'),
            'filter_type' => request('filter_type')
        ]);
        $data['orders'] = Order::report()->with("sale", "store")->paginate();
        return view('admin::report.payment_receipt', $data);
    }

    function paymentReceiptVoucherType(Request $request)
    {
        $data['orders'] = Order::report()->with("sale", "store")->paginate();
        return view('admin::report.payment_receipt.type', $data);
    }
    function profit()
    {
        return view('admin::report.profit');
    }
}
