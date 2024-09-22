@push('plugin_css')
    <link rel="stylesheet" href="{{ asset('public/themes/admin/css/treeview.css') }}">
@endpush
@push('nav-header')
    <div class="group-process">
        <?php if (isset($export)) : ?>
        <?php if (count($export) > 0) : ?>
        <div class="dropdown">
            <button type="button" class="btn btn-border btn-alt border-black font-black waves-effect dropdown-toggle"
                title="Export to Excel" data-toggle="dropdown"><i class="glyph-icon icon-download"></i></button>
            <ul class="dropdown-menu dropdown-menu-right">
                <?php foreach ($export as $key => $val) : ?>
                <?php if ($key === 'EXCEL' && (empty($val) || $val == '#')) : ?>
                <li class="dropdown-item"><a class="exports-part-file" href="javascript:;" data-placement="bottom"
                        title="Exports">
                        <?= $key ?>
                    </a></li>
                <?php else : ?>
                <li class="dropdown-item"><a target="_blank" href="<?= $val ?>">
                        <?= $key ?>
                    </a></li>
                <?php endif ?>
                <?php endforeach ?>
            </ul>
        </div>
        <?php else : ?>
        <a class="btn btn-border btn-alt border-blue font-blue tooltip-link exports-part-file" href="javascript:;"
            data-href="modules/export/<?= $modulePart ?>" data-placement="bottom" title="Exports"><i
                class="glyph-icon icon-download"></i></a>
        <?php endif ?>
        <?php endif ?>
        <a class="btn btn-border btn-alt border-purple font-purple tooltip-link part-show-hide" href="javascript:;"
            data-placement="bottom" title="Display">
            <i class="fa fa-th-list" aria-hidden="true"></i>
        </a>
    </div>
@endpush

{!! Themes::modules('header', $module) !!}
<section class="content">
    <div class="container-fluid">


        <!-- Tiêu đề -->
        <div id="productGeneralInfo" class="position-relative">
            <input id="act" type="hidden" value="{{ $GLOBALS['var']['act'] }}">
            <input id="do" type="hidden" value="{{ request()->segment(4)==''?__('create'): __('update') }}">
            <div id="page-content">
                <form action="{{ url('admin/' . $GLOBALS['var']['act'] . '/process') }}" method="post" enctype="multipart/form-data" accept-charset="utf-8" id="updateFrm"
                    class="updateFrm form-horizontal bordered-row" data-uniquire="{{$module['check_unique']}}">
                    <div id="information" class="row">
                        {{-- <div class="form-group">
                            <div class="col-sm-3 control-label">Field <span style="color:red">*</span></div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" data-required="1" name="Field" id="Field" value="<?= @$info['Field'] ?>" />
                                <input type="hidden" class="form-control" name="type" id="type" value="<?= isset(request()['type']) ? request('type') : @$info['type'] ?>" />
                                <div class="errordiv Name">
                                    <div class="arrow"></div>Please input Field!
                                </div>
                            </div>
                        </div> --}}
                        @php $col_right = 0; @endphp
                        @foreach ($cols as $key => $col)
                            @php

                                if($col->align == "right") $col_right++;
                            @endphp
                            @push('col_' . $col->align)
                                {{-- <div class="form-group"> --}}
                                    <div class="col-sm-{{ @$col->width ?? 12 }} control-label  {{@$col->nowrap?'d-flex':''}} {{@$col->lock?'lock':''}}">
                                        <div class="{{@$col->nowrap?'':''}} control-label">
                                            {{ @$col->name }}
                                            {!! @$col->required ? '<span style="color:red">*</span>' : '' !!}
                                        </div>
                                        <div class="{{@$col->nowrap?'':''}}">
                                            @php
                                                $mask = isset($col->mask) ? '.' . $col->mask : '';
                                                $col->name = $key;
                                                $col->value = @$row->{$key};
                                                if(isset($row->{$key."_name"}))
                                                {
                                                    $col->value_name = $row->{$key."_name"};
                                                }

                                                $col->id = @$row->id;
                                                $col->row = @$row;
                                                if (!view()->exists("atc::components.input.$col->type.$mask")) {
                                                    $mask = '';
                                                }
                                            @endphp
                                            @if (view()->exists("atc::components.input.$col->type" . $mask))
                                                {!! view("atc::components.input.$col->type" . $mask, (array) $col) !!}
                                            @else
                                                {!! view("atc::components.input.$col->type", (array) $col) !!}
                                            @endif
                                        </div>
                                    </div>

                                {{-- </div> --}}
                            @endpush
                        @endforeach
                        <div class="col-sm-{{$col_right>0?9:12}}">
                            <div class="row">
                                @stack('col_left')
                            </div>
                        </div>
                        <div class="col-sm-{{$col_right>0?3:0}} col-right">@stack('col_right')</div>
                    </div>

                    @csrf
                    <input type="hidden" name="id" value="{{ @$row->id }}" />
                    {{-- <input id="language_code" name="language_code" type="hidden" value="{{ request()->language_code ?? config('app.locale') }}">
                    <input id="language_meta" name="language_meta" type="hidden" value="{{ !empty(request()->language_meta) ? request()->language_meta : (!empty($id) ? $id : randomKey()) }}"> --}}
                    {{-- @include('admin::layouts.form_action') --}}
                    <div class="d-flex justify-content-between">
                        <div class="message">
                            @if($errors->any())
                            <h4 class="error_message">{{$errors->first()}}</h4>
                            @endif
                            @if (session('message'))
                                <div class="alert" style="color: red">{{ session('message') }}</div>
                            @endif

                            @if (session('alert_message'))
                            <div id="alert_message" class="alert alert-success" style="display: none">
                                {{ session('alert_message') }}
                            </div>
                            @endif
                            @if (session('alert_message_error'))
                            <div id="alert_message_error" class="alert alert-error" style="display: none">
                                {{ session('alert_message_error') }}
                            </div>
                            @endif

                        </div>
                        @if(!request()->ajax())
                        <div class="d-flex justify-content-end mt-4" style="gap: 8px; top: 0px; right: 30px">
                            @include('plugin::carton-crm.core.form_action')
                        </div>
                        @endif
                    </div>
                </form>
            </div>

        </div>

    </div>
    <!-- /.container-fluid -->
</section>



@if(request()->ajax())
<script>

    $(document).on("change", "#name, #phone",function(){
        var form =  $("#updateFrm");
        var actionUrl = form.attr('action');
        $.ajax({
            type: "POST",
            url: "{{ url('admin/' . $GLOBALS['var']['act'] . '/check_exists') }}",
            data: form.serialize(), // serializes the form's elements.
            success: function(data)
            {
                $.LoadingOverlay("hide");
                if(data.code == 201)
                {
                    showNoti(data.data,"Thông báo","error");
                }

            }
        });
    });


    if($("#updateFrm").data("uniquire")){
        $( "#updateFrm").on("submit", function( event ) {
            event.preventDefault();
            if(!checkValidate($('#updateFrm')))
            {
                $.LoadingOverlay("hide");
                var form = $(this);
                var actionUrl = form.attr('action');
                $.ajax({
                    type: "POST",
                    url: "{{ url('admin/' . $GLOBALS['var']['act'] . '/check_exists') }}",
                    data: form.serialize(), // serializes the form's elements.
                    success: function(data)
                    {
                        $.LoadingOverlay("hide");
                        if(data.code == 201)
                        {
                            showNoti(data.data, lang("Notification"), "error");
                        }
                        else{
                            var form = $("#updateFrm");
                            var actionUrl = form.attr('action');

                            $.ajax({
                                type: "POST",
                                url: actionUrl,
                                data: form.serialize(), // serializes the form's elements.
                                success: function(data)
                                {
                                    // $("#modalFormUpdate").modal("hide");
                                if(data.code == 200)
                                {
                                    showNoti(data.message, lang("Notification"), "ok");
                                    setTimeout(function () {
                                        location.reload();
                                    }, 1000);
                                }
                                else
                                    showNoti(data.message, lang("Notification"), "error");
                                }
                            });
                        }
                    }
                });
            }
        });
    }
    else{
        $( "#updateFrm").on("submit", function( event ) {
            event.preventDefault();
            if(!checkValidate($('#updateFrm')))
            {
                var form = $("#updateFrm");
                var actionUrl = form.attr('action');

                $.ajax({
                    type: "POST",
                    url: actionUrl,
                    data: form.serialize(), // serializes the form's elements.
                    success: function(data)
                    {
                        // $("#modalFormUpdate").modal("hide");
                    if(data.code == 200)
                    {

                        showNoti(data.message, lang("Notification"), "ok");
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    }
                    else
                        showNoti(data.message, lang("Notification"), "error");
                    }
                });
            }
        });

    }

    // $(document).on("click","#btn-frm-apply",function(){
    //     $("#updateFrm").append("<input type='hidden' name='submit' value='apply />");
    //     updateFrm();
    // });
</script>
@else

    @push('js')
        <script>
            $("#btn-frm-apply").click(function(){
                $("#updateFrm").append("<input type='hidden' name='action' value='apply' />");
                updateFrm();
            });
            $("#btn-frm-save").click(function(){
                updateFrm();
            });
            $(document).ready(function(){
                if( $("#alert_message").length)
                {
                    showNoti($("#alert_message").text());
                }
            });
        </script>
    @endpush
@endif

<script>
    function updateFrm()
    {
        if(!checkValidate($('#updateFrm')))
        {
            if($("#updateFrm").data("uniquire")){
                $.LoadingOverlay("hide");
                var form = $("#updateFrm");
                var actionUrl = form.attr('action');
                $.ajax({
                    type: "POST",
                    url: "{{ url('admin/' . $GLOBALS['var']['act'] . '/check_exists') }}",
                    data: form.serialize(), // serializes the form's elements.
                    success: function(data)
                    {
                        $.LoadingOverlay("hide");
                        if(data.code == 201)
                        {
                            showNoti(data.data, "Thông báo", "error");
                        }
                        else{
                            $("#updateFrm").submit();
                            // var form = $("#updateFrm");
                            // var actionUrl = form.attr('action');

                            // $.ajax({
                            //     type: "POST",
                            //     url: actionUrl,
                            //     data: form.serialize(), // serializes the form's elements.
                            //     success: function(data)
                            //     {
                            //         // $("#modalFormUpdate").modal("hide");
                            //         location.reload();
                            //     }
                            // });

                        }
                    }
                });
            }else{
                $("#updateFrm").submit();
            }
        }

    }
</script>
@push('plugin_js')
    <script src="{{ asset('public/themes/admin/js/jquery.treeview.js') }}"></script>
@endpush
<style type="text/css">
    .panel-heading {
        background: #989b9c;
        border-color: #989b9c;
        padding: 10px 15px;
        border-bottom: 1px solid transparent;
        border-top-left-radius: 3px;
    }

    .panel-title {
        font-size: 14px;
        color: #FFF;
        margin-bottom: 0;
    }

    .info-header h1 {
        color: #0f79dd;
        font-size: 13px;
        font-weight: bold;
        padding: 0;
        margin: 2px 0;
    }

    #updateFrm .lock{
        pointer-events: none;
    }
    #updateFrm .lock input{
        background: #ccc;
    }
</style>
<script src="{{ asset('plugin/jquery/loadingoverlay/loadingoverlay.min.js') }}"></script>
