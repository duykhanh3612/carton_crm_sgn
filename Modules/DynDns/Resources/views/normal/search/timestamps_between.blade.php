
<div class="col-md-6 form-group last pad5_top" title="timestamps_between">

    <label class="col-md-2  control-label">{!! $ctrl->title !!}</label>

    <div class="col-md-10 input-group" style="float:left">
        <div class="col-md-6" style="padding-left:21px">
            <!--<input type="text" class="form-control md_line" name="src[{{$ctrl->name }}][between][from]" value="<?=@$tag['src']['tonggiatri']['from']?>" placeholder="{{__('lang.tu')}}" />-->
            <?php $date = @$src['from']; ?>

            <div class="col-md-12 input-group date form_date form-control" data-date="<?=date('d/m/Y',strtotime($date))?>" data-date-format="dd/mm/yyyy" data-link-field="{{$ctrl->name }}_date_between_from" data-link-format="yyyy-mm-dd" style="padding:0px 10px 0px 0px;">
                <div class="col-md-8" style="padding-left:0px;padding-right:0px;overflow:hidden;height:90%">
                    <input class="form-control " size="16" value="{{$date!=''?date('d/m/Y',strtotime($date)):''}}" readonly="" type="text" style="border:0px;background-color:#fff" placeholder="{{__('lang.tu')}}" />
                </div>
                <div class="col-md-2" style="padding-left:0px;padding-right:0px;">
                    <span class=" input-group-addon" style="border:0px;background-color:#fff">
                        <span class="glyphicon glyphicon-remove"></span>
                    </span>
                </div>
                <div class="col-md-2" style="padding-left:0px;padding-right:5px">
                    <span class="input-group-addon" style="border:0px;background-color:#fff">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>

            </div>
            <input id="{{$ctrl->name}}_date_between_from" name="src[{{$ctrl->name }}][timestamps_between][from]" value="{{$date!=''?$date:''}}" type="hidden" />
        </div>
        <div class="col-md-6" style="padding-right:0px;">
            <?php $date = @$src['to']?>
            <div class="col-md-12 input-group date form_date form-control" data-date="<?=date('d/m/Y',strtotime($date))?>" data-date-format="dd/mm/yyyy" data-link-field="{{$ctrl->name }}_date_between_to" data-link-format="yyyy-mm-dd" style="padding:0px 10px 0px 0px;">
                <div class="col-md-8" style="padding-left:0px;padding-right:0px;overflow:hidden;height:90%">
                    <input class="form-control " size="16" value="{{$date!=''?date('d/m/Y',strtotime($date)):''}}" readonly="" type="text" style="border:0px;background-color:#fff" placeholder="{{__('lang.den')}}" />
                </div>
                <div class="col-md-2" style="padding-left:0px;padding-right:0px;">
                    <span class=" input-group-addon" style="border:0px;background-color:#fff">
                        <span class="glyphicon glyphicon-remove"></span>
                    </span>
                </div>
                <div class="col-md-2" style="padding-left:0px;padding-right:0px">
                    <span class="input-group-addon" style="border:0px;background-color:#fff">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>

            </div>
            <input id="{{$ctrl->name }}_date_between_to" name="src[{{$ctrl->name }}][timestamps_between][to]" value="{{$date!=''?$date:''}}" type="hidden" />
        </div>



    </div>

</div>
<script type="text/javascript" src="{{env_host}}/public/dashboard/adminui/assets/js/vendor/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="{{env_host}}/public/dashboard/adminui/assets/js/vendor/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
<script>
    $('.form_date').datetimepicker({
        language: 'en',
        weekStart: 1,
        todayBtn: 1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0,

    });
</script>
