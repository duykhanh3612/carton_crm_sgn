<td>
    <?php
    $arr = explode(',',$ctrl->att_table);
    $arr_rs = array();
    foreach($arr as $r)
    {
        $ctrl_item = (object)@$controls_arr[$r];
        //echo '<pre>';
        //dd($ctrl_item);die;
        //echo @$ctrl_item->mask;
        switch(@$ctrl_item->mask){
            case 'input_currencie_word':
                $arr_rs[]  = \h::currencie_word( @$row->{@$ctrl_item->value.$lang});
                break;
            default:
                $arr_rs[] = @$row->$r;
                break;
        }
    }
    echo implode($ctrl->att_where." ",$arr_rs);
    ?>


</td>
