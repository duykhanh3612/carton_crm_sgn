@if(!empty($record))
<div class="row">
    <div class="col-6 col-lg-3">
        <div class="col-xs-12 alert alert-warning" style="padding: 5px; min-height: 75px">
            <div class="col-xs-9 padding-left-3" style="padding-right: 0">
                <span title="@*Tiền hàng*@Tiền hàng" class="ng-binding">Tiền hàng
                    <b class="ng-binding">{{ number_format(@$record->subTotal) }}</b>
                </span>
                <br>
                <span title="@*Số lượng*" class="ng-binding">
                    Số lượng <b class="ng-binding">{{ @$record->qty }}</b>
                </span>
                <br class="ng-hide">
                {{-- <span title="SubFee" class="ng-binding ng-hide">Phụ phí <b class="ng-binding"></b></span> --}}
            </div>
            <div class="infobox-icon smaller-90 ng-hide" ng-mouseover="isHoverSubFee = true" ng-mouseleave="isHoverSubFee = false" data-ng-show="orderId == 0 || (saleTypeID > 1 &amp;&amp; orderStatus < 2 )">
                <i class="fa fa-truck bigger-280 icon-only orange-2" ng-class="isHoverSubFee ?'blue':'' " data-ng-click="openSubFee($event.target);" title="Phí vận chuyển"></i>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="row alert alert-warning" style="padding: 5px; min-height: 75px">
            <div class="col-9 padding-left-3" style="padding-right: 0">
                <span class="ng-binding">Giảm giá <b data-ng-show="saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.IsDiscountPercent == true" class="ng-binding ng-hide">0 % </b></span>
                <br>
                <span><b class="ng-binding">{{ number_format(@$record->discount_value) }}</b></span>
            </div>
            <div class="col-3 infobox-icon" data-ng-show="(saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.saleTypeID < 3 &amp;&amp; (saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.promotions.length > 1 &amp;&amp; (saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.optimal === 1 || saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.optimal === 2)) || (saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.optimal === 3)) &amp;&amp; saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.saleTypeID != 3"
                title="Danh sách chương trình khuyến mãi" style="margin-top: -4px;" >
                @if (empty($record) || in_array(@$record->status,[1]))
                {{-- <span data-ng-controller="widgetPromotionApplyController" class="ng-scope"> --}}
                    <i id="showDiscount" class="fa fa-gift icon-only green bigger-300" ng-class="saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.optimal === 3 ?'bigger-150 margin-left-10':'bigger-300' " data-ng-click="openPromotionList(saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder , allowPromotionModified)"></i>
                {{-- </span> --}}
                @endif
            </div>
            <div class="infobox-icon ng-hide" data-ng-show="orderStatus <= 1 &amp;&amp; (!saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.isPromotion || saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.saleTypeID == 3)" ng-mouseover="isHoverDiscount = true" ng-mouseleave="isHoverDiscount = false">
                <i class="fa fa-gift bigger-300 icon-only orange-2" ng-class="isHoverDiscount ?'blue':'' " data-ng-click="openDiscount($event.target)" title="Giảm giá đơn hàng"></i>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="col-xs-12 alert alert-warning" style="padding: 5px; min-height: 75px">
            <div class="col-xs-9 padding-left-3" style="padding-right: 0">
                <span data-ng-if="applyEarningPoint" title="Tiền quy đổi" class="ng-binding ng-scope">Phí vận chuyển<b class="ng-binding"> {{number_format($record->shipping_fee)}}</b>
                </span>
                <br data-ng-if="applyEarningPoint" class="ng-scope">

                <span title="@*Tổng cộng" class="ng-binding">Tổng tiền
                    <b class="ng-binding">{{number_format($record->total)}}</b>
                </span>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="row alert alert-warning" style="padding: 5px; min-height: 75px">
            <div class="col-9 padding-left-3" style="padding-right: 0">
                <span class="ng-binding">Thanh toán <b class="ng-binding">{{ number_format(@$record->total_paid) }} </b></span>
            </div>
            <div class="col-3  infobox-icon">
                @if (empty($record) || in_array(@$record->status,[1]))
                <i  id="showPayment" data-toggle="popover"class="fa fa-credit-card bigger-230 icon-only blue" ng-class="isHoverAmountPaid ?'orange':'' " title="Thanh toán"></i>
                @endif
            </div>
            <div class="col-xs-12 padding-left-3" style="padding-right: 0">
                <span class="smaller-80">
                    <i data-ng-show="moreAmountPaid <= 0" class="ng-binding">Còn lại </i>
                    <b class="bigger-120 red ng-binding">{{ number_format(@$record->total - @$record->total_paid) }} </b>
                </span>
            </div>
        </div>
    </div>
    {{-- <div class="col-xs-12 text-left" style="clear:both;position:relative" data-ng-show="saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.saleTypeID < 3">
        <div class="alert alert-block alert-info padding-10 ng-binding ng-hide" data-ng-show="orderStatus < 2 &amp;&amp;  saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.isPromotion &amp;&amp; saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.onBillPromotionSelected != null">
            Chương trình khuyến mãi áp dụng
            <b class="span span-success ">
                <a target="_blank" style="color:white" href="#/promotion/edit/" class="ng-binding">[]</a>
            </b>
        </div>
        <div class="alert alert-block alert-info padding-10 ng-binding ng-hide" data-ng-show="orderStatus >= 2 &amp;&amp; saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.promotionID > 0 ">
            Chương trình khuyến mãi áp dụng <b class="span span-success "><a target="_blank" style="color:white" href="#/promotion/edit/0" class="ng-binding">[]</a> </b>
        </div>
    </div> --}}
</div>
@endif

@push("js")
<!-- Bootstrap CSS -->
{{-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet"> --}}
{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script><link rel="stylesheet" href="./style.css">
 --}}

{{--

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script> --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script> --}}
{{-- <script>
    $(document).ready(function(){
        $("[data-toggle=popover]").popover({
            html: true,

        });
    });
</script> --}}
{{-- <div class="popover-block-container">
    <button tabindex="0" type="button" class="popover-icon" data-popover-content="#km-popup-overlay" data-toggle="popover" data-placement="bottom">
      <i class="material-icons">info</i>
    </button>

  </div> --}}
<style type="text/css">
#showPayment{
    color: #0b87c9;
    cursor: pointer;
}
.popover-header{
    text-align: center;
    background: #0b87c9;
    color: #fff;
}
.popover-body{
    width: 265px;
    padding: 0px;
    margin: 0px;
    height: 150px;
}
.popover-body .form-group{
    margin: 10px 0;
}
.popover-body .payment-type.input-group{
    position: relative;
    display: flex;
    flex-wrap: wrap;
    align-items: stretch;
    width: 100%;
    gap: 10px;
}
.popover-body .newPayment input{
    max-width: 70%;
}
.btn-popover-close
{
    position: absolute;
    top: -27px;
    right: 43px;
    border: 1px solid rgba(51,51,51,0.2);
    padding: 0 10px;
    border-radius: 5px;
}
.btn-popover-close .km-text{
    color: #fff;
}

.infobox-icon{
    position: relative;
    top: 10px;
    right: -30px;
}
.infobox-icon i{
    position: absolute;
}
/* showDiscount */
#showDiscount{
    cursor: pointer;
}
</style>
<script>
    $(document).ready(function(){
        $("#showPayment").popover({
            html : true,
            trigger: 'click',
            placement: 'left',
            sanitize  : false,
            content: function() {
                // var content = $(this).attr("data-popover-content");
                // return $(content).children(".popover-body").html();
                return $("#popup-payment").html();
            }
        });
        $(document).on('click',".btn-popover-close",function(){
            $("[data-toggle='popover']").popover('hide');
        });

        $(document).on('click',"#makeNewPayment",function(){
            payment_new_value = $(this).parent().find("#newPaymentChange").val();
            payment_type = $(this).closest(".popover-content").find(".newPaymentType:checked").val()

            $.confirm({
                title: "Xác nhận",
                content: "Cập nhật  thanh toán",
                type: 'blue',
                buttons: {
                    ok: {
                        text: "Xác nhận",
                        btnClass: 'btn-primary',
                        keys: ['enter'],
                        action: function() {
                            $.ajax({
                                method: "POST",
                                url: base_url + "/admin/order/update-payment",
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: {
                                    order_id: $("#id").val(),
                                    payment_new_value: payment_new_value,
                                    payment_type: payment_type
                                }
                            }).done(function(res) {
                                location.reload();
                            });
                        }
                    },
                    cancel: {
                        text: "Hủy",
                        btnClass: 'btn-back',
                        keys: ['enter'],
                        action: function() {
                            console.log('the user clicked cancel');
                        }
                    },
                }
            });

        });
    });
</script>
<div class="popover-popup km-popover-root" style="display: none;"  id="popup-payment">
    <div class="popover-popup-container" >
        <div class="km-popup-wrapper km-center k-popup k-group k-reset k-state-border-up" style="width: 300px; display: block; opacity: 1; position: absolute;" data-role="popup">
            <div class="km-popup-arrow" style="display: block; left: 30px;"></div>
            <div class="km-widget km-popup km-pane" style="">
                <div class="k-pop-container ng-scope km-widget km-view">
                    <div data-role="header" class="ng-scope km-header">
                        <div data-role="navbar" class="km-widget km-navbar">
                            <div class="km-rightitem">
                                <a data-align="right" ng-click="paymentPop.close()" data-role="button" class="km-widget km-button btn-popover-close">
                                    <span class="ng-scope km-text">X</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div data-role="content" class="km-content km-widget km-scroll-wrapper" id="popup-payment-wrapper" >
                        <div class="km-scroll-container">
                            <div class="control-group ng-scope">
                                <div class="form-group">
                                    <span class="col-sm-5 col-xs-6 black no-padding-right">Tổng tiền:</span>
                                    <span class="col-sm-7 col-xs-6 form-value">
                                        <b class="red ng-binding">{{ number_format(@$record->total) }}</b>
                                    </span>
                                </div>
                                {{-- <div class="form-group " data-ng-show="orderStatus <= 1">

                                    <div class="radio" style="clear: both">
                                        <span>
                                            <input class="ace ng-pristine ng-valid" type="radio" data-ng-model="saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.PaymentMethod" value="1" name="029">
                                            <span class="lbl ng-binding">Tiền mặt </span>
                                        </span>
                                        <span>
                                            <input class="ace ng-pristine ng-valid" type="radio" data-ng-model="saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.PaymentMethod" value="2" name="02A">
                                            <span class="lbl ng-binding">Thẻ</span>
                                        </span>
                                        <span>
                                            <input class="ace ng-pristine ng-valid" type="radio" data-ng-model="saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.PaymentMethod" value="3" name="02B">
                                            <span class="lbl ng-binding">CK</span>
                                        </span>
                                    </div>
                                    <div>
                                        <span class="col-xs-5 black ng-binding" style="margin-top: 3%">Đã thanh toán </span>
                                        <span class="col-xs-7">
                                            <input id="AmountPaid" type="text" class="price numeric input-medium number mousetrap pull-right ng-pristine ng-valid" data-ng-model="saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.AmountPaid" data-ng-change="saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.IsPaid = true; isNewPayment = false" auto-numeric="{vMin: 0, vMax:99999999999999999999}" maxlength="20">
                                        </span>
                                    </div>

                                </div> --}}
                                <div class="form-group" style="clear: both">
                                    <div data-ng-show="isNewPayment" class="">
                                        <div>
                                            <span class="col-sm-5 control-span no-padding-right black ng-binding"><b>Đã thanh toán</b></span>
                                            <span class="col-sm-3 form-value black ng-binding">
                                                {{ number_format(@$record->total_paid) }}
                                            </span>
                                        </div>
                                        <div class="popover-content">
                                            <div class="payment-type input-group col-sm-12">
                                                <div>
                                                    <input type="radio" {{@$record->payments_type==1?"checked":""}} class="newPaymentType ng-pristine ng-valid" name="form-field-radio-new" value="1">
                                                    <span class="lbl ng-binding">Tiền mặt</span>
                                                </div>
                                                <span>
                                                    <input type="radio" {{@$record->payments_type==3?"checked":""}} class="newPaymentType ng-pristine ng-valid" name="form-field-radio-new" value="3">
                                                    <span class="lbl ng-binding">CK</span>
                                                </span>
                                                <span>
                                                    <input type="radio" {{@$record->payments_type==2?"checked":""}} class="newPaymentType ng-pristine ng-valid" name="form-field-radio-new" value="2">
                                                    <span class="lbl ng-binding">Thẻ</span>
                                                </span>
                                            </div>
                                            <div class="col-sm-12 newPayment input-group">
                                                <input id="newPaymentChange" type="number" value="{{ @$record->total }}" class="form-control search-query text-right ng-pristine ng-valid" auto-numeric="{vMin: 0, vMax: 99999999999999999999}" maxlength="20">
                                                <span id="makeNewPayment" class="input-group-btn">
                                                    <button type="button" class="btn btn-primary" title="Đồng ý" style="margin-left: 5px;" >
                                                        <i class="fa fa-check bigger-110"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <span class="col-sm-5 control-span no-padding-right black">
                                        <i data-ng-show="moreAmountPaid <= 0" class="ng-binding">Còn lại </i>
                                        <i data-ng-show="moreAmountPaid > 0" class="ng-hide">Tiền thừa </i>
                                    </span>
                                    <span data-ng-hide="isNewPayment" class="col-sm-3 form-value red ng-hide"><i class="ng-binding">{{ number_format(@$record->total) }}</i></span>
                                    <span data-ng-show="isNewPayment" class="col-sm-3 form-value red"><i class="ng-binding">{{ number_format(@$record->total - @$record->total_paid) }} </i></span>
                                </div>
                            </div>
                        </div>
                        <div class="km-touch-scrollbar km-horizontal-scrollbar" style="transform-origin: left top; display: none; width: 298px;"></div>
                        <div class="km-touch-scrollbar km-vertical-scrollbar" style="transform-origin: left top; display: none; height: 174px;"></div>
                    </div>
                    <div style="height: 100%; width: 100%; position: absolute; top: 0; left: 0; z-index: 20000; display: none"></div>
                </div>
                {{-- <div class="km-loader km-widget" data-role="loader" style="display: none;"><span class="km-loading km-spin"></span><span class="km-loading-left"></span><span class="km-loading-right"></span>
                    <h1>Loading...</h1>
                </div> --}}
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    #showDiscount{
        cursor: pointer;
    }
    #popup-discount-wrapper  .km-header {
        text-align: center;
        background: #0b87c9;
        color: #fff;
        height: 29px;
        border-radius: 5px 5px 0 0;
        width: 265px;
    }
    #popup-discount-wrapper .btn-popover-close {
        position: absolute;
        top: 5px;
        right: 5px;
        border: 1px solid rgba(51,51,51,0.2);
        padding: 0 10px;
        border-radius: 5px;
    }
    #popup-discount-wrapper .text-title{
        padding: 5px;
    }
    #popup-discount-wrapper  .input-group{
        position: relative;
        display: flex;
        flex-wrap: wrap;
        align-items: stretch;
        width: 100%;
    }
    #popup-discount-wrapper .btn-discount{
        background: #AABBC3;
        color: #fff;
    }
</style>
<script>
    $(document).ready(function(){
        $("#showDiscount").popover({
            html : true,
            trigger: 'click',
            placement: 'left',
            sanitize  : false,
            content: function() {
                // var content = $(this).attr("data-popover-content");
                // return $(content).children(".popover-body").html();
                return $("#popup-discount").html();
            }
        });

        $(document).on('click',"#popup-discount-wrapper .btn-popover-close",function(){
            $(this).closest(".popover").popover('hide');
            $(this).closest(".popover").removeClass('show');
        });
        $(document).on('click',".btn-discount",function(){
            tag =  $(this).closest("#popup-discount-wrapper");
            value = $(this).data('value');
            total = getTotal();
            tag.find("#discount_type").val(2);
            tag.find("#discount_percent").val(value);
            tag.find("#discount_value").val(total*value/100);
        });

        $(document).on('click',"#applyDiscount",function(){
            tag =  $(this).closest("#popup-discount-wrapper");
            discount_value = tag.find("#discount_value").val();
            discount_type = tag.find("#discount_type").val();
            discount_percent = tag.find("#discount_percent").val();
            $.confirm({
                title: "Xác nhận",
                content: "Cập nhật giảm giá",
                type: 'blue',
                buttons: {
                    ok: {
                        text: "Xác nhận",
                        btnClass: 'btn-primary',
                        keys: ['enter'],
                        action: function() {
                            $.ajax({
                                method: "POST",
                                url: base_url + "/admin/order/update-discount",
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: {
                                    order_id: $("#id").val(),
                                    discount_value: discount_value,
                                    discount_type: discount_type,
                                    discount_percent: discount_percent
                                }
                            }).done(function(res) {
                                location.reload();
                            });
                        }
                    },
                    cancel: {
                        text: "Hủy",
                        btnClass: 'btn-back',
                        keys: ['enter'],
                        action: function() {
                            console.log('the user clicked cancel');
                        }
                    },
                }
            });

        });
        function getTotal()
        {
            total_price  = 0;
            $('#sample-table-2 > tbody > tr').each(function(){
                price =  parseFloat(String($(this).find("td:nth-child(6)").text()).trim().replace(/\s/g, '').replace(/,/g, ''));
                total_price += price;
            });
            return total_price;
        }

    });
</script>
@endpush

<div class="popover-popup km-popover-root" style="display: none;"  id="popup-discount">
    <div class="popover-popup-container" >
        <div class="km-popup-wrapper km-center k-popup k-group k-reset k-state-border-up" data-role="popup">
            <div class="km-popup-arrow" style="display: block; left: 30px;"></div>
            <div class="km-widget km-popup km-pane" style="">
                <div class="k-pop-container ng-scope km-widget km-view">

                    <div data-role="content" class="km-content km-widget km-scroll-wrapper" id="popup-discount-wrapper" >
                        <div data-role="header" class="ng-scope km-header">
                            <div data-role="navbar" class="km-widget km-navbar">
                                <div class="km-rightitem">

                                    <h3 class="popover-header">  Giảm giá</h3>
                                    <a data-align="right" ng-click="paymentPop.close()" data-role="button" class="km-widget km-button btn-popover-close">
                                        <span class="ng-scope km-text">X</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="km-scroll-container">
                            <div class="control-group ng-scope">
                                <div class="form-group" style="clear: both">
                                    <div data-ng-show="isNewPayment" class="">
                                        <div class="popover-content">
                                            <div class="col-sm-12 newPayment input-group">
                                                <label class="text-title">Giảm</label>
                                                <input id="discount_value" type="number" value="{{ @$record->discount_value }}" class="form-control search-query text-right ng-pristine ng-valid" auto-numeric="{vMin: 0, vMax: 99999999999999999999}" maxlength="20">
                                                <span id="applyDiscount" class="input-group-btn">
                                                    <button type="button" class="btn btn-primary" title="Đồng ý" style="margin-left: 5px;" >
                                                        <i class="fa fa-check bigger-110"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                        <input id="discount_type" value="{{ @$record->discount_type }}" type="hidden" >
                                        <input id="discount_percent" value="{{ @$record->discount_percent }}" type="hidden" >
                                    </div>
                                </div>
                                <div class="form-group  text-center">
                                    <button class="btn btn-discount" data-value="5">5%</button>
                                    <button class="btn btn-discount" data-value="10">10%</button>
                                    <button class="btn btn-discount" data-value="15">15%</button>
                                </div>
                            </div>
                        </div>
                        <div class="km-touch-scrollbar km-horizontal-scrollbar" style="transform-origin: left top; display: none; width: 298px;"></div>
                        <div class="km-touch-scrollbar km-vertical-scrollbar" style="transform-origin: left top; display: none; height: 174px;"></div>
                    </div>
                    <div style="height: 100%; width: 100%; position: absolute; top: 0; left: 0; z-index: 20000; display: none"></div>
                </div>
                {{-- <div class="km-loader km-widget" data-role="loader" style="display: none;"><span class="km-loading km-spin"></span><span class="km-loading-left"></span><span class="km-loading-right"></span>
                    <h1>Loading...</h1>
                </div> --}}
            </div>
        </div>
    </div>
</div>
