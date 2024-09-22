<div class="tabbable">
    <ul class="nav nav-tabs">
        <li class="active">
            <a data-toggle="tab" class="ng-binding">
                <i class="green fa fa-bars bigger-110"></i>
                Xem chi tiết
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active">
            <div class="bg-info text-whhite py-2">
                <div class="row">
                  <div class="col-2 d-flex justify-content-center align-items-center" style="gap:5px">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    <p>Tiền hàng: <span id="productPrice">{{number_format($order->subTotal)}}</span></p>
                  </div>

                  <div class="col-2 d-flex justify-content-center align-items-center" style="gap:5px">
                    <i class="fa fa-percent" aria-hidden="true"></i>
                    <p>Giảm giá: <span id="orderDiscount">{{number_format($order->discount_value)}}</span></p>
                  </div>
                  <div class="col-2 d-flex justify-content-center align-items-center" style="gap:5px">
                    <i class="fa fa-truck" aria-hidden="true"></i>
                    <p>Phí vận chuyển: <span id="orderDiscount">{{number_format($order->shipping_fee)}}</span></p>
                  </div>

                  <div class="col-2 d-flex justify-content-center align-items-center" style="gap:5px">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512" fill="white"><path d="M160 0c17.7 0 32 14.3 32 32V67.7c1.6 .2 3.1 .4 4.7 .7c.4 .1 .7 .1 1.1 .2l48 8.8c17.4 3.2 28.9 19.9 25.7 37.2s-19.9 28.9-37.2 25.7l-47.5-8.7c-31.3-4.6-58.9-1.5-78.3 6.2s-27.2 18.3-29 28.1c-2 10.7-.5 16.7 1.2 20.4c1.8 3.9 5.5 8.3 12.8 13.2c16.3 10.7 41.3 17.7 73.7 26.3l2.9 .8c28.6 7.6 63.6 16.8 89.6 33.8c14.2 9.3 27.6 21.9 35.9 39.5c8.5 17.9 10.3 37.9 6.4 59.2c-6.9 38-33.1 63.4-65.6 76.7c-13.7 5.6-28.6 9.2-44.4 11V480c0 17.7-14.3 32-32 32s-32-14.3-32-32V445.1c-.4-.1-.9-.1-1.3-.2l-.2 0 0 0c-24.4-3.8-64.5-14.3-91.5-26.3c-16.1-7.2-23.4-26.1-16.2-42.2s26.1-23.4 42.2-16.2c20.9 9.3 55.3 18.5 75.2 21.6c31.9 4.7 58.2 2 76-5.3c16.9-6.9 24.6-16.9 26.8-28.9c1.9-10.6 .4-16.7-1.3-20.4c-1.9-4-5.6-8.4-13-13.3c-16.4-10.7-41.5-17.7-74-26.3l-2.8-.7 0 0C119.4 279.3 84.4 270 58.4 253c-14.2-9.3-27.5-22-35.8-39.6c-8.4-17.9-10.1-37.9-6.1-59.2C23.7 116 52.3 91.2 84.8 78.3c13.3-5.3 27.9-8.9 43.2-11V32c0-17.7 14.3-32 32-32z"></path></svg>
                    <p>Tổng tiền: <span id="orderPrice">{{number_format($order->total)}}</span></p>
                  </div>

                  <div class="col-2 d-flex justify-content-center align-items-center" style="gap:5px">
                    <i class="fa-solid fa-money-check-dollar" aria-hidden="true"></i>
                    <p>Thanh toán: <span id="orderDebt" class="text-danger">{{number_format($order->total_paid)}}</span></p>
                  </div>
                  <div class="col-2 d-flex justify-content-center align-items-center" style="gap:5px">
                    <i class="fa fa-info" aria-hidden="true"></i>
                    <p>Nợ: <span id="orderDebt" class="text-danger">{{number_format($order->debt)}}</span></p>
                  </div>
                </div>
              </div>
            <table class="table table-striped table-bordered table-hover dataTable">
                <thead>
                    <tr role="row">
                        <th class="text-center width-5 hidden-320 ng-binding">
                            STT
                        </th>
                        <th class="text-left hidden-768 ng-binding">Mã hàng hóa</th>
                        <th class="text-left ng-binding">Tên hàng hóa</th>
                        <th class="text-center ng-binding">Số lượng</th>
                        <th class="text-center ng-binding ng-scope" data-ng-if="order.saleTypeID != 4 || (order.saleTypeID == 4 &amp;&amp; showPrice)">Giá</th>
                        <th class="text-center ng-binding ng-scope" data-ng-if="order.saleTypeID != 4 || (order.saleTypeID == 4 &amp;&amp; showPrice)">Thành tiền</th>
                    </tr>
                </thead>
                <tbody data-ng-repeat="item in order.orderDetail.orderDetails" class="ng-scope">
                    @foreach ($records as $r)
                    <tr>
                        <td class="text-center width-5 hidden-320 ng-binding">
                            {{$loop->index + 1}}
                        </td>
                        <td class="text-left hidden-768">
                            <span ng-if="!item.isSerial" class="ng-binding ng-scope">
                                {{$r->sku}}
                            </span>
                        </td>
                        <td class="text-left ng-binding">
                            {!! $r->description !!}
                        </td>
                        <td class="text-center ng-binding">
                            {{number_format($r->qty)}}
                        </td>
                        <td class="text-right ng-binding ng-scope" data-ng-if="order.saleTypeID != 4 || (order.saleTypeID == 4 &amp;&amp; showPrice)">
                            {{number_format($r->unit_price)}}
                        </td>
                        <td class="text-right ng-binding ng-scope" data-ng-if="order.saleTypeID != 4 || (order.saleTypeID == 4 &amp;&amp; showPrice)">
                            {{number_format($r->total_price)}}
                        </td>
                    </tr>
                    @endforeach
            </table>
        </div>
    </div>
</div>
