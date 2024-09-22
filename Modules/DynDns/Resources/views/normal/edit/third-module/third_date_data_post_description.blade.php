@php
$third_module_table = $ctrl->att_table;
$tr = md::find($ctrl->att_table,$ctrl->att_key."='".@$row->{$ctrl->note}."'")
@endphp
<div class="form-group {{ $ctrl->width}}">
    <label>
        {{$ctrl->title}}
    </label>
    <div class="">
        <textarea id="<?=@$ctrl->name.$lang?>" {{@$ctrl->read==1?"readonly":"name=".$third_module_table.'['.@$ctrl->name.$lang.']'}} rows="2" class="textarea form-control {{ @$ctrl->needed==1?'needed':''}} " style="width:100%;"><?=@$tr->{$ctrl->value.$lang}?> </textarea>

        <span id="btn_data_post_description_check<?=@$ctrl->name.$lang?>" class="btn" style="position:absolute;bottom:0px;left:15px; cursor:pointer;padding:2px;opacity:0.5; background:#ccc">
            <i class="fa fa-check"></i>
        </span>
        <ul class="parsley-errors-list"></ul>
        <script>
            $('.textarea').change(function () {
                var content = $(this).val();
                value = value.replace('P.', 'Phường ');
                value = value.replace('p.', 'Phường ');
                value = value.replace('Q.', 'Quận ');
                value = value.replace('q.', 'Quận ');
                $(this).val(content.trim());
            });

            $('#btn_data_post_description_check<?=@$ctrl->name.$lang?>').click(function () {
                data_post_description_check<?=@$ctrl->name.$lang?>();
            });

            function data_post_description_check<?=@$ctrl->name.$lang?>() {
                var value = $('#<?=@$ctrl->name.$lang?>').val();
                value =  value.replace('P.','Phường ');
                value = value.replace('Q.', 'Quận ');
                var str = value.split('.');
                $('#<?=@$ctrl->name.$lang?>').val(value);
                $('#<?=@$ctrl->att_join?>').val(str[0]);
            }
        </script>
    </div>
</div>
