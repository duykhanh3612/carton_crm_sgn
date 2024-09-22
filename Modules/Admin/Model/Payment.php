<?php

namespace Modules\Admin\Model;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'orders';
    protected $guarded = [];
    public function scopeFilter($q, $params = [])
    {
        if (request('keywords')) {
            $keyword = "%" . request('keywords') . "%";
            $q = $q->where(function($query) use($keyword){
                $query->where("code", "like", $keyword)->orWhereIn("customer_id",function($q) use($keyword){
                        $q->select("id")->from("customers")->where("full_name", "like", $keyword)
                        ->orWhere("phone", "like", $keyword)
                        ->orWhere("code", "like", $keyword);
                });
            });
        }


        if(isset($params['payment_type']))
        {
            $q = $q->where("payments_type", $params['payment_type']);
        }
        if(isset($params['cashier']))
        {
            $q = $q->where("cashier", $params['cashier']);
        }
        if(isset($params['saler_id']))
        {
            $q = $q->where("saler_id", $params['saler_id']);
        }

        if (isset($params['created_at']['form']) && isset($params['created_at']['to'])) {

            $q = $q->where("created_at", ">=", $params['created_at']['form'] . " 00:00:00");
            $q = $q->where("created_at", "<=", $params['created_at']['to'] . " 23:59:59");
        }

        $q = $q->where("deleted", 0);
        if(!empty(request("sort_field")))
        {
            $q = $q->orderByRaw("orders.id desc");
        }
        else{
            $q = $q->orderBy(request("sort_field")??"id",request("sort_order")??"desc");
        }
        return $q;
    }
}
