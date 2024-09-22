@php
    $rows = md::find_all($func->table,$ctrl->att_table."='".$row->{$ctrl->att_table}."'");
    $rows = \h::array_group_alone($rows->toArray(),"lang_code",true);
@endphp

<td class=" text-center language-header no-sort">
    <div class="text-center language-column">

        @foreach($language as $lang)
            @if(@$rows[$lang->languagecode])
                @if(@$row->{$ctrl->value}==$lang->languagecode)
                <a href="{{url('admin/'.request()->segment(2))}}/edit/{{$rows[$lang->languagecode][$func->field_id] }}" class="tip" title="Current record's language">
                    <i class="fa fa-check text-success"></i>
                </a>

                @else
                <a href="{{url('admin/'.request()->segment(2))}}/edit/{{$rows[$lang->languagecode][$func->field_id] }}" class="tip" title="Edit related language for this record">
                    <i class="fa fa-edit"></i>
                </a>
                @endif
            @else
            <a href="{{url('admin/'.request()->segment(2))}}/new?ref_from={{$row->{$func->field_id} }}&ref_lang={{$lang->languagecode}}&lang_token={{$row->{$ctrl->att_table} }}" class="tip" title="Add other language version for this record">
                <i class="fa fa-plus"></i>
            </a>
            @endif
            
        @endforeach


    </div>
</td>
