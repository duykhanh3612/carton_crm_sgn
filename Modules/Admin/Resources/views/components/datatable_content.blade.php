@if($filters || $records)
    <div class="filters clearfix">
        <div class="d-flex">
            @if(!empty(@$config['actions']))
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
            @if($filters)
                <div class="flex-grow-1">
                    @foreach($filters as $filter)
                        @include('admin::components.datatable_filter')
                    @endforeach
                </div>
            @endif

            @if($records)
                <div class="filters text-right float-right jsAutoLoad flex flex-column">
                    <ul class="d-flex justify-content-end gap-2">
                    @foreach($buttons as $i => $button)
                        @php
                            $buttonData = @$button['data'];
                            $lgcol = strlen($button['label']) > 22 ? 'col-lg-3' : 'col-lg-2';
                        @endphp
                        <li class="dt-buttons">
                            <a href="{{ @$button['href'] }}" id="{{ @$button['id'] }}" class="btnBody {{ @$button['class'] }}"
                            @if($buttonData && is_array($buttonData))
                                @foreach($buttonData as $key => $val)
                                    data-{{ $key }}="{{ $val }}"
                                @endforeach
                            @endif
                                title="{{ @$button['title'] }}"><i class="fa {{ @$button['icon'] }}"></i>&nbsp; <span>{{ $button['label'] }}</span></a>
                        </li>
                    @endforeach
                    </ul>
                @isset($config['option']['top_paginate'])
                    @include('admin::components.paginate', ['records'=> $records])
                @endisset
                </div>
            @endif
        </div>
    </div>
@endif
<div class="tab-pane active group-0" id="main-tab">
    <div class="table-responsive {{ @$config['option']['table_wrapper']}}">
        @if($records)
            <table id="invoicesTable" class="stripe table dataTable sortable mx-0">
                @include('admin::components.datatable_thead')
                @include('admin::components.datatable_tbody')
                @include('admin::components.datatable_tfood')
            </table>
        @endif
    </div>
    @if(!empty($validations))
        @foreach($validations as $validation => $url)
            @php
                $validationName = 'validate_'.$validation;
            @endphp
            @include('admin::components.inputs.text', ['name' => $validationName, 'value' => $validation, 'type' => 'hidden', 'class' => 'validation_required', 'inputData' => ['url' => $url]])
        @endforeach
    @endif
</div>
