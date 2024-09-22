@php
    if(empty($buttons)) $buttons = array();
    if(empty($hiddenButtons)) $hiddenButtons = array();
@endphp
@if($buttons)
    <footer class="tool">
        <div class="container-fluid">
            {{-- @if($records)
                <div class="col-xs-12 col-lg-4 col-md-4 col-sm-12 filters text-right float-right jsAutoLoad" style="display: none">
                    @include('hyperspace::components.paginate', ['records'=> $records])
                </div>
            @endif --}}
            <div class="col-xs-12 col-lg-8 col-md-8 col-sm-12 float-left">
                @isset($config['option']['footer_buttons'])
                <div class="row">
                    <ul class="invoiceController clearfix">
                        @foreach($buttons as $i => $button)
                            @php
                                $buttonData = @$button['data'];
                                $lgcol = strlen($button['label']) > 22 ? 'col-lg-3' : 'col-lg-2';
                            @endphp
                            <li class="col-xs-4 col-sm-4 col-md-34 {{$lgcol}}">
                                <div class="row"><a href="{{ @$button['href'] }}" id="{{ @$button['id'] }}" class="btnBody {{ @$button['class'] }}"
                                @if($buttonData && is_array($buttonData))
                                    @foreach($buttonData as $key => $val)
                                        data-{{ $key }}="{{ $val }}"
                                    @endforeach
                                @endif
                                 title="{{ @$button['title'] }}"><i class="fa {{ @$button['icon'] }}"></i><span>{{ $button['label'] }}</span></a></div>
                            </li>
                        @endforeach
                        @if($hiddenButtons)
                            <li class="col-xs-2 col-sm-2 col-md-2 col-lg-1">
                                <div class="row"><a href="javascript:;" onclick="$('#button-hide').toggle('slow'); $(this).find('.plus, .minus').toggle()" class="btnBody btnGreen" title="more"><div class="plus"><i class="fa fa-plus"></i><span>MORE</span></div><div class="minus" style="display:none"><i class="fa fa-minus"></i><span>HIDE</span></div></a></div>
                            </li>
                        @endif
                    </ul>
                </div>
                @endisset

                @isset($config['option']['footer_paginate'])
                <div class="paging">
                    {!! $records->links() !!}
                </div>
                @endisset
                @if($hiddenButtons)
                    {{-- <div id="button-hide" style="display: none">
                        <div class="row">
                            <ul class="invoiceController clearfix">
                                @foreach($hiddenButtons as $i => $button)
                                    @php
                                        $buttonData = @$button['data'];
                                        if(strlen($button['label']) > 35) {
                                            $lgcol = 'col-lg-4';
                                        }
                                        else {
                                            $lgcol = strlen($button['label']) > 21 ? 'col-lg-3' : 'col-lg-2';
                                        }
                                    @endphp
                                    @if(strpos(@$button['class'] , 'connect-selected'))
                                    <li class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                    @else
                                    <li class="col-xs-4 col-sm-4 col-md-4 {{$lgcol}}">
                                    @endif
                                        <div class="row"><a href="{{ @$button['href'] }}"  id="{{ @$button['id'] }}" class="btnBody {{ @$button['class'] }}"
                                        @if($buttonData && is_array($buttonData))
                                            @foreach($buttonData as $key => $val)
                                                data-{{ $key }}="{{ $val }}"
                                            @endforeach
                                        @endif
                                         title="{{ @$button['title'] }}"><i class="fa {{ @$button['icon'] }}"></i><span>{{ $button['label'] }}</span></a></div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div> --}}
                @endif
            </div>
        </div>
    </footer>
@endif
