@if(!h::isMobile())
<div class="form-group {{$ctrl->width}} desktop">
    <label>
        {{ $ctrl->title }} @if(@$ctrl->validate==1)
        <span style="color:#ff0000">(*)</span>@endif
    </label>
    <div class="">
        <input type="number" class="form-control {{ @$ctrl->validate==1?'validation':''}}  money_<?=@$ctrl->name.$lang?> title<?=$lang?>" id="<?=@$ctrl->name.$lang?>" {{@$ctrl->read==1?"readonly":""}} value="<?=@$row->{$ctrl->value.$lang}?>" data-type="number" autocomplete="off" />
        <input type="hidden" class="form-control title<?=$lang?>" id="<?=@$ctrl->name.$lang?>_hide" {{@$ctrl->read==1?"readonly":'name='.@$ctrl->name.$lang}}  value="<?=@$row->{$ctrl->value.$lang}?>" autocomplete="off" />
        <ul class="parsley-errors-list" id="parsley-id-4995">
            <?=@$ctrl->att_where?>
        </ul>
    </div>
    <script src="../../plugin/mask/jquery.mask.min.js" type="text/javascript"></script>
    <script>
        $('.money_<?=@$ctrl->name.$lang?>').mask('###', { reverse: true });
        $('#{{@$ctrl->name.$lang}}').on('change', function () {
            var value = $(this).val().replace(new RegExp(',', 'g'), '');
            $('#{{@$ctrl->name.$lang}}_hide').val(value);
        })
    </script>
</div>
@else
<div class="form-group {{$ctrl->width}} mobo style-input-mobo">
    <ul class="parsley-errors-list" id="parsley-id-4995">
        <?=@$ctrl->note?>
    </ul>
    <label>
        {{ $ctrl->title }} @if(@$ctrl->validate==1)
        <span style="color:#ff0000">(*)</span>@endif
    </label>
    <div class="input-box">
        <input type="number" class="form-control {{ @$ctrl->validate==1?'validation':''}}  money_<?=@$ctrl->name.$lang?> title<?=$lang?> nd" id="<?=@$ctrl->name.$lang?>" {{@$ctrl->read==1?"readonly":""}} value="<?=@$row->{$ctrl->value.$lang}?>" data-type="number" autocomplete="off" />
        <input type="hidden" class="form-control title<?=$lang?>" id="<?=@$ctrl->name.$lang?>_hide" {{@$ctrl->read==1?"readonly":'name='.@$ctrl->name.$lang}}  value="<?=@$row->{$ctrl->value.$lang}?>" autocomplete="off" />

    </div>

    <script src="../../plugin/mask/jquery.mask.min.js" type="text/javascript"></script>
    <script>
        $('.money_<?=@$ctrl->name.$lang?>').mask('###', { reverse: true });
        $('#{{@$ctrl->name.$lang}}').on('change', function () {
            var value = $(this).val().replace(new RegExp(',', 'g'), '');
            $('#{{@$ctrl->name.$lang}}_hide').val(value);
        })
    </script>
</div>
@endif
