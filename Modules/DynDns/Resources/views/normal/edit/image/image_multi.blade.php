
<div class="form-group {{@$ctrl->width}}">
    <label class="control-label col-md-11 col-sm-11 col-xs-12">
        <?=$ctrl->title?> &nbsp;


        <i class="icon fa fa-plus" aria-hidden="true" style="color:chartreuse;font-size:23px;cursor:pointer;"></i>
        <input type="file" id="sortpicture" class="add-file-upload" style="display:none;" />

    </label>


    <div class="fileinput fileinput-new" data-provides="fileinput">
        <div style="width: 100%" id="thumb-image">
            @if(@$row->{$ctrl->value}!='')
            @php
               $js_img = json_decode( $row->{$ctrl->value} );
            @endphp
            @if(@$js_img)
            @foreach($js_img as $img)
            <div style="height:150px;width:150px;float:left;vertical-align:middle;position:relative;vertical-align:middle;display:table-cell;">
                <div style="position:absolute;top:5px;right:10px;">
                    <span class="icon fa fa-remove remove_image" style="color:red;font-size:18px;cursor:pointer;"></span>
                </div>
                <img src="{{@$image_path.$img}}" alt="" style="max-height:115px;height:auto;padding:5px;width:100%;" />
                <input type="hidden" class="tmp_image" value="{{$img}}" />
            </div>
            @endforeach
             @endif
         @else
            <img data src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxOTAiIGhlaWdodD0iMTQwIj48cmVjdCB3aWR0aD0iMTkwIiBoZWlnaHQ9IjE0MCIgZmlsbD0iI2VlZSIvPjx0ZXh0IHRleHQtYW5jaG9yPSJtaWRkbGUiIHg9Ijk1IiB5PSI3MCIgc3R5bGU9ImZpbGw6I2FhYTtmb250LXdlaWdodDpib2xkO2ZvbnQtc2l6ZToxMnB4O2ZvbnQtZmFtaWx5OkFyaWFsLEhlbHZldGljYSxzYW5zLXNlcmlmO2RvbWluYW50LWJhc2VsaW5lOmNlbnRyYWwiPjE5MHgxNDA8L3RleHQ+PC9zdmc+"
                alt="..." />
            @endif


        </div>
        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
        <div>
            <span class="btn btn-default btn-file">
                <span class="fileinput-new">Tải lên (Chọn nhiều hình)</span>
                <span class="fileinput-exists">Tải lên</span>
                <input type="file" name="{{$ctrl->name}}[]" multiple />
            </span>
            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Xóa</a>
        </div>


        <textarea name="{{$ctrl->name}}" class="image_content form-control" style="display:none;">{{ @$row->{$ctrl->value} }} </textarea>
        <link rel="stylesheet" href="{{base}}/public/plugin/dashboard/adminui/assets/css/jasny-bootstrap.min.css" />
        <script type="text/javascript" src="{{base}}/public/plugin/dashboard/adminui/assets/js/vendor/jasny-bootstrap.min.js" charset="UTF-8"></script>

        <script>
            $(".remove_image").on('click', function () {
                var img = $(this).parent().parent().find(".tmp_image").val();

                $.get("{{url('admin/'.request()->segment(2).'/remove_upload')}}", { image: "{{$path_base}}/" + img }, function (data) {
                    var list = [];
                    $('.tmp_image').each(function () {
                        list.push($(this).val());
                    });

                    $('.image_content').val(JSON.stringify(list));
                });

                $(this).parent().parent().remove();

            });
            $(".add-file-upload").on('change', function () {
                var file_data = $("#sortpicture").prop("files")[0];
                var form_data = new FormData();
                form_data.append("file", file_data);
                form_data.append("_token", '{{ csrf_token() }}');

                $.ajax({
                    url: "{{url('admin/'.request()->segment(2).'/upload_file')}}",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    type: 'POST',
                    success: function (data) {
                        var image = data;
                        var div = '<div style="height:150px;width:150px;float:left;vertical-align:middle;position:relative;vertical-align:middle;display:table-cell;">' +
                            '<div style="position:absolute;top:5px;right:10px;">' +
                            ' <span class="icon fa fa-remove remove_image" style="color:red;font-size:18px;cursor:pointer;"></span>' +
                            ' </div>' +
                            '<img src="{{url('public/'.h::website)}}'+"/"+image+'" alt = "" style = "max-height:115px;height:auto;padding:5px;width:100%;" /> '+
                        ' <input type="hidden" class="tmp_image" value="' + image + '" />' +
                            ' </div>  ';

                        $("#thumb-image").append(div);
                        var list = [];
                        $('.tmp_image').each(function () {
                            list.push($(this).val());
                        });

                        $('.image_content').val(JSON.stringify(list));

                    }
                });

            });
        </script>
    </div>
</div>
