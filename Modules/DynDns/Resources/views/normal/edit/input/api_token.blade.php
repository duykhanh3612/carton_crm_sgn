
<div class="form-group {{$ctrl->width}}">
    <label>
        <?=$ctrl->title?>
    </label>
    <div class="">
        <input type="text" class="form-control title<?=$lang?>" name="<?=@$ctrl->name.$lang?>" value="<?=@$row->{$ctrl->value.$lang}==''?\h::ApiToken(32):@$row->{$ctrl->value.$lang}?>" />
    </div>
</div>
