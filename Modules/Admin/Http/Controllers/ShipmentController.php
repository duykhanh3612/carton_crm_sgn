<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Admin\Model\Shipment;

class ShipmentController extends BaseController
{
    protected $route = "admin.shipment";
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

    function index(Request $request)
    {
        $this->prepareSearch($request);
        $params = $request->all();
        $params['title'] = config($this->route.'.title');
        $refresh = ['route' => 'admin.shipment'];
        $filters = [
            [
                'name' => 'keywords',
                'placeholder' => __('Nhập từ khóa tìm kiếm') . ':',
                'value' => request()->keywords
            ],
            [
                'name' => "search",
                'type' => "submit",
                'value' => "Tìm kiếm",
                'icon' => "<i class='fa fa-search'></i>"
            ]

        ];
        $childrenTabs = [
            // 'user.customers' => 'Back',
        ];
        $buttons = [];
        if(check_rights($this->module->file,"create"))
        {
            $buttons[] = [
                    'href' => route('admin.shipment.create'),
                    'class' => 'btn btn-danger please-wait',
                    'label' => 'Tạo mới',
                    'title' => __('Add new'),
                    'icon' => 'fa-plus'
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
        }
        $links = [
            'edit' =>   'admin.shipment.edit',
            'delete' => 'admin.shipment.delete',
        ];
        $query = new Shipment();
        $records = $query->orderBy("id", "desc")->filter()->paginate(request()->limit);
        return \Themes::render('datatable', [
            'params' => $params,
            'navs' => $navs,
            'filters' => $filters,
            'refresh' => $refresh,
            'buttons' => $buttons,
            'records' => $records,
            'theads' => $theads,
            'tfoots' => config($this->route . '.tfoots'),
            'links' => $links,
            'childrenTabs' => $childrenTabs,
        ], true);

    }
    public function edit($id = null)
    {
        $model = new  Shipment();
        $record = empty($id)?[]: $model->find($id);
        $theads = array_filter(config($this->route . '.theads'), function ($value) {
            if (!isset($value['editable']) || \Arr::get($value, 'editable')) {
                return $value;
            }
        });
        $setting =  config($this->route . '.setting');
        $title = config($this->route . '.title');
        $link_update =  route('admin.shipment.update', [@$record->id ?? '']);
        return \Themes::view('admin::edit', compact('record', 'theads', 'setting','link_update',  'title'));
    }
    public function update(Request $request, $id = null)
    {
        $doc = $request->toArray();
        if(@$doc["district_id"]!="" && is_array($doc["district_id"]))
        {
            $doc["district_id"] = json_encode( $doc["district_id"]);
        }

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
        if($id == "")
        {
            $doc["created_by"] = auth()->user()->id;
        }
        $model = new Shipment();
        $model::updateOrCreate(['id' => $id], $doc);
        if ($action == "save") {
            $url = route("admin.shipment");
            return redirect($url);
        } else {
            return redirect()->back();
        }
    }

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
}
