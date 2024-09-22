<?php if (@$GLOBALS['module']['approved']) : ?>
    <?php
        $userGroups = $this->fn->show_options('usergroups', array('order_by' => 'id asc', 'field' => 'id, name_vn', 'val' => array('name_vn'), 'empty_val' => false));
        $department = $this->fn->show_options('departments', array('order_by' => 'sort_order asc', 'field' => 'id, name_vn', 'val' => array('name_vn'), 'empty_val' => false));
        $staff = $this->fn->show_options('users', array('order_by' => 'fullname asc', 'field' => 'id, fullname', 'val' => array('id', 'fullname'), 'empty_val' => true));
        $approved = $this->db->select('*')->from($module . '_approved')->where('rpid', $id)->order_by('id ASC')->get()->result_array();
        $prepure = $this->db->select('rpid')->from($module . '_approved')->where('rpid', $info['id'])->where('approved_level', 0)->group_by('rpid')->having('min(status) = 2')->get()->num_rows();
        $returnApprove = $this->db->select('count(id) as qty, MAX(date_added) as date')->from('approvedlogs')->where('codeid', $id)->where('module', $module)->where('type', 'Return-Approved')->order_by('date_added DESC')->get()->row_array();
        $colors = ['red', 'success', 'danger', 'warning', 'info', 'yellow', 'purple', 'azure', 'black', 'blue-alt'];

        $dataApproved = [];
        $numberApproved = 0;
        $approvedLevel = 0;
        $numberLevel = 0;
        foreach ($approved as $value) {
            if($value['status'] != 1) $numberApproved++;
            if($value['approved_level'] > 0 && $approvedLevel != $value['approved_level']) {
                $numberLevel++;
            }
            $approvedLevel = $value['approved_level'];
            $dataApproved[$value['approved_level']][] = $value;
        }

        $approverGroup[] = ["id" => 0, "text" => 'Select an Option'];
		foreach ($userGroups as $key => $row) {
			$approverGroup[] = array("id" => $key, "text" => $row);
		}

        $approverDepartment[] = ["id" => 0, "text" => 'Select an Option'];
		foreach ($department as $key => $row) {
			$approverDepartment[] = array("id" => $key, "text" => $row);
		}
        
        /* Check permission return approved */
        $permissionReturnApproved = !empty($info['id']) ? checkReturnApproved($module, $info['id'], $GLOBALS['user']['id']) : false;
    ?>

    <div style="border-bottom: none;display:flex;justify-content: space-between;">
        <div style="display: inline-block;">
            <?php if ($GLOBALS['user']['level'] == 1 || $GLOBALS['per']['return'] == 1 || $permissionReturnApproved) : ?>
                <?php if ($approved) : ?>
                    <div>
                        <a href="#" title="Return Date: <?= $returnApprove['date'] ?? '' ?>" class="btn-counter-approved btn-counter btn-<?= $colors[$returnApprove['qty']] ?? $colors[0] ?>" data-count="<?= $returnApprove['qty'] ?>" id="undoApproved" style="float:left;margin-top:15px;margin-left: 10px">Return Approval</a>
                    </div>
                    <?php if(!empty($returnApprove['date'])) : ?>
                    <div style="margin-left: 10px;line-height: 20px;">
                        <?= isset($returnApprove['date']) ? 'Return Date:' . date("Y-m-d", strtotime($returnApprove['date'])) : ''  ?>
                    </div>
                    <?php endif ?>
                <?php endif ?>
            <?php endif ?>
        </div>
        <?php if ($approved) { ?>
            <script>
                $('body').on('click', '#approved', function() {
                    // $( "#approved" ).click(function() {
                    var id = $(this).data('id');
                    var checkstatus = $(this).closest('.div-table').next('.div-table').find(
                        '#checkstepbystep').val();

                    if (checkstatus != 1) {
                        $.alerts.confirm1(
                            'Are you sure you confirm this item? Successfully confirming the system will lock the system cannot be adjusted. Please double check before doing, Thanks !!!<br />',
                            'Confirm ',
                            function(r) {
                                if (r == "a") {
                                    $.ajax({
                                        url: site_url + 'ajax/ApprovedChangeStatus',
                                        type: 'POST',
                                        cache: false,
                                        data: {
                                            id: id,
                                            type: 3,
                                            module: '<?= $module ?>'
                                        },
                                        success: function(string) {
                                            location.reload();
                                        }
                                    })
                                } else if (r == true) {
                                    $.ajax({
                                        url: site_url + 'ajax/ApprovedChangeStatus',
                                        type: 'POST',
                                        cache: false,
                                        data: {
                                            id: id,
                                            type: 2,
                                            module: '<?= $module ?>'
                                        },
                                        success: function(string) {
                                            location.reload();
                                        }
                                    })
                                }
                            });
                    } else {
                        showNoti('Please Approve in sequence', 'Error', 'Err');
                    }
                });
            </script>
            <div style="margin-top:<?= ($GLOBALS['user']['level'] == 1 || $GLOBALS['user']['approved_signature'] == 2) ? '5px' : '10px' ?>">
                <div class="approved" style="display: flex;">
                    <?php
                    $check_approved = '';
                    foreach (array_reverse($approved) as $key => $value) {
                    ?>

                        <div class="div-table">
                            <input type="hidden" id="checkstepbystep" value="<?= $value['status']  ?>">
                            <div class="div-table-row">
                                <div class="div-table-col" style="height: 28px" align="center">
                                    <?php echo get_data('users', 'id = "' . $value['staff'] . '"', 'fullname'); ?>
                                </div>
                            </div>
                            <div class="div-table-row">
                                <div class="div-table-col" style="height: 74px;">
                                    <?php if ($value['status'] == 1) {
                                        if ($value['staff'] == $GLOBALS['var']['user_id']) {
                                            if ($value['approved_level'] == '0') {
                                                echo '<img src="assets/images/approved/icons8-rubber-stamp-96.png" alt="Girl in a jacket" width="60" height="60" class="img_center" data-id="' . $value['id'] . '" id="approved" style="cursor: pointer;"><span>' . ($value['approved_level'] == 0 ? ' Prepair by ' : 'Level ' . $value['approved_level']) . '</span>';
                                            } else if ($value['approved_level'] != '0' && $prepure != 0) {
                                                echo '<img src="assets/images/approved/icons8-rubber-stamp-96.png" alt="Girl in a jacket" width="60" height="60" class="img_center" data-id="' . $value['id'] . '" id="approved"  style="cursor: pointer;"><span>' . ($value['approved_level'] == 0 ? ' Prepair by ' : 'Level ' . $value['approved_level']) . '</span>';
                                            } else {
                                                echo '<img src="assets/images/approved/icons8-rubber-stamp-96.png" alt="Girl in a jacket" width="60" height="60" class="img_center" data-id="' . $value['id'] . '"><span>' . ($value['approved_level'] == 0 ? ' Prepair by ' : 'Level ' . $value['approved_level']) . '</span>';
                                            }
                                        } else {
                                            echo '<img src="assets/images/approved/icons8-rubber-stamp-96.png" alt="Girl in a jacket" width="60" height="60" class="img_center" data-id="' . $value['id'] . '"><span>' . ($value['approved_level'] == 0 ? ' Prepair by ' : 'Level ' . $value['approved_level']) . '</span>';
                                        }
                                    } elseif ($value['status'] == 2) {
                                        echo '<img src="assets/images/approved/icons8-verified-account-100.png" alt="Girl in a jacket" width="60" height="60" class="img_center"><span >' . $value['date_approved_staff'] . '</span>';
                                    } else {
                                        echo '<img src="assets/images/approved/icons8-unavailable-128.png" alt="Girl in a jacket" width="60" height="60" class="img_center"><span >' . $value['date_approved_staff'] . '</span>';
                                    }
                                    $check_approved = $key;

                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php    }   ?>
                </div>
            </div>

        <?php } ?>
    </div>


    <div class="info-header">
        <a href="#ap-information" data-toggle="collapse">
            <h1><i class="glyph-icon icon-chevron-down"></i> Approved Information</h1>
        </a>
    </div>
    <div id="ap-information" <?= $numberApproved != 0 ? 'class="lock"' : '' ?>>
        <div style="display: flex; width: 200px; margin: auto; align-items: center">
            Number level:&nbsp;
            <span style="width: 100px !important;">
                <select class="form-control select2" id="levelapp" style="width: 100px !important;">
                    <option value="-1">Select ...</option>
                    <?php
                    $i = $GLOBALS['cfg']['limit_level_approved_purchase_order'];
                    $start = $levelDefault ? 0 : 1;
                    for ($x = $start; $x <= $i; $x++) {
                        $selected = ($numberLevel === $x || ( $levelDefault && $x == 0 )) ? ' selected' : '';
                        echo '<option value="' . $x . '"' . $selected . '>' . $x  . '</option>';
                    }
                    ?>
                </select>
            </span>

        </div>
        <div id="list_approved">
            <?php if ($approved) { ?>
                <div id="approver-information" class="collapse in">
                    <div class="row">
                        <div class="">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="col-sm-1"><label>Approved level</label></div>
                                        <div class="col-sm-1"><label>Number Approver</label></div>
                                        <div class="col-sm-2"><label>Title</label></div>
                                        <div class="col-sm-3"><label>Department</label></div>
                                        <div class="col-sm-3"><label>Staff Number</label></div>
                                        <div class="col-sm-2"><label>Approved Date</label></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="fg-wrap fg-wrap-approver " id="fg-wrap-approver">
                            <?php foreach ($dataApproved as $key => $approved) : ?>
                                <div data-level="<?= $key ?>" class="form-group group-required fg-inv number_approver_row number_approver_check">
                                    <?php foreach ($approved as $k => $value) : ?>
                                        <div class="number-approver-item" data-index="<?= ($k + 1) ?>">
                                            <div class="row queryStaff" style="margin-bottom: 5px;">
                                                <div class="col-sm-12">
                                                    <div class="col-sm-1">
                                                        <?php
                                                        if ($value['approved_level'] == 0) {
                                                            $level = 'Prepare by';
                                                        } else {
                                                            $level = 'Level ' . $value['approved_level'];
                                                        }
                                                        ?>
                                                        <span>
                                                            <?= $k > 0 ? '' : $level ?>
                                                            <input type="hidden" name="approved[SortOder][]" class="disabled_app form-control" value="<?= $value['SortOder'] ?>" placeholder="Number Approver">
                                                            <input type="hidden" name="approved[addendum][]" class="disabled_app form-control" value="<?= $value['addendum'] ?>" placeholder="Number Approver">
                                                            <input type="hidden" name="approved[status][]" class="disabled_app form-control number_approver" value="<?= $value['status'] ?>" placeholder="Number Approver">
                                                            <input type="hidden" name="approved[level_approver][]" class="disabled_app form-control number_approver" value="<?= $value['approved_level'] ?>" placeholder="Number Approver">
                                                        </span>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <div class="input-group">
                                                            <input <?= $k > 0 ? 'type="hidden"' : '' ?> data-approved-level="<?= $value['approved_level'] ?>" id="number_approver_<?= $value['approved_level'] ?>" name="approved[number_approver][]" class="form-control disabled_app number_approver" value="<?= count($approved) ?>" placeholder="Number Approver">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2 usergroup_close_<?= $value['id'] ?>">
                                                        <?php echo form_dropdown('approved[title_usergroup][]', $userGroups, json_decode($value['title_approved']), 'class="form-control disabled_app js-example-basic-multiple" data-required="1" style="width:100% !important"') ?>

                                                    </div>
                                                    <div class="col-sm-3 usergroup_close_<?= $value['id'] ?>">
                                                        <?php echo form_dropdown('approved[title_department][]', $department, json_decode($value['department']), 'class="form-control disabled_app js-example-basic-multiple-department" style="width:100% !important" data-required="1"') ?>
                                                    </div>
                                                    <div class="col-sm-3 multiple-staff usergroup_close_<?= $value['id'] ?>">
                                                        <?php echo form_dropdown('approved[title_staff][]', $staff, json_decode($value['staff']), 'class="form-control disabled_app js-example-basic-multiple-staff" style="width:100% !important" data-required="1"') ?>
                                                    </div>
                                                    <div class="col-sm-2 ">
                                                        <input type="text" class="form-control po-bootstrap-datetimepicker bootstrap-datepicker-time" data-CPODate="<?= $value['date_approved'] ?>" name="approved[title_date][]" value="<?= $value['date_approved'] ?>" autocomplete="off">
                                                        <div class="errordiv ">Not Empty</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <input type="hidden" value="<?= $numberLevel ?>" id="number_level" name="number_level">
<?php endif ?>

<link rel="stylesheet" href="assets/atckey/component/approved/style.css">
<script>
    var approverGroup = <?= json_encode($approverGroup); ?>,
        approverDepartment = <?= json_encode($approverDepartment); ?>,
        user = <?= json_encode($GLOBALS['user']); ?>;
</script>
<script src="assets/atckey/component/approved/script.js?v=01012023"></script>