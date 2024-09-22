
<!-- Theme JS files -->
<script type="text/javascript" src="assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="assets/js/plugins/tables/datatables/extensions/responsive.min.js"></script>
<script type="text/javascript" src="assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="assets/js/pages/datatables_responsive.js"></script>
<!-- /theme JS files -->


<div class="content-wrapper">
    <!-- Control position -->
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">
                <?=@$struct["title"]?>
            </h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li>
                        <a data-action="collapse"></a>
                    </li>
                    <li>
                        <a data-action="reload"></a>
                    </li>
                    <li>
                        <a data-action="close"></a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            <div class="content-group-lg">
                <div class="col-md-6">
                    <?=@$struct["description"]?>
                </div>
                <div class="text-right col-md-6">
                    <?=@$this->buttons?>
                </div>
            </div>
        </div>
        <div>
            Đang chuyển trang ...
        </div>
        <div style="display:block">
            <form action="<?=@$row->panel_login?>" name="login_form" method="post">
                @if(@$row->panel_para)
                <?php $par = json_decode(@$row->panel_para);
                    if(@$par)
                      foreach($par as $key=>$value):?>
                <input type="text" class="input-text" value="<?=$row->$value?>" name="<?=$key?>" />
                <?php endforeach?>
                @endif
                <input type="submit" value="submit" />

            </form>
            <script>
            $(document).ready(function() { /* code here */
                document.login_form.submit();
            });
            </script>
        </div>
    </div>
    <!-- /control position -->


</div>
