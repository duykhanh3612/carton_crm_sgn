
<section class="content">
    <div class="container-fluid">
        <div id="productGeneralInfo" class="position-relative">
            <div id="page-content">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-12 control-label   ">
                            <div class=" control-label">
                                Access Token
                            </div>
                            <div class="">
                                <input name="access_token" class="form-control update_config" value="{{user_config("access_token")}}" />

                            </div>
                        </div>
                        <div class="col-sm-12 control-label    mt-3">
                            <div class=" control-label">
                                Refesh Token
                            </div>
                            <div class="">
                                <input name="refesh_token" class="form-control update_config" value="{{user_config("refesh_token")}}" />
                            </div>
                        </div>
                        <div class="col-sm-12 control-label   mt-3 ">
                            <div class=" control-label">
                                Zalo Template ID
                            </div>
                            <div class="">
                                <input name="zalo_zns_template_id" class="form-control update_config" value="{{user_config("zalo_zns_template_id")}}" />
                            </div>
                        </div>

                        <div class="col-sm-12 control-label    mt-3">
                            <div class=" control-label">
                                Theme
                            </div>
                            <div class="">
                                <input name="theme" class="form-control update_config" value="{{user_config("theme")}}" />
                            </div>
                        </div>


                        <div class="col-sm-12 control-label   mt-3">
                            <div class=" control-label">
                                zalo_permission
                            </div>
                            <div class="">
                                <input name="zalo_permission" class="form-control update_config" value="{{user_config("zalo_permission")}}" />
                            </div>

                            <button class="btn  btn-primary mt-1" id="get-access-token">Get Access Token</button>
                        </div>

                        <div class="modal fade" id="popup-get-access-token" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">

                                <div class="modal-body">

                                    <iframe src=""  height="100%" seamless="" style="    width: 100%;height:800px;border:0;"></iframe>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
</section>
@push("js")
<script>
    $(document).on("change",".update_config",function(){
        key = $(this).attr("name");
        value =  $(this).val();
        $.ajax({
            method: "POST",
            url: "{{ route('admin.config.update') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                key: key, value: value
            }
        }).done(function(res) {

        });
    });
    $("#get-access-token").on("click",function(){
        uri = $("input[name=zalo_permission]").val();
        // window.open(uri,"_blank")
        $("#popup-get-access-token").find("iframe").attr("src", uri);
        $("#popup-get-access-token").modal("show")
    })


    // popup examples
$( document ).on( "pagecreate", function() {
    // The window width and height are decreased by 30 to take the tolerance of 15 pixels at each side into account
    function scale( width, height, padding, border ) {
        var scrWidth = $( window ).width() - 30,
            scrHeight = $( window ).height() - 30,
            ifrPadding = 2 * padding,
            ifrBorder = 2 * border,
            ifrWidth = width + ifrPadding + ifrBorder,
            ifrHeight = height + ifrPadding + ifrBorder,
            h, w;
        if ( ifrWidth < scrWidth && ifrHeight < scrHeight ) {
            w = ifrWidth;
            h = ifrHeight;
        } else if ( ( ifrWidth / scrWidth ) > ( ifrHeight / scrHeight ) ) {
            w = scrWidth;
            h = ( scrWidth / ifrWidth ) * ifrHeight;
        } else {
            h = scrHeight;
            w = ( scrHeight / ifrHeight ) * ifrWidth;
        }
        return {
            'width': w - ( ifrPadding + ifrBorder ),
            'height': h - ( ifrPadding + ifrBorder )
        };
    };
    $( ".ui-popup iframe" )
        .attr( "width", 0 )
        .attr( "height", "auto" );
    $( "#popupMap iframe" ).contents().find( "#map_canvas" )
        .css( { "width" : 0, "height" : 0 } );
    $( "#popupMap" ).on({
        popupbeforeposition: function() {
            var size = scale( 480, 320, 0, 1 ),
                w = size.width,
                h = size.height;
            $( "#popupMap iframe" )
                .attr( "width", w )
                .attr( "height", h );
            $( "#popupMap iframe" ).contents().find( "#map_canvas" )
                .css( { "width": w, "height" : h } );
        },
        popupafterclose: function() {
            $( "#popupMap iframe" )
                .attr( "width", 0 )
                .attr( "height", 0 );
            $( "#popupMap iframe" ).contents().find( "#map_canvas" )
                .css( { "width": 0, "height" : 0 } );
        }
    });
});
</script>
@endpush
