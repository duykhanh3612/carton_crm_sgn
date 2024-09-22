<div class="row">
    <div class="col-xs-12">
        <div class="table-responsive ng-hide" style="margin-top: 15px;" ng-show="product.ProductType == 1 || product.ProductType == 2">
            <span><b style="font-size: 14px;" class="ng-binding">Nguyên vật liệu</b></span>
            <div class="form-group">
                <div class="input-group col-xs-12">
                    <div style="margin-top:8px;" ng-controller="productMaterialsSearchCtrl" id="productSearch" class="ng-scope">
                        <autocompletemulti ng-model="productSearchTerm" attr-placeholder="Nhập mã barcode hoặc tên nguyên vật liệu" template-id="productItemTempl" attr-inputid="productSearchInput" attr-inputclass="mousetrap" data="products" on-type="searchTermChanged" on-select="onProductSelected" on-select-empty="onEmptyListSelect" class="autosearch ng-isolate-scope ng-pristine ng-valid">
                        <div class="autocomplete " id=""><span class="input-icon input-icon-right input-group" style="width:100%;"><input type="text" ng-disabled="isDisabled" ng-model="searchParam" placeholder="Nhập mã barcode hoặc tên nguyên vật liệu" class="mousetrap" id="productSearchInput" autocomplete="off" style="position:relative"><i class="icon-remove red ng-hide" style="cursor:pointer;" ng-show="searchParam" ng-click="removeText()"></i><label class="no-padding" style="position:absolute"><input name="form-field-checkbox" class="ace ace-checkbox-2" type="checkbox"></label></span><div class="suggest"><div style="border: 1px solid #888; border-width: 0px 1px 1px 1px; padding:0 5px 5px" ng-show="completing" class="ng-hide">                                <span class="checkbox">                                    <label class="no-padding">                                        <input ng-model="isChecked" class="ace ace-checkbox-2 ng-pristine ng-valid" type="checkbox" ng-change="checkAll()">                                        <span class="lbl"></span>                                        <button ng-click="chooseSelected()" class="btn btn-xs btn-warning">                                            <i class="icon-check"></i>                                            <span>Chọn</span>                                        </button>                                    </label>                                </span>                            </div><ul ng-show="completing" class="ng-hide">
                            <!-- ngRepeat: suggestion in suggestions track by $index -->
                        </ul><ul ng-show="searchParam &amp;&amp; (suggestions == null || suggestions.length == 0)" class="ng-hide"><li>Không tìm thấy kết quả phù hợp</li></ul></div></div></autocompletemulti>
                        <div type="text/x-angular-template" id="productItemTempl">
                            <li suggestionmulti ng-repeat="suggestion in suggestions track by $index" style="cursor:pointer;"
                                index="{{'$index'}}" val="{{'suggestion.itemName'}}" ng-class="{active:($index == selectedIndex)}" ng-click="select(suggestion)">
                                <p style="font-weight:bold;">
                                    <label class="no-padding" ng-click="$event.stopPropagation()">
                                        <input class="ace ace-checkbox-2" type="checkbox" ng-checked="suggestion.isChecked == true" ng-model="suggestion.isChecked">
                                        <span class="lbl"></span>
                                    </label>
                                    <span>{{'suggestion.itemName'}}</span>
                                </p>
                                <p> {{__('Code')}}: {{'suggestion.barcode'}} | {{__('Price')}}: {{'suggestion.retailPrice'}} </p>
                            </li>
                        </div>
                    </div>
                    <span class="input-group-btn hidden-480 ng-scope" style="padding-left: 2px;" data-ng-controller="widgetProductController">
                        <button style="margin-top: 8px;" class="btn btn-primary btn-sm form-control ng-binding" data-ng-click="openProductModal(units)"><i class="icon-list"></i> Tạo mới NVL</button>
                    </span>
                    <span class="input-group-btn hidden-480 ng-scope" style="padding-left: 2px;" data-ng-controller="widgetUnitController">
                        <button style="margin-top: 8px;" class="btn btn-primary btn-sm form-control ng-binding" data-ng-click="openUnitModal(units, materials)"><i class="icon-list"></i> Quản lý đơn vị tính</button>
                    </span>
                </div>
            </div>
            <table class="table table-striped table-hover dataTable">
                <thead>
                    <tr role="row">
                        <th class="width-50 ng-binding">&nbsp;&nbsp;Nguyên vật liệu</th>
                        <th class="width-25 text-center ng-binding">Giá trị định lượng</th>
                        <th class="width-20 text-center ng-binding">Đơn vị tính</th>
                        <th class="width-5"><i class="icon-trash bigger-130" title="Xóa tất cả" ng-click="removeAll()"></i></th>

                    </tr>
                </thead>
                <tbody role="alert" aria-live="polite" aria-relevant="all">
                    <tr ng-show="materials.length == 0" class="">
                        <td class="ng-binding">&nbsp;&nbsp;Chưa có nguyên vật liệu nào</td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                    </tr>
                    <!-- ngRepeat: material in materials track by material.ItemId -->
                </tbody>
            </table>
            <div ng-show="materials.length > 0 &amp;&amp; materialsPrice > 0" class="pull-right hidden-640 ng-hide" style="margin-top: 10px; font-size: 14px;">
                <span tooltip="Giá vốn sẽ được tự động cập nhật dựa trên giá của các NVL." class="badge badge-primary ng-scope"><i class="icon-info smaller"></i></span>&nbsp;&nbsp;<span class="ng-binding">Giá vốn dự trù dựa trên NVL là <span class="orange" style="font-size: 16px;"><b class="ng-binding">0</b></span></span>


            </div>
        </div>
    </div>
</div>
