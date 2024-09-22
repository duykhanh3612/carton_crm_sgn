
<div class="form-group">
    <label>
        <?=$ctrl->title?>
    </label>
    <div class="">
        <label class="form-control title<?=$lang?>">
            <?=App\Model\md::scalar($ctrl->att_table,$ctrl->att_key."='".@$row->{$ctrl->value}."'",$ctrl->att_field.($lang==''?'':$lang))?>
        </label>
    </div>
</div>
