@php
    $colLeft = empty($colLeft) ? 12 : $colLeft;
    if($colLeft == 12){
        $colRight = 12;
    }
    $type = (isset($type) && in_array($type, ['text', 'number', 'date', 'password', 'file', 'hidden' , 'email'])) ? $type : 'text';
    $value = old( $name, $value ?? '' );
    if($value && is_array($value)){
        $value = implode(', ', $value);
    }
@endphp
<div class="row {{ $rowClass ?? '' }}"
@if(!empty($rowData))
    @foreach($rowData as $dataKey => $dataVal)
        data-{{$dataKey}}="{{ $dataVal }}"
    @endforeach
@endif
>
    <div class="col-md-{{$colLeft}}">
        <div class="form-group">
             @if(!empty($label))
                 <label for="{{ $name }}">{{ $label }}: @if(!empty($required)) <span class="text-danger">*</span>@endif</label>
             @endif
            <div>
                @php
                $list_per = json_decode($value,true);
                $per = array_group(@$list_per??[],'function_id',true);
                @endphp
                <div class="form-group col-w-802 desktop role_group" title="role_group">
                    <div class="form-group" style="">
                        <textarea name="<?=$name?>" class="role_resule" style="display:none">{{@$value }}</textarea>
                        <textarea name="<?=$name.'_name'?>" class="role_resule_name" style="display: none">{{@$value_name }}</textarea>
                        <div class="col-lg-12 item_fuction  row" title="role_group">
                            <div class="col-md-4" style="background: #fff">
                                <div class="form-group">
                                    <label class="title">Chức năng</label>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="col-w-80" style="text-align:center">
                                        Full
                                    </label>
                                    <label class="col-w-80" style="text-align:center">
                                        Đọc
                                    </label>
                                    <label class="col-w-80" style="text-align:center">
                                        Tạo
                                    </label>
                                    <label class="col-w-80" style="text-align:center">
                                        Liệt kê
                                    </label>
                                    <label class="col-w-80" style="text-align:center">
                                        Sửa
                                    </label>
                                    <label class="col-w-80" style="text-align:center">
                                        Xóa
                                    </label>
                                    {{-- <label class="col-w-80" style="text-align:center">
                                        Import
                                    </label>
                                    <label class="col-w-80" style="text-align:center;">
                                        Export
                                    </label> --}}
                                </div>
                            </div>
                        </div>


                        @php

                            $function = [
                                '0'=> [
                                    'id'=> '1',
                                    'module'=> 'order',
                                    'parent' => 'order',
                                    'name' => 'Đơn hàng '
                                ],
                                '1'=> [
                                    'id'=> '2',
                                    'module'=> 'product',
                                    'parent' => 'product',
                                    'name' => 'Hàng hóa'
                                ],
                                '3'=> [
                                    'id'=> '3',
                                    'module'=> 'customer',
                                    'parent' => 'customer',
                                    'name' => 'Khách hàng'
                                ],
                                '4'=> [
                                    'id'=> '4',
                                    'module'=> 'revenue',
                                    'parent' => 'revenue',
                                    'name' => 'Doanh số'
                                ],
                                '5'=> [
                                    'id'=> '5',
                                    'module'=> 'payment',
                                    'parent' => 'payment',
                                    'name' => 'Thu chi'
                                ],
                                '6'=> [
                                    'id'=> '6',
                                    'module'=> 'setting',
                                    'parent' => 'revenue',
                                    'name' => 'Thiết lập'
                                ]
                            ]

                            @endphp
                            @foreach($function as $func)
                            @php $func = (object)$func; @endphp
                            <div class="col-lg-12 item_fuction row" >
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="item-name" style="width:100% !important">

                                            {{ $func->name }}


                                            <?php $item_per = @$per[$func->id][0]; ?>
                                            <input type="hidden" class="title" value="{{$func->name }}"  />
                                            <input type="hidden" class="id" value="{{ @$item_per->id }}" />
                                            <input type="hidden" class="func_id" value="{{ @$func->id }}"  />
                                            <input type="hidden" class="group_id" value="{{ @$row->id }}"  />
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group ">
                                        <label class="col-w-80" style="text-align:center">
                                            <input type="checkbox" class="parent_{{ @$func->parent }} full  item" data-id="{{ @$func->id }}" value="1" />
                                        </label>

                                        <label class="col-w-80" style="text-align:center">
                                            <input type="checkbox" class="{{ @$func->id }} parent_{{ @$func->parent }} item pread" value="1"  {{ radio_checked(@$item_per['pread'],'1') }} />
                                        </label>
                                        <label class="col-w-80" style="text-align:center">
                                            <input type="checkbox" class="{{ @$func->id }} parent_{{ @$func->parent }}  item pcreate" value="1"  {{ radio_checked(@$item_per['pcreate'],'1') }}/ />
                                        </label>
                                        <label class="col-w-80" style="text-align:center">
                                            <input type="checkbox" class="{{ @$func->id }} parent_{{ @$func->parent }}  item plist" value="1" {{ radio_checked(@$item_per['plist'],'1') }} />
                                        </label>
                                        <label class="col-w-80" style="text-align:center">
                                            <input type="checkbox" class="{{ @$func->id }} parent_{{ @$func->parent }}  item pedit" value="1" {{ radio_checked(@$item_per['pedit'],'1') }} />
                                        </label>
                                        <label class="col-w-80" style="text-align:center">
                                            <input type="checkbox" class="{{ @$func->id }} parent_{{ @$func->parent }}  item pdelete" value="1"  {{ radio_checked(@$item_per['pdelete'],'1') }} />
                                        </label>
                                        {{-- <label class="col-w-80" style="text-align:center;">
                                            <input type="checkbox" class="{{ @$func->id }} parent_{{ @$func->parent }}  item pimport" value="1"  {{ radio_checked(@$item_per['pimport'],'1') }} />
                                        </label>
                                        <label class="col-w-80" style="text-align:center;">
                                            <input type="checkbox" class="{{ @$func->id }} parent_{{ @$func->parent }}  item pexport" value="1"  {{ radio_checked(@$item_per['pexport'],'1') }} />
                                        </label> --}}
                                    </div>
                                </div>
                            </div>

                            <!-- Sub menu -->
                            @if(isset($func->nodes))
                            @foreach($func->nodes as $func)
                            @php $func = (object)$func; @endphp
                            <div class="col-w-802 item_fuction row" style="border-bottom:dashed 1px; ">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="item-name">
                                            {{ @$func->parent !=0  ? '|- - - -':'' }}
                                            {{ @$func->name }}<?php $item_per = @$per[$func->id][0]; ?>
                                            <input type="hidden" class="title" value="{{@$func->name }}"  />
                                            <input type="hidden" class="id" value="{{ @$item_per->id }}" />
                                            <input type="hidden" class="func_id" value="{{ @$func->id }}"  />
                                            <input type="hidden" class="group_id" value="{{ @$row->id }}"  />
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group ">
                                        <label class="col-w-80" style="text-align:center">
                                            <input type="checkbox" title="Toàn quyền" class="parent_{{ @$func->parent }} full  item" data-id="{{    @$func->id }}" value="1" />
                                        </label>
                                        <label class="col-w-80" style="text-align:center">
                                            <input type="checkbox" title="Đọc" class="{{ @$func->id }} parent_{{ @$func->parent }} item pread" value="1"  {{ radio_checked(@$item_per['pread'],'1') }} />
                                        </label>
                                        <label class="col-w-80" style="text-align:center">
                                            <input type="checkbox" title="Tạo" class="{{ @$func->id }} parent_{{ @$func->parent }}  item pcreate" value="1"  {{ radio_checked(@$item_per['pcreate'],'1') }}/ />
                                        </label>
                                        <label class="col-w-80" style="text-align:center">
                                            <input type="checkbox" title="Sở hửu" class="{{ @$func->id }} parent_{{ @$func->parent }}  item plist" value="1" {{ radio_checked(@$item_per['plist'],'1') }} />
                                        </label>
                                        <label class="col-w-80" style="text-align:center">
                                            <input type="checkbox" title="Chỉnh sửa" class="{{ @$func->id }} parent_{{ @$func->parent }}  item pedit" value="1" {{ radio_checked(@$item_per['pedit'],'1') }} />
                                        </label>
                                        <label class="col-w-80" style="text-align:center">
                                            <input type="checkbox" title="Xóa" class="{{ @$func->id }} parent_{{ @$func->parent }}  item pdelete" value="1"  {{ radio_checked(@$item_per['pdelete'],'1') }} />
                                        </label>
                                        {{-- <label class="col-w-80" style="text-align:center;">
                                            <input type="checkbox" title="Import" class="{{ @$func->id }} parent_{{ @$func->parent }}  item pimport" value="1"  {{ radio_checked(@$item_per['pimport'],'1') }} />
                                        </label>
                                        <label class="col-w-80" style="text-align:center;">
                                            <input type="checkbox" title="Export" class="{{ @$func->id }} parent_{{ @$func->parent }}  item pexport" value="1"  {{ radio_checked(@$item_per['pexport'],'1') }} />
                                        </label> --}}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif
                            @endforeach

                    </div>
                </div>
                @push('js')
                <style type="text/css">

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
                @endpush
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    .col-w-80{
        width: 80px !important;
        display: inline-flex !important;
        align-items: center;
        height: 35px;
        margin-bottom: 0;
        padding-bottom: 0px;
        border-right: 1px solid #ddd;
        justify-content: center;
    }
    .role_group .form-group {
        margin-bottom: 0rem !important;
    }
    .role_group .item-name{
        display: inline-flex !important;
        align-items: center;
        height: 35px;
        margin-bottom: 0;
    }
    .role_group label {
        display: inline-block;
        /* margin-bottom: 0rem !important;
        margin-top: .5rem !important; */
    }
    .item_fuction>div:nth-child(1)
    {
        border-right: 1px solid #ddd;
    }
    .item_fuction{
        background: #fafafa;
        font-weight: bold;
        border-top: 1px solid #ddd;
        border-left: 1px solid #ddd;
        border-right: 1px solid #ddd;
    }
    .item_fuction:last-child{
        border-bottom: 1px solid #ddd;
    }
</style>
