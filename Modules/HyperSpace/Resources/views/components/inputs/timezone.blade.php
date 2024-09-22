@php
    $value = !empty($value) ? $value : 'US/Pacific';
    $timezones = config('constants.timezone.list');
    $required = !empty($required) ? $required : false;
    $disabled = !empty($disabled) ? 'disabled' : '';
    $name = !empty($name) ? $name : 'timezone';
@endphp
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            @php
                if (!empty($label)) {
                    echo '<label for="{{ $name }}">{{$label}}</label>';
                }
            @endphp
            <select name="{{ $name }}" id="{{ $name }}" class="select form-control {{ $class ?? '' }}"  @if($disabled) disabled @endif>
                @php
                    if (!empty($timezones)) {
                        foreach ($timezones as $key => $timezone) {
                            echo '<option value="' . $key . '" label="' . $timezone . '">' . $timezone . '</option>';
                        }
                    }
                @endphp
            </select>
        </div>
    </div>
</div>

@push('javascripts')
    <script>
         $("#{{ $name }}").val("{{ $value }}");
    </script>
@endpush
