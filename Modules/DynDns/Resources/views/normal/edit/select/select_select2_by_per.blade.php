@php
    $table = @$ctrl->att_table_prefix==1?@$admin_group->prefix."_". $ctrl->att_table:$ctrl->att_table;
$name_id = str_replace(array('[',']',"#"),array('','',''),@$ctrl->name.$lang);
@endphp
@if(!h::isMobile())
<div class="form-group {{$ctrl->width}} desktop" title="select_select2_by_per">
    <label>
        <?=$ctrl->title?> @if(@$ctrl->validate==1)
        <span style="color:#ff0000">(*)</span>@endif
    </label>
    <div>
        @if($per->plist==1)
        <?=h::select(@$ctrl->read==1?"":@$ctrl->name.$lang,@$row->{$ctrl->value},(@$ctrl->read==1?"readonly disabled ":""). $ctrl->att_style.' id="'.@$name_id.'" class="select2_ctrl '.$ctrl->name.' form-control"',
             $table,$ctrl->att_where,$ctrl->att_field.($lang==''?'':'_'.$lang),@$ctrl->att_key,@$ctrl->att_order,
             $ctrl->att_first,$ctrl->att_char,$ctrl->att_root,$ctrl->att_rootvalue);?>
        @else
        @php
             $where = " 1=1 and ".@$ctrl->att_foreign."=".\App\Model\Admin::_name($func->field_auth) .(@$ctrl->att_where_or!=''?' or '.$ctrl->att_where_or:'').(@$ctrl->att_where!=''? ' and '.$ctrl->att_where:'');
        @endphp
        <?=h::select(@$ctrl->read==1?"":@$ctrl->name.$lang,@$row->{$ctrl->value},(@$ctrl->read==1?"readonly disabled ":""). $ctrl->att_style.' id="'.@$name_id.'" class="'.$ctrl->name.' form-control"',
             $table,$where,$ctrl->att_field.($lang==''?'':'_'.$lang),@$ctrl->att_key,@$ctrl->att_order,
             $ctrl->att_first,$ctrl->att_char,$ctrl->att_root,$ctrl->att_rootvalue);?>
        @endif
        <ul class="parsley-errors-list" {{@$ctrl->note==''?"style=display:none":""}}></ul>
        <script>
        @if(@$row->{$ctrl->value} !='')
        $('.{{$name_id}}').val('{!!@$row->{$ctrl->value} !!}')
        @else
        $('.{{$name_id}}').val( $('.{{$name_id}} option:first').val());
        @endif
        </script>
    </div>
</div>
@else
<div class="form-group {{$ctrl->width}} mobo style-input-mobo">
    <label>
        <?=$ctrl->title?> @if(@$ctrl->validate==1)
        <span style="color:#ff0000">(*)</span>@endif
    </label>
    <div class="input-box">
        <?=h::select(@$ctrl->read==1?"":@$ctrl->name.$lang,@$row->{$ctrl->value},(@$ctrl->read==1?"readonly disabled ":""). $ctrl->att_style.' class="select2_ctrl '.$ctrl->name.' form-control nd"',
             $ctrl->att_table,$ctrl->att_where,$ctrl->att_field.($lang==''?'':'_'.$lang),@$ctrl->att_key,@$ctrl->att_order,
             $ctrl->att_first,$ctrl->att_char,$ctrl->att_root,$ctrl->att_rootvalue);?>
        <script>
        @if(@$row->{$ctrl->value} !='')
        $('.{{$ctrl->name}}').val('{!! @$row->{$ctrl->value} !!}')
        @endif
        </script>
    </div>
</div>
@endif
@push('script')
<style type="text/css">
            .select2-container--default .select2-selection--single {
				height:37px !important;
            }
</style>
<link href="{{env_host}}/public/plugin/select2/4.0.11/css/select2.css" rel="stylesheet" />
<script src="{{env_host}}/public/plugin/select2/4.0.11/js/select2.js"></script>
<script>
            $(document).on('mouseover', '.select2_ctrl', function () {
                $(this).select2({
                    placeholder: "Select ",
                    allowClear: true
                });



            });

</script>
@endpush
