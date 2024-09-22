<div class="form-group  {{@$ctrl->width}} ">
    <label >
        <?=@$ctrl->title?> 
    </label>
    <div>
        <div class="fileinput fileinput-new" data-provides="fileinput" style="width: 100%; height: 150px;">
            <div class="fileinput-new thumbnail" id="thumbnail_{{@$ctrl->name}}" style="width: 100%; height: 150px;text-align:left">
                @if(@$row->{$ctrl->value}!='')
                <img src="{{@$image_path.'/'.@$row->{$ctrl->value} }}" alt="" style="width:100%;max-width: 200px;" />
                @else
                <!--<img data src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxOTAiIGhlaWdodD0iMTQwIj48cmVjdCB3aWR0aD0iMTkwIiBoZWlnaHQ9IjE0MCIgZmlsbD0iI2VlZSIvPjx0ZXh0IHRleHQtYW5jaG9yPSJtaWRkbGUiIHg9Ijk1IiB5PSI3MCIgc3R5bGU9ImZpbGw6I2FhYTtmb250LXdlaWdodDpib2xkO2ZvbnQtc2l6ZToxMnB4O2ZvbnQtZmFtaWx5OkFyaWFsLEhlbHZldGljYSxzYW5zLXNlcmlmO2RvbWluYW50LWJhc2VsaW5lOmNlbnRyYWwiPjE5MHgxNDA8L3RleHQ+PC9zdmc+"
                    alt="..." />-->
                <img data src="http://inwavethemes.com/demo-images/athlete/wp-content/uploads/2015/04/bg-welcome-370x250.jpg"
                    alt="..." style="width:100%" />
                @endif
            </div>
            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
            <div style="clear:both;"></div>
            <div id="button_{{$ctrl->name}}" >
                @if(@$row->{$ctrl->value}=='')
                <span class="btn {{@$style}} btn-file" style="width:100%">
                    <span class="fileinput-new">Tải lên</span>
                    <span class="fileinput-exists">Tải lên</span>
                    <input type="file" name="{{ @$ctrl->name}}" />
                </span>
                @else
                <input type="hidden" name="{{$ctrl->name}}" value="{{ @$row->{$ctrl->value} }}" />
                <a class="btn bd2742 btn-clear-image{{$ctrl->name}}" data-field="{{        $ctrl->name}}" data-dismiss="fileinput">Xóa</a>
                @endif
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="{{base}}/public/plugin/dashboard/adminui/assets/css/jasny-bootstrap.min.css" />
    <script type="text/javascript" src="{{base}}/public/plugin/dashboard/adminui/assets/js/vendor/jasny-bootstrap.min.js" charset="UTF-8"></script>
    <script>
    $('.btn-clear-image{{$ctrl->name}}').on('click',function(){
        var tag = $(this).attr('data-field');
        $('#thumbnail_'+tag).find('img').attr('src','data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxOTAiIGhlaWdodD0iMTQwIj48cmVjdCB3aWR0aD0iMTkwIiBoZWlnaHQ9IjE0MCIgZmlsbD0iI2VlZSIvPjx0ZXh0IHRleHQtYW5jaG9yPSJtaWRkbGUiIHg9Ijk1IiB5PSI3MCIgc3R5bGU9ImZpbGw6I2FhYTtmb250LXdlaWdodDpib2xkO2ZvbnQtc2l6ZToxMnB4O2ZvbnQtZmFtaWx5OkFyaWFsLEhlbHZldGljYSxzYW5zLXNlcmlmO2RvbWluYW50LWJhc2VsaW5lOmNlbnRyYWwiPjE5MHgxNDA8L3RleHQ+PC9zdmc+');
        $('#button_'+tag).html('<span class="btn btn-default btn-file"><span class="fileinput-new">Tải lên</span><span class="fileinput-exists">Tải lên</span><input type="file" name="{{$ctrl->name}}" /> </span>');
    });
</script>
    <div style="clear:both;margin-bottom:100px;" ></div>
</div>

