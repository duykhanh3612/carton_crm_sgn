$(document).ready(function($) {
	$('#frmSearch').submit(function() {
        $('#divSearch').show();
        $('#divSearch div').css('max-height', '300px');
        $('#divSearch tbody').html('<tr><td class="fr center" colspan="10"><div style="padding:10px"><img src="assets/images/spinner-mini.gif" /></div></td></tr>');
        $.ajax({
            url: site_url + 'ajax/search_part',
            type: 'POST',
            cache: false,
            data: {
                q: $('[name="q"]').val()
            },
            success: function(string) {
                $('#divSearch tbody').empty().append(string);
                $('#divSearch tr:not(".no-data, .nodrop")').click(function() {
                    var part = $(this).find('span.mfr-part').text();
                    var key = parseInt($('#itemList table tbody .highlightNoClick:last td input.itemKey').val()) + 1;
                    if ($('#itemList table tbody .highlightNoClick').length == 0) {
                        key = 1;
                    }
                    if ($('input.mfr-part[value="' + part + '"]').length) {
                        $('input.mfr-part[value="' + part + '"]').closest('tr.highlightNoClick').addClass('exists').delay(7000).queue(function(next) {
                            $(this).removeClass("exists");
                            next();
                        });
                        showNoti('Manufacturer Part Number: ' + part, 'Cảnh báo nhập liệu', 'War');
                    } else {
                        add_row(key);
                        $('[name="products[' + key + '][MfrPart]"]').attr('value', $(this).find('span.mfr-part').text());
                        $('[name="products[' + key + '][MfrPart]"]').parent().find('span').text($(this).find('span.mfr-part').text());
                        $('[name="products[' + key + '][MfrPart]"]').attr('type', 'hidden');
                        $('[name="products[' + key + '][Description]"]').val($(this).find('span.desc').text());
                        $('[name="products[' + key + '][Manufacturer]"]').val($(this).find('td.manufacturer').text());
                        $('[name="products[' + key + '][Image]"]').val($(this).find('img').data('url'));
                        $('[name="products[' + key + '][Image]"]').parent('td').find('img').attr('src', $(this).find('img').data('url'));
                        $('[name="products[' + key + '][Quantity]"]').val($(this).find('td.qty').text());
                        $('[name="products[' + key + '][Quantity]"]').attr('data-qty1', $(this).data('qty1'));
                        $('[name="products[' + key + '][Quantity]"]').attr('data-price1', $(this).data('price1'));
                        $('[name="products[' + key + '][Quantity]"]').attr('data-qty2', $(this).data('qty2'));
                        $('[name="products[' + key + '][Quantity]"]').attr('data-price2', $(this).data('price2'));
                        $('[name="products[' + key + '][Quantity]"]').attr('data-qty3', $(this).data('qty3'));
                        $('[name="products[' + key + '][Quantity]"]').attr('data-price3', $(this).data('price3'));
                        $('[name="products[' + key + '][Quantity]"]').attr('data-qty4', $(this).data('qty4'));
                        $('[name="products[' + key + '][Quantity]"]').attr('data-price4', $(this).data('price4'));
                        $('[name="products[' + key + '][Quantity]"]').attr('data-qty5', $(this).data('qty5'));
                        $('[name="products[' + key + '][Quantity]"]').attr('data-price5', $(this).data('price5'));
                        $('[name="products[' + key + '][LeadtimeComments]"]').val($(this).find('td.leadtime').text());
                        updateNO();
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
});

function add_row(key) {
    var string = '<tr class="highlightNoClick myDragClass" id="Reqpart' + key + '">';
    string += '<td class="center"><input type="checkbox" name="products[' + key + '][selItem]" class="cb-ele" value="1"></td>';
    string += '<td class="center"><span class="stt">' + key + '</span>';
    string += '<input type="hidden" name="products[' + key + '][SortOrder]" class="itemKey" value="' + key + '">';
    string += '<input type="hidden" name="products[' + key + '][id]" value="0">';
    string += '</td>';
    string += '<td><img src="" alt="" style="max-width: 27px;"><input type="hidden" name="products[' + key + '][Image]" value=""></td>';
    string += '<td><span></span><input type="text" name="products[' + key + '][MfrPart]" class="form-control expand mfr-part" value=""></td>';
    string += '<td><input type="text" name="products[' + key + '][Description]" class="form-control expand" value=""></td>';
    string += '<td><input type="text" name="products[' + key + '][Manufacturer]" class="form-control expand" value=""></td>';
    string += '<td><input type="text" name="products[' + key + '][Quantity]" class="form-control text-right quantity" value=""></td>';
    string += '<td><textarea name="products[' + key + '][LeadtimeComments]" class="form-control" rows="1"></textarea></td>';
    string += '</tr>';
    $('#itemList table tbody tr.tr-last').before(string);
    $('#itemList table tbody tr.tr-last').prev().find('.bootstrap-datepicker').datepicker({
        format: 'yyyy-mm-dd',
        language: 'vi',
        autoclose: true,
        todayHighlight: true
    });
    drapOrder();
    $('#Reqpart' + key + ' .quantity').autoNumeric('init', {
        'mDec': 0
    });
    extend_inp();
}