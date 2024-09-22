<div class="box-constant d-flex" id="<?= $controller . "-" . randomKey() ?>">
    <input type="hidden" name="frm_data[data][<?= $controller ?>][type]" value="<?= $com_data->data_type ?? 'constant' ?>">
    <div class="data-group d-currency d-flex">
        <?php if ($com_data->display->symbol == '%') : ?>
            <div class="input-box-wrapper">
                <span aria-hidden="true" class="percent">%</span>
                <input class="data-control input-box" type="number" name="frm_data[data][<?= $controller ?>][percent]" id="percent" value="<?= @$info['data'][$controller]['percent'] ?? 0 ?>" autocomplete="off">
            </div>
        <?php elseif ($com_data->display->symbol == 'valid') : ?>
            <div class="input-box-wrapper">
                <input class="data-control input-box" type="number" name="frm_data[data][<?= $controller ?>][valid]" id="valid" value="<?= @$info['data'][$controller]['valid'] ?? 0 ?>" autocomplete="off">
            </div>
        <?php else : ?>
            <div class="input-box-wrapper">
                <span aria-hidden="true" class="percent">$</span>
                <input class="data-control input-box" type="number" name="frm_data[data][<?= $controller ?>][currency]" id="currency" value="<?= @$info['data'][$controller]['currency'] ?? 0 ?>" autocomplete="off">
            </div>
        <?php endif ?>
    </div>
    <?php
    if (!empty($com_data->display->per)) :
        $per = !empty(@$info['data'][$controller]['per']) ? @$info['data'][$controller]['per'] : $com_data->display->per;
    ?>
        <div class="data-group d-per d-flex">
            <?php if ($per == 'hour') : ?>
                <input class="form-control" type="hidden" name="frm_data[data][<?= $controller ?>][per]" id="per" value="hour">
                <label class="data-label" for="per">per hour</label>
            <?php else : ?>
                <label class="data-label" for="per">per</label>
                <select class="data-control select-box" name="frm_data[data][<?= $controller ?>][per]" id="per">
                    <option value="month" <?= $per == 'month' ? 'selected' : '' ?>>Month</option>
                    <option value="year" <?= $per == 'year' ? 'selected' : '' ?>>Year</option>
                </select>
            <?php endif ?>
        </div>
    <?php endif ?>
    <?php if (!empty($com_data->display->starting)) : ?>
        <div class="data-group d-starting d-flex">
            <label class="data-label" for="starting">starting</label>
            <select class="data-control select-box" name="frm_data[data][<?= $controller ?>][starting]" id="starting">
                <?php foreach ($starting as $s) : ?>
                    <option value="<?= $s ?>" <?= @$info['data'][$controller]['starting'] == $s ? 'selected' : '' ?>><?= $s ?></option>
                <?php endforeach ?>
            </select>
        </div>
    <?php endif ?>
    <?php if (!empty($com_data->display->{'interest-over'})) : ?>
        <div class="data-group d-interest-over d-flex">
            <label class="data-label" for="interest-over">interest over</label>
            <input class="data-control input-box" type="number" min="0" name="frm_data[data][<?= $controller ?>][interest-over]" id="interest-over" value="<?= @$info['data'][$controller]['interest-over'] ?? 0 ?>">
            <label class="data-label" for="interest-over">month(s)</label>
        </div>
    <?php endif ?>
</div>