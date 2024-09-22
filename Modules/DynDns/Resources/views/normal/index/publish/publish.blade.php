
<td align="center" style="width:90px;" {{ @$ctrl->mobile!=1?"class=hidden-xs-down":"" }}>
    <?php switch(@$ctrl->mask){
              case 'publish_custom':?>
    <i class="{{$ctrl->att_table}}" style="cursor: pointer; <?=@$row->{$ctrl->value}==1?'color:red':'color:black !important'?>" val="<?=intval(@$row->{$ctrl->value})?>" data-status="<?=h::site_url('admin/'.request()->segment(2))?>/pub/<?=$ctrl->value?>/<?=$row->{$func->field_id}?>"
        data-row="<?=$row->{$func->field_id}?>"></i>

    <?php break;
              case 'publish_light_dark':?>
    <button val="<?=intval(@$row->{$ctrl->value})?>" class="btgrid  {{@$ctrl->att_where}} <?=intval(@$row->{$ctrl->value})==1?'publish':'unpublish'?>"
        data-status="<?=h::site_url('admin/'.request()->segment(2))?>/pub/<?=$ctrl->value?>/<?=$row->{$func->field_id}?>"
        data-row="<?=$row->{$func->field_id}?>" type="button">
        {!!                  @$ctrl->att_style !!}
    </button>

    <style type="text/css">
        .unpublish {
            background-color:#808080 !important;
        }

    </style>
    <?php break;
              case 'publish_light_dark_button_per':
                    $string =$ctrl->att_table;
                    $finalArray = array();
                    $asArr = explode( ',', $string );
                    foreach( $asArr as $val ){
                        $tmp = explode('=>', $val );
                        $finalArray[ $tmp[0] ] = $tmp[1];
                    }
    ?>


    <input val="<?=intval(@$row->{$ctrl->value})?>" class="btgrid <?=intval(@$row->{$ctrl->value})==1?'publish':'unpublish'?>"
       {{$per->plist=='1'?'data-status='.h::site_url('admin/'.request()->segment(2)).'/pub/'.$ctrl->value.'/'.$row->{$func->field_id}:''}}
       {{$per->plist=='1'?'data-row='.$row->{$func->field_id}:''}}  type="button" />

    <style type="text/css">
        .btgrid {

            {{$per->plist=='1'?'cursor: pointer;':'cursor:default !important;'}}
            display: inline-block ;
            height: 24px;
            margin: 1px;
            width: 24px;
        }

        .unpublish {
            background: rgba(0, 0, 0, 0) url("{{env_host}}/public/admin/assets/images/unpublish.png") no-repeat scroll 0 0;
            background-size: 24px 24px;
            border: 0 none;
        }

        .publish {
            background: rgba(0, 0, 0, 0) url("{{env_host}}/public/admin/assets/images/publish.png") no-repeat scroll 0 0;
            background-size: 24px 24px;
            border: 0 none;
        }
    </style>

    <?php break;
              case 'publish_light_dark_buttons':

                    $string =$ctrl->att_table;
                    $finalArray = array();

                    $asArr = explode( ',', $string );

                    foreach( $asArr as $val ){
                        $tmp = explode('=>', $val );
                        $finalArray[ $tmp[0] ] = $tmp[1];
                    }
    ?>

    <a class="btn black publish_dark_light " style="width:150px; {{@$row->{$ctrl->value}==0?'display:block':'display:none'}}">
        <i class="fa fa-check inline" style="color:#fff"></i>{{ @$finalArray[0] }}
    </a>

    <a class="btn green publish_dark_light " style="width:150px;  {{@$row->{$ctrl->value}==1?'display:block':'display:none'}}">
        <i class="fa fa-check inline" style="color:#fff"></i>{{ @$finalArray[1] }}
    </a>

    <?php break;
              default:?>
    <input val="<?=intval(@$row->{$ctrl->value})?>" class="btgrid <?=intval(@$row->{$ctrl->value})==1?'publish':'unpublish'?>"
        data-status="<?=h::site_url('admin/'.request()->segment(2))?>/pub/<?=$ctrl->value?>/<?=$row->{$func->field_id}?>"
        data-row="<?=$row->{$func->field_id}?>" type="button" />

    <style type="text/css">
        .btgrid {
            cursor: pointer;
            display: inline-block;
            height: 24px;
            margin: 1px;
            width: 24px;
        }
        .unpublish {
            background: rgba(0, 0, 0, 0) url("{{ env_host}}public/dashboard/assets/img/unpublish.png") no-repeat scroll 0 0;
            background-size: 24px 24px;
            border: 0 none;
        }
        .publish {
            background: rgba(0, 0, 0, 0) url("{{ env_host}}public/dashboard//assets/img/publish.png") no-repeat scroll 0 0;
            background-size: 24px 24px;
            border: 0 none;
        }
    </style>

    <?php break;
          }?>


</td>
