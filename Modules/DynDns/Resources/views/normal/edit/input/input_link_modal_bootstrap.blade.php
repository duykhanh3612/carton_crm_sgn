@php
             $name_id = str_replace(array('[',']',"#"),array('','',''),@$ctrl->name.$lang);

@endphp
<div class="form-group {{  $ctrl->width}} ">
	<label>&nbsp;</label>
	<div>
		<span style="float:left">
			<a class="btn green  publish_dark_light publish" id="{{$name_id}}">
				{{$ctrl->title}}
			</a>


		</span>
		@push('script')
		<script>
			$(document).ready(function () {
				$(document).on('click', '#{{$name_id}}', function () {
					$('#{{$name_id}}_modal').modal('show');
				});
			});
		</script>
		@endpush
	</div>
	@push('modal')
	<div id="{{$name_id}}_modal" class="modal fade" role="dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">{{        $ctrl->title }}</h4>
				</div>
				<div class="modal-body">
					<div class="mdb-lightbox" data-pswp-uid="2">
						<iframe src="{{$ctrl->att_table }}" style="height:100%;width:100%"></iframe>


					</div>
					<div style="clear:both"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		
	</div>
	@endpush
</div>
