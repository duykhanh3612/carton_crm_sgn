<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Admin\Model\Estates;
use App\Models\Geo;
use Illuminate\Support\Facades\DB;

class AjaxController extends BaseController
{
    public function __construct()
    {
    }

    function getGeoDistrict(Request $request)
    {
        return Geo::getDistrictOptions(request('province'), request('json'));
    }

    public function getGeoWard()
    {
        return Geo::getWardOptions(request('district'), request('json'));
    }

    public function updateColumns()
    {
        $file = $this->maskFileByModule();
        $field = request('field_options') ?? 'column_options';
        // $column_options_old = json_decode(get_data('modules', 'file = "'. $file .'"', $field), true);
        // if(isAdmin()) file_write($column_options_old, 'modules', $file . "_" . $GLOBALS['user']['id'] . "_" . time() . '.json');
        $dataOptions = [];
        if (!empty(request('column_options'))) $dataOptions[$field] = json_encode(request('column_options'));
        if (!empty(request('column_part_options'))) $dataOptions['column_part_options'] = json_encode(request('column_part_options'));
        if (!empty(request('column_info_options'))) $dataOptions['column_info_options'] = json_encode(request('column_info_options'));
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
    public function sort_nestable()
    {
        try {
            $data = json_decode(request('dataSort'));
            $table = request('tableSort');
            if ($table == 'products' || $table == 'news') {
                $table = $table . '_categories';
            }
            $this->sort_allnestable($table, $data);
            response_json(200, 'Success');
        } catch (\Throwable $e) {
            response_json(400, $e);
        }
    }
    public function sort_allnestable($table, $data, $parent = 0)
    {
        foreach ($data as $key => $val) {
            Ajax::sort_nestable($table, array('parent' => $parent, 'sort_order' => $key), $val->id);
            if (!empty($val->children)) {
                $this->sort_allnestable($table, $val->children, $val->id);
            }
        }
    }
    public function change_value()
    {
        $table = request('table');
        $id = request('id');
        $value = request('value');
        $field = request('field');
        $only = request('only');
        if (!$table || !$id || !$field) {
            echo 0;
            return false;
        }
        try {
            if ($field == 'remove') {
                $id = Ajax::remove($table, $id, $only);
            } else {
                $id = Ajax::changeValueWithField($table, $id, $field, $value, $only);
            }
            response_json(200, 'Success', $id);
        } catch (\Throwable $e) {
            response_json(400, $e);
        }
    }
    public function getViewByType($type, Request $request)
    {
        $data = [
            'type'     => $type,
            'name'     => $request->name,
            'value'    => $request->value,
            'id'    => null,
            'mask'    => $request->mask
        ];
        $view = view()->exists("admin::components.input.$type") ? "components.input.$type" : 'components.input.text';
        return load_view($view, $data);
    }

    public function upload_file()
    {
        $data = upload(request()->files, "upload/images");
        return response()->json(['image' => reset($data)]);
    }
}
