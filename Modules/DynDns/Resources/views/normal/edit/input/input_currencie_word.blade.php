@php
$name_id = str_replace(array('[',']',"#"),array('','',''),@$ctrl->name.$lang);
@endphp
@if(!h::isMobile())
<div class="form-group {{$ctrl->width}} desktop">
    <label>
        {{ $ctrl->title }} @if(@$ctrl->validate==1)
        <span style="color:#ff0000">(*)</span>@endif
    </label>
    <div class="">
        <input type="text" class="form-control {{ @$ctrl->validate==1?'validation':''}}  money title<?=$lang?>" id="<?=@$name_id?>_view" {{@$ctrl- />read==1?"readonly":""}} value="<?=@$row->{$ctrl->value.$lang}?>" data-type="number" autocomplete="off" />
        <input type="hidden" class="form-control title<?=$lang?>" id="<?=$name_id?>" {{@$ctrl- />read==1?"readonly":'name='.@$ctrl->name.$lang.''}} value="<?=@$row->{$ctrl->value.$lang}?>" autocomplete="off" />
        <ul class="parsley-errors-list" id="parsley-id-4995"><?=@$ctrl->note?></ul>
    </div>
    <script src="../../plugin/mask/jquery.mask.min.js" type="text/javascript"></script>
    <script>
        $('.money').mask('#,##0', { reverse: true });
        $('#{{@$name_id}}_view').on('keyup', function () {
            var value = $(this).val().replace(new RegExp(',', 'g'), '');
            $('#{{@$name_id}}').val(value);
        })
    </script>
</div>
@else
<div class="form-group {{$ctrl->width}} mobo style-input-mobo">
    <ul class="parsley-errors-list" id="parsley-id-4995"><?=@$ctrl->note?></ul>
    <label>
        {{ $ctrl->title }} @if(@$ctrl->validate==1)
        <span style="color:#ff0000">(*)</span>@endif
    </label>
    <div class="input-box">
        <input type="text" class="form-control {{ @$ctrl->validate==1?'validation':''}}  money title<?=$lang?> nd" id="<?=@$ctrl->name.$lang?>_view" {{@$ctrl->read==1?"readonly":""}} value="<?=@$row->{$ctrl->value.$lang}?>" data-type="number" autocomplete="off" />
        <input type="hidden" class="form-control title<?=$lang?>" id="<?=@$ctrl->name.$lang?>" {{@$ctrl->read==1?"readonly":'name='.@$ctrl->name.$lang.''}} value="<?=@$row->{$ctrl->value.$lang}?>" autocomplete="off" />
        
    </div>
    <script src="../../plugin/mask/jquery.mask.min.js" type="text/javascript"></script>
    <script>
        $('.money').mask('#,##0', { reverse: true });
        $('#{{@$ctrl->name.$lang}}_view').on('keyup', function () {
            var value = $(this).val().replace(new RegExp(',', 'g'), '');
            $('#{{@$ctrl->name.$lang}}').val(value);
        })
    </script>
</div>
@endif
