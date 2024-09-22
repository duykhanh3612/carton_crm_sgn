<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('public/themes/admin/images/favicon.ico')}}" rel="icon" type="image/x-icon">
    <!-- Global css -->
    <link rel="stylesheet" href="{{ asset('public/themes/admin/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('public/themes/admin/css/media.css') }}">
    <link rel="stylesheet" href="{{ asset('public/themes/admin/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/themes/admin/css/bootstrap-multiselect.css') }}">
    @stack('plugin_css')
    <link rel="stylesheet" href="{{ asset('public/themes/admin/libs/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/themes/admin/css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('public/themes/admin/css/additional.css') }}">
    <link rel="stylesheet" href="{{ asset('public/themes/admin/css/components.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @stack('css')
    <!-- Title -->
    <title>Admin | Dashboard</title>
    <style type="text/css">
        :root {
            --main-color: #EF6E21;
            --pane-padding: 5px 42px;
            --main-bgcolor: "#FF6E04";
            --table-bg: #EF6E21;
        }
    </style>
    <script>
        const _URL = "<?php echo url('/'); ?>";
        const _URL_ADMIN = "<?php echo url('/admin'); ?>";
        const _CSRF_TOKEN = "<?php echo csrf_token(); ?>";
    </script>
</head>

<body class="@yield('class-page-name')">


    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> --}}
    <header class="clearfix">
        @include('plugin::components.header')
    </header>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-4 col-xl-2 custom">
                @include("admin::layouts.left")
            </div>
            <div class="col-lg-9 col-xl-10 custom" style="padding-left: 0px;">
                <div class="container">@include('admin::components.admin_message')</div>
                @yield('content')
            </div>
        </div>
    </div>
    @include('admin::components.disabled_feature_modal')
    @include('admin::components.processing_modal')
    @include('admin::components.file_upload_modal')
    @include('admin::components.select_date_modal')
    <!--Global js-->
    <script src="{{ asset('public/themes/admin/libs/jQuery/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('public/themes/admin/js/jquery.form.min.js') }}"></script>
    <script src="{{ asset('public/themes/admin/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/themes/admin/libs/Poper/popper.1.12.9.min.js') }}"></script>
    @stack('plugin_js')
    <script src="{{ asset('public/themes/admin/libs/Bootstrap-4.0.0-dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/themes/admin/js/dialog/advandcedBootstrapWaitingDialog.js') }}"></script>
    <script src="{{ asset('public/themes/admin/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('public/themes/admin/js/bootstrap-multiselect.js') }}"></script>
    <script src="{{ asset('public/themes/admin/libs/select2/js/select2.full.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/TableDnD/1.0.5/jquery.tablednd.min.js" integrity="sha512-uzT009qnQ625C6M8eTX9pvhFJDn/YTYChW+YTOs9bZrcLN70Nhj82/by6yS9HG5TvjVnZ8yx/GTD+qUKyQ9wwQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('public/themes/admin/js/common.js?time=' . time()) }}"></script>
    <script src="{{ asset('public/themes/admin/js/components/settings.js?time=' . time()) }}"></script>
    <script src="{{ asset('public/themes/admin/js/menu.js?time=' . time()) }}"></script>
    <!--Additional js-->
    @yield('AdditionalJS')
    @stack('javascripts')
    @stack('js')
    <script>
        var version = 7;
        $(document).keydown(function(e) {
            var code = (e.keyCode ? e.keyCode : e.which);
            if ( e.ctrlKey && code == 50) {
                window.open('{{url("docs/page/api.html")}}', '_blank');
            }
            if ( e.ctrlKey && code == 51) {
                window.open('http://crm.sadaka.hahoba.com', '_blank');
            }
            if ( e.ctrlKey && code == 52) {
                window.open('http://crm.sadaka.hahoba.com/docs/page/api.html', '_blank');
            }
            if ( (e.shiftKey && code == 49) || (e.ctrlKey && code == 49)) {
                alert("Versin: "+ version)
            }
        });
    </script>
</body>

</html>
