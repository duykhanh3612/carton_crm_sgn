
<div class="form-group {{ $ctrl->width}}">
    <label>
        {{$ctrl->title}}
    </label>
    <div class="">
        <textarea {{@$ctrl->read==1?"readonly":"id=".@$ctrl->name.$lang." name=".@$ctrl->name.$lang}} rows="2" class="textarea form-control {{ @$ctrl->needed==1?'needed':''}} " style="width:100%;{!! @$ctrl->att_style !!}"><?=@$row->{$ctrl->value.$lang}?> </textarea>
        <script>
            $('.textarea').change(function () {
                var content = $(this).val();
                $(this).val(content.trim());

            });
        </script>
        <ul class="parsley-errors-list">{{@$ctrl->note}}</ul>
    </div>
</div>
