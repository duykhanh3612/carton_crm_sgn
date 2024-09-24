<form class="form-horizontal search-box sn-online-main-menu ng-pristine ng-valid">
    <div class="row">
        <div class="col-xs-12 col-sm-8">
            <!-- PAGE CONTENT BEGINS -->
            <!-- ngIf: hint.countProduct == 0 -->
            <!-- DATA INFORMATION-->
            <div class="col-md-3">
                <div class="col-xs-12 alert alert-warning" style="padding: 5px; min-height: 75px">
                    <div class="col-xs-9 padding-left-3" style="padding-right: 0">
                        <span title="@*Tiền hàng*@Tiền hàng" class="ng-binding">Tiền hàng  <b class="ng-binding">3,807,000</b></span>
                        <br  class="">
                        <span  title="@*Số lượng*@Số lượng" class="ng-binding">Số lượng <b class="ng-binding">710</b></span>
                        <br  class="ng-hide">
                        <span title="SubFee"  class="ng-binding ng-hide">Phụ phí <b class="ng-binding"></b></span>
                    </div>
                    <div class="infobox-icon smaller-90 ng-hide" ng-mouseover="isHoverSubFee = true" ng-mouseleave="isHoverSubFee = false" data-ng-show="orderId == 0 || (saleTypeID > 1 &amp;&amp; orderStatus < 2 )">
                        <i class="icon-truck bigger-280 icon-only orange-2" ng-class="isHoverSubFee ?'blue':'' " data-ng-click="openSubFee($event.target);" title="Phí vận chuyển"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="col-xs-12 alert alert-warning" style="padding: 5px; min-height: 75px">
                    <div class="col-xs-9 padding-left-3" style="padding-right: 0">
                        <span class="ng-binding">Giảm giá <b data-ng-show="saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.IsDiscountPercent == true" class="ng-binding ng-hide">0 % </b></span>
                        <br>
                        <span><b class="ng-binding">0</b></span>
                    </div>
                    <div data-ng-show="(saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.saleTypeID < 3 &amp;&amp; (saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.promotions.length > 1 &amp;&amp; (saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.optimal === 1 || saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.optimal === 2)) || (saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.optimal === 3)) &amp;&amp; saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.saleTypeID != 3" title="Danh sách chương trình khuyến mãi" style="margin-top: -4px;" class="ng-hide">
                        <span data-ng-controller="widgetPromotionApplyController" class="ng-scope">
                            <i class="icon-gift icon-only green bigger-300" ng-class="saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.optimal === 3 ?'bigger-150 margin-left-10':'bigger-300' " data-ng-click="openPromotionList(saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder , allowPromotionModified)"></i>
                        </span>
                    </div>
                    <div class="infobox-icon ng-hide" data-ng-show="orderStatus <= 1 &amp;&amp; (!saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.isPromotion || saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.saleTypeID == 3)" ng-mouseover="isHoverDiscount = true" ng-mouseleave="isHoverDiscount = false">
                        <i class="icon-gift bigger-300 icon-only orange-2" ng-class="isHoverDiscount ?'blue':'' " data-ng-click="openDiscount($event.target)" title="Giảm giá đơn hàng"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="col-xs-12 alert alert-warning" style="padding: 5px; min-height: 75px">
                    <div class="col-xs-9 padding-left-3" style="padding-right: 0">
                        <!-- ngIf: applyEarningPoint --><span data-ng-if="applyEarningPoint" title="Tiền quy đổi" class="ng-binding ng-scope">Tiền quy đổi<b class="ng-binding"> 0</b></span><!-- end ngIf: applyEarningPoint -->
                        <!-- ngIf: applyEarningPoint --><br data-ng-if="applyEarningPoint" class="ng-scope"><!-- end ngIf: applyEarningPoint -->
                        <span title="@*Tổng cộng*@Tổng tiền" class="ng-binding">Tổng tiền <b class="ng-binding">3,807,000</b></span>
                    </div>
                    <div class="infobox-icon smaller-90 ng-scope ng-hide" data-ng-controller="widgetPromotionApplyController" data-ng-show="isExchangeable &amp;&amp; (saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.Total > 0 || saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.SubTotal > 0) &amp;&amp; saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.status <= 1">
                        <i class="icon-exchange bigger-280 icon-only blue" data-ng-click="openPromotionList(saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder , allowPromotionModified)" title="Đổi điểm tích lũy"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="col-xs-12 alert alert-warning" style="padding: 5px; min-height: 75px">
                    <div class="col-xs-9 padding-left-3" style="padding-right: 0">
                        <span class="ng-binding">TT <b class="ng-binding">0 </b></span>
                    </div>
                    <div class="infobox-icon" has-permission="POSIM_Sale_Payment" data-ng-show="saleTypeID != 1" ng-mouseover="isHoverAmountPaid = true" ng-mouseleave="isHoverAmountPaid = false">
                        <i class="icon-credit-card bigger-230 icon-only blue" data-ng-click="openPayment($event.target);" ng-class="isHoverAmountPaid ?'orange':'' " title="Thanh toán"></i>
                    </div>
                    <div class="col-xs-12 padding-left-3" style="padding-right: 0">
                        <span class="smaller-80"><i data-ng-show="moreAmountPaid <= 0" class="ng-binding">Còn lại </i><i data-ng-show="moreAmountPaid > 0" class="ng-binding ng-hide">Tiền thừa </i><b class="bigger-120 red ng-binding">3,807,000 </b></span>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 text-left" style="clear:both;position:relative" data-ng-show="saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.saleTypeID < 3">
                <div class="alert alert-block alert-info padding-10 ng-binding ng-hide" data-ng-show="orderStatus < 2 &amp;&amp;  saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.isPromotion &amp;&amp; saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.onBillPromotionSelected != null">
                    Chương trình khuyến mãi áp dụng
                    <b class="label label-success ">
                        <a target="_blank" style="color:white" href="#/promotion/edit/" class="ng-binding">[]</a>
                    </b>
                </div>
                <div class="alert alert-block alert-info padding-10 ng-binding ng-hide" data-ng-show="orderStatus >= 2 &amp;&amp; saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.promotionID > 0 ">
                    Chương trình khuyến mãi áp dụng <b class="label label-success "><a target="_blank" style="color:white" href="#/promotion/edit/0" class="ng-binding">[]</a> </b>
                </div>
            </div>

            <!-- END DATA INFORMATION-->
            <div class="row">
                <div class="col-xs-12 barcode ng-hide" data-ng-show="orderStatus < 2">
                    <div class="form-group">
                        <div style="min-width: 300px;" ng-controller="productSearchCtrl" id="productSearch" class="ng-scope">
                            <autocompletemulti ng-model="productSearchTerm" attr-placeholder="Nhập mã barcode hoặc tên hàng hóa" template-id="productItemTempl" attr-inputid="productSearchInput" attr-inputclass="mousetrap" data="products" on-type="searchTermChanged" on-select="onProductSelected" on-select-empty="onEmptyListSelect" class="autosearch ng-isolate-scope ng-pristine ng-valid">
                            <div class="autocomplete " id=""><span class="input-icon input-icon-right input-group" style="width:100%;"><input type="text" ng-disabled="isDisabled" ng-model="searchParam" placeholder="Nhập mã barcode hoặc tên hàng hóa" class="mousetrap" id="productSearchInput" autocomplete="off" style="position:relative"><i class="icon-remove red ng-hide" style="cursor:pointer;" ng-show="searchParam" ng-click="removeText()"></i><label class="no-padding" style="position:absolute"><input name="form-field-checkbox" class="ace ace-checkbox-2" type="checkbox"></label></span><div class="suggest"><div style="border: 1px solid #888; border-width: 0px 1px 1px 1px; padding:0 5px 5px" ng-show="completing" class="ng-hide">                                <span class="checkbox">                                    <label class="no-padding">                                        <input ng-model="isChecked" class="ace ace-checkbox-2 ng-pristine ng-valid" type="checkbox" ng-change="checkAll()">                                        <span class="lbl"></span>                                        <button ng-click="chooseSelected()" class="btn btn-xs btn-warning">                                            <i class="icon-check"></i>                                            <span>Chọn</span>                                        </button>                                    </label>                                </span>                            </div><ul ng-show="completing" class="ng-hide">
                                <!-- ngRepeat: suggestion in suggestions track by $index -->
                            </ul><ul ng-show="searchParam &amp;&amp; (suggestions == null || suggestions.length == 0)" class="ng-hide"><li>Không tìm thấy kết quả phù hợp</li></ul></div></div></autocompletemulti>
                            <script type="text/x-angular-template" id="productItemTempl">
                                <li suggestionmulti ng-repeat="suggestion in suggestions track by $index" style="cursor:pointer;"
                                    index="{{$index}}" val="{{suggestion.itemName}}" ng-class="{active:($index == selectedIndex)}" ng-click="select(suggestion)">
                                    <p style="font-weight:bold;">
                                        <label class="no-padding" ng-click="$event.stopPropagation()">
                                            <input class="ace ace-checkbox-2" type="checkbox" ng-checked="suggestion.isChecked == true" ng-model="suggestion.isChecked">
                                            <span class="lbl"></span>
                                        </label>
                                        <span>{{suggestion.itemName}}</span>
                                    </p>
                                    <p> {{'Code' | translate}}: {{suggestion.barcode}} </p>
                                    <p>{{'Price' | translate}}: {{suggestion.retailPrice}} | {{'Hands_On' | translate}}: {{suggestion.qtyAvailable}}</p>
                                </li>
                            </script>
                        </div>
                    </div>

                </div>
                <div class="col-xs-12">
                    <div class="table-responsive">
                        <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="hidden-640 center ng-binding">STT</th>
                                    <th class="hidden-640 ng-binding">Mã hàng hóa</th>
                                    <th class="ng-binding">Tên hàng hóa</th>
                                    <th class="text-center">
                                        <span class="show-640 ng-binding">SL</span><span class="hidden-640 ng-binding">
                                            Số lượng
                                            <!-- ngIf: saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.Details && saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.TotalQuantity > 0 --><span data-ng-if="saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.Details &amp;&amp; saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.TotalQuantity > 0" data-role="tooltip" kendo-tooltip="" k-content="quantityContent" class="badge badge-primary ng-scope"><i class="icon-info smaller ng-scope"></i></span><!-- end ngIf: saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.Details && saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.TotalQuantity > 0 -->
                                        </span>
                                    </th>
                                    <th class="hidden-480 text-center ng-binding">Giá bán</th>
                                    <th class="text-center hidden-320 ng-binding">Thành tiền </th>
                                    <th class="text-center ng-hide" data-ng-show="orderId == 0 || (saleTypeID > 1 &amp;&amp; orderStatus < 2 ) ">
                                        <!-- ngIf: orderId == 0 && saleOrder.Items[0].SaleOrder.Details.length > 1 -->
                                    </th>
                                </tr>
                            </thead>
                            <!-- ngRepeat: detail in saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.Details --><tbody data-ng-repeat="detail in saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.Details" class="ng-scope">
                                <tr data-ng-class="{'warning': $index == saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.lastInputedIndex}" data-ng-mouseover="showHideExchangeActions(detail, true)" data-ng-mouseleave="showHideExchangeActions(detail, false)">
                                    <td class="hidden-640 text-center ng-binding">1</td>
                                    <td class="hidden-640">
                                        <!-- ngIf: detail.isSerial==true -->
                                        <!-- ngIf: detail.isSerial==false --><span ng-if="detail.isSerial==false" class="ng-binding ng-scope">
                                            SP000272
                                        </span><!-- end ngIf: detail.isSerial==false -->
                                    </td>
                                    <td>
                                        <!-- ngIf: detail.isSerial==true -->
                                        <!-- ngIf: detail.isSerial==false --><div ng-if="detail.isSerial==false" class="ng-binding ng-scope">
                                            <b class="show-640 ng-binding">SP000272                        </b><br class="show-640">
                                            Thùng 25x10x10CM
                                            <!-- ngIf: detail.productType == 3 && detail.exchanged != null -->
                                        </div><!-- end ngIf: detail.isSerial==false -->
                                        <!-- ngIf: detail.productType == 3 && detail.exchanged != null && detail.exchanged.showActions == true -->
                                    </td>
                                    <td class="text-center">
                                        <div class="ace-spinner touch-spinner" style="width: 130px;">
                                            <span data-ng-hide="orderId == 0 || (saleTypeID > 1 &amp;&amp; orderStatus  < 2) " class="ng-binding">200 </span>
                                            <div class="input-group ng-hide" data-ng-show="orderId == 0 || (saleTypeID > 1 &amp;&amp; orderStatus < 2 ) ">
                                                <input type="text" id="spinner2" data-ng-model="detail.quantity" data-ng-change="onItemQtyChange(detail,$index)" class="numeric spinner-input form-control mousetrap ng-pristine ng-valid" ng-disabled="detail.isSerial==true" auto-numeric="isDecimal == true ? {vMin: 0, vMax: 9999999.9999,mDec: 4,aPad: false } :{vMin: 0, vMax: 9999999 } ">
                                                <!-- ngIf: detail.isSerial==false --><div class="spinner-buttons input-group-btn hidden-320 ng-scope" ng-if="detail.isSerial==false">
                                                    <button class="btn spinner-up btn-xs " type="button" data-ng-click="addProductItem(detail,$index)">
                                                        <i class="icon-caret-up"></i>
                                                    </button>
                                                    <button class="btn spinner-down btn-xs " type="button" data-ng-click="minusQuantity(detail)">
                                                        <i class="icon-caret-down"></i>
                                                    </button>
                                                </div><!-- end ngIf: detail.isSerial==false -->
                                            </div>
                                        </div>
                                        <!-- ngIf: detail.productType == 3 && detail.exchanged != null -->
                                    </td>
                                    <td class="hidden-480 text-right">
                                        <div class="ng-binding">
                                            1,660

                                            <!-- ngIf: allowPriceModified --><span data-ng-show="(orderId == 0 || (saleTypeID > 1 &amp;&amp; orderStatus < 2) ) &amp;&amp; (!saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.isPromotion || saleTypeID == 3)" data-ng-if="allowPriceModified" class="help-button ng-scope ng-hide" tooltip-placement="top" tooltip="Giảm giá" data-ng-click="saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.Detail = detail; pricePop.open($event.target)">
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
                                    <td class="text-right hidden-320 ng-binding">332,000</td>
                                    <td class="text-center ng-hide" data-ng-show="orderId == 0 || (saleTypeID > 1 &amp;&amp; orderStatus < 2 ) ">
                                        <a class="red" data-ng-click="deleteProductItem($index)">
                                            <i class="icon-trash bigger-120"></i>
                                        </a>
                                    </td>
                                </tr>
                                <!-- ngIf: detail.isSerial==true && detail.openSerial==true -->
                            </tbody><!-- end ngRepeat: detail in saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.Details --><tbody data-ng-repeat="detail in saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.Details" class="ng-scope">
                                <tr data-ng-class="{'warning': $index == saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.lastInputedIndex}" data-ng-mouseover="showHideExchangeActions(detail, true)" data-ng-mouseleave="showHideExchangeActions(detail, false)">
                                    <td class="hidden-640 text-center ng-binding">2</td>
                                    <td class="hidden-640">
                                        <!-- ngIf: detail.isSerial==true -->
                                        <!-- ngIf: detail.isSerial==false --><span ng-if="detail.isSerial==false" class="ng-binding ng-scope">
                                            SP001071
                                        </span><!-- end ngIf: detail.isSerial==false -->
                                    </td>
                                    <td>
                                        <!-- ngIf: detail.isSerial==true -->
                                        <!-- ngIf: detail.isSerial==false --><div ng-if="detail.isSerial==false" class="ng-binding ng-scope">
                                            <b class="show-640 ng-binding">SP001071                        </b><br class="show-640">
                                            Bong bóng khí 55x100m
                                            <!-- ngIf: detail.productType == 3 && detail.exchanged != null -->
                                        </div><!-- end ngIf: detail.isSerial==false -->
                                        <!-- ngIf: detail.productType == 3 && detail.exchanged != null && detail.exchanged.showActions == true -->
                                    </td>
                                    <td class="text-center">
                                        <div class="ace-spinner touch-spinner" style="width: 130px;">
                                            <span data-ng-hide="orderId == 0 || (saleTypeID > 1 &amp;&amp; orderStatus  < 2) " class="ng-binding">10 </span>
                                            <div class="input-group ng-hide" data-ng-show="orderId == 0 || (saleTypeID > 1 &amp;&amp; orderStatus < 2 ) ">
                                                <input type="text" id="spinner2" data-ng-model="detail.quantity" data-ng-change="onItemQtyChange(detail,$index)" class="numeric spinner-input form-control mousetrap ng-pristine ng-valid" ng-disabled="detail.isSerial==true" auto-numeric="isDecimal == true ? {vMin: 0, vMax: 9999999.9999,mDec: 4,aPad: false } :{vMin: 0, vMax: 9999999 } ">
                                                <!-- ngIf: detail.isSerial==false --><div class="spinner-buttons input-group-btn hidden-320 ng-scope" ng-if="detail.isSerial==false">
                                                    <button class="btn spinner-up btn-xs " type="button" data-ng-click="addProductItem(detail,$index)">
                                                        <i class="icon-caret-up"></i>
                                                    </button>
                                                    <button class="btn spinner-down btn-xs " type="button" data-ng-click="minusQuantity(detail)">
                                                        <i class="icon-caret-down"></i>
                                                    </button>
                                                </div><!-- end ngIf: detail.isSerial==false -->
                                            </div>
                                        </div>
                                        <!-- ngIf: detail.productType == 3 && detail.exchanged != null -->
                                    </td>
                                    <td class="hidden-480 text-right">
                                        <div class="ng-binding">
                                            137,500

                                            <!-- ngIf: allowPriceModified --><span data-ng-show="(orderId == 0 || (saleTypeID > 1 &amp;&amp; orderStatus < 2) ) &amp;&amp; (!saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.isPromotion || saleTypeID == 3)" data-ng-if="allowPriceModified" class="help-button ng-scope ng-hide" tooltip-placement="top" tooltip="Giảm giá" data-ng-click="saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.Detail = detail; pricePop.open($event.target)">
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
                                    <td class="text-right hidden-320 ng-binding">1,375,000</td>
                                    <td class="text-center ng-hide" data-ng-show="orderId == 0 || (saleTypeID > 1 &amp;&amp; orderStatus < 2 ) ">
                                        <a class="red" data-ng-click="deleteProductItem($index)">
                                            <i class="icon-trash bigger-120"></i>
                                        </a>
                                    </td>
                                </tr>
                                <!-- ngIf: detail.isSerial==true && detail.openSerial==true -->
                            </tbody><!-- end ngRepeat: detail in saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.Details --><tbody data-ng-repeat="detail in saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.Details" class="ng-scope">
                                <tr data-ng-class="{'warning': $index == saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.lastInputedIndex}" data-ng-mouseover="showHideExchangeActions(detail, true)" data-ng-mouseleave="showHideExchangeActions(detail, false)">
                                    <td class="hidden-640 text-center ng-binding">3</td>
                                    <td class="hidden-640">
                                        <!-- ngIf: detail.isSerial==true -->
                                        <!-- ngIf: detail.isSerial==false --><span ng-if="detail.isSerial==false" class="ng-binding ng-scope">
                                            SP000832
                                        </span><!-- end ngIf: detail.isSerial==false -->
                                    </td>
                                    <td>
                                        <!-- ngIf: detail.isSerial==true -->
                                        <!-- ngIf: detail.isSerial==false --><div ng-if="detail.isSerial==false" class="ng-binding ng-scope">
                                            <b class="show-640 ng-binding">SP000832                        </b><br class="show-640">
                                            Thùng 30x23x15 CM
                                            <!-- ngIf: detail.productType == 3 && detail.exchanged != null -->
                                        </div><!-- end ngIf: detail.isSerial==false -->
                                        <!-- ngIf: detail.productType == 3 && detail.exchanged != null && detail.exchanged.showActions == true -->
                                    </td>
                                    <td class="text-center">
                                        <div class="ace-spinner touch-spinner" style="width: 130px;">
                                            <span data-ng-hide="orderId == 0 || (saleTypeID > 1 &amp;&amp; orderStatus  < 2) " class="ng-binding">500 </span>
                                            <div class="input-group ng-hide" data-ng-show="orderId == 0 || (saleTypeID > 1 &amp;&amp; orderStatus < 2 ) ">
                                                <input type="text" id="spinner2" data-ng-model="detail.quantity" data-ng-change="onItemQtyChange(detail,$index)" class="numeric spinner-input form-control mousetrap ng-pristine ng-valid" ng-disabled="detail.isSerial==true" auto-numeric="isDecimal == true ? {vMin: 0, vMax: 9999999.9999,mDec: 4,aPad: false } :{vMin: 0, vMax: 9999999 } ">
                                                <!-- ngIf: detail.isSerial==false --><div class="spinner-buttons input-group-btn hidden-320 ng-scope" ng-if="detail.isSerial==false">
                                                    <button class="btn spinner-up btn-xs " type="button" data-ng-click="addProductItem(detail,$index)">
                                                        <i class="icon-caret-up"></i>
                                                    </button>
                                                    <button class="btn spinner-down btn-xs " type="button" data-ng-click="minusQuantity(detail)">
                                                        <i class="icon-caret-down"></i>
                                                    </button>
                                                </div><!-- end ngIf: detail.isSerial==false -->
                                            </div>
                                        </div>
                                        <!-- ngIf: detail.productType == 3 && detail.exchanged != null -->
                                    </td>
                                    <td class="hidden-480 text-right">
                                        <div class="ng-binding">
                                            4,200

                                            <!-- ngIf: allowPriceModified --><span data-ng-show="(orderId == 0 || (saleTypeID > 1 &amp;&amp; orderStatus < 2) ) &amp;&amp; (!saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.isPromotion || saleTypeID == 3)" data-ng-if="allowPriceModified" class="help-button ng-scope ng-hide" tooltip-placement="top" tooltip="Giảm giá" data-ng-click="saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.Detail = detail; pricePop.open($event.target)">
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
                                    <td class="text-right hidden-320 ng-binding">2,100,000</td>
                                    <td class="text-center ng-hide" data-ng-show="orderId == 0 || (saleTypeID > 1 &amp;&amp; orderStatus < 2 ) ">
                                        <a class="red" data-ng-click="deleteProductItem($index)">
                                            <i class="icon-trash bigger-120"></i>
                                        </a>
                                    </td>
                                </tr>
                                <!-- ngIf: detail.isSerial==true && detail.openSerial==true -->
                            </tbody><!-- end ngRepeat: detail in saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.Details -->
                        </table>

                    </div>
                    <div class="alert alert-block alert-success ng-binding ng-hide" ng-show="saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.Details.length==0">Gõ mã hoặc tên hàng hóa vào hộp tìm kiếm để thêm hàng vào đơn hàng</div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-4">
            <div class="widget-box transparent" style="margin-top: 0px !important;">
                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a data-toggle="tab" ng-click="getOrderInfo()">
                                <h4 class="lighter no-margin blue">
                                    <i class="icon-info-sign"></i>
                                    <span class="hidden-320 ng-binding">TT đơn hàng</span>
                                </h4>
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" ng-click="getEvents()">
                                <span class="lighter orange-2"><b class="ng-binding">Lịch sử</b> </span>
                            </a>
                        </li>
                    </ul>


                    <div class="tab-content no-border black padding-0 ">
                        <!-- region customer-->
                        <div id="info" class="tab-pane in active">
                            <div class="widget-body">
                                <div class="widget-main padding-4">
                                    <div class="tab-content padding-8 overflow-visible">
                                        <div class="form-group">
                                            <label class="col-sm-5 control-label no-padding-right ng-binding">Ngày tạo</label>
                                            <div class="col-sm-7">
                                                <div class="input-group input-group-sm width-100">
                                                    <span class="input-group-btn width-100">
                                                        <span class="k-widget k-datetimepicker k-header width-100" style=""><span class="k-picker-wrap k-state-disabled"><input id="saleDatePicker" class="width-100 k-input" type="text" placeholder="Hôm nay" data-role="datetimepicker" style="width: 100%;" role="combobox" aria-expanded="false" aria-disabled="true" aria-readonly="false" disabled="disabled"><span unselectable="on" class="k-select"><span unselectable="on" class="k-icon k-i-calendar" role="button" aria-controls="saleDatePicker_dateview">select</span><span unselectable="on" class="k-icon k-i-clock" role="button" aria-controls="saleDatePicker_timeview">select</span></span></span></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-5 control-label no-padding-right ng-binding" for="form-field-1">Mã phiếu</label>
                                            <label class="col-sm-7 form-value">
                                                <input type="text" class="width-100 ng-pristine ng-valid" placeholder="Hệ thống tự tạo" data-ng-model="saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.Code" disabled="disabled">
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-5 control-label no-padding-right ng-binding" for="form-field-1">Người bán</label>
                                            <div class="col-sm-7">
                                                <select data-ng-disabled="false" class="width-100 ng-pristine ng-valid" data-ng-model="saleOrder.Items[0].SaleOrder.Seller" data-ng-options="user.DisplayName for user in saleOrder.Users"><option value="0">ADMIND SGN</option><option value="1">Kho Thủ Đức</option><option value="2">Kiều Ngân</option><option value="3">Phạm Đức Trung</option><option value="4">Hồng Ngọc</option><option value="5"> Hồng Ngọc (Xưởng)</option><option value="6">Hữu Tiến</option><option value="7">Kho Tân Phú</option><option value="8">Mỹ Diễm</option><option value="9">Thu Nhi</option><option value="10">Fast Box</option><option value="11"> Kim Thoa</option><option value="12">Kiều Ngân (Xưởng)</option><option value="13">Tiến - Xưởng</option><option value="14">Kho Quận 8</option><option value="15"> Kho Quận 11</option><option value="16"> Nhi Đoàn</option><option value="17"> Hữu Tiến BBK</option><option value="18">Thanh Thanh (KT)</option><option value="19"> Kho Gò Vấp</option><option value="20">Mỹ Duyên</option><option value="21">Ly Giấy</option><option value="22">Kim Loan</option><option value="23">Quyền Thư</option><option value="24" selected="selected">Hoài Bảo</option></select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <textarea rows="3" data-ng-model="saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.Comment" class="col-xs-12 ng-pristine ng-valid ng-hide" id="form-field-10" data-ng-hide="orderStatus > 1" placeholder="Ghi chú tại đây"></textarea>
                                                <textarea rows="3" data-ng-model="saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.Comment" class="col-xs-12 ng-pristine ng-valid" id="form-field-10" disabled="disabled" data-ng-show="orderStatus > 1"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group" data-ng-show="orderStatus > 1">
                                            <label class="col-sm-5 control-label no-padding-right"></label>
                                            <div class="col-sm-7 text-right padding-right">
                                                <button id="btnNewComment" class="btn btn-primary btn-sm ng-binding" data-ng-click="modalComment.open();">
                                                    <i class="icon-pen"></i>&nbsp;Thêm ghi chú
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="tracked" class="tab-pane" ng-class="{ 'tracked ' : events.length > 0 }">
                            <!-- ngRepeat: e in events -->
                        </div>
                    </div>
                </div>
            </div>


            <div class="widget-box transparent xs" style="margin-top: 0px !important;">
                <div class="widget-header">
                    <h4 class="lighter ng-binding">
                        <i class="icon-info-sign blue"></i>
                        Khách hàng
                    </h4>
                </div>
                <div class="widget-body">
                    <div class="widget-main padding-4">
                        <div class="tab-content padding-8 overflow-visible">
                            <div class="form-group">
                                <label class="col-sm-5 control-label no-padding-right ng-binding" for="form-field-1">
                                    Họ và tên
                                    <b class="label ng-binding ng-pristine ng-valid ng-hide" data-ng-model="customer.type" style="float:right" data-ng-show="isMultiplePrice" ng-class="{1:'label-warning', 2:'label-success'}[customer.type]"></b>

                                </label>
                                <div class="col-sm-7">
                                    <div class="input-group input-group-sm">
                                        <autoselect ng-model="customerSearchTerm" template-id="customerSearchTempl" attr-placeholder="Tìm khách hàng" attr-selection="name" attr-inputclass="mousetrap" attr-inputid="customerSearchInput" data="searchCustomers" selection="customer" on-type="searchTermChanged" on-select="onCustomerSelected" on-deselect="onCustomerDeselected" on-select-empty="onEmptyListSelect" class="autosearch ng-isolate-scope ng-pristine ng-valid">
                                        <div class="autocomplete " id=""><span class="input-icon input-icon-right ng-hide" style="width:100%;" ng-hide="selecting"><input type="text" ng-model="searchParam" placeholder="Tìm khách hàng" class="mousetrap" id="customerSearchInput"><i class="icon-remove red ng-hide" style="cursor:pointer;" ng-show="searchParam" ng-click="removeText()"></i></span><span class="input-icon input-icon-right" style="width:100%;" ng-show="selecting"><input type="text" ng-model="selection[attrs.selection]" ng-readonly="true" class="ng-pristine ng-valid" readonly="readonly"><i class="icon-remove red" style="cursor:pointer;" ng-click="deselect()"></i><span id="ep-label" class="label label-success autocomplete-label ep-label">2607000&nbsp;điểm</span><span id="ep-label" class="label label-success autocomplete-label ep-label">2607000&nbsp;điểm</span></span><ul ng-show="completing" class="ng-hide">
                                            <!-- ngRepeat: suggestion in suggestions track by $index -->
                                        </ul><ul ng-show="searchParam &amp;&amp; (suggestions == null || suggestions.length == 0)" class="ng-hide"><li>Không tìm thấy kết quả phù hợp</li></ul></div></autoselect>

                                        <span class="input-group-btn ng-scope" data-ng-controller="widgetCreateCustomerController">
                                            <button class="btn btn-primary" style="height: 34px;" title="Tạo mới khách hàng" data-ng-click="cancelCustomer();openCreateCustomerModal();">
                                                <i class="icon-plus bigger-110"></i>
                                            </button>
                                        </span>

                                        <script type="text/x-angular-template" id="customerSearchTempl">
                                            <li suggestionselect ng-repeat="suggestion in suggestions track by $index" style="cursor:pointer;" class="profile-user-info profile-user-info-striped"
                                                index="{{$index}}" val="{{suggestion.name}}" ng-class="{active:($index == selectedIndex)}" ng-click="select(suggestion)">
                                                <div class="profile-info-row">
                                                    <i class="normal-icon icon-user bigger-130 blue"></i>
                                                    <span class="profile-info-value bolder">{{suggestion.name}}</span>
                                                </div>
                                                <div class="profile-info-row">
                                                    <i class="normal-icon icon-reorder bigger-130 blue" title="{{'Customer_Code' | translate}}"></i>
                                                    <span class="profile-info-value">{{suggestion.code}}</span>
                                                </div>
                                                <div ng-show="suggestion.phone" class="profile-info-row">
                                                    <i class="normal-icon icon-phone bigger-130 blue" title="{{'Phone_Number' | translate}}"></i>
                                                    <span class="profile-info-value">{{suggestion.phone}}</span>
                                                </div>
                                            </li>
                                        </script>
                                    </div>
                                </div>


                            </div>
                            <div class="form-group">
                                <label class="col-sm-5 control-label no-padding-right" for="form-field-1">Email</label>
                                <div class="col-sm-7">
                                    <input type="text" class="width-100 ng-pristine ng-valid" data-ng-model="customer.emails[0].email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-5 control-label no-padding-right ng-binding" for="form-field-1">Điện thoại</label>
                                <div class="col-sm-7">
                                    <input type="text" class="width-100 ng-pristine ng-valid" data-ng-model="customer.phone">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-5 control-label no-padding-right ng-binding" for="form-field-1">Địa chỉ</label>
                                <div class="col-sm-7">

                                    <textarea rows="3" class="width-100 ng-pristine ng-valid" placeholder="" data-ng-model="customer.address"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
            </div>

            <div class="widget-box transparent xs" style="margin-top: 0px !important;">
                <div class="widget-header">
                    <h4 class="lighter ng-binding">
                        <i class="icon-info-sign blue"></i>
                        Giao hàng
                    </h4>
                </div>
                <div class="widget-body">
                    <div class="widget-main padding-4">
                        <div class="tab-content padding-8 overflow-visible">
                            <div class="form-group">
                                <label class="col-sm-5 control-label no-padding-right ng-binding" for="form-field-1">Vận chuyển</label>
                                <div class="col-sm-7">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-btn width-100" data-ng-init="initShipper()">
                                            <select class="select-480 ng-pristine ng-valid" data-ng-model="shipper" data-ng-options="c.name for c in shippers" style="margin-top: -3px" data-ng-change="shipperChange(shipper)"><option value="0" selected="selected">--Tất cả--</option><option value="1">Xe tải Mf</option><option value="2">Minh Shiper</option><option value="3">Grap</option><option value="4">GHTK</option><option value="5">Xe máy Mf</option><option value="6">Ninja Van</option><option value="7">Xe số 5</option><option value="8">Lấy trực tiếp</option><option value="9">Xe máy MF</option><option value="10">Nam shipper</option><option value="11">thắng</option><option value="12">truong</option><option value="13">anh phương</option><option value="14">ahamove</option><option value="15">Duy Chánh</option><option value="16">xe van</option><option value="17">Anh Doanh</option><option value="18">viettel</option><option value="19">ANH ĐIỆP</option><option value="20">xe số 2</option><option value="21">Xe số 3</option><option value="22">quốc ạnh</option><option value="23">Nhân shiper</option><option value="24">Xe số 4</option><option value="25">xe số 6</option><option value="26">khách ghé lấy</option><option value="27">khách book grap</option><option value="28">Xe số 1</option></select>
                                        </span>
                                        <span class="input-group-btn">
                                            <button class="btn btn-primary" style="height: 34px;" title="Tạo mới đơn vị vận chuyển" data-ng-click="openPopupShipper(shippers)">
                                                <i class="icon-plus bigger-110"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-5 control-label no-padding-right ng-binding">Ngày giao</label>
                                <div class="col-sm-7">
                                    <div class="input-group input-group-sm width-100">
                                        <span class="input-group-btn width-100">
                                            <span class="k-widget k-datetimepicker k-header width-100" style=""><span class="k-picker-wrap k-state-default"><input id="shippingDatePicker" class="width-100 k-input" type="text" placeholder="Hôm nay" data-role="datetimepicker" style="width: 100%;" role="combobox" aria-expanded="false" aria-disabled="false" aria-readonly="false"><span unselectable="on" class="k-select"><span unselectable="on" class="k-icon k-i-calendar" role="button" aria-controls="shippingDatePicker_dateview">select</span><span unselectable="on" class="k-icon k-i-clock" role="button" aria-controls="shippingDatePicker_timeview">select</span></span></span></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-5 control-label no-padding-right ng-binding">Người giao</label>
                                <div class="col-sm-7">
                                    <div class="input-group input-group-sm width-100">
                                        <span class="input-group-btn width-100">
                                            <input class="width-100 ng-pristine ng-valid" type="text" data-ng-model="saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.shipper.shipper">
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-12">
                                    <textarea rows="3" class="col-xs-12 ng-pristine ng-valid" id="form-field-10" placeholder="Ghi chú tại đây" maxlength="1900" data-ng-model="saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.shipper.comment"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
            </div>
        </div>
        <div class="col-sm-12">
            <div class="text-right">
                <button ng-click="draftOrder()" ng-disabled="isProcessing" class="btn btn-warning ng-hide" data-ng-show="orderStatus < 2 " title="Lưu thành đơn Đặt hàng">
                    <i class="icon-save"></i>
                    <span class="hidden-480 ng-binding">Lưu và tiếp tục</span>
                </button>
                <button ng-click="confirmOrder()" ng-disabled="isProcessing" class="btn btn-primary ng-hide" data-ng-show="saleTypeID > 1 &amp;&amp; orderStatus < 2" title="Lưu và Xác nhận đơn Đặt hàng">
                    <i class="icon-foursquare"></i>
                    <span class="hidden-480 ng-binding">Xác nhận</span>
                </button>
                <button ng-click="cancelOrder(orderId, saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.Code)" title="@*Hủy*@Hủy đơn hàng" class="hidden-480 btn btn-inverse" data-ng-show="orderId != 0 &amp;&amp; saleTypeID != 1 &amp;&amp; orderStatus != 4 &amp;&amp; orderStatus > 1" ng-disabled="isProcessing">
                    <i class="icon-pause"></i>
                    <span class="hidden-480 ng-binding">Hủy</span>
                </button>
                <button ng-click="Confirm_DeliveryOrder()" ng-disabled="isProcessing" title="Bỏ qua Xác nhận , chuyển thẳng tới Giao hàng" class="btn btn-primary ng-hide" data-ng-show="( orderStatus == 1 || orderStatus == 0) &amp;&amp;  saleTypeID == 2">
                    <i class="icon-shopping-cart"></i>
                    <span class="hidden-480 ng-binding">Giao hàng</span>
                </button>
                <button ng-click="onDeliveryOrder()" ng-disabled="isProcessing" title="Giao hàng cho đơn hàng Online" class="btn btn-primary" data-ng-show="orderStatus == 2 &amp;&amp; ( saleTypeID == 2 || saleTypeID == 3)">
                    <i class="icon-shopping-cart"></i>
                    <span class="hidden-480 ng-binding">Giao hàng</span>
                </button>
                <button ng-click="saveOrderOnline()" title="Hoàn Thành" class="btn btn-primary ng-hide" data-ng-show="orderId != 0 &amp;&amp; orderStatus == 3" ng-disabled="isProcessing">
                    <i class="icon-ok"></i>
                    <span class="hidden-480 ng-binding">Hoàn tất</span>
                </button>
                <button ng-click="saveOnlineOrderAndPrint()" title="Hoàn thành và In Đơn hàng" class="hidden-480 btn btn-primary ng-hide" data-ng-show="orderId != 0 &amp;&amp; orderStatus == 3" ng-disabled="isProcessing">
                    <i class="icon-print"></i>
                    <span class="hidden-480 ng-binding">Hoàn tất và in</span>
                </button>
                <button class="btn" type="button" onclick="window.location.href='#/order'">
                    <i class="icon-arrow-left"></i>
                    <span class="hidden-480 ng-binding">Trở về</span>
                </button>
            </div>
        </div>
    </div>
</form>
