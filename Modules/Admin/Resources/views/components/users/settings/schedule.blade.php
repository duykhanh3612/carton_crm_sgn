@php
    $scheduleKey = config("constants.scheduling.{$key}");
    $scheduleKeyAt = config("constants.scheduling.{$key}_at");
@endphp
@include('components.inputs.select', [
    'data'=> config('constants.scheduling.options'),
    'dataType' => 'int',
    'label' => $label,
    'name' => $scheduleKey,
    'value' => hs_setting($scheduleKey),
    'class' => 'has-dependency-div update-user-setting'
])
@include('components.inputs.select', [
   'data'=> config('constants.scheduling.at_options'),
   'label' => 'Run at',
   'name' => $scheduleKeyAt,
   'value' => hs_setting($scheduleKeyAt),
   'class' => 'update-user-setting',
   'rowClass' => 'dependency-div',
   'rowData' => [
       'parent' => $scheduleKey,
       'show' => 1440
   ]
])
