
<?php
 $arr = explode(',',$ctrl->att_table);
?>
<div class="col-md-6 form-group" data-title="dropdata">
    <label class="col-md-4  form-control-label" style="white-space:nowrap;text-align:right;">{!!$ctrl->title !!}</label>

    <div class="col-md-8 ">

        <select class="form-control src_{{$ctrl->name}}" name="src[{{$ctrl->name }}][like][none]">
            <option value="">---- Chọn ----</option>
            <?php foreach($arr as $a):?>
            <option value="{{$a}}" ><?=$a?></option><?php endforeach?>

        </select>

        <script>
            $('.src_{{$ctrl->name}}').val('{{ @$src["none"]}}')
        </script>
    </div>
</div>  
