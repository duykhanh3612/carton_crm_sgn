<script>
    $(document).on("click","input[data-status]",function(e) {
    e.preventDefault();
    var $this = $(this);
    /*var status = $this.hasClass('publish') ? 0 : 1;*/
    var removeClass = $this.hasClass('publish') ? 'publish' : 'unpublish';
    var addClass = $this.hasClass('publish') ? 'unpublish' : 'publish';
    var url = $this.attr('data-status');
    var status = parseInt( $this.attr('val') );
    var id = $this.attr('data-row');
    $this.addClass('processing');
    $.ajax({
	url: url,
	cache:false,
	data: { 'status': status, id: id },
	dataType: 'json',
	success: function(data) {
	    $this.removeClass('processing');

	    //var obj = $.parseJSON(data);
	    //if (data.STATUS) {
		$this.removeClass(removeClass).addClass(addClass);
		status = (status == 0) ? 1 : 0;
		$this.attr('val', status);

		if ($this.attr('data-update') !== '')
		    $('#' + $this.attr('data-update')).val(status)
		//$this.val(data.STATUS);
	    //}
	    },
	    error: function(){
		$this.removeClass(removeClass).addClass(addClass);
	}
    });
});
</script>