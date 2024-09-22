@php
$name_id = str_replace(array('[',']',"#"),array('','',''),@$ctrl->name.$lang);
$f_values = explode(',',$ctrl->att_table);
$fields = explode(',',$ctrl->att_join);

$str_value = array();
@endphp
<div class="form-group {{$ctrl->width}} desktop">
    <label style="{!! $ctrl->att_style !!}"><?=$ctrl->title?>@if(@$ctrl->validate==1)
	<span style="color:#ff0000">(*)</span> @endif</label>
    <div>
		<label class="container">
            <input type="radio" name="{{@$name_id}}"  class=" {{@$name_id}}" value="{{@$ctrl->att_table}}" title="<?=$ctrl->title?>" />
			<span class="checkmark"></span>
			<?=$ctrl->note?>


            @for($i=0;$i<count($fields);$i++)
            @php
                $f = $fields[$i];
                $f_value = $f_values[$i];
                $f_name =str_replace($ctrl->value,$f,$ctrl->name);
                $r_value = $f_value;
                $str_value[] = @$row->{ $f};
            @endphp
                <input type="radio" name="{{@$f_name}}" value="{{@$r_value }}" {{@$row->{ $f}==@$f_value ?'checked':''}}  class="checkrad_collect_radio_font_awesome_multi_field {{@$f}}"  />
            @endfor
		</label>

    </div>
    <script>
        $('input[name="{{$name_id}}"][value="{{implode(',', $str_value)}}"]').prop('checked', true);
        $('.{{$name_id}}').change(function () {          
            $(this).parent().find('.checkrad_collect_radio_font_awesome_multi_field').prop('checked', true);
        })



    </script>
</div>


<style type="text/css">
    /* The container */
    .container {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 12px;
        font-size: 17px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

        /* Hide the browser's default radio button */
        .container input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

    /* Create a custom radio button */
    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 25px;
        width: 25px;
        background-color: #eee;
        border-radius: 50%;
    }

    /* On mouse-over, add a grey background color */
    .container:hover input ~ .checkmark {
        background-color: #ccc;
        cursor: pointer;
    }

    /* When the radio button is checked, add a blue background */
    .container input:checked ~ .checkmark {
        background-color: #e40000;
    }

    /* Create the indicator (the dot/circle - hidden when not checked) */
    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the indicator (dot/circle) when checked */
    .container input:checked ~ .checkmark:after {
        display: block;
    }

    /* Style the indicator (dot/circle) */
    .container .checkmark:after {
        top: 0px;
        left: 5px;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        color: white;
        font-family: "FontAwesome";
        content: "\f00c";
    }
</style>
