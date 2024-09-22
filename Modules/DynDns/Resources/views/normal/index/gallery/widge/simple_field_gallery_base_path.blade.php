<?php 		//Mask
$image = @$row->{$ctrl->att_where};
$gallery_image = json_decode($row->{$ctrl->value});
?>
<div id="myModal_{{@$ctrl->name}}_{{$row->{$func->field_id} }}" class="modal2 fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{        @$ctrl->title }}</h4>
            </div>
            <div class="modal-body">
                <div class="mdb-lightbox" data-pswp-uid="2">
                    @if(@$gallery_image)
                        @foreach($gallery_image as $r)
                        @if(file_exists($path_base.$func->path_upload.'/'.@$r->image) && $r->image != $image)
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
