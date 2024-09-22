@php
    $colLeft = empty($colLeft) ? 12 : $colLeft;
    if ($colLeft == 12) {
        $colRight = 12;
    }
    $setting = json_decode($setting, true);
    $table = str_replace('table_', '', $setting['table']);
    $fn = new \App\Models\fnModel();
    $fields = $fn->categories(request('q'), $table) ?? [];
@endphp
<div class="form-group">
    <ul class="cat_treeview filetree treeview">
        {!! !empty($fields) ? cat_tree($fields, 0, @$value, 'radio') : '' !!}
    </ul>
</div>
