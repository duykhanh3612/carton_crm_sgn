class Request_pickup {
  constructor(el) {
    this.body = $("body");
    this.id = this.body.find("#id").val();
    this.root = $(el);
  }
  afterLoaded() {
    this.clockRemovePo();
    Request_pickup.removeLoading();
  }
  addEventListener() {
    var _this = this;
    $(".group-process")
      .on("click", "#removeRowPart", function () {
        _this.addRemoveListItems();
      })
      .on("click", ".btn-info.waves-effect", function () {
        var mt = new MainTable();
        mt.insertPart(this);
      });

    this.body
      .on(
        "focus",
        "input[data-type=currency],input[data-type=currency_unit],input[data-type=kgs]",
        function () {
          _this.unformatCurrency(this);
        }
      )
      .on("blur", "input[data-type=currency]", function () {
        _this.formatCurrency(this);
      })
      .on("blur", "input[data-type=currency_unit]", function () {
        _this.formatCurrency(this, true);
      })
      .on("blur", "input[data-type=kgs]", function () {
        _this.formatWeight(this);
      })
      .on("click", "#submitBtnEdit", function () {
        $("a[href=#info-request].collapsed").click();
        _this.scrollTopSmooth($("#attribution"));
        // alert edit
        showNoti(
          "Please press the Execute cost button before pressing the UPDATE button",
          "Warning edit data",
          "War"
        );
      })
      .on("click", ".part-show-hide", function () {
        _this.partDisplayOptions();
      })
      .on("submit", "#colsModal form.part-main-form", function () {
        _this.submitPartDisplayOptions();
      })
      .on("click","#myTab li",function(){
        _this.tabIndex(this);
      });

    // // render currency
    // this.body.find("input.currency").each(function(){
    //     _this.formatCurrency(this)
    // })
    // this.body.find("input.currency_unit").each(function(){
    //     _this.formatCurrency(this,true)
    // })
  }

  static async removeLoading() {
    $("#loading-animated").removeClass("yt-loader");
  }
  static addLoading() {
    $("#loading-animated").addClass("yt-loader");
  }
}
Request_pickup.prototype.tabIndex = function(el){
  var id = $(el).index();
  $.cookie("rp-tab",id);
}
Request_pickup.prototype.createDragTasks = function (name) {
  $("#" + name).tableDnD();

  // name = name + '-body';
  // var el = document.getElementById(name);
  // Sortable.create(el, {
  //     animation: 150,
  //     ghostClass: 'blue-background-class'
  // });
};
Request_pickup.prototype.submitPartDisplayOptions = async function () {
  var data = $("#colsModal form.part-main-form").serialize();
  var res = await this.send(data, "update_cols");
  if (res) {
    window.location = window.location;
  }
};
Request_pickup.prototype.partDisplayOptions = async function () {
  var module = $("#act").val();
  var html = await this.send({ module }, "part_options", { html: true });
  $("#colsModal .modal-content").html(html);
  const multi_tab = ["po_cpo", "po_cpo_close"];
  var fo = 42;
  if (multi_tab.includes(module)) {
    fo = 65;
  }
  if ($("#mainTable-module-col").length) {
    this.createDragTasks("mainTable-module-col");
    $("#mainTable-module-col").stickyTableHeaders({
      fixedOffset: fo,
      scrollableArea: ".modal-body",
    });
  }
  if ($("#mainTable-module-col2").length) {
    this.createDragTasks("mainTable-module-col2");
    $("#mainTable-module-col2").stickyTableHeaders({
      fixedOffset: fo,
      scrollableArea: ".modal-body",
    });
  }

  $("#colsModal").modal("show");
};
Request_pickup.prototype.unformatCurrency = function (el) {
  var value = $(el).val();
  value = this.unformatCurrencyValue(value);

  $(el).val(value);
  return value;
};

Request_pickup.prototype.unformatCurrencyValue = function (value) {
  value = value ? accounting.unformat(value) : 0;
  // value = value.replace(/[0-9].-/g,'')
  return value;
};
Request_pickup.prototype.formatWeight = function (
  el,
  symbol = "kgs",
  normal = true
) {
  var value = $(el).val();
  value = this.formatWeightValue(value, (symbol = "kgs"), (normal = true));

  $(el).val(value);

  return value;
};
Request_pickup.prototype.formatWeightValue = function (
  value,
  symbol = "kgs",
  normal = true
) {
  var isInt = round(value) == value;
  var numDigits = isInt ? 0 : 2;
  var pattern = normal ? "%v%s" : "%s%v";

  var options = {
    symbol: symbol,
    decimal: ".",
    thousand: ",",
    precision: numDigits,
    format: pattern,
  };
  return value || value === 0 ? accounting.formatMoney(value, options) : 0;
};
Request_pickup.prototype.formatCurrency = function (
  el,
  isUnit = false,
  currency = "USD"
) {
  var value = $(el).val();
  value = this.formatCurrencyValue(value, isUnit, currency);

  $(el).val(value);

  return value;
};
Request_pickup.prototype.formatCurrencyValue = function (
  value,
  isUnit = false,
  currency = "USD"
) {
  var isInt = round(value) == value;
  var numDigits = isInt ? 0 : isUnit ? 4 : 2;
  var symbol =
    currency == "USD"
      ? "$"
      : currency == "VND"
      ? "đ"
      : currency == "EURO"
      ? "€"
      : "¥";

  if (currency == "USD" && isUnit == false) numDigits = 2;

  var pattern = currency == "VND" ? "%v%s" : "%s%v";
  var options = {
    symbol: symbol,
    decimal: ".",
    thousand: ",",
    precision: numDigits,
    format: pattern,
  };
  return value || value === 0 ? accounting.formatMoney(value, options) : 0;

  // toFixed
  // http://openexchangerates.github.io/accounting.js/#documentation
};

Request_pickup.prototype.scrollTopSmooth = function (el) {
  // off/on for test

  var top = 0;
  try {
    $(el).focus();
    var pos = $(el).offset();
    var tag = $(el).attr("tagName");
    if (tag == "INPUT") $(el).focus();
    top = pos.top - 150;
  } catch (error) {}

  $("html, body").animate({ scrollTop: top }, 1000);
};

Request_pickup.prototype.removePoDuplicate = function (po) {
  var count_po = 0;
  $("#po-information .PONo").each(function () {
    if ($(this).val() == po) count_po++;
  });
  var po_insert = $("#po-information .PONo").last();
  if (po_insert.val() == po && count_po > 1)
    po_insert.closest(".fg-po").remove();
};

Request_pickup.prototype.clockRemovePo = function () {
  if (this.id) {
    $("#mainTable-request_pickup").find(".fg-po select").addClass("disabled");
    $("#mainTable-request_pickup").find(".fg-po input").addClass("disabled");
    // $("#mainTable-request_pickup").find(".btn-remove-po").addClass("disabled");
    $("#mainTable-request_pickup")
      .find(".fg-po")
      .last()
      .find(".btn-remove-po")
      .removeClass("disabled");
  }
};
Request_pickup.prototype.addChosen = function (el = null) {
  var parent = el != null ? $(el).closest(".collapse") : $("form");
  parent.find(".select2").chosen({
    placeholder_text_single: "Select an option",
    no_results_text: "Oops, không tìm thấy!",
  });
  if ($(".chosen-search").length && !$(".chosen-search i").length) {
    $(".chosen-search").append('<i class="glyph-icon icon-search"></i>');
  }
  $(".chosen-single div").html('<i class="glyph-icon icon-caret-down"></i>');
};
Request_pickup.prototype.send = function (data, url, option = {}) {
  // var domain = '/'+window.location.pathname +"request_pickup"
  return new Promise((resolve, reject) => {
    $.ajax({
      url: "request_pickup/" + url,
      type: "POST",
      data: data,
      beforeSend: function () {
        showProcess(1);
        Request_pickup.addLoading();
      },
      complete: function () {
        hideLoading();
        Request_pickup.removeLoading();
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
        Request_pickup.removeLoading();
        reject({});
      },
    });
  });
};
Request_pickup.prototype.addRemoveListItems = function () {
  var rp = this;
  var table = $("#itemList table");
  var checked = table.find('input:checked:not(".cb-all")').closest("tr");
  if (checked.length > 0) {
    $.alerts.confirm(
      "Are you sure you want to delete?",
      "Confirm",
      function (r) {
        if (r) {
          $.ajax(checked.remove())
            .then(() => rp.refreshTableItem())
            .then(() => {
              rp.triggerRefreshValuePo(checked, table);
            });

          table.find(".cb-all").prop("checked", false);
        }
      }
    );
  }
};
Request_pickup.prototype.setStateExecuteBtn = function (mode = "success") {
  if (mode == "success") {
    $("#attribution .btn-execute-cost")
      .removeClass("btn-danger")
      .addClass("btn-success")
      .data("edit", false);
    $("#attribution .btn-execute-cost")
      .find("i")
      .removeClass("icon-chevron-left")
      .addClass("icon-check");
    this.cloneBtnUpdate("update");
  }

  if (mode == "danger") {
    $("#attribution .btn-execute-cost")
      .removeClass("btn-success")
      .addClass("btn-danger")
      .data("edit", true);
    $("#attribution .btn-execute-cost")
      .find("i")
      .removeClass("icon-check")
      .addClass("icon-chevron-left");
    this.cloneBtnUpdate("edit");
  }
};
Request_pickup.prototype.cloneBtnUpdate = function (mode = "edit") {
  $("#submitBtnEdit").remove();
  $("#submitBtn").remove();

  if (mode == "edit") {
    var span = $("<span>").text("UPDATE");
    var i = $("<i>").addClass("glyph-icon icon-check");
    var button = $("<button>")
      .attr("id", "submitBtnEdit")
      .addClass("btn btn-success btn-alt btn-hover waves-effect")
      .append(span)
      .append(i);
    $(".btnFrm").prepend(button);
  }

  if (mode == "update") {
    var span = $("<span>").text("UPDATE");
    var i = $("<i>").addClass("glyph-icon icon-check");
    var button = $("<button>")
      .attr("id", "submitBtn")
      .addClass("btn btn-success btn-alt btn-hover waves-effect")
      .append(span)
      .append(i);
    $(".btnFrm").prepend(button);
  }
};
Request_pickup.prototype.disabledBtnUpdate = function () {
  if ($("#OrderType").val() == 0) {
    // alert edit
    showNoti(
      "Please press the Execute cost button before pressing the UPDATE button",
      "Warning edit data",
      "War"
    );
    // set state execute
    this.setStateExecuteBtn("danger");
  }
};
Request_pickup.prototype.triggerRefreshValuePo = function (itemList, table) {
  var list_po = [];
  itemList.each(function () {
    var po = $(this).data("po");
    // if(!list_po.indexOf(po)){
    list_po.push(po);
    // }
  });

  list_po.forEach(function (item) {
    var row_po = table.find("[data-po=" + item + "]");
    row_po.find("[name*=Bank_Cost]").change();
    row_po.find(".col-quantity [name*=quantity]").trigger("change");
  });
};

Request_pickup.prototype.refreshTableItem = async function () {
  this.disabledBtnUpdate();
  
  var table = $("#itemList table");
  var data = [];
  // get all po on table
  table.find(".footer-group").each(function () {
    data.push($(this).data("po"));
  });
  // check exist row or sub row
  var poRemove = [];
  await data.forEach(function (v) {
    var len = table.find("[data-po=" + v + "].highlightNoClick").length;
    if (len == 0) poRemove.push(v);
  });

  // remove group-footer don't have row
  await poRemove.forEach(function (v) {
    table.find("[data-po=" + v + "]").remove();
  });

  // remove po on maintable
  await poRemove.forEach(function (v) {
    $(".btn-po.btn-remove-po").each(function () {
      var selected = $(this).closest(".fg-po").find("select").val();
      if (selected == v) $(this).closest(".fg-po").remove();
    });
  });

  // set number no
  // set row
  var no = 0;
  table.find(".highlightNoClick[data-po]").each(function () {
    no++;
    $(this).find("td.col-no").text(no);
  });
  no = 0;
  table.find(".highlightNoClick1[data-po]").each(function () {
    no++;
    $(this).find("input.itemKey").val(no);
  });

  //set group
  no = 0;
  table.find(".footer-group[data-po]").each(function () {
    no++;
    $(this)
      .find("td")
      .find(".td-2")
      .eq(0)
      .first()
      .text(no + ".");
  });

  if (no == 0) {
    $("#OrderType").removeClass("disabled");
  }

  // reset po index
  no = 0;
  $("#po-information .label-line").each(function () {
    no++;
    $(this).text(no);
  });
};
class MainTable extends Request_pickup {
  constructor() {
    super("#mainTable-request_pickup");
  }
  static BtnCheckPart(id, did, selectedID) {
    return `<input type="checkbox" name="" class="cb-ele" value="" data-master="${id}" data-detail="${did}" data-selected="${selectedID}" >`;
  }
  addEventListener() {
    var _this = this;
    this.root
      .on("click", ".btn-add-po", function (e) {
        e.preventDefault();
        e.stopPropagation();
        _this.addPo(this);
      })
      .on("click", ".btn-remove-po", function () {
        _this.removePo(this);
      })
      .on("change", "select.PONo", async function () {
        _this.changeSelectPo(this);
      })
      .on("change", "select#VendorID", function () {
        _this.changeSelectVendor(this);
      })
      .on("change", "select#CompanyID", function () {
        _this.changeSelectCompany(this);
      })
      .on("change", "select#StaffNumber", function () {
        _this.changeSelectStaff(this);
      })
      .on("hide.bs.collapse", "#info-request", function () {
        _this.toggleHeader("closed");
      })
      .on("show.bs.collapse", "#info-request", function () {
        _this.toggleHeader("open");
      })
      .on("click", ".btn-insert-part", function () {
        _this.insertPart(this);
      })
      .on("change", "select#ShippingCarrier", function () {
        _this.changeSelectCarry(this);
      })
      .on("change", "select.ContractNo", function () {
        _this.changeSelectSC(this);
      })
      .on("change", "#OrderType", function () {
        _this.changeOrderType(this);
      });
  }
}
MainTable.prototype.changeOrderType = function (el) {
  var status = $(el).find("option:checked").val();
  if (status == 0) {
    $("#po-information .fg-header-po").removeClass("hidden");
    $(".btn-info.waves-effect").addClass("hidden");
  } else {
    $("#po-information .fg-header-po").addClass("hidden");
    $(".btn-info.waves-effect").removeClass("hidden");
  }

  // remove all po draft
  $("#po-information .fg-po").remove();
};
MainTable.prototype.autoSelectInfoShipping = async function (pono) {
  var arraySelector = await this.send({ id: pono }, "getInfoShipping");

  $.each(arraySelector, function (k, v) {
    $(".infor-shipping-term")
      .find("[name=" + k + "]")
      .val(v);
    $(".infor-shipping-term")
      .find("[name=" + k + "]")
      .closest("div")
      .find(".chosen-single span")
      .html(v);
  });
};
MainTable.prototype.validPoSelected = function (data, form_groups) {
  var isNull = { status: false, name: "bị" };
  form_groups.find("input").each(function () {
    var name = $(this).prop("name");
    var val = $(this).val();
    data.forEach((k) => {
      var text = new RegExp(k, "i");
      if (name.match(text) && !isNull.status && !val) {
        isNull = { status: true, name: k };
      }
    });
  });
  if (isNull.status || !data) {
    showNoti(
      "Dữ liệu " + isNull.name + " trống!",
      "Vui lòng kiểm tra lại",
      "Err"
    );
    return false;
  }
  return true;
};
MainTable.prototype.insertPart = async function (el) {
  var form_groups = $(el).closest(".fg-po");
  var selectedID = form_groups.data("selected");
  var value = form_groups.find("select.PONo").val();

  var data = [
    "PODate",
    "ContractNo",
    "ContractDate",
    "CustomerPONo",
    "ImportMethod",
  ];

  var had_po = $("#OrderType").find("option:checked").val();

  if (had_po == 0) {
    if (!this.validPoSelected(data, form_groups)) return false;

    var data = await this.send({ value }, "getListPart");

    if (data.length == 0) {
      showNoti(
        "The Mfpart in CPO and PO don't match, please check this CPO and PO again!",
        "No parts match",
        "Err"
      );
      return false;
    }

    var html = await this.createInsertPartTable(data, selectedID);
    this.openModelInsertPart(html);
    return true;
  }

  // insert null item
  var mlo = new ModalListOld();
  mlo.addPart();
};

MainTable.prototype.addPo = async function (el) {
  var group_insert = $("#po-information").find(".fg-po[data-selected]");
  var key = group_insert.length > 0 ? group_insert.last().data("selected") : 0;

  var html = await this.send({ key }, "importPo", { html: true });

  // insert first row when group empty
  if (group_insert.length > 0) {
    // group_insert.last().find(".btn-remove-po").addClass("disabled");
    group_insert.last().after(html);
  } else {
    $("#po-information").prepend(html);
  }

  await this.addChosen(el);

  await this.addDatePicker(key);
};
MainTable.prototype.addDatePicker = function (key) {
  // add date picker
  $("#po-information [data-selected=" + key + "]")
    .find(".bootstrap-datepicker")
    .datepicker({
      format: "yyyy-mm-dd",
      language: "vi",
      autoclose: true,
      todayHighlight: true,
    });
};
MainTable.prototype.openModelInsertPart = function (html) {
  $("#modal-list-old .modal-body").empty().append(html);
  $("#modal-list-old").modal("show");
};
MainTable.prototype.createInsertPartTable = function (data, selectedID) {
  var header = `<div class="table-responsive">
    <table class="table-modal table table-hover">
        <thead>
        <tr class="nodrop">
            <th nowrap="nowrap"><input type="checkbox" class="cb-all"></th>
            <th nowrap="nowrap">Supplier Part #</th>
            <th nowrap="nowrap">Mfr Part # des </th>
            <th nowrap="nowrap">Manufacturer</th>
            <th nowrap="nowrap">Package / Case</th>
            <th nowrap="nowrap" class="center">SPQ</th>
            <th nowrap="nowrap" class="center">Order Qty</th>
            <th nowrap="nowrap">Delivery date / Comments</th>
            <th nowrap="nowrap">Origin Of Country</th>
        </tr>
        </thead>
        <tbody>`;
  var footer = `</tbody></table></div>`;
  var body = "";
  data.forEach(function (item) {
    body += `<tr>`;
    body +=
      "<td>" +
      MainTable.BtnCheckPart(item["poid"], item["did"], selectedID) +
      "</td>";

    delete item["poid"];
    delete item["did"];

    $.each(item, function (k, v) {
      switch (k) {
        case "MfrPart":
          body += `<td>
                    <span class="mfr-part">${v}</span> 
                    <span class="desc" title="${item["Description"]}">${item["Description"]}</span>
                </td>`;
          delete item["Description"];

          break;
        case "Image":
          body += `<td><img src="${v}" style="max-width: 27px;"></td>`;
          break;
        default:
          body += `<td class="${v}">${v}</td>`;
          break;
      }
    });
    body += `</tr>`;
  });

  return header + body + footer;
};
MainTable.prototype.removePo = function (el) {
  var index = $(el).closest(".fg-po").find(".PONo").val();
  var po = $(el).closest(".fg-po").find(".PONo option:selected").text();
  var mt = this;
  $.alerts.confirm(
    `Are you sure you want to delete PO : <br />ID - ${po} ?<br />`,
    "Confirm",
    async function (r) {
      if (r == true) {
        if (index)
          $("#itemList .mainTable")
            .find("[data-po=" + index + "]")
            .remove();
        await $("#po-information")
          .find(".PONo")
          .each(function () {
            var val = $(this).val();
            if (val == index) $(this).closest(".fg-po").remove();
          });

        $(el).closest(".fg-po").remove();

        mt.refreshTableItem();
      }
    }
  );
};
MainTable.prototype.changeSelectSC = async function (el) {
  var value = $(el).val();
  var form_groups = $(el).closest(".fg-po");
  form_groups.find('input.SCCode[type="hidden"]').val(value);
  var res = await this.send({ id: value }, "getSCDate");

  if (res) form_groups.find("[name*=ContractDate]").val(res.SCDate);

  this.insertPart(el);
};

MainTable.prototype.changeSelectPo = async function (el) {
  var value = $(el).val();

  var form_groups = $(el).closest(".fg-po");

  form_groups.find("input[name*=PO]").each(function () {
    $(this).val("");
  });
  var data = await this.send({ id: value }, "getPoSelected");
  var validData = [];

  // set data
  if (data) {
    $.each(data, function (k, v) {
      form_groups.find("input[name*=" + k + "]").val(v);
      validData.push(k);
    });
  }

  if (!this.validPoSelected(validData, form_groups)) return false;

  //set code po
  var text = $(el).find("option:selected").text();
  text = text.replace(/\d.*\s/, "");

  form_groups.find('input.POCode[type="hidden"]').val(text);

  form_groups.find("select.ContractNo").click();
};
MainTable.prototype.changeSelectVendor = async function (el) {
  var value = $(el).val();
  var form_group = $("#1st-information");
  var data = await this.send({ id: value }, "getVendorSelected");

  $.each(data, function (v, k) {
    form_group.find("input[name*=" + v + "]").val(k);
  });
};
MainTable.prototype.changeSelectCarry = async function (el) {
  var value = $(el).val();
  var form_group = $("#2nd-information");
  var data = await this.send({ id: value }, "changeSelectCarry");

  $.each(data, function (v, k) {
    form_group.find("input[name*=" + v + "]").val(k);
  });
};
MainTable.prototype.changeSelectCompany = async function (el) {
  var value = $(el).val();
  var form_groups = $("#1st-information");
  var data = await this.send({ id: value }, "getCompanyIDSelected");

  $.each(data, function (v, k) {
    form_groups.find("input[name*=" + v + "]").val(k);
  });
};
MainTable.prototype.changeSelectStaff = async function (el) {
  var value = $(el).val();
  var form_groups = $("#1st-information");
  var data = await this.send({ id: value }, "getStaffIDSelected");
  $.each(data, function (v, k) {
    form_groups.find("input[name*=" + v + "]").val(k);
  });
};
MainTable.prototype.toggleHeader = function (option) {
  switch (option) {
    case "open":
      $(".approved_close").css("margin", "0 1.5rem");

      break;

    default:
      $(".approved_close").css("margin", "0rem 0rem");

      break;
  }
};

class ItemList extends Request_pickup {
  constructor(el = null) {
    el = el == null ? "#itemList .mainTable" : el;
    super(el);
  }

  addEventListener() {
    var _this = this;
    this.root
      .on("change", "input[name*=amount],input[name*=Total_Cost]", function () {
        _this.calcCOGS(this);
      })
      .on("change", "input[name*=percent]", function () {
        _this.calculatorPercent(this);
      })
      .on("change", "[name*=GW]", function () {
        _this.setStateExecuteBtn("danger");
      })
      .on("change", "input[type=checkbox].cb-ele", function () {
        _this.checkAll(this);
      })
      .on("change", "input[name*=quantity]", function () {
        _this.calAmount(this);
        _this.setStateExecuteBtn("danger");
      })
      .on("change", "input[name*=price]", function () {
        _this.calAmount(this);
        _this.setStateExecuteBtn("danger");
      })
      .on("click", ".btn-collapse", function () {
        _this.toggleListItem(this);
      })
      .on("click", ".btn-collapse-child", function () {
        _this.toggleRowItem(this);
      });

    // .on("change", ".col-quantity [name*=quantity]", function () {
    //     _this.addQuantityToPO(this)
    // })

    // end addEvenlistenner
  }
}

ItemList.prototype.addBankDeclareShippingTotalCostToPO = function (el) {
  var po = $(el).closest("tr").data("po");
  var sum = 0;
  var _this = this;
  this.root.find(".buying-amount span").each(function () {
    var value = $(this).text();
    sum += _this.unformatCurrencyValue(value);
  });

  var amount = $(el).text();
  var rate = this.unformatCurrencyValue(amount) / sum;

  // shipping
  var shipping_cost = $("#attribution")
    .find("tr[data-id=1] [name*=Total]")
    .val();
  shipping_cost = this.unformatCurrencyValue(shipping_cost);
  var shipping_po = shipping_cost * rate;
  shipping_po = this.formatCurrencyValue(shipping_po);
  $("#po-information")
    .find("[data-po=" + po + "]")
    .find(".po_shipping")
    .val(shipping_po);

  // bank
  var bank_cost = $("#attribution").find("tr[data-id=2] [name*=Total]").val();
  bank_cost = this.unformatCurrencyValue(bank_cost);
  var bank_po = bank_cost * rate;
  bank_po = this.formatCurrencyValue(bank_po);
  $("#po-information")
    .find("[data-po=" + po + "]")
    .find(".po_bank")
    .val(bank_po);

  // declare
  var declare_cost = $("#attribution")
    .find("tr[data-id=3] [name*=Total]")
    .val();
  declare_cost = this.unformatCurrencyValue(declare_cost);
  var declare_po = declare_cost * rate;
  declare_po = this.formatCurrencyValue(declare_po);
  $("#po-information")
    .find("[data-po=" + po + "]")
    .find(".po_declare")
    .val(declare_po);

  // // cost
  // var total_cost = $("#attribution #cost_total").text();
  // total_cost = this.unformatCurrencyValue(total_cost);
  // var cost = this.unformatCurrencyValue(amount) / sum * total_cost;
  // cost = this.formatCurrencyValue(cost);
  // $("#po-information").find("[data-po=" + po + "]").find(".po_total_cost").val(cost);
};
ItemList.prototype.addQuantityToPO = function (el) {
  var po = $(el).closest("tr").data("po");
  var sum = 0;
  var _this = this;
  this.root.find("[data-po=" + po + "]").each(function () {
    var value = $(this).find(".col-quantity [name*=quantity]").val();
    sum += _this.unformatCurrencyValue(value);
  });
  sum = this.formatCurrencyValue(sum);

  $("#po-information")
    .find("[data-po=" + po + "]")
    .find(".po_total_quantity")
    .val(sum);
};

ItemList.prototype.addPercentToPO = function (el) {
  var po = $(el).closest("tr").data("po");
  var value = $(el).text();

  $("#po-information")
    .find("[data-po=" + po + "]")
    .find(".po_percent")
    .val(value);
};

ItemList.prototype.collapseState = function () {
  var isAllPlus = this.root.find("tbody").find(".fa-minus-circle").length == 0;
  var isAllMinus = this.root.find("tbody").find(".fa-plus-circle").length == 0;

  return { plus: isAllPlus, minus: isAllMinus };
};
ItemList.prototype.toggleListItem = function (el) {
  var isPlus = $(el).hasClass("fa-plus-circle");

  if (isPlus) {
    this.root.find("tbody").find(".highlightNoClick1").show();
    $(el).closest("th").html('<i class="fa fa-minus-circle btn-collapse"></i>');
    this.root
      .find("tbody")
      .find(".highlightNoClick")
      .each(function () {
        var btn = $(this).find(".fa.fa-plus-circle");
        btn
          .closest("td")
          .html('<i class="fa fa-minus-circle btn-collapse-child"></i>');
      });
    return true;
  }

  this.root.find("tbody").find(".highlightNoClick1").hide();
  $(el).closest("th").html('<i class="fa fa-plus-circle btn-collapse"></i>');
  this.root
    .find("tbody")
    .find(".highlightNoClick")
    .each(function () {
      var btn = $(this).find(".fa.fa-minus-circle");
      btn
        .closest("td")
        .html('<i class="fa fa-plus-circle btn-collapse-child"></i>');
    });
  return false;
};
ItemList.prototype.toggleRowItem = function (el) {
  var isPlus = $(el).hasClass("fa-plus-circle");
  var row = $(el).closest("tr").next();
  if (isPlus) {
    row.show();
    $(el)
      .closest("td")
      .html('<i class="fa fa-minus-circle btn-collapse-child"></i>');
    var state = this.collapseState();
    // change icon when all rows item plus
    if (state.minus)
      this.root
        .find("thead")
        .find("th .fa-plus-circle")
        .closest("th")
        .html('<i class="fa fa-minus-circle btn-collapse"></i>');
    return true;
  }

  row.hide();
  $(el)
    .closest("td")
    .html('<i class="fa fa-plus-circle btn-collapse-child"></i>');
  var state = this.collapseState();

  // change icon when all rows item minus
  if (state.plus)
    this.root
      .find("thead")
      .find("th .fa-minus-circle")
      .closest("th")
      .html('<i class="fa fa-plus-circle btn-collapse"></i>');
  return false;
};
ItemList.prototype.calAmount = function (el) {
  var po = $(el).closest("[data-po][data-key]").data("po");
  var key = $(el).closest("[data-po][data-key]").data("key");
  row = this.root.find("[data-po=" + po + "][data-key=" + key + "]");

  var quantity = row.find("input[name*=quantity]").val();
  quantity = this.unformatCurrencyValue(quantity);
  var price = row.find("input[name*=price]").val();
  price = this.unformatCurrencyValue(price);

  var amount = quantity * price;
  amount = this.formatCurrencyValue(amount);

  row.find("input[name*=amount]").val(amount);
  row.find("input[name*=amount]").trigger("change");
};
ItemList.prototype.checkAll = function (el) {
  // check sub row
  var po = $(el).closest("tr").prop("id");
  var status = $(el).prop("checked");
  $("#itemList .mainTable")
    .find("#" + po + "sub")
    .find("input[type=checkbox].cb-ele")
    .prop("checked", status);
};
ItemList.prototype.calcPercent = function (selector, component, target) {
  var selectName = $(selector).prop("name");
  var id = selectName.replace(/([A-Z]|[a-z]|\[|\]|_){1,}/g, "");
  var mainRow = $("#PO" + id);
  var subRow = $("#PO" + id + "sub");
  var divindend = mainRow.find("[name*=" + component[0] + "]").val();
  divindend = this.unformatCurrencyValue(divindend);
  var divisor = subRow.find("[name*=" + component[1] + "]").val();
  divisor = this.unformatCurrencyValue(divisor);
  divisor = divisor || divisor == 0 ? parseFloat(divisor) : 1;
  var per = (divindend / divisor) * 100;

  if (per && divisor != 1) {
    per = round(per) == per ? per : per.toFixed(2);
    subRow.find("[name*=" + target + "]").val(per + "%");
  }

  if (divindend == 0) subRow.find("[name*=" + target + "]").val("");
};
ItemList.prototype.calculatorPercent = async function (el) {
  // row percent change
  component = ["Total_Cost", "COGS"];
  target = ["percent"];
  await this.calcPercent(el, component, target);

  // group percent change
  component = ["col-total_cost"];
  var total_cost = await this.sumTotalOnGroup(el, component);
  component = ["COGS"];
  var COGS = await this.sumTotalOnGroup(el, component);
  var po = $(el).closest("tr").data("po");
  COGS["COGS"] = COGS["COGS"] || COGS["COGS"] == 0 ? COGS["COGS"] : 1;

  var per = (total_cost["col-total_cost"] / COGS["COGS"]) * 100;
  per = per ? per.toFixed(2) : 0;

  $("[data-po=" + po + "].footer-group")
    .find(".percent span")
    .text(per);
};

ItemList.prototype.sumTotalOnRow = function (selector, component, target) {
  var il = this;
  var sum = 0;
  var row = $(selector).closest("tr");
  component.forEach((v) => {
    var value = row.find(v).val();

    value = il.unformatCurrencyValue(value);

    sum += value;
  });
  sum = il.formatCurrencyValue(sum);
  row.find(target).val(sum);
};
ItemList.prototype.sumTotalOnGroup = function (selector, component) {
  var po = $(selector).closest("tr").data("po");
  var il = this;
  var row = $("[data-po=" + po + "][data-key]");
  var sumReturn = {};

  // set sum for each component
  component.forEach(function (item) {
    var sum = 0;
    row.each(function () {
      var v = $(this)
        .find("." + item)
        .val();
      v = il.unformatCurrencyValue(v);
      sum += v;
    });
    sum = sum ? sum : 0;
    sum = round(sum) == sum ? sum : sum.toFixed(2);
    sumReturn[item] = sum;
    sum = il.formatCurrencyValue(sum);
    $("[data-po=" + po + "].footer-group")
      .find("." + item)
      .find("span")
      .text(sum);
  });

  return sumReturn;
};
ItemList.prototype.triggerChangeCalcPer = function (el) {
  // trigger calc percent
  var po = $(el).closest("tr").data("po");
  $("[data-po=" + po + "].highlightNoClick1")
    .find(".percent")
    .change();
};

ItemList.prototype.calcTotalCost = async function (el) {
  var component = [
    "input.col-shipping_cost",
    "input.col-back_cost",
    "input.col-declare_cost",
  ];
  var target = "input.col-total_cost";
  await this.sumTotalOnRow(el, component, target);

  await $(el).closest("tr").find("input.col-total_cost").trigger("change");

  component = ["col-total_cost"];
  await this.sumTotalOnGroup(el, component);

  this.triggerChangeCalcPer(el);
};
ItemList.prototype.subCalcCOGS = function (el) {
  var po = $(el).closest("[data-po][data-key]").data("po");
  var key = $(el).closest("[data-po][data-key]").data("key");
  row = this.root.find("[data-po=" + po + "][data-key=" + key + "]");

  var totalCost = row.find("input[name*=Total_Cost]").val();
  totalCost = this.unformatCurrencyValue(totalCost);
  var amount = row.find("input[name*=amount]").val();
  amount = this.unformatCurrencyValue(amount);
  var COGS = amount + totalCost;
  COGS = this.formatCurrencyValue(COGS);

  row.find("input[name*=COGS]").val(COGS);
};
ItemList.prototype.calcCOGS = async function (el) {
  await this.subCalcCOGS(el);

  component = ["amount", "COGS"];
  res = await this.sumTotalOnGroup(el, component);

  await this.triggerChangeCalcPer(el);
};

class AttributeFooter extends ItemList {
  constructor() {
    super("#attribution");
  }
  addEventListener() {
    var af = this;

    this.root
      .on(
        "focusout",
        "input.attr-Pickup,input.attr-Local,input.attr-trans,input.attr-Unit,input.attr-Weight.shipping",
        function () {
          var component = [
            "input.attr-Amount",
            "input.attr-Pickup",
            "input.attr-Local",
            "input.attr-trans",
          ];
          var target = "input.attr-Total";
          af.sumTotalRow(this, component, target);
        }
      )
      .on(
        "change",
        "input.attr-Weight.shipping,input.attr-Unit",
        async function () {
          var component = ["input.attr-Weight.shipping", "input.attr-Unit"];
          var target = "input.attr-Amount";
          await af.multiOnRow(this, component, target);
        }
      )
      .on(
        "change",
        "input.attr-Weight.bank,input.attr-bank,input.attr-declare",
        async function () {
          var component = [
            "input.attr-Weight.bank",
            "input.attr-bank",
            "input.attr-declare",
          ];
          var target = "input.attr-Total";
          af.sumTotalRow(this, component, target);
        }
      )
      .on(
        "change",
        "input.attr-Custom[name*=Custom],input.attr-handling,input.attr-transport",
        function () {
          // $(this).closest("tr").find("input.attr-Total").val($(this).val());
          var component = [
            "input.attr-Custom[name*=Custom]",
            "input.attr-handling",
            "input.attr-transport",
          ];
          var target = "input.attr-Total";
          af.sumTotalRow(this, component, target);
        }
      )
      .on("click", ".btn-execute-cost", function () {
        $(".notiLoading").html(
          'Đang xử lý... <span id="processCount">1</span> tác vụ'
        );
        $(".notiLoading").css({
          width: 155,
          display: "block",
        });
        af.executeCost();
      })
      .on("change", "input", function () {
        showNoti(
          "Please press the Execute cost button before pressing the UPDATE button",
          "Warning edit data",
          "War"
        );
        // set state execute
        af.setStateExecuteBtn("danger");
      });
  }
}
AttributeFooter.prototype.addShippingCostToPart = function () {
  // shipping cost total / total GW * GW part
  var rows = $("#itemList tr[data-po].highlightNoClick");
  var _this = this;
  var attr_cost = $("#attribution").find("[name*=1].attr-Total").val();
  attr_cost = this.unformatCurrencyValue(attr_cost);

  var total_sum_GW = 0;
  rows.find("[name*=GW]").each(function () {
    var value = $(this).val();
    total_sum_GW += parseFloat(_this.unformatCurrencyValue(value));
  });

  rows.each(function () {
    var gw = $(this).find("[name*=GW]").val();
    gw = _this.unformatCurrencyValue(gw);
    var shipping_cost = (parseFloat(gw) / total_sum_GW) * attr_cost;
    shipping_cost = _this.formatCurrencyValue(shipping_cost);
    $(this)
      .find("input[name*=Shipping_Cost]")
      .val(shipping_cost)
      .trigger("change");
  });
};
AttributeFooter.prototype.addBankCostToPart = function () {
  // bank total cost / sum amount * amount part
  var sub_rows = $("#itemList tr[data-po].highlightNoClick1");
  var _this = this;
  var attr_cost = $("#attribution").find("[name*=2].attr-Total").val();
  attr_cost = this.unformatCurrencyValue(attr_cost);

  var total_sum_amount = 0;
  sub_rows.find("[name*=amount]").each(function () {
    var value = $(this).val();
    total_sum_amount += parseFloat(_this.unformatCurrencyValue(value));
  });

  var rows = $("#itemList tr[data-po].highlightNoClick");
  rows.each(function () {
    var sum_amount = _this.getCurrentValueSubRow(this, "amount");
    var bank_cost = (attr_cost / total_sum_amount) * parseFloat(sum_amount);
    bank_cost = _this.formatCurrencyValue(bank_cost);
    $(this).find("input[name*=Bank_Cost]").val(bank_cost).trigger("change");
  });
};
AttributeFooter.prototype.addDeclareCostToPart = function () {
  // declare cost total / sum amount * amount part
  var sub_rows = $("#itemList tr[data-po].highlightNoClick1");
  var _this = this;
  var attr_cost = $("#attribution").find("[name*=3].attr-Total").val();
  attr_cost = this.unformatCurrencyValue(attr_cost);

  var total_sum_amount = 0;
  sub_rows.find("[name*=amount]").each(function () {
    var value = $(this).val();
    total_sum_amount += parseFloat(_this.unformatCurrencyValue(value));
  });

  var rows = $("#itemList tr[data-po].highlightNoClick");
  rows.each(function () {
    var sum_amount = _this.getCurrentValueSubRow(this, "amount");
    var declare_cost = (attr_cost / total_sum_amount) * parseFloat(sum_amount);
    declare_cost = _this.formatCurrencyValue(declare_cost);
    $(this)
      .find("input[name*=Declare_Cost]")
      .val(declare_cost)
      .trigger("change");
  });
};
AttributeFooter.prototype.getCurrentValueSubRow = function (el, name) {
  var po = $(el).data("po");
  var value = $("#itemList tr[data-po=" + po + "].highlightNoClick1")
    .find("[name*=" + name + "]")
    .val();
  return this.unformatCurrencyValue(value);
};
AttributeFooter.prototype.calcDataOnProducts = async function () {
  console.time();
  // add attr-bank and attr-declare and attr-shipping cost and total cost on part
  await this.addShippingCostToPart();
  await this.addBankCostToPart();
  await this.addDeclareCostToPart();

  var _this = this;
  // update total cost
  $("#itemList input[name*=Declare_Cost]").each(function () {
    _this.calcTotalCost(this);
  });
  // update total quantity and total shipping and total bank and total declare on footer on part ( summery part )
  this.updateTotalQuantity();
  this.updateTotalShipping();
  this.updateTotalAmount();
  this.updateTotalBank();
  this.updateTotalDeclare();
  this.updateTotalGW();
  this.updateTotalNW();

  console.timeEnd();
};
AttributeFooter.prototype.executeCost2 = async function () {
  var { data, po, total } = await this.executeData();

  this.updateDataOnParts(data);

  this.updateDataOnPoGroup(po);

  this.updateDataToPOInformation(po);
  this.updateDataToTotalPOInformation(total);
};
AttributeFooter.prototype.updateDataToTotalPOInformation = function (data) {
  $("#po-information")
    .find(".footer-po-information")
    .find(".col-po-shipping")
    .html(data["Shipping_Cost"]);
  $("#po-information")
    .find(".footer-po-information")
    .find(".col-po-bank")
    .html(data["Bank_Cost"]);
  $("#po-information")
    .find(".footer-po-information")
    .find(".col-po-declare")
    .html(data["Declare_Cost"]);
  $("#po-information")
    .find(".footer-po-information")
    .find(".col-po-cost")
    .html(data["Total_Cost"]);
  $("#po-information")
    .find(".footer-po-information")
    .find(".col-po-quantity")
    .html(data["quantity"]);
  $("#po-information")
    .find(".footer-po-information")
    .find(".col-po-amount")
    .html(data["amount"]);
  $("#po-information")
    .find(".footer-po-information")
    .find(".col-po-cogs")
    .html(data["COGS"]);
  $("#po-information")
    .find(".footer-po-information")
    .find(".col-po-per")
    .html(data["percent"]);
};
AttributeFooter.prototype.updateDataToPOInformation = function (data) {
  $("#po-information")
    .find(".fg-po")
    .each(function () {
      var po = $(this).data("po");

      $(this).find("[name*=totalamount]").val(data[po]["amount"]);
      $(this).find("[name*=cogs]").val(data[po]["COGS"]);
      $(this).find("[name*=percent]").val(data[po]["percent"]);
      $(this).find("[name*=totalquantity]").val(data[po]["quantity"]);
      $(this).find("[name*=shipping]").val(data[po]["Shipping_Cost"]);
      $(this).find("[name*=bank]").val(data[po]["Bank_Cost"]);
      $(this).find("[name*=declare]").val(data[po]["Declare_Cost"]);
      $(this).find("[name*=totalcost]").val(data[po]["Total_Cost"]);
    });
};
AttributeFooter.prototype.updateDataOnPoGroup = function (data) {
  console.log({ data });
  $("#itemList")
    .find("[data-po].footer-group.bg-primary")
    .each(function () {
      var po = $(this).data("po");

      $(this).find(".amount span").html(data[po]["amount"]);
      $(this).find(".COGS span").html(data[po]["COGS"]);
      $(this).find(".percent span").html(data[po]["percent"]);
      $(this).find(".total-quantity span").html(data[po]["quantity"]);
      $(this).find(".col-total_GW span").html(data[po]["GW"]);
      $(this).find(".col-total_NW span").html(data[po]["NW"]);
      $(this).find(".col-total_shipping span").html(data[po]["Shipping_Cost"]);
      $(this).find(".col-total_bank span").html(data[po]["Bank_Cost"]);
      $(this).find(".col-total_declare span").html(data[po]["Declare_Cost"]);
      $(this).find(".col-total_cost span").html(data[po]["Total_Cost"]);
    });
};
AttributeFooter.prototype.updateDataOnParts = function (data) {
  $("#itemList")
    .find("[data-po][data-key]")
    .each(function () {
      var key = $(this).data("key");
      var po = $(this).data("po");
      $(this).find("[name*=Shipping_Cost]").val(data[po][key]["Shipping_Cost"]);
      $(this).find("[name*=Declare_Cost]").val(data[po][key]["Declare_Cost"]);
      $(this).find("[name*=Bank_Cost]").val(data[po][key]["Bank_Cost"]);
      $(this).find("[name*=Total_Cost]").val(data[po][key]["Total_Cost"]);

      $(this).find("[name*=amount]").val(data[po][key]["amount"]);
      $(this).find("[name*=COGS]").val(data[po][key]["COGS"]);
      $(this).find("[name*=percent]").val(data[po][key]["percent"]);
    });
};
AttributeFooter.prototype.executeData = async function () {
  var data = await this.getDataItemList();

  var attr = await this.getAttributeCost();
  var summary = await this.summaryDataPO(data, false);

  // Promise.all([ data, attr, summary ]);
  console.log({ data, attr, summary });
  data = await this.calcDataOnPart(data, attr, summary);

  // re-calculator when data change in calcDataOnPart function
  summary = this.summaryDataPO(data, true);
  console.log({ summary });
  // format value
  data = this.formatDataItemList(data);
  var po = this.formatDataPo(summary.sum);
  var total = this.formatDataTotal(summary.total);

  return { data, po, total };

  // return { data, po: summary.sum, total: summary.total };
};
AttributeFooter.prototype.formatDataTotal = function (data) {
  data["Bank_Cost"] = this.formatCurrencyValue(data["Bank_Cost"]);
  data["COGS"] = this.formatCurrencyValue(data["COGS"]);
  data["Declare_Cost"] = this.formatCurrencyValue(data["Declare_Cost"]);
  data["GW"] = this.formatWeightValue(data["GW"], "");
  data["NW"] = this.formatWeightValue(data["NW"], "");
  data["SPQ"] = this.formatWeightValue(data["SPQ"], "");
  data["Shipping_Cost"] = this.formatCurrencyValue(data["Shipping_Cost"]);
  data["Total_Cost"] = this.formatCurrencyValue(data["Total_Cost"]);
  data["amount"] = this.formatCurrencyValue(data["amount"]);
  data["percent"] = this.formatWeightValue(data["percent"], "%");
  data["price"] = this.formatCurrencyValue(data["price"]);
  data["quantity"] = this.formatWeightValue(data["quantity"], "");
  return data;
};
AttributeFooter.prototype.formatDataPo = function (data) {
  var _this = this;
  // format value
  for (const po in data) {
    data[po]["COGS"] = _this.formatCurrencyValue(data[po]["COGS"]);
    data[po]["quantity"] = _this.formatWeightValue(data[po]["quantity"], "");
    data[po]["GW"] = _this.formatWeightValue(data[po]["GW"], "");
    data[po]["NW"] = _this.formatWeightValue(data[po]["NW"], "");
    data[po]["SPQ"] = _this.formatWeightValue(data[po]["SPQ"], "");
    data[po]["percent"] = _this.formatWeightValue(data[po]["percent"], "");
    data[po]["Bank_Cost"] = _this.formatCurrencyValue(data[po]["Bank_Cost"]);
    data[po]["Declare_Cost"] = _this.formatCurrencyValue(
      data[po]["Declare_Cost"]
    );
    data[po]["Shipping_Cost"] = _this.formatCurrencyValue(
      data[po]["Shipping_Cost"]
    );
    data[po]["Total_Cost"] = _this.formatCurrencyValue(data[po]["Total_Cost"]);
    data[po]["amount"] = _this.formatCurrencyValue(data[po]["amount"]);
    data[po]["price"] = _this.formatCurrencyValue(data[po]["price"]);
  }

  return data;
};
AttributeFooter.prototype.formatDataItemList = function (data) {
  var _this = this;
  $.each(data, function (po, parts) {
    parts.forEach(function (arr, key) {
      // format value
      data[po][key]["Shipping_Cost"] = _this.formatCurrencyValue(
        arr["Shipping_Cost"]
      );
      data[po][key]["Bank_Cost"] = _this.formatCurrencyValue(arr["Bank_Cost"]);
      data[po][key]["Declare_Cost"] = _this.formatCurrencyValue(
        arr["Declare_Cost"]
      );
      data[po][key]["Total_Cost"] = _this.formatCurrencyValue(
        arr["Total_Cost"]
      );
      data[po][key]["COGS"] = _this.formatCurrencyValue(arr["COGS"]);
      data[po][key]["amount"] = _this.formatCurrencyValue(arr["amount"]);
      data[po][key]["percent"] = _this.formatWeightValue(arr["percent"], "%");
    });
  });
  return data;
};
AttributeFooter.prototype.getAttributeCost = function () {
  var data = {};

  data.shipping = $("#attribution").find("[name*=1].attr-Total").val();
  data.shipping = this.unformatCurrencyValue(data.shipping);
  data.bank = $("#attribution").find("[name*=2].attr-Total").val();
  data.bank = this.unformatCurrencyValue(data.bank);
  data.declare = $("#attribution").find("[name*=3].attr-Total").val();
  data.declare = this.unformatCurrencyValue(data.declare);

  return data;
};
AttributeFooter.prototype.calcDataOnPart = function (data, attr, summary) {
  $.each(data, function (po, parts) {
    parts.forEach(function (parts, key) {
      // shipping
      data[po][key]["Shipping_Cost"] =
        (attr["shipping"] * parts["GW"]) / summary["GW"];
      // bank
      data[po][key]["Bank_Cost"] =
        (attr["bank"] * parts["amount"]) / summary["amount"];
      // declare
      data[po][key]["Declare_Cost"] =
        (attr["declare"] * parts["amount"]) / summary["amount"];

      // total
      data[po][key]["Total_Cost"] =
        (attr["shipping"] * parts["GW"]) / summary["GW"] +
        ((attr["bank"] + attr["declare"]) * parts["amount"]) /
          summary["amount"];
      // COGS
      data[po][key]["COGS"] =
        data[po][key]["Total_Cost"] + data[po][key]["amount"];
      // percent
      data[po][key]["percent"] =
        (data[po][key]["Total_Cost"] / data[po][key]["COGS"]) * 100;
    });
  });

  return data;
};

AttributeFooter.prototype.summaryDataPO = function (data, hadTotal = true) {
  var sum = [];

  if (hadTotal == false) {
    $.each(data, function (po, parts) {
      parts.forEach(function (part, key) {
        $.each(part, function (name, value) {
          // set value new item
          if (!sum[name]) sum[name] = 0;
          sum[name] += value;
        });

        sum["percent"] = (sum["Total_Cost"] / sum["COGS"]) * 100;
      });
    });

    return sum;
  }

  if (hadTotal == true) {
    var total = [];

    $.each(data, function (po, parts) {
      parts.forEach(function (part, key) {
        // greate new array
        if (!sum[po]) sum[po] = [];
        $.each(part, function (name, value) {
          // set value new item
          if (!sum[po][name]) sum[po][name] = 0;
          sum[po][name] += value;

          // set total value
          if (!total[name]) total[name] = 0;
          total[name] += value;
        });

        sum[po]["percent"] = (sum[po]["Total_Cost"] / sum[po]["COGS"]) * 100;
      });

      total["percent"] = (total["Total_Cost"] / total["COGS"]) * 100;
    });

    return { sum, total };
  }
};
AttributeFooter.prototype.getDataItemList = function () {
  var parts = {};
  var _this = this;

  $("#itemList")
    .find("tr[data-po][data-key].highlightNoClick")
    .each(function () {
      // get data on part
      var data = _this.getValueRowPart(this);

      // get data on group part
      var subRow = $(this).next();
      var subData = _this.getValueRowPart(subRow, false);

      var po = $(this).data("po");
      var key = $(this).data("key");

      // create new data[po] and set array and add 1 item row
      if (!parts[po]) parts[po] = [];

      parts[po][key] = { ...data, ...subData };

      // calculator value on part
      // set amount value
      parts[po][key]["amount"] =
        parts[po][key]["price"] * parts[po][key]["quantity"];
    });

  return parts;
};
AttributeFooter.prototype.getValueRowPart = function (el, isMainRow = true) {
  var row = {};
  var _this = this;
  // var names = [
  //     'EndUserPrice', 'selItem', 'SupplierPart', 'MfrPart', 'quantity', 'GW', 'NW',
  //     'Shipping_Cost', 'Bank_Cost', 'Declare_Cost', 'Total_Cost',
  //     'percent', 'COGS', 'price', 'amount'
  // ];

  // names input in main row
  var names = [
    "SPQ",
    "quantity",
    "GW",
    "NW",
    "Shipping_Cost",
    "Bank_Cost",
    "Declare_Cost",
    "Total_Cost",
    "selItem",
  ];
  if (!isMainRow) {
    names = ["price", "amount", "COGS", "poid", "key", "percent"];
  }
  names.forEach(function (n) {
    var len = $(el).find("[name*=" + n + "]").length;
    if (len != 0) {
      row[n] = $(el)
        .find("[name*=" + n + "]")
        .val();
      row[n] = _this.unformatCurrencyValue(row[n]);
    }
  });
  return row;
};
AttributeFooter.prototype.updateTotalNW = function () {
  var po_total = {};
  var _this = this;
  $("#itemList input[name*=NW]").each(function () {
    var value = $(this).val();
    var po = $(this).closest("tr").data("po");
    if (po_total[po]) po_total[po] += _this.unformatCurrencyValue(value);

    if (!po_total[po]) po_total[po] = _this.unformatCurrencyValue(value);
  });

  if (po_total) {
    $.each(po_total, function (k, v) {
      v = _this.formatWeightValue(v, "kgs");
      $("#itemList [data-po=" + k + "].footer-group .col-total_NW span").text(
        v
      );
    });
  }
};
AttributeFooter.prototype.updateTotalGW = function () {
  var po_total = {};
  var _this = this;
  $("#itemList input[name*=GW]").each(function () {
    var value = $(this).val();
    var po = $(this).closest("tr").data("po");
    if (po_total[po]) po_total[po] += _this.unformatCurrencyValue(value);

    if (!po_total[po]) po_total[po] = _this.unformatCurrencyValue(value);
  });

  if (po_total) {
    $.each(po_total, function (k, v) {
      v = _this.formatWeightValue(v, "kgs");
      $("#itemList [data-po=" + k + "].footer-group .col-total_GW span").text(
        v
      );
    });
  }
};
AttributeFooter.prototype.updateTotalQuantity = function () {
  var po_total = {};
  var _this = this;
  $("#itemList input[name*=quantity]").each(function () {
    var value = $(this).val();
    var po = $(this).closest("tr").data("po");
    if (po_total[po]) po_total[po] += _this.unformatCurrencyValue(value);

    if (!po_total[po]) po_total[po] = _this.unformatCurrencyValue(value);
  });

  if (po_total) {
    $.each(po_total, function (k, v) {
      v = _this.formatWeightValue(v, "");
      $("#itemList [data-po=" + k + "].footer-group .total-quantity span").text(
        v
      );
    });
  }
};
AttributeFooter.prototype.updateTotalAmount = function () {
  var po_total = {};
  var _this = this;
  $("#itemList input[name*=amount]").each(function () {
    var value = $(this).val();
    var po = $(this).closest("tr").data("po");
    if (po_total[po]) po_total[po] += _this.unformatCurrencyValue(value);

    if (!po_total[po]) po_total[po] = _this.unformatCurrencyValue(value);
  });

  if (po_total) {
    $.each(po_total, function (k, v) {
      v = _this.formatCurrencyValue(v);
      $(
        "#itemList [data-po=" + k + "].footer-group .col-total-amount span"
      ).text(v);
    });
  }
};
AttributeFooter.prototype.updateTotalShipping = function () {
  var po_total = {};
  var _this = this;
  $("#itemList input[name*=Shipping_Cost]").each(function () {
    var value = $(this).val();
    var po = $(this).closest("tr").data("po");
    if (po_total[po]) po_total[po] += _this.unformatCurrencyValue(value);

    if (!po_total[po]) po_total[po] = _this.unformatCurrencyValue(value);
  });

  if (po_total) {
    $.each(po_total, function (k, v) {
      v = _this.formatCurrencyValue(v);
      $(
        "#itemList [data-po=" + k + "].footer-group .col-total_shipping span"
      ).text(v);
    });
  }
};
AttributeFooter.prototype.updateTotalBank = function () {
  var po_total = {};
  var _this = this;
  $("#itemList input[name*=Bank_Cost]").each(function () {
    var value = $(this).val();
    var po = $(this).closest("tr").data("po");
    if (po_total[po]) po_total[po] += _this.unformatCurrencyValue(value);

    if (!po_total[po]) po_total[po] = _this.unformatCurrencyValue(value);
  });

  if (po_total) {
    $.each(po_total, function (k, v) {
      v = _this.formatCurrencyValue(v);
      $("#itemList [data-po=" + k + "].footer-group .col-total_bank span").text(
        v
      );
    });
  }
};
AttributeFooter.prototype.updateTotalDeclare = function () {
  var po_total = {};
  var _this = this;
  $("#itemList input[name*=Declare_Cost]").each(function () {
    var value = $(this).val();
    var po = $(this).closest("tr").data("po");
    if (po_total[po]) po_total[po] += _this.unformatCurrencyValue(value);

    if (!po_total[po]) po_total[po] = _this.unformatCurrencyValue(value);
  });

  if (po_total) {
    $.each(po_total, function (k, v) {
      v = _this.formatCurrencyValue(v);
      $(
        "#itemList [data-po=" + k + "].footer-group .col-total_declare span"
      ).text(v);
    });
  }
};
AttributeFooter.prototype.calcDataOnPOInformation = async function () {
  var po_total = {};
  var _this = this;
  $("#itemList [data-po].footer-group").each(function () {
    var po = $(this).data("po");

    var quantity = $(this).find(".total-quantity span").text();
    var cogs = $(this).find(".COGS span").text();
    var amount = $(this).find(".amount span").text();
    var shipping = $(this).find(".col-total_shipping span").text();
    var bank = $(this).find(".col-total_bank span").text();
    var declare = $(this).find(".col-total_declare span").text();
    var cost = $(this).find(".col-total_cost span").text();
    var percent = $(this).find(".percent span").text();

    po_total[po] = {
      quantity,
      cogs,
      amount,
      shipping,
      bank,
      declare,
      cost,
      percent,
    };
  });

  // update value po on po-information
  $.each(po_total, function (k, v) {
    var row = $("#po-information .fg-po[data-po=" + k + "]");
    row.find(".po_shipping[name*=shipping]").val(v.shipping);
    row.find(".po_bank[name*=bank]").val(v.bank);
    row.find(".po_declare[name*=declare]").val(v.declare);
    row.find(".po_total_cost[name*=totalcost]").val(v.cost);
    row.find(".po_total_quantity[name*=totalquantity]").val(v.quantity);
    row.find(".po_amount[name*=totalamount]").val(v.amount);
    row.find(".po_cogs[name*=cogs]").val(v.cogs);
    row.find(".po_percent[name*=percent]").val(v.percent);
  });

  this.updateFooterPOInformation(po_total);
};
AttributeFooter.prototype.updateFooterPOInformation = function (data) {
  var _this = this;
  // update footer po-information
  var po_summary = {
    quantity: 0,
    cogs: 0,
    amount: 0,
    shipping: 0,
    bank: 0,
    declare: 0,
    cost: 0,
  };

  $.each(data, function (k, v) {
    po_summary.quantity += _this.unformatCurrencyValue(v.quantity);
    po_summary.cogs += _this.unformatCurrencyValue(v.cogs);
    po_summary.amount += _this.unformatCurrencyValue(v.amount);
    po_summary.shipping += _this.unformatCurrencyValue(v.shipping);
    po_summary.bank += _this.unformatCurrencyValue(v.bank);
    po_summary.declare += _this.unformatCurrencyValue(v.declare);
    po_summary.cost += _this.unformatCurrencyValue(v.cost);
  });

  po_summary.percent = (po_summary.cost / po_summary.cogs) * 100;
  // format value
  $.each(po_summary, function (k, v) {
    if (k != "quantity" && k != "percent")
      po_summary[k] = _this.formatCurrencyValue(v);
  });
  po_summary.quantity = this.formatWeightValue(po_summary.quantity, "");
  po_summary.percent = this.formatWeightValue(po_summary.percent, "%");

  var footer = $("#po-information").find(".footer-po-information");
  footer.find(".col-po-shipping").text(po_summary.shipping);
  footer.find(".col-po-bank").text(po_summary.bank);
  footer.find(".col-po-declare").text(po_summary.declare);
  footer.find(".col-po-cost").text(po_summary.cost);
  footer.find(".col-po-amount").text(po_summary.amount);
  footer.find(".col-po-cogs").text(po_summary.cogs);
  footer.find(".col-po-quantity").text(po_summary.quantity);
  footer.find(".col-po-per").text(po_summary.percent);
};
AttributeFooter.prototype.executeCost = async function (msg = "Data") {
  this.executeCost2();
  // await this.calcDataOnProducts();

  // await this.calcDataOnPOInformation();

  hideLoading();
  this.setStateExecuteBtn();

  showNoti(msg + " have been changed in sheet!", "Update " + msg, "War");
};

AttributeFooter.prototype.multiOnRow = function (selector, component, target) {
  var multi = 1;
  var row = $(selector).closest("tr");
  component.forEach((v) => {
    var value = row.find(v).val();
    value = this.unformatCurrencyValue(value);
    multi *= value;
  });
  multi = round(multi) == multi ? multi : multi.toFixed(2);
  row.find(target).val(multi);
};
AttributeFooter.prototype.sumTotalRow = async function (el, component, target) {
  var af = this;
  await this.sumTotalOnRow(el, component, target);

  // sum final total
  var sum = 0;
  $("#attribution")
    .find("input.attr-Total")
    .each(function () {
      var value = $(this).val();
      value = af.unformatCurrencyValue(value);
      sum += value;
    });
  sum = this.formatCurrencyValue(sum);

  $("#cost_total").text(sum);
};
class ModalListOld extends Request_pickup {
  constructor() {
    super("#modal-list-old");
  }
  addEventListener() {
    var mlo = this;
    this.root
      .on("click", ".btn-add-part", function () {
        mlo.addPart(this);
      })
      .on("click", "input", function () {
        setTimeout(() => mlo.changeTxtAdd(), 100);
      });
  }
}
ModalListOld.prototype.changeTxtAdd = function () {
  var value = $("#modal-list-old")
    .find("tbody")
    .find("input.cb-ele:checked").length;
  var text = value == 0 ? "Add" : "Add(" + value + ")";
  $("#modal-list-old").find(".modal-footer").find(".btn-success").text(text);
};
ModalListOld.prototype.addPart = async function (el = null) {
  var data = { row: [], key: 1 };
  // check mode request sample or request commercical
  var isOrderSample = $("#OrderType").val() == 0;
  if (isOrderSample && el != null) {
    var tbody = $(el).closest(".modal").find(".modal-body").find("tbody");
    tbody.find("input.cb-ele:checked").each(function () {
      var item = $(this).data();
      data["row"].push(item);
    });
  }

  var row = $("#itemList .mainTable .highlightNoClick").length;
  var group = $("#itemList .mainTable .footer-group.bg-primary").length;
  var key = $("#itemList .mainTable .highlightNoClick").last().data("key");
  var pono = el != null ? data["row"][0]["master"] : "";
  if (isOrderSample == false) {
    pono = -1;
  }
  var selectedID = el != null ? data["row"][0]["selected"] : "";

  data.index = row + 1;
  data.key = key + 1;
  data.group = group + 1;
  var html = await this.send(data, "insertPartPO", { html: true });

  // add po id
  if (selectedID && pono) {
    $("#po-information")
      .find("[data-selected=" + selectedID + "]")
      .removeAttr("data-po")
      .attr("data-po", pono);
  }

  // refresh txt btn add
  $("#modal-list-old").find(".modal-footer").find(".btn-success").text("Add");

  await this.addRow(html, pono);

  // trigger calculator total cost in row part
  $("[data-po].highlightNoClick").find("input[name*=Bank_Cost]").change();

  // trigger calculator quantity
  if (pono)
    $("[data-po=" + pono + "].highlightNoClick")
      .find("input[name*=quantity]")
      .change();

  // disable switch type
  $("#OrderType").addClass("disabled");
  // disable select when client add part
  if (data.row.length > 0) this.disablePoChosse();

  var newItem = $("[data-po].highlightNoClick.new-item");
  await this.scrollTopSmooth(newItem);

  this.refreshTableItem();

  // auto select shipping information
  // isFirstChose
  // get data
  if ($(".infor-shipping-term").data("empty")) {
    var mt = new MainTable();
    mt.autoSelectInfoShipping(pono);
    $(".infor-shipping-term").data("empty", false);
  }
};

ModalListOld.prototype.disablePoChosse = function () {
  $(".fg-po").last().find("select").addClass("disabled");
  $(".fg-po")
    .last()
    .find("input:not(:hidden)")
    .each(function () {
      $(this).addClass("disabled");
    });
};
ModalListOld.prototype.addRow = async function (string, pono = null) {
  // remove all class new-item
  $("#itemList table tr").each(function () {
    $(this).removeClass("new-item");
  });

  // exist po -> insert on group else append
  var index = 0;
  var poExist = false;
  $("#itemList .footer-group").each(function () {
    var value = $(this).data("po");
    if (value == pono) {
      poExist = true;
      index = $(this).index();
    }
  });

  if (!poExist) $("#itemList table tbody").append(string);

  if (poExist) {
    var oldGroup = $("#itemList tr").eq(index + 2);
    oldGroup.remove();

    $("#itemList tr")
      .eq(index + 1)
      .after(string);
    // this.removePoDuplicate(pono);
  }
};

class ExportLog extends Request_pickup {
  constructor(el = "tabs-2") {
    super();
    this.root = $("#" + el);
  }
}
ExportLog.prototype.addEventListener = function () {
  $("[href*=tabs-2]").on("click", () => this.render());
};
ExportLog.prototype.render = async function () {
  var id = $("#id").val();
  var html = await this.send({ id }, "renderExportLog", { html: true });
  $("#tabs-2").html(html);
};

class TabProduct {
  constructor() {}
}
TabProduct.prototype.addEventListener = function () {};

$(document).ready(function () {
  var rp = new Request_pickup();
  rp.addEventListener();
  rp.afterLoaded();
  var mt = new MainTable();
  mt.addEventListener();
  var il = new ItemList();
  il.addEventListener();
  var af = new AttributeFooter();
  af.addEventListener();
  var mlo = new ModalListOld();
  mlo.addEventListener();
  var el = new ExportLog();
  el.addEventListener();
});
