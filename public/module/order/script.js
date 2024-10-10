var base_url = window.location.origin;
$(document).on("click","#addProduct",function(){
    var x = $("#renderOrderTable tbody tr").length;
    x = x + 1;
    //custom-select btn btn-filter
    $option_product= $('#choose_item').html();
    $did = generateUUID();
    $("#renderOrderTable tbody").append(
      `<tr>
      <td class="text-center">${x}</td>
      <td colspan="2">
        <input name="item[${ $did }][product_id]" type="hidden" />
        <select name="item[${ $did }][product]" data-required="1" id="product_${ $did }" class="custom-select btn btn-filter">${$option_product}</select>
        <div class="errordiv product_${ $did }" style="display: none;"><div class="arrow"></div>Chọn sản phẩm!</div>
      </td>
      <td>
        <input name="item[${ $did }][qty]" data-required="1" id="qty_${ $did }"  min="1" step="1" class="form-control text-center money" value="1" >
        <div class="errordiv qty_${ $did }" style="display: none;"><div class="arrow"></div>Nhập số lượng!</div>
      </td>
      <td>
        <input name="item[${ $did }][price]" data-required="1" id="price_${ $did }"  data-required="1"  class="form-control text-center money" min='0'   />
        <div class="errordiv price_${ $did }" style="display: none;"><div class="arrow"></div>Nhập số giá tiền hàng hóa!</div>
      </td>
      <td class="text-right"><span class="total"></span></td>
      <td class="text-center"><button  class=" deleteProductItem btnTableActions border-0" data-toggle="modal" data-target="#deleteServiceCard" type="button"><img src="${base_url}/public/themes/admin/carton-crm/dist/img/icon/delete.png" alt="Xóa" width="20px" style="vertical-align: unset"> </button></td></tr>`
    );
    $("#renderOrderTable tbody tr:last-child").find("select[name*=product]").select2();
    $('.money').mask("#,##0", {reverse: true});
});
$(document).on("keyup, change","input[name*=qty], select[name*=product]",function(){
    calcItem($(this));
    calSummary();
});

$(document).on("keyup, change","input[name=shipping_fee]",function(){
    calSummary();
});
function calcItem(e)
{
    tr_item = e.closest("tr");
    qty  =  tr_item.find("input[name*=qty]").val();
    if(tr_item.find("select[name*=product]").length==1)
    {
    product = tr_item.find("select[name*=product]").val();
    tr_item.find("input[name*=product_id]").val(product);
    data = $('#choose_item').find(`option[value='${product}']`).data("json");
    price = tr_item.find("input[name*=price]").val();
    if(price == "" || price == undefined)
    {
        price = data.price;
        tr_item.find("input[name*=price]").val(convert_decimal(price,true));
    }
    tr_item.find("input[name*=price]").val(format_thousand((price)));
    }
    else{
        price =  tr_item.find("input[name*=price]").val();
    }
    tr_item.find(".total").html(format_thousand(convert_decimal(price) * convert_decimal(qty)));
}
function calSummary()
{
    let sub_total=0,total_qty=0;
    $("#renderOrderTable tbody tr:not(.deleted)").each(function(){
        let e = $(this);
        tr_item = e.closest("tr");
        price = tr_item.find("input[name*=price]").val();
        qty  =  tr_item.find("input[name*=qty]").val();
        sub_total += convert_decimal(price) * convert_decimal(qty);
        total_qty += convert_decimal(qty);
    });

    shipping_fee = convert_decimal($("#shipping_fee").val());
    discount_value = convert_decimal($("#discount_value").val());
    total = sub_total + shipping_fee - discount_value;
    total_paid = convert_decimal($("#updateFrm input[name=total_paid]").val());
    $(".summary_subTotal").html(format_thousand(sub_total));
    $(".summary_qty").html(format_thousand(total_qty));
    $(".summary_total").html(format_thousand(total));
    $(".total_paid_label").html(format_thousand(total_paid));
    $(".total_debt_label").html(format_thousand(total - total_paid));
    $(".total_discount_label").html(format_thousand(discount_value));
}
$(document).on("keyup, change","input[name*=price]",function(){
    let e = $(this);
    tr_item = e.closest("tr");
    qty  =  tr_item.find("input[name*=qty]").val();
    price = tr_item.find("input[name*=price]").val();
    tr_item.find(".total").html(format_thousand(convert_decimal(price)*convert_decimal(qty)));
    calSummary();
});

$(".confirmOrder").click(function() {
    title = $(this).find('span').text();
    content = $(this).attr('title');
    let fields  = ["customer_phone", "shipping_district", "shipping_address"];
    $.each(fields,function(index, value)
    {
        $("#"+value).attr("data-required",1);
    });
    if(checkValidate($("#updateFrm")))
    {
        return false;
    }
    else{
        $.confirm({
            title: title,
            content: content,
            type: 'blue',
            buttons: {
                ok: {
                    text: "Xác nhận",
                    btnClass: 'btn-primary',
                    keys: ['enter'],
                    action: function() {
                        $.ajax({
                            method: "POST",
                            url: base_url + "/admin/order/update-status",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                order_id: $("#id").val(),
                                customer_phone: $("#customer_phone").val(),
                                shipping_province: $("#shipping_province").val(),
                                shipping_district: $("#shipping_district").val(),
                                shipping_address: $("#shipping_address").val(),
                                status: 2
                            }
                        }).done(function(res) {
                            if(res.success){
                                showNoti(res.message);
                            }
                            setTimeout(function() {
                                location.reload();
                            }, 2000);
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
    }
});

function onDeliveryOrder(e) {
    // let fields  = ["shippers", "shippingDatePicker", "carrier_name"];
    let fields  = ["shippingDatePicker", "carrier_name"];
    $.each(fields,function(index, value)
    {
        $("#"+value).attr("data-required",1);
    });
    if(checkValidate($("#updateFrm")))
    {
        return false;
    }

    title = $(e).find('span').text();
    content = $(e).attr('title');
    $.confirm({
        title: title,
        content: content,
        type: 'blue',
        buttons: {
            ok: {
                text: "Xác nhận",
                btnClass: 'btn-primary',
                keys: ['enter'],
                action: function() {
                    $.ajax({
                        method: "POST",
                        url: base_url + "/admin/order/update-status",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            order_id: $("#id").val(),
                            // shippers: $("#shippers").val(),
                            delivery_date: $("#shippingDatePicker").val(),
                            carrier_name: $("#carrier_name").val(),
                            shipping_comment: $("#shipping_comment").val(),
                            shipping_fee: $("#shipping_fee").val(),
                            status: 3
                        }
                    }).done(function(res) {
                        if(res.success){
                            showNoti(res.message);
                        }
                        setTimeout(function() {
                            location.reload();
                        }, 2000);

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
}

$(document).on("click","#btn-update-order", function() {
    if($("#renderOrderTable").find("tbody > tr:not(.deleted)").length == 0)
    {
        if($("#id").val()=="")
        {
            showNoti("", "Hóa đơn chưa tạo sản phẩm","error");
        }
        else{
            href = base_url +  '/admin/order/delete/' + $("#id").val();
            $.confirm({
                title: 'Xác nhận!',
                content: 'Đơn hàng không có hàng hoá, bạn có muốn xoá không',
                buttons: {
                    confirm: {
                        text: 'Đồng ý',
                        btnClass: 'btn-blue',
                        keys: ['enter', 'shift'],
                        action: function(){
                            $.LoadingOverlay("show");
                            $.ajax({
                                method: "GET",
                                url: href,
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: {

                                }
                            }).done(function(res) {
                                $.LoadingOverlay("hide");
                                window.location = base_url + "/admin/order";
                            });
                        }
                    },
                    cancel: {
                        text: 'Đóng',
                        btnClass: 'btn-default',
                    }
                }
            });

        }
        return false;
    }

    if(checkValidate($("#updateFrm")))
    {
        return false;
    }
    $("#updateFrm").submit();
});
$(".cancelOrder").click(function() {
    e = $(this);
    $.confirm({
        title: e.find('span').text(),
        content: e.attr('title'),
        type: 'blue',
        buttons: {
            ok: {
                text: "Xác nhận",
                btnClass: 'btn-primary',
                keys: ['enter'],
                action: function() {
                    $.ajax({
                        method: "POST",
                        url: base_url + "/admin/order/update-status",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            order_id: $("#id").val(),
                            status: 5
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
$(".restoreOrder").click(function() {
    e = $(this);
    $.confirm({
        title: e.find('span').text(),
        content: e.attr('title'),
        type: 'blue',
        buttons: {
            ok: {
                text: "Xác nhận",
                btnClass: 'btn-primary',
                keys: ['enter'],
                action: function() {
                    $.ajax({
                        method: "POST",
                        url: base_url + "/admin/order/update-status",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            order_id: $("#id").val(),
                            status: 5
                        }
                    }).done(function(res) {
                        // console.log(res);
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
            // cancel: function(){
            //         console.log('the user clicked cancel');
            // }
        }
    });
});

$(".saveOrderOnline").click(function() {
    e = $(this);
    total_paid = convert_decimal($("input[name=total_paid]").val());
    total = convert_decimal(getTotal());
    // if(total_paid!=total)
    // {
    //     showNoti("Đơn hàng chưa thanh toán xong, không thể hoàn tất đơn hàng","Thông báo","warning");
    //     return false;
    // }
    $.confirm({
        title: e.attr('title'),
        content: e.attr('title'),
        type: 'blue',
        buttons: {
            ok: {
                text: "Xác nhận",
                btnClass: 'btn-primary',
                keys: ['enter'],
                action: function() {
                    $.ajax({
                        method: "POST",
                        url: base_url + "/admin/order/update-status",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            order_id: $("#id").val(),
                            status: 4
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
$(document).on("click","#btnNewComment",function(){
    comment = $("#note").val();
     $.ajax({
        method: "POST",
        url:base_url + "/admin/order/update_comment"+'/'+$("#id").val(),
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            note: comment
        }
    }).done(function(res) {
        showNoti('Update Comment Success', 'Order', 'War');
    });
});
$(document).on("click",".deleteProductItem",function(){
    id = $(this).attr("data-id");
    if(id == undefined)
    {
        $(this).closest('tr').remove();
    }
    else{
        $(this).closest("tr").addClass("deleted");
        $(this).append(`<input type="hidden" name="item[${id}][deleted]" value="1" />`)
        // $(this).closest('tr').addClass("remove");
        $(this).closest('tr').hide();
    }
    calSummary();
});
jQuery('#saleDatePicker').datetimepicker({
    i18n: {
        de: {
            months: [
                'January', 'February', 'March', 'April',
                'May', 'June', 'July', 'August',
                'September', 'October', 'November', 'December',
            ],
            dayOfWeek: [
                "So.", "Mo", "Di", "Mi",
                "Do", "Fr", "Sa.",
            ]
        }
    },
    timepicker: true,
    format: 'Y-m-d H:i:s'
});
jQuery('#shippingDatePicker').datetimepicker({
    i18n: {
        de: {
            months: [
                'January', 'February', 'March', 'April',
                'May', 'June', 'July', 'August',
                'September', 'October', 'November', 'December',
            ],
            dayOfWeek: [
                "So.", "Mo", "Di", "Mi",
                "Do", "Fr", "Sa.",
            ]
        }
    },
    timepicker: false,
    format: 'Y-m-d'
});


$(document).on("click",'.tabbable > .nav-tabs > li >a', function(){
    target = $(this).attr("target");
    $('.tabbable > .nav-tabs > li').removeClass("active");
    $(this).parent().addClass("active");

    $('.tabbable > .tab-content > .tab-pane').removeClass("active");
    $('.tabbable > .tab-content').find(target).addClass("active");
});


$("#btnNewProduct").on("click", function() {
    bindHtml = $("#sample-table-2").find("#new_row_1").html();
    id = generateUUID();
    bindHtml = bindHtml.replaceAll("[id]", "[" + id + "]")
    $("#sample-table-2").find("tbody").append('<tr>'+bindHtml+"</tr>");
    $("#sample-table-2").find("tbody > tr:last-child > td:first-child").html($("#sample-table-2").find( "tbody > tr").length);
    $("#sample-table-2").find("tbody > tr:last-child").find(".select_product").select2();
});

$("#choose_item").on("change", function()
{
    item = $("#choose_item").val();
    json = $("#choose_item").find("option:selected").data('json');
    if(json!=undefined)
    {
        bindHtml = $("#sample-table-2").find("#new_row_2").html();
        id = generateUUID();
        bindHtml = bindHtml.replaceAll("[id]", "[" + id + "]")
        $("#sample-table-2").find("tbody").append('<tr>'+bindHtml+"</tr>");
        tr =$("#sample-table-2").find("tbody > tr:last-child");
        console.log(295, json);
        $("#sample-table-2").find("tbody > tr:last-child > td:first-child").html($("#sample-table-2").find( "tbody > tr").length);
        tr.find(".item_sku_label").html(json.sku);
        tr.find(".item_sku").val(json.sku);
        tr.find(".item_sku").attr("name",`item[${id}][sku]`);
        tr.find(".item_name_label").html(json.name);
        tr.find(".item_name").val(json.name);

        tr.find(".item_product").attr("name",`item[${id}][product_id]`);
        tr.find(".item_product").val(json.id);

        tr.find(".item_name").attr("name",`item[${id}][description]`);
        tr.find(".item_qty").attr("name",`item[${id}][qty]`);

        tr.find(".item_price_label").html(format_thousand(json.price));
        tr.find(".item_price").val(json.price);
        tr.find(".item_price").attr("name",`item[${id}][price]`);
        tr.find(".item_total_price_label").html(format_thousand(json.price));
        // $("#sample-table-2").find("tbody > tr:last-child").find(".select_product").select2();
    }


});

$(document).on("change", ".item_qty", function(){
    tr = $(this).closest("tr");
    price = tr.find('.item_price').val();
    qty = tr.find('.item_qty').val();
    total_price = parseFloat(qty) *  parseFloat(price);
    tr.find('.item_total_price_label').html(format_thousand(total_price));
});
$(document).on("click", ".qty-minus", function(){
    qty = parseFloat( $(this).parent().find('input').val()) - 1;
    if(qty <1)
    {
        qty = 1;
    }
    $(this).parent().find('input').val(qty);
    $(this).parent().find('input').trigger("change");
});
$(document).on("click", ".qty-plus", function(){
    qty = parseFloat( $(this).parent().find('input').val()) + 1;
    $(this).parent().find('input').val(qty);
    $(this).parent().find('input').trigger("change");
});

$(document).on("change", ".update_shipment", function(){
    district = $("#shipping_district").val();
    total_price  = 0;
    $('#sample-table-2 > tbody > tr').each(function(){
        price =  parseFloat(String($(this).find("td:nth-child(6)").text()).trim().replace(/\s/g, '').replace(/,/g, ''));
        total_price += price;
    });
    $.ajax({
        method: "POST",
        url: base_url +  "/admin/order/shipment",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            district_id: district,
            price: total_price
        }
    }).done(function(res) {
        $("#shipping_fee_label").html(format_thousand(res.data.fee));
        $("#shipping_fee").val(format_thousand(res.data.fee));
        calSummary();
    });
});

$(document).on("change", "#shipping_province", function(){
    update_shipment();
});


// function update_shipment()
// {
//     province = $("#shipping_province").val();
//     if(province == "other")
//     {
//         $("#shipping_district").val(0);
//         $("#shipping_district").prop("disabled",true);
//     }
//     else{
//         $("#shipping_district").prop("disabled",false);
//     }
//     $("#shipping_district").trigger("change");
// }
// update_shipment();

function getSubTotal()
{
    total_price  = 0;
    $('#renderOrderTable > tbody > tr').each(function(){
        price =  parseFloat(String($(this).find(".total").text()).trim().replace(/\s/g, '').replace(/,/g, ''));
        total_price += price;
    });
    return total_price;
}

function getTotal()
{
    total_price  = getSubTotal();
    shipping_fee = convert_decimal($("#shipping_fee").val());
    discount_value = convert_decimal($("#discount_value").val());
    return total_price + shipping_fee - discount_value;
}
$(document).on("keydown", ":input:not(textarea)", function(event) {
    if (event.key == "Enter") {
        event.preventDefault();
    }
});


$(document).ready(function(){
    $('.money').mask("#,##0", {reverse: true});
});
