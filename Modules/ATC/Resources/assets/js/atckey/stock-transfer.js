var arrPartTarget = [];
$(function(){
    'use strict';
    zilla();
});

function zilla() {
    $('.table-source .tbody-source tr').each(function() {
        var lot_code = $(this).data('lot_code');
        var tr_source = $('.table-source tr.movee-row[data-lot_code="' + lot_code + '"]');
        var tr_target = $('.table-target tr.movee-row[data-lot_code="' + lot_code + '"]');
        var tr_temp = tr_source.clone(true, true);
        tr_temp.find('td:not(.no)').empty();
        if (tr_target.find('td').length) {
            var temp = tr_target.children().clone(true, true);
            var data_id = tr_target.data('id');
            var no = tr_source.find('.no').text();
            tr_target.remove();
            $('.table-target .tbody-target').append('<tr data-id="' + data_id + '" data-lot_code="' + lot_code + '" class="movee-row"></tr>');
            $('.table-target .tbody-target tr.movee-row[data-lot_code="' + lot_code + '"]').empty().append(temp).find('.no').text(no);
        } else {
            tr_temp.addClass('empty');
            $('.table-target .tbody-target').append(tr_temp);
        }
    })
    $(".table-responsive").scroll(function(){
        $(".table-responsive").scrollTop($($(this)).scrollTop());
    });
    $('.tbody-source').children('tbody').clone(true, true).append('.tbody-target').children('tbody');
}

$('body').on('click', '#btn-transfer', function() {
    if ($('#warehouseid_target').val() == '' || $('#cpoid_target[data-required="1"]').val() == '') {
        showNoti('Kiểm tra và điền đầy đủ thông tin Source và Target trước khi kết chuyển', 'Cảnh báo', 'War');
        return false;
    }
    $('table.movee tr.movee-row.selected').each(function() {
        var thisParent = $(this).closest('table.movee').data('table');
        if ($('.modalTransferQuantity').length) {

        } else {
            createQuantityModal($(this).find('td.quantity input').val().replace(/,/g, ''), $(this).data('lot_code'), thisParent);
            return false;
        }
    })
}).on('dblclick', 'table.table-source tr.movee-row:not(.empty)', function() {
    if ($('#warehouseid_target').val() == '' || $('#cpoid_target[data-required="1"]').val() == '') {
        showNoti('Kiểm tra và điền đầy đủ thông tin Source và Target trước khi kết chuyển', 'Cảnh báo', 'War');
        return false;
    }
    var thisParent = $(this).closest('table.movee').data('table');
    $(this).addClass('selected');
    var supplier_part = $(this).find('td.supplier_part input.form-control').val();
    if (!arrPartTarget.includes(supplier_part)) {
        showNoti('Part này không tồn tại trong CPO <br><b>' + $('#cpoid_target_chosen a span').text() + '</b>', 'Cảnh báo', 'War');
        return false;
    }
    createQuantityModal($(this).find('td.quantity input').val().replace(/,/g, ''), $(this).data('lot_code'), thisParent);
}).on('click', 'table.table-source tr.movee-row:not(.empty)', function(e) {
    var parent = $('table.movee');
    var thisParent = $(this).closest('table.movee');
    if (e.target) {
        parent.find('tr.selected').not($(this)).removeClass('selected');
        !$(this).hasClass('selected') ? $(this).addClass('selected') : $(this).removeClass('selected');
    }
    if (thisParent.hasClass('table-target')) {
        $('#btn-transfer i').removeClass('fa-long-arrow-right').addClass('fa-long-arrow-left');
    } else {
        $('#btn-transfer i').removeClass('fa-long-arrow-left').addClass('fa-long-arrow-right');
    }
}).on('click', '.close-modal', function() {
    var parent = $(this).closest('.modalTransferQuantity');
    parent.find('input').val('');
    parent.remove();
}).on('keyup', '.transferQuantity', function() {
    var parent = $(this).closest('.modalTransferQuantity');
    var qty = parseInt($(this).val());
    if (isNaN(qty) || qty < 1 || qty > parent.find('.transferQuantityLimit').val()) {
        $(this).val(0);
        parent.find('.btn-success').addClass('disabled');
        showNoti('Số lượng không được nhỏ hơn 1 hoặc lớn hơn ' + parent.find('.transferQuantityLimit').val(), 'Cảnh báo', 'War');
    } else {
        $(this).val(parseInt($(this).val()));
        parent.find('.btn-success').removeClass('disabled');
    }
}).on('keypress', '.transferQuantity', function(e) {
    var key = e.which;
    if(key == 13) {
        $(this).closest('.modalTransferQuantity').find('.btn-success').click();
        return false;  
    }
}).on('click', '.modalTransferQuantity .btn-success', function() {
    var parent = $(this).closest('.modalTransferQuantity'),
        lot_code = parent.find('.lot_code_transfer').text(),
        qty = parseInt(parent.find('.transferQuantity').val().replace(/,/g, '')),
        tr_source = $('.table-source tr.movee-row[data-lot_code="' + lot_code + '"]'),
        tr_target = $('.table-target tr.movee-row[data-lot_code="' + lot_code + '"]'),
        clone = tr_source.clone(),
        old_qty_source = parseInt(tr_source.find('.quantity input').val().replace(/,/g, '')),
        old_qty_target = tr_target.find('.quantity input').length ? parseInt(tr_target.find('.quantity input').val().replace(/,/g, '')) : 0,
        old_qty_target = isNaN(old_qty_target) ? 0 : old_qty_target;
        dataTable = parent.find('.dataTableCurrent').val();
    if (dataTable == 'table-source') {
        if (tr_target.length && tr_target.hasClass('empty')) {
            tr_target.removeClass('empty').empty();
            tr_target.append(tr_source.find('td').clone());
            tr_target.find('.idItem').val('');
            tr_target.find('td.cpo span').empty().text($('#cpoid_target_chosen a span').text());
            tr_target.find('td.cus span').empty().text($('#cusid_target_chosen a span').text());
        } else {
            // $('.table-target').append(clone);
        }
        tr_target.find('.quantity input').val(accounting.formatMoney(old_qty_target + qty, '', 0));
        tr_target.addClass('updated');
        tr_source.find('.quantity input').val(accounting.formatMoney(old_qty_source - qty, '', 0));
    } else {
        tr_target.find('.quantity input').val(accounting.formatMoney(old_qty_target - qty, '', 0));
        tr_source.find('.quantity input').val(accounting.formatMoney(old_qty_source + qty, '', 0));
    }
    $('table.table-target').find('input').each(function() {
        var name = $(this).attr('name').replace('source', 'target');
        $(this).attr('name', name);
    });
    sum_item(tr_source);
    sum_item(tr_target);
    $(this).closest('.modalTransferQuantity').remove();
}).on('change', '#warehouseid_source', function() {
    $('#goods_receipt').empty().val('').trigger('chosen:updated');
    $('table.movee tbody').empty();
    $.ajax({
        url: site_url + 'stock_transfer/get_goods_receipt',
        type: 'POST',
        cache: false,
        data: {
            warehouseid: $(this).val()
        },
        success: function(string) {
            if (string != 0) {
                var getData = $.parseJSON(string);
                var optionGoodsReceipt = '<option value="">Select...</option>';
                for (var i = 0; i < getData.length; i ++) {
                    optionGoodsReceipt += '<option value="' + getData[i]['id'] + '">' + getData[i]['id'] + ' - ' + getData[i]['code'] + '</option>';
                }
                $('#goods_receipt').append(optionGoodsReceipt).removeClass('disabled').trigger('chosen:updated');
            }
        }
    })
}).on('change', '#goods_receipt_source', function() {
    showLoading();
    $.ajax({
        url: site_url + 'stock_transfer/get_part_goods_receipt',
        type: 'POST',
        cache: false,
        data: {
            id: $(this).val(),
            warehouse: $('#warehouseid_source').val(),
        },
        success: function (string) {
            var getData = $.parseJSON(string);
            $('#soluong_source').val(accounting.formatMoney(getData.soluong, '', 0));
            $('#tongtien_usd_source').val(accounting.formatMoney(getData.tongtien_usd, '', 2));
            $('#tongtien_vnd_source').val(accounting.formatMoney(getData.tongtien_vnd, '', 0));
            $('#USDExchangeRate').val(accounting.formatMoney(getData.USDExchangeRate, '', 0));
            var html = '';
            for (var i = 0; i < getData.part_list.length; i++) {
                html += '<tr data-id="' + getData.part_list[i]['id'] + '" data-lot_code="' + getData.part_list[i]['lot_code'] + '" class="movee-row">';
                html +=     '<td class="no">' + (i + 1) +'</td>';
                html +=     '<td class="cpo"><span>' + (getData.part_list[i]['cpo'] > 0 ? getData.part_list[i]['cpo'] + ' - ' + getData.part_list[i]['cpono'] : '') + '</span></td>';
                html +=     '<td class="cus"><span>' + (getData.part_list[i]['cus'] > 0 ? getData.part_list[i]['cus'] + ' - ' + getData.part_list[i]['cusname'] : '') + '</span></td>';
                html +=     '<td class="lot_code"><input type="hidden" class="idItem" name="source[' + i + '][id]" value="' + getData.part_list[i]['id'] + '"><input type="text" name="source[' + i + '][lot_code]" class="form-control no-border" value="' + getData.part_list[i]['lot_code'] + '" readonly></td>';
                html +=     '<td class="supplier_part"><input type="hidden" class="idSTPItem" name="source[' + i + '][stock_transfer_part_id]" value=""><input type="text" name="source[' + i + '][supplier_part]" class="form-control no-border" value="' + getData.part_list[i]['supplier_part'] + '" readonly></td>';
                html +=     '<td class="quantity"><input type="text" name="source[' + i + '][qty]" class="form-control text-center qtyItem no-border" value="' + accounting.formatMoney(getData.part_list[i]['inventory'], '', 0) + '" readonly></td>';
                html +=     '<td class="unit_price_usd"><input type="text" name="source[' + i + '][priceusd]" class="form-control text-right no-border priceUSDItem unit-price-usd" value="' + accounting.formatMoney(getData.part_list[i]['priceusd'], '', 4) + '" readonly></td>';
                html +=     '<td class="unit_price_vnd hidden"><input type="text" name="source[' + i + '][pricevnd]" class="form-control text-right no-border priceVNDItem unit-price-vnd" value="' + accounting.formatMoney(getData.part_list[i]['pricevnd'], '', 0) + '" readonly></td>';
                html +=     '<td class="amount_usd hidden"><input type="text" name="source[' + i + '][amountusd]" class="form-control text-right no-border amountUSDItem" value="' + accounting.formatMoney(getData.part_list[i]['amountusd'], '', 2) + '" readonly></td>';
                html +=     '<td class="amount_vnd hidden"><input type="text" name="source[' + i + '][amountvnd]" class="form-control text-right no-border amountVNDItem" value="' + accounting.formatMoney(getData.part_list[i]['amountvnd'], '', 0) + '" readonly></td>';
                html +=     '<td class="vat hidden"><input type="text" name="source[' + i + '][vat]" class="form-control text-right no-border VATUSDItem" value="' + getData.part_list[i]['vat'] + '" readonly></td>';
                html +=     '<td class="amount_vat hidden"><input type="text" name="source[' + i + '][amount_vat]" class="form-control text-right no-border amountVATVNDItem" value="' + accounting.formatMoney(getData.part_list[i]['amount_vat'], '', 0) + '" readonly></td>';
                html += '</tr>';
            }
            $('.table-target .tbody-target').empty();
            $('.table-source .tbody-source').empty().append(html);
            zilla();
            $('#toolbar-bottom').removeClass('hidden');
            hideLoading();
        }
    })
}).on('change', '#cpoid_source', function() {
    showLoading();
    var panel = $(this).closest('.panel-stock');
    $.ajax({
        url: site_url + 'stock_transfer/get_part_cpo_wh',
        type: 'POST',
        data: {
            cpoid: $(this).val(),
            whid: panel.find('.warehouse').val()
        },
        success: function(string) {
            if (string != 0) {
                var getData = $.parseJSON(string);
                console.log(getData);
                panel.find('.customerid').val(getData.CustomerID).trigger('chosen:updated');
                var html = '';
                if (typeof getData.querypart !== 'undefined') {
                    var partList = JSON.parse(getData.querypart);
                    for (var i = 0; i < partList.length; i++) {
                        html += '<tr data-id="' + partList[i]['id'] + '" data-lot_code="' + partList[i]['lot_code'] + '" class="movee-row">';
                        html +=     '<td class="no">' + (i + 1) +'</td>';
                        html +=     '<td class="cpo"><span>' + (partList[i]['cpo'] > 0 ? partList[i]['cpo'] + ' - ' + partList[i]['cpono'] : '') + '</span></td>';
                        html +=     '<td class="cus"><span>' + (partList[i]['cus'] > 0 ? partList[i]['cus'] + ' - ' + partList[i]['cusname'] : '') + '</span></td>';
                        html +=     '<td class="lot_code"><input type="hidden" class="idItem" name="source[' + i + '][id]" value="' + partList[i]['id'] + '"><input type="text" name="source[' + i + '][lot_code]" class="form-control no-border" value="' + partList[i]['lot_code'] + '" readonly></td>';
                        html +=     '<td class="supplier_part"><input type="hidden" class="idSTPItem" name="source[' + i + '][stock_transfer_part_id]" value=""><input type="text" name="source[' + i + '][supplier_part]" class="form-control no-border" value="' + partList[i]['supplier_part'] + '" readonly></td>';
                        html +=     '<td class="quantity"><input type="text" name="source[' + i + '][qty]" class="form-control text-center qtyItem no-border" value="' + accounting.formatMoney(partList[i]['inventory'], '', 0) + '" readonly></td>';
                        html +=     '<td class="unit_price_usd"><input type="text" name="source[' + i + '][priceusd]" class="form-control text-right no-border priceUSDItem unit-price-usd" value="' + accounting.formatMoney(partList[i]['priceusd'], '', 4) + '" readonly></td>';
                        html +=     '<td class="unit_price_vnd hidden"><input type="text" name="source[' + i + '][pricevnd]" class="form-control text-right no-border priceVNDItem unit-price-vnd" value="' + accounting.formatMoney(partList[i]['pricevnd'], '', 0) + '" readonly></td>';
                        html +=     '<td class="amount_usd hidden"><input type="text" name="source[' + i + '][amountusd]" class="form-control text-right no-border amountUSDItem" value="' + accounting.formatMoney(partList[i]['amountusd'], '', 2) + '" readonly></td>';
                        html +=     '<td class="amount_vnd hidden"><input type="text" name="source[' + i + '][amountvnd]" class="form-control text-right no-border amountVNDItem" value="' + accounting.formatMoney(partList[i]['amountvnd'], '', 0) + '" readonly></td>';
                        html +=     '<td class="vat hidden"><input type="text" name="source[' + i + '][vat]" class="form-control text-right no-border VATUSDItem" value="' + partList[i]['vat'] + '" readonly></td>';
                        html +=     '<td class="amount_vat hidden"><input type="text" name="source[' + i + '][amount_vat]" class="form-control text-right no-border amountVATVNDItem" value="' + accounting.formatMoney(partList[i]['amount_vat'], '', 0) + '" readonly></td>';
                        html += '</tr>';
                    }
                } else {
                    html = 'Part không tồn tại';
                }
                $('.table-target .tbody-target').empty();
                $('.table-source .tbody-source').empty().append(html);
                zilla();
                $('#toolbar-bottom').removeClass('hidden');
                hideLoading();
            }
        }
    })
}).on('change', '#cpoid_target', function() {
    var panel = $(this).closest('.panel-stock');
    $.ajax({
        url: site_url + 'stock_transfer/get_cpo_target',
        type: 'POST',
        data: {
            cpoid: $(this).val(),
        },
        success: function(string) {
            if (string != 0) {
                var getData = $.parseJSON(string);
                panel.find('.customerid').val(getData.CustomerID).trigger('chosen:updated');
                arrPartTarget = [];
                if (getData.part_list.length) {
                    arrPartTarget = getData.part_list.map(a => a.SupplierPart);
                }
            }
        }
    })
}).on('submit', '#updateFrm', function() {
    var flag = false;
    $('table.movee').each(function() {
        if (!$(this).find('input').length) {
            flag = true;
        }
    })
    if (flag) {
        showNoti('Chưa có sự kiện kết chuyển nào xảy ra', 'Cảnh báo', 'War');
        return false;
    }
})
function createQuantityModal($quantity = 0, $lot_code = '', $table = '') {
    if ($quantity > 0) {
        var modal = '<div class="modalTransferQuantity">';
            modal +=    '<div class="modalTransferContent">';
            modal +=        '<div class="modal-header">';
            modal +=            '<h4 class="modal-title text-center">Nhập số lượng kết chuyển</h4>';
            modal +=        '</div>';
            modal +=        '<div class="modal-body text-center">';
            modal +=            '<p class="mrg5A">XKKC Part: <b class="lot_code_transfer">' + $lot_code + '</b></p>';
            modal +=            '<p class="mrg5A">Số lượng tối thiểu là 1 tối đa là ' + accounting.formatMoney($quantity, '', 0) + '</p>';
            modal +=            '<p class="mrg5A"><input type="hidden" class="dataTableCurrent" value="' + $table + '"><input type="hidden" class="transferQuantityLimit" value="' + $quantity + '">';
            modal +=            '<input type="text" class="form-control transferQuantity money" value=""></p>';
            modal +=        '</div>';
            modal +=        '<div class="modal-footer">';
            modal +=            '<button type="button" class="btn btn-success disabled">Ok</button>';
            modal +=            '<button type="button" class="btn btn-danger close-modal">Close</button>';
            modal +=        '</div>';
            modal +=    '</div>';
            modal += '</div>';
        $('body').append(modal);
        $('.transferQuantity').focus();
    } else {
        showNoti('Mặt hàng này không có số lượng để kết chuyển', 'Cảnh báo', 'War');
    }
}

function sum_item(row) {
    var table = row.closest('table.movee').data('table').split('-')[1];
    var qty = parseInt(row.find('.qtyItem').val().replace(/,/g, ''));
    var priceusd = parseFloat(row.find('.priceUSDItem').val().replace(/,/g, ''));
    var pricevnd = parseFloat(row.find('.priceVNDItem').val().replace(/,/g, ''));
    var amountusd = qty * priceusd;
    var amountvnd = qty * pricevnd;
    var VAT = parseFloat(row.find('.VATUSDItem').val());
    row.find('.priceVNDItem').val(accounting.formatMoney(pricevnd, '', 0));
    row.find('.amountUSDItem').val(accounting.formatMoney(amountusd, '', 2));
    row.find('.amountVNDItem').val(accounting.formatMoney(amountvnd, '', 0));
    
    // var amountUSD = parseFloat(parent.find('.amountUSDItem').val().replace(/,/g,''));
    if (VAT > 0) {
        row.find('.amountVATVNDItem').val(accounting.formatMoney(parseFloat(amountvnd + (amountvnd * VAT / 100)), '', 0));
    } else {
        row.find('.amountVATVNDItem').val(0);
    }
    sum_all(table);
}

function sum_all(table = '') {
    tableNew = 'table.table-' + table;
    var totalAmountVND = 0.0,
        totalAmountUSD = 0.0,
        totalQty = 0;

    if ($(tableNew + ' .amountUSDItem').length > 0) {
        $(tableNew + ' .qtyItem').each(function() {
            totalQty += parseInt($(this).val().replace(/,/g, ''));
        });
        $('#soluong_' + table).val(accounting.formatMoney(totalQty, '', 0));

        $(tableNew + ' .amountUSDItem').each(function() {
            totalAmountUSD += parseFloat($(this).val().replace(/,/g, ''));
        });
        $('#tongtien_usd_' + table).val(accounting.formatMoney(totalAmountUSD, '', 2));

        $(tableNew + ' .amountVNDItem').each(function() {
            totalAmountVND += parseFloat($(this).val().replace(/,/g, ''));
        });
        $('#tongtien_vnd_' + table).val(accounting.formatMoney(totalAmountVND, '', 0));
    } else {
        $('#totalAmount').val(0);
    }
}