<div class="row-col">
    <div class="col-sm ww-md w-auto-xs light lt bg-auto  hidden-print">
        <div class="padding pos-rlt">
            <div>
                <div class="nav-active-white">
                    <ul class="nav nav-pills nav-stacked nav-sm b-b">
                        <li class="nav-item">
                            <ul class="list p-b-1" style="list-style: none;">
                                <li style="margin-bottom: 5px" onmouseover="document.getElementById('grpRow1').style.display='block'" onmouseout="document.getElementById('grpRow1').style.display='none'">
                                    <a href="http://vincityquan9.com.vn/admin/menus/1">
                                        Main Menu
                                    </a>

                                    <div id="grpRow1" style="display: none" class="pull-right">
                                        <a class="btn btn-sm success p-a-0 m-a-0" title="S?a" href="http://vincityquan9.com.vn/admin/menus/parent/1/edit">
                                            <small>
                                                &nbsp;<i class="material-icons">?</i>&nbsp;
                                            </small>
                                        </a>

                                        <button class="btn btn-sm warning p-a-0 m-a-0" data-toggle="modal" data-target="#mg-1" ui-toggle-class="bounce" title="Xóa" ui-target="#animate">
                                            <small>
                                                &nbsp;<i class="material-icons">?</i>&nbsp;
                                            </small>
                                        </button>


                                    </div>

                                </li>

                                <li style="margin-bottom: 5px" onmouseover="document.getElementById('grpRow2').style.display='block'" onmouseout="document.getElementById('grpRow2').style.display='none'">
                                    <a href="http://vincityquan9.com.vn/admin/menus/2" style="font-weight: bold;color:#0cc2aa">
                                        Quick Links
                                    </a>

                                    <div id="grpRow2" style="display: none" class="pull-right">
                                        <a class="btn btn-sm success p-a-0 m-a-0" title="S?a" href="http://vincityquan9.com.vn/admin/menus/parent/2/edit">
                                            <small>
                                                &nbsp;<i class="material-icons">?</i>&nbsp;
                                            </small>
                                        </a>

                                        <button class="btn btn-sm warning p-a-0 m-a-0" data-toggle="modal" data-target="#mg-2" ui-toggle-class="bounce" title="Xóa" ui-target="#animate">
                                            <small>
                                                &nbsp;<i class="material-icons">?</i>&nbsp;
                                            </small>
                                        </button>


                                    </div>

                                </li>

                                <li style="margin-bottom: 5px" onmouseover="document.getElementById('grpRow19').style.display='block'" onmouseout="document.getElementById('grpRow19').style.display='none'">
                                    <a href="http://vincityquan9.com.vn/admin/menus/19">
                                        test
                                    </a>

                                    <div id="grpRow19" style="display: none" class="pull-right">
                                        <a class="btn btn-sm success p-a-0 m-a-0" title="S?a" href="http://vincityquan9.com.vn/admin/menus/parent/19/edit">
                                            <small>
                                                &nbsp;<i class="material-icons">?</i>&nbsp;
                                            </small>
                                        </a>

                                        <button class="btn btn-sm warning p-a-0 m-a-0" data-toggle="modal" data-target="#mg-19" ui-toggle-class="bounce" title="Xóa" ui-target="#animate">
                                            <small>
                                                &nbsp;<i class="material-icons">?</i>&nbsp;
                                            </small>
                                        </button>


                                    </div>

                                </li>


                            </ul>
                        </li>
                    </ul>
                    <div class="p-y">
                        <form method="POST" action="http://vincityquan9.com.vn/admin/menus/store/parent?2" accept-charset="UTF-8">
                            <input name="_token" value="5c6hNNfpuyKstZcDEF1EB0pw6QPotDcWm5A48wMB" class="has-value" type="hidden">
                            <div class="input-group input-group-sm">
                                T?o Menu m?i :
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <input placeholder="Tiêu ?? Menu[ English ]" class="form-control" id="title_en" required="" name="title_en" value="" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm primary" type="submit">&nbsp;&nbsp;Add&nbsp;&nbsp;</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-sm">
        <div ui-view="" class="padding">
            <div>
                <div class="box">
                    <div class="box-header dker">
                        <h3>Quick Links</h3>
                        <small>
                            <a href="http://vincityquan9.com.vn/admin">Trang ch?</a> /
                            <a href="">Cài ??t</a> /
                            <a href="">Site Menus</a>

                        </small>
                    </div>
                    <div class="row p-a">
                        <div class="col-sm-12">
                            <a class="btn btn-fw primary" href="http://vincityquan9.com.vn/admin/menus/create/2">
                                <i class="material-icons">?</i>
                                &nbsp; T?o liên k?t m?i
                            </a>
                        </div>
                    </div>

                    <form method="POST" action="http://vincityquan9.com.vn/admin/menus/updateAll" accept-charset="UTF-8" id="menusUpdateAll">
                        <input name="_token" value="5c6hNNfpuyKstZcDEF1EB0pw6QPotDcWm5A48wMB" class="has-value" type="hidden">
                        <input name="ParentMenuId" value="2" class="has-value" type="hidden">
                        <div class="table-responsive">
                            <table class="table table-striped  b-t">
                                <thead>
                                    <tr>
                                        <th style="width:20px;">
                                            <label class="ui-check m-a-0">
                                                <input id="checkAll" class="has-value" type="checkbox"><i></i>
                                            </label>
                                        </th>
                                        <th>Link URL</th>
                                        <th class="text-center" style="width:50px;">Tr?ng thái</th>
                                        <th class="text-center" style="width:100px;">Tùy ch?n</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <label class="ui-check m-a-0">
                                                <input name="ids[]" value="13" class="has-value" type="checkbox"><i class="dark-white"></i>
                                                <input class="form-control row_no has-value" name="row_ids[]" value="13" type="hidden">
                                            </label>
                                        </td>
                                        <td>
                                            <input class="form-control row_no has-value" id="row_no" name="row_no_13" value="1" type="text">
                                            Home
                                        </td>
                                        <td class="text-center">
                                            <i class="fa fa-check text-success inline"></i>
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-sm success" href="http://vincityquan9.com.vn/admin/menus/13/edit/2">
                                                <small>
                                                    <i class="material-icons">
                                                        ?
                                                    </i> S?a
                                                </small>
                                            </a>

                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label class="ui-check m-a-0">
                                                <input name="ids[]" value="14" class="has-value" type="checkbox"><i class="dark-white"></i>
                                                <input class="form-control row_no has-value" name="row_ids[]" value="14" type="hidden">
                                            </label>
                                        </td>
                                        <td>
                                            <input class="form-control row_no has-value" id="row_no" name="row_no_14" value="2" type="text">
                                            About Us
                                        </td>
                                        <td class="text-center">
                                            <i class="fa fa-check text-success inline"></i>
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-sm success" href="http://vincityquan9.com.vn/admin/menus/14/edit/2">
                                                <small>
                                                    <i class="material-icons">
                                                        ?
                                                    </i> S?a
                                                </small>
                                            </a>

                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label class="ui-check m-a-0">
                                                <input name="ids[]" value="15" class="has-value" type="checkbox"><i class="dark-white"></i>
                                                <input class="form-control row_no has-value" name="row_ids[]" value="15" type="hidden">
                                            </label>
                                        </td>
                                        <td>
                                            <input class="form-control row_no has-value" id="row_no" name="row_no_15" value="3" type="text">
                                            Blog
                                        </td>
                                        <td class="text-center">
                                            <i class="fa fa-check text-success inline"></i>
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-sm success" href="http://vincityquan9.com.vn/admin/menus/15/edit/2">
                                                <small>
                                                    <i class="material-icons">
                                                        ?
                                                    </i> S?a
                                                </small>
                                            </a>

                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label class="ui-check m-a-0">
                                                <input name="ids[]" value="16" class="has-value" type="checkbox"><i class="dark-white"></i>
                                                <input class="form-control row_no has-value" name="row_ids[]" value="16" type="hidden">
                                            </label>
                                        </td>
                                        <td>
                                            <input class="form-control row_no has-value" id="row_no" name="row_no_16" value="4" type="text">
                                            Privacy
                                        </td>
                                        <td class="text-center">
                                            <i class="fa fa-check text-success inline"></i>
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-sm success" href="http://vincityquan9.com.vn/admin/menus/16/edit/2">
                                                <small>
                                                    <i class="material-icons">
                                                        ?
                                                    </i> S?a
                                                </small>
                                            </a>

                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label class="ui-check m-a-0">
                                                <input name="ids[]" value="17" class="has-value" type="checkbox"><i class="dark-white"></i>
                                                <input class="form-control row_no has-value" name="row_ids[]" value="17" type="hidden">
                                            </label>
                                        </td>
                                        <td>
                                            <input class="form-control row_no has-value" id="row_no" name="row_no_17" value="5" type="text">
                                            Terms &amp; Conditions
                                        </td>
                                        <td class="text-center">
                                            <i class="fa fa-check text-success inline"></i>
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-sm success" href="http://vincityquan9.com.vn/admin/menus/17/edit/2">
                                                <small>
                                                    <i class="material-icons">
                                                        ?
                                                    </i> S?a
                                                </small>
                                            </a>

                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label class="ui-check m-a-0">
                                                <input name="ids[]" value="18" class="has-value" type="checkbox"><i class="dark-white"></i>
                                                <input class="form-control row_no has-value" name="row_ids[]" value="18" type="hidden">
                                            </label>
                                        </td>
                                        <td>
                                            <input class="form-control row_no has-value" id="row_no" name="row_no_18" value="6" type="text">
                                            Contact Us
                                        </td>
                                        <td class="text-center">
                                            <i class="fa fa-check text-success inline"></i>
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-sm success" href="http://vincityquan9.com.vn/admin/menus/18/edit/2">
                                                <small>
                                                    <i class="material-icons">
                                                        ?
                                                    </i> S?a
                                                </small>
                                            </a>

                                        </td>
                                    </tr>


                                </tbody>
                            </table>

                        </div>
                        <footer class="dker p-a">
                            <div class="row">
                                <div class="col-sm-3 hidden-xs">

                                    <select name="action" id="action" class="input-sm form-control w-sm inline v-middle" required="">
                                        <option value="">Theo tác hoàng lo?t</option>
                                        <option value="order">L?u ??n hàng</option>
                                        <option value="activate">Kích ho?t ???c ch?n</option>
                                        <option value="block">Khóa ???c ch?n</option>
                                        <option value="delete">Xóa ???c ch?n</option>
                                    </select>
                                    <button type="submit" id="submit_all" class="btn btn-sm white">Áp d?ng</button>
                                    <button id="submit_show_msg" class="btn btn-sm white" data-toggle="modal" style="display: none" data-target="#m-all" ui-toggle-class="bounce" ui-target="#animate">
                                        Áp d?ng
                                    </button>
                                </div>

                                <div class="col-sm-3 text-center">
                                    <small class="text-muted inline m-t-sm m-b-sm">
                                        ?ang hi?n th? 1
                                        -6 of
                                        <strong>6</strong> B?n ghi
                                    </small>
                                </div>
                                <div class="col-sm-6 text-right text-center-xs">

                                </div>
                            </div>
                        </footer>
                    </form>

                    <script type="text/javascript">
                            $("#checkAll").click(function () {
                                $('input:checkbox').not(this).prop('checked', this.checked);
                            });
                            $("#action").change(function () {
                                if (this.value == "delete") {
                                    $("#submit_all").css("display", "none");
                                    $("#submit_show_msg").css("display", "inline-block");
                                } else {
                                    $("#submit_all").css("display", "inline-block");
                                    $("#submit_show_msg").css("display", "none");
                                }
                            });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>