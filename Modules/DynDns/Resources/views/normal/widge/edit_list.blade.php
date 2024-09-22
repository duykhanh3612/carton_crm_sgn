<form id="frm-post" name="form_admin" action="" method="post" enctype="multipart/form-data">
    <div class="row"><?php if($widthctrl[0]!=0):?>
        <div class="col-lg-{{$widthctrl[0]}}" style="padding:0px;">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Tùy chỉnh</h5>
                </div>
                <div class="ibox-content collapse in">
                    <div class="widgets-container"><?php
                if(@$left_ctrl)
                    foreach($left_ctrl as $ctrl):
                        $pair['row'] = @$row;
                        $pair['ctrl'] = $ctrl;
                        $pair['lang'] = @$ctrl->language==1?_lang:'';
                        $pair['path_base'] = @$path_base;
                        $ctrl_content = view(h::area_admin.'::sys.template.normal.edit.'.$ctrl->type,$pair);
?>
                        <div class="note note-info" style="clear:both;">
                            {!! @$ctrl_content !!}
                            <div style="clear:both"></div>
                        </div><?php endforeach?>
                    </div>
                </div>
            </div>
        </div><?php endif?>
        <div class="col-lg-{{$widthctrl[1]}}">
            <div class="tabs-container">
                @if(@$center_lang)
                <ul class="nav nav-tabs"><?php for($i=0;$i<count($languages);$i++):
                            $lang=$languages[$i]->languagecode?>
                    <li class="<?=$i==0?'active':''?>">
                        <a href="#tab-<?=$i+1?>" data-toggle="tab" aria-expanded="false">
                            <img src="assets/images/flags/<?=$lang?>.png" height="24" />
                        </a>
                    </li><?php endfor?>
                </ul>
                @endif
                <div class="tab-content"><?php
                    if(@$center_lang)
                        for($i=0;$i<count($languages);$i++):
                            $lang=$languages[$i]->languagecode
                    ?>
                    <div class="tab-pane <?=$i==0?'active':''?>" id="tab-<?=$i+1?>">
                        <div class="panel-body"><?php
                            if(@$center_lang)
                                foreach($center_lang as $ctrl)
                                {
                                    $pair['row'] = @$row;
                                    $pair['ctrl'] = $ctrl;
                                    $pair['lang'] = @$ctrl->language==1?'_'.@$lang:'';
                                    $pair['path_base'] = $path_base;
                                    echo view(h::area_admin.'::sys.template.normal.edit.'.$ctrl->type,$pair);
                                }
                            ?>
                        </div>
                    </div><?php endfor  ?>
<?php
                    if(@$center_nolang)
                    {
                        echo '<div class="panel-body">';
                        foreach($center_nolang as $ctrl)
                        {
                            $pair['row'] = @$row;
                            $pair['ctrl'] = $ctrl;
                            $pair['lang'] = @$ctrl->language==1?$lang:'';
                            $pair['path_base'] = $path_base;
                            echo view(h::area_admin.'::.sys.template.normal.edit.'.$ctrl->type,$pair);
                        }
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-lg-{{$widthctrl[2]}}" style="padding:0px;">
            <div class="ibox float-e-margins"><?php
                if(@$right_ctrl)
                    foreach($right_ctrl as $ctrl):
                        $pair['row'] = @$row;
                        $pair['ctrl'] = $ctrl;
                        $pair['path_base'] = @$path_base;
                        $pair['lang'] = @$ctrl->language==1?'_'.@$_lang:'';
                        $ctrl_content = view(h::area_admin.'::sys/template/normal/edit/'.@$ctrl->type,$pair);
?>
                <div class="{{@$ctrl->mask=='title'?'mar10_bottom':'note note-info'}} " style="clear:both;">
                    {!! $ctrl_content !!}
                    <div style="clear:both"></div>
                </div><?php endforeach?>
            </div>
        </div>
    </div>
    {{h::token()}}
    <input type="hidden" name="id" id="id" value="{{ @$row->{$func->field_id==''?'id':$func->field_id} }}" />
</form>

