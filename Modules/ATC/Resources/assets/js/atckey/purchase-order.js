$(document).ready(function($) {
    anrDataRequired();

    $(".sendmail").click(function () {
        $.ajax({
          type: "POST",
          url: "purchase_order/opensendmail",

          data: {
            id: $('[name="id"]').val(),
            cpo: $('#CustomerPONo option:selected').chosen().text(),
          },
          success: function (output) {
            $("#ModalsendMail").html(output).modal("show");
          },
          error: function () {
            alert("Error");
          },
        });
      });
    $('body').on('click', '.btn-part-list-po', function() {
        if ($('.part-list-with-po').length) $('.part-list-with-po').remove();
        var val = $('#CustomerPONo').val();
        var code = $("#CustomerPONo option:selected").text();
        if (val == null) {
            showNoti('PO No cannot be empty', 'Warning', 'War');
        } else {
            $.ajax({
                url: site_url + 'ajax/pl_cpo',
                cache: false,
                type: 'POST',
                data: { arrID: val },
                success: function(string) {
                    if (string != '') {
                        var getData = $.parseJSON(string);
                        //console.log(getData);
                        var part_list = '<table class="table tableplCPO" style="width: 100%;text-align: left"><thead><tr><th>Cust Request Date</th><th>Supplier Part</th><th>Mfr Part</th><th class="desc">Description</th><th>Manufacturer</th><th>Package / Case</th><th>Packaging</th><th>SPQ</th><th>Order Qty</th><th>Leadtime / Comments</th></tr></thead>';
                        for(var i = 0; i < getData.length; i++) {
                            if(getData[i].CustRequestDate != null){
                                var CustRequestDate = getData[i].CustRequestDate;
                            }else{
                                var CustRequestDate = '00-00-0000';
                            }
                            part_list += '<tr data-cpoid="' + getData[i].cpoid + '" data-poid="' + getData[i].poid + '" data-importmethod="' + getData[i].ImportMethod + '" data-spq="' + getData[i].StandardPackageQty + '" data-qty="' + getData[i].Qty + '" data-price="' + getData[i].Price + '" data-deliverydate="' + getData[i].DeliveryDate + '" data-stock="' + getData[i].Stock + '" data-packagecase="' + getData[i].PackageCase + '" data-packaging="' + getData[i].Packaging + '" data-datecode="' + getData[i].DateCode + '" data-coo="' + getData[i].COO + '" data-condition="' + getData[i].PROCondition + '">';
                            // part_list += '<td class="img"><img src="' + image + '" style="max-width: 27px;" data-url="' + getData[i].Image + '"></td>';
                            part_list += '<td>' + CustRequestDate  + '</td>';
                            // part_list += '<td>' + getData[i].po + '</td>';
                            part_list += '<td class="supplier">' + getData[i].SupplierPart.replace('&', '&amp;') + '</td>';
                            part_list += '<td class="mfrpart">' + getData[i].MfrPart.replace('&', '&amp;') + '</td>';
                            part_list += '<td class="desc">' + getData[i].Description.replace('&', '&amp;') + '</td>';
                            part_list += '<td class="mfr">' + getData[i].Manufacturer + '</td>';
                            part_list += '<td class="packageCase">' + getData[i].PackageCase + '</td>';
                            part_list += '<td class="Packaging">' + getData[i].Packaging + '</td>';
                            part_list += '<td class="Qty">' + getData[i].StandardPackageQty + '</td>';
                            part_list += '<td class="OrderQuantity">' + getData[i].OrderQuantity + '</td>';
                            part_list += '<td class="LeadtimeComments">' + getData[i].LeadtimeComments + '</td>';
                            part_list += '</tr>';
                        }
                        part_list += '</table>';
                        $('body').append('<div class="part-list-with-po" style="top:15%"><div class="panel panel-info"><div class="panel-heading"><h3 class="panel-title">\n' +
                            '                        Query CPO</h3>\n' +
                            '                <button type="button" class="close closequeryCPO" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>\n' +
                            '              <i class="glyphicon glyphicon-plus"></i>\n' +
                            '            </button></div><div class="panel-body">' + part_list + '</div></div></div>');
                    } else {
                        showNoti('Check again PO', 'Warning', 'War');
                        return false;
                    }
                }

            })
        }
    }).on('click', '.part-list-with-po tbody tr',function() {
        var rowPart = $(this);
        var part = $(this).find('td.supplier').text();
        var key = parseInt($('#itemList table tbody .highlightNoClick:last td input.itemKey').val()) + 1;
        if ($('#itemList table tbody .highlightNoClick').length == 0) {
            key = 1;
        }
        if ($('input.supplier-part[value="' + part + '"]').length) {
            $('input.supplier-part[value="' + part + '"]').closest('tr.highlightNoClick').addClass('exists').delay(7000).queue(function(next) {
                rowPart.removeClass("exists");
                next();
            });
            showNoti('Supplier Part #: ' + part.replace('&', '&amp;') + ' already exists', 'Warning', 'War');
        } else {
            data = {
                key: key,
                CPO: rowPart.data('cpoid'),
                PO: rowPart.data('poid'),
                ImportMethod: rowPart.data('importmethod'),
                SupplierPart: part,
                MfrPart: rowPart.find('td.mfrpart').text(),
                Description: rowPart.find('td.desc').text(),
                Manufacturer: rowPart.find('td.mfr').text(),
                Image: rowPart.find('img').data('url'),
                StandardPackageQty: rowPart.data('spq'),
                OrderQuantity: rowPart.data('qty'),
                UnitPriceUSD: rowPart.data('price'),
                LeadtimeComments: rowPart.data('deliverydate'),
                Stock: rowPart.data('stock'),
                PackageCase: rowPart.data('packagecase'),
                Packaging: rowPart.data('packaging'),
                DateCode: rowPart.data('datecode'),
                OriginOfCountry: rowPart.data('coo'),
                PROCondition: rowPart.data('condition'),
            }
            add_row(data);
            updateNO();
            updateDataSum();
        }
    })
/*    $('#updateFrm').submit(function() {
        if (!$('#CustomerPONo').hasClass('disabled') && $('#CustomerPONo').val() == '') {
            showNoti('Customer PO No not empty!', 'Error', 'Err');
            if ($('#info-order').hasClass('in')) {
                $('#CustomerPONo').select2('open');
            }
            return false;
        }
    });*/
    $('#VAT').bind('change', updateDataSum);
    $('#DiscountVND').bind('change', function() {
        var val = parseInt($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        var DiscountUSD = val / parseInt($('#USDExchangeRate').val().replace(/\s/g, '').replace(/,/g, ''));
        $('#DiscountUSD').val(accounting.formatMoney(DiscountUSD, '', 4));
        $(this).val(accounting.formatMoney(val, '', 0));
        updateDataSum();
    });
    $('#DiscountUSD').bind('change', function() {
        var val = parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        var DiscountVND = val * parseInt($('#USDExchangeRate').val().replace(/\s/g, '').replace(/,/g, ''));
        $('#DiscountVND').val(accounting.formatMoney(DiscountVND, '', 0));
        $(this).val(accounting.formatMoney(val, '', 4));
        updateDataSum();
    });

    $('#OtherCostVND').bind('change', function() {
        var val = parseInt($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        var OtherCostUSD = val / parseInt($('#USDExchangeRate').val().replace(/\s/g, '').replace(/,/g, ''));
        $('#OtherCostUSD').val(accounting.formatMoney(OtherCostUSD, '', 4));
        $(this).val(accounting.formatMoney(val, '', 0));
        updateDataSum();
    });

    $('#OtherCostUSD').bind('change', function() {
        var val = parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        var OtherCostVND = val * parseInt($('#USDExchangeRate').val().replace(/\s/g, '').replace(/,/g, ''));
        $('#OtherCostVND').val(accounting.formatMoney(OtherCostVND, '', 0));
        $(this).val(accounting.formatMoney(val, '', 4));
        updateDataSum();
    });

    $('#FreightChargeVND').bind('change', function() {
        var val = parseInt($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        var FreightChargeUSD = val / parseInt($('#USDExchangeRate').val().replace(/\s/g, '').replace(/,/g, ''));
        $('#FreightChargeUSD').val(accounting.formatMoney(FreightChargeUSD, '', 4));
        $(this).val(accounting.formatMoney(val, '', 0));
        updateDataSum();
    });

    $('#FreightChargeUSD').bind('change', function() {
        var val = parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        var FreightChargeVND = val * parseInt($('#USDExchangeRate').val().replace(/\s/g, '').replace(/,/g, ''));
        $('#FreightChargeVND').val(accounting.formatMoney(FreightChargeVND, '', 0));
        $(this).val(accounting.formatMoney(val, '', 4));
        updateDataSum();
    });

    updateDataSum();
    
    $('body').on('click', '.btn-list-old', function() {
        var tr = $(this).closest('tr');
        var mfrPart = tr.find('.mfr-part').val();
        var orderqty = tr.find('.order-qty');
        var unitprice = tr.find('.unit-price-usd');
        $.ajax({
            url: site_url + $('#act').val() + '/list_old',
            type: 'POST',
            cache: false,
            data: { mfrPart: mfrPart },
            success: function(string) {
                $('#modal-list-old .modal-body tbody').empty().append(string);
                $('#modal-list-old').modal('show');
                $('.get-info-item').click(function() {
                    var tr_item = $(this).closest('tr');
                    orderqty.val(accounting.formatMoney(parseFloat(tr_item.find('.orderqty').text().replace(/\s/g, '').replace(/,/g, '')), '', 0));
                    unitprice.val(accounting.formatMoney(parseFloat(tr_item.find('.unitprice').text().replace(/\s/g, '').replace(/,/g, '')), '', 4));
                    showNoti('Mfr Part Number: ' + mfrPart, 'Cập nhật hoàn tất', 'Ok');
                    updateDataItem(tr);
                    updateDataSum();
                });
            }
        });
    }).on('change', '#NumberOfShipment', function() {
        var val = $(this).val();
        $('[data-shipped]').attr('data-shipped', val);
        anrDataRequired();
    }).on('click', '.minus-shipment-total', function() {
        $(".highlightNoClick1").hide();
        $('.col-collapse-total').html('<i class="fa fa-plus-circle plus-shipment-total"></i>');
        $('.col-collapse').html('<i class="fa fa-plus-circle plus-shipment" ></i>');
    }).on('click', '.plus-shipment-total', function() {
        $(".highlightNoClick1").show();
        $('.col-collapse-total').html('<i class="fa fa-minus-circle minus-shipment-total" ></i>');
        $('.col-collapse').html('<i class="fa fa-minus-circle minus-shipment"></i>');
    })

});
/* # Ready */

function updateDataSum() {
    var exchange_rate = parseInt($('#USDExchangeRate').val().replace(/\s/g, '').replace(/,/g, ''));
    var sumTotal = 0.0;
    var sumTotalVND = 0.0;
    var sumSellingAmount = 0.0;
    var total = 0.0;
    var VAT = 0.0;
    var sumVAT = 0.0;
    var totalRMB = 0.0;
    var totalEUR = 0.0;
    var sumTotalRMB = 0.0;
    var sumTotalEUR = 0.0;
    var sumVATRMB = 0.0;
    var sumVATEUR = 0.0;
    var OtherCostEUR = 0.0;
    var FreightChargeEUR = 0.0;
    var OtherCostRMB = 0.0;
    var FreightChargeRMB = 0.0;
    var DiscountUSD = 0.0;
    var OtherCostUSD = 0.0;
    var FreightChargeUSD = 0.0;
    if ($('.amount-usd').length > 0) {
        $('.amount-usd').each(function() {
            sumTotal += parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
            var sellingAmount = $(this).closest('tr').find('.selling-amount').val();
            if(sellingAmount) sumSellingAmount += parseFloat(sellingAmount.replace(/\s/g, '').replace(/,/g, ''));
        });
        $('.amount-vnd').each(function() {
            sumTotalVND += parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        });
        $('.amount-rmb').each(function() {
            sumTotalRMB += parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        });
        $('.amount-eur').each(function() {
            sumTotalEUR += parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
            console.log(sumTotalEUR);
        });
        if ($('#DiscountVND').length) {
            DiscountUSD = parseFloat($('#DiscountUSD').val().replace(/\s/g, '').replace(/,/g, ''));
            $('#DiscountVND').val(accounting.formatMoney(DiscountUSD * exchange_rate, '', 0));
            $('#DiscountUSD').val(accounting.formatMoney(DiscountUSD, '', 2));
        }
        if ($('#FreightChargeUSD').length) {
            FreightChargeUSD = parseFloat($('#FreightChargeUSD').val().replace(/\s/g, '').replace(/,/g, ''));
            $('#FreightChargeVND').val(accounting.formatMoney(FreightChargeUSD * exchange_rate, '', 0));
            $('#FreightChargeUSD').val(accounting.formatMoney(FreightChargeUSD, '', 2));
        }

        OtherCostUSD = parseFloat($('#OtherCostUSD').val().replace(/\s/g, '').replace(/,/g, ''));
        OtherCostEUR = parseFloat($('#OtherCostEUR').val().replace(/\s/g, '').replace(/,/g, ''));
        OtherCostRMB = parseFloat($('#OtherCostRMB').val().replace(/\s/g, '').replace(/,/g, ''));
        FreightChargeEUR = parseFloat($('#FreightChargeEUR').val().replace(/\s/g, '').replace(/,/g, ''));
        FreightChargeRMB = parseFloat($('#FreightChargeRMB').val().replace(/\s/g, '').replace(/,/g, ''));
        $('#OtherCostVND').val(accounting.formatMoney(OtherCostUSD * exchange_rate, '', 0));
        $('#OtherCostUSD').val(accounting.formatMoney(OtherCostUSD, '', 2));
        $('#SubTotalRMB').val(accounting.formatMoney(sumTotalRMB, '', 2));
        $('#SubTotalEUR').val(accounting.formatMoney(sumTotalEUR, '', 2));
        $('#SubTotalVND').val(accounting.formatMoney(sumTotalVND, '', 0));
        $('#SubTotalUSD').val(accounting.formatMoney(sumTotal, '', 2));
        $('#TotalSellingAmount').val(sumSellingAmount);
        VAT = parseFloat($('#VAT').val().replace(/\s/g, '').replace(/,/g, ''));
        sumVAT = sumTotal * VAT / 100;
        sumVATEUR = sumTotalEUR  * VAT / 100;
        sumVATRMB = sumTotalRMB  * VAT / 100;
        sumVATVND = sumTotal * exchange_rate * VAT / 100;
        $('.vat-vnd').val(accounting.formatMoney(sumVAT * exchange_rate, '', 0));
        $('#VATTaxUSD').val(accounting.formatMoney(sumVAT, '', 2));
        total = sumTotal + sumVAT + OtherCostUSD - DiscountUSD + FreightChargeUSD;
        totalEUR = sumTotalEUR + sumVATEUR  + OtherCostEUR  + FreightChargeEUR;
        totalRMB = sumTotalRMB + sumVATRMB  + OtherCostRMB + FreightChargeRMB;
        totalvnd = sumTotalVND + sumVATVND + (OtherCostUSD * exchange_rate) + (DiscountUSD * exchange_rate) + (FreightChargeUSD * exchange_rate);
        $('#TotalVND').val(accounting.formatMoney(totalvnd, '', 0));
        $('#TotalUSD').val(accounting.formatMoney(total, '', 2));
        $('#TotalEUR').val(accounting.formatMoney(totalEUR, '', 2));
        $('#TotalRMB').val(accounting.formatMoney(totalRMB, '', 2));
    } else {
        $('#SubTotalUSD').val(accounting.formatMoney(0, '', 2));
        $('#TotalSellingAmount').val(0);
        $('#SubTotalVND').val(0);
        $('.vat-vnd').val(0);
        $('#VATTaxUSD').val(accounting.formatMoney(0, '', 2));
        $('#DiscountUSD').val(accounting.formatMoney(0, '', 2));
        $('#DiscountVND').val(0);
        $('#OtherCostUSD').val(accounting.formatMoney(0, '', 2));
        $('#OtherCostVND').val(0);
        $('#FreightChargeUSD').val(accounting.formatMoney(0, '', 2));
        $('#FreightChargeVND').val(0);
        $('#TotalUSD').val(accounting.formatMoney(0, '', 2));
        $('#TotalVND').val(0);
    }
    $('#FirstPayment').trigger('change');
}
$('#importModal').on('show.bs.modal', function() {
    if ($('#CustomerPONo').val() == '') {
        $('#importModal').modal('hide');
        if ($('#info-order').hasClass('in')) {
            $('#CustomerPONo').select2('open');
        }
        showNoti('Customer PO No not empty', 'Error', 'War');
        return false;
    }
})
$(document).ready(function () {
    
    function updateCPOdate() {
        var CPOdate = $('#CPODate').val();
        $('.CPODateShipment').val(CPOdate);
    }
    updateCPOdate();
    get_info_delivery();
    function get_info_delivery() {
        var CustomerPONo = $('#CustomerPONo').val();
        var dataString = {
            CustomerPONo : CustomerPONo
        };
        $.ajax({
            type: "POST",
            url: site_url + $('#act').val() + '/get_info_delivery',
            data: dataString,
            // dataType: "json",
            cache : false,
            success: function(data){
                $("#deliveryTime").html(data);
            } ,error: function(xhr, status, error) {
                alert(error);
            },
        });
    }
    $( "#Currency" ).change(function() {
        var val = $( this ).val();
        if (val == 'USD') {
            $('#PORates').val(accounting.formatMoney(1, '', 2));
        }else if(val == 'VND'){
            $('#Rates_lable').html('VND');
            $( ".col-unit_price_vnd" ).show();
            $( ".col-unit_price_vnd" ).show();
            $( ".col-end_user_price_vnd" ).show();
            $( ".col-selling_amount_vnd" ).show();
        }
        else if(val == 'RMB'){
            $('#Rates_lable').html('RMB');
            $( ".col-unit_price_rmb" ).show();
            $( ".col-amount_rmb" ).show();
            $( ".col-end_user_price_rmb" ).show();
            $( ".col-selling_amount_rmb" ).show();
            $( ".currency_vnd" ).hide();
            $( ".col-unit_price_eur" ).hide();
            $( ".col-amount_eur" ).hide();
            $( ".col-end_user_price_eur" ).hide();
            $( ".col-selling_amount_eur" ).hide();
        }else if(val == 'EUR'){
            $('#Rates_lable').html('EUR');
            $( ".col-unit_price_eur" ).show();
            $( ".col-amount_eur" ).show();
            $( ".col-end_user_price_eur" ).show();
            $( ".col-selling_amount_eur" ).show();
            $( ".currency_vnd" ).hide();
            $( ".col-unit_price_rmb" ).hide();
            $( ".col-amount_rmb" ).hide();
            $( ".col-end_user_price_rmb" ).hide();
            $( ".col-selling_amount_rmb" ).hide();
        }
    });
    get_info_Currency();
    function get_info_Currency() {
        var val =  $('#Currency').val();
        if (val == 'USD') {
            $('#PORates').val(accounting.formatMoney(1, '', 2));
        }else if(val == 'VND'){
            $('#Rates_lable').html('VND');
            $( ".col-unit_price_vnd" ).show();
            $( ".col-amount_vnd" ).show();
            $( ".col-end_user_price_vnd" ).show();
            $( ".col-selling_amount_vnd" ).show();
        }
        else if(val == 'RMB'){
            $('#Rates_lable').html('RMB');
            $( ".col-unit_price_rmb" ).show();
            $( ".col-amount_rmb" ).show();
            $( ".col-end_user_price_rmb" ).show();
            $( ".col-selling_amount_rmb" ).show();
            $( ".currency_vnd" ).hide();
            $( ".col-unit_price_eur" ).hide();
            $( ".col-amount_eur" ).hide();
            $( ".col-end_user_price_eur" ).hide();
            $( ".col-selling_amount_eur" ).hide();
        }else if(val == 'EUR'){
            $('#Rates_lable').html('EUR');
            $( ".col-unit_price_eur" ).show();
            $( ".col-amount_eur" ).show();
            $( ".col-end_user_price_eur" ).show();
            $( ".col-selling_amount_eur" ).show();
            $( ".currency_vnd" ).hide();
            $( ".col-unit_price_rmb" ).hide();
            $( ".col-amount_rmb" ).hide();
            $( ".col-end_user_price_rmb" ).hide();
            $( ".col-selling_amount_rmb" ).hide();
        }
    }
     $(document).click(function(e) {
        if (!$(e.target).is('.part-list-with-po')) {
            $(".part-list-with-po").hide();
        }
    });

});