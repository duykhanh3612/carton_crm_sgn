@php
//$name_id = str_replace(array('[',']',"#"),array('','',''),@$ctrl->name.$lang);

$field = explode(',',@$ctrl->att_table);
$price = @$field[0];
$pro = @$field[1];
$price_old = @$field[2];
@endphp

<div class="form-group row {{$ctrl->width}} desktop" title="input_price_has_promotion" >
    <div class="col-md-4">
        <label>
            Giá
        </label>
        <div class="">
            <input type="text" class="form-control  money_<?=@$price_old?>" id="<?=@$price_old?>" value="<?=@$row->{$price_old}?>" data-type="number" autocomplete="off" />
            <input type="hidden" class="form-control" id="<?=@$price_old?>_hide" name='{{$price_old}}' value="<?=@$row->{$price_old}?>" autocomplete="off" />

        </div>
    </div>
    <div class="col-md-4">
        <label>
           % giảm giá
        </label>
        <div class="">
            <input type="number" max="100" min="0" class="form-control" id="<?=@$pro?>" name="{{$pro}}" value="<?=@$row->{$pro}?>" data-type="number" autocomplete="off" />

        </div>
    </div>
    <div class="col-md-4">
        <label>
            Giá bán (Đã khuyến mãi)
        </label>
        <div class="">
            <input type="text" class="form-control money_<?=@$price?>" id="<?=@$price?>" value="<?=@$row->{$price}?>" data-type="number" autocomplete="off" />
            <input type="hidden" class="form-control" id="<?=@$price?>_hide" name='{{@$price}}' value="<?=@$row->{$price}?>" autocomplete="off" />

        </div>
    </div>

    @push('script')
    <script src="{{env_host}}public/plugin/mask/jquery.mask.min.js" type="text/javascript"></script>
    <script>
        $('.money_<?=@$price?>').mask('###', { reverse: true });
        $('#{{@$price}}').on('change', function () {
            var value = $(this).val().replace(new RegExp(',', 'g'), '');
            $('#{{@$price}}_hide').val(value);
        })

        $('.money_<?=@$price_old?>').mask('###', { reverse: true });
        $('#{{@$price_old}}').on('change', function () {
            var value = $(this).val().replace(new RegExp(',', 'g'), '');
            $('#{{@$price_old}}_hide').val(value);
        })

        $('#{{$pro}}').on('change', function () {
            var price_old = $('#{{@$price_old}}_hide').val();
            var pro = $(this).val();
            var price = parseFloat(price_old) /100 * (100 - parseFloat(pro));
            $('#{{@$price}}').val(price);
            $('#{{@$price}}_hide').val(price);
        })
    </script>
    @endpush
</div>
