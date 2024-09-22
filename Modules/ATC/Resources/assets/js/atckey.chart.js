$(document).ready(function () {
    var string = '<tr>'
    $('.sc-amount').each(function () {
        string += '<td>' + $(this).val() + '</td>';
    })
    string += '</tr>';
    $('#datatable tbody').append(string);

    $('body').on('click', '.bar-year', function () {
        var cls = $(this).attr('class');
        $('#inp-' + cls).val($(this).data('value'));
        $('#inp-' + cls).prev('.label-btn').html($(this).data('value'));
        $('#inp-bar-quarter').prev('.label-btn').html('Quarter');
        $('#inp-bar-first').val('1');
        $('#inp-bar-first').prev('.label-btn').html('Month 1');
        $('#inp-bar-last').val('12');
        $('#inp-bar-last').prev('.label-btn').html('Month 12');
        bar_chart();
        bar_chart_table();
    }).on('click', '.bar-quarter', function () {
        var cls = $(this).attr('class');
        $('#inp-' + cls).val($(this).data('value'));
        $('#inp-' + cls).prev('.label-btn').html($(this).text());
        var quarter = $(this).data('value');
        if (quarter == '1'){
            $('#inp-bar-first').val('1');
            $('#inp-bar-first').prev('.label-btn').html('Month 1');
            $('#inp-bar-last').val('3');
            $('#inp-bar-last').prev('.label-btn').html('Month 3');
        }else if (quarter == '2'){
            $('#inp-bar-first').val('4');
            $('#inp-bar-first').prev('.label-btn').html('Month 4');
            $('#inp-bar-last').val('6');
            $('#inp-bar-last').prev('.label-btn').html('Month 6');
        }
        else if (quarter == '3'){
            $('#inp-bar-first').val('7');
            $('#inp-bar-first').prev('.label-btn').html('Month 7');
            $('#inp-bar-last').val('9');
            $('#inp-bar-last').prev('.label-btn').html('Month 9');
        }
        else if (quarter == '4'){
            $('#inp-bar-first').val('10');
            $('#inp-bar-first').prev('.label-btn').html('Month 10');
            $('#inp-bar-last').val('12');
            $('#inp-bar-last').prev('.label-btn').html('Month 12');
        }
        bar_chart();
        bar_chart_table();
    }).on('click', '.bar-first', function () {
        var cls = $(this).attr('class');
        $('#inp-bar-last').val($(this).data('value'));
        $('#inp-bar-last').prev('.label-btn').html($(this).text());
        $('#inp-' + cls).val($(this).data('value'));
        $('#inp-' + cls).prev('.label-btn').html($(this).text());
        bar_chart();
        bar_chart_table();
    }).on('click', '.bar-last', function () {
        var cls = $(this).attr('class');
        if ($(this).data('value') < $('#inp-bar-spr-first').val()) {
            showNoti('Tháng kết thúc không được nhỏ hơn tháng bắt đầu', 'Cảnh báo', 'War');
        } else {
            $('#inp-' + cls).val($(this).data('value'));
            $('#inp-' + cls).prev('.label-btn').html($(this).text());
            bar_chart();
            bar_chart_table();
        }
    }).on('click', '.pie-year', function () {
        var cls = $(this).attr('class');
        $('#inp-' + cls).val($(this).data('value'));
        $('#inp-' + cls).prev('.label-btn').html($(this).data('value'));
        $('#inp-pie-quarter').prev('.label-btn').html('Quarter');
        $('#inp-pie-month-first').val('1');
        $('#inp-pie-month-first').prev('.label-btn').html('Month 1');
        $('#inp-pie-month-last').val('12');
        $('#inp-pie-month-last').prev('.label-btn').html('Month 12');
        pie_chart();
    }).on('click', '.pie-quarter', function () {
        var cls = $(this).attr('class');
        $('#inp-' + cls).val($(this).data('value'));
        $('#inp-' + cls).prev('.label-btn').html($(this).text());
        var quarter = $(this).data('value');
        if (quarter == '1'){
            $('#inp-pie-month-first').val('1');
            $('#inp-pie-month-first').prev('.label-btn').html('Month 1');
            $('#inp-pie-month-last').val('3');
            $('#inp-pie-month-last').prev('.label-btn').html('Month 3');
        }else if (quarter == '2'){
            $('#inp-pie-month-first').val('4');
            $('#inp-pie-month-first').prev('.label-btn').html('Month 4');
            $('#inp-pie-month-last').val('6');
            $('#inp-pie-month-last').prev('.label-btn').html('Month 6');
        }
        else if (quarter == '3'){
            $('#inp-pie-month-first').val('7');
            $('#inp-pie-month-first').prev('.label-btn').html('Month 7');
            $('#inp-pie-month-last').val('9');
            $('#inp-pie-month-last').prev('.label-btn').html('Month 9');
        }
        else if (quarter == '4'){
            $('#inp-pie-month-first').val('10');
            $('#inp-pie-month-first').prev('.label-btn').html('Month 10');
            $('#inp-pie-month-last').val('12');
            $('#inp-pie-month-last').prev('.label-btn').html('Month 12');
        }
        pie_chart();
    }).on('click', '.pie-month-first', function () {
        var cls = $(this).attr('class');
        $('#inp-pie-month-last').val($(this).data('value'));
        $('#inp-pie-month-last').prev('.label-btn').html($(this).text());
        $('#inp-' + cls).val($(this).data('value'));
        $('#inp-' + cls).prev('.label-btn').html($(this).text());
        pie_chart();
    }).on('click', '.pie-month-last', function () {
        var cls = $(this).attr('class');
        if ($(this).data('value') < $('#inp-pie-month-first').val()) {
            showNoti('Tháng kết thúc không được nhỏ hơn tháng bắt đầu', 'Cảnh báo', 'War');
        } else {
            $('#inp-' + cls).val($(this).data('value'));
            $('#inp-' + cls).prev('.label-btn').html($(this).text());
            pie_chart();
        }
    }).on('click', '.bar-ppr-year', function () {
        var cls = $(this).attr('class');
        $('#inp-' + cls).val($(this).data('value'));
        $('#inp-' + cls).prev('.label-btn').html($(this).data('value'));
        $('#inp-bar-ppr-quarter').prev('.label-btn').html('Quarter');
        $('#inp-bar-ppr-first').val('1');
        $('#inp-bar-ppr-first').prev('.label-btn').html('Month 1');
        $('#inp-bar-ppr-last').val('12');
        $('#inp-bar-ppr-last').prev('.label-btn').html('Month 12');
        bar_ppr_chart();
        bar_ppr_table()
    }).on('click', '.bar-ppr-quarter', function () {
        var cls = $(this).attr('class');
        $('#inp-' + cls).val($(this).data('value'));
        $('#inp-' + cls).prev('.label-btn').html($(this).text());
        var quarter = $(this).data('value');
        if (quarter == '1'){
            $('#inp-bar-ppr-first').val('1');
            $('#inp-bar-ppr-first').prev('.label-btn').html('Month 1');
            $('#inp-bar-ppr-last').val('3');
            $('#inp-bar-ppr-last').prev('.label-btn').html('Month 3');
        }else if (quarter == '2'){
            $('#inp-bar-ppr-first').val('4');
            $('#inp-bar-ppr-first').prev('.label-btn').html('Month 4');
            $('#inp-bar-ppr-last').val('6');
            $('#inp-bar-ppr-last').prev('.label-btn').html('Month 6');
        }
        else if (quarter == '3'){
            $('#inp-bar-ppr-first').val('7');
            $('#inp-bar-ppr-first').prev('.label-btn').html('Month 7');
            $('#inp-bar-ppr-last').val('9');
            $('#inp-bar-ppr-last').prev('.label-btn').html('Month 9');
        }
        else if (quarter == '4'){
            $('#inp-bar-ppr-first').val('10');
            $('#inp-bar-ppr-first').prev('.label-btn').html('Month 10');
            $('#inp-bar-ppr-last').val('12');
            $('#inp-bar-ppr-last').prev('.label-btn').html('Month 12');
        }
        bar_ppr_chart();
        bar_ppr_table()
    }).on('click', '.bar-ppr-first', function () {
        var cls = $(this).attr('class');
        $('#inp-bar-ppr-last').val($(this).data('value'));
        $('#inp-bar-ppr-last').prev('.label-btn').html($(this).text());
        $('#inp-' + cls).val($(this).data('value'));
        $('#inp-' + cls).prev('.label-btn').html($(this).text());
        bar_ppr_chart();
        bar_ppr_table()
    }).on('click', '.bar-ppr-last', function () {
        var cls = $(this).attr('class');
        if ($(this).data('value') < $('#inp-bar-ppr-first').val()) {
            showNoti('Tháng kết thúc không được nhỏ hơn tháng bắt đầu', 'Cảnh báo', 'War');
        } else {
            $('#inp-' + cls).val($(this).data('value'));
            $('#inp-' + cls).prev('.label-btn').html($(this).text());
            bar_ppr_chart();
            bar_ppr_table()
        }
    }).on('click', '.pie-ppr-year', function () {
        var cls = $(this).attr('class');
        $('#inp-' + cls).val($(this).data('value'));
        $('#inp-' + cls).prev('.label-btn').html($(this).data('value'));
        $('#inp-pie-ppr-quarter').prev('.label-btn').html('Quarter');
        $('#inp-pie-ppr-first').val('1');
        $('#inp-pie-ppr-first').prev('.label-btn').html('Month 1');
        $('#inp-pie-ppr-last').val('12');
        $('#inp-pie-ppr-last').prev('.label-btn').html('Month 12');
        pie_ppr_chart();

    }).on('click', '.pie-ppr-quarter', function () {
        var cls = $(this).attr('class');
        $('#inp-' + cls).val($(this).data('value'));
        $('#inp-' + cls).prev('.label-btn').html($(this).text());
        var quarter = $(this).data('value');
        if (quarter == '1'){
            $('#inp-pie-ppr-first').val('1');
            $('#inp-pie-ppr-first').prev('.label-btn').html('Month 1');
            $('#inp-pie-ppr-last').val('3');
            $('#inp-pie-ppr-last').prev('.label-btn').html('Month 3');
        }else if (quarter == '2'){
            $('#inp-pie-ppr-first').val('4');
            $('#inp-pie-ppr-first').prev('.label-btn').html('Month 4');
            $('#inp-pie-ppr-last').val('6');
            $('#inp-pie-ppr-last').prev('.label-btn').html('Month 6');
        }
        else if (quarter == '3'){
            $('#inp-pie-ppr-first').val('7');
            $('#inp-pie-ppr-first').prev('.label-btn').html('Month 7');
            $('#inp-pie-ppr-last').val('9');
            $('#inp-pie-ppr-last').prev('.label-btn').html('Month 9');
        }
        else if (quarter == '4'){
            $('#inp-pie-ppr-first').val('10');
            $('#inp-pie-ppr-first').prev('.label-btn').html('Month 10');
            $('#inp-pie-ppr-last').val('12');
            $('#inp-pie-ppr-last').prev('.label-btn').html('Month 12');
        }
        pie_ppr_chart();
    }).on('click', '.pie-ppr-first', function () {
        var cls = $(this).attr('class');
        $('#inp-pie-ppr-last').val($(this).data('value'));
        $('#inp-pie-ppr-last').prev('.label-btn').html($(this).text());
        $('#inp-' + cls).val($(this).data('value'));
        $('#inp-' + cls).prev('.label-btn').html($(this).text());
        pie_ppr_chart();
    }).on('click', '.pie-ppr-last', function () {
        var cls = $(this).attr('class');
        if ($(this).data('value') < $('#inp-pie-ppr-first').val()) {
            showNoti('Tháng kết thúc không được nhỏ hơn tháng bắt đầu', 'Cảnh báo', 'War');
        } else {
            $('#inp-' + cls).val($(this).data('value'));
            $('#inp-' + cls).prev('.label-btn').html($(this).text());
            pie_ppr_chart();
        }
    }).on('click', '.bar-grps-year', function () {
        var cls = $(this).attr('class');
        $('#inp-' + cls).val($(this).data('value'));
        $('#inp-' + cls).prev('.label-btn').html($(this).data('value'));
        $('#inp-bar-grps-quarter').prev('.label-btn').html('Quarter');
        $('#inp-bar-grps-first').val('1');
        $('#inp-bar-grps-first').prev('.label-btn').html('Month 1');
        $('#inp-bar-grps-last').val('12');
        $('#inp-bar-grps-last').prev('.label-btn').html('Month 12');
        bar_grps_chart();
        bar_grps_table()
    }).on('click', '.bar-grps-quarter', function () {
        var cls = $(this).attr('class');
        $('#inp-' + cls).val($(this).data('value'));
        $('#inp-' + cls).prev('.label-btn').html($(this).text());
        var quarter = $(this).data('value');
        if (quarter == '1'){
            $('#inp-bar-grps-first').val('1');
            $('#inp-bar-grps-first').prev('.label-btn').html('Month 1');
            $('#inp-bar-grps-last').val('3');
            $('#inp-bar-grps-last').prev('.label-btn').html('Month 3');
        }else if (quarter == '2'){
            $('#inp-bar-grps-first').val('4');
            $('#inp-bar-grps-first').prev('.label-btn').html('Month 4');
            $('#inp-bar-grps-last').val('6');
            $('#inp-bar-grps-last').prev('.label-btn').html('Month 6');
        }
        else if (quarter == '3'){
            $('#inp-bar-grps-first').val('7');
            $('#inp-bar-grps-first').prev('.label-btn').html('Month 7');
            $('#inp-bar-grps-last').val('9');
            $('#inp-bar-grps-last').prev('.label-btn').html('Month 9');
        }
        else if (quarter == '4'){
            $('#inp-bar-grps-first').val('10');
            $('#inp-bar-grps-first').prev('.label-btn').html('Month 10');
            $('#inp-bar-grps-last').val('12');
            $('#inp-bar-grps-last').prev('.label-btn').html('Month 12');
        }
        bar_grps_chart();
        bar_grps_table()
    }).on('click', '.bar-grps-first', function () {
        var cls = $(this).attr('class');
        $('#inp-bar-grps-last').val($(this).data('value'));
        $('#inp-bar-grps-last').prev('.label-btn').html($(this).text());
        $('#inp-' + cls).val($(this).data('value'));
        $('#inp-' + cls).prev('.label-btn').html($(this).text());
        bar_grps_chart();
        bar_grps_table()
    }).on('click', '.bar-grps-last', function () {
        var cls = $(this).attr('class');
        if ($(this).data('value') < $('#inp-bar-grps-first').val()) {
            showNoti('Tháng kết thúc không được nhỏ hơn tháng bắt đầu', 'Cảnh báo', 'War');
        } else {
            $('#inp-' + cls).val($(this).data('value'));
            $('#inp-' + cls).prev('.label-btn').html($(this).text());
            bar_grps_chart();
            bar_grps_table()
        }
    }).on('click', '.pie-grps-year', function () {
        var cls = $(this).attr('class');
        $('#inp-' + cls).val($(this).data('value'));
        $('#inp-' + cls).prev('.label-btn').html($(this).data('value'));
        $('#inp-pie-grps-quarter').prev('.label-btn').html('Quarter');
        $('#inp-pie-grps-first').val('1');
        $('#inp-pie-grps-first').prev('.label-btn').html('Month 1');
        $('#inp-pie-grps-last').val('12');
        $('#inp-pie-grps-last').prev('.label-btn').html('Month 12');
        pie_grps_chart();
    }).on('click', '.pie-grps-quarter', function () {
        var cls = $(this).attr('class');
        $('#inp-' + cls).val($(this).data('value'));
        $('#inp-' + cls).prev('.label-btn').html($(this).text());
        var quarter = $(this).data('value');
        if (quarter == '1'){
            $('#inp-pie-grps-first').val('1');
            $('#inp-pie-grps-first').prev('.label-btn').html('Month 1');
            $('#inp-pie-grps-last').val('3');
            $('#inp-pie-grps-last').prev('.label-btn').html('Month 3');
        }else if (quarter == '2'){
            $('#inp-pie-grps-first').val('4');
            $('#inp-pie-grps-first').prev('.label-btn').html('Month 4');
            $('#inp-pie-grps-last').val('6');
            $('#inp-pie-grps-last').prev('.label-btn').html('Month 6');
        }
        else if (quarter == '3'){
            $('#inp-pie-grps-first').val('7');
            $('#inp-pie-grps-first').prev('.label-btn').html('Month 7');
            $('#inp-pie-grps-last').val('9');
            $('#inp-pie-grps-last').prev('.label-btn').html('Month 9');
        }
        else if (quarter == '4'){
            $('#inp-pie-grps-first').val('10');
            $('#inp-pie-grps-first').prev('.label-btn').html('Month 10');
            $('#inp-pie-grps-last').val('12');
            $('#inp-pie-grps-last').prev('.label-btn').html('Month 12');
        }
        pie_grps_chart();
    }).on('click', '.pie-grps-first', function () {
        var cls = $(this).attr('class');
        $('#inp-pie-grps-last').val($(this).data('value'));
        $('#inp-pie-grps-last').prev('.label-btn').html($(this).text());
        $('#inp-' + cls).val($(this).data('value'));
        $('#inp-' + cls).prev('.label-btn').html($(this).text());
        pie_grps_chart();
    }).on('click', '.pie-grps-last', function () {
        var cls = $(this).attr('class');
        if ($(this).data('value') < $('#inp-pie-grps-first').val()) {
            showNoti('Tháng kết thúc không được nhỏ hơn tháng bắt đầu', 'Cảnh báo', 'War');
        } else {
            $('#inp-' + cls).val($(this).data('value'));
            $('#inp-' + cls).prev('.label-btn').html($(this).text());
            pie_grps_chart();
        }
    }).on('click', '.bar-sr-year', function () {
        var cls = $(this).attr('class');
        $('#inp-' + cls).val($(this).data('value'));
        $('#inp-' + cls).prev('.label-btn').html($(this).data('value'));
        $('#inp-bar-sr-quarter').prev('.label-btn').html('Quarter');
        $('#inp-bar-sr-first').val('1');
        $('#inp-bar-sr-first').prev('.label-btn').html('Month 1');
        $('#inp-bar-sr-last').val('12');
        $('#inp-bar-sr-last').prev('.label-btn').html('Month 12');
        bar_sr_chart();
        table_sr_chart();
    }).on('click', '.bar-sr-quarter', function () {
        var cls = $(this).attr('class');
        $('#inp-' + cls).val($(this).data('value'));
        $('#inp-' + cls).prev('.label-btn').html($(this).text());
        var quarter = $(this).data('value');
        if (quarter == '1'){
            $('#inp-bar-sr-first').val('1');
            $('#inp-bar-sr-first').prev('.label-btn').html('Month 1');
            $('#inp-bar-sr-last').val('3');
            $('#inp-bar-sr-last').prev('.label-btn').html('Month 3');
        }else if (quarter == '2'){
            $('#inp-bar-sr-first').val('4');
            $('#inp-bar-sr-first').prev('.label-btn').html('Month 4');
            $('#inp-bar-sr-last').val('6');
            $('#inp-bar-sr-last').prev('.label-btn').html('Month 6');
        }
        else if (quarter == '3'){
            $('#inp-bar-sr-first').val('7');
            $('#inp-bar-sr-first').prev('.label-btn').html('Month 7');
            $('#inp-bar-sr-last').val('9');
            $('#inp-bar-sr-last').prev('.label-btn').html('Month 9');
        }
        else if (quarter == '4'){
            $('#inp-bar-sr-first').val('10');
            $('#inp-bar-sr-first').prev('.label-btn').html('Month 10');
            $('#inp-bar-sr-last').val('12');
            $('#inp-bar-sr-last').prev('.label-btn').html('Month 12');
        }
        bar_sr_chart();
        table_sr_chart();
    }).on('click', '.bar-sr-first', function () {
        var cls = $(this).attr('class');
        $('#inp-bar-sr-last').val($(this).data('value'));
        $('#inp-bar-sr-last').prev('.label-btn').html($(this).text());
        $('#inp-' + cls).val($(this).data('value'));
        $('#inp-' + cls).prev('.label-btn').html($(this).text());
        bar_sr_chart();
    }).on('click', '.bar-sr-last', function () {
        var cls = $(this).attr('class');
        if ($(this).data('value') < $('#inp-bar-sr-first').val()) {
            showNoti('Tháng kết thúc không được nhỏ hơn tháng bắt đầu', 'Cảnh báo', 'War');
        } else {
            $('#inp-' + cls).val($(this).data('value'));
            $('#inp-' + cls).prev('.label-btn').html($(this).text());
            bar_sr_chart();
        }
    }).on('click', '.pie-sr-year', function () {
        var cls = $(this).attr('class');
        $('#inp-' + cls).val($(this).data('value'));
        $('#inp-' + cls).prev('.label-btn').html($(this).data('value'));
        pie_sr_chart();
    }).on('click', '.pie-sr-quarter', function () {
        var cls = $(this).attr('class');
        $('#inp-' + cls).val($(this).data('value'));
        $('#inp-' + cls).prev('.label-btn').html($(this).text());
        var quarter = $(this).data('value');
        if (quarter == '1'){
            $('#inp-pie-sr-month-first').val('1');
            $('#inp-pie-sr-month-first').prev('.label-btn').html('Month 1');
            $('#inp-pie-sr-month-last').val('3');
            $('#inp-pie-sr-month-last').prev('.label-btn').html('Month 3');
        }else if (quarter == '2'){
            $('#inp-pie-sr-month-first').val('4');
            $('#inp-pie-sr-month-first').prev('.label-btn').html('Month 4');
            $('#inp-pie-sr-month-last').val('6');
            $('#inp-pie-sr-month-last').prev('.label-btn').html('Month 6');
        }
        else if (quarter == '3'){
            $('#inp-pie-sr-month-first').val('7');
            $('#inp-pie-sr-month-first').prev('.label-btn').html('Month 7');
            $('#inp-pie-sr-month-last').val('9');
            $('#inp-pie-sr-month-last').prev('.label-btn').html('Month 9');
        }
        else if (quarter == '4'){
            $('#inp-pie-sr-month-first').val('10');
            $('#inp-pie-sr-month-first').prev('.label-btn').html('Month 10');
            $('#inp-pie-sr-month-last').val('12');
            $('#inp-pie-sr-month-last').prev('.label-btn').html('Month 12');
        }
        pie_sr_chart();
    }).on('click', '.pie-sr-month-first', function () {
        var cls = $(this).attr('class');
        // $('#inp-pie-sr-month-last').val($(this).data('value'));
        // $('#inp-pie-sr-month-last').prev('.label-btn').html($(this).text());
        $('#inp-' + cls).val($(this).data('value'));
        $('#inp-' + cls).prev('.label-btn').html($(this).text());
        pie_sr_chart();
    }).on('click', '.pie-sr-month-last', function () {
        var cls = $(this).attr('class');
        if ($(this).data('value') < $('#inp-pie-sr-month-first').val()) {
            showNoti('Tháng kết thúc không được nhỏ hơn tháng bắt đầu', 'Cảnh báo', 'War');
        } else {
            $('#inp-' + cls).val($(this).data('value'));
            $('#inp-' + cls).prev('.label-btn').html($(this).text());
            pie_sr_chart();
        }
    }).on('click', '.bar-spr-year', function () {
        var cls = $(this).attr('class');
        $('#inp-' + cls).val($(this).data('value'));
        $('#inp-' + cls).prev('.label-btn').html($(this).data('value'));
        bar_spr_chart();
    }).on('click', '.bar-spr-quarter', function () {
        var cls = $(this).attr('class');
        $('#inp-' + cls).val($(this).data('value'));
        $('#inp-' + cls).prev('.label-btn').html($(this).text());
        var quarter = $(this).data('value');
        if (quarter == '1'){
            $('#inp-bar-spr-first').val('1');
            $('#inp-bar-spr-first').prev('.label-btn').html('Month 1');
            $('#inp-bar-spr-last').val('3');
            $('#inp-bar-spr-last').prev('.label-btn').html('Month 3');
        }else if (quarter == '2'){
            $('#inp-bar-spr-first').val('4');
            $('#inp-bar-spr-first').prev('.label-btn').html('Month 4');
            $('#inp-bar-spr-last').val('6');
            $('#inp-bar-spr-last').prev('.label-btn').html('Month 6');
        }
        else if (quarter == '3'){
            $('#inp-bar-spr-first').val('7');
            $('#inp-bar-spr-first').prev('.label-btn').html('Month 7');
            $('#inp-bar-spr-last').val('9');
            $('#inp-bar-spr-last').prev('.label-btn').html('Month 9');
        }
        else if (quarter == '4'){
            $('#inp-bar-spr-first').val('10');
            $('#inp-bar-spr-first').prev('.label-btn').html('Month 10');
            $('#inp-bar-spr-last').val('12');
            $('#inp-bar-spr-last').prev('.label-btn').html('Month 12');
        }
        bar_spr_chart();
    }).on('click', '.bar-spr-first', function () {
        var cls = $(this).attr('class');
        $('#inp-bar-spr-last').val($(this).data('value'));
        $('#inp-bar-spr-last').prev('.label-btn').html($(this).text());
        $('#inp-' + cls).val($(this).data('value'));
        $('#inp-' + cls).prev('.label-btn').html($(this).text());
        bar_spr_chart();
    }).on('click', '.bar-spr-last', function () {
        var cls = $(this).attr('class');
        if ($(this).data('value') < $('#inp-bar-spr-first').val()) {
            showNoti('Tháng kết thúc không được nhỏ hơn tháng bắt đầu', 'Cảnh báo', 'War');
        } else {
            $('#inp-' + cls).val($(this).data('value'));
            $('#inp-' + cls).prev('.label-btn').html($(this).text());
            bar_spr_chart();
        }
    }).on('click', '.pie-spr-year', function () {
        var cls = $(this).attr('class');
        $('#inp-' + cls).val($(this).data('value'));
        $('#inp-' + cls).prev('.label-btn').html($(this).data('value'));
        pie_spr_chart();
    }).on('click', '.pie-spr-quarter', function () {
        var cls = $(this).attr('class');
        $('#inp-' + cls).val($(this).data('value'));
        $('#inp-' + cls).prev('.label-btn').html($(this).text());
        var quarter = $(this).data('value');
        if (quarter == '1'){
            $('#inp-pie-spr-first').val('1');
            $('#inp-pie-spr-first').prev('.label-btn').html('Month 1');
            $('#inp-pie-spr-last').val('3');
            $('#inp-pie-spr-last').prev('.label-btn').html('Month 3');
        }else if (quarter == '2'){
            $('#inp-pie-spr-first').val('4');
            $('#inp-pie-spr-first').prev('.label-btn').html('Month 4');
            $('#inp-pie-spr-last').val('6');
            $('#inp-pie-spr-last').prev('.label-btn').html('Month 6');
        }
        else if (quarter == '3'){
            $('#inp-pie-spr-first').val('7');
            $('#inp-pie-spr-first').prev('.label-btn').html('Month 7');
            $('#inp-pie-spr-last').val('9');
            $('#inp-pie-spr-last').prev('.label-btn').html('Month 9');
        }
        else if (quarter == '4'){
            $('#inp-pie-spr-first').val('10');
            $('#inp-pie-spr-first').prev('.label-btn').html('Month 10');
            $('#inp-pie-spr-last').val('12');
            $('#inp-pie-spr-last').prev('.label-btn').html('Month 12');
        }
        pie_spr_chart();
    }).on('click', '.pie-spr-first', function () {
        var cls = $(this).attr('class');
        $('#inp-pie-spr-last').val($(this).data('value'));
        $('#inp-pie-spr-last').prev('.label-btn').html($(this).text());
        $('#inp-' + cls).val($(this).data('value'));
        $('#inp-' + cls).prev('.label-btn').html($(this).text());
        pie_spr_chart();
    }).on('click', '.pie-spr-last', function () {
        var cls = $(this).attr('class');
        if ($(this).data('value') < $('#inp-pie-spr-first').val()) {
            showNoti('Tháng kết thúc không được nhỏ hơn tháng bắt đầu', 'Cảnh báo', 'War');
        } else {
            $('#inp-' + cls).val($(this).data('value'));
            $('#inp-' + cls).prev('.label-btn').html($(this).text());
            pie_spr_chart();
        }
    }).on('click', '.bar-srps-year', function () {
        var cls = $(this).attr('class');
        $('#inp-' + cls).val($(this).data('value'));
        $('#inp-' + cls).prev('.label-btn').html($(this).data('value'));
        $('#inp-bar-srps-quarter').prev('.label-btn').html('Quarter');
        $('#inp-bar-srps-first').val('1');
        $('#inp-bar-srps-first').prev('.label-btn').html('Month 1');
        $('#inp-bar-srps-last').val('12');
        $('#inp-bar-srps-last').prev('.label-btn').html('Month 12');
        bar_srps_chart();
        table_srps_chart();
    }).on('click', '.bar-srps-quarter', function () {
        var cls = $(this).attr('class');
        $('#inp-' + cls).val($(this).data('value'));
        $('#inp-' + cls).prev('.label-btn').html($(this).text());
        var quarter = $(this).data('value');
        if (quarter == '1'){
            $('#inp-bar-srps-first').val('1');
            $('#inp-bar-srps-first').prev('.label-btn').html('Month 1');
            $('#inp-bar-srps-last').val('3');
            $('#inp-bar-srps-last').prev('.label-btn').html('Month 3');
        }else if (quarter == '2'){
            $('#inp-bar-srps-first').val('4');
            $('#inp-bar-srps-first').prev('.label-btn').html('Month 4');
            $('#inp-bar-srps-last').val('6');
            $('#inp-bar-srps-last').prev('.label-btn').html('Month 6');
        }
        else if (quarter == '3'){
            $('#inp-bar-srps-first').val('7');
            $('#inp-bar-srps-first').prev('.label-btn').html('Month 7');
            $('#inp-bar-srps-last').val('9');
            $('#inp-bar-srps-last').prev('.label-btn').html('Month 9');
        }
        else if (quarter == '4'){
            $('#inp-bar-srps-first').val('10');
            $('#inp-bar-srps-first').prev('.label-btn').html('Month 10');
            $('#inp-bar-srps-last').val('12');
            $('#inp-bar-srps-last').prev('.label-btn').html('Month 12');
        }
        bar_srps_chart();
        table_srps_chart();
    }).on('click', '.bar-srps-first', function () {
        var cls = $(this).attr('class');
        $('#inp-bar-srps-last').val($(this).data('value'));
        $('#inp-bar-srps-last').prev('.label-btn').html($(this).text());
        $('#inp-' + cls).val($(this).data('value'));
        $('#inp-' + cls).prev('.label-btn').html($(this).text());
        bar_srps_chart();
        table_srps_chart();
    }).on('click', '.bar-srps-last', function () {
        var cls = $(this).attr('class');
        if ($(this).data('value') < $('#inp-bar-srps-first').val()) {
            showNoti('Tháng kết thúc không được nhỏ hơn tháng bắt đầu', 'Cảnh báo', 'War');
        } else {
            $('#inp-' + cls).val($(this).data('value'));
            $('#inp-' + cls).prev('.label-btn').html($(this).text());
            bar_srps_chart();
            table_srps_chart();
        }
    }).on('click', '.pie-srps-year', function () {
        var cls = $(this).attr('class');
        $('#inp-' + cls).val($(this).data('value'));
        $('#inp-' + cls).prev('.label-btn').html($(this).data('value'));
        pie_srps_chart();
    }).on('click', '.pie-srps-quarter', function () {
        var cls = $(this).attr('class');
        $('#inp-' + cls).val($(this).data('value'));
        $('#inp-' + cls).prev('.label-btn').html($(this).text());
        var quarter = $(this).data('value');
        if (quarter == '1'){
            $('#inp-pie-srps-first').val('1');
            $('#inp-pie-srps-first').prev('.label-btn').html('Month 1');
            $('#inp-pie-srps-last').val('3');
            $('#inp-pie-srps-last').prev('.label-btn').html('Month 3');
        }else if (quarter == '2'){
            $('#inp-pie-srps-first').val('4');
            $('#inp-pie-srps-first').prev('.label-btn').html('Month 4');
            $('#inp-pie-srps-last').val('6');
            $('#inp-pie-srps-last').prev('.label-btn').html('Month 6');
        }
        else if (quarter == '3'){
            $('#inp-pie-srps-first').val('7');
            $('#inp-pie-srps-first').prev('.label-btn').html('Month 7');
            $('#inp-pie-srps-last').val('9');
            $('#inp-pie-srps-last').prev('.label-btn').html('Month 9');
        }
        else if (quarter == '4'){
            $('#inp-pie-srps-first').val('10');
            $('#inp-pie-srps-first').prev('.label-btn').html('Month 10');
            $('#inp-pie-srps-last').val('12');
            $('#inp-pie-srps-last').prev('.label-btn').html('Month 12');
        }
        pie_srps_chart();
    }).on('click', '.pie-srps-first', function () {
        var cls = $(this).attr('class');
        $('#inp-pie-srps-last').val($(this).data('value'));
        $('#inp-pie-srps-last').prev('.label-btn').html($(this).text());
        $('#inp-' + cls).val($(this).data('value'));
        $('#inp-' + cls).prev('.label-btn').html($(this).text());
        pie_srps_chart();
    }).on('click', '.pie-srps-last', function () {
        var cls = $(this).attr('class');
        if ($(this).data('value') < $('#inp-pie-srps-first').val()) {
            showNoti('Tháng kết thúc không được nhỏ hơn tháng bắt đầu', 'Cảnh báo', 'War');
        } else {
            $('#inp-' + cls).val($(this).data('value'));
            $('#inp-' + cls).prev('.label-btn').html($(this).text());
            pie_srps_chart();
        }
    })

    // Purchasing Report Per Staff
    $('body').on('click', '.bar-sup-rev', function () {
        var cls = $(this).attr('class');
        $('#inp-' + cls).val($(this).data('value'));
        $('#inp-' + cls).prev('.label-btn').html($(this).data('value'));
        $('#inp-bar-sup-rev-quarter').prev('.label-btn').html('Quarter');
        $('#inp-bar-sup-rev-first').val('1');
        $('#inp-bar-sup-rev-first').prev('.label-btn').html('Month 1');
        $('#inp-bar-sup-rev-last').val('12');
        $('#inp-bar-sup-rev-last').prev('.label-btn').html('Month 12');
        bar_chart_sup_rev();
        bar_chart_table_sup_rev();
    }).on('click', '.bar-sup-rev-quarter', function () {
        var cls = $(this).attr('class');
        $('#inp-' + cls).val($(this).data('value'));
        $('#inp-' + cls).prev('.label-btn').html($(this).text());
        var quarter = $(this).data('value');
        if (quarter == '1'){
            $('#inp-bar-sup-rev-first').val('1');
            $('#inp-bar-sup-rev-first').prev('.label-btn').html('Month 1');
            $('#inp-bar-sup-rev-last').val('3');
            $('#inp-bar-sup-rev-last').prev('.label-btn').html('Month 3');
        }else if (quarter == '2'){
            $('#inp-bar-first').val('4');
            $('#inp-bar-first').prev('.label-btn').html('Month 4');
            $('#inp-bar-last').val('6');
            $('#inp-bar-last').prev('.label-btn').html('Month 6');
        }
        else if (quarter == '3'){
            $('#inp-bar-sup-rev-first').val('7');
            $('#inp-bar-sup-rev-first').prev('.label-btn').html('Month 7');
            $('#inp-bar-sup-rev-last').val('9');
            $('#inp-bar-sup-rev-last').prev('.label-btn').html('Month 9');
        }
        else if (quarter == '4'){
            $('#inp-bar-sup-rev-first').val('10');
            $('#inp-bar-sup-rev-first').prev('.label-btn').html('Month 10');
            $('#inp-bar-sup-rev-last').val('12');
            $('#inp-bar-sup-rev-last').prev('.label-btn').html('Month 12');
        }
        bar_chart_sup_rev();
        bar_chart_table_sup_rev();
    }).on('click', '.bar-sup-rev-first', function () {
        var cls = $(this).attr('class');
        $('#inp-bar-sup-rev-last').val($(this).data('value'));
        $('#inp-bar-sup-rev-last').prev('.label-btn').html($(this).text());
        $('#inp-' + cls).val($(this).data('value'));
        $('#inp-' + cls).prev('.label-btn').html($(this).text());
        bar_chart_sup_rev();
        bar_chart_table_sup_rev();
    }).on('click', '.bar-sup-rev-last', function () {
        var cls = $(this).attr('class');
        if ($(this).data('value') < $('#inp-bar-sup-rev-first').val()) {
            showNoti('Tháng kết thúc không được nhỏ hơn tháng bắt đầu', 'Cảnh báo', 'War');
        } else {
            $('#inp-' + cls).val($(this).data('value'));
            $('#inp-' + cls).prev('.label-btn').html($(this).text());
            bar_chart_sup_rev();
            bar_chart_table_sup_rev();
        }
    }).on('click', '.pie-sup-rev-year', function () {
        var cls = $(this).attr('class');
        $('#inp-' + cls).val($(this).data('value'));
        $('#inp-' + cls).prev('.label-btn').html($(this).data('value'));
        $('#inp-pie-sup-rev-quarter').prev('.label-btn').html('Quarter');
        $('#inp-pie-sup-rev-month-first').val('1');
        $('#inp-pie-sup-rev-month-first').prev('.label-btn').html('Month 1');
        $('#inp-pie-sup-rev-month-last').val('12');
        $('#inp-pie-sup-rev-month-last').prev('.label-btn').html('Month 12');
        pie_chart_sup_rev();
    }).on('click', '.pie-sup-rev-quarter', function () {
        var cls = $(this).attr('class');
        $('#inp-' + cls).val($(this).data('value'));
        $('#inp-' + cls).prev('.label-btn').html($(this).text());
        var quarter = $(this).data('value');
        if (quarter == '1'){
            $('#inp-pie-sup-rev-month-first').val('1');
            $('#inp-pie-sup-rev-month-first').prev('.label-btn').html('Month 1');
            $('#inp-pie-sup-rev-month-last').val('3');
            $('#inp-pie-sup-rev-month-last').prev('.label-btn').html('Month 3');
        }else if (quarter == '2'){
            $('#inp-pie-sup-rev-month-first').val('4');
            $('#inp-pie-sup-rev-month-first').prev('.label-btn').html('Month 4');
            $('#inp-pie-sup-rev-month-last').val('6');
            $('#inp-pie-sup-rev-month-last').prev('.label-btn').html('Month 6');
        }
        else if (quarter == '3'){
            $('#inp-pie-sup-rev-month-first').val('7');
            $('#inp-pie-sup-rev-month-first').prev('.label-btn').html('Month 7');
            $('#inp-pie-sup-rev-month-last').val('9');
            $('#inp-pie-sup-rev-month-last').prev('.label-btn').html('Month 9');
        }
        else if (quarter == '4'){
            $('#inp-pie-sup-rev-month-first').val('10');
            $('#inp-pie-sup-rev-month-first').prev('.label-btn').html('Month 10');
            $('#inp-pie-sup-rev-month-last').val('12');
            $('#inp-pie-sup-rev-month-last').prev('.label-btn').html('Month 12');
        }
        pie_chart_sup_rev();
    }).on('click', '.pie-sup-rev-month-first', function () {
        var cls = $(this).attr('class');
        $('#inp-pie-sup-rev-month-last').val($(this).data('value'));
        $('#inp-pie-sup-rev-month-last').prev('.label-btn').html($(this).text());
        $('#inp-' + cls).val($(this).data('value'));
        $('#inp-' + cls).prev('.label-btn').html($(this).text());
        pie_chart_sup_rev();
    }).on('click', '.pie-sup-rev-month-last', function () {
        var cls = $(this).attr('class');
        if ($(this).data('value') < $('#inp-pie-sup-rev-month-first').val()) {
            showNoti('Tháng kết thúc không được nhỏ hơn tháng bắt đầu', 'Cảnh báo', 'War');
        } else {
            $('#inp-' + cls).val($(this).data('value'));
            $('#inp-' + cls).prev('.label-btn').html($(this).text());
            pie_chart_sup_rev();
        }
    }).on('click', '.margin-tab', function () {
        bar_chart_sup_rev();bar_chart_table_sup_rev();pie_chart_sup_rev();
    })

    //Purchasing Report Per Staff


    // Supplier Revenue

    $('body').on('click', '.bar-sup', function () {
        var cls = $(this).attr('class');
        $('#inp-' + cls).val($(this).data('value'));
        $('#inp-' + cls).prev('.label-btn').html($(this).data('value'));
        $('#inp-sup-quarter').prev('.label-btn').html('Quarter');
        $('#inp-sup-first').val('1');
        $('#inp-sup-first').prev('.label-btn').html('Month 1');
        $('#inp-sup-last').val('12');
        $('#inp-sup-last').prev('.label-btn').html('Month 12');
        bar_chart_sup();
        bar_chart_table_sup();
    }).on('click', '.bar-sup-quarter', function () {
        var cls = $(this).attr('class');
        $('#inp-' + cls).val($(this).data('value'));
        $('#inp-' + cls).prev('.label-btn').html($(this).text());
        var quarter = $(this).data('value');
        if (quarter == '1'){
            $('#inp-sup-first').val('1');
            $('#inp-sup-first').prev('.label-btn').html('Month 1');
            $('#inp-sup-last').val('3');
            $('#inp-sup-last').prev('.label-btn').html('Month 3');
        }else if (quarter == '2'){
            $('#inp-sup-first').val('4');
            $('#inp-sup-first').prev('.label-btn').html('Month 4');
            $('#inp-sup-last').val('6');
            $('#inp-sup-last').prev('.label-btn').html('Month 6');
        }
        else if (quarter == '3'){
            $('#inp-sup-first').val('7');
            $('#inp-sup-first').prev('.label-btn').html('Month 7');
            $('#inp-sup-last').val('9');
            $('#inp-sup-last').prev('.label-btn').html('Month 9');
        }
        else if (quarter == '4'){
            $('#inp-sup-first').val('10');
            $('#inp-sup-first').prev('.label-btn').html('Month 10');
            $('#inp-sup-last').val('12');
            $('#inp-sup-last').prev('.label-btn').html('Month 12');
        }
        bar_chart_sup();
        bar_chart_table_sup();
    }).on('click', '.bar-sup-first', function () {
        var cls = $(this).attr('class');
        $('#inp-sup-last').val($(this).data('value'));
        $('#inp-sup-last').prev('.label-btn').html($(this).text());
        $('#inp-' + cls).val($(this).data('value'));
        $('#inp-' + cls).prev('.label-btn').html($(this).text());
        bar_chart_sup();
        bar_chart_table_sup();
    }).on('click', '.bar-sup-last', function () {
        var cls = $(this).attr('class');
        if ($(this).data('value') < $('#inp -sup-first').val()) {
            showNoti('Tháng kết thúc không được nhỏ hơn tháng bắt đầu', 'Cảnh báo', 'War');
        } else {
            $('#inp-' + cls).val($(this).data('value'));
            $('#inp-' + cls).prev('.label-btn').html($(this).text());
            bar_chart_sup();
            bar_chart_table_sup();
        }
    }).on('click', '.pie-sup-year', function () {
        var cls = $(this).attr('class');
        $('#inp-' + cls).val($(this).data('value'));
        $('#inp-' + cls).prev('.label-btn').html($(this).data('value'));
        $('#inp-pie-sup-quarter').prev('.label-btn').html('Quarter');
        $('#inp-pie-sup-first').val('1');
        $('#inp-pie-sup-first').prev('.label-btn').html('Month 1');
        $('#inp-pie-sup-last').val('12');
        $('#inp-pie-sup-last').prev('.label-btn').html('Month 12');
        pie_chart_sup();
    }).on('click', '.pie-sup-quarter', function () {
        var cls = $(this).attr('class');
        $('#inp-' + cls).val($(this).data('value'));
        $('#inp-' + cls).prev('.label-btn').html($(this).text());
        var quarter = $(this).data('value');
        if (quarter == '1'){
            $('#inp-pie-sup-first').val('1');
            $('#inp-pie-sup-first').prev('.label-btn').html('Month 1');
            $('#inp-pie-sup-last').val('3');
            $('#inp-pie-sup-last').prev('.label-btn').html('Month 3');
        }else if (quarter == '2'){
            $('#inp-pie-sup-first').val('4');
            $('#inp-pie-sup-first').prev('.label-btn').html('Month 4');
            $('#inp-pie-sup-last').val('6');
            $('#inp-pie-sup-last').prev('.label-btn').html('Month 6');
        }
        else if (quarter == '3'){
            $('#inp-pie-sup-first').val('7');
            $('#inp-pie-sup-first').prev('.label-btn').html('Month 7');
            $('#inp-pie-sup-last').val('9');
            $('#inp-pie-sup-last').prev('.label-btn').html('Month 9');
        }
        else if (quarter == '4'){
            $('#inp-pie-sup-first').val('10');
            $('#inp-pie-sup-first').prev('.label-btn').html('Month 10');
            $('#inp-pie-sup-last').val('12');
            $('#inp-pie-sup-last').prev('.label-btn').html('Month 12');
        }
        pie_chart_sup();
    }).on('click', '.pie-sup-first', function () {
        var cls = $(this).attr('class');
        $('#inp-pie-sup-last').val($(this).data('value'));
        $('#inp-pie-sup-last').prev('.label-btn').html($(this).text());
        $('#inp-' + cls).val($(this).data('value'));
        $('#inp-' + cls).prev('.label-btn').html($(this).text());
        pie_chart_sup();
    }).on('click', '.pie-sup-last', function () {
        var cls = $(this).attr('class');
        if ($(this).data('value') < $('#inp-pie-sup-first').val()) {
            showNoti('Tháng kết thúc không được nhỏ hơn tháng bắt đầu', 'Cảnh báo', 'War');
        } else {
            $('#inp-' + cls).val($(this).data('value'));
            $('#inp-' + cls).prev('.label-btn').html($(this).text());
            pie_chart_sup();
        }
    }).on('click', '.sup_rev', function () {
        bar_chart_sup();
        bar_chart_table_sup();
        pie_chart_sup();
    })
    //



    bar_chart();
    pie_chart();
    bar_ppr_chart();
    table_sr_chart();
    pie_ppr_chart();
    bar_grps_chart();
    pie_grps_chart();
    bar_ppr_table();
    bar_grps_table();
    bar_chart_table();
    if ($('#bar-sr-container').length) {
        bar_sr_chart();
    }
    pie_sr_chart();
    bar_spr_chart();
    pie_spr_chart();
    bar_srps_chart();
    table_srps_chart();
    pie_srps_chart();


})
/* Purchasing report chart */

function bar_chart() {
    var year = $('#inp-bar-year').val();
    var mf = $('#inp-bar-first').val();
    var ml = $('#inp-bar-last').val();
    $.ajax({
        url: site_url + 'purchasing_report/bar_chart_month',
        type: 'POST',
        cache: false,
        data: {
            year: year,
            mf: mf,
            ml: ml
        },
        success: function (string) {
            if (isJSON(string)) {
                var getData = $.parseJSON(string);
                if ($('#bar-container').length) {
                    $('#bar-container').highcharts({
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'Thống kê từ tháng ' + getData.mf + (getData.mf == getData.ml ? '' : ' đến tháng ' + getData.ml) + ' năm ' + getData.year
                        },
                        subtitle: {
                            text: 'Source: atckit.com'
                        },
                        xAxis: {
                            labels: {
                                enabled: false
                            }
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'Amount (USD)'
                            }
                        },
                        plotOptions: {
                            series: {
                                pointWidth: 30,
                                borderWidth: 0,
                                dataLabels: {
                                    enabled: true,
                                    formatter: function() {
                                        if (this.y > 1000000000) {
                                            return Highcharts.numberFormat(this.y /  1000000000, 2) + "G"
                                        } else if (this.y > 1000000) {
                                            return Highcharts.numberFormat(this.y / 1000000, 2) + "M";
                                        } else if (this.y > 1000) {
                                            return Highcharts.numberFormat(this.y / 1000, 2) + "K";
                                        }
                                        else {
                                            return this.y
                                        }
                                    },
                                }
                            },
                            column: {
                                pointPadding: 0.2,
                                borderWidth: 0
                            }
                        },
                        series: getData.series,
                    });
                }
            }
        }
    })
}
function pie_chart() {
    var year = $('#inp-pie-year').val();
    var monthFirst = $('#inp-pie-month-first').val();
    var monthLast = $('#inp-pie-month-last').val();
    $.ajax({
        url: site_url + 'purchasing_report/pie_chart',
        type: 'POST',
        cache: false,
        data: {
            year: year,
            monthFirst: monthFirst,
            monthLast: monthLast
        },
        success: function (string) {
            if (isJSON(string)) {
                var getData = $.parseJSON(string);
                if ($('#pie-container').length) {
                    $('#pie-container').highcharts({
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        colors: getData.color,
                        title: {
                            text: 'Thống kê từ tháng' + getData.monthFirst + (getData.monthFirst == getData.monthLast ? '' : ' đến tháng ' + getData.monthLast) + ' năm ' + getData.year
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                    style: {
                                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                    }
                                }
                            },
                            /*series: {
                                cursor: 'pointer',
                                point: {
                                    events: {
                                        click: function() {
                                            $('#modal-pie-chart-detail').modal('show').find('.modal-body').html('Vendor Number ' + this.name.split('-')[0] + ' từ tháng ' + getData.monthFirst + (getData.monthLast == getData.monthFirst ? '' : ' đến tháng ' + getData.monthLast) + ' năm ' + getData.year);
                                        }
                                    }
                                }
                            }*/
                        },
                        series: [{
                            name: 'Brands',
                            colorByPoint: true,
                            data: getData.series
                        }]
                    });
                }
            }
        }
    })
}

/* #Purchasing report chart */

/* Purchasing part report */

function bar_ppr_chart() {
    var year = $('#inp-bar-ppr-year').val();
    var mf = $('#inp-bar-ppr-first').val();
    var ml = $('#inp-bar-ppr-last').val();
    $.ajax({
        url: site_url + 'purchasing_part_report/bar_ppr_chart',
        type: 'POST',
        cache: false,
        data: {
            year: year,
            mf: mf,
            ml: ml
        },
        success: function (string) {
            if (isJSON(string)) {
                var getData = $.parseJSON(string);
                // console.log(getData.categories);
                // console.log(getData.series);
                if ($('#bar-ppr-container').length) {
                    $('#bar-ppr-container').highcharts({
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'Thống kê từ tháng ' + getData.mf + (getData.mf == getData.ml ? '' : ' đến tháng ' + getData.ml) + ' năm ' + getData.year
                        },
                        subtitle: {
                            text: 'Source: atckit.com'
                        },
                        xAxis: {
                            categories: getData.categories,
                            crosshair: true
                        },
                        yAxis: {
                            title: {
                                text: 'Amount (USD)'
                            }
                        },
                        plotOptions: {
                            series: {
                                pointWidth: 20,
                                borderWidth: 0,
                                dataLabels: {
                                    enabled: true,
                                    formatter: function() {
                                        if (this.y > 1000000000) {
                                            return Highcharts.numberFormat(this.y /  1000000000, 2) + "G"
                                        } else if (this.y > 1000000) {
                                            return Highcharts.numberFormat(this.y / 1000000, 2) + "M";
                                        } else if (this.y > 1000) {
                                            return Highcharts.numberFormat(this.y / 1000, 2) + "K";
                                        }
                                        else {
                                            return this.y
                                        }
                                    }
                                }
                            },
                            column: {
                                pointPadding: 0.2,
                                borderWidth: 0
                            }
                        },
                        series: getData.series,
                    });
                }
            }
        }
    })
}

function pie_ppr_chart() {
    var year = $('#inp-pie-ppr-year').val();
    var mf = $('#inp-pie-ppr-first').val();
    var ml = $('#inp-pie-ppr-last').val();
    $.ajax({
        url: site_url + 'purchasing_part_report/pie_ppr_chart',
        type: 'POST',
        cache: false,
        data: {
            year: year,
            mf: mf,
            ml: ml
        },
        success: function (string) {
            if (isJSON(string)) {
                var getData = $.parseJSON(string);
                if ($('#pie-ppr-container').length) {
                    $('#pie-ppr-container').highcharts({
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                            text: 'Thống kê từ tháng ' + getData.mf + (getData.mf == getData.ml ? '' : ' đến tháng ' + getData.ml) + ' năm ' + getData.year
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                    style: {
                                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                    }
                                }
                            },
                        },
                        series: [{
                            name: 'Brands',
                            colorByPoint: true,
                            data: getData.series
                        }]
                    });
                }
            }
        }
    })
}

/* #Purchasing part report */

/* Gross revenue per staff */

function bar_grps_chart() {
    var year = $('#inp-bar-grps-year').val();
    var mf = $('#inp-bar-grps-first').val();
    var ml = $('#inp-bar-grps-last').val();
    $.ajax({
        url: site_url + 'gross_revenue_per_staff/bar_grps_chart',
        type: 'POST',
        cache: false,
        data: {
            year: year,
            mf: mf,
            ml: ml
        },
        success: function (string) {
            if (isJSON(string)) {
                var getData = $.parseJSON(string);
                // console.log(getData.categories);
                // console.log(getData.series);
                if ($('#bar-grps-container').length) {
                    $('#bar-grps-container').highcharts({
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'Thống kê từ tháng ' + getData.mf + (getData.mf == getData.ml ? '' : ' đến tháng ' + getData.ml) + ' năm ' + getData.year
                        },
                        subtitle: {
                            text: 'Source: atckit.com'
                        },
                        xAxis: {
                            categories: getData.categories,
                            crosshair: true
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'Amount (USD)'
                            }
                        },
                        plotOptions: {
                            series: {
                                pointWidth: 30,
                                borderWidth: 0,
                                dataLabels: {
                                    enabled: true,
                                    formatter: function() {
                                        if (this.y > 1000000000) {
                                            return Highcharts.numberFormat(this.y /  1000000000, 2) + "G"
                                        } else if (this.y > 1000000) {
                                            return Highcharts.numberFormat(this.y / 1000000, 2) + "M";
                                        } else if (this.y > 1000) {
                                            return Highcharts.numberFormat(this.y / 1000, 2) + "K";
                                        }
                                        else {
                                            return this.y
                                        }
                                    }
                                }
                            },
                            column: {
                                pointPadding: 0.2,
                                borderWidth: 0
                            }
                        },
                        series: getData.series,
                    });
                }
            }
        }
    })
}

function pie_grps_chart() {
    var year = $('#inp-pie-grps-year').val();
    var mf = $('#inp-pie-grps-first').val();
    var ml = $('#inp-pie-grps-last').val();
    $.ajax({
        url: site_url + 'gross_revenue_per_staff/pie_grps_chart',
        type: 'POST',
        cache: false,
        data: {
            year: year,
            mf: mf,
            ml: ml
        },
        success: function (string) {
            if (isJSON(string)) {
                var getData = $.parseJSON(string);
                if ($('#pie-grps-container').length) {
                    $('#pie-grps-container').highcharts({
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                            text: 'Thống kê từ tháng ' + getData.mf + (getData.mf == getData.ml ? '' : ' đến tháng ' + getData.ml) + ' năm ' + getData.year
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                    style: {
                                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                    }
                                }
                            },
                        },
                        series: [{
                            name: 'Brands',
                            colorByPoint: true,
                            data: getData.series
                        }]
                    });
                }
            }
        }
    })
}

/* #Gross revenue per staff */

/* Sales report chart */

function bar_sr_chart() {
    var year = $('#inp-bar-sr-year').val();
    var mf = $('#inp-bar-sr-first').val();
    var ml = $('#inp-bar-sr-last').val();
    $.ajax({
        url: site_url + 'sales_report/bar_sr_chart',
        type: 'POST',
        cache: false,
        data: {
            year: year,
            mf: mf,
            ml: ml
        },
        success: function (string) {
            if (isJSON(string)) {
                var getData = $.parseJSON(string);
                console.log(getData.table);
                if ($('#bar-sr-container').length) {
                    $('#bar-sr-container').highcharts({
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'Thống kê từ tháng ' + getData.mf + (getData.mf == getData.ml ? '' : ' đến tháng ' + getData.ml) + ' năm ' + getData.year
                        },
                        subtitle: {
                            text: 'Source: atckit.com'
                        },
                        xAxis: {
                            labels: {
                                enabled: false
                            }
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'Amount (VND)'
                            }
                        },
                        plotOptions: {
                            series: {
                                pointWidth: 30,
                                borderWidth: 0,
                                dataLabels: {
                                    enabled: true,
                                    formatter: function() {
                                        if (this.y > 1000000000) {
                                            return Highcharts.numberFormat(this.y /  1000000000, 2) + "G"
                                        } else if (this.y > 1000000) {
                                            return Highcharts.numberFormat(this.y / 1000000, 2) + "M";
                                        } else {
                                            return this.y
                                        }
                                    }
                                }
                            },
                            column: {
                                pointPadding: 0.2,
                                borderWidth: 0
                            }
                        },
                        series: getData.series,
                    });
                }
            }
        }
    })
}
function table_sr_chart() {
    var year = $('#inp-bar-sr-year').val();
    var mf = $('#inp-bar-sr-first').val();
    var ml = $('#inp-bar-sr-last').val();
    $.ajax({
        url: site_url + 'sales_report/table_sr_chart',
        type: 'POST',
        cache: false,
        data: {
            year: year,
            mf: mf,
            ml: ml
        },
        success: function (string) {
            $('#bar-table-container').html(string);
        }
    })
}

function pie_sr_chart() {
    var year = $('#inp-pie-sr-year').val();
    var mf = $('#inp-pie-sr-month-first').val();
    var ml = $('#inp-pie-sr-month-last').val();
    $.ajax({
        url: site_url + 'sales_report/pie_sr_chart',
        type: 'POST',
        cache: false,
        data: {
            year: year,
            mf: mf,
            ml: ml
        },
        success: function (string) {
            if (isJSON(string)) {
                var getData = $.parseJSON(string);
                if ($('#pie-sr-container').length) {
                    $('#pie-sr-container').highcharts({
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                            text: 'Thống kê từ tháng ' + getData.mf + (getData.mf == getData.ml ? '' : ' đến tháng ' + getData.ml) + ' năm ' + getData.year
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                    style: {
                                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                    }
                                }
                            },
                            /*series: {
                                cursor: 'pointer',
                                point: {
                                    events: {
                                        click: function() {
                                            $('#modal-pie-chart-detail').modal('show').find('.modal-body').html('Vendor Number ' + this.name.split('-')[0] + ' từ tháng ' + getData.monthFirst + (getData.monthLast == getData.monthFirst ? '' : ' đến tháng ' + getData.monthLast) + ' năm ' + getData.year);
                                        }
                                    }
                                }
                            }*/
                        },
                        series: [{
                            name: 'Brands',
                            colorByPoint: true,
                            data: getData.series
                        }]
                    });
                }
            }
        }
    })
}

/* #Sales report chart */

/* Sales part report chart */

function bar_spr_chart() {
    var year = $('#inp-bar-spr-year').val();
    var mf = $('#inp-bar-spr-first').val();
    var ml = $('#inp-bar-spr-last').val();
    $.ajax({
        url: site_url + 'sales_part_report/bar_spr_chart',
        type: 'POST',
        cache: false,
        data: {
            year: year,
            mf: mf,
            ml: ml
        },
        success: function (string) {
            if (isJSON(string)) {
                var getData = $.parseJSON(string);
                // console.log(getData.categories);
                // console.log(getData.series);
                if ($('#bar-spr-container').length) {
                    $('#bar-spr-container').highcharts({
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'Thống kê từ tháng ' + getData.mf + (getData.mf == getData.ml ? '' : ' đến tháng ' + getData.ml) + ' năm ' + getData.year
                        },
                        subtitle: {
                            text: 'Source: atckit.com'
                        },
                        xAxis: {
                            categories: getData.categories,
                            crosshair: true
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'Amount (VND)'
                            }
                        },
                        tooltip: {
                            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' + '<td style="padding:0"><b>${point.y:,3f} VND</b></td></tr>',
                            footerFormat: '</table>',
                            shared: true,
                            useHTML: true
                        },
                        plotOptions: {
                            column: {
                                pointPadding: 0.2,
                                borderWidth: 0
                            }
                        },
                        series: getData.series,
                    });
                }
            }
        }
    })
}

function pie_spr_chart() {
    var year = $('#inp-pie-spr-year').val();
    var mf = $('#inp-pie-spr-first').val();
    var ml = $('#inp-pie-spr-last').val();
    $.ajax({
        url: site_url + 'sales_part_report/pie_spr_chart',
        type: 'POST',
        cache: false,
        data: {
            year: year,
            mf: mf,
            ml: ml
        },
        success: function (string) {
            if (isJSON(string)) {
                var getData = $.parseJSON(string);
                if ($('#pie-spr-container').length) {
                    $('#pie-spr-container').highcharts({
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                            text: 'Thống kê từ tháng ' + getData.mf + (getData.mf == getData.ml ? '' : ' đến tháng ' + getData.ml) + ' năm ' + getData.year
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                    style: {
                                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                    }
                                }
                            },
                        },
                        series: [{
                            name: 'Brands',
                            colorByPoint: true,
                            data: getData.series
                        }]
                    });
                }
            }
        }
    })
}

/* #Sales part report chart */

/* Gross revenue per staff */

function bar_srps_chart() {
    var year = $('#inp-bar-srps-year').val();
    var mf = $('#inp-bar-srps-first').val();
    var ml = $('#inp-bar-srps-last').val();
    $.ajax({
        url: site_url + 'sales_revenue_per_staff/bar_srps_chart',
        type: 'POST',
        cache: false,
        data: {
            year: year,
            mf: mf,
            ml: ml
        },
        success: function (string) {
            if (isJSON(string)) {
                var getData = $.parseJSON(string);
                // console.log(getData.categories);
                // console.log(getData.series);
                if ($('#bar-srps-container').length) {
                    $('#bar-srps-container').highcharts({
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'Thống kê từ tháng ' + getData.mf + (getData.mf == getData.ml ? '' : ' đến tháng ' + getData.ml) + ' năm ' + getData.year
                        },
                        subtitle: {
                            text: 'Source: atckit.com'
                        },
                        xAxis: {
                            categories: getData.categories,
                            crosshair: true
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'Amount (VND)'
                            }
                        },
                        // tooltip: {
                        //     headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                        //     pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' + '<td style="padding:0"><b>${point.y:,3f} VND</b></td></tr>',
                        //     footerFormat: '</table>',
                        //     shared: true,
                        //     useHTML: true
                        // },
                        plotOptions: {
                            series: {
                                pointWidth: 30,
                                borderWidth: 0,
                                dataLabels: {
                                    enabled: true,
                                    formatter: function() {
                                        if (this.y > 1000000000) {
                                            return Highcharts.numberFormat(this.y /  1000000000, 2) + "G"
                                        } else if (this.y > 1000000) {
                                            return Highcharts.numberFormat(this.y / 1000000, 2) + "M";
                                        } else {
                                            return this.y
                                        }
                                    }
                                }
                            },
                            column: {
                                pointPadding: 0.2,
                                borderWidth: 0
                            }
                        },
                        series: getData.series,
                    });
                }
            }
        }
    })
}
table_srps_chart();
function table_srps_chart() {
    var year = $('#inp-bar-srps-year').val();
    var mf = $('#inp-bar-srps-first').val();
    var ml = $('#inp-bar-srps-last').val();
    $.ajax({
        url: site_url + 'sales_revenue_per_staff/table_srps_chart',
        type: 'POST',
        cache: false,
        data: {
            year: year,
            mf: mf,
            ml: ml
        },
        success: function (string) {
            $('#table-srps-container').html(string);
        }
    })
}
function pie_srps_chart() {
    var year = $('#inp-pie-srps-year').val();
    var mf = $('#inp-pie-srps-first').val();
    var ml = $('#inp-pie-srps-last').val();
    $.ajax({
        url: site_url + 'sales_revenue_per_staff/pie_srps_chart',
        type: 'POST',
        cache: false,
        data: {
            year: year,
            mf: mf,
            ml: ml
        },
        success: function (string) {
            if (isJSON(string)) {
                var getData = $.parseJSON(string);
                if ($('#pie-srps-container').length) {
                    $('#pie-srps-container').highcharts({
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                            text: 'Thống kê từ tháng ' + getData.mf + (getData.mf == getData.ml ? '' : ' đến tháng ' + getData.ml) + ' năm ' + getData.year
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                    style: {
                                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                    }
                                }
                            },
                        },
                        series: [{
                            name: 'Brands',
                            colorByPoint: true,
                            data: getData.series
                        }]
                    });
                }
            }
        }
    })
}

/* #Gross revenue per staff */

function bar_ppr_table() {
    var year = $('#inp-bar-ppr-year').val();
    var mf = $('#inp-bar-ppr-first').val();
    var ml = $('#inp-bar-ppr-last').val();
    $.ajax({
        url: site_url + 'purchasing_report/bar_ppr_table',
        type: 'POST',
        cache: false,
        data: {
            year: year,
            mf: mf,
            ml: ml
        },
        success: function (string) {
            $('#bar_ppr_table').html(string);
        }
    })
}
function bar_grps_table() {
    var year = $('#inp-bar-grps-year').val();
    var mf = $('#inp-bar-grps-first').val();
    var ml = $('#inp-bar-grps-last').val();
    $.ajax({
        url: site_url + 'purchasing_report/bar_grps_table',
        type: 'POST',
        cache: false,
        data: {
            year: year,
            mf: mf,
            ml: ml
        },
        success: function (string) {
            $('#bar_grps_table').html(string);
        }
    })
}
function bar_chart_table() {
    var year = $('#inp-bar-year').val();
    var mf = $('#inp-bar-first').val();
    var ml = $('#inp-bar-last').val();
    $.ajax({
        url: site_url + 'purchasing_report/bar_chart_table',
        type: 'POST',
        cache: false,
        data: {
            year: year,
            mf: mf,
            ml: ml
        },
        success: function (string) {

            $('#bar_chart_table').html(string);
        }
    })
}

function bar_chart_sup_rev() {
    var year = $('#inp-bar-sup-rev').val();
    var mf = $('#inp-bar-sup-rev-first').val();
    var ml = $('#inp-bar-sup-rev-last').val();
    $.ajax({
        url: site_url + 'purchasing_report/bar_chart_month_sup_rev',
        type: 'POST',
        cache: false,
        data: {
            year: year,
            mf: mf,
            ml: ml
        },
        success: function (string) {
            console.log(string);
            if (isJSON(string)) {
                var getData = $.parseJSON(string);
                if ($('#bar-container-sup-rev').length) {
                    $('#bar-container-sup-rev').highcharts({
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'Thống kê từ tháng ' + getData.mf + (getData.mf == getData.ml ? '' : ' đến tháng ' + getData.ml) + ' năm ' + getData.year
                        },
                        subtitle: {
                            text: 'Source: atckit.com'
                        },
                        xAxis: {
                            labels: {
                                enabled: false
                            }
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'Amount (USD)'
                            }
                        },
                        plotOptions: {
                            series: {
                                pointWidth: 30,
                                borderWidth: 0,
                                dataLabels: {
                                    enabled: true,
                                    formatter: function() {
                                        if (this.y > 1000000000) {
                                            return Highcharts.numberFormat(this.y /  1000000000, 2) + "G"
                                        } else if (this.y > 1000000) {
                                            return Highcharts.numberFormat(this.y / 1000000, 2) + "M";
                                        } else if (this.y > 1000) {
                                            return Highcharts.numberFormat(this.y / 1000, 2) + "K";
                                        }
                                        else {
                                            return Highcharts.numberFormat(this.y,  2, '.', ' ');
                                        }
                                    },
                                }
                            },
                            column: {
                                pointPadding: 0.2,
                                borderWidth: 0
                            }
                        },
                        series: getData.series,
                    });
                }
            }
        }
    })
}
function bar_chart_table_sup_rev() {
    var year = $('#inp-bar-sup-rev').val();
    var mf = $('#inp-bar-sup-rev-first').val();
    var ml = $('#inp-bar-sup-rev-last').val();
    $.ajax({
        url: site_url + 'purchasing_report/bar_chart_table_sup_rev',
        type: 'POST',
        cache: false,
        data: {
            year: year,
            mf: mf,
            ml: ml
        },
        success: function (string) {

            $('#bar_chart_sup_rev_table').html(string);
        }
    })
}
function pie_chart_sup_rev() {
    var year = $('#inp-pie-sup-rev-year').val();
    var monthFirst = $('#inp-pie-sup-rev-month-first').val();
    var monthLast = $('#inp-pie-sup-rev-month-last').val();
    $.ajax({
        url: site_url + 'purchasing_report/pie_chart_sup_rev',
        type: 'POST',
        cache: false,
        data: {
            year: year,
            monthFirst: monthFirst,
            monthLast: monthLast
        },
        success: function (string) {
            if (isJSON(string)) {
                var getData = $.parseJSON(string);
                if ($('#pie-sup-rev-container').length) {
                    $('#pie-sup-rev-container').highcharts({
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        colors: getData.color,
                        title: {
                            text: 'Thống kê từ tháng' + getData.monthFirst + (getData.monthFirst == getData.monthLast ? '' : ' đến tháng ' + getData.monthLast) + ' năm ' + getData.year
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                    style: {
                                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                    }
                                }
                            },
                            /*series: {
                                cursor: 'pointer',
                                point: {
                                    events: {
                                        click: function() {
                                            $('#modal-pie-chart-detail').modal('show').find('.modal-body').html('Vendor Number ' + this.name.split('-')[0] + ' từ tháng ' + getData.monthFirst + (getData.monthLast == getData.monthFirst ? '' : ' đến tháng ' + getData.monthLast) + ' năm ' + getData.year);
                                        }
                                    }
                                }
                            }*/
                        },
                        series: [{
                            name: 'Brands',
                            colorByPoint: true,
                            data: getData.series
                        }]
                    });
                }
            }
        }
    })
}



function bar_chart_sup() {
    var year = $('#inp-bar-sup').val();
    var mf = $('#inp-sup-first').val();
    var ml = $('#inp-sup-last').val();
    $.ajax({
        url: site_url + 'purchasing_report/bar_chart_month_sup',
        type: 'POST',
        cache: false,
        data: {
            year: year,
            mf: mf,
            ml: ml
        },
        success: function (string) {
            console.log(string);
            if (isJSON(string)) {
                var getData = $.parseJSON(string);
                if ($('#bar-sup-container').length) {
                    $('#bar-sup-container').highcharts({
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'Thống kê từ tháng ' + getData.mf + (getData.mf == getData.ml ? '' : ' đến tháng ' + getData.ml) + ' năm ' + getData.year
                        },
                        subtitle: {
                            text: 'Source: atckit.com'
                        },
                        xAxis: {
                            labels: {
                                enabled: false
                            }
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'Amount (USD)'
                            }
                        },
                        plotOptions: {
                            series: {
                                pointWidth: 30,
                                borderWidth: 0,
                                dataLabels: {
                                    enabled: true,
                                    formatter: function() {
                                        if (this.y > 1000000000) {
                                            return Highcharts.numberFormat(this.y /  1000000000, 2) + "G"
                                        } else if (this.y > 1000000) {
                                            return Highcharts.numberFormat(this.y / 1000000, 2) + "M";
                                        } else if (this.y > 1000) {
                                            return Highcharts.numberFormat(this.y / 1000, 2) + "K";
                                        }
                                        else {
                                            return Highcharts.numberFormat(this.y,  2, '.', ' ');
                                        }
                                    },
                                }
                            },
                            column: {
                                pointPadding: 0.2,
                                borderWidth: 0
                            }
                        },
                        series: getData.series,
                    });
                }
            }
        }
    })
}
function bar_chart_table_sup() {
    var year = $('#inp-bar-sup').val();
    var mf   = $('#inp-sup-first').val();
    var ml = $('#inp-sup-last').val();
    $.ajax({
        url: site_url + 'purchasing_report/bar_chart_table_sup',
        type: 'POST',
        cache: false,
        data: {
            year: year,
            mf: mf,
            ml: ml
        },
        success: function (string) {
            $('#bar_sup_table').html(string);
        }
    })
}
function pie_chart_sup() {
    var year = $('#inp-pie-sup-year').val();
    var monthFirst =$('#inp-pie-sup-first').val();
    var monthLast = $('#inp-pie-sup-last').val();
    $.ajax({
        url: site_url + 'purchasing_report/pie_chart_sup',
        type: 'POST',
        cache: false,
        data: {
            year: year,
            monthFirst: monthFirst,
            monthLast: monthLast
        },
        success: function (string) {
            console.log(string);
            if (isJSON(string)) {
                var getData = $.parseJSON(string);
                if ($('#pie-sup-container').length) {
                    $('#pie-sup-container').highcharts({
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                            text: 'Thống kê từ tháng' + getData.monthFirst + (getData.monthFirst == getData.monthLast ? '' : ' đến tháng ' + getData.monthLast) + ' năm ' + getData.year
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                    style: {
                                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                    }
                                }
                            },
                        },
                        series: [{
                            name: 'Brands',
                            colorByPoint: true,
                            data: getData.series
                        }]
                    });
                }
            }
        }
    })
}