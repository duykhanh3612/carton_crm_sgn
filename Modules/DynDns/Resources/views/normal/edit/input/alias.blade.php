
<div class="form-group {{  $ctrl->width}}">
    <label>
        <?=$ctrl->title?>
    </label>
    <div class="">
        <input type="text" class="form-control alias<?=$lang?>" name="<?=$ctrl->name.$lang?>" value="<?=@$row->{$ctrl->value.$lang}?>" />

        <ul class="parsley-errors-list" id="parsley-id-4995">
            Nhập tiêu đề trước khi nhập alias. Alias cách nhau bởi dấu - vd: abc-xyz
        </ul>
        <script>
           $('#{{$ctrl->att_table.$lang}}').on('change', function () {
               $.get("{{ url(request()->segment(1).'/'.request()->segment(2).'/alias') }}",{'field':'<?=$ctrl->name.$lang?>','title':$(this).val(),'lang':'<?=$lang?>','id':$("#id").val()},function(msg){
                   $('.alias<?=$lang?>').val(msg);
               });

          });
        </script>
    </div>
</div>
