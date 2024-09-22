@php
    $search_type = '[like][both]';
    switch($ctrl->search_type){
        case 'input_id':
            $search_type  = '[like][none]';
            break;
        default:
            break;
    }
@endphp
<td>
    @if($ctrl->att_where!='')
        @php
         $pro_id = App\Model\md::find($ctrl->att_where,$ctrl->att_table."='".@$row->{$ctrl->name}."' ".($ctrl->att_field!=''?' and '.$ctrl->att_field:''));  
        @endphp
        @if(@$pro_id)
        <a href="{{h::site_url(h::area_admin.'/'. $ctrl->value.'?src['.$ctrl->att_table.']'.$search_type.'='.@$row->{$ctrl->name})}}" class="btn btn-sm blue">
            <small>
                {!! @$ctrl->note !!}
            </small>

        </a>
        @endif
    @else
    <a href="{{h::site_url(h::area_admin.'/'. $ctrl->value.'?src['.$ctrl->att_table.']'.$search_type.'='.@$row->{$ctrl->name})}}" class="btn btn-sm blue">
        <small>
            {!! @$ctrl->note !!}
        </small>

    </a>
    @endif
</td>         
