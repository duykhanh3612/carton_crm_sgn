<div class="form-group {{@$ctrl->width}}" >
    <div class="portlet-content" style="width:100% !important;">

        <!--<label class="section_add">
            <h5 >
                <i class="material-icons"></i>Add Section
            </h5>
        </label>-->
        <textarea id="{{$ctrl->name}}" name="{{$ctrl->name.@$lang}}" class="form-control content_id" style="display:none"><?=@$row->{$ctrl->value.@$lang}?></textarea>
        <div class="<?=@$row->{$ctrl->value.@$lang}?>">
            <table class="table table-striped  b-t">
                <thead>
                    <tr>
                        <th style="width:20px;">
                            
                        </th>
                        <th class="ctxdform title"></th>
                        <th class="text-center ctxdform caption"></th>                       
                        <th class="text-center ctxdform note"></th>
                        <th class="text-center ctxdform link"></th>
                        <th class="text-center ctxdform image"></th>
                    </tr>
                </thead>
                <tbody class="list_item">
                    @php
                        $results_json = json_decode(@$row->{$ctrl->value.@$lang});
                        $item_image = 0;
                    @endphp

                    @if(@$results_json)
                    @foreach($results_json as $d)
                    @php
                    $item_image++;
                    @endphp
                    <tr style="border-bottom:1px dashed #2e3e4e">
                        <td>
                            <input class="pull-left form-control row_no item" type="text" value="{{    @$d->no}}" />

                            <em>Vị trí </em>

                            <br />
                            <br />
                            <a class="btn btn-sm info" style="padding-top:5px;display:none;">
                                <small>
                                    <i class='material-icons'>&#xe8d7</i>
                                </small>
                            </a>

                            <button class="btn btn-sm warning row_remove" data-toggle="modal" data-target="#m-1" ui-toggle-class="bounce" ui-target="#animate">
                                <small>
                                    <i class="material-icons"></i>Xóa
                                </small>
                            </button>
                        </td>
                        <td colspan="7">
                            <table class="table">
                                <tr>

                                    <td class="ctxdform title">
                                        <label>Tiêu đề</label>
                                        <textarea class="form-control row_title item" style="width:100%">{{    @$d->title}}</textarea>

                                    </td>
                                    <td class="text-center ctxdform caption">
                                        <label>Mô tả</label>
                                        <textarea class="form-control row_content item" style="width:100%">{{    @$d->content}}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center ctxdform note">
                                        <label>Note</label>
                                        <textarea class="form-control row_note item" style="width:100%">{{    @$d->note}}</textarea>
                                    </td>
                                    <td class="text-center ctxdform link">
                                        <label>Link</label>
                                        <textarea class="form-control row_link item" style="width:100%">{{    @$d->link }}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center ctxdform image">
                                        <label for="upload{{@$item_image}}" class="lable_upload">
                                            <input class="form-control row_image item" value="{{    @$d->image}}" type="hidden" />
                                            <div id="thumb_upload{{@$item_image}}" class="thumb-output">
                                                @if(@$d->image!='')
                                                <img src="{{    url($base.@$d->image)}}" />
                                                @else
                                                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAANlBMVEX///+/v7+8vLzKysr8/Pzg4ODFxcXb29vT09Pj4+P4+PjBwcH6+vry8vLY2NjIyMjp6eno6Og1AQOEAAAEdUlEQVR4nO2d6ZbCIAxGp3TT1i6+/8uOWrUUwlKsIZ7z3d+dwh0wIYDHvz8AAAAAAAAAAAAAAAAAXqqx+Snq/YYnVfwQqoUhDKUDQxjKB4YwlA8MYSifAwyVNA43PJ2FUR5sqM673/BljP7B0AaG2YFhEBhmB4ZBYJgdGAaBYXZgGASG2YFhEBhmB4ZBYJidDIaXKqWjyfAaXubxsUs7nbvkHu+F1XAuX1vQqmm5RpLTsO61R9WJaRgZDc0Djmb4pOPR8BmezTMqVX7U81jYDIemMFH775glwGY4EseMH8zTNvpPuQw7ewhvJC8Phn6MfZTLcKZOitUpMWXcGp1iQzGXITVJiyK6mwatih9/LkP6tL9PM+zUjvH/ScPlZZGxJq9hk2RYP96lTnFPcxnWpGF52d2ellnjHucyHMhYGh3ydcrX6v0a9TiX4WV76WOhn3c3p8+GMirWsK1pztQkTUiH2uov7h/EZliV1jxVCYu26rS3t3y1xaU3DVMW3puIFRWKGevDudmOYkqV3xWRja1w1viDNlFV2qackVab3X/y7Z2oc9k8dqL6aUzJhH+1Mc9jPsnMu4nVULfjWF/TVmtWFR2TUH9qR9gOxxHFiTDD2Rd9qJVfOB7LMuzU6FYkdnpiVrayDG/vclYMeq7XCMYaUYb3lZ2zsqWrk3ANJcmwmx6voCfqNtdrDYbWDZIMX3s55LC4vvQQbFCQ4buEpMKNmetXQgWKHEO9grQUyTi6EKqh5BhuCkhzrWLn+rXFwLpGjOHQb7u9GUXrVGcziP6EIcbQHCW9tvLM0SJ4wCPF0N71XyefI9e/8ddQQgyJg5v180Xneu1Jb6wRYthSPX92xpXr1za96xoZhoO1h6MpunL9ivccktuwIgu6yTE49+64c/36nC/WcBteS0LRnQzaQBx94quhuHcxSmX3pnMM4Z06PEcL/34Ns+Ft4aJ6Q9H7TeIYvxueax3Mt77ua09lTNQ5TsKLck9TXsNnXt8qxnzQgobuWMNr+EwKSj/7bSMnop/JOYishtd3BVi+Q0NUrAzTOw8TOQ0rrQJ8TdTQmjMW98UFTkO9AnxNVG9dtAdnDcVouD0GVtO9SxW9XEvA2XXO0zVjuO478seEmQd9fkN7uLr5sCF0X1zgM7zawzVR1xeSDR01FOM5/oE2JI4aKutdjGNxdD7rfZqDoQ8Ts94vPRh6v4bL8MCg6WbKaEgE0i+gqGnKY/j9QOruPo/h9wPpAnVJisWQI5AuEK2zGHIE0qV1ooZiMWQJpAv2uobDkCeQLs3bh4kMhkyB9EkOw8PK+Bjs9r9vWI0lJ9Y0ZRjDjhVrV1HG6do3gWEQGGYHhkFgmB0YBoFhdmAYBIbZOdqwqCtZHG/YsFaDEWw3ifDbCDCUDwxhKB8YwlA+MIShfGAIQ/nAEIbygSEM5QNDGMoHhjCUDwxhKB8YwlA+MIShfGAIQ/nAEIbygSEM5QNDGMoHhjCUT5rhT5FgONc/Bc/PuwIAAAAAAAAAAAAAAAAQzD8O4oElgraltwAAAABJRU5ErkJggg==" />

                                                @endif
                                            </div>
                                            <input type="file" id="upload{{@$item_image}}" data-id="#thumb_upload{{    @$item_image}}" style="display:none" class="add-file-upload" />
                                            <em>Hình ảnh</em>
                                        </label>

                                    </td>
                                    <td class="text-center ctxdform icon">
                                        <label for="upload_icon{{@$item_image}}" class="lable_upload_icon">
                                            <input class="form-control row_icon item" value="{{@$d->icon}}" type="hidden" />
                                            <div id="thumb_upload_icon{{@$item_image}}" class="thumb-output_icon">
                                                @if(@$d->icon!='')
                                                <img src="{{url('public/vinhomes/'.@$d->icon)}}" />
                                                @else
                                                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAANlBMVEX///+/v7+8vLzKysr8/Pzg4ODFxcXb29vT09Pj4+P4+PjBwcH6+vry8vLY2NjIyMjp6eno6Og1AQOEAAAEdUlEQVR4nO2d6ZbCIAxGp3TT1i6+/8uOWrUUwlKsIZ7z3d+dwh0wIYDHvz8AAAAAAAAAAAAAAAAAXqqx+Snq/YYnVfwQqoUhDKUDQxjKB4YwlA8MYSifAwyVNA43PJ2FUR5sqM673/BljP7B0AaG2YFhEBhmB4ZBYJgdGAaBYXZgGASG2YFhEBhmB4ZBYJidDIaXKqWjyfAaXubxsUs7nbvkHu+F1XAuX1vQqmm5RpLTsO61R9WJaRgZDc0Djmb4pOPR8BmezTMqVX7U81jYDIemMFH775glwGY4EseMH8zTNvpPuQw7ewhvJC8Phn6MfZTLcKZOitUpMWXcGp1iQzGXITVJiyK6mwatih9/LkP6tL9PM+zUjvH/ScPlZZGxJq9hk2RYP96lTnFPcxnWpGF52d2ellnjHucyHMhYGh3ydcrX6v0a9TiX4WV76WOhn3c3p8+GMirWsK1pztQkTUiH2uov7h/EZliV1jxVCYu26rS3t3y1xaU3DVMW3puIFRWKGevDudmOYkqV3xWRja1w1viDNlFV2qackVab3X/y7Z2oc9k8dqL6aUzJhH+1Mc9jPsnMu4nVULfjWF/TVmtWFR2TUH9qR9gOxxHFiTDD2Rd9qJVfOB7LMuzU6FYkdnpiVrayDG/vclYMeq7XCMYaUYb3lZ2zsqWrk3ANJcmwmx6voCfqNtdrDYbWDZIMX3s55LC4vvQQbFCQ4buEpMKNmetXQgWKHEO9grQUyTi6EKqh5BhuCkhzrWLn+rXFwLpGjOHQb7u9GUXrVGcziP6EIcbQHCW9tvLM0SJ4wCPF0N71XyefI9e/8ddQQgyJg5v180Xneu1Jb6wRYthSPX92xpXr1za96xoZhoO1h6MpunL9ivccktuwIgu6yTE49+64c/36nC/WcBteS0LRnQzaQBx94quhuHcxSmX3pnMM4Z06PEcL/34Ns+Ft4aJ6Q9H7TeIYvxueax3Mt77ua09lTNQ5TsKLck9TXsNnXt8qxnzQgobuWMNr+EwKSj/7bSMnop/JOYishtd3BVi+Q0NUrAzTOw8TOQ0rrQJ8TdTQmjMW98UFTkO9AnxNVG9dtAdnDcVouD0GVtO9SxW9XEvA2XXO0zVjuO478seEmQd9fkN7uLr5sCF0X1zgM7zawzVR1xeSDR01FOM5/oE2JI4aKutdjGNxdD7rfZqDoQ8Ts94vPRh6v4bL8MCg6WbKaEgE0i+gqGnKY/j9QOruPo/h9wPpAnVJisWQI5AuEK2zGHIE0qV1ooZiMWQJpAv2uobDkCeQLs3bh4kMhkyB9EkOw8PK+Bjs9r9vWI0lJ9Y0ZRjDjhVrV1HG6do3gWEQGGYHhkFgmB0YBoFhdmAYBIbZOdqwqCtZHG/YsFaDEWw3ifDbCDCUDwxhKB8YwlA+MIShfGAIQ/nAEIbygSEM5QNDGMoHhjCUDwxhKB8YwlA+MIShfGAIQ/nAEIbygSEM5QNDGMoHhjCUT5rhT5FgONc/Bc/PuwIAAAAAAAAAAAAAAAAQzD8O4oElgraltwAAAABJRU5ErkJggg==" />

                                                @endif
                                            </div>
                                            <input type="file" id="upload_icon{{@$item_image}}" data-id="#thumb_upload_icon{{@$item_image}}" style="display:none" class="add-file-upload_icon" />
                                            <em>Icon</em>
                                        </label>

                                    </td>
                                </tr>
                                <tr style="display:none">
                                    <td></td>
                                    <td colspan="5">
                                        @include                    (_alias_admin.'::sys.template.normal.edit.gallery.dropzone')
                                    </td>
                                </tr>
                            </table>
                        </td>


                    </tr>
                    @endforeach
                    @endif
                </tbody>
                <tbody class="list_item_default" style="display:none">
                    <tr>
                        <td>
                            <input class="pull-left form-control row_no item" id="row_no" name="row_no_1" value="1" type="text" />
                        </td>
                        <td class="text-center ctxdform title">

                            <textarea class="form-control row_title item" style="width:100%"></textarea>

                        </td>
                        <td class="text-center ctxdform caption">
                            <textarea class="form-control row_content item" style="width:100%"></textarea>
                        </td>
                    
                        <td class="text-center ctxdform note">
                            <textarea class="form-control row_note item" style="width:100%">{{@$d->note}}</textarea>
                        </td>
                        <td class="text-center ctxdform link">
                            <textarea class="form-control row_link item" style="width:100%">{{@$d->link }}</textarea>
                        </td>
                        
                        <td class="text-center ctxdform image">
                            <label for="upload" class="lable_upload">
                                <input class="form-control row_image item" value="" type="hidden" />
                                <div class="thumb-output">
                                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAANlBMVEX///+/v7+8vLzKysr8/Pzg4ODFxcXb29vT09Pj4+P4+PjBwcH6+vry8vLY2NjIyMjp6eno6Og1AQOEAAAEdUlEQVR4nO2d6ZbCIAxGp3TT1i6+/8uOWrUUwlKsIZ7z3d+dwh0wIYDHvz8AAAAAAAAAAAAAAAAAXqqx+Snq/YYnVfwQqoUhDKUDQxjKB4YwlA8MYSifAwyVNA43PJ2FUR5sqM673/BljP7B0AaG2YFhEBhmB4ZBYJgdGAaBYXZgGASG2YFhEBhmB4ZBYJidDIaXKqWjyfAaXubxsUs7nbvkHu+F1XAuX1vQqmm5RpLTsO61R9WJaRgZDc0Djmb4pOPR8BmezTMqVX7U81jYDIemMFH775glwGY4EseMH8zTNvpPuQw7ewhvJC8Phn6MfZTLcKZOitUpMWXcGp1iQzGXITVJiyK6mwatih9/LkP6tL9PM+zUjvH/ScPlZZGxJq9hk2RYP96lTnFPcxnWpGF52d2ellnjHucyHMhYGh3ydcrX6v0a9TiX4WV76WOhn3c3p8+GMirWsK1pztQkTUiH2uov7h/EZliV1jxVCYu26rS3t3y1xaU3DVMW3puIFRWKGevDudmOYkqV3xWRja1w1viDNlFV2qackVab3X/y7Z2oc9k8dqL6aUzJhH+1Mc9jPsnMu4nVULfjWF/TVmtWFR2TUH9qR9gOxxHFiTDD2Rd9qJVfOB7LMuzU6FYkdnpiVrayDG/vclYMeq7XCMYaUYb3lZ2zsqWrk3ANJcmwmx6voCfqNtdrDYbWDZIMX3s55LC4vvQQbFCQ4buEpMKNmetXQgWKHEO9grQUyTi6EKqh5BhuCkhzrWLn+rXFwLpGjOHQb7u9GUXrVGcziP6EIcbQHCW9tvLM0SJ4wCPF0N71XyefI9e/8ddQQgyJg5v180Xneu1Jb6wRYthSPX92xpXr1za96xoZhoO1h6MpunL9ivccktuwIgu6yTE49+64c/36nC/WcBteS0LRnQzaQBx94quhuHcxSmX3pnMM4Z06PEcL/34Ns+Ft4aJ6Q9H7TeIYvxueax3Mt77ua09lTNQ5TsKLck9TXsNnXt8qxnzQgobuWMNr+EwKSj/7bSMnop/JOYishtd3BVi+Q0NUrAzTOw8TOQ0rrQJ8TdTQmjMW98UFTkO9AnxNVG9dtAdnDcVouD0GVtO9SxW9XEvA2XXO0zVjuO478seEmQd9fkN7uLr5sCF0X1zgM7zawzVR1xeSDR01FOM5/oE2JI4aKutdjGNxdD7rfZqDoQ8Ts94vPRh6v4bL8MCg6WbKaEgE0i+gqGnKY/j9QOruPo/h9wPpAnVJisWQI5AuEK2zGHIE0qV1ooZiMWQJpAv2uobDkCeQLs3bh4kMhkyB9EkOw8PK+Bjs9r9vWI0lJ9Y0ZRjDjhVrV1HG6do3gWEQGGYHhkFgmB0YBoFhdmAYBIbZOdqwqCtZHG/YsFaDEWw3ifDbCDCUDwxhKB8YwlA+MIShfGAIQ/nAEIbygSEM5QNDGMoHhjCUDwxhKB8YwlA+MIShfGAIQ/nAEIbygSEM5QNDGMoHhjCUT5rhT5FgONc/Bc/PuwIAAAAAAAAAAAAAAAAQzD8O4oElgraltwAAAABJRU5ErkJggg==" />
                                </div>
                                <input type="file" id="upload" style="display:none" class="add-file-upload" />
                            </label>

                        </td>
                        <td class="text-center ctxdform icon">
                            <label for="upload_icon" class="lable_upload_icon">
                                <input class="form-control row_icon item" value="" type="hidden" />
                                <div class="thumb-output_icon">
                                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAANlBMVEX///+/v7+8vLzKysr8/Pzg4ODFxcXb29vT09Pj4+P4+PjBwcH6+vry8vLY2NjIyMjp6eno6Og1AQOEAAAEdUlEQVR4nO2d6ZbCIAxGp3TT1i6+/8uOWrUUwlKsIZ7z3d+dwh0wIYDHvz8AAAAAAAAAAAAAAAAAXqqx+Snq/YYnVfwQqoUhDKUDQxjKB4YwlA8MYSifAwyVNA43PJ2FUR5sqM673/BljP7B0AaG2YFhEBhmB4ZBYJgdGAaBYXZgGASG2YFhEBhmB4ZBYJidDIaXKqWjyfAaXubxsUs7nbvkHu+F1XAuX1vQqmm5RpLTsO61R9WJaRgZDc0Djmb4pOPR8BmezTMqVX7U81jYDIemMFH775glwGY4EseMH8zTNvpPuQw7ewhvJC8Phn6MfZTLcKZOitUpMWXcGp1iQzGXITVJiyK6mwatih9/LkP6tL9PM+zUjvH/ScPlZZGxJq9hk2RYP96lTnFPcxnWpGF52d2ellnjHucyHMhYGh3ydcrX6v0a9TiX4WV76WOhn3c3p8+GMirWsK1pztQkTUiH2uov7h/EZliV1jxVCYu26rS3t3y1xaU3DVMW3puIFRWKGevDudmOYkqV3xWRja1w1viDNlFV2qackVab3X/y7Z2oc9k8dqL6aUzJhH+1Mc9jPsnMu4nVULfjWF/TVmtWFR2TUH9qR9gOxxHFiTDD2Rd9qJVfOB7LMuzU6FYkdnpiVrayDG/vclYMeq7XCMYaUYb3lZ2zsqWrk3ANJcmwmx6voCfqNtdrDYbWDZIMX3s55LC4vvQQbFCQ4buEpMKNmetXQgWKHEO9grQUyTi6EKqh5BhuCkhzrWLn+rXFwLpGjOHQb7u9GUXrVGcziP6EIcbQHCW9tvLM0SJ4wCPF0N71XyefI9e/8ddQQgyJg5v180Xneu1Jb6wRYthSPX92xpXr1za96xoZhoO1h6MpunL9ivccktuwIgu6yTE49+64c/36nC/WcBteS0LRnQzaQBx94quhuHcxSmX3pnMM4Z06PEcL/34Ns+Ft4aJ6Q9H7TeIYvxueax3Mt77ua09lTNQ5TsKLck9TXsNnXt8qxnzQgobuWMNr+EwKSj/7bSMnop/JOYishtd3BVi+Q0NUrAzTOw8TOQ0rrQJ8TdTQmjMW98UFTkO9AnxNVG9dtAdnDcVouD0GVtO9SxW9XEvA2XXO0zVjuO478seEmQd9fkN7uLr5sCF0X1zgM7zawzVR1xeSDR01FOM5/oE2JI4aKutdjGNxdD7rfZqDoQ8Ts94vPRh6v4bL8MCg6WbKaEgE0i+gqGnKY/j9QOruPo/h9wPpAnVJisWQI5AuEK2zGHIE0qV1ooZiMWQJpAv2uobDkCeQLs3bh4kMhkyB9EkOw8PK+Bjs9r9vWI0lJ9Y0ZRjDjhVrV1HG6do3gWEQGGYHhkFgmB0YBoFhdmAYBIbZOdqwqCtZHG/YsFaDEWw3ifDbCDCUDwxhKB8YwlA+MIShfGAIQ/nAEIbygSEM5QNDGMoHhjCUDwxhKB8YwlA+MIShfGAIQ/nAEIbygSEM5QNDGMoHhjCUT5rhT5FgONc/Bc/PuwIAAAAAAAAAAAAAAAAQzD8O4oElgraltwAAAABJRU5ErkJggg==" />
                                </div>
                                <input type="file" id="upload_icon" style="display:none" class="add-file-upload_icon" />
                            </label>

                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm warning row_remove" data-toggle="modal" data-target="#m-1" ui-toggle-class="bounce" ui-target="#animate">
                                <small>
                                    <i class="material-icons"></i>Xóa
                                </small>
                            </button>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5">
                            <label class="btn btn-fw primary item_add" style="cursor:pointer">
                                <i class="material-icons"></i>
                                &nbsp; Thêm record
                            </label>
                        </td>
                    </tr>
                </tfoot>
            </table>


        </div>
        
    </div>

</div>
<script>
    @if($ctrl->att_table!='')
	var hiddentab = ".ctxdform";
	$(hiddentab).css("display", "none");
	$('{{".".implode(",.",explode(",", $ctrl->att_table))}}').fadeIn();
    @endif

    $(document).on('click', '.item_add', function () {
        var html = $('.list_item_default');
        var count_image = $('.lable_upload').length + 1;
        $(this).parent().parent().parent().parent().find('.list_item').append(html.html());
        var html_ele = $(this).parent().parent().parent().parent().find('.list_item>tr').last();

        //image
        html_ele.find('.lable_upload').attr('for', 'upload' + count_image);
        html_ele.find('.lable_upload>.add-file-upload').attr('id', 'upload' + count_image);
        html_ele.find('.lable_upload>.thumb-output').attr('id', 'thumb_upload' + count_image);
        html_ele.find('.lable_upload>.add-file-upload').attr('data-id', '#thumb_upload' + count_image);

        //icon
        html_ele.find('.lable_upload_icon').attr('for', 'upload_icon' + count_image);
        html_ele.find('.lable_upload_icon>.add-file-upload_icon').attr('id', 'upload_icon' + count_image);
        html_ele.find('.lable_upload_icon>.thumb-output_icon').attr('id', 'thumb_upload_icon' + count_image);
        html_ele.find('.lable_upload_icon>.add-file-upload_icon').attr('data-id', '#thumb_upload_icon' + count_image);

       // count_image++;
    });
    $(document).on('change', '.section_title', function () {
        $(this).parent().parent().parent().parent().parent().parent().parent().find('em').html($(this).val());
    });
    $(document).on('click', '.row_remove', function () {
        $(this).parent().parent().remove();
        update_galler_content();
    });
    $(document).on('change', '.item', function () {
        update_galler_content();
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

    $(document).on('change', '.section_add-file-upload', function () {
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
                    $(input_file).parent().find('.section_images').val(image);
                    update_galler_content();
                }
            });

    });


    $(document).on('change', '.add-file-upload', function () {
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
                    $(input_file).parent().find('.row_image').val(image);
                    update_galler_content();
                }
            });
            update_galler_content();
    });

    $(document).on('change', '.add-file-upload_icon', function () {
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
                    update_galler_content();
                }
            });

    });
    function update_galler_content() {
        var list=[];
        $('.list_item>tr').each(function () {
            var no = $(this).find('.row_no').val();
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
        $('.content_id').val(JSON.stringify(list));
    }
</script>
<style type="text/css">
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