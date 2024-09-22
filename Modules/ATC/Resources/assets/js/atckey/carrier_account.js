$(document).ready(function() {
    $('body').on('click', '#modal-legal-record .btn.btn-primary', function() {
        var legalFileType = $('#modal-legal-record #legal-file-type').val();
        var file = $('#modal-legal-record [name="file_name[]"]').val();
        $('#modal-legal-record input, #modal-legal-record select, #modal-legal-record button').addClass('disabled');
        if (legalFileType == '' || file == '') {
            showNoti('File Type or Attacment not empty', 'Warning', 'War');
            return false;
        } else {
            $.ajax({
                url: site_url + $('#act').val() + '/process_legal_record',
                type: 'POST',
                data:  $('#modal-legal-record form').serialize(),
                success: function(string) {
                    if (string == 0) {
                        showNoti('Please check the uploaded file again', 'Warning', 'War');
                        return false;
                    }
                    if (string == 1) {
                        window.location.href = window.location.href;
                    }
                }
            })
        }
    }).on('click', '#myTab li.legal.active .button-tab', function() {
        $('#modal-legal-record').modal('show');
    }).on('show.bs.modal', '#modal-legal-record', function() {
        if (!$('#modal-legal-record .attachments .ajax-upload-dragdrop').length) {
            $("#legal-attachment").uploadFile({
                url: site_url + 'ajax/ajax_attachment',
                fileName: 'myfile',
                formData: {
                    'dir': $('#legal-attachment').data('dir'),
                },
                uploadButtonClass: 'btn btn-border btn-alt btn-hover border-orange font-orange waves-effect pull-right',
                dragDropStr: '',
                allowedTypes: 'xls,xlsx,doc,docx,pdf,rar,zip',
                uploadErrorStr: 'File không đúng danh mục!',
                maxFileSize: 5240000,
                multiple: true,
                showErrType: 1,
                onSubmit: function () {

                },
                onSuccess: function (files, data) {
                    var ext = data.split('.').pop();
                    showAttachment(files, data);
                    $('.ajax-file-upload-statusbar').fadeOut();
                    $('.attachments-wrap i.remove').click(function () {
                        $(this).parent().next().fadeOut();
                        $(this).parent().fadeOut(function () {
                            $(this).remove();
                        });
                    });
                }
            });
        }
    }).on('show.bs.modal', '#modal-reports', function() {
        if (!$('#modal-reports .attachments .ajax-upload-dragdrop').length) {
            $("#reports-attachment").uploadFile({
                url: site_url + 'ajax/ajax_attachment',
                fileName: 'myfile',
                formData: {
                    'dir': $('#reports-attachment').data('dir')
                },
                uploadButtonClass: 'btn btn-border btn-alt btn-hover border-orange font-orange waves-effect pull-right',
                dragDropStr: '',
                allowedTypes: 'xls,xlsx,doc,docx,pdf,rar,zip',
                uploadErrorStr: 'File không đúng danh mục!',
                maxFileSize: 5240000,
                multiple: true,
                showErrType: 1,
                onSubmit: function () {

                },
                onSuccess: function (files, data) {
                    var ext = data.split('.').pop();
                    showAttachment(files, data);
                    $('.ajax-file-upload-statusbar').fadeOut();
                    $('.attachments-wrap i.remove').click(function () {
                        $(this).parent().next().fadeOut();
                        $(this).parent().fadeOut(function () {
                            $(this).remove();
                        });
                    });
                }
            });
        }
    }).on('click', '.add-contact', function () {
        var ContactType = $(this).data('contacttype');
        var key = 1;        if ($('tr.Contacts').length) {
            key = parseInt($('tr.Contacts').length) + 1;
        }
        var html = '<tr class="Contacts Contacts' + ContactType + ' editing" id="Contacts' + ContactType + key + '">' +
            '<td nowrap="nowrap">' +
            '<input type="hidden" name="Contacts[' + key + '][id]" value=""/>' +
            '<input type="hidden" name="Contacts[' + key + '][ContactType]" value="' + ContactType + '"/>' +
            '<input type="hidden" class="key" value="' + key + '"/>' +
            '<a href="javascript:;" class="edit-contact"><i class="glyph-icon icon-edit"></i></a>&nbsp;&nbsp;' +
            '<a href="javascript:;" class="remove-contact" data-table="contacts_supplier" data-id=""><i class="glyph-icon icon-remove"></i></a>' +
            '</td>' +
            '<td><span class="form-text ItemName"></span><input type="text" name="Contacts[' + key + '][ContactName]" class="form-control"/></td>' +
            '<td><span class="form-text"></span><input type="text" name="Contacts[' + key + '][Function]" class="form-control"/></td>' +
            '<td><span class="form-text"></span><input type="text" name="Contacts[' + key + '][Email]" class="form-control"/></td>' +
            '<td><span class="form-text"></span><input type="text" name="Contacts[' + key + '][Phone]" class="form-control"/></td>' +
            '<td class="center"><div class="checkbox checkbox-primary"><input type="checkbox" class="custom-checkbox" name="Contacts[' + key + '][Catalog]" id="Contacts' + ContactType + 'Catalog' + key + '" value="1"/></div></td>' +
            '<td class="center"><div class="checkbox checkbox-primary"><input type="checkbox" class="custom-checkbox" name="Contacts[' + key + '][Newsletter]" id="Contacts' + ContactType + 'Newsletter' + key + '" value="1"/></div></td>' +
            '<td class="center"><div class="checkbox checkbox-primary"><input type="checkbox" class="custom-checkbox" name="Contacts[' + key + '][PressReleases]" id="Contacts' + ContactType + 'ressReleases' + key + '" value="1"/></div></td>' +
            '<td class="center"><div class="checkbox checkbox-primary"><input type="checkbox" class="custom-checkbox" name="Contacts[' + key + '][ProductNotifications]" id="Contacts' + ContactType + 'ProductNotifications' + key + '" value="1"/></div></td>' +
            '<td class="center"><div class="checkbox checkbox-primary"><input type="checkbox" class="custom-checkbox" name="Contacts[' + key + '][Emailinvalid]" id="Contacts' + ContactType + 'Emailinvalid' + key + '" value="1"/></div></td>' +
            '<td class="center"><div class="checkbox checkbox-primary"><input type="checkbox" class="custom-checkbox" name="Contacts[' + key + '][LeftCompany]" id="Contacts' + ContactType + 'LeftCompany' + key + '" value="1"/></div></td>';
        if ($('.Contacts' + ContactType).length) {
            $('.Contacts' + ContactType + ':last').after(html);
        } else {
            $(this).parent().parent().after(html);
        }
    }).on('click', '.edit-contact', function () {
        var tr = $(this).parent().parent();
        tr.addClass('editing');
        tr.find(':input').addClass('show');
        tr.find('span').addClass('hidden');

    }).on('click', '.remove-contact, .remove-quotation, .remove-order_histories, .remove-web_order_histories, .remove-businesstrip', function () {
        var id = $(this).data('id');
        var table = $(this).data('table');
        var tr = $(this).parent().parent();
        $.alerts.confirm('Will you delete this item?<br/><b>' + tr.find('.ItemName').text() + '</b>', 'Confirm delete', function (r) {
            if (r == true) {
                $.ajax({
                    url: site_url + 'ajax/change_status',
                    type: 'POST',
                    cache: false,
                    data: {
                        id: id,
                        table: table,
                        field: 'deleted',
                        status: 1
                    }
                });
                tr.remove();
            }
        });
    })
    function showAttachment(src, dst) {
        var html = '<div>';
        html += '<div class="attachments-wrap"><i class="fa fa-close remove"></i><input data-file="' + src + '" value="' + dst.split('/').pop() + '" type="hidden" name="file_name[]"><div class="image-small"><div class="no-image" title="' + dst.split('/').pop() + '"><img src="assets/img/file_ext/' + dst.split('/').pop().split('.').pop() + '.png" /></div></div></div>';
        html += '</div>';
        $('.attachments-list').append(html);
    }
});