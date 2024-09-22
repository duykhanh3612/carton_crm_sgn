<div class="row">
    <div class="col-xs-12">
    <div class="table-responsive ng-scope" data-ng-if="product.ProductType == 3">
        <table class="table table-striped table-bordered table-hover dataTable margin-bottom-10">
            <thead>
                <tr role="row">
                    <th class="width-25 ng-binding">Đơn vị quy đổi</th>
                    <th class="width-75 ng-binding">Giá trị</th>
                </tr>
            </thead>
            <tbody role="alert" aria-live="polite" aria-relevant="all">
                <tr>
                    <td>
                        <div class="input-group">
                            <select class="form-control ng-pristine ng-valid" style="border-top-right-radius: 0px !important; border-bottom-right-radius: 0px !important;" data-ng-model="unitComboModel.unitSeleted" data-ng-options="c.name for c in unitComboModel.units" data-ng-change="onchangeUnitCombo(unitComboModel.unitSeleted)"><option value="0" selected="selected">--Chọn đơn vị quy đổi--</option><option value="1">Hộp – Lốc – Thùng</option><option value="2">Lon - Thùng</option><option value="3">Chai - Két</option><option value="4">Gói - Thùng</option><option value="5">Điếu - Gói</option><option value="6">Mét - Cuộn</option></select>
                            <span class="input-group-btn ng-scope" data-ng-controller="widgetUnitComboController">
                                <button class="btn btn-primary" title="Quản lý đơn vị quy đổi" data-ng-click="openUnitComboModal(unitComboModel.units)">...</button>
                            </span>
                        </div>
                    </td>
                    <td>
                        <attribute-tags attr-id="tag-exchange" attr-inputid="value-change" attr-class="tags" attr-placeholder="Nhập đơn vị và enter" attr-maxlength="20" tags="exchange.units" suggest="exchange.suggestUnits" parent-tag="exchange" on-tag="buildExchangeItems" class="ng-isolate-scope"><div id="tag-exchange" class="tags" data-ng-click="setFocus()"><input id="value-change" type="text" placeholder="Nhập đơn vị và enter" class="tags" autocomplete="off" maxlength="20"></div></attribute-tags>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-striped table-hover dataTable ng-hide" style="border: 1px solid #ddd;" data-ng-show="items.length > 0 &amp;&amp; showItem == true">
            <thead>
                <tr role="row">
                    <!-- ngIf: dataFiles.length > 0 -->
                    <!-- ngIf: dataFiles.length <= 0 --><th ng-if="dataFiles.length <= 0" class="width-35 ng-binding ng-scope">Tên</th><!-- end ngIf: dataFiles.length <= 0 -->
                    <th class="width-15 hidden-480 ng-binding">Mã </th>
                    <th has-permission="POSIM_Price_UpdateBuyPrice" class="width-15 ng-binding">Giá vốn</th>
                    <th class="width-15 ng-binding">Giá bán</th>
                    <th class="width-15 ng-binding ng-hide" data-ng-show="isMultiplePrice">Giá sỉ</th>
                    <th class="width-15 ng-binding ng-hide" data-ng-show="isMultiplePrice">Giá vip</th>
                    <th class="width-10 ng-binding" data-ng-show="isInventoryTracked == true">Tồn kho</th>
                    <th class="width-5 ng-binding">Đơn vị nhỏ nhất</th>
                    <th class="width-10 ng-binding">Quy đổi ra đơn vị</th>
                    <!-- ngIf: dataFiles.length > 0 -->
                    <!-- ngIf: dataFiles.length > 0 -->
                </tr>
            </thead>
            <tbody role="alert" aria-live="polite" aria-relevant="all">
                <!-- ngRepeat: item in items -->
            </tbody>
        </table>
        <style type="text/css">
            select, input[type] {
                border-radius: 3px!important;
                height: 34px!important;
                padding: 3px 4px;
                box-shadow: none!important;
                color: #858585;
                background-color: #fff;
                border: 1px solid #d5d5d5;
            }
            .tags {

                padding: 2px 4px;
                vertical-align: top!important;
            }
            .tags {
                display: inline-block;
                padding: 4px 6px;
                color: #777;
                vertical-align: middle;
                background-color: #FFF;
                border: 1px solid #d5d5d5;
                width: 100%;
            }
            .tags input[type=text], .tags input[type=text]:focus {
                border: none;
                display: inline;
                outline: 0;
                margin: 0;
                padding: 0;
                line-height: 18px;
                -webkit-box-shadow: none;
                box-shadow: none;
                width: 100%;
            }
            .input-group {
                position: relative;
                display: flex;
                border-collapse: separate;
                flex-wrap: nowrap;
            }

            .tags .btn-save{
                background-color: #428bca!important;
                    border-color: #428bca;
            }
            input[type=checkbox].ace+.lbl, input[type=radio].ace+.lbl {
                position: relative;
                display: inline-block;
                margin: 0;
                line-height: 20px;
                min-height: 18px;
                min-width: 18px;
                font-weight: 400;
                cursor: pointer;
            }
            .btn-manager-attribute{
                background-color: #428bca!important;
                border-color: #428bca;
            }
            .d-flex-5{
                display: flex;
                align-items: center;
                gap: 5px;
            }
            </style>
    </div>
    </div>
</div>
