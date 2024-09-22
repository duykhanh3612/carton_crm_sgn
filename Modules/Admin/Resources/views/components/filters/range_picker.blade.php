<div class="center pull-right range_pikcer">
    <span class="k-widget k-datepicker k-header s1 ng-pristine ng-valid" title="Từ ngày" style="">
        <span class="k-picker-wrap k-state-default">
            <input class="s1 k-input" id="fromDate" data-role="datepicker" ng-model="fromDate1" type="text"
                role="combobox" aria-expanded="false" aria-owns="fromDate1_dateview" aria-disabled="false"
                style="width: 100%;" placeholder="Từ ngày" value="{{request('date_from')}}" autocomplete="off">
            <span class="k-select" role="button" aria-controls="fromDate1_dateview">
                <span class="k-icon k-i-calendar"><i class="fa fa-calendar-alt"></i></span>
            </span>
        </span>
    </span>
    -
    <span class="k-widget k-datepicker k-header s1 ng-pristine ng-valid" title="Đến ngày" style="">
        <span class="k-picker-wrap k-state-default">
            <input class="s1 k-input" id="toDate" data-role="datepicker" ng-model="toDate1" type="text" role="combobox"
                aria-expanded="false" aria-owns="toDate1_dateview" aria-disabled="false" aria-readonly="false"
                style="width: 100%;" placeholder="Đến ngày" value="{{request('date_to')}}" autocompleteautocomplete="off">
            <span class="k-select" role="button" aria-controls="toDate1_dateview">
                <span class="k-icon k-i-calendar"><i class="fa fa-calendar-alt"></i></span>
            </span>
        </span>
    </span>
    <div class="btn-group">
        <button class="btn btn-primary btn-outline hidden-640 ng-binding ng-pristine ng-valid" ng-model="dateRange"
            ng-class="{1:'clicked'}[selected]" type="button" onclick="selectRange(1)">Tuần</button>
        <button class="btn btn-primary btn-outline hidden-768 ng-binding ng-pristine ng-valid" ng-model="dateRange"
            ng-class="{2:'clicked'}[selected]" onclick="selectRange(2)" type="button">Tháng</button>
        <button class="btn btn-primary btn-outline hidden-1200 ng-binding ng-pristine ng-valid" ng-model="dateRange"
            ng-class="{3:'clicked'}[selected]" onclick="selectRange(3)" type="button">Quý</button>

        <button class="btn btn-primary btn-outline dropdown-toggle ng-pristine ng-valid" data-toggle="dropdown"
            ng-model="dateRange" ng-class="{6:'clicked', 7:'clicked', 8:'clicked', 9:'clicked'}[selected]"
            type="button">

            <i class="icon-caret-down"></i>
        </button>
        <ul class="dropdown-menu dropdown-menu-right pull-right" role="menu">
            <li class="show-640" ng-class="{1:'active'}[selected]"><a class="ng-binding ng-pristine ng-valid"
                    ng-model="dateRange" onclick="selectRange(1)">Tuần này</a></li>
            <li ng-class="{6:'active'}[selected]"><a class="ng-binding ng-pristine ng-valid" ng-model="dateRange"
                onclick="selectRange(6)">Tuần trước</a></li>
            <li class="show-768" ng-class="{2:'active'}[selected]"><a class="ng-binding ng-pristine ng-valid"
                    ng-model="dateRange" onclick="selectRange(2)">Tháng này</a></li>
            <li ng-class="{7:'active'}[selected]"><a class="ng-binding ng-pristine ng-valid" ng-model="dateRange"
                onclick="selectRange(7)">Tháng trước</a></li>
            <li class="show-1200" ng-class="{3:'active'}[selected]"><a class="ng-binding ng-pristine ng-valid"
                    ng-model="dateRange" onclick="selectRange(3)">Quý này</a></li>
            <li ng-class="{8:'active'}[selected]"><a class="ng-binding ng-pristine ng-valid" ng-model="dateRange"
                onclick="selectRange(8)">Quý trước</a></li>
        </ul>
    </div>

    <style type="text/css">
        .pull-right {}

        .range_pikcer {
            display: inline-flex;
            gap: 10px;
        }

        .range_pikcer .s1 {
            width: 119px !important;
            display: block;
        }

        .s1>span.k-picker-wrap.k-state-default {
            margin-bottom: 3px;
            border-radius: 3px !important;
        }

        span.s1 input.s1 {
            width: 100% !important;
        }

        .k-datepicker .k-picker-wrap input,
        .k-datetimepicker .k-picker-wrap input {
            padding: 0 !important;
            border-radius: 0 !important;
            height: 32px !important;
        }

        .k-autocomplete,
        .k-picker-wrap,
        .k-numeric-wrap {
            position: relative;
            cursor: default;
        }

        .k-picker-wrap .k-select,
        .k-numeric-wrap .k-select,
        .k-dropdown-wrap .k-select {
            position: absolute;
            top: 0;
            right: 0;
            display: inline-block;
            vertical-align: top;
            text-decoration: none;
        }

        .k-picker-wrap .k-select,
        .k-numeric-wrap .k-select,
        .k-dropdown-wrap .k-select {
            min-height: 1.94em;
            line-height: 2.29em;
            vertical-align: middle;
            -moz-box-sizing: border-box;
            text-align: center;
            width: 1.9em;
            height: 100%;
        }

        .btn-outline {
            background-color: transparent !important;
            color: #428bca !important;
        }
        .btn-outline:hover, .btn-outline:focus,.btn-outline:focus-visible, .btn-outline:visited, .btn-outline:active{
            background: #428bca;
            color: #fff !important;
            background-color: #428bca !important;
            border: 0 !important;
            outline: none !important;
            box-shadow: none !important;
            height: 34px;
        }
    </style>
</div>
@push('js')
<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css"
    rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js">
</script>
<script>
    jQuery('#fromDate').datetimepicker({
            i18n: {
                de: {
                    months: [
                        'Januar', 'Februar', 'März', 'April',
                        'Mai', 'Juni', 'Juli', 'August',
                        'September', 'Oktober', 'November', 'Dezember',
                    ],
                    dayOfWeek: [
                        "So.", "Mo", "Di", "Mi",
                        "Do", "Fr", "Sa.",
                    ]
                },
                vn: {
                    months: [
                        'Tháng 1', 'Februar', 'März', 'April',
                        'Mai', 'Juni', 'Tháng 7', 'August',
                        'September', 'Oktober', 'November', 'Dezember',
                    ],
                    dayOfWeek: [
                        "H", "B", "T", "N",
                        "S", "B", "C",
                    ]
                }
            },
            timepicker: false,
            format: 'd/m/Y'
    });
    jQuery('#toDate').datetimepicker({
        i18n: {
            de: {
                months: [
                    'Januar', 'Februar', 'März', 'April',
                    'Mai', 'Juni', 'Juli', 'August',
                    'September', 'Oktober', 'November', 'Dezember',
                ],
                dayOfWeek: [
                    "So.", "Mo", "Di", "Mi",
                    "Do", "Fr", "Sa.",
                ]
            },
            vn: {
                months: [
                    'Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4',
                    'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8',
                    'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12',
                ],
                dayOfWeek: [
                    "H", "B", "T", "N",
                    "S", "B", "C",
                ]
            }
        },
        timepicker: false,
        format: 'd/m/Y',
    });

        function selectRange(type)
        {
            switch(type)
            {
                case 1:
                    getDateofWeek();
                    break;
                case 2:
                    getDateofMonth();
                    break;
                case 3:
                    getCurrentPreviousQuarter();
                    break;
                case 6:
                    getDateofLastWeek();
                    break;
                case 7:
                    getDateofLastMonth();
                    break;
                case 8:
                    getCurrentPreviousQuarter("previous");
                    break;
                default:
                    dateRange = 1;
                    getDateofWeek();
                    break;
            }
            $("input[name=keywords").trigger("change");
        }

        function getDateofWeek()
        {
            var curr = new Date();
            day = curr.getDay();
            firstDay = new Date(curr.getTime() - 60*60*24* day*1000);
            lastDay = new Date(firstDay.getTime() + 60 * 60 *24 * 6 * 1000);
            $("#fromDate").val(formatDate(firstDay));
            $("#toDate").val(formatDate(lastDay));
        }

        function getDateofLastWeek()
        {
            var curr = new Date();
            day = curr.getDay() + 7;
            firstDay = new Date(curr.getTime() - 60*60*24* day*1000);
            lastDay = new Date(firstDay.getTime() + 60 * 60 *24 * 6 * 1000);
            $("#fromDate").val(formatDate(firstDay));
            $("#toDate").val(formatDate(lastDay));
        }
        function getDateofMonth() {
            var date = new Date();
            var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
            var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);

            $("#fromDate").val(formatDate(firstDay));
            $("#toDate").val(formatDate(lastDay));
        }
        function getDateofLastMonth(){
               var date = new Date();
            var firstDay = new Date(date.getFullYear(), date.getMonth()-1, 1);
            var lastDay = new Date(date.getFullYear(), date.getMonth(), 0);

            $("#fromDate").val(formatDate(firstDay));
            $("#toDate").val(formatDate(lastDay));
        }
        function getCurrentPreviousQuarter(value) {
            var today = new Date(),
                quarter = Math.floor((today.getMonth() / 3)),
                startDate,
                endDate;

            switch (value) {
                case "previous":
                    startDate = new Date(today.getFullYear(), quarter * 3 - 3, 1);
                    endDate = new Date(startDate.getFullYear(), startDate.getMonth() + 3, 0);
                    break;
                default:
                    startDate = new Date(today.getFullYear(), quarter * 3, 1);
                    endDate = new Date(startDate.getFullYear(), startDate.getMonth() + 3, 0);
                    break;
            }

            $("#fromDate").val(formatDate(startDate));
            $("#toDate").val(formatDate(endDate));
        }

        function getQuarter(date = new Date()) {
            return Math.floor(date.getMonth() / 3 + 1);
        }
        function formatDate(date)
        {
            return  [ date.getDate(), date.getMonth() + 1, date.getFullYear()].join('/');
        }
</script>
@endpush
