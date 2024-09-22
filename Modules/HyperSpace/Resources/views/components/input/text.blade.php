@php
$name_id = str_replace(['[', ']', '#'], ['', '', ''], @$name);
@endphp
<input type="text" class="form-control" id="{{$name_id}}" value="{{@$value}}" placeholder="{{@$placeholder}}" {{@$read == 1 ? 'readonly' : "name=".@$name}}  {{ @$required? 'data-required=1' : '' }}/>
