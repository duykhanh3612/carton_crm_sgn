<div class="form-group {{  $ctrl->width}} ">
    <label>
        {{        $ctrl->title }} @if        (@$ctrl->validate==1)
          <span style="color:#ff0000">(*)</span>@endif
    </label>
    <div class="">
        <input type="text" class="form-control {{@$ctrl->validate==1?'validation':''}}  {{ @$ctrl->needed==1?'needed':''}}   title<?=$lang?>" {{@$ctrl->read==1?"readonly":""}} name="{{@$ctrl->name.$lang}}" id="<?=@$ctrl->name.$lang?>"   value="<?=@$row->{$ctrl->value.$lang}?>" placeholder="{{$ctrl->note}}" />
        <ul class="parsley-errors-list">
        </ul>
    </div>

    <script>
     @if($ctrl->att_table!='')

        $( document ).ready(function() {
	        $('{{"#".implode(", #",explode(",", $ctrl->att_table))}}').keyup(function(){
                var arr_value = [];
                @foreach(explode(",", $ctrl->att_table) as $t)
                var val_{{$t}} = $('#{{    $t}}').val() + ($('#{{$t}}').attr('data-note')!=null?$('#{{$t}}').attr('data-note'):'') ;
                if(val_{{$t}}!='')arr_value.push(val_{{$t}});
                @endforeach
                $("#{{@$ctrl->name.$lang}}").val( arr_value.join('-'));
            });
        });


    @endif
    </script>
</div>
