<div class="form-group {{$ctrl->width}}">
    @php
     $string =$ctrl->att_table;
     $arr = explode( ',', $string );
    @endphp
    <label>
        {{ $ctrl->title }} @if(@$ctrl->validate==1)<span style="color:#ff0000">(*)</span>@endif
    </label>
    <div class="">
        <div class="col-md-12">
            <label style="float:left;width:10px;"></label>
            <input type="number" style="width:70px;float:left;" name="{{@$arr[0]}}" value="{{@$row->{@$arr[0]} }}" class="form-control" id="<?=@$ctrl->name.$lang?>_long" max="100" />
            <label style="float:left;width:10px;">x</label>
            <input type="number" style="width:70px;float:left;" name="{{@$arr[1]}}" value="{{@$row->{@$arr[1]} }}" class="form-control" id="<?=@$ctrl->name.$lang?>_wide" max="100" />
            <label style="float:left;width:10px;">=</label>
            <input type="text" style="float:left;width:120px;" class="form-control {{ @$ctrl->validate==1?'validation':''}}" id="<?=@$ctrl->name.$lang?>" name="{{$ctrl->name}}" value="<?=@$row->{$ctrl->value}?>" data-type="number" autocomplete="off" />
            <ul class="parsley-errors-list" id="parsley-id-4995">
                <?=@$ctrl->note?>
            </ul>
        </div>

    </div>
    <script>
        $('#<?=@$ctrl->name.$lang?>_long').on('keyup change', function () {
            var long = $('#{{@$ctrl->name}}_long').val();
            var wide = $('#{{@$ctrl->name}}_wide').val();
            var area = Number(long)  * Number(wide);
            $('#{{@$ctrl->name}}').val(area);
        });

        $('#<?=@$ctrl->name.$lang?>_wide').on('keyup change', function () {
            var long = $('#{{@$ctrl->name}}_long').val();
            var wide = $('#{{@$ctrl->name}}_wide').val();
            var area = Number(long)  * Number(wide);
            $('#{{@$ctrl->name}}').val(area);

        });
    </script>
</div>
