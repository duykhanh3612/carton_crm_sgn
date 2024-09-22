<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>API Docs</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css'>
    <link rel="stylesheet" href="{{asset}}api/docs/assets/module/page/api.css">

</head>

<body>
    <!-- partial:index.partial.html -->
    <!-- Working version of https://dribbble.com/shots/14552329--Exploration-Task-Management-Dashboard -->
    <div class='app'>
        <main class='project-nav'>
            <div class='project-info'>
                <h1>Docs</h1>
            </div>
            <div class='project-tasks'>
                <div class='project-column'>
                    <div class='project-column-heading'>
                        <h2 class='project-column-heading__title'>Menus</h2>

                        <button class='project-column-heading__options task__options is-dev hidden'>
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                        <ul class="task__options_menu">
                            <li class='update-project-setting' id="btn-create-api" >Add New Api</li>
                            <li id="btn-create-group" >Add New Group</li>
                            <li>
                                <a href="#">Local</a>
                                <ul class="task__options_menu_child">
                                    <li><a href="" target="_blank">Log View</a></li>
                                </ul>

                            </li>
                            <li>
                                <a href="#">Kim Phat</a>
                                <ul class="task__options_menu_child">
                                    <li><a href="https://kim-phat-crm-mua-hang.vercel.app/" target="_blank">KimPhat Vercel</a></li>
                                    <li>
                                        <a href=" https://docs.google.com/spreadsheets/d/13lu_tBWajYLyfKwj3MM1AQpYwBuA9HV8LR9WmcLT6n0/edit#gid=205223189" target="_blank">
                                            Feedback 19/1
                                        </a>
                                    </li>
                                    <li><a href="https://apikimphat.hahoba.com/logview" target="_blank">Log View</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class='task' draggable='false'>
                        <div class='task__tags'>
                            <ul class="task__list">
                                @foreach($category as $cate)
                                @php $items = $docs[$cate->id]??[]; @endphp
                                @if(!empty($items))
                                <li class="has_sub">
                                    <h6 class="d-flex justify-content-between">

                                            {{$cate->name}}


                                        <i class="fa fa-angle-down" data-toggle="collapse" data-target="#cate_{{$cate->id}}" aria-expanded="false" aria-controls="cate_{{$cate->id}}"></i>

                                    </h6>
                                    <ul class="drapsort task__list_sub_2 collapse  {{$cate->collapse}}" id="cate_{{$cate->id}}">
                                        @foreach($items as $doc)
                                        <li class="" data-sort="{{$loop->index+1}}">
                                            <a class="call_api" href="{{@$doc->link}}" data-id="{{@$doc->id}}"  data-para='{{@$doc->params}}' data-method="{{@$doc->method??"GET"}}">
                                                {{@$doc->name}}
                                            </a>
                                            <a href="#" class="task__list_item_right is-dev hidden" target="_blank"><i class="fa fa-edit"></i></a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                                @endif
                                @endforeach
                            </ul>
                        <div class='task__stats'>
                          <span><time datetime="2021-11-24T20:00:00"><i class="fas fa-flag"></i><em class="report_time"></em></time></span>
                          <span><i class="fas fa-comment"></i><em class="report_project"></em></span>
                          <span class="panel_report_task"><i class="fas fa-paperclip"></i><em class="report_task"></em></span>
                          <span class="panel_report_ticket"><i class="fas fa-paperclip"></i><em class="report_ticket"></em></span>

                        </div>
                      </div>
                </div>
                <div class='project-column'>

                </div>
            </div>
        </main>
        <aside class='task-details'>
            <div class="navbar">
                <select class="api_method">
                    <option value="GET">GET</option>
                    <option value="POST">POST</option>
                </select>
                <input class="api_uri">
                <span style="    display: block;background: #fff;    padding: 9px;">
                    <input type="checkbox" id="remote_uri" />
                </span>
            </div>
            <div class="widget-content">
                <div class="widget-left">
                    <div class='project-column-heading'>
                        <h2 class='project-column-heading__title'>Global variable </h2><button
                            class='project-column-heading__options'><i class="fas fa-ellipsis-h"></i></button>

                    </div>
                    <div>
                        <ul class="global_variable">

                        </ul>
                    </div>
                    <div class='project-column-heading'>
                        <h2 class='project-column-heading__title'>Para</h2><button
                            class='project-column-heading__options'><i class="fas fa-ellipsis-h"></i></button>

                    </div>
                    <div class="task" draggable="false" data-id="bjI3Q3F0RFJVbHU5eHZvZXRhTHlTQT09" data-sort="null">
                        <div class="task__desc">
                            <table class="api_para" id="api_para">
                                <thead>
                                    <tr>
                                        <th style="width: 30px;">#</th>
                                        <th style="width: 200px;">KEY</th>
                                        <th>VALUE</th>
                                        <th>DESCRIPTION</th>
                                        <th>Type</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            <table class="api_para_sample">
                                <tfoot>
                                    <tr>
                                        <td colspan="4" style="border-bottom: 2px solid #6d6767;    padding: 0;"></td>
                                    </tr>
                                    <tr id="para-sample">
                                        <td>
                                            <input class="key" placeholder="Input Key" />
                                        </td>
                                        <td>
                                            <input class="value" placeholder="Input Value" />
                                        </td>
                                        <td>
                                            <input class="description" placeholder="Input Description" />
                                        </td>
                                        <td>
                                            <input class="type" placeholder="Input Type" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" style="border-top: 2px solid #6d6767;padding:0;border-bottom: 0 !important;margin:0"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <button id="btn-add-para" class="btn mr-20"><i class="fa fa-plus"></i>Add Key</button>
                                            <button id="btn-add-para-detail" class="btn mr-20"><i class="fa fa-plus"></i>Add Detail</button>
                                            <button id="btn-refresh-api" class="btn"><i class="fa fa-refesh"></i>Refresh</button>
                                        </td>

                                        <td>
                                            <button id="btn-update-api" class="btn is-dev hidden" data-id=""><i class="fa fa-external-link"></i>Update</button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="4">
                                            Keys: <span id="list_key"></span> <i class="fa fa-copy func-copy" data-tag="#list_key" style="float: right;"></i>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            Keys Item: <span id="list_key_items"></span> <i class="fa fa-copy func-copy" data-tag="#list_key" style="float: right;"></i>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            Para String: <span id="list_para"></span>

                                            <i class="fa fa-copy func-copy" data-tag="#list_para" style="float: right;"></i>

                                            <i class="fa fa-arrow-down get-paras" style="float: right;margin-right: 15px;"></i>
                                        </td>
                                    </tr>
                                    <tr>

                                        <td colspan="4" class="para_description">

                                        </td>
                                    </tr>

                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class='project-column-heading is-dev hidden' id="api_para_field_module">
                        <h2 class='project-column-heading__title'>Fields</h2>
                        {{-- <button class='project-column-heading__options'><i class="fas fa-ellipsis-h"></i></button> --}}
                        <button class='project-column-heading__options task__options '>
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                        <ul class="task__options_menu">
                            <li class='load-para-fields'>Refesh</li>
                        </ul>
                    </div>
                    <div class="task is-dev hidden" draggable="false" data-id="bjI3Q3F0RFJVbHU5eHZvZXRhTHlTQT09" data-sort="null">
                        <div class="task__desc">
                            <table class="api_para_field">
                                <thead>
                                    <th>KEY</th>
                                    <th>Name</th>
                                    <th class="text-center" style="width:50px;"><i class="show_field_row fa fa-list"></i></th>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="widget-right">
                    <ul class="api_tab">
                        <li>Body</li>
                        <li>Cookies</li>
                        <li>Headers</li>
                    </ul>

                    <div class="api_body">
                        <ul class="api_body_tab tabs">
                            <li data-tab="#pretty">Pretty</li>
                            <li data-tab="#raw">Raw</li>
                            <li data-tab="#preview">Preview</li>
                            <li ><small id="api_summary"></small></li>
                        </ul>

                        <div id="pretty" class="container response_pretty" style="padding:0;">
                            <pre id="json-display"></pre>
                        </div>
                        <div id="raw" class="container">
                            <span class="response"></span>
                            <i class="fa fa-copy func-copy container-icon-right" data-tag=".response"></i>
                        </div>
                        <div id="preview" class="container">
                            <span class="review">

                            </span>
                            <i class="fa fa-copy func-copy container-icon-right" data-tag=".review"></i>
                        </div>
                    </div>
                </div>
            </div>


        </aside>
    </div>
    <div class="modal" id="popupApi">
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Api</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
                <form id="popupApiForm" data-sb-form-api-token="API_TOKEN" action="{{url("admin/api/doc/update")}}" method="">
                    <div class="container">

                            <div class="form-floating mb-3">
                                <input class="form-control" name="name" type="text" placeholder="Name" />
                                <label for="emailAddress">Name</label>
                            </div>


                            <div class="input-group mb-3">
                                <div class="form-floating mb-3">
                                    <select class="form-control" name="parent" placeholder="Group">
                                        <option value=""></option>
                                        @foreach($category as $cate)
                                        <option value="{{$cate->id}}">{{$cate->name}}</option>
                                        @endforeach
                                    </select>


                                    <label for="emailAddress">Group</label>

                            </div>
                            <div class="input-group-append" style="margin: 0 0px 16px 0;background: #e1e1db;padding: 5px;display: flex;justify-content: center;align-items: center;gap: 10px;">
                                <input type="checkbox" id="check_new_group" form="">

                                <label for="check_new_group">  Create New</label>
                            </div>
                            </div>
                            <div class="form-floating mb-3 group_name" style="display: none">
                                <input class="form-control" name="group_name" type="text" placeholder="Group Name" />
                                <label for="emailAddress">Group Name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" name="link" type="text" placeholder="Link" />
                                <label for="emailAddress">Link</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-control" name="method" placeholder="Method">
                                    <option>GET</option>
                                    <option>POST</option>
                                </select>
                                <label for="emailAddress">Mehod</label>
                            </div>

                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="description" name="description" type="text" placeholder="Message" style="height: 10rem;" data-sb-validations="required"></textarea>
                                <label for="message">Message</label>
                                <div class="invalid-feedback" data-sb-feedback="message:required">Message is required.</div>
                            </div>
                            <div class="d-none" id="submitSuccessMessage">
                                <div class="text-center mb-3">
                                    <div class="fw-bolder">Form submission successful!</div>
                                    <p>To activate this form, sign up at</p>
                                    <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                                </div>
                            </div>
                            <div class="d-none" id="submitErrorMessage">
                                <div class="text-center text-danger mb-3">Error sending message!</div>
                            </div>


                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-primary" id="btn-process-create-api">Save</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-close-create-api">Close</button>
            </div>

          </div>
        </div>
      </div>
    <!-- partial -->
    <script src="{{asset}}/plugin/jquery/jquery-3.4.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/js/all.min.js'></script>
    {{-- <script src="{{asset}}api/docs/plugin/task-management-ui/dist/script.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.min.js" integrity="sha512-WW8/jxkELe2CAiE4LvQfwm1rajOS8PHasCCx+knHG0gBHt8EXxS6T6tJRTGuDQVnluuAvMxWF4j8SNFDKceLFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js" integrity="sha512-3j3VU6WC5rPQB4Ld1jnLV7Kd5xr+cq9avvhwqzbH/taCRNURoeEpoPBK9pDyeukwSxwRPJ8fDgvYXd6SkaZ2TA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

     <link rel="stylesheet" href="{{asset}}/plugin/bootstrap/5.3.2/css/bootstrap.min.css">
     <script src="{{asset}}api/docs/js/jquery/bootstrap-notify.js"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/styles/metro/notify-metro.css" />
     <script type="text/javascript" src="{{asset}}api/docs/js/jquery/Beautiful-JSON-Viewer-Editor/dist/jquery.json-editor.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.css"/>

     <script src="https://cdnjs.cloudflare.com/ajax/libs/TableDnD/1.0.5/jquery.tablednd.min.js" integrity="sha512-uzT009qnQ625C6M8eTX9pvhFJDn/YTYChW+YTOs9bZrcLN70Nhj82/by6yS9HG5TvjVnZ8yx/GTD+qUKyQ9wwQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     <script src="{{asset}}/plugin/table/drag-n-drop-table-columns/dist/for-jQuery3.x/dragndrop.table.columns.js"></script>
    <script src="{{asset}}api/docs/js/api.js"></script>
    <script>
        $(document).ready(function(){
            $("#api_para").tableDnD();
        })
    </script>

</body>
</html>
