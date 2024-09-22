<?php
 $arr = explode(',',$ctrl->att_table);
?>
@if(!h::isMobile())
<div class="form-group {{$ctrl->width}} desktop">
    <label><?=$ctrl->title?>@if(@$ctrl->validate==1)
<span style="color:#ff0000">(*)</span> @endif</label>
    <div style="padding-top:10px;">
        <?php foreach($arr as $k=>$a):?>
        <input id="box{{$k}}" type="checkbox" value="{{$a}}" name="{{@$ctrl->name}}" />
        <label for="box{{$k}}">{{$a}}</label>
        <?php endforeach?>
        <ul class="parsley-errors-list"></ul>
        <script>
        @if(@$row->{$ctrl->value} =='')
                         $('input[name="{{$ctrl->name}}"][value="{{$arr[0]}}"]').attr('checked', 'checked');
        @else
        $('input[name="{{$ctrl->name}}"][value="{{@$row->{$ctrl->value} }}"]').attr('checked', 'checked');
        @endif
        </script>
    </div>
</div>
@else
<div class="form-group {{$ctrl->width}} mobo style-input-mobo">
    <label class="col-sm-2 form-control-label">
        <?=$ctrl->title?>@if(@$ctrl->validate==1)
        <span style="color:#ff0000">(*)</span> @endif
    </label>
    <div style="padding-top:10px;" class="input-box col-sm-10">
        <?php foreach($arr as $a):?>

        <input type="radio" class="has-value" {{@$ctrl->read==1?"readonly disabled":"" }}   value="{{$a}}" name="{{@$ctrl->name}}" /> {{$a }}
        <?php endforeach?>
        <script>
        @if(@$row->{$ctrl->value} =='')
                         $('input[name="{{$ctrl->name}}"][value="{{$arr[0]}}"]').attr('checked', 'checked');
        @else
        $('input[name="{{$ctrl->name}}"][value="{{@$row->{$ctrl->value} }}"]').attr('checked', 'checked');
        @endif
        </script>
        <style type="text/css">
            @media (max-width: 640px)
            {
              .form-group input {
                width: auto !important;
            }
        </style>
    </div>
</div>
@endif

<style type="text/css">
        /*** custom checkboxes ***/

input[type=checkbox] { display:none; } /* to hide the checkbox itself */
input[type=checkbox] + label:before {
  font-family: FontAwesome;
  display: inline-block;
}

input[type=checkbox] + label:before { content: "\f00d "; } /* unchecked icon */
input[type=checkbox] + label:before { letter-spacing: 10px; } /* space between checkbox and label */

input[type=checkbox]:checked + label:before { content: "\f00c"; } /* checked icon */
input[type=checkbox]:checked + label:before { letter-spacing: 5px; } /* allow space for check mark */
</style>
