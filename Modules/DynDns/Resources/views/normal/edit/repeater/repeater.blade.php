@php
$name = $ctrl->name;
$name_id = str_replace(array('[',']',"#"),array('','',''),@$ctrl->name.$lang);
$field_ids = explode('][', $name);
if (!empty($field_ids)) {
    $field_id = $field_ids[1];
    $field_items = md::find_all('sys_field_items', "parent_id='$field_id '", '`order`');
}
$count = -1;
if($row->value!=""){
    $field_values = json_decode($row->value);
}

@endphp
<div class="widget meta-boxes form-group col-md-12">
    <div class="widget-title">
        <h4><span>{{ $row->title }}</span></h4>
    </div>
    <textarea name="{{$name}}" id="{{$name_id}}" style="width: 100%;display:none" rows="5">{{$row->value}}</textarea>
    <div class="box-body meta-boxes-body widget-body">
        <div class="meta-box field-repeater">
            <div class="title">
                <label class="control-label">Tag</label>
                <span class="help-block"></span>
            </div>
            <div class="meta-box-wrap">
                <div class="lcf-repeater">
                    <ul class="sortable-wrapper field-group-items ui-sortable">
                        @isset($field_values)
                        @foreach ($field_values as $field)
                        <li class="ui-sortable-handle" data-position="{{$loop->index+1}}">
                            <a href="javascript:;" class="remove-field-line" title="Remove this line"><span>&nbsp;</span></a>
                            <a href="javascript:;" class="collapse-field-line" title="Collapse this line"><i
                                    class="fa fa-bars"></i></a>
                            <div class="col-12 field-line-wrapper clearfix">
                                <ul class="field-group">
                                    @foreach ($field_items as $field_item)
                                            <li data-name="{{trim($field_item->slug)}}">
                                        @php
                                            $custom_fields = md::find('sys_custom_fields', "field_item_id='$field_item->id'");
                                            $custome_field_id = @$custom_fields->id;
                                            if (!empty(@$custom_fields) && @$custom_fields->use_for_id != @$row->{$func->field_id}) {
                                                $custome_field_new = md::find('sys_custom_fields', "use_for_id='" . @$row->{$func->field_id} . "' and field_item_id='$field_item->id'");
                                                $custom_fields->value = @$custome_field_new->value;
                                                $custome_field_id = @$custome_field_new->id;
                                            }
                                            $field_value = (object) [
                                                'title' => $field_item->title,
                                                'value' =>  $field->{trim($field_item->slug)}
                                            ];
                                            $ctrl = (object) [
                                                'name' => 'custom_field_repeater[' . (@$custome_field_id ?? $count--) . '][' . $field_item->id . '][value]',
                                                'title' => $field_item->title,
                                                'value' => 'value',
                                                'note' => '',
                                                'width' => @$ctrl->width,
                                                'type' => @$field_item->type,
                                                'mask' => @$field_item->mask,
                                                'att_table' => '',
                                            ];
                                            $pair['row'] = $field_value;
                                            $pair['ctrl'] = $ctrl;
                                            $pair['lang'] = @$ctrl->language == 1 ? '_' . @$lang : '';
                                            $pair['path_base'] = $path_base;
                                        @endphp


                                        @if (view()->exists('admin::sys.template.normal.edit.' . $ctrl->type . '.' . @$ctrl->mask))
                                            {!! view('admin::sys.template.normal.edit.' . $ctrl->type . '.' . @$ctrl->mask, $pair) !!}
                                        @else
                                            {!! view('admin::sys.template.normal.edit.' . $ctrl->type . '.' . @$ctrl->type, $pair) !!}
                                        @endif
                                            </li>

                                    @endforeach
                                </ul>
                            </div>
                            <div class="clearfix"></div>
                        </li>
                        @endforeach
                        @endisset

                    </ul>
                    <a href="javascript:;" class="repeater-add-new-field mt10 btn btn-success">Add new item</a>
                </div>
            </div>
        </div>
    </div>

    <div class="field-group-template" style="display: none">
        <ul class="field-group">
        @foreach ($field_items as $field)

                <li data-name="{{trim($field->slug)}}">
            @php
                $custom_fields = md::find('sys_custom_fields', "field_item_id='$field->id'");
                $custome_field_id = @$custom_fields->id;
                if (!empty(@$custom_fields) && @$custom_fields->use_for_id != @$row->{$func->field_id}) {
                    $custome_field_new = md::find('sys_custom_fields', "use_for_id='" . @$row->{$func->field_id} . "' and field_item_id='$field->id'");
                    $custom_fields->value = @$custome_field_new->value;
                    $custome_field_id = @$custome_field_new->id;
                }
                $field_value = (object) [
                    'title' => $field->title,
                    'value' => @$custom_fields->value,
                ];

                $ctrl = (object) [
                    'name' => 'custom_field[' . (@$custome_field_id ?? $count--) . '][' . $field->id . '][value]',
                    'title' => $field->title,
                    'value' => 'value',
                    'note' => '',
                    'width' => @$ctrl->width,
                    'type' => @$field->type,
                    'mask' => @$field->mask,
                    'att_table' => '',
                ];

                $pair['row'] = $field_value;
                $pair['ctrl'] = $ctrl;
                $pair['lang'] = @$ctrl->language == 1 ? '_' . @$lang : '';
                $pair['path_base'] = $path_base;
            @endphp


            @if (view()->exists('admin::sys.template.normal.edit.' . $ctrl->type . '.' . @$ctrl->mask))
                {!! view('admin::sys.template.normal.edit.' . $ctrl->type . '.' . @$ctrl->mask, $pair) !!}
            @else
                {!! view('admin::sys.template.normal.edit.' . $ctrl->type . '.' . @$ctrl->type, $pair) !!}
            @endif
                </li>

        @endforeach
    </ul>
    </div>
    <link rel="stylesheet" type="text/css" href="{{ env_host }}public/dashboard/botble/plugins/custom-field/css/custom-field.css" />
    <script>
         $(document).on('change', '.field-group-items input, .field-group-items select, .field-group-items textarea', function() {
            let items = [];
            var sub_items = [];
            $('.field-group-items>li').each(function(){
                let item_detail = {};
                $(this).find('.field-group>li').each(function(){
                    let name = $(this).data('name');
                    let value = $(this).find('input,textarea').val();
                    item_detail[name] = value;
                });
                sub_items.push(item_detail);
            });
            items.push(sub_items);
            $("#{{$name_id}}").val(JSON.stringify(sub_items));
        });
        $(document).on("click",".repeater-add-new-field",function(){
            let html = domp_item($('.field-group-template').html());
            $('.field-group-items').append(html);
        });

        function domp_item(item){
            let pos = $('.field-group-items > li').length+1;
            let html=`<li class="ui-sortable-handle" data-position="${pos}">
                            <a href="#" class="remove-field-line" title="Remove this line"><span>&nbsp;</span></a>
                            <a href="#" class="collapse-field-line" title="Collapse this line"><i
                                    class="fa fa-bars"></i></a>
                            <div class="col-12 field-line-wrapper clearfix">
                                ${item}
                            </div>
                            <div class="clearfix"></div>
                        </li>`;
            return html;
        }
    </script>
</div>
