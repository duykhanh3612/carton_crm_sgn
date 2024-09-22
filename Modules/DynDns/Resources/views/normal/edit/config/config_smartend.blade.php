    <div class="padding">
        <div class="row-col">
            <div class="col-sm-3 col-lg-2">
                <div class="p-y">
                    <div class="nav-active-border left b-primary">
                        <ul class="nav nav-sm">
                            <li class="nav-item">
                                <a class="nav-link block {{ ( Session::get('active_tab') == 'infoTab' || Session::get('active_tab') =="") ? 'active' : '' }}"
                                    data-toggle="tab" data-target="#tab-1"
                                   onclick="document.getElementById('active_tab').value='infoTab'"><i
                                            class="material-icons">&#xe30c;</i>
                                    &nbsp; {!!  trans('backLang.siteInfoSettings') !!}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link block {{  ( Session::get('active_tab') == 'contactsTab') ? 'active' : '' }}"
                                   data-toggle="tab" data-target="#tab-2"
                                   onclick="document.getElementById('active_tab').value='contactsTab'"><i
                                            class="material-icons">&#xe0ba;</i>
                                    &nbsp; {!!  trans('backLang.siteContactsSettings') !!}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link block {{  ( Session::get('active_tab') == 'socialTab') ? 'active' : '' }}"
                                   data-toggle="tab" data-target="#tab-3"
                                   onclick="document.getElementById('active_tab').value='socialTab'"><i
                                            class="material-icons">&#xe80d;</i>
                                    &nbsp; {!!  trans('backLang.siteSocialSettings') !!}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link block {{  ( Session::get('active_tab') == 'styleTab') ? 'active' : '' }}"
                                   data-toggle="tab" data-target="#tab-5"
                                   onclick="document.getElementById('active_tab').value='styleTab'"><i
                                            class="material-icons">&#xe41d;</i>
                                    &nbsp; {!!  trans('backLang.styleSettings') !!}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link block {{  ( Session::get('active_tab') == 'emailTab') ? 'active' : '' }}"
                                   data-toggle="tab" data-target="#tab-6"
                                   onclick="document.getElementById('active_tab').value='emailTab'"><i
                                            class="material-icons">&#xe0be;</i>
                                    &nbsp; {!!  trans('backLang.emailNotifications') !!}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link block {{  ( Session::get('active_tab') == 'statusTab') ? 'active' : '' }}"
                                   data-toggle="tab" data-target="#tab-4"
                                   onclick="document.getElementById('active_tab').value='statusTab'"><i
                                            class="material-icons">&#xe8c6;</i>
                                    &nbsp; {!!  trans('backLang.siteStatusSettings') !!}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-7 col-lg-10 light lt">
                <input type="hidden" id="active_tab" name="active_tab" value="{{ Session::get('active_tab') }}"/>
                <div class="tab-content pos-rlt">
                    <!--<button type="submit" class="btn btn-info m-a pull-right">{{ trans('backLang.update') }}</button>-->
                    <div class="tab-pane {{ ( Session::get('active_tab') == 'infoTab' || Session::get('active_tab') =="") ? 'active' : '' }}"  id="tab-1">
                        <div class="p-a-md">
                        <h5>
                                <i class="material-icons">&#xe30c;</i>
                                &nbsp; {!!  trans('backLang.siteInfoSettings') !!}</h5>
                        </div>
                        <div class="p-a-md col-md-12">
                            <div class="form-group">
                                <label>Title</label>
                                {!!Form::text('title_vn',$row->title_vn, array('placeholder' => trans('backLang.websiteTitle'),'class' => 'form-control', 'dir'=>trans('backLang.ltr'))) !!}
                            </div>
                            <div class="form-group">
                                <label>Content footer</label>
                                {!!Form::textarea('content_footer',$row->content_footer, array('placeholder' => trans('backLang.websiteTitle'),'class' => 'form-control', 'dir'=>trans('backLang.ltr'))) !!}
                            </div>
                            <div class="form-group">
                                <label>Slogan</label>
                                {!!Form::textarea('slogan',@$row->slogan, array('placeholder' => trans('backLang.websiteTitle'),'class' => 'form-control', 'dir'=>trans('backLang.ltr'))) !!}
                            </div>
                            <!-- Seo-->
                            {!! view(alias_admin.'::sys.template.normal.edit.seo.seo',array('row'=>$row,'ctrl'=>(object)array('name'=>'seo','value'=>'seo'))) !!}
                            <!-- Web site-->
                            <div class="form-group">
                                <label>{!!  trans('backLang.websiteUrl') !!}</label>
                                <div>
                                    {!! Form::text('site_url',$row->site_url, array('placeholder' => 'http//:www.sitename.com/','class' => 'form-control', 'dir'=>trans('backLang.ltr'))) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane {{  ( Session::get('active_tab') == 'contactsTab') ? 'active' : '' }}"
                         id="tab-2">
                        <div class="p-a-md"><h5><i class="material-icons">&#xe0ba;</i>&nbsp; {!!  trans('backLang.siteContactsSettings') !!}</h5></div>
                        <div class="p-a-md col-md-12">

                            <div class="form-group">
                                <label>
                                   Địa chỉ dự án
                                </label>
                                {!! Form::text('address_project',@$row->address_project, array('placeholder' => 'Địa chỉ dự án','class' => 'form-control has-value', 'dir'=>trans('backLang.ltr'))) !!}
                            </div>
                            <div class="form-group">
                                <label>
                                    Địa chỉ giao dịch
                                </label>
                                {!! Form::text('address_trading',@$row->address_trading, array('placeholder' => 'Địa chỉ giao dịch','class' => 'form-control has-value', 'dir'=>trans('backLang.ltr'))) !!}
                            </div>
                            <div class="form-group">
                                <label>{!!  trans('backLang.contactPhone') !!}</label>
                                {!! Form::text('contact_t3',$row->contact_t3, array('placeholder' => trans('backLang.contactPhone'),'class' => 'form-control', 'dir'=>trans('backLang.ltr'))) !!}
                            </div>
                            <div class="form-group">
                                <label>{!!  trans('backLang.contactFax') !!}</label>
                                {!! Form::text('contact_t4',$row->contact_t4, array('placeholder' => trans('backLang.contactFax'),'class' => 'form-control', 'dir'=>trans('backLang.ltr'))) !!}
                            </div>
                            <div class="form-group">
                                <label>{!!  trans('backLang.contactMobile') !!}</label>
                                {!! Form::text('contact_t5',$row->contact_t5, array('placeholder' => trans('backLang.contactMobile'),'class' => 'form-control', 'dir'=>trans('backLang.ltr'))) !!}
                            </div>
                            <div class="form-group">
                                <label>{!!  trans('backLang.contactEmail') !!}</label>
                                {!! Form::text('contact_t6',$row->contact_t6, array('placeholder' => trans('backLang.contactEmail'),'class' => 'form-control', 'dir'=>trans('backLang.ltr'))) !!}
                            </div>

                            <div class="form-group">
                                <label>Map Tag</label>
                                {!! Form::text('google_map_em',@$row->google_map_em, array('placeholder' => 'Google Map','class' => 'form-control', 'dir'=>trans('backLang.rtl'))) !!}
                            </div>
                            <div class="form-group">
                                <label>Map Tag</label>
                                {!! Form::text('google_map_api',@$row->google_map_api, array('placeholder' => 'Google Api','class' => 'form-control', 'dir'=>trans('backLang.rtl'))) !!}
                            </div>
                            @if(@$center_lang)
                            @foreach(@$center_lang as $ctrl)
                            @php
                                $pair['row'] = @$row;
                                $pair['ctrl'] = $ctrl;
                                $pair['lang'] = @$ctrl->language==1?'_'.@$lang:'';
                                $pair['path_base'] = $path_base;
                                if(view()->exists("admin::sys.template.normal.edit.".@$ctrl->type))
                                    echo view(h::area_admin.'::sys.template.normal.edit.'.@$ctrl->type,$pair);
                            @endphp
                            @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="tab-pane {{  ( Session::get('active_tab') == 'socialTab') ? 'active' : '' }}"
                         id="tab-3">
                        <div class="p-a-md"><h5><i class="material-icons">&#xe80d;</i>
                                &nbsp; {!!  trans('backLang.siteSocialSettings') !!}</h5></div>
                        <div class="p-a-md col-md-12">
                            <div class="form-group">
                                <label><i class="fa fa-facebook"></i> &nbsp; {!!  trans('backLang.facebook') !!}</label>
                                {!! Form::text('social_link1',$row->social_link1, array('placeholder' => trans('backLang.facebook'),'class' => 'form-control', 'dir'=>trans('backLang.ltr'))) !!}
                            </div>
                            <div class="form-group">
                                <label><i class="fa fa-twitter"></i> &nbsp; {!!  trans('backLang.twitter') !!}</label>
                                {!! Form::text('social_link2',$row->social_link2, array('placeholder' => trans('backLang.twitter'),'class' => 'form-control', 'dir'=>trans('backLang.ltr'))) !!}
                            </div>
                            <div class="form-group">
                                <label><i class="fa fa-google-plus"></i> &nbsp; {!!  trans('backLang.google') !!}
                                </label>
                                {!! Form::text('social_link3',$row->social_link3, array('placeholder' => trans('backLang.google'),'class' => 'form-control', 'dir'=>trans('backLang.ltr'))) !!}
                            </div>
                            <div class="form-group">
                                <label><i class="fa fa-linkedin"></i> &nbsp; {!!  trans('backLang.linkedin') !!}</label>
                                {!! Form::text('social_link4',$row->social_link4, array('placeholder' => trans('backLang.linkedin'),'class' => 'form-control', 'dir'=>trans('backLang.ltr'))) !!}
                            </div>
                            <div class="form-group">
                                <label><i class="fa fa-youtube-play"></i> &nbsp; {!!  trans('backLang.youtube') !!}
                                </label>
                                {!! Form::text('social_link5',$row->social_link5, array('placeholder' => trans('backLang.youtube'),'class' => 'form-control', 'dir'=>trans('backLang.ltr'))) !!}
                            </div>
                            <div class="form-group">
                                <label><i class="fa fa-instagram"></i> &nbsp; {!!  trans('backLang.instagram') !!}
                                </label>
                                {!! Form::text('social_link6',$row->social_link6, array('placeholder' => trans('backLang.instagram'),'class' => 'form-control', 'dir'=>trans('backLang.ltr'))) !!}
                            </div>
                            <div class="form-group">
                                <label><i class="fa fa-pinterest"></i> &nbsp; {!!  trans('backLang.pinterest') !!}
                                </label>
                                {!! Form::text('social_link7',$row->social_link7, array('placeholder' => trans('backLang.pinterest'),'class' => 'form-control', 'dir'=>trans('backLang.ltr'))) !!}
                            </div>
                            <div class="form-group">
                                <label><i class="fa fa-tumblr"></i> &nbsp; {!!  trans('backLang.tumblr') !!}</label>
                                {!! Form::text('social_link8',$row->social_link8, array('placeholder' => trans('backLang.tumblr'),'class' => 'form-control', 'dir'=>trans('backLang.ltr'))) !!}
                            </div>
                            <div class="form-group">
                                <label><i class="fa fa-flickr"></i> &nbsp; {!!  trans('backLang.flickr') !!}</label>
                                {!! Form::text('social_link9',$row->social_link9, array('placeholder' => trans('backLang.flickr'),'class' => 'form-control', 'dir'=>trans('backLang.ltr'))) !!}
                            </div>
                            <div class="form-group">
                                <label><i class="fa fa-whatsapp"></i> &nbsp; {!!  trans('backLang.whatapp') !!}</label>
                                {!! Form::text('social_link10',$row->social_link10, array('placeholder' => trans('backLang.whatapp'),'class' => 'form-control', 'dir'=>trans('backLang.ltr'))) !!}
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane {{  ( Session::get('active_tab') == 'statusTab') ? 'active' : '' }}"
                         id="tab-4">
                        <div class="p-a-md"><h5><i class="material-icons">&#xe8c6;</i>
                                &nbsp; {!!  trans('backLang.siteStatusSettings') !!}</h5></div>
                        <div class="p-a-md col-md-12">
                            <div class="form-group">
                                <label>{{ trans('backLang.siteStatusSettings') }} : </label>
                                <div class="radio">
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('site_status','1',$row->site_status ? true : false , array('id' => 'site_status1','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ trans('backLang.active') }}
                                    </label>
                                    &nbsp; &nbsp;
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('site_status','0',$row->site_status ? false : true , array('id' => 'site_status2','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ trans('backLang.notActive') }}
                                    </label>
                                </div>
                            </div>
                            <div class="form-group"
                                 id="close_msg_div" {!!   ($row->site_status) ? "style='display:none'":"" !!}>
                                <label>{!!  trans('backLang.siteStatusSettingsMsg') !!} </label>
                                {!! Form::textarea('close_msg',$row->close_msg, array('placeholder' => trans('backLang.siteStatusSettingsMsg'),'class' => 'form-control','rows'=>'4')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane {{  ( Session::get('active_tab') == 'emailTab') ? 'active' : '' }}"
                         id="tab-6">
                        <div class="p-a-md"><h5><i class="material-icons">&#xe0be;</i>
                                &nbsp; {!!  trans('backLang.emailNotifications') !!}</h5></div>
                        <div class="p-a-md col-md-12">
                            <div class="form-group">
                                <label>{!!  trans('backLang.websiteNotificationEmail') !!}</label>
                                {!! Form::text('site_webmails',$row->site_webmails, array('placeholder' => 'email@sitename.com','class' => 'form-control', 'dir'=>trans('backLang.ltr'))) !!}
                            </div>
                            <div class="form-group">
                                <label>{{ trans('backLang.websiteNotificationEmail1') }} : </label>
                                <div class="radio">
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('notify_messages_status','1',$row->notify_messages_status ? true : false , array('id' => 'seo_status1','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ trans('backLang.yes') }}
                                    </label>
                                    &nbsp; &nbsp;
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('notify_messages_status','0',$row->notify_messages_status ? false : true , array('id' => 'seo_status2','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ trans('backLang.no') }}
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>{{ trans('backLang.websiteNotificationEmail2') }} : </label>
                                <div class="radio">
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('notify_comments_status','1',$row->notify_comments_status ? true : false , array('id' => 'seo_status1','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ trans('backLang.yes') }}
                                    </label>
                                    &nbsp; &nbsp;
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('notify_comments_status','0',$row->notify_comments_status ? false : true , array('id' => 'seo_status2','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ trans('backLang.no') }}
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>{{ trans('backLang.websiteNotificationEmail3') }} : </label>
                                <div class="radio">
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('notify_orders_status','1',$row->notify_orders_status ? true : false , array('id' => 'seo_status1','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ trans('backLang.yes') }}
                                    </label>
                                    &nbsp; &nbsp;
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('notify_orders_status','0',$row->notify_orders_status ? false : true , array('id' => 'seo_status2','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ trans('backLang.no') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane {{  ( Session::get('active_tab') == 'styleTab') ? 'active' : '' }}" id="tab-5">
                        <div class="p-a-md"><h5><i class="material-icons">&#xe41d;</i>
                                &nbsp; {!!  trans('backLang.styleSettings') !!}</h5></div>
                        <div class="p-a-md col-md-12">
                            <div class="form-group row">
                                {!! view(alias_admin.'::sys.template.normal.edit.image.image',array('row'=>$row,'ctrl'=>(object)array('title'=>'logo','name'=>'logo','value'=>'logo','mask'=>'default'),'func'=>$func)) !!}

                            </div>
                            <hr>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="style_fav">{!!  trans('backLang.favicon') !!}</label>
                                    @if($row->style_fav!="")
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="col-sm-12 box p-a-xs text-center">
                                                    <a target="_blank"
                                                        href="{{ $base.$row->style_fav }}">
                                                        <img
                                                            src="{{$base.$row->style_fav }}"
                                                            class="img-responsive" id="style_fav_prv"
                                                            style="max-width: 60px;height: 60px" />
                                                        <br />
                                                        <small>{{ $row->style_fav }}</small>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="col-sm-12 box p-a-xs text-center">
                                                    <a target="_blank"
                                                       href="{{ URL::to('uploads/settings/nofav.png') }}"><img
                                                                src="{{ URL::to('uploads/settings/nofav.png') }}"
                                                                class="img-responsive" id="style_fav_prv"
                                                                style="max-width: 60px;height: 60px">
                                                        <br>
                                                        <small>nofav.png</small>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    {!! Form::file('style_fav', array('class' => 'form-control','id'=>'style_fav','accept'=>'image/*')) !!}
                                    <small>
                                        <i class="material-icons">&#xe8fd;</i> ( 32x32 px ) -
                                        {!!  trans('backLang.imagesTypes') !!}
                                    </small>
                                </div>
                                <div class="col-sm-6">
                                    <label for="style_apple">{!!  trans('backLang.appleIcon') !!}</label>
                                    @if($row->style_apple!="")
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="col-sm-12 box p-a-xs text-center">
                                                    <a target="_blank"
                                                        href="{{ $base.$row->style_apple }}">
                                                        <img
                                                            src="{{ $base.$row->style_apple }}"
                                                            class="img-responsive" id="style_apple_prv"
                                                            style="width: 60px;height: 60px" />
                                                        <br />
                                                        <small>{{ $row->style_apple }}</small>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="col-sm-12 box p-a-xs text-center">
                                                    <a target="_blank"
                                                       href="{{ URL::to('uploads/settings/nofav.png') }}"><img
                                                                src="{{ URL::to('uploads/settings/nofav.png') }}"
                                                                class="img-responsive" id="style_apple_prv"
                                                                style="max-width: 60px;height: 60px">
                                                        <br>
                                                        <small>nofav.png</small>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    {!! Form::file('style_apple', array('class' => 'form-control','id'=>'style_apple','accept'=>'image/*')) !!}
                                    <small>
                                        <i class="material-icons">&#xe8fd;</i> ( 180x180 px ) -
                                        {!!  trans('backLang.imagesTypes') !!}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#site_status1").click(function () {
                $("#close_msg_div").css("display", "none");
            });
            $("#site_status2").click(function () {
                $("#close_msg_div").css("display", "block");
            });
            $("#style_type1").click(function () {
                $("#bgtyps").css("display", "none");
            });
            $("#style_type2").click(function () {
                $("#bgtyps").css("display", "inline-block");
            });
            $("#style_bg_type1").click(function () {
                $("#bgtimg").css("display", "none");
                $("#bgtptr").css("display", "none");
                $("#bgtclr").css("display", "inline-block");
            });
            $("#style_bg_type2").click(function () {
                $("#bgtimg").css("display", "none");
                $("#bgtclr").css("display", "none");
                $("#bgtptr").css("display", "inline-block");
            });
            $("#style_bg_type3").click(function () {
                $("#bgtptr").css("display", "none");
                $("#bgtclr").css("display", "none");
                $("#bgtimg").css("display", "inline-block");
            });
        });
    </script>
    <script src="{{ URL::to('backEnd/libs/jquery/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
    <script>
        $(function () {
            $('#cp1').colorpicker({
                colorSelectors: {
                    'black': '#000000',
                    'white': '#ffffff',
                    'red': '#FF0000',
                    'default': '#777777',
                    'primary': '#337ab7',
                    'success': '#5cb85c',
                    'info': '#5bc0de',
                    'warning': '#f0ad4e',
                    'danger': '#d9534f'
                }
            });
            $('#cp2').colorpicker({
                colorSelectors: {
                    'black': '#000000',
                    'white': '#ffffff',
                    'red': '#FF0000',
                    'default': '#777777',
                    'primary': '#337ab7',
                    'success': '#5cb85c',
                    'info': '#5bc0de',
                    'warning': '#f0ad4e',
                    'danger': '#d9534f'
                }
            });
            $('#cp3').colorpicker({
                colorSelectors: {
                    'black': '#000000',
                    'white': '#ffffff',
                    'red': '#FF0000',
                    'default': '#777777',
                    'primary': '#337ab7',
                    'success': '#5cb85c',
                    'info': '#5bc0de',
                    'warning': '#f0ad4e',
                    'danger': '#d9534f'
                }
            });
        });
        function update_restcolor() {
            document.getElementById("style_color1").value = '#0cbaa4';
            $("#cpbg i").css("background-color", "#0cbaa4");
        }
        function update_restcolor2() {
            document.getElementById("style_color2").value = '#2e3e4e';
            $("#cpbg2 i").css("background-color", "#2e3e4e");
        }
    </script>
    <script type="text/javascript">
        function readURL(input, prv) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#' + prv).attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#style_logo_ar").change(function () {
            readURL(this, "style_logo_ar_prv");
        });
        $("#style_logo_en").change(function () {
            readURL(this, "style_logo_en_prv");
        });
        $("#style_fav").change(function () {
            readURL(this, "style_fav_prv");
        });
        $("#style_apple").change(function () {
            readURL(this, "style_apple_prv");
        });
    </script>
