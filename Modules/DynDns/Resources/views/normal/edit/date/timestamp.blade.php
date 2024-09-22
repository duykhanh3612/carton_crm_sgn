
<div class="<?=@$ctrl->width?> form-group" title="timestamp">
    <?php //$date = @$row->{$ctrl->value}!=''?@$row->{$ctrl->value}:date('Y-m-d')
    $dateTimestamp = new DateTime();
    if(@$row->{$ctrl->value}!='')
        $dateTimestamp->setTimestamp(@$row->{$ctrl->value});
    $date =  $dateTimestamp->format('Y-m-d');
    ?>
    <label >
        <?=$ctrl->title?>
    </label>
    <div>
        <div class="input-group date form_date " data-date="<?=date('d-m-Y',strtotime($date))?>" data-date-format="dd-mm-yyyy" data-link-field="label_<?=$ctrl->name?>" data-link-format="yyyy-mm-dd">
            <input class="form-control" id="value_<?=$ctrl->name?>"  value="<?=date('d-m-Y',strtotime($date))?>" type="text" onchange="get_timestamp_<?=$ctrl->name?>_set()" />
            <span class="input-group-addon">
                <span class="fa fa-times"></span>
            </span>
            <span class="input-group-addon">
                <span class="fa fa-calendar"></span>
            </span>
        </div>
        <input id="label_<?=$ctrl->name?>" name="label_<?=$ctrl->name?>" type="hidden" />
        <input id="<?=$ctrl->name?>" name="<?=$ctrl->name?>" type="hidden" value="{{ @$row->{$ctrl->value} }}" />
    </div>

    <script>
            function get_timestamp_<?=$ctrl->name?>_set()
            {
                var value = $('#value_{{$ctrl->name}}').val();
                $.get('{{url("admin/ajax/timestamp_vn")}}/' + value, function (data) {
                    $('#{{$ctrl->name}}').val(data);
                });
            }
    </script>

</div>
