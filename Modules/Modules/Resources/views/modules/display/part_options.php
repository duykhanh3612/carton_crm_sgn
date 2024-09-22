<form class="form-horizontal bordered-row part-main-form" method="POST" action="">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title"><?= @$title ?> Tuỳ chọn hiển thị các trường dữ liệu</h4>
    </div>
    <div class="pad15A tab-content modal-body">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#line-1">Line 1</a></li>
            <li><a data-toggle="tab" href="#line-2">Line 2</a></li>
        </ul>
        <div id="line-1" class="tab-pane fade in active">
            <table id="mainTable-module-col" class="table table-hover table-striped" cellpadding="0" cellspacing="0" width="100%">
                <thead>
                    <tr class="nodrop">
                        <th width="15%">Database field name</th>
                        <th width="15%">Display name</th>
                        <th width="5%" class="center" nowrap="nowrap"><label><input id="checkall-sort" type="checkbox" style="display: none" />Order</label></th>
                        <th width="5%" class="center" nowrap="nowrap"><label><input id="checkall-show" type="checkbox" style="display: none" />Show</label></th>
                        <th width="5%" class="center" nowrap="nowrap">Required</th>
                        <th width="5%" style="min-width: 110px; max-width: 110px;" nowrap="nowrap">Header Class</th>
                        <th width="5%">Align</th>
                        <th width="5%" nowrap="nowrap">Web Width</th>
                        <th width="5%" nowrap="nowrap">Excel width</th>
                        <th width="5%" nowrap="nowrap">Format number</th>
                        <th width="5%" class="center" nowrap="nowrap"><label><input id="checkall-link" type="checkbox" style="display: none" />Edit link</label></th>
                        <th width="5%" class="center" nowrap="nowrap"><label><input id="checkall-sort" type="checkbox" style="display: none" />Sort</label></th>
                        <th width="5%" class="center" nowrap="nowrap"><label><input id="checkall-nowrap" type="checkbox" style="display: none" />Nowrap</label></th>
                        <th width="5%" style="min-width: 92px; max-width: 92px;" nowrap="nowrap">Display type</th>
                        <th width="5%" style="min-width: 92px; max-width: 92px;" nowrap="nowrap">Display filter</th>
                        <th width="5%" style="min-width: 92px; max-width: 92px;" nowrap="nowrap">Option</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($line1 as $key => $col) { ?>
                        <tr class="highlight <?=$col->hide == '1' ? 'hide' : ''?>">
                            <td>
                                <?= $col->name ?>
                                <input type="hidden" name="part_options[1][<?= $key ?>][detail]" value="<?php echo ($col->detail ? 1 : 0) ?>" />
                                <input type="hidden" name="part_options[1][<?= $key ?>][module]" value="<?php echo ($modulePart) ?>" />
                                <input type="hidden" name="part_options[1][<?= $key ?>][line]" value="1" />
                            </td>
                            <td>
                                <input type="text" name="part_options[1][<?= $key ?>][name]" value="<?= $col->name ?>" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="part_options[1][<?= $key ?>][sort_order]" value="<?= $col->sort_order ?>" class="form-control">
                            </td>
                            <td class="center">
                                <input type="checkbox" name="part_options[1][<?= $key ?>][show]" value="1" data-key="<?=$key?>" class="field-show" <?= ((!empty($col->show) && $col->show) ? ' checked' : '') . ($col->detail ? ' style="display: none;" disabled' : '') ?>>
                            </td>
                            <td class="center">
                                <input type="checkbox" name="part_options[1][<?= $key ?>][required]" value="1" <?= (isset($col->required) && ($col->required) ? ' checked' : '') ?> />
                            </td>
                            <td><input type="text" name="part_options[1][<?= $key ?>][header_class]" value="<?php echo (isset($col->header_class) ? $col->header_class : '') ?>" <?php echo ($col->detail ? ' style="display: none;"' : '') ?> class="form-control"></td>
                            <td>
                                <select name="part_options[1][<?= $key ?>][align]" class="form-control">
                                    <option value="left" <?php echo (isset($col->align) && $col->align == 'left' ? ' selected="seleted"' : '') ?>>
                                        Left</option>
                                    <option value="center" <?php echo (isset($col->align) && $col->align == 'center' ? ' selected="seleted"' : '') ?>>
                                        Center</option>
                                    <option value="right" <?php echo (isset($col->align) && $col->align == 'right' ? ' selected="seleted"' : '') ?>>
                                        Right</option>
                                </select>
                            </td>
                            <td class="center"><input type="text" name="part_options[1][<?= $key ?>][width]" value="<?php echo (isset($col->width) ? $col->width : 100 . 'px') ?>" class="form-control" /></td>
                            <td class="center">
                                <input type="text" name="part_options[1][<?= $key ?>][excel_width]" value="<?php echo (isset($col->excel_width) ? $col->excel_width : 20) ?>" <?php echo ($col->detail ? ' style="display: none;"' : '') ?> class="form-control" />
                            </td>
                            <td class="center">
                                <input type="text" name="part_options[1][<?= $key ?>][format]" value="<?php echo (isset($col->format) ? $col->format : '') ?>" class="form-control" />
                            </td>
                            <td class="center">
                                <input type="checkbox" name="part_options[1][<?= $key ?>][link]" value="1" <?= (isset($col->link) ? ' checked' : '') . ($col->detail ? ' style="display: none;" disabled' : '') ?> class="field-link">
                            </td>
                            <td class="center">
                                <input type="checkbox" name="part_options[1][<?= $key ?>][sort]" value="1" <?= (isset($col->sort) ? ' checked' : '') ?> class="field-sort">
                            </td>
                            <td class="center">
                                <input type="checkbox" name="part_options[1][<?= $key ?>][nowrap]" value="1" <?= (isset($col->nowrap) ? ' checked' : '') ?> class="field-nowrap">
                            </td>
                            <td>
                                <?= get_options_keynum('DisplayType', $col->type, 'id="type" class="form-control" data-required="1"', 'part_options[1][' . $key . '][type]') ?>
                            </td>
                            <td>
                                <?= get_options_keynum('DisplayFilter', $col->filter, 'id="type" class="form-control" data-required="1"', 'part_options[1][' . $key . '][filter]') ?>
                            </td>
                            <td class="center">
                                <input type="text" name="part_options[1][<?= $key ?>][field]" value="<?php echo (isset($col->field) ? $col->field : '') ?>" <?php echo ($col->detail ? ' style="display: none;"' : '') ?> class="form-control" />
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div id="line-2" class="tab-pane fade in">
            <table id="mainTable-module-col" class="table table-hover table-striped" cellpadding="0" cellspacing="0" width="100%">
                <thead>
                    <tr class="nodrop">
                        <th width="15%">Database field name</th>
                        <th width="15%">Display name</th>
                        <th width="5%" class="center" nowrap="nowrap"><label><input id="checkall-sort" type="checkbox" style="display: none" />Order</label></th>
                        <th width="5%" class="center" nowrap="nowrap"><label><input id="checkall-show" type="checkbox" style="display: none" />Show</label></th>
                        <th width="5%" class="center" nowrap="nowrap">Show on search</th>
                        <th width="5%" style="min-width: 110px; max-width: 110px;" nowrap="nowrap">Header Class</th>
                        <th width="5%">Align</th>
                        <th width="5%" nowrap="nowrap">Web Width</th>
                        <th width="5%" nowrap="nowrap">Excel width</th>
                        <th width="5%" nowrap="nowrap">Format number</th>
                        <th width="5%" class="center" nowrap="nowrap"><label><input id="checkall-link" type="checkbox" style="display: none" />Edit link</label></th>
                        <th width="5%" class="center" nowrap="nowrap"><label><input id="checkall-sort" type="checkbox" style="display: none" />Sort</label></th>
                        <th width="5%" class="center" nowrap="nowrap"><label><input id="checkall-nowrap" type="checkbox" style="display: none" />Nowrap</label></th>
                        <th width="5%" style="min-width: 92px; max-width: 92px;" nowrap="nowrap">Display type</th>
                        <th width="5%" style="min-width: 92px; max-width: 92px;" nowrap="nowrap">Display filter</th>
                        <th width="5%" style="min-width: 92px; max-width: 92px;" nowrap="nowrap">Option</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($line2 as $key => $col) { ?>
                        <tr class="highlight <?=$col->hide == '1' ? 'hide' : ''?>">
                            <td>
                                <?php echo $col->name ?>
                                <input type="hidden" name="part_options[2][<?= $key ?>][detail]" value="<?php echo ($col->detail ? 1 : 0) ?>" />
                                <input type="hidden" name="part_options[2][<?= $key ?>][module]" value="<?php echo ($modulePart) ?>" />
                                <input type="hidden" name="part_options[2][<?= $key ?>][line]" value="2" />
                            </td>
                            <td>
                                <input type="text" name="part_options[2][<?= $key ?>][name]" value="<?php echo (isset($col->name) ? $col->name : $name) ?>" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="part_options[2][<?= $key ?>][sort_order]" value="<?= $col->sort_order ?>" class="form-control">
                            </td>
                            <td class="center">
                                <input type="checkbox" name="part_options[2][<?= $key ?>][show]" value="1" data-key="<?=$key?>" class="field-show" <?= ((!empty($col->show) && $col->show) ? ' checked' : '') . ($col->detail ? ' style="display: none;" disabled' : '') ?>>
                            </td>
                            <td class="center">
                                <input type="checkbox" name="part_options[2][<?= $key ?>][search_show]" value="1" <?= (isset($col->search_show) && ($col->search_show) ? ' checked' : '') ?> />
                            </td>
                            <td><input type="text" name="part_options[2][<?= $key ?>][header_class]" value="<?php echo (isset($col->header_class) ? $col->header_class : '') ?>" <?php echo ($col->detail ? ' style="display: none;"' : '') ?> class="form-control"></td>
                            <td>
                                <select name="part_options[2][<?= $key ?>][align]" class="form-control">
                                    <option value="left" <?php echo (isset($col->align) && $col->align == 'left' ? ' selected="seleted"' : '') ?>>
                                        Left</option>
                                    <option value="center" <?php echo (isset($col->align) && $col->align == 'center' ? ' selected="seleted"' : '') ?>>
                                        Center</option>
                                    <option value="right" <?php echo (isset($col->align) && $col->align == 'right' ? ' selected="seleted"' : '') ?>>
                                        Right</option>
                                </select>
                            </td>
                            <td class="center"><input type="text" name="part_options[2][<?= $key ?>][width]" value="<?php echo (isset($col->width) ? $col->width : 100 . 'px') ?>" class="form-control" /></td>
                            <td class="center">
                                <input type="text" name="part_options[2][<?= $key ?>][excel_width]" value="<?php echo (isset($col->excel_width) ? $col->excel_width : 20) ?>" <?php echo ($col->detail ? ' style="display: none;"' : '') ?> class="form-control" />
                            </td>
                            <td class="center">
                                <input type="text" name="part_options[2][<?= $key ?>][format]" value="<?php echo (isset($col->format) ? $col->format : '') ?>" class="form-control" />
                            </td>
                            <td class="center">
                                <input type="checkbox" name="part_options[2][<?= $key ?>][link]" value="1" <?= (isset($col->link) ? ' checked' : '') . ($col->detail ? ' style="display: none;" disabled' : '') ?> class="field-link">
                            </td>
                            <td class="center">
                                <input type="checkbox" name="part_options[2][<?= $key ?>][sort]" value="1" <?= (isset($col->sort) ? ' checked' : '') ?> class="field-sort">
                            </td>
                            <td class="center">
                                <input type="checkbox" name="part_options[2][<?= $key ?>][nowrap]" value="1" <?= (isset($col->nowrap) ? ' checked' : '') ?> class="field-nowrap">
                            </td>
                            <td>
                                <?= get_options_keynum('DisplayType', $col->type, 'id="type" class="form-control" data-required="1"', 'part_options[2][' . $key . '][type]') ?>
                            </td>
                            <td>
                                <?= get_options_keynum('DisplayFilter', $col->filter, 'id="type" class="form-control" data-required="1"', 'part_options[2][' . $key . '][filter]') ?>
                            </td>
                            <td class="center">
                                <input type="text" name="part_options[2][<?= $key ?>][field]" value="<?php echo (isset($col->field) ? $col->field : '') ?>" <?php echo ($col->detail ? ' style="display: none;"' : '') ?> class="form-control" />
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-alt btn-border border-primary btn-hover font-primary"><span>Thực hiện</span><i class="glyph-icon icon-save"></i></button>
        <div class="btn btn-alt btn-border border-red btn-hover font-red" data-dismiss="modal"><span>Hủy bỏ</span><i class="glyph-icon icon-arrow-left"></i></div>
    </div>
</form>
