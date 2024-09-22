$(function () {
    if ( $( '.bootstrap-datetimepicker' ).length ) {
        var format = $( this ).data( 'format' );
        if ( format == '' || format == null ) {
            format = 'YYYY-MM-DD HH:mm:ss';
        }
        $( '.bootstrap-datetimepicker' ).datetimepicker( {
            format: format,
            useCurrent: false,
            locale: 'vi',
            icons: {
                time: 'glyph-icon icon-clock-o',
                date: 'glyph-icon icon-calendar',
                up: 'glyph-icon icon-chevron-up',
                down: 'glyph-icon icon-chevron-down',
                previous: 'glyph-icon icon-chevron-left',
                next: 'glyph-icon icon-chevron-right'
            }
        } );
    }
})
$(document).ready(function($) {
    $('#frmSearch').submit(function() {
        $('#divSearch').show();
        $('#divSearch div').css('max-height', '300px');
        $('#divSearch tbody').html('<tr><td class="fr center" colspan="10"><div style="padding:10px"><img src="assets/images/spinner-mini.gif"/></div></td></tr>');
        $.ajax({
            url: site_url + 'ajax/search_part',
            type: 'POST',
            cache: false,
            data: {
                q: $('[name="q"]').val()
            },
            success: function(string) {
                $('#divSearch tbody').empty().append(string);
                $('#divSearch tr:not(".no-data, .nodrop")').click(function() {
                    var tr = $(this);
                    var part = $(this).find('.part').text();
                    var key = 0;
                    if ($('.table-part tbody .row-data').length) {
                        key = parseInt($('.table-part tbody .row-data:last td .no').text()) + 1;
                    }
                    if ($('input[data-field="supplier_part"][value="' + part + '"]').length || $('tr[data-name="' + part + '"]').length) {
                        $('tr[data-name="' + part + '"], tr:has(input[data-field="supplier_part"][value="' + part + '"])').addClass('exists').delay(7000).queue(function(next) {
                            $(this).removeClass("exists");
                            next();
                        });
                        showNoti('Supplier Part Number: ' + part.replace('&', '&amp;') + ' already exist', 'Warning', 'War');
                    } else {
                        var data = {
                            key: key,
                            category: tr.data('category'),
                            img: tr.find('img').data('url'),
                            image: tr.find('img').data('image'),
                            supplier_part: tr.find('td.part').text(),
                            manufacturer_part_number: tr.find('span.mfr-part').text(),
                            description: tr.find('span.desc').text(),
                            manufacturer: tr.find('td.manufacturer').text(),
                            quantity: 1,
                            quantity_available: 1,
                            available: 1
                        };
                        add_row(data);
                        dndNo('promotion_details');
                        $('[name="products[' + key + '][supplier_part]"]').focus();
                    }
                    $(this).remove();
                    if ($('#divSearch tbody tr').length == 0) {
                        $('#divSearch').hide();
                    }
                });
            }
        });
        $('[name="q"]').val('').blur();
        return false;
    });

    if ($('#fileuploader').length) {
        var dir = $('#fileuploader').data('dir');
        $('#fileuploader').uploadFile({
            url: site_url + 'ajax/upload',
            fileName: 'myfile',
            formData: {
                dir: dir
            },
            uploadButtonClass: 'btn btn-border btn-alt btn-hover border-primary font-primary waves-effect',
            dragDropStr: '<span> Drag and drop files here</span>',
            allowedTypes: 'xlsx,xls',
            uploadErrorStr: 'The file is not valid!',
            onSubmit: function(files) {
                var startRow = parseInt($('#startRow').val());
                var endRow = parseInt($('#endRow').val());
                if (endRow < startRow && endRow > 0) {
                    showNoti('Start line position is greater than ending line!', 'Error', 'Err');
                    return false;
                }
            },
            onSuccess: function(files, data, xhr) {
                $('[type="submit"], [type="button"]').attr('disabled', true);

                showNoti('Reading file data. Please wait...', 'Upload file successful', 'War');
                showProcess(1);

                $('#fileName').val(data.split('/').pop());
                read_sheet(0);
            }
        });
    }

    if ($('#maximum_value_usd').length) {
        $('#maximum_value_usd').autoNumeric('init', {
            'mDec': 2,
        });
    }

    if ($('#maximum_value_vnd').length) {
        $('#maximum_value_vnd').autoNumeric('init', {
            'mDec': 0,
        });
    }

    $('body').on('submit', '#updateFrm', function() {
        if ($('#coupon_code').val().length != '' && $('#coupon_code').val().length != 8) {
            showErrOfField('coupon_code_is_not_valid', 'coupon_code');
            $('#btn-coupon-random').removeAttr('disabled="disabled"');
            return false;
        }
        if ($('.row-data').find('input[type="text"], input[type="number"], select').length) {
            showNoti('Some data have not been updated yet', 'Warning', 'War');
            return false;
        }
    }).on('change', '#type', function() {
        var val = $(this).val();
        if (val == '') {
            $('.fg-coupon-code, .fg-maximum-value, .fg-percent').addClass('hidden');
            $('.table-part').closest('div').addClass('hidden');
            $('button[data-target="#importModal"]').addClass('hidden');
            showNoti('Please chose promotion type', 'Warning', 'War');
        }
        if (val == 1 || val == 2) {
            $('.fg-coupon-code').addClass('hidden');
            $('.fg-coupon-code:not(.not-req) input').removeAttr('data-required').val('');
            $('.table-part').closest('div').removeClass('hidden');
            $('button[data-target="#importModal"]').removeClass('hidden');
            $('.fg-percent, .fg-maximum-value').removeClass('hidden');
            $('.fg-percent input').attr('data-required', 1);
        }
        if (val == 3 || val == 4) {
            $('.fg-percent').addClass('hidden');
            $('.fg-percent input').removeAttr('data-required').val('');
            $('.table-part').closest('div').removeClass('hidden');
            $('button[data-target="#importModal"]').removeClass('hidden');
            $('.fg-coupon-code, .fg-maximum-value').removeClass('hidden');
            $('.fg-coupon-code:not(.not-req) input').attr('data-required', 1);
            showNoti('After added new basic information, please update the product list', 'Information', 'blue');
        }
        if (val == 2 || val == 4) {
            $('.table-part').closest('div').addClass('hidden');
            $('button[data-target="#importModal"]').addClass('hidden');
        }
    }).on('click', '#btn-coupon-random', function() {
        $.ajax({
            url: site_url + $('#act').val() + '/create_coupon_code',
            type: 'POST',
            cache: false,
            success: function(string) {
                $('#coupon-code-demo .demo-coupon').empty().append('<p id="coupon-code">' + string + '</p>');
                $('#modal-coupon-code').modal('show');
            }
        })
    }).on('click', '#recreate-coupon', function() {
        $.ajax({
            url: site_url + $('#act').val() + '/create_coupon_code',
            type: 'POST',
            cache: false,
            success: function(string) {
                $('#coupon-code-demo .demo-coupon').empty().append('<p id="coupon-code">' + string + '</p>');
            }
        })
    }).on('click', '#btn-use-code', function() {
        $('#coupon_code').val($('#coupon-code').text().trim());
        $('#modal-coupon-code').modal('hide');
    }).on('keyup keydown', '#maximum_value_usd, #maximum_value_vnd', function() {
        var val = $(this).val().replace(/\s/g, '').replace(/,/g, '');
        var exchange_rate = $(this).attr('id').replace('maximum_value_', '');
        var usd_exchange_rate = parseFloat($('#usd_rates').text().replace(/\s/g, '').replace(/,/g, ''));
        if (exchange_rate == 'usd') {
            $('#maximum_value_vnd').autoNumeric('set', val * usd_exchange_rate);
        } else {
            $('#maximum_value_usd').autoNumeric('set', val / usd_exchange_rate);
        }
    }).on('change', '#sheet', function() {
        read_sheet($(this).val());
    }).on('change', '#headerRow', function() {
        var headerRow = parseInt($(this).val());
        $('#startRow').val(parseInt($(this).val()) + 1).trigger('chosen:updated').change();
        $('.field-excel').empty().append('<option value="">Chọn ...</option>');
        $('#sheetData tr').removeClass('excel-header');
        $('#sheetData #row' + headerRow).addClass('excel-header').find('td:not(.excel-left)').each(function() {
            $('.field-excel').append('<option value="' + $(this).data('col') + '" data-fieldname="' + $(this).text() + '">' + $(this).data('col') + ' - ' + $(this).text() + '</option>');
        });
        $('.field-excel').each(function() {
            var fieldname = $(this).data('fieldname');
            $(this).find('option[data-fieldname="' + fieldname + '"]').attr('selected', 'selected');
        });
        $('.field-excel').trigger('chosen:updated');
        check_exists();
    }).on('change', '#startRow', function() {
        $('#endRow option').attr('disabled', false);
        for (i = 0; i < parseInt($(this).val()) - 1; i++) {
            $('#endRow option:eq(' + i + ')').attr('disabled', true);
        }
        $('#endRow option:last-child').prop('selected', true);
        $('#endRow').trigger('chosen:updated');

        $('#sheetData tr').removeClass('excel-selected');
        for (i = parseInt($(this).val()); i <= parseInt($('#endRow').val()); i++) {
            $('#sheetData #row' + i).addClass('excel-selected');
        }
        check_exists();
    }).on('change', '#endRow', function() {
        $('#sheetData tr').removeClass('excel-selected');
        for (i = parseInt($('#startRow').val()); i <= parseInt($(this).val()); i++) {
            $('#sheetData #row' + i).addClass('excel-selected');
        }
        check_exists();
    }).on('click', '#btnExecute', function() {
        var startRow = parseInt($('#startRow').val());
        var endRow = parseInt($('#endRow').val());
        var dataRow = parseInt($('#sheetData tr').length) - 1;
        var rowSelect = parseInt($('#sheetData tr.excel-selected').length);
        index = startRow;
        num = (endRow > dataRow || isNaN(endRow) || endRow == 0) ? dataRow : endRow;
        $('#sheetData tr').removeClass('updated notfound');
        $('.progress-bar').css({
            width: '0%'
        });
        $('#person').text('0% (' + index + '/' + num + ')');
        if ($(this).attr('id') == 'updateRow') {
            setTimeout(function() {
                update_row();
            }, 500);
        } else {
            setTimeout(function() {
                import_row();
            }, 500);
        }
        return false;
    }).on('click', '#add-row', function() {
        var key = parseInt($('.table-part tbody .row-data:last td .no').text()) + 1;
        if ($('.table-part tbody .row-data').length == 0) {
            key = 1;
        }
        var data = {
            key: key,
            category: '',
            img: '../public/images/placeholder-image.png',
            image: '../public/images/placeholder-image.png',
            supplier_part: '',
            manufacturer_part_number: '',
            description: '',
            manufacturer: '',
            quantity: '',
            quantity_available: '',
            available: 0
        };
        add_row(data);
    }).on('click', '.tools-link.edit', function() {
        var toolsDiv = $(this).parent();
        toolsDiv.children('.delete').toggleClass('delete cancel').children('span').text('Cancel');
        $(this).toggleClass('edit apply').children('i').toggleClass('fa-edit fa-check').next('span').text('Apply');

        var tr = $(this).closest('tr');
        tr.find('.col-edit').each(function() {
            if ($(this).find('input').length == 0) {
                $(this).append('<input type="' + $(this).data('type') + '" class="form-control ' + $(this).find('span').attr('class') + '" data-field="' + $(this).find('span').attr('data-field') + '" value="' + ($(this).data('type') == 'number' ? $(this).find('span').text().replace(/\s/g, '').replace(/,/g, '') : $(this).find('span').text()) + '"><input type="hidden" value="' + $(this).find('span').text() + '">').children('span').remove();
            }
        })
    }).on('click', '.tools-link.apply', function() {
        var toolsDiv = $(this).parent();
        var apply = $(this);
        var tr = $(this).closest('tr');
        if (tr.find('.supplier_part').val() == '' || tr.find('.manufacturer_part_number').val() == '') {
            showNoti('Supplier Part & Manufacturer Part Number not empty', 'Warning', 'War');
            return false;
        } else {
            var supplier_part = tr.find('[data-field="supplier_part"]').val();
            var id = tr.attr('id');
            if (($('input[data-field="supplier_part"][value="' + supplier_part + '"]').length || $('tr[data-name="' + supplier_part + '"]').length) && id != $('tr[data-name="' + supplier_part + '"]').attr('id')) {
                $('tr[data-name="' + supplier_part + '"], tr:has(input[data-field="supplier_part"][value="' + supplier_part + '"])').addClass('exists').delay(7000).queue(function(next) {
                    $(this).removeClass("exists");
                    next();
                });
                showNoti('Supplier Part Number: ' + supplier_part.replace('&', '&amp;') + ' already exist', 'Warning', 'War');
            } else {
                var arr = {};
                if (id) {
                    var old_quantity = parseInt(tr.find('.col-quantity input[type="hidden"]').val().replace(/\s/g, '').replace(/,/g, ''));
                    var old_quantity_available = parseInt(tr.find('span[data-field="quantity_available"]').text().replace(/\s/g, '').replace(/,/g, ''));
                    var depreciation = old_quantity - old_quantity_available;
                    var quantity_available = parseInt(tr.find('input[data-field="quantity"]').val().replace(/\s/g, '').replace(/,/g, '')) - depreciation;
                    if (quantity_available <= 0) {
                        quantity_available = 0;
                    }
                    arr['quantity_available'] = quantity_available;
                }
                tr.find('input, select').each(function() {
                    if ($(this).data('field')) {
                        arr[$(this).data('field')] = $(this).val().trim();
                    }
                })
                
                arr['rowstart'] = $('#rowstart').length ? parseInt($('#rowstart').val()) : 0;
                $.ajax({
                    url: site_url + $('#act').val() + '/update_row',
                    type: 'POST',
                    data: arr,
                    success: function(resp) {
                        if (resp == 0) {
                            showNoti('Update fail', 'Error', 'Err');
                            return false;
                        } else {
                            var getData = $.parseJSON(resp);
                            tr.find('.col-edit').each(function() {
                                if ($(this).find('input').length) {
                                    if (!isNaN(tr.find('[data-field="quantity"]').val()) && tr.find('[data-field="quantity"]').val() > 0) {
                                        tr.find('.col-available span').removeClass('not-available').addClass('available');
                                    } else {
                                        tr.find('[data-field="quantity"]').val(0);
                                        tr.find('.col-available span').removeClass('available').addClass('not-available');
                                    }
                                    var type = $(this).data('type');
                                    tr.attr('id', getData['id']);
                                    tr.attr('data-name', getData['supplier_part']);
                                    tr.find('.no').addClass('no_' + getData['id']);
                                    tr.find('[data-field="sort_order"]').attr('id', 'sort_order_' + getData['id']);
                                    tr.find('[data-field="id"]').val(getData['id']);
                                    $(this).append('<span class="' + $(this).find('input').removeClass('form-control').attr('class') + '" data-field="' + $(this).find('input').data('field') + '" title="' + $(this).find('input').val().replace('&', '&amp;').trim() + '">' + (type == 'number' ? accounting.formatMoney($(this).find('input').val().replace('&', '&amp;').trim(), '', 0) : $(this).find('input').val().replace('&', '&amp;').trim()) + '</span>').children('input, select').remove();
                                }
                            })
                            tr.find('span[data-field="quantity_available"]').text(accounting.formatMoney(getData['quantity_available'], '', 0));
                            
                            dndNo('promotion_details');
                            showNoti('Update successful', 'Success', 'Ok');
                            toolsDiv.children('.cancel').toggleClass('cancel delete').children('span').text('Delete');
                            apply.toggleClass('apply edit').children('i').toggleClass('fa-check fa-edit').next('span').text('Edit');
                        }
                    }
                })
            }
        }
    }).on('click', '.tools-link.cancel', function() {
        var toolsDiv = $(this).parent();
        var tr = $(this).closest('tr');
        if (!tr.attr('id')) {
            tr.remove();
            updateNo('#promotion_details', 'promotion_details');
        } else {
            tr.find('.col-edit').each(function() {
                if ($(this).find('input').length) {
                    $(this).append('<span class="' + $(this).find('input').removeClass('form-control').attr('class') + '" data-field="' + $(this).find('input').data('field') + '" title="' + $(this).find('input[type="hidden"]').val().replace('&', '&amp;') + '">' + $(this).find('input[type="hidden"]').val().replace('&', '&amp;') + '</span>').children('input, select').remove();
                }
            })
            toolsDiv.children('.apply').toggleClass('apply edit').children('i').toggleClass('fa-check fa-edit').next('span').text('Edit');
            $(this).toggleClass('cancel delete').children('span').text('Delete');
        }
    }).on('click', '.tools-link.delete', function() {
        var tr = $(this).closest('tr');
        $.alerts.confirm('Are you sure you want to delete?', 'Confirm', function(r) {
            if (r) {
                var id = tr.find('[data-field="id"]').val();
                if (id != '') {
                    $.ajax({
                        url: site_url + 'ajax/del_restore_item',
                        type: 'POST',
                        data: {
                            table: 'promotion_details',
                            id: id,
                            mode: 'remove'
                        },
                        success: function (resp) {
                            if (resp == 1) {
                                showNoti('Delete successful', 'Success', 'Ok');
                                tr.remove();
                                updateNo('#promotion_details', 'promotion_details');
                            }
                        }
                    })
                } else {
                    tr.remove();
                    updateNo('#promotion_details', 'promotion_details');
                }
            }
        })
    }).on('keyup', '.supplier_part', function() {
        var val = $(this).val();
        if ($('tr[data-name="' + val + '"]').length) {
            $('tr[data-name="' + val + '"]').addClass('exists').delay(7000).queue(function(next) {
                $(this).removeClass("exists");
                next();
            });
            showNoti('Supplier Part Number: ' + val.replace('&', '&amp;'), 'Warning', 'War');
        }
    })
});
/* # Ready */

function read_sheet(sheet) {
    $.ajax({
        url: site_url + 'ajax/read_sheet',
        type: 'POST',
        data: {
            file: $('#fileName').val(),
            sheet: sheet
        },
        dataType: 'json',
        success: function(data) {
            if (data == '') {
                showNoti('Tệp tin không tồn tại!', 'Không thể đọc thông tin file', 'Err');
            } else {
                // var headerRow = parseInt($('#headerRow').val());
                var headerRow = 1;
                var html = '';

                $('#sheet').empty();
                for (i = 0; i < data.sheets.length; i++) {
                    $('#sheet').append('<option value="' + i + '"' + (i == sheet ? ' selected="selected"' : '') + '>' + data.sheets[i] + '</option>');
                }
                $('#sheet').trigger('chosen:updated');

                $('#headerRow, #startRow, #endRow').empty();
                $.each(data.sheetData, function(i, row) {
                    if (i == 1) {
                        html += '<tr>';
                        $.each(row, function(columnLetter, value) {
                            if (columnLetter == 'A') {
                                html += '<td class="excel-top"><div class="excel-angel"></div></td>';
                            }
                            html += '<td class="excel-top">' + columnLetter + '</td>';
                        });
                        html += '</tr>';
                    }
                    html += '<tr id="row' + i + '"' + (i == headerRow ? ' class="excel-header"' : '') + '>';
                    $.each(row, function(columnLetter, value) {
                        if (columnLetter == 'A') {
                            html += '<td class="excel-left">' + i + '</td>';
                        }
                        html += '<td data-col="' + columnLetter + '" nowrap="nowrap" class="excel-cell">' + (value != null ? value.toString().replace('&', '&amp;') : '') + '</td>';
                        if (i == headerRow) {
                            $('.field-excel').append('<option value="' + columnLetter + '" data-fieldname="' + value + '">' + columnLetter + ' - ' + value + '</option>');
                        }
                    });
                    html += '</tr>';
                    $('#headerRow, #startRow, #endRow').append('<option value="' + i + '">' + i + '</option>');
                });

                $('#startRow').val(2);
                for (i = 0; i < parseInt($('#startRow').val()) - 1; i++) {
                    $('#endRow option:eq(' + i + ')').attr('disabled', true);
                }
                $('#endRow option:last-child').prop('selected', true);

                $('.field-excel').each(function() {
                    var fieldname = $(this).data('fieldname');
                    $(this).find('option[data-fieldname="' + fieldname + '"]').attr('selected', 'selected');
                });
                $('#sheetData').html(html);
                $('#sheet, #startRow, #endRow, #headerRow, .field-excel').attr('disabled', false).trigger('chosen:updated');

                $('#sheetData tr').removeClass('excel-selected');
                for (i = parseInt($('#startRow').val()); i <= parseInt($('#endRow').val()); i++) {
                    $('#sheetData #row' + i).addClass('excel-selected');
                }

                $('[type="submit"], [type="button"]').attr('disabled', false);
                $('#person').text('0% (0/' + (parseInt($('#sheetData tr').length) - 1) + ')');
                check_exists();
                $('.amaran-wrapper').remove();
                hideLoading();
            }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            showNoti('Lỗi:' + xhr.status + ' ' + thrownError, 'Không thể đọc thông tin file', 'Err');
        }
    });
}

function check_exists() {
    var supplier_part_col = $('#supplier_part').val();
    $('#sheetData .excel-selected').removeClass('exists');
    $('#sheetData .excel-selected [data-col="' + supplier_part_col + '"]').each(function() {
        var supplier_part = $(this).text();
        if ($('tr.data-row[data-name="' + supplier_part + '"]').length) {
            $(this).parent().addClass('exists');
        }
    });
}

function import_row() {
    var tr = $('#sheetData tr:eq(' + index + ')');
    var supplier_part_col = $('#importModal #supplier_part').val();
    var supplier_part = tr.find('[data-col="' + supplier_part_col + '"]').text().trim();
    var manufacturer_part_number_col = $('#importModal #manufacturer_part_number').val();
    var manufacturer_part_number = tr.find('[data-col="' + manufacturer_part_number_col + '"]').text().trim();
    var manufacturer_col = $('#importModal #manufacturer').val();
    var manufacturer = tr.find('[data-col="' + manufacturer_col + '"]').text().trim();
    var description_col = $('#importModal #description').val();
    var description = tr.find('[data-col="' + description_col + '"]').text().trim();
    var quantity_col = $('#importModal #quantity').val();
    var quantity = parseInt(tr.find('[data-col="' + quantity_col + '"]').text().replace(/\s/g, '').replace(/,/g, ''));
    if ($('tr.row-data[data-name="' + supplier_part + '"]').length) {
        tr.addClass('exists');
    }
    if (!tr.hasClass('exists') && supplier_part) {
        $.ajax({
            url: site_url + $('#act').val() + '/import_row',
            type: 'POST',
            data: {
                parent: $('#id').val(),
                id: '',
                supplier_part: supplier_part,
                manufacturer_part_number: manufacturer_part_number,
                manufacturer: manufacturer,
                description: description,
                quantity: quantity,
            },
            success: function(string) {
                var getData = $.parseJSON(string);
                if (string != 0) {
                    var key = 0;
                    if ($('.table-part tbody .row-data').length) {
                        key = parseInt($('.table-part tbody .row-data:last td .no').text()) + 1;
                    }
                    var data = {
                        key: key,
                        id: getData.id,
                        name: getData.supplier_part,
                        img: getData.image,
                        image: getData.image,
                        category: getData.category,
                        supplier_part: getData.supplier_part,
                        manufacturer_part_number: getData.manufacturer_part_number,
                        description: getData.description,
                        manufacturer: getData.manufacturer,
                        quantity: getData.quantity,
                        quantity_available: getData.quantity_available,
                        available: getData.available
                    };
                    tr.addClass('updated');
                    add_row(data, true);
                    dndNo('promotion_details');
                } else {    
                    tr.addClass('notfound');
                }
                var percent = (index / num * 100).toFixed(0);
                $('.progress-bar').css({
                    width: percent + '%'
                });

                $('#person').text(percent + '% (' + index + '/' + num + ')');
                index++;

                if (index <= num) {
                    import_row();
                } else {
                    if ($('#sheetData .notfound').length) {
                        showNoti('There are ' + $('#sheetData .notfound').length + ' items not found', 'Warning', 'War');
                    } else {
                        $('[data-dismiss="modal"]').click();
                    }
                }
            }
        });
    } else {
        var percent = (index / num * 100).toFixed(0);
        $('.progress-bar').css({
            width: percent + '%'
        });

        $('#person').text(percent + '% (' + index + '/' + num + ')');
        index++;

        if (index <= num) {
            import_row();
        } else {
            $('[data-dismiss="modal"]').click();
        }
    }
}

function update_row() {
    var tr = $('#sheetData tr:eq(' + index + ')');
    var supplier_part_col = $('#importModal #supplier_part').val();
    var supplier_part = tr.find('[data-col="' + supplier_part_col + '"]').text().trim();
    if (!tr.hasClass('exists') && supplier_part && lot_code) {
        $.ajax({
            url: site_url +  $('#act').val() + '/check_part_update',
            type: 'POST',
            data: {
                supplier_part: supplier_part,
                id: $('#id').val()
            },
            success: function(string) {
                if (string != 0) {
                    var getData = $.parseJSON(string);
                    var manufacturer_part_number_col = $('#importModal #manufacturer_part_number').val();
                    var manufacturer_part_number = tr.find('[data-col="' + manufacturer_part_number_col + '"]').text().trim();
                    var manufacturer_col = $('#importModal #manufacturer').val();
                    var manufacturer = tr.find('[data-col="' + manufacturer_col + '"]').text().trim();
                    var description_col = $('#importModal #description').val();
                    var description = tr.find('[data-col="' + description_col + '"]').text().trim();
                    var quantity_col = $('#importModal #quantity').val();
                    var quantity = parseInt(tr.find('[data-col="' + quantity_col + '"]').text().replace(/\s/g, '').replace(/,/g, ''));
                    if (getData.parent && getData.parent > 0) {
                        var trUpdate = $('#itemList tr.row-data[data-lot_code="' + getData.lot_code + '"]');
                        if (quantity_col != '') trUpdate.find('.quantityItem').val(isNaN(quantity) ? 1 : quantity);
                        if (manufacturer_col != '') trUpdate.find('td.manufacturer input').val(manufacturer);
                        if (description_col != '') trUpdate.find('td.description input').val(description);
                        tr.addClass('update');
                        sum_item(trUpdate);
                    } else {
                        var key = 0;
                        if ($('.table-part tbody .row-data').length) {
                            key = parseInt($('.table-part tbody .row-data:last td .no').text()) + 1;
                        }
                        var data = {
                            key: key,
                            category: getData.category,
                            supplier_part: supplier_part,
                            manufacturer_part_number: manufacturer_part_number,
                            description: description,
                            manufacturer: manufacturer,
                            quantity: isNaN(quantity) ? 1 : quantity,
                            quantity_available: getData.quantity_available,
                            available: !isNaN(quantity) && quantity > 0 ? 1 : 0
                        };
                        tr.addClass('updated');
                        add_row(data);
                    }
                } else {
                    tr.addClass('notfound');
                }
                var percent = (index / num * 100).toFixed(0);
                $('.progress-bar').css({
                    width: percent + '%'
                });

                $('#person').text(percent + '% (' + index + '/' + num + ')');
                index++;

                if (index <= num) {
                    update_row();
                } else {
                    if ($('#sheetData .notfound').length) {
                        showNoti('Có ' + $('#sheetData .notfound').length + ' mục không tìm thấy danh mục', 'Cảnh báo!', 'War');
                        $('#updateRow').attr('disabled');
                    } else {
                        $('[data-dismiss="modal"]').click();
                    }
                }
            }
        })
    }
}

$('#importModal').on('hidden.bs.modal', function(e) {
    $('#sheet, #headerInfo, #footerInfo, #headerTitle, .field-excel, .divPreview .table.table-bordered').empty().trigger('chosen:updated');
    $('#headerInfo, #footerInfo, #headerTitle, .field-excel, .divPreview .table.table-bordered').attr('disabled', true);
    $('.unsetImport').show();
    $('.issetImport').hide();
    $.ajax({
        url: site_url + $('#act').val() + '/delete_file',
        type: 'POST',
        data: { file: $('#file').val() },
    });
});

function add_row(data, added = false) {
    var key = data.key;
    if ($('tr.empty-row').length) {
        $('tr.empty-row').remove();
    }
    var no = $('.table-part .row-data').length + 1;
    var string = '<tr class="row-data" data-table="promotion_details"' + (data.id ? ' id="' + data.id + '"' : '') + (data.name ? ' data-name="' + data.name + '"' : '') + '>';
    string += '<td class="center col-sel"><input type="checkbox" name="products[' + key + '][selItem]" class="cb-ele" value="1"></td>';
    string += '<td class="center col-tools">';
    string += '<div class="tools">';
    if (added) {
        string += '<a href="javascript:;" class="tools-link delete"><i class="fa fa-close"></i><span>Delete</span></a>';
        string += '<a href="javascript:;" class="tools-link edit"><i class="fa fa-edit"></i><span>Edit</span></a>';
    } else {
        string += '<a href="javascript:;" class="tools-link cancel"><i class="fa fa-close"></i><span>Cancel</span></a>';
        string += '<a href="javascript:;" class="tools-link apply"><i class="fa fa-check"></i><span>Apply</span></a>';
    }
    string += '</div></td>';
    string += '<td class="center col-no"><span class="no' + (data.id ? ' no_' + data.id : '') + '">' + no + '</span>';
    string += '<input type="hidden" name="products[' + key + '][sort_order]" data-field="sort_order" value="' + key + '">';
    string += '<input type="hidden" name="products[' + key + '][parent]" data-field="parent" value="' + $('#id').val() + '">';
    string += '<input type="hidden" name="products[' + key + '][category]" data-field="category" value="' +  data.category + '">';
    string += '<input type="hidden" name="products[' + key + '][id]" data-field="id" value="' + (data.id ? data.id : '') + '">';
    string += '</td>';
    string += '<td class="col-image"><img src="' +  data.img + '"><input type="hidden" name="products[' + key + '][image]" data-field="image" value="' +  data.image + '"></td>';
    string += '<td class="col-supplier_part col-edit" data-type="text">';
    if (added) {
        string += '<span class="text-overflow expand" data-field="supplier_part" title="' + data.supplier_part + '">' + data.supplier_part.replace('&', '&amp;') + '</span>';
    } else {
        string += '<input type="text" name="products[' + key + '][supplier_part]" class="form-control text-overflow supplier_part expand" data-field="supplier_part" value="' + data.supplier_part + '">';
    }
    string += '</td>';
    string += '<td class="col-manufacturer_part_number col-edit" data-type="text">';
    if (added) {
        string += '<span class="text-overflow expand" data-field="manufacturer_part_number" title="' + data.manufacturer_part_number + '">' + data.manufacturer_part_number.replace('&', '&amp;') + '</span>';
    } else {
        string += '<input type="text" name="products[' + key + '][manufacturer_part_number]" class="form-control text-overflow manufacturer_part_number expand" data-field="manufacturer_part_number" value="' +  data.manufacturer_part_number + '">';
    }
    string += '</td>';
    string += '<td class="col-description col-edit" data-type="text">';
    if (added) {
        string += '<span class="text-overflow expand" data-field="description" title="' + data.description + '">' + data.description.replace('&', '&amp;') + '</span>';
    } else {
        string += '<input type="text" name="products[' + key + '][description]" class="form-control text-overflow description expand" data-field="description" value="' +  data.description + '">';
    }
    string += '</td>';
    string += '<td class="col-manufacturer col-edit" data-type="text">';
    if (added) {
        string += '<span class="text-overflow expand" data-field="manufacturer" title="' + data.manufacturer + '">' + data.manufacturer.replace('&', '&amp;') + '</span>';
    } else {
        string += '<input type="text" name="products[' + key + '][manufacturer]" class="form-control text-overflow manufacturer expand" data-field="manufacturer" value="' +  data.manufacturer + '">';
    }
    string += '</td>';
    // string += '<td class="col-quantity col-edit" data-type="number">';
    // if (added) {
    //     string += '<span data-field="quantity" title="' + data.quantity + '">' + data.quantity + '</span>';
    // } else {
    //     string += '<input type="number" name="products[' + key + '][quantity]" class="form-control quantity" data-field="quantity" value="' +  data.quantity + '">';
    // }
    // string += '</td>';
    // string += '<td class="col-quantity_available"><span data-field="quantity_available" title="' + data.quantity_available + '">' + data.quantity_available + '</span></td>';
    // string += '<td class="col-available"><span class="bs-label label-rel ' + (data.available == 1 ? 'available' : 'not-available') + '"></span></td>';
    string += '</tr>';
    $('.table-part').append(string);
}

function updateDataSum() {

}

function check_exist_data() {
    var startRow = parseInt($('#headerInfo').val());
    var endRow = parseInt($('#footerInfo').val());
    var val = $('#selectMfrPartNumber').val();
    $('.divPreview .table.table-bordered tr').removeClass('excel-selected');
    $('.divPreview table tr').removeClass('exists');
    for (var j = startRow; j <= endRow; j++) {
        $('.divPreview .table.table-bordered tr:eq(' + j + ')').addClass('excel-selected');
        var part = $('.divPreview table tr:eq(' + j + ') td[data-label="' + val + '"]').text();
        if ($('input.mfr-part[value="' + part + '"]').length) {
            $('.divPreview table tr:eq(' + j + ')').addClass('exists');
            showNoti('Các dòng dữ liệu được tô đỏ đã có trong danh sách', 'Cảnh báo:', 'War');
        } else {
            $('.divPreview table tr:eq(' + j + ')').removeClass('exists');
        }
    }
}
