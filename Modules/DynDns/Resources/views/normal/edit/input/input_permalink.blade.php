@php
    $reference_id = @$row->{$func->field_id};
    $reference_type = str_replace(array(_pre,"sys_"),array('',''), $func->table);//$func->phpfile;
    $slug = md::find("sys_slugs","reference_id='$reference_id' and reference_type='$reference_type'");
@endphp
<div class="form-group {{$ctrl->width}}">
    <span style="color:#ff0000;margin-bottom:1rem;display:block;" id="message_slug"></span>
    @if(@$slug)
    <div id="edit-slug-box">
        <label class="control-label required" for="current-slug" aria-required="true">Permalink:</label>
        <span id="sample-permalink">
            <a class="permalink" target="_blank" href="{{url('')}}/{{@$slug->key}}">
                <span class="default-slug">{{url('')}}/<span id="editable-post-name">{{@$slug->key}}</span></span>
            </a>
        </span>
       <span id="edit-slug-buttons">
            <button type="button" class="btn btn-secondary" id="permalink_change_slug">Edit</button>
            <button type="button" class="btn btn-info" id="permalink_update_slug">Update</button>
            <button type="button" class="save btn btn-secondary" id="btn-ok">OK</button>
            <button type="button" class="cancel btn btn-warning button-link" id="permalink_cancel">Cancel</button>
            <button type="button" class="btn btn-secondary view-page" id="btn-view-page">View</button>

        </span>
    </div>
    <input type="hidden" id="current-slug" name="slug" value="lien-he">
    <div data-url="{{url('')}}/ajax/slug/create" data-view="http://ptf.dyndns.top/" data-id="135"></div>
    <input type="hidden" id="slug_id" name="slug_id" value="{{@$slug->id}}" />
    <input type="hidden" id="reference_id" name="reference_id" value="{{@$reference_id}}" />
    <input type="hidden" id="reference_type" name="reference_type" value="{{@$reference_type}}" />
    <script>
        $('#btn-ok').hide();
        $('#permalink_cancel').hide();

        $('#permalink_change_slug').click(function () {
            $('#btn-ok').show();
            $('#permalink_cancel').show();
            $('#permalink_change_slug').hide();
            $('#permalink_update_slug').hide();
            let value = $('#editable-post-name').text();
            $('#sample-permalink').html("<span class='default-slug'>{{url('')}}/<input value='" + value + "' data-value='"+value+"' id='editable-post-value' /></span>")
        });

        $('#permalink_update_slug').click(function () {
            let value = $('#{{$ctrl->att_table.$lang}}').val();
            var form_data = new FormData();
            form_data.append("key", value);
            form_data.append("id", $('#slug_id').val());
            form_data.append("reference_id", $('#reference_id').val());
            form_data.append("reference_type", $('#reference_type').val());
            form_data.append("key_title", "true");
            form_data.append("_token", '{{ csrf_token() }}');

            $.ajax({
                url: "{{url('admin/ajax/update_permalink')}}",
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'POST',
                success: function (data) {
                    $('#slug_id').val(data.id);
                    $('#reference_id').val(data.reference_id);
                    $('#reference_type').val(data.reference_type);
                    $('#sample-permalink').html('<a class="permalink" target="_blank" href="{{url('')}}/' + data.key + '"><span class= "default-slug" >{{url('')}}/<span id="editable-post-name">' + data.key+'</span></span></a>');

                }
            });
        });

        $('#permalink_cancel').click(function () {
            $('#btn-ok').hide();
            $('#permalink_cancel').hide();
            $('#permalink_change_slug').show();
            let value = $('#editable-post-value').data('value');
            $('#sample-permalink').html('<a class="permalink" target="_blank" href="{{url('')}}/' + value +'"><span class= "default-slug" >{{url('')}}/<span id="editable-post-name">'+value+'</span></span></a>');
        });


        $('#btn-ok').click(function () {
            $('#btn-ok').hide();
            $('#permalink_cancel').hide();
            $('#permalink_change_slug').show();
            $('#permalink_update_slug').show();
            let value = $('#editable-post-value').val();

            var form_data = new FormData();
            form_data.append("key", value);
            form_data.append("id", $('#slug_id').val());
            form_data.append("reference_id", $('#reference_id').val());
            form_data.append("reference_type", $('#reference_type').val());
            form_data.append("_token", '{{ csrf_token() }}');

            $.ajax({
                url: "{{url('admin/ajax/update_permalink')}}",
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'POST',
                success: function (data) {
                    $('#slug_id').val(data.id);
                    $('#reference_id').val(data.reference_id);
                    $('#reference_type').val(data.reference_type);
                    $('#sample-permalink').html('<a class="permalink" target="_blank" href="{{url('')}}/' + data.key + '"><span class= "default-slug" >{{url('')}}/<span id="editable-post-name">' + data.key+'</span></span></a>');

                }
            });
        });
          $('#{{$ctrl->att_table.$lang}}').on('change', function () {
              $('#message_slug').html("Title đã thay đổi, bạn nên update lại premalink. Nhấn Update để cập nhập lại premalink.");
          });

        $('#btn-view-page').click(function(){
            $('#view_page').modal("show");
        });
    </script>

    @else
     <div id="edit-slug-box">
        <label class="control-label required" for="current-slug" aria-required="true">Permalink:</label>
        <input type="text" id="permalink" name="permalink" value="" />
        <span id="edit-slug-buttons">
            <button type="button" class="btn btn-secondary" id="permalink_create_slug">Create</button>
        </span>
    </div>
    <script>
        $('#{{$ctrl->att_table.$lang}}').on('change', function () {
               $.get("{{ url(request()->segment(1).'/'.request()->segment(2).'/slug_alias') }}",{'title':$(this).val(),'lang':'<?=$lang?>','id':$("#id").val()},function(msg){
                   $('#permalink').val(msg);
               });

        });

        if ($('#{{$ctrl->att_table.$lang}}').val() != "") {
            $.get("{{ url(request()->segment(1).'/'.request()->segment(2).'/slug_alias') }}",{'title':$('#{{$ctrl->att_table.$lang}}').val(),'lang':'<?=$lang?>','id':$("#id").val()},function(msg){
                $('#permalink').val(msg);
            });
        }

        $("#permalink_create_slug").click(function(){
            let value = $('#{{$ctrl->att_table.$lang}}').val();
            $.get("{{ url(request()->segment(1).'/'.request()->segment(2).'/slug_alias') }}",{'title':value,'lang':'<?=$lang?>','id':$("#id").val()},function(msg){
                   $('#permalink').val(msg);
            });
        });
    </script>
    @endif
    @push("script")
    <style type="text/css">
    #permalink{
        height: 38px;
        border: 1px #ccc solid;
    }
    </style>
    {{-- <script type="application/javascript">

        function resizeIFrameToFitContent( iFrame ) {

            iFrame.width  = iFrame.contentWindow.document.body.scrollWidth;
            iFrame.height = iFrame.contentWindow.document.body.scrollHeight;
        }

        window.addEventListener('DOMContentLoaded', function(e) {

            var iFrame = document.getElementById( 'view_page' );
            resizeIFrameToFitContent( iFrame );

            // or, to resize all iframes:
            var iframes = document.querySelectorAll("iframe");
            for( var i = 0; i < iframes.length; i++) {
                resizeIFrameToFitContent( iframes[i] );
            }
        } );

    </script> --}}
    <div class="modal" tabindex="-1" role="dialog" id="view_page" style="z-index: 9999">
        <div class="modal-dialog" role="document" style="width: 100%;max-width:100%;    height: 100%;margin:0px">
          <div class="modal-content" style="height: 100%;border:0px;">
            <div class="modal-header">
              <h5 class="modal-title">{{@$row->name??"Frontend"}}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" style="padding: 0px">
                <iframe src="{{url('')}}/{{@$slug->key}}" style="width: 100%;height:100%;border:0"></iframe>
            </div>
          </div>
        </div>
      </div>
    @endpush

 </div>
