@php
$d_struct = json_decode($ctrl->struct);
$d_struct = array_sort($d_struct,'orderby');

@endphp
<td class="button_popup" data-title="button_popup">
    @foreach($d_struct as $_ctrl)
    <?php

    //Mask
    switch(@$_ctrl->mask){
        default:
            echo sprintf('<a href="javascript:;" class="btn btn-xs %s btn_popup" data-id="%s" data-field="%s" data-url="%s">%s</a>',
                $_ctrl->name,$row->{$func->field_id},$_ctrl->value,
                str_replace("@",url('admin').'/',$_ctrl->att_table),$_ctrl->title);
            break;
    }
    ?>
    @endforeach
</td>

