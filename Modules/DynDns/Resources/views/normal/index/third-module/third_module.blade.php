@php
$third_module_table = $ctrl->att_table;
$tr = md::find($ctrl->att_table,$ctrl->att_key."='".@$row->{$ctrl->note}."'")
@endphp
@if(!h::isMobile())
<td style="white-space:normal !important;  {{@$ctrl->att_style}} " class="{{@$ctrl->mobile!=1?" hidden-xs-down":""}}">
    <div style="word-wrap:break-word !important; max-width:300px;">
        <?=@$tr->{$ctrl->value.$lang}?>
    </div>

</td>

@endif
