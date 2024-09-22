<div class="modal fade" id="modal-create-user">
    <div class="modal-dialog">
        <div class="modal-content" ng-transclude="">
            <form name="frmCreateUser" novalidate="" class="ng-scope ng-pristine ng-invalid ng-invalid-required">
                <div class="modal-header no-padding">
                    <div class="table-header ng-binding">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"
                            data-ng-click="closeModal()">
                            <span class="white">×</span>
                        </button>
                        Tạo nhân viên
                    </div>
                </div>
                <div class="modal-body no-padding">
                    <div class="row">
                        <div class="col-xs-12 form-horizontal">
                            <div class="form-group" style="margin-top:10px;">
                                <label class="col-xs-3 control-label ng-binding">Tên nhân viên (*)</label>
                                <div class="col-xs-9">
                                    <input type="text" name="fullname" placeholder="Nhập tên nhân viên"
                                        class="width-100 ng-pristine ng-invalid ng-invalid-required"
                                        data-ng-model="user.displayname" required="" ng-minlength="">
                                    <div class="red ng-binding ng-hide"
                                        data-ng-show="frmCreateUser.fullname.$error.required &amp;&amp; frmCreateUser.fullname.$dirty">
                                        Bạn chưa nhập tên nhân viên.
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-3 control-label ng-binding">Tài khoản (*)</label>
                                <div class="col-xs-9">
                                    <div class="input-group">
                                        <input type="text" name="username" placeholder="Nhập mã nhân viên"
                                            class="form-control width-100 ng-pristine ng-invalid ng-invalid-required ng-valid-pattern"
                                            style="border-radius: 3px 0px 0px 3px !important;"
                                            data-ng-model="user.prefixUserName" required="" ng-pattern="/^\w+$/" autocomplete="off">
                                       
                                        <span class="input-group-addon bolder" title="Thay đổi mã cửa hàng"
                                            ng-click="changeCompanyCodeRequest();">
                                            <a href="javascript:;">
                                                <i class="icon-edit bigger-130 blue ng-scope"></i>
                                            </a>
                                        </span>
                                    </div>
                                    <span class="red ng-binding ng-hide"
                                        data-ng-show="frmCreateUser.username.$error.required &amp;&amp; frmCreateUser.username.$dirty">Bạn
                                        chưa nhập mã nhân viên.</span>
                                    {{-- <span class="red ng-binding ng-hide"
                                        data-ng-show="frmCreateUser.username.$error.pattern &amp;&amp; frmCreateUser.username.$dirty">Mã
                                        nhân viên chỉ cho phép ký tự [a-z], số [0-9] và ký tự gạch dưới '_'. Không
                                        có khoảng trắng và ký tự đặc biệt.</span> --}}
                                </div>
                            </div>
                            {{-- <div class="form-group ng-hide" ng-show="changeCompanyCodeRequesting==true">
                                <label class="col-xs-3 control-label"></label>
                                <div class="col-xs-9">
                                    <div class="pull-right">
                                        <div class="input-group">
                                            <input type="text" name="" placeholder=""
                                                class="form-control width-100 ng-pristine ng-valid"
                                                style="border-radius: 3px 0px 0px 3px !important;"
                                                ng-model="user.companyCode" ng-init="user.companyCode=companyCode">
                                            <div class="red ng-binding ng-hide"
                                                data-ng-show="frmCreateUser.fullname.$error.required &amp;&amp; frmCreateUser.fullname.$dirty">
                                                Bạn chưa nhập tài khoản.
                                            </div>
                                            <span class="input-group-addon bolder" title="Lưu"
                                                ng-click="saveCompanyCode();">
                                                <a href="javascript:;">
                                                    <i class="icon-save bigger-130 blue ng-scope"></i>
                                                </a>
                                            </span>
                                            <span class="input-group-addon bolder" title="Lưu"
                                                ng-click="cancelCompanyCodeRequest();">
                                                <a href="javascript:;">
                                                    <i class="icon-undo bigger-130 blue ng-scope"></i>
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                </div> 
                            </div>--}}
                            <div class="form-group">
                                <label class="col-xs-3 control-label ng-binding">Mật khẩu</label>
                                <div class="col-xs-9">
                                    <input type="password" name="password" placeholder="Nhập mật khẩu hiện tại"
                                        class="width-100 ng-pristine ng-invalid ng-invalid-required ng-valid-minlength"
                                        data-ng-model="user.password" required="" data-ng-minlength="6" autocomplete="off">
                                    <span class="red ng-binding ng-hide"
                                        data-ng-show="frmCreateUser.password.$error.required &amp;&amp; frmCreateUser.password.$dirty">Bạn
                                        chưa nhập mật khẩu.</span>
                                    <span class="red ng-binding ng-hide"
                                        data-ng-show="frmCreateUser.password.$error.minlength &amp;&amp; frmCreateUser.password.$dirty">Mật
                                        khẩu phải có ít nhất 6 ký tự.</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-3 control-label ng-binding">Nhóm người dùng</label>
                                <div class="col-xs-9">
                                    <div class="checkbox inline ng-scope" data-ng-repeat="role in userroles">
                                        <label style="padding-left:0px; padding-right:10px;">
                                            <input type="checkbox" class="ace ng-pristine ng-valid"value="1">
                                            <span class="lbl ng-binding"> Chủ cửa hàng</span>
                                        </label>
                                    </div>
                                    <div class="checkbox inline ng-scope" data-ng-repeat="role in userroles">
                                        <label style="padding-left:0px; padding-right:10px;">
                                            <input type="checkbox" class="ace ng-pristine ng-valid" value="2">
                                            <span class="lbl ng-binding"> Quản lý</span>
                                        </label>
                                    </div>
                                    <div class="checkbox inline ng-scope" data-ng-repeat="role in userroles">
                                        <label style="padding-left:0px; padding-right:10px;">
                                            <input type="checkbox" class="ace ng-pristine ng-valid"  value="3">
                                            <span class="lbl ng-binding"> Nhân viên bán hàng</span>
                                        </label>
                                    </div>
                                    <div class="checkbox inline ng-scope" data-ng-repeat="role in userroles">
                                        <label style="padding-left:0px; padding-right:10px;">
                                            <input type="checkbox" class="ace ng-pristine ng-valid"
                                                data-ng-model="role.IsDefault"  value="4">
                                            <span class="lbl ng-binding"> Nhân viên kho</span>
                                        </label>
                                    </div>
                                    <div class="checkbox inline ng-scope" data-ng-repeat="role in userroles">
                                        <label style="padding-left:0px; padding-right:10px;">
                                            <input type="checkbox" class="ace ng-pristine ng-valid"
                                                data-ng-model="role.IsDefault"  value="5">
                                            <span class="lbl ng-binding"> Nhân viên thu ngân</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="form-group ng-hide">
                                <label class="col-xs-3 control-label ng-binding">Cửa hàng làm việc</label>
                                <div class="col-xs-9">
                                    <div class="checkbox inline ng-scope" data-ng-repeat="store in stores">
                                        <label style="padding-left:0px; padding-right:10px;">
                                            <input type="checkbox" class="ace ng-pristine ng-valid">
                                            <span class="lbl ng-binding"> Ms Vi</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ng-hide">
                                <label class="col-xs-3 control-label ng-binding">Ngôn ngữ</label>
                                <div class="col-xs-9">
                                    <select data-ng-model="user.cultureInfo" class="ng-pristine ng-valid">
                                        <option value="vi-VN" class="ng-binding">Tiếng Việt</option>
                                        <option value="en-US" class="ng-binding">Tiếng Anh</option>
                                    </select>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary ng-binding" id="createNewUser">
                        <i class="fa fa-ok"></i>
                        Lưu
                    </button>

                    <button class="btn btn-sm ng-binding closeModal">
                        <i class="fa fa-undo"></i>
                        Hủy
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
