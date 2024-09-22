
<table class="table table-hover business_trip-list" cellpadding="0" cellspacing="0" width="100%" border="0">
    <thead>
    <tr class="nodrop">
        <th width="2%" style="width: 40px; min-width: 40px;">&nbsp;</th>
        <th>Issue Code</th>
        <th>Status</th>
        <th>Summary</th>
        <th>Type</th>
        <th>Issue Date</th>
        <th>Due Date</th>
        <th>Assignee</th>
       
    </tr>
    </thead>
    <tbody>
    <?php
    if (is_array($projects_pane) && count($projects_pane)) {
        $i = 1;
        foreach ($projects_pane as $k => $v) {
            ?>
            <tr>
                <td><a href="cms_fix/update/<?= $v['id'] ?>"
                       target="_blank"><i
                            class="glyph-icon icon-edit"></i></a>&nbsp;<span
                        class="remove-project hidden" data-id="<?= $v['id'] ?>"><i
                            class="glyph-icon icon-remove"></i></span></td>
                <td><a href="cms_fix/update/<?= $v['id'] ?>"
                       target="_blank"><?= $v['code'] ?></a></td>
                <td>
               
                <span class="bs-label" style="width: -webkit-fill-available;background:<?=  get_data('orders_status', 'type = "CMSFix" AND Statuskey = ' . $v['status'] . ' ', 'color')  ?>">
                <?=  get_data('orders_status', 'type = "CMSFix" AND Statuskey = ' . $v['status'] . ' ', 'name_vn')  ?>
                </span>         
            
                 </td>
                <td><?= $v['summary'] ?></td>
                <td>
                    <?php 
                                        $Options = get_data('option_items_keynum', 'Field = "TypeCmsFix" AND active = 1 AND deleted = 0', 'Options');
                                        if ($Options) {
                                            $options = json_decode($Options);
                                            foreach ($options as $value) {
                                                $key = (int)$value->key;
                                                if ($key == $v['type']) {
                                                   echo $value->name;
                                                }else if( $v['type'] == 0){
                                                    $val = '';
                                                }
                                            }
                                        }
                    ?>
                
                </td>
                <td><?= $v['issue_date'] ?></td>
                <td><?= $v['due_date'] ?></td>
                <td><?= get_name_staff($v['assignee'])  ?></td>
               
            </tr>
            <?php
            $i++;
        }
    }
    ?>
    </tbody>
</table>
