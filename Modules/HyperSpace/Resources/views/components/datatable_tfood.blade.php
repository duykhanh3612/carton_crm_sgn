<tfoot>
    <tr>
        @if(!empty(config("admin.".request()->segment(2).".tfirst")))
        @foreach(config("admin.".request()->segment(2).".tfirst") as $thead)
        <th class="{{ @$thead['class'] ?? '' }}">
            {!! @$thead['text'] !!}
        </th>
        @endforeach
        @endif
        <th class="checkbox unorderable w_10 text-center" style="width: 60px;max-width:60px;">
            <div class="checkInput"><input type="checkbox" value="" name="checkAll" class="checkBox" /><label for="checkAll"></label> </div>
        </th>
        @isset($theads)
            @foreach($theads as $thead)
                @if(!isset($thead['role']) || (isset($thead['role']) && checkRole($thead['role'])))
                <th {{@$thead['type']=="colspan"?'colspan='.count($thead['nodes']): ''}} class="headtxt {{ @$thead['class_thead'] ?? '' }} {{ @$thead['orderable'] ? 'orderable' : 'unorderable'}}" data-field="{{ @$thead['field'] }}" id="{{ @$thead['id'] }}">@if(!empty($thead['input']) && !empty($thead['includeThead']))@if($thead['input'] === 'checkbox')<div class="checkInput"><input type="checkbox" class="{{ $thead['inputClass'] }}" id="{{ $thead['inputId'] }}" data-url="{{ route(@$thead['inputRoute']) }}" data-field="{{ @$thead['field'] }}"/><label for="{{ $thead['inputId'] }}"></label></div>@endif @endif @if(!empty($thead['label'])) {{ $thead['label'] }}@endif @if(!empty($thead['text']) || !empty($thead['short_text'])){!! $thead['short_text']??$thead['text'] !!}@endif</th>
                @endif

            @endforeach
        @endisset
    </tr>

    <tr>
        <td colspan="6">
            @if(!empty($footer_include))
                @foreach($footer_include as $include)
                    @include($include)
                @endforeach
            @endif
        </td>
        <td colspan="{{count($theads)+ count(config("admin.".request()->segment(2).".tfirst")??[])+1  - 6}}">
            @isset($config['option']['paginate'])
            <div class="paging" style="float:right">
                {!! $records->links() !!}
            </div>
            @endisset
        </td>
    </tr>
</tfoot>
