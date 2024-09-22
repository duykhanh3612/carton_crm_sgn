@php
$third_module_table = $ctrl->att_table;
$tr = md::find($ctrl->att_table,$ctrl->att_key."='".@$row->{$ctrl->note}."'");

$name = 'third_table_direct[]['.$third_module_table.']['.$ctrl->att_key.'#'.@$row->{$ctrl->note}.'#'.$ctrl->att_field.'#'.$ctrl->att_foreign.'#'.@$tr->{$ctrl->att_foreign}.']';

//$name = $third_module_table.'['.@$ctrl->name.$lang.']';
@endphp


<div class="form-group {{  $ctrl->width}} desktop " tilte="third_module_direct_text">
    <label>
        {{        $ctrl->title }} @if        (@$ctrl->validate==1)
        <span style="color:#ff0000">(*)</span>@endif
    </label>
    <div class="">
        <input type="text" class="form-control {{@$ctrl->validate==1?'validation':''}}  {{ @$ctrl->needed==1?'needed':''}}   <?=$lang?>"
            {{@$ctrl->read==1?"readonly":"name=".$name}}
               id="<?=@$ctrl->name.$lang?>"   value="<?=@$tr->{$ctrl->value.$lang}?>" placeholder=" {{        $ctrl->title }} " />
        <ul class="parsley-errors-list"></ul>
    </div>
</div>
