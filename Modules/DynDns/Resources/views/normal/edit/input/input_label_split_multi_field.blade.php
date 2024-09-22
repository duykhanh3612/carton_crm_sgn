@php
	$value = @$row->{$ctrl->value};
	$arr  = @explode(',',$value);
@endphp

<div class="form-group {{$ctrl->width}}">
	<label>
		<?=$ctrl->title?>
	</label>
	<div class="row">
		@foreach($arr as $a)
		<div class="form-group {{$ctrl->value_width}}">
			<label class="form-control">
				<?=@$row->{$a}?>
			</label>
		</div>
		@endforeach
	</div>
</div>
