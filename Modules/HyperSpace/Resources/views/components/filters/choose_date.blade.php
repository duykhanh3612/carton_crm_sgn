<div class="d-flex justify-content-end date_range_picker" style="gap: 8px;height:100%;">
    <input type="hidden" name="{{ @$filter['name']}}[form]" id="filter_created_at_form" class="datatable-filter" value="{{\Arr::get(request('filter'),@$filter['field_name'].".form")}}" />
    <input type="hidden" name="{{ @$filter['name']}}[to]" id="filter_created_at_to" class="datatable-filter" value="{{\Arr::get(request('filter'),@$filter['field_name'].".to")}}" />
    <!-- hiển thị thời gian -->
    <div class="d-flex align-items-center justify-content-between" style="gap: 16px">
        <p class="showDate" id="startDate" name="startDate" for="#filter_created_at_form">
            {{ \Arr::get(request('filter'),@$filter['field_name'].".form")? date("d/m/Y",strtotime(\Arr::get(request('filter'),@$filter['field_name'].".form"))):'dd/mm/yyyy'}}
        </p>
        <p>đến</p>
        <p class="showDate" id="endDate" name="endDate" for="#filter_created_at_to">
            {{ \Arr::get(request('filter'),@$filter['field_name'].".to")?date("d/m/Y",strtotime(\Arr::get(request('filter'),@$filter['field_name'].".to"))):'dd/mm/yyyy'}}
        </p>
    </div>
    <!-- button chọn thời gian -->
    <!-- Date and time range -->

    <div class="chooseDate" style="cursor: pointer" id="daterange-btn">
        <img src="{{assets}}dist/img/icon/calendar.png" style="width:14px">
        <p class="mb-0">Thời gian</p>
    </div>
</div>


<script>
    $(document).ready(function(){
        //Date range as a button
        $(".date_range_picker .chooseDate").daterangepicker(
                {
                    alwaysShowCalendars: true,
                    showDropdowns: true,
                    ranges: {
                        "Hôm nay": [moment(), moment()],
                        "Hôm qua": [moment().subtract(1, "days"), moment().subtract(1, "days")],
                        "7 ngày trước": [moment().subtract(6, "days"), moment()],
                        "30 ngày trước": [moment().subtract(29, "days"), moment()],
                        "Tháng này": [moment().startOf("month"), moment().endOf("month")],
                        "Tháng trước": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")],
                    },
                },
                function (start, end) {
                    // $("#startDate").html(start.format("DD/MM/YYYY"));
                    // if( $("#startDate").attr("for") != undefined)
                    // {
                    //     $($("#startDate").attr("for")).val(start.format("YYYY-MM-DD"))
                    // }

                    // $("#endDate").html(end.format("DD/MM/YYYY"));
                    // if( $("#endDate").attr("for") != undefined)
                    // {
                    //     $($("#endDate").attr("for")).val(end.format("YYYY-MM-DD"))
                    // }
                }
            );

            $(".date_range_picker .chooseDate").on('apply.daterangepicker', function (ev, picker) {
                tag = $(this).closest(".date_range_picker");
                tag.find("#startDate").html(picker.startDate.format("DD/MM/YYYY"));
                if( tag.find("#startDate").attr("for") != undefined)
                {
                    $(tag.find("#startDate").attr("for")).val(picker.startDate.format("YYYY-MM-DD"))
                }

                tag.find("#endDate").html(picker.endDate.format("DD/MM/YYYY"));
                if( tag.find("#endDate").attr("for") != undefined)
                {
                    $(tag.find("#endDate").attr("for")).val(picker.endDate.format("YYYY-MM-DD"))
                }
                // console.log(tag.attr("id"),ev,picker.startDate.format("YYYY-MM-DD"), picker.endDate.format("YYYY-MM-DD"));
            });
    })

</script>
