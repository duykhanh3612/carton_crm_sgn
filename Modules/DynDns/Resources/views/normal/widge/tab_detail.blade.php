<div class="tab-pane active" id="tab_details" aria-expanded="true">
    <div class="box-body">
   
            @if(@$center_lang['tab_detail'] && count($languages)>1)
            <ul class="nav nav-tabs" style="display:none">
                <?php for($i=0;$i<count($languages);$i++):
                                                      $lang=$languages[$i]->languagecode?>
                <li class="<?=$i==0?'active':''?>">
                    <a href="#tab-<?=$i+1?>" data-toggle="tab" aria-expanded="false">
                        <img src="../assets/images/flags/<?=$lang?>.png" height="24" />
                    </a>
                </li><?php endfor?>
            </ul>
            @endif
            <div class="tab-content">
               
               
                <?php
                if(@$center_lang['tab_detail'])
                    for($i=0;$i<count($languages);$i++):
                        $lang=$languages[$i]->languagecode
                ?>
                <div class="tab-pane <?=$i==0?'active':''?>" id="tab-<?=$i+1?>">
                    <div class="panel-body">
                     @if(@$center_lang['tab_detail'])
                     @foreach(@$center_lang['tab_detail'] as $ctrl)
                     @php
                            $pair['row'] = @$row;
                            $pair['ctrl'] = $ctrl;
                            $pair['lang'] = @$ctrl->language==1?'_'.@$lang:'';
                            $pair['path_base'] = $path_base;
                     @endphp

                     @push($ctrl->align)
                     {!! view(h::area_admin.'::sys.template.normal.edit.'.$ctrl->type,$pair) !!}
                     
                     @endpush

                     @endforeach
                     @endif
                    </div>
                </div>
                <?php endfor  ?>

                <div class="col-md-3" id="col-left">@stack('left')</div>
                <div class="col-md-6" id="col-center">@stack('center')</div>
                <div class="col-md-3" id="col-right">@stack('right')</div>
                <script>
                    var col_left = $('#col-left').html();
                    var col_center = $('#col-center').html();
                    var col_right = $('#col-right').html();

                    if(col_left=='' && col_right!='')
                    {
                        $('#col-left').removeClass('col-md-3');
                        $('#col-center').removeClass('col-md-6');

                        $('#col-center').addClass('col-md-9');
                        $('#col-right').addClass('col-md-3');
                    }
                </script>
            </div>
    </div>
</div>
