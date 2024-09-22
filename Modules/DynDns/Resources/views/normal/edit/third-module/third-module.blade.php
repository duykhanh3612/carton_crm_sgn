  <?php 		  	//Mask

  switch($func->upload_type){
      case "cloud":
          $image_path = env('Static').'/'.$path_base;
          break;
      default:
          $image_path = url($path_base);
          break;
  }

	switch(@$ctrl->mask){
        case 'basket':
            $rows = find_all("",$ctrl['att_table'],"*");
?>
<div class="form-field">
    <label class="desc"><?=$ctrl['title']?> </label>
    <small><?=@$ctrl['note']?></small>	  
    
     
    <table class="table table-bordered" id="cartContentsDisplay" width="100%" cellspacing="0" cellpadding="0" border="0">
        <tbody>
            <tr class="tableHeading">
                <th></th>
                <th scope="col" id="scProductsHeading">
                    <?=lang('sanpham')?>
                </th>
                <th scope="col" id="scUnitHeading">
                    <?=lang('gia')?>
                </th>
                <th scope="col" id="scQuantityHeading"><?=lang('soluong')?></th>
                <th scope="col" id="scTotalHeading"><?=lang('giatien')?></th>
            </tr>
            <!-- Loop through all products /-->
            <?php if(@$rows):
                      $i=0; ?>
            <?php foreach(@$rows as $r):
                      $i++;?>

            <tr class="rowEven">
                <td>
                    <?=img($r["image"],'100px','100px')?>
                </td>
                <td valign="middle" style="vertical-align:middle">
                    <?=$r['title']?>
                </td>
                <td class="cartUnitDisplay price" valign="middle" style="vertical-align:middle">
                    <?=number($r['price'])?>
                </td>
                <td class="cartQuantity" valign="middle" style="vertical-align:middle">
                    <span class="alert bold"></span><?=$r['sl']?>
                </td>
                <td class="cartTotalDisplay" valign="middle" style="vertical-align:middle">
                    <?=number($r['price']*$r['sl'])?>
                </td>
            </tr>
            <?php endforeach;
                  endif ?>

            <!-- Finished loop through all products /-->
        </tbody>
    </table>
</div>
<?php
            break;
        case 'member':

            echo view("admin::sys.template.normal.edit.third-module.member",array('ctrl'=>$ctrl,'row'=>$row,'path_base'=>$image_path));
            break;
        case 'smtp':
            echo view("admin::sys.template.normal.edit.third-module.smtp",array('ctrl'=>$ctrl,'row'=>$row,'path_base'=>$image_path));
            break;
        case 'open_cart':
            echo view("admin::sys.template.normal.edit.third-module.open_cart",array('ctrl'=>$ctrl,'row'=>$row,'path_base'=>$image_path));
            break;
}?>
