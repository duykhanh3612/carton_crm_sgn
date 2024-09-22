/* Modules functions */
var site_url = window.location.protocol + "//" + window.location.host + "/admin/";
$(document).on("click", ".col-show-hide", function () {
        // showProcess(1);
        waitingDialog.show("Please wait...");
        var module = $("#act").val();
        var tab = $(this).data("tab");
        var moduletab = $(this).data("module");
        //alert(tab);l
        if (module == "positions") {
            module = $("#moduleInfo").attr("data-table");
        }
        if (tab == 1) {
            module = moduletab;
        }

        if (module == "customer_sales_contract") {
            var activeleft = $.cookie("activecsc");

            if (activeleft == 195 || activeleft == 196) {
                activeleft = "customer_sales_contract" + activeleft + "";
            } else {
                activeleft = "customer_sales_contract";
            }
            // alert(1);
            module = activeleft;
        }
        if (module == "customer_rfq") {
            var activeleft = $.cookie("customer_rfq");
            console.log(activeleft);
            if (activeleft == 195 || activeleft == 196) {
                activeleft = "customer_rfq" + activeleft + "";
            } else {
                activeleft = "customer_rfq";
            }
            // alert(1);
            module = activeleft;
        }
        if (module == "sales_quotation") {
            var activeleft = $.cookie("activesq");
            console.log(activeleft);
            if (activeleft == 195 || activeleft == 196) {
                activeleft = "sales_quotation" + activeleft + "";
            } else {
                activeleft = "sales_quotation";
            }
            // alert(1);
            module = activeleft;
        }
        if (module == "customer_sales_contract") { }
        // alert(module);

        $.ajax({
            url: site_url + "modules/column_options",
            type: "POST",
            cache: false,
            data: {
                module: module,
            },
            success: function (html) {
                // $('#colsModal .modal-content').html(html);
                waitingDialog.hide();
                showPopup("colsModal", html);
                const multi_tab = ["po_cpo", "po_cpo_close"];
                var fo = 42;
                if (multi_tab.includes(module)) {
                    fo = 65;
                }
                if ($("#mainTable-module-col").length) {
                    makeDragOrder("module-col");
                    // $('#mainTable-module-col').stickyTableHeaders({
                    //     fixedOffset: fo,
                    //     scrollableArea: '.modal-body'
                    // });
                }
                if ($("#mainTable-module-col2").length) {
                    makeDragOrder("module-col2");
                    // $('#mainTable-module-col2').stickyTableHeaders({
                    //     fixedOffset: fo,
                    //     scrollableArea: '.modal-body'
                    // });
                }
                $("#colsModal").modal("show");
            },
        });
        return false;
    })
    .on("click", ".part-show-hide", function () {
        var module = $("#act").val();
        waitingDialog.show("Please wait...");
        $.ajax({
            url: site_url + "modules/column_options/part",
            type: "POST",
            cache: false,
            data: {
                module: module,
            },
            success: function (html) {
                waitingDialog.hide();
                showPopup("colsModal", html);
                if ($("#mainTable-module-col").length)
                    makeDragOrder("module-col");
                // if ($('#mainTable-module-col-line1').length) makeDragOrder('module-col-line1');
                // if ($('#mainTable-module-col-line2').length) makeDragOrder('module-col-line2');
            },
        });
    })
    .on("click", "#tab-options .nav-item .nav-link", function () {
        var tabActive = $(this).attr("data-cols");
        makeDragOrder(tabActive);
    })
    .on("submit", "#colsModal form.co-main-form", function (e) {
        e.preventDefault();
        var input_file = $(this).find("input[name='file']").val();

        $("#colsModal form.co-main-form tbody tr").each(function () {
            if (!$(this).find("input.field-show").is(":checked"))
                $(this).remove();
        });

        waitingDialog.show("Please wait...");
        $.ajax({
            url: site_url + "ajax/update_cols",
            type: "POST",
            cache: false,
            data: $("#colsModal form.co-main-form").serialize(),
            success: function (res) {
                const md_po_colm = [
                    "po_cpo",
                    "po_cpo_close",
                    "purchase_order",
                    "pending_approval_po",
                    "approved_po",
                    "late_approval_po",
                    "po_late_remain_time",
                    "late_order_confirm",
                    "order_confirm_close",
                    "order_confirmation",
                    "order_confirm_pendding",
                    "order_confirm",
                ];
                if (md_po_colm.includes(input_file)) {
                    location.replace(input_file);
                } else {
                    window.location = window.location;
                }
                waitingDialog.hide();
            },
        });
        return false;
});

function showPopup(id, html, fullscreen = true, size = "") {
    if ($("#" + id).length > 0) {
        $("#" + id)
            .find(".modal-content")
            .html(html);
    } else {
        bindHtml = `<div class="modal ${fullscreen ? "modal-fullscreen" : ""
            }" id="${id}"><div class="modal-dialog ${fullscreen ? "modal-fullscreen" : ""
            } ${size}"><div class="modal-content">${html}</div></div></div>`;
        $("body").append(bindHtml);
    }
    $(".modal-show").each(function () {
        $(this).removeClass("modal-second").addClass("modal-first");
    });
    $("#" + id)
        .removeClass("modal-first")
        .addClass("modal-second");
    $("#" + id).modal("show");
}

function makeDragOrder(tab, cat, field, orderby, ordermode) {
    var dragTable = $("#mainTable-" + tab);
    if (cat == null) cat = "";
    if (field == null) field = "";
    if (orderby == null) orderby = "";
    if (ordermode == null) ordermode = "";
    var type = $("#moduleInfo").data("type");
    var rowstart = parseInt($("#rowstart").val());
    var thead = dragTable.find("thead").length;

    dragTable.tableDnD({
        onDragClass: "myDragClass",
        onDrop: function (table, row) {
            var rows = table.tBodies[0].rows;
            var IDs = "";
            for (var i = 0; i < rows.length; i++) {
                IDs += rows[i].id;
                if (i < rows.length - 1 && (i > 0 || thead)) {
                    IDs += ",";
                }
                $("#Priority_" + rows[i].id).val(
                    i + (thead ? 1 : 0) + rowstart
                );
                $(".STT_" + rows[i].id).html(i + (thead ? 1 : 0) + rowstart);
            }
            if ($(".STT_" + row.id).html() != $("#Old_" + row.id).val()) {
                // showProcess();
                $.ajax({
                    url: site_url + "ajax/sort_order",
                    type: "POST",
                    cache: false,
                    data: {
                        IDs: IDs,
                        cat: cat,
                        field: field,
                        orderby: orderby,
                        ordermode: ordermode,
                        table: tab,
                        rowstart: rowstart,
                    },
                    success: function () {
                        showNoti(
                            (type ? type + ": " : "") + $(row).attr("name"),
                            "Cập nhật vị trí thành công",
                            "Ok"
                        );
                        for (var i = 0; i < rows.length; i++) {
                            $("#Old_" + rows[i].id).val(
                                i + (thead ? 1 : 0) + rowstart
                            );
                        }
                    },
                });
            }
            dragTable.find("tr").css("cursor", "auto");
        },
    });
}

$(window).bind("scroll", function () {
    if ($(window).scrollTop() > 550) {
        $(".top-buttons").addClass("show");
    } else {
        $(".top-buttons").removeClass("show");
    }
});

$("#triggerSave").on("click", function () {
    $("form").find("button[type=submit]").trigger("click");
});
$("#triggerSave").on("click", function () {
    $("form").find("button[type=submit][value='save']").trigger("click");
});
$("#triggerApply").on("click", function () {
    $("form").find("button[type=submit][value='apply']").trigger("click");
});
$(document).on("click", ".btn-submit-filter", () => {
    $("input[name=keywords").trigger("change");
});

$("body").on("click", "#backBtn", function (e) {
    window.location = $(this).attr("data-back");
    return false;
});
/* column settings */
$(document).ready(function () { })
    .on("change", ".display-type", function () {
        var value = $(this).val(),
            types = ["color", "field_by_id"];

        $(this).closest("tr").find(".part-setting").addClass("hidden");
        if (types.includes(value)) {
            $(this).closest("tr").find(".part-setting").removeClass("hidden");
        }
    })
    .on("click", ".part-setting", function () {
        var column = $(this).closest("td").data("column"),
            name = $(this).attr("data-name") ?? "column_options",
            displayType = $(`[name="${name}[${column}][type]"]`)
                .val()
                .toLowerCase(),
            displayTypeSetting = $(`[name="${name}[${column}][setting]"]`).val() ?
                $(`[name="${name}[${column}][setting]"]`).val() :
                "";
        if ($("#display-type").length) $("#display-type").remove();
        waitingDialog.show("Please wait...");
        $.ajax({
            url: site_url + "modules/column_settings",
            type: "POST",
            cache: false,
            data: {
                column: column,
                display_type: displayType,
                display_type_value: displayTypeSetting,
                name: name,
            },
            dataType: "html",
            success: function (html) {
                showPopup("display-type", html, false, "modal-lg");
                if (displayType == "color") {
                    if ($("#orders_status_type").length) {
                        var data = $("#orders_status_type")
                            .find("option:selected")
                            .data("options") ?
                            $("#orders_status_type")
                                .find("option:selected")
                                .data("options") :
                            {};
                        $(".color-type-detail tbody").html(bindHtmlColor(data));
                    }
                }
                waitingDialog.hide();
            },
        });
    })
    .on("hidden.bs.modal", "#display-type", function () {
        $(this).remove();
    })
    .on("show.bs.modal", "#display-type", function () {
        var type = $("#frm-display-type").data("type");
        if (type == "field_by_id") getFieldByTable();
        bindSelect2("#display-type");
    });
/* Display type color */
function bindSelect2(parent) {
    $(parent)
        .find(".select2")
        .select2({
            dropdownParent: $(parent),
        });
}

function bindHtmlItemColor(key = 0, value = {}, isNew = 1) {
    return `<tr data-index="${key}" data-new="${isNew}">
                 <td width="5%" class="text-center">
                     ${parseInt(key) + 1}
                     <input class="form-control" type="hidden" name="options[${key}][id]" value="${value["id"] ?? ""
        }">
                 </td>
                 <td>
                     <input class="form-control" type="text" name="options[${key}][key]" placeholder="key" value="${value["key"] ?? ""
        }">
                 </td>
                 <td>
                     <input class="form-control" type="text" name="options[${key}][name]" placeholder="name" value="${value["name"] ?? ""
        }">
                 </td>
                 <td>
                     <input class="form-control" type="color" name="options[${key}][color]" placeholder="color" value="${value["color"] ?? ""
        }">
                 </td>
                 <td>
                     <input class="form-control" type="color" name="options[${key}][color_text]" placeholder="color_text" value="${value["color_text"] ?? ""
        }">
                 </td>
                 <td width="5%" class="text-center">
                     <i class="fa fa-trash font-red btn-remove-setting-item" aria-hidden="true"></i>
                 </td>
             </tr>`;
}

function bindHtmlColor(data) {
    if (typeof data === "undefined") return "";
    var html = ``;
    for (const [key, value] of Object.entries(data)) {
        html += bindHtmlItemColor(key, value, 0);
    }
    return html;
}

function HandelSubmitColor(column, data, name) {
    $(".color-type-detail tbody tr").each(function () {
        if ($(this).is(":hidden")) $(this).remove();
    });
    waitingDialog.show("Please wait...");
    $.ajax({
        url: site_url + "modules/sync_orders_status",
        type: "POST",
        data: data,
        dataType: "json",
        success: function (result) {
            if (result.success) {
                $(`[name="${name}[${column}][setting]"]`).remove();
                $('td[data-column="' + column + '"]').append(
                    `<input type="hidden" name="${name}[${column}][setting]" value="${result.data}" />`
                );
            } else {
                showNoti("An error occurred", "Notification", "Err");
            }
            waitingDialog.hide();
        },
    });
}

function HandelSubmitFieldById(column, data, name) {
    var params = new URLSearchParams(data);
    var obj = Object.fromEntries(params.entries());
    // var json = JSON.stringify(obj).replace(/"/g, "'");
    if ($(`[name="${name}[${column}][setting]"]`).length) {
        $(`[name="${name}[${column}][setting]"]`).val(JSON.stringify(obj));
    } else {
        $('td[data-column="' + column + '"]').append(
            `<input type="hidden" name="${name}[${column}][setting]" value='${JSON.stringify(
                obj
            )}' />`
        );
    }
}
$(document).ready(function () {
        $(".filter-head .select2").select2({
            templateResult: function (option) {
                if (!option.id) {
                    return option.text;
                }
                var color = $(option.element).data("background-color");
                var text = $(option.element).data("text-color");
                return $('<span class="option-color"></span>')
                    .css("background-color", color)
                    .css("color", text)
                    .text(option.text);
            },
            templateSelection: function (option) {
                var color = $(option.element).data("background-color");
                var text = $(option.element).data("text-color");
                return $('<span class="option-color"></span>')
                    .css("background-color", color)
                    .css("color", text)
                    .text(option.text);
            },
        });
    })
    .on("change", "#orders_status_type", function () {
        var data = $(this).find("option:selected").length ?
            $(this).find("option:selected").data("options") :
            {};
        $(".color-type-detail tbody").html(bindHtmlColor(data));
    })
    .on("click", ".btn-add-color-type", function () {
        var maxIndex = $(".color-type-detail tbody tr:last-child").attr(
            "data-index"
        ) ?
            $(".color-type-detail tbody tr:last-child").attr("data-index") :
            -1;
        $(".color-type-detail tbody").append(
            bindHtmlItemColor(parseInt(maxIndex) + 1)
        );
    })
    .on("click", ".btn-remove-setting-item", function () {
        $(this).closest("tr").remove();
        waitingDialog.hide();
    })
    .on("submit", "#frm-display-type", function (e) {
        e.preventDefault();
        var type = $(this).data("type"),
            column = $(this).data("column"),
            name = $(this).data("name"),
            data = $("#frm-display-type").serialize();
        switch (type) {
            case "color":
                HandelSubmitColor(column, data, name);
                break;
            case "field_by_id":
                HandelSubmitFieldById(column, data, name);
                break;
        }
        $("#display-type").modal("hide");
    })
    .on("click", ".btn-add-orders-type", function () {
        $('[name="type"]').attr("name", "");
        if ($(".box-select-color").is(":hidden")) {
            $(".color-type-detail tbody").find("tr[data-new=1]").remove();
            $(".box-select-color").show();
            $(".input-type").hide();
            $(".color-type-detail tbody tr").show();
            $(".select-type").attr("name", "type");
        } else {
            $(".box-select-color").hide();
            $(".input-type").show();
            $(".color-type-detail tbody tr").hide();
            $(".input-type").attr("name", "type");
            $(".color-type-detail tbody").append(bindHtmlItemColor(1));
        }
    });
/* DISPLAY FIELDS BY ID */
function bindHtmlSelect(data, name, selected = "", multiple = false) {
    var html = `<select class="form-control select2" name="${name}" ${multiple ? "multiple" : ""
        }>`;
    html += `<option value="">Choose option</option>`;
    for (const [key, value] of Object.entries(data)) {
        html += `<option value="${key}" ${key == selected ? `selected` : ``
            }>${value}</option>`;
    }
    html += `</select>`;
    return html;
}

function getFieldByTable() {
    var table = $(".select-table").val();
    if (table) {
        waitingDialog.show("Please wait...");
        $.ajax({
            url: site_url +"modules/get_field_by_table/" +table.replace(/^table_/, ""),
            type: "POST",
            dataType: "json",
            success: function (result) {
                if (result.success) {
                    var selected = $(".box-select-field").data("field");
                    $(".box-select-field").html(
                        bindHtmlSelect(result.data, "field", selected)
                    );
                    bindSelect2("#display-type");
                } else {
                    showNoti("An error occurred", "Notification", "Err");
                }
                waitingDialog.hide();
            },
        });
    }
}

function del_restore(table, id, mode, name, show_mes) {
    if (show_mes == null) {
        show_mes = 1;
    }
    if (show_mes == 1) {
        // showProcess();
    }
    $.ajax({
        url: site_url + "ajax/del_restore_item",
        type: "POST",
        cache: false,
        data: {
            table: table,
            id: id,
            mode: mode,
            name: name,
        },
        success: function (string) {
            $(".confirm-modal-sm").modal("hide");
            if (show_mes == 1) {
                if (string == 2) {
                    showNoti(
                        type + ": " + name + " (Có chứa sản phẩm)",
                        "Hệ thống không thể xóa",
                        "Err"
                    );
                    return false;
                } else if (string == 3) {
                    showNoti(
                        type + ": " + name + " (Có chứa cấp con)",
                        "Hệ thống không thể xóa",
                        "Err"
                    );
                    return false;
                } else if (string == 4) {
                    showNoti(
                        type + ": " + name + " (Có chứa đơn vị con)",
                        "Hệ thống không thể xóa",
                        "Err"
                    );
                    return false;
                } else if (string == 5 || string == 6) {
                    showNoti(
                        type + ": " + name + " đang được sử dụng",
                        "Hệ thống không thể xóa",
                        "Err"
                    );
                    return false;
                } else {
                    showNoti(
                        type + ": " + name,
                        "Đã " +
                        (mode == "del" ? "xóa" : "khôi phục") +
                        " thành công",
                        "Ok"
                    );
                }
            }
            if (string == 1) {
                if (
                    $('.delRestoreLink[data-id="' + id + '"] .no-remove')
                        .length == 0
                ) {
                    var i = 0;
                    if ($(".tab-content").length) {
                        $(".tab-pane.active")
                            .find("tr#" + id + " + tr.accordian-body")
                            .remove();
                        $(".tab-pane.active")
                            .find("tr#" + id)
                            .remove();
                        if ($("tr").hasClass("rowspan-" + id)) {
                            $(".tab-pane.active")
                                .find("tr.rowspan-" + id)
                                .remove();
                        }
                        for (i = 0; i < highlight; i++) {
                            $(".tab-pane.active .stt:eq(" + i + ")").html(
                                i + 1 + rowstart
                            );
                        }
                        if ($(".tab-pane.active .highlight").length == 0) {
                            show_empty_data();
                        }
                    } else {
                        $("tr#" + id + " + tr.accordian-body").remove();
                        $("tr#" + id).remove();
                        if ($("tr").hasClass("rowspan-" + id)) {
                            $("tr.rowspan-" + id).remove();
                        }
                        for (i = 0; i < highlight; i++) {
                            $(".stt:eq(" + i + ")").html(i + 1 + rowstart);
                        }
                        if ($(".highlight").length == 0) {
                            show_empty_data();
                        }
                    }
                    if (
                        $.inArray(table, [
                            "hardware_design_report",
                            "customer_received_date",
                        ])
                    ) {
                        if (table == "po_cpo") {
                            window.location.replace("po_cpo");
                        } else if (table == "po_cpo_close") {
                            window.location.replace("po_cpo_close");
                        } else {
                            window.location.reload();
                        }
                    }
                } else {
                    if (mode == "del") {
                        $('.delRestoreLink[data-id="' + id + '"] .glyphicons')
                            .removeClass("bin")
                            .addClass("refresh");
                    } else {
                        $('.delRestoreLink[data-id="' + id + '"] .glyphicons')
                            .removeClass("refresh")
                            .addClass("bin");
                    }
                }
            }
        },
    });
}

function remove(table, id, name, show_mes) {
    if (show_mes == null) {
        show_mes = 1;
    }
    if (show_mes == 1) {
        // showProcess();
    }
    $.ajax({
        url: site_url + "ajax/del_restore_item",
        type: "POST",
        cache: false,
        data: {
            table: table,
            id: id,
            mode: "remove",
            name: name,
        },
        success: function (string) {
            $(".confirm-modal-sm").modal("hide");
            if (string == "0") {
                if (show_mes == 1) {
                    showNoti(
                        type + ": " + name,
                        "Không thể xóa vĩnh viễn",
                        "Err"
                    );
                }
            } else if (string == "3") {
                if (show_mes == 1) {
                    showNoti(
                        type + ": " + name + " (Có chứa cấp con)",
                        "Không thể xóa vĩnh viễn",
                        "Err"
                    );
                }
            } else if (string == "2") {
                if (show_mes == 1) {
                    showNoti(
                        type + ": " + name + " (Có chứa sản phẩm)",
                        "Không thể xóa vĩnh viễn",
                        "Err"
                    );
                }
            } else {
                if (show_mes == 1) {
                    showNoti(
                        type + ": " + name,
                        "Xóa vĩnh viễn thành công",
                        "Ok"
                    );
                    $(".checkAll").prop("checked", false);
                }
                var rowstart = parseInt($("#rowstart").val());
                var highlight = $(".highlight").length;
                var i = 0;
                if ($(".tab-content").length) {
                    $(".tab-pane.active")
                        .find("tr#" + id + " + tr.accordian-body")
                        .remove();
                    $(".tab-pane.active")
                        .find("tr#" + id)
                        .remove();
                    highlight = $(".tab-pane.active .highlight").length;
                    for (i = 0; i < highlight; i++) {
                        $(".tab-pane.active .stt:eq(" + i + ")").html(
                            i + 1 + rowstart
                        );
                    }
                    if ($(".tab-pane.active .highlight").length == 0) {
                        show_empty_data();
                    }
                } else {
                    if ($('.dd-item[data-id="' + id + '"]').length) {
                        $('.dd-item[data-id="' + id + '"]').remove();
                    } else {
                        $("tr#" + id + " + tr.accordian-body").remove();
                        $("tr#" + id).remove();
                        for (i = 0; i < highlight; i++) {
                            $(".stt:eq(" + i + ")").html(i + 1 + rowstart);
                        }
                        if (
                            $(".highlight").length == 0 &&
                            $(".dd-item").length == 0
                        ) {
                            show_empty_data();
                        }
                    }
                }
                if (
                    $.inArray(table, [
                        "hardware_design_report",
                        "customer_received_date",
                    ])
                ) {
                    if (table == "po_cpo") {
                        window.location.replace("po_cpo");
                    } else if (table == "po_cpo_close") {
                        window.location.replace("po_cpo_close");
                    } else {
                        window.location.reload();
                    }
                }
            }
        },
    });
}
$(document)
    .on("change", ".select-table", function () {
        getFieldByTable();
    })
    .on("hidden.bs.modal", function () {
        if ($(".modal:visible").length) {
            $("body").addClass("modal-open");
        }
    })
    .on("change", "#limit_perpage", function () {
        var limit = $(this).val(),
            module = $("#act").val();
        $.cookie("limit_perpage", limit, {
            path: "/",
        });
        location.replace(module);
    })
    .on("change", ".checkAll", function () {
        var ids = "";
        if ($(this).is(":checked")) {
            $(".cb-element:not(:checked)").each(function () {
                $(this).prop("checked", true);
                $(".highlightNoClick").addClass("selected");
                var id = $(this).val();
                ids = ids + "," + id;
                $("#check_select").val(1);
            });
        } else {
            $(".cb-element").each(function () {
                $(this).prop("checked", false);
                $(".highlightNoClick").removeClass("selected");
                var id = $(this).val();
                ids = ids.replace("," + id, "");
                $("#check_select").val("");
            });
        }
        $.cookie("ids", ids);
    });
/* Categories */
$(document).ready(function () {
    if ($(".cat_treeview").length) {
        $(".cat_treeview").treeview();
    }
})
    .on("click", ".change-status", function () {
        var ele = $(this);
        title = "activated";
        if ($(this).hasClass("check")) title = "deactivate";
        $.alerts.confirm(
            "Do you want to " + title + " ?",
            "Confirm,",
            function (res) {
                if (res == true) {
                    var table =
                        ele.data("table") ?? $("#moduleInfo").data("table"),
                        field = ele.data("field"),
                        id = ele.data("id"),
                        only = ele.hasClass("only") ? 1 : 0,
                        value = ele.hasClass("unchecked") ? 1 : 0,
                        arr = [];
                    arr.push(id);
                    if (!only) {
                        ele.closest(".dd-item")
                            .find(".change-status")
                            .each(function () {
                                var dataId = $(this).data("id");
                                if (!arr.includes(dataId))
                                    arr.push($(this).data("id"));
                            });
                    }
                    handleToDoList(arr ?? id, table, field, value, only);
                }
            }
        );
    })
    .on("click", ".delete-restore", function () {
        var ele = $(this),
            value = $(this).find(".icon").hasClass("bin") ? 1 : 0;
        $.alerts.confirm(
            "Do you want to " +
            (value == 1 ? "deleted" : "restore") +
            " item ?",
            "Confirm,",
            function (res) {
                if (res == true) {
                    var table =
                        ele.data("table") ?? $("#moduleInfo").data("table"),
                        id = ele.data("id"),
                        arr = [];
                    arr.push(id);
                    ele.closest(".dd-item")
                        .find(".delete-restore")
                        .each(function () {
                            var dataId = $(this).data("id");
                            if (!arr.includes(dataId))
                                arr.push($(this).data("id"));
                        });
                    handleToDoList(arr ?? id, table, "deleted", value);
                    if (ele.hasClass("reload")) window.location.reload();
                }
            }
        );
    })
    .on("click", ".removeLink", function () {
        var ele = $(this),
            id = ele.data("id"),
            table = ele.data("table"),
            type = $("#moduleInfo").data("type");

        $.alerts.confirm(
            "Bạn có chắc sẽ xóa vĩnh viễn " +
            (type ? "?<br />" + type + " " : "mục này?<br />") +
            "<b>" +
            name +
            "</b><br /><i>(Sẽ không khôi phục được!)</i>",
            "Xác nhận xóa",
            function (r) {
                if (r == true) {
                    handleToDoList(id, table, "remove", 0);
                    // if(ele.closest('.dd-item').length) ele.closest('.dd-item').remove();
                    // if(ele.closest('tr').length) ele.closest('tr').remove();
                    location.reload();
                }
            }
        );
    })
    .on("hide.bs.modal", function () {
        $(".modal-backdrop").remove();
    });
async function handleToDoList(id, table, field, value, only = 0) {
    await $.ajax({
        url: site_url + "ajax/change_value",
        type: "POST",
        cache: false,
        data: {
            id: id,
            table: table,
            field: field,
            value: value,
            only: only,
        },
        dataType: "json",
        success: function (result) {
            if (result.success && result.data.length) {
                result.data.forEach((id) => {
                    if (field == "deleted") {
                        if (value == 1) {
                            $('.delete-restore[data-id="' + id + '"] .icon')
                                .removeClass("bin")
                                .addClass("refresh");
                        } else {
                            $('.delete-restore[data-id="' + id + '"] .icon')
                                .removeClass("refresh")
                                .addClass("bin");
                        }
                    } else {
                        if (value == 1) {
                            $(
                                '.change-status[data-id="' +
                                id +
                                '"][data-field="' +
                                field +
                                '"]'
                            )
                                .removeClass("unchecked")
                                .addClass("check");
                        } else {
                            $(
                                '.change-status[data-id="' +
                                id +
                                '"][data-field="' +
                                field +
                                '"]'
                            )
                                .removeClass("check")
                                .addClass("unchecked");
                        }
                    }
                });
            }
        },
    });
}

$(document).ready(function () {
    $(document)
        .on("mouseover", ".link_module", function (e) {
            if (e.ctrlKey) {
                $(this).addClass("ctrl_pressed");
            } else {
                $(this).removeClass("ctrl_pressed");
            }
        })
        .on("click  ", "#lang-code", function (e) {
            e.preventDefault();
            var id = $(this).attr("data-id"),
                code = $(this).attr("data-code"),
                meta = $(this).attr("data-meta");

            $.ajax({
                url: site_url + $("#act").val() + "/update_caterogies",
                type: "POST",
                cache: false,
                data: {
                    id: id,
                    language_code: code,
                    language_meta: meta,
                },
                success: function (html) {
                    waitingDialog.hide();
                    $("#myModal .modal-body").html(html);
                    $("#submitBtn").bind("click", function () {
                        $("#updateFrm").submit();
                    });
                    $("#myModal").modal("show");
                    // $('.updateFrm').on('submit', checkUpdateFrm);
                },
            });
        });
});
