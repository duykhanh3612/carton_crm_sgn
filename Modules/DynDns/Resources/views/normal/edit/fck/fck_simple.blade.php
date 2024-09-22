<div class="form-field {{$ctrl->width}}">
    <label>
        {{$ctrl->title}}
    </label>
    <div>
        <textarea name="<?=@$ctrl->{'name'}.$lang?>" id='<?php echo sprintf(@$ctrl->name."_%s_content", $lang); ?>'
            data-editor='<?php echo sprintf(@$ctrl->name."_%s_content", $lang); ?>'
            rows="10" class="textarea small full">
            <?=@$row->{$ctrl->value.$lang}?>
        </textarea>
    </div>

</div> 
@push('script')
<script type="text/javascript" src='{{env_host}}public/plugin/ckeditor/ckeditor.js'></script>
<script>
    $('*[data-editor]').each(function () {
        var id = $(this).attr('data-editor');
        CKEDITOR.editorConfig = function (config) {
            config.enterMode = CKEDITOR.ENTER_DIV // pressing the ENTER Key puts the <br/> tag
            config.shiftEnterMode = CKEDITOR.ENTER_P; //pressing the SHIFT + ENTER Keys puts the <p> tag
            config.autoParagraph = false;
        };
        CKEDITOR.replace(id);

    });
</script>
@endpush

