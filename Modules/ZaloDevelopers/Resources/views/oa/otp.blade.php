
<div style="margin: 0 14px;padding: 14px 0 51px 0; border-radius: 10px;background: #f5f5f5; margin-bottom: 71px;">
    <input type="hidden" id="act" value="otp" />
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-uppercase font-weight-bold">
                        OTP Result
                    </h1>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Search & Create Field -->
            <div class="d-flex justify-content-between" style="margin: 30px 6.5px; gap: 4px">
                <!-- form tìm kiếm -->
                <form action="">
                    <div class="input-group">
                        <input name="keywords" value="{{request("keywords")}}" type="search" class="form-control form-control-lg" placeholder="Keyword" />
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-lg btn-default" style=" border-radius: 4px; background: #ffc619;font-size: unset; height: max-content;">
                                <img src="{{assets}}dist/img/icon/search.png" alt="icon search" style="width: 14px" />
                                <p class="fw-500">Tìm kiếm</p>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Filter -->
            <form id="filterForm">
                <div class="d-flex justify-content-between" style="gap: 42px; margin: 30px 6.5px">
                    <!-- Bộ lọc -->
                    <div class="chooseFilter d-flex align-items-center" style="gap: 18px">
                        <!-- Trạng thái thẻ -->
                        <div class="form-group">
                            <select  name="filter[status]" class="custom-select btn btn-filter" id="cardStatus">
                                <option selected>Trạng thái</option>
                                <option value="success">Success</option>
                                <option value="error">Error</option>
                            </select>
                        </div>
                    </div>
                    <!-- Xác nhận lọc và reset bộ lọc -->
                    <div class="d-flex align-items-center" style="gap: 16px">
                        <input type="hidden" name="{{ @$filter['name']}}[form]" id="filter_created_at_form" class="datatable-filter" value="{{\Arr::get(request('filter'),@$filter['field_name'].".form")}}" />
                        <input type="hidden" name="{{ @$filter['name']}}[to]" id="filter_created_at_to" class="datatable-filter" value="{{\Arr::get(request('filter'),@$filter['field_name'].".to")}}" />
                        <!-- Lựa chọn thời gian -->
                        <div class="d-flex justify-content-end" style="gap: 8px">
                            <!-- hiển thị thời gian -->
                            <div class="d-flex align-items-center justify-content-between" style="gap: 16px">

                                <p class="showDate" id="startDate" name="startDate" for="#filter_created_at_form">
                                    {{ \Arr::get(request('filter'),@$filter['field_name'].".form")? date("d/m/Y",strtotime(\Arr::get(request('filter'),@$filter['field_name'].".form"))):'dd/mm/yyyy'}}
                                </p>
                                <p>đến</p>
                                <p class="showDate" id="endDate" name="endDate" for="#filter_created_at_to">
                                    {{ \Arr::get(request('filter'),@$filter['field_name'].".to")?date("d/m/Y",strtotime(\Arr::get(request('filter'),@$filter['field_name'].".to"))):'dd/mm/yyyy'}}
                                </p>
                            </div>
                            <!-- button chọn thời gian -->
                            <!-- Date and time range -->

                            <div class="chooseDate" style="cursor: pointer" id="daterange-btn">
                                <img src="{{assets}}dist/img/icon/calendar.png" style="width: 14px" />
                                <p class="mb-0">Thời gian</p>
                            </div>
                        </div>
                        <!-- Lọc -->
                        <button type="submit"  class="btn bg-main-yl d-flex align-items-center justify-content-center">
                            <div class="d-flex align-items-center">
                                <img src="{{assets}}dist/img/icon/fill.png" alt="" style="width: 14px" />
                            </div>
                            <p>Lọc</p>
                        </button>
                        <!-- Reset bộ lọc -->
                        <button type="button" class="btn d-flex align-items-center justify-content-center showDate bg-yl-2"  onclick="resetFilter()">
                            <div class="d-flex align-items-center">
                                <img src="{{assets}}dist/img/icon/reset.png" alt="" style="width: 14px" />
                            </div>
                            <p>Khôi phục</p>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- Table -->
    <section class="content">
        <div class="container-fluid">
            <div class="card-tools">
                <div class="card-body">
                    <div>
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr class="table-secondary">
                                    <th>ID</th>
                                    <th>Phone</th>
                                    <th>Code (OTP)</th>
                                    <th>Status</th>
                                    <th>Time</th>
                                    <th>Result</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @foreach($items as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->phone}}</td>
                                    <td>{{$item->code}}</td>
                                    <td>
                                        {{$item->status}}
                                    </td>
                                    <td>{{$item->time_line}}</td>
                                    <td style="max-width: 600px;">
                                        <code>{{$item->result}}</code>
                                    </td>

                                    <td class="text-center">
                                        <div  class="d-flex" style="gap: 15px">
                                            <a href="{{route("zalo.otp.resend",$item->id)}}" title="Gửi lại mã OTP">
                                                <i class="fa fa-telegram"></i>
                                            </a>

                                            <a href="{{route("zalo.otp.pages.delete",$item->id)}}" title="Xóa mã OTP">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Phone</th>
                                    <th>Code (OTP)</th>
                                    <th>Status</th>
                                    <th>Time</th>
                                    <th>Result</th>
                                    <th>Act</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

