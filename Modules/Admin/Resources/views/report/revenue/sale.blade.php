@include("admin::report.revenue.box")

{{-- <div class="col-xs-12 no-padding ng-hide" data-ng-show="reportTypeModel.isChart"  >
    <canvas id="chartSalerReportContainer" style="min-height: 250px; height: 380px; max-height: 380px; max-width: 100%;"></canvas>
    @php
        $chart_names = [];
         $chart_total = [];
    @endphp
    @foreach ($orders as $r)
    @php

    $chart_names[] = @$r->sale->full_name;
    $chart_total[] = $r->total;
    @endphp
    @endforeach
        <script>
            var MeSeContext = document.getElementById("chartSalerReportContainer").getContext("2d");
                var MeSeData = {
                    labels: [{!! "\"".implode("\",\"",$chart_names)."\"" !!}],
                    datasets: [
                        {
                            label: "Test",
                            minBarLength: "5",
                            data: [ {{implode(",",$chart_total)}}],
                            backgroundColor: ["#669911", "#119966" ],
                            hoverBackgroundColor: ["#66A2EB", "#FCCE56"]
                        }]
                };

            var MeSeChart = new Chart(MeSeContext, {
                type: 'horizontalBar',
                data: MeSeData,
                options: {
                    scales: {
                        yAxes: [{
                            stacked: true,
                            barThickness: 10,  // number (pixels) or 'flex'
                            maxBarThickness: 10 // number (pixels)
                        }]
                    }

                }
            });
            </script>

</div> --}}
<div class="table-responsive mt-5" data-ng-show="!reportTypeModel.isChart" >
    <div class="dataTables_wrapper" role="grid">
        <table class="table table-hover table-bordered dataTable ng-scope ng-table" ng-table="salerReportParams">
            <!-- ngInclude: templates.header -->
            <thead ng-include="templates.header" class="ng-scope">
                <tr class="ng-scope">
                    <!-- ngRepeat: column in $columns -->
                </tr>
                <tr ng-show="show_filter" class="ng-table-filters ng-scope ng-hide">
                    <!-- ngRepeat: column in $columns -->
                </tr>
            </thead>
            <thead>
                <tr>
                    {{-- <th class="width-27px"></th> --}}
                    <th class="text-center ng-binding">Người bán</th>
                    <th class="text-center ng-binding">Tiền bán hàng </th>
                    <th class="text-center ng-binding">Số đơn hàng </th>
                    <th class="text-center ng-binding">Hàng hóa bán </th>
                    <th class="text-center ng-binding">Tiền trả hàng</th>
                    <th class="text-center ng-binding">Đơn hàng trả </th>
                    <th class="text-center ng-binding">Hàng hóa trả </th>
                </tr>
            </thead>

            @foreach ($orders as $r)
            <tbody data-ng-repeat="item in params.data" class="ng-scope">
                <tr class="pointer" data-ng-click="collapseDetail(item)">
                    {{-- <td>
                        <i class="blue icon-plus-sign"
                            data-ng-class="item.$isShowDetail ? 'icon-minus-sign' : 'icon-plus-sign'"
                            title="Xem chi tiết"></i>
                    </td> --}}
                    <td class="text-center ng-binding">{{@$r->sale->full_name}}</td>
                    <td class="text-right ng-binding">{{number_format($r->total)}}</td>
                    <td class="text-center ng-binding">{{number_format($r->total_order)}}</</td>
                    <td class="text-center ng-binding">{{number_format($r->total_order_detail)}}</</td>
                    <td class="text-right ng-binding">0</td>
                    <td class="text-center ng-binding">0</td>
                    <td class="text-center ng-binding">0</td>
                </tr>
            </tbody>
            @endforeach
        </table>
        {{-- <div ng-table-pagination="params" template-url="templates.pagination" class="row ng-scope ng-isolate-scope">

            <div ng-include="templateUrl" class="col-sm-12 pull-right ng-scope">
                <div class="dataTables_paginate paging_bootstrap ng-scope">
                    <div ng-if="params.settings().total > 10" class="pull-right ng-scope"><select
                            class="height-32px ng-pristine ng-valid" ng-init="params.settings().count"
                            ng-model="params.settings().count" ng-options="c for c in params.settings().counts"
                            ng-change="params.count(params.settings().count)">
                            <option value="0" selected="selected">10</option>
                            <option value="1">25</option>
                            <option value="2">50</option>
                            <option value="3">100</option>
                        </select></div>
                    <ul class="pagination">
                        <li class="disabled hidden-768"> <a ng-show="lastpage > 2" class="ng-hide">Trang </a><input
                                type="text"
                                style="width:42px; height:32px !important; float:left; border-radius:0px !important;margin:0"
                                ng-show="lastpage > 2" ng-model="curPage" ng-change="changePage(curPage)"
                                class="ng-pristine ng-valid ng-hide"><a ng-show="lastpage > 2"
                                class="ng-binding ng-hide"> / 1</a></li>
                    </ul>
                </div>
            </div>
        </div> --}}
    </div>
</div>
