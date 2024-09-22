// var base_url = window.location.origin + '/';
$(function (a) {
    a.fn.simpleCheckbox = function(b) {
        var c = {
            newElementClass: "switch-toggle",
            activeElementClass: "switch-on"
        }, b = a.extend(c, b);
        this.each(function() {
            var c = a(this),
                d = a("<div/>", {
                    id: "#" + c.attr("id"),
                    "class": b.newElementClass,
                    style: "display: block;"
                }).insertAfter(this);
            if (c.is(":checked") && d.addClass(b.activeElementClass), c.hide(), a("[for=" + c.attr("id") + "]").length) {
                var e = a("[for=" + c.attr("id") + "]");
                e.click(function() {
                    return d.trigger("click"), !1
                })
            }
            d.click(function() {
                var c = a(this);
                return c.hasClass(b.activeElementClass) ? (c.removeClass(b.activeElementClass), a(c.attr("id")).attr("checked", !1)) : (c.addClass(b.activeElementClass), a(c.attr("id")).attr("checked", !0)), !1
            })
        });
    }
});
$(document).ready(function(){
    if ($('.input-switch-alt').length) {
        $('.input-switch-alt').simpleCheckbox();
        $('.switch-toggle:not(.disabled)').click(function () {
            var id = $(this).prev().data('id');
            var status = $(this).prev().is(':checked') ? 1 : 0;
            var field = $(this).prev().data('field');
            var table = $('#moduleInfo').data('table');
            if (id == '' || id == null) {
                id = $('#id').val();
            }
            if ($(this).parent().find(".input-switch-alt").attr('checked') != undefined) {
                $(this).prev().val(1);
            } else {
                $(this).prev().val(0);
            }

            if (typeof process_after_switch === 'function') {
                return process_after_switch($(this).parent());
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

});



/* Filter Geo */
$(document).ready(function(){
    var buildFilterOptionDistrict = function (callback) {
        tag_province = $("select[name='filter[province_id]'");
        tag_district = $("select[name='filter[district_id]'");
        $.ajax({
            url: base_url +  "/admin/ajax/geo-district",
            type: 'post',
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            data: { province: tag_province.val(), json:true },
            dataType: "json",
            success: function (response) {
                var select = '<option value="">Quận/Huyện</option>';
                var district_id = tag_district.val();
                $.each(response, function (i, data) {
                    var selected = data.id === parseInt(district_id) ? 'selected' : ''
                    select += '<option ' + selected + ' value="' + data.id + '">' + data.name + '</option>';
                });
                tag_district.html(select);

                if(tag_district.attr("data-value")!="")
                {
                    tag_district.val(tag_district.attr("data-value"));
                    tag_district.val(tag_district.find("option:selected").text());
                    tag_district.attr("data-value","");
                }
                if (callback) {
                    callback();
                }
            }
        });
    }
    var buildFilterOptionWard = function (callback) {
        tag_province = $("select[name='filter[province_id]'");
        tag_district = $("select[name='filter[district_id]'");
        tag_ward = $("select[name='filter[ward_id]'");

        $.ajax({
            url: base_url + "/admin/ajax/geo-ward",
            type: 'post',
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            data: { district: tag_district.val() ,json:true},
            dataType: "json",
            success: function (response) {
                var select = '<option value="">Phường/Xã</option>';
                var ward_id = tag_ward.val();
                var response = $.map(response, function (el) { return el });
                response.sort(function (a, b) {
                    return parseInt(a.name) - parseInt(b.name);
                });
                $.each(response, function (i, data) {
                    var selected = data.id === parseInt(ward_id) ? 'selected' : ''
                    select += '<option ' + selected + ' value="' + data.id + '">' + data.name + '</option>';
                });
                tag_ward.html(select);
                if(tag_ward.attr("data-value")!="")
                {
                    tag_ward.val(tag_ward.attr("data-value"));
                    $("#ward").val($("#ward_id").find("option:selected").text());
                    tag_ward.attr("data-value","");
                }
                // $('.ward_id').val(global_ward);



                // if (global_ward == '') {
                //     try {
                //         var re = new RegExp('(, phường )(.*)(,)', "g");
                //         newtxt = re.exec($('#google-input').val());


                //         var phuong = newtxt[2].split(',')[0];

                //         $(".ward_id option").filter(function () {
                //             //may want to use $.trim in here
                //             return $(this).text() == phuong.replace('phường', '').trim();
                //         }).prop('selected', true);

                //     } catch (e) {
                //         /**/
                //     }

                // }


                if (callback) {
                    callback();
                }
            }
        });
    }
    function isEmpty(val){
        return (val === undefined || val == null || val.length <= 0) ? true : false;
    }
    $(document).ready(function () {
        $("select[name='filter[province_id]']").change(function () {
            buildFilterOptionDistrict();
            // $("#province").val($(this).find("option:selected").text());
        });
        $("select[name='filter[district_id]']").change(function () {
            buildFilterOptionWard();
            // $("#district").val($("#district_id").find("option:selected").text());
        });

        buildFilterOptionDistrict(buildFilterOptionWard);
    });
});
