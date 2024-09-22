@extends('admin::layouts.master')
@section('header')
    @include('admin::components.header')
@endsection
@section('content')
    <div class="payment-content">
        <div class="row-fluid">
            <div class="nav nav-tabs" ng-transclude="">
                <li ng-class="{active: selected}" title="Tổng quan" template-url="Payment/Summary"
                    icon="icon-dashboard" class="ng-scope ng-isolate-scope active"><a href=""
                       ng-click="select()"><i class="blue bigger-120 icon-dashboard" ng-class="icon"></i>
                        <span class="hidden-640 ng-binding">Tổng quan</span></a></li>
                <li ng-class="{active: selected}" title="Thu" template-url="Payment/ReceiptVoucherIndex"
                    icon="icon-signin" class="ng-scope ng-isolate-scope">
                    <a href="{{route('admin.payment.receipt_voucher')}}">
                       <i class="blue bigger-120 icon-signin" ng-class="icon"></i> <span
                              class="hidden-640 ng-binding">Thu</span></a>
                </li>
                {{-- <li ng-class="{active: selected}" title="Chi" template-url="Payment/PaymentIndex"
                            icon="icon-file-text" class="ng-scope ng-isolate-scope"><a href=""
                               ng-click="select()"><i class="blue bigger-120 icon-file-text" ng-class="icon"></i>
                                <span class="hidden-640 ng-binding">Chi</span></a></li>
                        <li ng-class="{active: selected}" title="Sổ quỹ" template-url="Payment/AccountingBooks"
                            icon="icon-book" class="ng-scope ng-isolate-scope"><a href=""
                               ng-click="select()"><i class="blue bigger-120 icon-book" ng-class="icon"></i> <span
                                      class="hidden-640 ng-binding">Sổ quỹ</span></a></li>
                    </div> --}}
            </div>
            <div class="row-fluid">
                <!-- ngInclude: undefined -->
                <ng-include src="templateUrl" class="ng-scope">
                    <div data-ng-controller="accountingSummaryController" class="ng-scope">
                        <div class="search-box">
                            {{-- <div class="checkbox inline">
                                    <label data-ng-show="option.show" class="ng-hide">
                                        <input type="checkbox" class="ace ng-pristine ng-valid"
                                               data-ng-model="option.checked"
                                               data-ng-change="getSummary(option.checked)">
                                        <span class="lbl hidden-1200 ng-binding"> Xem theo cửa hàng</span>
                                    </label>
                                </div> --}}
                            <span class="k-widget k-datepicker k-header s1"
                                  style="width: 120px;display:inline-block">
                                <input id="fromDate" placeholder="Từ ngày" class="s1 k-input"
                                       style="width: 100%;" type="text" autocomplete="off">
                            </span>
                            <span class="hidden-320">-</span>
                            <span class="k-widget k-datepicker k-header s1"
                                  style="width: 120px;display:inline-block">
                                <input id="toDate" placeholder="Đến ngày" class="s1 k-input" style="width: 100%;"
                                       type="text" autocomplete="off">
                            </span>
                            <div class="btn-group hidden-640">
                                <button type="button"
                                        class="btn btn-primary btn-outline hidden-768 ng-binding ng-pristine ng-valid"
                                        ng-model="dateRange" ng-class="{1:'clicked'}[selected]"
                                        ng-click="selectRange(1)">Tuần</button>
                                <button type="button"
                                        class="btn btn-primary btn-outline hidden-1200 ng-binding ng-pristine ng-valid"
                                        ng-model="dateRange" ng-class="{2:'clicked'}[selected]"
                                        ng-click="selectRange(2)">Tháng</button>
                                <button type="button"
                                        class="btn btn-primary btn-outline hidden-1200 ng-binding ng-pristine ng-valid"
                                        ng-model="dateRange" ng-class="{3:'clicked'}[selected]"
                                        ng-click="selectRange(3)">Quý</button>
                                <button type="button"
                                        class="btn btn-primary btn-outline dropdown-toggle ng-pristine ng-valid"
                                        data-toggle="dropdown" ng-model="dateRange"
                                        ng-class="{6:'clicked', 7:'clicked', 8:'clicked', 9:'clicked'}[selected]">
                                    <i class="icon-caret-down"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right pull-right" role="menu">
                                    <li class="show-640" ng-class="{1:'active'}[selected]"><a
                                           ng-model="dateRange" ng-click="selectRange(1)"
                                           class="ng-binding ng-pristine ng-valid">Tuần này</a></li>
                                    <li ng-class="{6:'active'}[selected]"><a ng-model="dateRange"
                                           ng-click="selectRange(6)"
                                           class="ng-binding ng-pristine ng-valid">Tuần trước</a></li>
                                    <li class="show-768" ng-class="{2:'active'}[selected]"><a
                                           ng-model="dateRange" ng-click="selectRange(2)"
                                           class="ng-binding ng-pristine ng-valid">Tháng này</a></li>
                                    <li ng-class="{7:'active'}[selected]"><a ng-model="dateRange"
                                           ng-click="selectRange(7)"
                                           class="ng-binding ng-pristine ng-valid">Tháng trước</a></li>
                                    <li class="show-1200" ng-class="{3:'active'}[selected]"><a
                                           ng-model="dateRange" ng-click="selectRange(3)"
                                           class="ng-binding ng-pristine ng-valid">Quý này</a></li>
                                    <li ng-class="{8:'active'}[selected]"><a ng-model="dateRange"
                                           ng-click="selectRange(8)"
                                           class="ng-binding ng-pristine ng-valid">Quý trước</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="page-content" data-ng-init="initSummary()">
                            <div class="row">
                                <div class="col-6 col-lg-3 margin-bottom-10 mb-2 mb-lg-0">
                                    <div
                                         class="col-md-12 infobox-green infobox-dark no-padding suno-report-box text-center">
                                        <span class="bigger-120 info-title ng-binding">Tồn quỹ</span><br>
                                        <span
                                              class="bigger-140 infobox-data-number ng-binding">0</span>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-3 margin-bottom-10 mb-2 mb-lg-0">
                                    <div
                                         class="col-md-12 infobox-blue infobox-dark no-padding suno-report-box text-center">
                                        <span class="bigger-120 info-title ng-binding">Đầu kỳ</span><br>
                                        <span class="bigger-140 infobox-data-number ng-binding">0</span>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-3 margin-bottom-10">
                                    <div
                                         class="col-md-12 infobox-red infobox-dark no-padding suno-report-box text-center">
                                        <span class="bigger-120 info-title ng-binding">Thu</span><br>
                                        <span
                                              class="bigger-140 infobox-data-number ng-binding">0</span>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-3">
                                    <div
                                         class="col-md-12 infobox-orange infobox-dark no-padding suno-report-box text-center">
                                        <span class="bigger-120 info-title ng-binding">Chi</span><br>
                                        <span
                                              class="bigger-140 infobox-data-number ng-binding">0</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-md-6">
                                    <div class="width-100">
                                        <div class="header suno-report-box-header ng-binding">
                                            DÒNG TIỀN THEO SỔ
                                        </div>
                                        <div class="body-content suno-report" >
                                            <div class="row" style="margin:0px;">
                                                <div class="col-md-4 data-title">
                                                    <b class="ng-binding">Tiền mặt</b>
                                                </div>
                                                <div class="col-md-8 text-right data-number">
                                                    <b class="ng-binding">0</b>
                                                </div>
                                            </div>
                                            <div class="row" style="margin:0px;">
                                                <div class="col-md-4 padding-left-30 data-title ng-binding">
                                                    Đầu kỳ
                                                </div>
                                                <div class="col-md-8 text-right data-number ng-binding">
                                                    0
                                                </div>
                                            </div>
                                            <div class="row" style="margin:0px;">
                                                <div class="col-md-4 padding-left-30 data-title ng-binding">
                                                    Thu
                                                </div>
                                                <div class="col-md-8 text-right data-number green ng-binding">
                                                    0
                                                </div>
                                            </div>
                                            <div class="row" style="margin:0px;">
                                                <div class="col-md-4 padding-left-30 data-title ng-binding">
                                                    Chi
                                                </div>
                                                <div
                                                     class="col-md-8 text-right data-number orange-2 ng-binding">
                                                    (0)
                                                </div>
                                            </div>
                                            <div class="row" style="margin:0px;">&nbsp;</div>
                                            <hr>
                                            <div class="row" style="margin:0px;">
                                                <div class="col-md-4 data-title">
                                                    <b class="ng-binding">Tài khoản</b>
                                                </div>
                                                <div class="col-md-8 text-right data-number">
                                                    <b class="ng-binding">0</b>
                                                </div>
                                            </div>
                                            <div class="row" style="margin:0px;">
                                                <div class="col-md-4 padding-left-30 data-title ng-binding">
                                                    Đầu kỳ
                                                </div>
                                                <div class="col-md-8 text-right data-number ng-binding">
                                                    0
                                                </div>
                                            </div>
                                            <div class="row" style="margin:0px;">
                                                <div class="col-md-4 padding-left-30 data-title ng-binding">
                                                    Thu
                                                </div>
                                                <div class="col-md-8 text-right data-number green ng-binding">
                                                    0
                                                </div>
                                            </div>
                                            <div class="row" style="margin:0px;">
                                                <div class="col-md-4 padding-left-30 data-title ng-binding">
                                                    Chi
                                                </div>
                                                <div
                                                     class="col-md-8 text-right data-number orange-2 ng-binding">
                                                    (0)
                                                </div>
                                            </div>
                                            <div class="row" style="margin:0px;">&nbsp;</div>
                                            <div class="row" style="margin:0px;">&nbsp;</div>
                                        </div>
                                    </div>
                                    <div class="width-100">
                                        <div class="header suno-report-box-header ng-binding">
                                            DÒNG TIỀN THEO HẠNG MỤC
                                        </div>
                                        <div class="body-content suno-report">
                                            <div class="row" style="margin:0px;">
                                                <div class="col-md-4 data-title">
                                                    <b class="ng-binding">Thu</b>
                                                </div>
                                                <div class="col-md-8 text-right data-number green">
                                                    <b class="ng-binding">0</b>
                                                </div>
                                            </div>

                                            <div class="row" style="margin:0px;">
                                                <div class="col-md-4 padding-left-30 data-title ng-binding">
                                                    Thu bán hàng
                                                </div>
                                                <div class="col-md-8 text-right data-number green ng-binding">
                                                    0
                                                </div>
                                            </div>
                                            <div class="row" style="margin:0px;">
                                                <div class="col-md-4 padding-left-30 data-title ng-binding">
                                                    Thu trả hàng NCC
                                                </div>
                                                <div class="col-md-8 text-right data-number green ng-binding">
                                                    0
                                                </div>
                                            </div>
                                            <div class="row" style="margin:0px;">
                                                <div class="col-md-4 padding-left-30 data-title ng-binding">
                                                    Góp vốn
                                                </div>
                                                <div class="col-md-8 text-right data-number green ng-binding">
                                                    0
                                                </div>
                                            </div>
                                            <div class="row" style="margin:0px;">
                                                <div class="col-md-4 padding-left-30 data-title ng-binding">
                                                    Thu khác
                                                </div>
                                                <div class="col-md-8 text-right data-number green ng-binding">
                                                    0
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row" style="margin:0px;">
                                                <div class="col-md-4 data-title">
                                                    <b class="ng-binding">Chi</b>
                                                </div>
                                                <div class="col-md-8 text-right data-number orange-2">
                                                    <b class="ng-binding">(0)</b>
                                                </div>
                                            </div>
                                            <div class="row" style="margin:0px;">
                                                <div class="col-md-4 padding-left-30 data-title ng-binding">
                                                    Mua hàng
                                                </div>
                                                <div
                                                     class="col-md-8 text-right data-number orange-2 ng-binding">
                                                    (0)
                                                </div>
                                            </div>
                                            <div class="row" style="margin:0px;">
                                                <div class="col-md-4 padding-left-30 data-title ng-binding">
                                                    Khách trả hàng
                                                </div>
                                                <div
                                                     class="col-md-8 text-right data-number orange-2 ng-binding">
                                                    (0)
                                                </div>
                                            </div>
                                            <div class="row" style="margin:0px;">
                                                <div class="col-md-4 padding-left-30 data-title ng-binding">
                                                    Chi phí
                                                </div>
                                                <div
                                                     class="col-md-8 text-right data-number orange-2 ng-binding">
                                                    (0)
                                                </div>
                                            </div>
                                            <div class="row" style="margin:0px;">
                                                <div class="col-md-4 padding-left-30 data-title ng-binding">
                                                    Rút vốn
                                                </div>
                                                <div
                                                     class="col-md-8 text-right data-number orange-2 ng-binding">
                                                    (0)
                                                </div>
                                            </div>
                                            <div class="row" style="margin:0px;">
                                                <div class="col-md-4 padding-left-30 data-title ng-binding">
                                                    Chi khác
                                                </div>
                                                <div
                                                     class="col-md-8 text-right data-number orange-2 ng-binding">
                                                    (0)
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-6 col-md-6">
                                <div class="width-100">
                                        <div class="header suno-report-box-header ng-binding">
                                            PHẢI THU / PHẢI TRẢ
                                        </div>
                                        <div class="body-content suno-report">
                                            <div class="row" style="margin:0px;">
                                                <div class="col-md-4 data-title">
                                                    <b class="ng-binding">Khoản phải thu</b>
                                                </div>
                                                <div class="col-md-8 text-right data-number">
                                                    <b class="ng-binding">0</b>
                                                </div>

                                            </div>
                                            <div class="row" style="margin:0px;"
                                                 data-ng-show="summary.mustReceiptCustomer > 0">
                                                <div class="col-md-4 padding-left-30 data-title ng-binding">
                                                    Khách hàng <a data-ng-click="getMustReceipt(1)"><i
                                                           class="green ng-binding">(Xem chi tiết)</i></a>
                                                </div>
                                                <div class="col-md-8 text-right data-number">
                                                    <span class="ng-binding">0</span>
                                                </div>
                                            </div>
                                            <div class="row ng-hide" style="margin:0px;"
                                                 data-ng-show="summary.mustReceiptOrder > 0">
                                                <div class="col-md-4 padding-left-30 data-title ng-binding">
                                                    Đơn hàng <a data-ng-click="getMustReceipt(2)"><i
                                                           class="green ng-binding">(Xem chi tiết)</i></a>
                                                </div>
                                                <div class="col-md-8 text-right data-number">
                                                    <span class="ng-binding">0</span>
                                                </div>
                                            </div>
                                            <div class="row ng-hide" style="margin:0px;"
                                                 data-ng-show="summary.mustReceiptSupplier > 0">
                                                <div class="col-md-4 padding-left-30 data-title ng-binding">
                                                    Nhà cung cấp <a data-ng-click="getMustReceipt(3)"><i
                                                           class="green ng-binding">(Xem chi tiết)</i></a>
                                                </div>
                                                <div class="col-md-8 text-right data-number">
                                                    <span class="ng-binding">0</span>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row" style="margin:0px;">
                                                <div class="col-md-4 data-title">
                                                    <b class="ng-binding">Khoản phải trả</b>
                                                </div>
                                                <div class="col-md-8 text-right data-number">
                                                    <b class="ng-binding">(0)</b>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div type="text/ng-template" id="modalMustReceipt.html" class="ng-scope" style="display: none">
                        <div class="modal-header no-padding">
                            <div class="table-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" data-ng-click="closeModal()">
                                    <span class="white">×</span>
                                </button>
                                {{"popupTitle"}}
                            </div>
                        </div>
                        <div class="modal-body padding-10">
                            <div slimscroll="{height: '485px'}">
                                <table class="table table-striped table-bordered table-hover" ng-table="tableParams">
                                    <thead>
                                        <tr role="row" ng-show="modalType == 1">
                                            <th class="center border hidden-480">{{'Customer_Code_Header' }}</th>
                                            <th class="center border">{{'Customer_Name_Header' }}</th>
                                            <th class="center border">{{'Customer_Phone_Header' }}</th>
                                            <th class="sorting center border hidden">{{'Customer_Trans_Count' }}</th>
                                            <th class="sorting center border"><span class="hidden-320">{{'Customer_Total_Header' }}</span> <span class="show-320">{{'' }}</span></th>
                                            <th class="sorting center border hidden-480">{{'Customer_Debt_Header' }}</th>
                                        </tr>

                                        <tr role="row" ng-show="modalType == 2 || modalType == 3">
                                            <th class="text-center">
                                                {{'Order_Code' }}
                                            </th>
                                            <th class="hidden-640 text-center">
                                                <span>{{'Store' }}</span>
                                            </th>
                                            <th class="text-center hidden-640">
                                                <span>{{'Cashier' }}</span>
                                            </th>
                                            <th class="text-center">{{'Sale_Date' }}</th>
                                            <th class="hidden-480 text-center">
                                                <i class="icon-time bigger-110 hidden-480"></i>
                                                {{'Debt' }}
                                            </th>
                                        </tr>

                                    </thead>
                                    <tbody ng-show="modalType == 2 || modalType == 3">
                                        <tr data-ng-repeat="order in params.data">
                                            <td class="text-center">
                                                <a target="_blank" title="" data-ng-if="order.saleTypeID == 1" data-ng-href="#/order/edit/{{'order.saleOrderId'}}">
                                                    {{-- {{order.saleOrderCode}} --}}
                                                </a>
                                                <a target="_blank" title="" data-ng-if="order.saleTypeID == 3 || order.saleTypeID == 2" data-ng-href="#/order/online/{{'order.saleOrderId'}}">
                                                    {{-- {{order.saleOrderCode}} --}}
                                                </a>
                                                <a target="_blank" title="" data-ng-if="order.saleTypeID == 4" data-ng-href="#/sale/return/detail/{{'order.saleOrderId'}}">
                                                    {{-- {{order.saleOrderCode}} --}}
                                                </a>
                                            </td>
                                            <td class="text-center">{{'getStore(order.storeId)'}}</td>
                                            <td class="text-center">{{'getUser(order.cashier)'}}</td>
                                            <td class="text-center">{{'formatdate(order.saleOrderDate)'}}</td>
                                            <td class="hidden-480 text-right ng-binding" data-ng-class="{true: 'red', false: ''}[order.paymentBalance != 0]">
                                                {{"order.paymentBalance"}}
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tbody ng-show="modalType == 1">
                                        <tr data-ng-repeat="item in params.data">
                                            <td class="center hidden-480">
                                                <a  target="_blank"  ng-href="{{'#/customer/detail/'. 'item.customerId'}}">{{'item.code'}}</a>
                                            </td>
                                            <td class="center">
                                                <a target="_blank" ng-href="{{'#/customer/detail/'.'item.customerId'}}">{{'item.name'}}</a>
                                            </td>
                                            <td class="center">
                                                {{-- {{item.phone}} --}}
                                            </td>
                                            <td class="text-right hidden">
                                                {{-- {{item.transactionCount}} --}}
                                            </td>
                                            <td class="text-right">
                                                {{-- {{item.total | number: 0}} --}}
                                            </td>
                                            <td class="text-right hidden-480" ng-class="{'red': item.balance!=0}">
                                                {{-- {{item.balance | number: 0}} --}}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div style="float: left; margin-left: 20px; margin-top: -40px" ng-show="modalType == 1">
                                    <span class="hidden-480">{{'Customer_Count' }}: </span><span class="total-highlight">
                                        {{'totalCustomers'}}</span>
                                    <span has-permission="POSIM_Price_ReadBuyPrice">{{'Customer_Total' }}: </span>
                                    <span has-permission="POSIM_Price_ReadBuyPrice" class="total-highlight">{{'totalCustomerMoney'}} đ</span>
                                    <span has-permission="POSIM_Price_ReadBuyPrice" class="hidden-320">{{'Customer_Unpaid_Total' }}: </span>
                                    <span has-permission="POSIM_Price_ReadBuyPrice" class="total-highlight hidden-320">{{'totalCustomerBalance0'}} đ</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </ng-include>
            </div>
        </div>
    </div>
    @push('js')
        <link rel="stylesheet" href="{{ asset('public/themes/admin/carton/module/revenue.css') }}">
    @endpush
@endsection
