<div class="detailBlock">
    <h4 class="tl-md lightGrey clearfix"><span class="tlName float-left">SUB-DOMAIN</span></h4>
    @include('components.inputs.text', ['name'=>'vend_subdomain', 'required'=>true, 'value' => @$settings['vend_subdomain'], 'class' => 'update-user-setting'])
</div>
@php
    $vend_access_token = !empty($settings['vend_access_token']) ? $settings['vend_access_token'] : '';
@endphp
<div class="detailBlock">
    <h4 class="tl-md lightGrey clearfix"><span class="tlName float-left">REQUEST AUTHORIZATION</span><a href="{{ route('user.vend.callback')}}" class="btnBody btnBlueSmall float-right">AUTHORIZATION</a></h4>
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <p><strong>AUTHORIZATION : </strong>
        <span>
            @if($vend_access_token)
                TRUE
            @else
                FALSE
            @endif
        </span>
    </p>
</div>

