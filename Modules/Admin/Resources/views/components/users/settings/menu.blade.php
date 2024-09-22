@php
    $navItems = config('setting_menu');
    $addons = auth()->user()->addons;
    foreach ($navItems as $route => $nav) {
        if(!Route::has($route)) {
            unset($navItems[$route]);
            continue;
        }
        $navItems[$route]['href'] = route($route);
        $navItems[$route]['current'] = Request::route()->getName() == $route;
        if(!empty($nav['addons'])) {
            if(is_array($nav['addons'])) {
                $isAsigned = !empty(array_intersect($nav['addons'] , $addons));
            }
            else {
                $isAsigned = in_array($nav['addons'] , $addons);
            }
            if(!$isAsigned) {
                unset($navItems[$route]);
            }
        }
    }
    $settingMenus = $navItems;
    $navItems = array_chunk($navItems, 4, true);
    $i = 0;
@endphp
<div class="setting-menu-carousel">
    <div class="setting-menu carousel slide" id="setting-menu">
        <ul class="carousel-inner">
            @if (!empty($navItems))
                @foreach($navItems as $navItem)
                    <li class="carousel-item @if(!$i) active @endif" style="width:100%">
                        <ul data-target="#setting-menu" data-slide-to="0">
                            @foreach($navItem as $route => $nav)
                                @if(Route::has($route))
                                    <li class="@if(Request::route()->getName() == $route) current @endif"><a
                                                @if(!empty($nav['disabled'])) href="javascript:;" data-toggle="modal"
                                                data-target="#generalNotActive" @else href="{{ route($route) }}"
                                                @endif title="{{ $nav['title'] }}">{{ $nav['label'] }}</a>
                                        <div class="setting-menu-description">{{ $nav['comment'] }}</div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                    @php $i++ @endphp
                @endforeach
            @endif
        </ul>
    </div>
    <!-- Controls -->
    <a class="left carousel-control carousel-control-prev" href="#setting-menu" role="button" data-slide="prev">
        <i class="fa fa-angle-left"></i><i class="fa fa-angle-left"></i>
    </a>
    <a class="right carousel-control carousel-control-next" href="#setting-menu" role="button" data-slide="next">
        <i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>
    </a>
</div>
@push('javascripts')
    <script>
        var settingMenus = {!! json_encode($settingMenus) !!};
        var currentNumberMenu = 4;
        jQuery(document).ready(function ($) {
            $('#setting-menu').carousel({interval: 0});
            var activeSettingMenu = $('#setting-menu .carousel-item li.current').parents('.carousel-item');
            var activeSettingMenuIndex = $('#setting-menu .carousel-item').index(activeSettingMenu);
            $('#setting-menu').carousel(activeSettingMenuIndex);
            $('#setting-menu').on('click' , 'a' , function (e) {
                var url = $(this).attr('href');
                if (url != 'javascript:;') {
                    waitingDialog.show('Please wait...');
                    window.location.href = $(this).attr('href');
                }
            });
            buildSettingMenu();
            window.addEventListener("resize", buildSettingMenu);
        });
    </script>
@endpush
