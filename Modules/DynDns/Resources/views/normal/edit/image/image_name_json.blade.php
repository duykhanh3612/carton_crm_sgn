<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/basic.css" rel="stylesheet" />-->
<div class="clsbox-1" runat="server">
    <div class="dropzone clsbox" id="mydropzone">

    </div>
    <textarea name="{{@$ctrl->name}}" class="form-control row_photos item" style="display:nones">{{@$row->{$ctrl->value} }}</textarea>
    <input type="text" id="<?=@$ctrl->att_where?>" name="<?=@$ctrl->att_where?>" value="{{@$row->{@$ctrl->att_where} }}" />

</div>
<div class="box-body">
    <div class="row">
            @php
            $image_path = $ctrl->att_table;
            @endphp
            @if(@$row->{$ctrl->value}!='')
            @php
            $js_img = json_decode( @$row->{$ctrl->value} );
            @endphp
            @if(@$js_img)
            @foreach($js_img as $img)
            <div class="col-xs-2 col-sm-32 col-md-3">
                <div class="box p-a-xs">

                    <label class="ui-check m-a-0" >
                        <input name="ids[]" value="46" class="has-value" type="checkbox"><i class="dark-white"></i>
                        <input class="form-control row_no has-value" name="row_ids[]" value="46" type="hidden">

                      
                        
                    </label>
                    <label style="float:right">
                        @if(@$row->{@$ctrl->att_where} == $img)
                        <span>Ảnh đại diện</span>
                        @else
                        <a style="cursor:pointer" data-img="{{$img}}" class="chose_image">
                            <i class="fa fa-check" title="Chọn làm ảnh đại diện"></i>
                        </a>
                        @endif


                    </label>
                    <img src="{{    $image_path.$img}}" alt="homepage_vi_tri" title="homepage_vi_tri" style="height: 150px" class="img-responsive">
                    <div class="p-a-sm">
                        <div class="text-ellipsis">
                            <button class="btn btn-sm warning pull-right dropzone_image_item_remove" data-toggle="modal" data-target="#mx-46" ui-toggle-class="bounce" ui-target="#animate" title="Xóa" style="padding: 0 5px 2px;">
                                <small><i class="fa fa-minus"></i></small>
                            </button>
                            <a style="display: block;overflow: hidden;" href="{{$image_path.$img}}" target="_blank">
                                <input class='dropzone_image_item' type='hidden' name='caption' value="{{$img}}" />
                                <small>{{$img}}</small>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
            @endif


    </div>
</div>
<script>
    // Dropzone.autoDiscover = false;
    $('.chose_image').click(function () {
        var image = $(this).attr('data-img');
        $('#{{$ctrl->att_where}}').val(image);

    });

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

