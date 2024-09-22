@php
    if(!empty($_guard)) {
        $navItems = config('navigation.' . $_guard );
        $homeRoute = route($_guard . '.home');
    } else {
        $navItems = array();
        $homeRoute = route("admin.index");
    }
    $customLogo = Auth::check() && Auth::user()->logo;
    $logoId = $customLogo ? '' : 'logo'
@endphp

<nav class="navbar navbar-expand-lg nav-black">
    <div id="{{ $logoId }}" class="text-center float-left ">
        <a href="{{ $homeRoute }}" style="background: #fff">
            <img src="{{asset('public/themes/admin/images/logo.svg')}}" class="custom_logo">
        </a>
    </div>
    @if(Auth::check())
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                @if (!empty($navItems['main']))
                    @foreach($navItems['main'] as $key => $item)
                        @if(!empty($item['sub_nav']))
                            <li class="nav-item dropdown @if(!empty($item['route']) &&  Request::route()->getName() == $item['route']) active @endif">
                                <a class="dropdown-toggle nav-link" role="button" id="{{ $key }}" data-toggle="dropdown"
                                   aria-haspopup="true" aria-expanded="false">
                                    {{ $item['title'] }}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="{{ $key }}">
                                    @foreach($item['sub_nav'] as $subKey => $subItem)
                                        <li>
                                            <a class="dropdown-item"
                                               @if(!empty($subItem['disabled'])) href="javascript:;" data-toggle="modal" data-target="#generalNotActive" @else href="{{ route($subItem['route']) }}" @endif>{{ $subItem['title'] }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            @php
                                $specialKey = 'franchise';
                            @endphp
                            @if($key != $specialKey || ($key == $specialKey && !empty(Auth::user()->is_corporate) && !empty(Auth::user()->group_id)))
                            <li class="nav-item @if(!empty($item['route']) && Request::route()->getName() == $item['route']) active @endif">
                                <a class="nav-link" @if(!empty($item['disabled'])) href="javascript:;" data-toggle="modal" data-target="#generalNotActive" @else href="{{ route($item['route']) }}" @endif >{{ $item['title'] }}</a>
                            </li>
                            @endif
                        @endif
                    @endforeach
                @endif
                @include('admin::components.addons')
            </ul>
        </div>
        <div class="dropdown user-action">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                <span>{{ Auth::user()->name }}</span>
                <i class="fas fa-user icon-user"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                <button class="dropdown-item" type="button"><a  href="{{ route('admin.logout') }}"><i class="fa fa-off"></i> Đăng xuất </a></button>
                @if (!empty($navItems['setting']))
                    @foreach($navItems['setting'] as $key => $item)
                        <button class="dropdown-item" type="button"><a
                                href="{{ route($item['route']) }}">{{ $item['title'] }}</a></button>
                    @endforeach
                @endif
            </div>
        </div>
    @endif
</nav>
