$(document).ready(function () {
    makeDragOrder("report_theme", "", "", "SortOrder", "ASC");
    change_required_input();
    rd_change();
    $('.upload-required').on('change', function () {
        change_required_input();
    })

    $('body').on('click', '#btn-add-report-theme', function () {
        var modal = $('#modal-add-report-theme');
        modal.modal('show');
    }).on('click', '#modal-add-report-theme .btn-primary', function () {
        var modal = $('#modal-add-report-theme');
        var reportName = $('#ReportName');
        var lastTR = $('#mainTable-report_theme tbody tr').last();
        var sortOrder = parseInt(lastTR.find('.stt').text());
        $.ajax({
            url: site_url + 'report/process_add_report',
            type: 'POST',
            cache: false,
            data: {
                Name: reportName.val(),
                SortOrder: sortOrder
            },
            success: function (string) {
                if (string > 0) {
                    showNoti('Add report theme success!', 'Success', 'Ok');
                    modal.modal('hide');
                    html = '<tr id="' + string + '">';
                    html += '   <td class="center"><span class="stt STT_' + (sortOrder + 1) + '">' + (sortOrder + 1) + '</span><input type="hidden" value="' + (sortOrder + 1) + '" id="Old_' + (sortOrder + 1) + '"></td>';
                    html += '   <td><input type="text" class="form-control report-theme-name input-retype" value="' + reportName.val() + '"><input type="hidden" class="report-theme-name-hd" value="' + reportName.val() + '"></td>';
                    html += '   <td class="text-center">';
                    html += '       <a href="javascript:;" class="report-theme-tools edit"><i class="fa fa-pencil"></i></a>';
                    html += '       <a href="javascript:;" class="report-theme-tools remove"><i class="fa fa-trash"></i></a>';
                    html += '   </td>';
                    html += '</tr>';
                    lastTR.after(html);
                    makeDragOrder("report_theme", "", "", "SortOrder", "ASC");
                    reportName.val('');
                } else {
                    showNoti('Fail', 'Error', 'Err');
                }
            }
        })
    }).on('click', '.report-theme-tools.edit', function() {
        var parent = $(this).closest('tr');
        $('#mainTable-report_theme tbody tr').not(parent).addClass('disabled');
        parent.find('.report-theme-name').removeClass('input-retype');
        $(this).toggleClass('edit check').children('i').toggleClass('fa-pencil fa-check');
        $(this).next().toggleClass('remove cancel').children('i').toggleClass('fa-trash fa-remove');
    }).on('click', '.report-theme-tools.remove', function() {
        var parent = $(this).closest('tr');
        var id = parent.attr('id');
        $.alerts.confirm('Will you deleted this report theme?', 'Confirm delete', function(e) {
            if (e) {
                $.ajax({
                    url: site_url + 'report/delete_add_report',
                    type: 'POST',
                    cache: false,
                    data: {
                        id: id
                    },
                    success: function(string) {
                        if (string == 1) {
                            showNoti('Delete report theme success!', 'Success', 'Ok');
                            parent.remove();
                            for (var i = 0; i < $('#mainTable-report_theme tbody tr').length; i++) {
                                $('#mainTable-report_theme tbody tr:eq(' + i + ') td:eq(0) .stt').text(i + 1);
                            }
                        } else {
                            showNoti('Fail', 'Error', 'Err');
                        }
        
                    }
                })
            }
        });
        return false;
    }).on('click', '.report-theme-tools.cancel', function() {
        var parent = $(this).closest('tr');
        $('#mainTable-report_theme tbody tr').removeClass('disabled');
        parent.find('.report-theme-name').val(parent.find('.report-theme-name-hd').val()).addClass('input-retype');
        $(this).toggleClass('cancel remove').children('i').toggleClass('fa-remove fa-trash');
        $(this).prev().toggleClass('check edit').children('i').toggleClass('fa-check fa-pencil');
    }).on('click', '.report-theme-tools.check', function() {
        var _that = $(this);
        var parent = $(this).closest('tr');
        var id = parent.attr('id');
        var reportName = parent.find('.report-theme-name');
        var sortOrder = parent.index();
        $.ajax({
            url: site_url + 'report/process_add_report',
            type: 'POST',
            cache: false,
            data: {
                Name: reportName.val(),
                SortOrder: sortOrder,
                id: id
            },
            success: function(string) {
                if (string > 0) {
                    showNoti('Add report theme success!', 'Success', 'Ok');
                    $('#mainTable-report_theme tbody tr').removeClass('disabled');
                    parent.find('.report-theme-name').addClass('input-retype');
                    parent.find('.report-theme-name-hd').val(parent.find('.report-theme-name').val());
                    _that.toggleClass('check edit').children('i').toggleClass('fa-check fa-pencil');
                    _that.next().toggleClass('cancel remove').children('i').toggleClass('fa-remove fa-trash');
                } else {
                    showNoti('Fail', 'Error', 'Err');
                }

            }
        })
    }).on('change', '.reportingdate', function () {
        // var arrRepeats = [];
        // var arr = [];
        // $('[name*="Repeats"]').serializeArray().forEach(function (e) {
        //     arrRepeats.push(e['value']);
        // });
        // $('.reportingdate').each(function () {
        //     arr.push($(this).val());
        // });
        // arr = mie_array(arr);
        // $('.content-repeats .checkbox input[type="checkbox"]').prop('checked', false);
        // arr.forEach(function (e) {
        //     if (arrRepeats.includes(e)) {
        //         $('.content-repeats input[type="hidden"][value="' + e + '"]').next().prop('checked', true);
        //     }
        // });
    }).on('change', '#Alarm1, #Alarm2', function () {
        var alarm1 = $('#Alarm1');
        var alarm2 = $('#Alarm2');
        if (parseInt(alarm2.val()) >= parseInt(alarm1.val())) {
            showNoti('Alarm 2 must less more Alarm 1', 'Warning', 'War');
            alarm2.val(0).trigger('chosen:updated');
        }
    }).on('change', 'input[type="number"]', function() {
        var min = parseFloat($(this).attr('min'));
        var max = parseFloat($(this).attr('max'));
        if ($(this).val() < min || $(this).val() > max) {
            showNoti('Invalid value', 'Warning', 'War');
            $(this).val(min);
        }
    })
});
// # Ready

function change_required_input() {
    var flag = false;
    $('.upload-required').each(function () {
        if ($(this).val() == '') {
            flag = true;
        }
    })
    if (flag == false) {
        if ($('#attachmentUploader').length && !$('.btn-att-report').length) {
            $('#attachmentUploader').find('.fa-plus').removeClass('hidden');
            var dir = $('#attachmentUploader').data('dir');
            // var staff = '/' + change_alias($('#AssignedTo').find('option[value="' + $('#AssignedTo').val() + '"]').text()).replace(/ + | /g, '-');
            // var reportTheme = '/' + change_alias($('#ReportTheme').val()).replace(/ + | /g, '-') + '/';
            var staff = '/' + $('#AssignedTo').val();
            var reportTheme = '/' + $('#ReportTheme').val() + '/';
            var id = $('.id-folder').val();
            $('#attachmentUploader').uploadFile({
                url: site_url + 'ajax/ajax_attachment',
                fileName: change_alias('myfile'),
                formData: {
                    'dir': dir + staff + reportTheme + id,
                },
                uploadButtonClass: 'waves-effect btn-att-report',
                allowedTypes: 'xls,xlsx,doc,docx,pdf,rar,zip',
                uploadErrorStr: 'File không đúng danh mục!',
                maxFileSize: 10480000,
                multiple: true,
                showErrType: 1,
                dragDropStr: "",
                onSuccess: function (files, data) {
                    showAttachment(files, data);
                    $('.ajax-file-upload-statusbar').fadeOut();
                }
            });
        }
        setTimeout(function () { $('.btn-att-report').css({ 'pointer-events': 'auto' }).removeClass('border-gray font-gray'); }, 100);
    } else {
        $('.btn-att-report').css({ 'pointer-events': 'none' }).addClass('border-gray font-gray');
    }
}

function showAttachment(src, dst) {
    var key = 0;
    var parent = $('.Attachments-list');
    if (parent.find('tr.file-item').length) {
        key = parseInt(parent.find('tr.file-item').last().data('key')) + 1;
    }
    var options = '';
    var Maintain = $('#Maintain').val();
    $('.content-repeats .checkbox').each(function () {
        var before = new Date($(this).find('input[type="hidden"]').val());
        before.setDate(before.getDate() - 1);
        var beforeToString = before.getFullYear() + '-' + _addZero(before.getMonth() + 1) + '-' + _addZero(before.getDate());

        var dateMaintain = new Date($(this).find('input[type="hidden"]').val());
        dateMaintain.setDate(dateMaintain.getDate() + parseInt(Maintain));
        var dateMaintainToString = dateMaintain.getFullYear() + '-' + _addZero(dateMaintain.getMonth() + 1) + '-' + _addZero(dateMaintain.getDate());

        options += '<option value="' + ($(this).find('input[type="hidden"]').val()) + '"' + (beforeToString <= _today() && _today() <= dateMaintainToString ? '' : ' hidden') + '>' + ($(this).find('input[type="hidden"]').data('format')) + '</option>'
    })
    var html = '<tr class="file-item" data-key="' + key + '">';
    html += '    <td class="file-icon">';
    html += '        <img src="assets/img/file_ext/' + dst.split('/').pop().split('.').pop() + '.png">';
    html += '    </td>';
    html += '    <td class="filename">';
    html += '        <a href="javascript:;" title="' + dst.split('/').pop() + '">';
    html += '           <span>' + dst.split('/').pop() + '</span>';
    html += '           <input data-file="' + src + '" value="' + dst.split('/').pop() + '" value="' + dst.split('/').pop() + '" type="hidden" name="Attachments[' + key + '][Filename]">';
    html += '        </a>';
    html += '    </td>';
    html += '    <td class="file-date">';
    html += '       <select id="reportingdate' + key + '" name="Attachments[' + key + '][ReportingDate]" class="select-status d-block reportingdate" data-required="1"><option value="">Select ...</option>';
    html += options;
    html += '       </select>';
    html += '       <div class="errordiv reportingdate' + key + '">Not Empty</div>';
    html += '    </td>';
    html += '    <td class="file-remove text-right">';
    html += '        <input type="hidden" name="Attachments[' + key + '][DateAdded]" value="' + _today(true) + '">'
    html += '        <a href="javascript:;" class="remove"><i class="fa fa-close"></i></a>';
    html += '    </td>';
    html += '</tr>';
    $('.Attachments-list table tbody').append(html);
    rd_change();
    // $('#reportingdate' + key).chosen({ allow_single_deselect: true });
    // $('#reportingdate' + key + '_chosen .chosen-single div').html('<i class="glyph-icon icon-caret-down"></i>');
}

function rd_change() {
    var previous;

    $('.reportingdate').focus(function () {
        previous = this.value;
    }).change(function() {
        $('.content-repeats input[type="hidden"][value="' + previous + '"]').next().prop('checked', false);
        previous = this.value;
        $('.content-repeats input[type="hidden"][value="' + previous + '"]').next().prop('checked', true);
    });
};