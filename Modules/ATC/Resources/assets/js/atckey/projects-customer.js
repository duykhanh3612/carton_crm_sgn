setTimeout(function(){
    autoComplete();

    $('.select-autoComplete-staff').chosen('destroy');
    $('.select-autoComplete-linecardsup').chosen('destroy');

}, 100);
$('body').on('click', '.linecardsup', function () {
    $('.select-autoComplete-linecardsup').select2({
        placeholder: 'Select An Line CardID',
        ajax: {
            url: site_url + 'ajax/vLineCardID',
            dataType: 'json',
            async: false,
            data: function (data) {
                return {
                    searchTerm: data.term // search term
                };
            },
            processResults: function (response) {
                return {
                    results:response
                };
            },
            allowClear: true
        }
    });
})
function autoComplete(){
 
    $('.select-autoComplete-staff').select2({
        placeholder: 'Select An  Quote Staff',
        ajax: {
            url: site_url + 'ajax/UserID',
            dataType: 'json',
            async: false,
            data: function (data) {
                return {
                    searchTerm: data.term // search term
                };
            },
            processResults: function (response) {
                return {
                    results:response
                };
            },
            allowClear: true

        }
    });
    $('.select-autoComplete-linecardsup').select2({
        placeholder: 'Select An Line CardID',
        ajax: {
            url: site_url + 'ajax/vLineCardID',
            dataType: 'json',
            async: false,
            data: function (data) {
                return {
                    searchTerm: data.term // search term
                };
            },
            processResults: function (response) {
                return {
                    results:response
                };
            },
            allowClear: true
        }
    });

    $('.select-autoComplete-stage').one('select2:open', function(e) {
        $('input.select2-search__field').prop('placeholder', 'Created By Name');
    });
    $('.select-autoComplete-staff').one('select2:open', function(e) {
        $('input.select2-search__field').prop('placeholder', 'Follower Name');
    });
    $('.select-autoComplete-linecardsup').one('select2:open', function(e) {
        $('input.select2-search__field').prop('placeholder', 'Follower Name');
    });
}

var allCates = allCates || {};
var tmphtml = '';
$.each(allCates, function (k, i) {
if (!!i) {
    if (i.parent == 0) {
        tmphtml += '<optgroup label="' + i.name_vn + '">';
        $.each(allCates, function (kk, $subcat) {
            if ($subcat.parent == i.id) {
                tmphtml += '<option value="' + $subcat.id + '"' +'>' + $subcat.id + ' - ' + $subcat.name_vn + ' (' + $subcat.item + ')</option>';
            }
        });
        tmphtml += '</optgroup>';
    }
}
});
$('body').on('click', '.btn-list-old', function() {
//alert(1);
var tr = $(this).closest('tr');
var mfrPart = tr.find('.mfr-part').val();
var orderqty = tr.find('.order-qty');
var unitprice = tr.find('.eau-qty');
var unitpricetext = tr.find('.unitpricetext');
var AmountEAU = tr.find('.AmountEAU');
var AnnualQty = tr.find('.AnnualQty');
var AmountEAUtext = tr.find('.AmountEAUtext');
var key = tr.find('.key').val();


$.ajax({
    url: site_url + $('#act').val() + '/list_old',
    type: 'POST',
    cache: false,
    data: { mfrPart: mfrPart },
    success: function(string) {
        $('#modal-list-old .modal-body tbody').empty().append(string);
        $('#modal-list-old').modal('show');
        $('.get-info-item').click(function() {
            var tr_item = $(this).closest('tr');
          //  unitpricetext.text(accounting.formatMoney(parseFloat(tr_item.find('.unitprice').text().replace(/\s/g, '').replace(/,/g, '')), '', 4));
          var qty= orderqty.val(accounting.formatMoney(parseFloat(tr_item.find('.orderqty').text().replace(/\s/g, '').replace(/,/g, '')), '', 0));
         //  unitprice.val(accounting.formatMoney(parseFloat(tr_item.find('.unitprice').text().replace(/\s/g, '').replace(/,/g, '')), '', 4));
            $('#PotentialLineCard'+key+'Sellingprice').val(parseFloat(tr_item.find('.unitprice').text().replace(/\s/g, '').replace(/,/g, ''))).change();
        //   var AmountEAUtext1= price.val() * AnnualQty.val();
         //  AmountEAUtext.text( accounting.formatMoney(AmountEAUtext1,'',4));
        // $('#PotentialLineCard'+key+'Sellingprice').val().change();

           showNoti('Mfr Part Number: ' + mfrPart, 'Cập nhật hoàn tất', 'Ok');

            //updateDataItem(tr);
           // updateSum();
        });
    }
});
})
$(document).ready(function () {
$('#frmSearch').submit(function () {
    $('#divSearch').show();
    $('#divSearch div').css('max-height', '300px');
    $('#divSearch tbody').html('<tr><td class="fr center" colspan="10"><div style="padding:10px"><img src="assets/images/spinner-mini.gif"/></div></td></tr>');
    $.ajax({
        url: site_url + 'ajax/search_part',
        type: 'POST',
        cache: false,
        data: {
            q: $('[name="q"]').val()
        },
        success: function (string) {
            $('#divSearch tbody').empty().append(string);
            $('#divSearch tr:not(".no-data, .nodrop")').click(function () {
                var part = $(this).find('span.mfr-part').text();
                /*var key = parseInt($('#itemList table tbody .highlightNoClick:last td input.itemKey').val()) + 1;
                if ($('#itemList table tbody .highlightNoClick').length == 0) {
                    key = 1;
                }*/
                var key = 0;
                if ($('.PotentialLineCard').length) {
                    key = parseInt($('.PotentialLineCard:last .key').val()) + 1;
                }
                if ($('input.mfr-part[value="' + part + '"]').length) {
                    $('input.mfr-part[value="' + part + '"]').closest('tr.highlightNoClick').addClass('exists').delay(7000).queue(function (next) {
                        $(this).removeClass("exists");
                        next();
                    });
                    showNoti('Manufacturer Part Number: ' + part, 'Cảnh báo nhập liệu', 'War');
                } else {
                    add_potentiallinecard(key);
                    $('[name="PotentialLineCard[' + key + '][category]"]').val($(this).data('category'));
                    $('[name="PotentialLineCard[' + key + '][manufacturer_part_number]"]').val($(this).find('span.mfr-part').text());
                    $('[name="PotentialLineCard[' + key + '][SupplierPart]"]').val($(this).find('td.part').text());
                    $('[name="PotentialLineCard[' + key + '][PackageCase]"]').val($(this).find('td.package_case').text());
                    $('[name="PotentialLineCard[' + key + '][Image]"]').val($(this).find('img').data('url'));
                    $('[name="PotentialLineCard[' + key + '][Image]"]').parent('td').find('img').attr('src', $(this).find('img').data('url'));
                    $('[name="PotentialLineCard[' + key + '][Description]"]').val($(this).find('span.desc').text());
                    $('[name="PotentialLineCard[' + key + '][Manufacturer]"]').val($(this).find('td.manufacturer').text());
                    $('[name="PotentialLineCard[' + key + '][AnnualQty]"]').val($(this).find('td.spq').text());
                    $('PotentialLineCard' + key + 'Sellingprice').val($(this).find('td.unit-price').text());
                    $('[name="PotentialLineCard[' + key + '][LeadtimeComment]"]').val($(this).find('td.leadtime').text());
                }
                $(this).remove();
                if ($('#divSearch tbody tr').length == 0) {
                    $('#divSearch').hide();
                }
            });
        }
    });
    $('[name="q"]').val('').blur();
    return false;
});

$('body').on('click', '.add-samples', function () {
    var key = 0;
    if ($('.Samples').length) {
        key = parseInt($('.Samples:last .key').val()) + 1;
    }
    var html = '<tr class="Samples editing" id="Samples' + key + '">' +
        '<td nowrap="nowrap">' +
        '<input type="hidden" class="key" value="' + key + '"/>' +
        '<a href="javascript:;" class="edit-samples"><i class="glyph-icon icon-edit"></i></a>&nbsp;&nbsp;' +
        '<a href="javascript:;" class="remove-samples" data-id=""><i class="glyph-icon icon-remove"></i></a>' +
        '</td>' +
        '<td><span class="form-text PartNumber"></span><input type="text" name="Samples[' + key + '][manufacturer_part_number]" class="form-control"/></td>' +
        '<td><span class="form-text"></span><input type="text" name="Samples[' + key + '][Manufacturer]" class="form-control"/></td>' +
        '<td><span class="form-text"></span><input type="text" name="Samples[' + key + '][Quantity]" class="form-control money" style="text-align: left;"/></td>' +
        '<td><span class="form-text"></span><input type="text" name="Samples[' + key + '][DateOfTesting]" class="form-control date"/></td>' +
        '<td><span class="form-text"></span><input type="text" name="Samples[' + key + '][Result]" class="form-control"/></td>' +
        '<td><span class="form-text"></span><input type="text" name="Samples[' + key + '][LastModifiedDate]" class="form-control date"/></td>';
    if ($('.Samples').length) {
        $('.Samples:last').after(html);
    } else {
        $('.samples-list').append(html);
    }

    $('#Samples' + key + ' .date').datepicker({
        format: 'yyyy-mm-dd',
        language: 'vi',
        autoclose: true,
        todayHighlight: true
    });

    $('#Samples' + key + ' .money').autoNumeric('init', {
        'mDec': 0
    });
}).on('click', '.add-potentiallinecard', function () {

  
    var numb = 1;
    var key = 0;
    var today = new Date();
    var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
    var time = today.getHours() + ":" + today.getMinutes();
    var dateTime = date+' '+time;
    if ($('.PotentialLineCard').length) {
        key = parseInt($('.PotentialLineCard:last .key').val()) + 1;
        numb = parseInt($('.PotentialLineCard:last .numb').text()) + 1;
    }
    var paridnum=pardid+  key;

    var string = '<tr class="PotentialLineCard editing" id="PotentialLineCard' + key + '">' +

    '<td nowrap="nowrap">' +
    '<input type="hidden" class="key" value="' + key + '"/>' + 
    '<input type="hidden" name="PotentialLineCard[' + key + '][id]" value=""/>' +
    '<i  id="editchangeid"  class=" disabled edit-samples fa fa-pencil-square-o" aria-hidden="true" data-dismiss="modal" data-key=0 style=" position: relative;  font-size: 14px;color:red; "></i>&nbsp;'+

    '<i  id="editchangeid" class="remove-samples fa fa-trash-o" aria-hidden="true" style=" position: relative;  font-size: 14px;color:red; "></i><input class="rowid" type="hidden" name="" value="'+key+'" />'+
    '</td>' +
    '<td nowrap="nowrap" style="min-width:20px; max-width:20px;">' +
    '<span class="numb">' + numb + '</span>' +
    '</td>' +
    '<td style="min-width:40px; max-width: 40px;" class="center"><a href="javascript:;" name="PotentialLineCard['+key+'][list]" class="btn btn-default btn-list-old"><i class="glyph-icon icon-list-alt"></i></a></a></td>' +
    '<td style="min-width:60px; max-width:60px;"><div class="ps-relative"><input type="text" style="pointer-events: none;"  class="form-control text-center shipped-qty no-border"  id="PotentialLineCard'+key+'PartID" name="PotentialLineCard['+key+'][PartID]" value="'+paridnum+'">'+
    ' <div class="errordiv PotentialLineCard'+key+'PartID">'+
           '<div class="arrow"></div> Not Empty!  </div>'+
   '</div></td>'+
    '<td><div class="ps-relative"><span class="form-text Projectno"></span><input type="text" id="PotentialLineCard' + key + 'Projectno" name="PotentialLineCard[' + key + '][Projectno]" autocomplete="off"  class="form-control mfr-part" data-required="1"><div class="errordiv PotentialLineCard' + key + 'Projectno"><div class="arrow"></div>Not Empty!</div></div></td>' +
    '<td><select style=" height: 20px; " id="PotentialLineCard' + key + 'ProjectStatus" name="PotentialLineCard[' + key + '][ProjectStatus]" class="select-status  mycate ProjectStatussel">  </select></td>'+
    '<td><select style=" height: 20px; " multiple id="PotentialLineCard' + key + 'FAE" name="PotentialLineCard[' + key + '][FAE][]" class="select-status  mycate FAEsel">  </select></td>'+
    '<td><select style=" height: 20px; " id="PotentialLineCard' + key + 'Owner" name="PotentialLineCard[' + key + '][Owner]" class="select-status  mycate Ownersel">  </select></td>'+
    '<td><select style=" height: 20px; " multiple id="PotentialLineCard' + key + 'Marketing" name="PotentialLineCard[' + key + '][Marketing][]" class="select-status  mycate Marketingsel">  </select></td>'+

    '<td> <select style=" height: 20px; " id="SupplierID' + key + '" name="PotentialLineCard[' + key + '][SupplierID]" class="form-control find-staff select-autoComplete-linecardsup" style="width: 100%"></select></td>'+
   
    '<td style="min-width:200px; max-width: 200px;"><div class="ps-relative"><select id="PotentialLineCard' + key + 'category" class="select2 field-update editing" name="PotentialLineCard[' + key + '][category]"  data-required="0" ><option value="">Chọn ...</option>' +tmphtml+'</select><div class="errordiv PotentialLineCard' + key + 'category"><div class="arrow"></div>Not Empty!</div></div></td>' +

    '<td><div class="ps-relative"><span class="form-text PartNumber"></span><input type="text" id="PotentialLineCard' + key + 'PartNumber" name="PotentialLineCard[' + key + '][manufacturer_part_number]" autocomplete="off"  class="form-control mfr-part" data-required="1"><div class="errordiv PotentialLineCard' + key + 'PartNumber"><div class="arrow"></div>Not Empty!</div></div></td>' +
    '<td style="min-width:200px; max-width: 200px;"><div class="ps-relative"><span class="form-text"></span><input type="text" id="PotentialLineCard' + key + 'Description" name="PotentialLineCard[' + key + '][Description]" autocomplete="off" class="form-control"   data-required="0" ><div class="errordiv PotentialLineCard' + key + 'Description"><div class="arrow"></div>Not Empty!</div></div></td>' +
    // '<td><span class="form-text"></span><input type="text" name="PotentialLineCard[' + key + '][Manufacturer]" class="form-control"/></td>' +
    '<td style="min-width:150px; max-width: 150px;">' +
    '    <div class="ps-relative"><span class="form-text"></span><input type="text" id="PotentialLineCard' + key + 'Manufacturer" name="PotentialLineCard[' + key + '][Manufacturer]" class="form-control" autocomplete="off"    data-required="0" ><div class="errordiv PotentialLineCard' + key + 'Manufacturer"><div class="arrow"></div>Not Empty!</div></div>' +
   
    '</td>' +
    '<td style="min-width:140px; max-width: 140px;display: none;"><span class="form-text"></span><input type="text" name="PotentialLineCard[' + key + '][PackageCase]" id="PotentialLineCard' + key + 'PackageCase" class="form-control"   data-required="0" autocomplete="off" style="text-align: left;"/><div class="errordiv PotentialLineCard' + key + 'PackageCase"><div class="arrow"></div>Not Empty!</div></td>' +
    '<td style="min-width:140px; max-width: 140px;display: none;"><span class="form-text"></span><input type="text" name="PotentialLineCard[' + key + '][Packaging	]"  id="PotentialLineCard' + key + 'Packaging" class="form-control"   data-required="0" autocomplete="off" style="text-align: left;"/><div class="errordiv PotentialLineCard' + key + 'Packaging"><div class="arrow"></div>Not Empty!</div></td>' +
    '<td style="min-width: 86px; max-width:86px;"><span class="form-text"></span><input type="text" style=" text-align: right;" name="PotentialLineCard[' + key + '][AnnualQty]" class="form-control eau-qty" autocomplete="off" style="text-align: left;"/></td>' +
    '<td style="min-width: 86px; max-width:86px;"><div class="ps-relative"><span class="form-text"></span><input type="text" style=" text-align: right;" id="PotentialLineCard' + key + 'UnitPrice" name="PotentialLineCard[' + key +'][UnitPrice]" autocomplete="off"  class="form-control unit-price"><div class="errordiv PotentialLineCard' + key + 'UnitPrice"><div class="arrow"></div>Not Empty!</div></div></td>' +
    '<td style="min-width: 100px; max-width:100px;"><div class="ps-relative"><span class="form-text"></span><div class="input-group"><input type="text" style=" text-align: right;" name="PotentialLineCard['+key+'][probability]" id="PotentialLineCard'+key+'probability" class="form-control approved-date-inp" value=""><div class="input-group-btn"><button type="button" class="btn btn-default empty-supplier">%</button></div></div></td>'+      
    '<td style="min-width: 100px; max-width:100px;"><div class="ps-relative"><span class="form-text"></span><div class="input-group"><input type="text" style=" text-align: right;" name="PotentialLineCard['+key+'][AmountEAU]" id="PotentialLineCard'+key+'AmountEAU" class="form-control approved-date-inp eau-amount" value=""><div class="input-group-btn"><button type="button" class="btn btn-default empty-supplier">$</button></div></div></td>'+      
    '<td style="min-width: 100px; max-width:100px;"><div class="ps-relative"><span class="form-text"></span><select id="PotentialLineCard' + key + 'RegistrationStage" name="PotentialLineCard[' + key +'][RegistrationStage]" autocomplete="off"    data-required="0"  class="select-status  mycate   StageStatussel StageStatussel' + key + '"></select><div class="errordiv PotentialLineCard' + key + 'RegistrationStage"><div class="arrow"></div>Not Empty!</div></div></td>'+      
    '<td style="min-width: 110px; max-width:110px;"><div class="ps-relative"><span class="form-text"></span><input type="text" style="width: 104px;pointer-events: none;background: none;border: none;"  name="PotentialLineCard['+key+'][StageDate]" id="PotentialLineCard'+key+'StageDate" class="form-control approved-date-inp" value=""></div></td>'+      
    '<td><div class="ps-relative"><span class="form-text"></span><input type="text" style="width: 104px;pointer-events: none;background: none;border: none;"  name="PotentialLineCard['+key+'][ResultDate]" id="PotentialLineCard'+key+'RegistrationDate" class="form-control approved-date-inp" value="'+dateTime+'"></div></td>'+      
    '<td><input type="text" style="width: 110px;pointer-events: none;background: none;border: none;"  name="PotentialLineCard['+key+'][RegistrationDate]" id="PotentialLineCard'+key+'ResultDate" class="form-control approved-date-inp" value=""></td>'+      
    '<td><select style=" height: 20px; " id="PotentialLineCard' + key + 'RegistrationStatus" name="PotentialLineCard[' + key + '][RegistrationStatus]" class="select-status  mycate RegistrationStatussel">' + rpstatus_options + ' </select><input type="hidden" name="" id="" class="form-control keymum" value="'+key+'"> </td>';  

    


    if ($('.PotentialLineCard').length) {
        $('#itemList table tbody tr.tr-last').before(string);
    } else {
        $('#itemList table tbody tr.tr-last').before(string);
}
$('#PotentialLineCard' + key + 'category').chosen();
//$('#PotentialLineCard' + key + 'category').chosen();


$.ajax( {
    url: site_url + $( '#act' ).val() + '/get_Stage',
    type: 'POST',
    cache: false,
    data: {
        //department: val,
    },
    success: function ( string ) {
        var getData = $.parseJSON( string );
     //   console.log( getData );
        $( '.StageStatussel'+key+'' ).empty();
        $StageOptions = '<option value="">Select...</option>';
        if ( Array.isArray( getData ) && getData.length ) {
            for ( var i = 0; i < getData.length; i++ ) {
                $StageOptions += '<option  data-color ="' + getData[ i ][ 'color' ] +  '"  style="BACKGROUND:' + getData[ i ][ 'color' ] +  '"  value="' + getData[ i ][ 'id' ] + '">' + getData[ i ][ 'name_vn' ] + '</option>';
            }
        }       
            $( '.StageStatussel'+key+'' ).html($StageOptions ).trigger( 'chosen:updated' );
    
    }
} )

$('.bootstrap-datepicker').datepicker({
    format: 'yyyy-mm-dd',
    language: 'vi',
    autoclose: true,
    todayHighlight: true
});
var no=$('#code1').val();

$('#PotentialLineCard' + key + 'Projectno').val(no);
var FaeStaff= ($('#FaeStaff').html());

$( '#PotentialLineCard'+key+'ProjectStatus' ).html($('#RegistrationStatus').html() ).trigger( 'chosen:updated' );
$( '#PotentialLineCard'+key+'FAE' ).html(FaeStaff ).trigger( 'chosen:updated' );
$( '#PotentialLineCard'+key+'Owner' ).html($('#AccountOwner').html() ).trigger( 'chosen:updated' );
$( '#PotentialLineCard'+key+'Marketing' ).html($('#maketing').html() ).trigger( 'chosen:updated' );
$('#PotentialLineCard' + key + 'FAE').chosen();
$('#PotentialLineCard' + key + 'ProjectStatus').chosen();
$('#PotentialLineCard' + key + 'Marketing').chosen();
$('#PotentialLineCard' + key + 'Owner').chosen();

$('#PotentialLineCard' + key + 'RegistrationStatus').chosen();
$('#PotentialLineCard' + key + ' .money').autoNumeric('init', {
    'mDec': 0
    });
    setTimeout(function(){
        autoComplete();

        //$('.select-autoComplete-staff').chosen('destroy');
       // $('.select-autoComplete-linecardsup').chosen('destroy');

    }, 900);
}).on('click', '.add-specialpricerequests', function () {
    var key = 0;
    if ($('.SpecialPriceRequests').length) {
        key = parseInt($('.SpecialPriceRequests:last .key').val()) + 1;
    }
    var html = '<tr class="SpecialPriceRequests editing" id="SpecialPriceRequests' + key + '">' +
        '<td nowrap="nowrap">' +
        '<input type="hidden" class="key" value="' + key + '"/>' +
        '<a href="javascript:;" class="edit-samples"><i class="glyph-icon icon-edit"></i></a>&nbsp;&nbsp;' +
        '<a href="javascript:;" class="remove-samples" data-id=""><i class="glyph-icon icon-remove"></i></a>' +
        '</td>' +
        '<td><span class="form-text PartNumber"></span><input type="text" name="SpecialPriceRequests[' + key + '][manufacturer_part_number]" class="form-control"/></td>' +
        '<td><span class="form-text"></span><input type="text" name="SpecialPriceRequests[' + key + '][Manufacturer]" class="form-control"/></td>' +
        '<td><span class="form-text"></span><input type="text" name="SpecialPriceRequests[' + key + '][AnnualQuantity]" class="form-control money" style="text-align: left;"/></td>' +
        '<td><span class="form-text"></span><input type="text" name="SpecialPriceRequests[' + key + '][CurrentPrice]" class="form-control money2" style="text-align: left;"/></td>' +
        '<td><span class="form-text"></span><input type="text" name="SpecialPriceRequests[' + key + '][SpecialPrice]" class="form-control money2" style="text-align: left;"/></td>' +
        '<td><span class="form-text"></span><input type="text" name="SpecialPriceRequests[' + key + '][probability]" class="form-control"/></td>' +
        '<td><span class="form-text"></span><input type="text" name="SpecialPriceRequests[' + key + '][LastModifiedDate]" class="form-control date"/></td>';
    if ($('.SpecialPriceRequests').length) {
        $('.SpecialPriceRequests:last').after(html).trigger('chosen:updated');
    } else {
        $('.specialpricerequests-list').append(html).trigger('chosen:updated');
    }
    $('#SpecialPriceRequests' + key + 'category').chosen();
    $('#SpecialPriceRequests' + key + ' .date').datepicker({
        format: 'yyyy-mm-dd',
        language: 'vi',
        autoclose: true,
        todayHighlight: true
    });

    $('#SpecialPriceRequests' + key + ' .money').autoNumeric('init', {
        'mDec': 0
    });

    $('#SpecialPriceRequests' + key + ' .money2').autoNumeric('init', {
        'mDec': 2
    });
}).on('click', '.remove-samples, .remove-potentiallinecard, .remove-specialpricerequests', function () {
    var id = $(this).closest('tr').find('.rowid').val();
    var tr = $(this).parent().parent();
    $.alerts.confirm('Will you delete this item?<br/><b>' + tr.find('.PartNumber').text() + '</b>', 'Confirm delete', function (r) {
        if (r == true) {
            tr.remove();
            $('#Shipmentsm'+id+'').remove();
            if (!!id) {
                $.ajax({
                    url: site_url + 'projects_customer/ajax_delete_potential_line_card',
                    method: "POST",
                    data: {id: id},
                    dateType: "json",
                    cache: false
                });
            }
        }
    });
}).on('click', '.edit-samples, .edit-potentiallinecard, .edit-specialpricerequests', function () {
    var tr = $(this).closest('tr');
    $(this).parent().parent().addClass('editing');
    var id = tr.find('.rowid').val();
    //var key = tr.dat('key');
    var key=$(this).data('key');
  //  alert(key);
   // tr.find('.mycate').chosen();
   tr.find('.mycate').removeClass('disabled');
   tr.find('.input-group').css('display','table');
   $("#Shipmentsm"+id+" .hiddenedit").css("pointer-events",'inherit');
    $("#Shipmentsm"+id+" .hiddenedit").css("opacity",'inherit');
   // tr.find('.editchange').text('');
    tr.find('.edit-potentiallinecard').removeClass('btn-warning');
  //  tr.find('.edit-potentiallinecard').attr('id','submitBtn');
    tr.find('.edit-potentiallinecard').css('color','#2ecc71');
   $('#PotentialLineCard1'+key+' td').css('background','rgb(249 147 57)');
   $('.Shipmentsm'+key+' td').removeClass('bgcolor');

   $('.Shipmentsm'+key+' td ').css('background-color','rgb(249 147 57)');
   
    //tr.find('.mycate').hide();
}).on('click', '.edit-potentiallinecardquote', function () {
    var tr = $(this).closest('tr');
    tr.addClass('editing');

    var id = tr.find('.parent').val();
  
    var key=$(this).data('key');
   // alert(key);
   tr.find('.mycate').removeClass('disabled');
   tr.find('.input-group').css('display','table');
   $('.colactivedetail'+key+'').addClass('editing');
   $('.Shipmentsm'+id+' td').removeClass('bgcolor');

   //$("#Shipmentsm"+id+" .hiddenedit").css("pointer-events",'inherit');
    //$("#Shipmentsm"+id+" .hiddenedit").css("opacity",'inherit');
   // tr.find('.edit-potentiallinecardquote').removeClass('btn-warning');
   // tr.find('.edit-potentiallinecardquote').css('color','#2ecc71');
   $('#Shipmentsm'+id+' td').css('background','rgb(249 147 57)');
   $('.Shipmentsm'+id+' td').removeClass('bgcolor');

   $('.Shipmentsm'+id+' td ').css('background-color','rgb(249 147 57)');
   
    //tr.find('.mycate').hide();
}).on('change', '.unit-price, .eau-qty, .probability, .sellingprice', function () {
    var parent = $(this).closest('tr');
    var key = parent.find('.key').val();

  //  var parent1 = $(this).closest('.Shipment');
   // var parent = $(this).closest('.PotentialLineCard ');
    var price = parseFloat($('#PotentialLineCard'+key+'UnitPrice').val().replace(/\s/g, '').replace(/,/g, ''));
    var prob = parseFloat($('#PotentialLineCard'+key+'probability').val().replace(/\s/g, '').replace(/,/g, ''));
  //  var prob= parseFloat(parent.find('.probability').val().replace(/\s/g, '').replace(/,/g, ''));
    var sell = parseFloat($('#PotentialLineCard'+key+'Sellingprice').val().replace(/\s/g, '').replace(/,/g, ''));
   // alert(key);
    $('#PotentialLineCard'+key+'UnitPrice').val(accounting.formatMoney(price, '', 4));
   // parent.find('.eau-qty').val(accounting.formatMoney(qty, '', 0));
   parseFloat($('#PotentialLineCard'+key+'probability').val(accounting.formatMoney(prob, '', 0)));
    parseFloat($('#PotentialLineCard'+key+'Sellingprice').val(accounting.formatMoney(sell, '', 4)));
   parseFloat($('#PotentialLineCard'+key+'AmountEAU').val(accounting.formatMoney(price * prob*sell,'',0)));
}).on('click', '.save-potentiallinecard', function () {
 //  e.preventDefault(); 
    // alert(1);
    var tr = $(this).closest('tr');

    var key=$(this).data('key');
  //  alert(key);
     var form =$('form.updateFrm').serialize();
 
     $.ajax({
        type: "POST",
        url: site_url + 'projects_customer/process',

        
        data: form,
     
        success: function(){
           showNoti('Update projects customer', 'Success', 'Ok');
         //  location.reload();
         tr.find('.edit-potentiallinecard').addClass('edit-potentiallinecard btn btn-alt btn-warning');
         $('#PotentialLineCard1'+key+' td').css('background','#fff');
       //  $('.Shipmentsm'+key+' td').removeClass('bgcolor');
  
         $('.Shipmentsm'+key+' td ').addClass('bgcolor');
        },
        error: function(){
            alert("Error");
        }
    });

 
}).on('click', '#addRowpo', function() {
   

var parent = $(this).closest('tr');
var keypar = parent.find('.itemKey').val();
var parentid = parent.find('.parent').val();
if ($('.PotentialLineCardquote'+parentid+'').length) {
    keyac =$(this).data('key');
    

    key = $('.PotentialLineCardquote'+parentid+'').length;

}else{
    keyac =$(this).data('key');

    key=2; 
}

$.ajax({
    type: "POST",
    url: "projects_customer/addRowquote",

    data: {
        stt: key,
        keyac: keyac,
        parentid: parentid,
        sttac:parentid+key

    },

    success: function(data) {
        
        $('.tr-last-'+keypar+'').before(data);
     //   $('#itemList table tbody tr.tr-last-'+keypar+'').before(data);

    },
    error: function() {
        alert("Error");
    }
});
/*
var string = `<tr class="highlightNoClick myDragClass PotentialLineCardquote${parentid} abcs colactivedetail${keyac}"  id="Shipmentsm${parentid}">         
<td style="min-width:150px; max-width:150px;" >
<input type="hidden" name="Shipment[${parentid}${key}][Sortstt]" class="itemKey" value="${key}">
<input type="hidden" class="key" value="${key}">
<input type="hidden" class="keyid" value="${parentid}${key}">

<div style="display: flex"><a href="javascript:;" style="padding-right:25px; " id="remove-sub-part" class="remove-contact" data-id="0"><i class="glyph-icon icon-remove"></i></a><input type="text" id="PotentialLineCard${key}CusLeadTime" name="Shipment[${parentid}${key}][CusLeadTime]" class="form-control" autocomplete="off"  value="">    
</div> </td>
<td style="min-width:30px; max-width:30px;" ><input type="text" style="pointer-events: none;" id="ShippedQty1" class="form-control no-border" value="${key}" ></td>
<td style="min-width:90px; max-width:90px;" >
<input type="hidden" style=" " id="ActiveStatus${parentid}${key}" name= "Shipment[${parentid}${key}][ActiveStatus]" class="bgshipmentinput hiddenedit  form-control text-center shipped-qty" value="" >    

<div><input type="text"  id="ActiveStatustext${parentid}${key}"  class="form-control" autocomplete="off"  value="">    
</div></td>
<td style="min-width:100px; max-width:100px;" ><div><input type="text" id="" name="Shipment[${parentid}${key}][ValidDate]" class="ValidDate form-control bootstrap-datepicker" autocomplete="off"  value="">    
</div></td>
<td style="min-width:160px; max-width:160px;" > 
  <select name="Shipment[${parentid}${key}][QuoteStaff]" id="QuoteStaff${parentid}${key}" class="form-control find-staff select-autoComplete-staff " style="width: 100%" >
  </select>
</td>  
<td style="min-width:80px; max-width:80px;" ><div><span class="form-text "> </span><input type="text" id="PotentialLineCard${parentid}${key}QuoteID" name="Shipment[${parentid}${key}][QuoteID]" class="form-control" autocomplete="off"  value="">    
</div></td>
<td style="min-width:100px; max-width:100px;" ><div><span class="form-text "> </span><input type="text" id="PotentialLineCard${parentid}${key}RFQNo" name="Shipment[${parentid}${key}][RFQNo]" class="form-control" autocomplete="off"  value="">    
</div></td>
<td style="min-width:100px; max-width:100px;" ><div><span class="form-text "></span><input type="text" id="PotentialLineCard${parentid}${key}Incorterm" name="Shipment[${parentid}${key}][Incorterm]" class="form-control" autocomplete="off"  value="">    
</div></td>
<td style="min-width:100px; max-width:100px;" ><div><span class="form-text "></span><input type="text" id="PotentialLineCard${parentid}${key}Quantity" name="Shipment[${parentid}${key}][Quantity]" class="form-control" autocomplete="off"  value="">    
</div></td>
<td style="min-width:100px; max-width:100px;" ><div><span class="form-text "></span><input type="text" id="PotentialLineCard${parentid}${key}MOQ" name="Shipment[${parentid}${key}][MOQ]" class="form-control" autocomplete="off"  value="">    
</div></td>
<td style="min-width:100px; max-width:100px;" ><div><span class="form-text "></span><input type="text" id="PotentialLineCard${parentid}${key}Sellingprice" name="Shipment[${parentid}${key}][Sellingprice]" class="form-control" autocomplete="off"  value="">    
</div></td>
<td style="min-width:100px; max-width:100px;" ><div><span class="form-text "></span><input type="text" id="PotentialLineCard${parentid}${key}Targetprice" name="Shipment[${parentid}${key}][Targetprice]" class="form-control" autocomplete="off"  value="">    
</div></td>
<td style="min-width:100px; max-width:100px;" ><div><span class="form-text "></span><input type="text" id="PotentialLineCard${parentid}${key}Version" name="Shipment[${parentid}${key}][Version]" class="form-control" autocomplete="off"  value="">    
</div></td>
<td style="min-width:100px; max-width:100px;" ><div><span class="form-text "></span><input type="text" id="PotentialLineCard${parentid}${key}SupLeadTime" name="Shipment[${parentid}${key}][SupLeadTime]" class="form-control" autocomplete="off"  value="">    
</div><input class="" type="hidden"  name="Shipment[${parentid}${key}][parent]"  value="${parentid}" /></td>      
</tr>`;
*/
//$('#itemList table tbody tr.tr-last').before(string);
//$('#Shipmentsm'+key).after(string);

setTimeout(function(){
autoComplete();

//$('.select-autoComplete-staff').chosen('destroy');
// $('.select-autoComplete-linecardsup').chosen('destroy');

}, 900);

})


}).on('click', '#remove-sub-part', function() {

    var id=$(this).data('id');
//alert(id);
var tr =  $(this).parent().parent().parent().parent();

$.alerts.confirm('Will you delete this item?<br/><b>' + tr.find('.PartNumber').text() + '</b>', 'Confirm delete', function (r) {
    if (r == true) {
        tr.remove();

if (!!id) {
    $.ajax({
        url: site_url + 'projects_customer/ajax_delete_shipmentpotential_line_card',
        method: "POST",
        data: {id: id},
        dateType: "json",
        cache: false
    });
    
}
}})
}).on('click', '#addlinecard', function(){

var key= $('.linecardrow').length + 1;

var string =    '<div class="row linecardrow"><div class="col-sm-6">'+


'<div class="form-group">'+
            '<div class="col-sm-2 control-label">Line Card ID</div>'+
            '<div class="col-sm-10">'+
             ' <div class="input-group">'+
             '<select style=" height: 20px; " id="SupplierID' + key + '" name="LineCard[' + key + '][SupplierID]" class="form-control"   data-required="0" >' + suppliers_options + '</select>'+
             '</div>'+
           '</div>'+
        '</div>'+
       '</div>'+
'<div class="col-sm-6">'+
'<div class="form-group">'+
    '<div class="col-sm-3 control-label">Manufacturer Line</div>'+
    '<div class="col-sm-9">'+
    
    '<select style=" height: 20px; " id="ManufacturerLine' + key + '" name="LineCard[' + key + '][Manufacturer][]"  class="form-control"  multiple  data-required="0" >' + manufac_options + '</select>'+

    '</div>'+
    '</div>'+
    '</div>'+

'</div>';
$('#Linecard').before(string);
$('#SupplierID' + key ).chosen();
$('#ManufacturerLine' + key ).chosen();

})


function add_potentiallinecard(key) {
var numb = 1;
var today = new Date();
var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
var time = today.getHours() + ":" + today.getMinutes();
var dateTime = date+' '+time;
if ($('.PotentialLineCard').length) {
    key = parseInt($('.PotentialLineCard:last .key').val()) + 1;
    numb = parseInt($('.PotentialLineCard:last .numb').text()) + 1;
}
var paridnum=pardid+  key;
//var maketing= $('#maketing').val();

var string = '<tr class="PotentialLineCard editing" id="PotentialLineCard' + key + '">' +

'<td nowrap="nowrap">' +
'<input type="hidden" class="key" value="' + key + '"/>' + 
'<input type="hidden" name="PotentialLineCard[' + key + '][id]" value=""/>' +
'<i  id="editchangeid"  class=" disabled edit-samples fa fa-pencil-square-o" aria-hidden="true" data-dismiss="modal" data-key=0 style=" position: relative;  font-size: 14px;color:red; "></i>&nbsp;'+

'<i  id="editchangeid" class="remove-samples fa fa-trash-o" aria-hidden="true" style=" position: relative;  font-size: 14px;color:red; "></i><input class="rowid" type="hidden" name="" value="'+key+'" />'+
'</td>' +

'<td nowrap="nowrap" style="min-width:20px; max-width:20px;">' +
'<span class="numb">' + numb + '</span>' +
'</td>' +
'<td style="min-width:40px; max-width: 40px;" class="center"><a href="javascript:;" name="PotentialLineCard['+key+'][list]" class="btn btn-default btn-list-old"><i class="glyph-icon icon-list-alt"></i></a></a></td>' +
'<td style="min-width:60px; max-width:60px;"><div class="ps-relative"><input type="text" style="pointer-events: none;"  class="form-control text-center shipped-qty no-border"  id="PotentialLineCard'+key+'PartID" name="PotentialLineCard['+key+'][PartID]" value="'+paridnum+'">'+
' <div class="errordiv PotentialLineCard'+key+'PartID">'+
       '<div class="arrow"></div> Not Empty!  </div>'+
'</div></td>'+
'<td><div class="ps-relative"><span class="form-text Projectno"></span><input type="text" id="PotentialLineCard' + key + 'Projectno" name="PotentialLineCard[' + key + '][Projectno]" autocomplete="off"  class="form-control mfr-part" data-required="1"><div class="errordiv PotentialLineCard' + key + 'Projectno"><div class="arrow"></div>Not Empty!</div></div></td>' +
'<td><select style=" height: 20px; " id="PotentialLineCard' + key + 'ProjectStatus" name="PotentialLineCard[' + key + '][ProjectStatus]" class="select-status  mycate ProjectStatussel">  </select></td>'+
'<td><select style=" height: 20px; " multiple id="PotentialLineCard' + key + 'FAE" name="PotentialLineCard[' + key + '][FAE][]" class="select-status  mycate FAEsel">  </select></td>'+
'<td><select style=" height: 20px; " id="PotentialLineCard' + key + 'Owner" name="PotentialLineCard[' + key + '][Owner]" class="select-status  mycate Ownersel">  </select></td>'+
'<td><select style=" height: 20px; " multiple id="PotentialLineCard' + key + 'Marketing" name="PotentialLineCard[' + key + '][Marketing][]" class="select-status  mycate Marketingsel">  </select></td>'+

'<td> <select style=" height: 20px; " id="SupplierID' + key + '" name="PotentialLineCard[' + key + '][SupplierID]" class="form-control find-staff select-autoComplete-linecardsup" style="width: 100%"></select></td>'+

'<td style="min-width:200px; max-width: 200px;"><div class="ps-relative"><select id="PotentialLineCard' + key + 'category" class="select2 field-update editing" name="PotentialLineCard[' + key + '][category]"  data-required="0" ><option value="">Chọn ...</option>' +tmphtml+'</select><div class="errordiv PotentialLineCard' + key + 'category"><div class="arrow"></div>Not Empty!</div></div></td>' +

'<td><div class="ps-relative"><span class="form-text PartNumber"></span><input type="text" id="PotentialLineCard' + key + 'PartNumber" name="PotentialLineCard[' + key + '][manufacturer_part_number]" autocomplete="off"  class="form-control mfr-part" data-required="1"><div class="errordiv PotentialLineCard' + key + 'PartNumber"><div class="arrow"></div>Not Empty!</div></div></td>' +
'<td style="min-width:200px; max-width: 200px;"><div class="ps-relative"><span class="form-text"></span><input type="text" id="PotentialLineCard' + key + 'Description" name="PotentialLineCard[' + key + '][Description]" autocomplete="off" class="form-control"   data-required="0" ><div class="errordiv PotentialLineCard' + key + 'Description"><div class="arrow"></div>Not Empty!</div></div></td>' +
// '<td><span class="form-text"></span><input type="text" name="PotentialLineCard[' + key + '][Manufacturer]" class="form-control"/></td>' +
'<td style="min-width:150px; max-width: 150px;">' +
'    <div class="ps-relative"><span class="form-text"></span><input type="text" id="PotentialLineCard' + key + 'Manufacturer" name="PotentialLineCard[' + key + '][Manufacturer]" class="form-control" autocomplete="off"    data-required="0" ><div class="errordiv PotentialLineCard' + key + 'Manufacturer"><div class="arrow"></div>Not Empty!</div></div>' +

'</td>' +
'<td style="min-width:140px; max-width: 140px;display: none;"><span class="form-text"></span><input type="text" name="PotentialLineCard[' + key + '][PackageCase]" id="PotentialLineCard' + key + 'PackageCase" class="form-control"   data-required="0" autocomplete="off" style="text-align: left;"/><div class="errordiv PotentialLineCard' + key + 'PackageCase"><div class="arrow"></div>Not Empty!</div></td>' +
 '<td style="min-width:140px; max-width: 140px;display: none;"><span class="form-text"></span><input type="text" name="PotentialLineCard[' + key + '][Packaging	]"  id="PotentialLineCard' + key + 'Packaging" class="form-control"   data-required="0" autocomplete="off" style="text-align: left;"/><div class="errordiv PotentialLineCard' + key + 'Packaging"><div class="arrow"></div>Not Empty!</div></td>' +

'<td style="min-width: 86px; max-width:86px;"><span class="form-text"></span><input type="text" style=" text-align: right;" name="PotentialLineCard[' + key + '][AnnualQty]" class="form-control eau-qty" autocomplete="off" style="text-align: left;"/></td>' +
'<td style="min-width: 86px; max-width:86px;"><div class="ps-relative"><span class="form-text"></span><input type="text" style=" text-align: right;" id="PotentialLineCard' + key + 'UnitPrice" name="PotentialLineCard[' + key +'][UnitPrice]" autocomplete="off"  class="form-control unit-price"><div class="errordiv PotentialLineCard' + key + 'UnitPrice"><div class="arrow"></div>Not Empty!</div></div></td>' +
'<td style="min-width: 100px; max-width:100px;"><div class="ps-relative"><span class="form-text"></span><div class="input-group"><input type="text" style=" text-align: right;" name="PotentialLineCard['+key+'][probability]" id="PotentialLineCard'+key+'probability" class="form-control approved-date-inp" value=""><div class="input-group-btn"><button type="button" class="btn btn-default empty-supplier">%</button></div></div></td>'+      
'<td style="min-width: 100px; max-width:100px;"><div class="ps-relative"><span class="form-text"></span><div class="input-group"><input type="text" style=" text-align: right;" name="PotentialLineCard['+key+'][AmountEAU]" id="PotentialLineCard'+key+'AmountEAU" class="form-control approved-date-inp eau-amount" value=""><div class="input-group-btn"><button type="button" class="btn btn-default empty-supplier">$</button></div></div></td>'+      
'<td style="min-width: 100px; max-width:100px;"><div class="ps-relative"><span class="form-text"></span><select id="PotentialLineCard' + key + 'RegistrationStage" name="PotentialLineCard[' + key +'][RegistrationStage]" autocomplete="off"    data-required="0"  class="select-status mycate StageStatussel'+key+' StageStatussel"></select><div class="errordiv PotentialLineCard' + key + 'RegistrationStage"><div class="arrow"></div>Not Empty!</div></div></td>'+      
'<td style="min-width: 110px; max-width:110px;"><div class="ps-relative"><span class="form-text"></span><input type="text" style="width: 104px;pointer-events: none;background: none;border: none;"  name="PotentialLineCard['+key+'][StageDate]" id="PotentialLineCard'+key+'StageDate" class="form-control approved-date-inp" value=""></div></td>'+      
'<td><div class="ps-relative"><span class="form-text"></span><input type="text" style="width: 104px;pointer-events: none;background: none;border: none;"  name="PotentialLineCard['+key+'][ResultDate]" id="PotentialLineCard'+key+'RegistrationDate" class="form-control approved-date-inp" value="'+dateTime+'"></div></td>'+      
'<td><input type="text" style="width: 110px;pointer-events: none;background: none;border: none;"  name="PotentialLineCard['+key+'][RegistrationDate]" id="PotentialLineCard'+key+'ResultDate" class="form-control approved-date-inp" value=""></td>'+      
'<td><select style=" height: 20px; " id="PotentialLineCard' + key + 'RegistrationStatus" name="PotentialLineCard[' + key + '][RegistrationStatus]" class="select-status  mycate RegistrationStatussel">' + rpstatus_options + ' </select><input type="hidden" name="" id="" class="form-control keymum" value="'+key+'"> </td>';




    if ($('.PotentialLineCard').length) {
        $('#itemList table tbody tr.tr-last').before(string);
    } else {
        $('#itemList table tbody tr.tr-last').before(string);
}
$('#PotentialLineCard' + key + 'category').chosen();
var no=$('#code1').val();

$('#PotentialLineCard' + key + 'Projectno').val(no);
var FaeStaff= ($('#FaeStaff').html());

$( '#PotentialLineCard'+key+'ProjectStatus' ).html($('#RegistrationStatus').html() ).trigger( 'chosen:updated' );
$( '#PotentialLineCard'+key+'FAE' ).html(FaeStaff ).trigger( 'chosen:updated' );
$( '#PotentialLineCard'+key+'Owner' ).html($('#AccountOwner').html() ).trigger( 'chosen:updated' );
$( '#PotentialLineCard'+key+'Marketing' ).html($('#maketing').html() ).trigger( 'chosen:updated' );
$('#PotentialLineCard' + key + 'FAE').chosen();
$('#PotentialLineCard' + key + 'ProjectStatus').chosen();
$('#PotentialLineCard' + key + 'Marketing').chosen();
$('#PotentialLineCard' + key + 'Owner').chosen();

setTimeout(function(){
    autoComplete();

    //$('.select-autoComplete-staff').chosen('destroy');
   // $('.select-autoComplete-linecardsup').chosen('destroy');

}, 900);

$.ajax( {
    url: site_url + $( '#act' ).val() + '/get_Stage',
    type: 'POST',
    cache: false,
    data: {
        //department: val,
    },
    success: function ( string ) {
        var getData = $.parseJSON( string );
        console.log( getData );
        $( '.StageStatussel'+key+'' ).empty();
        $StageOptions = '<option value="">Select...</option>';
        if ( Array.isArray( getData ) && getData.length ) {
            for ( var i = 0; i < getData.length; i++ ) {
                $StageOptions += '<option  data-color ="' + getData[ i ][ 'color' ] +  '"  style="BACKGROUND:' + getData[ i ][ 'color' ] +  '"  value="' + getData[ i ][ 'id' ] + '">' + getData[ i ][ 'name_vn' ] + '</option>';
            }
        }       
            $(
$.ajax( {
    url: site_url + $( '#act' ).val() + '/get_Stage',
    type: 'POST',
    cache: false,
    data: {
        //department: val,
    },
    success: function ( string ) {
        var getData = $.parseJSON( string );
        console.log( getData );
        $( '.StageStatussel'+key+'' ).empty();
        $StageOptions = '<option value="">Select...</option>';
        if ( Array.isArray( getData ) && getData.length ) {
            for ( var i = 0; i < getData.length; i++ ) {
                $StageOptions += '<option  data-color ="' + getData[ i ][ 'color' ] +  '"  style="BACKGROUND:' + getData[ i ][ 'color' ] +  '"  value="' + getData[ i ][ 'id' ] + '">' + getData[ i ][ 'name_vn' ] + '</option>';
            }
        }       
            $( '.StageStatussel'+key+'' ).html($StageOptions ).trigger( 'chosen:updated' );
    
    }
} )).html($StageOptions ).trigger( 'chosen:updated' );
    
    }
} )
$('.bootstrap-datepicker').datepicker({
    format: 'yyyy-mm-dd',
    language: 'vi',
    autoclose: true,
    todayHighlight: true
});
$('#PotentialLineCard' + key + 'RegistrationStatus').chosen();
$('#PotentialLineCard' + key + 'category').chosen();
$('#PotentialLineCard' + key + ' .money').autoNumeric('init', {
    'mDec': 0
});

}
