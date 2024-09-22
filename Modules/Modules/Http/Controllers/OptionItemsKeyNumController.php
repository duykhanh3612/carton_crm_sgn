<?php

namespace Modules\Modules\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Admin\Model\Modules;
use App\Model\base_model;
use Modules\Plugin\Entities\Themes;
class OptionItemsKeyNumController extends BaseController
{
    public function __construct()
    {
        parent::__construct(['module'=>"option_items_keynum"]);
        $this->uri_arr['orderby'] = "id";
        $this->uri_arr['ordermode'] = "asc";
    }

    function index(Request $request)
    {
        $data['title'] = "Option Key Number";
        $where = "1=1";
        $search = Modules::search_where(request('filter'), $where, $this->module->columns);
        $where  = $search['where'];
        $data['rows'] =  base_model::paging("option_items_keynum", $where);//convert_data($this->fn->show($this->uri_arr))  ;
        $data['uri_str'] = url_uri($this->uri_arr);
        $data['url_update'] = url( 'admin/option_items_keynum/update');
        $data['fields'] = Modules::module_fields('option_items_keynum');
        $data['cols'] = Modules::getColumnOption('option_items_keynum');
        if (!$data['cols']) {
            $data['cols'] = $data['fields'];
        }

        $data['cols_type'] = [
            'Module' => [
                'type' => "select",
                'data' => array_replace([''=>'Select...'], Modules::pluck("name_en","name_en")->toArray())
            ],
            'active' => [
                'type' => "select",
                'data' => ['' => 'Select...', '1' => 'Active', '0' => 'NonActive']
            ]
        ];
        return Themes::render('modules::option_items_keynum.index', $data);
    }
    public function update($id = '')
    {

        $options = $this->fn->show_options('modules', array('order_by' => 'name_vn asc', 'field' => 'id, name_vn', 'val' => array('id', 'name_vn')));
        $data = array(
            'info' => $this->fn->info($id),
            'action' => site_url('admin/option_items_keynum/process') ,
            'options_module' => $this->fn->show_options('modules', array('order_by' => 'name_vn asc', 'field' => 'id, name_vn', 'val' => array('id', 'name_vn'))),
            'mdid' => request('mdid')
        );

        $header = array(
            'title' => "Option Key Num",
            'add_link' => '',
            'search' => false,
            'page_list' => '',
            'datetime_picker' => false,
            'submit_btn' => true,
            'cat_list' => array(),
            'uri' => $this->uri_arr,
            'act' => $GLOBALS['var']['act'],
            'do' => $GLOBALS['var']['do'],
            'id' => $GLOBALS['var']['id'],
            // 'filter_cat' => $GLOBALS['var']['filter_cat']
        );
        return Themes::render('modules::option_items_keynum.update', $data);
    }

    public function process()
    {
        if (!$_POST) {
            my_redirect();
        }
        $Name = request('Name');
        $module = request('module');
        $this->uri_arr['name'] = str_replace('&', '', $Name);
        $id = request('id', true);
        if ((!$id && !$GLOBALS['per']['add']) || ($id && !$GLOBALS['per']['edit'])) {
            my_redirect($GLOBALS['var']['act']);
        }
        $data = array(
            'Name' => $Name,
            'module' => json_encode($module, JSON_UNESCAPED_UNICODE),
            'Field' => createdSlug(request('Field'),"_"),
            'Options' => json_encode(request('Options'), JSON_UNESCAPED_UNICODE),
            'MultipleChoose' => request('MultipleChoose'),
            'type' => request('type'),
            'user_modified' => @$GLOBALS['user']['id'],
            'date_added' => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s"),
        );
        if (!$id) {
            $data['user_added'] = $GLOBALS['user']['id'];
        }
        if ($this->fn->process($data, $id)) {
            $this->uri_arr['updated'] = 1;
        } else {
            $this->uri_arr['failed'] = 1;
        }
        $this->uri_arr['t'] = time();
        return redirect()->back();
    }
}
