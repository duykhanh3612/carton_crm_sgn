<?php
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
if (!function_exists('get_options')) {
    function get_options($Field = '', $selected = array(), $extra = '', $name = '', $sort = false)
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
            $form .= '<option value=""' . $sel . '>Select ...' . "</option>\n";
        }
        $Options = get_data('option_items', 'Field = "' . $Field . '"', 'Options');
        if ($Options) {
            $options = json_decode($Options);
            if ($sort) {
                sort($options);
            }
            if ($GLOBALS['var']['act'] != 'suppliers') {
                sort($options);
            }
            foreach ($options as $key => $val) {
                $key = (string)$val;
                if (($multiple && $key) || !$multiple) {
                    $sel = (in_array($key, $selected)) ? ' selected="selected"' : '';
                    $form .= '<option value="' . $key . '"' . $sel . '>' . (string)$val . "</option>\n";
                }
            }
        }
        $form .= '</select>';
        return $form;
    }
}
if (!function_exists('create_sort')) {
    function create_sort($field)
    {
        $act = url('admin/' . request()->segment(1) . '/');
        $orderby = request('orderby', true);
        $orderMode = request('ordermode', true);
        if ($orderMode == '') $orderMode = 'desc';
        if ($field == $orderby) {
            if ($orderMode == 'desc') $orderMode = 'asc';
            else $orderMode = 'desc';
        }
        $uri = array(
            'deleted'   => request('deleted', true),
            'q'         => request('q', true),
            'cat'       => request('cat', true),
            'from'      => request('from', true),
            'to'        => request('to', true),
            'orderby'   => $field,
            'ordermode' => $orderMode
        );
        return '<a class="ajax" href="' . site_url($act) . url_uri($uri) . '" title="Sắp xếp">
    <div class="icon12 glyphicons ' . ($orderby == $field ? (strtolower($orderMode) == 'desc' ? 'sort-by-attributes' : 'sort-by-attributes-alt') : 'sorting') . '" style="margin-top:3px; float:right; margin-left:3px;"></div></a>';
    }
}
if (!function_exists('getPage')) {
    function getPage($id, $table = 'pages')
    {
        $query = DB::table($table);
        if (is_array($id)) {
            $query->whereIn('id', $id);
            return $query->get();
        } else {
            $query->where('id', $id);
            return $query->first();
        }
    }
}
if (!function_exists('category_nestable')) {
    function category_nestable($cats, $parent = 0)
    {
        if (!is_array($cats)) {
            return false;
        }
        $field = str_replace('_categories', '', $GLOBALS['var']['act']);
        switch ($field) {
            case 'digicats':
                $type = 'products';
                break;
            case 'news':
                $type = 'news';
                break;
            case 'products':
            case 'menucats':
                $type = 'items';
                break;
        }
        if (empty($htmlcat)) {
            $htmlcat = '';
        }
        foreach ($cats as $key => $cat) {
            $cat = (array)$cat;
            if ($cat['parent'] == $parent) {
                $htmlcat .= '<li class="dd-item dd3-item" data-id="' . $cat['id'] . '">';
                $htmlcat .= '<div class="dd-handle dd3-handle icon glyphicons list"></div>';
                $htmlcat .= '<div class="dd3-content" style="line-height: 44px;"><span data-name="' . $cat['id'] . '"><b>' . $cat['id'] . '</b> - ' . $cat['name'] . '</span></div>';

                $languages = getLanguages();
                if(!empty($languages)) {
                    $langMeta = !empty($cat['language_meta']) ? $cat['language_meta'] : (!empty(request()->language_meta) ? request()->language_meta : randomKey());
                    $langLocate = '';
                    foreach($languages as $lang) {
                        $check = checkDataLanguage($lang->lang_locale, $langMeta, $cat['id'], $GLOBALS['var']['act'] . '_categories');
                        if($lang->lang_locale == config('app.locale')) $langLocate = $check;
                        if(!empty($langLocate->info_meta)) {
                            $htmlcat .= '<img id="lang-code" class="lang-code border '. (!empty($check->id) ? 'border-success' : 'border-primary') .' '. ($cat['language_code'] == $lang->lang_locale ? 'd-none' : 'd-block') .'" src="'. ( asset('public/themes/admin/images/' . $lang->lang_locale . '.png') ) .'" data-id = "'. $check->id .'" data-code="'. $check->language_code .'" data-meta = "'. $check->language_meta .'" width="18" style="margin-top: 5px; padding: 1px; cursor: pointer;">';
                        }
                    }
                }

                $htmlcat .= '<div class="dd-status">' . change_status($cat['id'], $cat['active'], 'active', 'Kích hoạt', '', '', !$GLOBALS['per']['edit'], $GLOBALS['var']['act'] == 'product' || $GLOBALS['var']['act'] == 'news' ? $GLOBALS['var']['act'] . '_categories' : '', '', 'change-status') . '</div>';
                $htmlcat .= '<div class="dd-cmd">';
                if ($GLOBALS['per']['edit']) {
                    if (in_array($GLOBALS['var']['act'], ['news', 'product', 'join_us', 'investor_relations'])) {
                        $htmlcat .= edit_alink('', 'javascript:;" data-type="' . $field . '" '.(!empty($cat['language_code']) ? 'data-code="'.$cat['language_code'].'"' : '').' data-id="' . $cat['id'], 'update_caterogies');
                    } else {
                        $htmlcat .= edit_alink($cat['id'], $GLOBALS['var']['act'] . '/update/' . $cat['id']);
                    }
                }
                if ($GLOBALS['per']['del']) {
                    $htmlcat .= del_restore_link($cat['id'], $cat['deleted'], true, false, $GLOBALS['var']['act'] . '_categories', 'delete-restore reload');
                }
                if($GLOBALS['var']['act'] == 'news') {
                    $htmlcat .= change_status($cat['id'], @$cat['home'], 'home', 'Trang Chủ', '', '', !$GLOBALS['per']['edit'], 'news_categories', '', 'change-status only');
                }
                $htmlcat .= '</div>';
                // echo $cat['chirld'];
                if ($cat['chirld']) {
                    $htmlcat .= '<ol class="dd-list" style="display: none;">';
                    $htmlcat .= category_nestable($cats, $cat['id']);
                    $htmlcat .= '</ol>';
                }
                $htmlcat .= '</li>';
                unset($cats[$key]);
            }
        }
        return $htmlcat;
    }
}
if (!function_exists('module_open')) {
    function module_open($class = ' table table-hover')
    {
        return '<table class="mainTable noPrint' . $class . '" id="mainTable-' . $GLOBALS['var']['act'] . '" border="0" width="100%">';
    }
}
if (!function_exists('module_close')) {
    function module_close()
    {
        $table_name = $GLOBALS['var']['act'];
        $table_title = get_data('modules', "file = '$table_name'", 'name_en');
        return '</table><div id="moduleInfo" data-table="' . $table_name . '" data-type="' . $table_title . '"></div>';
    }
}
if (!function_exists('show_img')) {
    function show_img($file_path, $class = '', $style = '')
    {
        if (goodfile(base_path(env("APP_PATH").$file_path))) return '<img src="' . asset($file_path)  . '"' . ($class ? ' class="' . $class . '"' : '') . ($style ? ' style="' . $style . '"' : '') . ' />';
        else return 'No file!';
    }
}
if (!function_exists('form_open_multipart')) {
    function form_open_multipart($action = '', $attributes = array(), $hidden = array())
    {
        if (is_string($attributes)) {
            $attributes .= ' enctype="multipart/form-data"';
        } else {
            $attributes['enctype'] = 'multipart/form-data';
        }
        return form_open($action, $attributes, $hidden);
    }
}
if (!function_exists('form_input')) {
    function form_input($data = '', $value = '', $extra = '')
    {
        $defaults = array('type' => 'text', 'name' => ((!is_array($data)) ? $data : ''), 'value' => $value);
        return "<input " . _parse_form_attributes($data, $defaults) . $extra . " />";
    }
}
if (!function_exists('cat_tree')) {
    function cat_tree($cats, $parent = 0, $checked = '', $type = 'checkbox', $no_parent = true, $field_name = 'category', $disabled_root = false)
    {
        if (!is_array($cats)) {
            return false;
        }
        if (empty($htmlcat)) {
            if ($type == 'radio' && $no_parent) {
                $check = $checked == 0 || $checked == '';
                $no_parent = '<li>';
                $no_parent .= '<label>';
                $no_parent .= '<input type="radio" data-id="" id="' . $field_name . '" name="' . $field_name . '" class="custom-' . $type . '" value=""' . ($check ? ' checked="checked"' : '') . '>';
                $no_parent .= '<span class="file">Không chọn ...</span>';
                $no_parent .= '</label>';
                $htmlcat = $no_parent;
            } else {
                $htmlcat = '';
            }
        }
        foreach ($cats as $key => $cat) {
            $cat = (array)$cat;
            if (!isset($cat['parent'])) {
                $cat['parent'] = 0;
            }
            if (!isset($cat['chirld'])) {
                $cat['chirld'] = 0;
            }
            if (!isset($cat['id'])) {
                $cat['id'] = $key;
            }
            if ($cat['parent'] == $parent) {
                $check = (is_array($checked) && in_array($cat['id'], $checked)) || $checked == $cat['id'];
                $subcat = '';
                if ($cat['chirld']) {
                    $subcat = cat_tree($cats, $cat['id'], $checked, $type, false, $field_name);
                }
                $htmlcat .= '<li' . ($subcat ? ' class="collapsable"' : '') . '>';
                if ($subcat) {
                    $htmlcat .= '<div class="hitarea collapsable-hitarea"></div>';
                }
                $htmlcat .= '<label>';
                $parent == 0 && $disabled_root ? '' : $htmlcat .= '<input type="' . $type . '" data-id="' . $cat['id'] . '" id="' . $field_name . $cat['id'] . '" name="' . $field_name . '' . ($type == 'checkbox' ? '[]' : '') . '" class="custom-' . $type . '" value="' . $cat['id'] . '"' . ($check ? ' checked="checked"' : '') . '>';
                $htmlcat .= '<span class="' . ($parent == 0 ? 'folder' : 'file') . '">' . $cat['name'] . (!empty($cat['product']) ? ' (' . $cat['product'] . ')' : '') . '</span>';
                $htmlcat .= '</label>';
                if ($subcat) {
                    $htmlcat .= '<ul>';
                    $htmlcat .= $subcat;
                    $htmlcat .= '</ul>';
                }
                $htmlcat .= '</li>';
                unset($cats[$key]);
            }
        }
        return $htmlcat;
    }
}
if (!function_exists('error_div')) {
	function error_div($field, $message, $style = '')
	{
		return '<div class="errordiv ' . $field . '"' . ($style ? ' style="' . $style . '"' : '') . '><div class="arrow"></div>' . $message . '</div>';
	}
}
if (!function_exists('toggle_input')) {
	function toggle_input($id, $checked, $field, $disabled = false)
	{
		return '<input type="checkbox" class="input-switch-alt' . ($disabled ? ' disabled' : '') . '"' . ($checked ? ' checked="checked"' : '') . ' id="toggleInput' . $id . '" data-toggletarget="boxed-layout" data-id="' . $id . '" name="' . $field . '" data-field="' . $field . '"  value="' . ($checked ? 1 : 0) . '" autocomplete="off"/>';
	}
}
if (!function_exists('remove_link')) {
    function remove_link($id, $table = '', $class = '')
    {
        return '<a href="javascript:;" data-placement="bottom" title="Xóa vĩnh viễn" class="' . $class . ' removeLink" data-id="' . $id . '" data-table="' . $table . '"><div class="icon glyphicons remove waves-effect waves-circle"></div></a>';
    }
}
if (!function_exists('edit_alink')) {
    function edit_alink($id = '', $href = '', $class = '', $style = '', $extra = '', $icon = null, $title = null)
    {
        if ($href == '') {
            $href = 'javascript:;';
        }
        return '<a ' . $extra . ' href="' . $href . '" data-placement="bottom" title="' . ($title ?? 'Edit') . '" class="' . ($class ? $class : 'ajax') . '"' . ($id ? ' data-id="' . $id . '"' : '') . '>
		<div class="w-16 fa fa-' . ($icon ?? 'edit') . ' waves-effect waves-circle"' . ($style ? ' style="' . $style . '"' : '') . '></div>
		</a>';
    }
}
if (!function_exists('del_restore_link')) {
    function del_restore_link($id, $deleted = 0, $no_remove = false, $remove_link = false, $table = '', $class = "delete-restore")
    {
        $html = '<a href="javascript:;" data-placement="bottom" title="' . ($deleted ? 'Khôi phục' : 'Xóa') . '" class="' . $class . '" data-id="' . $id . '" data-table="' . $table . '">
                <div class="fa fa-trash  ' . ($deleted ? 'refresh' : 'bin') . ($no_remove ? ' no-remove' : '') . ' waves-effect waves-circle"></div></a>';
        if ($deleted || $remove_link == true) {
            $html .= ' ' . remove_link($id, $table, $class);
        }
        return $html;
    }
}
