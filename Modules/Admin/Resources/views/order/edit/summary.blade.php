<!-- Tiền hàng -->
<div class="col-md-3 col-sm-6 col-12">
    <div class="info-box">
        <span class="info-box-icon bg-info"><i class="fa fa-shopping-cart" aria-hidden="true"></i>
        </span>

        <div class="info-box-content">
            <span class="info-box-text">Tiền hàng</span>
            <span class="info-box-number summary_subTotal">{{ number_format(@$record->subTotal) }}</span>
        </div>
        <div class="info-box-content">
            <span class="info-box-text">Số lượng</span>
            <span class="info-box-number summary_qty">{{ number_format(@$record->qty) }}</span>
        </div>
        <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
</div>
<!-- Số lượng -->
<div class="col-md-3 col-sm-6 col-12">
    <div class="info-box" id="box-discount">
        <span class="info-box-icon bg-success {{check_rights_function("discount_order",'read') && intval($record->id) != 0 && @$record->status <= 1?'showDiscount':''}}">
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" fill="white">
                <path d="M345 39.1L472.8 168.4c52.4 53 52.4 138.2 0 191.2L360.8 472.9c-9.3 9.4-24.5 9.5-33.9 .2s-9.5-24.5-.2-33.9L438.6 325.9c33.9-34.3 33.9-89.4 0-123.7L310.9 72.9c-9.3-9.4-9.2-24.6 .2-33.9s24.6-9.2 33.9 .2zM0 229.5V80C0 53.5 21.5 32 48 32H197.5c17 0 33.3 6.7 45.3 18.7l168 168c25 25 25 65.5 0 90.5L277.3 442.7c-25 25-65.5 25-90.5 0l-168-168C6.7 262.7 0 246.5 0 229.5zM144 144a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z" />
            </svg>
        </span>

        <div class="info-box-content">
            <span class="info-box-text">Giảm giá</span>
            <span class="info-box-number">
                <b class="total_discount_label">{{ number_format(@$record->discount_value) }}</b>
                @if(check_rights_function("discount_order",'read') && intval($record->id) != 0 &&  @$record->status <= 1)
                <i  class="showDiscount fa fa-gift icon-only green bigger-300" ng-class="saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder.optimal === 3 ?'bigger-150 margin-left-10':'bigger-300' " data-ng-click="openPromotionList(saleOrder.Items[saleOrder.SelectedOrderIndex].SaleOrder , allowPromotionModified)"></i>
                @endif
            </span>
        </div>
        <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
</div>
<!-- Tổng tiền -->
<div class="col-md-3 col-sm-6 col-12">
    <div class="info-box">
        <span class="info-box-icon bg-warning">
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                <path
                    d="M64 0C46.3 0 32 14.3 32 32V96c0 17.7 14.3 32 32 32h80v32H87c-31.6 0-58.5 23.1-63.3 54.4L1.1 364.1C.4 368.8 0 373.6 0 378.4V448c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V378.4c0-4.8-.4-9.6-1.1-14.4L488.2 214.4C483.5 183.1 456.6 160 425 160H208V128h80c17.7 0 32-14.3 32-32V32c0-17.7-14.3-32-32-32H64zM96 48H256c8.8 0 16 7.2 16 16s-7.2 16-16 16H96c-8.8 0-16-7.2-16-16s7.2-16 16-16zM64 432c0-8.8 7.2-16 16-16H432c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16zm48-168a24 24 0 1 1 0-48 24 24 0 1 1 0 48zm120-24a24 24 0 1 1 -48 0 24 24 0 1 1 48 0zM160 344a24 24 0 1 1 0-48 24 24 0 1 1 0 48zM328 240a24 24 0 1 1 -48 0 24 24 0 1 1 48 0zM256 344a24 24 0 1 1 0-48 24 24 0 1 1 0 48zM424 240a24 24 0 1 1 -48 0 24 24 0 1 1 48 0zM352 344a24 24 0 1 1 0-48 24 24 0 1 1 0 48z" />
            </svg>
        </span>
        <div class="info-box-content">
            <span class="info-box-text">Tổng tiền (đã tính ship)</span>
            <span class="info-box-number summary_total">{{number_format(intval(@$record->total))}}</span>
        </div>
        <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
</div>
<!-- Thanh toán -->
<div class="col-md-3 col-sm-6 col-12">
    <div class="info-box" style="pointer-events: auto;">
        <span class="info-box-icon bg-danger {{intval($record->id) != 0 && (check_rights_function(6,'read') && in_array(@$record->status,[1,2,3,4]))?'showPayment':''}}"  data-toggle="popover" title="Thanh toán">
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512" fill="white">
                <path d="M64 32C28.7 32 0 60.7 0 96v32H576V96c0-35.3-28.7-64-64-64H64zM576 224H0V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V224zM112 352h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16zm112 16c0-8.8 7.2-16 16-16H368c8.8 0 16 7.2 16 16s-7.2 16-16 16H240c-8.8 0-16-7.2-16-16z" />
            </svg>
        </span>
        <div class="info-box-content">
            <span class="info-box-text">Đã thanh toán</span>
            <span class="info-box-number">
                <b class="total_paid_label">{{ number_format(@$record->total_paid) }}</b>
                <?php if(@$record->payments_type==1)
                    $type = "fa-solid fa-money-check-dollar";
                    else if(@$record->payments_type==3)
                    $type = "fa-solid fa-money-bill-transfer";
                    else $type = "fa fa-credit-card"
                ?>
                @if (empty($record) || (check_rights_function(6,'read') && in_array(@$record->status,[1,2,3])))
                <i   data-toggle="popover" class="{{intval($record->id) != 0?"showPayment":""}} {{$type}} bigger-230 icon-only blue" ng-class="isHoverAmountPaid ?'orange':'' " title="Thanh toán"></i>
                @endif
            </span>
        </div>
        <div class="info-box-content">
            <span class="info-box-text">Còn lại</span>
            <span class="info-box-number text-red total_debt_label">{{ number_format(@$record->total - @$record->total_paid) }} </span>
        </div>
    </div>
</div>


@push("js")
<!-- Bootstrap CSS -->
{{--
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> --}}
{{--
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet" href="./style.css">
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
    .showPayment {
        color: #0b87c9;
        cursor: pointer;
    }

    .popover-header {
        text-align: center;
        background: #0b87c9;
        color: #fff;
    }

    .popover-body {
        width: 265px;
        padding: 0px;
        margin: 0px;
        height: 185px;
    }

    .popover-body .form-group {
        margin: 10px 0;
    }

    .popover-body .payment-type.input-group {
        position: relative;
        display: flex;
        flex-wrap: wrap;
        align-items: stretch;
        width: 100%;
        gap: 10px;
    }

    .popover-body .newPayment input {
        max-width: 70%;
    }

    .btn-popover-close {
        position: absolute;
        top: -27px;
        right: 43px;
        border: 1px solid rgba(51, 51, 51, 0.2);
        padding: 0 10px;
        border-radius: 5px;
    }

    .btn-popover-close .km-text {
        color: #fff;
    }

    .infobox-icon {
        position: relative;
        top: 10px;
        right: -30px;
    }

    .infobox-icon i {
        position: absolute;
    }

    /* showDiscount */
    .showDiscount {
        cursor: pointer;
    }
</style>
<script>
    $(document).ready(function(){
        $(".showPayment").popover({
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
        $('.showPayment').on('inserted.bs.popover', function ()
        {
            $('.money').mask("#,##0", {reverse: true});
        })


        $(document).on('click',".btn-popover-close",function(){
            $("[data-toggle='popover']").popover('hide');
        });

        $(document).on('click',"#makeNewPayment",function(){
            payment_new_value = convert_decimal( $(this).parent().find("#newPaymentChange").val());
            payment_type = $(this).closest(".popover-content").find(".newPaymentType:checked").val()

            console.log(211, getTotal());
            if(payment_new_value > getTotal())
            {
                showNoti("Tiền thanh toán không được lớn hơn tổng tiền đơn hàng","Thông báo","warning");
            }
            else{

                $.confirm({
                    title: "Xác nhận",
                    content: "Cập nhật thanh toán",
                    type: 'blue',
                    buttons: {
                        ok: {
                            text: "Xác nhận",
                            btnClass: 'btn-primary',
                            keys: ['enter'],
                            action: function() {
                                if($("#id").val()!="")
                                {

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
                                        if(res.success){
                                            $("[data-toggle='popover']").popover('hide');
                                            showNoti(res.message);
                                        }
                                        setTimeout(function() {
                                            location.reload();
                                        }, 2000);
                                        // location.reload();
                                    });
                                }
                                else{
                                    $("[data-toggle='popover']").popover('hide');
                                    $("#updateFrm input[name=payments_type]").val(payment_type);
                                    $("#updateFrm input[name=total_paid]").val(payment_new_value);
                                    calSummary();
                                }
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
            }

        });
    });
</script>
<div class="popover-popup km-popover-root" style="display: none;" id="popup-payment">
    <div class="popover-popup-container">
        <div class="km-popup-wrapper km-center k-popup k-group k-reset k-state-border-up" style="width: 280px;padding: 10px; display: block; opacity: 1; position: absolute;" data-role="popup">
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
                    <div data-role="content" class="km-content km-widget km-scroll-wrapper" id="popup-payment-wrapper">
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
                                                <input id="newPaymentChange"  value="{{ number_format(@$record->total) }}" class="form-control search-query text-right ng-pristine ng-valid money" auto-numeric="{vMin: 0, vMax: 99999999999999999999}" maxlength="20">
                                                <span id="makeNewPayment" class="input-group-btn">
                                                    <button type="button" class="btn btn-primary" title="Đồng ý" style="margin-left: 5px;">
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
    .showDiscount {
        cursor: pointer;
    }

    #popup-discount-wrapper .km-header {
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
        border: 1px solid rgba(51, 51, 51, 0.2);
        padding: 0 10px;
        border-radius: 5px;
    }

    #popup-discount-wrapper .text-title {
        padding: 5px;
    }

    #popup-discount-wrapper .input-group {
        position: relative;
        display: flex;
        flex-wrap: wrap;
        align-items: stretch;
        width: 100%;
    }

    #popup-discount-wrapper .btn-discount {
        background: #AABBC3;
        color: #fff;
    }
</style>
<script>
    $(document).ready(function(){
        $(".showDiscount").popover({
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
        $('.showDiscount').on('inserted.bs.popover', function () {
            $('.money').mask("#,##0", {reverse: true});
        })

        $(document).on('click',"#popup-discount-wrapper .btn-popover-close",function(){
            $(this).closest(".popover").popover('hide');
            $(this).closest(".popover").removeClass('show');
        });
        $(document).on('click',".btn-discount",function(){
            tag =  $(this).closest("#popup-discount-wrapper");
            value = $(this).data('value');
            total = getSubTotal();
            tag.find("#discount_type").val(2);
            tag.find("#discount_percent").val(value);
            tag.find("#discount_value").val(format_thousand(total*value/100));
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

                            if($("#id").val()!="")
                            {
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
                                    // location.reload();
                                    if(res.success){
                                        $("[data-toggle='popover']").popover('hide');
                                        showNoti(res.message);
                                    }
                                    setTimeout(function() {
                                        location.reload();
                                    }, 2000);
                                });
                            }
                            else{
                                // $("[data-toggle='popover']").popover('hide');
                                $(".popover").popover('hide');
                                $(".popover").removeClass('show');
                                $("#updateFrm input[name=discount_value]").val(discount_value);
                                $("#updateFrm input[name=discount_type]").val(discount_type);
                                $("#updateFrm input[name=discount_percent]").val(discount_percent);
                                calSummary();
                            }
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
        // function getSubTotal()
        // {
        //     total_price  = 0;
        //     $('#sample-table-2 > tbody > tr').each(function(){
        //         price =  parseFloat(String($(this).find(".total").text()).trim().replace(/\s/g, '').replace(/,/g, ''));
        //         total_price += price;
        //     });
        //     return total_price;
        // }
    });
</script>
@endpush

<div class="popover-popup km-popover-root" style="display: none;" id="popup-discount">
    <div class="popover-popup-container">
        <div class="km-popup-wrapper km-center k-popup k-group k-reset k-state-border-up" data-role="popup">
            <div class="km-popup-arrow" style="display: block; left: 30px;"></div>
            <div class="km-widget km-popup km-pane" style="">
                <div class="k-pop-container ng-scope km-widget km-view">

                    <div data-role="content" class="km-content km-widget km-scroll-wrapper" id="popup-discount-wrapper">
                        <div data-role="header" class="ng-scope km-header">
                            <div data-role="navbar" class="km-widget km-navbar">
                                <div class="km-rightitem">

                                    <h3 class="popover-header"> Giảm giá</h3>
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
                                                <input id="discount_value" value="{{ @$record->discount_value }}" class="form-control search-query text-right ng-pristine ng-valid money" auto-numeric="{vMin: 0, vMax: 99999999999999999999}" maxlength="20">
                                                <span id="applyDiscount" class="input-group-btn">
                                                    <button type="button" class="btn btn-primary" title="Đồng ý" style="margin-left: 5px;">
                                                        <i class="fa fa-check bigger-110"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                        <input id="discount_type" value="{{ @$record->discount_type }}" type="hidden">
                                        <input id="discount_percent" value="{{ @$record->discount_percent }}" type="hidden">
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
