
<div class="summary mt-2">

Số lượng hóa đơn:    <span style="color: #ff1313;    font-weight: 600;">{{number_format($summary['order'])}}</span>
       Tổng tiền:    <span style="color: #ff1313;    font-weight: 600">{{number_format(floatval($summary['total']))}}</span>
       Nợ:    <span style="color: #ff1313;    font-weight: 600">{{number_format(floatval(@$summary['debt']))}}</span>
</div>
