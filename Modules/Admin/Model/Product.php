<?php

namespace Modules\Admin\Model;

use Illuminate\Database\Eloquent\Model;
use \App\Model\base_model as Md;
use \Modules\Admin\Model\Order\OrderDetail;
use DB;
class Product extends Model
{
    protected $table = 'product';
    protected $guarded = [];
    protected $owner = "created_by";

    public static function boot()
    {
        parent::boot();

        // self::creating(function ($model) {
        //     // ... code here
        // });

        self::created(function ($model) {
            self::updateCode($model);
            self::updatePermalink($model);
        });

        // self::updating(function ($model) {
        //     // ... code here
        // });

        self::updated(function ($model) {
            if($model->sku=="")
            {
                self::updateCode($model);
            }
            self::updatePermalink($model);
        });

        // self::deleting(function ($model) {
        //     // ... code here
        // });

        // self::deleted(function ($model) {
        //     // ... code here
        // });
    }

    public function scopeSearch($q, $params = [])
    {
        $request = request();
        if (request('keywords') || @$params['keywords']) {
            $keyword = "%" . (request('keywords')??$params['keywords']) . "%";
            $q = $q->where(function($q) use ($keyword){
                $q->where("name", "like", $keyword)
                //->orWhere("description", "like", $keyword)
                ->orWhere("sku", "like", $keyword);
            });
        }
        if (request('product_category_id') || @$params['product_category_id']) {
            $product_category_id = (request('product_category_id')??$params['product_category_id']);
            $q = $q->where("product_category_id",   $product_category_id);
        }

        $q = $q->orderBy(request('sort_field')??"id", request('sort_order')??"desc");
        return $q;
    }
    public function scopeFilter($q, $params = [])
    {
        $request = request();
        if (request('keywords') || @$params['keywords']) {
            $keyword = "%" . (request('keywords')??$params['keywords']) . "%";
            $q = $q->where("name", "like", $keyword)
            // ->orWhere("description", "like", $keyword)
            ->orWhere("sku", "like", $keyword);
        }
        if (request('product_category_id') || @$params['filter']['product_category_id']) {
            $product_category_id = (request('product_category_id')??$params['filter']['product_category_id']);
            $q = $q->where("product_category_id",   $product_category_id);
        }

        if (request('min_price') > 0 and request('min_price')) {
            $q = $q->where("price", ">=", request("min_price"))->where("price", "<=", request('max_price'));
        }
        //Handel Owner
        // if (!isAdmin()) {
        //     $q->where($this->owner, auth()->user()->id);
        // }
        if ($request->sort_field != '') {
            $q->orderBy($request->sort_field, $request->sort_order);
        }
        return $q;
    }
    public function scopeApi($q, $type = "")
    {
        $q = $q->where('published', "1");
        return $q;
    }

    public function details()
    {
        return $this->hasMany(OrderDetail::class, "order_id", "id");
    }
    public static function renderCode()
    {
        $prefix = "HH";
        $id = DB::table('product')->max('id') + 1;
        $code = $prefix.str_pad($id, 6, '0', STR_PAD_LEFT);
        return $code;
    }
    public static function updateCode($model)
    {
        $id = $model->id;
        $prefix = "HH";
        $code = $prefix . str_pad($id, 6, '0', STR_PAD_LEFT);
        Md::save_data("product", ["sku" => $code], $id);
    }
    public static function updatePermalink($model)
    {
        try {
            $title  = $model->name;
            $key_request = request('key_title') == 'true' ? alias_name(mb_strtolower($title, 'UTF-8')) : alias_name($title);
            $data['key'] = $key_request;
            $key_check_exist = Product::where("slug", $key_request)->where("id",$model->id)->count();
            $key_new = $key_request;
            if ($key_check_exist > 0) {
                $key_new =  $key_request . '-' . (intval(str_replace($key_request . "-", "", $key_check_exist)) + 1);
            }
            // $model->update(['slug'=>$key_new]);
            // Estates::where("id",$model->id)->first()->update(['slug'=>$key_new]);
            Md::save_data("product",['slug'=>$key_new],$model->id);
        } catch (\Throwable $e) {
            write_log($e->getMessage(),"updatePermalink");
        }
    }

    public static function getOption()
    {
        return self::pluck("name","id")->toArray();
    }
    public static function updateLog($model, $title = "")
    {
        try {
            $time  = date("Y-m-d H:i:s");
            $data = [
                'product_id'=>$model->id,
                'user_id' => auth()->user()->id,
                'owner' => 'user',
                'user_name'  => auth()->user()->user_name,
                'user_full_name' => auth()->user()->full_name,
                'title' => $title
            ];
            ProductLog::create($data);
        } catch (\Throwable $e) {
            write_log($data,"EstateUpdateLog");
        }
    }

    public static function getBestSelling($limit = 10)
    {
        $q = new self();
        return $q->leftJoin('orders_detail', 'orders_detail.product_id', '=', 'product.id')
            ->whereIn("orders_detail.order_id",function($q)
            {
                $q->select("id")->from("orders")->where("deleted",0)->where("status","<>",5);
            })
                ->selectRaw('product.*, SUM(orders_detail.qty) AS quantity_sold')
                ->groupBy('product.id')
                ->orderByDesc('quantity_sold')
                ->limit($limit)->get();
    }
}
