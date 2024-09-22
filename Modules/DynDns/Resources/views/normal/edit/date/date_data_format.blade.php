@if(!h::isMobile())
<div class="form-group {{  $ctrl->width}} desktop ">
    <label>
        {{        $ctrl->title }} @if        (@$ctrl->validate==1)
        <span style="color:#ff0000">(*)</span>@endif
    </label>
    <div class="">
        <div class="input-group">
            <input type="text" class="form-control {{@$ctrl->validate==1?'validation':''}}  {{ @$ctrl->needed==1?'needed':''}}   <?=$lang?>"
                {{@$ctrl->read==1?"readonly":"name=".@$ctrl->name.$lang}} id="<?=@$ctrl->name.$lang?>"   value="<?=@$row->{$ctrl->value.$lang}?>" placeholder="{{$ctrl->att_table}}" />            <div class="input-group-append">
                <span id="btn_check_data" class="btn" style="cursor:pointer">
                    <i class="fa fa-arrow-down"></i>
                </span>
                <span id="btn_date_check" class="btn" style="cursor:pointer">
                    <i class="fa fa-angle-double-down"></i>
                </span>
                <script>
                    $('#btn_check_expand').click(function () {
                        $('#panel_expand').toggle();
                    });
                </script>
            </div>
        </div>
        <ul class="parsley-errors-list">
            <?=@$ctrl->note?>
        </ul>
    </div>
</div>
@else
<div class="form-group {{  $ctrl->width}} mobo style-input-mobo">
    <ul class="parsley-errors-list">
        <?=@$ctrl->note?>
    </ul>
    <label>
        {{ $ctrl->title }}
        @if(@$ctrl->validate==1)
        <span style="color:#ff0000">(*)</span>@endif
    </label>
    <div class="input-box">
        <input type="text" class="form-control {{@$ctrl->validate==1?'validation':''}}  {{ @$ctrl->needed==1?'needed':''}}   title<?=$lang?> nd"
            {{@$ctrl- />read==1?"readonly":"name=".@$ctrl->name.$lang}} id="<?=@$ctrl->name.$lang?>"
                value="<?=@$row->{$ctrl->value.$lang}?>" placeholder="{{$ctrl->att_table}}" />
    </div>
</div>
@endif
