<div class="pagi">

</div>
<div class="row">
    <div class="col-sm-12">
        <div class="table-responsive highlight">
            <table class="table table-hover potentiallinecard-list" cellpadding="0" cellspacing="0" width="100%" border="0">
                <thead class="tableFloatingHeaderOriginal">
                    <form id="form-filter" method="get" action="<?= site_url($GLOBALS['var']['act']) . '/update/' . @$info['id'] ?>">
                        <tr class="filter-head">
                            <?
                            $dc_FileName = isset($_GET['filter']['dc_FileName']) ? $_GET['filter']['dc_FileName'] : '';
                            $dc_ReportDateFrom = isset($_GET['filter']['rp_ReportDateFrom']) ? $_GET['filter']['rp_ReportDateFrom'] : '';
                            $dc_ReportDateTo = isset($_GET['filter']['rp_ReportDateTo']) ? $_GET['filter']['rp_ReportDateTo'] : '';
                            $dc_Ext = isset($_GET['filter']['dc_Ext']) ? $_GET['filter']['dc_Ext'] : '';
                            $dc_UserAdded = isset($_GET['filter']['dc_UserAdded']) ? $_GET['filter']['dc_UserAdded'] : '';
                            ?>
                            <th>
                                <button type="submit" class="btn btn-danger">Filter</button>
                            </th>
                            <th style="width: 300px; min-width: 300px;">
                                <input autocomplete="off" type="text" name="filter[dc_FileName]" value="<?= $dc_FileName ?>" class="form-control">
                                <?php if (isset($dc_FileName) && $dc_FileName) : ?>
                                    <i class="icon glyphicons remove"></i>
                                <?php endif ?>
                            </th>
                            <th style="width: 200px; min-width: 200px;">
                                <div id="datepicker">
                                    <div class="input-daterange input-group" id="datepicker">
                                        <input type="text" autocomplete="off" name="filter[rp_ReportDateFrom]" value="<?= (isset($dc_ReportDateFrom) ? $dc_ReportDateFrom : '') ?>" class="form-control" style="width: 50%; display: inline-block;" />
                                        <input type="text" autocomplete="off" name="filter[rp_ReportDateTo]" value="<?= (isset($dc_ReportDateTo) ? $dc_ReportDateTo : '') ?>" class="form-control" style="width: 50%; display: inline-block;" />
                                    </div>
                                </div>
                                <?php if ((isset($dc_ReportDateFrom) && $dc_ReportDateFrom) || (isset($dc_ReportDateTo) && $dc_ReportDateTo)) : ?>
                                    <i class="icon glyphicons remove"></i>
                                <?php endif ?>
                            </th>
                            <th style="width: 150px; min-width: 150px;">
                                <?= get_options_extension('filter[dc_Ext]', $dc_Ext, 'class="form-control select2"', true) ?>
                            </th>
                            <th style="width: 250px; min-width: 250px;">
                                <?= form_dropdown('filter[dc_UserAdded]', array('' => 'Select...')  + @$staff??[], @$dc_UserAdded, 'class="form-control select2"') ?>
                            </th>
                            <th nowrap="nowrap"></th>
                            <th nowrap="nowrap"></th>
                            <th nowrap="nowrap"></th>
                        </tr>
                    </form>
                </thead>
                <thead class="">
                    <tr class="nodrop">
                        <th class="center" width="2%">No</th>
                        <th style="min-width: 300px; max-width: 300px">File Name</th>
                        <th style="min-width: 300px; max-width: 300px">File Type</th>
                        <th style="min-width: 200px; max-width: 200px">Date</th>
                        <th class="right" style="min-width: 250px; max-width: 250px;">User Added</th>
                        <th class="center" style="min-width: 150px; width: 150px; max-width: 150px;">
                            Date Added</th>
                        <th class="center" style="min-width: 150px; max-width: 150px">Extentsion</th>
                        <th class="center" style="min-width: 150px; width: 150px; max-width: 150px;">
                            &nbsp;</th>
                    </tr>
                </thead>
                <?php
                if (is_array($documents) && count($documents)) {
                    $i = 1;
                    if ($GLOBALS['var']['results_per_page'] && $GLOBALS['var']['page']) {
                        $i = $GLOBALS['var']['page'] * $GLOBALS['var']['results_per_page'] - $GLOBALS['var']['results_per_page'] + 1;
                    }
                    $month = 0;
                    $year = 0;
                    foreach ($documents as $k => $file) {
                        if ($month != 0 && $month != date_parse_from_format("Y-m-d", $file['document_date'])["month"]) {
                            echo '<tr class="highlight bg-primary"><td colspan="8" style="background: transparent">Tháng ' . $month . '-' . $year . '</td></tr>';
                        }
                 ?>
                        <? if (file_exists($dir . $file['file_name']) || true) : ?>
                            <tr data-id="<?= $file['id'] ?>" data-file="<?= $file['file_name'] ?>">
                                <td class="center" width="2%"><?= $i ?></td>
                                <td style="min-width: 300px; max-width: 300px;" title="<?= $file['filename'] ?>">
                                    <?= isset($file['filename']) ? $file['filename'] : $file['file_name'] ?>
                                </td>
                                <td style="min-width: 300px; max-width: 300px;" title="<?= $file['file_type'] ?>">
                                    <?=$document_type[$file['file_type']]?>
                                </td>
                                <td style="min-width: 200px; max-width: 200px;" title="<?= $file['document_date'] ?>"><?= $file['document_date'] ?></td>
                                <td class="right" style="min-width: 250px; max-width: 250px;" title="<?= $file['user_add'] ?>"><?= $file['user_add'] ?></td>
                                <td class="center" style="min-width: 150px; max-width: 150px;" title="<?= $file['date_added'] ?>"><?= $file['date_added'] ?></td>
                                <td class="center" style="min-width: 150px; max-width: 150x;" title="<?= $file['ext'] ?>"><img src="<?= ICON_DIR . $file['ext'] . '.png' ?>" alt="<?= $file['ext'] ?>" height="25px" width="25px"></td>
                                <td class="center" style="min-width: 150px; max-width: 150px;">
                                    <a href="<?= $GLOBALS['var']['act'] ?>/readfile?key=<?= base64_encode($dir . $file['file_name']) ?>" data-file="<?= $dir . $file['file_name'] ?>" target="_blank"><i class="fa fa-eye fa-fw" aria-hidden="true"></i></a>
                                    <a href="<?= $dir . $file['file_name'] ?>" target="_blank"><i class="fa fa-download fa-fw"></i></a>
                                    <?php if($permissionReturnApproved) : ?>
                                    <a href="javascript:;" class="delete-file-in-update" data-table="$dir" data-dir="<?= $dir ?>"><i class="fa fa-remove fa-fw"></i></a>
                                    <?php endif ?>
                                </td>
                            </tr>
                        <? endif; ?>
                    <?php
                        $month = date_parse_from_format("Y-m-d", $file['document_date'])["month"];
                        $year = date_parse_from_format("Y-m-d", $file['document_date'])["year"];
                        $i++;
                    }
                    echo '<tr class="highlight bg-primary"><td colspan="8" style="background: transparent">Tháng ' . $month . '-' . $year . '</td></tr>';
                } else {
                    echo no_data_mes(7);
                }
                ?>
            </table>
        </div>
    </div>
</div>