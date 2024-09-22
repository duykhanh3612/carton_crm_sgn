<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0 text-uppercase font-weight-bold">
                    {{$title}}
                </h1>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<section class="content">
    <div class="container-fluid">
        <div id="productGeneralInfo" class="border-bottom border-info pb-3">
            <form action="{{ $link_update??route('admin.page.update', [@$page, @$record->id ?? '']) }}" class="updateFrm" id="updateFrm" method="POST" enctype="multipart/form-data" >
            @if(!isset($setting['has_tag']))
                @include("admin::element")
            @endif
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-form clearfix p-0">

                            @if(isset($setting['has_tag']) && $setting['has_tag'])
                                @include("admin::tags")
                            @endif
                            @stack('content_center')
                        </div>
                    </div>
                    <div class="col-lg-3">
                        @stack('content_right')
                    </div>
                </div>
                @csrf

                <input type="hidden" id="update-eloquent-link" value="{{  $link_update??route('admin.page.update', [$page, @$record->id ?? '']) }}" />
            </div>
            <div class="d-flex justify-content-end mt-3" style="gap: 8px">
                @include('plugin::carton-crm.core.form_action')
            </div>
            </form>
        </div>
    </div>
</div>
<script>


    function createandcontinue($value)
    {
        $("form.updateFrm").append("<input name='action' value='"+$value+"' />");
        if(!checkUpdateFrm())
        {
            $("form.updateFrm").submit();
        }

    }
</script>

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
                            showNoti(data.data,"Thông báo","error");
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
    $(document).on("click",'.tabbable > .nav-tabs > li >a', function(){
        target = $(this).attr("target");
        $('.tabbable > .nav-tabs > li').removeClass("active");
        $(this).parent().addClass("active");

        $('.tabbable > .tab-content > .tab-pane').removeClass("active");
        $('.tabbable > .tab-content').find(target).addClass("active");
    });
    $('.input_money').mask('#,##0', {
        reverse: true
    });
    $(document).on("change",".ele_checkbox",function(){
        var ele = $(this).attr("for");
        $("input[name="+ele+"]").val($(this).prop("checked")?1:0);
    });
    function createandcontinue($action)
    {
        $("form.updateFrm").append("<input name='action' value='"+$action+"' />");
        if(!checkUpdateFrm())
        {
            $("form.updateFrm").submit();
        }

    }

    // $("#submitBtn").click(function() {
    //     $("#updateFrm").submit();
    // });
    // $(document).on('click',"#btn-frm-apply",function(){
    //     $("#updateFrm").append("<input type='hidden' name='action' value='apply' />");
    //     $("#updateFrm").submit();
    // });
</script>
