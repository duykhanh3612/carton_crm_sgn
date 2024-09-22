
<div class="form-group">
   <label>
      <?=$ctrl['title']?>
   </label>
   <div class="">
      <input type="password" class="form-control" onchange="accesspwd('<?=$ctrl["value"]?>',this.value)" />
      <input name="<?=$ctrl['name'].$lang?>" id="<?=$ctrl['name'].$lang?>" value="<?=@$row[$ctrl['value'].$lang]?>"  type="hidden" />

      <ul class="parsley-errors-list" id="parsley-id-4995">
         <?=@$ctrl['note']?>
      </ul>
      <script>
		function accesspwd(id,value)
		{
			$.get("<?=url("admin/ajax/hash")?>/"+value, function( data ) {
				$("#"+id).val(data);
			});
		}
      </script>
   </div>
</div>
