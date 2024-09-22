{!! Themes::modules('header', $module) !!}
<style>

    #sidebar {
        position: absolute;
        top: 10rem;
    }

    #page-title h2 {
        position: fixed;
        left: 2rem;
        font-size: 20px;
        letter-spacing: 3px;
        color: #0093d9;
    }

    #sidebar {
        height: 100vh;
    }

    #nestable {
        margin-left: 1rem;
    }

    #fake-close-sidebar {
        z-index: 1012;
        font-size: 3rem;
        color: #fff;
        background: #0093d9;
        position: fixed;
        left: 0.5rem;
    }

    /* .nav-group-button{
        width: 100%;
        background: #0093d9;
        height: 3.7rem;
    }
    .nav-group-button .btn{
        opacity:1;
        float: right;
        margin: 0.6rem 0.5rem 0.5rem 0;
    } */
    #sidebar {
        box-shadow: 0px 0px 3px 0px rgb(0 0 0 / 50%);
    }

    #sidebar .glyph-icon.icon-edit:hover {
        cursor: pointer;
    }

    /* .wapper-category .filter{
        background-color: grey;
        color: white;
        padding: 0.6rem 1rem;
        font-size: 1.4rem;
        font-weight: 700;
    } */
    .sortable-ghost {
        opacity: .5;
        background: #C8EBFB;
    }

    /* .wapper-category .badge{
        background:gray;
        height:15px;
        line-height: 16px;
    }
    .wapper-category i{
        display: none;
    }
    .wapper-category .item{
        background-color: white;
        padding: 0.5rem 1rem 0.5rem 2rem;
        border-bottom: 1px solid;
    }
    .wapper-category{
        display: block;
    } */
    #type_chosen .chosen-drop {
        position: fixed;
        top: 8.2rem;
        left: 12rem;
        width: 28.3%;
    }

    #group_name_chosen .chosen-drop {
        position: fixed;
        top: 8.9rem;
        left: 40.5rem;
        width: 28.3%;
    }

    #newItem .form-group {
        height: 3rem;
    }

    .btn-group-category {
        display: none;
        top: -0.5rem;
        right: -0.5rem;
    }

    .main_container {
        width: 100%;
        height: 97vh;
        overflow: auto;
    }

    #close-sidebar {
        display: none !important;
    }

    #sidebar {
        display: none !important;
    }

    /* #left_navigation .item{
        cursor:pointer;
    }
    #left_navigation{
        height: 104vh;
        overflow:hidden;
        width: 220px;
        background: #f1f1f1;
        position: absolute;
        left: 0;
        z-index: 10;
        transition: all 0.3s ease;
        z-index: 1;
        box-shadow: 0px 0px 5px 0px
    } */
</style>

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
                                @php $row = $row->toArray(); @endphp
                                <tr class="highlight" id="<?php echo $row['id'] ?>" name="<?php echo $row['name_vn'] ?>">
                                    <?php if ($GLOBALS['per']['del']) : ?>
                                        <td class="center"><?= sel_item($row['id'], !$GLOBALS['per']['del']) ?></td>
                                    <?php endif ?>

                                    <td class="center" width="1%"><?= stt($row['id'], $GLOBALS['var']['rowstart'] + $k + 1) ?></td>

                                    <?php foreach ($cols as $key => $col) : ?>
                                        <?= col_val($col, $key, @$row[$key], $row['id'], site_url($GLOBALS['var']['act'] . '/update/' . $row['id']) . $uri_str) ?>
                                    <?php endforeach ?>

                                    <td class="center d-flex gap-10" nowrap="nowrap">
                                        <?php if ($GLOBALS['per']['edit']) : ?>
                                            <?= edit_alink('', $url_update . '/' . $row['id'] . $uri_str) ?>
                                        <?php endif ?>
                                        <?php if ($GLOBALS['per']['del']) : ?>
                                            <?= del_restore_link($row['id'], $row['deleted']) ?>
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
