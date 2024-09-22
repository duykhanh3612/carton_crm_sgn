<div class="col-12">
    <div class="row">
        <div class="col-6 col-lg-4">
            <div class="widget-box transparent" style="margin-top: 0px !important;">
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

                    <div class="tab-content no-border black padding-0 ">
                        <div id="info" class="tab-pane active ">
                            <div class="widget-body">
                                <div class="widget-main padding-4">
                                    <div class="tab-content padding-8 overflow-visible">
                                        <div class="row">
                                            <label class="col-md-5 control-label no-padding-right ng-binding">Ngày
                                                tạo</label>
                                            <div class="col-md-7">
                                                <div class="input-group input-group-sm width-100">
                                                    <span class="input-group-btn width-100">
                                                        <span class="k-widget k-datetimepicker k-header width-100" style="">
                                                            <span class="k-picker-wrap k-state-disabled">
                                                                <input id="saleDatePicker" class="width-100 k-input" type="text" placeholder="Hôm nay" data-role="datetimepicker" style="width: 100%;" value="{{ @$record->created_at }}" disabled="disabled">

                                                            </span>
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-md-5 control-label no-padding-right ng-binding" for="form-field-1">Mã phiếu</label>
                                            <label class="col-md-7 form-value">
                                                <input type="text" class="width-100 ng-pristine ng-valid" placeholder="Hệ thống tự tạo" value="{{ @$record->code }}" disabled="disabled">
                                            </label>
                                        </div>



                                        <div class="row">
                                            <label class="col-md-5 control-label no-padding-right ng-binding required" for="form-field-1">Người bán</label>
                                            <div class="col-md-7">
                                                @if(isAdmin())
                                                {!! Form::select('saler_id',  Users::getOption(true), @$record->saler_id??auth()->user()->id, ['class' => 'form-control','data-required'=>1,'title'=>"Chọn người bán "]) !!}
                                                @else
                                                <label>{{auth()->user()->full_name }}</label>
                                                <input type="hidden" value="{{auth()->user()->id }}" name="saler_id" />
                                                @endif

                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <textarea rows="3" id="note" name="note" class="form-control ng-pristine ng-valid note" id="form-field-10" placeholder="Ghi chú tại đây">{{ @$record->note }}</textarea>
                                            </div>
                                        </div>
                                        <div class="row" data-ng-show="orderStatus > 1">
                                            <label class="col-md-5 control-label no-padding-right"></label>
                                            <div class="col-md-7 text-right padding-right">
                                                <button id="btnNewComment" class="btn btn-primary btn-sm ng-binding" type="button">
                                                    <i class="icon-pen"></i>&nbsp;Thêm ghi chú
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="tracked" class="tab-pane" ng-class="{ 'tracked ' : events.length > 0 }">
                            @include("admin::order.v1.edit.history")
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-4">
            <div class="widget-box transparent xs" style="margin-top: 0px !important;">
                <div class="widget-header">
                    <h4 class="lighter ng-binding">
                        <i class="icon-info-sign blue"></i>
                        Khách hàng
                    </h4>
                </div>
                <div class="widget-body">
                    <div class="widget-main padding-4">
                        <div class="row">
                            <label class="col-md-5 control-label no-padding-right required" for="form-field-1">Họ và tên</label>
                            <div class="col-md-7">
                                <div class="input-group-customer">
                                    {!! Form::select('customer_id',array_replace([''=>'Chọn khách hàng'], Customer::getOption()), @$record->customer_id, ['class' => 'form-control select2','id'=>'customer_id','data-required'=>1,"title"=>"Chọn khách hàng"]) !!}
                                    <span class="input-group-btn ng-scope">
                                        <button type="button" class="btn btn-primary btn-modal-customer" title="Tạo mới khách hàng" onclick="openCreateCustomerModal()">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-5 control-label no-padding-right" for="form-field-1">Email</label>
                            <div class="col-md-7">
                                <input type="text" class="width-100 ng-pristine ng-valid" id="customer_email" name="customer[email]" data-ng-model="customer[email]" value="{{ @$record->customer->email }}">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-5 control-label no-padding-right ng-binding" for="form-field-1">Điện thoại</label>
                            <div class="col-md-7">
                                <input type="text" class="width-100 ng-pristine ng-valid" id="customer_phone" data-type="{{@$record->customer->type}}" {{ @$record->customer->phone == '' ? 'name=customer[phone]' : '' }} data-ng-model="customer.phone" value="{{ @$record->customer->phone }}">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-5 control-label no-padding-right ng-binding" for="form-field-1">Địa chỉ</label>
                            <div class="col-sm-7">
                                <textarea rows="3" class="width-100 ng-pristine ng-valid" id="customer_address" placeholder="" name="customer[address]">{{ @$record->customer->address }}</textarea>
                            </div>
                        </div>

                        <div class="widget-header">
                            <h4 class="lighter ng-binding">
                                <i class="icon-info-sign blue"></i>Địa chỉ giao hàng
                            </h4>
                        </div>
                        <hr>
                        <div class="row">
                            <label class="col-sm-5 control-label no-padding-right ng-binding" for="form-field-1">Tỉnh thành</label>
                            <div class="col-sm-7">

                                <select name="shipping_province"  id="shipping_province" class="form-control">
                                    <option>Select</option>
                                    <option value="79" {{@$record->shipping_province=='79' || empty($record) ?'selected':''}}>Tp. Hồ Chí Minh</option>
                                    <option value="other" {{@$record->shipping_province=='other'?'selected':''}}>Khác</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-5 control-label no-padding-right ng-binding" for="form-field-1">Quận</label>
                            <div class="col-sm-7">
                                {!! Form::select("shipping_district", Geo::getDistrictOptions(79),@$record->shipping_district,['class'=>"form-control update_shipment","id"=>"shipping_district"]) !!}
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-5 control-label no-padding-right ng-binding" for="form-field-1">Địa chỉ</label>
                            <div class="col-sm-7">
                                <input class="form-control" placeholder="Địa chỉ giao hàng" name="shipping_address" value="{{ @$record->shipping_address }}">
                            </div>
                        </div>
                        {{-- <div class="row" data-ng-show="orderStatus > 1">
                            <label class="col-md-5 control-label no-padding-right"></label>
                            <div class="col-md-7 text-right padding-right d-flex justify-content-end gap-3">
                                <button id="btnCreateCustome" class="btn btn-primary btn-sm ng-binding" onclick="openCreateCustomerModal();" type="button">
                                    <i class="icon-pen"></i>&nbsp;(+) Thêm khách hàng mới
                                </button>
                                <button id="btnUpdateCustomer" class="btn btn-primary btn-sm ng-binding" onclick="openUpdateCustomerModal();" type="button">
                                    <i class="icon-pen"></i>&nbsp;Cập nhật thông tin
                                </button>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-4">
            <div class="widget-box transparent xs" style="margin-top: 0px !important;">
                <div class="widget-header">
                    <h4 class="lighter ng-binding">
                        <i class="icon-info-sign blue"></i>
                        Giao hàng
                    </h4>
                </div>
                <div class="widget-body">
                    <div class="widget-main padding-4">
                        <div class="tab-content padding-8 overflow-visible">
                            <div class="row">
                                <label class="col-md-5 control-label no-padding-right ng-binding" for="form-field-1">Vận chuyển</label>
                                <div class="col-sm-7">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-btn width-100" data-ng-init="initShipper()">
                                            <select class="form-control" id="shippers" name="shippers" style="margin-top: -3px" data-ng-change="shipperChange(shipper)">
                                                <option value="0" selected="selected">--Tất cả--</option>
                                                <option value="1">Xe tải Mf</option>
                                                <option value="2">Minh Shiper</option>
                                                <option value="3">Grap</option>
                                                <option value="4">GHTK</option>
                                                <option value="5">Xe máy Mf</option>
                                                <option value="6">Ninja Van</option>
                                                <option value="7">Xe số 5</option>
                                                <option value="8">Lấy trực tiếp</option>
                                                <option value="9">Xe máy MF</option>
                                                <option value="10">Nam shipper</option>
                                                <option value="11">thắng</option>
                                                <option value="12">truong</option>
                                                <option value="13">anh phương</option>
                                                <option value="14">ahamove</option>
                                                <option value="15">Duy Chánh</option>
                                                <option value="16">xe van</option>
                                                <option value="17">Anh Doanh</option>
                                                <option value="18">viettel</option>
                                                <option value="19">ANH ĐIỆP</option>
                                                <option value="20">xe số 2</option>
                                                <option value="21">Xe số 3</option>
                                                <option value="22">quốc ạnh</option>
                                                <option value="23">Nhân shiper</option>
                                                <option value="24">Xe số 4</option>
                                                <option value="25">xe số 6</option>
                                                <option value="26">khách ghé lấy</option>
                                                <option value="27">khách book grap</option>
                                                <option value="28">Xe số 1</option>
                                            </select>
                                            <script>
                                                $("#shippers").val("{{ @$record->shippers }}");
                                            </script>
                                        </span>
                                        {{-- <span class="input-group-btn">
                                                                <button class="btn btn-primary" style="height: 34px;"
                                                                    title="Tạo mới đơn vị vận chuyển"
                                                                    data-ng-click="openPopupShipper(shippers)">
                                                                    <i class="fa fa-plus bigger-110"></i>
                                                                </button>
                                                            </span> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-5 control-label no-padding-right ng-binding">Ngày giao</label>
                                <div class="col-md-7">
                                    <div class="input-group input-group-sm width-100">
                                        <span class="input-group-btn width-100">
                                            <span class="k-widget k-datetimepicker k-header width-100" style="">
                                                <span class="k-picker-wrap k-state-default">
                                                    <input id="shippingDatePicker" class="form-control" type="text" name="delivery_date" placeholder="Hôm nay" data-role="datetimepicker" value="{{ getDateValue(@$record->delivery_date,"d/m/Y") }}" style="width: 100%;">
                                                </span>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-5 control-label no-padding-right ng-binding">Người giao</label>
                                <div class="col-md-7">
                                    <div class="input-group input-group-sm width-100">
                                        <span class="input-group-btn width-100">
                                            <input class="form-control" type="text" name="carrier_name" id="carrier_name" value="{{ @$record->carrier_name }}">
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea rows="3" class="form-control ng-pristine ng-valid" placeholder="Ghi chú tại đây" maxlength="1900" name="shipping_comment" id="shipping_comment">{{ @$record->shipping_comment }}</textarea>
                            </div>
                            <div class="row">
                                <label class="col-md-5 control-label no-padding-right ng-binding">Phí vận chuyển</label>
                                <div class="col-md-7">
                                    <div class="input-group input-group-sm width-100">
                                        <span class="input-group-btn width-100">
                                            <span id="shipping_fee_label" style="display:none">{{number_format(@$record->shipping_fee)}}</span>
                                            <input type="text" class="form-control" id="shipping_fee" name="shipping_fee" value="{{intval(@$record->shipping_fee)}}" />
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
