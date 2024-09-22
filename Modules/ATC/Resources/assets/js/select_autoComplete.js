$(document).ready(function() {
    setTimeout(function(){
        autoComplete();
        $('.select-autoComplete-user').chosen('destroy');
        $('.select-autoComplete-Follower').chosen('destroy');
        $('.select-autoComplete-approved').chosen('destroy');
        $('.select-autoComplete-customer').chosen('destroy');
        $('.select-autoComplete-linecard').chosen('destroy');
        $('.select-autoComplete-created-by').chosen('destroy');
        $('.select-autoComplete-CompanyName').chosen('destroy');
        $('.select-autoComplete-VendorName').chosen('destroy');
    }, 2000);
    function autoComplete(){
        $selectElement =  $('.select-autoComplete-VendorName').select2({
            placeholder: 'Select Vendor Name',
            ajax: {
                url: site_url + 'ajax/VendorName',
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
            }
        });
        $('.select-autoComplete-CompanyName').select2({
            placeholder: 'Select An Company Name',
            ajax: {
                url: site_url + 'ajax/CompanyName',
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
            }
        });
        $('.select-autoComplete-created-by').select2({
            placeholder: 'Select An User',
            ajax: {
                url: site_url + 'ajax/UserID',
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
            }
        });
        $('.select-autoComplete-user').select2({
            placeholder: 'Select An User',
            ajax: {
                url: site_url + 'ajax/UserID',
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
            }
        });
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
        $('.select-autoComplete-linecard').select2({
            placeholder: 'Select An User Name',
            ajax: {
                url: site_url + 'ajax/LineCardID',
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
            }
        });
        $('.select-autoComplete-approved').select2({
            placeholder: 'Select An User Name Approved',
            ajax: {
                url: site_url + 'ajax/UserID',
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

            }
        });
        $('.select-autoComplete-Follower').select2({
            placeholder: 'Select An User Name Follower',
            ajax: {
                url: site_url + 'ajax/UserID',
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
            }
        });
        $('.select-autoComplete-Follower').one('select2:open', function(e) {
            $('input.select2-search__field').prop('placeholder', 'Follower Name');
        });
        $('.select-autoComplete-approved').one('select2:open', function(e) {
            $('input.select2-search__field').prop('placeholder', 'Approved Name');
        });
        $('.select-autoComplete-user').one('select2:open', function(e) {
            $('input.select2-search__field').prop('placeholder', 'Sale Name');
        });
        $('.select-autoComplete-customer').one('select2:open', function(e) {
            $('input.select2-search__field').prop('placeholder', 'Customer Name');
        });
        $('.select-autoComplete-CompanyName').one('select2:open', function(e) {
            $('input.select2-search__field').prop('placeholder', 'Company Name');
        });
        $('.select-autoComplete-VendorName').one('select2:open', function(e) {
            $('input.select2-search__field').prop('placeholder', 'Vendor Name');
        });
        $('.select-autoComplete-created-by').one('select2:open', function(e) {
            $('input.select2-search__field').prop('placeholder', 'Created By Name');
        });
    }
});