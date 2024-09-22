<?php
$arr = explode(',',$ctrl->value);
$v = array();
?>
<td style="white-space:normal !important;  {{@$ctrl->att_style}} " class="{{@$ctrl->mobile!=1?" hidden-xs-down":""}}">
    <div style="word-wrap:break-word !important; max-width:300px;" class="ma_tang_block">
        @foreach($arr as $k)
        @if($row->$k!="")
        @php $v[] = ($k=="macan"?"Ma: ":($k=="floor"?"F: ":"B: ")).$row->$k; @endphp
        @endif
        @endforeach
        <i>{!! implode("&nbsp;&nbsp;&nbsp;",$v) !!}</i>
    </div>

</td>
<style type="text/css">
    .ma_tang_block i {
        width:10px 
    }
</style>
