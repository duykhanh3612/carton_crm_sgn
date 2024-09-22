<style type="text/css">

    .nav-justified > li, .nav-tabs.nav-justified > li {
    display: table-cell;
    width: 1%;
}
    .nav {
    list-style: outside none none;
}
    .nav-justified > li, .nav-tabs.nav-justified > li {
    float: none;
}
.nav > li > a {
    display: block;
    padding: 10px 15px;
    position: relative;
}
.form-group
{
    padding-top:10px;
   line-height:30px;
   width:100%;
   clear:both;
}
</style>

    <div class="container-fluid">
        <!--<div class="alert alert-danger alert-dismissible">
            <i class="fa fa-exclamation-circle"></i> Warning: You do not have permission to access the API! 
            <button type="button" class="close" data-dismiss="alert">×</button>
        </div>-->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> Edit Order</h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal">
                    <ul id="order" class="nav nav-tabs nav-justified">
                        <li class="active"><a href="#tab-customer" data-toggle="tab">1. Thông tin đơn hàng</a></li>
                        <li class=""><a href="#tab-cart" data-toggle="tab">2. Thông tin sản phẩm</a></li>
                        <li class=""><a href="#tab-payment" data-toggle="tab">3. Payment </a></li>
                        <li class=""><a href="#tab-shipping" data-toggle="tab">4. Shipping </a></li>
                        <!--<li class="disabled"><a href="#tab-total" data-toggle="tab">5. Totals</a></li>-->
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab-customer">
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-customer">Mã đơn hàng</label>
                                <div class="col-sm-10">
                                    <input name="track_code" value="{{@$row->track_code}}" placeholder="" id="track_code" class="form-control" autocomplete="off" type="text">
                                    <ul class="dropdown-menu"></ul>
                                    <input name="customer_id" value="22947" type="hidden">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-customer-group">Ngày cập nhật</label>
                                <div class="col-sm-10">
                                    <input name="created_at" value="{{@$row->created_at}}" id="created_at" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-firstname">Người cập nhật</label>
                                <div class="col-sm-10">
                                    <input name="user_id" value="" id="user_id" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <fieldset>
                                    <legend>Tình trạng</legend>
                                    <div class="form-group required">
                                        <label class="col-sm-2 control-label" for="input-lastname">Trạng thái thanh toán</label>
                                        <div class="col-sm-10">
                                            <label>
                                                <a tag-href="#tab-payment">
                                                    {{App\Model\md::scalar('od_order_payment',"id='".@$row->order_payment."'",'name')}}                                                  
                                                </a>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group required">
                                        <label class="col-sm-2 control-label" for="input-email">Trạng thái vận chuyển</label>
                                        <div class="col-sm-10">
                                            <label>
                                                <a tag-href="#tab-shipping">
                                                    {{App\Model\md::scalar('od_order_tranfer',"id='".@$row->order_tranfer."'",'name')}}
                                                </a>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group required">
                                        <label class="col-sm-2 control-label" for="input-telephone">Tổng tiền</label>
                                        <div class="col-sm-10">
                                            <label>
                                                <a tag-href="#tab-cart">
                                                    {{number_format(@$row->total_price)}}
                                                </a>
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>  
                            </div>
                                

                            <!--<div class="text-right ">
                                <button type="button" id="button-customer" data-loading-text="Loading..." class="btn btn-primary pad5_top"><i class="fa fa-arrow-right"></i> Continue</button>
                            </div>-->
                        </div>
                        <div class="tab-pane" id="tab-cart">                            
                            <div class="tab-content">
                       
                                    <fieldset>
                                        <legend>Sản phẩm</legend>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="input-product">Tên sản phẩm</label>
                                            <div class="col-sm-10">
                                                <input name="product" value="" id="input-product" class="form-control" autocomplete="off" type="text"><ul class="dropdown-menu"></ul>
                                                <input name="product_id" value="" type="hidden">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="input-quantity">giá</label>
                                            <div class="col-sm-10">
                                                <input name="quantity" value="1" id="input-quantity" class="form-control" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="input-quantity">Số lương</label>
                                            <div class="col-sm-10">
                                                <input name="quantity" value="1" id="input-quantity" class="form-control" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="input-quantity">Tạm tính</label>
                                            <div class="col-sm-10">
                                                <input name="quantity" value="1" id="input-quantity" class="form-control" type="text">
                                            </div>
                                        </div>
                                       
                                        <div id="option"></div>
                                    </fieldset>

                                    <fieldset>
                                        <legend>Voucher</legend>
                                        <div class="form-group required">
                                            <label class="col-sm-2 control-label" for="input-to-name">Mã giảm giá</label>
                                            <div class="col-sm-10">
                                                <input name="to_name" value="" id="input-to-name" class="form-control" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <label class="col-sm-2 control-label" for="input-to-email">Số tiền giảm</label>
                                            <div class="col-sm-10">
                                                <input name="to_email" value="" id="input-to-email" class="form-control" type="text">
                                            </div>
                                        </div>

                                    </fieldset>

                                    <fieldset>
                                        <legend>&nbsp;</legend>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="input-quantity">Thành tiền</label>
                                            <div class="col-sm-10">
                                                <input name="quantity" value="1" id="input-quantity" class="form-control" type="text">
                                            </div>
                                        </div>
                                    </fieldset>                                   

                            </div>    
                        </div>
                        <div class="tab-pane" id="tab-payment">
                            <div class="form-group" style="border-bottom:1px dashed;margin-top:20px;padding-top:5px;clear:both;">
                                <!--<hr style="border-top:3px solid;width:100%;clear: both;" />-->
                                <label style="font-size:24px;">Thông tin thanh toán
                                </label>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-payment-firstname">Họ tên</label>
                                <div class="col-sm-10">
                                    <input name="payment_full_name" value="{{@$row->payment_full_name}}" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-payment-lastname">Email</label>
                                <div class="col-sm-10">
                                    <input name="payment_email" value="{{@$row->payment_email}}" class="form-control" type="email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-payment-company">Điện thoại</label>
                                <div class="col-sm-10">
                                    <input name="payment_phone" value="{{@$row->payment_phone}}" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-payment-address-1">Địa chỉ giao hàng</label>
                                <div class="col-sm-10">
                                    <input name="payment_address" value="{{@$row->payment_address}}"  class="form-control" type="text">
                                </div>
                            </div>
                            <div class="form-group" style="border-bottom:1px dashed;margin-top:20px;padding-top:5px;clear:both;">
                                <!--<hr style="border-top:3px solid;width:100%;clear: both;" />-->
                                <label style="font-size:24px;">Trạng thái thanh toán
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-payment-address">Trạng thái thanh toán:</label>
                                <div class="col-sm-10">
                                    <select name="order_payment" id="order_payment" class="form-control">
                                        <option value="0" selected="selected"> --- None --- </option>
                                        @foreach(App\Model\md::find_all('od_order_payment') as $ot)
                                        <option value="{{@$ot->id}}">{{    @$ot->name}}</option>
                                        @endforeach
                                    </select>
                                    <script>
                                        $('#order_payment').val('{{ @$row->order_payment }}')
                                    </script>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane" id="tab-shipping">
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-shipping-address">Trạng thái vận chuyển</label>
                                <div class="col-sm-10">
                                    <select name="order_tranfer" id="order_tranfer" class="form-control">
                                        <option value="0" selected="selected"> --- None --- </option>
                                        @foreach(App\Model\md::find_all('od_order_tranfer') as $ot)
                                        <option value="{{@$ot->id}}">{{    @$ot->name}}</option>
                                        @endforeach
                                    </select>
                                    <script>
                                        $('#order_tranfer').val('{{ @$row->order_tranfer }}')
                                    </script>
                                </div>
                            </div>                           
                        </div>
                        <div class="tab-pane" id="tab-total">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <td class="text-left">Product</td>
                                            <td class="text-left">Model</td>
                                            <td class="text-right">Quantity</td>
                                            <td class="text-right">Unit Price</td>
                                            <td class="text-right">Total</td>
                                        </tr>
                                    </thead>
                                    <tbody id="total">
                                        <tr>
                                            <td class="text-center" colspan="5">No results!</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <fieldset>
                                <legend>Order Details</legend>
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-shipping-method">Shipping Method</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <select name="shipping_method" id="input-shipping-method" class="form-control">
                                                <option value=""> --- Please Select --- </option>
                                                <option value="flat.flat" selected="selected">Flat Shipping Rate</option>
                                            </select>
                                            <span class="input-group-btn">
                                                <button type="button" id="button-shipping-method" data-loading-text="Loading..." class="btn btn-primary">Apply</button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-payment-method">Payment Method</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <select name="payment_method" id="input-payment-method" class="form-control">
                                                <option value=""> --- Please Select --- </option>
                                                <option value="cod" selected="selected">Cash On Delivery</option>
                                            </select>
                                            <span class="input-group-btn">
                                                <button type="button" id="button-payment-method" data-loading-text="Loading..." class="btn btn-primary">Apply</button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-coupon">Coupon</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <input name="coupon" value="" id="input-coupon" class="form-control" type="text">
                                            <span class="input-group-btn">
                                                <button type="button" id="button-coupon" data-loading-text="Loading..." class="btn btn-primary">Apply</button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-voucher">Voucher</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <input name="voucher" value="" id="input-voucher" data-loading-text="Loading..." class="form-control" type="text">
                                            <span class="input-group-btn">
                                                <button type="button" id="button-voucher" data-loading-text="Loading..." class="btn btn-primary">Apply</button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-reward">Reward</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <input name="reward" value="" id="input-reward" data-loading-text="Loading..." class="form-control" type="text">
                                            <span class="input-group-btn">
                                                <button type="button" id="button-reward" data-loading-text="Loading..." class="btn btn-primary">Apply</button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-order-status">Order Status</label>
                                    <div class="col-sm-10">
                                        <select name="order_status_id" id="input-order-status" class="form-control">
                                            <option value="7">Canceled</option>
                                            <option value="9">Canceled Reversal</option>
                                            <option value="13">Chargeback</option>
                                            <option value="5">Complete</option>
                                            <option value="8">Denied</option>
                                            <option value="14">Expired</option>
                                            <option value="10">Failed</option>
                                            <option value="1" selected="selected">Pending</option>
                                            <option value="15">Processed</option>
                                            <option value="2">Processing</option>
                                            <option value="11">Refunded</option>
                                            <option value="12">Reversed</option>
                                            <option value="3">Shipped</option>
                                            <option value="16">Voided</option>
                                        </select>
                                        <input name="order_id" value="4448" type="hidden">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-comment">Comment</label>
                                    <div class="col-sm-10">
                                        <textarea name="comment" rows="5" id="input-comment" class="form-control">cash</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-affiliate">Affiliate</label>
                                    <div class="col-sm-10">
                                        <input name="affiliate" value=" " id="input-affiliate" class="form-control" autocomplete="off" type="text"><ul class="dropdown-menu"></ul>
                                        <input name="affiliate_id" value="0" type="hidden">
                                    </div>
                                </div>
                            </fieldset>
                            <div class="row">
                                <div class="col-sm-6 text-left">
                                    <button type="button" onclick="$('select[name=\'shipping_method\']').prop('disabled') ? $('a[href=\'#tab-payment\']').tab('show') : $('a[href=\'#tab-shipping\']').tab('show');" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back</button>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <button type="button" id="button-refresh" data-toggle="tooltip" title="" data-loading-text="Loading..." class="btn btn-warning" data-original-title="Refresh"><i class="fa fa-refresh"></i></button>
                                    <button type="button" id="button-save" class="btn btn-primary"><i class="fa fa-check-circle"></i> Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {!!h::token() !!}
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
&lt;!--
// Disable the tabs
$('#order a[data-toggle=\'tab\']').on('click', function(e) {
	return false;
});

// Currency
$('select[name=\'currency\']').on('change', function() {
	$.ajax({
		url: 'https://demo.opencart.com/index.php?route=api/currency&amp;api_token=&amp;store_id=' + $('select[name=\'store_id\'] option:selected').val(),
		type: 'post',
		data: 'currency=' + $('select[name=\'currency\'] option:selected').val(),
		dataType: 'json',
		crossDomain: true,
		beforeSend: function() {
			$('select[name=\'currency\']').prop('disabled', true);
		},
		complete: function() {
			$('select[name=\'currency\']').prop('disabled', false);
		},
		success: function(json) {
			$('.alert-dismissible, .text-danger').remove();
			$('.form-group').removeClass('has-error');

			if (json['error']) {
				$('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-danger alert-dismissible"&gt;&lt;i class="fa fa-exclamation-circle"&gt;&lt;/i&gt; ' + json['error'] + ' &lt;button type="button" class="close" data-dismiss="alert"&gt;&amp;times;&lt;/button&gt;&lt;/div&gt;');

				// Highlight any found errors
				$('select[name=\'currency\']').closest('.form-group').addClass('has-error');
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('select[name=\'currency\']').trigger('change');

// Customer
$('input[name=\'customer\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=customer/customer/autocomplete&amp;user_token=ULi7h0A9VXa6CSampGlVL4xvj76k9Q2D&amp;filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				json.unshift({
					customer_id: '0',
					customer_group_id: '1',
					name: ' --- None --- ',
					customer_group: '',
					firstname: '',
					lastname: '',
					email: '',
					telephone: '',
					custom_field: [],
					address: []
				});

				response($.map(json, function(item) {
					return {
						category: item['customer_group'],
						label: item['name'],
						value: item['customer_id'],
						customer_group_id: item['customer_group_id'],
						firstname: item['firstname'],
						lastname: item['lastname'],
						email: item['email'],
						telephone: item['telephone'],
						custom_field: item['custom_field'],
						address: item['address']
					}
				}));
			}
		});
	},
	'select': function(item) {
		// Reset all custom fields
		$('#tab-customer input[type=\'text\'], #tab-customer textarea').not('#tab-customer input[name=\'customer\'], #tab-customer input[name=\'customer_id\']').val('');
		$('#tab-customer select option').not($('#tab-customer select[name=\'store_id\'] option, #tab-customer select[name=\'currency\'] option')).removeAttr('selected');
		$('#tab-customer input[type=\'checkbox\'], #tab-customer input[type=\'radio\']').removeAttr('checked');

		$('#tab-customer input[name=\'customer\']').val(item['label']);
		$('#tab-customer input[name=\'customer_id\']').val(item['value']);
		$('#tab-customer select[name=\'customer_group_id\']').val(item['customer_group_id']);
		$('#tab-customer input[name=\'firstname\']').val(item['firstname']);
		$('#tab-customer input[name=\'lastname\']').val(item['lastname']);
		$('#tab-customer input[name=\'email\']').val(item['email']);
		$('#tab-customer input[name=\'telephone\']').val(item['telephone']);

		for (i in item.custom_field) {
			$('#tab-customer select[name=\'custom_field[' + i + ']\']').val(item.custom_field[i]);
			$('#tab-customer textarea[name=\'custom_field[' + i + ']\']').val(item.custom_field[i]);
			$('#tab-customer input[name^=\'custom_field[' + i + ']\'][type=\'text\']').val(item.custom_field[i]);
			$('#tab-customer input[name^=\'custom_field[' + i + ']\'][type=\'hidden\']').val(item.custom_field[i]);
			$('#tab-customer input[name^=\'custom_field[' + i + ']\'][type=\'radio\'][value=\'' + item.custom_field[i] + '\']').prop('checked', true);

			if (item.custom_field[i] instanceof Array) {
				for (j = 0; j &lt; item.custom_field[i].length; j++) {
					$('#tab-customer input[name^=\'custom_field[' + i + ']\'][type=\'checkbox\'][value=\'' + item.custom_field[i][j] + '\']').prop('checked', true);
				}
			}
		}

		$('select[name=\'customer_group_id\']').trigger('change');

		html = '&lt;option value="0"&gt; --- None --- &lt;/option&gt;';

		for (i in  item['address']) {
			html += '&lt;option value="' + item['address'][i]['address_id'] + '"&gt;' + item['address'][i]['firstname'] + ' ' + item['address'][i]['lastname'] + ', ' + item['address'][i]['address_1'] + ', ' + item['address'][i]['city'] + ', ' + item['address'][i]['country'] + '&lt;/option&gt;';
		}

		$('select[name=\'payment_address\']').html(html);
		$('select[name=\'shipping_address\']').html(html);
	}
});

// Custom Fields
$('select[name=\'customer_group_id\']').on('change', function() {
	$.ajax({
		url: 'index.php?route=customer/customer/customfield&amp;user_token=ULi7h0A9VXa6CSampGlVL4xvj76k9Q2D&amp;customer_group_id=' + this.value,
		dataType: 'json',
		success: function(json) {
			$('.custom-field').hide();
			$('.custom-field').removeClass('required');

			for (i = 0; i &lt; json.length; i++) {
				custom_field = json[i];

				$('.custom-field' + custom_field['custom_field_id']).show();

				if (custom_field['required']) {
					$('.custom-field' + custom_field['custom_field_id']).addClass('required');
				}
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('select[name=\'customer_group_id\']').trigger('change');

$('#button-customer').on('click', function() {
	$.ajax({
		url: 'https://demo.opencart.com/index.php?route=api/customer&amp;api_token=&amp;store_id=' + $('select[name=\'store_id\'] option:selected').val(),
		type: 'post',
		data: $('#tab-customer input[type=\'text\'], #tab-customer input[type=\'hidden\'], #tab-customer input[type=\'radio\']:checked, #tab-customer input[type=\'checkbox\']:checked, #tab-customer select, #tab-customer textarea'),
		dataType: 'json',
		crossDomain: true,
		beforeSend: function() {
			$('#button-customer').button('loading');
		},
		complete: function() {
			 $('#button-customer').button('reset');
		},
		success: function(json) {
			$('.alert-dismissible, .text-danger').remove();
			$('.form-group').removeClass('has-error');

			if (json['error']) {
				if (json['error']['warning']) {
					$('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-danger alert-dismissible"&gt;&lt;i class="fa fa-exclamation-circle"&gt;&lt;/i&gt; ' + json['error']['warning'] + ' &lt;button type="button" class="close" data-dismiss="alert"&gt;&amp;times;&lt;/button&gt;&lt;/div&gt;');
				}

				for (i in json['error']) {
					var element = $('#input-' + i.replace('_', '-'));

					if (element.parent().hasClass('input-group')) {
                   		$(element).parent().after('&lt;div class="text-danger"&gt;' + json['error'][i] + '&lt;/div&gt;');
					} else {
						$(element).after('&lt;div class="text-danger"&gt;' + json['error'][i] + '&lt;/div&gt;');
					}
				}

				// Highlight any found errors
				$('.text-danger').parentsUntil('.form-group').parent().addClass('has-error');
			} else {
                // Refresh products, vouchers and totals
                var request_1 = $.ajax({
                    url: 'https://demo.opencart.com/index.php?route=api/cart/add&amp;api_token=&amp;store_id=' + $('select[name=\'store_id\'] option:selected').val(),
                    type: 'post',
                    data: $('#cart input[name^=\'product\'][type=\'text\'], #cart input[name^=\'product\'][type=\'hidden\'], #cart input[name^=\'product\'][type=\'radio\']:checked, #cart input[name^=\'product\'][type=\'checkbox\']:checked, #cart select[name^=\'product\'], #cart textarea[name^=\'product\']'),
                    dataType: 'json',
                    crossDomain: true,
                    beforeSend: function() {
                        $('#button-product-add').button('loading');
                    },
                    complete: function() {
                        $('#button-product-add').button('reset');
                    },
                    success: function(json) {
                        $('.alert-dismissible, .text-danger').remove();
                        $('.form-group').removeClass('has-error');

                        if (json['error'] &amp;&amp; json['error']['warning']) {
                            $('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-danger alert-dismissible"&gt;&lt;i class="fa fa-exclamation-circle"&gt;&lt;/i&gt; ' + json['error']['warning'] + ' &lt;button type="button" class="close" data-dismiss="alert"&gt;&amp;times;&lt;/button&gt;&lt;/div&gt;');
                        }
            		},
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });

                var request_2 = request_1.then(function() {
                    $.ajax({
                        url: 'https://demo.opencart.com/index.php?route=api/voucher/add&amp;api_token=&amp;store_id=' + $('select[name=\'store_id\'] option:selected').val(),
                        type: 'post',
                        data: $('#cart input[name^=\'voucher\'][type=\'text\'], #cart input[name^=\'voucher\'][type=\'hidden\'], #cart input[name^=\'voucher\'][type=\'radio\']:checked, #cart input[name^=\'voucher\'][type=\'checkbox\']:checked, #cart select[name^=\'voucher\'], #cart textarea[name^=\'voucher\']'),
                        dataType: 'json',
                        crossDomain: true,
                        beforeSend: function() {
                            $('#button-voucher-add').button('loading');
                        },
                        complete: function() {
                            $('#button-voucher-add').button('reset');
                        },
                        success: function(json) {
                            $('.alert-dismissible, .text-danger').remove();
                            $('.form-group').removeClass('has-error');

                            if (json['error'] &amp;&amp; json['error']['warning']) {
                                $('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-danger alert-dismissible"&gt;&lt;i class="fa fa-exclamation-circle"&gt;&lt;/i&gt; ' + json['error']['warning'] + ' &lt;button type="button" class="close" data-dismiss="alert"&gt;&amp;times;&lt;/button&gt;&lt;/div&gt;');
                            }
                		},
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                        }
                    });
                });

                request_2.done(function() {
                    $('#button-refresh').trigger('click');

                    $('a[href=\'#tab-cart\']').tab('show');
                });
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('#tab-product input[name=\'product\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/product/autocomplete&amp;user_token=ULi7h0A9VXa6CSampGlVL4xvj76k9Q2D&amp;filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['product_id'],
						model: item['model'],
						option: item['option'],
						price: item['price']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('#tab-product input[name=\'product\']').val(item['label']);
		$('#tab-product input[name=\'product_id\']').val(item['value']);

		if (item['option'] != '') {
 			html  = '&lt;fieldset&gt;';
            html += '  &lt;legend&gt;Choose Option(s)&lt;/legend&gt;';

			for (i = 0; i &lt; item['option'].length; i++) {
				option = item['option'][i];

				if (option['type'] == 'select') {
					html += '&lt;div class="form-group' + (option['required'] ? ' required' : '') + '"&gt;';
					html += '  &lt;label class="col-sm-2 control-label" for="input-option' + option['product_option_id'] + '"&gt;' + option['name'] + '&lt;/label&gt;';
					html += '  &lt;div class="col-sm-10"&gt;';
					html += '    &lt;select name="option[' + option['product_option_id'] + ']" id="input-option' + option['product_option_id'] + '" class="form-control"&gt;';
					html += '      &lt;option value=""&gt; --- Please Select --- &lt;/option&gt;';

					for (j = 0; j &lt; option['product_option_value'].length; j++) {
						option_value = option['product_option_value'][j];

						html += '&lt;option value="' + option_value['product_option_value_id'] + '"&gt;' + option_value['name'];

						if (option_value['price']) {
							html += ' (' + option_value['price_prefix'] + option_value['price'] + ')';
						}

						html += '&lt;/option&gt;';
					}

					html += '    &lt;/select&gt;';
					html += '  &lt;/div&gt;';
					html += '&lt;/div&gt;';
				}

				if (option['type'] == 'radio') {
					html += '&lt;div class="form-group' + (option['required'] ? ' required' : '') + '"&gt;';
					html += '  &lt;label class="col-sm-2 control-label" for="input-option' + option['product_option_id'] + '"&gt;' + option['name'] + '&lt;/label&gt;';
					html += '  &lt;div class="col-sm-10"&gt;';
					html += '    &lt;select name="option[' + option['product_option_id'] + ']" id="input-option' + option['product_option_id'] + '" class="form-control"&gt;';
					html += '      &lt;option value=""&gt; --- Please Select --- &lt;/option&gt;';

					for (j = 0; j &lt; option['product_option_value'].length; j++) {
						option_value = option['product_option_value'][j];

						html += '&lt;option value="' + option_value['product_option_value_id'] + '"&gt;' + option_value['name'];

						if (option_value['price']) {
							html += ' (' + option_value['price_prefix'] + option_value['price'] + ')';
						}

						html += '&lt;/option&gt;';
					}

					html += '    &lt;/select&gt;';
					html += '  &lt;/div&gt;';
					html += '&lt;/div&gt;';
				}

				if (option['type'] == 'checkbox') {
					html += '&lt;div class="form-group' + (option['required'] ? ' required' : '') + '"&gt;';
					html += '  &lt;label class="col-sm-2 control-label"&gt;' + option['name'] + '&lt;/label&gt;';
					html += '  &lt;div class="col-sm-10"&gt;';
					html += '    &lt;div id="input-option' + option['product_option_id'] + '"&gt;';

					for (j = 0; j &lt; option['product_option_value'].length; j++) {
						option_value = option['product_option_value'][j];

						html += '&lt;div class="checkbox"&gt;';

						html += '  &lt;label&gt;&lt;input type="checkbox" name="option[' + option['product_option_id'] + '][]" value="' + option_value['product_option_value_id'] + '" /&gt; ' + option_value['name'];

						if (option_value['price']) {
							html += ' (' + option_value['price_prefix'] + option_value['price'] + ')';
						}

						html += '  &lt;/label&gt;';
						html += '&lt;/div&gt;';
					}

					html += '    &lt;/div&gt;';
					html += '  &lt;/div&gt;';
					html += '&lt;/div&gt;';
				}

				if (option['type'] == 'image') {
					html += '&lt;div class="form-group' + (option['required'] ? ' required' : '') + '"&gt;';
					html += '  &lt;label class="col-sm-2 control-label" for="input-option' + option['product_option_id'] + '"&gt;' + option['name'] + '&lt;/label&gt;';
					html += '  &lt;div class="col-sm-10"&gt;';
					html += '    &lt;select name="option[' + option['product_option_id'] + ']" id="input-option' + option['product_option_id'] + '" class="form-control"&gt;';
					html += '      &lt;option value=""&gt; --- Please Select --- &lt;/option&gt;';

					for (j = 0; j &lt; option['product_option_value'].length; j++) {
						option_value = option['product_option_value'][j];

						html += '&lt;option value="' + option_value['product_option_value_id'] + '"&gt;' + option_value['name'];

						if (option_value['price']) {
							html += ' (' + option_value['price_prefix'] + option_value['price'] + ')';
						}

						html += '&lt;/option&gt;';
					}

					html += '    &lt;/select&gt;';
					html += '  &lt;/div&gt;';
					html += '&lt;/div&gt;';
				}

				if (option['type'] == 'text') {
					html += '&lt;div class="form-group' + (option['required'] ? ' required' : '') + '"&gt;';
					html += '  &lt;label class="col-sm-2 control-label" for="input-option' + option['product_option_id'] + '"&gt;' + option['name'] + '&lt;/label&gt;';
					html += '  &lt;div class="col-sm-10"&gt;&lt;input type="text" name="option[' + option['product_option_id'] + ']" value="' + option['value'] + '" id="input-option' + option['product_option_id'] + '" class="form-control" /&gt;&lt;/div&gt;';
					html += '&lt;/div&gt;';
				}

				if (option['type'] == 'textarea') {
					html += '&lt;div class="form-group' + (option['required'] ? ' required' : '') + '"&gt;';
					html += '  &lt;label class="col-sm-2 control-label" for="input-option' + option['product_option_id'] + '"&gt;' + option['name'] + '&lt;/label&gt;';
					html += '  &lt;div class="col-sm-10"&gt;&lt;textarea name="option[' + option['product_option_id'] + ']" rows="5" id="input-option' + option['product_option_id'] + '" class="form-control"&gt;' + option['value'] + '&lt;/textarea&gt;&lt;/div&gt;';
					html += '&lt;/div&gt;';
				}

				if (option['type'] == 'file') {
					html += '&lt;div class="form-group' + (option['required'] ? ' required' : '') + '"&gt;';
					html += '  &lt;label class="col-sm-2 control-label"&gt;' + option['name'] + '&lt;/label&gt;';
					html += '  &lt;div class="col-sm-10"&gt;';
					html += '    &lt;button type="button" id="button-upload' + option['product_option_id'] + '" data-loading-text="Loading..." class="btn btn-default"&gt;&lt;i class="fa fa-upload"&gt;&lt;/i&gt; Upload&lt;/button&gt;';
					html += '    &lt;input type="hidden" name="option[' + option['product_option_id'] + ']" value="' + option['value'] + '" id="input-option' + option['product_option_id'] + '" /&gt;';
					html += '  &lt;/div&gt;';
					html += '&lt;/div&gt;';
				}

				if (option['type'] == 'date') {
					html += '&lt;div class="form-group' + (option['required'] ? ' required' : '') + '"&gt;';
					html += '  &lt;label class="col-sm-2 control-label" for="input-option' + option['product_option_id'] + '"&gt;' + option['name'] + '&lt;/label&gt;';
					html += '  &lt;div class="col-sm-3"&gt;&lt;div class="input-group date"&gt;&lt;input type="text" name="option[' + option['product_option_id'] + ']" value="' + option['value'] + '" placeholder="' + option['name'] + '" data-date-format="YYYY-MM-DD" id="input-option' + option['product_option_id'] + '" class="form-control" /&gt;&lt;span class="input-group-btn"&gt;&lt;button type="button" class="btn btn-default"&gt;&lt;i class="fa fa-calendar"&gt;&lt;/i&gt;&lt;/button&gt;&lt;/span&gt;&lt;/div&gt;&lt;/div&gt;';
					html += '&lt;/div&gt;';
				}

				if (option['type'] == 'datetime') {
					html += '&lt;div class="form-group' + (option['required'] ? ' required' : '') + '"&gt;';
					html += '  &lt;label class="col-sm-2 control-label" for="input-option' + option['product_option_id'] + '"&gt;' + option['name'] + '&lt;/label&gt;';
					html += '  &lt;div class="col-sm-3"&gt;&lt;div class="input-group datetime"&gt;&lt;input type="text" name="option[' + option['product_option_id'] + ']" value="' + option['value'] + '" placeholder="' + option['name'] + '" data-date-format="YYYY-MM-DD HH:mm" id="input-option' + option['product_option_id'] + '" class="form-control" /&gt;&lt;span class="input-group-btn"&gt;&lt;button type="button" class="btn btn-default"&gt;&lt;i class="fa fa-calendar"&gt;&lt;/i&gt;&lt;/button&gt;&lt;/span&gt;&lt;/div&gt;&lt;/div&gt;';
					html += '&lt;/div&gt;';
				}

				if (option['type'] == 'time') {
					html += '&lt;div class="form-group' + (option['required'] ? ' required' : '') + '"&gt;';
					html += '  &lt;label class="col-sm-2 control-label" for="input-option' + option['product_option_id'] + '"&gt;' + option['name'] + '&lt;/label&gt;';
					html += '  &lt;div class="col-sm-3"&gt;&lt;div class="input-group time"&gt;&lt;input type="text" name="option[' + option['product_option_id'] + ']" value="' + option['value'] + '" placeholder="' + option['name'] + '" data-date-format="HH:mm" id="input-option' + option['product_option_id'] + '" class="form-control" /&gt;&lt;span class="input-group-btn"&gt;&lt;button type="button" class="btn btn-default"&gt;&lt;i class="fa fa-calendar"&gt;&lt;/i&gt;&lt;/button&gt;&lt;/span&gt;&lt;/div&gt;&lt;/div&gt;';
					html += '&lt;/div&gt;';
				}
			}

			html += '&lt;/fieldset&gt;';

			$('#option').html(html);

			$('.date').datetimepicker({
				language: 'en-gb',
				pickTime: false
			});

			$('.datetime').datetimepicker({
				language: 'en-gb',
				pickDate: true,
				pickTime: true
			});

			$('.time').datetimepicker({
				language: 'en-gb',
				pickDate: false
			});
		} else {
			$('#option').html('');
		}
	}
});

$('#button-product-add').on('click', function() {
	$.ajax({
		url: 'https://demo.opencart.com/index.php?route=api/cart/add&amp;api_token=&amp;store_id=' + $('select[name=\'store_id\'] option:selected').val(),
		type: 'post',
		data: $('#tab-product input[name=\'product_id\'], #tab-product input[name=\'quantity\'], #tab-product input[name^=\'option\'][type=\'text\'], #tab-product input[name^=\'option\'][type=\'hidden\'], #tab-product input[name^=\'option\'][type=\'radio\']:checked, #tab-product input[name^=\'option\'][type=\'checkbox\']:checked, #tab-product select[name^=\'option\'], #tab-product textarea[name^=\'option\']'),
		dataType: 'json',
		crossDomain: true,
		beforeSend: function() {
			$('#button-product-add').button('loading');
		},
		complete: function() {
			$('#button-product-add').button('reset');
		},
		success: function(json) {
			$('.alert-dismissible, .text-danger').remove();
			$('.form-group').removeClass('has-error');

			if (json['error']) {
				if (json['error']['warning']) {
					$('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-danger alert-dismissible"&gt;&lt;i class="fa fa-exclamation-circle"&gt;&lt;/i&gt; ' + json['error']['warning'] + ' &lt;button type="button" class="close" data-dismiss="alert"&gt;&amp;times;&lt;/button&gt;&lt;/div&gt;');
				}

				if (json['error']['option']) {
					for (i in json['error']['option']) {
						var element = $('#input-option' + i.replace('_', '-'));

						if (element.parent().hasClass('input-group')) {
							$(element).parent().after('&lt;div class="text-danger"&gt;' + json['error']['option'][i] + '&lt;/div&gt;');
						} else {
							$(element).after('&lt;div class="text-danger"&gt;' + json['error']['option'][i] + '&lt;/div&gt;');
						}
					}
				}

				if (json['error']['store']) {
					$('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-danger alert-dismissible"&gt;&lt;i class="fa fa-exclamation-circle"&gt;&lt;/i&gt; ' + json['error']['store'] + '&lt;/div&gt;');
				}

				// Highlight any found errors
				$('.text-danger').parentsUntil('.form-group').parent().addClass('has-error');
			} else {
				// Refresh products, vouchers and totals
				$('#button-refresh').trigger('click');
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

// Voucher
$('#button-voucher-add').on('click', function() {
	$.ajax({
		url: 'https://demo.opencart.com/index.php?route=api/voucher/add&amp;api_token=&amp;store_id=' + $('select[name=\'store_id\'] option:selected').val(),
		type: 'post',
		data: $('#tab-voucher input[type=\'text\'], #tab-voucher input[type=\'hidden\'], #tab-voucher input[type=\'radio\']:checked, #tab-voucher input[type=\'checkbox\']:checked, #tab-voucher select, #tab-voucher textarea'),
		dataType: 'json',
		crossDomain: true,
		beforeSend: function() {
			$('#button-voucher-add').button('loading');
		},
		complete: function() {
			$('#button-voucher-add').button('reset');
		},
		success: function(json) {
			$('.alert-dismissible, .text-danger').remove();
			$('.form-group').removeClass('has-error');

			if (json['error']) {
				if (json['error']['warning']) {
					$('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-danger alert-dismissible"&gt;&lt;i class="fa fa-exclamation-circle"&gt;&lt;/i&gt; ' + json['error']['warning'] + ' &lt;button type="button" class="close" data-dismiss="alert"&gt;&amp;times;&lt;/button&gt;&lt;/div&gt;');
				}

				for (i in json['error']) {
					var element = $('#input-' + i.replace('_', '-'));

					if (element.parent().hasClass('input-group')) {
						$(element).parent().after('&lt;div class="text-danger"&gt;' + json['error'][i] + '&lt;/div&gt;');
					} else {
						$(element).after('&lt;div class="text-danger"&gt;' + json['error'][i] + '&lt;/div&gt;');
					}
				}

				// Highlight any found errors
				$('.text-danger').parentsUntil('.form-group').parent().addClass('has-error');
			} else {
				$('input[name=\'from_name\']').val('');
				$('input[name=\'from_email\']').val('');
				$('input[name=\'to_name\']').val('');
				$('input[name=\'to_email\']').val('');
				$('textarea[name=\'message\']').val('');
				$('input[name=\'amount\']').val('1');

				// Refresh products, vouchers and totals
				$('#button-refresh').trigger('click');
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('#cart').delegate('.btn-danger', 'click', function() {
	var node = this;

	$.ajax({
		url: 'https://demo.opencart.com/index.php?route=api/cart/remove&amp;api_token=&amp;store_id=' + $('select[name=\'store_id\'] option:selected').val(),
		type: 'post',
		data: 'key=' + encodeURIComponent(this.value),
		dataType: 'json',
		crossDomain: true,
		beforeSend: function() {
			$(node).button('loading');
		},
		complete: function() {
			$(node).button('reset');
		},
		success: function(json) {
			$('.alert-dismissible, .text-danger').remove();

			// Check for errors
			if (json['error']) {
				$('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-danger alert-dismissible"&gt;&lt;i class="fa fa-exclamation-circle"&gt;&lt;/i&gt; ' + json['error'] + ' &lt;button type="button" class="close" data-dismiss="alert"&gt;&amp;times;&lt;/button&gt;&lt;/div&gt;');
			} else {
				// Refresh products, vouchers and totals
				$('#button-refresh').trigger('click');
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('#cart').delegate('.btn-primary', 'click', function() {
    var node = this;

    // Refresh products, vouchers and totals
    $.ajax({
        url: 'https://demo.opencart.com/index.php?route=api/cart/add&amp;api_token=&amp;store_id=' + $('select[name=\'store_id\'] option:selected').val(),
        type: 'post',
        data: $('#cart input[name^=\'product\'][type=\'text\'], #cart input[name^=\'product\'][type=\'hidden\'], #cart input[name^=\'product\'][type=\'radio\']:checked, #cart input[name^=\'product\'][type=\'checkbox\']:checked, #cart select[name^=\'product\'], #cart textarea[name^=\'product\']'),
        dataType: 'json',
        crossDomain: true,
        beforeSend: function() {
            $(node).button('loading');
        },
        complete: function() {
            $(node).button('reset');
        },
        success: function(json) {
            $('.alert-dismissible, .text-danger').remove();
            $('.form-group').removeClass('has-error');

            if (json['error'] &amp;&amp; json['error']['warning']) {
                $('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-danger alert-dismissible"&gt;&lt;i class="fa fa-exclamation-circle"&gt;&lt;/i&gt; ' + json['error']['warning'] + ' &lt;button type="button" class="close" data-dismiss="alert"&gt;&amp;times;&lt;/button&gt;&lt;/div&gt;');
            }

            if (json['success']) {
				$('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-success alert-dismissible"&gt;&lt;i class="fa fa-check-circle"&gt;&lt;/i&gt; ' + json['success'] + ' &lt;button type="button" class="close" data-dismiss="alert"&gt;&amp;times;&lt;/button&gt;&lt;/div&gt;');
			}
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    }).done(function() {
        $('#button-refresh').trigger('click');
    });
});

$('#button-cart').on('click', function() {
	$('a[href=\'#tab-payment\']').tab('show');
});

// Payment Address
$('select[name=\'payment_address\']').on('change', function() {
	$.ajax({
		url: 'index.php?route=customer/customer/address&amp;user_token=ULi7h0A9VXa6CSampGlVL4xvj76k9Q2D&amp;address_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('select[name=\'payment_address\']').prop('disabled', true);
		},
		complete: function() {
			$('select[name=\'payment_address\']').prop('disabled', false);
		},
		success: function(json) {
			// Reset all fields
			$('#tab-payment input[type=\'text\'], #tab-payment input[type=\'text\'], #tab-payment textarea').val('');
			$('#tab-payment select option').not('#tab-payment select[name=\'payment_address\']').removeAttr('selected');
			$('#tab-payment input[type=\'checkbox\'], #tab-payment input[type=\'radio\']').removeAttr('checked');

			$('#tab-payment input[name=\'firstname\']').val(json['firstname']);
			$('#tab-payment input[name=\'lastname\']').val(json['lastname']);
			$('#tab-payment input[name=\'company\']').val(json['company']);
			$('#tab-payment input[name=\'address_1\']').val(json['address_1']);
			$('#tab-payment input[name=\'address_2\']').val(json['address_2']);
			$('#tab-payment input[name=\'city\']').val(json['city']);
			$('#tab-payment input[name=\'postcode\']').val(json['postcode']);
			$('#tab-payment select[name=\'country_id\']').val(json['country_id']);

			payment_zone_id = json['zone_id'];

			for (i in json['custom_field']) {
				$('#tab-payment select[name=\'custom_field[' + i + ']\']').val(json['custom_field'][i]);
				$('#tab-payment textarea[name=\'custom_field[' + i + ']\']').val(json['custom_field'][i]);
				$('#tab-payment input[name^=\'custom_field[' + i + ']\'][type=\'text\']').val(json['custom_field'][i]);
				$('#tab-payment input[name^=\'custom_field[' + i + ']\'][type=\'hidden\']').val(json['custom_field'][i]);
				$('#tab-payment input[name^=\'custom_field[' + i + ']\'][type=\'radio\'][value=\'' + json['custom_field'][i] + '\']').prop('checked', true);
				$('#tab-payment input[name^=\'custom_field[' + i + ']\'][type=\'checkbox\'][value=\'' + json['custom_field'][i] + '\']').prop('checked', true);

				if (json['custom_field'][i] instanceof Array) {
					for (j = 0; j &lt; json['custom_field'][i].length; j++) {
						$('#tab-payment input[name^=\'custom_field[' + i + ']\'][type=\'checkbox\'][value=\'' + json['custom_field'][i][j] + '\']').prop('checked', true);
					}
				}
			}

			$('#tab-payment select[name=\'country_id\']').trigger('change');
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

var payment_zone_id = '3563';

$('#tab-payment select[name=\'country_id\']').on('change', function() {
	$.ajax({
		url: 'index.php?route=localisation/country/country&amp;user_token=ULi7h0A9VXa6CSampGlVL4xvj76k9Q2D&amp;country_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('#tab-payment select[name=\'country_id\']').after(' &lt;i class="fa fa-circle-o-notch fa-spin"&gt;&lt;/i&gt;');
		},
		complete: function() {
			$('#tab-payment .fa-spin').remove();
		},
		success: function(json) {
			if (json['postcode_required'] == '1') {
				$('#tab-payment input[name=\'postcode\']').closest('.form-group').addClass('required');
			} else {
				$('#tab-payment input[name=\'postcode\']').closest('.form-group').removeClass('required');
			}

			html = '&lt;option value=""&gt; --- Please Select --- &lt;/option&gt;';

			if (json['zone'] &amp;&amp; json['zone'] != '') {
				for (i = 0; i &lt; json['zone'].length; i++) {
        			html += '&lt;option value="' + json['zone'][i]['zone_id'] + '"';

					if (json['zone'][i]['zone_id'] == payment_zone_id) {
	      				html += ' selected="selected"';
	    			}

	    			html += '&gt;' + json['zone'][i]['name'] + '&lt;/option&gt;';
				}
			} else {
				html += '&lt;option value="0" selected="selected"&gt; --- None --- &lt;/option&gt;';
			}

			$('#tab-payment select[name=\'zone_id\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('#tab-payment select[name=\'country_id\']').trigger('change');

$('#button-payment-address').on('click', function() {
	$.ajax({
		url: 'https://demo.opencart.com/index.php?route=api/payment/address&amp;api_token=&amp;store_id=' + $('select[name=\'store_id\'] option:selected').val(),
		type: 'post',
		data: $('#tab-payment input[type=\'text\'], #tab-payment input[type=\'hidden\'], #tab-payment input[type=\'radio\']:checked, #tab-payment input[type=\'checkbox\']:checked, #tab-payment select, #tab-payment textarea'),
		dataType: 'json',
		crossDomain: true,
		beforeSend: function() {
			$('#button-payment-address').button('loading');
		},
		complete: function() {
			$('#button-payment-address').button('reset');
		},
		success: function(json) {
			$('.alert-dismissible, .text-danger').remove();
			$('.form-group').removeClass('has-error');

			// Check for errors
			if (json['error']) {
				if (json['error']['warning']) {
					$('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-danger alert-dismissible"&gt;&lt;i class="fa fa-exclamation-circle"&gt;&lt;/i&gt; ' + json['error']['warning'] + ' &lt;button type="button" class="close" data-dismiss="alert"&gt;&amp;times;&lt;/button&gt;&lt;/div&gt;');
				}

				for (i in json['error']) {
					var element = $('#input-payment-' + i.replace('_', '-'));

					if ($(element).parent().hasClass('input-group')) {
						$(element).parent().after('&lt;div class="text-danger"&gt;' + json['error'][i] + '&lt;/div&gt;');
					} else {
						$(element).after('&lt;div class="text-danger"&gt;' + json['error'][i] + '&lt;/div&gt;');
					}
				}

				// Highlight any found errors
				$('.text-danger').parentsUntil('.form-group').parent().addClass('has-error');
			} else {
				// Payment Methods
				$.ajax({
					url: 'https://demo.opencart.com/index.php?route=api/payment/methods&amp;api_token=&amp;store_id=' + $('select[name=\'store_id\'] option:selected').val(),
					dataType: 'json',
					crossDomain: true,
					beforeSend: function() {
						$('#button-payment-address').button('loading');
					},
					complete: function() {
						$('#button-payment-address').button('reset');
					},
					success: function(json) {
						if (json['error']) {
							$('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-danger alert-dismissible"&gt;&lt;i class="fa fa-exclamation-circle"&gt;&lt;/i&gt; ' + json['error'] + ' &lt;button type="button" class="close" data-dismiss="alert"&gt;&amp;times;&lt;/button&gt;&lt;/div&gt;');
						} else {
							html = '&lt;option value=""&gt; --- Please Select --- &lt;/option&gt;';

							if (json['payment_methods']) {
								for (i in json['payment_methods']) {
									if (json['payment_methods'][i]['code'] == $('select[name=\'payment_method\'] option:selected').val()) {
										html += '&lt;option value="' + json['payment_methods'][i]['code'] + '" selected="selected"&gt;' + json['payment_methods'][i]['title'] + '&lt;/option&gt;';
									} else {
										html += '&lt;option value="' + json['payment_methods'][i]['code'] + '"&gt;' + json['payment_methods'][i]['title'] + '&lt;/option&gt;';
									}
								}
							}

							$('select[name=\'payment_method\']').html(html);
						}
					},
					error: function(xhr, ajaxOptions, thrownError) {
						alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				}).done(function() {
                    // Refresh products, vouchers and totals
    				$('#button-refresh').trigger('click');

    				// If shipping required got to shipping tab else total tabs
    				if ($('select[name=\'shipping_method\']').prop('disabled')) {
    					$('a[href=\'#tab-total\']').tab('show');
    				} else {
    					$('a[href=\'#tab-shipping\']').tab('show');
    				}
                });
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

// Shipping Address
$('select[name=\'shipping_address\']').on('change', function() {
	$.ajax({
		url: 'index.php?route=customer/customer/address&amp;user_token=ULi7h0A9VXa6CSampGlVL4xvj76k9Q2D&amp;address_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('select[name=\'shipping_address\']').prop('disabled', true);
		},
		complete: function() {
			$('select[name=\'shipping_address\']').prop('disabled', false);
		},
		success: function(json) {
			// Reset all fields
			$('#tab-shipping input[type=\'text\'], #tab-shipping input[type=\'text\'], #tab-shipping textarea').val('');
			$('#tab-shipping select option').not('#tab-shipping select[name=\'shipping_address\']').removeAttr('selected');
			$('#tab-shipping input[type=\'checkbox\'], #tab-shipping input[type=\'radio\']').removeAttr('checked');

			$('#tab-shipping input[name=\'firstname\']').val(json['firstname']);
			$('#tab-shipping input[name=\'lastname\']').val(json['lastname']);
			$('#tab-shipping input[name=\'company\']').val(json['company']);
			$('#tab-shipping input[name=\'address_1\']').val(json['address_1']);
			$('#tab-shipping input[name=\'address_2\']').val(json['address_2']);
			$('#tab-shipping input[name=\'city\']').val(json['city']);
			$('#tab-shipping input[name=\'postcode\']').val(json['postcode']);
			$('#tab-shipping select[name=\'country_id\']').val(json['country_id']);

			shipping_zone_id = json['zone_id'];

			for (i in json['custom_field']) {
				$('#tab-shipping select[name=\'custom_field[' + i + ']\']').val(json['custom_field'][i]);
				$('#tab-shipping textarea[name=\'custom_field[' + i + ']\']').val(json['custom_field'][i]);
				$('#tab-shipping input[name^=\'custom_field[' + i + ']\'][type=\'text\']').val(json['custom_field'][i]);
				$('#tab-shipping input[name^=\'custom_field[' + i + ']\'][type=\'hidden\']').val(json['custom_field'][i]);
				$('#tab-shipping input[name^=\'custom_field[' + i + ']\'][type=\'radio\'][value=\'' + json['custom_field'][i] + '\']').prop('checked', true);
				$('#tab-shipping input[name^=\'custom_field[' + i + ']\'][type=\'checkbox\'][value=\'' + json['custom_field'][i] + '\']').prop('checked', true);

				if (json['custom_field'][i] instanceof Array) {
					for (j = 0; j &lt; json['custom_field'][i].length; j++) {
						$('#tab-shipping input[name^=\'custom_field[' + i + ']\'][type=\'checkbox\'][value=\'' + json['custom_field'][i][j] + '\']').prop('checked', true);
					}
				}
			}

			$('#tab-shipping select[name=\'country_id\']').trigger('change');
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

var shipping_zone_id = '3563';

$('#tab-shipping select[name=\'country_id\']').on('change', function() {
	$.ajax({
		url: 'index.php?route=localisation/country/country&amp;user_token=ULi7h0A9VXa6CSampGlVL4xvj76k9Q2D&amp;country_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('#tab-shipping select[name=\'country_id\']').prop('disabled', true);
		},
		complete: function() {
			$('#tab-shipping select[name=\'country_id\']').prop('disabled', false);
		},
		success: function(json) {
			if (json['postcode_required'] == '1') {
				$('#tab-shipping input[name=\'postcode\']').closest('.form-group').addClass('required');
			} else {
				$('#tab-shipping input[name=\'postcode\']').closest('.form-group').removeClass('required');
			}

			html = '&lt;option value=""&gt; --- Please Select --- &lt;/option&gt;';

			if (json['zone'] &amp;&amp; json['zone'] != '') {
				for (i = 0; i &lt; json['zone'].length; i++) {
        			html += '&lt;option value="' + json['zone'][i]['zone_id'] + '"';

					if (json['zone'][i]['zone_id'] == shipping_zone_id) {
	      				html += ' selected="selected"';
	    			}

	    			html += '&gt;' + json['zone'][i]['name'] + '&lt;/option&gt;';
				}
			} else {
				html += '&lt;option value="0" selected="selected"&gt; --- None --- &lt;/option&gt;';
			}

			$('#tab-shipping select[name=\'zone_id\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('#tab-shipping select[name=\'country_id\']').trigger('change');

$('#button-shipping-address').on('click', function() {
	$.ajax({
		url: 'https://demo.opencart.com/index.php?route=api/shipping/address&amp;api_token=&amp;store_id=' + $('select[name=\'store_id\'] option:selected').val(),
		type: 'post',
		data: $('#tab-shipping input[type=\'text\'], #tab-shipping input[type=\'hidden\'], #tab-shipping input[type=\'radio\']:checked, #tab-shipping input[type=\'checkbox\']:checked, #tab-shipping select, #tab-shipping textarea'),
		dataType: 'json',
		crossDomain: true,
		beforeSend: function() {
			$('#button-shipping-address').button('loading');
		},
		complete: function() {
			$('#button-shipping-address').button('reset');
		},
		success: function(json) {
			$('.alert-dismissible, .text-danger').remove();
			$('.form-group').removeClass('has-error');

			// Check for errors
			if (json['error']) {
				if (json['error']['warning']) {
					$('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-danger alert-dismissible"&gt;&lt;i class="fa fa-exclamation-circle"&gt;&lt;/i&gt; ' + json['error']['warning'] + ' &lt;button type="button" class="close" data-dismiss="alert"&gt;&amp;times;&lt;/button&gt;&lt;/div&gt;');
				}

				for (i in json['error']) {
					var element = $('#input-shipping-' + i.replace('_', '-'));

					if ($(element).parent().hasClass('input-group')) {
						$(element).parent().after('&lt;div class="text-danger"&gt;' + json['error'][i] + '&lt;/div&gt;');
					} else {
						$(element).after('&lt;div class="text-danger"&gt;' + json['error'][i] + '&lt;/div&gt;');
					}
				}

				// Highlight any found errors
				$('.text-danger').parentsUntil('.form-group').parent().addClass('has-error');
			} else {
				// Shipping Methods
				var request = $.ajax({
					url: 'https://demo.opencart.com/index.php?route=api/shipping/methods&amp;api_token=&amp;store_id=' + $('select[name=\'store_id\'] option:selected').val(),
					dataType: 'json',
					beforeSend: function() {
						$('#button-shipping-address').button('loading');
					},
					complete: function() {
						$('#button-shipping-address').button('reset');
					},
					success: function(json) {
						if (json['error']) {
							$('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-danger alert-dismissible"&gt;&lt;i class="fa fa-exclamation-circle"&gt;&lt;/i&gt; ' + json['error'] + ' &lt;button type="button" class="close" data-dismiss="alert"&gt;&amp;times;&lt;/button&gt;&lt;/div&gt;');
						} else {
							// Shipping Methods
							html = '&lt;option value=""&gt; --- Please Select --- &lt;/option&gt;';

							if (json['shipping_methods']) {
								for (i in json['shipping_methods']) {
									html += '&lt;optgroup label="' + json['shipping_methods'][i]['title'] + '"&gt;';

									if (!json['shipping_methods'][i]['error']) {
										for (j in json['shipping_methods'][i]['quote']) {
											if (json['shipping_methods'][i]['quote'][j]['code'] == $('select[name=\'shipping_method\'] option:selected').val()) {
												html += '&lt;option value="' + json['shipping_methods'][i]['quote'][j]['code'] + '" selected="selected"&gt;' + json['shipping_methods'][i]['quote'][j]['title'] + ' - ' + json['shipping_methods'][i]['quote'][j]['text'] + '&lt;/option&gt;';
											} else {
												html += '&lt;option value="' + json['shipping_methods'][i]['quote'][j]['code'] + '"&gt;' + json['shipping_methods'][i]['quote'][j]['title'] + ' - ' + json['shipping_methods'][i]['quote'][j]['text'] + '&lt;/option&gt;';
											}
										}
									} else {
										html += '&lt;option value="" style="color: #F00;" disabled="disabled"&gt;' + json['shipping_method'][i]['error'] + '&lt;/option&gt;';
									}

									html += '&lt;/optgroup&gt;';
								}
							}

							$('select[name=\'shipping_method\']').html(html);
						}
					},
					error: function(xhr, ajaxOptions, thrownError) {
						alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				}).done(function() {
				    // Refresh products, vouchers and totals
				    $('#button-refresh').trigger('click');

                    $('a[href=\'#tab-total\']').tab('show');
                });
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

// Shipping Method
$('#button-shipping-method').on('click', function() {
	$.ajax({
		url: 'https://demo.opencart.com/index.php?route=api/shipping/method&amp;api_token=&amp;store_id=' + $('select[name=\'store_id\'] option:selected').val(),
		type: 'post',
		data: 'shipping_method=' + $('select[name=\'shipping_method\'] option:selected').val(),
		dataType: 'json',
		crossDomain: true,
		beforeSend: function() {
			$('#button-shipping-method').button('loading');
		},
		complete: function() {
			$('#button-shipping-method').button('reset');
		},
		success: function(json) {
			$('.alert-dismissible, .text-danger').remove();
			$('.form-group').removeClass('has-error');

			if (json['error']) {
				$('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-danger alert-dismissible"&gt;&lt;i class="fa fa-exclamation-circle"&gt;&lt;/i&gt; ' + json['error'] + ' &lt;button type="button" class="close" data-dismiss="alert"&gt;&amp;times;&lt;/button&gt;&lt;/div&gt;');

				// Highlight any found errors
				$('select[name=\'shipping_method\']').closest('.form-group').addClass('has-error');
			}

			if (json['success']) {
				$('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-success alert-dismissible"&gt;&lt;i class="fa fa-check-circle"&gt;&lt;/i&gt; ' + json['success'] + ' &lt;button type="button" class="close" data-dismiss="alert"&gt;&amp;times;&lt;/button&gt;&lt;/div&gt;');

				// Refresh products, vouchers and totals
				$('#button-refresh').trigger('click');
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

// Payment Method
$('#button-payment-method').on('click', function() {
	$.ajax({
		url: 'https://demo.opencart.com/index.php?route=api/payment/method&amp;api_token=&amp;store_id=' + $('select[name=\'store_id\'] option:selected').val(),
		type: 'post',
		data: 'payment_method=' + $('select[name=\'payment_method\'] option:selected').val(),
		dataType: 'json',
		crossDomain: true,
		beforeSend: function() {
			$('#button-payment-method').button('loading');
		},
		complete: function() {
			$('#button-payment-method').button('reset');
		},
		success: function(json) {
			$('.alert-dismissible, .text-danger').remove();
			$('.form-group').removeClass('has-error');

			if (json['error']) {
				$('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-danger alert-dismissible"&gt;&lt;i class="fa fa-exclamation-circle"&gt;&lt;/i&gt; ' + json['error'] + ' &lt;button type="button" class="close" data-dismiss="alert"&gt;&amp;times;&lt;/button&gt;&lt;/div&gt;');

				// Highlight any found errors
				$('select[name=\'payment_method\']').closest('.form-group').addClass('has-error');
			}

			if (json['success']) {
				$('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-success alert-dismissible"&gt;&lt;i class="fa fa-check-circle"&gt;&lt;/i&gt; ' + json['success'] + ' &lt;button type="button" class="close" data-dismiss="alert"&gt;&amp;times;&lt;/button&gt;&lt;/div&gt;');

				// Refresh products, vouchers and totals
				$('#button-refresh').trigger('click');
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

// Coupon
$('#button-coupon').on('click', function() {
	$.ajax({
		url: 'https://demo.opencart.com/index.php?route=api/coupon&amp;api_token=&amp;store_id=' + $('select[name=\'store_id\'] option:selected').val(),
		type: 'post',
		data: 'coupon=' + $('input[name=\'coupon\']').val(),
		dataType: 'json',
		crossDomain: true,
		beforeSend: function() {
			$('#button-coupon').button('loading');
		},
		complete: function() {
			$('#button-coupon').button('reset');
		},
		success: function(json) {
			$('.alert-dismissible, .text-danger').remove();
			$('.form-group').removeClass('has-error');

			if (json['error']) {
				$('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-danger alert-dismissible"&gt;&lt;i class="fa fa-exclamation-circle"&gt;&lt;/i&gt; ' + json['error'] + ' &lt;button type="button" class="close" data-dismiss="alert"&gt;&amp;times;&lt;/button&gt;&lt;/div&gt;');

				// Highlight any found errors
				$('input[name=\'coupon\']').closest('.form-group').addClass('has-error');
			}

			if (json['success']) {
				$('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-success alert-dismissible"&gt;&lt;i class="fa fa-check-circle"&gt;&lt;/i&gt; ' + json['success'] + ' &lt;button type="button" class="close" data-dismiss="alert"&gt;&amp;times;&lt;/button&gt;&lt;/div&gt;');

				// Refresh products, vouchers and totals
				$('#button-refresh').trigger('click');
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

// Voucher
$('#button-voucher').on('click', function() {
	$.ajax({
		url: 'https://demo.opencart.com/index.php?route=api/voucher&amp;api_token=&amp;store_id=' + $('select[name=\'store_id\'] option:selected').val(),
		type: 'post',
		data: 'voucher=' + $('input[name=\'voucher\']').val(),
		dataType: 'json',
		crossDomain: true,
		beforeSend: function() {
			$('#button-voucher').button('loading');
		},
		complete: function() {
			$('#button-voucher').button('reset');
		},
		success: function(json) {
			$('.alert-dismissible, .text-danger').remove();
			$('.form-group').removeClass('has-error');

			if (json['error']) {
				$('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-danger alert-dismissible"&gt;&lt;i class="fa fa-exclamation-circle"&gt;&lt;/i&gt; ' + json['error'] + ' &lt;button type="button" class="close" data-dismiss="alert"&gt;&amp;times;&lt;/button&gt;&lt;/div&gt;');

				// Highlight any found errors
				$('input[name=\'voucher\']').closest('.form-group').addClass('has-error');
			}

			if (json['success']) {
				$('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-success alert-dismissible"&gt;&lt;i class="fa fa-check-circle"&gt;&lt;/i&gt; ' + json['success'] + ' &lt;button type="button" class="close" data-dismiss="alert"&gt;&amp;times;&lt;/button&gt;&lt;/div&gt;');

				// Refresh products, vouchers and totals
				$('#button-refresh').trigger('click');
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

// Reward
$('#button-reward').on('click', function() {
	$.ajax({
		url: 'https://demo.opencart.com/index.php?route=api/reward&amp;api_token=&amp;store_id=' + $('select[name=\'store_id\'] option:selected').val(),
		type: 'post',
		data: 'reward=' + $('input[name=\'reward\']').val(),
		dataType: 'json',
		crossDomain: true,
		beforeSend: function() {
			$('#button-reward').button('loading');
		},
		complete: function() {
			$('#button-reward').button('reset');
		},
		success: function(json) {
			$('.alert-dismissible, .text-danger').remove();
			$('.form-group').removeClass('has-error');

			if (json['error']) {
				$('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-danger alert-dismissible"&gt;&lt;i class="fa fa-exclamation-circle"&gt;&lt;/i&gt; ' + json['error'] + ' &lt;button type="button" class="close" data-dismiss="alert"&gt;&amp;times;&lt;/button&gt;&lt;/div&gt;');

				// Highlight any found errors
				$('input[name=\'reward\']').closest('.form-group').addClass('has-error');
			}

			if (json['success']) {
				$('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-success alert-dismissible"&gt;&lt;i class="fa fa-check-circle"&gt;&lt;/i&gt; ' + json['success'] + ' &lt;button type="button" class="close" data-dismiss="alert"&gt;&amp;times;&lt;/button&gt;&lt;/div&gt;');

				// Refresh products, vouchers and totals
				$('#button-refresh').trigger('click');
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

// Affiliate
$('input[name=\'affiliate\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=marketing/affiliate/autocomplete&amp;user_token=ULi7h0A9VXa6CSampGlVL4xvj76k9Q2D&amp;filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				json.unshift({
					affiliate_id: 0,
					name: ' --- None --- '
				});

				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['affiliate_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'affiliate\']').val(item['label']);
		$('input[name=\'affiliate_id\']').val(item['value']);
	}
});

// Checkout
$('#button-save').on('click', function() {
	if ($('input[name=\'order_id\']').val() == 0) {
		var url = 'https://demo.opencart.com/index.php?route=api/order/add&amp;api_token=&amp;store_id=' + $('select[name=\'store_id\'] option:selected').val();
	} else {
		var url = 'https://demo.opencart.com/index.php?route=api/order/edit&amp;api_token=&amp;store_id=' + $('select[name=\'store_id\'] option:selected').val() + '&amp;order_id=' + $('input[name=\'order_id\']').val();
	}

	$.ajax({
		url: url,
		type: 'post',
		data: $('select[name=\'payment_method\'] option:selected, select[name=\'shipping_method\'] option:selected,  #tab-total select[name=\'order_status_id\'], #tab-total select, textarea[name=\'comment\'], input[name=\'affiliate_id\']'),
		dataType: 'json',
		crossDomain: true,
		beforeSend: function() {
			$('#button-save').button('loading');
		},
		complete: function() {
			$('#button-save').button('reset');
		},
		success: function(json) {
			$('.alert-dismissible, .text-danger').remove();

			if (json['error']) {
				$('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-danger alert-dismissible"&gt;&lt;i class="fa fa-exclamation-circle"&gt;&lt;/i&gt; ' + json['error'] + ' &lt;button type="button" class="close" data-dismiss="alert"&gt;&amp;times;&lt;/button&gt;&lt;/div&gt;');
			}

			if (json['success']) {
				$('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-success alert-dismissible"&gt;&lt;i class="fa fa-check-circle"&gt;&lt;/i&gt; ' + json['success'] + '  &lt;button type="button" class="close" data-dismiss="alert"&gt;&amp;times;&lt;/button&gt;&lt;/div&gt;');
            }

			if (json['order_id']) {
				$('input[name=\'order_id\']').val(json['order_id']);
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('#content').delegate('button[id^=\'button-upload\'], button[id^=\'button-custom-field\'], button[id^=\'button-payment-custom-field\'], button[id^=\'button-shipping-custom-field\']', 'click', function() {
	var node = this;

	$('#form-upload').remove();

	$('body').prepend('&lt;form enctype="multipart/form-data" id="form-upload" style="display: none;"&gt;&lt;input type="file" name="file" /&gt;&lt;/form&gt;');

	$('#form-upload input[name=\'file\']').trigger('click');

	if (typeof timer != 'undefined') {
    	clearInterval(timer);
	}

	timer = setInterval(function() {
		if ($('#form-upload input[name=\'file\']').val() != '') {
			clearInterval(timer);

			$.ajax({
				url: 'index.php?route=tool/upload/upload&amp;user_token=ULi7h0A9VXa6CSampGlVL4xvj76k9Q2D',
				type: 'post',
				dataType: 'json',
				data: new FormData($('#form-upload')[0]),
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function() {
					$(node).button('loading');
				},
				complete: function() {
					$(node).button('reset');
				},
				success: function(json) {
					$(node).parent().find('.text-danger').remove();

					if (json['error']) {
						$(node).parent().find('input[type=\'hidden\']').after('&lt;div class="text-danger"&gt;' + json['error'] + '&lt;/div&gt;');
					}

					if (json['success']) {
						alert(json['success']);
					}

					if (json['code']) {
						$(node).parent().find('input[type=\'hidden\']').val(json['code']);
					}
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});
		}
	}, 500);
});

$('.date').datetimepicker({
	language: 'en-gb',
	pickTime: false
});

$('.datetime').datetimepicker({
	language: 'en-gb',
	pickDate: true,
	pickTime: true
});

$('.time').datetimepicker({
	language: 'en-gb',
	pickDate: false
});
//--&gt;</script>
    <script type="text/javascript">
        $('a[tag-href]').click(function() {
            var tab = $(this).attr('tag-href');
            $('#order>li').removeClass('active');
            $('a[href="'+tab+'"]').parent().addClass('active');
            $('.tab-pane').removeClass('active');
            $(tab).addClass('active');

        });


    </script>
