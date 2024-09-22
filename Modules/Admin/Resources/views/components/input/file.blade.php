<input type="file" class="form-control mb-1" name="{{ @$name }}" data-file="{{ @$value }}">
@if (!empty($value))
    <a href="{{ image_link(@$value) }}" target="_blank">{{ image_link(@$value) }}</a>
@endif
