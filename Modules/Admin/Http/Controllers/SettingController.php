<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Model\Blocks;
use DB;

class SettingController extends BaseController
{
    private $route = "";
    private $slug = "";
    public function __construct()
    {
        $this->route = 'admin.' . request()->segment(2);
        $this->slug = request()->segment(2);
        parent::__construct();
    }
    function index(Request $request)
    {
        return view('admin::setting.index');
    }
    function config()
    {
        return \Themes::view('admin::setting.config');
    }
    function updateConfig(Request $request)
    {
        update_config($request->key, $request->value);
    }
    public function general(Request $request)
    {
        $this->prepareSearch($request);
        $params = $request->all();
        $params['title'] = config($this->route . '.title');
        $refresh = ['route' => 'admin.slider'];
        $filters = [
            [
                'label' => 'Filter:',
                'name' => 'keywords',
                'placeholder' => 'Keywords',
                'value' => request()->keywords
            ]
        ];
        $childrenTabs = [
            // 'user.orders' => 'Back',
        ];
        $buttons = [
            [
                // 'href' => route('admin.slider.create'),
                'class' => 'btnBlue please-wait',
                'label' => trans("admin::app.create"),
                'title' => trans("admin::app.create"),
                'icon' => 'fa-plus'
            ],
        ];
        $navs = config($this->route . '.navs');

        if(!empty(config($this->route . '.theads')))
        {
            $theads = array_filter(config($this->route . '.theads'), function ($value) {
                if (!isset($value['viewable']) || \Arr::get($value, 'viewable') != 0) {
                    return $value;
                }
            });
        }

        $records  = [];
        if(isset($this->model[$this->slug]))
        {
            $model = new $this->model[$this->slug];
            $records = $model::paginate(request()->limit);
        }

        $links = [
            'edit' =>   'admin.slider.edit',
            'delete' => 'admin.slider.delete',
        ];
        return view('admin::datatable', [
            'params' => $params,
            'navs' => $navs,
            'filters' => $filters,
            'refresh' => $refresh,
            'buttons' => $buttons,
            'records' => $records,
            'theads' => $theads??[],
            'links' => $links,
            'childrenTabs' => $childrenTabs,
        ]);
    }

    public function updateSetting(Request $request)
    {
        $variable = $request->toArray();
        foreach ($variable as $key => $value) {
            update_setting($key, $value);
        }
        return redirect("admin/store#web_setting");
    }
}
