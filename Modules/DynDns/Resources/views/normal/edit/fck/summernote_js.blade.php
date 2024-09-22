@push('script')
<link rel="stylesheet" type="text/css" href="{{url('')}}/public/plugin/editor/summernote/summernote-0.8.18-dist/summernote.css" />
<script src="{{url('')}}/public/plugin/editor/summernote/summernote-0.8.18-dist/summernote.js"></script>

<style type="text/css">
            .note-toolbar {
                border-top: 1px solid #808080;
                border-left: 1px solid #808080;
                border-right: 1px solid #808080;
            }
            .note-editable {
                border-bottom: 1px solid #808080;
                border-left: 1px solid #808080;
                border-right: 1px solid #808080;
            }
                        .note-editor.note-frame.fullscreen {
                position: fixed;
                top: 0px;
                left: 0px;
                z-index: 2147483647;
                width: 100% !important;
                background: #fff!important;
            }
</style>
<script>


    $('.summernote').each(function () {
        $(this).summernote({
            // toolbar: [
            //     ['style', ['bold', 'italic', 'underline']],
            //     ['fontsize', ['fontsize']], ['color', ['color']],
            //      ['para', ['ul', 'ol', 'paragraph']]
            // ],
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['fontsize', ['fontsize']],['color', ['color']],

                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            height: 300,
            callbacks: {
                onImageUpload: function (files) {
                    url = "{{url('admin/'.request()->segment(2).'/upload_image')}}"; //path is defined as data attribute for  textarea
                   // sendFile(files[0], url, $(this));
                    sendFile_compoment(files[0], $(this));
                }
            }
        });
    });

    function sendFile(file, url, editor) {
        var data = new FormData();
        data.append("file", file);
        var request = new XMLHttpRequest();
        request.open('POST', url, true);
        request.onload = function () {
            if (request.status >= 200 && request.status < 400) {
                // Success!
                var resp = request.responseText;
                editor.summernote('insertImage', resp);
                console.log(resp);
            } else {
                // We reached our target server, but it returned an error
                var resp = request.responseText;
                console.log(resp);
            }
        };
        request.onerror = function (jqXHR, textStatus, errorThrown) {
            // There was a connection error of some sort
            console.log(jqXHR);
        };
        request.send(data);
    }
    function sendFile_compoment (file, editor) {

        data = new FormData();
        data.append("file", file);
        data.append("id", $('#id').val());
        data.append("_token", "{{ csrf_token() }}");
        $.ajax({
            data: data,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            xhr: function () {
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) myXhr.upload.addEventListener('progress', progressHandlingFunction, false);
                return myXhr;
            },
            url: "{{url('admin/'.request()->segment(2).'/upload_image')}}",
            cache: false,
            contentType: false,
            processData: false,
            success: function (url) {
                var data = JSON.parse(url);
                var image = $('<img>').attr('src', "{{$image_path}}/" + data.file);
                editor.summernote("insertNode", image[0]);
                //editor.insertImage(welEditable, image[0]);
            }
        });
    }

    function progressHandlingFunction(e) {
        if (e.lengthComputable) {
            $('progress').attr({ value: e.loaded, max: e.total });
            if (e.loaded == e.total) {
                $('progress').attr('value', '0.0');
            }
        }
    }
</script>
@endpush
