
<div class="form-group {{$ctrl->width}}">
    <label>
        <?=$ctrl->title?>
    </label>
    <div class="">
        <label class="form-control title<?=$lang?>">
            <?=@$row->{$ctrl->value.$lang}?>
        </label>
    </div>
</div>
