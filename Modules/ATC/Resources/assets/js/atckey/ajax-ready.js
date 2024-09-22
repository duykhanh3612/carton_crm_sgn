$(document).ready(function() {
    if ($('.user-branch-btn .dropdown-menu').length && $.cookie('branch')) {
        $('.user-branch-btn .dropdown-menu li').removeClass('active');
        $('.user-branch-btn .dropdown-menu li[data-branch="' + $.cookie('branch') + '"]').addClass('active');
        if ($('.user-branch-btn .dropdown-menu li.active[data-branch="' + $.cookie('branch') + '"]').length) {
            $('.user-branch span').text('CN ' + $('.user-branch-btn .dropdown-menu li.active').text());
        } else {
            $.cookie('branch', $('#coso').val(), {
                path: '/',
                expires: 3600 * 24 * 30
            });
        }
    } else {
        $.cookie('branch', $('#coso').val(), {
            path: '/',
            expires: 3600 * 24 * 30
        });
    }

    if ($('.tab-content').length && $('.tab-pane .table thead').length) {
        $('.tab-pane .table').stickyTableHeaders({
            fixedOffset: $('#page-header').height()
        });
    } else {
        $('.mainTable').stickyTableHeaders({
            fixedOffset: $('#page-header').height() + ($('.group-process').length && $('#info-order').length && !$('#info-order').hasClass('in') ? 77 : ($('.group-process').length && $('#info-order').hasClass('in') || $('.group-process').length && !$('#info-order').length ? 32 : 0))
        });
    }

    if (!$('.dd-list').length) {
        $('.nestable-menu').hide();
    }

    $('.money').autoNumeric('init', {
        'mDec': 0
    });

    if ($('.input-switch-alt').length) {
        $('.input-switch-alt').simpleCheckbox();
        $('.switch-toggle:not(.disabled)').click(function() {
            var id = $(this).prev().data('id');
            var status = $(this).prev().is(':checked') ? 1 : 0;
            var field = $(this).prev().data('field');
            var table = $('#moduleInfo').data('table');
            if (id == '' || id == null) {
                id = $('#id').val();
            }
            $.ajax({
                url: site_url + 'ajax/change_status',
                type: 'POST',
                cache: false,
                data: {
                    id: id,
                    table: table,
                    field: field,
                    status: status
                }
            });
        });
    }

    if ($('.cat_treeview').length) {
        $('.cat_treeview').treeview();
    }

    if ($('#date_added').length) {
        var format = $(this).data('format');
        if (format == '' || format == null) {
            format = 'YYYY-MM-DD HH:mm:ss';
        }
        $('#date_added').datetimepicker({
            format: format,
            locale: 'vi',
            icons: {
                time: 'glyph-icon icon-clock-o',
                date: 'glyph-icon icon-calendar',
                up: 'glyph-icon icon-chevron-up',
                down: 'glyph-icon icon-chevron-down',
                previous: 'glyph-icon icon-chevron-left',
                next: 'glyph-icon icon-chevron-right'
            }
        });
    }

    if ($('.date').length) {
        $('.date').each(function() {
            var dateFormat = $(this).data('format');
            if (dateFormat == '' || dateFormat == null) {
                dateFormat = 'yyyy-mm-dd';
            }
            $(this).datepicker({
                format: dateFormat,
                language: 'vi',
                autoclose: true,
                todayHighlight: true
            });
        });
    }

    if ($('.date_time').length) {
        $('.date_time').each(function() {
            var dateFormat = $(this).data('format');
            if (dateFormat == '' || dateFormat == null) {
                dateFormat = 'YYYY-MM-DD HH:mm:ss';
            }
            $(this).datetimepicker({
                format: dateFormat,
                locale: 'vi',
                icons: {
                    time: 'glyph-icon icon-clock-o',
                    date: 'glyph-icon icon-calendar',
                    up: 'glyph-icon icon-chevron-up',
                    down: 'glyph-icon icon-chevron-down',
                    previous: 'glyph-icon icon-chevron-left',
                    next: 'glyph-icon icon-chevron-right'
                }
            });
        });
    }

    if ($('#datepicker .input-daterange').length) {
        $('#datepicker .input-daterange').datepicker({
            format: 'yyyy-mm-dd',
            language: 'vi',
            autoclose: true,
            todayHighlight: true
        });
    }

    $('#page-content .tooltip-button, #page-content .tooltip-link').tooltip({
        container: '#page-content'
    });

    $('.tooltip-button, .tooltip-link').tooltip({
        container: 'body'
    });
    
    if ($('.select2').length) {

        if($(act).val()!="modules_template")
            $('.select2').chosen({
                placeholder_text_single: 'Select an option',
                disable_search_threshold: 10
            });

            // get all elements effect chosen
            var select2ClassElements = [];
            $('.select2').each(function(){
                var classElement = $(".select2").attr("class");
                select2ClassElements.push(classElement)
            })
            select2ClassElements = JSON.stringify(select2ClassElements)
            sendRequest({table:atc,class:select2ClassElements})

        if ($('.chosen-search').length && !$('.chosen-search i').length) {
            $('.chosen-search').append('<i class="glyph-icon icon-search"></i>');
        }
        $('.chosen-single div').html('<i class="glyph-icon icon-caret-down"></i>');
    }

    if ($('select.form-control').length&&$(act).val()!="modules_template") {
        $('select.form-control').chosen({
            disable_search: true,
            disable_search_threshold: 10
        });
        if ($('.chosen-search').length && !$('.chosen-search i').length) {
            $('.chosen-search').append('<i class="glyph-icon icon-search"></i>');
        }
        $('.chosen-single div').html('<i class="glyph-icon icon-caret-down"></i>');
    }

    if ($('.delRestoreLink .bin').length || $('.delRestoreLink .refresh').length) {
        $('#cmdBtnDelRestore').show();
    } else {
        $('#cmdBtnDelRestore').hide();
    }

    if ($('.modal .modal-body').length) {
        $('.modal .modal-body').css({
            'max-height': $(window).outerHeight(true) - ($('.modal .modal-header').length ? 60 : 0) - 55 + 'px',
            'overflow-y': 'auto'
        });
    }

    if ($('.month').length) {
        $('.month').each(function() {
            var dateFormat = $(this).data('format');
            if (dateFormat == '' || dateFormat == null) {
                dateFormat = 'yyyy-mm';
            }
            $(this).datepicker({
                format: dateFormat,
                language: 'vi',
                startView: 'months',
                minViewMode: 'months'
            });
        });
    }

    /*$('.mceEditor').editable({
        inlineMode: false,
        pastedImagesUploadURL: 'ajax/upload_image',
        imageUploadURL: site_url + 'ajax/upload_image',
        buttons: $.merge(['fullscreen'], $.Editable.DEFAULTS.buttons)
    });

    $('[href="http://editor.froala.com"]').parent().remove();*/

    // dev 20181214 ...
    // hardware design report
    $('.hwds_select_approver, .hwds_select_status').each(function() {
        $(this).next().find('.chosen-single div i').remove();
    })
    // ... #dev 20181214
});

function sendRequest(data,url){
    // var domain = '/'+window.location.pathname +"request_pickup"
    return new Promise((resolve, reject) => {
        $.ajax({
            url:'ajax/'+ url,
            type: "POST",
            data: data,
            beforeSend:function(){
               
            },
            complete:function(){
               
            },
            success: function(res) {
                if (res != null) {

                    res = JSON.parse(res);
                    resolve(res.data);
                   
                    
                } else {
                    reject({});
                }
            },
            timeout: 20000,
            error: function(jqXHR, textStatus, errorThrown) {
               console.log("error send")
            },
        });
    })
}
