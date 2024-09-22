@php
    $table = $ctrl->att_table_prefix==1?@$admin_group->prefix."_". $ctrl->att_table:$ctrl->att_table;
@endphp

<div class="form-group {{$ctrl->width}} desktop">
    <label>
        <?=$ctrl->title?> @if(@$ctrl->validate==1)
        <span style="color:#ff0000">(*)</span>@endif
    </label>
    <div>
        <?=md::scalar($table,@$ctrl->att_key."='".@$row->{$ctrl->value}."'",@$ctrl->att_field)?>
    </div>
</div>

