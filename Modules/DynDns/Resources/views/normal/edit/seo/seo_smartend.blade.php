<div class="box-body">
    @php
    $seo = @array_first(json_decode(@$row->seo));
    $seo_url_slug = $ctrl->att_field==''?'seo_url_slug'.($ctrl->language==1?@$lang:''):$ctrl->att_field.(@$ctrl->language==1?@$lang:'');
    $ser_title = $ctrl->att_key==''?'title'.(@$ctrl->language==1?@$lang:''):$ctrl->att_key.(@$ctrl->language==1?@$lang:'');
    $ser_description = $ctrl->att_level==''?'caption'.(@$ctrl->language==1?@$lang:''):$ctrl->att_level.(@$ctrl->language==1?@$lang:'');
    @endphp
        <div class="row">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">

            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <div>
                        <span id="config_seo" class="btn btn-primary m-t">Thiết lập SEO<span>
                    </div>
                </div>
                <div class="form-group">
                    <div>
                        <small>Tiêu đề trang</small>
                        <input class="form-control has-value seo seo_title " id="seo_title_en" maxlength="65" dir="ltr" name="seo_title_en" value="{{@$seo->title}}" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <div>
                        <small>Friendly URL</small>
                        <input class="form-control has-value" id="seo_url_slug_en" dir="ltr" name="{{$seo_url_slug}}" value="{{{@$row->$seo_url_slug}}}" type="text" />
                        <small class="formNote">Quy tắc: không dấu, không ký tự đặc biệt, không khoảng trắng, khoảng trắng được thay thế bằng dấu gạch ngang (-)</small>
                    </div>
                </div>

                <div class="form-group">
                    <div>
                        <small>Meta Description</small>
                        <textarea class="form-control has-value seo seo_description" id="seo_description_en" maxlength="165" dir="ltr" rows="2" name="seo_description_en" cols="50">{!! @$seo->description !!}</textarea>
                        <input readonly="readonly" style="width:35px; margin-top:10px; text-align:center;" id="des_vn_char" value="" type="text">
                        <small>ký tự (Tốt nhất là 155 ký tự)</small>
                    </div>
                </div>
                <div class="form-group">
                    <div>
                        <small>Meta Keywords</small>
                        <textarea class="form-control has-value seo seo_keywords" id="seo_keywords_en" dir="ltr" rows="2" name="seo_keywords_en" cols="50">{!!@$seo->keywords !!}</textarea>
                        <input readonly="readonly" style="width:35px; margin-top:10px; text-align:center;" id="key_vn_char" value="" type="text">
                        <small>ký tự (Tốt nhất là 155 ký tự)</small>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <div>
                        &nbsp;
                        <div class="search-example" dir="ltr">
                            <a id="title_in_engines_en" href="{{url($_SERVER['REQUEST_URI'])}}" target="_blank">{{@$seo->title}}</a>
                            <span id="url_in_engines_en">{{url('').'/'.@$row->seo_url_slug_en}}</span>
                            <div id="desc_in_engines_en">{{@$seo->description}}</div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div>
                        <i class="material-icons"></i>
                        <!--<small>Mange your page title, meta description, keywords and unique friendly URL. This help you to manage how this topic shows up on search engines.</small>-->
                        <small>Quản lý tiêu đề trang của bạn, mô tả meta, từ khóa và URL thân thiện duy nhất. Điều này giúp bạn quản lý cách chủ đề này hiển thị trên các công cụ tìm kiếm.</small>
                    </div>
                </div>
                <textarea name="{{@$ctrl->name}}" id="{{@$ctrl->name}}" style="display:none">{!!@$row->{$ctrl->value} !!}</textarea>
                <br>
                <br>
            </div>
        </div>



    <script type="text/javascript">
    $(document).on('click', '#config_seo', function () {
        $('#title_in_engines_en').html($('#{{$ser_title}}').val());
        $('#url_in_engines_en').html("{{url('')}}" + "/" + ChangeToSlug($('#{{$ser_title}}').val()));
        $('#desc_in_engines_en').html(stripHtml($('.{{$ser_description}}').val()));

        $('#seo_url_slug_en').val(ChangeToSlug($('#{{$ser_title}}').val()));
        $('#seo_title_en').val($('#{{$ser_title}}').val())
        $('#seo_description_en').val(stripHtml($('.{{$ser_description}}').val()))

        var seo_keywords = stripHtml($('#{{$ser_title}}').val()) + ' , ' + ChangeToSlugVn($('#{{$ser_title}}').val());
        $('#seo_keywords_en').val(seo_keywords);
        getJsonSeo();
    });

    $(document).on('change', '.seo', function () {
        getJsonSeo();
    });

    $('#seo_description_en').on('change',function(){
        var str = $('#seo_description_en').val();
        $('#des_vn_char').val(str.length);
    })
    $('#seo_keywords_en').on('change',function(){
        var str = $('#seo_keywords_en').val();
        $('#key_vn_char').val(str.length);
    })
    var str = $('#seo_description_en').val();
    $('#des_vn_char').val(str.length);

    var str_keywords = $('#seo_keywords_en').val();
    $('#key_vn_char').val(str_keywords.length);


    function getJsonSeo() {
        // $('.seo').on('change', function () {
        var list = [];
        var title = $('.seo_title').val();
        var description = $('.seo_description').val();
        var keywords = $('.seo_keywords').val();

        var obj = {
            title: title,
            description: description,
            keywords: keywords
        };
        list.push(obj);

        $('#seo').val(JSON.stringify(list));
    }
    function stripHtml(html){
        // Create a new div element
        var temporalDivElement = document.createElement("div");
        // Set the HTML content with the providen
        temporalDivElement.innerHTML = html;
        // Retrieve the text property of the element (cross-browser support)
        return temporalDivElement.textContent || temporalDivElement.innerText || "";
    }
    function ChangeToSlug(title){
            var  slug;

            //Lấy text từ thẻ input title
           // title = document.getElementById("title").value;

        //Đổi chữ hoa thành chữ thường

            slug = title.toLowerCase();


            //Đổi ký tự có dấu thành không dấu
            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
            slug = slug.replace(/đ/gi, 'd');
            //Xóa các ký tự đặt biệt
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
            //Đổi khoảng trắng thành ký tự gạch ngang
            slug = slug.replace(/ /gi, " - ");
            //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
            //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
            slug = slug.replace(/\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-/gi, '-');
            slug = slug.replace(/\-\-/gi, '-');
            //Xóa các ký tự gạch ngang ở đầu và cuối
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\-|\-\@|\@/gi, '');
            //In slug ra textbox có id “slug”
           return slug;
    }
    function ChangeToSlugVn(title) {
        var slug;

        //Lấy text từ thẻ input title
        // title = document.getElementById("title").value;

        //Đổi chữ hoa thành chữ thường

        slug = title.toLowerCase();


        //Đổi ký tự có dấu thành không dấu
        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');
        //Xóa các ký tự đặt biệt
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        //Đổi khoảng trắng thành ký tự gạch ngang
        //slug = slug.replace(/ /gi, " - ");
        //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
        //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
        //slug = slug.replace(/\-\-\-\-\-/gi, '-');
        // slug = slug.replace(/\-\-\-\-/gi, '-');
        //slug = slug.replace(/\-\-\-/gi, '-');
        //slug = slug.replace(/\-\-/gi, '-');
        //Xóa các ký tự gạch ngang ở đầu và cuối
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
        //In slug ra textbox có id “slug”
        return slug;
    }
    </script>
</div>