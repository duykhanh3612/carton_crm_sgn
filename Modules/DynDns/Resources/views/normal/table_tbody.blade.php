@if(@$rows)

 @foreach($rows as $row)

<tr>

    @if($func->action!='none')

    @include($template.'sys.template.normal.table_check')

    @endif

    <?php if(@$controls_index)
        foreach($controls_index as $ctrl){
            $pair['row'] = @$row;
            $pair['ctrl'] = $ctrl;
            $pair['path_base'] = $path_base;
            $pair['lang'] = @$ctrl->language==1?'_'.$_lang:'';
            $pair['func'] = $func;
            if($ctrl->mask=='input_auth_name_hidden' || $ctrl->mask=='input_auth_email_hidden')
            {
                if($per->plist==1)
                    //echo View(alias_admin.'::sys.template.normal.index.'.$ctrl->type, $pair);
                {
                    if(view()->exists("admin::sys.template.normal.index.".$ctrl->type.".".@$ctrl->mask))
                        echo view("admin::sys.template.normal.index.".$ctrl->type.".".@$ctrl->mask,$pair);
                     else if(view()->exists("admin::sys.template.normal.index.".$ctrl->type.".".@$ctrl->type))
                        echo view("admin::sys.template.normal.index.".$ctrl->type.".".@$ctrl->type,$pair);
                    else echo '<td></td>';
                }
            }
            else
            {
                if(view()->exists("admin::sys.template.normal.index.".$ctrl->type.".".@$ctrl->mask))
                    echo view("admin::sys.template.normal.index.".$ctrl->type.".".@$ctrl->mask,$pair);
               else if(view()->exists("admin::sys.template.normal.index.".$ctrl->type.".".@$ctrl->type))
                    echo view("admin::sys.template.normal.index.".$ctrl->type.".".@$ctrl->type,$pair);
                else echo '<td></td>';
            }

        }
    ?>

    @include($template.'sys.template.normal.table_option')



</tr>

@endforeach

 @endif
