
<div class="container-fluid main">
    @if (!isset($setting['has_tag']))
    @include('admin::element')
    @endif

    <div class="row detailContent">

        <div data-ng-controller="revenueController" class="ng-scope">
            <div class="breadcrumbs breadcrumbs-fixed" id="breadcrumbs">
                <h3>
                    <a class="ng-binding">Tiền bán hàng </a>
                    <label>
                        <input type="radio" class="hidden-320 ace ng-pristine ng-valid" checked name="viewType" value="5">
                        <span class="lbl ng-binding">Theo thời gian </span>
                    </label>
                    <label>
                        <input type="radio" class="hidden-320 ace ng-pristine ng-valid" name="viewType" value="1">
                        <span class="lbl ng-binding">Theo người bán </span>
                    </label>

                    {{-- <label data-ng-if="reportTypeModel.stores.length > 1" class="ng-scope">
                        <input type="radio" class="hidden-320 ace ng-pristine ng-valid" data-ng-model="reportTypeModel.type" data-ng-value="2" name="viewType" value="2">
                        <span class="lbl ng-binding">Theo cửa hàng</span>
                    </label> --}}
                    <label>
                        <input type="radio" class="hidden-320 ace ng-pristine ng-valid" data-ng-model="reportTypeModel.type" data-ng-value="4" name="viewType" value="4">
                        <span class="lbl ng-binding">Theo hàng hóa</span>
                    </label>
                </h3>
            </div>
            <div class="page-content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <div class="search-box">
                                <!-- ngIf: reportTypeModel.type == 4 -->
                                <span class="k-widget k-datepicker k-header s1" style="width: 120px;display:inline-block">
                                    <input id="fromDate" placeholder="Từ ngày" class="s1 k-input" style="width: 100%;" type="text" autocomplete="off">
                                </span>
                                <span class="hidden-320">-</span>
                                <span class="k-widget k-datepicker k-header s1" style="width: 120px;display:inline-block">
                                    <input id="toDate" placeholder="Đến ngày" class="s1 k-input" style="width: 100%;" type="text" autocomplete="off">
                                </span>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary btn-outline hidden-480 ng-binding ng-pristine ng-valid" data-ng-model="dateRange" data-ng-class="{1:'clicked'}[selected]" onclick="onTypeChange(1)">Tuần</button>
                                    <button type="button" class="btn btn-primary btn-outline hidden-480 ng-binding ng-pristine ng-valid" data-ng-model="dateRange" data-ng-class="{2:'clicked'}[selected]" onclick="onTypeChange(2)">Tháng</button>
                                    <button type="button" class="btn btn-primary btn-outline hidden-768 ng-binding ng-pristine ng-valid" data-ng-model="dateRange" data-ng-class="{3:'clicked'}[selected]" onclick="onTypeChange(3)">Quý</button>
                                </div>
                                <!-- ngIf: reportTypeModel.stores.length > 2 && (reportTypeModel.type >= 3 || reportTypeModel.type <= 5) -->
                                <!-- ngIf: reportTypeModel.users.length > 2 && reportTypeModel.type == 5 -->
                                <!-- ngIf: reportTypeModel.type == 5 -->
                                <!-- ngIf: !reportTypeModel.isChart && reportTypeModel.type <= 3 -->
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
                            <div class="width-100 mb-3" >
                                <div class="infobox infobox-blue">
                                    <div class="infobox-icon">
                                        <i class="fa fa-dollar"></i>
                                    </div>
                                    <div class="infobox-data">
                                        <span class="infobox-data-number ng-binding">{{ number_format($box->total_order) }}</span>
                                        <div class="infobox-content ng-binding">
                                            Tiền bán hàng
                                            {{-- <span class="badge badge-primary ng-hide" data-ng-show="totalSaleReturnRevenue > 0">
                                                <i class="icon-exclamation ng-scope" tooltip-placement="bottom" tooltip-html-unsafe="Bán hàng: <b> </b><br/>Xuất trả NCC: <b></b>"></i>
                                            </span> --}}
                                        </div>
                                    </div>
                                </div>
                                <!-- ngIf: reportTypeModel.type != 4 -->
                                <div class="infobox infobox-blue ng-scope" data-ng-if="reportTypeModel.type != 4">
                                    <div class="infobox-icon">
                                        <i class="fa fa-shopping-cart"></i>
                                    </div>
                                    <div class="infobox-data">
                                        <span class="infobox-data-number ng-binding">{{ number_format($box->count_order) }}</span>
                                        <div class="infobox-content ng-binding">Số đơn hàng </div>
                                    </div>
                                </div><!-- end ngIf: reportTypeModel.type != 4 -->
                                <!-- ngIf: reportTypeModel.type == 4 -->
                                <div class="infobox infobox-orange">
                                    <div class="infobox-icon">
                                        <i class="fa fa-dollar"></i>
                                    </div>
                                    <div class="infobox-data">
                                        <span class="infobox-data-number ng-binding">0</span>
                                        <div class="infobox-content ng-binding">Tiền trả hàng</div>
                                    </div>
                                </div>
                                <!-- ngIf: reportTypeModel.type != 4 -->
                                <div class="infobox infobox-orange ng-scope" data-ng-if="reportTypeModel.type != 4">
                                    <div class="infobox-icon">
                                        <i class="fa fa-shopping-cart"></i>
                                    </div>
                                    <div class="infobox-data">
                                        <span class="infobox-data-number ng-binding">0</span>
                                        <div class="infobox-content ng-binding">Đơn hàng trả </div>
                                    </div>
                                </div>
                            </div>

                            <div class="width-100 ng-scope" data-ng-if="reportTypeModel.type == 1">
                                <div class="col-xs-12 no-padding ng-hide" data-ng-show="reportTypeModel.isChart" id="chartSalerReportContainer" style="">
                                    @include('admin::report.revenue.chart')
                                </div>

                            </div>

                        </div>
                        <!-- // end ngIf: reportTypeModel.type == 1 -->
                        <!--//Saler Report-->
                        <!--Store Report-->
                        <!-- ngIf: reportTypeModel.type == 2 && reportTypeModel.stores.length > 1 -->
                        <!--//Store Report-->
                        <!--Customer Type Report-->
                        <!-- ngIf: reportTypeModel.type == 3 && reportTypeModel.isApplyCustomerPricingPolicy -->
                        <!--//Customer Type Report-->
                        <!--Product Item Report-->
                        <!-- ngIf: reportTypeModel.type == 4 -->
                        <!--//Product Item Report-->
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
<link rel="stylesheet" href="{{ asset('public/themes/admin/carton/module/revenue.css') }}">
<script>
    filter_type = 0;
            view_report();
            $("input[name=viewType]").on("click", function() {
                $("input[name=viewType]").prop("checked", false);
                $(this).prop("checked", true);
                view_report();
                showChart();
            });
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
                        type: type, filter_type : filter_type, fromDate: $("#fromDate").val(), toDate: $("#toDate").val()
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
