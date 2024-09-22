@php
$third_module_table = @$ctrl->att_table_prefix=='1'?@$group->prefix.'_'.$ctrl->att_table:$ctrl->att_table;
$tr = md::find_all($third_module_table,$ctrl->att_key."='".@$row->{$ctrl->note}."'");
$d_struct = json_decode($ctrl->struct);
$d_struct = array_sort($d_struct,'orderby');
@endphp
@if(!h::isMobile())

<div class="form-group {{  $ctrl->width}} desktop ">
    <div  id="{{$third_module_table}}_detail_content">
        @foreach($tr as $t_r)
        <div class="row {{$third_module_table}}_detail_item row_item">
			<h1></h1> <span class="row_item_remove" data-id="{{$t_r->{$ctrl->att_field} }}"><i class="fa fa-times"></i></span>
            @foreach($d_struct as $ds)

                @php
                 $pair = array();
                 $pair['row'] = @$t_r;
                 $name  = $ds->name;
                 $ds->name = 'third_table['.$third_module_table.']['.$ctrl->att_key.'#'.@$row->{$ctrl->note}.'#'.$ctrl->att_field.']['.$t_r->{$ctrl->att_field}.']['.$name.']';
                 $pair['ctrl'] = $ds;
                 $pair['lang'] = @$ctrl->language==1?'_'.@$lang:'';
                 $pair['path_base'] = $path_base;
                @endphp
                {!! view(h::area_admin.'::sys.template.normal.edit.'.$ds->type,$pair) !!}
                @php
                    $ds->name = $name;
             @endphp
            @endforeach
            <hr style="border-top:1px dashed  #f74343;width:100%;clear: both; margin:15px;" />
        </div>
        @endforeach
    </div>
    <div id="{{$third_module_table}}_row_new" style="display:none">
        <div class="row {{$third_module_table}}_detail_item row_item">
            <h1></h1>
            <span class="row_item_remove">
                <i class="fa fa-times"></i>
            </span>
            @foreach($d_struct as $ds)
              @php
             $pair = array();
             $pair['row'] = array();
             $name  = $ds->name;
             $ds->name = 'third_table['.$third_module_table.']['.$ctrl->att_key.'#'.@$row->{$ctrl->note}.'#'.$ctrl->att_field.'][#id#]['.$name.']';
             $pair['ctrl'] = $ds;
             $pair['lang'] = @$ctrl->language==1?'_'.@$lang:'';
             $pair['path_base'] = $path_base;
             @endphp
                {!! view(h::area_admin.'::sys.template.normal.edit.'.$ds->type,$pair) !!}
                @php
             $ds->name = $name;
             @endphp
            @endforeach
            <hr style="border-top:1px dashed  #f74343;width:100%;clear: both; margin:15px;" />
        </div>
    </div>
    <div style="clear:both">
        <a id="{{$third_module_table}}_add_row" href="javascript:;">
            <span class="btn  {{@$conf->site_style}}">
                <i class="fa fa-plus"></i>
            </span>            
        </a>
    </div>
    <script>
        $(document).ready(function () {
            $('#{{$third_module_table}}_add_row').click(function () {

                var div_html = $('#{{$third_module_table}}_row_new').html();
                var length = $('.{{$third_module_table}}_detail_item').length;
                div_html = replaceAll(div_html, "#id#", '-' + length + 1);
                $('#{{$third_module_table}}_detail_content').append(div_html);

                var html_ele = $('#{{$third_module_table}}_detail_content').find('.row_item').last();
                // html_ele.find('.select2_ctrl').attr('id', html_ele.find('.select2_ctrl').attr('id') + length);

            });
            $('.row_item_remove').click(function () {
                var tag = $(this);
                var id = $(this).attr('data-id');
                var table = "{{$ctrl->att_table}}";
                var key = "{{$ctrl->att_field}}";
                if (id != '') {
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
                       // $('#noidung').html(ketqua);
                        tag.parent().remove();
                    });
                }
                else
				    $(this).parent().remove();
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
    .row_item {
		position:relative;
		padding-left:50px;
    }
        .select2-container--default .select2-selection--single .select2-selection__rendered{
            background-color:#fff;
            line-height: 18px !important;
        }
    .row_item:nth-child(even) {background: #CCC}
    .row_item:nth-child(odd) {}

        .row_item .row_item_remove {
			position:absolute;
			top:50px;
			left:20px;
            cursor:pointer;
        }
            .row_item .row_item_remove i {
				font-size:32px;
				color:#ff0000;
            }
    .row_item h1:before {
        position: absolute;
        top: 0px;
        left: 0px;
        counter-increment: number;
        content: " " counter(number) " ";
        margin-left: 20px;
    }
</style>
