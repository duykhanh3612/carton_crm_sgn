<?php		
switch(@$ctrl->mask){
    case '2':	
?>
<div class="<?=@$ctrl['width']?> form-group">
	<label class="control-label col-md-4 col-sm-3 col-xs-12"><?=$ctrl->title?></label>
    <div class="col-md-8 col-sm-6 col-xs-12">
    <h4><?=@$row->{$ctrl->value}!=''?@$row->{$ctrl->value}:date('d/m/Y')?></h4>
    <span class="help-inline"><?=@$ctrl['note']?></span>
    </div>
</div>
			<?php break;
    case '3':	
            ?>
<div class="<?=@$ctrl['width']?> form-group">
	<label class="control-label col-md-4 col-sm-3 col-xs-12"><?=$ctrl->title?></label>
    <div class="col-md-8 col-sm-6 col-xs-12">
    <h4><?=date('d/m/Y',strtotime(@$row->{$ctrl->value}))?></h4>
    <span class="help-inline"><?=@$ctrl['note']?></span>
    </div>
</div>
			<?php break;
    case '4':	
            ?>
<div class="<?=@$ctrl['width']?> form-group">
	<label class="control-label col-md-4 col-sm-3 col-xs-12"><?=$ctrl->title?></label>
    <div class="col-md-8 col-sm-6 col-xs-12">
    <h4><?=date('d/m/Y',strtotime(@$row->{$ctrl->value}))?></h4>
    <span class="help-inline"><?=@$ctrl['note']?></span>
    </div>
</div>
			<?php break;
    case '5':	
            ?>
<div class="<?=@$ctrl['width']?> form-group">
	<label class="control-label col-md-4 col-sm-3 col-xs-12"><?=$ctrl->title?></label>
    <div class="col-md-8 col-sm-6 col-xs-12">
	<select id="<?=$ctrl->name?>" name="<?=$ctrl->name?>" class="form-control">
    <?php $value=@$row->{$ctrl->value}!=''?@$row->{$ctrl->value}:date('m');?>
    <?php for($i=1;$i<13;$i++):?>
    	<option value="<?=$i?>" <?=@$value==$i?'selected="selected"':''?>>Tháng <?=$i?></option>
    <?php endfor?>
    </select>
    </div>
</div>
			<?php break;
    case '6':	
            ?>
<div class="<?=@$ctrl['width']?> form-group">
	<label class="control-label col-md-4 col-sm-3 col-xs-12"><?=$ctrl->title?></label>
    <div class="col-md-8 col-sm-6 col-xs-12">
	<select id="<?=$ctrl->name?>" name="<?=$ctrl->name?>" class="form-control" >
    <?php for($i=date('Y');$i>date('Y')-10;$i--):?>
    	<option value="<?=$i?>" <?=@$row->{$ctrl->value}==$i?'selected="selected"':''?>>Tháng <?=$i?></option>
    <?php endfor?>
    </select>
    </div>
</div>

<?php break;
    default:?>
<div class="form-group">
     <?php $date = @$row->{$ctrl->value}!=''?@$row->{$ctrl->value}:date('Y-m-d')?>
	  <label for="dtp_input2" class="control-label"><?=$ctrl->title?></label>
	  <div class="input-group date form_date form-control" data-date="<?=date('d/m/Y',strtotime($date))?>" data-date-format="dd/mm/yyyy" data-link-field="<?=$ctrl->name?>" data-link-format="yyyy-mm-dd">
		 <input class="form-control" size="16" value="<?=date('d/m/Y',strtotime($date))?>" readonly="" type="text">
		 <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span> <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
	  </div>
	  <input id="<?=$ctrl->name?>" name="<?=$ctrl->name?>" value="<?=date('Y-m-d',strtotime($date))?>" type="hidden">
	  <br>
</div>
<?php break;
}?>
