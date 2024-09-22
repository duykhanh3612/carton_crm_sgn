
<div class="container-fluid main">
    @if (!isset($setting['has_tag']))
        @include('admin::element')
    @endif
    <h2 class="mt-4 mb-3">{{__('Action_'.request()->segment(3))}} <span style="text-transform: lowercase"> {{ @$title }}</span></h2>
    <div class="row">

            <div class="row">
                <div class="col-12 mb-4">
                    @include('admin::order.v1.edit.summary')

                </div>
                <form action="{{ $link_update ?? route('admin.page.update', [@$page, @$record->id ?? '']) }}" id="fromOrder" method="POST" enctype="multipart/form-data">
                    <div class="col-12">
                        @include('admin::order.v1.edit.details')
                    </div>

                    @include('admin::order.v1.edit.info')

                    <div class="col-12">
                        <div class="text-right">
                            @if (empty($record) || in_array(@$record->status,[1,2,3]))
                            <button type="button" id="btn-update-order" class="btn btn-warning" data-ng-show="orderStatus < 2 " title="Lưu thành đơn Đặt hàng">
                                <i class="icon-save"></i>
                                <span class="hidden-480 ng-binding">Lưu và tiếp tục</span>
                            </button>
                            @endif

                            @if (@$record->status == 1)
                            <button type="button" ng-disabled="isProcessing" class="btn btn-primary  confirmOrder" data-ng-show="saleTypeID > 1 &amp;&amp; orderStatus < 2" title="Lưu và Xác nhận đơn Đặt hàng">
                                <i class="icon-foursquare"></i>
                                <span class="hidden-480 ng-binding">Xác nhận</span>
                            </button>
                            @endif
                            {{-- @if (@$record->status == 9)
                                <button type="button" class="btn restoreOrder" title="Khôi phục đơn hàng" class="hidden-480 btn btn-inverse"
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

                            @if (@$record->status ==2 && isAdmin())
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
                            @if (@$record->status == 3 && isAdmin())
                                <button type="button" title="Hoàn tất đơn hàng" class="btn btn-primary saveOrderOnline" data-ng-show="orderId != 0 &amp;&amp; orderStatus == 3" ng-disabled="isProcessing">
                                    <i class="icon-ok"></i>
                                    <span class="hidden-480 ng-binding">Hoàn tất</span>
                                </button>

                                <button type="button" class="btn cancelOrder" title="Hủy đơn hàng" class="hidden-480 btn btn-inverse" ng-disabled="isProcessing">
                                    <i class="fa fa-pause"></i>
                                    <span class="hidden-480 ng-binding">Hủy</span>
                                </button>
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
                        </div>
                    </div>
                    @csrf
                </form>
            </div>

    </div>
</div>
@push('js')
    @include('admin::order.v1.edit.popup_customer')
    <!-- datetimepicker jQuery CDN -->
    @push('js')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

    {!! Themes::module("order") !!}
    @endpush
@endpush
