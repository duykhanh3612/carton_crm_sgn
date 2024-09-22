
<script>
        $(document).ready(function () {

            var url = '{{route("admin.bank.data")}}';
            var table = $('#bank-table .table').DataTable({
                /*dom: 'Bfrtip',*/
                paging: true,
               // pageLength: 5,
                ajax: function (data, callback, settings) {
                    $.ajax({
                        url: url,
                        dataType: "json",
                        type: 'get',
                        contentType: 'application/x-www-form-urlencoded',
                        data: {
                            content: JSON.stringify(data)
                        },
                        success: function (data, textStatus, jQxhr) {
                            callback({
                                // draw: data.draw,
                                data: data.Data,
                                recordsTotal: data.TotalRecords,
                                recordsFiltered: data.RecordsFiltered
                            });
                        },
                        error: function (jqXhr, textStatus, errorThrown) {
                        }
                    });
                },
                serverSide: true,
                columns: [
                    {
                        data: "id",
                        render: function (data, type, row) {
                            if (type === 'display') {
                                return '<input type="checkbox" class="select-row" name="chkid[]" value="'+data+'">';
                            }
                            return data;
                        },
                        width:'3%',
                        className: "dt-body-center"
                    },

                    { data: "bank_name_short" },
                    { data: "bank_name" },
                    { data: "bank_name_internal" },
                    { data: "bank_code_type" },
                    { data: "bank_code" },
                    { data: "bank_country" },
                ],
            });

            $('#bank-table .table ').on('click', 'tbody td', function () {
                var colIndex = $(this).prevAll().length;

                if (colIndex != 0) {
                    var id = $(this).parent().find('.select-row').val();
                    window.location = "{{url('admin/bank/edit')}}/"+id;
                }

            });

            $('#DataTables_Table_0_length').append('<button type="button" class="btn btn-default btn-delete">Xóa</button>');

            $('.btn-delete').click(function () {
                var favorite = [];

                $.each($(".select-row:checked"), function(){
                    favorite.push($(this).val());
                });
                var chkid = favorite.join(", ");

                   $.ajax({
                        url: '{{route("admin.bank.destroy")}}',
                        dataType: "json",
                        type: 'get',
                        contentType: 'application/x-www-form-urlencoded',
                        data: {
                            id: chkid
                        },
                        success: function (data, textStatus, jQxhr) {
                            window.location.reload();
                        },
                        error: function (jqXhr, textStatus, errorThrown) {
                            window.location.reload();
                        }
                    });


            });
        });

</script>
