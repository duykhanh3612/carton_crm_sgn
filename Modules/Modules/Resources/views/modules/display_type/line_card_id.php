<div class="form-group">
    <table class="table">
        <thead>
            <tr>
                <th width="2%">Role</th>
                <th>Where (Leave blank if conditions are not considered)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Admin</td>
                <td><input class="form-control" type="text" name="admin_where" value="<?= @$display_type_value['admin_where']   ?>" placeholder="Enter data access conditions"></td>
            </tr>
            <tr>
                <td>User</td>
                <td><input class="form-control" type="text" name="user_where" value='<?= @$display_type_value['user_where']   ?>' placeholder="Enter data access conditions"></td>
            </tr>
        </tbody>
    </table>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-sm-12 control-label mrg5B">Display</div>
        <div class="col-sm-12 wrap-note">
            <div class="wrap-note mrg10R">
                <input <?= !empty($display_type_value['display'] == 'text') ? 'checked' : ''  ?> id="only" value="text" type="radio" class="form-control" name="display">
                <label for="only">Text</label>
            </div>
            <div class="wrap-note">
                <input <?= !empty($display_type_value['display'] == 'select') ? 'checked' : ''  ?> id="full" value="select" type="radio" class="form-control" name="display">
                <label for="full">Select</label>
            </div>
        </div>
    </div>
</div>
