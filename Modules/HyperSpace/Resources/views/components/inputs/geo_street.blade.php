@php
    $colLeft = empty($colLeft) ? 12 : $colLeft;
    if($colLeft == 12){
        $colRight = 12;
    }
    $type = (isset($type) && in_array($type, ['text', 'number', 'date', 'password', 'file', 'hidden' , 'email'])) ? $type : 'text';
    $value = old( $name, $value ?? '' );
    if($value && is_array($value)){
        $value = implode(', ', $value);
    }
@endphp
<div class="form-group {{ $rowClass ?? 'col-md-12' }}"
@if(!empty($rowData))
    @foreach($rowData as $dataKey => $dataVal)
        data-{{$dataKey}}="{{ $dataVal }}"
    @endforeach
@endif
>
    <div class="col-md-{{$colLeft}}">
        <div class="form-group">
             @if(!empty($label))
                 <label for="{{ $name }}">{{ $label }}: @if(!empty($required)) <span class="text-danger">*</span>@endif</label>
             @endif
             <div class="street-input-group input-group" style=" ;">
                <input type="hidden" class="form-control geo" value="" name="street" id="street" placeholder="Nhập tên đường" />
                <div style="width: 100%;">
                    {{Form::select($name,$data,$value,["class"=>"form-control geo".$class ?? '','id'=>$name,'data-value'=>$value])}}
                </div>
                <div class="input-group-prepend">
                    <button type="button" class="btn-add-new-street"><i class="fa fa-plus"></i></button>
                    <button type="button" class="btn-add-cancel-street" style="display: none"><i class="fa fa-times"></i></button>
                </div>
            </div>

            <div class="invalid-feedback">
                {{ $errors->first($name)}}
            </div>
        </div>
    </div>
</div>
@push("js")
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$('#street_id').select2({
  ajax: {
    url: '{{url("admin/ajax/geo-street-by-name")}}',
    data: function (params) {
      var query = {
        name: params.term,
        ward: $("#ward_id").val()
      }

      // Query parameters will be ?search=[term]&type=public
      return query;
    },
    dataType: 'json',
    processResults: function (data, params) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.name,
                            id: item.id,
                            data: item
                        };
                    })
                };
            }
  },
});

$(document).on("click",".btn-add-new-street",function(){
    // if( $(".btn-add-new-street").find('i').hasClass("fa-save"))
    // {
        // $("#street").attr('type',"hidden");
        // $("#street_id").parent().show();
        // $(".btn-add-new-street").find('i').removeClass("fa-save").addClass("fa-plus");
        // $(".btn-add-cancel-street").hide();
    // }
    // else{
    //     $("#street_id").parent().hide();
    //     $("#street").attr('type',"text");
    //     $(".btn-add-cancel-street").show();
    //     $(".btn-add-new-street").find('i').removeClass("fa-plus").addClass("fa-save");
    // }
        $("#street_id").parent().hide();
        $("#street_id").attr('data-value', $("#street_id").val());
        $("#street_id").val('')
        $("#street").attr('type',"text");
        $(".btn-add-cancel-street").show();
        $(".btn-add-new-street").hide();
});
$(document).on("click",".btn-add-cancel-street",function(){
    $("#street").attr('type',"hidden");
    $("#street_id").parent().show();
    // $(".btn-add-new-street").find('i').removeClass("fa-save").addClass("fa-plus");
    $(".btn-add-new-street").show();
    $(".btn-add-cancel-street").hide();
});
</script>
<style type="text/css">
.street-input-group{
    display: flex;    flex-wrap: nowrap;border: 1px solid #ddd
}
.street-input-group input{
    border: 0;
}
.btn-add-new-street{
    border: 0;
    color: #005aff;
    height: 35px;
    width: 35px;
}

.btn-add-cancel-street{
    border: 0;
    color: #ef0000;
    height: 35px;
    width: 35px;
}
.btn-add-new-street:focus,.btn-add-new-street:hover,.btn-add-cancel-street:focus,.btn-add-cancel-street:hover{
    outline: none;
    border: 0;
}

.select2-container--default .select2-selection--single{
    height: 35px;
    border: 0;
}
.select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #444;
    line-height: 35px;
}
.select2-container{
    width: 100% !important;
}
</style>
@endpush
