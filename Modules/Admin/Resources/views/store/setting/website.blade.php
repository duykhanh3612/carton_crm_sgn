<div class="tab-pane" id="web_setting">
    <div class="widget-body">
        <div class="widget-main padding-4">
            <form action="{{route("admin.settings.update")}}" class="form-horizontal ng-pristine ng-valid ng-valid-required" id="web_setting" method="POST" enctype="multipart/form-data">
                <div class="tab-content padding-8 overflow-visible">

                    <div class="row">
                        <div class="col-sm-3">
                            <h4 class="ng-binding">Thông tin cơ bản</h4>
                            <span class="hidden-320 ng-binding">
                                Nhập tên và các thông tin cơ bản của Website
                            </span>
                        </div>
                        <div class="col-sm-9">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        {{-- <label class="ng-binding">Logo</label> --}}
                                        <div class="form-item" style="max-width: 300px;">
                                            @include('admin::components.inputs.image', [
                                                'label' => "Logo",
                                                'name' => "logo",
                                                'value' => user_setting("logo"),
                                                'class' => 'update-eloquent',
                                            ])
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label class="ng-binding">Hotline</label>
                                        <div class="form-item">
                                            <input type="text" name="hotline" id="hotline" value="{{user_setting("hotline")}}" data-required="1"  placeholder="Hotline" class="width-100 ng-pristine ng-valid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label class="ng-binding">Điện thoại</label>
                                        <div class="form-item">
                                            <input type="text" name="phone" id="phone" value="{{user_setting("phone")}}" data-required="1"  placeholder="Điện thoại" class="width-100 ng-pristine ng-valid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label class="ng-binding">Email</label>
                                        <div class="form-item">
                                            <input type="text" name="email" id="email" value="{{user_setting("email")}}" data-required="1"  placeholder="Email" class="width-100 ng-pristine ng-valid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label class="ng-binding">Địa chỉ</label>
                                        <div class="form-item">
                                            @include('admin::components.inputs.fck_editor', [
                                                'label' => "",
                                                'name' => "address",
                                                'value' => user_setting("address"),
                                                'class' => '',
                                            ])

                                            {{-- <textarea type="text" name="address" id="address" data-required="1"  placeholder="Địa chỉ" class="width-100 ng-pristine ng-valid"  maxlength="200">{{user_setting("address")}}</textarea> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label class="ng-binding">Copyright</label>
                                        <div class="form-item">
                                            <input type="text" name="copyright" id="copyright" value="{{user_setting("copyright")}}" data-required="1"  placeholder="Copyright" class="width-100 ng-pristine ng-valid">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <h4 class="ng-binding">Seo</h4>
                            <span class="hidden-320 ng-binding">
                                Nhập tên và các thông tin SEO của Website
                            </span>
                        </div>
                        <div class="col-sm-9">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label class="ng-binding">Title</label>
                                        <div class="form-item">
                                            <input type="text" name="seo_title" id="seo_title" value="{{user_setting("seo_title")}}" data-required="1"  placeholder="Title" class="width-100 ng-pristine ng-valid"  maxlength="200">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label class="ng-binding">Description</label>
                                        <div class="form-item">
                                            <textarea type="text" name="seo_description" id="seo_description" data-required="1"  placeholder="Description" class="width-100 ng-pristine ng-valid"  maxlength="200">{{user_setting("seo_description")}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label class="ng-binding">Keywords</label>
                                        <div class="form-item">
                                            <textarea type="text" name="seo_keyword" id="seo_keyword" data-required="1"  placeholder="Keywords" class="width-100 ng-pristine ng-valid"  maxlength="200">{{user_setting("seo_keyword")}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <h4 class="ng-binding">Kết nối với công ty</h4>
                            <span class="hidden-320 ng-binding">
                                Kết nối với công ty Facebook & Zalo
                            </span>
                        </div>
                        <div class="col-sm-9">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label class="ng-binding">Facebook</label>
                                        <div class="form-item">
                                            <input type="text" name="social_facebook" id="social_facebook" value="{{user_setting("social_facebook")}}"  placeholder="Facebook" class="width-100 ng-pristine ng-valid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label class="ng-binding">Zalo</label>
                                        <div class="form-item">
                                            <input type="text" name="social_zalo" id="social_zalo" value="{{user_setting("social_zalo")}}"  placeholder="Zalo" class="width-100 ng-pristine ng-valid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="clearfix col-xs-12 form-actions update" ng-hide="layoutSettings.companyInfo.editing == true">
                    <div class="pull-right">
                        @csrf
                        <button class="btn btn-primary ng-binding"  type="submit">
                            <i class="icon-pencil bigger-110"></i>
                            Cập nhật
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
