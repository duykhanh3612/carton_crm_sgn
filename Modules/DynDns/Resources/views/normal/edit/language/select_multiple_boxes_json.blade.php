<?php
if($ctrl->value!="" && !empty(@$row->{$ctrl->value})){
    $arr_value = collect(json_decode(@$row->{$ctrl->value},true))->pluck("languagecode")->toArray();
}
else{
    $arr_value = [];
}
 $table = @$ctrl->att_table_prefix==1?@$admin_group->prefix."_". $ctrl->att_table:$ctrl->att_table;
 $field = @$ctrl->att_field_language?$ctrl->att_field."_".$lang:$ctrl->att_field;
?>

<div class="form-group {{$ctrl->width}} desktop z-high" data-title="select_multiple_boxes_json">
    <label><?=@$ctrl->title?> @if(@$ctrl->validate==1) <span style="color:#ff0000">(*)</span> @endif</label>
    <div class="z-high">
        <textarea  id="{{@$ctrl->name.$lang}}" {{@$ctrl->read==1?"readonly disabled":"name=".@$ctrl->name.$lang}}
             class="form-control {{@$ctrl->validate==1?'validation':''}} {{@$ctrl->needed==1?'needed':''}}" style="display:none">{{@$row->{$ctrl->value} }}</textarea>
        <select class="form-control selectpicker {{@$ctrl->name.$lang}}_select_boxes_json" multiple>
            <?php foreach(App\Model\md::find_all($table,$ctrl->att_where) as $a):?>
            <option value="{{@$a->{$ctrl->att_key} }}"  {{in_array(@$a->{$ctrl->att_key},$arr_value)?'selected=selected':''}}>
            <?=$a->{ $field}?></option>
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
                var arr = String(selectedD).split(",");
                var obj = [];
                $.map(arr,function(val, i){
                    var obj_detail = {
                        languagecode:val,
                    };
                    obj.push(obj_detail);
                })
                $('#{{@$ctrl->name.$lang}}').val(JSON.stringify(obj));
            });
        </script>
    </div>
</div>
