
<div class="form-group {{  $ctrl->width}} " data-title="password_with_field">
    <label>
        <?=$ctrl->title?>
    </label>
    <div>
        <label class="col-md-2" style="height:36px;margin:0px;border:1px solid #cccccc">
            {{@$row->{@$ctrl->att_table} }}
            <input type="hidden" id="{{@$ctrl->att_table}}" name="{{@$ctrl->att_table}}" value="{{@$row->{@$ctrl->att_table} }}" />
            <input type="hidden" id="password" name="password" value="{{@$row->password }}" />
        </label>
        <input type="password" class="col-md-10 title<?=$lang?>" id="<?=$ctrl->name.$lang?>" name="ssl[<?=$ctrl->name.$lang?>]" value="" placeholder="Tạo mật khẩu mới" />


        <script>
            $('#<?=$ctrl->name.$lang?>').on('keyup', function () {
                $('.btn_apply').hide();
                $('.btn_save').hide();
                $('#{{@$ctrl->att_table}}').val($(this).val());

                $.get("{{url('admin/ajax/Encrypt')}}" + '?password=' + $(this).val(), function (data) {
                    $('#password').val(data);
                    $('.btn_apply').show();
                    $('.btn_save').show();
                });

            })
        </script>
    </div>
</div>
