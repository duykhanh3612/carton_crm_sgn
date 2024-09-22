<?php
echo module_open('');
$has_tab = is_array($category_list) && count($category_list) > 1;
if ($has_tab) {
    echo '<tr class="no-border">';
    echo '<td>';
    echo '<input type="hidden" class="tabId" value="' . $GLOBALS['var']['mytab'] . '"/>';
    echo '<ul id="myTab" class="nav nav-tabs">';
    $i = 0;
    foreach ($category_list as $data) {
        echo '<li class="' . ($i > 2 ? ' hide640' : '') . ($data['id'] == $GLOBALS['var']['mytab'] || ($GLOBALS['var']['mytab'] == $i && $i == 0) ? ' active' : '') . '" onclick="set_mytab($(this))"><a href="#tabs-' . $data['id'] . '" data-toggle="tab">' . $data['name_vn'] . '</a></li>';
        $i++;
    }
    echo '<li class="dropdown show640">';
    echo '<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="glyph-icon icon-align-justify"></i><span class="caret"></span></a>';
    echo '<ul class="dropdown-menu">';
    $i = 0;
    foreach ($category_list as $data) {
        if ($i > 2) {
            echo '<li' . ($data['id'] == $GLOBALS['var']['mytab'] || ($GLOBALS['var']['mytab'] == $i && $i == 0) ? ' class="active"' : '') . ' onclick="set_mytab($(this))"><a href="#tabs-' . $data['id'] . '" data-toggle="tab">' . $data['name_vn'] . '</a></li>';
        }
        $i++;
    }
    echo '</ul>';
    echo '</li>';
    echo '</ul>';
    echo '<div id="myTabContent" class="tab-content">';
}
$i = 0;
foreach ($category_list as $data) {
    if ($has_tab) {
        echo '<div id="tabs-' . $data['id'] . '" data-tab="'.$data['id'].'" class="hide-columns tab-pane' . ($data['id'] == $GLOBALS['var']['mytab'] || ($GLOBALS['var']['mytab'] == $i && $i == 0) ? ' active' : '') . '">';
        echo '<table class="table table-hover" cellpadding="0" cellspacing="0" width="100%" border="0">';
    }
    ?>
    <thead>
    <tr class="nodrop">
        <?php if ($GLOBALS['cfg']['develop_mode'] && $GLOBALS['per']['del']) echo '<th class="center" width="1%"><input id="checkall" type="checkbox" class="checkAll custom-checkbox"/></th>'; ?>
        <th class="center" width="2%" style="min-width: 40px;" nowrap="nowrap"><?php echo create_sort('id') ?>#</th>
        <?php
        foreach ($cols as $key => $col) {
            echo col_name($col, $key);
        }
        ?>
        <th class="center" width="1%">&nbsp;</th>
    </tr>
    </thead>
    <?php
    if (is_array($tabs[$data['id']]) && count($tabs[$data['id']])) {
        $i = 1;
        foreach ($tabs[$data['id']] as $row) {
            ?>
            <tr class="highlight" id="<?php echo $row['id'] ?>" name="<?php echo $row['name_vn'] ?>">
                <?php if ($GLOBALS['per']['del']) echo '<td class="center">'.sel_item($row['id'], !$GLOBALS['per']['del'] || !$GLOBALS['cfg']['develop_mode']).'</td>'; ?>
                <td class="center" width="1%"><?php echo stt($row['id'], $GLOBALS['var']['rowstart'] + $i) ?></td>
                <?php
                foreach ($cols as $key => $col) {
                    echo col_val($col, $key, $row[$key], $row['id'], site_url($GLOBALS['var']['act'] . '/update/' . $row['id']) . $uri_str);
                }
                ?>
                <td class="center" nowrap="nowrap">
                    <?php
                    if ($GLOBALS['per']['edit']) {
                        echo edit_alink('', $url_update.'/'.$row['id'].$uri_str);
                    }
                    if ($GLOBALS['cfg']['develop_mode'] && $GLOBALS['per']['del']) {
                        echo del_restore_link($row['id'], $row['deleted']);
                    }
                    ?>
                </td>
            </tr>
            <?php
            $i++;
        }
    } else {
        echo no_data_mes(count((array)$cols) + 3);
    }
    if ($has_tab) {
        echo '</table>';
        echo '</div>';
    }
    $i++;
}
if ($has_tab) {
    echo '</div>';
    echo '</td>';
    echo '</tr>';
}
echo module_close();
?>
<script type="text/javascript">
    $(document).ready(function() {
        <?php
        if ($updated == 1) {
            echo 'showNoti("Mô đun: ' . $name . '", "Thêm mới mô đun thành công!", "Ok");';
        }
        if ($failed == 1) {
            echo 'showNoti("Mô đun: ' . $name . '", "Cập nhật mô đun thất bại!", "Err");';
        }
        if ($GLOBALS['var']['deleted'] != 1) {
            echo 'makeDragOrder("'.$GLOBALS['var']['act'].'");';
        }
        ?>
    });
</script>