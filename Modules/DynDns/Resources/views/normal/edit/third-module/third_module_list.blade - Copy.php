@php
$third_module_table = $ctrl->att_table;
$tr_rows = md::find_all($ctrl->att_table,$ctrl->att_key."='".@$row->{$ctrl->note}."'")
$tr_struct = json_decode($ctrl->struct);
@endphp

<div class="form-group {{  $ctrl->width}} desktop ">
    <label>
        {{        $ctrl->title }} @if        (@$ctrl->validate==1)
          <span style="color:#ff0000">(*)</span>@endif
    </label>
    <div class="">
        @foreach($tr_rows as $d)

        <?php
        foreach($tr_struct as $ctrl){
            $pair['row'] = @$row;
            $pair['ctrl'] = $ctrl;
            $pair['path_base'] = $path_base;
            $pair['lang'] = @$ctrl->language==1?_lang:'';
            $pair['func'] = $func;
            if($ctrl->type!='' && view()->exists(\h::area_admin.'::sys.template.normal.index.'.$ctrl->type))
                echo View(\h::area_admin.'::sys.template.normal.edit.'.$ctrl->type, $pair);
            else
            {
                if(view()->exists("admin::sys.template.normal.edit.".$ctrl->type.".".@$ctrl->mask))
                    include("admin::sys.template.normal.index.edit.".@$ctrl->mask);
            }
        }?>

        @endforeach
    </div>
</div>

