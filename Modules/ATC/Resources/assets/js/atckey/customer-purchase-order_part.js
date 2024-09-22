class cpo_sub{
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

cpo_sub.prototype.unformatCurrency =  function(el){

    var value = $(el).val()
    value = this.unformatCurrencyValue(value)

    $(el).val(value)
    return value;
}

cpo_sub.prototype.unformatCurrencyValue = function(value){

    value = value ? accounting.unformat(value) : 0
    // value = value.replace(/[0-9].-/g,'')
    return value;
}


cpo_sub.prototype.addChosen = function(el=null){

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
cpo_sub.prototype.send = function(data,url,option={}){
    // var domain = '/'+window.location.pathname +"request_pickup"
    return new Promise((resolve, reject) => {
        $.ajax({
            url:'customer_purchase_order/'+ url,
            type: "POST",
            data: data,
            beforeSend:function(){
                showProcess(1);
                cpo_sub.addLoading();
            },
            complete:function(){
                hideLoading();
                cpo_sub.removeLoading();
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
                cpo_sub.removeLoading();
                reject({});
            },
        });
    })
}



cpo_sub.prototype.refreshTableItem = async function(){

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
class MainTable extends cpo_sub{
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
    // var form_groups = $(el).closest(".fg-sc");
    var value = $('#SONo').val();
    // var value = form_groups.find("input.SCCode").val();
    var key1 = 1;

//
    // var key1=  form_groups.data('selected1');

    //  var data = ['PODate','ContractNo','ContractDate','CustomerPONo','CPODate','ImportMethod'];

    //var had_po = $("#OrderType").find("option:checked").val();
    //if(had_po==0){

    //if(!this.validPoSelected(data,form_groups)) return false;
    var Sono = $("#sonoquery").val();
    if(Sono==''){
        showNoti('Please choose SO NO', 'Lỗi nhập liệu', 'Err');
        return false;

    }
    var data  = await this.send({value},'getListPartPJ');
    //  console.log(data);

    var html = await this.createInsertPartTablePJ(data,key1);
    this.openModelInsertPartPJ(html);
    //return true;
    var mlo = new ModalListOld();
    //  mlo.addPart();

    // }

    // insert null item


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




}

MainTable.prototype.openModelInsertPartPJ = function(html){

    $('#modal-list-oldpj .modal-body').empty().append(html);
    $('#modal-list-oldpj').modal('show');

}


MainTable.prototype.createInsertPartTablePJ = function(data,stt){

    var header = `<div class="table-responsive">
    <table class="table-modal table table-hover">
        <thead>
        <tr class="nodrop">
        <th></th>
        <th>Image</th>
        <th>Supplier Part</th>
        <th>Mfr Part</th>
        <th>Description</th>
        <th>Manufacturer</th>
        <th>SPQ</th>
        <th>MOQ </th>
        <th>Quanity</th>
        <th>Unite Price</th>
        <th>Amount</th>
        </tr>
        </thead>
        <tbody>`;
    var footer = `</tbody></table></div>`;
    var body = '';
    var i=0;
    data.forEach(function(item){
       // console.log('ad'+item);
        var image = '../public/images/placeholder-image.png';
      if ( item['image']) {
            if (getData[i].Image.substring(0, 4) == 'http' ||  item['image'] .substring(0, 2) == '//') {
                image =  item['image'] ;
            }
            if ( item['image']  != '') {
                image =  'upload/products/'+ item['image'] ;
            }else{
                image = '';
            }
        }

        body+='<tr>';
        body+='<td>'+MainTable.BtnCheckPart(item['SalesOrderID'],item['did'],i)+'</td>';
        body+='<td  style=" display: none; " class="did" id= "did'+i+'">'+item['did']+'</td>';
        body += '<td class="img"><img src="' + image+ '" style="max-width: 27px;" data-url="' + item['image'] + '"></td>';

        body+='<td class="supplier" id= "supplier_part'+i+'">'+item['SupplierPart']+'</td>';
        body+='<td class="MfrPart"><span id="MfrPart'+i+'">'+item['MfrPart']+'</span><span class="desc">'+item['Description']+'</span></td>';
        body+='<td class="desc" id="desc'+i+'">'+item['Description']+'</td>';
        body+='<td class="mfr" id="mfr'+i+'">'+item['Manufacturer']+'</td>';
        body+='<td class="SPQ" id="SPQ'+i+'">'+item['StandardPackageQty']+'</td>';
        body+='<td class="MOQ" id="MOQ'+i+'">'+item['MinimumQuantity']+'</td>';
        body+='<td class="Quanity" id="Quanity'+i+'">'+item['OrderQuantity']+'</td>';
        body+='<td class="UnitePrice" id="UnitePrice'+i+'">'+item['UnitPriceUSD']+'</td>';
        body+='<td  id="Amount'+i+'">'+item['AmountUSD']+'</td>';
        body+='<td style=" display: none; " id="LeadtimeComments'+i+'">'+item['LeadtimeComments']+'</td>';
         body+='<td style=" display: none; " id="PackageCase'+i+'">'+item['PackageCase']+'</td>';
         body+='<td style=" display: none; " id="Packaging'+i+'">'+item['Packaging']+'</td>';
        body+='<td style=" display: none; " id="key'+i+'">'+i+'</td>';

        body+=`</tr>`;
        i++;
        //j++;
    })
    return header + body + footer;
}




class ItemList extends cpo_sub {
    constructor(el=null){
        el = (el==null) ? "#itemList1 .mainTable" : el;
        super(el)
    }



}


class ModalListOld extends cpo_sub {
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

class ModalListOldcpo extends cpo_sub {
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
 //   var rp = new cpo_sub();
  //  rp.addEventListener();
    var mt = new MainTable();
    mt.addEventListener();
    var il = new ItemList();
    il.addEventListener();
    var mlo = new ModalListOld();
    mlo.addEventListener();
  //  mlcpo.addEventListener();

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