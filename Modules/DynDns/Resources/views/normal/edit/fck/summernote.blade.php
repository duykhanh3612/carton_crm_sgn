<div class="form-group {{$ctrl->width}}">
    <label>{{ $ctrl->title}}</label>
    <div>
        <textarea class="form-control summernote" {!! $ctrl->att_style !!} name="<?=$ctrl->name.$lang?>" id="<?=$ctrl->name.$lang?>"><?=@$row->{$ctrl->value.$lang}?></textarea>
    </div>
</div>
