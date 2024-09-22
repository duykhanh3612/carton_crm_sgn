<?php

namespace Modules\Admin\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
use Schema;
use function GuzzleHttp\json_decode;

class Modules extends Model
{
    protected $table = 'modules';
    protected $guarded = [];
    protected $db;
    public function getCategoryList()
    {
        return convert_data(DB::select('select  t1.*,count(t2.cat) as brief from modules_categories as t1 left join modules as t2 on t1.id = t2.cat where t1.active = 1 and t1.deleted = 0 and t2.active = 1 and t2.deleted = 0 group by t2.cat'));
    }


    public function get_orders_status_type()
    {
        $ordersStatusType = get_data("orders_status_type", "active = '1' AND deleted = '0'", '**', '', '', "Name");
        $types = array_column($ordersStatusType, 'Name');
        $ordersStatus = DB::table("orders_status")
            ->select('id', 'color', 'color_text', 'StatusKey as key', 'name_vn as name', 'type')
            ->whereIn('type', $types)
            ->where('active', 1)
            ->where('deleted', 0)
            ->get();

        $data = [];
        foreach($ordersStatus as $value) {
            $data[$value->type][] = $value;
        }

        foreach ($ordersStatusType as $key => $type) {
            $ordersStatusType[$key]['name'] = $type['Name'];
            $ordersStatusType[$key]['status'] = !empty($data[$type['Name']]) ? json_encode($data[$type['Name']]) : '';
        }

        return $ordersStatusType;
    }

    public static function module_fields($table, $detail = false)
    {
        if ($detail) {
            $table = $table . '_details';
        }
        if (Schema::hasTable($table) ||  Schema::hasTable(strtolower($table))) {

            $cols = array();
            $query =   DB::select('SELECT COLUMN_NAME, COLUMN_COMMENT FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = "' . env("DB_DATABASE") . '" AND TABLE_NAME = "' . $table . '"');
            $fields = convert_data($query, true);
            foreach ($fields as $field) {
                $cols[$field['COLUMN_NAME']] = (object) array(
                    'show' => !$detail && $field['COLUMN_NAME'] != 'active' && $field['COLUMN_NAME'] != 'deleted',
                    'name' => !empty($field['COLUMN_COMMENT']) ? $field['COLUMN_COMMENT'] : $field['COLUMN_NAME'],
                    'detail' => $detail
                );
            }
            return (object) $cols;
        } else {

            return false;
        }
    }
    public static function getColumnOption($file, $field = "column_options", $type = '')
    {
        $options = self::where("file", $file)->first()->$field;
        if(empty($options))
        {
            return [];
        }
        $options = json_decode($options);
        if(!empty($type)) return $options->$type ?? '';
        return  $options;
    }
    public function used_file($file)
    {
        $this->db = DB::table("modules");
        $this->db->select('file');
        if ($file) {
            $this->db->where('file',"!=", $file);
        }
        $query = $this->db->get($GLOBALS['var']['act']);
        $used_file = array();
        if ($query->count() > 0) {
            foreach ($query as $file) {
                $used_file[] = $file->file;
            }
        }
        return $used_file;
    }
    public function getFirstCat(){

        $sql = "select t2.id from modules as t1 left join modules_categories as t2 on t1.cat = t2.id where t2.active=1 and t2.deleted =0 order by t2.id limit 1";
        return $this->db->query($sql)->row_array()['id'];

    }

    public function used_img($image)
    {
        $this->db->select('image');
        if ($image) {
            $this->db->where('image !=', $image);
        }
        $query = $this->db->get($GLOBALS['var']['act']);
        $used_image = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $image) {
                $used_image[] = $image['image'];
            }
        }
        return $used_image;
    }

    public function update_code($new_code, $id)
    {
        $old_code = '';
        if ($id > 0) {
            $old_code = get_data($GLOBALS['var']['act'], 'id = ' . $id, 'file');
        }
        if ($old_code != $new_code) {
            $this->db->query("UPDATE users SET user_rights = REPLACE(user_rights, '" . $old_code . "', '" . $new_code . "')");
        }
        return true;
    }

    public function update_rights()
    {
        $this->db->where('active', 1);
        $this->db->where('deleted', 0);
        $this->db->select('rights, file');
        $query = $this->db->get($GLOBALS['var']['act']);
        $all_right = $query->result_array();
        $user_rights = array();
        foreach ($all_right as $right) {
            $act = json_decode($right['rights']);
            if ($act->view) {
                $user_rights[$right['file']]['view'] = '1';
            }
            if ($act->edit) {
                $user_rights[$right['file']]['edit'] = '1';
            }
            if ($act->add) {
                $user_rights[$right['file']]['add'] = '1';
            }
            if ($act->del) {
                $user_rights[$right['file']]['del'] = '1';
            }
            if ($act->del) {
                $user_rights[$right['file']]['full'] = '1';
            }
        }
        if (is_array($user_rights) && count($user_rights)) {
            $this->db->where('id', 1);
            $this->db->update('users', array('user_rights' => json_encode($user_rights)));
            $this->db->where('id', 1);
            $this->db->update('usergroups', array('group_rights' => json_encode($user_rights)));
        }
    }
    public function cmsfix($id, $limit = '')
    {
        $this->db->from('cms_fix AS t1');
        $this->db->select('t1.*');
        $this->db->where('t1.module', $id);
        // $this->db->where('t1.active', 1);
        // $this->db->where('t1.deleted', 0);
        // $this->db->join('customers AS t2', 't1.CustomerAccount = t2.id', 'left');
        if ($limit) {
            $this->db->limit($limit);
        }
        $this->db->order_by('t1.id DESC');
        $query = $this->db->get();
//        echo $this->db->last_query();exit();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
    public static function get_items_by_module($module)
    {
        try {
            $module = self::where('file', $module)->first();
            $moduleId = @$module->id;
            $ci = DB::table("option_items");
            $result = $ci->selectRaw('id, Name as name, Field as field, module, Options as options')
                ->where('module like', '"%\"'. $moduleId .'\"%"')
                ->orWhere('module', $moduleId);
            return $result->get();
        } catch (\Throwable $e) {
            return $e;
        }
    }
    public static  function get_items_keynum_by_module($module, $option = [])
    {
        try {

            $module = self::where('file', $module)->first();
            $moduleId = @$module->id;
            $ci = DB::table("option_items_keynum");
            $result = $ci->selectRaw('id, Name as name, Field as field, Module as module, Options as options')
                ->where('module',"like", '%\"'. $moduleId .'\"%')
                ->orWhere('module', $moduleId)->orWhereNull("module");
            if(!empty($option['current'])) $result->orWhere('field', $option['current']);
            return $result->get();
        } catch (\Throwable $e) {
            return $e;
        }

    }
    public static function getCategory($category)
    {
        return ModulesCategories::where("id",$category)->first();
    }
    public static function getModuleRight()
    {
        $functions = GroupPermission::where("group_id", @auth()->user()->user_group_id)->where('read',1)->pluck("function_id")->toArray();
        return $functions;
    }

    public static function search_where($search, $where, $fields = [])
	{
		$tag = array();
		$flg_search = false;
        if(isset($search['keywords']) && !empty($fields ))
        {

            if(!is_array($fields))
            {
                $fields = explode(",", $fields);
            }
            foreach($fields as $key)
            {
                $where_keyword[] = $key." like '%".$search['keywords']."%'";
            }
            if(!empty($where_keyword))
            {
                $where .= " and (".implode(" or ", $where_keyword).")";
            }
        }
        unset($search['keywords']);
        unset($search['keyword']);
        unset($search['token']);
        unset($search['_']);

        if(!empty($search))
        {
            foreach ($search as $key => $value) {

                if (is_array($value)) {
                    switch (current(array_keys($value))) {
                        case 'timestamps_between': // key >= value_from and key <= value_to
                            $tmp_value = reset($value);
                            $from = @$tmp_value['from'];
                            $to = @$tmp_value['to'];
                            if ($from != '' & $to != '') {
                                $date = date_create($from);
                                $date_from  =  date_timestamp_get($date);
                                $date = date_create($to);
                                $date_to =  date_timestamp_get($date);
                                if ($date_from > 0 && $date_to > 0)
                                    $where .= sprintf(" and ( %s >= %s and %s<=%s )", $key, $date_from, $key, $date_to);
                            }
                            $tag['src'][$key]['from'] = $from;
                            $tag['src'][$key]['to'] = $to;
                            break;
                        case 'date_between': // key >= value_from and key <= value_to
                            $tmp_value = reset($value);
                            $from = @$tmp_value['from'];
                            $to = @$tmp_value['to'];
                            if ($from != "" && $to != "")
                                $where .= sprintf(" and ( DATEDIFF(%s,'%s') >=0 and DATEDIFF(%s,'%s')<=0 )", $key, $from, $key, $to);
                            else if ($from != "" && $to == "")
                                $where .= sprintf(" and ( DATEDIFF(%s,'%s') >=0 )", $key, $from);
                            else if ($from == "" && $to != "")
                                $where .= sprintf(" and ( DATEDIFF(%s,'%s') <=0 )", $key, $to);
                            else {
                            }
                            $tag['src'][$key]['from'] = $from;
                            $tag['src'][$key]['to'] = $to;
                            break;
                        case 'from':
                            if($value['from']!="" && $value['to']!="")
                            {
                                $from = date("Y-m-d", strtotime(str_replace("/","-",@$value['from'])));
                                $to = date("Y-m-d", strtotime(str_replace("/","-",@$value['to'])));
                                if ($from != "" && $to != "")
                                    $where .= sprintf(" and ( DATEDIFF(%s,'%s') >=0 and DATEDIFF(%s,'%s')<=0 )", $key, $from, $key, $to);
                                else if ($from != "" && $to == "")
                                    $where .= sprintf(" and ( DATEDIFF(%s,'%s') >=0 )", $key, $from);
                                else if ($from == "" && $to != "")
                                    $where .= sprintf(" and ( DATEDIFF(%s,'%s') <=0 )", $key, $to);
                                else {
                                }
                                $tag['src'][$key]['from'] = $from;
                                $tag['src'][$key]['to'] = $to;
                            }

                            break;
                        case 'datediff':
                            $tmp_value = reset($value);
                            $from = $tmp_value['from'];
                            $to = $tmp_value['to'];
                            if ($from != "" && $to != "")
                                $where .= sprintf(" and %s >= '%s' and %s <= '%s'", $key, $from, $key, $to);
                            break;
                        case 'like': // left [%value], right [valuey%] , both [ %value%],none [value]
                            $tmp_value = reset($value);
                            $match = key($tmp_value);
                            if (reset($tmp_value) != '')
                                $where .= sprintf(" and %s like '%s" . reset($tmp_value) . "%s' ", $key, ($match == 'both' || $match == 'left' ? '%' : ''), ($match == 'both' || $match == 'right' ? '%' : ''));
                            $tag['src'][$key] = $tmp_value;
                            if (trim(reset($tmp_value)) != '')
                                $flg_search = true;
                            break;
                        case 'and': // left [%value], right [valuey%] , both [ %value%],none [value]
                            $tmp_value = reset($value);
                            foreach ($tmp_value as $k => $v)
                                if ($v != "")
                                    $where .= sprintf(" and LOWER(%s) like '%s" . $v . "%s' ", $key, '%', '%');
                            break;
                        case 'between':
                            $tmp_value = reset($value);
                            $from = @$tmp_value['from'];
                            $to = @$tmp_value['to'];
                            if ($from != '' & $to != '')
                                $where .=  sprintf(" and ( %s >= %s and %s <= %s )", $key, $from, $key, $to);
                            else if ($from != '' & $to == '')
                                $where .=  sprintf(" and ( %s >= %s )", $key, $from);
                            else if ($from == '' & $to != '')
                                $where .=  sprintf(" and (  %s <= %s )", $key, $to);
                            else {
                            }
                            $tag['src'][$key]['from'] = $from;
                            $tag['src'][$key]['to'] = $to;
                            break;
                        case 'latlng':
                            $lat_lang_key = explode(',', $key);
                            $tmp_value = reset($value);
                            $lat = $tmp_value['lat'];
                            $lng = $tmp_value['lng'];
                            if ($lat != '' && $lng != '')
                                $where .=  sprintf(" and (  %s like '%s' and %s like '%s' )", $lat_lang_key[0], '%' . $lat . '%', $lat_lang_key[1], '%' . $lng . '%');
                            $tag['src'][$key]['lat'] = $lat;
                            $tag['src'][$key]['lng'] = $lng;
                            break;
                        case 'lat_lng_check_null':
                            $lat_lang_key = explode(',', $key);
                            $tmp_value = reset($value);
                            if (reset($tmp_value) == '1')
                                $where .=  sprintf(" and (%s is null or %s='' or %s is null or %s='' )", $lat_lang_key[0], $lat_lang_key[0], $lat_lang_key[1], $lat_lang_key[1]);
                            $tag['src'][$key] = reset($tmp_value);
                            break;
                        case 'check_null':
                            $tmp_value = reset($value);
                            $match = key($tmp_value);
                            if (reset($tmp_value) == '1')
                                $where .= sprintf(" and (%s is null or %s='')", $key, $key);
                            $tag['src'][$key] = $tmp_value;
                            break;
                        case 'select_in':
                            $tmp_value = reset($value);
                            $match = key($tmp_value);
                            if (@$tmp_value['none']) {
                                if ($tmp_value['none'] == '1' && @$tmp_value['where'] != '')
                                    $where .= " and " . $tmp_value['where'];
                                if ($tmp_value['none'] == '2' && @$tmp_value['field'] != '')
                                    $where .= " and " . $tmp_value['field'];
                            }
                            $tag['src'][$key] = $tmp_value;
                            break;
                        case 'third_module_text':
                            $tmp_value = reset($value);
                            $value = reset($tmp_value);
                            $match = key($tmp_value);
                            $attr = explode('#', $match);
                            $table = $attr[0];
                            $field_key = $attr[1];
                            $field = $attr[2];
                            $where .=  sprintf(" and %s in (select %s from %s where `%s` like  '%s')", $field, $field_key, $table, 'name', '%' . $value . '%');
                            $tag['src'][$key]['third_module_text'] = $value;
                            break;
                        case 'third_module_public_value':
                            $tmp_value = reset($value);
                            $value = reset($tmp_value);
                            $match = key($tmp_value);
                            $attr = explode('#', $match);
                            $table = $attr[0];
                            $field_key = $attr[1];
                            $field = $attr[2];
                            if ($value != '')
                                $where .=  sprintf(" and %s %s (select %s from %s)", $field, ($value == 1 ? "in" : "not in"), $field_key, $table);
                            $tag['src'][$key]['third_module_public_value'] = $value;
                            break;
                        case 'no':
                            break;
                        default:
                            //echo 'defautl';
                            break;
                    }
                } else {
                    if ($value != "")
                        $where .= sprintf(" and %s like '%s'", $key, $value);
                    $tag['src'][$key] = $value;
                }
            }
        }
		$tag['where'] = $where;
		$tag['flg']  = $flg_search;
		// $this->view->assign( 'tag', $tag );
		return $tag;
	}

    public static function getRenderCode($module)
    {
        $prefix = $module->acronyms;
        $table = $module->prefix != ""? $module->prefix: $module->file;
        $id = \DB::table( $table)->max('id') + 1;
        $code = $prefix.str_pad($id, 6, '0', STR_PAD_LEFT);
        return $code;
    }

    public static function sideBar()
    {
        $cats = \Modules\Admin\Model\Modules::where("api",1)->orderBy("sort_order")->where("cat","<>","99")->get()->groupBy("cat");
        $modules_group = \Modules\Admin\Model\ModulesCategories::pluck("name_vn","id")->toArray();
        $side_bar = [];
        $group =[];

        foreach($cats as $cat => $modules)
        {
            if(count($modules)==1){
                foreach($modules as $module){

                    $side_bar[] = [
                        "key" => "purchase-proposals",
                        "label" => '<NavLink to="/">'.$module->name_vn.'</NavLink>',
                        "icon" => "React.createElement(".$module->image.")"
                    ];
                }
            }
            else{
                $node= [
                    "key" => \Arr::get($modules_group, $cat.".key"),
                    "label" => \Arr::get($modules_group, $cat.".name_vn"),
                    "icon" => "React.createElement(".\Arr::get($modules_group,$cat.".img").")"
                ];
                foreach($modules as $module){
                    $node['children'][] = [
                        "key" => "purchase-proposals",
                        "label" => '<NavLink to="/">'.$module->name_vn.'</NavLink>'
                    ];
                }
                $side_bar[] = $node;
            }

        }
    }
    public static function getLeftMenu()
    {
        $group = auth()->user()->user_group_id;
        $user_id = $group = auth()->user()->id;
        $query = \Modules\Admin\Model\UsersPermission::where("user_id", auth()->user()->id);

        $permission =  $query->get()->keyBy("function_key");
        $list_funcs =  $query->pluck("function_id")->toArray();
        $function = \Modules\Admin\Model\Modules::whereIn("id",$list_funcs)->pluck("name_vn","file")->toArray();

        $modules = \Modules\Admin\Model\Modules::selectRaw("id,name_vn,cat,image,file")->orderBy("sort_order")
            ->where("cat","<>","99")->where("menu",1)
            ->whereIn("id",function($q)use($user_id){
                $q->select("function_id")->from("v_user_permission")->where("user_id", $user_id)->where("read",1);
            })
            ->get();
        $modules_group = \Modules\Admin\Model\ModulesCategories::get()->keyBy("id")->toArray();
        $side_bar = [];
        $group =[];

        foreach($modules as $module){

            if($module->cat == 0)
            {
                $side_bar[] = [
                    "file" => $module->file,
                    "label" => '<a href="/'.$module->file.'">'.$module->name_vn.'</a>',
                    "name" => $module->name_vn,
                    "image" => $module->image
                ];
            }
            else{
                $key =\Arr::get($modules_group, $module->cat.".id");
                $index = array_search('cat_'.$key, array_column($side_bar, 'file'));
                if($index === false)
                {
                    $side_bar[] = [
                        "file" => 'cat_'.\Arr::get($modules_group, $module->cat.".id"),
                        "label" => \Arr::get($modules_group, $module->cat.".name_vn"),
                        "name" => \Arr::get($modules_group, $module->cat.".name_vn"),
                        "image" => \Arr::get($modules_group,$module->cat.".image"),
                        "children" => [
                            [
                                "file" => $module->file,
                                "label" => '<a href="/'.$module->file.'">'.$module->name_vn.'</a>',
                                "image" => $module->image,
                                "name" => $module->name_vn,
                            ]
                        ]
                    ];
                }
                else{
                    // $index = array_search($key, array_column($side_bar, 'file'));
                    $side_bar[$index]['children'][] = [
                        "file" => $module->file,
                        "label" => '<a href="/'.$module->file.'">'.$module->name_vn.'</a>',
                        "image" => $module->image,
                        "name" => $module->name_vn,
                    ];
                }

            }
        }

        return $side_bar;
    }

    public static function getModuleFunction($module, $group = null)
    {
        $query = ModuleFunction::where('module', $module);
        $query->leftjoin("groups_function_permission as p",function ($q) use($group) {
            $q->on("p.module_function_id","=","modules_function.id")->where('group_id',$group);
        });
        $query->selectRaw("modules_function.*,p.read,p.create,p.update,p.delete,p.full");
        $functions =  $query->get();
        return $functions;
    }
}
