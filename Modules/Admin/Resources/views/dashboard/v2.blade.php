<div style="margin: 0 14px; padding: 14px 0 51px 0; border-radius: 10px; background: #f5f5f5; margin-bottom: 7px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-uppercase font-weight-bold">
                        Thống kê hoạt động hôm nay
                    </h1>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row mb-3">
                <!-- small box Tổng doanh thu -->
                <div class="col-lg-4 col-6" style="padding: 0 14px;">
                    <div class="info-box d-block h-100">
                        <div class="row">
                            <div class="col-3">
                                <span class="info-box-icon bg-back" style="height: 70px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512" fill="white">
                                        <path
                                            d="M160 0c17.7 0 32 14.3 32 32V67.7c1.6 .2 3.1 .4 4.7 .7c.4 .1 .7 .1 1.1 .2l48 8.8c17.4 3.2 28.9 19.9 25.7 37.2s-19.9 28.9-37.2 25.7l-47.5-8.7c-31.3-4.6-58.9-1.5-78.3 6.2s-27.2 18.3-29 28.1c-2 10.7-.5 16.7 1.2 20.4c1.8 3.9 5.5 8.3 12.8 13.2c16.3 10.7 41.3 17.7 73.7 26.3l2.9 .8c28.6 7.6 63.6 16.8 89.6 33.8c14.2 9.3 27.6 21.9 35.9 39.5c8.5 17.9 10.3 37.9 6.4 59.2c-6.9 38-33.1 63.4-65.6 76.7c-13.7 5.6-28.6 9.2-44.4 11V480c0 17.7-14.3 32-32 32s-32-14.3-32-32V445.1c-.4-.1-.9-.1-1.3-.2l-.2 0 0 0c-24.4-3.8-64.5-14.3-91.5-26.3c-16.1-7.2-23.4-26.1-16.2-42.2s26.1-23.4 42.2-16.2c20.9 9.3 55.3 18.5 75.2 21.6c31.9 4.7 58.2 2 76-5.3c16.9-6.9 24.6-16.9 26.8-28.9c1.9-10.6 .4-16.7-1.3-20.4c-1.9-4-5.6-8.4-13-13.3c-16.4-10.7-41.5-17.7-74-26.3l-2.8-.7 0 0C119.4 279.3 84.4 270 58.4 253c-14.2-9.3-27.5-22-35.8-39.6c-8.4-17.9-10.1-37.9-6.1-59.2C23.7 116 52.3 91.2 84.8 78.3c13.3-5.3 27.9-8.9 43.2-11V32c0-17.7 14.3-32 32-32z"
                                        ></path>
                                    </svg>
                                </span>
                            </div>
                            <div class="col-9 d-flex flex-column justify-content-center">
                                <p class="info-box-text text-gray text-lg fw-500" style="line-height: 1;">
                                    Tổng doanh thu
                                </p>
                                <p class="info-box-number fs-25" style="line-height: 1;">
                                    {{number_format(intval(@$summary->total))}}
                                </p>
                            </div>
                        </div>

                        <!-- /.info-box-content -->
                    </div>
                </div>
                <!-- small box Tổng đơn hàng & hàng hoá -->
                <div class="col-lg-4 col-6" style="padding: 0 14px;">
                    <div class="info-box d-block h-100">
                        <div class="row">
                            <div class="col-3">
                                <span class="info-box-icon bg-back" style="height: 70px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512" fill="white">
                                        <path
                                            d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"
                                        ></path>
                                    </svg>
                                </span>
                            </div>
                            <div class="col-9 d-flex flex-column justify-content-center">
                                <div class="d-flex align-items-center" style="gap: 20px;">
                                    <p class="info-box-text text-gray text-lg fw-500" style="line-height: 1;">
                                        Số đơn hàng
                                    </p>
                                    <p class="info-box-number fs-25 mt-0" style="line-height: 1;">
                                        {{number_format(@$summary->total_order)}}
                                    </p>
                                </div>
                                <div class="mt-2 d-flex align-items-center" style="gap: 20px;">
                                    <p class="info-box-text text-gray text-lg fw-500" style="line-height: 1;">
                                        Số hàng hoá
                                    </p>
                                    <p class="info-box-number fs-25 mt-0" style="line-height: 1;">
                                        {{number_format(@$summary->total_order_detail)}}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- /.info-box-content -->
                    </div>
                </div>
                <!-- small box Vận chuyển-->
                <div class="col-lg-4 col-6" style="padding: 0 14px;">
                    <div class="info-box d-block h-100">
                        <div class="row">
                            <div class="col-3">
                                <span class="info-box-icon bg-back" style="height: 70px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512" fill="white">
                                        <path
                                            d="M48 0C21.5 0 0 21.5 0 48V368c0 26.5 21.5 48 48 48H64c0 53 43 96 96 96s96-43 96-96H384c0 53 43 96 96 96s96-43 96-96h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V288 256 237.3c0-17-6.7-33.3-18.7-45.3L512 114.7c-12-12-28.3-18.7-45.3-18.7H416V48c0-26.5-21.5-48-48-48H48zM416 160h50.7L544 237.3V256H416V160zM112 416a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm368-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"
                                        />
                                    </svg>
                                </span>
                            </div>
                            <div class="col-9 d-flex flex-column justify-content-center">
                                <div class="d-flex align-items-center" style="gap: 20px;">
                                    <p class="info-box-text text-gray text-lg fw-500 w-50" style="line-height: 1;">
                                        Đơn đặt hàng
                                    </p>
                                    <p class="info-box-number fs-25 mt-0" style="line-height: 1;">
                                        {{number_format(@$summary->saleOrder)}}
                                    </p>
                                </div>
                                <div class="mt-2 d-flex align-items-center" style="gap: 20px;">
                                    <p class="info-box-text text-gray text-lg fw-500 w-50" style="line-height: 1;">
                                        Xác nhận
                                    </p>
                                    <p class="info-box-number fs-25 mt-0" style="line-height: 1;">
                                        {{number_format(@$summary->total_order_ship_confirm)}}
                                    </p>
                                </div>
                                <div class="mt-2 d-flex align-items-center" style="gap: 20px;">
                                    <p class="info-box-text text-gray text-lg fw-500 w-50" style="line-height: 1;">
                                        Giao hàng
                                    </p>
                                    <p class="info-box-number fs-25 mt-0" style="line-height: 1;">
                                        {{number_format(@$summary->total_order_ship_delivery)}}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- /.info-box-content -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>



    <!-- chart  -->
    <section class="content">
        <div class="container-fluid">
            <!-- Card thông tin -->
            @include('admin::dashboard.v2.widget-box')
            <!-- Biểu đồ -->
            @include('admin::dashboard.v2.chart')
        </div>
    </section>
</div>


@push("js")
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="{{ assets }}dist/js/pages/dashboard.js"></script>
<script>
    $(function () {
        /* ChartJS
         * -------
         * Here we will create a few charts using ChartJS
         */
        var areaChartData = {
            labels: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật"],
            datasets: [
                {
                    label: "Tuần này",
                    backgroundColor: "#003f93",
                    borderColor: "rgba(60,141,188,0.8)",
                    pointRadius: false,
                    pointColor: "#3b8bba",
                    pointStrokeColor: "rgba(60,141,188,1)",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(60,141,188,1)",
                    data: [{{$report_revenue['week']}}],
                },
                {
                    label: "Tuần trước",
                    backgroundColor: "rgba(210, 214, 222, 1)",
                    borderColor: "rgba(210, 214, 222, 1)",
                    pointRadius: false,
                    pointColor: "rgba(210, 214, 222, 1)",
                    pointStrokeColor: "#c1c7d1",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: [{{$report_revenue['last_week']}}],
                },
            ],
        };

        var areaChartOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: false,
            },
            scales: {
                xAxes: [
                    {
                        gridLines: {
                            display: false,
                        },
                    },
                ],
                yAxes: [
                    {
                        gridLines: {
                            display: false,
                        },
                    },
                ],
            },
        };

        // This will get the first returned node in the jQuery collection.
        // new Chart(areaChartCanvas, {
        //   type: "line",
        //   data: areaChartData,
        //   options: areaChartOptions,
        // });

        //-------------
        //- LINE CHART -
        //--------------
        // var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
        var lineChartOptions = $.extend(true, {}, areaChartOptions);
        var lineChartData = $.extend(true, {}, areaChartData);
        lineChartData.datasets[0].fill = false;
        lineChartData.datasets[1].fill = false;
        lineChartOptions.datasetFill = false;

        //-------------
        //- DONUT CHART -
        //-------------
        var donutData = {
            labels: ["Chrome", "IE", "FireFox", "Safari", "Opera", "Navigator"],
            datasets: [
                {
                    data: [700, 500, 400, 600, 300, 100],
                    backgroundColor: ["#f56954", "#00a65a", "#f39c12", "#00c0ef", "#3c8dbc", "#d2d6de"],
                },
            ],
        };
        var donutOptions = {
            maintainAspectRatio: false,
            responsive: true,
        };

        //-------------
        //- PIE CHART -
        //-------------
        var pieData = donutData;
        var pieOptions = {
            maintainAspectRatio: false,
            responsive: true,
        };

        //-------------
        //- BAR CHART -
        //-------------
        var barChartCanvas = $("#barChart").get(0).getContext("2d");
        var barChartData = $.extend(true, {}, areaChartData);
        var temp0 = areaChartData.datasets[0];
        var temp1 = areaChartData.datasets[1];
        barChartData.datasets[0] = temp1;
        barChartData.datasets[1] = temp0;

        var barChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            datasetFill: false,
        };

        new Chart(barChartCanvas, {
            type: "bar",
            data: barChartData,
            options: barChartOptions,
        });

        //---------------------
        //- STACKED BAR CHART -
        //---------------------

        var stackedBarChartData = $.extend(true, {}, barChartData);

        var stackedBarChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                xAxes: [
                    {
                        stacked: true,
                    },
                ],
                yAxes: [
                    {
                        stacked: true,
                    },
                ],
            },
        };

        new Chart(stackedBarChartCanvas, {
            type: "bar",
            data: stackedBarChartData,
            options: stackedBarChartOptions,
        });
    });
</script>
@endpush
