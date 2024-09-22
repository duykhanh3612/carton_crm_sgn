@php
    if (!is_array($records)) {
        $paginate = $records->toArray();
    } else {
        $paginate = $records;
    }
    $limits = [10, 25, 50, 100, 200, 500];
@endphp
<div class="pagination-wrap d-flex text-white">
    <div class="dataTables_paginate">
        <ul class="pagination">
            <li class="disabled"><a href="#">Trang {{ $paginate['current_page'] }}/{{ $paginate['last_page'] }}
                    ({{ $paginate['total'] }}):</a></li>
            @foreach ($paginate['links'] as $page)
                @if (!in_array($page['label'], ['pagination.previous', 'pagination.next']))
                    <li class="{{ $page['active'] == 1 ? 'active' : '' }}"><a class="loading" href="{{ $page['url'] }}">{{ !empty($page['url']) ? $page['label'] : '' }}</a></li>
                @else
                    <li class="{{ $page['label'] }}"></li>
                @endif
            @endforeach
        </ul>
    </div>
    <div class="limit-perpage">
        <span>Show</span>
        <select name="limit_perpage" class="select-status" id="limit_perpage">
            @foreach($limits as $limit)
            <option value="{{ $limit }}" {!! $limit == $GLOBALS['var']['limit_perpage'] ? 'selected="selected"' : '' !!}>{{ $limit }}</option>
            @endforeach
        </select>
        <span>entries</span>
    </div>
</div>
