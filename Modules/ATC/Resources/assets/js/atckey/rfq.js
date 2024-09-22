function updateDataSum() {
    var attr_total = 0, percent_total = 0,
    attr_cop = 0,
    attr_cop = 0,
    Bank_total = 0,
    Delivery_total = 0,
    Declare_total = 0,
    Other_total = 0;
//console.log(123323);
    $('#attribution tbody tr').each(function () {
        Bank_total += parseFloat($(this).find('.attr-Bank').val().replace(/\s/g, '').replace(/,/g, ''));
        Delivery_total += parseFloat($(this).find('.attr-Delivery').val().replace(/\s/g, '').replace(/,/g, ''));
        Declare_total += parseFloat($(this).find('.attr-Declare').val().replace(/\s/g, '').replace(/,/g, ''));
        Other_total += parseFloat($(this).find('.attr-Other').val().replace(/\s/g, '').replace(/,/g, ''));
        attr_total += parseFloat($(this).find('.attr-total').val().replace(/\s/g, '').replace(/,/g, ''));
        attr_cop += parseFloat($(this).find('.attr-Cop').val().replace(/\s/g, '').replace(/,/g, ''));
        // percent_total += parseFloat($(this).find('.attr-percent').val().replace(/\s/g, '').replace(/,/g, ''));
    })
    $('#Bank_total').text(accounting.formatMoney(Bank_total, '', 2));
    $('#Delivery_total').text(accounting.formatMoney(Delivery_total, '', 2));
    $('#Declare_total').text(accounting.formatMoney(Declare_total, '', 2));
    $('#Other_total').text(accounting.formatMoney(Other_total, '', 2));
    $('#cost_total').text(accounting.formatMoney(attr_total, '', 2));
    $('#Cop_total').text(accounting.formatMoney(attr_cop, '', 2));
    if(!!attr_total && !!attr_cop){
        percent_total = ( attr_total /  attr_cop ) * 100 ;
    }else {
        percent_total = 0 ;
    }
    $('#percent_total').text(accounting.formatMoney(percent_total, '', 1));
    // $('#percent_total').text(accounting.formatMoney(percent_total, '', 1));
    // $('#attr-percent').text(accounting.formatMoney(percent_total, '', 1)+'%');
    //$('#attr-percent').text(accounting.formatMoney( tfoot_costperunit_total/(costofgoodssold_total+tfoot_qty_total), '', 3) );

    //alert(attr_total);

}

$(document).ready(function ($) {
   

    var costofgoodssold_total = parseFloat($('.tfoot-costofgoodssold').text().replace(/\s/g, '').replace(/,/g, ''));
    var tfoot_qty_total = parseFloat($('.tfoot-qty').text().replace(/\s/g, '').replace(/,/g, ''));
    var tfoot_qty_total = parseFloat($('.tfoot-qty').text().replace(/\s/g, '').replace(/,/g, ''));
    var tfoot_costperunit_total = parseFloat($('.tfoot-costperunit').text().replace(/\s/g, '').replace(/,/g, ''));
    $('#attr-percent').text(accounting.formatMoney(tfoot_costperunit_total / (costofgoodssold_total + tfoot_qty_total), '', 3));


    // var tfoot_sp_amount = parseFloat($('.tfoot-sp-amount').text().replace(/\s/g, '').replace(/,/g, ''));
    // var tfoot_cpo_amount = parseFloat($('#Cop_total').text().replace(/\s/g, '').replace(/,/g, ''));
    // $('#percent_total').text(accounting.formatMoney((tfoot_sp_amount - tfoot_cpo_amount )/tfoot_sp_amount, '', 3));

    updateDataSum();
    $('#updateFrm').submit(function () {
        var flag = false;
        $('.calculate_cost').each(function () {
            $(this).parent().prev().css({'border-color': '#ccc'});
            if ($(this).hasClass('btn-default') && !$(this).is(':disabled')) {
                $(this).parent().prev().css({'border-color': 'red'});
                flag = true;
            }
        })
        if (flag) {
            showNoti('Cost chưa được tính', 'Cảnh báo', 'War');
            return false;
        }
    });

    $('body').on('click', '.btn-sale-rfq', function () {
        var btnThis = $(this);
        var rfq_id = $('#id').val();
        var updates = parseInt($(this).data('update'));
        var salesorder_id = $('[name="SalesOrderID"]').val();
        var keys = [];
        var values = [];

        var tr = $(this).parent().parent();
        tr.find('.up-so').val(updates + 1);
        var key = tr.attr('id');
        tr.find('input[name^=products], textarea[name^=products], select[name^=products]').each(function () {
            // if (!$(this).attr('readonly')) {
            var field = $(this).attr('name').replace('products[' + key + '][', '').replace(']', '');
            var value = $(this).val();
            keys.push(field);
            values.push(value);
            // }
        });
        $.ajax({
            url: site_url + 'rfq/update_sale_rfq',
            type: 'POST',
            data: {
                rfq_id: rfq_id,
                salesorder_id: salesorder_id,
                keys: keys,
                values: values
            },

            success: function (string) {
                if (string == 1) {
                    btnThis.data('update', updates + 1);
                    btnThis.find('span').text(updates + 1);
                    showNoti('Supplier Part #: ' + tr.find('.supplier-part').val(), 'Sales Order update successful', 'Ok');
                    if (updates == 0) {
                        btnThis.removeClass('btn-default').addClass('btn-success');
                    } else if (updates == 1) {
                        btnThis.removeClass('btn-success').addClass('btn-danger');
                    } else if (updates == 2) {
                        btnThis.removeClass('btn-danger').addClass('btn-warning');
                    } else if (updates == 3) {
                        btnThis.removeClass('btn-warning').addClass('btn-info');
                    } else if (updates == 4) {
                        btnThis.removeClass('btn-info').addClass('btn-yellow');
                    } else if (updates == 5) {
                        btnThis.removeClass('btn-yellow').addClass('btn-purple');
                    } else if (updates == 6) {
                        btnThis.removeClass('btn-purple').addClass('btn-azure');
                    } else if (updates == 7) {
                        btnThis.removeClass('btn-azure').addClass('btn-black');
                    } else if (updates == 8) {
                        btnThis.removeClass('btn-black').addClass('btn-blue-alt');
                    } else {
                        btnThis.removeClass('btn-blue-alt').addClass('btn-default');
                    }
                }
                if (string == 0) {
                    showNoti('Sales Order status is close.', 'Sales Order update fail', 'Err');
                    tr.find('.up-so').val(updates);
                }
            }
        });
    }).on('click', '.btn-cus-rfq', function () {
        var btnThis = $(this);
        var rfq_id = $('#id').val();
        var updates = parseInt($(this).data('update'));
        var salesorder_id = $('[name="SalesOrderID"]').val();
        var keys = [];
        var values = [];

        var tr = $(this).parent().parent();
        var trpre = $(this).closest('tr').prev();
        tr.find('.up-so').val(updates + 1);
        var key = trpre.attr('id');
        console.log(trpre);
        trpre.find('input[name^=products], textarea[name^=products], select[name^=products]').each(function () {
            // if (!$(this).attr('readonly')) {
            var field = $(this).attr('name').replace('products[' + key + '][', '').replace(']', '');
            var value = $(this).val();
            keys.push(field);
            values.push(value);
            // }
        });
        $.ajax({
            url: site_url + 'sup_rfq/update_cus_rfq',
            type: 'POST',
            data: {
                rfq_id: rfq_id,
                salesorder_id: salesorder_id,
                keys: keys,
                values: values
            },

            success: function (string) {
                if (string == 1) {
                    btnThis.data('update', updates + 1);
                    btnThis.find('span').text(updates + 1);
                    showNoti('Supplier Part #: ' + trpre.find('.supplier-part').val(), 'Sales Order update successful', 'Ok');
                    if (updates == 0) {
                        btnThis.removeClass('btn-default').addClass('btn-success');
                    } else if (updates == 1) {
                        btnThis.removeClass('btn-success').addClass('btn-danger');
                    } else if (updates == 2) {
                        btnThis.removeClass('btn-danger').addClass('btn-warning');
                    } else if (updates == 3) {
                        btnThis.removeClass('btn-warning').addClass('btn-info');
                    } else if (updates == 4) {
                        btnThis.removeClass('btn-info').addClass('btn-yellow');
                    } else if (updates == 5) {
                        btnThis.removeClass('btn-yellow').addClass('btn-purple');
                    } else if (updates == 6) {
                        btnThis.removeClass('btn-purple').addClass('btn-azure');
                    } else if (updates == 7) {
                        btnThis.removeClass('btn-azure').addClass('btn-black');
                    } else if (updates == 8) {
                        btnThis.removeClass('btn-black').addClass('btn-blue-alt');
                    } else {
                        btnThis.removeClass('btn-blue-alt').addClass('btn-default');
                    }
                }
                if (string == 0) {
                    showNoti('Sales Order status is close.', 'Sales Order update fail', 'Err');
                    tr.find('.up-so').val(updates);
                }
            }
        });
    }).on('click', '.btn-list-old', function () {
        var tr = $(this).closest('tr');
        var part = tr.find('.mfr-part').val();
        var qty_spq = tr.find('.spq');
        var order_quantity = tr.find('.order-qty');
        var buying_price = tr.find('.buying-price');
        var availabilitystock = tr.find('td.col-availabilitystock input');
        var multipleqty = tr.find('.multiple_qty');
        var minimumqty = tr.find('.mini_qty');
        var packagecase = tr.find('.package_case');
        var packaging = tr.find('.packaging');
        var datecode = tr.find('td.col-datecode input');
        var coo = tr.find('td.col-coo input');
        var condition = tr.find('td.col-condition input');
        var buying_amount = tr.find('.buying-amount');
        var selling_price = tr.find('.selling-price');
        var selling_amount = tr.find('.selling-amount');
        var manufacturer = tr.find('.manufacturer');
        var desc = tr.find('.description');

        var margin = tr.find('.margin');
        var costperunit = tr.find('.costperunit');

        var selectSupplier = tr.find('.select-supplier');
        //part
        $.ajax({
            url: site_url + 'rfq/list_old',
            type: 'POST',
            cache: false,
            data: {part: part},
            success: function (string) {
                var mhight = $('#modal-list-old').height();
                $('#modal-list-old .modal-body .table').css('height', mhight - 70)
                /*todo load  data*/
                //$('#modal-list-old .modal-body').empty().append(string);
                $('#modal-list-old .modal-body .table').html(string);
                $('.part').text(part);
                $('#modal-list-old').modal('show');

                $(function () {
                    $('.btn-circle').on('click', function () {
                        $('.btn-circle.btn-info').removeClass('btn-info').addClass('btn-default');
                        $(this).addClass('btn-info').removeClass('btn-default').blur();
                    });
                    $('.next-step, .prev-step').on('click', function (e) {
                        var $activeTab = $('.tab-pane.active');

                        $('.btn-circle.btn-info').removeClass('btn-info').addClass('btn-default');

                        if ($(e.target).hasClass('next-step')) {
                            var nextTab = $activeTab.next('.tab-pane').attr('id');
                            $('[href="#' + nextTab + '"]').addClass('btn-info').removeClass('btn-default');
                            $('[href="#' + nextTab + '"]').tab('show');
                        } else {
                            var prevTab = $activeTab.prev('.tab-pane').attr('id');
                            $('[href="#' + prevTab + '"]').addClass('btn-info').removeClass('btn-default');
                            $('[href="#' + prevTab + '"]').tab('show');
                        }
                    });
                });
                /*  $('#modal-list-old').each(function () {
                      var _this = $(this);
                      var remove = function (t) {
                          _this.find(t).each(function () {
                              var _this = $(this);
                              _this.removeAttr('style');
                          })
                      }
                      remove('th');
                      remove('td');
                  });*/

                $('.get-info-item').click(function () {
                    var tr_item = $(this).closest('tr');
                    qty_spq.val(accounting.formatMoney(parseFloat(tr_item.find('.qty-spq-old').text().replace(/\s/g, '').replace(/,/g, '')), '', 0));
                    order_quantity.val(accounting.formatMoney(parseFloat(tr_item.find('.order-quantity-old').text().replace(/\s/g, '').replace(/,/g, '')), '', 0));
                    buying_price.val(accounting.formatMoney(parseFloat(tr_item.find('.buying-price-old').text().replace(/\s/g, '').replace(/,/g, '')), '', 4)).change();
                    availabilitystock.val(accounting.formatMoney(parseFloat(tr_item.find('.availabilitystock-old').text().replace(/\s/g, '').replace(/,/g, '')), '', 0));
                    // multipleqty.val(accounting.formatMoney(parseFloat(tr_item.find('.multipquantity-old').text().replace(/\s/g, '').replace(/,/g, '')), '', 0));
                    // minimumqty.val(accounting.formatMoney(parseFloat(tr_item.find('.miniquantity-old').text().replace(/\s/g, '').replace(/,/g, '')), '', 0));
                    // packagecase.val(tr_item.find('.PackageCase').text());
                    // packaging.val(tr_item.find('.Packaging').text());
                    $('.LeadtimeComments').val(tr_item.find('.LeadtimeComments').text());
                    manufacturer.val(tr_item.find('.manufacturer').text());
                    desc.val(tr_item.find('.desc').text());
                    datecode.val(tr_item.find('.DateCode').text());
                    coo.val(tr_item.find('.COO').text());
                    condition.val(tr_item.find('.Condition').text());
                    // supplierID.val(parseInt(tr_item.find('.vendor-old').data('id')));
                    // supplierInfo.val(tr_item.find('.vendor-old').data('id') + ' - ' + tr_item.find('.vendor-old').text());
                    selectSupplier.val(tr_item.find('.vendor-old').data('id')).trigger('chosen:updated');
                    showNoti('Supplier Part Number: ' + part, 'Cập nhật hoàn tất', 'Ok');

                    total_tfoot();

                })
                $('.get-info-item1').click(function () {
                    var tr_item = $(this).closest('tr');
                    qty_spq.val(accounting.formatMoney(parseFloat(tr_item.find('.spq_buy').text().replace(/\s/g, '').replace(/,/g, '')), '', 0));
                    order_quantity.val(accounting.formatMoney(parseFloat(tr_item.find('.orderqty_selling').text().replace(/\s/g, '').replace(/,/g, '')), '', 0));
                    selling_price.val(accounting.formatMoney(parseFloat(tr_item.find('.unitprice').text().replace(/\s/g, '').replace(/,/g, '')), '', 4)).change();
                    total_tfoot();
                    showNoti('AT-COM Part Number: ' + part, 'Cập nhật hoàn tất', 'Ok');
                });
                $('.get-info-item2').click(function () {
                    var tr_item = $(this).closest('tr');
                    qty_spq.val(accounting.formatMoney(parseFloat(tr_item.find('.spq_buy1').text().replace(/\s/g, '').replace(/,/g, '')), '', 0));
                    order_quantity.val(accounting.formatMoney(parseFloat(tr_item.find('.orderqty_selling1').text().replace(/\s/g, '').replace(/,/g, '')), '', 0));
                    selling_price.val(accounting.formatMoney(parseFloat(tr_item.find('.unitprice1').text().replace(/\s/g, '').replace(/,/g, '')), '', 4)).change();
                    total_tfoot();
                    showNoti('AT-COM Part Number: ' + part, 'Cập nhật hoàn tất', 'Ok');


                });
                $('.get-info-item3').click(function () {
                    var tr_item = $(this).closest('tr');
                    qty_spq.val(accounting.formatMoney(parseFloat(tr_item.find('.spq_buy2').text().replace(/\s/g, '').replace(/,/g, '')), '', 0));
                    order_quantity.val(accounting.formatMoney(parseFloat(tr_item.find('.orderqty_selling2').text().replace(/\s/g, '').replace(/,/g, '')), '', 0));
                    selling_price.val(accounting.formatMoney(parseFloat(tr_item.find('.unitprice2').text().replace(/\s/g, '').replace(/,/g, '')), '', 4)).change();
                    total_tfoot();
                    showNoti('AT-COM Part Number: ' + part, 'Cập nhật hoàn tất', 'Ok');


                });
            },
            beforeSend: function () {
                showLoading();
            },
            complete: function () {
                hideLoading();
            }
        });


    }).on('change', '.select-supplier', function () {
        // $('#cost_total').text('');
        //$('#attr-percent').text('');
        var parent = $(this).closest('tr');
        parent.find('.col-markup input').removeClass("disabled-rfq");
        parent.find('.col-selling_price input').removeClass("disabled-rfq");
        parent.find('.col-margin input').removeClass("disabled-rfq");
        parent.find('.col-buying_price input').removeClass("disabled-rfq");
        parent.find('.col-tax input').removeClass("disabled-rfq");
        console.log(parent);
        check_attribution_mfr();
    }).on('change', '.order-qty, .buying-price', function () {
        var parent = $(this).closest('tr');
        var orderQuantity = parseFloat(parent.find('.order-qty').val().replace(/\s/g, '').replace(/,/g, ''));
        var buyingPrice = parseFloat(parent.find('.buying-price').val().replace(/\s/g, '').replace(/,/g, ''));
        var costPerUnit = parseFloat(parent.find('.costperunit').val().replace(/\s/g, '').replace(/,/g, ''));
        var costOfGoodsSold = buyingPrice + costPerUnit;
        var margin = accounting.formatMoney(parseFloat(parent.find('.margin').val().replace(/\s/g, '').replace(/,/g, '')), '', 1);
        var sellingPrice = costOfGoodsSold / (1 - (margin / 100));
        var tax = parseFloat(parent.find('.my-tax').val().replace(/\s/g, '').replace(/,/g, ''));
        if(tax > 0){
            var bying_tax = (buyingPrice  *(1 + (tax / 100)));
            parent.find('.amount-tax').val(accounting.formatMoney(bying_tax, '', 2));
            parent.find('.buying-amount').val(accounting.formatMoney(orderQuantity * bying_tax, '', 2));
        }else {
            parent.find('.amount-tax').val(accounting.formatMoney(buyingPrice, '', 2));
            parent.find('.buying-amount').val(accounting.formatMoney(orderQuantity * buyingPrice, '', 2));
        }
        var UnitWeight = parseFloat(parent.find('.UnitWeight').val().replace(/\s/g, '').replace(/,/g, ''));
        var Totalweight = UnitWeight * orderQuantity;

        parent.find('.Grossweight').val(accounting.formatMoney(Totalweight, '', 4));
        parent.find('.order-qty').val(accounting.formatMoney(orderQuantity, '', 0));
        // parent.find('.buying-price').val(accounting.formatMoney(buyingPrice, '', 4));
        // parent.find('.buying-amount').val(accounting.formatMoney(orderQuantity * buyingPrice, '', 2));
        parent.find('.costofgoodssold').val(accounting.formatMoney(costOfGoodsSold, '', 4));
        parent.find('.selling-price').val(accounting.formatMoney(sellingPrice, '', 4));
        parent.find('.selling-amount').val(accounting.formatMoney(sellingPrice * orderQuantity, '', 2));



        total_tfoot();
        // var newtax = orderQuantity * buyingPrice ;
        // var amout_tax = newtax + ( newtax * tax / 100);
        // if (newtax > 0) parent.find('.amount-tax').val(accounting.formatMoney(amout_tax, '', 2));
        // else parent.find('.amount-tax').val('0');
    }).on('change', '.markup', function () {
        var parent = $(this).closest('tr');
        var margin = 0;
        var orderQuantity = parseFloat(parent.find('.order-qty').val().replace(/\s/g, '').replace(/,/g, ''));
        var costOfGoodsSold = parseFloat(parent.find('.costofgoodssold').val().replace(/\s/g, '').replace(/,/g, ''));
        var markup = parseFloat(parent.find('.markup').val().replace(/\s/g, '').replace(/,/g, ''));
        var sellingPrice = 0;
        sellingPrice = costOfGoodsSold * (1 + markup / 100);
        margin = accounting.formatMoney((1 - (sellingPrice == 0 ? 0 : costOfGoodsSold / sellingPrice)) * 100, '', 1);
        parent.find('.markup').val(accounting.formatMoney(markup, '', 1));
        parent.find('.margin').val(margin);
        parent.find('.selling-price').val(accounting.formatMoney(sellingPrice, '', 4));
        parent.find('.selling-amount').val(accounting.formatMoney(sellingPrice * orderQuantity, '', 2));
        total_tfoot();
    }).on('change', '.selling-price', function () {
        var parent = $(this).closest('tr');
        var orderQuantity = parseFloat(parent.find('.order-qty').val().replace(/\s/g, '').replace(/,/g, ''));
        var costOfGoodsSold = parseFloat(parent.find('.costofgoodssold').val().replace(/\s/g, '').replace(/,/g, ''));
        var sellingPrice = parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        var markup = accounting.formatMoney((costOfGoodsSold == 0 ? 0 : sellingPrice - costOfGoodsSold) / costOfGoodsSold * 100, '', 1);
        var margin = accounting.formatMoney((1 - (sellingPrice == 0 ? 0 : costOfGoodsSold / sellingPrice)) * 100, '', 1);
        parent.find('.markup').val(markup);
        parent.find('.margin').val(margin);
        parent.find('.selling-price').val(accounting.formatMoney(sellingPrice, '', 4));
        parent.find('.selling-amount').val(accounting.formatMoney(sellingPrice * orderQuantity, '', 2));
        total_tfoot();
    }).on('change', '.my-tax', function () {
        var parent = $(this).closest('tr');
        var orderQuantity = parseFloat(parent.find('.order-qty').val().replace(/\s/g, '').replace(/,/g, ''));
        var buyingPrice = parseFloat(parent.find('.buying-price').val().replace(/\s/g, '').replace(/,/g, ''));
        var tax = parseFloat(parent.find('.my-tax').val().replace(/\s/g, '').replace(/,/g, ''));

        var str = 'Tax';
        if (tax > 100) {
            parent.find('.my-tax').val(0);
            showNoti(str + ' must less than 100%', 'Warning', 'War');
            return false;
        } else {
            var bying_tax = (buyingPrice  *(1 + (tax / 100)));
            var amout_tax = bying_amount + ( bying_amount * tax / 100);
            parent.find('.amount-tax').val(accounting.formatMoney(bying_tax, '', 2));
            var bying_amount =  orderQuantity * bying_tax;
            var costPerUnit = parseFloat(parent.find('.costperunit').val().replace(/\s/g, '').replace(/,/g, ''));
            var costOfGoodsSold = bying_tax + costPerUnit;
            var margin = accounting.formatMoney(parseFloat(parent.find('.margin').val().replace(/\s/g, '').replace(/,/g, '')), '', 1);
            var sellingPrice = costOfGoodsSold / (1 - (margin / 100));
            // parent.find('.order-qty').val(accounting.formatMoney(orderQuantity, '', 0));
            // parent.find('.buying-price').val(accounting.formatMoney(buyingPrice, '', 4));
            parent.find('.buying-amount').val(accounting.formatMoney(bying_amount, '', 2));
            parent.find('.costofgoodssold').val(accounting.formatMoney(costOfGoodsSold, '', 4));
            parent.find('.selling-price').val(accounting.formatMoney(sellingPrice, '', 4));
            parent.find('.selling-amount').val(accounting.formatMoney(sellingPrice * orderQuantity, '', 2));



            total_tfoot();
        }
    }).on('change', '.margin', function () {
        var parent = $(this).closest('tr');
        var markup = 0;
        var orderQuantity = parseFloat(parent.find('.order-qty').val().replace(/\s/g, '').replace(/,/g, ''));
        var costOfGoodsSold = parseFloat(parent.find('.costofgoodssold').val().replace(/\s/g, '').replace(/,/g, ''));
        var margin = parseFloat(parent.find('.margin').val().replace(/\s/g, '').replace(/,/g, ''));
        var sellingPrice = 0;
        if (margin < 100) {
            sellingPrice = costOfGoodsSold / (1 - margin / 100);
            markup = (costOfGoodsSold == 0 ? 0 : sellingPrice - costOfGoodsSold) / costOfGoodsSold * 100;

            parent.find('.markup').val(accounting.formatMoney(markup, '', 1));
            parent.find('.margin').val(accounting.formatMoney(margin, '', 1));
            parent.find('.selling-price').val(accounting.formatMoney(sellingPrice, '', 4));
            parent.find('.selling-amount').val(accounting.formatMoney(sellingPrice * orderQuantity, '', 2));
            total_tfoot();
        } else {
            parent.find('.margin').val(0);
            showNoti('Margin must less than 100%', 'Warning', 'War');
            return false;
        }
    }).on('change', '.UnitWeight', function () {
        var parent = $(this).closest('tr');

        // var parentprev = $(this).closest('tr').prev();
        var orderQuantity = parseFloat(parent.find('.order-qty').val().replace(/\s/g, '').replace(/,/g, ''));
        var UnitWeight = parseFloat(parent.find('.UnitWeight').val().replace(/\s/g, '').replace(/,/g, ''));
        var Totalweight = UnitWeight * orderQuantity;

        parent.find('.Grossweight').val(accounting.formatMoney(Totalweight, '', 4));
        total_tfoot();
    }).on('click', '.btn-execute-colcost', function () {
        var tr = $(this).closest('tr');
        var btnThis = $(this);
        var color = parseFloat($('#attribution tr[data-id="' + tr.data('id') + '"]').find('.attr-color').val());
       //console.log(btnThis);
       // console.log(color);
        updated_coler = $('#attribution tr[data-id="' + tr.data('id') + '"]').find('.attr-color').val(color + 1);
        btnThis.val(color + 1);
        btnThis.find('span').text(color + 1);
        if (color == 0) {
            btnThis.removeClass('btn-default').addClass('btn-success');
        } else if (color == 1) {
            btnThis.removeClass('btn-success').addClass('btn-danger');
        } else if (color == 2) {
            btnThis.removeClass('btn-danger').addClass('btn-warning');
        } else if (color == 3) {
            btnThis.removeClass('btn-warning').addClass('btn-info');
        } else if (color == 4) {
            btnThis.removeClass('btn-info').addClass('btn-yellow');
        } else if (color == 5) {
            btnThis.removeClass('btn-yellow').addClass('btn-purple');
        } else if (color == 6) {
            btnThis.removeClass('btn-purple').addClass('btn-azure');
        } else if (color == 7) {
            btnThis.removeClass('btn-azure').addClass('btn-black');
        } else if (color == 8) {
            btnThis.removeClass('btn-black').addClass('btn-blue-alt');
        } else {
            btnThis.removeClass('btn-blue-alt').addClass('btn-default');
        }
        execute_cost(tr.data('id'));
    }).on('click', '.btn-execute-cost', function () {
        var flagSUP = false;
        $('#itemList .table-part tr td.colpart-supplier .select-supplier').each(function () {
            var idSUP = $(this).val();

            if (idSUP == '') {
                flagSUP = true
            }
        })
        if (flagSUP) {
            $.alerts.confirm('You have not yet selected the supplier field. Do you want execute cost?', 'Confirm', function (e) {
                if (e) {
                    $('#attribution tbody tr').each(function () {
                        execute_cost($(this).data('id'));
                    })
                }
            })
        } else {
            $('#attribution tbody tr').each(function () {
                var tr = $(this);
                var btnThis = $(this).find('.btn-execute-colcost');
                var color = parseFloat($('#attribution tr[data-id="' + tr.data('id') + '"]').find('.attr-color').val());
                console.log(btnThis);
                console.log(color);

                updated_coler = $('#attribution tr[data-id="' + tr.data('id') + '"]').find('.attr-color').val(color + 1);
                btnThis.val(color + 1);
                btnThis.find('span').text(color + 1);
                if (color == 0) {
                    btnThis.removeClass('btn-default').addClass('btn-success');
                } else if (color == 1) {
                    btnThis.removeClass('btn-success').addClass('btn-danger');
                } else if (color == 2) {
                    btnThis.removeClass('btn-danger').addClass('btn-warning');
                } else if (color == 3) {
                    btnThis.removeClass('btn-warning').addClass('btn-info');
                } else if (color == 4) {
                    btnThis.removeClass('btn-info').addClass('btn-yellow');
                } else if (color == 5) {
                    btnThis.removeClass('btn-yellow').addClass('btn-purple');
                } else if (color == 6) {
                    btnThis.removeClass('btn-purple').addClass('btn-azure');
                } else if (color == 7) {
                    btnThis.removeClass('btn-azure').addClass('btn-black');
                } else if (color == 8) {
                    btnThis.removeClass('btn-black').addClass('btn-blue-alt');
                } else {
                    btnThis.removeClass('btn-blue-alt').addClass('btn-default');
                }
                execute_cost($(this).data('id'));
            })
        }
    }).on('click', '.mainTable .minimumqty-copy', function () {
        $('tr.highlightNoClick').each(function () {
            $(this).find('td.col-mini_qty input').val($(this).find('.col-order_qty input').val());
        })
    }).on('click', '.mainTable .multipleqty-copy', function () {
        $('tr.highlightNoClick').each(function () {
            $(this).find('td.col-multiple_qty input').val(1);
        })
    }).on('change', '.attr-total', function () {
        $('#attribution tbody tr').each(function () {
            // execute_cost($(this).data('id'));
            updateDataSum();
        })
    }).on('change', '.attr-Bank', function () {
        $('#attribution tbody tr').each(function () {
            // execute_cost($(this).data('id'));
            // updateDataSum();
        })

    }).on('change', '.attr-Delivery', function () {
        $('#attribution tbody tr').each(function () {
            // execute_cost($(this).data('id'));
            // updateDataSum();
        })

    }).on('change', '.attr-Declare', function () {
        $('#attribution tbody tr').each(function () {
            // execute_cost($(this).data('id'));
            // updateDataSum();
        })

    }).on('change', '.attr-Other', function () {
        $('#attribution tbody tr').each(function () {
            // execute_cost($(this).data('id'));
            // updateDataSum();
        })

    });

    /* # Ready */

    function execute_cost(costID) {
        var buyingAmountTotal = 0;
        var orderQuantity12 = 0;
        var costofgoodssold12 = 0;
        var TotalCOP12 = 0;
        var Bank = parseFloat($('#attribution tr[data-id="' + costID + '"]').find('.attr-Bank').val());
        var color = parseFloat($('#attribution tr[data-id="' + costID + '"]').find('.attr-color').val());
        var Delivery = parseFloat($('#attribution tr[data-id="' + costID + '"]').find('.attr-Delivery').val());
        var Declare = parseFloat($('#attribution tr[data-id="' + costID + '"]').find('.attr-Declare').val());
        //var Cop = parseFloat($('#attribution tr[data-id="' + costID + '"]').find('.attr-attrCop').val().replace(/\s/g, '').replace(/,/g, ''));
        var Other = parseFloat($('#attribution tr[data-id="' + costID + '"]').find('.attr-Other').val());
        $('#attribution tr[data-id="' + costID + '"]').find('.attr-total').val(Bank + Delivery + Declare + Other);
        $('.select-supplier option[value="' + costID + '"]:selected').each(function () {
            buyingAmountTotal += parseFloat($(this).closest('tr').find('.buying-amount').val().replace(/\s/g, '').replace(/,/g, ''));
        })

        // console.log(buyingAmountTotal);
        var totalCost = 0;
        var totalCostOfGoodsSold = 0;
        var supplierPercent = 0;
        var orderQuantity1 = 0;
        var copPercent = 0;
        var TotalCOP = 0;
        var Buying_Price_Tax_total = 0;
        var costOfGoodsSold1 = 0

        $('#attribution tr[data-id="' + costID + '"]').find('.attr-total').val(accounting.formatMoney(Bank + Delivery + Declare + Other, '', 2));
        var cost = parseFloat($('#attribution tr[data-id="' + costID + '"]').find('.attr-total').val().replace(/\s/g, '').replace(/,/g, ''));
        $('.select-supplier option[value="' + costID + '"]:selected').each(function () {
            var costPerUnit = 0;
            var costOfGoodsSold = 0;
            var sellingPrice = 0;
            var markup = 0;
            // var orderQuantity12 = 0;
            // var costofgoodssold12 = 0;
            var parent = $(this).closest('tr');
            var orderQuantity = parseFloat(parent.find('.order-qty').val().replace(/\s/g, '').replace(/,/g, ''));
            var buyingPrice = parseFloat(parent.find('.buying-price').val().replace(/\s/g, '').replace(/,/g, ''));
            var buyingAmount = parseFloat(parent.find('.buying-amount').val().replace(/\s/g, '').replace(/,/g, ''));
            var margin = parseFloat(parent.find('.margin').val().replace(/\s/g, '').replace(/,/g, ''));
            var topCPU = (buyingAmount / buyingAmountTotal) * cost;
            console.log(parent.find('.supplier-part').val());
            // console.log(buyingAmount);
            // console.log(buyingAmountTotal);
            // console.log(cost);
            // console.log(costPerUnit);

            // console.log(costPerUnit);
            costPerUnit = orderQuantity == 0 ? 0 : ((buyingAmount / buyingAmountTotal) * cost) / orderQuantity;
            var test = ((cost / buyingAmountTotal) * buyingAmount) / orderQuantity;
            costOfGoodsSold = buyingPrice + costPerUnit;
            sellingPrice = costOfGoodsSold / (1 - margin / 100);
            markup = costOfGoodsSold == 0 ? 0 : (sellingPrice - costOfGoodsSold) / costOfGoodsSold * 100;
            orderQuantity1 = orderQuantity;
            totalCost += costPerUnit;
            totalCostOfGoodsSold += costOfGoodsSold;
            costOfGoodsSold1 = costOfGoodsSold;
            //CopTotal =
            parent.find('.costperunit').val(accounting.formatMoney(costPerUnit, '', 4));
            parent.find('.costofgoodssold').val(accounting.formatMoney(costOfGoodsSold, '', 4));
            parent.find('.markup').val(accounting.formatMoney(markup, '', 1));
            parent.find('.selling-price').val(accounting.formatMoney(sellingPrice, '', 4));
            parent.find('.selling-amount').val(accounting.formatMoney(sellingPrice * orderQuantity, '', 2));

        });

        var TotalCOP123 = 0;
        var TotalCOP1234 = 0;
        $('.select-supplier option[value="' + costID + '"]:selected').each(function () {
            orderQuantity12 = parseFloat($(this).closest('tr').find('.order-qty').val().replace(/\s/g, '').replace(/,/g, ''));
            costofgoodssold12 = parseFloat($(this).closest('tr').find('.costofgoodssold').val().replace(/\s/g, '').replace(/,/g, ''));
            TotalCOP1234 += costofgoodssold12 * orderQuantity12;
        })
        console.log(TotalCOP1234);
        TotalCOP123 += TotalCOP1234;
        // TotalCOP12 = costofgoodssold12 * orderQuantity12;
        console.log(TotalCOP123);

        if(!!costofgoodssold12) {
            // _costofgoodssold = parseFloat(_costofgoodssold.replace(/\s/g, '').replace(/,/g, ''));
            TotalCOP12 += TotalCOP1234;
        }
        else{
            showNoti('Zero price effect COP or Qty', 'Err', 'Err');
            TotalCOP12 = 0;
        }
        if(!!TotalCOP12) $('#attribution tr[data-id="' + costID + '"]').find('.attr-Cop').val(accounting.formatMoney(TotalCOP12, '', 2));

        copPercent = costOfGoodsSold1 * orderQuantity1;
        //supplierPercent = (cost / copPercent) * 100;


        if(!!cost && !!TotalCOP12){
            supplierPercent = (cost / TotalCOP12) * 100;
            $('#attribution tr[data-id="' + costID + '"]').find('.attr-percent').val(accounting.formatMoney(supplierPercent, '', 1));
        }
        //$('#attribution tr[data-id="' + costID + '"]').find('.attr-Cop').val(accounting.formatMoney(copPercent, '', 2));
        // if(!!TotalCOP) $('#attribution tr[data-id="' + costID + '"]').find('.attr-Cop').val(accounting.formatMoney(TotalCOP, '', 2));

        total_tfoot();
    }

    function total_tfoot() {
       
        var Buying_Price_Tax_total = 0;
        var orderQuantity_total = 0, buyingPrice_total = 0, buyingAmount_total = 0, costOfGoodsSold_total = 0,
            markup_total = 0, sellingPrice_total = 0, sellingAmount_total = 0, margin_total = 0, costperunit_total = 0,
            total_tax = 0;
        $('.table-part tr.highlightNoClick').each(function () {
            costperunit_total += parseFloat($(this).find('.costperunit').val().replace(/\s/g, '').replace(/,/g, ''));
            orderQuantity_total += parseFloat($(this).find('.order-qty').val().replace(/\s/g, '').replace(/,/g, ''));
            buyingPrice_total += parseFloat($(this).find('.buying-price').val().replace(/\s/g, '').replace(/,/g, ''));
            buyingAmount_total += parseFloat($(this).find('.buying-amount').val().replace(/\s/g, '').replace(/,/g, ''));
            costOfGoodsSold_total += parseFloat($(this).find('.costofgoodssold').val().replace(/\s/g, '').replace(/,/g, ''));
            sellingPrice_total += parseFloat($(this).find('.selling-price').val().replace(/\s/g, '').replace(/,/g, ''));
            sellingAmount_total += parseFloat($(this).find('.selling-amount').val().replace(/\s/g, '').replace(/,/g, ''));
            total_tax += parseFloat($(this).find('.my-tax').val().replace(/\s/g, '').replace(/,/g, ''));
            //Cop_total += parseFloat($(this).find('.attr-Cop').val().replace(/\s/g, '').replace(/,/g, ''));
            // parseFloat($(this).find('.costperunit').val().replace(/\s/g, '').replace(/,/g, ''));
            Buying_Price_Tax_total += parseFloat($(this).find('.amount-tax').val().replace(/\s/g, '').replace(/,/g, ''));


            markup_total = accounting.formatMoney(costOfGoodsSold_total == 0 ? 0 : ((sellingPrice_total - costOfGoodsSold_total) / costOfGoodsSold_total * 100), '', 1);
            margin_total = accounting.formatMoney((1 - (sellingPrice_total == 0 ? 0 : costOfGoodsSold_total / sellingPrice_total)) * 100, '', 1);
        })

        //alert(costperunit_total);
        $('.tfoot-qty').text(accounting.formatMoney(orderQuantity_total, '', 0));
        $('.tfoot-qtyp').text(accounting.formatMoney(buyingPrice_total, '', 2));
        $('.tfoot-qtyp-amount').text(accounting.formatMoney(buyingAmount_total, '', 2));
        $('.tfoot-qtyp-buyingpricetax').text(accounting.formatMoney(Buying_Price_Tax_total, '', 2));
        $('.tfoot-costofgoodssold').text(accounting.formatMoney(costOfGoodsSold_total, '', 2));
        $('.tfoot-profit').text(accounting.formatMoney(markup_total, '', 1));
        $('.tfoot-sp-sellingprice').text(accounting.formatMoney(sellingPrice_total, '', 2));
        $('.tfoot-sp-amount').text(accounting.formatMoney(sellingAmount_total, '', 2));
        $('.tfoot-margin').text(accounting.formatMoney(margin_total, '', 1));
        $('.tfoot-costperunit').text(accounting.formatMoney(costperunit_total, '', 2));
        $('.tfoot-total-tax').text(accounting.formatMoney(total_tax, '', 2) + '%');
        //$('#attr-percent').text(accounting.formatMoney( costperunit_total/(costOfGoodsSold_total+orderQuantity_total), '', 3) );
        $('#attr-percent').text(accounting.formatMoney(costperunit_total / (costOfGoodsSold_total + orderQuantity_total), '', 3));
        updateDataSum();
    }

    
})


function updateDataItemrfq() {
    var Orqty = 0, priceUSD = 0,
    amount = 0;
   
     $('.listold').each(function () {
        Orqty = parseFloat($(this).find('.order-qty').val().replace(/\s/g, '').replace(/,/g, ''));
        priceUSD = parseFloat($(this).find('.unit-price-usd').val().replace(/\s/g, '').replace(/,/g, ''));
        amount = $(this).find('.buying-amount').val(accounting.formatMoney(Orqty * priceUSD, '', 2));
        
        // percent_total += parseFloat($(this).find('.attr-percent').val().replace(/\s/g, '').replace(/,/g, ''));
    })

  //  total_tfoot();
    //total_tfoot();
 }
 