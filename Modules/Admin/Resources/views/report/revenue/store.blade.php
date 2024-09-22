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
<div class="width-100 ng-scope" data-ng-if="reportTypeModel.type == 2 &amp;&amp; reportTypeModel.stores.length > 1">
    <div class="col-xs-12 no-padding ng-hide" data-ng-show="reportTypeModel.isChart" id="chartSalerReportContainer">
        <div id="chartStoreReport" style="min-width: 240px; min-height: 480px; max-width: 960px; max-height: 480px; position: relative;" data-role="chart" class="k-chart"><!--?xml version='1.0' ?--><svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="600px" height="400px" style="position: relative; display: block;"><defs id="k10398"><clipPath id="k10399"><path style="display: block; " d="M44 39 562.827 39 562.827 321.653 44 321.653 z" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path></clipPath><linearGradient id="k10501" gradientTransform="rotate(90)"> <stop offset="0%" style="stop-color:#fff;stop-opacity:0"></stop><stop offset="25%" style="stop-color:#fff;stop-opacity:0.3"></stop><stop offset="100%" style="stop-color:#fff;stop-opacity:0"></stop></linearGradient></defs><path style="display: block; " d="M0 0 600 0 600 400 0 400 z" stroke="" stroke-width="0" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#fff"></path><path style="display: block; " d="M44.5 39.5 563.5 39.5 563.5 322.5 44.5 322.5 z" stroke-width="0.1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path id="k10403" style="display: block; " data-model-id="k10402" d="M44 39 562.827 39 562.827 321.653 44 321.653 z" stroke="" stroke-linecap="square" stroke-linejoin="round" fill-opacity="0" stroke-opacity="1" fill="#fff"></path><g id="k10401"><path style="display: block; " data-model-id="k10402" d="M130.5 39.5 130.5 322.5" stroke="#dfdfdf" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " data-model-id="k10402" d="M217.5 39.5 217.5 322.5" stroke="#dfdfdf" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " data-model-id="k10402" d="M303.5 39.5 303.5 322.5" stroke="#dfdfdf" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " data-model-id="k10402" d="M390.5 39.5 390.5 322.5" stroke="#dfdfdf" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " data-model-id="k10402" d="M476.5 39.5 476.5 322.5" stroke="#dfdfdf" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " data-model-id="k10402" d="M563.5 39.5 563.5 322.5" stroke="#dfdfdf" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M44.5 39.5 44.5 322.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M40.5 39.5 44.5 39.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M40.5 322.5 44.5 322.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><g id="k10404" clip-path="url(#k10399)"><g id="k10498"><g><path id="k10392" style="display: block; " data-model-id="k10496" d="M44.5 124.5 485.5 124.5 485.5 237.5 44.5 237.5 z" stroke="#096ca1" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#0b87c9"></path><path id="k10497" style="display: block; " data-model-id="k10496" d="M44.5 124.5 485.5 124.5 485.5 237.5 44.5 237.5 z" stroke="#096ca1" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="url(#k10501)"></path></g></g></g><path style="display: block; " d="M44.5 322.5 563.5 322.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M44.5 322.5 44.5 326.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M130.5 322.5 130.5 326.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M217.5 322.5 217.5 326.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M303.5 322.5 303.5 326.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M390.5 322.5 390.5 326.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M476.5 322.5 476.5 326.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><path style="display: block; " d="M563.5 322.5 563.5 326.5" stroke="#8e8e8e" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><text id="k10400" data-model-id="k10499" x="5" y="184" fill-opacity="1" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323"><title> Ms Vi </title> Ms Vi</text><text id="k10386" data-model-id="k10385" x="37" y="342" fill-opacity="1" transform="translate(3.925,0.425) rotate(315,40.075,337.653)" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323">0</text><text id="k10422" data-model-id="k10421" x="98" y="342" fill-opacity="1" transform="translate(-6.327,25.174) rotate(315,136.798,337.653)" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323">1,000,000,000</text><text id="k10420" data-model-id="k10419" x="185" y="342" fill-opacity="1" transform="translate(-6.327,25.174) rotate(315,223.269,337.653)" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323">2,000,000,000</text><text id="k10418" data-model-id="k10417" x="271" y="342" fill-opacity="1" transform="translate(-6.327,25.174) rotate(315,309.74,337.653)" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323">3,000,000,000</text><text id="k10416" data-model-id="k10415" x="358" y="342" fill-opacity="1" transform="translate(-6.327,25.174) rotate(315,396.211,337.653)" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323">4,000,000,000</text><text id="k10414" data-model-id="k10413" x="444" y="342" fill-opacity="1" transform="translate(-6.327,25.174) rotate(315,482.683,337.653)" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323">5,000,000,000</text><text id="k10505" data-model-id="k10504" x="531" y="342" fill-opacity="1" transform="translate(-6.327,25.174) rotate(315,569.154,337.653)" style="font: 12px Arial,Helvetica,sans-serif; " fill="#232323">6,000,000,000</text></g><g><path style="display: block; " d="M214 10 383 10 383 34 214 34 z" stroke="" stroke-width="0" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="none"></path><text id="k10391" data-model-id="k10390" x="233" y="26" fill-opacity="1" style="font: 12px Arial,Helvetica,sans-serif; cursor: pointer;" fill="#232323">Tiền bán hàng</text><text id="k10389" data-model-id="k10388" x="330" y="26" fill-opacity="1" style="font: 12px Arial,Helvetica,sans-serif; cursor: pointer;" fill="#232323">Trả hàng</text><path style="display: block; cursor: pointer;" data-model-id="k10390" d="M219.5 19.5 226.5 19.5 226.5 26.5 219.5 26.5 z" stroke="#0b87c9" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#0b87c9"></path><path style="display: block; cursor: pointer;" data-model-id="k10388" d="M316.5 19.5 323.5 19.5 323.5 26.5 316.5 26.5 z" stroke="#e8b110" stroke-width="1" stroke-linecap="square" stroke-linejoin="round" fill-opacity="1" stroke-opacity="1" fill="#e8b110"></path></g></svg><div class="k-tooltip" style="position: absolute; font: 12px Arial, Helvetica, sans-serif; border: 1px solid rgb(11, 135, 201); opacity: 1; background-color: rgb(11, 135, 201); top: 91px; left: 311px; display: none;">Tiền bán hàng: 5,096,081,619</div></div>
    </div>
    <div class="table-responsive" data-ng-show="!reportTypeModel.isChart">
        <div class="dataTables_wrapper" role="grid">
            <table class="table table-hover table-bordered dataTable ng-scope ng-table" ng-table="storeReportParams">
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
                        <th class="width-27px"></th>
                        <th class="text-center ng-binding">Cửa hàng</th>
                        <th class="text-center ng-binding">Tiền bán hàng </th>
                        <th class="text-center ng-binding">Số đơn hàng </th>
                        <th class="text-center ng-binding">Hàng hóa bán </th>
                        <th class="text-center ng-binding">Tiền trả hàng</th>
                        <th class="text-center ng-binding">Đơn hàng trả </th>
                        <th class="text-center ng-binding">Hàng hóa trả </th>
                    </tr>
                </thead>
                <!-- ngRepeat: item in params.data -->
                @foreach ($orders as $r)
                <tbody data-ng-repeat="item in params.data" class="ng-scope">
                    <tr class="pointer" data-ng-click="collapseDetail(item)">
                        <td>
                            <i class="blue icon-plus-sign"
                               data-ng-class="item.$isShowDetail ? 'icon-minus-sign' : 'icon-plus-sign'"
                               title="Xem chi tiết"></i>
                        </td>
                        <td class="text-center ng-binding">{{@$r->store->name}}</td>
                        <td class="text-right ng-binding">{{number_format($r->total)}}</td>
                        <td class="text-center ng-binding">{{number_format($r->total_order)}}</</td>
                        <td class="text-center ng-binding">{{number_format($r->total_order_detail)}}</</td>
                        <td class="text-right ng-binding">0</td>
                        <td class="text-center ng-binding">0</td>
                        <td class="text-center ng-binding">0</td>
                    </tr>
                    <!-- ngIf: item.$isShowDetail -->
                </tbody><!-- end ngRepeat: item in params.data -->
                @endforeach
            </table>
            {{-- <div ng-table-pagination="params" template-url="templates.pagination"
                 class="row ng-scope ng-isolate-scope">

                <div ng-include="templateUrl" class="col-sm-12 pull-right ng-scope">
                    <div class="dataTables_paginate paging_bootstrap ng-scope">

                        <ul class="pagination">

                            <li class="disabled hidden-768"> <a ng-show="lastpage > 2" class="ng-hide">Trang
                                </a><input type="text"
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
</div>
