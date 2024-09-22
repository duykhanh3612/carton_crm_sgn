<?php 		//Mask

switch(@$ctrl->mask){
	default:?>
<td>
    <center class="cl">
    @if (@$row->{$ctrl->att_where}!='')
        <a id="thumb_{{$row->{$func->field_id} }}" data-toggle="modal" data-target="#myModalImage">
            <img src="<?=$image_path.@$row->{$ctrl->att_where} ?>" style="width:60px;height:45px;" />
        </a>
    @else
    <a href="<?=$image_path.@$conf->logo ?> "  target="_blank">
        <img src="<?=$image_path.@$conf->logo ?>" style="width:60px;height:45px;" />
    </a>
    @endif        
    </center>

    <script type="text/javascript">
      var image_string_{{$row->{$func->field_id} }} = "";
    </script>

    @php
    $photos = json_decode(@$row->photos);
    $property_legal  = json_decode(@$row->property_legal);
    @endphp

    @if(@$photos)
    @foreach($photos as $r)
    @if(file_exists('public/qtland/'.@$r->image))
    <script type="text/javascript">
      image_string_{{$row->{$func->field_id} }} += '<div>' + 
                                              '<img data-u="image" src="{{$image_path.$r->image}}" />' +
                                              '<img data-u="thumb" src="{{$image_path.$r->image}}" />' +
                                              '<span class="caption">{{@$r->title}} - {{@$r->content}}</span>' +
                                          '</div>';
    </script>
    @endif
    @endforeach
    @endif

    @if(@$property_legal)
    @foreach($property_legal as $r)
    @if(file_exists('public/qtland/'.@$r->image))
    <script type="text/javascript">
      image_string_{{$row->{$func->field_id} }} += '<div>' + 
                                              '<img data-u="image" src="{{$image_path.$r->image}}" />' +
                                              '<img data-u="thumb" src="{{$image_path.$r->image}}" />' +
                                              '<span class="caption">{{@$r->title}} - {{@$r->content}}</span>' +
                                          '</div>';
    </script>
    @endif
    @endforeach
    @endif

    <script type="text/javascript">
        $('#thumb_{{$row->{$func->field_id} }}').on('click', function() {
            init_jsor_slider(image_string_{{$row->{$func->field_id} }});
        }) ;
    </script>
</td>
<?php break;
}?>