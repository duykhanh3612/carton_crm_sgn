<div class="colors" style="display: none;">
    <a class="default" href="javascript:void(0)"></a>
    <a class="blue" href="javascript:void(0)"></a>
    <a class="green" href="javascript:void(0)"></a>
    <a class="red" href="javascript:void(0)"></a>
    <a class="white" href="javascript:void(0)"></a>
    <a class="black" href="javascript:void(0)"></a>
</div>
<div id="jquery-accordion-menu" class="jquery-accordion-menu black">
    <ul>
        <li class="active"><a href="{{ route("admin.index") }}"><i class="fa fa-tachometer-alt"></i>Tổng quan </a></li>

        @if(Arr::get($per,"1.read"))
        <li class="active"><a href="{{ route("admin.order") }}"><i class="fa fa-shopping-cart"></i>Đơn hàng </a></li>
        @endif
        @if(Arr::get($per,"2.read"))
        <li class="active"><a href="{{ route("admin.product") }}"><i class="fa fa-barcode"></i>Hàng hóa</a></li>
        @endif
        @if(Arr::get($per,"3.read"))
        <li class="active"><a href="{{ route("admin.customer") }}"><i class="fa fa-users"></i>Khách hàng</a></li>
        @endif

        {{-- <li class="active"><a href="{{ route("admin.purchase") }}"><i class="fa fa-shipping-fast"></i>Nhập kho </a></li>
        <li class="active"><a href="{{ route("admin.stock") }}"><i class="fa fa-warehouse"></i>Tồn kho</a></li> --}}
        @if(Arr::get($per,"4.read"))
        <li class="active"><a href="{{ route("admin.revenue") }}"><i class="fa fa-signal"></i>Doanh số </a></li>
        @endif
        @if(Arr::get($per,"5.read"))
        <li class="active"><a href="{{ route("admin.payment") }}"><i class="fa fa-file-alt"></i>Thu chi</a></li>
        @endif
        @if(Arr::get($per,"6.read"))
        <li class="active"><a href="{{ route("admin.shipment") }}"><i class="fa fa-truck"></i>Phí vận chuyển</a></li>
        @endif
        {{-- <li class="active"><a href="{{ route("admin.profit") }}"><i class="fa fa-dollar-sign"></i>Lợi nhuận</a></li> --}}
        @if(Arr::get($per,"6.read"))
        <li><a href="{{ route('admin.core',['news']) }}"> <i class="fa fa-newspaper"></i> Tin tức </a></li>
        <li><a href="{{ route('admin.core',['pages']) }}"> <i class="fa fa-newspaper"></i> Pages </a></li>
        @endif
        <li><a href="{{ route('admin.store') }}"> <i class="fa fa-cog"></i> Thiết lập</a></li>
        {{--@if(Auth::user()->user_group_id == "1")
        <li>
            <a href="#"><i class="fa fa-cog"></i>Thiết lập</a>
            <ul class="submenu">
                <li><a href="{{ route('admin.page',['group']) }}"><i class="fa fa-users"></i>Nhóm người dùng </a></li>
                <li><a href="{{ route('admin.page',['user']) }}"> <i class="fa fa-user"></i> Người dùng </a></li>
                <li><a href="{{ route('admin.page',['store']) }}"> <i class="fa fa-store"></i> Thông tin cửa hàng </a></li>
                <li><a href="{{ route('admin.page',['store_setting']) }}"> <i class="fa fa-store"></i> Thiếu lập cửa hàng</a></li>
            </ul>
        </li>
        <li>
            <a href="{{ route('admin.settings') }}"><i class="fa fa-cog"></i>Thiết lập</a>
        </li>
        @endif --}}
        {{-- <li>
            <a href="{{ route('admin.logout') }}"><i class="fa fa-external-link"></i> Đăng xuất </a>
        </li> --}}
    </ul>
</div>
