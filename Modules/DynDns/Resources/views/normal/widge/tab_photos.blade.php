<div class="tab-pane" id="tab_photos" aria-expanded="false">
    <div class="panel-body">
        @if(@$center_lang['tab_photos'])
    @foreach(@$center_lang['tab_photos'] as $ctrl)
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
</div>
