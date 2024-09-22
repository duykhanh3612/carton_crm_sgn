class Modules_template{
  constructor(el){
    this.root = $(el);
  }
  static async removeLoading(){
    $("#loading-animated").removeClass("yt-loader");
  }
  static addLoading(){
    $("#loading-animated").addClass("yt-loader");
  }
}
Modules_template.prototype.timeout = function(){
  $.alerts.alert("Session Has Expired!\n We'll refresh this page.\nThanks!", 'Alert',function (r) {
    location.reload();
  })
  return false;
}
Modules_template.prototype.send = function(data,url,option={}){
  var _this = this;
  return new Promise((resolve, reject) => {
    $.ajax({
      url:'modules_template/'+ url,
      type: "POST",
      data: data,
      beforeSend:function(){
        showProcess(1);
        Modules_template.addLoading();
      },
      complete:function(){
        hideLoading();
        Modules_template.removeLoading();
      },
      success: function(res) {

        if(res==null){
          reject({});
          return false;
        }

        if(res&&res=="window"){
            $.alerts.alert("Session Has Expired!\n We'll refresh this page.\nThanks!", 'Alert',function (r) {
                location.reload();
            })
            reject({});
            return false;
        }

        if(res&&option&&option.html){
            resolve(res);
            return true;
        }

        res = JSON.parse(res);
        resolve(res.data);
      },
      timeout: 20000,
      error: function(jqXHR, textStatus, errorThrown) {
        console.log("here")
        _this.timeout();
        reject({});
      },
    });
})
}
Modules_template.prototype.scrollTopSmooth = function(el,root=''){
  var top = 0;
  try {

    var index = $(el).index();
    var height = $(el).height();
    top = index*height;

  } catch (error) {

  }

  if(root===''){
    $("html, body").animate({ scrollTop: top }, 1000);
  }else{
    $(root).animate({ scrollTop: top }, 1000);
  }

}
Modules_template.prototype.scrollLeftSmooth = function(el='',root=''){
  var left = 0;
  var index = $(el).index();
  var width = $(el).width();
  left = index*width;
  console.log({left})
  if(index == 1 || index <9){
    $(root).animate({ scrollLeft: 0 }, 1000);
  }
  else{
    $(root).animate({ scrollLeft: left }, 1000);
  }

}


class FormProperties extends Modules_template{
  constructor(el){
    super(el)
    this._isPressEdit = true;
    var group_no = $("tr[data-group]").last().data("group");
    this.group_no = group_no ?  group_no  : 0;
    console.log({group_no:this.group_no});
  }
}
FormProperties.prototype.addEventListener = function(){
  var _this = this;

  this.root.on("click","#copy-row",function(){
    _this.toggleShowCopy(this)
  }).on("click","tr",function(){
    _this.selectRow(this)

  }).on("mouseover","th",function(){
    _this.showBtnEdit(this);

  }).on("mouseleave","th",function(){
    _this.hideBtnEdit(this);

  }).on("click","#edit-row",async function(){
    _this.toggleShowEdit(this)
    _this.refreshTable({clear_active:true})

  }).on("click","#del-row",function(){
    _this.removeRow();

  }).on("click","#new-row",function(){
    _this.addFirstProperty();

  }).on("click","th [data-btn=new]",function(){
    _this.addNextProperty(this)

  }).on("change","th select",function(){
    _this.changeProperty(this)

  }).on("click","tr:not(layer1) th [data-btn=edit]",function(){
    _this.editProperty(this)

  }).on("click","tr:nth-child(even) input",function(){
    $(this).select();
  }).on("change","tr:nth-child(even) input",function(){
    _this.changeValueProperty(this);

  }).on("change","tr:nth-child(even) select",function(){
    _this.changeValueProperty(this,'select');

  }).on("contextmenu","th,td",function(e){
    _this.groupButton(this,e);
  })
}

FormProperties.prototype.groupButton = function(el,e){
  var col = $(el).index(),
      row = $(el).closest('tr').index();
  console.log({col,row});
  e.preventDefault();
}
FormProperties.prototype.selectedText = function(el){
  $(el).setSelectionRange(0, this.value.length)
}
FormProperties.prototype.changeValueProperty = function(el,tag='input'){
  var value = $(el).val();
  var key = -1;
  if(tag == 'select'){
    key = $(el).val();
    value = $(el).find("option:checked").html();
  }

  // add data input
  $(el).closest("td").find("span.data-input").find("input[type=hidden][name*=key]").val(key);
  $(el).closest("td").find("span.data-input").find("input[type=hidden][name*=value]").val(value);

}

FormProperties.prototype.changeProperty = async function(el){

  var value = $(el).find("option:selected").html();
  var key = $(el).val();
  var col = $(el).closest("th").index();
  var group = $(el).closest("tr[data-group]").length > 0 ? $(el).closest("tr[data-group]").index() : 1;
  var row = group == 0 ? 0 : group;
  var header_property = $(el).closest("th");
  console.log({key,value,row,col,group})

  // add data input
  header_property.find("span.data-input").find("input[type=hidden][name*=key]").val(key);
  header_property.find("span.data-input").find("input[type=hidden][name*=value]").val(value);

  // remove select and add value
  var text = '<p>'+ value + ' <i data-btn="edit" class="fa fa-pencil-square-o" aria-hidden="true" title="Click to edit property"></i></p>';
  var span = $(el).closest("th").find('span.data-input').html();
  var properties_row = this.root.find("tr").eq(row).find('th').eq(col);

  properties_row.html(`
  ${ text }
  <span class="data-input">
    ${ span }
  </span>
  `);
  var child_row = row + 1;
  this.initChildProperty(value,child_row,col);

  this.refreshTable();

}
FormProperties.prototype.initChildProperty = async function(value,row,col){
  // check value property options
  var options = await this.send({field:value},'getOptions',{html:true});
  var properties_child_row = this.root.find("tr").eq(row).find('td').eq(col);
  var data_input = properties_child_row.find("span.data-input").html();

  if(options){

    properties_child_row.html(`
      ${options}
      <span class="data-input">
      ${ data_input }
      </span>
      `)
        .find("select")
        .select2();

  }else{

    properties_child_row.html(`
      <input type="text" class="form-control" />
      <span class="data-input">
      ${ data_input }
      </span>
      `);

  }
}
FormProperties.prototype.editProperty = async function(el){
  var par = $(el).closest("th");
  var propertyOptions = await this.send({field:'MT_properties'},'getOptions',{html:true});
  var data_input = par.find("span.data-input").html();
  par.html(`
    ${ propertyOptions }
    <span class="data-input">
    ${ data_input }</span>
  `).find('select').select2()
}
FormProperties.prototype.createNameInput = function(col){

  var key_odd = `table[${ this.group_no }][1][${ col }][key]`;
  var value_odd = `table[${ this.group_no }][1][${ col }][value]`;
  var key_even = `table[${ this.group_no }][2][${ col }][key]`;
  var value_even = `table[${ this.group_no }][2][${ col }][value]`;
  return {
    'odd':{
      'key':key_odd,
      'value':value_odd
    },
    'even':{
      'key':key_even,
      'value':value_even
    }
  }
}
FormProperties.prototype.addNextProperty = async function(el){

  var propertyOptions = await this.send({field:'MT_properties',ajax:true},'getOptions',{html:true});
  var $th = $(el).closest("th");
  var col = $th.index();
  var input_name = this.createNameInput(col);

  $th.before(`
  <th>
    ${propertyOptions}
    <span class="data-input">
      <input type="hidden" name="${ input_name.odd.key }"/>
      <input type="hidden" name="${ input_name.odd.value }"/>
    </span>
  </th>
  `);
  $th.prev().find("select").select2();

  var row = $(el).closest("tr").index()+1;
  this.root.find("tr").eq(row).find('td').eq(col).before(
      `<td>
    <input type="text" class="form-control"/>
    <span class="data-input">
      <input type="hidden" name="${ input_name.even.key }"/>
      <input type="hidden" name="${ input_name.even.value }"/>
    </span>
  </td>`
  );

  this.scrollLeftSmooth($th,".box-properties");
}
FormProperties.prototype.removeRow = function(){
  var _this = this;
  var par = this.root.find("tr.active");

  if (par.length > 0) {
    $.alerts.confirm('Are you sure you want to delete?', 'Confirm',function (r) {
      if (r) {
        $.ajax(par.remove())
            .then(()=>_this.refreshTable())

      }
    })
  }


}
FormProperties.prototype.addFirstProperty = function(){
  var index = this.root.find("tr[data-group]").length;
  index = index ? index/2+1 : 1;
  var value = $("[data-first-name]").data("first-name");
  var key = $('[data-first-key]').data("first-key");
  this.group_no++;

  var html =`<tr class="active" data-group="${ this.group_no }">
  <th style="min-width: 20px; max-width: 20px;">&nbsp;</th>
  <th>
      <p>${ value }</p>
      <span class="data-input">
          <input type="hidden" name="table[${ this.group_no }][1][1][key]" value="${ key }"/>
          <input type="hidden" name="table[${ this.group_no }][1][1][value]" value="${ value }"/>
      <span>
  </th>
  <th>
      <i data-btn="new" class="fa fa-plus-circle" aria-hidden="true" title="Click to new property"></i>
  </th>
</tr>
<tr class="active" data-group="${ this.group_no }">
  <td>${ index }</td>
  <td>
      <input type="text" class="form-control" />
      <span class="data-input">
          <input type="hidden" name="table[${ this.group_no }][2][1][key]" value="-1"/>
          <input type="hidden" name="table[${ this.group_no }][2][1][value]"/>
      <span>
  </td>
  <td></td>
</tr>`

  this.refreshTable({clear_active:true});

  var $tr = this.root.find("tbody").append(html).find('tr').last();
  var $th = $tr.find("th");
  this.scrollLeftSmooth($th,".box-properties");
  this.scrollTopSmooth($tr,".box-properties");
}
FormProperties.prototype.toggleShowCopy = function(el){
  var isPress = $(el).hasClass("press");
  var isSelected = this.root.find("tr.active").length >1;
  if(isSelected){
    if(isPress)
      $(el).removeClass("press")

    if(!isPress)
      $(el).addClass("press")
  }


}
FormProperties.prototype.toggleShowEdit = function(el){
  var isPress = $(el).hasClass("press");
  if(isPress)
    $(el).removeClass("press")

  if(!isPress)
    $(el).addClass("press")

  this._isPressEdit = isPress;
}
FormProperties.prototype.refreshTable = function(option={}){
  // upgrade show edit
  if(this._isPressEdit)
    this.root.find("th").each(function(){
      $(this).find("i").css("display","inline");
    })
  if(!this._isPressEdit)
    this.root.find("th").each(function(){
      $(this).find("i").css("display","none");
    })

  // clear active : selected row
  if(option.clear_active){
    this.root.find("tr").removeClass("active");
    this.root.find("#copy-row").removeClass("press");
  }

  // reset number sort
  this.resetNumber()

}
FormProperties.prototype.resetNumber = function(){
  var par = this.root.find("tbody tr[data-group]:nth-child(even)");
  var no = 1;
  par.each(function(){

    $(this).find("td").eq(0).html(no);
    no++;
  })
}
FormProperties.prototype.showBtnEdit = function(el){
  if(!this._isPressEdit)
    $(el).find('i').css("display","inline");
}
FormProperties.prototype.hideBtnEdit = function(el){
  if(!this._isPressEdit)
    $(el).find('i').css("display","none");
}
FormProperties.prototype.selectRow = function(el){

  this.root.find('tbody tr').removeClass("active");

  var isOdd = $(el).index() % 2 == 1;
  $(el).addClass("active");
  if(isOdd){
    $(el).prev().addClass("active");
  }else{
    $(el).next().addClass("active");
  }

}
class Layer extends Modules_template{
  constructor(el){
    super(el)
    this.row = this.root.find("[data-layer1]").length >0 ? this.root.find("[data-layer1]").length : 0;
    // refresh selec2
    this.resetChosen();
    this.layer1_row = null;
    this.createSortable();
    this.createShortcuts();
    this.setAllLabelHeight();
    

  }
}
Layer.prototype.setAllLabelHeight = function(){
  var _this = this;
  $("[data-layer1]").each(function(){
    var row = $(this)
    _this.setLabelHeight(row);
  })
}
Layer.prototype.createSortable = function(){
  var _this = this;
  var el = document.getElementById("sortable");
  Sortable.create(el, { 
    swap: true, // Enable swap plugin
    handle:'.draggable-item',
    swapClass: 'highlight', // The class applied to the hovered swap item
    animation: 150,
    onUpdate:function(){
      _this.refreshTable();
      

    }
   });
  
  this.root.find(".row.layer2").each(function(){

    new Sortable(this, {
      animation: 150,
      group: 'shared',
      handle:'.control-label',
      ghostClass: 'blue-background-class',
      onUpdate:function(){
        _this.refreshTable();
        
  
      }
    });
  })
  
  
}
Layer.prototype.addEventListener = function(){
  var _this = this;
  this.root.on("click","#new-layer",function(){
    _this.addLayer(this)
        .then(()=>_this.saveHtml());

  }).on("click","[data-btn=remove-layer1]",function(){
    _this.removeLayer(this);
    
  }).on("click","[data-btn=add-layer2]",function(){
    _this.openFormProperty(this);
  }).on("click",".info-header [data-btn=edit-layer1]",function(e){
    e.preventDefault();
    e.stopPropagation();
    _this.editNameLayer2(this);
    
  }).on("click","[data-btn=edit-layer2]",function(){
    _this.editPropsLayer2(this);
    
  }).on("click","[data-btn=edit-module]",function(){
    _this.editModuleName();
  }).on("click","[data-btn=edit-toggle]",function(){
    _this.toggleEdit(this);
    var row = $(this).closest("[data-layer1]");
    _this.setLabelHeight(row);
    
  }).on("click","[data-layer1]",function(){
    _this.layer1 = $(this);
  }).on("blur",".item-info input",function(){
    _this.setValueInput(this);
  });

  // save html
  $("#page-header").on("click","#submitBtn",function(e){
    _this.saveHtml();
  })

  // modal properties layer 2
  $("#modal-list-old").on("click","[data-btn=add-property]",function(){
    _this.newProperty(this)
    
  }).on("click",".btn-add-layer2",function(){
    _this.addLayer2(this);
  }).on("click",".btn-update-layer2",function(){
    _this.updatePropsLayer2(this);
    
  }).on("click",".btn-delete-layer2",function(){
    _this.deleteLayer2();
    
  })

  // modal layer1 name
  $("#modalWapper").on("click","button[type=submit]",function(){
    _this.submitWapperModal(this);
    
  })

}
Layer.prototype.toggleEdit = function(el){
  var isPress = $(el).data("press");
  var row = $(el).closest("[data-layer1]");
  isPress = !isPress;
  $(el).data("press", isPress);

  if (isPress == true){
    row.find(".fa.fa-pencil-square-o:not([data-btn=edit-toggle])").removeClass("hidden");
  }

  if (isPress == false) {
    row.find(".fa.fa-pencil-square-o:not([data-btn=edit-toggle])").addClass("hidden");
  }

}
Layer.prototype.setLabelHeight = function(row){
  var max = 0;
  // set default
  row.find(".control-label.col-sm-12").css("height","auto");

  row.find(".control-label.col-sm-12").each(function(){
    var h = $(this).css("height").replace("px","");
    max = max < parseInt(h) ? parseInt(h) : max;
  })
  row.find(".control-label.col-sm-12").css("height",max+"px");
}

Layer.prototype.editModuleName = function(){
  this.editNameAction = 'moduleName';
  var name = $("h2.module-name [name=module_no]").val();

  $("#modalWapper").find("#new_name").val("");
  $("#modalWapper").find("#old_name").val(name);
  $("#modalWapper").modal('show');
}
Layer.prototype.updatePropsLayer2 = async function(el){
  var arr = $(el).closest("#modal-list-old").find("form").serializeJSON();
  var row = this.layer1_row;
  var isPress = this.layer1.find(".edit-toggle").find("[data-press]").data("press");
  var isHide = isPress == false ? true : false;
  arr = JSON.stringify(arr);
  console.log({ isHide })
  var new_form = await this.send({
    data:arr,
    hide:isHide
  },"loadLayer2",{html:true})

  var old_form = this.layer2_row.closest(".form-group");
  
  var position = old_form.index();
  // console.log({html:old_form.html(),position});
  row.find(".form-group").eq(position).before(new_form)
  old_form.remove()
  
  this.setLabelHeight(row);

}
Layer.prototype.resetChosen = function(){

  this.root.find("select2").each(function(){
    try {
      $(this).chosen("destroy")
    } catch (error) {

    }
  })

}
Layer.prototype.saveHtml = function(){

  var data = [];
  $('body').find("[data-layer1]").each(function(){

    var name = $(this).find(".title-layer1").find("a").text().trim();
    var row = {
      name:name,
      data_layer2:[]
    };
    $(this).find(".data-props").each(function(){
      var json = $(this).text();
      json = json ? JSON.parse(json) : [];
      row['data_layer2'].push(json)
    })

    data.push(row);


  })
  
  data = JSON.stringify(data);
  var hasData = $("#tabs-3").find("#data").length > 0;
  if(hasData){
    $("#data").val(data);
  }else{
    var input = $("<input>").prop({
      name:"data",
      id:"data",
      type:"hidden"
    }).val(data)

    $("#tabs-3").prepend(input);
  }

}
Layer.prototype.refreshTable = function(){
  var no = 1;
  this.root.find("[data-layer1]").each(function(){

    $(this).find('span.stt-name').html(no);
    var row = no - 1;
    $(this).find('button[data-row]').data('row',row);
    no++;
  })
}
Layer.prototype.editPropsLayer2 = async function(el){
  this.layer1_row = $(el).closest("[data-layer1]").find(".row.layer2");
  this.layer2_row = $(el).closest(".control-label");
  var data = $(el).prev().html();
  data = JSON.parse(data);
  var html = await this.send({no:-1,data:data},"modalLayerProperties",{html:true});

  $('#modal-list-old').find(".modal-body").html(html);
  $('#modal-list-old').modal('show');

  this.toggleUpdateADD();
}
Layer.prototype.toggleUpdateADD = function(isUpdate=true){
  if(isUpdate){
    $('#modal-list-old').find(".btn-update-layer2").removeClass("hidden");
    $('#modal-list-old').find(".btn-delete-layer2").removeClass("hidden");
    $('#modal-list-old').find(".btn-add-layer2").addClass("hidden");

  }else{

    $('#modal-list-old').find(".btn-update-layer2").addClass("hidden");
    $('#modal-list-old').find(".btn-delete-layer2").addClass("hidden");
    $('#modal-list-old').find(".btn-add-layer2").removeClass("hidden");

  }

}
Layer.prototype.deleteLayer2 = function(){
  this.layer2_row.closest(".form-group").remove();
}
Layer.prototype.submitWapperModal = function(el){
  var action = this.editNameAction;
  switch (action) {
    case 'moduleName':
      this.setModuleName();
      break;

    default: // layer1
      this.setNameLayer1();
      break;
  }

}
Layer.prototype.setModuleName = function(){
  var name = $("#modalWapper").find("input[name=new_name]").val();
  $("h2.module-name").html(`
  ${ name }
  <input type="hidden" name="module_no" value="${ name }">
  <i data-btn="edit-module" class="fa fa-pencil-square-o" aria-hidden="true"></i>
  `)
}
Layer.prototype.setNameLayer1 = function(){
  var name = $("#modalWapper").find("input[name=new_name]").val();
  var row = $("#modalWapper").find("input[name=row]").val();

  this.root.find("[data-layer1]").eq(row).find(".info-header a[data-toggle=collapse]").html(`
  ${name} <i data-btn="edit-layer1" class="fa fa-pencil-square-o" aria-hidden="true"></i>
  `);
}
Layer.prototype.editNameLayer2 = function(el){
  this.editNameAction = 'layer1';
  var name = $(el).closest("a").text().trim();
  var row = $(el).closest("[data-layer1].panel-default").index();
  $("#modalWapper").find("[name=row]").val(row);
  $("#modalWapper").find("#old_name").val(name);
  $("#modalWapper").find("#new_name").val("");
  $("#modalWapper").modal('show');
}
// Layer.prototype.getDataInput = function(el){
//   var data = {};
//   $(el).closest("#modal-list-old").find("form").find(".form-group").each(function(){
//     var value = $(this).find("input").val();
//     if(!value) value = $(this).find("select").val();
//     var name = $(this).find("input").prop("name");
//     console.log({name,value})
//     data[name] = value;
//   })
//   return data;
// }
Layer.prototype.setValueInput = function(el){
  var value = $(el).val();
  var data = $(el).closest(".form-group").find(".data-props.hidden").text()
  data = JSON.parse(data);
  data.layer2.value = value;
  console.log({data});
  data = JSON.stringify(data);
  
  $(el).closest(".form-group").find(".data-props.hidden").text(data);
}
Layer.prototype.addLayer2 = async function(el){

  var arr = $(el).closest("#modal-list-old").find("form").serializeJSON();
  // var arr = this.getDataInput(el);
  console.log({arr});
  delete arr.layer2.properties;
  var row = this.layer1_row;
  var isHide = row.find("[data-btn=toggle-edit]").hasClass("press");
  
  arr = JSON.stringify(arr);
  var form_group = await this.send({
    data:arr,
    hide:isHide
  },"loadLayer2",{ html:true })

  row.append(form_group);

  this.setLabelHeight(row);

}


Layer.prototype.newProperty = async function(el){

  var name = $(el).closest(".form-group").find("option:selected").text();
  console.log({name});
  var options = await this.send({ field:name ,ajax:true},'getOptions',{ html:true });
  options = options ? options : `<input type="text" name="layer2[${ name }]" class="form-control" value="">`;
  $(el).closest(".modal-body").find(".form-group").removeClass("new");

  await $(el).closest(".form-group").before(`
  <div class="form-group col-sm-3 new">
    <i class="fa fa-close remove-ship" title="Click to delele "></i>
    <label>${ name }</label>
    ${ options }
  </div>
  `);
  $(el).closest(".form-group").find("input").val('');
  this.delLayertitle();
  if (name =='col background color'){
    this.showLabelOptions()
  }
}

Layer.prototype.showLabelOptions = function(){

  $("#modal-list-old").find(".form-group.col-sm-3.new .form-control.select2").select2({
    templateResult: function (data, container) {
      console.log({data})
      var $result = $("<div style='background:" + data.text +";padding:0.5rem;border-radius:2px;color:white'></div>");
      $result.text(data.text);
      return $result;
    }
  });

}
Layer.prototype.openFormProperty = async function(el){
  var layer1_no = $(el).data("row")-1;
  this.layer1_row = $(el).closest("[data-layer1]").find(".row.layer2");

  var html = await this.send({no:layer1_no},"modalLayerProperties",{html:true});

  $('#modal-list-old .modal-body').html(html);

  $('#modal-list-old').modal('show');
  this.toggleUpdateADD(false);
}
Layer.prototype.removeLayer = function(el){
  $(el).closest("[data-layer1]").remove();
  this.refreshTable();
  this.row--;
}

Layer.prototype.addLayer = async function(el){
  var name = $(el).closest(".row").find("[name=layer]").val();

  name = name ? name : 'No-name';
  this.row++;
  var html = await this.send({name:name,row:this.row},"getLayer",{html:true});

  $("#sortable").append(html);
  var top = $("[data-layer1]").last().offset().top;
  $("#sortable").animate({ scrollTop: top }, 1000);

  $(el).closest(".row").find("[name=layer]").val(null);
  return true;
}
Layer.prototype.delLayertitle = function(el){
  $(document).on("click",".remove-ship",function() {
    $(this).parent().remove();
  });
}
Layer.prototype.createShortcuts = function(){

  var _this = this;
  
  // hotkeys('ctrl+c',function(event, handler){

  //   if(_this.layer1){
  //     var name = $(_this.layer1).find(".title-layer1").find("a").text().trim();
  //     console.log({name})
  //     showNoti("Layer 1: "+name + " copied!","Alert","War");
  //   }

  // })
 
  // hotkeys('ctrl+v',function(event, handler){

  //   if(_this.layer1){
  //     var name = $(_this.layer1).find(".title-layer1").find("a").text().trim();
  //     $("#sortable").append(`
  //     <div data-layer="1" class="panel panel-default ">
  //     ${_this.layer1.html()}
  //     </div>
  //     `);
  //     _this.refreshTable();
      
  //     var top = $("[data-layer1]").last().offset().top;
  //     $("#sortable").animate({ scrollTop: top }, 1000);

  //     showNoti("Layer 1: "+name + " parse!","Successfull","Ok");
  //   }

  // })

  
}

class TabProduct extends Modules_template{
  constructor(){
    super();
    this.modal = $("#mt_pt_add_model");
    this.modal2 = $("#mt_pt_add_model_2");
    this.row1 = this.modal.find(".m-tbl-rows table tbody").find("tr").length;
    this.row1 = this.row1 ?? 0;
    this.row2 = this.modal2.find(".m-tbl-rows table tbody").find("tr").length;
    this.row2 = this.row2 ?? 0;

  }
}
TabProduct.prototype.addEventListener = function(){
  var _this = this;
  this.createSortable();

  this.modal.on("click",".m-btn-them",function(){
    _this.addRow1(this);
  }).on("click",".del-m-tbl-rows",function(){
    _this.removeRow(this,1);
  }).on("click",".submit-row",function(){
    _this.addRowModal1(this);
  })

  this.modal2.on("click",".m-btn-them",function(){
    _this.addRow2(this)
  }).on("click",".del-m-tbl-rows",function(){
    _this.removeRow(this,2);
  }).on("click",".submit-row",function(){
     _this.addRowModal2(this);
  })

  // function body
  $("body").on("click",".nav.nav-tabs .nav-link",function(){
    _this.setActiveTab(this);
  })

  // render
  this.setWidthFooter();

}
TabProduct.prototype.setWidthFooter = function(){
  // var width = 0;
  // $("body").find(".wrap-t2-main-tbl .t2-main-tbl [name*=width]").each(function(){
  //   var w = $(this).val();
  //   w = w.replace("px","");
  //   width += parseInt(w);
  // })

  // $("body").find(".wrap-t2-main-tbl .wrap-t2-line-2").css("width", width+"px");

 
}
TabProduct.prototype.setActiveTab = function(el){
  var index = $(el).closest(".nav-item").index();
  $("input[name=active_tab]").val(index);
  
}
TabProduct.prototype.getDataForm = function(el){
  var form = $(el).closest("form");
  var data = [];
  $(form).find("tbody").find("tr").each(function(){
    var row = {
      name:$(this).find("input[name*=name]").val(),
      value: $(this).find("input[name*=value]").val(),
      align:$(this).find("select[name*=align]").val(),
      width:$(this).find("input[name*=width]").val(),
      type:$(this).find("select[name*=type]").val()
    };
    data.push(row);
  })
  data = data.reverse();
  if(data.length==0) data = 'empty';
  return data;
}
TabProduct.prototype.addRowModal1 = async function(el){
  var data = this.getDataForm(el);
  var id = $("#id").val();
  var html = await this.send({ data,id },'importProductLine1',{ html:true })
  $("#tabs-2").find(".t2-main-tbl").find("tbody").html(html);
  this.setWidthFooter();
}

TabProduct.prototype.addRowModal2 = async function(el){
  var data = this.getDataForm(el);
  var id = $("#id").val();
  var html = await this.send({ data,id },'importProductLine2',{ html:true })
  $("#tabs-2").find(".wrap-t2-line-2").html(html)
  this.setWidthFooter();
}

TabProduct.prototype.removeRow = function(el,line){
  $(el).closest("tr").remove();

  if(line==1) this.refreshIndexRowLine1();
  if(line==2) this.refreshIndexRowLine2();
}
TabProduct.prototype.addRow1 = async function(){
  var index = this.row1;
  var html = await this.send({ index },'importNewRow',{ html : true })
  this.modal.find(".m-tbl-rows table tbody").prepend(html);
  this.refreshIndexRowLine1();
}
TabProduct.prototype.addRow2 = async function(){
  var index = this.row2;
  var html = await this.send({ index },"importNewRow",{ html: true });
  this.modal2.find(".m-tbl-rows table tbody").prepend(html);
  this.refreshIndexRowLine2();
}
TabProduct.prototype.refreshIndexRowLine1 = function(){
    this.modal.find('.m-tbl-rows table tr .m-stt-col').each(function(index) {
      $(this).html(index+1);
      $(this).next().find('.hd-of').val(index+1);
    });
}
TabProduct.prototype.refreshIndexRowLine2 = function(){
  this.modal2.find('.m-tbl-rows table tr .m-stt-col').each(function(index) {
      $(this).html(index+1);
      $(this).next().find('.hd-of').val(index+1);
  })
}
TabProduct.prototype.createSortable = function(){
  var _this = this;

  this.modal.find("tbody").each(function(){
    new Sortable(this,{
      animation: 150,
      onUpdate:function(){
        _this.refreshIndexRowLine1();
      }
    })
  })

  this.modal2.find("tbody").each(function(){
    new Sortable(this,{
      animation: 150,
      onUpdate:function(){
        _this.refreshIndexRowLine2();
      }
    })
  })

}
class MenuContext extends Layer{
  constructor(el) {
    super(el)
    this.menu = $("#main-menu");
    this.layer1 = null;
    this.layer2 = null;
    this.layer2_index = null;
  }
}
MenuContext.prototype.addEventListener = function(){
  var _this = this;

  $(document)
  .on("contextmenu", function (event){
    _this.onContextMenu(event);
  }).on("click","[data-layer2]",function(e){
    e.preventDefault();
    e.stopPropagation();
    _this.clearState();
    _this.addTargetLayer2(this);
    
  }).on("click","[data-layer1]",function(){
    _this.clearState();
    _this.addTargetLayer1(this);
  }).on('mousedown',"form", function () {
    _this.onMouseDown();
  }).on('click',function(e){
    _this.clearStateOutSideLayer(e);
  });


  $("#sortable").scroll(function(){
    _this.hideMenu();
  })
  
  this.menu.on("click", "[data-btn=copy_layer2_menu]", function () {
    _this.copyLayer2();
  }).on("click", "[data-btn=paste_layer2_menu]", function () {
    _this.pasteLayer2();
  }).on("click", "[data-btn=remove_layer2_menu]", function (){
    _this.removeLayer2();
  }).on("click","[data-btn=edit_layer2_menu]",function(){
    _this.editLayer2();
  }).on("click","[data-btn=new_layer2_menu]",function(){
    _this.newLayer2();
  }).on("click",".menu-item .menu-btn",function(){
    _this.clearState();
  }).on("click", "[data-btn=remove_layer1_menu]", function () {
    _this.removeLayer1();
  }).on("click", "[data-btn=copy_layer1_menu]", function () {
    _this.copyLayer1();
  }).on("click", "[data-btn=paste_layer1_menu]", function () {
    _this.pasteLayer1();
  }).on("click", "[data-btn=edit_layer1_menu]", function () {
    _this.editLayer1();
  });

}
MenuContext.prototype.editLayer2 = function () {

  if (this.layer2){
    var el = this.layer2.find("[data-btn=edit-layer2]");
    el.click();
  }
  
}
MenuContext.prototype.editLayer1 = function(){
  var el = this.layer1.find("[data-btn=edit-layer1]");
  el.click();

}
MenuContext.prototype.clearStateOutSideLayer = function(e){

  if ($(e.target).closest("[data-layer1]").length === 0 && $(e.target).closest("#main-menu").length === 0 ) {
    this.clearState();
    this.layer1 = null;
    this.layer2 = null;
  }
}
MenuContext.prototype.newLayer2 = function(){

  if(this.layer1){
    this.layer1.find("[data-btn=add-layer2]").click();
  }
  if(this.layer2){
    this.layer2.closest("[data-layer1]").find("[data-btn=add-layer2]").click();
  }
}
MenuContext.prototype.pasteLayer1 = function () {
  var html = localStorage.getItem('copy_layer1');
  if(!html){
    showNoti("No layer1 to paste", "Pastespecial failed ", "Err");
    return false;
  }

  $("#sortable").append(html);
  var top = $("[data-layer1]").last().offset().top;
  $("#sortable").animate({ scrollTop: top }, 1000);
  this.refreshTable();

}
MenuContext.prototype.copyLayer1 = function () {

  var txt = this.layer1.find(".info-header .title-layer1").text();
  var index = $("[data-layer1]").length +1;
  var html = "<div data-layer1='" + index +"' class='panel panel-default'>" + this.layer1.html() + "</div>";
  localStorage.setItem('copy_layer1', html);
  showNoti(txt, "Copy Layer 1", "Ok");

}
MenuContext.prototype.pasteLayer2 = function(){

  var row = this.layer1 ? this.layer1.find(".row.layer2") : this.layer2.closest("[data-layer1]").find(".row.layer2");
  if(this.layer2_html && row ){
    row.append(this.layer2_html);
    this.layer2_html = null;
  }

}
MenuContext.prototype.copyLayer2 = function(){

  var clone_html = this.layer2.clone();
  clone_html.data("layer2",null);
  this.layer2_html = clone_html;

  showNoti("Success", "Copy Layer 2", "Ok");
}
MenuContext.prototype.clearState = function(){
  this.hideMenu();
  $("[data-layer2]").removeClass("target");
  $("[data-layer1]").removeClass("target");
}
MenuContext.prototype.removeLayer1 = function(){
  if(this.layer1){
    this.layer1.remove();
  }
}
MenuContext.prototype.removeLayer2 = function () {
  if (this.layer2_index) {
    $("[data-layer2=" + this.layer2_index+"]").remove();
    this.layer2_index = null;
  }
  if(this.layer2){
    this.layer2.remove();
  }
  if(!this.layer2_index && !this.layer2){
    $("[data-layer2]").removeClass("target");
  }
}
MenuContext.prototype.addTargetLayer1 = function (el) {

  this.layer1 = $(el);
  this.layer2 = null;
  $(el).addClass("target");

}

MenuContext.prototype.addTargetLayer2 = function(el){

  var data = $(el).data();
  this.layer1 = null;
  this.layer2 = $(el).closest("[data-layer2]");

  if (data&&data.layer2){
    this.layer2 = $(el);
  }

  this.layer2.addClass("target");
  this.layer2_index = this.layer2.data("layer2");

}
MenuContext.prototype.showMenu = function(x,y){

  var left = (x) +'px';
  var top = (y-50) + 'px';
  $("#main-menu").css({left,top})
  this.menu.addClass('menu-show');

}
MenuContext.prototype.hideMenu = function(){

  this.menu.removeClass('menu-show');

}
MenuContext.prototype.onContextMenu = function(e) {

  e.preventDefault();
  this.pasteStateToViewMenu();
  this.showMenu(e.pageX, e.pageY);

}
MenuContext.prototype.pasteStateToViewMenu = function(){

  var data = this.getStateMenu();
  console.log({data})

  if (data.layer1 == false && data.layer2 == false){
    this.menu.addClass("hidden");
  } 

  if (!(data.layer1 == false && data.layer2 == false)){
    this.menu.removeClass("hidden");
  }
  
  if (data.layer2 == false){
    this.menu.find("[data-btn=remove_layer2_menu]").addClass("hidden");
    this.menu.find("[data-btn=copy_layer2_menu]").addClass("hidden");
    this.menu.find("[data-btn=edit_layer2_menu]").addClass("hidden");
    this.menu.find("[data-btn=paste_layer2_menu]").addClass("hidden");
  } 

  if (data.layer2 == true){
    this.menu.find("[data-btn=remove_layer2_menu]").removeClass("hidden");
    this.menu.find("[data-btn=copy_layer2_menu]").removeClass("hidden");
    this.menu.find("[data-btn=edit_layer2_menu]").removeClass("hidden");
    
  } 

  if (data.copy_layer2 == false) {
    this.menu.find("[data-btn=paste_layer2_menu]").addClass("hidden");
  }

  if (data.copy_layer2==true){
    this.menu.find("[data-btn=paste_layer2_menu]").removeClass("hidden");
  }
  
  if (data.layer1 == false){
    this.menu.find("[data-btn=remove_layer1_menu]").addClass("hidden");
    this.menu.find("[data-btn=copy_layer1_menu]").addClass("hidden");
    this.menu.find("[data-btn=edit_layer1_menu]").addClass("hidden");
  } 

  if (data.layer1 == true){
    this.menu.find("[data-btn=remove_layer1_menu]").removeClass("hidden");
    this.menu.find("[data-btn=copy_layer1_menu]").removeClass("hidden");
    this.menu.find("[data-btn=edit_layer1_menu]").removeClass("hidden");
  } 

}
MenuContext.prototype.getStateMenu = function(){

  return {
    layer1: this.layer1 ? true : false,
    layer2: this.layer2 ? true : false,
    copy_layer2: this.layer2_html ? true : false
  }

}
MenuContext.prototype.onMouseDown = function(e){
  this.hideMenu();
}
$(function(){

  // var fp = new FormProperties("#tabs-3");
  // fp.addEventListener();
  var le = new Layer("#tabs-3");
  le.addEventListener();
  var tp = new TabProduct("#tabs-2");
  tp.addEventListener();
  var mc = new MenuContext('#tabs-3');
  mc.addEventListener();
}())
