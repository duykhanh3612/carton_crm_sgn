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
        <div class="input-group">
            <input type="text" class="form-control {{@$ctrl->validate==1?'validation':''}}  {{ @$ctrl->needed==1?'needed':''}}   <?=$lang?>"
                {{@$ctrl->read==1?"readonly":"name=".$third_module_table.'['.@$ctrl->name.$lang.']'}}
               id="<?=@$ctrl->name.$lang?>"   value="<?=@$tr->{$ctrl->value.$lang}?>" placeholder="{{ $ctrl->title }}" data-callback="set_value_<?=@$ctrl->name.$lang?>" />
            <div class="input-group-append">
                <span  class="btn" style="cursor:pointer">
                    <i class="fa fa-angle-double-down" id="btn_date_<?=@$ctrl->name.$lang?>_check"></i>
                </span>
                <script>
                    $('#btn_date_<?=@$ctrl->name.$lang?>_check').click(function () {                        
                        set_value_<?=@$ctrl->name.$lang?>();
                    });
                    function set_value_<?=@$ctrl->name.$lang?>() {
                        var e = $('#<?=@$ctrl->name.$lang?>');                        
                        var value = e.val();
                        value = value.replace("Rao bán Tháng ", "T");
                        value = value.replace("Rao bán ", "");
                        value = value.replace("Đã bán ", "");
                        value = value.replace(/\s/g, '');

                        if (check_type(value) == 1) {
                            var _d = value.split('/');
                            var month = _d[0].replace('T', '');
                            e.val(_d[1].trim() + '-' + (month.length == 1 ? '0' + month : month) + '-01');
                        }
                    }
                   function check_type(email) {
                      var regex = /^T([a-zA-Z0-9_.+-])+\/(([a-zA-Z0-9-]))+$/;
                       if (regex.test(email))
                           return 1
                       else 0;
                    }
                </script>
            </div>
        </div>

        <ul class="parsley-errors-list">
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
        @if(@$ctrl->validate==1) <span style="color:#ff0000">(*)</span>@endif
    </label>
    <div class="input-box">
        <input type="text" class="form-control {{@$ctrl->validate==1?'validation':''}}  {{ @$ctrl->needed==1?'needed':''}}   title<?=$lang?> nd" 
               {{@$ctrl->read==1?"readonly":"name=".@$ctrl->name.$lang}} id="<?=@$ctrl->name.$lang?>"  
                value="<?=@$tr->{$ctrl->value.$lang}?>" placeholder="{{$ctrl->att_table}}" />
    </div>
</div>
@endif
