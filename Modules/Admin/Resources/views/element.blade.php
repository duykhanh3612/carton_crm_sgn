@isset($theads)
    @foreach ($theads as $thead)
    @push('content_' . (Arr::get($thead, 'align') ?? 'center'))
        @if (Arr::get($thead, 'type') == 'image')
        @include('admin::components.inputs.image', [
            'label' => $thead['text'],
            'name' => $thead['field'],
            'required' =>  @$thead['required'],
            'value' => @$record->{$thead['field']},
            'class' => @$record->autoupdate?'update-eloquent ':'',
        ])
         @elseif(Arr::get($thead, 'type') == 'gallery')
         @include('admin::components.inputs.gallery', [
             'label' => $thead['text'],
             'name' => $thead['field'],
             'required' =>  @$thead['required'],
             'value' => @$record->{$thead['field']},
             'class' => 'update-eloquent',
             'colLeft' => @$thead['colLeft'],
             'rowClass' => @$thead['rowClass'],
             'path_upload' => 'upload/estate',
             'image_path' => ''
             ])
        @elseif(Arr::get($thead, 'type') == 'publish')
        @include('admin::components.inputs.publish', [
            'label' => $thead['text'],@
            'name' => $thead['field'],
            'required' =>  @$thead['required'],
            'value' => @$record->{$thead['field']},
            'class' => '',
        ])
        @elseif(Arr::get($thead, 'type') == 'textarea')
        @include('admin::components.inputs.textarea', [
            'label' => $thead['text'],
            'name' => $thead['field'],
            'required' =>  @$thead['required'],
            'value' => @$record->{$thead['field']},
            'class' => '',
        ])
        @elseif(Arr::get($thead, 'type') == 'fck_editor')
        @include('admin::components.inputs.fck_editor', [
            'label' => $thead['text'],
            'name' => $thead['field'],
            'required' =>  @$thead['required'],
            'value' => @$record->{$thead['field']},
            'class' => '',
        ])
        @elseif(Arr::get($thead, 'type') == 'google_map')
        @include('admin::components.inputs.google_map', [
            'label' => $thead['text'],
            'name' => $thead['field'],
            'required' =>  @$thead['required'],
            'value' => @$record->{$thead['field']},
            'class' => '',
            'colLeft' => @$thead['colLeft'],
            'rowClass' => @$thead['rowClass'],
        ])
        @elseif(Arr::get($thead, 'type') == 'select')
        @include('admin::components.inputs.select', [
            'label' => $thead['text'],
            'name' => $thead['field'],
            'required' =>  @$thead['required'],
            'value' => @$record->{$thead['field']},
            'class' => '',
            'colLeft' => @$thead['colLeft'],
            'rowClass' => @$thead['rowClass'],
            'data' => @$thead['data']
            ])
        @elseif(Arr::get($thead, 'type') == 'form_drop')
        @php
            if(!empty($model[@$thead['table']]))
            {
                $model = new $model[@$thead['table']];
                $options = $model::selectRaw((@$thead['table_field']['value']??'name'). ' as name,'.(@$thead['table_field']['key']??"id").' as id')->whereRaw(@$thead['table_where']??='1=1')->pluck("name","id")->toArray();
            }
            else{
                $options = [];
            }

        @endphp
        @include('admin::components.inputs.select', [
            'label' => $thead['text'],
            'name' => $thead['field'],
            'required' =>  @$thead['required'],
            'value' => @$record->{$thead['field']},
            'class' => '',
            'colLeft' => @$thead['colLeft'],
            'rowClass' => @$thead['rowClass'],
            'data' => array_replace ([''=> @$thead['empty_value']??'Select...'],$options)
            ])
         @elseif(Arr::get($thead, 'type') == 'role_group')
         @include('admin::components.inputs.role.role_group', [
              'label' => $thead['text'],
              'name' => $thead['field'],
              'required' =>  @$thead['required'],
              'value' => @$record->{$thead['field']},
              'value_name' => @$record->{$thead['field'].'_name'},
              'class' => '',
              'colLeft' => @$thead['colLeft'],
              'rowClass' => @$thead['rowClass'],
              ])
         @elseif(Arr::get($thead, 'type') == 'geo_district')
         @php
             if(!empty($model[@$thead['table']]))
             {
                 $query = new $model[@$thead['table']];
                 $options = $query::selectRaw((@$thead['table_field']['value']??'name'). ' as name,'.(@$thead['table_field']['key']??"id").' as id')
                 ->whereRaw(@$thead['table_where']??='1=1')->pluck("name","id")->toArray();
             }
             else{
                 $options = [];
             }


             if(@$thead['empty_value'])
             {
                $options = array_replace ([''=>'Select...'],$options);
             }

         @endphp
        @include('admin::components.inputs.geo_district', [
            'label' => $thead['text'],
            'name' => $thead['field'],
            'required' =>  @$thead['required'],
            'value' => @$record->{str_replace("[]","",$thead['field'])},
            'class' =>  @$thead['class'],
            'colLeft' => @$thead['colLeft'],
            'rowClass' => @$thead['rowClass'],
            'multiple' => true,
            'data' => $options
        ])
         @elseif(Arr::get($thead, 'type') == 'checkbox')
         @include('admin::components.inputs.checkbox', [
             'label' => $thead['text'],
             'name' => $thead['field'],
             'required' =>  @$thead['required'],
             'value' => isset($record) && !empty($record)?@$record->{$thead['field']}:@$thead['defaultValue'],
             'class' => @$thead['class'],
             'colLeft' => @$thead['colLeft'],
             'rowClass' => @$thead['rowClass'],
             ])
        @elseif(in_array(Arr::get($thead, 'type'),['decimal','money','colspan','message']))
        @include('admin::components.inputs.'.Arr::get($thead, 'type'), $thead)
        @else
        @include('admin::components.inputs.text', [
            'label' => $thead['text'],
            'name' => $thead['field'],
            'required' =>  @$thead['required'],
            'value' => @$record->{$thead['field']},
            'class' => '',
            'colLeft' => @$thead['colLeft'],
            'rowClass' => @$thead['rowClass'],
        ])
        @endif
    @endpush
    @endforeach
@endisset
