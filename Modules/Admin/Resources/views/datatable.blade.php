@extends('admin::layouts.master')
@section('content')
    <input type="hidden" id="request_data" value="{{ json_encode(request()) }}" />
    <input type="hidden" id="current_tab" value="{{ request()->current_tab ?? 0 }}" />
    <input type="hidden" id="sort_column" value="{{ request()->sort_column ?? 1 }}" />
    <input type="hidden" id="sort_field" value="{{ request()->sort_field ?? 'id' }}" />
    <input type="hidden" id="sort_order" value="{{ request()->sort_order ?? 'desc' }}" />
    <input type="hidden" id="current_limit" value="{{ request()->current_limit ?? 25 }}" />
    <input type="hidden" id="categoryID" value="{{ request()->categoryID ?? 1 }}" />

    @php
        if(!is_array($records)){
            $paginate = $records->toArray();
        }else{
            $paginate = $records;
        }
        $limits = [10, 25, 50, 100, 200, 500];
    @endphp

    <input type="hidden" id="path" name="path" value="{{ $paginate['path'] }}">
    <input type="hidden" id="current_page" name="current_page" value="{{ $paginate['current_page'] }}">
    <input type="hidden" id="last_page" name="last_page" value="{{ $paginate['last_page'] }}">
    <input type="hidden" id="limit" name="limit" value="{{ $paginate['per_page'] }}">


    <form id="form-update-selected" action="" method="POST"><input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" /><div id="form-update-selected-content"></div></form>
    <div class="container-fluid main">
        <div class="dataManagement">
            <div class="headTabs clearfix">
                <h4 class="float-left">
                    {{ @$params['title'] }}
                </h4>
                <div class="rightSide">
                    @include('admin::components.datatable_nav')
                </div>
            </div>
            <!-- Tab panes -->
            <div class="tab-content">
                @include('admin::components.datatable_content')
            </div>
        </div>
    </div>
    @isset($footer)
        @include('admin::components.datatable_button')
    @endisset
    @if(!empty($includes))
        @foreach($includes as $include)
            @include($include)
        @endforeach
    @endif
@endsection

<?php if (!empty($routeRemoveItems) || !empty($routeUpdateStatusItems)): ?>
<script>
    let routeRemoveItems = "{{ $routeRemoveItems }}";
    let routeUpdateStatusItems = "{{ $routeUpdateStatusItems }}";
</script>
<?php endif;?>
