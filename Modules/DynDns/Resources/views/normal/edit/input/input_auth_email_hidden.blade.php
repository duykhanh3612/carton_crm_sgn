
@if(@$row->{$ctrl->value}=='')
<input type="hidden" class="form-control" id="<?=@$ctrl->name.$lang?>" name="<?=@$ctrl->name.$lang?>" value="{{App\Model\Admin::_full_name()}}" />
@endif
