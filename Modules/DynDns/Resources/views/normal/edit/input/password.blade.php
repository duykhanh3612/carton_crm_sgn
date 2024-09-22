<div class="form-group {{  $ctrl->width}} ">
    <label>
        <?=$ctrl->title?>
    </label>
    <div class="">
        <input type="password" class="form-control title<?=$lang?>" id="<?=$ctrl->name.$lang?>" name="ssl[<?=$ctrl->name.$lang?>]" value="" />
        <ul class="parsley-errors-list" id="parsley-id-4995">
            <?=@$ctrl->note?>
        </ul>
    </div>
</div>
