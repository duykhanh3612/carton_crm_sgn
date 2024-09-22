@if(!h::isMobile())
<div class="col-md-6 form-group desktop row" title="date_between">
    <div class="col-md-4 filter-input-group">
        <label class="filter-input-control">{!!$ctrl->title !!}</label>
    </div>

    <div class="col-md-8">
        <?php $date = @$src['from']?>
        <div class="input-group date form_date form-control" data-date="<?=$date!=''?date('d/m/Y',strtotime($date)):''?>" data-date-format="dd/mm/yyyy" data-link-field="{{$ctrl->name }}_date_between_from" data-link-format="yyyy-mm-dd" style="padding:0px;">

            <div style="width:30px;float:left;padding-top:5px;padding-left:5px;">
                <span class="input-group-addon" style="padding:5px 0px 0px 5px; border:0px;background-color:#fff">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
            <div style="width:calc(100% - 70px); float:left; padding:1px 0px;overflow:hidden;height:90%">
                <input class="form-control yl-input-control" size="16" value="{{$date!=''?date('d/m/Y',strtotime($date)):''}}" readonly="" type="text" style="border:0px;background-color:#fff" placeholder="Từ" />
            </div>
            <div style="width:20px;float:right; padding-top:5px;margin-right:20px;">
                <span class=" input-group-addon" style="border:0px;background-color:#fff">
                    <span class="glyphicon glyphicon-remove"></span>
                </span>
            </div>

        </div>
        <input id="{{$ctrl->name}}_date_between_from" name="src[{{$ctrl->name }}][date_between][from]" value="{{$date!=''?$date:''}}" type="hidden" />
    </div>
</div>
<div class="col-md-6 form-group desktop row" title="date_between">
    <div class="col-md-4 filter-input-group">
        <label class="filter-input-control">Đến</label>
    </div>
    <div class="col-md-8">
        <?php $date = @$src['to']?>
        <div class="input-group date form_date form-control" data-date="<?=$date!=''?date('d/m/Y',strtotime($date)):''?>" data-date-format="dd/mm/yyyy" data-link-field="{{$ctrl->name }}_date_between_to" data-link-format="yyyy-mm-dd" style="padding:0px;">

            <div style="width:30px;float:left;padding-top:5px;padding-left:5px;">
                <span class="input-group-addon" style="padding:5px 0px 0px 5px; border:0px;background-color:#fff">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
            <div style="width:calc(100% - 70px); float:left; padding:1px 0px;overflow:hidden;height:90%">
                <input class="form-control yl-input-control" size="16" value="{{$date!=''?date('d/m/Y',strtotime($date)):''}}" readonly="" type="text" style="border:0px;background-color:#fff" placeholder="Đến" />
            </div>
            <div style="width:20px;float:right; padding-top:5px;margin-right:20px;">
                <span class=" input-group-addon" style="border:0px;background-color:#fff">
                    <span class="glyphicon glyphicon-remove"></span>
                </span>
            </div>

        </div>
        <input id="{{$ctrl->name }}_date_between_to" name="src[{{$ctrl->name }}][date_between][to]" value="{{$date!=''?$date:''}}" type="hidden" />
    </div>
</div>
@else
<div class="col-md-6 form-group mobo style-input-mobo">
        <label class="yl-input-control">{!!$ctrl->title !!}</label>
    <div class="col-md-9 input-box">
        <?php $date = @$src['from']?>
        <div class="input-group date form_date form-control " data-date="<?=$date!=''?date('d/m/Y',strtotime($date)):''?>" data-date-format="dd/mm/yyyy" data-link-field="{{$ctrl->name }}_date_between_from" data-link-format="yyyy-mm-dd" style="padding:0px; border: none !important;">

            <div style="width:20px;float:left;padding-top:5px">
                <span class="input-group-addon" style="padding:5px 0px 0px 5px; border:0px;background-color:#fff">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
            <div style="width:calc(100% - 60px); float:left; padding:1px 0px;overflow:hidden;height:90%">
                <input class="form-control yl-input-control" size="16" value="{{$date!=''?date('d/m/Y',strtotime($date)):''}}" readonly="" type="text" style="border:0px;background-color:#fff" placeholder="{{__('lang.tu')}}" />
            </div>
            <div style="width:20px;float:right; padding-top:5px;margin-right:20px;">
                <span class=" input-group-addon" style="border:0px;background-color:#fff">
                    <span class="glyphicon glyphicon-remove"></span>
                </span>
            </div>

        </div>
        <input id="{{$ctrl->name}}_date_between_from" name="src[{{$ctrl->name }}][date_between][from]" value="{{$date!=''?$date:''}}" type="hidden" />
    </div>
</div>
<div class="col-md-6 form-group mobo style-input-mobo">
        <label class="yl-input-control">{{__('lang.den')}}</label>
    <div class="col-md-9 input-box" >
        <?php $date = @$src['to']?>
        <div class="input-group date form_date form-control " data-date="<?=$date!=''?date('d/m/Y',strtotime($date)):''?>" data-date-format="dd/mm/yyyy" data-link-field="{{$ctrl->name }}_date_between_to" data-link-format="yyyy-mm-dd" style="padding:0px; border: none !important;">

            <div style="width:20px;float:left;padding-top:5px">
                <span class="input-group-addon" style="padding:5px 0px 0px 5px; border:0px;background-color:#fff">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
            <div style="width:calc(100% - 60px); float:left; padding-left:0px;padding-right:0px;overflow:hidden;height:90%">
                <input class="form-control yl-input-control" size="16" value="{{$date!=''?date('d/m/Y',strtotime($date)):''}}" readonly="" type="text" style="border:0px;background-color:#fff" placeholder="{{__('lang.den')}}" />
            </div>
            <div style="width:20px;float:right; padding-top:5px;margin-right:20px;">
                <span class=" input-group-addon" style="border:0px;background-color:#fff">
                    <span class="glyphicon glyphicon-remove"></span>
                </span>
            </div>

        </div>
        <input id="{{$ctrl->name }}_date_between_to" name="src[{{$ctrl->name }}][date_between][to]" value="{{$date!=''?$date:''}}" type="hidden" />
    </div>
</div>
@endif


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
