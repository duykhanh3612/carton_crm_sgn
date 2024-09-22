<div class="profile-feed row-fluid">
    <div class="row ng-hide" ng-hide="layoutSettings.companyInfo.dataLoaded == true">
<div>Đang tải dữ liệu</div>
</div>

<div class="profile-users clearfix" ng-show="layoutSettings.companyInfo.dataLoaded == true">
<form class="form-horizontal ng-pristine ng-valid ng-valid-required" name="companyInfoFrm" novalidate="">
<div class="row">
<div class="col-xs-12 col-sm-6">
<div class="form-group">
<label class="col-sm-4 control-label no-padding-right b ng-binding">Tên cửa hàng</label>
<div class="col-sm-8">
<div ng-show="layoutSettings.companyInfo.editing == true" class="ng-hide">
    <div class="">
        <input type="text" class="col-xs-10 ng-pristine ng-valid ng-valid-required" name="companyName" placeholder="" ng-model="companyInfoModelEditing.companyName" maxlength="511" required="">
        <div class="clearfix"></div>
    </div>
    <div class="ng-hide" ng-show="companyInfoFrm.companyName.$dirty &amp;&amp; companyInfoFrm.companyName.$invalid">
        <span class="label label-danger arrowed-right">
            <span ng-show="companyInfoFrm.companyName.$error.required" class="ng-hide">Vui lòng nhập tên cửa hàng.</span>
        </span>
    </div>
</div>
<div ng-hide="layoutSettings.companyInfo.editing == true" class="">
    <span ng-bind="companyInfoModel.companyName" class="ng-binding">Carton SGN</span>
</div>
</div>
</div>

<div class="form-group">
<label class="col-sm-4 control-label no-padding-right b ng-binding">Mã cửa hàng</label>
<div class="col-sm-8">

<div ng-show="layoutSettings.companyInfo.editing == true" class="ng-hide">
    <input type="text" class="col-xs-10 ng-pristine ng-valid" placeholder="" ng-model="companyInfoModelEditing.companyCode" maxlength="127">
</div>
<div ng-hide="layoutSettings.companyInfo.editing == true" class="">
    <span ng-bind="companyInfoModel.companyCode" class="ng-binding">cartonsgn</span>
</div>
</div>
</div>
<div class="form-group">
<label class="col-sm-4 control-label no-padding-right b ng-binding">Tên người đại diện</label>
<div class="col-sm-8">
<div ng-show="layoutSettings.companyInfo.editing == true" class="ng-hide">
    <div class="">
        <input type="text" class="col-xs-10 ng-pristine ng-valid ng-valid-required" name="legalRepresentative" placeholder="" ng-model="companyInfoModelEditing.legalRepresentative" maxlength="127" required="">
        <div class="clearfix"></div>
    </div>
    <div class="ng-hide" ng-show="companyInfoFrm.legalRepresentative.$dirty &amp;&amp; companyInfoFrm.legalRepresentative.$invalid">
        <span class="label label-danger arrowed-right">
            <span ng-show="companyInfoFrm.legalRepresentative.$error.required" class="ng-hide">Vui lòng nhập tên người đại diện của cửa hàng.</span>
        </span>
    </div>
</div>
<div ng-hide="layoutSettings.companyInfo.editing == true" class="">
    <span ng-bind="companyInfoModel.legalRepresentative" class="ng-binding">Vi</span>
</div>
</div>
</div>
<div class="form-group">
<label class="col-sm-4 control-label no-padding-right b ng-binding">Số điện thoại</label>
<div class="col-sm-8">
<div ng-show="layoutSettings.companyInfo.editing == true" class="ng-hide">

    <div class="">
        <input type="text" class="col-xs-10 ng-pristine ng-valid ng-valid-required" name="phoneNumber" placeholder="" ng-model="companyInfoModelEditing.phoneNumber" maxlength="127" required="">
        <div class="clearfix"></div>
    </div>
    <div class="ng-hide" ng-show="companyInfoFrm.phoneNumber.$dirty &amp;&amp; companyInfoFrm.phoneNumber.$invalid">
        <span class="label label-danger arrowed-right">
            <span ng-show="companyInfoFrm.phoneNumber.$error.required" class="ng-hide">Hãy nhập số điện thoại liên hệ của cửa hàng.</span>
        </span>
    </div>
</div>
<div ng-hide="layoutSettings.companyInfo.editing == true" class="">
    <span ng-bind="(companyInfoModel.phoneNumber == null || companyInfoModel.phoneNumber == undefine || companyInfoModel.phoneNumber == '') &amp;&amp; 'Chưa cập nhật' || companyInfoModel.phoneNumber" class="ng-binding">0902610482</span>
</div>
</div>
</div>
<div class="form-group">
<label class="col-sm-4 control-label no-padding-right b">Website</label>
<div class="col-sm-8">
<div ng-show="layoutSettings.companyInfo.editing == true" class="ng-hide">
    <input type="text" class="col-xs-10 ng-pristine ng-valid" placeholder="" ng-model="companyInfoModelEditing.website" maxlength="127">
</div>
<div ng-hide="layoutSettings.companyInfo.editing == true" class="">
    <span ng-bind="(companyInfoModel.website == null || companyInfoModel.website == undefine || companyInfoModel.website == '') &amp;&amp; 'Chưa cập nhật' || companyInfoModel.website" class="ng-binding">Chưa cập nhật</span>
</div>
</div>
</div>
<div class="form-group">
<label class="col-sm-4 control-label no-padding-right b ng-binding">Địa chỉ</label>
<div class="col-sm-8">
<div ng-show="layoutSettings.companyInfo.editing == true" class="ng-hide">
    <div class="">
        <input type="text" class="col-xs-10 ng-pristine ng-valid" name="address" placeholder="" ng-model="companyInfoModelEditing.address" maxlength="1023">
        <div class="clearfix"></div>
    </div>


</div>
<div ng-hide="layoutSettings.companyInfo.editing == true" class="">
    <span ng-bind="(companyInfoModel.address == null || companyInfoModel.address == undefine || companyInfoModel.address == '') &amp;&amp; 'Chưa cập nhật' || companyInfoModel.address" class="ng-binding">59/4A Hiệp Bình, Hiệp Bình Phước, Quận Thủ Đức</span>
</div>
</div>
</div>
<div class="form-group">
<label class="col-sm-4 control-label no-padding-right b ng-binding">Ngành kinh doanh</label>
<div class="col-sm-8">
<div ng-show="layoutSettings.companyInfo.editing == true" class="ng-hide">


    <select ng-model="companyInfoModelEditing.industry" ng-options="item.id as item.name for item in common.industries" data-ng-change="getIndustryName(companyInfoModelEditing.industry)" class="ng-pristine ng-valid"><option value="0" selected="selected">Chọn ngành hàng bạn đang kinh doanh</option><option value="1">Thời trang</option><option value="2">Bar-Cà phê-Nhà hàng</option><option value="3">Mẹ và bé</option><option value="4">Điện thoại &amp; Điện máy</option><option value="5">Mỹ phẩm</option><option value="6">Nội thất &amp; Gia dụng</option><option value="7">Hoa &amp; Quà tặng</option><option value="8">Xe máy &amp; linh kiện</option><option value="9">Sách &amp; Văn phòng phẩm</option><option value="10">Tạp hóa</option><option value="11">Siêu thị mini</option><option value="12">Nông sản &amp; Thực phẩm</option><option value="13">Nhà thuốc</option><option value="14">Khách sạn-Nhà nghỉ</option><option value="15">Vật liệu xây dựng</option><option value="16" selected="selected">Ngành hàng khác</option><option value="17">Bán lẻ</option></select>
</div>
<div ng-hide="layoutSettings.companyInfo.editing == true" class="">
    <span ng-bind="companyInfoModel.industryName" class="ng-binding">Ngành hàng khác</span>
</div>
</div>
</div>
<div class="form-group">
<label class="col-sm-4 control-label no-padding-right b ng-binding">Mã số thuế</label>
<div class="col-sm-8">
<div ng-show="layoutSettings.companyInfo.editing == true" class="ng-hide">
    <div class="">
        <input type="text" class="col-xs-10 ng-pristine ng-valid" name="taxCode" placeholder="" ng-model="companyInfoModelEditing.taxCode" maxlength="127">
        <div class="clearfix"></div>
    </div>

</div>
<div ng-hide="layoutSettings.companyInfo.editing == true" class="">
    <span ng-bind="(companyInfoModel.taxCode == null || companyInfoModel.taxCode == undefine || companyInfoModel.taxCode == '') &amp;&amp; 'Chưa cập nhật' || companyInfoModel.taxCode" class="ng-binding">Chưa cập nhật</span>
</div>
</div>
</div>

<div class="clearfix col-xs-12 form-actions ng-hide" ng-show="layoutSettings.companyInfo.editing == true">
<div class="pull-right">
<button class="btn ng-binding" type="button" ng-click="cancelEditCompanyInfo();">
    <i class="icon-undo bigger-110"></i>
    Hủy
</button>
&nbsp; &nbsp; &nbsp;

<button class="btn btn-primary ng-binding" type="button" ng-click="saveCompanyInfo();" ng-disabled="layoutSettings.companyInfo.saving == true">
    <i class="icon-ok bigger-110"></i>
    Lưu
</button>
</div>
</div>

<div class="clearfix col-xs-12 form-actions" ng-hide="layoutSettings.companyInfo.editing == true">
<div class="pull-right">
<button class="btn btn-primary ng-binding" type="button" ng-click="startEditCompanyInfo();">
    <i class="icon-pencil bigger-110"></i>
    Cập nhật
</button>
</div>
</div>
</div>

<div class="col-xs-12 col-sm-4">
<div class="widget-main">

<div>
<div class="dz-preview dz-image-preview ng-hide" data-ng-show="companyInfoModel.logo > 0">
    <div class="dz-details">
        <img style="width:100%" data-ng-src="https://cdn.suno.vn/api/images/" ng-click="repeatSelectFile();" class="company-info-setting-logo" title="Click to change your logo" src="https://cdn.suno.vn/api/images/">
    </div>
</div>
</div>
<div class="dropzone dz-clickable" style="min-height:235px;" data-ng-show="companyInfoModel.logo == null" ng-file-select="onFileSelect($files)" ng-file-drop="onFileSelect($files)" ng-file-drop-available="dropSupported=true" ng-file-drag-over-class="dragOverClass($event)" ng-file-drag-over-delay="100" accept="image/*">
<div class="dz-default dz-message" data-ng-show="dataFiles.length == 0">
    <span>
        <span class="bolder ng-binding">Upload hình đại diện cửa hàng</span><br><i class="upload-icon icon-picture blue icon-3x"></i>
    </span>
</div>




<input type="file" class="dropzone dz-clickable" style="min-height: 235px; inset: 0px; opacity: 0; position: absolute; width: 100%;" data-ng-show="companyInfoModel.logo == null" ng-file-select="onFileSelect($files)" ng-file-drop="onFileSelect($files)" ng-file-drop-available="dropSupported=true" ng-file-drag-over-class="dragOverClass($event)" ng-file-drag-over-delay="100" accept="image/*"></div>
</div>
</div>
</div>

</form>
</div>

<!--Store Wiget-->
<div class="col-xs-12 widget-container-span no-padding ng-scope" data-ng-controller="storeController" data-ng-init="getStores()">
<div class="">
<div class="widget-header header-color-blue">
<h5 class="bigger lighter">
<i class="icon-sitemap hidden-480"></i>
<span class="hidden-480 ng-binding">Danh sách chi nhánh</span>
</h5>
<div class="widget-toolbar">
<a data-action="reload">
<i class="icon-refresh white"></i>
</a>
<a data-action="collapse">
<i class="icon-chevron-up white"></i>
</a>
</div>
<!-- ngIf: isAdmin -->
</div>
<div class="widget-body">
<form name="createStore" class="ng-pristine ng-valid">
<div class="widget-main no-padding">
<table id="sample-table-2" class="table table-striped table-hover">
<thead>
    <tr role="row">
        <th class="center border"><span class="hidden-480 ng-binding">Mã chi nhánh</span></th>
        <th class="center border"><span class="hidden-480 ng-binding">Tên chi nhánh</span></th>
        <th class="center border"><span class="hidden-640 ng-binding">Điện thoại</span> <span class="show-640">SĐT</span></th>
        <th class="center border hidden-480 ng-binding">Địa chỉ chi nhánh</th>
        <th class="center border"></th>
    </tr>
</thead>

<tbody>
    <!-- ngRepeat: item in stores --><tr data-ng-repeat="item in stores" class="ng-scope">
        <td class="center">
            <!-- ngIf: !item.$edit --><a data-ng-if="!item.$edit" data-ng-click="item.$edit = true" class="ng-binding ng-scope">               </a><!-- end ngIf: !item.$edit -->
            <!-- ngIf: item.$edit -->
            <div class="has-error ng-hide" data-ng-show="createStore.name.$error.maxlength &amp;&amp; namekeydown == true">
                <div class="help-block col-xs-12 col-sm-reset inline">Mã cửa hàng không được dài quá 15 ký tự! </div>
            </div>
        </td>
        <td class="center">
            <!-- ngIf: !item.$edit --><a data-ng-if="!item.$edit" data-ng-click="item.$edit = true" class="ng-binding ng-scope">Ms Vi</a><!-- end ngIf: !item.$edit -->
            <!-- ngIf: item.$edit -->
        </td>
        <td class="center">
            <!-- ngIf: !item.$edit --><span data-ng-if="!item.$edit" class="ng-binding ng-scope"></span><!-- end ngIf: !item.$edit -->
            <!-- ngIf: item.$edit -->
        </td>
        <td class="left border hidden-480">
            <!-- ngIf: !item.$edit --><span data-ng-if="!item.$edit" class="ng-binding ng-scope"></span><!-- end ngIf: !item.$edit -->
            <!-- ngIf: item.$edit -->
        </td>
        <td class="center">
            <!-- ngIf: !item.$edit --><i data-ng-if="!item.$edit" data-ng-click="item.$edit = true" class="icon-edit bigger-130 blue ng-scope"></i><!-- end ngIf: !item.$edit -->

            <!-- ngIf: item.$edit -->
            <!-- ngIf: item.$edit -->
        </td>
    </tr><!-- end ngRepeat: item in stores -->
</tbody>
</table>
</div>
</form>
</div>
<script type="text/ng-template" id="modalCreateStore.html">
<form name="frmCreateStore" novalidate>
<div class="modal-header no-padding">
<div class="table-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true" data-ng-click="closeModal()">
    <span class="white">×</span>
</button>
{{'Store_Add_Branch' | translate}}
</div>
</div>
<div class="modal-body no-padding">
<div class="row">
<div class="col-xs-12 form-horizontal">
    <div class="form-group" style="margin-top:10px;">
        <label class="col-xs-3 control-label">{{'Branch_Name' | translate}}</label>
        <div class="col-xs-9">
            <input type="text" name="storename" placeholder="Nhập tên cửa hàng" class="width-100" data-ng-model="store.storeName" required maxlength="255" />
            <div class="red" data-ng-show="frmCreateStore.storename.$error.required && frmCreateStore.storename.$dirty">
                {{'Branch_Name_Validation' | translate}}.
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">{{'Branch_Code' | translate}}</label>
        <div class="col-xs-9">
            <input type="text" name="storecode" placeholder="Nhập mã cửa hàng" class="width-100" data-ng-model="store.storeCode" required ng-pattern="/^\S*$/" maxlength="15" />
            <span class="red" data-ng-show="frmCreateStore.storecode.$error.required && frmCreateStore.storecode.$dirty">Bạn chưa nhập mã cửa hàng.</span>
            <span class="red" data-ng-show="frmCreateStore.storecode.$error.pattern && frmCreateStore.storecode.$dirty">Mã cửa hàng không có chứa khoảng trắng và không được dài quá 15 ký tự.</span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">{{'Branch_Address' | translate}}</label>
        <div class="col-xs-9">
            <input type="text" name="storeaddress" placeholder="Nhập địa chỉ" class="width-100" data-ng-model="store.storeAddress" required maxlength="128" />
            <span class="red" data-ng-show="frmCreateStore.storeaddress.$error.required && frmCreateStore.storeaddress.$dirty">Bạn chưa nhập địa chỉ.</span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">{{'Branch_Phone_Number' | translate}}</label>
        <div class="col-xs-9">
            <input type="text" name="storephone" placeholder="Nhập điện thoại" class="width-100" data-ng-model="store.storePhone" required maxlength="128" />
            <span class="red" data-ng-show="frmCreateStore.storephone.$error.required && frmCreateStore.storephone.$dirty">Bạn chưa nhập điện thoại.</span>
        </div>
    </div>
</div>
</div>
</div>
<div class="modal-footer">
<button class="btn btn-sm btn-primary" data-ng-disabled="frmCreateStore.$invalid || isProgressing" data-ng-click="createStore()">
<i class="icon-ok"></i>
{{'Save' | translate}}
</button>

<button class="btn btn-sm" data-ng-click="closeModal()">
<i class="icon-undo"></i>
{{'Cancel' | translate}}
</button>
</div>
</form>
</script>

</div>

<div style="margin-bottom:50px;">



</div>

</div>



</div>
