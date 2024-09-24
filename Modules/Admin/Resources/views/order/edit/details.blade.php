<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <div class="barcode" data-ng-show="orderStatus < 2" style="display: none">
                <div class="form-group">

                    <select  id="choose_item" class="form-control select2">
                        <option>Chọn sản phẩm</option>
                        @foreach(Product::all() as $product)
                        <option value="{{$product->id}}" data-json="{{json_encode($product)}}">{{$product->name}}</option>
                        @endforeach
                    </select>
                    <style type="text/css">
                        .select2-selection__rendered[title='Chọn sản phẩm']
                        {
                            color:#ccc !important;
                        }
                    </style>
                </div>
            </div>

            <table id="renderOrderTable" class="table table-striped table-bordered table-hover" style="margin-bottom: 50px;">
                <thead>
                    <tr>
                        <th class="hidden-640 center ng-binding">STT</th>
                        <th class="hidden-640 ng-binding">Mã hàng hóa</th>
                        <th class="ng-binding">Tên hàng hóa</th>
                        <th class="text-center" style="width: 170px;">
                            <span class="hidden-640 ng-binding">
                                Số lượng

                                <span
                                    data-ng-if="saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.Details &amp;&amp; saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.TotalQuantity > 0"
                                    data-role="tooltip" kendo-tooltip="" k-content="quantityContent"
                                    class="badge badge-primary ng-scope">
                                    <i class="fa fa-info smaller ng-scope"></i>
                                </span>

                            </span>
                        </th>
                        <th class="hidden-480 text-center ng-binding">Giá bán</th>
                        <th class="text-center hidden-320 ng-binding">Thành tiền </th>
                        <th class="text-center"
                            data-ng-show="orderId == 0 || (saleTypeID > 1 &amp;&amp; orderStatus < 2 ) ">
                            Hành động
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white">
                    @if (!empty($record->details))
                        @foreach ($record->details as $row)
                            @php
                                if(request()->segment(3) == "copy")
                                {
                                    $did = randomKey();
                                }
                                else{
                                    $did = $row->id;
                                }
                            @endphp
                            <tr>
                                <td class="hidden-640 text-center ng-binding">{{ @$loop->index + 1 }}</td>
                                <td class="hidden-640">
                                    <span class="ng-binding ng-scope">
                                        {{ $row->sku }}
                                    </span>
                                    <div class="input-group ng-hide"
                                        data-ng-show="orderId == 0 || (saleTypeID > 1 &amp;&amp; orderStatus < 2 ) ">
                                        <input type="text" name="item[{{ $did }}][sku]" value="{{ $row->sku }}"  class="form-control mousetrap ng-pristine ng-valid">
                                        <input type="text" name="item[{{ $did }}][product_id]" value="{{ $row->product_id }}" class="form-control mousetrap ng-pristine ng-valid">
                                        <div class="spinner-buttons input-group-btn hidden-320 ng-scope">
                                            <button class="btn spinner-up btn-xs " type="button"
                                                data-ng-click="addProductItem(detail,$index)">
                                                <i class="icon-caret-up"></i>
                                            </button>
                                            <button class="btn spinner-down btn-xs " type="button"
                                                data-ng-click="minusQuantity(detail)">
                                                <i class="icon-caret-down"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="ng-binding ng-scope">
                                        {!! $row->description !!}
                                        <div class="input-group ng-hide" data-ng-show="orderId == 0 || (saleTypeID > 1 &amp;&amp; orderStatus < 2 ) ">
                                            <input type="text" name="item[{{ $did }}][description]"
                                                value="{{ $row->description }}"
                                                class="form-control mousetrap ng-pristine ng-valid">
                                            <div class="spinner-buttons input-group-btn hidden-320 ng-scope"
                                                ng-if="detail.isSerial==false">
                                                <button class="btn spinner-up btn-xs " type="button"
                                                    data-ng-click="addProductItem(detail,$index)">
                                                    <i class="icon-caret-up"></i>
                                                </button>
                                                <button class="btn spinner-down btn-xs " type="button"
                                                    data-ng-click="minusQuantity(detail)">
                                                    <i class="icon-caret-down"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                @if(request()->segment(3)=="copy" || in_array($record->status,[1]))
                                <td>
                                    <input name="item[{{ $did }}][qty]" data-required="1" id="qty_{{ $did }}"  min="1" step="1" class="form-control text-center money"  value="{{ floatval($row->qty) }}" >
                                    <div class="errordiv qty_{{ $did }}" style="display: none;"><div class="arrow"></div>Nhập số lượng!</div>
                                  </td>
                                  <td>
                                    <input name="item[{{ $did }}][price]" data-required="1" id="price_{{ $did }}"  data-required="1"  class="form-control text-center money" min='0'  value="{{floatval($row->unit_price)}}"  />
                                    <div class="errordiv price_{{ $did }}" style="display: none;"><div class="arrow"></div>Nhập số giá tiền hàng hóa!</div>
                                  </td>
                                @else
                                <td class="text-center">
                                    <div class="ace-spinner touch-spinner">
                                        <label class="disabled"><span class="ng-binding">{{ $row->qty }}</span></label>

                                        <div class="input-group ng-hide" data-ng-show="orderId == 0 || (saleTypeID > 1 &amp;&amp; orderStatus < 2 ) ">
                                            <input type="text" name="item[{{ $did }}][qty]"
                                                class="numeric spinner-input form-control mousetrap ng-pristine ng-valid"
                                                value="{{ $row->qty }}" {{@$record->status!=""?"readonly":""}}
                                                auto-numeric="isDecimal == true ? {vMin: 0, vMax: 9999999.9999,mDec: 4,aPad: false } :{vMin: 0, vMax: 9999999 } ">
                                            <div class="spinner-buttons input-group-btn hidden-320 ng-scope"
                                                ng-if="detail.isSerial==false">
                                                <button class="btn spinner-up btn-xs " type="button"
                                                    data-ng-click="addProductItem(detail,$index)">
                                                    <i class="icon-caret-up"></i>
                                                </button>
                                                <button class="btn spinner-down btn-xs " type="button"
                                                    data-ng-click="minusQuantity(detail)">
                                                    <i class="icon-caret-down"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                </td>
                                <td class="hidden-480 text-right">
                                    <div class="ng-binding">
                                        <label class="text-center disabled">{{ number_format($row->unit_price) }}</label>
                                        <input name="item[{{ $did }}][price]" value="{{$row->unit_price}}" type="hidden" />
                                        <span
                                            data-ng-show="(orderId == 0 || (saleTypeID > 1 &amp;&amp; orderStatus < 2) ) &amp;&amp; (!saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.isPromotion || saleTypeID == 3)"
                                            data-ng-if="allowPriceModified" class="help-button ng-scope ng-hide"
                                            tooltip-placement="top" tooltip="Giảm giá"
                                            data-ng-click="saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.Detail = detail; pricePop.open($event.target)">
                                            <i class="icon-gift" style="position: relative; top: -2px;"></i>
                                        </span>
                                        <span
                                            data-ng-show="saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.isPromotion &amp;&amp; orderStatus < 2 &amp;&amp; saleTypeID < 3 "
                                            class="ng-hide">
                                            <i class="icon-gift green ng-scope ng-hide"
                                                data-ng-show="detail.onItemPromotionSelected != null"
                                                tooltip-placement="bottom" tooltip-html-unsafe=""></i>
                                        </span>
                                        <span
                                            data-ng-show="saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.isPromotion &amp;&amp; orderStatus >= 2 &amp;&amp; saleTypeID < 3   "
                                            class="ng-hide">
                                            <i class="icon-gift green ng-scope ng-hide"
                                                data-ng-show="detail.promotionID > 0" tooltip-placement="bottom"
                                                tooltip-html-unsafe=""></i>
                                        </span>

                                    </div>
                                </td>
                                @endif
                                <td class="text-right hidden-320 ng-binding">
                                    <span class="total">{{ number_format($row->total_price) }}</span>

                                </td>
                                <td class="text-center" data-ng-show="orderId == 0 || (saleTypeID > 1 &amp;&amp; orderStatus < 2 ) ">
                                    <a href="#" data-id="{{ $did }}" class="red deleteProductItem">
                                        @if (intval($record->status) < 2)
                                            {{-- <i class="fa fa-times"></i> --}}
                                            <button  class="btnTableActions border-0" data-toggle="modal" data-target="#deleteServiceCard" type="button">
                                                <img src="{{assets}}dist/img/icon/delete.png" alt="Xóa" width="20px" style="vertical-align: unset">

                                            </button>
                                        @endif
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
                <tfoot style="display: none">
                    <tr id="new_row_1">
                        <td class="hidden-640 text-center ng-binding"></td>
                        <td class="hidden-640" colspan="2">
                            {{-- <input name="item[id][sku]" class="form-control" /> --}}
                            {!! Form::select('item[id][sku]', Product::getOption(), '', ['class' => 'form-control select_product']) !!}
                        </td>
                        {{-- <td>
                            <input name="item[id][description]" class="form-control" />
                        /td> --}}
                        <td class="text-center">
                            <input name="item[id][qty]" class="form-control" />

                        </td>
                        <td class="hidden-480 text-right">
                            <input name="item[id][price]" class="form-control" />
                        </td>
                        <td class="text-right hidden-320 ng-binding">

                        </td>
                        <td class="text-center">
                            {{-- <a href="#" class="red deleteProductItem">
                                <i class="fa fa-times"></i>
                            </a> --}}
                            <button onclick="SomeDeleteRowFunction(event)" class="btnTableActions border-0" data-toggle="modal" data-target="#deleteServiceCard" type="button">
                                <img src="{{assets}}dist/img/icon/delete.png" alt="Xóa" width="20px" style="vertical-align: unset">
                            </button>
                        </td>
                    </tr>

                    <tr id="new_row_2" class="warning">
                        <td class="hidden-640 text-center ng-binding"></td>
                        <td class="hidden-640">
                            <span class="item_sku_label"></span>
                            <input type="hidden" class="item_sku" />
                        </td>
                        <td>
                            <div ng-if="detail.isSerial==false" class="ng-binding ng-scope">
                                <b class="show-640 ng-hide item_sku"></b>
                                <span class="item_name_label"></span>
                                <input type="hidden" class="item_name" />
                                <input type="hidden" class="item_product" />
                            </div>
                        </td>
                        <td class="text-center" style="padding:2px;">
                            <div class="form-control" style="padding:0;">

                                <div class="input-group input-group-qty" style="display:flex;flex-wrap: nowrap;">
                                    <button class="btn spinner-up btn-xs qty-minus" type="button" data-ng-click="addProductItem(detail,$index)">
                                        <i class="fa fa-angle-left"></i>
                                    </button>
                                    <input type="number" class="item_qty text-right" value="1" data-ng-change="onItemQtyChange(detail,$index)" class="numeric spinner-input form-control mousetrap ng-pristine ng-valid"  auto-numeric="isDecimal == true ? {vMin: 0, vMax: 9999999.9999,mDec: 4,aPad: false } :{vMin: 0, vMax: 9999999 } ">

                                    <button class="btn spinner-down btn-xs qty-plus" type="button" data-ng-click="minusQuantity(detail)">
                                        <i class="fa fa-angle-right"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- ngIf: detail.productType == 3 && detail.exchanged != null -->
                        </td>
                        <td class="hidden-480 text-right">
                            <div class="ng-binding">
                                <span class="item_price_label"></span>
                                <input type="hidden" class="item_price" class="numeric spinner-input form-control mousetrap ng-pristine ng-valid" auto-numeric="isDecimal == true ? {vMin: 0, vMax: 9999999.9999,mDec: 4,aPad: false } :{vMin: 0, vMax: 9999999 } ">
                                <!-- ngIf: allowPriceModified -->
                                <span data-ng-show="(orderId == 0 || (saleTypeID > 1 &amp;&amp; orderStatus < 2) ) &amp;&amp; (!saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.isPromotion || saleTypeID == 3)" data-ng-if="allowPriceModified" class="help-button ng-scope" tooltip-placement="top" tooltip="Giảm giá" data-ng-click="saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.Detail = detail; pricePop.open($event.target)">
                                    <i class="icon-gift" style="position: relative; top: -2px;"></i>
                                </span><!-- end ngIf: allowPriceModified -->
                                <span data-ng-show="saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.isPromotion &amp;&amp; orderStatus < 2 &amp;&amp; saleTypeID < 3 " class="ng-hide">
                                    <i class="icon-gift green ng-scope ng-hide" data-ng-show="detail.onItemPromotionSelected != null" tooltip-placement="bottom" tooltip-html-unsafe=""></i>
                                </span>
                                <span data-ng-show="saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.isPromotion &amp;&amp; orderStatus >= 2 &amp;&amp; saleTypeID < 3   " class="ng-hide">
                                    <i class="icon-gift green ng-scope ng-hide" data-ng-show="detail.promotionID > 0" tooltip-placement="bottom" tooltip-html-unsafe=""></i>
                                </span>

                            </div>
                            <div>
                                <!-- ngIf: detail.discount > 0 && !detail.discountIsPercent -->
                                <!-- ngIf: detail.discount > 0 && detail.discountIsPercent -->
                            </div>
                        </td>
                        <td class="text-right hidden-320 ng-binding">  <span class="item_total_price_label"></span></td>
                        <td class="text-center">
                            {{-- <a href="#" class="red deleteProductItem">
                                <i class="fa fa-times"></i>
                            </a> --}}
                            <button onclick="SomeDeleteRowFunction(event)" class="btnTableActions border-0" data-toggle="modal" data-target="#deleteServiceCard" type="button">
                                <img src="{{assets}}dist/img/icon/delete.png" alt="Xóa" width="20px" style="vertical-align: unset">
                            </button>
                        </td>
                    </tr>

                </tfoot>
            </table>
            {{-- <span id="btnNewProduct" class="btn btn-primary btn-sm ng-binding" data-ng-click="modalComment.open();">
                <i class="icon-pen"></i>&nbsp;Thêm hàng hóa
            </span> --}}
        </div>
        {{-- <div class="alert alert-block alert-success ng-binding ng-hide"
        ng-show="saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.Details.length==0">Gõ
        mã hoặc tên hàng hóa vào hộp tìm kiếm để thêm hàng vào đơn hàng</div> --}}
    </div>
</div>
<style type="text/css">

</style>
