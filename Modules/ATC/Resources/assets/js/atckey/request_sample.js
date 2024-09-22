class RequestSample{
    constructor(){
        this.body = $("body");
        this.root = $("#page-content");
        this.addEventListener();
    }
}
RequestSample.prototype.send = function(data,url,option={}){
    // var domain = '/'+window.location.pathname +"request_pickup"
    return new Promise((resolve, reject) => {
        $.ajax({
            url:'request_sample/'+ url,
            type: "POST",
            data: data,
            beforeSend:function(){
                showProcess(1);
            },
            complete:function(){
                hideLoading();
            },
            success: function(res) {
                if (res != null) {

                    if(option.html){
                        resolve(res);
                    }else{
                        res = JSON.parse(res);
                        resolve(res.data);
                    }
                    
                } else {
                    reject({});
                }
            },
            timeout: 20000,
            error: function(jqXHR, textStatus, errorThrown) {
                hideLoading();
                reject({});
            },
        });
    })
}
RequestSample.prototype.addEventListener = function(){
    var _this = this;
    this.body.on("click",".part-show-hide",function(){
        _this.partDisplayOptions();
    }).on("submit","#colsModal form.part-main-form",function(){
        console.log("click")
        _this.submitPartDisplayOptions()
    })
}
RequestSample.prototype.submitPartDisplayOptions = async function(){
    var data = $('#colsModal form.part-main-form').serialize();
    var res = await this.send(data,'update_cols');
    if(res){
        window.location = window.location;
    }
}
RequestSample.prototype.partDisplayOptions = async function(){
    var module = $('#act').val();
    var html = await this.send({ module },"part_options",{ html:true });
    $('#colsModal .modal-content').html(html);
    const multi_tab = ['po_cpo', 'po_cpo_close'];
    var fo = 65;
    if (multi_tab.includes(module)) { fo = 65; }
    if ($('#mainTable-module-col').length) {
        this.createDragTasks('mainTable-module-col');
        $('#mainTable-module-col').stickyTableHeaders({
            fixedOffset: fo,
            scrollableArea: '.modal-body'
        });
    }
    if ($('#mainTable-module-col2').length) {
        this.createDragTasks('mainTable-module-col2');
        $('#mainTable-module-col2').stickyTableHeaders({
            fixedOffset: fo,
            scrollableArea: '.modal-body'
        });
        
    }

    $('#colsModal').modal('show');
}
RequestSample.prototype.createDragTasks = function (name) {
    // $("#"+name).tableDnD();
}
$(document).ready(function(){
    var rs = new RequestSample('body');
})