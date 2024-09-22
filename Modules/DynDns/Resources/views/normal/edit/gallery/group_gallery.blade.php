<div class="form-group {{$ctrl->width}}" >
    <!--<label>
        {{$ctrl->title }} 
    </label>-->

    <div class="portlet-content" style="width:100% !important;">

        <!--<label class="section_add">
            <h5 >
                <i class="material-icons"></i>Add Section
            </h5>
        </label>-->
        <textarea id="{{$ctrl->name}}" name="{{$ctrl->name.@$lang}}" class="form-control content_id" style="display:none"><?=@$row->{$ctrl->value.@$lang}?></textarea>
        <div class="">
            @php

            $results_json = json_decode(@$row->{$ctrl->value.@$lang},true);
            $results = h::array_onegroup_field_v1($results_json,'title','content');

            
            $section_count =0 ;
            $item_image = 0;
            @endphp
           
            @include(_alias_admin."::sys.template.normal.edit.gallery.widge.group_gallery_summernote")
            <div class="col-sm-10 col-lg-10 setion_content">
                @if(@$results['section'])
                @foreach($results['section'] as $se)
                @php
                $r = (object)$se;
                $section_count++;

                @endphp
                    <div class="form-group section_item" id="sec_{{$section_count}}">
                        <label style="width:100%">
                            <h6>
                                <label>Section {{$section_count}}:</label>
                                <em>{{ strip_tags(@$r->title)}}</em>
                            </h6>
                        </label>
                        <div class="box nav-active-border b-info section_e" style="width:100% !important;">
                            <ul class="nav nav-md">
                                <li class="nav-item inline">
                                    <a class="nav-link tab_detail active" href="" data-toggle="tab" data-target="#section_details{{$section_count}}" aria-expanded="false">
                                        <span class="text-md">
                                            <i class="material-icons">
                                                
                                            </i>Chi tiết Section
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item inline  section_e section_tab_slider">
                                    <a class="nav-link tab_custom" href="" data-toggle="tab" data-target="#section_custom{{    $section_count}}" aria-expanded="false">
                                        <span class="text-md">
                                            <i class="material-icons">
                                                
                                            </i>Slider
                                        </span>
                                    </a>
                                </li>
                                <li class="av-item inline pull-right" >
                                    <a class="nav-link tab_custom section_remove" aria-expanded="false">
                                        <span class="text-md">
                                            <button class="btn danger" style="padding:0px 2px;"><i class=" material-icons"></i></button>
                                            Xóa Setion [<em>{{ substr(@$r->title,0,15)}} </em>]
                                        </span>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content clear b-t" style="width:100%">
                                <div class="tab-pane active section_e section_details" id="section_details{{    $section_count}}" aria-expanded="false">
                                    <div class="box-body">
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-2 form-control-label">Lọai</label>
                                            <div class="col-sm-10">

                                                <select class="form-control has-value section_type item " >
                                                    <option>Chọn Type Section</option>
                                                    @php
                                                    $arr  = array('11'=>'Giới thiệu',
                                                    '12'=>'Tọa độ','13'=>'Mặt bằng',
                                                    '14'=>'Tiện ích',
                                                    '15'=>'Thư viện','16'=>'Tin tức'
                                                    ,'17'=>'Đai lý','18'=>'Liên hệ')
                                                    @endphp
                                                    @foreach($arr as $v=>$k)
                                                    <option value="{{$v}}" {{$v==@$r->type?'selected':''}} data-section="sec_{{$section_count}}" >{{$k}}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row section_e">
                                            <label for="name" class="col-sm-2 form-control-label">Tiêu đề section</label>
                                            <div class="col-sm-10">
                                                <input placeholder="title" class="form-control has-value section_title item" required="" value="{{    @$r->title}}" type="text" />
                                            </div>
                                        </div>
                                        <div class="form-group row section_e">
                                            <label for="name" class="col-sm-2 form-control-label">Mô tả section</label>
                                            <div class="col-sm-10">
                                                <input placeholder="caption" class="form-control has-value  section_caption item" required="" name="name" value="{{   @$r->caption}}" type="text" />
                                            </div>
                                        </div>
                                        <div class="form-group row section_e">
                                            <label for="name" class="col-sm-2 form-control-label">Nội dung section
                                                <br/>
                                            
                                            </label>
                                            <div class="col-sm-10">
                                                <!--<input placeholder="content" ui-jp="summernote" dir="backLang.ltr" ui-options="{height: 150,callbacks: {
                                                onImageUpload: function(files, editor, welEditable) {
                                                sendFilegroup_gallery(files[0], editor, welEditable,1,this);
                                                }
                                                }}"
                                                    class="form-control summernote_en  has-value section_content item" required="" name="name" value="{{    @$r->content}}" type="text" />-->
                                                <input placeholder="content"  class="form-control    has-value section_content item" style="height:70px;" required="" name="name" value="{{    @$r->content}}" type="text" />
                                                <label class="btn success pop-summernote" data-id="">Open Editor</label>
                                            </div>
                                        </div>
                                        <div class="form-group row section_e section_link">
                                            <label for="name" class="col-sm-2 form-control-label">Link</label>
                                            <div class="col-sm-10">
                                                <input placeholder="link" class="form-control has-value section_link item" required="" name="name" value="{{    @$r->link}}" type="text" />
                                            </div>
                                        </div>
                                        <div class="form-group row section_e section_image">
                                            <label for="name" class="col-sm-2 form-control-label">Image</label>
                                            <div class="col-sm-10">
                                                <label for="section_upload{{$section_count}}" class="lable_upload">
                                                    <input class="form-control section_images item" value="{{@$r->image}}" type="hidden" />
                                                    <div id="section_thumb_upload{{$section_count}}" class="thumb-output">
                                                        @if(@$r->image!='' && file_exists('public/'._alias.'/'.$r->image))
                                                        <img src="{{$base.@$r->image}}" />
                                                        @else
                                                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAANlBMVEX///+/v7+8vLzKysr8/Pzg4ODFxcXb29vT09Pj4+P4+PjBwcH6+vry8vLY2NjIyMjp6eno6Og1AQOEAAAEdUlEQVR4nO2d6ZbCIAxGp3TT1i6+/8uOWrUUwlKsIZ7z3d+dwh0wIYDHvz8AAAAAAAAAAAAAAAAAXqqx+Snq/YYnVfwQqoUhDKUDQxjKB4YwlA8MYSifAwyVNA43PJ2FUR5sqM673/BljP7B0AaG2YFhEBhmB4ZBYJgdGAaBYXZgGASG2YFhEBhmB4ZBYJidDIaXKqWjyfAaXubxsUs7nbvkHu+F1XAuX1vQqmm5RpLTsO61R9WJaRgZDc0Djmb4pOPR8BmezTMqVX7U81jYDIemMFH775glwGY4EseMH8zTNvpPuQw7ewhvJC8Phn6MfZTLcKZOitUpMWXcGp1iQzGXITVJiyK6mwatih9/LkP6tL9PM+zUjvH/ScPlZZGxJq9hk2RYP96lTnFPcxnWpGF52d2ellnjHucyHMhYGh3ydcrX6v0a9TiX4WV76WOhn3c3p8+GMirWsK1pztQkTUiH2uov7h/EZliV1jxVCYu26rS3t3y1xaU3DVMW3puIFRWKGevDudmOYkqV3xWRja1w1viDNlFV2qackVab3X/y7Z2oc9k8dqL6aUzJhH+1Mc9jPsnMu4nVULfjWF/TVmtWFR2TUH9qR9gOxxHFiTDD2Rd9qJVfOB7LMuzU6FYkdnpiVrayDG/vclYMeq7XCMYaUYb3lZ2zsqWrk3ANJcmwmx6voCfqNtdrDYbWDZIMX3s55LC4vvQQbFCQ4buEpMKNmetXQgWKHEO9grQUyTi6EKqh5BhuCkhzrWLn+rXFwLpGjOHQb7u9GUXrVGcziP6EIcbQHCW9tvLM0SJ4wCPF0N71XyefI9e/8ddQQgyJg5v180Xneu1Jb6wRYthSPX92xpXr1za96xoZhoO1h6MpunL9ivccktuwIgu6yTE49+64c/36nC/WcBteS0LRnQzaQBx94quhuHcxSmX3pnMM4Z06PEcL/34Ns+Ft4aJ6Q9H7TeIYvxueax3Mt77ua09lTNQ5TsKLck9TXsNnXt8qxnzQgobuWMNr+EwKSj/7bSMnop/JOYishtd3BVi+Q0NUrAzTOw8TOQ0rrQJ8TdTQmjMW98UFTkO9AnxNVG9dtAdnDcVouD0GVtO9SxW9XEvA2XXO0zVjuO478seEmQd9fkN7uLr5sCF0X1zgM7zawzVR1xeSDR01FOM5/oE2JI4aKutdjGNxdD7rfZqDoQ8Ts94vPRh6v4bL8MCg6WbKaEgE0i+gqGnKY/j9QOruPo/h9wPpAnVJisWQI5AuEK2zGHIE0qV1ooZiMWQJpAv2uobDkCeQLs3bh4kMhkyB9EkOw8PK+Bjs9r9vWI0lJ9Y0ZRjDjhVrV1HG6do3gWEQGGYHhkFgmB0YBoFhdmAYBIbZOdqwqCtZHG/YsFaDEWw3ifDbCDCUDwxhKB8YwlA+MIShfGAIQ/nAEIbygSEM5QNDGMoHhjCUDwxhKB8YwlA+MIShfGAIQ/nAEIbygSEM5QNDGMoHhjCUT5rhT5FgONc/Bc/PuwIAAAAAAAAAAAAAAAAQzD8O4oElgraltwAAAABJRU5ErkJggg==" />

                                                        @endif
                                                    </div>
                                                    <input type="file" id="section_upload{{$section_count}}" data-id="#section_thumb_upload{{$section_count}}" style="display:none" class="section_add-file-upload" />
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane section_custom " id="section_custom{{    $section_count}}" aria-expanded="false">
                                    <table class="table table-striped  b-t">
                                        <thead>
                                            <tr>
                                                <th style="width:20px;">
                                                    <label class="ui-check m-a-0">
                                                        <input id="checkAll" type="checkbox" />
                                                        <i></i>
                                                    </label>
                                                </th>
                                                <th class="section_e section_slider_title">Tiêu đề</th>
                                                <th class="section_e section_slider_content">Mô tả</th>
                                                <!--<th class="text-center">Hình ảnh</th>
                                                <th class="text-center">Icon</th>-->
                                                <th class="text-center" style="width:200px;">Tùy chọn</th>
                                            </tr>
                                        </thead>                                   
                                        <tbody class="list_item">

                                            @if(@$r->detail)
                                            @foreach($r->detail as $details)
                                        @php
                                        $item_image++;
                                        $d = (object)$details;
                                        @endphp
                                        
                                            <tr>
                                                <td>
                                                    <input class="pull-left form-control row_no item" type="text" value="{{    @$d->no}}" />
                                                    <br />
                                                    <a class="btn btn-sm info" style="padding-top:5px;display:none;">
                                                        <small>
                                                            <i class='material-icons'>&#xe8d7</i>
                                                        </small>
                                                    </a>
                                                </td>
    
                                                <td colspan="2">
                                                    @include(_alias_admin."::sys.template.normal.edit.gallery.widge.group_gallery_div")
                                                </td>
                                                <td class="text-center">
                                                    <button class="btn btn-sm warning row_remove" data-toggle="modal" data-target="#m-1" ui-toggle-class="bounce" ui-target="#animate">
                                                        <small>
                                                            <i class="material-icons"></i>Xóa
                                                        </small>
                                                    </button>

                                                </td>
                                            </tr>
                                            <!--<tr>
                                                <td>
                                                    <textarea class="form-control row_note item" style="width:100%">{{@$d->note}}</textarea>
                                                </td> 
                                                <td>
                                                    <textarea class="form-control row_link item" style="width:100%">{{    @$d->link }}</textarea>
                                                </td>
                                            </tr>-->
                                            @endforeach
                                            @endif
                                        </tbody>
                                        <tbody class="list_item_default" style="display:none">
                                            <tr>
                                                <td>
                                                    <input class="pull-left form-control row_no item" id="row_no" name="row_no_1" value="1" type="text" />
                                                </td>
                                                <td>
                                                    <textarea class="form-control row_title item" style="width:100%"></textarea>
                                                </td>
                                                <td class="text-center">
                                                     <input placeholder="content"  class="form-control    has-value section_content item" style="height:70px;" required="" name="name" value="" type="text" />
                                                    <label class="btn success pop-summernote" data-id="">Open Editor</label>

                                                </td>
                                                <td>
                                                    <label for="upload" class="lable_upload">
                                                        <input class="form-control row_image item" value="" type="hidden" />
                                                        <div class="thumb-output">
                                                            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAANlBMVEX///+/v7+8vLzKysr8/Pzg4ODFxcXb29vT09Pj4+P4+PjBwcH6+vry8vLY2NjIyMjp6eno6Og1AQOEAAAEdUlEQVR4nO2d6ZbCIAxGp3TT1i6+/8uOWrUUwlKsIZ7z3d+dwh0wIYDHvz8AAAAAAAAAAAAAAAAAXqqx+Snq/YYnVfwQqoUhDKUDQxjKB4YwlA8MYSifAwyVNA43PJ2FUR5sqM673/BljP7B0AaG2YFhEBhmB4ZBYJgdGAaBYXZgGASG2YFhEBhmB4ZBYJidDIaXKqWjyfAaXubxsUs7nbvkHu+F1XAuX1vQqmm5RpLTsO61R9WJaRgZDc0Djmb4pOPR8BmezTMqVX7U81jYDIemMFH775glwGY4EseMH8zTNvpPuQw7ewhvJC8Phn6MfZTLcKZOitUpMWXcGp1iQzGXITVJiyK6mwatih9/LkP6tL9PM+zUjvH/ScPlZZGxJq9hk2RYP96lTnFPcxnWpGF52d2ellnjHucyHMhYGh3ydcrX6v0a9TiX4WV76WOhn3c3p8+GMirWsK1pztQkTUiH2uov7h/EZliV1jxVCYu26rS3t3y1xaU3DVMW3puIFRWKGevDudmOYkqV3xWRja1w1viDNlFV2qackVab3X/y7Z2oc9k8dqL6aUzJhH+1Mc9jPsnMu4nVULfjWF/TVmtWFR2TUH9qR9gOxxHFiTDD2Rd9qJVfOB7LMuzU6FYkdnpiVrayDG/vclYMeq7XCMYaUYb3lZ2zsqWrk3ANJcmwmx6voCfqNtdrDYbWDZIMX3s55LC4vvQQbFCQ4buEpMKNmetXQgWKHEO9grQUyTi6EKqh5BhuCkhzrWLn+rXFwLpGjOHQb7u9GUXrVGcziP6EIcbQHCW9tvLM0SJ4wCPF0N71XyefI9e/8ddQQgyJg5v180Xneu1Jb6wRYthSPX92xpXr1za96xoZhoO1h6MpunL9ivccktuwIgu6yTE49+64c/36nC/WcBteS0LRnQzaQBx94quhuHcxSmX3pnMM4Z06PEcL/34Ns+Ft4aJ6Q9H7TeIYvxueax3Mt77ua09lTNQ5TsKLck9TXsNnXt8qxnzQgobuWMNr+EwKSj/7bSMnop/JOYishtd3BVi+Q0NUrAzTOw8TOQ0rrQJ8TdTQmjMW98UFTkO9AnxNVG9dtAdnDcVouD0GVtO9SxW9XEvA2XXO0zVjuO478seEmQd9fkN7uLr5sCF0X1zgM7zawzVR1xeSDR01FOM5/oE2JI4aKutdjGNxdD7rfZqDoQ8Ts94vPRh6v4bL8MCg6WbKaEgE0i+gqGnKY/j9QOruPo/h9wPpAnVJisWQI5AuEK2zGHIE0qV1ooZiMWQJpAv2uobDkCeQLs3bh4kMhkyB9EkOw8PK+Bjs9r9vWI0lJ9Y0ZRjDjhVrV1HG6do3gWEQGGYHhkFgmB0YBoFhdmAYBIbZOdqwqCtZHG/YsFaDEWw3ifDbCDCUDwxhKB8YwlA+MIShfGAIQ/nAEIbygSEM5QNDGMoHhjCUDwxhKB8YwlA+MIShfGAIQ/nAEIbygSEM5QNDGMoHhjCUT5rhT5FgONc/Bc/PuwIAAAAAAAAAAAAAAAAQzD8O4oElgraltwAAAABJRU5ErkJggg==" />
                                                        </div>
                                                        <input type="file" id="upload" style="display:none" class="add-file-upload" />
                                                    </label>

                                                </td>
                                                <td>
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
                        <hr style="border-color:#0094ff; width:100% important!;clear:both" />
                    </div>
                    @endforeach
                @endif
            </div>
            <div class="col-sm-2 col-lg-2">
                <div class="p-y">
                    <div class="nav-active-border left b-primary" style="position:fixed">
                        <label class="section_add">
                            <h5>
                               <button class="btn blue " style="padding:0px 2px;"><i class="material-icons"></i> </button>   Add Section
                            </h5>
                        </label>

                        <ul class="nav nav-sm">
                            @if(@$results['section'])
                            @foreach($results['section'] as $se)
                            @php
                            $r = (object)$se;
                            @endphp
                            <li class="nav-item" style="width:190px;">
                                <a class="nav-link block" href="{{url($_SERVER['REQUEST_URI'])}}#sec_{{@$j+++1}}">
                                    <i class="material-icons"></i>
                                    &nbsp; {{@$j}}  {!!    strip_tags(@$r->title) !!}

                                </a>
                            </li>
                            @endforeach
                            @endif
                            <!--<li class="nav-item">
                                <a class="nav-link block " href="" data-toggle="tab" data-target="#tab-2" onclick="document.getElementById('active_tab').value='contactsTab'">
                                    <i class="material-icons"></i>
                                    &nbsp; Liên hệ
                                </a>
                            </li>-->

                        </ul>

                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <!-- Section Element -->
    @include(_alias_admin."::sys.template.normal.edit.gallery.widge.group_gallery_section_template")
    <!-- Section Element -->
</div>
<style type="text/css">
    .lable_upload_icon{
        background-color:#ccc;
    }
</style>
<script>
    $(document).ready(function () {
        $(document).on("change", ".section_type", function () {
        //$('.section_type').on('change', function () {
            var section = $(this).find(":selected").attr('data-section');
            var type = $(this).val();
            hide_element(section, type);
        })

        $('.section_item').each(function () {
            var section = $(this).find('.section_type').find(":selected").attr('data-section');
            var type = $(this).find('.section_type').val();
            hide_element(section, type);
        })
        function hide_element(section, type) {
            if (type == 11) {
                $('#' + section).find('.section_e').fadeIn();

                $('#' + section).find('.section_caption').parent().parent().fadeOut();
                //$('#' + section).find('.section_content').parent().parent().fadeOut();
                $('#' + section).find('.section_image').fadeOut();

                $('#' + section).find('.section_slider_title').fadeOut();
                //$('#' + section).find('.section_slider_content').fadeOut();
                // $('#' + section).find('.section_slider_image').fadeOut();
                $('#' + section).find('.section_slider_icon').fadeOut();
                $('#' + section).find('.section_slider_icon_2').fadeOut();
            }

            if (type == 12 || type == 15 || type == 16) {
                $('#' + section).find('.section_e').fadeIn();
                $('#' + section).find('.section_tab_slider').hide();

            }

            if (type == 13) {
                $('#' + section).find('.section_e').fadeIn();
                $('#' + section).find('.section_slider_content').fadeOut();
                $('#' + section).find('.section_slider_icon').fadeOut();
                $('#' + section).find('.section_slider_icon_2').fadeOut();
            }
            if (type == 14) {
                $('#' + section).find('.section_e').fadeIn();

                $('#' + section).find('.section_content').parent().parent().fadeOut();
                $('#' + section).find('.section_image').fadeOut();

                $('#' + section).find('.section_slider_content').fadeOut();
            }

            if (type == 17) {
                $('#' + section).find('.section_e').fadeIn();

                $('#' + section).find('.section_content').parent().parent().fadeOut();
                $('#' + section).find('.section_image').fadeOut();

                $('#' + section).find('.section_slider_image').fadeOut();
                $('#' + section).find('.section_slider_icon').fadeOut();
                $('#' + section).find('.section_slider_icon_2').fadeOut();
            }
            if (type == 18) {
                $('#' + section).find('.section_e').fadeIn();

                $('#' + section).find('.section_content').parent().parent().fadeOut();
                $('#' + section).find('.section_image').fadeOut();

                $('#' + section).find('.section_tab_slider').hide();
            }


        }

    });

</script>
<script>
    var selectcontent;
      $(document).on('click', '.pop-summernote', function () {
        selectcontent = $(this);
        var content = $(this).parent().parent().find('.section_content').val();
        $('#m-summernote').find('.note-editable').html(content);
        //$('#m-summernote').find('.section_content').summernote('editor.insertText', content);
        //$('#summernote').summernote('editor.insertText', 'hello world'));
        $('#m-summernote').modal('show');
    });


    $('#btn-close-pop').on('click',function(){
            var content = $(this).parent().parent().find('.note-editable').html();
            selectcontent.parent().parent().find('.section_content').val(content);
            $('#m-summernote').modal('hide');
        update_galler_content();
    });
    //var count_image = 1;

    var timeOut;
    $('.section_add').on('click', function () {

        if (timeOut != null) {
            clearTimeout(timeOut);
        }
        timeOut = setTimeout(function () {
             var html = $('#section_template');
            var count = $('.section_item').length + 1;


            html.find('.section_type option').attr('data-section','sec_'+count);

            html.find('h6').find('label').html("Section "+ count + ":");
            html.find('.tab_detail').attr('data-target', '#section_details' + count);
            html.find('.tab_custom').attr('data-target', '#section_custom' + count);
            html.find('.section_details').attr('id', 'section_details' + count);
            html.find('.section_custom').attr('id', 'section_custom' + count);
            //html.find('.nav-md>li>a[class="tab_content"]').attr('data-target', '#section_custom' + count);
            //html.find('.tab-content>div[class="section_details"]').attr('id', 'section_details' + count);
            //html.find('.tab-content>div[class="section_custom"]').attr('id', 'section_custom' + count);
            $('.setion_content').append('<div class="form-group section_item" id="sec_'+count+'">' + html.html() + '</div>');

                $('html, body').animate({
                    scrollTop: $('#section_part_'+count).offset().top
                }, 2000);



         }, 600);      //end timeout

    });
    $('.section_remove').on('click', function () {
        $(this).parent().parent().parent().parent().remove();
        update_galler_content();
    });
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

     $(document).on('change', '.add-file-upload_icon_2', function () {
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
                    $(input_file).parent().find('.row_icon_2').val(image);
                    update_galler_content();
                }
            });

    });

    function update_galler_content() {
        var row = [];
        var title = 'gioi thieu';
        var caption = 'caption gioi thieu';
        var image = 'image 1';

        var obj = {
            title: title,
            caption: caption
        };

        var objdetail = {
            title: 'title',
            content: obj
        };
        row.push(objdetail);

        $('.section_item').each(function () {
            var list = [];
            var title = $(this).find('.section_title').val();
            var caption = $(this).find('.section_caption').val();
            var content = $(this).find('.section_content').val();
            var link = $(this).find('.section_link').val();
            var image = $(this).find('.section_images').val();
            var type  = $(this).find('.section_type').val();

            var details = [];
            $(this).find('.list_item>tr').each(function () {
                var no = $(this).find('.row_no').val();
                var title = $(this).find('.row_title').val();
                var content = $(this).find('.row_content').val();
                var image = $(this).find('.row_image').val();
                var icon = $(this).find('.row_icon').val();
                var icon2 = $(this).find('.row_icon_2').val();
                var obj_detail = {
                    no: no,
                    title: title,
                    content: content,
                    image: image,
                    icon:icon,
                    icon2:icon2
                };
                details.push(obj_detail);
            });
            var obj = {
                type: type,
                title: title,
                caption: caption,
                content: content,
                link: link,
                image: image,
                detail: details
            };
            list.push(obj);

            var objdetail = {
                title: 'section',
                content: list
            };
            row.push(objdetail);
        });
        $('.content_id').val(JSON.stringify(row));
    }
</script>
<script>
    function sendFilegroup_gallery(file, editor, welEditable,lang,summernoteele) {
            data = new FormData();
            data.append("file", file);
            data.append("_token", "{{ csrf_token() }}");
            $.ajax({
                data: data,
                type: 'POST',
                xhr: function() {
                    var myXhr = $.ajaxSettings.xhr();
                    if (myXhr.upload) myXhr.upload.addEventListener('progress',progressHandlingFunction, false);
                    return myXhr;
                },
                url: "{{url('admin/'.request()->segment(2).'/upload_image')}}",
                cache: false,
                contentType: false,
                processData: false,
                success: function(url) {
                    var image = JSON.parse(url);
                    var image = $('<img>').attr('src', "{{$base}}" + image.file);
                    $(summernoteele).summernote("insertNode", image[0]);
                    //if(lang==1) {
                    //    $('.summernote_en').summernote("insertNode", image[0]);
                    //}else{
                    //    $('.summernote_ar').summernote("insertNode", image[0]);
                    //}
                }
            });
        }

        // update progress bar
        function progressHandlingFunction(e){
            if(e.lengthComputable){
                $('progress').attr({value:e.loaded, max:e.total});
                // reset progress on complete
                if (e.loaded == e.total) {
                    $('progress').attr('value','0.0');
                }
            }
        }
</script>
<style type="text/css">
    .form-group2 {
        margin-bottom: 1rem;
    }
    h6:after {
        counter-increment: section;
        /*content: "Section " counter(section) ": ";*/

    }
    .thumb-output img {
        height: 70px;
    }
    .thumb-output_icon img {
        height: 70px;
    }
</style>
