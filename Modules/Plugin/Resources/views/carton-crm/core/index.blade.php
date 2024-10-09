<!-- Content Wrapper. Contains page content -->

{!! Themes::modules('header', $module) !!}

{!! Themes::modules('filter', $module) !!}

<!-- Table -->
<section class="content">
    <div class="container-fluid">
        <div class="card-tools">
            <div class="card-body">
                <div class="table-container" id="main-tab">
                    <input type="hidden" id="request_data" value="{{ json_encode(request()) }}" />
                    <input type="hidden" id="current_tab" value="{{ request()->current_tab ?? 0 }}" />
                    <input type="hidden" id="sort_column" value="{{ request()->sort_column ?? 1 }}" />
                    <input type="hidden" id="sort_field" value="{{ request()->sort_field ?? 'id' }}" />
                    <input type="hidden" id="sort_order" value="{{ request()->sort_order ?? 'desc' }}" />
                    <table id="example2" class="table table-bordered table-hover dataTable dtr-inline sortable" data-action="{{@$module->action_page_detail}}">
                        <thead>
                            <tr class="table-secondary">
                                @if($module->input_check)
                                <th class="stt unorderable"><input type="checkbox" class="cb-element custom-checkbox check-all" for="ids"  /></th>
                                @endif
                                @if($module->line_number)
                                <th class="stt">STT</th>
                                @endif
                                @php
                                foreach ($cols as $key=> $col) {
                                    echo col_name($col, $key);
                                }
                                @endphp
                                <th class="col_action text-center headtxt orderable sorting" style="width: 50px;max-width: 50px;white-space:nowrap">Hành động</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @if (!empty($rows))
                            @foreach ($rows as $key => $row)
                            <tr class="highlight" id="{{ $row->id }}">
                                @if($module->input_check)
                                    <td class="text-center">{!! sel_item($row->id,false,false,"ids") !!}</td>
                                @endif
                                @if($module->line_number)

                                <td class="stt text-center">
                                    {{ $rows->firstItem() + $key++ }}</td>
                                @endif

                                {!! component('display_view', ['cols' => $cols, 'row' => $row]) !!}
                                <td class="col_action text-center " width="50" >
                                    <button data-href="{{ url('admin/' . $module->file . '/update/' . $row->id) }}" data-toggle="{{@$module->action_page_detail}}" data-target="#modalFormUpdate" style="background: transparent; border: none; width: 20px; height: 20px; padding: unset; margin-right: 6px;">
                                        {{-- <img src="{{ assets }}dist/img/icon/fix.png" alt="Chính sửa" width="20px" style="vertical-align: unset;" /> --}}
                                        <i class="fa fa-edit text-success"></i>
                                    </button>
                                    @if(check_rights($module->file,"delete"))
                                    <button data-href="{{ url('admin/' . $module->file . '/delete/' . $row->id) }}" data-toggle="confirm" data-target="#deleteUser" style="background: transparent; border: none; width: 20px; height: 20px; padding: unset;">
                                        {{-- <img src="{{ assets }}dist/img/icon/delete.png" alt="Chính sửa" width="20px" style="vertical-align: unset;" /> --}}
                                        <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                                    </button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            @else
                            {!! no_data_mes(count((array) $cols) + 3) !!}
                            @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                @if($module->input_check)
                                <th class="stt"><input type="checkbox" class="cb-element custom-checkbox check-all" for="ids"  /></th>
                                @endif
                                @if($module->line_number)
                                <th class="stt">STT</th>
                                @endif
                                @php
                                foreach ($cols as $col) {
                                    echo col_name($col);
                                }
                                @endphp
                                <th class="col_action" style="width: 50px;max-width: 50px;">Hành động</th>
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
            @if(method_exists($rows,"links"))
            <div class="paging d-flex justify-content-end mt-3 mb-3">
                {!! $rows->links("pagination.default") !!}
            </div>
            @endif
        </div>
    </div>
</section>



<!-- Modal Thêm khách hàng -->
<div class="modal fade" id="addCustomer" tabindex="-1" role="dialog" aria-labelledby="addCustomerTitle" aria-hidden="true">
    <form class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">
                    Thêm khách hàng
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Họ & Tên -->
                <div class="form-group">
                    <label for="userName">Họ & Tên</label>
                    <input type="text" class="form-control" name="userName" id="userName" placeholder="Nhập tên khách hàng" />
                </div>
                <!-- Số điện thoại, Ngày sinh, Nguồn, Giới tính -->
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="gender">Giới tính</label>
                            <select class="custom-select" id="gender">
                                <option value="1" selected>Nữ</option>
                                <option value="2">Nam</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="userDOB">Ngày sinh</label>
                            <input type="date" class="form-control" name="userDOB" id="userDOB" placeholder="Nhập tên khách hàng" />
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="userPhone">Số điện thoại</label>
                            <input type="text" class="form-control" name="userPhone" id="userPhone" placeholder="Nhập SĐT" />
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="source">Nguồn</label>
                            <select class="custom-select" id="source">
                                <option selected disabled>Chọn nguồn</option>
                                <option value="1">Từ Facebook</option>
                                <option value="2">Người quen giới thiệu</option>
                                <option value="3">Tự đến</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Địa chỉ -->
                <div class="form-group">
                    <label for="userAddress">Địa chỉ</label>
                    <input type="text" class="form-control" name="userAddress" id="userAddress" placeholder="Nhập địa chỉ" />
                </div>
                <!-- Gắn tag -->
                <div class="form-group">
                    <div class="w3-row">
                        <label for="tags">Gắn tag:</label>
                        <select name="tags" id="tags-name" multiple>
                            <option value="1">Quan tâm trẻ hóa</option>
                            <option value="2">Quan tâm triệt lông</option>
                            <option value="3">Cân nhắc về giá</option>
                            <option value="4">Khách hàng tham gia hội thảo</option>
                        </select>
                    </div>
                </div>
                <!-- Ghi chú -->
                <div class="form-group">
                    <label for="userNote">Ghi chú</label>
                    <input type="text" class="form-control" name="userNote" id="userNote" placeholder="Nhập ghi chú" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">
                    Hủy
                </button>
                <button type="submit" class="btn btn-warning">
                    Thêm khách hàng
                </button>
            </div>
        </div>
    </form>
</div>
<!-- Modal Chỉnh sửa thông tin khách hàng-->
<form>
    <div class="modal fade" id="modalFixInfoUser" tabindex="-1" role="dialog" aria-labelledby="modalFixInfoUserTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFixInfoUserLongTitle">
                        Chỉnh sửa thông tin khách hàng
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Họ & Tên -->
                    <div class="form-group">
                        <label for="userName">Họ & Tên</label>
                        <input type="text" class="form-control" name="userName" id="userName" placeholder="Nhập tên khách hàng" />
                    </div>
                    <!-- Số điện thoại, Ngày sinh, Nguồn, Giới tính -->
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="gender">Giới tính</label>
                                <select class="custom-select" id="gender">
                                    <option value="1" selected>Nữ</option>
                                    <option value="2">Nam</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="userDOB">Ngày sinh</label>
                                <input type="date" class="form-control" name="userDOB" id="userDOB" placeholder="Nhập tên khách hàng" />
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="userPhone">Số điện thoại</label>
                                <input type="text" class="form-control" name="userPhone" id="userPhone" placeholder="Nhập SĐT" />
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="source">Nguồn</label>
                                <select class="custom-select" id="source">
                                    <option selected disabled>Chọn nguồn</option>
                                    <option value="1">Từ Facebook</option>
                                    <option value="2">Người quen giới thiệu</option>
                                    <option value="3">Tự đến</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- Địa chỉ -->
                    <div class="form-group">
                        <label for="userAddress">Địa chỉ</label>
                        <input type="text" class="form-control" name="userAddress" id="userAddress" placeholder="Nhập địa chỉ" />
                    </div>
                    <!-- Gắn tag -->
                    <div class="form-group">
                        <div class="w3-row">
                            <label for="tags-name-2">Gắn tag:</label>
                            <select name="tags" id="tags-name-2" multiple>
                                <option value="1">Quan tâm trẻ hóa</option>
                                <option value="2">Quan tâm triệt lông</option>
                                <option value="3">Cân nhắc về giá</option>
                                <option value="4">Khách hàng tham gia hội thảo</option>
                            </select>
                        </div>
                    </div>
                    <!-- Ghi chú -->
                    <div class="form-group">
                        <label for="userNote">Ghi chú</label>
                        <input type="text" class="form-control" name="userNote" id="userNote" placeholder="Nhập ghi chú" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">
                        Hủy
                    </button>
                    <button type="button" class="btn btn-warning">
                        Lưu thay đổi
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalFormUpdate" tabindex="-1" role="dialog" aria-labelledby="modalFixInfoUserTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFixInfoUserLongTitle">
                        <span class="action"></span> {{ $module->name_vn }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="    max-height: 700px;    overflow-y: scroll;">
                    <div class="loader"></div>
                </div>
                <div class="modal-footer justify-content-between"  >
                    <div class="message">
                        <div id="alert_message" class="alert alert text-danger">

                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-4" style="gap: 8px; top: 0px; right: 30px">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">
                            Hủy
                        </button>
                        @if((empty($record) && check_rights($module->file,"create")) || (!empty($record) && check_rights($module->file,"update")))
                        <button type="button" class="btn btn-main" id="modalFormUpdateSubmit" style="display:none"> Cập nhật</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</form>
<!-- Modal Xác nhận xóa người dùng -->
<div class="modal fade" id="deleteUser" tabindex="-1" role="dialog" aria-labelledby="deleteUserTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">
                    Xác nhận
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-danger">
               {{ $module->action_delete_confirm_msg??__("Are you sure to delete this item") }}
            </div>
            <div class="modal-footer">
                <form>
                    <button type="button" class="btn btn-main" data-dismiss="modal">
                        Hủy
                    </button>
                    <button type="submit" class="btn btn-danger">Xóa</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tạo đơn-->
<div class="modal fade" id="addOrder" tabindex="-1" role="dialog" aria-labelledby="addOrderTitle" aria-hidden="true">
    <form class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tạo đơn</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Họ & Tên -->
                <div class="form-group">
                    <label for="userID">Mã KH/ Số điện thoại</label>
                    <input type="text" class="form-control" name="userID" id="userID" placeholder="Nhập Mã KH hoặc Số điện thoại" />
                </div>
                <!-- Số điện thoại, Ngày sinh -->
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="serviceID">Dịch vụ sản phẩm</label>
                            <select class="custom-select" id="serviceID">
                                <option selected disabled>Chọn dịch vụ</option>
                                <option value="1">Trị nám laser 1</option>
                                <option value="2">Trị nám laser 2</option>
                                <option value="3">Trị nám laser 3</option>
                                <option value="3">Trị nám laser 4</option>
                                <option value="3">Trị nám laser 5</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="quantity">Số lượng</label>
                            <input type="number" class="form-control" name="quantity" id="quantity" min="1" placeholder="Nhập số lượng" />
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="discount">Giảm giá (đồng)</label>
                            <input type="number" class="form-control" name="discount" id="discount" min="0" placeholder="Nhập giá giảm" />
                        </div>
                    </div>
                </div>
                <!-- Đã thanh toán -->
                <div class="form-group">
                    <label for="paid">Đã thanh toán (đồng)</label>
                    <input type="number" class="form-control" name="paid" id="paid" min="0" placeholder="Nhập số tiền đã thanh toán" />
                </div>
                <!-- Phương thức thanh toán -->
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="paymentMethod">Phương thức thanh toán</label>
                            <select class="custom-select" id="paymentMethod">
                                <option selected disabled>
                                    Chọn phương thức thanh toán
                                </option>
                                <option value="1">Tiền mặt</option>
                                <option value="2">Chuyển khoản</option>
                                <option value="3">Quẹt thẻ</option>
                                <option value="4">Thẻ dịch vụ</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="cardServiceID">Mã thẻ dịch vụ (nếu có)</label>
                            <input type="text" class="form-control" name="cardServiceID" id="cardServiceID" placeholder="Nhập mã thẻ dịch vụ" />
                        </div>
                    </div>
                </div>
                <!-- Ghi chú -->
                <div class="form-group">
                    <label for="userNote">Ghi chú</label>
                    <input type="text" class="form-control" name="userNote" id="userNote" placeholder="Nhập ghi chú" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">
                    Hủy
                </button>
                <button type="submit" class="btn btn-warning">Tạo đơn</button>
            </div>
        </div>
    </form>
</div>
@push('js')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.7.0/css/select.dataTables.min.css"/>
 <!-- DataTables  & Plugins -->
 {{-- <script src="{{ assets }}plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
 <script src="{{ assets }}plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
 <script src="{{ assets }}plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
 <script src="{{ assets }}plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
 <script src="{{ assets }}plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
 <script src="{{ assets }}plugins/jszip/jszip.min.js"></script>
 <script src="{{ assets }}plugins/pdfmake/pdfmake.min.js"></script>
 <script src="{{ assets }}plugins/datatables/jquery.dataTables.min.js"></script>
 <script src="{{ assets }}plugins/pdfmake/vfs_fonts.js"></script>
 <script src="{{ assets }}plugins/datatables-buttons/js/buttons.html5.min.js"></script>
 <script src="{{ assets }}plugins/datatables-buttons/js/buttons.print.min.js"></script>
 <script src="{{ assets }}plugins/datatables-buttons/js/buttons.colVis.min.js"></script> --}}
 <script src="{{ base }}themes/admin/js/jquery.dataTables.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/TableDnD/1.0.5/jquery.tablednd.min.js" integrity="sha512-uzT009qnQ625C6M8eTX9pvhFJDn/YTYChW+YTOs9bZrcLN70Nhj82/by6yS9HG5TvjVnZ8yx/GTD+qUKyQ9wwQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 <!-- Select DataTable -->
 <script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>
<style type="text/css">
    .loader {
        border: 16px solid #f3f3f3;
        border-top: 16px solid #3498db;
        border-radius: 50%;
        width: 120px;
        height: 120px;
        animation: spin 2s linear infinite;
        margin: 30px auto !important;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    #modalFormUpdate .modal-body {
        padding: 0;
    }

    #modalFormUpdate .content-header {
        display: none;
    }

    #modalFormUpdate .content-wrapper-box {
        padding: 14px 0 10px 0;
        margin: 0;

    }

    .paging nav {
        display: flex;
    }

    .paging svg {
        height: 16px;
    }

    .paging>nav>div:first-child {
        display: none;
    }

    .paging>nav>div:nth-child(2) {
        display: flex;
        justify-content: space-between;
        width: 100%;
    }

    .paging>nav span[aria-current='page'] span {
        background-color: var(--secondary_bg_color) !important;
        border-color: #ffd700 !important;
        z-index: 3;
        color: #fff !important;
    }

    table.freeze_last_column thead th:last-child {
        position: sticky !important;
        right: -10px;
        z-index: 100;
        background: #d1d1d1;
        ;
    }
    table.freeze_last_column thead th:last-child::before{
        content: "" !important;
        border-left: 1px solid #ebe2e2;
        height: 100%;
        display: inline-block !important;
        width: 2px !important;
        position: absolute !important;
        top: 0 !important;
        left: 0;
        transform: translateY(0%) !important;
    }
    table.freeze_last_column tbody td:last-child {
        position: sticky !important;
        right:-10px;
        background: white;
        z-index: 1;
    }

    table.freeze_last_column tbody td:last-child::before {
        content: "";
        border-left: 1px solid #ebe2e2;
        height: 100%;
        display: inline-block;
        width: 2px;
        position: absolute;
        top: 0;
        left: 0;
    }

    table.freeze_last_column tfoot th:last-child {
        position: sticky !important;
        right: -10px;
        background: #f7f7f7;
        z-index: 1;
    }

    table.freeze_last_column tfoot th:last-child::before {
        content: "";
        border-left: 1px solid #ebe2e2;
        height: 100%;
        display: inline-block;
        width: 100%;
        position: absolute;
        top: 0;
        left: 0;
    }
    table a{
        color: var(--primary_color);
    }
    table .stt{
        min-width: 50px !important;
        width: 50px !important;
        max-width: 50px !important;
        padding-right: 0 !important;
        padding: 0 !important;
    }
    table .col_action {
        min-width: 150px !important;
        width: 150px !important;
        padding-right: 0 !important;
        padding: 0 !important;
    }
    table .stt::before, table .stt::after, table .col_action::before, table .col_action::after{
        content: "" !important;
    }
</style>
<script>
    // $(document).on("click", "button[data-toggle]", function() {
    //     type = $(this).data("toggle");
    //     if(type=="popup")
    //     {
    //         $("#modalFormUpdateSubmit").hide();
    //         href = $(this).data('href');
    //         target = $($(this).data('target'));
    //         target.modal("show");
    //         target.find(".modal-body").html(`<div class="loader"></div>`);
    //         $.ajax({
    //             url: href,
    //             type: "POST",
    //             headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             },
    //             error: function error(response) {
    //                 // if (response.status === 419) {
    //                 //   $.notify({
    //                 //     type: 'danger',
    //                 //     message: 'CSRF Token is expired! <br>This page will be refreshed.'
    //                 //   });
    //                 //   setTimeout(function () {
    //                 //     window.location.href = window.location.href;
    //                 //   }, 1000);
    //                 // }
    //                 // console.log(response);
    //             },
    //             success: function success(response) {

    //                 target.find(".modal-body").html(response);
    //                 target.find("form").find(".modal-footer").hide();
    //                 $("#modalFormUpdateSubmit").show();
    //                 target.find(".select2").select2({
    //                     dropdownParent: $('#modalFormUpdate')
    //                 });
    //                 $("#updateFrm").submit(function(){
    //                     $.LoadingOverlay("show");
    //                 });
    //             },
    //             complete: function complete(response) {
    //                 // self.removeAttr('disabled');

    //             }
    //         });
    //     }
    //     else if(type=="confirm")
    //     {
    //         href = $(this).data('href');
    //         target = $($(this).data('target'));
    //         target.modal("show");
    //         target.find("form").attr("action", href);
    //     }
    //     else{
    //         href = $(this).data('href');
    //         if(href!=undefined && href != "")
    //             window.location = href;
    //     }

    // });
    $(document).on('click',"#modalFormUpdateSubmit",function(){
        $("#modalFormUpdate form").submit();
    });
    // $(document).on("click", "button[data-toggle='confirm']", function() {
    //     href = $(this).data('href');
    //     target = $($(this).data('target'));
    //     target.modal("show");
    //     target.find("form").attr("action", href);
    // });
    var formPopupModal  = "#modalFormUpdate";
    $(document).on("click", "#example2 a.link_detail", function(e) {
        table = $(this).closest("table")
        action = $(this).data("action");
        if(action=="popup")
        {
            e.preventDefault();
            href = $(this).attr('href');
            target = $("#modalFormUpdate");
            target.modal("show");
            target.find(".modal-body").html(`<div class="loader"></div>`);
            $("#modalFormUpdateSubmit").hide();
            $.ajax({
                url: href,
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                error: function error(response) {
                    // if (response.status === 419) {
                    //   $.notify({
                    //     type: 'danger',
                    //     message: 'CSRF Token is expired! <br>This page will be refreshed.'
                    //   });
                    //   setTimeout(function () {
                    //     window.location.href = window.location.href;
                    //   }, 1000);
                    // }
                    // console.log(response);
                },
                success: function success(response) {

                    target.find(".modal-body").html(response);
                    target.find(".modal-title").find(".action").html($("#do").val());
                    target.find("form").find(".modal-footer").hide();
                    $("#modalFormUpdateSubmit").show();
                    target.find(".select2").select2({
                        dropdownParent: $('#modalFormUpdate')
                    });
                    $('body').on('shown.bs.modal', '.modal', function() {
                        $(this).find('select').each(function() {
                            var dropdownParent = $(document.body);
                            if ($(this).parents('.modal.in:first').length !== 0)
                            dropdownParent = $(this).parents('.modal.in:first');
                            $(this).select2({
                            dropdownParent: dropdownParent
                            // ...
                            });
                        });
                    });
                    //  target.find("button[type=submit]").attr('type',"button").attr("id","btn-submit");
                    //  $('#btn-submit').click(function () {
                    //     $.LoadingOverlay("show");
                    //     $("#updateFrm").submit();
                    // });

                    if(!checkValidate($('#updateFrm')))
                    {
                        $("#updateFrm").submit(function(){
                            $.LoadingOverlay("show");
                        });
                    }
                    // $("#updateFrm").submit(function(){
                    //     $.LoadingOverlay("show");
                    // });
                },
                complete: function complete(response) {
                    // self.removeAttr('disabled');
                }
            });
        }

    });

    //  DataTable
    // let example = $('#example2').DataTable({
    //     paging: false,
    //     lengthChange: false,
    //     searching: false,
    //     ordering: false,
    //     info: false,
    //     autoWidth: false,
    //     responsive: true,
    //     columnDefs: [{
    //         orderable: false,
    //         className: 'select-checkbox',
    //         targets: 0
    //     }],
    //     select: {
    //         style: 'os',
    //         selector: 'td:first-child'
    //     },
    //     order: [
    //         [1, 'asc']
    //     ]
    // });
    // example.on("click", "th.select-checkbox", function () {
    //       if ($("th.select-checkbox").hasClass("selected")) {
    //         example.rows().deselect();
    //         $("th.select-checkbox").removeClass("selected");
    //       } else {
    //         example.rows().select();
    //         $("th.select-checkbox").addClass("selected");
    //       }
    //     })
    //     .on("select deselect", function () {
    //       ("Some selection or deselection going on");
    //       if (
    //         example
    //           .rows({
    //             selected: true,
    //           })
    //           .count() !== example.rows().count()
    //       ) {
    //         $("th.select-checkbox").removeClass("selected");
    //       } else {
    //         $("th.select-checkbox").addClass("selected");
    //       }
    //     });
</script>

@endpush
