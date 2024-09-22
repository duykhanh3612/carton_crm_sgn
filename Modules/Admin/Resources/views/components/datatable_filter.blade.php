@php
    $label = !empty($filter['label']) ? $filter['label'] : '';
    $type = !empty($filter['type']) ? $filter['type'] : 'text';
    $filter['label'] = false;
@endphp
@if($type == 'radio')
    <div class="form-group">
        @include('admin::components.inputs.radio', ['label' => @$label, 'name' => @$filter['name'], 'value' => @$filter['value'], 'class' => @$filter['class'],'classInput' => @$filter['classInput'], 'id' => @$filter['id'], 'checked' => @$filter['checked'] ])
    </div>
@elseif($type === 'select')
    <div class="form-group">
        @if($label)
            <label>{{ $label }}</label>
        @endif
        @include('admin::components.inputs.select', $filter)
    </div>
@elseif($type === 'option_items_keynum')
@php
if(!empty(@$filter['option_key']))
{
    $options = get_options_keynum_data($filter['option_key']??$filter['field']);
    if(!empty(@$filter['empty_value']))
    {
        $options = array_replace($filter['empty_value'],$options);
    }
}
else{
    $options = [];
}
@endphp
<div class="form-group">
    @if($label)
        <label>{{ $label }}</label>
    @endif
    @include('admin::components.inputs.select', ['name'=>$filter['name'], 'value' => request($filter['name']),'data' =>$options,'class'=>$filter['class'],'rowClass'=>'momargin'])
</div>
@elseif($type === 'form_drop')
@php
if(!empty($model[@$filter['table']]))
{
    $query = new $model[@$filter['table']];
    $options = $query::selectRaw((@$filter['table_field']['value']??'name'). ' as name,'.(@$filter['table_field']['key']??"id").' as id')
    ->whereRaw(@$filter['table_where']!=""?:'1=1')->pluck("name","id")->toArray();
}
else{
    $options = [];
}
if(!empty($filter['defaultValue']))
{
    $options = array_replace ([''=> @$filter['empty_value']??'Select...'],$options);
}
@endphp
<div class="form-group">
    @if($label)
        <label>{{ $label }}</label>
    @endif
    @include('admin::components.inputs.select', ['name'=>$filter['name'], 'value' => request($filter['name']),'data' =>$options,'class'=>$filter['class'],'rowClass'=>'momargin'])
</div>
@elseif($type === 'range_picker')
    @include('admin::components.filters.range_picker')
@elseif($type === 'submit')
    <div class="form-group">
        <button class="btn btn-submit-filter" type="submit">
            @isset($filter['icon']){!! $filter['icon'] !!} @endisset
            {{@$filter['value']}}
        </button>
    </div>
@else
    <div class="form-group d-flex">
        @if($label)
            <label>{{ $label }}</label>
        @endif
        @include('admin::components.inputs.text', ['label' => false, 'name' => @$filter['name'], 'value' => request($filter['name']), 'rowClass' => 'filter-input '.@$filter['class'], 'placeholder' => @$filter['placeholder'] ])
    </div>
@endif
