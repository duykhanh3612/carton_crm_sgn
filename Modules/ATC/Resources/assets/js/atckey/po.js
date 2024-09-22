$( document ).ready(function() {
    $('.select-autoComplete-customer').select2({
        placeholder: 'Select An Customer',

        ajax: {
            url: site_url + 'ajax/CustomerID',
            dataType: 'json',
            async: false,
            data: function (data) {
                return {
                    searchTerm: data.term // search term
                };
            },
            processResults: function (response) {
                return {
                    results:response
                };
            },
            allowClear: true
        },
        dropdownCssClass : 'bigdrop'
    });
    $('.js-example-basic-multiple').chosen('destroy');

    var tomorrow = moment().add(0, 'd').startOf('d');
    // var daysDisabled = [3]; //e.g. disable all wednesday
    // var selectDate = moment().add(1, 'week').day(2); // e.g. select next tuesday
    function datetimeRefresh(){
        $('.bootstrap-datepicker-time').datetimepicker({
            format: 'YYYY-MM-DD HH:mm',
            useCurrent: false,
            ignoreReadonly: true,
            // daysOfWeekDisabled: daysDisabled,
            // defaultDate: selectDate,
            minDate: tomorrow,
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
    datetimeRefresh();
    $(function () {
        $('.po-bootstrap-datetimepicker').datetimepicker({
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
    function deletecookie() {
        document.cookie = 'staff=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
        document.cookie = 'department=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
        document.cookie = 'usergroup=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
    }
    deletecookie();
    document.cookie = 'staff=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
    document.cookie = 'department=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
    document.cookie = 'usergroup=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';

    function setCookie(cname,cvalue,exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        var expires = "expires=" + d.toGMTString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }
    function getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for(var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }
    $(".multiple-staff").click(function(){
        var parent = $(this).closest('.row');
        var deparment = parent.find('.js-example-basic-multiple-deparment').val();
        var $prnt = $(this).parents('.queryStaff');
        var usergroup = $prnt.find('.js-example-basic-multiple').val();
        setCookie("department", deparment, 30);
        setCookie("usergroup", usergroup, 30);

    });
    function select2(){
        $(".js-example-basic-multiple").select2({
            tags: true,
            placeholder: "Select an Option",
            allowClear: true,
            ajax: {
                url: site_url + $('#act').val() + '/getGroup',
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        keyWord: params.term
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });
        $(".js-example-basic-multiple-deparment").select2({
            tags: true,
            placeholder: "Select an Option",
            allowClear: true,
            ajax: {
                url: site_url + $('#act').val() + '/getDeparment',
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        keyWord: params.term
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });
        $(".js-example-basic-multiple-staff").select2({
            tags: true,
            placeholder: "Select an Option",
            allowClear: true,
            ajax: {
                url: site_url + $('#act').val() + '/getStaffs',
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        keyWord: params.term
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });
        $('.js-example-basic-multiple').on('select2:select', function (e) {
            test = this.id ;
            res = test.replace("title_usergroup_", "");
            number = $('#number_approver_'+ res ).val();
            myValue = $(this).val();
            setCookie("usergroup", myValue, 30);
            var $prnt = $(this).parents('.queryStaff');
            $prnt.find('.js-example-basic-multiple-deparment').val(null).trigger('change');
            $prnt.find('.js-example-basic-multiple-staff').val(null).trigger('change');
            $(".js-example-basic-multiple").select2({
                // maximumSelectionLength: number,
                ajax: {
                    url: site_url + $('#act').val() + '/getGroup',
                    type: "post",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            keyWord: params.term
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                }
            });

        });
        $('.js-example-basic-multiple-deparment').on('select2:select', function (e) {
            test = this.id ;
            res = test.replace("title_department_", "");
            number = $('#number_approver_'+ res ).val();
            myValue = $(this).val();
            setCookie("department", myValue, 30);
            $(".js-example-basic-multiple-deparment").select2({
                // maximumSelectionLength: number,
                ajax: {
                    url: site_url + $('#act').val() + '/getDeparment',
                    type: "post",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            keyWord: params.term
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                }
            });

        });

        $('.js-example-basic-multiple-staff').on('select2:select', function (e) {
            test = this.id ;
            res = test.replace("title_staff_", "");
            console.log(test);
            number = $('#number_approver_'+ res ).val();
            var parent = $(this).closest('.row');
            var orderQuantity = parent.find('.js-example-basic-multiple-deparment').val();
            // console.log(orderQuantity);
            var $prnt = $(this).parents('.queryStaff');
            var test = $prnt.find('.js-example-basic-multiple').val();
            console.log($prnt.find('.js-example-basic-multiple').val());
            console.log(orderQuantity);
            $(".js-example-basic-multiple-staff").select2();
            myValue = $(this).val();
            if (number > 0){
                $(".js-example-basic-multiple-staff").select2({
                    // maximumSelectionLength: number,
                    ajax: {
                        url: site_url + $('#act').val() + '/getStaffs',
                        type: "post",
                        dataType: 'json',
                        allowClear: true,
                        quietMillis: 100,
                        delay: 100,
                        data: function (params) {
                            return {
                                keyWord: params.term
                            };
                        },
                        processResults: function (data) {
                            return {
                                results: data
                            };
                        },
                        cache: true
                    }
                });
            }
        });

    }


    number_level = $('#number_level').val();
    setCookie("number_level", number_level, 30);
    for(var level = 1; level <= number_level; level++) {
        document.cookie = 'title_staff_'+level+'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
    }

    $( ".js-example-basic-multiple-staff" ).change(function() {
        test = this.id ;
        myValue = $(this).val();
        setCookie(test, myValue, 30);
    });
    $( ".number_approver").change(function() {
        id = this.id ;
        var html = '';
        res = id.replace("number_approver_", "");
        console.log(res);
        $(".usergroup_close_"+res).css("pointer-events", "unset");
        myValue = $(this).val();
        console.log(myValue);

            // var $prnt = $(this).parents('.fg-wrap-invoices');
            // $prnt.find('.addendum'+res).remove();

            var $prnt = $(this).parents('.number_approver_check');
            var $prnt1 = $(this).parents('.fg-wrap-invoices-approved');
            $prnt1.find('.addendum'+res).remove();
            console.log($prnt);
            for(var i = 1; i < myValue; i++) {
                html +='<div class="row queryStaff " style="margin-bottom: 5px;">';
                html +='    <div class="col-sm-12">';
                html +='    <div class="col-sm-1">';
                html +='    <input type="hidden" class="form-control " name="approved[addendum][]" value="1" autocomplete="off">';
                html +='    <input type="hidden" class="form-control " name="approved[status][]" value="1" autocomplete="off">';
                html +='    <input type="hidden" class="form-control " name="approved[level_approver][]" value="'+res+'" autocomplete="off">';
                html +='    </div>';
                html +='    <div class="col-sm-1">';
                html +='    <input type="hidden" class="form-control " name="approved[number_approver][]" value="'+myValue+'" autocomplete="off">';
                html +='    </div>';
                html +='    <div class="col-sm-2 usergroup_close_" >';
                html +='    <select  class="form-control js-example-basic-multiple"   name="approved[title_usergroup][]"  >';
                html +='    </select>';
                html +='    </div>';
                html +='    <div class="col-sm-2 usergroup_close" >';
                html +='    <select  class="js-example-basic-multiple-deparment form-control"  name="approved[title_department][]"  >';
                html +='    </select>';
                html +='    </div>';
                html +='    <div class="col-sm-4 multiple-staff usergroup_close_">';
                html +='    <select class="js-example-basic-multiple-staff form-control" name="approved[title_staff][]" >';
                html +='    </select>';
                html +='    </div>';
                html +='    <div class="col-sm-2 usergroup_close">';
                html +='    <input type="text" class="form-control date-restrict bootstrap-datepicker-time" name="approved[title_date][]" value="" autocomplete="off">';
                html +='    <div class="errordiv ">Not Empty</div>';
                html +='</div>';
                html +='</div>';
                html +='</div>';
                // var test = $('.new-wrap').html();
            }
            $(".js-example-basic-multiple").select2('destroy');
            $(".js-example-basic-multiple-staff").select2('destroy');
            $(".js-example-basic-multiple-deparment").select2('destroy');
            var clone = $(html);
            $prnt.find('.add-user').html(clone);
            select2();
            datetimeRefresh();
            dataRestrict();

        // setCookie(test, myValue, 30);
    });
    setTimeout(function(){
        $('.js-example-basic-multiple').chosen('destroy');
        $(".js-example-basic-multiple-staff").chosen('destroy');
        $(".js-example-basic-multiple-deparment").chosen('destroy');

        // $(".js-example-basic-multiple").select2('destroy');
        // $(".js-example-basic-multiple-staff").select2('destroy');
        // $(".js-example-basic-multiple-deparment").select2('destroy');
        datetimeRefresh();
        select2(); }, 2000);

    function dataRestrict(){
        $('.date-restrict').on('dp.hide', function (e) {
            // console.log($(this).val());
            var row = $(this).closest('#list_approved');
            // console.log(row);
            var _that = $(this);
            var selectStaff = _that.parent().parent().parent().find('.select-staff');
            var preStep = _that.closest('.form-group').prev('.form-group').find('.date-restrict');
            var curStepIndex = _that.closest('.form-group').index();
            console.log(curStepIndex);
            var process_date = _that.val();

            var tdate = new Date();
            var dd = tdate.getDate();
            var MM = tdate.getMonth() + 1;
            var yyyy = tdate.getFullYear();
            var today = yyyy + '-' + MM + '-' + dd;
            if (_that.val() == '' && selectStaff.val() == '') {
                _that.removeAttr('data-required', 1);
                selectStaff.removeAttr('data-required', 1);
            }

            if (_that.val() == '' && selectStaff.val() != '') {
                _that.attr('data-required', 1);
                selectStaff.attr('data-required', 1);
            }

            if (_that.val() != '') {
                _that.attr('data-required', 1);
                selectStaff.attr('data-required', 1);
            }

            if (comparedates(today, process_date)) {
                _that.parent().find('.check-success').addClass('');
            } else {
                _that.parent().find('.check-success').removeClass('');
            }

            for (var c = curStepIndex - 1; c >= 0; c--) {

                // var _date1 = new Date(row.find('.form-group:eq(' + c + ')').find('.date-restrict').val());
                // var _date2 = new Date( _that.val());
                // console.log(c);
                console.log(row.find('.queryStaff:eq(' + c + ')').find('.date-restrict').val());
                if(row.find('.queryStaff:eq(' + c + ')').find('.date-restrict').val() == ''){
                    showNoti('Vui lòng chọn ngày Level thấp trước', 'Cảnh báo', 'War');
                    _that.val('');
                    return false;
                }
                if (comparedates(row.find('.queryStaff:eq(' + c + ')').find('.date-restrict').val(), _that.val())) {

                    showNoti('Ngày được chọn phải lớn hơn bước phía trước', 'Cảnh báo', 'War');
                    _that.val('');
                    // _that.parent().parent().next().find('select').removeAttr('data-required', 1);
                    // _that.parent().parent().next().find('select').val('').trigger('chosen:updated');
                }


            }

            var _here = _that;
            var _next = _that.closest('.form-group').next('.form-group').find('.date-restrict');
            var _i = 0;
            var count_item = _that.closest('.row').find('.form-group .date-restrict').length;
            // if(comparedates(_that.val(), _next.val())) {
            for (var n = curStepIndex + 1; n <= count_item; n++) {
                if (comparedates(_that.val(), row.find('.form-group:eq(' + n + ')').find('.date-restrict').val())) {
                    row.find('.form-group:eq(' + n + ')').find('.date-restrict').val('');
                }
            }
            // }
            // while((typeof _next.val() !== "undefined") && _i < count_item){
            //     _i++;
            //     if(comparedates(_that.val(),_next.val())){
            //         _next.val('');
            //         _next.parent().parent().next().find('select').removeAttr('data-required', 1);
            //         _next.parent().parent().next().find('select').val('').trigger('chosen:updated');
            //     }
            //     _here = _next;
            //     _next = _here.closest('.form-group').next('.form-group').find('.date-restrict');
            // }
            return false;
        })
    }

    dataRestrict();



    $('#levelapp').change(function () {

        var lengthtext = $('option:selected', this).text();
        var _that = $(this);
        var curStepIndex =  $('.number_approver_check').length;
        var row = $(this).closest('#list_approved');
        $('#number_level').html(lengthtext);
        var numberslice = parseInt(lengthtext, 10) + 1;
        // var num_rows = row.find('.form-group:eq(' + c + ')').find('.date-restrict').val();
        console.log(curStepIndex);

        // if(number_level){
        //     if(number_level > lengthtext){
        //         $('.fg-wrap-invoices').find("div.number_approver_row").slice(lengthtext, number_level).remove();
        //     }else{
        if(curStepIndex == 0){
            $.ajax({
                url: site_url + $('#act').val() + '/htmllevel',
                type: 'POST',
                cache: false,
                data: {lengthtext: lengthtext},
                success: function (data) {
                    $('#list_approved').html(data);
                }
            })
        }
        if(curStepIndex > lengthtext){
            console.log({
                numberslice,curStepIndex
            });
            $('#fg-wrap-invoices-approved').find("div.number_approver_check").slice(numberslice, curStepIndex).remove();
        }else{
            var html = '';
            var myValue = lengthtext - curStepIndex;

            console.log(myValue);
            for(var i = 0; i <= myValue; i++) {
                html +='<div class="form-group group-required fg-inv number_approver_check" >';
                html +='<div class="row queryStaff " style="margin-bottom: 5px;">';
                html +='    <div class="col-sm-12">';
                html +='    <div class="col-sm-1">';
                html +='    <span>Level '+curStepIndex+'';
                html +='    <input type="hidden"  name="approved[SortOder][]" class="form-control " value="'+curStepIndex+'" placeholder="Number Approver">';
                html +='    <input type="hidden" class="form-control " name="approved[addendum][]" value="0" autocomplete="off">';
                html +='    <input type="hidden" class="form-control " name="approved[status][]" value="1" autocomplete="off">';
                html +='    <input type="hidden" class="form-control " name="approved[level_approver][]" value="'+curStepIndex+'" autocomplete="off">';
                html +='    </span>';
                html +='    </div>';
                html +='    <div class="col-sm-1">';
                html +='    <input id="number_approver_'+curStepIndex+'" class="form-control number_approver" name="approved[number_approver][]" value="" autocomplete="off" placeholder="Number Approver">';
                html +='    </div>';
                html +='    <div class="col-sm-2 usergroup_close_" >';
                html +='    <select  class="form-control js-example-basic-multiple"   name="approved[title_usergroup][]"  >';
                html +='    </select>';
                html +='    </div>';
                html +='    <div class="col-sm-3 usergroup_close" >';
                html +='    <select  class="js-example-basic-multiple-deparment form-control"  name="approved[title_department][]"  >';
                html +='    </select>';
                html +='    </div>';
                html +='    <div class="col-sm-3 multiple-staff usergroup_close_">';
                html +='    <select class="js-example-basic-multiple-staff form-control" name="approved[title_staff][]" >';
                html +='    </select>';
                html +='    </div>';
                html +='    <div class="col-sm-2 usergroup_close">';
                html +='    <input type="text" class="form-control date-restrict bootstrap-datepicker-time" name="approved[title_date][]" value="" autocomplete="off">';
                html +='    <div class="errordiv ">Not Empty</div>';
                html +='</div>';
                html +='</div>';
                html +='</div>';
                html +='<div class="add-user">';
                html +='</div>';
                html +='</div>';
                curStepIndex += 1;
                // var test = $('.new-wrap').html();
            }
            $(".js-example-basic-multiple").select2('destroy');
            $(".js-example-basic-multiple-staff").select2('destroy');
            $(".js-example-basic-multiple-deparment").select2('destroy');
            var clone = $(html);
            $('.fg-wrap-invoices-approved').append(html);
            select2();
            datetimeRefresh();
            dataRestrict();
            add_number_approver();
        }
        $('#number_level').val(lengthtext);
    });
    function add_number_approver() {
        $(".number_approver").change(function() {
            id = this.id ;
            var html = '';
            res = id.replace("number_approver_", "");
            console.log(res);
            $(".usergroup_close_"+res).css("pointer-events", "unset");
            myValue = $(this).val();

            var $prnt = $(this).parents('.number_approver_check');
            var level = $prnt.find('.number_approverd').val();
            var $prnt1 = $(this).parents('.number_approver_check');
            $prnt1.find('.addendum').remove();
            for(var i = 1; i < myValue; i++) {
                var level_add = level+'.'+i ;
                html +='<div class="row queryStaff addendum" style="margin-bottom: 5px;">';
                html +='    <div class="col-sm-12">';
                html +='    <div class="col-sm-1">';
                html +='    <input type="hidden" class="disabled_app form-control " name="approved[SortOder][]" value="'+level_add+'" autocomplete="off">';
                html +='    <input type="hidden" class="disabled_app form-control " name="approved[addendum][]" value="1" autocomplete="off">';
                html +='    <input type="hidden" class="disabled_app form-control app_status" name="approved[status][]" value="1" autocomplete="off">';
                html +='    <input type="hidden" class="disabled_app form-control " name="approved[level_approver][]" value="'+res+'" autocomplete="off">';
                html +='    </div>';
                html +='    <div class="col-sm-1">';
                html +='    <input type="hidden" class="disabled_app form-control " name="approved[number_approver][]" value="'+myValue+'" autocomplete="off">';
                html +='    </div>';
                html +='    <div class="col-sm-2 usergroup_close_" >';
                html +='    <select  class="disabled_app form-control js-example-basic-multiple"   name="approved[title_usergroup][]"  >';
                html +='    </select>';
                html +='    </div>';
                html +='    <div class="col-sm-3 usergroup_close" >';
                html +='    <select  class="disabled_app js-example-basic-multiple-deparment form-control"  name="approved[title_department][]"  >';
                html +='    </select>';
                html +='    </div>';
                html +='    <div class="col-sm-3 multiple-staff usergroup_close_">';
                html +='    <select class="disabled_app js-example-basic-multiple-staff form-control" name="approved[title_staff][]" >';
                html +='    </select>';
                html +='    </div>';
                html +='    <div class="col-sm-2 usergroup_close">';
                html +='    <input type="text" class="disabled_app form-control bootstrap-datepicker-time date-restrict " name="approved[title_date][]" value="" autocomplete="off">';
                html +='    <div class="errordiv ">Not Empty</div>';
                html +='</div>';
                html +='</div>';
                html +='</div>';

            }
            $(".js-example-basic-multiple").select2('destroy');
            $(".js-example-basic-multiple-staff").select2('destroy');
            $(".js-example-basic-multiple-deparment").select2('destroy');
            var clone = $(html);
            $prnt.find('.add-user').html(clone);
            select2();
            datetimeRefresh();
            dataRestrict();
            // setCookie(test, myValue, 30);
        });
    }

});

function comparedates(date1, date2) {
    if ((typeof date1 == 'undefined') || (typeof date2 == 'undefined')) return false;
    var _date1 = new Date(date1);
    var _date2 = new Date(date2);
    // console.log(_date1);
    // console.log(date1);
    if (_date1.getTime() > _date2.getTime())
        return true;
    else
        return false;
}
