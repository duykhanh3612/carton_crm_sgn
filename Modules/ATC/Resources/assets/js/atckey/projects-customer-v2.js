class ProjectCustomer{
    constructor(el) {
        this.body = $("body");
        this.tab_product_index = $(el);
    }
}
ProjectCustomer.prototype.send = function (data, url, option = {}) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: "project_customer/" + url,
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
  ProjectCustomer.prototype.stackLoadProductIndex = function(){
    var _this = this;

    this.tab_product_index.ready(function(){
      _this.tab_product_index.find('.mycate').chosen();
      _this.tab_product_index.find(".hidepro").removeClass("hidepro");
      
    })
    
  }  
ProjectCustomer.prototype.addEventListener = function(){
  var _this = this;
  this.stackLoadProductIndex();

}
ProjectCustomer.prototype.triggerScroll = function(){
    if  ($(window).scrollTop() > $(document).height() - $(window).height()- 200){
        this.loadProductIndex();
    }
}
ProjectCustomer.prototype.loadProductIndex = async function(){
    
    var data = await this.send({},'import_item');
    if(data !== false && data.lenght > 0){
        this.loadProductIndex();
    }

}
$(document).ready(function(){
    var pc = new ProjectCustomer("#tabs-2");
    pc.addEventListener();
})