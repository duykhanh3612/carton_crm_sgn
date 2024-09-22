$(document).ready(function() {
    loadAttachments();

    $('body').on('click', '.attachments-wrap i.remove', function() {
        var parent = $(this).closest('.attachmentsSection');
        var attName = parent.data('attname');
        var dir = parent.find('.attachmentUploader').data('dir') + $('#RequestID').val();
        var file = $(this).next().val();
        var att = $('[name*="' + attName + '"]').serializeArray();
        var attachmentWrap = $(this).parent();
        $.ajax({
            url: site_url + 'ajax/ajax_delete_attachment',
            type: 'POST',
            cache: false,
            data: {
                id: $('#id').val(),
                dir: dir,
                file: file,
                att: att,
                table: 'request_technical_details',
                attName: attName,
            },
            success: function () {
                attachmentWrap.fadeOut(function() {
                    $(this).remove();
                });
            }
        })
    }).on('click', '.close-phase', function(event) {
        var parent = $(this).closest('.panel-phase');
        parent.find('.attachments-wrap i.remove').each(function() {
            $(this).click();
        });
        parent.remove();
    }).on('click', '#addPhase', function() {
        var key = parseInt($('.panel-phase:last').find('.itemKey').val()) + 1;
        if (isNaN(key)) {
            key = 1;
        }
        add_phase(key);
    })
});
// # Ready

function loadAttachments() {
    $('.attachmentsSection').each(function () {
        var parent = $(this);
        var attName = parent.data('attname');
        var itemKey = parseInt(parent.closest('.panel-phase').find('.itemKey').val());
        if (parent.length) {
            var attachmentUploader = parent.find('.attachmentUploader');
            var attList = parent.find('.attachmentsList');
            var dir = attachmentUploader.data('dir');
            var code = $('#RequestID').val();
            attachmentUploader.uploadFile({
                url: site_url + 'ajax/ajax_attachment',
                fileName: 'myfile',
                formData: {
                    'dir': dir + code,
                    // 'code': code
                },
                uploadButtonClass: 'btn btn-border btn-alt btn-hover border-orange font-orange waves-effect pull-right',
                allowedTypes: 'xls,xlsx,doc,docx,pdf,rar,zip',
                uploadErrorStr: 'File không đúng danh mục!',
                maxFileSize: 5240000,
                multiple: true,
                showErrType: 1,
                dragDropStr: "",
                onSuccess: function(files, data) {
                    parent.find('.ajax-file-upload-statusbar').fadeOut();
                    showAttachment(files, data, attList, attName, itemKey);
                    $('.attachments-wrap i.remove').click(function() {
                        $(this).parent().next().fadeOut();
                        $(this).parent().fadeOut(function() {
                            $(this).remove();
                        });
                    });
                }
            });
        }
    })
}


function showAttachment(src, dst, attList, attName, itemKey) {
    var html = '<div>';
    html += '<div class="attachments-wrap"><i class="fa fa-close remove"></i><input data-file="' + src + '" value="' + dst.split('/').pop() + '" type="hidden" name="phases[' + itemKey + '][' + attName + '][]" /><div class="image-small"><div class="no-image" title="' + dst.split('/').pop() + '"><img src="assets/img/file_ext/' + dst.split('/').pop().split('.').pop() + '.png" /></div></div></div>';
    html += '</div>';
    attList.append(html);
}

function add_phase(key) {
    var string = '<div class="panel panel-default panel-phase panel-phase-' + key + '">' +
                    '<div class="panel-heading">' +
                        '<h3 class="panel-title">Phase ' + key +
                            '<input type="hidden" name="phases[' + key + '][SortOrder]" class="itemKey" value="' + key + '">' +
                            '<button type="button" class="close close-phase" data-dismiss="modal" aria-hidden="true">&times;</button>' +
                        '</h3>' + 
                    '</div>' +
                    '<div class="panel-body">' +
                        '<div class="row">' +
                            '<div class="col-sm-6">' +
                                '<div class="form-group">' +
                                    '<div class="col-sm-4 control-label">Request Date</div>' +
                                    '<div class="col-sm-8">' +
                                        '<input type="text" name="phases[' + key + '][RequestDate]" class="form-control bootstrap-datepicker" value="">' +
                                    '</div>' +
                                '</div>' +
                                '<div class="form-group">' +
                                    '<div class="col-sm-4 control-label">Technical Issue</div>' +
                                    '<div class="col-sm-8">' +
                                        '<textarea name="phases[' + key + '][TechnicalIssue]" class="form-control" rows="3"></textarea>' +
                                    '</div>' +
                                '</div>' +
                                '<div class="form-group">' +
                                    '<div class="col-sm-4 control-label">Attachments</div>' +
                                    '<div class="col-sm-8">' +
                                        '<div class="attachmentsSection" data-attname="IssueAttachment">' +
                                            '<div class="attachments">' +
                                                '<div class="attachmentUploader" data-dir="' + dirJS + '">' +
                                                    '<i class="fa fa-plus" title="Choose or drag and drop file."></i>' +
                                                '</div>' +
                                                '<div class="hidden submitBtn btn btn-success" style="position: absolute; top: 12px; right: 5px;"><i class="icon glyphicons white cloud_plus"></i> Upload</div>' +
                                            '</div>' +
                                            '<div class="attachmentsList">' +
                                            '</div>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                            '<div class="col-sm-6">' +
                                '<div class="form-group">' +
                                    '<div class="col-sm-4 control-label">Support Date</div>' +
                                    '<div class="col-sm-8">' +
                                        '<input type="text" name="phases[' + key + '][SupportDate]" class="form-control bootstrap-datepicker" value="">' +
                                    '</div>' +
                                '</div>' +
                                '<div class="form-group">' +
                                    '<div class="col-sm-4 control-label">Technical Support</div>' +
                                    '<div class="col-sm-8">' +
                                        '<textarea name="phases[' + key + '][TechnicalSupport]" class="form-control" rows="3"></textarea>' +
                                    '</div>' +
                                '</div>' +
                                '<div class="form-group">' +
                                    '<div class="col-sm-4 control-label">Attachments</div>' +
                                    '<div class="col-sm-8">' +
                                        '<div class="attachmentsSection" data-attname="SupportAttachment">' +
                                            '<div class="attachments">' +
                                                '<div class="attachmentUploader" data-dir="' + dirJS + '">' +
                                                    '<i class="fa fa-plus" title="Choose or drag and drop file."></i>' +
                                                '</div>' +
                                                '<div class="hidden submitBtn btn btn-success" style="position: absolute; top: 12px; right: 5px;"><i class="icon glyphicons white cloud_plus"></i> Upload</div>' +
                                            '</div>' +
                                            '<div class="attachmentsList">' +
                                            '</div>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                        '<div class="row">' +
                            '<div class="col-sm-12">' +
                                '<div class="form-group">' +
                                    '<div class="col-sm-2 control-label">Customer Feedback</div>' +
                                    '<div class="col-sm-10">' +
                                        '<textarea name="phases[' + key + '][CustomerFeedback]" class="form-control" rows="3"></textarea>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>' +
                '</div>';
    var panel = '.panel-phase-' + key;
    $('#phaseList').append(string);
    $('#phaseList .panel-phase:last').find('.bootstrap-datepicker').datepicker({
        format: 'yyyy-mm-dd',
        language: 'vi',
        autoclose: true,
        todayHighlight: true
    });
    constructionUploadFile(panel);
}

function constructionUploadFile(panel) {
    console.log(panel);
    if (panel.length) {
        $('.panel' + panel).find('.attachmentsSection').each(function () {
            var parent = $(this);
            var attName = parent.data('attname');
            var itemKey = parseInt(parent.closest('.panel-phase').find('.itemKey').val());
            if (parent.length) {
                var attachmentUploader = parent.find('.attachmentUploader');
                var attList = parent.find('.attachmentsList');
                var dir = attachmentUploader.data('dir');
                var code = $('#RequestID').val();
                attachmentUploader.uploadFile({
                    url: site_url + 'ajax/ajax_attachment',
                    fileName: 'myfile',
                    formData: {
                        'dir': dir + code,
                        // 'code': code
                    },
                    uploadButtonClass: 'btn btn-border btn-alt btn-hover border-orange font-orange waves-effect pull-right',
                    allowedTypes: 'xls,xlsx,doc,docx,pdf,rar,zip',
                    uploadErrorStr: 'File không đúng danh mục!',
                    maxFileSize: 5240000,
                    multiple: true,
                    showErrType: 1,
                    dragDropStr: "",
                    onSuccess: function(files, data) {
                        parent.find('.ajax-file-upload-statusbar').fadeOut();
                        showAttachment(files, data, attList, attName, itemKey);
                        $('.attachments-wrap i.remove').click(function() {
                            $(this).parent().next().fadeOut();
                            $(this).parent().fadeOut(function() {
                                $(this).remove();
                            });
                        });
                    }
                });
            }
        })
    }
}