<form class="form-horizontal bordered-row co-main-form">
    <input type="hidden" name="file" value="<?php echo $module ?>" />
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Tuỳ chọn hiển thị các trường dữ liệu</h4>
    </div>
    <div class="modal-body" style="padding: 0;">
        <ul class="nav nav-tabs" id="tab-options" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" data-cols="module-col" id="information-tab" data-toggle="tab" data-target="#information" type="button" role="tab" aria-controls="information" aria-selected="true">Information</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" data-cols="module-col-line1" id="line1-tab" data-toggle="tab" data-target="#line1" type="button" role="tab" aria-controls="line1" aria-selected="false">Line 1</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" data-cols="module-col-line2" id="line2-tab" data-toggle="tab" data-target="#line2" type="button" role="tab" aria-controls="line2" aria-selected="false">Line 2</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane pd10 show active" id="information" role="tabpanel" aria-labelledby="information-tab">
                <table id="mainTable-module-col" class="table table-hover" cellpadding="0" cellspacing="0" width="100%" border="0">
                    <thead>
                        <tr class="nodrop">
                            <th width="15%">Database field name</th>
                            <th width="15%">Display name</th>
                            <th width="5%" class="text-center" nowrap="nowrap"><label><input id="checkall-show" type="checkbox" style="display: none" />Show</label></th>
                            <th width="5%" class="center" nowrap="nowrap">Required</th>
                            <th width="5%" class="text-center" nowrap="nowrap"><label>Lock</label></th>
                            <th width="5%" style="min-width: 110px; max-width: 110px;" nowrap="nowrap">Header Class</th>
                            <th width="5%">Align</th>
                            <th width="5%" nowrap="nowrap" class="link_module" style="width: 90px;">
                                Web Width
                                <a href="<?=admin_url("admin/option_items_keynum/update/109")?>" target="_blank">
                                    <i class="fa fa-link"></i>
                                </a>
                            </th>
                            <th width="5%" nowrap="nowrap">Excel width</th>
                            <th width="5%" nowrap="nowrap">Format/Default Value</th>
                            <th width="5%" class="text-center" nowrap="nowrap"><label><input id="checkall-link" type="checkbox" style="display: none" />Edit link</label></th>
                            <th width="5%" class="text-center" nowrap="nowrap"><label><input id="checkall-sort" type="checkbox" style="display: none" />Sort</label></th>
                            <th width="5%" class="text-center" nowrap="nowrap"><label><input id="checkall-nowrap" type="checkbox" style="display: none" />Nowrap</label></th>
                            <th width="5%" nowrap="nowrap" class="link_module">
                                Display type
                                <a href="<?=admin_url("admin/option_items_keynum/update/107")?>" target="_blank">
                                    <i class="fa fa-link"></i>
                                </a>
                            </th>
                            <th width="5%" nowrap="nowrap" class="link_module" style="width: 90px;">
                                Mask
                                <?php
                                    $displayMask = get_data('option_items_keynum', "Field = 'displaymask' and deleted=0", "*");
                                ?>
                                <a href="<?=admin_url("option_items_keynum/update/".$displayMask->id)?>" target="_blank">
                                    <i class="fa fa-link"></i>
                                </a>
                            </th>
                            <?php if (isAdmin() || true) : ?>
                                <th class="center" width="1%">&nbsp;</th>
                            <?php endif ?>
                        </tr>
                    </thead>
                    <?php
                    $keys = array_keys((array)$cols_info);
                    $appends = [];
                    if (!empty($fields)) {
                    foreach ($fields as $key => $col) {
                        if (!in_array($key, $keys)) {
                            $appends[$key] = (object)$col;
                            }
                        }
                    }
                    $cols_info = (object)array_merge((array)$cols_info, $appends);
                    foreach ($cols_info as $key => $col) {
                        if (!in_array($key, array('deleted', 'SortOrder')) && isset($fields->{$key}->name)) {
                            $name = $fields->{$key}->name ? $fields->{$key}->name : $key;
                            if (empty($col->detail)) {
                                $col->detail = false;
                            }
                    ?>
                            <tr class="highlight" data-key="<?= $key ?>">
                                <td>
                                    <?php echo $name ?>
                                    <input type="hidden" name="column_info_options[<?php echo $key ?>][detail]" value="<?php echo ($col->detail ? 1 : 0) ?>" />
                                </td>
                                <td><input type="text" name="column_info_options[<?php echo $key ?>][name]" value="<?php echo (isset($col->name) ? $col->name : $name) ?>" class="form-control"></td>
                                <td class="text-center"><input type="checkbox" name="column_info_options[<?php echo $key ?>][show]" value="1" class="field-show" <?php echo (isset($col->show) && $col->show && !in_array($key, array_keys($appends)) && !$col->detail ? ' checked' : '') . ($col->detail ? ' style="display: none;" disabled' : '') ?>></td>
                                <td class="center">
                                    <input type="checkbox" name="column_info_options[<?= $key ?>][required]" value="1" <?= (isset($col->required) && ($col->required) ? ' checked' : '') ?> />
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="column_info_options[<?php echo $key ?>][lock]" value="1" class="field-show" <?php echo (isset($col->lock) && $col->lock && !in_array($key, array_keys($appends)) && !$col->detail ? ' checked' : '') . ($col->detail ? ' style="display: none;" disabled' : '') ?>></td>
                                <td><input type="text" name="column_info_options[<?php echo $key ?>][header_class]" value="<?php echo (isset($col->header_class) ? $col->header_class : '') ?>" <?php echo ($col->detail ? ' style="display: none;"' : '') ?> class="form-control"></td>
                                <td>
                                    <select name="column_info_options[<?php echo $key ?>][align]" class="form-control">
                                        <option value="left" <?php echo (isset($col->align) && $col->align == 'left' ? ' selected="seleted"' : '') ?>>Left</option>
                                        <option value="center" <?php echo (isset($col->align) && $col->align == 'center' ? ' selected="seleted"' : '') ?>>Center</option>
                                        <option value="right" <?php echo (isset($col->align) && $col->align == 'right' ? ' selected="seleted"' : '') ?>>Right</option>
                                    </select>
                                </td>
                                <td class="text-center" style="width: 90px;">
                                    <!-- <input type="text" name="column_info_options[<?php echo $key ?>][width]" value="<?php echo (isset($col->width) ? $col->width : 100 . 'px') ?>" class="form-control" /> -->
                                    <?= get_options_keynum('DisplayWidth', @$col->width, 'class="form-control"', 'column_info_options[' . $key . '][width]', true); ?>
                                </td>
                                <td class="text-center"><input type="text" name="column_info_options[<?php echo $key ?>][excel_width]" value="<?php echo (isset($col->excel_width) ? $col->excel_width : 20) ?>" <?php echo ($col->detail ? ' style="display: none;"' : '') ?> class="form-control" /></td>
                                <td class="text-center"><input type="text" name="column_info_options[<?php echo $key ?>][format]" value="<?php echo (isset($col->format) ? $col->format : '') ?>" class="form-control" /></td>
                                <td class="text-center"><input type="checkbox" name="column_info_options[<?php echo $key ?>][link]" value="1" <?php echo (isset($col->link) ? ' checked' : '') . ($col->detail ? ' style="display: none;" disabled' : '') ?> class="field-link"></td>
                                <td class="text-center"><input type="checkbox" name="column_info_options[<?php echo $key ?>][sort]" value="1" <?php echo (isset($col->sort) ? ' checked' : '') ?> class="field-sort"></td>
                                <td class="text-center"><input type="checkbox" name="column_info_options[<?php echo $key ?>][nowrap]" value="1" <?php echo (isset($col->nowrap) ? ' checked' : '') ?> class="field-nowrap"></td>
                                <td>
                                    <?= get_options_keynum('DisplayType', $col->type, 'class="form-control display-type"', 'column_info_options[' . $key . '][type]', true); ?>
                                </td>
                                <td>
                                    <?= get_options_keynum('DisplayMask', !empty($col->mask) ? $col->mask : '', 'class="form-control"', 'column_info_options[' . $key . '][mask]', true); ?>
                                </td>
                                <?php if (isAdmin() || true) : ?>
                                    <td data-name="column_info_options" data-column="<?= $key ?>" class="part-setting font-blue <?= (in_array($col->type, ['color', 'field_by_id']) ? '' : 'hidden') ?>" style="width: 120px;">
                                        <i class="fa fa-cogs" aria-hidden="true"></i>
                                        <?php if (!empty($col->setting)) : ?>
                                            <input type="hidden" name="column_info_options[<?= $key ?>][setting]" value='<?= $col->setting ?>' />
                                        <?php endif ?>
                                    </td>
                                <?php endif ?>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </table>
            </div>
            <div class="tab-pane pd10 fade" id="line1" role="tabpanel" aria-labelledby="line1-tab">

            </div>
            <div class="tab-pane pd10 fade" id="line2" role="tabpanel" aria-labelledby="line2-tab">

            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-alt btn-border border-primary btn-hover font-primary"><span>Thực hiện</span><i class="glyph-icon icon-save"></i></button>
        <div class="btn btn-alt btn-border border-red btn-hover font-red" data-dismiss="modal"><span>Hủy bỏ</span><i class="glyph-icon icon-arrow-left"></i></div>
    </div>
</form>
