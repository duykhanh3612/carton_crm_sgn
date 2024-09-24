<!DOCTYPE html>
<html lang="vi">

<head>
    <base href="{{ url('public/themes/cartonSGNPrint') }}/" />
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="assets/img/favicon.png" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>CARTON SGN</title>
    <link href="bootstrap3/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Source+Serif+4:opsz,wght@8..60,400;8..60,500;8..60,600;8..60,700;8..60,800;8..60,900&display=swap" rel="stylesheet" />
    <link href="assets/css/print.css" rel="stylesheet" />
    <link href="assets/css/icons.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/printFelixOffice.css" rel="stylesheet" />
    <style type="text/css">
    body {
  margin: 0;
  padding: 0;
  background-color: #FAFAFA;
  font: 12pt "Optima";
}

* {
  box-sizing: border-box;
  -moz-box-sizing: border-box;
}

.page {
  width: 21cm;
  min-height: 29.7cm;
  padding: 2cm;
  margin: 1cm auto;
  border: 1px #D3D3D3 solid;
  border-radius: 5px;
  background: white;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}

.subpage {
  padding: 1cm;
  border: 5px red solid;
  height: 256mm;
  outline: 2cm #FFEAEA solid;
}

@page {
  size: A4;
  margin: 0;
}

@media print {
  .page {
    margin: 0;
    border: initial;
    border-radius: initial;
    width: initial;
    min-height: initial;
    box-shadow: initial;
    background: initial;
    page-break-after: always;
  }
}
</style>
</head>

<body>
    <div class="wrapper"  style="font-size:20px">
        <div class="container">
            <div class="modal-content" id="printFelixOffice">
                <!-- Trang in -->
                <div class="listProjectPage pagebreak lrPadding d-flex flex-column">
                    <!-- HEADER -->
                    <div class="pageHeader tbPadding d-flex justify-content-between">
                        <p> {{ date('d/m/Y, H:i') }}</p>
                        <p></p>
                    </div>

                    <!-- SGN INFO -->
                    <div id="cartonSGNInfo" class="tbPadding2">
                        <div class="row">
                            <!-- logo -->
                            {{-- <div class="leftside col-xs-3">
                                <img src="./assets/img/logo.png" alt="Logo" />
                            </div> --}}
                            <!-- thông tin -->
                            <div class="rightside col-xs-12 text-center">

                                <div class="row">
                                    <!-- chi nhánh -->
                                   <div class="col-xs-8 text-left mt-10">
				     					<h3><strong>BAO BÌ CARTON SGN</strong></h3>
                                        {{-- <p>
                                            <span class="fw-600"> Chi nhánh HCM:</span> 59/4 Hiệp
                                            Bình, Hiệp Bình Phước, Thủ Đức
                                        </p>
                                        <p>
                                            <span class="fw-600">Chi nhánh HN:</span> Geleximco Lê
                                            Trọng Tấn, Dương Nội, Hà Đông
                                        </p>   --}}
                                    </div>
                                    <!-- hotline -->
                                    <div class="col-xs-4 text-left mt-10">
                                        <p>
                                            <span class="fw-600">Hotline hỗ trợ</span>: 0967 848 135
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TILTE + MÃ ĐƠN HÀNG -->
                    <div id="cartonSGNOderTitle" class="mt-20 text-center">
                        <h3><strong>PHIẾU GIAO HÀNG</strong></h3>
                        <h3 class="text-uppercase"><strong>{{ $order->code }}</strong></h3>
                    </div>

                    <!-- THÔNG TIN KHÁCH HÀNG -->
                    <div id="customerInfo" class="mt-10">
                        <!-- TÊN + SDT -->
                        <div class="d-flex gap-25">
                            <!-- TÊN -->
                            <div class="item d-flex gap-5">
                                <p class="fw-500 fw-bold">Khách hàng:</p>
                                <p id="customerName">{{ @$order->customer->full_name }}</p>
                            </div>
                            <!-- SĐT -->
                            <div class="item d-flex gap-5">
                                <p class="fw-500 fw-bold">SĐT:</p>
                                <p id="customerPhone">{{ @$order->customer->phone }}</p>
                            </div>
                        </div>
                        <!-- ĐỊA CHỈ -->
                        <div class="item d-flex gap-5">
                            <p class="fw-500 fw-bold">Địa chỉ:</p>
                            <p id="customerAddress">
                                {{ @$order->customer->address }}
                            </p>
                        </div>
                        <!-- NHÂN VIÊN BÁN HÀNG -->
                        <div class="item d-flex gap-5">
                            <p class="fw-500 fw-bold">Nhân viên bán hàng:</p>
                            <p id="salePerson">{{ @$order->sale->full_name }}</p>
                        </div>
                    </div>
                    <br/>
                    <!-- THÔNG TIN ĐƠN HÀNG -->
                    <div id="orderInfo">
                        <!-- TABLE ĐƠN HÀNG -->
                        <div class="item">
                            {{-- <p class="fw-500 fw-bold">Đơn hàng:</p> --}}
                            <table id="orderTable" class="table table-bordered w-full">
                                <thead>
                                    <tr>
                                        <th class="text-center">STT</th>
                                        <th>Tên hàng hóa</th>
                                        <th class="text-right">Đơn giá</th>
                                        <th class="text-right">Giảm giá</th>
                                        <th class="text-center">SL</th>
                                        {{-- <th class="text-center">Đơn vị</th> --}}
                                        <th class="text-right">Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($order->details))
                                        @foreach ($order->details as $row)
                                            <!-- item -->
                                            <tr>
                                                <td class="text-center">{{ $loop->index + 1 }}</td>
                                                <td>{!! $row->description !!}</td>
                                                <td class="text-right">{{ number_format($row->unit_price) }}</td>
                                                <td class="text-right">0</td>
                                                <td class="text-center">{{ $row->qty }}</td>
                                                {{-- <td class="text-center"></td> --}}
                                                <td class="text-right">{{ number_format($row->total_price) }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    <!-- item -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- SUMMARY TIỀN ĐƠN HÀNG -->
                    <div id="orderValue">
                        <div class="row d-flex justify-content-end">
                            <div class="col-xs-6">
                                <table class="w-full" id="orderValueTable">
                                    <tbody>
                                        <!-- item Tổng tiền hàng -->
                                        <tr>
                                            <td>Tổng tiền hàng:</td>
                                            <td class="text-right">{{ number_format($order->subTotal) }}</td>
                                        </tr>
                                        <!-- item Giảm giá -->
                                        <tr>
                                            <td>Giảm giá:</td>
                                            <td class="text-right">{{ number_format($order->discount_value) }}</td>
                                        </tr>
                                        @if(intval($order->shipping_fee)!=0)
                                        <tr>
                                            <td>Phí vận chuyển:</td>
                                            <td class="text-right">{{ number_format($order->shipping_fee) }}</td>
                                        </tr>
                                        @endif
                                        <!-- item Tổng thanh toán -->
                                        <tr class="fw-bold">
                                            <td>Tổng thanh toán:</td>
                                            <td class="text-right">{{ number_format($order->total) }}</td>
                                        </tr>
                                        <!-- item Đã thanh toán -->
                                        <tr>
                                            <td>Đã thanh toán:</td>
                                            <td class="text-right">{{ number_format($order->total_paid) }}</td>
                                        </tr>
                                        <!-- item Còn nợ -->
                                        <tr>
                                            <td>Còn nợ:</td>
                                            <td class="text-right">{{ number_format($order->debt) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div id="footer" class="flex-1">
                        <!-- Ghi chú -->
                        <p>Ghi chú:</p>

                        <div>{!! $order->note !!}</div>
                        <!-- Ngày mua -->
                        <p>
                            {{-- Ngày <span class="dayFooter">......</span> tháng
                            <span class="monthFooter">......</span> năm
                            <span class="yearFooter">......</span> --}}
                        </p>
                        <!-- Ký tên -->
                        <div class="row">
                            <!-- Người lập phiếu -->
                            <div class="col-xs-3 text-center">
                                <p class="fw-bold">Người lập phiếu</p>
                            </div>
                            <!-- Kế toán -->
                            <div class="col-xs-3 text-center">
                                <p class="fw-bold">Kế toán</p>
                            </div>
                            <!-- Nhân viên giao hàng -->
                            <div class="col-xs-3 text-center">
                                <p class="fw-bold">Nhân viên giao hàng</p>
                            </div>
                            <!-- Người nhận hàng -->
                            <div class="col-xs-3 text-center">
                                <p class="fw-bold">Người nhận hàng</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        window.onload = function() {
            window.print();
        };
    </script>
</body>

</html>
