@if(view()->exists("admin::sys.template.normal.index.".$ctrl->type.'.'.@$ctrl->mask))
@include("admin::sys.template.normal.index.".$ctrl->type.'.'.@$ctrl->mask)
@else
@include("admin::sys.template.normal.index.".$ctrl->type.'.'.$ctrl->type)
@endif
