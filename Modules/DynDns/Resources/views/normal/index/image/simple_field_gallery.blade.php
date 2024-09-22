<?php 		//Mask

switch(@$ctrl->mask){
	default:?>
<td>
    <center class="cl">
    @if (@$row->{$ctrl->value}!='')
        <a  class="roadtrips" data-id="{{$row->{$func->field_id} }}"  target="_blank">
            <img src="<?=$image_path.@$row->{$ctrl->value} ?>" style="width:50px;height:40px;" />
        </a>
    @else
    <a href="<?=$image_path.@$conf->logo ?> " data-lightbox="roadtrip" data-title="{{        @$row->{$ctrl->value} }}" target="_blank">
        <img src="<?=$image_path.@$conf->logo ?>" style="width:50px;height:40px;" />
    </a>
    @endif
        
    </center>
    @push('modal')
    <div id="myModal{{$row->{$func->field_id} }}" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{        $ctrl->title }}</h4>
                </div>
                <div class="modal-body">
                    <div class="mdb-lightbox" data-pswp-uid="2" >
                      
                        <figure class="col-md-4">
                            <a href="<?=$image_path.@$row->{$ctrl->value} ?> " data-lightbox="roadtrip" data-title="{{        @$row->property_name}}" target="_blank">
                                <img src="<?=$image_path.@$row->{$ctrl->value} ?>" class="img-fluid" style="width:200px;height:200px;" />
                            </a>
                        </figure>

                        @php
                        $property_legal  = json_decode(@$row->property_legal);
                        $photos = json_decode(@$row->photos);
                        @endphp

                        @if(@$property_legal)
                        @foreach($property_legal as $r)
                        @if(file_exists('public/qtland/'.@$r->image))
                        <figure class="col-md-4">
                            <a href="{{$image_path.$r->image}}" data-lightbox="roadtrip" data-title="{{       $r->title}}" data-size="1600x1067">
                                <img src="{{    $image_path.$r->image}}" class="img-fluid" style="width:200px;height:200px;" />
                            </a>
                        </figure>
                        @endif
                        @endforeach
                        @endif

                        @if(@$photos)
                        @foreach($photos as $r)
                        @if(file_exists('public/qtland/'.@$r->image))
                        <figure class="col-md-4">
                            <a href="{{$image_path.$r->image}}" data-lightbox="roadtrip" data-title="{{       $r->title}}" data-size="1600x1067">
                                <img src="{{$image_path.$r->image}}" class="img-fluid" style="width:200px;height:200px;" />
                            </a>
                        </figure>
                        @endif
                        @endforeach


                        @endif


                    </div>
                    <div style="clear:both"></div>
                </div>
                <!--<div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>-->
            </div>

        </div>
    </div>

    <script>
        $('.roadtrips').click(function () {
            var id = $(this).attr('data-id');
            $('#myModal' + id).modal('show');
        });
            
    </script>
    @endpush
</td>
<?php break;
}?>