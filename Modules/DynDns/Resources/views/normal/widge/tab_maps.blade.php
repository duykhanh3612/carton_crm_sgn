<div class="tab-pane" id="tab_maps" aria-expanded="false">
    @if(@$center_lang['tab_maps'])
    @foreach(@$center_lang['tab_maps'] as $ctrl)
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