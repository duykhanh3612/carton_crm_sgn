@php
$flg_read = false;
$name_id = str_replace(array('[',']',"#"),array('','',''),@$ctrl->name.$lang);
@endphp
<div class="form-group {{@$ctrl->width}} grid_gallery_panel panel_{{ $ctrl->value }}" id="gallery_{{$ctrl->name}}" data-title="simple_field_grid_gallery">
    <?php
    if(@$ctrl->att_table!='')
        @$col = 12/count(explode(",", $ctrl->att_table));
    ?>
    <div class="portlet-content" style="width:100% !important;" data-title="simple_field_grid_gallery">
        <div id="m_confirm_gallery_delete{{$name_id}}" class="modal fade" data-backdrop="true">
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
                        <a style="cursor:pointer;" class="btn-yes btn danger p-x-md btn-gallery-item">Có</a>
                    </div>
                </div>
            </div>
        </div>
        <textarea id="{{$name_id}}" name="{{$ctrl->name.@$lang}}" class="form-control content_id" style="display:none"><?=@$row->{$ctrl->value.@$lang}?></textarea>
        <div class="content_{{ $name_id }}">
            <div class="list_item row">
                @php
                    $results_json = json_decode(@$row->{$ctrl->value.@$lang});
                    $item_image = 0;
             @endphp

                @if(@$results_json && is_array($results_json))
                @foreach($results_json as $d)
                @php
                $item_image++;
                @endphp
                <div class="  col-md-2 list_item_row" style="padding:10px;">

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
                    <label class="btn btn-sm info btn_upload" style="padding: 5px !important;" for="{{$ctrl->name}}upload{{    @$item_image}}"><i class="fa fa-upload"></i></label>

                    @if(@$ctrl->read!=1 && !$flg_read)
                    <label class="btn btn-sm warning row_remove  hidden-xs-down pointer" ui-toggle-class="bounce" ui-target="#animate" data-id="m_confirm_gallery_delete{{ $name_id}}">
                        <i class="fa fa-times"></i>
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
                                <label class="col-md-12 row_remove  hidden-sm-up pointer" data-id="m_confirm_gallery_delete{{@$name_id}}">
                                    Xóa
                                    <b>{{    @$d->title}}</b>
                                </label>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
                @endforeach
                @endif
            </div>

            <div class="{{$name_id}}_list_item_default" style="display:none">
                <div class="col-md-2 list_item_row" style="padding:10px; ">
                    <input class="pull-left form-control row_order item" type="text" value="" title="Thứ tự" />

                    <div class="container_avatar">
                        <label class="container">
                            <input type="radio" name="avatar" class="row_avatar" value="" title="Chọn làm ảnh đại diện" />
                            <span class="checkmark"></span>
                        </label>
                    </div>


                    <div class=panel_image ctxdform image" style="text-align:center">
                        <!--<label class="hidden-sm-up">Hình ảnh</label>-->
                        <label for="upload" class="lable_upload" style="text-align:center;width:100%">
                            <input class="form-control row_image item" value="" type="hidden" />
                            <div class="thumb-output">
                                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAANlBMVEX///+/v7+8vLzKysr8/Pzg4ODFxcXb29vT09Pj4+P4+PjBwcH6+vry8vLY2NjIyMjp6eno6Og1AQOEAAAEdUlEQVR4nO2d6ZbCIAxGp3TT1i6+/8uOWrUUwlKsIZ7z3d+dwh0wIYDHvz8AAAAAAAAAAAAAAAAAXqqx+Snq/YYnVfwQqoUhDKUDQxjKB4YwlA8MYSifAwyVNA43PJ2FUR5sqM673/BljP7B0AaG2YFhEBhmB4ZBYJgdGAaBYXZgGASG2YFhEBhmB4ZBYJidDIaXKqWjyfAaXubxsUs7nbvkHu+F1XAuX1vQqmm5RpLTsO61R9WJaRgZDc0Djmb4pOPR8BmezTMqVX7U81jYDIemMFH775glwGY4EseMH8zTNvpPuQw7ewhvJC8Phn6MfZTLcKZOitUpMWXcGp1iQzGXITVJiyK6mwatih9/LkP6tL9PM+zUjvH/ScPlZZGxJq9hk2RYP96lTnFPcxnWpGF52d2ellnjHucyHMhYGh3ydcrX6v0a9TiX4WV76WOhn3c3p8+GMirWsK1pztQkTUiH2uov7h/EZliV1jxVCYu26rS3t3y1xaU3DVMW3puIFRWKGevDudmOYkqV3xWRja1w1viDNlFV2qackVab3X/y7Z2oc9k8dqL6aUzJhH+1Mc9jPsnMu4nVULfjWF/TVmtWFR2TUH9qR9gOxxHFiTDD2Rd9qJVfOB7LMuzU6FYkdnpiVrayDG/vclYMeq7XCMYaUYb3lZ2zsqWrk3ANJcmwmx6voCfqNtdrDYbWDZIMX3s55LC4vvQQbFCQ4buEpMKNmetXQgWKHEO9grQUyTi6EKqh5BhuCkhzrWLn+rXFwLpGjOHQb7u9GUXrVGcziP6EIcbQHCW9tvLM0SJ4wCPF0N71XyefI9e/8ddQQgyJg5v180Xneu1Jb6wRYthSPX92xpXr1za96xoZhoO1h6MpunL9ivccktuwIgu6yTE49+64c/36nC/WcBteS0LRnQzaQBx94quhuHcxSmX3pnMM4Z06PEcL/34Ns+Ft4aJ6Q9H7TeIYvxueax3Mt77ua09lTNQ5TsKLck9TXsNnXt8qxnzQgobuWMNr+EwKSj/7bSMnop/JOYishtd3BVi+Q0NUrAzTOw8TOQ0rrQJ8TdTQmjMW98UFTkO9AnxNVG9dtAdnDcVouD0GVtO9SxW9XEvA2XXO0zVjuO478seEmQd9fkN7uLr5sCF0X1zgM7zawzVR1xeSDR01FOM5/oE2JI4aKutdjGNxdD7rfZqDoQ8Ts94vPRh6v4bL8MCg6WbKaEgE0i+gqGnKY/j9QOruPo/h9wPpAnVJisWQI5AuEK2zGHIE0qV1ooZiMWQJpAv2uobDkCeQLs3bh4kMhkyB9EkOw8PK+Bjs9r9vWI0lJ9Y0ZRjDjhVrV1HG6do3gWEQGGYHhkFgmB0YBoFhdmAYBIbZOdqwqCtZHG/YsFaDEWw3ifDbCDCUDwxhKB8YwlA+MIShfGAIQ/nAEIbygSEM5QNDGMoHhjCUDwxhKB8YwlA+MIShfGAIQ/nAEIbygSEM5QNDGMoHhjCUT5rhT5FgONc/Bc/PuwIAAAAAAAAAAAAAAAAQzD8O4oElgraltwAAAABJRU5ErkJggg==" />
                            </div>
                            <br />
                            <input type="file" id="upload" style="display:none" class="add-file-upload" />
                        </label>

                    </div>
                    @if(@$ctrl->read!=1 && !$flg_read)
                    <label class="btn btn-sm info btn_upload" style="padding: 5px !important;" for="upload">
                        <i class="fa fa-upload"></i>
                    </label>

                    <label class="btn btn-sm warning row_remove  hidden-xs-down pointer" ui-toggle-class="bounce" ui-target="#animate" data-id="m_confirm_gallery_delete{{$ctrl->name}}">
                        <small>
                            <i class="fa fa-times"></i>
                        </small>
                    </label>


                    <label class="btn btn-sm btn_modal_edit" ui-toggle-class="bounce" ui-target="#animate" data-id="m_confirm_gallery_delete{{    $ctrl->name}}">

                        <i class="fa fa-info"></i>
                    </label>
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
                                <div class="col-md-10 row">
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

                            </div>
                        </div>
                    </div>

                </div>

            </div>

            @if(@$ctrl->read!=1 && !$flg_read)
            <div colspan="5" style="padding-top:5px;">
                <input type="number" id="number_plus" value="1" />
                <label class="btn btn-fw primary {{@$ctrl->read==1?" cccccc":"item_add"}}" style="cursor:pointer;">
                    <i class="fa fa-plus"></i>
                    &nbsp; Thêm mới
                </label>

                <input type="file" multiple class="gallery_upload_multiple" />
            </div>
            @endif


        </div>

    </div>

</div>

<link href="{{env_host}}public/plugin/lightbox2/dist/css/lightbox.css" rel="stylesheet" />
<script src="{{env_host}}public/plugin/lightbox2/dist/js/lightbox.js"></script>
<style type="text/css">
    #number_plus{
        width:40px;
    }
    .list_item_row{
        position:relative;
        margin:20px;
        background:#808080;
    }

    .list_item_row .row_order{
        position:absolute;
        top:8px;
        left:8px;

        padding: 5px !important;
        opacity:0.8;
        height:40px;
        width:40px;

        z-index:50;
    }
    .list_item_row .container_avatar{
        position:absolute;
        top:10px;
        right:0px;
        width: 30px; height: 40px;
        z-index:50;
    }
    .list_item_row .panel_image{
        width:100%;
        height:100%;
        z-index:40;
    }
     .thumb-output{
        width:280px ;
        height:210px;
    }
    .list_item_row .panel_image img{
        width:auto;
        height:100%;
    }
    .list_item_row .btn_upload{
        position:absolute;
        bottom:3px;
        left:10px;
        z-index:50;
        margin-bottom:0px;
        color:#0964f5;
        background:#cccccc;
        cursor:pointer;
        width:35px;
        height:35px;
        line-height:32px;
    }

    .list_item_row .btn_modal_edit{
        position:absolute;
        bottom:3px;
        right:10px;
        z-index:50;
        color:#ff6a00;
        background:#cccccc;
        padding-left:15px;
        padding-right:15px;
        cursor:pointer;
        margin-bottom:0px;
        width:35px;
        height:35px;
                padding: 10px;
    }
     .list_item_row .row_remove{
        position:absolute;
        bottom:3px;
        right:60px;
        z-index:50;
        color:#ff0000;
        background:#cccccc;
        padding-left:10px;
        padding-right:10px;
        cursor:pointer;
        margin-bottom:0px;
        width:35px;
        height:35px;
        padding: 10px;
    }
    .list_item_row .btn_modal_edit i,.list_item_row .row_remove i,.list_item_row .btn_upload i{
            font-size: 1.2vw;
    }
     i{
         margin-right:0px !important;
     }

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
            /* The container */
.container {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;

  font-size: 17px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default radio button */
.container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
}

/* Create a custom radio button */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
  border-radius: 50%;
  display:none;
}

/* On mouse-over, add a grey background color */
.container:hover input ~ .checkmark {
  background-color: #ccc;
    cursor: pointer;
}

/* When the radio button is checked, add a blue background */
.container input:checked ~ .checkmark {
  background-color: #e40000;
}

/* Create the indicator (the dot/circle - hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the indicator (dot/circle) when checked */
.container input:checked ~ .checkmark:after {
  display: block;
}

/* Style the indicator (dot/circle) */
.container .checkmark:after {
 	top: 0px;
	left: 5px;
	width: 8px;
	height: 8px;
	border-radius: 50%;
	color: white;
    font-family: "FontAwesome";
    content:"\f00c";

}

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

    .grid_gallery_panel .thumb-output{
        width:100% !important ;
        height:170px;
    }
    .grid_gallery_panel .thumb-output img {

        max-width:100%
    }
    .grid_gallery_panel .thumb-output_icon img {
            max-width:100%
    }
    .btn_upload{

    }
</style>
<script>
    @if(@$ctrl->att_table!='')
	var hiddentab = ".ctxdform";
	$(hiddentab).css("display", "none");
	$('{{".".implode(",.",explode(",", $ctrl->att_table))}}').fadeIn();
    @endif

    var tab = '.content_<?=@$ctrl->value?>';
    var {{$ctrl->value }}_e_avartar = '#<?=@$ctrl->att_where?>';

    $('.row_order').click(function () {
        $(this).focus();
    });

    $(document).on('click', '.btn_modal_edit', function () {
        $(this).parent().find('.list_item_modal').modal('show');
    });


</script>
<script>

    $(document).on('change', '.content_{{$ctrl->value }} .row_avatar', function () {
        var image = $(this).parent().parent().parent().find('.row_image').val();
        var e_avartar = {{$ctrl->value }}_e_avartar;
        if(e_avartar!="#")
            $(e_avartar).val(image);
        {{ $ctrl->value }}_update_galler_content();
    });

    $(document).on('click', '.content_{{ $ctrl->value }} .item_add', function () {
        var number_plus = $('.content_{{$ctrl->value }} #number_plus').val();
        for (var i = 0; i < number_plus; i++) {


            var html = $('.{{$name_id}}_list_item_default');
            var count_image = $('.content_{{ $ctrl->value }} .lable_upload').length + 1;

            $('.content_{{$ctrl->value}} .list_item').append(html.html());

            var html_ele = $(this).parent().parent().parent().find('.list_item > .list_item_row').last();

            html_ele.find('.row_order').val(count_image - 1);

            //image
            html_ele.find('.btn_upload').attr('for', '{{ $ctrl->value }}_upload' + count_image + 1);
            html_ele.find('.lable_upload>.add-file-upload').attr('id', '{{ $ctrl->value }}_upload' + count_image + 1);
            html_ele.find('.lable_upload>.thumb-output').attr('id', '{{ $ctrl->value }}_thumb_upload' + count_image + 1);
            html_ele.find('.lable_upload>.add-file-upload').attr('data-id', '#{{ $ctrl->value }}_thumb_upload' + count_image + 1);

            //icon
            html_ele.find('.lable_upload_icon').attr('for', '{{ $ctrl->value }}_upload_icon' + count_image);
            html_ele.find('.lable_upload_icon>.add-file-upload_icon').attr('id', '{{ $ctrl->value }}_upload_icon' + count_image);
            html_ele.find('.lable_upload_icon>.thumb-output_icon').attr('id', '{{ $ctrl->value }}_thumb_upload_icon' + count_image);
            html_ele.find('.lable_upload_icon>.add-file-upload_icon').attr('data-id', '#{{$ctrl->value }}_thumb_upload_icon' + count_image);

            count_image++;
        }
    });

    var item_chose;
    var popup_id;
    $(document).on('click', '.content_{{ $name_id }} .row_remove', function () {
        item_chose = $(this)
        popup_id = '#' + $(this).attr('data-id');
        if(popup_id!=''){
            $(popup_id).modal('show');
        }


    });
    $(document).on('click', '.panel_{{ $ctrl->value }} .btn-gallery-item', function () {
        var img = item_chose.parent().find('.row_image').val();

        if (img == '') {
            item_chose.parent().remove();
            {{ $ctrl->value }}_update_galler_content();
            //$(popup_id).modal('toggle');
        }
        else {
            $(popup_id).modal('hide');
            $.get("{{url('admin/'.request()->segment(2).'/remove_upload')}}", { image: "{{$admin_group->path_upload.$func->path_upload }}/" + img }, function (data) {
                item_chose.parent().remove();
                {{ $ctrl->value }}_update_galler_content();

            });
        }
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

    //Upload multi
    $(document).on('change', '.content_{{$name_id }} .gallery_upload_multiple', function (e) {
        var id = $('#id').val();
        var tag = $(this);
        if (id == "") {
            var form_data = new FormData();
            form_data.append("_token", '{{ csrf_token() }}');
            form_data.append("result", 'json');
            $.ajax({
                url: "{{url('admin/'.request()->segment(2).'/save')}}",
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'POST',
                success: function (data) {
                    if ($('#id').val() == '')
                        $('#id').val(data.id);
                    upload_multiple(tag,"{{ $ctrl->value }}_update_galler_content","{{ $name_id }}");
                }
            });

        }
        else {
            upload_multiple(tag,"{{ $ctrl->value }}_update_galler_content","{{ $name_id}}");
        }


    });

    function upload_multiple(e,upload_data,content) {
        var files = e[0].files;
        var tag = e;

        for (var i = 0; i < files.length; i++) {

            $('.btn_apply').hide();
            $('.btn_save').hide();
            $('.btn_processing').show();
            $('.btn_processing').html('<i class="fa fa-times"></i>Đang tải ảnh');

            var file_data = files[i];
            var form_data = new FormData();
            form_data.append("file", file_data);
            form_data.append("_token", '{{ csrf_token() }}');
            form_data.append("id", $('#id').val());
            form_data.append("sort", i);
            $.ajax({
                url: "{{url('admin/'.request()->segment(2).'/upload_file')}}",
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'POST',
                success: function (data) {

                    var image = data.image.replace('{{$ctrl->note!=''?$ctrl->note.'/':''}}', '');

                    var html = $('.{{$name_id}}_list_item_default');
                    var count_image = $('.content_{{ $name_id }} .lable_upload').length + 1;
                    tag.parent().parent().find('.list_item').append(html.html());

                    var html_ele = tag.parent().parent().find('.list_item > .list_item_row').last();
                    html_ele.attr('data-position', data.sort);
                    html_ele.find('.row_order').val(count_image - 1);

                    //image
                    html_ele.find('.btn_upload').attr('for', '{{ $ctrl->value }}_upload' + count_image + 1);
                    html_ele.find('.lable_upload>.add-file-upload').attr('id', '{{ $ctrl->value }}_upload' + count_image + 1);
                    html_ele.find('.lable_upload>.row_image').val(image);
                    html_ele.find('.lable_upload>.thumb-output>img').attr('src', "{{$image_path}}" + "/" + image);
                    html_ele.find('.lable_upload>.thumb-output').attr('id', '{{ $ctrl->value }}_thumb_upload' + count_image + 1);
                    html_ele.find('.lable_upload>.add-file-upload').attr('data-id', '#{{ $ctrl->value }}_thumb_upload' + count_image + 1);

                    //icon
                    html_ele.find('.lable_upload_icon').attr('for', '{{ $ctrl->value }}_upload_icon' + count_image);
                    html_ele.find('.lable_upload_icon>.add-file-upload_icon').attr('id', '{{ $ctrl->value }}_upload_icon' + count_image);
                    html_ele.find('.lable_upload_icon>.thumb-output_icon').attr('id', '{{ $ctrl->value }}_thumb_upload_icon' + count_image);
                    html_ele.find('.lable_upload_icon>.add-file-upload_icon').attr('data-id', '#{{$ctrl->value }}_thumb_upload_icon' + count_image);

                    count_image++;
                    $(".content_" + content + " .list_item .list_item_row").sort(sort_li).appendTo(".content_" + content+" .list_item");
                    //{{ $ctrl->value }}_update_galler_content();
                    window[upload_data]();

                    $('.btn_apply').show();
                    $('.btn_save').show();
                    $('.btn_processing').hide();
                }
            });
        };
    }
    function sort_li(a, b) {
        return ($(b).data('position')) < ($(a).data('position')) ? 1 : -1;
    }
    $(document).on('change', '.content_{{$ctrl->value }} .add-file-upload', function () {
		var input_file = $(this).attr('data-id');
         $('.btn_apply').hide();
         $('.btn_save').hide();
         $('.btn_processing').show();
         $('.btn_processing').html('<i class="fa fa-times"></i>Đang tải ảnh');
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
            form_data.append("id", $('#id').val());
            $.ajax({
                url: "{{url('admin/'.request()->segment(2).'/upload_file')}}",
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'POST',
                success: function (data) {

                    var image = data.image;//.replace('{{$ctrl->note!=''?$ctrl->note.'/':''}}','');
                    if($(input_file).parent().find('.row_avatar').prop("checked")==true)
						$(e_avartar).val(image);

                    $(input_file).parent().find('.row_image').val(image);
                    {{$ctrl->value }}_update_galler_content();

                    if($('#id').val()=='')
                        $('#id').val(data.id);

                    $('.btn_apply').show();
                    $('.btn_save').show();
                    $('.btn_processing').hide();
                }
            });
          // {{ $ctrl->value }}_update_galler_content();
    });

    $(document).on('change', '.content_{{ $name_id }} .add-file-upload_icon', function () {
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
        var list = [];
        $('.content_{{$name_id }} .list_item>.list_item_row').each(function () {
            var no = $(this).find('.row_order').val();
            var title = $(this).find('.row_title').val();
            var content = $(this).find('.row_content').val();
            var image = $(this).find('.row_image').val();
            var icon = $(this).find('.row_icon').val();
            var note = $(this).find('.row_note').val();
            var link = $(this).find('.row_link').val();
            var avatar = $(this).find('.row_avatar').prop("checked");
            var obj_detail = {
                no: no,
                avatar:avatar,
                title: title,
                content: content,
                note:note,
                link:link,
                image: image,
                icon: icon
			};
           // if(title!=''||content!=''||image!=''||icon!=''||note!=''||link!='')
            list.push(obj_detail);
        });
        $("#{{$name_id}}").val(JSON.stringify(list));
    }
</script>

