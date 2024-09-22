<div class="modal fade" id="display-type" role="dialog">
	<div class="modal-dialog modal-lg shadow-lg">
		<form action="" id="frm-display-type" class="modal-content shadow-sm" data-type="<?= $display_type ?>" data-column="<?= $column ?>" data-name="<?= $name ?>">
			<div class="modal-header" style="border-top: 5px solid #0099cc;">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title text-center"><?= $title ?></h4>
			</div>
			<div class="modal-body" style="padding: 15px;">
				<?php
				if(empty($options))
				{
					$options = [
						'option_items'=>@$option_items??[],
						'display_type'=>@$display_type,
						'display_table'=>@$display_table ,
						'display_type_value'=>@$display_type_value
					];
				}
				?>
				<?= !empty($view) ? load_view_module($view, $options , false) : '' ?>

				<div class="form-group group-empty-value">
					<div class="row">
						<div class="form-group col-sm-12 control-label">Empty value</div>
						<div class="text-center col-sm-1">
							<input <?= !empty($display_type_value['empty']) ? 'checked' : ''  ?> style="margin-top: 8px;" value="<?= !empty($display_type_value['empty']) ? '1' : '0'  ?>" class="checkbox-empty-value mt-1" type="checkbox" name="empty">
						</div>
						<div class="col-sm-3">
							<input value="<?= !empty($display_type_value['empty_key']) ? $display_type_value['empty_key'] : '' ?>" name="empty_key" type="text" <?=  !empty($display_type_value['empty']) ? '' : 'readonly' ?> class="form-control input-empty" aria-label="Empty key with checkbox" placeholder="Empty key">
						</div>
						<div class="col-sm-8">
							<input value="<?= !empty($display_type_value['empty_value']) ? $display_type_value['empty_value'] : '' ?>" name="empty_value" type="text" <?=  !empty($display_type_value['empty']) ? '' : 'readonly' ?> class="form-control input-empty" aria-label="Empty value with checkbox" placeholder="Empty value">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-sm-12 control-label mrg5B">Update In Site</div>
						<div class="text-center col-sm-1">
							<input style="display: inline;" <?= !empty($display_type_value['update_in_site']) ? 'checked' : ''  ?> id="only" type="checkbox" class="form-control" name="update_in_site" value="<?= @$display_type_value['update_in_site'] ?? 0 ?>">
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary btn-save-setting">Submit</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</form>
	</div>
</div>
