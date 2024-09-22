<div class="form-group {{$ctrl->width}}">
    <label id="validation_need">

    </label>

    <script>
        var has_needed = $(".needed").length;
        if (has_needed > 0)
        {
            var hasError = false;
            $(".needed").each(function () {
                var type = $(this).attr('data-type');
                var field = $(this).attr('data-field');
                var value = $(this).val();
                var content = $(this).attr('data-content');
                switch(type)
                {
                    case 'password_confirn':

                        if (value != $('#' + field).val())
                        {
                            hasError = true;
                            //parsley-id-moderator_password_config
                            //
                            $('#parsley-id-'+$(this).attr('id')).html("<li>"+content+"</li>");
                        }
                        else $('#parsley-id-' + $(this).attr('id')).html("");
                        break;
                    default:
                        if (value.trim() == '') {
                            hasError = true;
                            $(this).parent().find(parsley-errors).html("<li style='color:blue'>(*) Dữ liệu cần được bổ sung!</li>");
                        }
                        else $(this).parent().find(parsley-errors).html("<li></li>");
                        break;
                }
            });


        }
        else
        {
            $('#validation_need').html('');
        }

    </script>
</div>