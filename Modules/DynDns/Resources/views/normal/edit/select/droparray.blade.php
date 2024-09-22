<?php
$string =$ctrl->att_table;
$finalArray = array();

$asArr = explode( ',', $string );

foreach( $asArr as $val ){
    $tmp = explode('=>', $val );
    $finalArray[ $tmp[0] ] = $tmp[1];
}
?>
<div class="form-group {{$ctrl->width}}">
    <label><?=$ctrl->title?></label>
    <div>
        <select class="form-control" name="{{$ctrl->name}}" {!! $ctrl->att_style !!}><?php foreach($finalArray as $k=>$v):?> 
            <option value="{{ltrim($k)}}" {{@$row->{$ctrl->value}==ltrim($k)?'selected=selected':''}}><?=$v?></option><?php endforeach?>
        </select>
    </div>
</div>