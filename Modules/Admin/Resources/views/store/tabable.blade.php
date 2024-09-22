<div class="tabbable">
    <ul class="nav nav-tabs">
        <li class="tab-pane  in active">
            <a href="#user_setting" data-toggle="tab" ng-click="getUsers()">
                <i class="blue icon-user bigger-120"></i>
                <span class="hidden-640 ng-binding">Nhân viên</span>
            </a>
        </li>
        <li class="tab-pane">
            <a href="#store_setting" data-toggle="tab" ng-click="getStoreSetting()" h-ctrl="company-info-tab">
                <i class="blue icon-cog bigger-120"></i>
                <span class="hidden-640 ng-binding">Thông tin cửa hàng</span>
            </a>
        </li>
        <li class="tab-pane">
            <a href="#web_setting"  data-toggle="tab" ng-click="getSetting()">
                <i class="blue icon-cogs bigger-120"></i>
                <span class="hidden-640 ng-binding">Thiết lập Website</span>
            </a>
        </li>
        {{-- <li class="tab-pane">
            <a data-toggle="tab" ng-click="getPrintTemplate()">
                <i class="blue icon-print bigger-120"></i>
                <span class="hidden-640 ng-binding">Quản lý mẫu in</span>
            </a>
        </li>
        <li class="tab-pane ">
            <a data-toggle="tab" ng-click="getAuditTrail()">
                <i class="blue icon-share bigger-120"></i>
                <span class="hidden-640 ng-binding">Lịch sử thao tác</span>
            </a>
        </li>
        <li class="tab-pane hidden-640">
            <a data-toggle="tab" ng-click="getUpgrade()">
                <i class="blue icon-rocket bigger-120"></i>
                <span class="hidden-640 ng-binding">Thanh toán gia hạn</span>
            </a>
        </li> --}}

    </ul>
</div>
