@php
    $table = @$ctrl->att_table_prefix==1?@$admin_group->prefix."_". $ctrl->att_table:$ctrl->att_table;
    $field_lang = $ctrl->att_field.(@$ctrl->att_field_language==1?_lang:'');
@endphp

<div class="col-md-6 form-group desktop row" data-title="list">
    <div class="col-md-4 filter-input-group">
        <label class="filter-input-control">{!!$ctrl->title !!}</label>
    </div>
    <div class="col-md-8">
        <?=h::select("src[".$ctrl->name."][like][none]", @$src['none'],' class="src_'.$ctrl->name.' form-control filter-input-control"',
            @$table,'1=1 '.($ctrl->att_where==''?'':' and '.$ctrl->att_where),$field_lang,@$ctrl->att_key,@$ctrl->att_order,
            @$ctrl->att_first,@$ctrl->att_char,'--- '.@$ctrl->title.' ---','');?>
        <script>
        $('.src_{{$ctrl->name}}').val('{{ @$src["none"]}}')
        </script>
    </div>

</div>
