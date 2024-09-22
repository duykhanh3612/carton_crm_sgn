
<?php
if (!function_exists('module_open')) {
    function module_open($class = ' table table-hover')
    {
        return '<table class="mainTable noPrint' . $class . '" id="mainTable-' . @$GLOBALS['var']['act'] . '" border="0" width="100%">';
    }
}
if (!function_exists('module_close')) {
    function module_close()
    {
        $table_name = @$GLOBALS['var']['act'];
        $table_title = get_data('modules', "file = '$table_name'", 'name_en');
        return '</table><div id="moduleInfo" data-table="' . $table_name . '" data-type="' . $table_title . '"></div>';
    }
}
function module_title()
{
    return "";
}
if (!function_exists('form_open')) {
    function form_open($action = '', $attributes = '', $hidden = array())
    {
        // $CI =& get_instance();
        if ($attributes == '') {
            $attributes = 'method="post"';
        }
        // If an action is not a full URL then turn it into one
        if ($action && strpos($action, '://') === FALSE) {
            $action = $CI->config->site_url($action);
        }
        // If no action is provided then set to the current url
        // $action OR $action = $CI->config->site_url($CI->uri->uri_string());
        $form = '<form action="' . $action . '"';
        $form .=  _attributes_to_string($attributes, TRUE);
        $form .= '>';
        // Add CSRF field if enabled, but leave it out for GET requests and requests to external websites
        // if ($CI->config->item('csrf_protection') === TRUE AND ! (strpos($action, $CI->config->base_url()) === FALSE OR strpos($form, 'method="get"')))
        // {
        // 	$hidden[$CI->security->get_csrf_token_name()] = $CI->security->get_csrf_hash();
        // }
        if (is_array($hidden) and count($hidden) > 0) {
            $form .= sprintf("<div style=\"display:none\">%s</div>", form_hidden($hidden));
        }
        return $form;
    }
}
if (!function_exists('form_close')) {
    function form_close($extra = '')
    {
        return "</form>" . $extra;
    }
}
if (!function_exists('form_input')) {
    function form_input($data = '', $value = '', $extra = '')
    {
        $defaults = array('type' => 'text', 'name' => ((!is_array($data)) ? $data : ''), 'value' => $value);
        return "<input " . _parse_form_attributes($data, $defaults) . $extra . " />";
    }
}
if (!function_exists('page_list')) {
    function page_list($total, $uri = '', $range = 8, $ajax = false)
    {
        if ($total == 0) {
            return '';
        }
        $url = site_url($GLOBALS['var']['act'] . ($GLOBALS['var']['do'] ? '/' . $GLOBALS['var']['do'] : '') . ($GLOBALS['var']['id'] ? '/' . $GLOBALS['var']['id'] : ''));
        $start = '';
        $count = '';
        $href = 'javascript:;';
        if (is_array($uri)) {
            $start = $uri['rowstart'] ?? 0;
            $count = $uri['limit'] ?? 10;
            if ($start == '') {
                $start = 0;
            }
            unset($uri['rowstart'], $uri['limit']);
            $uri_str = url_uri($uri, array('cat'));
            $link = $url . $uri_str . ($uri_str ? '&' : '?');
        } else {
            if ($uri == '') $link = $url . '?';
            else $link = $url . $uri . '&';
        }
        unset($_GET['t'], $_GET['q'], $_GET['rowstart']);
        if (isset($_GET) && is_array($_GET) && count($_GET)) {
            $link .= http_build_query($_GET) . '&';
        }
        if ($start == '') {
            $start = 0;
        }
        if ($count == '') {
            $count = $GLOBALS['var']['limit_perpage'];
        }
        $pg_cnt = ceil($total / $count);
        if ($pg_cnt <= 1) {
            return '';
        }
        $html = '';
        $idx_back = $start - $count;
        $idx_next = $start + $count;
        $cur_page = ceil(($start + 1) / $count);
        if ($idx_back >= 0) {
            if ($cur_page > ($range + 1)) {
                if (!$ajax) $href = $link . 'rowstart=0';
                $html .= '<li><a class="loading" href="' . $href . '" data-rowstart="0"><strong>1</strong></a></li><li class="disabled"><a href="#" style="cursor: default">...</a></li>';
            }
        }
        $idx_fst = max($cur_page - $range, 1);
        $idx_lst = min($cur_page + $range, $pg_cnt);
        if ($range == 0) {
            $idx_fst = 1;
            $idx_lst = $pg_cnt;
        }
        for ($i = $idx_fst; $i <= $idx_lst; $i++) {
            $offset_page = ($i - 1) * $count;
            if (!$ajax) $href = $link . 'rowstart=' . $offset_page;
            if ($i == $cur_page) $html .= '<li class="active"><a href="#">' . $i . '</a></li>';
            else $html .= '<li><a class="loading" href="' . $href . '" data-rowstart="' . $offset_page . '"> ' . $i . '</a></li>';
        }
        if ($idx_next < $total) {
            if ($cur_page < ($pg_cnt - $range)) {
                $offset_page = (($pg_cnt - 1) * $count);
                if (!$ajax) $href = $link . 'rowstart=' . $offset_page;
                $html .= '<li class="disabled"><a href="#" style="cursor: default">...</a></li><li><a class="loading" href="' . $href . '" data-rowstart="' . $offset_page . '"> ' . $pg_cnt . '</a></li>';
            }
        }
        /*$foward = $start + $count;
	$backward = $start - $count;
	if ($cur_page > 1) {
		if (!$ajax) $href = $link . 'rowstart=' . $backward;
		$html = '<li class="previous"><a class="loading" href="' . $href . '" data-rowstart="' . $backward . '">Prev</a></li>' . $html;
	}
	if ($cur_page < $pg_cnt) {
		if (!$ajax) $href = $link . 'rowstart=' . $foward;
		$html .= '<li class="next"><a class="loading" href="' . $href . '" data-rowstart="' . $foward . '">Next</a></li>';
	}*/
        return '<div class="dataTables_paginate"><ul class="pagination"><li class="disabled"><a href="#" style="cursor: default">Trang ' . number_format($cur_page) . '/' . number_format($pg_cnt) . ' (' . $total . '):</a></li>' . $html . '</ul></div>';
    }
}
function load_view($path, $data = [], $module = "admin")
{
    if (!is_string($path))
        return false;
    return view($module."::" . $path, $data);
}
function load_view_module($path, $data = [], $isTwig = true)
{
    if (!is_string($path))
        return false;
    // $ci = &get_instance();
    // if ($isTwig)
    //     return $ci->twig->render($path, $data);
    return view("modules::" . $path, $data);
}
if (!function_exists('_parse_form_attributes')) {
    function _parse_form_attributes($attributes, $default)
    {
        if (is_array($attributes)) {
            foreach ($default as $key => $val) {
                if (isset($attributes[$key])) {
                    $default[$key] = $attributes[$key];
                    unset($attributes[$key]);
                }
            }
            if (count($attributes) > 0) {
                $default = array_merge($default, $attributes);
            }
        }
        $att = '';
        foreach ($default as $key => $val) {
            if ($key == 'value') {
                $val = form_prep($val, $default['name']);
            }
            $att .= $key . '="' . $val . '" ';
        }
        return $att;
    }
}
if (!function_exists('_attributes_to_string')) {
    function _attributes_to_string($attributes, $formtag = FALSE)
    {
        if (is_string($attributes) and strlen($attributes) > 0) {
            if ($formtag == TRUE and strpos($attributes, 'method=') === FALSE) {
                $attributes .= ' method="post"';
            }
            if ($formtag == TRUE and strpos($attributes, 'accept-charset=') === FALSE) {
                $attributes .= ' accept-charset="' . strtolower(config_item('charset')) . '"';
            }
            return ' ' . $attributes;
        }
        if (is_object($attributes) and count($attributes) > 0) {
            $attributes = (array)$attributes;
        }
        if (is_array($attributes) and count($attributes) > 0) {
            $atts = '';
            if (!isset($attributes['method']) and $formtag === TRUE) {
                $atts .= ' method="post"';
            }
            if (!isset($attributes['accept-charset']) and $formtag === TRUE) {
                $atts .= ' accept-charset="utf8';
            }
            foreach ($attributes as $key => $val) {
                $atts .= ' ' . $key . '="' . $val . '"';
            }
            return $atts;
        }
    }
}
if (!function_exists('form_prep')) {
    function form_prep($str = '', $field_name = '')
    {
        static $prepped_fields = array();
        // if the field name is an array we do this recursively
        if (is_array($str)) {
            foreach ($str as $key => $val) {
                $str[$key] = form_prep($val);
            }
            return $str;
        }
        if ($str === '') {
            return '';
        }
        // we've already prepped a field with this name
        // @todo need to figure out a way to namespace this so
        // that we know the *exact* field and not just one with
        // the same name
        if (isset($prepped_fields[$field_name])) {
            return $str;
        }
        $str = htmlspecialchars($str);
        // In case htmlspecialchars misses these.
        $str = str_replace(array("'", '"'), array("&#39;", "&quot;"), $str);
        if ($field_name != '') {
            $prepped_fields[$field_name] = $field_name;
        }
        return $str;
    }
}
function current_url()
{
    return url('admin/' . request()->segment(2) . '/');
}
function site_url($uri)
{
    return url($uri);
}
function admin_url($uri)
{
    return url('admin/' . $uri);
}
if (!function_exists('stt')) {
    function stt($id, $stt)
    {
        return '<span class="stt STT_' . $id . '">' . $stt . '</span><input type="hidden" value="' . $stt . '" id="Old_' . $id . '" />';
    }
}
if (!function_exists('getLinkEdit')) {
    function getLinkEdit($row)
    {
        $url = current_url() . '/update';
        $lang = "?language_code=" . (!empty($row->language_code) ? $row->language_code : (!empty(request()->language_code) ? request()->language_code : config('app.locale')));
        $lang .= "&language_meta=" . (!empty($row->language_meta) ? $row->language_meta : randomKey());
        if (!empty($row->id)) {
            $url .= '/' . $row->id . $lang;
        } else {
            $url .= $lang;
        }
        return $url;
    }
}
if (!function_exists('goodfile')) {
    function goodfile($file)
    {
        $invalidChars = array('\'', '"', ';', '>', '<', '.php');
        $file = str_replace($invalidChars, '', $file);
        unset($invalidChars);
        if (file_exists($file) && is_file($file)) return true;
        return false;
    }
}
