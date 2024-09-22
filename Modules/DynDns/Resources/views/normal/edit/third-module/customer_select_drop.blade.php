@php
$third_module_table = $ctrl->att_join;
$tr = md::find($third_module_table,$ctrl->att_join_field."='".@$row->{$ctrl->note}."'");



@endphp
<div class="form-group {{$ctrl->width}} ">
    <div class="row">
        <label class="col-md-1">
            <?=$ctrl->title?>
        </label>
        <div class="input-group mb-3 col-md-11">

            <?=h::select($third_module_table.'[list]['.@$row->{$ctrl->att_join_key}.']['.$ctrl->name.']',@$row->{$ctrl->value},$ctrl->att_style.' class="'.@$tr->{$ctrl->value}.$ctrl->name.' form-control"',
             $ctrl->att_table,'1=1 '.($ctrl->att_where!=''?' and '.$ctrl->att_where:''),$ctrl->att_field.($lang==''?'':'_'.$lang),$ctrl->att_key,@$ctrl->att_orderby,
             $ctrl->att_first,$ctrl->att_char,$ctrl->att_root,$ctrl->att_rootvalue);?>
            <div class="input-group-prepend">
                <a href="javascript:;" title="Thêm Khách hàng mới">
                    <i class="fa fa-user-plus" aria-hidden="true"></i>
                </a>
                <a href="javascript:;" title="Chỉnh sửa Thông tin">
                    <i class="fa fa-id-card-o" aria-hidden="true"></i>
                </a>
                <a href="javascript:;" title="Thiết lập quan hệ">
                    <i class="fa fa-sitemap" aria-hidden="true"></i>
                </a>
            </div>
        </div>

        <style type="text/css">
        .input-group-prepend {
            padding-left:5px;
            padding-top:5px;
        }
        .input-group-prepend i{
            font-size: 24px;
            padding:2px;
        }
        </style>
        <script>
        $('.{{@$row->{$ctrl->value}.$ctrl->name}}').val('{{ @$row->{$ctrl->value} }}')
        </script>

    </div>

</div>
