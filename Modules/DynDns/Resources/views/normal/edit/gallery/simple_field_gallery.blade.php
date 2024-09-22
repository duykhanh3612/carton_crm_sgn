@php
    $flg_read =    true;
@endphp
<div class="form-group {{@$ctrl->width}}" id="gallery_{{$ctrl->name}}">
    <?php
    if($ctrl->att_table!='')
        @$col = 12/count(explode(",", $ctrl->att_table));
    ?>
    <div class="portlet-content" style="width:100% !important;">

        <!--<label class="section_add">
            <h5 >
                <i class="material-icons"></i>Add Section
            </h5>
        </label>-->
        <div id="m_confirm_gallery_delete{{$ctrl->name}}" class="modal fade" data-backdrop="true">
            <div class="modal-dialog" id="animate">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Xác nhận</h5>
                    </div>
                    <div class="modal-body text-center p-lg">
                        <p>
                            Bạn có chắc là bạn muốn xóa?
                            <br />
                            <strong></strong>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Không</button>
                        <a class="btn-yes btn danger p-x-md btn-gallery-item">Có</a>
                    </div>
                </div>
            </div>
        </div>
        <textarea id="{{$ctrl->name}}" name="{{$ctrl->name.@$lang}}" class="form-control content_id" style="display:none"><?=@$row->{$ctrl->value.@$lang}?></textarea>
        <div class="content_{{ $ctrl->value }}">
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

            <div class="list_item">
                @php
                    $results_json = json_decode(@$row->{$ctrl->value.@$lang});
                    $item_image = 0;
                @endphp

                @if(@$results_json)
                @foreach($results_json as $d)
                @php
                $item_image++;
                @endphp
                <div class="row list_item_row" style="padding:10px; border-bottom:1px dashed #bd2742">
                    <div class="col-md-12   hidden-sm-up">
                        <b>{{    @$d->title}}</b>
                    </div>

                    <div class="form-group col-md-1">
                        <label class="hidden-sm-up">Thứ tự</label>
                        <input class="pull-left form-control row_order item" {{    @$ctrl->read==1||$flg_read?"readonly":""}}  type="text" value="{{    @$d->no}}" />
                        <br />
                        <a class="btn btn-sm info" style="padding-top:5px;display:none;">
                            <small>
                                <i class='material-icons'>&#xe8d7</i>
                            </small>
                        </a>


                    </div>
                    <div class="col-md-10">

                        <div class="col-md-{{@$col}} form-group  ctxdform title">
                            <label class="hidden-sm-up">Tiêu đề</label>
                            <textarea class="form-control row_title item" {{    @$ctrl->read==1 ||$flg_read?"readonly":""}}  style="width:100%">{{    @$d->title}}</textarea>

                        </div>
                        <div class="col-md-{{@$col}} form-group ctxdform caption">
                            <label class="hidden-sm-up">Mô tả</label>
                            <textarea class="form-control row_content item" {{    @$ctrl->read==1||$flg_read?"readonly":""}} style="width:100%">{{    @$d->content}}</textarea>
                        </div>
                        <div class="col-md-{{@$col}}  ctxdform note">
                            <label class="hidden-sm-up">Ghi chú</label>
                            <textarea class="form-control row_note item" {{@$ctrl->read==1||$flg_read?"readonly":""}} style="width:100%">{{    @$d->note}}</textarea>
                        </div>
                        <div class="col-md-{{@$col}}  ctxdform link">
                            <label class="hidden-sm-up">Link</label>
                            <textarea class="form-control row_link item" {{@$ctrl->read==1||$flg_read?"readonly":""}} style="width:100%">{{    @$d->link }}</textarea>
                        </div>
                        <div class="col-md-{{@$col}} ctxdform image">
                            <label class="col-md-12 hidden-sm-up">Hình ảnh</label>
                            <div class="col-md-12 lable_upload text-center">
                                <input class="form-control row_image item" value="{{    @$d->image}}" type="hidden" />
                                <div id="{{$ctrl->name}}thumb_upload{{@$item_image}}" class="thumb-output">
                                    @if(@$d->image!='')
                                    <a href="{{    url($image_path.@$d->image)}} " data-lightbox="roadtrip" data-title="<span style='float:left'>{{    @$d->title}}</span> <span style='float:right'><small> {{    @$d->content}}</small></span>" target="_blank">
                                        <img src="{{    url($image_path.@$d->image)}}" />
                                    </a>
                                    @else
                                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAANlBMVEX///+/v7+8vLzKysr8/Pzg4ODFxcXb29vT09Pj4+P4+PjBwcH6+vry8vLY2NjIyMjp6eno6Og1AQOEAAAEdUlEQVR4nO2d6ZbCIAxGp3TT1i6+/8uOWrUUwlKsIZ7z3d+dwh0wIYDHvz8AAAAAAAAAAAAAAAAAXqqx+Snq/YYnVfwQqoUhDKUDQxjKB4YwlA8MYSifAwyVNA43PJ2FUR5sqM673/BljP7B0AaG2YFhEBhmB4ZBYJgdGAaBYXZgGASG2YFhEBhmB4ZBYJidDIaXKqWjyfAaXubxsUs7nbvkHu+F1XAuX1vQqmm5RpLTsO61R9WJaRgZDc0Djmb4pOPR8BmezTMqVX7U81jYDIemMFH775glwGY4EseMH8zTNvpPuQw7ewhvJC8Phn6MfZTLcKZOitUpMWXcGp1iQzGXITVJiyK6mwatih9/LkP6tL9PM+zUjvH/ScPlZZGxJq9hk2RYP96lTnFPcxnWpGF52d2ellnjHucyHMhYGh3ydcrX6v0a9TiX4WV76WOhn3c3p8+GMirWsK1pztQkTUiH2uov7h/EZliV1jxVCYu26rS3t3y1xaU3DVMW3puIFRWKGevDudmOYkqV3xWRja1w1viDNlFV2qackVab3X/y7Z2oc9k8dqL6aUzJhH+1Mc9jPsnMu4nVULfjWF/TVmtWFR2TUH9qR9gOxxHFiTDD2Rd9qJVfOB7LMuzU6FYkdnpiVrayDG/vclYMeq7XCMYaUYb3lZ2zsqWrk3ANJcmwmx6voCfqNtdrDYbWDZIMX3s55LC4vvQQbFCQ4buEpMKNmetXQgWKHEO9grQUyTi6EKqh5BhuCkhzrWLn+rXFwLpGjOHQb7u9GUXrVGcziP6EIcbQHCW9tvLM0SJ4wCPF0N71XyefI9e/8ddQQgyJg5v180Xneu1Jb6wRYthSPX92xpXr1za96xoZhoO1h6MpunL9ivccktuwIgu6yTE49+64c/36nC/WcBteS0LRnQzaQBx94quhuHcxSmX3pnMM4Z06PEcL/34Ns+Ft4aJ6Q9H7TeIYvxueax3Mt77ua09lTNQ5TsKLck9TXsNnXt8qxnzQgobuWMNr+EwKSj/7bSMnop/JOYishtd3BVi+Q0NUrAzTOw8TOQ0rrQJ8TdTQmjMW98UFTkO9AnxNVG9dtAdnDcVouD0GVtO9SxW9XEvA2XXO0zVjuO478seEmQd9fkN7uLr5sCF0X1zgM7zawzVR1xeSDR01FOM5/oE2JI4aKutdjGNxdD7rfZqDoQ8Ts94vPRh6v4bL8MCg6WbKaEgE0i+gqGnKY/j9QOruPo/h9wPpAnVJisWQI5AuEK2zGHIE0qV1ooZiMWQJpAv2uobDkCeQLs3bh4kMhkyB9EkOw8PK+Bjs9r9vWI0lJ9Y0ZRjDjhVrV1HG6do3gWEQGGYHhkFgmB0YBoFhdmAYBIbZOdqwqCtZHG/YsFaDEWw3ifDbCDCUDwxhKB8YwlA+MIShfGAIQ/nAEIbygSEM5QNDGMoHhjCUDwxhKB8YwlA+MIShfGAIQ/nAEIbygSEM5QNDGMoHhjCUT5rhT5FgONc/Bc/PuwIAAAAAAAAAAAAAAAAQzD8O4oElgraltwAAAABJRU5ErkJggg==" />

                                    @endif
                                </div>
                                @if(@$ctrl->read!=1 && !$flg_read)
                                <label class="btn btn-sm info" style="padding: 5px !important;" for="{{$ctrl->name}}upload{{    @$item_image}}">
                                    Tải lên
                                </label>
                                <input type="file" id="{{$ctrl->name}}upload{{    @$item_image}}" data-id="#{{$ctrl->name}}thumb_upload{{@$item_image}}" style="display:none;" class="add-file-upload" />
                                @endif
                            </div>
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
                    <label class="col-md-12 row_remove  hidden-sm-up pointer"  data-id="m_confirm_gallery_delete{{$ctrl->name}}">
                        Xóa
                        <b>{{    @$d->title}}</b>
                    </label>
                    @endif
                </div>
                @endforeach
                @endif
            </div>

            <div class="{{$ctrl->name.@$lang}}_list_item_default" style="display:none">
                <div class="row list_item_row" style="padding:10px; border-bottom:1px dashed #bd2742">
                    <div class="form-group col-md-1" style="padding:9px;">
                        <label class="hidden-sm-up">Thứ tự</label>
                        <input class="pull-left form-control row_order item" type="text" value="" />
                        <br />
                        <a class="btn btn-sm info" style="padding-top:5px;display:none;">
                            <small>
                                <i class='material-icons'>&#xe8d7</i>
                            </small>
                        </a>

                    </div>
                    <div class="col-md-10">
                        <div class="col-md-{{@$col}}  ctxdform title">
                            <label class="hidden-sm-up">Tiêu đề</label>
                            <textarea class="form-control row_title item" style="width:100%"></textarea>

                        </div>
                        <div class="col-md-{{@$col}}  ctxdform caption">
                            <label class="hidden-sm-up">Mô tả</label>
                            <textarea class="form-control row_content item" style="width:100%"></textarea>
                        </div>

                        <div class="col-md-{{@$col}}  ctxdform note">
                            <label class="hidden-sm-up">Ghi chú</label>
                            <textarea class="form-control row_note item" style="width:100%"></textarea>
                        </div>
                        <div class="col-md-{{@$col}} text-center ctxdform link">
                            <label class="hidden-sm-up">Link</label>
                            <textarea class="form-control row_link item" style="width:100%"></textarea>
                        </div>

                        <div class="col-md-{{@$col}}  ctxdform image" style="text-align:center">
                            <!--<label class="hidden-sm-up">Hình ảnh</label>-->
                            <label for="upload" class="lable_upload" style="text-align:center;width:100%">
                                <input class="form-control row_image item" value="" type="hidden" />
                                <div class="thumb-output">
                                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAANlBMVEX///+/v7+8vLzKysr8/Pzg4ODFxcXb29vT09Pj4+P4+PjBwcH6+vry8vLY2NjIyMjp6eno6Og1AQOEAAAEdUlEQVR4nO2d6ZbCIAxGp3TT1i6+/8uOWrUUwlKsIZ7z3d+dwh0wIYDHvz8AAAAAAAAAAAAAAAAAXqqx+Snq/YYnVfwQqoUhDKUDQxjKB4YwlA8MYSifAwyVNA43PJ2FUR5sqM673/BljP7B0AaG2YFhEBhmB4ZBYJgdGAaBYXZgGASG2YFhEBhmB4ZBYJidDIaXKqWjyfAaXubxsUs7nbvkHu+F1XAuX1vQqmm5RpLTsO61R9WJaRgZDc0Djmb4pOPR8BmezTMqVX7U81jYDIemMFH775glwGY4EseMH8zTNvpPuQw7ewhvJC8Phn6MfZTLcKZOitUpMWXcGp1iQzGXITVJiyK6mwatih9/LkP6tL9PM+zUjvH/ScPlZZGxJq9hk2RYP96lTnFPcxnWpGF52d2ellnjHucyHMhYGh3ydcrX6v0a9TiX4WV76WOhn3c3p8+GMirWsK1pztQkTUiH2uov7h/EZliV1jxVCYu26rS3t3y1xaU3DVMW3puIFRWKGevDudmOYkqV3xWRja1w1viDNlFV2qackVab3X/y7Z2oc9k8dqL6aUzJhH+1Mc9jPsnMu4nVULfjWF/TVmtWFR2TUH9qR9gOxxHFiTDD2Rd9qJVfOB7LMuzU6FYkdnpiVrayDG/vclYMeq7XCMYaUYb3lZ2zsqWrk3ANJcmwmx6voCfqNtdrDYbWDZIMX3s55LC4vvQQbFCQ4buEpMKNmetXQgWKHEO9grQUyTi6EKqh5BhuCkhzrWLn+rXFwLpGjOHQb7u9GUXrVGcziP6EIcbQHCW9tvLM0SJ4wCPF0N71XyefI9e/8ddQQgyJg5v180Xneu1Jb6wRYthSPX92xpXr1za96xoZhoO1h6MpunL9ivccktuwIgu6yTE49+64c/36nC/WcBteS0LRnQzaQBx94quhuHcxSmX3pnMM4Z06PEcL/34Ns+Ft4aJ6Q9H7TeIYvxueax3Mt77ua09lTNQ5TsKLck9TXsNnXt8qxnzQgobuWMNr+EwKSj/7bSMnop/JOYishtd3BVi+Q0NUrAzTOw8TOQ0rrQJ8TdTQmjMW98UFTkO9AnxNVG9dtAdnDcVouD0GVtO9SxW9XEvA2XXO0zVjuO478seEmQd9fkN7uLr5sCF0X1zgM7zawzVR1xeSDR01FOM5/oE2JI4aKutdjGNxdD7rfZqDoQ8Ts94vPRh6v4bL8MCg6WbKaEgE0i+gqGnKY/j9QOruPo/h9wPpAnVJisWQI5AuEK2zGHIE0qV1ooZiMWQJpAv2uobDkCeQLs3bh4kMhkyB9EkOw8PK+Bjs9r9vWI0lJ9Y0ZRjDjhVrV1HG6do3gWEQGGYHhkFgmB0YBoFhdmAYBIbZOdqwqCtZHG/YsFaDEWw3ifDbCDCUDwxhKB8YwlA+MIShfGAIQ/nAEIbygSEM5QNDGMoHhjCUDwxhKB8YwlA+MIShfGAIQ/nAEIbygSEM5QNDGMoHhjCUT5rhT5FgONc/Bc/PuwIAAAAAAAAAAAAAAAAQzD8O4oElgraltwAAAABJRU5ErkJggg==" />
                                </div>
                                <br />
                                <span class="btn info" style="padding: 5px !important;" for="upload">Tải lên</span>
                                <input type="file" id="upload" style="display:none" class="add-file-upload" />
                            </label>

                        </div>
                        <div class="col-md-{{@$col}}  ctxdform icon">
                            <label for="upload_icon" class="lable_upload_icon">
                                <input class="form-control row_icon item" value="" type="hidden" />
                                <div class="thumb-output_icon">
                                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAANlBMVEX///+/v7+8vLzKysr8/Pzg4ODFxcXb29vT09Pj4+P4+PjBwcH6+vry8vLY2NjIyMjp6eno6Og1AQOEAAAEdUlEQVR4nO2d6ZbCIAxGp3TT1i6+/8uOWrUUwlKsIZ7z3d+dwh0wIYDHvz8AAAAAAAAAAAAAAAAAXqqx+Snq/YYnVfwQqoUhDKUDQxjKB4YwlA8MYSifAwyVNA43PJ2FUR5sqM673/BljP7B0AaG2YFhEBhmB4ZBYJgdGAaBYXZgGASG2YFhEBhmB4ZBYJidDIaXKqWjyfAaXubxsUs7nbvkHu+F1XAuX1vQqmm5RpLTsO61R9WJaRgZDc0Djmb4pOPR8BmezTMqVX7U81jYDIemMFH775glwGY4EseMH8zTNvpPuQw7ewhvJC8Phn6MfZTLcKZOitUpMWXcGp1iQzGXITVJiyK6mwatih9/LkP6tL9PM+zUjvH/ScPlZZGxJq9hk2RYP96lTnFPcxnWpGF52d2ellnjHucyHMhYGh3ydcrX6v0a9TiX4WV76WOhn3c3p8+GMirWsK1pztQkTUiH2uov7h/EZliV1jxVCYu26rS3t3y1xaU3DVMW3puIFRWKGevDudmOYkqV3xWRja1w1viDNlFV2qackVab3X/y7Z2oc9k8dqL6aUzJhH+1Mc9jPsnMu4nVULfjWF/TVmtWFR2TUH9qR9gOxxHFiTDD2Rd9qJVfOB7LMuzU6FYkdnpiVrayDG/vclYMeq7XCMYaUYb3lZ2zsqWrk3ANJcmwmx6voCfqNtdrDYbWDZIMX3s55LC4vvQQbFCQ4buEpMKNmetXQgWKHEO9grQUyTi6EKqh5BhuCkhzrWLn+rXFwLpGjOHQb7u9GUXrVGcziP6EIcbQHCW9tvLM0SJ4wCPF0N71XyefI9e/8ddQQgyJg5v180Xneu1Jb6wRYthSPX92xpXr1za96xoZhoO1h6MpunL9ivccktuwIgu6yTE49+64c/36nC/WcBteS0LRnQzaQBx94quhuHcxSmX3pnMM4Z06PEcL/34Ns+Ft4aJ6Q9H7TeIYvxueax3Mt77ua09lTNQ5TsKLck9TXsNnXt8qxnzQgobuWMNr+EwKSj/7bSMnop/JOYishtd3BVi+Q0NUrAzTOw8TOQ0rrQJ8TdTQmjMW98UFTkO9AnxNVG9dtAdnDcVouD0GVtO9SxW9XEvA2XXO0zVjuO478seEmQd9fkN7uLr5sCF0X1zgM7zawzVR1xeSDR01FOM5/oE2JI4aKutdjGNxdD7rfZqDoQ8Ts94vPRh6v4bL8MCg6WbKaEgE0i+gqGnKY/j9QOruPo/h9wPpAnVJisWQI5AuEK2zGHIE0qV1ooZiMWQJpAv2uobDkCeQLs3bh4kMhkyB9EkOw8PK+Bjs9r9vWI0lJ9Y0ZRjDjhVrV1HG6do3gWEQGGYHhkFgmB0YBoFhdmAYBIbZOdqwqCtZHG/YsFaDEWw3ifDbCDCUDwxhKB8YwlA+MIShfGAIQ/nAEIbygSEM5QNDGMoHhjCUDwxhKB8YwlA+MIShfGAIQ/nAEIbygSEM5QNDGMoHhjCUT5rhT5FgONc/Bc/PuwIAAAAAAAAAAAAAAAAQzD8O4oElgraltwAAAABJRU5ErkJggg==" />
                                </div>
                                <input type="file" id="upload_icon" style="display:none" class="add-file-upload_icon" />
                            </label>

                        </div>
                    </div>
                    <div class="form-group col-md-1">
                        @if(@$ctrl->read!=1)
                        <label class="btn btn-sm warning row_remove  hidden-xs-down pointer" style="width:100%" ui-toggle-class="bounce" ui-target="#animate" data-id="m_confirm_gallery_delete{{$ctrl->name}}">
                            <small>
                                <i class="material-icons"></i>Xóa
                            </small>
                        </label>
                        @endif


                            <label class="btn btn-fw warning col-md-12 row_remove  hidden-sm-up pointer" data-id="m_confirm_gallery_delete{{$ctrl->name}}">
                                Xóa <b>Record</b>
                            </label>


                    </div>


                </div>

            </div>

            @if(@$ctrl->read!=1 && !$flg_read)
            <div colspan="5" style="padding-top:5px;">
                <label class="btn btn-fw primary {{@$ctrl->read==1?" cccccc":"item_add"}}" style="cursor:pointer;">
                    <i class="material-icons"></i>
                    &nbsp; Thêm mới
                </label>
            </div>
            @endif


        </div>

    </div>

</div>

<link href="../../plugin/lightbox2/dist/css/lightbox.css" rel="stylesheet" />
<script src="../../plugin/lightbox2/dist/js/lightbox.js"></script>
<style type="text/css">
    .lb-caption
    {
        display:block;
        width:100%;
    }
    .lb-caption span{
        width:50%;
    }
        .lb-caption span:first-child {
            border-right:1px dashed #808080;

        }
        .lb-caption span:last-child {
            padding-left: 5px;
            color: #ff6a00;
        }
</style>
<script>
    @if($ctrl->att_table!='')
	var hiddentab = ".ctxdform";
	$(hiddentab).css("display", "none");
	$('{{".".implode(",.",explode(",", $ctrl->att_table))}}').fadeIn();
    @endif

    var tab = '.content_<?=@$row->{$ctrl->value.@$lang}?>';
</script>
<script>
    $(document).on('click', '.content_{{ $ctrl->value }} .item_add', function () {

        var html = $('.{{$ctrl->name.$lang}}_list_item_default');
        var count_image = $('.content_{{ $ctrl->value }} .lable_upload').length + 1;

        $('.content_{{$ctrl->value}} .list_item').append(html.html());

        var html_ele = $(this).parent().parent().parent().find('.list_item > .list_item_row').last();

        html_ele.find('.row_order').val(count_image-1);

        //image
        html_ele.find('.lable_upload').attr('for', '{{ $ctrl->value }}_upload' + count_image+1);
        html_ele.find('.lable_upload>.add-file-upload').attr('id', '{{ $ctrl->value }}_upload' + count_image+1);
        html_ele.find('.lable_upload>.thumb-output').attr('id', '{{ $ctrl->value }}_thumb_upload' + count_image+1);
        html_ele.find('.lable_upload>.add-file-upload').attr('data-id', '#{{ $ctrl->value }}_thumb_upload' + count_image+1);

        //icon
        html_ele.find('.lable_upload_icon').attr('for', '{{ $ctrl->value }}_upload_icon' + count_image);
        html_ele.find('.lable_upload_icon>.add-file-upload_icon').attr('id', '{{ $ctrl->value }}_upload_icon' + count_image);
        html_ele.find('.lable_upload_icon>.thumb-output_icon').attr('id', '{{ $ctrl->value }}_thumb_upload_icon' + count_image);
        html_ele.find('.lable_upload_icon>.add-file-upload_icon').attr('data-id', '#{{$ctrl->value }}_thumb_upload_icon' + count_image);

        count_image++;
    });

    var item_chose;
    var popup_id;
    $(document).on('click', '.row_remove', function () {
        item_chose = $(this)
        popup_id = '#'+$(this).attr('data-id');
        if(popup_id!='')
            $(popup_id).modal('show');

    });
    $(document).on('click', '.btn-gallery-item', function () {
        item_chose.parent().parent().remove();
        {{ $ctrl->value }}_update_galler_content();
        $(popup_id).modal('hide');

    });
    $(document).on('change', '.content_{{ $ctrl->value }} .item', function () {
            {{ $ctrl->value }}_update_galler_content();
    });


    $(".remove_image").on('click', function () {
        var img = $(this).parent().parent().find(".tmp_image").val();

        $.get("{{url('admin/'.request()->segment(2).'/remove_upload')}}", { image: "public/"+img }, function (data) {
            var list = [];
            $('.tmp_image').each(function () {
                list.push($(this).val());
            });

            $('.image_content').val(JSON.stringify(list));
        });

        $(this).parent().parent().remove();

    });

    $(document).on('change', '.content_{{ $ctrl->value }} .add-file-upload', function () {
        var input_file = $(this).attr('data-id');
        if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
        {
           // $(input_file).html(''); //clear html of output element
            var data = $(this)[0].files; //this file data
           // alert($(this)[0].name  )
            $.each(data, function(index, file){ //loop though each file
                if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                    var fRead = new FileReader(); //new filereader
                    fRead.onload = (function(file){ //trigger function on successful read
                        return function(e) {
                            var img = $('<img/>').addClass('thumb').attr('src', e.target.result); //create image element
                            $(input_file).html(img); //append image to output element
                        };
                    })(file);

                    fRead.readAsDataURL(file); //URL representing the file's data.
                }
            });

        }else{
            alert("Your browser doesn't support File API!"); //if File API is absent
        }

        var file_data = $(this).prop("files")[0];

            var form_data = new FormData();
            form_data.append("file", file_data);
            form_data.append("_token", '{{ csrf_token() }}');

            $.ajax({
                url: "{{url('admin/'.request()->segment(2).'/upload_file')}}",
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'POST',
                success: function (data) {
                    var image = data;
                    $(input_file).parent().find('.row_image').val(image);
                    {{ $ctrl->value }}_update_galler_content();
                }
            });
          // {{ $ctrl->value }}_update_galler_content();
    });

    $(document).on('change', '.content_{{ $ctrl->value }} .add-file-upload_icon', function () {
        var input_file = $(this).attr('data-id');
        if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
        {
            $(input_file).html(''); //clear html of output element
            var data = $(this)[0].files; //this file data

            $.each(data, function(index, file){ //loop though each file
                if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                    var fRead = new FileReader(); //new filereader
                    fRead.onload = (function(file){ //trigger function on successful read
                        return function(e) {
                            var img = $('<img/>').addClass('thumb').attr('src', e.target.result); //create image element
                            $(input_file).append(img); //append image to output element
                        };
                    })(file);
                    fRead.readAsDataURL(file); //URL representing the file's data.
                }
            });

        }else{
            alert("Your browser doesn't support File API!"); //if File API is absent
        }

        var file_data = $(this).prop("files")[0];

            var form_data = new FormData();
            form_data.append("file", file_data);
            form_data.append("_token", '{{ csrf_token() }}');

            $.ajax({
                url: "{{url('admin/'.request()->segment(2).'/upload_file')}}",
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'POST',
                success: function (data) {
                    var image = data;
                    $(input_file).parent().find('.row_icon').val(image);
                        {{ $ctrl->value }}_update_galler_content();

                }
            });

    });
    function {{ $ctrl->value }}_update_galler_content() {
        var list=[];
        $('.content_{{ $ctrl->value }} .list_item>.list_item_row').each(function () {
            var no = $(this).find('.row_order').val();
            var title = $(this).find('.row_title').val();
            var content = $(this).find('.row_content').val();
            var image = $(this).find('.row_image').val();
            var icon = $(this).find('.row_icon').val();
            var note = $(this).find('.row_note').val();
            var link = $(this).find('.row_link').val();
            var obj_detail = {
                no: no,
                title: title,
                content: content,
                note:note,
                link:link,
                image: image,
                icon: icon
            };
            list.push(obj_detail);
        });
        $("#{{$ctrl->value.@$lang}}").val(JSON.stringify(list));
    }
</script>
<style type="text/css">
    .pointer {
        cursor:pointer;
    }
    .cccccc{
        background-color:#cccccc;
    }
    .table-striped td{
        opacity:1 !important;
    }
    h6:after {
        counter-increment: section;
        /*content: "Section " counter(section) ": ";*/

    }
    .b-t {
        border-top: 1px solid rgba(120, 130, 140, 0.13);
    }

    .table {
        margin-bottom: 1rem;
        max-width: 100%;
        width: 100%;
    }
        .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th {
            border-color: rgba(120, 130, 140, 0.043);
            padding-left: 16px;
            padding-right: 16px;
        }
    .thumb-output img {
        height: 70px;
    }
    .thumb-output_icon img {
        height: 70px;
    }
</style>
