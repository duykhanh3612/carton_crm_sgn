<div class="form-group {{  $ctrl->width}} desktop ">
    <label>
        {{        $ctrl->title }} @if        (@$ctrl->validate==1) <span style="color:#ff0000">(*)</span>@endif
    </label>
    <div class="" data-always-visible="1" data-rail-visible1="1">
        <form action="/brief-preliminary-assignment" class="form-horizontal" id="form_assignment">
            <div class="form-body">


                <div class="row" style="margin-bottom: 15px;">
                    <div class="col-md-9">
                        <div class="row">
                            <label class="control-label col-md-4" style="text-align:right;">Chi nhánh</label>

                            <div class="col-md-8">
                                <select name="branch" id="branch" class="form-control">
                                    <option value="0">Tất cả chi nhánh</option>
                                    <option value="1" selected="selected">Cen HCM</option>
                                    <option value="2">Cen Cần Thơ</option>
                                    <option value="3">Cen Đà Nẵng</option>
                                    <option value="4">Bình Dương - Đồng Nai</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-bottom: 15px;">

                    <div class="col-md-9">
                        <div class="row">
                            <label class="control-label col-md-4" for="department"  style="text-align:right;">Chuyên viên</label>
                            <div class="col-md-8">
                                 <select name="account-group" id="account-group" class="form-control">
                                    <option value="5">Kiểm soát</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3" style="text-align:right;">                        
                        <input type="hidden" name="brief-id" value="114" id="brief-id">
                        <a href="#" class="btn blue pull-right" data-id="0" data-url="/brief-preliminary-assignment/assign-account" id="btn_search_assign_account"><i class="fa fa-search"></i>&nbsp;Tìm kiếm</a>
                    </div>
                </div>

            </div>
        </form>
        <!-- END FORM-->

        <div class="row">
            <div class="col-md-12">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-cogs"></i> Thành viên tham gia
                        </div>


                    </div>
                    <div class="portlet-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="table_report_revenue">
                                <thead>
                                <tr>
                                    <th> Thành viên</th>
                                    <th class="text-center"> Sơ bộ <br>đang thực hiện</th>
                                    <th class="text-center"> Chứng thư <br>đang thực hiện</th>
                                    <th class="text-center"> Chứng thư <br>đã phát hành</th>

                                    <th>
                                        Thao tác
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr id="data-96">
                                        <td> NOTIFICATION_ASSIGNMENT</td>
                                        <td class="text-center"> 3</td>
                                        <td class="text-center">0</td>
                                        <td class="text-center">0</td>
                                        <td width="60"></td>
                                    </tr>
                                 </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
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
