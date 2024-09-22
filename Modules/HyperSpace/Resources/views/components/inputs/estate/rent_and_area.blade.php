@php
    $id = !empty($id) ? $id : '';
    $value = json_encode($items);

    $rent_type = get_options_keynum_data("rent_type");
@endphp
<div class="form-group {{ $rowClass ?? 'col-md-12' }}"  id="list_rental_properties">
    <textarea name="rental_properties" id="rental_properties" style="width: 100%;display:none;">{{ $value ?? '' }}</textarea>
    <div class="col-md-8">
        <table class="table">
            <thead>
                <tr>
                    <th class="text-center" style="vertical-align: middle;">#</th>
                    <th class="text-center" style="vertical-align: middle;">Lầu</th>
                    <th class="text-center" style="width: 75px;vertical-align: top;">Đơn giá  <br><small> (usd/m2)</small></th>
                    <th class="text-center" style="vertical-align: top;">Diện tích <br><small> (m<sup>2</sup>)</small></th>
                    <th class="text-center" style="width: 75px;vertical-align: top;">Đơn vị tính</th>
                    <th  class="text-center" style="vertical-align: top;">Loại</th>
                    <th  class="text-center" style="vertical-align: top;">Phí dịch vụ</th>
                    <th  class="text-center" style="vertical-align: top;">Giá tổng
                         <br><small>(USD)</small>
                    </th>
                    <th  class="text-center" style="vertical-align: top;">Giá tổng <br><small>(VNĐ)</small></th>
                    {{-- <th>Ghi chú</th> --}}
                    <th style="width: 80px;" style="vertical-align: middle;">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($items))
                @foreach ($items as $r)
                <tr data-id="{{$r->id}}">
                    <th >{{$loop->index+1}}</th>
                    <th class="floor text-center" data-value="{{$r->floor}}">{{$r->floor}}</th>
                    <th class="price  text-right" data-value="{{$r->price}}">
                        {{is_numeric($r->price)? number_format(intval($r->price)):$r->price}}
                    </th>
                    <th class="currency" data-value="{{$r->currency}}" style="display:none;"></th>
                    <th class="area text-right" data-value="{{$r->area}}">
                        {{is_numeric($r->area)?number_format(intval($r->area)):$r->area}}
                    </th>
                    <th class="rent_unit  text-right" data-value="{{$r->rent_unit}}">
                        {{ $r->rent_uni==1?"USD":"VNĐ"}}
                    </th>
                    <th class="rent_type  text-right" data-value="{{$r->rent_type}}">{{@$rent_type[$r->rent_type]}}</th>
                    <th class="fee_service  text-right" data-value="{{$r->fee_service}}">
                        {{is_numeric($r->fee_service)? number_format(intval($r->fee_service)):$r->fee_service}}
                    </th>
                    <th class="total  text-right" data-value="{{$r->total}}">
                        {{is_numeric($r->total)? number_format(intval($r->total)):$r->total}}
                    </th>
                    <th class="total_vnd  text-right" data-value="{{$r->total_vnd}}">
                        {{is_numeric($r->total_vnd)? number_format(intval($r->total_vnd)):$r->total_vnd}}
                    </th>

                    {{-- <th class="link_360" data-value="{{$r->link_360}}">{{$r->link_360}}</th>
                    <th class="note" data-value="{{$r->note}}">{{$r->note}}</th> --}}
                    <th><span class="item_rental_edit"><i class="fa fa-edit"></i></span><span class="item_rental_remove"><i class="fa fa-times"></i></span></th>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <div class="col-md-4" id="form_rental_properties">
        {{-- @include('admin::components.inputs.text', ['label'=>'Lầu', 'name'=>'','class'=>'floor', 'value'=> '',  'colLeft'=>12])
        @include('admin::components.inputs.select', ['label'=>'Tiền tệ','name'=>'', 'class'=>'currency text-right','rowClass'=>'nomargin', 'data'=>Currencies::getOption()->toArray(), 'value'=> '',  'colLeft'=>6])
        @include('admin::components.inputs.text', ['label'=>'Đơn Giá<small> (usd/m2)</small>','name'=>'', 'class'=>'price input_money','rowClass'=>'nomargin', 'value'=> '',  'colLeft'=>6])
        @include('admin::components.inputs.text', ['label'=>'Phí dịch vụ<small>(USD)</small>','name'=>'', 'dataValue' => @$record->fee_service, 'type'=>'number', 'class'=>'fee_service input_money','rowClass'=>'nomargin', 'value'=> @$record->fee_service, 'colLeft'=>6])
        @include('admin::components.inputs.text', ['label'=>'Diện tích <small> (m<sup>2</sup>)</small>','name'=>'', 'class'=>'area input_money','rowClass'=>'nomargin',  'value'=> '',  'colLeft'=>6])
        @include('admin::components.inputs.select', ['label'=>'Tính giá theo','name'=>'', 'data' =>  $rent_type, 'class'=>'rent_type text-left','rowClass'=>'nomargin', 'value'=> '',  'colLeft'=>6])
        @include('admin::components.inputs.text', ['label'=>'Giá tổng <small>(USD)</small>','name'=>'', 'class'=>'total input_money','rowClass'=>'nomargin', 'value'=> '',  'colLeft'=>6])
        @include('admin::components.inputs.text', ['label'=>'Giá tổng <small>(VNĐ)</small>','name'=>'', 'class'=>'total_vnd input_money','rowClass'=>'nomargin', 'value'=> '',  'colLeft'=>6]) --}}

        {{-- @include('admin::components.inputs.text', ['label'=>'Link 360','name'=>'', 'class'=>'link_360', 'value'=> '',  'colLeft'=>12])
        @include('admin::components.inputs.textarea', ['label'=>'Ghi chú','name'=>'', 'class'=>'note', 'value'=> '',  'colLeft'=>12]) --}}



        @include('admin::components.inputs.text', ['label'=>'Diện tích <small> (m<sup>2</sup>)</small>','name'=>'', 'class'=>'area input_money','rowClass'=>'nomargin',  'value'=> '',  'colLeft'=>6])
        @include('admin::components.inputs.text', ['label'=>'Lầu', 'name'=>'','class'=>'floor', 'value'=> '','rowClass'=>'nomargin',   'colLeft'=>6])
        @include('admin::components.inputs.select', ['label'=>'Đơn vị tính','name'=>'', 'data' =>  [1=>'USD',2=>'VNĐ'], 'class'=>'rent_unit text-left','rowClass'=>'nomargin', 'value'=> '',  'colLeft'=>6])
        @include('admin::components.inputs.select', ['label'=>'Tính giá theo','name'=>'', 'data' =>  $rent_type,'rowClass'=>'col-12', 'class'=>'rent_type text-left','rowClass'=>'nomargin', 'value'=> '',  'colLeft'=>6])
        @include('admin::components.inputs.text', ['label'=>'Giá thuê','type'=>'text','name'=>'', 'class'=>'price input_money','rowClass'=>'col-12', 'value'=> '',  'colLeft'=>12])
        @include('admin::components.inputs.text', ['label'=>'Phí dịch vụ','name'=>'', 'dataValue' => @$record->fee_service, 'type'=>'number', 'class'=>'fee_service input_money','rowClass'=>'col-12', 'value'=> @$record->fee_service, 'colLeft'=>12])

        <div class="is-dev hidden">
            @include('admin::components.inputs.text', ['label'=>'tổng','name'=>'', 'class'=>'total input_money','rowClass'=>'col-12', 'value'=> '',  'colLeft'=>12])
            @include('admin::components.inputs.text', ['label'=>'Giá tổng <small>(VNĐ)</small>','name'=>'', 'class'=>'total_vnd input_money','rowClass'=>'nomargin', 'value'=> '',  'colLeft'=>6])
            @include('admin::components.inputs.text', ['label'=>'','type'=>'hidden','name'=>'', 'class'=>'rent_id', 'value'=> '',  'colLeft'=>12])
        </div>
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
        $(document).on("click","#btn-lrp-add",function(){
            table  = $("#list_rental_properties").find("table").find("tbody");
            form = $("#list_rental_properties").find("#form_rental_properties");

            id = generateUUID();
            no = table.find('tr').length + 1;
            price = form.find('.price').val();
            area = form.find('.area').val();
            currency = form.find('.currency').val();
            rent_type = form.find('.rent_type').val();
            total = form.find('.total').val();
            floor = form.find('.floor').val();
            // link_360 = form.find('.link_360').val();
            // note = form.find('.note').val();

            html = `<tr data-id="${id}">
                    <th >${no}</th>
                    <th class="floor text-center" data-value="${floor}">${floor}</th>
                    <th class="price text-right" data-value="${price}">${number_format(price)}${currency_unit[currency]}</th>
                    <th class="currency" data-value="${currency}" style="display:none;">${currency}</th>
                    <th class="area text-right" data-value="${area}">${number_format(area)}</th>
                    <th><span class="item_rental_edit"><i class="fa fa-edit"></i></span><span class="item_rental_remove"><i class="fa fa-times"></i></span></th>
                </tr>`;
            table.append(html);
            getDataRentalProperties();
            var item = {
                    id : "",
                    price: "",
                    currency: "",
                    area: "",
                    rent_type: "",
                    total: "",
                    floor: ""
                    // link_360: "",
                    // note: ""
            };
            setDataFormProperties(item);
        });
        $(document).on("click","#btn-lrp-update",function(){
            table  = $("#list_rental_properties").find("table").find("tbody");
            form = $("#list_rental_properties").find("#form_rental_properties");
            id = form.find('.rent_id').val();
            if(id=="" || id == undefined){
                no = table.find('tr').length + 1;
            }
            else{
                no =  table.find("tr[data-id='"+id+"']").find("th:nth-child(1)").text();
            }


            price = form.find('.price').val();
            area = form.find('.area').val();
            floor = form.find('.floor').val();
            currency = form.find('.currency').val();
            rent_type = form.find('.rent_type').val();
            rent_unit = form.find('.rent_unit').val();
            fee_service  = form.find('.fee_service').val();
            total = form.find('.total').val();
            total_vnd = form.find('.total_vnd').val();
            // note = form.find('.note').val();

            // html = `
            //         <th >${no}</th>
            //         <th class="floor text-center" data-value="${floor}">${floor}</th>
            //         <th class="price text-right" data-value="${number_decimai(price)}">${price}</th>
            //         <th class="currency" data-value="${currency}" style="display:none;">${currency}</th>
            //         <th class="area text-right" data-value="${number_decimai(area)}">${area}</th>
            //         <th class="rent_type text-right" data-value="${rent_type}">${rent_type_unit[rent_type]}</th>
            //         <th class="fee_service text-right" data-value="${number_decimai(fee_service)}">${fee_service}</th>
            //         <th class="total text-right" data-value="${number_decimai(total)}">${total}</th>
            //         <th class="total_vnd text-right" data-value="${number_decimai(total_vnd)}">${total_vnd}</th>
            //         <th><span class="item_rental_edit"><i class="fa fa-edit"></i></span><span class="item_rental_remove"><i class="fa fa-times"></i></span></th>
            // `;
            html = `
                    <th >${no}</th>
                    <th class="floor text-center" data-value="${floor}">${floor}</th>
                    <th class="currency" data-value="${currency}" style="display:none;">${currency}</th>
                    <th class="price text-right" data-value="${number_decimai(price)}">${price}</th>
                    <th class="area text-right" data-value="${number_decimai(area)}">${area}</th>
                    <th class="rent_unit text-right" data-value="${rent_unit}">${rent_unit==1?"USD":"VNĐ"}</th>
                    <th class="rent_type text-right" data-value="${rent_type}">${rent_type_unit[rent_type]}</th>
                    <th class="fee_service text-right" data-value="${number_decimai(fee_service)}">${fee_service}</th>
                    <th class="total text-right" data-value="${number_decimai(total)}">${total}</th>
                    <th class="total_vnd text-right" data-value="${number_decimai(total_vnd)}">${total_vnd}</th>
                    <th><span class="item_rental_edit"><i class="fa fa-edit"></i></span><span class="item_rental_remove"><i class="fa fa-times"></i></span></th>
            `;
            if(id=="" || id == undefined){
                id = generateUUID();
                table.append("<tr data-id='"+id+"'>"+html+"</tr>");
            }
            else
                table.find("tr[data-id='"+id+"']").html(html);
            getDataRentalProperties();
            var item = {
                    id : "",
                    price: "",
                    area: "",
                    floor: "",
                    rent_type : 1,
                    link_360: "",
                    note: ""
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
            price = tag.find('.price').attr("data-value");

            rent_type = tag.find('.rent_type').attr("data-value");
            area = tag.find('.area').attr("data-value");
            floor = tag.find('.floor').attr("data-value");
            currency = tag.find('.currency').attr("data-value");
            rent_type = tag.find('.rent_type').attr("data-value");
            fee_service = tag.find('.fee_service').attr("data-value");
            total = tag.find('.total').attr("data-value");
            total_vnd = tag.find('.total_vnd').attr("data-value");

            // note = tag.find('.note').attr("data-value");

            var item = {
                    id : id,
                    price: price,
                    area: area,
                    floor: floor,
                    currency: currency,
                    rent_type:rent_type,
                    fee_service: fee_service,
                    total: total,
                    total_vnd: total_vnd
            };
            setDataFormProperties(item);
            $("#btn-lrp-update").html("Cập nhật");
        });

        $(document).on("keyup","#form_rental_properties .price, #form_rental_properties .rent_type, #form_rental_properties .area,#form_rental_properties .fee_service",function(){
            calcSummary();
        });

        $(document).on("change",".rent_type",function(){
            tag = $("#form_rental_properties");
            if($(this).val()==2)
            {
                $fee = tag.find(".fee_service").val();
                tag.find(".fee_service").attr("data-temp",$fee );
                tag.find(".fee_service").val(0);
                tag.find(".fee_service").addClass("lock");
            }
            else{
                tag.find(".fee_service").val(tag.find(".fee_service").attr('data-temp'));
                tag.find(".fee_service").removeClass("lock");
            }
        });
        $(document).on("change","#form_rental_properties .rent_type",function(){
            calcSummary();
        });
        $(document).on("change","#form_rental_properties .total",function(){
            calcSummary();
        });

        $(document).on("keyup","#form_rental_properties .total",function(){
            let total = number_decimai($(this).val());
            total_vnd = total* rate;
            $("#form_rental_properties .total_vnd").val(number_format(total_vnd));
        });

        $(document).on("keyup","#form_rental_properties .total_vnd",function(){
            let total_vnd = number_decimai($(this).val());
            total = round(total_vnd / rate, decimal);
            $("#form_rental_properties .total").val(number_format(total));
        });


        function calcSummary()
        {
            type = $("#form_rental_properties .rent_type").val()
            price = number_decimai($("#form_rental_properties .price").val());

            area = number_decimai($("#form_rental_properties .area").val());
            fee_service = number_decimai($("#form_rental_properties .fee_service").val());

            total_vnd = total * rate;
            $("#form_rental_properties .total_vnd").val(number_format(total_vnd));
            if(type == 2)
            {
                total = price + fee_service;
                total_vnd = total * rate;
                $("#form_rental_properties .total").val(number_format(total));
                $("#form_rental_properties .total_vnd").val(number_format(total_vnd));


            }
            else{
                if(price != "" && area != "")
                {
                    total = (price + fee_service) * area;
                    total_vnd = total * rate;
                    $("#form_rental_properties .total").val(number_format(total));
                    $("#form_rental_properties .total_vnd").val(number_format(total_vnd));
                }
            }
        }
        function setDataFormProperties(item)
        {
            form = $("#form_rental_properties");
            form.find(".price").val(number_format(item.price));
            form.find(".area").val(item.area);
            form.find(".floor").val(item.floor);
            form.find(".currency").val(item.currency);
            // form.find(".note").val(item.note);
            form.find(".rent_id").val(item.id);
            form.find(".rent_type").val(item.rent_type);
            if(item.fee_service == undefined)
            {
                item.fee_service = form.find(".fee_service").attr("data-value");
            }
            form.find(".fee_service").val(parseFloat(item.fee_service));
            form.find(".total").val(number_format(item.total));
            form.find(".total_vnd").val(number_format(item.total_vnd));
        }
        function getDataRentalProperties()
        {
            table  = $("#list_rental_properties").find("table").find("tbody");
            var list = [];
            $('#list_rental_properties table tbody tr').each(function() {

                form = $(this);
                id = form.attr("data-id");
                price = form.find('.price').attr("data-value");
                area = form.find('.area').attr("data-value");
                floor = form.find('.floor').attr("data-value");
                currency = form.find('.currency').attr("data-value");
                rent_unit = form.find('.rent_unit').attr("data-value");
                rent_type = form.find('.rent_type').attr("data-value");
                fee_service = form.find('.fee_service').attr("data-value");
                total = form.find('.total').attr("data-value");
                total_vnd = form.find('.total_vnd').attr("data-value");
                // note = form.find('.note').attr("data-value");

                var obj_detail = {
                    id : id,
                    price: price,
                    area: area,
                    floor: floor,
                    currency: currency,
                    rent_unit: rent_unit,
                    rent_type: rent_type,
                    fee_service: fee_service,
                    total: total,
                    total_vnd: total_vnd
                };
                console.log(obj_detail);
                // if (title != '' || content != '' || image != '' || icon != '' || note != '' || link != '')
                list.push(obj_detail);
            });
            $("#rental_properties").val(JSON.stringify(list));
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
    </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
        <script>
            $('.input_money').mask('#,##0', {
                reverse: true
            });
        </script>
    @endpush
    <style type="text/css">
    #list_rental_properties table{
        border:  1px solid #dee2e6;
    }
    #list_rental_properties table tr td,   #list_rental_properties table tr th{
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
    #form_rental_properties .lock{
        pointer-events: none;
        background: #ececec;
    }
    </style>
</div>
