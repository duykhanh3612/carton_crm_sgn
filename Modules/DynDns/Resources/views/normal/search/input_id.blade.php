
<div class="col-md-6 form-group last pad5_top">
    <label class="col-md-3  form-control-label" style="white-space:nowrap;text-align:right;">{!!$ctrl->title !!}</label>

        <div class="col-md-9" >
            <input type="text" placeholder="{!!$ctrl->title !!}" class="form-control md_line src_{{ $ctrl->name }}_view" value="<?=@$src['none']!=''?$ctrl->note.@$src['none']:@$src['none']?>" style="padding-right:0px" />
            <input type="hidden" placeholder="{!!$ctrl->title !!}" class="form-control md_line src_{{ $ctrl->name }}" name="src[{{ $ctrl->name }}][like][none]" value="<?=@$src['none']?>" style="padding-right:0px" />
            <script>
                $('.src_{{ $ctrl->name }}_view').on('change', function () {
                    $('.src_{{ $ctrl->name }}').val($(this).val().toLowerCase().replace('{{strtolower($ctrl->note)}}', ''));
                })
            </script>
       </div>
</div>  