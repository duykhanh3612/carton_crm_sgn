class ScheduleTask{
    constructor(){
        
        // this.myCurrentTask = this.getCurrentTasks();
    
    }
}
ScheduleTask.prototype.addEventListener = function(){
    this.openModal();
}
ScheduleTask.prototype.send = function (data, url, option = {}) {
    // var domain = '/'+window.location.pathname +"request_pickup"
    return new Promise((resolve, reject) => {
        $.ajax({
        url: "tasks/" + url,
        type: "POST",
        data: data,
        beforeSend: function () {
            showProcess(1);
        },
        complete: function () {
            hideLoading();
        },
        success: function (res) {
            if (res != null) {
            if (option.html) {
                resolve(res);
            } else {
                res = JSON.parse(res);
                resolve(res.data);
            }
            } else {
            reject({});
            }
        },
        timeout: 20000,
        error: function (jqXHR, textStatus, errorThrown) {
            hideLoading();
            reject({});
        },
        });
    });
};
ScheduleTask.prototype.getMyTasks = async function(){
    var id = $("#id").val();
    return await this.send({id},'getMyAllTaskGantt');
}
ScheduleTask.prototype.getCurrentTask = async function(){
    var id = $("#id").val();
    return await this.send({id},'getTaskGantt');
}
ScheduleTask.prototype.openModal = async function(){
    var _this = this;
    _this.myAllTasks = await _this.getMyTasks();
    _this.myCurrentTask = await _this.getCurrentTask();

    $('#schedule_line').click(function () {
      
        

        $('#schedule-gantt-tasks').modal('show');
        if (_this.myAllTasks == '') {
            $('.title-my-tasks').hide();
            $('#main_tasks').hide();
        }else{
            _this.creatGantt({
                data:_this.myAllTasks})
        }
        if (_this.myCurrentTask == '') {
            $('.title-tasks-need-approval').hide();
            $('#sub_tasks').hide();
        }else{
            _this.creatGantt({
                data:_this.myCurrentTask,
                id:"sub_tasks",
                clone:true
            })
        }
        if (_this.myAllTasks == '' &&  _this.myCurrentTask == '') {
            $('.alert-gantt-tasks').removeClass('hidden');
        }
        
    })
}
ScheduleTask.prototype.creatGantt = function({
    data = [],
    id ="main_tasks",
    link = [],
    clone = true
}){

    var tasks = {
        data:data,
        link:link
    }
    var gantt_factory = clone == false ? gantt : Gantt.getGanttInstance();
    gantt_factory.config.work_time = true;

    gantt_factory.config.scale_unit = "day";
    gantt_factory.config.date_scale = "%D, %d";
    gantt_factory.config.min_column_width = 50;
    gantt_factory.config.duration_unit = "day";
    gantt_factory.config.scale_height = 20*3;
    gantt_factory.config.row_height = 25;

    var weekScaleTemplate = function(date){
        var dateToStr = gantt_factory.date.date_to_str("%d %M");
        var weekNum = gantt_factory.date.date_to_str("(week %W)");
        var endDate = gantt_factory.date.add(gantt.date.add(date, 1, "week"), -1, "day");
        return dateToStr(date) + " - " + dateToStr(endDate) + " " + weekNum(date);
    };

    gantt_factory.config.subscales = [
        {unit:"month", step:1, date:"%F, %Y"},
        {unit:"week", step:1, template:weekScaleTemplate}
    ];

    gantt_factory.templates.task_cell_class = function(task, date){
        if(!gantt_factory.isWorkTime(date))
            return "week_end";
        return "";
    };

    gantt_factory.templates.task_text = function(start,end,task){
        return "<span>"+Math.round(task.progress*100)+ "% </span>";
    };

    gantt_factory.config.columns = [
        { name:"text", label: "Task name", tree:true, width:200, resize: true},
        { name:"start_date", label: "Start time", align: "center", width:100, resize:true},
        { name:"end_date", label: "End time", align: "center", width:100, resize:true},
        { name:"duration", label: "Duration", align: "center", width:100, resize:true},
    ];

    gantt_factory.config.readonly = true;
    gantt_factory.init(id);
    // gantt_factory.parse(tasks);

    gantt_factory.parse(tasks);
}

$(document).ready(function(){
    var st = new ScheduleTask();
    st.addEventListener();
})