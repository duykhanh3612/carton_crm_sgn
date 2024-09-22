@extends('admin::layouts.master')
@section('header')
    @include('admin::components.header')
@endsection
@section('content')
    <div class="detailBlock">
        <nav class="mt-2">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button"
                        role="tab" aria-controls="nav-home" aria-selected="true"><i class="fa fa-user"></i> Nhân viên</button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                        type="button" role="tab" aria-controls="nav-profile" aria-selected="false"><i class="fa fa-cog"></i>Thông tin cửa hàng</button>
                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact"
                        type="button" role="tab" aria-controls="nav-contact" aria-selected="false"><i class="fa fa-cogs"></i>Thiết lập bán hàng</button>
            </div>
        </nav>
        <div class="tab-content no-border" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="col-xs-12 widget-container-span no-padding ng-scope" data-ng-controller="userController" data-ng-init="getUsers()">
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
                                <!-- ngIf: userProfile.permission.isCreate --><button class="btn btn-xs btn-white bigger ng-scope" data-ng-click="openCreateUser()" data-ng-if="userProfile.permission.isCreate">
                                    <i class="icon-user blue"></i>
                                    <span class="blue ng-binding">Tạo mới <span class="hidden-480 ng-binding">Nhân viên</span></span>
                                </button><!-- end ngIf: userProfile.permission.isCreate -->
                            </div>
                            <div class="widget-toolbar no-border">
                                <!-- ngIf: userProfile.permission.isCreate --><!-- end ngIf: userProfile.permission.isCreate -->
                            </div>
                        </div>
                        <div class="widget-body">
                            <div class="widget-main no-padding">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="hidden-480 ng-binding">Mã NV</th>
                                            <th><span class="hidden-640 ng-binding">Nhân viên</span></th>
                                            <th class="hidden-640 ng-binding">Thuộc nhóm</th>
                                            <th class="hidden-640 ng-binding">Cửa hàng làm việc</th>
                                            <th class="text-center"><span class="hidden-640 ng-binding">Trạng thái</span></th>
                                            <th class="text-center"><span class="hidden-640 ng-binding">Đổi mật khẩu</span></th>
                                            <th class="text-center"><span class="hidden-640 ng-binding">Ngôn ngữ</span></th>
                                            <th class="hidden-480"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- ngRepeat: user in users --><tr data-ng-repeat="user in users" class="ng-scope">
                                            <td class="hidden-480 width-20">
                                                <!-- ngIf: !user.$edit || user.IsAdmin --><a data-ng-if="!user.$edit || user.IsAdmin" data-ng-click="showEdit(user)" class="ng-binding ng-scope">saigonnguyenco@gmail.com</a><!-- end ngIf: !user.$edit || user.IsAdmin -->
                                                <!-- ngIf: user.$edit && !user.IsAdmin -->
                                            </td>
                                            <td class="bolder">
                                                <!-- ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><span data-ng-if="!user.$edit || !(!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))" class="ng-binding ng-scope">ADMIND SGN</span><!-- end ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <span class="show-480">
                                                    <a data-ng-click="showEdit(user)" class="ng-binding">saigonnguyenco@gmail.com</a>
                                                </span>
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Chủ cửa hàng
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Quản lý
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên bán hàng
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên kho
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên thu ngân
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles -->
                                                <!-- ngRepeat: role in user.Roles -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: store in user.UserInStores --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="store in user.UserInStores">
                                                    <i class="icon-truck hidden-480"></i> Ms Vi
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: store in user.UserInStores -->
                                                <!-- ngRepeat: store in user.Stores -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: !user.$edit --><span class="label label-success ng-scope" data-ng-if="!user.$edit" data-ng-class="user.IsActived == true ? 'label-success' : 'label-danger'"><i data-ng-class="user.IsActived == true ? 'icon-unlock' : 'icon-lock'" class="icon-unlock"></i> <span class="hidden-768 ng-binding">Hoạt động</span></span><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="text-center">
                                                <div class="checkbox no-padding">
                                                    <span data-ng-show="!user.$edit" class="ng-binding"> Tiếng Việt</span>
                                                    <select data-ng-show="user.$edit" data-ng-model="user.CultureInfo" class="ng-pristine ng-valid ng-hide"><option value="? object:null ?"></option>
                                                        <option value="vi-VN" class="ng-binding">Tiếng Việt</option>
                                                        <option value="en-US" class="ng-binding">Tiếng Anh</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="text-center hidden-480">
                                                <!-- ngIf: !user.$edit --><i class="icon-edit bigger-130 blue ng-scope" data-ng-if="!user.$edit" data-ng-click="showEdit(user)"></i><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                        </tr><!-- end ngRepeat: user in users --><tr data-ng-repeat="user in users" class="ng-scope">
                                            <td class="hidden-480 width-20">
                                                <!-- ngIf: !user.$edit || user.IsAdmin --><a data-ng-if="!user.$edit || user.IsAdmin" data-ng-click="showEdit(user)" class="ng-binding ng-scope">carton.cartonsgn</a><!-- end ngIf: !user.$edit || user.IsAdmin -->
                                                <!-- ngIf: user.$edit && !user.IsAdmin -->
                                            </td>
                                            <td class="bolder">
                                                <!-- ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><span data-ng-if="!user.$edit || !(!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))" class="ng-binding ng-scope">Kho Thủ Đức</span><!-- end ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <span class="show-480">
                                                    <a data-ng-click="showEdit(user)" class="ng-binding">carton.cartonsgn</a>
                                                </span>
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên bán hàng
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên kho
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles -->
                                                <!-- ngRepeat: role in user.Roles -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: store in user.UserInStores --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="store in user.UserInStores">
                                                    <i class="icon-truck hidden-480"></i> Ms Vi
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: store in user.UserInStores -->
                                                <!-- ngRepeat: store in user.Stores -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: !user.$edit --><span class="label label-success ng-scope" data-ng-if="!user.$edit" data-ng-class="user.IsActived == true ? 'label-success' : 'label-danger'"><i data-ng-class="user.IsActived == true ? 'icon-unlock' : 'icon-lock'" class="icon-unlock"></i> <span class="hidden-768 ng-binding">Hoạt động</span></span><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><i class="icon-key bigger-130 blue ng-scope" title="Lấy lại mật khẩu" data-ng-click="openCreatePassword(user)" data-ng-if="userProfile.permission.isUpdate &amp;&amp; (!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))"></i><!-- end ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="text-center">
                                                <div class="checkbox no-padding">
                                                    <span data-ng-show="!user.$edit" class="ng-binding"> Tiếng Việt</span>
                                                    <select data-ng-show="user.$edit" data-ng-model="user.CultureInfo" class="ng-pristine ng-valid ng-hide">
                                                        <option value="vi-VN" class="ng-binding">Tiếng Việt</option>
                                                        <option value="en-US" class="ng-binding">Tiếng Anh</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="text-center hidden-480">
                                                <!-- ngIf: !user.$edit --><i class="icon-edit bigger-130 blue ng-scope" data-ng-if="!user.$edit" data-ng-click="showEdit(user)"></i><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                        </tr><!-- end ngRepeat: user in users --><tr data-ng-repeat="user in users" class="ng-scope">
                                            <td class="hidden-480 width-20">
                                                <!-- ngIf: !user.$edit || user.IsAdmin --><a data-ng-if="!user.$edit || user.IsAdmin" data-ng-click="showEdit(user)" class="ng-binding ng-scope">kieungan.cartonsgn</a><!-- end ngIf: !user.$edit || user.IsAdmin -->
                                                <!-- ngIf: user.$edit && !user.IsAdmin -->
                                            </td>
                                            <td class="bolder">
                                                <!-- ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><span data-ng-if="!user.$edit || !(!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))" class="ng-binding ng-scope">Kiều Ngân</span><!-- end ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <span class="show-480">
                                                    <a data-ng-click="showEdit(user)" class="ng-binding">kieungan.cartonsgn</a>
                                                </span>
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên bán hàng
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên kho
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên thu ngân
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles -->
                                                <!-- ngRepeat: role in user.Roles -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: store in user.UserInStores --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="store in user.UserInStores">
                                                    <i class="icon-truck hidden-480"></i> Ms Vi
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: store in user.UserInStores -->
                                                <!-- ngRepeat: store in user.Stores -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: !user.$edit --><span class="label label-success ng-scope" data-ng-if="!user.$edit" data-ng-class="user.IsActived == true ? 'label-success' : 'label-danger'"><i data-ng-class="user.IsActived == true ? 'icon-unlock' : 'icon-lock'" class="icon-unlock"></i> <span class="hidden-768 ng-binding">Hoạt động</span></span><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><i class="icon-key bigger-130 blue ng-scope" title="Lấy lại mật khẩu" data-ng-click="openCreatePassword(user)" data-ng-if="userProfile.permission.isUpdate &amp;&amp; (!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))"></i><!-- end ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="text-center">
                                                <div class="checkbox no-padding">
                                                    <span data-ng-show="!user.$edit" class="ng-binding"> Tiếng Việt</span>
                                                    <select data-ng-show="user.$edit" data-ng-model="user.CultureInfo" class="ng-pristine ng-valid ng-hide">
                                                        <option value="vi-VN" class="ng-binding">Tiếng Việt</option>
                                                        <option value="en-US" class="ng-binding">Tiếng Anh</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="text-center hidden-480">
                                                <!-- ngIf: !user.$edit --><i class="icon-edit bigger-130 blue ng-scope" data-ng-if="!user.$edit" data-ng-click="showEdit(user)"></i><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                        </tr><!-- end ngRepeat: user in users --><tr data-ng-repeat="user in users" class="ng-scope">
                                            <td class="hidden-480 width-20">
                                                <!-- ngIf: !user.$edit || user.IsAdmin --><a data-ng-if="!user.$edit || user.IsAdmin" data-ng-click="showEdit(user)" class="ng-binding ng-scope">trung.cartonsgn</a><!-- end ngIf: !user.$edit || user.IsAdmin -->
                                                <!-- ngIf: user.$edit && !user.IsAdmin -->
                                            </td>
                                            <td class="bolder">
                                                <!-- ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><span data-ng-if="!user.$edit || !(!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))" class="ng-binding ng-scope">Phạm Đức Trung</span><!-- end ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <span class="show-480">
                                                    <a data-ng-click="showEdit(user)" class="ng-binding">trung.cartonsgn</a>
                                                </span>
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên bán hàng
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên kho
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles -->
                                                <!-- ngRepeat: role in user.Roles -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: store in user.UserInStores --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="store in user.UserInStores">
                                                    <i class="icon-truck hidden-480"></i> Ms Vi
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: store in user.UserInStores -->
                                                <!-- ngRepeat: store in user.Stores -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: !user.$edit --><span class="label label-success ng-scope" data-ng-if="!user.$edit" data-ng-class="user.IsActived == true ? 'label-success' : 'label-danger'"><i data-ng-class="user.IsActived == true ? 'icon-unlock' : 'icon-lock'" class="icon-unlock"></i> <span class="hidden-768 ng-binding">Hoạt động</span></span><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><i class="icon-key bigger-130 blue ng-scope" title="Lấy lại mật khẩu" data-ng-click="openCreatePassword(user)" data-ng-if="userProfile.permission.isUpdate &amp;&amp; (!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))"></i><!-- end ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="text-center">
                                                <div class="checkbox no-padding">
                                                    <span data-ng-show="!user.$edit" class="ng-binding"> Tiếng Việt</span>
                                                    <select data-ng-show="user.$edit" data-ng-model="user.CultureInfo" class="ng-pristine ng-valid ng-hide">
                                                        <option value="vi-VN" class="ng-binding">Tiếng Việt</option>
                                                        <option value="en-US" class="ng-binding">Tiếng Anh</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="text-center hidden-480">
                                                <!-- ngIf: !user.$edit --><i class="icon-edit bigger-130 blue ng-scope" data-ng-if="!user.$edit" data-ng-click="showEdit(user)"></i><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                        </tr><!-- end ngRepeat: user in users --><tr data-ng-repeat="user in users" class="ng-scope">
                                            <td class="hidden-480 width-20">
                                                <!-- ngIf: !user.$edit || user.IsAdmin --><a data-ng-if="!user.$edit || user.IsAdmin" data-ng-click="showEdit(user)" class="ng-binding ng-scope">tthngoc.cartonsgn</a><!-- end ngIf: !user.$edit || user.IsAdmin -->
                                                <!-- ngIf: user.$edit && !user.IsAdmin -->
                                            </td>
                                            <td class="bolder">
                                                <!-- ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><span data-ng-if="!user.$edit || !(!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))" class="ng-binding ng-scope">Hồng Ngọc</span><!-- end ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <span class="show-480">
                                                    <a data-ng-click="showEdit(user)" class="ng-binding">tthngoc.cartonsgn</a>
                                                </span>
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên bán hàng
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên kho
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên thu ngân
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles -->
                                                <!-- ngRepeat: role in user.Roles -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: store in user.UserInStores --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="store in user.UserInStores">
                                                    <i class="icon-truck hidden-480"></i> Ms Vi
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: store in user.UserInStores -->
                                                <!-- ngRepeat: store in user.Stores -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: !user.$edit --><span class="label label-success ng-scope" data-ng-if="!user.$edit" data-ng-class="user.IsActived == true ? 'label-success' : 'label-danger'"><i data-ng-class="user.IsActived == true ? 'icon-unlock' : 'icon-lock'" class="icon-unlock"></i> <span class="hidden-768 ng-binding">Hoạt động</span></span><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><i class="icon-key bigger-130 blue ng-scope" title="Lấy lại mật khẩu" data-ng-click="openCreatePassword(user)" data-ng-if="userProfile.permission.isUpdate &amp;&amp; (!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))"></i><!-- end ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="text-center">
                                                <div class="checkbox no-padding">
                                                    <span data-ng-show="!user.$edit" class="ng-binding"> Tiếng Việt</span>
                                                    <select data-ng-show="user.$edit" data-ng-model="user.CultureInfo" class="ng-pristine ng-valid ng-hide">
                                                        <option value="vi-VN" class="ng-binding">Tiếng Việt</option>
                                                        <option value="en-US" class="ng-binding">Tiếng Anh</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="text-center hidden-480">
                                                <!-- ngIf: !user.$edit --><i class="icon-edit bigger-130 blue ng-scope" data-ng-if="!user.$edit" data-ng-click="showEdit(user)"></i><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                        </tr><!-- end ngRepeat: user in users --><tr data-ng-repeat="user in users" class="ng-scope">
                                            <td class="hidden-480 width-20">
                                                <!-- ngIf: !user.$edit || user.IsAdmin --><a data-ng-if="!user.$edit || user.IsAdmin" data-ng-click="showEdit(user)" class="ng-binding ng-scope">xuongq12.cartonsgn</a><!-- end ngIf: !user.$edit || user.IsAdmin -->
                                                <!-- ngIf: user.$edit && !user.IsAdmin -->
                                            </td>
                                            <td class="bolder">
                                                <!-- ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><span data-ng-if="!user.$edit || !(!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))" class="ng-binding ng-scope"> Chị Hà</span><!-- end ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <span class="show-480">
                                                    <a data-ng-click="showEdit(user)" class="ng-binding">xuongq12.cartonsgn</a>
                                                </span>
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên bán hàng
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên kho
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles -->
                                                <!-- ngRepeat: role in user.Roles -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: store in user.UserInStores --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="store in user.UserInStores">
                                                    <i class="icon-truck hidden-480"></i> Ms Vi
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: store in user.UserInStores -->
                                                <!-- ngRepeat: store in user.Stores -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: !user.$edit --><span class="label label-success ng-scope label-danger" data-ng-if="!user.$edit" data-ng-class="user.IsActived == true ? 'label-success' : 'label-danger'"><i data-ng-class="user.IsActived == true ? 'icon-unlock' : 'icon-lock'" class="icon-lock"></i> <span class="hidden-768 ng-binding">Đã khóa</span></span><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><i class="icon-key bigger-130 blue ng-scope" title="Lấy lại mật khẩu" data-ng-click="openCreatePassword(user)" data-ng-if="userProfile.permission.isUpdate &amp;&amp; (!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))"></i><!-- end ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="text-center">
                                                <div class="checkbox no-padding">
                                                    <span data-ng-show="!user.$edit" class="ng-binding"> Tiếng Việt</span>
                                                    <select data-ng-show="user.$edit" data-ng-model="user.CultureInfo" class="ng-pristine ng-valid ng-hide">
                                                        <option value="vi-VN" class="ng-binding">Tiếng Việt</option>
                                                        <option value="en-US" class="ng-binding">Tiếng Anh</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="text-center hidden-480">
                                                <!-- ngIf: !user.$edit --><i class="icon-edit bigger-130 blue ng-scope" data-ng-if="!user.$edit" data-ng-click="showEdit(user)"></i><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                        </tr><!-- end ngRepeat: user in users --><tr data-ng-repeat="user in users" class="ng-scope">
                                            <td class="hidden-480 width-20">
                                                <!-- ngIf: !user.$edit || user.IsAdmin --><a data-ng-if="!user.$edit || user.IsAdmin" data-ng-click="showEdit(user)" class="ng-binding ng-scope">xuongsgn.cartonsgn</a><!-- end ngIf: !user.$edit || user.IsAdmin -->
                                                <!-- ngIf: user.$edit && !user.IsAdmin -->
                                            </td>
                                            <td class="bolder">
                                                <!-- ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><span data-ng-if="!user.$edit || !(!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))" class="ng-binding ng-scope"> Hồng Ngọc (Xưởng)</span><!-- end ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <span class="show-480">
                                                    <a data-ng-click="showEdit(user)" class="ng-binding">xuongsgn.cartonsgn</a>
                                                </span>
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên bán hàng
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên kho
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles -->
                                                <!-- ngRepeat: role in user.Roles -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: store in user.UserInStores --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="store in user.UserInStores">
                                                    <i class="icon-truck hidden-480"></i> Ms Vi
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: store in user.UserInStores -->
                                                <!-- ngRepeat: store in user.Stores -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: !user.$edit --><span class="label label-success ng-scope" data-ng-if="!user.$edit" data-ng-class="user.IsActived == true ? 'label-success' : 'label-danger'"><i data-ng-class="user.IsActived == true ? 'icon-unlock' : 'icon-lock'" class="icon-unlock"></i> <span class="hidden-768 ng-binding">Hoạt động</span></span><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><i class="icon-key bigger-130 blue ng-scope" title="Lấy lại mật khẩu" data-ng-click="openCreatePassword(user)" data-ng-if="userProfile.permission.isUpdate &amp;&amp; (!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))"></i><!-- end ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="text-center">
                                                <div class="checkbox no-padding">
                                                    <span data-ng-show="!user.$edit" class="ng-binding"> Tiếng Việt</span>
                                                    <select data-ng-show="user.$edit" data-ng-model="user.CultureInfo" class="ng-pristine ng-valid ng-hide">
                                                        <option value="vi-VN" class="ng-binding">Tiếng Việt</option>
                                                        <option value="en-US" class="ng-binding">Tiếng Anh</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="text-center hidden-480">
                                                <!-- ngIf: !user.$edit --><i class="icon-edit bigger-130 blue ng-scope" data-ng-if="!user.$edit" data-ng-click="showEdit(user)"></i><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                        </tr><!-- end ngRepeat: user in users --><tr data-ng-repeat="user in users" class="ng-scope">
                                            <td class="hidden-480 width-20">
                                                <!-- ngIf: !user.$edit || user.IsAdmin --><a data-ng-if="!user.$edit || user.IsAdmin" data-ng-click="showEdit(user)" class="ng-binding ng-scope">tien.cartonsgn</a><!-- end ngIf: !user.$edit || user.IsAdmin -->
                                                <!-- ngIf: user.$edit && !user.IsAdmin -->
                                            </td>
                                            <td class="bolder">
                                                <!-- ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><span data-ng-if="!user.$edit || !(!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))" class="ng-binding ng-scope">Hữu Tiến</span><!-- end ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <span class="show-480">
                                                    <a data-ng-click="showEdit(user)" class="ng-binding">tien.cartonsgn</a>
                                                </span>
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên bán hàng
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên kho
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles -->
                                                <!-- ngRepeat: role in user.Roles -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: store in user.UserInStores --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="store in user.UserInStores">
                                                    <i class="icon-truck hidden-480"></i> Ms Vi
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: store in user.UserInStores -->
                                                <!-- ngRepeat: store in user.Stores -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: !user.$edit --><span class="label label-success ng-scope" data-ng-if="!user.$edit" data-ng-class="user.IsActived == true ? 'label-success' : 'label-danger'"><i data-ng-class="user.IsActived == true ? 'icon-unlock' : 'icon-lock'" class="icon-unlock"></i> <span class="hidden-768 ng-binding">Hoạt động</span></span><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><i class="icon-key bigger-130 blue ng-scope" title="Lấy lại mật khẩu" data-ng-click="openCreatePassword(user)" data-ng-if="userProfile.permission.isUpdate &amp;&amp; (!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))"></i><!-- end ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="text-center">
                                                <div class="checkbox no-padding">
                                                    <span data-ng-show="!user.$edit" class="ng-binding"> Tiếng Việt</span>
                                                    <select data-ng-show="user.$edit" data-ng-model="user.CultureInfo" class="ng-pristine ng-valid ng-hide">
                                                        <option value="vi-VN" class="ng-binding">Tiếng Việt</option>
                                                        <option value="en-US" class="ng-binding">Tiếng Anh</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="text-center hidden-480">
                                                <!-- ngIf: !user.$edit --><i class="icon-edit bigger-130 blue ng-scope" data-ng-if="!user.$edit" data-ng-click="showEdit(user)"></i><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                        </tr><!-- end ngRepeat: user in users --><tr data-ng-repeat="user in users" class="ng-scope">
                                            <td class="hidden-480 width-20">
                                                <!-- ngIf: !user.$edit || user.IsAdmin --><a data-ng-if="!user.$edit || user.IsAdmin" data-ng-click="showEdit(user)" class="ng-binding ng-scope">banletanphu.cartonsgn</a><!-- end ngIf: !user.$edit || user.IsAdmin -->
                                                <!-- ngIf: user.$edit && !user.IsAdmin -->
                                            </td>
                                            <td class="bolder">
                                                <!-- ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><span data-ng-if="!user.$edit || !(!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))" class="ng-binding ng-scope">Kho Tân Phú</span><!-- end ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <span class="show-480">
                                                    <a data-ng-click="showEdit(user)" class="ng-binding">banletanphu.cartonsgn</a>
                                                </span>
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên bán hàng
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên kho
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles -->
                                                <!-- ngRepeat: role in user.Roles -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: store in user.UserInStores --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="store in user.UserInStores">
                                                    <i class="icon-truck hidden-480"></i> Ms Vi
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: store in user.UserInStores -->
                                                <!-- ngRepeat: store in user.Stores -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: !user.$edit --><span class="label label-success ng-scope" data-ng-if="!user.$edit" data-ng-class="user.IsActived == true ? 'label-success' : 'label-danger'"><i data-ng-class="user.IsActived == true ? 'icon-unlock' : 'icon-lock'" class="icon-unlock"></i> <span class="hidden-768 ng-binding">Hoạt động</span></span><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><i class="icon-key bigger-130 blue ng-scope" title="Lấy lại mật khẩu" data-ng-click="openCreatePassword(user)" data-ng-if="userProfile.permission.isUpdate &amp;&amp; (!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))"></i><!-- end ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="text-center">
                                                <div class="checkbox no-padding">
                                                    <span data-ng-show="!user.$edit" class="ng-binding"> Tiếng Việt</span>
                                                    <select data-ng-show="user.$edit" data-ng-model="user.CultureInfo" class="ng-pristine ng-valid ng-hide">
                                                        <option value="vi-VN" class="ng-binding">Tiếng Việt</option>
                                                        <option value="en-US" class="ng-binding">Tiếng Anh</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="text-center hidden-480">
                                                <!-- ngIf: !user.$edit --><i class="icon-edit bigger-130 blue ng-scope" data-ng-if="!user.$edit" data-ng-click="showEdit(user)"></i><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                        </tr><!-- end ngRepeat: user in users --><tr data-ng-repeat="user in users" class="ng-scope">
                                            <td class="hidden-480 width-20">
                                                <!-- ngIf: !user.$edit || user.IsAdmin --><a data-ng-if="!user.$edit || user.IsAdmin" data-ng-click="showEdit(user)" class="ng-binding ng-scope">diem.cartonsgn</a><!-- end ngIf: !user.$edit || user.IsAdmin -->
                                                <!-- ngIf: user.$edit && !user.IsAdmin -->
                                            </td>
                                            <td class="bolder">
                                                <!-- ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><span data-ng-if="!user.$edit || !(!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))" class="ng-binding ng-scope">Mỹ Diễm</span><!-- end ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <span class="show-480">
                                                    <a data-ng-click="showEdit(user)" class="ng-binding">diem.cartonsgn</a>
                                                </span>
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Chủ cửa hàng
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Quản lý
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên bán hàng
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên kho
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên thu ngân
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles -->
                                                <!-- ngRepeat: role in user.Roles -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: store in user.UserInStores --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="store in user.UserInStores">
                                                    <i class="icon-truck hidden-480"></i> Ms Vi
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: store in user.UserInStores -->
                                                <!-- ngRepeat: store in user.Stores -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: !user.$edit --><span class="label label-success ng-scope" data-ng-if="!user.$edit" data-ng-class="user.IsActived == true ? 'label-success' : 'label-danger'"><i data-ng-class="user.IsActived == true ? 'icon-unlock' : 'icon-lock'" class="icon-unlock"></i> <span class="hidden-768 ng-binding">Hoạt động</span></span><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><i class="icon-key bigger-130 blue ng-scope" title="Lấy lại mật khẩu" data-ng-click="openCreatePassword(user)" data-ng-if="userProfile.permission.isUpdate &amp;&amp; (!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))"></i><!-- end ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="text-center">
                                                <div class="checkbox no-padding">
                                                    <span data-ng-show="!user.$edit" class="ng-binding"> Tiếng Việt</span>
                                                    <select data-ng-show="user.$edit" data-ng-model="user.CultureInfo" class="ng-pristine ng-valid ng-hide">
                                                        <option value="vi-VN" class="ng-binding">Tiếng Việt</option>
                                                        <option value="en-US" class="ng-binding">Tiếng Anh</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="text-center hidden-480">
                                                <!-- ngIf: !user.$edit --><i class="icon-edit bigger-130 blue ng-scope" data-ng-if="!user.$edit" data-ng-click="showEdit(user)"></i><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                        </tr><!-- end ngRepeat: user in users --><tr data-ng-repeat="user in users" class="ng-scope">
                                            <td class="hidden-480 width-20">
                                                <!-- ngIf: !user.$edit || user.IsAdmin --><a data-ng-if="!user.$edit || user.IsAdmin" data-ng-click="showEdit(user)" class="ng-binding ng-scope">thunhi.cartonsgn</a><!-- end ngIf: !user.$edit || user.IsAdmin -->
                                                <!-- ngIf: user.$edit && !user.IsAdmin -->
                                            </td>
                                            <td class="bolder">
                                                <!-- ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><span data-ng-if="!user.$edit || !(!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))" class="ng-binding ng-scope">Thu Nhi</span><!-- end ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <span class="show-480">
                                                    <a data-ng-click="showEdit(user)" class="ng-binding">thunhi.cartonsgn</a>
                                                </span>
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Chủ cửa hàng
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Quản lý
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên bán hàng
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên kho
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên thu ngân
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles -->
                                                <!-- ngRepeat: role in user.Roles -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: store in user.UserInStores --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="store in user.UserInStores">
                                                    <i class="icon-truck hidden-480"></i> Ms Vi
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: store in user.UserInStores -->
                                                <!-- ngRepeat: store in user.Stores -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: !user.$edit --><span class="label label-success ng-scope" data-ng-if="!user.$edit" data-ng-class="user.IsActived == true ? 'label-success' : 'label-danger'"><i data-ng-class="user.IsActived == true ? 'icon-unlock' : 'icon-lock'" class="icon-unlock"></i> <span class="hidden-768 ng-binding">Hoạt động</span></span><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><i class="icon-key bigger-130 blue ng-scope" title="Lấy lại mật khẩu" data-ng-click="openCreatePassword(user)" data-ng-if="userProfile.permission.isUpdate &amp;&amp; (!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))"></i><!-- end ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="text-center">
                                                <div class="checkbox no-padding">
                                                    <span data-ng-show="!user.$edit" class="ng-binding"> Tiếng Việt</span>
                                                    <select data-ng-show="user.$edit" data-ng-model="user.CultureInfo" class="ng-pristine ng-valid ng-hide">
                                                        <option value="vi-VN" class="ng-binding">Tiếng Việt</option>
                                                        <option value="en-US" class="ng-binding">Tiếng Anh</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="text-center hidden-480">
                                                <!-- ngIf: !user.$edit --><i class="icon-edit bigger-130 blue ng-scope" data-ng-if="!user.$edit" data-ng-click="showEdit(user)"></i><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                        </tr><!-- end ngRepeat: user in users --><tr data-ng-repeat="user in users" class="ng-scope">
                                            <td class="hidden-480 width-20">
                                                <!-- ngIf: !user.$edit || user.IsAdmin --><a data-ng-if="!user.$edit || user.IsAdmin" data-ng-click="showEdit(user)" class="ng-binding ng-scope">sgn1.cartonsgn</a><!-- end ngIf: !user.$edit || user.IsAdmin -->
                                                <!-- ngIf: user.$edit && !user.IsAdmin -->
                                            </td>
                                            <td class="bolder">
                                                <!-- ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><span data-ng-if="!user.$edit || !(!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))" class="ng-binding ng-scope">Fast Box</span><!-- end ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <span class="show-480">
                                                    <a data-ng-click="showEdit(user)" class="ng-binding">sgn1.cartonsgn</a>
                                                </span>
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Chủ cửa hàng
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Quản lý
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên bán hàng
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên kho
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên thu ngân
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles -->
                                                <!-- ngRepeat: role in user.Roles -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: store in user.UserInStores --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="store in user.UserInStores">
                                                    <i class="icon-truck hidden-480"></i> Ms Vi
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: store in user.UserInStores -->
                                                <!-- ngRepeat: store in user.Stores -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: !user.$edit --><span class="label label-success ng-scope" data-ng-if="!user.$edit" data-ng-class="user.IsActived == true ? 'label-success' : 'label-danger'"><i data-ng-class="user.IsActived == true ? 'icon-unlock' : 'icon-lock'" class="icon-unlock"></i> <span class="hidden-768 ng-binding">Hoạt động</span></span><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><i class="icon-key bigger-130 blue ng-scope" title="Lấy lại mật khẩu" data-ng-click="openCreatePassword(user)" data-ng-if="userProfile.permission.isUpdate &amp;&amp; (!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))"></i><!-- end ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="text-center">
                                                <div class="checkbox no-padding">
                                                    <span data-ng-show="!user.$edit" class="ng-binding"> Tiếng Việt</span>
                                                    <select data-ng-show="user.$edit" data-ng-model="user.CultureInfo" class="ng-pristine ng-valid ng-hide">
                                                        <option value="vi-VN" class="ng-binding">Tiếng Việt</option>
                                                        <option value="en-US" class="ng-binding">Tiếng Anh</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="text-center hidden-480">
                                                <!-- ngIf: !user.$edit --><i class="icon-edit bigger-130 blue ng-scope" data-ng-if="!user.$edit" data-ng-click="showEdit(user)"></i><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                        </tr><!-- end ngRepeat: user in users --><tr data-ng-repeat="user in users" class="ng-scope">
                                            <td class="hidden-480 width-20">
                                                <!-- ngIf: !user.$edit || user.IsAdmin --><a data-ng-if="!user.$edit || user.IsAdmin" data-ng-click="showEdit(user)" class="ng-binding ng-scope">kimthoa.cartonsgn</a><!-- end ngIf: !user.$edit || user.IsAdmin -->
                                                <!-- ngIf: user.$edit && !user.IsAdmin -->
                                            </td>
                                            <td class="bolder">
                                                <!-- ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><span data-ng-if="!user.$edit || !(!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))" class="ng-binding ng-scope"> Kim Thoa</span><!-- end ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <span class="show-480">
                                                    <a data-ng-click="showEdit(user)" class="ng-binding">kimthoa.cartonsgn</a>
                                                </span>
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên bán hàng
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên kho
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên thu ngân
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles -->
                                                <!-- ngRepeat: role in user.Roles -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: store in user.UserInStores --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="store in user.UserInStores">
                                                    <i class="icon-truck hidden-480"></i> Ms Vi
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: store in user.UserInStores -->
                                                <!-- ngRepeat: store in user.Stores -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: !user.$edit --><span class="label label-success ng-scope" data-ng-if="!user.$edit" data-ng-class="user.IsActived == true ? 'label-success' : 'label-danger'"><i data-ng-class="user.IsActived == true ? 'icon-unlock' : 'icon-lock'" class="icon-unlock"></i> <span class="hidden-768 ng-binding">Hoạt động</span></span><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><i class="icon-key bigger-130 blue ng-scope" title="Lấy lại mật khẩu" data-ng-click="openCreatePassword(user)" data-ng-if="userProfile.permission.isUpdate &amp;&amp; (!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))"></i><!-- end ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="text-center">
                                                <div class="checkbox no-padding">
                                                    <span data-ng-show="!user.$edit" class="ng-binding"> Tiếng Việt</span>
                                                    <select data-ng-show="user.$edit" data-ng-model="user.CultureInfo" class="ng-pristine ng-valid ng-hide">
                                                        <option value="vi-VN" class="ng-binding">Tiếng Việt</option>
                                                        <option value="en-US" class="ng-binding">Tiếng Anh</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="text-center hidden-480">
                                                <!-- ngIf: !user.$edit --><i class="icon-edit bigger-130 blue ng-scope" data-ng-if="!user.$edit" data-ng-click="showEdit(user)"></i><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                        </tr><!-- end ngRepeat: user in users --><tr data-ng-repeat="user in users" class="ng-scope">
                                            <td class="hidden-480 width-20">
                                                <!-- ngIf: !user.$edit || user.IsAdmin --><a data-ng-if="!user.$edit || user.IsAdmin" data-ng-click="showEdit(user)" class="ng-binding ng-scope">sgn02.cartonsgn</a><!-- end ngIf: !user.$edit || user.IsAdmin -->
                                                <!-- ngIf: user.$edit && !user.IsAdmin -->
                                            </td>
                                            <td class="bolder">
                                                <!-- ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><span data-ng-if="!user.$edit || !(!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))" class="ng-binding ng-scope">Kiều Ngân (Xưởng)</span><!-- end ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <span class="show-480">
                                                    <a data-ng-click="showEdit(user)" class="ng-binding">sgn02.cartonsgn</a>
                                                </span>
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên bán hàng
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên kho
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles -->
                                                <!-- ngRepeat: role in user.Roles -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: store in user.UserInStores --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="store in user.UserInStores">
                                                    <i class="icon-truck hidden-480"></i> Ms Vi
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: store in user.UserInStores -->
                                                <!-- ngRepeat: store in user.Stores -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: !user.$edit --><span class="label label-success ng-scope" data-ng-if="!user.$edit" data-ng-class="user.IsActived == true ? 'label-success' : 'label-danger'"><i data-ng-class="user.IsActived == true ? 'icon-unlock' : 'icon-lock'" class="icon-unlock"></i> <span class="hidden-768 ng-binding">Hoạt động</span></span><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><i class="icon-key bigger-130 blue ng-scope" title="Lấy lại mật khẩu" data-ng-click="openCreatePassword(user)" data-ng-if="userProfile.permission.isUpdate &amp;&amp; (!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))"></i><!-- end ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="text-center">
                                                <div class="checkbox no-padding">
                                                    <span data-ng-show="!user.$edit" class="ng-binding"> Tiếng Việt</span>
                                                    <select data-ng-show="user.$edit" data-ng-model="user.CultureInfo" class="ng-pristine ng-valid ng-hide">
                                                        <option value="vi-VN" class="ng-binding">Tiếng Việt</option>
                                                        <option value="en-US" class="ng-binding">Tiếng Anh</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="text-center hidden-480">
                                                <!-- ngIf: !user.$edit --><i class="icon-edit bigger-130 blue ng-scope" data-ng-if="!user.$edit" data-ng-click="showEdit(user)"></i><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                        </tr><!-- end ngRepeat: user in users --><tr data-ng-repeat="user in users" class="ng-scope">
                                            <td class="hidden-480 width-20">
                                                <!-- ngIf: !user.$edit || user.IsAdmin --><a data-ng-if="!user.$edit || user.IsAdmin" data-ng-click="showEdit(user)" class="ng-binding ng-scope">huutienxuong.cartonsgn</a><!-- end ngIf: !user.$edit || user.IsAdmin -->
                                                <!-- ngIf: user.$edit && !user.IsAdmin -->
                                            </td>
                                            <td class="bolder">
                                                <!-- ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><span data-ng-if="!user.$edit || !(!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))" class="ng-binding ng-scope">Tiến - Xưởng</span><!-- end ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <span class="show-480">
                                                    <a data-ng-click="showEdit(user)" class="ng-binding">huutienxuong.cartonsgn</a>
                                                </span>
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên bán hàng
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên kho
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles -->
                                                <!-- ngRepeat: role in user.Roles -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: store in user.UserInStores --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="store in user.UserInStores">
                                                    <i class="icon-truck hidden-480"></i> Ms Vi
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: store in user.UserInStores -->
                                                <!-- ngRepeat: store in user.Stores -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: !user.$edit --><span class="label label-success ng-scope" data-ng-if="!user.$edit" data-ng-class="user.IsActived == true ? 'label-success' : 'label-danger'"><i data-ng-class="user.IsActived == true ? 'icon-unlock' : 'icon-lock'" class="icon-unlock"></i> <span class="hidden-768 ng-binding">Hoạt động</span></span><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><i class="icon-key bigger-130 blue ng-scope" title="Lấy lại mật khẩu" data-ng-click="openCreatePassword(user)" data-ng-if="userProfile.permission.isUpdate &amp;&amp; (!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))"></i><!-- end ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="text-center">
                                                <div class="checkbox no-padding">
                                                    <span data-ng-show="!user.$edit" class="ng-binding"> Tiếng Việt</span>
                                                    <select data-ng-show="user.$edit" data-ng-model="user.CultureInfo" class="ng-pristine ng-valid ng-hide">
                                                        <option value="vi-VN" class="ng-binding">Tiếng Việt</option>
                                                        <option value="en-US" class="ng-binding">Tiếng Anh</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="text-center hidden-480">
                                                <!-- ngIf: !user.$edit --><i class="icon-edit bigger-130 blue ng-scope" data-ng-if="!user.$edit" data-ng-click="showEdit(user)"></i><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                        </tr><!-- end ngRepeat: user in users --><tr data-ng-repeat="user in users" class="ng-scope">
                                            <td class="hidden-480 width-20">
                                                <!-- ngIf: !user.$edit || user.IsAdmin --><a data-ng-if="!user.$edit || user.IsAdmin" data-ng-click="showEdit(user)" class="ng-binding ng-scope">banlequan8.cartonsgn</a><!-- end ngIf: !user.$edit || user.IsAdmin -->
                                                <!-- ngIf: user.$edit && !user.IsAdmin -->
                                            </td>
                                            <td class="bolder">
                                                <!-- ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><span data-ng-if="!user.$edit || !(!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))" class="ng-binding ng-scope">Kho Quận 8</span><!-- end ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <span class="show-480">
                                                    <a data-ng-click="showEdit(user)" class="ng-binding">banlequan8.cartonsgn</a>
                                                </span>
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên bán hàng
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên kho
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles -->
                                                <!-- ngRepeat: role in user.Roles -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: store in user.UserInStores --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="store in user.UserInStores">
                                                    <i class="icon-truck hidden-480"></i> Ms Vi
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: store in user.UserInStores -->
                                                <!-- ngRepeat: store in user.Stores -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: !user.$edit --><span class="label label-success ng-scope" data-ng-if="!user.$edit" data-ng-class="user.IsActived == true ? 'label-success' : 'label-danger'"><i data-ng-class="user.IsActived == true ? 'icon-unlock' : 'icon-lock'" class="icon-unlock"></i> <span class="hidden-768 ng-binding">Hoạt động</span></span><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><i class="icon-key bigger-130 blue ng-scope" title="Lấy lại mật khẩu" data-ng-click="openCreatePassword(user)" data-ng-if="userProfile.permission.isUpdate &amp;&amp; (!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))"></i><!-- end ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="text-center">
                                                <div class="checkbox no-padding">
                                                    <span data-ng-show="!user.$edit" class="ng-binding"> Tiếng Việt</span>
                                                    <select data-ng-show="user.$edit" data-ng-model="user.CultureInfo" class="ng-pristine ng-valid ng-hide">
                                                        <option value="vi-VN" class="ng-binding">Tiếng Việt</option>
                                                        <option value="en-US" class="ng-binding">Tiếng Anh</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="text-center hidden-480">
                                                <!-- ngIf: !user.$edit --><i class="icon-edit bigger-130 blue ng-scope" data-ng-if="!user.$edit" data-ng-click="showEdit(user)"></i><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                        </tr><!-- end ngRepeat: user in users --><tr data-ng-repeat="user in users" class="ng-scope">
                                            <td class="hidden-480 width-20">
                                                <!-- ngIf: !user.$edit || user.IsAdmin --><a data-ng-if="!user.$edit || user.IsAdmin" data-ng-click="showEdit(user)" class="ng-binding ng-scope">banleq11.cartonsgn</a><!-- end ngIf: !user.$edit || user.IsAdmin -->
                                                <!-- ngIf: user.$edit && !user.IsAdmin -->
                                            </td>
                                            <td class="bolder">
                                                <!-- ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><span data-ng-if="!user.$edit || !(!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))" class="ng-binding ng-scope"> Kho Quận 11</span><!-- end ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <span class="show-480">
                                                    <a data-ng-click="showEdit(user)" class="ng-binding">banleq11.cartonsgn</a>
                                                </span>
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên bán hàng
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên kho
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles -->
                                                <!-- ngRepeat: role in user.Roles -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: store in user.UserInStores --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="store in user.UserInStores">
                                                    <i class="icon-truck hidden-480"></i> Ms Vi
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: store in user.UserInStores -->
                                                <!-- ngRepeat: store in user.Stores -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: !user.$edit --><span class="label label-success ng-scope" data-ng-if="!user.$edit" data-ng-class="user.IsActived == true ? 'label-success' : 'label-danger'"><i data-ng-class="user.IsActived == true ? 'icon-unlock' : 'icon-lock'" class="icon-unlock"></i> <span class="hidden-768 ng-binding">Hoạt động</span></span><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><i class="icon-key bigger-130 blue ng-scope" title="Lấy lại mật khẩu" data-ng-click="openCreatePassword(user)" data-ng-if="userProfile.permission.isUpdate &amp;&amp; (!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))"></i><!-- end ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="text-center">
                                                <div class="checkbox no-padding">
                                                    <span data-ng-show="!user.$edit" class="ng-binding"> Tiếng Việt</span>
                                                    <select data-ng-show="user.$edit" data-ng-model="user.CultureInfo" class="ng-pristine ng-valid ng-hide">
                                                        <option value="vi-VN" class="ng-binding">Tiếng Việt</option>
                                                        <option value="en-US" class="ng-binding">Tiếng Anh</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="text-center hidden-480">
                                                <!-- ngIf: !user.$edit --><i class="icon-edit bigger-130 blue ng-scope" data-ng-if="!user.$edit" data-ng-click="showEdit(user)"></i><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                        </tr><!-- end ngRepeat: user in users --><tr data-ng-repeat="user in users" class="ng-scope">
                                            <td class="hidden-480 width-20">
                                                <!-- ngIf: !user.$edit || user.IsAdmin --><a data-ng-if="!user.$edit || user.IsAdmin" data-ng-click="showEdit(user)" class="ng-binding ng-scope">doanthunhi.cartonsgn</a><!-- end ngIf: !user.$edit || user.IsAdmin -->
                                                <!-- ngIf: user.$edit && !user.IsAdmin -->
                                            </td>
                                            <td class="bolder">
                                                <!-- ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><span data-ng-if="!user.$edit || !(!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))" class="ng-binding ng-scope"> Nhi Đoàn</span><!-- end ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <span class="show-480">
                                                    <a data-ng-click="showEdit(user)" class="ng-binding">doanthunhi.cartonsgn</a>
                                                </span>
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên bán hàng
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên kho
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles -->
                                                <!-- ngRepeat: role in user.Roles -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: store in user.UserInStores --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="store in user.UserInStores">
                                                    <i class="icon-truck hidden-480"></i> Ms Vi
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: store in user.UserInStores -->
                                                <!-- ngRepeat: store in user.Stores -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: !user.$edit --><span class="label label-success ng-scope" data-ng-if="!user.$edit" data-ng-class="user.IsActived == true ? 'label-success' : 'label-danger'"><i data-ng-class="user.IsActived == true ? 'icon-unlock' : 'icon-lock'" class="icon-unlock"></i> <span class="hidden-768 ng-binding">Hoạt động</span></span><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><i class="icon-key bigger-130 blue ng-scope" title="Lấy lại mật khẩu" data-ng-click="openCreatePassword(user)" data-ng-if="userProfile.permission.isUpdate &amp;&amp; (!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))"></i><!-- end ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="text-center">
                                                <div class="checkbox no-padding">
                                                    <span data-ng-show="!user.$edit" class="ng-binding"> Tiếng Việt</span>
                                                    <select data-ng-show="user.$edit" data-ng-model="user.CultureInfo" class="ng-pristine ng-valid ng-hide">
                                                        <option value="vi-VN" class="ng-binding">Tiếng Việt</option>
                                                        <option value="en-US" class="ng-binding">Tiếng Anh</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="text-center hidden-480">
                                                <!-- ngIf: !user.$edit --><i class="icon-edit bigger-130 blue ng-scope" data-ng-if="!user.$edit" data-ng-click="showEdit(user)"></i><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                        </tr><!-- end ngRepeat: user in users --><tr data-ng-repeat="user in users" class="ng-scope">
                                            <td class="hidden-480 width-20">
                                                <!-- ngIf: !user.$edit || user.IsAdmin --><a data-ng-if="!user.$edit || user.IsAdmin" data-ng-click="showEdit(user)" class="ng-binding ng-scope">tienbbk.cartonsgn</a><!-- end ngIf: !user.$edit || user.IsAdmin -->
                                                <!-- ngIf: user.$edit && !user.IsAdmin -->
                                            </td>
                                            <td class="bolder">
                                                <!-- ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><span data-ng-if="!user.$edit || !(!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))" class="ng-binding ng-scope"> Hữu Tiến BBK</span><!-- end ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <span class="show-480">
                                                    <a data-ng-click="showEdit(user)" class="ng-binding">tienbbk.cartonsgn</a>
                                                </span>
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên bán hàng
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên kho
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles -->
                                                <!-- ngRepeat: role in user.Roles -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: store in user.UserInStores --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="store in user.UserInStores">
                                                    <i class="icon-truck hidden-480"></i> Ms Vi
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: store in user.UserInStores -->
                                                <!-- ngRepeat: store in user.Stores -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: !user.$edit --><span class="label label-success ng-scope" data-ng-if="!user.$edit" data-ng-class="user.IsActived == true ? 'label-success' : 'label-danger'"><i data-ng-class="user.IsActived == true ? 'icon-unlock' : 'icon-lock'" class="icon-unlock"></i> <span class="hidden-768 ng-binding">Hoạt động</span></span><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><i class="icon-key bigger-130 blue ng-scope" title="Lấy lại mật khẩu" data-ng-click="openCreatePassword(user)" data-ng-if="userProfile.permission.isUpdate &amp;&amp; (!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))"></i><!-- end ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="text-center">
                                                <div class="checkbox no-padding">
                                                    <span data-ng-show="!user.$edit" class="ng-binding"> Tiếng Việt</span>
                                                    <select data-ng-show="user.$edit" data-ng-model="user.CultureInfo" class="ng-pristine ng-valid ng-hide">
                                                        <option value="vi-VN" class="ng-binding">Tiếng Việt</option>
                                                        <option value="en-US" class="ng-binding">Tiếng Anh</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="text-center hidden-480">
                                                <!-- ngIf: !user.$edit --><i class="icon-edit bigger-130 blue ng-scope" data-ng-if="!user.$edit" data-ng-click="showEdit(user)"></i><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                        </tr><!-- end ngRepeat: user in users --><tr data-ng-repeat="user in users" class="ng-scope">
                                            <td class="hidden-480 width-20">
                                                <!-- ngIf: !user.$edit || user.IsAdmin --><a data-ng-if="!user.$edit || user.IsAdmin" data-ng-click="showEdit(user)" class="ng-binding ng-scope">thanhthanh.cartonsgn</a><!-- end ngIf: !user.$edit || user.IsAdmin -->
                                                <!-- ngIf: user.$edit && !user.IsAdmin -->
                                            </td>
                                            <td class="bolder">
                                                <!-- ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><span data-ng-if="!user.$edit || !(!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))" class="ng-binding ng-scope">Thanh Thanh (KT)</span><!-- end ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <span class="show-480">
                                                    <a data-ng-click="showEdit(user)" class="ng-binding">thanhthanh.cartonsgn</a>
                                                </span>
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên bán hàng
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên kho
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles -->
                                                <!-- ngRepeat: role in user.Roles -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: store in user.UserInStores --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="store in user.UserInStores">
                                                    <i class="icon-truck hidden-480"></i> Ms Vi
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: store in user.UserInStores -->
                                                <!-- ngRepeat: store in user.Stores -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: !user.$edit --><span class="label label-success ng-scope" data-ng-if="!user.$edit" data-ng-class="user.IsActived == true ? 'label-success' : 'label-danger'"><i data-ng-class="user.IsActived == true ? 'icon-unlock' : 'icon-lock'" class="icon-unlock"></i> <span class="hidden-768 ng-binding">Hoạt động</span></span><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><i class="icon-key bigger-130 blue ng-scope" title="Lấy lại mật khẩu" data-ng-click="openCreatePassword(user)" data-ng-if="userProfile.permission.isUpdate &amp;&amp; (!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))"></i><!-- end ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="text-center">
                                                <div class="checkbox no-padding">
                                                    <span data-ng-show="!user.$edit" class="ng-binding"> Tiếng Việt</span>
                                                    <select data-ng-show="user.$edit" data-ng-model="user.CultureInfo" class="ng-pristine ng-valid ng-hide">
                                                        <option value="vi-VN" class="ng-binding">Tiếng Việt</option>
                                                        <option value="en-US" class="ng-binding">Tiếng Anh</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="text-center hidden-480">
                                                <!-- ngIf: !user.$edit --><i class="icon-edit bigger-130 blue ng-scope" data-ng-if="!user.$edit" data-ng-click="showEdit(user)"></i><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                        </tr><!-- end ngRepeat: user in users --><tr data-ng-repeat="user in users" class="ng-scope">
                                            <td class="hidden-480 width-20">
                                                <!-- ngIf: !user.$edit || user.IsAdmin --><a data-ng-if="!user.$edit || user.IsAdmin" data-ng-click="showEdit(user)" class="ng-binding ng-scope">khohanoi.cartonsgn</a><!-- end ngIf: !user.$edit || user.IsAdmin -->
                                                <!-- ngIf: user.$edit && !user.IsAdmin -->
                                            </td>
                                            <td class="bolder">
                                                <!-- ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><span data-ng-if="!user.$edit || !(!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))" class="ng-binding ng-scope">Kho Hà Nội</span><!-- end ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <span class="show-480">
                                                    <a data-ng-click="showEdit(user)" class="ng-binding">khohanoi.cartonsgn</a>
                                                </span>
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên bán hàng
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên kho
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles -->
                                                <!-- ngRepeat: role in user.Roles -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: store in user.UserInStores --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="store in user.UserInStores">
                                                    <i class="icon-truck hidden-480"></i> Ms Vi
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: store in user.UserInStores -->
                                                <!-- ngRepeat: store in user.Stores -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: !user.$edit --><span class="label label-success ng-scope label-danger" data-ng-if="!user.$edit" data-ng-class="user.IsActived == true ? 'label-success' : 'label-danger'"><i data-ng-class="user.IsActived == true ? 'icon-unlock' : 'icon-lock'" class="icon-lock"></i> <span class="hidden-768 ng-binding">Đã khóa</span></span><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><i class="icon-key bigger-130 blue ng-scope" title="Lấy lại mật khẩu" data-ng-click="openCreatePassword(user)" data-ng-if="userProfile.permission.isUpdate &amp;&amp; (!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))"></i><!-- end ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="text-center">
                                                <div class="checkbox no-padding">
                                                    <span data-ng-show="!user.$edit" class="ng-binding"> Tiếng Việt</span>
                                                    <select data-ng-show="user.$edit" data-ng-model="user.CultureInfo" class="ng-pristine ng-valid ng-hide">
                                                        <option value="vi-VN" class="ng-binding">Tiếng Việt</option>
                                                        <option value="en-US" class="ng-binding">Tiếng Anh</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="text-center hidden-480">
                                                <!-- ngIf: !user.$edit --><i class="icon-edit bigger-130 blue ng-scope" data-ng-if="!user.$edit" data-ng-click="showEdit(user)"></i><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                        </tr><!-- end ngRepeat: user in users --><tr data-ng-repeat="user in users" class="ng-scope">
                                            <td class="hidden-480 width-20">
                                                <!-- ngIf: !user.$edit || user.IsAdmin --><a data-ng-if="!user.$edit || user.IsAdmin" data-ng-click="showEdit(user)" class="ng-binding ng-scope">banlegovap.cartonsgn</a><!-- end ngIf: !user.$edit || user.IsAdmin -->
                                                <!-- ngIf: user.$edit && !user.IsAdmin -->
                                            </td>
                                            <td class="bolder">
                                                <!-- ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><span data-ng-if="!user.$edit || !(!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))" class="ng-binding ng-scope"> Kho Gò Vấp</span><!-- end ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <span class="show-480">
                                                    <a data-ng-click="showEdit(user)" class="ng-binding">banlegovap.cartonsgn</a>
                                                </span>
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên bán hàng
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên kho
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles -->
                                                <!-- ngRepeat: role in user.Roles -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: store in user.UserInStores --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="store in user.UserInStores">
                                                    <i class="icon-truck hidden-480"></i> Ms Vi
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: store in user.UserInStores -->
                                                <!-- ngRepeat: store in user.Stores -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: !user.$edit --><span class="label label-success ng-scope" data-ng-if="!user.$edit" data-ng-class="user.IsActived == true ? 'label-success' : 'label-danger'"><i data-ng-class="user.IsActived == true ? 'icon-unlock' : 'icon-lock'" class="icon-unlock"></i> <span class="hidden-768 ng-binding">Hoạt động</span></span><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><i class="icon-key bigger-130 blue ng-scope" title="Lấy lại mật khẩu" data-ng-click="openCreatePassword(user)" data-ng-if="userProfile.permission.isUpdate &amp;&amp; (!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))"></i><!-- end ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="text-center">
                                                <div class="checkbox no-padding">
                                                    <span data-ng-show="!user.$edit" class="ng-binding"> Tiếng Việt</span>
                                                    <select data-ng-show="user.$edit" data-ng-model="user.CultureInfo" class="ng-pristine ng-valid ng-hide">
                                                        <option value="vi-VN" class="ng-binding">Tiếng Việt</option>
                                                        <option value="en-US" class="ng-binding">Tiếng Anh</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="text-center hidden-480">
                                                <!-- ngIf: !user.$edit --><i class="icon-edit bigger-130 blue ng-scope" data-ng-if="!user.$edit" data-ng-click="showEdit(user)"></i><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                        </tr><!-- end ngRepeat: user in users --><tr data-ng-repeat="user in users" class="ng-scope">
                                            <td class="hidden-480 width-20">
                                                <!-- ngIf: !user.$edit || user.IsAdmin --><a data-ng-if="!user.$edit || user.IsAdmin" data-ng-click="showEdit(user)" class="ng-binding ng-scope">hongdiem.cartonsgn</a><!-- end ngIf: !user.$edit || user.IsAdmin -->
                                                <!-- ngIf: user.$edit && !user.IsAdmin -->
                                            </td>
                                            <td class="bolder">
                                                <!-- ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><span data-ng-if="!user.$edit || !(!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))" class="ng-binding ng-scope">Hồng Diễm</span><!-- end ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <span class="show-480">
                                                    <a data-ng-click="showEdit(user)" class="ng-binding">hongdiem.cartonsgn</a>
                                                </span>
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên bán hàng
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên kho
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles -->
                                                <!-- ngRepeat: role in user.Roles -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: store in user.UserInStores --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="store in user.UserInStores">
                                                    <i class="icon-truck hidden-480"></i> Ms Vi
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: store in user.UserInStores -->
                                                <!-- ngRepeat: store in user.Stores -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: !user.$edit --><span class="label label-success ng-scope label-danger" data-ng-if="!user.$edit" data-ng-class="user.IsActived == true ? 'label-success' : 'label-danger'"><i data-ng-class="user.IsActived == true ? 'icon-unlock' : 'icon-lock'" class="icon-lock"></i> <span class="hidden-768 ng-binding">Đã khóa</span></span><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><i class="icon-key bigger-130 blue ng-scope" title="Lấy lại mật khẩu" data-ng-click="openCreatePassword(user)" data-ng-if="userProfile.permission.isUpdate &amp;&amp; (!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))"></i><!-- end ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="text-center">
                                                <div class="checkbox no-padding">
                                                    <span data-ng-show="!user.$edit" class="ng-binding"> Tiếng Việt</span>
                                                    <select data-ng-show="user.$edit" data-ng-model="user.CultureInfo" class="ng-pristine ng-valid ng-hide">
                                                        <option value="vi-VN" class="ng-binding">Tiếng Việt</option>
                                                        <option value="en-US" class="ng-binding">Tiếng Anh</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="text-center hidden-480">
                                                <!-- ngIf: !user.$edit --><i class="icon-edit bigger-130 blue ng-scope" data-ng-if="!user.$edit" data-ng-click="showEdit(user)"></i><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                        </tr><!-- end ngRepeat: user in users --><tr data-ng-repeat="user in users" class="ng-scope">
                                            <td class="hidden-480 width-20">
                                                <!-- ngIf: !user.$edit || user.IsAdmin --><a data-ng-if="!user.$edit || user.IsAdmin" data-ng-click="showEdit(user)" class="ng-binding ng-scope">myduyen.cartonsgn</a><!-- end ngIf: !user.$edit || user.IsAdmin -->
                                                <!-- ngIf: user.$edit && !user.IsAdmin -->
                                            </td>
                                            <td class="bolder">
                                                <!-- ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><span data-ng-if="!user.$edit || !(!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))" class="ng-binding ng-scope">Mỹ Duyên</span><!-- end ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <span class="show-480">
                                                    <a data-ng-click="showEdit(user)" class="ng-binding">myduyen.cartonsgn</a>
                                                </span>
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên bán hàng
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên kho
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles -->
                                                <!-- ngRepeat: role in user.Roles -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: store in user.UserInStores --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="store in user.UserInStores">
                                                    <i class="icon-truck hidden-480"></i> Ms Vi
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: store in user.UserInStores -->
                                                <!-- ngRepeat: store in user.Stores -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: !user.$edit --><span class="label label-success ng-scope" data-ng-if="!user.$edit" data-ng-class="user.IsActived == true ? 'label-success' : 'label-danger'"><i data-ng-class="user.IsActived == true ? 'icon-unlock' : 'icon-lock'" class="icon-unlock"></i> <span class="hidden-768 ng-binding">Hoạt động</span></span><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><i class="icon-key bigger-130 blue ng-scope" title="Lấy lại mật khẩu" data-ng-click="openCreatePassword(user)" data-ng-if="userProfile.permission.isUpdate &amp;&amp; (!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))"></i><!-- end ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="text-center">
                                                <div class="checkbox no-padding">
                                                    <span data-ng-show="!user.$edit" class="ng-binding"> Tiếng Việt</span>
                                                    <select data-ng-show="user.$edit" data-ng-model="user.CultureInfo" class="ng-pristine ng-valid ng-hide">
                                                        <option value="vi-VN" class="ng-binding">Tiếng Việt</option>
                                                        <option value="en-US" class="ng-binding">Tiếng Anh</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="text-center hidden-480">
                                                <!-- ngIf: !user.$edit --><i class="icon-edit bigger-130 blue ng-scope" data-ng-if="!user.$edit" data-ng-click="showEdit(user)"></i><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                        </tr><!-- end ngRepeat: user in users --><tr data-ng-repeat="user in users" class="ng-scope">
                                            <td class="hidden-480 width-20">
                                                <!-- ngIf: !user.$edit || user.IsAdmin --><a data-ng-if="!user.$edit || user.IsAdmin" data-ng-click="showEdit(user)" class="ng-binding ng-scope">lygiay.cartonsgn</a><!-- end ngIf: !user.$edit || user.IsAdmin -->
                                                <!-- ngIf: user.$edit && !user.IsAdmin -->
                                            </td>
                                            <td class="bolder">
                                                <!-- ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><span data-ng-if="!user.$edit || !(!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))" class="ng-binding ng-scope">Ly Giấy</span><!-- end ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <span class="show-480">
                                                    <a data-ng-click="showEdit(user)" class="ng-binding">lygiay.cartonsgn</a>
                                                </span>
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên bán hàng
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên kho
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles -->
                                                <!-- ngRepeat: role in user.Roles -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: store in user.UserInStores --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="store in user.UserInStores">
                                                    <i class="icon-truck hidden-480"></i> Ms Vi
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: store in user.UserInStores -->
                                                <!-- ngRepeat: store in user.Stores -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: !user.$edit --><span class="label label-success ng-scope" data-ng-if="!user.$edit" data-ng-class="user.IsActived == true ? 'label-success' : 'label-danger'"><i data-ng-class="user.IsActived == true ? 'icon-unlock' : 'icon-lock'" class="icon-unlock"></i> <span class="hidden-768 ng-binding">Hoạt động</span></span><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><i class="icon-key bigger-130 blue ng-scope" title="Lấy lại mật khẩu" data-ng-click="openCreatePassword(user)" data-ng-if="userProfile.permission.isUpdate &amp;&amp; (!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))"></i><!-- end ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="text-center">
                                                <div class="checkbox no-padding">
                                                    <span data-ng-show="!user.$edit" class="ng-binding"> Tiếng Việt</span>
                                                    <select data-ng-show="user.$edit" data-ng-model="user.CultureInfo" class="ng-pristine ng-valid ng-hide">
                                                        <option value="vi-VN" class="ng-binding">Tiếng Việt</option>
                                                        <option value="en-US" class="ng-binding">Tiếng Anh</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="text-center hidden-480">
                                                <!-- ngIf: !user.$edit --><i class="icon-edit bigger-130 blue ng-scope" data-ng-if="!user.$edit" data-ng-click="showEdit(user)"></i><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                        </tr><!-- end ngRepeat: user in users --><tr data-ng-repeat="user in users" class="ng-scope">
                                            <td class="hidden-480 width-20">
                                                <!-- ngIf: !user.$edit || user.IsAdmin --><a data-ng-if="!user.$edit || user.IsAdmin" data-ng-click="showEdit(user)" class="ng-binding ng-scope">kimloan.cartonsgn</a><!-- end ngIf: !user.$edit || user.IsAdmin -->
                                                <!-- ngIf: user.$edit && !user.IsAdmin -->
                                            </td>
                                            <td class="bolder">
                                                <!-- ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><span data-ng-if="!user.$edit || !(!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))" class="ng-binding ng-scope">Kim Loan</span><!-- end ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <span class="show-480">
                                                    <a data-ng-click="showEdit(user)" class="ng-binding">kimloan.cartonsgn</a>
                                                </span>
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên bán hàng
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên kho
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles -->
                                                <!-- ngRepeat: role in user.Roles -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: store in user.UserInStores --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="store in user.UserInStores">
                                                    <i class="icon-truck hidden-480"></i> Ms Vi
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: store in user.UserInStores -->
                                                <!-- ngRepeat: store in user.Stores -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: !user.$edit --><span class="label label-success ng-scope" data-ng-if="!user.$edit" data-ng-class="user.IsActived == true ? 'label-success' : 'label-danger'"><i data-ng-class="user.IsActived == true ? 'icon-unlock' : 'icon-lock'" class="icon-unlock"></i> <span class="hidden-768 ng-binding">Hoạt động</span></span><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><i class="icon-key bigger-130 blue ng-scope" title="Lấy lại mật khẩu" data-ng-click="openCreatePassword(user)" data-ng-if="userProfile.permission.isUpdate &amp;&amp; (!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))"></i><!-- end ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="text-center">
                                                <div class="checkbox no-padding">
                                                    <span data-ng-show="!user.$edit" class="ng-binding"> Tiếng Việt</span>
                                                    <select data-ng-show="user.$edit" data-ng-model="user.CultureInfo" class="ng-pristine ng-valid ng-hide">
                                                        <option value="vi-VN" class="ng-binding">Tiếng Việt</option>
                                                        <option value="en-US" class="ng-binding">Tiếng Anh</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="text-center hidden-480">
                                                <!-- ngIf: !user.$edit --><i class="icon-edit bigger-130 blue ng-scope" data-ng-if="!user.$edit" data-ng-click="showEdit(user)"></i><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                        </tr><!-- end ngRepeat: user in users --><tr data-ng-repeat="user in users" class="ng-scope">
                                            <td class="hidden-480 width-20">
                                                <!-- ngIf: !user.$edit || user.IsAdmin --><a data-ng-if="!user.$edit || user.IsAdmin" data-ng-click="showEdit(user)" class="ng-binding ng-scope">quyenthu.cartonsgn</a><!-- end ngIf: !user.$edit || user.IsAdmin -->
                                                <!-- ngIf: user.$edit && !user.IsAdmin -->
                                            </td>
                                            <td class="bolder">
                                                <!-- ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><span data-ng-if="!user.$edit || !(!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))" class="ng-binding ng-scope">Quyền Thư</span><!-- end ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <span class="show-480">
                                                    <a data-ng-click="showEdit(user)" class="ng-binding">quyenthu.cartonsgn</a>
                                                </span>
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên bán hàng
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên kho
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles -->
                                                <!-- ngRepeat: role in user.Roles -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: store in user.UserInStores --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="store in user.UserInStores">
                                                    <i class="icon-truck hidden-480"></i> Ms Vi
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: store in user.UserInStores -->
                                                <!-- ngRepeat: store in user.Stores -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: !user.$edit --><span class="label label-success ng-scope" data-ng-if="!user.$edit" data-ng-class="user.IsActived == true ? 'label-success' : 'label-danger'"><i data-ng-class="user.IsActived == true ? 'icon-unlock' : 'icon-lock'" class="icon-unlock"></i> <span class="hidden-768 ng-binding">Hoạt động</span></span><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><i class="icon-key bigger-130 blue ng-scope" title="Lấy lại mật khẩu" data-ng-click="openCreatePassword(user)" data-ng-if="userProfile.permission.isUpdate &amp;&amp; (!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))"></i><!-- end ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="text-center">
                                                <div class="checkbox no-padding">
                                                    <span data-ng-show="!user.$edit" class="ng-binding"> Tiếng Việt</span>
                                                    <select data-ng-show="user.$edit" data-ng-model="user.CultureInfo" class="ng-pristine ng-valid ng-hide">
                                                        <option value="vi-VN" class="ng-binding">Tiếng Việt</option>
                                                        <option value="en-US" class="ng-binding">Tiếng Anh</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="text-center hidden-480">
                                                <!-- ngIf: !user.$edit --><i class="icon-edit bigger-130 blue ng-scope" data-ng-if="!user.$edit" data-ng-click="showEdit(user)"></i><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                        </tr><!-- end ngRepeat: user in users --><tr data-ng-repeat="user in users" class="ng-scope">
                                            <td class="hidden-480 width-20">
                                                <!-- ngIf: !user.$edit || user.IsAdmin --><a data-ng-if="!user.$edit || user.IsAdmin" data-ng-click="showEdit(user)" class="ng-binding ng-scope">hoaibao.cartonsgn</a><!-- end ngIf: !user.$edit || user.IsAdmin -->
                                                <!-- ngIf: user.$edit && !user.IsAdmin -->
                                            </td>
                                            <td class="bolder">
                                                <!-- ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><span data-ng-if="!user.$edit || !(!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))" class="ng-binding ng-scope">Hoài Bảo</span><!-- end ngIf: !user.$edit || !(!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <span class="show-480">
                                                    <a data-ng-click="showEdit(user)" class="ng-binding">hoaibao.cartonsgn</a>
                                                </span>
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Chủ cửa hàng
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Quản lý
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên bán hàng
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên kho
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="role in user.UserRoles">
                                                    <i class="icon-user hidden-480"></i> Nhân viên thu ngân
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: role in user.UserRoles -->
                                                <!-- ngRepeat: role in user.Roles -->
                                            </td>
                                            <td class="user-role hidden-640">
                                                <!-- ngRepeat: store in user.UserInStores --><!-- ngIf: !user.$edit --><span data-ng-if="!user.$edit" class="label label-primary ng-binding ng-scope" style="margin-right: 5px;" data-ng-repeat="store in user.UserInStores">
                                                    <i class="icon-truck hidden-480"></i> Ms Vi
                                                </span><!-- end ngIf: !user.$edit --><!-- end ngRepeat: store in user.UserInStores -->
                                                <!-- ngRepeat: store in user.Stores -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: !user.$edit --><span class="label label-success ng-scope" data-ng-if="!user.$edit" data-ng-class="user.IsActived == true ? 'label-success' : 'label-danger'"><i data-ng-class="user.IsActived == true ? 'icon-unlock' : 'icon-lock'" class="icon-unlock"></i> <span class="hidden-768 ng-binding">Hoạt động</span></span><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                            <td class="text-center">
                                                <!-- ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) --><i class="icon-key bigger-130 blue ng-scope" title="Lấy lại mật khẩu" data-ng-click="openCreatePassword(user)" data-ng-if="userProfile.permission.isUpdate &amp;&amp; (!user.IsAdmin || (user.IsAdmin &amp;&amp; userProfile.isAdmin))"></i><!-- end ngIf: userProfile.permission.isUpdate && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                            </td>
                                            <td class="text-center">
                                                <div class="checkbox no-padding">
                                                    <span data-ng-show="!user.$edit" class="ng-binding"> Tiếng Việt</span>
                                                    <select data-ng-show="user.$edit" data-ng-model="user.CultureInfo" class="ng-pristine ng-valid ng-hide">
                                                        <option value="vi-VN" class="ng-binding">Tiếng Việt</option>
                                                        <option value="en-US" class="ng-binding">Tiếng Anh</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="text-center hidden-480">
                                                <!-- ngIf: !user.$edit --><i class="icon-edit bigger-130 blue ng-scope" data-ng-if="!user.$edit" data-ng-click="showEdit(user)"></i><!-- end ngIf: !user.$edit -->
                                                <!-- ngIf: user.$edit && (!user.IsAdmin || (user.IsAdmin && userProfile.isAdmin)) -->
                                                <!-- ngIf: user.$edit -->
                                            </td>
                                        </tr><!-- end ngRepeat: user in users -->
                                    </tbody>
                                </table>
                                <script type="text/ng-template" id="modalCreateUser.html">
                                    <form name="frmCreateUser" novalidate>
                                        <div class="modal-header no-padding">
                                            <div class="table-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" data-ng-click="closeModal()">
                                                    <span class="white">×</span>
                                                </button>
                                                {{__('Setting_Add_User')}}
                                            </div>
                                        </div>
                                        <div class="modal-body no-padding">
                                            <div class="row">
                                                <div class="col-xs-12 form-horizontal">
                                                    <div class="form-group" style="margin-top:10px;">
                                                        <label class="col-xs-3 control-label">{{__('Setting_User_Name_Header')}}</label>
                                                        <div class="col-xs-9">
                                                            <input type="text" name="fullname" placeholder="{{__("Setting_User_Name_Placeholder")}}" class="width-100" data-ng-model="user.displayname" required ng-minlength="" />
                                                            <div class="red" data-ng-show="frmCreateUser.fullname.$error.required && frmCreateUser.fullname.$dirty">
                                                                {{__('Username_Required')}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-xs-3 control-label"> {{__('Setting_User_Code_Header')}}</label>
                                                        <div class="col-xs-9">
                                                            <div class="input-group">
                                                                <input type="text" name="username" placeholder="{{__('Setting_User_Code_Placeholder')}}" class="form-control width-100" style="border-radius: 3px 0px 0px 3px !important;" data-ng-model="user.prefixUserName" required ng-pattern="/^\w+$/" />
                                                                <span class="input-group-addon bolder">
                                                                    .{{__('companyCode')}}
                                                                </span>
                                                                <span class="input-group-addon bolder" title="Thay đổi mã cửa hàng" ng-click="changeCompanyCodeRequest();">
                                                                    <a href="javascript:;">
                                                                        <i class="icon-edit bigger-130 blue ng-scope"></i>
                                                                    </a>
                                                                </span>
                                                            </div>
                                                            <span class="red" data-ng-show="frmCreateUser.username.$error.required && frmCreateUser.username.$dirty">{{__('Setting_User_Name_Validation')}}.</span>
                                                            <span class="red" data-ng-show="frmCreateUser.username.$error.pattern && frmCreateUser.username.$dirty">{{__('Setting_User_Code_Validation')}}.</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" ng-show="changeCompanyCodeRequesting==true">
                                                        <label class="col-xs-3 control-label"></label>
                                                        <div class="col-xs-9">
                                                            <div class="pull-right">
                                                                <div class="input-group">
                                                                    <input type="text" name="" placeholder="" class="form-control width-100" style="border-radius: 3px 0px 0px 3px !important;" ng-model="user.companyCode" ng-init="user.companyCode=companyCode" />
                                                                    <span class="input-group-addon bolder" title="Lưu" ng-click="saveCompanyCode();">
                                                                        <a href="javascript:;">
                                                                            <i class="icon-save bigger-130 blue ng-scope"></i>
                                                                        </a>
                                                                    </span>
                                                                    <span class="input-group-addon bolder" title="Lưu" ng-click="cancelCompanyCodeRequest();">
                                                                        <a href="javascript:;">
                                                                            <i class="icon-undo bigger-130 blue ng-scope"></i>
                                                                        </a>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-xs-3 control-label">{{'Pass'}}</label>
                                                        <div class="col-xs-9">
                                                            <input type="password" name="password" placeholder="{{'Setting_User_Pass_Placeholder'}}" class="width-100" data-ng-model="user.password" required data-ng-minlength="6" />
                                                            <span class="red" data-ng-show="frmCreateUser.password.$error.required && frmCreateUser.password.$dirty">{{'Setting_User_Pass_Validation'}}.</span>
                                                            <span class="red" data-ng-show="frmCreateUser.password.$error.minlength && frmCreateUser.password.$dirty">{{'Setting_User_Pass_Length'}}.</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-xs-3 control-label">{{'Setting_User_Role'}}</label>
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
                                                        <label class="col-xs-3 control-label">{{'Setting_User_Store'}}</label>
                                                        <div class="col-xs-9">
                                                            <div class="checkbox inline" data-ng-repeat="store in stores">
                                                                <label style="padding-left:0px; padding-right:10px;">
                                                                    <input type="checkbox" class="ace" data-ng-model="store.IsDefault">
                                                                    <span class="lbl"> {{@$store->StoreName}}</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-xs-3 control-label">{{'Language'}}</label>
                                                        <div class="col-xs-9">
                                                            <select data-ng-model="user.cultureInfo">
                                                                <option value="vi-VN">{{'Vietnamese'}}</option>
                                                                <option value="en-US">{{'English'}}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-sm btn-primary" data-ng-disabled="frmCreateUser.$invalid" data-ng-click="createUser()">
                                                <i class="icon-ok"></i>
                                                {{'Save'}}
                                            </button>

                                            <button class="btn btn-sm" data-ng-click="closeModal()">
                                                <i class="icon-undo"></i>
                                                {{'Cancel'}}
                                            </button>
                                        </div>
                                    </form>
                                </script>
                                <script type="text/ng-template" id="modalCreatePassword.html">
                                    <form name="frmCreatePassword" novalidate>
                                        <div class="modal-header no-padding">
                                            <div class="table-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" data-ng-click="closeModal()">
                                                    <span class="white">×</span>
                                                </button>
                                                {{'Change_Pass'}} {{'displayName'}}
                                            </div>
                                        </div>
                                        <div class="modal-body no-padding">
                                            <div class="row">
                                                <div class="col-xs-12 form-horizontal">
                                                    <div class="form-group" style="margin-top:10px;">
                                                        <label class="col-xs-3 control-label">{{'Setting_User_New_Pass'}}</label>
                                                        <div class="col-xs-9">
                                                            <input type="password" id="txtNewPassword" name="newpassword" placeholder="{{'Setting_User_New_Pass' }}" class="width-100" data-ng-model="newpassword" required data-ng-minlength="6" />
                                                            <span class="red" data-ng-show="frmCreatePassword.newpassword.$error.required && frmCreatePassword.newpassword.$dirty">{{'Setting_User_Pass_Validation' }}.</span>
                                                            <span class="red" data-ng-show="frmCreatePassword.newpassword.$error.minlength && frmCreatePassword.newpassword.$dirty">{{'Setting_User_Pass_Length' }}.</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-sm btn-primary" data-ng-disabled="frmCreatePassword.$invalid" data-ng-click="createPassword()">
                                                <i class="icon-ok"></i>
                                                {{'Save' }}
                                            </button>
                                            <button class="btn btn-sm" data-ng-click="closeModal()">
                                                <i class="icon-undo"></i>
                                                {{'Cancel' }}
                                            </button>
                                        </div>
                                    </form>
                                </script>
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
                                                                <span class="lbl"> {{"feature.name"}}</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-sm btn-primary" data-ng-click="createRole()">
                                            <i class="icon-ok"></i>
                                            {{'Save' }}
                                        </button>

                                        <button class="btn btn-sm" data-ng-click="closeModal()">
                                            <i class="icon-undo"></i>
                                            {{'Cancel' }}
                                        </button>
                                    </div>
                                </script>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6" style="margin-top: 20px;">
                            <h3 class="ng-binding">Chức năng cho nhóm người dùng</h3>
                            <div class="table-responsive">
                                <table id="sample-table-2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="center border white-bg ng-binding">Chức năng</th>
                                            <th class="center border"><span class="show-640 ng-binding">Chủ CH</span> <span class="hidden-640 ng-binding">Chủ cửa hàng</span></th>
                                            <th class="center border"><span class="show-640 ng-binding">QL</span><span class="hidden-640 ng-binding">Quản lý</span></th>
                                            <th class="center border"><span class="show-640 ng-binding">NVBH</span><span class="hidden-640 ng-binding">Nhân viên bán hàng</span></th>
                                            <th class="center border"><span class="show-640 ng-binding">Kho</span><span class="hidden-640 ng-binding">Quản lý kho</span></th>
                                            <th class="center border"><span class="show-640 ng-binding">Thu ngân</span><span class="hidden-640 ng-binding">Nhân viên thu ngân</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="center border hl ng-binding">Bán hàng - POS</td>
                                            <td class="center border"><i class="icon-ok green"></i></td>
                                            <td class="center border"><i class="icon-ok green"></i></td>
                                            <td class="center border"><i class="icon-ok green"></i></td>
                                            <td class="center border"><i class="icon-ok green"></i></td>
                                            <td class="center border"><i class="icon-ok green"></i></td>
                                        </tr>
                                        <tr>
                                            <td class="center border hl ng-binding">Báo cáo cuối ngày</td>
                                            <td class="center border"><i class="icon-ok green"></i></td>
                                            <td class="center border"><i class="icon-ok green"></i></td>
                                            <td class="center border"><i class="icon-ok green"></i></td>
                                            <td class="center border"><i class="icon-ok green"></i></td>
                                            <td class="center border"><i class="icon-ok green"></i></td>
                                        </tr>
                                        <tr>
                                            <td class="center border hl ng-binding">Hàng hóa</td>
                                            <td class="center border"><i class="icon-ok green"></i></td>
                                            <td class="center border"><i class="icon-ok green"></i></td>
                                            <td class="center border"><i class="icon-remove red"></i></td>
                                            <td class="center border"><i class="icon-ok green"></i></td>
                                            <td class="center border"><i class="icon-remove red"></i></td>
                                        </tr>
                                        <tr>
                                            <td class="center border hl ng-binding">Đơn hàng</td>
                                            <td class="center border"><i class="icon-ok green"></i></td>
                                            <td class="center border"><i class="icon-ok green"></i></td>
                                            <td class="center border"><i class="icon-remove red"></i></td>
                                            <td class="center border"><i class="icon-ok green"></i></td>
                                            <td class="center border"><i class="icon-ok green"></i></td>
                                        </tr>
                                        <tr>
                                            <td class="center border hl ng-binding">Khách hàng/Nhà cung cấp</td>
                                            <td class="center border"><i class="icon-ok green"></i></td>
                                            <td class="center border"><i class="icon-ok green"></i></td>
                                            <td class="center border"><i class="icon-remove red"></i></td>
                                            <td class="center border"><i class="icon-remove red"></i></td>
                                            <td class="center border"><i class="icon-ok green"></i></td>
                                        </tr>
                                        <tr>
                                            <td class="center border hl ng-binding">Tích điểm</td>
                                            <td class="center border"><i class="icon-ok green"></i></td>
                                            <td class="center border"><i class="icon-remove red"></i></td>
                                            <td class="center border"><i class="icon-remove red"></i></td>
                                            <td class="center border"><i class="icon-remove red"></i></td>
                                            <td class="center border"><i class="icon-remove red"></i></td>
                                        </tr>
                                        <tr>
                                            <td class="center border hl ng-binding">Nhập kho</td>
                                            <td class="center border"><i class="icon-ok green"></i></td>
                                            <td class="center border"><i class="icon-ok green"></i></td>
                                            <td class="center border"><i class="icon-remove red"></i></td>
                                            <td class="center border"><i class="icon-ok green"></i></td>
                                            <td class="center border"><i class="icon-remove red"></i></td>
                                        </tr>
                                        <tr>
                                            <td class="center border hl ng-binding">Chuyển kho</td>
                                            <td class="center border"><i class="icon-ok green"></i></td>
                                            <td class="center border"><i class="icon-ok green"></i></td>
                                            <td class="center border"><i class="icon-remove red"></i></td>
                                            <td class="center border"><i class="icon-ok green"></i></td>
                                            <td class="center border"><i class="icon-remove red"></i></td>
                                        </tr>
                                        <tr>
                                            <td class="center border hl ng-binding">Tồn kho</td>
                                            <td class="center border"><i class="icon-ok green"></i></td>
                                            <td class="center border"><i class="icon-ok green"></i></td>
                                            <td class="center border"><i class="icon-remove red"></i></td>
                                            <td class="center border"><i class="icon-ok green"></i></td>
                                            <td class="center border"><i class="icon-remove red"></i></td>
                                        </tr>
                                        <tr>
                                            <td class="center border hl ng-binding">Nhập xuất tồn</td>
                                            <td class="center border"><i class="icon-ok green"></i></td>
                                            <td class="center border"><i class="icon-ok green"></i></td>
                                            <td class="center border"><i class="icon-remove red"></i></td>
                                            <td class="center border"><i class="icon-ok green"></i></td>
                                            <td class="center border"><i class="icon-remove red"></i></td>
                                        </tr>
                                        <tr>
                                            <td class="center border hl ng-binding">Kiểm kê</td>
                                            <td class="center border"><i class="icon-ok green"></i></td>
                                            <td class="center border"><i class="icon-ok green"></i></td>
                                            <td class="center border"><i class="icon-remove red"></i></td>
                                            <td class="center border"><i class="icon-ok green"></i></td>
                                            <td class="center border"><i class="icon-remove red"></i></td>
                                        </tr>
                                        <tr>
                                            <td class="center border hl ng-binding">Khuyến mãi</td>
                                            <td class="center border"><i class="icon-ok green"></i></td>
                                            <td class="center border"><i class="icon-ok green"></i></td>
                                            <td class="center border"><i class="icon-remove red"></i></td>
                                            <td class="center border"><i class="icon-remove red"></i></td>
                                            <td class="center border"><i class="icon-remove red"></i></td>
                                        </tr>
                                        <tr>
                                            <td class="center border hl ng-binding">Doanh số</td>
                                            <td class="center border"><i class="icon-ok green"></i></td>
                                            <td class="center border"><i class="icon-ok green"></i></td>
                                            <td class="center border"><i class="icon-remove red"></i></td>
                                            <td class="center border"><i class="icon-remove red"></i></td>
                                            <td class="center border"><i class="icon-ok green"></i></td>
                                        </tr>
                                        <tr>
                                            <td class="center border hl ng-binding">Thu chi</td>
                                            <td class="center border"><i class="icon-ok green"></i></td>
                                            <td class="center border"><i class="icon-ok green"></i></td>
                                            <td class="center border"><i class="icon-remove red"></i></td>
                                            <td class="center border"><i class="icon-remove red"></i></td>
                                            <td class="center border"><i class="icon-ok green"></i></td>
                                        </tr>
                                        <tr>
                                            <td class="center border hl ng-binding">Sổ quỹ</td>
                                            <td class="center border"><i class="icon-ok green"></i></td>
                                            <td class="center border"><i class="icon-remove red"></i></td>
                                            <td class="center border"><i class="icon-remove red"></i></td>
                                            <td class="center border"><i class="icon-remove red"></i></td>
                                            <td class="center border"><i class="icon-remove red"></i></td>
                                        </tr>
                                        <tr>
                                            <td class="center border hl ng-binding">Lợi nhuận</td>
                                            <td class="center border"><i class="icon-ok green"></i></td>
                                            <td class="center border"><i class="icon-remove red"></i></td>
                                            <td class="center border"><i class="icon-remove red"></i></td>
                                            <td class="center border"><i class="icon-remove red"></i></td>
                                            <td class="center border"><i class="icon-remove red"></i></td>
                                        </tr>
                                        <tr>
                                            <td class="center border hl ng-binding">Thiết lập <span class="hidden-640 ng-binding" style="font-weight: normal">(Thông tin cửa hàng, nhân viên, thiết lập bán hàng, quản lý mẫu in)</span> </td>
                                            <td class="center border"><i class="icon-ok green"></i></td>
                                            <td class="center border"><i class="icon-remove red"></i></td>
                                            <td class="center border"><i class="icon-remove red"></i></td>
                                            <td class="center border"><i class="icon-remove red"></i></td>
                                            <td class="center border"><i class="icon-remove red"></i></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-xs-12">
                                <h3 class="main-color ng-binding">Lưu ý</h3>
                                <p><i class="ng-binding"><strong class="ng-binding">[Chủ cửa hàng]</strong> mới được xem giá vốn của hàng hóa và báo cáo lợi nhuận</i></p>
                                <p><i class="ng-binding"><strong class="ng-binding">[Quản lý]</strong> không xóa được dữ liệu. Để xóa được dữ liệu, cần liên hệ  </i></p>
                                <p><i class="ng-binding"><strong class="ng-binding">[Nhân viên bán hàng]</strong> chỉ được bán hàng, nhập trả hàng và xem báo cáo cuối ngày từ POS</i></p>
                                <p><i class="ng-binding"><strong class="ng-binding">[Quản lý kho]</strong> chỉ được quản lý hàng hóa, quản lý kho, xem báo cáo nhập xuất tồn, kiểm kê</i></p>
                                <p><i class="ng-binding"><strong class="ng-binding">[Nhân viên thu ngân]</strong> chỉ được bán hàng, nhập trả hàng và xem báo cáo cuối ngày từ POS và quản lý khách hàng</i></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">.2..</div>
            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">.3..</div>
        </div>
    </div>
@endsection
