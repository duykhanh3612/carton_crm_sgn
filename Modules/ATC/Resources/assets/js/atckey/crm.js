$(document).ready(function () {
    // todo mod name
    $('#RegistrationStatus').attr('name', "project[RegistrationStatus]");
    $('#StageOfProject').attr('name', "project[StageOfProject]");
    $('#ImportanceLevel').attr('name', "project[ImportanceLevel]");
    $('#ApplicationType').attr('name', "project[ApplicationType]");
    $('#EndCustomerCountry').attr('name', "project[EndCustomerCountry]");
    $('#ManufacturingCountry').attr('name', "project[ManufacturingCountry]");
    //end line mod
    var op_individual = '';
    var op_group = '';
    var upload_dir = $('#attachmentUploader').data('dir');
    var objChannelManage = {};
    var currentProjectINFO = null;
    var currentProjectName = [];
    if (!$('#id').val()) {
        //$('.input-project').addClass('disabled');
        $('.input-customer').addClass('disabled');
        $('.input-processed').addClass('disabled');
    } else {
        var assesId = currentUser == currentLead || currentUser == 1;
        //todo my child quest
        //Assign to OR Lead Owner => Okay editor
        $('.my-request :input').not('.file-attachments').addClass('disabled');
        $('.my-request .attachments').not('.file-attachments').addClass('disabled');
        //$('.station-stt').addClass('disabled');
        //$('.my-processed :input').addClass('disabled');
        //$('.my-processed .attachments').addClass('disabled');
        if (assesId) {
            $('.my-request .attachments').removeClass('disabled');
            $('.my-request :input').removeClass('disabled');
            $('.my-processed .attachments').removeClass('disabled');
            $('.my-processed :input').not('.my-auto').removeClass('disabled');
            $('.station-stt').removeClass('disabled');
        }

        $('.my-request').find('.assign_to').addClass('old-assign_to');

        //Assign to
        $('.old-assign_to').each(function () {
            var Val = parseInt($(this).val());
            var panel = $(this).closest('.panel-body');
            var myinput = $(this).closest('.my-request');
            var myprocessed = $(this).closest('.my-processed');
            if (Val == currentUser) {
                myinput.find('.attachments').removeClass('disabled');
                myinput.find(':input').removeClass('disabled');
                panel.find('.station-stt').removeClass('disabled');
                panel.find('.input-processed').removeClass('disabled');
            } else {
                if (!assesId) {
                    myprocessed.find(':input,a').not('.my-auto').addClass('disabled');
                    myprocessed.find('.attachments').not('.my-auto').addClass('disabled');
                    myinput.find('.my-request .attachments').not('.my-auto').addClass('disabled');
                    $(this).find('.station-stt').addClass('disabled');
                }
            }
            //todo update time
            /*
                        var timeOk = panel.find('.real-time').val();
                        var currentTime = Date.now();
                        var passTime = currentTime - timeOk;
                        var dayDifference = Math.floor(passTime/1000);
                        var secDifference = Math.floor(passTime/1000/60);
                        var minDifference = Math.floor(passTime/1000/60/60);
                        var hourDifference = Math.floor(passTime/1000/60/60/24);

                        var newTime = new Date(passTime);
                        var hours = newTime.getHours();
                        var minutes = "0" + newTime.getMinutes();
                        var formattedTime = minutes.substr(-2) + 'phút';
                        if(!!hours && hours >0) formattedTime = hours + ':' + minutes.substr(-2) + ' giờ ';
                        var date = newTime.getDate();
                        if(!!date && date >0) formattedTime = date + ' ngày ' + hours + ':' + minutes.substr(-2) + 'giờ ';
                        panel.find('.current-time').val(formattedTime + ' trước');

                        console.log('hourDifference:' + hourDifference);
                        console.log('minDifference:' + minDifference);
            */
        });

        $('.my-panel-ds').each(function () {
            var Val = $(this).val();
            if (!!Val && Val == 1) {
                $(this).closest('.panel').find('.tab-content :input').removeAttr('name').removeAttr('id').removeAttr('data-required');
                $(this).closest('.panel').find('.tab-content :input, .btn-processed').addClass('disabled');
                $(this).closest('.panel').find('.attachments').addClass('disabled');
            }
        });

        if (!$('#customer_id').val()) {
            $('#customer_id').attr('data-required', 0);
            $('.span_customer_id').html('&nbsp;');
        } else {
            $('#customer_id').removeClass('disabled');
        }
    }
    if ($('#project_type').val() == '0' || !$('#project_type').val()) {
        $('#Project').attr('data-required', 0);
        $('#ProjectName').attr('data-required', 0);
        $('.span_project').html('&nbsp;');
    }
    $(function () {
        $('.bootstrap-datetimepicker').datetimepicker({
            format: 'YYYY-MM-DD HH:mm',
            useCurrent: false,
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down",
                previous: "fa fa-chevron-left",
                next: "fa fa-chevron-right",
            }
        });
    });
    if (!!$stt) {
        for (var $istt = 0; $istt < ($stt * 2); $istt++) {
            $(".tasks-file" + $istt).uploadFile({
                url: site_url + 'ajax/ajax_attachment',
                fileName: 'myfile',
                formData: {
                    'dir': upload_dir
                },
                uploadButtonClass: 'btn btn-border btn-alt btn-hover border-orange font-orange waves-effect pull-right',
                allowedTypes: 'xls,xlsx,doc,docx,pdf,rar,zip',
                uploadErrorStr: 'File không đúng danh mục!',
                maxFileSize: 5240000,
                multiple: true,
                showErrType: 1,
                dragDropStr: "",
                onSuccess: function (files, data) {
                    showAttachment(files, data);
                    $('.ajax-file-upload-statusbar').fadeOut();
                    $('.attachments-wrap i.remove').click(function () {
                        $(this).parent().next().fadeOut();
                        $(this).parent().fadeOut(function () {
                            $(this).remove();
                        });
                    });
                }
            });
        }
    }

    function getUnique(array) {
        var uniqueArray = [];
        for (var i = 0; i < array.length; i++) {
            if (uniqueArray.indexOf(array[i]) === -1) {
                uniqueArray.push(array[i]);
            }
        }
        return uniqueArray;
    }

    function validate_duedate() {
        for (var $istt = 0; $istt < $stt; $istt++) {
            var duedateFrom = '#from_date' + $istt;
            var duedateTo = '#to_date' + $istt;
            $('body').on('dp.change', duedateFrom, function () {
                if ($(duedateTo).val() != '' && $(this).val() > $(duedateTo).val()) {
                    showNoti('Ngày không hợp lệ', 'Cảnh báo:', 'War');
                    $(this).val(null);
                }
            }).on('dp.change', duedateTo, function () {
                if ($(duedateFrom).val() != '' && $(this).val() < $(duedateFrom).val()) {
                    showNoti('Ngày không hợp lệ', 'Cảnh báo:', 'War');
                    $(this).val(null);
                    return;
                }
            });
        }
    }

    function showAttachment(src, dst) {
        //todo name
        var name = currentname || 'attachments';// || processed_attachments
        var tab = 'request';
        var clasName = '';
        if (name == 'processed_attachments') {
            tab = 'processed';
            clasName = 'input-processed';
        }
        var html = '<div>';
        var stt = currentstt;
        html += '<div class="attachments-wrap ' + clasName + '"><i class="fa fa-close remove"></i><input data-file="' + src + '" value="' + dst.split('/').pop() + '" type="hidden" name="' + tab + '[' + stt + '][' + name + '][]" /><div class="image-small"><div class="no-image" title="' + dst.split('/').pop() + '"><img src="assets/img/file_ext/' + dst.split('/').pop().split('.').pop() + '.png" /></div></div></div>';
        html += '</div>';
        $('#Attachments-list' + stt).append(html);
    }

    function add_more_file(istt) {
        // var old = istt;
        // if(even == true) old;
        $(".tasks-file" + istt).uploadFile({
            url: site_url + 'ajax/ajax_attachment',
            fileName: 'myfile',
            formData: {
                'dir': upload_dir
            },
            uploadButtonClass: 'btn btn-border btn-alt btn-hover border-orange font-orange waves-effect pull-right',
            allowedTypes: 'xls,xlsx,doc,docx,pdf,rar,zip',
            uploadErrorStr: 'File không đúng danh mục!',
            maxFileSize: 5240000,
            multiple: true,
            showErrType: 1,
            dragDropStr: "",
            onSuccess: function (files, data) {
                showAttachment(files, data);
                $('.ajax-file-upload-statusbar').fadeOut();
                $('.attachments-wrap i.remove').click(function () {
                    $(this).parent().next().fadeOut();
                    $(this).parent().fadeOut(function () {
                        $(this).remove();
                    });
                });
            }
        });
    };

    function sent_email() {
        tinyMCE.triggerSave();
        var title = $('#title_email').val();
        var email = $('#to_email').val();
        var content = $('#content_email').val();

        if (email == '') {
            showNoti('Please enter an email', 'Err', 'Err');
            return;
        }
        if (title == '') {
            showNoti('Please enter a title', 'Err', 'Err');
            return;
        }
        if (content == '') {
            showNoti('Please enter a content', 'Err', 'Err');
            return;
        }
        sessionStorage.setItem("email", email);
        sessionStorage.setItem("title_email", title);
        sessionStorage.setItem("content_email", content);
        var login = $.cookie('email_ok');
        if (!login || login != 'true') {
            $('#login-modal').modal('show');
            return;
        }

        $.ajax({
            url: site_url + 'customer_request_management/ajax_send_email',
            type: "POST",
            data: {e_title: title, e_content: content, e_email: email},
            cache: false,
            success: function (data) {
                if (data == '1') {
                    showNoti('Your message content has been sent successfully!', 'Email', 'Ok');
                    sent_ok = true;
                    $(this).addClass('disabled');
                    $(this).text('SENT');
                } else {
                    sent_ok = false;
                    $.cookie('email_ok', false, {
                        path: '/',
                        expires: 3600 * 24 * 30
                    });
                    showNoti('You have entered incorrect account-email information', 'Email', 'Err');
                    $('#login-modal').modal('show');
                }
            },
            error: function () {
                sent_ok = false;
                showNoti('Your message content has been sent\'t successfully', 'Email', 'War');
            },
        });
        $('#myModalEmailing').modal('hide');
    }

    function addMoreRequest() {
        var cur_stt = parseInt($stt);
        $.ajax({
            url: site_url + 'customer_request_management/add_new_request',
            type: "POST",
            data: {stt: cur_stt, stt2: 0,},
            cache: false,
            success: function (res) {
                $('#itemList').append(res);
                $('#NumberOfRequests').val(cur_stt);
                //(cur_stt, true);
                add_more_file(cur_stt);
                $stt++;
                setTimeout(function () {
                    $('.ajax-upload-dragdrop .btn:not(.mybtn-attachment)').addClass('mybtn-attachment').append('  attachment');
                }, 300);
                $('#Total-Request-panel').remove();
                append_option_assign_to();
                validate_duedate();
                $('textarea').css('overflow', 'hidden').autogrow('input-request');
                $(function () {
                    $('.bootstrap-datetimepicker').datetimepicker({
                        format: 'YYYY-MM-DD HH:mm',
                        useCurrent: false,
                        icons: {
                            time: "fa fa-clock-o",
                            date: "fa fa-calendar",
                            up: "fa fa-arrow-up",
                            down: "fa fa-arrow-down",
                            previous: "fa fa-chevron-left",
                            next: "fa fa-chevron-right",
                        }
                    });
                });
                $('.assign_to').chosen();

                $('html, body').animate({scrollTop: $(document).height()}, 'slow');
            },
            error: function (e) {
                console.log(e);
            },
        })
    }

    validate_duedate();
    var sent_ok = false;
    $('body').on('click', '#email-login', function () {
        var user = $.trim($('.euser').val());
        var pass = $.trim($('.epass').val());
        var server = $.trim($('.eserver').val());
        if (!server || server == '') {
            showNoti('Choose a server email', 'Email', 'Err');
            return;
        }
        if (!user) {
            showNoti('Please enter your user name', 'Email', 'Err');
            return;
        }
        if (!pass) {
            showNoti('Please enter your password', 'Email', 'Err');
            return;
        }
        var domain = user.split('@');
        if (!!domain[1]) {
            var d = domain[1];
            if (d != server) {
                showNoti('Enter the correct server <br/> username@' + server, 'Email', 'Err');
                return;
            }
        } else {
            showNoti('Enter the correct server <br/>username@' + server, 'Email', 'Err');
            return;
        }

        $.cookie('eserver', server, {
            path: '/',
            expires: 3600 * 24 * 30
        });
        $.cookie('euser', user, {
            path: '/',
            expires: 3600 * 24 * 30
        });
        $.cookie('epass', encodeURIComponent(window.btoa(pass)), {
            path: '/',
            expires: 3600 * 24 * 30
        });
        $.cookie('email_ok', true, {
            path: '/',
            expires: 3600 * 24 * 30
        });
        $('#login-modal').modal('hide');
        sent_email();
    }).on('change', '#cat', function () {
        var mycat = $(this).val();
        //$.cookie('filter-cat-' + $('#act').val(), mycat, {path: '/'});
        //var url = site_url + $('#act').val();
        //if (window.location != url) History.pushState(null, document.title, url);
        showLoading();
        $.ajax({
            url: site_url + 'customer_request_management/load_products',
            type: "POST",
            data: {cat: mycat},
            cache: false,
            success: function (res) {
                if (!!res) {
                    currentProjectName = $('#Product').val();
                    var old_res = '';
                    if (!!currentProjectName) {
                        $.each(currentProjectName, function (i, item) {
                            old_res += '<option value="' + item + '">' + item + '</option>';
                        });
                    }
                    old_res += res;
                    $('#Product').html(old_res);
                    var map = {};
                    $('#Product option').each(function () {
                        if (map[this.value]) {
                            $(this).remove()
                        }
                        map[this.value] = true;
                    });
                    if (!!currentProjectName) $('#Product').val(getUnique(currentProjectName));
                    $('#Product').trigger('chosen:updated');
                }
            },
            error: function (e) {
            },
        });
        $('#Product_chosen').removeClass('disabled');
        hideLoading();
    }).on('change', '#lead_owner', function () {
        var id = $(this).attr('id');
        /* var Carrier = $('#lead_owner').val();
        var Approver = $('#relate_to').val();
        var compare_value = id == 'lead_owner' ? Approver : Carrier;
        if (Carrier != '' && Approver != '' && $(this).val() == compare_value) {
            showNoti('Lead owner & Relate To cannot be the same', 'Warning', 'War');
            $(this).val('').trigger('chosen:updated');
            return false;
        }*/
        arrChannelManage = [];
        objChannelManage['lead'] = $(this).val();
        arrChannelManage[0] = $(this).val();
        objChannelManage['channel'] = $('#channel_manage').val();
        if (!!objChannelManage['channel']) {
            $.each(objChannelManage['channel'], function (k, id) {
                if (!!id && $.inArray(id, arrChannelManage) == -1) {
                    arrChannelManage.push(id);
                }
            });
        }
        var rts = $('#relate_to').val();
        if (!!rts) {
            $.each(rts, function (i, rt) {
                if (!!rt && $.inArray(rt, arrChannelManage) == -1) {
                    arrChannelManage.push(rt);
                }
            });
        }
        append_option_assign_to();
        /*if(!!id && $.inArray(id, arrChannelManage ) == -1){
            arrChannelManage.push(id);
        }*/
    }).on('change', '.check-mail', function () {
        if (!validate_email($(this).val())) $(this).val("");
    }).on('change', '#lead_phone', function () {
        var phone = $(this).val(),
            intRegex = /[0-9 -()+]+$/;
        if ((phone.length < 10) || (!intRegex.test(phone))) {
            showNoti('Please enter a valid phone number.', 'Err', 'Err');
            $(this).val("");
            return false;
        }

    }).on('click', '.mybtn-attachment', function () {
        currentstt = $(this).parent().parent().data('stt');
        currentname = $(this).parent().parent().data('name');
    }).on('click', '.btn-add-requests', function () {
        addMoreRequest();
    }).on('click', '.btn-processed', function () {
        var panel = $(this).closest('.panel-body');
        var id = panel.find('.my-processed-id').val();
        var parent = panel.find('.my-processed-parent').val();
        var status = panel.find('.my-processed_status').val();
        var type = panel.find('.my-processed_type').val();
        var processed_content = panel.find('textarea.my-processed_content').val();
        var date = panel.find('.my-from_date').val();
        var file = [];
        if (!processed_content) {
            showNoti('Enter a content of processed', 'Error', 'Err');
            return;
        }
        if (!status || status =='0') {
            showNoti('Choose a status of processed', 'Error', 'Err');
            return;
        }
        if (!type) {
            showNoti('Choose a type of processed', 'Error', 'Err');
            return;
        }

        panel.find('.attachments-wrap.input-processed :input').each(function () {
            file.push($(this).val());
        });
        $.alerts.confirm('Will you confirm this action?<br/><i>You can\'t take action after this operation</i>', 'Confirm processed', function (r) {
            if (r) {
                /*var title = sessionStorage.getItem("title_email");
                var econtent = sessionStorage.getItem("content_email");
                $.ajax({
                    url: site_url + 'customer_request_management/test_send_email',
                    type: "POST",
                    data: {e_title: title, e_content: econtent},
                    cache: false,
                    success: function (res) {console.log(res);}
                });*/

                if (type == '') {
                    showNoti('Please choses a Type', 'Err', 'Err');
                    return;
                } else if (status == '') {
                    showNoti('Please choses a Status', 'Err', 'Err');
                    return;
                } else {
                    var method = panel.find("[name*=processed_type] option:selected").val();
                    $.ajax({
                        url: site_url + 'customer_request_management/processed',
                        type: "POST",
                        data: {
                            file: JSON.stringify(file),
                            fromdate: date,
                            id: id,
                            processed_type: type,
                            status: status,
                            parent : parent,
                            processed_content: processed_content,
                            method:method
                        },
                        cache: false,
                        success: function (res) {
                            if (res) {
                                showNoti('Cập nhật xử lý thành công', 'CRM', 'Ok');
                                panel.find('.my-processed').not('.file-attachments').addClass('disabled');
                                //location.reload();
                                var date = new Date(),
                                    yr = date.getFullYear(),
                                    month = (date.getMonth() < 10 ? '0' + date.getMonth() : date.getMonth()) + 1,
                                    day = date.getDate() < 10 ? '0' + date.getDate() : date.getDate(),
                                    hour = date.getHours() < 10 ? '0' + date.getHours() : date.getHours(),
                                    min = date.getMinutes() < 10 ? '0' + date.getMinutes() : date.getMinutes(),
                                    sec = '01',
                                    newDate = yr + '-' + month + '-' + day + ' ' + hour + ':' + min + ':' + sec;
                                panel.find('.my-processed_status').addClass('disabled');
                                panel.find('.current-time').val('1 sec, time has passed.');
                                panel.find('.my-auto:not(.current-time)').val(newDate);
                                $('#itemList').prev('.panel-body').html('<div id="Total-Request-panel" class="collapse in" style=""> <div class="row"> <div class="col-sm-12"> <div class="form-group" style="width: 200px;"> <div class="input-group"> <span class="input-group-btn"> <button type="button" class="btn btn-info btn-add-requests">Number Of Requests <i class="fa fa-plus-circle" aria-hidden="true"></i></button> </span> <input style="width: 50px;!important;" type="number" class="form-control text-center disabled" id="NumberOfRequests" min="0" value="' + ($stt - 1) + '"> </div> </div> </div> </div> </div>');
                                $('.input-request').removeAttr('name').removeAttr('data-required');
                                $('#itemList :input').addClass('disabled');

                                $.alerts.confirm('Do you want to create the next request to support?', 'Confirm Add More Request', function (r) {
                                    if(r){
                                        addMoreRequest();
                                    }
                                })
                            }
                        }
                    })
                }
            }
        });
    }).on('change', '.myhours', function () {
        var id = $(this).val();
        if (!!id) {
            if (id < 0 || id > 24) {
                showNoti('This time dont correct', 'Err', 'Err');
                $(this).val(" ");
            }
        }
    }).on('change', '#type_relate_to', function () {
        arrChannelManage = [];
        objChannelManage['lead'] = $('#lead_owner').val();
        arrChannelManage[0] = $('#lead_owner').val();
        objChannelManage['channel'] = $('#channel_manage').val();
        if (!!objChannelManage['channel']) {
            $.each(objChannelManage['channel'], function (k, id) {
                if (!!id && $.inArray(id, arrChannelManage) == -1) {
                    arrChannelManage.push(id);
                }
            });
        }
        append_option_assign_to();
        append_option_relate_to();
        $('#relate_to option').removeAttr('selected').trigger("chosen:updated");
    }).on('change', '#customer_type', function () {
        var type = $('#customer_type').val();
        var op1 = '0';
        var op2 = '1';

        if (type.toUpperCase() == op2) {
            //custom
            $('#customer_id').attr('data-required', 1);
            $('.span_customer_id').html('*');
            if ($('#customer_id').hasClass('disabled')) $('#customer_id').removeClass('disabled');
            //Project
            if ($('#Project').hasClass('disabled')) $('#Project').removeClass('disabled');

            if (!$('.input-customer').hasClass('disabled')) $('.input-customer').addClass('disabled');
            //if (!$('.input-project').hasClass('disabled')) $('.input-project').addClass('disabled');
            if ($('#customer_id').hasClass('disabled')) $('#customer_id').removeClass('disabled');
        }
        if (type.toUpperCase() == op1) {
            //custom
            $('#customer_id').val("").trigger("chosen:updated").attr('data-required', 0);
            $('#customer_region').val("").trigger("chosen:updated");
            $('#customer_country').val("").trigger("chosen:updated");
            if (!$('#customer_id').hasClass('disabled')) $('#customer_id').addClass('disabled');
            $('.span_customer_id').html('&nbsp;');
            //Project
            if (!$('#Project').hasClass('disabled')) $('#Project').addClass('disabled');
            $('#Project').val('').trigger("chosen:updated");
            $('.input-customer').val("");
            if ($('.input-customer').hasClass('disabled')) $('.input-customer').removeClass('disabled');
            if ($('.input-project').hasClass('disabled')) $('.input-project').removeClass('disabled');
            $('#cat').val("").trigger("chosen:updated");
            $('#Manufacturer_line').val("").trigger("chosen:updated");
            /*$('#Product option').remove();*/
            $('#Product').val("").trigger("chosen:updated");
            $('#RegistrationStatus').val("").trigger("chosen:updated");
            $('#StageOfProject').val("").trigger("chosen:updated");
            $('#ImportanceLevel').val("").trigger("chosen:updated");
            $('#ApplicationType').val("").trigger("chosen:updated");
            $('#EndCustomerCountry').val("").trigger("chosen:updated");
            $('#ManufacturingCountry').val("").trigger("chosen:updated");
            $('.input-project').val("");
            $('#Project').val("").trigger("chosen:updated");
        }
        $('#project_type').val('').trigger('chosen:updated');
    }).on('change', '#project_type', function () {
        $('#cat').val("").trigger("chosen:updated");
        $('#Manufacturer_line').val("").trigger("chosen:updated");
        $('#Product').val("").trigger("chosen:updated");
        $('#RegistrationStatus').val("").trigger("chosen:updated");
        $('#StageOfProject').val("").trigger("chosen:updated");
        $('#ImportanceLevel').val("").trigger("chosen:updated");
        $('#ApplicationType').val("").trigger("chosen:updated");
        $('#EndCustomerCountry').val("").trigger("chosen:updated");
        $('#ManufacturingCountry').val("").trigger("chosen:updated");
        $('#Project').val("").trigger("chosen:updated");
        $('#ProjectName').val("");
        $('.input-project').val("");

        var type = $(this).val();
        var op1 = '0';//new
        var op2 = '1';//old

        if (type.toUpperCase() == op2) {
            $('#Project').attr('data-required', 1);
            $('#ProjectName').attr('data-required', 1);
            $('.span_project').html('*');
            if ($('#project_id').hasClass('disabled')) $('#project_id').removeClass('disabled');
        }
        if (type.toUpperCase() == op1) {
            $('#project_id').val("").trigger("chosen:updated").attr('data-required', 0);
            $('#Project').val("").trigger("chosen:updated").attr('data-required', 0);
            $('#ProjectName').val("").attr('data-required', 0);
            if (!$('#project_id').hasClass('disabled')) $('#project_id').addClass('disabled');
            $('.span_project').html('&nbsp;');
        }
    }).on('change', '#customer_id', function () {
        showLoading();
        $('.my-request').val();
        var id = $('#customer_id').val();
        if ($('.input-customer').hasClass('disabled')) $('.input-customer').removeClass('disabled');
        if (!!id) {
            load_project(id);
            if ($('.input-customer').hasClass('disabled')) $('.input-customer').removeClass('disabled');
            $.ajax({
                url: site_url + 'customer_request_management/load_customer_info',
                type: "POST",
                data: {id: id},
                cache: false,
                success: function (res) {
                    var data = JSON.parse(res);
                    $('.input-customer').val("");
                    $('.input-project').val("");
                    $('#customer_name').val(data.CompanyNameLo || "");
                    $('#customer_position').val(data.Position || "");
                    $('#customer_email').val(data.Email || "");
                    $('#customer_phone').val(data.Phone || "");
                    $('#customer_region').val(data.AccountRegion || "");
                    $('#customer_country').val(data.ShippingCountry || "")
                    $('#customer_address').val(data.ShippingAddressLine1 || "");
                    $('#customer_region').trigger("chosen:updated");
                    $('#customer_country').trigger("chosen:updated");
                },
                error: function (e) {
                    console.log(e);
                }
            })
        }

        $('#cat').val("").trigger("chosen:updated");
        $('#Manufacturer_line').val("").trigger("chosen:updated");
        // $('#Product option').remove();
        $('#Product').val("").trigger("chosen:updated");
        $('#RegistrationStatus').val("").trigger("chosen:updated");
        $('#StageOfProject').val("").trigger("chosen:updated");
        $('#ImportanceLevel').val("").trigger("chosen:updated");
        $('#ApplicationType').val("").trigger("chosen:updated");
        $('#EndCustomerCountry').val("").trigger("chosen:updated");
        $('#ManufacturingCountry').val("").trigger("chosen:updated");
        $('#project_type').val('').trigger('chosen:updated');
        hideLoading();
    }).on('change', '#Project', function () {
        $('#cat').val("").trigger("chosen:updated");
        $('#Manufacturer_line').val("").trigger("chosen:updated");
        // $('#Product option').remove();
        $('#Product').val("").trigger("chosen:updated");
        $('#RegistrationStatus').val("").trigger("chosen:updated");
        $('#StageOfProject').val("").trigger("chosen:updated");
        $('#ImportanceLevel').val("").trigger("chosen:updated");
        $('#ApplicationType').val("").trigger("chosen:updated");
        $('#EndCustomerCountry').val("").trigger("chosen:updated");
        $('#ManufacturingCountry').val("").trigger("chosen:updated");

        var id = $('#Project').val();
        if (currentProjectINFO == null) {
            var cus = $('#customer_id').val();
            if (!cus) {
                showNoti('Choose a customer id first', 'Err', 'Err');
                $('#Project').val('').trigger("chosen:updated");
                return;
            } else {
                load_project(cus);
            }
        }
        showLoading();
        setTimeout(function () {
            var currentINFO = [];
            if (!!currentProjectINFO[id]) currentINFO = currentProjectINFO[id];
            $('.input-project').val("");
            $.each(currentINFO, function (key, val) {
                if (key == 'RegistrationStatus'
                    || key == 'StageOfProject'
                    || key == 'EndCustomerCountry'
                    || key == 'ManufacturingCountry'
                    || key == 'ImportanceLevel'
                    || key == 'EndCustomerName'
                    || key == 'PlannedAnnualVolume'
                    || key == 'QuantityOfPrototyping'
                    || key == 'DateOfPrototyping'
                    || key == 'DateOfProduction'
                    || key == 'DesignHouse'
                    || key == 'ManufacturingName'
                    || key == 'ProductQuantity'
                    || key == 'ApplicationType') {
                    $('#' + key).val(val).trigger('chosen:updated');
                } else if (key != 'id') $("input[name='project[" + key + "]']").val(val);
            });
            hideLoading();
        }, 500);
    }).on('change', '#channel_manage', function () {
        arrChannelManage = [];
        var ids = $(this).val();
        objChannelManage['channel'] = ids;
        var low = $('#lead_owner').val();
        objChannelManage['lead'] = low;
        if (!!objChannelManage['lead']) {
            arrChannelManage[0] = objChannelManage['lead'];
        }
        if (!!ids) {
            $.each(ids, function (k, id) {
                if (!!id && $.inArray(id, arrChannelManage) == -1) {
                    arrChannelManage.push(id);
                }
            });
        }
        var rts = $('#relate_to').val();
        if (!!rts) {
            $.each(rts, function (i, rt) {
                if (!!rt && $.inArray(rt, arrChannelManage) == -1) {
                    arrChannelManage.push(rt);
                }
            });
        }
        append_option_assign_to();
    }).on('change', '#relate_to', function () {
        var id = $(this).attr('id');
        /*var Carrier = $('#lead_owner').val();
        var Approver = $('#relate_to').val();
        var compare_value = id == 'lead_owner' ? Approver : Carrier;
        if (Carrier != '' && Approver != '' && $(this).val() == compare_value) {
            showNoti('Lead owner & Relate To cannot be the same', 'Warning', 'War');
            $(this).val('').trigger('chosen:updated');
            return false;
        }*/
        arrChannelManage = [];
        var id = $('#lead_owner').val();
        objChannelManage['lead'] = id;
        arrChannelManage[0] = id;
        objChannelManage['channel'] = $('#channel_manage').val();
        if (!!objChannelManage['channel']) {
            $.each(objChannelManage['channel'], function (k, id) {
                if (!!id && $.inArray(id, arrChannelManage) == -1) {
                    arrChannelManage.push(id);
                }
            });
        }

        //type relate to
        var rts = $('#relate_to').val();
        var tid = $('#type_relate_to').val();
        if (!!rts) {
            $.each(rts, function (i, rt) {
                if (tid == 2) {
                    var group = '';
                    if (!!arrRelateToGroup[rt]) group = arrRelateToGroup[rt];
                    var arrGroup = [];
                    if (!!group) arrGroup = group.split(", ");
                    if (!!arrGroup) {
                        $.each(arrGroup, function (k, rtz) {
                            if (!!rtz && $.inArray(rtz, arrChannelManage) == -1) {
                                arrChannelManage.push(rtz);
                            }
                        })
                    }
                } else {
                    if (!!rt && $.inArray(rt, arrChannelManage) == -1) {
                        arrChannelManage.push(rt);
                    }
                }
            });
        }
        append_option_assign_to();
    }).on('click', '.attachments-wrap i.remove', function () {
        //var dir = $('#attachmentUploader').data('dir') + $('#code').val();
        var file = $(this).next().val();
        var att = $('[name*="Attachments"]').serializeArray();
        var attachmentWrap = $(this).parent();
        $.ajax({
            url: site_url + 'ajax/ajax_delete_attachment',
            type: 'POST',
            cache: false,
            data: {
                id: $('#id').val(),
                dir: upload_dir,
                file: file,
                att: att,
                //table: 'tasks',
            },
            success: function () {
                attachmentWrap.fadeOut(function () {
                    $(this).remove();
                });
            }
        })
    }).on('change', '.my-processed_type', function () {
        var text = $(this).val();
        if (text == '0') {
            //var email = sessionStorage.getItem("email");
            var title = sessionStorage.getItem("title_email");
            var content = sessionStorage.getItem("content_email");
            //if (!!email) $('#to_email').val(email);
            if (!!title) $('#title_email').val(title);
            if (!!content) tinyMCE.activeEditor.setContent(content);
            $(this).closest('.panel').find('.btn-emailting').show();
            $('#to_email').val(email_customer || "");
            if (sent_ok) {
                $('#btn-confirm-email').addClass('disabled');
                $('#btn-confirm-email').text('SENT');
            }
            $('#myModalEmailing').modal('show');
        } else {
            $(this).closest('.panel').find('.btn-emailting').hide();
        }

    }).on('click', '#btn-confirm-email', function () {
        sent_email();
    }).on('click', '.btn-emailting', function () {
        $('#myModalEmailing').modal('show');
        if (sent_ok) {
            $('#btn-confirm-email').addClass('disabled');
            $('#btn-confirm-email').text('SENT');
        }
    });
    $(".mynamestatus").change(function () {
        var color = $("option:selected", this).attr("style");
        if (!color) {
            $(this).attr("style", " ");
        }else{
            color = color.replace('background-color:#fff;', '');
            $(this).attr("style", color.replace("color", "background-color") + ';color:#fff;');
        }
    }).change();

    function append_option_relate_to() {
        var id = $('#type_relate_to').val();
        if (!!id) {
            if (id == '1') {
                $('#relate_to').html(op_individual);
            }
            if (id == '2') {
                $('#relate_to').html(op_group);
            }
            if (!!arrValueRelateTo) {
                $('#relate_to').val(arrValueRelateTo);
            }
            $('#relate_to').trigger("chosen:updated");
        }
    }

    function append_option_assign_to() {
        var tmp_val = [];
        if ($('.assign_to').length > 0) {
            $('.assign_to').each(function () {
                var id = $(this).attr('id');
                tmp_val[id] = $(this).val();
            });
        }
        //var old_val = $('.assign_to.old-assign_to').val();
        var html = '<option value="">Select ...</option>';
        if (!!arrChannelManage) {
            $.each(arrChannelManage, function (i, k) {
                if (!!k) {
                    var s = staff[k];
                    html += '<option value="' + k + '">' + s + '</option>';
                }
            });
        }
        $('.assign_to').html(html);
        if ($('#id').val()) {
            if ($('.new-assign_to').val() != '') {
                $('.new-assign_to').each(function () {
                    $(this).next().val($(this).val());
                });
            }
        } else {
            $('.assign_to').each(function () {
                var id = $(this).attr('id');
                if (!!tmp_val[id]) $(this).val(tmp_val[id]);
            });
        }
        $('.assign_to').trigger('chosen:updated');
    }

    function load_project(CustomerID) {
        if (!CustomerID) return;
        $.ajax({
            url: site_url + 'customer_request_management/get_all_project_customer',
            type: "POST",
            data: {CustomerID: CustomerID},
            cache: false,
            success: function (res) {
                var data = JSON.parse(res);
                var projid = data.projectID;
                currentProjectINFO = data.projectINFO;
                var html_projid = "<option value=''>Select ...</option>";
                $.each(projid, function (key, val) {
                    html_projid += '<option value="' + key + '">' + val + '</option>';
                });
                $('#Project').html(html_projid);
                $('#Project').trigger('chosen:updated');
            },
            error: function (e) {
            },
        })
    }

    if ($('#id').val()) {
        append_option_assign_to();
        $('.new-assign_to').each(function () {
            $(this).next().val($(this).val());
        });
        //fisrt request time out
        setTimeout(function () {
            if ($('.my-panel-ds').last().val() == 0) {

                $('#Total-Request-panel').remove();
            } else {
                $('#Total-Request-panel').removeClass('hidden');
            }
        }, 300);
        //next request time out
        setTimeout(function () {
            append_option_relate_to();
            arrChannelManage = $('#channel_manage').val();
            var lead = $('#lead_owner').val();
            if (!!lead && $.inArray(lead, arrChannelManage) == -1) {
                arrChannelManage.push(lead);
            }
            arrAddRequestTos = arrChannelManage;
            var rts = $('#relate_to').val();
            var tid = $('#type_relate_to').val();
            if (!!rts) {
                $.each(rts, function (i, rt) {
                    if (tid == 2) {
                        var group = '';
                        if (!!arrRelateToGroup[rt]) group = arrRelateToGroup[rt];
                        var arrGroup = [];
                        if (!!group) arrGroup = group.split(", ");
                        if (!!arrGroup) {
                            $.each(arrGroup, function (k, rtz) {
                                if (!!rtz && $.inArray(rtz, arrChannelManage) == -1) {
                                    arrChannelManage.push(rtz);
                                }
                            })
                        }
                    } else {
                        if (!!rt && $.inArray(rt, arrChannelManage) == -1) {
                            arrChannelManage.push(rt);
                        }
                    }
                });
            }
            append_option_assign_to();
            var currentChecked = $.inArray(strUser, arrChannelManage);
            var currentCreate = $('#lead_create').val() || [];
            if (currentUser != 1 && currentChecked == -1 && $.inArray(strUser, currentCreate) == -1) {
                $('#lead_owner').addClass('disabled');
                $('#channel_manage').addClass('disabled');
                $('#relate_to').addClass('disabled');
                $('#lead_phone').addClass('disabled');
                $('#lead_email').addClass('disabled');
                $('#type_relate_to').addClass('disabled');
                $('#company').addClass('disabled');
                $('input[name="close"]').addClass('disabled');
            }
        }, 500);
    }
    (function ($) {
        $.fn.autogrow = function (name) {
            var $this, minHeight, lineHeight, shadow, update;
            this.filter('.' + name).each(function () {
                $this = $(this);
                minHeight = $this.height();
                lineHeight = $this.css('lineHeight');
                $this.css('overflow', 'hidden');
                shadow = $('<div></div>').css({
                    position: 'absolute',
                    'word-wrap': 'break-word',
                    top: -10000,
                    left: -10000,
                    width: $this.width(),
                    fontSize: $this.css('fontSize'),
                    fontFamily: $this.css('fontFamily'),
                    lineHeight: $this.css('lineHeight'),
                    resize: 'none'
                }).appendTo(document.body);
                update = function () {
                    shadow.css('width', $(this).width());
                    var val = this.value.replace(/&/g, '&amp;')
                        .replace(/</g, '&lt;')
                        .replace(/>/g, '&gt;')
                        .replace(/\n/g, '<br/>')
                        .replace(/\s/g, '&nbsp;');
                    if (val.indexOf('<br/>', val.length - 5) !== -1) {
                        val += '#';
                    }
                    shadow.html(val);
                    $(this).css('height', Math.max(shadow.height() + 8, minHeight + 8));
                };
                $this.change(update).keyup(update).keydown(update);
                update.apply(this);
            });
            return this;
        };
    }(jQuery));
    $('textarea').css('overflow', 'hidden').autogrow('input-processed');
    $('textarea').css('overflow', 'hidden').autogrow('input-request');

    function select2(name) {
        var select, chosen;
        select = $(name);
        //select.chosen();
        select.chosen({no_results_text: 'Press Enter to add new entry:'});
        chosen = $('.chosen-container-multi');
        chosen.find('input').keyup(function (e) {
            if (e.which === 13 && chosen.find('li.no-results').length > 0) {
                var option = $("<option>").val(this.value).text(this.value);
                select.prepend(option);
                select.find(option).prop('selected', true);
                select.trigger("chosen:updated");
            }
        });
    }
    select2('select#Product');

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
                    var part = $(this).find('td.part').text();
                    $('#Product').append(new Option(part, part, true, true)).trigger('chosen:updated');
                    $(this).remove();
                    if ($('#divSearch tbody tr').length == 0) $('#divSearch').hide();
                });
            }
        });
        $('[name="q"]').val('').blur();
        return false;
    });

    setTimeout(function () {
        $('.ajax-upload-dragdrop .btn').addClass('mybtn-attachment').append('  attachment');
    }, 500);

    setTimeout(function () {
        //check close
        if ($('input[name="close"]:checked').length > 0) {
            $('#Total-Request-panel').parent().remove();
            if (currentUser == 1) {
                $('body :input').not('input[name="close"]').addClass('disabled');
            } else {
                $('body :input').addClass('disabled');
            }
            $('.btnFrm button').removeClass('disabled');
        }
        //op
        op_individual = $('#relate_to_zzzx').html();
        op_group = $('#relate_to_zzz').html();
        $('#relate_to_zzz').remove();
        $('#relate_to_zzzx').remove();
    }, 1);
});
;(function (ns) {
    var mb_strwidth = function (str) {
        var i = 0, l = str.length, c = '', length = 0;
        for (; i < l; i++) {
            c = str.charCodeAt(i);
            if (0x0000 <= c && c <= 0x0019) {
                length += 0;
            } else if (0x0020 <= c && c <= 0x1FFF) {
                length += 1;
            } else if (0x2000 <= c && c <= 0xFF60) {
                length += 2;
            } else if (0xFF61 <= c && c <= 0xFF9F) {
                length += 1;
            } else if (0xFFA0 <= c) {
                length += 2;
            }
        }
        return length;
    };
    var mb_strimwidth = function (str, start, width, trimmarker) {
        if (typeof trimmarker === 'undefined') trimmarker = '';
        var trimmakerWidth = mb_strwidth(trimmarker), i = start, l = str.length, trimmedLength = 0, trimmedStr = '';
        for (; i < l; i++) {
            var charCode = str.charCodeAt(i), c = str.charAt(i), charWidth = mb_strwidth(c), next = str.charAt(i + 1),
                nextWidth = mb_strwidth(next);
            trimmedLength += charWidth;
            trimmedStr += c;
            if (trimmedLength + trimmakerWidth + nextWidth > width) {
                trimmedStr += trimmarker;
                break;
            }
        }
        return trimmedStr;
    };
    ns.mb_strwidth = mb_strwidth;
    ns.mb_strimwidth = mb_strimwidth;
})(window);

function validate(evt) {
    var theEvent = evt || window.event;

    if (theEvent.type === 'paste') {
        key = event.clipboardData.getData('text/plain');
    } else {
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
    }
    var regex = /[0-9]|\./;
    if (!regex.test(key)) {
        theEvent.returnValue = false;
        if (theEvent.preventDefault) theEvent.preventDefault();
    }
}

function validate_email(val) {
    var email = val,
        emailReg = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!emailReg.test(email) || email == '') {
        showNoti('Please enter a valid email address.', 'Err', 'Err');
        return false;
    }
    return true;
}

