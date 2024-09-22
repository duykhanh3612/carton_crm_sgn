<th class="thft-<?$key?>ss" style="width: <?=isset($col->width) ? $col->width : "300px"?>; min-width: <?=isset($col->width) ? $col->width : "100px"?>; max-width: <?=isset($col->width) ? $col->width : "100px"?>;">
<?=form_dropdown('filter[' . $key . ']', $options, $value, 'id="' . $key . '" class="form-control select2"')?>
</th>