$(document).ready(function($) {
    $('#updateFrm').on('submit', function() {
        var err = false;
        var ip = '';
        $('.title-recommended input[type="text"]').each(function() {
            var newVal = $(this).val();
            if ($(this).val().trim() == '') {
                showNoti('Title Recommended không được trống', 'Lỗi', 'Err');
                ip = $(this);
                err = true;
            }
            $('.title-recommended input[type="hidden"]').each(function() {
                if ($(this).val() == newVal) {
                    ip = $(this);
                    err = true;
                }
            });
        });
        if (err) {
            ip.focus();
            return false;
        }
    });
    $('body').on('click', '.title-recommended .delete-recommended', function() {
        if (confirm('Bạn có chắc chắn xóa?')) {
            $(this).closest('.rowRec').remove();
        }
    }).on('change', '#searchPart', function(event) {
        clearTimeout($.data(this, 'timer'));
        var wait = setTimeout(search, 500);
        $(this).data('timer', wait);
    }).on('click', '.remove-part', function() {
        if (confirm('Bạn có chắc chắn xóa part này?')) {
            $(this).closest('.row-part').remove();
        }
    }).on('click', '.add-part', function() {
        var parent = $(this).closest('.rowRec');
        var id = $(this).closest('.rowRec').data('id');
        var key = 1;
        var arrID = [];
        if ($('.row-part').length) {
            $('.row-part').each(function() {
                arrID.push($(this).attr('id'));
            });
            arrID.sort(function(a, b) {
                return b - a
            });
            key = parseInt(arrID[0]) + 1;
        }
        var title = parent.find('.title-recommended input').val();
        var string = '<tr id="' + key + '" class="row-part">';
        string += '<td><input type="hidden" class="parent-title" name="recommended[' + key + '][Title]" value="' + title + '"><input type="hidden" name="recommended[' + key + '][id]" value=""><input type="text" class="form-control" name="recommended[' + key + '][MfrPart]" class="mfr-part" value="" placeholder="Mfr Part #"></td>';
        string += '<td><input type="text" class="form-control" name="recommended[' + key + '][Description]" value="" placeholder="Description"></td>';
        string += '<td><input type="text" class="form-control" name="recommended[' + key + '][Mfr]" value="" placeholder="Manufacturer"></td>';
        string += '<td><input type="text" class="form-control" name="recommended[' + key + '][DataSheet]" value="" placeholder="DataSheet"></td>';
        string += '<td><input type="text" class="form-control" name="recommended[' + key + '][URL]" value="" placeholder="URL"></td>';
        string += '<td class="text-right"><a href="javascript:;" class="glyph-icon icon-close remove-part"></a></td>';
        string += '</tr>';
        parent.find('tbody').append(string);
    }).on('click', '.btn-add-recommended', function() {
        $('#modal-recommended').modal('show');
    }).on('click', '#modal-recommended .btn-add', function() {
        var val = $('#recom-name').val();
        var err = false;
        $('.title-recommended input').each(function() {
            var curTitle = $(this).val();
            if (curTitle == val) {
                err = true;
            }
        });
        if (val.trim() == '') {
            showNoti("Tên recommended không được trống", "Cảnh báo nhập liệu", "War");
        } else if (err) {
            showNoti("Tên recommended không được trùng", "Cảnh báo nhập liệu", "War");
        } else {
            var key = 1;
            if ($('.rowRec').length) {
                key = parseInt($('#table-recommended .rowRec').last().data('id')) + 1;
            }
            var string = '<tr data-id="' + key + '" class="rowRec"><td class="fr">';
            string += '<div class="panel-recommended">';
            string += '<div class="info-header title-recommended">';
            string += '<a href="#recom' + key + '" data-toggle="collapse"></a><span>' + val + '</span><input type="hidden" class="form-control" name="panel[' + key + '][Title]" value="' + val + '"><a href="javascript:;" class="delete-recommended pull-right" aria-hidden="true"><i class="glyph-icon icon-close"></i></a>';
            string += '</div>';
            string += '<div id="recom' + key + '" class="content-recommended collapse in">';
            string += '<table class="table table-hover">';
            string += '<thead>';
            string += '<tr>';
            string += '<th width="166">Mfr Part#</th>';
            string += '<th width="166">Description</th>';
            string += '<th width="166">Manufacturer</th>';
            string += '<th width="166">DataSheet</th>';
            string += '<th width="166">URL</th>';
            string += '<th class="text-right"><a href="javascript:;" class="glyph-icon icon-plus add-part"></a></th>';
            string += '</tr>';
            string += '</thead>';
            string += '<tbody></tbody>';
            string += '</table>';
            string += '</div>';
            string += '</div>';
            string += '</td></tr>';
            $('.addRow').before(string);
            $(this).closest('#modal-recommended').modal('hide');
            $('#recom-name').val('').blur();
            dragdrop();
        }
    }).on('dblclick', '.title-recommended span', function() {
        $(this).next('input').attr('type', 'text').focus();
        $(this).hide();
    }).on('change focusout', '.title-recommended input', function() {
        var val = $(this).val();
        if (val.trim() == '') {
            showNoti("Tên recommended không được trống", "Cảnh báo nhập liệu", "War");
            $(this).focus();
            return false;
        }
        var err = false;
        $('.panel-recommended .title-recommended input').not($(this)).each(function() {
            var curTitle = $(this).val();
            if (curTitle === val) {
                err = true;
            }
        });
        if (err) {
            showNoti("Tên recommended không được trùng", "Cảnh báo nhập liệu", "War");
            $(this).focus();
            return false;
        } else {
            $(this).attr('type', 'hidden');
            $(this).attr('value', val);
            $(this).closest('.panel-recommended').find('.content-recommended .parent-title').attr('value', val);
            $(this).prev('span').text(val).show();
        }
    });
});

function search() {
    $('#content-search').show();
    $('#content-search').html('<div class="text-center"><img src="assets/images/spinner-mini.gif" /></div>');
    $.ajax({
        url: site_url + 'ajax/search_recommended',
        type: 'POST',
        cache: false,
        data: {
            qp: $('[name="qp"]').val()
        },
        success: function(string) {
            $('#content-search').empty().append(string);
            dragdrop();
        }
    });
}

function dragdrop() {
    $(function() {
        $(".item-drag").draggable({
            start: handleDragStart,
            cursor: 'move',
            revert: "invalid",
        });
        $(".content-recommended").droppable({
            drop: handleDropEvent,
            tolerance: "touch",
        });
    });

    function handleDragStart(event, ui) {}

    function handleDropEvent(event, ui) {
        var droppable = $(this);
        var draggable = ui.draggable;
        var id = draggable.data('id');
        var mfrpart = draggable.data('mfrpart');
        var desc = draggable.data('desc');
        var mfr = draggable.data('mfr');
        var datasheet = draggable.data('sheet');
        var url = draggable.data('catkey') + '/' + draggable.data('subkey') + '/' + draggable.data('mfrpart') + '/' + draggable.data('supplier') + '.html';
        var key = 1;
        var arrID = [];
        if ($('.row-part').length) {
            $('.row-part').each(function() {
                arrID.push($(this).attr('id'));
            });
            arrID.sort(function(a, b) {
                return b - a
            });
            key = parseInt(arrID[0]) + 1;
        }
        if ($('#content-search .item-drag').length == 0) {
            $('#content-search').hide();
        }
        if (mfrpart == droppable.find('tbody input.mfr-part').val()) {
            showNoti("Đã tồn tại Part này", "Cảnh báo", "War");
            draggable.removeAttr('style').css('position', 'relative');;
            return false;
        } else {
            draggable.remove();
            $('body').removeAttr('style');
        }
        var title = droppable.closest('.panel-recommended').find('.title-recommended input').val();
        var string = '<tr id="' + key + '" class="row-part">';
        string += '<td><input type="hidden" class="parent-title" name="recommended[' + key + '][Title]" value="' + title + '"><input type="hidden" name="recommended[' + key + '][id]" value="' + id + '"><input type="text" name="recommended[' + key + '][MfrPart]" class="form-control mfr-part" value="' + mfrpart + '"></td>';
        string += '<td><input type="text" class="form-control" name="recommended[' + key + '][Description]" value="' + desc + '"></td>';
        string += '<td><input type="text" class="form-control" name="recommended[' + key + '][Mfr]" value="' + mfr + '"></td>';
        string += '<td><input type="text" class="form-control" name="recommended[' + key + '][DataSheet]" value="' + datasheet + '"></td>';
        string += '<td><input type="text" class="form-control" name="recommended[' + key + '][URL]" value="' + url + '"></td>';
        string += '<td class="text-right"><a href="javascript:;" class="glyph-icon icon-close remove-part"></a></td>';
        string += '</tr>';
        droppable.find('tbody').append(string);
    }
}
$('.input-add-part').submit(function() {
    $('#modal-recommended').show();
});
