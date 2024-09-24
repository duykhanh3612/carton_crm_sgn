<div class="orderGeneralInfo2 row mt-5">

        <div class="col-md-6 col-lg-4">
            <div class="widget-box transparent" style="margin-top: 0px !important;">
                <div class="tabbable">
                    <ul class="nav nav-tabs" id="myTabs" role="tablist">
                        <!-- Tab TT Đơn hàng -->
                        <li class="nav-item">
                            <a class="nav-link active" id="orderInfo1" data-toggle="tab" target="#info">TT Đơn hàng</a>
                        </li>
                        <!-- Tab Lịch sử -->
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" target="#tracked" role="tab" aria-controls="profile" aria-selected="false">Lịch sử</a>
                        </li>
                    </ul>

                    <div class="tab-content no-border black padding-0 ">
                        <div id="info" class="tab-pane active ">
                            <div class="widget-body">
                                <div class="widget-main padding-4">
                                    <div class="tab-content padding-8 overflow-visible">
                                        <div class="row">
                                            <label class="col-md-5 control-label no-padding-right ng-binding">Ngày tạo</label>
                                            <div class="col-md-7 input-group-contain">
                                                <input id="saleDatePicker" class="form-control k-input" type="text" placeholder="Hôm nay" data-role="datetimepicker" style="width: 100%;" value="{{ @$record->created_at }}" disabled="disabled">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-md-5 control-label no-padding-right ng-binding" for="form-field-1">Mã phiếu</label>
                                            <label class="col-md-7 form-value">
                                                <input type="text" class="form-control ng-pristine ng-valid" placeholder="Hệ thống tự tạo" value="{{ @$record->code }}" disabled="disabled">
                                            </label>
                                        </div>



                                        <div class="row">
                                            <label class="col-md-5 control-label no-padding-right ng-binding required" for="form-field-1">Người bán</label>
                                            <div class="col-md-7">
                                                @if(isAdmin()||true)
                                                {!! Form::select('saler_id', Users::getOption(true), @$record->saler_id??auth()->user()->id, ['class' => 'form-control','data-required'=>1,'title'=>"Chọn người bán "]) !!}
                                                @else
                                                <label class="form-control">{{auth()->user()->full_name }}</label>
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
                                        @if(@$record->request_invoice)
                                        <div class="widget-header">
                                            <h4 class="lighter ng-binding">
                                                <i class="icon-info-sign blue"></i>Thông tin xuất hóa đơn
                                            </h4>
                                        </div>
                                        <hr>
                                        <div class="row mb-1">
                                            <label class="col-sm-5 control-label no-padding-right ng-binding" for="form-field-1">Công Ty</label>
                                            <div class="col-sm-7">

                                               <textarea class="form-control" disabled rows="2" style="    font-size: 13px;">{{@$record->company_name}}</textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-1">
                                            <label class="col-sm-5 control-label no-padding-right ng-binding" for="form-field-1">Tên công ty</label>
                                            <div class="col-sm-7">

                                               <input class="form-control" value="{{@$record->company_taxcode}}" disabled  style="    font-size: 13px;"/>
                                            </div>
                                        </div>
                                        <div class="row mb-1">
                                            <label class="col-sm-5 control-label no-padding-right ng-binding" for="form-field-1">Email nhận hoá đơn</label>
                                            <div class="col-sm-7">

                                               <input class="form-control" value="{{@$record->company_email}}" disabled style="    font-size: 13px;"/>
                                            </div>
                                        </div>
                                        <div class="row mb-1">
                                            <label class="col-sm-5 control-label no-padding-right ng-binding" for="form-field-1">Địa chỉ công ty</label>
                                            <div class="col-sm-7">

                                               <input class="form-control" value="{{@$record->company_address}}" disabled style="    font-size: 13px;"/>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="tracked" class="tab-pane" ng-class="{ 'tracked ' : events.length > 0 }">
                            @include("admin::order.edit.history")
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="widget-box {{@$record->status >= "2"?"lock":""}}">
                <div class="widget-header">
                    <h4 class="lighter ng-binding">
                        <i class="icon-info-sign blue"></i>
                        Khách hàng
                    </h4>
                </div>
                <div class="widget-body">
                    <div class="widget-main padding-4">
                        <div class="row mb-1">
                            <label class="col-md-5 control-label no-padding-right required" for="form-field-1">Họ và tên</label>
                            <div class="col-md-7">
                                <div class="input-group-customer d-flex">
                                    {!! Form::select('customer_id',array_replace([''=>'Chọn khách hàng'], Customer::getFullOption()), @$record->customer_id, ['class' => 'form-control select2','id'=>'customer_id','data-required'=>1,"title"=>"Chọn khách hàng"]) !!}
                                    <span class="input-group-btn ng-scope">
                                        <button type="button" class="btn btn-primary btn-modal-customer" title="Tạo mới khách hàng" onclick="openCreateCustomerModal()">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-1">
                            <label class="col-md-5 control-label no-padding-right" for="form-field-1">Email</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control ng-pristine ng-valid" id="customer_email" name="customer[email]" data-ng-model="customer[email]" value="{{ @$record->customer->email }}">
                            </div>
                        </div>
                        <div class="row mb-1">
                            <label class="col-md-5 control-label no-padding-right ng-binding" for="form-field-1">Điện thoại</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control ng-pristine ng-valid" id="customer_phone" name="customer_phone" data-type="{{@$record->customer->type}}" {{ @$record->customer->phone == '' ? 'name=customer[phone]' : '' }} data-ng-model="customer.phone" value="{{ @$record->customer->phone }}">
                            </div>
                        </div>
                        <div class="row mb-1">
                            <label class="col-sm-5 control-label no-padding-right ng-binding" for="form-field-1">Địa chỉ</label>
                            <div class="col-sm-7">
                                <textarea rows="5" class="form-control ng-pristine ng-valid" id="customer_address" placeholder="" name="customer[address]">{{ @$record->customer->address }}</textarea>
                            </div>
                        </div>

                        <div class="widget-header">
                            <h4 class="lighter ng-binding">
                                <i class="icon-info-sign blue"></i>Địa chỉ giao hàng
                            </h4>
                        </div>
                        <hr>
                        <div class="row mb-1">
                            <label class="col-sm-5 control-label no-padding-right ng-binding" for="form-field-1">Tỉnh thành</label>
                            <div class="col-sm-7">

                                <select name="shipping_province" id="shipping_province" class="form-control">
                                    <option>Select</option>
                                    <option value="79" {{@$record->shipping_province=='79' || empty($record) ?'selected':''}}>Tp. Hồ Chí Minh</option>
                                    <option value="other" {{@$record->shipping_province=='other'?'selected':''}}>Khác</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <label class="col-sm-5 control-label no-padding-right ng-binding" for="form-field-1">Quận</label>
                            <div class="col-sm-7">
                                {!! Form::select("shipping_district", Geo::getDistrictOptions(79),@$record->shipping_district,['class'=>"form-control update_shipment","id"=>"shipping_district"]) !!}
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-5 control-label no-padding-right ng-binding" for="form-field-1">Địa chỉ</label>
                            <div class="col-sm-7">
                                <input class="form-control" placeholder="Địa chỉ giao hàng" id="shipping_address" name="shipping_address" value="{{ @$record->shipping_address }}">
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
        <div class="col-md-6 col-lg-4">
            <div class="widget-box {{@$record->status >= "3"?"lock":""}}">
                <div class="widget-header">
                    <h4 class="lighter ng-binding">
                        <i class="icon-info-sign blue"></i>
                        Giao hàng
                    </h4>
                </div>
                <div class="widget-body">
                    <div class="widget-main padding-4">
                        <div class="tab-content padding-8 overflow-visible">
                            {{-- <div class="row mb-1">
                                <label class="col-md-5 control-label no-padding-right ng-binding" for="form-field-1">Vận chuyển</label>
                                <div class="col-sm-7">
                                    {!! form_dropdown("shippers", $option['shippers'],@$record->shippers,'class="form-control" id="shippers"') !!}

                                    <script>
                                        $("#shippers").val("{{ @$record->shippers }}");
                                    </script>
                                </div>
                            </div> --}}
                            <div class="row mb-1">
                                <label class="col-md-5 control-label no-padding-right ng-binding">Ngày giao</label>
                                <div class="col-md-7">
                                    <input id="shippingDatePicker" class="form-control" type="text" name="delivery_date" placeholder="Hôm nay" data-role="datetimepicker" value="{{ getDateValue(@$record->delivery_date," d/m/Y") }}" style="width: 100%;" autocomplete="off">
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label class="col-md-5 control-label no-padding-right ng-binding">Người giao</label>
                                <div class="col-md-7">
                                    <input class="form-control" type="text" name="carrier_name" id="carrier_name" value="{{ @$record->carrier_name }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea rows="3" class="form-control ng-pristine ng-valid" placeholder="Ghi chú tại đây" maxlength="1900" name="shipping_comment" id="shipping_comment">{{ @$record->shipping_comment }}</textarea>
                            </div>
                            <div class="row">
                                <label class="col-md-5 control-label no-padding-right ng-binding">Phí vận chuyển</label>
                                <div class="col-md-7">
                                   {{-- <span id="shipping_fee_label">{{number_format(@$record->shipping_fee)}}</span> --}}
                                   <input class="form-control money" type="text" id="shipping_fee" name="shipping_fee" value="{{number_format(@$record->shipping_fee)}}" {{@$record->type==2?'disabled':''}} />
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

</div>
