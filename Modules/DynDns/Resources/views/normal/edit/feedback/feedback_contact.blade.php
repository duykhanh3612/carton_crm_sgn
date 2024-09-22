<div class="widget meta-boxes">
    <div class="widget-title">
        <h4>
            <span> Replies</span>
        </h4>
    </div>
    <div class="widget-body">
        <div id="reply-wrapper">
            @if ($row->{$ctrl->value}!="")
            <p>No reply yet!</p>
            @else
            <div id="reply-wrapper"><p>Time: <i>2021-08-12 23:06:23</i></p><p>Content:</p><pre class="message-content"><p>tet</p></pre></div>
            @endif
        </div>
        <p><span class="btn btn-info answer-trigger-button">Reply</span></p>

        <div class="answer-wrapper" style="display: none;">
            <div class="form-group">
                <textarea without-buttons="" class="form-control editor-ckeditor form-control editor-ckeditor" id="answer-content" rows="4" cols="50"></textarea>
            </div>

            <div class="form-group">
                <input type="hidden" value="8" id="input_contact_id">
                <span class="btn btn-success answer-send-button"><i class="fas fa-reply"></i> Send</span>
            </div>
        </div>
    </div>
    <script>
        $(document).on("click",".answer-trigger-button",function(){
            $('.answer-wrapper').toggle("show");
        });
        $(document).on("click",".answer-send-button",function(){
            let email = $('#email').val();
            let contetn = $("#answer-content").val();
            var form_data = new FormData();
            form_data.append("key", value);
            form_data.append("id", $('#slug_id').val());
            form_data.append("reference_id", $('#reference_id').val());
            form_data.append("reference_type", $('#reference_type').val());
            form_data.append("key_title", "true");
            form_data.append("_token", '{{ csrf_token() }}');

            $.ajax({
                url: "{{url('admin/ajax/send_mail')}}",
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
    </script>
</div>
