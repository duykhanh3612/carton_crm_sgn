<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

use DB;

class AdminController extends BaseController
{
    private $route = "";
    private $slug = "";

    protected $config;
    public function __construct()
    {
        $this->route = 'admin.' . request()->segment(2);
        $this->slug = request()->segment(2);
        view()->share('model', $this->model);

        $this->config = config($this->route);
        view()->share("config",config($this->route));
        parent::__construct();
    }


    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $this->prepareSearch($request);
        $params = $request->all();
        $params['title'] = config($this->route . '.title');
        $refresh = ['route' => 'admin.page'];
        $filters = [
            [
                'label' => '',
                'name' => 'keywords',
                'placeholder' => 'Keywords',
                'value' => request()->keywords
            ],
            [
                'name' => "search",
                'type' => "submit",
                'value' => "Tìm kiếm",
                'icon' => "<i class='fa fa-search'></i>"
            ],
        ];
        $childrenTabs = [
            // 'user.orders' => 'Back',
        ];
        if(isset($config['buttons']))
        {
            $buttons = $config['buttons'];
        }
        else{

            $buttons = [
                [
                    'href' => url('admin').'/'.request()->segment(2).'/create',
                    'class' => 'btnBlue please-wait',
                    'label' => 'Tạo mới',
                    'title' => __('Add new'),
                    'icon' => 'fa-newspaper'
                ],
            ];
        }

        $navs = config($this->route . '.navs');
        $theads = [];
        if (!empty(config($this->route . '.theads'))) {
            $theads = array_filter(config($this->route . '.theads'), function ($value) {
                if (!isset($value['viewable']) ||  \Arr::get($value, 'viewable')) {
                    return $value;
                }
            });
            usort($theads, "cmp");
        }
        $model = new $this->model[$this->slug];
        if (method_exists($model, 'scopeSearch')) {
            $model = $model->search();
        }
        $records = $model->paginate(request()->limit);
        $links = [
            'edit' =>   'admin.news.edit',
            'delete' => 'admin.news.delete',
        ];
        return view('admin::datatable', [
            'params' => $params,
            'navs' => $navs,
            'filters' => $filters,
            'refresh' => $refresh,
            'buttons' => $buttons,
            'records' => $records,
            'theads' => $theads,
            'tfoots' => config($this->route . '.tfoots'),
            'links' => $links??[],
            'page' => $this->slug,
            'childrenTabs' => $childrenTabs,
        ]);
        // return view('admin::index');
    }

    public function api($slug)
    {
        $params = request()->toArray();
        $slug = str_replace("-", "_", $slug);
        $query = new $this->model[$slug];

        if (method_exists($query, 'scopeApi')) {
            $query = $query->api();
        }

        if (request('type') != "") {
            $records = $query->fillFields(request('type'));
        } else {
            if (isset($query::$api_type) && $query::$api_type == "array") {
                if (method_exists($query, 'search')) {
                    $records = $query->search(['keywords'=>request('keywords')])->fillFields()->get();
                } else {
                    $records = $query->fillFields()->get();
                }
                get_response_code(true, response_bad_request, $result);
                $result['data'] = $records;
                return response()->json($result);
            } else {
                $records = $query->search($params)->paginate(request()->limit);
            }
        }
        $records->transform(function ($item) {
            if(isset($item->image)) {
                $item->image = url(image_path($item->image));
            }
            if(isset($item->gallery)) {
                $galleries = json_decode($item->gallery, true);
                foreach($galleries as &$gallery)
                {
                    if(isset($gallery['image'])) {
                        $gallery['image'] = url(image_path($gallery['image']));
                    }
                }
                $item->gallery = $galleries;
            }
            return $item;
        });
        $result =  $records->toArray();
        $result['code'] = 200;
        $result['success'] = true;
        if (method_exists($query, 'getOptions')) {
            $query->getOptions($result, $records);
        }
        return response()->json($result, 200, ['Content-type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }
    public function api_comment($slug){
        $slug = str_replace("-", "_", $slug);
        $query = new $this->model[$slug];
        $result['data'] = $query->get_comments();
        $result['code'] = 200;
        $result['success'] = true;
        return response()->json($result,200,['Content-type'=>'application/json;charset=utf-8'],JSON_UNESCAPED_UNICODE);
    }
    function api_detail($slug, $id)
    {
        $slug = str_replace("-", "_", $slug);
        $query = new $this->model[$slug];


        if(is_numeric($id))
        {
            $records = $query->where('id',$id)->first();
        }
        else{
            $records = $query->where('slug',$id)->first();
        }

        if(isset($records->image)) {
            $records->image = url(image_path($records->image));
        }
        if(isset($records->gallery)) {
            $galleries = json_decode($records->gallery, true);
            foreach($galleries as &$gallery)
            {
                if(isset($gallery['image'])) {
                    $gallery['image'] = url(image_path($gallery['image']));
                }
            }
            $records->gallery = $galleries;
        }

        get_response_code(true, response_bad_request, $result);
        $result['data'] = $records;
        return response()->json($result, 200, ['Content-type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create($page)
    {
        $theads = array_filter(config($this->route . '.theads'), function ($value) {
            if (!isset($value['editable']) || \Arr::get($value, 'editable')) {
                return $value;
            }
        });
        $setting =  config($this->route . '.setting');
        return view('admin::create', compact('theads', 'setting', 'page'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $status = 200;
        $params = $request->all();
        $hs_val = @$params[self::HS_VAL];
        $hs_key = @$params[self::HS_KEY];
        $hs_multiple = @$params[self::HS_MULTIPLE];
        $hs_separator = @$params[self::HS_SEPARATOR];
        $hs_data_type = @$params[self::HS_DATA_TYPE];
        $is_map_field = @$params[self::HS_IS_MAP_FIELD];
        $hs_title = @$params[self::HS_TITLE];
        $hs_core_var = @$params['hs_core_var'];
        $hs_title_key = null;
        $hs_empty_array = @$params['hs_empty_array'];
        $hs_title_key = self::HS_WITH_TITLE . $hs_key;

        if ($hs_data_type && !is_array($hs_val)) {
            settype($hs_val, $hs_data_type);
        }
        if ($hs_separator && !is_array($hs_val)) {
            $hs_val = array_map('trim', explode($hs_separator, $hs_val));
        }
        if ($hs_data_type && is_array($hs_val)) {
            foreach ($hs_val as $tempKey => $tempVal) {
                settype($hs_val[$tempKey], $hs_data_type);
            }
        }
        if ($hs_core_var) {
            $hs_core_vars = array_map('trim', explode(',', $hs_core_var));
            foreach ($hs_core_vars as $hs_core_var) {
                Corevar::where('core_key', $hs_core_var)->unset('core_value');
            }
        }
        if ($hs_empty_array && empty($hs_val)) {
            $hs_val = [];
        }
        // $userSettingM = new UserSetting();
        $doc = array(
            $hs_key => $hs_val
        );

        // $userSetting = $userSettingM::getAllSettings();

        if (!empty($is_map_field) && !empty($userSetting[$hs_key]) && is_array($hs_val)) {
            // if (isset($hs_val['field']) && empty($hs_val['field'])) {
            //     $userSettingM->where(self::HS_KEY, $hs_key)->delete();
            //     if ($hs_title_key) {
            //         $userSettingM->where(self::HS_KEY, $hs_title_key)->delete();
            //     }
            //     return response()->json([
            //         'status' => $status,
            //         'deleted' => true
            //     ]);
            // }

            $doc[self::HS_VAL] = array_replace_recursive($userSetting[$hs_key], $doc[self::HS_VAL]);
        }
        $validateRule = @$params['validate_rule'];
        if ($hs_val && $validateRule) {
            $rules = ['hs_val' => $validateRule];
            if (validator(['hs_val' => $hs_val], $rules)->fails()) {
                $status = 422;
            }
        }
        if ($status === 200) {
            // $userSettingM->createOrSave($doc, array(UserSetting::HS_KEY => $hs_key));
            $model = new $this->model[$this->slug];
            // $model::create($doc);

            $itemsID = DB::table($model->getTable())->insertGetId(
                $doc
            );
            // if ($hs_title_key) {
            //     $doc = array(
            //         UserSetting::HS_KEY => $hs_title_key,
            //         UserSetting::HS_VAL => $hs_title
            //     );
            //     $userSettingM->createOrSave($doc, array(UserSetting::HS_KEY => $hs_title_key));
            // }
            // if($userSetting['hs_pos'] === UserSetting::NETSUITE_POS) {
            //     if (strpos($hs_key, 'netsuitepos_tags_field') !== false) {
            //         (new NSPosProduct())->updateTagForHyperspace();
            //     }
            // }
            // if($hs_key === config('constants.donor.hr_donor_id_field')) {
            //     SPCustomer::updateDonorIdData();
            // }
            return response()->json([
                'status' => $status,
                'id' => $itemsID,
                'type' => 'create',
                'link' => route("admin.slider.update", $itemsID)
            ]);
        }

        return response()->json([
            'status' => $status,
            'message' => $status === 422 ? "Value is invalid!" : self::UNKNOW_ERROR_MESSAGE
        ]);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('admin::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id = "")
    {
        $page = request()->segment(2);
        $model = $this->model[$page];
        $record = $model::find($id);
        $theads = array_filter(config($this->route . '.theads'), function ($value) {
            if (!isset($value['editable']) || \Arr::get($value, 'editable')) {
                return $value;
            }
        });
        $setting =  config($this->route . '.setting');
        $title = config($this->route . '.title');
        $link_update = url("admin/".$page."/update").($id!=""?"/$id":"");
        return view('admin::edit', compact('record', 'theads', 'setting', 'page', 'title','link_update'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request,  $id = null)
    {
        $status = $id ? 200 : 500;
        $doc = $request->toArray();
        $action = $doc["action"]??"save";
        unset($doc["action"]);

        if (count(request()->files) > 0) {
            $data_image =  $this->upload(request()->files, "upload/news");

            if ($data_image) {
                foreach ($data_image as $key => $path) {
                    $doc[$key] = $path;
                }
            }
        }
        else{
            if(!empty(request('delete_image')))
            {
                foreach(request('delete_image') as $k=>$v)
                {
                    $doc[$k] = "";
                }
            }
            unset($doc['delete_image']);
        }
        if($id == null)
        {
            $doc["created_by"] = auth()->user()->id;
        }
        $page = request()->segment(2);
        $model = $this->model[$this->slug];
        $record = $model::updateOrCreate(['id' => $id], $doc);
        if ($action == "save") {
            // $url = route("admin.page", [$page]);
            $url = url("admin/".$page);
            return redirect($url);
        } else {
            return redirect(url("admin/".$page.'/edit/'. $record->id));
        }
    }
    public function upload($value, $path_upload = NULL)
    {
        // if (empty($admin_group)) {
        //     $admin_group = json_decode(admin_group);
        // }
        $path_base =  "";
        if ($path_upload == "") {
            $path_upload = "upload/images";
            $path_image  =  env("APP_PATH "). $path_upload;
        } else {
            $path_image  =   $path_upload;
        }
        if (!file_exists($path_image)) {
            // mkdir($path_image, 0777);
        }
        $data = array();
        foreach ($value as $n => $file) {
            if (is_array($file)) {
                $f_name = array();
                foreach ($file as $f) {
                    $name = $f->getClientOriginalName();
                    $path = $path_upload . '/' . $name;
                    $_parts = pathinfo($path);

                    $i = 1;
                    do {
                        $flg = file_exists($path_base . $path);
                        if ($flg) {
                            // $name = \h::alias_name($_parts['filename']) . '_' . $i . '.' . @$_parts['extension'];
                            $name = $_parts['filename'] . '_' . $i . '.' . @$_parts['extension'];
                            $path = $path_upload . '/' . $name;
                            $i++;
                        }
                    } while ($flg);

                    $f_name[] = $path;

                    $f->move($path_base . $path_upload, $name);
                }
                $data[$n]  = json_encode($f_name);
            } else {
                $name = $file->getClientOriginalName();
                $path = $path_upload . '/' . $name;
                $_parts = pathinfo($path);

                $i = 1;
                do {
                    $flg = file_exists($path_base . $path);
                    if ($flg) {
                        $name = $_parts['filename'] . '_' . $i . '.' . @$_parts['extension'];
                        $path = $path_upload . '/' . $name;
                        $i++;
                    }
                } while ($flg);
                $data[$n] = $path;
                $file->move($path_image, $name);
            }
        }
        return $data;
    }
    public function upload_file()
    {
        $id = request('id');
        if ($id == '')
            $id_new =  md::save_data($func->table, array());
        else $id_new = $id;
        $data = upload(request()->files, request('path_upload'));
        return response()->json(array('sort' => request('sort'), 'id' => $id_new, 'image' => reset($data)));
    }
    public function uploadPhoto(Request $request)
    {
        $data = upload(request()->files, request('path_upload'));
        $url = url('public/'.$data['upload']);
        $message = "success";

        return response()->json([
            'fileName' => basename($url ),
            'uploaded' => 1,
            'url' => $url ,
        ]);
    }
    public function remove_upload()
    {
        $path = base_path(request('image'));
        if (file_exists($path)) {
            unlink($path);
        }
    }
    public function ajax_update(Request $request, $page, $id)
    {
        $status = $id ? 200 : 500;
        if ($id) {
            $params = $request->all();
            $hs_val = @$params[self::HS_VAL];
            $hs_key = @$params[self::HS_KEY];
            $hs_multiple = @$params[self::HS_MULTIPLE];
            $hs_separator = @$params[self::HS_SEPARATOR];
            $hs_data_type = @$params[self::HS_DATA_TYPE];
            $is_map_field = @$params[self::HS_IS_MAP_FIELD];
            $hs_title = @$params[self::HS_TITLE];
            $hs_core_var = @$params['hs_core_var'];
            $hs_title_key = null;
            $hs_empty_array = @$params['hs_empty_array'];
            $hs_title_key = self::HS_WITH_TITLE . $hs_key;

            if ($hs_data_type && !is_array($hs_val)) {
                settype($hs_val, $hs_data_type);
            }
            if ($hs_separator && !is_array($hs_val)) {
                $hs_val = array_map('trim', explode($hs_separator, $hs_val));
            }
            if ($hs_data_type && is_array($hs_val)) {
                foreach ($hs_val as $tempKey => $tempVal) {
                    settype($hs_val[$tempKey], $hs_data_type);
                }
            }
            if ($hs_core_var) {
                $hs_core_vars = array_map('trim', explode(',', $hs_core_var));
                foreach ($hs_core_vars as $hs_core_var) {
                    Corevar::where('core_key', $hs_core_var)->unset('core_value');
                }
            }
            if ($hs_empty_array && empty($hs_val)) {
                $hs_val = [];
            }
            // $userSettingM = new UserSetting();
            $doc = array(
                $hs_key => $hs_val
            );

            // $userSetting = $userSettingM::getAllSettings();

            if (!empty($is_map_field) && !empty($userSetting[$hs_key]) && is_array($hs_val)) {
                // if (isset($hs_val['field']) && empty($hs_val['field'])) {
                //     $userSettingM->where(self::HS_KEY, $hs_key)->delete();
                //     if ($hs_title_key) {
                //         $userSettingM->where(self::HS_KEY, $hs_title_key)->delete();
                //     }
                //     return response()->json([
                //         'status' => $status,
                //         'deleted' => true
                //     ]);
                // }

                $doc[self::HS_VAL] = array_replace_recursive($userSetting[$hs_key], $doc[self::HS_VAL]);
            }
            $validateRule = @$params['validate_rule'];
            if ($hs_val && $validateRule) {
                $rules = ['hs_val' => $validateRule];
                if (validator(['hs_val' => $hs_val], $rules)->fails()) {
                    $status = 422;
                }
            }
            if ($status === 200) {
                // $userSettingM->createOrSave($doc, array(UserSetting::HS_KEY => $hs_key));
                $model = $this->model[$this->slug];
                $model::updateOrCreate(['id' => $id], $doc);
                // if ($hs_title_key) {
                //     $doc = array(
                //         UserSetting::HS_KEY => $hs_title_key,
                //         UserSetting::HS_VAL => $hs_title
                //     );
                //     $userSettingM->createOrSave($doc, array(UserSetting::HS_KEY => $hs_title_key));
                // }
                // if($userSetting['hs_pos'] === UserSetting::NETSUITE_POS) {
                //     if (strpos($hs_key, 'netsuitepos_tags_field') !== false) {
                //         (new NSPosProduct())->updateTagForHyperspace();
                //     }
                // }
                // if($hs_key === config('constants.donor.hr_donor_id_field')) {
                //     SPCustomer::updateDonorIdData();
                // }
                return response()->json([
                    'status' => $status
                ]);
            }
        }
        return response()->json([
            'status' => $status,
            'message' => $status === 422 ? "Value is invalid!" : self::UNKNOW_ERROR_MESSAGE
        ]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id = null)
    {
        $model = $this->model[$this->slug];

        if(!empty($id))
        {
            $record = $model::find($id);
            if (!empty($record)) {
                $record->delete();
            }
        }
        if(request('ids'))
        {
            $ids = request('ids');
            foreach($ids as $_id)
            {
                $record = $model::find($_id);
                if (!empty($record)) {
                    $record->delete();
                }
            }
        }

        return redirect()->back();
    }
}
