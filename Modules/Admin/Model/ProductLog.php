<?php

namespace Modules\Admin\Model;

use Illuminate\Database\Eloquent\Model;

class ProductLog extends Model
{
    protected $table = 'product_log';
    protected $guarded = [];

    public static function updateLog($model, $title, $owner, $user )
    {
        $data = [
            'order_id'=> @$model->id,
            'owner' => $owner,
            'user_id' => @$user->id,
            'user_full_name' => @$user->full_name,
            'title' => $title
        ];
        try {
            $time  = date("Y-m-d H:i:s");
            OrderLog::create($data);
        } catch (\Throwable $e) {
            write_log($data,"EstateUpdateLog");
        }
    }
}
