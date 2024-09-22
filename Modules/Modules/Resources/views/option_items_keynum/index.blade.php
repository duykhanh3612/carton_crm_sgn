<?php echo module_open(); ?>
<thead>
    <form id="filter<?php echo @$GLOBALS['var']['act'] ?>">
        <tr class="filter-head">
            <th <?= @$GLOBALS['per']['del'] ? 'colspan="2"' : '' ?> nowrap="nowrap">
                <button type="submit" class="btn btn-danger">Filter</button>
            </th>
            <?php
            foreach ($cols as $key => $col) {
                if (in_array($key, array_keys($cols_type))) {
                    echo component($cols_type[$key]["type"], ['key' => $key, 'options' => $cols_type[$key]["data"], 'value' => Arr::get(request('filter'),$key)]);
                } else {
                    $option_filter = isset($options[$key]) ? $options[$key] : [];
                    echo col_filter($col, $key, request('filter'), $option_filter);
                }
            }
            ?>
            <th class="center" width="1%">&nbsp;</th>
        </tr>
    </form>
    <tr class="nodrop">
        <?php if ($GLOBALS['per']['del']) echo '<th class="center" width="1%"><input id="checkall" type="checkbox" class="checkAll custom-checkbox"/></th>'; ?>
        <th class="center" width="2%" style="min-width: 40px;" nowrap="nowrap">#</th>
        <?php
        foreach ($cols as $key => $col) {
            echo col_name($col, $key);
        }
        ?>
        <th class="center" width="5%">&nbsp;</th>
    </tr>
</thead>
<?php
if (!empty($rows)) {
    $i = 1;
    foreach ($rows as $row) {
        $row = (array)$row;
        ?>
        <tr class="highlight" id="<?php echo $row['id'] ?>" name="<?php echo $row['Name'] ?>">
            <?php if ($GLOBALS['per']['del']) echo '<td class="center">'.sel_item($row['id']).'</td>'; ?>
            <td class="center" width="2%"><?php echo stt($row['id'], $i++) ?></td>
            <?php
            foreach ($cols as $key => $col) {
                if ($key == 'Options') {
                    $options = json_decode($row[$key]);
                    $val = '<select class="form-control">';
                    if (is_array($options) && count($options)) {
                        foreach ($options as $option) {
                            $val .= '<option value="' . $option->key . '">' . $option->name . '</option>';
                        }
                    }
                    $val .= '</select>';
                } else if($key == 'module'){
                    $val = isset($modules[$row['module']]) ? '<span title="' . $modules[$row['module']] . '">' . trimlink($modules[$row['module']], 30) . '</span>' : '';
                } else if($key == 'active'){

                    $val = $row[$key]?'Active':'NonActive';
                } else {
                    $val = isset($row[$key]) ? '<span title="' . $row[$key] . '">' . trimlink($row[$key], 30) . '</span>' : '';
                }
                echo col_val($col, $key, $val, $row['id'], current_url() . '/update/' . $row['id'] . $uri_str);
            }
            ?>
            <td class="center" width="5%" nowrap="nowrap">
                <?php
                if ($GLOBALS['per']['edit']) {
                    echo edit_alink('', $url_update.'/'.$row['id'].$uri_str);
                }
                if ($GLOBALS['per']['del']) {
                    echo del_restore_link($row['id'], $row['deleted']);
                }
                ?>
            </td>
        </tr>
        <?php
    }
} else {
    echo no_data_mes(count((array)$cols) + 3);
}
echo module_close();
?>
<div class="paging"><?=$rows->links() ?></div>
<script type="text/javascript">
    $(document).ready(function() {
        <?php
        if (@$updated == 1) {
            echo 'showNoti("Option: ' . $name . '", "Thêm thông tin thành công!", "Ok");';
        }
        if (@$failed == 1) {
            echo 'showNoti("Option: ' . $name . '", "Thêm thông tin thất bại!", "Err");';
        }
        ?>
    });
</script>
