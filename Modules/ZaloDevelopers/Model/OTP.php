<?php

namespace Modules\ZaloDevelopers\Model;

class OTP extends Base
{
    protected $table = 'otp';
    protected $guarded = [];

    public function scopeSearch($q, $params = [])
    {
        $request = request();
        $filter = $params['filter'];
        if (@$params['keywords']) {
            $keyword = "%" . (request('keywords')??$params['keywords']) . "%";
            $q = $q->where("phone", "like", $keyword)->orWhere("code", "like", $keyword);
        }

        if(@$filter['status']!="")
        {
            $q = $q->where("status",$filter['status']);
        }
        $q = $q->orderBy(request('sort_field')??"id", request('sort_order')??"desc");
        return $q;
    }
}
