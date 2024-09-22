@php
    $id = !empty($id) ? $id : '';
@endphp
<div class="form-check m-1 {{ $class ?? '' }}">
    <input {{ $addition ?? '' }} class="form-check-input {{ $classInput ?? '' }}" ischecked="{{ !empty($checked) ? 'true' : 'false' }}" type="radio" value="{{ $value ?? '' }}" {{ !empty($checked) ? 'checked' : '' }} id="{{ $id }}" name="{{ $name ?? '' }}" />
    @if(!empty($label))
        <label class="form-check-label m-1" for="{{ $id }}">
            {{ $label }}
        </label>
    @endif
</div>
