@php
    $table = @$ctrl->att_table_prefix==1?@$admin_group->prefix."_". $ctrl->att_table:$ctrl->att_table;
    $field_lang = @$ctrl->att_field_language==1?$ctrl->att_field.($lang==""?"_vn":$lang):$ctrl->att_field;
@endphp
<div class="form-group {{$ctrl->width}} " data-title="treelistlor">
    <label>
        <?=@$ctrl->title?>
    </label>
    <?=\h::tree($ctrl->name,@$row->{$ctrl->value},$ctrl->att_style.' class="form-control listbox '.$table.'" size=16',
            $table,($ctrl->att_where==''?@$ctrl->att_level.'=0':$ctrl->att_where.' and '.@$ctrl->att_level.'=0'),
            $field_lang,@$ctrl->att_level,@$ctrl->att_key,
            @$ctrl->att_orderby,"|","--",@$ctrl->att_root,@$ctrl->att_rootvalue,@$ctrl->att_join);?>

    <script>
        var cookie = 'cookie_{[$ctrl->name}}';
        $(document).ready(function () {
            @if(@$row->{$ctrl->value}!='')
            $('.{{$table}}').val('{{ @$row->{$ctrl->value} }}')
            @else
            $('.{{$table}}').val(getCookie(cookie))
            @endif
        })
        var cate = $('.{{$table}}').find('option:selected').data("cate");
    </script>
    <script>
        // console.log(cate);

        console.log(27,cate);
        $('.sub1').on('click', function () {
            var id = $(this).val();
            setCookie(cookie, id, 1);
        });
        $('.sub2').on('click', function () {
            var id = $(this).val();
            $('.cate_' + id).toggle();
            if ($('.cate_' + id).css('display') == "block")
                $(this).css("background-image", "url(https://cdn4.iconfinder.com/data/icons/arrows-147/40/57-512.png)");
            else $(this).css("background-image", "url(https://cdn4.iconfinder.com/data/icons/arrows-147/40/74-512.png)");

            setCookie(cookie, id, 1);
        });

        $(".sub2").each(function (index) {
            var id = $(this).val();
            if ($('.cate_' + id).html() == undefined)
                $(this).css("background", "#fff");
        });
        $(document).ready(function () {
            $('.{{$table}}').find('option[data-cate='+cate+']').show();
        });
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
    <style>
    .sub2{
        background:url(https://cdn4.iconfinder.com/data/icons/arrows-147/40/74-512.png) no-repeat top right;
        background-size:16px 16px;
    }
    .minus{
        background:url(https://cdn4.iconfinder.com/data/icons/arrows-147/40/57-512.png) no-repeat top right;
        background-size:16px 16px;
    }
    .sub4{
        display:none;
    }
    </style>
</div>
