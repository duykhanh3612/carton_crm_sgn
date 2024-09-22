<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('public/themes/admin/images/favicon.ico')}}" rel="icon" type="image/x-icon">
    <!-- Global css -->
    <link rel="stylesheet" href="{{ asset_mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('public/themes/admin/css/media.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('public/themes/admin/css/bootstrap-datepicker3.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('public/themes/admin/css/bootstrap-multiselect.css') }}">
    @stack('plugin_css')

    <link rel="stylesheet" href="{{ asset_mix('css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('public/themes/admin/css/components.css') }}">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"  /> --}}

    <link rel="stylesheet" href="{{ asset('public/plugin/bootstrap/5.3.2/css/bootstrap.min.css') }}"  />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('public/themes/admin/css/additional.css') }}">
    <link rel="stylesheet" href="{{ asset('public/themes/admin/carton/css/additional.css') }}">

    {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js"></script> --}}

    {{-- <script src="{{ asset('public/themes/admin/libs/jQuery/jquery-3.4.1.min.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/amaranjs@0.5.5/dist/js/jquery.amaran.min.js"></script>
    <link rel="stylesheet" href="{{ asset('public/plugin/amaran/style.css') }}">
    @stack('css')
    <!-- Title -->
    <title>{{user_setting("site_title")}}</title>
    <style type="text/css">
        :root {
            --main-color: rgb(88, 88, 88);
            --main-bg-color: rgb(48, 126, 204);
            --table-bg: #f2f2f2;
            --bs-table-border-color: var(--bs-border-color);
            --bs-table-accent-bg: transparent;
            --bs-table-striped-color: var(--bs-body-color);
            --bs-table-striped-bg: rgba(0, 0, 0, 0.05);
            --bs-table-active-color: var(--bs-body-color);
            --bs-table-active-bg: rgba(0, 0, 0, 0.1);
            --bs-table-hover-color: var(--bs-body-color);
            --bs-table-hover-bg: rgba(7, 5, 5, 0.075);
        }
    </style>
    <script>
        const _URL = "<?php echo url('/'); ?>";
        const _URL_ADMIN = "<?php echo url('/admin'); ?>";
        const _CSRF_TOKEN = "<?php echo csrf_token(); ?>";
    </script>
</head>

<body class="@yield('class-page-name')">
    <header class="clearfix">
        @include('admin::components.header')
    </header>
    <div class="content-wrapper">
        <div class="d-flex">
            <div>
                @include("admin::layouts.left")
            </div>
            <div style="flex-grow:1">
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
    <script src="{{ asset('public/themes/assets/js/lib/helper.js?time=' . time()) }}"></script>
    <script src="{{ asset('public/themes/admin/js/jquery.form.min.js') }}"></script>
    <script src="{{ asset('public/themes/admin/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/themes/admin/libs/Poper/popper.1.12.9.min.js') }}"></script>

    @stack('plugin_js')

    <script src="{{ asset('public/themes/admin/js/dialog/advandcedBootstrapWaitingDialog.js') }}"></script>
    {{-- <script src="{{ asset('public/themes/admin/js/bootstrap-datepicker.js') }}"></script> --}}

    <script src="{{ asset('public/themes/admin/js/bootstrap-multiselect.js') }}"></script>
    {{-- <script src="{{ asset('public/plugin/select2/js/select2.full.min.js') }}"></script> --}}
    <script src="{{ asset('public/plugin/jquery/loadingoverlay/loadingoverlay.min.js?time=' . time()) }}"></script>

    <script src="{{ asset('public/themes/admin/js/components/settings.js?time=' . time()) }}"></script>
    <script src="{{ asset('public/themes/admin/js/menu.js?time=' . time()) }}"></script>

    {!! Themes::container("plugin")->add(['bootstrap','bootstrap-datepicker','select2']) !!}
    {!! Themes::plugin() !!}

    <!--Additional js-->
    @yield('AdditionalJS')
    @stack('javascripts')
    @stack('js')
    <script src="{{ asset('public/themes/admin/js/common.js?time=' . time()) }}"></script>
    <script src="{{ asset('public/plugin/jquery/loadingoverlay/loadingoverlay.min.js?time=' . time()) }}"></script>
</body>

</html>
