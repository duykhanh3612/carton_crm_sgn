@php
             $name_id = str_replace(array('[',']',"#"),array('','',''),@$ctrl->name.$lang);

@endphp

aaa

        <input type="text" class="form-control {{@$ctrl->validate==1?'validation':''}}  {{ @$ctrl->needed==1?'needed':''}}   <?=$lang?>" 
               {{@$ctrl->read==1?"readonly":"name=".@$ctrl->name.$lang}} id="<?=@$name_id?>"   value="<?=@$row->{$ctrl->value.$lang}?>" placeholder="{{$ctrl->att_table}}" />


