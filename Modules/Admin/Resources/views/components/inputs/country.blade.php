@php
    $value = !empty($value) ? $value : 'US';
    $countries = config('constants.country.list');
    $name = !empty($name) ? $name : 'country';
@endphp
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="{{ $name }}">Country</label>
            <select name="{{ $name }}" id="{{ $name }}" class="select form-control {{ $class ?? '' }}">
                @php
                    if (!empty($countries)) {
                        foreach ($countries as $key => $country) {
                            echo '<option value="' . $key . '" label="' . $country['name'] . '">' . $country['name'] . '</option>';
                        }
                    }
                @endphp
            </select>
        </div>
    </div>
</div>

@push('javascripts')
    <script>
        $(document).ready(function () {
            $("#{{ $name }}").val("{{ $value }}");
        })
    </script>
@endpush
