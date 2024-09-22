<?php 		  	//Mask
   switch(@$ctrl->mask){

   default:?>
<div class="form-group">
    <label>
        <?=$ctrl->title?>
    </label>
    <div class="fileinput fileinput-new" data-provides="fileinput">
        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
          @php
          $path_parts = @pathinfo($path_base.@$row->{$ctrl->value});
          $type = @$path_parts['extension'];
          @endphp

          @if($type=='mp4' || @$type=='avi')
            <video src="{{       url($path_base.@$row->{$ctrl->value}) }}" style="width:100%" width="100%" autoplay></video>

            @elseif($type=='pdf' || @$type=='doc' || @$type=='docx' || @$type=='zip' || @$type=='rar' || @$type=='jpg')
            <a href="{{url($image_path.@$row->{$ctrl->value}) }}" target="_blank">
                <img data src="{{env_host}}/public/plugin/assets/img/files/{{@$type}}.png" style="height:48px" data-type="file" />
				<br/>
				<small>{{$path_parts['filename']}} | {{h::get_file_size($path_base.'/'.$func->path_upload.'/'.@$row->{$ctrl->value}) }}</small>
            </a>
            @else
            <img data src="{{env_host}}/public/plugin/assets/img/files/file_fail.png" alt="..." style="height:48px" />
            @endif

        </div>
        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
        <div>
            <span class="btn btn-default btn-file">
                <span class="fileinput-new">Tải lên</span>
                <span class="fileinput-exists">Tải lên</span>
                <input type="file" name="{{ $ctrl->name }}" />
            </span>
            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Xóa</a>
        </div>
    </div>
</div>



<?php break; }?>
