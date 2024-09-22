<?php
 $arr = explode(',',$ctrl->att_table);
?>
@if(!h::isMobile())
<div class="form-group {{$ctrl->width}} desktop">
    <label><?=$ctrl->title?>@if(@$ctrl->validate==1)
<span style="color:#ff0000">(*)</span> @endif</label>
    <div style="padding-top:10px;">
        <?php foreach($arr as $a):?>
        <input type="radio" {{@$ctrl->read==1?"readonly disabled":"" }}   value="{{$a}}" name="{{@$ctrl->name}}" /> {{$a }}
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
