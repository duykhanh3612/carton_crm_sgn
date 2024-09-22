jQuery(document).ready(function($){
    var shopifyFilterStores = $('select#shopify_filter_store').val();
    if(shopifyFilterStores){
        $.each(shopifyFilterStores, function(index, val){
             $('select#shopify_filter_brand_mappingright_value').children('option[value="' + val + '"]').hide();
        });
    }
    function submitFilter(data){
        $.ajax({
          url: filterUrl,
          type: 'GET',
          data: data,
          dataType: 'JSON',
          success: function success(response) {
             console.log(response);
          }
        });
    }
    $('select#shopify_filter_store').change(function(){
        newVal = $(this).val();
        $('select#shopify_filter_brand_mappingright_value').children('option').show();
        var shopifyFilterStores = $('select#shopify_filter_store').val();
        if(shopifyFilterStores){
            $.each(shopifyFilterStores, function(index, val){
                 $('select#shopify_filter_brand_mappingright_value').children('option[value="' + val + '"]').hide();
            });
        }
        let data = {
          'newVal': newVal,
          'oldVal': filterStore,
          'type': 'filterStore'
        };
        filterStore = newVal;
        submitFilter(data);
    });
    $('input#shopify_filter_out_of_stock_threshold').change(function(){
        newVal = $(this).val();
        let data = {
          'newVal': newVal,
          'oldVal': filterOutOfStockThreshold,
          'type': 'filterOutOfStockThreshold'
        };
        filterOutOfStockThreshold = newVal;
        submitFilter(data);
    });
    $('#form_mapping_shopify_filter_brand_mapping button[type="submit"]').click(function(){
	    newVal = $('#shopify_filter_brand_mappingleft_value').val();
        oldVal = $('#shopify_filter_brand_mappingright_value').val();
        let data = {
          'newVal': newVal,
          'oldVal': oldVal,
          'type': 'addBrand'
        };
        submitFilter(data);
        window.location.reload();
    });
    $('#table_setting_mapping_shopify_filter_brand_mapping a').click(function(){
        newVal = $(this).parents('tr').data('left_value');
        oldVal = $(this).parents('tr').find("td:eq(1)").html();
        let data = {
          'newVal': newVal,
          'oldVal': oldVal,
          'type': 'removeBrand'
        };
        submitFilter(data);
    });
    $('#form_mapping_shopify_filter_price_status_mapping button[type="submit"]').click(function(){
        newVal = $('#shopify_filter_price_status_mappingleft_value').val();
        oldVal = $('#shopify_filter_price_status_mappingright_value').val();
        let data = {
          'newVal': newVal,
          'oldVal': oldVal,
          'type': 'addPriceStatus'
        };
        submitFilter(data);
    });
    $('#shopify_filter_brand_field, #shopify_filter_price_status_field').change(function(){
        setTimeout(function(){ window.location.reload(); }, 1000);
    });
});