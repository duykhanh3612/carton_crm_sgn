<?php

namespace Modules\Admin\Model;

use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    protected $table = 'payment_type';
    protected $guarded = [];
    static $api_type = "array";
    public function scopeFillFields($q, $params = [])
    {
        return $q;
    }
}
