@php
    $colLeft = empty($colLeft) ? 12 : $colLeft;
    if($colLeft == 12){
        $colRight = 12;
    }
    $type = (isset($type) && in_array($type, ['text', 'number', 'date', 'password', 'file', 'hidden' , 'email'])) ? $type : 'text';
    $repeater_value = json_decode($value)??[];
@endphp
<component  id="repeater_{{$name}}" class="form-group col-md-12 repeater_fields"
@if(!empty($rowData))
    @foreach($rowData as $dataKey => $dataVal)
        data-{{$dataKey}}="{{ $dataVal }}"
    @endforeach
@endif
>
    <textarea name="{{$name}}" id="{{$name}}" style="width: 100%;display:none;">{{ $value ?? '' }}</textarea>
    <div class="col-md-{{$colLeft}}" id="repeater">

            @foreach ($repeater_value as $rv)

                <div class="row repeater_items d-flex" style="{{ (!boolval(@$check_role) || isAdmin() || @$rv->sale == auth()->user()->id)?'':'pointer-events: none;'}}">

                    @foreach($nodes as $node)
                    {!! view('hyperspace::components.inputs.'.($node['type'] ?? 'text'), [
                        'label' => $node['text'],
                        'name' => '',
                        'inputData' => [
                            'name' => $node['field']
                        ],
                        'required' =>  @$node['required'],
                        'value' => @$rv->{$node['field']},
                        'class' =>  $node['field'].' repeater_item '. $node['class'],
                        'rowClass' =>  $node['rowClass'],
                        ]) !!}
                    @endforeach
                    @if(isAdmin() || @$rv->sale == auth()->user()->id)
                    <div class="repeater_item_remove"><i class=" fa fa-times"></i></div>
                    @endif
                </div>
            @endforeach


    </div>
    <div class="row" id="repeaterItem" style="display: none">
        @foreach($nodes as $node)
        {!! view('hyperspace::components.inputs.'.($node['type'] ?? 'text'), [
            'label' => $node['text'],
            // 'name' => $name."[".$node['field']."]",
            'name' => '',
            'inputData' => [
                'name' => $node['field']
            ],
            'required' =>  @$node['required'],
            'class' => $node['field'].' repeater_item '. $node['class'],
            'rowClass' =>  $node['rowClass'],
            ]) !!}
        @endforeach
        <div class="repeater_item_remove"><i class=" fa fa-times"></i></div>
    </div>
    <button type="button" class="btn" id="btn-repeated-add" data-toggle="tooltip">Thêm</button>
    @push("js")
    <style type="text/css">
        .repeater_item_remove{
            color: rgb(247, 0, 0);
            padding-top: 25px;
            cursor: pointer;
            margin-top: 5px;
        }
        .repeater_items{
            flex-wrap: nowrap;
            counter-increment: my-sec-counter;
        }
        .repeater_items::before{
            content: counter(my-sec-counter) " - ";
        display: block;
        white-space: nowrap;
        padding-top: 31px;
        font-weight: 600;
        padding-left: 17px;
        }
    </style>

    @endpush
</component>
