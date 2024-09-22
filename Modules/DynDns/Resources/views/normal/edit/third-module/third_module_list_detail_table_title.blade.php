@php

$third_module_table = @$ctrl->att_table_prefix=='1'?@$admin_group->prefix.'_'.$ctrl->att_table:$ctrl->att_table;


$tr = md::find_all($third_module_table, $ctrl->att_key."='".@$row->{$ctrl->att_foreign}."'",@$ctrl->att_order);
$d_struct = json_decode($ctrl->struct);
$d_struct = \h::array_sort($d_struct,'orderby');
@endphp
@if(!h::isMobile())

<div class="form-group {{  $ctrl->width}} desktop " title="third_module_list_detail_table">
    <table class="third_list_tale">
        <thead>
            <tr>

                <th style="width:10px;"></th>
                @foreach($d_struct as $ds)
                @if($ds->edit==1)
                <th {!! @$ds->
                    att_style !!}>
                    {{$ds->title }}
                </th>
                @endif
                @endforeach
                <th></th>
            </tr>
        </thead>

        <tbody id="{{$third_module_table}}_detail_content">
            @foreach($tr as $t_r)
            <tr class="{{$third_module_table}}_detail_item row_item">

                <td>
                    <span class="row_header"></span>

                </td>

                @foreach($d_struct as $ds)
                    @if($ds->edit==1)
                    @php
                     $pair = array();
                     $pair['row'] = @$t_r;
                     $name  = $ds->name;
                     $ds->name = 'third_table['.$third_module_table.']['.$ctrl->att_key.'#'.@$row->{att_foreign}.'#'.$ctrl->att_field.']['.$t_r->{$ctrl->att_field}.']['.$name.']';
                     $pair['ctrl'] = $ds;
                     $pair['lang'] = @$ctrl->language==1?'_'.@$lang:'';
                     $pair['path_base'] = $path_base;
                    @endphp
                <td {!! @$ds->att_style !!}>
                    {{ @$t_r->{$ds->value} }}
                </td>
                @endif
                    @php
                        $ds->name = $name;
                    @endphp
                @endforeach

            </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        $(document).ready(function () {
            $('.third_list_tale  thead tr th').each(function () {
                if ($(this).attr('data-group') != undefined) { //true
                    var value = $(this).html();

                    $(this).attr("colspan", 2);

                    $(this).next("th").remove(); // removes extra td
                }

            });

            $('.third_list_tale  tbody tr td').each(function () {
                if ($(this).attr('data-group') != undefined) { //true
                    var value = $(this).html();
                    var value_next = $(this).next("td").html();

                    $(this).attr("colspan", 2);
                    $(this).append(value_next);

                    $(this).next("td").remove(); // removes extra td
                }

            });
            $('#{{$third_module_table}}_add_row').click(function () {

                var div_html = $('#{{$third_module_table}}_row_new').html();
                var length = $('.{{$third_module_table}}_detail_item').length;
                div_html = "<tr>" + replaceAll(div_html, "#id#", '-' + length + 1) + "</tr>";
                $('#{{$third_module_table}}_detail_content').append(div_html);

                var html_ele = $('#{{$third_module_table}}_detail_content').find('.row_item').last();
                // html_ele.find('.select2_ctrl').attr('id', html_ele.find('.select2_ctrl').attr('id') + length);
                $('.third_list_tale  tbody tr:last td').each(function () {
                    if ($(this).attr('data-group') != undefined) { //true
                        var value = $(this).html();
                        var value_next = $(this).next("td").html();

                        $(this).attr("colspan", 2);
                        $(this).append(value_next);

                        $(this).next("td").remove(); // removes extra td
                    }

                });

                $('.row_item_remove').click(function () {
                        $(this).parent().parent().remove();
                });

            });
            $('.row_item_remove').click(function () {
                var tag = $(this);
                var id = $(this).attr('data-id');
                var table = "{{$third_module_table}}";
                var key = "{{$ctrl->att_field}}";
                if (id != undefined) {
                    $.ajax({
                        url: '{{url('admin/'.$func->phpfile.'/remove_by_third_party')}}',
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                        data: {
                            id: id,
                            table: table,
                            key: key,

                        }
                    }).done(function (ketqua) {
                        tag.parent().parent().remove();
                    });
                }
                else
                    $(this).parent().parent().remove();
			});

            function replaceAll(str, find, replace) {
                return str.replace(new RegExp(find, 'g'), replace);
            }


        });

    </script>
</div>
@else
<div class="form-group {{  $ctrl->width}} mobo style-input-mobo">
    <ul class="parsley-errors-list">
        <?=@$ctrl->note?>
    </ul>
    <label>
        {{ $ctrl->title }}
        @if(@$ctrl->validate==1) <span style="color:#ff0000">(*)</span>@endif
    </label>
    <div class="input-box">
        <input type="text" class="form-control {{@$ctrl->validate==1?'validation':''}}  {{ @$ctrl->needed==1?'needed':''}}   title<?=$lang?> nd"
               {{@$ctrl->read==1?"readonly":"name=".@$ctrl->name.$lang}} id="<?=@$ctrl->name.$lang?>"
                value="<?=@$tr->{$ctrl->value.$lang}?>" placeholder="{{$ctrl->att_table}}" />
    </div>
</div>
@endif
<style type="text/css">
    body {
        counter-reset: number;
    }

    table {
      border-collapse:separate;
      border-spacing: 0 0.2em;
    }
    .third_list_tale .form-group{
        margin:0px !important;
    }
    .third_list_tale{
        width: 100%;
        border: 1px solid #eee
    }
    .third_list_tale tr{
        height: 45px;
        border-bottom: 1px solid  #eee;
        width:100%;
        clear: both;
        margin:15px;
    }
    .third_list_tale tbody td{
        padding-left:5px;
        padding-right:5px;
    }
    .third_list_tale tbody td label{
        display:none;
    }
    .third_list_tale tbody td div{
        padding:0px !important;
    }
    .row_item {
		position:relative;
		padding-left:50px;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered{
        background-color:#fff;
        line-height: 18px !important;
    }
    .row_item:nth-child(even) {
        /*background: #fcf2f2*/

    }
    .row_item:nth-child(odd) {}

        .row_item .row_item_remove {
			/*position:absolute;
			top:50px;
			left:20px;*/
            cursor:pointer;
            padding:5px;
        }
            .row_item .row_item_remove i {
				font-size:24px;
				color:#ff0000;
            }
    .row_item .row_header:before {
            line-height:1;
        counter-increment: number;
        content: " " counter(number) " ";
            font-size:16px;
    }
</style>
