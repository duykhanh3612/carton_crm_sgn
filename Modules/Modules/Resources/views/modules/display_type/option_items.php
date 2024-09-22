<div class="form-group">
    <div class="row">
        <div class="col-sm-12">
            <div class="d-flex">
                <?php if (!empty($optionItem) && !is_array(@$optionItem) && !is_array(@$display_type)) : ?>
                    <a class="btn" id="back_link" href="<?= admin_url(@$display_type . '?filter%5BField%5D=' . @$optionItem) ?>" target="_blank">
                        <i class="fa fa-link"></i>
                    </a>
                <?php endif ?>
                <div class="box-select-color" style="width: 100%">
                    <select id="orders_status_type" class="form-control select2 select-type" name="type" style="width: 100%;">
                        <option value="">Choose option..</option>
                        <?php foreach ($option_items as $value) : ?>
                            <option data-options='<?= $value->options ?>' <?= !empty($optionItem) && $optionItem == $value->field ? 'selected' : '' ?> value="<?= $value->field ?>"><?= $value->name ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
        </div>
        <?php if ($display_type == 'option_items_keynum') : ?>
            <div class="col-sm-12" style="margin-top: 5px;">
                <table class="table color-type-detail">
                    <thead>
                        <tr>
                            <th width="5%" class="text-center">#</th>
                            <th width="10%">Key</th>
                            <th>Name</th>
                            <th width="15%">Background</th>
                            <th width="15%">Color</th>
                            <th width="15%">Preview</th>
                            <th width="1%" class="text-center"><i class="fa fa-plus-circle font-blue btn-add-color-type" aria-hidden="true"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        <?php endif ?>
    </div>
</div>
<script>
    $("#orders_status_type").change(function() {
        let optionItem = $(this).val();
        $("#back_link").attr('href', '<?= $display_type ?>?filter%5BField%5D=' + optionItem);
    });
</script>
