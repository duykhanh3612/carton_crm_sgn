<div class="row mb-5">
    <div class="col-xs-12 mb-2">
        <h4 class="dashboard-title ng-binding">
            <i class="fa fa-signal"></i>&nbsp;Hoạt động hôm nay
        </h4>
    </div>
    <div class="item col-lg-3 col-md-6 mb-3 mb-lg-0">
        <div class="col-xs-12 report-box infobox-green infobox-dark">
            <div class="infobox-icon">
                <i class="fa fa-signal"></i>
            </div>
            <div class="infobox-data">
                <div class="infobox-title ng-binding">
                    Tiền bán hàng
                </div>
                <span
                      class="infobox-data-number center ng-binding">{{number_format(intval(@$summary->total))}}</span>
            </div>
        </div>
    </div>
    <div class="item col-lg-3 col-md-6 mb-3 mb-lg-0">
        <div class="col-xs-12 report-box infobox-blue infobox-dark">
            <div class="infobox-icon">
                <i class="fa fa-shopping-cart"></i>
            </div>
            <div class="infobox-data">
                <div class="infobox-title">
                    <!-- ngIf: dashboard.today.saleOrders == 0 -->
                    <!-- ngIf: dashboard.today.saleOrders > 0 -->
                    <span
                          style="cursor: pointer;"
                          data-ng-if="dashboard.today.saleOrders > 0"
                          data-ng-click="getReportDetail(dimensionReport.saleOrder)"
                          title="Click để xem danh sách đơn hàng"
                          class="ng-binding ng-scope">Số đơn hàng:</span>
                    <!-- end ngIf: dashboard.today.saleOrders > 0 -->
                    <!-- ngIf: dashboard.today.saleOrders > 0 -->
                    <a
                       class="white ng-binding ng-scope"
                       style="text-decoration: underline !important;"
                       data-ng-if="dashboard.today.saleOrders > 0"
                       data-ng-click="getReportDetail(dimensionReport.saleOrder)"
                       title="Click để xem danh sách đơn hàng">{{number_format(@$summary->saleOrder)}}</a>
                    <!-- end ngIf: dashboard.today.saleOrders > 0 -->
                </div>
                <span class="infobox-title">
                    <!-- ngIf: dashboard.today.itemsInOrder == 0 -->
                    <!-- ngIf: dashboard.today.itemsInOrder > 0 --><span
                          style="cursor: pointer;"
                          data-ng-if="dashboard.today.itemsInOrder > 0"
                          data-ng-click="getReportDetail(dimensionReport.saleItem)"
                          title="Click để xem danh sách hàng hóa"
                          class="ng-binding ng-scope">Số hàng hóa: </span>
                    <!-- end ngIf: dashboard.today.itemsInOrder > 0 -->
                    <!-- ngIf: dashboard.today.itemsInOrder > 0 -->
                    <a
                       class="white ng-binding ng-scope"
                       style="text-decoration: underline !important;"
                       data-ng-if="dashboard.today.itemsInOrder > 0"
                       data-ng-click="getReportDetail(dimensionReport.saleItem)"
                       title="Click để xem danh sách hàng hóa">{{number_format(@$summary->total_order_detail)}}</a>
                    <!-- end ngIf: dashboard.today.itemsInOrder > 0 -->
                </span>
            </div>
        </div>
    </div>
    <div class="item col-lg-3 col-md-6 ">
        <div class="col-xs-12  report-box infobox-red infobox-dark">
            <div class="infobox-icon">
                <i class="fa fa-undo"></i>
            </div>
            <div class="infobox-data">
                <div class="infobox-title">
                    <!-- ngIf: dashboard.today.itemsReturn == 0 --><span
                          data-ng-if="dashboard.today.itemsReturn == 0"
                          class="ng-binding ng-scope">Hàng khách trả</span>
                    <!-- end ngIf: dashboard.today.itemsReturn == 0 -->
                    <!-- ngIf: dashboard.today.itemsReturn > 0 -->
                </div>
                <div class="infobox-data-number text-center">
                    <!-- ngIf: dashboard.today.itemsReturn == 0 --><span
                          class="white ng-binding ng-scope"
                          data-ng-if="dashboard.today.itemsReturn == 0">0</span>
                    <!-- end ngIf: dashboard.today.itemsReturn == 0 -->
                    <!-- ngIf: dashboard.today.itemsReturn > 0 -->
                </div>
            </div>
        </div>
    </div>
    <div class="item col-lg-3 col-md-6 ">
        <div class="col-xs-12  report-box infobox-orange infobox-dark">
            <div class="infobox-icon hidden-1024">
                <i class="fa fa-truck"></i>
            </div>

            <div class="infobox-data">
                <div class="infobox-title">
                    <!-- ngIf: dashboard.today.onlineSaleOrders == 0 -->

                    <span
                          style="cursor: pointer;"
                          data-ng-if="dashboard.today.onlineSaleOrders > 0"
                          data-ng-click="getReportDetail(dimensionReport.onlineSaleOrder)"
                          title="Click để xem danh sách đơn đặt hàng"
                          class="ng-binding ng-scope">Đơn đặt hàng: </span>
                    <!-- end ngIf: dashboard.today.onlineSaleOrders > 0 -->
                    <a
                       class="white ng-binding ng-scope"
                       style="text-decoration: underline !important;"
                       data-ng-if="dashboard.today.onlineSaleOrders > 0"
                       data-ng-click="getReportDetail(dimensionReport.onlineSaleOrder)"
                       title="Click để xem danh sách đơn hàng">{{number_format(@$summary->saleOrder)}}</a>
                    <!-- end ngIf: dashboard.today.onlineSaleOrders > 0 -->
                </div>
                <span class="infobox-small">
                    <!-- ngIf: dashboard.today.confirmSaleOrders == 0 -->
                    <!-- ngIf: dashboard.today.confirmSaleOrders > 0 --><span
                          style="cursor: pointer;"
                          data-ng-if="dashboard.today.confirmSaleOrders > 0"
                          data-ng-click="openPopupDelivery()"
                          title="Click để xem danh sách đơn đã xác nhận"
                          class="ng-binding ng-scope">Xác nhận: </span>
                    <!-- end ngIf: dashboard.today.confirmSaleOrders > 0 -->
                    <!-- ngIf: dashboard.today.confirmSaleOrders > 0 --><a
                       class="white ng-binding ng-scope"
                       style="text-decoration: underline !important;"
                       data-ng-if="dashboard.today.confirmSaleOrders > 0"
                       data-ng-click="openPopupDelivery()"
                       title="Click để xem danh sách hàng hóa">{{number_format(@$summary->total_order_ship_confirm)}}</a>
                    <!-- end ngIf: dashboard.today.confirmSaleOrders > 0 -->
                </span>
                <span class="infobox-small">
                    <!-- ngIf: dashboard.today.onDeliverySaleOrders == 0 -->
                    <!-- ngIf: dashboard.today.onDeliverySaleOrders > 0 -->
                    <span
                          style="cursor: pointer;"
                          data-ng-if="dashboard.today.onDeliverySaleOrders > 0"
                          data-ng-click="openPopupOrderFinished()"
                          title="Click để xem danh sách đơn đang giao hàng"
                          class="ng-binding ng-scope">Giao hàng: </span>

                    <!-- ngIf: dashboard.today.onDeliverySaleOrders > 0 -->
                    <a
                       class="white ng-binding ng-scope"
                       style="text-decoration: underline !important;"
                       data-ng-if="dashboard.today.onDeliverySaleOrders > 0"
                       data-ng-click="openPopupOrderFinished()"
                       title="Click để xem danh sách hàng hóa">{{number_format(@$summary->total_order_ship_delivery)}}</a>

                </span>

            </div>

        </div>
    </div>

</div>
<style type="text/css">
    .dashboard-title {
        border-bottom: 4px #0b87c9 solid;
        margin-top: 5px;
        padding-bottom: 3px;
        display: inline-block;
        color: #0b87c9;
        font-size:2rem;
    }
    .report-content {
        margin: 0 -15px;
        background-color: #fff;
        position: relative;
        margin: 0;
        padding: 8px 20px 24px;
    }

    .infobox-dark {
        margin: 0;
        color: #fff;
        padding-left: 14px;
    }

    .widget-box, .report-box {
        border-radius: 4px;
        float: left;
        width: 100%;
        border-radius: 4px;
    }

    .report-box {
        display: inline-block;
        height: 80px;
        color: #555;
        background-color: #fff;
        box-shadow: none;
        border-radius: 15;
        margin: -1px 0 0 -1px;
        padding: 10px;
        vertical-align: middle;
        text-align: left;
        position: relative;
    }

    .report-box>.infobox-icon {
        display: inline-block;
        vertical-align: top;
        width: 30px;
    }
    .report-box>.infobox-icon i{
        font-size: 24px;
    }
    .report-box>.infobox-data {
        display: inline-block;
        border-width: 0;
        font-size: 13px;
        text-align: left;
        line-height: 21px;
        min-width: 130px;
        padding-left: 8px;
        position: relative;
        top: 0;
    }

    .report-box .infobox-title {
        font-size: 16px;
        display: flex;
        gap:20px;
        padding-bottom: 10px;
    }

    .report-box.infobox-dark,
    .report-box.infobox-dark>.infobox-data>.infobox-content {
        color: #fff;
    }

    .report-box>.infobox-data>.infobox-data-number {
        display: block;
        font-size: 22px;
        margin: 2px 0 4px;
        position: relative;
        text-shadow: 1px 1px 0 rgba(0, 0, 0, .15);
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
 
</style>
