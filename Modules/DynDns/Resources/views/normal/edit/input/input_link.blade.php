@php
$name_id = str_replace(['[', ']', '#'], ['', '', ''], @$ctrl->name . $lang);
@endphp
<div class="form-group {{ $ctrl->width }} input_link "data-title="input_link">
    <label>
        {{ $ctrl->title }} @if (@$ctrl->validate == 1)
            <span style="color:#ff0000">(*)</span>
        @endif
    </label>
    <div class="">
        <div class="input-group mb-3">
            <input type="text"
            class="form-control {{ @$ctrl->validate == 1 ? 'validation' : '' }}  {{ @$ctrl->needed == 1 ? 'needed' : '' }}   <?= $lang ?>"
            {{ @$ctrl->read == 1 ? 'readonly' : 'name=' . @$ctrl->name . $lang }} id="<?= @$name_id ?>"
            value="<?= @$row->{$ctrl->value . $lang} ?>" placeholder="{{ $ctrl->att_table }}" />
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-link" id="{{$name_id}}_link" style="cursor: pointer"></i></span>
              </div>
          </div>


        <ul class="parsley-errors-list" style="display:none">
            <?= @$ctrl->note ?>
        </ul>
        <style type="text/css">
        .input_link .input-group-text{
            background: transparent;
            border: 0;
        }
        </style>
        <script>
            $("#{{$name_id}}_link").click(function() {
                let link = $("#{{$name_id}}").val();
                window.open(link, '_blank');
            });
        </script>
    </div>
</div>
