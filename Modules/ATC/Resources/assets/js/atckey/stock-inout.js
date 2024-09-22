
$(document).ready(function() {
    csclist($('#idHD').val());
    //alert($('#status_block').val());
       if($('#status_block').val() ==0){
           if($( '#act' ).val()=='stock_export'){

        
        debits();
        }
    }
         
   /* $('#submitBtn').on('click', function() {
        var Creadit  =parseFloat($('#Creadit').val().replace(/\s/g, '').replace(/,/g, ''));
        var debits  = parseFloat($('#debits').val().replace(/\s/g, '').replace(/,/g, ''));
      //  console.log(debits);
      //  console.log(' ,Creadit: '+Creadit);
      var flag = false;

        if (debits > Creadit) {
                    flag = true;
                }
                if (flag) {
                    $.alerts.confirm('Order value and total debt are greater than the debt limit.<br>Are you sure to create an order?', 'Confirm', function(e) {
                        if (e) {
                            $('#updateFrm').submit();
                        }
                    });
                    return false;
                }
                $('#updateFrm').submit();
            

             //   $('#updateFrm').submit();
                   
                
            
       
    });*/

    $('.highlightNoClick .icon-remove').click(function(){
    });
   if ($('#act').val() == 'stock_export'){ cpo_detail_load();}
    $('body').on('click', '.tools-link.edit', function () {
        var toolsDiv = $(this).parent();
        toolsDiv.children('.delete').toggleClass('delete cancel').children('span').text('Cancel');
        $(this).toggleClass('edit apply').children('i').toggleClass('fa-edit fa-check').next('span').text('Apply');
    }).on('click', '.tools-link.apply', function () {
        var toolsDiv = $(this).parent();
        toolsDiv.children('.cancel').toggleClass('cancel delete').children('span').text('Delete');
        $(this).toggleClass('apply edit').children('i').toggleClass('fa-check fa-edit').next('span').text('Edit');
    }).on('click', '.tools-link.cancel', function () {
        var toolsDiv = $(this).parent();
        toolsDiv.children('.apply').toggleClass('apply edit').children('i').toggleClass('fa-check fa-edit').next('span').text('Edit');
        $(this).toggleClass('cancel delete').children('span').text('Delete');
    }).on('click', '#itemList .del a', function() {
        $(this).parent().parent().remove();
        for (var i = 0; i < $('#itemList .highlightNoClick').length; i++) {
            $('#itemList .highlightNoClick:eq(' + i + ') td:eq(1) span').text(i + 1);
            // $('#itemList .highlightNoClick:eq(' + i + ') .sortItem').val(i + 1);
        }
        sum_all();
    }).on('click', '.highlightNoClick .icon-remove', function() {
        var parent = $(this).closest('tr').next().remove();
    }).on('change', '#customerid', function() {
          $('#itemList tbody').empty();
          $('#debits').val(0);
          $('#Creadit').val(0);
          $('#CreaditStatus').val('');
          $('#cpoid').val('');
          $('#cpoDate').val('');
          $('#cpoApprove').val('');
          
          $.ajax({
              url: site_url + $('#act').val() + '/debits',
              cache: false,
              type: 'POST',
              data: {
                  id: $(this).val(),
                  //table: 'customer_sales_contract',
                //  act: $('#act').val()
              },
              success: function(string) {
               //   console.log(string);
                  var getData = $.parseJSON(string);
                    if ( Array.isArray( getData ) && getData.length ) {
                          for ( var i = 0; i < getData.length; i++ ) {
                           //   console.log(getData[ i ][ 'InvoiceRest' ]);
                              $('#debits').val(accounting.formatMoney(getData[ i ][ 'InvoiceRest' ],'',0));
                             // .order-qty[name*=OrderQuantity]
  
  
                          }
                      }
              }
          })
          $.ajax({
              url: site_url + 'ajax/get_info_with_id',
              cache: false,
              type: 'POST',
              data: {
                  id: $(this).val(),
                  table: 'customers',
                  act: $('#act').val()
              },
              success: function(string) {
                  var getData = $.parseJSON(string);
                  $('#Creadit').val(accounting.formatMoney(getData.CreditLineNumber,'',0));

               //   $('#cpoApprove').val("Approved");
                //  $('#cpoStatus').val("CPO Completed");
  
              }
              
          })
          $.ajax({
            url: site_url + $( '#act' ).val() + '/get_cpo',
            cache: false,
            type: 'POST',
            data: {
                id: $(this).val(),
            },
            success: function ( string ) {
              //  console.log( string );

							var getData = $.parseJSON( string );
							console.log( getData );
							$( '#cpoid' ).empty();
							$cpoidOptions = '<option value=""></option>';
							if ( Array.isArray( getData ) && getData.length ) {
								for ( var i = 0; i < getData.length; i++ ) {
									$cpoidOptions += '<option value="' + getData[ i ][ 'id' ] + '">'+getData[ i ][ 'id' ]+' - ' + getData[ i ][ 'code' ] + '</option>';
								}
							}

							
							
								$( '#cpoid' ).html( $cpoidOptions ).trigger( 'chosen:updated' );
							
						}
                  
            
        })
          setTimeout(function() {
            var Creadit  =parseFloat($('#Creadit').val().replace(/\s/g, '').replace(/,/g, ''));
            var debits  = parseFloat($('#debits').val().replace(/\s/g, '').replace(/,/g, ''));
           // console.log('Creadit: '+Creadit)
          //  console.log('debits: '+debits)
           // console.log('Creadit: '+Creadit)

            if(  debits > Creadit ){
                $('#CreaditStatus').val('Over Credit');
    
            }else{
    
                $('#CreaditStatus').val('Non - Over Credit');
    
            }
           // import_row();
        }, 1200);
       // var id= $('#cpoid').val(0);

      //  cpo();
      cpo_detail_load();
         
      }).on('click', '.btn-execute-cost', function () {
        var lenght1 = $('.fg-posc').length;
        //alert(lenght1);
            for (i = 0; i < lenght1; i++) {
                var idpo=$('#POCode'+i+'').val();
              //  alert(idpo);
                var amount = 0.0;
                var qtypo = 0.0;

                $('.amountUSDItem'+idpo+'').each(function() {
            
                    amount +=   parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
            
                })
                
                $('.qtypoItem'+idpo+'').each(function() {
            
                    qtypo +=   parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
            
                })
                $('.amountpo'+idpo+'').val(accounting.formatMoney(amount,'',2));
                $('.qtypo'+idpo+'').val(accounting.formatMoney(qtypo,'',0));

                
            }
          

       
var AmountBuying=0.0;
        $('.item-info .buying-amount').each(function() {
            AmountBuying += parseFloat(($(this).val().replace(/\s/g, '').replace(/,/g, '')));
        });


        var lenght = $('.fg-posc').length;
        var ShippingCost=$('#shipping_total').val()==''?0:$('#shipping_total').val().replace(/\s/g, '').replace(/,/g, '');
        var bankWeight =$('#banktotal').val()==''?0:$('#banktotal').val().replace(/\s/g, '').replace(/,/g, '');
        var declarecustomer=$('#declareTotal').val()==''?0:$('#declareTotal').val().replace(/\s/g, '').replace(/,/g, '');
        //var Buyingtyle = 

      //  var total_cos= Number(ShippingCost)+Number(bankWeight)+Number(declarecustomer);
        for (i = 0; i < lenght; i++) {
           var  amountpo=$('#amountpo'+i+'').val().replace(/\s/g, '').replace(/,/g, '');
           $('#Shipping_Cost'+i+'').val(accounting.formatMoney((Number(amountpo)/Number(AmountBuying))*Number(ShippingCost),'',4));
           $('#Bank_Cost'+i+'').val(accounting.formatMoney((Number(amountpo)/Number(AmountBuying))*Number(bankWeight),'',4));
           $('#Declare_Cost'+i+'').val(accounting.formatMoney((Number(amountpo)/Number(AmountBuying))*Number(declarecustomer),'',4));
           $('#Shipping_Cost'+i+'').val().replace(/\s/g, '').replace(/,/g, '');
           var Shipping_Cost= $('#Shipping_Cost'+i+'').val()==''?0: $('#Shipping_Cost'+i+'').val().replace(/\s/g, '').replace(/,/g, '');
           var Declare_Cost=  $('#Declare_Cost'+i+'').val()==''?0: $('#Declare_Cost'+i+'').val().replace(/\s/g, '').replace(/,/g, '');
           var Bank_Cost11=  $('#Bank_Cost'+i+'').val()==''?0:$('#Bank_Cost'+i+'').val().replace(/\s/g, '').replace(/,/g, '');
            $('#Total_Cost'+i+'').val(accounting.formatMoney((Number(Shipping_Cost)+Number(Declare_Cost)+Number(Bank_Cost11)),'',2));
            var Total_Cost = $('#Total_Cost'+i+'').val().replace(/\s/g, '').replace(/,/g, '');
         //  $('#Declare_Cost'+i+'').val(accounting.formatMoney((Number(amountpo)/Number(AmountBuying))*Number(declarecustomer),'',2));
            $('#COGSPO'+i+'').val(accounting.formatMoney(Number(Total_Cost)+Number(amountpo),'',2));
            var COGSPO = $('#COGSPO'+i+'').val().replace(/\s/g, '').replace(/,/g, '');

            $('#percentpo'+i+'').val((Number(Total_Cost)/Number(COGSPO)*100).toFixed(2));
          }
  //      $('.col-shipping_cost').val(accounting.formatMoney(ShippingCost,'',2));
     //   $('.col-back_cost').val(accounting.formatMoney(bankWeight,'',2));
     ///   $('.col-declare_cost').val(accounting.formatMoney(declarecustomer,'',2));
       // $('.col-total_cost').val(accounting.formatMoney(total_cos,'',2));
     
      
         
    }).on('keyup', '.qtyItem', function() {
        if ($('#act').val() == 'stock_export') {
            var thisQty = $(this);
            var parent = $(this).closest('tr');
            var qty = parseInt($(this).val().replace(/,/g, ''));
            var supplier_part = parent.find('.part_number .supplier-part').val();
            var lot_code = parent.find('.lot_code input').val();
            var warehouse = $('#warehouseid').val();
            var cpo =  $('#cpoid').val();
            var currentYear = new Date().getFullYear();
            $.ajax({
                url: site_url + 'stock_inout/get_inventory',
                type: 'POST',
                cache: false,
                data: {
                    supplier_part: supplier_part,
                    lot_code: lot_code,
                    warehouse: warehouse,
                    cpo: cpo,
                    year: currentYear,
                },
                success: function(string) {
               //     console.log(string);

                    var inventory = parseInt(string);
                  //  console.log(inventory);
                    if (inventory < qty) {
                        showNoti('Số lượng xuất không được lớn hơn tồn kho (' + accounting.formatMoney(inventory, '', 0) + ')', 'Cảnh báo', 'War');
                        thisQty.val(0);
                        //return false;
                    }
                }


            })

        }
    }).on('keyup keydown', '.qtyItem', function() {
        $(this).val(accounting.formatMoney($(this).val(), '', 0));
    }).on('change', '.priceUSDItem', function() {
        var USDExchangeRate = parseFloat($('#USDExchangeRate').val().replace(/\s/g, '').replace(/,/g, ''));
        var row = $(this).parent().parent();

        $(this).prev('.priceUSDItemHide').val($(this).val());
        $(this).val(accounting.formatMoney($(this).val(), '', 4));
        var priceVNDItem= parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
     

       // var qty = parseInt(row.find('.qtyItem').val().replace(/\s/g, '').replace(/,/g, ''));
        row.find('input.priceVNDItem').val( accounting.formatMoney(parseFloat((priceVNDItem * USDExchangeRate).toFixed(4)), '',0));
        var qty = parseInt(row.find('.qtyItem').val().replace(/\s/g, '').replace(/,/g, ''));
        var pricevnd = parseFloat(row.find('.priceVNDItem').val().replace(/\s/g, '').replace(/,/g, ''));

        row.find('.amountVNDItem').val(accounting.formatMoney(qty*pricevnd, '', 0));
        var amountVNDItem=parseFloat(row.find('.amountVNDItem').val().replace(/\s/g, '').replace(/,/g, ''));
        var VAT = parseFloat(row.find('.VATUSDItem').val());
        //row.find('.TAXItem').val(accounting.formatMoney(qty*($(this).val()), '', 0));

        row.find('.amountVATVNDItem').val(accounting.formatMoney(parseFloat(amountVNDItem + (amountVNDItem * VAT / 100)), '', 0));
        sum_item(row);

       // sum_all();
    }).on('change', '.priceVNDItem', function() {
        var USDExchangeRate = parseFloat($('#USDExchangeRate').val().replace(/\s/g, '').replace(/,/g, ''));
        var row = $(this).parent().parent();
      //  $(this).val(accounting.formatMoney($(this).val(), '', 0));
        var priceVNDItem1= parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
       // $(this).val(accounting.formatMoney($(this).val(), '', 0));

        row.find('input.priceUSDItem').val( accounting.formatMoney(priceVNDItem1 / USDExchangeRate, '', 5));
        var qty = parseInt(row.find('.qtyItem').val().replace(/\s/g, '').replace(/,/g, ''));
        var priceusd = parseFloat(row.find('.priceUSDItem').val().replace(/\s/g, '').replace(/,/g, ''));
        //var pricevnd = parseFloat(row.find('.priceVNDItem').val().replace(/\s/g, '').replace(/,/g, ''));
        row.find('.amountUSDItem').val(accounting.formatMoney(qty*priceusd, '', 0));
        sum_item(row);

       // sum_all();

    }).on('keyup keydown', '.qtyItem,.VATUSDItem,.end_sell_date .td-control-plus', function() {
        if ($(this).val() == '' || $(this).val() == 0) {
            $(this).val(0).select();
            
        }
        var row = $(this).parent().parent();
        // console.log(row);
        sum_item(row);

    }).on('click', '.btn-list-oldcpo', function() {
   // alert(1);
        var tr = $(this).closest('tr');
        var Mfr = escapeHtml(tr.find('.MfrPart1').text());
        var part = escapeHtml(tr.find('.supplier_part').text());
        var cpoid = tr.find('.cpoid').text();
        var priceusd = tr.find('.priceusd').text();
        var warehouse = tr.find('.warehouse').text();
       // alert(Mfr);
        var form_groups1 = $('#listold');

    //    var category = tr.find('.category');
        $.ajax({
            url: site_url + $('#act').val() + '/list_oldcpo',
            type: 'POST',
            cache: false,
            data: {
                part: part,
                cpo : cpoid,
                warehouse : warehouse,
                Mfr:Mfr,

            },
            success: function(string) {
                $('#listold').empty();

                $('#listold').append(string);
                form_groups1.find('.price').text(priceusd);

            // console.log(string);
               // $('#modal-list-old').modal('show');
              /*  $('.get-info-item').click(function() {
                    var tr_item = $(this).closest('tr');
                    tr.find('#lot_code'+stt+'').text(tr_item.find('.lot_code').text());
                    tr.find('#lot_no'+stt+'').text(tr_item.find('.lot_no').text());
                    showNoti('ATCOM Part Number: ' + part, 'Cập nhật hoàn tất', 'Ok');
                });*/

            }
         

        }
        );     

    }).on('click', '.btn-list-old', function() {
        var tr = $(this).closest('tr');
        var part = tr.find('.supplier-part').val();
        var category = tr.find('.category');
        var lot_code = tr.find('.lot_code input');

        $.ajax({
            url: site_url + $('#act').val() + '/list_old',
            type: 'POST',
            cache: false,
            data: {
                part: part,
            },
            success: function(string) {
                $('#modal-list-old .modal-body tbody').empty().append(string);
                $('#modal-list-old').modal('show');
                $('.get-info-item').click(function() {
                    var tr_item = $(this).closest('tr');
                    category.val(tr_item.find('.category').text());
                    lot_code.val(tr_item.find('.lot_code').text());
                    showNoti('ATCOM Part Number: ' + part, 'Cập nhật hoàn tất', 'Ok');
                });
            }
        });
    }).on('change', '.etd-control, .etd-control-plus', function() {
        var date_added = $(this).closest('.end_sell_date').find('.date_added').val();
        if (date_added == 'undefined') {
            date_added = _today();
        }
        estimateDate($(this), date_added);
    }).on('change', '.TAXItem', function() {
        handleTAX($(this));
    }).on('click', '.minus-shipment-total', function() {
        $(".highlightNoClick1").hide();
        $('.col-collapse-total').html('<i class="fa fa-plus-circle plus-shipment-total"></i>');
        $('.col-collapse').html('<i class="fa fa-plus-circle plus-shipment" ></i>');
    }).on('click', '.plus-shipment-total', function() {
        $(".highlightNoClick1").show();
        $('.col-collapse-total').html('<i class="fa fa-minus-circle minus-shipment-total" ></i>');
        $('.col-collapse').html('<i class="fa fa-minus-circle minus-shipment"></i>');
    }).on('click', '.minus-shipment', function() {
        var btn = $(this).closest('tr');
        var id = btn.find('.itemKey').val();
        alert(id);
        $(".stock"+ id).hide();
        btn.find('.col-collapse').html('<i class="fa fa-plus-circle plus-shipment"></i>');
    }).on('click', '.plus-shipment', function() {
        var btn = $(this).closest('tr');
        var id = btn.find('.itemKey').val();
        $(".stock"+ id).show();
        btn.find('.col-collapse').html('<i class="fa fa-minus-circle minus-shipment"></i>');
    })

    // .on('focus', 'td.cpo .select-status', function() {
    //     var id = $(this).attr('id');
    //     var old_val = $(this).val();
    //     $(this).empty().append(optionCPO).val(old_val).chosen();
    // }).on('focus', 'td.sc .select-status', function() {
    //     var id = $(this).attr('id');
    //     var old_val = $(this).val();
    //     $(this).empty().append(optionSC).val(old_val).chosen();
    // })

    // $('td.sc .select-status, td.cpo .select-status').each(function() {
    //         var id = $(this).attr('id');
    //         var old_val = $(this).val();
    //         $(this).empty().append(optionSC).val(old_val).chosen().delay(10);
    // });
    //
    //     $('td.sc .select-status, td.cpo .select-status').each(function(index) {
    //         (function(that, i) {
    //             var t = setTimeout(function() {
    //                 var id = $(this).attr('id');
    //                 var old_val = $(this).val();
    //                 $(this).empty().append(optionSC).val(old_val).chosen();
    //                 }, 500 * i);
    //         })(this, index);
    //     });
    .on('focus', 'td.cpo .select-status', function() {
        var id = $(this).attr('id');
        var old_val = $(this).val();
        $(this).empty().append(optionCPO).val(old_val).chosen();
        setTimeout(function(){$('#'+id+'_chosen').trigger('mousedown');; }, 100);
    }).on('focus', 'td.sc .select-status', function() {
        var id = $(this).attr('id');
        var old_val = $(this).val();
        $(this).empty().append(optionSC).val(old_val).chosen();
        setTimeout(function(){$('#'+id+'_chosen').trigger('mousedown');; }, 100);

    }).on('change', '.shipping-weight, .attr-Unit,.attr-Pickup,.attr-Local,.attr-trans,.bankWeight,.bankUnit,.declarecost,.declarecustomer', function() {
        var row = $(this).parent().parent();
        setTimeout(function() {
            $(this).val(accounting.formatMoney($(this).val(), '', 2));

           // import_row();
        }, 1000);
        sum_itemexcute(row);

     

    })/*.on('change', '#USDExchangeRate', function() {
       
        var USDExchangeRate = parseFloat($('#USDExchangeRate').val().replace(/\s/g, '').replace(/,/g, ''));
       var len=( $('.priceVNDItem').length);
        for (i = 1; i < len; i++) {
            var priceusd = $('#priceUSDItem'+i+'').val();
            var qty = parseInt($('#qtyItem'+i+'').val().replace(/\s/g, '').replace(/,/g, ''));

            var priceVNDItem1=priceusd*USDExchangeRate;

            var priceVNDItem=  $('#priceVNDItem'+i+'').val(accounting.formatMoney(priceVNDItem1, '', 0));
            var amountVNDItem=  $('#amountVNDItem'+i+'').val(accounting.formatMoney(priceVNDItem1*qty, '', 0));
        }
    
    
    })
   */
    $('.money').autoNumeric('init', {
        'mDec': 0
    });

    $('.money2').autoNumeric('init', {
        'mDec': 2
    });

    $('.money3').autoNumeric('init', {
        'mDec': 3
    });

    $('.money4').autoNumeric('init', {
        'mDec': 4
    });

    $('#importBtn, #updateBtn').click(function() {
        if ($('.group-required').is(':visible') && $('#cpo').val() == '') {
            showNoti('Chọn CPO trước khi import file', 'Cảnh báo', 'War');
            return false;
        }
        if ($('#warehouseid').val() == '') {
            showNoti('Chọn Warehouse trước khi import file', 'Cảnh báo', 'War');
            return false;
        }
        if ($(this).attr('id') == 'updateBtn') $('#importModal .btn-modal-submit').attr('id', 'updateRow');
        $('#importModal').modal('show');
        return false;
    });

});
$(document).ready(function() {
    $('#frmSearch').submit(function() {
        $('#divSearch').show();
        $('#divSearch div').css('max-height', '300px');
        $('#divSearch tbody').html('<tr><td class="fr center" colspan="13"><div style="padding:10px"><img src="assets/images/spinner-mini.gif" /></div></td></tr>');
        var controlAjax = site_url + 'stock_inout/search_part';
        if (moduleOut == 1) {
            controlAjax = site_url + 'stock_inout/list_part';
        }
        $.ajax({
            url: controlAjax,
            type: 'POST',
            cache: false,
            data: {
                q: $('[name="q"]').val()
            },
            success: function(string) {
                $('#divSearch tbody').empty().append(string);
                $('#divSearch tr:not(".no-data")').click(function(e) {
                    var _this = $(this);
                    var part = $(this).find('td.supplier_part').text();
                    var lot_code = $(this).find('td.lot_code').text();
                    if ($('.group-required').is(':visible') && $('#cpo').val() == '') {
                        showNoti('Chọn CPO trước khi nhập part', 'Cảnh báo', 'War');
                        return false;
                    }
                    if (!Array.isArray(arrqp)) {
                        arrqp = $.parseJSON(arrqp);
                    }
                    var result = [];
                    console.log(arrqp);
                    if (arrqp.length) {
                        result = arrqp.map(a => a.SupplierPart !== undefined ? a.SupplierPart.trim() : a.SupplierPart);
                    }
                    // var result = arrqp.map(a => a.SupplierPart);
                    // if (moduleOut == 1 || $('#warehouseid').val() == 1) {
                    //     result = arrqp.map(a => a.supplier_part);
                    // }
                    if ($('#act').val() != 'stock_begin' && !result.includes(part) && $('#warehouseid').val() != 1) {
                        if ($('.group-required').is(':visible') && $('#cpo').val() == '') {
                            showNoti(part + ' không tồn tại trong ' + $('#cpo').find('option[value="' + $('#cpo').val() + '"]').text().split(' - ')[1], 'Cảnh báo', 'War');
                        } else {
                            showNoti(part + ' không tồn tại trong Warehouse', 'Cảnh báo', 'War');
                        }
                        return false;
                    }
                    if ($('#itemList .highlightNoClick').length) {
                        var key = parseInt($('#itemList .highlightNoClick:last-child .keyItem').val()) + 1;
                    } else {
                        var key = 1;
                    }
                    if ($('#act').val() == 'stock_export' && $('#warehouseid').val() != 1) {
                        $.ajax({
                            url: site_url + 'stock_inout/get_part_inout',
                            type: 'POST',
                            data: {
                                part: part,
                                cpo: $('#cpoid').val(),
                                warehouse: $('#warehouseid').val(),
                            },
                            success: function(string) {
                               // console.log(string)
                                if (string != 0) {
                                    if ($('#itemList .highlightNoClick').length) {
                                        var key = parseInt($('#itemList .highlightNoClick:last-child .keyItem').val()) + 1;
                                    } else {
                                        var key = 1;
                                    }
                                    var getData = $.parseJSON(string);
                                    var data = {
                                        key: key,
                                        category: getData.category,
                                        cpo: getData.cpono ? getData.cpono : '',
                                        cpoid: getData.cpo ? getData.cpo : '',
                                        sc: '',
                                        code:'',
                                        nk_date:'',
                                        inv: '',
                                        po: getData.pono ? getData.pono : '',
                                        poid: getData.po ? getData.po : '',
                                        cusname: '',
                                        cusid:  '',
                                        import_method: getData.import_method ? getData.import_method : '',
                                        supplier_part: _this.find('td.supplier_part').text(),
                                        manufacturer_part_number: _this.find('.manufacturer_part_number').text(),
                                        description: _this.find('span.desc').text(),
                                        manufacturer: _this.find('td.manufacturer').text(),
                                        qty: 0,
                                        priceusd: _this.find('td.priceusd').text().replace(/,/g, ''),
                                        pricevnd: 0,
                                        lot_no: getData.lot_no ? getData.lot_no : '',
                                        lot_code: getData.lot_code ? getData.lot_code : '',
                                        date_code: getData.date_code ? getData.date_code : '',
                                        coo: getData.coo ? getData.coo : '',
                                        packaging: getData.packaging ? getData.packaging : '',
                                        warehouse: getData.warehouse ? getData.warehouse : '',
                                        minimum_stock: getData.minimum_stock ? getData.minimum_stock : '',
                                        end_sell_date: getData.end_sell_date ? getData.end_sell_date : '',
                                        end_sell_date_numb: getData.end_sell_date_numb ? getData.end_sell_date_numb : '',
                                        firmware: getData.firmware ? getData.firmware : '',
                                        imei: getData.imei ? getData.imei : '',
                                        package_case: getData.package_case ? getData.package_case : '',
                                        spq: getData.spq_quantity ? getData.spq_quantity : '',
                                        vat: getData.vat ? getData.vat : '',
                                        import_tax: getData.import_tax ? getData.import_tax : '',
                                    };
                                    add_item(data);
                                    sum_all();
                                } else {
                                    showNoti(_this.find('td.supplier_part').text() + ' không tồn tại trong kho ' + $('#warehouseid_chosen .chosen-single span').text(), 'Cảnh báo', 'War');
                                }
                            }
                        });
                    } else {
                        var data = {
                            key: key,
                            category: _this.data('category'),
                            cpoid: _this.data('cpo'),
                            sc: '',
                            inv: '',
                            scid: $('#scid').length ? $('#scid').val() : '',
                            po: '',
                            poid: 0,
                            cus: 0,
                            cusname: '',
                            cusid:  '',
                            code:'',
                            supid:'',
                            CompanyNameLo:'',
                            code: '',
                            nk_date: '',
                            import_method: '',
                            supplier_part: _this.find('td.supplier_part').text(),
                            manufacturer_part_number: _this.find('.manufacturer_part_number').text(),
                            description: _this.find('span.desc').text(),
                            manufacturer: _this.find('td.manufacturer').text(),
                            qty: 0,
                            priceusd: _this.find('td.priceusd').text().replace(/,/g, ''),
                            pricevnd: 0,
                            lot_no: _this.data('lot_no'),
                            lot_code: _this.data('lot_code'),
                            date_code: _this.data('date_code'),
                            coo: _this.data('coo'),
                            packaging: _this.find('td.packaging').text(),
                            warehouse: ($('#warehouseid').val() > 0 ? $('#warehouseid').val() : 0),
                            minimum_stock: _this.data('minimum_stock'),
                            end_sell_date: _this.data('end_sell_date'),
                            end_sell_date_numb: _this.data('end_sell_date_numb'),
                            firmware: _this.data('firmware'),
                            imei: _this.data('imei'),
                            package_case: _this.data('package_case'),
                            spq: _this.find('td.spq_quantity').text(),
                            vat: 10,
                            import_tax: 0
                        };
                        add_item(data);
                        sum_all();
                        _this.remove();
                    }
                });
            }
        });

        // $('[name="q"]').val('').blur();
        return false;
    });
    $('#updateFrm').submit(function(event) {
        if ($('#itemList .priceUSDItem').length == 0) {
            showNoti('Phiếu nhập kho trống', 'Lỗi nhập liệu', 'Err');
            return false;
        }
        if ($('.group-required').is(':visible') && $('#cpo').val() == '') {
            showNoti('CPO trống', 'Lỗi nhập liệu', 'Err');
            return false;
        }
        var arr = [];
        var arrNew = [];
        var current = null;
        var cnt = 0;
        $('#itemList').find('.inpd-required').each(function() {
            $(this).removeAttr('style');
            arr.push($(this).val());
        })
        arr.sort();
        if (arr.length > 0) {
            for (var i = 0; i < arr.length; i++) {
                if (arr[i] != current) {
                    if (cnt > 1) arrNew.push(current);
                    current = arr[i];
                    cnt = 1;
                } else {
                    cnt++;
                }
            }
        }
        if (cnt > 1) arrNew.push(current);
        if (arrNew.length > 0) {
            for (var j = 0; j < arrNew.length; j++) {
                $('#itemList').find('.inpd-required').filter(function() { return this.value == arrNew[j] }).css('border-color', 'red');
            }
            showNoti('Lot code không được giống nhau', 'Cảnh báo', 'War');
            return false;
        }
        var flag = false;
        if (!Array.isArray(arrqp)) {
            arrqp = $.parseJSON(arrqp);
        }
        // if ($('#act').val() == 'stock_export') result = arrqp.map(a => a.supplier_part);
        if ($('#act').val() != 'stock_begin' && $('#warehouseid').length && $('#warehouseid').val() != 1) {
            var result = arrqp.map(a => a.SupplierPart);
            $('#itemList tbody tr').each(function() {
                $(this).find('td').css({'background': '#fff' });
                // var partNum = $(this).find('td.part_number input').val().replace('&', '&amp;');
                var partNum = $(this).find('td.part_number input').val();
                if (!result.includes(partNum)) {
                    $(this).find('td').css({'background': '#ffb4b4'});
                    console.log(partNum);
                    flag = true;
                }
            })
        } else {
            $('#itemList tbody tr').each(function() {
                $(this).find('td.cpo select').removeAttr('data-required');
                if ($('#act').val() == 'stock_begin') $('td.packaging select, td.coo select').removeAttr('data-required');
            });
        }
        // return false;
        // if (flag) {
        //     if ($('#act').val() == 'stock_export') {
        //         showNoti('Part không tồn tại trong ' + $('#cpoid').find('option[value="' + $('#cpoid').val() + '"]').text().split(' - ')[1], 'Cảnh báo', 'War');
        //     }
        //     if ($('#act').val() == 'stock_import') {
        //         showNoti('Part không tồn tại trong ' + $('#scid').find('option[value="' + $('#scid').val() + '"]').text().split(' - ')[1], 'Cảnh báo', 'War');
        //     }
        //     return false;
        // }
        var flagQty = false;
        $('#itemList tbody tr').each(function() {
            if ($(this).find('td.quantity .qtyItem').val() <= 0) {
                $(this).find('td.quantity .qtyItem').css('border-color', 'red');
                flagQty = true;
            }
        });

        if (flagQty) {
            $('.group-process [type="button"]').removeAttr('disabled', true);
            showNoti('Số lượng phải lớn hơn 0', 'Lỗi nhập liệu', 'Err');
            return false;
        }


        if ($('#act').val() != 'stock_export') {

           // event.preventDefault();
            var arrID = [];
            var arrLotcode = [];
            var arrPart = [];
            var arrCPO = [];
            var flagLot = false;
            $('#itemList tbody tr').each(function() {
                $(this).find('td.quantity .qtyItem').removeAttr('style');
                if ($(this).find('td.lot_code input').val() == '' || ($('#act').val() != 'stock_begin' && $(this).find('td.packaging select').val() == '') || ($('#act').val() != 'stock_begin' && $(this).find('td.coo select').val() == '') || $(this).find('td.end_sell_date input.bootstrap-datepicker').val() == '') {
                    flagLot = true;
                    return false;
                } else {
                    arrID.push($(this).find('td.stt input.idItem').val());
                    arrLotcode.push($(this).find('td.lot_code input').val());
                    arrPart.push($(this).find('td.part_number .supplier-part').val());
                    arrCPO.push($(this).find('td.cpo select').val());
                }
            });
            if (flagLot){
                $('.group-process [type="button"]').removeAttr('disabled', true);
                showNoti('Kiểm tra 1 số trường bắt buộc <b>(*)</b> không được trống', 'Lỗi nhập liệu', 'Err');
            } else {
                if(Array.isArray(arrLotcode) && Array.isArray(arrPart)) {
                    $.ajax({
                        url: site_url + 'stock_inout/checkLotcode',
                        type: 'POST',
                        data: {
                            arrID: arrID,
                            arrLotcode: arrLotcode,
                            arrPart: arrPart,
                            arrCPO: arrCPO,
                            warehouse: $('#warehouseid').val(),
                            year: $('#create_date').val(),
                        },
                        success: function(arr) {
                            if (arr != '') {
                                var getData = $.parseJSON(arr);
                                if (Array.isArray(getData)) {
                                    for (var i = 0; i < getData.length; i++) {
                                        $('#itemList').find('td.lot_code input').filter(function() { return this.value == getData[i] }).css('border-color', 'red');
                                        flagLot = true;
                                        return false;
                                    }
                                }
                            }
                            if(flagLot){
                                $('.group-process [type="button"]').removeAttr('disabled', true);
                                showNoti('Lot code đã tồn tại', 'Cảnh báo', 'War');
                                flagLot = true;

                                return false;
                            } /*else {

                        
                                console.log('ok');
                                event.currentTarget.submit();
                            }*/
                        }
                    })
                }
            }
         //   console.log('fail');
        }
    });

    $('#importRow, #updateRow').click(function() {
        var starRow = parseInt($('#starRow').val());
        var endRow = parseInt($('#endRow').val());
        var dataRow = parseInt($('#sheetData tr').length) - 1;
        var rowSelect = parseInt($('#sheetData tr.excel-selected').length);
        index = starRow;
        num = (endRow > dataRow || isNaN(endRow) || endRow == 0) ? dataRow : endRow;
        $('#sheetData tr').removeClass('updated notfound');
        $('.progress-bar').css({
            width: '0%'
        });
        $('#person').text('0% (' + index + '/' + num + ')');
        if ($(this).attr('id') == 'updateRow') {
            setTimeout(function() {
                update_row();
            }, 500);
        } else {
            setTimeout(function() {
                import_row();
            }, 500);
        }
        return false;
    });

});
function sum_item(row) {
   // alert(row.find('.priceVNDItem').val());
   // var USDExchangeRate = parseFloat($('#USDExchangeRate').val().replace(/\s/g, '').replace(/,/g, ''));
    var qty = parseInt(row.find('.qtyItem').val().replace(/\s/g, '').replace(/,/g, ''));
    var priceusd = parseFloat(row.find('.priceUSDItem').val().replace(/\s/g, '').replace(/,/g, ''));
  //  var pricevnd1 = row.find('.priceVNDItem').val();
    var pricevnd1 =  parseFloat(row.find('.priceVNDItem').val().replace(/\s/g, '').replace(/,/g, ''));
   
   // var pricevnd1 = Math.round(priceusd*USDExchangeRate);
   // alert(pricevnd1);
    var amountusd  = (qty * priceusd).toFixed(4);
   // alert(amountusd);
    var amountvnd = qty * pricevnd1;
    var VAT = parseFloat(row.find('.VATUSDItem').val());
    row.find('.priceUSDItem').val(accounting.formatMoney(priceusd, '', 4));
    row.find('.priceVNDItem').val(accounting.formatMoney(pricevnd1, '', 0));
    row.find('.amountUSDItem').val(accounting.formatMoney(amountusd, '', 2));
    row.find('.amountVNDItem').val(accounting.formatMoney(amountvnd, '', 0));

    // var amountUSD = parseFloat(parent.find('.amountUSDItem').val().replace(/,/g,''));
    // if (VAT > 0) {
        row.find('.amountVATVNDItem').val(accounting.formatMoney(parseFloat(amountvnd + (amountvnd * VAT / 100)), '', 0));
    // } else {
    //     row.find('.amountVATVNDItem').val(0);
    // }
    sum_all();

}


function sum_all() {
    var totalAmountVND = 0.0,
        totalAmountUSD = 0.0,
        totalQty = 0;
        amountVATVNDItem = 0.0;
    if ($('#itemList .amountUSDItem').length > 0) {
        $('#itemList .qtyItem').each(function() {
            totalQty += parseInt($(this).val().replace(/,/g, ''));
        });
        $('#totalQty').val(accounting.formatMoney(totalQty, '', 0));

        $('#itemList .amountUSDItem').each(function() {
            totalAmountUSD += parseFloat($(this).val().replace(/,/g, ''));
        });
        $('#totalAmountUSD').val(accounting.formatMoney(totalAmountUSD, '', 2));

        $('#itemList .amountVNDItem').each(function() {
            totalAmountVND += parseFloat($(this).val().replace(/,/g, ''));
        });
        $('#itemList .amountVATVNDItem').each(function() {
            amountVATVNDItem += parseFloat($(this).val().replace(/,/g, ''));
        });

        
       // $('#totalAmountVND').val(accounting.formatMoney(totalAmountVND, '', 0));
        $('#qty').html(accounting.formatMoney(totalQty,'',0));
        $('#amountusd').html(accounting.formatMoney(totalAmountUSD,'',2));
        $('#amountvnd').html(accounting.formatMoney(totalAmountVND,'',0));
         $('#total').html(accounting.formatMoney(amountVATVNDItem,'',0));
         $('.soluong').val(accounting.formatMoney(totalQty,'',0));
         $('#totalAmountUSD').val(accounting.formatMoney(totalAmountUSD,'',2));
         $('#totalAmountVND').val(accounting.formatMoney(totalAmountVND,'',0));
    } else {
        $('#totalAmount').val(0);
    }


}

function add_item(data) {
    var flagModule = false;
    var flagWarehouse = false;
    var stockExportType = false;

    if ($('#act').val() == 'stock_export') flagModule = true;
    if ($('#warehouseid').val() == 1) flagWarehouse = true;
    if ($('#stockExportType').val() == 3 ||$('#stockExportType').val() ==4||$('#stockExportType').val() ==1 ) stockExportType = true;
  //var stockExportType =$('#stockExportType').val();

   //var key = data.key;
    var stt = $('#itemList .highlightNoClick').length + 1;
    var key = stt;
    
    var html = '<tr class="sc'+data.scid+' scchange'+data.key1+' highlightNoClick" data-lot_code="' + data.lot_code + '">' +
        '<td class="list-col center del"><a href="javascript:;" data-placement="bottom" title="Xoá" class="tooltip-link"><i class="glyph-icon icon-remove"></i></a></td>' +
        '<td class="col-collapse center" colspan="2"><i class="fa fa-minus-circle minus-shipment" ></i> </td>'+
        '<td class="list-col center stt">' +
        '<span>' + stt + '</span>' +
        '<input name="details[' + key + '][category]" type="hidden" value="' + data.category + '">' +
        '<input type="hidden" name="details[' + key + '][sort]" class="itemKey" value="' + key + '">' +
        '<input type="hidden" name="details[' + key + '][stt]" class="stt" value="' + data.key1 + '">' +

        '<input type="hidden" name="details[' + key + '][id]" class="idItem" value="">';

    //html += '<input type="hidden" class="keyItem" value="' + key + '">' +
    html += '<input type="hidden" class="keyItem" value="' + key + '">' +

        '</td>' +
        '<td  class="list-col center"><a href="javascript:;" name="details[' + key + '][list]" class="btn btn-default btn-list-old"><i class="glyph-icon icon-list-alt"></i></a></td>' +
        // '<td class="list-col sc" style="width: 200px; min-width: 200px; max-width: 200px"><select name="details[' + key + '][sc]" id="selSC' + key + '" class="form-control"></select><div class="errordiv selSC' + key + '"><div class="arrow"></div>Not empty!</div><input type="hidden" id="scnohd' + key + '" name="details[' + key + '][scno]" value="' + data.sc + '"></td>' +
        '<td '+($('#act').val() == 'stock_begin'  ? 'style="display: none;' : '"')+'  class="list-col inv" ><select name="details[' + key + '][invoice]" id="selinvoice' + key + '" class="form-control selinvoice" ' + ($('#warehouseid').val()==1 || $('#act').val() == 'stock_import' ? '' : '' + (stockExportType ? '' : ' data-required="1"') + '' ) + ' ></select><div class="errordiv selinvoice' + key + '"><div class="arrow"></div>Not empty!</div></td>' +
        // '<td class="list-col sup"><span></span></td>'+
        // '<td class="list-col po"><input type="hidden" id="pohd' + key + '" name="details[' + key + '][po]" class="form-control" value="' + data.poid + '"/><input type="hidden" id="ponohd' + key + '" name="details[' + key + '][pono]" value="' + data.po + '"><span>' + data.po + '</span></td>' +
        // '<td class="list-col cus"><input type="hidden" id="cushd' + key + '" name="details[' + key + '][cus]" class="form-control" value="' + data.cusid + '"/><input type="hidden" id="cusnamehd' + key + '" name="details[' + key + '][cusname]" value="' + data.cusname + '"><span>' + (data.cusid > 0 ? data.cusid + ' - ' + data.cusname : '') + '</span></td>' +
        // '<td class="list-col import_method"><input type="text" name="details[' + key + '][import_method]" class="form-control" value="' + data.import_method + '"/></td>' +
        // '<td class="list-col lot_no"><input type="text" name="details[' + key + '][lot_no]" class="form-control" value="' + data.lot_no + '"/></td>' +
        '<td class="list-col lot_code"><input type="text" id="lot_code_' + key + '" name="details[' + key + '][lot_code]" class="form-control inpd-required" value="' + data.lot_code + '" data-required="1"/><div class="errordiv lot_code_' + key + '"><div class="arrow"></div>Not empty!</div></td>' +
        '<td class="list-col part_number">' + escapeHtml(data.supplier_part)+ '<input name="details[' + key + '][supplier_part]" type="hidden" id="supplier_part_' + key + '" class="form-control supplier-part" value="' + data.supplier_part + '"><div class="errordiv supplier_part_' + key + '"><div class="arrow"></div>Not empty!</div></td>' +
        '<td class="list-col mfr_number">' + escapeHtml(data.manufacturer_part_number)+ '<input name="details[' + key + '][manufacturer_part_number]" type="hidden" class="form-control" value="' + data.manufacturer_part_number + '"></td>' +
        '<td class="list-col description"><input type="text" name="details[' + key + '][description]" class="form-control expand" value="' + data.description + '"/></td>' +
        '<td class="list-col manufacturer"><input type="text" name="details[' + key + '][manufacturer]" class="form-control expand" value="' + data.manufacturer + '"/></td>';
    
    html += '<td class="list-col package_case' + (flagModule ? ' disabled' : '') + '"><input type="text" name="details[' + key + '][package_case]" class="form-control" value="' + data.package_case + '"/></td>' +
        '<td class="list-col packaging' + (flagModule ? ' disabledd' : '') + '"><select name="details[' + key + '][packaging]" id="packaging_' + key + '" class="form-control"' + (flagWarehouse ? '' : 'data-required="1"') + '></select><div class="errordiv packaging_' + key + '"><div class="arrow"></div>Not empty!</div></td>' +
        // '<td class="list-col date_code' + (flagModule ? ' disabled' : '') + '"><input type="text" name="details[' + key + '][date_code]" class="form-control" value="' + data.date_code + '"/></td>' +
        // '<td class="list-col coo' + (flagModule ? ' disabledd' : '') + '" style="width: 100px; min-width: 100px; max-width: 100px"></td>' +

        // '<td class="list-col firmware' + (flagModule ? ' disabled' : '') + '"></td>' +
        // '<td class="list-col imei' + (flagModule ? ' disabled' : '') + '"></td>' +
        // '<td class="list-col warehouse' + (flagModule ? ' disabled' : '') + '"><input type="text" name="details[' + key + '][warehouse]" class="form-control" value="' + data.warehouse + '"/></td>' +
        '<td '+(!flagModule ? ' ' : 'style="display: none;"')+' class="list-col minimum_stock' + (flagModule ? ' disabled' : '') + '"><input type="text" name="details[' + key + '][minimum_stock]" class="form-control" value="' + data.minimum_stock + '"/></td>' +
        '<td '+(!flagModule ? ' ' : 'style="display: none;"')+' class="list-col end_sell_date' + (flagModule ? ' disabled' : '') + '"><input type="hidden" class="date_added" value="' + data.date_added + '"><div class="input-group-text"><input type="text" id="esd_' + key + '" name="details[' + key + '][end_sell_date]" class="form-control bootstrap-datepicker etd-control" value="' + data.end_sell_date + '"' + (flagWarehouse ? '' : 'data-required="1"') + '/><input type="text" name="details[' + key + '][end_sell_date_numb]" class="form-control etd-control-plus bootstrap-date-plus bootstrap-date-plus' + key + '" value="' + data.end_sell_date_numb + '" placeholder="Day"></div><div class="errordiv esd_' + key + '"><div class="arrow"></div>Not empty!</div></td></td>'+
        '<td class="list-col spq"><input type="text" name="details['+ key + '][spq]" class="form-control spq" value="' + data.spq + '"/></td>' ;

    html += '<td class="list-col right quantity"><input type="text" name="details[' + key + '][qty]" class="form-control qtyItem order-qty qtypoItem' + data.poid + '" value="' + (flagModule ? 0 : accounting.formatMoney(data.qty,'',0)) + '"/></td>' +
        '<td class="list-col right unit_price_usd"><input type="hidden" classsum_item="priceUSDItemHide" value="' + data.priceusd + '"><input type="text" name="details[' + key + '][priceusd]" class="form-control priceUSDItem unit-price-usd" value="' + data.priceusd + '"/></td>' +
        '<td class="list-col right unit_price_vnd"><input type="text" name="details[' + key + '][pricevnd]" class="form-control priceVNDItem unit-price-vnd" value="' + data.pricevnd + '"/></td>' +
        '<td class="list-col right import_tax' + (flagModule ? ' hidden' : '') + '"><input type="text" name="details[' + key + '][import_tax]" class="form-control TAXItem TAXItem' + key + '" value="' + data.import_tax + '"/></td>' +

        '<td class="list-col right amount_usd"><input type="text" name="details[' + key + '][amountusd]" class="form-control amountUSDItem no-border amountUSDItem' + data.poid + '" value="0" readonly/></td>' +
        '<td class="list-col right amount_vnd"><input type="text" name="details[' + key + '][amountvnd]" class="form-control amountVNDItem no-border" value="0" readonly/></td>' +
        '<td class="list-col right vat"><input type="text" name="details[' + key + '][vat]" class="form-control VATUSDItem" value="' + data.vat + '"/></td>' +
        '<td class="list-col right amount_vat"><input type="text" name="details[' + key + '][amount_vat]" class="form-control amountVATVNDItem" value="' + data.amount_vat + '"/></td>';


    html += ' <tr class="highlightNoClick1 lengthPart myDragClass Shipment sc'+data.scid+' scchange'+data.key1+' stock' + key + '">\n' +
        // '                <td class="bgcolor col-numberOfShipment "  colspan="4">\n' +
        // '                    <div>\n' +
        // '                    </div>\n' +
        // '                </td>\n' +
        '                <td class="list-col bgcolor col-numberOfShipment cpo" colspan="6">\n' +
        '                    <div class="height-line2">\n' +
        '                        <div class="header-shipmment " >\n' +
        '                            <span>CPO<span style="color:red">*</span> </span>\n' +
        '                        </div>\n' +
        '                        <div>\n' +
        '                            <select class="select-status d-block d-none-appearance" id="selCPO' + key + '" name="details[' + key + '][cpo]" ' + (flagWarehouse ? '' : ' data-required="1"') + '>\n' +
        '                                <?= $data[\'cpo\'] ? \'<option value="\' . $data[\'cpo\'] . \'">\' . $data[\'cpo\'] . \' - \' . $data[\'cpono\'] . \'</option>\' : \'<option value="" selected="selected">Select...</option>\' ?>\n' +
        '                            </select>\n' +
        '                            <div class="errordiv selCPO' + key + '">Not empty!</div>\n' +
        '                            <input type="hidden" id="cponohd' + key + '" name="details[' + key + '][cpono]" value="' + data.cpo + '">\n' +
        '                        </div>\n' +
        '                    </div>\n' +
        '                </td>\n' +
        '                <td class="list-col bgcolor cus"  width="150">\n' +
        '                    <div class="height-line2">\n' +
        '                        <div class="header-shipmment ">\n' +
        '                            Customer<span style="color:red">*</span></span>\n' +
        '                        </div>\n' +
        '                        <div class="line2-text-2" >\n' +
        '                            <input type="hidden" id="cushd' + key + '" name="details[' + key + '][cus]" class="form-control" value="' + data.cusid + '"  data-required="1"/><input type="hidden" id="cusnamehd'+key+'"  name="details[' + key + '][cusname]" value="' + data.cusname + '"><span class="cusname' + key + '">' + data.cusid + ' - ' + data.cusname + ' </span>\n' +
        '                            <div class="errordiv cushd">Not empty!</div>\n' +

        '                        </div>\n' +
        '                    </div>\n' +
        '                </td>\n' +
        '                <td class="list-col sc bgcolor col-numberOfShipment" colspan="1">\n' +
        '                    <div class="height-line2">\n' +
        '                        <div class="header-shipmment " >\n' +
        '                            <span>SC ' + (stockExportType ? '' : '<span class="hiddenred"  style="color:red">*</span>') + '   </span>\n' +
        '                        </div>\n' +
        '                        <div style=" width: 170px; " >\n' +
        '                <select name="details[' + key + '][sc]" id="selSC' + key + '" ' + (flagWarehouse|| stockExportType  ? '' : ' data-required="1"') + '    class="form-control" ></select><div class="errordiv selSC' + key + '"><div class="arrow"></div>Not empty!</div><input type="hidden" id="scnohd' + key + '" name="details[' + key + '][scno]" value="' + data.sc + '">'+
        '                    </div>\n' +
        '                </td>\n' +
        '\n' +
        '                <td class="list-col bgcolor col-numberOfShipment sup">\n' +
        '                    <div class="height-line">\n' +
        '                        <div class="header-shipmment " >\n' +
        '                            <span>SupplierID <span style="color:red">*</span> </span>\n' +
        '                        </div>\n' +
        '                        <div class="line2-text-2 supid ">\n' +
        '                            <span class="scidname'+key+'">'+data.supid+' - '+data.CompanyNameLo+'</span>\n' +
        '                        </div>\n' +
        '                    </div>\n' +
        '                </td>\n' +
        '                <td class="list-col bgcolor cus list-col"  colspan="1">\n' +
        '                    <div class="height-line2">\n' +
        '                        <div class="header-shipmment ">\n' +
        '                                PO <span class="hiddenred" style="color:red">*</span>' +
        '                        </div>\n' +
        '                        <div class="line2-text-2 ">\n' +
        '                           <input type="hidden" id="ponohd' + key +'" name="details[' + key + '][pono]" ' +(flagWarehouse ? '' : ' data-required="1"')+ ' value="' + data.po + '"><div class="errordiv ponohd'+ key + '"><div class="arrow"></div>Not empty!</div> <input type="hidden" id="pohd' + key + '" name="details[' + key + '][po]" class="form-control" value="'+ data.poid +'"/><span class="poid'+key+'">' + data.po + '</span>\n' +
        '                        </div>\n' +
        '                    </div>\n' +
        '                </td>\n' +
        '                <td class="bgcolor import_method list-col">\n' +
        '                    <div class="height-line2">\n' +
        '                        <div class="header-shipmment">\n' +
        '                            Import Method\n' +
        '                        </div>\n' +
        '                        <div >\n' +
        '                            <input type="text" name="details[' + key + '][import_method]" class="form-control" value="' + data.import_method + '"/>\n' +
        '                        </div>\n' +
        '                    </div>\n' +
        '                </td>\n' +
        '                <td class="bgcolor import_method list-col">\n' +
        '                    <div class="height-line2">\n' +
        '                        <div class="header-shipmment">\n' +
        '                            	NK No <span style="color:red">*</span> \n' +
        '                        </div>\n' +
        '                        <div >\n' +
        '                            <input type="text" name="details[' + key + '][codenk]" data-required="1"  id="codenk' + key + '" class="form-control" value="' + data.code + '"/>\n' +
        '                            <div class="errordiv codenk' + key + '">Not empty!</div>\n' +
        '                        </div>\n' +
        '                    </div>\n' +
        '                </td>\n' +
        '                <td class="bgcolor import_method list-col">\n' +
        '                    <div class="height-line2">\n' +
        '                        <div class="header-shipmment">\n' +
        '                            	NK Date<span style="color:red">*</span>\n' +
        '                        </div>\n' +
        '                        <div >\n' +
        '                            <input type="text" name="details[' + key + '][nk_date]" data-required="1" id="nk_date' + key + '"  class="form-control" value="' + data.nk_date + '"/>\n' +
        '                            <div class="errordiv nk_date' + key + '">Not empty!</div>\n' +

        '                        </div>\n' +
        '                    </div>\n' +
        '                </td>\n' +
        '                <td class="bgcolor import_method list-col">\n' +
        '                    <div class="height-line2">\n' +
        '                        <div class="header-shipmment">\n' +
        '                            	NK Approved' +
        '                        </div>\n' +
        '                        <div >\n' +
        '                            <input type="text" name="details[' + key + '][nk_app]" id="nk_date' + key + '"  class="form-control" value="' + data.nk_app + '"/>\n' +

        '                        </div>\n' +
        '                    </div>\n' +
        '                </td>\n' +
    
     
        '                <td class="list-col bgcolor cbgcolor bgcolorol- warehouse ">\n' +
        '                    <div class="height-line2">\n' +
        '                        <div class="header-shipmment ">\n' +
        '                            Warehouse\n' +
        '                        </div>\n' +
        '                        <div >\n' +
        '                            <input type="text" name="details[' + key + '][warehouse]" class="form-control" value="' + data.warehouse + '"/></div>\n' +
        '                    </div>\n' +
        '                </td>\n' +

        '                <td class="list-col bgcolor cbgcolor lot_no ">\n' +
        '                    <div class="height-line2">\n' +
        '                        <div class="header-shipmment ">\n' +
        '                            Lot No\n' +
        '                        </div>\n' +
        '                        <div >\n' +
        '                            <input type="text" name="details[' + key + '][lot_no]" class="form-control" value="' + data.lot_no + '"/>                        </div>\n' +
        '                    </div>\n' +
        '                </td>\n' +

        '                <td class="list-col bgcolor cbgcolor date_code ">\n' +
        '                    <div class="height-line2">\n' +
        '                        <div class="header-shipmment ">\n' +
        '                                 Date Code\n' +
        '                        </div>\n' +
        '                        <div >\n' +
        '                            <input type="text" name="details[' + key + '][date_code]" class="form-control" value="' + data.date_code + '"/>' +
        '                        </div>\n' +
        '                    </div>\n' +
        '                </td>\n' +
        '                <td class="list-col bgcolor cbgcolor coo ">\n' +
        '                    <div class="height-line2">\n' +
        '                        <div class="header-shipmment ">\n' +
        '                           COO\n<span ' + (flagWarehouse ? '' : 'style="color:red">*</span>') + ' </span>\n' +
        '                        </div>\n' +
        '                        <div >\n' +
        '                            <select name="details[' + key + '][coo]" id="coo_' + key + '" class="form-control"' + (flagWarehouse ? '' : 'data-required="1"') + '></select><div class="errordiv coo_' + key + '"><div class="arrow"></div>Not empty!</div>                     </div>\n' +
        '                    </div>\n' +
        '                </td>\n' +
        '                <td class="list-col bgcolor cbgcolor firmware " colspan="">\n' +
        '                    <div class="height-line2">\n' +
        '                        <div class="header-shipmment ">\n' +
        '                            Firmware\n' +
        '                        </div>\n' +
        '                        <div >\n' +
        '                            <input type="text" name="details[' + key + '][firmware]" class="form-control" value="' + data.firmware + '" />                      </div>\n' +
        '                    </div>\n' +
        '                </td>\n' +
        '                <td class="list-col bgcolor cbgcolor imei ">\n' +
        '                    <div class="height-line2">\n' +
        '                        <div class="header-shipmment ">\n' +
        '                            IMEI\n' +
        '                        </div>\n' +
        '                        <div >\n' +
        '                            <input type="text" name="details[' + key + '][imei]" class="form-control" value="' + data.imei + '"/>                       </div>\n' +
        '                            <input type="hidden" name="" class="keyItem" value="' +key + '"/>                       </div>\n' +
        '                    </div>\n' +
        '                </td>\n' +

        '                <td class="bgcolor bgcolorcol-addrow center hide">\n' +
        '                </td>\n' +
        '                <td class="bgcolor bgcolorcol-upd_sale_rfq center hide" style="pointer-events: unset"></td>\n' +
        '                <td class="bgcolor bgcolorcol-query center hide "></td>\n' +
        '                <td class="bgcolor bgcolor hide col-supplier_part ">\n' +

        '                </td>\n' +

        '                <td class="bgcolor col-description hide">\n' +
        '                </td>\n' +
        '                <td '+(!flagModule ? ' ' : 'style="display: none;"')+' class=" bgcolor col-amount_vnd"></td>\n' +
        '                <td '+(!flagModule ? ' ' : 'style="display: none;"')+' class=" bgcolor col-amount_vnd"></td>\n' +
        '                <td class="bgcolor cbgcolor bgcolorol-shipped ">\n' +
        '                </td>\n' +        
        '                <td' +(!flagModule ? '' : 'style="display: none')+' class="bgcolor Nk-td">\n' +
        '                </td>\n' +

      
        '                </tr>';
    $('#itemList tbody').append(html);

    $('.money').autoNumeric('init', {
        'mDec': 0
    });

    $('.money2').autoNumeric('init', {
        'mDec': 2
    });

    $('.money3').autoNumeric('init', {
        'mDec': 3
    });

    $('.money4').autoNumeric('init', {
        'mDec': 4
    });

    // for (var i = 0; i < $('#itemList .highlightNoClick').length; i++) {
    //     $('#itemList .highlightNoClick:eq(' + i + ') td:eq(1) span').text(i + 1);
    // }
   // console.log('acccccccc'+optionCPO);
    $('#selMFR' + key).append(optionMFR).chosen({allow_single_deselect: true});
    $('#coo_' + key).append(optionCountry).chosen({allow_single_deselect: true});
    $('#coo_' + key).val(data.coo).trigger('chosen:updated');
    $('#packaging_' + key).append(optionPackaging).chosen({allow_single_deselect: true});
    $('#packaging_' + key).val(data.packaging).trigger('chosen:updated');
    $('#selCPO' + key).append(optionCPO).val(data.cpoid).chosen({allow_single_deselect: true});
    $('#selSC' + key).append(optionSC).val(data.scid).chosen({allow_single_deselect: true});
   // $('#selinvoice' + key).append(optionINV).val(data.invoice).chosen({allow_single_deselect: true});
  //  $('#selinvoice' + key).append(optionINV).val(data.invoice).chosen({allow_single_deselect: true});
   $('#selMFR' + key + '_chosen .chosen-single div, #selCPO' + key + '_chosen .chosen-single div, #coo_' + key + '_chosen .chosen-single div, #packaging_' + key + '_chosen .chosen-single div, #selSC' + key + '_chosen .chosen-single div').html('<i class="glyph-icon icon-caret-down"></i>');
    // $('.chosen-single div').html('<i class="glyph-icon icon-caret-down"></i>');
    
    //alert(data.amout);
 /*  var amount = 0.0;
    $('.amountUSDItem'+data.poid+'').each(function() {

        amount +=   parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));

    })
  //  alert(data.poid);
    var amoutlistpo= 0.0 ;
   //console.log(''amoutlistpo);
    amoutlistpo = (amount+data.amout);
    $('.amountpo'+data.poid+'').val(amoutlistpo);
    //console.log('hanaghsa: '+ (amoutlistpo));
*/


$('#shippingweight').val('');
$('#attrUnit').val('');
$('#attrAmount').val('');
$('#attrPickup').val('');
$('#attrLocal').val('');
$('#attrtrans').val('');
$('#shipping_total').val(0);
$('#bankWeight').val('');
$('#bankUnit').val('');
$('#declarecost').val('');
$('#banktotal').val('');
$('#declarecustomer').val('');
$('#declareTotal').val('');
$('#cost_total').text(0);
$('.col-shipping_cost').val('');
$('.col-declare_cost').val('');
$('.col-back_cost').val('');
$('.bgshipmentinput').val(0);

    if($('#act').val()=="stock_export"){
        var idHD =  $('#idHD').val();

    }
    
    else{
        var idHD =  data.scid;

    }
    


    //return false;
    if($('#act').val() !="stock_begin"){

    
//alert(data.scid);
        $.ajax({
            url: site_url+$('#act').val()+'/get_Selinvoices',
    
            type: 'POST',
            cache: false,
            data: {
                ContractNo:   idHD ,
               // table: 'sales_contract',
            },
            success: function(string) {
             //   console.log('aaaaa: '+string);
    
                if (string != 0) {
                   // var OptionsNOINV='';
                    var getData = $.parseJSON( string );
                   // console.log('aaaaa: '+getData);
                                $('#selinvoice' ).empty();
                                $OptionsNOINV = '';
    
                                if ( Array.isArray( getData ) && getData.length ) {
                                    for ( var i = 0; i < getData.length; i++ ) {
                                        $OptionsNOINV += '<option value="' + getData[ i ][ 'id' ] + '">'+ getData[ i ][ 'id' ] + '- ' + getData[ i ][ 'InvoiceNo' ].replace(/[^\w\s]/gi, '') + '</option>';
                                    }
                                }
                              //  console.log('dsfsf'+OptionsNOINV);
                              $( '#selinvoice' + key).html( $OptionsNOINV ).trigger( 'chosen:updated' );
                              $('.selinvoice').attr('data-required', 0);
    
    
                         // $('#selinvoice' + key).append(JSON.parse(OptionsNOINV)).val(data.invoice).chosen({allow_single_deselect: true});
    
                                
                }
            }
        })

   
}
    $('.bootstrap-date-plus').trigger('change');
    sum_item($('#itemList tr:nth-last-child(2)'));
    if (data.end_sell_date != '') {
        var newDate = new Date();
        estimateDate($('.bootstrap-date-plus' + key), _today());
    }
    if (data.import_tax != '') {
        handleTAX($('.TAXItem' + key));
    }
    $('#itemList .bootstrap-datepicker').datepicker({
        format: 'yyyy-mm-dd',
        language: 'vi',
        autoclose: true,
        todayHighlight: true
    });


   
    // }
}

$(document).ready(function() {
    // $('#sheetPreview').css({
    //     width: $(window).width() - 400 + 'px'
    // });

    $('#starRow').on('change', function() {
        $('#endRow option').attr('disabled', false);
        for (i = 0; i < parseInt($(this).val()) - 1; i++) {
            $('#endRow option:eq(' + i + ')').attr('disabled', true);
        }
        $('#endRow option:last-child').prop('selected', true);
        $('#endRow').trigger('chosen:updated');

        $('#sheetData tr').removeClass('excel-selected');
        for (i = parseInt($(this).val()); i <= parseInt($('#endRow').val()); i++) {
            $('#sheetData #row' + i).addClass('excel-selected');
        }
        check_exists();
    });

    $('#endRow').on('change', function() {
        $('#sheetData tr').removeClass('excel-selected');
        for (i = parseInt($('#starRow').val()); i <= parseInt($(this).val()); i++) {
            $('#sheetData #row' + i).addClass('excel-selected');
        }
        check_exists();
    });

    $('#headerRow').on('change', function() {
        var headerRow = parseInt($(this).val());
        $('.field-update').empty().append('<option value="">Chọn ...</option>');
        $('#sheetData tr').removeClass('excel-header');
        $('#sheetData #row' + headerRow).addClass('excel-header').find('td:not(.excel-left)').each(function() {
            $('.field-update').append('<option value="' + $(this).data('col') + '" data-fieldname="' + $(this).text() + '">' + $(this).data('col') + ' - ' + $(this).text() + '</option>');
        });
        $('.field-update').each(function() {
            var fieldname = $(this).data('fieldname');
            $(this).find('option[data-fieldname="' + fieldname + '"]').attr('selected', 'selected');
        });
        $('.field-update').trigger('chosen:updated');
        check_exists();
    });

    $('#supplier_part').change(function() {
        check_exists();
    });

    $('#sheet').on('change', function() {
        read_sheet($(this).val());
    });

    if ($('#fileuploader').length) {
        var dir = $('#fileuploader').data('dir');
        $('#fileuploader').uploadFile({
            url: site_url + 'ajax/upload',
            fileName: 'myfile',
            formData: {
                dir: dir
            },
            uploadButtonClass: 'btn btn-border btn-alt btn-hover border-primary font-primary waves-effect',
            dragDropStr: '<span> Kéo và thả file ở đây</span>',
            allowedTypes: 'xlsx,xls',
            uploadErrorStr: 'File không đúng danh mục!',
            onSubmit: function(files) {
                var starRow = parseInt($('#starRow').val());
                var endRow = parseInt($('#endRow').val());
                if (endRow < starRow && endRow > 0) {
                    showNoti('Vị trí dòng bắt đầu lớn hơn dòng kết thúc!', 'Lỗi nhập liệu', 'Err');
                    return false;
                }
            },
            onSuccess: function(files, data, xhr) {
                $('[type="submit"], [type="button"]').attr('disabled', true);

                showNoti('Đang đọc dữ liệu file. Vui lòng đợi!', 'Upload file thành công', 'War');
                showProcess(1);

                $('#fileName').val(data.split('/').pop());

                read_sheet($('#sheet').val());
            }
        });
    }

    $('#addRowstock').on('click', function() {
        var key = 1;
        if ($('#itemList .highlightNoClick').length) {
           // key = parseInt($('#itemList .highlightNoClick:last-child .keyItem').val()) + 1;
            key= $('#itemList .highlightNoClick').length + 1;

        }

        var data = {
            key: key,
            category: '',
            cpo: '',
            cpoid: '',
            sc: '',
            inv: '',
            po: '',
            poid: '',
            cus: '',
            code: '',
            nk_date: '',
            cusid: '',
            import_method: '',
            lot_no: '',
            lot_code: '',
            supplier_part: '',
            manufacturer_part_number: '',
            description: '',
            manufacturer: '',
            package_case: '',
            packaging: '',
            spq: '',
            date_code: '',
            coo: '',
            firmware: '',
            imei: '',
            warehouse: ($('#warehouseid').val() > 0 ? $('#warehouseid').val() : 0),
            minimum_stock: 0,
            end_sell_date: '',
            qty: 0,
            priceusd: 0,
            pricevnd: 0,
            vat: 10,
            import_tax: 0,
        };
        add_item(data);
        //alert(key);
        $('#itemList input[name="details[' + key + '][supplier_part]"').attr('type', 'text').attr('data-required', 1);
        $('#itemList input[name="details[' + key + '][manufacturer_part_number]"').attr('type', 'text');
    })
});

function read_sheet(sheet) {
    $.ajax({
        url: site_url + 'ajax/read_sheet',
        type: 'POST',
        data: {
            file: $('#fileName').val(),
            sheet: sheet
        },
        dataType: 'json',
        success: function(data) {
            if (data == '') {
                showNoti('Tệp tin không tồn tại!', 'Không thể đọc thông tin file', 'Err');
            } else {
                var headerRow = parseInt($('#headerRow').val());
                var html = '';

                $('#sheet').empty();
                for (i = 0; i < data.sheets.length; i++) {
                    $('#sheet').append('<option value="' + i + '"' + (i == sheet ? ' selected="selected"' : '') + '>' + data.sheets[i] + '</option>');
                }
                $('#sheet').trigger('chosen:updated');

                $('#headerRow, #starRow, #endRow').empty();
                $.each(data.sheetData, function(i, row) {
                    if (i == 1) {
                        html += '<tr>';
                        $.each(row, function(columnLetter, value) {
                            if (columnLetter == 'A') {
                                html += '<td class="excel-top"><div class="excel-angel"></div></td>';
                            }
                            html += '<td class="excel-top">' + columnLetter + '</td>';
                        });
                        html += '</tr>';
                    }
                    html += '<tr id="row' + i + '"' + (i == headerRow ? ' class="excel-header"' : '') + '>';
                    $.each(row, function(columnLetter, value) {
                        if (columnLetter == 'A') {
                            html += '<td class="excel-left">' + i + '</td>';
                        }
                        html += '<td data-col="' + columnLetter + '" nowrap="nowrap" class="excel-cell">' + (value != null ? value : '') + '</td>';
                        if (i == headerRow) {
                            $('.field-update').append('<option value="' + columnLetter + '" data-fieldname="' + value + '">' + columnLetter + ' - ' + value + '</option>');
                        }
                    });
                    html += '</tr>';
                    $('#headerRow, #starRow, #endRow').append('<option value="' + i + '">' + i + '</option>');
                });

                $('#starRow').val(2);
                for (i = 0; i < parseInt($('#starRow').val()) - 1; i++) {
                    $('#endRow option:eq(' + i + ')').attr('disabled', true);
                }
                $('#endRow option:last-child').prop('selected', true);

                $('.field-update').each(function() {
                    var fieldname = $(this).data('fieldname');
                    $(this).find('option[data-fieldname="' + fieldname + '"]').attr('selected', 'selected');
                });
                $('#sheetData').html(html);
                $('#sheet, #starRow, #endRow, #headerRow, .field-update').attr('disabled', false).trigger('chosen:updated');

                $('#sheetData tr').removeClass('excel-selected');
                for (i = parseInt($('#starRow').val()); i <= parseInt($('#endRow').val()); i++) {
                    $('#sheetData #row' + i).addClass('excel-selected');
                }

                $('[type="submit"], [type="button"]').attr('disabled', false);
                $('#person').text('0% (0/' + (parseInt($('#sheetData tr').length) - 1) + ')');
                check_exists();
                $('.amaran-wrapper').remove();
                hideLoading();
            }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            showNoti('Lỗi:' + xhr.status + ' ' + thrownError, 'Không thể đọc thông tin file', 'Err');
        }
    });
}

function check_exists() {
    var supplier_part_col = $('#supplier_part').val();
    $('#sheetData .excel-selected').removeClass('exists');
    $('#sheetData .excel-selected [data-col="' + supplier_part_col + '"]').each(function() {
        var supplier_part = $(this).text();
        if ($('#itemList tbody tr[data-supplier_part="' + supplier_part + '"]').length) {
            $(this).parent().addClass('exists');
        }
    });
}

function import_row() {
    var tr = $('#sheetData tr:eq(' + index + ')');
    var supplier_part_col = $('#supplier_part').val();
    var supplier_part = tr.find('[data-col="' + supplier_part_col + '"]').text().trim();
    if (!tr.hasClass('exists') && supplier_part) {
        $.ajax({
            url: site_url + 'stock_inout/get_category',
            type: 'POST',
            data: {
                part: supplier_part
            },
            success: function(string) {
                // if (category && arrqp.includes(supplier_part)) {
                var getData = $.parseJSON(string);
                if (string != 0) {
                    var lot_no_col = $('#lot_no').val();
                    var lot_no = tr.find('[data-col="' + lot_no_col + '"]').text().trim();
                    var import_method_col = $('#import_method').val();
                    var import_method = tr.find('[data-col="' + import_method_col + '"]').text().trim();
                    var lot_code_col = $('#lot_code').val();
                    var lot_code = tr.find('[data-col="' + lot_code_col + '"]').text().trim();
                    var manufacturer_part_number_col = $('#manufacturer_part_number').val();
                    var manufacturer_part_number = tr.find('[data-col="' + manufacturer_part_number_col + '"]').text().trim();
                    var firmware_col = $('#firmware').val();
                    var firmware = tr.find('[data-col="' + firmware_col + '"]').text().trim();
                    var imei_col = $('#imei').val();
                    var imei = tr.find('[data-col="' + imei_col + '"]').text().trim();
                    var manufacturer_col = $('#manufacturer').val();
                    var manufacturer = tr.find('[data-col="' + manufacturer_col + '"]').text().trim();
                    var description_col = $('#description').val();
                    var description = tr.find('[data-col="' + description_col + '"]').text().trim();
                    var date_code_col = $('#date_code').val();
                    var date_code = tr.find('[data-col="' + date_code_col + '"]').text().trim();
                    var coo_col = $('#coo').val();
                    var coo = tr.find('[data-col="' + coo_col + '"]').text().trim();
                    var packaging_col = $('#packaging').val();
                    var packaging = tr.find('[data-col="' + packaging_col + '"]').text().trim();
                    var minimum_stock_col = $('#minimum_stock').val();
                    var minimum_stock = tr.find('[data-col="' + minimum_stock_col + '"]').text().trim();
                    var end_sell_date_col = $('#end_sell_date').val();
                    var end_sell_date = tr.find('[data-col="' + end_sell_date_col + '"]').text().trim();
                    var package_case_col = $('#package_case').val();
                    var package_case = tr.find('[data-col="' + package_case_col + '"]').text().trim();
                    var spq_col = $('#spq').val();
                    var spq = tr.find('[data-col="' + spq_col + '"]').text().trim();
                    var qty_col = $('#qty').val();
                    var qty = parseInt(tr.find('[data-col="' + qty_col + '"]').text().replace(/\s/g, '').replace(/,/g, ''));
                    var priceusd_col = $('#priceusd').val();
                    var priceusd = parseFloat(tr.find('[data-col="' + priceusd_col + '"]').text().replace('$', '').replace('đ', '').replace('₫', '').replace(/\s/g, '').replace(/,/g, ''));
                    var pricevnd_col = $('#pricevnd').val();
                    var pricevnd = parseInt(tr.find('[data-col="' + pricevnd_col + '"]').text().replace('$', '').replace('đ', '').replace('₫', '').replace(/\s/g, '').replace(/,/g, ''));
                    var warehouse_col = $('#warehouse').val();
                    var warehouse = tr.find('[data-col="' + warehouse_col + '"]').text().trim();
                    if ($('#itemList .highlightNoClick').length) {
                        var key = parseInt($('#itemList .highlightNoClick:last-child .keyItem').val()) + 1;
                    } else {
                        var key = 1;
                    }
                    var data = {
                        key: key,
                        category: getData.category,
                        cpo: '',
                        cpoid: '',
                        sc: '',
                        code: '',
                        nk_date: '',
                        po: '',
                        poid: '',
                        cus: '',
                        cusid: '',
                        import_method: import_method,
                        lot_no: lot_no,
                        lot_code: lot_code,
                        
                        supplier_part: supplier_part,
                        manufacturer_part_number: manufacturer_part_number,
                        description: description,
                        manufacturer: manufacturer,
                        package_case: package_case,
                        packaging: packaging,
                        spq: spq,
                        date_code: date_code,
                        coo: coo,
                        firmware: firmware,
                        imei: imei,
                        // warehouse: warehouse,
                        warehouse: $('#warehouseid').val(),
                        minimum_stock: minimum_stock ? minimum_stock : 0,
                        end_sell_date: end_sell_date,
                        qty: isNaN(qty) ? 1 : qty,
                        priceusd: isNaN(priceusd) ? 0 : priceusd,
                        pricevnd: isNaN(pricevnd) ? (isNaN(priceusd) ? 0 : priceusd * parseInt($('#USDExchangeRate').val())) : pricevnd,
                        vat: 10,
                        import_tax: 0,
                    };
                    tr.addClass('updated');
                    add_item(data);
                    // sum_item($(this).closest('tr'));
                } else {
                    tr.addClass('notfound');
                }
                var percent = (index / num * 100).toFixed(0);
                $('.progress-bar').css({
                    width: percent + '%'
                });

                $('#person').text(percent + '% (' + index + '/' + num + ')');
                index++;

                if (index <= num) {
                    import_row();
                } else {
                    if ($('#sheetData .notfound').length) {
                        showNoti('Có ' + $('#sheetData .notfound').length + ' mục không tìm thấy danh mục', 'Cảnh báo!', 'War');
                    } else {
                        $('[data-dismiss="modal"]').click();
                    }
                }
            }
        });
    } else {
        var percent = (index / num * 100).toFixed(0);
        $('.progress-bar').css({
            width: percent + '%'
        });

        $('#person').text(percent + '% (' + index + '/' + num + ')');
        index++;

        if (index <= num) {
            import_row();
        } else {
            $('[data-dismiss="modal"]').click();
        }
    }
}

function update_row() {
    var tr = $('#sheetData tr:eq(' + index + ')');
    var lot_code_col = $('#lot_code').val();
    var lot_code = tr.find('[data-col="' + lot_code_col + '"]').text().trim();
    var supplier_part_col = $('#supplier_part').val();
    var supplier_part = tr.find('[data-col="' + supplier_part_col + '"]').text().trim();
    if (!tr.hasClass('exists') && supplier_part && lot_code) {
        $.ajax({
            url: site_url + 'stock_inout/checkPartUpdate',
            type: 'POST',
            data: {
                lot_code: lot_code,
                part: supplier_part,
                id: $('#id').val()
            },
            success: function(string) {
                if (string != 0) {
                    var getData = $.parseJSON(string);
                    var lot_no_col = $('#lot_no').val();
                    var lot_no = tr.find('[data-col="' + lot_no_col + '"]').text().trim();
                    var import_method_col = $('#import_method').val();
                    var import_method = tr.find('[data-col="' + import_method_col + '"]').text().trim();
                    var manufacturer_part_number_col = $('#manufacturer_part_number').val();
                    var manufacturer_part_number = tr.find('[data-col="' + manufacturer_part_number_col + '"]').text().trim();
                    var firmware_col = $('#firmware').val();
                    var firmware = tr.find('[data-col="' + firmware_col + '"]').text().trim();
                    var imei_col = $('#imei').val();
                    var imei = tr.find('[data-col="' + imei_col + '"]').text().trim();
                    var manufacturer_col = $('#manufacturer').val();
                    var manufacturer = tr.find('[data-col="' + manufacturer_col + '"]').text().trim();
                    var description_col = $('#description').val();
                    var description = tr.find('[data-col="' + description_col + '"]').text().trim();
                    var date_code_col = $('#date_code').val();
                    var date_code = tr.find('[data-col="' + date_code_col + '"]').text().trim();
                    var coo_col = $('#coo').val();
                    var coo = tr.find('[data-col="' + coo_col + '"]').text().trim();
                    var packaging_col = $('#packaging').val();
                    var packaging = tr.find('[data-col="' + packaging_col + '"]').text().trim();
                    var minimum_stock_col = $('#minimum_stock').val();
                    var minimum_stock = tr.find('[data-col="' + minimum_stock_col + '"]').text().trim();
                    var end_sell_date_col = $('#end_sell_date').val();
                    var end_sell_date = tr.find('[data-col="' + end_sell_date_col + '"]').text().trim();
                    var package_case_col = $('#package_case').val();
                    var package_case = tr.find('[data-col="' + package_case_col + '"]').text().trim();
                    var spq_col = $('#spq').val();
                    var spq = tr.find('[data-col="' + spq_col + '"]').text().trim();
                    var qty_col = $('#qty').val();
                    var qty = parseInt(tr.find('[data-col="' + qty_col + '"]').text().replace(/\s/g, '').replace(/,/g, ''));
                    var priceusd_col = $('#priceusd').val();
                    var priceusd = parseFloat(tr.find('[data-col="' + priceusd_col + '"]').text().replace('$', '').replace('đ', '').replace('₫', '').replace(/\s/g, '').replace(/,/g, ''));
                    var pricevnd_col = $('#pricevnd').val();
                    var pricevnd = parseInt(tr.find('[data-col="' + pricevnd_col + '"]').text().replace('$', '').replace('đ', '').replace('₫', '').replace(/\s/g, '').replace(/,/g, ''));
                    // var warehouse_col = $('#warehouse').val();
                    // var warehouse = tr.find('[data-col="' + warehouse_col + '"]').text().trim();
                    if (getData.parent && getData.parent > 0) {
                        var trUpdate = $('#itemList tbody tr.highlightNoClick[data-lot_code="' + getData.lot_code + '"]');
                        if (qty_col != '') trUpdate.find('.qtyItem').val(isNaN(qty) ? 1 : qty);
                        if (priceusd_col != '') trUpdate.find('.priceUSDItem').val(isNaN(priceusd) ? 0 : priceusd);
                        if (minimum_stock_col != '') trUpdate.find('td.minimum_stock input').val(isNaN(minimum_stock) ? 0 : minimum_stock);
                        if (imei_col != '') trUpdate.find('td.imei input').val(imei);
                        if (firmware_col != '') trUpdate.find('td.firmware input').val(firmware);
                        if (coo_col != '') trUpdate.find('td.coo select').val(coo).trigger('chosen:updated');
                        if (date_code_col != '') trUpdate.find('td.date_code input').val(date_code);
                        if (spq_col != '') trUpdate.find('td.spq input').val(spq);
                        if (packaging_col != '') trUpdate.find('td.packaging select').val(packaging).trigger('chosen:updated');
                        if (package_case_col != '') trUpdate.find('td.package_case input').val(package_case);
                        if (end_sell_date != '') trUpdate.find('td.end_sell_date .bootstrap-date-plus').val(end_sell_date).trigger('change');
                        if (manufacturer_col != '') trUpdate.find('td.manufacturer input').val(manufacturer);
                        if (description_col != '') trUpdate.find('td.description input').val(description);
                        if (lot_no_col != '') trUpdate.find('td.lot_no input').val(lot_no);
                        tr.addClass('update');
                        sum_item(trUpdate);
                    } else {
                        if ($('#itemList .highlightNoClick').length) {
                            var key = parseInt($('#itemList .highlightNoClick:last-child .keyItem').val()) + 1;
                        } else {
                            var key = 1;
                        }
                        var data = {
                            key: key,
                            category: getData.category,
                            cpo: '',
                            cpoid: '',
                            sc: '',
                            inv: '',
                            po: '',
                            poid: '',
                            code: '',
                            nk_date: '',
                            cus: '',
                            cusid: '',
                            import_method: import_method,
                            lot_no: lot_no,
                            lot_code: lot_code,
                            supplier_part: supplier_part,
                            manufacturer_part_number: manufacturer_part_number,
                            description: description,
                            manufacturer: manufacturer,
                            package_case: package_case,
                            packaging: packaging,
                            spq: spq,
                            date_code: date_code,
                            coo: coo,
                            firmware: firmware,
                            imei: imei,
                            warehouse: $('#warehouseid').val(),
                            minimum_stock: minimum_stock ? minimum_stock : 0,
                            end_sell_date: end_sell_date,
                            qty: isNaN(qty) ? 1 : qty,
                            priceusd: isNaN(priceusd) ? 0 : priceusd,
                            pricevnd: isNaN(pricevnd) ? (isNaN(priceusd) ? 0 : priceusd * parseInt($('#USDExchangeRate').val())) : pricevnd,
                            vat: 10,
                            import_tax: 0,
                        };
                        tr.addClass('updated');
                        add_item(data);
                    }
                } else {
                    tr.addClass('notfound');
                }
                var percent = (index / num * 100).toFixed(0);
                $('.progress-bar').css({
                    width: percent + '%'
                });

                $('#person').text(percent + '% (' + index + '/' + num + ')');
                index++;

                if (index <= num) {
                    update_row();
                } else {
                    if ($('#sheetData .notfound').length) {
                        showNoti('Có ' + $('#sheetData .notfound').length + ' mục không tìm thấy danh mục', 'Cảnh báo!', 'War');
                        $('#updateRow').attr('disabled');
                    } else {
                        $('[data-dismiss="modal"]').click();
                    }
                }
            }
        })
    }
}

function updateDataItem(e) {
    var Orqty = parseFloat(e.find('.order-qty').val().replace(/\s/g, '').replace(/,/g, ''));
    var totalAmountUSD = 0;
    var totalAmountVND = 0;
    if (Orqty < 0) {
        Orqty = 0;
    }
    //var amountVND = (Orqty * priceUSD) * parseFloat($('#USDExchangeRate').val().replace(/\s/g, '').replace(/,/g, ''));
    var priceUSD = parseFloat(e.find('.unit-price-usd').val().replace(/\s/g, '').replace(/,/g, ''));
    var priceVND = parseFloat(e.find('.unit-price-vnd').val().replace(/\s/g, '').replace(/,/g, ''));
    var amountVND = Orqty * priceVND;
    e.find('.amountUSDItem').val(accounting.formatMoney(Orqty * priceUSD, '', 2));
    e.find('.amountVNDItem').val(accounting.formatMoney(amountVND, '', 0));

    $('#itemList .amountUSDItem').each(function() {
        totalAmountUSD += parseFloat($(this).val().replace(/,/g, ''));
    });
    $('#totalAmountUSD').val(accounting.formatMoney(totalAmountUSD, '', 2));

    $('#itemList .amountVNDItem').each(function() {
        totalAmountVND += parseFloat($(this).val().replace(/,/g, ''));
    });
    $('#totalAmountVND').val(accounting.formatMoney(totalAmountVND, '', 0));

    updateDataSum();
}

function updateDataSum() {}

function handleTAX(inp) {
    var parent = inp.closest('tr');
    var val = inp.val();
    var priceUSDItemHide = parseFloat(parent.find('.priceUSDItemHide').val().replace(/,/, ''));
    var amountUSDItem = parent.find('.amountUSDItem');
    var priceUSDItemTAX = parseFloat(priceUSDItemHide + (priceUSDItemHide * val / 100));
    parent.find('.priceUSDItem').val(accounting.formatMoney(priceUSDItemTAX, '', 4));
    amountUSDItem.val(accounting.formatMoney(parseFloat(priceUSDItemTAX * parent.find('.qtyItem').val().replace(/,/g, '')), '', 2));
    // handleVAT(parent.find('.VATUSDItem'));
    sum_item(parent);
}

function handleVAT(inp) {
    var parent = inp.closest('tr');
    var val = inp.val().replace(/,/g, '');
    var amountUSD = parseFloat(parent.find('.amountUSDItem').val().replace(/,/g,''));
    parent.find('.amountVATVNDItem').val(accounting.formatMoney(parseFloat(amountUSD + (amountUSD * val / 100)), '', 2));
}

$(document).ready(function(){

});

function sum_itemexcute(row) {
    var shipping = $('#shippingweight').val()==''? 0: parseFloat($('#shippingweight').val().replace(/\s/g, '').replace(/,/g, ''));  
    var Unit =$('#attrUnit').val()=='' ?0: parseFloat($('#attrUnit').val().replace(/\s/g, '').replace(/,/g, ''));  
    var Pickup =$('#attrPickup').val()=='' ? 0 : parseFloat($('#attrPickup').val().replace(/\s/g, '').replace(/,/g, ''));  
    var Local = $('#attrLocal').val()==''?0: parseFloat($('#attrLocal').val().replace(/\s/g, '').replace(/\s/g, ''));
    var trans = $('#attrtrans').val()==''?0: parseFloat($('#attrtrans').val().replace(/\s/g, '').replace(/\s/g, ''));
    var bankWeight =$('#bankWeight').val()==''? 0:parseFloat($('#bankWeight').val().replace(/\s/g, '').replace(/,/g, '')); 
    var bankUnit = $('#bankUnit').val()==''?0:parseFloat($('#bankUnit').val().replace(/\s/g, '').replace(/,/g, '')); 
    var declarecost =  $('#declarecost').val()==''? 0:parseFloat($('#declarecost').val().replace(/\s/g, '').replace(/,/g, '')); 
    var declarecustomer = $('#declarecustomer').val()==''?0: parseFloat($('#declarecustomer').val().replace(/\s/g, '').replace(/,/g, '')); 
    var amountCost = (shipping*Unit);
    var shippingTotal = parseFloat(amountCost+Pickup+Local+trans);
    var Total = parseFloat(shippingTotal+bankWeight+bankUnit+declarecost+declarecustomer);
    $('#attrAmount').val(accounting.formatMoney(amountCost, '', 2));
    $('#shipping_total').val(accounting.formatMoney(shippingTotal, '',2));
    $('#banktotal').val(accounting.formatMoney(bankWeight+bankUnit+declarecost, '',2));
    $('#declareTotal').val(accounting.formatMoney(declarecustomer, '', 2));
  // row.find('.attrAmount').val(accounting.formatMoney(amountCost, '', 0));
 //  row.find('.shipping-Total').val(accounting.formatMoney(shippingTotal, '', 0));
  // row.find('.bank-Total').val(accounting.formatMoney(bankWeight+bankUnit+declarecost, '', 0));
  // row.find('.declare-Total').val(accounting.formatMoney(declarecustomer, '', 0));

   $("#cost_total").text(accounting.formatMoney(Total, '',2));


    //.sum_all();

}
/*function sum_itemexcute1(row) {
        var bankWeight = parseFloat(row.find('.bankWeight').val().replace(/\s/g, '').replace(/,/g, ''));
        var declarecost = parseFloat(row.find('.declarecost').val().replace(/\s/g, '').replace(/,/g, ''));
        var bankUnit = parseFloat(row.find('.bankUnit').val().replace(/\s/g, '').replace(/,/g, '')); 
       // var bankCustom = parseFloat(row.find('.attr-Custom').val().replace(/\s/g, '').replace(/,/g, '')); 

    // var amountCost = parseInt(shipping*Unit);
  //   var shippingTotal = parseInt(amountCost+Pickup+Local+trans);
    var banktotal = parseInt(bankWeight+bankUnit+declarecost);
     
   //  row.find('.attr-Amount').val(accounting.formatMoney(amountCost, '', 0));
    // row.find('.shipping-Total').val(accounting.formatMoney(shippingTotal, '', 0));
     row.find('.bank-Total').val(accounting.formatMoney(banktotal, '', 0));
    // var declareTotal = row.find('.declare-Total').val().replace(/\s/g, '').replace(/,/g, ''); 
     var declareTotal =  $("#banktotal").val().replace(/\s/g, '').replace(/,/g, ''); 
     var banktotal =  $("#banktotal").val().replace(/\s/g, '').replace(/,/g, ''); 
     var shipping_total =  $("#shipping_total").val().replace(/\s/g, '').replace(/,/g, ''); 

    //console.log(shippingTotal);

   $("#cost_total").text(accounting.formatMoney( Number(declareTotal)+Number(banktotal)+Number(shipping_total), '', 0));

 
     //.sum_all();
 
 }
 function sum_itemexcute2(row) {
    var bankCustom = parseFloat(row.find('.declarecustomer').val().replace(/\s/g, '').replace(/,/g, '')); 
    row.find('.declare-Total').val(accounting.formatMoney(bankCustom, '', 0));

      var declareTotal = row.find('.declare-Total').val().replace(/\s/g, '').replace(/,/g, ''); 
      var banktotal =  $("#banktotal").val().replace(/\s/g, '').replace(/,/g, ''); 
      var shipping_total =  $("#shipping_total").val().replace(/\s/g, '').replace(/,/g, ''); 

     //console.log(shippingTotal);

    $("#cost_total").text(accounting.formatMoney( Number(declareTotal)+Number(banktotal)+Number(shipping_total), '', 0));


 //.sum_all();

}*/
function cpo_detail_load() {
    var id=$('#cpoid').val();
    //alert(id);
        $.ajax({
                url: site_url + 'ajax/get_info_with_id',
                cache: false,
                type: 'POST',
                data: {
                    id: id,
                    table: 'customer_purchase_order',
                    act: $('#act').val()
                },
                success: function(string) {
    
                    var getData = $.parseJSON(string);
                   // $('#customerid').val(getData.CustomerID).trigger('chosen:updated');
                    arrqp = getData.querypart;
                    var data = [];
                    // string JSON to array JSON
                    if (arrqp && arrqp.length > 0) {
                        var newJson = arrqp.replace(/"([a-zA-Z0-9]+?)":/g, '"$1":');
                        newJson = newJson.replace(/'/g, '\'');
                        data = JSON.parse(newJson);
                    }
                    if ($('#act').val() == 'stock_import' || $('#act').val() == 'stock_begin') {
                        showPartInCPO(data);
                    }
                    if ($('#act').val() == 'stock_export') {
                        showPartInCPO(data);
                    }
                }
            })
            $.ajax({
                url: site_url + 'ajax/get_info_with_id',
                cache: false,
                type: 'POST',
                data: {
                    id: id,
                    table: 'customer_purchase_order',
                    act: $('#act').val()
                },
                success: function(string) {
                    var getData = $.parseJSON(string);
                    $('#cpoDate').val(getData.CPODate);
                 //   $('#cpoApprove').val("Approved");
                  //  $('#cpoStatus').val("CPO Completed");
    
                }
                
            })
            $.ajax({
                        url: site_url + $('#act').val() + '/get_Status_CPO',
                        cache: false,
                        type: 'POST',
                        data: {
                            id: id,
                            
                        },
                        success: function(string) {
                   // var getData = $.parseJSON(string);
                    $('#cpoApprove').val(string);
    
                    
                    }
                    })
            $.ajax({
                        url: site_url + $('#act').val() + '/get_Status',
                        cache: false,
                        type: 'POST',
                        data: {
                            id: id,
                            table: '',
                            act: $('#act').val()
                        },
                        success: function(string) {
                    var getData = $.parseJSON(string);
                    document.getElementById("cpoStatus").style.color = getData.color;
                    $('#cpoStatus').val(getData.name_vn);
    
                   
                    }
                    })
       
    }  
    function debits() {

        $('#itemList tbody').empty();
            $('#debits').val(0);
          var id=  $('#customerid').val();
         // alert(id);
    
            $.ajax({
                url: site_url + $('#act').val() + '/debits',
                cache: false,
                type: 'POST',
                data: {
                    id: $('#customerid').val(),
                    //table: 'customer_sales_contract',
                  //  act: $('#act').val()
                },
                success: function(string) {
                    var getData = $.parseJSON(string);
                      if ( Array.isArray( getData ) && getData.length ) {
                            for ( var i = 0; i < getData.length; i++ ) {
                                console.log(getData[ i ][ 'InvoiceRest' ]);
                                $('#debits').val(accounting.formatMoney(getData[ i ][ 'InvoiceRest' ],'',0));
    
    
                            }
                        }
                }
            })
            $.ajax({
                url: site_url + 'ajax/get_info_with_id',
                cache: false,
                type: 'POST',
                data: {
                    id: $('#customerid').val(),
                    table: 'customers',
                    act: $('#act').val()
                },
                success: function(string) {
    
                    var getData = $.parseJSON(string);
                    $('#Creadit').val(accounting.formatMoney(getData.CreditLineNumber,'',0));
                 //   $('#cpoApprove').val("Approved");
                  //  $('#cpoStatus').val("CPO Completed");
    
                }
                
            })
           /* $.ajax({
                url: site_url + 'ajax/get_info_with_id',
                cache: false,
                type: 'POST',
                data: {
                    id: $('#customerid').val(),
                    table: 'customer_purchase_order',
                   // act: $('#act').val()
                },
                success: function(string) {
    
                    var getData = $.parseJSON(string);
                     $('#cpoid').val(getData.id).trigger('chosen:updated');
    
                   // $('#Creadit').val(accounting.formatMoney(getData.CreditLineNumber,'',0));
                 //   $('#cpoApprove').val("Approved");
                  //  $('#cpoStatus').val("CPO Completed");
    
                }
                
            })*/
            setTimeout(function() {
                var Creadit  =parseFloat($('#Creadit').val().replace(/\s/g, '').replace(/,/g, ''));
                var debits  = parseFloat($('#debits').val().replace(/\s/g, '').replace(/,/g, ''));
                if(  debits > Creadit ){
                    $('#CreaditStatus').val('Over Credit');
        
                }else{
        
                    $('#CreaditStatus').val('Non - Over Credit');
        
                }
               // import_row();
            }, 1200);
          //  cpo();
        }
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
       /* $('.btn-insert-part').click(function() {
           // alert(1);
            var form_groups = $(this).closest(".fg-po");
            var value = form_groups.find("input.SCCode").val();
         //   var data = ['Supplier Part','Mfr Part','Manufacturer','	Quantity','Unit Price USD'];
          //  var data  = await this.send({value},'getListPart');


          //  alert(value);
          $.ajax({
            url: site_url + 'ajax/get_info_with_id',
            cache: false,
            type: 'POST',
            data: {
                id: $(this).val(),
                table: 'customer_purchase_order',
                act: $('#act').val()
            },
            success: function(string) {

                var getData = $.parseJSON(string);
               // $('#customerid').val(getData.CustomerID).trigger('chosen:updated');
                arrqp = getData.querypart;
                var data = [];
                // string JSON to array JSON
                if (arrqp && arrqp.length > 0) {
                    var newJson = arrqp.replace(/"([a-zA-Z0-9]+?)":/g, '"$1":');
                    newJson = newJson.replace(/'/g, '\'');
                    data = JSON.parse(newJson);
                }
                    showPartInCPO(data);
                
               
            }
        })
          
        
        }
        
        
        )

        function showPartInCPO(arr) {
            if (arr) {
                string = '<div class="table-responsive"><table class="table table-hover"><thead class=""><th>STT</th><th nowrap="nowrap">Supplier Part</th><th nowrap="nowrap">Mfr Part</th><th nowrap="nowrap">Manufacturer</th><th nowrap="nowrap">Quantity</th><th nowrap="nowrap">Unit Price USD</th></tr></thead><tbody>';
                for (var i = 0; i < arr.length; i ++) {
                    string += '<tr data-cpo="' + arr[i]['CPO'] + '" data-cpono="' + arr[i]['CPONo'] + '" data-po="' + arr[i]['PO'] + '" data-pono="' + arr[i]['PONo'] + '" data-cus="' + arr[i]['CUS'] + '" data-cusname="' + arr[i]['CUSName'] + '" data-import_method="' + arr[i]['ImportMethod'] + '">';
                    string += '<td>' + (i + 1) + '</td>';
                    string += '<td class="supplier_part">' + arr[i]['SupplierPart'].replace('&', '&amp;') + '</td>';
                    string += '<td><div class="manufacturer_part_number">' + arr[i]['MfrPart'].replace('&', '&amp;') + '</div><span class="desc">' + arr[i]['Description'].replace('&', '&amp;') + '</span></td>';
                    string += '<td class="manufacturer">' + arr[i]['Manufacturer'].replace('&', '&amp;') + '</td>';
                    string += '<td class="qty">' + arr[i]['OrderQuantity'] + '</td>';
                    string += '<td class="priceusd">' + arr[i]['UnitPriceUSD'] + '</td>';
                    string += '</tr>';
                }
                string += '</table></div>';
                $('#PartListInCPO .content').html(string);
            }
        }*/
        function csclist(id) {
        //    alert(id);
            $.ajax({
                url: site_url + $('#act').val() + '/csc_detail',
                //url: site_url + 'ajax/get_info_with_id',

                cache: false,
                type: 'POST',
                data: {
                    id: id,
                    table: 'customer_sales_contract',
                    act: $('#act').val()
                },
                success: function(string) {
                    var getData = $.parseJSON(string);
                    var DepositPayment= parseFloat(getData.DepositPayment1)+parseFloat(getData.DepositPayment2)+parseFloat(getData.DepositPayment3)+parseFloat(getData.DepositPayment4)+parseFloat(getData.DepositPayment5)+parseFloat(getData.DepositPayment6)+parseFloat(getData.DepositPayment7)+parseFloat(getData.DepositPayment8)+parseFloat(getData.DepositPayment9)+parseFloat(getData.DepositPayment10)
                 //  console.log(DepositPayment);
                //  $('#amout').val(getData.PaymentTerm);
                    if(getData.Currency=='VND'){
                        $("#amout").val(accounting.formatMoney(getData.TotalVND,'',0));
                        $(".currentcsc").text('VND');
                        $("#RestPayment").val(accounting.formatMoney(parseFloat(getData.TotalVND)-DepositPayment,'',0));

                    }else{

                        $("#amout").val(accounting.formatMoney(getData.TotalVND,'',2));
                        $("#RestPayment").val(accounting.formatMoney(parseFloat(getData.TotalVND)-DepositPayment,'',2));

                        $(".currentcsc").text('USD');


                    }
                    $('#NumberOfDepositPayment').val(getData.NumberOfDepositPayment);
                    $('#cscStatus').val(getData.name_vn);
                    $('#cscapproved').val(getData.name_vnap);

                  $('#NumberOfDepositPayment').val(getData.NumberOfDepositPayment);
                  $('#CSCPaymentTerm').val(getData.CSCPaymentTerm).trigger('chosen:updated');    
              var Deposit1='',Deposit2='',Deposit3='',Deposit4='',Deposit5='',Deposit6='',Deposit7='',Deposit8='',Deposit9='',Deposit10='';
                  for (i = 1; i <= getData.NumberOfDepositPayment; i++) {
                 
                    if(i == 1)  Deposit1 = 'Deposit 1: ' + accounting.formatMoney(getData.DepositPayment1,'',0)+' VND'+ (getData.DepositPaymentDate1 !=null ?',  Deposit Date 1: '+ getData.DepositPaymentDate1:'');
                    if(i == 2)  Deposit2 = 'Deposit 2: ' + accounting.formatMoney(getData.DepositPayment2,'',0)+' VND'+ (getData.DepositPaymentDate2 !=null ?',  Deposit Date 2: '+ getData.DepositPaymentDate2:'');
                    if(i == 3)  Deposit3 = 'Deposit 3: ' + accounting.formatMoney(getData.DepositPayment3,'',0)+' VND'+ (getData.DepositPaymentDate3 !=null ?',  Deposit Date 3: '+ getData.DepositPaymentDate3:'');
                    if(i == 4)  Deposit4 = 'Deposit 4: ' + accounting.formatMoney(getData.DepositPayment4,'',0)+' VND'+ (getData.DepositPaymentDate4 !=null ?',  Deposit Date 4: '+ getData.DepositPaymentDate4:'');
                    if(i == 5)  Deposit5 = 'Deposit 5: ' + accounting.formatMoney(getData.DepositPayment5,'',0)+' VND'+ (getData.DepositPaymentDate5 !=null ?',  Deposit Date 5: '+ getData.DepositPaymentDate5:'');
                    if(i == 6)  Deposit6 = 'Deposit 6: ' + accounting.formatMoney(getData.DepositPayment6,'',0)+' VND'+ (getData.DepositPaymentDate6 !=null ?',  Deposit Date 6: '+ getData.DepositPaymentDate6:'');
                    if(i == 7)  Deposit7 = 'Deposit 7: ' + accounting.formatMoney(getData.DepositPayment7,'',0)+' VND'+ (getData.DepositPaymentDate7 !=null ?',  Deposit Date 7: '+ getData.DepositPaymentDate7:'');
                    if(i == 8)  Deposit7 = 'Deposit 8: ' + accounting.formatMoney(getData.DepositPayment8,'',0)+' VND'+ (getData.DepositPaymentDate8 !=null ?',  Deposit Date 8: '+ getData.DepositPaymentDate8:'');
                    if(i == 9)  Deposit7 = 'Deposit 9: ' + accounting.formatMoney(getData.DepositPayment9,'',0)+' VND'+ (getData.DepositPaymentDate9 !=null ?',  Deposit Date 9: '+ getData.DepositPaymentDate9:'');
                    if(i == 10)  Deposit7 = 'Deposit 10: ' + accounting.formatMoney(getData.DepositPayment10,'',0)+' VND'+ (getData.DepositPaymentDate10 !=null ?',  Deposit Date 10: '+ getData.DepositPaymentDate10:'');


                  }
                  $('.deposit').text(Deposit1+ '\n '+ Deposit2+ '\n '+ Deposit3+ '\n '+ Deposit4+ '\n '+ Deposit5+ '\n '+ Deposit6+ '\n '+ Deposit7+ '\n '+ Deposit8+ '\n '+ Deposit9+ '\n '+ Deposit10);
                  $('#cscStatus').css('color', getData.color);
                  $('#cscapproved').css('color', getData.colorap);

                  
                }
            })
        }