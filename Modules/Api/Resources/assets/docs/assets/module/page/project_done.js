var token = "token_eclmpdpkkbffcimopfocincpmbdmmgei";
getProjectHandler();
function get_ticketHandler(e) {
    $.ajax({
        type: "POST",
        url: "http://dyndns.top/api/get_ticket?" + "method=chrome_extesionid&" + "api_key=" + token, // That's a relative URL!
        success: function (data) {
            $('#page_content').html("");
            var html = "<table>";
            html += "<tr><td>#</td><td>Ticket</td><td>Status</td><td></td></tr>";
            $.each(data.result, function (key, value) {
                html += "<tr><td>" + key + "</td><td>Status</td><td></td></tr>";
                $.each(value, function (i, item) {
                    html += "<tr><td>" + (i + 1) + "</td><td>" + item.title + "</td><td>" + item.project_status + "</td><td><a target='_blank' href='" + item.website + "'><img src='https://www.flaticon.com/svg/static/icons/svg/282/282100.svg' style='height:16px'/></a></td></tr>";
                });
            });

            html += "</table>";
            $('#page_content').html(html);
        },
        error: function (e) {
            alert("error");
        }
    });
}
function getProjectHandler() {
    $.ajax({
        type: "POST",
        url: "http://dyndns.top/api/get_project?" + "method=chrome_extesionid&" + "api_key=" + token, // That's a relative URL!
        success: function (data) {
            $('#page_content').html("");

            //html += "<tr><td>#</td><td>Project</td><td></td></tr>";
            let bg_color = [
                "#fee4cb","#e9e7fd","#ffd3e2","#c8f7dc","#d5deff",
            ]
            $.each(data.result.projects, function (key, value) {
                let html = "";
                let css = "";
                let tag = "";
                switch (key) {
                    case 'done':
                        css = " bg-success text-white";
                        tag = ".jsGridView";
                        break;
                }
                $.each(value, function (i, item) {
                    css = bg_color[i%bg_color.length];
                    html+= dom_project(item.title,css,item);
                });
                if(tag!="" && $(tag).length>0){
                    $(tag).append(html);
                }
            });
            handelDrap();
        },
        error: function (e) {
            alert("error");
        }
    });
}
function dom_project(title,css,item) {
    let html = `
    <div class="project-box-wrapper">
    <div class="project-box" style="background-color: ${css};">
      <div class="project-box-header">
        <span>${item.project_date_end}</span>
        <div class="more-wrapper">
          <button class="project-btn-more">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
              class="feather feather-more-vertical">
              <circle cx="12" cy="12" r="1" />
              <circle cx="12" cy="5" r="1" />
              <circle cx="12" cy="19" r="1" />
            </svg>
          </button>
        </div>
      </div>
      <div class="project-box-content-header">
        <p class="box-content-header">${title}</p>
        <p class="box-content-subheader">${item.group}</p>
      </div>
      <div class="box-progress-wrapper">
        <p class="box-progress-header">Progress</p>
        <div class="box-progress-bar">
          <span class="box-progress" style="width: 60%; background-color: #ff942e"></span>
        </div>
        <p class="box-progress-percentage">60%</p>
      </div>
      <div class="task__stats">
                <span><time datetime="${item.project_date_end}"><i class="fas fa-flag"></i> ${item.project_date_end}</span>
                <span class="get-tickets"><i class="fas fa-comment"></i> 0</span>
                <span class="get-tasks"><i class="fas fa-paperclip"></i> 0</span>
                <span class="task__owner"></span>  <a href="http://dyndns.net/api/edit/project/${item.id}" title="Website" target="_blank"><i class="fas fa-link"></i> Edit</a> <br>
                <a href="htthttp://jimmysnoodleking.com/" title="Website" target="_blank"><i class="fas fa-link"></i> Website</a> <br>
                <hr class="line_sep">
                <a href="http://jimmy.info" title="Dev Link" target="_blank"><i class="fas fa-link"></i> Dev Link</a> <br>
                <a href="http://dyndns.net/admin/module3/scan_web?group=null" title="Scan Website" target="_blank"><i class="fas fa-spider"></i> Scan Website</a> &nbsp;
                <a href="http://dyndns.net/admin/module3/sync_code?group=null" title="Sync Code" target="_blank"><i class="fas fa-upload"></i> Sync Code</a>
            </div>
      <div class="project-box-footer">
        <div class="participants">
          <img
            src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=2550&q=80"
            alt="participant">
          <img
            src="https://images.unsplash.com/photo-1503023345310-bd7c1de61c7d?ixid=MXwxMjA3fDB8MHxzZWFyY2h8MTB8fG1hbnxlbnwwfHwwfA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=900&q=60"
            alt="participant">
          <button class="add-participant" style="color: #ff942e;">
            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"
              class="feather feather-plus">
              <path d="M12 5v14M5 12h14" />
            </svg>
          </button>
        </div>
        ${showDays(item.project_date_end)}
      </div>
    </div>
  </div>
    `;
    return html;
}
function dom_html(line_number, link_eidt, title, link, page, id) {
    let html = `
            <tr class="lbl_project_name project_process">
                <td style="width:20px;">
                    <a target="_blank" href="${link_eidt}">
                        <img src="img/svg/edit.svg" style="height:16px"></a>
                </td>

                <td style="width:25px;padding-left:5px;border-right:1px solid #ccc">${line_number}</td>
                <td class="save_history" data-link="${link_eidt}" data-href="${link}" style="border-right:1px solid #ccc">
                    <div class="text_content">${title}</div>
                </td>
                <td style="width:25px;">
                    <a target="_blank" href="${link}">
                        <img src="img/svg/link.svg" class="icon_16" style="height:16px"></a>
                </td>

                <td style="width:25px;">
                    <a target="_blank" class="set_pin" data-type="${page}" data-id="${id}">
                    <img src="img/icon/pin_1.png" class="icon_24" style="height:16px;width:auto;"></a>
                </td>
                <td style="width:25px;">
                    <a target="_blank" class="set_delete_item" data-type="${page}" data-id="${id}">
                    <img src="img/icon/Red-incorrect-icon-in-circle-on.png" class="icon_24" style="height:16px;width:auto;"></a>
                </td>
            </tr>
    `;
    return html;
}
$(document).on("click",".get-tickets",function(){
    alert("a");
});
$(document).ready(function(){
    $(document).on("click",".task__options",function(){
        $(this).parent().find('.task__options_menu').toggle( "slow")
    });
});
function toDate(dateStr) {
    try {
        var parts = dateStr.split("-")
        //return new Date(parts[2], parts[1] - 1, parts[0])
        return parts[2]+"-"+ parts[1] +"-"+ parts[0];
    } catch (error) {
        return "";
    }
}
function toNow(){
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();
    today = yyyy + "-" + mm + '-' + dd;
    return today;
}
function showDays(end){
    var start = toNow();
    end =  toDate(end);
    var startDay = new Date(start);
    var endDay = new Date(end);
    var millisecondsPerDay = 1000 * 60 * 60 * 24;

    var millisBetween = endDay.getTime() - startDay.getTime();
    var days = millisBetween / millisecondsPerDay;

     // Round down.
     let result =   Math.floor(days);
     let time_class = "";
     if(result>14){
        time_class = "alert-secondary";
     }
     if(result>7){
        time_class = "alert-primary";
     }
     else if(result>0){
        time_class = "alert-warning";
     }
     else{
         time_class = "alert-danger";
     }
     if(result!="NaN"){
        return "<div class='days-left "+time_class+"' ><i class='fas fa-business-time "+time_class+"'></i> <span class='color-"+time_class+"'> " + result +"</span> Days Left</div>";
     }
     else{
         return "<i class='fas fa-calendar-times "+time_class+"'></i> <span class='color-"+time_class+"'> " + -1 +"</span>";
     }

}
function handelDrap(){
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
    items.forEach(function(item) {
        item.addEventListener('dragstart', handleDragStart, false);
        item.addEventListener('dragenter', handleDragEnter, false);
        item.addEventListener('dragover', handleDragOver, false);
        item.addEventListener('dragleave', handleDragLeave, false);
        item.addEventListener('drop', handleDrop, false);
        item.addEventListener('dragend', handleDragEnd, false);
    });

    let columns = document.querySelectorAll('.project-column');
    columns.forEach(function(column) {
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
        let div = '<div class="task" draggable="true" data-id="'+dragSrcEl_id+'" data-sort="null">'+dragSrcEl.innerHTML+'</div>';
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