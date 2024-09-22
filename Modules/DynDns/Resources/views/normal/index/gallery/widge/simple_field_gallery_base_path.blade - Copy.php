<?php 		//Mask
$image = @$row->{$ctrl->att_where};
$gallery_image = json_decode($row->{$ctrl->value});

if($image =="")
    $image = @$gallery_image[0]->image;
?>
<td>
    <center class="cl">
        @if ($image!='')
        <a class="roadtrips" data-href="<?=$image_path.$image ?>" data-name="{{$ctrl->name}}" data-id="{{$row->{$func->field_id} }}" target="_blank">
            <img src="<?=$image_path.'/'.$image ?>" style="width:50px;height:40px;" />
        </a>
        @else
        <a href="<?=base.'/'.$path_base.@$conf->logo ?>" target="_blank">
            <img src="<?=base.'/'.$path_base.@$conf->logo ?>" style="width:50px;height:40px;" />
        </a>
        @endif
    </center>
    @push('modal')
    <div id="myModal_{{$ctrl->name}}_{{$row->{$func->field_id} }}" class="modal2 fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{        $ctrl->title }}</h4>
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
    <link rel="stylesheet" href="{{env_host}}/public/plugin/lightbox2/src/css/lightbox.css" />
    <script type="text/javascript" src="{{env_host}}/public/plugin/lightbox2/src/js/lightbox.js" charset="UTF-8"></script>

    <script>
        $(document).ready(function(){

            $('.roadtrips').click(function () {
                var id = $(this).attr('data-id');
                var name = $(this).attr('data-name');
                // $('#myModal' + id).modal('show');
                $('.roadtrips').removeAttr('data-lightbox');
                $('.mdb-lightbox a').removeAttr('data-lightbox');
                $(this).attr('data-lightbox', "roadtrip");
                $(this).attr('href', $(this).attr('data-href'));
                $('#myModal_'+name+"_" + id + ' a').attr('data-lightbox', "roadtrip");
                $(this).click();

            });
        });
    </script>
    @endpush
</td>

