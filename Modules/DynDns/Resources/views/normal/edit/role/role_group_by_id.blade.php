@php
if(isset($row->{@$func->field_id})){
    $funs = App\Model\md::find_all("sys_function","group_id='".$row->{@$func->field_id} ."'","group_id,ordering,orderby");
    $group_function = @h::array_group($funs->toArray(),'group_id',true);
    $list_per = json_decode(@$row->{$ctrl->value.$lang},true);
    $per = @h::array_group(@$list_per,'function_id',true);
}
@endphp
@isset($group_function)
    <div class="form-group {{  $ctrl->width}} desktop " title="role_group_by_id">
    <textarea name="<?=$ctrl->name?>" class="role_resule" style="display:none">{{@$row->{$ctrl->value} }}</textarea>
    <div class="row" title="role_group_by_id">
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



    @foreach($group_function as $g=>$g_v)
        @php
        $function = App\Model\md::find_all("sys_function","parent=0 and group_id='".$g."'","group_id,ordering,orderby");
        @endphp
        <label class="title" style="border-top:1px solid #eee">{{ $g }}</label>
        <hr style="boder-top:1px solid" />
        @foreach($function as $func)
        <div class="row item_fuction" style="border-bottom:dashed 1px;">
            <div class="col-md-6">
                <div class="form-group">
                    <label style="width:100% !important;text-align:left !important">
                        {!! $func->parent!=0  ? '&nbsp;&nbsp;&nbsp;':'' !!}
                        {{$func->title_en }}
                        <?php $item_per = @$per[$func->id][0]; ?>
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
                        <input type="checkbox" class="{{ @$func->id }} parent_{{ @$func->parent }}  item" value="1" name="per[<?=@$func->id?>][pimport]" {{ \h::checked(@$item_per['pimport'],'1') }} />
                    </label>
                </div>
            </div>
        </div>
            <!-- Sub 2 -->
            @php
            $function2 = App\Model\md::find_all("sys_function","parent='".$func->id."'","group_id,ordering,orderby");
            @endphp
            @foreach($function2 as $func)
            <div class="row item_fuction" style="border-bottom:dashed 1px;">
                <div class="col-md-6">
                    <div class="form-group">
                        <label style="width:100% !important;text-align:left !important">
                            {!! $func->parent!=0  ? '|- - - -':'' !!}
                            {{$func->title_en }}
                            <?php $item_per = @$per[$func->id][0]; ?>
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
                            <input type="checkbox" class="{{ @$func->id }} parent_{{ @$func->parent }}  item" value="1" name="per[<?=@$func->id?>][pimport]" {{ \h::checked(@$item_per['pimport'],'1') }} />
                        </label>
                    </div>
                </div>
            </div>
            <!-- Sub 3-->
            <!-- Sub 2 -->
            @php
                    $function3 = App\Model\md::find_all("sys_function","parent='".$func->id."'","group_id,ordering,orderby");
            @endphp
            @foreach($function3 as $func)
            <div class="row item_fuction" style="border-bottom:dashed 1px;">
                <div class="col-md-6">
                    <div class="form-group">
                        <label style="width:100% !important;text-align:left !important">
                            {!! $func->parent!=0  ? '|- - - - - - - -':'' !!}
                            {{$func->title_en }}
                            <?php $item_per = @$per[$func->id][0]; ?>
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
                            <input type="checkbox" class="{{ @$func->id }} parent_{{ @$func->parent }}  item" value="1" name="per[<?=@$func->id?>][pimport]" {{ \h::checked(@$item_per['pimport'],'1') }} />
                        </label>
                    </div>
                </div>
            </div>
            @endforeach
            @endforeach
        @endforeach
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
            $('.item_fuction').each(function () {
                var func = $(this).find('.func_id').val();
                var group = $(this).find('.group_id').val();
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
                if (pread!=0)
                    list.push(obj);
            });
            $('.role_resule').val(JSON.stringify(list));
        });
    </script>
@endisset