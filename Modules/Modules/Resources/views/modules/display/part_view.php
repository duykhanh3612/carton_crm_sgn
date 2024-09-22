<style>
	.bgcolor {
		background-color: #aaaaaa !important;
	}
	.header-shipmment {
		padding: 2px;
		text-align: center;
		background: #616161 !important;
		color: white;
		font-size: 12px;
	}
	.Shipment .shipment-item {
		background-color: #fff;
		line-height: 25px;
		min-height: 30px;
		padding: 2px 5px;
	}
	.td-2 {
		width: 100%;
		padding-left: 5px;
	}
	.td-2:first-child {
		padding: 0;
	}
	.d-flex {
		display: flex;
	}
	.thft {
		margin-left: 3px;
	}
	.thft-line_2 input {
		background-color: #aaaaaa;
	}
	.thft-line_2 input::-webkit-input-placeholder {
		color: #000;
	}
	.thft-line_2 input:-ms-input-placeholder {
		color: #000;
	}
	.thft-line_2 input::placeholder {
		color: #000;
	}
</style>
<div id="itemList" class="margin-itemlist-po" data-shipped="<?= $info['NumberOfShipment'] ?>">
	<table class="mainTable_handle table table-hover table-part" width="100%">
		<?php if ($showFilter) : ?>
			<thead>
				<form method="get" action="#">
					<tr class="filter-head">
						<th colspan="<?= count((array)$cols->line_1) + 1; ?>">
							<div class="d-flex">
								<button type="submit" class="btn btn-danger">Filter</button>
								<?php
								foreach ($cols as $key => $col) {
									foreach ($col as $c) {
										echo col_filter_v2($c, $key, $this->input->get('filter', true), $key == 'Status' ? $status : false);
									}
								}
								?>
							</div>
						</th>
					</tr>
				</form>
			</thead>
		<?php endif ?>
		<tbody>
			<tr class="nodrop">
				<th width="1%">No</th>
				<?php
				foreach ($cols->line_1 as $col) {
					echo col_name($col);
				}
				?>
			</tr>
		</tbody>
		<tbody>
			<?php
			if (is_array($rows) && count($rows)) {
				$i = 1;
				foreach ($rows as $row) {
					$warning_usd_rate = $row['USDExchangeRate'] != $GLOBALS['cfg']['usd_exchange_rate'] && in_array($row['Status'], array(0));
					foreach ($cols as $line => $col) {
			?>
						<tr class="highlight <?= $line == 'line_2' ? 'Shipment' : '' ?>" id="<?php echo $row['id'] ?>" name="<?php echo $row['code'] ?>">
							<?php if ($line == 'line_1') { ?><td><?= stt($row['id'], $rowstart + $i++) ?></td> <?php } ?>
							<?php if ($line == 'line_2') { ?>
								<td class="bgcolor" colspan="<?= count((array)$cols->line_1) + 1; ?>">
									<div class="d-flex">
									<?php } ?>
									<?php
									foreach ($col as $key => $c) {
										if ($key == 'Image') {
											if (isset($row['Image'])) {
												$img_type = str_split($row['Image'], 2)[0];
												if ($row['Image'] && $row['Image'] != '-' && file_exists(PRO . 'thumbs/' . $row['Image']) && $img_type != '//') {
													$val = '<img src="' . PRO . 'thumbs/' . $row['Image'] . '" height="27px" width="auto">';
												} else if ($row['Image'] && $row['Image'] != '-' && $img_type == '//') {
													$val = '<img src="' . $row['Image'] . '" height="27px" width="auto">';
												} else if ($row['Image'] == '-') {
													$val = '<img src="" height="27px" width="auto">';
												} else {
													$val = '<img src="' . $row['Image'] . '" height="27px" width="auto">';
												}
											} else {
												$val = '';
											}
											$link = current_url() . '/update/' . $row['id'] . $uri_str . ($warning_usd_rate ? ($uri_str ? '&' : '?') . 'warning_usd_rate=1' : ($row['Status'] == 26 && $GLOBALS['user']['level'] == 3 ? '" class="disabled"' : ''));
										} else if (in_array($key, array('SalesmanID', 'petitioner', 'product_marketing', 'Fae'))) {
											$val = $row[$key] . ' - ' . get_name_staff($row[$key]);
										} else if ($key == 'RelateTo') {
											$relatedID = explode(',', $row['RelateTo']);
											$col_field = '';
											foreach ($relatedID as $k => $staff_id) {
												$val_show = $staff_id . ' - ' . get_name_staff($staff_id);
												$had_comma = ($k != 0) ? ", " : "";
												$col_field .= $had_comma . $val_show;
											}
											$val = $col_field;
										} else if ($key == 'Status') {
											$val = '<span style="text-align: center; color: #ffffff; border-radius: 4px; padding: 2px; background-color: ' . $status_color[$row[$key]] . ';" title="' . $status[$row[$key]] . '">' . $status[$row[$key]] . '</span>';
										} else if ($key == 'signed') {
											if (!empty($row['signed'])) {
												$val = '<span class="bs-label status_approve ' . $row['signed'] . '"> ' . $row['signed'] . '</span>';
											} else {
												$val = '<span class="bs-label" style="width: -webkit-fill-available;background:#f70202">Pending</span>';
											}
										} else if ($key == 'approve_status') {
											$val = '<span style="text-align: center; color: #ffffff; border-radius: 4px; padding: 2px; background-color: ' . $approve_status_color[$row[$key]] . ';" title="' . $approve_status[$row[$key]] . '">' . $approve_status[$row[$key]] . '</span>';
										} else if ($key == 'CustomerID') {
											$val = $row[$key] . ' - ' . get_field_by_id($row[$key], 'CompanyNameLo', 'customers');
										} else if ($key == 'follow_update') {
											$fu_text = 'Non-Update';
											$fu_color = 'red';
											if ($row[$key] == 1) {
												$fu_text = 'Update';
												$fu_color = 'green';
											}
											$val = '<span style="text-align: center; color: #ffffff; border-radius: 4px; padding: 2px; background-color: ' . $fu_color . ';">' . $fu_text . '</span>';
										} else if ($key == 'follower') {
											$val = $row[$key] . ' - ' . get_name_staff($row[$key]);
											if ($row[$key] == 0) {
												$val = '';
											}
											$link = current_url() . '/update/' . $row['id'] . $uri_str . ($warning_usd_rate ? ($uri_str ? '&' : '?') . 'warning_usd_rate=1' : ($row['Status'] == 26 && $GLOBALS['user']['level'] == 3 ? '" class="disabled"' : ''));
										} else if ($key == 'follow_type') {
											$val = $row[$key];
										} else if ($key == 'Project') {
											$val = $row[$key] . ' - ' . get_field_by_id($row[$key], 'ProjectName', 'projects_customer');
										} else if ($key == 'Stage') {
											$stage = $row[$key] . ' - ' . @$StageOfProject[$row[$key]];
											$val = $stage;
										} else {
											$val = isset($row[$key]) ? $row[$key] : '';
											$link = current_url() . '/update/' . $row['id'] . $uri_str . ($warning_usd_rate ? ($uri_str ? '&' : '?') . 'warning_usd_rate=1' : ($row['Status'] == 26 && $GLOBALS['user']['level'] == 3 ? '" class="disabled"' : ''));
										}
										if ($line == 'line_1') {
											echo col_val($c, $key, $val, $row['id'], $link);
										} else {
											echo col_val_v2($c, $key, $val, $row['id'], $link);
										}
									}
									?>
									<?php if ($line == 'line_2') { ?>
									</div>
								</td>
							<?php } ?>
						</tr>
			<?php
					}
				}
			} else {
				echo no_data_mes(count((array)$cols) + 3);
			}
			?>
		<tbody>
	</table>
</div>