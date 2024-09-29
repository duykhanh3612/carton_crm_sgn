<?php

namespace Modules\Admin\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Customer extends Model
{
    protected $table = 'customers';
    protected $guarded = [];
    protected $owner = "customers.created_by";
    public static function boot()
    {
        parent::boot();
        self::created(function ($model) {
            self::updateCustomerCode($model);
        });
    }
    public static function getCustomerCode()
    {
        $prefix = "KH";
        $id = DB::table('customers')->max('id') + 1;
        $code = $prefix . str_pad($id, 6, '0', STR_PAD_LEFT);
        return $code;
    }
    public static function updateCustomerCode($model)
    {
        DB::table('customers')->where('id', $model->id)->update(['code' => self::getCustomerCode()]);
    }
    public function scopeFilter($q, $params = [])
    {
        $request = request();
        if (request('keywords')) {
            $keyword = "%" . request('keywords') . "%";
            $q = $q->where("full_name", "like", $keyword)->orWhere("phone", "like", $keyword)
                ->orWhere("address", "like", $keyword)
                ->orWhere("customers.code", "like", $keyword);
        }

        //Extend query
        $q = $q->leftjoin("orders", function($q)
        {
            $q->on('orders.customer_id', '=', 'customers.id')->where(DB::raw('orders.deleted'), 0)->where("orders.status",'<>',5);
        });


        $q = $q->selectRaw("max(orders.created_at) as last_purchase ,  sum(orders.total) as total_amount_of_goods , customers.*")->groupBy("customers.id");

        //Handel Owner
        if (!isAdmin() && isset($this->owner)) {
           // $q->where($this->owner, auth()->user()->id);
        }
        $q->where("customers.deleted", 0);

        //Handel Sort
        if ($request->sort_field != '') {
            $q->orderBy($request->sort_field, $request->sort_order);
        }

        return $q;
    }

    function basket()
    {
        return $this->hasMany(Order::class, "customer_id", "id");
    }
    public static function getOption()
    {
        $customers = self::pluck("full_name", "id")->toArray();
        $customerWeb =  self::whereNull("full_name")->get();
        foreach ($customerWeb as $customer) {
            $customers[$customer->id] = $customer->phone;
        }
        return $customers;
    }

    public static function getFullOption()
    {
        $customers = self::where("deleted",0)->get();
        // $customerWeb =  self::whereNull("full_name")->get();
        $arr = [];
        foreach ($customers as $customer) {
            $arr[$customer->id] = $customer->full_name!=""?$customer->full_name .' - '. $customer->phone:$customer->phone;
        }
        return $arr;
    }
    public static function checkExists($docs = [], $fields = [])
    {
        $fields = ["phone"];
        $where = [];
        $message = [];
        $exist = false;
        foreach($fields as $key)
        {
            if($docs[$key]!="")
            {
                $where = $key." like '%".$docs[$key]."%'". (@$docs['id']!=""?" and id <> '".@$docs['id']."'":"");
                if(self::whereRaw($where)->count()>0)
                {
                    $exist = true;
                    $message[] = __($key). ' đã tồn tại';
                }
            }
        }

        $result['exist'] =  $exist;
        $result['message'] = implode(", ", $message);
        return  $result;
    }
}
