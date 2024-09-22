<?php

namespace Modules\Admin\Model;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $table = 'shipment';
    protected $guarded = [];
    protected $owner = "created_by";
    public function scopeFilter($q, $params = [])
    {
        $keyword = "%" . request('keywords') . "%";
        $q = $q->where("name", "like", $keyword);
        return $q;
    }

    public static function getFee($district_id, $price)
    {
        $district = $district_id;
        $price = $price;
        if($district == "" || $district == 0)
        {
            $shipment =[
                'name' => "Khác",
                'fee' =>  $price * 0.1
            ];
        }
        else{
            $shipment = Shipment::where("district_id","like",'%"'.$district.'"%')->where("price_from","<=",$price)->where("price_to",">=",$price)->first()->toArray();
            if(!empty($shipment))
            {
                $shipment['district_id'] = json_decode($shipment['district_id']);
            }
            else{
                $shipment =[
                    'name' => "Khác",
                    'fee' =>  $price * 0.1
                ];
            }
        }
        return $shipment;
    }
}
