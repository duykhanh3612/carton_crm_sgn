<div class="detailBlock">
    <h4 class="tl-md lightGrey clearfix"><span class="tlName float-left">SUB-DOMAIN</span></h4>
    @include('components.inputs.text', ['name'=>'sp_subdomain', 'required'=>true, 'value' => @$settings['sp_subdomain'], 'class' => 'update-user-setting'])
</div>
<div class="detailBlock">
    <h4 class="tl-md lightGrey clearfix"><span class="tlName float-left">ACCESS TOKEN</span></h4>
    @include('components.inputs.text', ['name'=>'sp_token', 'required'=>true, 'value' => @$settings['sp_token'], 'class' => 'update-user-setting'])
</div>