<!-- Main content -->
<section class="content">
    <div class="container-fluid py-14">
       <!-- Filter -->
       <form id="filterForm2">
          <div class="d-flex justify-content-end" style="gap: 42px; margin: 30px 6.5px">
             <!-- Xác nhận lọc và reset bộ lọc -->
             <div class="d-flex align-items-center" style="gap: 14px">
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
                      <img src="{{assets}}dist/img/icon/calendar.png" style="width:14px">
                      <p class="mb-0">Thời gian</p>
                   </div>
                </div>
                <!-- Lọc -->
                <button type="button" class="btn bg-main-blue d-flex align-items-center justify-content-center text-white">
                   <div class="d-flex align-items-center">
                      <img src="{{assets}}dist/img/icon/fill.png" alt="" style="width: 14px">
                   </div>
                   <p>Lọc</p>
                </button>
             </div>
          </div>
       </form>
       <!-- content -->
       <div class="row">
          <!-- small box Tồn quỹ-->
          {{-- <div class="col-lg-3 col-6" style="padding: 0 10px">
             <div class="small-box bg-info" style="
                filter: drop-shadow(
                22px 22px 36px rgba(44, 44, 44, 0.08)
                );
                ">
                <div class="inner">
                   <!-- title -->
                   <p class="fw-500 text-center text-white text-xl">
                      Tồn quỹ
                   </p>
                   <!-- số liệu -->
                   <div class="soLieu">
                      <p class="text-center text-xl">0</p>
                   </div>
                </div>
             </div>
          </div> --}}
          <!-- small box Đầu kỳ-->
          {{-- <div class="col-lg-3 col-6" style="padding: 0 10px">
             <div class="small-box bg-success" style="
                filter: drop-shadow(
                22px 22px 36px rgba(44, 44, 44, 0.08)
                );
                ">
                <div class="inner">
                   <!-- title -->
                   <p class="fw-500 text-center text-white text-xl">
                      Đầu kỳ
                   </p>
                   <!-- số liệu -->
                   <div class="soLieu">
                      <p class="text-center text-xl">0</p>
                   </div>
                </div>
             </div>
          </div> --}}
          <!-- small box Thu-->
          <div class="col-lg-3 col-6" style="padding: 0 10px">
             <div class="small-box bg-warning" style="filter: drop-shadow(22px 22px 36px rgba(44, 44, 44, 0.08));">
                <div class="inner">
                   <p class="fw-500 text-center text-xl">Thu</p>
                   <div class="soLieu">
                      <p class="text-center text-xl">0</p>
                   </div>
                </div>
             </div>
          </div>
          <!-- small box Chi-->
          {{-- <div class="col-lg-3 col-6" style="padding: 0 10px">
             <div class="small-box bg-danger" style="
                filter: drop-shadow(
                22px 22px 36px rgba(44, 44, 44, 0.08)
                );
                ">
                <div class="inner">
                   <!-- title -->
                   <p class="fw-500 text-center text-xl">Chi</p>
                   <!-- số liệu -->
                   <div class="soLieu">
                      <p class="text-center text-xl">300.000.000</p>
                   </div>
                </div>
             </div>
          </div> --}}
       </div>
       <!-- /.row -->
       <div class="row">
          <!-- DÒNG TIỀN THEO SỔ -->
          <div class="col-12 col-lg-6" style="padding: 0 14px">
             <div class="card">
                <div class="card-header text-white bg-main-blue">
                   <!-- Title -->
                   <h3 class="card-title">
                      <span class="text-uppercase fw-500">dòng tiền theo sổ</span>
                   </h3>
                   <!-- Đóng mở tab -->
                   <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                      </button>
                   </div>
                </div>
                <!-- Nội dung -->
                <div class="card-body fs-16">
                   <div class="chart" style="padding: 20px 15px">
                      <!-- TIỀN MẶT -->
                      <!-- item - Tiền mặt-->
                      <div class="d-flex justify-content-between fw-500">
                         <p>Tiền mặt</p>
                         <p>0</p>
                      </div>
                      <!-- item - Đầu kỳ-->
                      <div class="d-flex justify-content-between ">
                         <p>Đầu kỳ</p>
                         <p>0</p>
                      </div>
                      <!-- item - Thu-->
                      <div class="d-flex justify-content-between ">
                         <p>Thu</p>
                         <p class="text-success">0</p>
                      </div>
                      <!-- item - Chi-->
                      <div class="d-flex justify-content-between ">
                         <p>Chi</p>
                         <p class="text-danger">(0)</p>
                      </div>
                      <!-- item - Rỗng-->
                      <div class="d-flex justify-content-between pb-3 border-bottom">
                         <br>
                      </div>
                      <!-- TÀI KHOẢN -->
                      <!-- item - Tài khoản-->
                      <div class="d-flex justify-content-between fw-500 mt-3">
                         <p>Tài khoản</p>
                         <p>0</p>
                      </div>
                      <!-- item - Đầu kỳ-->
                      <div class="d-flex justify-content-between ">
                         <p>Đầu kỳ</p>
                         <p>0</p>
                      </div>
                      <!-- item - Thu-->
                      <div class="d-flex justify-content-between ">
                         <p>Thu</p>
                         <p class="text-success">0</p>
                      </div>
                      <!-- item - Chi-->
                      <div class="d-flex justify-content-between ">
                         <p>Chi</p>
                         <p class="text-danger">(0)</p>
                      </div>
                      <!-- item - Rỗng-->
                      <div class="d-flex justify-content-between ">
                         <br>
                      </div>
                      <!-- item - Rỗng-->
                      <div class="d-flex justify-content-between ">
                         <br>
                      </div>
                   </div>
                </div>
             </div>
             <!-- /.card -->
          </div>
          <!-- DÒNG TIỀN THEO HẠNG MỤC -->
          <div class="col-12 col-lg-6" style="padding: 0 14px">
             <div class="card">
                <div class="card-header text-white bg-main-blue">
                   <!-- Title -->
                   <h3 class="card-title">
                      <span class="text-uppercase fw-500">dòng tiền theo hạng mục</span>
                   </h3>
                   <!-- Đóng mở tab -->
                   <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                      </button>
                   </div>
                </div>
                <!-- Nội dung -->
                <div class="card-body fs-16">
                   <div class="chart" style="padding: 20px 15px">
                      <!-- Thu -->
                      <!-- item - Thu-->
                      <div class="d-flex justify-content-between fw-500">
                         <p>Thu</p>
                         <p class="text-success">0</p>
                      </div>
                      <!-- item - Thu bán hàng-->
                      <div class="d-flex justify-content-between ">
                         <p>Thu bán hàng</p>
                         <p class="text-success">0</p>
                      </div>
                      <!-- item - Thu trả hàng NCC-->
                      <div class="d-flex justify-content-between ">
                         <p>Thu trả hàng NCC</p>
                         <p class="text-success">0</p>
                      </div>
                      <!-- item - Góp vốn-->
                      <div class="d-flex justify-content-between ">
                         <p>Góp vốn</p>
                         <p class="text-success">0</p>
                      </div>
                      <!-- item - Thu khác-->
                      <div class="d-flex justify-content-between pb-3 border-bottom">
                         <p>Thu khác</p>
                         <p class="text-success">0</p>
                      </div>
                      <!-- Chi -->
                      <!-- item - Chi-->
                      <div class="d-flex justify-content-between fw-500 mt-3">
                         <p>Chi</p>
                         <p class="text-danger">(0)</p>
                      </div>
                      <!-- item - Mua hàng-->
                      <div class="d-flex justify-content-between ">
                         <p>Mua hàng</p>
                         <p class="text-danger">(0)</p>
                      </div>
                      <!-- item - Khách trả hàng-->
                      <div class="d-flex justify-content-between ">
                         <p>Khách trả hàng</p>
                         <p class="text-danger">(0)</p>
                      </div>
                      <!-- item - Chi phí-->
                      <div class="d-flex justify-content-between ">
                         <p>Chi phí</p>
                         <p class="text-danger">(0)</p>
                      </div>
                      <!-- item - Rút vốn-->
                      <div class="d-flex justify-content-between ">
                         <p>Rút vốn</p>
                         <p class="text-danger">(0)</p>
                      </div>
                      <!-- item - Chi khác-->
                      <div class="d-flex justify-content-between ">
                         <p>Chi khác</p>
                         <p class="text-danger">(0)</p>
                      </div>
                   </div>
                </div>
             </div>
             <!-- /.card -->
          </div>
          <!-- PHẢI THU/PHẢI TRẢ -->
          <div class="col-12 col-lg-6 mt-3" style="padding: 0 14px ">
             <div class="card">
                <div class="card-header text-white bg-main-blue">
                   <!-- Title -->
                   <h3 class="card-title">
                      <span class="text-uppercase fw-500">PHẢI THU/PHẢI TRẢ</span>
                   </h3>
                   <!-- Đóng mở tab -->
                   <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                      </button>
                   </div>
                </div>
                <!-- Nội dung -->
                <div class="card-body fs-16">
                   <div class="chart" style="padding: 20px 15px">
                      <!-- Khoản phải thu -->
                      <!-- item - Khoản phải thu-->
                      <div class="d-flex justify-content-between fw-500">
                         <p>Khoản phải thu</p>
                         <p>0</p>
                      </div>
                      <!-- item - Khách hàng-->
                      <div class="d-flex justify-content-between pb-3 border-bottom">
                         <p>Khách hàng <i class="text-success">(Xem chi tiết)</i></p>
                         <p>0</p>
                      </div>
                      <!-- Khoản phải trả -->
                      <!-- item - Khoản phải trả-->
                      <div class="d-flex justify-content-between fw-500 mt-3">
                         <p>Khoản phải trả</p>
                         <p>0</p>
                      </div>
                   </div>
                </div>
             </div>
             <!-- /.card -->
          </div>
       </div>
    </div>
    <!-- /.container-fluid -->
 </section>
