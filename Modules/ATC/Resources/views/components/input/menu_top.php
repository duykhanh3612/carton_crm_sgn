<?php if(@$GLOBALS['module']['menu_top']  && @$GLOBALS['module']['menu_top_options'] != "" && @$GLOBALS['var']['do'] != "update" ):?>
<ul class="nav nav-tabs" id="atcTab" role="tablist">
    <?php foreach(json_decode(@$GLOBALS['module']['menu_top_options']) as $menu_link):?>
    <li class="nav-item" role="presentation">
        <a href="<?php echo site_url($menu_link->value) ?>" class="nav-link <?=@$menu_link->class?> <?=$_SERVER['REQUEST_URI']=='/'.$menu_link->value?'active':''?>" ><?=$menu_link->key?> </a>
    </li>
    <?php endforeach?>
</ul>
<?php endif?>