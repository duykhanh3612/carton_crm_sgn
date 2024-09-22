<?php

namespace Modules\Admin\Model\Order;

use Illuminate\Database\Eloquent\Model;

use Modules\Admin\Model\Product;
class OrderDetail extends Model
{
    protected $table = 'orders_detail';
    protected $guarded = [];
    public function scopeReport($q, $params = [])
    {
        return $q;
    }
    public function scopeReportToday($q, $params = [])
    {
        $q = $q->where("created_at", "like", date("Y-m-d") . "%");
        $q->whereIn("order_id", function ($q) {
            $q->select("id")->from("orders")->where("deleted", 0)->where("status", "<>", 5);
        });
        return $q;
    }
    public function product()
    {
        return $this->BelongsTo(Product::class, "product_id", "id");
    }
}
