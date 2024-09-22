<?php
foreach ($options as $i => $item):?>
<tr class="highlight" id="<?= $i ?>">
    <td><input type="text" name="Options[<?= $i ?>][name]" value="<?= $item->name ?>" class="form-control" /></td>
    <td><input type="text" name="Options[<?= $i ?>][value]" value="<?= @$item->value ?>" class="form-control" /></td>
    <td><input type="<?= request('type') == 'text' || @$info['type'] == 'text' ? 'text' : 'number' ?>" name="Options[<?= $i ?>][key]" value="<?= $item->key ?>" class="form-control" />
    </td>
    <td class="center"><a href="javascript:;" class="move-option" style="font-size: 18px;"><i class="fa fa-arrows"></i></a></td>
    <td class="center"><a href="javascript:;" class="remove-option" style="font-size: 18px;"><i class="fa fa-remove"></i></a></td>
</tr>
<?php
endforeach;?>
