<div id="m-summernote" class="modal fade" data-backdrop="true">
    <div class="modal-dialog" id="animate" style="width:80% !important">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editor</h5>
            </div>
            <div class="modal-body text-center p-lg">
                <!--                            <input placeholder="content" ui-jp="summernote" dir="backLang.ltr" ui-options="{height: 300,callbacks: {
                                                            onImageUpload: function(files, editor, welEditable) {
                                                            sendFile(files[0], editor, welEditable,1);}}}"
                                                class="form-control summernote_en  has-value section_content item" required="" name="name" value="" type="text" />
                -->
                <textarea id="group_gallery_fck" ui-jp="summernotes" placeholder="" class="section_content item  form-control summernote_{{ $ctrl->name.$lang}} {{$ctrl->name.$lang}}" dir="backLang.ltr" ui-options="{height: 300,callbacks: {
                                            onImageUpload: function(files, editor, welEditable) {sendFilegroup_gallery_fck(files[0], editor, welEditable,1);}}}"
                          cols="50" rows="10"></textarea>
                @push('script')
                <link rel="stylesheet" type="text/css" href="../../plugin/jquery/summernote/dist/summernote.css" />
                <script src="../../plugin/jquery/summernote/dist/summernote.js"></script>
                <script>
           // $( document ).ready(function() {
          $('#group_gallery_fck').summernote({
                  toolbar: [
                    ['style', ['style']],
                    ['fontsize', ['fontsize']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['insert', ['picture', 'hr']],
                    ['table', ['table']],
                    ['color', ['color']],
                    ['insert', ['link', 'picture', 'hr']],
                    ['view', ['fullscreen', 'codeview']],
                    ['help', ['help']]
                  ],
                  height: 300,
                  focus: false
                });
           // });

            function sendFilegroup_gallery_fck(file, editor, welEditable,lang) {
            data = new FormData();
            data.append("file", file);
            data.append("_token", "{{ csrf_token() }}");
            $.ajax({
                data: data,
                type: 'POST',
                //headers: {
                //    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                //},
                xhr: function() {
                    var myXhr = $.ajaxSettings.xhr();
                    if (myXhr.upload) myXhr.upload.addEventListener('progress',progressHandlingFunction, false);
                    return myXhr;
                },
                url: "{{url('admin/'.request()->segment(2).'/upload_image')}}",
                cache: false,
                contentType: false,
                processData: false,
                success: function(url) {
                    var image = JSON.parse(url);
                    var image = $('<img>').attr('src', "{{$base}}"+  image.file);
                   // if(lang==1) {
                    $('.summernote_{{            $ctrl->name.$lang}}').summernote("insertNode", image[0]);
                    //}else{
                    //    $('.summernote_ar').summernote("insertNode", image[0]);
                    //}
                }
            });
        }

        function progressHandlingFunction(e){
            if(e.lengthComputable){
                $('progress').attr({value:e.loaded, max:e.total});
                // reset progress on complete
                if (e.loaded == e.total) {
                    $('progress').attr('value','0.0');
                }
            }
        }
                </script>
                @endpush

            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Close</button>-->
                <a class="btn-yes btn danger p-x-md " id="btn-close-pop">Có</a>
            </div>
        </div><!-- /.modal-content -->
    </div>
</div>