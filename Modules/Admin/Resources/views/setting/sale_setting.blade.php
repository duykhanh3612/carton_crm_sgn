<div class="profile-feed row-fluid">
    <div class="row ng-hide" ng-hide="layoutSettings.saleSetting.enableTab == true">
        <div>Bạn không được phép xem cấu hình bán hàng</div>
    </div>

    <div class="col-xs-12" ng-show="layoutSettings.saleSetting.enableTab == true">
        <div class="form-group">
            <label class="col-sm-4 control-label no-padding-right ng-binding">Cho phép trả hàng</label>
            <div class="col-sm-8">
                <label>
                    <input type="radio" class="ace ng-pristine ng-valid" name="form-field-allowProductReturnDay" ng-model="saleSettingModel.allowProductReturnDay" ng-value="true" value="true">
                    <span class="lbl ng-binding">Có</span>
                </label>

                <label>
                    <input type="radio" class="ace ng-pristine ng-valid" name="form-field-allowProductReturnDay" ng-model="saleSettingModel.allowProductReturnDay" ng-value="false" value="false">
                    <span class="lbl ng-binding">Không</span>
                </label>

            </div>
        </div>
        <div ng-show="saleSettingModel.allowProductReturnDay==true" class="form-group">
            <label class="col-sm-4 control-label no-padding-right ng-binding">Thời hạn đổi trả hàng </label>
            <div class="col-sm-8">
                <i class="ng-binding">trong vòng
                    <input type="text" number="" maxlength="3" class="ace input-mini text-right ng-pristine ng-valid" ng-model="saleSettingModel.productReturnDay">
                    ngày </i>
            </div>
        </div>
        <div class="form-group margin-10">
            <label class="col-sm-4 control-label no-padding-right ng-binding">Thời hạn hàng tồn kho lâu </label>
            <div class="col-sm-8">
                <i class="ng-binding">
                    vượt quá
                    <input type="text" number="" maxlength="3" class="ace input-mini text-right ng-pristine ng-valid" ng-model="saleSettingModel.longtimeInventories">
                    ngày
                </i>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label no-padding-right ng-binding">Cho phép sửa giá bán</label>
            <div class="col-sm-8">
                <label>
                    <input type="radio" class="ace ng-pristine ng-valid" name="form-field-allowPriceModified" ng-model="saleSettingModel.allowPriceModified" ng-value="true" value="true">
                    <span class="lbl ng-binding">Có</span>
                </label>
                <label>
                    <input type="radio" class="ace ng-pristine ng-valid" name="form-field-allowPriceModified" ng-model="saleSettingModel.allowPriceModified" ng-value="false" value="false">
                    <span class="lbl ng-binding">Không</span>
                </label>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label no-padding-right ng-binding">Cho phép nợ</label>
            <div class="col-sm-8">
                <label>
                    <input type="radio" class="ace ng-pristine ng-valid" name="form-field-allowDebtPayment" ng-model="saleSettingModel.allowDebtPayment" ng-value="true" value="true">
                    <span class="lbl ng-binding">Có</span>
                </label>

                <label>
                    <input type="radio" class="ace ng-pristine ng-valid" name="form-field-allowDebtPayment" ng-model="saleSettingModel.allowDebtPayment" ng-value="false" value="false">
                    <span class="lbl ng-binding">Không</span>
                </label>
            </div>
        </div>
        <div class="form-group" style="clear:both">
            <label class="col-sm-4 control-label no-padding-right ng-binding">Thứ tự thu/trả nợ</label>
            <div class="col-sm-8">
                <label>
                    <input type="radio" class="ace ng-pristine ng-valid" name="form-field-receiptVoucherMethod" ng-model="saleSettingModel.receiptVoucherMethod" ng-value="1" value="1">
                    <span class="lbl ng-binding"> Từ mới đến cũ</span>
                </label>

                <label>
                    <input type="radio" class="ace ng-pristine ng-valid" name="form-field-receiptVoucherMethod" ng-model="saleSettingModel.receiptVoucherMethod" ng-value="2" value="2">
                    <span class="lbl ng-binding">Từ cũ đến mới </span>
                </label>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label no-padding-right ng-binding">Phương pháp tính giá vốn</label>
            <div class="col-sm-8">
                <label>
                    <input type="radio" class="ace ng-pristine ng-valid" name="form-field-cogsCalculationMethod" ng-model="saleSettingModel.cogsCalculationMethod" ng-value="2" value="2">
                    <span class="lbl ng-binding">Bình quân gia quyền</span>
                </label>

                <label>
                    <input type="radio" class="ace ng-pristine ng-valid" name="form-field-cogsCalculationMethod" ng-model="saleSettingModel.cogsCalculationMethod" ng-value="1" value="1">
                    <span class="lbl ng-binding">Giá cuối </span>
                </label>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label no-padding-right ng-binding">Cho phép nhập số lượng là số thập phân</label>
            <div class="col-sm-8">
                <label>
                    <input type="radio" class="ace ng-pristine ng-valid" name="form-field-allowQuantityAsDecimal" ng-model="saleSettingModel.allowQuantityAsDecimal" ng-value="true" value="true">
                    <span class="lbl ng-binding">Có</span>
                </label>

                <label>
                    <input type="radio" class="ace ng-pristine ng-valid" name="form-field-allowQuantityAsDecimal" ng-model="saleSettingModel.allowQuantityAsDecimal" ng-value="false" value="false">
                    <span class="lbl ng-binding">Không</span>
                </label>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label no-padding-right ng-binding">Áp dụng chính sách giá theo loại khách hàng(giá sỉ, giá vip)</label>
            <div class="col-sm-8">
                <label>
                    <input type="radio" class="ace ng-pristine ng-valid" name="form-field-applyCustomerPricingPolicy" ng-model="saleSettingModel.applyCustomerPricingPolicy" ng-value="true" value="true">
                    <span class="lbl ng-binding">Có</span>
                </label>

                <label>
                    <input type="radio" class="ace ng-pristine ng-valid" name="form-field-applyCustomerPricingPolicy" ng-model="saleSettingModel.applyCustomerPricingPolicy" ng-value="false" value="false">
                    <span class="lbl ng-binding">Không</span>
                </label>
            </div>
        </div>
        <div class="form-group" style="display: none;">
            <label class="col-sm-4 control-label no-padding-right ng-binding">Thuế VAT</label>
            <div class="col-sm-8">
                <label>
                    <input type="radio" class="ace ng-pristine ng-valid" name="form-field-allowTaxModified" ng-model="saleSettingModel.allowTaxModified" ng-value="true" value="true">
                    <span class="lbl ng-binding">Có</span>
                </label>

                <label>
                    <input type="radio" class="ace ng-pristine ng-valid" name="form-field-allowTaxModified" ng-model="saleSettingModel.allowTaxModified" ng-value="false" value="false">
                    <span class="lbl ng-binding">Không</span>
                </label>
            </div>
        </div>
        <div class="form-group" style="display: none;">
            <label class="col-sm-4 control-label no-padding-right ng-binding">Hình thức </label>
            <div class="col-sm-8">
                <div class="checkbox">
                    <label>
                        <input name="form-field-checkbox" type="checkbox" class="ace ng-pristine ng-valid" ng-model="saleSettingModel.cashPaymentMethod">
                        <span class="lbl ng-binding">Tiền mặt</span>
                    </label>
                    <label>
                        <input name="form-field-checkbox" type="checkbox" class="ace ng-pristine ng-valid" ng-model="saleSettingModel.bankTransferPaymentMethod">
                        <span class="lbl ng-binding">CK</span>
                    </label>
                    <label>
                        <input name="form-field-checkbox" type="checkbox" class="ace ng-pristine ng-valid" ng-model="saleSettingModel.cardPaymentMethod">
                        <span class="lbl ng-binding">Thẻ</span>
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group" style="clear:both">
            <label class="col-sm-4 control-label no-padding-right ng-binding">Chạy POS offline khi mất kết nối internet</label>
            <div class="col-sm-8">
                <label>
                    <input type="radio" class="ace ng-pristine ng-valid" name="form-field-allowCacheOffline" ng-model="saleSettingModel.allowOfflineCache" ng-value="true" value="true">
                    <span class="lbl ng-binding">Bật</span>
                </label>

                <label>
                    <input type="radio" class="ace ng-pristine ng-valid" name="form-field-allowCacheOffline" ng-model="saleSettingModel.allowOfflineCache" ng-value="false" value="false">
                    <span class="lbl ng-binding">Tắt </span>
                </label>
            </div>
        </div>
        <div class="form-group" style="clear:both" has-permission="POSIM_Promotion">
            <label class="col-sm-4 control-label no-padding-right ng-binding">Áp dụng chương trình khuyến mãi</label>
            <div class="col-sm-8">
                <label>
                    <input type="radio" class="ace ng-pristine ng-valid" name="form-field-promotion" ng-model="saleSettingModel.applyPromotion" ng-value="true" value="true">
                    <span class="lbl ng-binding">Bật</span>
                </label>

                <label>
                    <input type="radio" class="ace ng-pristine ng-valid" name="form-field-promotion" ng-model="saleSettingModel.applyPromotion" ng-value="false" value="false">
                    <span class="lbl ng-binding">Tắt </span>
                </label>
            </div>
        </div>
        <div class="form-group" style="clear:both">
            <label class="col-sm-4 control-label no-padding-right ng-binding">Hiển thị tổng tồn kho</label>
            <div class="col-sm-8">
                <label>
                    <input type="radio" class="ace ng-pristine ng-valid" name="form-field-customerCare" ng-model="saleSettingModel.showInventoryTotal" ng-value="true" value="true">
                    <span class="lbl ng-binding">Bật</span>
                </label>

                <label>
                    <input type="radio" class="ace ng-pristine ng-valid" name="form-field-customerCare" ng-model="saleSettingModel.showInventoryTotal" ng-value="false" value="false">
                    <span class="lbl ng-binding">Tắt </span>
                </label>
            </div>
        </div>
        <div class="form-group" style="clear:both">
            <label class="col-sm-4 control-label no-padding-right ng-binding">In các thành phần tham gia cho hàng hóa định lượng</label>
            <div class="col-sm-8">
                <label>
                    <input type="radio" class="ace ng-pristine ng-valid" name="form-field-isPrintMaterials" ng-model="saleSettingModel.isPrintMaterials" ng-value="true" value="true">
                    <span class="lbl ng-binding">Bật</span>
                </label>

                <label>
                    <input type="radio" class="ace ng-pristine ng-valid" name="form-field-isPrintMaterials" ng-model="saleSettingModel.isPrintMaterials" ng-value="false" value="false">
                    <span class="lbl ng-binding">Tắt </span>
                </label>
            </div>
        </div>
        <div class="form-group" style="clear:both">
            <label class="col-sm-4 control-label no-padding-right ng-binding">Giới hạn xem báo cáo cuối ngày</label>
            <div class="col-sm-8">
                <label>
                    <input type="radio" class="ace ng-pristine ng-valid" name="form-field-saleReportSetting" ng-model="saleSettingModel.saleReportSetting" ng-value="0" value="0">
                    <span class="lbl ng-binding">Tắt </span>
                </label>
                <label>
                    <input type="radio" class="ace ng-pristine ng-valid" name="form-field-saleReportSetting" ng-model="saleSettingModel.saleReportSetting" ng-value="1" value="1">
                    <span class="lbl ng-binding">Theo nhân viên</span>
                </label>
                <label>
                    <input type="radio" class="ace ng-pristine ng-valid" name="form-field-saleReportSetting" ng-model="saleSettingModel.saleReportSetting" ng-value="2" value="2">
                    <span class="lbl ng-binding">Ẩn báo cáo</span>
                </label>
            </div>
        </div>

        <!-- ngIf: isAdmin && saleSettingModel.isHasSampleData != false -->
        <div></div>
        <div class="clearfix col-xs-12 form-actions ">
            <div class="pull-right">
                <button class="btn btn-primary" type="button" ng-click="saveSaleSetting();" ng-disabled="layoutSettings.saleSetting.saving==true">
                    <i class="icon-ok bigger-110"></i>
                    <span class="ng-binding">Lưu</span>
                </button>
            </div>
        </div>
    </div>

</div>
