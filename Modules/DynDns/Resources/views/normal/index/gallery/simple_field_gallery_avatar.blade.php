<?php 		//Mask

switch(@$ctrl->mask){
	default:?>
<td>
    <center class="cl">
    @if (@$row->{$ctrl->att_where}!='')
        <a class="roadtrips" data-href="<?=$image_path.@$row->{$ctrl->att_where} ?>" data-id="{{$row->{$func->field_id} }}" target="_blank">
            <img src="<?=$image_path.@$row->{$ctrl->att_where} ?>" style="width:50px;height:40px;" />
        </a>
    @else
    <a href="<?=$image_path.@$conf->logo ?> "  target="_blank">
        <img src="<?=$image_path.@$conf->logo ?>" style="width:50px;height:40px;" />
    </a>
    @endif
        
    </center>
    @push('modal')
    <div id="myModal{{$row->{$func->field_id} }}" class="modal2 fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{        $ctrl->title }}</h4>
                </div>
                <div class="modal-body">
                    <div class="mdb-lightbox" data-pswp-uid="2" >
                        @php
                        $property_legal  = json_decode(@$row->property_legal);
                        $photos = json_decode(@$row->photos);
                        @endphp

                        @if(@$property_legal)
                        @foreach($property_legal as $r)
                        @if(file_exists('public/qtland/'.@$r->image))
                        <figure class="col-md-4">
                            <a href="{{$image_path.$r->image}}" data-title="<span style='float:left'>{{    @$r->title}}</span> <span style='float:right'><small> {{    @$r->content}}</small></span>" data-size="1600x1067">
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
                            <a href="{{$image_path.$r->image}}" data-title="<span style='float:left'>{{    @$r->title}}</span> <span style='float:right'><small> {{    @$r->content}}</small></span>" data-size="1600x1067">
                                <img src="{{    $image_path.$r->image}}" class="img-fluid" style="width:200px;height:200px;" />
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
    <style type="text/css">
        .lightbox .lb-image {

            height: calc(100vh - 100px) !important;

        }
        .lb-nav a.lb-prev {
            opacity: 1;
        }
        .lb-nav a.lb-next {
            opacity: 1;
        }
    </style>
    <script>
        $(document).ready(function(){

            $('.roadtrips').click(function () {
                var id = $(this).attr('data-id');
                // $('#myModal' + id).modal('show');
                $('.roadtrips').removeAttr('data-lightbox');
                $('.mdb-lightbox a').removeAttr('data-lightbox');
                $(this).attr('data-lightbox', "roadtrip");
                $(this).attr('href', $(this).attr('data-href'));
                $('#myModal' + id + ' a').attr('data-lightbox', "roadtrip");
                $(this).click();

            });
        });
    </script>
    @endpush
</td>
<?php break;
}?>
