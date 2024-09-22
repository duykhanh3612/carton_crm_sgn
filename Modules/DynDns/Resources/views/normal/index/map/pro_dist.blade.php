<div class="row">  
    <div class="col-sm-12" style="display: block;">
        <div class="form-group col-md-12">
            <label>
                Tỉnh / Thành Phố
            </label>
            <div class="col-sm-12">
                {{Form::select('province_id', App\Model\Geo::getProvinceOptions(), @$row->province_id, ['class'=>'province_id form-control']) }}   
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

