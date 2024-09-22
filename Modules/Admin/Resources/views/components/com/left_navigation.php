<section id="left_navigation" class="navbar-collapse">
	<style>
		.remove {
			display: none;
		}
        #sidebar{
            position: absolute;
            top: 10rem;
        }
        #sidebar{
            display:none!important;
        }
        #fake-close-sidebar{
            z-index: 1012;
            font-size: 3rem;
            color: #fff;
            background:#0093d9;
            position: fixed;
            left: 0.5rem;
        }
        #close-sidebar{
            display:none!important;
        }

	</style>
	<div class="nav-group-button">
		<?php
            if ($GLOBALS['user']['level'] == 1 || $GLOBALS['user']['level'] == 2 || $GLOBALS['per']['full']){ ?>
			<div style="font-size: 9px" class="btn btn-border btn-alt border-yellow font-yellow" id="showeditNav">
				<i class="glyph-icon icon-edit"></i>
			</div>
			<div title="create new group" class="btn btn-border btn-alt border-green font-green" data-toggle="modal" data-target="#newItem">
				<i class="glyph-icon icon-plus-circle"></i>
			</div>
		<?php } ?>
	</div>

	<div class="wapper-category" data-max="<?=$rows['max']?>">
		<?php foreach($rows['parents'] as $key=>$value){?>
			<div class="group-category" data-group="<?=$value['id']?>">
				<div class="filter">
					<i class="glyph-icon icon-edit edit-filter-cate" style="padding-right: 5px" data-target="#modalEdit" data-toggle="modal"></i>
					<span><?=$value['name_vn']?></span>
					<i title="create new item" class="btn-alt font-green btn-group-category pull-right glyph-icon icon-plus-circle" data-toggle="modal" data-target="#newItem"></i>
				</div>
				<?php foreach($rows['child'] as $v){?>
					<?php if($v['parent'] == $value['id']){?>
						<div class="item" data-item="<?=$v['id']?>" data-url="<?= $v['url']?>" data-link="<?= site_url( $v['url'])?>" data-sort_order="<?=$v['sort_order']?>" data-parent="<?=$v['parent']?>">
							<i class="glyph-icon icon-edit edit-item-cate" style="padding-right: 5px" data-target="#modalEdit" data-toggle="modal"></i>
							<span class="<?=@$v['actived'] ? 'activeLeft' : ''?>"><?=$v['name_vn']?></span>
							<span class="badge pull-right number_count"><?=$v['brief']?></span>
						</div>
                    <?php } ?>
                <?php } ?>
			</div>
		<?php } ?>
	</div>
</section>

<div class="modal fade my-modal" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm">
        <form>
            <input type="hidden" name="row"/>
            <div class="modal-content">
                <div class="modal-title text-center" style="padding: 1rem;background: #0099cc;color: white;margin-bottom: 1rem;">
                    Edit Form
                </div>
                <div class="modal-body" style="max-height: 798px; overflow-y: auto;">
                    <div class="form-group">
                        <div class="col-sm-12">Old name</div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="text" class="form-control" disabled name="old_name" id="old_name">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">New name <span style="color:red">*</span></div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="text" class="form-control" data-required="1" autocomplete="off" name="new_name" id="new_name">
                            <div class="errordiv new_name">
                                <div class="arrow"></div>New name is empty
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt btn-danger btn-hover" data-bs-dismiss="modal"><span>Delete</span><i class="glyph-icon icon-remove"></i></button>
                    <button type="submit" class="btn btn-alt btn-success btn-hover" data-bs-dismiss="modal"><span>Update</span><i class="glyph-icon icon-check"></i></button>
                    <button type="button" class="btn btn-alt btn-hover" data-bs-dismiss="modal"><span>Cancel</span><i class="glyph-icon icon-arrow-left"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="modal fade" id="newItem" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="border-top: 5px solid #0099cc;">
                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">New Title</h4>
            </div>
            <div class="modal-body" style="padding: 15px;">
                <div class="form-group">
                    <div class="col-sm-2 control-label">Name</div>
                    <div class="col-sm-10">
                        <input type="text"  id="item_name" class="form-control" value="" autocomplete="off">
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"  data-bs-dismiss="modal" id="addNewtitleNav">Add</button>
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script src="assets/js/drag_left_navigation_menu.js?ver=150620222"></script>
<script src="assets/js/atckey/left_navigation_fuction.js?ver=05082021"></script>
