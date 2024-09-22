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
                        {!! Themes::modules('header', $module) !!}
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
                <a class="nav-link" data-toggle="tab" href="#option" role="tab">Option</a>
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

                            <div class="form-group">
                                <div class="col-xs-3 col-sm-3 control-label">Cấu hình phân quyền </div>
                                <div class="col-xs-9 col-sm-9">
                                    <div id="radio">
                                       @include("modules::modules_function.permission_config")
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
                    <div class="col-xs-12">
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
