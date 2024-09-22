<div class="{{@$ctrl->width}} form-group">
  <label ><?=$ctrl->title?> @if(@$ctrl->validate==1)
<span style="color:#ff0000">(*)</span>@endif
</label>
  <div >     
      <input type="email" class="form-control {{ @$ctrl->validate==1?'validation':''}}  has-feedback-left" id="inputSuccess4" placeholder="Email" name="<?=$ctrl->name?>" value="{{@$row->{$ctrl->value} }}" data-type="email" />
      <ul class="parsley-errors-list" id="parsley-id-4995">
          <?=@$ctrl->note?>
      </ul>
  </div>  
</div>