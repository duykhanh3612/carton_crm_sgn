@push('plugin_css')
<link rel="stylesheet" href="{{ asset('public/themes/admin/css/treeview.css') }}">
@endpush
@push('nav-header')
<div class="group-process">
    <?php if (isset($export)) : ?>
    <?php if (count($export) > 0) : ?>
    <div class="dropdown">
        <button type="button" class="btn btn-border btn-alt border-black font-black waves-effect dropdown-toggle" title="Export to Excel" data-toggle="dropdown"><i class="glyph-icon icon-download"></i></button>
        <ul class="dropdown-menu dropdown-menu-right">
            <?php foreach ($export as $key => $val) : ?>
            <?php if ($key === 'EXCEL' && (empty($val) || $val == '#')) : ?>
            <li class="dropdown-item"><a class="exports-part-file" href="javascript:;" data-placement="bottom" title="Exports">
                    <?= $key ?>
                </a></li>
            <?php else : ?>
            <li class="dropdown-item"><a target="_blank" href="<?= $val ?>">
                    <?= $key ?>
                </a></li>
            <?php endif ?>
            <?php endforeach ?>
        </ul>
    </div>
    <?php else : ?>
    <a class="btn btn-border btn-alt border-blue font-blue tooltip-link exports-part-file" href="javascript:;" data-href="modules/export/<?= $modulePart ?>" data-placement="bottom" title="Exports"><i class="glyph-icon icon-download"></i></a>
    <?php endif ?>
    <?php endif ?>
    <a class="btn btn-border btn-alt border-purple font-purple tooltip-link part-show-hide" href="javascript:;" data-placement="bottom" title="Display">
        <i class="fa fa-th-list" aria-hidden="true"></i>
    </a>
</div>
@endpush
@section('content')
<div class="content-wrapper" style="min-height: 440px;">

    <div class="content-wrapper-box">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <h1 class="m-0 text-uppercase font-weight-bold">
                            <a href="{{route("admin.modules")}}">Modules</a>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
        <input id="act" type="hidden" value="{{ $GLOBALS['var']['act'] }}">
        <ul class="nav nav-tabs" role="tablist" style="padding: 0 18px;">
            <li class="nav-item active">
                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Infomation</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#option" role="tab">Page List</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#detail" role="tab">Page Detail</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#requirement" role="tab">Requirement</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab" id="menuproject">CMS Fix</a>
            </li>
        </ul><!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                <form class="form-module horizontal" action="{{ url('admin/' . $GLOBALS['var']['act'] . '/process') }}" method="post" enctype="multipart/form-data" accept-charset="utf-8" id="updateFrm" class="updateFrm form-horizontal bordered-row">
                    <input type="hidden" name="id" value="{{ @$info['id'] }}" />
                    @csrf
                    <tr>
                        <td>
                            <div class="form-group pt-3">
                                <div class="col-sm-2 control-label text-right">Tên mô đun <span style="color:red">*</span></div>
                                <div class="col-sm-9">
                                    <input name="name_vn" id="name_vn" type="text" class="form-control" data-required="1" value="<?php echo @$info['name_vn']; ?>" />
                                    <?php echo error_div('name_vn', 'Vui lòng nhập tên mô đun!'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-2 control-label text-right">Tên bảng
                                    <div class="note">Xuất hiện trong các hộp thoại</div>
                                </div>
                                <div class="col-sm-9">
                                    <input name="name_en" id="name_en" type="text" class="form-control" value="<?php echo @$info['name_en']; ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-2 control-label text-right">File</div>
                                <div class="col-sm-9">
                                    <input name="file" id="file" type="text" class="form-control" value="<?php echo @$info['file']; ?>" />
                                </div>
                            </div>
                            @php
                            /*
                            <div class="form-group">
                                <div class="col-sm-2 control-label text-right">File source php <span style='color:red'>*</span>
                                    <div class="note">ten_file.php hoặc tenfile.php</div>
                                </div>
                                <div class="col-sm-9">
                                    <?php
                                    echo form_dropdown('file', $files, @$info['file'], 'id="selecFile" data-required="1" class="form-control"');
                                    echo error_div('selecFile', 'Vui lòng chọn file source!');
                                    ?>
                                </div>
                            </div>
                            */
                            @endphp
                            <div class="form-group">
                                <div class="col-sm-2 control-label text-right">Biểu tượng</div>
                                <div class="col-sm-9">
                                    <input name="image" id="image" type="text" class="form-control" value="<?php echo @$info['image']; ?>" />
                                </div>
                            </div>
                            <div class="form-group" style="display: none">
                                <div class="col-sm-2 control-label text-right">Quyền xem</div>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-md-4 radio-primary"><label><input name="rights[view]" id="view1" type="radio" class="custom-radio" value="1" checked="checked" />Có</label></div>
                                        <div class="col-md-4 radio-primary"><label><input name="rights[view]" id="view0" type="radio" class="custom-radio" value="0" />Không</label></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-2 control-label text-right">Quyền cập nhật</div>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-md-4 radio-primary"><label><input name="rights[edit]" id="edit1" type="radio" class="custom-radio" value="1" <?php echo @$rights->edit == 1 ? ' checked="checked"' : ''; ?> />Có</label></div>
                                        <div class="col-md-4 radio-primary"><label><input name="rights[edit]" id="edit0" type="radio" class="custom-radio" value="0" <?php echo @$rights->edit == 0 ? ' checked="checked"' : ''; ?> />Không</label></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-2 control-label text-right">Quyền thêm mới</div>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-md-4 radio-primary"><label><input name="rights[add]" id="add1" type="radio" class="custom-radio" value="1" <?php echo @$rights->add == 1 ? ' checked="checked"' : ''; ?> />Có</label></div>
                                        <div class="col-md-4 radio-primary"><label><input name="rights[add]" id="add0" type="radio" class="custom-radio" value="0" <?php echo @$rights->add == 0 ? ' checked="checked"' : ''; ?> />Không</label></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-2 control-label text-right">Quyền xóa</div>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-md-4 radio-primary"><label><input name="rights[del]" id="del1" type="radio" class="custom-radio" value="1" <?php echo @$rights->del == 1 ? ' checked="checked"' : ''; ?> />Có</label></div>
                                        <div class="col-md-4 radio-primary"><label><input name="rights[del]" id="del0" type="radio" class="custom-radio" value="0" <?php echo @$rights->del == 0 ? ' checked="checked"' : ''; ?> />Không</label></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-2 control-label text-right">Toàn quyền</div>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-md-4 radio-primary"><label><input name="rights[full]" id="full1" type="radio" class="custom-radio" value="1" <?php echo @$rights->full == 1 ? ' checked="checked"' : ''; ?> />Có</label></div>
                                        <div class="col-md-4 radio-primary"><label><input name="rights[full]" id="full0" type="radio" class="custom-radio" value="0" <?php echo @$rights->full == 0 ? ' checked="checked"' : ''; ?> />Không</label></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-2 control-label text-right">Return Approval</div>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-md-4 radio-primary"><label><input name="rights[return]" id="full1" type="radio" class="custom-radio" value="1" <?php echo @$rights->return == 1 ? ' checked="checked"' : ''; ?> />Có</label></div>
                                        <div class="col-md-4 radio-primary"><label><input name="rights[return]" id="full0" type="radio" class="custom-radio" value="0" <?php echo @$rights->return == 0 ? ' checked="checked"' : ''; ?> />Không</label></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-2 control-label text-right">Nhóm</div>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <?php
                                        if (!@$info['id']) {
                                            // @$info['cat'] = \Cookie::set('mytab-' . $GLOBALS['var']['act'] . '-', true);
                                        }
                                        if (!empty($category_list)) {
                                            foreach ($category_list as $data) {
                                                echo '<div class="col-md-4 radio-primary"><label><input name="cat" id="cat' . $data['id'] . '" type="radio" class="custom-radio" value="' . $data['id'] . '"' . ($info['cat'] == $data['id'] ? ' checked="checked"' : '') . '/>' . $data['name_vn'] . '</label></div>';
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-2 control-label text-right">Hiển thị menu</div>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-md-4 radio-primary"><label><input name="menu" id="menu1" type="radio" class="custom-radio" value="1" <?php echo @$info['menu']=='1' ? ' checked="checked"' : '' ; ?> />Có</label></div>
                                        <div class="col-md-4 radio-primary"><label><input name="menu" id="menu0" type="radio" class="custom-radio" value="0" <?php echo @$info['menu']=='0' ? ' checked="checked"' : '' ; ?> />Không</label></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-2 control-label text-right"></div>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-md-2 radio-primary" id="show_menu_top">
                                            <label> Menu Top </label>
                                            <?= toggle_input('menu_top', @$info['menu_top'], 'menu_top') ?>
                                        </div>
                                        <div class="col-md-2">
                                            <label>Left navigation</label>
                                            <?= toggle_input('left_navigation', @$info['left_navigation'], 'left_navigation') ?>
                                        </div>
                                        <div class="col-md-2">
                                            <label>Years</label>
                                            <?= toggle_input('limit_year', @$info['limit_year'], 'limit_year') ?>
                                        </div>
                                        <div class="col-md-2">
                                            <label>All Years</label>
                                            <?= toggle_input('all_year', @$info['all_year'], 'all_year') ?>
                                        </div>
                                        <div class="col-md-2">
                                            <label>Approved Online</label>
                                            <?= toggle_input('approved', @$info['approved'], 'approved') ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" id="menu_top_link">
                                <div class="col-sm-2 control-label text-right">Menu Top Link</div>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-md-12 radio-primary">
                                            <table id="mainTable-options" class="table table-hover" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                <thead>
                                                    <tr class="nodrop">
                                                        <th width="30%">Title</th>
                                                        <th width="30%">Option item</th>
                                                        <th width="30%">Class</th>
                                                        <th width="1%" nowrap="nowrap">&nbsp;</th>
                                                        <th width="1%" nowrap="nowrap">&nbsp;</th>
                                                        <th width="10%" nowrap="nowrap">&nbsp;</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                            $options = !empty($info['menu_top_options']) ? json_decode($info['menu_top_options'], true) : [];

                                            if (is_array($options) && !empty($options)) {
                                                foreach ($options as $item) {
                                            ?>
                                                    <tr class="highlight">
                                                        <td><input type="text" name="Options[<?= @++$option ?>][key]" value="<?php echo $item['key']; ?>" class="form-control" placeholder="Key" /></td>
                                                        <td><input type="text" name="Options[<?= @$option ?>][value]" value="<?php echo $item['value']; ?>" class="form-control" placeholder="Value" /></td>
                                                        <td><input type="text" name="Options[<?= @$option ?>][class]" value="<?php echo @$item['class']; ?>" class="form-control" placeholder="ClassName" /></td>
                                                        <td class="center"><a href="javascript:;" class="remove-option" style="font-size: 18px;"><i class="glyph-icon icon-remove"></i></a></td>
                                                        <td class="center"><a href="javascript:;" class="add-option" style="font-size: 18px;"><i class="glyph-icon icon-plus-circle"></i></a></td>
                                                        <td nowrap="nowrap">&nbsp;</td>
                                                    </tr>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                    <tr class="highlight">
                                                        <td><input type="text" name="Options[<?= @++$option ?>][key]" class="form-control" placeholder="Key" /></td>
                                                        <td><input type="text" name="Options[<?= @$option ?>][value]" class="form-control" placeholder="Value" /></td>
                                                        <td><input type="text" name="Options[<?= @$option ?>][class]" class="form-control" placeholder="ClassName" /></td>
                                                        <td class="center" width="1%"><a href="javascript:;" class="remove-option" style="font-size: 18px;"><i class="glyph-icon icon-remove"></i></a></td>
                                                        <td class="center" width="1%"><a href="javascript:;" class="add-option" style="font-size: 18px;"><i class="fa fa-plus"></i></a></td>
                                                        <td nowrap="nowrap">&nbsp;</td>
                                                    </tr>
                                                    <?php
                                            }
                                            ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-2 control-label text-right">Functions</div>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-md-2 radio-primary" id="show_menu_top">
                                            <label>Auto Save</label>
                                            <?= toggle_input('auto_save', @$info['auto_save'], 'auto_save') ?>
                                        </div>
                                        <div class="col-md-2 radio-primary" id="show_menu_top">
                                            <label title="Check Validate Befor Save">Check Validate</label>
                                            <?= toggle_input('check_validate', @$info['check_validate'], 'check_validate') ?>
                                        </div>
                                        <div class="col-md-2">
                                            <label>Data Log</label>
                                            <?= toggle_input('data_log', @$info['data_log'], 'data_log') ?>
                                        </div>
                                        <div class="col-md-2">
                                            <label>Data Raw</label>
                                            <?= toggle_input('data_raw', @$info['data_raw'], 'data_raw') ?>
                                        </div>
                                        <div class="col-md-2">

                                        </div>
                                        <div class="col-md-2">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-2 control-label text-right">Language</div>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-md-4 radio-primary"><label><input name="language" id="language1" type="radio" class="custom-radio" value="1" <?php echo @$info['language']=='1' ? ' checked="checked"' : '' ; ?> />Có</label></div>
                                        <div class="col-md-4 radio-primary"><label><input name="language" id="language0" type="radio" class="custom-radio" value="0" <?php echo @$info['language']=='0' ? ' checked="checked"' : '' ; ?> /><span> Không</span></label></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-2 control-label text-right">Active</div>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-md-4 radio-primary"><label><input name="active" id="active1" type="radio" class="custom-radio" value="1" <?php echo @$info['active']=='1' ? ' checked="checked"' : '' ; ?> />Có</label></div>
                                        <div class="col-md-4 radio-primary"><label><input name="active" id="active0" type="radio" class="custom-radio" value="0" <?php echo @$info['active']=='0' ? ' checked="checked"' : '' ; ?> /><span> Không</span></label></div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-end" dir="rtl">
                                @csrf
                                <button type="button" class="btn btn-dark" data-dismiss="modal">
                                    Hủy
                                </button>
                                <button type="submit" class="btn btn-warning">
                                    <?=request()->segment(3) =="update"?"Cập nhập": "Thêm mới"?>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php
                    echo module_close();
                    ?>
                </form>
            </div>
            <div class="tab-pane" id="option" role="tabpanel">
                <form action="{{ url('admin/' . $GLOBALS['var']['act'] . '/process') }}" method="post" enctype="multipart/form-data" accept-charset="utf-8" id="updateFrm2" class="updateFrm form-horizontal bordered-row">
                    <div class="col-xs-12" ng-show="layoutSettings.saleSetting.enableTab == true" style="padding:10px;">
                        {{-- <p class="fw-500">
                        <h2>Thông tin chung</h2>
                        </p> --}}

                        <div class="panel-group pt-3">
                            <div class="panel panel-default">
                                <div class="panel-heading">Filter</div>
                                <div class="panel-body">
                                    <div class="col-12">
                                        @include('hyperspace::components.inputs.text', [
                                        'label' => "Filter Input Keyword Placeholder",
                                        'name' => "filter_keyword_placeholder",
                                        'value' => @$info['filter_keyword_placeholder']
                                        ])
                                        {{-- @include('hyperspace::components.inputs.checkbox', [
                                        'label' => "Show Button Search",
                                        'name' => "filter_button_search",
                                        'checked' => @$info['filter_button_search'],
                                        'value' => 1
                                        ]) --}}
                                        <label class="ml-3 mt-4 d-flex" style="gap: 10px;">
                                            Show Button Search
                                            <?= toggle_input('filter_button_search', @$info['filter_button_search'], 'filter_button_search') ?>
                                        </label>
                                        @include('hyperspace::components.inputs.text', [
                                        'label' => "Button Search Text",
                                        'name' => "filter_button_text",
                                        'value' => @$info['filter_button_text']
                                        ])
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel-group pt-3">
                            <div class="panel panel-default">
                                <div class="panel-heading">Table</div>
                                <div class="panel-body">
                                    <div class="col-12">
                                        <div class="col-12 ml-4">
                                            @include('hyperspace::components.inputs.checkbox', [
                                                'label' => "Hiện thị Line Nubmer",
                                                'name' => "line_number",
                                                'checked' => @$info['line_number'],
                                                'value' => 1
                                            ])
                                        </div>
                                        <div class="col-12 ml-4">
                                            @include('hyperspace::components.inputs.checkbox', [
                                            'label' => "Hiện thị Input Check",
                                            'name' => "input_check",
                                            'checked' => @$info['input_check'],
                                            'value' => 1
                                            ])
                                        </div>

                                        <div class="col-12 mt-4">
                                            @include('hyperspace::components.inputs.text', [
                                            'label' => "Delete Confirm Message",
                                            'name' => "action_delete_confirm_msg",
                                            'value' => @$info['action_delete_confirm_msg']
                                            ])
                                        </div>
                                        <div class="col-12 ml-3 mt-4">
                                            <div class="form-group">
                                                <label>
                                                    Action Page Detail
                                                </label>
                                                <select name="action_page_detail" class="form-control  ">
                                                    <option>Mặc đinh</option>
                                                    <option value="link" {{  @$info['action_page_detail']=="link"?"selected":""}}>Link</option>
                                                    <option value="popup" {{  @$info['action_page_detail']=="popup"?"selected":""}} >Modal Popup</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="col-12">

                                            <div class="form-group" id="menu_top_link">
                                                <div class="form-group col-md-12">

                                                    <div class="form-group">
                                                        <label for="filter_button_text">Tab group</label>
                                                        {{-- <div class="col-sm-2 control-label text-right">Tab group</div> --}}

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <table id="mainTable-tag-group" class="table table-hover" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                                        <thead>
                                                                            <tr class="nodrop">
                                                                                <th width="30%">Title</th>
                                                                                <th width="30%">Option item</th>
                                                                                <th width="30%">Class</th>
                                                                                <th width="1%" nowrap="nowrap">&nbsp;</th>
                                                                                <th width="1%" nowrap="nowrap"><a href="javascript:;" class="add-tab-group" style="font-size: 18px;"><i class="fa fa-plus"></i></a</th>
                                                                                <th width="10%" nowrap="nowrap">&nbsp;</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php
                                                                                    $options = !empty($info['page_tab_group']) ? json_decode($info['page_tab_group'], true) : [];

                                                                                    if (is_array($options) && !empty($options)) {
                                                                                        foreach ($options as $item) {
                                                                                    ?>
                                                                                            <tr class="highlight">
                                                                                                <td><input type="text" name="page_tab_group[<?= @++$tab_group ?>][key]" value="<?php echo $item['key']; ?>" class="form-control" placeholder="Key" /></td>
                                                                                                <td><input type="text" name="page_tab_group[<?= @$tab_group ?>][value]" value="<?php echo $item['value']; ?>" class="form-control" placeholder="Value" /></td>
                                                                                                <td><input type="text" name="page_tab_group[<?= @$tab_group ?>][class]" value="<?php echo $item['class']; ?>" class="form-control" placeholder="ClassName" /></td>
                                                                                                <td class="center"><a href="javascript:;" class="remove-tab-group" style="font-size: 18px;"><i class="fa fa-trash"></i></a></td>
                                                                                                <td class="center"><a href="javascript:;" class="add-tab-group" style="font-size: 18px;"><i class="fa fa-plus"></i></a></td>
                                                                                                <td nowrap="nowrap">&nbsp;</td>
                                                                                            </tr>
                                                                                            <?php
                                                                                        }
                                                                                    } else {
                                                                                        ?>
                                                                                            {{-- <tr class="highlight">
                                                                                                <td><input type="text" name="page_tab_group[<?= @++$tab_group ?>][key]" class="form-control" value="group-1" placeholder="Key" /></td>
                                                                                                <td><input type="text" name="page_tab_group[<?= @$tab_group ?>][value]" class="form-control" placeholder="Value" /></td>
                                                                                                <td><input type="text" name="page_tab_group[<?= @$tab_group ?>][class]" class="form-control" placeholder="ClassName" /></td>
                                                                                                <td class="center" width="1%"><a href="javascript:;" class="remove-option" style="font-size: 18px;"><i class="fa fa-remove"></i></a></td>
                                                                                                <td class="center" width="1%"><a href="javascript:;" class="add-tab-group" style="font-size: 18px;"><i class="fa fa-plus"></i></a></td>
                                                                                                <td nowrap="nowrap">&nbsp;</td>
                                                                                            </tr> --}}
                                                                                            <?php
                                                                                    }
                                                                                    ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" value="<?=@$info['id']?>" name="id" />
                    </div>
                    <div class="modal-footer justify-content-start" >
                        @csrf
                        <button type="button" class="btn btn-warning" id="btn-frm-apply">
                            <img src="{{assets}}dist/img/icon/save.png" alt="" width="15">
                             Lưu và tiếp tục

                        </button>
                        <button type="submit" class="btn btn-warning">
                            <?=request()->segment(3) =="update"?"Cập nhập": "Thêm mới"?>
                        </button>
                        <button type="button" class="btn btn-dark" data-dismiss="modal">
                            Hủy
                        </button>


                    </div>
                </form>
            </div>
            <div class="tab-pane" id="detail" role="tabpanel">
                <form action="{{ url('admin/' . $GLOBALS['var']['act'] . '/process') }}" method="post" enctype="multipart/form-data" accept-charset="utf-8" id="updateFrm2" class="updateFrm form-horizontal bordered-row">
                    <div class="col-xs-12" ng-show="layoutSettings.saleSetting.enableTab == true" style="padding:10px;">
                        <div class="panel-group pt-3">
                            <div class="panel panel-default">
                                <div class="panel-heading">Requird & Validate</div>
                                <div class="panel-body">
                                    <div class="col-12">
                                        <div class="col-12 ml-4">
                                            @include('hyperspace::components.inputs.checkbox', [
                                                'label' => "Form Uniquer",
                                                'name' => "check_unique",
                                                'checked' => @$info['check_unique'],
                                                'value' => 1
                                            ])
                                        </div>

                                    </div>
                                    <div class="col-12">

                                        <div class="form-group" id="menu_top_link">
                                            <div class="form-group col-md-12">

                                                <div class="form-group">
                                                    <label for="filter_button_text">Config fields unique</label>
                                                    {{-- <div class="col-sm-2 control-label text-right">Tab group</div> --}}

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <table id="talbe-unique_fields" class="table table-hover" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                                    <thead>
                                                                        <tr class="nodrop">
                                                                            <th width="30%">Title</th>
                                                                            <th width="30%">Option item</th>
                                                                            <th width="30%">Class</th>
                                                                            <th width="1%" nowrap="nowrap">&nbsp;</th>
                                                                            <th width="1%" nowrap="nowrap"><a href="javascript:;" class="add-unique_fields" style="font-size: 18px;"><i class="fa fa-plus"></i></a</th>
                                                                            <th width="10%" nowrap="nowrap">&nbsp;</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                                $options = !empty($info['page_tab_group']) ? json_decode($info['page_tab_group'], true) : [];

                                                                                if (is_array($options) && !empty($options)) {
                                                                                    foreach ($options as $item) {
                                                                                ?>
                                                                                        <tr class="highlight">
                                                                                            <td><input type="text" name="page_tab_group[<?= @++$tab_group ?>][key]" value="<?php echo $item['key']; ?>" class="form-control" placeholder="Key" /></td>
                                                                                            <td><input type="text" name="page_tab_group[<?= @$tab_group ?>][value]" value="<?php echo $item['value']; ?>" class="form-control" placeholder="Value" /></td>
                                                                                            <td><input type="text" name="page_tab_group[<?= @$tab_group ?>][class]" value="<?php echo @$item['class']; ?>" class="form-control" placeholder="ClassName" /></td>
                                                                                            <td class="center"><a href="javascript:;" class="remove-tab-group" style="font-size: 18px;"><i class="fa fa-trash"></i></a></td>
                                                                                            <td class="center"><a href="javascript:;" class="add-tab-group" style="font-size: 18px;"><i class="fa fa-plus"></i></a></td>
                                                                                            <td nowrap="nowrap">&nbsp;</td>
                                                                                        </tr>
                                                                                        <?php
                                                                                    }
                                                                                } else {
                                                                                    ?>
                                                                                        {{-- <tr class="highlight">
                                                                                            <td><input type="text" name="page_tab_group[<?= @++$tab_group ?>][key]" class="form-control" value="group-1" placeholder="Key" /></td>
                                                                                            <td><input type="text" name="page_tab_group[<?= @$tab_group ?>][value]" class="form-control" placeholder="Value" /></td>
                                                                                            <td><input type="text" name="page_tab_group[<?= @$tab_group ?>][class]" class="form-control" placeholder="ClassName" /></td>
                                                                                            <td class="center" width="1%"><a href="javascript:;" class="remove-option" style="font-size: 18px;"><i class="fa fa-remove"></i></a></td>
                                                                                            <td class="center" width="1%"><a href="javascript:;" class="add-tab-group" style="font-size: 18px;"><i class="fa fa-plus"></i></a></td>
                                                                                            <td nowrap="nowrap">&nbsp;</td>
                                                                                        </tr> --}}
                                                                                        <?php
                                                                                }
                                                                                ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" value="<?=@$info['id']?>" name="id" />
                    </div>
                    <div class="modal-footer justify-content-start" >
                        @csrf
                        <button type="button" class="btn btn-warning" id="btn-frm-apply">
                            <img src="{{assets}}dist/img/icon/save.png" alt="" width="15">
                             Lưu và tiếp tục

                        </button>
                        <button type="submit" class="btn btn-warning">
                            <?=request()->segment(3) =="update"?"Cập nhập": "Thêm mới"?>
                        </button>
                        <button type="button" class="btn btn-dark" data-dismiss="modal">
                            Hủy
                        </button>


                    </div>
                </form>
            </div>

            <div class="tab-pane " id="requirement" role="tabpanel">
                <form action="{{ url('admin/' . $GLOBALS['var']['act'] . '/process') }}" method="post" enctype="multipart/form-data" accept-charset="utf-8" id="updateFrm2" class="updateFrm form-horizontal bordered-row">
                    <div class="col-xs-12" ng-show="layoutSettings.saleSetting.enableTab == true" style="padding:10px;">
                        @include('admin::components.inputs.fck_editor', [
                                            'label' => "Requirement",
                                            'name' => "requirement",
                                            'value' => @$info["requirement"],
                                            'class' => '',
                                            ])
                    </div>
                    <input type='hidden' name='action' value='apply' />
                    <input type="hidden" value="<?=@$info['id']?>" name="id" />
                    <div class="modal-footer justify-content-start" >
                        @csrf
                        <button type="button" class="btn btn-warning" id="btn-frm-apply">
                            <img src="{{assets}}dist/img/icon/save.png" alt="" width="15">
                             Lưu và tiếp tục

                        </button>
                        <button type="submit" class="btn btn-warning">
                            <?=request()->segment(3) =="update"?"Cập nhập": "Thêm mới"?>
                        </button>
                        <button type="button" class="btn btn-dark" data-dismiss="modal">
                            Hủy
                        </button>


                    </div>
                </form>

            </div>

            <div class="tab-pane " id="tabs-2" role="tabpanel">
                <div id="showcmsfix">

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script type="text/javascript">
    $(document).ready(function() {
            $("#menuproject").click(function() {
                $.ajax({
                    type: "POST",
                    url: "modules/showcmsfix",
                    data: {
                        id: $('[name="id"]').val(),
                    },
                    success: function(output) {
                        hideLoading();
                        $('#showcmsfix').html(output);
                    },
                    error: function() {
                    }
                });
            });

            $('body').on('click', '.add-option', function() {
                var index = $("#mainTable-options > tbody > tr").length + 1;
                var html = '<tr class="highlight">' +
                    '<td><input type="text" name="Options[' + index +
                    '][key]" class="form-control" placeholder="Key" /></td>' +
                    '<td><input type="text" name="Options[' + index +
                    '][value]" class="form-control placeholder="Value"/></td>' +
                    '<td><input type="text" name="Options[' + index +
                    '][class]" class="form-control" placeholder="ClassName"/></td>' +
                    '<td class="center"><a href="javascript:;" class="remove-option" style="font-size: 18px;"><i class="glyph-icon icon-remove"></i></a></td>' +
                    '<td class="center"><a href="javascript:;" class="add-option" style="font-size: 18px;"><i class="glyph-icon icon-plus-circle"></i></a></td>' +
                    '<td nowrap="nowrap">&nbsp;</td>';
                $(this).parent().parent().after(html).next().find('[type="text"]').focus();

                makeDragOrder('options');
            }).on('click', '.remove-option', function() {
                var tr = $(this).parent().parent();
                $.alerts.confirm('Will you delete this item?<br/><b>' + tr.find('[type="text"]').val() +
                    '</b>', 'Confirm delete',
                    function(r) {
                        if (r == true) {
                            if ($('.remove-option').length == 1) {
                                showNoti('You can not delete the last item!', 'Delete item', 'War');
                            } else {
                                tr.remove();
                            }
                        }
                    });
            }).on('click', '.add-tab-group', function() {
                var index = $("#mainTable-tag-group > tbody > tr").length + 1;
                var html = '<tr class="highlight">' +
                    '<td><input type="text" name="page_tab_group[' + index +
                    '][key]" class="form-control" placeholder="Key" value="group-'+index+'" /></td>' +
                    '<td><input type="text" name="page_tab_group[' + index +
                    '][value]" class="form-control placeholder="Value"/></td>' +
                    '<td><input type="text" name="page_tab_group[' + index +
                    '][class]" class="form-control" placeholder="ClassName"/></td>' +
                    '<td class="center"><a href="javascript:;" class="remove-tab-group" style="font-size: 18px;"><i class="fa fa-trash"></i></a></td>' +
                    '<td class="center"><a href="javascript:;" class="add-tab-group" style="font-size: 18px;"><i class="fa fa-plus"></i></a></td>' +
                    '<td nowrap="nowrap">&nbsp;</td>';
                // $(this).parent().parent().after(html).next().find('[type="text"]').focus();
                $(this).closest("table").find('tbody').append(html);
                makeDragOrder('options');
            }).on('click', '.remove-tab-group', function() {
                var tr = $(this).parent().parent();
                $.alerts.confirm('Will you delete this item?<br/><b>' + tr.find('[type="text"]').val() +
                    '</b>', 'Confirm delete',
                    function(r) {
                        if (r == true) {
                            if ($('.remove-option').length == 1) {
                                showNoti('You can not delete the last item!', 'Delete item', 'War');
                            } else {
                                tr.remove();
                            }
                        }
                    });
            }).on('click', '.add-unique_fields', function() {
                var index = $("#mainTable-tag-group > tbody > tr").length + 1;
                var html = '<tr class="highlight">' +
                    '<td><input type="text" name="page_tab_group[' + index +
                    '][key]" class="form-control" placeholder="Key" value="group-'+index+'" /></td>' +
                    '<td><input type="text" name="page_tab_group[' + index +
                    '][value]" class="form-control placeholder="Value"/></td>' +
                    '<td><input type="text" name="page_tab_group[' + index +
                    '][class]" class="form-control" placeholder="ClassName"/></td>' +
                    '<td class="center"><a href="javascript:;" class="remove-tab-group" style="font-size: 18px;"><i class="fa fa-trash"></i></a></td>' +
                    '<td class="center"><a href="javascript:;" class="add-tab-group" style="font-size: 18px;"><i class="fa fa-plus"></i></a></td>' +
                    '<td nowrap="nowrap">&nbsp;</td>';
                // $(this).parent().parent().after(html).next().find('[type="text"]').focus();
                $(this).closest("table").find('tbody').append(html);
                makeDragOrder('options');
            }).on('click', '.remove-unique_fields', function() {
                var tr = $(this).parent().parent();
                $.alerts.confirm('Will you delete this item?<br/><b>' + tr.find('[type="text"]').val() +
                    '</b>', 'Confirm delete',
                    function(r) {
                        if (r == true) {
                            if ($('.remove-option').length == 1) {
                                showNoti('You can not delete the last item!', 'Delete item', 'War');
                            } else {
                                tr.remove();
                            }
                        }
                    });
            })


            .on('change', '.input-switch-alt', function() {
                if ($(this).prop("checked")) {
                    $(this).attr('value', 1);
                } else {
                    $(this).attr('value', 0);
                }
            });
            $("#btn-frm-apply").click(function(){
                $("#updateFrm2").append("<input type='hidden' name='action' value='apply' />");
                $("#updateFrm2").submit();
            });
        });
</script>
<script>
    $("#submitBtn").click(function() {

            $("#updateFrm").submit();
        });
</script>
@endpush

@push('js')
<link rel="stylesheet" href="{{ asset('modules/dist/style.css') }}" />
<script src="{{ asset('themes/admin/js/jquery.treeview.js') }}"></script>
@endpush
