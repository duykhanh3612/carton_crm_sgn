<?php

namespace Modules\Modules\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Admin\Model\Customer;
use Illuminate\Support\Facades\DB;
use Schema;
use App\Models\FnModel;
use Modules\Admin\Model\Modules;
use Modules\Admin\Model\PremaLink;
use Modules\Plugin\Entities\Themes;
use App\Model\base_model;
class ModulesController extends BaseController
{
    protected $route = "admin.customer";
    protected $config;
    protected $Mod;
    protected $uri_arr;
    protected $uri_str;
    protected $fn;
    public function __construct()
    {
        $this->Mod = new Modules();
        $this->fn = new FnModel();
        $this->fn->load_config("modules");
        $this->table = $this->module->prefix ?? "modules";

        $this->module = ['name_vn'=>"Modules"];
        view()->share("module", $this->module);
        parent::__construct(['module'=>"modules"]);
    }
    function index(Request $request)
    {
        $GLOBALS['var']['sidebar_collapsed'] = false;
        $cat = request('cat', true);
        $cat = ($cat) ? $cat : $this->Mod->getFirstCat();
        $this->uri_arr['cat'] = $cat;

        $num_rows =  0;//$this->fn->show($this->uri_arr, true);

        $data = array(
            'updated' =>@ $this->updated,
            'failed' => @$this->failed,
            'name' => @$this->name,
            'uri_str' => $this->uri_str,
            'url_update' => url('admin/modules/update'),
            'rows' => Modules::get(),//$this->fn->show($this->uri_arr),
            'filter' => request('filter', true),
            'cat' => $cat
        );
        $data['category_list'] = $this->Mod->getCategoryList();
        $data['fields'] = $this->fn->module_fields($GLOBALS['var']['act']);
        $data['cols'] = json_decode(get_data('modules', 'file = "' . $GLOBALS['var']['act'] . '"', 'column_options'));
        if (!$data['cols']) {
            $data['cols'] = $data['fields'];
        }


        // dynamic option field
        $options = array();
        foreach ($data['cols'] as $key => $col) {
            if (@$col->filter && @$col->filter == "select")
                $options[$key] = $this->fn->getOption($key);
        }
        $data['options'] = $options;

        $header = array(
            'title' => module_title(),
            'add_link' => current_url() . '/update',
            'search' => true,
            'page_list' => '',
            'datetime_picker' => false,
            'submit_btn' => false,
            'page_list' => page_list($num_rows, $this->uri_arr),
            'uri' => $this->uri_arr,
            'cat_list' => array(),
            'act' => $GLOBALS['var']['act'],
            'do' => $GLOBALS['var']['do'],
            'id' => $GLOBALS['var']['id'],
            // 'filter_cat' => $GLOBALS['var']['filter_cat']
        );
        return Themes::render('modules::modules.index', $data);

    }
    public function update($id = null)
    {
        // if ((!$id && !$GLOBALS['per']['add']) || ($id && !$GLOBALS['per']['edit'])) {
        //     my_redirect($GLOBALS['var']['act']);
        // }
        // $this->load->helper('directory');
        $info = !empty($id) ? $this->fn->info($id) : [];
        $data = array(
            'info' => $info,
            'rights' => !empty($info['rights']) ? json_decode($info['rights']) : [],
            // 'updated' => $this->updated,
            // 'name' => $this->name,
            'action' => site_url($GLOBALS['var']['act'] . '/process') . $this->uri_str,
            'category_list' => $this->fn->show(array('active' => 1, 'deleted' => 0), false, 'sort_order desc', $GLOBALS['var']['act'] . '_categories'),
            'streams' => !empty($info['file']) ? get_data("modules_streams", ["module" => $info['file']], "**") : []
        );
        // Xu ly danh sach module file
        // $used_file = $this->Mod->used_file($info['file']);
        // $files = directory_map('application/controllers');
        // $controllerPath = base_path('Modules/Admin/Http/Controllers');
        // $files = [];
        // if (File::isDirectory($controllerPath)) {
        //     $controllers = File::files($controllerPath);
        //     foreach ($controllers as $controller) {
        //         $controllerFile = new SplFileInfo($controller, '', '');
        //         $files[] = $controllerFile->getFilename();
        //     }
        // }
        // $data['files'] = $files;

        return  Themes::render('modules::modules.update', $data);
    }
    public function process(Request $request)
    {
        $id = request("id");
        $doc = $request->toArray();
        unset($doc["files"]);
        $action = $doc["action"] ?? "save";
        unset($doc["action"]);
        if (count(request()->files) > 0) {
            $data_image =  upload(request()->files, "upload/images");
            if ($data_image) {
                foreach ($data_image as $key => $path) {
                    $doc[$key] = $path;
                }
            }
        }
        if(empty($doc['file']) && @$doc['name_vn']!="") $doc['file'] = createdSlug($doc['name_vn'], '_');

        if(!empty($doc['page_tab_group']) && $doc['page_tab_group']) $doc['page_tab_group'] = json_encode($doc['page_tab_group'],JSON_UNESCAPED_UNICODE);
        // Pages::updateOrCreate(['id' => $id], $doc);
        $id = base_model::save_data($this->table, $doc, $id);
        if (request('permalink') != '') {
            $doc['slug'] = request('permalink');
            PremaLink::createOrUpdateLink(request('permalink'), $this->module, $id);
        }
        if ($action == "save") {
            $url = url('admin/' . $this->module->file);
            return redirect($url);
        } else {
            // return redirect()->back();
            $url = url('admin/modules/update/' . $id);
            return redirect($url);
        }
    }
    // public function update(Request $request, $id = null)
    // {
    //     $data['title'] = module_title();
    //     $data['cols'] = (object)Modules::getColumnOption($GLOBALS['var']['act'], "column_info_options");
    //     $data['info'] = !empty($id) ? base_model::find($this->table, "id = '$id'") : [];
    //     $data['files'] = $this->getControllers();
    //     // $conditions = getFieldSelectById($id) . "=" . $id
    //     // $data['row'] = base_model::find($this->table, "")where(getFieldSelectById($id), $id)->where("language_code", $GLOBALS['lang']['code'])->first();
    //     return view("admin::modules.update", $data);
    // }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $model = $this->model["customer"];
        $record = $model::find($id);
        if (!empty($record)) {
            $record->delete();
        }

        return redirect()->back();
    }

    function export(Request $request)
    {
        $this->prepareSearch($request);
        $query = new Customer();
        $records = $query->filter()
            ->selectRaw('ROW_NUMBER() OVER(PARTITION BY id) AS row_num ,name,district,price,area')
            ->get();
        $head = ["STT", "TIÊU ĐỀ", "QUẬN", "GIÁ", "DIỆN TÍCH"];
        $arr = array_merge([$head], $records->toArray());
        $fileName = 'file_quotation_' . date("d-m");
        if (file_exists(base_path("public/storage/export/" . $fileName . ".csv"))) {
            @unlink(base_path("public/storage/export/" . $fileName . ".csv"));
        }
        writeCsv($arr, base_path("public/storage/export/" . $fileName . ".csv"));
        return response()->download(base_path("public/storage/export/" . $fileName . ".csv"));
    }


    public function column_options($type = '')
    {
        $data['module'] = request('module');
        $module = Modules::where("file", request('module'))->first();
        $table = $module->prefix != ""? $module->prefix: request('module');


        $data['fields'] = $this->module_fields($table);
        $data['cols'] = json_decode(get_data('modules', 'file = "' . $data['module'] . '"', 'column_options'));
        if (!$data['cols']) {

            if (!in_array($table, array('promotion'))) {
                $details = $this->module_fields($table, true);
            }
            if (is_object($details)) {
                $data['fields'] = (object)array_merge((array)$data['fields'], (array)$details);
            }
            $data['cols'] = $data['fields'];
            $data['cols'] = collect($data['cols'])->sortByDesc("show")->toArray();
        }
        if(!empty($type)) {
            $data['cols_info'] = json_decode(get_data('modules', 'file = "' . $data['module'] . '"', 'column_info_options')) ?? [];
            $data['cols_part'] = json_decode(get_data('modules', 'file = "' . $data['module'] . '"', 'column_part_options')) ?? [];
            return view('modules::modules.column_part_options', $data);
        }
        $data['module'] = $module;
        return view('modules::modules.column_options', $data);
    }

    public function module_fields($table, $detail = false)
    {
        if ($detail) {
            $table = $table . '_details';
        }

        $theads = [];
        if(!empty(config("admin.".$table. '.theads'))){
            $theads = array_filter(config("admin.".$table. '.theads'), function ($value) {
                if ((!isset($value['viewable']) || \Arr::get($value, 'viewable')) && !in_array( $value['field'],["action",""]) ) {
                    return $value;
                }
            });
            $theads = collect($theads)->pluck('field')->toArray();
        }

        if (Schema::hasTable($table)) {
            $cols = array();
            // $query = 'SELECT COLUMN_NAME, COLUMN_COMMENT FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = "' . env("DB_DATABASE") . '" AND TABLE_NAME = "' . $table . '"';
            $query = 'SELECT COLUMN_NAME, COLUMN_COMMENT FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = "' . $table . '"';
            $fields = DB::select($query);
            $fields = json_decode(json_encode($fields), true);
            foreach ($fields as $field) {
                $cols[$field['COLUMN_NAME']] = (object) array(
                    'show' => in_array( $field['COLUMN_NAME'],$theads),
                    'name' => $field['COLUMN_COMMENT']!=""?$field['COLUMN_COMMENT']: ucfirst($field['COLUMN_NAME']),
                    'type' => "",
                    'filter' => "",
                    'detail' => $detail
                );
            }
            return (object) $cols;
        } else {
            return false;
        }
    }
    public function column_settings()
    {
        // if (!$_POST) process_right(true);

        // $displayType = request('display_type');
        // $displayTypeValue = request('display_type_value');
        // $data = [
        //     'name' => request('name'),
        //     'column' => request('column'),
        //     'display_type' => $displayType,
        //     'display_type_value' => isJson($displayTypeValue) ? json_decode($displayTypeValue, true) : $displayTypeValue
        // ];

        // if ($displayType == 'color') {
        //     $data['orders_status_type'] = $this->Mod->get_orders_status_type();
        //     $data['title'] = 'Color display configuration';
        // }


        // $data['title'] = 'Display configuration';
        // if (in_array($displayType, ['field_by_id', 'categories'])) {
        //     $data['title'] = 'Display configuration';
        //     $data['display_table'] = !empty(DISPLAY_TABLE) ? explode(",", DISPLAY_TABLE) : [];
        // }
        $module = request('module');
        $displayType = request('display_type');
        $displayTypeValue = request('display_type_value');


        $data = [
            'column' => request('column'),
            'name' => request('name'),
            'display_type' => $displayType,
            'display_type_value' => isJson($displayTypeValue) ? json_decode($displayTypeValue, true) : $displayTypeValue
        ];

        switch ($displayType) {
            case 'color':
                $data['orders_status_type'] = $this->Mod->get_orders_status_type();
                $data['title'] = 'Color display configuration';
                $data['view'] = "modules/display_type/color";
                break;
            case 'field_by_id':
                $data['title'] = 'Field by id display configuration';
                // $data['display_table'] = !empty(user_config("display_table") ) ? explode(",", user_config("display_table") ) : [];
                $data['display_table'] = collect(base_model::query_table_name())->pluck('name');
                $data['view'] = "modules/display_type/field_by_id";
                break;
            case 'line_card_id':
                $data['title'] = 'Line card id configuration';
                $data['view'] = "modules/display_type/line_card_id";
                break;
            case 'option_items':
                $data['title'] = 'Option items display configuration';
                $data['option_items'] = Modules::get_items_by_module($module);
                $data['view'] = "modules/display_type/option_items";
            case 'option_items_keynum':
                $data['title'] = 'Option items keynum display configuration';
                $optionItem = !empty($data['display_type_value']['type']) ? $data['display_type_value']['type'] : $data['display_type_value'];
                $data['optionItem'] = $optionItem;
                $data['option_items'] = Modules::get_items_keynum_by_module($module, ['current' => $optionItem]);
                $data['view'] = "modules/display_type/option_items";
                break;
            default:
                break;
        }
        $data['options'] = $data;
        return view('modules::modules.column_settings', $data);
    }

    public function get_field_by_table($table)
    {
        $isAjax = request()->ajax();
        if (empty($table)) process_right($isAjax);
        try {
            $fields = $this->fn->module_fields($table);
            if ($isAjax) {
                $data = [];
                foreach ($fields as $k => $val) {
                    if (!empty($val->name)) $data[$k] = $val->name;
                }
                response_json(200, 'success !', $data);
            } else {
                return $fields;
            }
        } catch (\Throwable $e) {
            return false;
        }
    }

    public function sync_orders_status()
    {
        // if (!$_POST) process_right(true);
        $type = request('type');
        $options = request('options');
        $fn = new FnModel();
        $id = get_data('orders_status_type', 'Name = "' . $type . '"', 'id');
        if (empty($id) && $type!= "") {
            $data_type = [
                'Name' => $type,
                'Namereplace'       => $type,
                'user_added'        => $GLOBALS['user']['id'],
                'user_modified'     => $GLOBALS['user']['id'],
                'date_added'        => date(TIME_SQL),
                'date_modified'     => date(TIME_SQL)
            ];
            $fn->process($data_type, '', 'orders_status_type');
        }

        if (!empty($options)) {
            $ids = [];
            foreach ($options as $option) {
                $data = [
                    'type'          => $type,
                    'name_vn'       => $option['name'],
                    'StatusKey'     => $option['key'],
                    'color'         => $option['color'],
                    'color_text'    => $option['color_text'],
                    'user_modified' =>  $GLOBALS['user']['id'],
                    'date_modified' =>  date(TIME_SQL)
                ];
                $ids[] = $fn->process($data, $option['id'], 'orders_status');
            }
            if (!empty($ids)) $this->remove_orders_status($type, $ids);
        }
        response_json(200, 'success !', $type);
    }
    private function remove_orders_status($type, $ids)
    {
        return DB::table('orders_status')
            ->whereNotIn('id', $ids)
            ->where('type', $type)
            ->update(['deleted' => 1]);
    }
    public function sync_option_items_keynum()
    {
        try {
            $field = request('type');
            $options = request('options');
            if(!empty($options))
            {
                base_model::save_data('option_items_keynum', ['Options' => json_encode($options)], ['Field' => $field]);
            }
            unset($_POST['options']);
            $resData = $_POST;
            $resData['color'] = 1;
            response_json(200, 'success !', $resData);
        } catch (\Throwable $e) {
            // process_right(true);
            dd($e);
        }
    }
    public function updateColumns()
    {
        $file = $this->maskFileByModule();
        $field = request('field_options') ?? 'column_options';
        // $column_options_old = json_decode(get_data('modules', 'file = "'. $file .'"', $field), true);
        // if(isAdmin()) file_write($column_options_old, 'modules', $file . "_" . $GLOBALS['user']['id'] . "_" . time() . '.json');
        $dataOptions = [];
        if (!empty(request('column_options'))){
            $dataOptions[$field] = json_encode(request('column_options'));
            $columns = collect(request('column_options'))->where("show",1);
            if(!empty($columns))
            {
                $dataOptions['columns'] = implode(",", array_keys($columns->toArray()));
            }
            else
            {
                $dataOptions['columns'] = "";
            }
        }

        if (!empty(request('column_part_options'))) $dataOptions['column_part_options'] = json_encode(request('column_part_options'));
        if (!empty(request('column_info_options'))){
            $dataOptions['column_info_options'] = json_encode(request('column_info_options'));
            $info = collect(request('column_info_options'))->where("show",1);
            if(!empty($info))
            {
                $dataOptions['column_info'] = implode(",", array_keys($info->toArray()));
            }
            else
            {
                $dataOptions['column_info'] = "";
            }
        }
        try {
            DB::table('modules')->where('file', $file)->update($dataOptions);
            response_json(200, 'Success');
        } catch (\Throwable $e) {
            response_json(400, $e);
        }
    }
    private function maskFileByModule()
    {
        $file = request('file');
        if ($file == false) {
            echo ('error,the file name module is missing.');
            exit;
        }
        return $file;
    }

    public function guide()
    {
        $module = base_model::find("modules","file='".request('page')."'");
        return $module->requirement;
    }

    function  info()
    {
        $module = (object)base_model::find("modules","file='".request('page')."'");
        return json_encode(['id'=>$module->id]);
    }

    function goto()
    {
        $path = request('path');
        $line = request('line');
        shell_exec('"'.env("PATH_VSCODE").'"   --goto "'.env("PATH_SOURCE"). $path.'":'.$line.':1');
        die;
    }
}
