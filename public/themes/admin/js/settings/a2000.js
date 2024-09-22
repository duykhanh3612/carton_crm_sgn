jQuery(document).ready(function ($) {
    $('.customer_number_setting, .customer_number_import_setting').change(function () {
        let key = 'a2000_location_routing';
        let locationId = $(this).attr('locationid');
        let valueKey = $(this).attr('valuekey');
        let data = {
            'key': key,
            'location_id': locationId,
            'value_key': valueKey,
            'value': $(this).val()
        };

        $(this).submitDataAjax({
            'url': '/a2000/update-location-routing',
            'method': 'POST',
            'data': data,
            'success': function success(res) {
            }
        });
    });

    $('.checkbox-multiple').change(function () {
        let key = $(this).attr('key');

        let $inputs = $(this).parents('form').find('input');
        let values = [];
        $inputs.each(function() {
            if ($(this).is(':checked')) {
                values.push($(this).attr('id'));
            }
        });

        let data = {
            'hs_key': key,
            'hs_val': values
        };

        $(this).submitDataAjax({
            'url': '/update-user-setting',
            'method': 'POST',
            'data': data,
            'success': function success(res) {
            }
        });
    });
});
