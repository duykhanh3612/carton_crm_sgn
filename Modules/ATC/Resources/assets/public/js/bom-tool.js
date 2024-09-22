// Xóa file upload khi refresh, close, or navigation
$(window).unload(function () {
    $.ajax({
        type: 'POST',
        url: site_url + 'product_profile/delete_file',
        async: false,
        data: {name: $('#file_old').val()}
    });
});

$(document).ready(function () {
    //var mycheck = false;

    $('#starRow').on('change', function () {
        //$('#endRow option').attr('disabled', false);
        for (i = 0; i < parseInt($(this).val()) - 1; i++) {
            // $('#endRow option:eq(' + i + ')').attr('disabled', true);
        }
        $('#endRow option:last-child').prop('selected', true);

        $('#sheetData tr').removeClass('excel-selected');
        for (i = parseInt($(this).val()); i <= parseInt($('#endRow').val()); i++) {
            $('#sheetData #row' + i).addClass('excel-selected');
        }
    });

    $('#endRow').on('change', function () {
        $('#sheetData tr').removeClass('excel-selected');
        for (i = parseInt($('#starRow').val()); i <= parseInt($(this).val()); i++) {
            $('#sheetData #row' + i).addClass('excel-selected');
        }
    });

    $('#headerRow').on('change', function () {
        var headerRow = parseInt($(this).val());
        $('.field-update').empty().append('<option value="-1">Chọn ...</option>');
        $('#sheetData tr').removeClass('excel-header');
        $('#sheetData #row' + headerRow).addClass('excel-header').find('td:not(.excel-left)').each(function () {
            $('.field-update').append('<option value="' + $(this).data('col') + '" data-fieldname="' + $(this).text() + '">' + $(this).data('col') + ' - ' + $(this).text() + '</option>');
        });
        $('.field-update').each(function () {
            var fieldname = $(this).data('fieldname');
            $(this).find('option[data-fieldname="' + fieldname + '"]').attr('selected', 'selected');
        });
    });

    $('#sheet').on('change', function () {
        read_sheet($(this).val());
    });

    $('.card_effect .field-update').on('change', function () {
        var selValue = $(this).val();
        var sel = $(this).data('fieldkey');
        $('.card_effect .field-update').not($(this)).each(function () {
            if ($(this).find('option[value="' + selValue + '"]').is(':selected') && selValue != -1) {
                alert('Exists bom');
                $('.field-update[data-fieldkey="' + sel + '"]').find('option').removeAttr('selected');
                $('.field-update[data-fieldkey="' + sel + '"]').val(-1);
            }
        });
    });

    if ($('#fileuploader').length) {
        var dir = $('#fileuploader').data('dir');
        $('#fileuploader').uploadFile({
            url: site_url + 'product_profile/upload',
            fileName: 'myfile',
            formData: {
                dir: dir
            },
            uploadButtonClass: 'btn btn-custom',
            dragDropStr: '<span> Drag and drop files here</span>',
            allowedTypes: 'xlsx,xls',
            uploadErrorStr: 'File không đúng danh mục!',
            onSubmit: function (files) {
                showLoading();
                var starRow = parseInt($('#starRow').val());
                var endRow = parseInt($('#endRow').val());
                if (endRow < starRow && endRow > 0) {
                    // showNoti('Vị trí dòng bắt đầu lớn hơn dòng kết thúc!', 'Lỗi nhập liệu', 'Err');
                    return false;
                }
            },
            onSuccess: function (files, data, xhr) {
                // $('[type="submit"], [type="button"]').attr('disabled', true);

                // showNoti('Đang đọc dữ liệu file. Vui lòng đợi!', 'Upload file thành công', 'War');
                // showProcess(1);
                $('#file_old').attr('value', data);
                $('#fileName').val(data.split('/').pop());

                read_sheet($('#sheet').val());
            }
        });
    }

    $('#continue').click(function () {
        //if (mycheck) return;

        if ($('[data-fieldkey="imap_supplier_part_number"]').val() == -1 && $('[data-fieldkey="imap_mfr_part_number"]').val() == -1) {
            alert('Bắt buộc hãy chọn dữ liệu cho 1 trong 2 trường Supplier Part# & Mfr Part#');
            //$('#modal-notify').modal('show');
            //$('#modal-notify .notify-content').html('Bắt buộc hãy chọn dữ liệu cho 1 trong 2 trường Supplier Part# và Mfr Part# ');
            //$('#modal-notify .text-center').empty().append('<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>');
            return false;
        }
        $.ajax({
            url: 'product_profile/check_file_name',
            type: 'POST',
            cache: false,
            data: {file_name: $('#BOMName').val(), code: $('#product-no').val()},
            success: function (string) {
                var key = /^[0-9a-zA-Z\ .-]*$/;
                if (!key.test($('#BOMName').val())) {
                    //funvalidation('txt_bomname', '.txt_bomname', 2000, 'BOM Name không hợp lệ');
                    showNoti('BOM Name không hợp lệ', 'Warning', 'War');
                    return false;
                }
                if (string > 0) {
                    //funvalidation('txt_bomname', '.txt_bomname', 2000, 'BOM Name đã tồn tại');
                    showNoti('BOM Name đã tồn tại', 'Warning', 'War');
                    return false;
                }
                // flip();
                // $('#process').removeClass('hide');
                // $('#goback').removeClass('hide');
                // $('#continue').hide();
                $('#sheetData tr').removeClass('updated');
                process_item();
                showLoading();
                return false;
            }
        });
    });

    $('.delBOM').click(function () {
        var id = $(this).attr('data-id');
        $.alerts.confirm('Are you sure?, Confirm remove this.<br/>', 'Confirm delete', function (r) {
            if (r == true) {
                $.ajax({
                    type: 'POST',
                    url: site_url + 'product_profile/delete_bom',
                    async: false,
                    data: {id: id},
                    success: function (data){
                        $('#bomlist-tab'+id).remove();
                        $('#title-bom'+id).remove();
                        /*$('#BomlistUpload-tab').addClass('in');
                        $('#BomlistUpload-tab').show();*/
                    },
                    error:function () {

                    }
                });
            }
        });
    });

    function read_sheet(sheet) {
        $.ajax({
            url: site_url + 'product_profile/read_sheet',
            type: 'POST',
            data: {
                file: $('#fileName').val(),
                sheet: sheet
            },
            dataType: 'json',
            success: function (data) {
                if (data == '') {
                    alert('Tệp tin không tồn tại!')
                } else {
                    var headerRow = parseInt($('#headerRow').val());
                    var html = '';
                    var date = new Date();
                    var today = date.getDate() + '.' + (date.getMonth() + 1) + '.' + date.getFullYear();
                    $('#BOMName').attr('value', data.name.substr(0, data.name.lastIndexOf('.')) + ' - ' + today);
                    $('#sheet').empty();
                    for (i = 0; i < data.sheets.length; i++) {
                        $('#sheet').append('<option value="' + i + '"' + (i == sheet ? ' selected="selected"' : '') + '>' + data.sheets[i] + '</option>');
                    }

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
                        $('#headerRow, #starRow, #endRow').trigger('chosen:updated');
                        for (c = data.col_in + 1; c <= $('.field-update:eq(1) option').length; c++) {
                            $('.card_front .field-update').each(function () {
                                //   $(this).find('option:eq(' + c + ')').attr('disabled', true);
                                $(this).find('option:eq(' + c + ')').addClass('hide');
                                $(this).trigger('chosen:updated');
                            });
                        }
                        for (c = 1; c <= data.col_in; c++) {
                            $('.card_back .field-update').each(function () {
                                //  $(this).find('option:eq(' + c + ')').attr('disabled', true);
                                $(this).find('option:eq(' + c + ')').addClass('hide');
                            });
                        }
                    });

                    $('#starRow').val(2);
                    for (i = 0; i < parseInt($('#starRow').val()) - 1; i++) {
                        // $('#endRow option:eq(' + i + ')').attr('disabled', true);
                    }
                    $('#endRow option:last-child').prop('selected', true);

                    $('.field-update').each(function () {
                        var fieldname = $(this).data('fieldname');
                        $(this).find('option[data-fieldname="' + fieldname + '"]').attr('selected', 'selected');
                    });
                    $('#sheetData').html(html);

                    //  $('#BOMName, #sheet, #starRow, #endRow, #headerRow, .field-update').attr('disabled', false);

                    $('#sheetData tr').removeClass('excel-selected');
                    for (i = parseInt($('#starRow').val()); i <= parseInt($('#endRow').val()); i++) {
                        $('#sheetData #row' + i).addClass('excel-selected');
                    }

                    // $('[type="submit"], [type="button"]').attr('disabled', false);
                    // $('.amaran-wrapper').remove();
                    hideLoading();

                    $('#sheet_chosen, #headerRow_chosen, #starRow_chosen, #endRow_chosen').remove();
                    $('#BOMName, #sheet, #starRow, #endRow, #headerRow').show();
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                // showNoti('Lỗi:' + xhr.status + ' ' + thrownError, 'Không thể đọc thông tin file', 'Err');
            }
        });
    }

    function process_item() {
        var icols = [];
        var ikeys = [];
        var ocols = [];
        var okeys = [];
        var values = [];

        $('.card_front .field-update').each(function () {
            var col = $(this).val();
            var field = $(this).data('fieldkey');
            if (col) {
                icols.push(col);
                ikeys.push(field);
                var data = [];
                $('.excel-selected [data-col="' + col + '"]').each(function () {
                    data.push($(this).text());
                });
                values.push(data);
            }
        });

        $('.card_back .field-update').each(function () {
            var col = $(this).val();
            var field = $(this).data('fieldkey');
            if (col) {
                ocols.push(col);
                okeys.push(field);
            }
        });

        $.ajax({
            url: site_url + 'product_profile/process_item',
            type: 'POST',
            data: {
                file_name: $('#BOMName').val(),
                icols: icols,
                ikeys: ikeys,
                ocols: ocols,
                okeys: okeys,
                values: values,
                id: $('#id').val(),
                code: $('#product-no').val()
            },
            success: function (string) {
                var getData = $.parseJSON(string);
                hideLoading();

                //mycheck = true;

                //$('#continue span').html('VIEW');
                //$('#continue i').removeClass('icon-check');
                //$('#continue i').addClass('icon-bullseye');
                //$('#continue').removeClass('btn-success');
                //$('#continue').addClass('btn-danger');
                //$('#continue').attr("id", "viewfile");

                $('#viewfile').removeClass('invisible');
                $('#export_bom').removeClass('invisible');

                $('#viewfile').on('click', function () {
                    window.open(site_url + "product_profile/order_bom/" + getData.id, "mywindow", "status=1");
                });

                $('#export_bom span').replaceWith(function () {
                    return $('<a style="color:#fff;" href="'+site_url + "product_profile/export/" + getData.id+'">export</a>');
                });

                $('#viewfile').parent().append('<div class="bg-success text-center">Upload file success.</div>')

                //window.location.href = 'order-boms/' + getData.id + '-' + getData.keyword + '.html';
            }
        });
    }
});