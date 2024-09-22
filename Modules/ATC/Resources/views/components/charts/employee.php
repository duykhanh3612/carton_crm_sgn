<?php
$idController = ucwordsModule($controller);
?>
<div id="<?= $controller . "-" . randomKey() ?>">
    <div class="info-header">
        <a href="#type<?= $idController ?>" data-toggle="collapse">
            <h1 class="pd-10"><i class="glyph-icon icon-chevron-down mr-10"></i>type</h1>
        </a>
    </div>
    <div id="type<?= $idController ?>" class="collapse in">
        <div class="box-collapse collapse-detail">
            <h4 class="title-question">Is this an individual employee or a group?</h4>
            <p>Use the group option only for similar employees with the same start date. If you are filling the same role at multiple points in time, enter those hires individually with their own start dates.</p>
            <div id="individualOrGroup">
                <div class="box-tab">
                    <a <?= (@$info['data']['type']['type_employee'] == 'individual' || empty(@$info['data']['type']['type_employee'])) ? 'class="active"' : '' ?> href="#individual" data-value="individual" data-toggle="tab" role="tab">
                        Individual
                        <input type="radio" name="frm_data[data][type][type_employee]" value="individual" hidden <?= (@$info['data']['type']['type_employee'] == 'individual' || empty(@$info['data']['type']['type_employee'])) ? 'checked' : '' ?>>
                    </a>
                    <a <?= (@$info['data']['type']['type_employee'] == 'group-of-employees') ? 'class="active"' : '' ?> href="#groupOfEmployees" data-value="group-of-employees" data-toggle="tab" role="tab">
                        Group of employees
                        <input type="radio" name="frm_data[data][type][type_employee]" value="group-of-employees" hidden <?= (@$info['data']['type']['type_employee'] == 'group-of-employees') ? 'checked' : '' ?>>
                    </a>
                </div>
                <div id="individual"></div>
                <div id="groupOfEmployees" class="mb-10 tab-pane tab-pane-type <?= (@$info['data']['type']['type_employee'] == 'group-of-employees') ? 'active' : '' ?>">
                    <h4 class="title-question">How will you enter the number of employees?</h4>
                    <div class="box-tab">
                        <a <?= (@$info['data']['type']['type'] == 'constant' || empty(@$info['data']['type']['type'])) ? 'class="active"' : '' ?> href="#employeesConstant" data-value="constant" data-toggle="tab" role="tab">Constant number</a>
                        <a <?= (@$info['data']['type']['type'] == 'varying') ? 'class="active"' : '' ?> href="#employeesVarying" data-value="varying" data-toggle="tab" role="tab">Varying numbers</a>
                    </div>
                    <div id="employeesConstant" class="mb-10 tab-pane tab-pane-type <?= (@$info['data']['type']['type'] == 'constant' || empty(@$info['data']['type']['type'])) ? 'active' : '' ?>">
                        <h4 class="title-question">How many employees are in this group?</h4>
                        <p class="pd-10">Enter the quantity in full-time equivalents (FTEs).</p>
                        <?= component('charts', [
                            'type'          => 'constant',
                            'data_type'     => 'constant',
                            'controller'    => 'type',
                            'display'       => []
                        ]) ?>
                    </div>
                    <div id="employeesVarying" class="tab-pane tab-pane-type <?= (@$info['data']['type']['type'] == 'varying') ? 'active' : '' ?>">
                        <h4 class="title-question">How many employees are in this group?</h4>
                        <?= component('charts', [
                            'type'          => 'varying',
                            'controller'    => 'type'
                        ]) ?>
                    </div>
                </div>
                <div id="direct-labor-general">
                    <div class="mb-10 box-collapse collapse-labor">
                        <h4 class="title-question">Is this direct labor?</h4>
                        <div id="isThis<?= $idController ?>">
                            <div class="box-tab">
                                <a <?= (@$info['data']['type']['labor'] == 'regular' || empty(@$info['data']['type']['labor'])) ? 'class="active"' : '' ?> href="#regular-labor" data-value="regular" data-toggle="tab" role="tab">
                                    Regular labor
                                    <input type="radio" name="frm_data[data][type][labor]" value="regular" hidden <?= (@$info['data']['type']['labor'] == 'regular' || empty(@$info['data']['type']['labor'])) ? 'checked' : '' ?>>
                                </a>
                                <a <?= (@$info['data']['type']['labor'] == 'direct') ? 'class="active"' : '' ?> href="#direct-labor" data-value="direct" data-toggle="tab" role="tab">
                                    Direct labor
                                    <input type="radio" name="frm_data[data][type][labor]" value="direct" hidden <?= (@$info['data']['type']['labor'] == 'direct') ? 'checked' : '' ?>>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="box-collapse collapse-contact">
                        <h4 class="title-question">Is this a contract?</h4>
                        <div id="isThisAContract">
                            <div class="box-tab">
                                <a <?= (@$info['data']['type']['contact'] == 'on-staff-employee' || empty(@$info['data']['type']['contact'])) ? 'class="active"' : '' ?> href="#onStaffEmployee" data-value="on-staff-employee" data-toggle="tab" role="tab">
                                    On-staff employee
                                    <input type="radio" name="frm_data[data][type][contact]" value="on-staff-employee" hidden <?= (@$info['data']['type']['contact'] == 'on-staff-employee' || empty(@$info['data']['type']['contact'])) ? 'checked' : '' ?>>
                                </a>
                                <a <?= (@$info['data']['type']['contact'] == 'contract-worker') ? 'class="active"' : '' ?> href="#contract-worker" data-value="contract-worker" data-toggle="tab" role="tab">
                                    Contract worker
                                    <input type="radio" name="frm_data[data][type][contact]" value="contract-worker" hidden <?= (@$info['data']['type']['contact'] == 'contract-worker') ? 'checked' : '' ?>>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="info-header">
        <a href="#amount<?= $idController ?>" data-toggle="collapse">
            <h1 class="pd-10"><i class="glyph-icon icon-chevron-down mr-10"></i>Amount</h1>
        </a>
    </div>
    <div id="amount<?= $idController ?>" class="collapse in">
        <div class="box-tab" data-type="<?= $controller ?>">
            <a href="#constant-amount-direct-labor" data-value="constant" data-toggle="tab" role="tab" <?= @$info['data']['amount']['type'] == 'constant' || empty(@$info['data']['amount']['type']) ? 'class="active"' : '' ?>>Constant amount</a>
            <a href="#varying-amounts-direct-labor" data-value="varying" data-toggle="tab" role="tab" <?= @$info['data']['amount']['type'] == 'varying' ? 'class="active"' : '' ?>>Varying amounts over time ($)</a>
            <?php if ($controller != 'personnel') : ?>
                <a href="#constant-overall" data-value="constant-overall" data-toggle="tab" role="tab" <?= @$info['data']['amount']['type'] == 'constant-overall' ? 'class="active"' : '' ?>>% of overall revenue</a>
                <a href="#constant-specific" data-value="constant-specific" data-toggle="tab" role="tab" <?= @$info['data']['amount']['type'] == 'constant-specific' ? 'class="active"' : '' ?>>% of specific revenue stream</a>
            <?php endif ?>
        </div>
        <div id="constant-amount-direct-labor" class="tab-pane tab-pane-type  mt-10 mb-10 <?= (@$info['data']['amount']['type'] == 'constant' || empty(@$info['data']['amount']['type'])) ? 'active' : '' ?>">
            <h4 class="title-question">How much will you pay them?</h4>
            <?= component('charts', [
                'type'          => 'constant',
                'data_type'     => 'constant',
                'controller'    => 'amount',
                'display'       => [
                    'per'       => 'month',
                    'starting'  => true
                ]
            ]); ?>
        </div>
        <div id="varying-amounts-direct-labor" class="tab-pane tab-pane-type <?= @$info['data']['amount']['type'] == 'varying' ? 'active' : '' ?>">
            <h4 class="title-question">How much will you pay them?</h4>
            <?= component('charts', [
                'type'          => 'varying',
                'controller'    => 'amount'
            ]) ?>
        </div>
        <?php if ($controller != 'personnel') : ?>
            <div id="constant-overall" class="tab-pane tab-pane-type <?= @$info['data']['amount']['type'] == 'constant-overall' ? 'active' : '' ?>">
                <div class="info-header">
                    <a href="#constant-overall-detail" data-toggle="collapse">
                        <h1 class="pd-10"><i class="glyph-icon icon-chevron-down mr-10"></i>What percentage of overall revenue will you pay them?</h1>
                    </a>
                    <p>Enter the portion of overall revenue that you want to pay each full-time employee in this group.</p>
                </div>
                <div id="constant-overall-detail" class="collapse in">
                    <?= component('charts', [
                        'type'          => 'constant',
                        'data_type'     => 'constant-overall',
                        'controller'    => 'amount',
                        'display'       => [
                            'symbol'    => '%',
                            'starting'  => true
                        ]
                    ]) ?>
                </div>
            </div>
            <div id="constant-specific" class="tab-pane tab-pane-type <?= @$info['data']['amount']['type'] == 'constant-specific' ? 'active' : '' ?>">
                <div class="info-header">
                    <a href="#constant-revenue-detail" data-toggle="collapse">
                        <h1 class="pd-10"><i class="glyph-icon icon-chevron-down mr-10"></i>Which revenue stream?</h1>
                    </a>
                </div>
                <div id="constant-revenue-detail" class="collapse in">
                    <select class="data-control select-box" name="frm_data[data][amount][revenue]" id="revenue">
                        <option value="0">Please choose...</option>
                        <?php foreach ($revenue as $value) : ?>
                            <option value="<?= $value['id'] ?>" <?= @$info['data']['amount']['revenue'] == $value['id'] ? 'selected' : '' ?>><?= $value['title'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="info-header">
                    <a href="#constant-specific-detail" data-toggle="collapse">
                        <h1 class="pd-10"><i class="glyph-icon icon-chevron-down mr-10"></i>What percentage of this revenue stream will you pay them?</h1>
                    </a>
                    <p>Enter the portion of overall revenue that you want to pay each full-time employee in this group.</p>
                </div>
                <div id="constant-specific-detail" class="collapse in">
                    <?= component('charts', [
                        'type'          => 'constant',
                        'data_type'     => 'constant-specific',
                        'controller'    => 'amount',
                        'display'       => [
                            'symbol'    => '%',
                            'starting'  => true
                        ]
                    ]) ?>
                </div>
            </div>
        <?php endif ?>
    </div>
</div>