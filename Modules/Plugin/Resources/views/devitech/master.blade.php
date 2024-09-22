<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>{{!empty($module)?$module->name_vn:"Thống kê"}}</title>
        <!-- Google Font: Source Sans Pro -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&amp;display=swap" />
        <!-- Font Awesome -->
        {{-- <link rel="stylesheet" href="{{ assets }}plugins/fontawesome-free/css/all.min.css" /> --}}
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />
        <!-- Tempusdominus Bootstrap 4 -->
        <link rel="stylesheet" href="{{ assets }}plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css" />
        <!-- iCheck -->
        <link rel="stylesheet" href="{{ assets }}plugins/icheck-bootstrap/icheck-bootstrap.min.css" />
        <!-- JQVMap -->
        <link rel="stylesheet" href="{{ assets }}plugins/jqvmap/jqvmap.min.css" />
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ assets }}dist/css/adminlte.min.css" />
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="{{ assets }}plugins/overlayScrollbars/css/OverlayScrollbars.min.css" />
        <!-- Daterange picker -->
        <link rel="stylesheet" href="{{ assets }}plugins/daterangepicker/daterangepicker.css" />
        <!-- summernote -->
        <link rel="stylesheet" href="{{ assets }}plugins/summernote/summernote-bs4.min.css" />
        <!-- global css -->
        <link rel="stylesheet" href="{{ assets }}css/global.css" />

         <!-- jQuery -->
         <script src="{{ assets }}plugins/jquery/jquery.min.js"></script>
         <!-- jQuery UI 1.11.4 -->
         <script src="{{ assets }}plugins/jquery-ui/jquery-ui.min.js"></script>
        @include('plugin::devitech.meta')
    </head>

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <!-- Preloader -->
            <div class="preloader flex-column justify-content-center align-items-center">
                <img class="animation__shake" src="{{Themes::asset(user_setting("preloadingLogo"))}}" alt="Devitech Logo" height="60" />
            </div>
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light bg-white">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                            <img src="{{ assets }}dist/img/icon/menu-.png" alt="icon" style="width: 24px;" />
                        </a>
                    </li>
                </ul>
                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <!-- Ngôn ngữ -->
                    <li class="nav-item">
                        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                            <div class="d-flex align-items-center justify-content-center">
                                <img src="{{ assets }}dist/img/icon/language-VN.png" alt="icon" class="iconDashboard" style="width: 24px;" />
                            </div>
                        </a>
                    </li>
                    <!-- Notifications Dropdown Menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <span class="d-flex align-items-center justify-content-center">
                                <img src="{{ assets }}dist/img/icon/notifications_active.png" alt="icon" class="iconDashboard" style="width: 24px;" />
                            </span>
                            <span class="badge badge-warning navbar-badge">15</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-item dropdown-header">15 Thông báo</span>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item"> <i class="fas fa-envelope mr-2"></i> 4 tin nhắn <span class="float-right text-muted text-sm">3 phút</span> </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item"> <i class="fas fa-users mr-2"></i> 8 yêu cầu kết bạn <span class="float-right text-muted text-sm">12 tiếng</span> </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item"> <i class="fas fa-file mr-2"></i> 3 báo cáo mới <span class="float-right text-muted text-sm">2 ngày</span> </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item dropdown-footer">Xem Tất Cả Thông Báo</a>
                        </div>
                    </li>
                    <!-- Avatar -->
                    <li class="nav-item" style="margin-left: 20px; margin-right: 10px;">
                        <div class="h-100 dropdown">
                            <!-- avatar -->
                            <button
                                class="d-flex align-items-center justify-content-center h-100"
                                style="gap: 12px; padding: 8px 12px; border-radius: 4px; background: #ffc619; border: none;"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                                id="userMenuButton"
                            >
                                <img src="{{ assets }}dist/img/avatar.png" alt="icon" class="iconDashboard" style="width: 24px;" />
                                <div style="cursor: pointer;">
                                    <img src="{{ assets }}dist/img/icon/setting2.png" / alt="icon" style="width: 24px;">
                                </div>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="userMenuButton">
                                <a class="dropdown-item" href="pages/account/account.html">Trang cá nhân</a>
                                <a class="dropdown-item" href="{{route("admin.logout")}}">Đăng xuất</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </nav>
            <!-- /.navbar -->
            <!-- Main Sidebar Container -->
            <aside class="main-sidebar elevation-4 bg-white">
                <!-- Brand Logo -->
                <a href="{{route("admin.index")}}" class="brand-link">
                    <img src="{{Themes::asset(user_setting("logo"))}}" alt="Devitech Logo" class="brand-image" style="opacity: 0.8;" />
                    <span class="d-inline-block brand-text">
                        <img src="{{Themes::asset(user_setting("logo_text"))}}" />
                    </span>
                </a>
                <!-- Sidebar -->
                <div class="sidebar">

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                            @foreach (Modules::where("menu",1)->where('cat',0)->orderBy("sort_order")->get() as $module)
                                <li class="nav-item menu-open">
                                    <a href="{{url("admin/".$module->file)}}" class="nav-link {{request()->segment(2)==$module->file?'active':''}}">
                                        <!-- <i class="nav-icon fas fa-tachometer-alt"></i> -->
                                        @if(strpos($module->image,"fa-")===false)
                                        <img src="{{ assets }}dist/img/icon/{{$module->image}}.png" alt="icon" class="iconDashboard" style="width: 20px; margin-right: 8px;" />
                                        @else
                                        <i class="fa {{$module->image}}" style="    font-size: 20px;color:#2c2a2a;"></i> &nbsp;&nbsp;
                                        @endif
                                        <p>{{$module->name_vn}}</p>
                                    </a>
                                </li>

                            @endforeach

                            @php
                            $ids = Modules::getModuleRight();
                            $cates =  Modules::where("menu",1)->where('cat','<>',0)->whereIn("id", $ids)->orderBy("sort_order")->get()->groupBy("cat");
                            @endphp
                            @foreach($cates as $key=>$nodes)
                            @php $cate = Modules::getCategory($key); @endphp
                            @if(!empty($nodes))
                            <li class="nav-item">
                                <a href="#" class="nav-link">

                                    @if(strpos(@$cate->img,"fa-")===false)
                                    <img src="{{ assets }}dist/img/icon/{{$cate->img}}.png" alt="icon" class="iconDashboard" style="width: 20px; margin-right: 8px;">
                                    @else
                                    <i class="fa {{$cate->img}}" style="    font-size: 20px;color:#2c2a2a;"></i> &nbsp;&nbsp;
                                    @endif
                                    <p>
                                        {{@$cate->name_vn}}
                                        <i class="fas fa-angle-right right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="    margin-left: 15px;">
                                    @foreach ($nodes as $module)
                                    @if(Users::check_right($module->id))
                                    <li class="nav-item">
                                        <a href="{{url("admin/".$module->file)}}" class="nav-link">
                                            <span class="d-inline-block text-center" style="width: 17px;">
                                                @if(strpos($module->image,"fa-")===false)
                                                <img src="{{ assets }}dist/img/icon/{{$module->image}}.png" alt="icon" class="iconDashboard" style="width: 20px; margin-right: 8px;" />
                                                @else
                                                <i class="fa {{$module->image}}" style="    font-size: 20px;color:#2c2a2a;"></i> &nbsp;&nbsp;
                                                @endif
                                            </span>
                                            <p>&nbsp;&nbsp; &nbsp;&nbsp; {{$module->name_vn}}</p>
                                        </a>
                                    </li>
                                    @endif
                                   @endforeach
                                </ul>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>
            <!-- Content Wrapper. Contains page content -->

            @yield('content')

            <!-- /.content-wrapper -->
            <footer class="main-footer" style="background: #e9e9e9; color: #000; padding: 0 48px; height: 35px; display: flex; align-items: center; justify-content: space-between;">
                <span>
                    {!! user_setting('footer_text') !!}
                </span>
                <div class="d-none d-sm-flex align-items-center">
                    <a href="#" style="margin-right: 18px;" class="d-inline-flex align-items-center">
                        <img src="{{ assets }}dist/img/footer/zalo.png" style="width: 16px;" />
                    </a>
                    <b> Phiên bản</b>{!! user_setting('version') !!}
                </div>
            </footer>
            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->
        <!-- jQuery -->
        {{-- <script src="{{ assets }}plugins/jquery/jquery.min.js"></script> --}}
        <!-- jQuery UI 1.11.4 -->
        {{-- <script src="{{ assets }}plugins/jquery-ui/jquery-ui.min.js"></script> --}}
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge("uibutton", $.ui.button);
        </script>
        <!-- Bootstrap 4 -->
        <script src="{{ assets }}plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- ChartJS -->
        <script src="{{ assets }}plugins/chart.js/Chart.min.js"></script>
        <!-- Sparkline -->
        <script src="{{ assets }}plugins/sparklines/sparkline.js"></script>
        <!-- JQVMap -->
        {{-- <script src="{{ assets }}plugins/jqvmap/jquery.vmap.min.js"></script>
        <script src="{{ assets }}plugins/jqvmap/maps/jquery.vmap.usa.js"></script> --}}
        <!-- jQuery Knob Chart -->
        <script src="{{ assets }}plugins/jquery-knob/jquery.knob.min.js"></script>
        <!-- daterangepicker -->
        <script src="{{ assets }}plugins/moment/moment.min.js"></script>
        <script src="{{ assets }}plugins/daterangepicker/daterangepicker.js"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        <script src="{{ assets }}plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
        <!-- Summernote -->
        <script src="{{ assets }}plugins/summernote/summernote-bs4.min.js"></script>
        <!-- overlayScrollbars -->
        <script src="{{ assets }}plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <!-- AdminLTE App -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js" integrity="sha512-3j3VU6WC5rPQB4Ld1jnLV7Kd5xr+cq9avvhwqzbH/taCRNURoeEpoPBK9pDyeukwSxwRPJ8fDgvYXd6SkaZ2TA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="{{ assets }}dist/js/adminlte.js"></script>
        <!-- AdminLTE for demo purposes -->
        {{-- <script src="{{ assets }}dist/js/demo.js"></script> --}}
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        {!! Themes::container("plugin")->add(['select2']) !!}
        {!! Themes::plugin() !!}
        @stack('js')
        {{-- <script src="{{ assets }}dist/js/pages/dashboard.js"></script> --}}

        <script>
            //Date range as a button
            $("#daterange-btn").daterangepicker(
                {
                    alwaysShowCalendars: true,
                    showDropdowns: true,
                    ranges: {
                        "Hôm nay": [moment(), moment()],
                        "Hôm qua": [moment().subtract(1, "days"), moment().subtract(1, "days")],
                        "7 ngày trước": [moment().subtract(6, "days"), moment()],
                        "30 ngày trước": [moment().subtract(29, "days"), moment()],
                        "Tháng này": [moment().startOf("month"), moment().endOf("month")],
                        "Tháng trước": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")],
                    },
                },
                function (start, end) {
                    $("#startDate").html(start.format("DD/MM/YYYY"));
                    $("#endDate").html(end.format("DD/MM/YYYY"));
                }
            );
            $(document).on('click', '[data-widget="pushmenu"]', function () {
                if($("body").hasClass("sidebar-collapse"))
                {
                    $.cookie("sidebar-collapse","open")
                }
                else{
                    $.cookie("sidebar-collapse","close")
                }

            });
            if($.cookie("sidebar-collapse") == "open")
            {
                $("body").addClass("sidebar-collapse");
            }
        </script>
        <!--Additional js-->
        @yield('AdditionalJS') @stack('javascripts')


        <script src="{{ asset('public/plugin/dialog/advandcedBootstrapWaitingDialog.js') }}"></script>
        <script src="{{ asset('public/plugin/jquery/loadingoverlay/loadingoverlay.min.js') }}"></script>
        <script src="{{ asset('public/themes/admin/js/common.js?time=' . time()) }}"></script>

        {{-- <link rel="stylesheet" href="{{ asset('public/plugin/jquery/jquery-confirm/v3.3.4/dist/jquery-confirm.min.css') }}" />
        <script src="{{ asset('public/plugin/jquery/jquery-confirm/v3.3.4/dist/jquery-confirm.min.js') }}"></script> --}}

        <link rel="stylesheet" href="{{ asset('public/plugin/dialog/alerts/style.css') }}" />
        <script src="{{ asset('public/plugin/dialog/alerts/jquery.alerts.js') }}"></script>

        <link rel="stylesheet" href="{{ asset('public/themes')}}/assets/css/style.css" />
        <script src="{{ asset('public/themes')}}/assets/js/script.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js" integrity="sha512-zlWWyZq71UMApAjih4WkaRpikgY9Bz1oXIW5G0fED4vk14JjGlQ1UmkGM392jEULP8jbNMiwLWdM8Z87Hu88Fw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.css" integrity="sha512-8D+M+7Y6jVsEa7RD6Kv/Z7EImSpNpQllgaEIQAtqHcI0H6F4iZknRj0Nx1DCdB+TwBaS+702BGWYC0Ze2hpExQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </body>
</html>
