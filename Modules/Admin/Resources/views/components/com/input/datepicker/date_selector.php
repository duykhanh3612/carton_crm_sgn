<component class="date_selector <?=@$class?>">
    <div class="input-group" style="display: flex">
        <div class="input-group input-day-box">
            <input type="text" class="input-day form-control request_date" name="<?= sprintf($slug, $name.'_number') ?>" id="<?= @$component_id ?>" placeholder="" title="<?= $name ?>" value="<?= isset($number) ? $number : '' ?>" <?= @$required ? 'data-required="1"' : ''?>>
            <div class="input-group-addon" style="padding: 1px 1px;font-size: 12px">day</div>
        </div>
        <input type="text" class="choose-day form-control input-group-addon bootstrap-datepicker" name="<?= sprintf($slug, $name) ?>" id="request_date" title="<?= $name ?>" value="<?= isset($value) ? $value : '' ?>">
    </div>
    <div class="errordiv <?= $component_id  ?>">Not Empty!</div>
</component>