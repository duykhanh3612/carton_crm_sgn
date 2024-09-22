@php
    $data = $id = call_user_func($ctrl->att_table,request());
    print_r($data);
    /*$struct = json_decode(@$ctrl->struct);

    $group = $struct[0];
    $position = $struct[1];
    $list = $struct[2];
    $input = $struct[3];
    $field = explode(',',$list->att_field);*/
@endphp
<!--<script
  src="https://code.jquery.com/jquery-3.5.1.js"
  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
  crossorigin="anonymous"></script>-->
<div class="form-group {{  $ctrl->width}} desktop ">
    <label>
        {{        $ctrl->title }} @if        (@$ctrl->validate==1) <span style="color:#ff0000">(*)</span>@endif
    </label>

        <form action="/brief-preliminary-waiting/submit-survey" method="POST" id="form_brief_survey">
            <div class="modal-body">
                <div class="" data-always-visible="1" data-rail-visible1="1">


                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-hover table-preliminary-processing">
                                <tbody><tr>
                                    <td style="width: 50%;">
                                        <strong>Kiểm soát viên: </strong> Lê Trọng Hữu                            </td>
                                    <td>
                                        <strong>Khách
                                        hàng:</strong> <br>
        <b>Warning</b>:  A non-numeric value encountered in <b>I:\web\cenvalue_chungthu\library\Zend\Cache\Backend\File.php</b> on line <b>859</b><br>
        Ngân hàng ACB-Chi nhánh Sài Gòn - Quận 2-Phòng giao dịch                            </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong>Ngày, giờ trả lời:</strong>
                                        00:00 04/09/2020                            </td>
                                    <td>
                                        <strong>Người đề
                                        nghị:</strong>  Nguyen Van Bay                            </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong>NVKD:</strong>
                                        Nguyễn Thị Thanh Tuyền                                -0123456789                            </td>
                                    <td>

                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <strong>Loại tài
                                            sản: </strong>Quyền sở hữu CTXD                            </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <strong>Địa chỉ tài
                                            sản:</strong> 255 Võ Văn Ngân, Bình Thọ, Hồ Chí Minh, Việt Nam                            </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <strong>Mô tả tài
                                            sản:</strong>
                                        <textarea class="form-control" name="description"></textarea>
                                    </td>
                                </tr>
                            </tbody></table>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i> Kết quả thẩm định
                                    </div>

                                    <div class="pull-right">
                                        <a class="btn btn-sm red-intense margin-top-5 add-preliminary-item" data-url="/brief-preliminary-waiting/preliminary-item?briefId=91" id="table_preliminary_item_building_new">Thêm</a>
                                    </div>

                                </div>
                                <div class="portlet-body">
                                    <div class="">
                                        <div id="table_preliminary_item_building_wrapper" class="dataTables_wrapper no-footer"><div class="row"><div class="col-md-6 col-sm-6"></div><div class="col-md-6 col-sm-6"></div></div><div class="table-scrollable"><table class="table table-striped table-hover table-bordered dataTable no-footer" id="table_preliminary_item_building" role="grid">
                                            <thead>
                                            <tr role="row"><th width="200" class="sorting_asc" rowspan="1" colspan="1" aria-label="Loại hạng mục" style="width: 200px;">Loại hạng mục</th><th width="200" class="sorting" tabindex="0" aria-controls="table_preliminary_item_building" rowspan="1" colspan="1" aria-label=" Hạng mục: activate to sort column ascending" style="width: 200px;"> Hạng mục</th><th class="text-center sorting" tabindex="0" aria-controls="table_preliminary_item_building" rowspan="1" colspan="1" aria-label=" Giá trị (VND): activate to sort column ascending" style="width: 0px;"> Giá trị (VND)</th><th class="text-center sorting" tabindex="0" aria-controls="table_preliminary_item_building" rowspan="1" colspan="1" aria-label=" Đơn giá (VND/m2): activate to sort column ascending" style="width: 0px;"> Đơn giá (VND/m2)</th><th width="200" class="sorting" tabindex="0" aria-controls="table_preliminary_item_building" rowspan="1" colspan="1" aria-label="
                                                    Ghi chú
                                                : activate to sort column ascending" style="width: 200px;">
                                                    Ghi chú
                                                </th><th class="sorting" tabindex="0" aria-controls="table_preliminary_item_building" rowspan="1" colspan="1" aria-label="

                                                : activate to sort column ascending" style="width: 0px;">

                                                </th></tr>
                                            </thead>
                                            <tbody>
                                        

                                            <tr role="row" data-id="" class="odd">
                <td class="brief-survey sorting_1">
                    <select name="type" id="type" class="form-control element-type">
                        <option value="1">Quyền sử dụng đất</option>
                        <option value="2">Công trình xây dựng</option>
                    </select>
                </td>
                <td class="sorting_1 brief-survey"><input type="text" class="form-control input-small element-name" value="">
                </td>

                <td class="brief-survey"><input type="text" class="form-control input-small element-value" value=""></td>
                <td class="brief-survey"><input type="text" class="form-control input-small element-unit" value=""></td>
                <td class="brief-survey"><input type="text" class="form-control input-small element-note" value=""></td>
                <td class="brief-survey"><a class="save" href="" data-content="Save">Cập nhật</a><br></td>
            </tr></tbody>
                                        </table></div><div class="row"><div class="col-md-5 col-sm-5"></div><div class="col-md-7 col-sm-7"></div></div></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

                <input type="hidden" name="briefId" value="91" id="briefId">
                <input type="submit" class="btn btn-default red pull-right" value="Xác nhận">

            </div>
        </form>

        <script src="http://cenvalue.info/public/statics/asset/default/pages/scripts/preliminary-survey.js" type="text/javascript"></script>
        <script>
            jQuery(document).ready(function () {
                // Common.initModalAjax('.add-preliminary-item');
            });
        </script>

</div>
<style type="text/css">
.table tbody td:nth-child(1) {
    text-align:left !important;
}
        .portlet.box.green {
        border: 1px solid #5cd1db;
        border-top: 0;
    }
    .portlet.box.green > .portlet-title {
        background-color: #32c5d2;
    }
    .portlet.box.green > .portlet-title > .caption {
        color: #FFFFFF;
    }
    .portlet-title > .caption {
    padding: 11px 0 9px 0;
}
    .portlet.box > .portlet-body {
    background-color: #fff;
    padding: 15px;
}
</style>
<script>
    $('select.yesnoselect, input[type=checkbox].yesnoselect').each(function() {
		var tab = "." + $(this).val() + "." + $(this).attr("grouptarget");
		var hiddentab = "." + $(this).attr("grouptarget");
		$(hiddentab).not(tab).css("display", "none");
		$(tab).show();
	});
	$('input[type=radio].yesnoselect:checked').each(function() {
		var tab = "." + $(this).val() + "." + $(this).attr("grouptarget");
		var hiddentab = "." + $(this).attr("grouptarget");
		$(hiddentab).not(tab).css("display", "none");
		$(tab).show();
	});
	
	$('.yesnoselect').change(function(e) {
        process_group();
    });

    function process_group() {
        var branch = $('#branch').val();
        var position = $('#position').val();
        var tab = (branch != 0 ? "." + branch + "." + $('#branch').attr("grouptarget") : '') + "."+ $('#position').attr("grouptarget") + "." + position;
		var hiddentab = "." + $('#branch').attr("grouptarget");
		$(hiddentab).not(tab).css("display", "none");
		$(tab).fadeIn();
    }
</script>
