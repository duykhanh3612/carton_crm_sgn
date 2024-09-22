
<div class="form-group row">
    <div class="col-sm-4">
        <label>{!!trans('backLang.styleColor1') !!}</label>

        <div>
            <div id="cp1" class="input-group colorpicker-component">
                {!!Form::text('style_color1',$row->style_color1, array('placeholder' => '','class' => 'form-control','id'=>'style_color1', 'dir'=>trans('backLang.ltr'))) !!}
                <span class="input-group-addon" id="cpbg">
                    <i></i>
                </span>
            </div>
        </div>
        <small>
            <a href="javascript:null"
                onclick="update_restcolor()">
                {!!trans('backLang.restoreDefault') !!}
            </a>
        </small>
    </div>

    <div class="col-sm-4">
        <label>{!!trans('backLang.styleColor2') !!}</label>

        <div>
            <div id="cp2" class="input-group colorpicker-component">
                {!!Form::text('style_color2',$row->style_color2, array('placeholder' => '','class' => 'form-control','id'=>'style_color2', 'dir'=>trans('backLang.ltr'))) !!}
                <span class="input-group-addon" id="cpbg2">
                    <i></i>
                </span>
            </div>
        </div>
        <small>
            <a href="javascript:null"
                onclick="update_restcolor2()">
                {!!trans('backLang.restoreDefault') !!}
            </a>
        </small>
    </div>
</div>
<hr />
<div class="form-group row">
    <div class="col-sm-4">
        <label>{{trans('backLang.layoutMode') }} : </label>
        <div class="radio">
            <label class="ui-check ui-check-md">
                {!!Form::radio('style_type','0',$row->style_type ? false : true , array('id' => 'style_type1','class'=>'has-value')) !!}
                <i class="dark-white"></i>
                {{trans('backLang.wide') }}
            </label>
            &nbsp; &nbsp;
            <label class="ui-check ui-check-md">
                {!!Form::radio('style_type','1',$row->style_type ? true : false , array('id' => 'style_type2','class'=>'has-value')) !!}
                <i class="dark-white"></i>
                {{trans('backLang.boxed') }}
            </label>
        </div>
    </div>

    <div class="col-sm-8"
        id="bgtyps" {!!(!$row->style_type) ? "style='display:none'":"" !!}>
        <label>{{trans('backLang.backgroundStyle') }} : </label>
        <div class="radio">
            <label class="ui-check ui-check-md">
                {!!Form::radio('style_bg_type','0',($row->style_bg_type==0) ? true : false , array('id' => 'style_bg_type1','class'=>'has-value')) !!}
                <i class="dark-white"></i>
                {{trans('backLang.colorBackground') }}
            </label>
            &nbsp; &nbsp;
            <label class="ui-check ui-check-md">
                {!!Form::radio('style_bg_type','1',($row->style_bg_type==1) ? true : false , array('id' => 'style_bg_type2','class'=>'has-value')) !!}
                <i class="dark-white"></i>
                {{trans('backLang.patternsBackground') }}
            </label>
            &nbsp; &nbsp;
            <label class="ui-check ui-check-md">
                {!!Form::radio('style_bg_type','2',($row->style_bg_type==2) ? true : false , array('id' => 'style_bg_type3','class'=>'has-value')) !!}
                <i class="dark-white"></i>
                {{trans('backLang.imageBackground') }}
            </label>
        </div>
        <div class="row"
            id="bgtclr" {!!($row->style_bg_type!=0) ? "style='display:none'":"" !!}>
            <div class="col-sm-11">
                <div id="cp3" class="input-group colorpicker-component">
                    {!!Form::text('style_bg_color',$row->style_bg_color, array('placeholder' => '','class' => 'form-control','id'=>'style_bg_color', 'dir'=>trans('backLang.ltr'))) !!}
                    <span class="input-group-addon">
                        <i></i>
                    </span>
                </div>
            </div>
        </div>

        <div class="row"
            id="bgtptr" {!!($row->style_bg_type!=1) ? "style='display:none'":"" !!}>
            <div>
                @for($i=1;$i<=24;$i++)
                    <?php
                    $img_name = "p" . $i . ".png";
                    ?>></=24;$i++)>
                <div class="col-sm-3">
                    <label class="ui-check ui-check-md">
                        {!!Form::radio('style_bg_pattern',$img_name,($row->style_bg_pattern==$img_name) ? true : false , array('id' => 'style_bg_pattern'.$i,'class'=>'has-value')) !!}
                        <i class="dark-white"></i>
                        <img src="{{URL::to('uploads/pattern/'.$img_name) }}"
                            style="width: 40px;height: 40px;border: 2px solid #fff"
                            alt="" />
                    </label>
                </div>
                @endfor

            </div>
        </div>

        <div class="row"
            id="bgtimg" {!!($row->style_bg_type!=2) ? "style='display:none'":"" !!}>
            <div>
                @if($row->style_bg_image!="")
                <div>
                    <div>
                        <div class="col-sm-12 box p-a-xs text-center">
                            <a target="_blank"
                                href="{{URL::to('uploads/settings/'.$row->style_bg_image) }}">
                                <img
                                    src="{{URL::to('uploads/settings/'.$row->style_bg_image) }}"
                                    class="img-responsive"
                                    style="max-height: 200px;width: auto" />
                                <br />
                                <small>{{$row->style_bg_image }}</small>
                            </a>
                        </div>
                    </div>
                </div>
                @endif
                                            {!!Form::file('style_bg_image', array('class' => 'form-control','id'=>'style_bg_image','accept'=>'image/*')) !!}
                <small>
                    <i class="material-icons">&#xe8fd;</i>( 260x60 px ) -
                                                {!!trans('backLang.imagesTypes') !!}
                </small>
            </div>
        </div>


    </div>
</div>
<hr />
<div class="form-group">
    <label>{{trans('backLang.fixedHeader') }} : </label>
    <div class="radio">
        <label class="ui-check ui-check-md">
            {!!Form::radio('style_header','1',$row->style_header ? true : false , array('id' => 'style_header1','class'=>'has-value')) !!}
            <i class="dark-white"></i>
            {{trans('backLang.active') }}
        </label>
        &nbsp; &nbsp;
        <label class="ui-check ui-check-md">
            {!!Form::radio('style_header','0',$row->style_header ? false : true , array('id' => 'style_header2','class'=>'has-value')) !!}
            <i class="dark-white"></i>
            {{trans('backLang.notActive') }}
        </label>
    </div>
</div>
<hr />
<div class="form-group">
    <label>{{trans('backLang.footerStyle') }} : </label>
    <div class="radio">
        <label class="ui-check ui-check-md">
            {!!Form::radio('style_footer','1',($row->style_footer ==1) ? true : false , array('id' => 'style_footer1','class'=>'has-value')) !!}
            <i class="dark-white"></i>
            {{trans('backLang.footerStyle') }} #1
        </label>
        &nbsp; &nbsp;
        <label class="ui-check ui-check-md">
            {!!Form::radio('style_footer','2',($row->style_footer ==2) ? true : false , array('id' => 'style_footer2','class'=>'has-value')) !!}
            <i class="dark-white"></i>
            {{trans('backLang.footerStyle') }} #2
        </label>
    </div>

    <label>{{trans('backLang.footerStyleBg') }} : </label>
    <div class="row">
        <div class="col-sm-6">
            @if($row->style_footer_bg!="")
            <div>
                <div>
                    <div id="footer_bg" class="col-sm-8 box p-a-xs">
                        <a target="_blank"
                            href="{{URL::to('uploads/settings/'.$row->style_footer_bg) }}">
                            <img
                                src="{{URL::to('uploads/settings/'.$row->style_footer_bg) }}"
                                class="img-responsive" />
                            {{$row->style_footer_bg }}
                        </a>
                        <br />
                        <a onclick="document.getElementById('footer_bg').style.display='none';document.getElementById('photo_delete').value='1';document.getElementById('undo').style.display='block';"
                            class="btn btn-sm btn-default">
                            {!!trans('backLang.delete') !!}
                        </a>
                    </div>
                    <div id="undo" class="col-sm-4 p-a-xs" style="display: none">
                        <a onclick="document.getElementById('footer_bg').style.display='block';document.getElementById('photo_delete').value='0';document.getElementById('undo').style.display='none';">
                            <i class="material-icons">
                                &#xe166;
                            </i>{!!trans('backLang.undoDelete') !!}
                        </a>
                    </div>

                    {!!Form::hidden('photo_delete','0', array('id'=>'photo_delete')) !!}
                </div>
            </div>

            @endif
                                        {!!Form::file('style_footer_bg', array('class' => 'form-control','id'=>'style_footer_bg','accept'=>'image/*')) !!}
            <small>
                <i class="material-icons">&#xe8fd;</i>( 260x60 px ) -
                                            {!!trans('backLang.imagesTypes') !!}
            </small>
        </div>
    </div>

</div>
<hr />
<div class="form-group">
    <label>{{trans('backLang.newsletterSubscribe') }} : </label>
    <div class="radio">
        <label class="ui-check ui-check-md">
            {!!Form::radio('style_subscribe','1',$row->style_subscribe ? true : false , array('id' => 'style_subscribe1','class'=>'has-value')) !!}
            <i class="dark-white"></i>
            {{trans('backLang.active') }}
        </label>
        &nbsp; &nbsp;
        <label class="ui-check ui-check-md">
            {!!Form::radio('style_subscribe','0',$row->style_subscribe ? false : true , array('id' => 'style_subscribe2','class'=>'has-value')) !!}
            <i class="dark-white"></i>
            {{trans('backLang.notActive') }}
        </label>
    </div>
</div>
<hr />
<div class="form-group">
    <label>{{trans('backLang.preLoad') }} : </label>
    <div class="radio">
        <label class="ui-check ui-check-md">
            {!!Form::radio('style_preload','1',$row->style_preload ? true : false , array('id' => 'style_preload1','class'=>'has-value')) !!}
            <i class="dark-white"></i>
            {{trans('backLang.active') }}
        </label>
        &nbsp; &nbsp;
        <label class="ui-check ui-check-md">
            {!!Form::radio('style_preload','0',$row->style_preload ? false : true , array('id' => 'style_preload2','class'=>'has-value')) !!}
            <i class="dark-white"></i>
            {{trans('backLang.notActive') }}
        </label>
    </div>
</div>