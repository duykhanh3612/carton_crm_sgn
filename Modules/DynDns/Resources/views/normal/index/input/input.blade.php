<?php 		  	//Mask
switch(@$ctrl->mask){
    case 'input_href':
        echo @sprintf("<td> <a href='".@$row->{$ctrl->value.$lang}."' target='_blank'>%s</a></td>",substr(@$row->{$ctrl->value.$lang},0,50));
        break;
   case 'input_currencie_word':
       echo sprintf("<td".(@$ctrl->mobile!=1?"class=hidden-xs-down":"").">%s</td>",\h::currencie_word( @$row->{$ctrl->value.$lang}));
      break;
   case 'input_auto':
   case 'input_auto_id':
       echo sprintf("<td".(@$ctrl->mobile!=1?"class=hidden-xs-down":"").">%s</td>",$ctrl->note.@$row->{$ctrl->value});
      break;
   case 'input_auto_id_zero_fill':
       echo sprintf("<td  ".(@$ctrl->mobile!=1?"class=hidden-xs-down":"").">%s</td>",$ctrl->note.sprintf("%0".$ctrl->att_table."d", @$row->{$ctrl->value}));
       break;
   case 'input_age_birthday':
       echo sprintf("<td>%s</td>", date('Y',strtotime(@$row->{$ctrl->att_table})));
      break;
   case 'input_decimal':
       echo sprintf("<td ".(@$ctrl->mobile!=1?"class=hidden-xs-down":"").">%s %s</td>", @$row->{$ctrl->value} ,$ctrl->att_where);
        break;
case 'input_number':
   case 'input_number_by_percent':
       echo sprintf("<td ".(@$ctrl->mobile!=1?"class=hidden-xs-down":"").">%s %s</td>",number_format(intval(@$row->{$ctrl->value}) ),$ctrl->att_where);
       break;
   case 'input_icon':
       echo sprintf("<td ".(@$ctrl->mobile!=1?"class=hidden-xs-down":"")."><a href='%s'>%s</a></td>",url(h::area_admin.'/'. @$ctrl->att_table.'/'.@$row->{$func->field_id} ),'<i class="'.$ctrl->value.'" style="color:orangered;font-size:18px;"></i>');
       break;
   case 'input_link':
       echo sprintf("<td ".(@$ctrl->mobile!=1?"class=hidden-xs-down":"")."><a  target='_bank'  href='%s' ".@$ctrl->att_style.">%s</a></td>",url(@$ctrl->att_table.@$row->{(@$ctrl->att_field!=''?$ctrl->att_field:$func->field_id)} ),@$ctrl->value.$lang);
    break;
   case 'link_button':
       echo sprintf('<td  '.(@$ctrl->mobile!=1?"class=hidden-xs-down":"").'> <a href="'.h::site_url(h::area_admin.'/'. $ctrl->value.@$row->{$func->field_id}).'" class="btn btn-sm blue"><small>%s</small>  </a></td>',$ctrl->name);
       break;
   case 'password':
       echo '<td>'.App\Model\Admin_User::Hash_password(@$row->{$ctrl->value}).'</td>';
       break;
  case 'password_with_field':
       echo '<td>'.@$row->{$ctrl->att_table}.'</td>';
       break;
  case 'input_text_by_format':
       echo '<td>'.sprintf(@$ctrl->att_table,@$row->{$ctrl->value}).'</td>';
       break;
   case 'validation_need_description':
       $string =$ctrl->att_table;
       $finalArray = array();
       $asArr = explode( ',', $string );
       $mess = "";
       foreach( $asArr as $val ){
           $tmp = explode('=>', $val );
          if(@$row->{trim($tmp[0])}=='')
           {
               $mess .= @$tmp[1].',&nbsp;&nbsp;&nbsp;';
          }
       }
       echo "<td ".(@$ctrl->mobile!=1?"class=hidden-xs-down":"")."><em>".$mess."</em></td>";
       break;
   case 'title':?>
<td style="white-space:normal !important;  {{@$ctrl->att_style}} " class="{{@$ctrl->mobile!=1?" hidden-xs-down":""}}">
    <div style="word-wrap:break-word !important; min-width:150px; max-width:300px;">
        <?=@$row->{$ctrl->value.$lang}?>
    </div>

</td>
<?php
       break;
   default:
       echo '<td><span '.@$ctrl->att_style_index.'>'.@$row->{$ctrl->value.$lang}.'</span></td>';
       break;
}?>
