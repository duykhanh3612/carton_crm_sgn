@php
$third_module_table = $ctrl->att_table;
$tr = md::find($ctrl->att_table,$ctrl->att_key."='".@$row->{$ctrl->note}."'");

$field_id = @$ctrl->name.$lang;
@endphp

<div class="form-group {{  $ctrl->width}} desktop ">
    <label>
        {{        $ctrl->title }}
        @if(@$ctrl->validate==1)
          <span style="color:#ff0000">(*)</span>
        @endif
    </label>
    <div class="input-group">
        <input type="text" class="form-control {{@$ctrl->validate==1?'validation':''}}  {{ @$ctrl->needed==1?'needed':''}}   <?=$lang?>"
            {{@$ctrl->read==1?"readonly":"name=".$third_module_table.'['.@$ctrl->name.$lang.']'}}
               id="<?=$field_id?>"   value="<?=@$tr->{@$ctrl->note.$lang}?>" placeholder=" {{        $ctrl->title }} " />

        <span id="{{$field_id}}_check_data" class="btn" style="cursor:pointer;padding:10px 5px;" title="Check dữ liệu">
            <i class="fa fa-check"></i>
        </span>
        <span class="btn" style="cursor:pointer;padding:10px 5px;" title="Check dữ liệu">
            <a href="" id="{{$field_id}}_link_data" target="_blank" style="display:none" > <i class="fa fa-link"></i></a>
           
        </span>
    </div>
    <i>
        <small style="color:#ff0000" id="{{$field_id}}_mess_panel" class="mess_panel"></small>
    </i>
    <div class="form-group {{$field_id}}_list_content" style="display:none;">
        <div class="form-group col-md-12">
            <label style="width:100%;">
                <b>Danh sách tương tự</b>
            </label>
            <ol id="{{$field_id}}_list_panel" class="order_list"></ol>

        </div>
    </div>
    <script>
        $(document).ready(function () {
        @if(@$tr->{@$ctrl->note}=='')      
            $('#{{$ctrl->att_field}}').val(getCookie("data_value"))
        @endif
        });
    </script>
    <script>
       $('#{{$field_id}}_check_data').click(function(){
           var form_data = new FormData();
           var data_value = $('#{{$ctrl->att_field}}').val();

           setCookie("data_value", data_value, 1);
                form_data.append("table", '{{$ctrl->att_table}}');
                form_data.append("key", '{{$ctrl->att_field}}');
                form_data.append("value", data_value);
                form_data.append("_token", '{{ csrf_token() }}');
                     $('#{{$field_id}}_mess_panel').html('');
                $.ajax({
                    url: "{{url('admin/ajax/check_data')}}",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    type: 'POST',
                    success: function (result) {
                        if (result.mess == 'success') {
                            var data = result.data;
                            $.each(data, function (key, value) {
                                $('#' + key).val(value);
                            });
                            $('#{{$field_id}}_list_panel').html('');
                            $('#{{$field_id}}_link_data').attr('href', '{{url('admin/project/edit')}}/' + data.{{$ctrl->att_key}});
                            $('#{{$field_id}}_link_data').show();
                            $('#{{$field_id}}_mess_panel').html('Tìm thấy dữ liệu ID <em>'+data.{{$ctrl->att_key}}+'</em>');
                        }
                        else
                        {
                            $('#{{$field_id}}_mess_panel').html('Không tìm thấy dữ liệu <em>' + data_value +'</em>');
 
                                var form_data = new FormData();
                                form_data.append("table", '{{$ctrl->att_table}}');
                                form_data.append("key", '{{$ctrl->att_field}}');
                                form_data.append("value", $('#{{$ctrl->att_field}}').val());
                                form_data.append("_token", '{{ csrf_token() }}');
                                $.ajax({
                                    url: "{{url('admin/ajax/check_data_like')}}",
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    data: form_data,
                                    type: 'POST',
                                    success: function (result) {
                                        if (result.data.length > 0) {
                                            $('.{{$field_id}}_list_content').show();
                                             $('#{{$field_id}}_list_panel').html('');
                                            $.each(result.data, function (i, data) {
                                                var li = '<li class="{{$field_id}}_list_data"  data-json="' + Encrypt(JSON.stringify(data)) + '"' +'><span>' + data.{{$ctrl->att_field}} + '</span> <a href="{{url('admin/project/edit')}}/'+data.{{$ctrl->att_key}}+'"> Link</a></li>';
                                                $('#{{$field_id}}_list_panel').append(li);
                                            });
                                        
                                            $('.{{$field_id}}_list_data').click(function () {
                                                var json_decrypt = Decrypt($(this).attr('data-json'));                                                
                                                var data = JSON.parse(json_decrypt);
                                                //$('#{{$field_id}}').val(data.project_id);

                                                //$('#project_name').val(data.project_name);

                                                $.each(data, function (key, value) {
                                                    $('#' + key).val(value);
                                                });
                                                $('#{{$field_id}}_link_data').attr('href', '{{url('admin/project/edit')}}/' + data.{{$ctrl->att_key}});
                                                $('#{{$field_id}}_link_data').show();
                                            });
                                        }
                                        else {
                                            $('#{{$field_id}}_list_panel').html('');
                                            $('.{{$field_id}}_list_content').show();
                                            var li = '<li class="marker_dont_exist">Không tìm thấy marker liên quan tới <em>' + data_value + '</em></li>';
                                            $('#{{$field_id}}_list_panel').append(li);
                                        }//endif
                                  }
                       
                          });//end if
                        }
                    }
                });
        });


        function Encrypt(str) {
            if (!str) str = "";
            str = (str == "undefined" || str == "null") ? "" : str;
            try {
                var key = 146;
                var pos = 0;
                ostr = '';
                while (pos < str.length) {
                    ostr = ostr + String.fromCharCode(str.charCodeAt(pos) ^ key);
                    pos += 1;
                }

                return ostr;
            } catch (ex) {
                return '';
            }
        }

        function Decrypt(str) {
            if (!str) str = "";
            str = (str == "undefined" || str == "null") ? "" : str;
            try {
                var key = 146;
                var pos = 0;
                ostr = '';
                while (pos < str.length) {
                    ostr = ostr + String.fromCharCode(key ^ str.charCodeAt(pos));
                    pos += 1;
                }

                return ostr;
            } catch (ex) {
                return '';
            }
        }

        function setCookie(cname, cvalue, exdays) {
            var d = new Date();
            d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
            var expires = "expires=" + d.toUTCString();
            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        }
        function readCookie(name) {
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        }

        function getCookie(cname) {
            var name = cname + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }
    </script>
    <style type="text/css">
        .order_list{
                 list-style-type:decimal;
                 cursor:pointer;
        }
        .mess_panel em{
            color:#0e3ffe;
            font-weight:bold;
        }
    </style>
</div>

