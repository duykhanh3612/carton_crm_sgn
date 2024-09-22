<div class="widget-content">
<div class="row" style="background: #efefef; padding: 20px 10px; margin: 0;">
    <div class="col-6 col-lg-4" style="z-index: 9;">
        <div class="widget-box bd-blue">
            <div class="widget-header widget-header-flat infobox-blue infobox-dark">
                <h4 class="widget-title ng-binding">
                    <i class="icon-signal"></i>
                    Hoạt động
                </h4>
                <div class="widget-toolbar no-border">
                    <div class="inline dropdown-hover">
                        <button class="btn btn-minier btn-primary ng-binding"  onclick="getIncomeStatementReport('thisweek')">
                            Tuần này <i class="icon-angle-down icon-on-right bigger-110"></i>
                        </button>
                        <ul data-json="{{json_encode($summary->work)}}" id="dropdown-caret"
                            class="dropdown-menu dropdown-menu-right dropdown-125 dropdown-lighter dropdown-close dropdown-caret">
                            <li data-ng-class="businessOption.value == 'thisweek' ? 'active' : ''"
                                class="active">
                                <a data-ng-class="businessOption.value == 'thisweek' ? 'blue' : ''"
                                   onclick="getIncomeStatementReport('thisweek')"
                                   class="ng-binding blue">
                                    <i class="icon-caret-right bigger-110"
                                       data-ng-show="businessOption.value == 'thisweek'"></i>&nbsp;

                                    Tuần này
                                </a>
                            </li>
                            <li
                                data-ng-class="businessOption.value == 'lastweek' ? 'active' : ''">
                                <a data-ng-class="businessOption.value == 'lastweek' ? 'blue' : ''"
                                    onclick="getIncomeStatementReport('lastweek')"
                                   class="ng-binding">
                                    <i class="icon-caret-right bigger-110 ng-hide"
                                       data-ng-show="businessOption.value == 'lastweek'"></i>&nbsp;

                                    Tuần trước
                                </a>
                            </li>
                            <li
                                data-ng-class="businessOption.value == 'thismonth' ? 'active' : ''">
                                <a data-ng-class="businessOption.value == 'thismonth' ? 'blue' : ''"
                                onclick="getIncomeStatementReport('thismonth')"
                                   class="ng-binding">
                                    <i class="icon-caret-right bigger-110 ng-hide"
                                       data-ng-show="businessOption.value == 'thismonth'"></i>&nbsp;

                                    Tháng này
                                </a>
                            </li>
                            <li
                                data-ng-class="businessOption.value == 'lastmonth' ? 'active' : ''">
                                <a data-ng-class="businessOption.value == 'lastmonth' ? 'blue' : ''"
                                    onclick="getIncomeStatementReport('lastmonth')"
                                   class="ng-binding">
                                    <i class="icon-caret-right bigger-110 ng-hide"
                                       data-ng-show="businessOption.value == 'lastmonth'"></i>&nbsp;

                                    Tháng trước
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="widget-body" style="border: none; min-height: 144px;">
                <div class="widget-main dimensionReport">
                    <div class="row">
                        <div class="col-xs-7 info ng-binding">
                            Tiền bán hàng
                            <i class="icon-exclamation-sign bigger-120 blue ng-scope ng-hide"
                               data-ng-show="dashboard.business.saleReturnRevenue > 0"
                               tooltip-placement="right"
                               tooltip-html-unsafe="Bán hàng: <b>409,240,480 </b><br/>Xuất trả NCC: <b>0</b>"></i>
                        </div>
                        <div class="col-xs-5 data text-right grossRevenue">
                            <a
                               data-ng-if="dashboard.business. > 0"
                               data-ng-click="redirectToRevenue()"
                               class="black ng-binding ng-scope"
                               style="text-decoration: underline !important;">{{ $summary->work['week']['total'] }}</a>
                        </div>
                        <div has-permission="POSIM_Dashboard_Admin" class="col-xs-7 info ng-binding">
                            Lãi gộp
                        </div>
                        <div has-permission="POSIM_Dashboard_Admin" class="col-xs-5 data text-right">
                            <a
                               data-ng-if="dashboard.business.grossProfit != 0"
                               data-ng-click="redirectToProfit()"
                               class="black ng-binding ng-scope"
                               style="text-decoration: underline !important;">0</a>

                        </div>
                        <div class="col-xs-7 info ng-binding">
                            Số đơn hàng
                        </div>
                        <div class="col-xs-5 data text-right totalOrder">
                            <a
                               class="black ng-binding ng-scope"
                               style="text-decoration: underline !important;"
                               data-ng-if="dashboard.business.saleOrders > 0"
                               data-ng-click="getReportDetail(dimensionReport.totalOrder)"
                               title="Click để xem danh sách đơn hàng">{{number_format($summary->work['week']['total_order'])}}</a>
                        </div>
                        <div class="col-xs-7 info ng-binding ">
                            Tiền bán hàng/Số đơn hàng
                        </div>
                        <div class="col-xs-5 data text-right ng-binding avg">
                            @if($summary->work['week']['total_order']>0)
                            {{number_format(intval($summary->work['week']['total'])/intval($summary->work['week']['total_order']))}}
                            @else
                            0
                            @endif
                        </div>
                        <div class="col-xs-7 info ng-binding">

                            Hàng khách trả
                        </div>
                        <div class="col-xs-5 data text-right">
                            <span class="black ng-binding ng-scope" data-ng-if="dashboard.business.itemsReturn == 0">0</span>
                        </div>
                    </div>
                </div>
                <!-- /.widget-main -->
            </div>
            <!-- /.widget-body -->
        </div>
        <!-- /.widget-box -->
    </div>
    <!-- /.col -->
    <div class="col-6 col-lg-4">
        <div class="widget-box bd-orange" style="clear: both; min-height: 144px;">
            <div
                 class="widget-header widget-header-flat infobox-orange infobox-dark">
                <h4 class="widget-title ng-binding">
                    <i class="icon-tags"></i>
                    Thông tin kho
                </h4>
            </div>

            <div class="widget-body" style="border: none; min-height: 144px;">
                <div class="widget-main">
                    <div class="row">
                        <!-- ngIf: setting.allStores.length > 1 -->
                        <!-- ngIf: setting.allStores.length > 1 -->
                        <div class="col-xs-7 info ng-binding">

                            Tồn kho lâu
                        </div>
                        <div class="col-xs-5 data text-right">
                            <!-- ngIf: dashboard.stockInfo.longInventories == 0 -->
                            <!-- ngIf: dashboard.stockInfo.longInventories > 0 --><a
                               class="black ng-binding ng-scope"
                               style="text-decoration: underline !important;"
                               data-ng-if="dashboard.stockInfo.longInventories > 0"
                               data-ng-click="getReportDetail(dimensionReport.longTimeInventory)"
                               title="Click để xem danh sách hàng hóa">0</a>
                            <!-- end ngIf: dashboard.stockInfo.longInventories > 0 -->
                        </div>
                        <div class="col-xs-7 info ng-binding">

                            Hết hàng
                        </div>
                        <div class="col-xs-5 data text-right">
                            <!-- ngIf: dashboard.stockInfo.outOfStock == 0 -->
                            <!-- ngIf: dashboard.stockInfo.outOfStock > 0 --><a
                               class="black ng-binding ng-scope"
                               style="text-decoration: underline !important;"
                               data-ng-if="dashboard.stockInfo.outOfStock > 0"
                               data-ng-click="getReportDetail(dimensionReport.outOfStock)"
                               title="Click để xem danh sách hàng hóa">0</a>
                            <!-- end ngIf: dashboard.stockInfo.outOfStock > 0 -->
                        </div>
                        <div class="col-xs-7 info ng-binding">

                            Sắp hết hàng
                        </div>
                        <div class="col-xs-5 data text-right">
                            <!-- ngIf: dashboard.stockInfo.underMin == 0 -->
                            <!-- ngIf: dashboard.stockInfo.underMin > 0 --><a
                               class="black ng-binding ng-scope"
                               style="text-decoration: underline !important;"
                               data-ng-if="dashboard.stockInfo.underMin > 0"
                               data-ng-click="getReportDetail(dimensionReport.underMin)"
                               title="Click để xem danh sách hàng hóa">0</a>
                            <!-- end ngIf: dashboard.stockInfo.underMin > 0 -->
                        </div>
                        <div class="col-xs-7 info ng-binding">

                            Vượt định mức
                        </div>
                        <div class="col-xs-5 data text-right">
                            <!-- ngIf: dashboard.stockInfo.overMax == 0 -->
                            <!-- ngIf: dashboard.stockInfo.overMax > 0 --><a
                               class="black ng-binding ng-scope"
                               style="text-decoration: underline !important;"
                               data-ng-if="dashboard.stockInfo.overMax > 0"
                               data-ng-click="getReportDetail(dimensionReport.overMax)"
                               title="Click để xem danh sách hàng hóa">0</a>
                            <!-- end ngIf: dashboard.stockInfo.overMax > 0 -->
                        </div>
                    </div>
                </div>
                <!-- /.widget-main -->
            </div>
            <!-- /.widget-body -->
        </div>
        <!-- /.widget-box -->
    </div>
    <!-- /.col -->
    <div class="col-6 col-lg-4 mt-3 mt-lg-0">
        <div class="widget-box bd-green">
            <div
                 class="widget-header widget-header-flat infobox-green infobox-dark">
                <h4 class="widget-title ng-binding">
                    <i class="icon-barcode"></i>

                    Thông tin hàng hóa
                </h4>
            </div>
            <div class="widget-body" style="border: none; min-height: 144px;">
                <div class="widget-main">
                    <div class="row">
                        <div class="col-xs-7 info ng-binding">

                            Hàng hóa/Chủng loại
                        </div>
                        <div class="col-xs-5 data text-right">
                            <a href="#/product" class="black ng-binding"
                               style="text-decoration: underline !important;">{{$summary->total_product}} /
                               {{$summary->total_product}}</a>
                        </div>
                        <div class="col-xs-7 info ng-binding">

                            Chưa có giá bán
                        </div>
                        <div class="col-xs-5 data text-right">
                            <!-- ngIf: dashboard.itemInfo.notAssignPrice == 0 -->
                            <!-- ngIf: dashboard.itemInfo.notAssignPrice > 0 --><a
                               class="black ng-binding ng-scope"
                               style="text-decoration: underline !important;"
                               data-ng-if="dashboard.itemInfo.notAssignPrice > 0"
                               data-ng-click="getReportDetail(dimensionReport.notAssignPrice)"
                               title="Click để xem danh sách hàng hóa">{{$summary->total_product_price_null}} </a>
                            <!-- end ngIf: dashboard.itemInfo.notAssignPrice > 0 -->
                        </div>
                        <div class="col-xs-7 info ng-binding">

                            Chưa có giá vốn
                        </div>
                        <div class="col-xs-5 data text-right">
                            <!-- ngIf: dashboard.itemInfo.notAssignCOGS == 0 -->
                            <!-- ngIf: dashboard.itemInfo.notAssignCOGS > 0 --><a
                               class="black ng-binding ng-scope"
                               style="text-decoration: underline !important;"
                               data-ng-if="dashboard.itemInfo.notAssignCOGS > 0"
                               data-ng-click="getReportDetail(dimensionReport.notAssignCOGS)"
                               title="Click để xem danh sách hàng hóa">{{$summary->total_product_original_price_null}} </a>
                            <!-- end ngIf: dashboard.itemInfo.notAssignCOGS > 0 -->
                        </div>
                        <div class="col-xs-7 info ng-binding">

                            Hàng chưa phân loại
                        </div>
                        <div class="col-xs-5 data text-right">
                            <!-- ngIf: dashboard.itemInfo.itemsNotCategories == 0 -->
                            <!-- ngIf: dashboard.itemInfo.itemsNotCategories > 0 --><a
                               class="black ng-binding ng-scope"
                               style="text-decoration: underline !important;"
                               data-ng-if="dashboard.itemInfo.itemsNotCategories > 0"
                               data-ng-click="getReportDetail(dimensionReport.itemsNotCategories)"
                               title="Click để xem danh sách hàng hóa">0 </a>
                            <!-- end ngIf: dashboard.itemInfo.itemsNotCategories > 0 -->
                        </div>
                        <!-- ngIf: dashboard.stockInfo.stockError > 0 -->
                        <!-- ngIf: dashboard.stockInfo.stockError > 0 -->
                    </div>
                </div>
                <!-- /.widget-main -->
            </div>
            <!-- /.widget-body -->
        </div>
        <!-- /.widget-box -->
    </div>
    <!-- /.col -->
</div>
<style type="text/css">
.widget-main .info {
    font-size: 16px;
    line-height:1.8;
}
.widget-content .col-xs-7 {
    width: 58.333%;
}
.widget-content .col-xs-5 {
    width: 41.666%;
}
.widget-main .data {
    font-size: 16px;
    font-weight: bold;
}
.widget-header {
    box-sizing: content-box;
    position: relative;
    height: 46px;
    display: flex;
    align-items: center;
    justify-content: space-between;

}
.widget-header > .widget-caption, .widget-header > :first-child {
    line-height: 36px;
    padding: 0px;
    margin: 0px;
    display: inline;
}
.widget-content .widget-title{
    border: 0;
    color: #fff;
    font-size: 18px;
    font-weight:bold;
}
.widget-toolbar {
    display: inline-block;
    padding: 0px 10px;
    line-height: 37px;
    float: right;
    position: relative;
}
.dropdown-hover {
    position: relative;
}
.dropdown-hover:hover>.dropdown-menu {
    display: block;
}
#dropdown-caret li{
    cursor: pointer;
}
.widget-box a{
    color: #393939;
}
</style>
@push('js')
<script>
    function getIncomeStatementReport(value)
    {
        // console.log(value,$("#dropdown-caret").attr('data-json'));
        data = JSON.parse($("#dropdown-caret").attr('data-json'));
        if(value == "thismonth")
        {
            $('.dimensionReport').find('.grossRevenue').html(data.month.total);
            $('.dimensionReport').find('.totalOrder').html(data.month.total_order);
            $('.dimensionReport').find('.avg').html(data.month.avg);
        }
        else if(value == "lastmonth"){
            $('.dimensionReport').find('.grossRevenue').html(data.last_month.total);
            $('.dimensionReport').find('.totalOrder').html(data.last_month.total_order);
            $('.dimensionReport').find('.avg').html(data.last_month.avg);
        }
        else if(value == "lastweek")
        {
            $('.dimensionReport').find('.grossRevenue').html(data.last_week.total);
            $('.dimensionReport').find('.totalOrder').html(data.last_week.total_order);
            $('.dimensionReport').find('.avg').html(data.last_week.avg);
        }
        else{
            $('.dimensionReport').find('.grossRevenue').html(data.week.total);
            $('.dimensionReport').find('.totalOrder').html(data.week.total_order);
            $('.dimensionReport').find('.avg').html(data.week.avg);
        }
    }
</script>
@endpush
</div>
