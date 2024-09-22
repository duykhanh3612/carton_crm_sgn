<?php
 $arr = explode(',',$ctrl->att_table);
 $arr_value =      explode(',', @$row->{$ctrl->value}  );
?>
<div class="form-group {{$ctrl->width}}">
    <label><?=$ctrl->title?> @if(@$ctrl->validate==1) <span style="color:#ff0000">(*)</span> @endif</label> 
    <div>
        <input value="{{@$row->{$ctrl->value} }}" id="{{@$ctrl->name.$lang}}" {{@$ctrl->read==1?"readonly disabled":"name=".@$ctrl->name.$lang}} class="form-control {{@$ctrl->validate==1?'validation':''}} {{@$ctrl->needed==1?'needed':''}} " type="hidden" />
        <select class="form-control selectpicker"  multiple >
            <?php foreach($arr as $a):?>
            <option value="{{$a}}" {{in_array($a,$arr_value)?'selected=selected':''}}><?=$a?></option>
            <?php endforeach?>
        </select>
        <ul class="parsley-errors-list"></ul>
        <link rel="stylesheet" type="text/css" href="{{env_host}}/public/dashboard/adminui/assets/css/select2.min.css" />
        <link rel="stylesheet" type="text/css" href="{{env_host}}/public/dashboard/adminui/assets/css/bootstrap-select.min.css" />

        <!-- slimscroll js -->
        <script type="text/javascript" src="{{env_host}}/public/dashboard/adminui/assets/js/vendor/jquery.slimscroll.js"></script>
        <script src="{{env_host}}/public/dashboard/adminui/assets/js/vendor/select2.min.js"></script>
        <script src="{{env_host}}/public/dashboard/adminui/assets/js/vendor/bootstrap-select.min.js"></script>
        <script>

            $('.selectpicker').selectpicker({
                nonSelectedText:'Services',
                style: 'defaultSelectDrop',
                size: 4
            });

            $(".selectpicker").on("change", function (value) {
                var This = $(this);
                var selectedD = $(this).val();
                $('#{{@$ctrl->name.$lang}} ').val(selectedD);
            });
        </script>
    </div>
</div>
