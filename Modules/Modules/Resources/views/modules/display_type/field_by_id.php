<div class="form-group">
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-12 control-label mrg5B">Table <span class="text-danger">*</span></div>
                    <div class="col-sm-12">
                        <select name="table" class="form-control select2 select-table" style="width: 100%;">
                            <option value="">Choose table..</option>
                            <?php
                            foreach ($display_table as $table) :
                                // $tableName = ucwords(str_replace("_"," ", 'table_' . preg_replace('/\s+/', '', $table)));

                                $tableName = $table;
                            ?>
                                <option <?= !empty($display_type_value['table']) && $display_type_value['table'] == $tableName ? 'selected' : '' ?> value="<?= $table ?>"><?= $tableName ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-12 control-label mrg5B">Field <span class="text-danger">*</span></div>
                    <div class="col-sm-12 box-select-field" data-field="<?= $display_type_value['field'] ?? '' ?>">
                        <select class="form-control" style="width: 100%;"></select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-12 control-label mrg5B">Format display</div>
                    <div class="col-sm-12 format-display d-flex">
                        <div class="mrg10R">
                            <input <?= !empty($display_type_value['show_id']) ? 'checked' : ''  ?> id="only" type="checkbox" name="show_id">
                            <label for="only">Show ID</label>
                        </div>
                        <div>
                            <input <?= !empty($display_type_value['show_field']) ? 'checked' : ''  ?> id="full" type="checkbox" name="show_field">
                            <label for="full">Show Field</label>
                        </div>
                        <div>
                            <input <?= !empty($display_type_value['show_code_field']) ? 'checked' : ''  ?> id="full_code_field" type="checkbox" name="show_code_field">
                            <label for="full">Show Code - Field</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-12 control-label mrg5B">Options</div>
                    <div class="col-sm-12 format-display d-flex">
                        <div class="mrg10R">
                            <input <?= !empty($display_type_value['multiple']) ? 'checked' : ''  ?> id="only" type="checkbox" name="multiple">
                            <label for="only">Select Multiple</label>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
