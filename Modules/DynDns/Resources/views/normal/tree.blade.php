@if(@$rows)
    @foreach($rows as $row)
    <li>
        <span class="wtree_row">
            @if($func->action!='none')
            <div class="left">@include($template.'sys.template.normal.table_check')</div>
            @endif
            <div class="form-group">
                <?php if(@$controls_index)
                    foreach($controls_index as $ctrl){
                        echo "<div class='col-".@++$i."'>";
                        $pair['row'] = @$row;
                        $pair['ctrl'] = $ctrl;
                        $pair['path_base'] = $path_base;
                        $pair['lang'] = @$ctrl->language==1?'_'.(@$_lang??'vn'):'';
                        $pair['func'] = $func;
                        if($ctrl->mask=='input_auth_name_hidden' || $ctrl->mask=='input_auth_email_hidden')
                        {
                            if($per->plist==1){
                                echo View(alias_admin.'::sys.template.normal.index.'.$ctrl->type, $pair);
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
                        echo "</div>";
                    }
                ?>
            </div>
            <div class="right"> @include($template.'sys.template.normal.table_option')</div>
        </span>
        @php
            $childItems = md::find_all($func->table,"cate='".$row->id."'");
        @endphp
        @if(count($childItems)>0)
        <ol>
            {{ view(alias_admin.'::sys.template.normal.tree',["rows"=>$childItems]) }}
        </ol>
        @endif
    </li>
    @endforeach
@endif