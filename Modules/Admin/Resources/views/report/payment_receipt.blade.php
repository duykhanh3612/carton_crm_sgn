@extends('admin::layouts.master')
@section('header')
    @include('admin::components.header')
@endsection
@section('content')
@php
$payments = collect(get_data("payment_type","","**"))->keyBy("id");
@endphp
    <div class="row payment-content">
        <div class="row">
            <div class="row-fluid"
                id="PaymentTabSet">
                <div class="row-fluid">
                    <div class="nav nav-tabs"
                        ng-transclude="">
                        <li class="ng-scope ng-isolate-scope"
                            title="Tổng quan"
                            template-url="Payment/Summary"
                            icon="icon-dashboard">
                            <a ng-click="select()"
                                href="{{ route('admin.payment') }}"><i class="blue bigger-120 icon-dashboard"
                                    ng-class="icon"></i>
                                <span class="hidden-640 ng-binding">Tổng quan</span></a>
                        </li>
                        <li class="ng-scope ng-isolate-scope active"
                            ng-class="{active: selected}"
                            title="Thu"
                            template-url="Payment/ReceiptVoucherIndex"
                            icon="icon-signin">
                            <a href="{{ route('admin.payment.receipt_voucher') }}">
                                <i class="blue bigger-120 icon-signin"
                                    ng-class="icon"></i> <span class="hidden-640 ng-binding">Thu</span></a>
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
                        <ng-include class="ng-scope"
                            src="templateUrl">
                            <div class="ng-scope"
                                data-ng-controller="receiptVoucherController">
                                <div style="position:absolute; top:-25px; right:28px; text-align:right; z-index:99;">
                                    <span class="k-widget k-datepicker k-header s1"
                                        style="width: 120px;display:inline-block">
                                        <input class="s1 k-input"
                                            id="fromDate"
                                            type="text"
                                            style="width: 100%;"
                                            placeholder="Từ ngày"
                                            autocomplete="off">
                                    </span>
                                    <span class="hidden-320">-</span>
                                    <span class="k-widget k-datepicker k-header s1"
                                        style="width: 120px;display:inline-block">
                                        <input class="s1 k-input"
                                            id="toDate"
                                            type="text"
                                            style="width: 100%;"
                                            placeholder="Đến ngày"
                                            autocomplete="off">
                                    </span>
                                    <div class="btn-group hidden-640">
                                        <button class="btn btn-primary btn-outline hidden-640 ng-binding ng-pristine ng-valid"
                                            ng-model="dateRange"
                                            ng-class="{1:'clicked'}[selected]"
                                            type="button"
                                            onclick="selectRange(1)">Tuần</button>
                                        <button class="btn btn-primary btn-outline hidden-768 ng-binding ng-pristine ng-valid"
                                            ng-model="dateRange"
                                            ng-class="{2:'clicked'}[selected]"
                                            type="button"
                                            onclick="selectRange(2)">Tháng</button>
                                        <button class="btn btn-primary btn-outline hidden-1200 ng-binding ng-pristine ng-valid"
                                            ng-model="dateRange"
                                            ng-class="{3:'clicked'}[selected]"
                                            type="button"
                                            onclick="selectRange(3)">Quý
                                        </button>
                                        <button class="btn btn-primary btn-outline dropdown-toggle ng-pristine ng-valid"
                                            data-toggle="dropdown"
                                            ng-model="dateRange"
                                            ng-class="{6:'clicked', 7:'clicked', 8:'clicked', 9:'clicked'}[selected]"
                                            type="button">
                                            <i class="icon-caret-down"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right pull-right"
                                            role="menu">
                                            <li class="show-640"
                                                ng-class="{1:'active'}[selected]">
                                                <a class="ng-binding ng-pristine ng-valid"
                                                    ng-model="dateRange"
                                                    onclick="selectRange(1)">Tuần
                                                    này</a>
                                            </li>
                                            <li ng-class="{6:'active'}[selected]"><a class="ng-binding ng-pristine ng-valid"
                                                    ng-model="dateRange"
                                                    onclick="selectRange(6)">Tuần
                                                    trước</a></li>
                                            <li class="show-768"
                                                ng-class="{2:'active'}[selected]"><a class="ng-binding ng-pristine ng-valid"
                                                    ng-model="dateRange"
                                                    ng-click="selectRange(2)">Tháng này</a></li>
                                            <li ng-class="{7:'active'}[selected]"><a class="ng-binding ng-pristine ng-valid"
                                                    ng-model="dateRange"
                                                    onclick="selectRange(7)">Tháng
                                                    trước</a></li>
                                            <li class="show-1200"
                                                ng-class="{3:'active'}[selected]"><a class="ng-binding ng-pristine ng-valid"
                                                    ng-model="dateRange"
                                                    ng-click="selectRange(3)">Quý này</a></li>
                                            <li ng-class="{8:'active'}[selected]"><a class="ng-binding ng-pristine ng-valid"
                                                    ng-model="dateRange"
                                                    onclick="selectRange(8)">Quý
                                                    trước</a></li>
                                        </ul>
                                    </div>
                                    {{-- <button class="btn btn-primary"
                                        data-ng-click="openCreateReceipt()"
                                        title="Tạo phiếu thu">
                                        <i class="icon-plus"></i>
                                        <span class="hidden-1400 hidden-1024 hidden-992 ng-binding">Tạo phiếu thu</span>
                                    </button> --}}
                                    <button class="btn btn-success btn-primary"
                                        data-ng-click="exportExcel()"
                                        title="Xuất excel">
                                        <i class="icon-download-alt white"></i>
                                        <span class="hidden-1400 hidden-1024 hidden-992 ng-binding">Xuất excel</span>
                                    </button>
                                </div>
                                <!-- /.page-header -->
                                <div class="page-content">
                                    <div class="row">
                                        <div class="col-sm-12"
                                            style="margin-bottom: 15px;">
                                            <div class="input-group">
                                                <input class="form-control ng-pristine ng-valid"  id="keyword"  type="text" placeholder="Nhập mã hóa đơn hoặc ghi chú để tìm kiếm">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-primary"
                                                        id="searchReceiptVoucher">
                                                        <i class="icon-search icon-on-right bigger-110"></i>
                                                        <span class="hidden-1200 ng-binding">Tìm kiếm</span>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-xs-12">
                                            <div class="table-responsive">
                                                <div class="dataTables_wrapper" role="grid">
                                                    <table class="table-bordered table-hover dataTable ng-scope ng-table table"
                                                        data-ng-table="tableReceiptVoucher">
                                                        <thead class="ng-scope" ng-include="templates.header">
                                                            <tr class="ng-scope">
                                                            </tr>
                                                            <tr class="ng-table-filters ng-scope ng-hide"
                                                                ng-show="show_filter">

                                                            </tr>
                                                        </thead>
                                                        <thead>
                                                            <tr role="row">
                                                                <th class="bolder ng-binding text-center">Ngày thu</th>
                                                                <th class="bolder hidden-768 ng-binding text-center">Mã
                                                                    phiếu</th>
                                                                <th class="bolder ng-binding text-right">Tiền thu</th>
                                                                <th class="bolder hidden-768 ng-binding text-center">Nhân
                                                                    viên</th>
                                                                {{-- <th class="bolder width-10 text-center">
                                                                    <select class="width-100 ng-pristine ng-valid"
                                                                        data-ng-model="store"
                                                                        data-ng-options="t.name for t in stores"
                                                                        data-ng-change="changeStore(store)">
                                                                        <option value="0"
                                                                            selected="selected">---Chọn
                                                                            cửa hàng---</option>
                                                                        <option value="1">Ms Vi</option>
                                                                    </select>
                                                                </th> --}}
                                                                <th class="bolder width-10 text-center">
                                                                    <select class="width-100 ng-pristine ng-valid"
                                                                        data-ng-model="paymentMethod"
                                                                        data-ng-options="t.name for t in paymentMethods"
                                                                        data-ng-change="changePaymentMethod(paymentMethod)">
                                                                        <option value="0"selected="selected">---Hình thức ---</option>

                                                                        @foreach ($payments as $payment)
                                                                        <option value="{{$payment->id}}">{{$payment->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </th>
                                                                {{-- <th class="bolder width-10 text-center">
                                                                    <select class="width-100 ng-pristine ng-valid"
                                                                        data-ng-model="category"
                                                                        data-ng-options="t.name for t in categories"
                                                                        data-ng-change="changeCategory(category)">
                                                                        <option value="0"
                                                                            selected="selected">
                                                                            ---Chọn---</option>
                                                                        <option value="1">Thu bán hàng</option>
                                                                        <option value="2">Thu trả hàng NCC</option>
                                                                        <option value="3">Thu cấn nợ trả hàng</option>
                                                                        <option value="4">Góp vốn</option>
                                                                        <option value="5">Thu khác</option>
                                                                    </select>
                                                                </th> --}}
                                                                <th class="ng-binding text-left">Ghi chú </th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            @foreach ($orders as $r)
                                                                <tr class="ng-scope"
                                                                    data-ng-repeat="accBooks in params.data">
                                                                    <td class="ng-binding text-center">

                                                                        {{ date('d/m/Y', strtotime($r->created_at)) }}
                                                                    </td>
                                                                    <td class="hidden-768 ng-binding text-center">
                                                                        {{ $r->code }}
                                                                    </td>
                                                                    <td class="text-right">
                                                                        <span class="green ng-binding">{{ number_format($r->total_paid) }}</span>
                                                                    </td>
                                                                    <td class="hidden-768 ng-binding text-center">
                                                                        {{ @$r->sale->full_name }}
                                                                    </td>
                                                                    {{-- <td class="width-10 ng-binding text-center">
                                                                        {{ @$r->store->name }}
                                                                    </td> --}}
                                                                    <td class="width-10 ng-binding text-center">
                                                                        {{ @$payments[$r->payments_type]->name }}
                                                                    </td>
                                                                    {{-- <td class="width-10 ng-binding text-center">
                                                                        {{ $r->category }}
                                                                    </td> --}}
                                                                    <td class="ng-binding text-left">{{ $r->note }}
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <i class="icon-print bigger-130"
                                                                            data-ng-click="print(accBooks)"></i>
                                                                        <i class="icon-trash bigger-130 ng-scope"
                                                                            data-ng-if="isRemove(accBooks)"
                                                                            data-ng-click="removeReceiptVoucher(accBooks)"></i>
                                                                    </td>
                                                                </tr>
                                                            @endforeach

                                                        </tbody>
                                                    </table>
                                                    <div class="row">
                                                        {{-- <div class="left col-sm-5"
                                                             style="margin-left: 20px; margin-top: -45px">
                                                            <span class="hidden-640 ng-binding">Số phiếu thu: </span><span
                                                                  class="total-highlight ng-binding">57420</span>
                                                            <button data-toggle="dropdown"
                                                                    class="btn btn-warning dropdown-toggle"
                                                                    style="padding:3px;">
                                                                <i class="icon-caret-down icon-on-right"></i>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <li style="padding:0px 10px 0px 10px;">
                                                                    <span class="ng-binding"> Tiền mặt: <b
                                                                           class="red ng-binding">26636</b></span>
                                                                    <span class="ng-binding"> - Thẻ: <b
                                                                           class="red ng-binding">4282</b></span>
                                                                    <span class="ng-binding"> - CK: <b
                                                                           class="red ng-binding">26502</b></span>
                                                                </li>
                                                            </ul>
                                                            <span class="show-640">/</span>
                                                            <span class="hidden-640 ng-binding">Tổng thu:</span>
                                                            <span class="total-highlight ng-binding">163,794,056,736</span>
                                                        </div> --}}
                                                        <div class="paging" style="padding-top: 10px;height:50px;">
                                                            {!! $orders->links() !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <script type="text/ng-template" id="modalReceipt.html">
                                <div class="modal-header no-padding margin-bottom-10">
                                    <div class="table-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" ng-click="closeModal();">
                                            <span class="white">&times;</span>
                                        </button>
                                        {{'Create_Receipt' }}
                                    </div>
                                </div>

                                <div class="modal-body no-padding">
                                    <form class="form-horizontal" role="form">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">{{'Voucher_Type' }}</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" data-ng-model="receiptType" data-ng-options="c.name for c in receiptTypes" data-ng-change="changeType(receiptType)"></select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">{{'Payment_Type' }}</label>
                                            <div class="col-sm-9">
                                                <div class="form-inline">
                                                    <label>
                                                        <input type="radio" class="ace" name="form-field-radio" ng-model="paymentMethod.choice" value="1" ng-checked="true">
                                                        <span class="lbl">{{'CASH' }}</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio" class="ace" name="form-field-radio" ng-model="paymentMethod.choice" value="3">
                                                        <span class="lbl">{{'BANK_TRANSFER' }}</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio" class="ace" name="form-field-radio" ng-model="paymentMethod.choice" value="2">
                                                        <span class="lbl">{{'CARD' }}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">{{'Store' }}</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" data-ng-model="selectedStore" data-ng-options="store.StoreName for store in grantedStores" data-ng-change="changeStore(selectedStore)"></select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">{{'Receipt_Date' }}</label>
                                            <div class="col-sm-9">
                                                <input type="text" k-ng-model="receiptVoucher.receivedDate" k-options="datePickerOptions" kendo-date-picker placeholder="Hôm nay" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">{{'Detail_Amount' }}</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" placeholder="{{'Amount_Placeholder' }}" data-ng-model="receiptVoucher.amount" auto-numeric="{vMin: 0, vMax: 99999999999999999999}" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">{{'Remark' }}</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" rows="3" data-ng-model="receiptVoucher.description" placeholder="{{'Add_Remark' }}"></textarea>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <div class="pull-right">
                                        <button class="btn" type="button" ng-click="closeModal();">
                                            <i class="icon-undo bigger-110"></i>
                                            {{'Close' }}
                                        </button>
                                        <button class="btn btn-primary" data-ng-disabled="receiptVoucher.amount == ''" data-ng-click="createReceiptVoucher()">
                                            <i class="icon-save bigger-110"></i>
                                            {{'Save' }}
                                        </button>
                                    </div>
                                </div>

                            </script>

                                </div>

                            </div>
                    </div>
                </div>
            </div>
            @push('js')
                <link href="{{ asset('public/themes/admin/carton/module/revenue.css') }}"
                    rel="stylesheet">
                <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css"
                    rel="stylesheet" />
                <!-- datetimepicker jQuery CDN -->
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
                <script>
                    function selectRange(value)
                    {
                        filter_type = value;
                        view_report();
                    }
                    function view_report() {
                        type = $("input[name=viewType]:checked").val();
                        $.ajax({
                            method: "POST",
                            url: "{{ route('admin.payment.receipt_voucher.type') }}",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                type: type, keyword : $("#keyword").val(), fromDate: $("#fromDate").val(), toDate: $("#toDate").val()
                            }
                        }).done(function(res) {
                            $(".dataTables_wrapper").html(res);
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
                            window.location.href = res;
                        });
                    }
                    $("#searchReceiptVoucher").click(function(){
                        view_report();
                    });
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
        </div>
    @endsection
