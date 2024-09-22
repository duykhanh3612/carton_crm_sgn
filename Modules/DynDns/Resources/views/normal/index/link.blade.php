<?php 		  	
switch(@$ctrl->mask){
    case 'ajax_popup':
        //echo sprintf('<td> <a href="'.h::site_url(h::area_admin.'/'. $ctrl->value.'/'.@$row->{$func->field_id}).'" target=_blank>%s</a></td',$ctrl->name);
?>
<td>
    <span type="button" class="btn modal_poup" data-url="{{h::site_url(h::area_admin.'/'. $ctrl->value.'/'.@$row->{$func->field_id})}}" data-target=".bs-example-modal-lg">{{@$ctrl->name}}</span>

</td>
<?php
        break;
    case 'link_button':
        echo sprintf('<td> <a href="'.h::site_url(h::area_admin.'/'. $ctrl->value.'/'.@$row->{$func->field_id}).'" class="btn blue"> %s </a></td>',$ctrl->name);
        break;
    default:
        echo sprintf('<td> <a href="'.h::site_url(h::area_admin.'/'. $ctrl->value.'/'.@$row->{$func->field_id}).'" target=_blank> %s </a></td>',$ctrl->name);
        break;
}
?>

