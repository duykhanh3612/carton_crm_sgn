<div class="modal" id="modalCreateCustomer">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="form-horizontal">
                <div class="modal-header no-padding">
                    <div class="table-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" ng-click="closeModal();">
                            <span class="white">&times;</span>
                        </button>
                        {{ __('Create_New_Customer') }}
                    </div>
                </div>

                <div class="modal-body no-padding">
                    <form class="form-horizontal widget-main updateFrm" id="frmCreateCustomer">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-sm-4 control-label required">{{ __('Customer_Name') }}</label>
                                <div class="col-sm-8">
                                    <input type="text" id="full_name" name="full_name" class="form-control"  placeholder="{{ __('Customer_Name_Placeholder') }}" maxlength="255" data-required="1">

                                </div>
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">{{ __('Customer_Code') }}</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" maxlength="50" placeholder="{{ __('Customer_Code_Placeholder') }}" ng-model="customer.code">
                                </div>

                            </div>
                        </div>
                        div data-ng-show="isMultiplePrice" class="row">
                            <div class="form-group">
                                <label class="col-sm-4 control-label ">{{__('Customer_Type')}}</label>
                                <div class="col-sm-8">
                                    <label>
                                        <input type="radio" name="type" class="ace" data-ng-model="customer.type" value="0">
                                        <span class="lbl">{{__('Retail_Customer')}}</span>
                                    </label>
                                    <label>
                                        <input type="radio" name="type" class="ace" data-ng-model="customer.type" value="1">
                                        <span class="lbl">{{__('Wholesale_Customer')}}</span>
                                    </label>
                                    <label>
                                        <input type="radio" name="type" class="ace" data-ng-model="customer.type" value="2">
                                        <span class="lbl">{{__('Vip_Customer')}}</span>
                                    </label>
                                </div>
                            </div>
                        </div> --}}
                        <div class="row">
                            <div class="form-group">
                                <label class="col-sm-4 control-label required">{{ __('Customer_Phone') }}</label>
                                <div class="col-sm-8">
                                    <input type="text" id="phone" name="phone" class="form-control" data-type="phone" maxlength="50" placeholder="0909......" data-required="1"/>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="email" id="email" name="email" class="form-control" name="email" data-type="email" maxlength="255" placeholder="{{ __('Customer_Email_Placeholder') }}">
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">{{ __('Customer_Address') }}</label>
                                <div class="col-sm-8">
                                    <input type="text" name="address" class="form-control" placeholder="" maxlength="127">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-sm-4 control-label ">{{ __('Customer_Remark') }}</label>
                                <div class="col-sm-8">
                                    <input type="text" name="description" class="form-control" placeholder="" maxlength="4000" ng-model="customer.description">
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-sm-4 control-label ">{{ __('Customer_BirthDate') }}</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="dd/mm/yyyy" ng-model="customer.birthday" name="birthday">
                                    <div class="has-error ng-hide" data-ng-show="birthdayValid == false">
                                        <div class="help-block col-xs-12 col-sm-reset inline">Ngày sinh ko hợp lệ (dd/mm/yyyy). </div>
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
                                        <input type="radio" name="gender" class="ace" data-ng-model="customer.gender" value="false">
                                        <span class="lbl">{{ __('Female') }}</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="pull-right">
                        <button class="btn" type="reset" onclick="closeModalCustomer()">
                            <i class="icon-undo bigger-110"></i>
                            {{ __('Close') }}
                        </button>
                        &nbsp; &nbsp; &nbsp;
                        <button type="submit" class="btn btn-primary" id="createCustomer">
                            <i class="icon-ok bigger-110"></i>
                            {{ __('Save') }}
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function openCreateCustomerModal() {
        $("#modalCreateCustomer").modal("show");
    }
    function openUpdateCustomerModal()
    {
        $customer = $("#customer_id").val();
        if($customer != "")
        {
            var data = [];
            data['email'] =  $("#customer_email").val();
            if($("#customer_phone").data('type')==2)
            {
                data['email'] =  $("#customer_phone").val();
            }
            data['address'] =  $("#customer_address").val();
            data['shipping_province'] =  $("#shipping_province").val();
            data['shipping_district'] =  $("#shipping_district").val();
            data['shipping_address'] =  $("#shipping_address").val();
            $.ajax({
                method: "POST",
                url: window.location.origin + "/admin/customer/update/"+$customer,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {data}
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
    $(document).on("change", "#customer_id", function() {
        $customer = $("#customer_id").val();
        if($customer!="")
        {
            $.ajax({
                method: "GET",
                url: window.location.origin + "/admin/customer/edit/"+$customer,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            }).done(function(res) {
                if (res.success) {
                    data = res.data;
                    $("#customer_email").val(data.email);
                    if(data.type ==1 )
                    {
                        $("#customer_phone").prop("disabled",true);
                    }
                    else{
                        $("#customer_phone").prop("disabled",false);
                    }
                    $("#customer_phone").val(data.phone);
                    $("#customer_address").val(data.address);
                }
            });
        }

    });
    $(document).on("click", "#createCustomer", function() {
        if(!checkValidate($("#frmCreateCustomer")))
        {
            $("#frmCreateCustomer").submit();
        }

    });
    $("#frmCreateCustomer").submit(function(e) {
        e.preventDefault();
        var form = $(this);
        $.ajax({
            method: "POST",
            url: "{{ route('admin.customer.create_new') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: form.serialize()
        }).done(function(res) {
            if (res.success) {
                $("#modalCreateCustomer").modal("hide");
                $("#customer_id").append(`<option value="${res.data.id}">${res.data.full_name}</option>`)
                $("#customer_id").val(res.data.id);
                $("#customer_email").val(res.data.email)
                $("#customer_address").val(res.data.address)
                $("#customer_phone").val(res.data.phone)
                $("#frmCreateCustomer")[0].reset();
            }
        });
    });
</script>
<style type="text/css">
    #modalCreateCustomer .form-group {
        display: flex;
    }

    .btn-create-customer {
        height: 30px;
        border: 0;
        border-radius: 0 5px 5px 0;
    }
    input[type="text"]:disabled{
        background: #ccc;
    }
</style>
