@php
$colLeft = empty($colLeft) ? 12 : $colLeft;
if ($colLeft == 12) {
    $colRight = 12;
}
$value = old($name, $value ?? '');
if ($value && is_array($value)) {
    $value = implode(', ', $value);
}
@endphp
<div class="form-group {{ $rowClass ?? 'col-md-12' }}"
    @if (!empty($rowData)) @foreach ($rowData as $dataKey => $dataVal)
        data-{{ $dataKey }}="{{ is_array($dataVal) ? json_encode($dataVal) : $dataVal }}"
    @endforeach @endif>
    <div class="col-md-{{ $colLeft }}">
        <div class="form-group">
            @if (!empty($label))
                <label for="{{ $name }}">{{ $label }}: @if (!empty($required))
                        <span class="text-danger">*</span>
                    @endif
                </label>
            @endif
            <textarea name="{{ $name }}" id="{{ $name }}"
                class="form-control ckeditor {{ $class ?? '' }} @if ($errors->has($name)) is-invalid @endif"
                accept="{{ $accept ?? '' }}" data-separator="{{ $separator ?? '' }}" placeholder="{{ @$placeholder }}">{{ $value ?? '' }}</textarea>
            <div class="invalid-feedback">
                {{ $errors->first($name) }}
            </div>
        </div>
    </div>
</div>

@push('js')
    <script src="{{ url('public/plugin/ckeditor/ckeditor.js') }}"></script>
    <script>
        // CKEDITOR.editorConfig = function( config ) {
        //     config.language = 'en';
        //     config.uiColor = '#F7B42C';
        //     config.height = 300;
        //     config.toolbarCanCollapse = true;
        // };


        CKEDITOR.replace('editor', {
            toolbarGroups: [{
                    name: 'mode'
                },
                {
                    name: 'basicstyles'
                }
            ],
            on: {
                change: function(evt) {
                   alert('s');

                }
            }
        });
    </script>
@endpush
