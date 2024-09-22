<style>
    .remove {
        display: none;
    }
</style>
<div class="nav-group-button">
    <div class="container-close-sidebar">
        <a id="fake-close-sidebar" href="#" title="Close sidebar"><i class="fa fa-bars" aria-hidden="true"></i></a>
    </div>
</div>
<?php if(!empty($category_list)):?>
<div class="wapper-category">
    <?php foreach ($category_list as $k => $data) : ?>
        <?php $isActive = isset($cat) && $cat == $data['id'] ? true : false ?>
        <div class="item">
            <div class="tab-item <?= $isActive ? 'activeLeft' : "" ?>" data-menu="<?= $data['id'] ?>">
                <a href="<?= site_url('modules?cat=' . $data['id']) ?>"><?= $data['name_vn'] ?></a>
                <span class="badge pull-right number_count"><?= $data['brief'] ?></span>
            </div>
        </div>

    <?php endforeach ?>
</div>
<?php endif; ?>
