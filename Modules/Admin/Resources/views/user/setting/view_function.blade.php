<div class="col-sm-12 col-md-12"
     style="margin-top: 20px;">
    <h3 class="ng-binding">Chức năng cho nhóm người dùng</h3>
    <div class="table-responsive">
        <table id="funtions_for_user"
               class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th class="center border white-bg ng-binding">Chức năng</th>
                    <th class="center border">
                        <span class="show-640 ng-binding">Chủ CH</span>
                        <span class="hidden ng-binding">Chủ cửa hàng</span>
                    </th>
                    <th class="center border"><span class="show-640 ng-binding">QL</span><span class="hidden ng-binding">Quản lý</span></th>
                    <th class="center border"><span class="show-640 ng-binding">NVBH</span><span class="hidden ng-binding">Nhân viên bán hàng</span></th>
                    <th class="center border"><span class="show-640 ng-binding">Kho</span><span class="hidden ng-binding">Quản lý kho</span></th>
                    <th class="center border"><span class="show-640 ng-binding">Thu ngân</span><span class="hidden ng-binding">Nhân viên thu ngân</span></th>
                </tr>
            </thead>
            <tbody>
                @foreach(Modules::where("menu",1)->get() as $module)
                <tr>
                    <td class="center border hl ng-binding">{{$module->name_en}}</td>
                    @foreach(Groups::get() as $group)
                    <td class="center border update_permission" data-group="{{$group->id}}" data-function="{{$module->id}}">
                        @if(Groups::check_right($group->id, $module->id))
                        <i class="fa fa-check green"></i>
                        @else
                        <i class="fa fa-remove red"></i>
                        @endif
                    </td>
                    @endforeach
                    {{-- <td class="center border">
                        @if(Groups::check_right(2, $module->id))
                        <i class="fa fa-check green"></i>
                        @else
                        <i class="fa fa-remove red"></i>
                        @endif
                    </td>
                    <td class="center border">
                        @if(Groups::check_right(3, $module->id))
                        <i class="fa fa-check green"></i>
                        @else
                        <i class="fa fa-remove red"></i>
                        @endif
                    </td>
                    <td class="center border">
                        @if(Groups::check_right(4, $module->id))
                        <i class="fa fa-check green"></i>
                        @else
                        <i class="fa fa-remove red"></i>
                        @endif
                    </td>
                    <td class="center border">
                        @if(Groups::check_right(5, $module->id))
                        <i class="fa fa-check green"></i>
                        @else
                        <i class="fa fa-remove red"></i>
                        @endif
                    </td> --}}
                </tr>
                @endforeach
                {{-- <tr>
                    <td class="center border hl ng-binding">Bán hàng - POS</td>
                    <td class="center border"><i class="fa fa-check green"></i></td>
                    <td class="center border"><i class="fa fa-check green"></i></td>
                    <td class="center border"><i class="fa fa-check green"></i></td>
                    <td class="center border"><i class="fa fa-check green"></i></td>
                    <td class="center border"><i class="fa fa-check green"></i></td>
                </tr>
                <tr>
                    <td class="center border hl ng-binding">Báo cáo cuối ngày</td>
                    <td class="center border"><i class="fa fa-check green"></i></td>
                    <td class="center border"><i class="fa fa-check green"></i></td>
                    <td class="center border"><i class="fa fa-check green"></i></td>
                    <td class="center border"><i class="fa fa-check green"></i></td>
                    <td class="center border"><i class="fa fa-check green"></i></td>
                </tr>
                <tr>
                    <td class="center border hl ng-binding">Hàng hóa</td>
                    <td class="center border"><i class="fa fa-check green"></i></td>
                    <td class="center border"><i class="fa fa-check green"></i></td>
                    <td class="center border"><i class="fa fa-remove red"></i></td>
                    <td class="center border"><i class="fa fa-check green"></i></td>
                    <td class="center border"><i class="fa fa-remove red"></i></td>
                </tr>
                <tr>
                    <td class="center border hl ng-binding">Đơn hàng</td>
                    <td class="center border"><i class="fa fa-check green"></i></td>
                    <td class="center border"><i class="fa fa-check green"></i></td>
                    <td class="center border"><i class="fa fa-remove red"></i></td>
                    <td class="center border"><i class="fa fa-check green"></i></td>
                    <td class="center border"><i class="fa fa-check green"></i></td>
                </tr>
                <tr>
                    <td class="center border hl ng-binding">Khách hàng/Nhà cung cấp</td>
                    <td class="center border"><i class="fa fa-check green"></i></td>
                    <td class="center border"><i class="fa fa-check green"></i></td>
                    <td class="center border"><i class="fa fa-remove red"></i></td>
                    <td class="center border"><i class="fa fa-remove red"></i></td>
                    <td class="center border"><i class="fa fa-check green"></i></td>
                </tr>
                <tr>
                    <td class="center border hl ng-binding">Tích điểm</td>
                    <td class="center border"><i class="fa fa-check green"></i></td>
                    <td class="center border"><i class="fa fa-remove red"></i></td>
                    <td class="center border"><i class="fa fa-remove red"></i></td>
                    <td class="center border"><i class="fa fa-remove red"></i></td>
                    <td class="center border"><i class="fa fa-remove red"></i></td>
                </tr>
                <tr>
                    <td class="center border hl ng-binding">Nhập kho</td>
                    <td class="center border"><i class="fa fa-check green"></i></td>
                    <td class="center border"><i class="fa fa-check green"></i></td>
                    <td class="center border"><i class="fa fa-remove red"></i></td>
                    <td class="center border"><i class="fa fa-check green"></i></td>
                    <td class="center border"><i class="fa fa-remove red"></i></td>
                </tr>
                <tr>
                    <td class="center border hl ng-binding">Chuyển kho</td>
                    <td class="center border"><i class="fa fa-check green"></i></td>
                    <td class="center border"><i class="fa fa-check green"></i></td>
                    <td class="center border"><i class="fa fa-remove red"></i></td>
                    <td class="center border"><i class="fa fa-check green"></i></td>
                    <td class="center border"><i class="fa fa-remove red"></i></td>
                </tr>
                <tr>
                    <td class="center border hl ng-binding">Tồn kho</td>
                    <td class="center border"><i class="fa fa-check green"></i></td>
                    <td class="center border"><i class="fa fa-check green"></i></td>
                    <td class="center border"><i class="fa fa-remove red"></i></td>
                    <td class="center border"><i class="fa fa-check green"></i></td>
                    <td class="center border"><i class="fa fa-remove red"></i></td>
                </tr>
                <tr>
                    <td class="center border hl ng-binding">Nhập xuất tồn</td>
                    <td class="center border"><i class="fa fa-check green"></i></td>
                    <td class="center border"><i class="fa fa-check green"></i></td>
                    <td class="center border"><i class="fa fa-remove red"></i></td>
                    <td class="center border"><i class="fa fa-check green"></i></td>
                    <td class="center border"><i class="fa fa-remove red"></i></td>
                </tr>
                <tr>
                    <td class="center border hl ng-binding">Kiểm kê</td>
                    <td class="center border"><i class="fa fa-check green"></i></td>
                    <td class="center border"><i class="fa fa-check green"></i></td>
                    <td class="center border"><i class="fa fa-remove red"></i></td>
                    <td class="center border"><i class="fa fa-check green"></i></td>
                    <td class="center border"><i class="fa fa-remove red"></i></td>
                </tr>
                <tr>
                    <td class="center border hl ng-binding">Khuyến mãi</td>
                    <td class="center border"><i class="fa fa-check green"></i></td>
                    <td class="center border"><i class="fa fa-check green"></i></td>
                    <td class="center border"><i class="fa fa-remove red"></i></td>
                    <td class="center border"><i class="fa fa-remove red"></i></td>
                    <td class="center border"><i class="fa fa-remove red"></i></td>
                </tr>
                <tr>
                    <td class="center border hl ng-binding">Doanh số</td>
                    <td class="center border"><i class="fa fa-check green"></i></td>
                    <td class="center border"><i class="fa fa-check green"></i></td>
                    <td class="center border"><i class="fa fa-remove red"></i></td>
                    <td class="center border"><i class="fa fa-remove red"></i></td>
                    <td class="center border"><i class="fa fa-check green"></i></td>
                </tr>
                <tr>
                    <td class="center border hl ng-binding">Thu chi</td>
                    <td class="center border"><i class="fa fa-check green"></i></td>
                    <td class="center border"><i class="fa fa-check green"></i></td>
                    <td class="center border"><i class="fa fa-remove red"></i></td>
                    <td class="center border"><i class="fa fa-remove red"></i></td>
                    <td class="center border"><i class="fa fa-check green"></i></td>
                </tr>
                <tr>
                    <td class="center border hl ng-binding">Sổ quỹ</td>
                    <td class="center border"><i class="fa fa-check green"></i></td>
                    <td class="center border"><i class="fa fa-remove red"></i></td>
                    <td class="center border"><i class="fa fa-remove red"></i></td>
                    <td class="center border"><i class="fa fa-remove red"></i></td>
                    <td class="center border"><i class="fa fa-remove red"></i></td>
                </tr>
                <tr>
                    <td class="center border hl ng-binding">Lợi nhuận</td>
                    <td class="center border"><i class="fa fa-check green"></i></td>
                    <td class="center border"><i class="fa fa-remove red"></i></td>
                    <td class="center border"><i class="fa fa-remove red"></i></td>
                    <td class="center border"><i class="fa fa-remove red"></i></td>
                    <td class="center border"><i class="fa fa-remove red"></i></td>
                </tr>
                <tr>
                    <td class="center border hl ng-binding">Thiết lập <span class="hidden ng-binding"
                              style="font-weight: normal">(Thông tin cửa hàng, nhân viên, thiết lập bán hàng, quản
                            lý mẫu in)</span> </td>
                    <td class="center border"><i class="fa fa-check green"></i></td>
                    <td class="center border"><i class="fa fa-remove red"></i></td>
                    <td class="center border"><i class="fa fa-remove red"></i></td>
                    <td class="center border"><i class="fa fa-remove red"></i></td>
                    <td class="center border"><i class="fa fa-remove red"></i></td>
                </tr> --}}
            </tbody>
        </table>
    </div>
    <div class="col-xs-12">
        <h3 class="main-color ng-binding">Lưu ý</h3>
        <p><i class="ng-binding"><strong class="ng-binding">[Chủ cửa hàng]</strong> mới được xem giá vốn của
                hàng hóa và báo cáo lợi nhuận</i></p>
        <p><i class="ng-binding"><strong class="ng-binding">[Quản lý]</strong> không xóa được dữ liệu. Để xóa
                được dữ liệu, cần liên hệ </i></p>
        <p><i class="ng-binding"><strong class="ng-binding">[Nhân viên bán hàng]</strong> chỉ được bán hàng,
                nhập trả hàng và xem báo cáo cuối ngày từ POS</i></p>
        <p><i class="ng-binding"><strong class="ng-binding">[Quản lý kho]</strong> chỉ được quản lý hàng hóa,
                quản lý kho, xem báo cáo nhập xuất tồn, kiểm kê</i></p>
        <p><i class="ng-binding"><strong class="ng-binding">[Nhân viên thu ngân]</strong> chỉ được bán hàng,
                nhập trả hàng và xem báo cáo cuối ngày từ POS và quản lý khách hàng</i></p>
    </div>
</div>
@push("js")
<style type="text/css">
#funtions_for_user .update_permission{
    cursor: pointer;
}
</style>
<script>
$(document).on("click",".update_permission i",function(){
    td = $(this).closest("td");
    group = td.data("group");
    func = td.data("function");
    permission = $(this).hasClass("fa-check")?0:1;
    tag = $(this);
    $.ajax({
        method: "POST",
        url: "{{ route('admin.group.update.permission') }}",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            group: group, func : func,permission:permission
        }
    }).done(function(res) {
        if(permission)
        {
            tag.removeClass("fa-remove red").addClass("fa-check green");
        }
        else{

            tag.removeClass("fa-check green").addClass("fa-remove red");
        }
    });
});
</script>
@endpush
