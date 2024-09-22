<?php if(@$controls_index) foreach(@$controls_index as $ctrl):?>

    <?php
          switch(@$ctrl->mask){
              //Phone
              case 'input_age_birthday':
                 echo "<th ".($ctrl->type=='published'?"style='width:50px;'":"").">".@$ctrl->note."</th>";
                  break;
              case 'input_auth_name_hidden':
              case 'input_auth_email_hidden':
                  if($per->plist==1)
                      echo "<th ".(@$ctrl->mobile!=1?"class='hidden-xs-down'":"")." ".($ctrl->type=='published'?"style='width:50px;'":"").">".@$ctrl->title."</th>";
                  break;
              case 'input_plus_col':
              case 'link_button':
              case 'link_button_submit':
                  echo "<th style='width:30px;'>".@$ctrl->title."</th>";
                  break;
              case 'publish':
              case 'publish_custom':
                  echo "<th ".(@$ctrl->mobile!=1?"class='hidden-xs-down'":"")." ".($ctrl->type=='published'?"style='width:50px;'":"").">". @$ctrl->mobiel.@$ctrl->title."</th>";
                  break;
              case 'map_formatted_address_lat_lng_placeid':
                  echo "<th ".(@$ctrl->mobile!=1?"class='hidden-xs-down'":"")." style='width:150px;' title='marker'>". @$ctrl->mobiel.@$ctrl->title."</th>";
                  break;
              case 'language_data_check':
                  echo '<th style="text-align:center;widht:40px">';
                   foreach($language as $lang){
                       echo '<img src="'.env_host.'/public/plugin/flag-icon-css-master/flags/1x1/'.$lang->languagecode.'.svg" style="height:16px;padding-left:3px;" />';
                   }
                  echo '</th>';
                  break;
              default:
                  echo "<th valign='top' style='".@$ctrl->att_style_index."'".(@$ctrl->mobile!=1?"class='hidden-xs-down'":"").">". @$ctrl->mobiel.@$ctrl->title."</th>";
                  break;
          }
?>

<?php endforeach?>
