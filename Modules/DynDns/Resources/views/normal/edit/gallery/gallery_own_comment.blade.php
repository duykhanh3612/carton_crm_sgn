@php
if(App\Model\Admin::_group()!='1' && App\Model\Admin::_group()!='2'  && $ctrl->name!='photos')
    $flg_read =    true;
else $flg_read = false;
@endphp
<div class="form-group {{@$ctrl->width}}" id="gallery_{{$ctrl->name}}">
    <?php
    if($ctrl->att_table!='')
        @$col = 12/count(explode(",", $ctrl->att_table));
    ?>
    @php
        $results_json = json_decode(@$row->{$ctrl->value.@$lang});
        $item_image = 0;
    @endphp

    <textarea id="{{$ctrl->name}}" name="{{$ctrl->name.@$lang}}" class="form-control content_id" style="display:none"><?=@$row->{$ctrl->value.@$lang}?></textarea>

    <div class="portlet-content content_{{ $ctrl->value }}" style="width:100% !important;">

        <section class="scrollable wrapper">
            <section class="comment-list block">
                <article class="comment-item" id="comment-form">
                    <a class="pull-left thumb-sm avatar">
                        <img src="https://www.gravatar.com/avatar/3c4df78c9199375dcb888f2e14d50b70.jpg?s=80&amp;d=mm&amp;r=g" class="img-circle" />
                    </a>
                    <span class="arrow left"></span>
                    <section class="comment-body">
                        <section class="panel panel-default">

                                <div class="md-editor active" id="1562225159544">                                    
                                    <textarea class="form-control markdownEditor md-input" name="message" id="comment-editor" data-id="1" required="" rows="5" style=""></textarea>
                                </div>
                                <footer class="panel-footer bg-light lter">
                                    <button type="button" class="btn btn-success formSaving submit btn-rounded">
                                        <!--<i class="fas fa-paper-plane"></i>-->Gửi  &nbsp; &nbsp; &nbsp;
                                    </button>
                                    <!--<ul class="nav nav-pills nav-sm"></ul>-->
                                </footer>
                           
                        </section>
                    </section>
                </article>

                <div id="commentMessages" class="with-responsive-img">
                    <div class="list_item">
                        @if(@$results_json)
                    @foreach($results_json as $d)
                        <article id="comment-2" class="comment-item">
                            <a class="pull-left thumb-sm avatar">
                                <img src="https://www.gravatar.com/avatar/3c4df78c9199375dcb888f2e14d50b70.jpg?s=80&amp;d=mm&amp;r=g" class="img-circle" />
                            </a>
                            <span class="arrow left"></span>
                            <section class="comment-body panel panel-default">
                                <header class="panel-heading bg-white">
                                    <a href="#" class="text-semibold">
                                        {{@$d->user}}
                                    </a>

                                    <label class="label bg-light m-l-xs">
                                        
                                    </label>

                                    <span class="text-muted m-l-sm pull-right">

                                        <!--<a href="#" class="deleteComment" data-comment-id="2" title="Delete ">
                                            <svg class="svg-inline--fa" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 448 512">
                                                <path d="M0 84V56c0-13.3 10.7-24 24-24h112l9.4-18.7c4-8.2 12.3-13.3 21.4-13.3h114.3c9.1 0 17.4 5.1 21.5 13.3L312 32h112c13.3 0 24 10.7 24 24v28c0 6.6-5.4 12-12 12H12C5.4 96 0 90.6 0 84zm416 56v324c0 26.5-21.5 48-48 48H80c-26.5 0-48-21.5-48-48V140c0-6.6 5.4-12 12-12h360c6.6 0 12 5.4 12 12zm-272 68c0-8.8-7.2-16-16-16s-16 7.2-16 16v224c0 8.8 7.2 16 16 16s16-7.2 16-16V208zm96 0c0-8.8-7.2-16-16-16s-16 7.2-16 16v224c0 8.8 7.2 16 16 16s16-7.2 16-16V208zm96 0c0-8.8-7.2-16-16-16s-16 7.2-16 16v224c0 8.8 7.2 16 16 16s16-7.2 16-16V208z"></path>
                                            </svg>
                                        </a>-->

                                    </span>
                                </header>
                                <div class="panel-body">

                                    <div class="text-justify">
                                        <p>{{@$d->content}}</p>
                                    </div>


                                    <!--<a href="http://task.trungloi.vn/comments/edit/2" data-toggle="ajaxModal" class="pull-right m-r-sm">
                                        <svg class="svg-inline--fa" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 512 512">
                                            <path d="M497.9 142.1l-46.1 46.1c-4.7 4.7-12.3 4.7-17 0l-111-111c-4.7-4.7-4.7-12.3 0-17l46.1-46.1c18.7-18.7 49.1-18.7 67.9 0l60.1 60.1c18.8 18.7 18.8 49.1 0 67.9zM284.2 99.8L21.6 362.4.4 483.9c-2.9 16.4 11.4 30.6 27.8 27.8l121.5-21.3 262.6-262.6c4.7-4.7 4.7-12.3 0-17l-111-111c-4.8-4.7-12.4-4.7-17.1 0zM124.1 339.9c-5.5-5.5-5.5-14.3 0-19.8l154-154c5.5-5.5 14.3-5.5 19.8 0s5.5 14.3 0 19.8l-154 154c-5.5 5.5-14.3 5.5-19.8 0zM88 424h48v36.3l-64.5 11.3-31.1-31.1L51.7 376H88v48z"></path>
                                        </svg>
                                    </a>-->


                                    <div class="comment-action m-t-sm">
                                        <small class="block text-muted">
                                            <svg class="svg-inline--fa" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 512 512">
                                                <path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm57.1 350.1L224.9 294c-3.1-2.3-4.9-5.9-4.9-9.7V116c0-6.6 5.4-12 12-12h48c6.6 0 12 5.4 12 12v137.7l63.5 46.2c5.4 3.9 6.5 11.4 2.6 16.8l-28.2 38.8c-3.9 5.3-11.4 6.5-16.8 2.6z"></path>
                                            </svg>
                                     
                                            {{date('d/m/Y h:m',strtotime(@$d->date))}}
                                        </small>
                                    </div>

                                    <div class=""></div>
                                </div>
                            </section>
                        </article>

                        @endforeach
                    @else
                    </div>

                    <article id="comment-id-1" class="comment-item ">
                        <section class="comment-body panel-default">
                            <div class="alert alert-info">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <svg class="svg-inline--fa" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 512 512">
                                    <path d="M256 8C119.043 8 8 119.083 8 256c0 136.997 111.043 248 248 248s248-111.003 248-248C504 119.083 392.957 8 256 8zm0 110c23.196 0 42 18.804 42 42s-18.804 42-42 42-42-18.804-42-42 18.804-42 42-42zm56 254c0 6.627-5.373 12-12 12h-88c-6.627 0-12-5.373-12-12v-24c0-6.627 5.373-12 12-12h12v-64h-12c-6.627 0-12-5.373-12-12v-24c0-6.627 5.373-12 12-12h64c6.627 0 12 5.373 12 12v100h12c6.627 0 12 5.373 12 12v24z"></path>
                                </svg>Không có dữ liệu
                            </div>
                        </section>
                    </article>
                    @endif
                    <div class="{{$ctrl->name.@$lang}}_list_item_default" style="display:none">
                        <article id="comment-2" class="comment-item">
                            <a class="pull-left thumb-sm avatar">
                                <img src="https://www.gravatar.com/avatar/3c4df78c9199375dcb888f2e14d50b70.jpg?s=80&amp;d=mm&amp;r=g" class="img-circle" />
                            </a>
                            <span class="arrow left"></span>
                            <section class="comment-body panel panel-default">
                                <header class="panel-heading bg-white">
                                    <a href="#" class="text-semibold">
                                        
                                    </a>
                                    <label class="label bg-light m-l-xs"></label>
                                    <span class="text-muted m-l-sm pull-right">

                                        <!--<a href="#" class="deleteComment" data-comment-id="2" title="Delete ">
                                            <svg class="svg-inline--fa" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 448 512">
                                                <path d="M0 84V56c0-13.3 10.7-24 24-24h112l9.4-18.7c4-8.2 12.3-13.3 21.4-13.3h114.3c9.1 0 17.4 5.1 21.5 13.3L312 32h112c13.3 0 24 10.7 24 24v28c0 6.6-5.4 12-12 12H12C5.4 96 0 90.6 0 84zm416 56v324c0 26.5-21.5 48-48 48H80c-26.5 0-48-21.5-48-48V140c0-6.6 5.4-12 12-12h360c6.6 0 12 5.4 12 12zm-272 68c0-8.8-7.2-16-16-16s-16 7.2-16 16v224c0 8.8 7.2 16 16 16s16-7.2 16-16V208zm96 0c0-8.8-7.2-16-16-16s-16 7.2-16 16v224c0 8.8 7.2 16 16 16s16-7.2 16-16V208zm96 0c0-8.8-7.2-16-16-16s-16 7.2-16 16v224c0 8.8 7.2 16 16 16s16-7.2 16-16V208z"></path>
                                            </svg>
                                        </a>-->

                                    </span>
                                </header>
                                <div class="panel-body">

                                    <div class="text-justify">
                                        
                                    </div>


                                    <!--<a href="http://task.trungloi.vn/comments/edit/2" data-toggle="ajaxModal" class="pull-right m-r-sm">
                                        <svg class="svg-inline--fa" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 512 512">
                                            <path d="M497.9 142.1l-46.1 46.1c-4.7 4.7-12.3 4.7-17 0l-111-111c-4.7-4.7-4.7-12.3 0-17l46.1-46.1c18.7-18.7 49.1-18.7 67.9 0l60.1 60.1c18.8 18.7 18.8 49.1 0 67.9zM284.2 99.8L21.6 362.4.4 483.9c-2.9 16.4 11.4 30.6 27.8 27.8l121.5-21.3 262.6-262.6c4.7-4.7 4.7-12.3 0-17l-111-111c-4.8-4.7-12.4-4.7-17.1 0zM124.1 339.9c-5.5-5.5-5.5-14.3 0-19.8l154-154c5.5-5.5 14.3-5.5 19.8 0s5.5 14.3 0 19.8l-154 154c-5.5 5.5-14.3 5.5-19.8 0zM88 424h48v36.3l-64.5 11.3-31.1-31.1L51.7 376H88v48z"></path>
                                        </svg>
                                    </a>-->


                                    <div class="comment-action m-t-sm">
                                        <small class="block text-muted">
                                            <svg class="svg-inline--fa" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 512 512">
                                                <path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm57.1 350.1L224.9 294c-3.1-2.3-4.9-5.9-4.9-9.7V116c0-6.6 5.4-12 12-12h48c6.6 0 12 5.4 12 12v137.7l63.5 46.2c5.4 3.9 6.5 11.4 2.6 16.8l-28.2 38.8c-3.9 5.3-11.4 6.5-16.8 2.6z"></path>
                                            </svg>
                                            <spam class="text-date"></spam>
                                        </small>
                                    </div>

                                    <div class=""></div>
                                </div>
                            </section>
                        </article>
                    </div>
                </div>
            </section>
        </section>
    </div>

</div>


<style type="text/css">
    .comment-list {
        position: relative;
    }

        .comment-list .comment-item {
            margin-top: 0;
            position: relative;
        }

            .comment-list .comment-item > .thumb-sm {
                width: 36px;
            }

            .comment-list .comment-item .arrow.left {
                left: 39px;
                top: 20px;
            }

            .comment-list .comment-item .comment-body {
                margin-left: 46px;
            }

            .comment-list .comment-item .panel-body {
                padding: 10px 15px;
            }

            .comment-list .comment-item .panel-footer, .comment-list .comment-item .panel-heading {
                background-color: #fff;
                font-size: 12px;
                position: relative;
            }

        .comment-list .comment-reply {
            margin-left: 46px;
        }

        .comment-list::before {
            background: #e0e4e8 none repeat scroll 0 0;
            bottom: 35px;
            content: "";
            left: 18px;
            position: absolute;
            top: 0;
            width: 1px;
        }
    .arrow.left {
        border-left-width: 0;
        border-right-color: rgba(0, 0, 0, 0.1);
        left: -8px;
        margin-top: -8px;
        top: 50%;
    }

        .arrow.left::after {
            border-left-width: 0;
            border-right-color: #fff;
            bottom: -7px;
            content: " ";
            left: 1px;
        }
    .comment-list .comment-item .panel-footer, .comment-list .comment-item .panel-heading {
        background-color: #fff;
        font-size: 12px;
        position: relative;
    }

    .bg-light .lter, .bg-light.lter {
        background-color: #fefefe;
    }

    .bg-light {
        background-color: #f1f1f1;
        color: #717171;
    }

    .panel-footer {
        border-radius: 0 0 2px 2px;
        border-top: 1px solid #ddd;
        padding: 10px 15px;
    }
    .btn-rounded {
        border-radius: 50px;
    }
    svg {
        width: 16px;
    }
</style>
<script>
    @if($ctrl->att_table!='')
	var hiddentab = ".ctxdform";
	$(hiddentab).css("display", "none");
	$('{{".".implode(",.",explode(",", $ctrl->att_table))}}').fadeIn();
    @endif

    var tab = '.content_<?=@$ctrl->value?>';
    var e_avartar = '#<?=@$ctrl->att_where?>';
    var e_content = '#{{$ctrl->name}}';
</script>
<script>

    $(document).on('click', '.content_{{ $ctrl->value }} .btn-rounded', function () {
        var comment_content_json = $(e_content).val();
        if(comment_content_json!='')
            var comment_content = $.parseJSON(comment_content_json);
        else
            var comment_content = [];

        var fullDate = new Date($.now());
        var currentDate =  fullDate.getFullYear() +"/" + (fullDate.getMonth() + 1) + "/" + fullDate.getDate() + ' ' + fullDate.getHours() + ':'+fullDate.getMinutes() + ':'+fullDate.getSeconds();

        var currentDate_vn = fullDate.getDate() + "/" + (fullDate.getMonth() + 1) + "/" + fullDate.getFullYear() + ' ' + fullDate.getHours() + ':'+fullDate.getMinutes();

        var date = currentDate;//$(this).find('.row_title').val();
        var user = '{{App\Model\Admin::_full_name()}}';//$(this).find('.row_image').val();
        var content = $('#comment-editor').val();

        var obj_detail = {
            date: date,
            user:user,
            content: content,

        };
        comment_content.unshift(obj_detail);

        $('#comment-id-1').remove();

        $(e_content).val(JSON.stringify(comment_content));
        var html = $('.{{$ctrl->name.$lang}}_list_item_default');
        $('.content_{{$ctrl->value}} .list_item').prepend(html.html());

        var html_ele = $('.content_{{$ctrl->value}} .list_item > article').first();
        //image
        html_ele.find('.text-semibold').html(user);
        html_ele.find('.text-justify').html('<p>'+content+'</p>');


        html_ele.find('.text-date').html(currentDate_vn);

        ci_submit('apply');
    });

  
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