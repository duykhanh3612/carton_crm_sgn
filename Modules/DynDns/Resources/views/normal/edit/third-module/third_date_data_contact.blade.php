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
               id="<?=@$ctrl->name.$lang?>"   value="<?=@$tr->{$ctrl->value.$lang}?>" placeholder="{{ $ctrl->title }}" data-callback="data_contact_check<?=@$ctrl->name.$lang?>" />
            <div class="input-group-append">
                <span id="btn_data_contact_check<?=@$ctrl->name.$lang?>" class="btn" style="cursor:pointer;padding:10px;background:#ccc">
                    <i class="fa fa-check"></i>
                </span>
                <script>
                    $('#btn_data_contact_check<?=@$ctrl->name.$lang?>').click(function () {                        
                        data_contact_check<?=@$ctrl->name.$lang?>();
                    });
                    function data_contact_check<?=@$ctrl->name.$lang?>() {
                        var e = $('#<?=@$ctrl->name.$lang?>');
                        var value = e.val();
                        value = value.replace('Tel. ', '');
                        var e_s = value.split('-');

                        if (check_phone(e_s[0])) {
                            $('#<?=$ctrl->att_join?>').val(e_s[0].replace(/\s/g, ''));
                            if (typeof (e_s[1]) !='undefined')
                                $('#<?=@$ctrl->name.$lang?>').val(e_s[1].replace('-', '').trim());
                        }

                        if (check_phone(e_s[1])) {
                            $('#<?=$ctrl->att_join?>').val(e_s[1].replace(/\s/g, ''));
                            $('#<?=@$ctrl->name.$lang?>').val(e_s[0].replace('-', '').trim());
                        }
                            
                   }
                   function check_phone(email) {
                      var regex = /^([/ /0-9_.+-])+$/;
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
