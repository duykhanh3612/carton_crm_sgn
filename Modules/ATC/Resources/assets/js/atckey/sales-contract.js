class SalesContract {
  constructor(el) {
    this.body = $("body");
    this.root = $(el);
  }
}
SalesContract.prototype.send = function (data, url, option = {}) {
  return new Promise((resolve, reject) => {
    $.ajax({
      url: "sales_contract/" + url,
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
        SalesContract.removeLoading();
        reject({});
      },
    });
  });
};
SalesContract.prototype.addEventListener = function () {
  var _this = this;
  this.body
    .on("click", ".part-show-hide", function () {
      _this.partDisplayOptions();
    })
    .on("submit", "#colsModal form.part-main-form", function () {
      _this.submitPartDisplayOptions();
    })
    .on("click", "[data-btn=del_config]", function () {
      _this.removeConfig(this);
    })
    .on("click", "#submitBtnEdit", function () {
      _this.clickSubmitEdit();
    })
    .on("change", "#TotalUSD,[name=level]", function () {
      _this.changeTotalUSD();
    })
    .on("change","#VendorNumber",function(){
      _this.openCodeByVendor(this);
    });
};
SalesContract.prototype.openCodeByVendor = async function(el){
  var vendor = $(el).val();
  var result = await this.send({vendor},'checkVendorCode');
  
  console.log(result);
  if(result == "true"){
    $("#code").removeAttr("readonly");
    $("#code").css("background","#C8E6C9");
    return;
  }
  var hasReadOnly = $("#code").attr("readonly");
  if(!hasReadOnly){
    $("#code").attr("readonly",true);
  }
  $("#code").css("background","#ccc");
}
SalesContract.prototype.changeTotalUSD = function () {
  var mode = this.validLimitAmount() ? "update" : "edit";
  this.cloneBtnUpdate(mode);
  if (mode == "edit") {
    $("#approved").closest(".div-table").remove();
  }
};
SalesContract.prototype.clickSubmitEdit = function () {
  if (this.validLimitAmount()) {
    this.cloneBtnUpdate("update");
    setTimeout(() => {
      $("#submitBtn").click();
    }, 200);
  } else {
    this.scrollTopSmooth("[name=level]");
    showNoti(
      "SC with total amount over 10,000 USD requires more than one people to approve",
      "Update failed",
      "Err"
    );
  }
};
SalesContract.prototype.validLimitAmount = function () {
  var amount = $("#TotalUSD").val();
  var amount1 = accounting.unformat(amount);
  var isAboveAmount = accounting.unformat(amount) > 10000;
  var hadID = $("#id").val() != "";
  var hadOneApprover = $("[name=level]").val() > 0 == false;
  console.log({ isAboveAmount, hadOneApprover, amount, amount1 });
  if (isAboveAmount && hadOneApprover && hadID) {
    console.log("above 10000");
    return false;
  }
  console.log("under 10000");
  return true;
};
SalesContract.prototype.scrollTopSmooth = function (el) {
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
SalesContract.prototype.cloneBtnUpdate = function (mode = "edit") {
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
SalesContract.prototype.get_info_Currency = function (el) {
  var val = $(el).val();
  $("#Rates_lable").html(val);

  if (val == "USD") {
    $("#PORates").val(accounting.formatMoney(1, "", 2));
  } else if (val == "VND") {
    $(".col-unit_price_vnd").show();
    $(".col-unit_price_vnd").show();
    $(".col-end_user_price_vnd").show();
    $(".col-selling_amount_vnd").show();
  } else if (val == "RMB") {
    $(".col-unit_price_rmb").show();
    $(".col-amount_rmb").show();
    $(".col-end_user_price_rmb").show();
    $(".col-selling_amount_rmb").show();
    $(".currency_vnd").hide();
    $(".col-unit_price_eur").hide();
    $(".col-amount_eur").hide();
    $(".col-end_user_price_eur").hide();
    $(".col-selling_amount_eur").hide();
  } else if (val == "EUR") {
    $(".col-unit_price_eur").show();
    $(".col-amount_eur").show();
    $(".col-end_user_price_eur").show();
    $(".col-selling_amount_eur").show();
    $(".currency_vnd").hide();
    $(".col-unit_price_rmb").hide();
    $(".col-amount_rmb").hide();
    $(".col-end_user_price_rmb").hide();
    $(".col-selling_amount_rmb").hide();
  }
};
SalesContract.prototype.removeConfig = async function (el) {
  var id = $(el).data("id");
  var res = await this.send({ id }, "removeConfig", { removeLoading: true });
  if (res) {
    window.location.reload();
  }
};
SalesContract.prototype.partDisplayOptions = async function () {
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

SalesContract.prototype.createDragTasks = function (name) {
  $("#" + name).tableDnD();
};
SalesContract.prototype.submitPartDisplayOptions = async function () {
  var data = $("#colsModal form.part-main-form").serialize();
  var res = await this.send(data, "update_cols");
  if (res) {
    window.location = window.location;
  }
};

$(document).ready(function ($) {
  var sc = new SalesContract();
  sc.addEventListener();

  $("#VAT").bind("change", updateDataSum);

  $("#DiscountVND").bind("change", function () {
    var val = parseInt($(this).val().replace(/\s/g, "").replace(/,/g, ""));
    var DiscountUSD =
      val /
      parseInt(
        $("#USDExchangeRate").val().replace(/\s/g, "").replace(/,/g, "")
      );
    $("#DiscountUSD").val(accounting.formatMoney(DiscountUSD, "", 4));
    $(this).val(accounting.formatMoney(val, "", 0));
    updateDataSum();
  });

  $("#DiscountUSD").bind("change", function () {
    var val = parseFloat($(this).val().replace(/\s/g, "").replace(/,/g, ""));
    var DiscountVND =
      val *
      parseInt(
        $("#USDExchangeRate").val().replace(/\s/g, "").replace(/,/g, "")
      );
    $("#DiscountVND").val(accounting.formatMoney(DiscountVND, "", 0));
    $(this).val(accounting.formatMoney(val, "", 4));
    updateDataSum();
  });

  $("#OtherCostVND").bind("change", function () {
    var val = parseInt($(this).val().replace(/\s/g, "").replace(/,/g, ""));
    var OtherCostUSD =
      val /
      parseInt(
        $("#USDExchangeRate").val().replace(/\s/g, "").replace(/,/g, "")
      );
    $("#OtherCostUSD").val(accounting.formatMoney(OtherCostUSD, "", 4));
    $(this).val(accounting.formatMoney(val, "", 0));
    updateDataSum();
  });

  $("#OtherCostUSD").bind("change", function () {
    var val = parseFloat($(this).val().replace(/\s/g, "").replace(/,/g, ""));
    var OtherCostVND =
      val *
      parseInt(
        $("#USDExchangeRate").val().replace(/\s/g, "").replace(/,/g, "")
      );
    $("#OtherCostVND").val(accounting.formatMoney(OtherCostVND, "", 0));
    $(this).val(accounting.formatMoney(val, "", 4));
    updateDataSum();
  });

  $("#FreightChargeVND").bind("change", function () {
    var val = parseInt($(this).val().replace(/\s/g, "").replace(/,/g, ""));
    var FreightChargeUSD =
      val /
      parseInt(
        $("#USDExchangeRate").val().replace(/\s/g, "").replace(/,/g, "")
      );
    $("#FreightChargeUSD").val(accounting.formatMoney(FreightChargeUSD, "", 4));
    $(this).val(accounting.formatMoney(val, "", 0));
    updateDataSum();
  });

  $("#FreightChargeUSD").bind("change", function () {
    var val = parseFloat($(this).val().replace(/\s/g, "").replace(/,/g, ""));
    var FreightChargeVND =
      val *
      parseInt(
        $("#USDExchangeRate").val().replace(/\s/g, "").replace(/,/g, "")
      );
    $("#FreightChargeVND").val(accounting.formatMoney(FreightChargeVND, "", 0));
    $(this).val(accounting.formatMoney(val, "", 4));
    updateDataSum();
  });

  updateDataSum();

  $("body")
    .on("click", ".btn-list-old", function () {
      var tr = $(this).closest("tr");
      var mfrPart = tr.find(".mfr-part").val();
      var orderqty = tr.find(".order-qty");
      var unitprice = tr.find(".unit-price-usd");
      $.ajax({
        url: site_url + $("#act").val() + "/list_old",
        type: "POST",
        cache: false,
        data: { mfrPart: mfrPart },
        success: function (string) {
          $("#modal-list-old .modal-body tbody").empty().append(string);
          $("#modal-list-old").modal("show");
          $(".get-info-item").click(function () {
            var tr_item = $(this).closest("tr");
            orderqty.val(
              accounting.formatMoney(
                parseFloat(
                  tr_item
                    .find(".orderqty")
                    .text()
                    .replace(/\s/g, "")
                    .replace(/,/g, "")
                ),
                "",
                0
              )
            );
            unitprice.val(
              accounting.formatMoney(
                parseFloat(
                  tr_item
                    .find(".unitprice")
                    .text()
                    .replace(/\s/g, "")
                    .replace(/,/g, "")
                ),
                "",
                4
              )
            );
            showNoti("Mfr Part Number: " + mfrPart, "Cập nhật hoàn tất", "Ok");
            updateDataItem(tr);
            updateDataSum();
          });
        },
      });
    })
    .on("change", ".shipped-qty", function () {
      var thisShipped = parseFloat(
        $(this).val().replace(/\s/g, "").replace(/,/g, "")
      );
      var e = $(this).closest("tr");
      var sumShipped = 0;
      var Orqty = parseFloat(
        e.find(".order-qty").val().replace(/\s/g, "").replace(/,/g, "")
      );
      if ($(this).val() >= 0) {
        $(e.find(".shipped-qty")).each(function () {
          sumShipped += parseFloat(
            $(this).val().replace(/\s/g, "").replace(/,/g, "")
          );
        });
      } else {
        $(this).val(0);
        sumShipped = 0;
        $(e.find(".shipped-qty")).each(function () {
          sumShipped += parseFloat(
            $(this).val().replace(/\s/g, "").replace(/,/g, "")
          );
        });
      }
      if (sumShipped > 0 && sumShipped <= Orqty && $(this).val() > 0) {
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
    })
    .on("change", "#NumberOfShipment", function () {
      var val = $(this).val();
      $("[data-shipped]").attr("data-shipped", val);
      anrDataRequired();
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
      if (currency == "RMB") {
        total = parseFloat(
          $("input#TotalRMB").val().replace(/\s/g, "").replace(/,/g, "")
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
      if (currency == "EUR") {
        total = parseFloat(
          $("input#TotalEUR").val().replace(/\s/g, "").replace(/,/g, "")
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
        console.log("TCL: totalDP", parseFloat(totalDP));
        totalDP = 0;
        if ($(".gDP").length) {
          parent.find(".gDP").each(function () {
            $depo = parseFloat(
              $(this)
                .find(".depositpayment")
                .val()
                .replace(/\s/g, "")
                .replace(/,/g, "")
            );
            if ($depo > 0) {
              console.log("TCL: gDP", $depo);
              totalDP = totalDP + $depo;
            }
          });
        }
        totalDP = parseFloat(
          accounting
            .formatMoney(totalDP, "", 2)
            .replace(/\s/g, "")
            .replace(/,/g, "")
        );

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
      if (currency == "RMB") {
        total = parseFloat(
          $("input#TotalRMB").val().replace(/\s/g, "").replace(/,/g, "")
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
      if (currency == "EUR") {
        total = parseFloat(
          $("input#TotalEUR").val().replace(/\s/g, "").replace(/,/g, "")
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
/* # Ready */

function updateDataSum() {
  var exchange_rate = parseInt(
    $("#USDExchangeRate").val().replace(/\s/g, "").replace(/,/g, "")
  );
  var sumTotal = 0.0;
  var sumTotalVND = 0.0;
  var sumTotalRMB = 0.0;
  var sumTotalEUR = 0.0;
  var total = 0.0;
  var totalvnd = 0.0;
  var totalRMB = 0.0;
  var totalEUR = 0.0;
  var VAT = 0.0;
  var sumVAT = 0.0;
  var sumVATVND = 0.0;
  var sumVATRMB = 0.0;
  var sumVATEUR = 0.0;
  var DiscountUSD = 0.0;
  var OtherCostUSD = 0.0;
  var FreightChargeUSD = 0.0;
  var OtherCostEUR = 0.0;
  var FreightChargeEUR = 0.0;
  var OtherCostRMB = 0.0;
  var FreightChargeRMB = 0.0;
  if ($(".amount-usd").length) {
    $(".amount-usd").each(function () {
      sumTotal += parseFloat(
        $(this).val().replace(/\s/g, "").replace(/,/g, "")
      );
    });
    $(".amount-vnd").each(function () {
      sumTotalVND += parseFloat(
        $(this).val().replace(/\s/g, "").replace(/,/g, "")
      );
    });
    $(".amount-rmb").each(function () {
      sumTotalRMB += parseFloat(
        $(this).val().replace(/\s/g, "").replace(/,/g, "")
      );
    });
    $(".amount-eur").each(function () {
      sumTotalEUR += parseFloat(
        $(this).val().replace(/\s/g, "").replace(/,/g, "")
      );
    });
    if ($("#DiscountVND").length) {
      DiscountUSD = parseFloat(
        $("#DiscountUSD").val().replace(/\s/g, "").replace(/,/g, "")
      );
      $("#DiscountVND").val(
        accounting.formatMoney(DiscountUSD * exchange_rate, "", 0)
      );
      $("#DiscountUSD").val(accounting.formatMoney(DiscountUSD, "", 2));
    }
    if ($("#FreightChargeUSD").length) {
      FreightChargeUSD = parseFloat(
        $("#FreightChargeUSD").val().replace(/\s/g, "").replace(/,/g, "")
      );
      $("#FreightChargeVND").val(
        accounting.formatMoney(FreightChargeUSD * exchange_rate, "", 0)
      );
      $("#FreightChargeUSD").val(
        accounting.formatMoney(FreightChargeUSD, "", 2)
      );
    }

    OtherCostUSD = parseFloat(
      $("#OtherCostUSD").val().replace(/\s/g, "").replace(/,/g, "")
    );
    OtherCostEUR = parseFloat(
      $("#OtherCostEUR").val().replace(/\s/g, "").replace(/,/g, "")
    );
    OtherCostRMB = parseFloat(
      $("#OtherCostRMB").val().replace(/\s/g, "").replace(/,/g, "")
    );
    FreightChargeEUR = parseFloat(
      $("#FreightChargeEUR").val().replace(/\s/g, "").replace(/,/g, "")
    );
    FreightChargeRMB = parseFloat(
      $("#FreightChargeRMB").val().replace(/\s/g, "").replace(/,/g, "")
    );
    // DiscountEUR = parseFloat($('#DiscountUSD').val().replace(/\s/g, '').replace(/,/g, ''));
    // DiscountRMB = parseFloat($('#DiscountUSD').val().replace(/\s/g, '').replace(/,/g, ''));

    $("#OtherCostVND").val(
      accounting.formatMoney(OtherCostUSD * exchange_rate, "", 0)
    );
    $("#OtherCostUSD").val(accounting.formatMoney(OtherCostUSD, "", 2));
    $("#SubTotalVND").val(accounting.formatMoney(sumTotalVND, "", 0));
    $("#SubTotalUSD").val(accounting.formatMoney(sumTotal, "", 2));
    $("#SubTotalRMB").val(accounting.formatMoney(sumTotalRMB, "", 2));
    $("#SubTotalEUR").val(accounting.formatMoney(sumTotalEUR, "", 2));
    VAT = parseFloat($("#VAT").val().replace(/\s/g, "").replace(/,/g, ""));
    sumVATEUR = (sumTotalEUR * VAT) / 100;
    sumVATRMB = (sumTotalRMB * VAT) / 100;
    sumVAT = (sumTotal * VAT) / 100;
    sumVATVND = (sumTotal * exchange_rate * VAT) / 100;
    $(".vat-vnd").val(accounting.formatMoney(sumVAT * exchange_rate, "", 0));
    $("#VATTaxUSD").val(accounting.formatMoney(sumVAT, "", 2));
    total = sumTotal + sumVAT + OtherCostUSD - DiscountUSD + FreightChargeUSD;
    totalEUR = sumTotalEUR + sumVATEUR + OtherCostEUR + FreightChargeEUR;
    totalRMB = sumTotalRMB + sumVATRMB + OtherCostRMB + FreightChargeRMB;
    totalvnd =
      sumTotalVND +
      sumVATVND +
      OtherCostUSD * exchange_rate +
      DiscountUSD * exchange_rate +
      FreightChargeUSD * exchange_rate;
    $("#TotalVND").val(accounting.formatMoney(totalvnd, "", 0));
    $("#TotalUSD").val(accounting.formatMoney(total, "", 2));
    $("#TotalEUR").val(accounting.formatMoney(totalEUR, "", 2));
    $("#TotalRMB").val(accounting.formatMoney(totalRMB, "", 2));
  } else {
    $("#SubTotalUSD").val(accounting.formatMoney(0, "", 2));
    $("#SubTotalVND").val(0);
    $(".vat-vnd").val(0);
    $("#VATTaxUSD").val(accounting.formatMoney(0, "", 2));
    $("#DiscountUSD").val(accounting.formatMoney(0, "", 2));
    $("#DiscountVND").val(0);
    $("#OtherCostUSD").val(accounting.formatMoney(0, "", 2));
    $("#OtherCostVND").val(0);
    $("#FreightChargeUSD").val(accounting.formatMoney(0, "", 2));
    $("#FreightChargeVND").val(0);
    $("#TotalUSD").val(accounting.formatMoney(0, "", 2));
    $("#TotalVND").val(0);
  }
  $("#TotalUSD").change();
  var depositpayment = 0;
  if ($(".depositpayment").length) {
    $(".depositpayment").each(function () {
      depositpayment += parseFloat($(this).val().replace(/,/g, ""));
    });
  }

  depositpayment = parseFloat(
    accounting
      .formatMoney(depositpayment, "", 2)
      .replace(/\s/g, "")
      .replace(/,/g, "")
  );
  if ($("#Currency").val() == "USD") {
    $("#RestPayment").val(
      accounting.formatMoney(total - depositpayment, "", 2)
    );
  } else if ($("#Currency").val() == "EUR") {
    $("#RestPayment").val(
      accounting.formatMoney(totalEUR - depositpayment, "", 0)
    );
  } else if ($("#Currency").val() == "RMB") {
    $("#RestPayment").val(
      accounting.formatMoney(totalRMB - depositpayment, "", 0)
    );
  } else {
    $("#RestPayment").val(
      accounting.formatMoney(totalvnd - depositpayment, "", 0)
    );
  }
}

function updateDataItem(e) {
  var Orqty = parseInt(
    e.find(".order-qty").val().replace(/\s/g, "").replace(/,/g, "")
  );
  if (Orqty < 0) {
    Orqty = 1;
  }
  var priceUSD = parseFloat(
    e.find(".unit-price-usd").val().replace(/\s/g, "").replace(/,/g, "")
  );
  var priceVND = parseFloat(
    accounting
      .formatMoney(
        priceUSD *
          parseInt(
            $("#USDExchangeRate").val().replace(/\s/g, "").replace(/,/g, "")
          ),
        "",
        0
      )
      .replace(/\s/g, "")
      .replace(/,/g, "")
  );
  var amountUSD = Orqty * priceUSD;
  var amountVND = Orqty * priceVND;
  e.find(".amount-usd").val(accounting.formatMoney(amountUSD, "", 2));
  e.find(".amount-vnd").val(amountVND);
  updateDataSum();
}
$("#importModal").on("show.bs.modal", function () {
  if ($("#CustomerPONo").val() == "") {
    $("#importModal").modal("hide");
    if ($("#info-order").hasClass("in")) {
      $("#CustomerPONo").select2("open");
    }
    showNoti("Customer PO No không được bỏ trống", "Cảnh báo", "War");
    return false;
  }
});
function escapeHtml(text) {
  var map = {
    "&": "&amp;",
    "<": "&lt;",
    ">": "&gt;",
    '"': "&quot;",
    "'": "&#039;",
  };

  return text.replace(/[&<>"']/g, function (m) {
    return map[m];
  });
}
