var token = "";
if($.cookie('token')!="")
{
    token = $.cookie('token');
    $('.global_variable').html(`<li><b>Token</b>: ${token}</li>`);
}
$(document).ready(function () {
    var base_url = window.location.origin;
    if(base_url=="http://crm.carton.hahoba.com")
    {
        $('.dev_cms').hide();
        $('.dev_logview').hide();

    }
    $(document).on("click", ".call_api", function (e) {
        e.preventDefault();
        setDefault();
        let uri = $(this).attr('href');

        if(uri.indexOf("http")<0)
        {
            uri = base_url + "/"+ uri;
        }
        let para = $(this).data('para');
        $('#list_para').html(JSON.stringify(para));
        let keys = [];
        $.each(para,function( key, value){
            keys.push(key);
            if(key == 'token'){
                para.token = $.cookie('token');
                value =  $.cookie('token');
                $('.global_variable').html(`<li><b>Token</b>: ${token}</li>`);
            }

            if(key == 'details')
            {
                $('.api_para').find('tbody').append(`<tr><td colspan="3">Details</td></tr>`);
                bind_html = "<table>";
                $.each(value,function(k,v){
                    bind_html += `<tr>`;

                    $.each(v,function(k,v){
                        bind_html +=  `<td><input name="${k}" value="${v}" /></td>`;
                    });
                        // <td><input value="${v.product_id}" /></td>
                        // <td></td>
                        // <td></td>
                    bind_html +=    `</tr>`;
                });
                bind_html += "</table>";
                $('.api_para').find('tbody').append(`<tr><td colspan="3">${bind_html}</td></tr>`);
            }
            else{
                if( jQuery.isPlainObject(value))
                {
                    $('.api_para').find('tbody').append(`<tr><td>
                    <input value='${key}' /></td><td><input value='${value.value}' /></td><td><input value='${value.description}' /></td></tr>`);
                }
                else{
                    $('.api_para').find('tbody').append(`<tr><td>
                    <input value='${key}' /></td><td><input value='${value}' /></td><td><input value='' /></td></tr>`);
                }
            }


        });
        $('#list_key').html(keys.join(','));

        let method = $(this).data('method');
        $('.api_method').val(method);
        $('.api_uri').val(uri);

        $('.para_description').html($(this).data('description'));
        $.ajax({
            url: uri,
            data: para,
            type: method
        }).done(function (response) {
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


            $.ajax({
                url: base_url + '/api/comment/estates',
                type: "GET"
            }).done(function (response) {
                var fields = response.data;
                $(".json-dict > li > .comment").each(function(){
                    id = $(this).closest("li").find(".json-property").text().trim().replace('"', '').replace('"', '');
                    $(this).html(fields[id]);
                });
            });
            activeTab();

        }).fail(function (jqXHR, textStatus) {
            response  = JSON.parse(jqXHR.responseText);
            $('.api_body').find('.response').html( response);
            new JsonEditor('#json-display', response);
            $('.json-string').append("<i class='fa fa-copy json-string-copy'></i>");
            $('.json-literal-number').append("<i class='fa fa-copy json-string-copy'></i>");
            activeTab();
            console.log(textStatus);
        });
    });
    activeTab();
    function callApi()
    {

        var para = [];
        var keys = [];
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
            key = $(this).find("td:nth-child(1)").find("input").val();
            keys.push(key);
            if(key == 'token'){
                para['token'] = token;
            }
            value = $(this).find("td:nth-child(2)").find("input").val();
            para[key] = value;
        });
        $('#list_para').html(JSON.stringify(para));
        $('#list_key').html(keys.join(','));
        method =  $('.api_method').val();
        uri = $('.api_uri').val();
        $('.para_description').html($(this).data('description'));
        para =  Object.assign({}, para);
        $.ajax({
            url: uri,
            data: para,
            type: method
        }).done(function (response) {
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
            activeTab();

        }).fail(function (err) {
            console.log(err);
        });
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
    $(document).on("click",'#btn-add-para',function(){
        tag = $("#para-sample");
        key = tag.find(".key").val();
        value = tag.find('.value').val();
        description = tag.find('.description').val();
        html = `<tr>
                <td>
                <input value="${key}"></td>
                <td><input value="${value}"></td>
                <td><input value="">${description}</td>
                </tr>`;
        tag.find(".key").val('')
        tag.find('.value').val('');
        $(".api_para").find("tbody").append(html);

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
    $(document).on("click",'.get-paras',function(){

    });

    // $('input').bind("enterKey",function(e){
    $(document).on("keydown",'input',function(e){
        if(e.keyCode == 13)
        {
            callApi();
        }
     });
     
    $(document).on("click",'#btn-refresh-api',function(){
        callApi();
    });
    $(document).on('click','.func-copy',function(){
        let tag = $(this).data('tag');
        value = $(tag).text();
        // navigator.clipboard.writeText(value);
        copyToClipboard(value);
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

    $('.yesnoselect').click(function(){
        var tab = "." + $(this).data('value') + "." + $(this).attr("grouptarget");
        var hiddentab = "." + $(this).attr("grouptarget");
        $(hiddentab).not(tab).css("display", "none");
        $(tab).fadeIn();
    });

});

function copyToClipboard(text) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val(text).select();
    document.execCommand("copy");
    $temp.remove();
}
function setDefault(){
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
