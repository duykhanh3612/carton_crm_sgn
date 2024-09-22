<div class="form-group {{ $ctrl->width }} desktop ">
    <label>
        {{ $ctrl->title }}
        @if (@$ctrl->validate == 1)
            <span style="color:#ff0000">(*)</span>
        @endif
    </label>
    <div class="row ml-1">
        <div  class="col-md-12">
            <label>Host</label>
            <input class="form-control" type="text" name="mail_host" value="{{ @$row->mail_host }}" placeholder="Mail Host">
        </div>
        <div  class="col-md-12">
            <label>Port</label>
            <input class="form-control" type="text" name="mail_port" value="{{ @$row->mail_port }}" placeholder="Mail Port">
        </div>
        <div  class="col-md-12">
            <label>Username</label>
            <input class="form-control" type="text" name="mail_username" value="{{ @$row->mail_username }}" placeholder="Mail Username">
        </div>
        <div  class="col-md-12">
            <label>Password</label>
            <input class="form-control" type="text" name="mail_password" value="{{ @$row->mail_password }}" placeholder="Mail Password">
        </div>
        <div  class="col-md-12">
            <label>Encryption</label>
            <input class="form-control" type="text" name="mail_encryption" value="{{ @$row->mail_encryption }}" placeholder="Mail Encryption">
        </div>
    </div>
</div>
