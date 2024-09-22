class LeftNavigation {
    constructor() {
        this.root = $("#left_navigation");
        this.scroll_left = 0;

    }
}
LeftNavigation.prototype.send = function (data, url, option = {}) {
    option.showProcess = option.showProcess ? option.showProcess : true;
    return new Promise((resolve, reject) => {
        $.ajax({
            url: 'modules/' + url,
            type: "POST",
            data: data,
            beforeSend: function () {
                if (option.showProcess){
                    showProcess(1);
                }
                
            },
            complete: function () {
                if (option.showProcess){
                    hideLoading();
                    $(".notiLoading.noPrint").hide()
                }
                
            },
            success: function (res) {

                if (res != null) {

                    if (option.html) {
                        resolve(res);
                    } else {
                        try {
                            res = JSON.parse(res);
                            resolve(res.data);
                        } catch (error) {
                            resolve("");
                        }
                        
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
    })
}
LeftNavigation.prototype.addEventListener = function () {
    var _this = this;
    this.render();

    $('body').on("click", "#fake-close-sidebar", function () {
        _this.toggleSidebar()
    })
    
    $("#left_navigation").on("click",".tab-item",function(e){
        // e.preventDefault();
        // e.stopPropagation();
        _this.clickMenu(this)
    })
    
}
LeftNavigation.prototype.render = function () {

    this.visibleSidebar();
    this.max = parseInt($(".wapper-category[data-max]").data("max"));
    this.max = this.max ? this.max : 0;

}
LeftNavigation.prototype.clickMenu = function(el){
    // var cat = $(el).data("menu")       
    // if (cat != undefined && cat != null) {
    //     window.location = '/modules?cat=' + cat;
    // }
    
}
LeftNavigation.prototype.toggleSidebar = function () {
    console.log("toggleSidebar");
    $("body").toggleClass("closed-sidebar")
    $.cookie('closed-sidebar-po', $('body').hasClass('closed-sidebar') ? 1 : 0, {
        path: '/'
    });
    this.visibleSidebar();

}

LeftNavigation.prototype.visibleSidebar = function () {
    var cookie_closed = $.cookie('closed-sidebar-po');
    if (cookie_closed != "1") {
        this.root.animate({ left: "0px" }, 100);
        $('body').removeClass('closed-sidebar')
        this.root.find(".nav-group-button").find(".btn").animate({ opacity: 1 })
        this.root.find(".wapper-category").show()
        $(".tableFloatingHeaderOriginal").animate({ left: "235px" })
        this.root.css("background", "#f1f1f1");
    } else {

        this.root.find(".nav-group-button").find(".btn").css("opacity", "0")
        this.root.find(".wapper-category").hide()
        $(".tableFloatingHeaderOriginal").animate({ left: "55px" })
        $('body').addClass('closed-sidebar')
        this.root.animate({ left: "-180px" }, 100);
        this.root.css("background", "#0093d9");
    }

    var el = $(".main_container");
    this.setLeftHeaderFixedTable(el, true)

}
LeftNavigation.prototype.setLeftHeaderFixedTable = function (el, animation = false) {
    var cookie_closed = $.cookie('closed-sidebar-po');
    var scrollLeft = $(el).scrollLeft();
    if (cookie_closed && cookie_closed == "0") {

        // open
        scrollLeft = scrollLeft ? 235 - scrollLeft : 235;

    } else {

        // close
        scrollLeft = scrollLeft ? 55 - scrollLeft : 55;

    }

    if (animation) $("#clone").animate({ left: scrollLeft });

    if (!animation) $("#clone").css("left", scrollLeft);


}
$(document).ready(function () {
    console.log("load")
    var ln = new LeftNavigation();
    ln.addEventListener();

})