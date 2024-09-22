<?php 		//Mask
$image = @$row->{$ctrl->att_where};
$gallery_image = is_array($row->{$ctrl->value})?$row->{$ctrl->value}: json_decode($row->{$ctrl->value});

if($image =="")
    $image = @$gallery_image[0]->image;
?>
<td>
   @if($image!="")
    <center class="cl">
        <img class="lazy-image roadtrips" src="<?=$image_path.'/'.$image ?>" <?=$image_path.'/'.$image ?> " " data-json="{{json_encode($ctrl)}}" data-original="<?=$image_path.'/'.$image ?>" data-name="{{$ctrl->name}}" data-id="{{$row->{$func->field_id} }}" style="width:50px;height:40px;" />
    </center>
    @endif
</td>

