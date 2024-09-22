<div class="table-responsive ng-scope" data-ng-if="product.ProductType == 5">
    <table class="table table-striped table-bordered table-hover dataTable">
        <thead>
            <tr role="row">
                <th class="width-20 ng-binding">Thuộc tính</th>
                <th class="width-75 ng-binding">Giá trị</th>
                <th class="width-5"></th>
            </tr>
        </thead>
        <tbody role="alert" aria-live="polite" aria-relevant="all">
            <tr data-ng-repeat="attr in tblAttribute" class="ng-scope">
                <td>
                    <select class="width-100 ng-pristine ng-valid" data-ng-options="c.name group by c.groupby for c in attr.attribute.items" data-ng-change="changeAttribute(attr)" options-disabled="c.isdisabled for c in attr.attribute.items"><optgroup label="---"><option value="0" selected="selected">Tạo mới thuộc tính</option></optgroup></select>
                    <div class="input-group">
                        <input id="attrfc75aee2-24fd-47a8-850f-8bfe41910add" type="text" class="width-100 ng-pristine ng-valid" placeholder="Nhập tên thuộc tính" maxlength="200" data-ng-model="attr.attribute.newItemName" ng-enter="createAttribute(attr)">
                        <span class="input-group-btn">
                            <button class="btn btn-primary nowrap" data-ng-disabled="attr.attribute.newItemName == ''" data-ng-click="createAttribute(attr)" disabled="disabled">
                                <i class="fa fa-save bigger-110 btn-save" title="Thêm thuộc tính"></i>
                            </button>
                        </span>
                    </div>
                </td>
                <td>
                    <attribute-tags attr-id="tag-fc75aee2-24fd-47a8-850f-8bfe41910add" attr-inputid="value-fc75aee2-24fd-47a8-850f-8bfe41910add" attr-class="tags" attr-placeholder="Nhập giá trị và enter" attr-maxlength="20" tags="attr.values" suggest="attr.attribute.item.values" parent-tag="attr.attribute.item" on-tag="buildProductItem" class="ng-isolate-scope"><div id="tag-fc75aee2-24fd-47a8-850f-8bfe41910add" class="tags" data-ng-click="setFocus()"><input id="value-fc75aee2-24fd-47a8-850f-8bfe41910add" type="text" placeholder="Nhập giá trị và enter" class="tags" autocomplete="off" maxlength="20"></div></attribute-tags>
                </td>
                <td class="center">
                    <i class="icon-trash bigger-130 ng-hide" data-ng-show="tblAttribute.length > 1" data-ng-click="removeRowAttribute(attr)"></i>
                </td>
            </tr><!-- end ngRepeat: attr in tblAttribute -->
        </tbody>
        <tfoot data-ng-show="attributes.length - 1 > 1 &amp;&amp; tblAttribute.length < attributes.length - 1 &amp;&amp; tblAttribute.length < limitAttribute" class="ng-hide">
            <tr>
                <td colspan="3">
                    <button class="btn btn-primary ng-binding" data-ng-click="addRowAttribute()">Thêm thuộc tính</button>
                    <span class="lbl">
                        <i class="ng-binding">(VD: Màu sắc, kích thước,…)</i>
                    </span>
                </td>
            </tr>
        </tfoot>
    </table>
    <div class="row" style="margin:10px 0px 50px 0px;">
        <label class="col-sm-6 no-padding-left d-flex-5">
            <input type="checkbox" class="ace ng-pristine ng-valid" data-ng-model="showItem">
            <span class="lbl ng-binding">Có <span class="red bolder ng-binding">0</span> Hàng hóa cùng loại</span>
        </label>
        <div class="col-sm-6 no-padding text-right ng-scope" data-ng-controller="widgetAttributeController">
            <button class="btn btn-primary btn-sm ng-binding btn-manager-attribute"><i class="fa fa-list"></i> Quản lý thuộc tính</button>
        </div>
    </div>
    <table class="table table-striped table-hover dataTable ng-hide" style="border: 1px solid #ddd;" data-ng-show="items.length > 0 &amp;&amp; showItem == true">
        <thead>
            <tr role="row">
                <th class="width-5"></th>
                <!-- ngIf: dataFiles.length > 0 -->
                <!-- ngIf: dataFiles.length <= 0 --><th ng-if="dataFiles.length <= 0" class="width-35 ng-binding ng-scope">Tên</th><!-- end ngIf: dataFiles.length <= 0 -->
                <th class="width-15 hidden-480">Mã</th>
                <th has-permission="POSIM_Price_UpdateBuyPrice" class="width-15 ng-binding">Giá vốn</th>
                <th class="width-15 ng-binding">Giá bán</th>
                <th class="width-15 ng-binding ng-hide" data-ng-show="isMultiplePrice">Giá sỉ</th>
                <th class="width-15 ng-binding ng-hide" data-ng-show="isMultiplePrice">Giá vip</th>
                <th class="width-10 ng-binding" data-ng-show="isInventoryTracked == true">Tồn kho</th>
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
