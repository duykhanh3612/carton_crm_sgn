<div class="detailBlock">
        @php
            $connectInfo = config('constants.models.netsuitepos.settings.connection_info');
        @endphp
        <h4 class="tl-md lightGrey clearfix"><span class="tlName float-left">NETSUITE</span>
            <span><a href="{{route('user.test.netsuitepos.connection.route')}}"
                     class="btnBody btnBlueSmall please-wait float-right">TEST CONNECTION</a></span>
        </h4>
        @include('components.inputs.select', [
            'label' => 'Sandbox Mode',
            'name' => 'netsuitepos_sandbox',
            'data' => config('constants.models.netsuite.settings.connection_types'),
            'value' => @$settings['netsuitepos_sandbox'],
            'class' => 'update-user-setting select form-control has-dependency-div'
        ])
        <div class="row">
            <div class="col-lg-6">
                @include('components.inputs.text',[
                    'label' => 'Account ID',
                    'name'=> $connectInfo['netsuitepos_account_id'],
                    'required'=>true,
                    'value' => @$settings[$connectInfo['netsuitepos_account_id']],
                    'class' => 'update-user-setting'
                ])
            </div>
            <div class="col-lg-6">
                @include('components.inputs.text', [
                    'label' => 'APP ID',
                    'name'=> $connectInfo['netsuitepos_app_id'],
                    'required'=>true,
                    'value' => @$settings[$connectInfo['netsuitepos_app_id']],
                    'class' => 'update-user-setting'
                ])
            </div>
        </div>
        @include('components.inputs.text', [
            'label' => 'CONSUMER KEY',
            'name'=> $connectInfo['netsuitepos_consumer_key'],
            'required'=>true,
            'value' => @$settings[$connectInfo['netsuitepos_consumer_key']],
            'class' => 'update-user-setting'
        ])
        @include('components.inputs.text', [
            'label' => 'CONSUMER SECRET',
            'name'=> $connectInfo['netsuitepos_consumer_secret'],
            'required'=>true,
            'value' => @$settings[$connectInfo['netsuitepos_consumer_secret']],
            'class' => 'update-user-setting'
        ])
        @include('components.inputs.text', [
            'label' => 'TOKEN ID',
            'name'=> $connectInfo['netsuitepos_token_id'],
            'required'=> true,
            'value' => @$settings[$connectInfo['netsuitepos_token_id']],
            'class' => 'update-user-setting'
        ])
        @include('components.inputs.text', [
            'label' => 'TOKEN SECRET',
            'name'=> $connectInfo['netsuitepos_token_secret'],
            'required'=>true,
            'value' => @$settings[$connectInfo['netsuitepos_token_secret']],
            'class' => 'update-user-setting'
        ])
    </div>
    <div class="detailBlock">
        <div id="datacenter_wrapper" class="dependency-div" data-parent="netsuitepos_sandbox" data-show="0">
            <h4 class="tl-md lightGrey clearfix"><span class="tlName pull-left">NETSUITE DATA CENTER</span></h4>
            <dl class="dl-horizontal">
                <select id="netsuitepos_data_center" class="form-control netsuite-total update-user-setting">
                    <option value="0">Default</option>
                    <option value="na1" @if($settings['netsuitepos_data_center'] == 'na1') selected="selected"@endif>na1
                    </option>
                    <option value="na2" @if($settings['netsuitepos_data_center'] == 'na2') selected="selected"@endif>na2
                    </option>
                    <option value="na3" @if($settings['netsuitepos_data_center'] == 'na3') selected="selected"@endif>na3
                    </option>
                </select>
                <p><br/></p>
                <p><label>Use account-specific domain:</label></p>
                <select id="netsuitepos_account_specific_domain" class="form-control netsuite-total update-user-setting">
                    <option value="0">Disabled</option>
                    <option value="1" @if($settings['netsuitepos_account_specific_domain'] == 1) selected="selected"@endif>
                        Enabled
                    </option>
                </select>
            </dl>
        </div>
        <div id="sandbox_wrapper" class="dependency-div" data-parent="netsuitepos_sandbox" data-show="1">
            <h4 class="tl-md lightGrey clearfix"><span class="tlName pull-left">NETSUITE SANBOX DATA CENTER</span></h4>
            <dl class="dl-horizontal">
                <select id="netsuitepos_sandbox_data_center" class="form-control netsuite-total update-user-setting">
                    <option value="0">Default</option>
                    <option value="sb1"
                            @if($settings['netsuitepos_sandbox_data_center'] == 'sb1') selected="selected"@endif>sb1
                    </option>
                    <option value="sb2"
                            @if($settings['netsuitepos_sandbox_data_center'] == 'sb2') selected="selected"@endif>sb2
                    </option>
                    <option value="sb3"
                            @if($settings['netsuitepos_sandbox_data_center'] == 'sb3') selected="selected"@endif>sb3
                    </option>
                </select>
                <p><br/></p>
                <p><label>Use account-specific domains:</label></p>
                <select id="netsuitepos_sandbox_account_specific_domain"
                        class="form-control netsuite-total update-user-setting">
                    <option value="0">Disabled</option>
                    <option value="1"
                            @if(@$settings['netsuitepos_sandbox_account_specific_domain'] == 1) selected="selected"@endif>
                        Enabled
                    </option>
                </select>
            </dl>
        </div>
    </div>
