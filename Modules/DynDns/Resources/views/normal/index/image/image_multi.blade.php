<td>
    @php
    $photos = @json_decode(@$row->{$ctrl->value});
    @endphp
    <center>
   
    @if (@$photos)
        <a href="<?=$image_path.@$photos[0] ?> " data-lightbox="roadtrip" data-title="{{@$row->{$ctrl->att_table!=''?$ctrl->att_table:''} }}" target="_blank">
            <img src="<?=$image_path.@$photos[0] ?>" style="width:50px;height:40px;" data-type="image_multi" />
        </a>


        @push('modal')
        <div id="myModal{{$row->{$func->field_id} }}" class="modal2 fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="mdb-lightbox" data-pswp-uid="2">
                        @if(@$photos)
                        @foreach($photos as $r)
                            <figure class="col-md-4">
                                <a href="{{$image_path.$r}}" data-title="<span style='float:left'>{{    @$r->title}}</span> <span style='float:right'><small> {{    @$r->content}}</small></span>" data-size="1600x1067">
                                    <img src="{{    $image_path.$r}}" class="img-fluid" style="width:200px;height:200px;" />
                                </a>
                            </figure>
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
            $(document).ready(function () {

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

    @else
    <a href="<?=$image_path.@$conf->logo ?> " data-lightbox="roadtrip" data-title="" target="_blank">
        <img src="<?=$image_path.@$conf->logo ?>" style="width:50px;height:40px;" />
    </a>
    @endif
    </center>
    @push('script')
    <link href="{{base}}/public/plugin/lightbox2/dist/css/lightbox.css" rel="stylesheet" />
    <script src="{{base}}/public/plugin/lightbox2/dist/js/lightbox.js"></script>
    @endpush
</td>
