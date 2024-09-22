@php
    if(empty($navs)) $navs = array();
    if(empty($refresh)) $refresh = array();
    $current_tab = request()->current_tab ? request()->current_tab : 0;
@endphp
@if($navs)
    <ul id="full-size-menu" class="nav nav-tabs opt-tab float-left">
        @foreach($navs as $i => $nav)
            <li class="@if($i == $current_tab) active @endif"><a href="javascript:void(0)" data-group="group-{{ $i }}"
                                                                 class="btnBody btnGrey group-{{ $i }}"
                                                                 title="{{ $nav['title'] ?? $nav['label'] }}">{{ $nav['label'] }}</a>
            </li>
        @endforeach
    </ul>
    <div id="small-size-menu" class="small-size-menu">
        <select id="selectTab">
            @foreach($navs as $i => $nav)
                <option value="group-{{ $i }}">{{ $nav['label'] }}</option>
            @endforeach
        </select>
    </div>
    @if(!empty($childrenTabs))
        @foreach($childrenTabs as $route => $title)
            <a href="{{ route($route,$page) }}" class="marginButton btnBody btnGreen float-right">
                <span class="hidden-xs">{{ $title }}</span>
            </a>
        @endforeach
    @endif

    @isset($back)
    @if($back)
        <a href="{{ route($back['route'],$page)}}" class="marginButton btnBody btnGreen float-right"><span class="hidden-xs">Back To NetSuite</span><i
                    class="glyphicon glyphicon-repeat"></i></a>
    @endif
    @endisset

    @if($refresh)
        <a href="{{ route($refresh['route'],$page)}}" class="btnBody btnGreen float-right"><span
                    class="hidden-xs">Refresh</span><i class="glyphicon glyphicon-repeat"></i></a>
    @endif
@endif
