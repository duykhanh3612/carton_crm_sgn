<?php
$string =$ctrl->att_table;
$finalArray = array();

$asArr = explode( ',', $string );

foreach( $asArr as $val ){
    $tmp = explode('=>', $val );
    $finalArray[ $tmp[0] ] = $tmp[1];
}
?>
<div class="form-group">
    <label>
        <?=$ctrl->title?>
    </label>
    <div>
        <label class="form-control">{{ $finalArray[@$row->{$ctrl->value}] }}</label>
    </div>
</div>
