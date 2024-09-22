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
<div class="{{ $rowClass ?? 'form-group col-md-12' }}"
@if(!empty($rowData))
    @foreach($rowData as $dataKey => $dataVal)
        data-{{$dataKey}}="{{ $dataVal }}"
    @endforeach
@endif
>
    <div class="col-md-{{$colLeft}}">
        <div class="form-group">
             @if(!empty($label))
                 <label for="{{ $name }}">{!! $label !!} @if(!empty($required)) <span class="text-danger">*</span>@endif</label>
             @endif
            <input

                type="hidden" name="{{ $name }}" @if(!empty($dataType)) data-type="{{ $dataType }}" @endif
                value="{{ $value!=""?$value:date("Y-m-d")}}" @if(!empty($dataValue)) data-value="{{ $dataValue }}" @endif
                id="{{ $name }}"
            
                @if(!empty($inputData))
                    @foreach($inputData as $dataKey => $dataVal)
                        data-{{$dataKey}}="{{ $dataVal }}"
                    @endforeach
                @endif
                 @if(!empty($disabled)) disabled @endif>
                <span class="form-control create_at lock">
                    {{ $value!=""?date("d/m/Y",strtotime($value)):date("d/m/Y")}}
                </span>
            <div class="invalid-feedback">
                {{ $errors->first($name)}}
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    .create_at.lock{
        background: #f1f0f0 !important;
        border-radius: 5px !important;
    }
</style>
