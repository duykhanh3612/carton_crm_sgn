
<div class="form-group {{  $ctrl->width}} ">
    <div class="form-group">
        <label>
            Tỉnh / Thành Phố
        </label>
        <div>
            {{Form::select('province_id', App\Model\Geo::getProvinceOptions(), (@$row->province_id==null?79:@$row->province_id), ['class'=>'province_id form-control']) }}
            <script>
                $('.province_id').val('{{(@$row->province_id==null?79:@$row->province_id)}}');
            </script>
        </div>
    </div>
    <div class="form-group">
        <label>
            Quận Huyện
        </label>
        <div>
            {{Form::select('district_id', App\Model\Geo::getDistrictOptions((@$row->province_id==null?79:@$row->province_id)),@$row->district_id, ['class'=>'district_id form-control']) }}
        </div>
    </div>
    <div class="form-group">
        <label>
            Phường xã
        </label>
        <div>
            {{Form::select('ward_id', App\Model\Geo::getWardOptions((@$row->district_id==null?760:@$row->district_id)),@$row->ward_id, ['class'=>'ward_id form-control']) }}
        </div>
    </div>
    <script>
    var global_district = '{{@$row->district_id}}';
    var global_ward = '{{@$row->ward_id}}';
    var map_lat = {{@$row->lat!=''?@$row->lat:0}};
    var map_lng = {{@$row->lng!=''?@$row->lng:0}};
    var default_lat = 22.3038945;
    var default_lng = 70.80215989999999;
    </script>
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
        function init() {

            buildOptionDistrict(buildOptionWard);
        }

        $(document).ready(function () {
            $('.province_id').change(function () {
                buildOptionDistrict(buildOptionWard);
            });

            $('.district_id').change(function () {
                buildOptionWard();
            });
        });

        init();
    </script>
</div>

