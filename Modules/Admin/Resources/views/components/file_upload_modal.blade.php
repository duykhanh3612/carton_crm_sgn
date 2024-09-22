<div class="modal fade hsModal" id="fileUploadModal" tabindex="-1" role="dialog" aria-labelledby="fileUploadModalLabel" aria-hidden="true">
    <form id="fileUploadModalForm" action="" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="fileUploadModalTitle"></h4>
                </div>
                <div class="modal-body" id="fileUploadModalBody">
                    <div class="form-group">
                        <label>CSV/Excel format</label> <a id="fileUploadModalSampleFile" href="" target="_blank" download><i class="fa fa-download"></i>&nbsp; Download</a>
                    </div>
                    <div class="form-group">
                        <label>Please select your CSV/Excel file:</label>
                        <input type="file" name="file_from_modal" id="file_from_modal" accept=".csv, .xls, .xlsx">
                    </div>
                    <div class="form-group">
                        <label id="fileUploadModalNote"></label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="fileUploadModalCancel" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" id="fileUploadModalSubmit" class="btn btn-primary">Ok</button>
                </div>
                <span id="successMessage" style="display:none"></span>
            </div>
        </div>
    </form>
</div>