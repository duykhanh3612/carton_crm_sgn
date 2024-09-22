@php
$third_module_table = $ctrl->att_table;
$tr_rows = md::find_all($ctrl->att_table,$ctrl->att_key."='".@$row->{$ctrl->note}."'")     ;
$tr_struct = json_decode(@$ctrl->struct);
@endphp

<div class="form-group {{  $ctrl->width}} desktop " data-title="third_module_list">
    <label>
        {{        $ctrl->title }} @if        (@$ctrl->validate==1)
          <span style="color:#ff0000">(*)</span>@endif
    </label>

        @foreach($tr_rows as $d)
    <div class="row">
        <?php
        foreach($tr_struct as $ctr){
            $pair['row'] = @$d;
            $pair['ctrl'] = $ctr;
            $pair['path_base'] = $path_base;
            $pair['lang'] = @$ctrl->language==1?_lang:'';
            $pair['func'] = $func;

            if(@$ctr->type!='' && view()->exists(alias_admin.'::sys.template.normal.edit.'.@$ctr->type))
                echo View(alias_admin.'::sys.template.normal.edit.'.@$ctr->type, $pair);
        }?>
    </div>
        @endforeach

    <div>
        <a href="javascript:;">
            <i class="fa fa-plus-square tml_plus" aria-hidden="true"></i>

        </a>
        <style type="text/css">
        .tml_plus{
            font-size: 28px;
            padding:2px;
        }
        </style>
    </div>
</div>

