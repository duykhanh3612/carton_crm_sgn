<div >
    @if(@$center_lang['none'])
    @foreach(@$center_lang['none'] as $ctrl)
    @php
    $pair['row'] = @$row;
    $pair['ctrl'] = $ctrl;
    $pair['lang'] = @$ctrl->language==1?'_'.@$lang:'';
    $pair['path_base'] = $path_base;
    echo view(h::area_admin.'::sys.template.normal.edit.'.$ctrl->type,$pair);
    @endphp
    @endforeach
    @endif
 
</div>
