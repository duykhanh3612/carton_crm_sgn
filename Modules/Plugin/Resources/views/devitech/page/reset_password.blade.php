<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Quên mật khẩu</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&amp;display=swap">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ assets }}plugins/fontawesome-free/css/all.min.css" />
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ assets }}plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css" />
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ assets }}plugins/icheck-bootstrap/icheck-bootstrap.min.css" />
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ assets }}plugins/jqvmap/jqvmap.min.css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ assets }}dist/css/adminlte.min.css" />
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ assets }}plugins/overlayScrollbars/css/OverlayScrollbars.min.css" />
    <link rel="stylesheet" href="{{ assets }}css/global.css" />
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper" id="loginPage">
        <div class="row">
            <div class="col-5 leftSide">
                <div class="d-flex flex-column justify-content-between h-100">
                    <div style="flex-grow: 1" class="d-flex flex-column justify-content-center align-items-center">
                        <div style="margin-bottom: 58px">
                            <img src="{{ assets }}dist/img/preloadingLogo.png" alt="Devitech logo" width="288px" />
                        </div>
                        <form id="loginForm" action="{{route("admin.user.process_reset_password")}}" class="w-100 d-flex flex-column" style="gap: 19px" method="POST"  >
                          
                             <div class="form-group">
                                <label for="password" class="mb-1">Mật khẩu</label>
                                <div class="position-relative">
                                    <input type="password" class="form-control form-login" name="password" id="password" placeholder="Nhập mật khẩu" autocomplete="on" />
                                    <button class="position-absolute bg-transparent border-transparent" style="top: 50%;right: 0;transform: translate(-50%, -50%);s" toggle="#password-field" type="button">
                                        <span toggle="#password-field" class="fa fa-fw fa-eye field_icon toggle-password"></span>
                                        <!-- <img src="/dist/img/eye-slash-1.png"   alt="Hiện mật khẩu"    width="24px"  /> -->
                                    </button>
                                </div>
                                <p class="text-danger mt-1" id="passwordWarning"></p>
                            </div>
                             
                              <div class="form-group">
                                <label for="password" class="mb-1">Xác nhận Mật khẩu</label>
                                <div class="position-relative">
                                    <input type="password" class="form-control form-login" name="confirm_password" id="confirm_password" placeholder="Xác nhận Mật khẩu" autocomplete="on" />
                                    <button class="position-absolute bg-transparent border-transparent" style="top: 50%;right: 0;transform: translate(-50%, -50%);s" toggle="#password-field" type="button">
                                        <span toggle="#password-field" class="fa fa-fw fa-eye field_icon toggle-password"></span>
                                        <!-- <img src="/dist/img/eye-slash-1.png"   alt="Hiện mật khẩu"    width="24px"  /> -->
                                    </button>
                                </div>
                                <p class="text-danger mt-1" id="passwordWarning"></p>
                            </div>
                            <!-- Button đăng nhập -->
                            <button type="submit" class="btn bg-main-yl py-3 d-flex align-items-center justify-content-center" onclick="lsRememberMe()">
                                <input type="hidden" name="token" value="{{request('token')}}" />
                                <p class="fw-500">Đổi mật khẩu</p>
                            </button>
                       
                            @csrf
                        </form>
                    </div>
                    <!-- footer -->
                    <footer class="d-flex flex-column align-items-center" style="gap: 17px">
                        <p>
                            Devi Smart © 2022 All rights reserved.
                            <a href="#" class="text-warning">Privacy Policy</a> |
                            <a href="#" class="text-warning">T&C</a> |
                            <a href="#" class="text-warning">System Status</a>
                        </p>
                        <p>Phiên bản 1.2.3</p>
                    </footer>
                </div>
            </div>
            <div class="col-7 rightSide">
                <img src="{{ assets }}dist/img/logoLoginPage.png" alt="Devitech Logo" width="455px" />
            </div>
        </div>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ assets }}plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ assets }}plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge("uibutton", $.ui.button);
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ assets }}plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- JQVMap -->
    <script src="{{ assets }}plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="{{ assets }}plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ assets }}plugins/jquery-knob/jquery.knob.min.js"></script>

    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ assets }}plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- overlayScrollbars -->
    <script src="{{ assets }}plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ assets }}dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ assets }}dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ assets }}dist/js/pages/dashboard.js"></script>

    <!-- checkbox ghi nhớ đăng nhập -->
    <script>
        $(document).on("click", ".toggle-password", function (event) {
        event.preventDefault();
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $("#password");
        input.attr("type") === "password"
          ? input.attr("type", "text")
          : input.attr("type", "password");
      });
    </script>

    <!-- Lưu/xóa thông tin người dùng trên localStorage -->
    <script>
        // Kiểm tra Ghi nhớ đăng nhập
      const rmCheck = document.getElementById("rememberMe"),
        accountInput = document.getElementById("account"),
        passwordInput = document.getElementById("password");

      if (localStorage.checkbox && localStorage.checkbox !== "") {
        rmCheck.setAttribute("checked", "checked");
        accountInput.value = localStorage.username;
      } else {
        rmCheck.removeAttribute("checked");
        accountInput.value = "";
      }

      function lsRememberMe() {
        if (rmCheck.checked && accountInput.value !== "") {
          localStorage.userName = accountInput.value;
          localStorage.checkbox = rmCheck.value;
          localStorage.userPassword = passwordInput.value;
        } else {
          localStorage.userName = "";
          localStorage.checkbox = "";
          localStorage.userPassword = "";
        }
      }
    </script>

    <!-- Check form đăng nhập -->
    <script>
    //     $(document).on("submit","#loginForm",function(event){
    //         event.preventDefault();
    //         var check = true;
    //         // Check rỗng account
    //         if (accountInput.value == "") {
    //                 check = false;
    //                 document.getElementById("accountWarning").innerText ="Vui lòng không để trống";
    //                 document.getElementById("account").focus();
    //                 check = false;
    //                 return;
    //         } else {
    //             document.getElementById("accountWarning").innerText = "";
    //             check = true;
    //         }
    //         // Check rỗng mật khẩu
    //         if (passwordInput.value == "") {
    //             check = false;
    //             document.getElementById("passwordWarning").innerText = "Vui lòng không để trống";
    //             document.getElementById("password").focus();
    //             check = false;
    //             return;
    //         } else {
    //             document.getElementById("passwordWarning").innerText = "";
    //             check = true;
    //         }

    //         // Chuyển trang chủ (Thống kê)
    //         if (check) {
    //             // $("#loginForm").attr("action","{{route("admin.user.process_login")}}");
    //             $("#loginForm").submit();
    //         }
    //   });
    </script>
    <script>
        function resetFilter() {
            document.getElementById("filterForm").reset();
        }
    </script>
</body>

</html>
