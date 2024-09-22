<?php

namespace Modules\ZaloDevelopers\Model;

class OA extends Base
{
    protected $table = 'zalo_oa';
    protected $guarded = [];
    protected $endpoint = "https://openapi.zalo.me/v2.0/oa/getoa";
}
