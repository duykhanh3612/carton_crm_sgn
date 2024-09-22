<?php
foreach ($cols as $key => $col) :
    if(empty($col->type)) $col->type = '';
    $show = isset($col->show) && $col->show;
    if ($show) :
        /* Class Name */
        $className = $key;
        if (!empty($col->nowrap)) $className .= ' nowrap';
        if (!empty($col->align)) $className .= ' ' . $col->align;
        /* style */
        $style = "word-wrap: " . (!empty($col->nowrap) ? 'normal' : 'break-word') . ";";
        if (!empty($col->width)) $style .= " width: $col->width; min-width: $col->width; max-width: $col->width;";
        /* View */
        $id = !empty($row->did) ? $row->did : $row->id;
        $value = @$row->$key;
        $classMoney = "";
        if (!empty($col->format) && $col->type != 'option_items_keynum' && is_numeric($col->format)) {
            $value = number_format($row->$key, $col->format);
            $classMoney = "money";
        }
        $view = "";
        switch (@$col->type) {
            case 'text_input':
                $view = $GLOBALS['var']['do'] != 'prints' ? "<input type=\"text\" name=\"$key\" class=\"form-control $key $classMoney\" value=\"$value\" />" : $value;
                break;
            case 'check':
            case 'check_edit':
                $view = change_status($id, $value, $key, '', '', '', $col->type != 'check_edit', $GLOBALS['var']['act']);
                break;
            case 'image':
                if (isset($row->image) || isset($row->img)) {
                    $src = $row->image ?? $row->img;
                    $view = show_img(asset('/public/' . $src), '', 'max-width : 35px; max-height : 35px;');
                }
                break;
            case 'color':
                if (!empty($col->setting)) {
                    $ordersStatus = get_data('orders_status', 'type = "' . $col->setting . '" AND StatusKey = "' . $row->$key . '" AND active = 1 AND deleted = 0', '*');
                    $view = "<span class=\"badge\" style=\"background: " . ($ordersStatus['color'] ?? 'transparent') . "\">" . ($ordersStatus['name'] ?? '') . "</span>";
                } else {
                    $view = $value;
                }
                break;
            case 'user':
                if (isJson($value)) {
                    $value = "[" . implode(",", json_decode($value, true)) . "]";
                } else {
                    $value = preg_replace('/\s+/', '', $value);
                }
                $view = "<span data-user=\"$value\" class=\"display-user\" title=\"$value\">---</span>";
                break;
            case 'option_items_keynum':
                $option = !empty($col->format) ? array_column(json_decode(get_data('option_items_keynum', "Field = '" . $col->format . "'", 'Options'), true), 'name', 'key') : null;
                $view = !empty($option) ? $option[$value] : $value;
                break;
            case 'field_by_id':
                if (!empty($col->setting)) {
                    $setting = json_decode($col->setting, true);
                    $id = isJson($value) ? json_decode($value, true) : $value;
                    $strView = $value;
                    if (!empty($setting['show_id']) && !empty($setting['show_field'])) {
                        $strView = getFieldById($id, $setting['field']??"id", substr($setting['table'], strpos($setting['table'], "_") + 1), 'full');
                    } else if (empty($setting['show_id']) && !empty($setting['show_field'])) {
                        $strView = getFieldById($id, $setting['field']??"id", substr($setting['table'], strpos($setting['table'], "_") + 1));
                    }
                    $view = "<span title=\"$strView\">$strView</span>";
                } else {
                    $view = $value;
                }
                break;
            default:
                if (@$col->format != "") {
                    $view = number_format($value, intval($col->format));
                } else {
                    $view = $value;
                }
        }

        if (!empty($col->link)) {
            $url = !empty($col->format) ? $col->format : $GLOBALS['var']['act'];
            $editLink = getLinkEdit($row);
            $view = "<a href=\"$editLink\" target=\"_blank\">$view</a>";
        }
?>
        <td class="<?= $className ?>" style="<?= $style ?>"><?= $view ?></td>
<?php
    endif;
endforeach
?>
