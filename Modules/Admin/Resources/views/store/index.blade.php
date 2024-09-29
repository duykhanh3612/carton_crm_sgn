@extends('admin::layouts.master')
@section('header')
@include('admin::components.header')
@endsection
@section('content')
<div class="container-fluid mt-3">
    @include('admin::store.tabable')
    <div class="nav-tab-content">
    <div class="tab-pane in active" id="user_setting">
        @include("admin::user.setting")
    </div>
    <div class="tab-pane" id="store_setting">
        <div class="profile-feed row-fluid">
            {{-- <div class="row ng-hide" ng-hide="layoutSettings.companyInfo.dataLoaded == true">
                <div>Đang tải dữ liệu</div>
            </div> --}}
            <div class="profile-users clearfix" ng-show="layoutSettings.companyInfo.dataLoaded == true">
                <form class="form-horizontal ng-pristine ng-valid ng-valid-required" name="companyInfoFrm" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="row">
                                <label class="col-sm-4 control-label no-padding-right b ng-binding">Tên cửa hàng</label>
                                <div class="col-sm-8">
                                    <div class="ng-hide" ng-show="layoutSettings.companyInfo.editing">
                                        <div class="">
                                            <input class="form-control ng-pristine ng-valid ng-valid-required" name="name"
                                                type="text" value="{{ @$store->name }}" placeholder="" maxlength="511"
                                                required="">
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="ng-hide"
                                            ng-show="companyInfoFrm.companyName.$dirty &amp;&amp; companyInfoFrm.companyName.$invalid">
                                            <span class="label label-danger arrowed-right">
                                                <span class="ng-hide"
                                                    ng-show="companyInfoFrm.companyName.$error.required">Vui lòng nhập
                                                    tên cửa hàng.</span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="" ng-hide="layoutSettings.companyInfo.editing == true">
                                        <span class="ng-binding" ng-bind="companyInfoModel.companyName">{{ @$store->name}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-4 control-label no-padding-right b ng-binding">Mã cửa hàng</label>
                                <div class="col-sm-8">
                                    <div class="ng-hide" ng-show="layoutSettings.companyInfo.editing">
                                        <input class="form-control ng-pristine ng-valid" type="text"
                                            value="{{ @$store->code }}" name="code" placeholder="" maxlength="127">
                                    </div>
                                    <div class="" ng-hide="layoutSettings.companyInfo.editing == true">
                                        <span class="ng-binding" ng-bind="companyInfoModel.companyCode">{{ @$store->code
                                            }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-4 control-label no-padding-right b ng-binding">Tên người đại
                                    diện</label>
                                <div class="col-sm-8">
                                    <div class="ng-hide" ng-show="layoutSettings.companyInfo.editing">
                                        <div class="">
                                            <input class="form-control ng-pristine ng-valid ng-valid-required"
                                                name="legal_representative" type="text" value="{{ @$store->legal_representative }}"
                                                placeholder="" maxlength="127" required="">
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="ng-hide"
                                            ng-show="companyInfoFrm.legalRepresentative.$dirty &amp;&amp; companyInfoFrm.legalRepresentative.$invalid">
                                            <span class="label label-danger arrowed-right">
                                                <span class="ng-hide"
                                                    ng-show="companyInfoFrm.legalRepresentative.$error.required">Vui
                                                    lòng nhập tên người đại diện của cửa
                                                    hàng.</span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="" ng-hide="layoutSettings.companyInfo.editing == true">
                                        <span class="ng-binding" ng-bind="companyInfoModel.legalRepresentative">{{
                                            @$store->legal_representative }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-4 control-label no-padding-right b ng-binding">Số điện
                                    thoại</label>
                                <div class="col-sm-8">
                                    <div class="ng-hide">
                                        <div class="">
                                            <input class="form-control ng-pristine ng-valid ng-valid-required" name="phone"
                                                type="text" value="{{ @$store->phone }}" placeholder="" maxlength="127"
                                                required="">
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="ng-hide">
                                            <span class="label label-danger arrowed-right">
                                                <span class="ng-hide"
                                                    ng-show="companyInfoFrm.phoneNumber.$error.required">Hãy nhập số
                                                    điện thoại liên hệ của cửa
                                                    hàng.</span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="">
                                        <span class="ng-binding">
                                            {{ @$store->phone }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-4 control-label no-padding-right b">Website</label>
                                <div class="col-sm-8">
                                    <div class="ng-hide" ng-show="layoutSettings.companyInfo.editing">
                                        <input class="form-control ng-pristine ng-valid" type="text"
                                            value="{{ @$store->website }}" name="website" placeholder="" maxlength="127">
                                    </div>
                                    <div class="" ng-hide="layoutSettings.companyInfo.editing == true">
                                        <span class="ng-binding"
                                            ng-bind="(companyInfoModel.website == null || companyInfoModel.website == undefine || companyInfoModel.website == '') &amp;&amp; 'Chưa cập nhật' || companyInfoModel.website">{{
                                            @$store->website }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-4 control-label no-padding-right b ng-binding">Địa chỉ</label>
                                <div class="col-sm-8">
                                    <div class="ng-hide" ng-show="layoutSettings.companyInfo.editing">
                                        <div class="">
                                            <input class="form-control ng-pristine ng-valid" name="address" type="text"
                                                value="{{ @$store->address }}" placeholder="" maxlength="1023">
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <div class="" ng-hide="layoutSettings.companyInfo.editing == true">
                                        <span class="ng-binding"
                                            ng-bind="(companyInfoModel.address == null || companyInfoModel.address == undefine || companyInfoModel.address == '') &amp;&amp; 'Chưa cập nhật' || companyInfoModel.address">{{
                                            @$store->address }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-4 control-label no-padding-right b ng-binding">Ngành kinh doanh</label>
                                <div class="col-sm-8">
                                    <div class="ng-hide" ng-show="layoutSettings.companyInfo.editing">
                                        <select class="form-control  ng-pristine ng-valid"
                                            data-ng-change="getIndustryName(companyInfoModelEditing.industry)"
                                            ng-options="item.id as item.name for item in common.industries"
                                            value="companyInfoModelEditing.industry" name="industry" id="industry">
                                            <option value="0">Chọn ngành hàng bạn đang kinhdoanh</option>
                                            <option value="1" {{@$store->industry == 1?"selected":"" }}>Thời trang</option>
                                            <option value="2" {{@$store->industry == 2?"selected":"" }}>Bar-Cà phê-Nhà hàng</option>
                                            <option value="3" {{@$store->industry == 3?"selected":"" }}>Mẹ và bé</option>
                                            <option value="4" {{@$store->industry == 4?"selected":"" }}>Điện thoại &amp; Điện máy</option>
                                            <option value="5" {{@$store->industry == 5?"selected":"" }}>Mỹ phẩm</option>
                                            <option value="6" {{@$store->industry == 6?"selected":"" }}>Nội thất &amp; Gia dụng</option>
                                            <option value="7" {{@$store->industry == 7?"selected":"" }}>Hoa &amp; Quà tặng</option>
                                            <option value="8" {{@$store->industry == 8?"selected":"" }}>Xe máy &amp; linh kiện</option>
                                            <option value="9" {{@$store->industry == 9?"selected":"" }}>Sách &amp; Văn phòng phẩm</option>
                                            <option value="10" {{@$store->industry == 10?"selected":"" }}>Tạp hóa</option>
                                            <option value="11" {{@$store->industry == 11?"selected":"" }}>Siêu thị mini</option>
                                            <option value="12" {{@$store->industry == 12?"selected":"" }}>Nông sản &amp; Thực phẩm</option>
                                            <option value="13" {{@$store->industry == 13?"selected":"" }}>Nhà thuốc</option>
                                            <option value="14" {{@$store->industry == 14?"selected":"" }}>Khách sạn-Nhà nghỉ</option>
                                            <option value="15" {{@$store->industry == 15?"selected":"" }}>Vật liệu xây dựng</option>
                                            <option value="16" {{@$store->industry == 16?"selected":"" }}>Ngành hàng khác</option>
                                            <option value="17" {{@$store->industry == 16?"selected":"" }}>Bán lẻ</option>
                                        </select>
                                        <input name="industry_name" id="industry_name"  value="{{@$store->industry_name }}" style="display: none;"/>
                                    </div>
                                    <div class="" ng-hide="layoutSettings.companyInfo.editing == true">
                                        <span class="ng-binding" ng-bind="companyInfoModel.industryName">{{@$store->industry_name }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-4 control-label no-padding-right b ng-binding">Mã số thuế</label>
                                <div class="col-sm-8">
                                    <div class="ng-hide" ng-show="layoutSettings.companyInfo.editing">
                                        <div class="">
                                            <input class="form-control  ng-pristine ng-valid" name="tax_code" type="text"
                                                value="{{ @$store->tax_code }}" placeholder="" maxlength="127">
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <div class="" ng-hide="layoutSettings.companyInfo.editing == true">
                                        <span class="ng-binding"
                                            ng-bind="(companyInfoModel.taxCode == null || companyInfoModel.taxCode == undefine || companyInfoModel.taxCode == '') &amp;&amp; 'Chưa cập nhật' || companyInfoModel.taxCode">{{
                                            @$store->tax_code }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix col-xs-12 form-actions submit" style="display: none">
                                @csrf
                                <div class="pull-right">
                                    <button class="btn ng-binding" onclick="cancelEditCompanyInfo();" type="button">
                                        <i class="icon-undo bigger-110"></i>
                                        Hủy
                                    </button>
                                    &nbsp; &nbsp; &nbsp;
                                    <button class="btn btn-primary ng-binding" onclick="saveCompanyInfo();"
                                        ng-disabled="layoutSettings.companyInfo.saving == true" type="button">
                                        <i class="icon-ok bigger-110"></i>
                                        Lưu
                                    </button>
                                </div>
                            </div>
                            <div class="clearfix col-xs-12 form-actions update"
                                ng-hide="layoutSettings.companyInfo.editing == true">
                                <div class="pull-right">
                                    <button class="btn btn-primary ng-binding" onclick="startEditCompanyInfo();"
                                        type="button">
                                        <i class="icon-pencil bigger-110"></i>
                                        Cập nhật
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <div class="widget-main">
                                <div class="ng-hide">


                                    @include('admin::components.inputs.image', [
                                        'label' => "image",
                                        'name' => "image",
                                        'value' =>  @$store->image,
                                        'class' => '',
                                    ])
                                </div>
                                <div>
                                    <img class="company-info-setting-logo"  src="{{ url(image_path(@$store->image)) }}" style="width:100%">
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!--Store Wiget-->
            <div class="col-xs-12 widget-container-span no-padding ng-scope" data-ng-controller="storeController"
                data-ng-init="getStores()">
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
                        <form class="ng-pristine ng-valid" name="createStore">
                            <div class="widget-main no-padding">
                                <table class="table-striped table-hover table" id="sample-table-2">
                                    <thead>
                                        <tr role="row">
                                            <th class="center border">
                                                <span class="hidden-480 ng-binding">Mã chi nhánh</span>
                                            </th>
                                            <th class="center border">
                                                <span class="hidden-480 ng-binding">Tên chi nhánh</span>
                                            </th>
                                            <th class="center border">
                                                <span class="hidden-640 ng-binding">Điện thoại</span> <span class="show-640">SĐT</span>
                                            </th>
                                            <th class="center hidden-480 ng-binding border">Địa chỉ chi nhánh</th>
                                            <th class="center border"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($stores as $r)
                                        <tr class="ng-scope" data-ng-repeat="item in stores">
                                            <td class="center">
                                                <a class="ng-binding ng-scope" data-name="code"
                                                    data-ng-click="item.$edit = true"> {{ $r->code }}</a>

                                                <div class="has-error ng-hide"
                                                    data-ng-show="createStore.name.$error.maxlength &amp;&amp; namekeydown == true">
                                                    <div class="help-block col-xs-12 col-sm-reset inline">
                                                        Mã cửa hàng không được dài quá 15 ký tự! </div>
                                                </div>
                                            </td>
                                            <td class="center">

                                                <a class="ng-binding ng-scope item_edit"  data-name="name" data-ng-click="item.$edit = true">{{ $r->name }}</a>

                                            </td>
                                            <td class="center">
                                                <span class="ng-binding ng-scope" data-name="phone">{{ $r->phone}}</span>
                                            </td>
                                            <td class="left hidden-480 border">
                                                <span class="ng-binding ng-scope" data-name="address">{{ $r->address }}</span>
                                            </td>
                                            <td class="center">
                                                <i class="fa fa-edit bigger-130 blue ng-scope item_edit"></i>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                    <div class="modal fade" id="modalCreateStore">
                        <form name="frmCreateStore" novalidate>
                            <div class="modal-header no-padding">
                                <div class="table-header">
                                    <button class="close" data-dismiss="modal" data-ng-click="closeModal()"
                                        type="button" aria-hidden="true">
                                        <span class="white">×</span>
                                    </button>
                                    {{ __('Store_Add_Branch') }}
                                </div>
                            </div>
                            <div class="modal-body no-padding">
                                <div class="row">
                                    <div class="col-xs-12 form-horizontal">
                                        <div class="form-group" style="margin-top:10px;">
                                            <label class="col-xs-3 control-label">{{ 'Branch_Name' }}</label>
                                            <div class="col-xs-9">
                                                <input class="width-100" name="storename"
                                                    data-ng-model="store.storeName" type="text"
                                                    placeholder="Nhập tên cửa hàng" required maxlength="255" />
                                                <div class="red"
                                                    data-ng-show="frmCreateStore.storename.$error.required && frmCreateStore.storename.$dirty">
                                                    {{ 'Branch_Name_Validation' }}.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-xs-3 control-label">{{ 'Branch_Code' }}</label>
                                            <div class="col-xs-9">
                                                <input class="width-100" name="storecode"
                                                    data-ng-model="store.storeCode" ng-pattern="/^\S*$/" type="text"
                                                    placeholder="Nhập mã cửa hàng" required maxlength="15" />
                                                <span class="red"
                                                    data-ng-show="frmCreateStore.storecode.$error.required && frmCreateStore.storecode.$dirty">Bạn
                                                    chưa nhập mã cửa hàng.</span>
                                                <span class="red"
                                                    data-ng-show="frmCreateStore.storecode.$error.pattern && frmCreateStore.storecode.$dirty">Mã
                                                    cửa hàng không có chứa khoảng trắng và không được dài quá 15 ký
                                                    tự.</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-xs-3 control-label">{{ 'Branch_Address' }}</label>
                                            <div class="col-xs-9">
                                                <input class="width-100" name="storeaddress"
                                                    data-ng-model="store.storeAddress" type="text"
                                                    placeholder="Nhập địa chỉ" required maxlength="128" />
                                                <span class="red"
                                                    data-ng-show="frmCreateStore.storeaddress.$error.required && frmCreateStore.storeaddress.$dirty">Bạn
                                                    chưa nhập địa chỉ.</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-xs-3 control-label">{{ 'Branch_Phone_Number' }}</label>
                                            <div class="col-xs-9">
                                                <input class="width-100" name="storephone"
                                                    data-ng-model="store.storePhone" type="text"
                                                    placeholder="Nhập điện thoại" required maxlength="128" />
                                                <span class="red"
                                                    data-ng-show="frmCreateStore.storephone.$error.required && frmCreateStore.storephone.$dirty">Bạn
                                                    chưa nhập điện thoại.</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-sm btn-primary" data-ng-click="createStore()">
                                    <i class="icon-ok"></i>
                                    {{ __('Save') }}
                                </button>
                                <button class="btn btn-sm" data-ng-click="closeModal()">
                                    <i class="icon-undo"></i>
                                    {{ __('Cancel') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div style="margin-bottom:50px;">
                </div>
            </div>
        </div>
    </div>

    @include("admin::store.setting.website")
</div>

@push('js')
<link href="{{ module_mix('store/assets/style.css') }}" rel="stylesheet">
<script src="{{ module_mix('store/assets/script.js') }}"></script>
@endpush
@endsection
