@php
$name_id = str_replace(['[', ']', '#'], ['', '', ''], @$name);
if($value!="")
{
    $value = date("Y-m-d", strtotime($value));
}

@endphp

<input type="date" class="form-control datepicker" id="{{$name_id}}" value="{{@$value}}" placeholder="{{@$placeholder}}" {{@$read == 1 ? 'readonly' : 'name='.@$name}}  {{ @$required? 'data-required=1' : '' }}/>

