
<div class="form-group {{$ctrl->width}}" data-title="treelist">
    <span>
        <?=$ctrl->title?>
    </span>
    @php
             $where = '1=1 '. (@$ctrl->att_where!=''?' and '.@$ctrl->att_where:'');
    @endphp
    <?=h::tree(@$ctrl->name,@$row->{$ctrl->value},@$ctrl->att_style.' class="form-control lstCate" size=8',
            @$ctrl->att_table,$where,@$ctrl->att_field,@$ctrl->att_level,@$ctrl->att_key, @$ctrl->att_orderby,
            @$ctrl->att_first,@$ctrl->att_char,@$ctrl->att_root,@$ctrl->att_rootvalue);?>
</div>
