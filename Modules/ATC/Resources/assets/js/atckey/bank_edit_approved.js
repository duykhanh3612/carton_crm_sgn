class Approved{
    constructor(id) {
        this.init();
        this.root = $("#info-order");
        this.id = id;
        this.addEventListener();
        if(id) this.removeChosen();
    }
    static removeLoading(){
        $("#loading-animated").removeClass("yt-loader");
        // unblock form
        $(".panel.panel-default.panel-sticky").css("pointer-events", "auto");
        $("body").css("cursor", "auto");
    }
    static addLoading(){
        
        $("#loading-animated").addClass("yt-loader");
        // block form
        $(".panel.panel-default.panel-sticky").css("pointer-events", "none");
        $("body").css("cursor", "progress");
    }
}
Approved.prototype.init = async function(){
   
}
Approved.prototype.removeChosen = function(){
    var app = this;
    var t = 1000;
    setTimeout(()=>{
        $("#ap-information").find(".select2").chosen("destroy");
        app.select2();

        // create date
        var tomorrow = moment().add(0, "d").startOf("d");
        $("#list_approved")
        .find(".bootstrap-datepicker-time").each(function(){
            app.createDateTimePicker(this,tomorrow);
        })

        // add min date
        app.addMinDate();
        //app.loopFixBugRender();
        
    },t)

    // // fix bug
    // setTimeout(()=>{
    //     app.loopFixBugRender();
    // },(t+100))

}
Approved.prototype.loopFixBugRender = function(isBug=false){
    var app = this;
    setTimeout(()=>{
        var w = $("#list_approved").find(".form-group").eq(1).find(".row").find(".col-md-2").find("span").width();
        console.log({w});
        isBug = w==100;
        // loop fix bug render select2
        if(isBug){
            $("#info-order #list_approved").find(".select2").each(function(){
                $(this).select2({
                    placeholder: "Select an option",
                  });
              }) 
              app.loopFixBugRender();
        }
    },1000)
}
Approved.prototype.addEventListener = function(){
    var app = this;
    this.root.on("change","select.Approved",async function(){
        await app.selectedLevel(this);
        await app.removeImg();
        await app.select2()
    })
    this.root.on("change","select.ap_title",async function(){
        await app.selectedTitle(this);
        await app.removeImg();
        await app.select2()
    })
    this.root.on("change","select.ap_depart",async function(){
        await app.selectedDepart(this);
        await app.removeImg();
        await app.select2()
    })
    this.root.on("change","select.ap_number",async function(){
        
        await app.numberChange(this);
        await app.removeImg();
        await app.select2();
    })
    
    $('body').on("click","#approved",function(){
        app.approved(this);
    })

    // plugin datetimepicker
    this.root.on("dp.hide",".ap_date",function(){
        var orgindate = $(this).val();
        var date = $(this).data("DateTimePicker").date()._i;

        if(orgindate!=date) app.changeDate(this);
    })

}
Approved.prototype.select2 = async function(){
        
    $("#info-order #ap-information").find('.select2').select2({
        placeholder: 'Select an option'
      });
    var len = $("#info-order #list_approved").find('.select2').length;

    if(len){
        
      $("#info-order #list_approved").find(".select2").each(function(){
        $(this).select2({
            placeholder: "Select an option",
          });
      })
    } 

}
Approved.prototype.send = function(data,url,option={}){
  // option = html || json
  var domain = $("#back_url").val();
  return new Promise((resolve, reject) => {
    $.ajax({
      url: domain + "/" + url,
      type: "POST",
      data: data,
      beforeSend: function () {
        showProcess(1);
        Approved.addLoading();
      },
      complete: function () {
        hideLoading();
        Approved.removeLoading();
        
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
        Approved.removeLoading();
        reject({});
      },
    });
  });
}
Approved.prototype.approved = function(el){

        var id= $(el).data('id');
        var app = this;
        $.alerts.confirm1('Are you sure you confirm this item? Successfully confirming the system will lock the system cannot be adjusted. Please double check before doing, Thanks !!!<br />', 'Confirm ', function(r) {
            
            if(r=="a"){
                var type = 3;
            }else if (r == true){
                var type = 2;
            }
            app.send({id,type},'changeStatus');
            location.reload();
        })
        

}
Approved.prototype.removeImg = function(){
    $(".approved_close_container").remove();
}

Approved.prototype.selectedLevel = async function(el){
        var app = this;
        var value = $(el).val();
        var id = app.id;
        var html = await this.send({id,value},"importtApproved",{"html":true});
        await $("#ap-information").html(html);

        // create DatePickerTime
        var tomorrow = moment().add(0, "d").startOf("d");
        $("#list_approved")
        .find(".bootstrap-datepicker-time").each(function(){
            app.createDateTimePicker(this,tomorrow);
        })
  
}

Approved.prototype.createDateTimePicker = function(el,date){
    $(el).datetimepicker({
        format: 'YYYY-MM-DD HH:mm',
        useCurrent: false,
        ignoreReadonly: true,
        showClose:true,
        showClear:true,
        // daysOfWeekDisabled: daysDisabled,
        // defaultDate: tomorrow,
        //minDate: date,
        tooltips:{
            close:"accept date"
        },
        icons: {
            time: 'glyph-icon icon-clock-o',
            date: 'glyph-icon icon-calendar',
            up: 'glyph-icon icon-chevron-up',
            down: 'glyph-icon icon-chevron-down',
            previous: 'glyph-icon icon-chevron-left',
            next: 'glyph-icon icon-chevron-right',
            clear: "fa fa-eraser",
            close: "fa fa-check"
        }
    });
}

Approved.prototype.selectedTitle = async function(el){
  var value = $(el).val();
  var staffs = this.getStaffs();
  var data = await this.send({value,staffs},"getDepartment");
  this.changeDepart(data,el);
  this.changeStaffs({},el);
 
}
Approved.prototype.getStaffs = function(){
    var staffs = "";
    this.root.find(".ap_staff").each(function(){
        var v = $(this).val();
        if(v&&v!=-1) staffs+="'"+v+"',";
    })
    staffs = staffs.replace(/\,$/g,"");
    return staffs;
}
Approved.prototype.selectedDepart = async function(el){
    var value = $(el).val();
    var id = $(el).closest(".row").find("select.ap_title").val();
    var staffs = this.getStaffs();
    
    var data = await this.send({id,value,staffs},"getStaffs");

    this.changeStaffs(data,el);
    
}
Approved.prototype.changeDepart = function(data,el){
    var htmlOptions = this.createOptions(data);
    $(el).closest(".row").find("select.ap_depart").html(htmlOptions);
    $(el).closest(".row").find("select.ap_depart").select2();
}
Approved.prototype.changeStaffs = function(data,el){
    var htmlOptions = this.createOptions(data);
    $(el).closest(".row").find("select.ap_staff").html(htmlOptions);
    $(el).closest(".row").find("select.ap_staff").select2();
}
Approved.prototype.createOptions = function(data){
    var options = "<option value ='-1'>Select an option</option>";
    if(data){
        $.each(data,function(k,v){
            
            options+="<option value='"+v.id+"'>"+v.text+"</option>";
        })
    }
    
    return options;
}
Approved.prototype.numberChange = async function(el){
    var value = $(el).val();
    var group = $(el).closest(".form-group");
    
    var index = group.index()-1;
    var data = await this.send({ajax:true},"getTitle")

    var rows = '';
    for(var i=1 ;i<value;i++){
        rows+= this.createChildRow(i,index,data);
    }
    await group.find(".row:not(:first-child)").each(function(){
        $(this).remove();
    })
    await group.append(rows);

    var app = this;
    var date = $(el).closest(".row").find(".ap_date").data("DateTimePicker").minDate();
    
    group.find(".row:not(:first-child)").each(function(){
        $(this).find(".ap_date").each(function(){   
            app.createDateTimePicker(this,date);
        })
    })

    
}
Approved.prototype.createChildRow = function(number,index,data){
    var htmlOptions = this.createOptions(data['options']);
    return `<div class="row row-child">
    <div class="col-md-2"></div>
    <div class="col-md-2">
    <select name="app[${index}][${number}][ap_title]" class="form-control ap_title select2 " value="">
        ${htmlOptions}
    </select>
    </div>
    <div class="col-md-3">
        <select name="app[${index}][${number}][ap_depart]" class="form-control ap_depart select2" value="">
        </select>
    </div>
    <div class="col-md-3">
        <select name="app[${index}][${number}][ap_staff]" class="form-control ap_staff select2" value=""></select>
    </div>
    <div class="col-md-2">
        <input data-level="${index}" name="app[${index}][${number}][ap_date]" class="form-control ap_date bootstrap-datepicker-time " autocomplete="off">
    </div>
</div>`;
}
Approved.prototype.addMinDate = function(){
    var index = $("#list_approved").find(".form-group").length-1;
    for(var j=0;j<index;j++ ){
        var level = $("#list_approved").find(".ap_date[data-level*="+j+"]").data("level");
        var date = this.getMaxDateOnChild(level);
        var nextLevel = j+1;
        
        $("#list_approved").find(".ap_date[data-level*="+nextLevel+"]").each(function(){
            $(this).data("DateTimePicker").minDate(date);
        })

    }
    
    
}
Approved.prototype.changeDate = function(el){
    
    var level = $(el).data("level");
    var date = this.getMaxDateOnChild(level);
    if(!date||date=="") return false;

    this.refreshDate(date,level); 
    
}
Approved.prototype.getMaxDateOnChild = function(level){
    var index = level+1;
    var array = [];
    var dateInt = [];
    $("#list_approved").find(".form-group").eq(index).find(".ap_date").each(function(){
        var date = new Date($(this).val()).getTime();
        dateInt.push(date);
        array.push($(this).val());
    })

    var index = this.getIndexMax(dateInt);

    return array[index];
}
Approved.prototype.getIndexMax = function(data){
    var index = 0;
    var start = data[0];
    data.forEach((v,k) => {
        if(start<v){
            start = v;
            index = k;
        } 
    });
    return index;
}
Approved.prototype.refreshDate = function(date,index){
    this.root.find(".ap_date").each(function(){

        var l = $(this).data("level");

        if(index<l){
            $(this).data("DateTimePicker").minDate(date);
            $(this).data("DateTimePicker").date(null);
            $(this).val(null);
        }
        
    })
}

new Approved(document.currentScript.getAttribute('id'));
