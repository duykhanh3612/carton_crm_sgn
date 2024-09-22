<div class="col-xs-12 widget-container-span no-padding ng-scope">
    <div>
        <div class="widget-header header-color-blue">
            <h5 class="bigger lighter ng-binding">
                <i class="icon-user"></i>
                Nhân viên
            </h5>
            <div class="widget-toolbar">
                <a href="javascript:;" ng-click="refreshUserList();">
                    <i class="icon-refresh white"></i>
                </a>
                <a data-action="collapse">
                    <i class="icon-chevron-up white"></i>
                </a>
            </div>
            <div class="widget-toolbar no-border">
                <button class="btn btn-xs btn-white bigger ng-scope createUser">
                    <i class="icon-user blue"></i>
                    <span class="blue ng-binding">Tạo mới <span class="hidden-480 ng-binding">Nhân viên</span></span>
                </button>
            </div>
            <div class="widget-toolbar no-border">
                <!-- ngIf: userProfile.permission.isCreate -->
                <!-- end ngIf: userProfile.permission.isCreate -->
            </div>
        </div>
        <div class="widget-body">
            <div class="widget-main no-padding">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="ng-binding">Mã NV</th>
                            <th><span class="ng-binding">Nhân viên</span></th>
                            <th class="ng-binding">Thuộc nhóm</th>
                            {{-- <th class="ng-binding">Cửa hàng làm việc</th> --}}
                            <th class="text-center"><span class="ng-binding">Trạng thái</span></th>
                            <th class="text-center"><span class="ng-binding">Đổi mật khẩu</span></th>
                            <th class="text-center"><span class="hidden ng-binding">Ngôn ngữ</span></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $r)
                        <tr data-ng-repeat="user in users" class="ng-scope">
                            <td class="hidden-480 width-20">
                                <a data-ng-click="showEdit(user)" class="ng-binding ng-scope"
                                    data-value="{{$r->user_name}}">{{$r->user_name}}</a>
                            </td>
                            <td class="bolder">
                                <span class="ng-binding ng-scope"
                                    data-value="{{$r->full_name}}">{{$r->full_name}}</span>
                            </td>
                            <td class="user-role" data-value="{{json_encode($r->UserRoles->pluck('group_id')->toArray())}}">
                                @foreach ($r->UserRoles as $group)
                                <span class="label label-primary ng-binding ng-scope" style="margin-right: 5px;">
                                    <i class="fa fa-user hidden-480"></i> {{$group->group_name}}
                                </span>
                                @endforeach
                                {{-- <span class="label label-primary ng-binding ng-scope" style="margin-right: 5px;"
                                    data-ng-repeat="role in user.UserRoles">
                                    <i class="icon-user hidden-480"></i> Chủ cửa hàng
                                </span>
                                <span class="label label-primary ng-binding ng-scope" style="margin-right: 5px;"
                                    data-ng-repeat="role in user.UserRoles">
                                    <i class="icon-user hidden-480"></i> Quản lý
                                </span><span class="label label-primary ng-binding ng-scope" style="margin-right: 5px;"
                                    data-ng-repeat="role in user.UserRoles">
                                    <i class="icon-user hidden-480"></i> Nhân viên bán hàng
                                </span><span class="label label-primary ng-binding ng-scope" style="margin-right: 5px;"
                                    data-ng-repeat="role in user.UserRoles">
                                    <i class="icon-user hidden-480"></i> Nhân viên kho
                                </span><span class="label label-primary ng-binding ng-scope" style="margin-right: 5px;"
                                    data-ng-repeat="role in user.UserRoles">
                                    <i class="icon-user hidden-480"></i> Nhân viên thu ngân
                                </span> --}}
                                <!-- end ngIf: !user.$edit -->
                                <!-- end ngRepeat: role in user.UserRoles -->
                                <!-- ngRepeat: role in user.Roles -->
                            </td>

                            <td class="text-center">
                                <span data-activated="{{$r->activated}}"
                                    class="label {{$r->activated?'label-success':'label-danger'}} ng-scope"
                                    data-ng-class="user.IsActived == true ? 'label-success' : 'label-danger'">
                                    <i data-ng-class="user.IsActived == true ? 'icon-unlock' : 'icon-lock'"
                                        class="icon-unlock"></i>
                                    <span class="hidden-768 ng-binding"> {{$r->activated?'Hoạt động':'Đã khóa'}}</span>
                                </span>
                            </td>
                            <td class="text-center">
                                <i class="fa fa-key bigger-130 blue ng-scope openCreatePassword" title="Lấy lại mật khẩu"></i>
                            </td>
                            <td class="hidden text-center">
                                <div class="checkbox no-padding">
                                    <span class="ng-binding"> Tiếng Việt</span>
                                    <select data-ng-model="user.CultureInfo" class="ng-pristine ng-valid ng-hide">
                                        <option value=""></option>
                                        <option value="vi-VN" class="ng-binding">Tiếng Việt</option>
                                        <option value="en-US" class="ng-binding">Tiếng Anh</option>
                                    </select>
                                </div>
                            </td>
                            <td class="text-center hidden-480">
                                <i class="fa fa-edit bigger-130 blue ng-scope showEdit"></i>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr id="item-edit" data-ng-repeat="user in users" class="ng-scope ng-hide">
                            <td class="hidden-480 width-20">
                                <div class="input-group width-20 ng-scope">
                                    <input class="hidden-640 ng-pristine ng-valid ng-valid-pattern ng-valid-required"
                                        type="text" name="username" placeholder="Nhập mã nhân viên"
                                        style="border-radius: 3px 0px 0px 3px !important;"
                                        data-ng-model="user.prefixUserName" required="" ng-pattern="/^\w+$/">

                                </div>
                            </td>
                            <td class="bolder">
                                <input id="txtDisplayName120434" type="text" name="full_name" class="width-100 ng-scope" value="">
                            </td>
                            <td class="user-role hidden-640">
                                <div data-ng-if="user.$edit" class="checkbox no-padding ng-scope"
                                    style="margin-right: 5px;" data-ng-repeat="role in user.Roles">
                                    <label>
                                        <input name="cbUserRole120434" type="checkbox" class="ace"
                                            data-ng-value="role.Value" data-ng-checked="role.isDefault"
                                            data-ng-disabled="user.IsAdmin" value="1">
                                        <span class="lbl ng-binding">Chủ cửa hàng</span>
                                    </label>
                                </div>
                                <div data-ng-if="user.$edit" class="checkbox no-padding ng-scope"
                                    style="margin-right: 5px;" data-ng-repeat="role in user.Roles">
                                    <label>
                                        <input name="cbUserRole120434" type="checkbox" class="ace"
                                            data-ng-value="role.Value" data-ng-checked="role.isDefault"
                                            data-ng-disabled="user.IsAdmin" value="2">
                                        <span class="lbl ng-binding">Quản lý</span>
                                    </label>
                                </div>
                                <div data-ng-if="user.$edit" class="checkbox no-padding ng-scope"
                                    style="margin-right: 5px;" data-ng-repeat="role in user.Roles">
                                    <label>
                                        <input name="cbUserRole120434" type="checkbox" class="ace"
                                            data-ng-value="role.Value" data-ng-checked="role.isDefault"
                                            data-ng-disabled="user.IsAdmin" value="3">
                                        <span class="lbl ng-binding">Nhân viên bán hàng</span>
                                    </label>
                                </div>
                                <div data-ng-if="user.$edit" class="checkbox no-padding ng-scope"
                                    style="margin-right: 5px;" data-ng-repeat="role in user.Roles">
                                    <label>
                                        <input name="cbUserRole120434" type="checkbox" class="ace"
                                            data-ng-value="role.Value" data-ng-checked="role.isDefault"
                                            data-ng-disabled="user.IsAdmin" value="4">
                                        <span class="lbl ng-binding">Nhân viên kho</span>
                                    </label>
                                </div>
                                <div data-ng-if="user.$edit" class="checkbox no-padding ng-scope"
                                    style="margin-right: 5px;" data-ng-repeat="role in user.Roles">
                                    <label>
                                        <input name="cbUserRole120434" type="checkbox" class="ace"
                                            data-ng-value="role.Value" data-ng-checked="role.isDefault"
                                            data-ng-disabled="user.IsAdmin" value="5">
                                        <span class="lbl ng-binding">Nhân viên thu ngân</span>
                                    </label>
                                </div>
                            </td>

                            <td class="text-center">
                                <!-- ngIf: !user.$edit -->
                                <div class="checkbox no-padding ng-scope" data-ng-if="user.$edit">
                                    <label>
                                        <input name="actived" type="checkbox" class="ace">
                                        <span class="lbl hidden-480 ng-binding">Hoạt động ?</span>
                                    </label>
                                </div><!-- end ngIf: user.$edit -->
                            </td>
                            <td class="text-center">
                                <!-- ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                <i class="fa fa-key bigger-130 blue ng-scope" title="Lấy lại mật khẩu"
                                    data-ng-click="openCreatePassword(user)"
                                    data-ng-if="userProfile.permission.isUpdate &amp;&amp; (!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))"></i>
                                <!-- end ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                            </td>
                            <td class="hidden text-center">
                                <div class="checkbox no-padding">
                                    <span data-ng-show="!user.$edit" class="ng-binding ng-hide"> Tiếng Việt</span>
                                    <select data-ng-show="user.$edit" data-ng-model="user.CultureInfo"
                                        class="ng-pristine ng-valid">
                                        <option value="vi-VN" class="ng-binding">Tiếng Việt</option>
                                        <option value="en-US" class="ng-binding">Tiếng Anh</option>
                                    </select>
                                </div>
                            </td>
                            <td class="text-center hidden-480">
                                <!-- ngIf: !user.$edit -->
                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                <i data-ng-if="user.$edit &amp;&amp; (!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))"
                                    class="updateUser fa fa-save bigger-130 blue ng-scope" title="Lưu"></i>
                                <!-- end ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                <i data-ng-if="user.$edit" class="cancelEdit fa fa-undo bigger-130 blue ng-scope"
                                    title="Hủy" data-ng-click="user.$edit = false"></i>
                                <!-- end ngIf: user.$edit -->
                            </td>
                        </tr>
                        <tr id="item-show" class="ng-scope ng-hide">
                            <td class="hidden-480 width-20">
                                <!-- ngIf: !user.$edit || user.IsAdmin -->
                                <a data-ng-if="!user.$edit || user.IsAdmin" data-ng-click="showEdit(user)"
                                    class="ng-binding ng-scope">saigonnguyenco@gmail.com</a>
                                <!-- end ngIf: !user.$edit || user.IsAdmin -->
                                <!-- ngIf: user.$edit && !user.IsAdmin -->
                            </td>
                            <td class="bolder">
                                <!-- ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                <span
                                    data-ng-if="!user.$edit || !(!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))"
                                    class="ng-binding ng-scope">
                                    {{$r->full_name}}
                                </span>
                                <!-- end ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                <span class="show-480">
                                    <a data-ng-click="showEdit(user)" class="ng-binding">{{$r->email}}</a>
                                </span>
                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                            </td>
                            <td class="user-role">
                                <!-- ngRepeat: role in user.UserRoles -->
                                <!-- ngIf: !user.$edit -->
                                @foreach ($r->UserRoles as $group)
                                <span class="label label-primary ng-binding ng-scope" style="margin-right: 5px;">
                                    <i class="fa fa-user hidden-480"></i> {{$group->group_name}}
                                </span>
                                @endforeach
                                {{-- <span class="label label-primary ng-binding ng-scope" style="margin-right: 5px;"
                                    data-ng-repeat="role in user.UserRoles">
                                    <i class="icon-user hidden-480"></i> Chủ cửa hàng
                                </span>
                                <span class="label label-primary ng-binding ng-scope" style="margin-right: 5px;"
                                    data-ng-repeat="role in user.UserRoles">
                                    <i class="icon-user hidden-480"></i> Quản lý
                                </span><span class="label label-primary ng-binding ng-scope" style="margin-right: 5px;"
                                    data-ng-repeat="role in user.UserRoles">
                                    <i class="icon-user hidden-480"></i> Nhân viên bán hàng
                                </span><span class="label label-primary ng-binding ng-scope" style="margin-right: 5px;"
                                    data-ng-repeat="role in user.UserRoles">
                                    <i class="icon-user hidden-480"></i> Nhân viên kho
                                </span><span class="label label-primary ng-binding ng-scope" style="margin-right: 5px;"
                                    data-ng-repeat="role in user.UserRoles">
                                    <i class="icon-user hidden-480"></i> Nhân viên thu ngân
                                </span> --}}
                                <!-- end ngIf: !user.$edit -->
                                <!-- end ngRepeat: role in user.UserRoles -->
                                <!-- ngRepeat: role in user.Roles -->
                            </td>

                            <td class="text-center">
                                <!-- ngIf: !user.$edit -->
                                <span class="label label-success ng-scope"
                                    data-ng-class="user.IsActived == true ? 'label-success' : 'label-danger'">
                                    <i data-ng-class="user.IsActived == true ? 'icon-unlock' : 'icon-lock'"
                                        class="icon-unlock"></i>
                                    <span class="hidden-768 ng-binding">Hoạt động</span>
                                </span><!-- end ngIf: !user.$edit -->

                            </td>
                            <td class="text-center">
                                <!-- ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                <i class="fa fa-key bigger-130 blue ng-scope" title="Lấy lại mật khẩu"
                                    data-ng-click="openCreatePassword(user)"
                                    data-ng-if="userProfile.permission.isUpdate &amp;&amp; (!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))"></i>
                                <!-- end ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                            </td>
                            <td class="hidden text-center">
                                <div class="checkbox no-padding">
                                    <span data-ng-show="!user.$edit" class="ng-binding"> Tiếng Việt</span>
                                    <select data-ng-show="user.$edit" data-ng-model="user.CultureInfo"
                                        class="ng-pristine ng-valid ng-hide">
                                        <option value="? object:null ?"></option>
                                        <option value="vi-VN" class="ng-binding">Tiếng Việt</option>
                                        <option value="en-US" class="ng-binding">Tiếng Anh</option>
                                    </select>
                                </div>
                            </td>
                            <td class="text-center hidden-480">
                                <i class="fa fa-edit bigger-130 blue ng-scope showEdit"></i>
                            </td>
                        </tr>
                    </tfoot>
                </table>

            </div>
        </div>
        @include("admin::user.setting.view_function")
    </div>
</div>
@include("admin::user.setting.modal_change_pass")
@include("admin::user.setting.modal_create_user")
<div class="ng-hide" id="modalCreateUser">
    <form name="frmCreateUser" novalidate>
        <div class="modal-header no-padding">
            <div class="table-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"
                    data-ng-click="closeModal()">
                    <span class="white">×</span>
                </button>
                {{'Setting_Add_User' }}
            </div>
        </div>
        <div class="modal-body no-padding">
            <div class="row">
                <div class="col-xs-12 form-horizontal">
                    <div class="form-group" style="margin-top:10px;">
                        <label class="col-xs-3 control-label">{{'Setting_User_Name_Header' }}</label>
                        <div class="col-xs-9">
                            <input type="text" name="fullname" placeholder="{{'Setting_User_Name_Placeholder' }}"
                                class="width-100" data-ng-model="user.displayname" required ng-minlength="" />
                            <div class="red"
                                data-ng-show="frmCreateUser.fullname.$error.required && frmCreateUser.fullname.$dirty">
                                {{'Username_Required' }}.
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">{{'Setting_User_Code_Header' }}</label>
                        <div class="col-xs-9">
                            <div class="input-group">
                                <input type="text" name="username" placeholder="{{'Setting_User_Code_Placeholder' }}"
                                    class="form-control width-100" style="border-radius: 3px 0px 0px 3px !important;"
                                    data-ng-model="user.prefixUserName" required ng-pattern="/^\w+$/" />
                                <span class="input-group-addon bolder">
                                    .{{'companyCode'}}
                                </span>
                                <span class="input-group-addon bolder" title="Thay đổi mã cửa hàng"
                                    ng-click="changeCompanyCodeRequest();">
                                    <a href="javascript:;">
                                        <i class="icon-edit bigger-130 blue ng-scope"></i>
                                    </a>
                                </span>
                            </div>
                            <span class="red"
                                data-ng-show="frmCreateUser.username.$error.required && frmCreateUser.username.$dirty">{{'Setting_User_Name_Validation'
                                }}.</span>
                            <span class="red"
                                data-ng-show="frmCreateUser.username.$error.pattern && frmCreateUser.username.$dirty">{{'Setting_User_Code_Validation'
                                }}.</span>
                        </div>
                    </div>
                    <div class="form-group" ng-show="changeCompanyCodeRequesting==true">
                        <label class="col-xs-3 control-label"></label>
                        <div class="col-xs-9">
                            <div class="pull-right">
                                <div class="input-group">
                                    <input type="text" name="" placeholder="" class="form-control width-100"
                                        style="border-radius: 3px 0px 0px 3px !important;" ng-model="user.companyCode"
                                        ng-init="user.companyCode=companyCode" />
                                    <span class="input-group-addon bolder" title="Lưu" ng-click="saveCompanyCode();">
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
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">{{'Pass' }}</label>
                        <div class="col-xs-9">
                            <input type="password" name="password" placeholder="{{'Setting_User_Pass_Placeholder' }}"
                                class="width-100" data-ng-model="user.password" required data-ng-minlength="6" />
                            <span class="red"
                                data-ng-show="frmCreateUser.password.$error.required && frmCreateUser.password.$dirty">{{'Setting_User_Pass_Validation'
                                }}.</span>
                            <span class="red"
                                data-ng-show="frmCreateUser.password.$error.minlength && frmCreateUser.password.$dirty">{{'Setting_User_Pass_Length'
                                }}.</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">{{'Setting_User_Role' }}</label>
                        <div class="col-xs-9">
                            <div class="checkbox inline" data-ng-repeat="role in userroles">
                                <label style="padding-left:0px; padding-right:10px;">
                                    <input type="checkbox" class="ace" data-ng-model="role.IsDefault">
                                    <span class="lbl"> {{'role.RoleName'}}</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">{{'Setting_User_Store' }}</label>
                        <div class="col-xs-9">
                            <div class="checkbox inline" data-ng-repeat="store in stores">
                                <label style="padding-left:0px; padding-right:10px;">
                                    <input type="checkbox" class="ace" data-ng-model="store.IsDefault">
                                    <span class="lbl"> {{'store.StoreName'}}</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">{{'Language' }}</label>
                        <div class="col-xs-9">
                            <select data-ng-model="user.cultureInfo">
                                <option value="vi-VN">{{'Vietnamese' }}</option>
                                <option value="en-US">{{'English' }}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-sm btn-primary" data-ng-disabled="frmCreateUser.$invalid"
                data-ng-click="createUser()">
                <i class="fa fa-check"></i>
                {{'Save' }}
            </button>

            <button class="btn btn-sm" data-ng-click="closeModal()">
                <i class="icon-undo"></i>
                {{'Cancel' }}
            </button>
        </div>
    </form>
</div>

<script type="text/ng-template" id="modalCreateRole.html">
    <div class="modal-header no-padding">
        <div class="table-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" data-ng-click="closeModal()">
                <span class="white">×</span>
            </button>
            {{'Create' }} {{'Role' }}
        </div>
    </div>
    <div class="modal-body no-padding">
        <div class="row">
            <div class="col-xs-12 form-horizontal">
                <div class="form-group" style="margin-top:10px;">
                    <label class="col-xs-3 control-label">{{'Role' }}</label>
                    <div class="col-xs-9">
                        <input type="text" placeholder="{{'Role' }}" class="width-100" data-ng-model="roleModel.roleName" required ng-minlength="" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label">  {{'Setting_Role_Feature' }} </label>
                    <div class="col-xs-9">
                        <div class="checkbox inline" data-ng-repeat="feature in roleModel.features">
                            <label style="padding-left:0px; padding-right:10px;">
                                <input type="checkbox" class="ace" data-ng-model="feature.isDefault">
                                <span class="lbl"> {{'feature.name'}}</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-sm btn-primary" data-ng-click="createRole()">
            <i class="fa fa-check"></i>
            {{'Save' }}
        </button>

        <button class="btn btn-sm" data-ng-click="closeModal()">
            <i class="icon-undo"></i>
            {{'Cancel' }}
        </button>
    </div>
</script>


@push('js')
<link href="{{ module_mix('user/assets/setting/style.css') }}?ver=06112023" rel="stylesheet">
<script src="{{ module_mix('user/assets/setting/script.js') }}?ver=06112023"></script>
@endpush
