<div class="tab-content" id="nav-tabContent">
    <!-- TAB TỔNG QUAN -->
    <div class="tab-pane fade show " id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
        @include("admin::report.payment.dashboard")
    </div>
    <!-- TAB THU -->
    <div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
       <!-- Main content -->
       <section class="content">
          <div class="container-fluid">
            <input type="hidden" id="act" value="{{ request()->segment(2) }}" />
            @php $filters = $config['filters'] @endphp
             <!-- Search & Create Field -->
             <div class="d-flex justify-content-between" style="margin: 30px 6.5px; gap: 4px">
                <!-- form tìm kiếm -->
                <form action="">

                   <div class="input-group">
                      <input type="search" class="form-control form-control-lg" id="keywords" name="keywords" placeholder="Nhập mã hóa đơn hoặc ghi chú để tìm kiếm">
                      <div class="input-group-append">
                         <button type="submit" class="btn btn-lg btn-default text-white" style="
                            border-radius: 4px;
                            background: #003f93;
                            font-size: unset;
                            height: max-content;
                            ">
                            <img src="{{assets}}dist/img/icon/search.png" alt="icon search" style="width: 14px">
                            <p class="fw-500">Tìm kiếm</p>
                         </button>
                      </div>
                   </div>
                </form>
             </div>
             <!-- Filter -->
             @if(isset($filters['children']['left']) && isset($filters['children']['right']))
             <div class="d-flex justify-content-between flex-wrap" style="gap: 42px; margin: 30px 6.5px">
                 <!-- Bộ lọc -->
                 <div class="chooseFilter d-flex align-items-center" style="gap: 10px">
                     @if(isset($filters['children']['left']))
                     @foreach($filters['children']['left'] as $filter)
                     <div class="form-group">
                         @include('hyperspace::components.datatable_filter')
                     </div>
                     @endforeach
                     @endif
                 </div>
                 <!-- Xác nhận lọc và reset bộ lọc -->
                 <div class="d-flex align-items-center" style="gap: 14px; height: 35px;">

                     @if(isset($filters['children']['right']))
                     @foreach($filters['children']['right'] as $filter)
                     <div class="form-group" style="height: 35px;">
                         @include('hyperspace::components.datatable_filter')
                     </div>
                     @endforeach
                     @endif

                     <!-- Lọc -->
                     <button type="button" class="btn-submit-filter btn bg-main-blue d-flex align-items-center justify-content-center text-white" style="height: 35px;" >
                         <div class="d-flex align-items-center">
                             <img src="{{assets}}dist/img/icon/fill.png" alt="" style="width: 14px">
                         </div>
                         <p>Lọc</p>
                     </button>
                     <!-- Reset bộ lọc -->
                     {{-- <button type="button" class="btn d-flex align-items-center justify-content-center showDate bg-yl-2" onclick="resetFilter()">
                         <div class="d-flex align-items-center">
                             <img src="{{assets}}dist/img/icon/reset.png" alt="" style="width: 14px">
                         </div>
                         <p>Khôi phục</p>
                     </button>


                     <script>
                             function resetFilter()
                             {
                                 window.location = "{{url("admin/payment")}}";
                             }
                     </script> --}}
                 </div>
             </div>
             @endif
             <!-- Table -->
             <div class="card-tools">
                <div class="card-body">
                   <div id="incomeTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                      <div class="row">
                         <div class="col-sm-12 col-md-6"></div>
                         <div class="col-sm-12 col-md-6"></div>
                      </div>
                      <div class="row">
                         <div class="col-sm-12">
                            <table id="incomeTable" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="incomeTable_info">
                               <thead>
                                  <tr role="row">
                                     <th class="sorting sorting_asc" tabindex="0" aria-controls="incomeTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Ngày thu: activate to sort column descending">Ngày thu</th>
                                     <th class="sorting" tabindex="0" aria-controls="incomeTable" rowspan="1" colspan="1" aria-label="Mã phiếu: activate to sort column ascending">Mã phiếu</th>
                                     <th class="sorting" tabindex="0" aria-controls="incomeTable" rowspan="1" colspan="1" aria-label="Tiền thu: activate to sort column ascending">Tiền thu</th>
                                     <th class="sorting" tabindex="0" aria-controls="incomeTable" rowspan="1" colspan="1" aria-label="Nhân viên: activate to sort column ascending">Nhân viên</th>
                                     {{-- <th class="sorting" tabindex="0" aria-controls="incomeTable" rowspan="1" colspan="1" aria-label="Cửa hàng: activate to sort column ascending">Cửa hàng</th> --}}
                                     <th class="sorting" tabindex="0" aria-controls="incomeTable" rowspan="1" colspan="1" aria-label="Hình thức: activate to sort column ascending">Hình thức</th>
                                     {{-- <th class="sorting" tabindex="0" aria-controls="incomeTable" rowspan="1" colspan="1" aria-label="Loại thu: activate to sort column ascending">Loại thu</th> --}}
                                     {{-- <th class="sorting" tabindex="0" aria-controls="incomeTable" rowspan="1" colspan="1" aria-label="Ghi chú: activate to sort column ascending">Ghi chú</th> --}}
                                  </tr>
                               </thead>
                               <tbody class="bg-white">

                                    @foreach ($receipts as $r)
                                    <tr class="odd">
                                        <td class="dtr-control sorting_1" tabindex="0">{{date("d/m/Y",strtotime($r->created_at))}}</td>
                                        <td>{{$r->code}}</td>
                                        <td class="text-success">{{number_format($r->total_paid)}}</td>
                                        <td>{{@$users[$r->cashier]}}</td>
                                        {{-- <td>Cửa hàng HCM</td> --}}
                                        <td>{{@$payment[$r->payments_type]}}</td>
                                        {{-- <td></td> --}}
                                        {{-- <td>{{$r->note}}</td> --}}
                                     </tr>
                                    @endforeach

                               </tbody>
                               <tfoot>
                                  <tr>
                                     <th rowspan="1" colspan="1">Ngày thu</th>
                                     <th rowspan="1" colspan="1">Mã phiếu</th>
                                     <th rowspan="1" colspan="1">Tiền thu</th>
                                     <th rowspan="1" colspan="1">Nhân viên</th>
                                     {{-- <th rowspan="1" colspan="1">Cửa hàng</th> --}}
                                     <th rowspan="1" colspan="1">Hình thức</th>
                                     {{-- <th rowspan="1" colspan="1">Loại thu</th> --}}
                                     {{-- <th rowspan="1" colspan="1">Ghi chú</th> --}}
                                  </tr>
                               </tfoot>
                            </table>
                         </div>
                      </div>
                      <div class="row">

                         {{-- <div class="col-sm-12 col-md-5">
                            <div class="dataTables_info" id="incomeTable_info" role="status" aria-live="polite">Hiển thị 1 đến 1 của 1 giá trị</div>
                         </div>
                         <div class="col-sm-12 col-md-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="incomeTable_paginate">
                               <ul class="pagination">
                                  <li class="paginate_button page-item previous disabled" id="incomeTable_previous"><a href="#" aria-controls="incomeTable" data-dt-idx="0" tabindex="0" class="page-link">Trước</a></li>
                                  <li class="paginate_button page-item active"><a href="#" aria-controls="incomeTable" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                                  <li class="paginate_button page-item next disabled" id="incomeTable_next"><a href="#" aria-controls="incomeTable" data-dt-idx="2" tabindex="0" class="page-link">Sau</a></li>
                               </ul>
                            </div>
                         </div> --}}
                      </div>
                   </div>
                </div>
             </div>
             <!-- /.row -->
             <!-- /.row (main row) -->
          </div>
          <!-- /.container-fluid -->
       </section>
    </div>
 </div>
<style type="text/css">
    #productGeneralInfo {
        background-color: transparent;
        padding: 0;
        border-radius: 6px;
    }
    p {
        display: block;
        margin-block-start: 0.4em;
        margin-block-end: 0.4em;
        margin-inline-start: 0px;
        margin-inline-end: 0px;
    }
</style>
