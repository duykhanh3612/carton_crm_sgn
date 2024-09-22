<?php

namespace Modules\Admin\Model;

use Illuminate\Database\Eloquent\Model;

class GeoProvince extends Model
{
    protected $table = 'geo_province';
    protected $guarded = [];

    public static $api_type = "array";
    protected $api_fields = "name,type, name,province_id,province_name";

    public function scopeFillFields($q)
    {
        $q = $q->selectRaw($this->api_fields);
        return $q;
    }
}
