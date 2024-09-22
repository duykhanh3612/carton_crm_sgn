<div class="form-group {{$ctrl->width}}">
    <label>{{ $ctrl->title}}</label>
    <div>
        <select multiple="multiple" id="{{$ctrl->name.$lang}}_multi" size="24" >
            @foreach(App\Model\md::find_all($ctrl->att_table,$ctrl->att_where) as $multi)
            <option value='{{$multi->{$ctrl->att_key} }}'>{{@++$multi_no}} - {{$multi->{$ctrl->att_field} }} </option>
            @endforeach
        </select>
        <textarea  name="{{$ctrl->name.$lang}}" id="{{$ctrl->name.$lang}}" class="form-group" style="display:none"> {{@$row->{$ctrl->value.$lang} }}</textarea>
     </div>
    <link href="../../plugin/jquery/multi-select/multi-select.css" rel="stylesheet">
    <script type="text/javascript" src="../../plugin/jquery/multi-select/jquery.multi-select.js" charset="UTF-8"></script>
    <script type="text/javascript">

        $(function () {
            var list = [ {{@$row->{$ctrl->value.$lang} }}];
    
            //Do it simple

            var data = "{{@$row->{$ctrl->value.$lang} }}";
            //Make an array       
            var dataarray = data.split(",");    
            // Set the value    
            $('#{{$ctrl->name.$lang}}_multi').val(dataarray);
            // Then refresh    
           // $('#{{$ctrl->name.$lang}}_multi').multiselect("refresh");


           $('#{{$ctrl->name.$lang}}_multi').multiSelect({
               afterSelect: function (values) {
                   list.push(values);
                   var str_list = list.length>0? list.join(",") :'';
                   $("#{{$ctrl->name.$lang}}").val(str_list);
               },
               afterDeselect: function (values) {
                   remove(list, values);
                   var str_list = list.length > 0 ? list.join(",") : '';
                   $("#{{$ctrl->name.$lang}}").val(str_list);
               }
           })




           function remove(array, element) {
               const index = array.indexOf(element);
               array.splice(index, 1);
           }
    });

    </script>
</div>