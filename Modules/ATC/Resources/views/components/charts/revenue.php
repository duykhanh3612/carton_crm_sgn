<div class="box-collapse collapse-revenue">
    <div class="info-header">
        <a href="#collapse-which-revenue-stream" data-toggle="collapse">
            <h1 class="pd-10"><i class="glyph-icon icon-chevron-down mr-10"></i>Which revenue stream?</h1>
        </a>
    </div>
    <div id="collapse-which-revenue-stream" class="collapse in">
        <select class="data-control select-box" name="frm_data[data][<?= $controller ?>][revenue]" id="revenue">
            <option value="0">Please choose...</option>
            <?php foreach ($revenue as $value) : ?>
                <option value="<?= $value['id'] ?>" <?= @$info['data'][$controller]['revenue'] == $value['id'] ? 'selected' : '' ?>><?= $value['title'] ?></option>
            <?php endforeach ?>
        </select>
    </div>
</div>