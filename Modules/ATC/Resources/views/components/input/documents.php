<component class="documents" id="component-documents" is-ajax data-ajax="<?= @$ajax ?>" data-return="html" data-document_type="<?= @$document_type; ?>" data-module="<?= @$module ?>" data-group="<?= @$group??$module ?>" data-module_approved="<?= $GLOBALS['module']['approved'] ?>"></component>
<script>
    $("body").append(`<div class="modal modal-file-in-update modal-documents fade" id="modal-documents">
	<div class="modal-dialog">
	    <div class="modal-content">
		<div class="modal-header">
		<h4 class="modal-title">Documents</h4>
		</div>
		<div class="" style="min-height: 150px; padding: 15px;">
		<form onsubmit="return false;">
		    <div class="form-group">
		    <div class="row">
			<div class="col-sm-3 control-label" alt="<?=isset($document_type) ? $document_type : 'Document'.ucwordsModule(@$module)?>">File Type <span style="color:red">*</span></div>
			<div class="col-sm-9">
			<input type="hidden" name="document_id" value="<?= $info['id'] ?? $id ?>">
			<?= get_options_keynum(isset($document_type) ? $document_type : 'Document'.ucwordsModule(@$module), '', 'id="forms-file-type" class="form-control"', 'file_type') ?>
			</div>
		    </div>
		    </div>
		    <div class="form-group">
		    <div class="row">
			<div class="col-sm-3 control-label">File Name <span style="color:red">*</span></div>
			<div class="col-sm-9">
			<input type="text" name="filename" id="filename" class="form-control" value="">
			</div>
		    </div>
		    </div>
		    <div class="form-group">
		    <div class="row">
			<div class="col-sm-3 control-label">Documents Date <span style="color:red">*</span></div>
			<div class="col-sm-9">
			<input type="text" name="document_date" id="document_date"
			    class="form-control bootstrap-datepicker" value="">
			</div>
		    </div>
		    </div>
		    <div class="form-group">
		    <div class="row">
			<div class="col-sm-3 control-label">Version <span style="color:red">*</span></div>
			<div class="col-sm-9">
			<input type="text" name="version" id="version" class="form-control" value="">
			</div>
		    </div>
		    </div>
		    <div class="form-group">
		    <div class="row">
			<div class="col-sm-3 control-label">Attachment <span style="color:red">*</span></div>
			<div class="col-sm-9">
			<input type="hidden" id="file" />
			<div class="attachments">
			    <div id="documents-attachment" data-dir="upload/<?= @$module."_documents" ?>"
			    class="btn btn-border btn-alt btn-hover border-orange font-orange waves-effect">
			    <span>Upload files</span><i class="glyph-icon icon-upload"></i>
			    </div>
			</div>
			<div class="document attachments-list"></div>
			</div>
		    </div>
		    </div>
		</form>
		</div>
		<div class="modal-footer">
		<button type="button" class="btn btn-primary">Upload file</button>
		<button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
		</div>
	    </div>
	</div>
    </div>`);
    $('body').on('click', '#myTab li.documents.active .button-tab', function() {
        $('#modal-documents').modal('show');
    }).on('show.bs.modal', '#modal-documents', function() {
        if (!$('#modal-documents .attachments .ajax-upload-dragdrop').length) {
            console.log("upload")
            $("#documents-attachment").uploadFile({
                url: site_url + 'ajax/ajax_attachment',
                fileName: 'myfile',
                formData: {
                    'dir': $('#documents-attachment').data('dir')
                },
                uploadButtonClass: 'btn btn-border btn-alt btn-hover border-orange font-orange waves-effect pull-right',
                dragDropStr: '',
                allowedTypes: 'xls,xlsx,doc,docx,pdf,rar,zip,ppt,pptx,jpg,png,web',
                uploadErrorStr: 'File không đúng danh mục!',
                maxFileSize: 50480000,
                multiple: true,
                showErrType: 1,
                onSubmit: function() {

                },
                onSuccess: function(files, data) {
                    var ext = data.split('.').pop();
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
    }).on('click', '#modal-documents .btn.btn-primary', function() {
		var documentDate = $('#modal-documents').find('input[name=document_date]').val(),
			file = $('#modal-documents [name="file_name[]"]').val(),
			fileType = $('#modal-documents').find('select[name=file_type]').val(),
			version = $('#modal-documents').find('input[name=version]').val(),
			filename = $('#modal-documents').find('input[name=filename]').val();
		
		if (!fileType || !file) {
			showNoti('File Type or Attacment not empty', 'Warning', 'War');
			return false;
		}
		if(!filename){
			showNoti('File Name not empty', 'Warning', 'War');
			return false;
		}
		if(!documentDate){
			showNoti('Documents Date not empty', 'Warning', 'War');
			return false;
		}
		if(!version){
			showNoti('Version not empty', 'Warning', 'War');
			return false;
		}

		var data = new FormData();
		data.append("parent",$('#modal-documents').find('input[name=document_id]').val());
		data.append("filename", filename);
		i = 0;
		$(".document_files").each(function(){
		data.append("file_name["+(i++)+"]",$(this).val());
		});
		data.append("document_date", documentDate);
		data.append("version", version);
		data.append("file_type", fileType);
		data.append("group", $("#component-documents").data("group"));
		data.append("module", $("#component-documents").data("module"));

		$.ajax({
			url: site_url + 'ajax/process_documents',
			type: 'POST',
			data: data,
			processData: false,contentType: false,
			success: function(string) {
				if (string == 0) {
				showNoti('Please check the uploaded file again', 'Warning', 'War');
				return false;
				}
				if (string == 1) {
				window.location.href = window.location.href;
				showNoti('Upload successful', 'Ok', 'Ok');
				$('#modal-documents').hide();
				}
			},
			error()
			{
				$('#modal-documents input, #modal-documents select, #modal-documents button').removeClass('disabled');
			}
		})
    }).on('click', '.delete-file-in-update', function() {
        var parent = $(this).closest('tr');
        var file = parent.data('file');
        var table = $(this).data('table');
        var dir = $(this).data('dir');
        $.alerts.confirm('Will you delete ' + file + ' file?', 'Alert', function(e) {
            if (e) {
                var id = parent.data('id');
                parent.remove();
                $.ajax({
                    url: site_url + 'ajax/delete_file_in_update',
                    type: 'POST',
                    cache: false,
                    data: {
                        id: id,
                        file: file,
                        table: table,
                        dir: dir,
                        group: $("#component-documents").data("group"),
                    },
                    success: function(string) {
                        if (string == 0) {
                            showNoti('Fail', 'Error', 'Err');
                            return false;
                        } else {
                            showNoti('Deleted ' + file + ' file success.',
                                'Success', 'Ok');
                            parent.remove();
                        }
                    }
                })
            }
        })
        return false;
    })

    function showAttachment(src, dst) {
        var html = '<div>';
        html += '<div class="attachments-wrap"><i class="fa fa-close remove"></i><input data-file="' + src +
            '" value="' + dst.split('/').pop() +
            '" type="hidden" name="file_name[]" class="document_files"><div class="image-small"><div class="no-image" title="' + dst
            .split('/').pop() + '"><img src="assets/img/file_ext/' + dst.split('/').pop().split('.').pop() +
            '.png" /></div></div></div>';
        html += '</div>';

        var pane = $('.tab-pane.active').data('pane');
        $('.' + pane + '.attachments-list').append(html);
    }
</script>