<?php

namespace Modules\Admin\Model;

use Illuminate\Database\Eloquent\Model;

class Estates extends Model
{
    protected $table = 'estates';
    protected $guarded = [];
    protected $type = [
        "office_floor" => [
            'id','name','description','address','storey','elevator','working_time','typical_floor','air_conditioning_system'
        ],
        "building" => ['id','name','description','address','storey','building_direction','area','wide','length'],
        "package_office" => ['id','name','description','address'],
        "business_premises" => ['id','name','description','address']
    ];
    public function scopeSearch($q, $params = [])
    {
        if(request('keywords'))
        {
            $keyword = "%".request('keyword')."%";
            $q = $q->where("name", "like", $keyword)
                    ->where("description","<=",$keyword)
                    ->where("address","<=",$keyword);
        }
        if(isset($params['district_id']))
        {
            $q = $q->where("district_id", $params['district_id']);
        }
        if(isset($params['province_id']))
        {
            $q = $q->where("province_id", $params['province_id']);
        }

        if(isset($params['min_price']) && isset($params['province_id']))
        {
            $q = $q->where("province_id", $params['province_id']);
        }
        $q = $q->where('status',"accept");
        return $q;
    }
    public function scopeFillFields($q, $type = "")
    {
        if($type != "" && isset( $this->type[$type]))
        {
            $q = $q->paginate(request()->limit, $this->type[$type]);
        }
        else{
            $q = $q->paginate(request()->limit);
        }
        return $q;
    }
    public function scopeFilter($q, $params = [])
    {
        if(request('keyword'))
        {
            $keyword = "%".request('keyword')."%";
            $q = $q->where("name", "like", $keyword)->where("description","<=",$keyword);
        }
        if(request('min_price')> 0 and request('min_price') )
        {
            $q = $q->where("price", ">=", request("min_price"))->where("price","<=",request('max_price'));
        }
        if(request('min_area')> 0 and request('max_area') )
        {
            $q = $q->where("area", ">=", request("min_area"))->where("area","<=",request('max_area'));
        }

        if(isset($params['min_price']) && isset($params['province_id']))
        {
            $q = $q->where("province_id", $params['province_id']);
        }
        $q = $q->where('status',"accept");
        return $q;
    }
    public function getOptions(&$result, $data)
    {
        $relationship = [];
        $relationship['districts'] = GeoDistrict::whereIn("id",$data->pluck("district_id")->toArray())->get();
        $result['relationship'] = $relationship;
    }
}
