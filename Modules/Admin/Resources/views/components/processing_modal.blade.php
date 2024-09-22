<div class="modal fade hsModal" id="processingModal" tabindex="-1" role="dialog" aria-labelledby="processingModalLabel" aria-hidden="true">
    <form id="processingModalForm" action="" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="processingModalTitle"></h4>
                </div>
                <div class="modal-body" id="processingModalBody">
                </div>
                <div class="modal-footer">
                    <button type="button" id="processingModalCancel" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" id="processingModalSubmit" class="btn btn-primary">Ok</button>
                </div>
            </div>
        </div>
    </form>
</div>