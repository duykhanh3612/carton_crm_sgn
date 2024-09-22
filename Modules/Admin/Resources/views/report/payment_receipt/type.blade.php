<table class="table-bordered table-hover dataTable ng-scope ng-table table" data-ng-table="tableReceiptVoucher">
    <thead class="ng-scope" ng-include="templates.header">
        <tr class="ng-scope">
        </tr>
        <tr class="ng-table-filters ng-scope ng-hide" ng-show="show_filter">

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
                <select class="width-100 ng-pristine ng-valid" data-ng-model="store"
                    data-ng-options="t.name for t in stores" data-ng-change="changeStore(store)">
                    <option value="0" selected="selected">---Chọn
                        cửa hàng---</option>
                    <option value="1">Ms Vi</option>
                </select>
            </th>
            <th class="bolder width-10 text-center">
                <select class="width-100 ng-pristine ng-valid" data-ng-model="paymentMethod"
                    data-ng-options="t.name for t in paymentMethods"
                    data-ng-change="changePaymentMethod(paymentMethod)">
                    <option value="0" selected="selected">---Hình
                        thức ---</option>
                    <option value="1">Tiền mặt</option>
                    <option value="2">Thẻ</option>
                    <option value="3">CK</option>
                </select>
            </th>
            <th class="bolder width-10 text-center">
                <select class="width-100 ng-pristine ng-valid" data-ng-model="category"
                    data-ng-options="t.name for t in categories" data-ng-change="changeCategory(category)">
                    <option value="0" selected="selected">
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
        <tr class="ng-scope" data-ng-repeat="accBooks in params.data">
            <td class="ng-binding text-center">

                {{ date('d/m/Y H:i:s', strtotime($r->created_at)) }}
            </td>
            <td class="hidden-768 ng-binding text-center">
                {{ $r->code }}
            </td>
            <td class="text-right">
                <span class="green ng-binding">{{ number_format($r->total_paid) }}</span>
            </td>
            <td class="hidden-768 ng-binding text-center">
                {{ $r->sale->full_name }}
            </td>
            <td class="width-10 ng-binding text-center">
                {{ $r->store->name }}
            </td>
            <td class="width-10 ng-binding text-center">
                {{ $r->payments_type }}
            </td>
            <td class="width-10 ng-binding text-center">
                {{ $r->category }}
            </td>
            <td class="ng-binding text-left">{{ $r->note }}
            </td>
            <td class="text-center">
                <i class="icon-print bigger-130" data-ng-click="print(accBooks)"></i>
                <i class="icon-trash bigger-130 ng-scope" data-ng-if="isRemove(accBooks)"
                    data-ng-click="removeReceiptVoucher(accBooks)"></i>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>
<div class="row">
    {{-- <div class="left col-sm-5" style="margin-left: 20px; margin-top: -45px">
        <span class="hidden-640 ng-binding">Số phiếu thu: </span><span class="total-highlight ng-binding">57420</span>
        <button data-toggle="dropdown" class="btn btn-warning dropdown-toggle" style="padding:3px;">
            <i class="icon-caret-down icon-on-right"></i>
        </button>
        <ul class="dropdown-menu">
            <li style="padding:0px 10px 0px 10px;">
                <span class="ng-binding"> Tiền mặt: <b class="red ng-binding">26636</b></span>
                <span class="ng-binding"> - Thẻ: <b class="red ng-binding">4282</b></span>
                <span class="ng-binding"> - CK: <b class="red ng-binding">26502</b></span>
            </li>
        </ul>
        <span class="show-640">/</span>
        <span class="hidden-640 ng-binding">Tổng thu:</span>
        <span class="total-highlight ng-binding">163,794,056,736</span>
    </div> --}}
    <div class="paging">
        {!! $orders->links() !!}
    </div>
