@if(@$row->{$func->field_id}!='')
<div class="form-group {{  $ctrl->width}} ">
<!--    <label>
        {{        $ctrl->title }} @if        (@$ctrl->validate==1)
          <span style="color:#ff0000">(*)</span>@endif
    </label>-->
    <div class="">
        <a href="{{h::site_url(h::area_admin.'/'. $ctrl->value.@$row->{$func->field_id})}}" class="btn blue">{!!        $ctrl->name !!}</a>
    </div>
</div>
@endif

