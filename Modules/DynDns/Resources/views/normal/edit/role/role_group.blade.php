@php
$list_per = json_decode(@$row->{$ctrl->value},true);
$per = @h::array_group(@$list_per,'function_id',true);
@endphp
<div class="form-group {{  $ctrl->width}} desktop role_group" title="role_group">
    <div class="row" style="margin-left:30px;">
        <textarea name="<?=$ctrl->name?>" class="role_resule" style="display:none">{{@$row->{$ctrl->value} }}</textarea>
        <textarea name="<?=$ctrl->name.'_name'?>" class="role_resule_name" style="display: none">{{@$row->{$ctrl->value.'_name'} }}</textarea>
        <div class="col-lg-12 row" title="role_group">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="title">Chức năng</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-1" style="text-align:center">
                        Toàn quyền
                    </label>
                    <label class="col-md-1" style="text-align:center">
                        Đọc
                    </label>
                    <label class="col-md-1" style="text-align:center">
                        Tạo
                    </label>
                    <label class="col-md-1" style="text-align:center">
                        Liệt kê
                    </label>
                    <label class="col-md-1" style="text-align:center">
                        Sửa
                    </label>
                    <label class="col-md-1" style="text-align:center">
                        Xóa
                    </label>
                    <label class="col-md-1" style="text-align:center">
                        Import
                    </label>
                    <label class="col-md-1" style="text-align:center;">
                        Export
                    </label>
                </div>
            </div>
        </div>


        @php
$function = h::getData(functions,'parent',0);
usort($function, function($a, $b) {
    return $a->ordering
        <=>
            $b->ordering;
});
@endphp

            <hr style="boder-top:1px solid" />
            @foreach($function as $func)
            @if($func->indexof!='1')
            <div class="col-lg-12 item_fuction row" style="border-bottom:dashed 1px;background-color:#808080 ; color:#fff; ">
                <div class="col-md-6">
                    <div class="form-group">
                        <label style="width:100% !important">
                            {{ $func->parent!=0  ? '&nbsp;&nbsp;&nbsp;':'' }}
                            {{$func->title_en }}


                            <?php $item_per = @$per[$func->id][0]; ?>
                            <input type="hidden" class="title" value="{{$func->title_en }}" name="per[<?=@$func->id?>][title]" />
                            <input type="hidden" class="id" value="{{ @$item_per->id }}" name="per[<?=@$func->id?>][id]" />
                            <input type="hidden" class="func_id" value="{{ @$func->id }}" name="per[<?=@$func->id?>][function_id]" />
                            <input type="hidden" class="group_id" value="{{ @$row->id }}" name="per[<?=@$func->id?>][group_id]" />
                        </label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group ">
                        <label class="col-md-1" style="text-align:center">
                            <input type="checkbox" class="parent_{{ @$func->parent }} full  item" data-id="{{ @$func->id }}" value="1" />
                        </label>

                        <label class="col-md-1" style="text-align:center">
                            <input type="checkbox" class="{{ @$func->id }} parent_{{ @$func->parent }} item pread" value="1" name="per[<?=@$func->id?>][pread]" {{ \h::checked(@$item_per['pread'],'1') }} />
                        </label>
                        <label class="col-md-1" style="text-align:center">
                            <input type="checkbox" class="{{ @$func->id }} parent_{{ @$func->parent }}  item pcreate" value="1" name="per[<?=@$func->id?>][pcreate]" {{ \h::checked(@$item_per['pcreate'],'1') }}/ />
                        </label>
                        <label class="col-md-1" style="text-align:center">
                            <input type="checkbox" class="{{ @$func->id }} parent_{{ @$func->parent }}  item plist" value="1" name="per[<?=@$func->id?>][plist]" {{ \h::checked(@$item_per['plist'],'1') }} />
                        </label>
                        <label class="col-md-1" style="text-align:center">
                            <input type="checkbox" class="{{ @$func->id }} parent_{{ @$func->parent }}  item pedit" value="1" name="per[<?=@$func->id?>][pedit]" {{ \h::checked(@$item_per['pedit'],'1') }} />
                        </label>
                        <label class="col-md-1" style="text-align:center">
                            <input type="checkbox" class="{{ @$func->id }} parent_{{ @$func->parent }}  item pdelete" value="1" name="per[<?=@$func->id?>][pdelete]" {{ \h::checked(@$item_per['pdelete'],'1') }} />
                        </label>
                        <label class="col-md-1" style="text-align:center;">
                            <input type="checkbox" class="{{ @$func->id }} parent_{{ @$func->parent }}  item pimport" value="1" name="per[<?=@$func->id?>][pimport]" {{ \h::checked(@$item_per['pimport'],'1') }} />
                        </label>
                        <label class="col-md-1" style="text-align:center;">
                            <input type="checkbox" class="{{ @$func->id }} parent_{{ @$func->parent }}  item pexport" value="1" name="per[<?=@$func->id?>][pexport]" {{ \h::checked(@$item_per['pexport'],'1') }} />
                        </label>
                    </div>
                </div>
            </div>
            @endif
@php
 $subfuns = h::getData(functions,'parent',$func->id);
@endphp
@foreach($subfuns as $func)

 @if(@$func->indexof!='1')
            <div class="col-md-12 item_fuction row" style="border-bottom:dashed 1px; ">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>
                            {{ $func->parent!=0  ? '|- - - -':'' }}
                            {{ @$func->title_en }}<?php $item_per = @$per[$func->id][0]; ?>
                            <input type="hidden" class="title" value="{{@$func->title_en }}" name="per[<?=@$func->id?>][title]" />
                            <input type="hidden" class="id" value="{{ @$item_per->id }}" name="per[<?=@$func->id?>][id]" />
                            <input type="hidden" class="func_id" value="{{ @$func->id }}" name="per[<?=@$func->id?>][function_id]" />
                            <input type="hidden" class="group_id" value="{{ @$row->id }}" name="per[<?=@$func->id?>][group_id]" />
                        </label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group ">
                        <label class="col-md-1" style="text-align:center">
                            <input type="checkbox" title="Toàn quyền" class="parent_{{ @$func->parent }} full  item" data-id="{{    @$func->id }}" value="1" />
                        </label>
                        <label class="col-md-1" style="text-align:center">
                            <input type="checkbox" title="Đọc" class="{{ @$func->id }} parent_{{ @$func->parent }} item pread" value="1" name="per[<?=@$func->id?>][pread]" {{ \h::checked(@$item_per['pread'],'1') }} />
                        </label>
                        <label class="col-md-1" style="text-align:center">
                            <input type="checkbox" title="Tạo" class="{{ @$func->id }} parent_{{ @$func->parent }}  item pcreate" value="1" name="per[<?=@$func->id?>][pcreate]" {{ \h::checked(@$item_per['pcreate'],'1') }}/ />
                        </label>
                        <label class="col-md-1" style="text-align:center">
                            <input type="checkbox" title="Sở hửu" class="{{ @$func->id }} parent_{{ @$func->parent }}  item plist" value="1" name="per[<?=@$func->id?>][plist]" {{ \h::checked(@$item_per['plist'],'1') }} />
                        </label>
                        <label class="col-md-1" style="text-align:center">
                            <input type="checkbox" title="Chỉnh sửa" class="{{ @$func->id }} parent_{{ @$func->parent }}  item pedit" value="1" name="per[<?=@$func->id?>][pedit]" {{ \h::checked(@$item_per['pedit'],'1') }} />
                        </label>
                        <label class="col-md-1" style="text-align:center">
                            <input type="checkbox" title="Xóa" class="{{ @$func->id }} parent_{{ @$func->parent }}  item pdelete" value="1" name="per[<?=@$func->id?>][pdelete]" {{ \h::checked(@$item_per['pdelete'],'1') }} />
                        </label>
                        <label class="col-md-1" style="text-align:center;">
                            <input type="checkbox" title="Import" class="{{ @$func->id }} parent_{{ @$func->parent }}  item pimport" value="1" name="per[<?=@$func->id?>][pimport]" {{ \h::checked(@$item_per['pimport'],'1') }} />
                        </label>
                        <label class="col-md-1" style="text-align:center;">
                            <input type="checkbox" title="Export" class="{{ @$func->id }} parent_{{ @$func->parent }}  item pexport" value="1" name="per[<?=@$func->id?>][pexport]" {{ \h::checked(@$item_per['pexport'],'1') }} />
                        </label>
                    </div>
                </div>
            </div>
            @endif
    @php
     $subfuns = h::getData(functions,'parent',$func->id);
    @endphp
    @foreach($subfuns as $func)
    @if($func->indexof!='1')
            <div class="col-lg-12 item_fuction  row" style="border-bottom:dashed 1px; ">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>
                            {{ $func->parent!=0  ? '|- - - - - - - -':'' }}
                            {{$func->title_en }}<?php $item_per = @$per[$func->id][0]; ?>
                            <input type="hidden" class="title" value="{{$func->title_en }}" name="per[<?=@$func->id?>][title]" />
                            <input type="hidden" class="id" value="{{ @$item_per->id }}" name="per[<?=@$func->id?>][id]" />
                            <input type="hidden" class="func_id" value="{{ @$func->id }}" name="per[<?=@$func->id?>][function_id]" />
                            <input type="hidden" class="group_id" value="{{ @$row->id }}" name="per[<?=@$func->id?>][group_id]" />
                        </label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group ">
                        <label class="col-md-1" style="text-align:center">
                            <input type="checkbox" title="Toàn quyền" class="parent_{{ @$func->parent }} full  item" data-id="{{ @$func->id }}" value="1" />
                        </label>
                        <label class="col-md-1" style="text-align:center">
                            <input type="checkbox" title="Đọc" class="{{ @$func->id }} parent_{{ @$func->parent }} item pread" value="1" name="per[<?=@$func->id?>][pread]" {{ \h::checked(@$item_per['pread'],'1') }} />
                        </label>
                        <label class="col-md-1" style="text-align:center">
                            <input type="checkbox" title="Tạo" class="{{ @$func->id }} parent_{{ @$func->parent }}  item pcreate" value="1" name="per[<?=@$func->id?>][pcreate]" {{ \h::checked(@$item_per['pcreate'],'1') }}/ />
                        </label>
                        <label class="col-md-1" style="text-align:center">
                            <input type="checkbox" title="Sở hửu" class="{{ @$func->id }} parent_{{ @$func->parent }}  item plist" value="1" name="per[<?=@$func->id?>][plist]" {{ \h::checked(@$item_per['plist'],'1') }} />
                        </label>
                        <label class="col-md-1" style="text-align:center">
                            <input type="checkbox" title="Chỉnh sửa" class="{{ @$func->id }} parent_{{ @$func->parent }}  item pedit" value="1" name="per[<?=@$func->id?>][pedit]" {{ \h::checked(@$item_per['pedit'],'1') }} />
                        </label>
                        <label class="col-md-1" style="text-align:center">
                            <input type="checkbox" title="Xóa" class="{{ @$func->id }} parent_{{ @$func->parent }}  item pdelete" value="1" name="per[<?=@$func->id?>][pdelete]" {{ \h::checked(@$item_per['pdelete'],'1') }} />
                        </label>
                        <label class="col-md-1" style="text-align:center;">
                            <input type="checkbox" title="Import" class="{{ @$func->id }} parent_{{ @$func->parent }}  item pimport" value="1" name="per[<?=@$func->id?>][pimport]" {{ \h::checked(@$item_per['pimport'],'1') }} />
                        </label>
                        <label class="col-md-1" style="text-align:center;">
                            <input type="checkbox" title="Export" class="{{ @$func->id }} parent_{{ @$func->parent }}  item pexport" value="1" name="per[<?=@$func->id?>][pexport]" {{ \h::checked(@$item_per['pexport'],'1') }} />
                        </label>
                    </div>
                </div>
            </div>
            @endif
        @php
         $subfuns2 = h::getData(functions,'parent',$func->id);
        @endphp
        @foreach($subfuns2 as $func)
        @if($func->indexof!='1')
            <div class="col-lg-12 item_fuction row" style="border-bottom:dashed 1px; ">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>
                            {!! $func->parent!=0  ? '|- - - - - - - - - - - - -':'' !!}
                        {{$func->title_en }}<?php $item_per = @$per[$func->id][0]; ?>
                            <input type="hidden" class="title" value="{{$func->title_en }}" name="per[<?=@$func->id?>][title]" />
                            <input type="hidden" class="id" value="{{ @$item_per->id }}" name="per[<?=@$func->id?>][id]" />
                            <input type="hidden" class="func_id" value="{{ @$func->id }}" name="per[<?=@$func->id?>][function_id]" />
                            <input type="hidden" class="group_id" value="{{ @$row->id }}" name="per[<?=@$func->id?>][group_id]" />
                        </label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group ">
                        <label class="col-md-1" style="text-align:center">
                            <input type="checkbox" class="parent_{{ @$func->parent }} full  item" data-id="{{ @$func->id }}" value="1" />
                        </label>
                        <label class="col-md-1" style="text-align:center">
                            <input type="checkbox" class="{{ @$func->id }} parent_{{ @$func->parent }} item pread" value="1" name="per[<?=@$func->id?>][pread]" {{ \h::checked(@$item_per['pread'],'1') }} />
                        </label>
                        <label class="col-md-1" style="text-align:center">
                            <input type="checkbox" class="{{ @$func->id }} parent_{{ @$func->parent }}  item pcreate" value="1" name="per[<?=@$func->id?>][pcreate]" {{ \h::checked(@$item_per['pread'],'1') }}/ />
                        </label>
                        <label class="col-md-1" style="text-align:center">
                            <input type="checkbox" class="{{ @$func->id }} parent_{{ @$func->parent }}  item plist" value="1" name="per[<?=@$func->id?>][plist]" {{ \h::checked(@$item_per['plist'],'1') }} />
                        </label>
                        <label class="col-md-1" style="text-align:center">
                            <input type="checkbox" class="{{ @$func->id }} parent_{{ @$func->parent }}  item pedit" value="1" name="per[<?=@$func->id?>][pedit]" {{ \h::checked(@$item_per['pedit'],'1') }} />
                        </label>
                        <label class="col-md-1" style="text-align:center">
                            <input type="checkbox" class="{{ @$func->id }} parent_{{ @$func->parent }}  item pdelete" value="1" name="per[<?=@$func->id?>][pdelete]" {{ \h::checked(@$item_per['pdelete'],'1') }} />
                        </label>
                        <label class="col-md-1" style="text-align:center;">
                            <input type="checkbox" class="{{ @$func->id }} parent_{{    @$func->parent }}  item pimport" value="1" name="per[<?=@$func->id?>][pimport]" {{ \h::checked(@$item_per['pimport'],'1') }} />
                        </label>
                    </div>
                </div>
            </div>
            @endif
        @endforeach
     @endforeach
@endforeach
@endforeach
    </div>
</div>
<style type="text/css">
    .role_group .form-group {
        margin-bottom: .5rem !important;
    }
    .role_group label {
        display: inline-block;
        margin-bottom: 0rem !important;
        margin-top: .5rem !important;
    }
</style>
<script>
    $(".full").on('change', function () {
        var id = $(this).attr('data-id');
        var checked = $(this).is(':checked');

        $('.' + id).each(function () {
            if(!$(this).hasClass('pimport') && !$(this).hasClass('pexport')){
                $(this).prop('checked', checked);
            }
        });

        $('.parent_' + id).each(function () {
            if(!$(this).hasClass('pimport') && !$(this).hasClass('pexport')){
                $(this).prop('checked', checked);
            }

        });
    });

    $('.item').on('change', function () {
        var list = [];
        var name = [];
        $('.item_fuction').each(function () {
            var func = $(this).find('.func_id').val();
            var group = $(this).find('.group_id').val();
            if ($(this).find('.pread').is(':checked') == true) {
                var title = $(this).find('.title').val();
                name.push(title);
            }
            var pread = $(this).find('.pread').is(':checked')==true?1:0;

            var pcreate = $(this).find('.pcreate').is(':checked') == true ? 1 : 0;
            var plist = $(this).find('.plist').is(':checked') == true ? 1 : 0;
            var pedit = $(this).find('.pedit').is(':checked') == true ? 1 : 0;
            var pdelete = $(this).find('.pdelete').is(':checked') == true ? 1 : 0;
            var pimport = $(this).find('.pimport').is(':checked') == true ? 1 : 0;
            var pexport = $(this).find('.pexport').is(':checked') == true ? 1 : 0;
            var obj = {
                function_id: func,
                group: group,
                pread: pread,
                pcreate: pcreate,
                plist: plist,
                pedit: pedit,
                pdelete: pdelete,
                pimport: pimport,
                pexport: pexport
            };
            list.push(obj);

        });
        $('.role_resule').val(JSON.stringify(list));
        $('.role_resule_name').val(name);
    });

</script>
