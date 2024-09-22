<!-- Upload a file -->
<div class="form-group">
    <label for="{{ $id }}">{{ $title ?? '' }}</label>
    <input type="file" class="form-control-file" id="{{ $id }}" name="{{ $id }}" @if (!empty($accept)) accept="{{ $accept }}" @endif>
</div>
