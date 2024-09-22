@php
    $table = @$ctrl->att_table_prefix==1?@$admin_group->prefix."_". $ctrl->att_table:$ctrl->att_table;

    $string =$ctrl->att_join;
    $finalArray = array();

    $asArr = explode( ',', $string );

    foreach( $asArr as $val ){
        $tmp = explode('=>', $val );
        $finalArray[ $tmp[0] ] = $tmp[1];
    }

@endphp
<div class="col-md-6 form-group last pad5_top" data-title="third_module_public_value">
    <div class="col-md-4 filter-input-group">
        <label class="filter-input-control">{!!$ctrl->title !!}</label>
    </div>
    <div class="col-md-8">
         <select class="form-control src_{{$ctrl->name}} filter-input-control" name="src[{{ $ctrl->name }}][third_module_public_value][{{$table}}#{{$ctrl->att_key}}#{{$ctrl->note}}]">
            <option value="">{{$ctrl->att_root}}</option>
            <?php foreach($finalArray as $k=>$v):?>
            <option value="{{$k}}"><?=$v?></option>
            <?php endforeach?>
        </select>
        <script>
            $('.src_{{$ctrl->name}}').val('{{@$src["third_module_public_value"]}}')
        </script>
    </div>
</div>  
