<?php

namespace Modules\Admin\Model;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    protected $table = 'pages';
    protected $guarded = [];
    public static $api_type = "array";
    protected $api_fields = "name,slug, description,content";
    public static function boot()
    {
        parent::boot();
        self::created(function ($model) {
            self::updatePermalink($model);
        });
        self::updated(function ($model) {
            self::updatePermalink($model);
        });
    }
    public function scopeSearch($q, $params = [])
    {
        $request = request();
        if (request('keywords') || @$params['keywords']) {
            $keyword = "%" . (request('keywords')??$params['keywords']) . "%";
            $q = $q->where("name", "like", $keyword)->orWhere("description", "like", $keyword);
        }
        $q = $q->orderBy(request('sort_field')??"id", request('sort_order')??"desc");
        return $q;
    }

    public function scopeFillFields($q)
    {
        $q = $q->selectRaw($this->api_fields);
        return $q;
    }

    public static function updatePermalink($model)
    {
        try {
            $title  = $model->name;
            $key_request = request('key_title') == 'true' ? alias_name(mb_strtolower($title, 'UTF-8')) : alias_name($title);
            $data['key'] = $key_request;
            $key_check_exist = Pages::where("slug", $key_request)->where("id",$model->id)->count();
            $key_new = $key_request;
            if ($key_check_exist > 0) {
                $key_new =  $key_request . '-' . (intval(str_replace($key_request . "-", "", $key_check_exist)) + 1);
            }
            Md::save_data("pages",['slug'=>$key_new],$model->id);
        } catch (\Throwable $e) {
            write_log($e->getMessage(),"updatePermalink");
        }
    }
}
