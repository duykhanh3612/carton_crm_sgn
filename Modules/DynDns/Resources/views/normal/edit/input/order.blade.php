
<div class="form-group {{  $ctrl->width}} ">
    <label>
        <?=$ctrl->title?>
    </label>
    <div class="">
        <input name="<?=$ctrl->name?>" value="<?=@$row->{$ctrl->value}?>" class="form-control" type="text" />
    </div>
</div>
		
