<?php
   switch(@$func->upload_type){
       case "cloud":
           $image_path = env('Static').'/'.@$path_base;
           break;
       default:
           $image_path = url(@$path_base).'/';
           break;
   }
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/basic.css" rel="stylesheet" />
<div class="clsbox-1" runat="server">
    <div class="dropzone clsbox" id="mydropzone">

    </div>
    <textarea name="{{@$ctrl->name}}" class="form-control row_photos item" style="display:none">{{@$row->{$ctrl->value} }}</textarea>
</div>
<div class="box-body">
    <div class="row">
            @if(@$row->{$ctrl->value}!='')
            @php
            $js_img = json_decode( @$row->{$ctrl->value} );
            @endphp
            @if(@$js_img)
            @foreach($js_img as $img)
            <div class="col-xs-6 col-sm-4 col-md-3">
                <div class="box p-a-xs">
                    <div class="pull-right">
                        <input class="pull-left form-control row_no has-value" id="row_no" style="margin:0;margin-bottom:5px" name="row_no_46" value="1" type="text">
                    </div>
                    <label class="ui-check m-a-0">
                        <input name="ids[]" value="46" class="has-value" type="checkbox"><i class="dark-white"></i>
                        <input class="form-control row_no has-value" name="row_ids[]" value="46" type="hidden">
                    </label>
                    <img src="{{$image_path.$img->image}}" alt="homepage_vi_tri" title="homepage_vi_tri" style="height: 150px" class="img-responsive">
                    <div class="p-a-sm">
                        <div class="text-ellipsis">
                            <button class="btn btn-sm warning pull-right dropzone_image_item_remove" data-toggle="modal" data-target="#mx-46" ui-toggle-class="bounce" ui-target="#animate" title="Xóa" style="padding: 0 5px 2px;">
                                <small><i class="material-icons"></i></small>
                            </button>
                            <a style="display: block;overflow: hidden;" href="{{$image_path.$img->image}}" target="_blank">
                                <input class='dropzone_image_item' type='hidden' name='caption' value="{{$img->image}}" />
                                <small>{{$img->image}}</small>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
            @endif
            <div class="col-xs-12 col-sm-12 col-md-12">
                <!-- .modal -->
                <!--<div id="mx-all" class="modal fade" data-backdrop="true">
                    <div class="modal-dialog" id="animate">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Xác nhận</h5>
                            </div>
                            <div class="modal-body text-center p-lg">
                                <p>
                                    Bạn có chắc là bạn muốn xóa?
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Không</button>
                                <button type="submit" class="btn danger p-x-md">Có</button>
                            </div>
                        </div>
                    </div>
                </div>-->
                <!-- / .modal -->

                <!--<label class="ui-check m-a-0">
                    <input id="checkAll" class="has-value" type="checkbox"><i></i> Chọn tất cả
                </label>-->

            </div>

    </div>
</div>
<script>
   // Dropzone.autoDiscover = false;
	$("#mydropzone").dropzone({
	    url: "{{url('admin/'.request()->segment(2).'/upload_file')}}",
	    params: {
	        _token: "{{csrf_token() }}"
	    },
		addRemoveLinks: true,
		maxFilesize: 0.5,
		dictDefaultMessage: '<span class="text-center"><span class="font-lg visible-xs-block visible-sm-block visible-lg-block"><span class="font-lg"><i class="fa fa-caret-right text-danger"></i> Kéo thả hình ảnh vào đây hoặc click để  <span class="font-xs">tải lên</span></span><span>&nbsp&nbsp<h4 class="display-inline"> (Or Click)</h4></span>',
		dictResponseError: 'Error uploading file!',
		success: function (file, response) {
                  caption = file.caption == undefined ? "" : file.caption;
                  file._captionBox = Dropzone.createElement("<input class='dropzone_image_item' type='hidden' name='caption' value="+response+" >");
                  file.previewElement.appendChild(file._captionBox);
                  update_dropzone_photos();
		},
		init: function () {
             this.on(
                "addedfile", function(file) {
                 // caption = file.caption == undefined ? "" : file.caption;
                 // file._captionBox = Dropzone.createElement("<input id='"+file.filename+"' type='text' name='caption' value="+caption+" >");
                 // file.previewElement.appendChild(file._captionBox);
            }),
            this.on("sending", function(file, xhr, formData){
                //formData.append('yourPostName',file._captionBox.value);
            })

		    this.on("complete", function (file) {

		    });
		    this.on("removedfile", function (file) {
                 update_dropzone_photos();
		    });
		}
	});
	$('.dropzone_image_item_remove').on('click', function () {
	    $(this).parent().parent().parent().remove();
	    update_dropzone_photos();
	});
    function update_dropzone_photos() {
        var list = [];
        $('.dropzone_image_item').each(function () {
            var image = $(this).val();
            var obj = {
                image: image
            };
            list.push(obj);
        });
        $('.row_photos').val(JSON.stringify(list));
    }
</script>

