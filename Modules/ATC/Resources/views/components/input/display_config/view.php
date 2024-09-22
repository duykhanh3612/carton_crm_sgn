<?php

use PhpParser\Node\Stmt\Break_;

foreach ($cols as $key => $col) :
    if (empty($col->type)) $col->type = '';
    $show = isset($col->show) && $col->show;
    if ($show) :
        /* Class Name */
        $className = @$col->tab_group . " " . $key;
        if (!empty($col->nowrap)) $className .= ' nowrap';
        if (!empty($col->align)) $className .= ' text-' . $col->align;
        /* style */
        $style = "word-wrap: " . (!empty($col->nowrap) ? 'normal' : 'break-word') . ";";
        if (!empty($col->width) && !$col->width) $style .= " width: $col->width; min-width: $col->width; max-width: $col->width;";
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
                    $view = show_img( $src, '', 'max-width : 35px; max-height : 35px;');
                }
                break;
            case 'file':
                $value = isJson($value) ? json_decode($value)[0] : $value;
                $src = $value;
                $img_type = last(explode('.', $value));
                if ($value &&  $value != '-' && $img_type != '//') {
                    // $src =  'ajax/readfile?key='. base64_encode(str_replace("upload//","",$value));
                    $src =  site_url( str_replace("upload//", "", $value));
                } else if ($value == '-') {
                    $src = "";
                }
                $view = !empty($src) ? "<a href=\"" . $src . "\"  target=\"_blank\">  <img src=\"" . url("public/assets/img/file_ext/" . $img_type)  . ".png\" alt=\"" . $img_type . "\" height=\"25px\" width=\"25px\"></a>" : "";
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
                // case 'option_items_keynum':
                //     $option = !empty($col->format) ? array_column(json_decode(get_data('option_items_keynum', "Field = '" . $col->format . "'", 'Options'), true), 'name', 'key') : null;
                //     $view = !empty($option) ? $option[$value] : $value;
                //     break;

            case 'option_items_keynum':
            case 'option_items':
                $options = !empty($col->format) ? json_decode(get_data($col->type, "Field = '" . $col->format . "'", 'Options'), true) : [];
                // if(!empty($setting->color)) {
                $optionColor = [];
                $colors = [];
                foreach ($options as $v) {
                    $optionColor[$v['key']] = $v['name'];
                    $colors[$v['key']] = [
                        'name' => $v['name'],
                        'background' => @$v['color'],
                        'color'     => @$v['color_text']
                    ];
                }
                if (@$isPart  || @$updateInSite) {
                    $view = form_dropdown($nameEle, emptyValueSelect($optionColor, $col->setting), $row[$key], 'id="' . $idEle . '" ' . (!empty($colors) ? 'data-colors=\'' . json_encode($colors) . '\'' : '') . ' class="form-control ' . $classInputName . ' select2-color select2" ' . $attribute);
                } else {
                    $view = "<span class=\"bs-label bs-label-control\" style='background: " . (@$colors[$value]['background']) . "; color: " . @$colors[$value]['color'] . "'>" . @$colors[$value]['name'] . "</span>";
                }

                // } else {
                //     if(!empty($options)) $options = array_column($options, 'name', 'key');
                //     if (@$isPart  || @$updateInSite) {
                //         $view = form_dropdown($nameEle, emptyValueSelect($options, $col->setting), $row[$key], 'id="' . $idEle . '" data-value="'.$row[$key].'" class="form-control select2 ' . $classInputName . ' " ' . $attribute);
                //     } else {
                //         $view = !empty($options) ? @$options[$value] : $value;
                //     }
                // }
                break;
            case 'field_by_id':
                if (!empty($col->setting)) {
                    $setting = json_decode($col->setting, true);
                    $id = isJson($value) ? json_decode($value, true) : $value;
                    $strView = $value;
                    if (!empty($setting['show_id']) && !empty($setting['show_field'])) {
                        $strView = getFieldById($id, $setting['field'], substr($setting['table'], strpos($setting['table'], "_") + 1), 'full');
                    } else if (empty($setting['show_id']) && !empty($setting['show_field'])) {
                        $strView = getFieldById($id, $setting['field'], substr($setting['table'], strpos($setting['table'], "_") + 1),'',false,$col->format);
                    }

                    if($col->format == "badge")
                    {
                        $view = "<div class='d-flex' style='gap:5px;'>$strView</div>";
                    }
                    else $view = "<span title=\"$strView\">$strView</span>";

                } else {
                    $view = $value;
                }
                break;
            case 'role':
                $roles = json_decode($value, true);
                if (!empty($roles)) {
                    $view = implode(", ", collect($roles)->where("function_name", "<>", "")->pluck("function_name")->toArray());
                } else {
                    $view = "";
                }
                break;
            case 'date':
                $value = isset($value) ?  date("Y-m-d", strtotime($value)) :  date("Y-m-d");
                if (@$isPart  || @$updateInSite) {
                    $view  = "<input  type='text' name='$nameEle' id='$idEle' class='bootstrap-datepicker bgshipmentinput form-control' value='$value' autocomplete='off'>";
                } else {
                    $view = $value;
                }
                break;
            case 'currency':
                switch (@$col->format_type) {
                    case "currency":
                        $value = number_format($value, intval(@$col->format));
                        break;
                    default:
                        $value = number_format($value);
                        break;
                }
                $view = $value;

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

             if(@$module->action_page_detail=="popup")
             {
                $href = "data-toggle=\"popup\" data-href=\"$editLink\"";
             }
             else{
                $href = "href=\"$editLink\"";
             }
            $view = "<a $href class='link_detail' target=\"_blank\">$view</a>";
        }
?>
        <td class="<?= $className ?>" style="<?= $style ?>"><?= $view ?></td>
<?php
    endif;
endforeach
?>
