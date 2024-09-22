
<script>

$('.btn_popup').click(function () {
    var url = $(this).data('url');
    var list_id = $(this).data('id');;
    var field = $(this).data('field');
    var form_data = new FormData();
    form_data.append(field, list_id);
    form_data.append('callback', '{{ request()->fullUrl() }}');
    if (list_id == "")
        alert("Chưa chọn dữ liệu");
    else {
            // AJAX request
        $.ajax({
            url: url,
            type: 'post',     
            headers: {
                'X-CSRF-Token': $('meta[name="_token"]').attr('content')
            },
            data: form_data,
            cache: false,
            contentType: false,
            processData: false,
            success: function (result) {
                $('#myModal').find('.modal-body').html(result);
                // Display Modal
                $('#myModal').modal('show');
            }
        });//end ajax
    }
});
</script>
<style type="text/css">
      
    .button_popup .green {
        color: #FFFFFF;
        background-color: #26C281;
        border-color: #26C281;
    }
    .button_popup .yellow {
        color: #ffffff;
        background-color: #c49f47;
        border-color: #c49f47;
    }

</style>
