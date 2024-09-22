
<div class="form-group {{$ctrl->width}}">
    <label>
        <?=$ctrl->title?> @if(@$ctrl->validate==1) <span style="color:#ff0000">(*)</span> @endif
    </label>
    <div class="input-group ">
        <span class="input-group-btn ">
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#sign-in-modal">
                <i class="fa fa-plus"></i>
            </button>
        </span>
        <?=h::select($ctrl->name,@$row->{$ctrl->value},$ctrl->att_style.' class="'.$ctrl->name.' form-control"',
             $ctrl->att_table,$ctrl->att_where,$ctrl->att_field.($lang==''?'':'_'.$lang),@$ctrl->att_key,@$ctrl->att_orderby,
             $ctrl->att_first,$ctrl->att_char,$ctrl->att_root,$ctrl->att_rootvalue);?>
        <script>
        $('.{{$ctrl->name}}').val('{!!@$row->{$ctrl->value} !!}')
        </script>
    </div>

    <!-- Sign in modal start -->
    <div class="modal fade" id="sign-in-modal" tabindex="-1">
        <div class="modal-dialog" role="document" style="max-width: 80% !important;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?=$ctrl->title?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-b-0">
                    <iframe height="480px;" width="100%" marginwidth="0"  marginheight="0" frameborder="0" src="{{substr($ctrl->note,0,1)=='@'?url(str_replace('@/','admin/',$ctrl->note)):$ctrl->note}}"></iframe>
                </div>
                <div class="modal-footer">
                    <!--<button type="button" class="btn btn-primary">Sign In</button>-->
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Sign in modal end -->
    <script>

        $(document).on('show.bs.modal', '.modal', function () {
            //alert('open');
        })
        $(document).on('hidden.bs.modal', '.modal', function () {
            var url = "{{url('admin/ajax/get_data')}}?type=find_all&table={{$ctrl->att_table}}";

            $.getJSON(url, function (data) {
                var hmtl_content = "";
                $.each(data, function (index, itemData) {
                    hmtl_content += '<option value="' + itemData.investor_id + '">' + itemData.investor_name + '</option>';
                });
                $('.{{@$ctrl->name}}').html(hmtl_content);
                $('.{{$ctrl->name}}').val('{!!@$row->{$ctrl->value} !!}')
            });
            
        })
    </script>
</div>
