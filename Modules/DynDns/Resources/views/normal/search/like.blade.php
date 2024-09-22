@php
    $field_lang = @$ctrl->att_field_language==1?$ctrl->name._lang:$ctrl->name ;
@endphp
@if(!h::isMobile())
<div class="col-md-6 form-group desktop row" data-title="like">
    <div class="col-md-4 filter-input-group">
        <label class="filter-input-control">{!!$ctrl->title !!}</label>
    </div>
    <div class="col-md-8">
        <input type="text" class="form-control md_line filter-input-control" name="src[{{ $field_lang }}][like][both]" value="<?=@$src['both']?>" style="padding-right:0px" />
    </div>
</div>
@else
<div class="col-md-6 form-group mobo style-input-mobo">
    <label class="col-md-4">{!!$ctrl->title !!}</label>
    <div class="col-md-9 input-box">
        <input type="text" class="form-control md_line filter-input-control nd" name="src[{{ $field_lang }}][like][both]" value="<?=@$src['both']?>" style="padding-right:0px" />
    </div>
</div>
@endif
