 @php
if(App\Model\Admin::_group()!='1' && App\Model\Admin::_group()!='2' )
    $flg_read =    true;
else $flg_read = false;

$makert = $ctrl->att_table;
$dm = md::find($ctrl->att_table,$ctrl->att_key."='".@$row->{$ctrl->att_where}."'")
@endphp

<div class="form-group col-md-2">           
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
                $('.province_id').val('{{@$dm->province_id==''?'79':@$dm->province_id}}');
            </script>
    </div>
    <div class="form-group col-md-12">
        <label style="width:100%;">
            Quận / Huyện
        </label>
            {{Form::select('district_id', App\Model\Geo::getDistrictOptions(@$dm->province_id), @$dm->district_id, ['class'=>'district_id form-control']) }}

    </div>
    <div class="form-group col-md-12">
        <label style="width:100%;">
            Phường / Xã
        </label>

            {{Form::select('ward_id', App\Model\Geo::getDistrictOptions(@$dm->district_id), @$dm->ward_id, ['class'=>'ward_id form-control']) }}

    </div>
    <div class="form-group col-md-12">
        <label style="width:100%;">
            Đường
        </label>
        <div class="input-group">
            <input class="form-control title " id="street" name="{{$makert}}[street]" value="{{@$dm->street}}" type="text" />
            <span id="btn_check_street" class="btn" style="cursor:pointer;padding:10px 5px;"><i class="fa fa-arrow-down"></i></span>
        </div>

    </div>
    <div class="form-group col-md-12">
        <label style="width:100%;">
            ID Marker
        </label>

        <input class="form-control title " id="marker_id" name="{{$makert}}[marker_id]" value="{{@$dm->marker_id}}" type="text" />
        <i><small style="color:#ff0000" id="marker_id_mess"></small></i>
    </div>
    <div class="form-group col-md-12">
            <label style="width:100%;">ID Home</label>
       <div class="input-group">
            <input class="form-control title " id="marker_home_id" type="text" />

           <span id="marker_home_id_link_panel" class="btn" style="cursor:pointer;padding:10px 5px;display:none;">
                <a href="" id="marker_home_id_link">
                    <i class="fa fa-link"></i>
                </a>               
            </span>

            <span id="marker_home_id_mess" class="btn" style="cursor:pointer;padding:10px 5px;" title="Check dữ liệu nhà phố theo ID"><i class="fa fa-arrow-down"></i></span>
            <span id="marker_home_id_marker_mess" class="btn" style="cursor:pointer;padding:10px 5px;"  title="Check dữ liệu nhà phố theo ID Marker"><i class="fa fa-check"></i></span>
        </div>
        <i><small style="color:#ff0000" id="marker_home_id_mess_panel"></small></i>
    </div>             
</div>
<div class="form-group col-md-7">
    <div class="form-group col-md-12">
        <label style="width:100%;">
            Địa chỉ đầy đủ
        </label>
        <div class="col-sm-12">
            <div class="input-group">
                <input id="google-input" name="formatted_address" value="{{@$dm->formatted_address}}"  {{@$ctrl->read==1 || $flg_read?"readonly":""}} placeholder="Nhập Địa chỉ đầy đủ" autocomplete="off" type="text" class="form-control google-input">
                <div class="input-group-append">                    
                    <span id="btn_check_expand" class="btn" style="cursor:pointer"><i class="fa fa-angle-double-down"></i></span>
					<span id="btn_check_data" class="btn" style="cursor:pointer"><i class="fa fa-arrow-down"></i></span>
                    <script>
                        $('#btn_check_expand').click(function () {
                            //$('#panel_expand').toggle();
                            var value = $('#google-input').val();
                             value = value.replace('P.0', 'Phường ');
                            value = value.replace('P.', 'Phường ');
                            value = value.replace('p.0', 'Phường ');
                            value = value.replace('p.', 'Phường ');                            
							value = value.replace('Q.', 'Quận ');
							value = value.replace('q.', 'Quận ');
							var str = value.split('.');
							$('#google-input').val(str[0]);
                        });

                    </script>
                </div>
            </div> 
        </div>
        <ul class="parsley-errors-list">
            <i>Ví dụ: </i>
            <small>326 Võ Văn Kiệt, Cầu Ông Lãnh, Quận 1, Hồ Chí Minh  </small>|
            <small>129 Hoàng Diệu Phường 6 Quận 4 Hồ Chí Minh Vietnam </small>
        </ul>
                    
    </div>
    <div class="form-group col-md-12" id="panel_expand">
        <label style="width:100%;">
            Địa chỉ tùy chỉnh
        </label>
        <div class="col-sm-12">
            <div class="input-group">
                <input id="address-custom" name="formatted_address_custom" value="{{@$dm->formatted_address_custom}}"  {{@$ctrl->read==1 || $flg_read?"readonly":""}} placeholder="Nhập Địa chỉ tùy chỉnh" autocomplete="off" type="text" class="form-control">
                <div class="input-group-append">
                    <span id="btn_replace_data" class="btn" style="cursor:pointer"><i class="fa fa-arrow-down"></i></span>
                </div>
            </div> 
        </div>
        <ul class="parsley-errors-list">
            <i>Địa chỉ gốc:</i>
            <small id="address-old"></small>
        </ul>
    </div>
    <div class="form-group col-md-12">
        <div class="col-sm-12">
            <div id="map" class="map form-control" style="height: 400px;"></div>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-12 form-text">
            <label  style="width:100%">
                Kinh độ, vĩ độ
            </label>
            <input class="form-control" id="lat_lng"  {{@$ctrl->read==1 || $flg_read?"readonly":""}}  value="{{@$dm->lat}},{{@$dm->lng}}" />
        </div>
                    
        <div class="form-group col-md-6 form-text" >
            <label class="static-value">
                Vĩ độ:
            </label>
            <input class="form-control title has-value latitude" id="latitude" name="lat" value="{{@$dm->lat}}" type="text" />

        </div>
        <div class="row col-md-6" style="padding-top:2px;" >
            <label class="col-md-1" id="sync_lat">
                <==
            </label>
            <div class="col-md-11">
                <input class="form-control title has-value latitude" id="check_lat"  value="" type="text" />
            </div>
        </div>

        <div class="form-group col-md-6 form-text"  >
            <label class="static-value">
            kinh độ:
            </label>                         
            <input class="form-control title has-value longitude" id="longitude" name="lng" value="{{@$dm->lng}}" type="text" />
        </div>
        <div class="row col-md-6" style="padding-top:2px;" >
            <label class="col-md-1" id="sync_lng">
                <==
            </label>
            <div class="col-md-11">
                <input class="form-control title has-value latitude" id="check_lng"  value="" type="text" />
            </div>
        </div>

        <div class="form-group col-md-12 form-text">
            <label style="width:100%">
                Place ID
            </label>
            <div class="input-group">
                <input class="form-control" name="place_id" id="place_id" {{@$ctrl->read==1 || $flg_read?"readonly":""}} value="{{@$dm->place_id}}" />
                <div class="input-group-append">
                    <span id="btn_get_placeid" class="btn" style="cursor:pointer"><i class="fa fa-arrow-down"></i></span>
                </div>
            </div> 
        </div>
    </div>
                    
    </div>
<div class="form-group col-md-3">
    <div class="form-group col-md-12">
        <label style="width:100%;">
            Danh sách SS Marker
        </label>
        <ul id="list_markers_street">

        </ul>
   
    </div>
</div>
<style type="text/css">
    .static-value{
	    position:absolute;
	    left:20px;
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
    .marker_dont_exist{
        color:#ff0000 !important;
        list-style:none;

    }
    #list_markers_street{
        list-style:decimal-leading-zero;
    }

    #list_markers_street li{
        color:#1ba5eb;
    }
     #list_markers_street li span{
        color:#f76868;
    }
    .markers_street{
        cursor:pointer;
    }
    #marker_home_id_mess_panel{
        color:#ff0000;
    }
</style>   
<div style="clear:both"></div>
    <script>
        $(document).ready(function () {
        @if(@$dm->formatted_address=='' && request()->segment(2)=='apartment')      
            $('#google-input').val(getCookie("data_map"))
        @endif
        });
    </script>
<script>
var global_district = '{{@$dm->district_id}}';
var global_ward = '{{@$dm->ward_id}}';
var map_lat = {{@$dm->lat!=''?@$dm->lat:0}};
var map_lng = {{@$dm->lng!=''?@$dm->lng:0}};
var default_lat = 22.3038945;
var default_lng = 70.80215989999999;
</script>
<script>

    $(window).on('load', function () {

        var marker;
        if(map_lat=='0' && map_lng=='0')
        {
            map_lat = default_lat;
            map_lng = default_lng;
        }
        var markerLatLng = new google.maps.LatLng(map_lat, map_lng);
        var map = new google.maps.Map(document.getElementById('map'), {
            center: { lat: map_lat, lng: map_lng},
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
                    //$('#place_id').val(this.position.lng());
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
                        $('#place_id').val(results[0].place_id);
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
        /* Get Place Id */

            var ward = "";
            var district = "";
            geocoder.geocode({'location': place.geometry.location}, function(results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    if (results[1]) {

                        $('#place_id').val(results[1].place_id);


                    } else {
                        window.alert('No results found');
                    }

                    for (i = 0; i < results[0].address_components.length; i++) {

                        if (results[0].address_components[i].types[0] == "sublocality_level_1")
                            ward = results[0].address_components[i].long_name;

                        if (results[0].address_components[i].types[0] == "administrative_area_level_2")
                            district = results[0].address_components[i].long_name;
                    }
                    //" + district.replace('Quận', '').trim() + "
                    if (district != '') {
                        // $(".district_id option:text('1')").attr('selected', 'selected');
                        $(".district_id option").filter(function () {
                            //may want to use $.trim in here
                            return $(this).text() == district.replace('Quận', '').trim();
                        }).prop('selected', true);
                                     

                        buildOptionWard();


                    }
                    else $(".district_id").val('');


                    //if ($('#address-custom').val() == '')
                    $('#address-custom').val($('#google-input').val());
                    setCookie("data_map", $('#google-input').val(), 1);
                    //var street = place.address_components[0].short_name +' ' +place.address_components[1].short_name;
                    var address_custom = $('#google-input').val().split(',');
                    var street = address_custom[0];
                    $('#street').val(street);
                     //Get List Marker same
                var form_data_street = new FormData();
                form_data_street.append("street", street);
                form_data_street.append("_token", '{{ csrf_token() }}');
                $.ajax({
                    url: "{{url('admin/ajax/get_marker_by_street')}}",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data_street,
                    type: 'POST',
                    success: function (response) {
                        $('#list_markers_street').html('');
                        if(response.length>0){
                            $.each(response, function (i, data) {



                                var li = '<li class="markers_street"  data-marker_id="' + data.marker_id + '" data-lat="' + data.lat + '"' +
                                        ' data-lng="' + data.lng + '" data-place_id="'+data.place_id+'" data-province_id="'+data.province_id+'" ><span>' + data.formatted_address + '</span></li>';
                                $('#list_markers_street').append(li);
                            });

                            $('.markers_street').click(function () {
                                var data = {
                                    marker_id: $(this).attr('data-marker_id'),
                                    place_id: $(this).attr('data-place_id'),
                                    lat: $(this).attr('data-lat'),
                                    lng: $(this).attr('data-lng'),
                                    province_id: $(this).attr('data-province_id'),
                                }

                               $('#marker_id').val(data.marker_id);
                                $('#lat_lng').val(data.lat+','+data.lng);
                                $('#place_id').val(data.place_id);

                                if($('#latitude').val()=='')
                                    $('#latitude').val(data.lat);
                                else $('#check_lat').val(data.lat);

                                if($('#longitude').val()=='')
                                    $('#longitude').val(data.lng);
                                else $('#check_lng').val(data.lng);

                                $('.province_id').val(data.province_id);
                            });

                        }
                        else{
                             var li = '<li class="marker_dont_exist">Không tìm thấy marker liên quan tới ['+street+']</li>';
                             $('#list_markers_street').append(li);
                        }


                    }
                });

                    $('#btn_replace_data').trigger('click');
                } else {
                    window.alert('Geocoder failed due to: ' + status);
                }
            });

            var form_data = new FormData();
            form_data.append("table", '{{$makert}}');
            form_data.append("key", 'formatted_address');
            form_data.append("value", $('#google-input').val());
            form_data.append("_token", '{{ csrf_token() }}');
            $.ajax({
                url: "{{url('admin/ajax/check_data')}}",
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'POST',
                success: function (result) {
                     if (result.mess == 'success') {
                        var data = result.data;
                        $('#marker_id').val(data.marker_id);
                        $('#lat_lng').val(data.lat+','+data.lng);
                        $('#place_id').val(data.place_id);

                        if($('#latitude').val()=='')
                            $('#latitude').val(data.lat);
                        else $('#check_lat').val(data.lat);

                        if($('#longitude').val()=='')
                            $('#longitude').val(data.lng);
                        else $('#check_lng').val(data.lng);

                         $('.province_id').val(data.province_id);

                        

                         global_district = data.district_id;
                         global_ward = data.ward_id;
                         buildOptionDistrict(buildOptionWard);
                    }
                    else $('#marker_id_mess').html('Không tìm thấy dữ liệu');
                }
            });



            //document.getElementById('location-snap').innerHTML = place.formatted_address;

            //document.getElementById('lat-span').innerHTML = place.geometry.location.lat();

            //document.getElementById('lon-span').innerHTML = place.geometry.location.lng();

        });
        $('#map').css('overflow', 'none');

    });
    $('#btn_replace_data').click(function () {
        var address = $('#address-custom').val();
            var form_data = new FormData();
            form_data.append("address", address);
            form_data.append("_token", '{{ csrf_token() }}');
        $.ajax({
            url: "{{url('admin/ajax/covert_address')}}",
            cache: false,
            contentType: false,
            processData: false,
            data:form_data,
            type: 'POST',
            success: function (result) {
                $('#address-old').html(result.add);
                $('#address-custom').val(result.addnew);
               // if($('#home_title').val()=='')
                 $('#home_title').val(result.addnew);
            }
        });

    });
    $('#btn_check_data').click(function(){
    var form_data = new FormData();
            form_data.append("table", '{{$makert}}');
            form_data.append("key", 'formatted_address');
            form_data.append("value", $('#google-input').val());
            form_data.append("_token", '{{ csrf_token() }}');
            $.ajax({
                url: "{{url('admin/ajax/check_data')}}",
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'POST',
                success: function (result) {
                    if (result.mess == 'success') {
                        var data = result.data;
                        $('#marker_id').val(data.marker_id);
                        $('#lat_lng').val(data.lat+','+data.lng);
                        $('#place_id').val(data.place_id);

                        if($('#latitude').val()=='')
                            $('#latitude').val(data.lat);
                        else $('#check_lat').val(data.lat);

                        if($('#longitude').val()=='')
                            $('#longitude').val(data.lng);
                        else $('#check_lng').val(data.lng);

                        $('.province_id').val(data.province_id);
                        global_district = data.district_id;
                        global_ward = data.ward_id;
                        buildOptionDistrict(buildOptionWard);
                    }

                }
            });
    });

    $('#marker_home_id_marker_mess').click(function(){
    var form_data = new FormData();
            form_data.append("table", 'asm_estate_home');
            form_data.append("key", 'home_marker_id');
            form_data.append("value", $('#marker_id').val());
            form_data.append("type", 'int');
            form_data.append("_token", '{{ csrf_token() }}');
            $.ajax({
                url: "{{url('admin/ajax/check_data')}}",
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'POST',
                success: function (result) {
                    if (result.mess == 'success') {
                        var data = result.data;
                        $('#marker_home_id').val(data.home_id);
                        $('#marker_home_id_link_panel').show();
                        $('#marker_home_id_link').attr('href', '{{url('admin/estate_home/edit')}}/' + data.home_id);

                    }
                     else  $('#marker_home_id_mess_panel').html('Không tìm thấy dữ liệu nhà phố');
                }
            });
    });
    $('#lat_lng').change(function(){
        let geo = $(this).val();
        let latlng = geo.split(',');
        $('#latitude').val(latlng[0]);
        $('#longitude').val(latlng[1]);
    })
    $('#marker_home_id_mess').click(function(){
        var form_data = new FormData();
        form_data.append("table", 'asm_estate_home');
        form_data.append("key", 'home_id');
        form_data.append("value", $('#marker_home_id').val());
        form_data.append("_token", '{{ csrf_token() }}');
        $.ajax({
            url: "{{url('admin/ajax/check_data')}}",
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'POST',
            success: function (result) {
                if (result.mess == 'success') {
                    var data = result.data;
                    $('#marker_home_id').val(data.home_id);
                    $('#marker_home_id_link_panel').show();
                    $('#marker_home_id_link').attr('href', '{{url('admin/estate_home/edit')}}/' + data.home_id);

                }
                    else  $('#marker_home_id_mess_panel').html('Không tìm thấy dữ liệu nhà phố');
            }
        });
    });


    $('#sync_lat').click(function () {
        $('#latitude').val($('#check_lat').val());
    });
    $('#sync_lng').click(function () {
        $('#longitude').val($('#check_lng').val());
    });

$('#btn_get_placeid').click(function(){
        var geocoder = new google.maps.Geocoder();
        var markerLatLng = new google.maps.LatLng($('#latitude').val(), $('#longitude').val());
        geocoder.geocode({'location': markerLatLng}, function(results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
                if (results[1]) {

                    $('#place_id').val(results[1].place_id);
                } else {
                    window.alert('No results found');
                }
            } else {
                window.alert('Geocoder failed due to: ' + status);
            }
        });
});

    $('#btn_check_street').click(function(){
     var street = $('#street').val();

                //Get List Marker same
                var form_data_street = new FormData();
                form_data_street.append("street", street);
                form_data_street.append("_token", '{{ csrf_token() }}');
                $.ajax({
                    url: "{{url('admin/ajax/get_marker_by_street')}}",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data_street,
                    type: 'POST',
                    success: function (response) {
                        $('#list_markers_street').html('');
                        if(response.length>0){
                            $.each(response, function (i, data) {



                                var li = '<li class="markers_street"  data-marker_id="' + data.marker_id + '" data-lat="' + data.lat + '"' +
                                        ' data-lng="' + data.lng + '" data-place_id="'+data.place_id+'" data-province_id="'+data.province_id+'" ><span>' + data.formatted_address + '</span></li>';
                                $('#list_markers_street').append(li);
                            });

                            $('.markers_street').click(function () {
                                var data = {
                                    marker_id: $(this).attr('data-marker_id'),
                                    place_id: $(this).attr('data-place_id'),
                                    lat: $(this).attr('data-lat'),
                                    lng: $(this).attr('data-lng'),
                                    province_id: $(this).attr('data-province_id'),
                                }

                               $('#marker_id').val(data.marker_id);
                                $('#lat_lng').val(data.lat+','+data.lng);
                                $('#place_id').val(data.place_id);

                                if($('#latitude').val()=='')
                                    $('#latitude').val(data.lat);
                                else $('#check_lat').val(data.lat);

                                if($('#longitude').val()=='')
                                    $('#longitude').val(data.lng);
                                else $('#check_lng').val(data.lng);

                                $('.province_id').val(data.province_id);
                            });

                        }
                        else{
                             var li = '<li class="marker_dont_exist">Không tìm thấy marker liên quan tới ['+street+']</li>';
                             $('#list_markers_street').append(li);
                        }


                    }
                });

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

        var buildOptionDistrict = function (callback) {
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
                    $('.district_id').val(global_district);

                    if (callback) {
                        callback();
                    }
                }
            });
        }

        var buildOptionWard = function (callback) {
            var val = $('.district_id').val();
            $.ajax({
                url: "{{url('admin/getWard')}}",
                type: 'post',
                headers: {
                    'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                },
                data: { district_id: val ,json:true},

                success: function (response) {
                    // console.log(response);
                    var select = '<option value="">Phường/Xã</option>';
                    var ward_id = $('#ward_id').val();
                    console.log(ward_id);
                    var response = $.map(response, function (el) { return el });
                    response.sort(function (a, b) {
                        return parseInt(a.name) - parseInt(b.name);
                    });
                    $.each(response, function (i, data) {
                        var selected = data.id === parseInt(ward_id) ? 'selected' : ''
                        select += '<option ' + selected + ' value="' + data.id + '">' + data.name + '</option>';
                    });
                    $('.ward_id').html(select);
                    $('.ward_id').val(global_ward);



                    if (global_ward == '') {
                        try {
                            var re = new RegExp('(, phường )(.*)(,)', "g");
                            newtxt = re.exec($('#google-input').val());


                            var phuong = newtxt[2].split(',')[0];

                            $(".ward_id option").filter(function () {
                                //may want to use $.trim in here
                                return $(this).text() == phuong.replace('phường', '').trim();
                            }).prop('selected', true);

                        } catch (e) {
                            /**/
                        }

                    }


                    if (callback) {
                        callback();
                    }
                }
            });
         }
            function isEmpty(val){
            return (val === undefined || val == null || val.length <= 0) ? true : false;
        }
        //function init() {
        //    buildOptionDistrict(buildOptionWard);
        //}

        $(document).ready(function () {
            $('.province_id').change(function () {
                buildOptionDistrict();
            });
            $('.district_id').change(function () {
                buildOptionWard();
            });

            buildOptionDistrict(buildOptionWard);
        });


     function setCookie(cname, cvalue, exdays) {
            var d = new Date();
            d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
            var expires = "expires=" + d.toUTCString();
            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        }
        function readCookie(name) {
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        }

        function getCookie(cname) {
            var name = cname + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }
        init();

</script>
