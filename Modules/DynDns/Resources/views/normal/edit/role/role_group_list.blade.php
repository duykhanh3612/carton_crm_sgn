@php
$list_per = json_decode(@$row->{$ctrl->value},true);
$per = @h::array_group(@$list_per,'function_id',true);
@endphp
<div class="form-group {{  $ctrl->width}} desktop " title="role_group_list">
<textarea name="<?=$ctrl->name?>" class=" role_resule" style="display:none">{{@$row->{$ctrl->value} }}</textarea>
<textarea name="<?=$ctrl->name.'_name'?>" class="role_resule_name" style="display:none">{{@$row->{$ctrl->value.'_name'} }}</textarea>
<div class="col-lg-12">
    <div class="col-md-6">
        <div class="form-group">
            <label class="title">Chức năng</label>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="col-md-1" style="text-align:center">
                Full
            </label>
            <label class="col-md-1" style="text-align:center">
                Read
            </label>
            <label class="col-md-1" style="text-align:center">
                Create
            </label>
            <label class="col-md-1" style="text-align:center">
                List
            </label>
            <label class="col-md-1" style="text-align:center">
                Edit
            </label>
            <label class="col-md-1" style="text-align:center">
                Delete
            </label>
            <label class="col-md-1" style="text-align:center">
                Import
            </label>
        </div>
    </div>
</div>


@php
$function = h::getData(functions,'group_id',$admin_group->id);
usort($function, function($a, $b) {
    return $a->ordering <=> $b->ordering;
});
@endphp

<hr style="boder-top:1px solid" />
@foreach($function as $func)
<div class="col-lg-12 item_fuction" style="border-bottom:dashed 1px;{{$func->parent==0?'background-color:#808080 ; color:#fff;padding-top:15px;':''}}  ">
    <div class="col-md-6">
        <div class="form-group">
            <label>
                {{ $func->parent!=0  ? '&nbsp;&nbsp;&nbsp;':'' }}
                {{$func->title_en }}
                <?php $item_per = array_first(@$per[$func->id]); ?>
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
            <label class="col-md-1" style="text-align:center">
                <input type="checkbox" class="{{ @$func->id }} parent_{{ @$func->parent }}  item" value="1" name="per[<?=@$func->id?>][pimport]" {{    \h::checked(@$item_per['pimport'],'1') }} />
            </label>
        </div>
    </div>
</div>
@endforeach
    </div>
<script>
    $(".full").on('change', function () {
        var id = $(this).attr('data-id');
        var checked = $(this).is(':checked');

        $('.' + id).each(function () {
            $(this).prop('checked', checked);
        });

        $('.parent_' + id).each(function () {
            $(this).prop('checked', checked);
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

            var obj = {
                function_id: func,
                group: group,
                pread: pread,
                pcreate: pcreate,
                plist: plist,
                pedit: pedit,
                pdelete: pdelete
            };
            list.push(obj);
            
        });
        $('.role_resule').val(JSON.stringify(list));
        $('.role_resule_name').val(name);
    });

</script>
