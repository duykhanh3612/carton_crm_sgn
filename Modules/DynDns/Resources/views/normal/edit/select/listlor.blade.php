@php
    $table = @$ctrl->att_table_prefix==1?@$admin_group->prefix."_". $ctrl->att_table:$ctrl->att_table;
@endphp
<div class="form-group {{$ctrl->width}} ">
    <label>
        <?=$ctrl->title?>
    </label>
    <div>
        <?=h::select($ctrl->name,@$row->{$ctrl->value},$ctrl->att_style.' class="'.$ctrl->name.' form-control" size=8',
             $table,'1=1 '.($ctrl->att_where!=''?' and '.$ctrl->att_where:''),$ctrl->att_field.($lang==''?'':'_'.$lang),$ctrl->att_key,@$ctrl->att_orderby,
             $ctrl->att_first,$ctrl->att_char,$ctrl->att_root,$ctrl->att_rootvalue);?>
    <script>
        $('.{{$ctrl->name}}').val('{{ @$row->{$ctrl->value} }}')
    </script>
    </div>
</div>
