@php
    $table = "twoahaff_product_option";//@$ctrl->att_table_prefix==1?@$admin_group->prefix."_". $ctrl->att_table:$ctrl->att_table;
    $product_id = Arr::get($row, $func->field_id) ;
    if(!empty($product_id )){
        $groupOptions = md::find_all($table,"product_id='$product_id'")->groupBy('group_option_id');//pluck('title')->toArray();
        $productOptions =  md::find_all($table,"product_id='$product_id'")->keyBy("title");
        $inventories = md::find_all("twoahaff_product_inventory","product_id='$product_id'")->keyBy(function($item){
            return $item->size."_".$item->color;
        });
        $options = [];
        foreach ($groupOptions as $key => $value) {
            $options[] = collect($value)->pluck('title')->toArray();
        }
    }


@endphp
@if(!empty($product_id )){
<div class="form-group {{  $ctrl->width}}" data-title="produc_inventory">
        @if(count($options)==2)
        @php
            $group = [0=>'size','1'=>'color'];
            $items = Arr::crossJoin($options[0],$options[1]);
        @endphp
        <div class="row">
            <div class="col-md-3">Color</div>
            <div class="col-md-3">Size</div>
            <div class="col-md-3">Quantity</div>
        </div>
        @foreach ($items as $item )
        @php
            $key = implode("_",$item);
            $inventory = Arr::get($inventories,$key);
            $id = $inventory->id??(string) Str::uuid();
            $name = "third_table[twoahaff_product_inventory][product_id##id][$id]";
        @endphp
        <div class="row pt-3 pb-3 line">
            @foreach ($item  as $k=>$r)
            <div class="col-md-3">
                {{ $r }}
                <input type="hidden" class="form-control" name="{{$name}}[{{$group[$k]}}]"  value="{{ $r}}"/>
            </div>
            @endforeach
            <div class="col-md-3">
                <input type="hidden" class="form-control" name="{{$name}}[product_id]"  value="{{ $product_id }}"/>
                <input class="form-control" name="{{$name}}[quantity]"  value="{{ @$inventory->quantity}}"/>
            </div>
        </div>
        @endforeach
        @endif
    <style type="text/css">
    .line {
        border-bottom: 1px solid #eee;
    }
    </style>
</div>
@endif