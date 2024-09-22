@php

$act = request()->segment(2);
$do = request()->segment(3);
$id = request()->segment(4);

// $add_link = url("admin/".request()->segment(2)."/update");
$GLOBALS['module'] = $module;
@endphp
<div class="nav-header__right">
    <input id="act" value="{{$module->file}}" type="hidden" />
    <button id="btn-edit" class="border-purple font-purple"><i class="fa fa-th"></i></button>
    <button id="btn-toggle-paging"><i class="fa fa-sort-numeric-asc"></i></button>
    <div class="nav-header__menu wapper-limit-page">
        <?php
    // $GLOBALS['limit_perpage'] = 10;
    // $GLOBALS['var']['limit_perpage'] = 10;
    $GLOBALS['limit_time'] = 10;
    $GLOBALS['var']['limit_time'] = 10;
    $GLOBALS['var']['page_year']  = 2023;


    if (($do == '' && @$module->limit_row)) {
        echo '<div style="width: 140px; float: right; margin: 0 10px;" class="limit_dropdown">';
        echo 'Show ';
        echo '<div style="display: inline-block; width: 55px;">' . form_dropdown('limit_perpage', @$GLOBALS['limit_perpage'], $GLOBALS['var']['limit_perpage'], 'class="select-status" id="limit_perpage" style="height: 29px; border-color: #dfe8f1;width:100%"') . '</div>';
        echo ' entries';
        echo '</div>';
    }
    // entries month
    if ($do == '' && @$module->limit_time) {
        echo '<div style="width: 140px; float: right; margin: 0 10px;">';
        echo 'Show ';
        echo '<div style="display: inline-block; width: 45px;">' . form_dropdown('limit_time', $GLOBALS['limit_time'], $GLOBALS['var']['limit_time'], 'class="select-status" id="limit_time" style="height: 29px; border-color: #dfe8f1;"') . '</div>';
        echo ' months';
        echo '</div>';
    }
    if (@$module->limit_year) {

            echo '<select id="limit_year" class="select-status" style="width: 70px; height: 29px; float: left; margin-right: 5px; border-color: #dfe8f1;">';


            if (in_array($act, array('projects_customer_part', 'request_sample_part', 'request_sample', 'purchase_order', 'purchase_order_part', 'purchase_order_shipment', 'project_registration')) || (@$GLOBALS['module']['limit_year'] && @$GLOBALS['module']['all_year'])) {
                echo '<option value="100" ' . (($_COOKIE['page_year' . $act . ''] == '100')   ? ' selected' : '') . '>All Years</option>';
            }
            for ($i = date('Y'); $i >= 2017; $i--) {
                echo '<option value="' . $i . '"' . ($GLOBALS['var']['page_year'] == $i ? ' selected' : '') . '>' . $i . '</option>';
            }
            echo '</select>';
        }

        echo '<div class="pagination-wrap" style="display: inline-block">';
        if (isset($page_list) && $page_list) {
            echo $page_list;
        }
        echo '</div>';
    ?>

    </div>
    <div class="nav-header__menu btn-edit">
        @stack("nav-header")

        <?php
    if ($do == "" && isset($add_link) && $add_link && $GLOBALS['per']['add']) {
        echo '<a href="' . $add_link . '" class="addLink"><div class="btn btn-border btn-alt border-green font-green tooltip-link" data-placement="bottom" title="Add new"><i class="fa fa-plus-circle"></i></div></a>';
    }
    if (isset($filter_stock)) {
        echo '<div class="dropdown" id="filter-btn">';
        echo '<a href="#" data-toggle="dropdown" data-placement="bottom" class="filter-btn"><div class="btn btn-border btn-alt border-purple font-purple tooltip-button" data-placement="bottom" title="' . ($filter_stock ? $GLOBALS['stock_list'][$filter_stock]['name_vn'] : 'Inventory filtering') . '"><i class="fa fa-inbox"></i></div></a>';
        echo '<div class="dropdown-menu float-right" style="padding: 5px;">';
        echo '<ul class="cat_treeview filetree treeview filter_stock" style="margin: 0; min-width: 145px; height: 140px;">' . cat_tree($GLOBALS['stock_list'], 0, $filter_stock, 'radio', true, 'stock') . '</ul>';
        echo '</div>';
        echo '</div>';
    }
    if (isset($cat_list) && is_array($cat_list) && count($cat_list)) {
        echo '<div class="dropdown" id="filter-btn">';
        echo '<a href="#" data-toggle="dropdown" data-placement="bottom" class="filter-btn"><div class="btn btn-border btn-alt border-blue font-blue tooltip-button" data-placement="bottom" title="Group of goods"><i class="fa fa-list-alt"></i></div></a>';
        echo '<div class="dropdown-menu float-right" style="padding: 5px;">';
        echo '<ul class="cat_treeview filetree treeview filter_cat" style="margin: 0">' . cat_tree($cat_list, 0, $filter_cat, 'radio', true) . '</ul>';
        echo '</div>';
        echo '</div>';
    }
    if (!empty($date_picker)) {
        echo '<div class="dropdown" id="datetime-btn">';
        echo '<a href="#" data-placement="bottom" class="filter-btn"><div class="btn btn-border btn-alt border-purple font-purple tooltip-button" data-placement="bottom" title="View by date/month"><i class="fa fa-calendar"></i></div></a>';
        echo '<div class="dropdown-menu float-right" style="padding: 15px; width: 240px;">';
        echo form_open($act . ($do ? '/' . $do : ''), array('method' => 'get', 'id' => 'frmDate'));
        echo form_input(array('type' => 'hidden', 'name' => 'q', 'value' => $uri['q']));
        if ($uri['deleted']) {
            echo form_input(array('type' => 'hidden', 'name' => 'deleted', 'value' => $uri['deleted']));
        }
        echo '<div class="form-group">';
        echo '<div class="row">';
        echo '<div class="col-sm-6"><input type="text" value="' . $uri['date_added'] . '" class="form-control date" name="date_added" autocomplete="off" /></div>';
        echo '</div>';
        echo '</div>';
        echo '<div class="form-group">';
        echo '<div class="row" style="margin-bottom: 0">';
        echo '<div class="col-sm-12" style="text-align: center">';
        echo '<button type="submit" class="btn btn-alt btn-primary btn-hover" style="float: none; margin: auto"><span>Apply</span><i class="fa fa-check"></i></button>';
        if (($uri['from'] && $uri['from'] != date('Y-m-d', time() - 86400 * 30)) || ($uri['to'] && $uri['to'] != date('Y-m-d'))) {
            echo '<a class="ajax btn btn-alt btn-danger btn-hover" href="' . site_url($act) . ($do ? '/' . $do : '') . url_uri($uri, array('to', 'from', 'user')) . '" style="float: none"><span>Cancel</span><i class="fa fa-remove"></i></a>';
        }
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo form_close();
        echo '</div>';
        echo '</div>';
    }
    if (isset($datetime_picker) && $datetime_picker) {
        echo '<div class="dropdown" id="datetime-btn">';
        echo '<a href="#" data-placement="bottom" class="filter-btn"><div class="btn btn-border btn-alt border-purple font-purple tooltip-button" data-placement="bottom" title="View by date/month"><i class="fa fa-calendar"></i></div></a>';
        echo '<div class="dropdown-menu float-right" style="padding: 15px; width: 240px;">';
        echo form_open($act . ($do ? '/' . $do : ''), array('method' => 'get', 'id' => 'frmDate'));
        echo form_input(array('type' => 'hidden', 'name' => 'q', 'value' => $uri['q']));
        if ($uri['deleted']) {
            echo form_input(array('type' => 'hidden', 'name' => 'deleted', 'value' => $uri['deleted']));
        }
        echo '<div id="datepicker" class="form-group">';
        echo '<div class="row input-daterange">';
        echo '<div class="col-sm-6"><input type="text" value="' . $uri['from'] . '" class="form-control" name="from" placeholder="From" autocomplete="off" /></div>';
        echo '<div class="col-sm-6"><input type="text" value="' . $uri['to'] . '" class="form-control" name="to" placeholder="To" autocomplete="off" /></div>';
        echo '</div>';
        echo '</div>';
        echo '<div class="form-group">';
        echo '<div class="row" style="margin-bottom: 0">';
        echo '<div class="col-sm-12" style="text-align: center">';
        echo '<button type="submit" class="btn btn-alt btn-primary btn-hover" style="float: none; margin: auto"><span>Apply</span><i class="fa fa-check"></i></button>';
        if (($uri['from'] && $uri['from'] != date('Y-m-d', time() - 86400 * 30)) || ($uri['to'] && $uri['to'] != date('Y-m-d'))) {
            echo '<a class="ajax btn btn-alt btn-danger btn-hover" href="' . site_url($act) . ($do ? '/' . $do : '') . url_uri($uri, array('to', 'from', 'user')) . '" style="float: none"><span>Cancel</span><i class="fa fa-remove"></i></a>';
        }
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo form_close();
        echo '</div>';
        echo '</div>';
    }
    if (isset($month_picker) && $month_picker) {
        echo '<div class="dropdown" id="datetime-btn">';
        echo '<a href="#" data-placement="bottom" class="filter-btn"><div class="btn btn-border btn-alt border-purple font-purple tooltip-button" data-placement="bottom" title="Month"><i class="fa fa-calendar"></i></div></a>';
        echo '<div class="dropdown-menu float-right" style="padding: 15px 15px 5px; width: ' . ($uri['month'] ? 185 : 140) . 'px; min-width: auto;">';
        echo form_open($act . ($do ? '/' . $do . ($id ? '/' . $id : '') : ''), array('method' => 'get', 'id' => 'frmDate'));
        if (isset($uri['q']) && $uri['q']) {
            echo form_input(array('type' => 'hidden', 'name' => 'q', 'value' => $uri['q']));
        }
        if (isset($uri['deleted']) && $uri['deleted']) {
            echo form_input(array('type' => 'hidden', 'name' => 'deleted', 'value' => $uri['deleted']));
        }
        echo '<div class="form-group">';
        echo '<div class="row">';
        echo '<div class="col-sm-12">';
        echo '<input type="text" value="' . $uri['month'] . '" class="form-control month" id="limit_month" readonly name="month" autocomplete="off" style="width: calc(100% - ' . ($uri['month'] ? 94 : 47) . 'px); float: left;" />';
        echo '<input type="hidden" value="' . $uri['user'] . '" name="user"/>';
        if ($uri['month']) {
            echo '<a class="ajax btn btn-border btn-alt border-red font-red" href="' . site_url($act) . ($do ? '/' . $do . ($id ? '/' . $id : '') : '') . url_uri($uri, array('month')) . '" style="width: 42px; float: right; margin-top: 0; line-height: 28px;"><i class="fa fa-remove"></i></a>';
        }
        echo '<button type="submit" class="btn btn-border btn-alt border-success font-green" style="width: 42px; float: right; margin-top: 0;"><i class="fa fa-check"></i></button>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo form_close();
        echo '</div>';
        echo '</div>';
    }
    if ($do == '' || in_array($do, ['loading', 'purchasing', 'lateCRD', 'cancel', 'close'])) {
        if (!in_array($act, array('chi_nhanh', 'interfaces', 'hscode', 'parts', 'price_accessing', 'languages', 'sales_force', 'customer_activities', 'customer_project_activities', 'atc_profile', 'requests',  'customer_received_date', 'department_profile', 'warehouse_inout', 'hardware_design_report', 'project_finished_date', 'production_line_date', 'kpis_platform', 'company_profile', 'employee_profile', 'stock_online', 'recruitment_data', 'recruitment', 'recruitment_online', 'forecast', 'suppliers_forecast', 'supplier_stock_export', 'order_confirm', 'supplier_stock_export_Sales'))) {
            // echo '<a class="btn btn-border btn-alt border-black font-black tooltip-link prints-file" href="javascript:;" data-placement="bottom" title="Prints"><i class="fa fa-print"></i></a>';
        }
        if (!in_array($act, array('user_att', 'chi_nhanh', 'interfaces', 'hscode', 'tasks', 'parts', 'business_trip_customer', 'price_accessing', 'languages', 'sales_force', 'customer_activities', 'customer_project_activities', 'atc_profile', 'requests', 'customer_received_date', 'report', 'department_profile', 'warehouse_inout', 'hardware_design_report', 'project_finished_date', 'production_line_date', 'kpis_platform', 'company_profile', 'employee_profile', 'stock_online', 'recruitment_data', 'recruitment', 'recruitment_online', 'forecast', 'suppliers_forecast', 'supplier_stock_export', 'purchasing_cost',  'order_confirm', 'supplier_stock_export_Sales'))) {
            // echo '<a class="btn btn-border btn-alt border-blue font-blue tooltip-link exports-file" href="javascript:;" data-href="' . site_url($act . '/exports') . url_uri($uri, array('rowstart')) . '" data-placement="bottom" title="Exports"><i class="fa fa-download"></i></a>';
        }
        if (in_array($act, array('forecast', 'suppliers_forecast', 'supplier_stock_export', 'supplier_stock_export_Sales'))) {
            echo '<a class="btn btn-border btn-alt border-black font-black tooltip-link prints-file-custom" href="javascript:;" data-placement="bottom" data-table="table-' . $GLOBALS['var']['act'] . '" title="Prints"><i class="fa fa-print"></i></a>';
        }
        if (in_array($act, array('forecast', 'suppliers_forecast', 'supplier_stock_export', 'purchasing_cost', 'business_trip_customer', 'supplier_stock_export_Sales'))) {
            echo '<a class="btn btn-border btn-alt border-blue font-blue tooltip-link exports-file-custom" href="javascript:;" data-placement="bottom" data-table="table-' . $GLOBALS['var']['act'] . '" title="Exports"><i class="fa fa-download"></i></a>';
        }
        if (in_array($act, ['tasks'])) {
            echo '<a class="btn btn-border btn-alt border-blue font-blue tooltip-link exports-file-' . $GLOBALS['var']['act'] . '-custom" href="javascript:;" data-placement="bottom" data-table="table-' . $GLOBALS['var']['act'] . '" title="Exports"><i class="fa fa-download"></i></a>';
        }
        if (in_array($act, array('warehouse_inout')) && $GLOBALS['per']['edit']) {
            echo '<a class="btn btn-border btn-alt border-orange font-orange tooltip-link prints-file-compare" href="javascript:;" data-placement="bottom" title="Print Compare"><i class="fa fa-print"></i></a>';
            echo '<a class="btn btn-border btn-alt border-black font-black tooltip-link prints-file" href="javascript:;" data-placement="bottom" title="Prints"><i class="fa fa-print"></i></a>';
            echo '<a class="btn btn-border btn-alt border-blue font-blue tooltip-link exports-file" href="javascript:;" data-href="' . site_url($act . '/exports') . url_uri($uri, array('rowstart')) . '" data-placement="bottom" title="Exports"><i class="fa fa-download"></i></a>';
        }
        if (!in_array($act, array('user_att', 'request_sample_part', 'key_opportunities', 'tasks', 'top_opportunities', 'chi_nhanh', 'positions', 'stock_inout', 'stock_begin', 'stock_import', 'stock_export', 'purchase_order', 'sales_order', 'sales_order_online', 'rfq', 'products', 'manufacturers', 'interfaces', 'customers', 'customers_online', 'suppliers', 'hscode', 'digicats', 'parts', 'price_accessing', 'languages', 'purchasing_report', 'purchasing_part_report', 'gross_revenue_per_staff', 'sales_report', 'sales_part_report', 'sales_revenue_per_staff', 'business_trip_customer', 'projects_customer', 'order_confirm', 'shipment_tracker_domestic', 'payment_management', 'sales_force', 'customer_activities', 'customer_project_activities', 'atc_profile', 'departmental_documentation', 'requests', 'purchasing_cost', 'customer_received_date', 'report', 'department_profile', 'shipment_tracker', 'company_info', 'warehouse_inout', 'hardware_design_report', 'project_finished_date', 'production_line_date', 'kpis_platform', 'company_profile', 'employee_profile', 'stock_online', 'recruitment_data', 'recruitment', 'recruitment_online', 'forecast', 'suppliers_forecast', 'supplier_stock_export', 'supplier_stock_export_Sales', 'customer_sales_contract', 'project_registration'))) {
            // echo '<a class="btn btn-border btn-alt border-blue font-blue tooltip-link imports-file" href="javascript:;" data-placement="bottom" title="Import"><i class="glyph-icon fa fa-upload"></i></a>';
        }
        // if ($GLOBALS['user']['level'] == 1 || $GLOBALS['per']['full']) {
            echo '<a class="btn btn-border btn-alt border-purple font-purple tooltip-link col-show-hide" href="javascript:;" data-placement="bottom" title="Display"><i class="fa fa-th-list"></i></a>';
        // }
    }
    if ($do == '' && in_array($act, array('digicats'))) {
    ?>
        <a class="nestable-menu btn btn-border btn-alt border-info font-blue tooltip-link disabled" id="nestable-expand" href="#" style="display: none" data-placement="bottom" title="Expand"><i class="fa fa-expand"></i></a>
        <a class="nestable-menu btn btn-border btn-alt border-info font-blue tooltip-link" id="nestable-collapse" href="#" style="display: none" data-placement="bottom" title="Collapse"><i class="fa fa-compress"></i></a>
        <?php
    }
    // else if ($act && !$do && check_module_do($act, 'del') && !in_array($act, array('user_att', 'data_logs', 'purchasing_report', 'purchasing_part_report', 'gross_revenue_per_staff', 'sales_report', 'sales_part_report', 'sales_revenue_per_staff', 'sales_force', 'customer_activities', 'customer_project_activities', 'requests', 'parts',  '', 'order_confirm', 'supplier_stock_export_Sales', 'supplier_stock_export'))) {
    //     if (isset($uri['deleted']) && $uri['deleted']) {
    //         echo '<a class="loading btn btn-border btn-alt border-black font-black tooltip-link deletedView" href="' . site_url($act) . '" data-placement="bottom" title="Viewall"><i class="fa fa-undo"></i></a>';
    //     } else {
    //         echo '<a class="loading btn btn-border btn-alt border-red font-red tooltip-link deletedView" href="' . site_url($act) . '?deleted=1" data-placement="bottom" title="Deleted"><i class="fa fa-trash-o"></i></a>';
    //     }
    // }
    ?>
    </div>
    @push('js')
    <script>
        $("#btn-edit").click(function(){
        if( $('.btn-edit').css("display") == "none")
        {
            $('.nav-header__menu').hide();
            $('.btn-edit').show('slow');
        }
        else{
            $('.nav-header__menu').hide();
        }
    });
    $("#btn-toggle-paging").click(function(){
        if( $('.wapper-limit-page').css("display") == "none")
        {
            $('.nav-header__menu').hide();
            $('.wapper-limit-page').show('slow');
        }
        else{
            $('.nav-header__menu').hide();
        }


    });
    </script>
    @endpush
</div>
@push("js")

{{-- <link rel="stylesheet" href="{{ asset('public/modules/dist/style.css') }}" /> --}}
{{-- <script src="<?=asset("")?>/plugin/admin/js/jquery.dataTables.min.js"></script> --}}
<script src="<?=asset("")?>/plugin/table/tablednd/jquery.tablednd.min.js"></script>
<script src="{{ asset('modules/dist/script.js') }}"></script>
@endpush
