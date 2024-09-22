<form class="form-horizontal bordered-row co-main-form">
    <input type="hidden" name="file" value="<?php echo $module->file ?>" />
    <div class="modal-header link_module left">
        <h4 class="modal-title fs-4 pl-2">Tuỳ chọn hiển thị các trường dữ liệu</h4>
        <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">×</button>
        <a href="<?=admin_url("modules/update/".@$module->id)?>" target="_blank">
            <i class="fa fa-link"></i>
        </a>
        <ul id="module-tab">
            <li data-group="group-1">Default</li>
            <li data-group="group-2">Tab Group</li>
        </ul>
    </div>
    <div class="modal-body" style="padding: 0;">
        <table id="mainTable-module-col" class="table table-hover table_sticky group-1" cellpadding="0" cellspacing="0" width="100%" border="0">
            <thead>
                <tr class="nodrop">
                    <th width="15%">Database field name</th>
                    <th>Display name</th>
                    <th width="3%" class="center" nowrap="nowrap"  style="width: 100px;max-width:100px;"><label><input id="checkall-show" type="checkbox" style="display: none" />Show</label></th>
                    <th class="center" nowrap="nowrap" style="width: 100px;max-width:100px;white-space: pre-wrap;">Show on search</th>
                    <th width="5%" style="min-width: 110px; max-width: 110px;" nowrap="nowrap" class="group-1">Header Class</th>
                    <th width="5%" class="group-1">Align</th>
                    <th width="5%" nowrap="nowrap" class="group-1">Web Width</th>
                    <th width="5%" nowrap="nowrap" class="group-1">Excel width</th>
                    <th width="5%" nowrap="nowrap" class="group-2">Tab Group</th>
                    <th width="5%" nowrap="nowrap">Format/Default Value</th>
                    <th width="4%" class="center" nowrap="nowrap"><label><input id="checkall-link" type="checkbox" style="display: none" />Edit link</label></th>
                    <th width="4%" class="center" nowrap="nowrap"><label><input id="checkall-sort" type="checkbox" style="display: none" />Sort</label></th>
                    <th width="4%" class="center" nowrap="nowrap"><label><input id="checkall-nowrap" type="checkbox" style="display: none" />Nowrap</label></th>
                    <th width="9%" style="min-width: 92px; max-width: 92px;" nowrap="nowrap" class="link_module">
                        Display type
                        <?php
                            $opt = get_data('option_items_keynum', "Field = 'DisplayType' and deleted=0","*");
                        ?>
                        <a href="<?=admin_url("option_items_keynum/update/".@$opt->id)?>" target="_blank">
                            <i class="fa fa-link"></i>
                        </a>
                    </th>
                    <th width="9%" style="min-width: 120px; max-width: 120px;" nowrap="nowrap" class="link_module">
                        Display filter
                        <?php
                            $opt = get_data('option_items_keynum', "Field = 'DisplayFilter' and deleted=0","*");
                        ?>
                        <a href="<?=admin_url("option_items_keynum/update/".@$opt->id)?>" target="_blank">
                            <i class="fa fa-link"></i>
                        </a>
                    </th>
                    <?php if (isAdmin()||true) : ?>
                        <th class="center" width="1%">&nbsp;</th>
                    <?php endif ?>
                </tr>
            </thead>
            <?php
            $keys = array_keys((array)$cols);
            $appends = array();
            foreach ($fields as $key => $col) {
                if (!in_array($key, $keys)) {
                    $appends[$key] = (object)$col;
                }
            }
            $cols = (object)array_merge((array)$cols, $appends);
            foreach ($cols as $key => $col) {
                if (!in_array($key, array('deleted', 'SortOrder')) && isset($fields->{$key}->name)) {
                    $name = $fields->{$key}->name ? $fields->{$key}->name : $key;
                    if (empty($col->detail)) {
                        $col->detail = false;
                    }
            ?>
                    <tr class="highlight" data-key="<?= $key ?>">
                        <td>
                            <?php echo $name ?>
                            <input type="hidden" name="column_options[<?php echo $key ?>][detail]" value="<?php echo ($col->detail ? 1 : 0) ?>" />
                        </td>
                        <td><input type="text" name="column_options[<?php echo $key ?>][name]" value="<?php echo (isset($col->name) ? $col->name : $name) ?>" class="form-control"></td>
                        <td class="center"><input type="checkbox" name="column_options[<?php echo $key ?>][show]" value="1" class="field-show" <?php echo (isset($col->show) && $col->show && !in_array($key, array_keys($appends)) && !$col->detail ? ' checked' : '') . ($col->detail ? ' style="display: none;" disabled' : '') ?>></td>
                        <td class="center"><input type="checkbox" name="column_options[<?php echo $key ?>][search_show]" value="1" <?php echo (isset($col->search_show) && ($col->search_show) ? ' checked' : '') ?>></td>
                        <td class="group-1"><input type="text" name="column_options[<?php echo $key ?>][header_class]" value="<?php echo (isset($col->header_class) ? $col->header_class : '') ?>" <?php echo ($col->detail ? ' style="display: none;"' : '') ?> class="form-control"></td>
                        <td class="group-1">
                            <select name="column_options[<?php echo $key ?>][align]" class="form-control">
                                <option value="left" <?php echo (isset($col->align) && $col->align == 'left' ? ' selected="seleted"' : '') ?>>Left</option>
                                <option value="center" <?php echo (isset($col->align) && $col->align == 'center' ? ' selected="seleted"' : '') ?>>Center</option>
                                <option value="right" <?php echo (isset($col->align) && $col->align == 'right' ? ' selected="seleted"' : '') ?>>Right</option>
                            </select>
                        </td>
                        <td class="center group-1"><input type="text" name="column_options[<?php echo $key ?>][width]" value="<?php echo (isset($col->width) ? $col->width : 100 . 'px') ?>" class="form-control" /></td>
                        <td class="center group-1"><input type="text" name="column_options[<?php echo $key ?>][excel_width]" value="<?php echo (isset($col->excel_width) ? $col->excel_width : 20) ?>" <?php echo ($col->detail ? ' style="display: none;"' : '') ?> class="form-control" /></td>
                        <td class="center group-2">
                            <select name="column_options[<?php echo $key ?>][tab_group]" class="form-control">
                                <option>Default</option>
                                <option value="group-1" <?php echo (isset($col->tab_group) && $col->tab_group == 'group-1' ? ' selected="seleted"' : '') ?>>Group 1</option>
                                <option value="group-2" <?php echo (isset($col->tab_group) && $col->tab_group == 'group-2' ? ' selected="seleted"' : '') ?>>Group 2</option>
                            </select>
                        </td>
                        <td class="center"><input type="text" name="column_options[<?php echo $key ?>][format]" value="<?php echo (isset($col->format) ? $col->format : '') ?>" class="form-control" /></td>
                        <td class="center"><input type="checkbox" name="column_options[<?php echo $key ?>][link]" value="1" <?php echo (isset($col->link) ? ' checked' : '') . ($col->detail ? ' style="display: none;" disabled' : '') ?> class="field-link"></td>
                        <td class="center"><input type="checkbox" name="column_options[<?php echo $key ?>][sort]" value="1" <?php echo (isset($col->sort) ? ' checked' : '') ?> class="field-sort"></td>
                        <td class="center"><input type="checkbox" name="column_options[<?php echo $key ?>][nowrap]" value="1" <?php echo (isset($col->nowrap) ? ' checked' : '') ?> class="field-nowrap"></td>
                        <td>
                            <?= get_options_keynum('DisplayType', $col->type, 'class="form-control display-type"', 'column_options[' . $key . '][type]', true); ?>
                        </td>
                        <td>
                            <?= get_options_keynum('DisplayFilter', $col->filter, 'class="form-control display-filter"', 'column_options[' . $key . '][filter]', true); ?>
                        </td>
                        <?php if (isAdmin()||true) : ?>
                            <!-- <td data-column="<?= $key ?>" class="part-setting font-blue <?= (in_array($col->type, ['color', 'field_by_id']) ? '' : 'hidden') ?>">
                                <i class="fa fa-cogs" aria-hidden="true"></i>
                                <?php if(!empty($col->setting)) : ?>
                                <input type="hidden" name="column_options[<?= $key ?>][setting]" value='<?= $col->setting ?>' />
                                <?php endif ?>
                            </td> -->
                            <td data-name="column_options" data-column="<?= $key ?>" class="part-setting font-blue <?= !empty(@$col->setting) ? '' : 'hidden' ?>">
                                <i class="fa fa-cogs" aria-hidden="true"></i>
                                <input type="hidden" name="column_options[<?= $key ?>][setting]" value='<?= @$col->setting ?>' />
                            </td>
                        <?php endif ?>
                    </tr>
            <?php
                }
            }
            ?>
        </table>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-alt btn-border border-primary btn-hover font-primary"><span>Thực hiện</span><i class="glyph-icon icon-save"></i></button>
        <div class="btn btn-alt btn-border border-red btn-hover font-red" data-dismiss="modal"><span>Hủy bỏ</span><i class="glyph-icon icon-arrow-left"></i></div>
    </div>
</form>
<!-- <script src="http://hhcargo.info/public/themes/admin/js/jquery.dataTables.min.js"></script>
<script src="http://hhcargo.info/public/plugin/tablednd/jquery.tablednd.min.js"></script> -->
<script src="<?=asset("")?>/plugin/tablednd/jquery.tablednd.min.js"></script>
<!-- <script src="<?=asset("")?>/public/modules/dist/script.js"></script> -->
