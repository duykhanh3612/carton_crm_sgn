<!--SEO-->

@php

$seo =  current(json_decode(@$row->seo)??[]);

@endphp

<div class="form-group {{@$ctrl->width}}">
    <hr class="{{@$ctrl->width}}" style="border-top:3px solid;margin:0px 15px;width:100%;clear: both;display:none" />
    <label style="font-size:24px;">
        <?=@$ctrl->title?>
    </label>
    <hr class="{{@$ctrl->width}}" style="border-bottom: 1px dashed;margin:0px 15px;" />
</div>

<div class="form-group {{@$ctrl->width}}">

    <label>

        Meta Title

    </label>

    <div class="">

        <input value="{{@$seo->title}}" class="seo seo_title form-control" type="text" />

    </div>

</div>

<div class="form-group {{@$ctrl->width}}">

    <label>

        Meta Description

    </label>

    <div class="">

        <textarea name="seo_description" class="seo seo_description textarea small  form-control">{!! @$seo->description !!}</textarea>

    </div>

</div>

<div class="form-group {{@$ctrl->width}}">

    <label>

        Meta Keyword

    </label>

    <div class="">

        <textarea name="seo_keywords" class="seo seo_keywords textarea small  form-control">{!!@$seo->keywords !!}</textarea>

        <textarea name="{{$ctrl->name}}" id="{{$ctrl->name}}" style="display:none">{!!@$row->{$ctrl->value} !!}</textarea>

    </div>

</div>



<script>

    $(document).on('change', '.seo', function () {



   // $('.seo').on('change', function () {

        var list = [];

        var title = $('.seo_title').val();

        var description = $('.seo_description').val();

        var keywords = $('.seo_keywords').val();



            var obj = {

                title: title,

                description: description,

                keywords: keywords

            };

            list.push(obj);



        $('#seo').val(JSON.stringify(list));

    });



</script>

<!--//SEO-->
