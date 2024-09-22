class AttachFile{
    constructor(root) {
        this.root = $(root);
        this.addEventListener();
    }
    addEventListener(){
        var af = this;
        this.root.on('click', '.nav-tabs li.documents.active .button-tab', function() {
            $('#modal-documents').modal('show');
        }).on('show.bs.modal', '#modal-documents', async function() {
            if (!$('#modal-documents .attachments .ajax-upload-dragdrop').length) {
                
                var {file,data} = await af.uploadFile();

                af.statusBarLoading();
                af.showAttachment(file,data);
            }
        }).on('click', '#modal-documents .btn.btn-primary', function() {
            af.submitUpload();
        }).on('click', '.delete-file-in-update', function () {
            af.deleteUploadFile(this);
        })

    }
}
AttachFile.prototype.deleteUploadFile = function(el){
    var parent = $(el).closest('tr');
    var file = parent.data('file');
    var table = $(el).data('table');
    var dir = $(el).data('dir');
    var af = this;
    $.alerts.confirm('Will you delete ' + file + ' file?', 'Alert',async function (e) {
        if (e) {
            var id = parent.data('id');
            parent.remove();
            var result = await af.send({id,file,table,dir},"delete_file_in_update");
            if(result==0){
                showNoti('Fail', 'Error', 'Err');
                        return false;
            }else{
              showNoti("Deleted " + file + " file success.", "Success", "Ok");
              parent.remove();
            }
        }
    })
    return false;
}
AttachFile.prototype.showAttachment = function (src, dst) {
    var html = '<div>';
    html += '<div class="attachments-wrap"><i class="fa fa-close remove"></i><input data-file="' + src + '" value="' + dst.split('/').pop() + '" type="hidden" name="file_name[]"><div class="image-small"><div class="no-image" title="' + dst.split('/').pop() + '"><img src="assets/img/file_ext/' + dst.split('/').pop().split('.').pop() + '.png" /></div></div></div>';
    html += '</div>';

    var pane = $('.tab-pane.active').data('pane');
    $('.' + pane + '.attachments-list').append(html);
}
AttachFile.prototype.submitUpload = async function(){
    var documentDate = $('#modal-documents #document_date').val();
    var file = $('#modal-documents [name="file_name[]"]').val();
    $('#modal-documents input, #modal-documents select, #modal-documents button').addClass('disabled');
    if (documentDate == '' || file == '') {
        showNoti('File Type or Attacment not empty', 'Warning', 'War');
        return false;
    }

    var data = $('#modal-documents form').serialize();
    console.log({ data })
    var result = await this.send(data,'process_documents');

    if(result==0){
        showNoti('Please check the uploaded file again', 'Warning', 'War');
        return false;
    }

    // result = 1
    window.location.href = window.location.href;
    showNoti('Upload successful', 'Ok', 'Ok');
    $('#modal-documents').hide();
    
}
AttachFile.prototype.send = function(data,method=''){

    return new Promise((resolve,reject)=>{
        $.ajax({
            url: site_url + $('#act').val() + '/'+method,
            type: 'POST',
            data:  data,
            success: function(string) {
                resolve(string);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                reject(0);
             }
        })
    })
}
AttachFile.prototype.uploadFile = function(){
    return new Promise((resolve,reject)=>{
        $("#documents-attachment").uploadFile({
          url: site_url + "ajax/ajax_attachment",
          fileName: "myfile",
          formData: {
            dir: $("#documents-attachment").data("dir"),
          },
          uploadButtonClass:
            "btn btn-border btn-alt btn-hover border-orange font-orange waves-effect pull-right",
          dragDropStr: "",
          allowedTypes: "xls,xlsx,doc,docx,pdf,rar,zip,ppt,pptx",
          uploadErrorStr: "File không đúng danh mục!",
          maxFileSize: 9240000,
          multiple: true,
          showErrType: 1,
          onSubmit: function () {

          },
          onSuccess: function (files, data) {
            var ext = data.split(".").pop();
            resolve({ files, data });
          },
        });
    })
}
AttachFile.prototype.statusBarLoading = function(){
    $('.ajax-file-upload-statusbar').fadeOut();
    $('.attachments-wrap i.remove').click(function () {
        $(this).parent().next().fadeOut();
        $(this).parent().fadeOut(function () {
            $(this).remove();
        });
    });

}
new AttachFile('body');

