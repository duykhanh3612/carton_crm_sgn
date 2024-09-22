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
@php
             $with = "col-md-12";
    switch($k){
        case "home_technical_infrastructure":
            $with = "col-md-12";
            break;
        case "home_social_infrastructure":
        case "home_planning":
        case "home_business_environment":
        case "home_living_environment":
            $with = "col-md-6";
            break;
        case "home_traffic":
        case "home_security":
        case "home_feng_shui":
            $with = "col-md-4";
            break;
    }
@endphp
<div class="form-group {{  $with}} desktop ">
    <label>
        {{        $v}} @if        (@$ctrl->validate==1)
        <span style="color:#ff0000">(*)</span>@endif
    </label>
    <div class="">
        <textarea {{@$ctrl->
            read==1?"readonly":"id=".@$k." name=".@$k}} rows="2" class="textarea form-control {{ @$ctrl->needed==1?'needed':''}} " style="width:100%;{!! @$ctrl->att_style !!}"><?=@$row->{$k}?>
        </textarea>
        <script>
            $('.textarea').change(function () {
                var content = $(this).val();
                $(this).val(content.trim());

            });
        </script>
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
