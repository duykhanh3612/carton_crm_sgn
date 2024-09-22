@php
    $name_id = str_replace(array('[',']',"#"),array('','',''),@$ctrl->name.$lang);
    $string =$ctrl->att_table;
    $finalArray = array();

    $asArr = explode( ',', $string );
    foreach( $asArr as $val ){
        $tmp = explode('=>', $val );
        $finalArray[ $tmp[0] ] = $tmp[1];
    }
@endphp
@if(!h::isMobile())

@foreach($finalArray as $k=>$v)
<div class="form-group {{  $ctrl->width}} desktop ">
    <label>
        {{        $v}} @if        (@$ctrl->validate==1)
          <span style="color:#ff0000">(*)</span>@endif
    </label>
    <div class="">
        <input type="text" class="form-control {{@$ctrl->validate==1?'validation':''}}  {{ @$ctrl->needed==1?'needed':''}}   <?=$lang?>" 
               {{@$ctrl->read==1?"readonly":"name=".@$k.$lang}} id="<?=@$name_id?>"   value="<?=@$row->{$k.$lang}?>" placeholder="{{$v}}" />
        <ul class="parsley-errors-list">
            <?=@$ctrl->note?>
        </ul>
    </div>
</div>
@endforeach
@else
<div class="form-group {{  $ctrl->width}} mobo style-input-mobo">
    <ul class="parsley-errors-list">
        <?=@$ctrl->note?>
    </ul>
    <label>
        {{ $ctrl->title }}
        @if(@$ctrl->validate==1) <span style="color:#ff0000">(*)</span>@endif
    </label>
    <div class="input-box">
        <input type="text" class="form-control {{@$ctrl->validate==1?'validation':''}}  {{ @$ctrl->needed==1?'needed':''}}   title<?=$lang?> nd" 
               {{@$ctrl->read==1?"readonly":"name=".@$ctrl->name.$lang}} id="<?=@$ctrl->name.$lang?>"  
                value="<?=@$row->{$ctrl->value.$lang}?>" placeholder="{{$ctrl->att_table}}" />
    </div>
</div>
@endif
