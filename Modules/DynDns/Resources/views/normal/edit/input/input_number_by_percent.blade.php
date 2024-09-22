<div class="form-group {{$ctrl->width}}">
    <label>
        {{ $ctrl->title }} @if(@$ctrl->validate==1)<span style="color:#ff0000">(*)</span>@endif
    </label>
    <div class="">
        <div class="col-md-12">
            <label style="float:left;width:10px;">%</label>
            <input type="number" style="width:80px;float:left;" class="form-control" id="<?=@$ctrl->name.$lang?>_percent" name="<?=@$ctrl->name.$lang?>_percent" value="" max="100" />
            <label style="float:left;width:10px;">=</label>
            <input type="text" style="float:left;width:50%;" class="form-control {{ @$ctrl->validate==1?'validation':''}}  money title<?=$lang?>" id="<?=@$ctrl->name.$lang?>_view" value="<?=@$row->{$ctrl->value.$lang}?>" data-type="number" autocomplete="off" />
            <input type="hidden" class="form-control title<?=$lang?>" id="<?=@$ctrl->name.$lang?>" name="<?=@$ctrl->name.$lang?>" value="<?=@$row->{$ctrl->value.$lang}?>" autocomplete="off" />
            <ul class="parsley-errors-list" id="parsley-id-4995">
                <?=@$ctrl->note?>
            </ul>
        </div>

    </div>
    <script src="{{env_host}}/public/plugin/mask/jquery.mask.min.js" type="text/javascript"></script>
    <script>
        $('.money').mask('#,##0', { reverse: true });
        $('#{{@$ctrl->name.$lang}}_view').on('change', function () {
            var value = $(this).val().replace(new RegExp(',', 'g'), '');
            $('#{{@$ctrl->name.$lang}}').val(value);
        })
       $('#<?=@$ctrl->name.$lang?>_percent').on('keyup', function () {
            var price = $('#{{@$ctrl->att_table}}').val();
            var percent = $(this).val();
            var total = price / 100 * percent;
            $('#{{@$ctrl->name.$lang}}_view').val(total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));


           var value =  $('#{{@$ctrl->name.$lang}}_view').val().replace(new RegExp(',', 'g'), '');
            $('#{{@$ctrl->name.$lang}}').val(value);

        });
       $('#<?=@$ctrl->name.$lang?>_percent').on('change', function () {
                    var price = $('#{{@$ctrl->att_table}}').val();
            var percent = $(this).val();
            var total = price / 100 * percent;
            $('#{{@$ctrl->name.$lang}}_view').val(total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));


           var value =  $('#{{@$ctrl->name.$lang}}_view').val().replace(new RegExp(',', 'g'), '');
            $('#{{@$ctrl->name.$lang}}').val(value);
       });

        var price = $('#{{@$ctrl->att_table}}').val();
        var price_per = $('#{{@$ctrl->name}}').val();
        $('#<?=@$ctrl->name.$lang?>_percent').val(price_per/price*100)

    </script>
</div>