<div class="form-group {{  $ctrl->width}} ">
    <label>
        <?=$ctrl->title?>
    </label>
    <div class="">
        <input type="password" class="form-control title<?=$lang?> validation" data-type="password_confirn" data-field="{{$ctrl->att_table}}" data-content="{{$ctrl->note}}" id="<?=$ctrl->name.$lang?>" name="<?=$ctrl->name.$lang?>" value="" />
        <ul class="parsley-errors-list" id="parsley-id-{{$ctrl->name.$lang}}"></ul>
    </div>
</div>