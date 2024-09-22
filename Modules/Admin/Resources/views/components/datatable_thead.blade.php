<thead>
    <tr>
        @if(!empty(config("admin.".request()->segment(2).".tfirst")))
        @foreach(config("admin.".request()->segment(2).".tfirst") as $thead)
        <th class="{{ @$thead['class'] ?? '' }}">
            {!! @$thead['text'] !!}
        </th>
        @endforeach
        @endif
        <th class="checkbox unorderable w_40">
            <div class="checkInput">
                <input type="checkbox" value="" id="checkAll" name="checkAll" class="checkBox" />
                <label for="checkAll"></label>
            </div>
        </th>
        @isset($theads)
        @foreach($theads as $thead)
        <th class="headtxt {{ @$thead['class_thead'] ?? '' }} {{ @$thead['orderable'] ? 'orderable' : 'unorderable'}}" data-field="{{ @$thead['field'] }}" id="{{ @$thead['id'] }}">
            @if(!empty($thead['input']) && !empty($thead['includeThead']))
                @if($thead['input'] === 'checkbox')
                    <div class="checkInput"><input type="checkbox" class="{{ $thead['inputClass'] }}" id="{{ $thead['inputId'] }}" data-url="{{ route(@$thead['inputRoute']) }}" data-field="{{ @$thead['field'] }}"/><label for="{{ $thead['inputId'] }}"></label></div>
                @endif
            @endif
            @if(!empty($thead['label']))
                {{ $thead['label'] }}
            @endif


            @if(isset($thead['display_filter']))
                    @php
                        if(!empty($model[@$thead['table']]))
                        {

                            $quyery = new $model[@$thead['table']];
                            $options = $quyery::selectRaw((@$thead['table_field']['value']??'name'). ' as name, '.(@$thead['table_field']['key']??"id").' as id')->whereRaw(@$thead['table_where']??='1=1')->pluck("name","id")->toArray();
                        }
                        else{
                            $options = [];
                        }

                    @endphp
                    @include('admin::components.inputs.select', [
                        'label' => '',
                        'name' => 'filter['.$thead['field'].']',
                        'required' =>  @$thead['required'],
                        'value' => @request('filter')[$thead['field']],
                        'class' => 'datatable-filter datatable-filter__select-change',
                        'colLeft' => @$thead['colLeft'],
                        'rowClass' => @$thead['rowClass'],
                        'data' => array_replace ([''=>@$thead['empty_value']??'Select...'],$options)
                    ])
            @else
                @if(!empty($thead['text']))
                {!! $thead['short_text']??$thead['text'] !!}
                @endif
            @endif
        </th>
        @endforeach
        @endisset

    </tr>
</thead>
