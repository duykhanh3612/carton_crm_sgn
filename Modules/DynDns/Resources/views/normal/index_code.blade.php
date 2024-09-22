<?php
$full_content = '';
if(@$center_nolang)
foreach($center_nolang as $ctrl)
{
   // echo file_get_contents('./app/Modules/admin/Views/sys/template/normal/edit/'.$ctrl->type.'.blade.php');
      //echo view(h::area_admin.'::sys.template.normal.edit.'.$ctrl->type);
    $content ;

    if(view()->exists("admin::sys.template.normal.edit.".$ctrl->type.".".@$ctrl->mask))
            $content =  @file_get_contents('./app/Modules/admin/Views/sys/template/normal/edit/'.$ctrl->type.'/'.$ctrl->mask.'.blade.php');
        else
            $content =  @file_get_contents('./app/Modules/admin/Views/sys/template/normal/edit/'.$ctrl->type.'/'.$ctrl->type.'.blade.php');
    $ar = array('$ctrl->width','$ctrl->title','(@$ctrl->read==1?"readonly disabled ":"")','@if(@$ctrl->validate==1)<span style="color:#ff0000">(*)</span>@endif',
                        '@$ctrl->name','$ctrl->name','$ctrl->value','$ctrl->att_style','$ctrl->att_table','$ctrl->att_where','$ctrl->att_field',
                        '@$ctrl->att_key','@$ctrl->att_orderby','$ctrl->att_first','$ctrl->att_char','$ctrl->att_root');


    $ac = array($ctrl->width,$ctrl->title,(@$ctrl->read==1?"readonly disabled ":""),(@$ctrl->validate==1?'(*)':'') ,
                        @$ctrl->name,  $ctrl->name,  $ctrl->value,  $ctrl->att_style,  $ctrl->att_table,$ctrl->att_where,$ctrl->att_field,
                        "'".@$ctrl->att_key."'","'".@$ctrl->att_orderby."'","'".$ctrl->att_first."'","'".$ctrl->att_char."'","'".$ctrl->att_root."'");
    $content = str_replace($ar,$ac,$content);
    $content = str_replace(array('{{','}}',"<?=","?>"),array('','',"",""),$content);
    $content .= '</br><!-- '.'./app/Modules/admin/Views/sys/template/normal/edit/'.$ctrl->type.'/'.$ctrl->mask.'.blade.php'.'--></br>';
    $full_content.= $content;

}

if(@$center_lang)
    foreach($center_lang as $ctrl)
    {
        // echo file_get_contents('./app/Modules/admin/Views/sys/template/normal/edit/'.$ctrl->type.'.blade.php');
        //echo view(h::area_admin.'::sys.template.normal.edit.'.$ctrl->type);
        $content ;
        dd($ctrl);
        if(view()->exists("admin::sys.template.normal.edit.".@$ctrl->type.".".@$ctrl->mask))
            $content =  @file_get_contents('./app/Modules/admin/Views/sys/template/normal/edit/'.@$ctrl->type.'/'.$ctrl->mask.'.blade.php');
        else
            $content =  @file_get_contents('./app/Modules/admin/Views/sys/template/normal/edit/'.@$ctrl->type.'/'.$ctrl->type.'.blade.php');
        $ar = array('$ctrl->width','$ctrl->title','(@$ctrl->read==1?"readonly disabled ":"")','@if(@$ctrl->validate==1)<span style="color:#ff0000">(*)</span>@endif',
                            '@$ctrl->name','$ctrl->name','$ctrl->value','$ctrl->att_style','$ctrl->att_table','$ctrl->att_where','$ctrl->att_field',
                            '@$ctrl->att_key','@$ctrl->att_orderby','$ctrl->att_first','$ctrl->att_char','$ctrl->att_root');


        $ac = array(@$ctrl->width,@$ctrl->title,(@$ctrl->read==1?"readonly disabled ":""),(@$ctrl->validate==1?'(*)':'') ,
                            @$ctrl->name,  @$ctrl->name,  @$ctrl->value,  @$ctrl->att_style,  @$ctrl->att_table,@$ctrl->att_where,@$ctrl->att_field,
                            "'".@$ctrl->att_key."'","'".@$ctrl->att_orderby."'","'".@$ctrl->att_first."'","'".@$ctrl->att_char."'","'".@$ctrl->att_root."'");
        $content = str_replace($ar,$ac,$content);
        $content = str_replace(array('{{','}}',"<?=","?>"),array('','',"",""),$content);
        $content .= '</br><!-- '.'./app/Modules/admin/Views/sys/template/normal/edit/'.@$ctrl->type.'/'.@$ctrl->mask.'.blade.php'.'--></br>';
        $full_content.= $content;
    }
    if(request('debug')==true)
        echo '<textarea style="width:100%;height:600px;">'.htmlentities($full_content).'</textarea>';
    else echo $full_content;
?>

