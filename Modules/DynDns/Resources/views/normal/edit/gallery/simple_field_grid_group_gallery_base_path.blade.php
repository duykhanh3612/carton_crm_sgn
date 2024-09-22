@php
  $flg_read =    true;
@endphp
<div class="form-group {{$ctrl->width}} grid_group_gallery_panel" id="gallery_{{$ctrl->name}}" data-title="simple_field_grid_group_gallery_base_path.blade" >
    <!--<label>
        {{$ctrl->title }}
    </label>-->

    <div class="portlet-content content_{{ $ctrl->value }}" style="width:100% !important;">

        <!--<label class="section_add">
            <h5 >
                <i class="material-icons"></i>Add Section
            </h5>
        </label>-->
        <textarea id="{{$ctrl->name}}" name="{{$ctrl->name.@$lang}}" class="form-control content_id" style="display:none"><?=@$row->{$ctrl->value.@$lang}?></textarea>
        <div class="row">
            @php
             $results_json = json_decode(@$row->{$ctrl->value.@$lang},true);
             $results = h::array_onegroup_field($results_json,'title','content');

             $section_count =0 ;
             $item_image = 0;
            @endphp

            @include(alias_admin."::sys.template.normal.edit.gallery.widge.group_gallery_summernote")

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
                            <em>{{ strip_tags($r->title)}}</em>
                        </h6>
                    </label>
                    <div class="box nav-active-border b-info section_e" style="width:100% !important;">
                        <ul class="nav nav-md">
                            <li class="nav-item inline">
                                <a class="nav-link tab_detail active" href="" data-toggle="tab" data-target="#section_details{{$section_count}}" aria-expanded="false">
                                    <span class="text-md">
                                        <i class="fas fa-list-ul"> </i> Chi tiết Section
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item inline  section_e section_tab_slider">
                                <a class="nav-link tab_custom" href="" data-toggle="tab" data-target="#section_custom{{    $section_count}}" aria-expanded="false">
                                    <span class="text-md">
                                        <i class="fas     fa-th-large"> </i> Slider
                                    </span>
                                </a>
                            </li>
                            <li class="av-item inline pull-right" >
                                <a class="nav-link tab_custom section_remove" aria-expanded="false">
                                    <span class="text-md">
                                        <button class="btn danger" style="padding:0px 2px;"><i class="fas fa-times" style="color:#ff0000"></i></button>
                                        Xóa Setion [<em>{{ substr($r->title,0,15)}} </em>]
                                    </span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content clear b-t" style="width:100%">
                            <div class="tab-pane active section_e section_details" id="section_details{{    $section_count}}" aria-expanded="false">
                                <div class="box-body">
                                    <div class="form-group row section_ctxdform section_type">
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
                                            <input placeholder="title" class="form-control has-value section_title item" required="" value="{{    $r->title}}" type="text" />
                                        </div>
                                    </div>
                                    <div class="form-group row section_e section_ctxdform">
                                        <label for="name" class="col-sm-2 form-control-label">Mô tả section</label>
                                        <div class="col-sm-10">
                                            <input placeholder="caption" class="form-control has-value  section_caption item" required="" name="name" value="{{    $r->caption}}" type="text" />
                                        </div>
                                    </div>
                                    <div class="form-group row section_e section_ctxdform">
                                        <label for="name" class="col-sm-2 form-control-label">Nội dung section
                                            <br/>

                                        </label>
                                        <div class="col-sm-10">
                                            <input placeholder="content"  class="form-control    has-value section_content item" style="height:70px;" required="" name="name" value="{{    $r->content}}" type="text" />
                                            <label class="btn success pop-summernote" data-id="">Open Editor</label>
                                        </div>
                                    </div>
                                    <div class="form-group row section_e section_ctxdform section_link">
                                        <label for="name" class="col-sm-2 form-control-label">Link</label>
                                        <div class="col-sm-10">
                                            <input placeholder="link" class="form-control has-value section_link item" required="" name="name" value="{{    @$r->link}}" type="text" />
                                        </div>
                                    </div>
                                    <div class="form-group row section_e section_ctxdform section_image">
                                        <label for="name" class="col-sm-2 form-control-label">Image</label>
                                        <div class="col-sm-10">
                                            <label for="section_upload{{$section_count}}" class="lable_upload">
                                                <input class="form-control section_images item" value="{{@$r->image}}" type="hidden" />
                                                <div id="section_thumb_upload{{$section_count}}" class="thumb-output">
                                                    @if(@$r->image!='' && file_exists( $image_path.'/'.$ctrl->note.'/'.$r->image))
                                                    <img src="{{ $image_path.'/'.$ctrl->note.'/'.@$r->image}}" />
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
                                    <div class="list_item row">
                                        @foreach($r->detail as $details)
                                            @php
                                         $item_image++;
                                         $d = (object)$details;
                                         @endphp


                                                @include(alias_admin."::sys.template.normal.edit.gallery.widge.simple_field_grid_group_gallery_base_path_div")

                                        <!--<tr>
                                            <td>
                                                <textarea class="form-control row_note item" style="width:100%">{{@$d->note}}</textarea>
                                            </td>
                                            <td>
                                                <textarea class="form-control row_link item" style="width:100%">{{    @$d->link }}</textarea>
                                            </td>
                                        </tr>-->
                                        @endforeach

                                    </div>
            <div class="{{$ctrl->name.@$lang}}_list_item_default" style="display:none">
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

                    <label class="btn btn-sm warning row_remove  hidden-xs-down pointer" ui-toggle-class="bounce" ui-target="#animate" data-id="m_confirm_gallery_delete{{    $ctrl->name}}">
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
            </div>
            @endif

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
                                    &nbsp; {{@$j}}  {!!    strip_tags($r->title) !!}

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
    @include(alias_admin."::sys.template.normal.edit.gallery.widge.group_gallery_section_template")
    <!-- Section Element -->
</div>
<style type="text/css">
    .lable_upload_icon{
        background-color:#ccc;
    }
</style>
<script>
    @if($ctrl->att_table!='')
	var hiddentab = ".section_ctxdform .section_e";
	$(hiddentab).css("display", "none");
	$('{{".section_slider_".implode(",.section_slider_",explode(",", $ctrl->att_table))}}').fadeIn();
    @endif
</script>
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
        {{$ctrl->value }}_update_galler_content();
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
        {{$ctrl->value }}_update_galler_content();
    });
    $(document).on('click', '.content_{{ $ctrl->value }} .item_add', function () {

        var number_plus = $(this).parent().find('#number_plus').val();
        for (var i = 0; i < number_plus; i++) {


            var html = $('.{{$ctrl->name.$lang}}_list_item_default');
            var count_image = $('.content_{{ $ctrl->value }} .lable_upload').length + 1;

            $(this).parent().parent().parent().find('.list_item').append(html.html());

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

       // count_image++;
    });
    $(document).on('change', '.section_title', function () {
        $(this).parent().parent().parent().parent().parent().parent().parent().find('em').html($(this).val());
    });
    $(document).on('click', '.row_remove', function () {

        var item_chose = $(this);
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
    $(document).on('change', '.item', function () {
        {{$ctrl->value }}_update_galler_content();
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

    $(document).on('change', '.content_{{$ctrl->value }} .section_add-file-upload', function () {
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
            form_data.append("id", $('#id').val());
            $.ajax({
                url: "{{url('admin/'.request()->segment(2).'/upload_file')}}",
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'POST',
                success: function (data) {
                    var image = data.image.replace('{{$ctrl->note}}/','');
                    $(input_file).parent().find('.section_images').val(image);
                    {{$ctrl->value }}_update_galler_content();

                    if($('#id').val()=='')
                        $('#id').val(data.id);
                }
            });

    });

    //Slider Image
    $(document).on('change', '.content_{{$ctrl->value }} .add-file-upload', function () {
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
            form_data.append("id", $('#id').val());
            $.ajax({
                url: "{{url('admin/'.request()->segment(2).'/upload_file')}}",
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'POST',
                success: function (data) {
                    var image = data.image.replace('{{$ctrl->note}}/','');
                    $(input_file).parent().find('.row_image').val(image);
                    {{$ctrl->value }}_update_galler_content();

                    if($('#id').val()=='')
                        $('#id').val(data.id);
                }
            });

    });

    $(document).on('change', '.content_{{$ctrl->value }} .add-file-upload_icon', function () {
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

     $(document).on('change', '.content_{{$ctrl->value }} .add-file-upload_icon_2', function () {
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

    function {{$ctrl->value }}_update_galler_content() {
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
            $(this).find('.list_item>.list_item_row').each(function () {
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
        $('#{{$ctrl->value.@$lang}}').val(JSON.stringify(row));
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

    .list_item_row .panel_image img{
        width:auto;
        height:100%;
    }
    .list_item_row .btn_upload{
        position:absolute;
        bottom:3px;
        left:10px;
        z-index:50;
        font-size:30px;
        margin-bottom:0px;
        color:#0964f5;
        background:#cccccc;
        cursor:pointer;
    }
    .list_item_row .btn_modal_edit{
        position:absolute;
        bottom:3px;
        right:10px;
        z-index:50;
        font-size:24px;
        color:#ff6a00;
        background:#cccccc;
        padding-left:15px;
        padding-right:15px;
        cursor:pointer;
        margin-bottom:0px;
    }
     .list_item_row .row_remove{
        position:absolute;
        bottom:3px;
        right:60px;
        z-index:50;
        font-size:30px;
        color:#ff0000;
        background:#cccccc;
        padding-left:10px;
        padding-right:10px;
        cursor:pointer;
        margin-bottom:0px;
    }
    .grid_group_gallery_panel .thumb-output{
        width:100% !important ;
        height:170px;
    }
   .grid_group_gallery_panel .thumb-output img {
         max-width:100%
    }
    .grid_group_gallery_panel .thumb-output_icon img {
         max-width:100%
    }
</style>
<style type="text/css">
    .form-group2 {
        margin-bottom: 1rem;
    }
    h6:after {
        counter-increment: section;
        /*content: "Section " counter(section) ": ";*/

    }
    .section_add,.nav li{
        cursor:pointer;
    }
    .nav {
        display: inherit !important;
    }
</style>
