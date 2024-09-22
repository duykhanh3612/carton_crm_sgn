<?php
 $arr_value =      explode(',', @$row->{$ctrl->value}  );

 $table = @$ctrl->att_table_prefix==1?@$admin_group->prefix."_". $ctrl->att_table:$ctrl->att_table;
?>


@if(!h::isMobile())
<div class="form-group {{$ctrl->width}} desktop z-high">
    <label><?=@$ctrl->title?> @if(@$ctrl->validate==1) <span style="color:#ff0000">(*)</span> @endif</label>
    <div class="z-high">
        <input value="{{@$row->{$ctrl->value} }}" id="{{@$ctrl->name.$lang}}" {{@$ctrl->read==1?"readonly disabled":"name=".@$ctrl->name.$lang}} class="form-control {{@$ctrl->validate==1?'validation':''}} {{@$ctrl->needed==1?'needed':''}} " type="hidden" />
        <select class="form-control selectpicker" multiple>
            <?php foreach(App\Model\md::find_all($table) as $a):?>
            <option value="{{@$a->{$ctrl->att_key} }}"  {{in_array(@$a->{$ctrl->att_key},$arr_value)?'selected=selected':''}}>
            <?=$a->{$ctrl->att_field.(@$ctrl->att_field_language?"_"."vn":"")}?></option>
            <?php endforeach?>
        </select>
        <ul class="parsley-errors-list"></ul>
        <link rel="stylesheet" type="text/css" href="{{env_host}}public/dashboard/adminui/assets/css/select2.min.css" />
        <link rel="stylesheet" type="text/css" href="{{env_host}}public/dashboard/adminui/assets/css/bootstrap-select.min.css" />

        <!-- slimscroll js -->
        <script type="text/javascript" src="{{env_host}}public/dashboard/adminui/assets/js/vendor/jquery.slimscroll.js"></script>
        <script src="{{env_host}}public/dashboard/adminui/assets/js/vendor/select2.min.js"></script>
        <script src="{{env_host}}public/dashboard/adminui/assets/js/vendor/bootstrap-select.min.js"></script>
        <style type="text/css">
        .tab-content,.dropdown-menu,.z-high{
            z-index:999999999999999999999999999 !important;
        }
        </style>
        <script>

            $('.selectpicker').selectpicker({
                nonSelectedText:'Services',
                style: 'defaultSelectDrop',
                size: 8
            });
            //$('.selectpicker').selectpicker('val', [{{@$row->{$ctrl->value} }}]);
            $(".selectpicker").on("change", function (value) {
                var This = $(this);
                var selectedD = $(this).val();
                $('#{{@$ctrl->name.$lang}}').val(selectedD);
            });
        </script>
    </div>
</div>
@else
<div class="form-group {{$ctrl->width}} mobo style-input-mobo style-input-mobo">
    <ul class="parsley-errors-list"></ul>
    <label><?=@$ctrl->title?> @if(@$ctrl->validate==1) <span style="color:#ff0000">(*)</span> @endif</label>
    <div class="input-box">
        <input value="{{@$row->{$ctrl->value} }}" id="{{@$ctrl->name.$lang}}" {{@$ctrl->read==1?"readonly disabled":"name=".@$ctrl->name.$lang}} class="form-control {{@$ctrl->validate==1?'validation':''}} {{@$ctrl->needed==1?'needed':''}} " type="hidden" />
        <select class="form-control selectpicker nd style-input-mobo-select-list" multiple><?php foreach(App\Model\md::find_all($ctrl->att_table) as $a):?>
            <option value="{{$a->{$ctrl->att_key} }}" {{in_array($a,$arr_value)?'selected=selected':''}}><?=$a->{$ctrl->att_field}?></option><?php endforeach?>
        </select>

        <link rel="stylesheet" type="text/css" href="../assets/css/select2.min.css" />
        <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap-select.min.css" />
        <!-- slimscroll js -->
        <script type="text/javascript" src="../assets/js/vendor/jquery.slimscroll.js"></script>
        <script src="{{env_host}}public/dashboard/adminui/assets/js/vendor/select2.min.js"></script>
        <script src="{{env_host}}public/dashboard/adminui/assets/js/vendor/bootstrap-select.min.js"></script>
        <script>

            $('.selectpicker').selectpicker({
                nonSelectedText: 'Services',
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
@endif
