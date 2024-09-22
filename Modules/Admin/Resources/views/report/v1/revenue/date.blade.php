<div class="width-100 mb-3">
    <div class="infobox infobox-blue">
        <div class="infobox-icon">
            <i class="fa fa-dollar"></i>
        </div>
        <div class="infobox-data">
            <span
                    class="infobox-data-number ng-binding">{{ number_format($box->total_order) }}</span>
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
            <span
                    class="infobox-data-number ng-binding">{{ number_format($box->count_order) }}</span>
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
    <div class="col-xs-12 no-padding ng-hide" data-ng-show="reportTypeModel.isChart"
            id="chartSalerReportContainer" style="">
        @include('admin::report.revenue.chart')
    </div>

</div>
<div class="width-100 ng-scope" data-ng-if="reportTypeModel.type == 5">
    <!-- ngIf: monthlyReport.total > 0 || monthlyReport.totalReceiptVoucher > 0 || monthlyReport.totalPaid > 0 || summary.totalReturn > 0 || monthlyReport.totalExpense > 0 || monthlyReport.totalDebt > 0 -->
    <div class="alert alert-block alert-success clearfix ng-scope" data-ng-if="monthlyReport.total > 0 || monthlyReport.totalReceiptVoucher > 0 || monthlyReport.totalPaid > 0 || summary.totalReturn > 0 || monthlyReport.totalExpense > 0 || monthlyReport.totalDebt > 0">
        <div class="inline"><span class="ng-binding">Tiền thu về: </span><label class="bolder red ng-binding">0</label></div>
        <div class="padding-left-3 inline">
            <span class="ng-binding">Thu bán hàng : <label class="red ng-binding">0</label></span>
            <!-- ngIf: monthlyReport.totalCash > 0 || monthlyReport.totalBank > 0 || monthlyReport.totalCard > 0 -->
            <span data-ng-if="monthlyReport.totalCash > 0 || monthlyReport.totalBank > 0 || monthlyReport.totalCard > 0" class="ng-scope">
                (
                <!-- ngIf: monthlyReport.totalCash > 0 -->
                <span data-ng-if="monthlyReport.totalCash > 0" class="ng-binding ng-scope">Tiền mặt : <label class="red ng-binding">0</label></span>
                <!-- end ngIf: monthlyReport.totalCash > 0 -->
                <!-- ngIf: monthlyReport.totalBank > 0 -->
                <!-- ngIf: monthlyReport.totalCard > 0 -->
                )
            </span>
        </div>
        <!-- ngIf: monthlyReport.totalPaid > 0 -->
        <div class="padding-left-3 inline ng-scope" data-ng-if="monthlyReport.totalPaid > 0">
            <span class="ng-binding">Thu nợ : </span><label class="red ng-binding">0</label>
        </div>
    </div>
    <!-- end ngIf: monthlyReport.total > 0 || monthlyReport.totalReceiptVoucher > 0 || monthlyReport.totalPaid > 0 || summary.totalReturn > 0 || monthlyReport.totalExpense > 0 || monthlyReport.totalDebt > 0 -->
    <div class="table-responsive">
        <div class="dataTables_wrapper" role="grid">
            <table class="table table-hover table-bordered dataTable ng-scope ng-table" ng-table="monthlyReportParams"><!-- ngInclude: templates.header --><thead ng-include="templates.header" class="ng-scope"><tr class="ng-scope"> <!-- ngRepeat: column in $columns --> </tr>
                <tr ng-show="show_filter" class="ng-table-filters ng-scope ng-hide"> <!-- ngRepeat: column in $columns --> </tr></thead>
                <thead>
                    <tr>
                        <th class="width-27px"></th>
                        <th class="text-center ng-binding">Đơn hàng</th>
                        <th class="hidden-640 text-center ng-binding">Ngày bán</th>
                        <th class="hidden-640 text-center ng-binding">Thu ngân</th>
                        <th class="hidden-640 text-center ng-binding">Khách hàng</th>
                        <th class="hidden-768 text-center ng-binding">Số lượng</th>
                        <th class="hidden-768 text-center ng-binding">Thành tiền</th>
                        <th class="hidden-768 text-center ng-binding ng-scope" data-ng-if="monthlyReport.totalDiscount > 0">Giảm giá</th>
                        <th class="text-center ng-binding">Tổng tiền</th>
                        <th class="text-center ng-binding ng-scope" data-ng-if="monthlyReport.totalDebt > 0">Nợ</th>
                    </tr>
                </thead>
                @foreach ($orders as $r)
                <tbody data-ng-repeat="item in params.data" class="ng-scope">
                    <tr class="pointer" data-ng-class="item.type == 2 ? 'red' : ''" data-ng-click="collapseOrderDetail(item)">
                        <td>
                            <i class="blue icon-plus-sign" data-ng-class="item.$isShowDetail ? 'icon-minus-sign' : 'icon-plus-sign'" title="Xem chi tiết"></i>
                        </td>
                        <td class="text-center ng-binding">{{$r->code}}</td>
                        <td class="hidden-640 text-center ng-binding">{{date("d/m/Y H:i:s",strtotime($r->created_at))}}</td>
                        <td class="hidden-640 text-center ng-binding">Kho Thủ Đức</td>
                        <td class="hidden-640 text-center ng-binding">{{@$r->customer->full_name}}</td>
                        <td class="hidden-768 text-center ng-binding">{{number_format($r->qty)}}</td>
                        <td class="hidden-768 text-right ng-binding">{{number_format($r->total)}}</td>
                        <td class="hidden-768 text-right ng-binding ng-scope" data-ng-if="monthlyReport.totalDiscount > 0">
                            {{number_format($r->discount_value)}}
                        </td>
                        <td class="text-right ng-binding">{{number_format($r->total_paid)}}</td>
                        <td class="text-right ng-binding ng-scope" data-ng-if="monthlyReport.totalDebt > 0">{{number_format($r->debt)}}</td>
                    </tr>
                </tbody>
                @endforeach
            </table>
            <div class="paging" style="margin-top: 30px;" id="reportPaging">
                {!! $orders->links() !!}
            </div>
        </div>
    </div>
</div>
<script>
    $("#reportPaging a").click(function(e){
        e.preventDefault();
        page = $(this).text().trim();
        view_report(page);
    });
</script>
