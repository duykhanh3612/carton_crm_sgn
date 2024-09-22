<div class="container-fluid main">
    @if (!isset($setting['has_tag']))
    @include('admin::element')
    @endif
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-uppercase font-weight-bold">
                        Doanh số
                    </h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-14">

        <div data-ng-controller="revenueController" class="ng-scope">
            <div class="form-check form-check-inline d-flex gap-10" id="breadcrumbs">

                <h4 class="pr-4 text-main-blue-2">Tiền bán hàng</h4>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio"  id="inlineRadio1"  name="viewType" value="5" checked for="date">
                    <label class="form-check-label fw-500" for="inlineRadio1">Theo thời gian</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input"   type="radio"   id="inlineRadio2"  name="viewType" value="1" for="sale">
                    <label class="form-check-label fw-500"  for="inlineRadio2">Theo người bán</label>
                </div>
                {{-- <div class="form-check form-check-inline">
                    <input class="form-check-input"
                           type="radio"
                           id="inlineRadio3"
                           name="viewType" value="2" />
                    <label class="form-check-label fw-500"
                           for="inlineRadio3">Theo cửa hàng</label>
                </div> --}}
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio"  id="inlineRadio4"  name="viewType" value="4" for="produtct">
                    <label class="form-check-label fw-500" for="inlineRadio4">Theo hàng hoá</label>
                </div>
            </div>

                <div class="d-flex justify-content-between" style="gap: 42px; margin-top: 30px;margin-bottom: 30px;">
                    <!-- Xác nhận lọc và reset bộ lọc -->
                    <div>
                        <div class="form-group" id="filter_product_category" style="display: none">
                            <select id="product_category_id" class="form-control text-left">
                                <option value="" selected="">---- Tất cả ----</option>
                                <option value="1">Thùng Carton - Hộp Carton</option>
                                <option value="2">Bong Bóng Khí - Xốp Hơi</option>
                                <option value="3">Bóng Keo - PE</option>
                                <option value="4">Túi Giấy KRAFT</option>
                                <option value="5">Túi Niêm Phong</option>
                                <option value="6">Giấy Photocopy - Tập Học Sinh</option>
                                <option value="7">Giấy gói hàng</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex align-items-center" style="gap: 14px">
                        <!-- Lựa chọn thời gian -->
                        <div class="d-flex justify-content-end" style="gap: 8px">
                            <!-- hiển thị thời gian -->
                            <div class="d-flex align-items-center justify-content-between" style="gap: 16px">

                                <span class="k-widget k-datepicker k-header s1" style="width: 120px;display:inline-block">
                                    <input id="fromDate" placeholder="Từ ngày" class="s1 k-input" style="width: 100%;" type="text" autocomplete="off">
                                </span>
                                <span class="hidden-320">đến</span>
                                <span class="k-widget k-datepicker k-header s1" style="width: 120px;display:inline-block">
                                    <input id="toDate" placeholder="Đến ngày" class="s1 k-input" style="width: 100%;" type="text" autocomplete="off">
                                </span>

                                <div style="display:none">
                                <p class="showDate" id="startDate" name="startDate" for="#fromDate" >
                                    dd/mm/yyyy
                                </p>
                                <p>đến</p>
                                <p class="showDate" id="endDate" name="endDate" for="#toDate">
                                    dd/mm/yyyy
                                </p>
                                </div>
                            </div>
                            <!-- button chọn thời gian -->
                            <!-- Date and time range -->

                            <div class="chooseDate" style="cursor: pointer" id="daterange-btn">
                                <img src="{{assets}}dist/img/icon/calendar.png" style="width: 14px">
                                <p class="mb-0">Thời gian</p>
                            </div>
                        </div>
                        <!-- Lọc -->
                        <button type="button" onclick="view_report()" class="btn bg-main-blue d-flex align-items-center justify-content-center text-white">
                            <div class="d-flex align-items-center">
                                <img src="{{assets}}dist/img/icon/fill.png" alt="" style="width: 14px">
                            </div>
                            <p>Lọc</p>
                        </button>
                        <!-- Xuất Excel -->
                        {{-- <div>
                            <a class="btn btn-success" href="#" onclick="exportExcel()">
                                <div class="d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512" fill="white">
                                        <path
                                            d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM155.7 250.2L192 302.1l36.3-51.9c7.6-10.9 22.6-13.5 33.4-5.9s13.5 22.6 5.9 33.4L221.3 344l46.4 66.2c7.6 10.9 5 25.8-5.9 33.4s-25.8 5-33.4-5.9L192 385.8l-36.3 51.9c-7.6 10.9-22.6 13.5-33.4 5.9s-13.5-22.6-5.9-33.4L162.7 344l-46.4-66.2c-7.6-10.9-5-25.8 5.9-33.4s25.8-5 33.4 5.9z">
                                        </path>
                                    </svg>
                                </div>
                                <p class="fw-500 text-white">Excel</p>
                            </a>
                        </div> --}}
                    </div>
                </div>

            <div class="page-content">
                <div class="form-group">
                    <div class="col-xs-12" style="display: none">
                        <div class="form-group">
                            <div class="search-box">
                                <!-- ngIf: reportTypeModel.type == 4 -->
                                @if(false)
                                <span class="k-widget k-datepicker k-header s1" style="width: 120px;display:inline-block">
                                    <input id="fromDate" placeholder="Từ ngày" class="s1 k-input" style="width: 100%;" type="text" autocomplete="off">
                                </span>
                                <span class="hidden-320">-</span>
                                <span class="k-widget k-datepicker k-header s1" style="width: 120px;display:inline-block">
                                    <input id="toDate" placeholder="Đến ngày" class="s1 k-input" style="width: 100%;" type="text" autocomplete="off">
                                </span>
                                @endif
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary btn-outline hidden-480 ng-binding ng-pristine ng-valid" data-ng-model="dateRange" data-ng-class="{1:'clicked'}[selected]" onclick="onTypeChange(1)">Tuần</button>
                                    <button type="button" class="btn btn-primary btn-outline hidden-480 ng-binding ng-pristine ng-valid" data-ng-model="dateRange" data-ng-class="{2:'clicked'}[selected]" onclick="onTypeChange(2)">Tháng</button>
                                    <button type="button" class="btn btn-primary btn-outline hidden-768 ng-binding ng-pristine ng-valid" data-ng-model="dateRange" data-ng-class="{3:'clicked'}[selected]" onclick="onTypeChange(3)">Quý</button>
                                </div>

                                <button class="btn btn-primary ng-scope" onclick="view_report()">
                                    <i class="icon-search white"></i>
                                    <span class="hidden-480 ng-binding">Xem </span>
                                </button>
                                <button class="btn btn-primary ng-scope viewChart" data-ng-if="!reportTypeModel.isChart &amp;&amp; reportTypeModel.type <= 3">
                                    <i class="icon-signal white"></i>
                                    <span class="hidden-480 ng-binding">Xem biểu đồ</span>
                                </button>
                                <button class="btn btn-success" onclick="exportExcel()">
                                    <i class="icon-download-alt white"></i>
                                    <span class="hidden-480 ng-binding">Xuất excel</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">

                        <div id="reportViewer">
                            <div class="summaryStatic row">
                                <!-- Tiền bán hàng -->
                                <div class="col-md-3 col-sm-6 col-12">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-info ">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512" fill="white">
                                                <path
                                                    d="M160 0c17.7 0 32 14.3 32 32V67.7c1.6 .2 3.1 .4 4.7 .7c.4 .1 .7 .1 1.1 .2l48 8.8c17.4 3.2 28.9 19.9 25.7 37.2s-19.9 28.9-37.2 25.7l-47.5-8.7c-31.3-4.6-58.9-1.5-78.3 6.2s-27.2 18.3-29 28.1c-2 10.7-.5 16.7 1.2 20.4c1.8 3.9 5.5 8.3 12.8 13.2c16.3 10.7 41.3 17.7 73.7 26.3l2.9 .8c28.6 7.6 63.6 16.8 89.6 33.8c14.2 9.3 27.6 21.9 35.9 39.5c8.5 17.9 10.3 37.9 6.4 59.2c-6.9 38-33.1 63.4-65.6 76.7c-13.7 5.6-28.6 9.2-44.4 11V480c0 17.7-14.3 32-32 32s-32-14.3-32-32V445.1c-.4-.1-.9-.1-1.3-.2l-.2 0 0 0c-24.4-3.8-64.5-14.3-91.5-26.3c-16.1-7.2-23.4-26.1-16.2-42.2s26.1-23.4 42.2-16.2c20.9 9.3 55.3 18.5 75.2 21.6c31.9 4.7 58.2 2 76-5.3c16.9-6.9 24.6-16.9 26.8-28.9c1.9-10.6 .4-16.7-1.3-20.4c-1.9-4-5.6-8.4-13-13.3c-16.4-10.7-41.5-17.7-74-26.3l-2.8-.7 0 0C119.4 279.3 84.4 270 58.4 253c-14.2-9.3-27.5-22-35.8-39.6c-8.4-17.9-10.1-37.9-6.1-59.2C23.7 116 52.3 91.2 84.8 78.3c13.3-5.3 27.9-8.9 43.2-11V32c0-17.7 14.3-32 32-32z">
                                                </path>
                                            </svg>
                                        </span>

                                        <div class="info-box-content">
                                            <span class="info-box-number text-lg">{{ number_format($box->total_order) }}</span>
                                            <span class="info-box-text text-gray">Tiền bán hàng</span>
                                        </div>

                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- Số đơn hàng -->
                                <div class="col-md-3 col-sm-6 col-12">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-success "><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512" fill="white">
                                                <path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z">
                                                </path>
                                            </svg>
                                        </span>

                                        <div class="info-box-content">
                                            <span class="info-box-number text-lg">{{ number_format($box->count_order) }}</span>
                                            <span class="info-box-text text-gray">Số đơn hàng</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- Tiền trả hàng -->
                                <div class="col-md-3 col-sm-6 col-12">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-warning"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512" fill="white">
                                                <path
                                                    d="M160 0c17.7 0 32 14.3 32 32V67.7c1.6 .2 3.1 .4 4.7 .7c.4 .1 .7 .1 1.1 .2l48 8.8c17.4 3.2 28.9 19.9 25.7 37.2s-19.9 28.9-37.2 25.7l-47.5-8.7c-31.3-4.6-58.9-1.5-78.3 6.2s-27.2 18.3-29 28.1c-2 10.7-.5 16.7 1.2 20.4c1.8 3.9 5.5 8.3 12.8 13.2c16.3 10.7 41.3 17.7 73.7 26.3l2.9 .8c28.6 7.6 63.6 16.8 89.6 33.8c14.2 9.3 27.6 21.9 35.9 39.5c8.5 17.9 10.3 37.9 6.4 59.2c-6.9 38-33.1 63.4-65.6 76.7c-13.7 5.6-28.6 9.2-44.4 11V480c0 17.7-14.3 32-32 32s-32-14.3-32-32V445.1c-.4-.1-.9-.1-1.3-.2l-.2 0 0 0c-24.4-3.8-64.5-14.3-91.5-26.3c-16.1-7.2-23.4-26.1-16.2-42.2s26.1-23.4 42.2-16.2c20.9 9.3 55.3 18.5 75.2 21.6c31.9 4.7 58.2 2 76-5.3c16.9-6.9 24.6-16.9 26.8-28.9c1.9-10.6 .4-16.7-1.3-20.4c-1.9-4-5.6-8.4-13-13.3c-16.4-10.7-41.5-17.7-74-26.3l-2.8-.7 0 0C119.4 279.3 84.4 270 58.4 253c-14.2-9.3-27.5-22-35.8-39.6c-8.4-17.9-10.1-37.9-6.1-59.2C23.7 116 52.3 91.2 84.8 78.3c13.3-5.3 27.9-8.9 43.2-11V32c0-17.7 14.3-32 32-32z">
                                                </path>
                                            </svg></span>

                                        <div class="info-box-content">
                                            <span class="info-box-number text-lg">0</span>
                                            <span class="info-box-text text-gray">Tiền trả hàng</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- Đơn hàng trả -->
                                <div class="col-md-3 col-sm-6 col-12">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-danger"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512" fill="white">
                                                <path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z">
                                                </path>
                                            </svg></span>
                                        <div class="info-box-content">
                                            <span class="info-box-number text-lg">0</span>
                                            <span class="info-box-text text-gray">Đơn hàng trả</span>
                                        </div>

                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                            </div>


                            <div class="width-100 ng-scope" data-ng-if="reportTypeModel.type == 1">
                                <div class="col-xs-12 no-padding ng-hide" data-ng-show="reportTypeModel.isChart" id="chartSalerReportContainer" style="">
                                    @include('admin::report.revenue.chart')
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@push('js')
<!-- datetimepicker jQuery CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
{{--
<link rel="stylesheet" href="{{ asset('public/themes/admin/carton/module/revenue.css') }}"> --}}
<style type="text/css">
    .breadcrumbs h3 {
        padding: 13px 0 0 20px;
        color: #307ecc;
        font-size: 20px;
        margin: 0 0 5px;
        font-weight: bold;
    }

    label {
        font-weight: 400;
        font-size: 14px;
    }

    .lbl {
        color: #858585 !important;
    }

    input[type="checkbox"].ace+.lbl,
    input[type="radio"].ace+.lbl {
        position: relative;
        display: inline-block;
        margin: 0;
        line-height: 20px;
        min-height: 18px;
        min-width: 18px;
        font-weight: 400;
        cursor: pointer;
    }

    .k-datepicker .k-picker-wrap input,
    .k-datetimepicker .k-picker-wrap input {
        padding: 0 !important;
        border-radius: 0 !important;
        height: 32px !important;
    }

    span.s1 input.s1 {
        width: 100% !important;
    }

    .btn-group,
    .btn-group-vertical {
        position: relative;
        display: inline-block;
        vertical-align: middle;
    }

    .btn-outline.btn-primary {
        border-color: #428bca;
        color: #428bca !important;
    }

    .btn-outline {
        background-color: transparent !important;
        color: inherit;
        border: 1px solid !important;
        text-shadow: none !important;
    }

    .search-box {
        position: sticky;
        left: 28px;
        text-align: left;
        z-index: 99;
        margin-bottom: 1em;
    }

    .infobox {
        display: inline-block;
        width: 230px;
        height: 66px;
        color: #555;
        background-color: #fff;
        box-shadow: none;
        border-radius: 0;
        margin: -1px 0 0 -1px;
        padding: 8px 3px 6px 9px;
        border: 1px dotted;
        border-color: #d8d8d8 !important;
        vertical-align: middle;
        text-align: left;
        position: relative;
    }

    .infobox>.infobox-icon {
        display: inline-block;
        vertical-align: top;
        width: 44px;
        height: 44px;
    }

    .infobox>.infobox-icon>i {
        background-color: #6fb3e0 !important;
        display: flex !important;
        width: 44px;
        height: 44px;
        align-items: center;
        justify-content: center;
        font-size: 21px;
        border-radius: 100%;
    }

    .infobox-blue>.infobox-icon>i {
        background-color: #6fb3e0 !important;
        color: #fff;
    }

    .infobox-orange {
        color: #e8b110;
        border-color: #e8b110;
    }

    .infobox-orange>.infobox-icon>i {
        background-color: #e8b110 !important;
        color: #fff;
    }

    .infobox>.infobox-data {
        display: inline-block;
        border: none;
        border-top-width: 0;
        font-size: 13px;
        text-align: left;
        line-height: 21px;
        min-width: 130px;
        padding-left: 8px;
        position: relative;
        top: 0;
    }

    .infobox>.infobox-data>.infobox-data-number {
        display: block;
        font-size: 22px;
        margin: 2px 0 4px;
        position: relative;
        text-shadow: 1px 1px 0 rgba(0, 0, 0, 0.15);
    }

    .infobox .infobox-content {
        color: #555;
    }

    .alert-success {
        background-color: #dff0d8 !important;
        border-color: #d6e9c6 !important;
        color: #3c763d !important;
    }

    .inline {
        display: inline-block !important;
    }

    /* payment */
    .payment-content {
        background-color: #fff;
        position: relative;
        margin: 0;
        padding: 8px 0px 0px;
        height: 100vh;
    }

    /* .page-content {
    background-color: #fff;
    position: relative;
    margin: 0;
    padding: 20px 20px 24px;
} */
    .payment-content .ng-scope {
        position: relative;
    }

    .payment-content .search-box {
        position: absolute;
        right: 28px;
        text-align: right;
        z-index: 99;
        top: -30px;
        font-size: f;
    }

    .payment-content .nav {
        width: 300px;
        z-index: 1000;
        position: relative;
        border-bottom: 0;
    }

    .suno-report-box {
        font-size: 18px;
        line-height: 1.8 !important;
        border-radius: 4px;
        line-height: 25px;
        padding: 20px !important;
    }

    .info-title {
        font-weight: bold;
    }

    .infobox-green.infobox-dark {
        background-color: #9abc32;
        border-color: #9abc32;
    }

    .infobox-blue.infobox-dark {
        background-color: #6fb3e0;
        border-color: #6fb3e0;
    }

    .infobox-red.infobox-dark {
        background-color: #d53f40;
        border-color: #d53f40;
    }

    .infobox-orange.infobox-dark {
        background-color: #e8b110;
        border-color: #e8b110;
    }

    .infobox-dark {
        margin: 0;
        color: #fff;
        padding-left: 14px;
    }

    .k-datepicker {
        display: block;
    }

    .dropdown-menu {
        border-radius: 0 !important;
        -webkit-box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .dropdown-menu.show {
        padding: 5px;
    }

    .dropdown-menu .dropdown-submenu:hover>a,
    .dropdown-menu>li.active>a,
    .dropdown-menu>li.active>a:hover,
    .dropdown-menu>li>a:active,
    .dropdown-menu>li>a:focus,
    .dropdown-menu>li>a:hover {
        background: #4f99c6;
        color: #fff !important;
        width: 100%;
        display: block;
    }

    .header {
        line-height: 28px;
        margin-bottom: 16px;
        margin-top: 18px;
        padding-bottom: 4px;
        border-bottom: 1px solid #ccc;
    }

    .suno-report-box-header {
        background-color: #27aae2;
        font-weight: 700;
        padding: 10px;
        font-size: 16px;
        box-shadow: inset;
        color: white;
        margin-bottom: 0;
    }

    .suno-report {
        background-color: #efefef;
        padding: 15px 0;
        font-size: 15px;
        line-height: 1.8;
    }

    /* Payment */

    .k-datepicker input {
        border: 0.5px solid #b3b3b3;
        border-radius: 5px;
        line-height: 20px;
        padding: 5px;
    }
</style>
<script>
    filter_type = 0;
            view_report();
            $("input[name=viewType]").on("click", function() {
                $("input[name=viewType]").prop("checked", false);
                $(this).prop("checked", true);
                view_report();
                showChart();
            });

            $("input[name=viewType]").on("change", function(){
                if($("input[name=viewType]:checked").val() == 4)
                {
                    $("#product_category_id").val("");
                    $("#filter_product_category").show();
                }
                else $("#filter_product_category").hide();
            });




            $("#fromDate, #toDate").on("change", function(){
                if($("#fromDate").val()!="" && $("#toDate").val()!="")
                {
                    view_report();
                }
            });
            $("#filter_product_category").on("change", function(){
                view_report();
                showChart();
            })
            function showChart()
            {
                if( $("input[name=viewType]:checked").val()==1 || $("input[name=viewType]:checked").val()==2)
                {
                    $(".viewChart").show();
                }
                else{

                    $(".viewChart").hide();
                }
            }
            $(document).on("click",'.viewChart',function(){
                $("#chartSalerReportContainer").toggle();
            });
            function view_report(page = 0) {
                showChart();
                type = $("input[name=viewType]:checked").val();
                $.ajax({
                    method: "POST",
                    url: "{{ route('admin.revenue.type') }}"+ (page!=0?"?page="+page:""),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        type: type, filter_type : filter_type, fromDate: $("#fromDate").val(), toDate: $("#toDate").val(),
                        product_category_id: $("#product_category_id").val()
                    }
                }).done(function(res) {
                    $("#reportViewer").html(res);
                });
            }

            function exportExcel()
            {
                type = $("input[name=viewType]:checked").val();
                $.ajax({
                    method: "POST",
                    url: "{{ route('admin.revenue.export') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        type: type, filter_type : filter_type, fromDate: $("#fromDate").val(), toDate: $("#toDate").val()
                    }
                }).done(function(res) {
                    // $("#reportViewer").html(res);
                    window.location.href = res;
                });
            }
            function onTypeChange(value){
                filter_type = value;
                view_report();
            }
            jQuery('#fromDate').datetimepicker({
                i18n: {
                    de: {
                        months: [
                            'Januar', 'Februar', 'März', 'April',
                            'Mai', 'Juni', 'Juli', 'August',
                            'September', 'Oktober', 'November', 'Dezember',
                        ],
                        dayOfWeek: [
                            "So.", "Mo", "Di", "Mi",
                            "Do", "Fr", "Sa.",
                        ]
                    }
                },
                timepicker: false,
                format: 'd/m/Y'
            });
            jQuery('#toDate').datetimepicker({
                i18n: {
                    de: {
                        months: [
                            'Januar', 'Februar', 'März', 'April',
                            'Mai', 'Juni', 'Juli', 'August',
                            'September', 'Oktober', 'November', 'Dezember',
                        ],
                        dayOfWeek: [
                            "So.", "Mo", "Di", "Mi",
                            "Do", "Fr", "Sa.",
                        ]
                    }
                },
                timepicker: false,
                format: 'd/m/Y'
            });
</script>
@endpush
