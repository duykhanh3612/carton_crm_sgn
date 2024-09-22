
<div class="form-group {{  $ctrl->width}} desktop ">
    @php
    $s = json_decode(@$row->{$ctrl->value});
    @endphp
    <div class="p-a-md col-md-12">

        <div class="form-group">
            <label>
                <i class="fa fa-facebook"></i> &nbsp; Facebook
            </label>
            <input placeholder="Facebook" class="social form-control has-value" dir="ltr" name="facebook" value="{{@$s->facebook}}" type="text" />
        </div>
        <div class="form-group">
            <label>
                <i class="fa fa-messenger"></i>&nbsp; Messenger
            </label>
            <input placeholder="Messenger" class="social form-control has-value" dir="ltr" name="messenger" value="{{@$s->messenger}}" type="text" />
        </div>

        <div class="form-group">
            <label>
                <i class="fa fa-twitter"></i> &nbsp; Twitter
            </label>
            <input placeholder="Twitter" class="form-control" dir="ltr" name="twitter" value="{{@$s->twitter}}" type="text" />
        </div>

        <div class="form-group">
            <label>
                <i class="fa fa-linkedin"></i> &nbsp; Linkedin
            </label>
            <input placeholder="Linkedin" class="social form-control" dir="ltr" name="linkedin" value="{{@$s->linkedin}}" type="text" />
        </div>

        <div class="form-group">
            <label>
                <i class="fa fa-youtube-play"></i> &nbsp; Youtube
            </label>
            <input placeholder="Youtube" class="social form-control" dir="ltr" name="youtube" value="{{@$s->youtube}}" type="text" />
        </div>

        <div class="form-group">
            <label>
                <i class="fa fa-instagram"></i> &nbsp; Instagram
            </label>
            <input placeholder="Instagram" class="social form-control" dir="ltr" name="instagram" value="{{@$s->instagram}}" type="text" />
        </div>

        <div class="form-group">
            <label>
                <i class="fa fa-pinterest"></i> &nbsp; Pinterest
            </label>
            <input placeholder="Pinterest" class="social form-control" dir="ltr" name="pinterest" value="{{@$s->pintersest}}" type="text" />
        </div>

        <div class="form-group">
            <label>
                <i class="fa fa-tumblr"></i> &nbsp; Tumblr
            </label>
            <input placeholder="Tumblr" class="social form-control" dir="ltr" name="tumblr" value="{{@$s->tumblr}}" type="text" />
        </div>

        <div class="form-group">
            <label>
                <i class="fa fa-flickr"></i> &nbsp; Flickr
            </label>
            <input placeholder="Flickr" class="social form-control" dir="ltr" name="flickr" value="{{@$s->flickr}}" type="text" />
        </div>

        <div class="form-group">
            <label>
                <i class="fa fa-whatsapp"></i> &nbsp; Whatsapp
            </label>
            <input placeholder="Whatsapp" class="social form-control" dir="ltr" name="whatsapp" value="{{@$s->whatsapp}}" type="text" />
        </div>
        <div class="form-group">
            <label>
                <i class="fa fa-whatsapp"></i> &nbsp; Tiktok
            </label>
            <input placeholder="Tiktok" class="social form-control" dir="ltr" name="tiktok" value="{{@$s->tiktok}}" type="text" />
        </div>
        <div class="form-group">
            <label>
                <i class="fa fa-zalo"></i> &nbsp; Zalo
            </label>
            <input placeholder="Zalo" class="social form-control has-value" dir="ltr" name="zalo" value="{{@$s->zalo}}" type="text" />
        </div>
        <div class="form-group">
            <label>
                <i class="fa fa-viber"></i> &nbsp; Viber
            </label>
            <input placeholder="Zalo" class="social form-control has-value" dir="ltr" name="viber" value="{{@$s->viber}}" type="text" />
        </div>
        <div class="form-group">
            <label>
                Meta tag
            </label>
            <textarea name="meta_tag" class="form-control has-value">{{@$s->meta_tag}}</textarea>
        </div>
        <div class="form-group">
            <label>
                Robots
            </label>
            <textarea id="robot" class="form-control has-value" style="height: 200px"><?php
                try{
                    $myfile = fopen(base_path("robots.txt"), "r");
                    echo fread($myfile,filesize(base_path("robots.txt")));
                    fclose($myfile);
                }
                catch(\Throwable $e){

                }
                ?> </textarea>
            <label class="btn btn-primary" id="btn-update-robot" style="margin-top: 5px">Update</label>
            <script>
                $("#btn-update-robot").click(function(){
                    var form_data = new FormData();
                    form_data.append("content", $("#robot").val());
                    form_data.append("_token", '{{ csrf_token() }}');
                    $.ajax({
                        url: "{{url('admin/update-robot')}}",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        type: 'POST',
                        success: function (data) {
                            var image = data;
                            $(input_file).parent().find('.row_icon').val(image);
                            update_galler_content();
                        }
                    });

                });
            </script>
        </div>
        <div class="form-group">
            <label>
                Sitemap
            </label>
            <textarea id="sitemap" class="form-control has-value" style="height: 200px"><?php
                try{
                    $myfile = fopen(base_path("sitemap.xml"), "r");
                    echo fread($myfile,filesize(base_path("sitemap.xml")));
                    fclose($myfile);
                }
                catch(\Throwable $e){

                }
                ?> </textarea>
            <label class="btn btn-primary" id="btn-update-sitemap"  style="margin-top: 5px">Update</label>
            <script>
                $("#btn-update-sitemap").click(function(){
                    var form_data = new FormData();
                    form_data.append("content", $("#sitemap").val());
                    form_data.append("_token", '{{ csrf_token() }}');
                    $.ajax({
                        url: "{{url('admin/update-sitemap')}}",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        type: 'POST',
                        success: function (data) {
                            var image = data;
                            $(input_file).parent().find('.row_icon').val(image);
                            update_galler_content();
                        }
                    });

                });
            </script>
        </div>
        <textarea name="{{$ctrl->name}}" id="{{$ctrl->name}}" style="display:nones">{!!@$row->{$ctrl->value} !!}</textarea>

    </div>
    <style type="text/css">
        .size-16{
            height:16px;
            width:16px;
        }
        .fa-zalo{
            background: url(https://i.pinimg.com/originals/60/6f/e3/606fe39….jpg);
            width: 16px;
            height: 16px;
            background-size: 100% 100%;
        }
    </style>
    <script type="text/javascript">
        $(document).on('keyup', '.social', function () {
            var hash = {};
            $('.social').each(function () {
                var name = $(this).attr('name');
                var value = $(this).val();
                hash[name] = value
            });
            $('#{{$ctrl->name}}').val(JSON.stringify(hash));
    });



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

        $('#{{$ctrl->name}}').val(JSON.stringify(list));
    }

    </script>
</div>
