@if($records)
    <tbody>
        @foreach($records as $i => $record)
        @php $index = $loop->index+1; @endphp
            <tr data-matrixid="" data-ismatrix="">
                @if(!empty(config("admin.".request()->segment(2).".tfirst")))
                @foreach(config("admin.".request()->segment(2).".tfirst") as $thead)
                <td class="{{ @$thead['class'] ?? '' }}">
                    <span data-id="{{ $record->id }}">
                        {!! @$thead['html'] !!}
                    </span>
                </td>
                @endforeach
                @endif
                <td class="checkbox ">
                    <div class="checkInput">
                        <input type="checkbox" class="checkBox listItemids" name="ids[]" value="{{ $record->id }}" id="check-{{ $i }}"/>
                         <label for="check-{{ $i }}"></label>
                    </div>
                </td>
                @isset($theads)
                @foreach($theads as $thead)
                @if( @$thead['type'] == "colspan")
                    @foreach ($thead['nodes'] as $node)
                    <td class="{{ @$thead['class'] ?? '' }}">
                        {{-- {{ $record->{$node['field']} }} --}}
                        {!! view('admin::components.datatable_record_value',['thead'=>$node,'record'=>$record]) !!}
                    </td>
                    @endforeach


                @else

                    @if(!isset($thead['role']) || (isset($thead['role']) && checkRole($thead['role'])))
                    <td class="{{ @$thead['class'] ?? '' }}">
                        @php $noValue = 0 @endphp
                        @if(!empty($thead['input']))
                            @php $noValue = 1 @endphp
                            @if($thead['input'] === 'no')
                                {{ ( request('page', 1) - 1) * $records->perPage() + $index }}
                            @elseif( $thead['input']== "icon")
                                <span data-id="{{ $record->id }}">
                                {!! $thead['html'] !!}
                                </span>
                            @elseif($thead['input'] === 'checkbox')
                                @php
                                    $checked = 0;
                                    $field = $thead['field'];
                                    if($field && !empty($record->$field)){
                                        $checked = 1;
                                    }
                                @endphp
                                <div class="checkInput"><input type="checkbox" class="{{ $thead['inputClass'] }}" id="{{ $thead['inputId'] }}{{ $i }}" value="{{ $record->_id }}" data-url="{{ route(@$thead['inputRoute']) }}" data-field="{{ @$thead['field'] }}" @if($checked) checked="checked" @endif /><label for="{{ $thead['inputId'] }}{{ $i }}"></label></div>
                            @elseif($thead['input'] === 'checkbox-readonly')
                                @php
                                    $checked = 0;
                                    $field = $thead['field'];
                                    if($field && !empty($record->$field)){
                                        $checked = 1;
                                    }
                                @endphp
                                <div class="checkInput"><input type="checkbox" onclick="return false;" class="{{ $thead['inputClass'] }}" id="{{ $thead['inputId'] }}{{ $i }}"  @if($checked) checked="checked" @endif /><label for="{{ $thead['inputId'] }}{{ $i }}"></label></div>
                            @elseif($thead['input'] === 'select')
                                <span >{{$thead['options'][$record->{$thead['field']}] ?? $record->{$thead['field']} }}</span>
                            @endif
                            @if($thead['input'] === 'text')
                                <div class="cell-text"><input type="text" class="{{ $thead['inputClass'] }}" id="{{ $thead['inputId'] }}{{ $i }}" value="{{ $record->{$thead['field']} }}" data-url="{{ @$thead['inputRoute'] ? route(@$thead['inputRoute']) : '' }}" data-field="{{ @$thead['field'] }}" data-id="{{$record->_id}}"/></div>
                            @endif
                            @if($thead['input'] === 'action')
                                <div>
                                    <a href="{{ route('franchise.user.update', $record->_id ) }}">Edit</a>
                                    |
                                    <a href="javascript:;" data-item-id="{{ $record->_id }}" class="js-remove-item">Delete</a>
                                </div>
                            @endif
                        @endif
                        @if(!empty($thead['label']))
                            {{ $thead['label'] }}
                        @endif
                        @if(!$noValue)
                            @if(@$thead['text_class']) <span class="{{@$thead['text_class']}}"> @endif
                            @include('hyperspace::components.datatable_record_value')
                            @if(@$thead['text_class']) </span> @endif
                        @endif
                    </td>
                    @endif
                @endif
                @endforeach
                @endisset

            </tr>
        @endforeach
    <tbody>
@endif
