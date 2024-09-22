
<div class="form-group {{  $ctrl->width}} desktop ">
    <div class="row">


        <div class="col-md-3 page-sidebar-wrapper">
            <div class="page-sidebar navbar-collapse">
                <div class="sidebar">
                    <div class="sidebar-content">
                        <ul class="page-sidebar-menu page-header-fixed" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                            <li class="nav-item " id="cms-core-dashboard" >
                                <a href="javascript:;" class="nav-link nav-toggle" data-slug="login">
                                    <i class="fa fa-users"></i>
                                    <span class="title">
                                        Đăng nhập hệ thống
                                    </span>
                                </a>
                            </li>

                            @php
             $func_parent = h::getData(functions,'parent',0);
             @endphp
                    @foreach($func_parent as $func)
                    @php
             $para_page = Request::segment(2);
             $page = @h::getData(functions,'phpfile',$para_page)[0]->parent;
             $subfuns = h::getData(functions,'parent',$func->id);
             @endphp
                        @if($func->title_vn !="Hệ thống" && $func->title_vn !="Custom fields" )
                            @if(count(@$subfuns)>0 && @$function[$func->id]['pread']==1)
                            @if(@$function[$func->id]['pread']==1)
                            <li class="nav-item" data-id="{{ $func->id }}" title="level-1">

                                <a href="javascript:;" class="nav-link nav-toggle" data-slug="cap-nhap-page">
                                    <i class="{!! $func->icon_large !!}"></i>
                                    <span class="title">
                                        {{   $func->title_vn}}
                                    </span>
                                    <span class="arrow "></span>
                                </a>

                                @if(count($subfuns)>0)
                                <ul class="sub-menu  hidden-ul " title="level-2">
                                    @foreach($subfuns as $sub2)
                                        @php $subfuns3 = h::getData(functions,'parent',$sub2->id); @endphp

                                        @if(@$function[$sub2->id]['pread']==1)
                                    <li class="nav-item " id="cms-plugins-blog-post" >
                                        @if(count($subfuns3)>0)
                                        <a href="javascript:;" class="nav-link nav-toggle" data-menu="{{$sub2->id}}" data-slug="cap-nhap-page">
                                            <span class="nav-text">{{    $sub2->title_vn}} </span>
                                        </a>
                                        <ul class="sub-menu  hidden-ul " title="level-3">
                                            @foreach($subfuns3 as $sub3)
                                                @if(@$function[$sub3->id]['pread']==1)
                                            <li class="nav-item " id="cms-plugins-blog-post" >
                                                <a href="javascript:;" class="nav-link" data-menu="{{$sub3->id}}" data-slug="cap-nhap-page">
                                                    <span class="nav-text">{{    $sub3->title_vn}} </span>
                                                </a>
                                            </li>
                                            @endif


                                                @endforeach
                                        </ul>
                                        @else
                                        <a href="javascript:;" class="nav-link" data-menu="{{$sub2->id}}" data-slug="cap-nhap-page">
                                            <span class="nav-text">{{    $sub2->title_vn}} </span>
                                        </a>
                                        @endif


                                    </li>
                                    @endif


                                        @endforeach
                                </ul>
                                @endif
                            </li>
                            @endif


                                @else
                            <!-- Sub 1-->
                            @if(@$func->phpfile!='' && @$function[$func->id]['pread']==1)
                            <li class="func_{{$func->id}}"  title="level-1-no-child" >
                                <a href="javascript:;" style="padding-left:5px" data-menu="{{$func->id}}" data-slug="cap-nhap-page">
                                    <span class="nav-icon" style="margin-right:2px;">
                                        <i class="{{$func->icon_large}}"></i>
                                    </span>
                                    <span class="nav-text">{{    $func->title_vn}}</span>
                                </a>
                            </li>
                            @endif
                            <!-- Sub 1-->
                            @endif
                            @endif
                        @endforeach
                          
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9" id="manual_content"></div>
    </div>
    <style type="text/css">
                table, th, td {
              border: 1px solid black;
            }
                .page-sidebar-menu page-header-fixed{
                    list-style:none
                }
    </style>
    <script>
         $('.page-sidebar-menu>li').find('a').on('click', function () {
             let slug = $(this).data('slug');
             var form_data = new FormData();
             form_data.append("_token", '{{ csrf_token() }}');
             form_data.append("slug", slug);
             form_data.append("template", "{{$template}}");
             form_data.append("func_id", $(this).data('menu'));
                 $.ajax({
                     url: "{{url('admin/ajax/manual')}}",
                    cache: false,
                    contentType: false,
                    processData: false,
                     data: form_data,
                     dataType: 'json',
                    type: 'POST',
                    success: function (data) {
                        $('#manual_content').html(data.content);
                    }
                 });




          });
    </script>
</div>
