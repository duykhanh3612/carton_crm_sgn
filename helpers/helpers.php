<?php

use App\Helpers\LogHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

const response_ok = 200;
const response_created = 201;
const response_bad_request = 400;
const response_unauthorized = 401;
const response_method_not_allowed = 405;
const response_too_many_requests = 429;


if (!function_exists('get_data')) {
    function get_data($table, $where = null, $field = "*", $order = "id desc", $object = true)
    {
        // dd($table, $where, $field);
        $query = Db::table($table);
        if (!empty($where)) {
            if (!is_array($where)) {
                $query = $query->whereRaw($where);
            } else {
                $query = $query->where($where);
            }
        }
        if (!empty($order)) {
            if (!is_array($order)) {
                $query = $query->orderByRaw($order);
            } else {
                $query = $query->orderBy($order);
            }
        }

        if ($field == "**") {
            return $object ? $query->get() : convert_data($query->get());
        }
        if ($field == "*") {
            return $object ? $query->first() : convert_data($query->first());
        }
        $record = $query->first();
        return @$record->{$field};
    }
}
if (!function_exists('change_status')) {
    function change_status($id, $value, $field, $name = '', $one_sel = false, $style = '', $disabled = false, $table = '', $class = '', $classEvent = 'change-status')
    {
        return '<div data-table="' . $table . '" data-id="' . $id . '" data-field="' . $field . '" data-name="' . $name . '" title="' . $name . '" class="' . $classEvent . ($disabled ? ' disabled' : '') . ' icon  ' . ($value == 1 ? 'check' : 'unchecked') . ($one_sel ? ' one_select' : '') . ' check_edit' . ($class ? ' ' . $class : '') . '"' . ($style ? ' style="' . $style . '"' : '') . '></div>';
    }
}
if (!function_exists('get_data_options')) {
    function get_data_options($table = '', $option = array())
    {
        $ci = Db::table($table);
        if ($table == '') {
            $table = $GLOBALS['var']['act'];
        }
        if (Schema::hasTable($table)) {
            $options = array();
            if (empty($option['field'])) {
                $option['field'] = is_array($option['val']) ? implode(",", $option['val']) ?? 'id, name' : "id," . $option['val'];
            }
            if (empty($option['where'])) {
                $option['where'] = 'deleted = 0';
            }
            if (empty($option['order_by'])) {
                $option['order_by'] = 'id desc';
            }
            if (!isset($option['empty_val'])) {
                $option['empty_val'] = true;
            }
            if (empty($option['key'])) {
                $option['key'] = 'id';
            }
            if (empty($option['val'])) {
                $option['val'] = 'name';
            }
            // $ci->db->query('SET NAMES "LATIN1"');
            if (is_array($option['field'])) {
                $ci->addSelect($option['field']);
            } else {
                $ci->selectRaw($option['field']);
            }
            $ci->whereRaw($option['where']);
            if (!empty($option['whereRaw'])) {
                $ci->where($option['whereRaw']);
            }
            $ci->orderByRaw($option['order_by']);
            $query = $ci;
            if ($option['empty_val']) {
                $options[''] = is_bool($option['empty_val']) ? 'Select ...' : $option['empty_val'];
            }
            if ($query->count() > 0) {
                foreach ($query->get() as $row) {
                    $row = (array)$row;
                    $options[$row[$option['key']]] = (is_array($option['val']) ? ($row[$option['val'][0]] ? $row[$option['val'][0]] . ($row[$option['val'][1]] ? ' - ' : '') : '') . ($row[$option['val'][1]] ? $row[$option['val'][1]] : '') : $row[$option['val']]);
                }
            }
            return $options;
        } else {
            return [];
        }
    }
}
function get_options_keynum_data($Field = '')
{
    $options = get_data('option_items_keynum', 'Field = "' . $Field . '" AND active = 1 AND deleted = 0', 'Options');
    if ($options) {
        $options = collect(json_decode($options, true))->pluck("name", "key")->toArray();
        return $options;
    }
    return [];
}
if (!function_exists('get_options_keynum')) {
    function get_options_keynum($Field = '', $selected = array(), $extra = '', $name = '', $empty_val = false, $empty_title = null)
    {
        if (!$name) {
            $name = $Field;
        }
        if (!is_array($selected)) {
            $selected = array($selected);
        }
        if (count($selected) === 0) {
            if (isset($_POST[$name])) {
                $selected = array($_POST[$name]);
            }
        }
        if ($extra != '') $extra = ' ' . $extra;
        $multiple = strpos($extra, 'multiple') != FALSE ? ' multiple="multiple"' : '';
        $form = '<select name="' . $name . '"' . $extra . $multiple . ">\n";
        if (($multiple && isset($key)) || !$multiple) {
            $sel = (in_array('', $selected)) ? ' selected="selected"' : '';
            if (!$empty_val) {
                $form .= '<option value=""' . $sel . '>' . ($empty_title ?? 'Select ...') . "</option>\n";
            }
        }
        $Options = get_data('option_items_keynum', 'Field = "' . $Field . '" AND active = 1 AND deleted = 0', 'Options');
        if ($Options) {
            $options = json_decode($Options);
            foreach ($options as $val) {
                $key = $val->key;
                if (($multiple && $key) || !$multiple) {
                    $sel = (in_array($key, $selected)) ? ' selected="selected"' : '';
                    $form .= '<option value="' . $key . '"' . $sel . '>' . (string)$val->name . "</option>\n";
                }
            }
        }
        $form .= '</select>';
        return $form;
    }
}
if (!function_exists('get_options_keynum_name')) {
    function get_options_keynum_name($Field = '', $selected = array(), $extra = '', $name = '', $empty_val = false)
    {
        if (!$name) {
            $name = $Field;
        }
        if (!is_array($selected)) {
            $selected = array($selected);
        }
        if (count($selected) === 0) {
            if (isset($_POST[$name])) {
                $selected = array($_POST[$name]);
            }
        }
        if ($extra != '') $extra = ' ' . $extra;
        $multiple = strpos($extra, 'multiple') != FALSE ? ' multiple="multiple"' : '';
        $form = '<select name="' . $name . '"' . $extra . $multiple . ">\n";
        if (($multiple && isset($key)) || !$multiple) {
            $sel = (in_array('', $selected)) ? ' selected="selected"' : '';
            if (!$empty_val) {
                $form .= '<option value=""' . $sel . '>Select ...' . "</option>\n";
            }
        }
        $Options = get_data('option_items_keynum', 'Module = "' . $Field . '" AND active = 1 AND deleted = 0', '**');
        //        print_r($Options);
        if ($Options) {
            //            $options = json_decode($Options);
            foreach ($Options as $val) {
                //                $key = (int)$val->key;
                if (($multiple && $key) || !$multiple) {
                    $sel = (in_array($key, $selected)) ? ' selected="selected"' : '';
                    $form .= '<option value="' . $val['id'] . '"' . $sel . '>' .  $val['Name'] . "</option>\n";
                }
            }
        }
        $form .= '</select>';
        return $form;
    }
}
if (!function_exists('component')) {
    function component($type, $option = [])
    {
        $path = "atc::components/";
        switch ($type) {
            case 'department_employee':
                $path .= "input/department_employee";
                break;
            case 'left_navigation':
                $path .= "left_navigation";
                break;
            case 'input_left_navigation':
                $path .= "input/left_navigation";
                break;
            case 'select':
                $path .= "input/select";
                break;
            case 'menu_top':
                $path .= "input/menu_top";
                break;
            case 'approved_log':
                $path .= "input/approved_log";
                break;
            case 'documents':
                $path .= "input/documents";
                break;
            case 'approved':
                $path .= "input/approved";
                if (!isset($option['module'])) $option['module'] = $GLOBALS['var']['act'];
                break;
            case 'charts':
                $path .= "charts/" . $option['type'];
                break;
            case 'display_part':
                $path .= "input/display_part";
                break;
            case 'display_view':
                $path .= "input/display_config/view";
                break;
            case 'date_selector':
                $path .= "input/datepicker/date_selector";
                break;
            case 'data_logs':
                $path .= "input/data_logs";
                if (!isset($option['module'])) $option['module'] = $GLOBALS['var']['act'];
                break;
            default:
                return "";
                break;
        }
        if (!is_string($path)) {
            return false;
        }
        $option['component_id'] = $option['id'] ?? @$option['name'];
        $option['com_data'] = json_decode(json_encode($option));
        $option['class'] = $option['class'] ?? "";
        $option['required'] = $option['required'] ?? "";
        return view($path, $option);
    }
}
if (!function_exists('col_filter')) {
    function col_filter($col, $key, $filter, $options = false)
    {
        if (!is_object($col)) {
            return '';
        }
        $html = '';

        $show = isset($col->show) && $col->show;
        if ($GLOBALS['var']['q']) {
            $show = isset($col->search_show) && $col->search_show;
        }

        if ($show) {

            $html .= '<th class="thft-' . $key . '" style="width: ' . (isset($col->width) ? $col->width : 100 . 'px') . '; min-width: ' . (isset($col->width) ? $col->width : 100 . 'px') . '; max-width: ' . (isset($col->width) ? $col->width : 100 . 'px') . ';">';
            if (isset($col->filter) && $col->filter) {
                $current_val = isset($filter[$key]) ? (is_array($filter[$key]) ? $filter[$key] : htmlspecialchars($filter[$key])) : '';
                if ($col->filter == 'text') {
                    $html .= '<input type="text" name="filter[' . $key . ']" value="' . $current_val . '" class="form-control"/>' . ($current_val ? '<i class="icon glyphicons remove"></i>' : '');
                }
                if ($col->filter == 'date') {
                    $html .= '<input  type="text" name="filter[' . $key . ']" value="' . $current_val . '" class="form-control date"/>' . ($current_val ? '<i class="icon glyphicons remove"></i>' : '');
                }
                if ($col->filter == 'date_range') {
                    $html .= '<div id="datepicker"><div class="input-daterange input-group" id="datepicker"><input  type="text" name="filter[' . $key . '][from]" value="' . (isset($current_val['from']) ? $current_val['from'] : '') . '" class="form-control" style="width: 50%; display: inline-block;"/><input type="text" name="filter[' . $key . '][to]" value="' . (isset($current_val['to']) ? $current_val['to'] : '') . '" class="form-control" style="width: 50%; display: inline-block;"/></div></div>' . ((isset($current_val['from']) && $current_val['from']) || (isset($current_val['to']) && $current_val['to']) ? '<i class="icon glyphicons remove"></i>' : '');
                }
                if (in_array($col->filter, ['select', 'color', 'field_by_id'])) {
                    if ($col->filter == 'color') {
                        $options = !empty($col->setting) ? get_data_options('orders_status', ['where' => 'type = "' . $col->setting . '" AND deleted = 0', 'field' => ['StatusKey', 'name'], 'key' => 'StatusKey', 'order_by' => 'id ASC']) : [];
                    }
                    if ($col->filter == 'field_by_id') {
                        if (@$col->setting != "") {
                            $setting = json_decode($col->setting, true);
                            $table = substr($setting['table'], strpos($setting['table'], "_") + 1);
                            $where = $table == 'users' ? 'activated = 1' : 'active = 1';
                            $options = !empty($col->setting) ? get_data_options($table, ['field' => ['id', $setting['field']], 'val' => ['id', $setting['field']], 'where' => $where]) : [];
                        } else {
                            $options = "";
                        }
                    }
                    if (is_array($options) && count($options)) {
                        $html .= form_dropdown('filter[' . $key . ']', $options, $current_val, 'id="' . $key . '" class="form-control select2"', [], ($col->filter == 'color' ? $col->setting : ''));
                    } else {
                        $html .= get_options($key, $current_val, 'id="' . $key . '" class="form-control select2"', 'filter[' . $key . ']');
                    }
                }
                if ($col->filter == "option_items_keynum") {
                    $html .=  get_options_keynum($col->format, $current_val, 'class="form-control select2"', 'filter[' . $key . ']', false, "Select...");
                }
            }
            $html .= '</th>';
        }

        return $html;
    }
}
if (!function_exists('col_val')) {
    function col_val($col, $key, $val, $id = 0, $edit_link = '')
    {
        if (!is_object($col)) {
            return '';
        }
        $html = '';
        $show = isset($col->show) && $col->show;
        if ($GLOBALS['var']['q']) {
            $show = isset($col->search_show) && $col->search_show;
        }
        if (!isset($col->type)) $col->type  = "";
        if ($show) {
            $html .= '<td class="' . (isset($col->nowrap) ? 'nowrap' : '') . ' ' . $key . '' . (isset($col->align) ? ' ' . $col->align : '') . '" ' . (!empty($col->width) ? 'style="width: ' . $col->width . '; min-width: ' . $col->width . '; max-width: ' . $col->width . ';"' : '') . '>';
            $html .= (isset($col->link) ? '<a href="' . ($edit_link ? $edit_link  .'" class="link"': 'javascript:;" class="updateLink" data-id="' . $id) . ' target="_blank">' : '');
            if ($col->type == 'text') {
                if (isset($col->format) && $col->format  != '') {
                    $html .=  @number_format($val, $col->format);
                } else {
                    $html .= $val;
                }
            } else if ($col->type == 'text_input') {
                if (isset($col->format) && $col->format != '' && $GLOBALS['var']['do'] != 'prints') {
                    $html .= '<input type="text" name="' . $key . '" class="form-control money ' . $key . '" value="' . $val . '"/>';
                } else {
                    $html .=  @number_format($val, $col->format);
                }
            } else if ($col->type == 'color') {
                $html .=  '<div style="background: ' . $val . '; color: #fff; padding: 3px 5px; border-radius: 3px;">' . $val . '</div>';
            } else if ($col->type == 'check' || $col->type == 'check_edit') {
                $html .= change_status($id, $val, $key, '', '', '', $col->type != 'check_edit');

            } else if ($col->type == 'field_by_id') {
                $value= $val;
                if (!empty($col->setting)) {
                    $setting = json_decode($col->setting, true);
                    $id = isJson($value) ? json_decode($value, true) : $value;
                    $strView = $value;
                    if (!empty($setting['show_id']) && !empty($setting['show_field'])) {
                        $strView = getFieldById($id, $setting['field'], $setting['table'], 'full');
                    } else if (empty($setting['show_id']) && !empty($setting['show_field'])) {
                        $strView = getFieldById($id, $setting['field'], $setting['table'],'',false,$col->format);
                    }

                    if($col->format == "badge")
                    {
                        $view = "<div class='d-flex' style='gap:5px;'>$strView</div>";
                    }
                    else $view = "<span title=\"$strView\">$strView</span>";

                } else {
                    $view = $value;
                }
                $html .= $view;
            } else if ($col->type == 'image') {
                $html .= show_img($val, '', 'max-width:35px; max-height:35px;');
            } else {
                $html .= $val;
            }
            $html .=  (isset($col->link) ? '</a>' : '');
            $html .= '</td>';
        }
        return $html;
    }
}
if (!function_exists('url_uri')) {
    function url_uri($uri, $remove = array())
    {
        $string = '';
        if (is_array($uri)) {
            foreach ($uri as $key => $value) {
                if ($value != '') {
                    if ((is_array($remove) && !in_array($key, $remove)) || (!is_array($remove) && $key != $remove)) {
                        $string .= ($string == '' ? '?' : '&') . (is_array($key) ? "" : $key) . '=' . (is_array($value) ? "" : $value);
                    }
                }
            }
        } else if ($uri) {
            $string .= '?' . $uri;
        }
        return $string;
    }
}
function my_redirect($uri = "/")
{
    return redirect("admin/" . $uri);
}
if (!function_exists('url_title')) {
    function url_title($str, $separator = '-', $lowercase = FALSE)
    {
        if ($separator == 'dash') {
            $separator = '-';
        } else if ($separator == 'underscore') {
            $separator = '_';
        }
        $q_separator = preg_quote($separator);
        $trans = array(
            '&.+?;'                 => '',
            '[^a-z0-9 _-]'          => '',
            '\s+'                   => $separator,
            '(' . $q_separator . ')+'   => $separator
        );
        $str = strip_tags($str);
        foreach ($trans as $key => $val) {
            $str = preg_replace("#" . $key . "#i", $val, $str);
        }
        if ($lowercase === TRUE) {
            $str = strtolower($str);
        }
        return trim($str, $separator);
    }
}
if (!function_exists('viet_decode')) {
    function viet_decode($str)
    {
        $chars = array(
            'a' => array('ấ', 'ầ', 'ẩ', 'ẫ', 'ậ', 'Ấ', 'Ầ', 'Ẩ', 'Ẫ', 'Ậ', 'ắ', 'ằ', 'ẳ', 'ẵ', 'ặ', 'Ắ', 'Ằ', 'Ẳ', 'Ẵ', 'Ặ', 'á', 'à', 'ả', 'ã', 'ạ', 'â', 'ă', 'Á', 'À', 'Ả', 'Ã', 'Ạ', 'Â', 'Ă'),
            'e' => array('ế', 'ề', 'ể', 'ễ', 'ệ', 'Ế', 'Ề', 'Ể', 'Ễ', 'Ệ', 'é', 'è', 'ẻ', 'ẽ', 'ẹ', 'ê', 'É', 'È', 'Ẻ', 'Ẽ', 'Ẹ', 'Ê'),
            'i' => array('í', 'ì', 'ỉ', 'ĩ', 'ị', 'Í', 'Ì', 'Ỉ', 'Ĩ', 'Ị'),
            'o' => array('ố', 'ồ', 'ổ', 'ỗ', 'ộ', 'Ố', 'Ồ', 'Ổ', 'Ỗ', 'Ô', 'Ộ', 'ớ', 'ờ', 'ở', 'ỡ', 'ợ', 'Ớ', 'Ờ', 'Ở', 'Ỡ', 'Ợ', 'ó', 'ò', 'ỏ', 'õ', 'ọ', 'ô', 'ơ', 'Ó', 'Ò', 'Ỏ', 'Õ', 'Ọ', 'Ô', 'Ơ'),
            'u' => array('ứ', 'ừ', 'ử', 'ữ', 'ự', 'Ứ', 'Ừ', 'Ử', 'Ữ', 'Ự', 'ú', 'ù', 'ủ', 'ũ', 'ụ', 'ư', 'Ú', 'Ù', 'Ủ', 'Ũ', 'Ụ', 'Ư'),
            'y' => array('ý', 'ỳ', 'ỷ', 'ỹ', 'ỵ', 'Ý', 'Ỳ', 'Ỷ', 'Ỹ', 'Ỵ'),
            'd' => array('đ', 'Đ'),
            '' => array('–', '?', '"', ':', '<', '>', '/', '\\', '{', '}', '{', '[', ']', '$', '%', '^', '&', '*', '(', ')', '!')
        );
        foreach ($chars as $key => $arr) {
            foreach ($arr as $val) {
                $str = str_replace($val, $key, $str);
            }
            unset($arr);
        }
        unset($chars);
        return trim($str);
    }
}


if (!function_exists('trimlink')) {
    function trimlink($text, $length, $html = true)
    {
        $dec = array("&", "\"", "'", "\\", '\"', "\'", "<", ">");
        $enc = array("&amp;", "&quot;", "&#39;", "&#92;", "&quot;", "&#39;", "&lt;", "&gt;");
        if ($html) $text = str_replace($enc, $dec, $text);
        if (strlen($text) > $length) {
            $len = 0;
            $arr = explode(' ', $text);
            $newtext = '';
            if (sizeof($arr) > 1) {
                for ($i = 0; $i < sizeof($arr); $i++) {
                    if ($len < $length - 3) {
                        $newtext .= $arr[$i] . " ";
                        $len += strlen($arr[$i]) + 1;
                    }
                }
            } else {
                $newtext = substr($arr[0], 0, $length);
            }
            unset($i, $len, $arr, $dec, $enc);
            return $newtext . "...";
        } else {
            unset($dec, $enc);
            return $text;
        }
    }
}
if (!function_exists('col_name')) {
    function col_name($col, $key = '')
    {
        if (!is_object($col)) {
            return '';
        }
        $html = '';
        $show = isset($col->show) && $col->show;
        // if ($GLOBALS['var']['q']) {
        // 	$show = isset($col->search_show) && $col->search_show;
        // }

        $width = "";
        if(@$col->width!="0")
        {
            $width = '"width: ' . (isset($col->width) ? $col->width : 100 . 'px') . '; min-width: ' . (isset($col->width) ? $col->width : 100 . 'px') . '; max-width: ' . (isset($col->width) ? $col->width : 100 . 'px') .";";
        }
        $class = "";
        if(isset($col->tab_group)) $class .= ' ' . $col->tab_group. ' ';
        if ($show) {
            $html .= '<th data-field="'.$key.'"' . (isset($col->nowrap) ? ' nowrap="nowrap"' : '') .  ' class="head ' . (isset($key) ? $key . ' ' : '') . $class .  (isset($col->align) ? '' . $col->align : '') . (isset($col->header_class) ? ' ' . $col->header_class : '')  .(@$col->sort?'':' unorderable'). '"' . ' style="'. $width . '">' . ($key && isset($col->sort) && $GLOBALS['var']['do'] != 'prints' ? create_sort($key) : '') . (isset($col->name) ? $col->name : '') . '</th>';
        }
        return $html;
    }
}
if (!function_exists('sel_item')) {
    function sel_item($id, $disable = false, $checked = false, $name = 'element')
    {
        return '<input type="checkbox" class="cb-element custom-checkbox" name="' . $name . '[]" id="sel_item' . $id . '" value="' . $id . '"' . ($checked ? ' checked="checked"' : '') . '' . ($disable ? ' disabled="disabled"' : '') . ' />';
    }
}
if (!function_exists('no_data_mes')) {
    function no_data_mes($colspan = '')
    {
        return '<tr class="empty-row"><td class="center"' . ($colspan ? ' colspan="' . $colspan . '"' : '') . ' style="height: 100px; font-size:16px; text-align:center;"><span class="small" style="color: red;"><strong>Không có dữ liệu!</strong></span></td></tr>';
    }
}
if (!function_exists('form_dropdown')) {
    function form_dropdown($name = '', $options = array(), $selected = array(), $extra = '', $disable = [])
    {
        if (!is_array($selected)) {
            $selected = array($selected);
        }
        // If no selected state was submitted we will attempt to set it automatically
        if (count($selected) === 0) {
            // If the form name appears in the $_POST array we have a winner!
            if (isset($_POST[$name])) {
                $selected = array($_POST[$name]);
            }
        }
        if ($extra != '') $extra = ' ' . $extra;
        $multiple = (count($selected) > 1 && strpos($extra, 'multiple') === FALSE) ? ' multiple="multiple"' : '';
        $form = '<select name="' . $name . '"' . $extra . $multiple . ">\n";
        if (!empty($options) && is_array($options)) {
            foreach ($options as $key => $val) {
                $key = (string) $key;
                if (is_array($val) && !empty($val)) {
                    $form .= '<optgroup label="' . $key . '">' . "\n";
                    foreach ($val as $optgroup_key => $optgroup_val) {
                        if (($multiple && $optgroup_key) || !$multiple) {
                            $sel = (in_array($optgroup_key, $selected)) ? ' selected="selected"' : '';
                            $form .= '<option value="' . $optgroup_key . '"  ' . $sel . '>' . (string)$optgroup_val . "</option>\n";
                        }
                    }
                    $form .= '</optgroup>' . "\n";
                } else {
                    if (($multiple && $key) || !$multiple) {
                        $sel = (in_array($key, $selected)) ? ' selected="selected"' : '';
                        $form .= '<option ' . (!empty($disable) && in_array($key, $disable) ? "disabled" : '') . ' value="' . $key . '"' . $sel . '>' . (string)$val . "</option>\n";
                    }
                }
            }
        }

        $form .= '</select>';
        return $form;
    }
}
if (!function_exists('convert_data')) {
    function convert_data($value, $flag = false)
    {
        return json_decode(json_encode($value), $flag);
    }
}

if (!function_exists('convert_decimal')) {
    function convert_decimal($value)
    {
        return floatval(str_replace(",","",$value));
    }
}
if (!function_exists('array_undot')) {
    function array_undot($dotNotationArray)
    {
        $array = [];
        foreach ($dotNotationArray as $key => $value) {
            data_set($array, $key, $value);
        }
        return $array;
    }
}
if (!function_exists('get_response_code')) {
    function get_response_code($flag, $code, &$result, $message = null)
    {
        if ($flag) {
            $result["code"] = 200;
            $result["success"] = true;
        } else {
            switch ($code) {
                case 400:
                    $result["code"] = 400;
                    $result["success"] = false;
                    if ($message != null) {
                        $result["message"] = $message;
                    }
                    break;
                case 401:
                    $result["code"] = 400;
                    $result["success"] = false;
                    if ($message != null) {
                        $result["message"] = $message;
                    }
                    break;
                default:
                    $result["code"] = 200;
                    $result["success"] = true;
                    break;
            }
        }
    }
}
if (!function_exists('crypt')) {
    /**
     * String crypt
     *
     * @param  mixed $string
     * @param  mixed $action
     * @return void
     */
    function crypt($string, $action = 'e')
    {
        // you may change these values to your own
        if ($action == 'e') {
            $string = $string . env('APP_NAME');
        }
        $secret_key = 'my_simple_secret_key';
        $secret_iv = 'my_simple_secret_iv';
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        if ($action == 'e') {
            $output = base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
        } else if ($action == 'd') {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
        if ($action == 'd') {
            $output = str_replace(env('APP_NAME'), '', $output);
        }
        return $output;
    }
}
if (!function_exists('dateDifference')) {
    function dateDifference($start_date, $end_date, $date_format = NULL)
    {
        // calulating the difference in timestamps
        $diff = strtotime($start_date) - strtotime($end_date);
        // 1 day = 24 hours
        // 24 * 60 * 60 = 86400 seconds
        $result = "";
        switch ($date_format) {
            case 'day':
                $result = ceil(abs($diff / 86400));
                break;
            case 'mpsg':
                $minu = intval(abs($diff / 60));
                $sec = ($diff % 60);
                $result = ($minu > 0 ? $minu . ' phút ' : '') . ($sec != 0 ? $sec . ' giây' : '');
                break;
            case "i":
                $sec = ($diff % 60);
                $result = round(abs($diff / 60), 0);
                break;
            case 's':
                $result = ceil(abs($diff));
                break;
            default:
                $result = ceil(abs($diff / 86400));
                break;
        }
        return  $result;
    }
}
if (!function_exists('diff_in_days')) {
    function diff_in_days($fdate, $tdate)
    {
        $datetime1 = strtotime($fdate); // convert to timestamps
        $datetime2 = strtotime($tdate); // convert to timestamps
        $days = (int)(($datetime2 - $datetime1) / 86400);
        return  $days;
    }
}
if (!function_exists('log_helper')) {
    /**
     * LogHelper
     *
     * @param  mixed $name
     * @param  mixed $message
     * @return void
     */
    function log_helper($data, $message, $file = null)
    {
        $backtraces = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 5);
        $name = @$backtraces[1]["function"];
        $class = @$backtraces[1]["class"];
        $line  = @$backtraces[0]["line"];
        LogHelper::write($data, $class . "::" . $name . ':Line::' . $line . '::' . $message . "::", $file);
    }
}
if (!function_exists('log_write')) {
    /**
     * LogHelper
     *
     * @param  mixed $name
     * @param  mixed $message
     * @return void
     */
    function log_write($data, $message, $file = null, $tracking = "")
    {
        $backtraces = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 10);
        $name = @$backtraces[1]["function"];
        $class = @$backtraces[1]["class"];
        $line  = @$backtraces[0]["line"];
        LogHelper::write($data, $class . "::" . $name . ':Line::' . $line . '::' . $message . "::", $file, $tracking);
    }
}
function getThrowable($e)
{
    return [
        'File' => $e->getFile(),
        'Line' => $e->getLine(),
        'Message' => $e->getMessage(),
        'Result' => $e->getLine()."::".$e->getMessage()
    ];
}
function throwException($message, $link = ""){
    try{
        $body = urlencode($message);
        $link = url("app/confirm");
        \h::http_response("https://wirepusher.com/send?id=ZpammpsdA&title=DynApp&message=$body&type=confirm&action=$link", [], null, "GET");
    }
    catch(\Throwable $e)
    {
        log_write($e->getMessage(),"Helper::throwException");
    }
}
function log_write_exception($e, $key = null)
{
    if($key == null)
    {
        $key  = get_caller_info();
    }
    log_write(getThrowable($e), $key );
}


function get_caller_info() {
    $c = '';
    $file = '';
    $func = '';
    $class = '';
    $trace = debug_backtrace();
    if (isset($trace[2])) {
        $file = $trace[1]['file'];
        $func = $trace[2]['function'];
        if ((substr($func, 0, 7) == 'include') || (substr($func, 0, 7) == 'require')) {
            $func = '';
        }
    } else if (isset($trace[1])) {
        $file = $trace[1]['file'];
        $func = '';
    }
    if (isset($trace[3]['class'])) {
        $class = $trace[3]['class'];
        $func = $trace[3]['function'];
        $file = $trace[2]['file'];
    } else if (isset($trace[2]['class'])) {
        $class = $trace[2]['class'];
        $func = $trace[2]['function'];
        $file = $trace[1]['file'];
    }
    if ($file != '') $file = basename($file);
    $c = $file . ": ";
    $c .= ($class != '') ? ":" . $class . "->" : "";
    $c .= ($func != '') ? $func . "(): " : "";
    return($c);
}
function upload($value, $path_upload = NULL, $alias = NULL)
{
    $path_base =  'public/' . ($alias != NULL ? $alias . '/' : '');
    if ($path_upload == "") $path_upload = "upload/img";
    else {
        if (!file_exists(base_path($path_base . $path_upload))) {
            mkdir(base_path($path_base . $path_upload), 0700, true);
        }
    }
    $data = array();
    foreach ($value as $n => $file) {
        if (is_array($file)) {
            $f_name = array();
            foreach ($file as $f) {
                $name = $f->getClientOriginalName();
                $path = $path_upload . '/' . $name;
                $_parts = pathinfo($path);
                $i = 1;
                do {
                    $flg = file_exists($path_base . $path);
                    if ($flg) {
                        $name = $_parts['filename'] . '_' . $i . '.' . @$_parts['extension'];
                        $path = $path_upload . '/' . $name;
                        $i++;
                    }
                } while ($flg);
                $f_name[] = $path;
                $f->move($path_base . $path_upload, $name);
            }
            $data[$n]  = json_encode($f_name);
        } else {
            $name = $file->getClientOriginalName();
            $path = $path_upload . '/' . $name;
            $_parts = pathinfo($path);
            $i = 1;
            do {
                $flg = file_exists($path_base . $path);
                if ($flg) {
                    $name = $_parts['filename'] . '_' . $i . '.' . @$_parts['extension'];
                    $path = $path_upload . '/' . $name;
                    $i++;
                }
            } while ($flg);
            $data[$n] = $path;
            $file->move(base_path($path_base) . $path_upload, $name);
        }
    }
    return $data;
}
function upload_file($file, $path_upload = NULL)
{
    try{
        $path_base =  env("APP_PATH");
        if ($path_upload == "") $path_upload = "upload/img";
        else {
            if (!file_exists(base_path($path_base . $path_upload))) {
                mkdir(base_path($path_base . $path_upload), 0700, true);
            }
        }
        $data = array();
        $name = $file->getClientOriginalName();
        $path = $path_upload . '/' . $name;
        $_parts = pathinfo($path);
        $i = 1;
        do {
            $flg = file_exists($path_base . $path);
            if ($flg) {
                $name = $_parts['filename'] . '_' . $i . '.' . @$_parts['extension'];
                $path = $path_upload . '/' . $name;
                $i++;
            }
        } while ($flg);
        $data = $path;
        $file->move(base_path($path_base) . $path_upload, $name);

        return $data;
    }
    catch(Throwable $e)
    {
        log_write_exception($e,"up_file");
    }
}
function getServerTimeOffset($timezone = 'UTC')
{
    $currentTz = date_default_timezone_get();
    $current = timezone_open($timezone);
    $serverTime  = new \DateTime('now', new \DateTimeZone($currentTz));
    $offset =  timezone_offset_get($current, $serverTime);
    return $offset;
}
function convertToServerHour($timezone = 'UTC', $hour = '00:00')
{
    $offset = getServerTimeOffset($timezone);
    $minute = '00';
    if (is_string($hour)) {
        $hourMinute = ltrim($hour, '0');
        $hour = explode(':', $hourMinute)[0];
        $minute = explode(':', $hourMinute)[1];
        $minute = substr($minute, 0, 2);
        if (!$minute) {
            $minute = '00';
        }
    }
    $hour = (int) $hour;
    if (!$hour) $hour = 24;
    $hour = $hour * 3600;
    $serverHour = $hour - $offset;
    $serverHour = $serverHour / 3600;
    if ($serverHour > 23) {
        $serverHour = $serverHour - 24;
    }
    if ($serverHour < 0) {
        $serverHour = $serverHour + 24;
    }
    return $serverHour . ':' . $minute;
}
if (!function_exists('buildFullAddress')) {
    function buildFullAddress($city, $state, $country, $zip)
    {
        $address = $city;
        if ($state) {
            $address .= ", $state";
        }
        if ($country) {
            $address .= ", $country";
        }
        if ($zip) {
            $address .= " $zip";
        }
        return $address;
    }
}
if (!function_exists('cleanSpecialChars')) {
    function cleanSpecialChars($string)
    {
        return preg_quote(trim($string));
    }
}
if (!function_exists('classShortName')) {
    function classShortName(string $class): string
    {
        return substr(strrchr($class, "\\"), 1);
    }
}
if (!function_exists('user_setting')) {
    function user_setting($key, $default = null)
    {
        $settings = \App\Models\UserSetting::getAllSettings();
        return Arr::get($settings, $key, $default);
    }
}
if (!function_exists('update_setting')) {
    function update_setting($key, $default = null)
    {
        if ($default != "") {
            \App\Models\UserSetting::updateOrCreate(
                ['hs_key' => $key],
                ['hs_val' => $default]
            );
        }
    }
}
if (!function_exists('getDistanceFromPositions')) {
    function getDistanceFromPositions($lat1, $lng1, $lat2, $lng2)
    {
        try {
            $theta = $lng1 - $lng2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $dist = $dist * 60 * 1.1515;
            return $dist;
        } catch (Exception $e) {
            return 0;
        }
    }
}
if (!function_exists('getLatLong')) {
    function getLatLong($address, $postcode = false)
    {
        $settings = \App\Models\UserSetting::getAllSettings();
        $key = Arr::get($settings, 'google_geocoding_api_key', '');
        $array = ['latitude' => null, 'longitude' => null];
        if (!$key || !$address) {
            return $array;
        }
        $uri = 'https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address) . '&sensor=false&key=' . $key;
        $geo = file_get_contents($uri);
        // We convert the JSON to an array
        $geo = json_decode($geo, true);
        $arrLogger = [
            'address' => $address,
            'uri' => $uri,
            'geo' => $geo,
            'result_google' => $array
        ];
        // If everything is cool
        $checkPostCode = Arr::where($geo['results'][0]['address_components'], function ($type) {
            if ($type['types'][0] == 'postal_code') {
                return $type;
            }
        });
        $checkPostCode = array_values($checkPostCode);
        if ($geo['status'] == 'OK') {
            $latitude = @$geo['results'][0]['geometry']['location']['lat'];
            $longitude = @$geo['results'][0]['geometry']['location']['lng'];
            $array = ['latitude' => $latitude, 'longitude' => $longitude];
            $arrLogger['result_google'] = $array;
            if ($postcode == true) {
                if ($checkPostCode[0]['long_name'] == $address || $checkPostCode[0]['short_name'] == $address) {
                    return $array;
                } else {
                    return null;
                }
            }
        }
        if ($geo['status'] == 'ZERO_RESULTS' && $postcode == true) {
            return null;
        }
        LogHelper::write($arrLogger, 'getLatLong::reault:');
        return $array;
    }
}
if (!function_exists('formatAmount')) {
    function formatAmount($amount, $decimal = 2)
    {
        if (!is_numeric($amount)) {
            return 0;
        }
        return (float)number_format($amount, $decimal, '.', '');
    }
}
if (!function_exists('write_log')) {
    function write_log($data, $key = null, $clientId = 0)
    {
        LogHelper::write($data, $key, $clientId);
    }
}

use App\Models\Hyperspace\Process;

if (!function_exists('hs_process')) {
    function hs_process(callable $callback, string $key, $ids = [])
    {
        if ($ids) {
            $md5 = md5(json_encode($ids));
            $processOptions = [
                'id' => config("constants.process.{$key}_selected") . $md5,
                'name' => config("constants.process.{$key}_selected_title")
            ];
        } else {
            $processOptions = [
                'id' => config("constants.process.{$key}"),
                'name' => config("constants.process.{$key}_title")
            ];
        }
        $process = new Process($processOptions);
        if ($process->isRunning()) {
            return '<p>Another process is already utilizing. This could be an automatic process or a process initiated by another employee.</p><p>Please check back later to run your process.</p>';
        }
        $process->start();
        try {
            $result = $callback($process);
            $process->stop();
            return $result;
        } catch (Throwable $e) {
            write_log($e, "PROCESS_KEY:$key");
            optional($process)->stop();
            return 0;
        }
    }
}

use App\Models\NetSuite\OptionCustomType;
use Carbon\Carbon;

if (!function_exists('buildNSCustomField')) {
    function buildNSCustomField($id, $value, $type = null)
    {
        $ref = OptionCustomType::getTypeRef($id);
        if ($ref) {
            $column = 'internalId';
            if (!is_numeric($id)) {
                $column = 'scriptId';
            }
            $customField = new $ref();
            $customField->{$column} = $id;
            switch ($ref) {
                case "NetSuiteERP\LongCustomFieldRef":
                    $customField->value = (int)$value;
                    break;
                case "NetSuiteERP\DoubleCustomFieldRef":
                    $customField->value = filter_var($value, FILTER_VALIDATE_BOOLEAN);
                    break;
                case "NetSuiteERP\BooleanCustomFieldRef":
                    $customField->value = (bool)$value;
                    break;
                case "NetSuiteERP\SelectCustomFieldRef":
                    $fieldValue = new \NetSuiteERP\ListOrRecordRef();
                    $value = OptionCustomType::getSelectValueById($id, $value, $type);
                    $fieldValue->internalId = $value;
                    $customField->value = $fieldValue;
                    break;
                case "NetSuiteERP\DateCustomFieldRef":
                    $customField->value = Carbon::parse(strtotime($value))
                        ->format('Y-m-d\TH:i:s.vP');
                    break;
                default:
                    $customField->value = $value;
            }
            return $customField;
        }
    }
}
if (!function_exists('buildShopifyAddress')) {
    function buildShopifyAddress(array $address): string
    {
        if (empty($address)) {
            return '';
        }
        if (!empty($address['address1'])) {
            $street = $address['address1'];
        } elseif (!empty($address['address2'])) {
            $street = $address['address2'];
        }
        $zip = @$address['zip'];
        $city = @$address['city'];
        $state = @$address['province'];
        $country = @$address['country'];
        $fullAddress = $street . ', ' . $city . ', ' . $state . ' ' . $zip . ', ' . $country;
        return $fullAddress;
    }
}
if (!function_exists('exec_bg')) {
    function exec_bg($cmd)
    {
        if (substr(php_uname(), 0, 7) == "Windows") {
            pclose(popen("start /B " . $cmd, "r"));
        } else {
            exec($cmd . " > /dev/null &");
        }
    }
}
if (!function_exists('simpleXmlAppend')) {
    function simpleXmlAppend(SimpleXMLElement $parent, SimpleXMLElement $child)
    {
        $toDom = dom_import_simplexml($parent);
        $fromDom = dom_import_simplexml($child);
        $toDom->appendChild($toDom->ownerDocument->importNode($fromDom, true));
    }
}
if (!function_exists('simpleXmlSave')) {
    function simpleXmlSave(SimpleXMLElement $xml, string $filename)
    {
        if (!$filename) {
            return false;
        }
        $dom = dom_import_simplexml($xml)->ownerDocument;
        $dom->formatOutput = true;
        $dom->encoding = 'utf-8';
        return $dom->save($filename);
    }
}
if (!function_exists('cleanStr')) {
    function cleanStr($string)
    {
        $string = str_replace(' ', '', $string);
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
    }
}
if (!function_exists('netsuiteResponseError')) {
    function netsuiteResponseError($response)
    {
        if (is_string($response)) {
            return $response;
        }
        if (@$response->writeResponse && empty($response->writeResponse->status->isSuccess)) {
            foreach ($response->writeResponse->status->statusDetail as $detail) {
                if ($detail->type === 'ERROR') {
                    return $detail->message;
                }
            }
        }
    }
}
if (!function_exists('netsuiteCountryName')) {
    function netsuiteCountryName($code)
    {
        if ($code) {
            $mappedCodes = config('constants.country.netsuite_map');
            $countryCode = array_search($code, $mappedCodes);
            if ($countryCode) {
                $names = config('constants.country.names');
                if (isset($names[$countryCode])) {
                    return is_array($names[$countryCode]) ? end($names[$countryCode]) : $names[$countryCode];
                }
            }
            $code = \Str::snake(trim($code, '_'));
            $code = str_replace('_', ' ', $code);
            return \Str::title($code);
        }
    }
}
if (!function_exists('netsuiteAddrText')) {
    function netsuiteAddrText($address)
    {
        if (is_array($address)) {
            $address = (object)$address;
        }
        $data = [
            $address->addr1 ?? $address->addr2 ?? $address->addr3,
            $address->city,
            implode(' ', array_filter([$address->state, $address->zip])),
            netsuiteCountryName($address->country)
        ];
        $data = array_filter($data);
        return implode(', ', $data);
    }
}
if (!function_exists('splitNameToArray')) {
    function splitNameToArray($name)
    {
        $name = trim($name);
        $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
        $first_name = trim(preg_replace('#' . preg_quote($last_name, '#') . '#', '', $name));
        return array($first_name, $last_name);
    }
}
if (!function_exists('buildHRAddress')) {
    function buildHRAddress($address = [])
    {
        $data = [
            @$address['first_name'] . " " . @$address['last_name'],
            @$address['line_1'] . " " . @$address['line_2'],
            @$address['city'],
            @$address['state'] . " " . @$address['postal_code'],
        ];
        $data = array_map('trim', $data);
        $data = array_filter($data);
        return implode(', ', $data);
    }
}
function validateDate($date, $format = 'Y-m-d H:i:s')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}
function dateDifference($start_date, $end_date, $date_format = NULL)
{
    // calulating the difference in timestamps
    $diff = strtotime($start_date) - strtotime($end_date);
    // 1 day = 24 hours
    // 24 * 60 * 60 = 86400 seconds
    $result = "";
    switch ($date_format) {
        case 'day':
            $result = ceil(abs($diff / 86400)) . ' ng�y';
            break;
        case 'mpsg':
            $minu = intval(abs($diff / 60));
            $sec = ($diff % 60);
            $result = ($minu > 0 ? $minu . ' ph�t ' : '') . ($sec != 0 ? $sec . ' gi�y' : '');
            break;
        case "i":
            $sec = ($diff % 60);
            $result = round(abs($diff / 60), 0);
            break;
        case 's':
            $result = ceil(abs($diff));
            break;
        default:
            $result = ceil(abs($diff / 86400));
            break;
    }
    return  $result;
}
function writeCsv($data = [], $filePath = 'csv_helper.csv', $delimiter = ',')
{
    $handle = fopen($filePath, 'w+');
    fputs($handle, $bom = (chr(0xEF) . chr(0xBB) . chr(0xBF)));
    if ($handle) {
        foreach ($data as $line) {
            fputcsv($handle, $line, $delimiter);
        }
        return 1;
    }
    return 0;
}
if (!function_exists('convertObject')) {
    /**
     * Convert Object
     *
     * @param mixed $value Value
     *
     * @return void
     */
    function convertObject($value, $isArray = false)
    {
        return json_decode(json_encode($value), $isArray);
    }
}
function radio_checked($value, $value_confirn)
{
    return $value == $value_confirn ? 'checked' : '';
}
function array_group($array, $keyName, $flg = false)
{
    $result = array();
    if ($flg) {
        $array = array_map(function ($n) {
            return (array) $n;
        }, $array);
    }
    if ($array) {
        foreach ($array as $item) {
            $value = isset($item[$keyName]) ? $item[$keyName] : 'Default';
            if ($value && !array_key_exists($value, $result)) {
                $result[$value][] = $item;
            } else {
                $arr = $result[$value];
                $arr[] = $item;
                $result[$value] = $arr;
            }
        }
    }
    return $result;
}
function asset_mix($path)
{
    return asset('public/' . config('admin.theme.carton.path') . '/' . $path);
}


if (!function_exists('response_json')) {
    function response_json($code, $message, $data = null)
    {
        die(json_encode([
            'code'      => $code,
            'message'   => $message,
            'data'      => $data,
            'success'   => $code == 200 ? true : false
        ]));
    }
}
function isAdmin($level = "")
{
    if(in_array(auth()->user()->id,[1,23,24,25]))
    {
        return true;
    }
    else return false;
    if (empty(config("roles"))) {
        return false;
    }
    if ($level != "") {
        if ($level == 1) {
            if (in_array(1, config("roles"))) {
                return true;
            }
        }
        if ($level == 2) {
            if (in_array(2, config("roles"))) {
                return true;
            }
        }
        return false;
    } else {
        if (in_array(1, config("roles")) ||  in_array(2, config("roles"))) {
            return true;
        }
        return false;
    }
}
function checkRole($roles = [])
{
    $result = false;
    foreach($roles as $role)
    {

        if (in_array($role, config("roles"))) {
            $result =  true;
            continue;
        }
    }
    return  $result;
}
function check_rights($function, $per = null)
{
    $rights = \Modules\Admin\Model\Users::check_right($function);
    if($per == null)
    {
        return $rights;
    }
    else{
        return boolval(@$rights->{$per});
    }
}
function check_rights_function($function, $per = null)
{
    $rights = \Modules\Admin\Model\Users::checkRightsFunction($function);
    if($per == null)
    {
        return $rights;
    }
    else{
        return boolval(@$rights->{$per});
    }
}
if (!function_exists('elasticsearch')) {
    function elasticsearch($str)
    {
        $arr = [",", "Đường", "Phường", "Xã", "Quận", "District", "city", "City"];
        $regex = ["", "", "", "", "", "", "", ""];
        return str_replace("  ", " ", str_replace($arr, $regex, $str));
    }
}

if (!function_exists('image_path')) {
    function image_path($path = "")
    {
        $arr = ["public/",];
        $regex = [""];
        return env("APP_PATH") . str_replace($arr, $regex, $path);
    }
}
if (!function_exists('image_link')) {
    function image_link($path)
    {
        return url(image_path($path));
    }
}
function alias_name($text)
{
    $text = mb_strtolower($text);
    $text = str_replace(
        array(' ', '%', "/", "\\", '"', '?', '<', '>', "#", "^", "`", "'", "=", "!", ":", ",,", "..", "*", "&", "__", "▄", '–', '(', ')', '|', ',', '~'),
        array('-', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', "_", "", "", '', '', '', '', '', ''),
        $text
    );
    $text = str_replace(
        array('---', '--'),
        array('-', '-'),
        $text
    );
    $chars = array("a", "A", "e", "E", "o", "O", "u", "U", "i", "I", "d", "D", "y", "Y");
    $uni[0] = array("á", "à", "ạ", "ả", "ã", "â", "ấ", "ầ", "ậ", "ẩ", "ẫ", "ă", "ắ", "ằ", "ặ", "ẳ", "ẵ", "� � �");
    $uni[1] = array("Á", "À", "Ạ", "Ả", "Ã", "Â", "Ấ", "Ầ", "Ậ", "Ẩ", "Ẫ", "Ă", "Ắ", "Ằ", "Ặ", "Ẳ", "Ẵ", "� � �");
    $uni[2] = array("é", "è", "ẹ", "ẻ", "ẽ", "ê", "ế", "ề", "ệ", "ể", "ễ");
    $uni[3] = array("É", "È", "Ẹ", "Ẻ", "Ẽ", "Ê", "Ế", "Ề", "Ệ", "Ể", "Ễ");
    $uni[4] = array("ó", "ò", "ọ", "ỏ", "õ", "ô", "ố", "ồ", "ộ", "ổ", "ỗ", "ơ", "ớ", "ờ", "ợ", "ở", "ỡ", "� � �");
    $uni[5] = array("Ó", "Ò", "Ọ", "Ỏ", "Õ", "Ô", "Ố", "Ồ", "Ộ", "Ổ", "Ỗ", "Ơ", "Ớ", "Ờ", "Ợ", "Ở", "Ỡ", "� � �");
    $uni[6] = array("ú", "ù", "ụ", "ủ", "ũ", "ư", "ứ", "ừ", "ự", "ử", "ữ");
    $uni[7] = array("Ú", "Ù", "Ụ", "Ủ", "Ũ", "Ư", "Ứ", "Ừ", "Ự", "Ử", "Ữ");
    $uni[8] = array("í", "ì", "ị", "ỉ", "ĩ");
    $uni[9] = array("Í", "Ì", "Ị", "Ỉ", "Ĩ");
    $uni[10] = array("đ");
    $uni[11] = array("Đ");
    $uni[12] = array("ý", "ỳ", "ỵ", "ỷ", "ỹ");
    $uni[13] = array("Ý", "Ỳ", "Ỵ", "Ỷ", "Ỹ");
    for ($i = 0; $i <= 13; $i++) {
        $text = str_replace($uni[$i], $chars[$i], $text);
    }
    return $text;
}
function isJson($string)
{
    return ((is_string($string) &&
        (is_object(json_decode($string)) ||
            is_array(json_decode($string))))) ? true : false;
}
function json_decode_value($string)
{
    return isJson($string) ? json_decode($string) : $string;
}

if (!function_exists('user_config')) {
    function user_config($key = null, $default = null)
    {
        $settings = \App\Models\UserConfig::getAllSettings();
        if ($key == null) {
            return array_map("json_decode_value", $settings);
        }
        $value = Arr::get($settings, $key, $default);
        if (isJson($value)) {
            return json_decode($value);
        } else return $value;
    }
}
if (!function_exists('update_config')) {
    function update_config($key, $default = null)
    {
        \App\Models\UserConfig::updateOrCreate(
            ['keyword' => $key],
            ['value' => $default]
        );

    }
}
if (!function_exists('user_setting')) {
    function user_setting($key, $default = null)
    {
        $settings = \App\Models\UserSetting::getAllSettings();
        return Arr::get($settings, $key, $default);
    }
}
if (!function_exists('user_setting_value')) {
    function user_setting_value()
    {
        $settings = \App\Models\UserSetting::get()->keyBy("hs_key");
        return $settings; //Arr::get($settings, $key, $default);
    }
}
if (!function_exists('update_setting')) {
    function update_setting($key, $default = null)
    {
        if ($default != "") {
            \App\Models\UserSetting::updateOrCreate(
                ['hs_key' => $key],
                ['hs_val' => $default]
            );
        }
    }
}
if (!function_exists('randomKey')) {
    function randomKey()
    {
        return (string) \Str::uuid();
    }
}
if (!function_exists('getFieldById')) {
    function getFieldById($id = '', $field = '', $table = '', $show = '', $all = true,$format = '')
    {
        if (!$id || !$field) {
            return '';
        }
        if($table === "roups") $table = "groups";
        if ($table == '') {
            $table = $GLOBALS['var']['act'];
        }
        if (is_array($id)) {
            $data = [];
            foreach ($id as $key => $value) {
                $query = DB::table($table)->select($field)->where('id', $value);
                if (!$all) $query->where('deleted', 0);
                if ($query->count() > 0) {
                    if (!empty($show) && $show == 'full') {
                        $data[] =  $value . " - " . $query->first()->$field;
                    } else {
                        $data[] =  $query->first()->$field;
                    }
                }
            }
            if($format == 'badge')
            {
                return "<span class='badge badge-pill badge-info'>".implode("</span><span class='badge badge-pill badge-info'>", $data).'</span>';
            }
            return implode(", ", $data);


        } else {
            $query = DB::table($table)->where('id', $id)->select($field);
            if (!$all) $query->where('deleted', 0);
            if ($query->count() > 0) {
                if (!empty($show) && $show == 'full') {
                    return $id . " - " . $query->first()->$field;
                } else {
                    return $query->first()->$field;
                }
            } else {
                return '';
            }
        }
    }
}
function cmp($a, $b)
{
    return strcmp($a["order"] ?? ($a['text'] == '#' ? 0 : 999), $b["order"] ?? ($a['text'] == '#' ? 0 : 999));
}
function module_assets($path)
{
    return url('public/module/' . $path);
}
function module_mix($path)
{
    return url('public/module/' . $path);
}

function getDateValue($date, $format = "Y-m-d")
{
    if ($date == "" || $date == "0000-00-00") {
        return "";
    }
    return  date($format, strtotime($date));
}


function sendMail()
{
    return ["code" => 200];
}
if (!function_exists('createdSlug')) {
    function createdSlug($str, $sep = '-')
    {
        return (string) \Str::slug($str, $sep);
    }
}
function print_svg($file){
    if(file_exists(base_path(env('APP_PATH').$file)))
    {
        $iconfile = new DOMDocument();
        $iconfile->load(base_path(env('APP_PATH').$file));
        echo $iconfile->saveHTML($iconfile->getElementsByTagName('svg')[0]);
    }
}
function get_file_size($path)
{
    try {
        $bytes = sprintf('%u', filesize($path));

        if ($bytes > 0) {
            $unit = intval(log($bytes, 1024));
            $units = array('B', 'KB', 'MB', 'GB');

            if (array_key_exists($unit, $units) === true) {
                return sprintf('%d %s', $bytes / pow(1024, $unit), $units[$unit]);
            }
        }

        return $bytes;
    } catch (Exception $exception) {
        return 'file not exist';
    }
}
