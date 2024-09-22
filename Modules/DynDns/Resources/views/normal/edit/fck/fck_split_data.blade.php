
<div class="form-group {{ $ctrl->width}}">
    <label>
        {!! $ctrl->title !!}
    </label>
    <div class="">
        <textarea {{@$ctrl->read==1?"readonly":"id=".@$ctrl->name.$lang}}  rows="2" class="form-control {{ @$ctrl->needed==1?'needed':''}} " style="width:100%;"><?=@$row->{$ctrl->value.$lang}?></textarea>
        <script>

            $('#{{@$ctrl->name.$lang}}').change(function () {
                $(this).val($(this).val().trim());
                var name = "{{$ctrl->att_table}}";
                var content = $(this).val();
                var data = content.trim().split('\n');
                var field = name.trim().split(',');
                var i;
                for (i = 0; i < data.length; i++) {
                    if(field[i]!=undefined && data[i]!='')
                    {
                        if (field[i] == 'area' || field[i] == 'wide'  || field[i] == 'length'  ||  field[i] == 'home_wide_road' || field[i] == 'area_wide' || field[i] == 'area_long')
                            $('#' + field[i]).val(Number(data[i].replace(/,/g, '.')));
                        else{
                            if(data[i]!='')
                                $('#'+field[i]).val(data[i]);
                        }
                    }
                       
                }
                if ($('*[data-callback]').length > 0) {
                    $('*[data-callback]').each(function (i, item) {
                        var _func = $(this).attr('data-callback');
                        window[_func]();
                    })
                }

            });
        </script>
        <ul class="parsley-errors-list"><em><small>{{@$ctrl->note}}</small></em> </ul>
    </div>
</div>
