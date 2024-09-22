@php
$colLeft = empty($colLeft) ? 12 : $colLeft;
if($colLeft == 12){
$colRight = 12;
}
$type = (isset($type) && in_array($type, ['text', 'number', 'date', 'password', 'file', 'hidden' , 'email'])) ? $type :
'text';
$value = old( $name, $value ?? '' );
if($value && is_array($value)){
$value = implode(', ', $value);
}
@endphp
<div class="row {{ $width ?? '' }}">
    <div class="col-md-{{$colLeft}}">
        <div class="form-group">
            @if(!empty($label))
            <label for="{{ $name }}">{{ $label }}: @if(!empty($required)) <span
                    class="text-danger">*</span>@endif</label>
            @endif
            {{Form::select($name,\App\Models\Geo::getProvinceOptions(), $value??79,["class"=>"form-control select2 ".@$class ?? '','id'=>$name])}}
            <input type="hidden" value="" name="province" id="province" />
            <div class="invalid-feedback">
                {{ $errors->first($name)}}
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function(){
            var buildOptionDistrict = function (callback) {

                if(formPopupModal!=undefined)
                {
                    province = $(formPopupModal).find('#province_id').val();
                }
                else{
                    province = $('#province_id').val();
                }
                $.ajax({
                    url: "{{route('admin.ajax.geo.district')}}",
                    type: 'post',
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: { province: province, json:true },
                    dataType: "json",
                    success: function (response) {
                        var select = '<option value="">Quận/Huyện</option>';
                        if(formPopupModal!=undefined)
                        {
                            var district_id = $(formPopupModal).find('#district_id').data("value");
                        }
                        else{
                            var district_id = $('#district_id').data("value");
                        }

                        $.each(response, function (i, data) {
                            var selected = data.id === parseInt(district_id) ? 'selected' : ''
                            select += '<option ' + selected + ' value="' + data.id + '">' + data.name + '</option>';
                        });


                        if(formPopupModal!=undefined)
                        {
                            $(formPopupModal).find('#district_id').html(select);
                        }
                        else{
                            $('#district_id').html(select);
                        }


                        if($('#district_id').attr("data-value")!="")
                        {
                            $('#district_id').val($('#district_id').attr("data-value"));
                            $("#district").val($("#district_id").find("option:selected").text());
                            $('#district_id').attr("data-value","");
                        }
                        if (callback) {
                            callback();
                        }
                    }
                });
            }
            var buildOptionWard = function (callback) {
                if(formPopupModal!=undefined)
                {
                    district = $(formPopupModal).find('#district_id').val();
                }
                else{
                    district = $('#district_id').val();
                }
                $.ajax({
                    url: "{{route('admin.ajax.geo.ward')}}",
                    type: 'post',
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: { district: district ,json:true},
                    dataType: "json",
                    success: function (response) {
                        var select = '<option value="">Phường/Xã</option>';
                        if(formPopupModal!=undefined)
                        {
                            var ward_id = $(formPopupModal).find('#ward_id').data("value");
                        }
                        else{
                            var ward_id = $('#ward_id').data("value");
                        }
                        var response = $.map(response, function (el) { return el });
                        response.sort(function (a, b) {
                            return parseInt(a.name) - parseInt(b.name);
                        });
                        $.each(response, function (i, data) {
                            var selected = data.id === parseInt(ward_id) ? 'selected' : ''
                            select += '<option ' + selected + ' value="' + data.id + '">' + data.name + '</option>';
                        });
                        $('#ward_id').html(select);
                        if($('#ward_id').attr("data-value")!="")
                        {
                            $('#ward_id').val($('#ward_id').attr("data-value"));
                            $("#ward").val($("#ward_id").find("option:selected").text());
                            $('#ward_id').attr("data-value","");
                        }
                        // $('.ward_id').val(global_ward);



                        // if (global_ward == '') {
                        //     try {
                        //         var re = new RegExp('(, phường )(.*)(,)', "g");
                        //         newtxt = re.exec($('#google-input').val());


                        //         var phuong = newtxt[2].split(',')[0];

                        //         $(".ward_id option").filter(function () {
                        //             //may want to use $.trim in here
                        //             return $(this).text() == phuong.replace('phường', '').trim();
                        //         }).prop('selected', true);

                        //     } catch (e) {
                        //         /**/
                        //     }

                        // }


                        if (callback) {
                            callback();
                        }
                    }
                });
            }
            function isEmpty(val){
                return (val === undefined || val == null || val.length <= 0) ? true : false;
            }
            $(document).ready(function () {
                $(document).on("change",'#province_id',function () {
                    buildOptionDistrict();
                    $("#province").val($(this).find("option:selected").text());
                });
                $(document).on("change",'#district_id',function () {
                    buildOptionWard();
                    $("#district").val($("#district_id").find("option:selected").text());
                });
                $(document).on("change",'#ward_id',function () {
                    $("#ward").val($("#ward_id").find("option:selected").text());
                });

                // tag_modal = $(this).closest(".modal").length>0?$(this).closest(".modal").attr("id"):false;
                // alert(tag_modal);
                buildOptionDistrict(buildOptionWard);
            });

        });
    </script>

</div>
