@php
    $leftSelect['name'] = $mappingKey.'left_value';
    $leftSelect['multiple'] = false;
    $column = 2;
    if($group) {
        foreach($groupInputs as $index => $grInput) {
            $groupInputs[$index]['class'] = ($groupInputs[$index]['class'] ?? "")." setting-mapping-group-input";
        }
        $column = count($groupInputs) + 1;
    }
    else {
        $rightSelect['name'] = $mappingKey.'right_value';
        if(!$rightSelect['multiple']){
            $rightSelect['multiple'] = false;
        }
    }
    $width = floor(90/$column) . "%";
    $widthModal = floor(100/$column) . "%";
@endphp
<div class="row settingTabs {{$rowClass}}"
    @if(is_array($rowData))
    @foreach($rowData as $key => $val)
        data-{{$key}}="{{$val}}"
    @endforeach
    @endif
    >
    <div class="col-md-12">
        <div class="form-group">
            <label>
                {{$formLabel}}
            </label>
            <a href="javascript:;" class="btnBody btnBlueSmall float-right" data-toggle="modal"
                        data-target="#form_mapping_{{$mappingKey}}">ADD / EDIT</a>
        </div>
    </div>
    <div class="col-md-12 updateBlock">
        <table class="table table-borderless" id="table_setting_mapping_{{$mappingKey}}">
            <thead>
            <tr>
                <th width="{{$width}}">{{$leftLabel ?? 'LEFT COLUMN'}}</th>
                @if($group)
                @foreach($groupLabels as $grLabel)
                <th width="{{$width}}">{{$grLabel}}</th>
                @endforeach
                @else
                <th width="{{$width}}">{{$rightLabel ?? 'RIGHT COLUMN'}}</th>
                @endif
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach(\App\Models\Hyperspace\SettingMapping::listByKey($mappingKey) as $rel)
                <tr class="mapping-row" data-mapping_key="{{$rel->mapping_key}}" data-left_value="{{$rel->left_value}}">
                    <td>{{ $rel->left_title }}</td>
                    @if($group)
                    @foreach($rel->right_title as $levelTitle)
                    <td>{{ $levelTitle }}</td>
                    @endforeach
                    @else
                    <td>{!! nl2br(e($rel->right_title)) !!}</td>
                    @endif
                    <td>
                        <a href="javascript:void(0);" onclick="removeSettingMapping(this)">Remove</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<form class="modal fade add-user-setting-mapping" tabindex="-1" role="dialog" id="form_mapping_{{$mappingKey}}"
      method="POST" action="{{route('user.setting_mapping')}}"
      data-mapping_key="{{$mappingKey}}"
      data-right_value_type="{{$dataType}}"
      data-delete_empty="{{$deleteEmpty ?? 1}}"
      data-group="{{$group}}"
      >
    <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{$formLabel ?? 'MAPPING'}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-borderless">
                    <thead>
                    <tr>
                        <th width="{{$widthModal}}">{{$leftLabel ?? 'LEFT COLUMN'}}</th>
                        @if($group)
                        @foreach($groupLabels as $grLabel)
                        <th width="{{$widthModal}}">{{$grLabel}}</th>
                        @endforeach
                        @else
                        <th width="{{$widthModal}}">{{$rightLabel ?? 'RIGHT COLUMN'}}</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>@include('components.inputs.'.($leftSelect['type'] ?? 'select'), $leftSelect)</td>
                        @if($group)
                        @foreach($groupInputs as $grInput)
                        <td>@include('components.inputs.'.($grInput['type'] ?? 'select'), $grInput)</td>
                        @endforeach
                        @else
                        <td>@include('components.inputs.'.($rightSelect['type'] ?? 'select'), $rightSelect)</td>
                        @endif
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">SAVE</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</form>
