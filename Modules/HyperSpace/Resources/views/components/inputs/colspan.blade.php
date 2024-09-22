@php
    $colLeft = empty($colLeft) ? 12 : $colLeft;
    if($colLeft == 12){
        $colRight = 12;
    }
    $type = (isset($type) && in_array($type, ['text', 'number', 'date', 'password', 'file', 'hidden' , 'email'])) ? $type : 'text';
    $value = old( $name??"", $value ?? '' );
    if($value && is_array($value)){
        $value = implode(', ', $value);
    }
@endphp
<div class="{{ $rowClass ?? 'col-md-12' }}"
@if(!empty($rowData))
    @foreach($rowData as $dataKey => $dataVal)
        data-{{$dataKey}}="{{ $dataVal }}"
    @endforeach
@endif
>
    <div class="col-md-{{$colLeft}}">
        <div class="form-group">
            @if(!empty($text))
                <label for="{{ $text }}" class="title-tab">{{ $text }} @if(!empty($required)) <span class="text-danger">*</span>@endif</label>
            @endif
            <div class="row nodes" style="margin-left: -30px;margin-right: -30px;">
            @foreach($nodes as $node)
            {!! view('admin::components.inputs.'.($node['type'] ?? 'text'), [
                'label' => $node['text'],
                'name' => $node['field'],
                'required' =>  @$node['required'],
                'value' => @$record->{$node['field']},
                'class' => '',
                'colLeft' => @$node['colLeft'],
                'rowClass' => @$node['rowClass']
                ]) !!}
            @endforeach
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    .nodes .form-group {
        margin-bottom: 0;
    }
</style>
