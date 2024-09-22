<?php

namespace Modules\Admin\Model\Product;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = 'product_category';
    protected $guarded = [];
    static $api_type = "array";
    public function scopeFillFields($q, $params = [])
    {
        if (request('keywords')) {
            $keyword = "%" . request('keywords') . "%";
            $q = $q->where("name", "like", $keyword);
        }
        return $q;
    }
    public function scopeSearch($q, $params = [])
    {
        if (request('keywords')) {
            $keyword = "%" . request('keywords') . "%";
            $q = $q->where("name", "like", $keyword);
        }
        return $q;
    }
    public static function checkExists($docs = [], $fields = [])
    {
        if(@$docs['id']!="")
        {
            $result['exist'] = false;
            return  $result;
        }
        $fields = ["name"];
        $where = [];
        foreach($fields as $key)
        {
            if($docs[$key]!="")
            {
                $where[] = $key." like '%".$docs[$key]."%'";
            }
        }
        if(!is_array($fields))
        {
            $fields = explode(",", $fields);
        }

        if(!empty($where))
        {
            $where = "(".implode(" or ", $where).")";
        }

        $result['exist'] =  self::whereRaw($where)->count()>0?true: false;
        $result['message'] = "Danh mục đã tồn tại";
        return  $result;
    }
}
