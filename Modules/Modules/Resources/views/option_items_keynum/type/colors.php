<style>
    .input-color{
        float: left;
        height: 100%;
    }
    .input-color:nth-child(1){
        width:70%;
    }
    .input-color:nth-child(2){
        width:30%;
    }
    .input-color .label-color{
        width: 80%;
        border-radius: 4px;
        height: 100%;
        margin: 0 1rem;
        border:1px solid #ccc;
        box-sizing: border-box;
    }
</style>
<?php foreach($options as $i => $item){ ?>
<tr class="highlight" id="<?= $i ?>">
    <td><input type="text" name="Options[<?= $i ?>][name]" value="<?= $item->name ?>" class="form-control input-background-colors" /></td>
    <td>
        <div class="d-flex">
            <div class="input-color">
                <input type="number" name="Options[<?= $i ?>][key]" value="<?= $item->key ?>" class="form-control" />
            </div>
            <!-- <div class="input-color">
                <label class="label-color" style="background:<?= $item->name ?>"></label>
            </div> -->
            <div class="input-group colorpicker-component">
                <input name="options[0][color]" type="text" value="#00ff11" class="color-background color-view form-control">
                <span class="input-group-addon"><input class="color-picker" type="color" value="#00ff11"></span>
            </div>
            <div class="input-group colorpicker-component">
                <input name="options[0][color_text]" type="text" value="#000000" class="color-text color-view form-control">
                <span class="input-group-addon"><input class="color-picker" type="color" value="#000000"></span>
            </div>
        </div>
    </td>
    <td class="center"><a href="javascript:;" class="move-option" style="font-size: 18px;"><i class="glyph-icon fa fa-arrows"></i></a></td>
    <td class="center"><a href="javascript:;" class="remove-option" style="font-size: 18px;"><i class="glyph-icon fa fa-remove"></i></a></td>
</tr>
<?php } ?>
<script>
    $("#mainTable-option_items_keynum").on("blur",".input-background-colors",function(){
        var value = $(this).val();
        var tr = $(this).closest("tr");
        tr.find(".label-color").css("background",value);
        console.log({value});
    })

    $(document).on('change', '.colorpicker-component .color-view', function(){
    const colorView = $(this).val(),
        colorPicker = $(this).closest('.colorpicker-component').find('.color-picker').val();
    if(isValidColor(colorView)) {
        $(this).closest('.colorpicker-component').find('.input-group-addon input').val(colorView);
    }
    updateColorPreview($(this).closest('tr'));
}).on('input', '.colorpicker-component .input-group-addon input', function(){
    const colorPicker = $(this).val();
    if(isValidColor(colorPicker)) $(this).closest('.colorpicker-component').find('.color-view').val(colorPicker);
    updateColorPreview($(this).closest('tr'));
}).on('input', '.color-name', function() {
    updateColorPreview($(this).closest('tr'));
});
</script>
