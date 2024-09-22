<td {{@$ctrl->mobile!=1?"class=hidden-xs-down":""}}>
    @php
     $string =$ctrl->att_table;
     $arr = explode( ',', $string );
    @endphp

  @if(@$row->{@$arr[0]}!='' && @$row->{@$arr[1]}!='')
  <small>{{@$row->{@$arr[0]} }}</i> x <i>{{@$row->{@$arr[1]} }}</i> = </small>
  @endif
  <b><?=@$row->{$ctrl->value}?></b>  <em>m<sup>2</em> </sup>
</td>
