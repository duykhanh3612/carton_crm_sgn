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
                        $('[name="PotentialLineCard[' + key + '][SPQ]"]').val($(this).find('td.spq').text());
                        $('[name="PotentialLineCard[' + key + '][UnitPrice]"]').val($(this).find('td.unit-price').text());
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
        var today = new Date();
        var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
        var time = today.getHours() + ":" + today.getMinutes();
        var dateTime = date+' '+time;
        var key =0;
        if ($('.PotentialLineCard').length) {
            key = parseInt($('.PotentialLineCard:last .key').val()) + 1;
            numb = parseInt($('.PotentialLineCard:last .numb').text()) + 1;
        }
        var paridnum=pardid+  key;
       // alert($('#maketing').val());
       var maketing= $('#maketing').val();
       var createdby= $('#createdby').val();
       var fae= $('#fae').val();
       var follower= $('#follower').val();
       var approveuser= maketing+','+createdby+','+fae+','+follower;
       //var maketing= $('#maketing').val();
       $.ajax( {
        url: site_url + $( '#act' ).val() + '/get_approveuser',
        type: 'POST',
        cache: false,
        data: {
            listuser: approveuser,
        },
        success: function ( string ) {
            var getData = $.parseJSON( string );
            $ProjOptions = '<option value="">Select.....</option>';
            if ( Array.isArray( getData ) && getData.length ) {
                for ( var i = 0; i < getData.length; i++ ) {
                    $ProjOptions += '<option value="' + getData[ i ][ 'id' ] + '">' + getData[ i ][ 'name_vn' ] + '</option>';
                }
            }
    
        
                $( '.Registrationapproved' ).html( $ProjOptions ).trigger( 'chosen:updated' );
        }
    } )
        var html = '<tr class="PotentialLineCard editing" id="PotentialLineCard' + key + '">' +
            '<td nowrap="nowrap">' +
            '<input type="hidden" class="key" value="' + key + '"/>' + 
            '<input type="checkbox" class="cb-el custom-checkbox" name="element[]" data-key="'+key+'"  id="sel_item' + key + '" value="0">'+

            '<input type="hidden" name="PotentialLineCard[' + key + '][id]" value=""/>' +
            '</td>' +
            '<td nowrap="nowrap">' +
            '<span class="numb">' + numb + '</span>' +
            '</td>' +
            '<td style="min-width:50px; max-width: 50px;" class="center"><a class="btn btn-default" style="min-width: 50px;" href="#!" role="button" ><i class="glyph-icon fa fa-refresh"></i ></a></td>' +
            '<td><div class="ps-relative"><span class="form-text Projectno"></span><input type="text" id="PotentialLineCard' + key + 'Projectno" name="PotentialLineCard[' + key + '][Projectno]" autocomplete="off"  class="form-control mfr-part" data-required="1"><div class="errordiv PotentialLineCard' + key + 'Projectno"><div class="arrow"></div>Not Empty!</div></div></td>' +
            '<td><select style=" height: 20px; " id="PotentialLineCard' + key + 'ProjectStatus" name="PotentialLineCard[' + key + '][ProjectStatus]" class="select-status  mycate ProjectStatussel">  </select></td>'+
            '<td><select style=" height: 20px; " multiple id="PotentialLineCard' + key + 'FAE" name="PotentialLineCard[' + key + '][FAE][]" class="select-status  mycate FAEsel">  </select></td>'+
            '<td><select style=" height: 20px; " id="PotentialLineCard' + key + 'Owner" name="PotentialLineCard[' + key + '][Owner]" class="select-status  mycate Ownersel">  </select></td>'+
            '<td><select style=" height: 20px; " multiple id="PotentialLineCard' + key + 'Marketing" name="PotentialLineCard[' + key + '][Marketing][]" class="select-status  mycate Marketingsel">  </select></td>'+
            
           
            '<td><div class="ps-relative"><select id="PotentialLineCard' + key + 'category" class="select2 field-update editing" name="PotentialLineCard[' + key + '][category]" data-required="1" ><option value="">Chọn ...</option>' +tmphtml+'</select><div class="errordiv PotentialLineCard' + key + 'category"><div class="arrow"></div>Not Empty!</div></div></td>' +
    
            '<td><div class="ps-relative"><span class="form-text SupplierPart"></span><input type="text" id="PotentialLineCard' + key + 'SupplierPart" name="PotentialLineCard[' + key + '][SupplierPart]" autocomplete="off"  class="form-control" data-required="1"><div class="errordiv PotentialLineCard' + key + 'SupplierPart"><div class="arrow"></div>Not Empty!</div></div></td>' +
            '<td><div class="ps-relative"><span class="form-text PartNumber"></span><input type="text" id="PotentialLineCard' + key + 'PartNumber" name="PotentialLineCard[' + key + '][manufacturer_part_number]" autocomplete="off"  class="form-control" data-required="1"><div class="errordiv PotentialLineCard' + key + 'PartNumber"><div class="arrow"></div>Not Empty!</div></div></td>' +
            '<td style="min-width:200px; max-width: 200px;"><div class="ps-relative"><span class="form-text"></span><input type="text" id="PotentialLineCard' + key + 'Description" name="PotentialLineCard[' + key + '][Description]" autocomplete="off" class="form-control"  data-required="1" ><div class="errordiv PotentialLineCard' + key + 'Description"><div class="arrow"></div>Not Empty!</div></div></td>' +
            // '<td><span class="form-text"></span><input type="text" name="PotentialLineCard[' + key + '][Manufacturer]" class="form-control"/></td>' +
            '<td style="min-width:100px; max-width: 100px;">' +
            '    <div class="ps-relative"><span class="form-text"></span><input type="text" id="PotentialLineCard' + key + 'Manufacturer" name="PotentialLineCard[' + key + '][Manufacturer]" class="form-control" autocomplete="off"   data-required="1" ><div class="errordiv PotentialLineCard' + key + 'Manufacturer"><div class="arrow"></div>Not Empty!</div></div>' +
           
            '</td>' +
            '<td><span class="form-text"></span><input type="text" name="PotentialLineCard[' + key + '][PackageCase]" id="PotentialLineCard' + key + 'PackageCase" class="form-control"  data-required="1" autocomplete="off" style="text-align: left;"/><div class="errordiv PotentialLineCard' + key + 'PackageCase"><div class="arrow"></div>Not Empty!</div></td>' +
             '<td><span class="form-text"></span><input type="text" name="PotentialLineCard[' + key + '][Packaging	]"  id="PotentialLineCard' + key + 'Packaging" class="form-control"  data-required="1" autocomplete="off" style="text-align: left;"/><div class="errordiv PotentialLineCard' + key + 'Packaging"><div class="arrow"></div>Not Empty!</div></td>' +
    
            '<td><span class="form-text"></span><input type="text" name="PotentialLineCard[' + key + '][SPQ]" class="form-control money" autocomplete="off" style="text-align: left;"/></td>' +
            '<td><div class="ps-relative"><span class="form-text"></span><input type="text" id="PotentialLineCard' + key + 'UnitPrice" name="PotentialLineCard[' + key +'][UnitPrice]" autocomplete="off"  class="form-control eau-qty"><div class="errordiv PotentialLineCard' + key + 'UnitPrice"><div class="arrow"></div>Not Empty!</div></div></td>' +
            '<td><div class="ps-relative"><span class="form-text"></span><select id="PotentialLineCard' + key + 'RegistrationStage" name="PotentialLineCard[' + key +'][RegistrationStage]" autocomplete="off"   data-required="1"  class="select-status select-approve-pi">' + rpStage_options + '</select><div class="errordiv PotentialLineCard' + key + 'RegistrationStage"><div class="arrow"></div>Not Empty!</div></div></td>'+      
            '<tr class="highlightNoClick myDragClass Shipment sm Shipment' + key + '" id="" value="">'+
    
            '<td class="bgcolor col-no center" colspan="19">'+
            '<div style="display: flex">'+
                    '<div style="width: 60px;">'+
                       '<div class="header-shipmment"> <span> Part ID </span> </div>'+
                            '<div class="ps-relative"><input type="text" style="pointer-events: none;"  class="bgshipmentinput form-control text-center shipped-qty no-border"  id="PotentialLineCard'+key+'PartID" name="PotentialLineCard['+key+'][PartID]" value="'+paridnum+'">'+
                             ' <div class="errordiv PotentialLineCard'+key+'PartID">'+
                                    '<div class="arrow"></div> Not Empty!  </div>'+
                            '</div>'+
                            
                   '</div>'+
                    '<div class="td-2" style="width: 220px;" >'+
                        '<div style="display: flex;align-items: center;justify-content: center;" class="header-shipmment "> Line Card ID <span style="color:red">*</span>  </div>'+
                          '<div style="height: 20px !important;" class="body-import">'+
                        '        <select style=" height: 20px; " id="SupplierID' + key + '" name="PotentialLineCard[' + key + '][SupplierID]" class="form-control"  data-required="1" >' + suppliers_options + '</select>' +
    
                        '</div>'+
                        '<div class="errordiv SupplierID' + key + '"> Not Empty!</div> </div>'+
            '<div class="td-2" style="width:150px;">'+
            
            '<div style="display: flex;align-items: center;justify-content: center;" class="header-shipmment "> Approver <span style="color:red">*</span> </div>'+
            '<div style="height: 20px !important;" class="body-import">'+
             '<select id="PotentialLineCard' + key + 'Registrationapproved" class="select2 field-update editing Registrationapproved" name="PotentialLineCard[' + key + '][Registrationapproved]" data-required="1" ></select><div class="errordiv PotentialLineCard' + key + 'Registrationapproved"><div class="arrow"></div>Not Empty!</div></div>'+
    
            '</div>'+
            
            '<div class="td-2" style="width: 150px;">'+
            '<div class="header-shipmment " >'+
             '<span>	Registration Date</span></div>'+
            '<div>'+
             '<input type="text" name="PotentialLineCard['+key+'][RegistrationDate]" id="PotentialLineCard'+key+'RegistrationDate" class="form-control approved-date-inp" value="'+dateTime+'"><div class="errordiv PotentialLineCard' + key + 'RegistrationDate"><div class="arrow"></div>Not Empty!</div></div>'+        
            '</div>'+
            '<div class="td-2" style="width: 150px;">'+
            '<div class="header-shipmment " ><span>Real Time</span>'+
            '</div>'+
    
            '<div style="height: 20px !important;" class="body-import">'+
            '<input type="text" class="form-control approved-date-inp"  value="" disabled>'+        
           '</div>'+
            '</div>'+
            '<div class="td-2" style="width: 150px;">'+
            '<div class="header-shipmment " > <span>	Result Date</span>'+
            '</div>'+
    
            '<div style="height: 20px !important;" class="body-import">'+
            '<input type="text" name="PotentialLineCard['+key+'][ResultDate]" id="PotentialLineCard'+key+'ResultDate" class="form-control approved-date-inp" value="">'+
            '</div>'+
            '</div>'+
            '<div class="td-2" style="width: 130px;">'+
            '<div class="header-shipmment " > <span>Registration Status</span></div>'+
            '<divstyle="height: 20px !important;" class="body-import">'+
            '<select style=" height: 20px; " id="PotentialLineCard' + key + 'RegistrationStatus" name="PotentialLineCard[' + key + '][RegistrationStatus]" class="select-status approved-date-inp disabled">' + rpstatus_options + '</select>'+
                       '<input type="hidden" name="" id="" class="form-control keymum" value="'+key+'">'+
            '</div>'
            '</div>'
            
           '</div>'
            '</td>'
               '</tr>';
                $('#itemList table tbody tr.tr-last').before(html);
                var no=$('#ProjectName').val();
                $('#PotentialLineCard' + key + 'Projectno').val(no);
                var FaeStaff= ($('#cpFaeStaff').html());
                //console.log(FaeStaff);
                $( '#PotentialLineCard'+key+'ProjectStatus' ).html($('#cpRegistrationStatus').html() ).trigger( 'chosen:updated' );
                $( '#PotentialLineCard'+key+'FAE').html(FaeStaff ).trigger( 'chosen:updated' );
                $( '#PotentialLineCard'+key+'Owner').html($('#AccountOwner').html() ).trigger( 'chosen:updated' );
                $( '#PotentialLineCard'+key+'Marketing' ).html($('#cpaketing').html() ).trigger( 'chosen:updated' );
                $('#PotentialLineCard' + key + 'FAE').chosen();
                $('#PotentialLineCard' + key + 'ProjectStatus').chosen();
                $('#PotentialLineCard' + key + 'Marketing').chosen();
                $('#PotentialLineCard' + key + 'Owner').chosen();
        $('#PotentialLineCard' + key + 'category').chosen();
        $('#PotentialLineCard' + key + ' .date').datepicker({
            format: 'yyyy-mm-dd',
            language: 'vi',
            autoclose: true,
            todayHighlight: true
        });


        $('#PotentialLineCard' + key + ' .money').autoNumeric('init', {
            'mDec': 0
        });
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
            '<td><span class="form-text"></span><input type="text" name="SpecialPriceRequests[' + key + '][Probability]" class="form-control"/></td>' +
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
     //   alert(id);
        var tr = $(this).parent().parent();
        $.alerts.confirm('Will you delete this item?<br/><b>' + tr.find('.PartNumber').text() + '</b>', 'Confirm delete', function (r) {
            if (r == true) {
                tr.remove();
                if (!!id) {
                    $.ajax({
                        url: site_url + 'project_registration/ajax_delete_potential_line_card',
                        method: "POST",
                        data: {id: id},
                        dateType: "json",
                        cache: false
                    });
                }
            }
        });
    })
    .on('click', '.submitCP', function () {
        var id = $(this).closest('tr').find('.rowid').val();
        var ProjectID= $('#ProjectID').val();
        var updates = parseInt($(this).data('update'));
        var tr = $(this).parent().parent();

        var key =  $(this).closest('tr').find('.key').val(); 
                
        $.alerts.confirm('Will you coppy this item to Customer Project?<br/><b>' + tr.find('.PartNumber').text() + '</b>', 'Confirm delete', function (r) {
            if (r == true) {
               // tr.remove();
             //  $('.submit').val(1);
               submitCP(key);

                if (!!id) {
                    $.ajax({
                        url: site_url + 'project_registration/submitCP',
                        method: "POST",
                        data: {id: id, ProjectID:ProjectID},
                        dateType: "json",
                        cache: false
                    });
                }
              
            }
            //location.reload();
            //alert( $('.submit').val());
         //   if($('.submit').val() == 1 ){
              
    
            //   }

        });
        /*alert( $('.submit').val());
        $(this).removeClass('btn-default').addClass('btn-success');
        $(this).addClass('disabled');*/
     
           // }
            
       // })
       // $(this).removeClass('btn-default').addClass('btn-success');

    }).on('click', '.edit-samples, .edit-potentiallinecard, .edit-specialpricerequests', function () {
        var tr = $(this).closest('tr');
        $(this).parent().parent().addClass('editing');
        tr.find('.mycate').chosen();
        tr.find('.mycate').removeClass('disabled');
        tr.find('.mycate').hide();
    }).on('change', '.unit-price, .eau-qty', function () {
        var parent = $(this).closest('tr');
        var price = parseFloat(parent.find('.unit-price').val().replace(/\s/g, '').replace(/,/g, ''));
        var qty = parseFloat(parent.find('.eau-qty').val().replace(/\s/g, '').replace(/,/g, ''));
        parent.find('.unit-price').val(accounting.formatMoney(price, '', 4));
        parent.find('.eau-qty').val(accounting.formatMoney(qty, '', 0));
        parent.find('.eau-amount').val(accounting.formatMoney(price * qty, '', 2));
    })

    $('.money-usd').autoNumeric('init', {
        'mDec': 2,
        'aSign': '$'
    });
    var setup_number = function () {
        $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            //showNoti('Only enter a number', 'Price List', 'Err');
            event.preventDefault();
        }
    }
    $('.input-number').on("keypress keyup blur", setup_number);
});
function submitCP(key) {
    $('#submit'+key+'').removeClass('btn-default').addClass('btn-success');
    $('#submit'+key+'').addClass('disabled');
}
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
    //alert($('#fae').val());
   var maketing= $('#maketing').val();
   var createdby= $('#createdby').val();
   var fae= $('#fae').val();
   var follower= $('#follower').val();
   var approveuser= maketing+','+createdby+','+fae+','+follower;
   //var maketing= $('#maketing').val();
   $.ajax( {
    url: site_url + $( '#act' ).val() + '/get_approveuser',
    type: 'POST',
    cache: false,
    data: {
        listuser: approveuser,
    },
    success: function ( string ) {
        var getData = $.parseJSON( string );
        $ProjOptions = '<option value="">Select.....</option>';
        if ( Array.isArray( getData ) && getData.length ) {
            for ( var i = 0; i < getData.length; i++ ) {
                $ProjOptions += '<option value="' + getData[ i ][ 'id' ] + '">' + getData[ i ][ 'name_vn' ] + '</option>';
            }
        }

    
            $( '.Registrationapproved' ).html( $ProjOptions ).trigger( 'chosen:updated' );
    }
} )
    var string = '<tr data-id = '+key+' class="PotentialLineCard editing" id="PotentialLineCard' + key + '">' +
        '<td nowrap="nowrap">' +
        '<input type="hidden" class="key" value="' + key + '"/>' + 
        '<input type="hidden" name="PotentialLineCard[' + key + '][id]" value=""/>' +
        '<input type="checkbox" class="cb-element custom-checkbox" name="element[]" data-key="'+key+'"  id="sel_item' + key + '" value="0">'+

        '</td>' +
        
        '<td nowrap="nowrap">' +
        '<span class="numb">' + numb + '</span>' +
        '</td>' +
        '<td style="min-width:50px; max-width: 50px;" class="center"><a class="btn btn-default" style="min-width: 50px;" href="#!" role="button" ><i class="glyph-icon fa fa-refresh"></i ></a></td>' +

        '<td><div class="ps-relative"><span class="form-text Projectno"></span><input type="text" id="PotentialLineCard' + key + 'Projectno" name="PotentialLineCard[' + key + '][Projectno]" autocomplete="off"  class="form-control mfr-part" data-required="1"><div class="errordiv PotentialLineCard' + key + 'Projectno"><div class="arrow"></div>Not Empty!</div></div></td>' +
            '<td><select style=" height: 20px; " id="PotentialLineCard' + key + 'ProjectStatus" name="PotentialLineCard[' + key + '][ProjectStatus]" class="select-status  mycate ProjectStatussel">  </select></td>'+
            '<td><select style=" height: 20px; " multiple id="PotentialLineCard' + key + 'FAE" name="PotentialLineCard[' + key + '][FAE][]" class="select-status  mycate FAEsel">  </select></td>'+
            '<td><select style=" height: 20px; " id="PotentialLineCard' + key + 'Owner" name="PotentialLineCard[' + key + '][Owner]" class="select-status  mycate Ownersel">  </select></td>'+
            '<td><select style=" height: 20px; " multiple id="PotentialLineCard' + key + 'Marketing" name="PotentialLineCard[' + key + '][Marketing][]" class="select-status  mycate Marketingsel">  </select></td>'+
      
        '<td><div class="ps-relative"><select id="PotentialLineCard' + key + 'category" class="select2 field-update editing" name="PotentialLineCard[' + key + '][category]" data-required="1" ><option value="">Chọn ...</option>' +tmphtml+'</select><div class="errordiv PotentialLineCard' + key + 'category"><div class="arrow"></div>Not Empty!</div></div></td>' +

        '<td><div class="ps-relative"><span class="form-text SupplierPart"></span><input type="text" id="PotentialLineCard' + key + 'SupplierPart" name="PotentialLineCard[' + key + '][SupplierPart]" autocomplete="off"  class="form-control" data-required="1"><div class="errordiv PotentialLineCard' + key + 'SupplierPart"><div class="arrow"></div>Not Empty!</div></div></td>' +
        '<td><div class="ps-relative"><span class="form-text PartNumber"></span><input type="text" id="PotentialLineCard' + key + 'PartNumber" name="PotentialLineCard[' + key + '][manufacturer_part_number]" autocomplete="off"  class="form-control" data-required="1"><div class="errordiv PotentialLineCard' + key + 'PartNumber"><div class="arrow"></div>Not Empty!</div></div></td>' +
        '<td style="min-width:200px; max-width: 200px;"><div class="ps-relative"><span class="form-text"></span><input type="text" id="PotentialLineCard' + key + 'Description" name="PotentialLineCard[' + key + '][Description]" autocomplete="off" class="form-control"  data-required="1" ><div class="errordiv PotentialLineCard' + key + 'Description"><div class="arrow"></div>Not Empty!</div></div></td>' +
        // '<td><span class="form-text"></span><input type="text" name="PotentialLineCard[' + key + '][Manufacturer]" class="form-control"/></td>' +
        '<td style="min-width:100px; max-width: 100px;">' +
        '    <div class="ps-relative"><span class="form-text"></span><input type="text" id="PotentialLineCard' + key + 'Manufacturer" name="PotentialLineCard[' + key + '][Manufacturer]" class="form-control" autocomplete="off"   data-required="1" ><div class="errordiv PotentialLineCard' + key + 'Manufacturer"><div class="arrow"></div>Not Empty!</div></div>' +
       
        '</td>' +
        '<td><span class="form-text"></span><input type="text" name="PotentialLineCard[' + key + '][PackageCase]" id="PotentialLineCard' + key + 'PackageCase" class="form-control"  data-required="1" autocomplete="off" style="text-align: left;"/><div class="errordiv PotentialLineCard' + key + 'PackageCase"><div class="arrow"></div>Not Empty!</div></td>' +
         '<td><span class="form-text"></span><input type="text" name="PotentialLineCard[' + key + '][Packaging	]"  id="PotentialLineCard' + key + 'Packaging" class="form-control"  data-required="1" autocomplete="off" style="text-align: left;"/><div class="errordiv PotentialLineCard' + key + 'Packaging"><div class="arrow"></div>Not Empty!</div></td>' +

        '<td><span class="form-text"></span><input type="text" name="PotentialLineCard[' + key + '][SPQ]" class="form-control money" autocomplete="off" style="text-align: left;"/></td>' +
        '<td><div class="ps-relative"><span class="form-text"></span><input type="text" id="PotentialLineCard' + key + 'UnitPrice" name="PotentialLineCard[' + key +'][UnitPrice]" autocomplete="off"  class="form-control eau-qty"><div class="errordiv PotentialLineCard' + key + 'UnitPrice"><div class="arrow"></div>Not Empty!</div></div></td>' +
        '<td><div class="ps-relative"><span class="form-text"></span><select id="PotentialLineCard' + key + 'RegistrationStage" name="PotentialLineCard[' + key +'][RegistrationStage]" autocomplete="off"   data-required="1"  class="select-status select-approve-pi">' + rpStage_options + '</select><div class="errordiv PotentialLineCard' + key + 'RegistrationStage"><div class="arrow"></div>Not Empty!</div></div></td>'+      
        '<tr data-id = '+key+'  class="highlightNoClick myDragClass Shipment sm Shipment'+key+'" id="" value="">'+

        '<td class="bgcolor col-no center" colspan="19">'+
        '<div style="display: flex">'+
                '<div style="width: 60px;">'+
                   '<div class="header-shipmment"> <span> Part ID </span> </div>'+
                        '<div class="ps-relative"><input type="text" style="pointer-events: none;"  class="bgshipmentinput form-control text-center shipped-qty no-border"  id="PotentialLineCard'+key+'PartID" name="PotentialLineCard['+key+'][PartID]" value="'+paridnum+'">'+
                         ' <div class="errordiv PotentialLineCard'+key+'PartID">'+
                                '<div class="arrow"></div> Not Empty!  </div>'+
                        '</div>'+
                        
               '</div>'+
                '<div class="td-2" style="width: 220px;" >'+
                    '<div style="display: flex;align-items: center;justify-content: center;" class="header-shipmment "> Line Card ID <span style="color:red">*</span>  </div>'+
                      '<div style="height: 20px !important;" class="body-import">'+
                    '        <select style=" height: 20px; " id="SupplierID' + key + '" name="PotentialLineCard[' + key + '][SupplierID]" class="form-control"  data-required="1" >' + suppliers_options + '</select>' +

                    '</div>'+
                    '<div class="errordiv SupplierID' + key + '"> Not Empty!</div> </div>'+
        '<div class="td-2" style="width:150px;">'+
        
        '<div style="display: flex;align-items: center;justify-content: center;" class="header-shipmment "> Approver <span style="color:red">*</span> </div>'+
        '<div style="height: 20px !important;" class="body-import">'+
         '<select id="PotentialLineCard' + key + 'Registrationapproved" class="select2 field-update editing Registrationapproved" name="PotentialLineCard[' + key + '][Registrationapproved]" data-required="1" ></select><div class="errordiv PotentialLineCard' + key + 'Registrationapproved"><div class="arrow"></div>Not Empty!</div></div>'+

        '</div>'+
        
        '<div class="td-2" style="width: 150px;">'+
        '<div class="header-shipmment " >'+
         '<span>	Registration Date</span></div>'+
        '<div>'+
         '<input type="text" name="PotentialLineCard['+key+'][RegistrationDate]" id="PotentialLineCard'+key+'RegistrationDate" class="form-control approved-date-inp" value="'+dateTime+'"><div class="errordiv PotentialLineCard' + key + 'RegistrationDate"><div class="arrow"></div>Not Empty!</div></div>'+        
        '</div>'+
        '<div class="td-2" style="width: 150px;">'+
        '<div class="header-shipmment " ><span>Real Time</span>'+
        '</div>'+

        '<div style="height: 20px !important;" class="body-import">'+
        '<input type="text" class="form-control approved-date-inp"  value="" disabled>'+        
       '</div>'+
        '</div>'+
        '<div class="td-2" style="width: 150px;">'+
        '<div class="header-shipmment " > <span>	Result Date</span>'+
        '</div>'+

        '<div style="height: 20px !important;" class="body-import">'+
        '<input type="text" name="PotentialLineCard['+key+'][ResultDate]" id="PotentialLineCard'+key+'ResultDate" class="form-control approved-date-inp" value="">'+
        '</div>'+
        '</div>'+
        '<div class="td-2" style="width: 130px;">'+
        '<div class="header-shipmment " > <span>Registration Status</span></div>'+
        '<divstyle="height: 20px !important;" class="body-import">'+
        '<select style=" height: 20px; " id="PotentialLineCard' + key + 'RegistrationStatus" name="PotentialLineCard[' + key + '][RegistrationStatus]" class="select-status approved-date-inp disabled">' + rpstatus_options + '</select>'+
                   '<input type="hidden" name="" id="" class="form-control keymum" value="'+key+'">'+
        '</div>'
        '</div>'
        
       '</div>'
        '</td>'
           '</tr>';

   
   
        if ($('.PotentialLineCard').length) {
            $('#itemList table tbody tr.tr-last').before(string);
        } else {
            $('#itemList table tbody tr.tr-last').before(string);
    }
    var no=$('#ProjectName').val();
    $('#PotentialLineCard' + key + 'Projectno').val(no);
    var FaeStaff= ($('#cpFaeStaff').html());
    //console.log(FaeStaff);
    $( '#PotentialLineCard'+key+'ProjectStatus' ).html($('#cpRegistrationStatus').html() ).trigger( 'chosen:updated' );
    $( '#PotentialLineCard'+key+'FAE').html(FaeStaff ).trigger( 'chosen:updated' );
    $( '#PotentialLineCard'+key+'Owner').html($('#AccountOwner').html() ).trigger( 'chosen:updated' );
    $( '#PotentialLineCard'+key+'Marketing' ).html($('#cpaketing').html() ).trigger( 'chosen:updated' );
    $('#PotentialLineCard' + key + 'FAE').chosen();
    $('#PotentialLineCard' + key + 'ProjectStatus').chosen();
    $('#PotentialLineCard' + key + 'Marketing').chosen();
    $('#PotentialLineCard' + key + 'Owner').chosen();
    $('#PotentialLineCard' + key + ' .date').datepicker({
        format: 'yyyy-mm-dd',
        language: 'vi',
        autoclose: true,
        todayHighlight: true
    });

    $('#PotentialLineCard' + key + 'category').chosen();
    $('#PotentialLineCard' + key + ' .money').autoNumeric('init', {
        'mDec': 0
    });
}
