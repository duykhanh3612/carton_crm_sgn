@php
    $table = @$ctrl->att_table_prefix==1?@$admin_group->prefix."_". $ctrl->att_table:$ctrl->att_table;
    $field_lang = $ctrl->att_field.(@$ctrl->att_field_language==1?_lang:'');
@endphp
@if(!h::isMobile())
<div class="col-md-6 form-group" data-title="select2">
    <label class="col-md-3  control-label" style="float:left">{!!$ctrl->title !!}</label>  
    <div class="col-md-9 input-group" style="float:left">        
        <?=h::select("src[".$ctrl->name."][like][none]", @$src['none'],@$ctrl->att_style.' class="select2_ctrl src_'.$ctrl->name.' form-control filter-input-control"',
            @$table,'1=1 '.($ctrl->att_where==''?'':' and '.$ctrl->att_where),$field_lang,@$ctrl->att_key,@$ctrl->att_order,
            @$ctrl->att_first,@$ctrl->att_char,'--- '.@$ctrl->title.' ---','');?>
        <script>
        $('.src_{{$ctrl->name}}').val('{{ @$src["none"]}}')
        </script>
    </div>

</div>
@else
<div class="col-md-6 form-group mobo style-input-mobo">
    <label class="filter-input-control">{!!$ctrl->title !!}</label>
    
    <div class="col-md-9 input-box">        
        <?=h::select("src[".$ctrl->name."][like][none]", @$src['none'],@$ctrl->att_style.' class="select2_ctrl  src_'.$ctrl->name.' form-control filter-input-control"',
             @$table,'1=1 '.($ctrl->att_where==''?'':' and '.$ctrl->att_where),@$ctrl->att_field.($lang==''?'':'_'.$lang),@$ctrl->att_key,@$ctrl->att_orderby,
             @$ctrl->att_first,@$ctrl->att_char,'--- '. @$ctrl->title.' ---','');?>
        <script>
            $('.src_{{$ctrl->name}}').val('{{ @$src["none"]}}')
        </script>
    </div>
</div>  
@endif
@push('script')
<link href="{{env_host}}/public/plugin/select2/4.0.11/css/select2.css" rel="stylesheet" />
<script src="{{env_host}}/public/plugin/select2/4.0.11/js/select2.js"></script>
<style type="text/css">
    .select2-container--default .select2-selection--single {
        background-color: #fff;
        border: 1px solid #aaa;
        border-radius: 4px;
        height: 42px;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        background-color:transparent;
    }
</style>
<script>
    $(document).on('mouseover', '.select2_ctrl', function () {

        $(this).select2({
            placeholder: "Select ",
            allowClear: true
        });

    });

</script>
@endpush
