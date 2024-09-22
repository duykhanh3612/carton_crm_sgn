
<div class="form-group {{$ctrl->width}}">
    <label>
        <?=$ctrl->title?>
    </label>
    <div class="">
        <label class="form-control ">
            @if(@$row->{$ctrl->value} !='')
            {{$ctrl->note}}{{@$row->{$ctrl->value} }}
            @else 
            {{$ctrl->note}}{{ App\Model\md::val_max($func->table,'',$func->field_id) +1 }}
            @endif
        </label>
    </div>
</div>