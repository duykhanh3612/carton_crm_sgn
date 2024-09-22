<div class="form-group {{$ctrl->width}}">
    <label>
        {{ $ctrl->title }} @if(@$ctrl->validate==1)
        <span style="color:#ff0000">(*)</span>@endif
    </label>
    <div class="">
        <input type="text" class="form-control {{ @$ctrl->validate==1?'validation':''}}  money title<?=$lang?>" id="<?=@$ctrl->name.$lang?>" name="<?=@$ctrl->name.$lang?>" value="<?=@$row->{$ctrl->value.$lang}?>" data-type="number" autocomplete="off" />
        <input type="hidden" class="form-ontrol title<?=$lang?>" id="<?=@$ctrl->att_table?>" name="<?=@$ctrl->att_table?>" value="<?=@$row->{$ctrl->att_table}?>" autocomplete="off" />
        
        <ul class="parsley-errors-list" id="parsley-id-4995">
            
        </ul>
    </div>
    <script src="../../plugin/mask/jquery.mask.min.js" type="text/javascript"></script>
    <script>
        $('.money').mask('#,##0', { reverse: true });
        $('#{{@$ctrl->name.$lang}}').on('change', function () {
            Date.prototype.addYears = function (years) {
                this.setDate(this.getDate() - parseInt(years * 365));
                return this;
            };

            var currentDate = new Date();

            // to add 4 days to current date
            var date = currentDate.addYears($(this).val());
            var date_str = new Date(date).toDateString("mm-dd-yyyy");
            $('#{{@$ctrl->att_table}}').val(date.getFullYear()+'-'+ (date.getMonth() + 1)+'-'+  date.getDate());



        })
    </script>
</div>