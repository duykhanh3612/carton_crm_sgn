<div class="row">
    <!-- Biểu đồ doanh số tuần -->
    <div class="col-12 col-lg-6" style="padding: 0 14px;">
        <!-- BAR CHART -->
        <div class="card">
            <div class="card-header text-white bg-main-blue">
                <h3 class="card-title">
                    <span class="text-uppercase fw-500">Biểu đồ doanh số tuần</span>
                </h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="chart">

                    <canvas id="barChart" style="min-height: 250px; height: 380px; max-height: 380px; max-width: 100%;" dat></canvas>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- Sản phẩm bán chạy -->
    <div class="col-12 col-lg-6" style="padding: 0 14px;">
        <!-- BAR CHART -->
        <div class="card">
            <div class="card-header text-white bg-main-blue">
                <!-- Title -->
                <h3 class="card-title">
                    <span class="text-uppercase fw-500">Sản phẩm bán chạy</span>
                    <small class="font-weight-light">(Số lượng)</small>
                </h3>
                <!-- Đóng mở tab -->
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <!-- Progress -->
            <div class="card-body">
                <div class="chart" style="padding: 20px 15px;">
                    @php
                        $items = Product::getBestSelling(5);
                        $total_item = $items->sum("quantity_sold");
                    @endphp

                    @foreach($items as $item)
                    @if($item->quantity_sold > 0)
                    <!-- item -->
                    <div class="item row" style="padding: 10px 0;">
                        <!-- item name -->
                        <div class="col-12">
                            <p class="font-weight-bold">
                                {{$item->name}}
                            </p>
                        </div>
                        <!-- item progress -->
                        <div class="col-10">
                            <div class="progress position-relative">
                                <div class="progress-bar bg-main-blue-3" role="progressbar" style="width: {{$item->quantity_sold/$total_item*100}}%;" aria-valuenow="{{$total_item }}" aria-valuemin="0" aria-valuemax="{{$total_item }}">

                                </div>
                            </div>
                        </div>
                        <!-- item quantity -->
                        <div class="col-2">
                            <p class="text-right">{{$item->quantity_sold}}</p>
                        </div>
                    </div>
                    @endif
                    @endforeach

                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>
