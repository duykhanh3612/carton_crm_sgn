@php
    $colLeft = empty($colLeft) ? 12 : $colLeft;
    if($colLeft == 12){
        $colRight = 12;
    }
    $type = (isset($type) && in_array($type, ['text', 'number', 'date', 'password', 'file', 'hidden' , 'email'])) ? $type : 'text';
    $value = old( $name, $value ?? '' );
    if($value && is_array($value)){
        $value = implode(', ', $value);
    }
@endphp
<div class="{{ $rowClass ?? 'form-group' }}"
@if(!empty($rowData))
    @foreach($rowData as $dataKey => $dataVal)
        data-{{$dataKey}}="{{ $dataVal }}"
    @endforeach
@endif
>
    <div class="">
        <div class="form-group">
             @if(!empty($label))
                 <label for="{{ $name }}">{{ $label }}: @if(!empty($required)) <span class="text-danger">*</span>@endif</label>
             @endif
            <input
                @if(!empty($locationId)) locationid = "{{ $locationId }}" @endif
                @if(!empty($addition)) {{ $addition }} @endif
                type="{{ $type }}" @if(!empty($required)) data-required="1" @endif @if(!empty($placeholder)) placeholder="{{ $placeholder }}" @endif
                name="{{ $name }}" @if(!empty($dataType)) data-type="{{ $dataType }}" @endif
                value="{{ $value ?? '' }}"
                id="{{ $name }}"
                @isset($min)
                min="{{ $min }}"
                @endif
                @if(!empty($inputData))
                    @foreach($inputData as $dataKey => $dataVal)
                        data-{{$dataKey}}="{{ $dataVal }}"
                    @endforeach
                @endif
                class="form-control {{ $class ?? '' }} @if($errors->has($name))is-invalid @endif" accept="{{ $accept ?? '' }}" @if(!empty($disabled)) disabled @endif>

            <div class="invalid-feedback">
                {{ $errors->first($name)}}
            </div>
        </div>
    </div>
</div>
