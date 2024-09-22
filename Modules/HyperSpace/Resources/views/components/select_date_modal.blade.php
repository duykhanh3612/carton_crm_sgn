<div class="modal fade hsModal" id="selectDateModal" tabindex="-1" role="dialog" aria-labelledby="selectDateModalLabel" aria-hidden="true">
    <form id="selectDateModalForm" action="" method="POST">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="selectDateModalTitle"></h4>
                </div>
                <div class="modal-body" id="selectDateModalBody">
                    <div class="form-group">
                        <label>Please select a date</label>
                        <input class="form-control" type="date" id="selectDateModalInput" name ="date" />
                    </div>
                    <div class="form-group">
                        <label id="selectDateModalNote"></label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="selectDateModalCancel" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" id="selectDateModalSubmit" class="btn btn-primary">Ok</button>
                </div>
                <span id="selectDateModalMessage" style="display:none"></span>
            </div>
        </div>
    </form>
</div>