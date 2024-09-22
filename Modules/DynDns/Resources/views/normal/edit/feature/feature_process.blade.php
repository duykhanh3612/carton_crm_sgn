<div class="form-group {{  $ctrl->width}} desktop ">
    <label>
        {{        $ctrl->title }} @if        (@$ctrl->validate==1)
          <span style="color:#ff0000">(*)</span>@endif
    </label>
    <div class="">
        <input type="text" class="form-control {{@$ctrl->validate==1?'validation':''}}  {{ @$ctrl->needed==1?'needed':''}}   <?=$lang?>" 
               {{@$ctrl->read==1?"readonly":"name=".@$ctrl->name.$lang}} id="<?=@$name_id?>"   value="<?=@$row->{$ctrl->value.$lang}?>" placeholder="{{$ctrl->att_table}}" />
            <ul class="parsley-errors-list">
                <?=@$ctrl->note?>
            </ul>
    </div>
</div>
