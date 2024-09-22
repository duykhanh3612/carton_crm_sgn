<?php

namespace Modules\Admin\Model;

use Illuminate\Database\Eloquent\Model;

class Base extends Model
{
    protected $guarded = [];
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            // ... code here
        });

        self::created(function ($model) {
            // ... code here
        });
        self::updated(function ($model) {
            // ... code here
        });
    }
    public static function saveData($key = [], $data = [])
    {
        self::updateOrCreate($key, $data);
    }
    public static function scopeFilter($query, $request)
    {
        $noFilter = $request->get('no_filter');
        $filter = isset($noFilter) && is_array($noFilter) ? $noFilter : $request->filter;
        if (is_array($filter) && count($filter)) {
            foreach ($filter as $key => $item) {
                if (is_array($item) && count($item)) {
                    if ($item['from']) {
                        $query->where($key . ' >= "' . trim($item['from']) . ' 00:00:00"');
                    }
                    if ($item['to']) {
                        $query->where($key . ' <= "' . trim($item['to']) . ' 23:59:59"');
                    }
                } else {
                    $item = trim($item);
                    if ($item != '') {
                        if ($item == 'Yes' || $item == 'No') {
                            if ($item == 'Yes') {
                                $item = 1;
                            }
                            if ($item == 'No') {
                                $item = 0;
                            }
                            $query->where('(' . $key . ' LIKE "%' . $item . '%" OR ' . $key . ' = "' . $item . '")');
                        } else {
                            $query->where($key, 'like', $item);
                            if ($key == 'Status') {
                                $query->where($key, $item);
                            }
                        }
                    }
                }
            }
        }
        // $query->where('deleted', '0');
        $query->where('language_code', !empty($request->language_code) ? $request->language_code : 'vi');
        return $query;
    }

    public function scopeSearch($q, $params = [])
    {
        return $q;
    }

    public static function beforeUpdate($doc)
    {

    }
    public static function afterUpdate($doc)
    {

    }
}
