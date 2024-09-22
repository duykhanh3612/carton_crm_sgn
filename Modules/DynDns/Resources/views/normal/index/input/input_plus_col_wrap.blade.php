<td class="plus-col">
    <?php
    $arr = explode(',',$ctrl->att_table);
    $arr_rs = array();
    foreach($arr as $r)
    {
        $ctrl = (object)@$controls_arr[$r];
        echo @$ctrl->title.":";
        if(view()->exists("admin::sys.template.normal.index.".@$ctrl->type.".".@$ctrl->mask))
        {
            $text = view("admin::sys.template.normal.index.".@$ctrl->type.".".@$ctrl->mask,array('ctrl'=>$ctrl,'row'=>$row));
            echo preg_replace('/\<[\/]?(table|tr|td)([^\>]*)\>/i', '', $text);
        }
        else
        {
            $text =  view("admin::sys.template.normal.index.input.input",array('ctrl'=>$ctrl,'row'=>$row));
            echo preg_replace('/\<[\/]?(table|tr|td)([^\>]*)\>/i', '', $text);
        }
        echo '</br/>';
    }
    ?>
    <style type="text/css">
        .plus-col .btn {
            width: 100%;
            margin: 5px;
        }
    </style>
</td>