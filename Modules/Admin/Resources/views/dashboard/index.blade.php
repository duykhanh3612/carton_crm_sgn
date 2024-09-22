@extends('admin::layouts.master')
@section('header')
    @include('admin::components.header')
@endsection
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content ">
            <div class="clearfix"></div>
            <div id="main">
                <div class="main-container-inner">
                    <div class="report-content">
                        <div class="row">
                            <div class="col-xs-12" data-ng-init="initDashBoard()">

                                <div ng-controller="usageInfoController" class="ng-scope">

                                </div>
                                @include('admin::dashboard.v1.report-box')
                                <div class="space"></div>
                                @include('admin::dashboard.v1.widget-box')
                                <div class="space"></div>
                                {{-- @include('admin::dashboard.chart-box') --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <style type="text/css">
            .report-content{
                height: 100vh;
            }
            table a {
                color: #337ab7 !important;
            }

            .caption-subject a {
                color: #2f353b !important;
            }

            /* .portlet.light .portlet-body {
                    padding-top: 8px !important;
                } */
            .fright {
                float: right;
                padding-right: 25px;
                text-align: right;
            }
        </style>
        {{-- <script src="https://cdn.dyndns.top/public/dashboard/components/js/common.js"></script> --}}
        <script>
            $(".fade-out").each(function() {
                timeout = $(this).data("time");
                console.log(timeout);
                tag = $(this);
                setTimeout(() => {
                    tag.fadeOut();
                }, timeout);
            });
            $(document).on("click", '.manage-widget', function() {
                $('#manage_widget_modal').modal('show');
                $("input[name*=widgets]").on("change", function() {
                    $(this).val(1 - $(this).val());
                    const ele = $(this);
                    let validate = true;
                    const validate_rule = ele.data('rule');
                    switch (validate_rule) {
                        case 'email':
                            validate = !ele.val() || /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(ele
                                .val());
                    }
                    if (validate) {
                        ele.removeClass('error');
                    } else {
                        ele.addClass('error');
                        return;
                    }
                    let hs_multiple = ele.prop('multiple');
                    const hs_separator = ele.data('separator');
                    const hs_data_type = ele.data('type');
                    const hs_core_var = ele.data('corevarkey');
                    const with_option_text = ele.data('with_option_text');
                    if (hs_multiple == true) {
                        hs_multiple = 1;
                    } else {
                        hs_multiple = 0;
                    }
                    let keyType = ele.attr('keyType');
                    let hsVal = {};
                    let hsTitle = {};

                    if (typeof keyType !== typeof undefined && keyType !== false) {
                        hsVal[keyType] = ele.val();
                    } else {
                        hsVal = ele.val();
                    }

                    if (with_option_text) {
                        ele.find("option").each(function(index, item) {
                            if (hsVal === item.value || ($.isArray(hsVal) && hsVal.indexOf(item
                                    .value) >= 0)) {
                                hsTitle[item.value] = item.text;
                            }
                        });
                    }
                    const data = {
                        'hs_key': this.id,
                        'hs_val': hsVal,
                        'hs_title': hsTitle,
                        'hs_multiple': hs_multiple,
                        'hs_separator': hs_separator,
                        'hs_data_type': hs_data_type,
                        'is_map_field': keyType,
                        'validate_rule': validate_rule,
                        'hs_core_var': hs_core_var,
                    };
                    $.ajax({
                        'url': window.location.origin + "/" + 'admin/setting/update-user-setting',
                        'method': 'POST',
                        'data': data,
                        'success': function success(res) {
                            if (res.status === 200) {
                                let item = $('#' + data['hs_key']).parents('td').find(
                                    '.map-field-addition-setting');
                                if (res.deleted === true) {
                                    item.addClass("d-none");
                                    item.find('select').prop('selectedIndex', 0);
                                } else {
                                    item.removeClass("d-none");
                                }
                                if (ele.hasClass("refresh")) {
                                    // window.location.reload()
                                }
                            }
                            if (res.status === 422) {
                                ele.addClass('error');
                            }
                        }
                    });

                });
            })
        </script>
    </div>
@endsection
