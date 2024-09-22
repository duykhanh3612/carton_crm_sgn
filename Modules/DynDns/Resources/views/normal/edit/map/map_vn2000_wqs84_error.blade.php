<!-- Sai toa do-->
<div class="box-body">
    <div class="row">
        <div id="mapDiv" class="col-sm-12" style="display: block;">
            <div class="form-group col-md-6">
               

                <label class="form-group col-md-12">
                    Nhập danh sách hệ tọa độ
                </label>
                <div class="form-group col-md-12">
                    <div class="col-sm-12">
                        <textarea placeholder="1111884.10,446873.37 <br/> 1111834.06,446874.12 <br/>1111834.64,446787.25                                              
                        <br/>1111814.66,446788.21                              
                        <br/>1111814.66,446747.40                     
                        <br/>1111879.05,446747.41                           
                        <br/>1111879.70,446758.26"
                                     id="{{$ctrl->name}}" name="{{$ctrl->name}}" rows="12" cols="80" style="width:100%" type="text" class="form-control jq_watermark">{{@$row->{$ctrl->name} }}</textarea>
                                     
                         <script type="text/javascript" src="../../plugin/jquery/jquery.watermark.js"></script>
                                     
                    </div>
                </div>
                <div class="form-group col-md-6" style="display:none">
                    <div class="col-sm-12">
                        <textarea placeholder="QWS84" id="{{$ctrl->value}}"  name="{{$ctrl->value}}"  rows="12"  type="text" class="form-control">{{@$row->{$ctrl->value} }}</textarea>
                    </div>
                </div>
                <div class="form-group col-md-12" style="text-align:center;">
                        <label class="btn bd2742" id="btnRenderMap">Chuyển đổi</label>         
                        <button class="btn" id="btnGetLocation" style="display:none">Get Polygon</button>  
                 </div>               

            </div>
            <div class="form-group col-md-6">
                <div class="row">
                    <div class="col-sm-12" style="display: block;">
                        <div class="form-group col-md-12">
                            <label>
                                Tỉnh / Thành Phố
                            </label>
                            <div class="col-sm-12">
                                <select class="province_id form-control" name="province_id">
                                    @foreach(App\Model\Geo::getProvince as $p)
                                    <option value="{{$p->id}}" data-code="{{$p->code}}">{{$p->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label>
                                Quận Huyện
                            </label>
                            <div class="col-sm-12">
                                {{Form::select('district_id', App\Model\Geo::getDistrictOptions(@$row->province_id), @$row->district_id, ['class'=>'district_id form-control']) }}
                            </div>
                        </div>
                    </div>
                </div>

                <script>

        var buildOptionDistrict = function () {
            var val = $('.province_id').val();
            $.ajax({
                url: "{{url('admin/getDistrict')}}",
                type: 'post',
                headers: {
                    'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                },
                data: { province_id: val,json:true },
                success: function (response) {
                    var select = '<option value="">Quận/Huyện</option>';
                    var district_id = $('#district_id').val();
                    $.each(response, function (i, data) {
                        var selected = data.id === parseInt(district_id) ? 'selected' : ''
                        select += '<option ' + selected + ' value="' + data.id + '">' + data.name + '</option>';
                    });
                    $('.district_id').html(select);

                }
            });
        }


        //function init() {
        //    buildOptionDistrict(buildOptionWard);
        //}

        $(document).ready(function () {
            $('.province_id').change(function () {
                buildOptionDistrict();
            });
                buildOptionDistrict();
        });

        init();

                </script>
                <div class="form-group col-md-12">
                    <label>
                        Địa chỉ đầy đủ
                    </label>
                    <div class="col-sm-12">
                        <input id="google-input" placeholder="Nhập Địa chỉ đầy đủ" autocomplete="off" type="text" class="form-control google-input">
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <div id="map" class="map" style="height: 400px; "></div>
                </div>
                <div class="form-group col-md-12">
                    <div class="form-group col-md-6 form-text">
                        <label class="static-value">
                            Vĩ độ:
                        </label>
                        <input class="form-control title has-value latitude" name="latitude" value="{{@$row->latitude}}" type="text" />

                    </div>
                    <div class="form-group col-md-6 form-text">
                        <label class="static-value">
                        kinh độ:
                        </label>                         
                        <input class="form-control title has-value longitude" name="longitude" value="{{@$row->longitude}}" type="text" />
                        
                    </div>
                </div>
                    
                </div>
    
                <style type="text/css">
                    .static-value{
	                    position:absolute;
	                    left:10px;
	                    font-weight:bold;
	                    font-size:0.8em;
	                    color:#444;
	                    top:5px;
                    }
                    .form-text{
	                    position:relative;
                    }
                    .latitude,.longitude{
	                    padding:5px 5px 5px 60px;
                    }
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/proj4js/2.5.0/proj4.js"></script>
<!-- <script src="https://static.dyndns.top/public/plugin/google_api/cord/map.js"></script> -->
<script>
 $(window).on('load', function () {
  var polygon;
  var firstProjection = `+proj=tmerc +lat_0=0 +lon_0=105.75 +k=0.9999 +x_0=500000 +y_0=0 +ellps=WGS84 +towgs84=-191.90441429,-39.30318279,-111.45032835,0.00928836,-0.01975479,0.00427372,0.252906278 +units=m +no_defs`;
  var secondProjection = `+proj=longlat +datum=WGS84  +ellps=WGS84 +no_defs`;

  function renderMap() {
    let stringCoordinateVn2000 = $('#{{$ctrl->name}}').val();

    if (!stringCoordinateVn2000) {
     // alert('Coordinate is empty');
      return;
    }
    
    var arrCoordinateVN200 = stringCoordinateVn2000.split('\n');
    var polygon_qws84 ="" ;
    const arrLocation = arrCoordinateVN200.map(value => {
        const coordinate = value.trim().split(',');
        const location = proj4(firstProjection, secondProjection).forward([
            Number(coordinate[1]),
            Number(coordinate[0])
        ]);
        if (valid_coords(location[1], location[0])) {
        }      
        polygon_qws84 += location[1]+','+location[0]+'\n';
        return { lat: location[1], lng: location[0] };
    });

    $('#{{$ctrl->value}}').val(polygon_qws84);

    let center = arrLocation.reduce(
      (initCenter, value) => {
        return {
          lat: initCenter.lat + value.lat,
          lng: initCenter.lng + value.lng
        };
      },
      { lat: 0, lng: 0 }
    );

    center = {
      lat: center.lat / arrLocation.length,
      lng: center.lng / arrLocation.length
    };

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 17,
      center: { lat: center.lat, lng: center.lng },
      mapTypeId: 'terrain'
    });

    const arrCoords = arrLocation.map(value => {
      return new google.maps.LatLng(value.lat, value.lng);
    });

    polygon = new google.maps.Polygon({
      editable: true,
      paths: arrCoords,
      strokeColor: '#FF0000',
      strokeOpacity: 0.8,
      strokeWeight: 2,
      fillColor: '#FF0000',
      fillOpacity: 0.35,
      map: map,
      draggable: true,
      geodesic: true
    });
  }

  function renderPolygonMap() {
    let stringCoordinateVn2000 = $('#{{$ctrl->value}}').val();

    if (!stringCoordinateVn2000) {
      //alert('Coordinate is empty');
      return;
    }
    var arrCoordinateVN200 = stringCoordinateVn2000.split('\n');
    const arrLocation = arrCoordinateVN200.map(value => {
        const coordinate = value.trim().split(',');   
        return { lat: coordinate[0], lng: coordinate[1] };
    });

    let center = arrLocation.reduce(
      (initCenter, value) => {
        return {
          lat: Number(initCenter.lat) + Number(value.lat),
          lng: Number(initCenter.lng) + Number(value.lng)
        };
      },
      { lat: 0, lng: 0 }
    );

    center = {
      lat: Number(center.lat/arrLocation.length),
      lng: Number(center.lng/arrLocation.length),
    };

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 17,
      center: { lat:center.lat, lng: center.lng},
      mapTypeId: 'terrain'
    });

    const arrCoords = arrLocation.map(value => {
      return new google.maps.LatLng(value.lat, value.lng);
    });

    polygon = new google.maps.Polygon({
      editable: true,
      paths: arrCoords,
      strokeColor: '#FF0000',
      strokeOpacity: 0.8,
      strokeWeight: 2,
      fillColor: '#FF0000',
      fillOpacity: 0.35,
      map: map,
      draggable: true,
      geodesic: true
    });
    polygon.getPaths().forEach(function(path, index){

        google.maps.event.addListener(path, 'insert_at', function(){
        // New point
        });

        google.maps.event.addListener(path, 'remove_at', function(){
        // Point was removed
        });

        google.maps.event.addListener(path, 'set_at', function(){
        // Point was moved
        getPathArea();
        });

    });
  }

  function polygonCenter(poly) {
    var latitudes = [];
    var longitudes = [];
    var vertices = poly.getPath();

    // put all latitudes and longitudes in arrays
    for (var i = 0; i < vertices.length; i++) {
        longitudes.push(vertices.getAt(i).lng());
        latitudes.push(vertices.getAt(i).lat());
    }

    // sort the arrays low to high
    latitudes.sort();
    longitudes.sort();

    // get the min and max of each
    var lowX = latitudes[0];
    var highX = latitudes[latitudes.length - 1];
    var lowy = longitudes[0];
    var highy = longitudes[latitudes.length - 1];

    // center of the polygon is the starting point plus the midpoint
    var centerX = lowX + ((highX - lowX) / 2);
    var centerY = lowy + ((highy - lowy) / 2);

    return (new google.maps.LatLng(centerX, centerY));
}
  function getPathArea() {
    var len = polygon.getPath().getLength();
    var polygon_qws84 ="" ;
    for (var i = 0; i < len; i++) {
      var path = polygon
        .getPath()
        .getAt(i)
        .toUrlValue(6);

        polygon_qws84 += path+'\n';
    }
    $('#{{$ctrl->value}}').val(polygon_qws84);
  }

  function isNumber(string) {
    return isNaN(string);
  }

  function inrange(min, number, max) {
    if (!isNaN(number) && number >= min && number <= max) {
      return true;
    } else {
      return false;
    }
  }
  function valid_coords(number_lat, number_lng) {
    return inrange(-90, number_lat, 90) && inrange(-180, number_lng, 180);
  }

  function preCreateMap() {
    polygon = new google.maps.Map(document.getElementById('map'), {
      zoom: 15,
      center: { lat: 10.2236515728, lng: 105.2247904053 },
      mapTypeId: 'terrain'
    });
    
   
  }
  renderPolygonMap();
  //return preCreateMap();
  $('#btnRenderMap').click(renderMap);
  $('#btnGetLocation').click(getPathArea);
});
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDmsH3ga0_pRYjsJWn-KEOxVAFNIssKWn0&libraries=places" async defer></script>
