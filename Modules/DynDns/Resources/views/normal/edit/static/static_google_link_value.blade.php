@if(!h::isMobile())
<div class="form-group {{  $ctrl->width}} desktop ">
    <div class="">
        <a href="https://www.google.com/search?&q={{@$row->{@$ctrl->value} }}" target="_blank">{{$ctrl->title}}</a>
    </div>
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
                value="<?=@$row->{$ctrl->value.$lang}?>" placeholder="{{$ctrl->att_table}}" />
    </div>
</div>
@endif
