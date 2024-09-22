@php
$third_module_table = $ctrl->att_table;
$tr = md::find($ctrl->att_table,$ctrl->att_key."='".@$row->{$ctrl->note}."'")
@endphp
@if(!h::isMobile())

<div class="form-group {{$ctrl->width}} desktop" data-title="third_module_input_number">
    <label>
        {{ $ctrl->title }} @if(@$ctrl->validate==1)
        <span style="color:#ff0000">(*)</span>@endif
    </label>
    <div class="">
        <input type="text" placeholder="<?=@$ctrl->title?>" class="form-control {{ @$ctrl->validate==1?'validation':''}}  money_<?=@$ctrl->name.$lang?> title<?=$lang?>" id="<?=@$ctrl->name.$lang?>" {{@$ctrl->read==1?"readonly":""}} value="<?=@$tr->{$ctrl->value.$lang}?>" data-type="number" autocomplete="off" />
        <input type="hidden" class="form-control title<?=$lang?>" id="<?=@$ctrl->name.$lang?>_hide"
            {{@$ctrl->read==1?"readonly":"name=".$third_module_table.'['.@$ctrl->name.$lang.']'}}  value="<?=@$tr->{$ctrl->value.$lang}?>" autocomplete="off" />
        <ul class="parsley-errors-list" id="parsley-id-4995"></ul>
    </div>
    <script src="{{env_host}}/public/plugin/mask/jquery.mask.min.js" type="text/javascript"></script>
    <script>
        $('.money_<?=@$ctrl->name.$lang?>').mask('#,##0', { reverse: true });
        $('#{{@$ctrl->name.$lang}}').on('change', function () {
            var value = $(this).val().replace(new RegExp(',', 'g'), '');
            $('#{{@$ctrl->name.$lang}}_hide').val(value);
        })


    </script>
</div>
@else
<div class="form-group {{  $ctrl->width}} mobo style-input-mobo">
    <ul class="parsley-errors-list">
        <?=@$ctrl->note?>
    </ul>
    <label>
        {{ $ctrl->title }}
        @if(@$ctrl->validate==1) <span style="color:#ff0000">(*)</span>@endif
    </label>
    <div class="input-box">
        <input type="text" class="form-control {{@$ctrl->validate==1?'validation':''}}  {{ @$ctrl->needed==1?'needed':''}}   title<?=$lang?> nd"
               {{@$ctrl->read==1?"readonly":"name=".@$ctrl->name.$lang}} id="<?=@$ctrl->name.$lang?>"
                value="<?=@$tr->{$ctrl->value.$lang}?>" placeholder="{{$ctrl->att_table}}" />
    </div>
</div>
@endif
