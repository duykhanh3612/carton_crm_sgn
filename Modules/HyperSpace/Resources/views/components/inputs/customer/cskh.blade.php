@php
$id = !empty($id) ? $id : '';
$cskh = get_options_keynum_data("cskh");
@endphp
<div class="form-group {{ $rowClass ?? 'col-md-12' }}"
     id="cskh">
    <div class="col-md-12">
        @foreach($cskh as $item=>$lable)
        <div class="row">
            @include('admin::components.inputs.textarea', ['label'=>count($cskh)>1?$lable:$text,'rows'=>10,'name'=>$item,'class'=>'', 'rowClass'=>'col-8', 'value'=> @$record->{$item}])
            @include('admin::components.inputs.text', ['label'=>'Ngày','name'=>'date_'.$item,'class'=>'','required'=>false, 'rowClass'=>'col-4 lock', 'value'=> @$record->{'date_'.$item} ])
        </div>
        @endforeach
        {{-- @include('admin::components.inputs.message', ['label'=>'Tin nhắn','name'=>'message','class'=>'','required'=>false, 'rowClass'=>'', 'value'=> @$record->{'message'} ]) --}}
    </div>
    @push("js")
    @endpush
</div>
