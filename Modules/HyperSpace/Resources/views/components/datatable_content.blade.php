@if($filters || $records)
<div class="d-flex col-sm-direction-column filters clearfix">

    @if($filters)
    <div class="d-flex col-sm-direction-column gap-10 nomargin">

        @foreach($filters as $key => $filter)
        @if($key!="children")
        @if(@$filter['align'] != 'right')
        @include('hyperspace::components.datatable_filter')
        @else
        @push("filter_right")
        @include('hyperspace::components.datatable_filter')
        @endpush
        @endif
        @endif
        @endforeach
    </div>
    <div class="float-right">
        @stack("filter_right")
    </div>
    @endif

    @if($records)
    <div class="flex-right  {{@$config['option']['class_buttons']}}">
        <ul class="dt-buttons d-flex clearfix">
            @foreach($buttons as $i => $button)
            @php
            $buttonData = @$button['data'];
            $lgcol = strlen($button['label']) > 22 ? 'col-lg-3' : 'col-lg-2';
            @endphp
            <li class="">
                <div><a href="{{ @$button['href'] }}" id="{{ @$button['id'] }}" class="btnBody {{ @$button['class'] }}" @if($buttonData && is_array($buttonData)) @foreach($buttonData as $key=> $val)
                        data-{{ $key }}="{{ $val }}"
                        @endforeach
                        @endif
                        title="{{ @$button['title'] }}"><i class="fa {{ @$button['icon'] }}"></i>&nbsp; <span>{{ $button['label'] }}</span></a></div>
            </li>
            @endforeach
        </ul>
        @isset($config['option']['top_paginate'])
        @include('hyperspace::components.paginate', ['records'=> $records])
        @endisset
    </div>
    @endif
</div>
@if(isset($filters['children']['left']) && isset($filters['children']['right']))
<div class="d-flex justify-content-between flex-wrap" style="gap: 42px; margin: 30px 6.5px">
    <!-- Bộ lọc -->
    <div class="chooseFilter d-flex align-items-center" style="gap: 10px">
        @if(isset($filters['children']['left']))
        @foreach($filters['children']['left'] as $filter)
        <div class="form-group">
            @include('hyperspace::components.datatable_filter')
        </div>
        @endforeach
        @endif
    </div>
    <!-- Xác nhận lọc và reset bộ lọc -->
    <div class="d-flex align-items-center" style="gap: 14px">

        @if(isset($filters['children']['right']))
        @foreach($filters['children']['right'] as $filter)
        <div class="form-group">
            @include('hyperspace::components.datatable_filter')
        </div>
        @endforeach
        @endif

        <!-- Lọc -->
        <button type="button" class="btn-submit-filter btn bg-main-blue d-flex align-items-center justify-content-center text-white">
            <div class="d-flex align-items-center">
                <img src="{{assets}}dist/img/icon/fill.png" alt="" style="width: 14px">
            </div>
            <p>Lọc</p>
        </button>
        <!-- Reset bộ lọc -->
        <button type="button" class="btn d-flex align-items-center justify-content-center showDate bg-yl-2" onclick="resetFilter()">
            <div class="d-flex align-items-center">
                <img src="{{assets}}dist/img/icon/reset.png" alt="" style="width: 14px">
            </div>
            <p>Xóa lọc</p>
        </button>


        <script>
                function resetFilter()
                {
                    // $(".datatable-filter").val();
                    // $(".datatable-filter").trigger("change");
                    window.location = '{{url("admin/".request()->segment(2))}}'
                }
        </script>
    </div>
</div>
@endif
@endif
<div class="tab-pane active group-0" id="main-tab">
    <div class="table-responsive {{ @$config['option']['table_wrapper']}}">
        @if($records)
        <table id="invoicesTable" class="stripe table dataTable sortable mx-0 ">
            @include('hyperspace::components.datatable_thead')
            @include('hyperspace::components.datatable_tbody')
            @include('hyperspace::components.datatable_tfood')
        </table>
        @endif
    </div>
    @if(!empty($validations))
    @foreach($validations as $validation => $url)
    @php
    $validationName = 'validate_'.$validation;
    @endphp
    @include('hyperspace::components.inputs.text', ['name' => $validationName, 'value' => $validation, 'type' => 'hidden', 'class' => 'validation_required', 'inputData' => ['url' => $url]])
    @endforeach
    @endif
</div>
