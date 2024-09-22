
@php
    if($row->{$ctrl->value}!=''){
        if(strpos($row->{$ctrl->value},'http')===false){
            $imagePath = @$image_path. $row->{$ctrl->value};
        }
        else{
            $imagePath = $row->{$ctrl->value};
        }
    }
    else{
        $imagePath = base.'/assets/img/370x250.jpg';
    }
@endphp
<td>
    @if(isset($row->{$ctrl->value}) && @$row->{$ctrl->value}!='')
        <a href="<?=@$image_path.@$row->{$ctrl->value} ?> " data-lightbox="roadtrip" data-title="{{@$ctrl->att_table==''?'':@$row->{@$ctrl->att_table} }}" target="_blank">
            <img {!! @$ctrl->att_style_index !!} src="<?=$imagePath ?>"  style="height:40px;" />
        </a>
    @else
    <a href="<?=@$image_path.@$conf->logo ?> " data-lightbox="roadtrip" data-title="" target="_blank">
        <img src="<?=@$image_path.@$conf->logo ?>" style="height:40px;" />
    </a>
    @endif
</td>

