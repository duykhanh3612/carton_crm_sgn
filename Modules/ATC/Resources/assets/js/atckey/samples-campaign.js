$(document).ready(function ($) {
    if ($('#fileuploader').length) {
        var dir = $('#fileuploader').data('dir');
        $('#fileuploader').uploadFile({
            url: site_url + 'samples_campaign/upload',
            fileName: 'myfile',
            formData: {dir: dir},
            uploadButtonClass: 'btn btn-custom',
            dragDropStr: '<span> Drag and drop files here</span>',
            allowedTypes: 'xlsx,xls',
            uploadErrorStr: 'File không đúng danh mục!',
            onLoad: function () {
                $('#import_sample').addClass('disabled');
            },
            afterUploadAll: function () {
                hideLoading();
            },
            onSubmit: function (files) {
                showLoading();
                $('.nof-status').html('<strong style="color: red;">Đang tải file lên, vui lòng chờ đợi...</strong>');
            },
            onSuccess: function (files, data, xhr) {
                $('.unsetImport').hide();
                $('.issetImport').show();
                $('.ajax-file-upload-statusbar').fadeOut();
                showNoti('Tệp tin: ' + data, 'Đang đọc dữ liệu', 'War');
                showProcess(1);
                $('#file').val(data);
                $.ajax({
                    url: site_url + 'samples_campaign/imports',
                    type: 'POST',
                    cache: false,
                    data: {
                        file: data,
                    },
                    success: function(string) {
                        console.log(string);
                        showNoti('Tệp tin: ' + data, 'Đọc dữ liệu hoàn tất', 'Ok');
                        var getData = $.parseJSON(string);
                        var options = '<option value="-1"></option>';
                        $('.field-excel').append('<option value="-1">Select an Option</option>');
                        for (var i = 0; i < getData.allSheetNames.length; i++) {
                            options += '<option value="' + i + '">' + getData.allSheetNames[i] + '</option>';
                        }
                        $('#sheet').html(options).trigger('chosen:updated');
                    }
                });





                $('#import_sample').removeClass('disabled');
                $('#file_old').attr('value', data);
                $('#fileName').val(data.split('/').pop());
                //read_sheet($('#sheet').val());
                setTimeout(function () {
                    $('.nof-status').html('<strong style="color: blue;">Đã dữ liệu lên thành công. Vui lòng chọn nội dung cần import.</strong>');
                }, 1500);
            }
        });
    }
    $('body').on('change', '#sheet', function() {
        $.ajax({
            url: site_url + $('#act').val() + '/access_file',
            type: 'POST',
            cache: false,
            data: {
                file: $('#file').val(),
                sheet: $('#sheet').val(),
            },
            success: function(string) {
                var activeSheet = $('#sheet').val();
                $('.divPreview .table.table-bordered').html(string);
                $('#headerTitle, #headerInfo, #footerInfo, #importModal .border-primary, .field-excel').attr('disabled', false).trigger('chosen:updated');
                var numRow = $('.divPreview .table.table-bordered tr').length;
                $('#headerInfo, #footerInfo').empty();
                for (i = 1; i < numRow; i++) {
                    $('#headerTitle, #headerInfo, #footerInfo').append('<option value="' + i + '">' + i + '</option>').trigger('chosen:updated');
                    $('.divPreview .table.table-bordered tr:eq(' + i + ')').addClass('excel-selected');
                }
                $('#footerInfo option:last-child').prop('selected', true).trigger('chosen:updated');
                $('.divPreview table tr.excel-header').find('td').each(function() {
                    var label = $(this).data('label');
                    var text = $(this).text().replace(/\s/g, '');
                    var text_sel = text.replace(/\s/g, '');
                    var string = 'Column ' + label + ' - ' + text;
                    if (label) {
                        $('.field-excel').append('<option value="' + label + '">' + string + '</option>').trigger('chosen:updated');
                    }
                    $('select[data-select="' + text_sel + '"]').val(label).trigger('chosen:updated');
                });
                check_exist_data();
            }
        });
    });
    function read_sheet(sheet) {
        $.ajax({
            url: site_url + 'samples_campaign/read_sheet',
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
    $('#importExcel').click(function () {
        jQuery('#sheetData tr td').empty();
        $('#import_sample').addClass('disabled');
        $('#myModal').modal('show');
    });
    var pos = {};
    $('#import_sample').click(function () {
        pos.start = $('#headerInfo').val();
        pos.end = $('#footerInfo').val();
        pos.fiel = $('#file').val();
        pos.part = $('#part').val();
        pos.mpart = $('#mpart').val();
        pos.desc = $('#desc').val();
        pos.manuface = $('#manuface').val();
        pos.comment = $('#comment').val();
        pos.min = $('#min').val();
        pos.max = $('#max').val();
        pos.exdate = $('#exdate').val();
        pos.id = idPage || 0;
        var s = parseInt(pos.start);
        var arr = [];
        for (s; s <= parseInt(pos.end); s++) {
            var key = parseInt($('#itemList table tbody .highlightNoClick:last td input.itemKey').val()) + 1;
            if ($('#itemList table tbody .highlightNoClick').length == 0) key = 1;
            var tr = $('#row' + s);
            if(tr.length){
                var td = $('#row' + s).find('td');
                var val = {'idCampaign': pos.id, 'SupplierPart': '', 'MfrPart': '', 'Description': '', 'Manufacturer': '', 'LeadtimeComments': '', 'minQuantity': '', 'maxQuantity': '', 'Image': '','date_expired':''};
                $.each(td, function () {
                    var cols = $(this).data('label');
                    if (cols == pos.part) val.SupplierPart = $(this).text() || "";
                    if (cols == pos.mpart) val.MfrPart = $(this).text() || "";
                    if (cols == pos.desc) val.Description = $(this).text() || "";
                    if (cols == pos.manuface) val.Manufacturer = $(this).text() || "";
                    if (cols == pos.comment) val.LeadtimeComments = $(this).text() || "";
                    if (cols == pos.min) val.minQuantity = $(this).text() || "";
                    if (cols == pos.max) val.maxQuantity = $(this).text() || "";
                    if (cols == pos.exdate) val.date_expired = $(this).text() || "";
                });
                arr.push(val);
            }
        }
        if(arr.length >0){
            $.ajax({
                url: site_url + 'samples_campaign/import_details',
                type: 'POST',
                cache: false,
                data: {details:JSON.stringify(arr)},
                success: function (string) {
                    if(string){
                        showNoti('Import thành công', 'Samples Campaign', 'Ok');
                    }else{
                        showNoti('Import thất bại', 'Samples Campaign', 'Err');
                    }
                    window.location.replace(site_url + "samples_campaign/update/" + idPage);
                }
            });
        }

        $('#importModal').modal('hide');
    });
});

