@php
             $third_module_table = @$ctrl->att_table_prefix==1?@$admin_group->prefix."_". $ctrl->att_table:$ctrl->att_table;

             $tr = md::find($third_module_table,$ctrl->att_key."='".@$row->{$ctrl->note}."'")
@endphp
@if(!h::isMobile())
<td style="text-align:center;">
    <input val="<?=@$tr->{$ctrl->value}?>" class="btgrid <?=intval(@$tr->{$ctrl->value})!=''?'publish':'unpublish'?>" type="button" />
    
    <style type="text/css">
        .btgrid {
            cursor: pointer;
            display: inline-block;
            height: 24px;
            margin: 1px;
            width: 24px;
        }
        .unpublish {
            background: rgba(0, 0, 0, 0) url("{{ env_host}}public/dashboard/adminui/assets/images/unpublish.png") no-repeat scroll 0 0;
            background-size: 24px 24px;
            border: 0 none;
        }
        .publish {
            background: rgba(0, 0, 0, 0) url("{{ env_host}}public/dashboard/adminui/assets/images/publish.png") no-repeat scroll 0 0;
            background-size: 24px 24px;
            border: 0 none;
        }
    </style>
</td>

@endif
