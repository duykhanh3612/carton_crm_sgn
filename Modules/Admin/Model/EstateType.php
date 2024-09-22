<?php

namespace Modules\Admin\Model;

use Illuminate\Database\Eloquent\Model;

class EstateType extends Model
{
    protected $table = 'estate_type';
    protected $guarded = [];

    public static $api_type = "array";
    protected $api_fields = "slug,name";

    public function scopeFillFields($q)
    {
        $q = $q->selectRaw($this->api_fields);
        return $q;
    }
}
