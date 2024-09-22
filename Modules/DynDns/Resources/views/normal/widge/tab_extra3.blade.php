<div class="tab-pane" id="tab_extra3" aria-expanded="false">
        @if(@$center_lang['tab_extra3'])
        @foreach(@$center_lang['tab_extra3'] as $ctrl)
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