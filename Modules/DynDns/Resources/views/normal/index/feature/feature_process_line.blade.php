@php
    $process_value = $row->{$ctrl->value} ;
    $process_mess = "";
    if($process_value==100)
        $process_mess     = "success";  
    else  if($process_value>60 && $process_value<100)
        $process_mess     = "info";
    else  if($process_value>30 && $process_value<=60)
        $process_mess     = "warning";
    else  
        $process_mess     = "danger";
@endphp
<td {{@$ctrl->mobile!=1?"class=hidden-xs-down":"" }}>  
        <h5 style="width:100px;">Progress<span class="pull-right">{{$row->{$ctrl->value} }}% {{ $style }}</span></h5>
        <div class="progress">
            <div class="progress-bar progress-bar-{{$process_mess}}" aria-valuenow="{{$row->{$ctrl->value} }}" aria-valuemin="0" aria-valuemax="100" style="width: {{$row->{$ctrl->value} }}%" role="progressbar">
                <span class="sr-only">{{$row->{$ctrl->value} }}% Complete</span>
               
            </div>

        </div>
       <style type="text/css">

           /*------------------------------------------------

Progress Bar

-------------------------------------------------*/

.progress-bar {
    background-color: #44b6ae;
}

.progress-small, .progress-small .progress-bar {
    height: 10px;
}

.progress-small, .progress-mini {
    margin-top: 5px;
}

.progress-mini, .progress-mini .progress-bar {
    height: 5px;
    margin-bottom: 5px;
}

.progress-bar-navy-light {
    background-color: #3dc7ab;
}

.progress-bar-success {
    background-color: #1c84c6;
}

.progress-bar-info {
    background-color: #23c6c8;
}

.progress-bar-warning {
    background-color: #f8ac59;
}

.progress-bar-danger {
    background-color: #ed5565;
}


.progress-bar-success {
    background-color: #1c84c6;
}

.progress-bar-blue {
    background-color: #3598dc;
}

.progress-bar-green {
    background-color: #44b6ae;
}

.progress-bar-aqua {
    background-color: #49b6d6;
}
           </style>
</td>

