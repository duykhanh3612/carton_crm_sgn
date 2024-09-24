<?php

namespace Modules\Api\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Admin\Model\Order;
use Modules\Admin\Model\OrderStatus;
use Modules\Admin\Model\Product;
use Modules\Admin\Model\Order\OrderDetail;
use Modules\Admin\Model\OrderLog;
use Modules\Admin\Model\Shipment;
use Modules\Admin\Model\Customer;
use Illuminate\Routing\Controller;
use DB;
use App\Helpers\LogHelper;
use Modules\Admin\Model\GeoDistrict;
use Modules\Admin\Model\GeoProvince;
class OrderController extends Controller
{
    public function createOrder(Request $request)
    {
        try{
            if(empty($request->details))
            {
                get_response_code(false, response_bad_request, $result);
                $result['data'] = "Invalid order";
                return response()->json($result);
            }
            $orders  = [];
            $totalQty = 0;
            $vat = 0;
            $subTotal = 0;
            $discount = 0;
            foreach($request->details as $r)
            {
                $r = (object)$r;
                $product = Product::where("id",$r->product_id)->first();
                $d = [
                    'qty' => $r->qty,
                    'sku' => $r->sku,
                    'product_id' => $r->product_id,
                    'description' => @$product->name,
                    'unit_price' =>  $product->price,
                    'total_price'=> $product->price * intval($r->qty)

                ];
                $orders[] = $d;
                $subTotal +=   $d['total_price'];
                $totalQty += $d['qty'];
            }
            $shipment = Shipment::getFee($request->shipping_district, $subTotal);

            if($request->save_invoice_info)
            {
                $info_invoice['company_name'] = $request->company_name;
                $info_invoice['company_taxcode'] = $request->company_taxcode;
                $info_invoice['company_email'] = $request->company_email;
                $info_invoice['company_address'] = $request->company_address;
                Customer::where("id", auth('api')->user()->id)->first()->update($info_invoice);
            }
            $customer =  Customer::where("id", auth('api')->user()->id)->first();
            if($customer-> full_name=="")
            {
                $customer-> full_name  = @$request->receiver_name;
            }
            if($customer-> phone=="")
            {
                $customer->phone  = @$request->receiver_phone;
            }
            if($customer-> email=="")
            {
                $customer->email  =  @$request->receiver_email;
            }
            if($customer-> address=="")
            {
                $customer->address  =  @$request->shipping_address;
            }
            $customer->save();

            \App\Helpers\LogHelper::write($shipment,"Shipment");
            $data = [
                'code'=> $this->renderCode(),
                'subTotal' => $subTotal,
                'payments_type' => $request->payments_type,
                'discount_code' => $request->discount_code,
                'discount_value' =>$request->discount_value,
                'shipping_fee' => intval(@$shipment['fee']),
                'shipping_province' => ($request->shipping_province=="other"?"other":79),
                'shipping_district' => $request->shipping_district,
                'shipping_address' => $request->shipping_address,
                'request_invoice'  => $request->request_invoice,
                'receiver_name' => @$request->receiver_name?? @$customer->full_name,
                'receiver_phone' => @$request->receiver_phone??@$customer->phone,
                'receiver_email' => @$request->receiver_email??@$customer->email,
                'company_name'  => $request->company_name,
                'company_taxcode'  => $request->company_taxcode,
                'company_email'  => $request->company_email,
                'company_address'  => $request->company_address,
                'customer_id' => auth('api')->user()->id,
                'qty' =>             $totalQty,
                'total' => $subTotal - intval($request->discount_value) + intval(@$shipment['fee']),
                'status' => 1,
                'type' => 2
            ];
            \App\Helpers\LogHelper::write($data,"DAta");
            $order = Order::create($data);
            foreach($orders as $r)
            {
                $r['order_id'] = $order->id;
                OrderDetail::create($r);
            }
            $records = $order;
            $order->details = $orders;

            //Upload Log
            $customer = Customer::where("id", auth('api')->user()->id)->first();
            Order::updateSummary($order);
            OrderLog::updateLog( $order, "đã tạo đơn hàng ". $order->code, "customer", $customer);

            $result['data'] =  $records;
            $result['code'] = 200;
            $result['success'] = true;
            return response()->json($result, 200, ['Content-type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }
        catch(\Throwable $e)
        {
            LogHelper::write($e->getMessage(),"Api::createOrder");
            $result['code'] = 201;
            $result['success'] = false;
            return response()->json($result, 200, ['Content-type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }

    }
    public function getHistory(Request $request)
    {
        $customer_id =auth('api')->user()->id;
        $records = Order::with("details","customer")->filter()->where('customer_id',$customer_id)->paginate(20);
        $status  = OrderStatus::pluck("name","id")->toArray();
        $payment_type = get_options_keynum_data("payment_type");
        $records->transform(function($item)use($status, $payment_type){
            $customer =  collect($item->customer)->only(['address','full_name','phone','shipping_address']);
            unset($item->customer);
            $item->customer = $customer;
            $item->status_name = @$status[$item->status];
            $item->payments_type_name = @$payment_type[$item->payments_type];

            $item->shipping_province_name = GeoDistrict::where("id",$item->shipping_district)->first()->name;
            $item->shipping_district_name = GeoProvince::where("id",$item->shipping_district)->first()->name;
            return $item;
        });

        $result['data'] =  $records;
        $result['code'] = 200;
        $result['success'] = true;
        return response()->json($result, 200, ['Content-type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }
    function renderCode()
    {
        $prefix = "PX";
        $id = DB::table('orders')->max('id') + 1;
        $code = $prefix.str_pad($id, 6, '0', STR_PAD_LEFT);
        return $code;
    }
    function getCodeOrder()
    {
        $prefix = "PX";
        $id = DB::table('orders')->where('id')->max('id') + 1;
        $code = $prefix.str_pad($id, 6, '0', STR_PAD_LEFT);
        $result['data'] =  $code ;
        $result['code'] = 200;
        $result['success'] = true;
        return response()->json($result, 200, ['Content-type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }

    function shipment()
    {
        $district = request("district_id");
        $price = request("price");
        if($district == "")
        {
            $shipment =[
                'name' => "Khác",
                'fee' =>  $price * 0.1
            ];
        }
        else{
            $shipment = Shipment::where("district_id","like",'%"'.$district.'"%')->where("price_from","<=",$price)->where("price_to",">=",$price)->first();
            $shipment->district_id = json_decode($shipment->district_id);
        }
        $result['data'] =  $shipment ;
        $result['code'] = 200;
        $result['success'] = true;
        return response()->json($result, 200, ['Content-type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);

    }
}
