
<div class="form-group {{  $ctrl->width}}" style="border-bottom:1px dashed;margin-top:20px  ">
    <hr style="border-bottom:3px solid;width:100%;clear: both; " />
    <label style="font-size:24px;">
        <?=@$ctrl->note?>
        <?=@$row->{$ctrl->value.$lang}?>
    </label>
</div>
