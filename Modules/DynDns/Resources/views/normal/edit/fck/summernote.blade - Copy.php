<div class="form-group {{$ctrl->width}}">
    <label>{{ $ctrl->title}}</label>
    <div>

        <textarea ui-jp="summernotes" placeholder="" class="form-control summernote_{{ $ctrl->name.$lang}} {{$ctrl->name.$lang}}" dir="backLang.ltr" ui-options="{height: 300,callbacks: {
                                            onImageUpload: function(files, editor, welEditable) {sendFile{{$ctrl->name.$lang}}(files[0], editor, welEditable,1);}}}"
                  name="<?=$ctrl->name.$lang?>" id="<?=$ctrl->name.$lang?>" cols="50" rows="10"><?=@$row->{$ctrl->value.$lang}?></textarea>
        @push('script')
        <link rel="stylesheet" type="text/css" href="{{base}}/public/plugin/jquery/summernote/dist/summernote.css" />
        <script src="{{base}}/public/plugin/jquery/summernote/dist/summernote.js"></script>
        <script>
           // $( document ).ready(function() {
          $('#<?=$ctrl->name.$lang?>').summernote({
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

            function sendFile{{$ctrl->name.$lang}}(file, editor, welEditable,lang) {
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
                    $('.summernote_{{$ctrl->name.$lang}}').summernote("insertNode", image[0]);
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
</div>
