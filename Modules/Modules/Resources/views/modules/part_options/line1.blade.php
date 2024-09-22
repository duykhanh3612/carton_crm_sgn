<table id="mainTable-module-col-line1" class="table table-hover" cellpadding="0" cellspacing="0" width="100%" border="0">
    <thead>
        <tr class="nodrop">
            <th width="15%">Database field name</th>
            <th width="15%">Display name</th>
            <th width="5%" class="text-center" nowrap="nowrap"><label><input id="checkall-show" type="checkbox" style="display: none" />Show</label></th>
            <th width="5%" style="min-width: 110px; max-width: 110px;" nowrap="nowrap">Header Class</th>
            <th width="5%">Align</th>
            <th width="5%" nowrap="nowrap">Web Width</th>
            <th width="5%" nowrap="nowrap">Excel width</th>
            <th width="5%" nowrap="nowrap">Format/Default Value</th>
            <th width="5%" class="text-center" nowrap="nowrap"><label><input id="checkall-link" type="checkbox" style="display: none" />Edit link</label></th>
            <th width="5%" class="text-center" nowrap="nowrap"><label><input id="checkall-sort" type="checkbox" style="display: none" />Sort</label></th>
            <th width="5%" class="text-center" nowrap="nowrap"><label><input id="checkall-nowrap" type="checkbox" style="display: none" />Nowrap</label></th>
            <th width="5%" nowrap="nowrap">Display type</th>
        </tr>
    </thead>
    <?php
    $cols_part_line1 = !empty($cols_part->line1) ? (array)$cols_part->line1 : [];
    $keys = !empty($cols_part_line1) ? array_keys($cols_part_line1) : [];
    $appends = [];
    if (!empty($fields)) {
    foreach ($fields as $key => $col) {
        if (!in_array($key, $keys)) {
            $appends[$key] = (object)$col;
            }
        }
    }
    $cols_part_line1 = (object)array_merge($cols_part_line1, $appends);
    foreach ($cols_part_line1 as $key => $col) {
        if (!in_array($key, array('deleted', 'SortOrder')) && isset($fields->{$key}->name)) {
            $name = $fields->{$key}->name ? $fields->{$key}->name : $key;
            if (empty($col->detail)) {
                $col->detail = false;
            }
    ?>
            <tr class="highlight" data-key="<?= $key ?>">
                <td>
                    <?php echo $name ?>
                    <input type="hidden" name="column_part_options[line1][<?php echo $key ?>][detail]" value="<?php echo ($col->detail ? 1 : 0) ?>" />
                </td>
                <td><input type="text" name="column_part_options[line1][<?php echo $key ?>][name]" value="<?php echo (isset($col->name) ? $col->name : $name) ?>" class="form-control"></td>
                <td class="text-center"><input type="checkbox" name="column_part_options[line1][<?php echo $key ?>][show]" value="1" class="field-show" <?php echo (isset($col->show) && $col->show && !in_array($key, array_keys($appends)) && !$col->detail ? ' checked' : '') . ($col->detail ? ' style="display: none;" disabled' : '') ?>></td>
                <td><input type="text" name="column_part_options[line1][<?php echo $key ?>][header_class]" value="<?php echo (isset($col->header_class) ? $col->header_class : '') ?>" <?php echo ($col->detail ? ' style="display: none;"' : '') ?> class="form-control"></td>
                <td>
                    <select name="column_part_options[line1][<?php echo $key ?>][align]" class="form-control">
                        <option value="left" <?php echo (isset($col->align) && $col->align == 'left' ? ' selected="seleted"' : '') ?>>Left</option>
                        <option value="center" <?php echo (isset($col->align) && $col->align == 'center' ? ' selected="seleted"' : '') ?>>Center</option>
                        <option value="right" <?php echo (isset($col->align) && $col->align == 'right' ? ' selected="seleted"' : '') ?>>Right</option>
                    </select>
                </td>
                <td class="text-center"><input type="text" name="column_part_options[line1][<?php echo $key ?>][width]" value="<?php echo (isset($col->width) ? $col->width : 100 . 'px') ?>" class="form-control" /></td>
                <td class="text-center"><input type="text" name="column_part_options[line1][<?php echo $key ?>][excel_width]" value="<?php echo (isset($col->excel_width) ? $col->excel_width : 20) ?>" <?php echo ($col->detail ? ' style="display: none;"' : '') ?> class="form-control" /></td>
                <td class="text-center"><input type="text" name="column_part_options[line1][<?php echo $key ?>][format]" value="<?php echo (isset($col->format) ? $col->format : '') ?>" class="form-control" /></td>
                <td class="text-center"><input type="checkbox" name="column_part_options[line1][<?php echo $key ?>][link]" value="1" <?php echo (isset($col->link) ? ' checked' : '') . ($col->detail ? ' style="display: none;" disabled' : '') ?> class="field-link"></td>
                <td class="text-center"><input type="checkbox" name="column_part_options[line1][<?php echo $key ?>][sort]" value="1" <?php echo (isset($col->sort) ? ' checked' : '') ?> class="field-sort"></td>
                <td class="text-center"><input type="checkbox" name="column_part_options[line1][<?php echo $key ?>][nowrap]" value="1" <?php echo (isset($col->nowrap) ? ' checked' : '') ?> class="field-nowrap"></td>
                <td>
                    <?= get_options_keynum('DisplayType', $col->type, 'class="form-control display-type"', 'column_part_options[line1][' . $key . '][type]', true); ?>
                </td>
                <?php if (isAdmin()) : ?>
                    <td data-name="column_part_options[line1]" data-column="<?= $key ?>" class="part-setting font-blue <?= (in_array($col->type, ['color', 'field_by_id']) ? '' : 'hidden') ?>">
                        <i class="fa fa-cogs" aria-hidden="true"></i>
                        <?php if (!empty($col->setting)) : ?>
                            <input type="hidden" name="column_part_options[line1][<?= $key ?>][setting]" value='<?= $col->setting ?>' />
                        <?php endif ?>
                    </td>
                <?php endif ?>
            </tr>
    <?php
        }
    }
    ?>
</table>