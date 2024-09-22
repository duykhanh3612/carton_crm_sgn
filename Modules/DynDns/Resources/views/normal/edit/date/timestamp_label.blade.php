
<div class="form-group">
    <label>
        <?=$ctrl->title?>
    </label>
    <div>
        <label class="form-control title<?=$lang?>">
            <?=date('d/m/Y',@$row->{$ctrl->value.$lang})?>
        </label>
    </div>
</div>