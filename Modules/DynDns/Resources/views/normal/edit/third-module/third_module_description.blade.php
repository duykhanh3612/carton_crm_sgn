@php
$third_module_table = $ctrl->att_table;
$tr = md::find($ctrl->att_table,$ctrl->att_key."='".@$row->{$ctrl->note}."'")
@endphp
<div class="form-group {{ $ctrl->width}}">
    <label>
        {{$ctrl->title}}
    </label>
    <div class="">
        <textarea {{@$ctrl->read==1?"readonly":"name=".$third_module_table.'['.@$ctrl->name.$lang.']'}} id="{{@$ctrl->name.$lang}}" rows="2" class="textarea form-control {{ @$ctrl->needed==1?'needed':''}} " style="width:100%;"><?=@$tr->{$ctrl->value.$lang}?> </textarea>
        <ul class="parsley-errors-list"></ul>
        <script>
            $('.textarea').change(function () {
                var content = $(this).val();
                $(this).val(content.trim());

            });
        </script>
    </div>
</div>
