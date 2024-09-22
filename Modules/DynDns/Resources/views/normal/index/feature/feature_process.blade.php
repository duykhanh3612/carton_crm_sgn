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


                <div class="c100 p{{$process_value}} micros">
                    <span>{{$process_value}}%</span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>


</td>

