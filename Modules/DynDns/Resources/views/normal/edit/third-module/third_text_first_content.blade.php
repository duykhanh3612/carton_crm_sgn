@php
$third_module_table = $ctrl->att_table;
$tr = md::find($ctrl->att_table,$ctrl->att_key."='".@$row->{$ctrl->note}."'")
@endphp
@if(!h::isMobile())

<div class="form-group {{  $ctrl->width}} desktop ">
    <label>
        {{        $ctrl->title }} @if        (@$ctrl->validate==1)
          <span style="color:#ff0000">(*)</span>@endif
    </label>
    <div class="">
        <input type="text" class="form-control {{@$ctrl->validate==1?'validation':''}}  {{ @$ctrl->needed==1?'needed':''}}   <?=$lang?>"
               {{@$ctrl->read==1?"readonly":"name=".$third_module_table.'['.@$ctrl->name.$lang.']'}}
               id="<?=@$ctrl->name.$lang?>"   value="<?=@$tr->{$ctrl->value.$lang}?>" placeholder=" {{        $ctrl->title }} " data-callback="text_first_content_<?=@$ctrl->name.$lang?>" />
        <ul class="parsley-errors-list"></ul>
    </div>
    <script>

            function text_first_content_<?=@$ctrl->name.$lang?>() {
                var value = $('#{{$ctrl->att_join}}').val();
                value = value.replace('P.', 'Phường ');
                value = value.replace('p.', 'Phường ');
                value = value.replace('Q.', 'Quận ');
                value = value.replace('q.', 'Quận ');
                var str = value.split('.');
                $('#<?=@$ctrl->name.$lang?>').val(str[0]);
            }


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
