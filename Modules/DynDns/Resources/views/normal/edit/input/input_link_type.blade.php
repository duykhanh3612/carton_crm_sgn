<?php
$arr = explode(',',$ctrl->att_join);
?>
<div class="form-group {{  $ctrl->width}} " >
    <label>
        {{        $ctrl->title }} @if        (@$ctrl->validate==1)
        <span style="color:#ff0000">(*)</span>@endif
    </label>
    <div>
        <div class="radio">
            <label class="ui-check ui-check-md">
                <input id="status1" class="has-value" onclick="document.getElementById(&quot;link_div&quot;).style.display=&quot;none&quot;;document.getElementById(&quot;cat_div&quot;).style.display=&quot;none&quot;" name="{{@$arr[0]}}" value="0" type="radio" />
                <i class="dark-white"></i>
                Main Title
            </label>
            &nbsp; &nbsp;
            <label class="ui-check ui-check-md">
                <input id="status2" class="has-value" onclick="document.getElementById(&quot;link_div&quot;).style.display=&quot;block&quot;;document.getElementById(&quot;cat_div&quot;).style.display=&quot;none&quot;" name="{{@$arr[0]}}" value="1" type="radio" />
                <i class="dark-white"></i>
                Direct Link
            </label>
            &nbsp; &nbsp;
            <label class="ui-check ui-check-md">
                <input id="status2" class="has-value" onclick="document.getElementById(&quot;link_div&quot;).style.display=&quot;none&quot;;document.getElementById(&quot;cat_div&quot;).style.display=&quot;block&quot;"  name="{{@$arr[0]}}" value="2" type="radio" />
                <i class="dark-white"></i>
                Main Section
            </label>
            &nbsp; &nbsp;
            <label class="ui-check ui-check-md">
                <input id="status2" class="has-value" onclick="document.getElementById(&quot;link_div&quot;).style.display=&quot;none&quot;;document.getElementById(&quot;cat_div&quot;).style.display=&quot;block&quot;" name="{{@$arr[0]}}" value="3" type="radio" />
                <i class="dark-white"></i>
                Drop list
            </label>
            <script>
                @if(@$row->{@$arr[0]} =='')
                    $('input[name="{{$arr[0]}}"][value="0"]').attr('checked', 'checked');
                @else
                    $('input[name="{{$arr[0]}}"][value="{{@$row->{@$arr[0]} }}"]').attr('checked', 'checked');
                @endif
            </script>
        </div>
    </div>
</div>
<div id="link_div" class="form-group {{  $ctrl->width}}" style="display: {{@$row->{@$arr[0]}=='1'?'block':'none'}};">
    <label for="link" class="col-sm-2 form-control-label">
        Link URL
    </label>
    <div class="col-sm-10">
        <input placeholder="" class="form-control" id="title_ar" dir="ltr" name="{{$ctrl->name}}" value="{{@$row->{$ctrl->value} }}" type="text">
    </div>
</div>
<div id="cat_div" class="form-group {{  $ctrl->width}}" style="display: {{@$row->{@$arr[0]}=='2'||@$row->{@$arr[0]}=='3'?'block':'none'}};">
    <label for="link" class="col-sm-2 form-control-label">
        Link Section
    </label>
    <div class="col-sm-10">
        <select name="{{@$arr[1]}}" id="cat_id" class="form-control c-select">
            <option value="1">
                - - Link Section - -
            </option>
            @foreach(h::find_all($ctrl->att_table) as $r)
            <option value="{{$r->{$ctrl->att_key} }}" {{@$row->{@$arr[1]}==$r->{$ctrl->att_key}?'selected':'' }}  >{{$r->{$ctrl->att_field} }}</option>
            @endforeach
        </select>
    </div>
</div>