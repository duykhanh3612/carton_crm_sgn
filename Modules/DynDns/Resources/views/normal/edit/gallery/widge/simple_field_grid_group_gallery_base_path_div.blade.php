
<div class="  col-md-2 list_item_row " style="padding:10px;">

    <input class="pull-left form-control row_order item" {{ @$ctrl->read==1||$flg_read?"readonly":""}}  type="text" value="{{    @$d->no}}" />

    <div class="container_avatar">
        <label class="container">
            <input type="radio" name="{{ $ctrl->value }}_avatar" {{ @$d->avatar==true?'checked':''}} class="row_avatar" value="{{@$d->image}}" title="Chọn làm ảnh đại diện" />
            <span class="checkmark"></span>
        </label>
    </div>


    <div class="col-md-12   hidden-sm-up">
        <b>{{    @$d->title}}</b>
    </div>

    <div class="panel_image ctxdform image">

        <div class="lable_upload text-center">
            <input class="form-control row_image item" value="{{    @$d->image}}" type="hidden" />
            <div id="{{$ctrl->name}}thumb_upload{{@$item_image}}" class="thumb-output">
                @if(@$d->image!='')
                <a href="{{    $image_path.'/'.@$d->image}} " data-lightbox="roadtrip" data-title="<span style='float:left'>{{    @$d->title}}</span> <span style='float:right'><small> {{    @$d->content}}</small></span>" target="_blank">
                    <img src="{{    $image_path.'/'.@$d->image}}" />
                </a>
                @else
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAANlBMVEX///+/v7+8vLzKysr8/Pzg4ODFxcXb29vT09Pj4+P4+PjBwcH6+vry8vLY2NjIyMjp6eno6Og1AQOEAAAEdUlEQVR4nO2d6ZbCIAxGp3TT1i6+/8uOWrUUwlKsIZ7z3d+dwh0wIYDHvz8AAAAAAAAAAAAAAAAAXqqx+Snq/YYnVfwQqoUhDKUDQxjKB4YwlA8MYSifAwyVNA43PJ2FUR5sqM673/BljP7B0AaG2YFhEBhmB4ZBYJgdGAaBYXZgGASG2YFhEBhmB4ZBYJidDIaXKqWjyfAaXubxsUs7nbvkHu+F1XAuX1vQqmm5RpLTsO61R9WJaRgZDc0Djmb4pOPR8BmezTMqVX7U81jYDIemMFH775glwGY4EseMH8zTNvpPuQw7ewhvJC8Phn6MfZTLcKZOitUpMWXcGp1iQzGXITVJiyK6mwatih9/LkP6tL9PM+zUjvH/ScPlZZGxJq9hk2RYP96lTnFPcxnWpGF52d2ellnjHucyHMhYGh3ydcrX6v0a9TiX4WV76WOhn3c3p8+GMirWsK1pztQkTUiH2uov7h/EZliV1jxVCYu26rS3t3y1xaU3DVMW3puIFRWKGevDudmOYkqV3xWRja1w1viDNlFV2qackVab3X/y7Z2oc9k8dqL6aUzJhH+1Mc9jPsnMu4nVULfjWF/TVmtWFR2TUH9qR9gOxxHFiTDD2Rd9qJVfOB7LMuzU6FYkdnpiVrayDG/vclYMeq7XCMYaUYb3lZ2zsqWrk3ANJcmwmx6voCfqNtdrDYbWDZIMX3s55LC4vvQQbFCQ4buEpMKNmetXQgWKHEO9grQUyTi6EKqh5BhuCkhzrWLn+rXFwLpGjOHQb7u9GUXrVGcziP6EIcbQHCW9tvLM0SJ4wCPF0N71XyefI9e/8ddQQgyJg5v180Xneu1Jb6wRYthSPX92xpXr1za96xoZhoO1h6MpunL9ivccktuwIgu6yTE49+64c/36nC/WcBteS0LRnQzaQBx94quhuHcxSmX3pnMM4Z06PEcL/34Ns+Ft4aJ6Q9H7TeIYvxueax3Mt77ua09lTNQ5TsKLck9TXsNnXt8qxnzQgobuWMNr+EwKSj/7bSMnop/JOYishtd3BVi+Q0NUrAzTOw8TOQ0rrQJ8TdTQmjMW98UFTkO9AnxNVG9dtAdnDcVouD0GVtO9SxW9XEvA2XXO0zVjuO478seEmQd9fkN7uLr5sCF0X1zgM7zawzVR1xeSDR01FOM5/oE2JI4aKutdjGNxdD7rfZqDoQ8Ts94vPRh6v4bL8MCg6WbKaEgE0i+gqGnKY/j9QOruPo/h9wPpAnVJisWQI5AuEK2zGHIE0qV1ooZiMWQJpAv2uobDkCeQLs3bh4kMhkyB9EkOw8PK+Bjs9r9vWI0lJ9Y0ZRjDjhVrV1HG6do3gWEQGGYHhkFgmB0YBoFhdmAYBIbZOdqwqCtZHG/YsFaDEWw3ifDbCDCUDwxhKB8YwlA+MIShfGAIQ/nAEIbygSEM5QNDGMoHhjCUDwxhKB8YwlA+MIShfGAIQ/nAEIbygSEM5QNDGMoHhjCUT5rhT5FgONc/Bc/PuwIAAAAAAAAAAAAAAAAQzD8O4oElgraltwAAAABJRU5ErkJggg==" />

                @endif
            </div>

        </div>
    </div>
    <div style="height:40px;"></div>
    @if(@$ctrl->read!=1 && !$flg_read)
    <label class="btn btn-sm info btn_upload" style="padding: 5px !important;" for="{{$ctrl->name}}upload{{    @$item_image}}">
        <i class="fa fa-upload"></i>
    </label>

    @if(@$ctrl->read!=1 && !$flg_read)
    <label class="btn btn-sm warning row_remove  hidden-xs-down pointer" ui-toggle-class="bounce" ui-target="#animate" data-id="m_confirm_gallery_delete{{    $ctrl->name}}">
        <small>
            <i class="fa fa-times"></i>
        </small>
    </label>
    @endif


    <label class="btn btn-sm btn_modal_edit" ui-toggle-class="bounce" ui-target="#animate" data-id="m_confirm_gallery_delete{{    $ctrl->name}}">

        <i class="fa fa-info"></i>
    </label>
    <input type="file" id="{{$ctrl->name}}upload{{    @$item_image}}" data-id="#{{$ctrl->name}}thumb_upload{{@$item_image}}" style="display:none;" class="add-file-upload" />
    @endif
    <div style="display:none" class="modal list_item_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="row hidden-xs-down" style="padding:10px; border-bottom:1px dashed #bd2742">
                    <div class="col-md-1">Thứ tự</div>
                    <div class="col-md-10">
                        <div class="col-md-{{@$col}}  ctxdform title">Tiêu đề</div>
                        <div class="col-md-{{@$col}} text-center ctxdform caption">Mô tả</div>
                        <div class="col-md-{{@$col}} text-center ctxdform note">Note</div>
                        <div class="col-md-{{@$col}} text-center ctxdform link">Link</div>
                        <div class="col-md-{{@$col}} text-center ctxdform image">Hình ảnh</div>
                        <div class="col-md-{{@$col}} text-center ctxdform icon">Icon</div>
                    </div>
                    <div class="form-group col-md-1"></div>
                </div>
                <div class="form-group col-md-1">
                    <label class="hidden-sm-up">Thứ tự</label>

                </div>
                <div class="col-md-10 row">

                    <div class="col-md-{{@$col}} form-group  ctxdform title">
                        <label class="hidden-sm-up">Tiêu đề</label>
                        <textarea class="form-control row_title item" {{ @$ctrl->read==1 ||$flg_read?"readonly":""}}  style="width:100%">{{    @$d->title}}</textarea>

                    </div>
                    <div class="col-md-{{@$col}} form-group ctxdform caption">
                        <label class="hidden-sm-up">Mô tả</label>
                        <textarea class="form-control row_content item" {{ @$ctrl->read==1 || $flg_read?"readonly":""}} style="width:100%"></textarea>
                    </div>
                    <div class="col-md-{{@$col}}  ctxdform note">
                        <label class="hidden-sm-up">Ghi chú</label>
                        <textarea class="form-control row_note item" {{ @$ctrl->read==1||$flg_read?"readonly":""}} style="width:100%">{{    @$d->note}}</textarea>
                    </div>
                    <div class="col-md-{{@$col}}  ctxdform link">
                        <label class="hidden-sm-up">Link</label>
                        <textarea class="form-control row_link item" {{@$ctrl->read==1||$flg_read?"readonly":""}} style="width:100%">{{    @$d->link }}</textarea>
                    </div>

                    <div class="col-md-{{@$col}}   ctxdform icon">
                        <label for="upload_icon{{@$item_image}}" class="lable_upload_icon">
                            <input class="form-control row_icon item" value="{{@$d->icon}}" type="hidden" />
                            <div id="thumb_upload_icon{{@$item_image}}" class="thumb-output_icon">
                                @if(@$d->icon!='')
                                <a href="{{    url($base.@$d->icon)}} " data-lightbox="roadtrip" data-title="{{ @$d->title}}" target="_blank">

                                    <img src="{{url('public/vinhomes/'.@$d->icon)}}" />
                                </a>
                                @else
                                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAANlBMVEX///+/v7+8vLzKysr8/Pzg4ODFxcXb29vT09Pj4+P4+PjBwcH6+vry8vLY2NjIyMjp6eno6Og1AQOEAAAEdUlEQVR4nO2d6ZbCIAxGp3TT1i6+/8uOWrUUwlKsIZ7z3d+dwh0wIYDHvz8AAAAAAAAAAAAAAAAAXqqx+Snq/YYnVfwQqoUhDKUDQxjKB4YwlA8MYSifAwyVNA43PJ2FUR5sqM673/BljP7B0AaG2YFhEBhmB4ZBYJgdGAaBYXZgGASG2YFhEBhmB4ZBYJidDIaXKqWjyfAaXubxsUs7nbvkHu+F1XAuX1vQqmm5RpLTsO61R9WJaRgZDc0Djmb4pOPR8BmezTMqVX7U81jYDIemMFH775glwGY4EseMH8zTNvpPuQw7ewhvJC8Phn6MfZTLcKZOitUpMWXcGp1iQzGXITVJiyK6mwatih9/LkP6tL9PM+zUjvH/ScPlZZGxJq9hk2RYP96lTnFPcxnWpGF52d2ellnjHucyHMhYGh3ydcrX6v0a9TiX4WV76WOhn3c3p8+GMirWsK1pztQkTUiH2uov7h/EZliV1jxVCYu26rS3t3y1xaU3DVMW3puIFRWKGevDudmOYkqV3xWRja1w1viDNlFV2qackVab3X/y7Z2oc9k8dqL6aUzJhH+1Mc9jPsnMu4nVULfjWF/TVmtWFR2TUH9qR9gOxxHFiTDD2Rd9qJVfOB7LMuzU6FYkdnpiVrayDG/vclYMeq7XCMYaUYb3lZ2zsqWrk3ANJcmwmx6voCfqNtdrDYbWDZIMX3s55LC4vvQQbFCQ4buEpMKNmetXQgWKHEO9grQUyTi6EKqh5BhuCkhzrWLn+rXFwLpGjOHQb7u9GUXrVGcziP6EIcbQHCW9tvLM0SJ4wCPF0N71XyefI9e/8ddQQgyJg5v180Xneu1Jb6wRYthSPX92xpXr1za96xoZhoO1h6MpunL9ivccktuwIgu6yTE49+64c/36nC/WcBteS0LRnQzaQBx94quhuHcxSmX3pnMM4Z06PEcL/34Ns+Ft4aJ6Q9H7TeIYvxueax3Mt77ua09lTNQ5TsKLck9TXsNnXt8qxnzQgobuWMNr+EwKSj/7bSMnop/JOYishtd3BVi+Q0NUrAzTOw8TOQ0rrQJ8TdTQmjMW98UFTkO9AnxNVG9dtAdnDcVouD0GVtO9SxW9XEvA2XXO0zVjuO478seEmQd9fkN7uLr5sCF0X1zgM7zawzVR1xeSDR01FOM5/oE2JI4aKutdjGNxdD7rfZqDoQ8Ts94vPRh6v4bL8MCg6WbKaEgE0i+gqGnKY/j9QOruPo/h9wPpAnVJisWQI5AuEK2zGHIE0qV1ooZiMWQJpAv2uobDkCeQLs3bh4kMhkyB9EkOw8PK+Bjs9r9vWI0lJ9Y0ZRjDjhVrV1HG6do3gWEQGGYHhkFgmB0YBoFhdmAYBIbZOdqwqCtZHG/YsFaDEWw3ifDbCDCUDwxhKB8YwlA+MIShfGAIQ/nAEIbygSEM5QNDGMoHhjCUDwxhKB8YwlA+MIShfGAIQ/nAEIbygSEM5QNDGMoHhjCUT5rhT5FgONc/Bc/PuwIAAAAAAAAAAAAAAAAQzD8O4oElgraltwAAAABJRU5ErkJggg==" />

                                @endif
                            </div>
                            <input type="file" id="upload_icon{{@$item_image}}" data-id="#thumb_upload_icon{{    @$item_image}}" style="display:none" class="add-file-upload_icon" />
                        </label>
                    </div>
                </div>
                <div class="form-group col-md-1">
                    @if(@$ctrl->read!=1 && !$flg_read)
                    <label class="btn btn-sm warning row_remove  hidden-xs-down pointer" style="width:100%" ui-toggle-class="bounce" ui-target="#animate" data-id="m_confirm_gallery_delete{{    $ctrl->name}}">
                        <small>
                            <i class="material-icons"></i>Xóa
                        </small>
                    </label>
                    @endif
                </div>
                @if(@$ctrl->read!=1 && !$flg_read)
                <label class="col-md-12 row_remove  hidden-sm-up pointer" data-id="m_confirm_gallery_delete{{@$ctrl->name}}">
                    Xóa
                    <b>{{    @$d->title}}</b>
                </label>
                @endif
            </div>
        </div>
    </div>

</div>
