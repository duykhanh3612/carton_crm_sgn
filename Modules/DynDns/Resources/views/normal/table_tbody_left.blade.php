@if(@$rows)
 @foreach($rows as $row)
 @php
    if(is_array($row)){
        $row = convertObject($row);
    }
@endphp
<tr>
    @if($func->action!='none')
    @include($template.'sys.template.normal.table_check')
    @endif
    @include($template.'sys.template.normal.table_option')
    <?php if(@$controls_index)
        foreach($controls_index as $ctrl){
            $pair['row'] = (object)@$row;
            $pair['ctrl'] = $ctrl;
            $pair['path_base'] = $path_base;
            $pair['lang'] = @$ctrl->language==1?'_'.$_lang:'';
            $pair['func'] = $func;
            if(view()->exists("admin::sys.template.normal.index.".$ctrl->type.".".@$ctrl->mask))
                echo view("admin::sys.template.normal.index.".$ctrl->type.".".@$ctrl->mask,$pair);
            else if(view()->exists("admin::sys.template.normal.index.".$ctrl->type.".".@$ctrl->type))
                echo view("admin::sys.template.normal.index.".$ctrl->type.".".@$ctrl->type,$pair);


            // if($ctrl->type!=''  && view()->exists(_alias_admin.'::sys.template.normal.index.'.$ctrl->type.".".@$ctrl->mask))
            //  echo View(_alias_admin.'::sys.template.normal.element_index', $pair);

            // echo view("admin::sys.template.normal.index.".$ctrl->type.".".@$ctrl->mask,$pair);
            else echo '<td></td>';
        }
    ?>


</tr>
@endforeach
 @endif
