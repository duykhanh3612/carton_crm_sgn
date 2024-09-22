<?php
$string =$ctrl->att_table;
$finalArray = array();

$asArr = explode( ',', $string );

foreach( $asArr as $val ){
    $tmp = explode('=>', $val );
    $finalArray[ $tmp[0] ] = $tmp[1];
}
?>
<td class="{{@$ctrl->mobile!=1?" hidden-xs-down":""}}">
    @if($per->plist=='1' && false)
    <a class="btn btn-sm blue link_button_modal{{$row->{$func->field_id} }}" title="{{$row->{$ctrl->value}==1?'Click để Hủy giao dịch':'Click để Xác nhận lại giao dịch'}}">
        <small>
            {{@$finalArray[$row->{$ctrl->value}]}}
        </small>
    </a>

    <script>
        $('.link_button_modal{{@$row->{$func->field_id} }}').click(function(){
            $('#link_button_modal{{@$row->{$func->field_id} }}').modal('show');
        });
    </script>
    <div id="link_button_modal{{$row->{$func->field_id} }}" class="modal fade" data-backdrop="true">
        <div class="modal-dialog" id="animate">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Xác nhận</h5>
                </div>
                <div class="modal-body text-center p-lg">
                    <p>
                        Bạn có muốn tiến hành tao tác này?
                        <br />
                        <strong></strong>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Không</button>
                    <a href="<?=h::site_url('admin/'.request()->segment(2))?>/pub/<?=$ctrl->value?>/<?=$row->{$func->field_id}?>?json=none" class="btn-yes btn danger p-x-md">Có</a>
                </div>
            </div><!-- /.modal-content -->
        </div>
    </div>
    @else
    {{@$finalArray[$row->{$ctrl->value}]}}
    @endif
</td>         