<form id="frm-options-columns" class="form-horizontal bordered-row" method="post" action="<?php echo site_url($action) ?>" target="_blank">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4 class="modal-title">Export Options</h4>
		<input type="hidden" name="rt" value="<?php echo $rowstart ?>">
	</div>
	<div class="modal-body pad10T pad10B" style="height: 300px; overflow: auto;">
		<div class="row">
			<fieldset>
				<legend>
					<div class="checkbox">
						<label>
							<input type="checkbox" value="">
							Check All
						</label>
					</div>
				</legend>
				<?php if (in_array($table, array('customers', 'customers_online'))): ?>
					<div class="checkbox limit_allpage">
						<label>
							<input type="checkbox" id="chk_allpage" name="limit_allpage" value="1">
							All page
						</label>
					</div>
				<?php endif ?>
				<?php
				// if (is_array($column) && count($column)) {
					foreach ($column as $key => $value) {
						?>
						<div class="col-sm-4">
							<div class="checkbox">
								<label>
									<input type="checkbox" name="column_select[<?php echo $key ?>]" class="option-column-select" value="<?php echo $value->name == '' ? $key : $value->name ?>">
									<?php echo $value->name == '' ? $key : $value->name ?>
								</label>
							</div>
						</div>
						<?php
					}
				// }
				?>
			</fieldset>
		</div>
	</div>
</div>
<div class="modal-footer">
	<button type="submit" class="btn btn-alt btn-border border-primary btn-hover font-primary" data-title="<?php echo $title ?>"><span><?php echo $title . ' file' ?></span><i class="glyph-icon icon-download"></i></button>
	<button type="button" class="btn btn-alt btn-border border-red btn-hover font-red" data-dismiss="modal"><span>Close</span><i class="glyph-icon icon-remove"></i></button>
</div>
</form>