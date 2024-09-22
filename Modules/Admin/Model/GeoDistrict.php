<?php

namespace Modules\Admin\Model;

use Illuminate\Database\Eloquent\Model;

class GeoDistrict extends Model
{
    protected $table = 'geo_district';
    protected $guarded = [];

    public static $api_type = "array";
    protected $api_fields = "id, name,type, name,province_id,province_name";

    public function scopeFillFields($q)
    {
        $q = $q->selectRaw($this->api_fields);
        $q = $q->where("province_id", 79);
        return $q;
    }
}
