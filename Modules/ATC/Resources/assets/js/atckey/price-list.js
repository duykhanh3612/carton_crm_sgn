$(document).ready(function () {
    function isInt(value) {
        return typeof value === 'Num' && parseFloat(value) == parseInt(value, 10) && !isNaN(value);
    }

    function convert(currency) {
        if (!currency || isInt(currency)) return false;
        currency = currency.toString();
        currency = currency.replace(',', '');
        return parseFloat(currency);
    }

    console.log = () => '';
    $(init);
    var lastNumber = 0;
    var price_err = 0;
    var lastTH = $('.input-th:last').val() || 1;
    var check_cate = 'input:radio[name="check-category"][value="stt"]';
    var tr_details = ' <tr class="highlightNoClick"> <td width="15%" class="td-part"><input type="text" class="form-control input-part input-style"></td> <td width="15%" class="td-mfr"><span class="mfr">2</span></td> <td width="30%" class="td-desc"><span class="description">3</span></td> <td width="10%" class="td-manufacturer"><span class="manufacturer">2</span></td> <td width="5%" class="td-group"><input type="text" class="input-spq form-control input-group input-style"></td> <td nowrap="nowrap" width="5%" class="td-moq"><input autocomplete="off" type="text" value="" size="6" class="input-style input-moq price-details"/></td> <td nowrap="nowrap" width="10%" class="td-leadtime"><input autocomplete="off" type="text" value="" class="form-control input-leadtime"></td> </tr>';
    var td_input = '<td class="th-style"><input autocomplete="off" type="text" value="" size="6" class=" input-style"/></td>';
    var input_td = '<td><input autocomplete="off" type="text" value="" size="6" class="input-style"/></td>';
    //input_td += '<div class="errordiv z-price"> <div class="arrow"></div> Not empty </div></div>';
    var aAddCol = '<td class="default"><a type="button" class="addCol-Price btn btn-border btn-alt border-orange font-orange waves-effect pull-right"> Add <i class="fa fa-table" title="Add more Colunm"></i> </a></td>';
    var _wrapper = $('.wrapper-category');

    function updateInputPart(obj = false) {
        var stage = (obj ? 'updatePart' : 'newInput');
        var wrapper = '.wrapper-category.' + stage;
        var append = function (wrapper, $class, value, class_name, td) {
            $(wrapper + $class).parent('td.' + td).html('<input type=text value = "' + (value || "") + '" class="' + "form-control " + class_name + '">').addClass(td);
        }
        if (!!obj.part) {
            $(wrapper).find('.prices-for-distributors td.td-part:last :input').val(obj.part);
            $(wrapper).find('.prices-for-sales td.td-part:last :input').val(obj.part);
        }
        append(wrapper, ' input-part', obj.part, "input-part", 'td-part');
        append(wrapper, ' span.product-group', obj.group, "input-group input-spq", 'td-group');
        append(wrapper, ' span.description', obj.desc, "input-desc", 'td-desc');
        append(wrapper, ' span.mfr', obj.mfr, "input-mfr", 'td-mfr');
        append(wrapper, ' span.manufacturer', obj.manufacturer, "input-manufacturer", 'td-manufacturer');
        //append(wrapper, ' span.leadtime', obj.leadtime, "input-leadtime", 'td-leadtime');
        if (!!obj.leadtime) {
            $(wrapper).find('.prices-for-distributors td.td-leadtime:last :input').val(obj.leadtime);
            $(wrapper).find('.prices-for-sales td.td-leadtime:last :input').val(obj.leadtime);
        }
        $('.prices-for-distributors .table-details :input').addClass('distributor-details');
        $('.prices-for-sales .table-details :input').addClass('sales-details');
        $(wrapper).removeClass(stage);
    }

    function addPart(wrapper, $input = false) {
        var thr3_s0m3 = 0;
        wrapper.addClass($input ? 'newInput' : 'updatePart');
        var tr_price = '';
        var count_th = wrapper.find('.table-distributors').children('thead:first').children('tr:last').children('th').length;
        if (count_th > 0) {
            for (var i = 0; i < count_th; i++) {
                ++thr3_s0m3;
                if (thr3_s0m3 == 1) tr_price += '<td class="th-style td-buy"><input autocomplete="off" type="text" value="" size="6" class=" input-style input-buy"/></td>';
                if (thr3_s0m3 == 2) tr_price += '<td class="th-style td-cost"><input autocomplete="off" type="text" value="" size="6" class="input-cost"/></td>';
                if (thr3_s0m3 == 3) tr_price += '<td class="th-style td-sold center"><input autocomplete="off" type="text" value="" class="disabled" size="6" /></td>';
                if (thr3_s0m3 == 4) tr_price += '<td class="th-style td-margin"><input autocomplete="off" type="text" value="" size="6" class="input-margin"/></td>';
                if (thr3_s0m3 >= 4) thr3_s0m3 = 0;
                lastNumber++;
            }
        } else tr_price += td_input;
        wrapper.find('.tb-details').append(tr_details);
        $.each(['distributors', 'sales'], function (i, name) {
            if (i == 1) tr_price = tr_price.replace(new RegExp('<span class="tag-weight">0</span>', 'g'), '');
            wrapper.find('.tb-' + name).append('<tr class="highlightNoClick row-' + lastNumber + '" data-row="' + lastNumber + '">' + tr_price + '</tr>');
        });
        wrapper.find('.table-distributors :input').addClass('input-distributor');
        wrapper.find('.table-sales :input').addClass('input-price');
        wrapper.find('.table-distributors .input-th.input-measure').val('100');
        wrapper.find('.table-distributors thead th').addClass('input-thead input-distributor');
        wrapper.find('.table-price thead th :input').attr('data-v-max', '999999999').attr('data-v-min', 0);
        setup_measure();
        countstt();
        enterOnlyNumber();
        addClassRequest();
        setStore(wrapper);
        $('.label-weight span').addClass('money');
        $('.input-value').not('.input-margin').addClass('money');
        $('.input-thead').addClass('money');
        wrapper.find('.label-weight span').addClass('money');
        wrapper.find('.input-moq').addClass('money').attr('data-v-max', '999999999').attr('data-v-min', 0);
        wrapper.find('.input-spq').addClass('money').attr('data-v-max', '999999999').attr('data-v-min', 0);
        $('tbody tr').addClass('fetch70');
        wrapper.find('.label-weight').removeClass('hidden');
        //wrapper.find('.tag-weight').attr('style', 'margin-top: 26px !important;');
        wrapper.find('.tag-weight').each(function () {
            var Val = $(this).val();
            Val = Val.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
            $(this).attr('title', Val);
        })
        var my_eye = wrapper.find('.viewWeight');
        if (my_eye.hasClass('viewWeight_close')) {
            if (my_eye.hasClass('eye_close')) {
                my_eye.addClass('eye_open').removeClass('eye_close viewWeight_close');
            }
        }
        wrapper.find('.table-price tbody tr td:nth-child(4n+2) .label-weight').remove();
        //wrapper.find('.table-price tbody tr td:nth-child(4n+3) .label-weight').remove();
        wrapper.find('.table-price tbody tr td:nth-child(4n+4) .label-weight').remove();
        wrapper.find('.table-sales tbody tr td:nth-child(4n+3) :input').remove();
        wrapper.find('.table-sales tbody tr td:nth-child(4n+3) .label-weight').remove();
        wrapper.find('.table-price thead tr.label th:nth-child(4n+2) span').html('Purchasing Cost');
        wrapper.find('.table-price thead tr.label th:nth-child(4n+3) span').text('COGS');
        wrapper.find('.table-price thead tr.label th:nth-child(4n+4) span').text('Margin(%)');
        $('.money').autoNumeric('init');
    }

    function select2(name) {
        var select, chosen;
        select = $(name);
        select.chosen({no_results_text: 'Press Enter to add new entry:'});
        chosen = $('.chosen-container');
        chosen.find('input').keyup(function (e) {
            if (e.which === 13 && chosen.find('li.no-results').length > 0) {
                var _this = this;
                //$.alerts.confirm('Will you new category? <br/><strong>' + _this.value, 'Confirm added', function (r) {
                //if (r == true) {
                var option = $("<option>").val(_this.value).text(_this.value);
                select.prepend(option);
                select.find(option).prop('selected', true);
                select.trigger("chosen:updated");
                //}
                //});
            }
        });
    }

    function addDivErr(fisrt_load = false) {
        var wapper = $('.remove-attr-name:checked').closest('.wrapper-category').attr('class');
        if (!!wapper) wapper = $.trim(wapper.replace('wrapper-category', ''));
        if (!!wapper) wapper = $.trim(wapper.replace(' ', '-'));
        var input = 'input-style';
        $('.errordiv').not('.not-remove').remove();
        var setup = function (input, wapper) {
            $('.' + input).each(function (i) {
                var id = wapper + '-errDiv-' + i;
                $(this).attr('id', id);
                /*var old_val = $(this).val();
inp                var old_html = $(this).parent().html();
                old_html += '<div class="errordiv ' + id + '">Not Empty!</div>';
             */
                //$(this).val(old_val);
                //$(this).closest('td').html(old_html);
                $(this).parent().append('<div class="errordiv ' + id + '">Not Empty!</div>');
            })
        }
        if (fisrt_load) {
            $('.wrapper-category').each(function () {
                var _this = $(this);
                var wapper = _this.attr('class') || "";
                if (!!wapper) wapper = $.trim(wapper.replace('wrapper-category', ''));
                setup(input, wapper);
            })
            return false;
        }
        setup(input, wapper);
    }

    function gernator_delete_col(fisrt = false) {
        var link = '<a href="javascript:;" class="remove-cols-child"> <i class="glyph-icon icon-remove"></i> </a>';
        if (fisrt) {
            _wrapper.each(function () {
                var _this = $(this);
                var html = '';
                _this.find('.table-sales thead:first tr:last').find('th').each(function (i) {
                    if (i > 0) {
                        if (i % 4 == 0) {
                            if (i != 2) html += '<td class="center">' + link + '</td>';
                            else html += '<td class="td-measure"><span></span></td>';
                        } else {
                            html += '<td class="td-measure"><span></span></td>';
                        }
                    } else {
                        html += aAddCol;
                    }
                })
                _this.find('.table-distributors thead:first tr:last').before('<tr class="action">' + html);
            })
        } else {
            var wrapper = $(check_cate + ':checked').closest('.wrapper-category');
            if (wrapper.find('.table-distributors.table-price thead:first tr:last th').length > 1) {
                var html = '';
                wrapper.find('.table-sales thead:first tr:last').find('th').each(function (i) {
                    if (i != 0) {
                        html += '<td class="center">' + link + '</td>';
                    } else {
                        html += aAddCol;
                    }
                })

                //wrapper.find('.table-distributors thead:first tr:last').before('<tr>' + html);
                wrapper.find('.table-distributors thead:first tr.action').append('<td class="th-style td-cost"><a href="javascript:;" class="remove-cols-child"> <i class="glyph-icon icon-remove"></i> </a></td><td class="th-style td-sold center"></td><td class="th-style td-measure"><span></span></td>');
            }
        }
    }

    function countstt() {
        $('.wrapper-category').each(function () {
            var _this = $(this);
            var sales = '.prices-for-sales';
            var price = ' .table-price';
            var deital = ' .table-details';
            var distributors = '.prices-for-distributors';
            var growup = function ($class, _this) {
                _this.find($class + ' tbody tr').each(function (i) {
                    $(this).attr('class', '');
                    $(this).addClass('highlightNoClick ').addClass('row-' + i).attr('data-row', i);
                })
            }
            growup(distributors + deital, _this);
            growup(distributors + price, _this);
            growup(sales + deital, _this);
            growup(sales + price, _this);
        })
    }

    function enterNumber($class) {

    }

    function table_price_delegate() {
        $('.table-price').delegate('.remove-cols-child', 'click', function () {
            var _this = $(this).closest('.wrapper-category');
            var __this = $(this).closest('td');
            var index = __this.index();
            var name = _this.find('.table-distributors thead tr th:eq(' + index + ') :input').val();
            $.alerts.confirm('Will you delete this <strong>Column: ' + name + '</strong> ?<br/>', 'Confirm delete', function (r) {
                if (r == true) {
                    _this.find('.table-distributors tr').each(function () {
                        this.removeChild(this.cells[index]);
                        this.removeChild(this.cells[index]);
                        this.removeChild(this.cells[index]);
                        this.removeChild(this.cells[index]);
                    });
                    _this.find('.table-sales tr').each(function () {
                        this.removeChild(this.cells[index]);
                        this.removeChild(this.cells[index]);
                        this.removeChild(this.cells[index]);
                        this.removeChild(this.cells[index]);
                    });
                }
            });
        });
    }

    function enterOnlyNumber() {
        enterNumber('.input-style.input-distributor');
        enterNumber('.input-style.input-price');
        enterNumber('.input-style.input-moq');
    }

    function addClassRequest() {
        //$('.input-mfr.distributor-details').addClass('input-style');
        $('.input-part.distributor-details').addClass('input-style');
        $('.input-moq.distributor-details').addClass('input-style');
        //$('.input-mfr.sales-details').addClass('input-style');
        $('.input-part.sales-details').addClass('input-style');
        $('.input-moq.sales-details').addClass('input-style');
        $('.input-spq').addClass('input-style');
        addDivErr();
        $('.input-distributor').on("keypress keyup blur", setup_number);
        $('.input-price').on("keypress keyup blur", setup_number);
        $('.input-moq').on("keypress keyup blur", setup_number_dot);
        $('.input-spq').on("keypress keyup blur", setup_number_dot);

        $('.input-margin').on("keypress keyup blur", function () {
            $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                //showNoti('Only enter a number', 'Price List', 'Err');
                event.preventDefault();
            }
        });
        setup_stt();
    }

    function updatePriceList(name, price_id, _this, stt) {
        //var err = false;
        var getValue = function ($class, title = false) {
            var $value = [];
            _this.find($class).closest('tr').each(function (tr) {
                var _this = $(this);
                _this.find(title ? 'th' : 'td').each(function (td) {
                    var value = $(this).find(':input').val() || $(this).find('span').text();
                    //if(value == '' && $class == '.input-style.input-price'){
                    //showNoti('Enter a value price', 'Price List', 'Err');
                    //$(this).find(':input').focus();
                    //err = true;
                    //return false;
                    //}else{
                    $value.push({'c': tr, 'r': td, 'v': value});
                    //}
                })

                if (title) return false;
            })

            return $value;
        }

        $.ajax({
            url: site_url + 'pricelist/ajax_update_price_list',
            method: 'post',
            data: {
                price_id: price_id, id: $('#id').val(), name: name, SortOrder: stt, data: JSON.stringify({
                    distributor_details: getValue('.distributor-details'),
                    distributor_price: getValue('.input-value.input-distributor'),
                    sales_details: getValue('.sales-details'),
                    distributor_title: getValue('.input-thead.input-th.input-distributor', true),
                    sales_title: getValue('.input-thead.input-price', true),
                    sales_price: getValue('.input-value.input-price'),
                })
            }
        })
    }

    var setup_number_dot = function () {

    }
    var setup_number = function () {
        //todo remove by new function
        /* $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
         if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
             //showNoti('Only enter a number', 'Price List', 'Err');
             event.preventDefault();
         }*/
    }

    var setup_stt = function () {
        $('.divStt').remove();
        var stt = function (stt) {
            $(this).find('.td-part').before('<td width="2%" class="center divStt">' + (++stt) + '</td>');
        }
        $('.wrapper-category').each(function () {
            $(this).find('.prices-for-distributors .table-details tbody.tb-details tr').each(stt);
            $(this).find('.prices-for-sales .table-details tbody.tb-details tr').each(stt);
        });
    }

    var setup_per = function () {
        $('.input-per').keypress(function (event) {
            if (event.which == 8 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46)
                return true;

            else if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57))
                event.preventDefault();

        });
        $('.input-per').each(function () {
            input_per($(this), $(this).val());
        });
    }

    var filter = function () {
        var filter = $('#panel-filter');
        var part = $.trim(filter.find('.part').val());
        var mfr = $.trim(filter.find('.mfr').val());
        var manufacturer = $.trim(filter.find('.manufacturer').val());
        var leadtime = $.trim(filter.find('.leadtime').val());
        var desc = $.trim(filter.find('.desc').val());
        var SPQ = $.trim(filter.find('.SPQ').val());
        var MOQ = $.trim(filter.find('.MOQ').val());

        $('.wrapper-category').each(function () {
            var _this = $(this);
            _this.find('.table-details tbody tr').each(function (row) {
                var tr_detail = $(this);
                var tr_price = _this.find('.table-price tbody tr').eq(row);
                tr_detail.find('td').each(function (col) {
                    var input = $(this).find(':input').val();
                    var remove = function (pos, finput) {
                        if (col == pos && finput != '' && !input.match(new RegExp(finput))) {
                            tr_detail.addClass('tr-hidden');
                            tr_price.addClass('tr-hidden');
                        }
                    }
                    remove(1, part);
                    remove(2, mfr);
                    remove(3, desc);
                    remove(4, manufacturer);
                    remove(5, SPQ);
                    remove(6, MOQ);
                    remove(7, leadtime);
                })
            })
        })
    }

    var auto_price = function () {
        $('.wrapper-category').each(function () {
            var _this = $(this);
            _this.find('.table-sales :input').each(function () {
                var _this = $(this);
                var per = 0;
                if (_this.hasClass('input-per')) per = _this.val();
                if (_this.hasClass('input-price')) _this.val(per * 1);

            })
        })
    }

    var input_per = function (s, old_val = false) {
        var err = function () {
            showNoti('The input value is not valid', 'Err', 'Err');
            if (old_val) _this.val(old_val);
        }
        var _this = null;
        if (old_val) _this = s;
        else _this = $(s);
        var wapper = _this.closest('.wrapper-category');
        var nth = _this.closest('th').index();
        var per = _this.val();
        if (!!per) per = parseFloat($.trim(per.replace('%', '')));
        else {
            err();
            return false;
        }
        if (per < 0) {
            err();
            return false;
        }
        _this.val(per + '%');
        var table_sales = wapper.find('.table-sales .tb-sales tr');
        var table_distributors = wapper.find('.table-distributors .tb-distributors');
        jQuery.each(table_sales, function (i) {
            var _this = $(this);
            var price = table_distributors.find('tr:eq(' + i + ') td:eq(' + nth + ') :input').val();
            var new_price = (price * per) / 100;
            _this.find('td:eq(' + nth + ') :input').val(new_price);
        })
    }

    var per_price = function () {
        $('.wrapper-category').each(function () {
            var _this = $(this);
            var input = '<input autocomplete="off" type="text" value="100" size="6" class="input-th input-per">';
            var html = '';
            _this.find('.table-sales thead:first tr:first').find('th').each(function (i) {
                html += '<th class="td-per">' + input + '</th>';
            })
            _this.find('.table-sales thead:first tr:first').before('<tr class="tr-per ">' + html);
        })
    }

    var addTitleWeight = function () {
        $('.tag-weight').each(function () {
            var Val = $(this).text();
            Val = Val.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
            $(this).attr('title', Val);
        })

        $('.label-weight span').each(function () {
            var Val = $(this).text();
            Val = Val.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
            $(this).attr('title', Val);
        })
    }

    function getElementSelection(that) {
        var position = {};
        if (that.selectionStart === undefined) {
            that.focus();
            var select = document.selection.createRange();
            position.length = select.text.length;
            select.moveStart('character', -that.value.length);
            position.end = select.text.length;
            position.start = position.end - position.length;
        } else {
            position.start = that.selectionStart;
            position.end = that.selectionEnd;
            position.length = position.end - position.start;
        }
        return position;
    }

    function setElementSelection(that, start, end) {
        if (that.selectionStart === undefined) {
            that.focus();
            var r = that.createTextRange();
            r.collapse(true);
            r.moveEnd('character', end);
            r.moveStart('character', start);
            r.select();
        } else {
            that.selectionStart = start;
            that.selectionEnd = end;
        }
    }

    function runCallbacks($this, settings) {
        $.each(settings, function (k, val) {
            if (typeof val === 'function') {
                settings[k] = val($this, settings, k);
            } else if (typeof $this.autoNumeric[val] === 'function') {
                settings[k] = $this.autoNumeric[val]($this, settings, k);
            }
        });
    }

    function convertKeyToNumber(settings, key) {
        if (typeof (settings[key]) === 'string') {
            settings[key] *= 1;
        }
    }

    function autoCode($this, settings) {
        runCallbacks($this, settings);
        settings.oEvent = null;
        settings.tagList = ['B', 'CAPTION', 'CITE', 'CODE', 'DD', 'DEL', 'DIV', 'DFN', 'DT', 'EM', 'H1', 'H2', 'H3', 'H4', 'H5', 'H6', 'INS', 'KDB', 'LABEL', 'LI', 'OUTPUT', 'P', 'Q', 'S', 'SAMPLE', 'SPAN', 'STRONG', 'TD', 'TH', 'U', 'VAR'];
        var vmax = settings.vMax.toString().split('.'),
            vmin = (!settings.vMin && settings.vMin !== 0) ? [] : settings.vMin.toString().split('.');
        convertKeyToNumber(settings, 'vMax');
        convertKeyToNumber(settings, 'vMin');
        convertKeyToNumber(settings, 'mDec');
        settings.allowLeading = true;
        settings.aNeg = settings.vMin < 0 ? '-' : '';
        vmax[0] = vmax[0].replace('-', '');
        vmin[0] = vmin[0].replace('-', '');
        settings.mInt = Math.max(vmax[0].length, vmin[0].length, 1);
        if (settings.mDec === null) {
            var vmaxLength = 0,
                vminLength = 0;
            if (vmax[1]) {
                vmaxLength = vmax[1].length;
            }
            if (vmin[1]) {
                vminLength = vmin[1].length;
            }
            settings.mDec = Math.max(vmaxLength, vminLength);
        }
        if (settings.altDec === null && settings.mDec > 0) {
            if (settings.aDec === '.' && settings.aSep !== ',') {
                settings.altDec = ',';
            } else if (settings.aDec === ',' && settings.aSep !== '.') {
                settings.altDec = '.';
            }
        }
        var aNegReg = settings.aNeg ? '([-\\' + settings.aNeg + ']?)' : '(-?)';
        settings.aNegRegAutoStrip = aNegReg;
        settings.skipFirstAutoStrip = new RegExp(aNegReg + '[^-' + (settings.aNeg ? '\\' + settings.aNeg : '') + '\\' + settings.aDec + '\\d]' + '.*?(\\d|\\' + settings.aDec + '\\d)');
        settings.skipLastAutoStrip = new RegExp('(\\d\\' + settings.aDec + '?)[^\\' + settings.aDec + '\\d]\\D*$');
        var allowed = '-' + settings.aNum + '\\' + settings.aDec;
        settings.allowedAutoStrip = new RegExp('[^' + allowed + ']', 'gi');
        settings.numRegAutoStrip = new RegExp(aNegReg + '(?:\\' + settings.aDec + '?(\\d+\\' + settings.aDec + '\\d+)|(\\d*(?:\\' + settings.aDec + '\\d*)?))');
        return settings;
    }

    function autoStrip(s, settings, strip_zero) {
        if (settings.aSign) { /** remove currency sign */
            while (s.indexOf(settings.aSign) > -1) {
                s = s.replace(settings.aSign, '');
            }
        }
        s = s.replace(settings.skipFirstAutoStrip, '$1$2');
        s = s.replace(settings.skipLastAutoStrip, '$1');
        s = s.replace(settings.allowedAutoStrip, '');
        if (settings.altDec) {
            s = s.replace(settings.altDec, settings.aDec);
        }
        var m = s.match(settings.numRegAutoStrip);
        s = m ? [m[1], m[2], m[3]].join('') : '';
        if ((settings.lZero === 'allow' || settings.lZero === 'keep') && strip_zero !== 'strip') {
            var parts = [],
                nSign = '';
            parts = s.split(settings.aDec);
            if (parts[0].indexOf('-') !== -1) {
                nSign = '-';
                parts[0] = parts[0].replace('-', '');
            }
            if (parts[0].length > settings.mInt && parts[0].charAt(0) === '0') {
                /** strip leading zero if need */
                parts[0] = parts[0].slice(1);
            }
            s = nSign + parts.join(settings.aDec);
        }
        if ((strip_zero && settings.lZero === 'deny') || (strip_zero && settings.lZero === 'allow' && settings.allowLeading === false)) {
            var strip_reg = '^' + settings.aNegRegAutoStrip + '0*(\\d' + (strip_zero === 'leading' ? ')' : '|$)');
            strip_reg = new RegExp(strip_reg);
            s = s.replace(strip_reg, '$1$2');
        }
        return s;
    }

    function negativeBracket(s, nBracket, oEvent) {
        nBracket = nBracket.split(',');
        if (oEvent === 'set' || oEvent === 'focusout') {
            s = s.replace('-', '');
            s = nBracket[0] + s + nBracket[1];
        } else if ((oEvent === 'get' || oEvent === 'focusin' || oEvent === 'pageLoad') && s.charAt(0) === nBracket[0]) {
            s = s.replace(nBracket[0], '-');
            s = s.replace(nBracket[1], '');
        }
        return s;
    }

    function truncateDecimal(s, aDec, mDec) {
        if (aDec && mDec) {
            var parts = s.split(aDec);

            if (parts[1] && parts[1].length > mDec) {
                if (mDec > 0) {
                    parts[1] = parts[1].substring(0, mDec);
                    s = parts.join(aDec);
                } else {
                    s = parts[0];
                }
            }
        }
        return s;
    }

    function fixNumber(s, aDec, aNeg) {
        if (aDec && aDec !== '.') {
            s = s.replace(aDec, '.');
        }
        if (aNeg && aNeg !== '-') {
            s = s.replace(aNeg, '-');
        }
        if (!s.match(/\d/)) {
            s += '0';
        }
        return s;
    }

    function checkValue(value, settings) {
        var decimal = value.indexOf('.'),
            checkSmall = +value;
        if (decimal !== -1) {
            if (checkSmall < 0.000001 && checkSmall > -1) {
                value = +value;
                if (value < 0.000001 && value > 0) {
                    value = (value + 10).toString();
                    value = value.substring(1);
                }
                if (value < 0 && value > -1) {
                    value = (value - 10).toString();
                    value = '-' + value.substring(2);
                }
                value = value.toString();
            } else {
                var parts = value.split('.');
                if (parts[1] !== undefined) {
                    if (+parts[1] === 0) {
                        value = parts[0];
                    } else {
                        parts[1] = parts[1].replace(/0*$/, '');
                        value = parts.join('.');
                    }
                }
            }
        }
        return (settings.lZero === 'keep') ? value : value.replace(/^0*(\d)/, '$1');
    }

    function presentNumber(s, aDec, aNeg) {
        if (aNeg && aNeg !== '-') {
            s = s.replace('-', aNeg);
        }
        if (aDec && aDec !== '.') {
            s = s.replace('.', aDec);
        }
        return s;
    }

    function autoCheck(s, settings) {
        s = autoStrip(s, settings);
        s = truncateDecimal(s, settings.aDec, settings.mDec);
        s = fixNumber(s, settings.aDec, settings.aNeg);
        var value = +s;
        if (settings.oEvent === 'set' && (value < settings.vMin || value > settings.vMax)) {
            //$.error("The value (" + value + ") from the 'set' method falls outside of the vMin / vMax range");
        }
        return value >= settings.vMin && value <= settings.vMax;
    }

    function checkEmpty(iv, settings, signOnEmpty) {
        if (iv === '' || iv === settings.aNeg) {
            if (settings.wEmpty === 'zero') {
                return iv + '0';
            }
            if (settings.wEmpty === 'sign' || signOnEmpty) {
                return iv + settings.aSign;
            }
            return iv;
        }
        return null;
    }

    function autoGroup(iv, settings) {
        iv = autoStrip(iv, settings);
        var testNeg = iv.replace(',', '.'),
            empty = checkEmpty(iv, settings, true);
        if (empty !== null) {
            return empty;
        }
        var digitalGroup = '';
        if (settings.dGroup === 2) {
            digitalGroup = /(\d)((\d)(\d{2}?)+)$/;
        } else if (settings.dGroup === 4) {
            digitalGroup = /(\d)((\d{4}?)+)$/;
        } else {
            digitalGroup = /(\d)((\d{3}?)+)$/;
        }
        var ivSplit = iv.split(settings.aDec);
        if (settings.altDec && ivSplit.length === 1) {
            ivSplit = iv.split(settings.altDec);
        }
        var s = ivSplit[0];
        if (settings.aSep) {
            while (digitalGroup.test(s)) {
                s = s.replace(digitalGroup, '$1' + settings.aSep + '$2');
            }
        }
        if (settings.mDec !== 0 && ivSplit.length > 1) {
            if (ivSplit[1].length > settings.mDec) {
                ivSplit[1] = ivSplit[1].substring(0, settings.mDec);
            }
            iv = s + settings.aDec + ivSplit[1];
        } else {
            iv = s;
        }
        if (settings.aSign) {
            var has_aNeg = iv.indexOf(settings.aNeg) !== -1;
            iv = iv.replace(settings.aNeg, '');
            iv = settings.pSign === 'p' ? settings.aSign + iv : iv + settings.aSign;
            if (has_aNeg) {
                iv = settings.aNeg + iv;
            }
        }
        if (settings.oEvent === 'set' && testNeg < 0 && settings.nBracket !== null) {
            iv = negativeBracket(iv, settings.nBracket, settings.oEvent);
        }
        return iv;
    }

    function autoRound(iv, settings) {
        iv = (iv === '') ? '0' : iv.toString();
        convertKeyToNumber(settings, 'mDec');
        var ivRounded = '',
            i = 0,
            nSign = '',
            rDec = (typeof (settings.aPad) === 'boolean' || settings.aPad === null) ? (settings.aPad ? settings.mDec : 0) : +settings.aPad;
        var truncateZeros = function (ivRounded) {
            var regex = rDec === 0 ? (/(\.[1-9]*)0*$/) : rDec === 1 ? (/(\.\d[1-9]*)0*$/) : new RegExp('(\\.\\d{' + rDec + '}[1-9]*)0*$');
            ivRounded = ivRounded.replace(regex, '$1');
            if (rDec === 0) {
                ivRounded = ivRounded.replace(/\.$/, '');
            }
            return ivRounded;
        };
        if (iv.charAt(0) === '-') {
            nSign = '-';
            iv = iv.replace('-', '');
        }
        if (!iv.match(/^\d/)) {
            iv = '0' + iv;
        }
        if (nSign === '-' && +iv === 0) {
            nSign = '';
        }
        if ((+iv > 0 && settings.lZero !== 'keep') || (iv.length > 0 && settings.lZero === 'allow')) {
            /** trims leading zero's if needed */
            iv = iv.replace(/^0*(\d)/, '$1');
        }
        var dPos = iv.lastIndexOf('.'),
            vdPos = dPos === -1 ? iv.length - 1 : dPos,
            cDec = (iv.length - 1) - vdPos;
        if (cDec <= settings.mDec) {
            ivRounded = iv;
            if (cDec < rDec) {
                if (dPos === -1) {
                    ivRounded += '.';
                }
                while (cDec < rDec) {
                    var zeros = '000000'.substring(0, rDec - cDec);
                    ivRounded += zeros;
                    cDec += zeros.length;
                }
            } else if (cDec > rDec) {
                ivRounded = truncateZeros(ivRounded);
            } else if (cDec === 0 && rDec === 0) {
                ivRounded = ivRounded.replace(/\.$/, '');
            }
            return nSign + ivRounded;
        }
        var rLength = dPos + settings.mDec,
            tRound = +iv.charAt(rLength + 1),
            ivArray = iv.substring(0, rLength + 1).split(''),
            odd = (iv.charAt(rLength) === '.') ? (iv.charAt(rLength - 1) % 2) : (iv.charAt(rLength) % 2);
        if ((tRound > 4 && settings.mRound === 'S') || (tRound > 4 && settings.mRound === 'A' && nSign === '') || (tRound > 5 && settings.mRound === 'A' && nSign === '-') || (tRound > 5 && settings.mRound === 's') || (tRound > 5 && settings.mRound === 'a' && nSign === '') || (tRound > 4 && settings.mRound === 'a' && nSign === '-') || (tRound > 5 && settings.mRound === 'B') || (tRound === 5 && settings.mRound === 'B' && odd === 1) || (tRound > 0 && settings.mRound === 'C' && nSign === '') || (tRound > 0 && settings.mRound === 'F' && nSign === '-') || (tRound > 0 && settings.mRound === 'U')) {
            for (i = (ivArray.length - 1); i >= 0; i -= 1) {
                if (ivArray[i] !== '.') {
                    ivArray[i] = +ivArray[i] + 1;
                    if (ivArray[i] < 10) {
                        break;
                    }
                    if (i > 0) {
                        ivArray[i] = '0';
                    }
                }
            }
        }
        ivArray = ivArray.slice(0, rLength + 1);
        ivRounded = truncateZeros(ivArray.join(''));
        return (+ivRounded === 0) ? ivRounded : nSign + ivRounded;
    }

    function AutoNumericHolder(that, settings) {
        this.settings = settings;
        this.that = that;
        this.$that = $(that);
        this.formatted = false;
        this.settingsClone = autoCode(this.$that, this.settings);
        this.value = that.value;
    }

    AutoNumericHolder.prototype = {
        init: function (e) {
            this.value = this.that.value;
            this.settingsClone = autoCode(this.$that, this.settings);
            this.ctrlKey = e.ctrlKey;
            this.cmdKey = e.metaKey;
            this.shiftKey = e.shiftKey;
            this.selection = getElementSelection(this.that);
            if (e.type === 'keydown' || e.type === 'keyup') {
                this.kdCode = e.keyCode;
            }
            this.which = e.which;
            this.processed = false;
            this.formatted = false;
        },
        setSelection: function (start, end, setReal) {
            start = Math.max(start, 0);
            end = Math.min(end, this.that.value.length);
            this.selection = {
                start: start,
                end: end,
                length: end - start
            };
            if (setReal === undefined || setReal) {
                setElementSelection(this.that, start, end);
            }
        },
        setPosition: function (pos, setReal) {
            this.setSelection(pos, pos, setReal);
        },
        getBeforeAfter: function () {
            var value = this.value,
                left = value.substring(0, this.selection.start),
                right = value.substring(this.selection.end, value.length);
            return [left, right];
        },
        getBeforeAfterStriped: function () {
            var parts = this.getBeforeAfter();
            parts[0] = autoStrip(parts[0], this.settingsClone);
            parts[1] = autoStrip(parts[1], this.settingsClone);
            return parts;
        },

        normalizeParts: function (left, right) {
            var settingsClone = this.settingsClone;
            right = autoStrip(right, settingsClone);

            var strip = right.match(/^\d/) ? true : 'leading';
            left = autoStrip(left, settingsClone, strip);
            if ((left === '' || left === settingsClone.aNeg) && settingsClone.lZero === 'deny') {
                if (right > '') {
                    right = right.replace(/^0*(\d)/, '$1');
                }
            }
            var new_value = left + right;
            if (settingsClone.aDec) {
                var m = new_value.match(new RegExp('^' + settingsClone.aNegRegAutoStrip + '\\' + settingsClone.aDec));
                if (m) {
                    left = left.replace(m[1], m[1] + '0');
                    new_value = left + right;
                }
            }
            if (settingsClone.wEmpty === 'zero' && (new_value === settingsClone.aNeg || new_value === '')) {
                left += '0';
            }
            return [left, right];
        },

        setValueParts: function (left, right) {
            var settingsClone = this.settingsClone,
                parts = this.normalizeParts(left, right),
                new_value = parts.join(''),
                position = parts[0].length;
            if (autoCheck(new_value, settingsClone)) {
                new_value = truncateDecimal(new_value, settingsClone.aDec, settingsClone.mDec);
                if (position > new_value.length) {
                    position = new_value.length;
                }
                this.value = new_value;
                this.setPosition(position, false);
                return true;
            }
            return false;
        },
        signPosition: function () {
            var settingsClone = this.settingsClone,
                aSign = settingsClone.aSign,
                that = this.that;
            if (aSign) {
                var aSignLen = aSign.length;
                if (settingsClone.pSign === 'p') {
                    var hasNeg = settingsClone.aNeg && that.value && that.value.charAt(0) === settingsClone.aNeg;
                    return hasNeg ? [1, aSignLen + 1] : [0, aSignLen];
                }
                var valueLen = that.value.length;
                return [valueLen - aSignLen, valueLen];
            }
            return [1000, -1];
        },

        expandSelectionOnSign: function (setReal) {
            var sign_position = this.signPosition(),
                selection = this.selection;
            if (selection.start < sign_position[1] && selection.end > sign_position[0]) {
                if ((selection.start < sign_position[0] || selection.end > sign_position[1]) && this.value.substring(Math.max(selection.start, sign_position[0]), Math.min(selection.end, sign_position[1])).match(/^\s*$/)) { /** then select without empty space */
                    if (selection.start < sign_position[0]) {
                        this.setSelection(selection.start, sign_position[0], setReal);
                    } else {
                        this.setSelection(sign_position[1], selection.end, setReal);
                    }
                } else {
                    this.setSelection(Math.min(selection.start, sign_position[0]), Math.max(selection.end, sign_position[1]), setReal);
                }
            }
        },

        checkPaste: function () {
            if (this.valuePartsBeforePaste !== undefined) {
                var parts = this.getBeforeAfter(),
                    oldParts = this.valuePartsBeforePaste;
                delete this.valuePartsBeforePaste;
                parts[0] = parts[0].substr(0, oldParts[0].length) + autoStrip(parts[0].substr(oldParts[0].length), this.settingsClone);
                if (!this.setValueParts(parts[0], parts[1])) {
                    this.value = oldParts.join('');
                    this.setPosition(oldParts[0].length, false);
                }
            }
        },

        skipAllways: function (e) {
            var kdCode = this.kdCode,
                which = this.which,
                ctrlKey = this.ctrlKey,
                cmdKey = this.cmdKey,
                shiftKey = this.shiftKey;
            if (((ctrlKey || cmdKey) && e.type === 'keyup' && this.valuePartsBeforePaste !== undefined) || (shiftKey && kdCode === 45)) {
                this.checkPaste();
                return false;
            }

            if ((kdCode >= 112 && kdCode <= 123) || (kdCode >= 91 && kdCode <= 93) || (kdCode >= 9 && kdCode <= 31) || (kdCode < 8 && (which === 0 || which === kdCode)) || kdCode === 144 || kdCode === 145 || kdCode === 45) {
                return true;
            }
            if ((ctrlKey || cmdKey) && kdCode === 65) {
                return true;
            }
            if ((ctrlKey || cmdKey) && (kdCode === 67 || kdCode === 86 || kdCode === 88)) {
                if (e.type === 'keydown') {
                    this.expandSelectionOnSign();
                }
                if (kdCode === 86 || kdCode === 45) {
                    if (e.type === 'keydown' || e.type === 'keypress') {
                        if (this.valuePartsBeforePaste === undefined) {
                            this.valuePartsBeforePaste = this.getBeforeAfter();
                        }
                    } else {
                        this.checkPaste();
                    }
                }
                return e.type === 'keydown' || e.type === 'keypress' || kdCode === 67;
            }
            if (ctrlKey || cmdKey) {
                return true;
            }
            if (kdCode === 37 || kdCode === 39) {
                var aSep = this.settingsClone.aSep,
                    start = this.selection.start,
                    value = this.that.value;
                if (e.type === 'keydown' && aSep && !this.shiftKey) {
                    if (kdCode === 37 && value.charAt(start - 2) === aSep) {
                        this.setPosition(start - 1);
                    } else if (kdCode === 39 && value.charAt(start + 1) === aSep) {
                        this.setPosition(start + 1);
                    }
                }
                return true;
            }
            if (kdCode >= 34 && kdCode <= 40) {
                return true;
            }
            return false;
        },

        processAllways: function () {
            var parts;
            if (this.kdCode === 8 || this.kdCode === 46) {
                if (!this.selection.length) {
                    parts = this.getBeforeAfterStriped();
                    if (this.kdCode === 8) {
                        parts[0] = parts[0].substring(0, parts[0].length - 1);
                    } else {
                        parts[1] = parts[1].substring(1, parts[1].length);
                    }
                    this.setValueParts(parts[0], parts[1]);
                } else {
                    this.expandSelectionOnSign(false);
                    parts = this.getBeforeAfterStriped();
                    this.setValueParts(parts[0], parts[1]);
                }
                return true;
            }
            return false;
        },

        processKeypress: function () {
            var settingsClone = this.settingsClone,
                cCode = String.fromCharCode(this.which),
                parts = this.getBeforeAfterStriped(),
                left = parts[0],
                right = parts[1];
            if (cCode === settingsClone.aDec || (settingsClone.altDec && cCode === settingsClone.altDec) || ((cCode === '.' || cCode === ',') && this.kdCode === 110)) { /** do not allow decimal character if no decimal part allowed */
                if (!settingsClone.mDec || !settingsClone.aDec) {
                    return true;
                }
                if (settingsClone.aNeg && right.indexOf(settingsClone.aNeg) > -1) {
                    return true;
                }
                if (left.indexOf(settingsClone.aDec) > -1) {
                    return true;
                }
                if (right.indexOf(settingsClone.aDec) > 0) {
                    return true;
                }
                if (right.indexOf(settingsClone.aDec) === 0) {
                    right = right.substr(1);
                }
                this.setValueParts(left + settingsClone.aDec, right);
                return true;
            }

            if (cCode === '-' || cCode === '+') {
                if (!settingsClone.aNeg) {
                    return true;
                }
                if (left === '' && right.indexOf(settingsClone.aNeg) > -1) {
                    left = settingsClone.aNeg;
                    right = right.substring(1, right.length);
                }
                if (left.charAt(0) === settingsClone.aNeg) {
                    left = left.substring(1, left.length);
                } else {
                    left = (cCode === '-') ? settingsClone.aNeg + left : left;
                }
                this.setValueParts(left, right);
                return true;
            }
            if (cCode >= '0' && cCode <= '9') {
                if (settingsClone.aNeg && left === '' && right.indexOf(settingsClone.aNeg) > -1) {
                    left = settingsClone.aNeg;
                    right = right.substring(1, right.length);
                }
                if (settingsClone.vMax <= 0 && settingsClone.vMin < settingsClone.vMax && this.value.indexOf(settingsClone.aNeg) === -1 && cCode !== '0') {
                    left = settingsClone.aNeg + left;
                }
                this.setValueParts(left + cCode, right);
                return true;
            }
            return true;
        },

        formatQuick: function () {
            var settingsClone = this.settingsClone,
                parts = this.getBeforeAfterStriped(),
                leftLength = this.value;
            if ((settingsClone.aSep === '' || (settingsClone.aSep !== '' && leftLength.indexOf(settingsClone.aSep) === -1)) && (settingsClone.aSign === '' || (settingsClone.aSign !== '' && leftLength.indexOf(settingsClone.aSign) === -1))) {
                var subParts = [],
                    nSign = '';
                subParts = leftLength.split(settingsClone.aDec);
                if (subParts[0].indexOf('-') > -1) {
                    nSign = '-';
                    subParts[0] = subParts[0].replace('-', '');
                    parts[0] = parts[0].replace('-', '');
                }
                if (subParts[0].length > settingsClone.mInt && parts[0].charAt(0) === '0') {
                    parts[0] = parts[0].slice(1);
                }
                parts[0] = nSign + parts[0];
            }
            var value = autoGroup(this.value, this.settingsClone),
                position = value.length;
            if (value) {

                var left_ar = parts[0].split(''),
                    i = 0;
                for (i; i < left_ar.length; i += 1) {
                    if (!left_ar[i].match('\\d')) {
                        left_ar[i] = '\\' + left_ar[i];
                    }
                }
                var leftReg = new RegExp('^.*?' + left_ar.join('.*?'));
                var newLeft = value.match(leftReg);
                if (newLeft) {
                    position = newLeft[0].length;
                    if (((position === 0 && value.charAt(0) !== settingsClone.aNeg) || (position === 1 && value.charAt(0) === settingsClone.aNeg)) && settingsClone.aSign && settingsClone.pSign === 'p') {

                        position = this.settingsClone.aSign.length + (value.charAt(0) === '-' ? 1 : 0);
                    }
                } else if (settingsClone.aSign && settingsClone.pSign === 's') {
                    position -= settingsClone.aSign.length;
                }
            }
            this.that.value = value;
            this.setPosition(position);
            this.formatted = true;
        }
    };

    function autoGet(obj) {
        if (typeof obj === 'string') {
            obj = obj.replace(/\[/g, "\\[").replace(/\]/g, "\\]");
            obj = '#' + obj.replace(/(:|\.)/g, '\\$1');
            /** obj = '#' + obj.replace(/([;&,\.\+\*\~':"\!\^#$%@\[\]\(\)=>\|])/g, '\\$1'); */
        }
        return $(obj);
    }

    function getHolder($that, settings, update) {
        var data = $that.data('autoNumeric');
        if (!data) {
            data = {};
            $that.data('autoNumeric', data);
        }
        var holder = data.holder;
        if ((holder === undefined && settings) || update) {
            holder = new AutoNumericHolder($that.get(0), settings);
            data.holder = holder;
        }
        return holder;
    }

    function checkMatchPart($class) {
        var _this = $($class);
        $('.' + $class).each(function () {
            var wp = _this.closest('.wrapper-category');
            var tr = _this.closest('tr');
            var r = tr.data('row');
            var Val = _this.val();
            if (Val != '') {
                var Valdistributors = wp.find('.prices-for-distributors .table-details tbody tr.row-' + r + ' .' + $class).val();
                var Valsales = wp.find('.prices-for-sales .table-details tbody tr.row-' + r + ' .' + $class).val();
                if (!!Valdistributors && !!Valsales && Valdistributors != Valsales) {
                    _this.val('');
                    return false;
                }
            }
        })
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
                    if (!$('.remove-attr-name').is(':checked')) {
                        showNoti('Please checkbox the category', 'Err', 'Err');
                        return;
                    }
                    //todo submit search
                    var checked = $('.remove-attr-name:checked');
                    if (checked.length < 0) {
                        showNoti('Please checkbox the category', 'Err', 'Err');
                        return;
                    }
                    var wapper = checked.closest('.wrapper-category');
                    if (wapper.find('.prices-for-distributors .table-details tbody tr').length == 0) {
                        wapper.find('.row-action').remove();
                        wapper.find('.prices-for-distributors .table-details thead tr').append('<th width="5%" class="row-action"></th>');
                        wapper.find('.prices-for-sales .table-details thead tr').append('<th width="5%" class="row-action"></th>');
                    }
                    addPart(wapper, false);
                    updateInputPart({
                        part: $(this).find('td.part').text(),
                        mfr: $(this).find('td span.mfr-part').text(),
                        desc: $(this).find('td span.desc').text(),
                        manufacturer: $(this).find('td.manufacturer').text(),
                        leadtime: $(this).find('td.leadtime').text()
                    });
                    wapper.find('.prices-for-distributors .table-details tbody tr:last').append('<td><a style="float:right;" href="javascript:;" class="remove-rows-child"> <i class="glyph-icon icon-remove"></i> </a></td>');
                    wapper.find('.prices-for-sales .table-details tbody tr:last').append('<td><a style="float:right;" href="javascript:;" class="remove-rows-child"> <i class="glyph-icon icon-remove"></i> </a></td>');
                    $(this).remove();
                    if ($('#divSearch tbody tr').length == 0) $('#divSearch').hide();
                });
            }
        });
        $('[name="q"]').val('').blur();
        return false;
    });

    var checkMatchLine = function (_this, $class) {
        var wp = _this.closest('.wrapper-category');
        var tr = _this.closest('tr');
        var r = tr.data('row');
        var Val = _this.val();
        if (Val != '') {
            var Valdistributors = wp.find('.prices-for-distributors .table-details tbody tr.row-' + r + ' .' + $class).val();
            var Valsales = wp.find('.prices-for-sales .table-details tbody tr.row-' + r + ' .' + $class).val();
            if (Valdistributors != Valsales) {
                wp.find('.prices-for-distributors .table-details tbody tr.row-' + r + ' .' + $class).val(Val);
                wp.find('.prices-for-sales .table-details tbody tr.row-' + r + ' .' + $class).val(Val);
            }
        }
    }

    //todo body func
    $('body').on('change', '.input-part', function () {
        checkMatchLine($(this), 'input-part');
    }).on('change', '.input-mfr', function () {
        checkMatchLine($(this), 'input-mfr');
    }).on('change', '.input-desc', function () {
        checkMatchLine($(this), 'input-desc');
    }).on('change', '.input-manufacturer', function () {
        checkMatchLine($(this), 'input-manufacturer');
    }).on('change', '.input-spq', function () {
        checkMatchLine($(this), 'input-spq');
    }).on('change', '.input-moq', function () {
        checkMatchLine($(this), 'input-moq');
    }).on('change', '.input-leadtime', function () {
        checkMatchLine($(this), 'input-leadtime');
    }).on('click', '.viewWeight', function () {
        var wp = $(this).closest('.wrapper-category');
        var icon = $(this);
        if (icon.hasClass('eye_open')) icon.removeClass('eye_open').addClass('eye_close viewWeight_close');
        wp.find('tbody tr').removeClass('fetch70');
        wp.find('.label-weight').addClass('hidden');
        //wp.find('.tag-weight').attr('style', 'margin-top: 0px !important;');
    }).on('click', '.viewWeight_close', function () {
        var wp = $(this).closest('.wrapper-category');
        var icon = $(this);
        if (icon.hasClass('eye_close')) icon.addClass('eye_open').removeClass('eye_close viewWeight_close');
        wp.find('tbody tr').addClass('fetch70');
        wp.find('.label-weight').removeClass('hidden');
        //wp.find('.tag-weight').attr('style', 'margin-top: 26px !important;');
    }).on('change', '.input-value.input-buy.input-distributor', function () {
        //todo change buying price
        var _this = $(this);
        var index = _this.closest('td').index();
        var table = _this.closest('table');
        var tr = _this.closest('tr');
        var r = tr.data('row');
        var cost = table.find('tbody tr.row-' + r + ' td:eq(' + (index + 1) + ') :input').val();
        if (!!cost) cost = convert(cost);
        if (!cost) cost = 0;
        var sl = table.find('thead tr.label th:eq(' + (index) + ') :input').val();
        if (!!sl) {
            sl = sl.toString();
            sl = sl.replace(',', '');
            sl = parseFloat(sl);
        } else {
            showNoti('The number of part automatic  set equal 1', 'Price List', 'War');
            sl = 1;
            table.find('thead tr.label th:eq(' + (index) + ') :input').val(sl);
        }
        var buy = _this.val();
        if (!!buy) buy = convert(buy);
        if (!buy) buy = 0;
        var sold = (cost / sl) + buy;
        if (!!sold) {
            sold = parseFloat(sold).toFixed(2);
        }

        console.log('%c cost : ' + cost, 'background: #222; color: #bada55');
        console.log('%c sl : ' + sl, 'background: #222; color: #bada55');
        console.log('%c buy : ' + buy, 'background: #222; color: #bada55');
        console.log('--------------');
        console.log('%c sold : ' + sold, 'background: red; color: white ');
        if (cost == 0) table.find('tbody tr.row-' + r + ' td:eq(' + (index + 1) + ') :input').val(0);
        //table.find('tbody tr.row-' + r + ' td:eq(' + (index + 2) + ') span').html(sold);
        table.find('tbody tr.row-' + r + ' td:eq(' + (index + 2) + ') :input').val(sold.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,'));

        var span_sold = parseFloat(sold * sl).toFixed(2);
        span_sold = span_sold.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');

        table.find('tbody tr.row-' + r + ' td:eq(' + (index + 2) + ') span').html(span_sold);
        table.find('tbody tr.row-' + r + ' td:eq(' + (index) + ') .label-weight').html(rs_weight(sl, buy));

        if (!!sold || sold != 0) {
            var margin = parseFloat(table.find('tbody tr.row-' + r + ' td:eq(' + (index + 3) + ') :input').val());
            if (!margin) {
                margin = 0;
                table.find('tbody tr.row-' + r + ' td:eq(' + (index + 3) + ') :input').val('0.00');
            }
            var new_price = parseFloat(sold / (1 - (margin / 100))).toFixed(2);
            if (!!new_price) {
                var wp = _this.closest('.wrapper-category');
                var span_sold = parseFloat(new_price * sl).toFixed(2);
                span_sold = span_sold.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
                new_price = new_price.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
                wp.find('.table-sales tbody tr.row-' + r + ' td:eq(' + (index) + ') :input').val(new_price);
                wp.find('.table-sales tbody tr.row-' + r + ' td:eq(' + (index) + ') .label-weight span').text(span_sold);
            }
        }


        addTitleWeight();
        //todo input-distributor

        // var wapper = _this.closest('.wrapper-category');
        // var tr = _this.closest('tr');
        // var nth = _this.closest('td').index();
        // ++nth;
        // var Val = parseFloat($.trim(_this.val()));

        /*if (nth > 0) {
            var r = tr.data('row');
            var per = wapper.find('.prices-for-distributors .table-distributors tbody tr.row-' + r + ' td:eq(' + nth + ') :input').val();
            if (!!per) per = parseFloat($.trim(per.replace('%', '')));
            var new_price = (Val * per) / 100;
            wapper.find('.prices-for-sales .table-sales tbody tr.row-' + r + ' td:eq(' + (nth - 1) + ') :input').val(new_price);
        }*/
    }).change().on('change', '.input-value.input-cost.input-distributor', function () {
        //todo change cost
        var _this = $(this);
        var index = _this.closest('td').index();
        var table = _this.closest('table');
        var tr = _this.closest('tr');
        var r = tr.data('row');
        var cost = _this.val();
        if (!!cost) cost = convert(cost);
        if (!cost) cost = 0;
        var buy = table.find('tbody tr.row-' + r + ' td:eq(' + (index - 1) + ') :input').val();
        if (!!buy) buy = convert(buy);
        if (!buy) buy = 0;
        var sl = table.find('thead tr.label th:eq(' + (index - 1) + ') :input').val();
        if (!!sl) {
            sl = sl.toString();
            sl = sl.replace(',', '');
            sl = parseFloat(sl);
        } else {
            showNoti('The number of part automatic  set equal 1', 'Price List', 'War');
            sl = 1;
            table.find('thead tr.label th:eq(' + (index) + ') :input').val(sl);
        }

        var sold = ((cost / sl) + buy);
        if (!!sold) {
            sold = parseFloat(sold).toFixed(2);
        }
        console.log('x--------------x');
        console.log('%c index : ' + index, 'background: #222; color: #bada55');
        console.log('%c cost : ' + cost, 'background: #222; color: #bada55');
        console.log('%c sl : ' + sl, 'background: #222; color: #bada55');
        console.log('%c buy : ' + buy, 'background: #222; color: #bada55');
        console.log('--------------');
        console.log('%c sold : ' + sold, 'background: red; color: white ');
        //table.find('tbody tr.row-' + r + ' td:eq(' + (index + 1) + ') span').html(sold);
        table.find('tbody tr.row-' + r + ' td:eq(' + (index + 1) + ') :input').val(sold.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,'));
        var span_sold = parseFloat(sold * sl).toFixed(2);
        span_sold = span_sold.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
        table.find('tbody tr.row-' + r + ' td:eq(' + (index + 1) + ') span').html(span_sold);
        table.find('tbody tr.row-' + r + ' td:eq(' + (index) + ') .label-weight').html(rs_weight(sl, buy));
        if (buy == 0) table.find('tbody tr.row-' + r + ' td:eq(' + (index - 1) + ') :input').val('0.00');

        if (!!sold || sold != 0) {
            var margin = parseFloat(table.find('tbody tr.row-' + r + ' td:eq(' + (index + 2) + ') :input').val());
            if (!margin) {
                margin = 0;
                table.find('tbody tr.row-' + r + ' td:eq(' + (index + 2) + ') :input').val('0.00');
            }
            var new_price = parseFloat(sold / (1 - (margin / 100))).toFixed(2);
            if (!!new_price) {
                var span_sold = parseFloat(new_price * sl).toFixed(2);
                span_sold = span_sold.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
                new_price = new_price.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
                var wp = _this.closest('.wrapper-category');
                wp.find('.table-sales tbody tr.row-' + r + ' td:eq(' + (index - 1) + ') :input').val(new_price);
                wp.find('.table-sales tbody tr.row-' + r + ' td:eq(' + (index - 1) + ') .label-weight span').text(span_sold);
            }
        }

        addTitleWeight();
    }).change().on('change', '.input-value.input-margin.input-distributor', function () {
        //todo change margin
        var _this = $(this);
        var index = _this.closest('td').index();
        var table = _this.closest('table');
        var tr = _this.closest('tr');
        var r = tr.data('row');
        var margin = parseFloat(_this.val());
        if (margin >= 100) {
            showNoti('Can\'t set this margin equal or than 100 %', 'Price List', 'Err');
            _this.val('');
            return;
        }
        if (!margin) margin = 0;
        //var sold = parseFloat(table.find('tbody tr.row-' + r + ' td:eq(' + (index - 1) + ') span').text());
        var sold = table.find('tbody tr.row-' + r + ' td:eq(' + (index - 1) + ') :input').val();
        if (!!sold) sold = convert(sold);
        var sl = table.find('thead tr.label th:eq(' + (index - 3) + ') :input').val();
        if (!!sl) {
            sl = sl.toString();
            sl = sl.replace(',', '');
            sl = parseFloat(sl);
        } else sl = 0;

        var buy = table.find('tbody tr.row-' + r + ' td:eq(' + (index - 3) + ') :input').val();
        var cost = table.find('tbody tr.row-' + r + ' td:eq(' + (index - 2) + ') :input').val();
        if (!!buy) buy = convert(buy);
        if (!!cost) cost = convert(cost);
        if (cost == 0 || !cost) {
            table.find('tbody tr.row-' + r + ' td:eq(' + (index - 2) + ') :input').val('0.00');
        }
        if (buy == 0 || !buy) {
            table.find('tbody tr.row-' + r + ' td:eq(' + (index - 3) + ') :input').val('0.00');
        }
        if (!sold || sold == 0) {
            sold = 0;
            table.find('tbody tr.row-' + r + ' td:eq(' + (index - 1) + ') :input').val('0.00');
        }
        // if (!!sold && !!margin) {
        //todo change price
        var new_price = parseFloat(sold / (1 - (margin / 100))).toFixed(2);
        if (!!new_price) {
            var wp = _this.closest('.wrapper-category');
            var span_sold = parseFloat(new_price * sl).toFixed(2);
            span_sold = span_sold.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
            new_price = new_price.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
            wp.find('.table-sales tbody tr.row-' + r + ' td:eq(' + (index - 3) + ') :input').val(new_price);
            wp.find('.table-sales tbody tr.row-' + r + ' td:eq(' + (index - 3) + ') .label-weight span').text(span_sold);
        }
        //}
        if (!!margin) table.find('tbody tr.row-' + r + ' td:eq(' + (index) + ') .label-weight').html(rs_weight(sl, margin));
        console.log('%c sl : ' + sl, 'background: #222; color: #bada55');
        console.log('%c margin : ' + margin, 'background: #222; color: #bada55');
        console.log('--------------');
        console.log('%c new_price : ' + new_price, 'background: red; color: white ');
        addTitleWeight();
    }).change().on('change', '.input-value.input-price', function () {
        //todo change price (sell)
        var _this = $(this);
        var index = _this.closest('td').index();
        var table = _this.closest('table');
        var tr = _this.closest('tr');
        var wp = _this.closest('.wrapper-category');
        var r = tr.data('row');
        var price = _this.val();
        if (!!price) price = convert(price);
        var sl = table.find('thead tr.label th:eq(' + (index) + ') :input').val();
        if (!!sl) {
            sl = sl.toString();
            sl = sl.replace(',', '');
            sl = parseFloat(sl);
        } else sl = 0;
        table.find('tbody tr.row-' + r + ' td:eq(' + (index) + ') .label-weight').html(rs_weight(sl, price));
        console.log('%c sl : ' + sl, 'background: #222; color: #bada55');
        console.log('%c price : ' + price, 'background: #222; color: #bada55');
        console.log('--------------');
        addTitleWeight();
        //Cal margin

        var cogs = wp.find('.prices-for-distributors .table-distributors tr.row-' + r + ' td:eq(' + (index + 2) + ') :input').val();
        if (!!cogs) cogs = convert(cogs);

        var margin = 0;
        if (price != 0 && cogs != 0) {
            //margin = parseFloat(100 - ((100 * cogs) / price)).toFixed(2);
            margin = (100 - ((100 * cogs) / price));
            if(!Number.isInteger(margin)) margin = parseFloat(margin).toFixed(2);
        }else wp.find('.prices-for-distributors .table-distributors tr.row-' + r + ' td:eq(' + (index + 3) + ') :input').val('');

        if (margin > 0) wp.find('.prices-for-distributors .table-distributors tr.row-' + r + ' td:eq(' + (index + 3) + ') :input').val(margin);
        else wp.find('.prices-for-distributors .table-distributors tr.row-' + r + ' td:eq(' + (index + 3) + ') :input').val('');

        console.log('x--------------x');
        console.log('%c margin : ' + margin, 'background: #222; color: #bada55');
        console.log('%c cogs : ' + cogs, 'background: #222; color: #bada55');
        console.log('--------------');
    }).change().on('change', '.input-style.input-price', function () {
        //todo .input-style.input-price
        var _this = $(this);
        var wapper = _this.closest('.wrapper-category');
        var nth = _this.closest('td').index();
        var next_nth = nth + 1;
        var r = _this.closest('tr').data('row');
        var price = _this.val();
        if (!!price) price = convert(price);
        else return false;
        if (price < 0) return false;
        var price_dist = wapper.find('.table-distributors .tb-distributors tr.row-' + r + ' td:eq(' + nth + ') :input').val();
        if (!!price_dist) price_dist = convert(price_dist);
        var new_per = (100 * price) / price_dist;
        wapper.find('.table-distributors .tb-distributors tr.row-' + r + ' td:eq(' + next_nth + ') .input-measure').val(new_per.toFixed(2));
    }).change().on('change', '.input-th.input-measure', function () {
        var _this = $(this);
        var wapper = _this.closest('.wrapper-category');
        var nth = _this.closest('td').index();
        var pre_nth = nth - 1;
        var r = _this.closest('tr').data('row');
        var per = _this.val();

        if (!!per) per = parseFloat($.trim(per.replace('%', '')));
        else return false;
        if (per < 0) return false;
        _this.val(per + '%');
        var price_dist = wapper.find('.table-distributors .tb-distributors tr.row-' + r + ' td:eq(' + pre_nth + ') :input').val();
        var new_price = (price_dist * per) / 100;
        new_price = new_price.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
        wapper.find('.table-sales .tb-sales tr.row-' + r + ' td:eq(' + pre_nth + ') :input').val(new_price);
        addTitleWeight();
    }).change().on('change', '.input-per', function () {
        input_per($(this), $(this).val());
        addTitleWeight();
    }).change().on('click', '#submitFilter', function () {
        //overwrite, dont delete this func
    }).on('change', '.table-price thead tr th :input', function () {
        //todo change header
        if ($(this).hasClass('input-per')) return false;
        var __this = $(this).closest('th');
        var index = __this.index();
        var wp = __this.closest('.wrapper-category');
        wp.find(check_cate).prop("checked", true);
        wp.find('.table-distributors thead tr:last th:eq(' + index + ')').find(':input').val($(this).val());
        wp.find('.table-sales thead tr:last th:eq(' + index + ')').find(':input').val($(this).val());
        var _this = $(this);
        var table = _this.closest('.table-distributors');
        var tr = table.find('tbody tr');
        var r = tr.data('row');
        var sl = _this.val();
        if(sl== 0){
            showNoti('Can\'t set number zero', 'Price List', 'Err');
            wp.find('.table-distributors thead tr:last th:eq(' + index + ')').find(':input').val('');
            wp.find('.table-sales thead tr:last th:eq(' + index + ')').find(':input').val('');
            return;
        }
        if (!sl) {
            showNoti('Enter the number ', 'Price List', 'Err');
            _this.val('');
            return;
        } else {
            sl = sl.toString();
            sl = sl.replace(',', '');
            sl = parseFloat(sl);
        }
        // each
        // for (var i = 0; i < 4; i++) {
        wp.find('.table-distributors tbody tr').each(function () {
            var _this = $(this);
            var r = _this.data('row');
            var buy = wp.find('.table-distributors tbody tr.row-' + r + ' td:eq(' + (index + 0) + ') :input').val();
            var cost = wp.find('.table-distributors tbody tr.row-' + r + ' td:eq(' + (index + 1) + ') :input').val();
            var margin = parseFloat(wp.find('.table-distributors tbody tr.row-' + r + ' td:eq(' + (index + 3) + ') :input').val());

            if (!!buy) buy = convert(buy);
            if (!!cost) cost = convert(cost);
            console.log('%c cost : ' + cost, 'background: #222; color: #bada55');

            if (!margin) {
                margin = 0;
                wp.find('.table-distributors tbody tr.row-' + r + ' td:eq(' + (index + 3) + ') :input').val('0.00');
            }
            if (!cost) {
                cost = 0;
                wp.find('.table-distributors tbody tr.row-' + r + ' td:eq(' + (index + 1) + ') :input').val('0.00');
            }
            if (!buy) {
                buy = 0;
                wp.find('.table-distributors tbody tr.row-' + r + ' td:eq(' + (index + 0) + ') :input').val('0.00');
            }
            var new_cogs = parseFloat((cost / sl) + buy).toFixed(2);
            if (!!new_cogs) {
                wp.find('.table-distributors tbody tr.row-' + r + ' td:eq(' + (index + 2) + ') :input').val(new_cogs);
                var new_price = parseFloat((new_cogs / (1 - margin / 100))).toFixed(2);
                new_price = new_price.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
                if (!!new_price) wp.find('.table-sales tbody tr.row-' + r + ' td:eq(' + (index + 0) + ') :input').val(new_price);
            }
        })

        console.log('%c sl : ' + sl, 'background: #222; color: #bada55');
        console.log('--------------');

        //}
        //
        for (var i = 0; i < 4; i++) {
            wp.find('.table-price tbody tr').each(function () {
                var _this = $(this);
                _this.find('td:eq(' + (index + i) + ')').each(function () {
                    var _this = $(this);
                    var Val = _this.find(':input').val();
                    if (!!Val) Val = convert(Val);
                    if (!!Val) {
                        Val = parseFloat(Val);
                        _this.find('.label-weight').html(rs_weight(sl, Val));
                        _this.find('.tag-weight').html(rs_weight(sl, Val));
                    }
                })
            })
        }
    }).on('click', '.remove-cols-child', function () {
        table_price_delegate();
    }).on('click', '.remove-rows-child', function () {
        var w = $(this).closest('.wrapper-category');
        var t = $(this).closest('tr');
        var r = t.data('row');
        w.find('.row-' + r).each(function () {
            $(this).remove();
        });
        setup_stt();
    }).on('click', '#exportPriceList', function () {
        window.open(site_url + 'pricelist/excel/' + $('#id').val());
        return false;
        var $html = '';

        var itemList = $('#sortable').clone();
        var fullHtml = $('.wrapper-category').clone();
        itemList.find('.wrapper-category').each(function () {
            var _this = $(this);
            _this.find('.table-details .row-action').remove();
            _this.find('.table-details').attr('border', 1);
            _this.find('.table-details .row-action').remove();
            _this.find('.table-details .tb-details tr').each(function () {
                $(this).find('td:last').remove();
            })
            _this.find(":button").remove();
            _this.find(".remove-attr-name").remove();
            _this.find("a").each(function () {
                var _this = $(this);
                var myVal = _this.text();
                _this.closest('.wrapper-category').find('.info-header').html('<h1>' + myVal);
            })
            _this.find('input[type=text]').each(function () {
                var _this = $(this);
                var myVal = _this.val();
                _this.closest('td').html(myVal);
                _this.closest('th').html(myVal);
            });
            _this.find('table th').each(function () {
                var _this = $(this);
                if (_this.find('span').length) {
                    _this.html(_this.text());
                }
            })

        })
        $html = '<link rel="stylesheet" type="text/css" href="assets/css/price-list.css">';
        $html += '<ul>' + itemList.html();
        $.ajax({
            url: site_url + 'pricelist/generateExcel',
            type: 'POST',
            cache: false,
            data: {content: $html},
            success: function (string) {
                if (!!string) {
                    //   window.open(site_url + 'pricelist/downloadFile/?content=' + string);
                }
            }
        });
    }).on('click', '#printPriceList', function () {
        window.open(site_url + 'pricelist/pdf/' + $('#id').val());
    }).on('click', '#removePart', function () {
        var checked = $('.remove-attr-name:checked');
        if (checked.length < 0) {
            showNoti('Please checkbox the category', 'Err', 'Err');
            return;
        }
        var t = checked.closest('.wrapper-category').parent();
        $.alerts.confirm('Will you delete this price list?<br/><strong>' + t.find('.cat-name').text(), 'Confirm delete', function (r) {
            if (r == true) {
                t.remove();
                $.ajax({
                    url: site_url + 'pricelist/ajax_delete_pricelist',
                    method: 'post',
                    data: {id: t.find('.price-id').val()},
                    success: function (data) {
                        if (data) showNoti('Xóa thành công!', 'Price List', 'Ok');
                    },
                    error: function (e) {
                        showNoti('Xóa thất bại!', 'Price List', 'Err');
                    }
                })
            }
        });
    }).on('click', '.remove-rows-tabs', function () {
        var t = $(this).parent().parent().parent();
        $.alerts.confirm('Will you delete this price list?<br/><strong>' + t.find('.cat-name').text(), 'Confirm delete', function (r) {
            if (r == true) {
                t.remove();
                $.ajax({
                    url: site_url + 'pricelist/ajax_delete_pricelist',
                    method: 'post',
                    data: {id: t.find('.price-id').val()},
                    success: function (data) {
                        if (data) showNoti('Xóa thành công!', 'Price List', 'Ok');
                    },
                    error: function (e) {
                        showNoti('Xóa thất bại!', 'Price List', 'Err');
                    }
                })
            }
        });
    }).on('click', '.collapsedz', function () {
        var _this = $(this).closest('.wrapper-category');
        var c = _this.find('.collapse');
        if (c.hasClass('in')) {
            c.removeClass('in');
        } else {
            c.addClass('in');
        }
    }).on('submit', '#frmSearch', function () {
        return false;
    }).on('click', '#submitBtn', function () {
        $('.wrapper-category .table.table-details tr').each(function () {
            $(this).removeClass('tr-hidden');
        })
        $('.wrapper-category .table.table-price tr').each(function () {
            $(this).removeClass('tr-hidden');
        })
        $('ul.panel-price li .wrapper-category').each(function (i) {
            var _this = $(this);
            //var catid = _this.find('.cat-id').val();
            //var catname = _this.find('.cat-price-id').val();
            var catpriceid = _this.find('.price-id').val();
            var name = _this.find('.cat-name').text();

            //if (catpriceid == '') {
            $('.updateFrm').find('.input-style').each(function () {
                var _this = $(this);
                var id = _this.attr('id');
                if (this.value == '') {
                    showNoti('Not empty!', 'PriceList', 'Err');
                    showErrOfField(id, id);
                    price_err = 1;
                    return false;
                } else price_err = 0;
            });
            //} else price_err = 0;
            if (price_err == 0) updatePriceList(name, catpriceid, _this, i);
        })

        //todo remove name , befor to submit form,
        if ($('.remove-attr-name').length > 0) {
            $('.remove-attr-name').removeAttr('name');
        }
        if ($('.stage-filter').length > 0) {
            $('.remove-attr-name').removeAttr('name');
        }

        $('.input-distributor').each(function () {
            if (this.value == '') {
                return false;
            }
        })
        return false;
    }).on('click', '#addPart', function () {
        var checked = $('.remove-attr-name:checked');
        var wapper = checked.closest('.wrapper-category');
        if (checked.length < 0) {
            showNoti('Please checkbox the category', 'Err', 'Err');
            return;
        }
        lastNumber = wapper.find('.prices-for-distributors .table-details tbody tr:last').data('row');
        if (wapper.find('.prices-for-distributors .table-details tbody tr').length == 0) {
            wapper.find('.row-action').remove();
            wapper.find('.prices-for-distributors .table-details thead tr').append('<th width="5%" class="row-action"></th>');
            wapper.find('.prices-for-sales .table-details thead tr').append('<th width="5%" class="row-action"></th>');
        }
        addPart(wapper, true);
        updateInputPart();
        wapper.find('.prices-for-distributors .table-details tbody tr:last').append('<td><a style="float:right;" href="javascript:;" class="remove-rows-child"> <i class="glyph-icon icon-remove"></i> </a></td>');
        wapper.find('.prices-for-sales .table-details tbody tr:last').append('<td><a style="float:right;" href="javascript:;" class="remove-rows-child"> <i class="glyph-icon icon-remove"></i> </a></td>');
    }).on('click', '.btn.btn-info', function () {
        // var wrapper = $(this).closest('.wrapper-category');
        // var col = wrapper.find('.collapse').addClass('in');
        // wrapper.find('.btn.btn-info').removeClass('in').collapse().removeClass('in');

        /* var wrapper = $(this).closest('.wrapper-category');
        var btn = wrapper.find('.btn.btn-info');
        var col = wrapper.find('.collapse');

        if(btn.hasClass('collapsed')) btn.removeClass('collapsed');else btn.addClass('collapsed')
        if(col.hasClass('in')) col.removeClass('in'); else col.addClass('in');*/
    }).on('click', $('input:radio[name="check-category"]'), function () {
        /* var wrapper = $('input:radio[name="check-category"]:checked').closest('.wrapper-category');
         var btn = wrapper.find('.btn-info');
         var col = wrapper.find('.collapse');

         //if(!btn.hasClass('collapsed'))  btn.addClass('collapsed')
         if(!col.hasClass('in')) col.addClass('in');*/
    }).on('click', '#add-cat', function () {
        var _this = $(this);
        var name = $("#cat option:selected").text();
        var catid = $("#cat").val();
        if (catid == '') catid = name;

        //remove unless | un force
        _wrapper.each(function () {
            var _this = $(this);
            var col = _this.find('.collapse');
            if (col.hasClass('in')) col.removeClass('in');
            _this.find('.btn-info').addClass('collapsed');
        })
        //todo move to New Div
        $.ajax({
            url: site_url + 'pricelist/ajax_load_table_wrapper',
            method: 'post',
            data: {name: name, catid: catid},
            success: function (html) {
                var ojb = $.parseJSON(html);
                if (ojb.id == 'Choose a category' || ojb.id == '') {
                    showNoti('Please select a category!', 'Err', 'Err');
                    return false;
                }
                var myid = (ojb.id).replace(/ /g, '-');
                if ($('.wrapper-category.' + myid).length > 0) {
                    showNoti('This is category exist on page!', 'Err', 'Err');
                } else {
                    $(check_cate).prop("checked", false);
                    $('#itemList ul.panel-price').append('<li>' + ojb.html + '</li>');
                    $(check_cate + ':last').prop("checked", true);
                    $(check_cate + ':checked').closest('.wrapper-category').find('.table-distributors thead:first tr:last').before(
                        '<tr class="action">' + aAddCol + '<td class="th-style td-cost center"></td><td class="th-style td-sold center"></td><td class="th-style td-measure"><span></span></td>'
                    );

                    /*$(check_cate + ':checked').closest('.wrapper-category').find('.table-distributors thead:first').before(
                      '<colgroup> <col class="grey" span="4" /> </colgroup>'
                    );*/
                    // per_price();
                    setup_per();
                }
            }
        })
    }).on('click', '.addCol-Price', function () {
        //todo addCol
        //$('.tr-per').remove();
        $(check_cate).prop("checked", false);
        var _this = $(this);
        var wrapper = _this.closest('.wrapper-category');
        wrapper.find(check_cate).prop("checked", true);
        if (wrapper.find('.tb-distributors tr').length == 0) {
            showNoti('Add lest a row to add more columns', 'Warring', 'War');
            return false;
        }
        var input_th = '<input type="text" value="" size="6" class="input-th" />';
        var input_measure = 't<input type="text" value="100" size="6" class="input-th input-measure" />';
        $.each(['distributors', 'sales'], function (i, name) {
            //wrapper.find('.table-' + name + ' thead tr:last').append('<th class="th-head">' + input_th);
            if (i == 0) {
                wrapper.find('.table-' + name + ' thead tr.label').append('<th class="th-head"><input autocomplete="off" type="text" value="" size="6" class=" input-thead input-th input-distributor"></th><th class="th-style input-th center input-thead input-distributor"><span>Purchasing Cost</span></th> <th class="th-style input-th td-sold center input-thead input-distributor"><span>COGS</span></th> <th class="th-style input-th td-measure input-thead input-distributor center"><span>Margin(%)</span></th>');
                wrapper.find('.table-' + name + ' tbody.tb-' + name + ' tr').append('<td class="th-style td-buy"><input autocomplete="off" type="text" value="" size="6" class="input-style input-buy"/></td> <td class="th-style td-cost"><input autocomplete="off" type="text" value="" size="6" class="input-cost"/></td> <td class="th-style td-sold center"><input autocomplete="off" type="text" value="" class="disabled" size="6" /></td> <td class="th-style td-margin"><input autocomplete="off" type="text" value="" size="6" class="input-margin"/></td>');
            } else {
                wrapper.find('.table-' + name + ' thead tr.label').append('<th class="th-head"><input autocomplete="off" type="text" value="1+" size="6" class=" input-thead input-th input-price"></th><th class="th-style input-th center td-measure"><span></span></th> <th class="th-style input-th td-sold center"><span></span></th> <th class="th-style input-th td-measure center"><span></span></th>');
                wrapper.find('.table-' + name + ' tbody.tb-' + name + ' tr').append('<td class="th-style"><input autocomplete="off" type="text" value="" size="6" class="input-style"/></td><td class="th-style"></td><td class="th-style"></td><td class="th-style"></td>');
            }
        });

        wrapper.find('.table-distributors tbody :input').addClass('input-distributor');
        wrapper.find('.table-distributors thead th').addClass('input-thead input-distributor');
        wrapper.find('.table-sales tbody :input').addClass('input-price');
        wrapper.find('.table-distributors thead tr:last :input').addClass('input-distributor');
        wrapper.find('.table-sales thead tr:last :input').addClass('input-price');

        wrapper.find('th.th-head .input-th').addClass('input-thead').attr('data-v-max', '999999999').attr('data-v-min', '0');

        //todo force to div  scoll to right
        var gernator_numer = function ($class, sub = false) {
            //$(check_cate + ':checked').closest('.wrapper-category').find($class).each(function (i) {
            wrapper.find($class).each(function (i) {
                console.log('%c' + $class + ': ' + i, 'background: #222; color: #bada55');
                if (sub && i > 0) --i;
                i = (2 * i) + 1;
                i *= 10;
                if (!$(this).hasClass('oldinput-thead')) {
                    //$(this).val(i + '+');
                    $(this).val(i);
                    $(this).addClass('oldinput-thead')
                }
            });
        }

        addDivErr();
        //if (wrapper.find('.table-distributors thead tr:first .default').length > 0) wrapper.find('.table-distributors thead tr:first').remove();
        wrapper.find('.table-distributors thead:first tr.action').append('<td class="center"><a href="javascript:;" class="remove-cols-child"> <i class="glyph-icon icon-remove"></i> </a></td><td class="th-style td-cost"></td><td class="th-style td-sold center"></td><td class="th-style td-measure"><span></span></td>');
        var name = '';
        showNoti('Add more columns ' + name + ' successful', 'Price List', 'Ok');
        $('.input-distributor').on("keypress keyup blur", setup_number);
        $('.input-price').on("keypress keyup blur", setup_number);
        $('.input-moq').on("keypress keyup blur", setup_number_dot);
        $('.input-spq').on("keypress keyup blur", setup_number_dot);
        $('.input-margin').on("keypress keyup blur", function () {
            $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                //showNoti('Only enter a number', 'Price List', 'Err');
                event.preventDefault();
            }
        });
        //per_price();
        //wrapper.find('.prices-for-sales .table-sales thead tr.tr-per').append('<th class="td-per"><input autocomplete="off" type="text" value="100" size="6" class="input-th input-per"></th>');
        setup_per();
        gernator_numer(':input.input-thead.input-th.input-distributor');
        gernator_numer(':input.input-thead.input-th.input-price');
        //wrapper.find('.table-distributors thead tr:first td.center:even a').remove();
        //wrapper.find('.table-price thead tr .input-th.input-thead').addClass('oldinput-thead');
        ///$('.input-th.input-measure').on("keypress keyup blur", setup_number);
        setStore(wrapper);
        var weight = wrapper.find('.label-weight');
        if (weight.hasClass('hidden')) {
            weight.addClass('hidden');
            //wrapper.find('.tag-weight').attr('style', 'margin-top: 0px !important;');
        } else {
            //wrapper.find('.tag-weight').attr('style', 'margin-top: 26px !important;');
        }
        wrapper.find('.table-price tbody tr td:nth-child(4n+2) .label-weight').remove();
        //wrapper.find('.table-price tbody tr td:nth-child(4n+3) .label-weight').remove();
        wrapper.find('.table-price tbody tr td:nth-child(4n+4) .label-weight').remove();
        wrapper.find('.table-sales tbody tr td:nth-child(4n+3) :input').remove();
        wrapper.find('.table-sales tbody tr td:nth-child(4n+3) .label-weight').remove();
        wrapper.find('.table-price thead tr.label th:nth-child(4n+2) span').html('Purchasing Cost');
        wrapper.find('.table-price thead tr.label th:nth-child(4n+3) span').text('COGS');
        wrapper.find('.table-price thead tr.label th:nth-child(4n+4) span').text('Margin(%)');
        $('.input-value').not('.input-margin').addClass('money');
        wrapper.find('.input-moq').addClass('money').attr('data-v-max', 999999999).attr('data-v-min', 0);
        wrapper.find('.input-spq').addClass('money').attr('data-v-max', 999999999).attr('data-v-min', 0);
        $('.label-weight span').addClass('money');
        $('.input-thead').addClass('money');
        $('.money').autoNumeric('init');
    }).on('keyup', '.ChooseSup', function () {
        var _this = $(this);
        _this.parent().find('.result-suppliers').show();
        _this.parent().find('.result-suppliers').html('<p class="text-center"><img src="assets/images/spinner-mini.gif"/></p>');
        var id = $(this).val();
        $.ajax({
            url: site_url + 'pricelist/get_supplier_with_staff',
            type: 'POST',
            data: {id: id},
            success: function (string) {
                if (string == 0) {
                    _this.parent().find('.result-suppliers').empty();
                    _this.parent().find('.result-suppliers').html('<p class="text-center">Empty</p>');
                } else {
                    var getData = $.parseJSON(string);
                    var html = '';
                    for (var i = 0; i < getData.length; i++) {
                        html += '<p data-text ="' + getData[i].CompanyNameLo + '" data-id="' + getData[i].id + '" class="supplier-item">' + getData[i].id + ' - ' + getData[i].CompanyNameLo + '</p>';
                    }
                    _this.parent().find('.result-suppliers').empty();
                    _this.parent().find('.result-suppliers').html(html);
                }
            }
        })
    }).on('click', '.supplier-item', function () {
        var text = $(this).text();
        var name = $(this).data('text');
        var id = $(this).data('id');
        var option = $("<option>").val(name).text(name);
        $('#SupplierID').html(option).find('option').prop('selected', true).trigger("chosen:updated");
        $('#ChooseSup-SupplierID').val(id);
        $('.ChooseSup').val($('#ChooseSup-SupplierID').val());
    }).on('click', '.empty-supplier', function () {
        $('#SupplierID option').remove();
        $('#ChooseSup-SupplierID').val('');
        $('#ChooseSup').val('');
    })

    var setup_measure = function () {
        //   $('.table-distributors.table-price thead tr td:odd').not('.default').find('a').remove();
        /*$('.table-distributors.table-price tbody tr td:odd :input').removeClass('input-style input-distributor').addClass('input-th input-measure')
        $('.table-distributors.table-price thead th:odd').html('<span>Margin (%)</span>').addClass('td-measure').addClass('center');
        $('.table-sales.table-price thead th:odd').html('<span></span>').addClass('td-measure').addClass('center');
        $('.table-price tbody tr td:odd').addClass('td-measure');
        $('.prices-for-sales .table-sales tbody tr td:odd').html('<span></span>').addClass('td-measure').addClass('center');*/
        $('.input-measure .errordiv').remove();
        $('.input-th.input-measure').on("keypress keyup blur", setup_number);
        $('.input-margin').on("keypress keyup blur", function () {
            $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                //showNoti('Only enter a number', 'Price List', 'Err');
                event.preventDefault();
            }
        });
    }

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    //todo initizing to page load (once time)
    function init() {
        //per_price();
        select2('select#cat');
        countstt();
        table_price_delegate();
        $(check_cate).prop("checked", false);
        $(check_cate + ':last').prop("checked", true);
        $('.table-details tbody tr').append('<td><a style="float:right;" href="javascript:;" class="remove-rows-child"> <i class="glyph-icon icon-remove"></i> </a></td>');
        gernator_delete_col(true);
        if ($('.table-distributors thead:first tr:last th').length > 1) {
            $('.prices-for-distributors .form-group .col-md-6:first').css('margin-top', '20px');
            $('.prices-for-sales .form-group .col-md-6:last').css('margin-top', '15px');
        }
        $("#sortable").sortable({
            handle: '.draggable-item',
        });
        //$( "#sortable" ).disableSelection();//not zone
        enterOnlyNumber();
        addClassRequest();
        addDivErr(true);
        $('.label-weight span').addClass('money');
        $('.input-distributor').on("keypress keyup blur", setup_number);
        $('.input-price').on("keypress keyup blur", setup_number);
        $('.input-moq').on("keypress keyup blur", setup_number_dot);
        $('.input-spq').on("keypress keyup blur", setup_number_dot);
        $('.input-margin').on("keypress keyup blur", function () {
            $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                //showNoti('Only enter a number', 'Price List', 'Err');
                event.preventDefault();
            }
        });
        setup_per();
        filter();
        setup_measure();
        _wrapper.find('h1').append('<i style="float:right;margin-top: -5px;" class="viewWeight icon glyphicons eye_open waves-effect waves-circle"></i>').addClass('td-viewWeight');
        _wrapper.find('tbody tr').addClass('fetch70');
        //only one time
        $('.table-distributors tbody tr td:nth-child(4n+2) :input').addClass('input-cost rs-weight');
        $('.table-distributors tbody tr td:nth-child(4n+3) :input').addClass('disabled');
        /*   $('.table-distributors tbody tr td:nth-child(4n+3) :input').each(function () {
               var _this = $(this);
               var Val = _this.val() || 0;
               _this.closest('td').addClass('center').html('<span class="tag-weight" title="' + Val + '">' + Val + '</span>');
           });*/
        $('.table-distributors tbody tr td:nth-child(4n+4) :input').addClass('input-margin rs-weight');
        for (var i = 1; i < 5; i++) $('.table-price tbody tr td:nth-child(8n+' + i + ')').css('background', '#f2f2f2');
        addTitleWeight();
        $('.table-price tbody tr td:nth-child(4n+2) .label-weight').remove();
        $('.table-price tbody tr td:nth-child(4n+4) .label-weight').remove();
        //$('.table-price tbody tr td:nth-child(4n+3) .label-weight').remove();
        $('.table-sales tbody tr td:nth-child(4n+3) :input').remove();
        $('.table-sales tbody tr td:nth-child(4n+3) .label-weight').remove();
        $('.table-price thead tr.label th:nth-child(4n+2) span').html('Purchasing Cost');
        $('.table-price thead tr.label th:nth-child(4n+3) span').text('COGS');
        $('.table-price thead tr.label th:nth-child(4n+4) span').text('Margin(%)');
        $('.input-value').not('.input-margin').addClass('money');
        /*$('.label-weight span').each(function () {
            var test = $(this).text();
            $(this).text(test.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,'));
        })*/
        $('.input-margin').on("keypress keyup blur", function () {
            $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                //showNoti('Only enter a number', 'Price List', 'Err');
                event.preventDefault();
            }
        });

        $('.input-moq').each(function () {
            var Val = $(this).val();
            if (!!Val) {
                $(this).val(numberWithCommas(Val));
            }
        })
        $('.input-spq').each(function () {
            var Val = $(this).val();
            if (!!Val) {
                $(this).val(numberWithCommas(Val));
            }
        })
        $('.input-thead').each(function () {
            var Val = $(this).val();
            if (!!Val) {
                $(this).val(numberWithCommas(Val));
            }
        })
        $('.input-moq').addClass('money');
        $('.input-spq').addClass('money');
        $('.input-thead').addClass('money');
        $('.money').autoNumeric('init');
        checkMatchPart('input-part');
        checkMatchPart('input-mfr');
        checkMatchPart('input-desc');
        checkMatchPart('input-manufaceturer');
        checkMatchPart('input-spq');
        checkMatchPart('input-moq');
        checkMatchPart('input-leadtime');
    }

    var methods = {
        init: function (options) {
            return this.each(function () {
                var $this = $(this),
                    settings = $this.data('autoNumeric'),
                    tagData = $this.data();
                if (typeof settings !== 'object') {
                    var defaults = {
                        aNum: '0123456789',
                        aSep: ',',
                        dGroup: '3',
                        aDec: '.',
                        altDec: null,
                        aSign: '',
                        pSign: 'p',
                        vMax: '999999999.99',
                        vMin: '0.00',
                        mDec: null,
                        mRound: 'S',
                        aPad: true,
                        nBracket: null,
                        wEmpty: 'empty',
                        lZero: 'allow',
                        aForm: true,
                        onSomeEvent: function () {
                        }
                    };
                    settings = $.extend({}, defaults, tagData, options);
                    if (settings.aDec === settings.aSep) {
                        $.error("autoNumeric will not function properly when the decimal character aDec: '" + settings.aDec + "' and thousand separator aSep: '" + settings.aSep + "' are the same character");
                        return this;
                    }
                    $this.data('autoNumeric', settings);
                } else {
                    return this;
                }
                settings.lastSetValue = '';
                settings.runOnce = false;
                var holder = getHolder($this, settings);
                if ($.inArray($this.prop('tagName'), settings.tagList) === -1 && $this.prop('tagName') !== 'INPUT') {
                    $.error("The <" + $this.prop('tagName') + "> is not supported by autoNumeric()");
                    return this;
                }
                if (settings.runOnce === false && settings.aForm) {/** routine to format default value on page load */
                    if ($this.is('input[type=text], input[type=hidden], input:not([type])')) {
                        var setValue = true;
                        if ($this[0].value === '' && settings.wEmpty === 'empty') {
                            $this[0].value = '';
                            setValue = false;
                        }
                        if ($this[0].value === '' && settings.wEmpty === 'sign') {
                            $this[0].value = settings.aSign;
                            setValue = false;
                        }
                        if (setValue) {
                            $this.autoNumeric('set', $this.val());
                        }
                    }
                    if ($.inArray($this.prop('tagName'), settings.tagList) !== -1 && $this.text() !== '') {
                        $this.autoNumeric('set', $this.text());
                    }
                }
                settings.runOnce = true;
                if ($this.is('input[type=text], input[type=hidden], input:not([type])')) {
                    /**added hidden type */
                    $this.on('keydown.autoNumeric', function (e) {
                        holder = getHolder($this);
                        if (holder.settings.aDec === holder.settings.aSep) {
                            $.error("autoNumeric will not function properly when the decimal character aDec: '" + holder.settings.aDec + "' and thousand separator aSep: '" + holder.settings.aSep + "' are the same character");
                            return this;
                        }
                        if (holder.that.readOnly) {
                            holder.processed = true;
                            return true;
                        }
                        holder.init(e);
                        holder.settings.oEvent = 'keydown';
                        if (holder.skipAllways(e)) {
                            holder.processed = true;
                            return true;
                        }
                        if (holder.processAllways()) {
                            holder.processed = true;
                            holder.formatQuick();
                            e.preventDefault();
                            return false;
                        }
                        holder.formatted = false;
                        return true;
                    });
                    $this.on('keypress.autoNumeric', function (e) {
                        var holder = getHolder($this),
                            processed = holder.processed;
                        holder.init(e);
                        holder.settings.oEvent = 'keypress';
                        if (holder.skipAllways(e)) {
                            return true;
                        }
                        if (processed) {
                            e.preventDefault();
                            return false;
                        }
                        if (holder.processAllways() || holder.processKeypress()) {
                            holder.formatQuick();
                            e.preventDefault();
                            return false;
                        }
                        holder.formatted = false;
                    });
                    $this.on('keyup.autoNumeric', function (e) {
                        var holder = getHolder($this);
                        holder.init(e);
                        holder.settings.oEvent = 'keyup';
                        var skip = holder.skipAllways(e);
                        holder.kdCode = 0;
                        delete holder.valuePartsBeforePaste;
                        if ($this[0].value === holder.settings.aSign) {
                            if (holder.settings.pSign === 's') {
                                setElementSelection(this, 0, 0);
                            } else {
                                setElementSelection(this, holder.settings.aSign.length, holder.settings.aSign.length);
                            }
                        }
                        if (skip) {
                            return true;
                        }
                        if (this.value === '') {
                            return true;
                        }
                        if (!holder.formatted) {
                            holder.formatQuick();
                        }
                    });
                    $this.on('focusin.autoNumeric', function () {
                        var holder = getHolder($this);
                        holder.settingsClone.oEvent = 'focusin';
                        if (holder.settingsClone.nBracket !== null) {
                            var checkVal = $this.val();
                            $this.val(negativeBracket(checkVal, holder.settingsClone.nBracket, holder.settingsClone.oEvent));
                        }
                        holder.inVal = $this.val();
                        var onempty = checkEmpty(holder.inVal, holder.settingsClone, true);
                        if (onempty !== null) {
                            $this.val(onempty);
                            if (holder.settings.pSign === 's') {
                                setElementSelection(this, 0, 0);
                            } else {
                                setElementSelection(this, holder.settings.aSign.length, holder.settings.aSign.length);
                            }
                        }
                    });
                    $this.on('focusout.autoNumeric', function () {
                        var holder = getHolder($this),
                            settingsClone = holder.settingsClone,
                            value = $this.val(),
                            origValue = value;
                        holder.settingsClone.oEvent = 'focusout';
                        var strip_zero = '';
                        if (settingsClone.lZero === 'allow') {
                            settingsClone.allowLeading = false;
                            strip_zero = 'leading';
                        }
                        if (value !== '') {
                            value = autoStrip(value, settingsClone, strip_zero);
                            if (checkEmpty(value, settingsClone) === null && autoCheck(value, settingsClone, $this[0])) {
                                value = fixNumber(value, settingsClone.aDec, settingsClone.aNeg);
                                value = autoRound(value, settingsClone);
                                value = presentNumber(value, settingsClone.aDec, settingsClone.aNeg);
                            } else {
                                value = '';
                            }
                        }
                        var groupedValue = checkEmpty(value, settingsClone, false);
                        if (groupedValue === null) {
                            groupedValue = autoGroup(value, settingsClone);
                        }
                        if (groupedValue !== origValue) {
                            $this.val(groupedValue);
                        }
                        if (groupedValue !== holder.inVal) {
                            $this.change();
                            delete holder.inVal;
                        }
                        if (settingsClone.nBracket !== null && $this.autoNumeric('get') < 0) {
                            holder.settingsClone.oEvent = 'focusout';
                            $this.val(negativeBracket($this.val(), settingsClone.nBracket, settingsClone.oEvent));
                        }
                    });
                }
            });
        },
        destroy: function () {
            return $(this).each(function () {
                var $this = $(this);
                $this.off('.autoNumeric');
                $this.removeData('autoNumeric');
            });
        },
        update: function (options) {
            return $(this).each(function () {
                var $this = autoGet($(this)),
                    settings = $this.data('autoNumeric');
                if (typeof settings !== 'object') {
                    $.error("You must initialize autoNumeric('init', {options}) prior to calling the 'update' method");
                    return this;
                }
                var strip = $this.autoNumeric('get');
                settings = $.extend(settings, options);
                getHolder($this, settings, true);
                if (settings.aDec === settings.aSep) {
                    $.error("autoNumeric will not function properly when the decimal character aDec: '" + settings.aDec + "' and thousand separator aSep: '" + settings.aSep + "' are the same character");
                    return this;
                }
                $this.data('autoNumeric', settings);
                if ($this.val() !== '' || $this.text() !== '') {
                    return $this.autoNumeric('set', strip);
                }
                return;
            });
        },
        set: function (valueIn) {
            return $(this).each(function () {
                var $this = autoGet($(this)),
                    settings = $this.data('autoNumeric'),
                    value = valueIn.toString(),
                    testValue = valueIn.toString();
                if (typeof settings !== 'object') {
                    $.error("You must initialize autoNumeric('init', {options}) prior to calling the 'set' method");
                    return this;
                }
                if ((testValue === $this.attr('value') || testValue === $this.text()) && settings.runOnce === false) {
                    value = value.replace(',', '.');
                }
                if (testValue !== $this.attr('value') && $this.prop('tagName') === 'INPUT' && settings.runOnce === false) {
                    value = autoStrip(value, settings);
                }
                if (!$.isNumeric(+value)) {
                    return '';
                }
                value = checkValue(value, settings);
                settings.oEvent = 'set';
                settings.lastSetValue = value;
                value.toString();
                if (value !== '') {
                    value = autoRound(value, settings);
                }
                value = presentNumber(value, settings.aDec, settings.aNeg);
                if (!autoCheck(value, settings)) {
                    value = autoRound('', settings);
                }
                value = autoGroup(value, settings);
                if ($this.is('input[type=text], input[type=hidden], input:not([type])')) {
                    return $this.val(value);
                }
                if ($.inArray($this.prop('tagName'), settings.tagList) !== -1) {
                    return $this.text(value);
                }
                $.error("The <" + $this.prop('tagName') + "> is not supported by autoNumeric()");
                return false;
            });
        },
        get: function () {
            var $this = autoGet($(this)),
                settings = $this.data('autoNumeric');
            if (typeof settings !== 'object') {
                $.error("You must initialize autoNumeric('init', {options}) prior to calling the 'get' method");
                return this;
            }
            settings.oEvent = 'get';
            var getValue = '';
            if ($this.is('input[type=text], input[type=hidden], input:not([type])')) {
                getValue = $this.eq(0).val();
            } else if ($.inArray($this.prop('tagName'), settings.tagList) !== -1) {
                getValue = $this.eq(0).text();
            } else {
                $.error("The <" + $this.prop('tagName') + "> is not supported by autoNumeric()");
                return false;
            }
            if ((getValue === '' && settings.wEmpty === 'empty') || (getValue === settings.aSign && (settings.wEmpty === 'sign' || settings.wEmpty === 'empty'))) {
                return '';
            }
            if (settings.nBracket !== null && getValue !== '') {
                getValue = negativeBracket(getValue, settings.nBracket, settings.oEvent);
            }
            if (settings.runOnce || settings.aForm === false) {
                getValue = autoStrip(getValue, settings);
            }
            getValue = fixNumber(getValue, settings.aDec, settings.aNeg);
            if (+getValue === 0 && settings.lZero !== 'keep') {
                getValue = '0';
            }
            if (settings.lZero === 'keep') {
                return getValue;
            }
            getValue = checkValue(getValue, settings);
            return getValue;
        },
        getString: function () {
            var isAutoNumeric = false,
                $this = autoGet($(this)),
                str = $this.serialize(),
                parts = str.split('&'),
                i = 0;
            for (i; i < parts.length; i += 1) {
                var miniParts = parts[i].split('=');
                var settings = $('*[name="' + decodeURIComponent(miniParts[0]) + '"]').data('autoNumeric');
                if (typeof settings === 'object') {
                    if (miniParts[1] !== null && $('*[name="' + decodeURIComponent(miniParts[0]) + '"]').data('autoNumeric') !== undefined) {
                        miniParts[1] = $('input[name="' + decodeURIComponent(miniParts[0]) + '"]').autoNumeric('get');
                        parts[i] = miniParts.join('=');
                        isAutoNumeric = true;
                    }
                }
            }
            if (isAutoNumeric === true) {
                return parts.join('&');
            }
            $.error("You must initialize autoNumeric('init', {options}) prior to calling the 'getString' method");
            return this;
        },
        getArray: function () {
            var isAutoNumeric = false,
                $this = autoGet($(this)),
                formFields = $this.serializeArray();
            $.each(formFields, function (i, field) {
                var settings = $('*[name="' + decodeURIComponent(field.name) + '"]').data('autoNumeric');
                if (typeof settings === 'object') {
                    if (field.value !== '' && $('*[name="' + decodeURIComponent(field.name) + '"]').data('autoNumeric') !== undefined) {
                        field.value = $('input[name="' + decodeURIComponent(field.name) + '"]').autoNumeric('get').toString();
                    }
                    isAutoNumeric = true;
                }
            });
            if (isAutoNumeric === true) {
                return formFields;
            }
            $.error("You must initialize autoNumeric('init', {options}) prior to calling the 'getArray' method");
            return this;
        },
        getSettings: function () {
            var $this = autoGet($(this));
            return $this.eq(0).data('autoNumeric');
        }
    };
    $.fn.autoNumeric = function (method) {
        if (methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        }
        if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        }
        $.error('Method "' + method + '" is not supported by autoNumeric()');
    };

    var setup_action_group = function () {
        _wrapper.each(function () {
            $(this).find('.table-price td').each(function (i) {
                var s = i * 4;
                for (var j = i; j <= s; j++) {
                    $(this).addClass('zzz' + (s / (i * 4)));
                }

            })
        })
    }

    var rs_weight = function (vl, sl) {
        if (!sl) sl = 0;
        else {
            sl = sl.toString();
            sl = sl.replace(',', '');
            sl = parseFloat(sl);
        }
        if (!!vl) vl = convert(vl);
        var Val = sl * vl;


        Val = parseFloat(Val).toFixed(2);
        Val = Val.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
        return '<span title="' + Val + '">' + Val + '</span>';
    }

    var setStore = function (w) {
        w.find('.prices-for-sales .table-price tbody tr:last td:odd').html('<span></span>').addClass('td-measure');
        //w.find('.prices-for-sales .table-price tbody tr:last td.td-sold').html('<span></span>').addClass('td-measure');
        w.find('.table-price tbody tr td :input').each(function (i) {
            if (!$(this).hasClass('rs-weight')) {
                $(this).addClass('rs-weight');
                $(this).parent().append('<div class="label-weight"><span>0</span></div>');
            }
        })
        w.find('.table-price tbody tr td :input').addClass('input-value');
        for (var i = 1; i < 5; i++) $('.table-price tbody tr td:nth-child(8n+' + i + ')').css('background', '#f2f2f2');
        //w.each(function () {
        //var v = $(this).find('.table-price thead tr.label th :input').val();
        //if(!!v) v = v.replace('+','');
        //})
    }

    var setup_table = function () {
        var marg = 'margin-top: -30px !important; float: left !important;';
        var height = 'height:70px !important;';
        _wrapper.each(function () {
            var _this = $(this);
            _this.find('table tbody tr').each(function () {
                $(this).attr('style', height);
                $(this).find(':input').attr('style', marg);
                $(this).find('a').attr('style', marg);
            })
        })
    }

    setTimeout(function () {
        $('.money').autoNumeric('init');
    }, 500);
});

$(document).mouseup(function (e) {
    var container = $(".result-suppliers");
    if (!container.is(e.target)
        && container.has(e.target).length === 0) {
        container.hide();
    }
});