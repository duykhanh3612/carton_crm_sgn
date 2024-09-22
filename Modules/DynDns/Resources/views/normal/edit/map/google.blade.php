@php
$google = explode(',',$ctrl->value);
$address = @$google[0];
$lat = @$google[1];
$lng = @$google[2];
@endphp

<div class="form-group {{  $ctrl->width}} desktop " title="google">
    <div class="row">
        <div id="mapDiv" class="col-sm-12" style="display: block;">
            <div class="row">
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
                            <input id="google-input" name="{{@$address}}" value="{{@$row->{$address} }}" placeholder="Enter a location" autocomplete="off" type="text" class="form-control google-input" />
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="col-sm-2 form-control-label">
                            Latitude
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control title has-value latitude" name="{{$lat}}" value="{{@$row->{$lat} }}" type="text" />
                            <ul class="parsley-errors-list" id="parsley-id-4995"></ul>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="col-sm-2 form-control-label">
                            Longitude
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control title has-value longitude" name="{{$lng}}" value="{{@$row->{$lng} }}" type="text" />
                            <ul class="parsley-errors-list" id="parsley-id-4995"></ul>
                        </div>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <div id="map" class="map" style="height: 400px; "></div>
                </div>
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
        var markerLatLng = new google.maps.LatLng({{@$row->{$lat} }}, {{@$row->{$lng} }});
        var map = new google.maps.Map(document.getElementById('map'), {
            center: { lat: {{@$row->{$lat} }}, lng: {{@$row->{$lng} }}},
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
