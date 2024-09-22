@extends('admin::layouts.master')
@section('header')
    @include('admin::components.header')
@endsection
@section('content')
    <div class="detailBlock">
        @if(!isset($setting['has_tag']))
            @include("admin::element")
        @endif

        <div class="row">
            <form action="" class="updateFrm" method="POST" enctype="multipart/form-data" >
                <div data-ng-controller="profitController" class="ng-scope">
                    <div class="breadcrumbs breadcrumbs-fixed" id="breadcrumbs">
                        <h3>
                            <a href="#/profit" style="padding-right: 10px;" class="ng-binding">Lợi nhuận</a>
                            <label>
                                <input type="radio" class="hidden-320 ace ng-pristine ng-valid" data-ng-model="showByOption" data-ng-value="1" name="viewType" data-ng-change="showBy()" value="1">
                                <span class="lbl ng-binding">Theo thời gian</span>
                            </label>
                            <label>
                                <input type="radio" class="hidden-320 ace ng-pristine ng-valid" data-ng-model="showByOption" data-ng-value="2" name="viewType" data-ng-change="showBy()" value="2">
                                <span class="lbl ng-binding">Theo hàng hóa</span>
                            </label>
                            {{-- <label>
                                <input type="radio" class="hidden-320 ace ng-pristine ng-valid" data-ng-model="showByOption" data-ng-value="3" name="viewType" data-ng-change="showBy()" value="3">
                                <span class="lbl ng-binding">Theo cửa hàng</span>
                            </label> --}}

                            <label>
                                <input type="radio" class="hidden-320 ace ng-pristine ng-valid" data-ng-model="showByOption" data-ng-value="4" name="viewType" data-ng-change="showBy()" value="4">
                                <span class="lbl ng-binding">Báo cáo lãi lỗ</span>
                            </label>
                        </h3>
                    </div>
                    <div class="page-content">
                        <div id="profitByTime">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <div class="width-100 search-box">
                                            <div class="col-sm-12 no-padding">
                                                <select data-ng-model="periodType" data-ng-change="periodTypeChange()" class="p-100 ng-pristine ng-valid">
                                                    <option value="1" class="ng-binding">Theo ngày</option>
                                                    <option value="2" class="ng-binding">Theo tuần</option>
                                                    <option value="3" class="ng-binding">Theo tháng</option>
                                                </select>
                                                <span class="k-widget k-datepicker k-header s1" style="width: 120px;"><span class="k-picker-wrap k-state-default"><input id="fromDate2" class="s1 k-input" style="width: 100%;" k-ng-model="fromDate2" placeholder="Từ ngày" data-role="datepicker" type="text" role="combobox" aria-expanded="false" aria-owns="fromDate2_dateview" aria-disabled="false" aria-readonly="false"><span unselectable="on" class="k-select" role="button" aria-controls="fromDate2_dateview"><span unselectable="on" class="k-icon k-i-calendar">select</span></span></span></span>
                                                <span class="hidden-320">-</span>
                                                <span class="k-widget k-datepicker k-header s1" style="width: 120px;"><span class="k-picker-wrap k-state-default"><input id="toDate2" class="s1 k-input" style="width: 100%;" k-ng-model="toDate2" placeholder="Đến ngày" data-role="datepicker" type="text" role="combobox" aria-expanded="false" aria-owns="toDate2_dateview" aria-disabled="false" aria-readonly="false"><span unselectable="on" class="k-select" role="button" aria-controls="toDate2_dateview"><span unselectable="on" class="k-icon k-i-calendar">select</span></span></span></span>

                                                <span data-ng-hide="byTimeChart" class="padding-left-10">
                                                    <button type="button" class="btn btn-primary" data-ng-click="byTimeChart = true">
                                                        <i class="icon-signal"></i>
                                                        <span class="hidden-768 ng-binding">Xem biểu đồ</span>
                                                    </button>
                                                </span>
                                                <span data-ng-show="byTimeChart" class="padding-left-10 ng-hide">
                                                    <button type="button" class="btn btn-primary" data-ng-click="byTimeChart = false">
                                                        <i class="icon-search"></i>
                                                        <span class="hidden-768 ng-binding">Xem danh sách</span>
                                                    </button>
                                                </span>
                                                <span class="hidden-480">
                                                    <button class="btn btn-success" data-ng-click="exportByTime()">
                                                        <i class="icon-download-alt white"></i>
                                                        <span class="hidden-768 ng-binding">Xuất excel</span>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="width-100 summary-head col-xs-12 no-padding" style="margin-bottom: 15px;" data-ng-init="initReportByTime();getReportByTime();">
                                        <div class="infobox infobox-orange">
                                            <div class="infobox-icon">
                                                <i class="icon-signal"></i>
                                            </div>
                                            <div class="infobox-data">
                                                <span class="infobox-data-number ng-binding">3,662,602,889</span>
                                                <div class="infobox-content ng-binding">Doanh thu
                                                    <span class="badge badge-primary ng-scope" data-ng-show="totalVat <= 0 " tooltip="Doanh số đã trừ tiền giảm giá">
                                                        <i class="icon icon-info"></i>
                                                    </span>
                                                    <span class="badge badge-primary ng-scope ng-hide" data-ng-show="totalVat > 0 " tooltip="Doanh số đã trừ tiền giảm giá và VAT">
                                                        <i class="icon icon-info"></i>
                                                    </span>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="infobox infobox-green">
                                            <div class="infobox-icon">
                                                <i class="icon-dollar"></i>
                                            </div>
                                            <div class="infobox-data">
                                                <span class="infobox-data-number ng-binding">480,675,231</span>
                                                <div class="infobox-content ng-binding">
                                                    Lãi gộp <span data-ng-hide="totalGrossProfitByTime < 0" class="badge badge-primary"><i class="icon icon-info ng-scope" tooltip="Lãi gộp là lợi nhuận từ bán hàng khi chưa trừ các chi phí khác"></i></span>
                                                    <span data-ng-show="totalGrossProfitByTime < 0" data-role="tooltip" kendo-tooltip="" k-content="'<b>Lợi nhuận</b>=<b>Doanh thu</b>-<b>Tiền trả hàng</b>-<b>Tiền vốn</b><br />(*) <b>Lợi nhuận có thể âm</b> khi hàng hóa có giá bán thấp hơn giá vốn hoặc tiền trả hàng.'" class="badge badge-primary ng-hide"><i class="icon-info ng-scope"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="infobox infobox-orange2">
                                            <div class="infobox-icon">
                                                <i class="icon-undo "></i>
                                            </div>
                                            <div class="infobox-data">
                                                <span class="infobox-data-number ng-binding">0</span>
                                                <div class="infobox-content ng-binding">Tiền trả hàng</div>
                                            </div>
                                        </div>
                                        <div class="infobox infobox-blue">
                                            <div class="infobox-icon">
                                                <i class="icon-money"></i>
                                            </div>
                                            <div class="infobox-data">
                                                <span class="infobox-data-number ng-binding">3,181,927,658</span>
                                                <div class="infobox-content ng-binding">
                                                    Tiền vốn mua hàng hóa
                                                    <span data-ng-show="totalCostByTime < 0" data-role="tooltip" kendo-tooltip="" k-content="'<b>Lợi nhuận</b>=<b>Doanh thu</b>-<b>Tiền trả hàng</b>-<b>Tiền vốn</b><br />(*) <b>Tiền vốn có thể âm</b> khi tiền trả hàng lớn hơn tiền bán hàng.'" class="badge badge-primary ng-hide"><i class="icon-info ng-scope"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="infobox infobox-orange2 hidden-1024">
                                            <div class="infobox-icon">
                                                <i class="icon-gift "></i>
                                            </div>
                                            <div class="infobox-data">
                                                <span class="infobox-data-number ng-binding">71,803,165</span>
                                                <div class="infobox-content ng-binding">Tiền giảm giá</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive" data-ng-hide="byTimeChart">
                                        <div class="dataTables_wrapper" role="grid">
                                            <table class="table table-striped table-bordered table-hover dataTable ng-scope ng-table" data-ng-table="byTimeParams"><!-- ngInclude: templates.header --><thead ng-include="templates.header" class="ng-scope"><tr class="ng-scope"> <!-- ngRepeat: column in $columns --> </tr> <tr ng-show="show_filter" class="ng-table-filters ng-scope ng-hide"> <!-- ngRepeat: column in $columns --> </tr></thead>
                                                <thead>
                                                    <tr role="row">
                                                        <th class="sorting border ng-binding sorting_desc" data-ng-class="{'sorting_asc': byTimeParams.isSortBy('date', 'asc'), 'sorting_desc': byTimeParams.isSortBy('date', 'desc')}" data-ng-click="byTimeParams.sorting({'date': byTimeParams.isSortBy('date', 'asc') ? 'desc' : 'asc'})">Thời gian</th>
                                                        <th class="sorting center border ng-binding" data-ng-class="{'sorting_asc': byTimeParams.isSortBy('sellQty', 'asc'), 'sorting_desc': byTimeParams.isSortBy('sellQty', 'desc')}" data-ng-click="byTimeParams.sorting({'sellQty': byTimeParams.isSortBy('sellQty', 'asc') ? 'desc' : 'asc'})">SL bán

                                                            <span tooltip="Số đơn hàng: 1,149" class="badge badge-primary ng-scope"><i class="icon-info smaller"></i></span>
                                                        </th>
                                                        <th class="sorting center border hidden-480 ng-binding" data-ng-class="{'sorting_asc': byTimeParams.isSortBy('returnQty', 'asc'), 'sorting_desc': byTimeParams.isSortBy('returnQty', 'desc')}" data-ng-click="byTimeParams.sorting({'returnQty': byTimeParams.isSortBy('returnQty', 'asc') ? 'desc' : 'asc'})">SL trả

                                                            <span tooltip="Số phiếu nhập trả: 0" class="badge badge-primary ng-scope"><i class="icon-info smaller"></i></span>
                                                        </th>
                                                        <th class="sorting center border hidden-320 ng-binding" data-ng-class="{'sorting_asc': byTimeParams.isSortBy('discount', 'asc'), 'sorting_desc': byTimeParams.isSortBy('discount', 'desc')}" data-ng-click="byTimeParams.sorting({'discount': byTimeParams.isSortBy('discount', 'asc') ? 'desc' : 'asc'})">Giảm giá</th>
                                                        <th has-permission="POSIM_EarningPoint" class="sorting center border hidden-320 ng-binding" data-ng-class="{'sorting_asc': byTimeParams.isSortBy('exchangedMoney', 'asc'), 'sorting_desc': byTimeParams.isSortBy('exchangedMoney', 'desc')}" data-ng-click="byTimeParams.sorting({'exchangedMoney': byTimeParams.isSortBy('exchangedMoney', 'asc') ? 'desc' : 'asc'})">Quy đổi</th>
                                                        <th class="sorting center border ng-binding" data-ng-class="{'sorting_asc': byTimeParams.isSortBy('revenue', 'asc'), 'sorting_desc': byTimeParams.isSortBy('revenue', 'desc')}" data-ng-click="byTimeParams.sorting({'revenue': byTimeParams.isSortBy('revenue', 'asc') ? 'desc' : 'asc'})">Doanh thu</th>
                                                        <!-- ngIf: totalVat > 0 -->
                                                        <th class="sorting center hidden-480 ng-binding" data-ng-class="{'sorting_asc': byTimeParams.isSortBy('returnCost', 'asc'), 'sorting_desc': byTimeParams.isSortBy('returnCost', 'desc')}" data-ng-click="byTimeParams.sorting({'returnCost': byTimeParams.isSortBy('returnCost', 'asc') ? 'desc' : 'asc'})">Trả hàng</th>
                                                        <th class="sorting center hidden-480 ng-binding" data-ng-class="{'sorting_asc': byTimeParams.isSortBy('cost', 'asc'), 'sorting_desc': byTimeParams.isSortBy('cost', 'desc')}" data-ng-click="byTimeParams.sorting({'cost': byTimeParams.isSortBy('cost', 'asc') ? 'desc' : 'asc'})">Vốn </th>
                                                        <th class="sorting center border white-bg ng-binding" data-ng-class="{'sorting_asc': byTimeParams.isSortBy('gp', 'asc'), 'sorting_desc': byTimeParams.isSortBy('gp', 'desc')}" data-ng-click="byTimeParams.sorting({'gp': byTimeParams.isSortBy('gp', 'asc') ? 'desc' : 'asc'})">Lãi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- ngRepeat: r in params.data --><tr data-ng-repeat="r in params.data" class="ng-scope">
                                                        <td data-title="'Thời gian'" sortable="'date'" class="ng-binding">15/06/2023</td>
                                                        <td data-title="'SL bán'" class="text-center sorting ng-binding" sortable="'sellQty'">88</td>
                                                        <td data-title="'SL trả'" class="text-center sorting hidden-480 ng-binding" sortable="'returnQty'">0</td>
                                                        <td data-title="'Giảm giá'" class="text-right sorting hidden-320 ng-binding" sortable="'discount'">4,318,310</td>
                                                        <td has-permission="POSIM_EarningPoint" data-title="'Quy đổi'" class="text-right sorting hidden-320 ng-binding" sortable="'exchangedMoney'">0</td>
                                                        <td data-title="'Doanh thu'" class="text-right sorting ng-binding" sortable="'earning'">153,740,120</td>
                                                        <!-- ngIf: totalVat > 0 -->
                                                        <td data-title="'Tiền trả hàng'" class="text-right sorting hidden-480 ng-binding" sortable="'cost'">0</td>
                                                        <td data-title="'Vốn'" class="text-right sorting hidden-480 ng-binding" sortable="'cost'">119,607,184</td>
                                                        <td data-title="'Lợi nhuận'" class="text-right sorting hl ng-binding" sortable="'gp'">34,132,936</td>
                                                    </tr><!-- end ngRepeat: r in params.data --><tr data-ng-repeat="r in params.data" class="ng-scope">
                                                        <td data-title="'Thời gian'" sortable="'date'" class="ng-binding">14/06/2023</td>
                                                        <td data-title="'SL bán'" class="text-center sorting ng-binding" sortable="'sellQty'">96</td>
                                                        <td data-title="'SL trả'" class="text-center sorting hidden-480 ng-binding" sortable="'returnQty'">0</td>
                                                        <td data-title="'Giảm giá'" class="text-right sorting hidden-320 ng-binding" sortable="'discount'">6,135,786</td>
                                                        <td has-permission="POSIM_EarningPoint" data-title="'Quy đổi'" class="text-right sorting hidden-320 ng-binding" sortable="'exchangedMoney'">0</td>
                                                        <td data-title="'Doanh thu'" class="text-right sorting ng-binding" sortable="'earning'">292,422,325</td>
                                                        <!-- ngIf: totalVat > 0 -->
                                                        <td data-title="'Tiền trả hàng'" class="text-right sorting hidden-480 ng-binding" sortable="'cost'">0</td>
                                                        <td data-title="'Vốn'" class="text-right sorting hidden-480 ng-binding" sortable="'cost'">248,773,539</td>
                                                        <td data-title="'Lợi nhuận'" class="text-right sorting hl ng-binding" sortable="'gp'">43,648,786</td>
                                                    </tr><!-- end ngRepeat: r in params.data --><tr data-ng-repeat="r in params.data" class="ng-scope">
                                                        <td data-title="'Thời gian'" sortable="'date'" class="ng-binding">13/06/2023</td>
                                                        <td data-title="'SL bán'" class="text-center sorting ng-binding" sortable="'sellQty'">84</td>
                                                        <td data-title="'SL trả'" class="text-center sorting hidden-480 ng-binding" sortable="'returnQty'">0</td>
                                                        <td data-title="'Giảm giá'" class="text-right sorting hidden-320 ng-binding" sortable="'discount'">2,830,900</td>
                                                        <td has-permission="POSIM_EarningPoint" data-title="'Quy đổi'" class="text-right sorting hidden-320 ng-binding" sortable="'exchangedMoney'">0</td>
                                                        <td data-title="'Doanh thu'" class="text-right sorting ng-binding" sortable="'earning'">246,749,770</td>
                                                        <!-- ngIf: totalVat > 0 -->
                                                        <td data-title="'Tiền trả hàng'" class="text-right sorting hidden-480 ng-binding" sortable="'cost'">0</td>
                                                        <td data-title="'Vốn'" class="text-right sorting hidden-480 ng-binding" sortable="'cost'">216,232,583</td>
                                                        <td data-title="'Lợi nhuận'" class="text-right sorting hl ng-binding" sortable="'gp'">30,517,187</td>
                                                    </tr><!-- end ngRepeat: r in params.data --><tr data-ng-repeat="r in params.data" class="ng-scope">
                                                        <td data-title="'Thời gian'" sortable="'date'" class="ng-binding">12/06/2023</td>
                                                        <td data-title="'SL bán'" class="text-center sorting ng-binding" sortable="'sellQty'">100</td>
                                                        <td data-title="'SL trả'" class="text-center sorting hidden-480 ng-binding" sortable="'returnQty'">0</td>
                                                        <td data-title="'Giảm giá'" class="text-right sorting hidden-320 ng-binding" sortable="'discount'">3,835,550</td>
                                                        <td has-permission="POSIM_EarningPoint" data-title="'Quy đổi'" class="text-right sorting hidden-320 ng-binding" sortable="'exchangedMoney'">0</td>
                                                        <td data-title="'Doanh thu'" class="text-right sorting ng-binding" sortable="'earning'">295,119,566</td>
                                                        <!-- ngIf: totalVat > 0 -->
                                                        <td data-title="'Tiền trả hàng'" class="text-right sorting hidden-480 ng-binding" sortable="'cost'">0</td>
                                                        <td data-title="'Vốn'" class="text-right sorting hidden-480 ng-binding" sortable="'cost'">260,507,846</td>
                                                        <td data-title="'Lợi nhuận'" class="text-right sorting hl ng-binding" sortable="'gp'">34,611,720</td>
                                                    </tr><!-- end ngRepeat: r in params.data --><tr data-ng-repeat="r in params.data" class="ng-scope">
                                                        <td data-title="'Thời gian'" sortable="'date'" class="ng-binding">11/06/2023</td>
                                                        <td data-title="'SL bán'" class="text-center sorting ng-binding" sortable="'sellQty'">5</td>
                                                        <td data-title="'SL trả'" class="text-center sorting hidden-480 ng-binding" sortable="'returnQty'">0</td>
                                                        <td data-title="'Giảm giá'" class="text-right sorting hidden-320 ng-binding" sortable="'discount'">0</td>
                                                        <td has-permission="POSIM_EarningPoint" data-title="'Quy đổi'" class="text-right sorting hidden-320 ng-binding" sortable="'exchangedMoney'">0</td>
                                                        <td data-title="'Doanh thu'" class="text-right sorting ng-binding" sortable="'earning'">10,740,500</td>
                                                        <!-- ngIf: totalVat > 0 -->
                                                        <td data-title="'Tiền trả hàng'" class="text-right sorting hidden-480 ng-binding" sortable="'cost'">0</td>
                                                        <td data-title="'Vốn'" class="text-right sorting hidden-480 ng-binding" sortable="'cost'">7,850,000</td>
                                                        <td data-title="'Lợi nhuận'" class="text-right sorting hl ng-binding" sortable="'gp'">2,890,500</td>
                                                    </tr><!-- end ngRepeat: r in params.data --><tr data-ng-repeat="r in params.data" class="ng-scope">
                                                        <td data-title="'Thời gian'" sortable="'date'" class="ng-binding">10/06/2023</td>
                                                        <td data-title="'SL bán'" class="text-center sorting ng-binding" sortable="'sellQty'">73</td>
                                                        <td data-title="'SL trả'" class="text-center sorting hidden-480 ng-binding" sortable="'returnQty'">0</td>
                                                        <td data-title="'Giảm giá'" class="text-right sorting hidden-320 ng-binding" sortable="'discount'">5,179,250</td>
                                                        <td has-permission="POSIM_EarningPoint" data-title="'Quy đổi'" class="text-right sorting hidden-320 ng-binding" sortable="'exchangedMoney'">0</td>
                                                        <td data-title="'Doanh thu'" class="text-right sorting ng-binding" sortable="'earning'">206,175,630</td>
                                                        <!-- ngIf: totalVat > 0 -->
                                                        <td data-title="'Tiền trả hàng'" class="text-right sorting hidden-480 ng-binding" sortable="'cost'">0</td>
                                                        <td data-title="'Vốn'" class="text-right sorting hidden-480 ng-binding" sortable="'cost'">184,788,786</td>
                                                        <td data-title="'Lợi nhuận'" class="text-right sorting hl ng-binding" sortable="'gp'">21,386,844</td>
                                                    </tr><!-- end ngRepeat: r in params.data --><tr data-ng-repeat="r in params.data" class="ng-scope">
                                                        <td data-title="'Thời gian'" sortable="'date'" class="ng-binding">09/06/2023</td>
                                                        <td data-title="'SL bán'" class="text-center sorting ng-binding" sortable="'sellQty'">80</td>
                                                        <td data-title="'SL trả'" class="text-center sorting hidden-480 ng-binding" sortable="'returnQty'">0</td>
                                                        <td data-title="'Giảm giá'" class="text-right sorting hidden-320 ng-binding" sortable="'discount'">7,782,500</td>
                                                        <td has-permission="POSIM_EarningPoint" data-title="'Quy đổi'" class="text-right sorting hidden-320 ng-binding" sortable="'exchangedMoney'">0</td>
                                                        <td data-title="'Doanh thu'" class="text-right sorting ng-binding" sortable="'earning'">230,784,378</td>
                                                        <!-- ngIf: totalVat > 0 -->
                                                        <td data-title="'Tiền trả hàng'" class="text-right sorting hidden-480 ng-binding" sortable="'cost'">0</td>
                                                        <td data-title="'Vốn'" class="text-right sorting hidden-480 ng-binding" sortable="'cost'">201,062,407</td>
                                                        <td data-title="'Lợi nhuận'" class="text-right sorting hl ng-binding" sortable="'gp'">29,721,971</td>
                                                    </tr><!-- end ngRepeat: r in params.data --><tr data-ng-repeat="r in params.data" class="ng-scope">
                                                        <td data-title="'Thời gian'" sortable="'date'" class="ng-binding">08/06/2023</td>
                                                        <td data-title="'SL bán'" class="text-center sorting ng-binding" sortable="'sellQty'">63</td>
                                                        <td data-title="'SL trả'" class="text-center sorting hidden-480 ng-binding" sortable="'returnQty'">0</td>
                                                        <td data-title="'Giảm giá'" class="text-right sorting hidden-320 ng-binding" sortable="'discount'">3,028,570</td>
                                                        <td has-permission="POSIM_EarningPoint" data-title="'Quy đổi'" class="text-right sorting hidden-320 ng-binding" sortable="'exchangedMoney'">0</td>
                                                        <td data-title="'Doanh thu'" class="text-right sorting ng-binding" sortable="'earning'">232,217,175</td>
                                                        <!-- ngIf: totalVat > 0 -->
                                                        <td data-title="'Tiền trả hàng'" class="text-right sorting hidden-480 ng-binding" sortable="'cost'">0</td>
                                                        <td data-title="'Vốn'" class="text-right sorting hidden-480 ng-binding" sortable="'cost'">203,925,586</td>
                                                        <td data-title="'Lợi nhuận'" class="text-right sorting hl ng-binding" sortable="'gp'">28,291,589</td>
                                                    </tr><!-- end ngRepeat: r in params.data --><tr data-ng-repeat="r in params.data" class="ng-scope">
                                                        <td data-title="'Thời gian'" sortable="'date'" class="ng-binding">07/06/2023</td>
                                                        <td data-title="'SL bán'" class="text-center sorting ng-binding" sortable="'sellQty'">114</td>
                                                        <td data-title="'SL trả'" class="text-center sorting hidden-480 ng-binding" sortable="'returnQty'">0</td>
                                                        <td data-title="'Giảm giá'" class="text-right sorting hidden-320 ng-binding" sortable="'discount'">9,125,370</td>
                                                        <td has-permission="POSIM_EarningPoint" data-title="'Quy đổi'" class="text-right sorting hidden-320 ng-binding" sortable="'exchangedMoney'">0</td>
                                                        <td data-title="'Doanh thu'" class="text-right sorting ng-binding" sortable="'earning'">533,128,950</td>
                                                        <!-- ngIf: totalVat > 0 -->
                                                        <td data-title="'Tiền trả hàng'" class="text-right sorting hidden-480 ng-binding" sortable="'cost'">0</td>
                                                        <td data-title="'Vốn'" class="text-right sorting hidden-480 ng-binding" sortable="'cost'">461,863,367</td>
                                                        <td data-title="'Lợi nhuận'" class="text-right sorting hl ng-binding" sortable="'gp'">71,265,583</td>
                                                    </tr><!-- end ngRepeat: r in params.data --><tr data-ng-repeat="r in params.data" class="ng-scope">
                                                        <td data-title="'Thời gian'" sortable="'date'" class="ng-binding">06/06/2023</td>
                                                        <td data-title="'SL bán'" class="text-center sorting ng-binding" sortable="'sellQty'">96</td>
                                                        <td data-title="'SL trả'" class="text-center sorting hidden-480 ng-binding" sortable="'returnQty'">0</td>
                                                        <td data-title="'Giảm giá'" class="text-right sorting hidden-320 ng-binding" sortable="'discount'">4,808,379</td>
                                                        <td has-permission="POSIM_EarningPoint" data-title="'Quy đổi'" class="text-right sorting hidden-320 ng-binding" sortable="'exchangedMoney'">0</td>
                                                        <td data-title="'Doanh thu'" class="text-right sorting ng-binding" sortable="'earning'">263,065,105</td>
                                                        <!-- ngIf: totalVat > 0 -->
                                                        <td data-title="'Tiền trả hàng'" class="text-right sorting hidden-480 ng-binding" sortable="'cost'">0</td>
                                                        <td data-title="'Vốn'" class="text-right sorting hidden-480 ng-binding" sortable="'cost'">234,550,967</td>
                                                        <td data-title="'Lợi nhuận'" class="text-right sorting hl ng-binding" sortable="'gp'">28,514,138</td>
                                                    </tr><!-- end ngRepeat: r in params.data -->
                                                </tbody>
                                            </table><div ng-table-pagination="params" template-url="templates.pagination" class="row ng-scope ng-isolate-scope"><!-- ngInclude: templateUrl --><div ng-include="templateUrl" class="col-sm-12 pull-right ng-scope"><div class="dataTables_paginate paging_bootstrap ng-scope"><!-- ngIf: params.data.length == 0 --><!-- ngIf: params.settings().total > 10 --><div ng-if="params.settings().total > 10" class="pull-right ng-scope"><select class="height-32px ng-pristine ng-valid" ng-init="params.settings().count" ng-model="params.settings().count" ng-options="c for c in params.settings().counts" ng-change="params.count(params.settings().count)"><option value="0" selected="selected">10</option><option value="1">25</option><option value="2">50</option><option value="3">100</option></select></div><!-- end ngIf: params.settings().total > 10 --><ul class="pagination"> <!-- ngIf: lastpage > 5 --> <!-- ngRepeat: page in pages --><li ng-class="{'disabled': !page.active, 'active': params.page()===page.number &amp;&amp; (page.type !=='prev' &amp;&amp; page.type !=='next')}" ng-repeat="page in pages" ng-switch="page.type" class="ng-scope disabled"> <!-- ngSwitchWhen: prev --><a ng-switch-when="prev" ng-click="params.page(page.number)" class="ng-scope"><i class="icon-angle-left"></i></a><!-- ngSwitchWhen: first --><!-- ngSwitchWhen: page --><!-- ngSwitchWhen: more --><!-- ngSwitchWhen: last --><!-- ngSwitchWhen: next --></li><!-- end ngRepeat: page in pages --><li ng-class="{'disabled': !page.active, 'active': params.page()===page.number &amp;&amp; (page.type !=='prev' &amp;&amp; page.type !=='next')}" ng-repeat="page in pages" ng-switch="page.type" class="ng-scope disabled active"> <!-- ngSwitchWhen: prev --><!-- ngSwitchWhen: first --><a ng-switch-when="first" ng-click="params.page(page.number)" class="ng-binding ng-scope">1</a><!-- ngSwitchWhen: page --><!-- ngSwitchWhen: more --><!-- ngSwitchWhen: last --><!-- ngSwitchWhen: next --></li><!-- end ngRepeat: page in pages --><li ng-class="{'disabled': !page.active, 'active': params.page()===page.number &amp;&amp; (page.type !=='prev' &amp;&amp; page.type !=='next')}" ng-repeat="page in pages" ng-switch="page.type" class="ng-scope"> <!-- ngSwitchWhen: prev --><!-- ngSwitchWhen: first --><!-- ngSwitchWhen: page --><!-- ngSwitchWhen: more --><!-- ngSwitchWhen: last --><a ng-switch-when="last" ng-click="params.page(page.number)" class="ng-binding ng-scope">2</a><!-- ngSwitchWhen: next --></li><!-- end ngRepeat: page in pages --><li ng-class="{'disabled': !page.active, 'active': params.page()===page.number &amp;&amp; (page.type !=='prev' &amp;&amp; page.type !=='next')}" ng-repeat="page in pages" ng-switch="page.type" class="ng-scope"> <!-- ngSwitchWhen: prev --><!-- ngSwitchWhen: first --><!-- ngSwitchWhen: page --><!-- ngSwitchWhen: more --><!-- ngSwitchWhen: last --><!-- ngSwitchWhen: next --><a ng-switch-when="next" ng-click="params.page(page.number)" class="ng-scope"><i class="icon-angle-right"></i></a></li><!-- end ngRepeat: page in pages --> <!-- ngIf: lastpage > 5 --> <li class="disabled hidden-768"> <a ng-show="lastpage > 2" class="ng-hide">Trang </a><input type="text" style="width:42px; height:32px !important; float:left; border-radius:0px !important;margin:0" ng-show="lastpage > 2" ng-model="curPage" ng-change="changePage(curPage)" class="ng-pristine ng-valid ng-hide"><a ng-show="lastpage > 2" class="ng-binding ng-hide"> / 1</a></li></ul></div></div></div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 no-padding ng-hide" data-ng-show="byTimeChart" id="byTimeChartContainer">
                                        <div id="chartProfitByTime" style="min-width: 240px; min-height: 480px; max-width: 960px; max-height: 480px; position: relative;" data-role="chart" class="k-chart"><!--?xml version='1.0' ?--><svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="600px" height="400px" style="position: relative; display: block;"><defs id="k10290"><clipPath id="k10291"><path style="display: block; " d="M81 46 594 46 594 333.674 81 333.674 z" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path></clipPath><linearGradient id="k10196" gradientTransform="rotate(0)"> <stop offset="0%" style="stop-color:#fff;stop-opacity:0"></stop><stop offset="25%" style="stop-color:#fff;stop-opacity:0.3"></stop><stop offset="100%" style="stop-color:#fff;stop-opacity:0"></stop></linearGradient></defs><path style="display: block; " d="M0 0 600 0 600 400 0 400 z" stroke="" stroke-width="0" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#fff"></path><path style="display: block; " d="M81.5 46.5 594.5 46.5 594.5 334.5 81.5 334.5 z" stroke-width="0.1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path id="k10289" style="display: block; " data-model-id="k10288" d="M81 46 594 46 594 333.674 81 333.674 z" stroke="" stroke-linecap="square" stroke-linejoin="round" fill-opacity="0" stroke-opacity="1" fill="#fff"></path><g id="k10287"><path style="display: block; " data-model-id="k10288" d="M81.5 334.5 594.5 334.5" stroke="#dfdfdf" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " data-model-id="k10288" d="M81.5 286.5 594.5 286.5" stroke="#dfdfdf" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " data-model-id="k10288" d="M81.5 238.5 594.5 238.5" stroke="#dfdfdf" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " data-model-id="k10288" d="M81.5 190.5 594.5 190.5" stroke="#dfdfdf" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " data-model-id="k10288" d="M81.5 142.5 594.5 142.5" stroke="#dfdfdf" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " data-model-id="k10288" d="M81.5 94.5 594.5 94.5" stroke="#dfdfdf" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " data-model-id="k10288" d="M81.5 46.5 594.5 46.5" stroke="#dfdfdf" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M81.5 334.5 594.5 334.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M81.5 334.5 81.5 338.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M132.5 334.5 132.5 338.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M184.5 334.5 184.5 338.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M235.5 334.5 235.5 338.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M286.5 334.5 286.5 338.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M338.5 334.5 338.5 338.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M389.5 334.5 389.5 338.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M440.5 334.5 440.5 338.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M491.5 334.5 491.5 338.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M543.5 334.5 543.5 338.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M594.5 334.5 594.5 338.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><g id="k10292" clip-path="url(#k10291)"><g id="k10399"><g><path id="k10195" style="display: block; " data-model-id="k10401" d="M96.5 276.5 117.5 276.5 117.5 334.5 96.5 334.5 z" stroke="#096ca1" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#0b87c9"></path><path id="k10400" style="display: block; " data-model-id="k10401" d="M96.5 276.5 117.5 276.5 117.5 334.5 96.5 334.5 z" stroke="#096ca1" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="url(#k10196)"></path></g><g><path id="k10197" style="display: block; " data-model-id="k10405" d="M96.5 260.5 117.5 260.5 117.5 276.5 96.5 276.5 z" stroke="#7b9628" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#9abc32"></path><path id="k10404" style="display: block; " data-model-id="k10405" d="M96.5 260.5 117.5 260.5 117.5 276.5 96.5 276.5 z" stroke="#7b9628" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="url(#k10196)"></path></g><g><path id="k10198" style="display: block; " data-model-id="k10407" d="M148.5 214.5 168.5 214.5 168.5 334.5 148.5 334.5 z" stroke="#096ca1" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#0b87c9"></path><path id="k10406" style="display: block; " data-model-id="k10407" d="M148.5 214.5 168.5 214.5 168.5 334.5 148.5 334.5 z" stroke="#096ca1" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="url(#k10196)"></path></g><g><path id="k10199" style="display: block; " data-model-id="k10411" d="M148.5 193.5 168.5 193.5 168.5 214.5 148.5 214.5 z" stroke="#7b9628" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#9abc32"></path><path id="k10410" style="display: block; " data-model-id="k10411" d="M148.5 193.5 168.5 193.5 168.5 214.5 148.5 214.5 z" stroke="#7b9628" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="url(#k10196)"></path></g><g><path id="k10200" style="display: block; " data-model-id="k10413" d="M199.5 230.5 220.5 230.5 220.5 334.5 199.5 334.5 z" stroke="#096ca1" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#0b87c9"></path><path id="k10412" style="display: block; " data-model-id="k10413" d="M199.5 230.5 220.5 230.5 220.5 334.5 199.5 334.5 z" stroke="#096ca1" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="url(#k10196)"></path></g><g><path id="k10201" style="display: block; " data-model-id="k10417" d="M199.5 215.5 220.5 215.5 220.5 230.5 199.5 230.5 z" stroke="#7b9628" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#9abc32"></path><path id="k10416" style="display: block; " data-model-id="k10417" d="M199.5 215.5 220.5 215.5 220.5 230.5 199.5 230.5 z" stroke="#7b9628" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="url(#k10196)"></path></g><g><path id="k10202" style="display: block; " data-model-id="k10419" d="M250.5 209.5 271.5 209.5 271.5 334.5 250.5 334.5 z" stroke="#096ca1" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#0b87c9"></path><path id="k10418" style="display: block; " data-model-id="k10419" d="M250.5 209.5 271.5 209.5 271.5 334.5 250.5 334.5 z" stroke="#096ca1" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="url(#k10196)"></path></g><g><path id="k10203" style="display: block; " data-model-id="k10423" d="M250.5 192.5 271.5 192.5 271.5 209.5 250.5 209.5 z" stroke="#7b9628" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#9abc32"></path><path id="k10422" style="display: block; " data-model-id="k10423" d="M250.5 192.5 271.5 192.5 271.5 209.5 250.5 209.5 z" stroke="#7b9628" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="url(#k10196)"></path></g><g><path id="k10204" style="display: block; " data-model-id="k10425" d="M302.5 330.5 322.5 330.5 322.5 334.5 302.5 334.5 z" stroke="#096ca1" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#0b87c9"></path><path id="k10424" style="display: block; " data-model-id="k10425" d="M302.5 330.5 322.5 330.5 322.5 334.5 302.5 334.5 z" stroke="#096ca1" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="url(#k10196)"></path></g><g><path id="k10205" style="display: block; " data-model-id="k10429" d="M302.5 329.5 322.5 329.5 322.5 330.5 302.5 330.5 z" stroke="#7b9628" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#9abc32"></path><path id="k10428" style="display: block; " data-model-id="k10429" d="M302.5 329.5 322.5 329.5 322.5 330.5 302.5 330.5 z" stroke="#7b9628" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="url(#k10196)"></path></g><g><path id="k10283" style="display: block; " data-model-id="k10431" d="M353.5 245.5 373.5 245.5 373.5 334.5 353.5 334.5 z" stroke="#096ca1" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#0b87c9"></path><path id="k10430" style="display: block; " data-model-id="k10431" d="M353.5 245.5 373.5 245.5 373.5 334.5 353.5 334.5 z" stroke="#096ca1" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="url(#k10196)"></path></g><g><path id="k10284" style="display: block; " data-model-id="k10435" d="M353.5 235.5 373.5 235.5 373.5 245.5 353.5 245.5 z" stroke="#7b9628" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#9abc32"></path><path id="k10434" style="display: block; " data-model-id="k10435" d="M353.5 235.5 373.5 235.5 373.5 245.5 353.5 245.5 z" stroke="#7b9628" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="url(#k10196)"></path></g><g><path id="k10285" style="display: block; " data-model-id="k10437" d="M404.5 237.5 425.5 237.5 425.5 334.5 404.5 334.5 z" stroke="#096ca1" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#0b87c9"></path><path id="k10436" style="display: block; " data-model-id="k10437" d="M404.5 237.5 425.5 237.5 425.5 334.5 404.5 334.5 z" stroke="#096ca1" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="url(#k10196)"></path></g><g><path id="k10286" style="display: block; " data-model-id="k10441" d="M404.5 223.5 425.5 223.5 425.5 237.5 404.5 237.5 z" stroke="#7b9628" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#9abc32"></path><path id="k10440" style="display: block; " data-model-id="k10441" d="M404.5 223.5 425.5 223.5 425.5 237.5 404.5 237.5 z" stroke="#7b9628" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="url(#k10196)"></path></g><g><path id="k10192" style="display: block; " data-model-id="k10443" d="M455.5 236.5 476.5 236.5 476.5 334.5 455.5 334.5 z" stroke="#096ca1" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#0b87c9"></path><path id="k10442" style="display: block; " data-model-id="k10443" d="M455.5 236.5 476.5 236.5 476.5 334.5 455.5 334.5 z" stroke="#096ca1" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="url(#k10196)"></path></g><g><path id="k10194" style="display: block; " data-model-id="k10447" d="M455.5 222.5 476.5 222.5 476.5 236.5 455.5 236.5 z" stroke="#7b9628" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#9abc32"></path><path id="k10446" style="display: block; " data-model-id="k10447" d="M455.5 222.5 476.5 222.5 476.5 236.5 455.5 236.5 z" stroke="#7b9628" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="url(#k10196)"></path></g><g><path id="k10193" style="display: block; " data-model-id="k10449" d="M507.5 112.5 527.5 112.5 527.5 334.5 507.5 334.5 z" stroke="#096ca1" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#0b87c9"></path><path id="k10448" style="display: block; " data-model-id="k10449" d="M507.5 112.5 527.5 112.5 527.5 334.5 507.5 334.5 z" stroke="#096ca1" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="url(#k10196)"></path></g><g><path id="k10190" style="display: block; " data-model-id="k10453" d="M507.5 78.5 527.5 78.5 527.5 112.5 507.5 112.5 z" stroke="#7b9628" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#9abc32"></path><path id="k10452" style="display: block; " data-model-id="k10453" d="M507.5 78.5 527.5 78.5 527.5 112.5 507.5 112.5 z" stroke="#7b9628" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="url(#k10196)"></path></g><g><path id="k10189" style="display: block; " data-model-id="k10455" d="M558.5 221.5 579.5 221.5 579.5 334.5 558.5 334.5 z" stroke="#096ca1" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#0b87c9"></path><path id="k10454" style="display: block; " data-model-id="k10455" d="M558.5 221.5 579.5 221.5 579.5 334.5 558.5 334.5 z" stroke="#096ca1" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="url(#k10196)"></path></g><g><path id="k10191" style="display: block; " data-model-id="k10459" d="M558.5 208.5 579.5 208.5 579.5 221.5 558.5 221.5 z" stroke="#7b9628" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#9abc32"></path><path id="k10458" style="display: block; " data-model-id="k10459" d="M558.5 208.5 579.5 208.5 579.5 221.5 558.5 221.5 z" stroke="#7b9628" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="url(#k10196)"></path></g></g></g><path style="display: block; " d="M81.5 46.5 81.5 334.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M77.5 334.5 81.5 334.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M77.5 286.5 81.5 286.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M77.5 238.5 81.5 238.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M77.5 190.5 81.5 190.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M77.5 142.5 81.5 142.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M77.5 94.5 81.5 94.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M77.5 46.5 81.5 46.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><text id="k10379" data-model-id="k10380" x="80" y="354" fill-opacity="1" transform="translate(-3.837,19.163) rotate(315,110.487,349.674)" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323">15/06/2023</text><text id="k10381" data-model-id="k10382" x="132" y="354" fill-opacity="1" transform="translate(-3.837,19.163) rotate(315,161.787,349.674)" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323">14/06/2023</text><text id="k10383" data-model-id="k10384" x="183" y="354" fill-opacity="1" transform="translate(-3.837,19.163) rotate(315,213.087,349.674)" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323">13/06/2023</text><text id="k10385" data-model-id="k10386" x="234" y="354" fill-opacity="1" transform="translate(-3.837,19.163) rotate(315,264.387,349.674)" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323">12/06/2023</text><text id="k10387" data-model-id="k10388" x="286" y="354" fill-opacity="1" transform="translate(-3.691,18.809) rotate(315,315.541,349.674)" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323">11/06/2023</text><text id="k10389" data-model-id="k10390" x="337" y="354" fill-opacity="1" transform="translate(-3.837,19.163) rotate(315,366.987,349.674)" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323">10/06/2023</text><text id="k10391" data-model-id="k10392" x="388" y="354" fill-opacity="1" transform="translate(-3.837,19.163) rotate(315,418.287,349.674)" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323">09/06/2023</text><text id="k10393" data-model-id="k10394" x="440" y="354" fill-opacity="1" transform="translate(-3.837,19.163) rotate(315,469.587,349.674)" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323">08/06/2023</text><text id="k10395" data-model-id="k10396" x="491" y="354" fill-opacity="1" transform="translate(-3.837,19.163) rotate(315,520.887,349.674)" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323">07/06/2023</text><text id="k10397" data-model-id="k10398" x="542" y="354" fill-opacity="1" transform="translate(-3.837,19.163) rotate(315,572.187,349.674)" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323">06/06/2023</text><text id="k10460" data-model-id="k10461" x="65" y="338" fill-opacity="1" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323">0</text><text id="k10462" data-model-id="k10463" x="5" y="290" fill-opacity="1" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323">100,000,000</text><text id="k10464" data-model-id="k10465" x="5" y="242" fill-opacity="1" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323">200,000,000</text><text id="k10466" data-model-id="k10467" x="5" y="194" fill-opacity="1" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323">300,000,000</text><text id="k10468" data-model-id="k10469" x="5" y="146" fill-opacity="1" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323">400,000,000</text><text id="k10470" data-model-id="k10471" x="5" y="98" fill-opacity="1" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323">500,000,000</text><text id="k10472" data-model-id="k10473" x="5" y="50" fill-opacity="1" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323">600,000,000</text></g><g><path style="display: block; " d="M225 10 372 10 372 34 225 34 z" stroke="" stroke-width="0" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><text id="k10474" data-model-id="k10475" x="244" y="26" fill-opacity="1" style="font: 12px Arial,Helvetica,sans-serif; cursor: pointer;" fill="#232323">Vốn </text><text id="k10476" data-model-id="k10477" x="290" y="26" fill-opacity="1" style="font: 12px Arial,Helvetica,sans-serif; cursor: pointer;" fill="#232323">Vat</text><text id="k10478" data-model-id="k10479" x="328" y="26" fill-opacity="1" style="font: 12px Arial,Helvetica,sans-serif; cursor: pointer;" fill="#232323">Lãi gộp</text><path style="display: block; cursor: pointer;" data-model-id="k10475" d="M230.5 19.5 237.5 19.5 237.5 26.5 230.5 26.5 z" stroke="#0b87c9" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#0b87c9"></path><path style="display: block; cursor: pointer;" data-model-id="k10477" d="M276.5 19.5 283.5 19.5 283.5 26.5 276.5 26.5 z" stroke="#CC6633" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#CC6633"></path><path style="display: block; cursor: pointer;" data-model-id="k10479" d="M314.5 19.5 321.5 19.5 321.5 26.5 314.5 26.5 z" stroke="#9abc32" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#9abc32"></path></g></svg><div class="k-tooltip" style="display:none; position: absolute; font: 12px Arial,Helvetica,sans-serif;border: 1px solid;opacity: 1; filter: alpha(opacity=100);"></div></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="profitByProduct" class="ng-hide">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <div class="width-100 search-box">
                                            <div class="col-xs-12 col-sm-4 no-padding-left margin-bot">
                                                <span class="width-100 " data-ng-init="initCategory()">
                                                    <div class="k-widget k-multiselect k-header width-100 multiselect" unselectable="on" style=""><div class="k-multiselect-wrap k-floatwrap" unselectable="on"><ul role="listbox" unselectable="on" class="k-reset" id="multiselect_taglist"></ul><input class="k-input k-readonly" style="width: 87px;" accesskey="" autocomplete="off" role="listbox" aria-expanded="false" tabindex="0" aria-owns="multiselect_taglist multiselect_listbox" aria-disabled="false" aria-readonly="false" aria-busy="false"><span class="k-icon k-loading k-loading-hidden"></span></div><select class="width-100 multiselect" id="multiselect" k-ng-model="categoryIds" data-role="multiselect" multiple="multiple" aria-disabled="false" aria-readonly="false" style="display: none;"><option value="3671">THÙNG CARTON</option><option value="3672">BĂNG KEO</option><option value="3706">MÀNG PE</option><option value="3707">Bong Bóng Khí</option><option value="3816">GIẤY</option><option value="7855">Phí Ship</option><option value="8084">Túi Bóng Khí</option><option value="9385">Carton Kho 2</option><option value="12098">khuông bế</option><option value="12206">thung size moi</option><option value="12858">cắt keo</option><option value="14284">Túi Giấy Xi Măng</option><option value="24507">Khung - Khuon</option><option value="25021">Giấy tấm</option><option value="25242">hộp đựng thức ăn</option><option value="25401">Túi Nilong</option><option value="29996">Tô Ly Giấy</option><option value="-1">Chưa phân loại</option></select><span style="font-family: &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; font-size: 13px; font-stretch: 100%; font-style: normal; font-weight: 400; letter-spacing: normal; text-transform: none; line-height: 17.03px; position: absolute; visibility: hidden; top: -3333px; left: -3333px;">-- Tất cả --</span></div>
                                                </span>
                                            </div>
                                            <div class="col-xs-12 col-sm-8 no-padding-right">
                                                <span class="k-widget k-datepicker k-header s1" style="width: 120px;"><span class="k-picker-wrap k-state-default"><input id="fromDate1" class="s1 k-input" style="width: 100%;" k-ng-model="fromDate1" placeholder="Từ ngày" data-role="datepicker" type="text" role="combobox" aria-expanded="false" aria-owns="fromDate1_dateview" aria-disabled="false" aria-readonly="false"><span unselectable="on" class="k-select" role="button" aria-controls="fromDate1_dateview"><span unselectable="on" class="k-icon k-i-calendar">select</span></span></span></span>
                                                <span class="hidden-320">-</span>
                                                <span class="k-widget k-datepicker k-header s1" style="width: 120px;"><span class="k-picker-wrap k-state-default"><input id="toDate1" class="s1 k-input" style="width: 100%;" k-ng-model="toDate1" placeholder="Đến ngày" data-role="datepicker" type="text" role="combobox" aria-expanded="false" aria-owns="toDate1_dateview" aria-disabled="false" aria-readonly="false"><span unselectable="on" class="k-select" role="button" aria-controls="toDate1_dateview"><span unselectable="on" class="k-icon k-i-calendar">select</span></span></span></span>
                                                <div class="btn-group">
                                                    <button type="button" class="btn  btn-primary btn-outline hidden-768 ng-binding ng-pristine ng-valid" data-ng-model="dateRange" data-ng-class="{1:'clicked'}[selected]" data-ng-click="onTypeChange(1)">Tuần</button>
                                                    <button type="button" class="btn  btn-primary btn-outline hidden-768 ng-binding ng-pristine ng-valid clicked" data-ng-model="dateRange" data-ng-class="{2:'clicked'}[selected]" data-ng-click="onTypeChange(2)">Tháng</button>
                                                    <button type="button" class="btn  btn-primary btn-outline hidden-768 ng-binding ng-pristine ng-valid" data-ng-model="dateRange" data-ng-class="{3:'clicked'}[selected]" data-ng-click="onTypeChange(3)">Quý</button>
                                                </div>

                                                <span data-ng-hide="profitChart" class="padding-left-10">
                                                    <button type="button" class="btn btn-primary" data-ng-click="profitChart = true">
                                                        <i class="icon-signal"></i>
                                                        <span class="hidden-1200 ng-binding">Xem biểu đồ</span>
                                                    </button>
                                                </span>
                                                <span data-ng-show="profitChart" class="padding-left-10 ng-hide">
                                                    <button type="button" class="btn btn-primary" data-ng-click="profitChart = false">
                                                        <i class="icon-search"></i>
                                                        <span class="hidden-1200 ng-binding">Xem danh sách</span>
                                                    </button>
                                                </span>
                                                <span class="hidden-320">
                                                    <button class="btn btn-success" data-ng-click="export()">
                                                        <i class="icon-download-alt white"></i>
                                                        <span class="hidden-1200 ng-binding">Xuất excel</span>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="width-100 summary-head" style="margin-bottom: 15px;">
                                        <div class="infobox infobox-orange">
                                            <div class="infobox-icon">
                                                <i class="icon-signal"></i>
                                            </div>
                                            <div class="infobox-data">
                                                <span class="infobox-data-number ng-binding">3,662,602,889</span>
                                                <div class="infobox-content ng-binding">
                                                    Doanh thu
                                                    <span class="badge badge-primary ng-scope" data-ng-show="totalVat <= 0 " tooltip="Doanh số đã trừ tiền giảm giá">
                                                        <i class="icon icon-info"></i>
                                                    </span>
                                                    <span class="badge badge-primary ng-scope ng-hide" data-ng-show="totalVat > 0 " tooltip="Doanh số đã trừ tiền giảm giá và VAT">
                                                        <i class="icon icon-info"></i>
                                                    </span>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="infobox infobox-green">
                                            <div class="infobox-icon">
                                                <i class="icon-dollar"></i>
                                            </div>
                                            <div class="infobox-data">
                                                <span class="infobox-data-number ng-binding">480,675,231</span>
                                                <div class="infobox-content ng-binding">
                                                    Lãi gộp <span data-ng-hide="totalGrossProfit < 0" class="badge badge-primary"><i class="icon icon-info ng-scope" tooltip="Lãi gộp là lợi nhuận từ bán hàng khi chưa trừ các chi phí khác"></i></span>
                                                    <span data-ng-show="totalGrossProfit < 0" data-role="tooltip" kendo-tooltip="" k-content="'<b>Lợi nhuận</b>=<b>Doanh thu</b>-<b>Tiền trả hàng</b>-<b>Tiền vốn</b><br />(*) <b>Lợi nhuận có thể âm</b> khi hàng hóa có giá bán thấp hơn giá vốn hoặc tiền trả hàng.'" class="badge badge-primary ng-hide"><i class="icon-info ng-scope"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="infobox infobox-orange2">
                                            <div class="infobox-icon">
                                                <i class="icon-undo "></i>
                                            </div>
                                            <div class="infobox-data">
                                                <span class="infobox-data-number ng-binding">0</span>
                                                <div class="infobox-content ng-binding">Tiền trả hàng</div>
                                            </div>
                                        </div>
                                        <div class="infobox infobox-blue">
                                            <div class="infobox-icon">
                                                <i class="icon-money"></i>
                                            </div>
                                            <div class="infobox-data">
                                                <span class="infobox-data-number ng-binding">3,181,927,658 </span>
                                                <div class="infobox-content ng-binding">
                                                    Vốn
                                                    <span data-ng-show="totalCost < 0" data-role="tooltip" kendo-tooltip="" k-content="'<b>Lợi nhuận</b>=<b>Doanh thu</b>-<b>Tiền trả hàng</b>-<b>Tiền vốn</b><br />(*) <b>Tiền vốn có thể âm</b> khi tiền trả hàng lớn hơn tiền bán hàng.'" class="badge badge-primary ng-hide"><i class="icon-info ng-scope"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="infobox infobox-orange2 hidden-1024">
                                            <div class="infobox-icon">
                                                <i class="icon-gift "></i>
                                            </div>
                                            <div class="infobox-data">
                                                <span class="infobox-data-number ng-binding">71,803,165</span>
                                                <div class="infobox-content ng-binding">Tiền giảm giá</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive" data-ng-hide="profitChart">
                                        <div class="dataTables_wrapper" role="grid" data-ng-init="initReport();getReport();">
                                            <table class="table table-striped table-bordered table-hover dataTable ng-scope ng-table" ng-table="tableParams"><!-- ngInclude: templates.header --><thead ng-include="templates.header" class="ng-scope"><tr class="ng-scope"> <!-- ngRepeat: column in $columns --> </tr> <tr ng-show="show_filter" class="ng-table-filters ng-scope ng-hide"> <!-- ngRepeat: column in $columns --> </tr></thead>
                                                <thead>
                                                    <tr role="row">
                                                        <th class="border hidden-640 ng-binding">Mã hàng hóa</th>
                                                        <th class="sorting border ng-binding" data-ng-class="{'sorting_asc': tableParams.isSortBy('itemName', 'asc'), 'sorting_desc': tableParams.isSortBy('itemName', 'desc')}" data-ng-click="tableParams.sorting({'itemName': tableParams.isSortBy('itemName', 'asc') ? 'desc' : 'asc'})">Tên hàng hóa</th>
                                                        <th class="sorting center border ng-binding" data-ng-class="{'sorting_asc': tableParams.isSortBy('sellQty', 'asc'), 'sorting_desc': tableParams.isSortBy('sellQty', 'desc')}" data-ng-click="tableParams.sorting({'sellQty': tableParams.isSortBy('sellQty', 'asc') ? 'desc' : 'asc'})">SL bán

                                                            <span tooltip="Số hàng hóa đã bán: 1,699,805" class="badge badge-primary ng-scope"><i class="icon-info smaller"></i></span>
                                                        </th>
                                                        <th class="sorting center border hidden-480 ng-binding" data-ng-class="{'sorting_asc': tableParams.isSortBy('returnQty', 'asc'), 'sorting_desc': tableParams.isSortBy('returnQty', 'desc')}" data-ng-click="tableParams.sorting({'returnQty': tableParams.isSortBy('returnQty', 'asc') ? 'desc' : 'asc'})">SL trả

                                                            <span tooltip="Số hàng hóa đã trả: 0" class="badge badge-primary ng-scope"><i class="icon-info smaller"></i></span>
                                                        </th>
                                                        <th class="sorting center border hidden-320 ng-binding" data-ng-class="{'sorting_asc': tableParams.isSortBy('discount', 'asc'), 'sorting_desc': tableParams.isSortBy('discount', 'desc')}" data-ng-click="tableParams.sorting({'discount': tableParams.isSortBy('discount', 'asc') ? 'desc' : 'asc'})">Giảm giá</th>
                                                        <th has-permission="POSIM_EarningPoint" class="sorting center border hidden-320 ng-binding" data-ng-class="{'sorting_asc': tableParams.isSortBy('exchangedMoney', 'asc'), 'sorting_desc': tableParams.isSortBy('exchangedMoney', 'desc')}" data-ng-click="tableParams.sorting({'exchangedMoney': tableParams.isSortBy('exchangedMoney', 'asc') ? 'desc' : 'asc'})">Quy đổi</th>
                                                        <th class="sorting center border ng-binding" data-ng-class="{'sorting_asc': tableParams.isSortBy('revenue', 'asc'), 'sorting_desc': tableParams.isSortBy('revenue', 'desc')}" data-ng-click="tableParams.sorting({'revenue': tableParams.isSortBy('revenue', 'asc') ? 'desc' : 'asc'})">Doanh thu</th>
                                                        <!-- ngIf: totalVat > 0 -->

                                                        <th class="sorting center hidden-480 ng-binding" data-ng-class="{'sorting_asc': tableParams.isSortBy('returnCost', 'asc'), 'sorting_desc': tableParams.isSortBy('returnCost', 'desc')}" data-ng-click="tableParams.sorting({'returnCost': tableParams.isSortBy('returnCost', 'asc') ? 'desc' : 'asc'})">Trả hàng</th>
                                                        <th class="sorting center hidden-480 ng-binding" data-ng-class="{'sorting_asc': tableParams.isSortBy('cost', 'asc'), 'sorting_desc': tableParams.isSortBy('cost', 'desc')}" data-ng-click="tableParams.sorting({'cost': tableParams.isSortBy('cost', 'asc') ? 'desc' : 'asc'})">Vốn </th>
                                                        <th class="sorting center border white-bg ng-binding sorting_desc" data-ng-class="{'sorting_asc': tableParams.isSortBy('gp', 'asc'), 'sorting_desc': tableParams.isSortBy('gp', 'desc')}" data-ng-click="tableParams.sorting({'gp': tableParams.isSortBy('gp', 'asc') ? 'desc' : 'asc'})">Lãi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- ngRepeat: r in params.data --><tr data-ng-repeat="r in params.data" class="ng-scope">
                                                        <td class="hidden-640 ng-binding" data-title="'Mã hàng'">SP000034                        </td>
                                                        <td data-title="'Tên hàng hóa'" sortable="'itemName'" class="ng-binding"><span class="show-640 ng-binding">SP000034                        -</span>Bong Bóng Khí cuộn 1m4x100m</td>
                                                        <td data-title="'SL bán'" class="text-center sorting ng-binding" sortable="'sellQty'">3,752</td>
                                                        <td data-title="'SL trả'" class="text-center sorting hidden-480 black ng-binding" sortable="'returnQty'" ng-class="{'red': r.returnQty!=0}">0</td>
                                                        <td data-title="'Giảm giá'" class="text-right sorting hidden-320" sortable="'discount'"><i class="ng-binding">2,948,760</i></td>
                                                        <td has-permission="POSIM_EarningPoint" data-title="'Quy đổi'" class="text-right sorting hidden-320" sortable="'discount'"><i class="ng-binding">0</i></td>
                                                        <td data-title="'Doanh thu'" class="text-right sorting ng-binding" sortable="'earning'">978,291,240</td>
                                                        <!-- ngIf: totalVat > 0 -->

                                                        <td data-title="'Tiền trả hàng'" class="text-right sorting hidden-480 ng-binding" sortable="'returnCost'">0</td>
                                                        <td data-title="'Tiền vốn'" class="text-right sorting hidden-480 ng-binding" sortable="'cost'">919,240,000</td>
                                                        <td data-title="'Lợi nhuận'" class="text-right sorting hl ng-binding" sortable="'gp'">59,051,240</td>
                                                    </tr><!-- end ngRepeat: r in params.data --><tr data-ng-repeat="r in params.data" class="ng-scope">
                                                        <td class="hidden-640 ng-binding" data-title="'Mã hàng'">SP000062                        </td>
                                                        <td data-title="'Tên hàng hóa'" sortable="'itemName'" class="ng-binding"><span class="show-640 ng-binding">SP000062                        -</span>Ship</td>
                                                        <td data-title="'SL bán'" class="text-center sorting ng-binding" sortable="'sellQty'">336</td>
                                                        <td data-title="'SL trả'" class="text-center sorting hidden-480 black ng-binding" sortable="'returnQty'" ng-class="{'red': r.returnQty!=0}">0</td>
                                                        <td data-title="'Giảm giá'" class="text-right sorting hidden-320" sortable="'discount'"><i class="ng-binding">246,509</i></td>
                                                        <td has-permission="POSIM_EarningPoint" data-title="'Quy đổi'" class="text-right sorting hidden-320" sortable="'discount'"><i class="ng-binding">0</i></td>
                                                        <td data-title="'Doanh thu'" class="text-right sorting ng-binding" sortable="'earning'">21,904,491</td>
                                                        <!-- ngIf: totalVat > 0 -->

                                                        <td data-title="'Tiền trả hàng'" class="text-right sorting hidden-480 ng-binding" sortable="'returnCost'">0</td>
                                                        <td data-title="'Tiền vốn'" class="text-right sorting hidden-480 ng-binding" sortable="'cost'">0</td>
                                                        <td data-title="'Lợi nhuận'" class="text-right sorting hl ng-binding" sortable="'gp'">21,904,491</td>
                                                    </tr><!-- end ngRepeat: r in params.data --><tr data-ng-repeat="r in params.data" class="ng-scope">
                                                        <td class="hidden-640 ng-binding" data-title="'Mã hàng'">SP000290                        </td>
                                                        <td data-title="'Tên hàng hóa'" sortable="'itemName'" class="ng-binding"><span class="show-640 ng-binding">SP000290                        -</span>Thùng 20x15x10CM</td>
                                                        <td data-title="'SL bán'" class="text-center sorting ng-binding" sortable="'sellQty'">112,441</td>
                                                        <td data-title="'SL trả'" class="text-center sorting hidden-480 black ng-binding" sortable="'returnQty'" ng-class="{'red': r.returnQty!=0}">0</td>
                                                        <td data-title="'Giảm giá'" class="text-right sorting hidden-320" sortable="'discount'"><i class="ng-binding">5,115,731</i></td>
                                                        <td has-permission="POSIM_EarningPoint" data-title="'Quy đổi'" class="text-right sorting hidden-320" sortable="'discount'"><i class="ng-binding">0</i></td>
                                                        <td data-title="'Doanh thu'" class="text-right sorting ng-binding" sortable="'earning'">158,885,249</td>
                                                        <!-- ngIf: totalVat > 0 -->

                                                        <td data-title="'Tiền trả hàng'" class="text-right sorting hidden-480 ng-binding" sortable="'returnCost'">0</td>
                                                        <td data-title="'Tiền vốn'" class="text-right sorting hidden-480 ng-binding" sortable="'cost'">139,799,940</td>
                                                        <td data-title="'Lợi nhuận'" class="text-right sorting hl ng-binding" sortable="'gp'">19,085,309</td>
                                                    </tr><!-- end ngRepeat: r in params.data --><tr data-ng-repeat="r in params.data" class="ng-scope">
                                                        <td class="hidden-640 ng-binding" data-title="'Mã hàng'">SP000289                        </td>
                                                        <td data-title="'Tên hàng hóa'" sortable="'itemName'" class="ng-binding"><span class="show-640 ng-binding">SP000289                        -</span>Thùng 20x10x10CM</td>
                                                        <td data-title="'SL bán'" class="text-center sorting ng-binding" sortable="'sellQty'">112,732</td>
                                                        <td data-title="'SL trả'" class="text-center sorting hidden-480 black ng-binding" sortable="'returnQty'" ng-class="{'red': r.returnQty!=0}">0</td>
                                                        <td data-title="'Giảm giá'" class="text-right sorting hidden-320" sortable="'discount'"><i class="ng-binding">4,317,689</i></td>
                                                        <td has-permission="POSIM_EarningPoint" data-title="'Quy đổi'" class="text-right sorting hidden-320" sortable="'discount'"><i class="ng-binding">0</i></td>
                                                        <td data-title="'Doanh thu'" class="text-right sorting ng-binding" sortable="'earning'">116,404,287</td>
                                                        <!-- ngIf: totalVat > 0 -->

                                                        <td data-title="'Tiền trả hàng'" class="text-right sorting hidden-480 ng-binding" sortable="'returnCost'">0</td>
                                                        <td data-title="'Tiền vốn'" class="text-right sorting hidden-480 ng-binding" sortable="'cost'">98,703,268</td>
                                                        <td data-title="'Lợi nhuận'" class="text-right sorting hl ng-binding" sortable="'gp'">17,701,019</td>
                                                    </tr><!-- end ngRepeat: r in params.data --><tr data-ng-repeat="r in params.data" class="ng-scope">
                                                        <td class="hidden-640 ng-binding" data-title="'Mã hàng'">SP000302                        </td>
                                                        <td data-title="'Tên hàng hóa'" sortable="'itemName'" class="ng-binding"><span class="show-640 ng-binding">SP000302                        -</span>Thùng 15x10x5CM</td>
                                                        <td data-title="'SL bán'" class="text-center sorting ng-binding" sortable="'sellQty'">142,452</td>
                                                        <td data-title="'SL trả'" class="text-center sorting hidden-480 black ng-binding" sortable="'returnQty'" ng-class="{'red': r.returnQty!=0}">0</td>
                                                        <td data-title="'Giảm giá'" class="text-right sorting hidden-320" sortable="'discount'"><i class="ng-binding">1,014,126</i></td>
                                                        <td has-permission="POSIM_EarningPoint" data-title="'Quy đổi'" class="text-right sorting hidden-320" sortable="'discount'"><i class="ng-binding">0</i></td>
                                                        <td data-title="'Doanh thu'" class="text-right sorting ng-binding" sortable="'earning'">93,082,874</td>
                                                        <!-- ngIf: totalVat > 0 -->

                                                        <td data-title="'Tiền trả hàng'" class="text-right sorting hidden-480 ng-binding" sortable="'returnCost'">0</td>
                                                        <td data-title="'Tiền vốn'" class="text-right sorting hidden-480 ng-binding" sortable="'cost'">77,636,340</td>
                                                        <td data-title="'Lợi nhuận'" class="text-right sorting hl ng-binding" sortable="'gp'">15,446,534</td>
                                                    </tr><!-- end ngRepeat: r in params.data --><tr data-ng-repeat="r in params.data" class="ng-scope">
                                                        <td class="hidden-640 ng-binding" data-title="'Mã hàng'">SP001051                        </td>
                                                        <td data-title="'Tên hàng hóa'" sortable="'itemName'" class="ng-binding"><span class="show-640 ng-binding">SP001051                        -</span>Thùng 16.5x10.5x10.5 CM</td>
                                                        <td data-title="'SL bán'" class="text-center sorting ng-binding" sortable="'sellQty'">110,450</td>
                                                        <td data-title="'SL trả'" class="text-center sorting hidden-480 black ng-binding" sortable="'returnQty'" ng-class="{'red': r.returnQty!=0}">0</td>
                                                        <td data-title="'Giảm giá'" class="text-right sorting hidden-320" sortable="'discount'"><i class="ng-binding">0</i></td>
                                                        <td has-permission="POSIM_EarningPoint" data-title="'Quy đổi'" class="text-right sorting hidden-320" sortable="'discount'"><i class="ng-binding">0</i></td>
                                                        <td data-title="'Doanh thu'" class="text-right sorting ng-binding" sortable="'earning'">103,585,500</td>
                                                        <!-- ngIf: totalVat > 0 -->

                                                        <td data-title="'Tiền trả hàng'" class="text-right sorting hidden-480 ng-binding" sortable="'returnCost'">0</td>
                                                        <td data-title="'Tiền vốn'" class="text-right sorting hidden-480 ng-binding" sortable="'cost'">88,139,100</td>
                                                        <td data-title="'Lợi nhuận'" class="text-right sorting hl ng-binding" sortable="'gp'">15,446,400</td>
                                                    </tr><!-- end ngRepeat: r in params.data --><tr data-ng-repeat="r in params.data" class="ng-scope">
                                                        <td class="hidden-640 ng-binding" data-title="'Mã hàng'">SP000310                        </td>
                                                        <td data-title="'Tên hàng hóa'" sortable="'itemName'" class="ng-binding"><span class="show-640 ng-binding">SP000310                        -</span>Thùng 15x12x10CM</td>
                                                        <td data-title="'SL bán'" class="text-center sorting ng-binding" sortable="'sellQty'">89,770</td>
                                                        <td data-title="'SL trả'" class="text-center sorting hidden-480 black ng-binding" sortable="'returnQty'" ng-class="{'red': r.returnQty!=0}">0</td>
                                                        <td data-title="'Giảm giá'" class="text-right sorting hidden-320" sortable="'discount'"><i class="ng-binding">2,921,298</i></td>
                                                        <td has-permission="POSIM_EarningPoint" data-title="'Quy đổi'" class="text-right sorting hidden-320" sortable="'discount'"><i class="ng-binding">0</i></td>
                                                        <td data-title="'Doanh thu'" class="text-right sorting ng-binding" sortable="'earning'">92,830,752</td>
                                                        <!-- ngIf: totalVat > 0 -->

                                                        <td data-title="'Tiền trả hàng'" class="text-right sorting hidden-480 ng-binding" sortable="'returnCost'">0</td>
                                                        <td data-title="'Tiền vốn'" class="text-right sorting hidden-480 ng-binding" sortable="'cost'">77,840,050</td>
                                                        <td data-title="'Lợi nhuận'" class="text-right sorting hl ng-binding" sortable="'gp'">14,990,702</td>
                                                    </tr><!-- end ngRepeat: r in params.data --><tr data-ng-repeat="r in params.data" class="ng-scope">
                                                        <td class="hidden-640 ng-binding" data-title="'Mã hàng'">SP000224                        </td>
                                                        <td data-title="'Tên hàng hóa'" sortable="'itemName'" class="ng-binding"><span class="show-640 ng-binding">SP000224                        -</span>VAT</td>
                                                        <td data-title="'SL bán'" class="text-center sorting ng-binding" sortable="'sellQty'">35</td>
                                                        <td data-title="'SL trả'" class="text-center sorting hidden-480 black ng-binding" sortable="'returnQty'" ng-class="{'red': r.returnQty!=0}">0</td>
                                                        <td data-title="'Giảm giá'" class="text-right sorting hidden-320" sortable="'discount'"><i class="ng-binding">94,290</i></td>
                                                        <td has-permission="POSIM_EarningPoint" data-title="'Quy đổi'" class="text-right sorting hidden-320" sortable="'discount'"><i class="ng-binding">0</i></td>
                                                        <td data-title="'Doanh thu'" class="text-right sorting ng-binding" sortable="'earning'">12,627,415</td>
                                                        <!-- ngIf: totalVat > 0 -->

                                                        <td data-title="'Tiền trả hàng'" class="text-right sorting hidden-480 ng-binding" sortable="'returnCost'">0</td>
                                                        <td data-title="'Tiền vốn'" class="text-right sorting hidden-480 ng-binding" sortable="'cost'">0</td>
                                                        <td data-title="'Lợi nhuận'" class="text-right sorting hl ng-binding" sortable="'gp'">12,627,415</td>
                                                    </tr><!-- end ngRepeat: r in params.data --><tr data-ng-repeat="r in params.data" class="ng-scope">
                                                        <td class="hidden-640 ng-binding" data-title="'Mã hàng'">SP000294                        </td>
                                                        <td data-title="'Tên hàng hóa'" sortable="'itemName'" class="ng-binding"><span class="show-640 ng-binding">SP000294                        -</span>Thùng 18x10x8CM</td>
                                                        <td data-title="'SL bán'" class="text-center sorting ng-binding" sortable="'sellQty'">88,910</td>
                                                        <td data-title="'SL trả'" class="text-center sorting hidden-480 black ng-binding" sortable="'returnQty'" ng-class="{'red': r.returnQty!=0}">0</td>
                                                        <td data-title="'Giảm giá'" class="text-right sorting hidden-320" sortable="'discount'"><i class="ng-binding">3,675,926</i></td>
                                                        <td has-permission="POSIM_EarningPoint" data-title="'Quy đổi'" class="text-right sorting hidden-320" sortable="'discount'"><i class="ng-binding">0</i></td>
                                                        <td data-title="'Doanh thu'" class="text-right sorting ng-binding" sortable="'earning'">78,783,924</td>
                                                        <!-- ngIf: totalVat > 0 -->

                                                        <td data-title="'Tiền trả hàng'" class="text-right sorting hidden-480 ng-binding" sortable="'returnCost'">0</td>
                                                        <td data-title="'Tiền vốn'" class="text-right sorting hidden-480 ng-binding" sortable="'cost'">66,336,950</td>
                                                        <td data-title="'Lợi nhuận'" class="text-right sorting hl ng-binding" sortable="'gp'">12,446,974</td>
                                                    </tr><!-- end ngRepeat: r in params.data --><tr data-ng-repeat="r in params.data" class="ng-scope">
                                                        <td class="hidden-640 ng-binding" data-title="'Mã hàng'">SP000315                        </td>
                                                        <td data-title="'Tên hàng hóa'" sortable="'itemName'" class="ng-binding"><span class="show-640 ng-binding">SP000315                        -</span>Thùng 25x15x10CM</td>
                                                        <td data-title="'SL bán'" class="text-center sorting ng-binding" sortable="'sellQty'">50,997</td>
                                                        <td data-title="'SL trả'" class="text-center sorting hidden-480 black ng-binding" sortable="'returnQty'" ng-class="{'red': r.returnQty!=0}">0</td>
                                                        <td data-title="'Giảm giá'" class="text-right sorting hidden-320" sortable="'discount'"><i class="ng-binding">2,968,871</i></td>
                                                        <td has-permission="POSIM_EarningPoint" data-title="'Quy đổi'" class="text-right sorting hidden-320" sortable="'discount'"><i class="ng-binding">0</i></td>
                                                        <td data-title="'Doanh thu'" class="text-right sorting ng-binding" sortable="'earning'">82,294,649</td>
                                                        <!-- ngIf: totalVat > 0 -->

                                                        <td data-title="'Tiền trả hàng'" class="text-right sorting hidden-480 ng-binding" sortable="'returnCost'">0</td>
                                                        <td data-title="'Tiền vốn'" class="text-right sorting hidden-480 ng-binding" sortable="'cost'">71,995,770</td>
                                                        <td data-title="'Lợi nhuận'" class="text-right sorting hl ng-binding" sortable="'gp'">10,298,879</td>
                                                    </tr><!-- end ngRepeat: r in params.data -->
                                                </tbody>
                                            </table><div ng-table-pagination="params" template-url="templates.pagination" class="row ng-scope ng-isolate-scope"><!-- ngInclude: templateUrl --><div ng-include="templateUrl" class="col-sm-12 pull-right ng-scope"><div class="dataTables_paginate paging_bootstrap ng-scope"><!-- ngIf: params.data.length == 0 --><!-- ngIf: params.settings().total > 10 --><div ng-if="params.settings().total > 10" class="pull-right ng-scope"><select class="height-32px ng-pristine ng-valid" ng-init="params.settings().count" ng-model="params.settings().count" ng-options="c for c in params.settings().counts" ng-change="params.count(params.settings().count)"><option value="0" selected="selected">10</option><option value="1">25</option><option value="2">50</option><option value="3">100</option></select></div><!-- end ngIf: params.settings().total > 10 --><ul class="pagination"> <!-- ngIf: lastpage > 5 --><li ng-class="{ disabled : params.page() === 1 }" ng-if="lastpage > 5" title="Về đầu trang" class="hidden-768 ng-scope disabled">  <a ng-click="params.page(1)"><i class="icon-double-angle-left smaller-90"></i></a> </li><!-- end ngIf: lastpage > 5 --> <!-- ngRepeat: page in pages --><li ng-class="{'disabled': !page.active, 'active': params.page()===page.number &amp;&amp; (page.type !=='prev' &amp;&amp; page.type !=='next')}" ng-repeat="page in pages" ng-switch="page.type" class="ng-scope disabled"> <!-- ngSwitchWhen: prev --><a ng-switch-when="prev" ng-click="params.page(page.number)" class="ng-scope"><i class="icon-angle-left"></i></a><!-- ngSwitchWhen: first --><!-- ngSwitchWhen: page --><!-- ngSwitchWhen: more --><!-- ngSwitchWhen: last --><!-- ngSwitchWhen: next --></li><!-- end ngRepeat: page in pages --><li ng-class="{'disabled': !page.active, 'active': params.page()===page.number &amp;&amp; (page.type !=='prev' &amp;&amp; page.type !=='next')}" ng-repeat="page in pages" ng-switch="page.type" class="ng-scope disabled active"> <!-- ngSwitchWhen: prev --><!-- ngSwitchWhen: first --><a ng-switch-when="first" ng-click="params.page(page.number)" class="ng-binding ng-scope">1</a><!-- ngSwitchWhen: page --><!-- ngSwitchWhen: more --><!-- ngSwitchWhen: last --><!-- ngSwitchWhen: next --></li><!-- end ngRepeat: page in pages --><li ng-class="{'disabled': !page.active, 'active': params.page()===page.number &amp;&amp; (page.type !=='prev' &amp;&amp; page.type !=='next')}" ng-repeat="page in pages" ng-switch="page.type" class="ng-scope"> <!-- ngSwitchWhen: prev --><!-- ngSwitchWhen: first --><!-- ngSwitchWhen: page --><a ng-switch-when="page" ng-click="params.page(page.number)" class="ng-binding ng-scope">2</a><!-- ngSwitchWhen: more --><!-- ngSwitchWhen: last --><!-- ngSwitchWhen: next --></li><!-- end ngRepeat: page in pages --><li ng-class="{'disabled': !page.active, 'active': params.page()===page.number &amp;&amp; (page.type !=='prev' &amp;&amp; page.type !=='next')}" ng-repeat="page in pages" ng-switch="page.type" class="ng-scope"> <!-- ngSwitchWhen: prev --><!-- ngSwitchWhen: first --><!-- ngSwitchWhen: page --><a ng-switch-when="page" ng-click="params.page(page.number)" class="ng-binding ng-scope">3</a><!-- ngSwitchWhen: more --><!-- ngSwitchWhen: last --><!-- ngSwitchWhen: next --></li><!-- end ngRepeat: page in pages --><li ng-class="{'disabled': !page.active, 'active': params.page()===page.number &amp;&amp; (page.type !=='prev' &amp;&amp; page.type !=='next')}" ng-repeat="page in pages" ng-switch="page.type" class="ng-scope"> <!-- ngSwitchWhen: prev --><!-- ngSwitchWhen: first --><!-- ngSwitchWhen: page --><a ng-switch-when="page" ng-click="params.page(page.number)" class="ng-binding ng-scope">4</a><!-- ngSwitchWhen: more --><!-- ngSwitchWhen: last --><!-- ngSwitchWhen: next --></li><!-- end ngRepeat: page in pages --><li ng-class="{'disabled': !page.active, 'active': params.page()===page.number &amp;&amp; (page.type !=='prev' &amp;&amp; page.type !=='next')}" ng-repeat="page in pages" ng-switch="page.type" class="ng-scope"> <!-- ngSwitchWhen: prev --><!-- ngSwitchWhen: first --><!-- ngSwitchWhen: page --><a ng-switch-when="page" ng-click="params.page(page.number)" class="ng-binding ng-scope">5</a><!-- ngSwitchWhen: more --><!-- ngSwitchWhen: last --><!-- ngSwitchWhen: next --></li><!-- end ngRepeat: page in pages --><li ng-class="{'disabled': !page.active, 'active': params.page()===page.number &amp;&amp; (page.type !=='prev' &amp;&amp; page.type !=='next')}" ng-repeat="page in pages" ng-switch="page.type" class="ng-scope"> <!-- ngSwitchWhen: prev --><!-- ngSwitchWhen: first --><!-- ngSwitchWhen: page --><a ng-switch-when="page" ng-click="params.page(page.number)" class="ng-binding ng-scope">6</a><!-- ngSwitchWhen: more --><!-- ngSwitchWhen: last --><!-- ngSwitchWhen: next --></li><!-- end ngRepeat: page in pages --><li ng-class="{'disabled': !page.active, 'active': params.page()===page.number &amp;&amp; (page.type !=='prev' &amp;&amp; page.type !=='next')}" ng-repeat="page in pages" ng-switch="page.type" class="ng-scope"> <!-- ngSwitchWhen: prev --><!-- ngSwitchWhen: first --><!-- ngSwitchWhen: page --><a ng-switch-when="page" ng-click="params.page(page.number)" class="ng-binding ng-scope">7</a><!-- ngSwitchWhen: more --><!-- ngSwitchWhen: last --><!-- ngSwitchWhen: next --></li><!-- end ngRepeat: page in pages --><li ng-class="{'disabled': !page.active, 'active': params.page()===page.number &amp;&amp; (page.type !=='prev' &amp;&amp; page.type !=='next')}" ng-repeat="page in pages" ng-switch="page.type" class="ng-scope disabled"> <!-- ngSwitchWhen: prev --><!-- ngSwitchWhen: first --><!-- ngSwitchWhen: page --><!-- ngSwitchWhen: more --><a ng-switch-when="more" ng-click="params.page(page.number)" class="ng-scope">…</a><!-- ngSwitchWhen: last --><!-- ngSwitchWhen: next --></li><!-- end ngRepeat: page in pages --><li ng-class="{'disabled': !page.active, 'active': params.page()===page.number &amp;&amp; (page.type !=='prev' &amp;&amp; page.type !=='next')}" ng-repeat="page in pages" ng-switch="page.type" class="ng-scope"> <!-- ngSwitchWhen: prev --><!-- ngSwitchWhen: first --><!-- ngSwitchWhen: page --><!-- ngSwitchWhen: more --><!-- ngSwitchWhen: last --><a ng-switch-when="last" ng-click="params.page(page.number)" class="ng-binding ng-scope">17</a><!-- ngSwitchWhen: next --></li><!-- end ngRepeat: page in pages --><li ng-class="{'disabled': !page.active, 'active': params.page()===page.number &amp;&amp; (page.type !=='prev' &amp;&amp; page.type !=='next')}" ng-repeat="page in pages" ng-switch="page.type" class="ng-scope"> <!-- ngSwitchWhen: prev --><!-- ngSwitchWhen: first --><!-- ngSwitchWhen: page --><!-- ngSwitchWhen: more --><!-- ngSwitchWhen: last --><!-- ngSwitchWhen: next --><a ng-switch-when="next" ng-click="params.page(page.number)" class="ng-scope"><i class="icon-angle-right"></i></a></li><!-- end ngRepeat: page in pages --> <!-- ngIf: lastpage > 5 --><li ng-class="{ disabled : params.page() === lastpage }" ng-if="lastpage > 5" title="Về cuối trang" class="hidden-768 ng-scope"> <a ng-click="params.page(lastpage)"><i class="icon-double-angle-right smaller-90"></i></a> </li><!-- end ngIf: lastpage > 5 --> <li class="disabled hidden-768"> <a ng-show="lastpage > 2" class="">Trang </a><input type="text" style="width:42px; height:32px !important; float:left; border-radius:0px !important;margin:0" ng-show="lastpage > 2" ng-model="curPage" ng-change="changePage(curPage)" class="ng-pristine ng-valid"><a ng-show="lastpage > 2" class="ng-binding"> / 17</a></li></ul></div></div></div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 no-padding ng-hide" data-ng-show="profitChart" id="profitChartContainer" style="">
                                        <div id="chartProfit" style="min-width: 240px; min-height: 480px; max-width: 960px; max-height: 480px; position: relative;" data-role="chart" class="k-chart"><!--?xml version='1.0' ?--><svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="600px" height="400px" style="position: relative; display: block;"><defs id="k10242"><clipPath id="k10299"><path style="display: block; " d="M187 39 562.827 39 562.827 321.653 187 321.653 z" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path></clipPath><linearGradient id="k10302" gradientTransform="rotate(90)"> <stop offset="0%" style="stop-color:#fff;stop-opacity:0"></stop><stop offset="25%" style="stop-color:#fff;stop-opacity:0.3"></stop><stop offset="100%" style="stop-color:#fff;stop-opacity:0"></stop></linearGradient></defs><path style="display: block; " d="M0 0 600 0 600 400 0 400 z" stroke="" stroke-width="0" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#fff"></path><path style="display: block; " d="M187.5 39.5 563.5 39.5 563.5 322.5 187.5 322.5 z" stroke-width="0.1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path id="k10241" style="display: block; " data-model-id="k10240" d="M187 39 562.827 39 562.827 321.653 187 321.653 z" stroke="" stroke-linecap="square" stroke-linejoin="round" fill-opacity="0" stroke-opacity="1" fill="#fff"></path><g id="k10239"><path style="display: block; " data-model-id="k10240" d="M250.5 39.5 250.5 322.5" stroke="#dfdfdf" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " data-model-id="k10240" d="M312.5 39.5 312.5 322.5" stroke="#dfdfdf" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " data-model-id="k10240" d="M375.5 39.5 375.5 322.5" stroke="#dfdfdf" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " data-model-id="k10240" d="M438.5 39.5 438.5 322.5" stroke="#dfdfdf" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " data-model-id="k10240" d="M500.5 39.5 500.5 322.5" stroke="#dfdfdf" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " data-model-id="k10240" d="M563.5 39.5 563.5 322.5" stroke="#dfdfdf" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M187.5 39.5 187.5 322.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M183.5 39.5 187.5 39.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M183.5 67.5 187.5 67.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M183.5 96.5 187.5 96.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M183.5 124.5 187.5 124.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M183.5 152.5 187.5 152.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M183.5 180.5 187.5 180.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M183.5 209.5 187.5 209.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M183.5 237.5 187.5 237.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M183.5 265.5 187.5 265.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M183.5 293.5 187.5 293.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M183.5 322.5 187.5 322.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><g id="k10300" clip-path="url(#k10299)"><g id="k10498"><g><path id="k10301" style="display: block; " data-model-id="k10500" d="M187.5 47.5 475.5 47.5 475.5 59.5 187.5 59.5 z" stroke="#096ca1" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#0b87c9"></path><path id="k10499" style="display: block; " data-model-id="k10500" d="M187.5 47.5 475.5 47.5 475.5 59.5 187.5 59.5 z" stroke="#096ca1" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="url(#k10302)"></path></g><g><path id="k10226" style="display: block; " data-model-id="k10504" d="M475.5 47.5 493.5 47.5 493.5 59.5 475.5 59.5 z" stroke="#7b9628" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#9abc32"></path><path id="k10503" style="display: block; " data-model-id="k10504" d="M475.5 47.5 493.5 47.5 493.5 59.5 475.5 59.5 z" stroke="#7b9628" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="url(#k10302)"></path></g><g><path id="k10227" style="display: block; " data-model-id="k10510" d="M187.5 76.5 194.5 76.5 194.5 87.5 187.5 87.5 z" stroke="#7b9628" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#9abc32"></path><path id="k10509" style="display: block; " data-model-id="k10510" d="M187.5 76.5 194.5 76.5 194.5 87.5 187.5 87.5 z" stroke="#7b9628" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="url(#k10302)"></path></g><g><path id="k10228" style="display: block; " data-model-id="k10512" d="M187.5 104.5 231.5 104.5 231.5 115.5 187.5 115.5 z" stroke="#096ca1" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#0b87c9"></path><path id="k10511" style="display: block; " data-model-id="k10512" d="M187.5 104.5 231.5 104.5 231.5 115.5 187.5 115.5 z" stroke="#096ca1" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="url(#k10302)"></path></g><g><path id="k10229" style="display: block; " data-model-id="k10516" d="M231.5 104.5 237.5 104.5 237.5 115.5 231.5 115.5 z" stroke="#7b9628" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#9abc32"></path><path id="k10515" style="display: block; " data-model-id="k10516" d="M231.5 104.5 237.5 104.5 237.5 115.5 231.5 115.5 z" stroke="#7b9628" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="url(#k10302)"></path></g><g><path id="k10230" style="display: block; " data-model-id="k10518" d="M187.5 132.5 218.5 132.5 218.5 144.5 187.5 144.5 z" stroke="#096ca1" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#0b87c9"></path><path id="k10517" style="display: block; " data-model-id="k10518" d="M187.5 132.5 218.5 132.5 218.5 144.5 187.5 144.5 z" stroke="#096ca1" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="url(#k10302)"></path></g><g><path id="k10231" style="display: block; " data-model-id="k10522" d="M218.5 132.5 223.5 132.5 223.5 144.5 218.5 144.5 z" stroke="#7b9628" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#9abc32"></path><path id="k10521" style="display: block; " data-model-id="k10522" d="M218.5 132.5 223.5 132.5 223.5 144.5 218.5 144.5 z" stroke="#7b9628" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="url(#k10302)"></path></g><g><path id="k10232" style="display: block; " data-model-id="k10524" d="M187.5 161.5 211.5 161.5 211.5 172.5 187.5 172.5 z" stroke="#096ca1" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#0b87c9"></path><path id="k10523" style="display: block; " data-model-id="k10524" d="M187.5 161.5 211.5 161.5 211.5 172.5 187.5 172.5 z" stroke="#096ca1" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="url(#k10302)"></path></g><g><path id="k10233" style="display: block; " data-model-id="k10528" d="M211.5 161.5 216.5 161.5 216.5 172.5 211.5 172.5 z" stroke="#7b9628" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#9abc32"></path><path id="k10527" style="display: block; " data-model-id="k10528" d="M211.5 161.5 216.5 161.5 216.5 172.5 211.5 172.5 z" stroke="#7b9628" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="url(#k10302)"></path></g><g><path id="k10234" style="display: block; " data-model-id="k10530" d="M187.5 189.5 215.5 189.5 215.5 200.5 187.5 200.5 z" stroke="#096ca1" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#0b87c9"></path><path id="k10529" style="display: block; " data-model-id="k10530" d="M187.5 189.5 215.5 189.5 215.5 200.5 187.5 200.5 z" stroke="#096ca1" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="url(#k10302)"></path></g><g><path id="k10235" style="display: block; " data-model-id="k10534" d="M215.5 189.5 219.5 189.5 219.5 200.5 215.5 200.5 z" stroke="#7b9628" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#9abc32"></path><path id="k10533" style="display: block; " data-model-id="k10534" d="M215.5 189.5 219.5 189.5 219.5 200.5 215.5 200.5 z" stroke="#7b9628" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="url(#k10302)"></path></g><g><path id="k10236" style="display: block; " data-model-id="k10536" d="M187.5 217.5 211.5 217.5 211.5 228.5 187.5 228.5 z" stroke="#096ca1" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#0b87c9"></path><path id="k10535" style="display: block; " data-model-id="k10536" d="M187.5 217.5 211.5 217.5 211.5 228.5 187.5 228.5 z" stroke="#096ca1" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="url(#k10302)"></path></g><g><path id="k10296" style="display: block; " data-model-id="k10540" d="M211.5 217.5 216.5 217.5 216.5 228.5 211.5 228.5 z" stroke="#7b9628" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#9abc32"></path><path id="k10539" style="display: block; " data-model-id="k10540" d="M211.5 217.5 216.5 217.5 216.5 228.5 211.5 228.5 z" stroke="#7b9628" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="url(#k10302)"></path></g><g><path id="k10298" style="display: block; " data-model-id="k10546" d="M187.5 245.5 191.5 245.5 191.5 257.5 187.5 257.5 z" stroke="#7b9628" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#9abc32"></path><path id="k10545" style="display: block; " data-model-id="k10546" d="M187.5 245.5 191.5 245.5 191.5 257.5 187.5 257.5 z" stroke="#7b9628" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="url(#k10302)"></path></g><g><path id="k10297" style="display: block; " data-model-id="k10548" d="M187.5 274.5 208.5 274.5 208.5 285.5 187.5 285.5 z" stroke="#096ca1" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#0b87c9"></path><path id="k10547" style="display: block; " data-model-id="k10548" d="M187.5 274.5 208.5 274.5 208.5 285.5 187.5 285.5 z" stroke="#096ca1" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="url(#k10302)"></path></g><g><path id="k10294" style="display: block; " data-model-id="k10552" d="M208.5 274.5 212.5 274.5 212.5 285.5 208.5 285.5 z" stroke="#7b9628" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#9abc32"></path><path id="k10551" style="display: block; " data-model-id="k10552" d="M208.5 274.5 212.5 274.5 212.5 285.5 208.5 285.5 z" stroke="#7b9628" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="url(#k10302)"></path></g><g><path id="k10293" style="display: block; " data-model-id="k10554" d="M187.5 302.5 210.5 302.5 210.5 313.5 187.5 313.5 z" stroke="#096ca1" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#0b87c9"></path><path id="k10553" style="display: block; " data-model-id="k10554" d="M187.5 302.5 210.5 302.5 210.5 313.5 187.5 313.5 z" stroke="#096ca1" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="url(#k10302)"></path></g><g><path id="k10295" style="display: block; " data-model-id="k10558" d="M210.5 302.5 213.5 302.5 213.5 313.5 210.5 313.5 z" stroke="#7b9628" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#9abc32"></path><path id="k10557" style="display: block; " data-model-id="k10558" d="M210.5 302.5 213.5 302.5 213.5 313.5 210.5 313.5 z" stroke="#7b9628" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="url(#k10302)"></path></g></g></g><path style="display: block; " d="M187.5 322.5 563.5 322.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M187.5 322.5 187.5 326.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M250.5 322.5 250.5 326.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M312.5 322.5 312.5 326.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M375.5 322.5 375.5 326.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M438.5 322.5 438.5 326.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M500.5 322.5 500.5 326.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M563.5 322.5 563.5 326.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><text id="k10238" data-model-id="k10237" x="5" y="57" fill-opacity="1" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323"><title> Bong Bóng Khí cuộn 1m4x100m </title> Bong Bóng Khí cuộn 1m4x100m</text><text id="k10480" data-model-id="k10481" x="154" y="85" fill-opacity="1" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323"><title> Ship </title> Ship</text><text id="k10482" data-model-id="k10483" x="70" y="114" fill-opacity="1" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323"><title> Thùng 20x15x10CM </title> Thùng 20x15x10CM</text><text id="k10484" data-model-id="k10485" x="70" y="142" fill-opacity="1" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323"><title> Thùng 20x10x10CM </title> Thùng 20x10x10CM</text><text id="k10486" data-model-id="k10487" x="77" y="170" fill-opacity="1" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323"><title> Thùng 15x10x5CM </title> Thùng 15x10x5CM</text><text id="k10488" data-model-id="k10489" x="37" y="198" fill-opacity="1" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323"><title> Thùng 16.5x10.5x10.5 CM </title> Thùng 16.5x10.5x10.5 CM</text><text id="k10490" data-model-id="k10491" x="70" y="227" fill-opacity="1" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323"><title> Thùng 15x12x10CM </title> Thùng 15x12x10CM</text><text id="k10492" data-model-id="k10493" x="156" y="255" fill-opacity="1" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323"><title> VAT </title> VAT</text><text id="k10494" data-model-id="k10495" x="77" y="283" fill-opacity="1" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323"><title> Thùng 18x10x8CM </title> Thùng 18x10x8CM</text><text id="k10496" data-model-id="k10497" x="70" y="312" fill-opacity="1" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323"><title> Thùng 25x15x10CM </title> Thùng 25x15x10CM</text><text id="k10559" data-model-id="k10560" x="180" y="342" fill-opacity="1" transform="translate(3.925,0.425) rotate(315,183.075,337.653)" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323">0</text><text id="k10561" data-model-id="k10562" x="221" y="342" fill-opacity="1" transform="translate(-4.862,21.638) rotate(315,254.5,337.653)" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323">200,000,000</text><text id="k10563" data-model-id="k10564" x="284" y="342" fill-opacity="1" transform="translate(-4.862,21.638) rotate(315,317.138,337.653)" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323">400,000,000</text><text id="k10565" data-model-id="k10566" x="346" y="342" fill-opacity="1" transform="translate(-4.862,21.638) rotate(315,379.775,337.653)" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323">600,000,000</text><text id="k10567" data-model-id="k10568" x="409" y="342" fill-opacity="1" transform="translate(-4.862,21.638) rotate(315,442.413,337.653)" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323">800,000,000</text><text id="k10569" data-model-id="k10570" x="468" y="342" fill-opacity="1" transform="translate(-6.327,25.174) rotate(315,506.516,337.653)" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323">1,000,000,000</text><text id="k10571" data-model-id="k10572" x="531" y="342" fill-opacity="1" transform="translate(-6.327,25.174) rotate(315,569.154,337.653)" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323">1,200,000,000</text></g><g><path style="display: block; " d="M225 10 372 10 372 34 225 34 z" stroke="" stroke-width="0" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><text id="k10573" data-model-id="k10574" x="244" y="26" fill-opacity="1" style="font: 12px Arial,Helvetica,sans-serif; cursor: pointer;" fill="#232323">Vốn </text><text id="k10575" data-model-id="k10576" x="290" y="26" fill-opacity="1" style="font: 12px Arial,Helvetica,sans-serif; cursor: pointer;" fill="#232323">Vat</text><text id="k10577" data-model-id="k10578" x="328" y="26" fill-opacity="1" style="font: 12px Arial,Helvetica,sans-serif; cursor: pointer;" fill="#232323">Lãi gộp</text><path style="display: block; cursor: pointer;" data-model-id="k10574" d="M230.5 19.5 237.5 19.5 237.5 26.5 230.5 26.5 z" stroke="#0b87c9" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#0b87c9"></path><path style="display: block; cursor: pointer;" data-model-id="k10576" d="M276.5 19.5 283.5 19.5 283.5 26.5 276.5 26.5 z" stroke="#CC6633" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#CC6633"></path><path style="display: block; cursor: pointer;" data-model-id="k10578" d="M314.5 19.5 321.5 19.5 321.5 26.5 314.5 26.5 z" stroke="#9abc32" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#9abc32"></path></g></svg><div class="k-tooltip" style="display:none; position: absolute; font: 12px Arial,Helvetica,sans-serif;border: 1px solid;opacity: 1; filter: alpha(opacity=100);"></div></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="profitByStore" class="ng-hide">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <div class="width-100 search-box">
                                            <div class="col-xs-12 col-sm-8 no-padding">
                                                <span class="k-widget k-datepicker k-header s1" style="width: 120px;"><span class="k-picker-wrap k-state-default"><input id="fromDate3" class="s1 k-input" style="width: 100%;" k-ng-model="fromDate3" placeholder="Từ ngày" data-role="datepicker" type="text" role="combobox" aria-expanded="false" aria-owns="fromDate3_dateview" aria-disabled="false" aria-readonly="false"><span unselectable="on" class="k-select" role="button" aria-controls="fromDate3_dateview"><span unselectable="on" class="k-icon k-i-calendar">select</span></span></span></span>
                                                <span class="hidden-320">-</span>
                                                <span class="k-widget k-datepicker k-header s1" style="width: 120px;"><span class="k-picker-wrap k-state-default"><input id="toDate3" class="s1 k-input" style="width: 100%;" k-ng-model="toDate3" placeholder="Đến ngày" data-role="datepicker" type="text" role="combobox" aria-expanded="false" aria-owns="toDate3_dateview" aria-disabled="false" aria-readonly="false"><span unselectable="on" class="k-select" role="button" aria-controls="toDate3_dateview"><span unselectable="on" class="k-icon k-i-calendar">select</span></span></span></span>
                                                <div class="btn-group">
                                                    <button type="button" class="btn  btn-primary btn-outline hidden-768 ng-binding ng-pristine ng-valid" data-ng-model="dateRange" data-ng-class="{1:'clicked'}[selected3]" data-ng-click="onTypeChangeByStore(1)">Tuần</button>
                                                    <button type="button" class="btn  btn-primary btn-outline hidden-768 ng-binding ng-pristine ng-valid clicked" data-ng-model="dateRange" data-ng-class="{2:'clicked'}[selected3]" data-ng-click="onTypeChangeByStore(2)">Tháng</button>
                                                    <button type="button" class="btn  btn-primary btn-outline hidden-768 ng-binding ng-pristine ng-valid" data-ng-model="dateRange" data-ng-class="{3:'clicked'}[selected3]" data-ng-click="onTypeChangeByStore(3)">Quý</button>
                                                </div>
                                                <span data-ng-hide="byStoreChart" class="padding-left-10">
                                                    <button type="button" class="btn btn-primary" data-ng-click="byStoreChart = true" title="Xem biểu đồ">
                                                        <i class="icon-signal"></i>
                                                        <span class="hidden-1200 ng-binding">Xem biểu đồ</span>
                                                    </button>
                                                </span>
                                                <span data-ng-show="byStoreChart" class="padding-left-10 ng-hide">
                                                    <button type="button" class="btn btn-primary" data-ng-click="byStoreChart = false" title="Xem danh sách">
                                                        <i class="icon-search"></i>
                                                        <span class="hidden-1200 ng-binding">Xem danh sách</span>
                                                    </button>
                                                </span>
                                                <span class="hidden-320">
                                                    <button class="btn btn-success" data-ng-click="exportByStore()" title="Xuất Excel">
                                                        <i class="icon-download-alt white"></i>
                                                        <span class="hidden-1200 ng-binding">Xuất excel</span>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="width-100 summary-head" style="margin-bottom: 15px;">
                                        <div class="infobox infobox-orange">
                                            <div class="infobox-icon">
                                                <i class="icon-signal"></i>
                                            </div>
                                            <div class="infobox-data">
                                                <span class="infobox-data-number ng-binding">3,662,602,889</span>
                                                <div class="infobox-content">
                                                    Doanh thu
                                                    <span class="badge badge-primary ng-scope" data-ng-show="totalVat <= 0 " tooltip="Doanh số đã trừ tiền giảm giá">
                                                        <i class="icon icon-info"></i>
                                                    </span>
                                                    <span class="badge badge-primary ng-scope ng-hide" data-ng-show="totalVat > 0 " tooltip="Doanh số đã trừ tiền giảm giá và VAT">
                                                        <i class="icon icon-info"></i>
                                                    </span>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="infobox infobox-green">
                                            <div class="infobox-icon">
                                                <i class="icon-dollar"></i>
                                            </div>
                                            <div class="infobox-data">
                                                <span class="infobox-data-number ng-binding">480,675,231</span>
                                                <div class="infobox-content ng-binding">
                                                    Lãi gộp <span data-ng-hide="totalGrossProfitByStore < 0" class="badge badge-primary"><i class="icon icon-info ng-scope" tooltip="Lãi gộp là lợi nhuận từ bán hàng khi chưa trừ các chi phí khác"></i></span>
                                                    <span data-ng-show="totalGrossProfitByStore < 0" data-role="tooltip" kendo-tooltip="" k-content="'<b>Lợi nhuận</b>=<b>Doanh thu</b>-<b>Tiền trả hàng</b>-<b>Tiền vốn</b><br />(*) <b>Lợi nhuận có thể âm</b> khi hàng hóa có giá bán thấp hơn giá vốn hoặc tiền trả hàng.'" class="badge badge-primary ng-hide"><i class="icon-info ng-scope"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="infobox infobox-orange2">
                                            <div class="infobox-icon">
                                                <i class="icon-undo "></i>
                                            </div>
                                            <div class="infobox-data">
                                                <span class="infobox-data-number ng-binding">0</span>
                                                <div class="infobox-content ng-binding">Tiền trả hàng</div>
                                            </div>
                                        </div>
                                        <div class="infobox infobox-blue">
                                            <div class="infobox-icon">
                                                <i class="icon-money"></i>
                                            </div>
                                            <div class="infobox-data">
                                                <span class="infobox-data-number ng-binding">3,181,927,658 </span>
                                                <div class="infobox-content ng-binding">
                                                    Vốn
                                                    <span data-ng-show="totalCostByStore < 0" data-role="tooltip" kendo-tooltip="" k-content="'<b>Lợi nhuận</b>=<b>Doanh thu</b>-<b>Tiền trả hàng</b>-<b>Tiền vốn</b><br />(*) <b>Tiền vốn có thể âm</b> khi tiền trả hàng lớn hơn tiền bán hàng.'" class="badge badge-primary ng-hide"><i class="icon-info ng-scope"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="infobox infobox-orange2 hidden-1024">
                                            <div class="infobox-icon">
                                                <i class="icon-gift "></i>
                                            </div>
                                            <div class="infobox-data">
                                                <span class="infobox-data-number ng-binding">71,803,165</span>
                                                <div class="infobox-content ng-binding">Tiền giảm giá</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive" data-ng-hide="byStoreChart">
                                        <div class="dataTables_wrapper" role="grid" data-ng-init="initReportByStore();getReportByStore();">
                                            <table class="table table-striped table-bordered table-hover dataTable ng-scope ng-table" ng-table="byStoreParams"><!-- ngInclude: templates.header --><thead ng-include="templates.header" class="ng-scope"><tr class="ng-scope"> <!-- ngRepeat: column in $columns --> </tr> <tr ng-show="show_filter" class="ng-table-filters ng-scope ng-hide"> <!-- ngRepeat: column in $columns --> </tr></thead>
                                                <thead>
                                                    <tr role="row">
                                                        <th class="center border ng-binding">Cửa hàng</th>
                                                        <th class="center border ng-binding">SL bán

                                                            <span tooltip="Số hàng hóa đã bán: 1,699,805" class="badge badge-primary ng-scope"><i class="icon-info smaller"></i></span>
                                                        </th>
                                                        <th class="center border hidden-480 ng-binding">SL trả

                                                            <span tooltip="Số hàng hóa đã trả: 0" class="badge badge-primary ng-scope"><i class="icon-info smaller"></i></span>
                                                        </th>
                                                        <th class="sorting center border hidden-320 ng-binding">Giảm giá</th>
                                                        <th has-permission="POSIM_EarningPoint" class="sorting center border hidden-320 ng-binding">Quy đổi</th>
                                                        <th class="center border  ng-binding">Doanh thu</th>
                                                        <!-- ngIf: totalVat > 0 -->

                                                        <th class="sorting center hidden-480 ng-binding">Trả hàng</th>
                                                        <th class="sorting center hidden-480 ng-binding">Vốn </th>
                                                        <th class="sorting center border white-bg ng-binding">Lãi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- ngRepeat: r in params.data --><tr data-ng-repeat="r in params.data" class="ng-scope">
                                                        <td data-title="'Cửa hàng'" sortable="'storeName'" class="ng-binding">Ms Vi</td>
                                                        <td data-title="'SL bán'" class="text-center sorting ng-binding" sortable="'sellQty'">1,699,805</td>
                                                        <td data-title="'SL trả'" class="text-center sorting hidden-480 black ng-binding" sortable="'returnQty'" ng-class="{'red': r.returnQty!=0}">0</td>
                                                        <td data-title="'Giảm giá'" class="text-right sorting hidden-320" sortable="'discount'"><i class="ng-binding">71,803,165</i></td>
                                                        <td has-permission="POSIM_EarningPoint" data-title="'Quy đổi'" class="text-right sorting hidden-320" sortable="'exchangedMoney'"><i class="ng-binding">0</i></td>
                                                        <td data-title="'Doanh thu'" class="text-right sorting ng-binding" sortable="'earning'">3,662,602,889</td>
                                                        <!-- ngIf: totalVat > 0 -->

                                                        <td data-title="'Tiền trả hàng'" class="text-right sorting hidden-480 ng-binding" sortable="'returnCost'">0</td>
                                                        <td data-title="'Tiền vốn'" class="text-right sorting hidden-480 ng-binding" sortable="'cost'">3,181,927,658</td>
                                                        <td data-title="'Lợi nhuận'" class="text-right sorting hl ng-binding" sortable="'gp'">480,675,231</td>
                                                    </tr><!-- end ngRepeat: r in params.data -->
                                                </tbody>
                                            </table><div ng-table-pagination="params" template-url="templates.pagination" class="row ng-scope ng-isolate-scope"><!-- ngInclude: templateUrl --><div ng-include="templateUrl" class="col-sm-12 pull-right ng-scope"><div class="dataTables_paginate paging_bootstrap ng-scope"><!-- ngIf: params.data.length == 0 --><!-- ngIf: params.settings().total > 10 --><ul class="pagination"> <!-- ngIf: lastpage > 5 --> <!-- ngRepeat: page in pages --> <!-- ngIf: lastpage > 5 --> <li class="disabled hidden-768"> <a ng-show="lastpage > 2" class="ng-hide">Trang </a><input type="text" style="width:42px; height:32px !important; float:left; border-radius:0px !important;margin:0" ng-show="lastpage > 2" ng-model="curPage" ng-change="changePage(curPage)" class="ng-pristine ng-valid ng-hide"><a ng-show="lastpage > 2" class="ng-binding ng-hide"> / 1</a></li></ul></div></div></div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 no-padding ng-hide" data-ng-show="byStoreChart" id="profitChartByStoreContainer">
                                        <div id="chartProfitByStore" style="min-width: 240px; min-height: 480px; max-width: 960px; max-height: 480px; position: relative;" data-role="chart" class="k-chart"><!--?xml version='1.0' ?--><svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="600px" height="400px" style="position: relative; display: block;"><defs id="k10223"><clipPath id="k10224"><path style="display: block; " d="M44 43 566.362 43 566.362 294.724 44 294.724 z" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path></clipPath><linearGradient id="k10243" gradientTransform="rotate(90)"> <stop offset="0%" style="stop-color:#fff;stop-opacity:0"></stop><stop offset="25%" style="stop-color:#fff;stop-opacity:0.3"></stop><stop offset="100%" style="stop-color:#fff;stop-opacity:0"></stop></linearGradient></defs><path style="display: block; " d="M0 0 600 0 600 400 0 400 z" stroke="" stroke-width="0" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#fff"></path><path style="display: block; " d="M44.5 43.5 566.5 43.5 566.5 295.5 44.5 295.5 z" stroke-width="0.1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path id="k10001" style="display: block; " data-model-id="k10002" d="M44 43 566.362 43 566.362 294.724 44 294.724 z" stroke="" stroke-linecap="square" stroke-linejoin="round" fill-opacity="0" stroke-opacity="1" fill="#fff"></path><text x="246" y="29" fill-opacity="1" style="font: 16px Arial,Helvetica,sans-serif; " fill="#8e8e8e">Theo cửa hàng</text><g id="k10167"><path style="display: block; " data-model-id="k10002" d="M131.5 43.5 131.5 295.5" stroke="#dfdfdf" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " data-model-id="k10002" d="M218.5 43.5 218.5 295.5" stroke="#dfdfdf" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " data-model-id="k10002" d="M305.5 43.5 305.5 295.5" stroke="#dfdfdf" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " data-model-id="k10002" d="M392.5 43.5 392.5 295.5" stroke="#dfdfdf" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " data-model-id="k10002" d="M479.5 43.5 479.5 295.5" stroke="#dfdfdf" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " data-model-id="k10002" d="M566.5 43.5 566.5 295.5" stroke="#dfdfdf" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M44.5 43.5 44.5 295.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M40.5 43.5 44.5 43.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M40.5 295.5 44.5 295.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><g id="k10225" clip-path="url(#k10224)"><g id="k10208"><g><path id="k10244" style="display: block; " data-model-id="k10210" d="M44.5 119.5 462.5 119.5 462.5 219.5 44.5 219.5 z" stroke="#7b9628" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#9abc32"></path><path id="k10209" style="display: block; " data-model-id="k10210" d="M44.5 119.5 462.5 119.5 462.5 219.5 44.5 219.5 z" stroke="#7b9628" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="url(#k10243)"></path></g></g></g><path style="display: block; " d="M44.5 295.5 566.5 295.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M44.5 295.5 44.5 299.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M131.5 295.5 131.5 299.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M218.5 295.5 218.5 299.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M305.5 295.5 305.5 299.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M392.5 295.5 392.5 299.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M479.5 295.5 479.5 299.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M566.5 295.5 566.5 299.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><text id="k10206" data-model-id="k10207" x="5" y="173" fill-opacity="1" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323"><title> Ms Vi </title> Ms Vi</text><text id="k10211" data-model-id="k10212" x="37" y="315" fill-opacity="1" transform="translate(3.925,0.425) rotate(315,40.075,310.724)" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323">0</text><text id="k10213" data-model-id="k10214" x="102" y="315" fill-opacity="1" transform="translate(-4.862,21.638) rotate(315,135.922,310.724)" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323">100,000,000</text><text id="k10215" data-model-id="k10216" x="189" y="315" fill-opacity="1" transform="translate(-4.862,21.638) rotate(315,222.983,310.724)" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323">200,000,000</text><text id="k10217" data-model-id="k10218" x="277" y="315" fill-opacity="1" transform="translate(-4.862,21.638) rotate(315,310.043,310.724)" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323">300,000,000</text><text id="k10219" data-model-id="k10220" x="364" y="315" fill-opacity="1" transform="translate(-4.862,21.638) rotate(315,397.103,310.724)" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323">400,000,000</text><text id="k10265" data-model-id="k10264" x="451" y="315" fill-opacity="1" transform="translate(-4.862,21.638) rotate(315,484.164,310.724)" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323">500,000,000</text><text id="k10263" data-model-id="k10262" x="538" y="315" fill-opacity="1" transform="translate(-4.862,21.638) rotate(315,571.224,310.724)" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323">600,000,000</text></g><g><path style="display: block; " d="M267 366 330 366 330 390 267 390 z" stroke="" stroke-width="0" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><text id="k10221" data-model-id="k10222" x="286" y="382" fill-opacity="1" style="font: 12px Arial,Helvetica,sans-serif; cursor: pointer;" fill="#232323">Lãi gộp</text><path style="display: block; cursor: pointer;" data-model-id="k10222" d="M272.5 375.5 279.5 375.5 279.5 382.5 272.5 382.5 z" stroke="#9abc32" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#9abc32"></path></g></svg><div class="k-tooltip" style="display:none; position: absolute; font: 12px Arial,Helvetica,sans-serif;border: 1px solid;opacity: 1; filter: alpha(opacity=100);"></div></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="profitByFinance" class="ng-hide">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <div class="width-100 search-box">
                                            <div class="col-xs-12 col-sm-8 no-padding">
                                                <select data-ng-show="grantedStores.length > 1" data-ng-model="selectedStore" data-ng-options="store.StoreName for store in grantedStores" data-ng-change="onStoreChange(selectedStore)" style="max-width: 300px;" class="ng-pristine ng-valid ng-hide"><option value="0" selected="selected">Ms Vi</option></select>
                                                <span class="k-widget k-datepicker k-header s1" style="width: 120px;"><span class="k-picker-wrap k-state-default"><input id="fromDate4" class="s1 k-input" style="width: 100%;" k-ng-model="fromDate4" placeholder="Từ ngày" data-role="datepicker" type="text" role="combobox" aria-expanded="false" aria-owns="fromDate4_dateview" aria-disabled="false" aria-readonly="false"><span unselectable="on" class="k-select" role="button" aria-controls="fromDate4_dateview"><span unselectable="on" class="k-icon k-i-calendar">select</span></span></span></span>
                                                <span class="hidden-320">-</span>
                                                <span class="k-widget k-datepicker k-header s1" style="width: 120px;"><span class="k-picker-wrap k-state-default"><input id="toDate4" class="s1 k-input" style="width: 100%;" k-ng-model="toDate4" placeholder="Đến ngày" data-role="datepicker" type="text" role="combobox" aria-expanded="false" aria-owns="toDate4_dateview" aria-disabled="false" aria-readonly="false"><span unselectable="on" class="k-select" role="button" aria-controls="toDate4_dateview"><span unselectable="on" class="k-icon k-i-calendar">select</span></span></span></span>
                                                <div class="btn-group">
                                                    <button type="button" class="btn  btn-primary btn-outline hidden-768 ng-binding ng-pristine ng-valid" data-ng-model="dateRange" data-ng-class="{1:'clicked'}[selected4]" data-ng-click="onTypeChangeByFinance(1)">Tuần</button>
                                                    <button type="button" class="btn  btn-primary btn-outline hidden-768 ng-binding ng-pristine ng-valid clicked" data-ng-model="dateRange" data-ng-class="{2:'clicked'}[selected4]" data-ng-click="onTypeChangeByFinance(2)">Tháng</button>
                                                    <button type="button" class="btn  btn-primary btn-outline hidden-768 ng-binding ng-pristine ng-valid" data-ng-model="dateRange" data-ng-class="{3:'clicked'}[selected4]" data-ng-click="onTypeChangeByFinance(3)">Quý</button>
                                                </div>
                                                <span class="hidden-320">
                                                    <button class="btn btn-success" title="Xuất Excel" data-ng-click="exportByFinance();">
                                                        <i class="icon-download-alt white"></i>
                                                        <span class="hidden-1200 ng-binding">Xuất excel</span>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-8" style="margin-top: 10px;"></div>
                                    <div>
                                        <table style="max-width: 800px !important;" class="table table-bordered col-xs-12 col-sm-8" data-ng-init="getReportByFinance()">
                                            <thead>
                                                <tr>
                                                    <th style="max-width: 300px !important;" class="ng-binding">Chỉ tiêu</th>
                                                    <th style="max-width: 170px !important;" class="text-center ng-binding">
                                                        Kỳ trước
                                                        <br>
                                                        <span style="font-weight: normal !important;" class="ng-binding">(01/05/2023 - 31/05/2023)</span>
                                                    </th>
                                                    <th style="max-width: 170px !important;" class="text-center ng-binding">
                                                        Kỳ này
                                                        <br>
                                                        <span style="font-weight: normal !important;" class="ng-binding">(01/06/2023 - 30/06/2023)</span>
                                                    </th>
                                                    <th style="max-width: 160px !important;" class="text-center ng-binding">Thay đổi (%)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="ng-binding">1. Doanh thu <span data-ng-hide="pl.totalVat.lastValue > 0 || pl.totalVat.currentValue > 0" class="badge badge-primary"><i class="icon icon-info" title="Doanh số đã trừ tiền giảm giá"></i></span>
                                                    <span data-ng-show="pl.totalVat.lastValue > 0 || pl.totalVat.currentValue > 0" class="badge badge-primary ng-hide"><i class="icon icon-info" title="Doanh số đã trừ tiền giảm giá và VAT"></i></span>
                                                    </td>
                                                    <td class="text-right ng-binding">
                                                        7,888,306,325
                                                        <span class="smaller-90 ng-binding ng-hide" data-ng-show="pl.totalVat.lastValue > 0 &amp;&amp;  pl.totalVat.currentValue > 0">( VAT: 0 )</span>
                                                    </td>
                                                    <td class="text-right ng-binding">
                                                        3,662,602,889
                                                        <span class="smaller-90 ng-binding ng-hide" data-ng-show="pl.totalVat.currentValue > 0"> (VAT: 0 )</span>

                                                    </td>
                                                    <td class="text-right"><!-- ngIf: pl.totalRevenue.change != null --><span data-ng-if="pl.totalRevenue.change != null" class="ng-binding ng-scope">-54 % <i class="icon icon-arrow-down red" data-ng-class="{'icon-arrow-up green':pl.totalRevenue.change > 0, 'icon-arrow-down red':pl.totalRevenue.change<0}"></i></span><!-- end ngIf: pl.totalRevenue.change != null --></td>
                                                </tr>

                                                <tr>
                                                    <td class="ng-binding">2. Tiền giảm giá</td>
                                                    <td class="text-right ng-binding">133,459,016</td>
                                                    <td class="text-right ng-binding">71,803,165</td>
                                                    <td class="text-right"><!-- ngIf: pl.discount.change != null --><span data-ng-if="pl.discount.change != null" class="ng-binding ng-scope">-46 % <i class="icon icon-arrow-down green" data-ng-class="{'icon-arrow-up red':pl.discount.change > 0, 'icon-arrow-down green':pl.discount.change<0}"></i></span><!-- end ngIf: pl.discount.change != null --></td>
                                                </tr>
                                                <tr has-permission="POSIM_EarningPoint">
                                                    <td class="ng-binding">3. Tiền quy đổi</td>
                                                    <td class="text-right ng-binding">0</td>
                                                    <td class="text-right ng-binding">0</td>
                                                    <td class="text-right"><!-- ngIf: pl.exchangedMoney.change != null --></td>
                                                </tr>
                                                <tr>
                                                    <td class="ng-binding">4. Tiền trả hàng</td>
                                                    <td class="text-right ng-binding">0</td>
                                                    <td class="text-right ng-binding">0</td>
                                                    <td class="text-right"><!-- ngIf: pl.return.change != null --></td>
                                                </tr>
                                                <tr>
                                                    <td class="ng-binding">5. Doanh thu thuần <i>= [1] - [4]</i></td>
                                                    <td class="text-right ng-binding">7,888,306,325</td>
                                                    <td class="text-right ng-binding">3,662,602,889</td>
                                                    <td class="text-right"><!-- ngIf: pl.grossRevenue.change != null --><span data-ng-if="pl.grossRevenue.change != null" class="ng-binding ng-scope">-54 % <i class="icon icon-arrow-down red" data-ng-class="{'icon-arrow-up green':pl.grossRevenue.change > 0, 'icon-arrow-down red':pl.grossRevenue.change<0}"></i></span><!-- end ngIf: pl.grossRevenue.change != null --></td>
                                                </tr>
                                                <tr>
                                                    <td class="ng-binding">6. Tiền vốn mua hàng hóa </td>
                                                    <td class="text-right ng-binding">7,105,321,096</td>
                                                    <td class="text-right ng-binding">3,181,927,658</td>
                                                    <td class="text-right"><!-- ngIf: pl.costOfGoodSold.change != null --><span data-ng-if="pl.costOfGoodSold.change != null" class="ng-binding ng-scope">-55 % <i class="icon icon-arrow-down green" data-ng-class="{'icon-arrow-up red':pl.costOfGoodSold.change > 0, 'icon-arrow-down green':pl.costOfGoodSold.change<0}"></i></span><!-- end ngIf: pl.costOfGoodSold.change != null --></td>
                                                </tr>
                                                <tr>
                                                    <td class="ng-binding">7. Lãi gộp <i>= [5] - [6]</i> <span class="badge badge-primary"><i class="icon icon-info ng-scope" tooltip="Lãi gộp là lợi nhuận từ bán hàng khi chưa trừ các chi phí khác"></i></span></td>
                                                    <td class="text-right ng-binding">782,985,229</td>
                                                    <td class="text-right ng-binding">480,675,231</td>
                                                    <td class="text-right"><!-- ngIf: pl.grossProfit.change != null --><span data-ng-if="pl.grossProfit.change != null" class="ng-binding ng-scope">-39 % <i class="icon icon-arrow-down red" data-ng-class="{'icon-arrow-up green':pl.grossProfit.change > 0, 'icon-arrow-down red':pl.grossProfit.change<0}"></i></span><!-- end ngIf: pl.grossProfit.change != null --></td>
                                                </tr>
                                                <tr>
                                                    <td class="ng-binding">8. Chi phí </td>
                                                    <td class="text-right ng-binding">0</td>
                                                    <td class="text-right ng-binding">0</td>
                                                    <td class="text-right"><!-- ngIf: pl.operatingExpense.change != null --></td>
                                                </tr>
                                                <tr>
                                                    <td class="bolder ng-binding">9. Lãi ròng <i>= [7] - [8]</i>  <span class="badge badge-primary"><i class="icon icon-info" title="Lãi ròng là lợi nhuận cuối cùng sau khi đã trừ các chi phí khác"></i></span></td>
                                                    <td class="bolder text-right ng-binding">782,985,229</td>
                                                    <td class="bolder text-right ng-binding">480,675,231</td>
                                                    <td class="bolder text-right"><!-- ngIf: pl.netProfit.change != null --><span data-ng-if="pl.netProfit.change != null" class="ng-binding ng-scope">-39 % <i class="icon icon-arrow-down red" data-ng-class="{'icon-arrow-up green':pl.netProfit.change > 0, 'icon-arrow-down red':pl.netProfit.change<0}"></i></span><!-- end ngIf: pl.netProfit.change != null --></td>
                                                </tr>
                                                <tr>
                                                    <td class="ng-binding">10. Tiền giảm giá/Doanh thu (%) <i>= [2] / [1]</i></td>
                                                    <td class="text-right ng-binding">2 %</td>
                                                    <td class="text-right ng-binding">2 %</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td class="ng-binding">11. Tiền trả hàng/Doanh thu (%) <i>= [4] / [1]</i></td>
                                                    <td class="text-right ng-binding">0 %</td>
                                                    <td class="text-right ng-binding">0 %</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td class="ng-binding">12. Lãi gộp/Doanh thu (%) <i>= [7] / [1]</i></td>
                                                    <td class="text-right ng-binding">10 %</td>
                                                    <td class="text-right ng-binding">13 %</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td class="ng-binding">13. Lãi ròng/Doanh thu (%) <i>= [9] / [1]</i></td>
                                                    <td class="text-right ng-binding">10 %</td>
                                                    <td class="text-right ng-binding">13 %</td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="profitBySaleUser" class="ng-hide">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <div class="width-100 search-box">
                                            <div class="col-sm-12 no-padding">
                                                <select data-ng-model="user" data-ng-options="c.name for c in users" data-ng-change="changeUser(user)" class="p-100 ng-pristine ng-valid"><option value="0" selected="selected">--- Tất cả nhân viên ---</option><option value="1">ADMIND SGN</option><option value="2">Kho Thủ Đức</option><option value="3">Kiều Ngân</option><option value="4">Phạm Đức Trung</option><option value="5">Hồng Ngọc</option><option value="6"> Chị Hà</option><option value="7"> Hồng Ngọc (Xưởng)</option><option value="8">Hữu Tiến</option><option value="9">Kho Tân Phú</option><option value="10">Mỹ Diễm</option><option value="11">Thu Nhi</option><option value="12">Fast Box</option><option value="13"> Kim Thoa</option><option value="14">Kiều Ngân (Xưởng)</option><option value="15">Tiến - Xưởng</option><option value="16">Kho Quận 8</option><option value="17"> Kho Quận 11</option><option value="18"> Nhi Đoàn</option><option value="19"> Hữu Tiến BBK</option><option value="20">Thanh Thanh (KT)</option><option value="21">Kho Hà Nội</option><option value="22"> Kho Gò Vấp</option><option value="23">Hồng Diễm</option><option value="24">Mỹ Duyên</option><option value="25">Ly Giấy</option><option value="26">Kim Loan</option><option value="27">Quyền Thư</option><option value="28">Hoài Bảo</option></select>
                                                <span class="k-widget k-datepicker k-header s1" style="width: 120px;"><span class="k-picker-wrap k-state-default"><input id="fromDate5" class="s1 k-input" style="width: 100%;" k-ng-model="fromDate5" data-role="datepicker" type="text" role="combobox" aria-expanded="false" aria-owns="fromDate5_dateview" aria-disabled="false" aria-readonly="false" placeholder="Từ ngày"><span unselectable="on" class="k-select" role="button" aria-controls="fromDate5_dateview"><span unselectable="on" class="k-icon k-i-calendar">select</span></span></span></span>
                                                <span class="hidden-320">-</span>
                                                <span class="k-widget k-datepicker k-header s1" style="width: 120px;"><span class="k-picker-wrap k-state-default"><input id="toDate5" class="s1 k-input" style="width: 100%;" k-ng-model="toDate5" placeholder="Đến ngày" data-role="datepicker" type="text" role="combobox" aria-expanded="false" aria-owns="toDate5_dateview" aria-disabled="false" aria-readonly="false"><span unselectable="on" class="k-select" role="button" aria-controls="toDate5_dateview"><span unselectable="on" class="k-icon k-i-calendar">select</span></span></span></span>
                                                <span data-ng-hide="bySaleUserChart" class="padding-left-10">
                                                    <button type="button" class="btn btn-primary" data-ng-click="bySaleUserChart = true">
                                                        <i class="icon-signal"></i>
                                                        <span class="hidden-768 ng-binding">Xem biểu đồ</span>
                                                    </button>
                                                </span>
                                                <span data-ng-show="bySaleUserChart" class="padding-left-10 ng-hide">
                                                    <button type="button" class="btn btn-primary" data-ng-click="bySaleUserChart = false">
                                                        <i class="icon-search"></i>
                                                        <span class="hidden-768 ng-binding">Xem danh sách</span>
                                                    </button>
                                                </span>
                                                <span class="hidden-480">
                                                    <button class="btn btn-success" data-ng-click="exportBySaleUser()">
                                                        <i class="icon-download-alt white"></i>
                                                        <span class="hidden-768 ng-binding">Xuất excel</span>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="width-100 summary-head col-xs-12 no-padding" style="margin-bottom: 15px;" data-ng-init="initReportBySaleUser(); getReportBySaleUser();">
                                        <div class="infobox infobox-orange">
                                            <div class="infobox-icon">
                                                <i class="icon-signal"></i>
                                            </div>
                                            <div class="infobox-data">
                                                <span class="infobox-data-number ng-binding">0</span>
                                                <div class="infobox-content ng-binding">
                                                    Doanh thu
                                                    <span class="badge badge-primary ng-scope" data-ng-show="totalVat <= 0 " tooltip="Doanh số đã trừ tiền giảm giá">
                                                        <i class="icon icon-info"></i>
                                                    </span>
                                                    <span class="badge badge-primary ng-scope ng-hide" data-ng-show="totalVat > 0 " tooltip="Doanh số đã trừ tiền giảm giá và VAT">
                                                        <i class="icon icon-info"></i>
                                                    </span>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="infobox infobox-green">
                                            <div class="infobox-icon">
                                                <i class="icon-dollar"></i>
                                            </div>
                                            <div class="infobox-data">
                                                <span class="infobox-data-number ng-binding">0</span>
                                                <div class="infobox-content ng-binding">
                                                    Lãi gộp <span data-ng-hide="totalGrossProfitByTime < 0" class="badge badge-primary"><i class="icon icon-info ng-scope" tooltip="Lãi gộp là lợi nhuận từ bán hàng khi chưa trừ các chi phí khác"></i></span>
                                                    <span data-ng-show="totalGrossProfitByTime < 0" data-role="tooltip" kendo-tooltip="" k-content="'<b>Lợi nhuận</b>=<b>Doanh thu</b>-<b>Tiền trả hàng</b>-<b>Tiền vốn</b><br />(*) <b>Lợi nhuận có thể âm</b> khi hàng hóa có giá bán thấp hơn giá vốn hoặc tiền trả hàng.'" class="badge badge-primary ng-hide"><i class="icon-info ng-scope"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="infobox infobox-orange2">
                                            <div class="infobox-icon">
                                                <i class="icon-undo "></i>
                                            </div>
                                            <div class="infobox-data">
                                                <span class="infobox-data-number ng-binding">0</span>
                                                <div class="infobox-content ng-binding">Tiền trả hàng</div>
                                            </div>
                                        </div>
                                        <div class="infobox infobox-blue">
                                            <div class="infobox-icon">
                                                <i class="icon-money"></i>
                                            </div>
                                            <div class="infobox-data">
                                                <span class="infobox-data-number ng-binding">0</span>
                                                <div class="infobox-content ng-binding">
                                                    Vốn
                                                    <span data-ng-show="totalCostByTime < 0" data-role="tooltip" kendo-tooltip="" k-content="'<b>Lợi nhuận</b>=<b>Doanh thu</b>-<b>Tiền trả hàng</b>-<b>Tiền vốn</b><br />(*) <b>Tiền vốn có thể âm</b> khi tiền trả hàng lớn hơn tiền bán hàng.'" class="badge badge-primary ng-hide"><i class="icon-info ng-scope"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="infobox infobox-orange2 hidden-1024">
                                            <div class="infobox-icon">
                                                <i class="icon-gift "></i>
                                            </div>
                                            <div class="infobox-data">
                                                <span class="infobox-data-number ng-binding">0</span>
                                                <div class="infobox-content ng-binding">Tiền giảm giá</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive" data-ng-hide="bySaleUserChart">
                                        <div class="dataTables_wrapper" role="grid">
                                            <table class="table table-striped table-bordered table-hover dataTable ng-scope ng-table" data-ng-table="saleUserParams"><!-- ngInclude: templates.header --><thead ng-include="templates.header" class="ng-scope"><tr class="ng-scope"> <!-- ngRepeat: column in $columns --> </tr> <tr ng-show="show_filter" class="ng-table-filters ng-scope ng-hide"> <!-- ngRepeat: column in $columns --> </tr></thead>
                                                <thead>
                                                    <tr role="row">
                                                        <th class="sorting border sorting_desc" data-ng-class="{'sorting_asc': saleUserParams.isSortBy('saleUser', 'asc'), 'sorting_desc': saleUserParams.isSortBy('saleUser', 'desc')}" data-ng-click="saleUserParams.sorting({'saleUser': saleUserParams.isSortBy('saleUser', 'asc') ? 'desc' : 'asc'})">Nhân viên</th>
                                                        <th class="sorting center border" data-ng-class="{'sorting_asc': saleUserParams.isSortBy('sellQty', 'asc'), 'sorting_desc': saleUserParams.isSortBy('sellQty', 'desc')}" data-ng-click="saleUserParams.sorting({'sellQty': saleUserParams.isSortBy('sellQty', 'asc') ? 'desc' : 'asc'})">
                                                            SL bán
                                                            <span tooltip="Số đơn hàng: 1,149" class="badge badge-primary ng-scope"><i class="icon-info smaller"></i></span>
                                                        </th>
                                                        <th class="sorting center border hidden-480" data-ng-class="{'sorting_asc': saleUserParams.isSortBy('returnQty', 'asc'), 'sorting_desc': saleUserParams.isSortBy('returnQty', 'desc')}" data-ng-click="saleUserParams.sorting({'returnQty': saleUserParams.isSortBy('returnQty', 'asc') ? 'desc' : 'asc'})">
                                                            SL trả
                                                            <span tooltip="Số phiếu nhập trả: 0" class="badge badge-primary ng-scope"><i class="icon-info smaller"></i></span>
                                                        </th>
                                                        <th class="sorting center border hidden-320 ng-binding" data-ng-class="{'sorting_asc': saleUserParams.isSortBy('discount', 'asc'), 'sorting_desc': saleUserParams.isSortBy('discount', 'desc')}" data-ng-click="saleUserParams.sorting({'discount': saleUserParams.isSortBy('discount', 'asc') ? 'desc' : 'asc'})">Giảm giá</th>
                                                        <th class="sorting center border ng-binding" data-ng-class="{'sorting_asc': saleUserParams.isSortBy('revenue', 'asc'), 'sorting_desc': saleUserParams.isSortBy('revenue', 'desc')}" data-ng-click="saleUserParams.sorting({'revenue': saleUserParams.isSortBy('revenue', 'asc') ? 'desc' : 'asc'})">Doanh thu</th>
                                                        <!-- ngIf: totalVat > 0 -->
                                                        <th class="sorting center hidden-480 ng-binding" data-ng-class="{'sorting_asc': saleUserParams.isSortBy('returnCost', 'asc'), 'sorting_desc': saleUserParams.isSortBy('returnCost', 'desc')}" data-ng-click="saleUserParams.sorting({'returnCost': saleUserParams.isSortBy('returnCost', 'asc') ? 'desc' : 'asc'})">Trả hàng</th>
                                                        <th class="sorting center hidden-480 ng-binding" data-ng-class="{'sorting_asc': saleUserParams.isSortBy('cost', 'asc'), 'sorting_desc': saleUserParams.isSortBy('cost', 'desc')}" data-ng-click="saleUserParams.sorting({'cost': saleUserParams.isSortBy('cost', 'asc') ? 'desc' : 'asc'})">Vốn </th>
                                                        <th class="sorting center border white-bg ng-binding" data-ng-class="{'sorting_asc': saleUserParams.isSortBy('gp', 'asc'), 'sorting_desc': saleUserParams.isSortBy('gp', 'desc')}" data-ng-click="saleUserParams.sorting({'gp': saleUserParams.isSortBy('gp', 'asc') ? 'desc' : 'asc'})">Lãi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- ngRepeat: r in params.data -->
                                                </tbody>
                                            </table><div ng-table-pagination="params" template-url="templates.pagination" class="row ng-scope ng-isolate-scope"><!-- ngInclude: templateUrl --><div ng-include="templateUrl" class="col-sm-12 pull-right ng-scope"><div class="dataTables_paginate paging_bootstrap ng-scope"><!-- ngIf: params.data.length == 0 --><div ng-if="params.data.length == 0" class="width-100 text-center ng-scope">Chưa có dữ liệu</div><!-- end ngIf: params.data.length == 0 --><!-- ngIf: params.settings().total > 10 --><ul class="pagination"> <!-- ngIf: lastpage > 5 --> <!-- ngRepeat: page in pages --> <!-- ngIf: lastpage > 5 --> <li class="disabled hidden-768"> <a ng-show="lastpage > 2" class="ng-hide">Trang </a><input type="text" style="width:42px; height:32px !important; float:left; border-radius:0px !important;margin:0" ng-show="lastpage > 2" ng-model="curPage" ng-change="changePage(curPage)" class="ng-pristine ng-valid ng-hide"><a ng-show="lastpage > 2" class="ng-binding ng-hide"> / 1</a></li></ul></div></div></div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 no-padding ng-hide" data-ng-show="bySaleUserChart" id="bySaleUserChartContainer">
                                        <div id="chartProfitBySaleUser" style="min-width: 240px; min-height: 480px; max-width: 960px; max-height: 480px; position: relative;" data-role="chart" class="k-chart"><!--?xml version='1.0' ?--><svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="600px" height="400px" style="position: relative; display: block;"><defs id="k10267"><clipPath id="k10266"><path style="display: block; " d="M21 46 594 46 594 386 21 386 z" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path></clipPath></defs><path style="display: block; " d="M0 0 600 0 600 400 0 400 z" stroke="" stroke-width="0" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#fff"></path><path style="display: block; " d="M21.5 46.5 594.5 46.5 594.5 386.5 21.5 386.5 z" stroke-width="0.1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path id="k10269" style="display: block; " data-model-id="k10270" d="M21 46 594 46 594 386 21 386 z" stroke="" stroke-linecap="square" stroke-linejoin="round" fill-opacity="0" stroke-opacity="1" fill="#fff"></path><g id="k10271"><path style="display: block; " data-model-id="k10270" d="M21.5 386.5 594.5 386.5" stroke="#dfdfdf" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " data-model-id="k10270" d="M21.5 329.5 594.5 329.5" stroke="#dfdfdf" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " data-model-id="k10270" d="M21.5 273.5 594.5 273.5" stroke="#dfdfdf" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " data-model-id="k10270" d="M21.5 216.5 594.5 216.5" stroke="#dfdfdf" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " data-model-id="k10270" d="M21.5 159.5 594.5 159.5" stroke="#dfdfdf" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " data-model-id="k10270" d="M21.5 103.5 594.5 103.5" stroke="#dfdfdf" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " data-model-id="k10270" d="M21.5 46.5 594.5 46.5" stroke="#dfdfdf" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M21.5 386.5 594.5 386.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M594.5 386.5 594.5 390.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><g id="k10268" clip-path="url(#k10266)"><g id="k10272"></g></g><path style="display: block; " d="M21.5 46.5 21.5 386.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M17.5 386.5 21.5 386.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M17.5 329.5 21.5 329.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M17.5 273.5 21.5 273.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M17.5 216.5 21.5 216.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M17.5 159.5 21.5 159.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M17.5 103.5 21.5 103.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M17.5 46.5 21.5 46.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><text id="k10273" data-model-id="k10274" x="5" y="390" fill-opacity="1" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323">0</text><text id="k10275" data-model-id="k10276" x="5" y="333" fill-opacity="1" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323">0</text><text id="k10277" data-model-id="k10278" x="5" y="277" fill-opacity="1" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323">0</text><text id="k10279" data-model-id="k10280" x="5" y="220" fill-opacity="1" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323">0</text><text id="k10281" data-model-id="k10282" x="5" y="163" fill-opacity="1" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323">0</text><text id="k10168" data-model-id="k10169" x="5" y="107" fill-opacity="1" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323">1</text><text id="k10170" data-model-id="k10171" x="5" y="50" fill-opacity="1" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323">1</text></g><g><path style="display: block; " d="M225 10 372 10 372 34 225 34 z" stroke="" stroke-width="0" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><text id="k10172" data-model-id="k10173" x="244" y="26" fill-opacity="1" style="font: 12px Arial,Helvetica,sans-serif; cursor: pointer;" fill="#232323">Vốn </text><text id="k10174" data-model-id="k10175" x="290" y="26" fill-opacity="1" style="font: 12px Arial,Helvetica,sans-serif; cursor: pointer;" fill="#232323">Vat</text><text id="k10176" data-model-id="k10177" x="328" y="26" fill-opacity="1" style="font: 12px Arial,Helvetica,sans-serif; cursor: pointer;" fill="#232323">Lãi gộp</text><path style="display: block; cursor: pointer;" data-model-id="k10173" d="M230.5 19.5 237.5 19.5 237.5 26.5 230.5 26.5 z" stroke="#0b87c9" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#0b87c9"></path><path style="display: block; cursor: pointer;" data-model-id="k10175" d="M276.5 19.5 283.5 19.5 283.5 26.5 276.5 26.5 z" stroke="#CC6633" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#CC6633"></path><path style="display: block; cursor: pointer;" data-model-id="k10177" d="M314.5 19.5 321.5 19.5 321.5 26.5 314.5 26.5 z" stroke="#9abc32" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#9abc32"></path></g></svg><div class="k-tooltip" style="display:none; position: absolute; font: 12px Arial,Helvetica,sans-serif;border: 1px solid;opacity: 1; filter: alpha(opacity=100);"></div></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-dialog">

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @push('js')
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
    color: #858585!important;
}
input[type=checkbox].ace+.lbl, input[type=radio].ace+.lbl {
    position: relative;
    display: inline-block;
    margin: 0;
    line-height: 20px;
    min-height: 18px;
    min-width: 18px;
    font-weight: 400;
    cursor: pointer;
}
.k-datepicker .k-picker-wrap input, .k-datetimepicker .k-picker-wrap input {
    padding: 0!important;
    border-radius: 0!important;
    height: 32px!important;
}
span.s1 input.s1 {
    width: 100%!important;
}
.btn-group, .btn-group-vertical {
    position: relative;
    display: inline-block;
    vertical-align: middle;
}
.btn-outline.btn-primary {
    border-color: #428bca;
    color: #428bca!important;
}
.btn-outline {
    background-color: transparent!important;
    color: inherit;
    border: 1px solid!important;
    text-shadow: none!important;
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
    border-color: #d8d8d8!important;
    vertical-align: middle;
    text-align: left;
    position: relative;
}
.infobox>.infobox-icon {
    display: inline-block;
    vertical-align: top;
    width: 44px;
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
    text-shadow: 1px 1px 0 rgba(0,0,0,.15);
}
.infobox .infobox-content {
    color: #555;
}
    </style>
       @endpush
@endsection
