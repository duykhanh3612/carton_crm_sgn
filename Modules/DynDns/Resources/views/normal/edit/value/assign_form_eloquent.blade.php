@php
    $data = $id = call_user_func($ctrl->att_table,request());
    $struct = json_decode(@$ctrl->struct);

    $group = $struct[0];
    $position = $struct[1];
    $list = $struct[2];
    $input = $struct[3];
    $field = explode(',',$list->att_field);
@endphp
<!--<script
  src="https://code.jquery.com/jquery-3.5.1.js"
  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
  crossorigin="anonymous"></script>-->
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
                                <select name="branch" id="branch" class="form-control yesnoselect"  grouptarget="group_branch" >
                                    <option value="0">Tất cả</option>
                                    @foreach($data[$group->att_table] as $r)
                                    <option value="{{$r->{$group->att_key} }}">{{$r->{$group->att_field} }}</option>
                                    @endforeach
    
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
                                 <select name="account-group" id="position" class="form-control yesnoselect"  grouptarget="group_pos" >
                                     @foreach($data[$position->att_table] as $r)
                                    <option value="{{$r->{$position->att_key} }}">{{$r->{$position->att_field} }}</option>
                                     @endforeach
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
                                    @foreach($data[$list->att_table] as $r)
                                    <tr id="data-96" class="group_branch {{@$r->{$list->att_foreign} }} group_pos {{@$r->{$list->att_key_join} }}" data-group_branch="{{@$r->{$list->att_foreign} }}" data-group_pos="{{@$r->{$list->att_key_join} }}">
                                        @foreach($field as $f)
                                        <td style="text-align:center;"> {{@$r->{$f} }}</td>
                                        @endforeach
                                        <td style="text-align:center;" width="60"><input type="radio" name="{{$list->name}}" value="{{$r->{$list->att_key} }}" /></td>
                                    </tr>
                                    @endforeach
                                 </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <div class="row"> <input type="hidden" value="{{request($input->value)}}" name="{{$input->name}}" /> </div>
    </div>
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
