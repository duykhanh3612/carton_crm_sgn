<div class="infomationCard row mb-4">
    <div class="col-md-4" style="padding: 0 14px;">
        <div class="card card-danger">
            <div class="card-header text-white">
                <h3 class="card-title d-flex align-items-center justify-content-between" style="flex-grow: 1;">
                    <span class="text-uppercase fw-500">Hoạt động</span>
                    {{-- <select class="bg-gradient-light" id="activeDateTime" style="border-radius: 4px; padding: 4px 0; margin-left: 15px; font-size: 13px;" data-json="{{json_encode($summary->work)}}">
                        <option selected value="thisweek" >Tuần này</option>
                        <option value="lastweek">Tuần trước</option>
                        <option value="thismonth">Tháng này</option>
                        <option value="lastmonth">Tháng trước</option>
                    </select> --}}
                   <div style="font-size: 13px">
                    <input type="text" name="activeDateTime" value="" />
                   </div>
                </h3>

                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body dimensionReport" id="statistical_activities" style="display: block;">
                <!-- item -->
                <div class="item row">
                    <div class="col-7">
                        <p>Tiền bán hàng</p>
                    </div>
                    <div class="col-5 text-right fw-500">
                        <p class="grossRevenue">{{ $summary->work['week']['total'] }}</p>
                    </div>
                </div>

                {{-- <div class="item row">
                    <div class="col-7">
                        <p>Lãi gộp</p>
                    </div>
                    <div class="col-5 text-right fw-500">
                        <p>0</p>
                    </div>
                </div> --}}

                <div class="item row">
                    <div class="col-7">
                        <p>Số đơn hàng</p>
                    </div>
                    <div class="col-5 text-right fw-500">
                        <p class="totalOrder">{{number_format($summary->work['week']['total_order'])}}</p>
                    </div>
                </div>

                <div class="item row">
                    <div class="col-7">
                        <p>Tiền bán hàng/Số đơn hàng</p>
                    </div>
                    <div class="col-5 text-right fw-500">
                        <p class="avg">
                            @if($summary->work['week']['total_order']>0)
                            {{ number_format(intval(str_replace(",","",$summary->work['week']['total'])) / intval($summary->work['week']['total_order'])) }}
                            @else
                            0
                            @endif
                        </p>
                    </div>
                </div>
                <!-- item -->
                {{-- <div class="item row">
                    <div class="col-7">
                        <p>Hàng khách trả</p>
                    </div>
                    <div class="col-5 text-right fw-500">
                        <p>0</p>
                    </div>
                </div> --}}
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <div class="col-md-4" style="padding: 0 14px;display: none;">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">
                    <span class="text-uppercase fw-500">Thông tin kho</span>
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="display: block;">
                <!-- item -->
                <div class="item row">
                    <div class="col-7">
                        <p>Tồn kho lâu</p>
                    </div>
                    <div class="col-5 text-right fw-500">
                        <p>0</p>
                    </div>
                </div>
                <!-- item -->
                <div class="item row">
                    <div class="col-7">
                        <p>Hết hàng</p>
                    </div>
                    <div class="col-5 text-right fw-500">
                        <p>3</p>
                    </div>
                </div>
                <!-- item -->
                <div class="item row">
                    <div class="col-7">
                        <p>Sắp hết hàng</p>
                    </div>
                    <div class="col-5 text-right fw-500">
                        <p>5</p>
                    </div>
                </div>
                <!-- item -->
                <div class="item row">
                    <div class="col-7">
                        <p>Vượt định mức</p>
                    </div>
                    <div class="col-5 text-right fw-500">
                        <p>10</p>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <div class="col-md-4" style="padding: 0 14px;">
        <div class="card card-success">
            <div class="card-header text-white">
                <h3 class="card-title">
                    <span class="text-uppercase fw-500">Thông tin hàng hóa</span>
                </h3>

                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="display: block;">
                <!-- item -->
                <div class="item row">
                    <div class="col-7">
                        <p>Hàng hóa/Chủng loại</p>
                    </div>
                    <div class="col-5 text-right fw-500">
                        <p>{{$summary->total_product}} / {{$summary->total_cate}}</p>
                    </div>
                </div>
                <!-- item -->
                <div class="item row">
                    <div class="col-7">
                        <p>Chưa có giá bán</p>
                    </div>
                    <div class="col-5 text-right fw-500">
                        <p>{{$summary->total_product_price_null}}</p>
                    </div>
                </div>
                <!-- item -->
                <div class="item row">
                    <div class="col-7">
                        <p>Chưa có giá vốn</p>
                    </div>
                    <div class="col-5 text-right fw-500">
                        <p>{{$summary->total_product_original_price_null}}</p>
                    </div>
                </div>
                <!-- item -->
                <div class="item row">
                    <div class="col-7">
                        <p>Hàng chưa phân loại</p>
                    </div>
                    <div class="col-5 text-right fw-500">
                        <p>{{$summary->total_product_no_cate}}</p>
                    </div>
                </div>
            </div>

            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
@push('js')
<script>
    $(document).on("change","#activeDateTime",function(){
        getIncomeStatementReport($(this).val())
    });
    function getIncomeStatementReport(value)
    {
        // console.log(value,$("#dropdown-caret").attr('data-json'));
        data = JSON.parse($("#activeDateTime").attr('data-json'));
        if(value == "thismonth")
        {
            $('.dimensionReport').find('.grossRevenue').html(data.month.total);
            $('.dimensionReport').find('.totalOrder').html(data.month.total_order);
            $('.dimensionReport').find('.avg').html(data.month.avg);
        }
        else if(value == "lastmonth"){
            $('.dimensionReport').find('.grossRevenue').html(data.last_month.total);
            $('.dimensionReport').find('.totalOrder').html(data.last_month.total_order);
            $('.dimensionReport').find('.avg').html(data.last_month.avg);
        }
        else if(value == "lastweek")
        {
            $('.dimensionReport').find('.grossRevenue').html(data.last_week.total);
            $('.dimensionReport').find('.totalOrder').html(data.last_week.total_order);
            $('.dimensionReport').find('.avg').html(data.last_week.avg);
        }
        else{
            $('.dimensionReport').find('.grossRevenue').html(data.week.total);
            $('.dimensionReport').find('.totalOrder').html(data.week.total_order);
            $('.dimensionReport').find('.avg').html(data.week.avg);
        }
    }
    //  =============== Hàm xử lý chọn ngày cho widget "Hoạt động"  - mặc định là tuần này =====================
    $(function() {
        var startOfWeek = moment().startOf('week').add(1, 'days'); // Thêm 1 ngày vì moment.js tính tuần từ Chủ Nhật
        var endOfWeek = moment().endOf('week').add(1, 'days'); // Tương tự như trên
      $('input[name="activeDateTime"]').daterangepicker({
        opens: 'left',
        "startDate": startOfWeek.format('DD/MM/YYYY'),
        "endDate": endOfWeek.format('DD/MM/YYYY'),
        dateLimit: { days: 31 } // Giới hạn người dùng chỉ có thể chọn tối đa 31 ngày
      }, function(start, end, label) {
        // Xử lý thời gian
        console.log('Ngày bắt đầu: ', start.format('DD-MM-YYYY'))
        console.log('Ngày kết thúc: ', end.format('DD-MM-YYYY'))

        $.ajax({
            method: "POST",
            url: base_url + "/admin/statistical_activities",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                star_date:  start.format('YYYY-MM-DD'),
                end_date: end.format('YYYY-MM-DD')
            }
        }).done(function(res) {
            let html = `<div class="item row">
                    <div class="col-7">
                        <p>Tiền bán hàng</p>
                    </div>
                    <div class="col-5 text-right fw-500">
                        <p class="grossRevenue">${res.result.total}</p>
                    </div>
                </div>



                <div class="item row">
                    <div class="col-7">
                        <p>Số đơn hàng</p>
                    </div>
                    <div class="col-5 text-right fw-500">
                        <p class="totalOrder">${res.result.total_order}</p>
                    </div>
                </div>

                <div class="item row">
                    <div class="col-7">
                        <p>Tiền bán hàng/Số đơn hàng</p>
                    </div>
                    <div class="col-5 text-right fw-500">
                        <p class="avg">
                            ${res.result.avg}
                                                    </p>
                    </div>
                </div>`;

            $("#statistical_activities").html(html);
        });


      });
    });
</script>
<style>
   .daterangepicker{
        width: max-content;
    padding: 20px;
    right: unset !important;
    left: 0;
    transform: translateX(50%);
    --webkit-transform: translateX(50%);
    padding-top: 0;
    }
    .daterangepicker .drp-calendar.left{
        padding: 0 30px 0 0;
    }
    .daterangepicker.show-calendar .ranges{
        margin-right: 0;
    }
    .daterangepicker *{
        font-size: 12px !important;
    }
    .daterangepicker .calendar-table th, .daterangepicker .calendar-table td{
        width: max-content;
        height: max-content;
    }
    .daterangepicker .drp-buttons .btn{
        padding: 8px 10px;
        margin-left: 10px;
    }
    .daterangepicker.opensleft:after,.daterangepicker.opensleft:before{
        display: none;
    }
    input[name="activeDateTime"]{
        padding: 5px;
    display: inline-block;
    width: 185px;
    max-width: unset;
    }
</style>
@endpush
