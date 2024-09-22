@php

if(!empty($model[@$thead['table']]) && @$record->{@$thead['field']}!="")
{
    $model = new $model[@$thead['table']];
    $items = $model::where(@$thead['table_where_field'],$record->{@$thead['field']})->get();
}
else{
    $items = [];
}

    $id = !empty($id) ? $id : '';
    $value = json_encode($items);
    $rent_type = get_options_keynum_data("rent_type");
@endphp
<div class="form-group {{ $rowClass ?? 'col-md-12' }}"  id="list_estates_customer">
    <textarea name="estates_customer" id="estates_customer" style="width: 100%;display:none;">{{ $value ?? '' }}</textarea>
    <div class="col-md-8">
        <table class="table">
            <thead>
                <tr>
                    <th class="text-center" style="vertical-align: middle;">#</th>
                    <th class="text-center" style="vertical-align: middle;">Sản phẩm</th>
                    <th class="text-center" style="width: 75px;vertical-align: top;">Diện tích  <br><small> (m<sup>2</sup>)</small></th>
                    <th class="text-center" style="vertical-align: top;">Lầu<br><small> (m<sup>2</sup>)</small></th>
                    <th class="text-center" style="vertical-align: top;">Giá chốt</th>
                    <th class="text-center" style="vertical-align: top;">Phí hoa hồng</th>
                    <th class="text-center" style="vertical-align: top;">Thời hạn HĐ</th>
                    <th class="text-center" style="vertical-align: top;">Ngày thu phí</th>
                    <th style="width: 80px;vertical-align: middle;" class="action">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($items))
                @foreach ($items as $r)
                <tr data-id="{{$r->id}}">
                    <th >{{$loop->index+1}}</th>
                    <th class="estate_id" data-value="{{$r->estate_id}}">{{$r->estate_name}}</th>
                    <th class="area text-right" data-value="{{$r->area}}">
                        {{$r->area}}
                    </th>
                    <th class="floor" data-value="{{$r->floor}}">
                        {{is_numeric($r->floor)?number_format(intval($r->floor)):$r->floor}}
                    </th>

                    <th class="price  text-right" data-value="{{$r->price}}">
                        {{is_numeric($r->price)? number_format(intval($r->price)):$r->price}}
                    </th>
                    <th class="fee  text-right" data-value="{{$r->fee}}">
                        {{is_numeric($r->fee)? number_format(intval($r->fee)):$r->fee}}
                    </th>

                    <th class="contract_term" data-value="{{$r->contract_term}}">
                        {{$r->contract_term}}
                    </th>
                    <th class="date_term" data-value="{{$r->date_term}}">
                        {{$r->date_term}}
                    </th>
                    <th class="action"><span class="item_rental_edit"><i class="fa fa-edit"></i></span><span class="item_rental_remove"><i class="fa fa-times"></i></span></th>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <div class="col-md-4" id="form_estates_customer">

        @include('admin::components.inputs.select', ['label'=>'Sản phẩm','name'=>'','required'=> null, 'class'=>'estate_id select2','data'=>Estates::getOption(), 'value'=> '',  'colLeft'=>12])
        @include('admin::components.inputs.text', ['label'=>'Diện tích','name'=>'','required'=> null, 'class'=>'area input_money','rowClass'=>'nomargin',  'value'=> '', 'colLeft'=>6])
        @include('admin::components.inputs.text', ['label'=>'Lầu', 'name'=>'','class'=>'floor','rowClass'=>'nomargin','required'=> null, 'value'=> '',  'colLeft'=>6])
        @include('admin::components.inputs.text', ['label'=>'Giá chốt','name'=>'','required'=> null, 'class'=>'price input_money','rowClass'=>'nomargin', 'value'=> '',  'colLeft'=>6])
        @include('admin::components.inputs.text', ['label'=>'Phí hoa hồng','name'=>'','required'=> null, 'class'=>'fee input_money','rowClass'=>'nomargin', 'value'=> '', 'colLeft'=>6])
        @include('admin::components.inputs.textarea', ['label'=>'Thời han hợp đồng','name'=>'','required'=> null, 'class'=>'contract_term text-left', 'value'=> '',  'colLeft'=>12])
        @include('admin::components.inputs.text', ['label'=>'Ngày thu phí','name'=>'', 'class'=>'date_term','value'=> '','required'=> null,  'colLeft'=>12])
        @include('admin::components.inputs.text', ['label'=>'','type'=>'hidden','name'=>'', 'class'=>'estates_trade', 'value'=> '', 'required'=> null, 'colLeft'=>12])
        <div class="col-md-12" style="margin: 0 15px;">
            {{-- <button class="btn" id="btn-lrp-add" type="button">Thêm mới</button> --}}
            <button class="btn" id="btn-lrp-update" type="button">Thêm mới</button>
            <button class="btn" id="btn-lrp-reset" type="button">Reset</button>
        </div>
    </div>
    @push("js")
    <script>
        var currency_unit = jQuery.parseJSON(String('{{ json_encode(Currencies::getOption()) }}').replace(/(&quot\;)/g,"\""));
        var rent_type_unit = jQuery.parseJSON(String('{{ json_encode($rent_type) }}').replace(/(&quot\;)/g,"\""));
        var rate = "{{Currencies::getRate()}}";
        var decimal = 2;
        $(document).on("click","#btn-lrp-update",function(){
            table  = $("#list_estates_customer").find("table").find("tbody");
            form = $("#list_estates_customer").find("#form_estates_customer");
            id = form.find('.estates_trade').val();
            if(id==""){
                no = table.find('tr').length + 1;
            }
            else{
                no =  table.find("tr[data-id='"+id+"']").find("th:nth-child(1)").text();
            }

            estate_id = form.find('.estate_id').val();
            estate_name = form.find('.estate_id > option:selected').text();
            area = form.find('.area').val();
            floor = form.find('.floor').val();
            price = form.find('.price').val();
            fee  = form.find('.fee').val();
            contract_term = form.find('.contract_term').val();
            date_term = form.find('.date_term').val();
            html = `
                    <th >${no}</th>
                    <th class="estate_id" data-value="${estate_id}">${estate_name}</th>
                    <th class="estate_name" data-value="${estate_name}" style="display:none">${estate_name}</th>
                    <th class="area" data-value="${area}">${area}</th>
                    <th class="floor" data-value="${floor}">${floor}</th>
                    <th class="price text-right" data-value="${number_decimai(price)}">${price}</th>
                    <th class="fee text-right" data-value="${number_decimai(fee)}">${fee}</th>
                    <th class="contract_term text-right" data-value="${contract_term}">${contract_term}</th>
                    <th class="date_term text-right" data-value="${date_term}">${date_term}</th>
                    <th><span class="item_rental_edit"><i class="fa fa-edit"></i></span><span class="item_rental_remove"><i class="fa fa-times"></i></span></th>
                `;
            if(id==""){
                id = generateUUID();
                table.append("<tr data-id='"+id+"'>"+html+"</tr>");
            }
            else
                table.find("tr[data-id='"+id+"']").html(html);
            getDataRentalProperties();
            var item = {
                    id : "",
                    estate_id: "",
                    area: "",
                    floor: "",
                    price : 1,
                    fee: "",
                    contract_term: "",
                    date_term: ""
            };
            setDataFormProperties(item);
            $("#btn-lrp-update").html("Thêm mới");

        });
        $(document).on("click",".item_rental_remove",function(){
            $(this).closest("tr").remove();
            getDataRentalProperties();
        });
        $(document).on("click",".item_rental_edit",function(){
            tag = $(this).closest("tr");
            id = tag.attr('data-id');
            estate_id = tag.find('.estate_id').attr("data-value");
            price = tag.find('.price').attr("data-value");
            area = tag.find('.area').attr("data-value");
            floor = tag.find('.floor').attr("data-value");
            fee = tag.find('.fee').attr("data-value");
            contract_term = tag.find('.contract_term').attr("data-value");
            date_term = tag.find('.date_term').attr("data-value");

            var item = {
                    id : id,
                    price: price,
                    fee: fee,
                    area: area,
                    floor: floor,
                    estate_id: estate_id,
                    contract_term:contract_term,
                    date_term: date_term
            };
            setDataFormProperties(item);
            $("#btn-lrp-update").html("Cập nhật");
        });

        function setDataFormProperties(item)
        {
            form = $("#form_estates_customer");
            form.find(".estate_id").val(number_format(item.estate_id));
            form.find(".price").val(number_format(item.price));
            form.find(".area").val(item.area);
            form.find(".floor").val(item.floor);
            form.find(".fee").val(item.fee);
            form.find(".contract_term").val(item.contract_term);
            form.find(".date_term").val(item.date_term);
            form.find(".estates_trade").val(item.id);
        }
        function getDataRentalProperties()
        {
            table  = $("#list_estates_customer").find("table").find("tbody");
            var list = [];
            $('#list_estates_customer table tbody tr').each(function() {

                form = $(this);
                id = form.attr("data-id");
                estate_id = form.find('.estate_id').attr("data-value");
                estate_name   = form.find('.estate_name').attr("data-value");
                area = form.find('.area').attr("data-value");
                floor = form.find('.floor').attr("data-value");
                price = form.find('.price').attr("data-value");
                fee = form.find('.fee').attr("data-value");
                contract_term = form.find('.contract_term').attr("data-value");
                date_term = form.find('.date_term').attr("data-value");
                var obj_detail = {
                    id : id,
                    estate_id: estate_id,
                    estate_name: estate_name,
                    area: area,
                    floor: floor,
                    price: price,
                    fee: fee,
                    contract_term: contract_term,
                    date_term: date_term
                };
                // if (title != '' || content != '' || image != '' || icon != '' || note != '' || link != '')
                list.push(obj_detail);
            });
            $("#estates_customer").val(JSON.stringify(list));
        }
        function generateUUID() {
            var d = new Date().getTime();//Timestamp
            var d2 = ((typeof performance !== 'undefined') && performance.now && (performance.now()*1000)) || 0;//Time in microseconds since page-load or 0 if unsupported
            return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
                var r = Math.random() * 16;//random number between 0 and 16
                if(d > 0){//Use timestamp until depleted
                    r = (d + r)%16 | 0;
                    d = Math.floor(d/16);
                } else {//Use microseconds since page-load if supported
                    r = (d2 + r)%16 | 0;
                    d2 = Math.floor(d2/16);
                }
                return (c === 'x' ? r : (r & 0x3 | 0x8)).toString(16);
            });
        }
        function number_format(nStr)
        {
            if(!$.isNumeric(nStr))
            {
                return nStr;
            }
            nStr += '';
            x = nStr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + ',' + '$2');
            }
            return x1 + x2;
        }
        function number_decimai(value)
        {
            if(value == "") value = 0;
            return parseFloat(String(value).replace(/\W/g, ''));
        }
        function round(value, precision, mode) {
            var m, f, isHalf, sgn;
            precision |= 0;
            m = Math.pow(10, precision);
            value *= m;
            sgn = (value > 0) | -(value < 0);
            isHalf = value % 1 === 0.5 * sgn;
            f = Math.floor(value);
            if (isHalf) {
                switch (mode) {
                    case 'PHP_ROUND_HALF_DOWN':
                        value = f + (sgn < 0);
                        break;
                    case 'PHP_ROUND_HALF_EVEN':
                        value = f + (f % 2 * sgn);
                        break;
                    case 'PHP_ROUND_HALF_ODD':
                        value = f + !(f % 2);
                        break;
                    default:
                        value = f + (sgn > 0);
                }
            }
            return (isHalf ? value : Math.round(value)) / m;
        }
        $(document).ready(function(){
            $(".estate_id").select2();
        });

    </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
        <script>
            $('.input_money').mask('#,##0', {
                reverse: true
            });
        </script>
    @endpush
    <style type="text/css">
    .nomargin{
        margin: 0 -15px !important;

    }
    #list_estates_customer table{
        border:  1px solid #dee2e6;
    }
    #list_estates_customer table tr td,   #list_estates_customer table tr th{
        border:  1px solid #dee2e6;
    }
    .item_rental_edit{
        padding:  5px;
        color: rgb(1, 129, 248);
    }
    .item_rental_remove{
        padding:  5px;
        color: rgb(248, 9, 9);
    }
    .lock #list_estates_customer .action{
        display: none;
    }
    </style>
</div>
