
<td data-title="image_base_path">
    <center>
        @if(@$row->{$ctrl->value}!='')
        <a href="<?=@$image_path.'/'.$func->path_upload.'/'.@$row->{$ctrl->value} ?> " data-lightbox="roadtrip" data-title="{{@$ctrl->att_table==''?'':@$row->{@$ctrl->att_table} }}" target="_blank">
            <img src="<?=@$image_path.'/'.$func->path_upload.'/'.@$row->{$ctrl->value} ?>" style="height:150px;" />
        </a>
        @else
        <a href="<?=@$image_path.@$conf->logo ?> " data-lightbox="roadtrip" data-title="" target="_blank">
            <img src="<?=@$image_path.@$conf->logo ?>" style="height:150px;" />
        </a>
        @endif
    </center>
</td>
