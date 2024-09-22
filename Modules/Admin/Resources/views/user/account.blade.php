<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0 text-uppercase font-weight-bold">
                    Trang cá nhân
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
        <!-- avatar -->
        <div class="d-flex align-items-center mx-4 mb-5">
            <!-- avatar left side -->
            <div style="width: 230px">
                <div class="avatar-wrapper">
                    <img class="profile-pic" id="profile-pic" src="{{image_link(auth()->user()->avatar)}}" />
                    <div class="upload-button">
                        <img src="{{assets}}dist/img/icon/camera.png" alt="Đổi ảnh đại diện" width="40px" id="avatar-upload" />
                    </div>
                    <input class="file-upload" type="file" id="file-upload" accept="image/*" onchange="loadFile(event)" />
                </div>
            </div>
            <!-- script right side -->
            <div>
                <i style="color: #7a7a7a; font-size: 12px">Để được chất lượng tốt nhất vui lòng
                    chọn ảnh kích thước 450px x 450px.<br />Dung
                    lượng tối đa 5mb</i>
            </div>
        </div>
        <!-- Thông tin cá nhân title -->
        <div class="d-flex align-items-center mx-4 mb-3" id="userInfoTitle">
            <!--  left side -->
            <div style="width: 230px">
                <h4>THÔNG TIN CÁ NHÂN</h4>
            </div>
            <!-- right side -->
            <div class="rightSide"></div>
        </div>
        <!-- Thông tin cá nhân chi tiết -->
        <form id="userInfoDetail" action="{{route('admin.profile.update')}}" class="mx-4" method="POST">
            <div class="row">
                <!-- Tên đầy đủ -->
                <div class="col-6 item">
                    <div class="form-group">
                        <label for="userName">Tên đầy đủ</label>
                        <input type="text" class="form-control" name="full_name" id="full_name" placeholder="Nhập tên " value="{{auth()->user()->full_name}}" />
                    </div>
                </div>
                <!-- Số điện thoại -->
                <div class="col-6 item">
                    <div class="form-group">
                        <label for="userName">Số điện thoại</label>
                        <input type="text" class="form-control" name="phone" id="phone" placeholder="Nhập số điện thoại " value="{{auth()->user()->phone}}" {{auth()->user()->type=="2"?'disabled':''}} />
                    </div>
                </div>
                <!-- Tên đầy đủ -->
                {{-- <div class="col-6 mt-4 item">
                    <div class="form-group">
                        <label for="userName">Chức danh</label>
                        <input type="text" class="form-control" name="userName" id="userName" placeholder="Nhập tên " value="Admin" disabled />
                    </div>
                </div> --}}
            </div>
            <!-- button lưu thay đổi -->
            <div class="d-flex justify-content-end pt-2">
                <button type="submit" class="btn bg-main-blue">
                    <p class="fw-500 text-white">
                        Lưu thay đổi
                    </p>
                </button>
                        @csrf
            </div>
        </form>
        <div class="d-flex align-items-center mx-4 mb-3" id="userInfoTitle">
            <!--  left side -->
            <div style="width: 230px">
                <h4>MẬT KHẨU</h4>
            </div>
            <!-- right side -->
            <div class="rightSide"></div>
        </div>
        <!-- Thông tin cá nhân chi tiết -->
        <form id="userInfoPassword" action="{{route('admin.profile.update_password')}}" class="mx-4" method="POST">
            @if($errors->any())
            <h4 styel="color:red">{{$errors->first()}}</h4>
            @endif
            <div class="row">
                <!-- Tên đầy đủ -->
                <div class="col-6 item">
                    <div class="form-group">
                        <label for="userName">Mật khẩu</label>
                               <input type="password"
                                       class="form-control"
                                       name="password"
                                       id="password"
                                       placeholder="Nhập mật khẩu " required
                                       value="" />
                    </div>
                </div>
                <!-- Số điện thoại -->
                <div class="col-6 item">
                    <div class="form-group">
                        <label for="userName">Xác nhận mật khẩu</label>
                                <input type="password"
                                       class="form-control"
                                       name="password_confirmation"
                                       id="password_confirmation"
                                       placeholder="Nhập xác nhận mật khẩu" required
                                       value="" />
                    </div>
                </div>

            </div>
            <!-- button lưu thay đổi -->
            <div class="d-flex justify-content-end pt-2">
                <button type="button" class="btn bg-main-blue" id="btnInfoPassword">
                    <p class="fw-500 text-white"> Lưu thay đổi </p>
                </button>
                @csrf
            </div>
        </form>
    </div>
    <!-- /.container-fluid -->
</section>

@push("js")
<script>
    $(document).on("click","#btnInfoPassword",function(){
    hasError = false;
    message = "";
    if($("#password").val()=="")
    {
        hasError = true;
        alert("Mật khẩu không  được để trống");
    }
    if($("#password").val() != $("#password_confirmation").val())
    {
        hasError = true;
        alert("Mật khẩu xác nhận không chính xác");
    }

    if(!hasError)
    {
        $("#userInfoPassword").submit();
    }
});
$(document).on("click","#avatar-upload",function(){
    $('#file-upload').trigger('click');
});
$(document).on("change","#file-upload",function(){
    // var files = $("#file-upload");
    // var file_data = files[0].files;
    var form_data = new FormData();
    form_data.append("file",  $(this).prop("files")[0]);
    $.ajax({
        url: "{{ url('admin/account/avatar') }}",
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
        }
    });
});
var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
    var output = document.getElementById('profile-pic');
    output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
};
</script>
@endpush
