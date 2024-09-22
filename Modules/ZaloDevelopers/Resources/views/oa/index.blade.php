
<div
    style="
    margin: 0 14px;
    padding: 14px 0 51px 0;
    border-radius: 10px;
    background: #f5f5f5;
    margin-bottom: 71px;
    ">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-uppercase font-weight-bold">
                        zalo Template
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
                        <input type="search" class="form-control form-control-lg" placeholder="Mã thẻ" />
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-lg btn-default"
                                style="
                    border-radius: 4px;
                    background: #ffc619;
                    font-size: unset;
                    height: max-content;
                ">
                                <img src="{{assets}}dist/img/icon/search.png" alt="icon search" style="width: 14px" />
                                <p class="fw-500">Tìm kiếm</p>
                            </button>
                        </div>
                    </div>
                </form>
                <!-- Tạo phân loại -->
                <div class="d-flex align-items-center" style="gap: 10px">
                    <!-- Tạo phân loại -->
                    <div>
                        <button type="button" class="btn bg-main-yl" data-toggle="modal"
                            data-target="#addServiceCard">
                            <div class="d-flex align-items-center">
                                <img src="{{assets}}dist/img/icon/plus.png" alt="" style="width: 14px" />
                            </div>
                            <p class="fw-500">Tạo thẻ</p>
                        </button>

                        <button type="button" class="btn bg-main-yl link-process" data-href="{{route("zalo.zns.template.download")}}">
                            <i class="fa fa-download"></i>
                            <p class="fw-500">Tải Template</p>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Filter -->
            <form id="filterForm">
                <div class="d-flex justify-content-between" style="gap: 42px; margin: 30px 6.5px">
                    <!-- Bộ lọc -->
                    <div class="chooseFilter d-flex align-items-center" style="gap: 18px">
                        <!-- Trạng thái thẻ -->
                        <div class="form-group">
                            <select class="custom-select btn btn-filter" id="cardStatus">
                                <option selected>Trạng thái</option>
                                <option value="1">ENABLE</option>
                                <option value="2">PENDING_REVIEW</option>
                                <option value="3">REJECT</option>
                                <option value="4">DISABLE</option>
                            </select>
                        </div>
                    </div>
                    <!-- Xác nhận lọc và reset bộ lọc -->
                    <div class="d-flex align-items-center" style="gap: 16px">
                        <!-- Lựa chọn thời gian -->
                        <div class="d-flex justify-content-end" style="gap: 8px">
                            <!-- hiển thị thời gian -->
                            <div class="d-flex align-items-center justify-content-between" style="gap: 16px">
                                <p class="showDate" id="startDate" name="startDate">
                                    dd/mm/yyyy
                                </p>
                                <p>đến</p>
                                <p class="showDate" id="endDate" name="endDate">
                                    dd/mm/yyyy
                                </p>
                            </div>
                            <!-- button chọn thời gian -->
                            <!-- Date and time range -->

                            <div class="chooseDate" style="cursor: pointer" id="daterange-btn">
                                <img src="{{assets}}dist/img/icon/calendar.png"
                                    style="width:
                14px"" />
                                <p class="mb-0">Thời gian</p>
                            </div>
                        </div>
                        <!-- Lọc -->
                        <button type="button"
                            class="btn bg-main-yl d-flex align-items-center justify-content-center">
                            <div class="d-flex align-items-center">
                                <img src="{{assets}}dist/img/icon/fill.png" alt="" style="width: 14px" />
                            </div>
                            <p>Lọc</p>
                        </button>
                        <!-- Reset bộ lọc -->
                        <button type="button"
                            class="btn d-flex align-items-center justify-content-center showDate bg-yl-2"
                            onclick="resetFilter()">
                            <div class="d-flex align-items-center">
                                <img src="{{assets}}dist/img/icon/reset.png" alt="" style="width: 14px" />
                            </div>
                            <p>Khôi phục</p>
                        </button>
                    </div>
                </div>
            </form>

            <!-- /.row -->

            <!-- /.row (main row) -->
        </div>
        <!-- /.container-fluid -->
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
                                    <th>OA ID</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>oa_alias</th>
                                    <th>is_verified</th>
                                    <th>oa_type</th>
                                    <th>avatar</th>
                                    <th>package_name</th>
                                    <th>package_valid_through_date</th>
                                    <th>package_auto_renew_date</th>
                                    <th>Act</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @foreach($items as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->description}}</td>
                                    <td>
                                        {{$item->oa_alias}}
                                    </td>
                                    <td>{{$item->is_verified}}</td>
                                    <td>{{$item->oa_type}}</td>
                                    <td class="text-center">
                                        <a class="link-preview" href="  {{$item->avatar}}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                    <td>{{$item->package_name}}</td>
                                    <td>{{$item->package_valid_through_date}}</td>
                                    <td>{{$item->package_auto_renew_date}}</td>
                                    <td class="d-flex">
                                        <button type="button" class="btn bg-main-yl text-nowrap link-process" data-href="{{route("zalo.oa.download",$item->id)}}">
                                            <i class="fa fa-download"></i>
                                            <p class="fw-500">Tải Info</p>
                                        </button>
                                        <button type="button" class="btn bg-main-yl text-nowrap link-process" data-href="{{route("zalo.oa.download.zns",$item->id)}}">
                                            <i class="fa fa-download"></i>
                                            <p class="fw-500">Tải ZNS</p>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                    <th>Quality</th>
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

