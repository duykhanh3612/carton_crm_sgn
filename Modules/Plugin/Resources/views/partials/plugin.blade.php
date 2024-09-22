@if($cdn)
    @if(in_array("bootstrap",$nodes))
        {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.min.js" integrity="sha512-WW8/jxkELe2CAiE4LvQfwm1rajOS8PHasCCx+knHG0gBHt8EXxS6T6tJRTGuDQVnluuAvMxWF4j8SNFDKceLFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @endif
    @if(in_array("select2",$nodes))
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @endif

    @if(in_array("bootstrap-datepicker",$nodes))
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css" integrity="sha512-34s5cpvaNG3BknEWSuOncX28vz97bRI59UnVtEEpFX536A7BtZSJHsDyFoCl8S7Dt2TPzcrCEoHBGeM4SUBDBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js" integrity="sha512-LsnSViqQyaXpD4mBBdRYeP6sRwJiJveh2ZIbW41EBrNmKxgr/LFZIiWT6yr+nycvhvauz8c2nYMhrP80YhG7Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @endif
@else
    @if(in_array("bootstrap",$nodes))
        {{-- <script src="{{ asset('public/plugin/bootstrap/5.3.2/js/jquery-3.2.1.slim.min.js') }}"></script> --}}
        <script src="{{ asset('plugin/bootstrap/5.3.2/js/popper.min.js') }}"></script>
        <script src="{{ asset('plugin/bootstrap/5.3.2/js/bootstrap.min.js') }}"></script>
    @endif
    @if(in_array("bootstrap-datepicker",$nodes))
    <link rel="stylesheet" href="{{asset('plugin')}}/bootstrap/datepicker/1.10.0/css/bootstrap-datepicker.min.css" />
    <script src="{{asset('plugin')}}/bootstrap/datepicker/1.10.0/js/bootstrap-datepicker.min.js"></script>
    @endif
    @if(in_array("select2",$nodes))
        <script src="{{asset('plugin/select2/4.0.13/select2.min.js')}}"></script>
        <link rel="stylesheet" href="{{asset('plugin/select2/4.0.13/css/select2.min.css')}}" />
    @endif
@endif
