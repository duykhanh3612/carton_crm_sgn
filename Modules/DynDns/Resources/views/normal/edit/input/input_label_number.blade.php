
<div class="form-group {{$ctrl->width}}">
    <label>
        <?=$ctrl->title?>
    </label>
    <div class="">
        <label class="form-control title<?=$lang?>">
            <?=number_format(@$row->{$ctrl->value})?>
        </label>
    </div>
</div>
