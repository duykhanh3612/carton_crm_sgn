@php
    if(!is_array($records)){
        $paginate = $records->toArray();
    }else{
        $paginate = $records;
    }
    $limits = [10, 25, 50, 100, 200, 500];
@endphp
<div class="paginateSelect paginateCustom">
    <input type="hidden" id="path" name="path" value="{{ $paginate['path'] }}">
    <input type="hidden" id="current_page" name="current_page" value="{{ $paginate['current_page'] }}">
    <input type="hidden" id="last_page" name="last_page" value="{{ $paginate['last_page'] }}">
    <input type="hidden" id="limit" name="limit" value="{{ $paginate['per_page'] }}">

    <div class="dataTables_paginate paging_full_numbers">
        <ul class="pagination">
            <li class="paginate_button first dataTablesContent_first">
                <a href="javascript:;" data-href="{{ $paginate['first_page_url'] }}" data-to-page="1">
                    <i class="sprite i24 first"></i>
                </a>
            </li>
            <li class="paginate_button previous dataTablesContent_previous">
                <a href="javascript:;" data-href="{{ $paginate['prev_page_url'] }}"
                   data-to-page="{{ $paginate['current_page'] - 1 }}">
                    <i class="sprite i24 pre"></i>
                </a>
            </li>
            <li>
                <div class="clonePageInfo">
                    <div class="dataTables_info" id="dataTablesContent_info" role="status" aria-live="polite">
                        View {{ $paginate['from'] ?? 0 }} - {{ $paginate['to'] ?? 0 }} of {{ $paginate['total'] }}
                    </div>
                </div>
            </li>
            <li class="paginate_button next dataTablesContent_next">
                <a href="javascript:;" data-href="{{ $paginate['next_page_url'] }}"
                   data-to-page="{{ $paginate['current_page'] + 1 }}">
                    <i class="sprite i24 next"></i>
                </a>
            </li>
            <li class="paginate_button last dataTablesContent_last">
                <a href="javascript:;" data-href="{{ $paginate['last_page_url'] }}"
                   data-to-page="{{ $paginate['last_page'] }}">
                    <i class="sprite i24 last"></i>
                </a>
            </li>
        </ul>
    </div>

    <div class="customLength dataTablesContent_length">
        <label>
            <select name="limit" aria-controls="dataTablesContent" class="form-control input-sm limit-changed">
                @foreach($limits as $item)
                    <option
                        value="{{ $item }}" {{ ($item == request('limit', 25)) ? 'selected' : ''}}>{{ $item }}</option>
                @endforeach
            </select>
        </label>
    </div>
</div>
