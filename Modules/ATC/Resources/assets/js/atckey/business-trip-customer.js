$(document).ready(function () {
    $('body').on('click', '.add-hotel-item', function () {
        var parent = $('.hotel-list');
        var currency = $('#Currency').val();
        var key = 0;
        if (parent.find('.form-group').length) {
            key = parseInt(parent.find('.form-group').last().attr('data-id')) + 1;
        }
        var html = '';
        html += '<div class="form-group" data-id="' + key + '">';
        html += '<a href="javascript:;" class="remove-form-group"><i class="fa fa-times" aria-hidden="true"></i></a>';
        html += '<div class="col-sm-2"><label' + (key > 0 ? ' class="hidden"' : '') + '>Name <span style="color:red">*</span></label><select id="Hotel' + key + 'Name" name="Hotel[' + key + '][Name]" class="form-control" data-required="1">' + hotel_options + '</select><div class="errordiv Hotel' + key + 'Name"><div class="arrow"></div>Not Empty!</div></div>';
        html += '<div class="col-sm-2"><label' + (key > 0 ? ' class="hidden"' : '') + '>Rank <span style="color:red">*</span></label><select id="Hotel' + key + 'Rank" name="Hotel[' + key + '][Rank]" class="form-control" data-required="1">' + hotelrank_options + '</select><div class="errordiv Hotel' + key + 'Rank"><div class="arrow"></div>Not Empty!</div></div>';
        html += '<div class="col-sm-2"><label' + (key > 0 ? ' class="hidden"' : '') + '>Night <span style="color:red">*</span></label><input id="Hotel' + key + 'Night" type="text" class="form-control qty" name="Hotel[' + key + '][Night]" placeholder="Night" data-required="1"><div class="errordiv Hotel' + key + 'Night"><div class="arrow"></div>Not Empty!</div></div>';
        html += '<div class="col-sm-2"><label' + (key > 0 ? ' class="hidden"' : '') + '>People <span style="color:red">*</span></label><input id="Hotel' + key + 'People""type="text" class="form-control" name="Hotel[' + key + '][People]" placeholder="People" data-required="1"><div class="errordiv Hotel' + key + 'People"><div class="arrow"></div>Not Empty!</div></div>';
        html += '<div class="col-sm-2"><label' + (key > 0 ? ' class="hidden"' : '') + '>Unit Cost <span style="color:red">*</span></label><div class="input-group"><input id="Hotel' + key + 'UnitCost" type="text" class="form-control unit" name="Hotel[' + key + '][UnitCost]" placeholder="Unit Cost" data-required="1"><div class="errordiv Hotel' + key + 'UnitCost"><div class="arrow"></div>Not Empty!</div><div class="input-group-addon addon-currency">' + (currency == 'USD' ? '$' : (currency == 'VND' ? 'đ' : 'unit')) + '</div></div></div>';
        html += '<div class="col-sm-2"><label' + (key > 0 ? ' class="hidden"' : '') + '>Total Cost <span style="color:red">*</span></label><div class="input-group"><input type="text" class="form-control total total-cost-hotel disabled" name="Hotel[' + key + '][TotalCost]" value="0" placeholder="Total Cost" readonly="readonly"><div class="input-group-addon addon-currency">' + (currency == 'USD' ? '$' : (currency == 'VND' ? 'đ' : 'unit')) + '</div></div></div>';
        html += '</div>';
        parent.append(html);
        parent.find('select').chosen({ allow_single_deselect: true });
        parent.find('.chosen-single div').html('<i class="glyph-icon icon-caret-down"></i>');
    }).on('click', '.add-flight-item', function () {
        var parent = $('.flight-list');
        var currency = $('#Currency').val();
        var key = 0;
        if (parent.find('.form-group').length) {
            key = parseInt(parent.find('.form-group').last().attr('data-id')) + 1;
        }
        var html = '';
        html += '<div class="form-group" data-id="' + key + '">';
        html += '<a href="javascript:;" class="remove-form-group"><i class="fa fa-times" aria-hidden="true"></i></a>';
        html += '<div class="col-sm-3"><label' + (key > 0 ? ' class="hidden"' : '') + '>Name <span style="color:red">*</span></label><select id="Flight' + key + 'Name" name="Flight[' + key + '][Name]" class="form-control" data-required="1">' + flight_options + '</select><div class="errordiv Flight' + key + 'Name"><div class="arrow"></div>Not Empty!</div></div>';
        html += '<div class="col-sm-3"><label' + (key > 0 ? ' class="hidden"' : '') + '>Way <span style="color:red">*</span></label><input id="Flight' + key + 'Way" type="text" class="form-control qty" name="Flight[' + key + '][Way]" placeholder="Way" data-required="1"><div class="errordiv Flight' + key + 'Way"><div class="arrow"></div>Not Empty!</div></div>';
        html += '<div class="col-sm-3"><label' + (key > 0 ? ' class="hidden"' : '') + '>Unit Cost <span style="color:red">*</span></label><div class="input-group"><input id="Flight' + key + 'UnitCost" type="text" class="form-control unit" name="Flight[' + key + '][UnitCost]" placeholder="Unit Cost" data-required="1"><div class="errordiv Flight' + key + 'UnitCost"><div class="arrow"></div>Not Empty!</div><div class="input-group-addon addon-currency">' + (currency == 'USD' ? '$' : (currency == 'VND' ? 'đ' : 'unit')) + '</div></div></div>';
        html += '<div class="col-sm-3"><label' + (key > 0 ? ' class="hidden"' : '') + '>Total Cost <span style="color:red">*</span></label><div class="input-group"><input type="text" class="form-control total total-cost-flight disabled" name="Flight[' + key + '][TotalCost]" value="0" placeholder="Total Cost" readonly="readonly"><div class="input-group-addon addon-currency">' + (currency == 'USD' ? '$' : (currency == 'VND' ? 'đ' : 'unit')) + '</div></div></div>';
        html += '</div>';
        parent.append(html);
        parent.find('select').chosen({ allow_single_deselect: true });
        parent.find('.chosen-single div').html('<i class="glyph-icon icon-caret-down"></i>');
    }).on('click', '.add-eat-drink-item', function () {
        var grandparent = $(this).closest('.station-item');
        var currency = $('#Currency').val();
        var parentKey = grandparent.attr('data-id');
        var parent = grandparent.find('.eat-drink-list');
        var key = 0;
        if (parent.find('.form-group').length) {
            key = parseInt(parent.find('.form-group').last().attr('data-id')) + 1;
        }
        var html = '';
        html += '<div class="form-group" data-id="' + key + '">';
        html += '<a href="javascript:;" class="remove-form-group"><i class="fa fa-times" aria-hidden="true"></i></a>';
        html += '<div class="col-sm-2"><label' + (key > 0 ? ' class="hidden"' : '') + '>Title <span style="color:red">*</span></label><select id="Station' + parentKey + 'Eating' + key + 'Title" name="Station[' + parentKey + '][Eating][' + key + '][Title]" class="form-control" data-required="1">' + eating_options + '</select><div class="errordiv Station' + parentKey + 'Eating' + key + 'Title"><div class="arrow"></div>Not Empty!</div></div>';
        html += '<div class="col-sm-2"><label' + (key > 0 ? ' class="hidden"' : '') + '>Restaurant Name <span style="color:red">*</span></label><select id="Station' + parentKey + 'Eating' + key + 'RestaurantName" name="Station[' + parentKey + '][Eating][' + key + '][RestaurantName]" class="form-control" data-required="1">' + restaurant_options + '</select><div class="errordiv Station' + parentKey + 'Eating' + key + 'RestaurantName"><div class="arrow"></div>Not Empty!</div></div>';
        html += '<div class="col-sm-2"><label' + (key > 0 ? ' class="hidden"' : '') + '>People <span style="color:red">*</span></label><input id="Station' + parentKey + 'Eating' + key + 'People" type="text" class="form-control qty" name="Station[' + parentKey + '][Eating][' + key + '][People]" placeholder="People" data-required="1"><div class="errordiv Station' + parentKey + 'Eating' + key + 'People"><div class="arrow"></div>Not Empty!</div></div>';
        html += '<div class="col-sm-2"><label' + (key > 0 ? ' class="hidden"' : '') + '>Unit Cost <span style="color:red">*</span></label><div class="input-group"><input id="Station' + parentKey + 'Eating' + key + 'UnitCost" type="text" class="form-control unit" name="Station[' + parentKey + '][Eating][' + key + '][UnitCost]" placeholder="Unit Cost" data-required="1"><div class="errordiv Station' + parentKey + 'Eating' + key + 'UnitCost"><div class="arrow"></div>Not Empty!</div><div class="input-group-addon addon-currency">' + (currency == 'USD' ? '$' : (currency == 'VND' ? 'đ' : 'unit')) + '</div></div></div>';
        html += '<div class="col-sm-2"><label' + (key > 0 ? ' class="hidden"' : '') + '>Total Cost <span style="color:red">*</span></label><div class="input-group"><input type="text" class="form-control total total-cost-eating disabled" name="Station[' + parentKey + '][Eating][' + key + '][TotalCost]" data-action="eating" value="0" placeholder="Total Cost" readonly="readonly"><div class="input-group-addon addon-currency">' + (currency == 'USD' ? '$' : (currency == 'VND' ? 'đ' : 'unit')) + '</div></div></div>';
        html += '<div class="col-sm-2"><label' + (key > 0 ? ' class="hidden"' : '') + '>Payer <span style="color:red">*</span></label><select id="Station' + parentKey + 'Eating' + key + 'Payer" name="Station[' + parentKey + '][Eating][' + key + '][Payer]" class="form-control" data-required="1">' + staff_options + '</select><div class="errordiv Station' + parentKey + 'Eating' + key + 'Payer"><div class="arrow"></div>Not Empty!</div></div>';
        html += '</div>';
        parent.append(html);
        parent.find('select').chosen({ allow_single_deselect: true });
        parent.find('.chosen-single div').html('<i class="glyph-icon icon-caret-down"></i>');
    }).on('click', '.add-moving-item', function () {
        var grandparent = $(this).closest('.station-item');
        var currency = $('#Currency').val();
        var parentKey = grandparent.attr('data-id');
        var parent = grandparent.find('.moving-list');
        var key = 0;
        if (parent.find('.form-group').length) {
            key = parseInt(parent.find('.form-group').last().attr('data-id')) + 1;
        }
        var html = '';
        html += '<div class="form-group" data-id="' + key + '">';
        html += '<a href="javascript:;" class="remove-form-group"><i class="fa fa-times" aria-hidden="true"></i></a>';
        html += '<div class="col-sm-2"><label' + (key > 0 ? ' class="hidden"' : '') + '>Title <span style="color:red">*</span></label><select id="Station' + parentKey + 'Moving' + key + 'Title" name="Station[' + parentKey + '][Moving][' + key + '][Title]" class="form-control" data-required="1">' + vehicle_moving_options + '</select><div class="errordiv Station' + parentKey + 'Moving' + key + 'Title"><div class="arrow"></div>Not Empty!</div></div>';
        html += '<div class="col-sm-2"><label' + (key > 0 ? ' class="hidden"' : '') + '>Company Name <span style="color:red">*</span></label><select id="Station' + parentKey + 'Moving' + key + 'CompanyName" name="Station[' + parentKey + '][Moving][' + key + '][CompanyName]" class="form-control" data-required="1">' + vehicle_brand_options + '</select><div class="errordiv Station' + parentKey + 'Moving' + key + 'CompanyName"><div class="arrow"></div>Not Empty!</div></div>';
        html += '<div class="col-sm-2"><label' + (key > 0 ? ' class="hidden"' : '') + '>Distance <span style="color:red">*</span></label><div class="input-group"><input id="Station' + parentKey + 'Moving' + key + 'Distance" type="text" class="form-control qty" name="Station[' + parentKey + '][Moving][' + key + '][Distance]" placeholder="Distance (km)" data-required="1"><div class="errordiv Station' + parentKey + 'Moving' + key + 'Distance"><div class="arrow"></div>Not Empty!</div><div class="input-group-addon">km</div></div></div>';
        html += '<div class="col-sm-2"><label' + (key > 0 ? ' class="hidden"' : '') + '>Unit Cost <span style="color:red">*</span></label><div class="input-group"><input id="Station' + parentKey + 'Moving' + key + 'UnitCost" type="text" class="form-control unit" name="Station[' + parentKey + '][Moving][' + key + '][UnitCost]" placeholder="Unit Cost" data-required="1"><div class="errordiv Station' + parentKey + 'Moving' + key + 'UnitCost"><div class="arrow"></div>Not Empty!</div><div class="input-group-addon addon-currency">' + (currency == 'USD' ? '$' : (currency == 'VND' ? 'đ' : 'unit')) + '</div></div></div>';
        html += '<div class="col-sm-2"><label' + (key > 0 ? ' class="hidden"' : '') + '>Total Cost <span style="color:red">*</span></label><div class="input-group"><input type="text" class="form-control total total-cost-moving disabled" name="Station[' + parentKey + '][Moving][' + key + '][TotalCost]" data-action="moving" value="0" placeholder="Total Cost" readonly="readonly"><div class="input-group-addon addon-currency">' + (currency == 'USD' ? '$' : (currency == 'VND' ? 'đ' : 'unit')) + '</div></div></div>';
        html += '<div class="col-sm-2"><label' + (key > 0 ? ' class="hidden"' : '') + '>Payer <span style="color:red">*</span></label><select id="Station' + parentKey + 'Moving' + key + 'Payer" name="Station[' + parentKey + '][Moving][' + key + '][Payer]" class="form-control" data-required="1">' + staff_options + '</select><div class="errordiv Station' + parentKey + 'Moving' + key + 'Payer"><div class="arrow"></div>Not Empty!</div></div>';
        html += '</div>';
        parent.append(html);
        parent.find('select').chosen({ allow_single_deselect: true });
        parent.find('.chosen-single div').html('<i class="glyph-icon icon-caret-down"></i>');
    }).on('click', '.add-present-item', function () {
        var grandparent = $(this).closest('.station-item');
        var currency = $('#Currency').val();
        var parentKey = grandparent.attr('data-id');
        var parent = grandparent.find('.present-list');
        var key = 0;
        if (parent.find('.form-group').length) {
            key = parseInt(parent.find('.form-group').last().attr('data-id')) + 1;
        }
        var html = '';
        html += '<div class="form-group" data-id="' + key + '">';
        html += '<a href="javascript:;" class="remove-form-group"><i class="fa fa-times" aria-hidden="true"></i></a>';
        html += '<div class="col-sm-2"><label' + (key > 0 ? ' class="hidden"' : '') + '>Title <span style="color:red">*</span></label><input id="Station' + parentKey + 'Present' + key + 'Title" type="text" class="form-control" name="Station[' + parentKey + '][Present][' + key + '][Title]" placeholder="Title" data-required="1"><div class="errordiv Station' + parentKey + 'Present' + key + 'Title"><div class="arrow"></div>Not Empty!</div></div>';
        html += '<div class="col-sm-2"><label' + (key > 0 ? ' class="hidden"' : '') + '>Brand <span style="color:red">*</span></label><input id="Station' + parentKey + 'Present' + key + 'Brand" type="text" class="form-control" name="Station[' + parentKey + '][Present][' + key + '][Brand]" placeholder="Brand" data-required="1"><div class="errordiv Station' + parentKey + 'Present' + key + 'Brand"><div class="arrow"></div>Not Empty!</div></div>';
        html += '<div class="col-sm-2"><label' + (key > 0 ? ' class="hidden"' : '') + '>Set <span style="color:red">*</span></label><input id="Station' + parentKey + 'Present' + key + 'Set" type="text" class="form-control qty" name="Station[' + parentKey + '][Present][' + key + '][Set]" placeholder="Set" data-required="1"><div class="errordiv Station' + parentKey + 'Present' + key + 'Set"><div class="arrow"></div>Not Empty!</div></div>';
        html += '<div class="col-sm-2"><label' + (key > 0 ? ' class="hidden"' : '') + '>Unit Cost <span style="color:red">*</span></label><div class="input-group"><input id="Station' + parentKey + 'Present' + key + 'UnitCost" type="text" class="form-control unit" name="Station[' + parentKey + '][Present][' + key + '][UnitCost]" placeholder="Unit Cost" data-required="1"><div class="errordiv Station' + parentKey + 'Present' + key + 'UnitCost"><div class="arrow"></div>Not Empty!</div><div class="input-group-addon addon-currency">' + (currency == 'USD' ? '$' : (currency == 'VND' ? 'đ' : 'unit')) + '</div></div></div>';
        html += '<div class="col-sm-2"><label' + (key > 0 ? ' class="hidden"' : '') + '>Total Cost <span style="color:red">*</span></label><div class="input-group"><input type="text" class="form-control total total-cost-present disabled" name="Station[' + parentKey + '][Present][' + key + '][TotalCost]" data-action="present" value="0" placeholder="Total Cost" readonly="readonly"><div class="input-group-addon addon-currency">' + (currency == 'USD' ? '$' : (currency == 'VND' ? 'đ' : 'unit')) + '</div></div></div>';
        html += '<div class="col-sm-2"><label' + (key > 0 ? ' class="hidden"' : '') + '>Payer <span style="color:red">*</span></label><select id="Station' + parentKey + 'Present' + key + 'Payer" name="Station[' + parentKey + '][Present][' + key + '][Payer]" class="form-control" data-required="1">' + staff_options + '</select><div class="errordiv Station' + parentKey + 'Present' + key + 'Payer"><div class="arrow"></div>Not Empty!</div></div>';
        html += '</div>';
        parent.append(html);
        parent.find('select').chosen({ allow_single_deselect: true });
        parent.find('.chosen-single div').html('<i class="glyph-icon icon-caret-down"></i>');
    }).on('click', '.add-attender-item', function () {
        var grandparent = $(this).closest('.station-item');
        var parentKey = grandparent.attr('data-id');
        var parent = grandparent.find('.attender-list');
        var key = 0;
        if (parent.find('.form-group').length) {
            key = parseInt(parent.find('.form-group').last().attr('data-id')) + 1;
        }
        var html = '';
        html += '<div class="form-group" data-id="' + key + '">';
        html += '<a href="javascript:;" class="remove-form-group"><i class="fa fa-times" aria-hidden="true"></i></a>';
        html += '<div class="col-sm-3"><label' + (key > 0 ? ' class="hidden"' : '') + '>Name <span style="color:red">*</span></label><input id="Station' + parentKey + 'Attender' + key + 'Name" type="text" class="form-control" name="Station[' + parentKey + '][Attender][' + key + '][Name]" placeholder="Name" data-required="1"><div class="errordiv Station' + parentKey + 'Attender' + key + 'Name"><div class="arrow"></div>Not Empty!</div></div>';
        html += '<div class="col-sm-3"><label' + (key > 0 ? ' class="hidden"' : '') + '>Position <span style="color:red">*</span></label><input id="Station' + parentKey + 'Attender' + key + 'Position" type="text" class="form-control" name="Station[' + parentKey + '][Attender][' + key + '][Position]" placeholder="Position" data-required="1"><div class="errordiv Station' + parentKey + 'Attender' + key + 'Position"><div class="arrow"></div>Not Empty!</div></div>';
        html += '<div class="col-sm-3"><label' + (key > 0 ? ' class="hidden"' : '') + '>Phone <span style="color:red">*</span></label><input id="Station' + parentKey + 'Attender' + key + 'Phone" type="text" class="form-control" name="Station[' + parentKey + '][Attender][' + key + '][Phone]" placeholder="Phone" data-required="1"><div class="errordiv Station' + parentKey + 'Attender' + key + 'Phone"><div class="arrow"></div>Not Empty!</div></div>';
        html += '<div class="col-sm-3"><label' + (key > 0 ? ' class="hidden"' : '') + '>Email <span style="color:red">*</span></label><input id="Station' + parentKey + 'Attender' + key + 'Email" type="text" class="form-control" name="Station[' + parentKey + '][Attender][' + key + '][Email]" placeholder="Email" data-required="1"><div class="errordiv Station' + parentKey + 'Attender' + key + 'Email"><div class="arrow"></div>Not Empty!</div></div>';
        html += '</div>';
        parent.append(html);
    }).on('click', '.add-request-item', function () {
        var grandparent = $(this).closest('.station-item');
        var parentKey = grandparent.attr('data-id');
        var parent = grandparent.find('.request-list');
        var key = 0;
        if (parent.find('.form-group').length) {
            key = parseInt(parent.find('.form-group').last().attr('data-id')) + 1;
        }
        var html = '';
        html += '<div class="form-group" data-id="' + key + '">';
        html += '<a href="javascript:;" class="remove-form-group"><i class="fa fa-times" aria-hidden="true"></i></a>';
        html += '<div class="col-sm-6"><label' + (key > 0 ? ' class="hidden"' : '') + '>Title <span style="color:red">*</span></label><input id="Station' + parentKey + 'Request' + key + 'Title" type="text" class="form-control" name="Station[' + parentKey + '][Request][' + key + '][Title]" placeholder="Title" data-required="1"><div class="errordiv Station' + parentKey + 'Request' + key + 'Title"><div class="arrow"></div>Not Empty!</div></div>';
        html += '<div class="col-sm-3"><label' + (key > 0 ? ' class="hidden"' : '') + '>Deadline <span style="color:red">*</span></label><input id="Station' + parentKey + 'Request' + key + 'Deadline" type="text" class="form-control bootstrap-datepicker" name="Station[' + parentKey + '][Request][' + key + '][Deadline]" placeholder="Deadline" data-required="1"><div class="errordiv Station' + parentKey + 'Request' + key + 'Deadline"><div class="arrow"></div>Not Empty!</div></div>';
        html += '</div>';
        parent.append(html);
        parent.find('.bootstrap-datepicker').datepicker({
            format: 'yyyy-mm-dd',
            language: 'en',
            autoclose: true,
            todayHighlight: true
        });
    }).on('click', '.add-actionplan-item', function () {
        var grandparent = $(this).closest('.station-item');
        var parentKey = grandparent.attr('data-id');
        var parent = grandparent.find('.actionplan-list');
        var key = 0;
        if (parent.find('.form-group').length) {
            key = parseInt(parent.find('.form-group').last().attr('data-id')) + 1;
        }
        var html = '';
        html += '<div class="form-group" data-id="' + key + '">';
        html += '<a href="javascript:;" class="remove-form-group"><i class="fa fa-times" aria-hidden="true"></i></a>';
        html += '<div class="col-sm-6"><label' + (key > 0 ? ' class="hidden"' : '') + '>Title <span style="color:red">*</span></label><div class="form-control" contenteditable></div><textarea id="Station' + parentKey + 'ActionPlan' + key + 'Title" data-autosize class="form-control" name="Station[' + parentKey + '][ActionPlan][' + key + '][Title]" placeholder="Title" data-required="1"></textarea><div class="errordiv Station' + parentKey + 'ActionPlan' + key + 'Title"><div class="arrow"></div>Not Empty!</div></div>';
        html += '<div class="col-sm-3"><label' + (key > 0 ? ' class="hidden"' : '') + '>Due Date <span style="color:red">*</span></label><input id="Station' + parentKey + 'ActionPlan' + key + 'DueDateFrom" type="text" class="form-control bootstrap-datepicker" name="Station[' + parentKey + '][ActionPlan][' + key + '][DueDateFrom]" placeholder="Due Date" data-required="1"><div class="errordiv Station' + parentKey + 'ActionPlan' + key + 'DueDateFrom"><div class="arrow"></div>Not Empty!</div></div>';
        html += '<div class="col-sm-3"><label' + (key > 0 ? ' class="hidden"' : '') + '>To <span style="color:red">*</span></label><input id="Station' + parentKey + 'ActionPlan' + key + 'DueDateTo" type="text" class="form-control bootstrap-datepicker" name="Station[' + parentKey + '][ActionPlan][' + key + '][DueDateTo]" placeholder="To" data-required="1"><div class="errordiv Station' + parentKey + 'ActionPlan' + key + 'DueDateTo"><div class="arrow"></div>Not Empty!</div></div>';
        html += '</div>';
        parent.append(html);
        parent.find('.bootstrap-datepicker').datepicker({
            format: 'yyyy-mm-dd',
            language: 'en',
            autoclose: true,
            todayHighlight: true
        });
    }).on('change', '#NumberOfStations', function () {
        return false;
        var val = $(this).val();
        var panelStation = $('.panel-station');
        panelStation.empty();

        for (var i = 1; i <= val; i++) {
            panelStation.append(add_station(i));
            panelStation.find('select').chosen({ allow_single_deselect: true });
            panelStation.find('.chosen-single div').html('<i class="glyph-icon icon-caret-down"></i>');
            panelStation.find('.bootstrap-timepicker').datetimepicker({
                format: 'LT'
            });
            panelStation.find('.bootstrap-datepicker').datepicker({
                format: 'yyyy-mm-dd',
                language: 'en',
                autoclose: true,
                todayHighlight: true
            });
            total_business_cost();
        }
    }).on('change', '.station-customer', function () {
        var val = $(this).val();
        var parent = $(this).closest('.station-pane');
        if (val == '') {
            parent.find('.station-customer-name').val('');
            parent.find('.station-project').val('').empty().trigger('chosen:updated');
        } else {
            $.ajax({
                url: site_url + 'ajax/get_info_with_id',
                type: 'POST',
                cache: false,
                data: {
                    id: val,
                    table: 'customers',
                    act: 'business_trip_customer'
                },
                success: function (string) {
                    var getData = $.parseJSON(string);
                    parent.find('.station-customer-name').val(getData.CompanyNameLo);
                    var getProject = $.parseJSON(getData.project);
                    var options = '<option value="">Select ...</option>';
                    for (var i = 0; i < getProject.length; i++) {
                        options += '<option value="' + getProject[i]['id'] + '">' + getProject[i]['ProjectName'] + '</option>';
                    }
                    console.log(options);
                    parent.find('.station-project').empty().append(options).trigger('chosen:updated');
                }
            })
        }
    }).on('keyup', '#ChooseSupplier', function () {
        $('.result-suppliers').show();
        $('.result-suppliers').html('<p class="text-center"><img src="assets/images/spinner-mini.gif"/></p>');
        var id = $(this).val();
        $.ajax({
            url: site_url + 'ajax/get_supplier_with_staff',
            type: 'POST',
            data: { id: id },
            success: function (string) {
                if (string == 0) {
                    $('.result-suppliers').empty();
                    $('.result-suppliers').html('<p class="text-center">Empty</p>');
                } else {
                    var getData = $.parseJSON(string);
                    var html = '';
                    for (var i = 0; i < getData.length; i++) {
                        html += '<p id="' + getData[i].id + '" class="supplier-item">' + getData[i].id + ' - ' + getData[i].CompanyNameLo + '</p>';
                    }
                    $('.result-suppliers').empty();
                    $('.result-suppliers').html(html);
                }
            }
        })
    }).on('focus', '#ChooseSupplier', function () {
        if ($(this).val() != '') {
            $('.result-suppliers').show();
        }
    }).on('mouseup', function (e) {
        if (!$('#ChooseSupplier').is(e.target) && $('#ChooseSupplier').has(e.target).length === 0 && !$('.result-suppliers').is(e.target) && $('.result-suppliers').has(e.target).length === 0) {
            $('.result-suppliers').hide();
        }
    }).on('click', '.supplier-item', function () {
        var id = $(this).attr('id');
        $('#SupplierID option[value="' + id + '"]').prop("selected", true);
    }).on('click', '.empty-supplier', function () {
        $('#SupplierID option[value=""]').prop("selected", true);
        $('#ChooseSupplier').val('');
    }).on('focus', '.qty, .unit', function() {
        $(this).select();
    }).on('change', '.qty, .unit', function () {
        var cur = 0;
        var curTotal = 0;
        if ($('#Currency').val() == '') {
            showNoti('Must choose currency', 'Warning', 'War');
            $(this).val('');
            return false;
        } else {
            if ($('#Currency').val() == 'USD') {
                cur = 4;
                curTotal = 2;
            }
        }
        var parent = $(this).closest('.form-group');
        var qty = parseFloat(parent.find('.qty').val().replace(/\s/g, '').replace(/,/g, ''));
        var unit = parseFloat(parent.find('.unit').val().replace(/\s/g, '').replace(/,/g, ''));
        parent.find('.qty').val(accounting.formatMoney(qty, '', 0));
        parent.find('.unit').val(accounting.formatMoney(unit, '', cur));
        parent.find('.total').val(accounting.formatMoney(qty * unit, '', curTotal));
        total_business_cost();
    }).on('click', '.remove-form-group', function() {
        $(this).parent().remove();
        total_business_cost();
    }).on('change', '#Currency', function() {
        $('.unit').val('');
        $('.total').val('');
        if ($(this).val() == 'VND') {
            $('.addon-currency').text('đ');
            $('.addon-total-dolar').hide();
            $('.addon-total-vnd').show();
        } else if ($(this).val() == 'USD') {
            $('.addon-currency').text('$');
            $('.addon-total-dolar').show();
            $('.addon-total-vnd').hide();
        } else {
            $('.addon-currency').text('unit');
        }
        total_business_cost();
    }).on('click', '.btn-add-station', function() {
        var panelStation = $('.panel-station');
        var key = 0;
        if (panelStation.find('.station-item').length) {
            key = parseInt(panelStation.find('.station-item').last().attr('data-id'));
        }
        key = key + 1;
        panelStation.append(add_station(key));
        panelStation.find('select').chosen({ allow_single_deselect: true });
        panelStation.find('.chosen-single div').html('<i class="glyph-icon icon-caret-down"></i>');
        panelStation.find('.bootstrap-timepicker').datetimepicker({
            format: 'LT'
        });
        panelStation.find('.bootstrap-datepicker').datepicker({
            format: 'yyyy-mm-dd',
            language: 'en',
            autoclose: true,
            todayHighlight: true
        });
        $('#NumberOfStations').val(parseInt($('.panel-station .station-item').length));
        total_business_cost();
    }).on('click', '.station-remove', function() {
        $(this).closest('.station-item').remove();
        $('#NumberOfStations').val(parseInt($('.panel-station .station-item').length));
        total_business_cost();
    })


});

function total_business_cost() {
    var totalHotel = 0;
    var totalFlight = 0;
    var totalEating = 0;
    var totalMoving = 0;
    var totalPresent = 0;
    var totalBusinessCost = 0;

    var cur = 0;
    if ($('#Currency').val() == 'USD') {
        cur = 2;
    }

    $('.total-cost-hotel').each(function () {
        totalHotel += parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
    })
    $('.total-cost-flight').each(function () {
        totalFlight += parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
    })
    $('.total-cost-eating').each(function () {
        totalEating += parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
    })
    $('.total-cost-moving').each(function () {
        totalMoving += parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
    })
    $('.total-cost-present').each(function () {
        totalPresent += parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
    })

    totalBusinessCost = totalEating + totalMoving + totalPresent + totalHotel + totalFlight;

    $('.hotel-total input').val(accounting.formatMoney(totalHotel, '', cur));
    $('.hotel-total .total-value').text(accounting.formatMoney(totalHotel, '', cur));
    $('.flight-total input').val(accounting.formatMoney(totalFlight, '', cur));
    $('.flight-total .total-value').text(accounting.formatMoney(totalFlight, '', cur));
    $('.eating-total input').val(accounting.formatMoney(totalEating, '', cur));
    $('.eating-total .total-value').text(accounting.formatMoney(totalEating, '', cur));
    $('.moving-total input').val(accounting.formatMoney(totalMoving, '', cur));
    $('.moving-total .total-value').text(accounting.formatMoney(totalMoving, '', cur));
    $('.present-total input').val(accounting.formatMoney(totalPresent, '', cur));
    $('.present-total .total-value').text(accounting.formatMoney(totalPresent, '', cur));
    $('.eating-total input').val(accounting.formatMoney(totalEating, '', cur));
    $('.eating-total .total-value').text(accounting.formatMoney(totalEating, '', cur));
    $('.total-business-cost input').val(accounting.formatMoney(totalBusinessCost, '', cur));
    $('.total-business-cost .total-value').text(accounting.formatMoney(totalBusinessCost, '', cur));

}
function add_station(key) {
    var html = '';
    html += '<div class="station-item" data-id="' + key + '">';
    html += '    <div class="info-header">';
    html += '        <h1>';
    html += '            <a href="#station-business' + key + '" data-toggle="collapse"><i class="glyph-icon icon-chevron-down"></i></a>';
    html += '            <ul class="nav-station" role="tablist">';
    html += '                <li role="presentation" class="active">';
    html += '                    <a href="#station' + key + '" aria-controls="home" role="tab" data-toggle="tab">Station ' + key + '</a>';
    html += '                </li>';
    html += '                <li role="presentation">';
    html += '                    <a href="#cost' + key + '" aria-controls="tab" role="tab" data-toggle="tab">Cost ' + key + '</a>';
    html += '                </li>';
    html += '                <li role="presentation">';
    html += '                    <a href="#report' + key + '" aria-controls="tab" role="tab" data-toggle="tab">Report ' + key + '</a>';
    html += '                </li>';
    html += '            </ul>';
    html += '            <a href="javascript:;" class="station-remove pull-right"><i class="fa fa-times"></i></a>';
    html += '        </h1>';
    html += '    </div>';
    html += '    <div id="station-business' + key + '" class="collapse in">';
    html += '        <div class="tab-content">';
    html += '            <div role="tabpanel" class="tab-pane station-pane active" id="station' + key + '">';
    html += '               <input type="hidden" name="Station[' + key + '][id]" value="">';
    html += '               <input type="hidden" name="Station[' + key + '][Station]" value="' + key + '">';
    html += '               <div class="station-stt" style="display: flex">';
    html += '           <div class="btn btn-primary" style="display:flex;">';
    html += '       <div class="col-sm-4 control-label ">Close</div>';
    html += '       <div class="col-sm-8" style="margin-left: 20px">';
    html += '               <div class="checkbox badgebox">';
    html += '                       <label>';
    html += '                               <input type="checkbox" name="Station[' + key + '][Close]" value="1">';
    html += '                       </label>';
    html += '               </div>';
    html += '        </div>';
    html += '          </div>';
    html += '       <div class="col-sm-4 control-label">Status</div>';
    html += '       <div class="col-sm-8"><select id="Station' + key + 'StatusStation" name="Station[' + key + '][StatusStation]" class="form-control">' + station_status_options +'</select></div>';
    html += '               </div>';
    html += '                <div class="row">';
    html += '                    <div class="col-sm-6">';
    html += '                        <div class="form-group">';
    html += '                            <div class="col-sm-4 control-label">Customer ID <span style="color:red">*</span></div>';
    html += '                            <div class="col-sm-8">';
    html += '                                <div class="row">';
    html += '                                    <div class="col-sm-12">';
    html += '                                        <select id="Station' + key + 'CustomerID" name="Station[' + key + '][CustomerID]" class="form-control station-customer" data-required="1">' + customers_options + '</select>';
    html += '                                        <div class="errordiv Station' + key + 'CustomerID"><div class="arrow"></div>Not Empty!</div>';
    html += '                                    </div>';
    html += '                                </div>';
    html += '                            </div>';
    html += '                        </div>';
    html += '                        <div class="form-group">';
    html += '                            <div class="col-sm-4 control-label">Customer Name <span style="color:red">*</span></div>';
    html += '                            <div class="col-sm-8">';
    html += '                                <div class="row">';
    html += '                                    <div class="col-sm-12">';
    html += '                                        <input type="text" id="Station' + key + 'CustomerName" name="Station[' + key + '][CustomerName]" class="form-control station-customer-name" value="" placeholder="Customer Name" data-required="1">';
    html += '                                        <div class="errordiv Station' + key + 'CustomerName"><div class="arrow"></div>Not Empty!</div>';
    html += '                                    </div>';
    html += '                                </div>';
    html += '                            </div>';
    html += '                        </div>';
    html += '                        <div class="form-group">';
    html += '                            <div class="col-sm-4 control-label">Meeting Address <span style="color:red">*</span></div>';
    html += '                            <div class="col-sm-8">';
    html += '                                <input type="text" id="Station' + key + 'MeetingAddress" name="Station[' + key + '][MeetingAddress]" class="form-control" value="" placeholder="Meeting Address" data-required="1">';
    html += '                                <div class="errordiv Station' + key + 'MeetingAddress"><div class="arrow"></div>Not Empty!</div>';
    html += '                            </div>';
    html += '                        </div>';
    html += '                        <div class="form-group">';
    html += '                            <div class="col-sm-4 control-label">Customer Contact <span style="color:red">*</span></div>';
    html += '                            <div class="col-sm-8">';
    html += '                                <div class="row">';
    html += '                                    <div class="col-sm-4">';
    html += '                                       <input type="text" id="Station' + key + 'CustomerContact" name="Station[' + key + '][CustomerContact]" class="form-control" value="" placeholder="Customer Contact" data-required="1">';
    html += '                                       <div class="errordiv Station' + key + 'CustomerContact"><div class="arrow"></div>Not Empty!</div>';
    html += '                                    </div>';
    html += '                                    <div class="col-sm-4 control-label">Position <span style="color:red">*</span></div>';
    html += '                                    <div class="col-sm-4">';
    html += '                                       <input type="text" id="Station' + key + 'Position" name="Station[' + key + '][Position]" class="form-control" value="" placeholder="Position" data-required="1">';
    html += '                                       <div class="errordiv Station' + key + 'Position"><div class="arrow"></div>Not Empty!</div>';
    html += '                                    </div>';
    html += '                                </div>';
    html += '                            </div>';
    html += '                        </div>';
    html += '                        <div class="form-group">';
    html += '                            <div class="col-sm-4 control-label">Email <span style="color:red">*</span></div>';
    html += '                            <div class="col-sm-8">';
    html += '                                <div class="row">';
    html += '                                    <div class="col-sm-4">';
    html += '                                       <input type="text" id="Station' + key + 'Email" name="Station[' + key + '][Email]" class="form-control" value="" placeholder="Email" data-required="1">';
    html += '                                       <div class="errordiv Station' + key + 'Email"><div class="arrow"></div>Not Empty!</div>';
    html += '                                    </div>';
    html += '                                    <div class="col-sm-4 control-label">Phone <span style="color:red">*</span></div>';
    html += '                                    <div class="col-sm-4">';
    html += '                                       <input type="text" id="Station' + key + 'Phone" name="Station[' + key + '][Phone]" class="form-control" value="" placeholder="Phone" data-required="1">';
    html += '                                       <div class="errordiv Station' + key + 'Phone"><div class="arrow"></div>Not Empty!</div>';
    html += '                                    </div>';
    html += '                                </div>';
    html += '                            </div>';
    html += '                        </div>';
    html += '                        <div class="form-group">';
    html += '                            <div class="col-sm-4 control-label">Introduce Line Card <span style="color:red">*</span></div>';
    html += '                            <div class="col-sm-8">';
    html += '                                <div class="form-control" contenteditable></div>';
    html += '                                <textarea class="form-control" rows="1" id="Station' + key + 'IntroduceLineCard" name="Station[' + key + '][IntroduceLineCard]" placeholder="Customer Introduced" data-required="1"></textarea>';
    html += '                                <div class="errordiv Station' + key + 'IntroduceLineCard"><div class="arrow"></div>Not Empty!</div>';
    html += '                            </div>';
    html += '                        </div>';
    html += '                        <div class="form-group">';
    html += '                            <div class="col-sm-4 control-label">Meeting Agenda <span style="color:red">*</span></div>';
    html += '                            <div class="col-sm-8">';
    html += '                                <div class="form-control" contenteditable></div>';
    html += '                                <textarea class="form-control" rows="1" id="Station' + key + 'MeetingAgenda" name="Station[' + key + '][MeetingAgenda]" placeholder="Meeting Agenda" data-required="1"></textarea>';
    html += '                                <div class="errordiv Station' + key + 'MeetingAgenda"><div class="arrow"></div>Not Empty!</div>';
    html += '                            </div>';
    html += '                        </div>';
    html += '                    </div>';
    html += '                    <div class="row">';
    html += '                    <div class="col-sm-6">';
    html += '                    <div class="form-group">';
    html += '                        <div class="col-sm-4 control-label">Carrier ID <span style="color:red">*</span></div>';
    html += '                            <div class="col-sm-8">';
    html += '                               <div class="row"> ';
    html += '                                   <div class="col-sm-5">';
    html += '                                        <select id="Station' + key + 'CarrierID" name="Station[' + key + '][CarrierID]" class="form-control" data-required="1">' + staff_options + '</select>';
    html += '                                        <div class="errordiv Station' + key + 'CarrierID"><div class="arrow"></div>Not Empty!</div>';
    html += '                                    </div>';
    html += '                                    <div class="col-sm-3 control-label">Project ID</div>';
    html += '                                    <div class="col-sm-4">';
    html += '                                        <select id="Station' + key + 'ProjectID" name="Station[' + key + '][ProjectID]" class="form-control station-project"><option value="">Select...</option></select>';
    html += '                                        <div class="errordiv Station' + key + 'ProjectID"><div class="arrow"></div>Not Empty!</div>';
    html += '                                     </div>  ';
    html += '                                </div>  ';
    html += '                           </div> ';
    html += '                    </div>  ';
    html += '                        <div class="form-group">';
    html += '                            <div class="col-sm-4 control-label">Region <span style="color:red">*</span></div>';
    html += '                            <div class="col-sm-8">';
    html += '                                <div class="row">';
    html += '                                    <div class="col-sm-5">';
    html += '                                       <select id="Station' + key + 'Region" name="Station[' + key + '][Region]" class="form-control" data-required="1">' + region_options + '</select>';
    html += '                                       <div class="errordiv Station' + key + 'Region"><div class="arrow"></div>Not Empty!</div>';
    html += '                                    </div>';
    html += '                                    <div class="col-sm-3 control-label">Meeting Date <span style="color:red">*</span></div>';
    html += '                                    <div class="col-sm-4">';
    html += '                                       <input type="text" id="Station' + key + 'MeetingDate" name="Station[' + key + '][MeetingDate]" class="form-control bootstrap-datepicker" value="" placeholder="Meeting Date" data-required="1">';
    html += '                                       <div class="errordiv Station' + key + 'MeetingDate"><div class="arrow"></div>Not Empty!</div>';
    html += '                                    </div>';
    html += '                                </div>';
    html += '                            </div>';
    html += '                        </div>';
    html += '                        <div class="form-group">';
    html += '                            <div class="col-sm-4 control-label">Meeting Time <span style="color:red">*</span></div>';
    html += '                            <div class="col-sm-8">';
    html += '                                <div class="row">';
    html += '                                    <div class="col-sm-5">';
    html += '                                       <input type="text" id="Station' + key + 'MeetingTime" name="Station[' + key + '][MeetingTime]" class="form-control bootstrap-timepicker" value="" placeholder="Meeting Time (AM or OM)" data-required="1">';
    html += '                                       <div class="errordiv Station' + key + 'MeetingTime"><div class="arrow"></div>Not Empty!</div>';
    html += '                                    </div>';
    html += '                                    <div class="col-sm-3 control-label">Duration <span style="color:red">*</span></div>';
    html += '                                    <div class="col-sm-4">';
    html += '                                       <div class="input-group">';
    html += '                                           <input type="number" id="Station' + key + 'Duration" name="Station[' + key + '][Duration]" min="0" class="form-control" value="" placeholder="Duration (mins)" data-required="1">';
    html += '                                           <div class="errordiv Station' + key + 'Duration"><div class="arrow"></div>Not Empty!</div>';
    html += '                                           <div class="input-group-addon">mins</div>';
    html += '                                       </div>';
    html += '                                    </div>';
    html += '                                </div>';
    html += '                            </div>';
    html += '                        </div>';
    html += '                        <div class="form-group">';
    html += '                            <div class="col-sm-4 control-label">Board at <span style="color:red">*</span></div>';
    html += '                            <div class="col-sm-8">';
    html += '                                <input type="text" id="Station' + key + 'BoardAt" name="Station[' + key + '][BoardAt]" class="form-control" value="" placeholder="Board at" data-required="1">';
    html += '                                <div class="errordiv Station' + key + 'BoardAt"><div class="arrow"></div>Not Empty!</div>';
    html += '                            </div>';
    html += '                        </div>';;
    html += '                        <div class="form-group">';
    html += '                            <div class="col-sm-4 control-label">Alight at <span style="color:red">*</span></div>';
    html += '                            <div class="col-sm-8">';
    html += '                               <input type="text" id="Station' + key + 'AlightAt" name="Station[' + key + '][AlightAt]" class="form-control" value="" placeholder="Alight at" data-required="1">';
    html += '                               <div class="errordiv Station' + key + 'AlightAt"><div class="arrow"></div>Not Empty!</div>';
    html += '                            </div>';
    html += '                        </div>';
    html += '                        <div class="form-group">';
    html += '                            <div class="col-sm-4 control-label">Distance <span style="color:red">*</span></div>';
    html += '                            <div class="col-sm-8">';
    html += '                                <div class="row">';
    html += '                                    <div class="col-sm-4">';
    html += '                                       <div class="input-group">';
    html += '                                           <input type="number" id="Station' + key + 'Distance" name="Station[' + key + '][Distance]" min="0" class="form-control" value="" placeholder="Distance (km)" data-required="1">';
    html += '                                           <div class="errordiv Station' + key + 'Distance"><div class="arrow"></div>Not Empty!</div>';
    html += '                                           <div class="input-group-addon">km</div>';
    html += '                                       </div>';
    html += '                                    </div>';
    html += '                                    <div class="col-sm-4 control-label">Moving Time <span style="color:red">*</span></div>';
    html += '                                    <div class="col-sm-4">';
    html += '                                       <div class="input-group">';
    html += '                                           <input type="number" id="Station' + key + 'MovingTime" name="Station[' + key + '][MovingTime]" min="0" class="form-control" value="" placeholder="Moving Time (mins)" data-required="1">';
    html += '                                           <div class="errordiv Station' + key + 'MovingTime"><div class="arrow"></div>Not Empty!</div>';
    html += '                                           <div class="input-group-addon">mins</div>';
    html += '                                       </div>';
    html += '                                    </div>';
    html += '                                </div>';
    html += '                            </div>';
    html += '                        </div>';
    html += '                        <div class="form-group">';
    html += '                            <div class="col-sm-4 control-label">ATC\'s Value After Meeting <span style="color:red">*</span></div>';
    html += '                            <div class="col-sm-8">';
    html += '                                <div class="form-control" contenteditable></div>';
    html += '                               <textarea class="form-control" rows="1" id="Station' + key + 'ValueAfterMeeting" name="Station[' + key + '][ValueAfterMeeting]" placeholder="ATC\'s Value After Meeting" data-required="1"></textarea>';
    html += '                               <div class="errordiv Station' + key + 'ValueAfterMeeting"><div class="arrow"></div>Not Empty!</div>';
    html += '                            </div>';
    html += '                        </div>';
    html += '                    </div>';
    html += '                </div>';
    html += '            </div>';
    html += '            <div role="tabpanel" class="tab-pane" id="cost' + key + '">';
    html += '               <div class="station-stt">';
    html += '                   <div class="col-sm-4 control-label">Status</div>';
    html += '                   <div class="col-sm-8"><select id="Station' + key + 'StatusCost" name="Station[' + key + '][StatusCost]" class="form-control">' + cost_status_options +'</select></div>';
    html += '               </div>';
    html += '               <div class="row">';
    html += '                   <div class="col-sm-12">';
    html += '                       <div class="form-group">';
    html += '                           <b>Eating & Drinking</b><a href="javascript:;" class="add-cost-item add-eat-drink-item"><i class="fa fa-plus-square-o"></i></a>';
    html += '                       </div>';
    html += '                       <div class="eat-drink-list"></div>';
    html += '                       <div class="form-group"><b>Moving</b><a href="javascript:;" class="add-cost-item add-moving-item"><i class="fa fa-plus-square-o"></i></a></div>';
    html += '                       <div class="moving-list"></div>';
    html += '                       <div class="form-group"><b>Present</b><a href="javascript:;" class="add-cost-item add-present-item"><i class="fa fa-plus-square-o"></i></a></div>';
    html += '                       <div class="present-list"></div>';
    html += '                   </div>';
    html += '                </div>';
    html += '            </div>';
    html += '            <div role="tabpanel" class="tab-pane" id="report' + key + '">';
    html += '               <div class="station-stt">';
    html += '                   <div class="col-sm-4 control-label">Status</div>';
    html += '                   <div class="col-sm-8"><select id="Station' + key + 'StatusReport" name="Station[' + key + '][StatusReport]" class="form-control">' + report_status_options + '</select></div>';
    html += '               </div>';
    html += '                <div class="row">';
    html += '                   <div class="col-sm-12">';
    html += '                       <div class="form-group">';
    html += '                           <b>Attender</b><a href="javascript:;" class="add-cost-item add-attender-item"><i class="fa fa-plus-square-o"></i></a>';
    html += '                       </div>';
    html += '                       <div class="attender-list"></div>';
    html += '                       <div class="form-group"><b>Introduce</b></div>';
    html += '                       <div class="introduce-list">';
    html += '                           <div class="form-group" data-id="1">';
    html += '                               <div class="col-sm-6">';
    html += '                                   <label>Introduce</label>';
    html += '                                   <div class="form-control" contenteditable></div>';
    html += '                                   <textarea name="Station[' + key + '][CustomerIntroduce]" class="form-control" rows="1" placeholder="Customer Introduce"></textarea>';
    html += '                               </div>';
    html += '                               <div class="col-sm-6">';
    html += '                                   <label>&nbsp;</label>';
    html += '                                   <div class="form-control" contenteditable></div>';
    html += '                                   <textarea name="Station[' + key + '][ATCIntroduce]" class="form-control" rows="1" placeholder="ATC\'s Introduce"></textarea>';
    html += '                               </div>';
    html += '                           </div>';
    html += '                       </div>';
    html += '                       ';
    html += '                       <div class="form-group"><b>Request</b><a href="javascript:;" class="add-cost-item add-request-item"><i class="fa fa-plus-square-o"></i></a></div>';
    html += '                       <div class="request-list"></div>';
    html += '                       <div class="form-group"><b>Action Plan</b><a href="javascript:;" class="add-cost-item add-actionplan-item"><i class="fa fa-plus-square-o"></i></a></div>';
    html += '                       <div class="actionplan-list"></div>';
    html += '                   </div>';
    html += '               </div>';
    html += '            </div>';
    html += '        </div>';
    html += '    </div>';
    html += '</div>';
    html += '</div>';

    return html;
}