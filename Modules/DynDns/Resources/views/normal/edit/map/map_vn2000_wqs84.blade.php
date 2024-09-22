      @php
if(App\Model\Admin::_group()!='1' && App\Model\Admin::_group()!='2' )
    $flg_read =    true;
else $flg_read = false;
@endphp
<div class="box-body">
    <div class="row">
        <div id="mapDiv" class="col-sm-12" style="display: block;">
            <div class="form-group col-md-4">
               

                        <div class="form-group col-md-12">
                            <label style="width:100%;">
                                Tỉnh / Thành Phố
                                </label>

                                <select class="province_id form-control" {{@$ctrl->read==1 || $flg_read?"readonly disabled":"name=province_id"}}>
                                    @foreach(App\Model\Geo::getProvince() as $p)
                                    <option value="{{$p->id}}" data-code="{{$p->code}}">{{    $p->name}}</option>
                                    @endforeach
                                </select>
                                <script>
                                    $('.province_id').val('{{@$row->province_id==''?'91':@$row->province_id}}');

                                </script>
</div>
                        <div class="form-group col-md-12">
                            <label style="width:100%;">
                                Quận Huyện
                            </label>
                            
                                {{Form::select('district_id', App\Model\Geo::getDistrictOptions(@$row->province_id), @$row->district_id, ['class'=>' district_id form-control','readonly'=>@$ctrl->read==1 || $flg_read?"true":"false",'disabled'=>@$ctrl->read==1 || $flg_read?"true":"false"]) }}
                            
                        </div>
             


                <label class="form-group col-md-12">
                    Nhập danh sách hệ tọa độ
                </label>
                <div class="form-group col-md-12">
                    <div class="col-sm-12">
                        <textarea placeholder="
                        446873.37,1111884.10</br>
                        444120.64,1132744.13</br>
                        444128.27,1132746.16</br>
                        444142.04,1132719.31</br>
                        444133.26,1132716.91"
                                     id="{{$ctrl->name}}" {{@$ctrl->read==1 || $flg_read?"readonly":"name=".@$ctrl->name.$lang}} rows="12" cols="80" style="width:100%" type="text" class="form-control jq_watermark">{{@$row->{$ctrl->name} }}</textarea>
                          <em>Lưu ý: phải chọn tỉnh thành trước khi chuyển đổi</em>           
                         <script type="text/javascript" src="../../plugin/jquery/jquery.watermark.js"></script>
                                     
                    </div>
                </div>
                <div class="form-group col-md-6" style="display:none">
                    <div class="col-sm-12">
                        <textarea placeholder="QWS84" id="{{$ctrl->value}}"  name="{{$ctrl->value}}"  rows="12"  type="text" class="form-control">{{@$row->{$ctrl->value} }}</textarea>
                    </div>
                </div>
                @if(@$ctrl->read!=1 && !$flg_read)
                <div class="form-group col-md-12" style="text-align:center;">
                        <label class="btn bd2742"   {{@$ctrl->read==1 || $flg_read?"style=background-color:#cccccc":"id=btnRenderMap"}} style="width:130px;">Chuyển đổi</label>         
                        <label class="btn" id="btnGetLocation" style="display:none">Get Polygon</label>  
                 </div>               
                @endif
            </div>
            <div class="form-group col-md-8">
                <div class="form-group col-md-12">
                    <label style="width:100%;">
                        Địa chỉ đầy đủ
                    </label>
                    <div class="col-sm-12">
                        <input id="google-input"  {{@$ctrl->read==1 || $flg_read?"readonly":""}} placeholder="Nhập Địa chỉ đầy đủ" autocomplete="off" type="text" class="form-control google-input">
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <div class="col-sm-12">
                        <div id="map" class="map form-control" style="height: 400px;"></div>
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <div class="form-group col-md-12 form-text">
                        <label  style="width:100%">
                            Kinh độ, vĩ độ
                        </label>
                        <input class="form-control" id="lat_lng"  {{@$ctrl->read==1 || $flg_read?"readonly":""}}  value="{{@$row->latitude}},{{@$row->longitude}}" />
                    </div>

                    <div class="form-group col-md-6 form-text" style="display:none;">
                        <label class="static-value">
                            Vĩ độ:
                        </label>
                        <input class="form-control title has-value latitude" id="latitude" name="latitude" value="{{@$row->latitude}}" type="text" />

                    </div>
                    <div class="form-group col-md-6 form-text"  style="display:none;">
                        <label class="static-value">
                        kinh độ:
                        </label>                         
                        <input class="form-control title has-value longitude" id="longitude" name="longitude" value="{{@$row->longitude}}" type="text" />
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
                    $('#lat_lng').val(this.position.lat() + ',' + this.position.lng());
                    //alert('drag');
                });

        var geocoder = new google.maps.Geocoder();

        google.maps.event.addListener(marker, 'dragend', function (event) {
            $('.latitude').val(this.position.lat());
            $('.longitude').val(this.position.lng());
            $('#lat_lng').val(this.position.lat() + ',' + this.position.lng());
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
            $('#lat_lng').val(place.geometry.location.lat() + ',' + place.geometry.location.lng());
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

      function getLongitude(idlongItude) {
        switch (idlongItude) {
          case 'LCa':
          case 'ĐB':
            return '103.00';
          case 'LC':
          case 'PT':
          case 'NA':
          case 'AG':
            return '104.45';
          case 'KG':
            return '104.50';
          case 'CM':
            return '104.30';
          case 'SL':
          case 'YB':
            return '104.00';
          case 'VP':
          case 'HN':
          case 'HNa':
          case 'NB':
          case 'TH':
          case 'ĐT':
          case 'CT':
          case 'HG':
          case 'BL':
            return '105.00';
          case 'HG':
          case 'BN':
          case 'HD':
          case 'HY':
          case 'NĐ':
          case 'TB':
          case 'HT':
          case 'TNi':
          case 'VL':
          case 'TV':
          case 'ST':
            return '105.30';
          case 'BD':
          case 'BT':
          case 'HCM':
            return '105.45';
          case 'TQ':
          case 'HB':
          case 'QB':
            return '106.00';
          case 'QT':
          case 'BP':
            return '106.15';
          case 'CB':
          case 'HP':
          case 'LA':
          case 'TG':
            return '105.45';
          case 'LS':
            return '107.15';
          case 'BC':
          case 'TN':
            return '106.30';
          case 'BG':
          case 'TTH':
            return '107.00';
          case 'QNi':
          case 'ĐN':
          case 'QN':
          case 'LĐ':
          case 'ĐNa':
          case 'BRVT':
            return '107.45';
          case 'KT':
            return '107.30';
          case 'Qng':
            return '108.00';
          case 'BĐ':
          case 'KH':
          case 'NT':
            return '108.15';
          case 'GL':
          case 'ĐLa':
          case 'ĐNo':
          case 'PY':
          case 'BT':
            return '108.30';
        }
      }

      function setProjection(valueLongitude) {
        return `+proj=tmerc +lat_0=0 +lon_0=${valueLongitude} +k=0.9999 +x_0=500000 +y_0=0 +ellps=WGS84 +towgs84=-191.90441429,-39.30318279,-111.45032835,0.00928836,-0.01975479,0.00427372,0.252906278 +units=m +no_defs`;
      }

        var polygon;
        // var firstProjection = `+proj=tmerc +lat_0=0 +lon_0=104.5 +k=0.9999 +x_0=500000 +y_0=0 +ellps=WGS84 +towgs84=-191.90441429,-39.30318279,-111.45032835,0.00928836,-0.01975479,0.00427372,0.252906278 +units=m +no_defs`;
        var secondProjection = `+proj=longlat +datum=WGS84  +ellps=WGS84 +no_defs`;

       function renderMap() {

           let stringCoordinateVn2000 = $('#{{$ctrl->name}}').val().replace(/(?:(?:\r\n|\r|\n)\s*){2}/gm, "");
           $('#{{$ctrl->name}}').val(stringCoordinateVn2000);

          let selectLongitude = $('.province_id').find(":selected").attr('data-code');
          console.log(selectLongitude);

          let valueLongitude = getLongitude(selectLongitude);
          let firstProjection = setProjection(valueLongitude);
          if (!stringCoordinateVn2000) {
            alert('Coordinate is empty');
            return;
          }
          console.log(valueLongitude);

           var arrCoordinateVN200 = stringCoordinateVn2000.split('\n');

           var polygon_qws84 = "";
           var lat = "";
          var lng ="" ;
          const arrLocation = arrCoordinateVN200.map(value => {
            const coordinate = value.trim().split(',');

            const location = proj4(firstProjection, secondProjection).forward([
              Number(coordinate[0]),
              Number(coordinate[1])
            ]);
            if (valid_coords(location[1], location[0])) {
              }

              if (polygon_qws84 == '') {
                  lat = location[1];
                  lng = location[0];
              }
              polygon_qws84 += location[1] + ',' + location[0] + '\n'; //Set polygyn qws84


            return { lat: location[1], lng: location[0] };
          });


          $('#latitude').val(lat);
          $('#longitude').val(lng);
          $('#{{$ctrl->value}}').val(polygon_qws84); //Updat QWS84
          $('#lat_lng').val(lat+ ',' + lng);

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
        function getPathArea() {
          var len = polygon.getPath().getLength();
          for (var i = 0; i < len; i++) {
            var path = polygon
              .getPath()
              .getAt(i)
              .toUrlValue(6);

            console.log(path);
          }
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

        function getLocation() {
          if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(renderLocation);
          } else {
            alert('Geolocation is not supported by this browser.');
          }
        }

        function renderLocation(position) {
          var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 17,
            center: { lat: position.coords.latitude, lng: position.coords.longitude },
            mapTypeId: 'terrain'
          });

          var marker = new google.maps.Marker({
            position: {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            },
            map: map,
            title: 'Hello World!'
          });
        }

       // return preCreateMap();
       renderPolygonMap();
       $('#btnRenderMap').click(renderMap);
        // $('#btnGetLocation').click(getPathArea);
        // $('#btnMyLocation').click(getLocation);
   });
</script>



<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDmsH3ga0_pRYjsJWn-KEOxVAFNIssKWn0&libraries=places" async defer></script>
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
