<div class="tab-pane" id="tab_seo" aria-expanded="false">
        @if(@$center_lang['tab_seo'])
        @foreach(@$center_lang['tab_seo'] as $ctrl)
        @php
            $pair['row'] = @$row;
            $pair['ctrl'] = $ctrl;
            $pair['lang'] = @$ctrl->language==1?'_'.$_lang:'';
            $pair['path_base'] = $path_base;
            echo view(h::area_admin.'::sys.template.normal.edit.'.$ctrl->type,$pair);
        @endphp
        @endforeach
        @endif
</div>