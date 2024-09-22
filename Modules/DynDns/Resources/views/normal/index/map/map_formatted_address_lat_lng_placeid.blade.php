@php

             $makert = $ctrl->att_table;
             $dm = md::find($ctrl->att_table,$ctrl->att_key."='".@$row->{$ctrl->att_where}."'")
@endphp
<td class="textleft" style="max-width:250px;white-space:nowrap !important; max-height:50px; ">
    <div style="white-space:normal !important;  width:250px;">
        {{@$dm->formatted_address}}
    </div>
</td>
