<div class="box-body">
    <div>
        <div class="form-group row">
            <label for="file_title_ar" class="col-sm-2 form-control-label">
                Site Sections
            </label>
            <div class="col-sm-10">
                <select name="related_section_id" id="related_section_id" class="form-control c-select">
                    <option value="0">
                        - - Chọn Section- -
                    </option>
                    @foreach(App\Model\md::find_all($ctrl->att_join,"title!=''") as $sec)
                    <option value="{{$sec->id}}">{{    $sec->title}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row r_topics_content" style="display:none">
            <label for="file_title_ar" class="col-sm-2 form-control-label">
                Danh mục liên quan
            </label>
            <div class="col-sm-10">
                <div id="r_topics" style="max-height: 200px;overflow-y: scroll;padding: 5px;background: #f5f5f5;border: 1px solid #eee">
                    <i class="material-icons"></i> Chọn Site Section để mở chủ đề
                </div>
                
            </div>
            <div class="form-group row m-t-md">
                <div class="col-sm-offset-2 col-sm-10">
                    <label type="button" class="btn btn-primary m-t btn-releated-add">
                        <i class="material-icons">
                            
                        </i> Update Danh mục
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group row i_topics_content" style="display:none">
            <label for="file_title_ar" class="col-sm-2 form-control-label">
                Chủ đề liên quan
            </label>
            <div class="col-sm-10">
                <div id="i_topics" style="max-height: 200px;overflow-y: scroll;padding: 5px;background: #f5f5f5;border: 1px solid #eee">
                    <i class="material-icons"></i> Chọn Site Section để mở chủ đề
                </div>
                
            </div>
            <div class="form-group row m-t-md">
                <div class="col-sm-offset-2 col-sm-10">
                    <label type="button" class="btn btn-primary m-t btn-topic-releated-add">
                        <i class="material-icons">
                            
                        </i> Update chủ đề
                    </label>
                </div>
            </div>
        </div>
    </div>
    <!--<div class="row p-a">
        <div class="col-sm-12">
            <a class="btn btn-fw primary" href="http://vincityquan9.com.vn/admin/2/topics/5/related/create">
                <i class="material-icons"></i>
                &nbsp; Thêm chủ đề liên quan
            </a>
        </div>
    </div>-->
    <div>
        <div id="mf-3" class="modal fade" data-backdrop="true">
            <div class="modal-dialog" id="animate">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Xác nhận</h5>
                    </div>
                    <div class="modal-body text-center p-lg">
                        <p>
                            Bạn có chắc là bạn muốn xóa?
                            <br>
                            <strong></strong>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Không</button>
                        <a href="" class="btn-yes btn danger p-x-md">Có</a>
                    </div>
                </div><!-- /.modal-content -->
            </div>
        </div>

        <table class="table table-striped  b-t">
            <thead>
                <tr>
                    <td colspan="3">   Danh mục liên quan</td>
                </tr>
            </thead>
            <thead>
                <tr>
                    <th style="width:20px;">
                        <label class="ui-check m-a-0">
                            <input id="checkAll4" class="has-value" type="checkbox"><i></i>
                        </label>
                    </th>
                    <th>Tiêu đề</th>
                    <th class="text-center" style="width:200px;">Tùy chọn</th>
                </tr>
            </thead>
            <tbody  id="relate_content">
                @foreach(md::find_all($ctrl->note,"topic_id='".@$row->id."'") as $r_section)
                <tr>
                    <td>
                        <label class="ui-check m-a-0">
                            <input name="ids[]" value="3" class="has-value" type="checkbox"><i class="dark-white"></i>
                            <input class="form-control row_no has-value" name="row_ids[]" value="3" type="hidden">
                        </label>
                    </td>
                    <td>
                        <input class="pull-left form-control row_no has-value" name="row_no_3" value="2" type="text">
                        <small>
                           {{    md::scalar($ctrl->att_join_key,"id='". $r_section->section_id."'",'title'._lang)}}
                        </small>
                    </td>
                    <td class="text-center">
                        <button class="btn btn-sm warning btn-relate-delete-confirm"  data-target="#mf-3" ui-toggle-class="bounce" ui-target="#animate" data-href="{{    h::site_url(\h::_area.'/'.request()->segment(2).'/related_section_delete/'.@$r_section->id.'?table='.$ctrl->note)}}">
                            <small>
                                <i class="material-icons">
                                    
                                </i> Xóa
                            </small>
                        </button>

                    </td>
                </tr>   
                @endforeach   
                
                @php
                $topics = md::find_all('smartend_related_topics',"topic_id='".@$row->id."'");
                @endphp    
                
               <thead>
                 <tr>
                    <td colspan="3">  Chủ đề liên quan</td>
                    </tr>
                </thead>
                <thead>
                    <tr>
                        <th style="width:20px;">
                            <label class="ui-check m-a-0">
                                <input id="checkAll4" class="has-value" type="checkbox"><i></i>
                            </label>
                        </th>
                        <th>Tiêu đề</th>
                        <th class="text-center" style="width:200px;">Tùy chọn</th>
                    </tr>
                </thead>
                <tbody  id="topic_content">
                    @foreach(md::find_all('smartend_related_topics',"topic_id='".@$row->id."'") as $r_section)
                    <tr>
                        <td>
                            <label class="ui-check m-a-0">
                                <input name="ids[]" value="3" class="has-value" type="checkbox"><i class="dark-white"></i>
                                <input class="form-control row_no has-value" name="row_ids[]" value="3" type="hidden">
                            </label>
                        </td>
                        <td>
                            <input class="pull-left form-control row_no has-value" name="row_no_3" value="2" type="text">
                            <small>
                               {{    md::scalar('smartend_topics',"id='". $r_section->topic2_id."'",'title'._lang)}}
                            </small>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm warning btn-relate-delete-confirm"  data-target="#mf-3" ui-toggle-class="bounce" ui-target="#animate" data-href="{{    h::site_url(\h::_area.'/'.request()->segment(2).'/related_section_delete/'.@$r_section->id.'?table=smartend_related_topics')}}">
                                <small>
                                    <i class="material-icons">
                                        
                                    </i> Xóa
                                </small>
                            </button>

                        </td>
                    </tr>   
                    @endforeach       
                </tbody>
           
            <tbody id="section_related_template" style="display:none;">
                <tr>
                    <td>
                        <label class="ui-check m-a-0">
                            <input class="form-control row_no has-value"  value="" type="hidden">
                        </label>
                    </td>
                    <td>
                        <input class="pull-left form-control row_no has-value" name="row_no_3" value="2" type="text">
                        <small class="section_related_title">
                            
                        </small>
                    </td>
                    <td class="text-center">
                        <button class="btn btn-sm warning btn-relate-delete-confirm" data-target="#mf-3" ui-toggle-class="bounce" ui-target="#animate" data-href="">
                            <small>
                                <i class="material-icons">
                                    
                                </i> Xóa
                            </small>
                        </button>

                    </td>
                </tr>   
            </tbody>
        </table>
 
    </div>

    <script>
        $(document).ready(function () {
            $('#related_section_id').on('change', function () {
                var id = $(this).val();
                var form_data = new FormData();
                form_data.append("table", '{{json_encode($ctrl)}}');
                form_data.append("value", id);
                form_data.append("_token", '{{ csrf_token() }}');

                $.ajax({
                    url: "{{url('admin/'.request()->segment(2).'/related_section')}}",
                    cache: false,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    dataType: 'json',
                    data: form_data,
                    success: function (data) {
                        $('#r_topics').html('');
                        $('#i_topics').html('');
                        var row_no = 0;
                        if(data.cate.length==0)
                        {
                            $('.r_topics_content').hide();
                        }
                        else
                        {
                            $.each(data.cate, function (k, v) {
                                var div = '<label class="ui-check col-sm-12"><input name="related_cate_id[]" value="' + k + '" id="related_cate_' + row_no + '" class="related_cate_item has-value" type="checkbox"><i class="dark-white"></i>' +
                                    '&nbsp;<label for="related_topics_' + row_no + '">' + v + '</label> </label>';
                                $('#r_topics').append(div);
                                row_no++;
                            });
                            $('.r_topics_content').show();
                        }


                        if(data.topic.length==0)
                        {
                            $('.i_topics_content').hide();
                        }
                        else
                        {
                            $.each(data.topic, function (k, v) {
                                var div = '<label class="ui-check col-sm-12"><input name="related_topics_id[]" value="' + k + '" id="related_topics_' + row_no + '" class="related_topics_item has-value" type="checkbox"><i class="dark-white"></i>' +
                                    '&nbsp;<label for="related_topics_' + row_no + '">' + v + '</label> </label>';
                                $('#i_topics').append(div);
                                row_no++;
                            });
                            $('.i_topics_content').show();
                        }


                    }
                });
            });

            $('.btn-releated-add').on('click', function () {
                var id = [];
                $.each($(".related_cate_item:checked"), function () {
                    id.push($(this).val());
                });
                var value = id.join(", ");
                var id = $('.related_cate_item:checked');
                var form_data = new FormData();
                form_data.append("table", '{{h::crypt(json_encode($ctrl))}}');
                form_data.append("value", value);
                form_data.append("topic_id", $('#id').val());
                form_data.append("_token", '{{ csrf_token() }}');

                $.ajax({
                    url: "{{url('admin/'.request()->segment(2).'/related_section_update')}}",
                    cache: false,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    dataType: 'json',
                    data: form_data,
                    success: function (data) {

                        $('#relate_content').html('');

                        $.each(data, function (k, v) {
                            var html = $('#section_related_template').html();
                            $('#relate_content').append(html);
                            var html_ele = $('#relate_content>tr').last();
                            html_ele.find('.section_related_title').html(v);
                        });


                    }
                });
            });

            $('.btn-topic-releated-add').on('click', function () {
                var id = [];
                $.each($(".related_topics_item:checked"), function () {
                    id.push($(this).val());
                });
                var value = id.join(", ");
                var id = $('.related_topics_item:checked');
                var form_data = new FormData();
                form_data.append("table", '{{h::crypt(json_encode($ctrl))}}');
                form_data.append("value", value);
                form_data.append("topic_id", $('#id').val());
                form_data.append("_token", '{{ csrf_token() }}');

                $.ajax({
                    url: "{{url('admin/'.request()->segment(2).'/related_topic_update')}}",
                    cache: false,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    dataType: 'json',
                    data: form_data,
                    success: function (data) {  
                        $('#topic_content').html('');  
                        $.each(data, function (k, v) {
                            var html = $('#section_related_template').html();
                            var row_no = $('#topic_content>tr').length;
                            $('#topic_content').append(html);
                            var html_ele = $('#topic_content>tr').last();

                            html_ele.find('.row_no').val(row_no);
                            html_ele.find('.section_related_title').html(v);
                        });
                    }
                });
            });



            $('.btn-relate-delete-confirm').on('click', function () {
                var modal_tag = $(this).attr('data-target');
                var link = $(this).attr('data-href');
                if (link != '') {
                    $(modal_tag).modal('show');
                    $(modal_tag).find('.btn-yes').attr('href', link);
                }
                else $(this).parent().parent().remove();
            });
        });
    </script>
</div>  