function recalu_price() {
    if (!!old_update_pe) return false;
    //var tdeposit = 0;
   // var tval = 0
    $('#itemList .mainTable tbody tr').each(function () {
        var tr = $(this);
        var buying_price_usd= $(this).find('input.buying_price').val();
        var buying_price_vnd= $(this).find('input.buying_pricevn').val();
        //alert(buying_price_vnd);
             //buying_price_usd=buying_price_usd.replace(/\s/g, '').replace(/,/g, '');
             buying_price_vnd=buying_price_vnd.replace(/\s/g, '').replace(/,/g, '');
        var amout_vnd= tr.find('.amout-vnd').text().replace(/\s/g, '').replace(/,/g, '');
        var amout_usd=  tr.find('.amout').text().replace(/\s/g, '').replace(/,/g, '');
        console.log('buying_price_vnd '+buying_price_vnd);
        console.log('buying_price_vnd '+amout_vnd);
        var percentUsd = (buying_price_usd / amout_usd) * 100;
        var percentVnd = (buying_price_vnd / amout_vnd) * 100;
       
      // $(this).find('input.buying_pricevn').val(buying_price_vnd);
        tr.find('.percent-vnd').text(percentVnd.toFixed(2) + ' %');
        tr.find('.percent-usd').text(percentUsd.toFixed(2) + ' %');
        //console.log('buyprice:'+ amout_vnd);
        var total_depositvnd=  $('.total-deposit-vnd').text().replace(/\s/g, '').replace(/,/g, '');
        var total_depositusd=  $('.total-deposit-usd').text().replace(/\s/g, '').replace(/,/g, '');
        var total_amoutvnd=  $('.ttamout-vnd').text().replace(/\s/g, '').replace(/,/g, '');
        var total_amoutusd=  $('.ttamout-usd').text().replace(/\s/g, '').replace(/,/g, '');
      //  console.log('total_amoutusd:'+ total_amoutvnd);
      //  console.log('total_depositvnd:'+ total_depositvnd);
        var tpercentvnd = (total_depositvnd / total_amoutvnd) * 100;
        var tpercentusd= (total_depositusd / total_amoutusd) * 100;
        $('.total-per-vnd').text(tpercentvnd.toFixed(2) + ' %');
        $('.total-per-usd').text(tpercentusd.toFixed(2) + ' %');
        $('.amountAdvance1').text(accounting.formatMoney(total_depositusd, '', 0));
        $('.amountAdvance2').text(accounting.formatMoney(total_depositvnd, '', 0));
        
    }
    
)

};

$(document).ready(function ($) {
    function setCurrent() {
        if (!!old_update_pe) return false;
        var current_mode = 'vnd';
        if ($('#CurrencyOfRequest').val() == "1") {
            $('.td-cur-usd').addClass('hidden');
            $('.th-cur-usd').addClass('hidden');
            $('.tt-cur-usd').addClass('hidden');
            $('.th-cur-vnd').removeClass('hidden');
            $('.td-cur-vnd').removeClass('hidden');
            $('.tt-cur-vnd').removeClass('hidden');
            $('.th-lable-buy').text('(VND)');
        }
         if($('#CurrencyOfRequest').val() == "2"){
            current_mode = 'usd';
            $('.td-cur-usd').removeClass('hidden');
            $('.th-cur-usd').removeClass('hidden');
            $('.tt-cur-usd').removeClass('hidden');
            $('.th-cur-vnd').addClass('hidden');
            $('.td-cur-vnd').addClass('hidden');
            $('.tt-cur-vnd').addClass('hidden');
            $('.th-lable-buy').text('(USD)');
        }else{
            $('#CurrencyOfRequest').val(1).selected;
           // $('.td-cur-vnd').addClass('selected');
            //var z = $(this).find(":selected").text();

        }


    }

    setCurrent();

    var tqty = 0;

    recalu_price();
    $('.total-qty').text(tqty);

    function cal_price( _this) {
        var tr = _this.closest('tr');
        var tab = _this.closest('table tbody');       
         var buying_pricevn = 0;
        var buying_priceusd = 0;
        var tpercentvn = 0.0;
        var tpercentusd = 0.0;
        var amoutusd = 0.0;
        var amoutvnd = 0.0;

        var current_mode= $('#CurrencyOfRequest').val();
       if ($('.unit-vnd').length > 0) {
            $('.buying_pricevn').each(function () {
                buying_pricevn += parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
                
            });
            $('.buying_price').each(function () {
                buying_priceusd += parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
            });
            $('.amout').each(function () {
                amoutusd += parseFloat($(this).text().replace(/\s/g, '').replace(/,/g, ''));
            });
            $('.amout-vnd').each(function () {
                amoutvnd += parseFloat($(this).text().replace(/\s/g, '').replace(/,/g, ''));
            });
            
           // console.log('sumTotal: '+ amoutvnd);
            tpercentvn = (buying_pricevn / amoutvnd) * 100;
            tpercentusd = (buying_priceusd / amoutusd) * 100;

           $('.total-deposit-vnd').text(accounting.formatMoney(buying_pricevn, '', 0));
           $('.total-deposit-usd').text(accounting.formatMoney(buying_priceusd, '', 2));
           $('.total-per-usd').text(tpercentusd.toFixed(2) + ' %');
           $('.total-per-vnd').text(tpercentvn.toFixed(2) + ' %');
           var soTienAm = $('.total-deposit-vnd').text().replace(/\s/g, '').replace(/,/g, '');

           if (current_mode ==2) {
            var monn = toWords($('.total-deposit-usd').text().replace(/\s/g, '').replace(/,/g, ''));
            console.log('fffffff'+monn);

            $('.how-much').text(monn);
            $('#InWord').val(monn);
        } else {
            var monn = DocTienBangChu(soTienAm < 0 ? -soTienAm : soTienAm);
            $('.how-much').text(monn);
            $('#InWord').val(monn);
        }
       // var tr = _this.closest('tr');
    //.find('input.buying_pricevn').val(val);
   /* var tdeposit = 0;
    var tval = 0;

       tab.find('tr').each(function () {
        var tzx = $(this).find('input.buying_pricevn').val();
        //var zx = $(this).find('input.buying_price').val(tzx*);

        //var t= parseFloat(zx);
        //var tt= parseFloat(tzx);
      // var t = parseFloat(zx.replace(/\s/g, '').replace(/,/g, ''));
       var tt = parseFloat(tzx.replace(/\s/g, '').replace(/,/g, ''));
       $(this).find('input.buying_pricevn').val(tzx);
      // $(this).find('input.buying_price').val(zx);
      //  console.log('21323: '+zx);
     // if (!!t) tdeposit += t;
       if (!!tt) tval += tt;
   })*/

        
        }
      //  var tr = _this.closest('tr');
        //var tab = _this.closest('table tbody');
    }

    $('body').on('change', '#CompanyID', function () {
        var val = $(this).val();
        if (val == "") {
            $('#Address1').val('');
            $('#Phone1').val('');
            $('#Email1').val('');
        } else {
            $.ajax({
                url: site_url + 'ajax/get_info_with_id',
                type: 'POST',
                cache: false,
                data: {
                    id: val,
                    table: 'company_info',
                    act: ''
                },
                success: function (string) {
                    var getData = $.parseJSON(string);
                    $('#Address1').val(getData.Address);
                    $('#Email1').val(getData.EmailContact);
                    $('#Phone1').val(getData.Phone);
                }
            });
        }
    }).on('change', '#CurrencyOfRequest', function () {
       
        
        
        setCurrent();
        recalu_price();
        cal_price($(this));
    }).on('change', '.buying_price', function () {
        var tab = $(this).closest('table tbody');       
        var usd_rates= $('#usd_rates').text().replace(/\s/g, '').replace(/,/g, '');
       tab.find('tr').each(function () {
        var tzx = $(this).find('input.buying_price').val();
        var tt = parseFloat(tzx.replace(/\s/g, '').replace(/,/g, ''));
        $(this).find('input.buying_price').val(accounting.formatMoney(tzx,'',2));
        $(this).find('input.buying_pricevn').val(tt*usd_rates);
       })
        cal_price($(this));
        recalu_price();
      }).on('change', '.buying_pricevn', function () {;
        var tab = $(this).closest('table tbody');       
        var usd_rates= $('#usd_rates').text().replace(/\s/g, '').replace(/,/g, '');
            
            
       tab.find('tr').each(function () {
        var tzx = $(this).find('input.buying_pricevn').val();
        var tt = parseFloat(tzx.replace(/\s/g, '').replace(/,/g, ''));
        $(this).find('input.buying_pricevn').val(accounting.formatMoney(tzx,'',0));
        $(this).find('input.buying_price').val(tt/usd_rates);
    })


     //   var usd_rates= $('#usd_rates').text().replace(/\s/g, '').replace(/,/g, '');

        //var parent = $(this).closest('.group-required');
       // parent.find('.buying_pricevn').val(accounting.formatMoney($(this).val(), '', 0) );
       // parent.find('.buying_price').val(accounting.formatMoney($(this).val()*usd_rates, '', 0) );
       //// var val = parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        //alert(val);

        cal_price($(this));
        recalu_price();

    })
    
    .on('click', '#Director', function () {
        var name = $(this).data('name');
        var id = $(this).data('id');
        var user = $(this).data('user');
        var month = $(this).data('month');
        var limit = $(this).data('limit');
        if (limit == undefined) limit = 0;
        if (limit > month) {
            showNoti("The total amount you have payment in the current month " + accounting.formatMoney(limit, '', 0) + ". The payment limit is only " + accounting.formatMoney(month, '', 0) + " VND over limited in the month", "Update information failed!", "Err");
            return false;
        } else {
            $.alerts.confirm1('Are you sure you confirm this item? Successfully confirming the system will lock the system cannot be adjusted. Please double check before doing, Thanks !!!<br />', 'Confirm ', function (r) {
                if (r == "a") {
                    $.ajax({
                        url: site_url + $('#act').val() + '/director',
                        type: 'POST',
                        cache: false,
                        data: {id: id, type: 3},
                        success: function (string) {

                            $('#updateFrm').submit();
                        }
                    })
                } else if (r == true) {
                    $.ajax({
                        url: site_url + $('#act').val() + '/director',
                        type: 'POST',
                        cache: false,
                        data: {id: id, type: 1},
                        success: function (string) {
                            $('#updateFrm').submit();
                        }
                    })

                }

            });
        }
    }).on('click', '#Leader', function () {
        var PrepareBy1 = 0;
        var name = $(this).data('name');
        var id = $(this).data('id');
        var user = $(this).data('user');
        $.alerts.confirm('Are you sure you confirm this item? Successfully confirming the system will lock the system cannot be adjusted. Please double check before doing, Thanks !!!<br />', 'Confirm ', function (r) {
            if (r == true) {
                $.ajax({
                    url: site_url + $('#act').val() + '/Leader',
                    type: 'POST',
                    cache: false,
                    data: {Leader: 1, id: id},
                    success: function (string) {
                        $('#updateFrm').submit();
                    }
                })
            }
        });


    }).on('click', '#PrepareBy', function () {
        var name = $(this).data('name');
        var id = $(this).data('id');
        var user = $(this).data('user');
        $.alerts.confirm('Are you sure you confirm this item? Successfully confirming the system will lock the system cannot be adjusted. Please double check before doing, Thanks !!!<br />', 'Confirm ', function (r) {
            if (r == true) {
                $.ajax({
                    url: site_url + $('#act').val() + '/PrepareBy',
                    type: 'POST',
                    cache: false,
                    data: {PrepareBy: 1, id: id},
                    success: function (string) {
                        $('#updateFrm').submit();
                    }
                })
            }
        });
    }).on('click', '#Manager', function () {
        var Manager1 = 0;
        var name = $(this).data('name');
        var id = $(this).data('id');
        var user = $(this).data('user');
        $.alerts.confirm('Are you sure you confirm this item? Successfully confirming the system will lock the system cannot be adjusted. Please double check before doing, Thanks  !!!<br />', 'Confirm ', function (r) {
            if (r == true) {
                $.ajax({
                    url: site_url + $('#act').val() + '/Manager',
                    type: 'POST',
                    cache: false,
                    data: {Manager: 1, id: id},
                    success: function (string) {
                        $('#updateFrm').submit();
                    }
                })
            }
        });
    })

});

function Request_purchase(id) {
    var complete1 =  $('#complete').val();
  //  alert(complete1);
    var vat = '';
    var usd_rates= $('#usd_rates').text().replace(/\s/g, '').replace(/,/g, '');
    var current_mode= $('#CurrencyOfRequest').val();
    $.ajax({
        url: site_url + 'requests_for_advance/get_pusrchase_info',
        type: 'POST',
        cache: false,
        data: {id: $('#id').val()},
        success: function (string) {
           // console.log( $('#id').val());
            var getData = $.parseJSON(string);
          //  console.log(getData);
            vat += '<tr>';
            vat += '<td colspan="8" rowspan="6"></td>';
           
            vat += ' <td class="right"><b>TOTAL</b></td>';
            vat += '<td class="center td-cur-usd amountAdvance1">'+ accounting.formatMoney(getData.AmountAdvance,'',2) ;
            vat += '<td class="left td-cur-usd">USD';
            vat += '<td class="center td-cur-vnd  amountAdvance2">' + accounting.formatMoney(getData.AmountAdvance,'','');
            vat += '<td class="left td-cur-vnd"> VNĐ';
            $('#AmountAdvance').val(getData.AmountAdvance);
           // $('#AmountVND').val(getData.TotalVND);
        }
    });
    setTimeout(function () {
        $.ajax({
            url: site_url + 'requests_for_advance/get_purchase_request',
            type: 'POST',
            cache: false,
            data: {id: id},
            success: function (string) {
                if (id == 0) {
                    $('#Request').empty();
                    $('#request_amount').empty();

                } else {
                    //alert($('CurrencyOfRequest').val());
                    var getData = $.parseJSON(string);
                    var total_1 = 0;
                    var total_2 = 0;
                    var total_3 = 0;
                    var total_4 = 0;
                    var total_5 = 0;
                    var total_6 = 0;
                    var string = '';

                    string = '<div id="itemList" class="table-responsive mrg25T">';
                    string += '<table class="mainTable  table-hover table-part" border="0" width="100%"> ';
                    string += '<thead class="tableFloatingHeaderOriginal" style="width: auto !important;">';
                    string += '<tr class="nodrop">';
                    string += '<th><input type="checkbox" class="cb-all"/></th>';
                    string += '<th nowrap="nowrap" style="">No</th>';
                    string += '<th nowrap="nowrap" class="left" style="">PartNumber </th>';
                    string += '<th nowrap="nowrap"class="left"  style="">Description</th>';
                    string += '<th nowrap="nowrap" class="left" style="">Manufacturer</th>';
                    string += '<th nowrap="nowrap" class="left" style="">Package</th>';
                    string += '<th class="" nowrap="nowrap" style="float: right">Quantity</th>';
                    string += '<th class="right th-cur-usd" nowrap="nowrap" style="">Buying Price<br>(USD)</th>';
                    string += '<th class="right th-cur-vnd" nowrap="nowrap" style="">Buying Price<br>(VND)</th>';
                    string += '<th class="right th-cur-usd" nowrap="nowrap" style="">Buying Amount<br>(USD)</th>';
                    string += '<th class="right th-cur-vnd" nowrap="nowrap" style="">Buying Amount<br>(VND)</th>';
                    string += '<th class="right th-cur-vnd" nowrap="nowrap" style="">Advance payment <span style="color:red">*</span></th>';
                    string += '<th class="right th-cur-usd" nowrap="nowrap" style="">Advance payment <span style="color:red">*</span></th>';
                    string += '<th class="right " nowrap="nowrap" style=""><span>Percent</span></th>';
                    string += '<th class="left" style="text-align: right;width: 100px !important; min-width: 100px !important; max-width: 100px !important;">Leadtime / Comment</th>';
                    string += '</tr>';
                    string += ' </thead>';
                    string += ' <tbody>';
                    var tqty = 0;
                    if (Array.isArray(getData) && getData.length) {
                        for (var i = 0; i < getData.length; i++) {
                            total_1 += parseFloat(getData[i]['UnitPriceUSD']);
                            total_2 += parseFloat(getData[i]['AmountUSD']);
                            total_3 += parseFloat(getData[i]['UnitPriceVND']);
                            total_4 += parseFloat(getData[i]['AmountVND']);
                            total_5 += parseFloat(getData[i]['BuyingPricevn']);
                            total_6 += parseFloat(getData[i]['BuyingPriceUSD']);
                            string += '<tr class="highlightNoClick myDragClass" id="' + i + '">';
                            string += '<td class="center" style=""><input type="checkbox" name="" class="cb-ele" value="1"></td>';
                            string += '<td class="" style=""><span class="sttz center" style="text-align: center">' + (i + 1) + '</span></td>';
                            string += '<td style=""><span stype="text-align: left;width: 200px;">' + getData[i]['PartNumber'] + '<span></td>';
                            string += '<td style=""><span class="td-des" stype="text-align: left;width: 200px;">' + getData[i]['Description'] + '</span>';
                            string += '<td style="" class=""><span stype="text-align: left;width: 200px;"> ' + getData[i]['Manufacturer'] + '</span></td>';
                            string += '<td style="" class=""><span > '+ getData[i]['Package'] +'</span> </td>';
                            string += '<td style="text-align: right !important;" ><span> ' + getData[i]['Quantity'] + '</span> </td>';
                            string += '<td class="right td-cur-usd unit" style="" ><span>' + accounting.formatMoney(getData[i]['UnitPriceUSD'], '', 2) + '</span></td>';
                            string += '<td class="right td-cur-vnd unit-vnd"><span>' + accounting.formatMoney(getData[i]['UnitPriceVND'], '', 0) + '</span></td>';
                            string += '<td class="right td-cur-usd" ><span class="amout">' + accounting.formatMoney(getData[i]['AmountUSD'], '', 2) + '</span></td>';
                            string += '<td class="right td-cur-vnd" ><span class="amout-vnd">' + accounting.formatMoney(getData[i]['AmountVND'], '', 0) + '</span></td>';
                            if(complete1 == 0 ){
                            string += '<td class="right group-required td-cur-vnd" style="" ><input type="hidden" value="' + getData[i]['id'] + '" name="ppvn[' + i + '][id]"><input id="dep' + i + '" type="text" data-required="1" value="'+accounting.formatMoney(getData[i]['BuyingPricevn'],'',0) +'" class="'+(complete== true ? 'disabled' : '')+' input-required form-control buying_pricevn" name="ppvn[' + i + '][buyvn]" min="1"/><div class="errordiv dep' + i + '">Not Empty!</div> </td>';
                            string += '<td class="right group-required td-cur-usd" style="" ><input type="hidden" value="' + getData[i]['id'] + '" name="pp[' + i + '][id]"><input id="dep' + i + '" type="text" data-required="1" value="'+accounting.formatMoney(getData[i]['BuyingPriceUSD'],'',2 )+'" class="'+(complete== true ? 'disabled' : '')+' input-required form-control buying_price" name="pp[' + i + '][buy]" min="1" /><div class="errordiv dep' + i + '">Not Empty!</div> </td>';
                          
                            }else{
                                string += '<td class="right group-required td-cur-vnd" style="" >'+accounting.formatMoney(getData[i]['BuyingPricevn'],'',0) +' </td>';
                                string += '<td class="right group-required td-cur-vnd" style="" >'+accounting.formatMoney(getData[i]['BuyingPriceUSD'],'',0) +' </td>';
                            }
                            string += '<td class="right" ><span class="td-cur-vnd  percent-vnd"  style="text-align: right !important;" ></span><span class="td-cur-usd percent-usd"  style="text-align: right !important;"></span></td>';
                            string += '<td style="width:150px !important; min-width: 150px !important; max-width: 150px !important;text-align: left;"  >' + getData[i]['Note'];
                            string += '</tr>';
                            tqty += parseInt(getData[i]['Quantity']);
                        }
                    }
                    string += '</tbody>';
                    string += '<tfoot>';
                    string += '<tr class="bg-primary tr-total">' +
                        '<td colspan="6"><span style="float: right">Total &nbsp;' +
                        '<td style="float: right"><span class="total-qty">' + tqty +
                        '<td class="center tt-cur-usd">' + accounting.formatMoney(total_1, '', 2) + '</td>' +
                        '<td class="right tt-cur-usd ttamout-usd">' + accounting.formatMoney(total_2, '', 2) + '</td>' +
                        '<td class="right tt-cur-vnd">' + accounting.formatMoney(total_3, '', 0) + '</td>' +
                        '<td class="right tt-cur-vnd ttamout-vnd">' + accounting.formatMoney(total_4, '', 0) + '</td>' +
                        '<td class="left tt-cur-vnd"><span class="total-deposit-vnd">' + accounting.formatMoney(total_5, '', 0) + '</span></td>' +
                        '<td class="left tt-cur-usd" ><span class="total-deposit-usd">' + accounting.formatMoney(total_6, '', 2) + '</span></td>' +
                        '<td class="right tt-cur-usd" style="float: right"><span class="total-per-usd"></span></td>' +
                        '<td class="right tt-cur-vnd" style="float: right"><span class="total-per-vnd"></span></td>' +
                        '<td><input type="hidden" name = "AmountVND" value="'+total_5+'"></td>' +
                        '<td><input type="hidden" name = "AmountUSD" value="'+total_6+'"></td>' +
                        '</tr>';
                    var soTienAm = total_5.toString().replace(/\s/g, '').replace(/,/g, '');
                     if (current_mode==1){
                    var many = "" + DocTienBangChu(soTienAm < 0 ? -soTienAm : soTienAm);
                    string +='<input type="hidden"  id="InWord" name = "Inword" value="'+many+'">'
                     }else{
                        var many = "" + toWords(total_6);
                        string +='<input type="hidden" id="InWord" name = "Inword" value="'+many+'">'
                     }
                     
                    string += '<tr class="bgcolor money-word"><td colspan="6"><span style="float: right">In Word: &nbsp;</span></td><td colspan="99"><span class="how-much" style="float:left;padding-right: 50px;padding-left: 20px;">' + many + '</span></td>';
                    string += vat;
                    string += '</tfoot>';
                    string += '</table>';
                    string += '</div>';
                    $('#Request').html(string);
                    setTimeout(function () {
                        if ($('#CurrencyOfRequest').val() == "1") {
                            $('.td-cur-usd').addClass('hidden');
                            $('.th-cur-usd').addClass('hidden');
                            $('.tt-cur-usd').addClass('hidden');
                            $('.th-cur-vnd').removeClass('hidden');
                            $('.td-cur-vnd').removeClass('hidden');
                            $('.tt-cur-vnd').removeClass('hidden');
                            $('.th-lable-buy').text('(VND)');
                        } else {
                            $('.td-cur-usd').removeClass('hidden');
                            $('.th-cur-usd').removeClass('hidden');
                            $('.tt-cur-usd').removeClass('hidden');
                            $('.th-cur-vnd').addClass('hidden');
                            $('.td-cur-vnd').addClass('hidden');
                            $('.tt-cur-vnd').addClass('hidden');
                            $('.th-lable-buy').text('(USD)');
                            
                        }
                    }, 50);
                    $(".sign").css({"width": "1582px"});
                    recalu_price();
                   //cal_price();
                    $('.mainTable').stickyTableHeaders({
                        fixedOffset: $('#page-header').height() + ($('.group-process').length ? 32 : 0)
                    });
                }
            }
        })
    }, 500);
};

var th = ['', 'thousand', 'million', 'billion', 'trillion'];
var dg = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];
var tn = ['ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'];
var tw = ['twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];

function toWords(s) {

    s = s.toString();
    s = s.replace(/[\, ]/g, '');
    if (s != parseFloat(s)) return 'nodt a number';
    var x = s.indexOf('.');
    var fulllength = s.length;

    if (x == -1) x = s.length;
    if (x > 15) return 'too big';
    var startpos = fulllength - (fulllength - x - 1);
    var n = s.split('');

    var str = '';
    var str1 = '';
    var sk = 0;
    for (var i = 0; i < x; i++) {
        if ((x - i) % 3 == 2) {
            if (n[i] == '1') {
                str += tn[Number(n[i + 1])] + ' ';
                i++;
                sk = 1;
            } else if (n[i] != 0) {
                str += tw[n[i] - 2] + ' ';

                sk = 1;
            }
        } else if (n[i] != 0) {
            str += dg[n[i]] + ' ';
            if ((x - i) % 3 == 0) str += 'hundred ';
            sk = 1;
        }
        if ((x - i) % 3 == 1) {
            if (sk) str += th[(x - i - 1) / 3] + ' ';
            sk = 0;
        }
    }
    if (x != s.length) {

        str += 'and ';
        str1 += 'cents ';
        //for (var i = x + 1; i < y; i++) str += dg[n[i]] + ' ' ;
        var j = startpos;

        for (var i = j; i < fulllength; i++) {

            if ((fulllength - i) % 3 == 2) {
                if (n[i] == '1') {
                    str += tn[Number(n[i + 1])] + ' ';
                    i++;
                    sk = 1;
                } else if (n[i] != 0) {
                    str += tw[n[i] - 2] + ' ';

                    sk = 1;
                }
            } else if (n[i] != 0) {

                str += dg[n[i]] + ' ';
                if ((fulllength - i) % 3 == 0) str += 'hundred ';
                sk = 1;
            }
            if ((fulllength - i) % 3 == 1) {

                if (sk) str += th[(fulllength - i - 1) / 3] + ' ';
                sk = 0;
            }
        }
    }
    var result = str.replace(/\s+/g, ' ') + str1;
    $('.res').text(result);
    return result;

}
