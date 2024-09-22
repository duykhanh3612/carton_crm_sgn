$(document).ready(function () {
    $("input:checkbox").on('click', function () {
        var $box = $(this);
        if ($box.is(":checked")) {
            var group = "input:checkbox[name='" + $box.attr("name") + "']";
            $(group).prop("checked", false);
            $box.prop("checked", true);
        } else {
            $box.prop("checked", false);
        }
    });
    var checkbox = 'input:radio[name="cat-chosen"]';
    var _wrapper = $('.wrapper-parent');
    $(init);

    $('body').on('click', '#add-cat', function () {
        var chk = $('.cat_checkbox:checked');
        var _this = $(this);
        var root = _this.data('root');
        var parent = $("#cat option:selected").text();
        var catid = $("#cat").val();
        if (catid == '') {
            showNoti('Please select a category', 'Design Resource', 'Err');
            return false;
        }
        var top = $('#cat :selected').parent().attr('label');
        var load_ajax = function () {
            $.ajax({
                url: site_url + 'design_resource/ajax_load_template',
                method: 'post',
                data: {id: catid, parent: parent, top: top},
                success: function (html) {
                    var obj = $.parseJSON(html);
                    var panel = 'info-' + (obj.id);
                    if ($('#' + panel).length > 0) {
                        showNoti('This category is exists!', 'Design Resource', 'Err');
                        return false;
                    } else {
                        $('#itemList').append(obj.html);
                    }
                }
            })
        }
        var $choose = chk.val();
        if ($('.cat_checkbox').length > 0) {
            if (!$choose) {
               // showNoti('Please select a category', 'Design Resource', 'Err');
                load_ajax();
                return false;
            }
            if ($choose != '') {
                $.ajax({
                    url: site_url + 'design_resource/ajax_load_child',
                    method: 'post',
                    data: {id: catid, parent: parent, top: top},
                    success: function (html) {
                        var obj = $.parseJSON(html);
                        var panel = 'info-' + (obj.id);
                        if ($('#' + panel).length > 0) {
                            showNoti('This category is exists!', 'Design Resource', 'Err');
                            return false;
                        } else {
                            chk.closest('.diagram-list').find('.wrapper-parent:last').parent().append(' <div class="panel-custom wrapper-parent">' + obj.html + ' </div>');
                            // _this.parent().append(' <div class="panel-custom wrapper-parent">' + obj.html + ' </div>');
                        }
                    }
                })
            }
        } else {
            load_ajax();
        }


        // var checkClass = $(checkbox + ':checked').attr('class');
        // if($(checkbox).length > 0){
        //     if (checkClass == 'check-top') {
        //         var _this = $(checkbox + ':checked').closest('.diagram-list').find('.wrapper-parent');
        //         $.ajax({
        //             url: site_url + 'design_resource/ajax_load_child',
        //             method: 'post',
        //             data: {id: catid, parent: parent, top: top},
        //             success: function (html) {
        //                 var obj = $.parseJSON(html);
        //                 var panel = 'info-'+(obj.id);
        //                 if($('#'+ panel).length > 0){
        //                     showNoti('This category is exists!', 'Design Resource', 'Err');
        //                     return false;
        //                 }else{
        //                     _this.parent().append(' <div class="panel-custom wrapper-parent">' + obj.html+' </div>');
        //                 }
        //             }
        //         })
        //     } else {
        //         showNoti('Select the category to add more', 'Design Resource', 'Err');
        //         return false;
        //     }
        //
        // }else{
        //     load_ajax();
        // }
    /*    if ($('.diagram-list').length > 0) {
            $('.diagram-list').each(function () {
                var _this = $(this);
                var root = _this.data('root');
                console.log(root);
                console.log(top);
                if (root == top) {
                    $.ajax({
                        url: site_url + 'design_resource/ajax_load_child',
                        method: 'post',
                        data: {id: catid, parent: parent, top: top},
                        success: function (html) {
                            var obj = $.parseJSON(html);
                            var panel = 'info-' + (obj.id);
                            if ($('#' + panel).length > 0) {
                                showNoti('This category is exists!', 'Design Resource', 'Err');
                                return false;
                            } else {
                                _this.parent().append(' <div class="panel-custom wrapper-parent">' + obj.html + ' </div>');
                            }
                        }
                    })
                    return false;
                } else {
                    load_ajax();
                    return false;
                }
            })
        } else {
            load_ajax();
        }*/
        update_wapper();
    }).on('click', '#submitBtn', function () {

    }).on('click', '#addPart', function () {
        var checkClass = $(checkbox + ':checked').attr('class');
        if (checkClass == 'check-parent') {
            var wapper = $(checkbox + ':checked').closest('.wrapper-parent');

            var key = 1;
            if (wapper.find('table.mainTable tbody tr td.col-stt').length) {
                key = parseInt(wapper.find('table.mainTable tbody tr:last td.col-stt span').text()) + 1;
            }
            if (!key) key = 1;
            var myid = wapper.find('.panel-part').attr('id');
            if (!!myid) myid = myid.replace('info-', '');
            var myname = 'products[' +myid +'][' + key + ']';
            var myroot = $(checkbox + ':checked').closest('.diagram-list').find('.title-top').text();
            var childname = $(checkbox + ':checked').closest('.diagram-list').find('.title-root').text();
            var html = '<td class="col-sel center"><input type="checkbox" name="'+myname+'[selItem]" class="cb-ele"></td>';
            html += '<td class="center col-stt"><span class="stt">' + key + '</span>';
            html += '<input type="hidden" value="' + myid + '" name="'+myname+'[parent]"/>';
            html += '<input type="hidden" value="' + myroot + '" name="'+myname+'[root]"/>';
            html += '<input type="hidden" value="'+childname+'" name="'+myname+'[name]"/>';
            html += '<input type="hidden" value="' + key + '" name="'+myname+'[SortOrder]"/>';
            html += '<input class="tab-sort" type="hidden" value="' + key + '" name="'+myname+'[TabSortOrder]"/>';
            html += '</td>';
            html += '<td class="col-image"></td>';
            html += '<td class="col-supplier_part"><input type="text" name="'+myname+'[SupplierPart]" class="form-control" ></td>';
            html += '<td class="col-mfr_part"><input type="text" name="'+myname+'[MfrPart]" class="form-control" ></td>';
            html += '<td class="col-description"><input type="text" name="'+myname+'[Description]" class="form-control" ></td>';
            html += '<td class="manufacturer"><input type="text" name="'+myname+'[Manufacturer]" class="form-control" ></td>';
            html += '<td class="col-Package"><input type="text" name="'+myname+'[Package]" class="form-control" ></td>';
            html += '<td class="col-spq"><input type="text" name="'+myname+'[spq]" class="form-control" ></td>';
            html += '<td class="col-moq"><input type="text" name="'+myname+'[moq]" class="form-control" ></td>';
            wapper.find("table.mainTable tbody").append('<tr>' + html + '</tr>');
            update_wapper();
            return false;

            $.ajax({
                url: site_url + 'design_resource/ajax_load_template',
                method: 'post',
                data: {id: catid, parent: parent, top: top},
                success: function (html) {
                    console.log(html);
                    var ojb = $.parseJSON(html);
                    $('#itemList').append(ojb.html);

                    return false;

                    if (ojb.id == 'Choose a category' || ojb.id == '') {
                        showNoti('Please select a category!', 'Err', 'Err');
                        return false;
                    }
                    var myid = (ojb.id).replace(/ /g, '-');
                    if ($('.wrapper-category.' + myid).length > 0) {
                        showNoti('This is category exist on page!', 'Err', 'Err');
                    } else {

                    }
                }
            })
        } else {
            showNoti('Please checkbox the category', 'Err', 'Err');
            return;
        }
    }).on('click', '#removePart', function () {
        // var checkClass = $(checkbox + ':checked').attr('class');
        // if (checkClass == 'check-parent') {
            var t = $(checkbox + ':checked').closest('.wrapper-parent');
            $.alerts.confirm('Will you delete this row?<br/><strong>', 'Confirm delete', function (r) {
                if (r == true) {
                   $('table.mainTable tr td.col-sel input[type="checkbox"]:checked').each(function () {
                        var tr = $(this).closest('tr');
                        tr.remove();
                        update_wapper();
                    })
                }
            });
        // } else {
        //     showNoti('Please checkbox the category', 'Err', 'Err');
        //     return;
        // }
    }).on('click', '.remove-rows-tabs', function () {
        var _this = $(this);
        var wp = _this.closest('.diagram-list');
        var arrId = [];
        wp.find('.product_id').each(function () {
            var _this = $(this);
            var Val = _this.val();
            arrId.push(Val);
        })

        $.alerts.confirm('Will you delte this tab?<br/><strong>', 'Confirm delete', function (r) {
            if (r) {
                console.log(arrId);
                $.ajax({
                    url: site_url + 'design_resource/ajax_delete_tab',
                    type: 'POST',
                    cache: false,
                    data: {
                        id: arrId
                    },
                    success: function (string) {

                    },

                })
                _this.closest('.diagram-list').remove();
            }
        })
    })

    function add_row(w, data) {
        var key = data.key;
        if ($('tr.empty-row').length) $('tr.empty-row').remove();
        var string = '<tr class="highlightNoClick">';
        var myname = 'products[' + (data.parent) +'][' + key + ']';
        var childname = w.closest('.diagram-list').find('.title-root').text();
        string += '<td class="col-sel center"><input type="checkbox" name="'+myname+'[selItem]" class="cb-ele"></td>';
        string += '<td class="center col-stt"><span class="stt">' + key + '</span>';
        string += '<input type="hidden" value="' + data.parent + '" name="'+myname+'[parent]"/>';
        string += '<input type="hidden" value="' + data.root + '" name="'+myname+'[root]"/>';
        string += '<input type="hidden" value="'+childname+'" name="'+myname+'[name]"/>';
        string += '<input type="hidden" value="' + key + '" name="'+myname+'[SortOrder]"/>';
        string += '<input class="tab-sort" type="hidden" value="' + key + '" name="'+myname+'[TabSortOrder]"/>';
        string += '</td>';
        string += '<td class="col-image"><img style="max-width: 27px;" src="' + data.img + '"><input type="hidden" name="'+myname+'[image]" data-field="image" value="' + data.image + '"></td>';
        string += ' <td class="col-supplier_part">';
        string += ' <input type="text" name="'+myname+'[SupplierPart]" class="form-control  supplier-part" value="' + data.supplier_part + '">';
        string += ' </td>';
        string += ' <td class="col-mfr_part"><input type="text" name="'+myname+'[MfrPart]" class="form-control   mfr-part" value="' + data.manufacturer_part_number + '"></td>';
        string += ' <td class="col-description"><input type="text" name="'+myname+'[Description]" class="form-control " value="' + data.description + '"></td>';
        string += ' <td class="manufacturer"><input type="text" name="'+myname+'[Manufacturer]" class="form-control " value="' + data.manufacturer + '"></td>';
        string += ' <td class="col-Package"><input type="text" name="'+myname+'[Package]" class="form-control " value="' + data.package_case + '"></td>';
        string += ' <td class="col-spq"><input type="text" name="'+myname+'[spq]" class="form-control " value="' + data.spq + '"></td>';
        string += ' <td class="col-moq"><input type="text" name="'+myname+'[moq]" class="form-control " value="' + data.moq + '"></td>';
        string += ' </tr>';
        w.find('table.mainTable tbody').append(string);
    }

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
                    var tr = $(this);
                    var part = $(this).find('.part').text();
                    //todo submit search
                    var checkClass = $(checkbox + ':checked').attr('class');
                    if (checkClass == 'check-parent') {
                        var wapper = $(checkbox + ':checked').closest('.wrapper-parent');
                        var key = 1;
                        if (wapper.find('table.mainTable tbody tr td.col-stt').length) {
                            key = parseInt(wapper.find('table.mainTable tbody tr:last td.col-stt span').text()) + 1;
                        }
                        if (!key) key = 1;
                        var myid = wapper.find('.panel-part').attr('id');
                        if (!!myid) myid = myid.replace('info-', '');
                        var myroot = $(checkbox + ':checked').closest('.diagram-list').find('.title-top').text();
                        var data = {
                            key: key,
                            parent: myid,
                            root: myroot,
                            img: tr.find('img').data('url'),
                            image: tr.find('img').data('image'),
                            supplier_part: tr.find('td.part').text(),
                            manufacturer_part_number: tr.find('span.mfr-part').text(),
                            description: tr.find('span.desc').text(),
                            manufacturer: tr.find('td.manufacturer').text(),
                            package_case: tr.find('td.package_case').text(),
                            spq: tr.find('td.spq').text(),
                            moq: tr.find('td.miniquan').text(),
                        };

                        console.log(data);

                        add_row(wapper, data);
                        update_wapper();

                        $(this).remove();
                    } else {
                        showNoti('Please checkbox the category', 'Err', 'Err');
                        return;
                    }
                    if ($('#divSearch tbody tr').length == 0) $('#divSearch').hide();
                });
            }
        });
        $('[name="q"]').val('').blur();
        return false;
    });

    function update_wapper() {
        $('.wrapper-parent').each(function (stt) {
            $(this).find('.tab-sort').val(stt);
            // $(this).find('table.mainTable tbody tr').each(function (i) {
            //     $(this).find('td.stt').text(i);
            // });
        })
    }

    function select2(name) {
        var select, chosen;
        select = $(name);
        select.chosen({no_results_text: 'Press Enter to add new entry:'});
        chosen = $('.chosen-container');
        chosen.find('input').keyup(function (e) {
            if (e.which === 13 && chosen.find('li.no-results').length > 0) {
                var _this = this;
                var option = $("<option>").val(_this.value).text(_this.value);
                select.prepend(option);
                select.find(option).prop('selected', true);
                select.trigger("chosen:updated");
            }
        });
    }

    function init() {
        select2('select#cat');
    }
});
