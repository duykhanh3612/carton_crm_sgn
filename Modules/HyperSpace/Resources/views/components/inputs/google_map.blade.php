@php
    $colLeft = empty($colLeft) ? 12 : $colLeft;
    if ($colLeft == 12) {
        $colRight = 12;
    }
    $value = old($name, $value ?? '');
    if ($value && is_array($value)) {
        $value = implode(', ', $value);
    }
@endphp
<div class="row {{ $rowClass ?? '' }}"
    @if (!empty($rowData)) @foreach ($rowData as $dataKey => $dataVal)
        data-{{ $dataKey }}="{{ is_array($dataVal) ? json_encode($dataVal) : $dataVal }}"
    @endforeach @endif>
    <div class="col-md-{{ $colLeft }}">
        <div class="form-group">
            <div id="map" style="height: 500px;width:100%"></div>
        </div>
    </div>
</div>

@push('js')
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBETz6vreNaK1VP8MFwCXiQ8snEJPUcwc&libraries=places&callback=initMap">
    </script>
    <script>
        var map;
        var marker;

        function initMap() {
            var DEFAULT_POSITION = {
                lat: $("#lat").val() != "" ? parseFloat($("#lat").val()) : 10.7629552,
                lng: $("#lng").val() != "" ? parseFloat($("#lng").val()) : 106.6539393
            };

            var geocoder = new google.maps.Geocoder();
            mapsProperties = {
                center: new google.maps.LatLng(DEFAULT_POSITION.lat, DEFAULT_POSITION.lng),
                zoom: 18,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                streetViewControl: false,
                mapTypeControl: false,
                disableDefaultUI: true,
                disableDoubleClickZoom: true,
            };

            map = new google.maps.Map(document.getElementById('map'), mapsProperties);
            var noPoi = [{
                    "featureType": "transit.station.bus",
                    "stylers": [{
                        "visibility": "off"
                    }]
                },
                {
                    featureType: "poi.business",
                    elementType: "labels",
                    stylers: [{
                        visibility: "off"
                    }]
                }
            ];
            map.setOptions({
                styles: noPoi
            });

            let infoWindow = new google.maps.InfoWindow({
                content: "Click the map to get Lat/Lng!",
                position: DEFAULT_POSITION,
            });
            const center = {
                lat: 10.7629552,
                lng: 106.6539393
            };
            const input = document.getElementById("address");
            const defaultBounds = {
                north: center.lat + 0.1,
                south: center.lat - 0.1,
                east: center.lng + 0.1,
                west: center.lng - 0.1,
            };
            const options = {
                bounds: defaultBounds,
                componentRestrictions: {
                    country: "vn"
                },
                fields: ["address_components", "geometry", "icon", "name"],
                strictBounds: false,
                types: ["establishment"],
            };
            const autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.bindTo("bounds", map);
            const infowindow = new google.maps.InfoWindow();
            const infowindowContent = document.getElementById("infowindow-content");


            marker = new google.maps.Marker({
                position: DEFAULT_POSITION,
                draggable: true,
                map: map,
            });
            google.maps.event.addListener(marker, 'dragend', function(e) {
                getAddress('latLng', e.latLng, getDragendMarkerCallback);
                $("#lat").val(e.latLng.lat);
                $("#lng").val(e.latLng.lng);
                $("#latlng").val($("#lat").val() + "," + $("#lng").val());
            });


            autocomplete.addListener("place_changed", () => {
                try {


                    const place = autocomplete.getPlace();

                    if (!place.geometry || !place.geometry.location) {
                        // User entered the name of a Place that was not suggested and
                        // pressed the Enter key, or the Place Details request failed.
                        window.alert("No details available for input: '" + place.name + "'");
                        return;
                    }

                    // If the place has a geometry, then present it on a map.
                    if (place.geometry.viewport) {
                        map.fitBounds(place.geometry.viewport);
                    } else {
                        map.setCenter(place.geometry.location);
                        map.setZoom(17);
                    }


                    $("#lat").val(place.geometry.location.lat);
                    $("#lng").val(place.geometry.location.lng);
                    $("#latlng").val($("#lat").val() + "," + $("#lng").val());

                    marker.setPosition(place.geometry.location);
                    marker.setVisible(true);
                    // infowindowContent.children["place-name"].textContent = place.name;
                    // infowindowContent.children["place-address"].textContent =place.formatted_address;
                    infowindow.setContent(place.formatted_address);
                    infowindow.close();
                    if (marker != undifine) {
                        marker.setVisible(false);
                    }

                    infowindow.open(map, marker);
                } catch (err) {
                    console.log(err);
                }

            });

            // infoWindow.open(map);
            map.addListener("click", (mapsMouseEvent) => {
                // Close the current InfoWindow.
                // infoWindow.close();

                // Create a new InfoWindow.
                // infoWindow = new google.maps.InfoWindow({
                //     position: mapsMouseEvent.latLng,
                // });
                // infoWindow.setContent(
                //     mapsMouseEvent.latLng.lat() + ","+ mapsMouseEvent.latLng.lng()

                // );
                // infoWindow.open(map);
                $("#latlng").val(mapsMouseEvent.latLng.lat() + "," + mapsMouseEvent.latLng.lng());
                $("#lat").val(mapsMouseEvent.latLng.lat());
                $("#lng").val(mapsMouseEvent.latLng.lng());

                if (marker == undefined) {
                    marker = new google.maps.Marker({
                        position: mapsMouseEvent.latLng,
                        // label: {
                        // color: 'white',
                        // fontWeight: 'bold',
                        // text: item.device.bien_so,
                        // className: 'marker_label-'+item.status,
                        // },
                        draggable: true,
                        map: map,
                    });
                    google.maps.event.addListener(marker, 'dragend', function(e) {
                        // console.log('marker dragend!');
                        // updateCurrentMarkerLocation(e.latLng);
                        // getAddress('latLng', e.latLng, getDragendMarkerCallback);

                        $("#lat").val(e.latLng.lat);
                        $("#lng").val(e.latLng.lng);
                        $("#latlng").val($("#lat").val() + "," + $("#lng").val());
                        // map.panTo(e.latLng);
                    });
                } else {
                    marker.setPosition(mapsMouseEvent.latLng);
                }



                // google.maps.event.addListener(marker, 'click', function (e) {
                //     tracking_device = this.device_id;
                //     kt_device_info(this.device_id);
                // });

            });

            function getAddress(type, value, callback) {
                var request = {};
                request[type] = value;
                if (geocoder) {
                    geocoder.geocode(request, function(result) {
                        if (result && $.isArray(result) && result.length) {
                            if (callback && $.isFunction(callback)) {
                                callback(result);
                            }
                        }
                    });
                }
            }

            function getDragendMarkerCallback(list) {
                if (list && $.isArray(list) && list.length) {
                    var obj = list[0];
                    var address = obj.formatted_address;
                    geocoder = new google.maps.Geocoder();
                    geocoder.geocode({
                        'address': address
                    }, function(results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            lat = results[0].geometry.location.lat();
                            lng = results[0].geometry.location.lng();
                            ward = results[0].address_components[2].long_name;
                            //district = results[0].address_components[3].long_name;
                            if (results[0].address_components[2].types[0] == "administrative_area_level_2")
                                district = results[0].address_components[2].long_name;
                            else if (results[0].address_components[3].types[0] == "administrative_area_level_2")
                                district = results[0].address_components[3].long_name;
                            else if (results[0].address_components[4].types[0] == "administrative_area_level_2")
                                district = results[0].address_components[4].long_name;

                            var data = {
                                lat: obj.geometry.location.lat(),
                                lng: obj.geometry.location.lng(),
                                ward: ward,
                                district: district,
                                address: address
                            }
                            console.log(data);
                            $("#address").val(address);
                        } else {
                            alert('Geocode was not successful for the following reason: ' + status);
                        }
                    });
                    // updateCurrentMarker(obj.formatted_address, obj.place_id);
                    // markerInfoPromise = findMarkerInfo();
                    // findPolygon();
                }
            }

            function getDistase() {
                link =
                    `https://maps.googleapis.com/maps/api/distancematrix/json?destinations=New%20York%20City%2C%20NY&origins=Washington%2C%20DC&units=imperial&key=AIzaSyCBETz6vreNaK1VP8MFwCXiQ8snEJPUcwc`;
            }
        }
    </script>
@endpush
