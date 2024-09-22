<form action="{{ url('admin/' . $GLOBALS['var']['act'] . '/process') }}" method="post" enctype="multipart/form-data" accept-charset="utf-8" id="updateFrm" class="updateFrm form-horizontal bordered-row content-wrapper-box ">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <a href="{{admin_url("option_items_keynum")}}">
                        <h1 class="m-0 text-uppercase font-weight-bold">
                            Option Item Keynum
                        </h1>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" name="id" value="{{ @$info['id'] }}" />
    @csrf
    <tr>
        <td>
            <div class="form-group">
                <div class="col-sm-3 control-label">Name <span style="color:red">*</span></div>
                <div class="col-sm-4">
                    <input type="text" class="form-control" data-required="1" name="Name" id="Name" value="<?= @$info['Name'] ?>" />
                    <div class="errordiv Name">
                        <div class="arrow"></div>Please input Name!
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-3 control-label">Field <span style="color:red">*</span></div>
                <div class="col-sm-4">
                    <input type="text" class="form-control" data-required="1" name="Field" id="Field" value="<?= @$info['Field'] ?>" />
                    <input type="hidden" class="form-control" name="type" id="type" value="<?= isset(request()['type']) ? request('type') : @$info['type'] ?>" />
                    <div class="errordiv Name">
                        <div class="arrow"></div>Please input Field!
                    </div>
                </div>
            </div>


            <div class="form-group">
                <div class="col-sm-3 control-label">Module <span style="color:red">*</span></div>
                <div class="col-sm-4">
                    <?php
                        if (request('mdid')) {
                            @$info['module'] = request('mdid');
                        }
                        echo form_dropdown('module[]', $options_module, json_decode(@$info['module']), 'class="form-control select2" id="module" multiple'); ?>
                    <div class="errordiv Name">
                        <div class="arrow"></div>Please input Module!
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-3 control-label">Type <span style="color:red">*</span></div>
                <div class="col-sm-4">
                    <?php
                        $options_type = [
                            '' => 'Default',
                            'text' => 'Text',
                            'value' => 'KeyValue',
                            'color' => 'Color'
                        ];
                        echo form_dropdown('type', $options_type, @$info['type'], 'class="form-control select2" id="type"'); ?>
                    <div class="errordiv Name">
                        <div class="arrow"></div>Please input Type!
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">Options <span style="color:red">*</span></div>
                <div class="col-sm-8">
                    <table id="mainTable-options" class="table table-hover" cellpadding="0" cellspacing="0" width="100%" border="0">
                        <tr class="nodrop">
                            <th width="45%">Option Name</th>
                            <th width="45%" class="<?=@$info['type']!='value'?'hidden':''?>">
                                Option Value
                                <?php if(@$info['type'] == "" && request('type') != 'text'):?>
                                <a href="<?= $_SERVER['REQUEST_URI'] ?>&type=text" class="add-option" style="font-size: 12px;">
                                    <i class="fa fa-share"></i></a>
                                <?php endif?>
                            </th>
                            <th width="45%">
                                Option Key
                                <?php if(@$info['type'] == "" && request('type') != 'text'):?>
                                <a href="<?= $_SERVER['REQUEST_URI'] ?>&type=text" class="add-option" style="font-size: 12px;">
                                    <i class="fa fa-share"></i></a>
                                <?php endif?>
                            </th>

                            <th width="1%" nowrap="nowrap">&nbsp;</th>
                            <th width="1%" nowrap="nowrap">
                                <a href="javascript:;" class="add-option" style="font-size: 18px;"><i class="fa fa-plus-circle"></i></a>
                            </th>
                        </tr>
                        <?php
                    $options = json_decode(@$info['Options']);
                    if (is_array($options) && count($options)) {
                        if(@$info['type']=='color'){
                            echo load_view('option_items_keynum/type/colors',['options'=>$options],"modules");
                        }
                        else if(@$info['type']=='value')
                        {
                            echo load_view('option_items_keynum/type/key_value',['options'=>$options],"modules");

                        }
                        else{
                            echo load_view('option_items_keynum/type/default',['options'=>$options,'info'=>$info],"modules");
                        }

                    } else {
                        ?>
                        <tr class="highlight" id="0">
                            <td><input type="text" name="Options[0][name]" value="" class="form-control" />
                            </td>
                            <td><input type="<?= request('type') == 'text' || @$info['type'] == 'text' ? 'text' : 'number' ?>" name="Options[0][key]" value="" class="form-control" /></td>
                            <td class="center" width="1%"><a href="javascript:;" class="move-option" style="font-size: 18px;"><i class="fa fa-arrows"></i></a></td>
                            <td class="center" width="1%"><a href="javascript:;" class="remove-option" style="font-size: 18px;"><i class="fa fa-remove"></i></a></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </table>
                </div>
            </div>
        </td>
    </tr>
    {{-- @include('admin::core.form_action') --}}
    @include('plugin::carton-crm.core.form_action')
</form>
@push("js")
<style type="text/css">
    .hidden {
        display: none
    }
</style>
<script>
    var key_field_type = "{{ request('type') == 'text' || @$info['type'] == 'text' ? 'text' : 'number' }}";
</script>
<script type="text/javascript">
    $(document).ready(function() {
            // dragItemOrder();
            $('body').on('click', '.add-option', function() {
                var key = 0
                if ($('#mainTable-options .highlight').length) {
                    key = parseInt($('#mainTable-options .highlight').last().attr('id')) + 1;
                }
                var html = '<tr class="highlight" id="' + key + '">' +
                    '<td><input type="text" name="Options[' + key + '][name]" class="form-control"/></td>' +
                    '<td><input type="' + key_field_type + '" name="Options[' + key +
                    '][key]" class="form-control"/></td>' +
                    '<td class="center"><a href="javascript:;" class="move-option" style="font-size: 18px;"><i class="fa fa-arrows"></i></a></td>' +
                    '<td class="center"><a href="javascript:;" class="remove-option" style="font-size: 18px;"><i class="fa fa-remove"></i></a></td>';
                $(this).closest('tbody').append(html);
                $('tr[data-id="' + key + '"]').find('[type="text"]').first().focus();

                dragItemOrder();
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
                                replaceNo();
                            }
                        }
                    });
            });
            $("#module").select2();
        }).on('click', '#submitBtn', function(){
            $("#updateFrm").submit();
        });

        function dragItemOrder() {
            $('#mainTable-options tbody').tableDnD({
                onDragClass: 'myDragClass',
                onDrop: function(table, row) {
                    replaceNo();
                },
                dragHandle: '.move-option'
            });
        }

        function replaceNo() {
            var count_tr = $('#mainTable-options .highlight').length;
            for (var i = 0; i < count_tr; i++) {
                var tr = $('#mainTable-options .highlight:eq(' + i + ')');
                tr.attr('id', i);
                tr.find('input[name="name"]').attr('name', 'Options[' + i + '][name]');
                tr.find('input[name="key"]').attr('name', 'Options[' + i + '][key]');
            }
        }
</script>
@endpush
