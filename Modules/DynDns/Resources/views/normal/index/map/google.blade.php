<div class="box-body">
    <div class="row">
        <div>
            <div id="mmn-1" class="modal fade" data-backdrop="true">
                <div class="modal-dialog" id="animate">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Bản đồ mới</h5>
                        </div>
                        <form method="POST" action="http://vincityquan9.com.vn/admin/1/topics/1/maps/store" accept-charset="UTF-8" enctype="multipart/form-data">
                            <div class="modal-body p-lg">
                                <div>

                                    <div class="form-group row">
                                        <label for="longitude" class="col-sm-3 form-control-label">
                                            Vị trí
                                        </label>
                                        <div class="col-sm-5">
                                            <input placeholder="" class="form-control" id="longitude" required="" name="longitude" value="" type="text" />
                                        </div>
                                        <div class="col-sm-4">
                                            <input placeholder="" class="form-control" id="latitude" required="" name="latitude" value="" type="text" />
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="title_en" class="col-sm-3 form-control-label">
                                            Tiêu đề bản đồ
                                        </label>
                                        <div class="col-sm-9">
                                            <input placeholder="" class="form-control" id="title_en" dir="ltr" name="title_en" value="" type="text" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="details_en" class="col-sm-3 form-control-label">
                                            Chi tiết
                                        </label>
                                        <div class="col-sm-9">
                                            <textarea placeholder="" class="form-control" id="details_en" rows="3" dir="ltr" name="details_en" cols="50"></textarea>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="link_status" class="col-sm-3 form-control-label">Icon</label>
                                        <div class="col-sm-9">
                                            <div class="radio">
                                                <label class="ui-check ui-check-md">
                                                    <input id="status1" class="has-value" checked="checked" name="icon" value="0" type="radio" />
                                                    <i class="dark-white"></i>
                                                    <img src="http://vincityquan9.com.vn/backEnd/assets/images/marker_0.png" style="width: 25px;" />
                                                </label>
                                                <label class="ui-check ui-check-md">
                                                    <input id="status2" class="has-value" name="icon" value="1" type="radio" />
                                                    <i class="dark-white"></i>
                                                    <img src="http://vincityquan9.com.vn/backEnd/assets/images/marker_1.png" style="width: 25px;" />
                                                </label>
                                                <label class="ui-check ui-check-md">
                                                    <input id="status2" class="has-value" name="icon" value="2" type="radio" />
                                                    <i class="dark-white"></i>
                                                    <img src="http://vincityquan9.com.vn/backEnd/assets/images/marker_2.png" style="width: 25px;" />
                                                </label>
                                                <label class="ui-check ui-check-md">
                                                    <input id="status2" class="has-value" name="icon" value="3" type="radio" />
                                                    <i class="dark-white"></i>
                                                    <img src="http://vincityquan9.com.vn/backEnd/assets/images/marker_3.png" style="width: 25px;" />
                                                </label>
                                                <label class="ui-check ui-check-md">
                                                    <input id="status2" class="has-value" name="icon" value="4" type="radio" />
                                                    <i class="dark-white"></i>
                                                    <img src="http://vincityquan9.com.vn/backEnd/assets/images/marker_4.png" style="width: 25px;" />
                                                </label>
                                                <label class="ui-check ui-check-md">
                                                    <input id="status2" class="has-value" name="icon" value="5" type="radio" />
                                                    <i class="dark-white"></i>
                                                    <img src="http://vincityquan9.com.vn/backEnd/assets/images/marker_5.png" style="width: 25px;" />
                                                </label>
                                                <label class="ui-check ui-check-md">
                                                    <input id="status2" class="has-value" name="icon" value="6" type="radio" />
                                                    <i class="dark-white"></i>
                                                    <img src="http://vincityquan9.com.vn/backEnd/assets/images/marker_6.png" style="width: 25px;" />
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Hủy</button>
                                <button type="submit" class="btn btn-primary p-x-md">&nbsp;&nbsp;Add&nbsp;&nbsp;</button>
                            </div>
                        </form>
                    </div><!-- /.modal-content -->
                </div>
            </div>
            <div class="row p-a" style="display: none">
                <div class="col-sm-12">
                    <button class="btn btn-fw primary" data-toggle="modal" data-target="#mmn-1" ui-toggle-class="bounce" id="mapNew" ui-target="#animate">
                        <i class="material-icons"></i>
                        &nbsp; Bản đồ mới
                    </button>
                </div>
            </div>
            <div class="row p-a" id="mapDivBtns" style="display: none;">
                <div class="col-sm-12">
                    <div class=" p-a text-center light ">
                        Hiện tại không có dữ liệu để cập nhật
                        <br />
                        <br />
                        <a class="btn btn-fw primary" id="mapDivNew">
                            <i class="material-icons"></i>
                            &nbsp; Bản đồ mới
                        </a>

                    </div>
                </div>
            </div>
            <div class="col-sm-5"></div>
        </div>
        <div id="mapDiv" class="col-sm-12" style="display: block;">

            <br />
            <!--<div style="margin-bottom: 3px;">
                <small>
                    Click vào vị trí để thêm đánh dấu địa điểm ,
                    <a data-toggle="modal" data-target="#mmn-1" ui-toggle-class="bounce" ui-target="#animate">
                        <u>
                            hoặc click vào đây để làm bằng tay
                        </u>
                    </a>
                </small>
            </div>-->
            <div class="form-group col-md-6">
                <div class="form-group col-md-12">
                    <label>
                        Địa chỉ đầy đủ
                    </label>
                    <div class="col-sm-12">
                        <input id="google-input" placeholder="Enter a location" autocomplete="off" type="text" class="form-control google-input">
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <label class="col-sm-2 form-control-label">
                        latitude
                    </label>
                    <div class="col-sm-10">
                        <input class="form-control title has-value latitude" name="latitude" value="10.7621162" type="text">
                        <ul class="parsley-errors-list" id="parsley-id-4995"></ul>
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <label class="col-sm-2 form-control-label">
                        longitude
                    </label>
                    <div class="col-sm-10">
                        <input class="form-control title has-value longitude" name="longitude" value="106.693444" type="text">
                        <ul class="parsley-errors-list" id="parsley-id-4995"></ul>
                    </div>
                </div>

            </div>
            <div class="form-group col-md-6">
                <div id="map" class="map" style="height: 400px; "></div>
            </div>
    
                <style type="text/css">
                    .map {
                        overflow: no-content !important;
                        position:inherit !important;
                        width:100% !important;
                    }
                    .pac-container { z-index: 10000 !important; } 
                </style>



            </div>
    </div>
</div>
<div style="clear:both"></div>
<script>
    
    $(window).on('load', function () {
 
        var marker;
        var markerLatLng = new google.maps.LatLng(22.3038945, 70.80215989999999);
        var map = new google.maps.Map(document.getElementById('map'), {
            center: { lat: 22.3038945, lng: 70.80215989999999 },
            zoom: 13

        });

        var input = document.getElementById('google-input');
        //map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);
        // Set the data fields to return when the user selects a place.
        autocomplete.setFields(
            ['address_components', 'geometry', 'icon', 'name']);



        var infowindow = new google.maps.InfoWindow();
        marker = new google.maps.Marker({
            map: map,
            position: markerLatLng,
            draggable: true
        });


        google.maps.event.addListener(map, 'click', function (event) {
            marker.setPosition(event.latLng);
        });

        google.maps.event.addListener(
                marker,
                'drag',
                function (event) {
                    $('.latitude').val(this.position.lat());
                    $('.longitude').val(this.position.lng());
                    //alert('drag');
                });

        var geocoder = new google.maps.Geocoder();

        google.maps.event.addListener(marker, 'dragend', function (event) {
            $('.latitude').val(this.position.lat());
            $('.longitude').val(this.position.lng());

            geocoder.geocode({ 'latLng': marker.getPosition() }, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {

                    if (results[0]) {
                        $('.google-input').val(results[0].formatted_address);

                    }
                }
            });
        });



        autocomplete.addListener('place_changed', function () {
            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete.getPlace();

            /* If the place has a geometry, then present it on a map. */

            if (place.geometry.viewport) {

                map.fitBounds(place.geometry.viewport);

            } else {

                map.setCenter(place.geometry.location);

                map.setZoom(17);

            }

            marker.setIcon(({

                url: place.icon,

                size: new google.maps.Size(71, 71),

                origin: new google.maps.Point(0, 0),

                anchor: new google.maps.Point(17, 34),

                scaledSize: new google.maps.Size(35, 35)

            }));

            marker.setPosition(place.geometry.location);

            marker.setVisible(true);



            var address = '';

            if (place.address_components) {

                address = [

                (place.address_components[0] && place.address_components[0].short_name || ''),
                (place.address_components[1] && place.address_components[1].short_name || ''),
                (place.address_components[2] && place.address_components[2].short_name || '')

                ].join(' ');

            }



            infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
            infowindow.open(map, marker);



            /* Location details */
            $('.latitude').val(place.geometry.location.lat());
            $('.longitude').val(place.geometry.location.lng());
            //document.getElementById('location-snap').innerHTML = place.formatted_address;

            //document.getElementById('lat-span').innerHTML = place.geometry.location.lat();

            //document.getElementById('lon-span').innerHTML = place.geometry.location.lng();

        });
        $('#map').css('overflow', 'none');

    });
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDmsH3ga0_pRYjsJWn-KEOxVAFNIssKWn0&libraries=places" async defer></script>
