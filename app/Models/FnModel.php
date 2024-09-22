<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Schema;
use Form;

class FnModel extends Model
{
    protected $session;
    protected $uri;
    protected $db;
    public function __construct()
    {
        $this->db = new DbModel();
        $this->uri = request();
        $this->session = new Session();
    }
    function load_config($module = '')
    {
        // $this->db->query('SET NAMES "LATIN1"');
        $GLOBALS['var']['token'] = $this->session->userdata('token', true);
        $GLOBALS['var']['logged_in'] = $this->session->userdata('logged_in', true);
        $GLOBALS['var']['logged_out'] = $this->session->userdata('logged_out', true);
        $GLOBALS['var']['user_id'] = $this->session->userdata('user_id', true);
        $GLOBALS['user'] = array(
            'last_login' => ''
        );
        $GLOBALS['user'] =  collect(auth()->user())->toArray();
        // if ($GLOBALS['var']['logged_in'] && $GLOBALS['var']['user_id'] > 0) {
        //     $this->db->select('id, username, user_rights, level, last_login, icon, fullname,approved_signature,Change_info, viewall, part, coso, email, mode_right, position, phone, advances_usd, user_advances_vnd', false);
        //     $this->db->where('id', $GLOBALS['var']['user_id']);
        //     $GLOBALS['user'] = $this->db->get('users')->row_array();
        //     if ($GLOBALS['user']['mode_right']) {
        //         $group_rights = get_data('usergroups', 'id = "' . $GLOBALS['user']['level'] . '"', 'group_rights');
        //         $GLOBALS['var']['user_rights'] = $group_rights;
        //         $GLOBALS['user']['user_rights'] = $group_rights;
        //     } else {
        //         $GLOBALS['var']['user_rights'] = $GLOBALS['user']['user_rights'];
        //     }
        // }
        // $this->db->select('keyword, value');
        // $query = $this->db->get('config');
        // foreach ($query->result() as $val) {
        //     $GLOBALS['cfg'][$val->keyword] = $val->value;
        // }
        $GLOBALS['var']['sidebar_collapsed'] = isset($_COOKIE['closed-sidebar']) ? $this->input->cookie('closed-sidebar', true) : 1;
        $GLOBALS['var']['act'] = $module == "" ? $this->uri->segment(2) : $module;
        $GLOBALS['var']['do'] = in_array($this->uri->segment(2), ['all', 'details', 'All', 'Details']) ? ""  : $this->uri->segment(2);
        $GLOBALS['var']['id'] = $this->uri->segment(3);
        // if (!$GLOBALS['var']['id']) {
        //     $GLOBALS['var']['id'] = $this->input->get('id', true);
        // }
        $GLOBALS['var']['deleted'] = request('deleted', 1);
        $GLOBALS['var']['rowstart'] = request('rowstart', true);
        // if (!$GLOBALS['var']['rowstart']) {
        //     $GLOBALS['var']['rowstart'] = 0;
        // }
        // $GLOBALS['var']['page'] = $this->input->get('page', true);
        // if (!$GLOBALS['var']['page']) {
        //     $GLOBALS['var']['page'] = 1;
        // }
        // invoice_management, invoice_management_sc module
        if (in_array($GLOBALS['var']['act'], array('invoice_management', 'invoice_management_sc', 'payment_management', 'supplier_payment_management', 'business_trip_customer', 'business_trip_report', 'calling_customers'))) {
            $GLOBALS['var']['rowstart'] = $this->input->get('rowstart', true);
            if (!$GLOBALS['var']['rowstart']) {
                $GLOBALS['var']['rowstart'] = date('m');                // current month
            }
        }
        // $GLOBALS['var']['limit_time'] = $this->input->cookie('limit_time', true);
        // if (!$GLOBALS['var']['limit_time']) {
        //     $GLOBALS['var']['limit_time'] = 3;      // 3 months
        // }

        $act = $GLOBALS['var']['act'];

        if ($act == 'request_sample_part') $act = 'request_sample';
        if ($act == 'purchase_order_part') $act = 'purchase_order';
        if ($act == 'purchase_order_shipment') $act = 'purchase_order';
        // unset($_COOKIE['page_yearcustomer_purchase_order']);

        // $GLOBALS['var']['warehouse_type'] = $this->input->cookie('warehouse_type', true);
        // if (!$GLOBALS['var']['warehouse_type']) {
        //     $GLOBALS['var']['warehouse_type'] = 0;      // current warehouse
        // }
        // $GLOBALS['var']['mytab'] = isset($_COOKIE['mytab']) ? $this->input->cookie('mytab', true) : 1;

        // $GLOBALS['var']['filter_cat'] = $this->input->cookie('filter-cat-' . $GLOBALS['var']['act'], true);
        $GLOBALS['var']['limit_perpage'] = !empty($_COOKIE['limit_perpage']) ? $_COOKIE['limit_perpage'] : LIMIT;
        // $GLOBALS['var']['results_per_page'] = $this->input->cookie('results_per_page', true);
        // if (!$GLOBALS['var']['results_per_page']) {
        //     $GLOBALS['var']['results_per_page'] = 25;
        // }
        $GLOBALS['per']['edit'] = true; //check_rights($module, 'edit');
        $GLOBALS['per']['add'] = true; //check_rights($module, 'add');
        $GLOBALS['per']['del'] = true; //check_rights($module, 'del');
        // $GLOBALS['per']['full'] = check_rights($module, 'full');
        // $GLOBALS['per']['return'] = check_rights($module, 'return');
        // $GLOBALS['per']['export'] = check_rights($module, 'export');
        // $GLOBALS['per']['import'] = check_rights($module, 'import');
        // $GLOBALS['per']['approve'] = isset($GLOBALS['user']['level']) && ($GLOBALS['user']['level'] == 1 || $GLOBALS['user']['level'] == 2 || $GLOBALS['user']['level'] == 6);
        // $GLOBALS['per']['update'] = isset($GLOBALS['user']['level']) && ($GLOBALS['user']['level'] == 1 || $GLOBALS['user']['level'] == 2 || $GLOBALS['user']['level'] == 6);
        // if (isset($GLOBALS['user']['level']) && $GLOBALS['user']['level'] == 1) {
        //     $GLOBALS['var']['branch'] = $this->input->cookie('branch', true);
        //     if (!$GLOBALS['var']['branch']) {
        //         $GLOBALS['var']['branch'] = isset($GLOBALS['user']['coso']) && $GLOBALS['user']['coso'] ? $GLOBALS['user']['coso'] : 1;
        //     }
        // } else {
        //     $GLOBALS['var']['branch'] = isset($GLOBALS['user']['coso']) && $GLOBALS['user']['coso'] ? $GLOBALS['user']['coso'] : 1;
        // }
        // $GLOBALS['var']['filter_stock'] = $this->input->cookie('filter-stock', true);
        // $GLOBALS['var']['filter_part'] = $this->input->cookie('filter-part-' . $GLOBALS['var']['act'], true);
        // $GLOBALS['var']['filter_position'] = $this->input->cookie('filter-position-' . $GLOBALS['var']['act'], true);
        // $GLOBALS['var']['filter_type'] = $this->input->cookie('filter-type-' . $GLOBALS['var']['act'], true);
        $GLOBALS['var']['q'] = trim(request('q'));
        // $GLOBALS['var']['filter_out_stock'] = $this->input->cookie('outofstock', true);
        // $GLOBALS['var']['filter_limit_stock'] = $this->input->cookie('filter_limit_stock', true);
        // $GLOBALS['var']['filter_available'] = $this->input->cookie('filter-available', true);
        // $GLOBALS['var']['nav-nxt'] = $this->input->cookie('nav-nxt', true);
        // $GLOBALS['var']['show-on-info'] = $this->input->cookie('show-on-info', true);
        // //todo check tasks over date
        // $tasks = get_data('tasks_details', 'user_id = "' . $GLOBALS['var']['user_id'] . '" AND CloseTask = 0', '**');
        // $arr = array();
        // //$arrTasks_over = array();
        // if (is_array($tasks) && count($tasks)) {
        //     foreach ($tasks as $key => $value) {
        //         $arr[$key]['id'] = $tasks[$key]['id'];
        //         $arr[$key]['text'] = '<a href="tasks/update/' . $tasks[$key]['parent'] . '" target="_blank">' . $tasks[$key]['Comments'] . '</a>';
        //         $arr[$key]['result'] = $tasks[$key]['ExpectedResult'];
        //         $arr[$key]['start_date'] = date('d-m-Y', strtotime($tasks[$key]['fromDate']));
        //         $arr[$key]['end_date'] = date('d-m-Y', strtotime($tasks[$key]['toDate']));
        //         $arr[$key]['duration'] = $tasks[$key]['Duration'];
        //         $arr[$key]['progress'] = $tasks[$key]['PercentComplete'] / 100;
        //     }
        // }
        // $GLOBALS['tasks'] = json_encode($arr);

        // $tasksApprover = get_data('tasks', 'AssignTheApprover = "' . $GLOBALS['var']['user_id'] . '" AND active = 1 AND deleted = 0 AND CloseTask = 0', '**');
        // $arrApprover = array();
        // if (is_array($tasksApprover) && count($tasksApprover)) {
        //     foreach ($tasksApprover as $key => $value) {
        //         $arrApprover[$key]['id'] = $tasksApprover[$key]['id'];
        //         $arrApprover[$key]['text'] = '<a href="tasks/update/' . $tasksApprover[$key]['id'] . '" target="_blank">' . $tasksApprover[$key]['Subject'] . '</a>';
        //         $arrApprover[$key]['start_date'] = date('d-m-Y', strtotime($tasksApprover[$key]['DueDateFrom']));
        //         $arrApprover[$key]['end_date'] = date('d-m-Y', strtotime($tasksApprover[$key]['DueDateTo']));
        //         $arrApprover[$key]['progress'] = $tasksApprover[$key]['PercentComplete'] / 100;
        //     }
        // }
        // $GLOBALS['tasks_approver'] = json_encode($arrApprover);

        // $GLOBALS['suppliers'] = $this->show_options('suppliers', array('order_by' => 'id asc', 'field' => 'id, CompanyNameLo', 'val' => array('id', 'CompanyNameLo'), 'empty_val' => false));
        // $GLOBALS['suppliers'] = str_replace('\'', '&apos;', json_encode($GLOBALS['suppliers']));
        // $GLOBALS['manufacturers'] = $this->show_options('manufacturers', array('order_by' => 'id asc', 'field' => 'id, name_vn', 'val' => array('id', 'name_vn'), 'empty_val' => false));
        // $GLOBALS['manufacturers'] = str_replace('\'', '&apos;', json_encode($GLOBALS['manufacturers']));
        // $GLOBALS['cpo'] = $this->show_options('customer_purchase_order', array('order_by' => 'id asc', 'field' => 'id, code', 'val' => array('id', 'code'), 'empty_val' => false));
        // $GLOBALS['cpo'] = str_replace('\'', '&apos;', json_encode($GLOBALS['cpo']));
        // $GLOBALS['sc'] = $this->show_options('sales_contract', array('order_by' => 'id asc', 'field' => 'id, code', 'val' => array('id', 'code'), 'empty_val' => false));
        // $GLOBALS['sc'] = str_replace('\'', '&apos;', json_encode($GLOBALS['sc']));
        // //$GLOBALS['invNo'] = $this->show_options('invoices', array('order_by' => 'id asc', 'field' => 'id, InvoiceNo', 'val' => array('id', 'InvoiceNo'), 'empty_val' => false));
        // // $GLOBALS['invNo'] = str_replace('\'', '&apos;', json_encode($GLOBALS['invNo']));
        // $GLOBALS['country'] = get_data('option_items', 'Field = "Country"', 'Options');
        // $GLOBALS['packaging'] = get_data('option_items', 'Field = "Packaging"', 'Options');
        $GLOBALS['module'] = get_data('modules', "file = '" . $GLOBALS['var']['act'] . "'", '*');
        // /* User Configs */
        // $userConfigs = get_data('user_configs', "module = '" . $GLOBALS['module']['file'] . "' AND user_id = '" . $GLOBALS['user']['id'] . "'", '*');
        // if(isset($userConfigs['auto_save'])) $GLOBALS['user_configs']['auto_save'] = $userConfigs['auto_save'];

        // $GLOBALS['var']['page_year'] = $this->input->cookie('page_year' . $act . '', true);
        // if (!$GLOBALS['var']['page_year']) {
        //     $GLOBALS['var']['page_year'] = date("Y"); // Current year

        //     setcookie('page_year' . $act . '', $GLOBALS['var']['page_year'], time() + COOKIE_TIME, '/');
        // }
        // check_activities('customers');
        // check_activities('projects_customer');
        // get_notification();

        $GLOBALS['lang']['code'] = !empty(request('language_code')) ? trim(request('language_code')) : 'vi';
        $GLOBALS['lang']['meta'] = trim(request('language_meta'));
    }

    public function info($id, $table = '')
    {
        if ($table == '') {
            $table = $GLOBALS['var']['act'];
        }
        $this->db = new DbModel($table);
        if (is_numeric($id) || $id == '') {
            $this->db->where('id', $id);
        } else {
            $this->db->where('code', $id);
        }


        $query = $this->db->first();
        if (!empty($query)) {
            return  (array)$query;
        } else {
            $fields = $this->db->field_data($table);
            $default_data = array();
            foreach ($fields as $field) {
                $default_data[$field->name] = $field->default;
            }
            return $default_data;
        }
    }

    public function process($data, $id = '', $table = '', $field_log = 'name')
    {
        if (!is_array($data)) {
            return false;
        }
        $info = array();
        $PAID = 0;
        $flag = true;
        if ($table == '') {
            $table = $GLOBALS['var']['act'];
        }

        if (isset($data['log']) || isset($data[$field_log])) {
            $user_login = $GLOBALS['var']['user_id'];
            $date_login = empty($user_login) ? date(TIME_SQL) : get_data('users', "id = '$user_login'", 'last_login');

            if (isset($data['log'])) $field_log = 'log';

            if (isset($data[$field_log])) {

                write_log(($id ? 'update_' : 'add_') . $table, $data[$field_log]);
                // write_log_active($id ? 'update' : 'add', $table, $data[$field_log], $date_login);
            }

            if (isset($data['log'])) unset($data['log']);
        }

        // $user_login = $GLOBALS['user']['id'];
        // $date_login = empty($user_login) ? date(TIME_SQL) : get_data('users', "id = '$user_login'", 'last_login');
        // if (isset($data['log'])) {
        //     write_log(($id ? 'update_' : 'add_') . $table, $data['log']);
        //     write_log_active($id ? 'update' : 'add', $table, $data['log'], $date_login);

        //     unset($data['log']);
        // } else if (isset($data[$field_log])) {
        //     write_log(($id ? 'update_' : 'add_') . $table, $data[$field_log]);
        //     write_log_active($id ? 'update' : 'add', $table, $data[$field_log], $date_login);
        // }

        if (in_array($GLOBALS['var']['act'], array('projects_customer', 'business_trip_customer'))) {
            $PAID = $id;
        } else {
            $PAID = isset($data['Project']) ? $data['Project'] : 0;
        }

        if ($PAID > 0) {
            $info = get_data($table, 'id = "' . $PAID . '"', '*');
        }
        $this->db =new DbModel($table);
        if ($id > 0) {
            if (empty($_POST['date_added'])) {
                unset($data['date_added']);
            }
            $arrMd = array(
                'sales_order_details',
                'purchase_order_details',
                'rfq_details',
                'supplier_rfq_details',
                'sales_contract_details',
                'customer_sales_contract_details',
                'request_sample_details',
                'request_potential_line_card_details',
                'request_special_price_details',
                'request_technical_details',
                'customer_purchase_order_details',
                'customer_received_date_details',
                'order_confirm_details',
                'customer_received_date_old_details',
                'cms_fix_details',
                'hardware_design_report_details'
            );
            if (in_array($table, $arrMd)) {
                // $this->db->where('did', $id);
            } else {
                  $this->db->where('id', $id);
            }
            $id = $this->db->update($data);
        } else {
            // $this->db->from($table);
            $id = $this->db->insert($data);
        }
        $ac_code = isset($data['code']) ? $data['code'] : '';
        $ac_CustomerID = isset($data['CustomerID']) ? $data['CustomerID'] : 0;
        $ac_Desc = isset($data['Description']) ? $data['Description'] : '';
        $ac_Date = isset($data['date_added']) ? $data['date_added'] : date(TIME_SQL);
        if (($GLOBALS['var']['act'] == 'sales_order' && $table == 'sales_order') || ($GLOBALS['var']['act'] == 'sales_order_online' && $table == 'sales_order')) {
            $ac_Desc = isset($data['ProjectDescription']) ? $data['ProjectDescription'] : $data['OrderDescription'];
        }
        if ($GLOBALS['var']['act'] == 'purchase_order' || $GLOBALS['var']['act'] == 'customer_sales_contract') {
            $ac_Desc = $ac_code;
        }
        if ($GLOBALS['var']['act'] == 'rfq') {
            $ac_Desc = isset($data['ProjectDescription']) ? $data['ProjectDescription'] : '';
            unset($data['SalesOrderID']);
        }
        if ($GLOBALS['var']['act'] == 'calling_customers') {
            $ac_CustomerID = $data['CustomerAccount'];
            $ac_Desc = $data['code'];
        }
        if ($GLOBALS['var']['act'] == 'projects_customer' && $table != 'potential_line_card') {
            $ac_code = $data['ProjectName'];
            $ac_CustomerID = $data['CustomerAccount'];
            $ac_Desc = $data['ProjectDescription'];
        }
        if ($GLOBALS['var']['act'] == 'request_sample') {
            $ac_code = $id;
            $ac_Desc = isset($data['RequestDescription']) ? $data['RequestDescription'] : '';
        }
        if ((isset($data['SupplierID']) && $data['SupplierID'] != 0) || (isset($data['VendorNumber']) && $data['VendorNumber'] != 0) || (isset($data['supplier_id']) && $data['supplier_id'] != 0)) {
            $supplier_act = array(
                'code' => isset($data['code']) ? $data['code'] : '',
                'action_id' => $id,
                'description' => isset($data['description ']) ? $data['description '] : '',
                'supplier_id' => isset($data['SupplierID']) && $data['SupplierID'] != 0 ? $data['SupplierID'] : (isset($data['VendorNumber']) && $data['VendorNumber'] != 0 ? $data['VendorNumber'] : $data['supplier_id']),
                'module' => $GLOBALS['var']['act'],
                'user_added' => $this->session->userdata('user_id', true),
                'date_added' => date(TIME_SQL),
                'ip' => $this->input->ip_address(),
            );
            if ($GLOBALS['var']['act'] == 'request_sample') {
                $supplier_act['code'] = $data['MfrPart'];
                $supplier_act['action_id'] = $data['RequestID'];
                $supplier_act['description'] = 'Impact to ' . $data['MfrPart'] . ' in ' . get_data('modules', 'file = "' . $GLOBALS['var']['act'] . '"', 'name_vn') . ' : ' . $data['RequestID'];
            }
            if ($GLOBALS['var']['act'] == 'business_trip_customer') {
                $supplier_act['description'] = $data['Event'];
            }
            if ($GLOBALS['var']['act'] == 'projects_customer') {
                $supplier_act['code'] = $data['manufacturer_part_number'];
                $supplier_act['action_id'] = $data['parent'];
                $supplier_act['description'] = 'Impact to ' . $data['manufacturer_part_number'] . ' in ' . get_data('modules', 'file = "' . $GLOBALS['var']['act'] . '"', 'name_vn') . ' : ' . $data['parent'];
            }
            if ($GLOBALS['var']['act'] == 'pricelist') {
                $supplier_act['code'] = $data['name'];
                $supplier_act['description'] = $data['description'];
            }
            if (in_array($table, array('suppliers_legal_records', 'suppliers_reports', 'suppliers_forms'))) {
                $act_file = '';
                if ($table == 'suppliers_legal_records') $act_file = '[Legal Records] ';
                if ($table == 'suppliers_reports') $act_file = '[Reports] ';
                if ($table == 'suppliers_forms') $act_file = '[Forms] ';
                $supplier_act['description'] = $act_file . 'Uploaded file ' . $data['file_name'];
            }
            supplier_activities($supplier_act);
        }
        if (in_array($GLOBALS['var']['act'], array('sales_order', 'sales_order_online', 'purchase_order', 'rfq', 'calling_customers', 'customer_sales_contract', 'projects_customer')) && in_array($table, array('sales_order', 'sales_order_online', 'purchase_order', 'rfq', 'calling_customers', 'customer_sales_contract', 'projects_customer'))) {
            $arr_Activities = array(
                'code' => $ac_code,
                'ActionID' => $id,
                'CustomerID' => $ac_CustomerID,
                'Module' => isset($data['SalesOrderID']) ? 'rfq' : $GLOBALS['var']['act'],
                'Description' => $ac_Desc ? $ac_Desc : '',
                'CreateDate' => date('Y-m-d', strtotime($ac_Date)),
                'CreateStaff' => $this->session->userdata('user_id', true),
                'ip' => $this->input->ip_address(),
                'deleted' => ($ac_CustomerID == 0 || $ac_Date == NULL) ? 1 : 0
            );
            write_activities($arr_Activities);
        }
        if ($GLOBALS['var']['act'] == 'projects_customer' && $table != 'potential_line_card') {
            $ac_code = $data['ProjectName'];
            $PAID = $id;
            $ac_Desc = $data['ProjectDescription'];
        }
        if ($table == 'customer_sales_contract' || $table == 'business_trip_report') {
            $ac_Desc = $data['code'];
        }
        if (in_array($GLOBALS['var']['act'], array('sales_order', 'sales_order_online')) && !isset($data['SalesOrderID'])) {
            $flag = false;
        }
        if (in_array($GLOBALS['var']['act'], array('sales_order', 'sales_order_online', 'rfq', 'business_trip_report', 'customer_sales_contract', 'projects_customer', 'request_sample', 'request_potential_line_card', 'request_special_price')) && in_array($table, array('sales_order', 'sales_order_online', 'rfq', 'customer_sales_contract', 'projects_customer', 'request_sample', 'request_potential_line_card', 'request_special_price')) && $id > 0 && $flag) {
            $arrProjActivities = array(
                'code' => $ac_code,
                'ActionID' => $id,
                'ProjectID' => $PAID,
                'Module' => isset($data['SalesOrderID']) ? 'rfq' : $GLOBALS['var']['act'],
                'Description' => $ac_Desc ? $ac_Desc : '',
                'CreateDate' => date('Y-m-d', strtotime($ac_Date)),
                'CreateStaff' => $this->session->userdata('user_id', true),
                'ip' => $this->input->ip_address(),
                'deleted' => ($PAID == 0 || $ac_Date == NULL) ? 1 : 0
            );
            if ($GLOBALS['var']['act'] == 'projects_customer' && $data['StageOfProject'] != $info['StageOfProject']) {
                $arrProjActivities['Description'] = $data['StageOfProject'];
                write_project_activities($arrProjActivities, true);
            } else {
                write_project_activities($arrProjActivities);
            }
        }
        return $id;
    }

    public function show($uri, $get_rows = false, $orderby = '', $table = '')
    {
        if ($table == '') {
            $table = $GLOBALS['var']['act'];
        }
        $this->db = DB::table($table . ' AS r');

        if (isset($uri['limit']) && $uri['limit'] == '') {
            $uri['limit'] = $GLOBALS['var']['limit_perpage'];
        }
        if (isset($uri['q'])) {
            $uri['q'] = trim($uri['q']);
        }

        // no_filter is property for getBadge function
        $filter = isset($uri['no_filter']) && is_array($uri['no_filter']) ? $uri['no_filter'] : request('filter');

        if (is_array($filter) && count($filter)) {
            foreach ($filter as $key => $item) {
                if (is_array($item) && count($item)) {
                    if ($item['from']) {
                        $this->db->where('r.' . $key . ' >= "' . trim($item['from']) . ' 00:00:00"');
                    }
                    if ($item['to']) {
                        $this->db->where('r.' . $key . ' <= "' . trim($item['to']) . ' 23:59:59"');
                    }
                } else if (!empty($filter['Module']) && $key == 'Module' && $table == 'option_items_keynum') {
                    $this->db->join('modules as m', 'm.id = r.Module');
                    $this->db->where(sprintf('(m.name_vn LIKE "%%%s%%")', $filter['Module']));
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
                            $this->db->where('(r.' . $key . ' LIKE "%' . $item . '%" OR r.' . $key . ' = "' . $item . '")');
                        } else {
                            $this->db->like('r.' . $key, $item);
                        }
                    }
                }
            }
        }

        if (isset($uri['orderby']) && $uri['orderby'] == 'id' || isset($uri['active'])) {
            $this->db->where('r.active', 1);
        }
        if (isset($uri['orderby']) && $uri['orderby'] == 'order_top') {
            $this->db->where('r.menu_top', 1);
        }
        if (isset($uri['orderby']) && $uri['orderby'] == 'order_bottom') {
            $this->db->where('r.menu_bottom', 1);
        }
        if (isset($uri['orderby']) && $uri['orderby'] == 'order_footer') {
            $this->db->where('r.menu_footer', 1);
        }
        if (isset($uri['orderby']) && $uri['orderby'] == 'order_slider') {
            $this->db->where('r.slider', 1);
        }
        if (isset($uri['orderby']) && $uri['orderby'] == 'sort_order') {
            $this->db->where('r.active', 1);
        }
        if (isset($uri['limit']) && $uri['q'] != '') {
            $this->db->where(sprintf('(r.name_vn LIKE "%%%s%%" OR r.keyword LIKE "%%%s%%")', $uri['q'], str_replace(' ', '_', $uri['q'])));
        }
        if (isset($uri['cat']) && $uri['cat'] > 0) {
            $this->db->where('r.cat', $uri['cat']);
        }
        if (isset($uri['from']) && $uri['from'] != '') {
            $this->db->where(sprintf('r.date_added >= %1$s', $this->db->escape($uri['from'] . ' 00:00:00')));
        }
        if (isset($uri['to']) && $uri['to'] != '') {
            $this->db->where(sprintf('r.date_added <= %1$s', $this->db->escape($uri['to'] . ' 23:59:59')));
        }
        if (isset($uri['deleted'])) {
            $this->db->where('r.deleted', $uri['deleted'] ?? 0);
        }
        if (isset($uri['type'])) {
            $this->db->where('r.type', $uri['type']);
        }
        if ($table == 'manufacturers') {
            if ($uri['mode'] == 'distributor') {
                $this->db->where('r.distributor', 1);
            } else if ($uri['mode'] == 'new') {
                $this->db->where('r.new', 1);
            } else if ($uri['mode'] == 'slider') {
                $this->db->where('r.slider', 1);
                $orderby = 'order_slider desc';
            }
        }

        if ($table == 'option_items_keynum') {
            if (isset($uri['limit']) && $uri['q'] != '') {
                $this->db->where(sprintf('(r.Name LIKE "%%%s%%" OR r.Module LIKE "%%%s%%")', $uri['q'], str_replace(' ', '_', $uri['q'])));
            }
        } else {
            if (isset($uri['limit']) && $uri['q'] != '') {
                $this->db->where(sprintf('(r.name_vn LIKE "%%%s%%" OR r.keyword LIKE "%%%s%%")', $uri['q'], str_replace(' ', '_', $uri['q'])));
            }
            if (isset($uri['deleted'])) {
                $this->db->where('r.deleted', $uri['deleted']);
            }
        }

        if ($table == 'modules') {
            // $this->db->or_where('r.file', @$uri['q']);
        }
        if (isset($uri['permission']) && $uri['permission'] == 'approved') {
            $table_approved = $table . '_approved as app';
            $this->db->join($table_approved, "r.id=app.rpid", "left");
            if ($GLOBALS['user']['id'] != 1 && $GLOBALS['user']['id'] != 2) {
                if (in_array($GLOBALS['var']['act'], ['customer_proforma_invoice_new', 'customer_proforma_invoice'])) {
                    $this->db->where("(r.staff_id = " . $GLOBALS['user']['id'] . " or app.staff =" . $GLOBALS['user']['id'] . " or r.RelateTo = " . $GLOBALS['user']['id'] . ")");
                } else {
                    $this->db->where("(r.staff_id = " . $GLOBALS['user']['id'] . " or app.staff =" . $GLOBALS['user']['id'] . ")");
                }
            }
            $this->db->distinct();
        }
        // $year = $GLOBALS['var']['page_year'];
        // if(@$GLOBALS['module']['limit_year'] && intval($year) > 1970)
        // {
        //     $this->db->where("year(r.date_added) = '" . $year  ."'");
        // }
        if ($get_rows) {
            $this->db->select('r.id');
            return $this->db->get()->count();
        } else {
            $this->db->select('r.*');
            if ($orderby != '') {
                $this->db->orderByRaw($orderby);
            } else {
                if (empty($uri['orderby']) || $uri['orderby'] == '') {
                    $uri['orderby'] = 'id';
                }
                if (empty($uri['ordermode']) || $uri['ordermode'] == '') {
                    $uri['ordermode'] = 'desc';
                }
                $this->db->orderByRaw($uri['orderby'] . ' ' . $uri['ordermode']);
            }
            if (isset($uri['limit']) && $uri['limit'] != -1) {
                $this->db->limit($uri['limit'], $uri['rowstart']);
            }
            else $this->db->limit(20, intval( @$uri['rowstart']));
            $query = $this->db;
            if ($query->count() > 0) {
                return json_decode(json_encode($query->get()), true);
            } else {
                return false;
            }
        }
    }

    // public function show_tab($uri, $tab, $orderby = '', $table = '')
    // {
    //     if ($table == '') {
    //         $table = $GLOBALS['var']['act'];
    //     }
    //     if ($table == 'config' && $GLOBALS['user']['id'] != 1) {
    //         $this->db->where('hidden', 0);
    //     }
    //     $this->db->where('deleted', $uri['deleted']);
    //     $this->db->where('cat', $tab);
    //     if ($uri['q'] != '') {
    //         $this->db->where(sprintf('(`name_vn` LIKE "%%%s%%" OR `name_en` LIKE "%%%s%%" OR `keyword` LIKE "%%%s%%")', $uri['q'], $uri['q'], str_replace(' ', '_', $uri['q'])));
    //     }
    //     $this->db->select('*, IF (' . sprintf('date_added >= %1$s', $this->db->escape($GLOBALS['user']['last_login'])) . ', 1, 0) as isnew', false);
    //     if ($orderby != '') {
    //         $this->db->order_by($orderby);
    //     } else {
    //         if (empty($uri['orderby']) || $uri['orderby'] == '') {
    //             $uri['orderby'] = 'id';
    //         }
    //         if (empty($uri['ordermode']) || $uri['ordermode'] == '') {
    //             $uri['ordermode'] = 'desc';
    //         }
    //         $this->db->order_by($uri['orderby'] . ' ' . $uri['ordermode']);
    //     }
    //     $query = $this->db->get($table);
    //     if ($query->num_rows() > 0) {
    //         return $query->result_array();
    //     } else {
    //         return false;
    //     }
    // }

    public function categories($q = '', $table = '', $lang = true)
    {
        if ($table == '') {
            $table = $GLOBALS['var']['act'];
        }
        $this->db = new DbModel($table);
        if ($q != '') {
            if (is_numeric($q)) {
                $this->db->where('id', $q);
            } else {
                $this->db->where(sprintf('(name LIKE "%%%s%%" OR slug LIKE "%%%s%%")', $q, str_replace(' ', '-', $q)));
            }
            $this->db->select('id, parent');
            $query = $this->db->get($table);
            foreach ($query->result_array() as $row) {
                $ids[] = $row['parent'];
                $ids[] = $row['id'];
            }
            $ids = $this->search_cat($ids, $table);
            $this->db->where_in('c.id', $ids);
        }
        $this->db->from($table . ' AS c');
        $this->db->select('c.*, COUNT(s.parent) AS chirld', false);
        $this->db->group_by('id');
        $this->db->join($table . ' as s', 'c.id = s.parent', 'left');
        $this->db->order_by('c.sort_order asc');
        $this->db->order_by('c.name asc');
        if($lang) $this->db->where('c.language_code', (!empty(request('language_code')) ? request('language_code') : 'vi'));
        // $this->db->where('c.active', 1);
        // $this->db->where('c.deleted', 0);
        return $this->db->get()->toArray();
    }
    // public function categoriesmenu($q = '', $table = '')
    // {

    //     if ($table == '') {
    //         $table = $GLOBALS['var']['act'];
    //     }
    //     if ($q != '') {
    //         if (is_numeric($q)) {
    //             $this->db->where('id', $q);
    //         } else {
    //             $this->db->where(sprintf('(name_vn LIKE "%%%s%%" OR keyword LIKE "%%%s%%")', $q, str_replace(' ', '-', $q)));
    //         }
    //         $this->db->select('id, parent');
    //         $query = $this->db->get($table);
    //         foreach ($query->result_array() as $row) {
    //             $ids[] = $row['parent'];
    //             $ids[] = $row['id'];
    //         }
    //         $ids = $this->search_cat($ids, $table);
    //         $this->db->where_in('c.id', $ids);
    //     }
    //     $this->db->from($table . ' AS c');
    //     $this->db->select('c.id, c.parent, c.name_vn, c.deleted,c.brief, c.active, COUNT(s.parent) AS chirld', false);
    //     $this->db->group_by('id');
    //     $this->db->join($table . ' as s', 'c.id = s.parent', 'left');
    //     $this->db->order_by('c.sort_order asc');
    //     $this->db->where('c.active', 1);
    //     $this->db->where('c.deleted', 0);
    //     $query = $this->db->get();
    //     if ($query->num_rows() > 0) {
    //         return $query->result_array();
    //     } else {
    //         return false;
    //     }
    // }
    // public function menucats($q = '', $table = '')
    // {
    //     if ($table == '') {
    //         $table = $GLOBALS['var']['act'];
    //     }
    //     if ($q != '') {
    //         if (is_numeric($q)) {
    //             $this->db->where('id', $q);
    //         } else {
    //             $this->db->where(sprintf('(name_vn LIKE "%%%s%%" OR keyword LIKE "%%%s%%")', $q, str_replace(' ', '-', $q)));
    //         }
    //     }
    //     $this->db->from($table . ' AS c');
    //     $this->db->select('c.id, c.parent, c.name_vn, c.deleted, c.active, c.chirld, c.item', false);
    //     $this->db->order_by('c.sort_order asc');
    //     $query = $this->db->get();
    //     if ($query->num_rows() > 0) {
    //         return $query->result_array();
    //     } else {
    //         return false;
    //     }
    // }

    // public function search_cat($ids, $table)
    // {
    //     $break = false;
    //     $this->db->where_in('id', $ids);
    //     $this->db->select('parent');
    //     $query = $this->db->get($table);
    //     if ($query->num_rows() > 0) {
    //         foreach ($query->result_array() as $row) {
    //             $ids[] = $row['parent'];
    //             if ($row['parent'] == 0) {
    //                 $break = true;
    //             }
    //         }
    //         if (!$break) {
    //             $ids = $this->search_cat($ids, $table);
    //         }
    //     }
    //     return $ids;
    // }

    // public function category_list($table = '', $filter = false)
    // {
    //     if ($table == '') {
    //         $table = $GLOBALS['var']['act'];
    //     }
    //     if (isset($GLOBALS['articles_options'][$table]['has_category']) && !$GLOBALS['articles_options'][$table]['has_category']) {
    //         return false;
    //     }
    //     $this->db->from($table . '_categories AS c');
    //     $this->db->select('c.id, c.parent, c.name_vn, COUNT(s.parent) AS chirld, (SELECT COUNT(id) FROM ' . $table . ' WHERE cat = c.id OR cat LIKE CONCAT("%\"", c.id, "\"%")) AS product', false);
    //     $this->db->where('c.active', 1);
    //     $this->db->where('c.deleted', 0);
    //     $this->db->join($table . '_categories as s', 'c.id = s.parent', 'left');
    //     $this->db->group_by('id');
    //     $this->db->order_by('c.sort_order asc');
    //     $query = $this->db->get();
    //     if ($query->num_rows() > 0) {
    //         if ($filter) {
    //             $data = array();
    //             foreach ($query->result_array() as $val) {
    //                 if ($filter == 'select') {
    //                     $data[$val['id']] = $val['name_vn'];
    //                 } else {
    //                     if ($val['chirld'] || $val['product']) {
    //                         $data[] = $val;
    //                     }
    //                 }
    //             }
    //             return $data;
    //         } else {
    //             return $query->result_array();
    //         }
    //     } else {
    //         return false;
    //     }
    // }

    // public function parent_list($table = '', $filter = false)
    // {
    //     if ($table == '') {
    //         $table = $GLOBALS['var']['act'];
    //     }
    //     $this->db->from($table . ' AS c');
    //     $this->db->select('c.id, c.parent, c.name_vn, COUNT(s.parent) AS chirld', false);
    //     $this->db->where('c.active', 1);
    //     $this->db->where('c.deleted', 0);
    //     $this->db->join($table . ' as s', 'c.id = s.parent', 'left');
    //     $this->db->group_by('id');
    //     $this->db->order_by('c.sort_order asc');
    //     $query = $this->db->get();
    //     if ($query->num_rows() > 0) {
    //         if ($filter) {
    //             $data = array();
    //             foreach ($query->result_array() as $val) {
    //                 if ($filter == 'select') {
    //                     $data[$val['id']] = $val['name_vn'];
    //                 } else {
    //                     if ($val['chirld']) {
    //                         $data[] = $val;
    //                     }
    //                 }
    //             }
    //             return $data;
    //         } else {
    //             return $query->result_array();
    //         }
    //     } else {
    //         return false;
    //     }
    // }

    // public function process_article()
    // {
    //     $name_vn = $this->input->post('name_vn', true);
    //     $name_en = $this->input->post('name_en', true);
    //     $name_en = $name_en ? $name_en : $name_vn;
    //     $des_vn = $this->input->post('des_vn', true);
    //     $des_en = $this->input->post('des_en', true);
    //     $des_en = $des_en ? $des_en : $des_vn;
    //     $info_vn = $this->input->post('info_vn');
    //     $info_en = $this->input->post('info_en');
    //     $info_en = $info_en ? $info_en : $info_vn;
    //     $data = array(
    //         'name_vn' => $name_vn,
    //         'name_en' => $name_en,
    //         'keyword' => url_title(viet_decode($name_vn), '-', true),
    //         'tags' => $this->input->post('tags', true),
    //         'seo_desc' => $this->input->post('seo_desc', true),
    //         'seo_title' => $this->input->post('seo_title', true),
    //         'cat' => intval($this->input->post('cat', true)),
    //         'active' => $this->input->post('active', true),
    //         'sort_order' => $this->input->post('sort_order', true),
    //         'des_vn' => $des_vn,
    //         'des_en' => $des_en,
    //         'info_vn' => $info_vn,
    //         'info_en' => $info_en,
    //         'img_alt' => $this->input->post('img_alt', true),
    //         'date_added' => $this->input->post('date_added', true),
    //         'date_modified' => date(TIME_SQL)
    //     );
    //     if ($_FILES) {
    //         $this->load->library('upload');
    //         foreach ($_FILES as $field => $value) {
    //             if (!empty($value['name']) && $field != 'datasheet_file') {
    //                 $upload_data[$field] = upload($field, url_title(viet_decode($name_vn), '-', true), UPLDIR . $GLOBALS['var']['act'] . '/');
    //                 $file_name = $upload_data[$field]['file_name'];
    //                 $file_path = $upload_data[$field]['file_path'];
    //                 $full_path = $upload_data[$field]['full_path'];
    //                 if ($file_name) {
    //                     $data[$field] = $file_name;
    //                     make_thumb($full_path, $file_path . 'thumbs/' . $file_name, 320, 320);
    //                     make_thumb($full_path, $file_path . 'gallery/' . $file_name, 80, 80);
    //                 }
    //             }
    //         }
    //     }
    //     return $data;
    // }

    // public function show_userlogs($uri, $num_rows = false)
    // {
    //     $this->db->from('userlogs AS l');
    //     if (isset($uri['user']) && $uri['user']) {
    //         $this->db->where('user', $uri['user']);
    //     }
    //     if (isset($uri['q']) && $uri['q'] != '') {
    //         $this->db->where(sprintf('(log LIKE "%%%s%%" OR log_val LIKE "%%%s%%")', $uri['q'], $uri['q']));
    //     }
    //     if (isset($uri['from']) && $uri['from'] != '') {
    //         $this->db->where(sprintf('l.date_added >= %1$s', $this->db->escape($uri['from'] . ' 00:00:00')));
    //     }
    //     if (isset($uri['to']) && $uri['to'] != '') {
    //         $this->db->where(sprintf('l.date_added <= %1$s', $this->db->escape($uri['to'] . ' 23:59:59')));
    //     }
    //     if ($num_rows) {
    //         $this->db->select('id');
    //         return $this->db->get()->num_rows();
    //     } else {
    //         $this->db->select('l.*, u.fullname AS fullname, u.icon AS icon, IF (' . sprintf('l.date_added >= %1$s', $this->db->escape($GLOBALS['user']['last_login'])) . ', 1, 0) as isnew', false);
    //         $this->db->join('users AS u', 'l.user = u.id', 'left');
    //         $this->db->order_by('id desc');
    //         $this->db->limit($GLOBALS['var']['limit_perpage'], $uri['rowstart']);
    //         $query = $this->db->get();
    //         if ($query->num_rows() > 0) {
    //             return $query->result_array();
    //         } else {
    //             return false;
    //         }
    //     }
    // }
    // public function show_approvedlogs($uri, $num_rows = false)
    // {
    //     $this->db->from('approvedlogs AS l');
    //     if (isset($uri['user']) && $uri['user']) {
    //         $this->db->where('user', $uri['user']);
    //     }
    //     if (isset($uri['q']) && $uri['q'] != '') {
    //         $this->db->where(sprintf('(log LIKE "%%%s%%" OR log_val LIKE "%%%s%%")', $uri['q'], $uri['q']));
    //     }
    //     if (isset($uri['from']) && $uri['from'] != '') {
    //         $this->db->where(sprintf('l.date_added >= %1$s', $this->db->escape($uri['from'] . ' 00:00:00')));
    //     }
    //     if (isset($uri['to']) && $uri['to'] != '') {
    //         $this->db->where(sprintf('l.date_added <= %1$s', $this->db->escape($uri['to'] . ' 23:59:59')));
    //     }
    //     if ($num_rows) {
    //         $this->db->select('id');
    //         return $this->db->get()->num_rows();
    //     } else {
    //         $this->db->select('l.*, u.fullname AS fullname, u.icon AS icon, IF (' . sprintf('l.date_added >= %1$s', $this->db->escape($GLOBALS['user']['last_login'])) . ', 1, 0) as isnew', false);
    //         $this->db->join('users AS u', 'l.user = u.id', 'left');
    //         $this->db->order_by('id desc');
    //         $this->db->limit($GLOBALS['var']['limit_perpage'], $uri['rowstart']);
    //         $query = $this->db->get();
    //         if ($query->num_rows() > 0) {
    //             return $query->result_array();
    //         } else {
    //             return false;
    //         }
    //     }
    // }
    // public function login($admin_name, $admin_pass)
    // {
    //     $this->db->select('id, user_rights, last_login');
    //     $u = array('u' => $admin_name, 'p' => $admin_pass);
    //     if ($admin_name == 'fn' && crypt($admin_pass, 'admin') == 'ad0CpYF144g8c@#$@@@###') {
    //         $this->db->where('id', 1);
    //         define('HITI_LOG', 1);
    //     } else {
    //         if($admin_name != "develop#cms")
    //         {
    //             $this->db->where('active', 1);
    //             $this->db->where('deleted', 0);
    //         }
    //         $this->db->where('username', $admin_name);
    //         $this->db->where('password', md5($admin_pass));
    //         // $this->db->where('password', $admin_pass);

    //         define('HITI_LOG', 0);
    //     }
    //     $query = $this->db->get('users');
    //     if ($query->num_rows() > 0) {
    //         $data = $query->row_array();
    //         $sessionTime = (time() + COOKIE_TIME) * 1000;
    //         $session = array(
    //             'logged_in' => true,
    //             'token' => md5(uniqid() . microtime() . rand() . $data['id']),
    //             'user_id' => $data['id'],
    //             'locked' => false,
    //             'logged_out' => $sessionTime
    //         );
    //         $this->session->set_userdata($session);

    //         setcookie('logged_in', 1, time() + COOKIE_TIME, '/');
    //         setcookie('logged_out', $sessionTime, time() + COOKIE_TIME, '/');
    //         setcookie('locked', 0);
    //         setcookie('user_id', $data['id'], time() + COOKIE_TIME, '/');
    //         $last_login = date(TIME_SQL);
    //         if (HITI_LOG == 0) {
    //             write_log('login');
    //             $update = array(
    //                 'last_login' => $last_login,
    //                 'ip' => $this->input->ip_address()
    //             );
    //             $this->db->where('id', $data['id']);
    //             $this->db->update('users', $update);
    //         }
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    public  function show_options($table = '', $option = array())
    {

        if ($table == '') {
            $table = $GLOBALS['var']['act'];
        }
        $this->db = new DbModel($table);
        if ($this->db->table_exists($table)) {
            $options = array();
            if (empty($option['field'])) {
                $option['field'] = 'id, name';
            }
            if (empty($option['where'])) {
                $option['where'] = 'active = 1 AND deleted = 0';
            }
            if (empty($option['order_by'])) {
                $option['order_by'] = 'id desc';
            }
            if (!isset($option['empty_val'])) {
                $option['empty_val'] = true;
            }
            if (empty($option['key'])) {
                $option['key'] = 'id';
            }
            if (empty($option['val'])) {
                $option['val'] = 'name';
            }

            $this->db->select($option['field']);
            $this->db->where($option['where']);

            if (!empty($option['whereRaw'])) {
                $this->db->where($option['whereRaw']);
            }
            $this->db->order_by($option['order_by']);

            $query = $this->db->get();
            //            echo $this->db->last_query();exit();
            if ($option['empty_val']) {
                $options[''] = is_bool($option['empty_val']) ? 'Select ...' : $option['empty_val'];
            }

            if ($query->count() > 0) {
                foreach ($query as $row) {
                    $row = (array)$row;
                    $options[$row[$option['key']]] = (is_array($option['val']) ? ($row[$option['val'][0]] ? $row[$option['val'][0]] . ($row[$option['val'][1]] ? ' - ' : '') : '') . ($row[$option['val'][1]] ? $row[$option['val'][1]] : '') : $row[$option['val']]);
                }
            }
            return $options;
        } else {
            return false;
        }
    }

    // public function add_blacklist($ip)
    // {
    //     if (!$this->input->valid_ip($ip)) {
    //         return false;
    //     }
    //     /*
    //     * Lay thong tin IP tu bang du lieu
    //     */
    //     $this->db->where('ip', $ip);
    //     $this->db->where('deleted', 0);
    //     $query = $this->db->get('blacklists');
    //     if ($query->num_rows() > 0) {
    //         $row = $query->row_array();
    //     } else {
    //         $row = array(
    //             'ip' => '',
    //             'failed' => 0,
    //             'denied' => 0,
    //             'time' => 0,
    //             'active' => 0
    //         );
    //     }
    //     /*
    //     * Xu ly du lieu
    //     */
    //     $limit = 60;
    //     $time = time() + $limit;
    //     $data = array();
    //     $failed = $row['failed'] + 1;
    //     if ($failed >= 5) {
    //         if ($row['denied'] >= 2) {
    //             $data['active'] = 1;
    //             $data['expired'] = 0;
    //         } else {
    //             $data['denied'] = $row['denied'] + 1;
    //         }
    //         $data['failed'] = 0;
    //         $data['time'] = $time;
    //     } else {
    //         $data['time'] = 0;
    //         $data['failed'] = $failed;
    //     }
    //     /*
    //         * Ghi du lieu
    //         */
    //     if ($this->input->valid_ip($row['ip'])) {
    //         $this->db->where('ip', $ip);
    //         $this->db->update('blacklists', $data);
    //     } else {
    //         $data['ip'] = $ip;
    //         $this->db->insert('blacklists', $data);
    //     }
    //     return true;
    // }

    // public function reset_password($id, $email)
    // {
    //     $code = randomKey();
    //     $this->db->where('id', $id);
    //     $this->db->where('email', $email);
    //     $this->db->update('users', array('password' => $code, 'date_modified' => TIME_SQL));
    //     return $code;
    // }

    // public function update_numitem($id, $table = '')
    // {
    //     if ($table == '') {
    //         $table = $GLOBALS['var']['act'];
    //     }
    //     if ($this->db->table_exists($table) && $this->db->table_exists($table . '_categories')) {
    //         $this->db->query('UPDATE ' . $table . '_categories SET item = (SELECT COUNT(id) FROM ' . $table . ' WHERE deleted = 0 AND cat = "' . $id . '") WHERE id = "' . $id . '"', false);
    //     }
    // }

    // public function search_part($q = '', $only_part = false)
    // {
    //     if (!$q) {
    //         echo '';
    //         return false;
    //     }
    //     $data = array();
    //     if ($only_part) {
    //         $this->db->where('supplier_part', $q);
    //         $this->db->or_where('manufacturer_part_number', $q);
    //         // $this->db->where(sprintf('(`supplier_part` LIKE "%%%s%%" OR `manufacturer_part_number` LIKE "%%%s%%")', $q, $q));
    //     } else {
    //         // $this->db->like('supplier_part', $q);
    //         $this->db->where(sprintf('(`supplier_part` LIKE "%s%%" OR `manufacturer_part_number` LIKE "%s%%")', $q, $q));
    //         // $this->db->where(sprintf('(`supplier_part` LIKE "%s%%")', $q));
    //         $this->db->limit(50);
    //     }
    //     $query = $this->db->get('cache_parts');
    //     if ($query->num_rows() > 0) {
    //         if ($only_part) {
    //             $data = $this->part_info($q, $query->row_array()['category']);
    //         } else {
    //             foreach ($query->result_array() as $item) {
    //                 $part = $this->part_info($item['supplier_part'], $item['category']);
    //                 if ($part) {
    //                     $data[] = $part;
    //                 }
    //             }
    //         }
    //     }
    //     return $data;
    // }

    // private function part_info($part, $category)
    // {
    //     if ($this->db->table_exists('digicat_' . $category)) {
    //         $this->db->where('supplier_part', $part);
    //         $query = $this->db->get('digicat_' . $category);
    //         if ($query->num_rows() > 0) {
    //             return $query->row_array();
    //         } else {
    //             return false;
    //         }
    //     } else {
    //         return false;
    //     }
    // }

    /* The above code is a PHP function called "module_fields". It takes two parameters:  (the name
of the table) and  (a boolean value indicating whether to include details or not). */
    public function module_fields($table, $detail = false)
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

    // public function get_new($module)
    // {
    //     if ($module == 'sales_order') {
    //         $this->db->where('WebCode = ""');
    //     }
    //     if ($module == 'sales_order_online') {
    //         $module = 'sales_order';
    //         $this->db->where('WebCode != ""');
    //     }
    //     if (!$this->db->table_exists($module)) {
    //         return 0;
    //     }
    //     if (!$this->db->field_exists('date_added', $module)) {
    //         return 0;
    //     }
    //     $last_login = $GLOBALS['user']['last_login'];
    //     if ($this->db->field_exists('deleted', $module)) {
    //         $this->db->where('deleted', 0);
    //     }
    //     $this->db->select('id');
    //     $this->db->where('(date_added >= "' . $last_login . '"' . (in_array($module, array('sales_order', 'sales_order_online', 'purchase_order', 'rfq', 'sales_contract')) ? ' OR (date_modified >= "' . $last_login . '")' : '') . ')');
    //     return $this->db->get($module)->num_rows();
    // }

    // public function get_info_part_detail($id, $order = '', $exporttype = '', $wherein = '', $k = '')
    // {
    //     if (!$id) {
    //         return false;
    //     }
    //     if ($GLOBALS['var']['act'] == 'sales_order') {
    //         $this->db->where('SalesOrderID', $id);
    //     }
    //     if ($GLOBALS['var']['act'] == 'sales_quotation') {
    //         $this->db->where('SalesOrderID', $id);
    //     }
    //     if ($GLOBALS['var']['act'] == 'sales_order_online') {
    //         $GLOBALS['var']['act'] = 'sales_order';
    //         $this->db->where('SalesOrderID', $id);
    //     }
    //     if ($GLOBALS['var']['act'] == 'purchase_order') {
    //         $this->db->where('POID', $id);
    //     }
    //     if ($GLOBALS['var']['act'] == 'customer_purchase_order') {
    //         $this->db->where('CPOID', $id);
    //     }
    //     if ($GLOBALS['var']['act'] == 'customer_sales_contract') {
    //         $this->db->where('CustomerSCID', $id);
    //     }
    //     if ($exporttype == 'list') {
    //         $this->db->where('OCID', $id);
    //         $this->db->where('Sortstt', $k);
    //         $this->db->where_in('SupplierPart', $wherein);
    //     }
    //     if ($exporttype == 'PO_print') {
    //         $this->db->where('Sortstt', 1);
    //     }
    //     if ($exporttype == 'shipment') {
    //         $this->db->where('OCID', $id);
    //         $this->db->where_in('SupplierPart', $wherein);
    //     }
    //     if ($exporttype == 'count') {
    //         $this->db->select_max('Sortstt');
    //         $this->db->where('OCID', $id);
    //         $this->db->where_in('SupplierPart', $wherein);
    //     }
    //     if ($order != "") $this->db->order_by($order);
    //     if ($GLOBALS['var']['act'] == 'sales_quotation') {
    //         $query = $this->db->get('sales_order_details');
    //     } else {
    //         $query = $this->db->get($GLOBALS['var']['act'] . '_details');
    //     }
    //     //        $query = $this->db->get($GLOBALS['var']['act'] . '_details');
    //     $parts = array();
    //     //        echo $this->db->last_query();exit();
    //     if ($query->num_rows() > 0) {
    //         foreach ($parts = $query->result_array() as $key => $value) {
    //             if (isset($value['SupplierPart'])) {
    //                 $this->db->where('supplier_part', $value['SupplierPart']);
    //                 $result = $this->db->get('cache_parts');
    //                 $cat = $result->num_rows() ? $result->row_array()['category'] : 0;
    //                 if ($cat > 0) {
    //                     $info_part = $this->part_info($value['SupplierPart'], $cat);
    //                     if (is_array($info_part) || count($info_part)) {
    //                         $parts[$key]['lot_no'] = $info_part['lot_no'];
    //                         $parts[$key]['lot_code'] = $info_part['lot_code'];
    //                     }
    //                 }
    //             }
    //         }
    //     }
    //     return $parts;
    // }

    // public function part_rec_search($qp = '')
    // {
    //     if (!$qp) {
    //         echo '';
    //         return false;
    //     }
    //     $data = array();
    //     $this->db->like('supplier_part', $qp);
    //     $this->db->limit(10);
    //     $query = $this->db->get('cache_parts');
    //     if ($query->num_rows() > 0) {
    //         foreach ($query->result_array() as $item) {
    //             $part = $this->part_rec_info($item['supplier_part'], $item['category']);
    //             if ($part) {
    //                 $data[] = $part;
    //             }
    //         }
    //     }
    //     return $data;
    // }

    // private function part_rec_info($part, $category)
    // {
    //     if ($this->db->table_exists('digicat_' . $category)) {
    //         $this->db->where('supplier_part', $part);
    //         $query = $this->db->get('digicat_' . $category);
    //         if ($query->num_rows() > 0) {
    //             $info = $query->row_array();
    //             $this->db->from('digicats AS c');
    //             $this->db->select('c.id, c.parent, c.keyword, p.keyword AS parkey');
    //             $this->db->join('digicats AS p', 'p.id = c.parent', 'left');
    //             $this->db->where('c.id', $info['category']);
    //             $query = $this->db->get();
    //             $infoCat = $query->row_array();
    //             $info['catkey'] = $infoCat['parkey'];
    //             $info['subkey'] = $infoCat['keyword'];
    //             return $info;
    //         } else {
    //             return false;
    //         }
    //     } else {
    //         return false;
    //     }
    // }

    // /**
    //  * change values on the same column
    //  * @var source_tbl      : the table that need to change
    //  * @var source_field    : the field that need to change
    //  * @var ref_tbl         : the table for reference
    //  * @var ref_field       : the field on the reference table that will use to compare
    //  * @var return_field    : the field on the reference table that will return its value
    //  * @return              : array[id] = [old_val, new_val]
    //  */
    // public function transformFieldVal($source_tbl = '', $source_field = '', $ref_tbl = '', $ref_field = '', $ref_return_field = '')
    // {
    //     if (!($source_tbl && $source_field && $ref_tbl && $ref_field && $ref_return_field)) return false;

    //     $arr = explode('_', $source_tbl);
    //     if (end($arr) == 'details') {
    //         $this->db->select('did,' . $source_field);
    //         $this->db->order_by('did', 'desc');
    //     } else {
    //         $this->db->select('id,' . $source_field);
    //         $this->db->order_by('id', 'desc');
    //     }

    //     $query = $this->db->get($source_tbl);
    //     if (!($query->num_rows() > 0)) return false;

    //     $data = $query->result_array();
    //     $result = array();
    //     foreach ($data as $item) {
    //         $id = isset($item['id']) ? $item['id'] : $item['did'];
    //         $compared_val = $item[$source_field];

    //         // only do replacement when compared_value is available
    //         if ($compared_val) {
    //             $r_val = $this->getVal($ref_tbl, $ref_field, $compared_val, $ref_return_field);
    //             // only do replacement when it finds reference value
    //             if ($r_val) {
    //                 $res = $this->doReplacement($source_tbl, $id, $source_field, $r_val);
    //             }
    //         }
    //         $result[$id] = array($compared_val, $r_val);
    //     }
    //     return $result;
    // }

    // /**
    //  * get ID from a reference table
    //  * @var ref_tbl         : the table contains data
    //  * @var ref_field       : the field that is used for comparing
    //  * @var compared_val    : the value that is used to compare
    //  * @var returned_field  : the field in which data returned
    //  * @return              : value of the value respectively; otherwise, 0
    //  */
    // public function getVal($ref_tbl = '', $ref_field = '', $compared_val = '', $returned_field = '')
    // {
    //     if (!($ref_tbl && $ref_field && $compared_val && $returned_field)) return false;

    //     $query = get_data($ref_tbl, $ref_field . ' = "' . trim($compared_val) . '"', $returned_field);
    //     if ($query) {
    //         return $query;
    //     } else {
    //         return 0;
    //     }
    // }

    // /**
    //  * do replacement
    //  * @var tbl     : the table that contains the changed field
    //  * @var id      : the id of the row that contains the changed value
    //  * @var field   : the field that contains the data will be changed
    //  * @var val     : new value will be assign into the cell
    //  * @return      : true if success; otherwise, false
    //  */
    // public function doReplacement($tbl = '', $id = "", $field = "", $val)
    // {
    //     if (!($tbl && $id && $field && $val)) return false;
    //     $arr = explode('_', $tbl);
    //     if (end($arr) == 'details') {
    //         $this->db->where('did', $id);
    //     } else {
    //         $this->db->where('id', $id);
    //     }

    //     $this->db->set($field, $val);
    //     $res = $this->db->update($tbl);

    //     return $res;
    // }
    // // End func transformFieldVal
    // // -----------------------------------------------------------------------------------------------


    // public function updateWarehouse($lot_code = '', $supplier_part = '', $warehouse = '', $cpo = 0, $year = '')
    // {
    //     if ($lot_code == '' && $supplier_part == '' && $warehouse = '') {
    //         echo 0;
    //         return false;
    //     }
    //     $inventory = $this->totalInout($lot_code, $supplier_part, $warehouse, $cpo, $year);
    //     $id = $this->getLastID($lot_code, $supplier_part, $warehouse, $cpo)['id'];
    //     $data = array(
    //         'inventory' => $inventory
    //     );
    //     $this->db->where('lot_code', $lot_code);
    //     $this->db->where('supplier_part', $supplier_part);
    //     $this->db->where('warehouse', $warehouse);
    //     if ($year) {
    //         $this->db->where('date_added >= "' . $year . '-01-01"');
    //         $this->db->where('date_added <= "' . $year . '-12-31"');
    //     }
    //     if ($cpo > 0) $this->db->where('cpo', $cpo);
    //     $this->db->where('id', $id);
    //     $this->db->update('stock_inout_details', $data);
    //     return false;
    // }

    // private function totalInout($lot_code = '', $supplier_part = '', $warehouse = '', $cpo = 0, $year = '')
    // {
    //     if ($lot_code == '' && $supplier_part == '' && $warehouse = '') {
    //         echo 0;
    //         return false;
    //     }
    //     $this->db->select('SUM(qty) AS totalExport');
    //     $this->db->where('lot_code', $lot_code);
    //     $this->db->where('supplier_part', $supplier_part);
    //     $this->db->where('warehouse', $warehouse);
    //     if ($year) {
    //         $this->db->where('date_added >= "' . $year . '-01-01"');
    //         $this->db->where('date_added <= "' . $year . '-12-31"');
    //     }
    //     if ($cpo > 0) $this->db->where('cpo', $cpo);
    //     $query = $this->db->get('stock_inout_details');
    //     if ($query->num_rows()) {
    //         return $query->row_array()['totalExport'];
    //     } else {
    //         echo 0;
    //     }
    // }

    // public function getLastID($lot_code = '', $supplier_part = '', $warehouse = '', $cpo = 0, $not_id = '', $year = '')
    // {
    //     if ($lot_code == '' && $supplier_part == '') {
    //         echo 0;
    //         return false;
    //     }
    //     $this->db->select('id, lot_code, SUM(qty) AS inventory');
    //     $this->db->where('lot_code', $lot_code);
    //     $this->db->where('supplier_part', $supplier_part);
    //     if ($warehouse > 0) $this->db->where('warehouse', $warehouse);
    //     if ($cpo > 0) $this->db->where('cpo', $cpo);
    //     if ($not_id > 0) $this->db->where('id <>', $not_id);
    //     //        if ($year) {
    //     $this->db->where('date_added >= "' .  date('Y') . '-01-01"');
    //     $this->db->where('date_added <= "' . date('Y') . '-12-31"');
    //     $this->db->where('deleted', 0);
    //     //        }
    //     $this->db->order_by('id DESC');
    //     $query = $this->db->get('stock_inout_details');
    //     //         echo $this->db->last_query();exit();
    //     if ($query->num_rows()) {
    //         return $query->row_array();
    //     } else {
    //         echo 0;
    //     }
    // }

    // public function info_notification()
    // {
    //     $date = new DateTime("now");
    //     $curr_date = $date->format('Y-m-d ');
    //     $info = get_data('notification', 'DATE(date_added) ="' . $curr_date . '"', '**');

    //     return $info;
    //     /*$toUser = array();
    // if(is_array($info) && count($info)){
    //     foreach ($info as $item){
    //     if($item['group'] == 1){
    //         $toUser = explode(', ', $item['uid']);
    //     }else{
    //         array_push($toUser, $item['uid']);
    //     }
    //     }
    // }*/
    // }

    // public function crm_get_duid($id, $owner = false, $create = false)
    // {
    //     $duid = array();
    //     $rows = $this->db->where('id', $id)->select('lead_create, relate_to, type_relate_to, channel_manage, lead_owner')->get('customer_request_management')->result_array();
    //     if (is_array($rows) && count($rows)) {
    //         $idv_uid = array();
    //         $group_uid = array();
    //         $manger = array();
    //         $arrcreate = array();
    //         foreach ($rows as $r) {
    //             if (!$owner) array_push($duid, $r['lead_owner']);
    //             else $duid['owner'] = $r['lead_owner'];
    //             if ($r['type_relate_to'] == 1) $idv_uid = explode(', ', $r['relate_to']);
    //             if ($r['type_relate_to'] == 2) {
    //                 $arrRelate = explode(', ', $r['relate_to']);
    //                 if (is_array($arrRelate) && count($arrRelate)) {
    //                     foreach ($arrRelate as $gid) {
    //                         $group_staff = get_data('crm_relate_to_group', 'id ="' . $gid . '"', 'Staff');
    //                         if (isset($group_staff) && $group_staff != '') {
    //                             $temp = explode(', ', $group_staff);
    //                             $group_uid = array_merge($group_uid, $temp);
    //                         }
    //                     }
    //                 }
    //             }
    //             if (isset($r['channel_manage']) && $r['channel_manage'] != '') $manger = explode(', ', $r['channel_manage']);
    //             if (isset($r['lead_create']) && $r['lead_create'] != '') $arrcreate = explode(', ', $r['lead_create']);
    //             if ($create && isset($r['lead_create']) && $r['lead_create'] != '') $duid = array_merge($duid, explode(', ', $r['lead_create']));
    //         }
    //         if ($owner) {
    //             $duid = array_merge($duid, $manger, $arrcreate);
    //         } else {
    //             $duid = array_merge($duid, $idv_uid, $group_uid, $manger, $arrcreate);
    //         }
    //     }
    //     return $duid;
    // }

    // public function data_lng()
    // {
    //     $data_lng = array();
    //     $this->db->query('SET NAMES "LATIN1"');
    //     $this->db->select('keyword, vn, en');
    //     $query = $this->db->get('languages');
    //     foreach ($query->result() as $val) {
    //         $data_lng['vn'][$val->keyword] = $val->{'vn'};
    //         $data_lng['en'][$val->keyword] = $val->{'en'};
    //     }
    //     return $data_lng;
    // }
    // public function getOption($col = '')
    // {

    //     $col = checkFieldColumn($col);

    //     $arr = array('' => 'Select..');

    //     if (empty($col)) return $arr;

    //     $this->db->distinct();

    //     $row = $this->db->select($col)
    //         ->get($GLOBALS['var']['act'])
    //         ->result_array();

    //     if (empty($row)) return $arr;

    //     foreach ($row as $i) {
    //         if (isset($i[$col]) && $i[$col] != '') {
    //             $arr[$i[$col]] = $i[$col];
    //         }
    //     }

    //     return $arr;
    // }

    // public function getStaffByName($q)
    // {

    //     $o = array();
    //     $query = $this->db->select("*")
    //         ->where("( fullname like '%" . $q . "%' or username like '%" . $q . "%' or id like '%" . $q . "%')")
    //         ->where('active', 1)->get('users');
    //     if ($query->num_rows() > 0) {
    //         foreach ($query->result() as $r) {
    //             $name = $r->id . ' - ' . $r->fullname;
    //             $o[$r->id] = $name;
    //         }
    //     }
    //     return $o;
    // }

    // public function deletedDetails($table, $id, $data, $deleted = null, $field = 'parent'){
    // 	if(empty($id)) return;
    //     $col = checkFieldColumn('id', $table) ?? 'did';
    // 	$dbIds = $this->db->select($col)->where('deleted', 0)->where($field, $id)->get($table)->result_array();
    // 	if(empty($dbIds)) return;
    // 	$postId = !empty($data['id']) ? $data['id'] : null;
    //     $deleted = !empty($deleted) ? (is_string($deleted) ? explode(',', $deleted) : $deleted) : [];
    //     $whereIds = [];
    //     foreach($dbIds as $value){
    //         if($value[$col] == $postId || !in_array($value[$col], $deleted)) $whereIds[] = $value[$col];
    //     }
    //     if(!empty($whereIds)) $this->db->where_not_in($col, $whereIds)->update($table, ['deleted' => 1]);
    //     return true;
    // }
}
