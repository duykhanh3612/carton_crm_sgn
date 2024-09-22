
 <div class="detailBlockGroup">
    @php
        $groups = collect($theads)->groupBy("tag_group");
    @endphp
    @foreach ($groups as $group_name => $group)
    <h4 class="tl-md lightGrey clearfix"><span class="tlName float-left">{{Arr::get($setting,"tag_groups.".$group_name)}}</span></h4>
    <div>
        {!! view("admin::element_tag",['theads'=>$group,'record'=>$record??[]]) !!}
    </div>
    @endforeach
 </div>


