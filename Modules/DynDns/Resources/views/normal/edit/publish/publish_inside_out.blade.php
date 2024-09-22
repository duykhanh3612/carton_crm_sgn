<div class="form-group {{$ctrl->width}}">
    <label ><?=$ctrl->title?> @if(@$ctrl->validate==1) <span style="color:#ff0000">(*)</span> @endif</label>
    <div>
        <!-- Rounded switch -->
        <label class="switch">
        <input type="checkbox" <?=@$row->{$ctrl->value}=='1' ?'checked':''?> value="1"  id="pub_<?=$ctrl->name?>" />
        <span class="slider round"></span>
        </label>
        <input type="hidden" value="{{ strval(@$row->{$ctrl->value})===''?0:@$row->{$ctrl->value} }}"  name="<?=$ctrl->name?>" id="<?=$ctrl->name?>" />
        <script>
             $('#pub_{{$ctrl->name}}').on("change",function(){
                let checked = $(this).prop('checked');
                if(checked==true){
                    $('#{{$ctrl->name}}').val('1');
                }
                else{
                    $('#{{$ctrl->name}}').val('0');
                }
             });
        </script>
    </div>
    <style type="text/css">
    /* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}
/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}
/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}
.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}
input:checked + .slider {
  background-color: #2196F3;
}
input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}
input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}
/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}
.slider.round:before {
  border-radius: 50%;
}
</style>
</div>
