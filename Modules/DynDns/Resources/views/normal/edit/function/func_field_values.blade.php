@php
    $field_group = [];
    $sys_field_items = [];
    if($func->phpfile=="pages")
    {
        $pages = array_column(md::find_all("sys_pages","lang_token='".@$row->lang_token."'")->toArray(),"id");
        if(!empty($pages))
        {
            $field_group = md::find_all("sys_field_groups","page='".$func->phpfile."' and value in (".implode(',',$pages).")")->pluck('id')->toArray();
        }
    }
    else{
        $field_group = md::find_all("sys_field_groups","page='".$func->phpfile."' and value='".@$row->{$func->field_id}."'")->pluck('id')->toArray();
    }

    if(!empty($field_group)){
        $sys_field_items = md::find_all("sys_field_items","field_group_id in (".implode(',',$field_group).") and parent_id=0","`order`");
    }
    $count = -1;
@endphp
@foreach($sys_field_items as $field)

    @php
         $custom_fields = md::find("sys_custom_fields","field_item_id='$field->id'");
         $custome_field_id = @$custom_fields->id;
         if(!empty(@$custom_fields) && @$custom_fields->use_for_id != $row->{$func->field_id}){
            $custome_field_new =  md::find("sys_custom_fields","use_for_id='".$row->{$func->field_id}."' and field_item_id='$field->id'");
            $custom_fields->value = @$custome_field_new->value;
            $custome_field_id  = @$custome_field_new->id;
         }
         $field_value = (object)array(
                 'title'=>$field->title,
                 'value'=>@$custom_fields->value
         );

         $ctrl = (object)array(
             'name'=>'custom_field['.(@$custome_field_id??$count--).']['.$field->id .'][value]',
             'title'=>$field->title,
             'value'=>'value',
             'note'=>'',
             'width'=>@$ctrl->width,
             'type'=>@$field->type,
             'mask'=>@$field->mask,
             'att_table'=>'',
             );

            $pair['row']= $field_value;
            $pair['ctrl'] = $ctrl;
            $pair['lang'] = @$ctrl->language==1?'_'.@$lang:'';
            $pair['path_base'] = $path_base;
    @endphp


    @if(view()->exists("admin::sys.template.normal.edit.".$ctrl->type.".".@$ctrl->mask))
        {!! view("admin::sys.template.normal.edit.".$ctrl->type.".".@$ctrl->mask,$pair) !!}
    @else
        {!! view("admin::sys.template.normal.edit.".$ctrl->type.".".@$ctrl->type,$pair) !!}
    @endif
@endforeach
