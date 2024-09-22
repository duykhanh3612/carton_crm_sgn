<?php
$string =$ctrl->att_table;
$finalArray = array();
$asArr = explode( ',', $string );
foreach( $asArr as $val ){
    $tmp = explode('=>', $val );
    $finalArray[ $tmp[0] ] = $tmp[1];
}


$str_note =$ctrl->note;
$arr_note = array();
$arr_note_ex = explode(';', $str_note );
foreach( $arr_note_ex as $val ){
    $tmp = explode('=>', $val );
    $arr_note[@$tmp[0]] = @$tmp[1];
}
?>
<div class="form-group">
   
    <div>
        @if(@$per->pedit==1)
        <span style="float:left">
            <a class="btn green  publish_dark_light publish" style="width:150px; {{@$row->{$ctrl->value}==1?'display:block':'display:none'}}">
                <i class="fa fa-check inline" style="color:#fff"></i>{{ $finalArray[1] }}
            </a>

            <a class="btn  black publish_dark_light unpublish" style="width:150px;  {{@$row->{$ctrl->value}==0?'display:block':'display:none'}}">
                <i class="fa fa-remove  inline" style="color:#fff"></i>{{$finalArray[0] }}
            </a>

        </span>

        <ul style="padding-left:5px;float:left;">
            <small style="color:blue">
                <em class="unpublish" style="{{@$row->{$ctrl->value}==0?'display:block':'display:none'}}">
                    <?=@$arr_note[1]?>
                </em>
                <em class="publish" style="{{@$row->{$ctrl->value}==1?'display:block':'display:none'}}">
                    <?=@$arr_note[0]?>
                </em>
            </small>

        </ul>

        <input type="hidden" class="form-control" id="<?=@$ctrl->name?>" name="<?=@$ctrl->name?>" value="{{@$row->{$ctrl->value} }}" />
        <script>
            $('.publish_dark_light').on('click', function () {
                if($(this).hasClass('publish'))
                {
                    //$(this).hide();
                    $('.publish').hide();
                    $('.unpublish').show();
                      $("#<?=@$ctrl->name?>").val('0');
                }
                else {
                    // $(this).hide();
                    $('.unpublish').hide();
                    $('.publish').show();
                      $("#<?=@$ctrl->name?>").val('1');
                }
            });

        </script>
        @else
        <label >
            <?=$ctrl->title?>
        </label>
        <div>
            <label class="form-control">
                {{@$finalArray[$row->{$ctrl->value}]}}
            </label>
            
        </div>
        
        @endif
    </div>
</div>