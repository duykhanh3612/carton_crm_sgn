@php
$third_module_table = $ctrl->att_join;
$tr = md::find($third_module_table,$ctrl->att_join_key."='".@$row->{$ctrl->note}."'")
@endphp
<div class="form-group {{$ctrl->width}} ">
    <label>
        <?=$ctrl->title?>
    </label>
    <div>
        <?=h::select($third_module_table.'['.$ctrl->name.']',@$row->{$ctrl->value},$ctrl->att_style.' class="'.$ctrl->name.' form-control" size=8',
             $ctrl->att_table,'1=1 '.($ctrl->att_where!=''?' and '.$ctrl->att_where:''),$ctrl->att_field.($lang==''?'':'_'.$lang),$ctrl->att_key,@$ctrl->att_orderby,
             $ctrl->att_first,$ctrl->att_char,$ctrl->att_root,$ctrl->att_rootvalue);?>
    <script>
        @if(@$tr->{$ctrl->value}!='')
        $('.{{$ctrl->name}}').val('{{ @$tr->{$ctrl->value} }}');
        @else
        $('.{{$ctrl->name}}').val($(".{{$ctrl->name}} option:first").val());
        @endif
    </script>
    </div>
</div>
