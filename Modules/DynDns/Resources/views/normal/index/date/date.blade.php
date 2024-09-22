<td {{ @$ctrl->mobile!=1?"class=hidden-xs-down":"" }}>
    <?php

    //Mask
    switch(@$ctrl->mask){
        case 'timestamp_label':
            $tmp_date = strtotime(@$row->{@$ctrl->value});
            echo sprintf("%s", $tmp_date!="01-01-1970"?date('d-m-Y',$tmp_date):"");
            break;
        case 'timestamp_hide':
        case 'timestamp':
            $date = new DateTime();
            $date->setTimestamp(@$row->{@$ctrl->value});
            echo @$date->format('d-m-Y H:i:s') . "\n";
            break;
        case 'timestamp_dd_mm_yyyy':
            //1588179600000
            $dateTimestamp = new DateTime();
            $value = @$row->{$ctrl->value};
            if(strlen(@$row->{$ctrl->value})==13) $value = substr($value,0,10);

            if(@$row->{$ctrl->value}!='')
                $dateTimestamp->setTimestamp($value);
            $date =  $dateTimestamp->format('y-m-d h:i:s');
            echo date('d-m-Y',strtotime($date));

            break;
        case 'date_dd_mm_yyyy':
            $tmp_date = strtotime(@$row->{@$ctrl->value});
            echo sprintf("%s", $tmp_date!=""?date('d-m-Y',$tmp_date):"");
            break;
        case 'date_calc_today':


           /* if(@$row->{@$ctrl->value} == Application_Constant_Module_Default_BriefStatus::STATUS_BRIEF_WAITING_ASSIGNMENT) {
   // <span class="count-down" data-value="<?php echo date("Y-m-d H:i:s", strtotime('+2 hours', strtotime($data[DbTable_Ho_So::COL_HO_SO_CREATED_AT]))); ?>">
         //echo date("Y-m-d H:i:s", strtotime('+2 hours', strtotime($data[DbTable_Ho_So::COL_HO_SO_CREATED_AT])));
   // </span>
            //} else {*/
            echo  \date::assignProcessingTime($row->{@$ctrl->name}, $row->{@$ctrl->value});

            break;
        case 'date_dd_mm_yyyy_h_i_s':
                if(!empty(@$row->{@$ctrl->value})){
                   echo \date::getTime($row->{@$ctrl->value});
                }
                else{
                    echo "";
                }
            break;
        case 'date_cal_mpsg':
            echo date::dateDifference(@$row->{@$ctrl->att_table},@$row->{@$ctrl->value},'mpsg');
            break;
        default:
            $tmp_date = strtotime(@$row->{@$ctrl->value});
            echo sprintf("%s", $tmp_date!="01-01-1970"?date('d-m-Y H:i:s',$tmp_date):"");
            break;
    }
    ?>
</td>

