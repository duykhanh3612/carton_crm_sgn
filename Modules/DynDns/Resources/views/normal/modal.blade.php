@php
if($func->field_id=='')
    $func->field_id='id';
@endphp
<div id="model-box" class="modal fade" role="dialog"></div><!--/.#dangtin-->

<div class="page-content-wrapper animated fadeInRight">
    <div class="page-content">
        <div class="row wrapper border-bottom page-heading">
            <div class="col-lg-12">
                <h2>{{@$conf->cp_vn }} </h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{Url::to('/')}}">Home</a>
                    </li>
                    <li class="active">
                        <strong>
                            {{@$title }}
                        </strong>
                    </li>
                </ol>
            </div>
            <div class="col-lg-12"></div>
        </div>
        @if(@$controls_search)
        <div class="wrapper-content ">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>{{__('lang.locketqua')}}</h5>
                        </div>
                        <div class="ibox-content collapse in">
                            <div class="widgets-container md_line_box">
                                <div>
                                    <form name="form_admin" method="post">
                                        <div class="form-body">
                                            <?php
                                                          foreach($controls_search as $ctrl){
                                                              $pair['src'] = @$tag['src'][$ctrl->name];
                                                              $pair['ctrl'] = $ctrl;
                                                              //$pair['path_base'] = $path_base;
                                                              $pair['lang'] = $ctrl->language==1?_lang:'';
                                                              $pair['func'] = $func;
                                                              if($ctrl->search_type!='')
                                                              echo View(\h::area_admin.'::sys.template.normal.search.'.$ctrl->search_type, $pair);
                                                          }
                                            ?>
                                        </div>
                                        <div style="clear:both"></div>
                                        <div class="btn-group" style="padding-left:5px;">
                                            <a href="#">
                                                <button id="sample_editable_1_new" class="btn sbold blue">
                                                    {{__('lang.loc')}}
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </a>
                                            <!--<a href="javascript::">

                                                    <button id="sample_editable_1_new" class="btn sbold cyan" type="reset">
                                                        Reset

                                                        <i class="fa fa-refesh"></i>

                                                    </button>

                                                </a>-->
                                        </div>
                                        {!!\h::token() !!}
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        @endif
        <div class="wrapper-content ">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Danh sách </h5>
                            <div class="navbar_menu">{!!$button !!}</div>
                        </div>
                        <div class="ibox-content collapse in">
                            <div class="widgets-container">
                                <div>
                                    <form name="form_admin" method="post">
                                        <table id="example2" class="table   nowrap table-bordegreen dataTable" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    @if($func->action!='none')
                                                    <th width="5" style="border-right:1px dashed">
                                                        &nbsp; &nbsp;&nbsp;
                                                        <input id="chkHeader" name="chkHeader" class="check_all" type="checkbox" />
                                                    </th>
                                                    <th width="20" style="border-right:1px dashed">
                                                        &nbsp; &nbsp;
                                                        <span class="icon fa fa-ellipsis-h" style="color:red;font-size:18px;"></span>
                                                    </th>
                                                    @endif
                                                    <?php if(@$controls_index) foreach(@$controls_index as $ctrl):?>
                                                    <th {{$ctrl->type=='published'?"style='width:50px;'":""}}>
                                                        <?=@$ctrl->title?>
                                                    </th>
                                                    <?php endforeach?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($rows as $row)
                                                <tr>
                                                    @if($func->action!='none')
                                                    <td align="center" style="border-right:1px dashed">
                                                        <input type="checkbox" name="chkid[]" value="<?=@$row->id?>" onclick="checkidChecked();" />
                                                    </td>
                                                    <td align="center" style="border-right:1px dashed">
                                                        <input alt="" data-delete-confirm="" data-href="{{h::site_url(\h::_area.'/'.request()->segment(2).'/del/'.@$row->{$func->field_id})}}" class="tooltip btgrid delete" type="button" />
                                                        <a href="">
                                                            <span class="icon fa fa-remove" style="color:red;font-size:18px;"></span>
                                                        </a>

                                                        <!--<a href="{{    h::site_url(\h::_area.'/'.request()->segment(2).'/del/'.@$row->{$func->field_id})}}">
                                                            <span class="icon fa fa-remove" style="color:red;font-size:18px;"></span>
                                                        </a>-->
                                                        <a data-id="{{@$row->{$func->field_id} }}" href="javascript:;" class="edit_modal">
                                                            <span class="icon fa fa-edit" style="color:orangered;font-size:18px;"></span>
                                                        </a>
                                                    </td>
                                                    @endif
                                                    <?php if(@$controls_index)
                                                              foreach($controls_index as $ctrl){
                                                                  $pair['row'] = @$row;
                                                                  $pair['ctrl'] = $ctrl;
                                                                  $pair['path_base'] = $path_base;
                                                                  $pair['lang'] = @$ctrl->language==1?_lang:'';
                                                                  $pair['func'] = $func;
                                                                  if($ctrl->type!='')
                                                                    echo View(\h::area_admin.'::sys.template.normal.index.'.$ctrl->type, $pair);
                                                              }
                                                    ?>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {!!$rows->links() !!}
                                       {!!\h::token() !!}
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <!-- start footer -->
        <!--<div class="footer">
            <div class="pull-right">
                <ul class="list-inline">
                    <li>
                        <a title="" href="index.html">Dashboard</a>
                    </li>
                    <li>
                        <a title="" href="mailbox.html">Inbox </a>
                    </li>
                    <li>
                        <a title="" href="blog.html">Blog</a>
                    </li>
                    <li>
                        <a title="" href="contacts.html">Contacts</a>
                    </li>
                </ul>
            </div>
            <div>
                <strong>Copyright</strong>AdminUI Company &copy; 2017
            </div>
        </div>-->
    </div>
</div>
<div id="modal" class="modal fade" role="dialog" style="z-index:99999999999;width:100%;height:100%">

    <div class="modal-dialog">
        <div class="modal-content" style="height:100%">
            <!--<button type="button" class="close" data-dismiss="modal" style="position:absolute;right:0px;top:0px;border-radius:50%;z-index:999999999999999999">&times;</button>-->
            <!-- Modal Header -->
            <!--<div class="modal-header">
                    <h4 class="modal-title">Modal Heading</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>-->

            <!-- Modal body -->

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="smalltitle">{{$func->title_vn}}</h4>
                <em>
                    <span class="icon-map-marker"></span>
                </em>
            </div>
            <div class="modal-body">
                <iframe src="{{$func->modal_link}}" id="frame_modal" frameborder="0" width="100%"  marginwidth="0" style="margin:0px"></iframe>
            </div>

            <!-- Modal footer -->
            <!--<div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>-->
            <style type="text/css">
                .modal-header {
                    background: #04757a none repeat scroll 0 0;
                    border-bottom: 0 none;
                    border-radius: 6px 6px 0 0;
                    color: #fff;
                    padding: 1px;
                }
                .modal-body {
                    height: 100%;
                } 
                #frame_modal {
                    height: 100%;
                } 
                .modal-header .close {
                    margin-top: -2px;
                    font-size: 32px;
                    position: absolute;
                    top: 15px;
                    right: 10px;
                }

                .modal-body {
                    padding: 0px;
                    margin: 0px;
                }

                button.close {
                    background: transparent none repeat scroll 0 0;
                    border: 0 none;
                    cursor: pointer;
                    padding: 0;
                }

                .close {
                    color: #fff;
                    float: right;
                    font-size: 21px;
                    font-weight: bold;
                    line-height: 1;
                    text-shadow: 0 1px 0 #fff;
                }

                .modal-header .smalltitle {
                    color: #fff;
                    font-size: 25px;
                    line-height: 1;
                }

                .smalltitle {
                    color: #04757a;
                    font-family: "DGTT",Arial;
                    font-size: 22px;
                    font-style: normal;
                    margin: 10px 0px 20px 10px;
                    position: relative;
                    text-transform: uppercase;
                }

                    .smalltitle::after {
                        border-top: 3px solid #f5891f;
                        bottom: -8px;
                        content: "";
                        left: 0;
                        position: absolute;
                        width: 80px;
                    }
            </style>
        </div>
    </div>
</div><!--/.#dangtin-->
@php
    $arr = array();
    if(@$center_ctrl)
    foreach(@$center_ctrl as $ctrl){
        if($ctrl->type=='static') 
            $arr[@$ctrl->name] = @$ctrl->value;
    }
    $str_add_field = h::crypt(json_encode($arr),'e');
@endphp
<script>

    $('#new_modal').on('click', function () {
        var url_link = "{{$func->modal_link}}?path_upload={{$group->path_upload}}&alias={{$group->alias}}&add_field={{@$str_add_field}}";
        $('#frame_modal').attr('src',url_link);
        $('.modal-dialog').width(1000);
        $('.modal-dialog').height(600);
        $('#modal').modal('show');

    });

    $('.edit_modal').on('click', function () {
        var id = $(this).attr('data-id');
        var url_link = "{{$func->modal_link}}" + '/' + id + "?path_upload={{$group->path_upload}}&alias={{$group->alias}}&add_field={{@$str_add_field}}";
        $('#frame_modal').attr('src',url_link);
        $('.modal-dialog').width(1000);
        $('.modal-dialog').height(600);
        $('#modal').modal('show');
    });

    var timeOut;
    $(".modal_poup").on('click', function () {
        var _id = $(this);
       var url = $(this).attr('data-url');
        if (timeOut != null) {
            clearTimeout(timeOut);
        }
        timeOut = setTimeout(function () {
            var id = _id.attr('data-id');
            $.get(url, { id: id }, function (data) {
                $("#model-box").html(data);
                $("#model-box").modal("show");
               // $("#btn-save").on('click', function () {
                    //$(".from_modal").submit();
                   //$("#hoanthanh").modal("show");
                //})
            });

        }, 600);
    });
</script>
@extends(h::area_admin.'::layout.icon')
@extends(h::area_admin.'::sys.template.script')
