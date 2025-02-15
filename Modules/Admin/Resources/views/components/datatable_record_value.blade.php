@php
$isArray = 0;
$defaultValue = '';
$type = !empty($thead['type']) ? $thead['type'] : 'text';
if(isset($thead['default'])){
    $defaultValue = $thead['default'];
}
if(strpos($thead['field'], '.') !== false){
    // $fields = explode('.', $thead['field']);
    // $field0 = $fields[0];
    // $field1 = $fields[1];
    // $field2 = @$fields[2];
    $recordValue = \Arr::get($record,$thead['field']);
    // if($recordValue && is_array($recordValue)){
    //     $recordValue = @$recordValue[$field1];
    //     if(is_array($recordValue)){
    //         if($field2){
    //             $recordValue = @$recordValue[$field2];
    //         }
    //     }
    //     if(is_array($recordValue) && in_array($type , ['text' , 'image'])){
    //         $recordValue = $defaultValue;
    //     }
    // }
}else{
    $recordValue = isset($record->{$thead['field']}) ? $record->{$thead['field']} : $defaultValue;
}
if(is_bool($recordValue) || $type === 'bool'){
    if($recordValue){
        $recordValue = 'Yes';
    }else{
        $recordValue = 'No';
    }
}
if($type === 'address'){
    if(isset($thead['address_id'])){
        $recordValueId = isset($record->{$thead['address_id']}) ? $record->{$thead['address_id']} : 0;
        if($recordValueId){
            $recordValue = isset($record->{$thead['ref']}) ? $record->{$thead['ref']} : $defaultValue;
            if($recordValue && is_array($recordValue)){
                foreach($recordValue as $tempAddress){
                    if(!empty($tempAddress['id']) && $tempAddress['id'] == $recordValueId){
                        $recordValue = $tempAddress['full_address'];
                        break;
                    }
                }
            }
        }
    }else{
        $recordValue = isset($record->{$thead['ref']}) ? $record->{$thead['ref']} : $defaultValue;
        if($recordValue && is_array($recordValue)){
            $recordValue = $recordValue['full_address'];
        }
    }
    if(is_array($recordValue)){
        $recordValue = $defaultValue;
    }
}
if(is_array($recordValue)){
    $isArray = 1;
}
if(!$isArray){
    switch($type){

        case 'text':
            if(strpos("text_wrap",@$thead['class'])===false)
            {
                $recordValue =   '<span class="text_wrap" title="'.$recordValue.'">'.$recordValue.'</span>';
            }
            echo $recordValue;
            break;

        case 'link_title':
            if(isset($page) && $page != "")
            {
                $para[] = $page;
            }
            $para[] = $record->id;
            if(strpos("text_wrap",$thead['class'])===false)
            {
                $recordValue =   '<span class="text_wrap" title="'.$recordValue.'">'.$recordValue.'</span>';
            }
            if(@$config['custom_link'])
            {
                echo '<a href="'.@$config['custom_link'].'/edit/'.$record->id.'">'.$recordValue.'</a>';
            }
            else{
            if(!empty($links))
            {
                echo '<a href="'.route(Arr::get($links,'edit'), $para).'">'.$recordValue.'</a>';
            }
            else{
                echo '<a href="'.route(Arr::get($links,'edit'), $para).'">'.$recordValue.'</a>';
                }
            }

            break;
        case 'money':
            echo number_format(intval($recordValue)) .Currencies::getName(@$record->currency) .  @$record->unit;
            break;
        case 'decimal':
            echo number_format(intval($recordValue));
            break;
        case 'image':
            if($recordValue!="")
            {
                echo '<img src="'.asset('public/'.$recordValue).'" width="100">';
            }
            break;
        case 'action':
            if(@$config['custom_link'])
            {
                $link['edit'] = @$config['custom_link'].'/edit/'.$record->id;
                if(check_rights($module->file,"delete"))
                {
                    $link['delete'] = @$config['custom_link'].'/delete/'.$record->id;
                }
            }
            else{
                if(isset($page) && $page != "")
                {
                    $para[] = $page;
                }
                $para[] = $record->id;

                $link['edit'] = route(Arr::get($links,'edit'),$para);

                if(check_rights($module->file,"delete"))
                {
                    $link['delete'] =route(Arr::get($links,'delete'),$para);
                }
            }
            if(!empty($links))
            {

                if(isset($links['copy']))
                {
                    echo '<a href="'.route(Arr::get($links,'copy'),$para).'" class="btn btn-icon btn-sm btn-primary"><i class="fa fa-copy"></i></a>';
                }
                if(isset($links['edit']))
                {
                    echo '<a href="'.   $link['edit'] .'" class="btn btn-icon btn-sm btn-primary"><i class="fa fa-edit"></i></a>';
                }
                if(isset($links['delete']))
                {
                    echo '<a href="'.   $link['delete'] .'" class="btn btn-icon btn-sm btn-danger deleteDialog"><i class="fa fa-trash-alt"></i></a>';
                }
            }
            break;
        case 'action_include':
            echo view($thead['view'],['record'=>$record, 'links'=>$links??[]]);
            break;
        case 'public':
            echo '<span class="label-success status-label">Published</span>';
            break;
        case 'datetime':
            $str = date("Y-m-d", strtotime($recordValue));
            if($thead['format' ]== "today" && date("Y-m-d") == $str)
            {
                if(date("Y-m-d") == date("Y-m-d", strtotime($recordValue)))
                {
                    echo  date("H:i",strtotime($recordValue));
                }
                else{
                    echo date($thead['format'] != "today"? $thead['format']:"Y-m-d H:i",strtotime($recordValue));
                }

            }
            else if($thead['format' ]== "full_day")
            {
                if(date("Y-m-d") == date("Y-m-d", strtotime($recordValue)))
                {
                    echo  date("Y-m-d H:i",strtotime($recordValue));
                }
                else{
                    echo date( "Y-m-d",strtotime($recordValue));
                }
            }
            else{
                echo date("Y-m-d H:i",strtotime($recordValue));
            }
            break;
        case 'date':
            echo $recordValue!=""?date($thead['format']??"Y-m-d",strtotime($recordValue)):"";
            break;
        case 'select':
            echo $recordValue!=""?\Arr::get($thead['data'],$recordValue):"";
            break;
        case 'form_drop':
            echo get_data($thead['table'],[$thead['table_field']['key'] => $recordValue],$thead['table_field']['value']);
            break;
        case 'column':
            $fields  = $thead['fields'];
            $str = [];
            foreach ($fields as $key => $col) {
                $str [] = $record->{$col};
            }
            echo implode($thead['symbol']??" ",$str);
            break;
        case 'rent_and_area':
            $str = "";
            if(!empty($model[@$thead['table']]) && @$record->{@$thead['field']}!="")
            {
                $model = new $model[@$thead['table']];
                $options = $model::where(@$thead['table_where_field'],$record->{@$thead['field']})->get();
                if(!empty($options))
                {
                    foreach ($options  as $key => $value) {
                        $str .= ($value->price .Currencies::getName($value->currency) ." - ".$value->area).'<br/>';
                    }
                }
            }
            echo $str;
            break;
        case 'repeater':
            $str = "";
            $variable = json_decode(@$record->{@$thead['field']});
            if(!empty($variable))
            {
                foreach ($variable as $key => $v) {
                    $arr = [];
                    foreach ($thead['nodes'] as $node) {
                        $arr[] = $v->{$node['field']};
                    }
                    $str .= implode(" - ", $arr) .'<br/>';
                }
            }
            echo $str;
            break;
        case 'option_items_keynum':
            $options = get_options_keynum_data($thead['option_key']??$thead['field']);
            echo @$options[$recordValue];
            break;
        default:
            echo $recordValue;
    }
}else{
    switch($type){

        case 'image':
            foreach($recordValue as $val){
                echo '<img src="'.$val.'" width="100">';
            }
            break;
        case 'mainImage':
            foreach($recordValue as $val){
                echo '<img src="'.$val.'" width="100">';
                break;
            }
            break;
        case 'imageLink':
            if($recordValue){
                usort($recordValue, function($a, $b){
                    if($a['image_id'] == $b['image_id']){
                        return 0;
                    }
                    return ($a['image_id'] > $b['image_id']) ? 1 : -1;
                });
                echo '<input type="hidden" value="'.json_encode($recordValue).'">';
            }
            foreach($recordValue as $val){
                if($val['main_image']){
                    continue;
                }
                echo '<img src="'.$val['url'].'" width="100">';
            }
            break;
        case 'mainImageLink':
            foreach($recordValue as $val){
               if($val['main_image']){
                   echo '<img src="'.$val['url'].'" width="100">';
                   break;
               }
            }
            break;
        case 'table':
            if(!empty($recordValue) && is_array($recordValue)){
                $theads = @$thead['theads'];
                echo '<table border="1"><tbody>';
                if(!$theads){
                    echo '<tr>';
                    foreach($recordValue as $key => $val){
                        $key = ucwords(str_replace('_',' ',$key));
                        echo '<th>'.$key.'</th>';
                    }
                    echo '</tr><tr>';
                    foreach($recordValue as $key => $val){
                        echo '<th>'.$val.'</th>';
                    }
                    echo '</tr>';
                }else{
                    echo '<tr>';
                    foreach($theads as $k => $th){
                        $th = ucwords(str_replace('_',' ',$th));
                        echo '<th>'.$th.'</th>';
                    }
                    echo '</tr>';
                    foreach($recordValue as $record){
                        echo '<tr>';
                        foreach($theads as $k => $th){
                            echo '<td>'. Arr::get($record,is_numeric($k) ? $th : $k).'</td>';
                        }
                        echo '</tr>';
                    }
                }
                 echo '</tbody></table>';
            }
            break;
        case 'attributes':
            if(!empty($recordValue) && is_array($recordValue)){
                echo '<table border="1"><tbody>';
                echo '<tr>';
                foreach($recordValue as $th){
                    if(!empty($th['name'])){
                        echo '<th>'.$th['name'].'</th>';
                    }
                }
                echo '</tr><tr>';
                foreach($recordValue as $record){
                    if($record['value']){
                        echo '<td>'.@$record['value'].'</td>';
                    }
                }
                echo '</tr>';
                echo '</tbody></table>';
            }
            break;
        case 'object':
            if(!empty($recordValue) && is_array($recordValue)){
                $subHeads = @$thead['theads'];
                if(empty($subHeads)) {
                    $subHeads = array_keys($recordValue);
                }
                echo '<table border="1"><tbody>';
                echo '<tr>';
                foreach ($subHeads as $k => $th) {
                    $th = ucwords(str_replace('_',' ',$th));
                    echo '<th>' . $th .'</th>';
                }
                echo '</tr><tr>';
                foreach($subHeads as $k => $th){
                    echo '<td>'. Arr::get($recordValue , is_numeric($k) ? $th : $k ).'</td>';
                }
                echo '</tr>';
                echo '</tbody></table>';
            }
            break;
        default:
            echo implode(PHP_EOL, $recordValue);
    }
}
@endphp
