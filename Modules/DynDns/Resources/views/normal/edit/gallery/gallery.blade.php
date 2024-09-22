
<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all">
    <div class="portlet-header ui-widget-header">
        <span class="ui-icon ui-icon-circle-arrow-s"></span>Gallery
    </div>
    <div class="portlet-content">
        <a rel="vn" class="button upload-gallery">Thêm ảnh</a>
        <div class="clearfix"></div>
        <ul class="gallery_list gallery_plugin_list ui-sortable" id="gallery_vn_list" lang="">
            <?php $gallery = json_decode(@$row->{$ctrl->value});
                  if(@$gallery)
                      foreach($gallery as $ga):
            ?>
            <li>
                <div class="image">
                    <img src="<?=$ga->img?>" />
                </div>
                <div class="config">
                    <textarea placeholder="title" class="title">
                        <?=$ga->title?>
                    </textarea>
                    <textarea placeholder="tag" class="tag">
                        <?=$ga->tag?>
                    </textarea>
                    <textarea placeholder="alt" class="alt">
                        <?=$ga->alt?>
                    </textarea>
                    <textarea placeholder="w" class="width">
                        <?=$ga->width?>
                    </textarea>
                    <textarea placeholder="h" class="height">
                        <?=$ga->height?>
                    </textarea>
                    <textarea placeholder="http://" class="anchor">
                        <?=$ga->href?>
                    </textarea>
                </div>
                <a href="#" class="remove">X</a>
            </li>
            <?php endforeach?>
        </ul>
        <textarea id="<?=$ctrl->name?>" name="<?=$ctrl->name?>" style="visibility: hidden">
            <?=@$row->{$ctrl->value}?>
        </textarea>
    </div>
</div>
