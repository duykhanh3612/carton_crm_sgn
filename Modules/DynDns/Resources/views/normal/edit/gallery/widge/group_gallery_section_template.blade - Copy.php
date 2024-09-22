<div class="form-group" id="section_template"  style="display:none">
    <label class="col-sm-12">
        <h6>
            <label></label>
            <em></em>
        </h6>
    </label>
    <div class="box nav-active-border b-info" style="width:100% !important;">
        <ul class="nav nav-md">
            <li class="nav-item inline">
                <a class="nav-link tab_detail active" href="" data-toggle="tab" data-target="#section_details" aria-expanded="false">
                    <span class="text-md">
                        <i class="material-icons">
                            
                        </i>Chi tiết Section
                    </span>
                </a>
            </li>
            <li class="nav-item inline  section_e section_tab_slider">
                <a class="nav-link tab_custom" href="" data-toggle="tab" data-target="#section_custom" aria-expanded="false">
                    <span class="text-md">
                        <i class="material-icons">
                            
                        </i>Slider
                    </span>
                </a>
            </li>
        </ul>
        <div class="tab-content clear b-t">
            <div class="tab-pane active section_details" id="section_details" aria-expanded="false">
                <div class="box-body">
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 form-control-label">Lọai</label>
                        <div class="col-sm-10">

                            <select class="form-control has-value section_type item">
                                <option>Chọn Type Section</option>
                                @php
                                $arr  = array('11'=>'Giới thiệu',
                                '12'=>'Tọa độ','13'=>'Mặt bằng',
                                '14'=>'Tiện ích',
                                '15'=>'Thư viện','16'=>'Tin tức'
                                ,'17'=>'Đai lý','18'=>'Liên hệ')
                                @endphp
                                @foreach($arr as $v=>$k)
                                <option value="{{$v}}" {{$v==@$r->type?'selected':''}} data-section="sec_{{$section_count}}">{{$k}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 form-control-label">Tiêu đề section</label>
                        <div class="col-sm-10">
                            <input placeholder="title" class="form-control has-value section_title item" required="" name="" value="" type="text" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 form-control-label">Mô tả section</label>
                        <div class="col-sm-10">
                            <input placeholder="caption" class="form-control has-value  section_caption item" required="" name="name" value="" type="text" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 form-control-label">Nội dung section</label>
                        <div class="col-sm-10">
                            <!--                                    <input placeholder="content" ui-jp="summernote" dir="backLang.ltr" ui-options="{height: 150,callbacks: {
                                                                        onImageUpload: function(files, editor, welEditable) {
                                                                        sendFile(files[0], editor, welEditable,1);
                                                                        }
                                                                        }}"
                                                                    class="form-control summernote_en  has-value section_content item" required="" name="name" value="" type="text" />
                            -->
                            <input placeholder="content" class="form-control    has-value section_content item" style="height:70px;" required="" name="name" value="" type="text" />
                            <label class="btn success pop-summernote" data-id="">Open Editor</label>
                        </div>
                    </div>
                    <div class="form-group row section_e section_link">
                        <label for="name" class="col-sm-2 form-control-label">Link</label>
                        <div class="col-sm-10">
                            <input placeholder="link" class="form-control has-value section_link item" required="" name="name" value="" type="text" />
                        </div>
                    </div>
                    <div class="form-group row section_e section_image">
                        <label for="name" class="col-sm-2 form-control-label">Image</label>
                        <div class="col-sm-10">
                            <label for="section_upload" class="lable_upload">
                                <input class="form-control section_images item" value="" type="hidden" />
                                <div id="section_thumb_upload" class="thumb-output">
   
                                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAANlBMVEX///+/v7+8vLzKysr8/Pzg4ODFxcXb29vT09Pj4+P4+PjBwcH6+vry8vLY2NjIyMjp6eno6Og1AQOEAAAEdUlEQVR4nO2d6ZbCIAxGp3TT1i6+/8uOWrUUwlKsIZ7z3d+dwh0wIYDHvz8AAAAAAAAAAAAAAAAAXqqx+Snq/YYnVfwQqoUhDKUDQxjKB4YwlA8MYSifAwyVNA43PJ2FUR5sqM673/BljP7B0AaG2YFhEBhmB4ZBYJgdGAaBYXZgGASG2YFhEBhmB4ZBYJidDIaXKqWjyfAaXubxsUs7nbvkHu+F1XAuX1vQqmm5RpLTsO61R9WJaRgZDc0Djmb4pOPR8BmezTMqVX7U81jYDIemMFH775glwGY4EseMH8zTNvpPuQw7ewhvJC8Phn6MfZTLcKZOitUpMWXcGp1iQzGXITVJiyK6mwatih9/LkP6tL9PM+zUjvH/ScPlZZGxJq9hk2RYP96lTnFPcxnWpGF52d2ellnjHucyHMhYGh3ydcrX6v0a9TiX4WV76WOhn3c3p8+GMirWsK1pztQkTUiH2uov7h/EZliV1jxVCYu26rS3t3y1xaU3DVMW3puIFRWKGevDudmOYkqV3xWRja1w1viDNlFV2qackVab3X/y7Z2oc9k8dqL6aUzJhH+1Mc9jPsnMu4nVULfjWF/TVmtWFR2TUH9qR9gOxxHFiTDD2Rd9qJVfOB7LMuzU6FYkdnpiVrayDG/vclYMeq7XCMYaUYb3lZ2zsqWrk3ANJcmwmx6voCfqNtdrDYbWDZIMX3s55LC4vvQQbFCQ4buEpMKNmetXQgWKHEO9grQUyTi6EKqh5BhuCkhzrWLn+rXFwLpGjOHQb7u9GUXrVGcziP6EIcbQHCW9tvLM0SJ4wCPF0N71XyefI9e/8ddQQgyJg5v180Xneu1Jb6wRYthSPX92xpXr1za96xoZhoO1h6MpunL9ivccktuwIgu6yTE49+64c/36nC/WcBteS0LRnQzaQBx94quhuHcxSmX3pnMM4Z06PEcL/34Ns+Ft4aJ6Q9H7TeIYvxueax3Mt77ua09lTNQ5TsKLck9TXsNnXt8qxnzQgobuWMNr+EwKSj/7bSMnop/JOYishtd3BVi+Q0NUrAzTOw8TOQ0rrQJ8TdTQmjMW98UFTkO9AnxNVG9dtAdnDcVouD0GVtO9SxW9XEvA2XXO0zVjuO478seEmQd9fkN7uLr5sCF0X1zgM7zawzVR1xeSDR01FOM5/oE2JI4aKutdjGNxdD7rfZqDoQ8Ts94vPRh6v4bL8MCg6WbKaEgE0i+gqGnKY/j9QOruPo/h9wPpAnVJisWQI5AuEK2zGHIE0qV1ooZiMWQJpAv2uobDkCeQLs3bh4kMhkyB9EkOw8PK+Bjs9r9vWI0lJ9Y0ZRjDjhVrV1HG6do3gWEQGGYHhkFgmB0YBoFhdmAYBIbZOdqwqCtZHG/YsFaDEWw3ifDbCDCUDwxhKB8YwlA+MIShfGAIQ/nAEIbygSEM5QNDGMoHhjCUDwxhKB8YwlA+MIShfGAIQ/nAEIbygSEM5QNDGMoHhjCUT5rhT5FgONc/Bc/PuwIAAAAAAAAAAAAAAAAQzD8O4oElgraltwAAAABJRU5ErkJggg==" />

                                   
                                </div>
                                <input type="file" id="section_upload" data-id="#section_thumb_upload" style="display:none" class="section_add-file-upload" />
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane section_custom" id="section_custom" aria-expanded="false">
                <table class="table table-striped  b-t">
                    <thead>
                        <tr>
                            <th style="width:20px;">
                                <label class="ui-check m-a-0">
                                    <input id="checkAll" type="checkbox" />
                                    <i></i>
                                </label>
                            </th>
                            <th>Tiêu đề</th>
                            <th class="text-center">Mô tả</th>
                            <th class="text-center">Hình ảnh</th>
                            <th class="text-center" style="width:200px;">Tùy chọn</th>
                        </tr>
                    </thead>
                    <tbody class="list_item"></tbody>
                    <tbody class="list_item_default" style="display:none">
                        <tr>
                            <td>
                                <!--<label class="ui-check m-a-0">
                                    <input name="ids[]" value="1" type="checkbox" />
                                    <i class="dark-white"></i>
                                    <input class="form-control row_no" name="row_ids[]" value="1" type="hidden" />
                                </label>-->
                                <input class="pull-left form-control row_no item" id="row_no" name="row_no_1" value="1" type="text" />

                            </td>
                            <td>

                                <textarea class="form-control row_title item" style="width:100%"></textarea>

                            </td>
                            <td class="text-center">
                                <textarea class="form-control row_content item" style="width:100%"></textarea>
                            </td>
                            <td>

                                <!--<input for="inputGroupFile01"  type="file" />-->
                                <label for="upload" class="lable_upload">
                                    <input class="form-control row_image item" value="" type="hidden" />
                                    <div class="thumb-output">
                                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAANlBMVEX///+/v7+8vLzKysr8/Pzg4ODFxcXb29vT09Pj4+P4+PjBwcH6+vry8vLY2NjIyMjp6eno6Og1AQOEAAAEdUlEQVR4nO2d6ZbCIAxGp3TT1i6+/8uOWrUUwlKsIZ7z3d+dwh0wIYDHvz8AAAAAAAAAAAAAAAAAXqqx+Snq/YYnVfwQqoUhDKUDQxjKB4YwlA8MYSifAwyVNA43PJ2FUR5sqM673/BljP7B0AaG2YFhEBhmB4ZBYJgdGAaBYXZgGASG2YFhEBhmB4ZBYJidDIaXKqWjyfAaXubxsUs7nbvkHu+F1XAuX1vQqmm5RpLTsO61R9WJaRgZDc0Djmb4pOPR8BmezTMqVX7U81jYDIemMFH775glwGY4EseMH8zTNvpPuQw7ewhvJC8Phn6MfZTLcKZOitUpMWXcGp1iQzGXITVJiyK6mwatih9/LkP6tL9PM+zUjvH/ScPlZZGxJq9hk2RYP96lTnFPcxnWpGF52d2ellnjHucyHMhYGh3ydcrX6v0a9TiX4WV76WOhn3c3p8+GMirWsK1pztQkTUiH2uov7h/EZliV1jxVCYu26rS3t3y1xaU3DVMW3puIFRWKGevDudmOYkqV3xWRja1w1viDNlFV2qackVab3X/y7Z2oc9k8dqL6aUzJhH+1Mc9jPsnMu4nVULfjWF/TVmtWFR2TUH9qR9gOxxHFiTDD2Rd9qJVfOB7LMuzU6FYkdnpiVrayDG/vclYMeq7XCMYaUYb3lZ2zsqWrk3ANJcmwmx6voCfqNtdrDYbWDZIMX3s55LC4vvQQbFCQ4buEpMKNmetXQgWKHEO9grQUyTi6EKqh5BhuCkhzrWLn+rXFwLpGjOHQb7u9GUXrVGcziP6EIcbQHCW9tvLM0SJ4wCPF0N71XyefI9e/8ddQQgyJg5v180Xneu1Jb6wRYthSPX92xpXr1za96xoZhoO1h6MpunL9ivccktuwIgu6yTE49+64c/36nC/WcBteS0LRnQzaQBx94quhuHcxSmX3pnMM4Z06PEcL/34Ns+Ft4aJ6Q9H7TeIYvxueax3Mt77ua09lTNQ5TsKLck9TXsNnXt8qxnzQgobuWMNr+EwKSj/7bSMnop/JOYishtd3BVi+Q0NUrAzTOw8TOQ0rrQJ8TdTQmjMW98UFTkO9AnxNVG9dtAdnDcVouD0GVtO9SxW9XEvA2XXO0zVjuO478seEmQd9fkN7uLr5sCF0X1zgM7zawzVR1xeSDR01FOM5/oE2JI4aKutdjGNxdD7rfZqDoQ8Ts94vPRh6v4bL8MCg6WbKaEgE0i+gqGnKY/j9QOruPo/h9wPpAnVJisWQI5AuEK2zGHIE0qV1ooZiMWQJpAv2uobDkCeQLs3bh4kMhkyB9EkOw8PK+Bjs9r9vWI0lJ9Y0ZRjDjhVrV1HG6do3gWEQGGYHhkFgmB0YBoFhdmAYBIbZOdqwqCtZHG/YsFaDEWw3ifDbCDCUDwxhKB8YwlA+MIShfGAIQ/nAEIbygSEM5QNDGMoHhjCUDwxhKB8YwlA+MIShfGAIQ/nAEIbygSEM5QNDGMoHhjCUT5rhT5FgONc/Bc/PuwIAAAAAAAAAAAAAAAAQzD8O4oElgraltwAAAABJRU5ErkJggg==" />
                                    </div>
                                    <input type="file" id="upload" style="display:none" class="add-file-upload" />
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
    <hr style="width:100% important!;clear:both" />
</div>