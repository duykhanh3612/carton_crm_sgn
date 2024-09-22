@php
    $table = @$ctrl->att_table_prefix==1?@$admin_group->prefix."_". $ctrl->att_table:$ctrl->att_table;
    $field_lang = $ctrl->att_field.(@$ctrl->att_field_language==1?_lang:'');
@endphp

<div class="form-group {{$ctrl->width}} desktop" data-title="select_list">
    <label>
        <?=$ctrl->title?> @if(@$ctrl->validate==1)
        <span style="color:#ff0000">(*)</span>@endif
    </label>
    <div>
        <?=h::select(@$ctrl->read==1?"":@$ctrl->name.$lang,@$row->{$ctrl->value},(@$ctrl->read==1?"readonly disabled ":""). $ctrl->att_style.' class="'.$ctrl->name.' form-control" size=8',
             $table,$ctrl->att_where,$field_lang,@$ctrl->att_key,@$ctrl->att_order,
             $ctrl->att_first,$ctrl->att_char,$ctrl->att_root,$ctrl->att_rootvalue);?>
        <ul class="parsley-errors-list"></ul>
        <script>
        @if(@$row->{$ctrl->value} !='')
        $('.{{$ctrl->name}}').val('{!!@$row->{$ctrl->value} !!}')
        @else
        $('.{{$ctrl->name}}').val( $('.{{$ctrl->name}} option:firs').val());
        @endif
        </script>
    </div>
</div>
