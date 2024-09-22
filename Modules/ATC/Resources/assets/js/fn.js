var processCount = 0;
var type = $('#moduleInfo').data('type');
var table = $('#moduleInfo').data('table');
var rowstart = 0;
if ($('#rowstart').length) {
    rowstart = parseInt($('#rowstart').val());
}
var highlight = 0;
if ($('.tab-pane.active').length) {
    if ($('.highlight').length) {
        highlight = $('.tab-pane.active .highlight').length;
    }
} else {
    highlight = $('.highlight').length;
}

var ChuSo = new Array(' không ', ' một ', ' hai ', ' ba ', ' bốn ', ' năm ', ' sáu ', ' bảy ', ' tám ', ' chín ');
var Tien = new Array('', ' nghìn', ' triệu', ' tỷ', ' nghìn tỷ', ' triệu tỷ');
var jsonSort = $('#jsonSort').val();

var formHasChanged = false;

$(document).ready(function() {
    if ($('.sidebar-menu li.sfHover').length) {
        $('#sidebar').animate({
            scrollTop: $('.sidebar-menu li.sfHover').position().top
        }, 1000);
    }

    $('a.back').click(function() {
        parent.history.back();
        return false;
    });

    var History = window.History;
    // var socket = io.connect( 'http://'+window.location.hostname+':3000' );
    $('body').on('click', '#backBtn', function(e) {
        window.location = $('#back_url').val();
        return false;
    }).on('click', '#submitBtn', function(e) {
                $("#submitBtn").prop("disabled",true);
                setTimeout(function() { 
                $("#submitBtn").prop("disabled",false);
                
                }, 2500);

            if ($('#updateFrm').length) {
                var form = $('.updateFrm');
                $inpCode = form.find('#code');

                if ($inpCode.length) {
                    
                    var code = $inpCode.val();
                    var id = $('#id').val();
                    var type = $('#moduleInfo').data('type');
                    var table = $('#moduleInfo').data('table');
                    // exclude module have new version generate code
                    if(['customer_request_pickup','request_pickup','sales_order','customer_purchase_order','tasks','rfq'].includes(table)){
                        // don't check code
                        $('#code').css({
                            'border-color': '#3eb23e'
                        });
                        // showNoti('Bạn có thể sử dụng mã ' + type.toUpperCase() + ' này!', 'Kiểm tra mã ' + type.toUpperCase(), 'Ok');
                        $('#errCode').val('1');
                        $('#updateFrm').submit();
                        return;
                    }

                    if (id == '' || id == null) id = $('.id').val();
                    if (code.trim() == '') {
                        showErrOfField('code', 'code');
                        return false;
                    }
                    showProcess();

                    $.ajax({
                        url: site_url + 'ajax/check_code',
                        type: 'POST',
                        cache: false,
                        data: {
                            code: code,
                            table: table,
                            id: id
                        },
                        success: function(string) {
                            if (string.trim() == '0') {
                                $('#code').css({
                                    'border-color': '#3eb23e'
                                });
                                // showNoti('Bạn có thể sử dụng mã ' + type.toUpperCase() + ' này!', 'Kiểm tra mã ' + type.toUpperCase(), 'Ok');
                                $('#errCode').val('1');
                              //  alert(1);
                              if($('#act').val() != 'purchase_order'){
                                $('#updateFrm').submit();
                            }
                            } else {
                                $('#code').css({
                                    'border-color': '#f79879'
                                });
                                showNoti('Bạn không thể sử dụng mã ' + type.toUpperCase() + ' này!', 'Mã ' + type.toUpperCase() + ' đã có trong CSDL', 'Err');
                                $('#errCode').val('');
                            }

                        }
                    });
                    
                    hideLoading();

                    if ($('#act').val() == 'purchase_order') {
                        // migrate submit - purchase-order-2.0.js
                        return;
                    }
                    
                    if ($('#act').val() == 'stock_export') {  
                        
                        var Creadit  =parseFloat($('#Creadit').val().replace(/\s/g, '').replace(/,/g, ''));
                        var debits  = parseFloat($('#debits').val().replace(/\s/g, '').replace(/,/g, ''));
            //   alert(1) ;  
                        flag = false;
                
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
                            }
                    

                } 
               
                else{
                    $('#updateFrm').submit();
                }
            } else {
                $('.tab-pane.active .updateFrm').submit();
            }
            return false;
    }).on('click', '#page-content-wrapper, #page-header, #sidebar', function(e) {
        if ($('#datetime-btn').hasClass('open') && !$(e.target).closest('#datetime-btn').length) {
            $('#datetime-btn').removeClass('open');
        }
        if ($('.item-note-btn').hasClass('open') && !$(e.target).closest('.item-note-btn input').length) {
            $('.item-note-btn').removeClass('open');
        }
        if ($('.dropdown.price').hasClass('open') && !$(e.target).closest('.dropdown.price *').length) {
            $('.dropdown.price').removeClass('open');
        }
    }).on('click', '.changeStatus:not(.disabled)', function() {
        var ele = $(this);
        var title = 'kích hoạt';
        if ($(this).hasClass('check')) title = 'bỏ kích hoạt';
        $.alerts.confirm('Bạn có muốn ' + title + ' không?','Xác nhận', function(res) {
            if(res == true){

                var table = ele.data('table');
                var field = ele.data('field');
                var name = ele.data('name');
                var id = ele.data('id');
                var one_select = 0;
                var status = 0;
                var type = $('#moduleInfo').data('type');
                if (table == '') {
                    table = $('#moduleInfo').data('table');
                }
                if (ele.hasClass('unchecked')) {
                    ele.removeClass('unchecked').addClass('check');
                    status = 1;
                } else {
                    ele.removeClass('check').addClass('unchecked');
                    status = 0;
                }
                if (ele.hasClass('one_select')) {
                    $('.one_select').not('[data-id="' + id + '"]').removeClass('check').addClass('unchecked');
                    one_select = 1;
                }
                showProcess(1);
                $.ajax({
                    url: site_url + 'ajax/change_status',
                    type: 'POST',
                    cache: false,
                    data: {
                        id: id,
                        table: table,
                        field: field,
                        status: status,
                        one_select: one_select
                    },
                    success: function() {
                        if (status == 1) {
                            showNoti((type ? type + ': ' : '') + $('tr#' + id).attr('name'), 'Chọn ' + (name ? name + ' ' : '') + 'thành công', 'Ok');
                        } else {
                            showNoti((type ? type + ': ' : '') + $('tr#' + id).attr('name'), 'Bỏ chọn ' + (name ? name + ' ' : '') + 'thành công', 'Ok');
                        }
                        if (ele.hasClass('remove')) {
                            var rowstart = parseInt($('#rowstart').val());
                            var highlight = 0,
                                i = 0;
                            if ($('.tab-content').length) {
                                $('.tab-pane.active').find('tr#' + id + ' + tr.accordian-body').remove();
                                $('.tab-pane.active').find('tr#' + id).remove();
                                highlight = $('.tab-pane.active .highlight').length;
                                for (i = 0; i < highlight; i++) {
                                    $('.tab-pane.active .stt:eq(' + i + ')').html(i + 1 + rowstart);
                                }
                                if ($('.tab-pane.active .highlight').length == 0) {
                                    show_empty_data();
                                }
                            } else {
                                $('tr#' + id + ' + tr.accordian-body').remove();
                                $('tr#' + id).remove();
                                highlight = $('.highlight').length;
                                for (i = 0; i < highlight; i++) {
                                    $('.stt:eq(' + i + ')').html(i + 1 + rowstart);
                                }
                                if ($('.highlight').length == 0 && $('.dd-item').length == 0) {
                                    show_empty_data();
                                }
                            }
                        }
                        if (ele.hasClass('reload')) {
                            setTimeout(function() {
                                window.location.reload();
                            }, 1000)
                        }
                    }
                });
            }
        });
    }).on('change', '#code', function() {
        var code = $(this).val();
        var id = $('#id').val();
        var type = $('#moduleInfo').data('type');
        var table = $('#moduleInfo').data('table');
        if (id == '' || id == null) id = $('.id').val();
        if (code.trim() == '') {
            return false;
        }
        
        showProcess();
        $.ajax({
            url: site_url + 'ajax/check_code',
            type: 'POST',
            cache: false,
            data: {
                code: code,
                table: table,
                id: id
            },
            success: function(string) {
                console.log(string);
                if (string.trim() == '0') {
                    $('#code').css({
                        'border-color': '#3eb23e'
                    });
                    showNoti('Bạn có thể sử dụng mã ' + type.toUpperCase() + ' này!', 'Kiểm tra mã ' + type.toUpperCase(), 'Ok');
                    $('#errCode').val('1');
                } else {
                    $('#code').css({
                        'border-color': '#f79879'
                    });
                    showNoti('Bạn không thể sử dụng mã ' + type.toUpperCase() + ' này!', 'Mã ' + type.toUpperCase() + ' đã có trong CSDL', 'Err');
                    $('#errCode').val('');
                }
            }
        });
    }).on('click', '.delRestoreLink', function() {
        var id = $(this).data('id');
        var t = $(this).data('table');
        var type = $('#moduleInfo').data('type');
        if($(this).hasClass('none-type')) type = '';
        var table = $('#moduleInfo').data('table');
        var name = $(this).parent().parent().attr('name');
        if (name == undefined) {
            name = $('[data-name="' + id + '"]').text();
        }
        var mode = 'del';
        if ($('.delRestoreLink[data-id="' + id + '"] .refresh').length > 0) {
            mode = 'restore';
        }
        del_restore(t ? t : table, id, mode, name);
        /*$.alerts.confirm('Bạn có chắc sẽ ' + (mode == 'del' ? 'xóa' : 'khôi phục') + ' ' + (type ? '?<br />' + type + ' <b>' + name + '</b>' : 'mục này?<br />'), 'Xác nhận ' + (mode == 'del' ? 'xóa' : 'khôi phục') + '', function(r) {
            if (r == true) {
                del_restore(t ? t : table, id, mode, name);
            }
        });*/
    }).on('click', '.removeLink', function() {
        var id = $(this).data('id');
        var t = $(this).data('table');
        var type = $('#moduleInfo').data('type');
        var table = $('#moduleInfo').data('table');
        var name = $(this).parent().parent().attr('name');
        if (name == undefined) {
            name = $('[data-name="' + id + '"]').text();
        }
        $.alerts.confirm('Bạn có chắc sẽ xóa vĩnh viễn ' + (type ? '?<br />' + type + ' ' : 'mục này?<br />') + '<b>' + name + '</b><br /><i>(Sẽ không khôi phục được!)</i>', 'Xác nhận xóa', function(r) {
            if (r == true) {
                remove(t ? t : table, id, name);
                if (table == 'tasks') {
                    $.ajax({
                        url: site_url + 'ajax/delete_dir',
                        type: 'POST',
                        data: {
                            code: name
                        }
                    })
                }
            }
        });
    }).on('click', '.delImageIcon', function() {
        var ele = $(this);
        var type = $('#moduleInfo').data('type');
        var table = $('#moduleInfo').data('table');
        $.alerts.confirm('Bạn có chắc sẽ xóa tệp tin ' + type.toLocaleLowerCase() + '!', 'Xác nhận xóa tệp tin', function(r) {
            if (r == true) {
                var field = ele.data('field');
                var id = ele.data('id');
                var previewImg = ele.parent().find('.preview_img');
                if (table == 'customers') {
                    table = 'customergroups';
                }
                if (id == '' || id == null) {
                    id = $('#id').val();
                }
                showProcess(1);
                $.ajax({
                    url: site_url + 'ajax/delete_image',
                    type: 'POST',
                    cache: false,
                    data: {
                        id: id,
                        field: field,
                        table: table
                    },
                    success: function(string) {
                        if (string == 1) {
                            previewImg.fadeOut(function() {
                                previewImg.prev('i').fadeIn();
                                ele.fadeOut(function() {
                                    $(this).remove();
                                });
                            });
                            showNoti('Tệp tin: ảnh ' + type.toLocaleLowerCase(), 'Xóa hình tệp tin thành công', 'Ok');
                        } else {
                            showNoti('Tệp tin: ảnh ' + type.toLocaleLowerCase(), 'Xóa hình tệp tin thất bại', 'Err');
                        }
                    }
                });
            }
        });
        return false;
    }).on('click', '.updateLink', function() {
        var id = $(this).data('id');
        var table = $('body');
        if ($('.tab-content').length) {
            table = $('.tab-pane.active');
        }
        if (id == null) {
            $('.modal-dialog').find('[type="submit"] span, #modal-act').text('Add new');
            $('.modal-dialog').find('.id').val(0);
            $('.modal-dialog').find('input[type="text"]').val('');
            $('.modal-dialog').find('textarea').val('');
            $('.modal-dialog').find('#preview_icon, #icon-del').hide();
            $('.modal-dialog').find('#icon-noimg').fadeIn();
        } else {
            $('.modal-dialog').find('[type="submit"] span, #modal-act').text('Update');
            $('.id').val(id);
            $('.rowstart').val($('#rowstart').val());
            table.find('.textData.' + id).each(function() {
                var eleId = $(this).data('field');
                var eleVal = $(this).val();
                if ($('.modal #' + eleId).length) {
                    $('.modal #' + eleId).val(eleVal);
                }
                if ($('.modal .' + eleId).length) {
                    $('.modal .' + eleId).not('.errordiv').html(eleVal);
                }
            });
            table.find('.radioData.' + id + ', .checkData.' + id).each(function() {
                var eleId = $(this).data('field');
                var eleVal = $(this).val();
                $('.modal #' + eleId + eleVal).prop('checked', true);
                $('.modal #' + eleId).val(eleVal);
            });
            table.find('.selectData.' + id).each(function() {
                var eleId = $(this).data('field');
                var eleVal = $(this).val();
                $('.modal #' + eleId).val(eleVal).trigger('chosen:updated');
                if (eleId == 'nhahang') {
                    $('#chinhanh option').not('[value=""]').attr('selected', false).hide();
                    $('#chinhanh option[data-show="' + eleVal + '"]').show();
                    $('#chinhanh').trigger('chosen:updated');
                }
            });
            table.find('.iconData.' + id).each(function() {
                var eleId = $(this).data('field');
                var eleDir = $(this).data('dir');
                var eleVal = $(this).val();
                $('.modal #' + eleId).val(eleVal);
                if (eleVal != '') {
                    $('#icon-noimg').fadeOut();
                    $('#preview_icon').attr('src', eleDir + 'thumbs/' + eleVal);
                    $('#preview_icon, #icon-del').fadeIn();
                    $('#icon-del').attr('data-id', id);
                } else {
                    $('#preview_icon, #icon-del').hide();
                    $('#icon-noimg').fadeIn();
                }
            });
        }
        var tabId = $('.tabId').val();
        if ($('#myModal' + tabId).length) {
            $('#myModal' + tabId).modal('show');
        } else {
            $('#myModal').modal('show');
        }
    }).on('click', '#cmdBtnDelRestore', function() {
       // alert(123);
      var aa=  $(this).find('.key').val();
      
        var mode = $(this).find('.glyph-icon').hasClass('icon-check') ? 'restore' : 'del';
        var numItem = $('.cb-element:checked').length;
        $.alerts.confirm('Bạn có chắc sẽ ' + (mode == 'del' ? 'xóa' : 'khôi phục') + '?<br /><b>' + numItem + ' mục đã chọn</b>', 'Xác nhận ' + (mode == 'del' ? 'xóa' : 'khôi phục'), function(r) {
            if (r == true) {
                showProcess();
                $('.cb-element:checked').each(function() {
                    var id = $(this).val();
                    var key = $(this).data('key');
                    var name = $(this).parent().parent().attr('name');
                    var table = $('#moduleInfo').attr('data-table');
                    if (name == undefined) {
                        name = $('[data-name="' + id + '"]').text();
                    }
                    setTimeout(function() {
                        if(id==0){

                            $('#PotentialLineCard'+key+'').remove();
                            $('.Shipment'+key+'').remove();
                           // alert();
                        return false;
                        }
                        
                        del_restore(table, id, mode, name, 0);
                    }, 150);
                });
                if ($('.cb-element:checked').length == 0 || $('.highlight .no-remove').length) {
                    showNoti(numItem + ' mục đã chọn', 'Không thể ' + (mode == 'del' ? 'xóa' : 'khôi phục'), 'Err');
                } else {
                    showNoti(numItem + ' mục đã chọn', (mode == 'del' ? 'Xóa' : 'Khôi phục') + ' thành công', 'Ok');
                }
                $('.commandDiv').animate({
                    top: '-49px'
                });
                $('.checkAll, .cb-element').prop('checked', false);
            }
        });
        return false;
    }).on('click', '#cmdBtnRemove', function() {
        var numItem = $('.cb-element:checked').length;

        $.alerts.confirm('Bạn có chắc sẽ xóa vĩnh viễn?<br /><b>' + numItem + ' mục đã chọn</b><br /><i>(Sẽ không khôi phục được!)</i>', 'Xác nhận Xóa', function(r) {
            if (r == true) {
                showProcess();
                $('.cb-element:checked').each(function() {
                    var id = $(this).val();
                    var key = $(this).data('key');

                    var name = $(this).parent().parent().attr('name');
                    var table = $('#moduleInfo').attr('data-table');
                    if (name == undefined) {
                        name = $('[data-name="' + id + '"]').text();
                    }
                    if (table == 'tasks') {
                        $.ajax({
                            url: site_url + 'ajax/delete_dir',
                            type: 'POST',
                            data: {
                                code: name
                            }
                        })
                    }
                    setTimeout(function() {
                        if(id==0){

                            $('#PotentialLineCard'+key+'').remove();
                            $('.Shipment'+key+'').remove();
                           // alert();
                        return false;
                        }
                        remove(table, id, name, 0);
                    }, 150);
                });
                showNoti(numItem + ' mục đã chọn', 'Xóa vĩnh viễn thành công', 'Ok');
                $('.commandDiv').animate({
                    top: '-49px'
                });
                $('.checkAll').prop('checked', false);
            }
        });
        $('.confirm-modal-sm').modal('show');
        return false;
    }).on('click', '#cmdBtnMove', function() {
        $('#myModal').modal('show');
        return false;
    }).on('click', '#moveBtn', function() {
        var cat = $('[name="movecat"]:checked').val();
        if (cat == '') {
            showNoti('Vui lòng chọn danh mục chuyển đến', 'Lỗi thao tác', 'Err');
        } else {
            var numItem = $('.cb-element:checked').length;
            var table = $('#moduleInfo').data('table');
            $.alerts.confirm('Bạn có chắc sẽ di chuyển?<br /><b>' + numItem + ' mục đã chọn</b>', 'Xác nhận Di chuyển', function(r) {
                if (r == true) {
                    showProcess();
                    var IDs = [];
                    var Names = [];
                    $.each($('.cb-element:checked').serializeArray(), function() {
                        IDs.push(this.value);
                        Names.push($('tr#' + this.value).attr('name'));
                    });
                    $.ajax({
                        url: site_url + 'ajax/move_item',
                        type: 'POST',
                        cache: false,
                        data: {
                            table: table,
                            ids: IDs,
                            cat: cat,
                            names: Names
                        },
                        success: function() {
                            var url = $('#back_url').val();
                            History.pushState(null, document.title, url);
                            $('#myModal').modal('hide');
                            $('.modal-backdrop').remove();
                            showNoti(numItem + ' mục đã chọn', 'Di chuyển thành công', 'Ok');
                            $('.commandDiv').animate({
                                top: '-49px'
                            }, 500, function() {
                                if ($('#act').val() == 'products') {
                                    $('#cmdBtnMove').hide();
                                }
                            });
                            $('html, body').animate({
                                scrollTop: 0
                            }, 'slow');
                        }
                    });
                }
            });
        }
    }).on('change', '.checkAll:not(.noCommandDiv)', function() {
        if ($('.tab-content').length) {
            if ($('.tab-pane.active .cb-element:not(:disabled)').length) {
                $('.tab-pane.active .cb-element:not(:disabled)').prop('checked', $(this).is(':checked'));
                if ($(this).is(':checked')) {
                    $('.tab-pane.active .cb-element:not(:disabled)').prop('checked', true);
                    $('.tab-pane.active .highlightNoClick').addClass('selected');
                } else {
                    $('.tab-pane.active .cb-element:not(:disabled)').prop('checked', false);
                    $('.tab-pane.active .highlightNoClick').removeClass('selected');
                }
                updateSelItemNum();
            }
        } else {
            if ($('.cb-element:not(:disabled)').length) {
                $('.cb-element:not(:disabled)').prop('checked', $(this).is(':checked'));
                if ($(this).is(':checked')) {
                    $('.cb-element:not(:disabled)').prop('checked', true);
                    $('.highlightNoClick').addClass('selected');
                } else {
                    $('.cb-element:not(:disabled)').prop('checked', false);
                    $('.highlightNoClick').removeClass('selected');
                }
                updateSelItemNum();
            }
        }
    }).on('change', '.cb-element', updateSelItemNum).on('submit', '.updateFrm', checkUpdateFrm).on('click', '.image-wrap.fl i.remove', function() {
        $(this).parent().next().fadeOut();
        $(this).parent().fadeOut(function() {
            $(this).remove();
        });
    }).on('click', '.open-chirld', function() {
        var id = $(this).parent().parent().attr('id');
        if ($(this).hasClass('folder_open')) {
            $(this).removeClass('folder_open').addClass('folder_closed');
        } else {
            $(this).removeClass('folder_closed').addClass('folder_open');
        }
        $('tr.' + id).toggle();
    }).on('click', '.image', function() {
        $(this).parent().find('[type="file"]').trigger('click');
    }).on('change', '.image-wrap [type="file"]', function(e) {
        var fileInput = $(this);
        var previewImg = fileInput.parent().find('.preview_img');
        var ext = fileInput.val().split('.').pop().toLowerCase();
        var file = e.originalEvent.srcElement.files[0];
        var reader = new FileReader();
        if (ext == 'jpg' || ext == 'png' || ext == 'gif') {
            if (fileInput.parent().find('.flash-div').length) {
                fileInput.parent().find('.flash-div').hide();
            }
            previewImg.fadeOut();
            reader.onloadend = function() {
                previewImg.attr('src', reader.result);
                previewImg.prev('i').hide();
                previewImg.fadeIn(1000);
                if (fileInput.parent().find('.delImageIcon').length) {
                    fileInput.parent().find('.delImageIcon').hide();
                }
                fileInput.parent().find('.file-name div').fadeIn().children('p').text(fileInput.val().split('\\').pop());
                fileInput.parent().find('.file-name div i').click(function() {
                    fileInput.replaceWith(fileInput = fileInput.clone(true));
                    previewImg.fadeOut(function() {
                        previewImg.prev('i').fadeIn();
                        fileInput.parent().find('.file-name div').fadeOut();
                    });
                });
            };
            reader.readAsDataURL(file);
        } else if (ext == 'swf') {
            if (fileInput.parent().find('.flash-div').length) {
                var flashDiv = fileInput.parent().find('.flash-div');
                previewImg = fileInput.parent().find('.preview_img');
                previewImg.fadeOut(function() {
                    previewImg.prev('i').hide();
                });
                flashDiv.find('.flash-file').html('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="120px" height="88px" align="middle"><param name="movie" value=""><param name="wmode" value="transparent"><embed src="" quality="best" wmode="transparent" width="120px" height="88px" align="middle" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" __idm_id__="19984386"></object>');
                var flashEmb = flashDiv.find('.flash-file object embed');
                reader.onloadend = function() {
                    flashEmb.attr('value', reader.result);
                    flashEmb.attr('src', reader.result);
                    flashDiv.show();
                    if (fileInput.parent().find('.delImageIcon').length) {
                        fileInput.parent().find('.delImageIcon').hide();
                    }
                    fileInput.parent().find('.file-name div').fadeIn().children('p').text(fileInput.val().split('\\').pop());
                    fileInput.parent().find('.file-name div i').click(function() {
                        fileInput.replaceWith(fileInput = fileInput.clone(true));
                        flashDiv.fadeOut(function() {
                            previewImg.prev('i').fadeIn();
                            fileInput.parent().find('.file-name div').fadeOut();
                        });
                    });
                };
                reader.readAsDataURL(file);
            }
        } else {
            fileInput.parent().find('.file-name div').fadeIn().children('p').text(fileInput.val().split('\\').pop());
            fileInput.parent().find('.file-name div i').click(function() {
                fileInput.replaceWith(fileInput = fileInput.clone(true));
                fileInput.parent().find('.file-name div').fadeOut();
            });
        }
    }).on('change', '.filter_cat input', function() {
        $.cookie('filter-cat-' + $('#act').val(), $(this).val(), {
            path: '/'
        });
        var url = site_url + $('#act').val();
        if (window.location != url) {
            History.pushState(null, document.title, url);
        } else {
            $('#page-content').load(url);
        }
    }).on('change', '.filter_stock input', function() {
        $.cookie('filter-stock', $(this).val(), {
            path: '/'
        });
        var url = site_url + $('#act').val();
        if (window.location != url) {
            History.pushState(null, document.title, url);
        } else {
            $('#page-content').load(url);
        }
    }).on('click', 'tr.highlight', function() {
        $('tr.highlight').removeClass('selected');
        $(this).addClass('selected');
    }).on('click', 'tr.highlightNoClick', function() {
        $('tr.highlightNoClick').removeClass('selected');
        $(this).addClass('selected');
    }).on('click', 'a[href="#"]', function(a) {
        a.preventDefault()
    }).on('change', '.inputPrice:not(.disabled)', function() {
        var price = $(this).val();
        var id = $(this).data('id');
        var field = $(this).data('field');
        var type = $('#moduleInfo').data('type');
        var table = $('#moduleInfo').data('table');
        if (field == '' || field == null) field = 'gia1';
        price = price.replace(/,/g, '');
        if (price != "") {
            if (isNaN(price)) {
                return false;
            }
            showProcess(1);
            $.ajax({
                url: site_url + 'ajax/update_price',
                type: 'POST',
                cache: false,
                data: {
                    id: id,
                    price: price,
                    table: table,
                    field: field
                },
                success: function(price) {
                    if (price == '') {
                        showNoti(type + ': ' + $('tr#' + id).attr('name'), 'Cập nhật giá sản phẩm thất bại', 'Err');
                    } else {
                        $('input[data-id="' + id + '"]').val(price);
                        showNoti(type + ': ' + $('tr#' + id).attr('name'), 'Cập nhật giá sản phẩm thàng công', 'Ok');
                    }
                }
            });
        }
    }).on('click', '.div_admincats .rights div:not(.disabled), .permission-item .rights div:not(.disabled)', function() {
        if ($(this).find('.permission-icon').hasClass('gray')) {
            $(this).find('.permission-icon').removeClass('gray').addClass('red');
            $(this).find('input[data-type="1"]').prop('checked', true);
            $(this).find('input[data-type="0"]').prop('checked', false);
        } else {
            $(this).find('.permission-icon').removeClass('red').addClass('gray');
            $(this).find('input[data-type="1"]').prop('checked', false);
            $(this).find('input[data-type="0"]').prop('checked', true);
        }
    }).on('click', '.div_admincats i, .permission-item i', function() {
        if ($(this).parent().find('.permission-icon:first-child').hasClass('gray')) {
            $(this).parent().find('.permission-icon').removeClass('gray').addClass('red');
            $(this).parent().find('input[data-type="1"]').prop('checked', true);
            $(this).parent().find('input[data-type="0"]').prop('checked', false);
        } else {
            $(this).parent().find('.permission-icon').removeClass('red').addClass('gray');
            $(this).parent().find('input[data-type="1"]').prop('checked', false);
            $(this).parent().find('input[data-type="0"]').prop('checked', true);
        }
    }).on('click', '.updateProperties', function() {
        var id = $(this).data('id');
        var cat = $('.tabId').val();
        showLoading();
        $.ajax({
            url: site_url + 'properties/update',
            type: 'POST',
            cache: false,
            data: {
                id: id,
                cat: cat
            },
            success: function(html) {
                $('#myModal .modal-body').html(html);
                $('#submitBtn').bind('click', function() {
                    $('#updateFrm').submit();
                });
                $('#myModal').modal('show');
                $('.updateFrm').on('submit', checkUpdateFrm);
                hideLoading();
            }
        });
    }).on('click', '#datetime-btn a[href="#"]', function(e) {
        e.preventDefault();
        $(this).parent().toggleClass('open');
        return false;
    }).on('click', '.updateCategories', function() {
        var id = $(this).data('id');
        var type = $(this).data('type');
        showLoading();
        $.ajax({
            url: site_url + type + '/update',
            type: 'POST',
            cache: false,
            data: {
                id: id
            },
            success: function(html) {
                $('#myModal .modal-body').html(html);
                $('#submitBtn').bind('click', function() {
                    $('#updateFrm').submit();
                });
                $('#myModal').modal('show');
                $('.updateFrm').on('submit', checkUpdateFrm);
                hideLoading();
            }
        });
    }).on('click', '.accordion-toggle', function(t) {
        if (!$(t.target).closest('.checker').length && !$(t.target).closest('a').length) {
            if ($('#mobile-navigation').is(':hidden')) {
                var e = $(this).next();
                $('.accordian-body').not(e).hide();
                if (e.is(':hidden')) {
                    e.show();
                    if (e.find('.info').html() == '') {
                        var id = $(this).attr('id');
                        var table = $('#moduleInfo').data('table');
                        e.find('.info').addClass('loading');
                        $.ajax({
                            url: site_url + table + '/details',
                            type: 'POST',
                            cache: false,
                            data: {
                                id: id
                            },
                            success: function(string) {
                                e.find('.info').html(string);
                                e.find('.info').removeClass('loading');
                                if ($('.info .table thead').length) {
                                    $('.info .table').stickyTableHeaders({
                                        fixedOffset: $('#page-header').height() + 38
                                    });
                                }
                            }
                        });
                    }
                } else {
                    e.hide();
                }
            }
        }
    }).on('click', '.accordian-body .pagination a', function() {
        var e = $('.accordion-toggle.selected').next();
        var rowstart = $(this).data('rowstart');
        var id = $('.accordion-toggle.selected').attr('id');
        var table = $('#moduleInfo').data('table');
        var tab = e.find('.tab-pane.active').attr('id').split('detail-tabs' + id + '-')[1];
        $.ajax({
            url: site_url + table + '/details',
            type: 'POST',
            cache: false,
            data: {
                id: id,
                rowstart: rowstart,
                tab: tab
            },
            success: function(string) {
                e.find('.tab-pane.active').html(string);
                hideLoading();
            }
        });
    }).on('change', 'textarea.note', function() {
        var id = $(this).data('id');
        var field = $(this).data('field');
        var note = $(this).val();
        var table = $(this).data('table') ? $(this).data('table') : $('#moduleInfo').data('table');
        if (id && field) {
            $.ajax({
                url: site_url + 'ajax/change_status',
                type: 'POST',
                cache: false,
                data: {
                    id: id,
                    table: table,
                    field: field,
                    status: note
                },
                success: function() {

                }
            });
        }
        return false;
    }).on('click', '.user-branch-btn .dropdown-menu li', function() {
        var id = $(this).data('branch');
        $('#header-nav-left .user-branch span').text('CN ' + $(this).text());
        $('.user-branch-btn .dropdown-menu li').removeClass('active');
        $(this).addClass('active');
        $.cookie('branch', id, {
            path: '/',
            expires: 3600 * 24 * 30
        });
        showNoti('Chi nhánh: ' + $(this).text(), 'Bạn đã chuyển thàng công', 'Ok');
        var url = $('#back_url').val();
        History.pushState(null, document.title, url);
    }).on('focus', '.money:not([readonly]), .money2:not([readonly]), .money3:not([readonly]), .money4:not([readonly])', function() {
        $(this).one('mouseup', function(event) {
            event.preventDefault();
        }).select();
    }).on('click', '#addDvt', function() {
        var stt = $('#listDvt tbody tr').length + 1;
        var html = '';
        html += '<tr>';
        html += '<td class="center">' + stt + '<input type="hidden" name="dvts[' + stt + '][id]" value=""/></td>';
        html += '<td><input type="text" class="form-control dvts_dvt" name="dvts[' + stt + '][dvt]"/></td>';
        html += '<td><input type="text" class="form-control money dvts_quydoi" name="dvts[' + stt + '][quydoi]" value="1"/></td>';
        html += '<td class="right"><input type="text" class="form-control money dvts_gia_ban" name="dvts[' + stt + '][gia_ban]" value="0"/></td>';
        html += '<td><input type="text" class="form-control" name="dvts[' + stt + '][code]" placeholder="Mã hàng tự động"/></td>';
        html += '<td><a href="javascript:;" class="removeDvt" data-id=""><div class="icon glyphicons remove_2"></div></a></td>';
        html += '</tr>';
        $('#listDvt tbody').append(html);
        $('#listDvt').show();
        $('#listDvt tbody tr:last-child .dvts_dvt').focus();
    }).on('keyup keydown', '.dvts_quydoi', function() {
        $('.money').autoNumeric('init', {
            'mDec': 0
        });
        var soluong = $(this).autoNumeric('get');
        var gia_ban = $('#gia_ban').autoNumeric('get');
        $(this).parent().next().find('input').autoNumeric('set', soluong * gia_ban);
    }).on('click', 'button[type="submit"]', function(e) {
        if ($('#listDvt tbody tr').length) {
            $('.money').autoNumeric('init', {
                'mDec': 0
            });
            $('#listDvt tbody tr').each(function() {
                var dvt = $(this).find('.dvts_dvt').val().trim();
                var quydoi = $(this).find('.dvts_quydoi').autoNumeric('get');
                var gia_ban = $(this).find('.dvts_gia_ban').autoNumeric('get');
                if (dvt == '') {
                    showNoti('Vui lòng nhập tên đơn vị', 'Lỗi nhập liệu', 'Err');
                    $(this).find('.dvts_dvt').focus();
                    e.preventDefault();
                    return false;
                } else if (quydoi == 0) {
                    showNoti('Vui lòng nhập giá trị quy đổi', 'Lỗi nhập liệu', 'Err');
                    $(this).find('.dvts_quydoi').focus();
                    e.preventDefault();
                    return false;
                } else if (gia_ban == 0) {
                    showNoti('Vui lòng nhập giá bán', 'Lỗi nhập liệu', 'Err');
                    $(this).find('.dvts_gia_ban').focus();
                    e.preventDefault();
                    return false;
                }
            });
        }
    }).on('click', '.removeDvt', function() {
        var id = $(this).data('id');
        if (id == '') {
            $(this).parent().parent().fadeOut(function() {
                $(this).remove();
            });
        } else {
            $.ajax({
                url: site_url + 'products/remove_dvt',
                type: 'POST',
                data: {
                    id: id
                },
                cache: true,
                success: function(status) {
                    if (status == 0) {
                        showNoti('Sản phẩm đang được sử dụng', 'Không thể xóa đơn vị!', 'Err');
                    } else {
                        showNoti('Danh sách sản phẩm đã cập nhật', 'Xóa đơn vị thành công!', 'Ok');
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    showNoti('Lỗi:' + xhr.status + ' ' + thrownError, 'Không thể xuất file', 'Err');
                }
            });
        }
    }).on('click', '.updateData', function() {
        var id = $(this).data('id');
        var type = $(this).data('type');
        showLoading();
        $.ajax({
            url: site_url + type + '/update/' + id,
            type: 'POST',
            cache: false,
            data: {},
            success: function(html) {
                $('#myModal0 .modal-content').html(html);
                $('#myModal0 .modal-dialog');
                $('#myModal0').modal('show');
                hideLoading();
            }
        });
    }).on('change', '#limit_perpage', function() {
        var limit_perpage = $(this).val();
        $.cookie('limit_perpage', limit_perpage, {
            path: '/'
        });
        var module = $('#act').val();
        var modules = ['company_profile', 'department_profile'];
        if (!modules.includes(module)) {
            const md_po_paging = ["po_cpo", "po_cpo_close", "purchase_order", "pending_approval_po", "approved_po", "late_approval_po", "po_late_remain_time","late_order_confirm","order_confirm_close","order_confirmation","order_confirm_pendding", "order_confirm"];
            if(md_po_paging.includes(module)) {
                // const po_rpp_ajax = ['po_cpo', 'po_cpo_close', 'po_late_remain_time', 'approved_po', 'purchase_order', 'late_approval_po', 'pending_approval_po'];
                // if(po_rpp_ajax.includes(module)) {
                //     ajax_change_rowperpage();
                // } else {
                    location.replace(module);
                // }
            } else {
                window.location = window.location;
            }
        }
        if (module=='customers') window.location = window.location.href.split("?")[0];
    }).on('change', '#results_per_page', function() {
        var results_per_page = $(this).val();
        var href = window.location.href;
        $.cookie('results_per_page', results_per_page, {
            path: '/'
        });
        window.history.pushState(null, "Title", changeParam(href, {'page' : ''}, 'delete'));
        if ($(this).hasClass('ajax')) {
            $(".pagi-ajax").load(window.location.href + " .pagi-ajax > *");
        } else {
            window.location = window.location;
        }
    }).on('click', '.pagi-ajax a', function() {
        var indexPage = $(this).data('page');
        var url = window.location.href;
        var new_url = changeParam(url, { 'page' : indexPage }, 'edit');
        console.log(new_url);
        window.history.pushState(null, "Title", new_url);
        $(".pagi-ajax").load(window.location.href + " .pagi-ajax > *");
    }).on('click', '#load_usd_rates',async function() {
        showProcess(1);
        var rate = await getExchange();
       
        $.ajax({
            url: site_url + 'ajax/usd_rates',
            data:{rate:rate},
            type: 'POST',
            cache: false,
            success: function(rate) {
                $('#usd_rates').text(rate);
                showNoti('Tỷ giá USD: ' + rate, 'Cập nhật tỷ giá USD thành công!', 'Ok');
            }
        });

    }).on('click', '.col-show-hide', function() {
        showProcess(1);
        var module = $('#act').val();
        var tab = $(this).data('tab');
        var moduletab = $(this).data('module');
        //alert(tab);l
        if (module == 'positions') {
            module = $('#moduleInfo').attr('data-table');
        }
        if (tab == 1) {
            module =moduletab;
        }
        
        if (module == 'customer_sales_contract') {

            var activeleft = $.cookie('activecsc');
 
              if(activeleft == 195 ||  activeleft == 196){
                 activeleft = 'customer_sales_contract'+activeleft+'';
 
 
              }else{
 
                 activeleft = 'customer_sales_contract';
 
                }
                // alert(1);
                module = activeleft;
 
         }
        if (module == 'customer_rfq') {

            var activeleft = $.cookie('customer_rfq');
            console.log(activeleft);
            if(activeleft ==195 ||  activeleft ==196){
                activeleft = 'customer_rfq'+activeleft+'';
            }else{
                activeleft = 'customer_rfq';
            }
            // alert(1);
            module = activeleft;

        }
        if (module == 'sales_quotation') {

            var activeleft = $.cookie('activesq');
            console.log(activeleft);
            if(activeleft ==195 ||  activeleft ==196){
                activeleft = 'sales_quotation'+activeleft+'';
            }else{
                activeleft = 'sales_quotation';
            }
            // alert(1);
            module = activeleft;

        }
        if(module == 'customer_sales_contract'){

        }
       // alert(module);

        $.ajax({
            url: site_url + 'modules/column_options',
            type: 'POST',
            cache: false,
            data: {
                module: module
            },
            success: function(html) {
                $('#colsModal .modal-content').html(html);
                const multi_tab = ['po_cpo', 'po_cpo_close'];
                var fo = 42;
                if(multi_tab.includes(module)) { fo = 65; }
                if ($('#mainTable-module-col').length) {
                    makeDragOrder('module-col');
                    $('#mainTable-module-col').stickyTableHeaders({
                        fixedOffset: fo,
                        scrollableArea: '.modal-body'
                    });
                }
                if ($('#mainTable-module-col2').length) {
                    makeDragOrder('module-col2');
                    $('#mainTable-module-col2').stickyTableHeaders({
                        fixedOffset: fo,
                        scrollableArea: '.modal-body'
                    });
                }
                $('#colsModal').modal('show');
                hideLoading();
            }
        });
        return false;
    }).on('click', '#checkall-show', function() {
        if ($('.field-show').length) {
            $('.field-show').prop('checked', $(this).is(':checked'));
        }
    }).on('click', '#checkall-link', function() {
        if ($('.field-link').length) {
            $('.field-link').prop('checked', $(this).is(':checked'));
        }
    }).on('click', '#checkall-sort', function() {
        if ($('.field-sort').length) {
            $('.field-sort').prop('checked', $(this).is(':checked'));
        }
    }).on('click', '#checkall-nowrap', function() {
        if ($('.field-nowrap').length) {
            $('.field-nowrap').prop('checked', $(this).is(':checked'));
        }
    }).on('submit', '#colsModal form.co-main-form', function() {
        var input_file = $(this).find("input[name='file']").val();
        showProcess(1);
        $.ajax({
            url: site_url + 'ajax/update_cols',
            type: 'POST',
            cache: false,
            data: $('#colsModal form.co-main-form').serialize(),
            success: function(res) {


                const md_po_colm = ["po_cpo", "po_cpo_close", "purchase_order", "pending_approval_po", "approved_po", "late_approval_po", "po_late_remain_time","late_order_confirm","order_confirm_close","order_confirmation","order_confirm_pendding", "order_confirm"];
                if(md_po_colm.includes(input_file)) {
                    location.replace(input_file);
                } else {
                    window.location = window.location;
                }
            }
        });
        return false;
    }).on('submit', '#colsModal form.co-second-form', function() {
        var input_file = $(this).find("input[name='file']").val();
        showProcess(1);
        $.ajax({
            url: site_url + 'ajax/update_cols',
            type: 'POST',
            cache: false,
            data: $('#colsModal form.co-second-form').serialize(),
            success: function() {
                if(input_file == 'po_cpo_2') {
                    location.replace('po_cpo');
                } else {
                    location.replace('po_cpo_close');
                }
            }
        });
        return false;
    }).on('click', '.filter-head i.remove', function() {
        $(this).parent().find('input').val('');
        $(this).remove();
    }).on('change', '#limit_time', function() {
        // invoice_management, invoice_management_sc
        var limit_time = $(this).val();        
        $.cookie('limit_time', limit_time, {
            path: '/'
        });
        window.location = window.location;
    }).on('change', '#page_year', function() {  
       // alert(1);
        // pagination in months      
        var page_year = $(this).val();
        var url = new URL(location.href);
        url.searchParams.set('page_year'+$('#act').val()+'', page_year);
        var modifiedUrl = changeParam(url, {'page' : ''}, 'delete').toString();
        $.cookie('page_year'+$('#act').val()+'', page_year, {
            path: '/'
        });
        window.location = modifiedUrl;
    }).on('hidden.bs.modal', '.modal-data', function() {
        $(this).find('input, select, textarea').val('').trigger('chosen:updated');
        $(this).find('.modal-header .modal-title span').text('');
    })
});

function checkedRadio(name) {
    var radio = $('input[name='+name+']');
    var checked = 0;
    var _this = null;
    var hasVal = null;
    $.each(radio, function (i, k) {
        var mycheck = $(this).data('required');
        if (!!mycheck && mycheck === 1) {
            _this = $(this);
            if (k.checked) {
                checked++;
                hasVal = _this.val();
            }
        }
    });

    if (checked == 0 || hasVal == '') return _this;
    return false;
}

function showErrOfField(divErr, inputId, timeOut) {

    if (timeOut == null) timeOut = 3000;
    var parentID = $('#' + inputId).closest('.tab-pane').attr('id');
    if ($('a[href="#' + parentID + '"').length) {
        $('a[href="#' + parentID + '"').click();
    }
    $('#' + inputId).focus();
    $('div.' + divErr).fadeIn();
    setTimeout(function() {
        $('div.' + divErr).fadeOut('slow')
    }, timeOut);
    return false;
}

function showLoading() {
    $('.notiLoading').css({
        'width': 100
    }).slideDown('fast');
}

function hideLoading() {
    $('.notiLoading').slideUp('slow');
}

function showProcess(process) {
    if (process == null) {
        processCount = processCount + 1;
    } else {
        processCount = process;
    }
    $('.notiLoading').html('Đang xử lý... <span id="processCount">' + processCount + '</span> tác vụ');
    $('.notiLoading').css({
        'width': 155
    }).slideDown('fast');

}

function showNoti(id, mes, mode) {
    processCount = processCount - 1;
    if (processCount > 0) {
        $('#processCount').html(processCount);
    } else {
        $('.notiLoading').fadeOut('slow', function() {
            $('.notiLoading').html('Đang tải...');
        });
    }
    var html = '';
    if (!isNaN(id)) html += (id != '' ? '<span class="mes-text">ID: ' + id + '</span>' : '');
    else if (id) html += (id != '' ? '<span class="mes-text">' + (id.split(':')[1] != '' ? id.split(':')[0] : id.split(':')[0]) + (id.split(':')[1] ? ': ' + id.split(':')[1] : '') + '</span>' : '');
    var icon = 'ok';
    if (mode == 'Err') {
        icon = 'remove';
    } else if (mode == 'War') {
        icon = 'circle_exclamation_mark';
    }
    $.amaran({
        delay: 10000,
        position: 'bottom right',
        content: {
            title: mes,
            message: '',
            info: html,
            icon: 'icon32 glyphicons white ' + icon
        },
        theme: 'awesome ' + mode,
        wrapper: '.amaran-wrapper noPrint'
    });
}

function show_empty_data() {
    var colspan = $('.mainTable tr th').length;
    if ($('.tab-content').length) {
        colspan = $('.mainTable .tab-pane.active tr th').length;
        $('.mainTable .tab-pane.active tbody').append('<tr><td class="fr center" colspan="' + colspan + '" style="height: 100px; font-size: 16px; text-align: center;"><span class="small" style="color: red;"><strong>Không có dữ liệu!</strong></span></td></tr>');
    } else {
        $('.mainTable tbody').append('<tr><td class="center" colspan="' + colspan + '" style="height: 100px; font-size: 16px; text-align: center;"><span class="small" style="color: red;"><strong>Không có dữ liệu!</strong></span></td></tr>');
    }
}


function makeDragOrder(tab, cat, field, orderby, ordermode) {
    var dragTable = $('#mainTable-' + tab);
    var moduleArr = ['potential_line_card','customer_received_date','tasks', 'request_samples', 'po_cpo', 'po_cpo_close', 'purchase_order', 'request_special_price', 'request_technical', 'positions', 'warehouse_inout', 'regulations', 'job_desc', 'job_desc_personally', 'customer_request_management'];
    
    if ($('.tab-content').length && !moduleArr.includes($('#moduleInfo').data('table'))) {
        dragTable = $('#mainTable-' + tab + ' .tab-content .tab-pane.active table');
    }
    if (cat == null) cat = '';
    if (field == null) field = '';
    if (orderby == null) orderby = '';
    if (ordermode == null) ordermode = '';
    var type = $('#moduleInfo').data('type');
    var rowstart = parseInt($('#rowstart').val());
    var thead = dragTable.find('thead').length;

    dragTable.tableDnD({
        onDragClass: 'myDragClass',
        onDrop: function(table, row) {
            
            var rows = table.tBodies[0].rows;
            var IDs = '';
            for (var i = 0; i < rows.length; i++) {
                IDs += rows[i].id;
                if (i < rows.length - 1 && (i > 0 || thead)) {
                    IDs += ',';
                }
                $('#Priority_' + rows[i].id).val(i + (thead ? 1 : 0) + rowstart);
                $('.STT_' + rows[i].id).html(i + (thead ? 1 : 0) + rowstart);
            }
            if ($('.STT_' + row.id).html() != $('#Old_' + row.id).val()) {
                showProcess();
                $.ajax({
                    url: site_url + 'ajax/sort_order',
                    type: 'POST',
                    cache: false,
                    data: {
                        IDs: IDs,
                        cat: cat,
                        field: field,
                        orderby: orderby,
                        ordermode: ordermode,
                        table: tab,
                        rowstart: rowstart
                    },
                    success: function() {
                        showNoti((type ? type + ': ' : '') + $(row).attr('name'), 'Cập nhật vị trí thành công', 'Ok');
                        for (var i = 0; i < rows.length; i++) {
                            $('#Old_' + rows[i].id).val(i + (thead ? 1 : 0) + rowstart);
                        }
                    }
                });
            }
            dragTable.find('tr').css('cursor', 'auto');
        }
    });
}

function set_mytab(e) {
    var mytab = $(e).children('a').attr('href').split('-')[1];
    $('.tabId').val(mytab);
    /*$.cookie('mytab-' + $('#act').val() + '-' + $('#do').val(), mytab, {
        path: '/'
    });*/
    $.cookie('mytab', mytab, {
        path: '/'
    });
    var href = $(e).children('a').data('tab-location');
    if (href) {
        window.location.href = href;
    }
}

function checkUpdateFrm() {
    var err = 0;
    var form = $('.updateFrm');
    if ($('body').hasClass('modal-open')) {
        form = $('.modal .updateFrm');
    } else {
        if ($('.tab-pane.active .updateFrm').length) {
            form = $('.tab-pane.active .updateFrm');
        }
    }
    var focusedId = form.find('input:focus');
    if (focusedId.hasClass('noSubmit')) {
        return false;
    }
    if($('#moduleInfo').data('table') == 'tasks' && $('.itemList .panel').length == 0){
        showNoti('Add at least one task!', 'Task', 'Err');
        err = 1;
    }
    form.find('[data-required="1"]').each(function() {
        var inputEle = $(this);
        var value = $(this).val();
        var id = $(this).attr('id');
        var trEle = inputEle.parent().parent();
        if (trEle.prop('tagName').toUpperCase() == 'TD') {
            trEle = inputEle.parent().parent().parent();
        }
        if (inputEle.attr('type') == 'radio') {
            var name = inputEle.attr('name');
            var checkRadio = checkedRadio(name);
            if (checkRadio) {
                var id = checkRadio.attr('id');
                var msg = $('.errordiv.'+checkRadio.attr('name')).text() || "Vui lòng chọn một radio";
                showErrOfField(checkRadio.attr('name'), checkRadio.attr('name'));
                showNoti(msg, 'Lỗi nhập liệu', 'Err');
                err = 1;
                return false;
            }
            return true;
        }
        if ((value == '' || value == null) && !trEle.hasClass('hide')) {
            err = 1;
            if ($('.tab-content').length) {
                var tabEle = inputEle.parent().parent().parent().parent().parent();
                if (tabEle.is(':hidden')) {
                    var errMes = inputEle.parent().find('.errordiv').text();
                    showNoti(errMes, 'Lỗi nhập liệu', 'Err');
                } else {
                    showErrOfField(id, id);
                }
            } else {
                showErrOfField(id, id);
            }
            return false;
        }
    });
    form.find('.input-style').each(function () {
        var _this = $(this);
        var id = _this.attr('id');
        if(this.value == '') {
            showNoti('Not empty!', 'PriceList', 'Err');
            showErrOfField(id, id);
            err = 1;
            return false;
        }
    });
    if (err != 1) {
        form.find('.btn').attr('disabled', true);
        showProcess(1);
        if($('#moduleInfo').data('table') =='customer_request_management') $('.btnFrm').addClass('disabled');
        return true;
    }
    return false;
}

function updateSelItemNum() {
    if ($('#do').val() != 'update' && $('#act').val() != 'walkmark' && $('#act').val() != 'print_barcode') {
        var table = $('body table');
        if ($('.tab-content').length) {
            table = $('.tab-pane.active table');
        }
        if (table.find('.cb-element:not(:disabled)').length && table.find('.cb-element:not(:disabled)').length == table.find('.cb-element:not(:disabled):checked').length) {
            table.find('.checkAll').prop('checked', true);
            if ($('#check_select').length) {
                $('#check_select').val(1);
            }
        } else {
            table.find('.checkAll').prop('checked', false);
            if ($('#check_select').length) {
                $('#check_select').val('');
            }
        }
        if ($('.cb-element:checked').length > 0) {
            if ($('#act').val() == 'products') {
                $('#cmdBtnMove').show();
            }
            if ($('#act').val() == 'stock_online') {
                $('#cmdBtnUpdate').show();
                $('#cmdBtnRemove').hide();
            }
            $('.commandDiv').animate({
                top: '13px'
            });
        } else {
            $('.commandDiv').animate({
                top: '-49px'
            }, 500, function() {
                if ($('#act').val() == 'products') {
                    $('#cmdBtnMove').hide();
                }
                if ($('#act').val() == 'stock_online') {
                    $('#cmdBtnUpdate').hide();
                }
            });
        }
        $('.selectedItem').html($('.cb-element:checked').length);
    }
}

function del_restore(table, id, mode, name, show_mes) {
    if (show_mes == null) {
        show_mes = 1;
    }
    if (show_mes == 1) {
        showProcess();
    }
    $.ajax({
        url: site_url + 'ajax/del_restore_item',
        type: 'POST',
        cache: false,
        data: {
            table: table,
            id: id,
            mode: mode,
            name: name
        },
        success: function(string) {
            $('.confirm-modal-sm').modal('hide');
            if (show_mes == 1) {
                if (string == 2) {
                    showNoti(type + ': ' + name + ' (Có chứa sản phẩm)', 'Hệ thống không thể xóa', 'Err');
                    return false;
                } else if (string == 3) {
                    showNoti(type + ': ' + name + ' (Có chứa cấp con)', 'Hệ thống không thể xóa', 'Err');
                    return false;
                } else if (string == 4) {
                    showNoti(type + ': ' + name + ' (Có chứa đơn vị con)', 'Hệ thống không thể xóa', 'Err');
                    return false;
                } else if (string == 5 || string == 6) {
                    showNoti(type + ': ' + name + ' đang được sử dụng', 'Hệ thống không thể xóa', 'Err');
                    return false;
                } else {
                    showNoti(type + ': ' + name, 'Đã ' + (mode == 'del' ? 'xóa' : 'khôi phục') + ' thành công', 'Ok');
                }
            }
            if (string == 1) {
                if ($('.delRestoreLink[data-id="' + id + '"] .no-remove').length == 0) {
                    var i = 0;
                    if ($('.tab-content').length) {
                        $('.tab-pane.active').find('tr#' + id + ' + tr.accordian-body').remove();
                        $('.tab-pane.active').find('tr#' + id).remove();
                        if ($('tr').hasClass('rowspan-' + id)) {
                            $('.tab-pane.active').find('tr.rowspan-' + id).remove();
                        }
                        for (i = 0; i < highlight; i++) {
                            $('.tab-pane.active .stt:eq(' + i + ')').html(i + 1 + rowstart);
                        }
                        if ($('.tab-pane.active .highlight').length == 0) {
                            show_empty_data();
                        }
                    } else {
                        $('tr#' + id + ' + tr.accordian-body').remove();
                        $('tr#' + id).remove();
                        if ($('tr').hasClass('rowspan-' + id)) {
                            $('tr.rowspan-' + id).remove();
                        }
                        for (i = 0; i < highlight; i++) {
                            $('.stt:eq(' + i + ')').html(i + 1 + rowstart);
                        }
                        if ($('.highlight').length == 0) {
                            show_empty_data();
                        }
                    }
                    if($.inArray(table, ['hardware_design_report', 'customer_received_date'])) {
                        if(table == 'po_cpo') {
                            window.location.replace('po_cpo');
                        }
                        else if(table == 'po_cpo_close') {
                            window.location.replace('po_cpo_close');
                        }
                        else {
                            window.location.reload();
                        }
                    }
                } else {
                    if (mode == 'del') {
                        $('.delRestoreLink[data-id="' + id + '"] .glyphicons').removeClass('bin').addClass('refresh');
                    } else {
                        $('.delRestoreLink[data-id="' + id + '"] .glyphicons').removeClass('refresh').addClass('bin');
                    }
                }
            }

        }
    });
}

function remove(table, id, name, show_mes) {
    if (show_mes == null) {
        show_mes = 1;
    }
    if (show_mes == 1) {
        showProcess();
    }
    $.ajax({
        url: site_url + 'ajax/del_restore_item',
        type: 'POST',
        cache: false,
        data: {
            table: table,
            id: id,
            mode: 'remove',
            name: name
        },
        success: function(string) {
            $('.confirm-modal-sm').modal('hide');
            if (string == '0') {
                if (show_mes == 1) {
                    showNoti(type + ': ' + name, 'Không thể xóa vĩnh viễn', 'Err');
                }
            } else if (string == '3') {
                if (show_mes == 1) {
                    showNoti(type + ': ' + name + ' (Có chứa cấp con)', 'Không thể xóa vĩnh viễn', 'Err');
                }
            } else if (string == '2') {
                if (show_mes == 1) {
                    showNoti(type + ': ' + name + ' (Có chứa sản phẩm)', 'Không thể xóa vĩnh viễn', 'Err');
                }
            } else {
                if (show_mes == 1) {
                    showNoti(type + ': ' + name, 'Xóa vĩnh viễn thành công', 'Ok');
                    $('.checkAll').prop('checked', false);
                }
                var rowstart = parseInt($('#rowstart').val());
                var highlight = $('.highlight').length;
                var i = 0;
                if ($('.tab-content').length) {
                    $('.tab-pane.active').find('tr#' + id + ' + tr.accordian-body').remove();
                    $('.tab-pane.active').find('tr#' + id).remove();
                    highlight = $('.tab-pane.active .highlight').length;
                    for (i = 0; i < highlight; i++) {
                        $('.tab-pane.active .stt:eq(' + i + ')').html(i + 1 + rowstart);
                    }
                    if ($('.tab-pane.active .highlight').length == 0) {
                        show_empty_data();
                    }
                } else {
                    if ($('.dd-item[data-id="' + id + '"]').length) {
                        $('.dd-item[data-id="' + id + '"]').remove();
                    } else {
                        $('tr#' + id + ' + tr.accordian-body').remove();
                        $('tr#' + id).remove();
                        for (i = 0; i < highlight; i++) {
                            $('.stt:eq(' + i + ')').html(i + 1 + rowstart);
                        }
                        if ($('.highlight').length == 0 && $('.dd-item').length == 0) {
                            show_empty_data();
                        }
                    }
                }
                if($.inArray(table, ['hardware_design_report', 'customer_received_date'])) {
                    if(table == 'po_cpo') {
                        window.location.replace('po_cpo');
                    }
                    else if(table == 'po_cpo_close') {
                        window.location.replace('po_cpo_close');
                    }
                    else {
                        window.location.reload();
                    }
                }
            }
        }
    });
}

function showImage(src, dst) {
    var html = '<div>';
    html += '<div class="image-wrap fl"><i class="icon glyphicons remove"></i><input data-file="' + src + '" value="' + dst.split('/').pop() + '" type="hidden" name="images[]" /><div class="image-small"><div class="no-image"><img src="' + dst + '" /></div></div></div>';
    if (table == 'interfaces') {
        html += '<div class="image-list-ele fl">Fade effect<br /><input value="" class="form-control" type="text" name="fade_effect[]"/><div class="note">px</div></div>';
        html += '<div class="image-list-ele fl">Move offset<br /><input value="300" class="form-control" type="text" name="move_offset[]"/><div class="note">px</div></div>';
        html += '<div class="image-list-ele fl">Move effect<br /><input value="" class="form-control" type="text" class="form-control" name="move_effect[]"/><div class="note">left/right/top/bottom</div></div>';
        html += '<div class="image-list-ele fl">Speed<br /><input value="900" class="form-control" type="text" name="speed[]"/><div class="note">mili giây</div></div>';
        html += '<div style="clear: both;"></div>';
    } else if (table != 'products') {
        html += '<div class="fl"><textarea style="width: 450px; height: 75px;" name="images_des[]"></textarea></div>';
        html += '<div style="clear: both;"></div>';
    }
    html += '</div>';
    $('#images-list').append(html);
}

function read_xls(files) {
    $('#list_email').html('<tr><td class="fr center" colspan="6"><div style="padding:10px"><img src="assets/images/spinner-mini.gif" /></div></td></tr>');
    $.ajax({
        url: site_url + 'subscribers/read_xls',
        type: 'POST',
        cache: false,
        data: {
            files: files
        },
        success: function(string) {
            $('#list_email').html(string);
            $('tr .highlightNoClick').bind('click', function() {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                    $(this).find('input.cb-element').prop('checked', false);
                } else {
                    $(this).addClass('selected');
                    $(this).find('input.cb-element').prop('checked', true);
                }
                updateSelItemNum();
            });
            $('.removeEmail').bind('click', function() {
                $(this).parent().parent().fadeOut(function() {
                    $(this).remove();
                    var rows = $('.highlightNoClick');
                    for (var i = 0; i < rows.length; i++) {
                        $('.STT_' + rows[i].id).html(i + 1);
                    }
                });
            });
            setTimeout(function() {
                $('#eventsmessage').html('');
                $('.ajax-file-upload-statusbar').fadeOut('show');
            }, 5000);
        }
    });
}

function list_item(type, cat, q, ids, rowstart) {
    var list = $('#' + type);
    list.html('<tr><td class="fr center" colspan="6"><div style="padding:10px"><img src="assets/images/spinner-mini.gif" /></div></td></tr>');
    if (ids == '') {
        ids = $.cookie('ids_' + type);
    }
    $.ajax({
        url: site_url + 'ajax/list_item',
        type: 'POST',
        cache: false,
        data: {
            cat: cat,
            q: q,
            ids: ids,
            type: type,
            rowstart: rowstart
        },
        success: function(string) {
            list.html(string);

            $('.money').autoNumeric('init', {
                'mDec': 0
            });

            $('.' + type).find('tr .highlightNoClick').click(function(e) {
                if (!$(e.target).closest('input').length) {
                    var id = $(this).find('input.cb-element').val();
                    if ($(this).hasClass('selected')) {
                        $(this).removeClass('selected');
                        $(this).find('input.cb-element').prop('checked', false);
                        ids = ids.replace(',' + id, '');
                    } else {
                        $(this).addClass('selected');
                        $(this).find('input.cb-element').prop('checked', true);
                        ids = ids + ',' + id;
                    }
                    $.cookie('ids_' + type, ids);

                    if (list.find('.cb-element').length && list.find('.cb-element').length == list.find('.cb-element:checked').length) {
                        $('.' + type).find('.checkAll').prop('checked', true);
                    } else {
                        $('.' + type).find('.checkAll').prop('checked', false);
                    }

                    if (list.find('.cb-element:checked').length) {
                        $('.' + type).find('#check_select').val(1);
                    } else {
                        $('.' + type).find('#check_select').val('');
                    }
                }
            });

            list.find('.pagination a').click(function(e) {
                e.preventDefault();
                list_item(type, cat, q, ids, $(this).data('rowstart'));
                return false;
            });

            list.find('.cb-element').on('change', function() {
                var ids = $.cookie('ids_' + type);
                var id = $(this).val();
                if ($(this).is(':checked')) {
                    ids = ids + ',' + id;
                } else {
                    ids = ids.replace(',' + id, '');
                }
                $.cookie('ids_' + type, ids);

                if (list.find('.cb-element').length && list.find('.cb-element').length == list.find('.cb-element:checked').length) {
                    $('.' + type).find('.checkAll').prop('checked', true);
                } else {
                    $('.' + type).find('.checkAll').prop('checked', false);
                }

                if (list.find('.cb-element:checked').length) {
                    $('.' + type).find('#check_select').val(1);
                } else {
                    $('.' + type).find('#check_select').val('');
                }
            });

            $('.' + type).find('.checkAll').on('change', function() {
                if ($(this).is(':checked')) {
                    list.find('.cb-element:not(:checked)').each(function() {
                        $(this).prop('checked', true);
                        list.find('.highlightNoClick').addClass('selected');
                        var id = $(this).val();
                        ids = ids + ',' + id;
                        $('.' + type).find('#check_select').val(1);
                    });
                } else {
                    list.find('.cb-element').each(function() {
                        $(this).prop('checked', false);
                        list.find('.highlightNoClick').removeClass('selected');
                        var id = $(this).val();
                        ids = ids.replace(',' + id, '');
                        $('.' + type).find('#check_select').val('');
                    });
                }
                $.cookie('ids_' + type, ids);
            });

            if (list.find('.cb-element').length && list.find('.cb-element').length == list.find('.cb-element:checked').length) {
                $('.' + type).find('.checkAll').prop('checked', true);
            } else {
                $('.' + type).find('.checkAll').prop('checked', false);
            }

            if (list.find('.cb-element:checked').length) {
                $('.' + type).find('#check_select').val(1);
            } else {
                $('.' + type).find('#check_select').val('');
            }

            var slimScroll_height = $('.' + type).find('.slimScroll').data('height');
            $('.' + type).find('.slimScroll').slimScroll({
                color: 'rgba(155, 164, 169, 0.68)',
                size: '6px',
                height: slimScroll_height + 'px'
            });

        }
    });
}

function DocSo3ChuSo(baso) {
    var tram;
    var chuc;
    var donvi;
    var KetQua = "";
    tram = parseInt(baso / 100);
    chuc = parseInt((baso % 100) / 10);
    donvi = baso % 10;
    if (tram == 0 && chuc == 0 && donvi == 0) return "";
    if (tram != 0) {
        KetQua += ChuSo[tram] + " trăm ";
        if ((chuc == 0) && (donvi != 0)) KetQua += " linh ";
    }
    if ((chuc != 0) && (chuc != 1)) {
        KetQua += ChuSo[chuc] + " mươi";
        if ((chuc == 0) && (donvi != 0)) KetQua = KetQua + " linh ";
    }
    if (chuc == 1) KetQua += " mười ";
    switch (donvi) {
        case 1:
            if ((chuc != 0) && (chuc != 1)) KetQua += " mốt ";
            else KetQua += ChuSo[donvi];
            break;
        case 5:
            if (chuc == 0) KetQua += ChuSo[donvi];
            else KetQua += " lăm ";
            break;
        default:
            if (donvi != 0) KetQua += ChuSo[donvi];
            break;
    }
    return KetQua;
}

function DocTienBangChu(SoTien) {
    var lan = 0;
    var so = 0;
    var KetQua = "";
    var tmp = "";
    var ViTri = new Array();
    var i = 0;
    if (SoTien < 0) return "Số tiền âm !";
    if (SoTien == 0) return "Không đồng !";
    if (SoTien > 0) so = SoTien;
    else so = -SoTien;
    if (SoTien > 8999999999999999) return "Số quá lớn!";
    ViTri[5] = Math.floor(so / 1000000000000000);
    if (isNaN(ViTri[5])) ViTri[5] = "0";
    so = so - parseFloat(ViTri[5].toString()) * 1000000000000000;
    ViTri[4] = Math.floor(so / 1000000000000);
    if (isNaN(ViTri[4])) ViTri[4] = "0";
    so = so - parseFloat(ViTri[4].toString()) * 1000000000000;
    ViTri[3] = Math.floor(so / 1000000000);
    if (isNaN(ViTri[3])) ViTri[3] = "0";
    so = so - parseFloat(ViTri[3].toString()) * 1000000000;
    ViTri[2] = parseInt(so / 1000000);
    if (isNaN(ViTri[2])) ViTri[2] = "0";
    ViTri[1] = parseInt((so % 1000000) / 1000);
    if (isNaN(ViTri[1])) ViTri[1] = "0";
    ViTri[0] = parseInt(so % 1000);
    if (isNaN(ViTri[0])) ViTri[0] = "0";
    if (ViTri[5] > 0) lan = 5;
    else if (ViTri[4] > 0) lan = 4;
    else if (ViTri[3] > 0) lan = 3;
    else if (ViTri[2] > 0) lan = 2;
    else if (ViTri[1] > 0) lan = 1;
    else lan = 0;
    for (i = lan; i >= 0; i--) {
        tmp = DocSo3ChuSo(ViTri[i]);
        KetQua += tmp;
        if (ViTri[i] > 0) KetQua += Tien[i];
        if ((i > 0) && (tmp.length > 0)) KetQua += ',';
    }
    if (KetQua.substring(KetQua.length - 1) == ',') KetQua = KetQua.substring(0, KetQua.length - 1);
    KetQua = KetQua.substring(1, 2).toUpperCase() + KetQua.substring(2) + ' đồng';
    return KetQua;
}

function nestable(maxDepth) {
    if (maxDepth == null) maxDepth = 10;
    var updateNestable = function(e) {
        var list = e.length ? e : $(e.target),
            output = list.data('output');
        if (window.JSON) {
            jsonSort = window.JSON.stringify(list.nestable('serialize'));
            if (jsonSort != $('#jsonSort').val()) {
                output.val(jsonSort);
                $.post(
                    site_url + 'ajax/sort_nestable', { dataSort: jsonSort, tableSort: $('#act').val() }
                );
            }
        } else {
            output.val('JSON browser support required for this demo.');
        }
    };
    $('#nestable').nestable({ maxDepth: maxDepth }).on('change', updateNestable);
    updateNestable($('#nestable').data('output', $('#jsonSort')));
}

String.prototype.insert = function(index, string) {
    if (index > 0) {
        return this.substring(0, index) + string + this.substring(index, this.length);
    } else {
        return string + this;
    }
};

String.prototype.replaceAll = function(strTarget, strSubString) {
    var strText = this;
    var intIndexOfMatch = strText.indexOf(strTarget);
    while (intIndexOfMatch != -1) {
        strText = strText.replace(strTarget, strSubString);
        intIndexOfMatch = strText.indexOf(strTarget);
    }
    return (strText);
};

function round(value, precision, mode) {
    var m, f, isHalf, sgn;
    precision |= 0;
    m = Math.pow(10, precision);
    value *= m;
    sgn = (value > 0) | -(value < 0);
    isHalf = value % 1 === 0.5 * sgn;
    f = Math.floor(value);
    if (isHalf) {
        switch (mode) {
            case 'PHP_ROUND_HALF_DOWN':
                value = f + (sgn < 0);
                break;
            case 'PHP_ROUND_HALF_EVEN':
                value = f + (f % 2 * sgn);
                break;
            case 'PHP_ROUND_HALF_ODD':
                value = f + !(f % 2);
                break;
            default:
                value = f + (sgn > 0);
        }
    }
    return (isHalf ? value : Math.round(value)) / m;
}

function getUrlVars(url) {
    var vars = {};
    var parts = url.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m, key, value) {
        vars[key] = value;
    });
    return vars;
}

function padding(value, length) {
    var paddingCount = length - String(value).length;
    for (var i = 0; i < paddingCount; i++) {
        value = '0' + value;
    }
    return value;
}

/**
 * @function MERGE INDENTICAL ELEMENT IN ARRAY
 * @param {array} arr 
 */
function mie_array(arr = []) {
    if (Array.isArray(arr) && arr.length) {
        var arrNew = [];
        var current = null;
        arr.sort();
        if (arr.length > 0) {
            for (var i = 0; i < arr.length; i++) {
                if (arr[i] != current) {
                    arrNew.push(arr[i]);
                    current = arr[i];
                }
            }
        }
        return arrNew;
    }
}

/**
 * @function CHANGE a Parameter
 * @param {array}: {key: value}
 * @action string: add, edit, delete
 * @return string: url string
 */
function changeParam(url, array = {}, action = 'add') {
    var url = new URL(url);

    var query_string = url.search;

    var search_params = new URLSearchParams(query_string);

    for (const [key, value] of Object.entries(array)) {
        if (action == 'add')
        search_params.append(key, value);
        if (action == 'edit')
            search_params.set(key, value);
        if (action == 'delete')
            search_params.delete(key);
    }

    // change the search property of the main url
    url.search = search_params.toString();

    // the new url string
    var new_url = url.toString();

    return new_url;
}

async function send(url){
  var res;
  await $.ajax({
    type: 'GET',
    url: url,
    header: {"Access-Control-Allow-Origin": "*"},
    success: data => {
      if(data!=null) res = data;
    },
    error: () => {
      console.log('Error');
    }
  })
  return res;
}
function getDate(){
  var today = new Date();
  var date = today.getUTCDate();
  date = date < 10 ? ('0'+date) : date;
  var month = today.getUTCMonth()+1;
  month = month < 10 ? ('0'+month)  : month;
  return date+"/"+month+"/"+today.getUTCFullYear();
}
async function getExchange(){
  var dateString =   getDate();
  var url = 'https://acb.com.vn/ACBComponent/jsp/html/vn/exchange/getlan.jsp?cmd=EXCHANGE&txtngaynt='+dateString;

  var res = await send(url);
  var data = $.parseHTML(res);
  if(data[1]){

    url = 'https://acb.com.vn/ACBComponent/jsp/html/vn/exchange/exporttygiangoaite.jsp?txtngaynt='+dateString+"&&lannt="+data[1].innerHTML;
    res = await send(url);
    data = $.parseHTML(res);

    var arr = res.split('<td class="bodertop txbody" align="right">');
    var rate = arr[4].split("</td>");
    rate = rate[0].replace(",","");
    return rate;
  }

}
