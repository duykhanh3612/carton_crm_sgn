<div class="modal fade" id="modal-change-pass">
    <div class="modal-dialog" ng-class="{'modal-sm': size == 'sm', 'modal-lg': size == 'lg'}">
        <div class="modal-content" ng-transclude="">
            <form name="frmCreatePassword" novalidate="" class="ng-scope ng-pristine ng-invalid ng-invalid-required">
                <div class="modal-header no-padding">
                    <div class="table-header ng-binding">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"
                            data-ng-click="closeModal()">
                            <span class="white">×</span>
                        </button>
                        Đổi mật khẩu <span class="full_name"></span>
                    </div>
                </div>
                <div class="modal-body no-padding">
                    <div class="row">
                        <div class="col-xs-12 form-horizontal">
                            <div class="form-group" style="margin-top:10px;">
                                <label class="col-xs-3 control-label ng-binding">Nhập mật khẩu mới</label>
                                <div class="col-xs-9">
                                    <input type="password" id="txtNewPassword" name="newpassword"
                                        placeholder="Nhập mật khẩu mới"
                                        class="width-100 ng-pristine ng-invalid ng-invalid-required ng-valid-minlength"
                                        required="" data-ng-minlength="6">
                                    <span class="red ng-binding ng-hide"
                                        data-ng-show="frmCreatePassword.newpassword.$error.required &amp;&amp; frmCreatePassword.newpassword.$dirty">Bạn
                                        chưa nhập mật khẩu.</span>
                                    <span class="red ng-binding ng-hide"
                                        data-ng-show="frmCreatePassword.newpassword.$error.minlength &amp;&amp; frmCreatePassword.newpassword.$dirty">Mật
                                        khẩu phải có ít nhất 6 ký tự.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-primary" type="button" id="updatePassword">
                        <i class="fa fa-ok"></i>
                        Lưu
                    </button>
                    <button class="btn btn-sm ng-binding" data-ng-click="closeModal()">
                        <i class="fa fa-undo"></i>
                        Hủy
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
