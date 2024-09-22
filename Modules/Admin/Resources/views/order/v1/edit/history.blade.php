

@php
$logs = !empty($record)?get_data("order_log",["order_id"=>$record->id],"**","id desc"):[]    ;
@endphp
@if(!empty($logs))
@foreach($logs as $log)
<div class="profile-feed row-fluid ng-scope" data-ng-repeat="e in events">
    <i style="margin-left: 10px; margin-right: 5px" class="icon-caret-right"></i>
    <span ng-bind-html="e.content.message" class="ng-binding">
        <span class="bean-date">{{date("d/m/Y H:i:A",strtotime($log->created_at))}}</span> -
        <span class="event-bean event-user-name">{{$log->owner=="customer"?"Khách hàng":$log->user_full_name}}</span> -
        <span> {{$log->title}}</span>
        {{-- <span>Tiền mặt</span> <span class="event-param">0.00</span> cho đơn hàng
        <a class="event-bean" href="/#/order/online/4003167">PX076028</a> --}}
    </span>
</div>
@endforeach
@endif
    {{-- <div class="profile-feed row-fluid ng-scope" data-ng-repeat="e in events">
        <i style="margin-left: 10px; margin-right: 5px" class="icon-caret-right"></i>
        <span ng-bind-html="e.content.message" class="ng-binding">
            <span class="bean-date">27/09/2023 03:43:PM</span> - <span class="event-bean event-user-name">Tiến - Xưởng</span> -
            <span> đã nhận thanh toán</span> <span>Tiền mặt</span> <span class="event-param">0.00</span> cho đơn hàng
            <a class="event-bean" href="/#/order/online/4003167">PX076028</a>
        </span>
    </div>


    <div class="profile-feed row-fluid ng-scope" data-ng-repeat="e in events">
        <i style="margin-left: 10px; margin-right: 5px" class="icon-caret-right"></i><span ng-bind-html="e.content.message" class="ng-binding"><span class="bean-date">27/09/2023 03:43:PM</span> - <span class="event-bean event-user-name">Tiến - Xưởng</span> - <span> đã xác nhận đơn hàng</span> <a class="event-bean" href="/#/order/online/4003167">PX076028</a></span>
    </div>

    <div class="profile-feed row-fluid ng-scope" data-ng-repeat="e in events">
        <i style="margin-left: 10px; margin-right: 5px" class="icon-caret-right"></i><span ng-bind-html="e.content.message" class="ng-binding"><span class="bean-date">27/09/2023 03:43:PM</span> - <span class="event-bean event-user-name">Khách hàng</span> - <span> đã tạo đơn hàng</span> <a class="event-bean" href="/#/order/online/4003167">PX076028</a></span>
    </div> --}}
