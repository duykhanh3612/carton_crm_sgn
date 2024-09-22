        <ul class="parsley-errors-list"></ul>
        <link rel="stylesheet" type="text/css" href="{{env_host}}public/dashboard/adminui/assets/css/select2.min.css" />
        <link rel="stylesheet" type="text/css" href="{{env_host}}public/dashboard/adminui/assets/css/bootstrap-select.min.css" />

        <!-- slimscroll js -->
        <script type="text/javascript" src="{{env_host}}public/dashboard/adminui/assets/js/vendor/jquery.slimscroll.js"></script>
        <script src="{{env_host}}public/dashboard/adminui/assets/js/vendor/select2.min.js"></script>
        <script src="{{env_host}}public/dashboard/adminui/assets/js/vendor/bootstrap-select.min.js"></script>
        <style type="text/css">
        .tab-content,.dropdown-menu,.z-high{
            z-index:999999999999999999999999999 !important;
        }
        </style>
        <script>

            $('.selectpicker').selectpicker({
                nonSelectedText:'Services',
                style: 'defaultSelectDrop',
                size: 8
            });
            $(".selectpicker").on("change", function (value) {
                var This = $(this);
                var selectedD = $(this).val();
                $('#'+$(this).data('id')).val(selectedD);
            });
        </script>

  

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha384-vk5WoKIaW/vJyUAd9n/wmopsmNhiy+L2Z+SBxGYnUkunIxVxAv/UtMOhba/xskxh" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
