
<div class="tab-pane" id="tab_extra2" aria-expanded="false">
    <div class="panel-body">
        @if(@$center_lang['tab_extra2'])
        @foreach(@$center_lang['tab_extra2'] as $ctrl)
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