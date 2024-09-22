$(document).ready(function($) {

    $('#VAT').bind('change', function() {
        $val = $(this).val();
        if ($val < 0 || $val > 100) {
            $(this).val(0);
        }
        updateDataSum();
    });

    $('#ShippingChargesUSD').bind('change', function() {
        var val = parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        $(this).val(accounting.formatMoney(val, '', 4));
        updateDataSum();
    });

    $('#BankChargesUSD').bind('change', function() {
        var val = parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        $(this).val(accounting.formatMoney(val, '', 4));
        updateDataSum();
    });
    $('#DiscountUSD').bind('change', function() {
        var val = parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        $(this).val(accounting.formatMoney(val, '', 4));
        updateDataSum();
    });
    updateDataSum();

    $('body').on('click', '.btn-list-old', function() {
        var tr = $(this).closest('tr');
        var mfrPart = tr.find('.mfr-part').val();
        var orderqty = tr.find('.order-qty');
        var unitprice = tr.find('.unit-price-usd');
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
                    orderqty.val(accounting.formatMoney(parseFloat(tr_item.find('.orderqty').text().replace(/\s/g, '').replace(/,/g, '')), '', 0));
                    unitprice.val(accounting.formatMoney(parseFloat(tr_item.find('.unitprice').text().replace(/\s/g, '').replace(/,/g, '')), '', 4));
                    showNoti('Mfr Part Number: ' + mfrPart, 'Cập nhật hoàn tất', 'Ok');
                    updateDataItem(tr);
                    updateDataSum();
                });
            }
        });
    })
});
/* # Ready */


function updateDataSum() {
    var sumTotal = 0.0;
    var sumTotalVND = 0.0;
    var total = 0.0;
    var totalVND = 0.0;
    var VAT = 0.0;
    var sumVAT = 0.0;
    var ShippingChargesUSD = 0.0;
    var ShippingChargesVND = 0.0;
    var BankChargesUSD = 0.0;
    var BankChargesVND = 0.0;
    if ($('.amount-usd').length > 0) {
        $('.amount-usd').each(function() {
            sumTotal += parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        });
        $('.amount-vnd').each(function() {
            sumTotalVND += parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        });
        if ($('#ShippingChargesUSD').length) {
            ShippingChargesUSD = parseFloat($('#ShippingChargesUSD').val().replace(/\s/g, '').replace(/,/g, ''));
            ShippingChargesVND = ShippingChargesUSD * parseInt($('#USDExchangeRate').val().replace(/\s/g, '').replace(/,/g, ''));
            $('#ShippingChargesVND').val(accounting.formatMoney(ShippingChargesVND, '', 0));
            $('#ShippingChargesUSD').val(accounting.formatMoney(ShippingChargesUSD, '', 2));
        }
        if ($('#BankChargesUSD').length) {
            BankChargesUSD = parseFloat($('#BankChargesUSD').val().replace(/\s/g, '').replace(/,/g, ''));
            BankChargesVND = BankChargesUSD * parseInt($('#USDExchangeRate').val().replace(/\s/g, '').replace(/,/g, ''));
            $('#BankChargesVND').val(accounting.formatMoney(BankChargesVND, '', 0));
            $('#BankChargesUSD').val(accounting.formatMoney(BankChargesUSD, '', 2));
        }
        if ($('#DiscountUSD').length) {
            DiscountUSD = parseFloat($('#DiscountUSD').val().replace(/\s/g, '').replace(/,/g, ''));
            DicountVND = DiscountUSD * parseInt($('#USDExchangeRate').val().replace(/\s/g, '').replace(/,/g, ''));
            $('#DicountVND').val(accounting.formatMoney(DicountVND, '', 0));
            $('#DiscountUSD').val(accounting.formatMoney(DiscountUSD, '', 2));
        }
        $('#SubTotalVND').val(accounting.formatMoney(sumTotalVND, '', 0));
        $('#SubTotalUSD').val(accounting.formatMoney(sumTotal, '', 2));
        VAT = parseFloat($('#VAT').val().replace(/\s/g, '').replace(/,/g, ''));
        sumVAT = sumTotal * VAT / 100;
        sumVATVND = sumTotalVND * VAT / 100;
        VATtotalVND = parseFloat(accounting.formatMoney(sumVATVND, '', 0).replace(/\s/g, '').replace(/,/g, ''));
        $('.vat-vnd').val(accounting.formatMoney(sumVATVND, '', 0));
        $('#VATTaxUSD').val(accounting.formatMoney(sumVAT, '', 2));
        total = sumTotal + sumVAT + ShippingChargesUSD + BankChargesUSD - DiscountUSD;
        totalVND = sumTotalVND + VATtotalVND + ShippingChargesVND + BankChargesVND - DicountVND;
        console.log(sumTotalVND);
        console.log(VATtotalVND);
        console.log(totalVND);
        $('#TotalVND').val(accounting.formatMoney(totalVND, '', 0));
        $('#TotalUSD').val(accounting.formatMoney(total, '', 2));
        if($('#Language').val()==1){
            $('#InWord').val(DocTienBangChu(totalVND));

        }else{
            $('#InWord').val(toWords(total));
        }

    } else {
        $('#SubTotalUSD').val(accounting.formatMoney(0, '', 2));
        $('#SubTotalVND').val(0);
        $('#VATTaxUSD').val(accounting.formatMoney(0, '', 2));
        $('#ShippingChargesUSD').val(accounting.formatMoney(0, '', 2));
        $('#ShippingChargesVND').val(0);
        $('#BankChargesUSD').val(accounting.formatMoney(0, '', 2));
        $('#BankChargesVND').val(0);
        $('#TotalUSD').val(accounting.formatMoney(0, '', 2));
        $('#TotalVND').val(0);
        $('#InWord').val('');

    }
}

function updateDataItem(e) {
    var Orqty = parseInt(e.find('.order-qty').val().replace(/\s/g, '').replace(/,/g, ''));
    if (Orqty < 0) {
        Orqty = 1;
    }
    var priceUSD = parseFloat(e.find('.unit-price-usd').val().replace(/\s/g, '').replace(/,/g, ''));
    var amountUSD = Orqty * priceUSD;
    e.find('.amount-usd').val(accounting.formatMoney(amountUSD, '', 2));
    updateDataSum();
}
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