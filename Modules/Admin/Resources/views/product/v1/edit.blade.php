<div class="nav-tab-content container-fluid ">
    @if(!isset($setting['has_tag']))
        @include("admin::element")
    @endif
    <form action="{{ $link_update??route('admin.page.update', [@$page, @$record->id ?? '']) }}" class="updateFrm" method="POST" enctype="multipart/form-data" >
        {{-- <div class="nav-thead">
            <h2><i class='fa fa-barcode'></i> &nbsp; {{__('Action_'.request()->segment(3))}} thông tin hàng hóa</h2>
            <h2><i class='fa fa-file'></i> &nbsp; Lịch sử thao tác</h2>

        </div> --}}
        <div class="tabbable">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a data-toggle="tab" target="#info">
                        <h4 class="lighter no-margin blue">
                            <i class="icon-info-sign"></i>
                            <span class="hidden-320 ng-binding">TT đơn hàng</span>
                        </h4>
                    </a>
                </li>
                <li>
                    <a data-toggle="tab" target="#tracked">
                        <span class="lighter orange-2"><b class="ng-binding">Lịch sử</b> </span>
                    </a>
                </li>
            </ul>
            <div class="tabset-right" style="right:20px;">
                <button class="btn btn-primary" type="button" onclick="createandcontinue('save')" title="Lưu">
                    <i class="fa fa-check"></i>
                    <span class="hidden-320 ng-binding">Lưu</span>
                </button>
                <button class="btn btn-primary" type="button" onclick="createandcontinue('apply')" title="Lưu và tiếp tục">
                    <i class="fa fa-save"></i>
                    <span class="hidden-320 ng-binding">Lưu và tiếp tục</span>
                </button>
                <a href="{{url('admin/product')}}" class="btn btn-back" title="Trở về">
                    <i class="fa fa-arrow-left"></i>
                    <span class="hidden-320 ng-binding">Trở về</span>
                </a>
            </div>



            <div class="tab-content no-border black padding-0 ">
                <div id="info" class="tab-pane active ">
                    <div class="widget-body">
                        <div class="widget-main padding-4">
                            <div class="tab-content padding-8 overflow-visible">

                                <div class="row">
                                    <div class="col-sm-3">
                                        <h4 class="ng-binding">Thông tin cơ bản</h4>
                                        <span class="hidden-320 ng-binding">
                                            Nhập tên và các thông tin cơ bản của hàng hóa<br><i class="ng-binding">(Ghi chú: Tên hàng hóa là duy nhất và không được trùng nhau)</i>
                                        </span>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="form-group">
                                                    <label class="ng-binding required">Tên hàng hóa</label>
                                                    <div class="form-item">
                                                        <input type="text" name="name" id="name" value="{{@$record->name}}" data-required="1"  placeholder="Nhập tên hàng hóa" class="width-100 ng-pristine ng-valid"  maxlength="200">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="form-group">
                                                    <div class="row">
                                                        {{-- <div class="col-xs-6 ng-binding">
                                                            <label class="ng-binding">Số lượng</label>

                                                            @if(isset($record->qty))
                                                                {{ $record->qty }}
                                                            @else
                                                                <input type="text" name="qty" class="text-right width-100 ng-pristine ng-valid" maxlength="14" >
                                                            @endif
                                                            <div class="width-100">
                                                                <label class="no-padding-left">
                                                                    <span class="lbl ng-binding">Quản lý tồn kho theo serial :</span>
                                                                    <span>

                                                                        <label class="label label-xlg label-primary ng-binding ng-scope" ng-if="!product.isSerial">
                                                                            Không
                                                                        </label>
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <div class="width-100">
                                                                <label class="no-padding-left">
                                                                    <span class="lbl ng-binding">Theo dõi tồn kho :</span>
                                                                    <span>
                                                                        <label class="label label-success label-success-2 ng-binding ng-scope" ng-if="product.isInventoryTracked">
                                                                            Có
                                                                        </label>

                                                                    </span>
                                                                </label>
                                                            </div>
                                                            <div class="width-100">
                                                                <label class="no-padding-left">
                                                                    <span class="lbl ng-binding">Cho phép bán âm:</span>

                                                                    <span class="lbl ng-scope" data-ng-if="product.isUntrackedItemSale" popover="Khi bỏ chọn Cho phép bán âm, hàng hóa còn tồn kho sẽ không cho phép bán khi đã hết số lượng." popover-title="Đang cho bán âm" popover-placement="right" popover-trigger="mouseenter"></span><!-- end ngIf: product.isUntrackedItemSale -->

                                                                    <span data-ng-if="product.isSerial || product.qtyAvailable < 0 || (product.productType >= 1 &amp;&amp; product.productType <= 3)" class="ng-scope">
                                                                            <label class="label label-success label-success-2 ng-binding ng-scope" ng-if="product.isUntrackedItemSale">
                                                                            Có
                                                                        </label>
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <div class="form-group">
                                                    <label class="ng-binding">Giá vốn</label>
                                                    {{-- <button  class="help-button btn btn-primary" title="Xem lịch sử thay đổi giá vốn" data-ng-click="getPriceHistory(HistorybuyPrice)"><i class="fa fa-columns"></i> </button> --}}

                                                    <input type="text" name="original_price" {{!isAdmin()?"disabled":""}} value="{{@$record->original_price}}" placeholder="Nhập giá vốn" class="width-100 input_money text-right ng-scope ng-pristine ng-valid" maxlength="13" autocomplete="off"><!-- end ngIf: (product.productItems[pi_index].buyPrice == null || !product.isInventoryTracked) && product.hasNoPrice -->
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="form-group">
                                                    <label class="ng-binding required">Giá bán</label>

                                                    <input type="text" id="price" name="price" value="{{@$record->price}}" data-required="1"  placeholder="Nhập giá bán" class="width-100 input_money text-right ng-scope ng-pristine ng-valid" maxlength="13"n autocomplete="off">
                                                    <div class="errordiv price">
                                                        <div class="arrow"></div>Xin hẫy nhận giá bán!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="row ng-hide" data-ng-show="isMultiplePrice">
                                            <div class="col-xs-6">
                                                <div class="form-group">
                                                    <label class="ng-binding">Giá sỉ</label>

                                                    <input type="text" placeholder="Nhập giá sỉ" class="width-100 text-right ng-scope ng-pristine ng-valid" auto-numeric="{vMin: 0, vMax: 9999999999}" data-ng-model="product.wholeSalePrice" data-ng-if="product.hasNoPrice" maxlength="13"><!-- end ngIf: product.hasNoPrice -->
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="form-group">
                                                    <label class="ng-binding">Giá vip</label>
                                                    <input type="text" placeholder="Nhập giá vip" class="width-100 text-right ng-scope ng-pristine ng-valid" auto-numeric="{vMin: 0, vMax: 9999999999}" data-ng-model="product.vipPrice" data-ng-if="product.hasNoPrice" maxlength="13"><!-- end ngIf: product.hasNoPrice -->
                                                </div>
                                            </div>
                                        </div> --}}
                                        {{-- <div class="row">
                                            <div class="col-xs-6" data-ng-init="initCategory()">
                                                <div class="form-group">
                                                    <label class="ng-binding">Nhóm hàng</label>
                                                    <div class="input-group">
                                                        <select class="form-control ng-pristine ng-valid" style="border-top-right-radius: 0px !important; border-bottom-right-radius: 0px !important;" data-ng-model="category" data-ng-options="c.name group by c.groupby for c in categories" data-ng-change="changeCategory()"><optgroup label="Chọn nhóm hàng"><option value="0">THÙNG CARTON</option><option value="1">BĂNG KEO</option><option value="2">MÀNG PE</option><option value="3">Bong Bóng Khí</option><option value="4">GIẤY</option><option value="5">Phí Ship</option><option value="6">Túi Bóng Khí</option><option value="7">Carton Kho 2</option><option value="8">khuông bế</option><option value="9">thung size moi</option><option value="10">cắt keo</option><option value="11">Túi Giấy Xi Măng</option><option value="12">Khung - Khuon</option><option value="13">Giấy tấm</option><option value="14">hộp đựng thức ăn</option><option value="15">Túi Nilong</option><option value="16">Tô Ly Giấy</option><option value="17" selected="selected">Chưa có nhóm hàng</option></optgroup><optgroup label="------------------------"><option value="18">Tạo mới nhóm hàng</option></optgroup></select>
                                                        <span class="input-group-btn ng-scope" data-ng-controller="widgetCategoryController">
                                                            <button class="btn btn-primary" title="Quản lý nhóm hàng" data-ng-click="openCategoryModal(categories)">...</button>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="form-group ng-hide" data-ng-show="category.id == -1">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control ng-pristine ng-valid" placeholder="Nhập tên nhóm hàng" maxlength="200" data-ng-model="categoryName" ng-enter="createCategory()">
                                                        <span class="input-group-btn padding-left-3">
                                                            <select data-ng-model="parentCategory" class="nowrap ng-pristine ng-valid" data-ng-options="c.name for c in parentCategories"><option value="0" selected="selected">---Nhóm hàng cha---</option><option value="1">THÙNG CARTON</option><option value="2">BĂNG KEO</option><option value="3">MÀNG PE</option><option value="4">Bong Bóng Khí</option><option value="5">GIẤY</option><option value="6">Phí Ship</option><option value="7">Túi Bóng Khí</option><option value="8">Carton Kho 2</option><option value="9">khuông bế</option><option value="10">thung size moi</option><option value="11">cắt keo</option><option value="12">Túi Giấy Xi Măng</option><option value="13">Khung - Khuon</option><option value="14">Giấy tấm</option><option value="15">hộp đựng thức ăn</option><option value="16">Túi Nilong</option><option value="17">Tô Ly Giấy</option></select>
                                                        </span>
                                                        <span class="input-group-btn padding-left-3">
                                                            <button class="btn btn-primary nowrap" data-ng-click="createCategory()" data-ng-disabled="categoryName == ''" disabled="disabled">
                                                                <i class="icon-save bigger-110" title="Tạo mới Nhóm hàng"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-6" data-ng-init="initManufacturer()">
                                                <div class="form-group">
                                                    <label class="ng-binding">Nhà sản xuất</label>
                                                    <div class="input-group">
                                                        <select class="form-control ng-pristine ng-valid" style="border-top-right-radius: 0px !important; border-bottom-right-radius: 0px !important;" data-ng-model="manufacturer" data-ng-options="c.name group by c.groupby for c in manufacturers"><optgroup label="Nhà sản xuất"><option value="0" selected="selected">Chưa có nhà sản xuất</option></optgroup><optgroup label="----------------------"><option value="1">Tạo mới nhà sản xuất</option></optgroup></select>
                                                        <span class="input-group-btn ng-scope" data-ng-controller="widgetManufacturerController">
                                                            <button class="btn btn-primary" title="Quản lý nhà sản xuất" data-ng-click="openManufacturerModal(manufacturers)">...</button>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="form-group ng-hide" data-ng-show="manufacturer.id == -1">
                                                    <div class="input-group">
                                                        <input type="text" placeholder="Nhập tên nhà sản xuất" maxlength="512" class="form-control ng-pristine ng-valid" data-ng-model="manufacturerName" ng-enter="createManufacturer()">
                                                        <span class="input-group-btn padding-left-3">
                                                            <button class="btn btn-primary inline" data-ng-disabled="manufacturerName == ''" data-ng-click="createManufacturer()" disabled="disabled"><i class="icon-save bigger-110" title="Tạo mới nhà sản xuất"></i></button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6 ng-scope" data-ng-if="!product.isAttributed">
                                                <div class="form-group" ng-class="!validCode?'has-warning orange':''">
                                                    <label class="ng-binding">Mã hàng hóa</label>
                                                    <div has-permission="POSIM_Price_UpdateBuyPrice">

                                                        <span class="block input-icon input-icon-right">

                                                            <input type="text" name="sku" value="{{@$record->sku}}" placeholder="Nhập tên nhóm hàng" maxlength="512" class="form-control ng-scope ng-pristine ng-valid" >
                                                            <i ng-show="!validCode" class="ace-icon fa icon-warning-sign orange ng-hide"></i>
                                                        </span>

                                                    </div>

                                                    <div has-permission="!POSIM_Price_UpdateBuyPrice" style="display: none;">
                                                        <div class="width-100 ng-binding">SP001080</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="form-group">
                                                    <label class="ng-binding">Thuế VAT</label>
                                                    <select class="form-control ng-pristine ng-valid" data-ng-model="tax">
                                                        <option value="-1" class="ng-binding">Không tính thuế</option>
                                                        <option value="0">0%</option>
                                                        <option value="5">5%</option>
                                                        <option value="8">8%</option>
                                                        <option value="10">10%</option>
                                                        <option value="-2" class="ng-binding">Khác</option>
                                                    </select>
                                                    <div class="width-100 ng-binding">0%</div>
                                                </div>
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3" ng-hide="product.ProductType == 1 || !isInventoryTracked">
                                        <h4 class="hidden-320 ng-binding">Danh mục</h4>
                                        <span class="hidden-320 ng-binding">Thiết lập danh mục đối với hàng hóa này.</span>
                                    </div>
                                    <div class="col-sm-9">
                                        {{-- <div class="row" ng-hide="product.ProductType == 1 || !isInventoryTracked">
                                            <div class="col-xs-6">
                                                <div class="form-group">
                                                    <label class="ng-binding">Tồn kho tối thiểu</label>
                                                    <input type="text" placeholder="Tồn kho tối thiểu" class="width-100 text-right ng-pristine ng-valid" auto-numeric="{vMin: 0, vMax: 999999999}" data-ng-model="minQtyAvailable" maxlength="14">
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="form-group">
                                                    <label class="ng-binding">Tồn kho tối đa</label>
                                                    <input type="text" placeholder="Tồn kho tối đa" class="width-100 text-right ng-pristine ng-valid" auto-numeric="{vMin: 0, vMax: 999999999}" data-ng-model="maxQtyAvailable" maxlength="14">
                                                </div>
                                            </div>
                                        </div> --}}
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <div class="form-group">
                                                    <label class="ng-binding required">Danh mục hàng hóa</label>
                                                    <div class="form-item">
                                                        <select name="product_category_id" id="product_category_id" class="form-control ng-pristine ng-valid" data-required="1" placeholder="Chọn danh mục hàng hóa">
                                                            <option value="" selected="selected">Chọn</option>
                                                            @php
                                                            $groups = get_data("product_category","","**");
                                                            @endphp
                                                            @foreach($groups as $g)
                                                            <option value="{{$g->id}}" {{@$record->product_category_id == $g->id?'selected':''}}>{{$g->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="form-group">
                                                    {{-- <div class="checkbox width-100">
                                                        <label ng-hide="product.ProductType == 1 || product.ProductType == 2 || product.ProductType == 3 || !isInventoryTracked" class="no-padding-right no-padding-left">
                                                            <input type="checkbox" class="ace ng-pristine ng-valid" data-ng-model="isSerial" data-ng-disabled="product.ProductType >= 1 &amp;&amp; product.ProductType <= 3">
                                                            <span class="lbl main-color ng-binding"> Quản lý tồn kho theo serial ?</span>
                                                        </label>
                                                        <span ng-hide="product.ProductType == 1 || product.ProductType == 2 || product.ProductType == 3 || !isInventoryTracked" class="help-button ng-scope" style="line-height: 19px;" popover="Khi khai báo hàng hóa, nếu bạn chọn quản lý hàng hóa theo serial thì bạn vui lòng vào nhập kho để nhập số lượng hàng hóa." popover-title="Quản lý serial" popover-placement="left" popover-trigger="mouseenter">
                                                            <i class="icon-info"></i>
                                                        </span>
                                                    </div> --}}
                                                    <div class="checkbox width-100">
                                                        <label class="ng-binding">Tùy chọn</label>
                                                        <div>
                                                            <label class="no-padding-right no-padding-left">
                                                                <input type="checkbox" {{@$record->is_sale?'checked':''}} class="ace ng-pristine ng-valid ele_checkbox" for="is_sale">
                                                                <input type="hidden" name="is_sale" value="{{intval(@$record->is_sale)}}"  />
                                                                <span class="lbl main-color ng-binding"> SP bán chạy</span>
                                                            </label>

                                                            <label class="no-padding-right no-padding-left">
                                                                <input type="checkbox" {{@$record->published?'checked':''}} class="ace ng-pristine ng-valid ele_checkbox" for="published">
                                                                <input type="hidden" name="published" value="{{intval(@$record->published)}}"  />
                                                                <span class="lbl main-color ng-binding"> Hiển thị ra Website ?</span>
                                                            </label>
                                                            <span class="help-button ng-scope" style="line-height: 19px;" popover="Hiển thị hàng hóa trong danh sách ở POS. Lưu ý: Hàng hóa không hiển thị ở danh sách vẫn có thể tìm kiếm hoặc quét mã barcode." popover-title="Hiển thị ra POS" popover-placement="left" popover-trigger="mouseenter">
                                                                <i class="icon-info"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                @include('admin::components.inputs.image', [
                                                    'label' => "Ảnh đại diện",
                                                    'name' => "image",
                                                    'value' => @$record->image,
                                                    'class' => @$record->autoupdate?'update-eloquent ':'',
                                                ])
                                            </div>
                                            <div class="col-md-8">
                                                @include('admin::components.inputs.gallery', [
                                                    'label' => "Gallery",
                                                    'name' => "gallery",
                                                    'value' => @$record->gallery,
                                                    'class' => '',
                                                ])
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h4 class="ng-binding">Thông tin sản phẩm </h4>
                                            <span class="hidden-320 ng-binding">
                                                Nhập thông tin  chi tiết của hàng hóa<br>
                                            </span>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="form-group">
                                                        <label class="ng-binding">Mô tả</label>
                                                        <textarea class="form-control" name="description">{{@$record->description}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="form-group">
                                                        @include('admin::components.inputs.fck_editor', [
                                                            'label' => "Nội dung",
                                                            'name' => "long_description",
                                                            'value' => @$record->long_description,
                                                            'class' => '',
                                                        ])
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                                <input type="hidden" id="update-eloquent-link" value="{{  $link_update??route('admin.page.update', [$page, @$record->id ?? '']) }}" />

                            </div>
                        </div>
                    </div>
                </div>

                <div id="tracked" class="tab-pane" ng-class="{ 'tracked ' : events.length > 0 }">
                    @include("admin::product.history")
                </div>
            </div>

        </div>
        @csrf
    </form>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script>

        $(document).on("click",'.tabbable > .nav-tabs > li >a', function(){
            target = $(this).attr("target");
            $('.tabbable > .nav-tabs > li').removeClass("active");
            $(this).parent().addClass("active");

            $('.tabbable > .tab-content > .tab-pane').removeClass("active");
            $('.tabbable > .tab-content').find(target).addClass("active");
        });
        $('.input_money').mask('#,##0', {
            reverse: true
        });
        $(document).on("change",".ele_checkbox",function(){
            var ele = $(this).attr("for");
            $("input[name="+ele+"]").val($(this).prop("checked")?1:0);
        });
        function createandcontinue($action)
        {
            $("form.updateFrm").append("<input name='action' value='"+$action+"' />");
            if(!checkUpdateFrm())
            {
                $("form.updateFrm").submit();
            }

        }
    </script>
</div>
