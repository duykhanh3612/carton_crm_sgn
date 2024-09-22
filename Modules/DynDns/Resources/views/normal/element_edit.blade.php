@if(view()->exists("admin::sys.template.normal.edit.".$ctrl->type.'.'.@$ctrl->mask))
@include("admin::sys.template.normal.edit.".$ctrl->type.'.'.@$ctrl->mask)
@else
@include("admin::sys.template.normal.edit.".$ctrl->type.'.'.$ctrl->type)
@endif
