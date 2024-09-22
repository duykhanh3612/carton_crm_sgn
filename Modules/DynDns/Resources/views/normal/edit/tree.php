<?php
			//Mask
			switch(@$ctrl['mask']){
			case 'list':	?>
<div class="form-field ">
      <label class="desc"><?=$ctrl['title']?></label>
     <?=select($ctrl['name'],@$row[$ctrl['value']],$ctrl['att_style'].' class="listbox lstCate" size=4',$ctrl['att_table'],'1=1 '.$ctrl['att_where'],$ctrl['att_field'],$ctrl['att_orderby'],$ctrl['att_first'],$ctrl['att_char'],$ctrl['att_root'],$ctrl['att_rootvalue'],@$ctrl['att_join']);?>
</div>	
		<?php break;	case '3':	?>
<div class="<?=@$ctrl['width']?> form-group">
	<label class="control-label col-md-4 col-sm-3 col-xs-12"><?=$ctrl['title']?></label>
    <div class="col-md-8 col-sm-6 col-xs-12">
    	<select name="<?=$ctrl['name']?>"  class="select2_group form-control" style="display: none;" tabindex="-1">
    <?php $this->tmd->load_table($ctrl['att']['table']);
		$pair = $this->tmd->find_all($ctrl['att']['where'],"*",$ctrl['att']['orderby']);
		foreach($pair as $p):?>
		<option value="<?=$p['id']?>" <?=$p['id']==@$row[$ctrl['value']]?' selected="selected"':''?>>
         <?=val("id='".$p['khuvuc']."'","employee_khuvuc","khuvuc")?> / <?=$p[$ctrl['att']['field']]?>
        </option>
	<?php endforeach?>
    	</select>
    </div>    
</div>		 
		<?php break;	case '4':	?>
<div class="<?=@$ctrl['width']?> form-group">
	<label class="control-label col-md-8 col-sm-3 col-xs-12"><?=$ctrl['title']?></label>
    <div class="col-md-8 col-sm-6 col-xs-12">
    	<select name="<?=$ctrl['name']?>"  class="form-control">
    <?php 
		foreach($ctrl['data'] as $p):?>
		<option value="<?=$p?>" <?=$p==@$row[$ctrl['value']]?' selected="selected"':''?>>
         <?=$p?>
        </option>
	<?php endforeach?>
    	</select>
    </div>    
</div>	
		<?php break;	case '5':	?>
<div class="<?=@$ctrl['width']?> form-group">
     <label class="control-label col-md-4 col-sm-3 col-xs-12"><?=$ctrl['title']?></label>
  <div class="col-md-8 col-sm-6 col-xs-12" id="div_<?=$ctrl['value']?>">

    <?=select($ctrl['name'],@$row[$ctrl['value']],$ctrl['att_style'].' class="select2_group form-control" style="display: none;width:100%;" tabindex="-1"',$ctrl['att_table'],$ctrl['att_where'],$ctrl['att_field'],$ctrl['att_orderby'],$ctrl['att_first'],$ctrl['att_char'],$ctrl['att_root'],$ctrl['att_rootvalue']);?>  
  </div>
</div>
		<?php break;	case '6':	?>
<div class="<?=@$ctrl['width']?> form-group">
     <label class="control-label col-md-4 col-sm-3 col-xs-12"><?=$ctrl['title']?></label>
  <div class="col-md-8 col-sm-6 col-xs-12" id="div_<?=$ctrl['value']?>">

    <?=select($ctrl['name'],@$row[$ctrl['value']],$ctrl['att_style'].' class="select2_group form-control" style="display: none;width:100%;" tabindex="-1"',$ctrl['att_table'],$ctrl['att_where'],$ctrl['att_field'],$ctrl['att_orderby'],$ctrl['att_first'],$ctrl['att_char'],$ctrl['att_root'],$ctrl['att_rootvalue']);?>  
  </div>
</div>
	  <?php break;
            default:?>
<div class="<?=@$ctrl['width']?> form-group">
     <label class="control-label col-md-4 col-sm-3 col-xs-12"><?=$ctrl['title']?></label>
  <div class="col-md-8 col-sm-6 col-xs-12"  id="div_<?=$ctrl['value']?>">

    <?=select($ctrl['name'],@$row[$ctrl['value']],$ctrl['att_style'].' class="select2_group form-control" style="display: none;width:100%;" tabindex="-1"',$ctrl['att_table'],$ctrl['att_where'],$ctrl['att_field'],$ctrl['att_orderby'],$ctrl['att_first'],$ctrl['att_char'],$ctrl['att_root'],$ctrl['att_rootvalue']);?>  
  </div>
</div>
<!--<div class="form-field">
    <label class="desc"><?=$ctrl['title']?></label>
    <?=select('post['.$lang.']['.$ctrl['name'].']',@$row[$ctrl['value']],$ctrl['att_style'],$ctrl['att_table'],$ctrl['att_where'],$ctrl['att_field'],$ctrl['att_orderby'],$ctrl['att_first'],$ctrl['att_char'],$ctrl['att_root'],$ctrl['att_rootvalue'],@$ctrl['att_join']);?>
</div>                   
-->                    
		<?php break;
			}?>