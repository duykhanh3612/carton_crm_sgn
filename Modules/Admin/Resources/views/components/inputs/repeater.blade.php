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
<div class="row {{ $rowClass ?? '' }}"
@if(!empty($rowData))
    @foreach($rowData as $dataKey => $dataVal)
        data-{{$dataKey}}="{{ $dataVal }}"
    @endforeach
@endif
>
    <div class="col-md-{{$colLeft}}">
        <div class="form-group">
            @foreach($nodes as $node)
            {!! view('admin::components.inputs.'.($node['type'] ?? 'text'), [
                'label' => $node['text'],
                'name' => $name."[".$node['field']."]",
                'required' =>  @$node['required'],
                'value' => @$node->{$node['field']},
                'class' => 'update-eloquent',
                'colLeft' => @$node['colLeft'],
                'rowClass' => @$node['rowClass']
                ]) !!}
            @endforeach
        </div>
    </div>
</div>
