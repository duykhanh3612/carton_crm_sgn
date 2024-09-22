@php
    $table = @$ctrl->att_table_prefix==1?@$admin_group->prefix."_". $ctrl->att_table:$ctrl->att_table;
    $field_lang = @$ctrl->att_field_language==1?$ctrl->att_field._lang:$ctrl->att_field;

@endphp
<?php switch(@$ctrl->mask){
          case 'dropdata':
              echo sprintf("<td ".(@$ctrl->mobile!=1?"class=hidden-xs-down":"").">%s %s</td>", @$row->{$ctrl->value} ,$ctrl->att_where);

              break;
          case 'select_count':
              echo sprintf("<td ".(@$ctrl->mobile!=1?"class=hidden-xs-down":"")." style='text-align:center;'>%s</td>", h::cor('result',$ctrl->att_key."='".@$row->{$func->field_id} ."'"));
              break;
          case 'droparraylabel':
          case 'droparray':
              switch($ctrl->att_field){
                  case 'gioitinh':
                      echo sprintf("<td".(@$ctrl->mobile!=1?"class='hidden-xs-down'":"").">%s</td>", __('lang.gioitinh_'.@$row->{$ctrl->value}) );
                      break;
                  case 'trangthai':
                      echo sprintf("<td>%s</td>", __('lang.trangthai_'.@$row->{$ctrl->value}) );
                      break;
                  default:

                            $string =$ctrl->att_table;
                            $finalArray = array();

                            $asArr = explode( ',', $string );

                            foreach( $asArr as $val ){
                                $tmp = explode('=>', $val );
                                $finalArray[ ltrim($tmp[0]) ] = $tmp[1];
                            }

                      echo sprintf("<td>%s</td>", @$finalArray[@$row->{$ctrl->value}])  ;
                      break;
              }

              break;
                  case 'related':
                      echo '<td>';
                        foreach(md::find_all($ctrl->note,"topic_id='".@$row->id."'") as $r_section)
                        echo '<small>'.md::scalar($ctrl->att_join_key,"id='". $r_section->section_id."'",'title'._lang).', </small>';
                     echo '</td>';
                      break;
          default:
              echo sprintf("<td".(@$ctrl->mobile!=1?" class='hidden-xs-down'":"").">%s</td>", App\Model\md::scalar($table,"`".$ctrl->att_key."`='".@$row->{$ctrl->value}."'" .($ctrl->att_where!=''?' and '.$ctrl->att_where:''),$field_lang));
              break;
      }?>


