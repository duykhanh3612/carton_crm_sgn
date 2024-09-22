<?php 		  	//Mask
switch(@$ctrl->mask){
   case 'value':?>
        <input type="hidden" class="form-control" name="<?=$ctrl->name?>" value="<?=$ctrl->value?>" />
<?php break;
	default:?>

        <input type="hidden" class="form-control" name="<?=$ctrl->name?>" value="{{App\Model\User::doanhnghiep()}}" />

<?php break;}?>
