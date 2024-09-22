$(document).ready(function() {

    if ($('#attachmentUploader').length) {
        var dir = $('#attachmentUploader').data('dir');
       // var code = $('#id').val();
        $('#attachmentUploader').uploadFile({
            url: site_url + 'ajax/ajax_attachment',
            fileName: 'myfile',
            formData: {
                'dir': dir,
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
                showAttachment(files, data);
                $('.ajax-file-upload-statusbar').fadeOut();
                $('.attachments-wrap i.remove').click(function() {
                    $(this).parent().next().fadeOut();
                    $(this).parent().fadeOut(function() {
                        $(this).remove();
                    });
                });
            }
        });
    }
    function showAttachment(src, dst) {
        var html = '<div>';
        html += '<div class="attachments-wrap"><i class="fa fa-close remove"></i><input data-file="' + src + '" value="' + dst.split('/').pop() + '" type="hidden" name="Attachments[]" /><div class="image-small"><div class="no-image" title="' + dst.split('/').pop() + '"><img src="assets/img/file_ext/' + dst.split('/').pop().split('.').pop() + '.png" /></div></div></div>';
        html += '</div>';
        $('#Attachments-list').append(html);
    }

    $('body').on('click', '.attachments-wrap i.remove', function() {
        var dir = $('#attachmentUploader').data('dir') ;
        var file = $(this).next().val();
        var att = $('[name*="Attachments"]').serializeArray();
        var attachmentWrap = $(this).parent();
        $.ajax({
            url: site_url + 'ajax/ajax_delete_attachment',
            type: 'POST',
            cache: false,
            data: {
                //id: $('#id').val(),
                dir: dir,
                file: file,
                att: att,
                table: 'regulations',
            },
            success: function () {
                attachmentWrap.fadeOut(function() {
                    $(this).remove();
                });
            }
        })
    });
});
// # Ready