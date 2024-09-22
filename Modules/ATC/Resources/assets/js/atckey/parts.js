$(document).ready(function() {
    $('#sheetPreview').css({
        width: $('.progress').width() + 'px'
    });

    $('#starRow').on('change', function () {
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
    });

    $('#endRow').on('change', function () {
        $('#sheetData tr').removeClass('excel-selected');
        for (i = parseInt($('#starRow').val()); i <= parseInt($(this).val()); i++) {
            $('#sheetData #row' + i).addClass('excel-selected');
        }
        check_exists();
    });

    $('#headerRow').on('change', function () {
        var headerRow = parseInt($(this).val());
        $('.field-update').empty().append('<option value="">Chọn ...</option>');
        $('#sheetData tr').removeClass('excel-header');
        $('#sheetData #row' + headerRow).addClass('excel-header').find('td:not(.excel-left)').each(function () {
            $('.field-update').append('<option value="' + $(this).data('col') + '" data-fieldname="' + $(this).text() + '">' + $(this).data('col') + ' - ' + $(this).text() + '</option>');
        });
        $('.field-update').each(function () {
            var fieldname = $(this).data('fieldname');
            $(this).find('option[data-fieldname="' + fieldname + '"]').attr('selected', 'selected');
        });
        $('.field-update').trigger('chosen:updated');
        check_exists();
    });

    $('#supplier_part').change(function() {
        check_exists();
    });

    $('#sheet').on('change', function () {
        read_sheet($(this).val());
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
            uploadErrorStr: 'File không đúng danh mục!',
            onSubmit: function (files) {
                var starRow = parseInt($('#starRow').val());
                var endRow = parseInt($('#endRow').val());
                if (endRow < starRow && endRow > 0) {
                    showNoti('Vị trí dòng bắt đầu lớn hơn dòng kết thúc!', 'Lỗi nhập liệu', 'Err');
                    return false;
                }
            },
            onSuccess: function (files, data, xhr) {
                $('[type="submit"], [type="button"]').attr('disabled', true);

                showNoti('Đang đọc dữ liệu file. Vui lòng đợi!', 'Upload file thành công', 'War');
                showProcess(1);

                $('#fileName').val(data.split('/').pop());

                read_sheet($('#sheet').val());
            }
        });
    }

    $('#updateFrm').submit(function () {
        var starRow = parseInt($('#starRow').val());
        var endRow = parseInt($('#endRow').val());
        var dataRow = parseInt($('#sheetData tr').length) - 1;
        index = starRow;
        num = (endRow > dataRow || isNaN(endRow) || endRow == 0) ? dataRow : endRow;
        $('#sheetData tr').removeClass('updated');
        $('.progress-bar').css({
            width: '0%'
        });
        $('#person').text('0% (' + index + '/' + num + ')');
        setTimeout(function () {
            process_item();
        }, 1000);
        return false;
    });
});

function read_sheet(sheet) {
    $.ajax({
        url: site_url + 'ajax/read_sheet',
        type: 'POST',
        data: {
            file: $('#fileName').val(),
            sheet: sheet
        },
        dataType: 'json',
        success: function (data) {
            if (data == '') {
                showNoti('Tệp tin không tồn tại!', 'Không thể đọc thông tin file', 'Err');
            } else {
                var headerRow = parseInt($('#headerRow').val());
                var html = '';

                $('#sheet').empty();
                for (i = 0; i < data.sheets.length; i++) {
                    $('#sheet').append('<option value="' + i + '"' + (i == sheet ? ' selected="selected"' : '') + '>' + data.sheets[i] + '</option>');
                }
                $('#sheet').trigger('chosen:updated');

                $('#headerRow, #starRow, #endRow').empty();
                $.each(data.sheetData, function (i, row) {
                    if (i == 1) {
                        html += '<tr>';
                        $.each(row, function (columnLetter, value) {
                            if (columnLetter == 'A') {
                                html += '<td class="excel-top"><div class="excel-angel"></div></td>';
                            }
                            html += '<td class="excel-top">' + columnLetter + '</td>';
                        });
                        html += '</tr>';
                    }
                    html += '<tr id="row' + i + '"' + (i == headerRow ? ' class="excel-header"' : '') + '>';
                    $.each(row, function (columnLetter, value) {
                        if (columnLetter == 'A') {
                            html += '<td class="excel-left">' + i + '</td>';
                        }
                        html += '<td data-col="' + columnLetter + '" nowrap="nowrap" class="excel-cell">' + (value != null ? value : '') + '</td>';
                        if (i == headerRow) {
                            $('.field-update').append('<option value="' + columnLetter + '" data-fieldname="' + value + '">' + columnLetter + ' - ' + value + '</option>');
                        }
                    });
                    html += '</tr>';
                    $('#headerRow, #starRow, #endRow').append('<option value="' + i + '">' + i + '</option>');
                });

                $('#starRow').val(2);
                for (i = 0; i < parseInt($('#starRow').val()) - 1; i++) {
                    $('#endRow option:eq(' + i + ')').attr('disabled', true);
                }
                $('#endRow option:last-child').prop('selected', true);

                $('.field-update').each(function () {
                    var fieldname = $(this).data('fieldname');
                    $(this).find('option[data-fieldname="' + fieldname + '"]').attr('selected', 'selected');
                });
                $('#sheetData').html(html);
                $('#sheet, #starRow, #endRow, #headerRow, .field-update').attr('disabled', false).trigger('chosen:updated');

                $('#sheetData tr').removeClass('excel-selected');
                for (i = parseInt($('#starRow').val()); i <= parseInt($('#endRow').val()); i++) {
                    $('#sheetData #row' + i).addClass('excel-selected');
                }

                $('[type="submit"], [type="button"]').attr('disabled', false);
                $('#person').text('0% (0/' + (parseInt($('#sheetData tr').length) - 1) + ')');
                check_exists();
                $('.amaran-wrapper').remove();
                hideLoading();
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            showNoti('Lỗi:' + xhr.status + ' ' + thrownError, 'Không thể đọc thông tin file', 'Err');
        }
    });
}

function check_exists() {
    var supplier_part_col = $('#supplier_part').val();
    $('#sheetData .excel-selected').removeClass('exists');
    $('#sheetData .excel-selected [data-col="' + supplier_part_col + '"]').each(function () {
        var supplier_part = $(this).text();
        if ($('#itemList tr[data-supplier_part="' + supplier_part + '"]').length) {
            $(this).parent().addClass('exists');
        }
    });
}

function process_item() {
    var keys = [];
    var values = [];
    var tr = $('#sheetData tr:eq(' + index + ')');

    $('.field-update').each(function () {
        var col = $(this).val();
        var field = $(this).data('fieldkey');
        if (col) {
            keys.push(field);
            values.push(tr.find('[data-col="' + col + '"]').text());
        }
    });

    $.ajax({
        url: site_url + 'parts/process_item',
        type: 'POST',
        data: {
            category: current_cat,
            keys: keys,
            values: values
        },
        success: function () {
            var percent = (index / num * 100).toFixed(0);
            $('.progress-bar').css({
                width: percent + '%'
            });

            $('#person').text(percent + '% (' + index + '/' + num + ')');
            tr.addClass('updated');
            index++;

            if (index <= num) {
                process_item();
            } else {
                $('[type="submit"], [type="button"]').removeAttr('disabled', true);
                $('[type="text"]').removeAttr('readonly');

                if ($('#initFilter').is(':checked')) {
                    showNoti('Cập nhật bộ lọc danh mục. Vui lòng đợi!', 'Nhập dữ liệu sản phẩm', 'War');
                    showProcess(1);
                    $.ajax({
                        url: site_url + 'parts/fields/' + current_cat,
                        type: 'POST',
                        cache: false,
                        success: function () {
                            $('.amaran-wrapper').remove();
                            showNoti('Cập nhật bộ lọc thành công!', 'Nhập dữ liệu sản phẩm', 'Ok');
                            hideLoading();
                        }
                    });
                }
            }
        }
    });
}