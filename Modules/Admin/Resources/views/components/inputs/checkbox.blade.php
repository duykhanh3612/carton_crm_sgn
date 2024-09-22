@php
    $id = !empty($id) ? $id : $name;
@endphp
<div class="form-group {{ $rowClass ?? 'col-md-12' }}">
    <div class="col-md-12">
        <input type="hidden" class="{{ $class ?? '' }}"  name="{{ $name ?? '' }}"  value="{{ intval($value)}}" />
            @if(strpos($rowClass,"wrap")===false)
                <input {{ $addition ?? '' }} class="form-check-input {{ $classInput ?? '' }}"  type="checkbox" {{ intval($value) ? 'checked' : '' }} id="{{ $id }}" >
            @if(!empty($label))
                <label class="form-check-label ml-4" for="{{ $id }}" >
                    {{ $label }}
                </label>
            @endif

        @else
            @if(!empty($label))
                <label class="form-check-label ml-4" for="{{ $id }}" >
                    {{ $label }}
                </label>
            @endif
            <div class="form-control" style="border: 0">
                <input {{ $addition ?? '' }} class="form-check-input {{ $classInput ?? '' }}"  type="checkbox" {{ intval($value) ? 'checked' : '' }} id="{{ $id }}" >
            </div>
        @endif

    </div>
</div>
@push('js')
<script>

    $('.form-check-input ').change(function(){
        if($(this).prop("checked"))
        {
            $(this).parent().find("input").val(1);
        }
        else{
            $(this).parent().find("input").val(0);
        }
    });
</script>

@endpush
