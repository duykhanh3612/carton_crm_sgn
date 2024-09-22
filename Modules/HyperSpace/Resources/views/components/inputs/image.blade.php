@php
$colLeft = empty($colLeft) ? 12 : $colLeft;
if ($colLeft == 12) {
    $colRight = 12;
}
$type = isset($type) && in_array($type, ['text', 'number', 'date', 'password', 'file', 'hidden', 'email']) ? $type : 'text';
$value = old($name, $value ?? '');
if ($value && is_array($value)) {
    $value = implode(', ', $value);
}
@endphp
<div class="{{ $rowClass ?? 'form-group col-md-12' }} box-image"
    @if (!empty($rowData)) @foreach ($rowData as $dataKey => $dataVal)
        data-{{ $dataKey }}="{{ $dataVal }}"
    @endforeach @endif>
    <div class="col-md-{{$colLeft}}">
        <div class="form-group">
            @if (!empty($label))
                <label for="{{ $name }}">{{ $label }} @if (!empty($required))
                        <span class="text-danger">*</span>
                    @endif
                </label>
            @endif
            <div class="thumb-img">

                <div class="fileinput fileinput-new" data-provides="fileinput" style="width: 100%;height:250px">
                    <div class="fileinput-new thumbnail" id="thumbnail_{{ $name }}">
                        @php
                            if (@$value != '') {
                                $imagePath = asset( $value);
                            } else {
                                $imagePath =  asset('themes/admin/images/frame/370x250.jpg');
                            }
                        @endphp
                        <div class="preview-item">
                            <a  target="_blank" href="{{  @$imagePath }}" data-lightbox="roadtrip">
                             <img src="{{ @$imagePath }}" id="fileinput-newthumbnail" />
                            </a>
                        </div>
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" style=" max-height: 150px;"></div>
                    <div style="clear:both;"></div>
                    <div id="button_{{ $name }}" style="display:flex;justify-content: center;height:45px;">
                        @if ($value == '')
                            <span class="btn dark btn-file" style="width:100%">
                                <span class="fileinput-new" style="    font-size: 24px;">Tải lên</span>
                                <span class="fileinput-exists">Tải lên</span>
                                <input type="file" name="{{ $name }}" onchange="loadFile(event)" accept="image/*"/>
                            </span>
                        @else
                            <input type="hidden" name="{{ $name }}" value="{{ $value }}" onchange="loadFile(event)"  accept="image/*"/>
                            <a class="btn dark btn-clear-image{{ $name }}" data-field="{{ $name }}" data-dismiss="fileinput" style="    font-size: 24px;height:45px;">
                                {{ trans("remove") }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push("js")
    <link rel="stylesheet" href="{{asset('plugin/jasny/jasny-bootstrap.min.css')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.css" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js" charset="UTF-8"></script>
    <script>
    $('.btn-clear-image{{$name}}').on('click',function(){
        var tag = $(this).attr('data-field');
        $('#thumbnail_'+tag).find('.image-wrap').css('background-image','url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxOTAiIGhlaWdodD0iMTQwIj48cmVjdCB3aWR0aD0iMTkwIiBoZWlnaHQ9IjE0MCIgZmlsbD0iI2VlZSIvPjx0ZXh0IHRleHQtYW5jaG9yPSJtaWRkbGUiIHg9Ijk1IiB5PSI3MCIgc3R5bGU9ImZpbGw6I2FhYTtmb250LXdlaWdodDpib2xkO2ZvbnQtc2l6ZToxMnB4O2ZvbnQtZmFtaWx5OkFyaWFsLEhlbHZldGljYSxzYW5zLXNlcmlmO2RvbWluYW50LWJhc2VsaW5lOmNlbnRyYWwiPjE5MHgxNDA8L3RleHQ+PC9zdmc+)');
        $('#button_'+tag).html('<span class="btn btn-default btn-file"><span class="fileinput-new">Tải lên</span><span class="fileinput-exists">Tải lên</span><input type="file" name="{{$name}}" /> </span>');
    });

    var loadFile = function(event) {

        var reader = new FileReader();
        reader.onload = function(){
        var output = document.getElementById('fileinput-newthumbnail');
        output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    };

    </script>


    @endpush
</div>
<style type="text/css">
    .box-image .thumb-img{
        zoom: 0.6;
        max-width: 555px;
        margin: 0 auto;
        background: #ededed;
        padding: 5px 5px 20px 5px;
    }

    .box-image .thumbnail {
            width: 100%;
        height: auto;
        border: 0;
        max-height: 450px;
        background-color: #ededed;
    }

    .box-image .thumbnail img {
        width: 100%;
        height: 200px;
    }

    .box-image .thumbnail img.wide {
        max-width: 100%;
        max-height: 100%;
        height: auto;
    }

    .box-image .thumbnail img.tall {
        max-height: 100%;
        max-width: 100%;
        width: auto;
    }

    ​ .container {
        margin: 0 auto;
        overflow: hidden;
        max-width: 1200px;
        padding: 0 10px;
    }

    .main-img .new {
        width: 205;
        height: 205;
        display: block;
        position: absolute;
        top: 0;
        left: 50%;
        margin-left: -100.025px;
        margin-top: -60px;
    }

    .main-img .wrap-main-img {
        position: relative;
        width: 900px;
        max-width: 90%;
        height: 600px;
        margin: 5px auto 0;
        -webkit-box-shadow: 0px -3px 19px 0px rgba(241, 241, 241, 1);
        -moz-box-shadow: 0px -3px 19px 0px rgba(241, 241, 241, 1);
        box-shadow: 0px -3px 19px 0px rgba(241, 241, 241, 1);
    }

    .main-img .wrap-main-img a span,
    .main-img .wrap-main-img a {
        display: block;
        width: 100%;
        height: 100%;
    }

    .main-img .wrap-main-img a span {
        -webkit-transition: all 2s ease-in-out;
        -moz-transition: all 2s ease-in-out;
        -o-transition: all 2s ease-in-out;
        transition: all 2s ease-in-out;
        background-size: 100%;
    }

    .main-img .wrap-main-img:hover a span {
        background-position: 50% 100%;
    }

    .txt-main-img {
        text-transform: uppercase;
        text-align: center;
        font-size: 14px;
        font-weight: 600;
        color: #56565b;
        padding-top: 50px;
        margin-bottom: 95px;
        letter-spacing: 1px;
    }

    .preview-list {
        overflow: hidden;
        display: inline-block;
        padding: 0px;
    }



    .preview-list li {
        display: inline-block;
        *display: inline;
        zoom: 1;
        margin: 0;
    }

    .preview-list li>div {
        margin: 0 auto;
    }

    .preview-list li>div img {
        max-width: 100%;
    }

    .preview-list.store-list li.store {
        width: 25%;
        float: none;
    }

    .preview-list.store-list li.store:hover img {
        -webkit-box-shadow: 0px 0px 5px 4px rgba(221, 221, 221, 1);
        -moz-box-shadow: 0px 0px 5px 4px rgba(221, 221, 221, 1);
        box-shadow: 0px 0px 5px 4px rgba(221, 221, 221, 1);
    }

    .preview ul li>div p {
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .box-image .preview-item {
        position: relative;
        width: 100%;
        text-align: center;
        background: #ededed;
        height: 200px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 20px;
    }
    .dark.box-image .preview-item{
        background: #787878;
    }
    .preview-item .mac-frame {
        /* background: url('http://cdn.dyndns.top/public/dashboard/assets/img/mac_frame.png') 0 0 no-repeat; */
        background: #ccc;
        width: 100%;
        height: 234px;
        background-size: 100%;
    }

    .preview-item .mac-frame a span.image-wrap {
        display: block;
        height: 100%;
        background-size: 100%;
        background-position: center 0%;
        width: 100%;
        margin-left: auto;
        margin-right: auto;
        background-repeat: no-repeat;
    }

    .preview-item .mac-frame a {
        display: block;
        padding: 5px;
        height: 100%;
    }


    .preview-item .iphone-frame {
        /* background: url('http://cdn.dyndns.top/public/dashboard/assets/img/iphone_frame.png') 0 0 no-repeat; */
        background: #ccc;
        width: 90px;
        height: 181px;
        background-size: 100%;
        position: absolute;
        top: 0;
        right: 0;
        margin-top: 60px;
    }

    .preview-item .iphone-frame a {
        display: block;
        padding: 18px 5px;
    }

    .preview-item .iphone-frame a span.image-wrap {
        display: block;
        height: 144px;
        width: 100%;
        background-size: 100% !important;
        background-position: center 0% !important;
        background-repeat: no-repeat;
        background-color: #fff;
    }

    /*End Content*/




    /*Footer*/
    #function-list {
        background: #101010;
    }

    ul.function-list {
        padding: 50px 100px 0;
    }

    ul.function-list>li {
        width: 20%;
        padding-bottom: 50px;
        list-style: none;
    }

    ul.function-list>li img {
        float: left;
    }

    ul.function-list>li div {
        display: table;
        table-layout: fixed;
        height: 60px;
    }

    ul.function-list>li span {
        color: #a3a3a3;
        margin-left: 10px;
        display: table-cell;
        vertical-align: middle;
        padding-left: 10px;
        padding-right: 10px;
    }

    #buy-now {
        text-align: center;
        background: #000;
        width: 100%;
        height: 100%;
        display: block;
        padding: 80px 0;
    }

    #buy-now a {
        font-size: 18px;
        font-family: 'Montserrat', sans-serif;
        color: #fff;
        text-transform: uppercase;
        border: 1px solid #3f9500;
        background: #3f9500;
        padding: 20px 100px;
        text-decoration: none;
    }
    .btn.dark:not(.btn-outline) {
        color: #fff !important;
        background-color: #2f353b;
        border-color: #2f353b;
    }
    /*End Footer*/
    /*-----------------------*/
    @media only screen and (min-width: 1200px) and (max-width: 1360px) {
        .preview-item {
            width: 400px;
        }

        .preview-item .mac-frame {
            height: 275px;
        }

        .preview-item .mac-frame a span.image-wrap {
            height: 196px;
        }

        .preview-item .iphone-frame a span.image-wrap {
            height: 145px;
        }
    }

    @media only screen and (min-width: 1024px) and (max-width: 1279px) {
        .preview-item .mac-frame a {
            padding: 3% 12%;
        }
    }

    @media only screen and (min-width: 1024px) and (max-width: 1199px) {
        .preview-item {
            width: 340px;
        }

        .preview-item .mac-frame a span.image-wrap {
            height: 165px;
        }
    }

    @media (max-width: 1199px) {
        .preview-list.store-list li.store {
            width: 33%;
        }

        .preview-item .iphone-frame {
            margin-right: 0;
        }
    }

    @media only screen and (min-width: 768px) and (max-width: 1023px) {
        .preview-item {
            width: 250px;
        }

        .preview-item .mac-frame a span.image-wrap {
            height: 125px;
        }

        .preview-item .mac-frame a {
            padding: 6px 29px;
        }

        .preview-item .iphone-frame {
            margin-top: 50px;
            width: 65px;
        }

        .preview-item .iphone-frame a {
            padding: 12px 2px;
        }

        .preview-item .iphone-frame a span.image-wrap {
            height: 105px;
        }
    }

    @media (max-width: 991px) {
        .preview-list.store-list li.store {
            width: 50%;
        }

        ul.function-list>li {
            width: 50%;
        }
    }

    @media (max-width: 767px) {
        .preview-list.store-list li.store {
            width: 100%;
        }

        #store-list ul.store-list>li {
            width: 100%;
        }

        .txt-main-img {
            margin-bottom: 35px;
        }
    }

    @media only screen and (min-width: 480px) and (max-width: 767px) {
        .preview-item {
            width: 460px;
        }

        .preview-item .mac-frame a span.image-wrap {
            height: 220px;
        }
    }

    @media (max-width: 480px) {
        ul.function-list>li {
            width: 100%;
        }

        ul.function-list {
            padding-left: 20px;
            padding-right: 20px;
        }
    }

    @media (max-width: 479px) {
        .preview-item {
            width: 300px;
        }

        .preview-item .mac-frame a {
            padding: 6px 35px;
        }

        .preview-item .mac-frame a span.image-wrap {
            height: 150px;
        }

        .preview-item .iphone-frame {
            width: 60px;
            margin-top: 60px;
        }

        .preview-item .iphone-frame a {
            padding: 13px 3px;
        }

        .preview-item .iphone-frame a span.image-wrap {
            height: 95px;
        }

        #buy-now a {
            padding: 20px 50px;
        }
    }
</style>
