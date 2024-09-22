
<script type="text/javascript">
				function openKCFinder(textarea) {
					window.KCFinder = {
						callBackMultiple: function(files) {
							window.KCFinder = null;
							//textarea.value = "";
							for (var i = 0; i < files.length; i++)
							{
								var img = "<img src='" + files[0] + "' />";
								//$('.featured_photo').html(img);
	            				document.getElementById('featured_photo_'+textarea).innerHTML  = img;
							 	document.getElementById(textarea).value = files[i];
							}
						}
					};
					window.open('<?=_media?>/admin/_template3/js/kcfinder/browse.php?type=images&dir=files/public',
						'kcfinder_multiple', 'status=0, toolbar=0, location=0, menubar=0, ' +
						'directories=0, resizable=1, scrollbars=0, width=800, height=600'
					);
				}
				function delimage(textarea)
				{
					document.getElementById('featured_photo_'+textarea).innerHTML  = "";
					document.getElementById(textarea).value = "";
				}
</script>
<div class="portlet-content">
    <div class="featured_photo" id="featured_photo_<?=$ctrl->name?>">
        <?php if(@$row[$ctrl->value]!=''):?>
        <img src="<?=@$row[$ctrl->value]?>" alt="" />
        <?php else:?>
        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
        <?php endif?>
    </div>
    <div>
        <a href="javascript:openKCFinder('<?=$ctrl->name?>')">Tải lên</a>
        <a href="javascript:delimage('<?=$ctrl->name?>')">Tháo xuống</a>

        <input name="<?=$ctrl->name?>" id="<?=$ctrl->name?>" value="<?=@$row[$ctrl->value]?>" type="hidden" />
    </div>
</div>