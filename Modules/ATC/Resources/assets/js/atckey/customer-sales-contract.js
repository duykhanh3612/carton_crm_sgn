class CustomerSalesContract {
  constructor(el) {
    this.root = $(el);
  }
  static async removeLoading() {
    $("#loading-animated").removeClass("yt-loader");
  }
  static addLoading() {
    $("#loading-animated").addClass("yt-loader");
  }
  static BtnCheckPart(id, did, selectedID) {
    return `<input type="checkbox" name="" class="cb-ele" value="" data-master="${id}" data-detail="${did}" data-selected="${selectedID}" >`;
  }
}
CustomerSalesContract.prototype.addEventListener = function () {
  this.calOverDate();

  var _this = this;
  this.root
    .on("changeDate", "#EstimatePaymentDate", function () {
      _this.calOverDate();
    })
    .on("change", "#CustomerID", function () {
      _this.getInfoCompany();
    })
    .on("change", "#CustomerPOID", function () {
      _this.setCustomerPO(this);
    })
    .on("click", ".btn-part-list-po", function () {
      _this.searchPart();
    })
    .on("click",".btn-part-list-po-version2",function(){
      _this.searchPart_v2();
    });

  $("body")
    .on("click", ".minus-searchCPO", function () {
      _this.clickSearchCPO();
    })
    .on("click", ".close-searchSO", function () {
      $(".part-list-with-po").hide();
    })
    .on("click", ".part-list-with-po tr", function () {
      _this.addPart(this);
    })
    .on("click", ".part-show-hide", function () {
      _this.partDisplayOptions();
    })
    .on("submit", "#colsModal form.part-main-form", function () {
      _this.submitPartDisplayOptions();
    })
    .on("click", "#addRow", function () {
      _this.addRow();
    })
    .on("click", "#importModal .border-primary", function () {
      _this.importData();
    });

  $("#itemList").on("DOMNodeInserted", "tbody", function () {
    _this.refreshCalculatorPart();
  });

  $("#modal-list-old").on(
    "click",
    "[data-dismiss],.group-process .btn.btn-border.btn-alt.border-primary.font-primary.waves-effect",
    function () {
      _this.refreshCalculatorPart();
    }
  );

  $("#modal-list-cpo").on("click", "input", function () {
    setTimeout(() => _this.changeTxtAdd(), 100);
  }).on("click", ".btn-add-part", function () {
    _this.addPart_v2(this);
  });
};
CustomerSalesContract.prototype.importData = async function () {
  if ($("#selectMfrPart").val() == "" || $("#selectMfrPart").val() == -1) {
    showNoti(
      "Mfr Part # is a required field, please select data",
      "Warning",
      "War"
    );
    return false;
  }
  let data = {
    act: $("#act").val(),
    proLE: proLE,
    usd_currency: $("#USDExchangeRate")
      .val()
      .replace(/\s/g, "")
      .replace(/,/g, ""),
    file: $("#file").val(),
    sheet: $("#sheet").val(),
    startRow: $("#headerInfo").val(),
    endRow: $("#footerInfo").val(),
    key: $("#itemList table tbody .highlightNoClick").length,
    selectSupplierPart: $("#selectSupplierPart").val(),
    selectMfrPart: $("#selectMfrPart").val(),
    selectDescription: $("#selectDescription").val(),
    selectManufacturer: $("#selectManufacturer").val(),
    selectPackageCase: $("#selectPackageCase").val(),
    selectPackaging: $("#selectPackaging").val(),
    selectStandardPackageQty: $("#selectStandardPackageQty").val(),
    selectSPQPrice: $("#selectSPQPrice").val(),
    selectOrderQuantity: $("#selectOrderQuantity").val(),
    selectUnitPriceUSD: $("#selectUnitPriceUSD").val(),
    selectBuyingPrice: $("#selectBuyingPrice").val(),
    selectDateCode: $("#selectDateCode").val(),
    selectCountryOfOrigin: $("#selectCountryOfOrigin").val(),
    selectCondition: $("#selectCondition").val(),
    selectMultipleQuantity: $("#selectMultipleQuantity").val(),
    selectMinimumQuantity: $("#selectMinimumQuantity").val(),
    selectLeadtime: $("#selectLeadtime").val(),
  };
  var proLE = "";
  $("#itemList table tbody tr td input.supplier-part").each(function () {
    proLE += (proLE ? "," : "") + "" + $(this).val();
  });

  var getData = await this.send(data, "process_file");
  if (!getData) return;

  if (getData.add.length) {
    for (i = 0; i < getData.add.length; i++) {
      $("#itemList table tbody tr.tr-last").before(getData.add[i]);
      $("#itemList table tbody tr.tr-last")
        .prev()
        .find(".bootstrap-datepicker")
        .datepicker({
          format: "yyyy-mm-dd",
          language: "vi",
          autoclose: true,
          todayHighlight: true,
        });
    }
  }
  if (getData.update.length) {
    $.alerts.confirm(
      "Do you want update info of <b>" +
        $(".divPreview table tbody tr.exists").length +
        "</b> items exist?",
      "Confirm update",
      function (r) {
        if (r == true) {
          for (i = 0; i < getData.update.length; i++) {
            if (
              $(
                'input.supplier-part[value="' +
                  getData.update[i].SupplierPart +
                  '"]'
              ).length
            ) {
              var e = $(
                'input.supplier-part[value="' +
                  getData.update[i].SupplierPart +
                  '"]'
              ).closest("tr");
              e.find(".order-qty").val(
                accounting.formatMoney(getData.update[i].OrderQuantity, "", 0)
              );
              e.find(".unit-price-usd").val(
                accounting.formatMoney(getData.update[i].UnitPriceUSD, "", 4)
              );
              e.find(".unit-price-vnd").val(
                accounting.formatMoney(
                  parseFloat(getData.update[i].UnitPriceUSD) *
                    parseFloat(getData.update[i].usd_currency),
                  "",
                  0
                )
              );
              e.find(".col-leadtime textarea").val(
                getData.update[i].LeadtimeComments
              );
              e.find(".col-date_code input").val(getData.update[i].DateCode);
              e.find(".col-coo input").val(getData.update[i].OriginOfCountry);
              e.find(".col-pro_condition input").val(
                getData.update[i].PROCondition
              );
              updateDataItem(e);
            }
          }
        }
        hideLoading();
        $("#importModal").modal("hide");
        updateDataSum();
        drapOrder();
      }
    );
  } else {
    hideLoading();
    $("#importModal").modal("hide");
    updateDataSum();
    drapOrder();
    anrDataRequired();
    col_vis_user_level();
  }
  check_attribution_mfr();
  $(".bootstrap-datepicker").datepicker({
    format: "yyyy-mm-dd",
    language: "vi",
    autoclose: true,
    todayHighlight: true,
  });
  $("#itemList table tbody tr").find(".select2").chosen();
};
CustomerSalesContract.prototype.getNextRowId = function(){
  var key =
    parseInt(
      $("#itemList table tbody .highlightNoClick:last td input.itemKey").val()
    ) + 1;
  if ($("#itemList table tbody .highlightNoClick").length == 0) {
    key = 1;
  }
  return key;
}
CustomerSalesContract.prototype.addRow = async function () {
  var key = this.getNextRowId()

  var data = {
    key: key,
    usd_currency: $("#USDExchangeRate").length
      ? parseFloat(
          $("#USDExchangeRate").val().replace(/\s/g, "").replace(/,/g, "")
        )
      : "",
    Image: "",
    SupplierPart: "",
    MfrPart: "",
    Description: "",
    Manufacturer: "",
    PackageCase: "",
    Packaging: "",
    StandardPackageQty: "",
    MinimumQuantity: "",
    UnitPriceUSD: "",
    LeadtimeComments: "",
    Stock: "",
    OnOder: 0,
    DateCode: "",
    OriginOfCountry: "",
  };
  let html = await this.send({ act: $("#act").val(), data }, "addPart", {
    html: true,
    closeLoading: true,
  });
  $("#itemList").find("tbody").append(html);
  updateNO();
};
CustomerSalesContract.prototype.submitPartDisplayOptions = async function () {
  var data = $("#colsModal form.part-main-form").serialize();
  var res = await this.send(data, "update_cols");
  if (res) {
    window.location = window.location;
  }
};
CustomerSalesContract.prototype.partDisplayOptions = async function () {
  var module = $("#act").val();
  var html = await this.send({ module }, "part_options", {
    html: true,
    closeLoading: true,
  });
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
CustomerSalesContract.prototype.createDragTasks = function (name) {
  $("#" + name).tableDnD();

  // name = name + '-body';
  // var el = document.getElementById(name);
  // Sortable.create(el, {
  //     animation: 150,
  //     ghostClass: 'blue-background-class'
  // });
};



CustomerSalesContract.prototype.addPart_v2 = async function (el = null) {

  var rows = []
  var id = $("#id").val();
  $("#itemList").find(".new-item").removeClass("new-item");

  if (el != null) {
    var tbody = $(el).closest(".modal").find(".modal-body").find("tbody");
    tbody.find("input.cb-ele:checked").each(function () {
      var item = $(this).data();
      item.id = id;
      rows.push(item);
    });
  }

  var html = await this.send({ act: $("#act").val(), rows }, "addPart_v2", {
    html: true,
    closeLoading: true,
  });

  $("#itemList tbody").append(html);


  var newItem = $("[data-row][data-id].highlightNoClick.new-item");
  this.resetRowNo()
  await this.scrollTopSmooth(newItem);

  this.refreshCalculatorPart();
}
CustomerSalesContract.prototype.resetRowNo = function(){
  no = 0;
  $("#itemList .stt").each(function () {
    no++;
    $(this).text(no);
  });
}
CustomerSalesContract.prototype.addPart = async function (el = null) {
  var rowPart = $(el);
  var part = $(el).find("td.supplier").text();
  var key =
    parseInt(
      $("#itemList table tbody .highlightNoClick:last td input.itemKey").val()
    ) + 1;
  if ($("#itemList table tbody .highlightNoClick").length == 0) {
    key = 1;
  }
  if ($('input.supplier-part[value="' + part + '"]').length) {
    $('input.supplier-part[value="' + part + '"]')
      .closest("tr.highlightNoClick")
      .addClass("exists")
      .delay(7000)
      .queue(function (next) {
        rowPart.removeClass("exists");
        next();
      });
    showNoti(
      "Supplier Part #: " + part.replace("&", "&amp;") + " already exists",
      "Warning",
      "War"
    );
  } else {
    var data = {
      key: key,
      CPO: rowPart.data("cpoid"),
      PO: rowPart.data("poid"),
      ImportMethod: rowPart.data("importmethod"),
      SupplierPart: part,
      MfrPart: rowPart.find("td.mfrpart").text(),
      Description: rowPart.find("td.desc").text(),
      Manufacturer: rowPart.find("td.mfr").text(),
      Image: rowPart.find("img").data("url"),
      StandardPackageQty: rowPart.data("spq"),
      OrderQuantity: rowPart.data("qty"),
      UnitPriceVND: rowPart.data("pricevnd"),
      UnitPriceUSD: rowPart.data("priceusd"),
      LeadtimeComments: rowPart.data("leadtime"),
      Stock: rowPart.data("stock"),
      PackageCase: rowPart.data("packagecase"),
      Packaging: rowPart.data("packaging"),
      DateCode: rowPart.data("datecode"),
      OriginOfCountry: rowPart.data("coo"),
      PROCondition: rowPart.data("condition"),
    };
    var html = await this.send({ act: $("#act").val(), data }, "addPart", {
      html: true,
      closeLoading: true,
    });
    $("#itemList tbody").append(html);

    this.refreshCalculatorPart();
  }
};
CustomerSalesContract.prototype.scrollTopSmooth = function (el) {
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
CustomerSalesContract.prototype.searchPart_v2 = async function () {
  if ($(".part-list-with-po").length) $(".part-list-with-po").remove();

  var val = $("#CustomerPOID").val();
  if (val == null) {
    showNoti("CPO No cannot be empty", "Warning", "War");
    return false;
  }
  var key = this.getNextRowId()

  var html = await this.send({ arrID: val, key }, "customer_sales_contract/queryCPO", {
    ajaxController: true,
    html: true,
    closeLoading: true,
  });
  if (html == "") {
    showNoti("Check again PO", "Warning", "War");
    return false;
  }
  this.openModelInsertPart(html);
    return true;
};
CustomerSalesContract.prototype.openModelInsertPart = function (html) {
  $("#modal-list-cpo .modal-body").empty().append(html);
  $("#modal-list-cpo").modal("show");

  // refresh button add when click query again
  this.changeTxtAdd()
};
CustomerSalesContract.prototype.searchPart = async function () {
  if ($(".part-list-with-po").length) $(".part-list-with-po").remove();
  var val = $("#CustomerPOID").val();
  if (val == null) {
    showNoti("CPO No cannot be empty", "Warning", "War");
    return false;
  }

  var data = await this.send({ arrID: val }, "ajax/pl_cpo", {
    ajaxController: true,
    html: true,
    closeLoading: true,
  });
  data = JSON.parse(data);
  console.log({ data });
  if (data == "") {
    showNoti("Check again PO", "Warning", "War");
    return false;
  }

  var html = this.createModal(data);
  $("body").append(html);
};
CustomerSalesContract.prototype.createModal = function (getData) {
  var part_list = `<table class="table tableplCPO" style="width: 100%;text-align: left">
                        <thead>
                            <tr>
                                <th>Cust Request Date</th>
                                <th>Supplier Part</th>
                                <th>Mfr Part</th>
                                <th class="desc">Description</th>
                                <th>Manufacturer</th>
                                <th>Package / Case</th>
                                <th>Packaging</th>
                                <th>SPQ</th>
                                <th>Order Qty</th>
                                <th>Unit Price</th>
                                <th>Amount</th>
                                <th>Leadtime / Comments</th>
                            </tr>
                        </thead>`;
  for (var i = 0; i < getData.length; i++) {
    CustRequestDate =
      getData[i].CustRequestDate != null
        ? getData[i].CustRequestDate
        : "00-00-0000";
    part_list +=
      '<tr data-cpoid="' +
      getData[i].cpoid +
      '" data-poid="' +
      getData[i].poid +
      '" data-importmethod="' +
      getData[i].ImportMethod +
      '" data-spq="' +
      getData[i].StandardPackageQty +
      '" data-qty="' +
      getData[i].OrderQuantity +
      '" data-pricevnd="' +
      getData[i].UnitPriceVND +
      '" data-priceusd="' +
      getData[i].UnitPriceUSD +
      '" data-deliverydate="' +
      getData[i].DeliveryDate +
      '" data-stock="' +
      getData[i].Stock +
      '" data-packagecase="' +
      getData[i].PackageCase +
      '" data-packaging="' +
      getData[i].Packaging +
      '" data-datecode="' +
      getData[i].DateCode +
      '" data-coo="' +
      getData[i].COO +
      '" data-condition="' +
      getData[i].PROCondition +
      '">';
    part_list += "<td>" + CustRequestDate + "</td>";
    part_list +=
      '<td class="supplier">' +
      getData[i].SupplierPart.replace("&", "&amp;") +
      "</td>";
    part_list +=
      '<td class="mfrpart">' +
      getData[i].MfrPart.replace("&", "&amp;") +
      "</td>";
    part_list +=
      '<td class="desc">' +
      getData[i].Description.replace("&", "&amp;") +
      "</td>";
    part_list += '<td class="mfr">' + getData[i].Manufacturer + "</td>";
    part_list += '<td class="mfr">' + getData[i].PackageCase + "</td>";
    part_list += '<td class="mfr">' + getData[i].Packaging + "</td>";
    part_list += '<td class="mfr">' + getData[i].StandardPackageQty + "</td>";
    part_list += '<td class="mfr">' + getData[i].OrderQuantity + "</td>";
    part_list +=
      '<td class="mfr">' +
      this.formatCurrencyValue(getData[i].UnitPriceVND, false, "VND") +
      "</td>";
    part_list +=
      '<td class="mfr">' +
      this.formatCurrencyValue(getData[i].AmountVND, false, "VND") +
      "</td>";
    part_list += '<td class="mfr">' + getData[i].LeadtimeComments + "</td>";
    part_list += "</tr>";
  }
  part_list += "</table>";
  var html = `<div class="part-list-with-po" style="top:15%"><div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Query CPO</h3>
                        <button style="margin-top: -20px;" type="button" class="close close-searchSO" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <button style="margin-top: -20px;margin-right: 10px;" type="button" class="close minus-searchCPO" aria-label="minus">
                            <span aria-hidden="true" class="maxmin">−</span>
                            <span aria-hidden="true" class="maxmin" style="display: none">+</span>
                        </button>
                    </div>
                    <div class="panel-body">${part_list}</div>
                </div>`;
  return html;
};
CustomerSalesContract.prototype.clickSearchCPO = function () {
  $(".body-searchSO").toggle();
  $(".maxmin").toggle();
  $(".part-list-with-po .panel-body").toggle();
};
CustomerSalesContract.prototype.changeTxtAdd = function () {
  var value = $("#modal-list-cpo")
    .find("tbody")
    .find("input.cb-ele:checked").length;
  var text = value == 0 ? "Add" : "Add(" + value + ")";
  $("#modal-list-cpo").find(".modal-footer").find(".btn-success").text(text);
};
CustomerSalesContract.prototype.refreshCalculatorPart = function () {
  $("#itemList").find("[name*=markupUSD]").trigger("change");
  $("#itemList [name*=OrderQuantity]").last().trigger("change");
};
CustomerSalesContract.prototype.send = function (data, url, option = {}) {
  url = option.ajaxController == true ? url : "customer_sales_contract/" + url;

  // set default option
  option.closeLoading = option.closeLoading ? option.closeLoading : false;
  option.openLoading = option.openLoading ? option.openLoading : false;
  option.numberProcess = option.numberProcess ? option.numberProcess : 1;
  option.html = option.html ? option.html : false;

  return new Promise((resolve, reject) => {
    $.ajax({
      url: url,
      type: "POST",
      data: data,
      beforeSend: function () {
        if (!option.openLoading) {
          showProcess(option.numberProcess);
          CustomerSalesContract.addLoading();
        }
      },
      complete: function () {
        if (option.closeLoading) {
          hideLoading();
          CustomerSalesContract.removeLoading();
        }
      },
      success: function (res) {
        if (res == null) {
          reject({});
          return false;
        }

        if (res && res == "window") {
          $.alerts.alert(
            "Session Has Expired!\n We'll refresh this page.\nThanks!",
            "Alert",
            function (r) {
              location.reload();
            }
          );
          reject({});
          return false;
        }

        if (res && option && option.html) {
          resolve(res);
          return true;
        }

        res = JSON.parse(res);
        resolve(res.data);
      },
      timeout: 20000,
      error: function (jqXHR, textStatus, errorThrown) {
        hideLoading();
        Invoice.removeLoading();
        reject({});
      },
    });
  });
};
CustomerSalesContract.prototype.setCustomerPO = async function (el) {
  var text = $(el).find("option:checked").text();
  $("#CustomerPONo").val(text);
  $("#input-query-cpo").val(text);
  
  var id = $(el).find("option:checked").val();
  var res = await this.send({ id }, "getCPOInfo", { closeLoading: true });
  var completeDate = res.date ?? null;
  var cpoDate = res.cpo_date ?? null;
  var approved = res.approved ?? null;



  $("#CPOCompleteDate").val(completeDate);
  $("#PODate").val(cpoDate);
  $("#CPOApproved").val(approved);
  var status = res.status ?? 0;
  this.changeSelectByValue("#CPOStatus", status);
  $("#itemList tbody").html("");

  // auto search part
  $(".btn-part-list-po-version2").trigger("click");
};
CustomerSalesContract.prototype.calOverDate = function () {
  var due_date = this.root.find("#EstimatePaymentDate").val();
  due_date = due_date ? moment(due_date) : null;
  var paid_date = this.root.find("#RestPaymentDate").val();
  paid_date = paid_date ? moment(paid_date) : null;

  var today = moment().startOf("day");

  if (due_date != null && (paid_date == null || paid_date > today)) {
    var overDate = due_date.diff(today, "day");
    if (overDate > 0) overDate = "+" + overDate;

    this.root.find("#overDate").val(overDate);
  }
};
CustomerSalesContract.prototype.getSubTotal = function (currency) {
  var el = "#SubTotalVND";
  switch (currency) {
    case "USD":
      el = ".pad20T input.sub-total-usd";
      break;
    default:
      break;
  }
  var total = $(el).val();
  return this.unformatCurrencyValue(total);
};
CustomerSalesContract.prototype.showOverAlert = function () {
  var buyname = $("#BuyerName").val();
  buyname = buyname ? buyname : $("#CustomerID").find("option:checked").text();
  showNoti(buyname, "Cảnh báo công nợ quá hạn mức", "War");
};
CustomerSalesContract.prototype.getInfoCompany = async function () {
  var id = this.root.find("#CustomerID").val();
  id = id ? id.split("-")[0].trim() : null;
  var cscid = $("#id").val();
  var state = cscid ? parseInt(cscid) : "";
  var res = await this.send({ id, state }, "getInfoCompany", {
    closeLoading: true,
  });

  if (!res) return false;

  var credit = res.credit ? res.credit : 0;
  var debit = res.debit ? res.debit : 0;
  var total = this.getSubTotal(res.currency);
  var credit_status = "Non - Over Credit";
  var label = this.root
    .find("#CreditStatus")
    .closest(".form-group")
    .find("label");

  // hight light when debit > credit
  if (
    (parseInt(credit) == 0 && parseInt(debit) == 0) ||
    parseInt(debit) + parseInt(total) > parseInt(credit)
  ) {
    credit_status = "Over Credit";
    this.showOverAlert();
    label.addClass("over");
  } else {
    label.removeClass("over");
  }

  // add shipping info
  this.root.find("#ShippingAddressLine1").val(res.ShippingAddress);
  this.root.find("#ContactName").val(res.ShippingName);
  this.root.find("#ContactPhone").val(res.Phone);

  this.changeSelectByValue("#ShippingMethod", res.ShippingMethod);
  this.changeSelectByValue("#ShippingTerm", res.ShippingTerm);
  this.root.find("#Country").val(res.DeliveryCountry);
  this.root.find("#City").val(res.ShippingRegion);

  // set message alert
  this.root.find("#CreditStatus").val(credit_status);
  label.text(credit_status);

  // set value inputs
  credit = this.formatCurrencyValue(credit, false, "VND");
  debit = this.formatCurrencyValue(debit, false, "VND");
  this.root.find("#CreditLimited").val(credit);
  this.root.find("#Debit").val(debit);
};
CustomerSalesContract.prototype.changeSelectByValue = function (el, text) {
  $(el).val(text);
  $(el).trigger("chosen:updated");
};
CustomerSalesContract.prototype.unformatCurrency = function (el) {
  var value = $(el).val();
  value = this.unformatCurrencyValue(value);

  $(el).val(value);
  return value;
};
CustomerSalesContract.prototype.unformatCurrencyValue = function (value) {
  value = value ? accounting.unformat(value) : 0;
  // value = value.replace(/[0-9].-/g,'')
  return value;
};
CustomerSalesContract.prototype.formatCurrencyValue = function (
  value,
  isUnit = false,
  currency = "USD"
) {
  var isInt = round(value) == value;
  var numDigits = isInt || (currency == "VND" && !isUnit) ? 0 : isUnit ? 4 : 2;
  var symbol =
    currency == "USD"
      ? "$"
      : currency == "VND"
      ? "đ"
      : currency == "EURO"
      ? "€"
      : "¥";

  var pattern = currency == "VND" ? "%v%s" : "%s%v";
  var options = {
    symbol: symbol,
    decimal: ".",
    thousand: ",",
    precision: numDigits,
    format: pattern,
  };
  return value || value === 0 ? accounting.formatMoney(value, options) : 0;
};
CustomerSalesContract.prototype.formatCurrency = function (
  el,
  isUnit = false,
  currency = "USD"
) {
  var value = $(el).val();
  value = this.formatCurrencyValue(value, isUnit, currency);

  $(el).val(value);

  return value;
};

class InfoOrder extends CustomerSalesContract {
  constructor(el) {
    super(el);
  }
}

InfoOrder.prototype.addEventListener = function () {
  var _this = this;
  this.root.on("change", "select#Status", function () {
    _this.changeColorStatus(this);
  });
};
InfoOrder.prototype.changeColorStatus = function (el) {
  console.log("change");
  var color = $(el).find("option:selected").data("color");
  $(el).css("background", color);
};

class Invoice extends CustomerSalesContract {
  constructor(el) {
    super(el);
  }
}
Invoice.prototype.addEventListener = function () {
  var _this = this;

  this.root
    .on("click", ".btn-add-inv-2", function () {
      _this.add();
    })
    .on("click", ".btn-remove-inv2", function () {
      _this.remove(this);
    })
    .on("focus", "input[data-type=currency]", function () {
      _this.unformatCurrency(this);
    })
    .on("blur", "input[data-type=currency]", function () {
      _this.formatCurrency(this, false, "VND");
    })
    .on("blur", "[name*=SubValueOfInvoice]", async function () {
      //1
      await _this.setRevenue(this); //3
      await _this.setTotalInvoice(this); //5
      _this.setRestPayment(this); //7
    })
    .on("change", "[name*=InvoiceRebate]", async function () {
      //2
      await _this.setRevenue(this);
    })
    .on("change", ".select-status.select-tax", async function () {
      //4
      await _this.setTotalInvoice(this); //5
      _this.setRestPayment(this); //7
    })
    .on("change", "[name*=InvoiceDeposit]", function () {
      // 6
      _this.setRestPayment(this);
    });
};

Invoice.prototype.getCurrentRowInv = function (el) {
  var key = $(el).closest("[data-inv-key]").data("inv-key");
  return this.root.find("[data-inv-key=" + key + "]");
};
Invoice.prototype.setTotalInvoice = function (el) {
  var row = this.getCurrentRowInv(el);
  var taxPercent = row.find("[name*=TAX]").val();
  taxPercent = accounting.unformat(taxPercent) / 100;
  var inv = row.find("[name*=SubValueOfInvoice]").val();
  inv = this.unformatCurrencyValue(inv);
  var total = (taxPercent + 1) * inv;
  total = this.formatCurrencyValue(total, false, "VND");
  row.find(".total-inv[name*=ValueOfInvoice]").val(total);
};
Invoice.prototype.add = async function () {
  var key = $("#invoice-information")
    .find(".fg-header-invoices")
    .last()
    .data("inv-key");
  key = key ? key + 1 : 1;
  var html = await this.send({ key }, "addInvoice", { html: true });

  this.root.find(".fg-wrap-invoices").append(html);
  var row = this.root.find(".fg-wrap-invoices").last();
  this.createDatePicker(row);
  this.displayBtnRemove();
};
Invoice.prototype.setRestPayment = function (el) {
  var row = this.getCurrentRowInv(el);
  var deposit = row.find("[name*=InvoiceDeposit]").val();
  deposit = this.unformatCurrencyValue(deposit);
  var total = row.find(".total-inv[name*=ValueOfInvoice]").val();
  total = this.unformatCurrencyValue(total);
  console.log({ deposit, total });
  var res = total - deposit;
  res = this.formatCurrencyValue(res, false, "VND");
  row.find("[name*=InvoiceRest]").val(res);
};
Invoice.prototype.createDatePicker = function (el) {
  $(el).find(".bootstrap-datepicker").datepicker({
    format: "yyyy-mm-dd",
    language: "vi",
    autoclose: true,
    todayHighlight: true,
  });
};
Invoice.prototype.setRevenue = function (el) {
  var row = this.getCurrentRowInv(el);
  var inv = row.find("[name*=SubValueOfInvoice]").val();
  var rebate = row.find("[name*=InvoiceRebate]").val();
  var res =
    this.unformatCurrencyValue(inv) - this.unformatCurrencyValue(rebate);
  res = this.formatCurrencyValue(res, false, "VND");
  row.find("[name*=InvoiceRevenue]").val(res);
  return true;
};
Invoice.prototype.remove = function (el) {
  var key = $(el).closest("[data-inv-key]").data("inv-key");
  this.root.find("[data-inv-key=" + key + "]").remove();
  console.log({ key });
  this.displayBtnRemove();
};
Invoice.prototype.displayBtnRemove = function () {
  // disable remove button
  this.root
    .find(".fg-wrap-invoices")
    .find(".btn-remove-inv2")
    .addClass("disabled");
  // enable last btn remove
  this.root
    .find(".fg-wrap-invoices")
    .find(".btn-remove-inv2")
    .last()
    .removeClass("disabled");
};

class ItemList extends CustomerSalesContract {
  constructor(el) {
    super(el);
  }
}
ItemList.prototype.addEventListener = function () {
  var _this = this;
  $(".group-process").on("click", "#removeRowPart", function () {
    _this.addRemoveListItems();
  });

  this.root
    .on("focus", "input[data-type=currency]", function () {
      _this.unformatCurrency(this);
    })
    .on("blur", "input[data-type=currency]", function () {
      _this.formatCurrency(this, false, "VND");
    })
    .on("focus", "input[data-type=currency_unit]", function () {
      var currency = $(this).data("currency");
      _this.unformatCurrency(this, true, currency);
    })
    .on("blur", "input[data-type=currency_unit]", function () {
      var currency = $(this).data("currency");
      _this.formatCurrency(this, true, currency);
    })
    .on("click", ".btn-collapse", function () {
      _this.toggleListItem(this);
    })
    .on("click", ".btn-collapse-child", function () {
      _this.toggleRowItem(this);
    })
    .on("blur", ".order-qty[name*=OrderQuantity]", function () {
      _this.refreshItemList(this);
    })
    .on("blur", ".unit-price-usd[name*=UnitPriceUSD]", function () {
      _this.setUnitprice(this, "VND");
      _this.refreshItemList(this);
    })
    .on("blur", ".unit-price-vnd[name*=UnitPriceVND]", function () {
      _this.setUnitprice(this, "USD");
      _this.refreshItemList(this);
    })
    .on("change", ".markup_usd[name*=markupUSD]", function () {
      _this.setMarkup(this, "VND");
      _this.refreshItemList(this);
    })
    .on("change", ".markup_vnd[name*=markupVND]", function () {
      _this.setMarkup(this, "USD");
      _this.refreshItemList(this);
    })
    .on("change", ".customer_price_usd[name*=CustomerPriceUSD]", function () {
      _this.setCustomerPrice(this, "VND");
      _this.changeCustomerPrice(this);
      _this.refreshItemList(this);
    })
    .on("change", ".customer_price_vnd[name*=CustomerPriceVND]", function () {
      _this.setCustomerPrice(this, "USD");
      _this.changeCustomerPrice(this);
      _this.refreshItemList(this);
    });
};
ItemList.prototype.getUnitPrice = function (row) {
  var unit_price_usd = row.find(".unit-price-usd[name*=UnitPriceUSD]").val();
  unit_price_usd = this.unformatCurrencyValue(unit_price_usd);
  var unit_price_vnd = row.find(".unit-price-vnd[name*=UnitPriceVND]").val();
  unit_price_vnd = this.unformatCurrencyValue(unit_price_vnd);
  return { unit_price_usd, unit_price_vnd };
};
ItemList.prototype.changeCustomerPrice = function (el) {
  var key = $(el).closest("[data-row]").data("row");
  var row = this.root.find("[data-row=" + key + "]");

  // unit price | selling price
  var { unit_price_usd, unit_price_vnd } = this.getUnitPrice(row);

  // customer price
  var CustomerPriceUSD = row
    .find(".customer_price_usd[name*=CustomerPriceUSD]")
    .val();
  CustomerPriceUSD = this.unformatCurrencyValue(CustomerPriceUSD);

  var CustomerPriceVND = row
    .find(".customer_price_vnd[name*=CustomerPriceVND]")
    .val();
  CustomerPriceVND = this.unformatCurrencyValue(CustomerPriceVND);

  // markup
  var markup_usd = unit_price_usd - CustomerPriceUSD;
  markup_usd = this.formatCurrencyValue(markup_usd, true, "USD");
  row.find(".markup_usd[name*=markupUSD]").val(markup_usd);

  var markup_vnd = unit_price_vnd - CustomerPriceVND;
  markup_vnd = this.formatCurrencyValue(markup_vnd, true, "VND");
  row.find(".markup_vnd[name*=markupVND]").val(markup_vnd);
};
ItemList.prototype.setCustomerPrice = function (el, currency) {
  var rate = $("#USDExchangeRate").val().replace(/\D/g, "");
  rate = rate ? this.unformatCurrencyValue(rate) : 0;
  var value = currency == "VND" ? rate : 1 / rate;
  var key = $(el).closest("[data-row]").data("row");
  var row = this.root.find("[data-row=" + key + "]");
  var lower_currency = currency.toLowerCase();
  var customer_price = $(el).val();
  var covert_customer_price =
    value * this.unformatCurrencyValue(customer_price);
  covert_customer_price = this.formatCurrencyValue(
    covert_customer_price,
    true,
    currency
  );
  row
    .find(
      ".customer_price_" +
        lower_currency +
        "[name*=CustomerPrice" +
        currency +
        "]"
    )
    .val(covert_customer_price);
};
ItemList.prototype.setUnitprice = function (el, currency) {
  var rate = $("#USDExchangeRate").val().replace(/\D/g, "");
  rate = rate ? this.unformatCurrencyValue(rate) : 0;
  var value = currency == "VND" ? rate : 1 / rate;
  var key = $(el).closest("[data-row]").data("row");
  var row = this.root.find("[data-row=" + key + "]");
  var lower_currency = currency.toLowerCase();
  var unit_price = $(el).val();
  var covert_unit_price = value * this.unformatCurrencyValue(unit_price);
  covert_unit_price = this.formatCurrencyValue(
    covert_unit_price,
    true,
    currency
  );
  row
    .find(".unit-price-" + lower_currency + "[name*=UnitPrice" + currency + "]")
    .val(covert_unit_price);
};
ItemList.prototype.setMarkup = function (el, currency) {
  var rate = $("#USDExchangeRate").val().replace(/\D/g, "");
  rate = rate ? this.unformatCurrencyValue(rate) : 0;
  var value = currency == "VND" ? rate : 1 / rate;
  var key = $(el).closest("[data-row]").data("row");
  var row = this.root.find("[data-row=" + key + "]");
  var lower_currency = currency.toLowerCase();
  var markup = $(el).val();
  var covert_markup = value * this.unformatCurrencyValue(markup);
  covert_markup = this.formatCurrencyValue(covert_markup, true, currency);
  row
    .find(".markup_" + lower_currency + "[name*=markup" + currency + "]")
    .val(covert_markup);
};
ItemList.prototype.refreshItemList = function (el) {
  var rate = $("#USDExchangeRate").val().replace(/\D/g, "");
  rate = rate ? this.unformatCurrencyValue(rate) : 0;

  var key = $(el).closest("[data-row]").data("row");
  var row = this.root.find("[data-row=" + key + "]");

  // markup
  var markup_usd = row.find(".markup_usd[name*=markupUSD]").val();
  markup_usd = this.unformatCurrencyValue(markup_usd);
  var markup_vnd = row.find(".markup_vnd[name*=markupVND]").val();
  markup_vnd = this.unformatCurrencyValue(markup_vnd);

  // quantity
  var order_quantity = row.find(".order-qty[name*=OrderQuantity]").val();
  order_quantity = this.unformatCurrencyValue(order_quantity);

  // unit price | selling price
  var { unit_price_usd, unit_price_vnd } = this.getUnitPrice(row);

  // total selling
  var AmountUSD = order_quantity * unit_price_usd;
  AmountUSD = this.formatCurrencyValue(AmountUSD, false, "USD");
  row.find(".amount-usd[name*=AmountUSD]").val(AmountUSD);

  var AmountVND = order_quantity * unit_price_vnd;
  AmountVND = this.formatCurrencyValue(AmountVND, false, "VND");
  row.find(".amount-vnd[name*=AmountVND]").val(AmountVND);

  // customer price
  var CustomerPriceUSD = unit_price_usd - markup_usd;
  CustomerPriceUSD = this.formatCurrencyValue(CustomerPriceUSD, true, "USD");
  row.find(".customer_price_usd[name*=CustomerPriceUSD]").val(CustomerPriceUSD);

  var CustomerPriceVND = unit_price_vnd - markup_vnd;
  CustomerPriceVND = this.formatCurrencyValue(CustomerPriceVND, true, "VND");
  row.find(".customer_price_vnd[name*=CustomerPriceVND]").val(CustomerPriceVND);

  // customer amount
  var CustomerAmountUSD =
    order_quantity * this.unformatCurrencyValue(CustomerPriceUSD);
  CustomerAmountUSD = this.formatCurrencyValue(CustomerAmountUSD, false, "USD");
  row
    .find(".customer_amount_usd[name*=CustomerAmountUSD]")
    .val(CustomerAmountUSD);

  var CustomerAmountVND =
    order_quantity * this.unformatCurrencyValue(CustomerPriceVND);
  CustomerAmountVND = this.formatCurrencyValue(CustomerAmountVND, false, "VND");
  row
    .find(".customer_amount_vnd[name*=CustomerAmountVND]")
    .val(CustomerAmountVND);

  // rebate
  var RebateUSD =
    this.unformatCurrencyValue(AmountUSD) -
    this.unformatCurrencyValue(CustomerAmountUSD);
  RebateUSD = this.formatCurrencyValue(RebateUSD, false, "USD");
  row.find(".rebate_usd[name*=RebateUSD]").val(RebateUSD);

  var RebateVND =
    this.unformatCurrencyValue(AmountVND) -
    this.unformatCurrencyValue(CustomerAmountVND);
  RebateVND = this.formatCurrencyValue(RebateVND, false, "VND");
  row.find(".rebate_vnd[name*=RebateVND]").val(RebateVND);

  this.setTotalRebate();
};
ItemList.prototype.resestNumberSTT = function () {
  var no = 1;
  this.root.find("tr[data-row] .stt").each(function () {
    $(this).text(no);
    no++;
  });
};
ItemList.prototype.addRemoveListItems = function () {
  var _this = this;
  var table = $("#itemList table");
  var checked = table.find('input:checked:not(".cb-all")').closest("tr");
  console.log({checked})
  if (checked.length > 0) {
    $.alerts.confirm(
      "Are you sure you want to delete?",
      "Confirm",
      function (r) {
        if (r) {
          $.ajax(checked.remove())
            .then(() => _this.setTotalRebate())
            .then(() => {
              
              _this.removeRows(checked,table);
              _this.resestNumberSTT();
              // trigger calculator total cost
              // table.find("[data-row="+key+"]").find("[name*=Bank_Cost]").change();
            });

          table.find(".cb-all").prop("checked", false);
        }
      }
    );
  }
};
ItemList.prototype.removeRows = function(checked,table){
  $.each(checked,function(k,v){
      var key = $(v).data("row");
      table.find("[data-row=" + key + "]").remove();
  })
}
ItemList.prototype.setTotalRebate = function () {
  this.setTotalRebateByCurrency("USD");
  this.setTotalRebateByCurrency("VND");
};
ItemList.prototype.setTotalRebateByCurrency = function (currency = "USD") {
  var _this = this;
  var input = $("#rebateUSD");
  if (currency == "VND") input = $("#rebateVND");
  var amount = 0;
  var lower_currency = currency.toLowerCase();
  this.root
    .find(".rebate_" + lower_currency + "[name*=Rebate" + currency + "]")
    .each(function () {
      var value = $(this).val();
      value = _this.unformatCurrencyValue(value);
      amount += value;
    });
  amount = this.formatCurrencyValue(amount);
  input.val(amount);
};

ItemList.prototype.toggleRowItem = async function (el) {
  var isPlus = $(el).hasClass("fa-plus-circle");
  var row = $(el).closest("tr");
  var removeRow = 0;
  var index = row.index() - removeRow;
  var key = row.data("row");
  var mode = isPlus ? "minimize" : "full";
  var id = row.data("id");
  console.log({ index });
  var html = await this.send({ mode, id, key }, "importPart", { html: true });
  $("#itemList tbody tr").eq(index).after(html);

  // remove old part
  $("#itemList tbody tr").eq(index).remove();
  if (isPlus == false)
    $("#itemList tbody tr")
      .eq(index + 1)
      .remove();
};
ItemList.prototype.toggleListItem = async function (el) {
  var isPlus = $(el).hasClass("fa-plus-circle");
  var mode = "full";
  var id = $("#id").val();
  var len = $("#itemList").find("tbody tr").length;
  var numberProcess = parseInt(len / 10);
  if (isPlus) {
    $(el).closest("th").html('<i class="fa fa-minus-circle btn-collapse"></i>');
    mode = "minimize";
  } else {
    $(el).closest("th").html('<i class="fa fa-plus-circle btn-collapse"></i>');
  }

  var html = "";
  var index = 0;
  var closeLoading = false;

  while (len != 0) {
    var limit = len > 10 ? 10 : len;
    len = limit == 10 ? len - limit : 0;
    if (len == 0) closeLoading = true;
    html += await this.send({ mode, id, limit, index }, "importList", {
      html: true,
      numberProcess: numberProcess,
      closeLoading: closeLoading,
    });
    index += limit;

    numberProcess--;
  }

  $(".notiLoading").hide();
  $("#itemList tbody").remove();
  $("#itemList table").append("<tbody>" + html + "</tbody>");
};

$(document).ready(function ($) {
  // customer sale contract
  var csc = new CustomerSalesContract("#info-order");
  csc.addEventListener();

  // InfoOrder
  var io = new InfoOrder("#info-order");
  io.addEventListener();

  // add invoice event
  var inv = new Invoice("#mainTable-customer_sales_contract");
  inv.addEventListener();
  inv.displayBtnRemove();

  // itemList
  var itl = new ItemList("#itemList");
  itl.addEventListener();

  $("#submitBtn").on("click", function () {
    var flag = false;
    var customerID = $("#CustomerID").val();
    var currency = $("#Currency").val().toLowerCase();
    var total = parseFloat(
      $(".total-" + currency)
        .val()
        .replace(/\s/g, "")
        .replace(/,/g, "")
    );
    if ($("#id").val() == "") {
      total = parseFloat(
        $("#RestPayment").val().replace(/\s/g, "").replace(/,/g, "")
      );
    }
    console.log(total);
    $.ajax({
      url: site_url + $("#act").val() + "/get_debt",
      type: "POST",
      cache: false,
      data: {
        CustomerID: customerID,
      },
      success: function (string) {
        var getData = $.parseJSON(string);
        var curDebt = parseFloat(getData.Debt) + total;
        var debtLimit = parseFloat(getData.DebtLimit);
        if (curDebt > debtLimit) {
          flag = true;
        }

        if (flag) {
          $.alerts.confirm(
            "Order value and total debt are greater than the debt limit.<br>Are you sure to create an order?",
            "Confirm",
            function (e) {
              if (e) {
                $("#updateFrm").submit();
              }
            }
          );
          return false;
        }
        $("#updateFrm").submit();
      },
    });
    return false;
  });

  $("#VAT").bind("change", updateDataSum);

  $("#ShippingChargesUSD").bind("change", function () {
    var val = parseFloat($(this).val().replace(/\s/g, "").replace(/,/g, ""));
    var ShippingChargesVND =
      val *
      parseFloat(
        $("#USDExchangeRate").val().replace(/\s/g, "").replace(/,/g, "")
      );
    $("#ShippingChargesVND").val(
      accounting.formatMoney(ShippingChargesVND, "", 0)
    );
    $(this).val(accounting.formatMoney(val, "", 4));
    updateDataSum();
  });

  $("#ShippingChargesVND").bind("change", function () {
    var val = parseFloat($(this).val().replace(/\s/g, "").replace(/,/g, ""));
    var ShippingChargesUSD =
      val /
      parseFloat(
        $("#USDExchangeRate").val().replace(/\s/g, "").replace(/,/g, "")
      );
    $("#ShippingChargesUSD").val(
      accounting.formatMoney(ShippingChargesUSD, "", 4)
    );
    $(this).val(accounting.formatMoney(val, "", 0));
    updateDataSum();
  });

  $("#BankChargesVND").bind("change", function () {
    var val = parseFloat($(this).val().replace(/\s/g, "").replace(/,/g, ""));
    var BankChargesUSD =
      val /
      parseFloat(
        $("#USDExchangeRate").val().replace(/\s/g, "").replace(/,/g, "")
      );
    $("#BankChargesUSD").val(accounting.formatMoney(BankChargesUSD, "", 4));
    $(this).val(accounting.formatMoney(val, "", 0));
    updateDataSum();
  });

  $("#BankChargesUSD").bind("change", function () {
    var val = parseFloat($(this).val().replace(/\s/g, "").replace(/,/g, ""));
    var BankChargesVND =
      val *
      parseFloat(
        $("#USDExchangeRate").val().replace(/\s/g, "").replace(/,/g, "")
      );
    $("#BankChargesVND").val(accounting.formatMoney(BankChargesVND, "", 0));
    $(this).val(accounting.formatMoney(val, "", 4));
    updateDataSum();
  });

  updateDataSum();

  $("body")
    .on("change", ".spqp", function (event) {
      $(this).val(accounting.formatMoney($(this).val(), "", 4));
    })
    .on("change", ".shipped-qty", function () {
      if ($(this).val() > 0) {
        var thisShipped = parseFloat(
          $(this).val().replace(/\s/g, "").replace(/,/g, "")
        );
        var e = $(this).closest("tr");
        var sumShipped = 0;
        var Orqty = parseFloat(
          e.find(".order-qty").val().replace(/\s/g, "").replace(/,/g, "")
        );
        $(e.find(".shipped-qty")).each(function () {
          sumShipped += parseFloat(
            $(this).val().replace(/\s/g, "").replace(/,/g, "")
          );
        });
        if (sumShipped <= Orqty) {
          $(this).val(accounting.formatMoney(thisShipped, "", 0));
        } else {
          $(this).val(0);
          sumShipped = 0;
          $(e.find(".shipped-qty")).each(function () {
            sumShipped += parseFloat(
              $(this).val().replace(/\s/g, "").replace(/,/g, "")
            );
          });
        }
        e.find(".the-rest-qty").val(
          accounting.formatMoney(Orqty - sumShipped, "", 0)
        );
      } else {
        $(this).val(0);
      }
    })
    .on("click", ".btn-list-old", function () {
      var tr = $(this).closest("tr");
      var part = tr.find(".supplier-part").val();
      var qty_spq = tr.find(".spq");
      var spqp = tr.find(".spqp");
      var order_qty = tr.find(".order-qty");
      var unit_price_usd = tr.find(".unit-price-usd");
      var unit_price_vnd = tr.find(".unit-price-vnd");
      $.ajax({
        url: site_url + "customer_sales_contract/list_old",
        type: "POST",
        cache: false,
        data: {
          part: part,
          customerID: $("#CustomerID").val(),
        },
        success: function (string) {
          $("#modal-list-old .modal-body tbody").empty().append(string);
          $("#modal-list-old").modal("show");
          $(".get-info-item").click(function () {
            var tr_item = $(this).closest("tr");
            qty_spq.val(
              accounting.formatMoney(
                parseFloat(
                  tr_item
                    .find(".qty-spq-old")
                    .text()
                    .replace(/\s/g, "")
                    .replace(/,/g, "")
                ),
                "",
                0
              )
            );
            spqp.val(
              accounting.formatMoney(
                parseFloat(
                  tr_item
                    .find(".spqp-old")
                    .text()
                    .replace(/\s/g, "")
                    .replace(/,/g, "")
                ),
                "",
                4
              )
            );
            order_qty.val(
              accounting.formatMoney(
                parseFloat(
                  tr_item
                    .find(".qty-nspq-old")
                    .text()
                    .replace(/\s/g, "")
                    .replace(/,/g, "")
                ),
                "",
                0
              )
            );
            unit_price_usd.val(
              accounting.formatMoney(
                parseFloat(
                  tr_item
                    .find(".nspqp-old")
                    .text()
                    .replace(/\s/g, "")
                    .replace(/,/g, "")
                ),
                "",
                4
              )
            );
            unit_price_vnd.val(
              accounting.formatMoney(
                parseFloat(
                  tr_item
                    .find(".nspqp-old")
                    .text()
                    .replace(/\s/g, "")
                    .replace(/,/g, "")
                ) *
                  parseFloat(
                    $("#USDExchangeRate")
                      .val()
                      .replace(/\s/g, "")
                      .replace(/,/g, "")
                  ),
                "",
                0
              )
            );
            updateDataItem(tr);
            updateDataSum();
            showNoti("Supplier Part Number: " + part, "Update completed", "Ok");
          });
        },
      });
    })
    .on("change", "#NumberOfDepositPayment", function () {
      var val = $(this).val();
      var parent = $("[data-gDP]");
      parent.attr("data-gDP", val);
      parent.find(".gDP:hidden").find(".bootstrap-datepicker").val("");
      parent.find(".gDP:hidden").find(".depositpayment").val(0);
      var totalDP = 0.0;
      var total = 0.0;
      var currency = $("#Currency").val();
      if (currency == "USD") {
        total = parseFloat(
          $("input.total-usd").val().replace(/\s/g, "").replace(/,/g, "")
        );

        if ($(".gDP")) {
          parent.find(".gDP").each(function () {
            totalDP += parseFloat(
              $(this)
                .find(".depositpayment")
                .val()
                .replace(/\s/g, "")
                .replace(/,/g, "")
            );
          });
        }
        if (totalDP > total) {
          showNoti("Deposit Payment lớn hơn total", "Lỗi tính toán", "Err");
          $(this).val(accounting.formatMoney(0, "", 2));
          $("#RestPayment").val(accounting.formatMoney(0, "", 2));
          return false;
        }
        $("#RestPayment").val(accounting.formatMoney(total - totalDP, "", 2));
      }
      if (currency == "VND") {
        total = parseFloat(
          $("input.total-vnd").val().replace(/\s/g, "").replace(/,/g, "")
        );

        if ($(".gDP")) {
          parent.find(".gDP").each(function () {
            totalDP += parseFloat(
              $(this)
                .find(".depositpayment")
                .val()
                .replace(/\s/g, "")
                .replace(/,/g, "")
            );
          });
        }
        if (totalDP > total) {
          showNoti("Deposit Payment lớn hơn total", "Lỗi tính toán", "Err");
          $(this).val(accounting.formatMoney(0, "", 0));
          $("#RestPayment").val(accounting.formatMoney(0, "", 0));
          return false;
        }
        $("#RestPayment").val(accounting.formatMoney(total - totalDP, "", 0));
      }
    })
    .on("change", ".depositpayment", function () {
      var thisInp = $(this);
      var val = $(this).val();
      var parent = $("[data-gDP]");
      var totalDP = 0.0;
      var total = 0.0;
      var currency = $("#Currency").val();
      if (currency == "USD") {
        total = parseFloat(
          $("input.total-usd").val().replace(/\s/g, "").replace(/,/g, "")
        );
        thisInp.val(accounting.formatMoney(val, "", 2));
        if ($(".gDP")) {
          parent.find(".gDP").each(function () {
            totalDP += parseFloat(
              $(this)
                .find(".depositpayment")
                .val()
                .replace(/\s/g, "")
                .replace(/,/g, "")
            );
          });
        }
        if (totalDP > total) {
          showNoti("Deposit Payment lớn hơn total", "Lỗi tính toán", "Err");
          thisInp.val(0);
          totalDP = 0.0;
          parent.find(".gDP").each(function () {
            totalDP += parseFloat(
              $(this)
                .find(".depositpayment")
                .val()
                .replace(/\s/g, "")
                .replace(/,/g, "")
            );
          });
        }
        $("#RestPayment").val(accounting.formatMoney(total - totalDP, "", 2));
      }
      if (currency == "VND") {
        total = parseFloat(
          $("input.total-vnd").val().replace(/\s/g, "").replace(/,/g, "")
        );
        thisInp.val(accounting.formatMoney(val, "", 0));
        if ($(".gDP")) {
          parent.find(".gDP").each(function () {
            totalDP += parseFloat(
              $(this)
                .find(".depositpayment")
                .val()
                .replace(/\s/g, "")
                .replace(/,/g, "")
            );
          });
        }
        if (totalDP > total) {
          showNoti("Deposit Payment lớn hơn total", "Lỗi tính toán", "Err");
          thisInp.val(0);
          totalDP = 0.0;
          parent.find(".gDP").each(function () {
            totalDP += parseFloat(
              $(this)
                .find(".depositpayment")
                .val()
                .replace(/\s/g, "")
                .replace(/,/g, "")
            );
          });
        }
        $("#RestPayment").val(accounting.formatMoney(total - totalDP, "", 0));
      }
    });
});
/* #Ready */

function updateDataSum() {
  var sumTotal = 0.0;
  var sumTotalUSD = 0.0;
  var total = 0.0;
  var totalUSD = 0.0;
  var VAT = 0.0;
  var sumVAT = 0.0;
  var sumVATUSD = 0.0;
  var ship = 0.0;
  var bank = 0.0;
  var usd_currency = parseFloat(
    $("#USDExchangeRate").val().replace(/\s/g, "").replace(/,/g, "")
  );
  if ($(".amount-vnd").length > 0) {
    $(".amount-vnd").each(function () {
      sumTotal += parseFloat(
        $(this).val().replace(/\s/g, "").replace(/,/g, "")
      );
    });
    $(".amount-usd").each(function () {
      sumTotalUSD += parseFloat(
        $(this).val().replace(/\s/g, "").replace(/,/g, "")
      );
    });
    shipUSD = parseFloat(
      $("#ShippingChargesUSD").val().replace(/\s/g, "").replace(/,/g, "")
    );
    ship = parseFloat(
      $("#ShippingChargesVND").val().replace(/\s/g, "").replace(/,/g, "")
    );
    $("#ShippingChargesUSD").val(accounting.formatMoney(shipUSD, "", 2));
    $("#ShippingChargesVND").val(accounting.formatMoney(ship, "", 0));
    bankUSD = parseFloat(
      $("#BankChargesUSD").val().replace(/\s/g, "").replace(/,/g, "")
    );
    bank = parseFloat(
      $("#BankChargesVND").val().replace(/\s/g, "").replace(/,/g, "")
    );
    $("#BankChargesUSD").val(accounting.formatMoney(bankUSD, "", 2));
    $("#BankChargesVND").val(accounting.formatMoney(bank, "", 0));
    $(".sub-total-usd").val(accounting.formatMoney(sumTotalUSD, "", 2));
    $("#SubTotalVND").val(accounting.formatMoney(sumTotal, "", 0));
    VAT = parseFloat($("#VAT").val().replace(/\s/g, "").replace(/,/g, ""));
    sumVAT = (sumTotal * VAT) / 100;
    sumVATUSD = (sumTotalUSD * VAT) / 100;
    $(".vat-usd").val(accounting.formatMoney(sumVATUSD, "", 2));
    $("#VATVND").val(accounting.formatMoney(sumVAT, "", 0));
    total = sumTotal + sumVAT + ship + bank;
    totalUSD = sumTotalUSD + sumVATUSD + shipUSD + bankUSD;
    $(".total-usd").val(accounting.formatMoney(totalUSD, "", 2));
    $("#TotalVND").val(accounting.formatMoney(total, "", 0));
  } else {
    $("#SubTotalVND").val(0);
    $(".sub-total-usd").val(accounting.formatMoney(0, "", 2));
    $(".total-usd").val(accounting.formatMoney(0, "", 2));
    $("#TotalVND").val(0);
    $(".vat-usd").val(accounting.formatMoney(0, "", 2));
    $("#VATVND").val(0);
    $("#ShippingChargesUSD").val(accounting.formatMoney(0, "", 2));
    $("#ShippingChargesVND").val(0);
    $("#BankChargesUSD").val(accounting.formatMoney(0, "", 2));
    $("#BankChargesVND").val(0);
  }
  $("#DepositPayment1").trigger("change");
}

function updateDataItem(e) {
  var Orqty = parseFloat(
    e.find(".order-qty").val().replace(/\s/g, "").replace(/,/g, "")
  );
  if (Orqty < 0) {
    Orqty = 0;
  }
  var priceUSD = parseFloat(
    e.find(".unit-price-usd").val().replace(/\s/g, "").replace(/,/g, "")
  );
  var priceVND = parseFloat(
    e.find(".unit-price-vnd").val().replace(/\s/g, "").replace(/,/g, "")
  );
  var amountVND = Orqty * priceVND;
  e.find(".amount-usd").val(accounting.formatMoney(Orqty * priceUSD, "", 2));
  e.find(".amount-vnd").val(accounting.formatMoney(amountVND, "", 0));
  updateDataSum();
}
