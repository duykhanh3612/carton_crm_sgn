@php
    $colLeft = empty($colLeft) ? 12 : $colLeft;
    if($colLeft == 12){
        $colRight = 12;
    }
    $value = old( $name, $value ?? '' );
    if($value && is_array($value)){
        $value = implode(', ', $value);
    }
@endphp
<div class="{{ $rowClass ?? 'form-group col-md-12' }}"
@if(!empty($rowData))
    @foreach($rowData as $dataKey => $dataVal)
        data-{{$dataKey}}="{{  is_array($dataVal) ? json_encode($dataVal) : $dataVal }}"
    @endforeach
@endif
>
    <div class="col-md-{{$colLeft}}">
        <div class="form-group">
             @if(!empty($label))
                 <label for="{{ $name }}">{{ $label }}: @if(!empty($required)) <span class="text-danger">*</span>@endif</label>
             @endif
            <textarea
                @if(!empty($required)) required @endif @if(!empty($dataType)) data-type="{{ $dataType }}" @endif
                name="{{ $name }}"
                id="{{ $name }}"
                rows="{{ $rows ?? '' }}"
                cols="{{ $cols ?? '' }}"
                class="form-control {{ $class ?? '' }}  @if($errors->has($name))is-invalid @endif" accept="{{ $accept ?? '' }}" data-separator="{{ $separator ?? '' }}"
                placeholder="{{@$placeholder}}"
                @if(!empty($inputData))
                    @foreach($inputData as $dataKey => $dataVal)
                        data-{{$dataKey}}="{{ is_array($dataVal) ? json_encode($dataVal) : $dataVal }}"
                    @endforeach
                @endif
                @if(!empty($disabled)) disabled @endif >{{ $value ?? '' }}</textarea>

            <div class="invalid-feedback">
                {{ $errors->first($name)}}
            </div>
        </div>
    </div>
</div>
