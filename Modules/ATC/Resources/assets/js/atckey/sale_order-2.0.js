class sup_rfq{
    constructor(el){
        this.body = $("body");
        this.id = this.body.find("#id").val();
        this.root = $(el);
    }

    addEventListener(){
        var _this = this;
        $(".group-process").on("click","#removeRowPart", function(){
            _this.addRemoveListItems();
        }).on("click",".btn-info.waves-effect",function(){
            var mt = new MainTable();
            mt.insertPart(this);
        })



        // // render currency
        // this.body.find("input.currency").each(function(){
        //     _this.formatCurrency(this)
        // })
        // this.body.find("input.currency_unit").each(function(){
        //     _this.formatCurrency(this,true)
        // })
    }

    static async removeLoading(){
        //  $("#loading-animated").removeClass("yt-loader");
    }
    static addLoading(){
        //$("#loading-animated").addClass("yt-loader");
    }
}

sup_rfq.prototype.unformatCurrency =  function(el){

    var value = $(el).val()
    value = this.unformatCurrencyValue(value)

    $(el).val(value)
    return value;
}

sup_rfq.prototype.unformatCurrencyValue = function(value){

    value = value ? accounting.unformat(value) : 0
    // value = value.replace(/[0-9].-/g,'')
    return value;
}


sup_rfq.prototype.removePoDuplicate = function(po){
    var count_po = 0;
    $("#sc-information .PONo").each(function(){
        if($(this).val()==po) count_po++;
    })
    var po_insert = $("#sc-information .PONo").last();
    if(po_insert.val()==po&&count_po>1) po_insert.closest(".fg-sc").remove();
}

sup_rfq.prototype.clockRemovePo = function(){
    if(this.id){
        $("#mainTable-sup_rfq").find('.fg-sc select').addClass("");
        $("#mainTable-sup_rfq").find('.fg-sc input').addClass("");
        // $("#mainTable-request_pickup").find(".btn-remove-po").addClass("disabled");
        $("#mainTable-sup_rfq").find(".fg-sc").last().find(".btn-remove-po").removeClass("");

    }
}
sup_rfq.prototype.addChosen = function(el=null){

    var parent = (el!=null) ? $(el).closest(".collapse") : $("form");
    parent.find('.select2').chosen({
        placeholder_text_single: 'Select an option',
        no_results_text: "Oops, không tìm thấy!"
    })
    if ($('.chosen-search').length && !$('.chosen-search i').length) {
        $('.chosen-search').append('<i class="glyph-icon icon-search"></i>');
    }
    $('.chosen-single div').html('<i class="glyph-icon icon-caret-down"></i>');

}
sup_rfq.prototype.send = function(data,url,option={}){
    // var domain = '/'+window.location.pathname +"request_pickup"
    return new Promise((resolve, reject) => {
        $.ajax({
            url:'sales_order/'+ url,
            type: "POST",
            data: data,
            beforeSend:function(){
                showProcess(1);
                sup_rfq.addLoading();
            },
            complete:function(){
                hideLoading();
                sup_rfq.removeLoading();
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
                sup_rfq.removeLoading();
                reject({});
            },
        });
    })
}



sup_rfq.prototype.refreshTableItem = async function(){

    var table = $('#itemList1 table');
    var data = [];
    // get all po on table
    table.find(".footer-group").each(function(){
        data.push($(this).data("po"));
    })
    // check exist row or sub row
    var poRemove = [];
    await data.forEach(function(v){
        var len = table.find("[data-po="+v+"].highlightNoClick").length;
        if(len==0) poRemove.push(v)
    })

    // remove group-footer don't have row
    await poRemove.forEach(function(v){
        table.find("[data-po="+v+"]").remove();
    })

    // remove po on maintable
    await poRemove.forEach(function(v){
        $(".btn-po.btn-remove-po").each(function(){
            // var selected = $(this).closest(".fg-sc").find("select").val()
            // if(selected==v) $(this).closest(".fg-sc").remove();
        })
    })




    // //refresh calc total and all input
    // table.find("input").each(function(){
    //     $(this).change();
    // })

}
class MainTable extends sup_rfq{
    constructor(){

        super(".mainTable")
        //  super("#mainTable-stock_export")

    }
    static BtnCheckPart(id,did,key){
        return `<input type="checkbox" name="" class="cb-ele" id="check${key}"   value="${key}" data-master="${id}" data-detail="${did}">`;
    }
    addEventListener(){
        var _this = this;
        this.root.on("click",".btn-add-po",function(){
            _this.addPo(this);
        }).on("click", ".btn-remove-po", function() {
            _this.removePo(this)
        }).on("change", "select.PONo", async function() {
            _this.changeSelectPo(this);
        }).on("click","#btn-insert-cpo",function(){
            // alert(144);
            _this.insertPartCpo(this);
        }).on("click",".btn-insert-part",function(){
            _this.insertPart(this);
        }).on("change","select.ContractNo",function(){
            _this.changeSelectSC(this);
        }).on("click",".btn-insert-partpj",function(){
            _this.insertPartPJ(this);
        })

    }
}


MainTable.prototype.validPoSelected = function(data,form_groups){
    var isNull = {status:false,name:'bị'};
    form_groups.find("input").each(function(){
        var name = $(this).prop("name");
        var val = $(this).val();
        data.forEach((k)=>{
            var text = new RegExp(k,'i');
            if(name.match(text)&&!isNull.status&&!val){
                isNull = {status:true,name:k};
            }

        })
    })
    if(isNull.status||!data){
        showNoti("Dữ liệu "+isNull.name+" trống!","Vui lòng kiểm tra lại","Err")
        return false;
    }
    return true;
}
MainTable.prototype.insertPart = async function(el){
    // var form_groups = $(el).closest(".fg-sc");
    var value = $('#SalesOrderID').val();
    // var value = form_groups.find("input.SCCode").val();
    var key1 = 1;

//
    // var key1=  form_groups.data('selected1');

    //  var data = ['PODate','ContractNo','ContractDate','CustomerPONo','CPODate','ImportMethod'];

    //var had_po = $("#OrderType").find("option:checked").val();
    //if(had_po==0){

    //if(!this.validPoSelected(data,form_groups)) return false;

    var data  = await this.send({value},'getListPart');
    //  console.log(data);

    var html = await this.createInsertPartTable(data,key1);
    this.openModelInsertPart(html);
    //return true;
    var mlo = new ModalListOld();
    //  mlo.addPart();

    // }

    // insert null item


}
MainTable.prototype.insertPartPJ = async function(el){
    var value = $('#project_id').val();
    if(value == ''){
        showNoti('Please choose Project ID', 'Lỗi nhập liệu', 'Err');
        return false;
    }

    var key1 = 1;
    var data  = await this.send({value},'getListPartPJ');
    var html = await this.createInsertPartTablePJ(data,key1);
    this.openModelInsertPartPJ(html);
    var mlo = new ModalListOld();
}
MainTable.prototype.insertPartCpo = async function(el){
    var form_groups = $(el).closest(".fg-cpo");
    var value = form_groups.find("input.cpoCode").val();
    var customerid = $("#customerid").val();
    var idHD = $("#idHD").val();
    var cpoid = $("#cpoid").val();
    if(customerid==''){
        showNoti('Please choose Customer Id', 'Lỗi nhập liệu', 'Err');
        return false;

    }
    if(idHD==''){
        showNoti('Please choose CSC No', 'Lỗi nhập liệu', 'Err');
        return false;

    }
    if(cpoid==''){
        showNoti('Please choose CPO No', 'Lỗi nhập liệu', 'Err');
        return false;

    }


    //alert(value);
//
    // var key1=  form_groups.data('selected1');

    //  var data = ['PODate','ContractNo','ContractDate','CustomerPONo','CPODate','ImportMethod'];

    //var had_po = $("#OrderType").find("option:checked").val();
    //if(had_po==0){

    //if(!this.validPoSelected(data,form_groups)) return false;

    var data  = await this.send({value},'purchase_order');
    //console.log(data);

    var html = await this.createInsertPartTablecpo(data);
    this.openModelInsertPartcpo(html);
    //return true;
    var mlcpo = new ModalListOldcpo();
    //mlcpo.addPart();

    // }

    // insert null item


}
MainTable.prototype.createPoRow = function(options,key){


    return `<div id= 'fg_sc' class="form-group group-required fg-sc fg-sc-${key}" data-selected="${key}"> <div class="">
                    <div class="col-sm-12">
                        <div class="">
                        <div class="col-sm-1" style=" width: 28px; "><div class="btn-part btn-insert-part" data-selected1="${key}" title="Click to insert Part"><a href="javascript:;"><i class="glyph-icon icon-list-alt"></i></a></div></div>

                        <div class="col-sm-2">
                        ${options.sc}
                            <input type="hidden" class="SCCode" name="SC[${key}][SCCode]" id="SCCode${key}" >
                            </div>
                            <div class="col-sm-2">
                            <input type="text" class=" form-control input-required" name="SC[${key}][ContractDate]" id="ContractDate${key}" value="" readonly>
                        </div>
                    <div class="col-sm-2">
                    <input type="text" class=" form-control" name="SC[${key}][EndCustomerName]" id="EndCustomerName${key}" value=""  readonly>
                    </div>
                    <div class="col-sm-2">
                    <input type="text" class=" form-control" name="SC[${key}][import_method]" id="import_method${key}" value=""  readonly>
                    <input type="hidden" class="stt" form-control"  value="${key}"  readonly>

                </div>
                <div class=" col-sm-1 btn-po btn-remove-po" title="Click to remove PO"><a href="javascript:;"><i class="fa fa-close"></i></a></div>
                </div>
            </div>
            </div>
            </div>`;


}
MainTable.prototype.addPo = async function(el){
    var group_insert = $("#sc-information").find(".fg-sc[data-selected]");
    //  alert(group_insert.length);
    var data_selected = group_insert.length;
    var key = data_selected ;
    var options = {};
    var supplier = $("#supplierid").val();
    if(supplier==''){
        showNoti('Please choose supplierid', 'Lỗi nhập liệu', 'Err');

    }
    options['sc'] = await this.send({key:key,supplier:supplier },"htmlSelectSC");

    //  options['po'] = await this.send({key},"htmlSelectPo");

    var html = this.createPoRow(options,key);

    // insert first row when group empty
    if (group_insert.length>0) {
        // group_insert.last().find(".btn-remove-po").addClass("disabled");
        group_insert.last().after(html);

    } else {
        //$(".fg-header-sc").after(html);
        $('#sclist').html(html);

    }

    await this.addChosen(el);

    await this.addDatePicker(key);

}
MainTable.prototype.addDatePicker = function(key){
    // add date picker
    $('#sc-information .fg-sc-' + key).find('.bootstrap-datepicker').datepicker({
        format: 'yyyy-mm-dd',
        language: 'vi',
        autoclose: true,
        todayHighlight: true
    });
}
MainTable.prototype.openModelInsertPart = function(html){

    $('#modal-list-oldpo .modal-body').empty().append(html);
    $('#modal-list-oldpo').modal('show');

}
MainTable.prototype.openModelInsertPartPJ = function(html){

    $('#modal-list-oldpj .modal-body').empty().append(html);
    $('#modal-list-oldpj').modal('show');

}
MainTable.prototype.openModelInsertPartcpo = function(html){

    $('#modal-list-oldcpo .modal-body').empty().append(html);
    $('#modal-list-oldcpo').modal('show');

}
MainTable.prototype.createInsertPartTable = function(data,stt){

    var header = `<div class="table-responsive">
    <table class="table-modal table table-hover">
        <thead>
        <tr class="nodrop">
            <th  style="width: 100px; min-width: 100px; max-width: 100px;"></th>
            <th  style="width: 100px; min-width: 100px; max-width: 100px;">Supplier Part </th>
            <th  style="width: 100px; min-width: 100px; max-width: 100px;">Mfr Part </th>
            <th  style="width: 100px; min-width: 100px; max-width: 100px;">Manufacturer</th>
            <th  style="width: 100px; min-width: 100px; max-width: 100px;">Quantity</th>
            <th  style="width: 100px; min-width: 100px; max-width: 100px;" class="">Unit Price USD</th>
         
        </tr>
        </thead>
        <tbody>`;
    var footer = `</tbody></table></div>`;
    var body = '';
    var i=0;
    data.forEach(function(item){
        //console.log(item);

        body+='<tr>';
        body+='<td>'+MainTable.BtnCheckPart(item['SalesOrderID'],item['did'],i)+'</td>';

        // delete item['SCID'];
        // delete item['did'];
        body+='<td class="QuoteID" id= "QuoteID'+i+'">'+item['did']+'</td>';
        body+='<td class="supplier_part" id= "supplier_part'+i+'">'+item['SupplierPart']+'</td>';
        body+='<td class="MfrPart"><span id="MfrPart'+i+'">'+item['MfrPart']+'</span><span class="desc">'+item['Description']+'</span></td>';
        body+='<td class="Manufacturer" id="Manufacturer'+i+'">'+item['Manufacturer']+'</td>';
        body+='<td class="qty" id="qty'+i+'">'+item['OrderQuantity']+'</td>';
        body+='<td class="priceusd" id="priceusd'+i+'">'+item['UnitPriceUSD']+'</td>';
        body+='<td style=" display: none; " id="SQID'+i+'">'+item['SalesOrderID']+'</td>';
        // body+='<td style=" display: none; " id="PO'+i+'">'+item['po']+'</td>';
        // body+='<td style=" display: none; " id="CPO'+i+'">'+item['idcpo']+'</td>';
        // body+='<td style=" display: none; " id="CUS'+i+'">'+item['cusid']+'</td>';
        body+='<td style=" display: none; " id="desc'+i+'">'+item['Description']+'</td>';
        // body+='<td style=" display: none; " id="ImportMethod'+i+'">'+item['ImportMethod']+'</td>';
        // body+='<td style=" display: none; " id="CompanyNameLo'+i+'">'+item['CompanyNameLo']+'</td>';
        // body+='<td style=" display: none; " id="supid'+i+'">'+item['VendorNumber']+'</td>';
        body+='<td style=" display: none; " id="key'+i+'">'+stt+'</td>';

        body+=`</tr>`;
        i++;
    })
    return header + body + footer;
}
MainTable.prototype.createInsertPartTablePJ = function(data,stt){

    var header = `<div class="table-responsive">
    <table class="table-modal table table-hover">
        <thead>
        <tr class="nodrop">
            <th  style="width: 10px; min-width: 10px; max-width: 10px;"></th>
             <th  style="width: 10px; min-width: 10px; max-width: 10px;">PartID</th>
            <th  style="width: 50px; min-width: 50px; max-width: 50px;">Supplier Part </th>
            <th  style="width: 50px; min-width: 50px; max-width: 50px;">Mfr Part </th>
            <th  style="width: 100px; min-width: 100px; max-width: 100px;">Description </th>
            <th  style="width: 100px; min-width: 100px; max-width: 100px;">Manufacturer</th>
            <th  style="width: 100px; min-width: 100px; max-width: 100px;">Quantity</th>
            <th  style="width: 100px; min-width: 100px; max-width: 100px;" class="">Unit Price USD</th>
         
        </tr>
        </thead>
        <tbody>`;
    var footer = `</tbody></table></div>`;
    var body = '';
    var i=0;
    data.forEach(function(item){
        //console.log(item);

        body+='<tr>';
        body+='<td>'+MainTable.BtnCheckPart(item['parent'],item['id'],i)+'</td>';

        // delete item['SCID'];
        // delete item['did'];
        body+='<td class="PartID" id= "PartID'+i+'">'+item['PartID']+'</td>';
        body+='<td class="supplier_part" id= "supplier_part'+i+'">'+ escapeHtml(item['manufacturer_part_number']) +'</td>';
        body+='<td class="MfrPart"><span id="MfrPart'+i+'">'+escapeHtml(item['manufacturer_part_number'])+'</span><span class="desc">'+escapeHtml(item['Description'])+'</span></td>';
        body+='<td class="Manufacturer" id="Manufacturer'+i+'">'+escapeHtml(item['Description'])+'</td>';
        body+='<td class="Manufacturer" id="Manufacturer'+i+'">'+escapeHtml(item['Manufacturer'])+'</td>';
        body+='<td class="qty" id="qty'+i+'">'+item['AnnualQty']+'</td>';
        body+='<td class="priceusd" id="priceusd'+i+'">'+item['UnitPrice']+'</td>';
        body+='<td style=" display: none; " id="SQID'+i+'">'+item['SalesOrderID']+'</td>';
        // body+='<td style=" display: none; " id="PO'+i+'">'+item['po']+'</td>';
        // body+='<td style=" display: none; " id="CPO'+i+'">'+item['idcpo']+'</td>';
        // body+='<td style=" display: none; " id="CUS'+i+'">'+item['cusid']+'</td>';
        body+='<td style=" display: none; " id="desc'+i+'">'+item['Description']+'</td>';
        // body+='<td style=" display: none; " id="ImportMethod'+i+'">'+item['ImportMethod']+'</td>';
        // body+='<td style=" display: none; " id="CompanyNameLo'+i+'">'+item['CompanyNameLo']+'</td>';
        // body+='<td style=" display: none; " id="supid'+i+'">'+item['VendorNumber']+'</td>';
        body+='<td style=" display: none; " id="key'+i+'">'+stt+'</td>';

        body+=`</tr>`;
        i++;
    })
    return header + body + footer;
}
MainTable.prototype.createInsertPartTablecpo = function(data){
    var codexk= $('#code').val();
    //console.log(data);
    var header = `<div class="table-responsive">
    <table class="table-modal table table-hover">
        <thead>
        <tr class="nodrop">
        <th style="width: 30px; min-width: 30px; max-width: 30px;">Query</th>
        
            <th style="width: 100px; min-width: 100px; max-width: 100px;">Supplier Part </th>
            <th style="width: 100px; min-width: 100px; max-width: 100px;">Mfr Part </th>
            <th style="width: 100px; min-width: 100px; max-width: 100px;">Manufacturer</th>
            <th style="width: 50px; min-width: 50px; max-width: 50px;">Warehouse</br> Id</th>
            <th style="width: 100px; min-width: 100px; max-width: 100px;">Cpo No</th>

            <th style="width: 60px; min-width: 60px; max-width: 60px;" ">Quantity</th>
            <th style="width: 80px; min-width: 80px; max-width: 80px;"">Unit Price USD</th>
         
        </tr>
        </thead>
        </table>
        </div>
        <tbody>  `


    ;
    var header1 = `
        <div style=" margin-top: 39px; " >

        <table class="table-modal table table-hover">
            <thead>
            <tr class="nodrop">
            <th style="width: 30px; min-width: 30px; max-width: 30px;">Add </th>
            <th  style="width:70px; min-width: 70px; max-width: 70px;">Lot Code</th>
            <th  style="width: 40px; min-width: 40px; max-width: 40px;">Lot No</th>
            <th  style="width: 50px; min-width: 50px; max-width: 50px;">NK No</th>
            <th  style="width: 50px; min-width: 50px; max-width: 50px;">NXT</th>

            <th  style="width: 100px; min-width: 100px; max-width: 100px;">Supplier Part #</th>
            <th  style="width: 100px; min-width: 100px; max-width: 100px;">Mfr Part # & Desc</th>
            <th  style="width: 100px; min-width: 100px; max-width: 100px;">Manufacturer</th>
            <th  style="width: 50px; min-width: 50px; max-width: 50px;">Date code</th>
            <th  style="width:50px; min-width: 50px; max-width: 50px;">COO</th>
            <th  style="width: 50px; min-width: 50px; max-width:50px;">Packaging</th>
            <th  style="width:50px; min-width: 50px; max-width: 50px;">Package</br> Case</th>
            <th  style="width: 50px; min-width:50px; max-width: 50px;" class="center">SPQ</th>
            <th  style="width: 50px; min-width: 50px; max-width: 50px;">Quantity</th>

            <th  style="width: 50px; min-width: 50px; max-width:50px;" class="right">Warehouse</th>
            <th  style="width: 60px; min-width: 60px; max-width: 60px;">Create Date</th>
             
            </tr>
            </thead>
            </table>
            </div>
            <tbody >  `



    ;
    var footer = `</div>`;
    var body = '';
    var i=0;
    body+=' <div  class="scroller" >';
    body+='<table class="table-modal table table-hover">';
    data.forEach(function(item){
        //  console.log(item);

        body+='<tr>';
        body+='<td style="width: 30px; min-width:30px; max-width: 30px;" class=" btn-list-oldcpo"><i class="glyph-icon icon-list-alt"></i></td>';

        // delete item['SCID'];
        // delete item['did'];
        body+='<td style="width: 100px; min-width: 100px; max-width: 100px;" class="supplier_part" >'+escapeHtml(item['SupplierPart'])+'</td>';
        body+='<td style="width: 100px; min-width: 100px; max-width: 100px;" class="MfrPart"><span class="MfrPart1">'+ escapeHtml(item['MfrPart'])+'</span><span class="desc">'+item['Description']+'</span></td>';
        body+='<td style="width: 100px; min-width: 100px; max-width: 100px;" class="Manufacturer" id="Manufacturer'+i+'">'+item['Manufacturer']+'</td>';
        body+='<td style="width:50px; min-width:50px; max-width: 50px;" class="warehouse" id="warehouse'+i+'">'+$('#warehouseid').val()+'</td>';
        body+='<td  style="width: 100px; min-width: 100px; max-width: 100px;" class="idcpo" id="idcpo'+i+'">'+item['CPO']+'</td>';
        body+='<td style="width:60px; min-width: 60px; max-width: 60px;" class="qty" id="qty'+i+'">'+item['OrderQuantity']+'</td>';

        body+='<td style="width: 80px; min-width: 80px; max-width: 80px;" class="priceusd" id="priceusd'+i+'">'+item['UnitPriceUSD']+'</td>';
        body+='<td style=" display: none; ">'+item['Description']+'</td>';
        body+='<td style=" display: none; " class="stt" id="stt'+i+'">'+i+'</td>';
        body+='<td style=" display: none; " class="cpoid" id="cpoid'+i+'">'+item['CPOID']+'</td>';
        i++;
    })
    body+=`</tr></table></div>`;


    var  body1 =' <div  class="scroller" >';
    body1 +='<table class="table-modal table table-hover">';

    body1 +='<tbody id="listold"></tbody></table></div>';
    return header + body +header1+ body1 +footer;
}
MainTable.prototype.removePo = function(el){
    var index = $(el).closest(".fg-sc").find(".PONo").val();
    var po = $(el).closest(".fg-sc").find(".ContractNo option:selected").text();
    var poid = $(el).closest(".fg-sc").find(".SCCode").val();

    var mt = this;
    $.alerts.confirm(`Are you sure you want to delete SC : <br />ID - ${po} ?<br />`, 'Confirm',async function(r) {

        if(r==true){
            if(index) $('#itemList1 .mainTable').find("[data-po="+index+"]").remove();
            await $("#sc-information").find(".PONo").each(function(){
                var val = $(this).val();
                if(val == index) $(this).closest(".fg-sc").remove();
            })

            $(el).closest(".fg-sc").remove();
            $('.sc'+poid+'').remove();
            listPoremote(poid);
            listInvremote(poid);
            mt.refreshTableItem();


        }

    })


}
MainTable.prototype.changeSelectSC = async function(el){

    var value = $(el).val();
    var form_groups = $(el).closest(".fg-sc");
    var form_groups1 = $('#sclist');

    form_groups.find('input.SCCode[type="hidden"]').val(value);
    var res = await this.send({id:value},'getSCDate');

    if(res) form_groups.find("[name*=ContractDate]").val(res.SCDate);
    if(res) form_groups.find("[name*=EndCustomerName]").val(res.EndCustomerName);
    if(res) form_groups.find("[name*=import_method]").val(res.ImportMethod);


    //if(res) form_groups.find("[name*=EndCustomerName]").val(res.EndCustomerName);
    var value_po = form_groups.find("select.PONo").val();
    var changsc = form_groups.find(".stt").val();


    //console.log(value_po);
    //return false;
    data = await this.send({value:value_po},'getListPart');

    //console.log(data);
    // return false;

    // var html = await this.createInsertPartTable(data);

    //this.openModelInsertPart(html);
    var lengthsc=  $('#sclist .fg-sc').length;
    //alert(lengthsc);
    // var key = ($(el).data('key'));
    var ContractNo = '';
    var arr = [];

    for (i = 0; i <= lengthsc; i++) {
        form_groups1.find("input[name^='SC["+i+"][SCCode]']").each(function () {
            // var idsc = form_groups.find("input[name^='SC["+key+"][SCCode]']");
            var idsc = ''+$('#ContractNo'+i+'').val()+'';
            arr.push($('#ContractNo'+i+'').val());

            ContractNo= ContractNo+ ','+idsc;

        });
    }
    $('.scchange'+changsc+'').remove();

    //console.log ('aaaaaaa:'+value);
    // $("#scpolist").remove( "#cpolistsc'+value+'" );
    //  $("#cpolistsc"+value+"").remove();


    // $("#scpolist").prepend('<div class="fg-scsc" id="cpolistsc'+key+'"></div>');

    listPo(arr);
    listinvoice(ContractNo);

}
MainTable.prototype.changeSelectPo = async function(el){
    var value = $(el).val();

    var form_groups = $(el).closest(".fg-sc");

    form_groups.find("input[name*=PO]").each(function(){
        $(this).val("");
    })
    var data = await this.send({id:value}, 'getPoSelected');
    var validData = [];

    // set data
    //  console.log('d: '+data);

    if(data){
        $.each(data, function(k, v) {
            form_groups.find("input[name*=" + k + "]").val(v);
            validData.push(k);
        })
    }

    if(!this.validPoSelected(validData,form_groups)) return false;

    //set code po
    var text = $(el).find('option:selected').text();
    text = text.replace(/\d.*\s/,"");

    form_groups.find('input.POCode[type="hidden"]').val(text);

    form_groups.find("select.ContractNo").click();

}

class ItemList extends sup_rfq {
    constructor(el=null){
        el = (el==null) ? "#itemList1 .mainTable" : el;
        super(el)
    }

}

class ModalListOld extends sup_rfq {
    constructor(){
        super("#modal-list-oldpo")
    }
    addEventListener(){
        var mlo = this;
        this.root.on('click','',function(){
            //   mlo.addPart(this);
        }).on("click","input",function(){
            setTimeout(()=>mlo.changeTxtAdd(),100);
        })
    }
}
ModalListOld.prototype.changeTxtAdd = function(){

    var value = $("#modal-list-oldpo").find("tbody").find("input.cb-ele:checked").length;
    var text = value==0? "Add":"Add("+value+")";
    $("#modal-list-oldpo").find(".modal-footer").find(".btn-success").text(text);
}

class ModalListOldcpo extends sup_rfq {
    constructor(){
        super("#modal-list-oldcpo")
    }
    addEventListener(){
        var mlcpo = this;
        this.root.on('click','',function(){
            //   mlo.addPart(this);
        }).on("click","input",function(){
            setTimeout(()=>mlcpo.changeTxtAdd(),100);
        })
    }
}
ModalListOldcpo.prototype.changeTxtAdd = function(){

    var value = $("#modal-list-oldcpo").find("tbody").find("input.cb-ele:checked").length;
    var text = value==0? "Add":"Add("+value+")";
    $("#modal-list-oldcpo").find(".modal-footer").find(".btn-success").text(text);
}



$(document).ready(function(){
    var rp = new sup_rfq();
    rp.addEventListener();
    var mt = new MainTable();
    mt.addEventListener();
    var il = new ItemList();
    il.addEventListener();
    var mlo = new ModalListOld();
    mlo.addEventListener();
    var mlcpo = new ModalListOldcpo();
    mlcpo.addEventListener();

})

function escapeHtml(text) {
    var map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    };

    return text.replace(/[&<>"']/g, function(m) { return map[m]; });
}