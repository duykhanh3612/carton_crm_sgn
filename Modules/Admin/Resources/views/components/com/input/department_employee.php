<component class="department_employee" >
    <input type="hidden" name="<?=$name?>" id="<?=@$component_id!=""?$component_id:$name?>" value="<?=$value?>" <?= @$required ? 'data-required="1"' : ''?> />
    <div class="dropdown <?=$class?>">
        <span class="title<?=!isset($multiple)?' dropdown':''?>"  <?=!isset($multiple)?'data-toggle="dropdown"':''?>></span>
        <label class="dropdown"  data-toggle="dropdown"><span class="caret"></span></label>
        <ul class="dropdown-menu" data-id="#<?=$component_id!=""?$component_id:$name?>" <?=@$multiple?>>
            <div class="filter">
                <input class="form-control keyword" type="text" placeholder="Search..">
                <span class="caret filter-show-data"></span>
                <span class="fa fa-times filter-show-data-cancel"></span>
            </div>
        </ul>
    </div>
</component>