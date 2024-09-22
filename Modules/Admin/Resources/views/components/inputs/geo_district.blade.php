@php
    $multiple =  $multiple??false;
    $colLeft = empty($colLeft) ? 12 : $colLeft;
    if($colLeft == 12){
        $colRight = 12;
    }
    $type = (isset($type) && in_array($type, ['text', 'number', 'date', 'password', 'file', 'hidden' , 'email'])) ? $type : 'text';
    $value = old( $name, $value ?? '' );
    // if($value && is_array($value)){
    //     $data_value = implode(', ', $value);
    // }
    if($multiple && !empty($value))
    {
        $value = json_decode($value,true);
        $data_value = implode(', ', $value);
    }
@endphp
<div class="{{ $rowClass ?? 'form-group col-md-12' }}"
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
            {{Form::select($name,$data,$value,["class"=>"form-control ".$class ?? '','id'=>$name,'data-value'=>@$data_value,'multiple'=>$multiple??false])}}
            <input type="hidden" value="" name="district" id="district" />
            <div class="invalid-feedback">
                {{ $errors->first($name)}}
            </div>
        </div>
    </div>
</div>
