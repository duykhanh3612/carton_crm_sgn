@php
        $string =$ctrl->att_table;
        $finalArray = array();

        $asArr = explode( ',', $string );

        foreach( $asArr as $val ){
            $tmp = explode('=>', $val );
            $finalArray[ $tmp[0] ] = $tmp[1];
        }

@endphp
@if(!h::isMobile())

<div class="col-md-6 form-group desktop" data-title="droparray">
        <div class="col-md-4 filter-input-group">
        <label class="filter-input-control">{!!$ctrl->title !!}</label>
    </div>

    <div class="col-md-8">
        <select class="form-control src_{{$ctrl->name}} filter-input-control" name="src[{{$ctrl->name }}][like][none]">
            <option value="">{{$ctrl->att_root}}</option>
            <?php foreach($finalArray as $k=>$v):?>
            <option value="{{$k}}"><?=$v?></option>
            <?php endforeach?>
        </select>
        <script>
            $('.src_{{$ctrl->name}}').val('{{@$src["none"]}}')
        </script>
    </div>
</div>
@else
<div class="col-md-6 form-group mobo style-input-mobo">
        <label class="filter-input-control">{!!$ctrl->title !!}</label>
    <div class="col-md-9 input-box">
        <select class="form-control src_{{$ctrl->name}} filter-input-control nd" name="src[{{$ctrl->name }}][like][none]">
            <option value="">&nbsp;</option>
            <?php foreach($finalArray as $k=>$v):?>
            <option value="{{$k}}"><?=$v?></option>
            <?php endforeach?>
        </select>
        <script>
            $('.src_{{$ctrl->name}}').val('{{ @$src["none"]}}')
        </script>
    </div>
</div> 
@endif 
