<div class="col-md-6 form-group last">

    <label class="col-md-2  control-label">{!!$ctrl->title !!}</label>

    <div class="col-md-10 input-group" style="float:left">
        <div class="col-md-6" style="padding-left:21px">
            <input type="text" class="form-control md_line money_{{ $ctrl->name }}_from" value="<?=@$src['from']?>" placeholder="{{__('lang.tu')}}" />
            <input type="text" class="form-control" id="money_{{ $ctrl->name }}_from" name="src[{{ $ctrl->name }}][between][from]" value="<?=@$src['from']?>" placeholder="{{__('lang.tu')}}" />

        </div>
        <div class="col-md-6" style="padding-right:0px;">
            <input type="text" class="form-control md_line money_{{ $ctrl->name }}_to" value="<?=@$src['to']?>" placeholder="{{__('lang.den')}}" />
            <input type="text" class="form-control md_line" id="money_{{ $ctrl->name }}_to" name="src[{{ $ctrl->name }}][between][to]" value="<?=@$src['to']?>" placeholder="{{__('lang.den')}}" />
        </div>


        <script src="../../plugin/mask/jquery.mask.min.js" type="text/javascript"></script>

        <script>
        $('.money_{{ $ctrl->name }}_from').mask('#,##0', { reverse: true });
        $('#money_{{ $ctrl->name }}_from').on('change', function () {
            var value = $(this).val().replace(new RegExp(',', 'g'), '');
            $('#{{@$ctrl->name.$lang}}_hide').val(value);
        })

        $('.money_{{ $ctrl->name }}_from').mask('#,##0', { reverse: true });
        $('#money_{{ $ctrl->name }}_to').on('change', function () {
            var value = $(this).val().replace(new RegExp(',', 'g'), '');
            $('#{{@$ctrl->name.$lang}}_hide').val(value);
        })
        </script>
    </div>

</div>  