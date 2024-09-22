
@php
$name_id = str_replace(['[', ']', '#'], ['', '', ''], @$name);

$nameEle = $name;
$value = isJson($value) ? json_decode($value, true) : $value;
$strView = $value;

if(isset($setting))
{
    $optoin_setting = isJson($setting) ? json_decode($setting) : @$setting;
    $table = substr($optoin_setting->table, strpos($optoin_setting->table, "_") + 1);
    if(!empty($optoin_setting->multiple)) {
        $multiple = ' multiple';
        $nameEle = $nameEle . '[]';
    }
    if($table=="roups") $table="groups";
    if(!empty($_SESSION['display_view']['field_by_id_' . $table])) {
        $options = $_SESSION['display_view']['field_by_id_' . $table];
    } else {
        $options = get_data_options($table, [
            'field' => ['id', $optoin_setting->field],
            'val' => ['id', $optoin_setting->field],
            'empty_val'=>@$optoin_setting->empty_value]
        );
    }
}
@endphp
<?=form_dropdown($nameEle, $options??[], @$value, 'id="' . @$name_id . '" class="form-control select2" '.  @$multiple . ($required?' data-required=1':'') )?>

