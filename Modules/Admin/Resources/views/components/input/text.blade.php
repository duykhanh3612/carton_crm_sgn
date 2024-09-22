@php
$name_id = str_replace(['[', ']', '#'], ['', '', ''], @$name);
@endphp
@if (@$mask == 'textarea')
<textarea class="form-control" {{@$read == 1 ? 'readonly' : 'name='.@$name}} placeholder="{{@$placeholder}}" id="{{ $name_id }}" rows="5" {{ @$required? 'data-required=1' : '' }}>{{ @$value }}</textarea>
@else
<input type="{{ !empty(@$mask) ? @$mask : 'text' }}" {{ in_array(@$mask, ['checkbox', 'radio']) && @$value == '1' ? 'checked' : '' }} class="form-control" id="{{$name_id}}" value="{{@$value}}" placeholder="{{@$placeholder}}" {{@$read == 1 ? 'readonly' : 'name='.@$name}}  {{ @$required? 'data-required=1' : '' }}/>
@endif

