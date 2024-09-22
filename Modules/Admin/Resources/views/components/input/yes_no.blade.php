@php
    $name_id = str_replace(['[', ']', '#'], ['', '', ''], @$name);
@endphp
<div class="row">
    <div class="d-flex flex-align-center">
        <div class="form-check-inline">
            <label for="{{ $name_id }}_yes">Yes</label>
            <input type="radio" {{ @$value == '0' ? 'checked' : '' }} class="form-control" id="{{ $name_id }}_yes" value="{{ @$value }}" {{ @$read == 1 ? 'readonly' : 'name=' . @$name }}{{ @$required ? 'data-required=1' : '' }} />
        </div>
        <div class="form-check-inline">
            <label for="{{ $name_id }}_no">No</label>
            <input type="radio" {{ @$value == '0' ? 'checked' : '' }} class="form-control" id="{{ $name_id }}_no" value="{{ @$value }}" {{ @$read == 1 ? 'readonly' : 'name=' . @$name }}
                {{ @$required ? 'data-required=1' : '' }} />
        </div>
    </div>
</div>