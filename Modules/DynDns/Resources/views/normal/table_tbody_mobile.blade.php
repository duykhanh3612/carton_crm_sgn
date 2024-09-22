@if(@$rows)
@php $row_id = 0 @endphp
 @foreach($rows as $row)
 @php $row_id++; @endphp
<tr>

        @if(@$controls_index)
        @foreach(@$controls_index as $ctrl)
        @php
            $pair['row'] = @$row;
            $pair['ctrl'] = $ctrl;
            $pair['path_base'] = $path_base;
            $pair['lang'] = @$ctrl->language==1?'_'.$_lang:'';
            $pair['func'] = $func;
        @endphp
            @if(@$ctrl->mobile_align)
            @push($row_id."mobile_".$ctrl->mobile_align)

                @if($ctrl->mobile_align=='right')
                <div style="clear:both;" class="mobile_right_item">
                    <div style="float:left;width:40%">{{@$ctrl->title}}:</div>
                    <div style="float:right;width:60%">
                        {!! view(h::area_admin.'::sys.template.normal.index.'.$ctrl->type,$pair) !!}
                    </div>

                </div>
                @else
        
                {!! view(h::area_admin.'::sys.template.normal.index.'.$ctrl->type,$pair) !!}

          
                @endif

               
            @endpush
            @endif
        @endforeach
        @endif

        <div class="row mobile_row">
            <div class="mobile-md-12" id="col-title">@stack($row_id.'mobile_title')</div>
            <div class="row">
                <div class="mobile-md-4" id="col-left">@stack($row_id.'mobile_left')</div>
                <div class="mobile-md-8" id="col-right">
                    <div class="row">
                        @stack($row_id.'mobile_right')
                    </div>

                    @include($template.'sys.template.normal.table_option')
                </div>
            </div>

            <div class="col-md-12" id="col-center">@stack($row_id.'mobile_content')</div>
        </div>

</tr>
@endforeach
 @endif

 <style type="text/css">
     .mobile-md-1, .mobile-md-10, .mobile-md-11, .mobile-md-12, .mobile-md-2, .mobile-md-3, .mobile-md-4, .mobile-md-5, .mobile-md-6, .mobile-md-7, .mobile-md-8, .mobile-md-9 {
         float: left;
     }
     .row [class*="mobile-"] {
         padding-left: 12px;
         padding-right: 12px;
     }
     .mobile-md-12{
        width:100%;
     }

     .mobile-md-1 {
         width: 8.33333%;
     }

     .mobile-md-2 {
         width: 16.6667%;
     }

     .mobile-md-3 {
         width: 25%;
     }

     .mobile-md-4 {
         width: 33.3333%;
     }

     .mobile-md-5 {
         width: 41.6667%;
     }

     .mobile-md-6 {
         width: 50%;
     }

     .mobile-md-7 {
         width: 58.3333%;
     }

     .mobile-md-8 {
         width: 66.6667%;
     }

     .mobile-md-9 {
         width: 75%;
     }

     .mobile-md-10 {
         width: 83.3333%;
     }

     .mobile-md-11 {
         width: 91.6667%;
     }

     .mobile-md-12 {
         width: 100%;
     }
     #col-title{
        font-size:16px;
        font-weight:900;
        padding-bottom:15px;
     }
     .mobile_row {
        padding:10px;
         padding-bottom: 50px;
         border-bottom: 1px solid #000000;
     }

     #col-right .btn-smartend i {
         font-size:20px;
     }

     #col-right .btn-smartend{
            width:42px;
            float:right;
     }
     #col-right .btn-smartend span {
         display: none;
     }
     #col-right [data-type="file"] {
         width: 28px;
         height:28px !important;
     }
     .mobile_right_item{
        padding:5px 0px;
     }
     [data-type="image_multi"] {
         width: 100% !important;
         height: auto !important;
     }

     .btn_index_create {
         max-width: 120px;
         margin: -8px;
         overflow: hidden;
         text-overflow: ellipsis;
     }

    label[more]::after {
        content: "...";
    }
 </style>
<script>
    $('.mobile_row').each(function () {
        var col_left = $(this).find('#col-left').html();
        var col_right = $(this).find('#col-right').html();
        if (col_left != '' && col_right != '') {

        }
        else if (col_left == '' && col_right != '') {
            $(this).find('#col-left').removeClass('mobile-md-4');
            $(this).find('#col-right').removeClass('mobile-md-8');
            $(this).find('#col-right').addClass('mobile-md-12');
        }
        else if (col_left != '' && col_right == '') {
            $(this).find('#col-left').removeClass('mobile-md-4');
            $(this).find('#col-right').removeClass('mobile-md-8');
            $(this).find('#col-left').raddClass('mobile-md-12');

        }
        else {

        }
    });

</script>
