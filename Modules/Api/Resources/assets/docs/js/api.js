var token = "";
var base_url = window.location.origin;
var remote_url = "https://apikimphat.hahoba.com";
if($.cookie('token')!="")
{
    token = $.cookie('token');
    $('.global_variable').html(`<li class="token"><b>Token</b>: ${token}</li>`);
}
if($.cookie('remote_api')=="true")
{
    $("#remote_uri").prop("checked", true);
}


$(document).ready(function () {

    if(base_url=="http://crm.carton.hahoba.com")
    {
        $('.dev_cms').hide();
        $('.dev_logview').hide();
    }
    $(document).on("click",".task__options",function(){
        $(this).parent().find('.task__options_menu').toggle( "slow")
    });

    $(document).on("change","#remote_uri",function(){
        $.cookie('remote_api', $(this).prop("checked"));
    });

    if($.cookie('api-uri-id') != "")
    {
        api_id = $.cookie('api-uri-id');
        renderForm($(`.call_api[data-id='${api_id}']`));
    }

    $(document).on("click", ".call_api", function (e) {
        e.preventDefault();
        setDefault();
        let uri = $(this).attr('href');
        $.cookie("api-uri-id", $(this).data("id"));

        $("#btn-update-api").attr("data-id", $(this).attr('data-id'));
        if(uri.indexOf("http")<0)
        {
            if($("#remote_uri").prop("checked"))
            {
                uri = remote_url + "/"+ uri;
            }
            else{
                uri = base_url + "/"+ uri;
            }

        }
        let para = JSON.parse($(this).attr('data-para')!=""?$(this).attr('data-para'):'{}');
        $('#list_para').html(JSON.stringify(para));
        let keys = [];
        let stt_para = 1;
        $.each(para,function( key, value){
            keys.push(key);
            if(key == 'token'){
                para.token = $.cookie('token');
                value =  $.cookie('token');
                $('.global_variable').html(`<li class="token"><b>Token</b>: ${token}</li>`);
            }

            if(key == 'details')
            {
                $('.api_para').find('tbody').append(`<tr><td colspan="3">Details</td><td><i id="add-field-detail" class="fa fa-plus"></i></td></tr>`);
                bind_html = "<table class='table' id='table-field-detail'>";
                bind_html += `<thead><tr class="dnd-moved"><td>#</td>`;
                $.each(value[0],function(k,v){
                    bind_html +=  `<td class='detail_col' data-name='${k}'><small></small>${k} <i class='col-move-left fa fa-angle-left'></i> <i class='col-move-right fa fa-angle-right'></i></td>`;
                });
                bind_html +=    `</tr></thead><tbody>`;

                $.each(value,function(k,v){

                    bind_html += `<tr class="dnd-moved"><td>${k+1}</td>`;
                    // if(v.length > 0)
                    // {
                        $.each(v,function(k,v){
                            bind_html +=  `<td><input name="${k}" value="${v}" /></td>`;
                        });
                    // }

                    bind_html += `</tr>`;
                });
                bind_html += "</tbody></table>";
                $('.api_para').find('tbody').append(`<tr><td colspan="4">${bind_html}</td></tr>`);

            }
            else{
                if( jQuery.isPlainObject(value) && key != "")
                {
                    $('.api_para').find('tbody').append(
                        `<tr>
                        <td>${stt_para}</td>
                        <td> <input value='${key}' /></td>
                    <td><input type="${value.type!=undefined?value.type:"text"}"  value='${value.value}' /></td>
                    <td><input value='${value.description}' /></td>
                    <td><input value='${value.type!=undefined?value.type:""}' /></td>
                    <td><i class="para_remove fa fa-times"></i></td>
                    </tr>`);
                }
                else{
                    $('.api_para').find('tbody').append(`<tr>
                    <td>${stt_para}</td>
                    <td>
                    <input value='${key}' /></td>
                    <td><input value='${value}' /></td>
                    <td><input value='' /></td>
                    <td><input value='' /></td>
                    <td><i class="para_remove fa fa-times"></i></td>
                    </tr>`);
                }
            }
            stt_para++;

        });
        $('#list_key').html(keys.join(','));

        let method = $(this).data('method');
        $('.api_method').val(method);
        $('.api_uri').val(uri);

        $('.para_description').html($(this).data('description'));
        // console.log(jQuery.inArray("token", keys));
        if(jQuery.inArray("token", keys)<0)
        {

            $(".global_variable").addClass("hidden");
        }
        else{
            $(".global_variable").removeClass("hidden");
        }
        callApi();
    });

    activeTab();

    function renderForm(tag)
    {
        setDefault();
        let uri = tag.attr('href');
        if(uri==undefined)
        {
            return false;
        }
        $("#btn-update-api").attr("data-id", tag.attr('data-id'));
        if(uri.indexOf("http")<0)
        {
            if($("#remote_uri").prop("checked"))
            {
                uri = remote_url + "/"+ uri;
            }
            else{
                uri = base_url + "/"+ uri;
            }

        }
        let let_part = tag.attr('data-para')!=""?tag.attr('data-para'):'{}';
        let para = JSON.parse(tag.attr('data-para')!=""?tag.attr('data-para'):'{}');
        $('#list_para').html(JSON.stringify(para));
        let keys = [];
        let stt_para = 1;
        $.each(para,function( key, value){
            keys.push(key);
            if(key == 'token'){
                para.token = $.cookie('token');
                value =  $.cookie('token');
                $('.global_variable').html(`<li class="token"><b>Token</b>: ${token}</li>`);
            }

            if(key == 'details')
            {
                $('.api_para').find('tbody').append(`<tr><td colspan="3">Details</td><td><i id="add-field-detail" class="fa fa-plus"></i></td></tr>`);
                bind_html = "<table class='table' id='table-field-detail'>";
                bind_html += `<thead><tr class="dnd-moved"><td>#</td>`;
                $.each(value[0],function(k,v){
                    bind_html +=  `<td class='detail_col' data-name='${k}'><small></small>${k} <i class='col-move-left fa fa-angle-left'></i> <i class='col-move-right fa fa-angle-right'></i></td>`;
                });
                bind_html +=    `</tr></thead><tbody>`;

                if(value != undefined)
                {
                    $.each(value,function(k,v){
                        bind_html += `<tr class="dnd-moved"><td>${k+1}</td>`;
                        if(v != "details")
                        {
                            $.each(v,function(k,v){
                                bind_html +=  `<td><input name="${k}" value="${v}" /></td>`;
                            });
                        }

                        bind_html += `</tr>`;
                    });
                    bind_html += "</tbody></table>";
                    $('.api_para').find('tbody').append(`<tr><td colspan="4" class="table-field-detail-content">${bind_html}</td></tr>`);

                }

            }
            else{
                if( jQuery.isPlainObject(value))
                {
                    if(key != "")
                    {
                        $('.api_para').find('tbody').append(
                            `<tr>
                            <td>${stt_para}</td>
                            <td>
                        <input value='${key}' /></td>
                        <td><input type="${value.type!=undefined?value.type:"text"}"  value='${value.value}' /></td>
                        <td><input value='${value.description}' /></td>
                        <td><input value='${value.type!=undefined?value.type:""}' /></td>
                        <td><i class="para_remove fa fa-times"></i></td>
                        </tr>`);
                    }

                }
                else{
                    $('.api_para').find('tbody').append(`<tr>
                    <td>${stt_para}</td>
                    <td>
                    <input value='${key}' /></td><td><input value='${value}' /></td><td><input value='' /></td>
                    <td><input value='' /></td>
                    <td><i class="para_remove fa fa-times"></i></td>
                    </tr>`);
                }
            }
            stt_para++;

        });
        $('#list_key').html(keys.join(','));

        let method = tag.data('method');
        $('.api_method').val(method);
        $('.api_uri').val(uri);

        $('.para_description').html(tag.data('description'));
        // console.log(jQuery.inArray("token", keys));
        if(jQuery.inArray("token", keys)<0)
        {

            $(".global_variable").addClass("hidden");
        }
        else{
            $(".global_variable").removeClass("hidden");
        }
        callApi();
    }
    function getParams()
    {
        let paras = [];
        keys = [];
        para = []  ;
        $(".api_para > tbody > tr").each(function(){
            key = $(this).find("td:nth-child(2)").find("input").val();
            keys.push(key);
            value = $(this).find("td:nth-child(3)").find("input").val();
            if(key == 'token'){
                value = "";
            }
            description = $(this).find("td:nth-child(4)").find("input").val();
            type = $(this).find("td:nth-child(5)").find("input").val();
            para[key] = value;

            obj = {
                name: key,value :value,description: description,type:type
            }
            if(key!=undefined)
            {
                paras[key] = obj;
            }

        });

        if( $("#table-field-detail .detail_col").length>0)
        {
            item_para = [];
            item_keys = [];
            $("#table-field-detail .detail_col").each(function(){
                key = $(this).attr('data-name');
                item_keys.push(key);
                // value = $(this).find("td:nth-child(2)").find("input").val();
                // if(key == 'token'){
                //     value = "";
                // }
                // para[key] = value;
            });

            $("#table-field-detail > tbody > tr").each(function(){
                item_row = [];
                row = $(this).index();
                $("#table-field-detail > tbody > tr > td").each(function(){
                    col = $(this).index();
                    col_value = $(this).find("input").val();
                    col_key = item_keys[col-1];
                    if(col_key!=undefined)
                    {
                        item_row[col_key] = col_value;
                    }
                });
                item_para[row] = Object.assign({}, item_row);
            });
            paras['details']  = item_para;
        }
        $('#list_para').html(JSON.stringify( Object.assign({},paras)));
        return paras;
    }

    $(document).on('click','.json-string-copy',function(){
        let text = $(this).parent().text();
        if(text.slice(0,1)=='"' && text.slice(-1)=='"'){
            value = text.substring(1).slice(0, -1);
            // navigator.clipboard.writeText(value);
            copyToClipboard(value);
        }
        else{
            value = text;
            // navigator.clipboard.writeText(value);
            copyToClipboard(value);
        }
    });
    // $(document).on('click','.json-string-copy',function(){
    //     let text = $(this).parent().text();
    //     value = text;
    //     navigator.clipboard.writeText(value);
    // });



    // $('input').bind("enterKey",function(e){
    $(document).on("keydown",'input',function(e){
        if(e.keyCode == 13)
        {
            callApi();
        }
     });



    $(document).on('click','.func-copy',function(){
        let tag = $(this).data('tag');
        value = $(tag).text();
        // navigator.clipboard.writeText(value);
        copyToClipboard(value);
    });

    $(document).on("click", "#btn-update-api", function (e) {
        id = $(this).data('id');
        params = getParams();
        str_params = JSON.stringify(Object.assign({}, params))
        if($("#remote_uri").prop("checked"))
        {
            link = $('.api_uri').val().replace(remote_url+"/","");
        }
        else{
            link = $('.api_uri').val().replace(base_url+"/","");
        }
        $.ajax({
            url: base_url +"/api/docs/update",
            data: {'params': str_params, id: id , 'link':link, method: $(".api_method").val()},
            type: "POST"
        }).done(function (res) {
            api = res.api;
            tag_api =  $(`.call_api[data-id=${api.id}]`);
            tag_api.attr('data-para',api.params);
            tag_api.attr('data-method',api.method);

            $.toast({
                text : 'Successfully Upload File',
                showHideTransition : 'slide',  // It can be plain, fade or slide
                bgColor : '#28a745',              // Background color for toast
                textColor : '#fff',            // text color
                allowToastClose : false,       // Show the close button or not
                hideAfter : 5000,              // `false` to make it sticky or time in miliseconds to hide after
                stack : 5,                     // `fakse` to show one stack at a time count showing the number of toasts that can be shown at once
                textAlign : 'left',            // Alignment of text i.e. left, right, center
                position : 'top-right'       // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values to position the toast on page
            })

        }).fail(function (err) {
            console.log(err);
        });
    });
    $(document).on("click", "#btn-create-api", function (e) {
        $("#popupApi").modal("show");
    });

    $(document).on("click", "#btn-process-create-api", function (e) {
        $("#popupApiForm").submit();
    });
    $(document).on("click", "#btn-close-create-api", function (e) {
        $("#popupApi").modal("hide");
        $("#popupApiForm")[0].reset();
    });

    $("#popupApiForm").submit(function(e){
        e.preventDefault();

        $.ajax({
            url: base_url +"/api/docs/update",
            data: $('#popupApiForm').serialize(),
            type: "POST"
        }).done(function (response) {
            $("#popupApi").modal("hide");
            $("#popupApiForm")[0].reset();
            location.reload();
        }).fail(function (err) {
            console.log(err);
        });
    });

    $("ul.drapsort").sortable({
        connectWith: "ul",
        stop: function( event, ui ) {
            id = $(this).attr('id');
            $("#"+id+" > li").each(function(index){
                sort =  $(this).attr('data-sort');
                id = $(this).find('.call_api').attr('data-id');
                order =  (index + 1);
                if(sort != order)
                {
                    $.ajax({
                        url: base_url +"/api/docs/update",
                        data: {id: id , 'order':order},
                        type: "POST"
                    }).done(function (response) {

                    }).fail(function (err) {
                        console.log(err);
                    });

                }
                $(this).attr('data-sort',index + 1);


            })
        }
    });

    $(document).on("change", "#check_new_group", function (e) {
        check= $(this).prop("checked");

        if(check)
        {
            $(this).parent().find("select").prop("disabled",true);
            $('.group_name').show();
        }
        else{
            $(this).parent().find("select").prop("disabled",false);
            $('.group_name').hide();
        }
    });
    $(document).on("click", 'svg[data-toggle="collapse"]', function (e) {
        id = $(this).attr("data-target");
        if( $(id).css("display") == "block"){
            collapse  = "";
        }
        else{
            collapse  = "show";
        }

        $(id).toggle("fast");

        $.ajax({
            url: base_url +"/api/docs/update-category",
            data: {id:id.replace("#cate_",""), collapse:collapse},
            type: "POST"
        }).done(function (response) {

        }).fail(function (err) {
            console.log(err);
        });
    });

    $('.yesnoselect').click(function(){
        var tab = "." + $(this).data('value') + "." + $(this).attr("grouptarget");
        var hiddentab = "." + $(this).attr("grouptarget");
        $(hiddentab).not(tab).css("display", "none");
        $(tab).fadeIn();
    });

});
function activeTab(){
    $('.tabs').parent().find('.container').hide();
    $('.tabs>li:first').addClass('inactive');
    $('.tabs').parent().find('.container:first').show();

    $('.tabs li').click(function(){
        var t = $(this).data('tab');
        $('.tabs li').addClass('inactive');
        $(this).removeClass('inactive');
        $('.tabs').parent().find('.container').hide();
        $(t).fadeIn('slow');
        return false;
    })

}
function copyToClipboard(text) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val(text).select();
    document.execCommand("copy");
    $temp.remove();
}
function setDefault(){
    $('#json-display').html('');
    $('.api_para').find('tbody').html('');
    $('.api_body').find('.response').html('');
}
function toDate(dateStr) {
    var parts = dateStr.split("-")
    //return new Date(parts[2], parts[1] - 1, parts[0])
    return parts[2] + "-" + parts[1] + "-" + parts[0];
}
function toNow() {
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();
    today = yyyy + "-" + mm + '-' + dd;
    return today;
}
function showDays(end) {
    var start = toNow();
    end = toDate(end);
    var startDay = new Date(start);
    var endDay = new Date(end);
    var millisecondsPerDay = 1000 * 60 * 60 * 24;

    var millisBetween = endDay.getTime() - startDay.getTime();
    var days = millisBetween / millisecondsPerDay;

    // Round down.
    let result = Math.floor(days);
    let time_class = "";
    if (result > 14) {
        time_class = "alert-secondary";
    }
    if (result > 7) {
        time_class = "alert-primary";
    }
    else if (result > 0) {
        time_class = "alert-warning";
    }
    else {
        time_class = "alert-danger";
    }

    if (result != "NaN") {
        return "<i class='fas fa-business-time " + time_class + "'></i> <span class='color-" + time_class + "'> " + result + "</span>";
    }
    else {
        return "<i class='fas fa-calendar-times " + time_class + "'></i> <span class='color-" + time_class + "'> " + -1 + "</span>";
    }

}
function handelDrap() {
    var dragSrcEl = null;

    function handleDragStart(e) {
        this.style.opacity = '0.1';
        this.style.border = '3px dashed #c4cad3';

        dragSrcEl = this;

        e.dataTransfer.effectAllowed = 'move';
        e.dataTransfer.setData('text/html', this.innerHTML);
    }

    function handleDragOver(e) {
        if (e.preventDefault) {
            e.preventDefault();
        }

        e.dataTransfer.dropEffect = 'move';

        return false;
    }

    function handleDragEnter(e) {
        this.classList.add('task-hover');
    }

    function handleDragLeave(e) {
        this.classList.remove('task-hover');
    }

    function handleDrop(e) {
        if (e.stopPropagation) {
            e.stopPropagation(); // stops the browser from redirecting.
        }

        if (dragSrcEl != this) {
            $id = $(this).data('id')
            $dragSrcEl_id = $(dragSrcEl).data('id');
            dragSrcEl.innerHTML = this.innerHTML;
            $(dragSrcEl).attr("data-id", $id);

            this.innerHTML = e.dataTransfer.getData('text/html');
            $(this).attr("data-id", $dragSrcEl_id);
        }
        return false;
    }

    function handleDragEnd(e) {
        this.style.opacity = '1';
        this.style.border = 0;

        items.forEach(function (item) {
            item.classList.remove('task-hover');
        });
    }


    let items = document.querySelectorAll('.task');
    items.forEach(function (item) {
        item.addEventListener('dragstart', handleDragStart, false);
        item.addEventListener('dragenter', handleDragEnter, false);
        item.addEventListener('dragover', handleDragOver, false);
        item.addEventListener('dragleave', handleDragLeave, false);
        item.addEventListener('drop', handleDrop, false);
        item.addEventListener('dragend', handleDragEnd, false);
    });

    let columns = document.querySelectorAll('.project-column');
    columns.forEach(function (column) {
        // column.addEventListener('dragstart', handleDragStart, false);
        column.addEventListener('dragenter', handleDragEnter, false);
        column.addEventListener('dragover', handleDragOver, false);
        column.addEventListener('dragleave', handleDragLeave, false);
        column.addEventListener('drop', handleColumnDrop, false);
        column.addEventListener('dragend', handleColumnDragEnd, false);
    });
    function handleColumnDrop(e) {
        if (e.stopPropagation) {
            e.stopPropagation(); // stops the browser from redirecting.
        }
        dragSrcEl_id = $(dragSrcEl).data('id');
        let div = '<div class="task" draggable="true" data-id="' + dragSrcEl_id + '" data-sort="null">' + dragSrcEl.innerHTML + '</div>';
        $(this).append(div);
        $(dragSrcEl).remove();
        return false;
    }
    function handleColumnDragEnd(e) {
        this.style.opacity = '1';
        this.style.border = 0;

        columns.forEach(function (column) {
            column.classList.remove('task-hover');
        });
    }
}

$(document).keydown(function (e) {
    if (e.ctrlKey &&  e.keyCode == 122) {
        showDisplayDebug();
    }
});

if( $.cookie("is-dev"))
{
    showDisplayDebug();
}
function showDisplayDebug()
{
    if( $(".highlightNoClick").attr("data-debug")=="lock")
    {
        $(".highlightNoClick").attr("data-debug","");
        $(".highlightNoClick").addClass("lock");
    }
    else{
        $(".highlightNoClick").attr("data-debug","lock")
        $(".highlightNoClick").removeClass("lock");
    }

    if( $(".is-dev").attr("data-debug")=="hidden")
    {
        $(".is-dev").attr("data-debug","");
        $(".is-dev").addClass("hidden");
        $.cookie("is-dev",false);
    }
    else{
        $(".is-dev").attr("data-debug","hidden")
        $(".is-dev").removeClass("hidden");
        $.cookie("is-dev",true);
    }

    $("table tr").css("pointer-events", "auto")
}

/* Params */
$(document).ready(function(){
    $(document).on("click",'#btn-add-para',function(){
        tag = $("#para-sample");
        key = tag.find(".key").val();
        value = tag.find('.value').val();
        description = tag.find('.description').val();
        type = tag.find('.type').val();
        if(key=="details")
        {
            $('.api_para').find('tbody').append(`<tr><td colspan="3">Details</td><td><i id="add-field-detail" class="fa fa-plus"></i></td></tr>`);
            html = "<table class='table' id='table-field-detail'>";
            html += `<thead><tr class="dnd-moved"><td>#</td></tr></thead><tbody><tr class="dnd-moved"><td>#</td></tr><tbody></table>`;
            $(".api_para").find("tbody").append(html);
        }
        else{
            html = `<tr>
                <td></td>
                <td>
                <input value="${key}"></td>
                <td><input value="${value}"></td>
                <td><input value="${description}"></td>
                <td><input value="${type}"></td>
            </tr>`;
            $(".api_para").find("tbody").append(html);
        }

        tag.find(".key").val('')
        tag.find('.value').val('');


        para = []  ;
        keys = [];
        $(".api_para > tbody > tr").each(function(){
            key = $(this).find("td:nth-child(1)").find("input").val();
            keys.push(key);
            value = $(this).find("td:nth-child(2)").find("input").val();
            if(key == 'token'){
                value = "";
            }
            para[key] = value;
        });
        $('#list_para').html(JSON.stringify(Object.assign({}, para)));
        $('#list_key').html(keys.join(','));



    });
    $(document).on("click",'#btn-add-para-detail',function(){

        tag = $("#para-sample");
        key = tag.find(".key").val();
        value = tag.find('.value').val();
        description = tag.find('.description').val();
        type = tag.find('.type').val();

        $('#table-field-detail').find("thead tr").append(`<td class='detail_col' data-name='${key}'><small></small>${key}</td>`);

        if($('#table-field-detail').find("tbody tr").length == 0)
        {
            $('#table-field-detail').find("tbody").append(`<tr><td><input value="${value}"></td></tr>`);
        }
        else{
            $('#table-field-detail').find("tbody tr").each(function(){
                $(this).append(`<td><input value="${value}"></td>`);
            });
        }


        item_keys = [];
        $("#table-field-detail .detail_col").each(function(){
            key = $(this).attr('data-name');
            item_keys.push(key);
            // value = $(this).find("td:nth-child(2)").find("input").val();
            // if(key == 'token'){
            //     value = "";
            // }
            // para[key] = value;
        });
        // $('#list_para').html(JSON.stringify(Object.assign({}, para)));
        $("#list_key_items").html(item_keys.join(','));
        getParams();
    });
    $(document).on("click",'.get-paras',function(){
        getParams();
    });
    $(document).on("click",'#btn-refresh-api',function(){
        callApi();
        console.clear();
    });

    $(document).on("click",'.para_remove',function(){
        $(this).closest("tr").remove();
        getParams();
    });

});
/* Params */

/* Items Fields */
$(document).on("click",".col-move-left",function(){
    tag = $(this).parent();
    $(tag).insertBefore($(tag).prev())
});


$(document).on("click",".col-move-right",function(){
    tag = $(this).parent();
    $(tag).insertAfter($(tag).next())
});
/* Items Fields */

/* Fields */
$(document).on("click",'.load-para-fields',function(){
    getFields();
});
$(document).on("click",'#add-field-detail',function(){

    let keys = [];
    $('#table-field-detail').find("thead td.detail_col").each(function(){
        key = $(this).data('name');
        keys.push(key);
    })

    if($('#table-field-detail').find("tbody tr").length > 0)
    {
        $('#table-field-detail').find("tbody tr").each(function(){
            $.each(keys,function(){
                $(this).append(`<td><input value="${value}"></td>`);
            })
        });
    }
});

$(document).on("click",'.para_field_set',function(){
    key = $(this).closest("tr").find('.key').val();
    description = $(this).closest("tr").find('.name').val();
    tag = $("#para-sample");
    tag.find(".key").val(key);
    tag.find(".description").val(description);
    $('#btn-add-para').trigger("click");
});
$(document).on("click",'.para_detail_field_set',function(){
    key = $(this).closest("tr").find('.key').val();
    description = $(this).closest("tr").find('.name').val();
    tag = $("#para-sample");
    tag.find(".key").val(key);
    tag.find(".description").val(description);
    $('#btn-add-para-detail').trigger("click");
})
$(document).on("click",'.show_field_row',function(){
    $(".field_row").toggle();
});

$(document).on("click",'.show_item_field_row',function(){
    $(".item_field_row").toggle();
});
function getFields()
{
    uri = $(".api_uri").val();
    $para_uri = uri.split("/");
    $table = $para_uri[4];
    $("#api_para_field_module").attr("data-module", $table);
    $.ajax({
        url: base_url + '/api/module_fields/' + $table,
        type: "GET"
    }).done(function (response) {
        $(".api_para_field").find("tbody").html('');
        var fields = response.data.fields;
        bindHtml = '';
        $.each(fields,function(index, value){
            bindHtml += `<tr style="display:none" class="field_row">
            <td>
            <input class="key" value="${index}"></td>
            <td><input class="name"  value="${value.name}"></td>
            <td class="text-center"><span class="para_field_set"><i class=" fa fa-save"></i></span></td>
            </tr>`;
        });
        $(".api_para_field").find("tbody").append(bindHtml);


        var fields = response.data.items;
        bindHtml = '';
        $(".api_para_field").find("tbody").append(`<tr colspan="3" style="height:2px;border-bottom:2px solid #ccc"></tr>`);
        $(".api_para_field").find("tbody").append(`<tr>
            <th colspan="2" >ITEMS(${Object.entries(fields).length})</th><td class="text-center"><i class="show_item_field_row fa fa-list"></i></td></tr>`);
        $.each(fields,function(index, value){
            $('.detail_col[data-name="'+index+'"]').find("small").html(value.name)
            bindHtml += `<tr style="display:none" class="item_field_row">
            <td>
            <input class="key" value="${index}"></td>
            <td><input class="name"  value="${value.name}"></td>
            <td class="text-center"><span class="para_detail_field_set"><i class=" fa fa-save"></i></span></td>
            </tr>`;
        });
        $(".api_para_field").find("tbody").append(bindHtml);
    });
}
/* Fields */


function callApi()
{
    var form_data = new FormData();

    // var file_data = $(this).prop("files")[0];
    // form_data.append("file", file_data);
    // form_data.append("_token", '{{ csrf_token() }}');
    // form_data.append("id", $('#id').val());


    var para = [];
    var keys = [];
    var params = [];
    // $.each(para,function( key, value){
    //     keys.push(key);
    //     if(key == 'token'){
    //         para.token = token;
    //         $('.global_variable').html(`<li><b>Token</b>: ${token}</li>`);
    //     }
    //     $('.api_para').find('tbody').append(`<tr><td>
    //     <input value='${key}' /></td><td><input value='${value}' /></td><td><input value='' /></td></tr>`)
    // });

    $(".api_para > tbody > tr").each(function(){
        key = $(this).find("td:nth-child(2)").find("input").val();
        type = $(this).find("td:nth-child(5)").find("input").val();
        keys.push(key);
        if(key == 'token'){
            para['token'] = token;
        }
        value = $(this).find("td:nth-child(3)").find("input").val();

        if(type=="file")
        {
            var file_data =  $(this).find("td:nth-child(3)").find("input").prop("files")[0];
            if(file_data!=undefined)
            {
                form_data.append(key, file_data);
            }

        }
        else{
            para[key] = value;
            form_data.append(key, value);
            params.push(key+"="+value);
        }

    });

    if( $("#table-field-detail .detail_col").length>0)
    {
        item_para = [];
        item_keys = [];
        $("#table-field-detail .detail_col").each(function(){
            key = $(this).attr('data-name');
            item_keys.push(key);
            // value = $(this).find("td:nth-child(2)").find("input").val();
            // if(key == 'token'){
            //     value = "";
            // }
            // para[key] = value;
        });

        $("#table-field-detail > tbody > tr").each(function(){
            item_row = [];
            row = $(this).index();
            $(this).find("td").each(function(){
                col = $(this).index();
                col_value = $(this).find("input").val();
                col_key = item_keys[col-1];
                item_row[col_key] = col_value;
                if(col_key!=undefined)
                {
                    form_data.append("items["+(row+1)+"]["+col_key+"]",  col_value);
                }

            });
            // item_para[row] = Object.assign({}, item_row);
            // form_data.append("details[]", item_para);
            // item_para[row] = item_row;


        });

        // form_data.append("details", JSON.stringify(item_para));
        // form_data.append("details", item_para);
    }


    $('#list_para').html(JSON.stringify(para));
    $('#list_key').html(keys.join(','));
    method =  $('.api_method').val();
    uri = $('.api_uri').val();


    if(method == "GET")
    {
        uri = uri + "?"+params.join("&");
    }

    $('.para_description').html($(this).data('description'));
    para =  Object.assign({}, para);
    $.ajax({
        url: uri,
        // data: para,
        data: form_data,
        cache: false,
        contentType: false,
        processData: false,
        type: method
    })
    .done(function (response) {
        data = response.data;
        // if(jQuery.inArray("total", data))
        // {
        //     summary = `Total: [${data.total}] ${data.options !=  undefined ?', Option: ['+data.options.length+']':''}`;
        //     $("#api_summary").html(summary);
        // }
        if(response.access_token != undefined){
            token = response.access_token;
            $.cookie('token', token);
            $('.global_variable').html(`<li><b>Token</b>: ${token}</li>`);
        }
        $('.api_body').find('.response').html( JSON.stringify(response));
        new JsonEditor('#json-display', response);
        $('.json-string').append("<i class='fa fa-copy json-string-copy'></i>");
        $('.json-literal-number').append("<i class='fa fa-copy json-string-copy'></i>");
        $('.json-dict').find("li").append("<span class='comment'></span>");

        //Show comment
        $para_uri = uri.split("/");
        $table = $para_uri[$para_uri.length-1];
        $.ajax({
            url: base_url + '/api/comment/' + $table,
            type: "GET"
        }).done(function (response) {
            var fields = response.data;
            $(".json-dict > li > .comment").each(function(){
                id = $(this).closest("li").find(".json-property").text().trim().replace('"', '').replace('"', '');
                $(this).html(fields[id]);
            });
        });

        // Fields
        getFields();

        activeTab();

    }).fail(function (err) {
        console.log(err);
    });
}
