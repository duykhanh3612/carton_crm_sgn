@php
    $name_id = str_replace(array('[',']',"#"),array('','',''),@$ctrl->name.$lang);
    $date = @$row->{$ctrl->value}!=''?@$row->{$ctrl->value}:date('Y-m-d');

    $today = $ctrl->att_table =='null' && ($date=='0000-00-00' || @$row->{$ctrl->value}=='')?'':date('d/m/Y',strtotime($date));
@endphp

<div class="form-group {{$ctrl->width}}" data-title="date_dd_mm_yyyy">
    <label>
        <?=$ctrl->title?>
    </label>
    <div>
        <div class="input-group date form_date" style="max-width:300px" data-date="{{$today}}" data-date-format="dd/mm/yyyy" data-link-field="<?=$ctrl->name?>" data-link-format="yyyy-mm-dd">
            <input class="form-control" id="<?=$name_id?>_panel" size="16" value="{{$today}}" type="text" />
            <span class="input-group-addon">
                <span class="fa fa-minus"></span>
            </span>
            <span class="input-group-addon">
                <span class="fa fa-calendar"></span>
            </span>
        </div>
        <input id="<?=$name_id?>" name="<?=$ctrl->name?>" value="<?=$ctrl->att_table=='null' && ($date=='0000-00-00' || @$row->{$ctrl->value}=='')?'':date('Y-m-d',strtotime($date))?>" type="hidden" />
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
        forceParse: 0
    });
        $(document).ready(function () {
            $('#<?=$name_id?>_panel').change(function () {
                var date_value = $(this).val();
                var return_value = date_value.split("/");
                $('#<?=$name_id?>').val(return_value[2] + '-' + return_value[1] + '-' + return_value[0]);
            });
        });

    </script>

</div>

