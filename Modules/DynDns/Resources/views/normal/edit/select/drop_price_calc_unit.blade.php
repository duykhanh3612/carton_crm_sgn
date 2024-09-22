<?php
$arr = explode(',',$ctrl->att_where);
?>
<div class="form-group {{$ctrl->width}}">
    <label>
        <?=$ctrl->title?> @if(@$ctrl->validate==1) {{$lang}}
        <span style="color:#ff0000">(*)</span>@endif
    </label>
    <div>
        <select class="form-control  {{$ctrl->name}} {{@$ctrl->validate==1?'validation':''}}  {{ @$ctrl->needed==1?'needed':''}} " {{@$ctrl->read==1?"readonly disabled":"name=".@$ctrl->name.$lang}}  >
            <?php foreach(App\Model\md::find_all($ctrl->att_table) as $a):?>
            <option value="{{$a->{@$ctrl->att_key} }}" data-key="<?=@$a->key?>"> <?=$a->{@$ctrl->att_field}?></option><?php 
                  endforeach?>
        </select>

        <input type="hidden" name="{{$arr[0]}}"  value="{{@$row->{$arr[0]} }}" id="{{$arr[0]}}" class="form-group" />
        <script>
        @if(@$row->{$ctrl->value} !='')
        $('.{{$ctrl->name}}').val('{!! @$row->{$ctrl->value} !!}')
        @endif

        $('.{{$ctrl->name}}').on('change',function(){
            var unit = $(this).val();
            var price = $('#{{$arr[1]}}').val();
            var key  = $(this).find(':selected').attr('data-key');

            if(unit=='Toàn diện tích')
                 $('#{{$arr[0]}}').val(price);
            else if(unit=='m2')
            {
                var area =  $('#{{$arr[2]}}').val();
                $('#{{$arr[0]}}').val(area*price);
            }
            else if(unit=='1 công')
            {
                $('#{{$arr[0]}}').val(1000*price);
            }
            //
        }) ;

        $('#{{$arr[1]}}').on('change',function(){
            cal_price();
        }) ;
         $('#{{$arr[1]}}_view').on('change',function(){
            cal_price();
        }) ;
        $('#{{$arr[2]}}').on('change',function(){
            cal_price();
        }) ;
        function cal_price(){
            var unit = $('.{{$ctrl->name}}').val();
            var price = $('#{{$arr[1]}}').val();

            if(unit=='Toàn diện tích')
                 $('#{{$arr[0]}}').val(price);
            else if(unit=='m2')
            {
                var area =  $('#{{$arr[2]}}').val();
                $('#{{$arr[0]}}').val(area*price);
            }
            else if(unit=='1 công')
            {
                $('#{{$arr[0]}}').val(1000*price);
            }

        }
         cal_price();
        </script>
    </div>
</div>
