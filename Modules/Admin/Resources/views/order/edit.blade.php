<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0 text-uppercase font-weight-bold">

                    {{__('Action_'.request()->segment(3))}} {{ @$title }} @if(@$record->code!="") #{{@$record->code}} @endif
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
    <div class="container-fluid px-14">
        <form action="{{ $link_update ?? route('admin.page.update', [@$page, @$record->id ?? '']) }}" id="updateFrm" method="POST" enctype="multipart/form-data">
            <!-- Thông tin cơ bản về đơn hàng -->
            <section class="{{in_array(@$record->status,[4,5])?'lock':''}}">
                    <div class="orderGeneralInfo row">
                        @include('admin::order.edit.summary')

                    </div>
                    @include('admin::order.edit.details')
                    <!-- button thêm hàng hóa -->
                    @if (intval(@$record->status) < 2)
                    <div style="position: relative;top:-50px;">
                        <button class="chooseDate text-white border-0 mt-2" type="button" id="addProduct">
                            Thêm hàng hóa
                        </button>
                    </div>
                    @endif
                    @include('admin::order.edit.info')
            </section>
            <input id="id" value="{{@$record->id}}" type="hidden" />
            <input name="discount_value" value="{{@$record->discount_value}}" type="hidden" />
            <input name="discount_type" value="{{@$record->discount_type}}" type="hidden" />
            <input name="discount_percent" value="{{@$record->discount_percent}}" type="hidden" />
            <input name="payments_type" value="{{@$record->payments_type}}" type="hidden" />
            <input name="total_paid" value="{{@$record->total_paid}}" type="hidden" />

            <!-- Button Range -->
            <div class="d-flex justify-content-end mt-3" style="gap: 8px">
                @if ((!empty($record) && check_rights("order","update") && in_array(@$record->status,[1]))  || (empty($record) &&  check_rights("order","create")))
                <button type="button" id="btn-update-order" class="btn btn-warning" data-ng-show="orderStatus < 2 " title="Lưu thành đơn Đặt hàng">
                    <i class="icon-save"></i>
                    <span class="hidden-480 ng-binding">Lưu và tiếp tục</span>
                </button>
                @endif

                @if (check_rights_function('confirm_order','read') &&  @$record->status == 1 && request()->segment(3) != "copy")
                <button type="button" ng-disabled="isProcessing" class="btn btn-primary  confirmOrder" data-ng-show="saleTypeID > 1 &amp;&amp; orderStatus < 2" title="Lưu và Xác nhận đơn Đặt hàng">
                    <i class="icon-foursquare"></i>
                    <span class="hidden-480 ng-binding">Xác nhận</span>
                </button>
                @endif
                            {{-- @if (@$record->status == 9)
                                <button type="button" class="btn restoreOrder" title="KhfromOrderôi phục đơn hàng" class="hidden-480 btn btn-inverse"
                                    data-ng-show="orderId != 0 &amp;&amp; saleTypeID != 1 &amp;&amp; orderStatus != 4 &amp;&amp; orderStatus > 1" ng-disabled="isProcessing">
                                    <i class="fa fa-pause"></i>
                                    <span class="hidden-480 ng-binding">Khôi phục</span>
                                </button>
                            @else
                                <button type="button" class="btn cancelOrder" title="Hủy đơn hàng" class="hidden-480 btn btn-inverse"
                                    data-ng-show="orderId != 0 &amp;&amp; saleTypeID != 1 &amp;&amp; orderStatus != 4 &amp;&amp; orderStatus > 1" ng-disabled="isProcessing">
                                    <i class="fa fa-pause"></i>
                                    <span class="hidden-480 ng-binding">Hủy</span>
                                </button>
                            @endif --}}

                @if (check_rights_function('ship_order','read') && @$record->status ==2)
                    {{-- <button ng-click="Confirm_DeliveryOrder()" ng-disabled="isProcessing" title="Bỏ qua Xác nhận , chuyển thẳng tới Giao hàng" class="btn btn-primary ng-hide"
                        data-ng-show="( orderStatus == 1 || orderStatus == 0) &amp;&amp;  saleTypeID == 2">
                        <i class="icon-shopping-cart"></i>
                        <span class="hidden-480 ng-binding">Giao hàng</span>
                    </button>

                    <button type="button" onclick="onDeliveryOrder(this)" ng-disabled="isProcessing" title="Giao hàng cho đơn hàng Online" class="btn btn-primary"
                        data-ng-show="orderStatus == 2 &amp;&amp; ( saleTypeID == 2 || saleTypeID == 3)">
                        <i class="icon-shopping-cart"></i>
                        <span class="hidden-480 ng-binding">Giao hàng</span>
                    </button> --}}

                    <button type="button" onclick="onDeliveryOrder(this)" ng-disabled="isProcessing" title="Giao hàng cho đơn hàng Online" class="btn btn-primary">
                        <i class="icon-shopping-cart"></i>
                        <span class="hidden-480 ng-binding">Giao hàng</span>
                    </button>
                @endif
                @if (check_rights_function('finish_order','read') &&  @$record->status == 3)
                    <button type="button" title="Hoàn tất đơn hàng" class="btn btn-primary saveOrderOnline" data-ng-show="orderId != 0 &amp;&amp; orderStatus == 3" ng-disabled="isProcessing">
                        <i class="icon-ok"></i>
                        <span class="hidden-480 ng-binding">Hoàn thành</span>
                    </button>

                    {{-- <button type="button" class="btn cancelOrder" title="Hủy đơn hàng" class="hidden-480 btn btn-inverse" ng-disabled="isProcessing">
                        <i class="fa fa-pause"></i>
                        <span class="hidden-480 ng-binding">Hủy</span>
                    </button>  --}}
                @endif
                <button ng-click="saveOnlineOrderAndPrint()" title="Hoàn thành và In Đơn hàng" class="hidden-480 btn btn-primary ng-hide" ng-disabled="isProcessing">
                    <i class="icon-print"></i>
                    <span class="hidden-480 ng-binding">Hoàn tất và in</span>
                </button>
                <button class="btn btn-back" type="button" onclick="window.location.href='{{url('admin/order')}}'">
                    <i class="fa fa-arrow-left"></i>
                    <span class="hidden-480 ng-binding">Trở về</span>
                </button>
                <input type="hidden" id="id" value="{{ @$record->id }}" />
                <!-- Lưu và tiếp tục -->
                {{-- <button class="btn btn-warning" type="button">
                    <img src="../../dist/img/icon/save.png" alt="" width="15" />
                    Lưu và tiếp tục
                </button> --}}
                <!-- Hoàn tất -->
                {{-- <button class="chooseDate text-white border-0" type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512" fill="white">
                        <path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z" />
                    </svg>
                    Hoàn tất
                </button> --}}
                <!-- Hủy -->
                {{-- <button class="btn btn-dark" type="button">
                    <a href="./order.html" class="text-white d-flex align-items-center" style="gap: 5px">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512" fill="white">
                            <path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
                        </svg></a>
                    Hủy
                </button> --}}

            </div>
            @csrf
        </form>
    </div>
    <!-- /.container-fluid -->
</section>
@push('js')
    @include('admin::order.edit.popup_customer')
    <!-- datetimepicker jQuery CDN -->
    @push('js')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js" integrity="sha512-0XDfGxFliYJPFrideYOoxdgNIvrwGTLnmK20xZbCAvPfLGQMzHUsaqZK8ZoH+luXGRxTrS46+Aq400nCnAT0/w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {!! Themes::module("order") !!}
    @endpush
@endpush


<div class="content is-dev hidden">
    <quote style="">
    - Chỉnh sửa đơn hàng:
        + Khi đơn hàng không có hàng hoá & user nhấn "Lưu" thì sẽ hiển thị pop-up cảnh báo "Đơn hàng không có hàng hoá, bạn có muốn xoá không? với đơn hàng chưa tạo thì chỉ hiện thông báo
        + Hiện tại,những đơn "hoàn thành", "đã huỷ" vẫn đang cập nhật được khách hàng, đơn vị vận chuyển,....Update: các đơn ở trạng thái này thì sẽ update disable hết tất cả các thông tin trong đơn (input, seclect, button,....), chế độ chỉ xem
    - Tạo đơn hàng:
        + Khi đơn hàng không có hàng hoá & user nhấn "Lưu" thì sẽ hiển thị pop-up cảnh báo "Đơn hàng không có hàng hoá, không lưu được"
    </quote>
</div>
