<!--SEO-->
@php
    $seo = @array_first(json_decode(@$row->{$ctrl->value}));
@endphp
<div class="form-group" style="border-bottom:1px dashed;clear:both;">
    <hr style="border-top:3px solid;width:100%;clear: both;margin:0px;" />
    <label style="font-size:24px;">
        <?=@$ctrl->title?>
    </label>
    <textarea name="{{$ctrl->name}}" id="{{$ctrl->name}}" style="display:none">{!!@$row->{$ctrl->value} !!}</textarea>
</div>
<div class="form-group {{$ctrl->width}}">
    <label>
        SMTP Server
    </label>
    <div class="">
        <input value="{{@$seo->host}}" class="{{$ctrl->name}} {{$ctrl->name}}_host form-control" type="text" />
    </div>
</div>
<div class="form-group {{$ctrl->width}}">
    <label>
        SMTP Port
    </label>
    <div class="">
        <input value="{{@$seo->port}}" class="{{$ctrl->name}} {{$ctrl->name}}_port form-control" type="text" />
    </div>
</div>
<div class="form-group {{$ctrl->width}}">
    <label>
        SMTP Secure
    </label>
    <div class="">
        <input value="{{@$seo->ssl}}" class="{{$ctrl->name}} {{$ctrl->name}}_ssl form-control" type="text" />
    </div>
</div>
<div class="form-group {{$ctrl->width}}">
    <label>
        SMTP user
    </label>
    <div class="">
        <input value="{{@$seo->user}}" class="{{$ctrl->name}} {{$ctrl->name}}_user form-control" type="text" />
    </div>
</div>
<div class="form-group {{$ctrl->width}}">
    <label>
        SMTP Pass
    </label>
    <div class="">
        <input value="{{@$seo->pass}}" class="{{$ctrl->name}} {{$ctrl->name}}_pass form-control" type="text" />
    </div>
</div>

<script>
    $(document).on('change', '.{{$ctrl->name}}', function () {
        var list = [];
        var host = $('.{{$ctrl->name}}_host').val();
        var port = $('.{{$ctrl->name}}_port').val();
        var ssl = $('.{{$ctrl->name}}_ssl').val();
        var user = $('.{{$ctrl->name}}_user').val();
        var pass = $('.{{$ctrl->name}}_pass').val();
            var obj = {
                host: host,
                port: port,
                ssl: ssl,
                user:user,
                pass:pass
            };
            list.push(obj);

        $('#{{$ctrl->name}}').val(JSON.stringify(list));
    });

</script>
<!--//SEO-->