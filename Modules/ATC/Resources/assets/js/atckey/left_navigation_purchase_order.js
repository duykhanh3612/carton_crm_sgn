class LeftNavigation {
    constructor() {
        this.root = $("#left_navigation");
        this.scroll_left = 0;
        this.addEventListener();
    }
}
LeftNavigation.prototype.send = function (data, url, option = {}) {
    option.showProcess = option.showProcess ? option.showProcess : true;
    return new Promise((resolve, reject) => {
        $.ajax({
            url: 'purchase_order/' + url,
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
        console.log("click");
        _this.toggleSidebar()
    }).on("click", "#modalEdit .btn-success", function () {
        _this.submitChangeName(this);
    }).on("click", "#modalEdit .btn-danger", function () {

        _this.removeItemsNavigation();
        $("#showeditNav").trigger('click');

    }).on("click", "#addNewtitleNav", function () {
        _this.addNewItem();
    }).on("click", "#colsModal [data-dismiss=modal]", function () {
        $("#mainTable-module-col .tableFloatingHeaderOriginal").css("z-index", 2)
    }).on("click", ".btn-edit .border-purple.tooltip-link", function () {
        $("#mainTable-module-col .tableFloatingHeaderOriginal").css("z-index", 0)
    }).on("change","#limit_year",function(){
        _this.setCookiePageYear(this);
    })

    //scroll
    $(".main_container").on("scroll", function () {
        _this.setHeaderScrollY(this);
    })

    this.root.on("click", "#showeditNav", function () {
        _this.toggleEditNav(this)
    }).on("click", "[data-target*=newItem]", function () {
        _this.refreshFormNewItem(this);
    }).on("click", ".wapper-category .icon-edit", function (e) {

        e.preventDefault();
        e.stopPropagation();
        _this.refreshEditForm(this)

    }).on("click", "[data-item]", function () {
        
        _this.redirectUrl(this);
    })
}
LeftNavigation.prototype.setCookiePageYear = function(el){
    var page_year = $(el).val();
    $.cookie("page_yearpurchase_order",page_year);
}
LeftNavigation.prototype.saveIndexLeftNavigation = function(el){
    var index = $(el).data("item");
    $.cookie("po-leftnav",index);
}
LeftNavigation.prototype.setActiveLeftNavigation = function(){
    var index = $.cookie("po-leftnav");
    if(index){
        $(".activeLeft").removeClass("activeLeft");
        $("#left_navigation").find('[data-item='+index+']').find("span").eq(0).addClass('activeLeft');
        // $.cookie("po-leftnav",null);
    }
    
}
LeftNavigation.prototype.removeItemsNavigation = function () {
    var is_group = this.editElement.closest("div").hasClass("filter");
    if (is_group) {
        this.editElement.closest(".group-category").addClass("remove");
        this.editElement.closest(".group-category").data("remove", true);
    }

    if (!is_group) {
        this.editElement.closest(".item").addClass("remove");
        this.editElement.closest(".item").data("remove", true);
    }
    
    this.updateLeftNavigation();
}
LeftNavigation.prototype.refreshEditForm = function (el) {
    var title = $(el).hasClass("edit-item-cate") ? "Item" : "Group";
    $("#modalEdit").find(".modal-title").text(`Edit ${title}`)
    this.editElement = $(el).closest("div");
    var old_name = this.editElement.find("span").eq(0).text();
    var old_url = this.editElement.closest(".item").data("url");

    var edit_form = '';
    if (title == "Group") edit_form = this.editHtmlFormGroup(old_name);
    if (title == "Item") edit_form = this.editHtmlFormItem(old_name, old_url);

    $("#modalEdit").find(".modal-body").html(edit_form);
    $("#modalEdit").modal("show");

}
LeftNavigation.prototype.editHtmlFormGroup = function (name) {
    return `<div class="form-group">
    <div class="col-sm-12">Old name</div>
    </div>
    <div class="form-group">
        <div class="col-sm-12">
            <input type="text" class="form-control" disabled name="old_name" value="${name}" id="old_name">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-12">New name <span style="color:red">*</span></div>
    </div>
    <div class="form-group">
        <div class="col-sm-12">
            <input type="text" placeholder="input new name" class="form-control" data-required="1" autocomplete="off" name="new_name" id="new_name">
            <div class="errordiv new_name">
                <div class="arrow"></div>New name is empty
            </div>
        </div>
    </div>`;
}
LeftNavigation.prototype.editHtmlFormItem = function (name, url) {
    return `<div class="form-group">
    <div class="col-sm-12">Old name</div>
    </div>
    <div class="form-group">
        <div class="col-sm-12">
            <input type="text" class="form-control" value="${name}" disabled name="old_name" id="old_name">
        </div>
    </div>
    <div class="form-group">
    <div class="col-sm-12">Old link</div>
    </div>
    <div class="form-group">
        <div class="col-sm-12">
            <input type="text" class="form-control" value="${url}" disabled name="old_link" id="old_link">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-12">New name <span style="color:red">*</span></div>
    </div>
    <div class="form-group">
        <div class="col-sm-12">
            <input type="text" placeholder="input new name" class="form-control" data-required="1" autocomplete="off" name="new_name" id="new_name">
            <div class="errordiv new_name">
                <div class="arrow"></div>New name is empty
            </div>
        </div>
    </div><div class="form-group">
    <div class="col-sm-12">New Link</div>
    </div>
    <div class="form-group">
        <div class="col-sm-12">
            <input type="text" placeholder="input new link" class="form-control" data-required="1" autocomplete="off" name="new_url" id="new_url">
        </div>
    </div>`;
}

LeftNavigation.prototype.refreshFormNewItem = function (el) {
    var title = $(el).hasClass("btn-group-category") ? "Item" : "Group";
    this._btnAddNew = $(el)

    $("#newItem").find("#item_name").val(null);
    $("#newItem").find(".modal-header h4").html(`New ${title}`);
    $("#newItem").data("type", title);
    $("#newItem").find("#item_url").closest(".form-group").remove();

    if (title == "Item") {
        $("#newItem").find(".modal-body").append(`
            <div class="form-group">
                <div class="col-sm-2 control-label">Link</div>
                <div class="col-sm-10">
                    <input type="text" id="item_url" class="form-control" value="" autocomplete="off">
                </div>
            </div>
        `);
    }
}
LeftNavigation.prototype.addNewItem = function () {
    var type = $("#newItem").data("type")
    var name = $("#newItem").find("#item_name").val();

    if (name == '' || name == 'undifined') return false;

    var group_id = this.max ? this.max + 1 : 1;

    if (type == "Group") {

        this.root.find(".wapper-category").append(`<div data-new="1" class="group-category" data-group="${group_id}">
        <div class="filter">
        <i class="glyph-icon icon-edit edit-filter-cate" style="padding-right: 5px" data-target="#modalEdit" data-toggle="modal"></i>
        <span>${name}</span>
        <i title="create new item" class="btn-alt font-green btn-group-category pull-right glyph-icon icon-plus-circle" data-toggle="modal" data-target="#newItem"></i>
        </div>
        </div>`)
        this.max++;

    }

    if (type == "Item") {
        var url = $("#newItem").find("#item_url").val();
        group_id = this._btnAddNew.closest(".group-category").data("group");
        var item_id = this.max ? this.max + 1 : 1;
        this.root.find(".wapper-category").find(`[data-group=${group_id}]`).append(`
        <div class="item" data-new="1" data-item="${item_id}" data-url="${url}"><i class="glyph-icon icon-edit edit-item-cate" style="padding-right: 5px; display: inline;" data-target="#modalEdit" data-toggle="modal"></i>
            <span>${name}</span> 
            <span class="badge pull-right number_count">0</span>
        </div>
        `)
        this.max++;

    }
    this.updateLeftNavigation()
}
LeftNavigation.prototype.redirectUrl = function (el) {
    this.saveIndexLeftNavigation(el);
    var url = $(el).data("url");
    if (url) window.location.href = url;
}
LeftNavigation.prototype.openFormNewItem = function () {
    $("#newItem").modal("show")
}
LeftNavigation.prototype.submitChangeName = function (el) {
    var newName = $("#modalEdit").find("#new_name").val();
    if (newName != '') {
        this.editElement.find("span").eq(0).text(newName);
    }
    var newUrl = $("#modalEdit").find("#new_url").val();
    if (newUrl != '') {
        this.editElement.closest(".item").data("url", newUrl);
    }
    this.updateLeftNavigation();
}

LeftNavigation.prototype.toggleEditNav = function (el) {
    
    if ($(el).data("hide") == 0) {
        this.root.find(".wapper-category").find("i").hide();
        this.root.find(".filter").find(".btn-group-category").hide();
        this.setSortable("destroy");
        $(el).data("hide", 1);
        $("[data-item][data-url]").bind("click");
    } else {
        this.root.find(".wapper-category").find("i").show();
        this.root.find(".filter").find(".btn-group-category").show();
        this.setSortable("create");
        $(el).data("hide", 0)
        $("[data-item][data-url]").unbind("click");
    }
    this.updateLeftNavigation();


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
LeftNavigation.prototype.setSortable = function (mode = "create") {

    var group = document.getElementsByClassName("wapper-category")[0];
    var items = document.getElementsByClassName("group-category");
    var _this = this;
    
    var dm = new DrableMenu({
        root: "left_navigation",
        onUpdate: function () {
            _this.updateLeftNavigation();
        },
    });

    
    if(mode == "destroy"){
        dm.destroy()
        return false;
    }

    if(mode == "create"){
        dm.init()
        return true;
    }
    // if (mode == "destroy") {
    //     this.group_sortable.destroy();
    //     this.item_sortable.forEach((i) => {
    //         i.destroy();
    //     })
    //     return false;
    // }

    // // if (mode == "create") {
    // //     this.group.sortable("enable");
    // //     $.each(items, function (k, v) {
    // //         v.sortable("enable");
    // //     })
    // //     return false;
    // // }

    // var _this = this;
    // this.group_sortable = Sortable.create(group, {
    //     // swap: true, // Enable swap plugin
    //     handle: '.filter',
    //     swapClass: 'highlight', // The class applied to the hovered swap item
    //     animation: 150,
    //     group: 'shared',
    //     ghostClass: "blue-background-class",
    //     dataIdAttr: 'data-group',
    //     onUpdate: function () {
    //         _this.updateLeftNavigation();
    //        // updategroupstt();
    //     },
    //     store: {
    //         // get: function (sortable) {
    //         //     var order = localStorage.getItem("groups_category");
    //         //     return order ? order.split('|') : [];
    //         // },
    //         // set: function (sortable) {
    //         //     var order = sortable.toArray();
    //         //     localStorage.setItem("groups_category", order.join('|'));
    //         // }
    //     }

    // })
    // var item_sortable = [];
    // $.each(items, function (k, v) {
    //     var item = Sortable.create(v, {
    //          //swap: true, // Enable swap plugin
    //         group: 'nested',
    //         handle: '.item',
    //         swapClass: 'highlight', // The class applied to the hovered swap item
    //         animation: 150,
    //         dataIdAttr: 'data-item',
    //         ghostClass: "blue-background-class",
    //         onUpdate: function () {
    //             _this.updateLeftNavigation();

    //          // updateitemstt();

                
    //         },
    //         store: {
    //             // get: function (sortable) {
    //             //     var order = localStorage.getItem("items-category");
    //             //     return order ? order.split('|') : [];
    //             // },
    //             // set: function (sortable) {
    //             //     var order = sortable.toArray();
    //             //     localStorage.setItem("items-category", order.join('|'));
    //             // }
    //         },
    //         onEnd: function (/**Event*/evt) {
    //             // disabled drag filter
    //             if (evt.newIndex == 0) {
    //                 var filter = $(v).find(".filter");
    //                 $(v).find(".filter").remove();
    //                 $(v).prepend(filter);
    //             }
    //            // _this.updateLeftNavigation();
    //         }
    //     })
    //     item_sortable.push(item)
    // })

    // this.item_sortable = item_sortable;

}
LeftNavigation.prototype.isDifferentGroup = function(e){
    return ($(e.from).index() != $(e.to).index())
}
LeftNavigation.prototype.setHeaderScrollY = function (el) {
    var scroll = $(el).scrollTop();
    var anchor_top = $(".main_container").offset().top;
    var anchor_bottom = $("#bottom_anchor").offset().top;
    var clone_table = $("#clone");

    // scroll y
    if (scroll > anchor_top && scroll < anchor_bottom) {

        if (clone_table.length == 0) {
            clone_table = $(".mainTable").clone();
            clone_table.find(".tableFloatingHeaderOriginal").find("tr").eq(0).remove()
            clone_table.attr('id', 'clone');
            clone_table.css({
                position: 'fixed',
                top: anchor_top
            });
            clone_table.width($(".mainTable").width());
            $(".main_container").append(clone_table);
            $("#clone").css({ visibility: 'hidden' });
            $("#clone thead").css({ visibility: 'visible' });
        }
    } else {
        $("#clone").remove();
    }

    this.setLeftHeaderFixedTable(el);

}
LeftNavigation.prototype.pushItemData = function(item,data,group_id,sort_order){
    var isNew = $(item).data("new");
    isNew = isNew ? isNew : false;
    var del = $(item).data("remove");
    del = del ? del : false;
    var id = $(item).data("item");
    var url = $(item).data("url");
    var item_name = $(item).find("span").eq(0).text();
    var badge = $(item).find("span.badge").text();

    // case del
    if(del==true && isNew != true){
        data.del.push(id)
    }

    if (del == false && isNew != true){
        data.data.push({
            id: id,
            name_vn: item_name,
            url: url,
            brief: badge,
            parent: group_id,
            sort_order:sort_order
        })
    }

    if (del == false && isNew != false) {
        data.insert.push({
            id: id,
            name_vn: item_name,
            url: url,
            brief: badge,
            parent: group_id,
            sort_order:sort_order
        })
    }

    return data;
}
LeftNavigation.prototype.pushGroupData = function(group,data,index = 1){
    var group_id = $(group).data("group");
    var new_group = $(group).data("new");
    var remove = $(group).data("remove");
    var name = $(group).find(".filter span").eq(0).text();
    new_group = new_group ? new_group : false;
    remove = remove ? remove : false;

    // case delete
    if(remove && new_group != true){
        data.del.push(group_id)
    }

    // case upgrade
    if (remove == false && new_group!= true){
        data.data.push({
            id: group_id,
            name_vn: name,
            url: null,
            brief: null,
            parent: 0,
            sort_order:index
        })
    }

    // case insert
    if (remove == false && new_group) {
        data.insert.push({
            id: group_id,
            name_vn: name,
            url: null,
            brief: null,
            parent: 0,
            sort_order:index
        })
    }
    return data;

}
LeftNavigation.prototype.getDataMenu = function(){
    var _this = this;
    var sort_order = 0;
    var data = {
        data:[],
        del:[],
        insert:[]
    };

    this.root.find("[data-group]").each(function () {
        sort_order++;
        var group_id = $(this).data("group");
        data = _this.pushGroupData(this,data,sort_order);

        $(this).find(".item").each(function () {
            sort_order++;
            data = _this.pushItemData(this,data,group_id,sort_order);
        })
    })
    return data;
}
LeftNavigation.prototype.updateLeftNavigation = async function () {

    await this.updateBadges();
    var data = this.getDataMenu();
    await this.send(data,"changeLeftNavigation");

    // this.root.find("[data-group]").each(function () {
    //     sort_order++;
    //     var group_id = $(this).data("group");
    //     var new_group = $(this).data("new");
    //     new_group = new_group ? new_group : false;
    //     var remove = $(this).data("remove");
    //     remove = remove ? remove : false;
    //     var name = $(this).find(".filter span").eq(0).text();
    //     if(remove==true){
    //         updatemenuparentleft(1,sort_order,group_id,name,'purchase_order_navigation');
    //     }
    //     if (remove == false) {
    //         updatemenuparentleft(0,sort_order,group_id,name,'purchase_order_navigation');
    //     }

    //     $(this).find(".item").each(function () {
    //         sort_order++;
    //         var id = $(this).data("item");
    //         var url = $(this).data("url");
    //         var del = $(this).data("remove");
    //         var isNew = $(this).data("new");
    //         isNew = isNew ? isNew : false;
    //         del = del ? del : false;
    //         var item_name = $(this).find("span").eq(0).text();
    //         var badge = $(this).find("span.badge").text();
    //         if(del==true){
    //             updatemenuleft(1,sort_order,id,group_id,item_name,badge,url,'purchase_order_navigation');
    //         }
    //         if (del == false) {
    //             updatemenuleft(0,sort_order,id,group_id,item_name,badge,url,'purchase_order_navigation');
    //         }
    //     })
    // })


   // console.log({ data, del: data_del, insert: data_insert });


}
LeftNavigation.prototype.render = function () {

    // this.root.html("")
    // var res = await this.send({isAjax:true},"/leftNavigation",{html:true})
    // this.root.html(res);

    // this.setSortable();
    this.visibleSidebar();
    this.max = parseInt($(".wapper-category[data-max]").data("max"));
    this.max = this.max ? this.max : 0;
    this.updateLeftNavigation();
    this.setActiveLeftNavigation();
}
LeftNavigation.prototype.updateBadges = async function () {

    var data = [];
    var _this = this;
    this.root.find("[data-url]").each(function () {
        data.push({
            id: $(this).data("item"),
            url: $(this).data("url")
        })
    })
    
    var current_year = $.cookie('page_yearpurchase_order');

    var res = await this.send({ data,current_year }, "getBadges", { showProcess : false });

    if (res) {
        await $.each(res, function (k, i) {
            _this.root.find("[data-item=" + i['id'] + "]").find("span.badge").html(i['badge']);
        })
    }

}

$(document).ready(function () {

    new LeftNavigation();

})