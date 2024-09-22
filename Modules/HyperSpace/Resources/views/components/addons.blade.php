@if(Auth::check())
    @php $addons = Auth::user()->addons @endphp
    @if($addons)
        @foreach($addons as $addonId)
            @php
                $addon = Config::get('addons')[$addonId];
                $prefix = config('constants.guard.add_on.' . $addonId);
            @endphp
            @if(!empty($addon) && empty($addon['hideMenu']))
            <li class="nav-item @if(!empty($addon['route']) && Request::route() &&  strpos(Request::route()->getName(),$prefix) !== false ) active @endif">
                <a class="nav-link" @if(!empty($addon['disabled'])) href="javascript:;" data-toggle="modal" data-target="#generalNotActive" @else href="{{ route($addon['route']) }}" @endif >{{ $addon['label'] }}</a>
            </li>
            @endif
        @endforeach
    @endif
@endif
