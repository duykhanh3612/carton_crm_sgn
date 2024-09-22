<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Admin\Model\Order;
use Modules\Admin\Model\Order\OrderDetail;
use Modules\Admin\Model\Product;
use Modules\Admin\Model\Product\ProductCategory;
use Modules\Plugin\Entities\Themes;
class DashboardController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->route = 'admin.' . request()->segment(2);
        $this->slug = request()->segment(2);
    }
    public function index(Request $request)
    {
        $summary['total' ]= Order::reportToday()->sum('total');
        $summary['total_order' ]= Order::reportToday("in_day")->count();
        $summary['saleOrder' ]= Order::reportToday("in_day")->where('status',1)->count();
        $summary['total_order_detail' ]= OrderDetail::reportToday()->count();

        $list = ['week','last_week','month','last_month'];
        foreach($list as $type)
        {
            $total  = Order::summary(['type'=>$type])->sum('total');
            $order = intval(Order::summary(['type'=>$type])->count());
            $summary['work'][$type]['total']= number_format( $total);
            $summary['work'][$type]['total_order']= number_format( $order);
            $avg =  $order==0?0:$total/$order;
            $summary['work'][$type]['avg']= number_format($avg);
        }
        $summary['total_product' ]= Product::count();
        $summary['total_cate' ]= ProductCategory::count();
        $summary['total_product_original_price_null' ]= Product::whereNull('original_price')->count();
        $summary['total_product_price_null' ]= Product::whereNull('price')->count();
        $summary['total_product_no_cate' ]= Product::whereNull('product_category_id')->count();

        $summary['total_order_ship_confirm' ]= Order::reportToday()->where("status","2")->count();
        $summary['total_order_ship_delivery' ]= Order::reportToday()->where("status","3")->count();
        $data['summary'] = (object)$summary;
        $data['report_revenue'] = [
            'week'=> Order::getWeeklySales("", "string"),
            'last_week' => Order::getWeeklySales("last_week", "string")
        ];
        return Themes::render('admin::dashboard.v2', $data);
    }
}
