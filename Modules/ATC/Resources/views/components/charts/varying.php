<div class="content-box border-top border-info box-varying" id="<?= $controller . "-" . randomKey() ?>">
    <input type="hidden" name="frm_data[data][<?= $controller ?>][type]" value="<?= $com_data->data_type ?? 'varying' ?>">
    <div class="show-chart" style="width: 100%;"></div>
    <div class="varying-responsive">
        <table class="varying-controller">
            <thead class="varying-group">
                <tr>
                    <th class="varying-label"></th>
                    <?php foreach ($months as $m) : ?>
                        <th class="varying-label"><?= $m ?></th>
                    <?php endforeach ?>
                    <th class="varying-label">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $infoStarting = @$info['data'][$keyName]['starting'] ?? null;
                $monthStarting = !empty(@$infoStarting) ? array_search(explode(' ', @$infoStarting)[0], $months) : 0;
                $yearStarting = !empty(@$infoStarting) ? intval(explode(' ', @$infoStarting)[1]) : 0;
                foreach ($years as $y => $year) :
                ?>
                    <?php if (($y + 1) < 3) : ?>
                        <tr class="varying-group varying-active varying-data <?= $y == 0 ? 'active' : '' ?>" title="January <?= $year ?> - December <?= $year ?>" data-year="<?= $year ?>">
                            <td class="varying-label text-bold"><?= $year ?></td>
                            <?php foreach ($months as $m => $month) :
                                $month = strtolower($month);
                            ?>
                                <td class="varying-input">
                                    <input class="data-control" type="number" min="0" data-name="<?= $month ?>" value="<?= @$info['data'][$controller]['data'][$year][$m] ?? 0 ?>" name="frm_data[data][<?= $controller ?>][data][<?= $year ?>][]" <?= ($m < $monthStarting && $year == $yearStarting) ? 'readonly' : '' ?>>
                                </td>
                            <?php endforeach ?>
                            <td class="varying-input total">
                                <input class="data-control" type="number" min="0" name="frm_data[data][<?= $controller ?>][data][<?= $year ?>][]" value="<?= @$info['data'][$controller]['data'][$year][12] ?? 0 ?>">
                            </td>
                        </tr>
                    <?php else : ?>
                        <tr class="varying-group varying-active varying-total" title="<?= $year ?>" data-year="<?= $year ?>">
                            <td class="varying-label text-bold text-right" colspan="13"><?= $year ?></td>
                            <td class="varying-input total">
                                <input class="data-control" type="number" min="0" value="<?= @$info['data'][$controller]['data'][$year][0] ?? 0 ?>" name="frm_data[data][<?= $controller ?>][data][<?= $year ?>][0]">
                            </td>
                        </tr>
                    <?php endif ?>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>