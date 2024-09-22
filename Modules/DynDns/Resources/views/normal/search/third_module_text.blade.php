@php
    $table = @$ctrl->att_table_prefix==1?@$admin_group->prefix."_". $ctrl->att_table:$ctrl->att_table;
@endphp
<div class="col-md-6 form-group last pad5_top" title="third_module_text">
    <label class="col-md-4" style="white-space:nowrap;">{!!$ctrl->title !!}</label>

    <div class="col-md-8">
        <input type="text" placeholder="{!!$ctrl->title !!}" class="form-control md_line" name="src[{{ $ctrl->name }}][third_module_text][{{$table}}#{{$ctrl->att_key}}#{{$ctrl->note}}]" value="<?=@$src['third_module_text']?>" style="padding-right:0px" />
    </div>
</div>  
