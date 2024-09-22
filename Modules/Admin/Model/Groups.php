<?php

namespace Modules\Admin\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Groups extends Model
{
    protected $table = 'groups';
    protected $guarded = [];
    public static function boot()
    {
        parent::boot();
        self::created(function ($model) {
            self::updatePermission($model);
        });
        self::updated(function ($model) {
            self::updatePermission($model);
        });
    }
    public function scopeSearch($q, $params = [])
    {
        if(!env("APP_DEBUG"))
        {
            $q = $q->where("hidden","<>",1)->orWhereNull("hidden");
        }
        if (request('keywords') || @$params['keywords']) {
            $keyword = "%" . (request('keywords')??$params['keywords']) . "%";
            $q = $q->where("name", "like", $keyword);
        }
        $filter = $params['filter'];
        if (@$filter['keywords']) {
            $keyword = "%" . $filter['keywords'] . "%";
            $q = $q->where("name", "like", $keyword);
        }
        $q = $q->orderBy(request('sort_field')??"id", request('sort_order')??"desc");
        return $q;
    }
    public static function check_right($group, $function)
    {
        $per  = GroupPermission::where("group_id",$group)->where("function_id", $function)->first();
        if(!empty($per) && $per->read)
        {
            return true;
        }
        return false;
    }
    public static function updatePermission($model)
    {
        $permission = $model->permission;
        $modules = Modules::get()->keyBy("id");
        $funcs  = [];
        if ($permission != "") {
            if (!is_array($permission)) {
                $permission = json_decode($permission);
            }

            foreach ($permission as $p) {
                $p = (object)$p;
                GroupPermission::updateOrCreate(
                    [
                        'group_id' => $model->id,
                        'function_id' => $p->function_id
                    ],
                    [
                        'group_name' => $model->name,
                        'function_name' => @$modules[$p->function_id]->name_vn,
                        'function_key' => @$modules[$p->function_id]->file,
                        'read' => boolval(@$p->pread),
                        'create' => boolval(@$p->pcreate),
                        'update' => boolval(@$p->pupdate),
                        'delete' => boolval(@$p->pdelete),
                        'full' => boolval(@$p->pfull)
                    ]
                );
                $funcs[] = @$modules[$p->function_id]->name_vn;
            }
        }
        DB::table('groups')->where('id', $model->id)->update(['permission_name' => implode(", ", $funcs)]);


        $permission = $model->function_permission;
        $modules = Modules::get()->keyBy("id");
        $funcs  = [];
        if ($permission != "") {
            if (!is_array($permission)) {
                $permission = json_decode($permission);
            }

            foreach ($permission as $p) {
                $p = (object)$p;
                GroupFunctionPermission::updateOrCreate(
                    [
                        'module_function_id' => $p->module_function_id,
                        'group_id' => $model->id,
                        'function_id' => $p->function_id
                    ],
                    [
                        'module_function_name' => $p->module_function_name,
                        'group_name' => $model->name,
                        'function_name' => @$modules[$p->function_id]->name_vn,
                        'function_key' => @$modules[$p->function_id]->file,
                        'read' => boolval(@$p->pread),
                        'create' => boolval(@$p->pcreate),
                        'update' => boolval(@$p->pupdate),
                        'delete' => boolval(@$p->pdelete),
                        'full' => boolval(@$p->pfull)
                    ]
                );
                $funcs[] = @$modules[$p->function_id]->name_vn;
            }
        }
    }
    public static function checkExists($docs = [], $fields = [])
    {
        if(@$docs['id']!="")
        {
            $result['exist'] = false;
            return  $result;
        }
        $fields = ["name"];
        $where = [];
        foreach($fields as $key)
        {
            if($docs[$key]!="")
            {
                $where[] = $key." like '%".$docs[$key]."%'";
            }
        }
        if(!is_array($fields))
        {
            $fields = explode(",", $fields);
        }

        if(!empty($where))
        {
            $where = "(".implode(" or ", $where).")";
        }

        $result['exist'] =  self::whereRaw($where)->count()>0?true: false;
        $result['message'] = "Nhóm đã tồn tại";
        return  $result;
    }
}
