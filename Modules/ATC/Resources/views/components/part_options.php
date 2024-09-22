<section id="option_display">
    <div class="modal-header">
        <h4 class="modal-title">Tuỳ chọn hiển thị các trường dữ liệu</h4>
        <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">×</button>
        <ul  class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#co2_tab1">Line 1</a></li>
            <li><a data-toggle="tab" href="#co2_tab2">Line 2</a></li>
        </ul>
    </div>

    <div class="tab-content" >
        <form class="form-horizontal bordered-row part-main-form" id="partOption" method="POST">
            <div id="co2_tab1" class="tab-pane fade in active">
                <div class="modal-body" style="padding: 0;">
                    <table class="table table_sticky table-hover tab-pane fade in active" cellpadding="0" cellspacing="0" width="100%">
                        <thead>
                            <tr class="nodrop">
                                <th width="25%">Database field name</th>
                                <th width="35%">Display name</th>
                                <th width="10%" class="center" nowrap="nowrap"><label><input id="checkall-show" type="checkbox" style="display: none"/>Show</label></th>
                                <th class="center" >Required</th>
                                <th class="center" nowrap="nowrap">Header Class</th>
                                <th width="10%">Align</th>
                                <th width="15%" nowrap="nowrap">Web Width</th>
                                <th width="20%" nowrap="nowrap">Display Type</th>

                            </tr>
                        </thead>
                        <tbody id="mainTable-module-col-body">
                        <?php

                        foreach ($fields as $key => $col) {
                            if (!in_array($key, array('deleted', 'SortOrder'))) {

                                ?>
                                <tr class="highlight">
                                    <td>
                                        <?php echo $col->key ?>
                                        <input type="hidden" name="part_options[line1][<?php echo $key ?>][detail]" value="<?php echo (@$col->detail ? 1 : 0) ?>"/>
                                    </td>
                                    <td><input type="text" name="part_options[line1][<?php echo $key ?>][name]" value="<?php echo ($col->name) ?>" class="form-control"></td>
                                    <td class="center"><input type="checkbox" name="part_options[line1][<?php echo $key ?>][show]" value="1" class="field-show"<?php echo (isset($col->show) && $col->show ? ' checked' : '') . (isset($col->disabled) && $col->disabled ? ' style="visibility: hidden"' : '') ?>></td>
                                    <td class="center" ><input type="checkbox" name="part_options[line1][<?php echo $key ?>][required]" value="1"  <?php echo (isset($col->required) && $col->required ? ' checked' : '')?> class=""></td>
                                    <td><input type="text" name="part_options[line1][<?php echo $key ?>][class]" value="<?php echo (@$col->class) ?>" class="form-control"></td>
                                    <td>
                                        <select name="part_options[line1][<?php echo $key ?>][align]" class="form-control">
                                            <option value="left"<?php echo (isset($col->align) && $col->align == 'left' ? ' selected="seleted"' : '') ?>>Left</option>
                                            <option value="center"<?php echo (isset($col->align) && $col->align == 'center' ? ' selected="seleted"' : '') ?>>Center</option>
                                            <option value="right"<?php echo (isset($col->align) && $col->align == 'right' ? ' selected="seleted"' : '') ?>>Right</option>
                                        </select>
                                    </td>
                                    <td class="center"><input type="text" name="part_options[line1][<?php echo $key ?>][width]" value="<?php echo ($col->width) ?>" class="form-control"/></td>
                                    <td>
                                        <select name="part_options[line1][<?php echo $key ?>][type]" class="form-control">
                                            <option value="text" <?php echo $col->type == "text" ? ' selected' : ''?>>Text</option>
                                            <option value="hidden" <?php echo $col->type == "hidden" ? ' selected' : ''?>>Hidden</option>
                                            <option value="text_input" <?php echo $col->type == "text_input" ? ' selected' : ''?>>Text input</option>
                                            <option value="check" <?php echo $col->type == "check" ? ' selected' : ''?>>Check</option>
                                            <option value="check_edit" <?php echo $col->type == "check_edit" ? ' selected' : ''?>>Check edit</option>
                                            <option value="image" <?php echo $col->type == "image" ? ' selected' : ''?>>Image</option>
                                            <option value="color" <?php echo $col->type == "color" ? ' selected' : ''?>>Color</option>
                                            <option value="date" <?php echo $col->type == "date" ? ' selected' : ''?>>Date Picker</option>
                                        </select>
                                    </td>

                                </tr>
                                <?php
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-alt btn-border border-primary btn-hover font-primary"><span>Thực hiện</span><i class="glyph-icon icon-save"></i></button>
                    <div class="btn btn-alt btn-border border-red btn-hover font-red" data-bs-dismiss="modal"><span>Hủy bỏ</span><i class="glyph-icon icon-arrow-left"></i></div>
                </div>
            </div>

            <div id="co2_tab2" class="tab-pane fade in">
                <div class="modal-body" style="padding: 0;">
                    <table class="table table_sticky table-hover tab-pane fade in active" cellpadding="0" cellspacing="0" width="100%">
                        <thead>
                            <tr class="nodrop">
                                <th width="25%">Database field name</th>
                                <th width="35%">Display name</th>
                                <th width="10%" class="center" nowrap="nowrap"><label><input id="checkall-show" type="checkbox" style="display: none"/>Show</label></th>
                                <th class="center" >Required</th>
                                <th class="center" nowrap="nowrap">Header Class</th>
                                <th width="10%">Align</th>
                                <th width="15%" nowrap="nowrap">Web Width</th>
                                <th width="20%" nowrap="nowrap">Display Type</th>

                            </tr>
                        </thead>
                        <tbody id="mainTable-module-col2-body">
                        <?php
                        foreach ($fields2 as $key => $col) {
                            if (!in_array($key, array('deleted', 'SortOrder'))) {

                                ?>
                                <tr class="highlight">
                                    <td>
                                        <?php echo @$col->key ?>
                                        <input type="hidden" name="part_options[line2][<?php echo $key ?>][detail]" value="<?php echo ($col->detail ? 1 : 0) ?>"/>
                                    </td>
                                    <td><input type="text" name="part_options[line2][<?php echo $key ?>][name]" value="<?php echo (isset($col->name) ? $col->name : $name) ?>" class="form-control"></td>
                                    <td class="center"><input type="checkbox" name="part_options[line2][<?php echo $key ?>][show]" value="1" class="field-show"<?php echo (isset($col->show) && $col->show ? ' checked' : '') . (isset($col->disabled) && $col->disabled ? ' style="display: none;" disabled' : '') ?>></td>
                                    <td class="center" ><input type="checkbox" name="part_options[line2][<?php echo $key ?>][required]" value="1"  <?php echo (isset($col->required) && $col->required ? ' checked' : '')?> class="" autocomplete="off"></td>
                                    <td><input type="text" name="part_options[line2][<?php echo $key ?>][class]" value="<?php echo (@$col->class) ?>" class="form-control"></td>
                                    <td>
                                        <select name="part_option[line2][<?php echo $key ?>][align]" class="form-control">
                                            <option value="left"<?php echo (isset($col->align) && $col->align == 'left' ? ' selected="seleted"' : '') ?>>Left</option>
                                            <option value="center"<?php echo (isset($col->align) && $col->align == 'center' ? ' selected="seleted"' : '') ?>>Center</option>
                                            <option value="right"<?php echo (isset($col->align) && $col->align == 'right' ? ' selected="seleted"' : '') ?>>Right</option>
                                        </select>
                                    </td>

                                    <td class="center"><input type="text" name="part_options[line2][<?php echo $key ?>][width]" value="<?php echo (isset($col->width) ? $col->width : 100 . 'px') ?>" class="form-control"/></td>
                                    <td>
                                        <select name="part_options[line2][<?php echo $key ?>][type]" class="form-control" autocomplete="off">
                                            <option value="text" <?php echo $col->type == "text" ? ' selected' : ''?>>Text</option>
                                            <option value="hidden" <?php echo $col->type == "hidden" ? ' selected' : ''?>>Hidden</option>
                                            <option value="text_input" <?php echo $col->type == "text_input" ? ' selected' : ''?>>Text input</option>
                                            <option value="check" <?php echo $col->type == "check" ? ' selected' : ''?>>Check</option>
                                            <option value="check_edit" <?php echo $col->type == "check_edit" ? ' selected' : ''?>>Check edit</option>
                                            <option value="image" <?php echo $col->type == "image" ? ' selected' : ''?>>Image</option>
                                            <option value="color" <?php echo $col->type == "color" ? ' selected' : ''?>>Color</option>
                                            <option value="date" <?php echo $col->type == "date" ? ' selected' : ''?>>Date Picker</option>
                                        </select>
                                    </td>

                                </tr>
                                <?php
                            }
                        }
                        ?>
                        </tbody>
                    </table>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-alt btn-border border-primary btn-hover font-primary"><span>Thực hiện</span><i class="glyph-icon icon-save"></i></button>
                    <div class="btn btn-alt btn-border border-red btn-hover font-red" data-bs-dismiss="modal"><span>Hủy bỏ</span><i class="glyph-icon icon-arrow-left"></i></div>
                </div>
            </div>
        </form>
    </div>
</section>