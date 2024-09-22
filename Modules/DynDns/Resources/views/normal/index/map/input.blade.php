<?php 		  	//Mask
switch(@$ctrl->mask){
   //Phone
    case 'input_href':?>
<td>
    <a href="{{@$row->{$ctrl->value.$lang} }}" target="_blank">
        {{substr(@$row->{$ctrl->value.$lang},0,50) }}
    </a>
</td>
<?php
      break;
   //Email
   case '3':?>
<td>
   <?php if(@$ctrl['link']==1):?>
   <a href="<?=site_url($this->uri->segment(1).'/edit/'.$row['id'])?>">
      <?=@$row[$ctrl['value']]?>
   </a>
   <?php else:?>
   <?=@$row[$ctrl['value']]?>
   <?php endif?>
</td>
<?php
      break;
   //colorpicker-element
   case '4':?>
<td>
   <?php if(@$ctrl['link']==1):?>
   <a href="<?=site_url($this->uri->segment(1).'/edit/'.$row['id'])?>">
      <?=@$row[$ctrl['value']]?>
   </a>
   <?php else:?>
   <?=@$row[$ctrl['value']]?>
   <?php endif?>
</td>
<?php
      break;
   //Tex order
   case 'order':?>
<td style="width:50px !important;">
   <input type="text" name="row[<?=$row->id?>][<?=$ctrl->name?>]" class="full" value="<?=$row->{$ctrl->value}?>" style="width:50px !important;" />
</td>
<?php
      break;
   //Tex order
   case '6':?>
<td>
   <?=@$row[$ctrl['value']]?>
</td>
<?php
      break;
   //Tex order
   case 'number':
       echo sprintf("<td>%s</td>",number_format( @$row->{$ctrl->value.$lang}));
       break;
   case 'input_icon':
       echo sprintf("<td><a href='%s'>%s</a></td>",url(h::area_admin.'/'. @$ctrl->att_table.'/'.@$row->{$func->field_id} ),'<i class="'.$ctrl->value.'" style="color:orangered;font-size:18px;"></i>');
       break;
   case 'input_link':
       echo sprintf("<td><a href='%s' ".@$ctrl->att_style.">%s</a></td>",url(@$ctrl->att_table.'/'.@$row->{(@$ctrl->att_field!=''?$ctrl->att_field:$func->field_id)} ),@$row->{$ctrl->value.$lang});
    break;
   default:?>

<td class="textleft" style="max-width:250px;word-wrap:break-word">
   <span style="white-space:normal;">
      <?=@$row->{$ctrl->value.$lang}?>
   </span>
</td>

<?php break;
}?>
