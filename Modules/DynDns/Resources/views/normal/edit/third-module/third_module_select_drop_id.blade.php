@php
$third_module_table = $ctrl->att_join;
$tr = md::find($third_module_table,$ctrl->att_join_field."='".@$row->{$ctrl->note}."'")
@endphp
<div class="form-group {{$ctrl->width}} ">
    <label>
        <?=$ctrl->title?>
    </label>
    <div>
        <?=h::select($third_module_table.'['.@$row->{$ctrl->att_join_key}.']['.$ctrl->name.']',@$row->{$ctrl->value},$ctrl->att_style.' class="'.$ctrl->name.' form-control"',
             $ctrl->att_table,'1=1 '.($ctrl->att_where!=''?' and '.$ctrl->att_where:''),$ctrl->att_field.($lang==''?'':'_'.$lang),$ctrl->att_key,@$ctrl->att_orderby,
             $ctrl->att_first,$ctrl->att_char,$ctrl->att_root,$ctrl->att_rootvalue);?>
    <script>
        $('.{{$ctrl->name}}').val('{{ @$tr->{$ctrl->value} }}')
    </script>
    </div>
</div>
