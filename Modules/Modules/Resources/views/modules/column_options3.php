<?php
$arr_colsize = $this->db->query("SELECT * FROM po_cpo_close_colsize")->result_array();
$css_colsize = array();
foreach($arr_colsize as $val) {
    $css_colsize[$val['col_name']] = $val['col_size'];
}
?>

<style>
#co2_nav_tab {
    position: absolute;
    left: 5px;
    bottom: 0;
}
.modal-header {
    height: 65px;
}
.modal-body {
    margin-top: 23px;
}
#co2_nav_tab li.active a, #co2_nav_tab li a:hover {
    background-color: #ffffff;
    color: #444444;
}
#co2_nav_tab li a {
    color: #ffffff;
}

/* css purchase order tab */
#co2_tab2 .m-tbl-rows {
    /* margin-left: -15px;
    margin-right: -15px; */
}
#co2_tab2 .m-tbl-rows .m-stt-col {
    width: 50px;
    /* padding-left: 30px; */
}
#co2_tab2 .m-tbl-rows .m-name-col {
    width: 150px;
    /* padding-left: 30px; */
}
#co2_tab2 .m-tbl-rows .m-size-col {
    /* padding-right: 30px; */
}
</style>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">Tuỳ chọn hiển thị các trường dữ liệu</h4>

    <ul id="co2_nav_tab" class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#co2_tab1">Customer PO</a></li>
        <li><a data-toggle="tab" href="#co2_tab2">Purchase Order</a></li>
    </ul>
</div>

<div class="tab-content">
    <div id="co2_tab1" class="tab-pane fade in active">

        <form class="form-horizontal bordered-row co-main-form">
        <input type="hidden" name="file" value="<?php echo $module ?>"/>
        <div class="modal-body" style="padding: 0;">

            <table id="mainTable-module-col" class="table table-hover tab-pane fade in active" cellpadding="0" cellspacing="0" width="100%" border="0">
                <thead>
                <tr class="nodrop">
                    <th width="15%">Database field name</th>
                    <th width="20%">Display name</th>
                    <th width="5%" class="center" nowrap="nowrap"><label><input id="checkall-show" type="checkbox" style="display: none"/>Show</label></th>
                    <th width="5%" class="center" nowrap="nowrap">Show on search</th>
                    <th width="5%" style="min-width: 110px; max-width: 110px;" nowrap="nowrap">Header Class</th>
                    <th width="5%">Align</th>
                    <th width="5%" nowrap="nowrap">Web Width</th>
                    <th width="5%" nowrap="nowrap">Excel width</th>
                    <th width="5%" nowrap="nowrap">Format number</th>
                    <th width="5%" class="center" nowrap="nowrap"><label><input id="checkall-link" type="checkbox" style="display: none"/>Edit link</label></th>
                    <th width="5%" class="center" nowrap="nowrap"><label><input id="checkall-sort" type="checkbox" style="display: none"/>Sort</label></th>
                    <th width="5%" class="center" nowrap="nowrap"><label><input id="checkall-nowrap" type="checkbox" style="display: none"/>Nowrap</label></th>
                    <th width="5%" style="min-width: 92px; max-width: 92px;" nowrap="nowrap">Display type</th>
                    <th width="5%" style="min-width: 92px; max-width: 92px;" nowrap="nowrap">Display filter</th>
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
                        <tr class="highlight">
                            <td>
                                <?php echo $name ?>
                                <input type="hidden" name="column_options[<?php echo $key ?>][detail]" value="<?php echo ($col->detail ? 1 : 0) ?>"/>
                            </td>
                            <td><input type="text" name="column_options[<?php echo $key ?>][name]" value="<?php echo (isset($col->name) ? $col->name : $name) ?>" class="form-control"></td>
                            <td class="center"><input type="checkbox" name="column_options[<?php echo $key ?>][show]" value="1" class="field-show"<?php echo (isset($col->show) && $col->show && !in_array($key, array_keys($appends)) && !$col->detail ? ' checked' : '') . ($col->detail ? ' style="display: none;" disabled' : '') ?>></td>
                            <td class="center"><input type="checkbox" name="column_options[<?php echo $key ?>][search_show]" value="1"<?php echo (isset($col->search_show) ? ' checked' : '') ?>></td>
                            <td><input type="text" name="column_options[<?php echo $key ?>][header_class]" value="<?php echo (isset($col->header_class) ? $col->header_class : '') ?>"<?php echo ($col->detail ? ' style="display: none;"' : '') ?> class="form-control"></td>
                            <td>
                                <select name="column_options[<?php echo $key ?>][align]" class="form-control">
                                    <option value="left"<?php echo (isset($col->align) && $col->align == 'left' ? ' selected="seleted"' : '') ?>>Left</option>
                                    <option value="center"<?php echo (isset($col->align) && $col->align == 'center' ? ' selected="seleted"' : '') ?>>Center</option>
                                    <option value="right"<?php echo (isset($col->align) && $col->align == 'right' ? ' selected="seleted"' : '') ?>>Right</option>
                                </select>
                            </td>
                            <td class="center"><input type="text" name="column_options[<?php echo $key ?>][width]" value="<?php echo (isset($col->width) ? $col->width : 100 . 'px') ?>" class="form-control"/></td>
                            <td class="center"><input type="text" name="column_options[<?php echo $key ?>][excel_width]" value="<?php echo (isset($col->excel_width) ? $col->excel_width : 20) ?>"<?php echo ($col->detail ? ' style="display: none;"' : '') ?> class="form-control"/></td>
                            <td class="center"><input type="text" name="column_options[<?php echo $key ?>][format]" value="<?php echo (isset($col->format) ? $col->format : '') ?>" class="form-control"/></td>
                            <td class="center"><input type="checkbox" name="column_options[<?php echo $key ?>][link]" value="1"<?php echo (isset($col->link) ? ' checked' : '') . ($col->detail ? ' style="display: none;" disabled' : '') ?> class="field-link"></td>
                            <td class="center"><input type="checkbox" name="column_options[<?php echo $key ?>][sort]" value="1"<?php echo (isset($col->sort) ? ' checked' : '') ?> class="field-sort"></td>
                            <td class="center"><input type="checkbox" name="column_options[<?php echo $key ?>][nowrap]" value="1"<?php echo (isset($col->nowrap) ? ' checked' : '') ?> class="field-nowrap"></td>
                            <td>
                                <select name="column_options[<?php echo $key ?>][type]" class="form-control">
                                    <option value="text"<?php echo (isset($col->type) && $col->type == 'text' ? ' selected="seleted"' : '') ?>>Text</option>
                                    <option value="text_input"<?php echo (isset($col->type) && $col->type == 'text_input' ? ' selected="seleted"' : '') ?>>Text input</option>
                                    <option value="check"<?php echo (isset($col->type) && $col->type == 'check' ? ' selected="seleted"' : '') ?>>Check</option>
                                    <option value="check_edit"<?php echo (isset($col->type) && $col->type == 'check_edit' ? ' selected="seleted"' : '') ?>>Check edit</option>
                                    <option value="image"<?php echo (isset($col->type) && $col->type == 'image' ? ' selected="seleted"' : '') ?>>Image</option>
                                    <option value="color"<?php echo (isset($col->type) && $col->type == 'color' ? ' selected="seleted"' : '') ?>>Color</option>
                                </select>
                            </td>
                            <td>
                                <select name="column_options[<?php echo $key ?>][filter]" class="form-control">
                                    <option value=""<?php echo (isset($col->filter) && $col->filter == '' ? ' selected="seleted"' : '') ?>>None</option>
                                    <option value="text"<?php echo (isset($col->filter) && $col->filter == 'text' ? ' selected="seleted"' : '') ?>>Text</option>
                                    <option value="date"<?php echo (isset($col->filter) && $col->filter == 'date' ? ' selected="seleted"' : '') ?>>Date</option>
                                    <option value="date_range"<?php echo (isset($col->filter) && $col->filter == 'date_range' ? ' selected="seleted"' : '') ?>>Date Range</option>
                                    <option value="select"<?php echo (isset($col->filter) && $col->filter == 'select' ? ' selected="seleted"' : '') ?>>Select</option>
                                </select>
                            </td>
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
    </div>

    <div id="co2_tab2" class="tab-pane fade in">
        
        <form class="form-horizontal bordered-row co-second-form">
        <input type="hidden" name="file" value="<?php echo $module ?>_2"/>
        <div class="modal-body" style="padding: 0;">

        <table id="mainTable-module-col2" class="table table-hover tab-pane fade in active" cellpadding="0" cellspacing="0" width="100%" border="0">
                <thead>
                <tr class="nodrop">
                    <th width="15%">Database field name</th>
                    <th width="20%">Display name</th>
                    <th width="5%" class="center" nowrap="nowrap"><label><input id="checkall-show" type="checkbox" style="display: none"/>Show</label></th>
                    <th width="5%" class="center" nowrap="nowrap">Show on search</th>
                    <th width="5%" style="min-width: 110px; max-width: 110px;" nowrap="nowrap">Header Class</th>
                    <th width="5%">Align</th>
                    <th width="5%" nowrap="nowrap">Web Width</th>
                    <th width="5%" nowrap="nowrap">Excel width</th>
                    <th width="5%" nowrap="nowrap">Format number</th>
                    <th width="5%" class="center" nowrap="nowrap"><label><input id="checkall-link" type="checkbox" style="display: none"/>Edit link</label></th>
                    <th width="5%" class="center" nowrap="nowrap"><label><input id="checkall-sort" type="checkbox" style="display: none"/>Sort</label></th>
                    <th width="5%" class="center" nowrap="nowrap"><label><input id="checkall-nowrap" type="checkbox" style="display: none"/>Nowrap</label></th>
                    <th width="5%" style="min-width: 92px; max-width: 92px;" nowrap="nowrap">Display type</th>
                    <th width="5%" style="min-width: 92px; max-width: 92px;" nowrap="nowrap">Display filter</th>
                </tr>
                </thead>
                <?php
                $keys = array_keys((array)$cols2);
                $appends = array();
                foreach ($fields2 as $key => $col) {
                    if (!in_array($key, $keys)) {
                        $appends[$key] = (object)$col;
                    }
                }
                $cols2 = (object)array_merge((array)$cols2, $appends);
                foreach ($cols2 as $key => $col) {
                    if (!in_array($key, array('deleted', 'SortOrder')) && isset($fields2->{$key}->name)) {
                        $name = $fields2->{$key}->name ? $fields2->{$key}->name : $key;
                        if (empty($col->detail)) {
                            $col->detail = false;
                        }
                        ?>
                        <tr class="highlight">
                            <td>
                                <?php echo $name ?>
                                <input type="hidden" name="column_options[<?php echo $key ?>][detail]" value="<?php echo ($col->detail ? 1 : 0) ?>"/>
                            </td>
                            <td><input type="text" name="column_options[<?php echo $key ?>][name]" value="<?php echo (isset($col->name) ? $col->name : $name) ?>" class="form-control"></td>
                            <td class="center"><input type="checkbox" name="column_options[<?php echo $key ?>][show]" value="1" class="field-show"<?php echo (isset($col->show) && $col->show && !in_array($key, array_keys($appends)) && !$col->detail ? ' checked' : '') . ($col->detail ? ' style="display: none;" disabled' : '') ?>></td>
                            <td class="center"><input type="checkbox" name="column_options[<?php echo $key ?>][search_show]" value="1"<?php echo (isset($col->search_show) ? ' checked' : '') ?>></td>
                            <td><input type="text" name="column_options[<?php echo $key ?>][header_class]" value="<?php echo (isset($col->header_class) ? $col->header_class : '') ?>"<?php echo ($col->detail ? ' style="display: none;"' : '') ?> class="form-control"></td>
                            <td>
                                <select name="column_options[<?php echo $key ?>][align]" class="form-control">
                                    <option value="left"<?php echo (isset($col->align) && $col->align == 'left' ? ' selected="seleted"' : '') ?>>Left</option>
                                    <option value="center"<?php echo (isset($col->align) && $col->align == 'center' ? ' selected="seleted"' : '') ?>>Center</option>
                                    <option value="right"<?php echo (isset($col->align) && $col->align == 'right' ? ' selected="seleted"' : '') ?>>Right</option>
                                </select>
                            </td>
                            <td class="center"><input type="text" name="column_options[<?php echo $key ?>][width]" value="<?php echo (isset($col->width) ? $col->width : 100 . 'px') ?>" class="form-control"/></td>
                            <td class="center"><input type="text" name="column_options[<?php echo $key ?>][excel_width]" value="<?php echo (isset($col->excel_width) ? $col->excel_width : 20) ?>"<?php echo ($col->detail ? ' style="display: none;"' : '') ?> class="form-control"/></td>
                            <td class="center"><input type="text" name="column_options[<?php echo $key ?>][format]" value="<?php echo (isset($col->format) ? $col->format : '') ?>" class="form-control"/></td>
                            <td class="center"><input type="checkbox" name="column_options[<?php echo $key ?>][link]" value="1"<?php echo (isset($col->link) ? ' checked' : '') . ($col->detail ? ' style="display: none;" disabled' : '') ?> class="field-link"></td>
                            <td class="center"><input type="checkbox" name="column_options[<?php echo $key ?>][sort]" value="1"<?php echo (isset($col->sort) ? ' checked' : '') ?> class="field-sort"></td>
                            <td class="center"><input type="checkbox" name="column_options[<?php echo $key ?>][nowrap]" value="1"<?php echo (isset($col->nowrap) ? ' checked' : '') ?> class="field-nowrap"></td>
                            <td>
                                <select name="column_options[<?php echo $key ?>][type]" class="form-control">
                                    <option value="text"<?php echo (isset($col->type) && $col->type == 'text' ? ' selected="seleted"' : '') ?>>Text</option>
                                    <option value="text_input"<?php echo (isset($col->type) && $col->type == 'text_input' ? ' selected="seleted"' : '') ?>>Text input</option>
                                    <option value="check"<?php echo (isset($col->type) && $col->type == 'check' ? ' selected="seleted"' : '') ?>>Check</option>
                                    <option value="check_edit"<?php echo (isset($col->type) && $col->type == 'check_edit' ? ' selected="seleted"' : '') ?>>Check edit</option>
                                    <option value="image"<?php echo (isset($col->type) && $col->type == 'image' ? ' selected="seleted"' : '') ?>>Image</option>
                                    <option value="color"<?php echo (isset($col->type) && $col->type == 'color' ? ' selected="seleted"' : '') ?>>Color</option>
                                </select>
                            </td>
                            <td>
                                <select name="column_options[<?php echo $key ?>][filter]" class="form-control">
                                    <option value=""<?php echo (isset($col->filter) && $col->filter == '' ? ' selected="seleted"' : '') ?>>None</option>
                                    <option value="text"<?php echo (isset($col->filter) && $col->filter == 'text' ? ' selected="seleted"' : '') ?>>Text</option>
                                    <option value="date"<?php echo (isset($col->filter) && $col->filter == 'date' ? ' selected="seleted"' : '') ?>>Date</option>
                                    <option value="date_range"<?php echo (isset($col->filter) && $col->filter == 'date_range' ? ' selected="seleted"' : '') ?>>Date Range</option>
                                    <option value="select"<?php echo (isset($col->filter) && $col->filter == 'select' ? ' selected="seleted"' : '') ?>>Select</option>
                                </select>
                            </td>
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

    </div>

</div>