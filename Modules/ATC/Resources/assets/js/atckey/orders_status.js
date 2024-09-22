$(document).ready(function () {
    makeDragOrder("orders_status_type", "", "", "SortOrder", "ASC");
   // change_required_input();
    rd_change();
  /*  $('.upload-required').on('change', function () {
        change_required_input();
    })
*/
drapOrder();
function drapOrder() {
    $('#itemList .mainTable123').tableDnD({
        onDragClass: 'myDragClass',
        onDrop: function (table, row) {
            var highlightNoClick = $('#itemList .mainTable123 .highlightNoClick').length;
            for (var i = 0; i < highlightNoClick; i++) {
                $('#itemList .mainTable123 .highlightNoClick .stt:eq(' + i + ')').html(i + 1);
                $('#itemList .mainTable123 .highlightNoClick .itemKey:eq(' + i + ')').val(i + 1);
                var id = $('#itemList .mainTable123 .highlightNoClick .myidKey:eq(' + i + ')').val();
                var sort = $('#itemList .mainTable123 .highlightNoClick .itemKey:eq(' + i + ')').val();
                if(!!id){
                    $.ajax({
                        url: site_url + 'tasks/ajax_update_sort',
                        type: 'POST',
                        cache: false,
                        data: {id:id, sort: sort},
                    })
                }
            };
            $('#itemList .mainTable123 tr').css('cursor', 'auto');
        },
        dragHandle: '.stt'
    });
}
    $('body').on('click', '#btn-add-os', function () {
        var modal = $('#modal-add-os');
        modal.modal('show');
    }).on('click', '#modal-add-os .btn-primary', function () {
        var modal = $('#modal-add-os');
        var reportName = $('#ReportName');
        var lastTR = $('#mainTable-orders_status_type tbody tr').last();
        var sortOrder = parseInt(lastTR.find('.stt').text());
        $.ajax({
            url: site_url + 'orders_status/process_add_report',
            type: 'POST',
            cache: false,
            data: {
                Name: reportName.val(),
                SortOrder: sortOrder
            },
            success: function (string) {
                if (string > 0) {
                    showNoti('Add type status success!', 'Success', 'Ok');
                    modal.modal('hide');
                    html = '<tr id="' + string + '">';
                    html += '   <td class="center"><span class="stt STT_' + (sortOrder + 1) + '">' + (sortOrder + 1) + '</span><input type="hidden" value="' + (sortOrder + 1) + '" id="Old_' + (sortOrder + 1) + '"></td>';
                    html += '   <td><input type="text" class="form-control os-name input-retype" value="' + reportName.val() + '"><input type="hidden" class="os-name-hd" value="' + reportName.val() + '"></td>';
                    html += '   <td class="text-center">';
                    html += '       <a href="javascript:;" class="os-tools edit"><i class="fa fa-pencil"></i></a>';
                    html += '       <a href="javascript:;" class="os-tools remove"><i class="fa fa-trash"></i></a>';
                    html += '   </td>';
                    html += '</tr>';
                    lastTR.after(html);
                    makeDragOrder("orders_status_type", "", "", "SortOrder", "ASC");
                    reportName.val('');
                } else {
                    showNoti('Fail', 'Error', 'Err');
                }
            }
        })
    }).on('click', '.os-tools.edit', function() {
        var parent = $(this).closest('tr');
        $('#mainTable-orders_status_type tbody tr').not(parent).addClass('disabled');
        parent.find('.os-name').removeClass('input-retype');
        $(this).toggleClass('edit check').children('i').toggleClass('fa-pencil fa-check');
        $(this).next().toggleClass('remove cancel').children('i').toggleClass('fa-trash fa-remove');
    }).on('click', '.os-tools.remove', function() {
        var parent = $(this).closest('tr');
        var id = parent.attr('id');
        $.alerts.confirm('Will you deleted this type status', 'Confirm delete', function(e) {
            if (e) {
                $.ajax({
                    url: site_url + 'orders_status/delete_add_type_status',
                    type: 'POST',
                    cache: false,
                    data: {
                        id: id
                    },
                    success: function(string) {
                        if (string == 1) {
                            showNoti('Delete type type status success!', 'Success', 'Ok');
                            parent.remove();
                            for (var i = 0; i < $('#mainTable-orders_status_type tbody tr').length; i++) {
                                $('#mainTable-orders_status_typetbody tr:eq(' + i + ') td:eq(0) .stt').text(i + 1);
                            }
                        } else {
                            showNoti('Fail', 'Error', 'Err');
                        }
        
                    }
                })
            }
        });
        return false;
    }).on('click', '.os-tools.cancel', function() {
        var parent = $(this).closest('tr');
        $('#mainTable-orders_status_type tbody tr').removeClass('disabled');
        parent.find('.os-name').val(parent.find('.os-name-hd').val()).addClass('input-retype');
        $(this).toggleClass('cancel remove').children('i').toggleClass('fa-remove fa-trash');
        $(this).prev().toggleClass('check edit').children('i').toggleClass('fa-check fa-pencil');
    }).on('click', '.os-tools.check', function() {
        var _that = $(this);
        var parent = $(this).closest('tr');
        var id = parent.attr('id');
        var reportName = parent.find('.os-name');
        var sortOrder = parent.index();
        $.ajax({
            url: site_url + 'orders_status/process_add_report',
            type: 'POST',
            cache: false,
            data: {
                Name: reportName.val(),
                SortOrder: sortOrder,
                id: id
            },
            success: function(string) {
                if (string > 0) {
                    showNoti('Add report theme success!', 'Success', 'Ok');
                    $('#mainTable-orders_status_type tbody tr').removeClass('disabled');
                    parent.find('.os-name').addClass('input-retype');
                    parent.find('.os-name-hd').val(parent.find('.os-name').val());
                    _that.toggleClass('check edit').children('i').toggleClass('fa-check fa-pencil');
                    _that.next().toggleClass('cancel remove').children('i').toggleClass('fa-remove fa-trash');
                } else {
                    showNoti('Fail', 'Error', 'Err');
                }

            }
        })
    }).on('change', '.reportingdate', function () {
        // var arrRepeats = [];
        // var arr = [];
        // $('[name*="Repeats"]').serializeArray().forEach(function (e) {
        //     arrRepeats.push(e['value']);
        // });
        // $('.reportingdate').each(function () {
        //     arr.push($(this).val());
        // });
        // arr = mie_array(arr);
        // $('.content-repeats .checkbox input[type="checkbox"]').prop('checked', false);
        // arr.forEach(function (e) {
        //     if (arrRepeats.includes(e)) {
        //         $('.content-repeats input[type="hidden"][value="' + e + '"]').next().prop('checked', true);
        //     }
        // });
    }).on('change', '#Alarm1, #Alarm2', function () {
        var alarm1 = $('#Alarm1');
        var alarm2 = $('#Alarm2');
        if (parseInt(alarm2.val()) >= parseInt(alarm1.val())) {
            showNoti('Alarm 2 must less more Alarm 1', 'Warning', 'War');
            alarm2.val(0).trigger('chosen:updated');
        }
    }).on('change', 'input[type="number"]', function() {
        var min = parseFloat($(this).attr('min'));
        var max = parseFloat($(this).attr('max'));
        if ($(this).val() < min || $(this).val() > max) {
            showNoti('Invalid value', 'Warning', 'War');
            $(this).val(min);
        }
    })
}).on('click','.updateType', function () {
   var level_user = $('#level_user').val();
  // alert(1);
  $.ajax({
    url: site_url + 'orders_status/get_type',
    type: 'POST',
    cache: false,
    data: {},
	success: function ( string ) {
        var getData = $.parseJSON( string );
       // console.log( getData );
        $posType = '';
        if ( Array.isArray( getData ) && getData.length ) {
            for ( var i = 0; i < getData.length; i++ ) {
            j=i+1;
                $posType +='<tr class="highlightNoClick" id="'+getData[i]['id']+'">';
                $posType +='<td class="center">';
                $posType +='<span class="stt STT_'+getData[i]['id']+'">'+j+'</span>';
                $posType +='<input type="hidden" value="'+j+'" id="Old_'+getData[i]['id']+'">';
                $posType +='</td>';
                $posType +='<td>';
                $posType += '<input type="text" class="form-control os-name input-retype" value="'+getData[i]['Name']+'">';
                $posType += '<input type="hidden" class="os-name-hd" value="'+getData[i]['Name']+'"';
                $posType += '</td>';
                $posType += '<td class="text-center">';
                $posType +=  level_user== 3 ? '' : '<a href="javascript:;" class="os-tools edit"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;';
                $posType += level_user == 3 ? '' : '<a href="javascript:;" class="os-tools remove"><i class="fa fa-trash"></i></a>';;
                $posType += '</td>'
            }
        }
       $( '#popType' ).html( $posType).trigger( 'chosen:updated' );
       makeDragOrder('orders_status_type', '', 'SortOrder', 'SortOrder');
       // $( ' tbody tr' ).val(manager).trigger('chosen:updated' );


    }
})
    
});
// # Ready

function rd_change() {
    var previous;

    $('.reportingdate').focus(function () {
        previous = this.value;
    }).change(function() {
        $('.content-repeats input[type="hidden"][value="' + previous + '"]').next().prop('checked', false);
        previous = this.value;
        $('.content-repeats input[type="hidden"][value="' + previous + '"]').next().prop('checked', true);
    });
};
