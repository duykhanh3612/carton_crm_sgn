@php
    $colLeft = empty($colLeft) ? 12 : $colLeft;
    if ($colLeft == 12) {
        $colRight = 12;
    }
    $setting = json_decode($setting, true);
    $table = str_replace('table_', '', $setting['table']);
    $where = '';
    if (\Schema::hasColumn($table, 'language_code')) {
        $where = "language_code = '" . request('language_code') . "'";
    }
    $fields = get_data_options($table, ['field' => 'id, name', 'where' => $where]);
@endphp
{!! form_dropdown($name, $fields, $value, 'class="form-control"') !!}
