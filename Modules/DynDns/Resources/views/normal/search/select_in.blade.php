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

<div class="col-md-6 form-group desktop">
    <div class="col-md-4 filter-input-group">
        <label class="filter-input-control">{!!$ctrl->title !!}</label>
    </div>
    <div class="col-md-8">
        <input type="hidden" name="src[{{$ctrl->name }}][select_in][where]"  value="{{$ctrl->att_where}} "/>
         <input type="hidden" name="src[{{$ctrl->name }}][select_in][field]"  value="{{$ctrl->att_field}} "/>
        <select class="form-control  filter-input-control src_{{$ctrl->name}} " name="src[{{$ctrl->name }}][select_in][none]">
            <?php foreach($finalArray as $k=>$v):?>
            <option value="{{$k}}"><?=$v?></option>
            <?php endforeach?>
        </select>
               <script>
            $('.src_{{$ctrl->name}}').val('{{ @$src["none"]}}')
        </script>
    </div>
</div>
@else
<div class="col-md-6 form-group mobo style-input-mobo">
        <label class="filter-input-control">{!!$ctrl->title !!}</label>
    <div class="col-md-9 input-box">
        <input type="hidden" name="src[{{$ctrl->name }}][select_in][where]"  value="{{$ctrl->att_where}} "/>
        <input type="hidden" name="src[{{$ctrl->name }}][select_in][field]"  value="{{$ctrl->att_field}} "/>
        <select class="form-control src_{{$ctrl->name}} filter-input-control nd" name="src[{{$ctrl->name }}][check_null][none]">
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
