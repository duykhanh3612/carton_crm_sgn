@php
$third_module_table = $ctrl->att_table;
$tr = md::find_all($ctrl->att_table,$ctrl->att_key."='".@$row->{$ctrl->note}."'");
@endphp


<div class="form-group {{  $ctrl->width}} desktop ">
    <label>
        {{        $ctrl->title }} @if        (@$ctrl->validate==1)
          <span style="color:#ff0000">(*)</span>@endif
    </label>
    <div class="">
        <input type="text" class="form-control {{@$ctrl->validate==1?'validation':''}}  {{ @$ctrl->needed==1?'needed':''}}   <?=$lang?>"
               {{@$ctrl->read==1?"readonly":"name=".$third_module_table.'['.@$ctrl->name.$lang.']'}}
               id="<?=@$ctrl->name.$lang?>"  value="<?=Arr::get(@$tr,$ctrl->value.$lang)?>" placeholder=" {{        $ctrl->title }} " />
        <ul class="parsley-errors-list">
        </ul>
    </div>
</div>
