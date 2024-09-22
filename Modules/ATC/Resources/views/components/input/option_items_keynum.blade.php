
@php
$name_id = str_replace(['[', ']', '#'], ['', '', ''], @$name);
$options = !empty($format) ? json_decode(get_data($type, "Field = '" . $format . "'", 'Options'), true) : [];
if(!empty($options)) $options = array_column($options, 'name', 'key');
@endphp
<?=form_dropdown($name_id, $options, $value, 'id="' . $name_id . '" class="form-control select2"')?>

