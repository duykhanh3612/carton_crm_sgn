

@if(check_rights_function('cancel_order','read') &&  $record->status == 5)
<a class="blue bootbox-confirm ng-scope btn-restore-order" ng-click="duplicateOrder(order,$event)" title="Khôi phục đơn hàng">
    <i class="fa fa-undo bigger-110"></i>
</a>
@endif
&nbsp;

    @if(check_rights_function('cancel_order','read') && $record->status < 4) {{-- data-ng-if="order.saleTypeID != 1 &amp;&amp; order.saleTypeID < 4 &amp;&amp; order.status < 4 &amp;&amp; order.status > 1" --}}
<a  class="btn-cancel-order black bootbox-confirm ng-scope" ng-click="cancelOrder(order.saleOrderId, order.saleOrderCode)" title="Hủy đơn hàng">
    <i class="fa fa-stop-circle text-danger"></i>
</a>
&nbsp;
    @endif
<?php
    if(isAdmin() || isset($links['copy']))
{
    echo '<a class="confirmCopy" data-href="'.route(Arr::get($links,'copy'),[$record->id]).'"><i class="fa fa-clone text-info"></i></a>';
}

?>


&nbsp;
@if(in_array($record->status,[2,3,4]))
<a class="grey ng-scope" style="cursor:pointer;" onclick="printOrder({{$record->id}})" title="In đơn hàng" data-ng-if="(order.saleTypeID == 1) || (order.status == 4 &amp;&amp; order.saleTypeID > 1 &amp;&amp; order.saleTypeID < 4) || (order.status == 1 &amp;&amp; order.saleTypeID > 1 &amp;&amp; order.saleTypeID < 4)">
    <i class="fa fa-print bigger-110"></i>
</a>
@endif
{{-- <a class="blue ng-scope" data-ng-click="copyOnlineOrder(order)" title="Sao chép đơn đặt hàng" data-ng-if="(order.saleTypeID == 2 &amp;&amp; order.status < 5 &amp;&amp; order.status > 1) || (order.status == 4 &amp;&amp; order.saleTypeID > 1 &amp;&amp; order.sale)">
    <i class="fa fa-copy bigger-110"></i>
</a> --}}

&nbsp;
<?php
if(isAdmin() || ( in_array($record->status,[1,2,5])) || (check_rights(2,"delete") &&  ($record->status == 1 || $record->status == 5)  && isset($links['delete'])))
{
    echo '<a data-href="'.route(Arr::get($links,'delete'),[$record->id]).'" class="deleteDialog" data-toggle="confirm" data-target="#deleteUser"><i class="fa fa-trash text-danger"></i></a>';
}
?>
