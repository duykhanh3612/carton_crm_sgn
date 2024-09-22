<div ng-view="" class="ng-scope"><div data-ng-controller="userProfileController" class="ng-scope">


    <div class="breadcrumbs breadcrumbs-fixed" id="breadcrumbs">
        <h3 class="ng-binding">Tài khoản</h3>
    </div>
    <div class="page-content">
        <div class="page-content-container">
            <div class="row">
                <!--User Wiget-->
                <div class="col-xs-12">
                    <div class="form-horizontal">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right ng-binding">Tên nhân viên</label>
                                    <div class="col-sm-8">
                                        <label class="form-value" for="form-field-1">
                                            <span ng-bind="userProfile.displayName" class="ng-binding">Hoài Bảo</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right ng-binding">Mã NV</label>
                                    <div class="col-sm-8">
                                        <label class="form-value" for="form-field-1">
                                            <span ng-bind="userProfile.userNo" class="ng-binding">hoaibao.cartonsgn</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right ng-binding">Mật khẩu</label>
                                    <div class="col-sm-8">
                                        <div ng-show="userProfile.isHugateMembership" class="">
                                            <div ng-hide="layoutSettings.changePwdRequesting == true" class="">
                                                <button class="btn btn-primary ng-binding" ng-click="changePwdRequest();">
                                                    <i class="icon-retweet"></i>
                                                    Đổi mật khẩu
                                                </button>
                                            </div>
                                            <div class="ng-hide" ng-show="layoutSettings.changePwdRequesting == true">
                                                <form name="changePwdForm" class="form-horizontal  ng-pristine ng-invalid ng-invalid-required" novalidate="">
                                                    <div class="form-group">
                                                        <input type="password" class="form-control ng-pristine ng-invalid ng-invalid-required" placeholder="Nhập mật khẩu hiện tại" name="CurrentPwd" ng-model="changePwdModel.CurrentPwd" required="">
                                                        <div class="ng-hide" ng-show="changePwdForm.CurrentPwd.$dirty &amp;&amp; changePwdForm.CurrentPwd.$invalid">
                                                            <span class="label label-danger arrowed-right">
                                                                <span ng-show="changePwdForm.CurrentPwd.$error.required" class="ng-binding">Để đổi mật khẩu bạn phải nhập mật khẩu hiện tại</span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <input class="form-control ng-pristine ng-invalid ng-invalid-required" type="password" placeholder="Nhập mật khẩu mới" name="NewPwd" ng-model="changePwdModel.NewPwd" required="" ng-change="checkPwdMatchValid();">

                                                        <div class="ng-hide" ng-show="changePwdForm.NewPwd.$dirty &amp;&amp; changePwdForm.NewPwd.$invalid">
                                                            <span class="label label-danger arrowed-right">
                                                                <span ng-show="changePwdForm.NewPwd.$error.required" class="ng-binding">Nhập mật khẩu mới</span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <input class="form-control ng-pristine ng-invalid ng-invalid-required" type="password" placeholder="Nhập lại mật khẩu mới" name="RepeatNewPwd" ng-model="changePwdModel.RepeatNewPwd" required="" ng-change="checkPwdMatchValid();">

                                                        <div class="ng-hide" ng-show="changePwdForm.RepeatNewPwd.$dirty &amp;&amp; changePwdForm.RepeatNewPwd.$invalid">
                                                            <span class="label label-danger arrowed-right">
                                                                <span ng-show="changePwdForm.RepeatNewPwd.$error.required" class="ng-binding">Nhập lại mật khẩu mới</span>
                                                            </span>
                                                        </div>

                                                        <div class="ng-hide" ng-show="changePwdForm.RepeatNewPwd.$pwdNotMatch">
                                                            <span class="label label-danger arrowed-right">
                                                                <span class="ng-binding">Mật khẩu không giống nhau</span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-default ng-binding" ng-click="cacelChangePwd();">Hủy</button>
                                                    <button type="submit" class="btn btn-primary ng-binding" ng-click="changePwd();" ng-disabled="changePwdForm.$invalid || changePwdForm.RepeatNewPwd.$pwdNotMatch " disabled="disabled">Đổi mật khẩu</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div ng-show="userProfile.isHugateMembership == false" class="ng-hide">
                                            Passsword did not set
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right ng-binding" for="form-field-1">Nhóm người dùng</label>
                                    <div class="col-sm-8">
                                        <div ng-show="userProfile.roles != null &amp;&amp; userProfile.roles.length > 0" class="">
                                            <!-- ngRepeat: role in userProfile.roles --><span ng-repeat="role in userProfile.roles" class="ng-scope">
                                                <label class="form-value ng-binding" ng-bind="role">Chủ cửa hàng</label><span ng-hide="$index==userProfile.roles.length-1" class="">|</span>
                                            </span><!-- end ngRepeat: role in userProfile.roles --><span ng-repeat="role in userProfile.roles" class="ng-scope">
                                                <label class="form-value ng-binding" ng-bind="role">Quản lý</label><span ng-hide="$index==userProfile.roles.length-1" class="">|</span>
                                            </span><!-- end ngRepeat: role in userProfile.roles --><span ng-repeat="role in userProfile.roles" class="ng-scope">
                                                <label class="form-value ng-binding" ng-bind="role">Nhân viên bán hàng</label><span ng-hide="$index==userProfile.roles.length-1" class="">|</span>
                                            </span><!-- end ngRepeat: role in userProfile.roles --><span ng-repeat="role in userProfile.roles" class="ng-scope">
                                                <label class="form-value ng-binding" ng-bind="role">Nhân viên kho</label><span ng-hide="$index==userProfile.roles.length-1" class="">|</span>
                                            </span><!-- end ngRepeat: role in userProfile.roles --><span ng-repeat="role in userProfile.roles" class="ng-scope">
                                                <label class="form-value ng-binding" ng-bind="role">Nhân viên thu ngân</label><span ng-hide="$index==userProfile.roles.length-1" class="ng-hide">|</span>
                                            </span><!-- end ngRepeat: role in userProfile.roles -->
                                        </div>
                                        <div ng-show="userProfile.roles == null || userProfile.roles.length == 0" class="ng-hide">
                                            <i class="ng-binding">Bạn chưa được phân quyền nhóm người dùng nào</i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right ng-binding" for="form-field-1">Cửa hàng làm việc</label>
                                    <div class="col-sm-8">
                                        <div ng-show="userProfile.stores != null &amp;&amp; userProfile.stores.length > 0" class="">
                                            <!-- ngRepeat: store in userProfile.stores --><span ng-repeat="store in userProfile.stores" class="ng-scope">
                                                <label class="form-value ng-binding" ng-bind="store">Ms Vi</label><span ng-hide="$index==userProfile.stores.length-1" class="ng-hide">|</span>
                                            </span><!-- end ngRepeat: store in userProfile.stores -->
                                        </div>
                                        <div ng-show="userProfile.stores == null || userProfile.stores.length == 0" class="ng-hide">
                                            <i class="ng-binding">Bạn không được phép làm việc trên bất kỳ cửa hàng nào</i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right ng-binding">Ngôn ngữ</label>
                                    <div class="col-sm-8">
                                        <label class="form-value" for="form-field-1">
                                            <span class="ng-binding">Tiếng Việt</span>
                                        </label>
                                        <!-- ngIf: userProfile.cultureInfo == 'en-US' -->
                                        <!-- ngIf: userProfile.cultureInfo == null || userProfile.cultureInfo == 'vi-VN' --><button ng-if="userProfile.cultureInfo == null || userProfile.cultureInfo == 'vi-VN'" class="btn btn-primary ng-scope" ng-click="selectEnglish();">
                                            <i class="icon-flag"></i>
                                            English
                                        </button><!-- end ngIf: userProfile.cultureInfo == null || userProfile.cultureInfo == 'vi-VN' -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="widget-main">

                                    <div>
                                        <div class="dz-preview dz-image-preview ng-hide" data-ng-show="userProfile.avatar > 0">
                                            <div class="dz-details">
                                                <img data-ng-src="https://cdn.suno.vn/api/images/null/s" style="" ng-click="repeatSelectFile()" class="company-info-setting-logo" title="Click to change your avatar - hiển thị tốt nhất 150x150" src="https://cdn.suno.vn/api/images/null/s">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dropzone dz-clickable" style="min-height:235px;" data-ng-show="userProfile.avatar == null" ng-file-select="onFileSelect($files)" ng-file-drop="onFileSelect($files)" ng-file-drop-available="dropSupported=true" ng-file-drag-over-class="dragOverClass($event)" ng-file-drag-over-delay="100" accept="image/*">
                                        <div class="dz-default dz-message" data-ng-show="dataFiles.length == 0">
                                            <span>
                                                <span class="bolder ng-binding">Upload hình đại diện của bạn</span><br>
                                                <span class="bolder center">(150x150)</span><br>
                                                <i class="upload-icon icon-picture blue icon-3x"></i>
                                            </span>
                                        </div>
                                    <input type="file" class="dropzone dz-clickable" style="min-height: 235px; inset: 0px; opacity: 0; position: absolute; width: 100%;" data-ng-show="userProfile.avatar == null" ng-file-select="onFileSelect($files)" ng-file-drop="onFileSelect($files)" ng-file-drop-available="dropSupported=true" ng-file-drag-over-class="dragOverClass($event)" ng-file-drag-over-delay="100" accept="image/*"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div></div>
