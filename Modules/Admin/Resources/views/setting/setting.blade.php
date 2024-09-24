
<section class="content">
    <div class="container-fluid">
        <div id="productGeneralInfo" class="position-relative">
            <div id="page-content">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-12 control-label   ">
                            <div class=" control-label">
                                Title
                            </div>
                            <div class="">
                                <input name="hotline" class="form-control update_config" value="{{user_setting("seo_title")}}" />

                            </div>
                        </div>
                        <div class="col-sm-12 control-label   ">
                            <div class=" control-label">
                                Description
                            </div>
                            <div class="">
                                <textarea name="seo_description" class="form-control update_config">{{user_setting("seo_description")}}</textarea>

                            </div>
                        </div>
                        <div class="col-sm-12 control-label   ">
                            <div class=" control-label">
                                Keyword
                            </div>
                            <div class="">
                                <textarea name="seo_keyword" class="form-control update_config">{{user_setting("seo_keyword")}}</textarea>
                            </div>
                        </div>
                        <div class="col-sm-12 control-label   ">
                            <div class=" control-label">
                                Hotline
                            </div>
                            <div class="">
                                <input name="hotline" class="form-control update_config" value="{{user_setting("hotline")}}" />

                            </div>
                        </div>
                        <div class="col-sm-12 control-label    mt-3">
                            <div class=" control-label">
                               Phone
                            </div>
                            <div class="">
                                <input name="phone" class="form-control update_config" value="{{user_setting("phone")}}" />
                            </div>
                        </div>
                        <div class="col-sm-12 control-label    mt-3">
                            <div class=" control-label">
                               Email
                            </div>
                            <div class="">
                                <input name="phone" class="form-control update_config" value="{{user_setting("email")}}" />
                            </div>
                        </div>
                        <div class="col-sm-12 control-label    mt-3">
                            <div class=" control-label">
                               Address
                            </div>
                            <div class="">
                                <textarea name="address" class="form-control update_config" value="" style="height: 300px" >{{user_setting("address")}}</textarea>
                            </div>
                        </div>
                        <div class="col-sm-12 control-label    mt-3">
                            <div class=" control-label">
                               Address Contact
                            </div>
                            <div class="">
                                <textarea name="address_contact" class="form-control update_config"  style="height: 300px"  >{{user_setting("address_contact")}}</textarea>
                            </div>
                        </div>
                        <div class="col-sm-12 control-label    mt-3">
                            <div class=" control-label">
                               Zalo
                            </div>
                            <div class="">
                                <input name="social_zalo" class="form-control update_config" value="{{user_setting("social_zalo")}}" />
                            </div>
                        </div>
                        <div class="col-sm-12 control-label    mt-3">
                            <div class=" control-label">
                               Facebook
                            </div>
                            <div class="">
                                <input name="social_facebook" class="form-control update_config" value="{{user_setting("social_facebook")}}" />
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
            url: "{{ route('admin.setting.update') }}",
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
