<div class="modal fade" id="modalCreateCustomer" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFixInfoUserLongTitle">
                    Chỉnh sửa thông tin khách hàng
                </h5>
                <button class="close" data-dismiss="modal" type="button" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" id="createCustomer" data-uniquire="true" action="{{ route('admin.customer.create_new') }}">
                <div class="modal-body">

                    <!-- Số điện thoại, Ngày sinh, Nguồn, Giới tính -->
                    <div class="row">
                        <div class="col-6">
                            <!-- Họ & Tên -->
                            <div class="form-group">
                                <label for="fixUserName">Họ & Tên <span class="text-danger">(*)</span></label>
                                <input class="form-control"  id="full_name" name="full_name" type="text"  data-required="1"/>
                                <div class="errordiv full_name">
                                    <div class="arrow"></div>{{ __('Please enter Name') }}!
                                </div>
                                <small class="text-muted text-red" id="fixUserNameWarning"></small>
                            </div>
                        </div>
                        <!-- Số điện thoại -->
                        <div class="col-6">
                            <div class="form-group">
                                <label for="fixUserPhone">
                                    Số điện thoại <span class="text-danger">(*)</span>
                                </label>
                                <input class="form-control phoneNumber" id="phone" name="phone" type="number" data-type="phone"  oninput="validity.valid||(value='');"   data-required="1" />
                                <div class="errordiv phone">
                                    <div class="arrow"></div>{{ __('Please enter Phone') }}!
                                </div>
                                <small class="text-muted text-red" id="fixUserPhoneWarning"></small>
                            </div>
                        </div>
                        <!-- Giới tính -->
                        <div class="col-6">
                            <div class="form-group">
                                <label for="gender">Giới tính</label>
                                <select class="custom-select" name="gender" id="gender">
                                    <option value="">Chọn</option>
                                    <option value="1">Nữ</option>
                                    <option value="2">Nam</option>
                                </select>
                            </div>
                        </div>
                        <!-- Ngày sinh -->
                        <div class="col-6">
                            <div class="form-group">
                                <label for="userDOB">Ngày sinh</label>
                                <input class="form-control" id="birthday" name="birthday" type="date"  />
                                <small class="text-muted text-red" id="userDOBWarning"></small>
                            </div>
                        </div>

                    </div>
                    <!-- Địa chỉ -->
                    <div class="row">
                        <!-- Tỉnh/TP -->
                        <div class="col-6">
                            <div class="form-group">
                                <label for="userCity">Tỉnh/TP</label>
                                <select class="form-control" id="shipping_province" name="shipping_province" onchange="checkCity(this.value,'shipping_district')">
                                    <option value="">Chọn Tỉnh/TP</option>
                                    <option value="1" selected>TP.HCM</option>
                                    <option value="2">Khác</option>
                                </select>
                            </div>
                        </div>
                        <!-- Quận -->
                        <div class="col-6">
                            <div class="form-group">
                                <label for="shipping_district">Quận</label>
                                <select class="form-control" id="shipping_district" name="shipping_district">
                                    <option value="" selected>Chọn Quận</option>
                                    <option value="760">Quận 1</option>
                                    <option value="771">Quận 10</option>
                                    <option value="772">Quận 11</option>
                                    <option value="761">Quận 12</option>
                                    <option value="769">Quận 2</option>
                                    <option value="770">Quận 3</option>
                                    <option value="773">Quận 4</option>
                                    <option value="774">Quận 5</option>
                                    <option value="775">Quận 6</option>
                                    <option value="778">Quận 7</option>
                                    <option value="776">Quận 8</option>
                                    <option value="763">Quận 9</option>
                                    <option value="785">Huyện Bình Chánh</option>
                                    <option value="777">Quận Bình Tân</option>
                                    <option value="765">Quận Bình Thạnh</option>
                                    <option value="787">Huyện Cần Giờ</option>
                                    <option value="783">Huyện Củ Chi</option>
                                    <option value="764">Quận Gò Vấp</option>
                                    <option value="784">Huyện Hóc Môn</option>
                                    <option value="786">Huyện Nhà Bè</option>
                                    <option value="768">Quận Phú Nhuận</option>
                                    <option value="766">Quận Tân Bình</option>
                                    <option value="767">Quận Tân Phú</option>
                                    <option value="762">Quận Thủ Đức</option>
                                    <option value="-1">Khác</option>
                                </select>
                            </div>
                        </div>
                        <!-- Địa chỉ cụ thể -->
                        <div class="col-12">
                            <div class="form-group">
                                <label for="userAddress">Địa chỉ cụ thể </label>
                                <input class="form-control" id="address" name="address" type="text"  placeholder="Nhập địa chỉ" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="userAddress">Địa chỉ giao nhận hàng</label>
                                <input class="form-control" id="shipping_address" name="shipping_address" type="text"  placeholder="Nhập địa chỉ giao nhận hàng" />
                            </div>
                        </div>

                    </div>
                    <!-- Ghi chú -->
                    <div class="form-group">
                        <label for="userNote">Ghi chú</label>
                        <input class="form-control" id="note" name="note" type="text"  placeholder="Nhập ghi chú" />
                    </div>
                    <input type="hidden" value="" name="id" />
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal" type="button">
                        Hủy
                    </button>
                    <button class="btn chooseDate text-white" type="button" id="btnCreateCustomer">
                        Lưu
                    </button>
                </div>
            </form>
        </div>
    </div>
    {{-- <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal updateFrm" id="createCustomer">
                <div class="modal-header no-padding">
                    <div class="table-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"
                            ng-click="closeModal();">
                            <span class="white">&times;</span>
                        </button>
                        {{ __('Create_New_Customer') }}
                    </div>
                </div>
                <div class="modal-body no-padding">

                    <div class="row">
                        <div class="form-group">
                            <label class="col-sm-4 control-label required">{{ __('Customer_Name') }}</label>
                            <div class="col-sm-8">
                                <input type="text" value="" id="full_name" name="full_name"
                                    class="form-control" placeholder="{{ __('Customer_Name_Placeholder') }}"
                                    maxlength="255" data-required="1" autocomplete="off">
                                <div class="errordiv full_name">
                                    <div class="arrow"></div>{{ __('Please enter Name') }}!
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label class="col-sm-4 control-label required">{{ __('Customer_Phone') }}</label>
                            <div class="col-sm-8">
                                <input type="text" id="phone" name="phone" class="form-control" maxlength="50"
                                    data-required="1" data-type="phone" placeholder="0909......" />
                                <div class="errordiv phone">
                                    <div class="arrow"></div>{{ __('Please enter Phone') }}!
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Email</label>
                            <div class="col-sm-8">
                                <input type="email" id="email" name="email" class="form-control" maxlength="255" data-type="email" placeholder="{{ __('Customer_Email_Placeholder') }}" />
                                <div class="errordiv email">
                                    <div class="arrow"></div>Email không hợp lệ
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">{{ __('Customer_Address') }}</label>
                            <div class="col-sm-8">
                                <input type="text" id="address" name="address" class="form-control" placeholder="" maxlength="127">
                                <div class="errordiv address">
                                    <div class="arrow"></div>Địa chỉ không hợp lệ
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="col-sm-4 control-label ">{{ __('Customer_Remark') }}</label>
                            <div class="col-sm-8">
                                <input type="text" name="description" class="form-control" placeholder=""
                                    maxlength="4000" ng-model="customer.description">
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="col-sm-4 control-label ">{{ __('Customer_BirthDate') }}</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" placeholder="dd/mm/yyyy" id="birthday" name="birthday">
                                <div class="has-error ng-hide" data-ng-show="birthdayValid == false">
                                    <div class="help-block col-xs-12 col-sm-reset inline">
                                        Ngày sinh ko hợp lệ (dd/mm/yyyy). </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="col-sm-4 control-label ">{{ __('Customer_Gender') }}</label>
                            <div class="col-sm-8">
                                <label>
                                    <input type="radio" name="gender" class="ace" data-ng-model="customer.gender" value="true">
                                    <span class="lbl">{{ __('Male') }}</span>
                                </label>

                                <label>
                                    <input type="radio" name="gender" class="ace"
                                        data-ng-model="customer.gender" value="false">
                                    <span class="lbl">{{ __('Female') }}</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" value="" name="id" />

                </div>
                <div class="modal-footer">
                    <div class="pull-right">
                        <button class="btn btn-modal-close" type="reset">
                            <i class="icon-undo bigger-110"></i>
                            {{ __('Close') }}
                        </button>
                        &nbsp; &nbsp; &nbsp;

                        <button type="submit" class="btn btn-primary" id="btnCreateCustomer">
                            <i class="icon-ok bigger-110"></i>
                            {{ __('Save') }}
                        </button>

                    </div>
                </div>
            </form>
        </div>
    </div> --}}
</div>
<script>
    function conver_date(format, value) {
        date = new Date(value);
        switch(format)
        {
            case "m/d/Y":
                return [
                    padTo2Digits(date.getDate()),
                    padTo2Digits(date.getMonth() + 1),
                    date.getFullYear(),
                ].join('/');;
                break;
            default:
                return value;
                break;
        }
    }
    $(document).on("click", ".btnNewCustomer", function() {
        $("#modalCreateCustomer").find("form")[0].reset();
        $("#modalCreateCustomer").modal("show");
        $("#modalCreateCustomer .modal-title").html("Tạo khách hàng");

        // $('#modalCreateCustomer').on('shown.bs.modal', function(e) {
        //     $('#birthday').datepicker({
        //         format: "dd/mm/yyyy",
        //         todayBtn: "linked",
        //         autoclose: true,
        //         todayHighlight: true
        //     });
        // });
    });
    if($("#createCustomer").data("uniquire"))
    {
        $( "#createCustomer").on("submit", function( event ) {
            event.preventDefault();
            $.LoadingOverlay("hide");
            var form = $(this);
            var actionUrl = form.attr('action');
            $.ajax({
                type: "POST",
                url: "{{ url('admin/customer/check_exists') }}",
                data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {
                    $.LoadingOverlay("hide");
                    if(data.code == 201)
                    {
                        showNoti(data.data,"Thông báo","error");
                    }
                    else{
                        var form = $("#createCustomer");
                        var actionUrl = form.attr('action');
                        $.ajax({
                            type: "POST",
                            url: actionUrl,
                            data: form.serialize(), // serializes the form's elements.
                            success: function(data)
                            {
                                // $("#modalFormUpdate").modal("hide");
                                showNoti(data.message,"Thông báo","ok");
                                setTimeout(function () {
                                    location.reload();
                                }, 2000);

                            }
                        });

                    }
                }
            });
        });
    }
    $(document).on("click", "#btnCreateCustomer", function() {

        if(!checkValidate($('#createCustomer')))
        {
            $("#createCustomer").submit();
        }
    });
    $(document).on("click", ".action span a:nth-child(1), .link_title a", function(e) {
        e.preventDefault();
        $(this).addClass('disabled').delay(2000).queue(function() {
            $(this).removeClass('disabled');
        });
        href = $(this).attr('href');
        $.LoadingOverlay("show");

        $.ajax({
            url: href,
            success: function(res) {
                if (res.success) {
                    $("#modalCreateCustomer").modal("show");
                    $("#modalCreateCustomer .modal-title").html("Chỉnh sửa thông tin khách hàng");
                    let form = $(this).find("form")[0];
                    if (form) {
                        form.reset();
                    }
                    $('#modalCreateCustomer').on('shown.bs.modal', function(e) {
                        // $('#birthday').datepicker({
                        //     birthday: "dd/mm/yyyy",
                        //     todayBtn: "linked",
                        //     autoclose: true,
                        //     todayHighlight: true
                        // });
                    });
                    var data = res.data;
                    if (res.data != undefined) {
                        // console.log(304, date("m/d/Y",data.birthday));
                        $("#modalCreateCustomer").find("input[name=full_name]").val(data.full_name);
                        $("#modalCreateCustomer").find("input[name=code]").val(data.code);
                        $("#modalCreateCustomer").find("input[name=phone]").val(data.phone);
                        $("#modalCreateCustomer").find("input[name=email]").val(data.email);
                        $("#modalCreateCustomer").find("input[name=address]").val(data.address);
                        $("#modalCreateCustomer").find("input[name=shipping_address]").val(data.shipping_address);
                        $("#modalCreateCustomer").find("input[name=description]").val(data.description);
                        $("#modalCreateCustomer").find("input[name=birthday]").val(data.birthday);
                        $("#modalCreateCustomer").find("select[name=shipping_district]").val(data.shipping_district);
                        $("#modalCreateCustomer").find("select[name=gender]").val(data.gender);
                        $("#modalCreateCustomer").find("input[name=id]").val(data.id);
                        $("#modalCreateCustomer").find("input[name=note]").val(data.note);
                    }

                    $.LoadingOverlay("hide");
                }
            }
        });


    });


    $(document).on("change", "#customer_id", function() {
        $customer = $("#customer_id").val();
        $.ajax({
            method: "GET",
            url: window.location.origin + "/admin/customer/edit/" + $customer,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        }).done(function(res) {
            if (res.success) {
                data = res.data;
                $("#customer_email").val(data.email);
                if (data.type == 1) {
                    $("#customer_phone").prop("disabled", true);

                } else {
                    $("#customer_phone").prop("disabled", false);
                }
                $("#customer_phone").val(data.phone);
                $("#customer_address").val(data.address);
            }
        });
    });
    // $("#createCustomer").submit(function(e) {
    //     e.preventDefault();
    //     hasError = checkValidate($(("#createCustomer")));
    //     console.log(hasError);
    //     if (!hasError) {
    //         $.LoadingOverlay("show");
    //         var form = $(this);
    //         $.ajax({
    //             method: "POST",
    //             url: "{{ route('admin.customer.create_new') }}",
    //             headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             },
    //             data: form.serialize()
    //         }).done(function(res) {
    //             $.LoadingOverlay("hide");
    //             if (res.success) {
    //                 location.reload();
    //             }
    //         });

    //     }

    // });

    function openUpdateCustomerModal() {
        $customer = $("#customer_id").val();
        if ($customer != "") {
            var data = [];
            data['email'] = $("#customer_email").val();
            if ($("#customer_phone").data('type') == 2) {
                data['email'] = $("#customer_phone").val();
            }
            data['address'] = $("#customer_address").val();
            data['shipping_province'] = $("#shipping_province").val();
            data['shipping_district'] = $("#shipping_district").val();
            data['shipping_address'] = $("#shipping_address").val();
            $.ajax({
                method: "POST",
                url: window.location.origin + "/admin/customer/update/" + $customer,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    data
                }
            }).done(function(res) {
                if (res.success) {
                    showNoti('Update Customer success', 'Customer', 'War');
                }
            });
        }

    }

    function closeModalCustomer() {
        $("#modalCreateCustomer").modal("hide");
    }
</script>
<style type="text/css">
    /* #modalCreateCustomer .form-group {
        display: flex;
    } */

    .btn-create-customer {
        height: 30px;
        border: 0;
        border-radius: 0 5px 5px 0;
    }

    input[type="text"]:disabled {
        background: #ccc;
    }

</style>
