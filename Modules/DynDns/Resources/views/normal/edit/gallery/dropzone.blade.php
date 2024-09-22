<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/basic.css" rel="stylesheet" />
<div class="clsbox-1" runat="server">
    <div class="dropzone clsbox" id="mydropzone">

    </div>
    <textarea class="form-control row_photos item"></textarea>
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
		dictDefaultMessage: '<span class="text-center"><span class="font-lg visible-xs-block visible-sm-block visible-lg-block"><span class="font-lg"><i class="fa fa-caret-right text-danger"></i> Drop files <span class="font-xs">to upload</span></span><span>&nbsp&nbsp<h4 class="display-inline"> (Or Click)</h4></span>',
		dictResponseError: 'Error uploading file!',
		success: function (file, response) {
                  caption = file.caption == undefined ? "" : file.caption;
                  file._captionBox = Dropzone.createElement("<input class='dropzone_image_item' type='text' name='caption' value="+response+" >");
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

