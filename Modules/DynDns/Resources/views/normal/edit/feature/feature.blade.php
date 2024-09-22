<!--FEATURE-->
@if(!h::isMobile())
<div class="form-group {{  $ctrl->width}} desktop ">
    <label>
        {{        $ctrl->title }} 
        @if(@$ctrl->validate==1)
        <span style="color:#ff0000">(*)</span>
        @endif
    </label>
    <div class="">
        <a onclick="addField('vn')" class="button add-field">Thêm</a>
        <ul class="" id="feature-list-vn"></ul>
    </div>
</div>
@else

@endif
<!--//FEATURE -->