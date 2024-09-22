@php
    $table = $ctrl->att_table_prefix==1?@$admin_group->prefix."_". $ctrl->att_table:$ctrl->att_table;
@endphp
<div class="form-group {{$ctrl->width}}">
    <label>
        <?=$ctrl->title?>
    </label>
    <div class="">
        <label class="form-control title<?=$lang?>">
            {{ App\Model\md::scalar($table,$ctrl->att_key."='".@$row->{ $row->{$ctrl->value} }."'" .($ctrl->att_where!=''?' and '.@$ctrl->att_where:''),$ctrl->att_field.($lang==''?'':$lang)) }}
        </label>
    </div>
</div>
