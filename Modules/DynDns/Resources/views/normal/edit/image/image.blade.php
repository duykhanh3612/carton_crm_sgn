<div class="form-group  {{@$ctrl->width}} ">
    <label >
        <?=@$ctrl->title?>
    </label>
    <div>
        <div class="fileinput fileinput-new" data-provides="fileinput" style="width: 100%;height:250px">

            <div class="fileinput-new thumbnail" id="thumbnail_{{@$ctrl->name}}">
				@php
					if( @$row->{$ctrl->value} !=''){
						$imagePath = @$image_path. $row->{$ctrl->value}."?v=".time();
					}
					else{
						$imagePath = base.'/assets/img/370x250.jpg';
					}
				@endphp
                <div class="preview-item">
                    <div class="mac-frame">
                        <a title="arnormy furniture" target="_blank" href="{{$link=@$r->website}}">
                            <span class="image-wrap move-long" style="background-image: url('{{@$imagePath }}')"></a>
                    </div>
                    <div class="iphone-frame">
                        <a title="arnormy furniture" target="_blank" href="{{$link}}">
                            <span class="image-wrap move-long" style="background: #fff url('{{@$imagePath }}')"></a>
                    </div>

                </div>
            </div>
            <div class="fileinput-preview fileinput-exists thumbnail" style=" max-height: 150px;"></div>
            <div style="clear:both;"></div>
			<input type="hidden" id="{{$ctrl->name}}" name="{{$ctrl->name}}" value="{{ @$row->{$ctrl->value} }}" />
        <div id="button_{{$ctrl->name}}" >

                @if(@$row->{$ctrl->value}=='')
                <span class="btn {{@$style}} btn-file" style="width:100%">
                    <span class="fileinput-new">Tải lên</span>
                    <span class="fileinput-exists">Tải lên</span>
                    <input type="file" name="{{ @$ctrl->name}}" />
                </span>
                @else
                <a class="btn {{@$conf->site_style}} btn-clear btn-clear-image{{$ctrl->name}}" data-field="{{$ctrl->name}}" data-dismiss="fileinput">
					{{__('app.remove')}}
				</a>
                @endif
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="{{env_host}}/public/plugin/jasny/jasny-bootstrap.min.css" />
    <script type="text/javascript" src="{{env_host}}/public/plugin/jasny/jasny-bootstrap.min.js" charset="UTF-8"></script>
    <script>
		$('.btn-clear-image{{$ctrl->name}}').on('click',function(){
			var tag = $(this).attr('data-field');
			// $('#thumbnail_'+tag).find('img').attr('src','data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxOTAiIGhlaWdodD0iMTQwIj48cmVjdCB3aWR0aD0iMTkwIiBoZWlnaHQ9IjE0MCIgZmlsbD0iI2VlZSIvPjx0ZXh0IHRleHQtYW5jaG9yPSJtaWRkbGUiIHg9Ijk1IiB5PSI3MCIgc3R5bGU9ImZpbGw6I2FhYTtmb250LXdlaWdodDpib2xkO2ZvbnQtc2l6ZToxMnB4O2ZvbnQtZmFtaWx5OkFyaWFsLEhlbHZldGljYSxzYW5zLXNlcmlmO2RvbWluYW50LWJhc2VsaW5lOmNlbnRyYWwiPjE5MHgxNDA8L3RleHQ+PC9zdmc+');
			var img = $("#"+tag).val();
			$.get("{{url('admin/'.request()->segment(2).'/remove_upload')}}", { image: "public/{{alias}}/"+img }, function (data) {
				$("#"+tag).val('');
				$('.image-wrap').css('background-image','url({{env_host}}/public/assets/img/370x250.jpg)');
				$('#button_'+tag).html('<span class="btn btn-default btn-file"><span class="fileinput-new">Tải lên</span><span class="fileinput-exists">Tải lên</span><input type="file" name="{{$ctrl->name}}" /> </span>');
			});
		});
	</script>
</div>
<style type="text/css">
.form-group label{
	font-weight: 600;
}
.btn-file{
	background: #ccc !important;
}
.btn-clear{
	background: rgb(245, 4, 4) !important;
    color: #fff !important;
	border: 0 !important;
}
    .thumbnail {
        width: 40%;
        height: 40%;

        margin: 0 auto;
        width: 100%;
        height: 250px;
        max-width: 500px;
        text-align: center;
    }
    .thumbnail img{
        width:100%;
    }
.thumbnail img.wide {
    max-width: 100%;
    max-height: 100%;
    height: auto;
}
.thumbnail img.tall {
    max-height: 100%;
    max-width: 100%;
    width: auto;
}​

.container {
	margin:0 auto;
	overflow:hidden;
	max-width:1200px;
	padding:0 10px;
}

.main-img .new{
	width: 205;
	height: 205;
	display: block;
	position: absolute;
	top: 0;
	left: 50%;
	margin-left: -100.025px;
	margin-top: -60px;
}
.main-img .wrap-main-img{
	position: relative;
	width: 900px;
	max-width: 90%;
	height: 600px;
	margin: 5px auto 0;
	-webkit-box-shadow: 0px -3px 19px 0px rgba(241,241,241,1);
	-moz-box-shadow: 0px -3px 19px 0px rgba(241,241,241,1);
	box-shadow: 0px -3px 19px 0px rgba(241,241,241,1);
}
.main-img .wrap-main-img a span,
.main-img .wrap-main-img a{
	display: block;
	width: 100%;
	height: 100%;
}
.main-img .wrap-main-img a span{
	-webkit-transition: all 2s ease-in-out;
	-moz-transition: all 2s ease-in-out;
	-o-transition: all 2s ease-in-out;
	transition: all 2s ease-in-out;
	background-size: 100%;
}
.main-img .wrap-main-img:hover a span{
	background-position: 50% 100%;
}
.txt-main-img{
	text-transform: uppercase;
	text-align: center;
	font-size: 14px;
	font-weight: 600;
	color: #56565b;
	padding-top: 50px;
	margin-bottom: 95px;
	letter-spacing: 1px;
}
.content {
	text-align:center;
	background: #ededed;
	padding-left: 3%;
	padding-right: 3%;
}

.preview-list {
	overflow:hidden;
	display:inline-block;
	padding: 0px;
}
.store-list,
.function-list {
	display: -webkit-flex;
	display: -moz-flex;
	display: -ms-flex;
	display: flex;
	-webkit-flex-flow: row wrap;
	-moz-flex-flow: row wrap;
	-ms-flex-flow: row wrap;
	flex-flow: row wrap;
	justify-content: center;
	-moz-justify-content: center;
	-ms-justify-content: center;
	-webkit-justify-content: center;
}

.preview-list li {
	display:inline-block;
	*display:inline;
	zoom: 1;
	margin: 0;
}

.preview-list li > div {
	margin: 0 auto;
}
.preview-list li > div  img{
	max-width: 100%;
}

.preview-list.store-list li.store{
	width:25%;
	float:none;
}

.preview-list.store-list li.store:hover img{
	-webkit-box-shadow: 0px 0px 5px 4px rgba(221,221,221,1);
	-moz-box-shadow: 0px 0px 5px 4px rgba(221,221,221,1);
	box-shadow: 0px 0px 5px 4px rgba(221,221,221,1);
}
.preview ul li >div p{
	font-size: 14px;
	text-transform: uppercase;
	letter-spacing: 1px;
}

footer p a,
footer p{
	color: #8c8a88;
	font-size: 12px;
	font-weight: 500;
}
footer p a{
	text-decoration: none;
}
footer p a:hover{
	color: #585654;
}
/*Header*/
header {
	position: fixed;
	left: 0;
	right: 0;
	text-align: center;
	background: transparent;
	z-index: 2;
}
.logo {
	text-align:center;
	margin-top: 40px;
}
.logo img {
	max-width: 100%;
}
.desc {
	text-align: center;
	font-size: 12px;
	color: #fff;
	font-weight: 500;
	letter-spacing: 1px;
	font-family: 'Montserrat', sans-serif;
	text-transform: uppercase;
	margin-top: 30px;
}
header.affix {
	display: none;
	opacity: 0;
	-ms-filter: "progid: DXImageTransform.Microsoft.Alpha(Opacity=0)";
	filter: alpha(opacity=0);
	transition: all ease 0.5s;
}
/*End Header*/




/*Content*/
#store-list {
	z-index: 2;
}
#store-list ul.store-list > li {
	width: 33.3%;
	padding-top: 300px;
}
#store-list ul.store-list li.left-block.block01{
	background-color: #d1af65;
	position: relative;
}
#store-list ul.store-list li.middle-block.block02 {
	background-color: #7b7b7b;
	position: relative;
}
#store-list ul.store-list li.right-block.block03 {
	background-color: #cb0000;
}
#store-list ul.store-list li.left-block.block04{
	background-color: #1e1e1e;
}
#store-list ul.store-list li.middle-block.block05 {
	background-color: #e58825;
}
#store-list ul.store-list li.right-block.block06 {
	background-color: #f33c6d;
}
#store-list ul.store-list li.left-block.block07 {
	background-color: #5e9a07;
}
#store-list ul.store-list li.middle-block.block08 {
	background-color: #5086bc;
	height: 789px;
}
#store-list ul.store-list li.right-block.block09 {
	background-color: #b200ff;
	height: 789px;
}

.new-label {
	position: absolute;
	right: 0;
	top: 0;
	margin-top: -2px;
	margin-right: -1px;
}
.store-desc span.hot-label {
	background: url(../images/bkg_hot.png) no-repeat center 5px;
	background-color: transparent;
	color: #fff;
	text-transform: uppercase;
	font-size: 9px;
	width: 25px;
	height: 25px;
	padding: 3px 7px;
	position: absolute;
	margin-top: -12px;
	margin-right: -33px;
}
#store-list ul.store-list .new-label {
	margin-top: calc(200px);
	margin-right: -2px;
}
#store-list ul.store-list > li.block04,
#store-list ul.store-list > li.block05,
#store-list ul.store-list > li.block06,
#store-list ul.store-list > li.block07,
#store-list ul.store-list > li.block08,
#store-list ul.store-list > li.block09 {
	padding-top: 120px;
	position: relative;
}
#store-list ul.store-list > li.block04 img,
#store-list ul.store-list > li.block05 img,
#store-list ul.store-list > li.block06 img,
#store-list ul.store-list > li > .img_new
{
	position: absolute;
	right: 0;
	top: 0;
	margin-top: -2px;
	margin-right: -2px;
}

.store-title {
	font-size: 24px;
	font-family: 'Montserrat', sans-serif;
	color: #fff;
	text-align: center;
	text-transform: uppercase;
	margin-bottom: 40px;
	margin-top: 40px;
    line-height:30px;
}
.store-desc .desc {
	color: #fff;
	text-align: center;
	margin-bottom: 10px;
    min-height:100px
}
.store-desc p:last-child {
	margin-bottom: 0;
}
.store-list a.view-demo{
	display: inline-block;
	font-size: 14px;
	color: #fff;
	text-transform: uppercase;
	text-decoration: none;
	border: 2px solid #fff;
	height: 45px;
	width: 200px;
	margin: 40px auto 120px;
	text-align: center;
	line-height: 43px;
	-webkit-transform: translateZ(0);
	transform: translateZ(0);
	position: relative;
	-webkit-transition-property: color;
	transition-property: color;
	-webkit-transition-duration: 0.3s;
	transition-duration: 0.3s;
}
.store-list a.view-demo:before {
    content: "";
    position: absolute;
    z-index: -1;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: #CCCCCC;
    -webkit-transform: scale(0);
    transform: scale(0);
    -webkit-transition-property: transform;
    transition-property: transform;
    -webkit-transition-duration: 0.3s;
    transition-duration: 0.3s;
    -webkit-transition-timing-function: ease-out;
    transition-timing-function: ease-out;
}
    .store-list a.view-demo:hover:before {
        -webkit-transform: scale(1);
        transform: scale(1);
    }
.store-list a.view-buy {
    display: inline-block;
    font-size: 14px;
    color: #fff;
    text-transform: uppercase;
    text-decoration: none;
    border: 2px solid #79B530;
    height: 45px;
    width: 40px;
    margin: 40px auto 120px;
    text-align: center;
    line-height: 43px;
    -webkit-transform: translateZ(0);
    transform: translateZ(0);
    position: relative;
    -webkit-transition-property: color;
    transition-property: color;
    -webkit-transition-duration: 0.3s;
    transition-duration: 0.3s;
    color: #79B530;
}
    .store-list a.view-buy:before {
        content: "";
        position: absolute;
        z-index: -1;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: #79B530;
        -webkit-transform: scale(0);
        transform: scale(0);
        -webkit-transition-property: transform;
        transition-property: transform;
        -webkit-transition-duration: 0.3s;
        transition-duration: 0.3s;
        -webkit-transition-timing-function: ease-out;
        transition-timing-function: ease-out;

    }

    .store-list a.view-buy:hover:before {
        -webkit-transform: scale(1);
        transform: scale(1);

    }
.preview-item {
	position: relative;
	width: 100%;
	text-align: center;
}
.preview-item  .mac-frame {
	background: url('{{env_host}}/public/dashboard/assets/img/mac_frame.png') 0 0 no-repeat;
	width: 100%;
	height: 250px;
	background-size: 100%;
}
.preview-item  .mac-frame a span.image-wrap {
	display: block;
    height: calc(100% - 65px); /* 197px;*/
	background-size: 100%;
	background-position: center 0%;
	width: 100%;
	margin-left: auto;
	margin-right: auto;
}
.preview-item  .mac-frame a {
  display: block;
  padding: 10px 50px;
  height: 100%;
}
.preview-item .mac-frame a:hover span.image-wrap{
	background-position: center 100%;
}
.move-long {
  -webkit-transition: all 3.5s ease-out;
  -moz-transition: all 3.5s ease-out;
  -ms-transition: all 3.5s ease-out;
  -o-transition: all 3.5s ease-out;
  transition: all 3.5s ease-out;
}
.preview-item .iphone-frame {
	background: url('{{env_host}}/public/dashboard/assets/img/iphone_frame.png') 0 0 no-repeat;
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
    background-repeat: no-repeat !important;
}
/*End Content*/




/*Footer*/
#function-list {
	background: #101010;
}
ul.function-list {
padding: 50px 100px 0;
}
ul.function-list > li {
	width: 20%;
	padding-bottom: 50px;
	list-style: none;
}
ul.function-list > li img {
	float: left;
}
ul.function-list > li div {
	display: table;
	table-layout: fixed;
	height: 60px;
}
ul.function-list > li  span {
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
	.preview-item .mac-frame a{padding:3% 12%;}
}
@media only screen and (min-width: 1024px) and (max-width: 1199px) {
	.preview-item {
		width: 340px;
	}
	.preview-item .mac-frame a span.image-wrap {
		height: 165px;
	}
}
@media (max-width: 1199px){
	.preview-list.store-list li.store{
		width:33%;
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
@media (max-width: 991px){
	.preview-list.store-list li.store{
		width:50%;
	}
	ul.function-list > li {
		width: 50%;
	}
}
@media (max-width: 767px){
	.preview-list.store-list li.store{
		width:100%;
	}
	#store-list ul.store-list > li {
		width: 100%;
	}
	.txt-main-img{
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
@media (max-width: 480px){
	ul.function-list > li {
		width: 100%;
	}
	ul.function-list {
		padding-left: 20px;
		padding-right: 20px;
	}
}
@media (max-width: 479px){
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
