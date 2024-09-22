class Customer_request_pickup {
    constructor(el ='#nav-tabContent') {
        this.body = $("body");
        this.id = this.body.find("#id").val();
        this.root = $(el);
    }
    afterLoaded() {
        Customer_request_pickup.removeLoading();
    }
    addEventListener() {
        var _this = this;
        $(".group-process").on("click", "#removeRowPart", function () {
            _this.addRemoveListItems();
        }).on("click", ".btn-info.waves-effect", function () {
            var mt = new MainTable();
            mt.insertPart(this);
        })

        this.body.on("focus", "input[data-type=currency],input[data-type=currency_unit],input[data-type=kgs]", function () {
            _this.unformatCurrency(this)
        }).on("blur", "input[data-type=currency]", function () {
            _this.formatCurrency(this)
        }).on("click", ".btn-add-cpo", function (e) {
            e.preventDefault()
            e.stopPropagation()
            _this.addCPo(this);
        })
        .on("blur", "input[data-type=currency_unit]", function () {
            _this.formatCurrency(this, true)
        }).on("blur", "input[data-type=kgs]", function () {
            _this.formatWeight(this)
        }).on("click", "#submitBtnEdit", function () {
            $("a[href=#info-request].collapsed").click();
            _this.scrollTopSmooth($("#attribution"));
            // alert edit
            showNoti('Please press the Execute cost button before pressing the UPDATE button', "Warning edit data", "War");
        }).on("click",".btn-remove-cpo",function(){
            _this.removeCPO(this)
        }).on("click","input[type=checkbox]",function(){
            _this.changeCheckBox(this)
        })


        
        $("#cpo-information").on("change","select.CustomerPONo",function(){
            _this.changeCPO(this)
        }).on("change","select.CSCNo",function(){
            _this.changeCSC(this)
        })



        // render currency
        this.body.find("input.currency").each(function(){
            _this.formatCurrency(this)
        })
        this.body.find("input.currency_unit").each(function(){
            _this.formatCurrency(this,true)
        })
    }

    static async removeLoading() {
        $("#loading-animated").removeClass("yt-loader");
    }
    static addLoading() {
        $("#loading-animated").addClass("yt-loader");
    }
}

Customer_request_pickup.prototype.changeCheckBox = function(el){
    var isChecked = $(el).prop('checked');
    var value = isChecked ? 1 : 0;
    $(el).val(value);
}
Customer_request_pickup.prototype.changeCSC = async function (el) {
    var value = $(el).val();
    var form_groups = $(el).closest(".fg-po");
    var index = form_groups.index();
    var data = await this.send({ id: value }, 'getCSC');
    if(data.invoice.length!=0){
        var html = this.getSelectInvoiceHtml(data.invoice, index);

        form_groups.find(".invoice").html(html).find(".select2").select2();

        // set first date invoice
        data.InvoiceDate = data.invoice[0].InvoiceDate;

        delete data.invoice;
        
    }
    $.each(data, function (v, k) {
        form_groups.find("input[name*=" + v + "]").val(k);
    })
}
Customer_request_pickup.prototype.getSelectInvoiceHtml = function (data, index){
    var option = '';
    data.forEach(function(v,k){
        option += `<option value="${ v.InvoiceNo }" selected="selected">${ v.InvoiceNo }</option>`;
    })
    var html = `<select name="CO[${index}][Invoice]" class="form-control select2">
                    ${ option }
                </select>`;

    return html;
}
Customer_request_pickup.prototype.changeCPO = async function(el){
    var value = $(el).val();
    var form_groups = $(el).closest(".fg-po");
    form_groups.removeAttr('data-cpo').attr("data-cpo",value);
    form_groups.find("[name=cpoid]").val(value);
    var data = await this.send({ id: value }, 'getCPO');
    console.log({data})
    $.each(data, function (v, k) {
        form_groups.find("input[name*=" + v + "]").val(k);
    })
}
Customer_request_pickup.prototype.removeCPO = function(el){
    $(el).closest(".fg-po").remove();
    this.refreshTableItem()
}
Customer_request_pickup.prototype.addCPo = async function (el) {
    var group_insert = $("#cpo-information").find(".fg-po[data-selected]");
    var key = group_insert.length > 0 ? group_insert.last().data("selected") : 0;
    var index_cpo = group_insert.length +1;
    var html = await this.send({ key, index:index_cpo }, 'importCPO', { html: true })

    // insert first row when group empty
    if (group_insert.length > 0) {
        // group_insert.last().find(".btn-remove-po").addClass("disabled");
        group_insert.last().after(html);

    } else {
        $("#cpo-information").html(html);
    }

    await this.addChosen(el);

    console.log({key})

    await this.addDatePicker(key);

}
Customer_request_pickup.prototype.checkCarry = function(){
    var value = $("#carrier_id").val();
    if(value==1){
        
        showErrOfField('carrier_id', 'carrier_id');
        return false;
    }else{
        return true;
    }
}
Customer_request_pickup.prototype.unformatCurrency = function (el) {

    var value = $(el).val()
    value = this.unformatCurrencyValue(value)

    $(el).val(value)
    return value;
}

Customer_request_pickup.prototype.unformatCurrencyValue = function (value) {

    value = value ? accounting.unformat(value) : 0
    // value = value.replace(/[0-9].-/g,'')
    return value;
}
Customer_request_pickup.prototype.formatWeight = function (el, symbol = 'kgs', normal = true) {

    var value = $(el).val()
    value = this.formatWeightValue(value, symbol = 'kgs', normal = true)

    $(el).val(value)

    return value
}
Customer_request_pickup.prototype.formatWeightValue = function (value, symbol = 'kgs', normal = true) {
    var isInt = round(value) == value;
    var numDigits = isInt ? 0 : 2;
    var pattern = normal ? "%v%s" : "%s%v"

    var options = {
        symbol: symbol,
        decimal: ".",
        thousand: ",",
        precision: numDigits,
        format: pattern
    }
    return (value || value === 0)
        ? accounting.formatMoney(value, options)
        : 0
}
Customer_request_pickup.prototype.formatCurrency = function (el, isUnit = false, currency = 'USD') {

    var value = $(el).val()
    value = this.formatCurrencyValue(value, isUnit, currency)

    $(el).val(value)

    return value
}
Customer_request_pickup.prototype.formatCurrencyValue = function (value, isUnit = false, currency = 'USD') {
    var isInt = round(value) == value;
    var numDigits = isInt ? 0 :
        isUnit ? 4 : 2;
    var symbol = currency == "USD" ? "$" :
        currency == "VND" ? "đ" :
            currency == "EURO" ? "€" : "¥"

    if (currency == "USD" && isUnit == false) numDigits = 2;

    var pattern = currency == "VND" ? "%v%s" : "%s%v"
    var options = {
        symbol: symbol,
        decimal: ".",
        thousand: ",",
        precision: numDigits,
        format: pattern
    }
    return (value || value === 0)
        ? accounting.formatMoney(value, options)
        : 0
}

Customer_request_pickup.prototype.scrollTopSmooth = function (el) {
    // off/on for test

    var top = 0;
    try {
        $(el).focus();
        var pos = $(el).offset();
        var tag = $(el).attr("tagName");
        if (tag == "INPUT") $(el).focus();
        top = pos.top - 150;
    } catch (error) {

    }

    $("html, body").animate({ scrollTop: top }, 1000);

}

Customer_request_pickup.prototype.removePoDuplicate = function (po) {
    var count_po = 0;
    $("#cpo-information .PONo").each(function () {
        if ($(this).val() == po) count_po++;
    })
    var po_insert = $("#cpo-information .PONo").last();
    if (po_insert.val() == po && count_po > 1) po_insert.closest(".fg-po").remove();
}


Customer_request_pickup.prototype.addChosen = function (el = null) {

    var parent = (el != null) ? $(el).closest(".collapse") : $("form");
    parent.find('.select2').chosen({
        placeholder_text_single: 'Select an option',
        no_results_text: "Oops, không tìm thấy!"
    })
    if ($('.chosen-search').length && !$('.chosen-search i').length) {
        $('.chosen-search').append('<i class="glyph-icon icon-search"></i>');
    }
    $('.chosen-single div').html('<i class="glyph-icon icon-caret-down"></i>');

}
Customer_request_pickup.prototype.addDatePicker = function (key) {
    key = key +1;
    // add date picker
    $('#cpo-information [data-selected=' + key + ']').find('.bootstrap-datepicker').datepicker({
        format: 'yyyy-mm-dd',
        language: 'vi',
        autoclose: true,
        todayHighlight: true
    });
}
Customer_request_pickup.prototype.send = function (data, url, option = {}) {
    url = option.ajaxController == true ? url : 'customer_request_pickup/' + url;
    return new Promise((resolve, reject) => {
        $.ajax({
            url: url,
            type: "POST",
            data: data,
            beforeSend: function () {
                showProcess(1);
                Customer_request_pickup.addLoading();
            },
            complete: function () {
                hideLoading();
                Customer_request_pickup.removeLoading();
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
                Customer_request_pickup.removeLoading();
                reject({});
            },
        });
    })
}
Customer_request_pickup.prototype.addRemoveListItems = function () {
    var rp = this;
    var table = $('#itemList table');
    var checked = table.find('input:checked:not(".cb-all")').closest('tr');
    if (checked.length > 0) {

        $.alerts.confirm('Are you sure you want to delete?', 'Confirm', function (r) {
            if (r) {

                $.ajax(checked.remove())
                    .then(() => rp.refreshTableItem()).then(() => {
                        rp.triggerRefreshValuePo(checked, table)

                    });

                table.find('.cb-all').prop('checked', false);

            }
        })
    }

}
Customer_request_pickup.prototype.setStateExecuteBtn = function (mode = "turn") {
    if (mode == "turn") {
        $("#attribution .btn-execute-cost").removeClass("btn-danger").addClass("btn-success").data("edit", false);
        $("#attribution .btn-execute-cost").find("i").removeClass("icon-chevron-left").addClass("icon-check");
        this.cloneBtnUpdate("update");
    }

    if (mode == "off") {
        $("#attribution .btn-execute-cost").removeClass("btn-success").addClass("btn-danger").data("edit", true);
        $("#attribution .btn-execute-cost").find("i").removeClass("icon-check").addClass("icon-chevron-left");
        this.cloneBtnUpdate("edit");
    }


}
Customer_request_pickup.prototype.cloneBtnUpdate = function (mode = "edit") {

    $("#submitBtnEdit").remove();
    $("#submitBtn").remove();

    if (mode == "edit") {

        var span = $("<span>").text("UPDATE");
        var i = $("<i>").addClass("glyph-icon icon-check")
        var button = $("<button>").attr("id", "submitBtnEdit").addClass("btn btn-success btn-alt btn-hover waves-effect").append(span).append(i);
        $(".btnFrm").prepend(button);

    }

    if (mode == "update") {

        var span = $("<span>").text("UPDATE");
        var i = $("<i>").addClass("glyph-icon icon-check")
        var button = $("<button>").attr("id", "submitBtn").addClass("btn btn-success btn-alt btn-hover waves-effect").append(span).append(i);
        $(".btnFrm").prepend(button)
    }
}
Customer_request_pickup.prototype.disabledBtnUpdate = function () {
    if ($("#OrderType").val() == 0) {
        // alert edit
        showNoti('Please press the Execute cost button before pressing the UPDATE button', "Warning edit data", "War");
        // set state execute
        this.setStateExecuteBtn("off");
    }
}
Customer_request_pickup.prototype.triggerRefreshValuePo = function (itemList, table) {
    var list_po = [];
    itemList.each(function () {
        var po = $(this).data("cpo");
        // if(!list_po.indexOf(po)){
        list_po.push(po)
        // }

    })

    list_po.forEach(function (item) {
        var row_po = table.find("[data-cpo=" + item + "]")
        row_po.find("[name*=Bank_Cost]").change();
        row_po.find(".col-quantity [name*=quantity]").trigger("change");
    })


}

Customer_request_pickup.prototype.refreshTableItem = async function () {
    this.disabledBtnUpdate()

    var table = $('#itemList table');
    var data = [];
    // get all cpo on table
    table.find(".footer-group").each(function () {
        data.push($(this).data("cpo"));
    })
    // check exist row or sub row
    var cpoRemove = [];
    await data.forEach(function (v) {
        var len = table.find("[data-cpo=" + v + "].highlightNoClick").length;
        if (len == 0) cpoRemove.push(v)
    })

    // remove group-footer don't have row
    await cpoRemove.forEach(function (v) {
        table.find("[data-cpo=" + v + "]").remove();
    })

    // remove po on maintable
    await cpoRemove.forEach(function (v) {
        $(".btn-po.btn-remove-po").each(function () {
            var selected = $(this).closest(".fg-po").find("select").val();
            if (selected == v) $(this).closest(".fg-po").remove();
        })
    })

    // set number no
    // set row
    var no = 0;
    table.find(".highlightNoClick[data-cpo]").each(function () {
        no++;
        $(this).find("td.col-no").text(no);
    })
    no = 0;
    table.find(".highlightNoClick1[data-cpo]").each(function () {
        no++;
        $(this).find("input.itemKey").val(no);
    })

    //set group
    no = 0;
    table.find(".footer-group[data-cpo]").each(function () {
        no++;
        $(this).find("td").first().text(no + ".");
    })

    if (no == 0) {
        $("#OrderType").removeClass('disabled');
    }

    // reset po index
    no = 0
    $("#cpo-information .label-line").each(function () {
        no++;
        $(this).text(no);
    })

}
class MainTable extends Customer_request_pickup {
    constructor() {

        super("#mainTable-customer_request_pickup")

    }
    static BtnCheckPart(id, did, selectedID) {
        return `<input type="checkbox" name="" class="cb-ele" value="" data-master="${id}" data-detail="${did}" data-selected="${selectedID}" >`;
    }
    addEventListener() {
        var _this = this;
        this.root.on("change", 'select#carrier_id', function () {
            _this.changeSelectCarry(this);
        }).on("change", 'select#CustomerID', function () {
            _this.changeSelectCustomer(this);
            _this.changeCustomerID(this)
        }).on("click", ".btn-insert-part", function () {
            _this.insertPart(this);
        })

    }
}
MainTable.prototype.insertPart = async function (el) {
    var form_groups = $(el).closest(".fg-po");
    var selectedID = form_groups.data("selected");
    var value = form_groups.find("select.CustomerPONo").val();

    // var data = ['PODate', 'ContractNo', 'ContractDate', 'CustomerPONo', 'CPODate', 'ImportMethod'];

    var had_po = $("#OrderType").find("option:checked").val();

    if (had_po == 0) {

        if (!this.validPoSelected(data, form_groups)) return false;

        var data = await this.send({ value }, 'getListPart');

        if (data.length == 0) {
            showNoti("The Mfpart in CPO and PO don't match, please check this CPO and PO again!", "No parts match", "Err");
            return false;
        }

        var html = await this.createInsertPartTable(data, selectedID);
        this.openModelInsertPart(html);
        return true;
    }

    // insert null item
    var mlo = new ModalListOld();
    mlo.addPart();


}
MainTable.prototype.createInsertPartTable = function (data, selectedID) {
    data = JSON.parse(data)
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
        </tr>
        </thead>
        <tbody>`;
    var footer = `</tbody></table></div>`;
    var body = '';
    data.forEach(function (item) {

        body += `<tr>`;
        body += '<td>' + MainTable.BtnCheckPart(item['cpoid'], item['did'], selectedID) + '</td>';

        delete item['cpoid'];
        delete item['did'];

        $.each(item, function (k, v) {
            switch (k) {
                case 'MfrPart':
                    body += `<td>
                    <span class="mfr-part">${v}</span> 
                    <span class="desc" title="${item['Description']}">${item['Description']}</span>
                </td>`;
                    delete item['Description'];

                    break;
                case 'Image':
                    body += `<td><img src="${v}" style="max-width: 27px;"></td>`;
                    break;
                case 'Manufacturer':
                case 'SupplierPart':
                    body += `<td class="${v}">${v}</td>`;
                    break;
                default:
                    body += `<td class="text-center ${v}">${v}</td>`;
                    break;
            }

        })
        body += `</tr>`;

    })

    return header + body + footer;
}
MainTable.prototype.validPoSelected = function (data, form_groups) {
    // var isNull = { status: false, name: 'bị' };
    // form_groups.find("input").each(function () {
    //     var name = $(this).prop("name");
    //     var val = $(this).val();
    //     data.forEach((k) => {
    //         var text = new RegExp(k, 'i');
    //         if (name.match(text) && !isNull.status && !val) {
    //             isNull = { status: true, name: k };
    //         }

    //     })
    // })
    // if (isNull.status || !data) {
    //     showNoti("Dữ liệu " + isNull.name + " trống!", "Vui lòng kiểm tra lại", "Err")
    //     return false;
    // }
    return true;
}
MainTable.prototype.openModelInsertPart = function (html) {

    $('#modal-list-old .modal-body').empty().append(html);
    $('#modal-list-old').modal('show');
}
MainTable.prototype.changeCustomerID = async function (el) {
    var value = $(el).val();
    var form_groups = $("#bill-information");
    var data = await this.send({ id: value }, 'getCompanyInfoSelected');
    console.log({ data })
    $.each(data, function (v, k) {
        form_groups.find("input[name*=" + v + "]").val(k);
    })
}
MainTable.prototype.changeSelectCustomer = async function (el) {
    var value = $(el).val();
    var form_group = $("#info-request");
    var data = await this.send({ id: value }, 'changeSelectCustomer');

    $.each(data, function (v, k) {
        form_group.find("select[name*=" + v + "]").val('').trigger("chosen:updated").val(k).trigger("chosen:updated");
    })
    
}
MainTable.prototype.changeSelectCarry = async function (el) {
    var value = $(el).val();
    var form_group = $("#2nd-information");
    var data = await this.send({ id: value }, 'changeSelectCarry');
    $.each(data, function (v, k) {
        form_group.find("input[name*=" + v + "]").val(k);
    })
}

class ModalListOld extends Customer_request_pickup {
    constructor() {
        super("#modal-list-old")
    }
    addEventListener() {
        var mlo = this;
        this.root.on('click', '.btn-add-part', function () {
            mlo.addPart(this);
        }).on("click", "input", function () {
            setTimeout(() => mlo.changeTxtAdd(), 100);
        })
    }
}
ModalListOld.prototype.changeTxtAdd = function () {

    var value = $("#modal-list-old").find("tbody").find("input.cb-ele:checked").length;
    var text = value == 0 ? "Add" : "Add(" + value + ")";
    $("#modal-list-old").find(".modal-footer").find(".btn-success").text(text);
}
ModalListOld.prototype.addPart = async function (el = null) {

    var data = { row: [], key: 1 };
    if (el != null) {
        var tbody = $(el).closest(".modal").find(".modal-body").find("tbody");
        tbody.find("input.cb-ele:checked").each(function () {
            var item = $(this).data();
            data['row'].push(item);
        })
    }

    var row = $('#itemList .mainTable .highlightNoClick').length;
    var group = $('#itemList .mainTable .footer-group.bg-primary').length;
    var key = $('#itemList .mainTable .highlightNoClick').last().data("key");
    var pono = el != null ? data['row'][0]['master'] : '';
    var selectedID = el != null ? data['row'][0]['selected'] : '';

    data.index = row + 1;
    data.key = key + 1;
    data.group = group + 1;
    var html = await this.send(data, 'insertPartPO', { 'html': true });

    // add po id
    if (selectedID && pono) {
        $("#cpo-information").find("[data-selected=" + selectedID + "]").removeAttr("data-cpo").attr("data-cpo", pono);
    }

    // refresh txt btn add
    $("#modal-list-old").find(".modal-footer").find(".btn-success").text("Add");

    await this.addRow(html, pono);

    // trigger calculator total cost in row part
    $("[data-cpo].highlightNoClick").find("input[name*=Bank_Cost]").change();

    // trigger calculator quantity
    $("[data-cpo=" + pono + "].highlightNoClick").find("input[name*=quantity]").change();

    // disable switch type
    $("#OrderType").addClass('disabled');
    // disable select when client add part
    if (data.row.length > 0) this.disablePoChosse();

    var newItem = $("[data-cpo].highlightNoClick.new-item");
    await this.scrollTopSmooth(newItem);

    this.refreshTableItem();


}

ModalListOld.prototype.disablePoChosse = function () {
    $('.fg-po').last().find("select").addClass("disabled");
    $('.fg-po').last().find("input:not(:hidden)").each(function () {
        $(this).addClass("disabled");
    })
}
ModalListOld.prototype.addRow = async function (string, pono = null) {
    // remove all class new-item
    $("#itemList table tr").each(function () {
        $(this).removeClass("new-item");
    })

    // exist po -> insert on group else append
    var index = 0;
    var poExist = false;
    $("#itemList .footer-group").each(function () {
        var value = $(this).data("cpo");
        if (value == pono) {
            poExist = true;
            index = $(this).index();
        }
    })

    if (!poExist)
        $('#itemList table tbody').append(string);

    if (poExist) {
        var oldGroup = $("#itemList tr").eq(index + 2);
        oldGroup.remove();

        $("#itemList tr").eq(index + 1).after(string);
        // this.removePoDuplicate(pono);
    }

}

class ItemList extends Customer_request_pickup {
    constructor(el = null) {
        el = (el == null) ? "#itemList .mainTable" : el;
        super(el)
    }

    addEventListener() {
        var _this = this;
        this.root
            .on("click", ".btn-collapse", function () {
                _this.toggleListItem(this);
            })
            .on("click", ".btn-collapse-child", function () {
                _this.toggleRowItem(this);
            })
            .on("change","[name*=Shipping_Cost],[name*=Handling_Cost]",function(){
                console.log("test")
                _this.calcTotalCost();
            })


        // .on("change", ".col-quantity [name*=quantity]", function () {
        //     _this.addQuantityToPO(this)
        // })

        // end addEvenlistenner
    }

}
ItemList.prototype.calcTotalCost = async function (el) {
    var component = ['input.col-shipping_cost', 'input.col-handling_cost'];
    var target = 'input.col-total_cost';
    await this.sumTotalOnRow(el, component, target);


    await $(el).closest("tr").find("input.col-total_cost").trigger("change");

    component = ['col-total_cost'];
    await this.sumTotalOnGroup(el, component);

    // this.triggerChangeCalcPer(el);
}
ItemList.prototype.sumTotalOnGroup = function (selector, component) {
    var cpo = $(selector).closest("tr").data("cpo");
    var il = this;
    var row = $("[data-cpo=" + cpo + "][data-key]");
    var sumReturn = {};

    // set sum for each component
    component.forEach(function (item) {
        var sum = 0;
        row.each(function () {
            var v = $(this).find("." + item).val()
            v = il.unformatCurrencyValue(v)
            sum += v;
        })
        sum = sum ? sum : 0;
        sum = round(sum) == sum ? sum : sum.toFixed(2);
        sumReturn[item] = sum;
        sum = il.formatCurrencyValue(sum)
        $("[data-cpo=" + cpo + "].footer-group").find("." + item).find("span").text(sum);
    })

    return sumReturn;
}
ItemList.prototype.sumTotalOnRow = function (selector, component, target) {
    var il = this;
    var sum = 0;
    var row = $(selector).closest("tr");
    component.forEach((v) => {
        var value = row.find(v).val();

        value = il.unformatCurrencyValue(value)

        sum += value;
    })
    sum = il.formatCurrencyValue(sum)
    row.find(target).val(sum);

}
ItemList.prototype.toggleRowItem = function (el) {
    var isPlus = $(el).hasClass("fa-plus-circle");
    var row = $(el).closest("tr").next();
    if (isPlus) {
        row.show();
        $(el).closest("td").html('<i class="fa fa-minus-circle btn-collapse-child"></i>');
        var state = this.collapseState();
        // change icon when all rows item plus
        if (state.minus) this.root.find("thead").find("th .fa-plus-circle").closest("th").html('<i class="fa fa-minus-circle btn-collapse"></i>');
        return true;
    }

    row.hide();
    $(el).closest("td").html('<i class="fa fa-plus-circle btn-collapse-child"></i>');
    var state = this.collapseState();

    // change icon when all rows item minus
    if (state.plus) this.root.find("thead").find("th .fa-minus-circle").closest("th").html('<i class="fa fa-plus-circle btn-collapse"></i>');
    return false;
}
ItemList.prototype.toggleListItem = function (el) {
    var isPlus = $(el).hasClass("fa-plus-circle");

    if (isPlus) {
        this.root.find("tbody").find(".highlightNoClick1").show();
        $(el).closest("th").html('<i class="fa fa-minus-circle btn-collapse"></i>');
        this.root.find("tbody").find(".highlightNoClick").each(function () {
            var btn = $(this).find(".fa.fa-plus-circle");
            btn.closest("td").html('<i class="fa fa-minus-circle btn-collapse-child"></i>');
        })
        return true;
    }

    this.root.find("tbody").find(".highlightNoClick1").hide();
    $(el).closest("th").html('<i class="fa fa-plus-circle btn-collapse"></i>');
    this.root.find("tbody").find(".highlightNoClick").each(function () {
        var btn = $(this).find(".fa.fa-minus-circle");
        btn.closest("td").html('<i class="fa fa-plus-circle btn-collapse-child"></i>');
    })
    return false;
}

class ExecuteCost extends ItemList{
    constructor(){
        super('#attribution')
    }
    addEventListener(){
        var _this = this;
        this.root.on("blur",'.shipping.attr-Surcharge,.attr-Unit,.attr-Surcharge,.attr-shipping-order',function(){
            _this.setShippingAmount(this);
            _this.setShippingTotal(this);
            _this.setTotalCost();
        }).on("blur",".attr-Pickup,.attr-handling,.attr-parking,.attr-other,.attr-declare",function(){
            _this.setHandlingTotal(this);
            _this.setTotalCost();
        }).on("click", ".btn-execute-cost", function () {
            _this.executeCost();
        })
    }
}
ExecuteCost.prototype.executeCost = async function (msg = 'Data') {

    await this.calcDataOnProducts();


    hideLoading();


    this.setStateExecuteBtn();


    showNoti(msg + " have been changed in sheet!", "Update " + msg, "War")
}
ExecuteCost.prototype.calcDataOnProducts = async function () {
    var af = this;

    // add ShippingCostToPart HandlingCostToPart
    await this.addShippingCostToPart();
    await this.addHandlingCostToPart();

    // update total cost
    await $("#itemList input[name*=Shipping_Cost]").each(function () {
        af.calcTotalCost(this);
    })
    // // update total quantity and total shipping and total handling on footer on part ( summery part )
    await this.updateTotalQuantity();
    await this.updateTotalShipping();
    await this.updateTotalHandling();
    await this.updateTotalGW();
    await this.updateTotalNW();

}
ExecuteCost.prototype.updateTotalHandling = function () {
    var cpo_total = {};
    var _this = this;
    $("#itemList input[name*=Handling_Cost]").each(function () {
        var value = $(this).val();
        var cpo = $(this).closest("tr").data("cpo");
        if (cpo_total[cpo]) cpo_total[cpo] += _this.unformatCurrencyValue(value);

        if (!cpo_total[cpo]) cpo_total[cpo] = _this.unformatCurrencyValue(value);

    })

    if (cpo_total) {
        $.each(cpo_total, function (k, v) {
            v = _this.formatWeightValue(v, '');
            $("#itemList [data-cpo=" + k + "].footer-group .col-total_handling span").text(v);
        })
    }

}
ExecuteCost.prototype.updateTotalNW = function () {
    var cpo_total = {};
    var _this = this;
    $("#itemList input[name*=NW]").each(function () {
        var value = $(this).val();
        var cpo = $(this).closest("tr").data("cpo");
        if (cpo_total[cpo]) cpo_total[cpo] += _this.unformatCurrencyValue(value);

        if (!cpo_total[cpo]) cpo_total[cpo] = _this.unformatCurrencyValue(value);

    })

    if (cpo_total) {
        $.each(cpo_total, function (k, v) {
            v = _this.formatWeightValue(v, '');
            $("#itemList [data-cpo=" + k + "].footer-group .col-total_NW span").text(v);
        })
    }

}
ExecuteCost.prototype.updateTotalGW = function () {
    var cpo_total = {};
    var _this = this;
    $("#itemList input[name*=GW]").each(function () {
        var value = $(this).val();
        var cpo = $(this).closest("tr").data("cpo");
        if (cpo_total[cpo]) cpo_total[cpo] += _this.unformatCurrencyValue(value);

        if (!cpo_total[cpo]) cpo_total[cpo] = _this.unformatCurrencyValue(value);

    })

    if (cpo_total) {
        $.each(cpo_total, function (k, v) {
            v = _this.formatWeightValue(v, '');
            $("#itemList [data-cpo=" + k + "].footer-group .col-total_GW span").text(v);
        })
    }

}
ExecuteCost.prototype.updateTotalQuantity = function () {
    var cpo_total = {};
    var _this = this;
    $("#itemList input[name*=quantity]").each(function () {
        var value = $(this).val();
        var cpo = $(this).closest("tr").data("cpo");
        if (cpo_total[cpo]) cpo_total[cpo] += _this.unformatCurrencyValue(value);

        if (!cpo_total[cpo]) cpo_total[cpo] = _this.unformatCurrencyValue(value);

    })

    if (cpo_total) {
        $.each(cpo_total, function (k, v) {
            v = _this.formatWeightValue(v, '');
            $("#itemList [data-cpo=" + k + "].footer-group .total-quantity span").text(v);
        })
    }

}
ExecuteCost.prototype.updateTotalShipping = function () {
    var cpo_total = {};
    var _this = this;
    $("#itemList input[name*=Shipping_Cost]").each(function () {
        var value = $(this).val();
        var cpo = $(this).closest("tr").data("cpo");
        if (cpo_total[cpo]) cpo_total[cpo] += _this.unformatCurrencyValue(value);

        if (!cpo_total[cpo]) cpo_total[cpo] = _this.unformatCurrencyValue(value);

    })

    if (cpo_total) {
        $.each(cpo_total, function (k, v) {
            v = _this.formatCurrencyValue(v);
            $("#itemList [data-cpo=" + k + "].footer-group .col-total_shipping span").text(v);
        })
    }
}
ExecuteCost.prototype.addHandlingCostToPart = function () {
    var rows = $("#itemList tr[data-cpo].highlightNoClick");
    var _this = this;
    var attr_cost = $("#attribution").find("[name*=2].attr-Total").val();
    attr_cost = this.unformatCurrencyValue(attr_cost);

    var total_sum_GW = 0;
    rows.find("[name*=GW]").each(function () {
        var value = $(this).val();
        total_sum_GW += parseFloat(_this.unformatCurrencyValue(value));
    })

    rows.each(function () {
        var gw = $(this).find("[name*=GW]").val();
        gw = _this.unformatCurrencyValue(gw);
        var handling_cost = parseFloat(gw) / total_sum_GW * attr_cost;
        handling_cost = _this.formatCurrencyValue(handling_cost)
        $(this).find("input[name*=Handling_Cost]").val(handling_cost).trigger("change");
    })

}
ExecuteCost.prototype.addShippingCostToPart = function () {
    var rows = $("#itemList tr[data-cpo].highlightNoClick");
    var _this = this;
    var attr_cost = $("#attribution").find("[name*=1].attr-Total").val();
    attr_cost = this.unformatCurrencyValue(attr_cost);

    var total_sum_GW = 0;
    rows.find("[name*=GW]").each(function () {
        var value = $(this).val();
        total_sum_GW += parseFloat(_this.unformatCurrencyValue(value));
    })

    rows.each(function () {
        var gw = $(this).find("[name*=GW]").val();
        gw = _this.unformatCurrencyValue(gw);
        var shipping_cost = parseFloat(gw) / total_sum_GW * attr_cost;
        shipping_cost = _this.formatCurrencyValue(shipping_cost)
        $(this).find("input[name*=Shipping_Cost]").val(shipping_cost).trigger("change");
    })

}
ExecuteCost.prototype.setShippingAmount = function(el){
    var row = $(el).closest('tr');
    var weight = row.find("[name*=Weight]").val();
    var unit = row.find("[name*=Unit]").val();
    var amount = this.unformatCurrencyValue(weight) * this.unformatCurrencyValue(unit);
    amount = this.formatCurrencyValue(amount);
    row.find("[name*=Amount]").val(amount);
}
ExecuteCost.prototype.setShippingTotal = function(el){
    var row = $(el).closest('tr');
    var amount = row.find("[name*=Amount]").val();
    var surcharge = row.find("[name*=Surcharge]").val();
    var other = row.find("[name*=Other]").val();
    var total = this.unformatCurrencyValue(amount) + this.unformatCurrencyValue(surcharge) + this.unformatCurrencyValue(other);

    total = this.formatCurrencyValue(total);
    row.find("[name*=Total]").val(total);
}
ExecuteCost.prototype.setHandlingTotal = function (el) {
    var row = $(el).closest('tr');
    var Pickup = row.find("[name*=Pickup]").val();
    var Unloading = row.find("[name*=Unloading]").val();
    var Parking = row.find("[name*=Parking]").val();
    var Declare = row.find("[name*=Declare]").val();
    var Other = row.find("[name*=Other]").val();
    var total = this.unformatCurrencyValue(Parking) + this.unformatCurrencyValue(Pickup) + this.unformatCurrencyValue(Unloading) + this.unformatCurrencyValue(Declare) + this.unformatCurrencyValue(Other);
    total = this.formatCurrencyValue(total);
    row.find("[name*=Total]").val(total);
}
ExecuteCost.prototype.setTotalCost = function(){
    var sum = 0;
    var _this = this;
    this.root.find("[name*=Total]").each(function(){
        sum+= _this.unformatCurrencyValue($(this).val())
    })
    sum = this.formatCurrencyValue(sum);
    this.root.find("#cost_total").text(sum);
}

$(document).ready(function () {
    var crp = new Customer_request_pickup();
    crp.addEventListener();
    crp.afterLoaded();
    var mt = new MainTable();
    mt.addEventListener();
    var il = new ItemList();
    il.addEventListener();
    var mlo = new ModalListOld();
    mlo.addEventListener();
    var ec = new ExecuteCost();
    ec.addEventListener();
})