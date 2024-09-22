<?php 		//Mask

switch(@$ctrl->mask){
	default:?>
<td>
    <center class="cl">
    @if (@$row->{$ctrl->att_where}!='')
        <a class="roadtrips" data-href="<?=$image_path.@$row->{$ctrl->att_where} ?>" data-id="{{$row->{$func->field_id} }}" target="_blank">
            <img src="<?=$image_path.'/'.@$row->{$ctrl->att_where} ?>" style="width:50px;height:40px;" />
        </a>
    @else
        <a href="<?=$path_base.@$conf->logo ?> " target="_blank">
            <img src="<?=$path_base.@$conf->logo ?>" style="width:50px;height:40px;" />
        </a>
    @endif
  
    </center>

    <script>
            var form_data = new FormData();
            form_data.append("_token", '{{ csrf_token() }}');
            form_data.append("id", '{{$row->{$func->field_id} }}');

            $.ajax({
                url: "{{url('admin/'.request()->segment(2).'/simple_field_gallery_base_path')}}",
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'POST',
                success: function (data) {
   

                }
            });
    </script>
</td>
<?php break;
}?>
