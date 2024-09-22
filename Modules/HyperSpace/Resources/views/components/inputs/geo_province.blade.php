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
<div class="form-group {{ $rowClass ?? 'col-md-12' }}" @if(!empty($rowData)) @foreach($rowData as $dataKey=> $dataVal)
    data-{{$dataKey}}="{{ $dataVal }}"
    @endforeach
    @endif
    >
    <div class="col-md-{{$colLeft}}">
        <div class="form-group">
            @if(!empty($label))
            <label for="{{ $name }}">{{ $label }}: @if(!empty($required)) <span
                    class="text-danger">*</span>@endif</label>
            @endif
            {{Form::select($name,$data,$value,["class"=>"form-control geo ".$class ?? '','id'=>$name])}}
            <input type="hidden" value="" name="province" id="province" />
            <input type="hidden" value="{{elasticsearch(@$record->address)}}" name="address_search" id="address_search" />
            <div class="invalid-feedback">
                {{ $errors->first($name)}}
            </div>
        </div>
    </div>

    @push('js')
    <script>
        $(document).ready(function(){
            var buildOptionDistrict = function (callback) {
                $.ajax({
                    url: "{{route('admin.ajax.geo.district')}}",
                    type: 'post',
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: { province: $('#province_id').val(), json:true },
                    dataType: "json",
                    success: function (response) {
                        var select = '<option value="">Quận/Huyện</option>';
                        var district_id = $('#district_id').val();
                        $.each(response, function (i, data) {
                            var selected = data.id === parseInt(district_id) ? 'selected' : ''
                            select += '<option ' + selected + ' value="' + data.id + '">' + data.name + '</option>';
                        });
                        $('#district_id').html(select);

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
                $.ajax({
                    url: "{{route('admin.ajax.geo.ward')}}",
                    type: 'post',
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: { district: $('#district_id').val() ,json:true},
                    dataType: "json",
                    success: function (response) {
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
                $('#province_id').change(function () {
                    buildOptionDistrict();
                    $("#province").val($( $('#province_id')).find("option:selected").text());
                });
                $('#district_id').change(function () {
                    buildOptionWard();
                    $("#district").val($("#district_id").find("option:selected").text());
                });
                $('#ward_id').change(function () {
                    $("#ward").val($("#ward_id").find("option:selected").text());
                });
                $('#street_id').change(function () {
                    $("#street").val($("#street_id").find("option:selected").text());
                });

                if( $('#province_id').val()!="")
                {
                    $("#province").val($( $('#province_id')).find("option:selected").text());
                }

                if( $('#street_id').val()!="")
                {
                    $("#street").val($("#street_id").find("option:selected").text());
                }

                $(document).on("change",".geo, #check_show_home_number",function(){

                    let address = "";
                    if($("input[name=home_number]").val() != "" && !$("#check_show_home_number").prop("checked"))
                    {
                        address += $("input[name=home_number]").val();
                    }
                    if($("input[name=street]").val() != "")
                    {
                        if(address !="") address += " ";
                        address +=  $("input[name=street]").val();
                    }
                    if($("input[name=ward]").val() != "")
                    {
                        address += ", "+$("input[name=ward]").val();
                    }
                    if($("input[name=district]").val() != "")
                    {
                        address += ", "+$("input[name=district]").val();
                    }
                    if($("input[name=province]").val() != "")
                    {
                        address += ", "+$("input[name=province]").val();
                    }
                    $('#address').val(address.trim());
                    $.ajax({
                        url: "{{route('admin.ajax.elasticsearch')}}",
                        type: 'post',
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: { str: address ,json:true},
                        dataType: "json",
                        success: function (response) {
                            $("#address_search").val(response);
                        }
                    });
                });
                buildOptionDistrict(buildOptionWard);
            });

        });
    </script>
    @endpush
</div>
