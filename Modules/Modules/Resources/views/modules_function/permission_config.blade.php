<table class="table table-drag" id="permission_config">
    <thead>
        <tr>
            <th>#</th>
            <th>Field</th>
            <th>Operators</th>
            <th>Type</th>
            <th>Value</th>
            <th>Condition</th>
            <th><button class="add_rule btn btn-primary" type="button">Add rule</button></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $permission_config = json_decode($info['permission_config'],true);
        if(!empty($permission_config))
        foreach($permission_config as $per_id=>$rule):?>

            <tr class="myDragClass">
                <th><span ><?=@++$rule_No?></span></th>
                <th>
                    <select name="permission_config[<?=$per_id?>][field]" class="form-control float-left rule-type is-valid" >
                        <?php foreach ($fields as $key => $field) : ?>
                        <option value="<?= $key ?>" <?=$rule['field']==$key?'selected':''?>><?= @$field->name ?></option>
                        <?php endforeach ?>
                    </select>
                </th>
                <th>
                    <select name="permission_config[<?=$per_id?>][operators]" class="form-control float-left rule-type is-valid" aria-invalid="false">
                        <option value="="  <?=$rule['operators']=="="?'selected':''?>>Equal to</option>
                        <option value="<>"  <?=$rule['operators']=="<>"?'selected':''?>>Not equal to</option>
                        <option value="like"  <?=$rule['operators']=="like"?'selected':''?>>Like</option>
                    </select>
                </th>
                <th>
                    <select name="permission_config[<?=$per_id?>][type]" class="form-control float-left rule-type is-valid" aria-invalid="false">
                        <option value="global_user" <?=$rule['global_user']=="="?'selected':''?>>Global User</option>
                        <option value="value" <?=$rule['value']=="="?'selected':''?>>Value</option>
                    </select>
                </th>
                <th>
                    <input name="permission_config[<?=$per_id?>][value]" class="form-control" value="<?=$rule['value']?>" />
                </th>
                <th>
                    <select name="permission_config[<?=$per_id?>][condition]" class="form-control float-left rule-type is-valid" aria-invalid="false">
                        <option value="and"  <?=$rule['condition']=="and"?'selected':''?>>And</option>
                        <option value="or"  <?=$rule['condition']=="or"?'selected':''?>>Or</option>
                    </select>
                </th>
                <th>
                    <button class="add_rule btn btn-primary"  type="button">Add rule</button>
                </th>
            </tr>
        <?php endforeach?>
    </tbody>
</table>
<script>

$(document).ready(function() {
        $(document).on("click", ".add_rule", function() {
            id = $("#permission_config").find("tbody > tr").length + 1;
            bindHtml = `<tr>
                <th><span >${id}</span></th>
                <th>
                    <select name="permission_config[${id}][field]" class="form-control float-left rule-type is-valid" >
                        <?php foreach ($fields as $key => $field) : ?>
                        <option value="<?= $key ?>"><?= @$field->name ?></option>
                        <?php endforeach ?>
                    </select>
                </th>
                <th>
                    <select name="permission_config[${id}][operators]" class="form-control float-left rule-type is-valid" aria-invalid="false">
                        <option value="=">Equal to</option>
                        <option value="<>">Not equal to</option>
                        <option value="like">Like</option>
                    </select>
                </th>
                <th>
                    <select name="permission_config[${id}][type]" class="form-control float-left rule-type is-valid" aria-invalid="false">
                        <option value="global_user">Global User</option>
                        <option value="value">Value</option>
                    </select>
                </th>
                <th>
                    <input name="permission_config[${id}][value]" class="from-control" />
                </th>
                <th>
                    <select name="permission_config[${id}][condition]" class="form-control float-left rule-type is-valid" aria-invalid="false">
                        <option value="and">And</option>
                        <option value="or">Or</option>
                    </select>
                </th>
                <th>
                    <button class="add_rule"  type="button">Add rule</button>
                </th>
            </tr>`;

            $("#permission_config").find("tbody").append(bindHtml);
        });

        $(document).on("click", ".btn_query_string", function() {
            query_string();
        });
        function query_string() {
            let query = '(';
            condition = "and";
            tr_index =  $("#permission_config").find("tbody > tr").length-1;
            $("#permission_config").find("tbody > tr").each(function(index) {
                field = $(this).find("select[name*=field]").val();
                operators = $(this).find("select[name*=operators]").val();
                type = $(this).find("select[name*=type]").val();
                value = $(this).find("input[name*=value]").val();
                condition= $(this).find("select[name*=condition]").val();
                query += field  + " " +  operators  +  " "  + (operators=='like'?'\'%':'') + (type=="global_user"?'@global_user@':value) + (operators=='like'?'%\'':'') + (index==tr_index?'':" " +condition+" ");

                condition = $(this).find("select[name*=condition]").val();
                console.log(index,tr_index);
            });
            query += ")";
            $('#query_string').val(query);
        }
});
</script>
