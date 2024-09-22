<?php

namespace Modules\Admin\Model;

use Illuminate\Database\Eloquent\Model;

class ModulesCategories extends Model
{
    protected $table = 'modules_categories';
    protected $guarded = [];


    public static function getCategories()
    {
        $results = self::orderBy("sort_order")->get();
        $results->transform(function($item)
        {
            $modules = Modules::where("cat", $item->id)->where('deleted', '0')->where('active', '1')->orderBy("sort_order")->get();
            if(count($modules) > 0)
            {
                $item->items =  $modules;
                return $item;
            }
           
        });

        $others = Modules::where("cat", 0)->orderBy("sort_order")->get();
        if(!empty($others))
        {
            $category  = [
                "name_vn" => "Other"
            ];
            $category['items']  = $others;
            $results[]  = (object)$category;
        }
        return  $results;
    }
}
