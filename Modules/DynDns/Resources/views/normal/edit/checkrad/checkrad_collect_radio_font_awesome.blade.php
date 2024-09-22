@if(!h::isMobile())
<div class="form-group {{$ctrl->width}} desktop">
    <label style="{!! $ctrl->att_style !!}"><?=$ctrl->title?>@if(@$ctrl->validate==1)
	<span style="color:#ff0000">(*)</span> @endif</label>
    <div>
		<label class="container">
			<input type="radio" name="{{@$ctrl->name}}" {{@$row->{ @$ctrl->value}==@$ctrl->att_table ?'checked':''}}  class="row_avatar" value="{{@$ctrl->att_table}}" title="<?=$ctrl->title?>" />
			<span class="checkmark"></span>
			<?=$ctrl->note?>
		</label>
    </div>
</div>
@else
<div class="form-group {{$ctrl->width}} mobo style-input-mobo">
    <label class="col-sm-2 form-control-label">
        <?=$ctrl->title?>@if(@$ctrl->validate==1)
        <span style="color:#ff0000">(*)</span> @endif
    </label>
    <div style="padding-top:10px;" class="input-box col-sm-10">
        <?php foreach($arr as $a):?>

        <input type="radio" class="has-value" {{@$ctrl->read==1?"readonly disabled":"" }}   value="{{$a}}" name="{{@$ctrl->name}}" /> {{$a }}
        <?php endforeach?>
        <script>
        @if(@$row->{$ctrl->value} =='')
                         $('input[name="{{$ctrl->name}}"][value="{{$arr[0]}}"]').attr('checked', 'checked');
        @else
        $('input[name="{{$ctrl->name}}"][value="{{@$row->{$ctrl->value} }}"]').attr('checked', 'checked');
        @endif
        </script>
        <style type="text/css">
            @media (max-width: 640px)
            {
              .form-group input {
                width: auto !important;
            }
        </style>
    </div>
</div>
@endif

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
