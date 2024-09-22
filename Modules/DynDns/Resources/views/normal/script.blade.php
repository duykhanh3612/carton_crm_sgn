<link href="./assets/css/custom.css" rel="stylesheet" />
<script type="text/javascript">
		var WEBROOT = '';
		var CONFIRM_DELETE_MSG = 'Bạn có muốn tiếp tục xoá ?';
		var CONFIRM_TITLE_DIALOG = 'Xác nhận';
		var CONFIRM_DELETE_ALL = 'Bạn có muốn xoá hết?';
		var DIALOG_TITLE = 'Thông báo';
		var DIALOG_TITLE_CLOSE = 'Đóng lại';
		var BTN_DIALOG_OK = 'Tiếp tục';
		var BTN_DIALOG_CANCEL = 'Bỏ qua';
		var TTL_GOTOTOP = '';
		var MENUNAME = '';

		var VALIDATE_REQUIRED = 'Bạn không được để trống chỗ này !';
		var VALIDATE_MINLENGTH = 'Vui lòng nhập nhiều hơn 6 kí tự !';
		var VALIDATE_EMAIL = 'Email không đúng !';
		var VALIDATE_EQUALTO = 'Mật khẩu không đúng !';

		var VALIDATE_TITLE = 'Nhập tiêu đề';
		var VALIDATE_ALIAS = 'Nhập Alias';
		var VALIDATE_PAGE = 'Chọn trang';
</script>


<script type="text/javascript" src="http://static.dyndns.site/public/plugin/ckeditor_ftp/ckeditor.js"></script>
<script type="text/javascript" src="assets/js/admin.js"></script>
<!-- dataTables-->
<script type="text/javascript" src="assets/js/vendor/jquery.dataTables.js"></script>
<script type="text/javascript" src="assets/js/vendor/dataTables.bootstrap.min.js"></script>
<!-- js for print and download -->
<script type="text/javascript" src="assets/js/vendor/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="assets/js/vendor/buttons.flash.min.js"></script>
<!--<script type="text/javascript" src="assets/js/vendor/jszip.min.js"></script>
<script type="text/javascript" src="assets/js/vendor/pdfmake.min.js"></script>-->
<script type="text/javascript" src="assets/js/vendor/vfs_fonts.js"></script>
<script type="text/javascript" src="assets/js/vendor/buttons.html5.min.js"></script>
<script type="text/javascript" src="assets/js/vendor/buttons.print.min.js"></script>
<script type="text/javascript" src="assets/js/vendor/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="assets/js/vendor/dataTables.fixedHeader.min.js"></script>

<script src="assets/js/vendor/chartJs/Chart.bundle.js"></script>
<!--<script src="assets/js/dashboard1.js"></script>-->
<!-- slimscroll js -->
<script type="text/javascript" src="assets/js/vendor/jquery.slimscroll.js"></script>
<!-- pace js -->
<script src="assets/js/vendor/pace/pace.min.js"></script>
<!-- Sparkline -->
<script src="assets/js/vendor/jquery.sparkline.min.js"></script>
<!-- main js -->
<script src="assets/js/main.js"></script>
<!-- AdminUI demo js-->
<script src="assets/js/adminUIdemo.js"></script>

<script>

   $(document).ready(function () {

      var table = $('#example2').DataTable({
         responsive: true,
         paging: false,
         "order": [],
         fixedHeader: {
            headerOffset: 40

         }
      });

   });
</script>