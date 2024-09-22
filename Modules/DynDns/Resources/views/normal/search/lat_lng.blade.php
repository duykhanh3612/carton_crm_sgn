
@php
$latlng = explode (",",$ctrl->name );
$lat = $latlng[0];
$lng = $latlng[1];

$v_latlng = explode (",",@$src['both'] );


@endphp
@if(!h::isMobile())
<div class="col-md-6 form-group desktop">

    <div class="col-md-4 filter-input-group">
        <label class="filter-input-control">{!!$ctrl->title !!}</label>
    </div>

    <div class="col-md-8">
        <input type="text" class="form-control md_line filter-input-control {{ str_replace(',','_',$ctrl->name) }} " value="<?=@$src['lat']?>,<?=@$src['lng']?>" style="padding-right:0px" />
        <input type="hidden" class="form-control md_line filter-input-control {{$lat}}" name="src[{{ $ctrl->name }}][latlng][lat]" value="<?=@$src['lat']?>" style="padding-right:0px" />
        <input type="hidden" class="form-control md_line filter-input-control {{$lng}}" name="src[{{ $ctrl->name }}][latlng][lng]" value="<?=@$src['lng']?>" style="padding-right:0px" />
    </div>
</div>
@else
<div class="col-md-6 form-group mobo style-input-mobo">
    <label class="filter-input-control">{!!$ctrl->title !!}</label>
    <div class="col-md-9 input-box">
        <input type="text" class="form-control md_line filter-input-control nd" name="src[{{ $ctrl->name }}][like][both]" value="<?=@$src['both']?>" style="padding-right:0px" />
    </div>
</div>
@endif
<script>
    $('.{{str_replace(",","_",$ctrl->name)}}').keyup(function () {
        var value = $(this).val().split(",");
        $('.{{$lat}}').val(value[0]);
        $('.{{$lng}}').val(value[1]);
    });
</script>
