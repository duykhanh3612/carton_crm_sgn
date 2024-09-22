@php
$name_id = str_replace(['[', ']', '#'], ['', '', ''], @$name);
if($mask=="code" && $value == "")
{
    $value = Modules::getRenderCode($module);
}
@endphp
@if (@$mask == 'textarea')
<textarea class="form-control" {{@$read == 1 ? 'readonly' : 'name='.@$name}} placeholder="{{@$placeholder}}" id="{{ $name_id }}" rows="5" {{ @$required? 'data-required=1' : '' }}>{{ @$value }}</textarea>
@else
<input type="{{ !empty(@$mask) ? @$mask : 'text' }}"   {{ in_array(@$mask, ['checkbox', 'radio']) && @$value == '1' ? 'checked' : '' }} class="form-control {{ in_array(@$mask, ['checkbox', 'radio']) ? 'form-check-input' : '' }}" id="{{$name_id}}" value="{{old(@$name, @$value)}}" placeholder="{{@$placeholder}}" {{@$read == 1 ? 'readonly' : 'name='.@$name}}  {{ @$required? 'data-required=1 data-type='.(!empty(@$mask) ? @$mask : 'text').'' : '' }} />
@endif
