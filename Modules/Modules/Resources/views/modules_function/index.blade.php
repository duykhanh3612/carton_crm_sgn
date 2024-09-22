
{!! Themes::modules('header', $module) !!}
<section class="content">
    <div class="container-fluid">
        <div class="card-tools">
            <div class="card-body">
                <div >
                    <?= module_open() ?>
                    <!-- header begin -->
                    <thead>
                        <!-- filter beign -->
                        <form method="get" action="<?= site_url($GLOBALS['var']['act']) ?>" id="filter<?= $GLOBALS['var']['act'] ?>">
                            <tr class="filter-head">
                                <th colspan="<?= $GLOBALS['per']['del'] ? 2 : 1 ?>" nowrap="nowrap">
                                    <button type="submit" class="btn btn-danger">Filter</button>
                                </th>
                                <?php foreach ($cols as $key => $col) : ?>
                                    <?php $option_filter = (@$options[$key] ? $options[$key] : false) ?>
                                    <?= col_filter($col, $key, $filter, $option_filter) ?>
                                <?php endforeach ?>
                                <th class="center" width="1%">&nbsp;</th>
                            </tr>
                        </form>
                        <!-- filter end -->

                        <tr class="nodrop">

                            <?php if ($GLOBALS['per']['del']) : ?>
                                <th class="center" width="1%"><input id="checkall" type="checkbox" class="checkAll custom-checkbox" /></th>
                            <?php endif ?>
                            <th class="center" width="2%" style="min-width: 40px;" nowrap="nowrap">#</th>

                            <?php foreach ($cols as $key => $col) : ?>
                                <?= col_name($col, $key) ?>
                            <?php endforeach ?>

                            <th class="center" width="1%">&nbsp;</th>
                        </tr>
                    </thead>
                    <!-- header end -->

                    <tbody>
                        <?php if (count($rows)) : ?>
                            <?php foreach ($rows as $k => $row) : ?>
                                <tr class="highlight" id="<?php echo $row->id ?>" name="<?php echo $row->name?>">
                                    <?php if ($GLOBALS['per']['del']) : ?>
                                        <td class="center"><?= sel_item($row->id, !$GLOBALS['per']['del']) ?></td>
                                    <?php endif ?>

                                    <td class="center" width="1%"><?= stt($row->id, $GLOBALS['var']['rowstart'] + $k + 1) ?></td>

                                    <?php foreach ($cols as $key => $col) : ?>
                                        <?= col_val($col, $key, @$row[$key], $row->id, site_url($GLOBALS['var']['act'] . '/update/' . $row->id) . $uri_str) ?>
                                    <?php endforeach ?>

                                    <td class="center" nowrap="nowrap">
                                        <?php if ($GLOBALS['per']['edit']) : ?>
                                            <?= edit_alink('', $url_update . '/' . $row->id . $uri_str) ?>
                                        <?php endif ?>
                                        <?php if ($GLOBALS['per']['del']) : ?>
                                            <?= del_restore_link($row->id, $row['deleted']) ?>
                                        <?php endif ?>
                                    </td>
                                </tr>

                            <?php endforeach ?>

                        <?php else : ?>
                            <?= no_data_mes(count((array)$cols) + 3) ?>
                        <?php endif ?>

                    </tbody>

                    <?= module_close() ?>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- <script type="text/javascript">
    $(document).ready(function() {
        <?php
        if ($updated == 1) {
            echo 'showNoti("Mô đun: ' . $name . '", "Thêm mới mô đun thành công!", "Ok");';
        }
        if ($failed == 1) {
            echo 'showNoti("Mô đun: ' . $name . '", "Cập nhật mô đun thất bại!", "Err");';
        }
        if ($GLOBALS['var']['deleted'] != 1) {
            echo 'makeDragOrder("' . $GLOBALS['var']['act'] . '");';
        }
        ?>
    });
</script>
<script src="assets/js/sortable.min.js"></script>
<script src="assets/js/atckey/left_navigation_modules.js"></script>
--}}
