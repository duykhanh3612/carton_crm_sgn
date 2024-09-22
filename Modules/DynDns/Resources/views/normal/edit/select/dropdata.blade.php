<?php
 $arr = explode(',',$ctrl->att_table);
?>
<div class="form-group {{$ctrl->width}}">
    <label><?=$ctrl->title?> @if(@$ctrl->validate==1) <span style="color:#ff0000">(*)</span> @endif</label> 
    <div>
        <select class="form-control {{@$ctrl->validate==1?'validation':''}}  {{ @$ctrl->needed==1?'needed':''}} " {{@$ctrl->read==1?"readonly disabled":"name=".@$ctrl->name.$lang}}   >
            <?php foreach($arr as $a):?>
            <option value="{{$a}}" {{@$row->{$ctrl->value}==$a?'selected=selected':''}}><?=$a?></option>
            <?php endforeach?>
        </select>
        <ul class="parsley-errors-list"></ul>
    </div>
</div>