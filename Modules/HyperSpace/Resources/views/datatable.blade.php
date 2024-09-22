@extends('admin::layouts.master')
@section('content')
    <input type="hidden" id="request_data" value="{{ json_encode(request()) }}" />
    <input type="hidden" id="current_tab" value="{{ request()->current_tab ?? 0 }}" />
    <input type="hidden" id="sort_column" value="{{ request()->sort_column ?? 1 }}" />
    <input type="hidden" id="sort_field" value="{{ request()->sort_field ?? 'id' }}" />
    <input type="hidden" id="sort_order" value="{{ request()->sort_order ?? 'desc' }}" />
    <input type="hidden" id="current_limit" value="{{ request()->current_limit ?? 25 }}" />
    <input type="hidden" id="categoryID" value="{{ request()->categoryID ?? 1 }}" />
    <input type="hidden" id="act" value="{{ request()->segment(2) }}" />
    <form id="form-update-selected" action="" method="POST"><input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
        <div id="form-update-selected-content"></div>
    </form>
    <div class="container-fluid main">
        <div class="dataManagement">
            <div class="headTabs clearfix">
                <h4 class="float-left">
                    <span class="title_icon"> {!! @$config['title_icon'] !!} </span> {{ @$params['title'] }}
                </h4>
                <div class="rightSide">
                    @include('hyperspace::components.datatable_nav')
                </div>
            </div>
            <!-- Tab panes -->
            <div class="tab-content">
                @include('hyperspace::components.datatable_content')
            </div>
        </div>
    </div>
    @include('hyperspace::components.datatable_button')
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
