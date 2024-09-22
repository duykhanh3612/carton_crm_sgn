@php
    $colLeft = empty($colLeft) ? 12 : $colLeft;
    if($colLeft == 12){
        $colRight = 12;
    }
    $multiple = !empty($multiple) ? $multiple : false;
    $allSelected = false;
    if(!isset($value) && !empty($defaultSelectAll) && $multiple) {
        $allSelected = true;
    }
    $value = old( $name, $value ?? '' );

    if($multiple && !$value){
        $value = [];
    }
@endphp

<div class="row {{ $mainClass ?? '' }} {{ $rowClass ?? '' }}"
     @if(!empty($rowData))
     @foreach($rowData as $dataKey => $dataVal)
     data-{{$dataKey}}="{{ $dataVal }}"
        @endforeach
        @endif
>
    <div class="col-md-{{ $colLeft }}">
        <div class="form-group">
            @if(!empty($label))
                <label for="{{ $name }}">{{ $label }}: @if(!empty($required)) <span class="text-danger">*</span>@endif
                </label>
            @endif
            @if(!empty($note))
                <p><small>{{ $note }}</small></p>
            @endif
            <select @if(!empty($keyType)) keyType="{{ $keyType }}" @endif
                @if($multiple) multiple="multiple" @endif @if(!empty($dataType)) data-type="{{ $dataType }}" @endif
                @if(!empty($style)) style="{{$style}}" @endif
                @if(!empty($required)) required @endif
                @if(!empty($inputData))
                @foreach($inputData as $dataKey => $dataVal)
                data-{{$dataKey}}="{{ $dataVal }}"
                @endforeach
                @endif
                name="{{ $name }}" id="{{ $name }}"
                class="form-control {{ $class ?? '' }}">
                @if($data && is_array($data))
                    @foreach($data as $key => $item)
                        @if($multiple)
                            <option {{ in_array($key, $value) || $allSelected ? 'selected' : ''}} value="{{ $key }}">{{ $item }}</option>
                        @else
                            <option value="{{ $key }}" {{ ((string) $key == (string) $value)? 'selected' : ''}} >{{ $item }}</option>
                        @endif
                    @endforeach
                @elseif($value && !empty($inputData['ajax--url']))
                   @if($multiple && is_array($value))
                       @foreach($value as $val)
                            <option value="{{ $val }}" selected>{{ $val }}</option>
                       @endforeach
                   @else
                       <option value="{{ $value }}" selected>{{ $value }}</option>
                   @endif
                @endif
            </select>
        </div>
    </div>
</div>
