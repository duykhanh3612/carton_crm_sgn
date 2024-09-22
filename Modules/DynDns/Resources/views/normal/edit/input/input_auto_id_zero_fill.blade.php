
<div class="form-group {{$ctrl->width}}">
    <label>
        <?=$ctrl->title?>
    </label>
    <div class="">
        <label class="form-control ">
            @if(@$row->{$ctrl->value} !='')
            {{$ctrl->note}}{{sprintf("%0".$ctrl->att_table."d", @$row->{$ctrl->value})  }}
            @else 
            {{$ctrl->note}}{{sprintf("%0".$ctrl->att_table."d", App\Model\md::val_max($func->table,'',$func->field_id) +1 ) }}
            @endif
        </label>
    </div>
</div>