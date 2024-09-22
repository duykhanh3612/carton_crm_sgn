<script>
    $('.update_setting').change(function(){
        let id = $(this).data('id');
        let name = $(this).data('field');
        let value = $(this).val();

        var form_data = new FormData();
        form_data.append("id", id);
        form_data.append("name", name);
        form_data.append("value", value);
        form_data.append("_token", '{{ csrf_token() }}');

        $.ajax({
            url: "{{url('admin/'.request()->segment(2).'/update_orderby')}}",
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'POST',
            success: function (data) {

            }
        });
    })
</script>
<style type="text/css">
    .input_order{
        border: 1px solid #eee;
        width:50px !important;
    }
</style>