<div class="form-group {{$ctrl->width}}">
    <label>
        {{ $ctrl->title }} @if(@$ctrl->validate==1)
        <span style="color:#ff0000">(*)</span>@endif
    </label>
    <div class="">
        <input type="text" class="form-control {{ @$ctrl->validate==1?'validation':''}}  money_<?=@$ctrl->name.$lang?> title<?=$lang?>" id="<?=@$ctrl->name.$lang?>" {{@$ctrl->read==1?"readonly":'name='.@$ctrl->name.$lang}}  value="<?=@$row->{$ctrl->value.$lang}?>" data-type="number" autocomplete="off"  data-note="{{$ctrl->att_table}}"  />
        <ul class="parsley-errors-list" id="parsley-id-4995">
            <?=@$ctrl->note?>
        </ul>
    </div>
    <script>
          function setInputFilter(textbox, inputFilter) {
          ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
            textbox.addEventListener(event, function() {
              if (inputFilter(this.value)) {
                this.oldValue = this.value;
                this.oldSelectionStart = this.selectionStart;
                this.oldSelectionEnd = this.selectionEnd;
              } else if (this.hasOwnProperty("oldValue")) {
                this.value = this.oldValue;
                this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
              }
            });
          });
        }
          setInputFilter(document.getElementById("<?=@$ctrl->name.$lang?>"), function (value) {
              return /^\d*\.?\d*$/.test(value);
              //return /^-?\d*[.,]?\d{0,2}$/.test(value);
          });
    </script>
</div>