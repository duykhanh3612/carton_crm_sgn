<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link type="text/css" rel="stylesheet" href="resources/sheet.css">
<style type="text/css">
    .ritz .waffle a {
        color: inherit;
    }

    .ritz .waffle .s4 {
        border-bottom: 1px SOLID transparent;
        border-right: 1px SOLID transparent;
        background-color: #add8e6;
        text-align: left;
        color: #000000;
        font-family: docs-Calibri, Arial;
        font-size: 11pt;
        vertical-align: bottom;
        white-space: nowrap;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .ritz .waffle .s5 {
        border-right: none;
        background-color: #ffffff;
        text-align: left;
        color: #000000;
        font-family: docs-Calibri, Arial;
        font-size: 11pt;
        vertical-align: bottom;
        white-space: nowrap;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .ritz .waffle .s6 {
        border-left: none;
        border-right: none;
        background-color: #ffffff;
        text-align: left;
        color: #000000;
        font-family: docs-Calibri, Arial;
        font-size: 11pt;
        vertical-align: bottom;
        white-space: nowrap;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .ritz .waffle .s1 {
        background-color: #ffffff;
        text-align: left;
        color: #000000;
        font-family: docs-Calibri, Arial;
        font-size: 11pt;
        vertical-align: bottom;
        white-space: nowrap;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .ritz .waffle .s2 {
        background-color: #ffffff;
        text-align: right;
        color: #000000;
        font-family: docs-Calibri, Arial;
        font-size: 11pt;
        vertical-align: bottom;
        white-space: nowrap;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .ritz .waffle .s3 {
        border-bottom: 1px SOLID transparent;
        background-color: #ffffff;
    }

    .ritz .waffle .s7 {
        border-left: none;
        background-color: #ffffff;
        text-align: left;
        color: #000000;
        font-family: docs-Calibri, Arial;
        font-size: 11pt;
        vertical-align: bottom;
        white-space: nowrap;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .ritz .waffle .s0 {
        border-bottom: 1px SOLID transparent;
        border-right: 1px SOLID transparent;
        background-color: #e6e6fa;
        text-align: left;
        color: #00008b;
        font-family: docs-Calibri, Arial;
        font-size: 11pt;
        vertical-align: bottom;
        white-space: nowrap;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }
</style>
<div class="ritz grid-container" dir="ltr">
    <table class="waffle" cellspacing="0" cellpadding="0">
        <tbody>

            @php
            $summary = [
            ["title"=>"Từ ngày","value"=>@$startDate],
            ["title"=>"Đến ngày","value"=>@$endDate],
            ["title"=>"Số phiếu bán","value"=>count($orders)],
            ["title"=>"Số hàng hóa bán","value"=>number_format(count($records))],
            ["title"=>"Tiền bán hàng","value"=>$orders->sum("total")],
            ["title"=>"Tiền xuất trả NCC","value"=>'0'],
            ["title"=>"Phí vận chuyển","value"=>$orders->sum("ship")],
            ["title"=>"Tiền mặt","value"=>$orders->where('type',1)->sum('total')],
            ["title"=>"Chuyển khoản","value"=>$orders->where('type',3)->sum('total')],
            ["title"=>"Thẻ","value"=>$orders->where('type',2)->sum('total')],
            ["title"=>"Còn nợ","value"=>$orders->sum('debt')],
            ];
            $summary = json_decode(json_encode($summary));
            $status = get_options_keynum_data("status");
            @endphp
            @foreach($summary as $s)
            <tr style="height: 19px">
                <td class="s0">{{$s->title}}</td>
                <td class="s1">{{$s->value}}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            @endforeach

            <tr style="height: 19px">
                <td class="s3"></td>
                <td class="s3"></td>
                <td class="s3"></td>
                <td class="s3"></td>
                <td class="s3"></td>
                <td class="s3"></td>
                <td class="s3"></td>
                <td class="s3"></td>
                <td class="s3"></td>
                <td class="s3"></td>
                <td class="s3"></td>
                <td class="s3"></td>
                <td class="s3"></td>
                <td class="s3"></td>
                <td class="s3"></td>
                <td class="s3"></td>
                <td class="s3"></td>
                <td class="s3"></td>
                <td class="s3"></td>
                <td class="s3"></td>
                <td class="s3"></td>
                <td class="s3"></td>
                <td class="s3"></td>
                <td class="s3"></td>
                <td class="s3"></td>
                <td class="s3"></td>
                <td class="s3"></td>
                <td class="s3"></td>
                <td class="s3"></td>
                <td class="s3"></td>
            </tr>
            <tr style="height: 19px">
                <td class="s4">Mã phiếu</td>
                <td class="s4 softmerge">
                    <div class="softmerge-inner" style="width:57px;left:-1px">Ngày tạo</div>
                </td>
                <td class="s4 softmerge">
                    <div class="softmerge-inner" style="width:57px;left:-1px">Thu ngân</div>
                </td>
                <td class="s4 softmerge">
                    <div class="softmerge-inner" style="width:57px;left:-1px">Khách hàng</div>
                </td>
                <td class="s4">Địa chỉ</td>
                <td class="s4 softmerge">
                    <div class="softmerge-inner" style="width:57px;left:-1px">Điện thoại</div>
                </td>
                <td class="s4">Tổng SL</td>
                <td class="s4 softmerge">
                    <div class="softmerge-inner" style="width:57px;left:-1px">Tổng tiền hàng</div>
                </td>
                <td class="s4 softmerge">
                    <div class="softmerge-inner" style="width:57px;left:-1px">Giảm giá (trên phiếu)</div>
                </td>
                <td class="s4 softmerge">
                    <div class="softmerge-inner" style="width:57px;left:-1px">Tổng tiền</div>
                </td>
                <td class="s4">Tiền mặt</td>
                <td class="s4 softmerge">
                    <div class="softmerge-inner" style="width:57px;left:-1px">Chuyển khoản</div>
                </td>
                <td class="s4">Thẻ</td>
                <td class="s4">Còn nợ</td>
                <td class="s4 softmerge">
                    <div class="softmerge-inner" style="width:57px;left:-1px">Loại Đơn hàng</div>
                </td>
                <td class="s4 softmerge">
                    <div class="softmerge-inner" style="width:57px;left:-1px">Trạng thái</div>
                </td>
                <td class="s4">Ghi chú</td>
                <td class="s4 softmerge">
                    <div class="softmerge-inner" style="width:57px;left:-1px">Đơn vị giao hàng</div>
                </td>
                <td class="s4">Phí VC</td>
                <td class="s4 softmerge">
                    <div class="softmerge-inner" style="width:57px;left:-1px">Ngày giao</div>
                </td>
                <td class="s4 softmerge">
                    <div class="softmerge-inner" style="width:57px;left:-1px">Người giao</div>
                </td>
                <td class="s4 softmerge">
                    <div class="softmerge-inner" style="width:57px;left:-1px">Ghi chú vận chuyển</div>
                </td>
                <td class="s4 softmerge">
                    <div class="softmerge-inner" style="width:57px;left:-1px">Tên hàng hóa</div>
                </td>
                <td class="s4 softmerge">
                    <div class="softmerge-inner" style="width:57px;left:-1px">Mã hàng hóa</div>
                </td>
                <td class="s4">SL</td>
                <td class="s4">Giá bán</td>
                <td class="s4">Giảm giá</td>
                <td class="s4 softmerge">
                    <div class="softmerge-inner" style="width:57px;left:-1px">Thành tiền</div>
                </td>
                <td class="s4">Serial</td>
                <td class="s4"></td>
            </tr>
            @php
            $code = "";
            @endphp
            @foreach ($records as $record)
            <tr style="height: 19px">
                @if($code == $record->code)
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                @else
                <td class="s1">{{$record->code}}</td>
                <td class="s2">{{$record->date}}</td>
                <td class="s1 softmerge">
                    <div class="softmerge-inner" style="width:57px;left:-1px">{{$record->id}}</div>
                </td>
                <td class="s1 softmerge">
                    <div class="softmerge-inner" style="width:57px;left:-1px">{{$record->customer_id}}</div>
                </td>
                <td class="s1 softmerge">
                    <div class="softmerge-inner" style="width:57px;left:-1px">{{$record->shipping_address}}</div>
                </td>
                <td class="s1 softmerge">
                    <div class="softmerge-inner" style="width:57px;left:-1px">{{$record->customer_phone}}</div>
                </td>
                <td class="s2">1,030 </td>
                <td class="s2">{{number_format($record->total)}}</td>
                <td class="s2">{{number_format($record->discount_value)}}</td>
                <td class="s2">{{number_format($record->total - $record->discount_value)}} </td>
                <td class="s2">0</td>
                <td class="s2">{{ $record->payments_type==1?number_format($record->total_paid):0 }}</td>
                <td class="s2">{{ $record->payments_type==3number_format($record->total_paid):0 }}/td>
                <td class="s2">{{ $record->payments_type==2?number_format($record->total_paid):0 }}</td>
                <td class="s1 softmerge">
                    <div class="softmerge-inner" style="width:57px;left:-1px">{{@$status[$record->status]}}</div>
                </td>
                <td class="s1 softmerge">
                    <div class="softmerge-inner" style="width:57px;left:-1px"> {{@$status[$record->status]}}</div>
                </td>
                <td class="s1 softmerge">
                    <div class="softmerge-inner" style="width:57px;left:-1px">{{$record->note}}</div>
                </td>
                <td class="s1">{{$record->carrier_name}}</td>
                <td class="s2">{{number_format($record->shipping_fee)}}</td>
                <td class="s5 softmerge">
                    <div class="softmerge-inner" style="width:178px;left:-1px">{{$record->date}}</div>
                </td>
                <td class="s6"></td>
                <td class="s7"></td>
                @endif
                @php
                $code = $record->code;
                @endphp
                <td class="s7 softmerge">
                    <div class="softmerge-inner" style="width:57px;left:-1px">{{$record->description}}</div>
                </td>
                <td class="s1 softmerge">
                    <div class="softmerge-inner" style="width:57px;left:-1px">{{$record->sku}}</div>
                </td>
                <td class="s2">{{$record->qty}}</td>
                <td class="s2">{{$record->sku}}</td>
                <td class="s2">{{$record->unit_price}}</td>
                <td class="s2">0</td>
                <td class="s1">{{$record->total_price}}</td>
                <td></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
