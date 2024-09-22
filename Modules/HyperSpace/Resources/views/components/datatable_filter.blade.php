@php
    $label = !empty($filter['label']) ? $filter['label'] : '';
    $type = !empty($filter['type']) ? $filter['type'] : 'text';
    $filter['label'] = false;
@endphp
@if($type == 'radio')
    <div class="form-group">
        @include('hyperspace::components.inputs.radio', ['label' => @$label, 'name' => @$filter['name'], 'value' => @$filter['value'], 'class' => @$filter['class'],'classInput' => @$filter['classInput'], 'id' => @$filter['id'], 'checked' => @$filter['checked'] ])
    </div>
@elseif($type === 'select')
    <div class="form-group">
        @if($label)
            <label>{{ $label }}</label>
        @endif
        @include('hyperspace::components.inputs.select', $filter)
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
    @include('hyperspace::components.inputs.select', ['name'=>$filter['name'], 'value' => @request("filter")[$filter['field_name']],'data' =>$options,'class'=>$filter['class'],'rowClass'=>'momargin'])
</div>
@elseif($type === 'form_drop')
@php
if(!empty($model[@$filter['table']]))
{
    $query = new $model[@$filter['table']];
    $options = $query::selectRaw((@$filter['table_field']['value']??'name'). ' as name,'.(@$filter['table_field']['key']??"id").' as id')
    ->whereRaw(@$filter['table_where']!=""?@$filter['table_where']:'1=1')->pluck("name","id")->toArray();
}
else{
    $options = [];
}
if(!empty($filter['defaultValue']))
{
    $options = array_replace ($filter['empty_value']??[''=>'Select...'],$options);
}
if(!empty($filter['table_value_except']))
{
    $options = Arr::except($options,$filter['table_value_except']);
}
@endphp
<div class="form-group">
    @if($label)
        <label>{{ $label }}</label>
    @endif
    @include('hyperspace::components.inputs.select', ['name'=>$filter['name'], 'value' => @request("filter")[$filter['field_name']],'data' =>$options,'class'=>$filter['class'],'rowClass'=>'momargin'])
</div>

@elseif($type === 'range_picker')
    @include('hyperspace::components.filters.range_picker')
@elseif($type === 'choose_date')
    @include('hyperspace::components.filters.choose_date')
@elseif($type === 'submit')
    <div class="form-group">
        <button class="btn btn-submit-filter" type="submit">
            @isset($filter['icon']){!! $filter['icon'] !!} @endisset
            {{@$filter['value']}}
        </button>
    </div>
@else
    <div class="form-group w-sm-full d-flex">
        @if(!empty(@$config['actions']))
            @if(check_rights($module->file,"delete"))
            <div class="dropdown">
                <button class="btn btn-actions dropdown-toggle " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-list"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    @foreach ($config['actions'] as $action)
                    <a class="dropdown-item {{$action['class']}}" data-href="{{$action['href']}}">
                        @if(@$action['icon']!="")
                        <i class="{{@$action['icon']}}"></i>
                        @endif
                        <small> {{$action['title']}}</small>
                    </a>
                    @endforeach

                </div>
            </div>
            @endif
        @endif
        @if($label)
            <label>{{ $label }}</label>
        @endif
        @include('hyperspace::components.inputs.text', ['label' => false, 'type'=>'search', 'name' => @$filter['name'], 'value' => request(@$filter['name']), 'rowClass' => 'filter-input '.@$filter['class'], 'placeholder' => @$filter['placeholder'] ])
    </div>
@endif
