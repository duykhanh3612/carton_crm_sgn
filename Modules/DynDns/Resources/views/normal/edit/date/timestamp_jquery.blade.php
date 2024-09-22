
<div class="form-group">
    <?php //$date = @$row->{$ctrl->value}!=''?@$row->{$ctrl->value}:date('Y-m-d')
    $dateTimestamp = new DateTime();
    $dateTimestamp->setTimestamp(@$row->{$ctrl->value});
    $date =  $dateTimestamp->format('Y-m-d');
    ?>
    <label for="dtp_input2" class="control-label">
        <?=$ctrl->title?>
    </label>
    <div class="input-group date form_date form-control">
        <input class="form-control" size="16" value="<?=date('d/m/Y',strtotime($date))?>" id="datepicker" />
    </div>
    <input id="label_<?=$ctrl->name?>" name="label_<?=$ctrl->name?>" type="hidden" />
    <script>
              $( function() {
                $( "#datepicker" ).datepicker();
              } );
    </script>
    <br />
</div>