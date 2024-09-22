<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0 text-uppercase font-weight-bold">
                    {{ request()->segment(3)=="create"?"Tạo":"Chỉnh sửa"}} sản phẩm
                </h1>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<form action="{{ $link_update??route('admin.page.update', [@$page, @$record->id ?? '']) }}"
      id="updateFrm"
      method="POST"
      enctype="multipart/form-data">
    <!-- Thông tin cơ bản -->
    <div id="productGeneralInfo2"
         class="border-bottom border-info pb-3 tabbable"
         style="padding-left:17px;padding-right:17px;">
        <ul class="nav nav-tabs">
            <li class="active">
                <a data-toggle="tab"
                   target="#info">
                    THÔNG TIN CƠ BẢN
                </a>
            </li>
            <li>
                <a data-toggle="tab"
                   target="#tracked">
                    Lịch sử
                </a>
            </li>
        </ul>


        <div class="tab-content no-border black padding-0 ">
            <div id="info"
                 class="tab-pane active ">
                <div class="widget-body">
                    <div class="widget-main padding-4">
                        <div class="tab-content padding-8 overflow-visible">
                            <p class="text-gray">
                                Nhập tên và các thông tin cơ bản của sản phẩm
                            </p>
                            <i class="text-danger">
                                (Ghi chú: Tên sản phẩm là duy nhất và không được trùng nhau)
                            </i>
                            <!-- content -->
                            <div class="row">
                                <!-- tên sản phẩm -->
                                <div class="col-8 mt-2">
                                    <div class="form-group">
                                        <label for="productName">Tên sản phẩm<span class="text-danger">(*)</span></label>
                                        <input type="text"
                                               class="form-control"
                                               name="name"
                                               id="name"
                                               value="{{@$record->name}}"
                                               data-required="1"
                                               placeholder="Nhập tên sản phẩm"
                                               maxlength="200"
                                               value="GIẤY KRAFT 50CM X 100CM">
                                        <small id="productNameWarning"
                                               class="text-muted text-red"></small>
                                    </div>
                                </div>
                                <!-- Loại sản phẩm -->
                                <div class="col-4 mt-2">
                                    <div class="form-group">
                                        <label for="productCategory">Loại sản phẩm <span class="text-danger">(*)</span></label>
                                        <select name="product_category_id"
                                                id="product_category_id"
                                                class="form-control ng-pristine ng-valid"
                                                data-required="1"
                                                placeholder="Chọn danh mục hàng hóa">
                                            <option value="">Chọn</option>
                                            @php
                                            $groups = get_data("product_category","","**");
                                            @endphp
                                            @foreach($groups as $g)
                                            <option value="{{$g->id}}"
                                                    {{@$record->product_category_id == $g->id?'selected':''}}>{{$g->name}}</option>
                                            @endforeach
                                        </select>
                                        <small id="productCategoryWarning"
                                               class="text-muted text-red"></small>
                                    </div>
                                </div>
                                <!-- Số lương -->
                                {{-- <div class="col-3 mt-2">
                                    <div class="form-group">
                                        <label for="productQuantity">Số lượng <span class="text-danger">(*)</span></label>
                                        <input type="number"
                                               class="form-control"
                                               name="productQuantity"
                                               id="productQuantity"
                                               placeholder="Nhập số lượng sản phẩm"
                                               min="0"
                                               step="1"
                                               value="100"
                                               oninput="validity.valid||(value = this.previousValue);"
                                               onfocus="this.type='number'; this.value=this.lastValue"
                                               onblur="this.type=''; this.lastValue=this.value; this.value=this.value==''?'':(+this.value).toLocaleString()">
                                        <small id="productQuantityWarning"
                                               class="text-muted text-red"></small>
                                    </div>
                                </div> --}}
                                <!-- Giá vốn -->
                                <div class="col-3 mt-2">
                                    <div class="form-group">
                                        <label for="productCostOfSale">Giá vốn <span class="text-danger">(*)</span></label>
                                        <input type="text"
                                               name="original_price"
                                               {{@$record->original_price=="" ||check_rights_function('adjustment_cost_price','read')?"":"disabled"}} value="{{@$record->original_price}}" placeholder="Nhập giá vốn" class="form-control input_money text-right ng-scope ng-pristine ng-valid" maxlength="13" autocomplete="off" data-required="1">
                                        <!-- end ngIf: (product.productItems[pi_index].buyPrice == null || !product.isInventoryTracked) && product.hasNoPrice -->
                                    </div>
                                </div>
                                <!-- Giá bán -->
                                <div class="col-3 mt-2">
                                    <div class="form-group">
                                        <label for="productPrice">Giá bán <span class="text-danger">(*)</span></label>

                                        <input type="text"
                                               id="price"
                                               name="price"
                                               {{@$record->price=="" || check_rights_function('adjustment_sell_price','read')?"":"disabled"}} value="{{@$record->price}}" data-required="1" placeholder="Nhập giá bán" class="form-control input_money text-right ng-scope ng-pristine ng-valid" maxlength="13"n autocomplete="off" data-required="1">
                                        <div class="errordiv price">
                                            <div class="arrow"></div>Xin hẫy nhận giá bán!
                                        </div>

                                    </div>
                                </div>
                                <!-- Thuế VAT -->
                                {{-- <div class="col-3 mt-2">
                                    <div class="form-group">
                                        <label for="productVAT">Thuế VAT</label>
                                        <select class="form-control"
                                                name="productVAT"
                                                id="productVAT">
                                            <option value="-1">Không tính thuế</option>
                                            <option value="0">0%</option>
                                            <option value="5">5%</option>
                                            <option value="8">8%</option>
                                            <option value="10">10%</option>
                                            <option value="-2">Khác</option>
                                        </select>
                                        <small id="productVATWarning"
                                               class="text-muted text-red"></small>
                                    </div>
                                </div> --}}
                                <div class="col-3 mt-2">
                                    <label class="ng-binding">Tùy chọn</label>
                                    <div>
                                        <label class="no-padding-right no-padding-left">
                                            <input type="checkbox"
                                                   {{@$record->is_sale?'checked':''}} class="ace ng-pristine ng-valid ele_checkbox" for="is_sale">
                                            <input type="hidden"
                                                   name="is_sale"
                                                   value="{{intval(@$record->is_sale)}}" />
                                            <span class="lbl main-color ng-binding"> SP bán chạy</span>
                                        </label>

                                        <label class="no-padding-right no-padding-left">
                                            <input type="checkbox"
                                                   {{@$record->published?'checked':''}} class="ace ng-pristine ng-valid ele_checkbox" for="published">
                                            <input type="hidden"
                                                   name="published"
                                                   value="{{intval(@$record->published)}}" />
                                            <span class="lbl main-color ng-binding"> Hiển thị ra Website ?</span>
                                        </label>
                                        <span class="help-button ng-scope"
                                              style="line-height: 19px;"
                                              popover="Hiển thị hàng hóa trong danh sách ở POS. Lưu ý: Hàng hóa không hiển thị ở danh sách vẫn có thể tìm kiếm hoặc quét mã barcode."
                                              popover-title="Hiển thị ra POS"
                                              popover-placement="left"
                                              popover-trigger="mouseenter">
                                            <i class="icon-info"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <!-- Ảnh sản phẩm -->
                            <div id="productInventoryManagement"
                                 class="border-bottom border-info px-40 py-3">
                                <h4 class="text-main-blue-3 text-uppercase">Ảnh sản phẩm</h4>
                                <!-- content -->
                                <div class="row">
                                    <!-- Ảnh bìa -->
                                    <div class="col-2 mt-2">
                                        <div class="form-group">
                                            @include('hyperspace::components.inputs.image', [
                                            'label' => "Ảnh đại diện",
                                            'name' => "image",
                                            'value' => @$record->image,
                                            'class' => @$record->autoupdate?'update-eloquent ':'',
                                            ])
                                        </div>
                                    </div>
                                    <!-- Thư viện ảnh -->
                                    <div class="col-10 mt-2">
                                        <div class="form-group">
                                            @include('hyperspace::components.inputs.gallery', [
                                            'label' => "Thư viện ảnh",
                                            'name' => "gallery",
                                            'value' => @$record->gallery,
                                            'class' => '',
                                            'sort' => false,
                                            'limit' => 5
                                            ])

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Nội dung sản phẩm -->
                            <div id="productPost"
                                 class=" border-info px-40 py-3">
                                <h4 class="text-main-blue-3 text-uppercase">
                                    Nội dung sản phẩm
                                </h4>
                                <!-- content -->
                                <div class="row">
                                    <!-- Mô tả  -->
                                    <div class="col-12 mt-2">
                                        <div class="form-group">
                                            <label for="productDescription">Mô tả <span class="text-danger">(*)</span></label>
                                            <textarea class="form-control"
                                                      name="description"
                                                      data-required="1">{{@$record->description}}</textarea>
                                        </div>
                                    </div>
                                    <!-- Thư viện ảnh -->
                                    <div class="col-12 mt-2">
                                        <div class="form-group">
                                            {{-- <label for="productBlog">Bài viết chi tiết <span class="text-danger">(*)</span></label> --}}
                                            @include('admin::components.inputs.fck_editor', [
                                            'label' => "Bài viết chi tiết",
                                            'required' => true,
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
                </div>
            </div>

            <div id="tracked"
                 class="tab-pane"
                 ng-class="{ 'tracked ' : events.length > 0 }">
                @include("admin::product.history")
            </div>
        </div>

    </div>


    <!-- Button Range -->
    <div class="d-flex justify-content-end mt-3"
         style="gap: 8px">
        @include('plugin::carton-crm.core.form_action')

        {{-- <button class="btn btn-warning"
                type="button">
            <img src="../../dist/img/icon/save.png"
                 alt=""
                 width="15">
            Lưu và tiếp tục
        </button>

        <button class="chooseDate text-white border-0"
                type="submit">
            <svg xmlns="http://www.w3.org/2000/svg"
                 height="1em"
                 viewBox="0 0 448 512"
                 fill="white">
                <path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"></path>
            </svg>
            Lưu
        </button>

        <button class="btn btn-dark"
                type="button">
            <a href="./product.html"
               class="text-white d-flex align-items-center"
               style="gap: 5px">
                <svg xmlns="http://www.w3.org/2000/svg"
                     height="1em"
                     viewBox="0 0 384 512"
                     fill="white">
                    <path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"></path>
                </svg>
                Hủy
            </a>
        </button> --}}
    </div>
    @csrf
</form>

<style type="text/css">
    .nav-tabs li {
        font-weight: 500;

        color: black;
        background-color: #fff;
        border: 1px solid gainsboro;
    }

    .nav-tabs li a {
        display: block;
        padding: 10px !important;
    }

    .nav-tabs li.active {
        color: white;
        background-color: var(--color-blue);
    }

    .nav-tabs li.active a {

        color: #fff;

    }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script>
    $("#btn-frm-apply").click(function(){
        $("#updateFrm").append("<input type='hidden' name='action' value='apply' />");
        updateFrm();
    });
    $("#btn-frm-save").click(function(){
        updateFrm();
    });
    $(document).ready(function(){
        if( $("#alert_message").length)
        {
            showNoti($("#alert_message").text());
        }
    });

   function updateFrm()
    {
        if(!checkValidate($('#updateFrm')))
        {
            if($("#updateFrm").data("uniquire")){
                $.LoadingOverlay("hide");
                var form = $("#updateFrm");
                var actionUrl = form.attr('action');
                $.ajax({
                    type: "POST",
                    url: "{{ url('admin/' . $GLOBALS['var']['act'] . '/check_exists') }}",
                    data: form.serialize(), // serializes the form's elements.
                    success: function(data)
                    {
                        $.LoadingOverlay("hide");
                        if(data.code == 201)
                        {
                            showNoti(data.data,"Thông báo","error");
                        }
                        else{
                            $("#updateFrm").submit();
                            // var form = $("#updateFrm");
                            // var actionUrl = form.attr('action');

                            // $.ajax({
                            //     type: "POST",
                            //     url: actionUrl,
                            //     data: form.serialize(), // serializes the form's elements.
                            //     success: function(data)
                            //     {
                            //         // $("#modalFormUpdate").modal("hide");
                            //         location.reload();
                            //     }
                            // });

                        }
                    }
                });
            }else{
                $("#updateFrm").submit();
            }
        }

    }
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

    // $("#submitBtn").click(function() {
    //     $("#updateFrm").submit();
    // });
    // $(document).on('click',"#btn-frm-apply",function(){
    //     $("#updateFrm").append("<input type='hidden' name='action' value='apply' />");
    //     $("#updateFrm").submit();
    // });
</script>
