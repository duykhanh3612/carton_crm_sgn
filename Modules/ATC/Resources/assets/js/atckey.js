
$(document).ready(function() {
    panel_fix();
    anrDataRequired();

    tinymce.init({
        mode: "specific_textareas",
        theme: "modern",
        mobile: {
            theme: 'mobile',
            plugins: ['autosave', 'lists', 'autolink']
        },
        editor_selector: "mceEditorMini",
        entity_encoding: "raw",
        relative_urls: false,
        convert_urls: false,
        remove_script_host: false,
        plugin_preview_width: 696,
        height: 300,
        toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
    });

    var today = new Date();
    if (today > due_date) {
        $.removeCookie('hide_warning_refresh', { path: '/' });
    }

    if ($.cookie('hide_warning_refresh') != 1) {
        $('.warning-refresh').addClass('show');
        // $('body').css('overflow', 'hidden');
    }

    if ($('.custom-tags').length) {
        $(".custom-tags").select2({
            tags: []
        });
    }
    $('.link-code').closest('td').css({
        'position': 'relative',
        'padding-right': '20px'
    });
    $('.popover-beside').each(function() {
        var parent = $(this);
        var sel = $(this).find('select');
        var opt = '';
        sel.find('option[selected]').each(function() {
            opt += '<p class="' + $(this).val() + '">' + $(this).html() + '</p>';
        });
        parent.find('.popover-inf').html(opt);
    });

    if($('#act').val() !='purchase_order'){
    $('#updateFrm').submit(function() {
    //   alert(1);
        if ($('#itemList table.table-part').length) {
            var table = $('#itemList table.table-part tr.highlightNoClick');
            if (table.length == 0) {

            } else {
                var err = false;
                table.find('input.supplier-part, input.mfr-part').each(function() {
                    if ($(this).val() == '') {
                        err = true;
                    }
                });
                if (err) {
                    showNoti('Supplier Part # cannot be empty', 'Error', 'Err');
                    return false;
                }

                var err_tmp = false;
                $('input.spq, input.order-qty').filter(function() {
                    if(!$(this).val() || $(this).val() == 0) {
                        $(this).addClass('err-noze').delay(7000).queue(function() {
                            $(this).removeClass('err-noze');
                        });;
                        err_tmp = true;
                    }
                });
                if (err_tmp) {
                    showNoti('SPQ, MOQ, Order Quantity cannot be empty and not equal to 0, please check again!', 'Error', 'Err');
                    return false;
                }
                if (act == 'purchase_order'){
                    var id = $(this).attr('id');
                    if(id >= 3063){
                        var err_multi_qty = false;
                        $('input.spq, input.order-qty').filter(function() {
                            var tr = $(this).closest('tr');
                            if ($('input.spq').length && $('input.order-qty').length) {
                                var spq = parseInt(tr.find('input.spq').val().replace(/\s/g, '').replace(/,/g, ''));
                                var qty = parseInt(tr.find('input.order-qty').val().replace(/\s/g, '').replace(/,/g, ''));
                                if (qty < spq || qty % spq != 0) {
                                    $(this).addClass('err-multi-qty').delay(7000).queue(function() {
                                        $(this).removeClass('err-multi-qty');
                                    });
                                    err_multi_qty = true;
                                }
                            }
                        });
                        if (err_multi_qty) {
                            showNoti('Order quantity must be greater than SPQ and must be a multiple of SPQ', 'Warning', 'War');
                            return false;
                        }
                    }
                }else{
                    var err_multi_qty = false;
                    $('input.spq, input.order-qty').filter(function() {
                        var tr = $(this).closest('tr');
                        if ($('input.spq').length && $('input.order-qty').length) {
                            var spq = parseInt(tr.find('input.spq').val().replace(/\s/g, '').replace(/,/g, ''));
                            var qty = parseInt(tr.find('input.order-qty').val().replace(/\s/g, '').replace(/,/g, ''));
                            if (qty < spq || qty % spq != 0) {
                                $(this).addClass('err-multi-qty').delay(7000).queue(function() {
                                    $(this).removeClass('err-multi-qty');
                                });
                                err_multi_qty = true;
                            }
                        }
                    });
                    if (err_multi_qty) {
                        showNoti('Order quantity must be greater than SPQ and must be a multiple of SPQ', 'Warning', 'War');
                        return false;
                    }
                }



            }
        }
        if ($('.check-field').length) {
            var errField = false;
            $('.check-field').each(function() {
                var id = $(this).attr('id');
                if ($(this).next('.err' + id).val() == 1) {
                    $('.err' + id).find('span').html('Please enter ' + $(this).closest('.form-group').prev('.control-label').text() + ' other')
                    showErrOfField('err' + id, id);
                    errField = true;
                }
            });
            if (errField) {
                return false;
            }
        }
        if ($('div[contenteditable]').length) {
            $('div[contenteditable]').each(function () {
                var textarea = $(this).next('textarea');
                var content  = $(this).html();

                var escaped = decode_html(content);
                var escaped = remove_tags(escaped, 'textarea');

                textarea.val(escaped);


            });
        }
    });

}

        $('#info-order').collapse('show');
        $('#info-order').addClass('in');
        $('#info-order').prev().find('a[data-toggle="collapse"]').removeClass('collapsed');
        $('.panel-sticky, #itemList').removeAttr('style');
        $('.mainTable').stickyTableHeaders({
            fixedOffset: $('#page-header').height() + ($('.group-process').length ? 32 : 0)
        });

    $('#info-order').on('shown.bs.collapse', function(e) {
      //  alert
        $('#itemList').removeClass('margin-itemlist-po');
        $('#itemList').removeClass('margin-itemlist-cpo');
        $('.approved_close').css('margin-right', '42px');
        if ($(this).is(e.target)) {
            $('.title-info').show();
            $('.title-info-details').hide();
            $('#NumberOfDepositPayment').removeClass('disabled');
        }
        if (act == 'sup_rfq'){
            $('#info-order').collapse('show');
            $('#info-order').addClass('in');
            $('#info-order').prev().find('a[data-toggle="collapse"]').removeClass('collapsed');
            $('.panel-sticky, #itemList').removeAttr('style');
            $('.mainTable').stickyTableHeaders({
                fixedOffset: $('#page-header').height() + ($('.group-process').length ? 32 : 0)
            });
        }

    });

    $('#info-order').on('hidden.bs.collapse', function(e) {
        if ($(this).is(e.target)) {
            $('.title-info').hide();
            $('.title-info-details').show();
            $('#NumberOfDepositPayment').addClass('disabled');
        }
        if (act == 'purchase_order'){
            // $.cookie('show-on-info', 0, {
            //     path: '/'
            // });
            var element = document.getElementById("itemList");
            element.classList.add("margin-itemlist-po");
        }
        if (act == 'customer_purchase_order'){
            // $.cookie('show-on-info', 0, {
            //     path: '/'
            // });
            var element = document.getElementById("itemList");
            element.classList.add("margin-itemlist-cpo");
        }
        if (act == 'sup_rfq'){
            // $.cookie('show-on-info', 0, {
            //     path: '/'
            // });
            var element = document.getElementById("itemList");
            element.classList.add("margin-itemlist-cpo");
        }
    });



    $('.title-item-info a').click(function() {
        if ($(this).hasClass('collapsed')) {
            $(this).parent().find('i').removeClass('fa-caret-right').addClass('fa-caret-down');
        } else {
            $(this).parent().find('i').removeClass('fa-caret-down').addClass('fa-caret-right');
        }
    });
    /* #collapse order */

    if ($('#uploader').length) {
        var dir = $('#uploader').data('dir');
        $('#uploader').uploadFile({
            url: site_url + 'ajax/upload',
            fileName: 'myfile',
            formData: {
                'dir': dir
            },
            uploadButtonClass: 'btn btn-border btn-alt btn-hover border-orange font-orange waves-effect',
            dragDropStr: '<span> Drag and drop files here</span>',
            allowedTypes: 'xlsx,xls',
            uploadErrorStr: 'File is not valid!',
            multiple: false,
            showErrType: 1,
            onSuccess: function(files, data) {
                $('.unsetImport').hide();
                $('.issetImport').show();
                $('.ajax-file-upload-statUSDar').fadeOut();
                showNoti('File: ' + data, 'Reading data', 'War');
                showProcess(1);
                $('#file').val(data);
                $.ajax({
                    url: site_url + 'ajax/imports',
                    type: 'POST',
                    cache: false,
                    data: {
                        file: data,
                    },
                    success: function(string) {
                        showNoti('File: ' + data, 'Read data complete', 'Ok');
                        var getData = $.parseJSON(string);
                        var options = '';
                        for (var i = 0; i < getData.allSheetNames.length; i++) {
                            options += '<option value="' + i + '">' + getData.allSheetNames[i] + '</option>';
                        }
                        $('#sheet').html(options).trigger('chosen:updated').change();
                    }
                });
            }
        });
    }

    $('#Currency').bind('change', inputNumb);

    $('#FirstPayment').bind('change', function() {
        var val = parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        var total = 0.0;
        var currency = $('#Currency').val();
        if (currency == 'USD') {
            total = parseFloat($('input.total-usd').val().replace(/\s/g, '').replace(/,/g, ''));
            if (val > total) {
                showNoti('First Payment is greater than total', 'Error', 'Err');
                $(this).val(accounting.formatMoney(0, '', 2));
                $('#RestPayment').val(accounting.formatMoney(0, '', 2));
                return false;
            }
            $(this).val(accounting.formatMoney(val, '', 2));
            $('#RestPayment').val(accounting.formatMoney(total - val, '', 2));
        }
        if (currency == 'VND') {
            total = parseFloat($('input.total-vnd').val().replace(/\s/g, '').replace(/,/g, ''));
            if (val > total) {
                showNoti('First Payment is greater than total', 'Error', 'Err');
                $(this).val(accounting.formatMoney(0, '', 0));
                $('#RestPayment').val(accounting.formatMoney(0, '', 0));
                return false;
            }
            $(this).val(accounting.formatMoney(val, '', 0));
            $('#RestPayment').val(accounting.formatMoney(total - val, '', 0));
        }
    });

    $('#close-sidebar').click(function() {
        if ($('body').hasClass('closed-sidebar')) {
            $('#divSearch').css('left', '220px');
        } else {
            $('#divSearch').css('left', '46px');
        }
    });
    if ($('body').hasClass('closed-sidebar')) {
        $('#divSearch').css('left', '46px');
    } else {
        $('#divSearch').css('left', '220px');
    }
    $("#divSearch").hover(function() {
        $('#divSearch div').css('max-height', '300px');
    }, function() {
        $('#divSearch div').css({
            'max-height': '0px',
            transition: 'max-height 1s'
        });
    });

    $('.bootstrap-datepicker').datepicker({
        format: 'yyyy-mm-dd',
        language: 'vi',
        autoclose: true,
        todayHighlight: true
    });

    $('.bootstrap-datepicker-vi').datepicker({
        format: 'dd-mm-yyyy',
        language: 'vi',
        autoclose: true,
        todayHighlight: true
    });

    $('.bootstrap-timepicker').datetimepicker({
        format: 'LT'
    });
    // Panel fixed
    var act = $('#act').val();
    setTimeout( function() {
        if( act=="customer_purchase_order"){
            $('.mainTable').stickyTableHeaders({
                fixedOffset: $('#page-header').height() + ($('.group-process').length ? 35 : 0)
            });
        }
      }
        , 5000);

    $('body').on('click', 'a[href="#info-order"]', function() {
        panel_fix();

        if(act!="customer_purchase_order"){
            $('.mainTable').stickyTableHeaders({
                fixedOffset: $('#page-header').height() + ($('.group-process').length ? 77 : 0)
            });
        }else if(act=="customer_purchase_order"){
            $('.mainTable').stickyTableHeaders({
                fixedOffset: $('#page-header').height() + ($('.group-process').length ? 35 : 0)
            });
        }
        else{
            $('.mainTable').stickyTableHeaders({
                fixedOffset: $('#page-header').height() + ($('.group-process').length ? 35 : 0)
            });
        }

        if (!$('#info-order').hasClass('in')) {
            $('.panel-sticky, #itemList').removeAttr('style');
            $('.mainTable').stickyTableHeaders({
                fixedOffset: $('#page-header').height() + ($('.group-process').length ? 32 : 0)
            });
        }
        if(act == 'sup_rfq'){
            $('.panel-sticky').css({
                'position': 'absolute',
            });
        }
    }).on('click', '#close-sidebar', function() {
        if (!$('#info-order').hasClass('in')) {
            if ($('body').hasClass('closed-sidebar')) {

                $('.panel-sticky').css({
                    'position': 'fixed',
                    'width': 'calc(100% - 80px)',
                    'top': '71px',
                    'right': '20px',
                    'z-index': '3',
                });
                $('.group-process').css('width', 'calc(100% - 80px)');

            } else {
                $('.panel-sticky').css({
                    'position': 'fixed',
                    'width': 'calc(100% - 260px)',
                    'top': '71px',
                    'right': '20px',
                    'z-index': '3',
                });
                $('.group-process').css('width', 'calc(100% - 260px)');
            }

        }
        if (act == 'purchase_order'){
            // $('.approved_close').css('margin-right', '15px');
            c.css('margin-top', '150px');
        }else{
            $('#itemList').css('margin-top', '50px');
        }
    }).on('click', '.show-rfq-request', function() {
        $('#rfqRequestModal').modal('show');
        $('#rfqRequestModal').find('input[type="hidden"][name="SalesOrderID"]').val($(this).data('id'));
        var SOID = $(this).data('id');
        var status = $(this).data('status');

        // display button "Thực Hiện"
        switch (status) {
            case 0:
            case 3:
            case 4:
            case 5:
                $('.btn-success-rfq').show()
                break;
            default:
                $('.btn-success-rfq').hide()
                break;
        }


        if (status == 4 || status == 0) {
            $('#rfqRequestModal form').append('<input type="hidden" name="RFQSTT" value="1" />');
        }
        if (status == 3 || status == 5) {
            $('#rfqRequestModal form').append('<input type="hidden" name="RFQSTT" value="4" />');
        }
        if ( status == 4 ) {
            $('#code').prop('readonly', false);
            $('#RFQDate').removeClass( "disabled" );
            $.ajax({
                url: site_url + 'sales_order/rfq_info',
                type: 'POST',
                cache: false,
                data: {
                    id: SOID
                },
                success: function(string) {
                    var getData = $.parseJSON(string);
                    $('[type="hidden"][name="RFQID"]').val(getData.RFQid);
                    $('[name="ProjectName"]').val(getData.project_name);
                    $('[name="Project"]').val(getData.Project).trigger('chosen:updated');;
                    $('[name="EndCustomerName"]').val(getData.end_cus_name);
                    $('[name="StageOfProject"]').val(getData.project_stage).trigger('chosen:updated');
                    $('[name="PlannedAnnualVolume"]').val(getData.est_amount_unit);
                    $('[name="QuantityOfPrototyping"]').val(getData.prototype_qty);
                    $('[name="DateOfProduction"]').val(getData.mp_date);
                    $('[name="ProductQuantity"]').val(getData.mp_qty);
                    $('[name="DateOfPrototyping"]').val(getData.prototype_date);
                    $('[name="RegistrationDate"]').val(getData.regis_date);
                    $('[name="RegistrationStatus"]').val(getData.regis_status).trigger('chosen:updated');
                    $('[name="ApplicationType"]').val(getData.application_type).trigger('chosen:updated');
                    $('[name="DesignHouse"]').val(getData.design_house);
                    $('[name="ManufacturingName"]').val(getData.manufracture);
                    $('[name="ManufacturingCountry"]').val(getData.ems_country).trigger('chosen:updated');
                    $('[name="CustomerID"]').val(getData.CustomerID);
                    $('[name="CustomerRank"]').val(getData.CustomerRank);

                    $('[name="CustomerIDName"]').val(getData.CustomerIDName);
                    $('[name="QuotationReceiver"]').val(getData.QuotationReceiver);
                    $('[name="SampleStatus"]').val(getData.SampleStatus).trigger('chosen:updated');
                    $('[name="DesignStatus"]').val(getData.DesignStatus).trigger('chosen:updated');
                    $('[name="POConfidence"]').val(getData.POConfidence);
                    $('[name="QuotationTitle"]').val(getData.QuotationTitle);
                    $('[name="SampleTestDate"]').val(getData.SampleTestDate);
                    $('[name="DesiginData"]').val(getData.DesiginData);
                    $('[name="ESTPO"]').val(getData.ESTPO);
                    $('#code').val(getData.RFQcode);

                    // $('[name="CurrentAnnualQuantity"]').val(getData.CurrentAnnualQuantity);
                    // $('[name="EmergingAccount"]').prop('checked', getData.EmergingAccount == 1 ? true : false);
                    // $('[name="RFQDate"]').val(getData.RFQDate);
                    // var getProject = $.parseJSON(getData.project);
                    // var options = '<option value="">Select ...</option>';
                    // for (var i = 0; i < getProject.length; i++) {
                    //     options += '<option value="' + getProject[i]['id'] + '"' + (getData.Project == getProject[i]['id'] ? ' selected="selected"' : '') + '>' + getProject[i]['id'] + ' - ' + getProject[i]['ProjectName'] + '</option>';
                    // }
                    // $('#Project').empty().append(options).trigger('chosen:updated');


                }
            });
        }else if(status == 3 || status == 5 ){

            $('#code').prop('readonly', false);
            $('#RFQDate').removeClass( "disabled" );
            $.ajax({
                url: site_url + 'sales_order/rfq_info',
                type: 'POST',
                cache: false,
                data: {
                    id: SOID
                },
                success: function(string) {
                    var getData = $.parseJSON(string);
                    console.log(getData);
                    $('[type="hidden"][name="RFQID"]').val(getData.RFQid);
                    $('#code').val(getData.RFQcode).addClass("disabled");
                    $('[name="RFQDate"]').val(getData.RFQdate);
                    $('[name="ProjectName"]').val(getData.project_name);
                    $('[name="Project"]').val(getData.Project).trigger('chosen:updated');;
                    $('[name="EndCustomerName"]').val(getData.end_cus_name);
                    $('[name="StageOfProject"]').val(getData.project_stage).trigger('chosen:updated');
                    $('[name="PlannedAnnualVolume"]').val(getData.est_amount_unit);
                    $('[name="QuantityOfPrototyping"]').val(getData.prototype_qty);
                    $('[name="DateOfProduction"]').val(getData.mp_date);
                    $('[name="ProductQuantity"]').val(getData.mp_qty);
                    $('[name="DateOfPrototyping"]').val(getData.prototype_date);
                    $('[name="RegistrationDate"]').val(getData.regis_date);
                    $('[name="RegistrationStatus"]').val(getData.regis_status).trigger('chosen:updated');
                    $('[name="ApplicationType"]').val(getData.application_type).trigger('chosen:updated');
                    $('[name="DesignHouse"]').val(getData.design_house);
                    $('[name="ManufacturingName"]').val(getData.manufracture);
                    $('[name="ManufacturingCountry"]').val(getData.ems_country).trigger('chosen:updated');
                    $('[name="CustomerID"]').val(getData.CustomerID);
                    $('[name="CustomerRank"]').val(getData.CustomerRank);
                    $('[name="CustomerIDName"]').val(getData.CustomerIDName);
                    $('[name="QuotationReceiver"]').val(getData.QuotationReceiver);
                    $('[name="SampleStatus"]').val(getData.SampleStatus).trigger('chosen:updated');
                    $('[name="DesignStatus"]').val(getData.DesignStatus).trigger('chosen:updated');
                    $('[name="POConfidence"]').val(getData.POConfidence);
                    $('[name="QuotationTitle"]').val(getData.QuotationTitle);
                    $('[name="SampleTestDate"]').val(getData.SampleTestDate);
                    $('[name="DesiginData"]').val(getData.DesiginData);
                    $('[name="ESTPO"]').val(getData.ESTPO);
                    // $('#code').val(getData.RFQcode);
                    $('[name="RFQDate"]').val(getData.RFQdate).addClass("disabled");
                }
            });
        }
        else{
            $.ajax({
                url: site_url + 'sales_order/rfq_info',
                type: 'POST',
                cache: false,
                data: {
                    id: SOID
                },
                success: function(string) {
                    var getData = $.parseJSON(string);
                    console.log(getData);
                    // $('[type="hidden"][name="RFQID"]').val(getData.id);
                    $('[name="ProjectName"]').val(getData.project_name);
                    $('[name="Project"]').val(getData.Project).trigger('chosen:updated');;
                    $('[name="EndCustomerName"]').val(getData.end_cus_name);
                    $('[name="StageOfProject"]').val(getData.project_stage).trigger('chosen:updated');
                    $('[name="PlannedAnnualVolume"]').val(getData.est_amount_unit);
                    $('[name="QuantityOfPrototyping"]').val(getData.prototype_qty);
                    $('[name="DateOfProduction"]').val(getData.mp_date);
                    $('[name="ProductQuantity"]').val(getData.mp_qty);
                    $('[name="DateOfPrototyping"]').val(getData.prototype_date);
                    $('[name="RegistrationDate"]').val(getData.regis_date);
                    $('[name="RegistrationStatus"]').val(getData.regis_status).trigger('chosen:updated');
                    $('[name="ApplicationType"]').val(getData.application_type).trigger('chosen:updated');
                    $('[name="DesignHouse"]').val(getData.design_house);
                    $('[name="ManufacturingName"]').val(getData.manufracture);
                    $('[name="ManufacturingCountry"]').val(getData.ems_country).trigger('chosen:updated');
                    $('[name="CustomerID"]').val(getData.CustomerID);
                    $('[name="CustomerRank"]').val(getData.CustomerRank);
                    $('[name="CustomerIDName"]').val(getData.CustomerIDName);
                    $('[name="QuotationReceiver"]').val(getData.QuotationReceiver);
                    $('[name="SampleStatus"]').val(getData.SampleStatus).trigger('chosen:updated');
                    $('[name="DesignStatus"]').val(getData.DesignStatus).trigger('chosen:updated');
                    $('[name="POConfidence"]').val(getData.POConfidence);
                    $('[name="QuotationTitle"]').val(getData.QuotationTitle);
                    $('[name="SampleTestDate"]').val(getData.SampleTestDate);
                    $('[name="DesiginData"]').val(getData.DesiginData);
                    $('[name="ESTPO"]').val(getData.ESTPO);
                    if (getData.RFQdate) {
                        $('[name="RFQDate"]').val(getData.RFQdate).addClass("disabled");

                    }
                    if (getData.RFQcode) {
                        $('#code').val(getData.RFQcode).prop('readonly', true);

                    }
                }
            });
        }
    }).on('submit', '#rfqRequestModal form', function() {
        var err = 0;
        var form = $('#rfqRequestModal');
        form.find('[data-required="1"]').each(function() {
            var inputEle = $(this);
            var value = $(this).val();
            var id = $(this).attr('id');
            var trEle = inputEle.parent().parent();
            if (trEle.prop('tagName').toUpperCase() == 'TD') {
                trEle = inputEle.parent().parent().parent();
            }
            if ((value == '' || value == null) && !trEle.hasClass('hide')) {
                err = 1;
                if ($('.tab-content').length) {
                    var tabEle = inputEle.parent().parent().parent().parent().parent();
                    if (tabEle.is(':hidden')) {
                        var errMes = inputEle.parent().find('.errordiv').text();
                        showNoti(errMes, 'Error', 'Err');
                    } else {
                        showErrOfField(id, id);
                    }
                } else {
                    showErrOfField(id, id);
                }
                return false;
            }
        });
        if (err != 1) {
            form.find('.btn').attr('disabled', true);
            showProcess(1);
            // return true;
            // showProcess(1);
            // $('#rfqRequestModal .modal-footer .btn').attr('disabled', true);
            $.ajax({
                url: site_url + 'sales_order/rfq_request',
                type: 'POST',
                cache: false,
                data: $('#rfqRequestModal form').serialize(),
                success: function(string) {
                    // console.log(string);
                    window.location = window.location;
                },
            });

        }
        return false;
    }).on('hidden.bs.modal', '#rfqRequestModal', function(e) {
        $('input[name="RFQID"]').val('');
        $('input[name="SalesOrderID"]').val('');
        $('input[name="code"]').val($(this).data('code'));
        $('input[name="ProjectName"]').val('');
        $('input[name="ProjectDescription"]').val('');
        $('input[name="CustomerID"]').val('');
        $('input[name="CustomerIDName"]').val('');
        $('input[name="EndCustomerName"]').val('');
        $('input[name="EndCustomerCountry"]').val('');
        $('input[name="EmergingAccount"]').attr('checked', false);
        $('input[name="DateOfPrototyping"]').val('');
        $('input[name="DateOfProduction"]').val('');
        $('input[name="RFQDate"]').val('');
        $('input[name="DesignHouse"]').val('');
        $('input[name="ApplicationType"]').val('');
        $('input[name="ManufacturingName"]').val('');
        $('input[name="ManufacturingCountry"]').val('');
        $('input[name="CurrentAnnualQuantity"]').val('');
        $('input[name="QuantityOfProTotyping"]').val('');
        $('input[name="PlannedAnnualVolume"]').val('');
        $('#rfqRequestModal form input[type="hidden"][name="RFQSTT"]').remove();
    }).on('change', '.cb-all', function() {
        var table = $(this).closest('table');
        var checkboxes = table.find(':checkbox').not($(this));
        if ($(this).is(':checked')) {
            checkboxes.prop('checked', true);
            table.find('.cb-ele:not(:disabled)').prop('checked', true);
            table.find('tr.highlightNoClick').addClass('selected').trigger('change');
        } else {
            checkboxes.prop('checked', false);
            table.find('.cb-ele:not(:disabled)').prop('checked', false);
            table.find('tr.highlightNoClick').removeClass('selected');
        }
    }).on('change', '.cb-ele', function() {
        var table = $(this).closest('table');
        if ($(this).is(':checked')) {
            $(this).closest('tr.highlightNoClick').addClass('selected');
        } else {
            $(this).closest('tr.highlightNoClick').removeClass('selected');
        }
        if (table.find('.cb-ele').length && table.find('.cb-ele').length == table.find('.cb-ele:checked').length) {
            table.find('.cb-all').prop('checked', true);
        } else {
            table.find('.cb-all').prop('checked', false);
        }
    }).on('change', 'fieldset legend input[type="checkbox"]', function() {
        var parent = $(this).closest('fieldset');
        var checkboxes = parent.find(':checkbox').not(':disabled, #chk_allpage', $(this));
        if ($(this).is(':checked')) {
            checkboxes.prop('checked', true);
            parent.find('input[type="checbox"]:not(:disabled)').prop('checked', true);
        } else {
            checkboxes.prop('checked', false);
            parent.find('input[type="checbox"]:not(:disabled)').prop('checked', false);
        }
    }).on('click', '#addRow',function() {
        var btn = $(this);
        if ($('#act').val() == 'purchase_order' ) {
            var key = parseInt($('#itemList table tbody .highlightNoClick').length) + 1;
        }else if($('#act').val() == 'sup_rfq'){
            var key = parseInt($('#itemList table tbody .highlightNoClick .stt').length) + 1 ;
        }else{
            var key = parseInt($('#itemList table tbody .highlightNoClick:last td input.itemKey').val()) + 1;
        }
        if ($('#itemList table tbody .highlightNoClick').length == 0) {
            key = 1;
        }
        var data = {
            new_flag: true,
            key: key,
        }
        add_row(data);
        updateNO();
        btn.attr('disabled', 'disabled');
        setTimeout(function() { btn.removeAttr('disabled') }, 1000);

        // only for purchase_order
        if ($('#act').val() == 'purchase_order') {
            $('.bootstrap-datepicker').datepicker({
                format: 'yyyy-mm-dd',
                language: 'vi',
                autoclose: true,
                todayHighlight: true
            });
            $( ".shipmentBalance" ).change(function() {
                var id = this.id;
                var value = $( this ).val();
                var btn = $(this).closest('tr').prev();
                if( id > 1){
                    var sumshipment = parseFloat(btn.find('.balance').val().replace(/\s/g, '').replace(/,/g, ''));
                }else{
                    var sumshipment =  parseFloat(btn.find('.order-qty').val().replace(/\s/g, '').replace(/,/g, ''));
                    console.log(sumshipment);
                }
                var Balance = 0;
                if( value > sumshipment){
                    showNoti('Vui lòng chọn Số lượng Shipped Qty nhỏ hơn Order Qty', 'Cảnh báo', 'War');

                }else{
                    Balance = (sumshipment - value);
                    // console.log(Balance);
                    $(this).closest('tr').find('.balance').val(accounting.formatMoney(Balance, '', 0));
                }
            });
        }
        // #only for purchase_order
        // Sale order

    }).on('click', '#removeRow', function () {

        var table = $('#itemList table');
        var checked = table.find('input:checked:not(".cb-all")').closest('tr');

        if (checked.length > 0) {
            $.alerts.confirm('Do you want delete this?', 'Confirm', function (r) {
                if (r) {
                    table.find('.cb-all').prop('checked', false);
                    updateNO();
                    if ($('#act').val() == 'sup_rfq') {
                        check_attribution_mfr();
                        var line2 = table.find('input:checked:not(".cb-all")').closest('tr').next();
                        line2.remove();
                    }else{
                        // updateDataSum();
                    }
                    // only for RFQ
                    if ($('#act').val() == 'rfq') {
                        check_attribution_mfr();
                    }
                    // #only for purchase_order
                    if ('purchase_order' == $('#act').val()) {
                        $('#itemList table').find('input:checked:not(".cb-all")').each(function () {
                          //  var suplierpart = this.id.replace(/\s/g, '').replace(/,/g, '').replace('/', '').replace('.', '');
                          var suplierpart = $(this).closest('tr').attr('id');
                          console.log({ suplierpart })
                          //  alert(suplierpart);
                           // var tdpart = $("tr[data-parent=]");
                           $(this).closest('tr').remove();
                           $(".table-part tr[data-parent="+suplierpart+"]").remove();
                        });
                    }else if($("#act").val()=='project_registration'){
                        $('#itemList table').find('input:checked:not(".cb-all")').each(function () {
                            //  var suplierpart = this.id.replace(/\s/g, '').replace(/,/g, '').replace('/', '').replace('.', '');
                            var child = $(this).closest('tr').data('id');
                            //  alert(suplierpart);
                             // var tdpart = $("tr[data-parent=]");
                             $(this).closest('tr').remove();
                             $("#itemList tr[data-id="+child+"]").remove();
                          });
                    }else{
                        checked.remove();
                    }

                }
            })
        }
    }).on('click', '.exports-file, .prints-file', function() {
        var title = $(this).data('original-title');
        var table = $('#act').val();
        /*if ($.inArray(table, ['positions','departmental_documentation'])) {
            table = $('#moduleInfo').attr('data-table');
        }*/

        $.ajax({
            url: site_url + 'modules/export_options',
            type: 'POST',
            cache: false,
            data: {
                table: table,
                title: title,
                uri_url: uri_url,
                rowstart: $('#rowstart').val(),
            },
            success: function(html) {
                $('#options-export .modal-content').html(html);
                $('#options-export').modal('show');
            }
        });
    }).on('change', '.field-excel', function() {
        var selValue = $(this).val();
        var sel = $(this).data('select');
        $('.field-excel').not($(this)).each(function() {
            if ($(this).find('option[value="' + selValue + '"]').is(':selected') && selValue != -1) {
                showNoti('No duplicate selected', 'Warning', 'War');
                $('.field-excel[data-select="' + sel + '"]').find('option').removeAttr('selected');
                $('.field-excel[data-select="' + sel + '"]').val(-1).trigger('chosen:updated');
            }
        });
    }).on('changeDate', '#itemList td .bootstrap-datepicker', function() {
        var currentDate = $(this);
        var parent = $(this).closest('tr');
        var dataDate = $(this).data('date');
        var exist = false;
        parent.find('td .bootstrap-datepicker[data-date="' + dataDate + '"]').each(function() {
            if (currentDate.val() < $(this).val()) {
                exist = true;
            }
        });
        if (exist) {
            showNoti('Invalid date', 'Warning', 'War');
            currentDate.val(null);
        }
    }).on('changeDate', '#ShippingDate', function() {
        $('#ReceivedDate').val(null);
    }).on('changeDate', '#ReceivedDate', function() {
        if ($(this).val() < $('#ShippingDate').val()) {
            showNoti('Invalid date', 'Warning', 'War');
            $(this).val(null);
        }
    }).on('changeDate', '#FirstPaymentDate', function() {
        $('#RestPaymentDate').val(null);
    }).on('changeDate', '#RestPaymentDate', function() {
        if ($(this).val() < $('#FirstPaymentDate').val()) {
            showNoti('Invalid date', 'Warning', 'War');
            $(this).val(null);
        }
    }).on('changeDate', '#DateOfFirstPayment', function() {
        $('#DateOfRestPayment').val(null);
    }).on('changeDate', '#DateOfRestPayment', function() {
        if ($(this).val() < $('#DateOfFirstPayment').val()) {
            showNoti('Invalid date', 'Warning', 'War');
            $(this).val(null);
        }
    }).on('changeDate', '#EstimatedTimeOfDeparture', function() {
        $('#EstimatedTimeOfArrival').val(null);
        $('#ActualTimeOfArrival').val(null);
    }).on('changeDate', '#EstimatedTimeOfArrival', function() {
        $('#ActualTimeOfArrival').val(null);
        if ($(this).val() < $('#EstimatedTimeOfDeparture').val()) {
            showNoti('Invalid date', 'Warning', 'War');
            $(this).val(null);
        }
    }).on('changeDate', '#ActualTimeOfArrival', function() {
        if ($(this).val() < $('#EstimatedTimeOfArrival').val() || $('#EstimatedTimeOfDeparture').val() == '' || $('#EstimatedTimeOfArrival').val() == '') {
            showNoti('Invalid date', 'Warning', 'War');
            $(this).val(null);
        }
    }).on('changeDate', '#DueDateFrom', function() {
        if ($('#DueDateTo').val() != '' && $(this).val() > $('#DueDateTo').val()) {
            showNoti('Invalid date', 'Warning', 'War');
            $(this).val(null);
        }
    }).on('changeDate', '#DueDateTo', function() {
        if ($('#DueDateFrom').val() != '' && $(this).val() < $('#DueDateFrom').val()) {
            showNoti('Invalid date', 'Warning', 'War');
            $(this).val(null);
        }
    }).on('mousedown', '.popover-beside-content select option', function(e) {
        e.preventDefault();
        $(this).prop('selected', $(this).prop('selected') ? false : true);
        $(this).attr('selected', $(this).attr('selected') ? false : true);
        var inf = $(this).closest('.popover-beside').find('.popover-inf');
        if ($(this).prop('selected') == true) {
            inf.append('<p class="' + $(this).val() + '">' + $(this).html() + '</p>');
        } else {
            inf.find('p.' + $(this).val()).remove();
        }
        return false;
    }).on('changeDate', '#EstimateDate', function() {
        if ($('#ActualDate').val() != '' && $(this).val() > $('#ActualDate').val()) {
            showNoti('Invalid date', 'Warning', 'War');
            $(this).val(null);
        }
    }).on('changeDate', '#ActualDate', function() {
        if ($('#EstimateDate').val() != '' && $(this).val() < $('#EstimateDate').val()) {
            showNoti('Invalid date', 'Warning', 'War');
            $(this).val(null);
        }
    }).on('click', '.print-option', function(e) {
        var option = $(this).data('print-option');
        if($('#act').val() == 'sales_order'){
            var ValidityNumber = $('#ValidityNumber').val();
            var ValidityDate = $('#ValidityDate').val();
            if (ValidityNumber.trim() == '') {
                showNoti('Validity date not empty', 'Warning', 'War');
                $('#ValidityNumber').css('border-color', 'red');
                return false;
            }
        }
        e.preventDefault();
        window.open(site_url + $('#act').val() + '/print_file/' + option + '/' + $('#id').val(), '_blank');
        return false;
    }).on('change', '.check-field', function() {
        var thisfield = $(this);
        var id = $('#id').val();
        var field = $(this).attr('name');
        var valfield = $(this).val();
        var table = $('#moduleInfo').data('table');
        if (field.trim() == '') {
            return false;
        }
        $(this).parent().append('<input type="hidden" class="err' + field + '" value=""><div class="errordiv err' + field + '">Please enter ' + thisfield.closest('.form-group').find('.control-label').text() + ' other!</div>')
        showProcess();
        $.ajax({
            url: site_url + 'ajax/check_field',
            type: 'POST',
            cache: false,
            data: {
                field: field,
                valfield: valfield,
                table: table,
                id: id,
            },
            success: function(string) {
                if (string.trim() == 0) {
                    thisfield.css('border-color', 'green');
                    showNoti('You can use ' + thisfield.closest('.form-group').find('.control-label').text(), 'Check the code', 'Ok');
                    $('input[class="err' + field + '"]').val(0);
                } else {
                    thisfield.css('border-color', 'red');
                    showNoti('You can not use ' + thisfield.closest('.form-group').find('.control-label').text() + thisfield.closest('.form-group').find('.control-label').text() + ', it already exists', 'Check the code', 'Err');
                    $('input[class="err' + field + '"]').val(1);
                }
            }
        });
    }).on('change', '#USDExchangeRate', function() {
        var usd_rate = $(this).val();
        $(this).val(accounting.formatMoney(usd_rate, '', 0));
        $('#itemList .highlightNoClick').each(function() {
            var e = $(this);
            var priceVND = parseFloat(e.find('.unit-price-usd').val()) * parseFloat($('#USDExchangeRate').val().replace(/\s/g, '').replace(/,/g, ''));
            e.find('.unit-price-vnd').val(accounting.formatMoney(priceVND, '', 0));
            updateDataItem(e);
        });
    }).on('change', '.ctp', function(event) {
        $(this).val(accounting.formatMoney($(this).val(), '', 4));
    }).on('click', '.warning-refresh .close i', function() {
        $(this).closest('.warning-refresh').removeClass('show').fadeOut();
        // $('body').css('overflow', 'auto');
        var date = new Date();
        var minutes = 1440;
        date.setTime(date.getTime() + (minutes * 60 * 1000));
        $.cookie('hide_warning_refresh', 1, {
            path: '/',
            expires: date
        });
    }).on('click', '.btn-remove-inv', function() {
        var grandParent = $(this).closest('.fg-wrap-invoices');
        var parent = $(this).closest('.fg-inv');
        parent.remove();
        if (!grandParent.find('.fg-inv').length) {
            $('.fg-header-invoices').addClass('hidden');
        }
        enBTNIVN();
        anrDataRequired()
    }).on('click', '.btn-add-inv', function() {
        var wrap = $('.fg-wrap-invoices');
        var key = 0;
        if ($('.fg-wrap-invoices .fg-inv').length) {
            key = wrap.find('.fg-inv').last().find('.invKey').val();
        }
        key = parseInt(key) + 1;
        $('.fg-header-invoices').removeClass('hidden');
        addInvoice(key);
        enBTNIVN();
        anrDataRequired()
    }).on('click', '.btn-remove-pi', function() {
        var parent = $(this).closest('.fg-inv');
        parent.find('input').val('');
        parent.addClass('hidden');
        enBTNIVN();
        anrDataRequired()
    }).on('click', '.btn-add-pi', function() {
        var wrap = $(this).closest('.fg-wrap.fg-wrap-pis');
        var last = wrap.find('.fg-inv:not(.hidden)').last();
        last.next().find('input').val('');
        last.next().removeClass('hidden');
        wrap.find('.fg-inv:not(.hidden)').find('.btn-remove-pi').addClass('disabled')
        enBTNIVN();
        anrDataRequired()
    }).on('change', '.currency-unit', function() {
        var _currency = $('#Currency').val(),
            _that = $(this),
            _val = $(this).val();
        if (_currency != 'VND') {
            _that.val(accounting.formatMoney(_val, '', 2));
        } else {
            _that.val(accounting.formatMoney(_val, '', 0));
        }
    }).on('focus', '.currency-unit', function() {
        $(this).select();
    }).on('change', '.input-number', function() {
        var _that = $(this),
            _val = $(this).val();
        _that.val(accounting.formatMoney(_val, '', 0));
    }).on('change', '.unit-price-usd', function() {
        var val = parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        var e = $(this).parent().parent();
        $(this).val(accounting.formatMoney(val, '', 5));
        if (e.find('.unit-price-vnd').length) {
            var priceVND = val * parseFloat($('#USDExchangeRate').val().replace(/\s/g, '').replace(/,/g, ''));
            e.find('.unit-price-vnd').val(accounting.formatMoney(priceVND, '', 0));
        }
        updateDataItem(e);
    }).on('change', '.unit-price-vnd', function() {
        var val = parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        var e = $(this).parent().parent();
        $(this).val(accounting.formatMoney(val, '', 0));
        if (e.find('.unit-price-usd').length) {
            var priceUSD = val / parseFloat($('#USDExchangeRate').val().replace(/\s/g, '').replace(/,/g, ''));
            e.find('.unit-price-usd').val(accounting.formatMoney(priceUSD, '', 4));
        }
        updateDataItem(e);
    }).on('click', '.btn-get-deposit', function() {
        if ($('.show-deposit').length) {
            $('.show-deposit').remove();
        }
        var btnDeposit = $(this);
        var string = '<div class="show-deposit"><table><thead><tr><th>Value</th><th>Date</th></tr></thead>';
        $('.gDP').each(function() {
            if ($(this).is(':visible')) {
                string += '<tr><td><input type="hidden" value="' + $(this).find('.depositpayment').val() + '">' + $(this).find('.depositpayment').val() + '</td><td>' + $(this).find('.bootstrap-datepicker').val() + '</td></tr>';
            }
        });
        string += '</table></div>';
        btnDeposit.parent().append(string);
    }).on('mouseup', function(e) {
        if (!$('.show-deposit').is(e.target) && $('.show-deposit').has(e.target).length === 0) {
            $('.show-deposit').remove();
        }
    }).on('click', '.show-deposit tr', function() {
        var currency = 0;
        if ($('#Currency').val() == 'USD') currency = 2;
        var tr = $(this);
        var invoiceDeposit = $(this).closest('.input-group-btn').prev();
        var parent = $(this).closest('.fg-inv');
        var valInvoice = parseFloat(parent.find('.val-inv').val().replace(/\s/g, '').replace(/,/g, ''));
        var val = parseFloat(tr.find('input').val().replace(/\s/g, '').replace(/,/g, ''));
        if (valInvoice == '' || valInvoice < val) {
            showNoti('Value of Invoice must not be empty or must be greater than Deposit Invoice', 'Warning', 'War');
        } else {
            invoiceDeposit.val(accounting.formatMoney(val, '', currency));
            parent.find('.rest-inv').val(accounting.formatMoney(valInvoice - val, '', currency));
        }
        return false;
    }).on('change', '#Currency', function() {
        var currency = 0;
        if ($('#Currency').val() == 'USD') currency = 2;
        var val = $(this).val();
        if (val == 'USD') {
            $('.currency-unit').each(function() {
                $(this).val(accounting.formatMoney(0, '', currency));
            })
        } else {
            $('.currency-unit').each(function() {
                $(this).val(accounting.formatMoney(0, '', currency));
            })
        }
        updateMoney();
    }).on('change', '.depo-inv', function() {
        var currency = 0;
        if ($('#Currency').val() == 'USD') currency = 2;
        var val = parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        var parent = $(this).closest('.fg-inv');
        var valInvoice = parseFloat(parent.find('.val-inv').val().replace(/\s/g, '').replace(/,/g, ''));
        if (valInvoice == '' || valInvoice < val) {
            $(this).val(accounting.formatMoney(0, '', currency));
            showNoti('Value of Invoice must not be empty or must be greater than Deposit Invoice', 'Warning', 'War');
        } else {
            parent.find('.rest-inv').val(accounting.formatMoney(valInvoice - val, '', currency));
        }
        return false;
    }).on('change', '.val-inv', function() {
        var currency = 0;
        if ($('#Currency').val() == 'USD') currency = 2;
        $(this).closest('.fg-inv').find('.depo-inv').val(accounting.formatMoney(0, '', currency));
        $(this).closest('.fg-inv').find('.rest-inv').val(accounting.formatMoney($(this).val(), '', currency));
    }).on('change', '#limit_year', function() {
//alert(1);
        var limit_year = $(this).val();
        $.cookie('page_year'+$('#act').val()+'', limit_year, {
            path: '/'
        });
        window.location = window.location;
    }).on('change','.e_time', function(){
        var _that = $(this);
        $e_date = _that.val();
        $s_date = _that.parent().prev().find('.s_time').val();
        if($s_date == ''){
            showNoti('You have not selected a start date', 'Warning', 'War');
            _that.val('');
            return false;
        }
        if(!compare2dates($e_date, $s_date)){
            showNoti('The end date must be greater than the start date', 'Warning', 'War');
            _that.val('');
            return false;
        }
        return true;
    }).on('change','.s_time', function(){
        var _that = $(this);
        var _next = _that.parent().next().find('.e_time');
        if (_that.val() > _next.val()) {
            _next.val('');
        }
        return true;
    }).on('keyup', '.input-progress', function() {
        _that = $(this);
        var val = parseFloat(_that.val());
        if (val < 0 || val > 100) {
            showNoti('Value not valid!', 'Warning', 'War');
            _that.val(0);
            _that.select();
            return false;
        }
    }).on('click', '#remove-row', function() {
        if ($('tr.row-data .col-sel input[type="checkbox"]:checked').length) {
            $.alerts.confirm('Are you sure you want to delete the selected item?', 'Confirm', function(e) {
                if (e) {
                    $('tr.row-data .col-sel input[type="checkbox"]:checked').each(function() {
                        var tr = $(this).closest('tr');
                        var id = tr.attr('id');
                        var name = tr.data('name');
                        var table = tr.data('table');
                        if (id != '') {
                            $.ajax({
                                url: site_url + 'ajax/del_restore_item',
                                type: 'POST',
                                data: {
                                    table: table,
                                    id: id,
                                    mode: 'remove',
                                    name: name
                                },
                                success: function (resp) {
                                    if (resp == 1) {
                                        showNoti('Successfully deleted the <b>' + name + '</b> entry', 'Success', 'Ok');
                                        tr.remove();
                                        updateNo('#promotion_details', 'promotion_details');
                                    }
                                }
                            })
                        } else {
                            tr.remove();
                            updateNo('#promotion_details', 'promotion_details');
                        }
                    });
                    $('tr .col-sel input[type="checkbox"]').prop('checked', false);
                }
            })
        } else {
            showNoti('No data is selected for deletion', 'Warning', 'War');
            return false;
        }
    }).on('click', '.exports-file-custom', function () {

        var table_txt = $(this).data('table');
        var table = document.getElementById(table_txt);

        // abort modules
        if(table_txt && table_txt.includes('tasks','business_trip_customer')){
            return;
        }

        var name = $('#moduleInfo').data('type');
        var todaysDate = moment().format('DDMMYYYY');
        var filename = $('#act').val() + '-' + todaysDate;
        var blobURL = tableToExcel(table, name);
        $(this).attr('download',filename + '.xls')
        $(this).attr('href',blobURL);
    }).on('change', '.numb-not-noze', function() {
        var val = $(this).val().replace(/\s/g, '').replace(/,/g, '');
        if (isNaN(val) || val == '' || val <= 0) {
            $(this).val('');
        } else {
            $(this).val(accounting.formatMoney(val, '', 0));
            if ($(this).hasClass('err-noze')) $(this).removeClass('err-noze');
            if ($(this).hasClass('err-multi-qty')) $(this).removeClass('err-multi-qty');
        }
    }).on('change', 'input.spq', function() {
        var tr = $(this).closest('tr');
        var spq = parseInt($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        if (tr.find('input.order-qty').length) {
            var qty = parseInt(tr.find('input.order-qty').val().replace(/\s/g, '').replace(/,/g, ''));
            if (qty < spq || qty % spq != 0) {
                // tr.find('input.spq').val(0);
                showNoti('Order quantity must be greater than SPQ and must be a multiple of SPQ', 'Warning', 'War');

                $(this).addClass('err-multi-qty').delay(7000).queue(function() {
                    $(this).removeClass('err-multi-qty');
                });
            }
        }
    }).on('change', 'input.order-qty', function() {
        var tr = $(this).closest('tr');
        var qty = parseInt($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        if (tr.find('input.spq').length) {
            var spq = parseInt(tr.find('input.spq').val().replace(/\s/g, '').replace(/,/g, ''));
            if (qty < spq || qty % spq != 0) {
                // tr.find('input.order-qty').val(0);
                showNoti('Order quantity must be greater than SPQ and must be a multiple of SPQ', 'Warning', 'War');

                $(this).addClass('err-multi-qty').delay(7000).queue(function() {
                    $(this).removeClass('err-multi-qty');
                });
            }
        }
        updateDataItem(tr);
    }).on('hidden.bs.modal', '#importModal', function(e) {
        $('#sheet, #headerInfo, #footerInfo, #headerTitle, .field-excel, .divPreview .table.table-bordered').empty().trigger('chosen:updated');
        $('#headerInfo, #footerInfo, #headerTitle, .field-excel, .divPreview .table.table-bordered').attr('disabled', true);
        $('.unsetImport').show();
        $('.issetImport').hide();
        $.ajax({
            url: site_url +'ajax/delete_file',
            type: 'POST',
            data: { file: $('#file').val() },
        });
    }).on('click', '#btnPrint', function (e){
        e.preventDefault();
        window.open(site_url + $('#act').val() + '/print_file/' + $('#id').val(), '_blank');
        return false;
    }).on('click', '#btnExport', function (e){
        e.preventDefault();
        document.location.href = site_url + $('#act').val() + '/export_file/' + $('#id').val();
        return false;
    })

    function panel_fix() {
        $('#NumberOfDepositPayment').addClass('disabled');
        if ($('#info-order').hasClass('in')) {

            $('#NumberOfDepositPayment').removeClass('disabled');
            if ($('body').hasClass('closed-sidebar')) {
                    if (act == 'purchase_order'){
                        $('.panel-sticky').css({
                            'position': 'absolute',
                            'width': 'calc(100% - 80px)',
                            'right': '20px',
                        });
                    }
                    else if(act == 'customer_sales_contract'){
                        // do nothing
                    }
                    else
                    {
                        $('.panel-sticky').css({
                            'position': 'fixed',
                            'width': 'calc(100% - 80px)',
                            'top': '71px',
                            'right': '20px',
                        });
                    }

                } else {
                    $('.panel-sticky').css({
                        'position': 'fixed',
                        'width': 'calc(100% - 260px)',
                        'top': '71px',
                        'right': '20px',
                    });
                }

            if (act == 'purchase_order'){
                var element = document.getElementById("itemList");
                element.classList.add("margin-itemlist-po");
                $('.approved_close').css('margin-right', '1px');
            }else if(act == 'customer_purchase_order'){
                var element = document.getElementById("itemList");
                element.classList.add("margin-itemlist-po");
            }else if(act == 'customer_sales_contract'){
                // var value = $("#ap-information .Approved").find("option:selected").val();
                // console.log({value})
                // if(parseInt(value)>0)
                //     $('#itemList').css('margin-top', '150px');
            }
             else{
                $('#itemList').css('margin-top', '50px');
            }
        }

    }
});

function drapOrder() {
    $('#itemList .mainTable').tableDnD({
        onDragClass: 'myDragClass',
        onDragStart:function(table,target){

            this.key = $(target).closest("tr").data("row");
            this.isHaveLine2 = $('#itemList .mainTable .highlightNoClick1').length >0;

        },
        onDrop: function(table,currencyRow) {
            var highlightNoClick = $('#itemList .mainTable .highlightNoClick').length;

            for (var i = 0; i < highlightNoClick; i++) {
                $('#itemList .mainTable .highlightNoClick .stt:eq(' + i + ')').html(i + 1);
                $('#itemList .mainTable .highlightNoClick .itemKey:eq(' + i + ')').val(i + 1);
            }

            $('#itemList .mainTable tr').css('cursor', 'auto');

            if(this.isHaveLine2&&this.key){

                var row = $(table).find("[data-row="+this.key+"].highlightNoClick1");

                var keyNext = $(currencyRow).next().data("row");
                var keyBefore = $(currencyRow).prev().data("row");
                if(keyNext==keyBefore){
                    var LineBefore = $(table).find("[data-row="+keyNext+"].highlightNoClick1");
                    LineBefore.remove();
                    $(currencyRow).before(LineBefore);

                }

                row.remove();
                $(currencyRow).after(row);


            }
        },
        dragHandle: '.stt'
    });
}

function dndNo(handleTable, tableName, handle, category, field, orderby, ordermode) {
    var dragTable = $('#' + handleTable);
    if (tableName == null) tableName = handleTable;
    if (handle == null) handle = '.no';
    if (category == null) category = '';
    if (field == null) field = '';
    if (orderby == null) orderby = '';
    if (ordermode == null) ordermode = '';

    var rowstart = $('#rowstart').length ? parseInt($('#rowstart').val()) : 0;
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
                $('.no_' + rows[i].id).html(i + (thead ? 1 : 0) + rowstart);
            }
            if ($('.no_' + row.id).html() != $('#sort_order_' + row.id).val()) {
                showProcess();
                $.ajax({
                    url: site_url + 'ajax/sort_order',
                    type: 'POST',
                    cache: false,
                    data: {
                        IDs: IDs,
                        category: category,
                        field: field,
                        orderby: orderby,
                        ordermode: ordermode,
                        table: tableName,
                        rowstart: rowstart
                    },
                    success: function() {
                        for (var i = 0; i < rows.length; i++) {

                            $('#sort_order_' + rows[i].id).val(i + (thead ? 1 : 0) + rowstart);
                        }
                        showNoti('Successful arrangement', 'Success', 'Ok');
                    }
                });
            }
        },
        dragHandle: handle
    });
}

function inputNumb() {
    var RestPayment = 0.0;
    var FirstPayment = 0.0;
    if ($('input.total-usd').length) {
        var total = parseFloat($('input.total-usd').val().replace(/\s/g, '').replace(/,/g, ''));
    }
    var val = $('#Currency').val();
    var parent = $('[data-gDP]');
    if (total > 0) {
        if (val == 'USD') {
            if ($('.gDP').length) {
                parent.find('.gDP').each(function() {
                    $(this).find('.depositpayment').val(accounting.formatMoney(0, '', 2));
                });
            } else {
                FirstPayment = parseInt($('#FirstPayment').val().replace(/\s/g, '').replace(/,/g, '')) / parseInt($('#USDExchangeRate').val().replace(/\s/g, '').replace(/,/g, ''));
                $('#FirstPayment').val(accounting.formatMoney(FirstPayment, '', 2));
            }
            $('#RestPayment').val(accounting.formatMoney(total - FirstPayment, '', 2));
        }
        if (val == 'VND') {
            total = parseFloat($('input.total-vnd').val().replace(/\s/g, '').replace(/,/g, ''));
            if ($('.gDP').length) {
                parent.find('.gDP').each(function() {
                    $(this).find('.depositpayment').val(0);
                });
            } else {
                FirstPayment = parseFloat($('#FirstPayment').val().replace(/\s/g, '').replace(/,/g, '')) * parseInt($('#USDExchangeRate').val().replace(/\s/g, '').replace(/,/g, ''));
                $('#FirstPayment').val(accounting.formatMoney(FirstPayment, '', 0));
            }
            $('#RestPayment').val(accounting.formatMoney(total - FirstPayment, '', 0));
        }
    } else {
        $('#FirstPayment').val(0);
        $('#RestPayment').val(0);
    }
}

function updateMoney() {
    $('.money').autoNumeric('init', {
        'mDec': 0
    });

    $('.money2').autoNumeric('init', {
        'mDec': 2
    });
}

function updateNO() {

    for (var i = 0; i < $('#itemList table tbody .highlightNoClick').length; i++) {
        $('#itemList table tbody tr.highlightNoClick:eq(' + i + ') td:eq(1) .stt').text(i + 1);
    }
}

function updateNo(tableObj, tableName) {
    if (tableObj == null) tableObj = 'table';
    var IDs = '';
    var rowstart = $('#rowstart').length ? parseInt($('#rowstart').val()) : 0;
    if ($(tableObj).find('tr.row-data').length) {
        for (var i = 0; i < $(tableObj).find('tr.row-data').length; i++) {
            tr = $(tableObj).find('tr.row-data').eq(i);
            tr.find('.no').text(i + 1 + rowstart);
            IDs += tr.attr('id');
            if (i < $(tableObj).find('tr.row-data').length - 1) {
                IDs += ',';
            }
            $('.no_' + tr.attr('id')).html(i + 1 + rowstart);
        }
        $.ajax({
            url: site_url + 'ajax/sort_order',
            type: 'POST',
            cache: false,
            data: {
                IDs: IDs,
                table: tableName,
                rowstart: rowstart
            },
            success: function() {
                for (var i = 0; i < $(tableObj).find('tr.row-data').length; i++) {
                    $('#sort_order_' + $(tableObj).find('tr.row-data').eq(i).attr('id')).val(i + 1 + rowstart);
                }
                showNoti('Successful arrangement', 'Success', 'Ok');
            }
        });
    }
}

$(window).scroll(function() {
    if ($(this).scrollTop() > 0) {
        $('.panel-sticky').addClass('zindex');
    } else {
        $('.panel-sticky').removeClass('zindex');
    }
    if ($(this).scrollTop() > 30) {
        $('.group-process').css('width', '100%');
    } else {
        $('.group-process').css('width', 'auto');
    }
});

function isJSON(str) {
    if (/^[\],:{}\s]*$/.test(str.replace(/\\["\\\/bfnrtu]/g, '@').replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, ']').replace(/(?:^|:|,)(?:\s*\[)+/g, ''))) {
        return true;
    }
    return false;
}

function change_alias(alias, underscore = false) {
    var str = alias;
    str = str.toLowerCase();
    str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
    str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
    str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
    str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
    str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
    str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
    str = str.replace(/đ/g, "d");
    str = str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'|\"|\&|\#|\[|\]|~|\$|`|-|{|}|\||\\/g, " ");
    str = str.replace(/ + /g, " ");
    if (underscore) str = str.replace(/_/g, " ");
    str = str.trim();
    return str;
}

function anrDataRequired() {
    $('[class*="group-required"]').each(function() {
        if ($(this).css('display') != 'none') {
            $(this).find('.input-required').attr('data-required', '1');
        } else {
            $(this).find('.input-required').val('').removeAttr('data-required');
        }
    });
}

function enBTNIVN() {
    if ($('.fg-wrap').length) {
        $('.fg-wrap').each(function() {
            $(this).find('.fg-inv:not(.hidden)').last().find('.btn-inv').removeClass('disabled');
        })
    }
}

function inpdRequired(objectid = '') {
    var arr = [];
    var arrNew = [];
    var current = null;
    var cnt = 0;
    $(objectid).find('.inpd-required').each(function() {
        $(this).removeAttr('style');
        arr.push($(this).val());
    })
    arr.sort();
    if (arr.length > 0) {
        for (var i = 0; i < arr.length; i++) {
            if (arr[i] != current) {
                if (cnt > 1) arrNew.push(current);
                current = arr[i];
                cnt = 1;
            } else {
                cnt++;
            }
        }
    }
    if (cnt > 1) arrNew.push(current);
    if (arrNew.length > 0) {
        for (var j = 0; j < arrNew.length; j++) {
            $(objectid).find('.inpd-required').filter(function() { return this.value == arrNew[j] }).css('border-color', 'red');
        }
        showNoti('Lot code cannot be the same', 'Warning', 'War');
        return false;
    }
}

function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
}

function addInvoice(key) {
    if ($('.fg-wrap-invoices .fg-inv').length) {
        $('.fg-wrap-invoices .fg-inv').each(function() {
            $(this).find('.btn-remove-inv').addClass('disabled');
        });
    }
    var string = '<div class="form-group group-required fg-inv fg-inv-' + key + '">';
    string += '<input type="hidden" class="invKey" name="Invoice[' + key + '][SortOrder]" value="' + key + '">';
    string += '    <div class="row">';
    string += '        <div class="col-sm-6">';
    string += '             <div class="row">';
    string += '                 <div class="col-sm-3">';
    string += '                     <input type="text" class="form-control input-required" name="Invoice[' + key + '][InvoiceNo]" id="InvoiceNo' + key + '" value="" placeholder="Invoice No" title="Invoice No">';
    string += '                     <div class="errordiv InvoiceNo' + key + '">Not Empty</div>';
    string += '                 </div>';
    string += '                 <div class="col-sm-3">';
    string += '                     <input type="text" class="bootstrap-datepicker form-control input-required" name="Invoice[' + key + '][InvoiceDate]" id="InvoiceDate' + key + '" value="" placeholder="Invoice date" title="Invoice date" autocomplete="off">';
    string += '                     <div class="errordiv InvoiceDate' + key + '">Not Empty</div>';
    string += '                 </div>';
    string += '                <div class="col-sm-3">';
    string += '                    <div class="input-group">';
    string += '                        <input id="SubValueOfInvoice' + key + '" name="Invoice[' + key + '][SubValueOfInvoice]" class="form-control currency-unit" value="" placeholder="Sub Value Of Invoice">';
    string += '                        <div class="input-group-btn">';
    string += '                            <select name="Invoice[' + key + '][TAX]" id="TAX' + key + '" class="select-status">';
    string += '                                 <option value="0">0%</option>';
    string += '                                 <option value="3">3%</option>';
    string += '                                 <option value="5">5%</option>';
    string += '                                 <option value="10">10%</option>';
    string += '                            </select>';
    string += '                        </div>';
    string += '                    </div>';
    string += '                </div>';
    string += '                 <div class="col-sm-3">';
    string += '                     <input type="text" class="form-control val-inv input-required currency-unit" name="Invoice[' + key + '][ValueOfInvoice]" id="ValueOfInvoice' + key + '" value="" placeholder="Value of invoice" title="Value of invoice">';
    string += '                     <div class="errordiv ValueOfInvoice' + key + '">Not Empty</div>';
    string += '                 </div>';
    string += '             </div>';
    string += '        </div>';
    string += '        <div class="col-sm-6">';
    string += '            <div class="row">';
    string += '                <div class="col-sm-3">';
    string += '                    <div class="input-group">';
    string += '                        <input id="InvoiceDeposit' + key + '" name="Invoice[' + key + '][InvoiceDeposit]" class="form-control depo-inv currency-unit" value="" placeholder="Deposit">';
    string += '                        <div class="input-group-btn">';
    string += '                            <button type="button" class="btn btn-default btn-get-deposit"><i class="fa fa-question-circle-o"></i></button>';
    string += '                        </div>';
    string += '                    </div>';
    string += '                </div>';
    string += '                <div class="col-sm-3">';
    string += '                    <input id="InvoiceRest' + key + '" name="Invoice[' + key + '][InvoiceRest]" class="form-control rest-inv currency-unit" value="" placeholder="Rest Payment" readonly>';
    string += '                </div>';
    string += '                <div class="col-sm-3">';
    string += '                    <input type="text" class="bootstrap-datepicker form-control input-required" name="Invoice[' + key + '][EstimateInvoice]" id="EstimateInvoice' + key + '" value="" placeholder="Estimate Payment Date" title="Estimate Payment Date" autocomplete="off">';
    string += '                    <div class="errordiv EstimateInvoice' + key + '">Not Empty</div>';
    string += '                </div>';
    string += '                <div class="col-sm-2">';
    string += '                    <input type="text" class="bootstrap-datepicker form-control" name="Invoice[' + key + '][ActualInvoice]" id="ActualInvoice' + key + '" value="" placeholder="Actual Payment Date" title="Actual Payment Date" autocomplete="off">';
    string += '                    <div class="errordiv ActualInvoice' + key + '">Not Empty</div>';
    string += '                </div>';
    string += '            </div>';
    string += '            <div class="btn-inv btn-remove-inv disabled"><a href="javascript:;"><i class="fa fa-close"></i></a></div>';
    string += '        </div>';
    string += '    </div>';
    string += '</div>';
    $('.fg-wrap-invoices').append(string);
    $('.fg-wrap-invoices .fg-inv-' + key).find('.bootstrap-datepicker').datepicker({
        format: 'yyyy-mm-dd',
        language: 'vi',
        autoclose: true,
        todayHighlight: true
    });
    drapOrder();
}

if ($('#act').val() != 'promotion') {
    if ($('#do').val() != '') {
        $('body').on('submit', '#frmSearch', function() {
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
                        var part = $(this).find('td.part').text();
                        var key = parseInt($('#itemList table tbody .highlightNoClick:last td input.itemKey').val()) + 1;
                        if ($('#itemList table tbody .highlightNoClick').length == 0) {
                            key = 1;
                        }
                        if ($('input.supplier-part[type="hidden"][value="' + part + '"]').length) {
                            $('input.supplier-part[type="hidden"][value="' + part + '"]').parent().parent().addClass('exists').delay(7000).queue(function(next) {
                                $(this).removeClass("exists");
                                next();
                            });
                            showNoti('Supplier Part #: ' + part + ' already exists', 'Warning', 'War');
                        } else {
                            var data = {
                                key: key,
                                usd_currency: $('#USDExchangeRate').length ? parseFloat($('#USDExchangeRate').val().replace(/\s/g, '').replace(/,/g, '')) : '',
                                Image: $(this).find('img').data('image'),
                                SupplierPart: $(this).find('td.part').text(),
                                MfrPart: $(this).find('span.mfr-part').text(),
                                Description: $(this).find('span.desc').text(),
                                Manufacturer: $(this).find('td.manufacturer').text(),
                                PackageCase: $(this).find('td.package_case').text(),
                                Packaging: $(this).data('packaging'),
                                StandardPackageQty: $(this).find('td.spq').text(),
                                MinimumQuantity: $(this).find('td.miniquan').text(),
                                UnitPriceUSD: $(this).find('td.unit-price').text(),
                                LeadtimeComments: $(this).find('td.leadtime').text(),
                                Stock: $(this).find('td.stock').text(),
                                OnOder: 0,
                                DateCode: $(this).data('datecode'),
                                OriginOfCountry: $(this).data('coo'),
                            }
                            add_row(data);
                            updateNO();
                            updateDataSum();
                        }
                        $(this).remove();
                        if ($('#divSearch tbody tr').length == 0) {
                            $('#divSearch').hide();
                        }
                        check_attribution_mfr();
                    });
                }
            });
            $('[name="q"]').val('').blur();
            return false;
        });
    }
    $('body').on('change', '#sheet', function() {
        $.ajax({
            url: site_url + 'ajax/access_file',
            type: 'POST',
            cache: false,
            data: {
                file: $('#file').val(),
                sheet: $('#sheet').val(),
            },
            success: function(string) {
                var activeSheet = $('#sheet').val();
                $('.divPreview .table.table-bordered').html(string);
                $('#headerTitle, #headerInfo, #footerInfo, #importModal .border-primary, .field-excel').attr('disabled', false).trigger('chosen:updated');
                var numRow = $('.divPreview .table.table-bordered tr').length;
                $('#headerInfo, #footerInfo').empty();
                $('.field-excel').empty().append('<option value="-1">Select an Option</option>').trigger('chosen:updated');
                for (i = 1; i < numRow; i++) {
                    $('#headerTitle, #headerInfo, #footerInfo').append('<option value="' + i + '">' + i + '</option>').trigger('chosen:updated');
                    $('.divPreview .table.table-bordered tr:eq(' + i + ')').addClass('excel-selected');
                }
                if (numRow > 1) {
                    $('#headerInfo option[value="2"]').prop('selected', true).trigger('chosen:updated');
                }
                $('#footerInfo option:last-child').prop('selected', true).trigger('chosen:updated');
                $('.divPreview table tr.excel-header').find('td').each(function() {
                    var label = $(this).data('label');
                    var text = $(this).text().replace(/\s/g, '');
                    var text_sel = text.replace(/\s/g, '');
                    var string = 'Column ' + label + ' - ' + text;
                    if (label) {
                        $('.field-excel').append('<option value="' + label + '">' + string + '</option>').trigger('chosen:updated');
                    }
                    $('select[data-select="' + text_sel + '"]').val(label).trigger('chosen:updated');
                });
                check_exist_data();
            }
        });
    }).on('click', '#importModal .border-primary', function() {
        if(['customer_sales_contract','sales_contract'].includes($('#act').val()) == true){
            // disabled feature import file module customer_sales_contract , sales_contract
            return;
        }
        if ($('#selectMfrPart').val() == '' || $('#selectMfrPart').val() == -1) {
            showNoti('Mfr Part # is a required field, please select data', 'Warning', 'War');
            return false;
        }
        var proLE = '';
        $('#itemList table tbody tr td input.supplier-part').each(function() {
            proLE += (proLE ? ',' : '') + '' + $(this).val();
        });
        showProcess(1);

        var new_url = (['sales_contract'].includes($('#act').val()) == true) ? $('#act').val()+"/process_file" : site_url + 'ajax/process_file';

        $.ajax({
            url: new_url,
            type: 'POST',
            cache: false,
            data: {
                act: $('#act').val(),
                proLE: proLE,
                usd_currency: $('#USDExchangeRate').val().replace(/\s/g, '').replace(/,/g, ''),
                file: $('#file').val(),
                sheet: $('#sheet').val(),
                startRow: $('#headerInfo').val(),
                endRow: $('#footerInfo').val(),
                key: $('#itemList table tbody .highlightNoClick').length,
                selectSupplierPart: $('#selectSupplierPart').val(),
                selectMfrPart: $('#selectMfrPart').val(),
                selectDescription: $('#selectDescription').val(),
                selectManufacturer: $('#selectManufacturer').val(),
                selectPackageCase: $('#selectPackageCase').val(),
                selectPackaging: $('#selectPackaging').val(),
                selectStandardPackageQty: $('#selectStandardPackageQty').val(),
                selectSPQPrice: $('#selectSPQPrice').val(),
                selectOrderQuantity: $('#selectOrderQuantity').val(),
                selectUnitPriceUSD: $('#selectUnitPriceUSD').val(),
                selectBuyingPrice: $('#selectBuyingPrice').val(),
                selectDateCode: $('#selectDateCode').val(),
                selectCountryOfOrigin: $('#selectCountryOfOrigin').val(),
                selectCondition: $('#selectCondition').val(),
                selectMultipleQuantity: $('#selectMultipleQuantity').val(),
                selectMinimumQuantity: $('#selectMinimumQuantity').val(),
                selectLeadtime: $('#selectLeadtime').val(),
                selectIncoterm: $('#selectIncoterm').val(),
                selectSupplierleadtime: $('#selectSupplierleadtime').val(),
                selectCustomerleadtime: $('#selectCustomerleadtime').val(),
                selectFirmware: $('#selectFirmware').val(),
                selectBDC: $('#selectBDC').val(),
                selectCOO: $('#selectCOO').val(),
                selectUnitWeight: $('#selectUnitWeight').val(),
                selectTotalWeight: $('#selectTotalWeight').val(),
                selectSupplier: $('#selectSupplier').val(),
            },
            success: function(string) {
                var getData = $.parseJSON(string);
                if (getData.add.length) {
                    for (i = 0; i < getData.add.length; i++) {
                        $('#itemList table tbody tr.tr-last').before(getData.add[i]);
                        $('.select2').chosen({ allow_single_deselect: true });

                        $('#itemList table tbody tr.tr-last').prev().find('.bootstrap-datepicker').datepicker({
                            format: 'yyyy-mm-dd',
                            language: 'vi',
                            autoclose: true,
                            todayHighlight: true
                        });
                    }
                }
                if (getData.update.length) {
                    $.alerts.confirm('Do you want update info of <b>' + $('.divPreview table tbody tr.exists').length + '</b> items exist?', 'Confirm update', function(r) {
                        if (r == true) {
                            for (i = 0; i < getData.update.length; i++) {
                                if ($('input.supplier-part[value="' + getData.update[i].SupplierPart + '"]').length) {
                                    var e = $('input.supplier-part[value="' + getData.update[i].SupplierPart + '"]').closest('tr');
                                    e.find('.order-qty').val(accounting.formatMoney(getData.update[i].OrderQuantity, '', 0));
                                    e.find('.unit-price-usd').val(accounting.formatMoney(getData.update[i].UnitPriceUSD, '', 4));
                                    e.find('.unit-price-vnd').val(accounting.formatMoney(parseFloat(getData.update[i].UnitPriceUSD) * parseFloat(getData.update[i].usd_currency), '', 0));
                                    e.find('.col-leadtime textarea').val(getData.update[i].LeadtimeComments);
                                    e.find('.col-date_code input').val(getData.update[i].DateCode);
                                    e.find('.col-coo input').val(getData.update[i].OriginOfCountry);
                                    e.find('.col-pro_condition input').val(getData.update[i].PROCondition);
                                                                  }
                            }
                        }
                        hideLoading();
                        $('#importModal').modal('hide');
                        updateDataSum();
                        drapOrder();
                    });
                } else {
                    hideLoading();
                    $('#importModal').modal('hide');
                    if($('#act').val() == 'rfq'){
                        updateDataItemrfq();
                    }
                    updateDataSum();
                    drapOrder();
                    anrDataRequired();
                    col_vis_user_level();
                }
                check_attribution_mfr();
                $('.bootstrap-datepicker').datepicker({
                    format: 'yyyy-mm-dd',
                    language: 'vi',
                    autoclose: true,
                    todayHighlight: true
                });
                $('#itemList table tbody tr').find('.select2').chosen();
            }
        });
    }).on('change', '#headerTitle', function() {
        $(this).trigger('chosen:updated');
        $('#headerInfo').val(parseInt($(this).val()) + 1).trigger('chosen:updated').change();
        var valTitle = $(this).val();
        $('.divPreview table tr').removeClass('excel-header');
        $('.divPreview table tr:eq(' + valTitle + ')').addClass('excel-header');
        $('.field-excel').empty().attr('disabled', false).append('<option value="-1">Select an Option</option>').trigger('chosen:updated');
        $('.divPreview table tr:eq(' + valTitle + ')').find('td').each(function() {
            var label = $(this).data('label');
            var text = $(this).text();
            var text_sel = text.replace(/\s/g, '');
            var string = 'Column ' + label + ' - ' + text;
            if (label) {
                $('.field-excel').append('<option value="' + label + '">' + string + '</option>').trigger('chosen:updated');
            }
            $('select[data-select="' + text_sel + '"]').val(label).trigger('chosen:updated');
        });
        check_exist_data();
    }).on('change', '#selectMfrPart', function() {
        check_exist_data();
    }).on('change', '#headerInfo', function() {
        var startRow = parseInt($(this).val());
        var footerInfo = $('#footerInfo');
        footerInfo.empty();
        var numRow = $('.divPreview .table.table-bordered tr').length;
        for (var i = startRow; i < numRow; i++) {
            footerInfo.append('<option>' + i + '</option>').trigger('chosen:updated');
        }
        footerInfo.find('option:last-child').prop('selected', true).trigger('chosen:updated');
        $('.divPreview .table.table-bordered tr').removeClass('excel-selected');
        check_exist_data();
    }).on('change', '#footerInfo', function() {
        $('.divPreview table tr').removeClass('excel-selected');
        var startRow = parseInt($('#headerInfo').val());
        var val = parseInt($(this).val());
        for (var i = startRow; i <= val; i++) {
            $('.divPreview table tr:eq(' + i + ')').addClass('excel-selected');
        }
        $(this).trigger('chosen:updated');
        check_exist_data();
    });
    validity();
    function validity() {
        $( ".ValidityDate" ).change(function() {
            var now  = Date.now();
            var date = $(this).val();
            var days = daysdifference(now,date);
            var paren = $(this).closest('tr');
            paren.find('.ValidityNumber').val(days);
        });
        function daysdifference(firstDate, secondDate){
            var startDay = new Date(firstDate);
            var endDay = new Date(secondDate);
            var millisBetween = startDay.getTime() - endDay.getTime();
            var days = millisBetween / (1000 * 3600 * 24);
            return Math.round(Math.abs(days));
        }
        Date.prototype.addDays = function(days) {
            this.setDate(this.getDate() + parseInt(days));
            return this;
        };
        $( ".ValidityNumber" ).change(function() {
            var currentDate = new Date();
            var number = $(this).val();
            var days =  currentDate.addDays(number);
            var futDate =  days.getFullYear() + "/" + (days.getMonth()+1) + "/" + days.getDate();
            var paren = $(this).closest('tr');
            paren.find('.ValidityDate').val(futDate);
        });
    }
    function add_row(data) {
        if(['customer_sales_contract'].includes($('#act').val()) == true){
            // Disabled feature add row module customer_sales_contract
            return;
        }
        var new_url = $('#act').val() == "sales_contract" ? $('#act').val()+"/addPart" : site_url + 'ajax/add_row';

        $.ajax({
            url: new_url,
            cache: false,
            type: 'POST',
            data: {
                act: $('#act').val(),
                data: data
            },
            success: function(string) {
                $('#itemList table tbody tr.tr-last').before(string);
                $('#itemList table tbody tr.tr-last').prev().find('.bootstrap-datepicker').datepicker({
                    format: 'yyyy-mm-dd',
                    language: 'vi',
                    autoclose: true,
                    todayHighlight: true
                });
                $('#itemList table tbody tr.tr-last').prev().find('.select2').chosen();
                $('#itemList table tbody tr').find('.select2').chosen();
                drapOrder();
                anrDataRequired();
                col_vis_user_level();
                validity();

                    get_info_Currency();

                //$('.select-supplier' + data.key).append(optionSupplier);
                $('.select-supplier:not(.select-status)').chosen({ allow_single_deselect: true });
            }
        })
    }
    function get_info_Currency() {
        var val =  $('#Currency').val();
        if (val == 'USD') {
            $('#PORates').val(accounting.formatMoney(1, '', 2));
        }else if(val == 'VND'){
            $('#Rates_lable').html('VND');
            $( ".col-unit_price_vnd" ).show();
            $( ".col-unit_price_vnd" ).show();
            $( ".col-end_user_price_vnd" ).show();
            $( ".col-selling_amount_vnd" ).show();
        }
        else if(val == 'RMB'){
            $('#Rates_lable').html('RMB');
            $( ".col-unit_price_rmb" ).show();
            $( ".col-amount_rmb" ).show();
            $( ".col-end_user_price_rmb" ).show();
            $( ".col-selling_amount_rmb" ).show();
        }else if(val == 'EUR'){
            $('#Rates_lable').html('EUR');
            $( ".col-unit_price_eur" ).show();
            $( ".col-amount_eur" ).show();
            $( ".col-end_user_price_eur" ).show();
            $( ".col-selling_amount_eur" ).show();
        }
    }
    function check_exist_data() {
        var startRow = parseInt($('#headerInfo').val());
        var endRow = parseInt($('#footerInfo').val());
        var val = $('#selectSupplierPart').val();
        var inputClass = 'input.supplier-part';
        if (val == '' || val == -1) {
            val = $('#selectMfrPart').val();
            inputClass = 'input.mfr-part';
        }
        $('.divPreview .table.table-bordered tr').removeClass('excel-selected');
        $('.divPreview table tr').removeClass('exists');
        for (var j = startRow; j <= endRow; j++) {
            $('.divPreview .table.table-bordered tr:eq(' + j + ')').addClass('excel-selected');
            var part = $('.divPreview table tr:eq(' + j + ') td[data-label="' + val + '"]').text();
            if ($(inputClass + '[value="' + part + '"]').length) {
                $('.divPreview table tr:eq(' + j + ')').addClass('exists');
                showNoti('The red highlighted data lines are already exist in the list', 'Warning', 'War');
            } else {
                $('.divPreview table tr:eq(' + j + ')').removeClass('exists');
            }
        }
    }
}

function updateDataItem(e) {
    if ($('#act').val() != 'rfq' && ($('#act').val() != 'purchase_request') ){
        var Orqty = parseFloat(e.find('.order-qty').val().replace(/\s/g, '').replace(/,/g, ''));
        if (Orqty < 0) {
            Orqty = 0;
        }

        var priceUSD = parseFloat(e.find('.unit-price-usd').val().replace(/\s/g, '').replace(/,/g, ''));
        var priceVND = parseFloat(String(e.find('.unit-price-vnd').val()).replace(/\s/g, '').replace(/,/g, ''));
        var amountVND = Orqty * priceVND;
        e.find('.amount-usd').val(accounting.formatMoney(Orqty * priceUSD, '', 2));
        e.find('.amount-vnd').val(accounting.formatMoney(amountVND, '', 0));
        if ($('#act').val() == 'payment_request') {
        var priceAmountVnd = parseFloat(e.find('.price-amount-vnd').val().replace(/\s/g, '').replace(/,/g, ''));
        var priceAmountUsd = parseFloat(e.find('.price-amount-usd').val().replace(/\s/g, '').replace(/,/g, ''));
        var vat1 = parseFloat(e.find('.vat').val());
        var amountUSD = parseFloat(e.find('.amount-usd').val().replace(/\s/g, '').replace(/,/g, ''))* (1 + vat1 / 100 );
        var amountVND = parseFloat(e.find('.amount-vnd').val().replace(/\s/g, '').replace(/,/g, ''))*(1 + vat1 / 100) ;
        e.find('.amount-usd').val(accounting.formatMoney(amountUSD, '', 2));
        e.find('.amount-vnd').val(accounting.formatMoney(amountVND, '', 0));
        var vatUSD = priceAmountUsd*vat1/100;
        var vatVND = priceAmountVnd*vat1/100;
        e.find('.amout-vatusd').val(accounting.formatMoney(vatUSD, '', 2));
        e.find('.amout-vatvnd').val(accounting.formatMoney(vatVND, '', 0));
        }
        updateDataSum();
    }

}

function change_alias2(key) {
    var str = key;
    str = str.toLowerCase();
    str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
    str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
    str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
    str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
    str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
    str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
    str = str.replace(/đ/gi, "d");
    str = str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'|\"|\&|\#|\[|\]|~|\$|`|-|{|}|\||\\/gi, "");
    str = str.replace(/ + /g, "_");
    str = str.replace(/ /gi, "_");
    return str;
}

function estimateDate(inp, date) {
    var val = inp.val();
    if (inp.hasClass('etd-control')) {
        inp.next().val(date_diff_indays(date, val));
    }
    if (inp.hasClass('etd-control-plus')) {
        if (isNaN(val)) {
            inp.val('');
            inp.prev().val('');
            return false;
        }
        if (val == '') {
            inp.prev().val('');
            return false;
        }
        date = new Date(date);
        date.setDate(date.getDate() + parseInt(val));
        inp.prev().val(formatDate(date))
    }
}

var date_diff_indays = function(date1, date2) {
    dt1 = new Date(date1);
    dt2 = new Date(date2);
    return Math.floor((Date.UTC(dt2.getFullYear(), dt2.getMonth(), dt2.getDate()) - Date.UTC(dt1.getFullYear(), dt1.getMonth(), dt1.getDate())) / (1000 * 60 * 60 * 24));
}

function _addZero(inp) {
    if (!isNaN(inp) && inp >= 0) {
        if (inp < 10) {
            inp = '0' + inp;
        }
        return inp;
    } else {
        return 0;
    }
}

function _today(hour = false) {
    var today = new Date();
    var dd = _addZero(today.getDate());
    var mm = _addZero(today.getMonth() + 1); //January is 0!
    var yyyy = today.getFullYear();
    var h = _addZero(today.getHours());
    var m = _addZero(today.getMinutes());
    var s = _addZero(today.getSeconds());

    today = yyyy + '-' + mm + '-' + dd;

    if (hour) {
        today += ' ' + h + ':' + m + ':' + s;
    }

    return today;
}


// --------------------------------------------------------
/**
 * compare 2 dates ('yyyy-mm-dd')
 * return TRUE if date1 greater than or equal date2; otherwise, false
 */
function compare2dates(date1, date2) {
    var _date1 = date1.split('-');
    _ndate1 = new Date(_date1[0], _date1[1] - 1, _date1[2]);
    var _date2 = date2.split('-');
    _ndate2 = new Date(_date2[0], _date2[1] - 1, _date2[2]);

    if (_ndate1.getTime() >= _ndate2.getTime())
        return true;
    else
        return false;
}

function decode_html(html) {
	var txt = document.createElement('textarea');
	txt.innerHTML = html;
	return txt.value;
}

function remove_tags(text, selector) {
	var wrapped = $('<div>' + text + '</div>');
	wrapped.find(selector).remove();
	return wrapped.html();
}

function copyToClipboardFromDiv(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).text()).select();
    document.execCommand("copy");
    $temp.remove();
    showNoti('Copied: ' + $(element).text(), 'Copy to clipboard', 'Ok');
}

var tableToExcel = (function() {
    var uri = 'data:application/vnd.ms-excel;charset=utf-8;base64,'
        , template = '<html xmlns:o=\"urn:schemas-microsoft-com:office:office\" xmlns:x=\"urn:schemas-microsoft-com:office:excel\" xmlns=\"http://www.w3.org/TR/REC-html40\"><meta http-equiv=\"content-type\" content=\"application/vnd.ms-excel; charset=UTF-8\"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
        , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
        , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
    return function(table, name) {
        if (!table.nodeType) table = 'table-' + $('act').val();
        var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
        var blob = new Blob([format(template, ctx)]);
        var blobURL = window.URL.createObjectURL(blob);
        return blobURL;
    }
})()

function unique(list, dup = false) {
    var result = [];
    var duplicate = [];
    $.each(list, function(i, e) {
        if ($.inArray(e, result) == -1) {
        	result.push(e);
        } else {
        	duplicate.push(e);
        }
    });
    if (dup) {
    	return duplicate;
    } else {
    	return result;
    }
}

function col_vis_user_level() {
    var staffs = $('#StaffNumber').val();
    if (staffs == null) staffs = [''];
    if (user_level == 1 || user_level == 2 || (staffs.indexOf(user_id) >= 0)) {
        var table = $('#itemList table');
        table.find('.col-upd_sale_rfq, .col-sales_margin, .col-selling_price, .col-selling_amount').removeClass('hide');
    }
}

function check_attribution_mfr() {
    var arr = [];
    var arrCostID = [];
    var arrCostTotal = [];
    var arrCostPercent = [];
    var arrcolor = [];
    var arrWeight = [];
    var arrBank = [];
    var arrDelivery = [];
    var arrDeclare = [];
    var arrOther = [];
    var arrTotalCost = [];
    var html = '';
    $('#itemList .table-part tr .select-supplier').each(function() {
        var idSUP = $(this).val();
        if (idSUP != '') {
            arrCostID.push(idSUP);
        }
    })
   if (arrCostID.length) {
        arrCostID = mie_array(arrCostID);
    }

    if ($('#attribution tbody tr').length) {
        $('#attribution tbody tr').each(function() {
            arrcolor[$(this).data('id')] = $(this).find('.attr-color').val();
            arrCostTotal[$(this).data('id')] = $(this).find('.attr-Cop').val();
            arrCostPercent[$(this).data('id')] = $(this).find('.attr-percent').val();
            arrWeight[$(this).data('id')] = $(this).find('.attr-Weight').val();
            arrBank[$(this).data('id')] = $(this).find('.attr-Bank').val();
            arrDelivery[$(this).data('id')] = $(this).find('.attr-Delivery').val();
            arrDeclare[$(this).data('id')] = $(this).find('.attr-Declare').val();
            arrOther[$(this).data('id')] = $(this).find('.attr-Other').val();
            arrTotalCost[$(this).data('id')] = $(this).find('.attr-total').val();
        })
    }
    var input = '<div class="input-group"><input type="number" name="attrCost[' + arrCostID[i] + '][Weight]" class="form-control attr-Weight"> <div class="input-group-addon">Hours</div> </div>';

    if (arrCostID.length) {
        for (var i = 0; i < arrCostID.length; i++) {
            var costName = getDataSupplier[arrCostID[i]];
            var color = arrcolor[arrCostID[i]];
            $btn_color = 'default';
            if(color){

                if (color == 1){ $btn_color = 'success';}
                if (color == 2){ $btn_color = 'danger';}
                if (color == 3){ $btn_color = 'warning';}
                if (color == 4){ $btn_color = 'info';}
                if (color == 5){ $btn_color = 'yellow';}
                if (color == 6){ $btn_color = 'purple';}
                if (color == 7){ $btn_color = 'azure';}
                if (color == 8){ $btn_color = 'black';}
                if (color == 9){ $btn_color = 'blue-alt';}
            }else{
                $btn_color = 'default';
            }
            html += '<tr data-id="' + arrCostID[i] + '"><td><a href="javascript:;"  class="btn btn-'+ $btn_color +' btn-execute-colcost"><i class="glyph-icon icon-refresh"></i> <span class="">0</span></a><input type="hidden" name="attrCost[' + arrCostID[i] + '][color]" class="form-control attr-color" value="'+ (color > 0 ? color : 0) +'" ></td>';
            html += '   <td>';
            html += '       <input type="hidden" name="attrCost[' + arrCostID[i] + '][id]" value="' + arrCostID[i] + '">';
            html += '       <input type="hidden" name="attrCost[' + arrCostID[i] + '][Name]" value="' + costName + '">' + costName;
            html += '   </td>';
            html += '   <td><div class="input-group"></td>';
            html += '   <td><div class="input-group"><input type="text" name="attrCost[' + arrCostID[i] + '][Weight]" class="form-control attr-Weight" value="' + (arrWeight[arrCostID[i]] > 0 ? arrWeight[arrCostID[i]] : 0)  + '"><div class="input-group-addon">KG</div> </div></td>';
            html += '   <td><div class="input-group"><input type="text" name="attrCost[' + arrCostID[i] + '][Bank]" class="form-control attr-Bank" value="' + (arrBank[arrCostID[i]] > 0 ? arrBank[arrCostID[i]] : 0)  + '"><div class="input-group-addon">$</div> </div></td>';
            html += '   <td><div class="input-group"><input type="text" name="attrCost[' + arrCostID[i] + '][Delivery]" class="form-control attr-Delivery" value="' +(arrDelivery[arrCostID[i]] > 0 ? arrDelivery[arrCostID[i]] : 0)  + '"><div class="input-group-addon">$</div> </div></td>';
            html += '   <td><div class="input-group"><input type="text" name="attrCost[' + arrCostID[i] + '][Declare]" class="form-control attr-Declare" value="' + (arrDeclare[arrCostID[i]] > 0 ? arrDeclare[arrCostID[i]] : 0)  + '"><div class="input-group-addon">$</div> </div></td>';
            html += '   <td><div class="input-group"><input type="text" name="attrCost[' + arrCostID[i] + '][Other]" class="form-control attr-Other" value="' + (arrOther[arrCostID[i]] > 0 ? arrOther[arrCostID[i]] : 0)  + '"><div class="input-group-addon">$</div> </div></td>';
            html += '   <td><div class="input-group"><input type="text" style=" background: #dddddd;pointer-events: none"  name="attrCost[' + arrCostID[i] + '][Total]" class="form-control attr-total" value="' + (arrTotalCost[arrCostID[i]] > 0 ? arrTotalCost[arrCostID[i]] : 0)  + '"><div class="input-group-addon">$</div> </div></td>';
            html += '   <td><div class="input-group"><input type="text" style=" background: #dddddd;pointer-events: none"  name="attrCost[' + arrCostID[i] + '][Cop]" class="form-control attr-Cop" value="' + (arrCostTotal[arrCostID[i]] != undefined ? arrCostTotal[arrCostID[i]] : 0) + '"><div class="input-group-addon">$</div> </div></td>';
            html += '   <td><div class="input-group"><input type="text" style=" background: #dddddd;pointer-events: none"  name="attrCost[' + arrCostID[i] + '][Percent]" class="form-control attr-percent" value="' + (arrCostPercent[arrCostID[i]] != undefined ? arrCostPercent[arrCostID[i]] : 0) + '"><div class="input-group-addon">%</div> </div></td>';
            html += '</tr>';
            $('.btn-execute-colcost').click(function (){
                var tr = $(this).closest('tr');
                console.log('test');
                execute_cost(tr.data('id'));
            });
        }
    }
    $('#attribution tbody').empty().append(html);
}

// Chức năng click show ngôn ngữ thẻ <th> khi thêm thẻ <i> class lng .
$(document).ready(function(){
    $("table").on("click", "th .lng", function(e) {
        var content = $(this).parents('th').text();
        var keyword = $(this).parents('th').text();
        console.log(keyword);
        $.ajax({
            type : 'post',
            url : 'ajax/fetch_record', //Here you will fetch records
            data :  'keyword='+ keyword,
            dataType: "json",
            success : function(data){
                $('.modal-title').html(content);
                $('#keyword').val(data.keyword);
                $('.fetched-data').html(data.lng);//Show fetched data from database
                $('#vnlng').val(data.vn);
                $('#enlng').val(data.en);
                $('#Modal_languages').modal('show');
            }
        });
    });
    $( "#updatelng" ).click(function() {
        var keyword = $('#keyword').val();
        var vnlng = $('#vnlng').val();
        var enlng = $('#enlng').val();
        var dataString = {
            // guest_id : a,
            keyword : keyword,
            enlng : enlng,
            vnlng: vnlng
        };
        $.ajax({
            type : 'post',
            url : 'ajax/updatelng', //Here you will fetch records
            data :  dataString, //Pass $id
            success : function(data){
                $('#Modal_languages').modal('toggle');
            showNoti("LANGUAGES", "Update Successful!", "Ok");
            }
        });
    });
   $( ".div_admincats" ).click(function() {
     var module= $(this).data('action');
     $.removeCookie('active'+module+'', { path: '/' });
     $.removeCookie('mytab', { path: '/' });

    }
    )

});
function updatemenuparentleft(del,sort_order,id,name_vn,table) {
    $.ajax({
        url: site_url + 'ajax/updatemenuparentleft',
        type: 'POST',
        cache: false,
        data: {
            sort_order: sort_order,
            id: id,
            name_vn: name_vn,
            del: del,
            table: table
        },

    });

}
function updatemenuleft(del,sort_order,id,group_id,name_vn,brief,url,table) {
 //  alert(del);
    $.ajax({
        url: site_url + 'ajax/updatemenuleftcon',
        type: 'POST',
        cache: false,
        data: {
            sort_order: sort_order,
            id: id,
            group_id: group_id,
            name_vn: name_vn,
            brief: brief,
            url: url,
            del: del,
            table: table
        },

    });

}
$('.col-action').on('click', function() {

    var status =$(this).attr("status");
    var panel = $(this).closest(".group-category");

    if(status =='1') {
        $(this).attr("status", "0");
        panel.find(".item ").hide(200);
        $(this).addClass('icon-plus-circle');
        $(this).removeClass('icon-minus-circle');

    } else {

        $(this).attr("status", "1");
        panel.find(".item").show(200);
        $(this).addClass('icon-minus-circle');
        $(this).removeClass('icon-plus-circle');
    }
});
function get_part(raw) {
    return raw.replace(/[&<>"']/g, function onReplace(match) {
        return '&#' + match.charCodeAt(0) + ';';
    });
}