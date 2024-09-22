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

                    <div class="tab-content">
                        <div class="tab-pane active" id="tab-customer">
                            <div class="form-group" style="border-bottom:1px dashed;margin-top:20px;padding-top:5px;clear:both;">
                                <label style="font-size:24px;">
                                    1. Thông tin đơn hàng
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-customer">Mã đơn hàng</label>
                                <div class="col-sm-10">
                                    <input name="track_code" value="{{@$row->id}}" placeholder="" id="track_code" class="form-control" autocomplete="off" type="text">
                                    <ul class="dropdown-menu"></ul>
                                    <input name="customer_id" value="22947" type="hidden">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-customer-group">Ngày cập nhật</label>
                                <div class="col-sm-10">
                                    <input name="created_at" value="{{date('d/m/Y',strtotime(@$row->created_at))}}" id="created_at" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-firstname">Người cập nhật</label>
                                <div class="col-sm-10">
                                    {{App\Model\md::scalar('sys_user',"id='".App\Model\Admin::_id()."'","username")}}
                                    <input name="user_id" value="{{App\Model\Admin::_id()}}" id="user_id" class="form-control" type="hidden">
                                    
                                </div>
                            </div>
                            <div class="form-group" style="border-bottom:1px dashed;margin-top:20px;padding-top:5px;clear:both;">
                                <label style="font-size:24px;">
                                    2. Thông tin sản phẩm
                                    @php
                                    $pros = App\Model\md::find_all("davinci_order_product","order_id='".@$row->id."'");
                                    $total_price = 0;
                                    @endphp
                                </label>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <td class="text-left"> </td>
                                                    <td class="text-right">Số lượng</td>
                                                    <td class="text-right">Giá</td>
                                                </tr>
                                            </thead>
                                            <tbody id="cart">
                                                @foreach($pros as $pro)
                                                @php
                                                $total_price = $total_price + $pro->price;
                                                @endphp
                                                <tr>
                                                    <td class="text-left">
                                                        {{@$pro->product_name}}
                                                    </td>
                                                    <td class="text-right">{{@$pro->qty}}</td>
                                                    <td class="text-right">{{ number_format(@$pro->price)}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            
                            <!--<div class="form-group">
                                <label class="col-sm-2 control-label" for="input-product">Sản phẩm</label>
                                <div class="col-sm-10">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-quantity">Giá</label>
                                <div class="col-sm-10">                                  
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-quantity">Số lương</label>
                                <div class="col-sm-10">
                                </div>
                            </div>-->
                           
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-quantity">Tạm tính</label>
                                <div class="col-sm-10">
                                    @php
                                    $price_temp = $total_price;
                                    $price_voucher = $price_temp * floatval(@$row->voucher_per)/100;
                                    $price_total = $price_temp - $price_voucher;
                                    @endphp

                                    {{ number_format(@$total_price)}}
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-to-name">Mã giảm giá</label>
                                <div class="col-sm-10">
                                    {{@$row->voucher_code}}
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-to-email">Số tiền giảm</label>
                                <div class="col-sm-10">

                                    {{ number_format(@$price_voucher) }}
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-to-email">Thành tiền</label>
                                <div class="col-sm-10">
                                    {{ number_format(@$price_total) }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-payment-address">Trạng thái thanh toán:</label>
                                <div class="col-sm-10">
                                    <select name="order_payment" id="order_payment" class="form-control">
                                        <option value="0" selected="selected"> --- None --- </option>
                                        @foreach(App\Model\md::find_all('davinci_order_payment') as $ot)
                                        <option value="{{@$ot->id}}">{{    @$ot->name}}</option>
                                        @endforeach
                                    </select>
                                    <script>
                                        $('#order_payment').val('{{ @$row->order_payment }}')
                                    </script>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-shipping-address">Trạng thái vận chuyển</label>
                                <div class="col-sm-10">
                                    <select name="order_tranfer" id="order_tranfer" class="form-control">
                                        <option value="0" selected="selected"> --- None --- </option>
                                        @foreach(App\Model\md::find_all('davinci_order_tranfer') as $ot)
                                        <option value="{{@$ot->id}}">{{    @$ot->name}}</option>
                                        @endforeach
                                    </select>
                                    <script>
                                        $('#order_tranfer').val('{{ @$row->order_tranfer }}')
                                    </script>
                                </div>
                            </div>    


                            <div class="form-group" style="border-bottom:1px dashed;margin-top:20px;padding-top:5px;clear:both;">
                                <label style="font-size:24px;">
                                    3. Thông tin thanh toán
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
                                    <input name="payment_address" value="{{@$row->payment_address}}" class="form-control" type="text">
                                </div>
                            </div>

                            <!--<div class="text-right ">
                                <button type="button" id="button-customer" data-loading-text="Loading..." class="btn btn-primary pad5_top"><i class="fa fa-arrow-right"></i> Continue</button>
                            </div>-->
                        </div>

                    </div>
                    <input name="id" value="{{@$row->id}}" class="form-control" type="hidden">
                    {!!h::token() !!}
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        //$('a[tag-href]').click(function() {
        //    var tab = $(this).attr('tag-href');
        //    $('#order>li').removeClass('active');
        //    $('a[href="'+tab+'"]').parent().addClass('active');
        //    $('.tab-pane').removeClass('active');
        //    $(tab).addClass('active');

        //});

        $("input").prop('disabled', true);
        $("input[name='_token']").prop('disabled', false);
        $("input[name='id']").prop('disabled', false);
        $("input[name='user_id']").prop('disabled', false);
    </script>
