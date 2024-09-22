<div class="form-group">
    <div class="row">
        <div class="col-sm-11">
            <div class="box-select-color">
                <select id="orders_status_type" class="form-control select2 select-type" name="type" style="width: 100%;">
                    <option value="">Select ...</option>
                    <?php foreach ($orders_status_type as $val) : ?>
                        <option <?= $display_type_value == $val['name'] ? 'selected' : '' ?> value="<?= $val['name'] ?>" data-options='<?= $val['status'] ?>'><?= $val['name'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <input type="text" class="form-control input-type" value="" style="display: none;">
        </div>
        <div class="col-sm-1">
            <div class="btn tooltip-link bg-green btn-add-orders-type text-center">
                <i class="fa fa-plus-circle" aria-hidden="true"></i>
            </div>
        </div>
    </div>
</div>
<table class="table color-type-detail">
    <thead>
        <tr>
            <th width="5%" class="text-center">#</th>
            <th width="20%">Key</th>
            <th>Name</th>
            <th width="10%">Background</th>
            <th width="10%">Color</th>
            <th width="2%" class="text-center"><i class="fa fa-plus-circle font-blue btn-add-color-type" aria-hidden="true"></i></th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>