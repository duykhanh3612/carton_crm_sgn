function loadchild_table(inv, i, zi, BuyingPrice = '',BuyingPriceVN = '', $add = false) {
    var complete1 =  $('#complete').val()==0 ? '':'disabled' ;
    var chill_stt = zi;
    var name = "products[" + i + "][invoice][" + chill_stt + "]";
    var tag = 'trloop1';
    var tid = 'sub_1_'+chill_stt;
    if(i != "0") {
        if($add == true){
            tag = 'trloop'+(i);
            tid = 'sub_'+(i)+'_'+chill_stt;
        }else{
            tag = 'trloop'+(i+1);
            tid = 'sub_'+(i+1)+'_'+chill_stt;
        }

    }
    var zz = '<tr class="child-table ' + tag + '" id="'+tid+'" data-stt="'+i+'">';
    if (zi > 1) {
        zz += '<td class="bgcolor col-no center"> <a href="javascript:;" style="color: white" id="remove-sub-part" class="remove-contact" ><i class="glyph-icon icon-remove"></i></a> </td>';
    } else {
        zz += '<td class="bgcolor col-no center"></td>';
    }
    zz +=
        '    <td class="bgcolor" style="width: 50px;min-width: 50px;max-width: 50px;">' +
        '        <div>' +
        '            <div class="header-shipmment hidden ">' +
        '                <span class="addRowpo" style=" cursor: pointer;"><i class="glyph-icon icon-plus" ></i> No #' +
        '            </div>' +
        '            <div>' +
        '                <input class="form-control mystt" type="text" value="' + (chill_stt) + '" readonly>' +
        '            </div>' +
        '        </div>' +
        '    </td>' +
        '    <td class="bgcolor">' +
        '        <div>' +
        '            <div class="header-shipmment hidden">' +
        '                Invoice No' +
        '            </div>' +
        '            <div>' +
        '                <input type="text" class="form-control" name="' + name + '[InvoiceNo]" value="' + (!!inv.InvoiceNo ? inv.InvoiceNo : '') + '" '+complete1+'>' +
        '            </div>' +
        '        </div>' +
        '    </td>' +
        '    <td class="bgcolor">' +
        '        <div>' +
        '            <div class="header-shipmment hidden">' +
        '                Invoice Date' +
        '            </div>' +
        '            <div>' +
        '                <input type="text" class="bootstrap-datepicker form-control" name="' + name + '[InvoiceDate]" value="' + (!!inv.InvoiceDate ? inv.InvoiceDate : '') + '" '+complete1+'>' +
        '            </div>' +
        '        </div>' +
        '    </td>' +
        '    <td class="bgcolor col-no center" colspan="2">' +
        '        <div>' +
        '            <div class="header-shipmment hidden">' +
        '                Sub VOI / TAX' +
        '            </div>' +
        '            <div>' +
        '        <div class="input-group"><input name="' + name + '[SubValueOfInvoice]" class="form-control currency-unit" value="' + (!!inv.SubValueOfInvoice ? inv.SubValueOfInvoice : '') + '" '+complete1+'>' +
        '            <div class="input-group-btn"><select name="' + name + '[TAX]" class="select-status">' +
        '                <option value="0" ' + (inv.TAX == "0" ? "selected" : "") + '>0%</option>' +
        '                <option value="3" ' + (inv.TAX == "3" ? "selected" : "") + '>3%</option>' +
        '                <option value="5" ' + (inv.TAX == "5" ? "selected" : "") + '>5%</option>' +
        '                <option value="10" ' + (inv.TAX == "10" ? "selected" : "") + '>10%</option>' +
        '                <option value="20" ' + (inv.TAX == "20" ? "selected" : "") + '>20%</option>' +
        '                </select></div>' +
        '            </div>' +
        '            </div>' +
        '        </div>' +
        '</td>';


    if (chill_stt =="1") {
        zz += '    <td class="bgcolor">' +
            '        <div>' +
            '            <div class="header-shipmment hidden">' +
            '                Invoice Value' +
            '            </div>' +
            '            <div>' +
            '                <input type="text" class="form-control produc-value" name="' + name + '[Value]" value="' + (!!inv.Value ? inv.Value : '') + '" '+complete1+'>' +
            '            </div>' +
            '        </div>' +
            '    </td>';
        zz += '    <td class="bgcolor">' +
            '        <div>' +
            '            <div class="header-shipmment hidden">' +
            '                Advance payment' +
            '            </div>' +
            '    <div class="td-cur-usd">' +
            '<input readonly type="text" class="form-control depositusd" value="' + BuyingPrice + '" '+complete1+'/>' +
            '    </div>' +
            '    <div class="td-cur-vnd">' +
            '<input readonly type="text" class="form-control deposit" value="' + BuyingPriceVN + '" '+complete1+'/>' +
            '            </div>' +
            
            '        </div>' +
            '    </td>' +

            '    <td class="bgcolor">' +
            '        <div>' +
            '            <div class="header-shipmment hidden">' +
            '                Payment' +
            '            </div>' +
            '            <div>' +
            '<input readonly type="text" class="payment form-control" name="' + name + '[Payment]" value="' + (inv.Payment != undefined ? inv.Payment : '') + '"  '+complete1+'/>' +
            '            </div>' +
            '        </div>' +
            '    </td>' +
            '    <td class="bgcolor">' +
            '        <div>' +
            '            <div class="header-shipmment hidden">' +
            '                Receipt' +
            '            </div>' +
            '            <div>' +
            '<input readonly type="text" class="spend form-control" name="' + name + '[Spend]" value="' + (inv.Spend != undefined ? inv.Spend : '') + '"  '+complete1+'/>' +
            '            </div>' +
            '        </div>' +
            '    </td>';
    } else {
        zz += '<td class="bgcolor col-no center"></td><td class="bgcolor col-no center"></td>' +
            '<td class="bgcolor col-no center"><span class="payment"></span></td>' +
            '<td class="bgcolor col-no center"><span class="spend"></span></td>';
    }
    zz += '<td class="bgcolor col-no center"></td>'
    zz += '<td class="bgcolor col-no center"></td>'
    zz += '<td class="bgcolor col-no center"></td>'
    zz += '<td class="bgcolor col-no center"></td>'
    zz +='</tr>';
    return zz;
}

$(document).ready(function ($) {


    $('body').on('click', '#remove-sub-part', function () {
        var tr = $(this).closest('tr');

        var stt = tr.find('.stt').text();
        $.alerts.confirm('Bạn có chắc sẽ xóa #No.' + stt, 'Xác nhận ', function (r) {
            if (r == true) {
                tr.remove();
            }
        });

    }).on('change', '.produc-value', function () {
        var tr = $(this).closest('tr');
        var dep = parseFloat(tr.find('.deposit').val().replace(/\s/g, '').replace(/,/g, ''));
        var val = parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        var rs = 0;
        if (dep != '' && val != '') {
            rs = dep - val;
        }
        var rsz = accounting.formatMoney(rs, '', 0);
        if (rs > 0) {
            tr.find('.payment').text(rsz);
            tr.find('.payment').val(rsz);
            tr.find('.spend').text(0);
            tr.find('.spend').val(0);
        } else {
            tr.find('.spend').text(rsz);
            tr.find('.spend').val(rsz);
            tr.find('.payment').text(0);
            tr.find('.payment').val(0);
        }
        update_tt_sub_table();
        var z = $(this).val();
        $(this).val(accounting.formatMoney(z, '', 0));
        updateDataSum();
    }).on('click', '.addRowpo', function () {
        var chidtab = $(this).closest('tr.child-table');
        var table = $(this).closest('table.mainTable');
        var stt = parseInt(chidtab.data('stt'));
        var sstt = stt+1;
        var chill_stt = $('.child-table.trloop'+sstt).length;

        if(chill_stt >1){
            var sub_key = '#sub_'+(sstt)+'_'+chill_stt;
        }else{

            var sub_key = '#sub_'+(sstt)+'_1';
        }
        console.log(sstt);
        console.log('sub_key'+sub_key);
        var dep = table.find('.deposit').first().val();
        var string = '';
        var removeElements = function (text, selector) {
            var wrapped = $(text);
            wrapped.find(selector).remove();
            return wrapped.html();
        }
        string = loadchild_table('', (stt), (chill_stt+1),(chill_stt+1), dep);
        $(sub_key).after(string);
        $('#itemList table tbody tr').find('.bootstrap-datepicker').datepicker({
            format: 'yyyy-mm-dd',
            language: 'vi',
            autoclose: true,
            todayHighlight: true
        });
    }).on('change', '#CompanyID', function () {
        var val = $(this).val();
        if (val == "") {
            $('#Address1').val('');
            $('#Phone1').val('');
            $('#Email1').val('');
        } else {
            $.ajax({
                url: site_url + 'ajax/get_info_with_id',
                type: 'POST',
                cache: false,
                data: {
                    id: val,
                    table: 'company_info',
                    act: ''
                },
                success: function (string) {
                    var getData = $.parseJSON(string);
                    $('#Address1').val(getData.Address);
                    $('#Email1').val(getData.EmailContact);
                    $('#Phone1').val(getData.Phone);
                }
            });
        }
    }).on('click', '#Director', function () {

        //var Director1=0;
        var name = $(this).data('name');
        var id = $(this).data('id');
        var user = $(this).data('user');
        var month = $(this).data('month');
        var limit = $(this).data('limit');
        var mount = $(this).data('mount');
        var advance = $(this).data('advance');

        //console.log(id);
        // console.log(parseFloat(string));
        // if (limit > month) {
        //     showNoti("The total amount you have payment in the current month " + accounting.formatMoney(limit, '', 0) + ". The payment limit is only " + accounting.formatMoney(month, '', 0) + " VND over limited in the month", "Update information failed!", "Err");
        //     return false;
        // } else {
            $.alerts.confirm('Are you sure you confirm this item? Successfully confirming the system will lock the system cannot be adjusted. Please double check before doing, Thanks !!!<br />', 'Confirm ', function (r) {
                if (r == true) {
                    $.ajax({
                        url: site_url + $('#act').val() + '/director',
                        type: 'POST',
                        cache: false,
                        data: {id: id, user: user, mount: mount, advance: advance},
                        success: function (string) {
                            // showNoti('Cập nhật purchase request thành công', 'Cảnh báo:', 'ok');
                        }
                    })
                    $('#updateFrm').submit();
                }

            });
        // }
    }).on('click', '#Leader', function () {
        var PrepareBy1 = 0;
        var name = $(this).data('name');
        var id = $(this).data('id');
        var user = $(this).data('user');

        $.alerts.confirm('Are you sure you confirm this item? Successfully confirming the system will lock the system cannot be adjusted. Please double check before doing, Thanks !!!<br />', 'Confirm ', function (r) {
            if (r == true) {
                $.ajax({
                    url: site_url + $('#act').val() + '/Leader',
                    type: 'POST',
                    cache: false,
                    data: {Leader: 1, id: id},
                    success: function (string) {
                        $('#updateFrm').submit();
                    }
                })
            }
        });


    }).on('click', '#PrepareBy', function () {
        //var PrepareBy1=0;
        var name = $(this).data('name');
        var id = $(this).data('id');
        var user = $(this).data('user');
        //console.log(id);
        // PrepareBy1 = PrepareBy1;
        $.alerts.confirm('Are you sure you confirm this item? Successfully confirming the system will lock the system cannot be adjusted. Please double check before doing, Thanks !!!<br />', 'Confirm ', function (r) {
            if (r == true) {
                $.ajax({
                    url: site_url + $('#act').val() + '/PrepareBy',
                    type: 'POST',
                    cache: false,
                    data: {PrepareBy: 1, id: id},
                    success: function (string) {
                        $('#updateFrm').submit();
                    }
                })
            }
        });
    }).on('click', '#Manager', function () {
        var Manager1 = 0;
        var name = $(this).data('name');
        var id = $(this).data('id');
        var user = $(this).data('user');
        $.alerts.confirm('Are you sure you confirm this item? Successfully confirming the system will lock the system cannot be adjusted. Please double check before doing, Thanks  !!!<br />', 'Confirm ', function (r) {
            if (r == true) {
                $.ajax({
                    url: site_url + $('#act').val() + '/Manager',
                    type: 'POST',
                    cache: false,
                    data: {Manager: 1, id: id},
                    success: function (string) {
                        $('#updateFrm').submit();
                    }
                })
            }
        });
    }).on('change', '.unit-price-usd', function () {
        var val = parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        var e = $(this).parent().parent();
        var qty =  e.find('.order-qty').val().replace(/\s/g, '').replace(/,/g, '');
        e.find('.price-amount-usd').val(accounting.formatMoney(qty*val, '', 2));
        $(this).val(accounting.formatMoney(val, '', 2));
        updateDataItem(e);
        updateDataSum();
    }).on('change', '.unit-price-vnd', function () {
        var val = parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
       // var qty = parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        var e = $(this).parent().parent();
        var qty =  e.find('.order-qty').val().replace(/\s/g, '').replace(/,/g, '');
        e.find('.price-amount-vnd').val(accounting.formatMoney(qty*val, '', 0));
        $(this).val(accounting.formatMoney(val, '', 0));
        updateDataItem(e);
        updateDataSum();

    });
});

function Request_purchase(id, type) {
    if (id == 0) return false;
    if (type == 0) {
        $('#Request').empty();
    } else {
        $.ajax({
            url: site_url + 'payment_request/get_purchase_request',
            type: 'POST',
            cache: false,
            data: {id: id},
            success: function (datz) {
                var getData = $.parseJSON(datz);
                var string = '';
                string = '<div id="itemList" class="table-responsive">';
                string += '<table class="mainTable table table-hover table-part" border="0" width="100%">';
                string += '<thead>';
                string += '<tr class="nodrop">';
                string += '<th nowrap="nowrap" class="left" style="padding-left:0;min-width: 25px;max-width: 25px;width: 25px;">No</th>';
                string += '<th class="left" style="min-width: 250px;max-width: 250px;width: 250px;" colspan="2">Part Number </th>';
                string += '<th class="left" style="min-width: 350px;max-width: 350px;width: 350px;" colspan="3">Description</th>';
                string += '<th class="center" style="min-width: 110px;max-width: 110px;width: 110px;">Manufacturer</th>';
                string += '<th class="center" style="min-width: 110px;max-width: 110px;width: 110px;">Package</th>';
                string += '<th class="center" style="min-width: 110px;max-width: 110px;width: 110px;">Quantity</th>';
                string += '<th class="center td-cur-usd " style="min-width: 170px;width: 170px;">Unit Price<br>(USD)</th>';
                string += '<th class="center td-cur-vnd " style="min-width: 170px;width: 170px;">Unit Price<br>(VND)</th>';
                string += '<th class="center" style="min-width: 170px;max-width: 170px;width: 170px;">Vat</br>(%)</th>';
                string += '<th class="center td-cur-vnd " style="min-width: 170px;max-width: 170px;width: 170px;">Amount<br>(VND)</th>';
                string += '<th class="center td-cur-usd " style="min-width: 170px;max-width: 170px;width: 170px;">Amount<br>(USD)</th>';
                /*string += '<th class="center th-desposit" style="min-width: 120px;max-width: 120px;width: 120px;">Desposit</th>';*/
                string += '<th class="amout left" style="min-width: 350px;max-width: 350px;width: 350px;"> Leadtime /<br>Comment</th>';
                string += '</thead>';
                string += '</tr>';
                string += ' <tbody>';
                var EditUnitPriceUSD= 0.0;
                var EditUnitPriceVND= 0.0;
                var EditAmountUSD = 0.0;
                var EditAmountVND = 0.0;
                if (Array.isArray(getData) && getData.length) {
                    for (var i = 0; i < getData.length; i++) {
                        var zstt = i + 1;
                        var Invoice = '';
                        if (!!getData[i]['Invoice'] && typeof getData[i]['Invoice'] == 'string') {
                            Invoice = $.parseJSON(getData[i]['Invoice']);
                        }

                     if(getData[i]['EditUnitPriceUSD']>0){
                        EditUnitPriceUSD=  getData[i]['EditUnitPriceUSD'];
                     }else{
                        EditUnitPriceUSD =  getData[i]['UnitPriceUSD'];
                     }
                     if(getData[i]['EditUnitPriceVND'] > 0){
                        EditUnitPriceVND=  getData[i]['EditUnitPriceVND'];
                     }else{
                        EditUnitPriceVND =  getData[i]['UnitPriceVND'];
                     }

                        EditAmountUSD= (EditUnitPriceUSD*getData[i]['Quantity'])*(1 + getData[i]['Vat'] / 100);
                        EditAmountVND= (EditUnitPriceVND*getData[i]['Quantity'])*(1 + getData[i]['Vat'] / 100);

                       // EditAmountVND=  (getData[i]['Quantity'] * EditUnitPriceVND * ( 1 + getData[i]['Vat'] / 100 ));
                        //console.log(EditAmountUSD);
                    
                     
                        string += '<tr class=" lengthPart myDragClass" id="' + i + '" >';
                        string += '<input type="hidden" name="products[' + i + '][id]" value="' + getData[i]['id'] + '">';
                        string += '<td class="left" style="min-width: 25px;max-width: 25px;width: 25px;" ><span class="stt">' + (zstt);
                        string += '<td colspan="2" style="min-width: 250px;max-width: 250px;width: 250px;"><span style="" title="' + getData[i]['PartNumber'] + '"> ' + getData[i]['PartNumber'] + '<span></td>';
                        string += '<td colspan="3" style="min-width: 350px;max-width: 350px;width: 350px;"><span style="text-align: left !important;" title="' + getData[i]['Description'] + '">' + getData[i]['Description'] + '</span>';
                        string += '<td class="center" style="min-width: 110px;max-width: 110px;width: 110px;"><span class="center" style=" " title="' + getData[i]['Manufacturer'] + '"> ' + getData[i]['Manufacturer'] + '</span></td>';
                        string += '<td style="min-width: 110px;max-width: 110px;width: 110px;"><span> ' + getData[i]['Package'] + '</span> </td>';
                        string += '<td class="right" style="min-width: 110px;max-width: 110px;width: 110px;"> <input type="text" id="products[' + i + '][Quantity]" name="products[' + i + '][Quantity]" class=" form-control order-qty no-border" value="' + (!!getData[i]['Quantity'] ? accounting.formatMoney(getData[i]['Quantity'], '', 0) : '') + '" readonly ></td>';
                        string += '<td class="center td-cur-usd" style="min-width: 170px;width: 170px;"><span></span> <input type="text" id="products[' + i + '][EditUnitPriceUSD]" name="products[' + i + '][EditUnitPriceUSD]" class="form-control unit-price-usd" value="'+accounting.formatMoney(EditUnitPriceUSD, '', 4) + '"></td>';
                        string += '<td class="center td-cur-vnd" style="min-width: 170px;width: 170px;"><span></span> <input type="text" id="products[' + i + '][EditUnitPriceVND]" name="products[' + i + '][EditUnitPriceVND]" class=" form-control unit-price-vnd " value="' + accounting.formatMoney(EditUnitPriceVND, '', 0)+ '"></td>';
                        string += '<td class="center" style="min-width: 170px;max-width: 170px;width: 170px;"><span></span> <input type="text" id="products[' + i + '][Vat]" name="products[' + i + '][Vat]" class=" form-control vat  no-border" value="' + accounting.formatMoney(getData[i]['Vat'], '', 0) + '"></td>';
                      //  string += '<span class="hidden" style="min-width: 170px;width: 170px;"><span></span> <input type="text" id="products[' + i + '][EditAmountVatUSD]" name="products[' + i + '][EditAmountVatUSD]" class=" form-control amout amout-vatusd no-border" value="' + accounting.formatMoney(getData[i]['EditAmountVatUSD'], '', 2) + ' "  readonly></td>';
                      //  string += '<span class="hidden" style="min-width: 170px;width: 170px;"><input type="text" id="AmountVND-' + i + '" name="products[' + i + '][EditAmountVatVND]" class=" form-control amout amout-vatvnd no-border" value="' + accounting.formatMoney(getData[i]['EditAmountVatVND'], '', 0) + '" readonly ></td>';
                     //                                                                                                                             // getData[i]['Quantity']) * EditUnitPriceUSD * ( 1 + getData[i]['Vat'] / 100 )
                        string += '<td class="center td-cur-usd" style="min-width: 170px;max-width: 170px;width: 170px;"><span></span> <input type="text" id="products[' + i + '][EditAmountUSD]" name="products[' + i + '][EditAmountUSD]" class=" form-control  amount-usd no-border" value="' +  accounting.formatMoney(EditAmountUSD, '', 2)+ ' "  readonly></td>';
                        string += '<td class="center td-cur-vnd" style="min-width: 170px;max-width: 170px;width: 170px;"><input type="text" id="AmountVND-' + i + '" name="products[' + i + '][EditAmountVND]" class=" form-control  amount-vnd no-border" value="' + accounting.formatMoney( EditAmountVND , '', 0) + '" readonly ></td>';
                        string += '<td class="note left" style="min-width: 350px;max-width: 350px;width: 350px; text-align: left !important;">' + getData[i]['Note'];
                        //string += '<input type="hidden" id="products[' + i + '][priceamountusd]" name="" class="form-control price-amount-usd"  no-border" value="' +(getData[i]['EditUnitPriceUSD']>0?(getData[i]['EditUnitPriceUSD']*getData[i]['Quantity']):(getData[i]['UnitPriceUSD']*getData[i]['Quantity'])) + '">';
                       // string += '<input type="hidden" id="products[' + i + '][priceamountvnd]" name="" class="form-control price-amount-vnd"  no-border" value="' +(getData[i]['EditUnitPriceVND']>0?(getData[i]['EditUnitPriceVND']*getData[i]['Quantity']):(getData[i]['UnitPriceVND']*getData[i]['Quantity'])) + '">';
                        string += '<input type="hidden" id="products[' + i + '][priceamountusd]" name="" class="form-control price-amount-usd"  no-border" value="' +(getData[i]['EditUnitPriceUSD']>0?(getData[i]['EditUnitPriceUSD']*getData[i]['Quantity']):(getData[i]['UnitPriceUSD']*getData[i]['Quantity'])) + '">';
                        string += '<input type="hidden" id="products[' + i + '][priceamountvnd]" name="" class="form-control price-amount-vnd"  no-border" value="' +(getData[i]['EditUnitPriceVND']>0?(getData[i]['EditUnitPriceVND']*getData[i]['Quantity']):(getData[i]['UnitPriceVND']*getData[i]['Quantity'])) + '">';
                     
                       string += '<input type="hidden" id="products[' + i + '][EditAmountVatUSD]" name="products[' + i + '][EditAmountVatUSD]" class="form-control amout-vatusd"  no-border" value="' + accounting.formatMoney( EditUnitPriceUSD* getData[i]['Quantity']*( getData[i]['Vat']/100), '', 2)  + '">';
                        string += '<input type="hidden" id="products[' + i + '][EditAmountVatVND]" name="products[' + i + '][EditAmountVatVND]" class="form-control amout-vatvnd"  no-border" value="' + accounting.formatMoney(EditUnitPriceVND*getData[i]['Quantity']*( getData[i]['Vat']/100), '', 0)  + '">';

                        string += '</tr>';
                        if (!!Invoice) {
                            $.each(Invoice, function (zi, inv) {
                                var zewe = parseInt(zi);
                                string += loadchild_table(inv, (zstt-1), (zewe), accounting.formatMoney(getData[i]['BuyingPriceUSD'],'',2),accounting.formatMoney(getData[i]['BuyingPricevn'],'',0));
                            })
                        } else {
                                string += loadchild_table('', (zstt-1), 1, getData[i]['BuyingPriceUSD'],getData[i]['BuyingPricevn']);
                        }
                    }
                }
                string += '</tbody>';
                string += '<tbody>';
                string += '<tr class="bg-primary "> <td colspan="5"></td><td  style="text-align:right;">Total</td> <td ><span class="tt-val"></span></td> <td class="td-cur-vnd"><span class="tt-dep"></span> <td class="td-cur-usd"><span class="tt-depusd"> </span></td></td> <td ><span class="tt-pay" ></span></td> <td ><span class="tt-spend"></span></td><td colspan="4"></td> </tr>';
                string  +='<input type="hidden" id="Invoice" name="Invoice" value = ""> ';
                string += '</tbody>';
                string += '<tfoot>';
                string += '<tr>' +
                    '    <td colspan="8"></td>' +
                    '    <td class="right" colspan="2"><b>SUB TOTAL</b></td>' +
                    '    <td class="center td-cur-usd" width="140">' +
                    '        <input type="text" style="text-align: center;" class=" center form-control text-center no-border" name="SubTotalUSD"' +
                    '               id="SubTotalUSD"' +
                    '               readonly>' +
                    '    </td>' +
                    '    <td class="center td-cur-usd" width="40">USD</td>' +
                    '    <td class="center td-cur-vnd" width="140"><input type="text" style="text-align: center;" class=" center form-control no-border "' +
                    '                                                    name="SubTotalVND" id="SubTotalVND"' +
                    '                                                    autocomplete="off">' +
                    '    </td>' +
                    '    <td class="center  td-cur-vnd" width="40">VNĐ</td>' +
                    '    <td colspan="2"></td>' +
                    '</tr>' +
                    '<tr>' +
                    '    <td colspan="8"></td>' +
                    '    <td class="right" colspan="2"><b>VAT</b></td>' +
                    '    <td class="center  td-cur-usd" width="140">' +
                    '        <input type="text" style="text-align: center;" name="VATTaxUSD" id="VATTaxUSD"' +
                    '               class="center form-control text-center no-border vat-usd  no-border "' +
                    '        >' +
                    '    </td>' +
                    '    <td class="center  td-cur-usd" width="40">USD</td>' +
                    '    <td class="center  td-cur-vnd" width="110">' +
                    '        <input type="text" style="text-align: center;" name="VATTaxVND" id="VATTaxVND"' +
                    '               class="center form-control text-center no-border vat-vnd no-border "' +
                    '               readonly>' +
                    '    </td>' +
                    '    <td class="center  td-cur-vnd" width="40">VNĐ</td>' +
                    '    <td colspan="2"></td>' +
                    '</tr>' +
                    '<tr>' +
                    '    <td colspan="8"></td>' +
                    '    <td class="right" colspan="2"><b>Total request payment</b></td>' +
                    '    <td class="center  td-cur-usd" width="110"><input type="text" style="text-align: center;" class="center form-control no-border "' +
                    '                                                     name="TotalUSD" id="TotalUSD"' +
                    '                                                     autocomplete="off">' +
                    '    </td>' +
                    '    <td class="center  td-cur-usd" width="40">USD</td>' +
                    '    <td class="center  td-cur-vnd" width="110"><input type="text" style="text-align: center;" class="center form-control no-border "' +
                    '                                                     name="TotalVND" id="TotalVND"' +
                    '                                                     autocomplete="off">' +
                    '    </td>' +
                    '    <td class="center  td-cur-vnd" width="40">VNĐ</td>' +
                    '    <td colspan="2"></td>' +
                    '</tr>' +
                    '<tr>' +
                    '    <td colspan="8"></td>' +
                    '    <td class="right" colspan="2"><b>Advance payment</b></td>' +
                    '    <td class="center  td-cur-usd" width="110"><input type="text" style="text-align: center;"' +
                    '                                                     class="center form-control no-border advance-usd"' +
                    '                                                     name="AmountUSD" id="AmountUSD"' +
                    '                                                     autocomplete="off" readonly>' +
                    '    </td>' +
                    '    <td class="center  td-cur-usd" width="40">USD</td>' +
                    '    <td class="center  td-cur-vnd" width="110"><input type="text" style="text-align: center;"' +
                    '                                                     class="center form-control no-border advance-vnd"' +
                    '                                                     name="AmountVND" id="AmountVND"' +
                    '                                                     autocomplete="off" readonly>' +
                    '    </td>' +
                    '    <td class="center  td-cur-vnd" width="40">VNĐ</td>' +
                    '    <td colspan="2"></td>' +
                    '</tr>' +
                    '<tr>' +
                    '    <td colspan="8"></td>' +
                    '    <td class="right" colspan="2"><b>Actual payment</b></td>' +
                    '    <td class="center  td-cur-usd" width="110" style=" border-top: 2px solid #ff8000; "><input style="text-align: center"' +
                    '                type="text" class=" center form-control no-border actual-usd" name="ActualUSD"' +
                    '                id="ActualUSD"' +
                    '                autocomplete="off" readonly>' +
                    '    </td>' +
                    '    <td class="center  td-cur-usd" width="40" style=" border-top: 2px solid #ff8000; ">USD</td>' +
                    '    <td class="center td-cur-vnd" width="110" style=" border-top: 2px solid #ff8000; "><input style="text-align: center !important;"' +
                    '                type="text" class="center form-control no-border actual-vnd" name="ActualVND"' +
                    '                id="ActualVND"' +
                    '                autocomplete="off" readonly>' +
                    '    </td>' +
                    '    <td class="center  td-cur-vnd" width="40" style=" border-top: 2px solid #ff8000; ">VNĐ</td>' +
                    '    <td colspan="2"></td>' +
                    '</tr>' +
                    '<tr>' +
                    '    <td colspan="8"></td>' +
                    '    <td class="right" colspan="2"><b>Amount in words: </b></td>' +
                    '    <td colspan="99" class="left">' +
                    '        <input type="hidden" name="InWord" id="InWord" />' +
                    '        <span id=\'InWordUSD\' class="left  td-cur-usd"></span>' +
                    '        <span id=\'InWordVND\' class="left  td-cur-vnd"></span>' +
                    '    </td>' +
                    '    <td colspan="2"></td>' +
                    '</tr>'
                string += '</tfoot>';
                string += '</table>';
                string += '</div>';
                $('#Request').html(string);
                $('#itemList table tbody tr').find('.bootstrap-datepicker').datepicker({
                    format: 'yyyy-mm-dd',
                    language: 'vi',
                    autoclose: true,
                    todayHighlight: true
                });


                $('#Purchase').removeClass('hidden');
                $('#AmountTable').removeClass('hidden');
                $('.mainTable').stickyTableHeaders({
                    fixedOffset: $('#page-header').height() + ($('.group-process').length ? 32 : 0)
                });
                for (var i = 0; i <= getData.length; i++) {
                    $('tr.trloop' + i + ':first').find('.header-shipmment').removeClass('hidden');
                }
                $( ".currency-unit" ).change(function() {
                    var val = parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
                    var btn = $(this).closest('tr').prev();
                    var tr = $(this).closest('tr');
                    var tax = parseFloat(btn.find('.vat').val().replace(/\s/g, '').replace(/,/g, ''));
                    invoiceValue = val * (1 + tax/100 );
                    if ($('#CurrencyOfRequest').val() == "1") {
                        tr.find('.produc-value').val(accounting.formatMoney(invoiceValue, '', 0));
                    } else {
                        tr.find('.produc-value').val(accounting.formatMoney(invoiceValue, '', 0));
                    }
                    var dep = parseFloat(tr.find('.deposit').val().replace(/\s/g, '').replace(/,/g, ''));
                    var valueinvoice = invoiceValue;
                    var rs = 0;
                    if (dep != '' && valueinvoice != '') {
                        rs = dep - valueinvoice;
                    }
                    var rsz = accounting.formatMoney(rs, '', 0);
                    if (rs > 0) {
                        tr.find('.payment').text(rsz);
                        tr.find('.payment').val(rsz);
                        tr.find('.spend').text(0);
                        tr.find('.spend').val(0);
                    } else {
                        tr.find('.spend').text(rsz);
                        tr.find('.spend').val(rsz);
                        tr.find('.payment').text(0);
                        tr.find('.payment').val(0);
                    }
                    update_tt_sub_table();
                    // var z = $(this).val();
                    // $(this).val(accounting.formatMoney(z, '', 2))
                });
            }
        })
    }
}


/*function request_amount(id){
var string = '';	
//var SubTotalVND = parseFloat($('#SubTotalVND').val().replace(/\s/g, '').replace(/,/g, ''));
//var TotalUSD = parseFloat($('#TotalUSD').val().replace(/\s/g, '').replace(/,/g, ''));
//var TotalVND = parseFloat($('#TotalVND').val().replace(/\s/g, '').replace(/,/g, ''));
//var UnitPriceUSD = $('[name="USDExchangeRate"]').val().replace(/\s/g, '').replace(/,/g, '');

 //$('#RequesForAdvance' ).val('').trigger('chosen:updated' );
 //$('#AmountVND').val(0);
 //$('#AmountUSD').val(0);
 //console.log($('#SubTotalVND').val());
	   $.ajax({
				url: site_url + 'payment_request/get_purchase_request_pay',
				type: 'POST',
                cache: false,
                data: {
                    id: id,
                   // table: 'purchase_request',
                    //act: 'purchase_request'
                },
                success: function (string) {
					var getData = $.parseJSON(string);
				//	console.log(getData);

					
				if(getData == false)
					{
						//$('#advance1').attr('value',accounting.formatMoney( getData.AmountVND,'',0));
						$('#advance1').val(0);

					//	$('.advance-usd').val('#AmountVN');
						//$('.advance-vnd').val(0);
						//$('#ActualUSD').val(accounting.formatMoney(TotalUSD,'',2));
						//$('#ActualVND').val(accounting.formatMoney(TotalVND,'',0));
				  		//$('#InWord').val(DocTienBangChu(TotalVND));
				   		//$('#InWord1').html(DocTienBangChu(TotalVND));
					}
					else{
						$('#advance1').attr('value',accounting.formatMoney( getData.AmountVND,'',0));
				//	$('#RequesForAdvance' ).val(getData.advanceid).trigger('chosen:updated' );
					/*	$('[name="AmountUSD"]').attr('value',accounting.formatMoney(getData.AmountVND/UnitPriceUSD,'',2));
						$('[name="AmountVND"]').attr('value',accounting.formatMoney( getData.AmountVND,'',0));
						$('#ActualUSD').val(accounting.formatMoney(TotalUSD - Number(getData.AmountVND/UnitPriceUSD),'',2));
						$('#ActualVND').val(accounting.formatMoney(TotalVND-getData.AmountVND,'',0));
						var soTienAm = $('#ActualVND').val().replace(/\s/g, '').replace(/,/g, '');
						$('#InWord').val(soTienAm);
					    $('#InWord1').html(DocTienBangChu(soTienAm<0? - soTienAm : soTienAm));*/

/*	}
}
});
}

*/
function updateDataSum() {
    var sumTotal = 0.0;
    var sumTotalVND = 0.0;
    var sumSubTotalvnd = 0.0;
    var sumSubTotalusd = 0.0;
    var VAT = 0.0;
    //var sumVAT = 0.0;
    var sumVATVND = 0.0; 
   // 
//alert(invoice);
   // alert(1);
   // var parent = $(this).closest('#itemList');
   // var AmountVND = parseFloat($('.advance-vnd').val().replace(/\s/g, '').replace(/,/g, ''));
  //  var AmountUSD = parseFloat($('.advance-usd').val().replace(/\s/g, '').replace(/,/g, ''));
  //var buy = parent.find('.order-qty').val();
//console.log(parent);
update_tt_sub_table();
var invoice=$('[name="ActualVND"]').val();
invoice= invoice.replace('-(', '').replace(')', '').replace(/,/g, '')
//invoice= invoice..replace(/,/g, '')
//alert(invoice);

    if ($('.unit-price-vnd').length > 0) {
        $('.amount-usd').each(function () {
            sumTotal += parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        });
       
        $('.price-amount-usd').each(function () {
            sumSubTotalusd += parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        });
        $('.price-amount-vnd').each(function () {
            sumSubTotalvnd += parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        });
        $('.amount-vnd').each(function () {
            sumTotalVND += parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        });
        $('.amout-vatusd').each(function () {
            VAT += parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        });
        $('.amout-vatvnd').each(function () {
            sumVATVND += parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        });
        
        ShippingChargesUSD = 0;
        ShippingChargesVND = 0;
        BankChargesUSD = 0;
        BankChargesVND = 0;
        AmountUSD = 0;
        AmountVND = 0;
        /*ShippingChargesUSD = parseFloat($('#ShippingChargesUSD').val().replace(/\s/g, '').replace(/,/g, ''));
        ShippingChargesVND = parseFloat($('#ShippingChargesVND').val().replace(/\s/g, '').replace(/,/g, ''));
        BankChargesUSD = parseFloat($('#BankChargesUSD').val().replace(/\s/g, '').replace(/,/g, ''));
        BankChargesVND = parseFloat($('#BankChargesVND').val().replace(/\s/g, '').replace(/,/g, ''));*/
        //AmountUSD =  parseFloat($('#AmountUSD').val().replace(/\s/g, '').replace(/,/g, ''));
        AmountVND =  parseFloat($('#AmountVND').val().replace(/\s/g, '').replace(/,/g, ''));
      //  VAT = VAT;
       // sumVATVND = sumVATVND;
       //alert(Number(sumTotalVND) + Number(sumVATVND));
        $('.vat-vnd').val(accounting.formatMoney(sumVATVND, '', 0));
        //alert(sumVATVND);
        $('#VATTaxUSD').val(accounting.formatMoney(VAT, '', 2));

        $('#SubTotalUSD').val(accounting.formatMoney(sumSubTotalusd, '', 2));
        $('#SubTotalVND').val(accounting.formatMoney(sumSubTotalvnd, '', 0));
        $('#TotalUSD').val(accounting.formatMoney(sumTotal + Number(ShippingChargesUSD) + Number(BankChargesUSD), '', 2));
        $('#TotalVND').val(accounting.formatMoney(Number(sumTotalVND) + Number(ShippingChargesVND) + Number(BankChargesVND), '', 0));
        // $('#ActualUSD').val(accounting.formatMoney((sumTotal + VAT + Number(ShippingChargesUSD) + Number(BankChargesUSD)) - AmountUSD, '', 2));
        // $('#ActualVND').val(accounting.formatMoney((sumTotalVND + sumVATVND + ShippingChargesVND + BankChargesVND) - AmountVND, '', 0));
      //  $('#InWord').val(DocTienBangChu(parseFloat($('#TotalVND').val().replace(/\s/g, '').replace(/,/g, ''))));
       // $('#InWord1').html(DocTienBangChu(parseFloat($('#TotalVND').val().replace(/\s/g, '').replace(/,/g, ''))));
    } else {
        $('#SubTotalUSD').val(accounting.formatMoney(0, '', 2));
        $('#SubTotalVND').val(0);
        $('#TotalUSD').val(accounting.formatMoney(0, '', 2));
        $('#TotalVND').val(0);
    }
    //var current_mode= $('#CurrencyOfRequest').val();
    //alert(current_mode);
   //if (current_mode==1) {

    if(invoice > 0||AmountVND>0 ){
        $('#InWord').val(DocTienBangChu(parseFloat(invoice)));
        $('#InWordVND').html(DocTienBangChu(parseFloat(invoice)));

    }else{
    $('#InWord').val(DocTienBangChu(parseFloat($('#TotalVND').val().replace(/\s/g, '').replace(/,/g, ''))));
    $('#InWordVND').html(DocTienBangChu(parseFloat($('#TotalVND').val().replace(/\s/g, '').replace(/,/g, ''))));
 //  }else{

   // $('#InWord').val(toWords(parseFloat($('#TotalUSD').val().replace(/\s/g, '').replace(/,/g, ''))));
    $('#InWordUSD').html(toWords(parseFloat($('#TotalUSD').val().replace(/\s/g, '').replace(/,/g, ''))));
    }
 //  }
}/*
setTimeout(function(){  updateDataSum();
}, 1000);
setTimeout(function(){  updateDataSum();update_tt_sub_table();
   // console.log($('#TotalVND').val());
   var current_mode= $('#CurrencyOfRequest').val();
   if (current_mode==1) {
    $('#InWord').val(DocTienBangChu(parseFloat($('#TotalVND').val().replace(/\s/g, '').replace(/,/g, ''))));
    $('#InWord1').html(DocTienBangChu(parseFloat($('#TotalVND').val().replace(/\s/g, '').replace(/,/g, ''))));
   }else{

    $('#InWord').val(toWords(parseFloat($('#TotalUSD').val().replace(/\s/g, '').replace(/,/g, ''))));
    $('#InWord1').html(toWords(parseFloat($('#TotalUSD').val().replace(/\s/g, '').replace(/,/g, ''))));

   }
}, 2000);
*/

function update_tt_sub_table() {
    var val = 0;
    var dep = 0;
    var depusd = 0.0;
   //alert(1);
    $('.child-table').each(function () {
        var _this = $(this);
        var dd = 0;
        var ddusd = 0;
        if (!!_this.find('.deposit') && !!_this.find('.deposit').val()) {
            dd = _this.find('.deposit').val().replace(/\s/g, '').replace(/,/g, '');
        }
        if (!!_this.find('.depositusd') && !!_this.find('.depositusd').val()) {
            ddusd = _this.find('.depositusd').val().replace(/\s/g, '').replace(/,/g, '');
        }
        var vv = 0;
        var zx = _this.find('.produc-value').val();
        if (!!zx) {
            vv = zx.replace(/\s/g, '').replace(/,/g, '');
        }
        var _dd = parseFloat(dd);
        var _ddusd = parseFloat(ddusd);
        var _vv = parseFloat(vv);

        if (!!_dd && _dd != 0) dep += parseFloat(_dd);
        if (!!_ddusd && _ddusd != 0) depusd += parseFloat(_ddusd);
        if (!!_vv && _vv != 0) val += parseFloat(_vv);
    });
    var rs = 0;
    var rsusd = 0;
   // console.log(dep);
   if (val != '' && dep != '') rs = dep - val;
   if (val != '' && depusd != '') rsusd = depusd - val;
   $('.tt-val').text(accounting.formatMoney(val, '',0));
   $('.tt-dep').text(accounting.formatMoney(dep, '',0));
   $('#Invoice').val(accounting.formatMoney(val, '',0));
   //$('#Invoiceusd').val(accounting.formatMoney(depusd, '',2));
    
    $('.tt-depusd').text(accounting.formatMoney(depusd, '',2));
    $('.advance-vnd').val(accounting.formatMoney(dep, '',0));
    $('.advance-usd').val(accounting.formatMoney(depusd, '',2));
    //$('.vat-vnd').val(accounting.formatMoney($('.vat').val(), '',0));
    //$('.tt-dep').text(accounting.formatMoney(dep, '',0));
    //console.log(dep);
    if (dep > 0){
        if (rs > 0) {
            $('.tt-pay').text(accounting.formatMoney(rs, '',0));
            $('.tt-spend').text(0);
            if ($('#CurrencyOfRequest').val() == "1") {
                $('#ActualVND').val(accounting.formatMoney(rs, '', 0));
            } else {
                $('#ActualUSD').val(accounting.formatMoney(rsusd, '', 2));
            }
        } else {
         //   console.log(rs);
            $('.tt-spend').text(accounting.formatMoney(rs, '',0));
            $('.tt-pay').text(0);
            if ($('#CurrencyOfRequest').val() == "1") {
                $('#ActualVND').val("-("+accounting.formatMoney(Math.abs(rs), '', 0)+")");
            } else {
                $('#ActualUSD').val("-("+accounting.formatMoney(Math.abs(rsusd), '', 2)+")");
            }
        }
    }
    
    remove_undefined();
}
function remove_undefined() {
    $('.child-table table tbody tr :input').each(function () {
        var _this = $(this);
        if (_this.val() == 'undefined' || _this.val() == undefined) _this.val(" ");
    });
    if ($('#CurrencyOfRequest').val() == "1") {
        $('.td-cur-usd').addClass('hidden');
        $('.td-cur-vnd').removeClass('hidden');
    } else {
        $('.td-cur-usd').removeClass('hidden');
        $('.td-cur-vnd').addClass('hidden');
    }
}

var th = ['', 'thousand', 'million', 'billion', 'trillion'];
var dg = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];
var tn = ['ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'];
var tw = ['twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];

function toWords(s) {

    s = s.toString();
    s = s.replace(/[\, ]/g, '');
    if (s != parseFloat(s)) return 'nodt a number';
    var x = s.indexOf('.');
    var fulllength = s.length;

    if (x == -1) x = s.length;
    if (x > 15) return 'too big';
    var startpos = fulllength - (fulllength - x - 1);
    var n = s.split('');

    var str = '';
    var str1 = '';
    var sk = 0;
    for (var i = 0; i < x; i++) {
        if ((x - i) % 3 == 2) {
            if (n[i] == '1') {
                str += tn[Number(n[i + 1])] + ' ';
                i++;
                sk = 1;
            } else if (n[i] != 0) {
                str += tw[n[i] - 2] + ' ';

                sk = 1;
            }
        } else if (n[i] != 0) {
            str += dg[n[i]] + ' ';
            if ((x - i) % 3 == 0) str += 'hundred ';
            sk = 1;
        }
        if ((x - i) % 3 == 1) {
            if (sk) str += th[(x - i - 1) / 3] + ' ';
            sk = 0;
        }
    }
    if (x != s.length) {

        str += 'and ';
        str1 += 'cents ';
        //for (var i = x + 1; i < y; i++) str += dg[n[i]] + ' ' ;
        var j = startpos;

        for (var i = j; i < fulllength; i++) {

            if ((fulllength - i) % 3 == 2) {
                if (n[i] == '1') {
                    str += tn[Number(n[i + 1])] + ' ';
                    i++;
                    sk = 1;
                } else if (n[i] != 0) {
                    str += tw[n[i] - 2] + ' ';

                    sk = 1;
                }
            } else if (n[i] != 0) {

                str += dg[n[i]] + ' ';
                if ((fulllength - i) % 3 == 0) str += 'hundred ';
                sk = 1;
            }
            if ((fulllength - i) % 3 == 1) {

                if (sk) str += th[(fulllength - i - 1) / 3] + ' ';
                sk = 0;
            }
        }
    }
    var result = str.replace(/\s+/g, ' ') + str1;
    $('.res').text(result);
    return result;

}