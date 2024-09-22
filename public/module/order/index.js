$(document).on("click",".confirmCopy",function(e)
{
    e.preventDefault();
    href = $(this).attr('data-href');
    $.confirm({
        title: "Thông báo",
        content: "Bạn có muốn copy đơn hàng này",
        type: 'blue',
        buttons: {
            ok: {
                text: "Xác nhận",
                btnClass: 'btn-primary',
                keys: ['enter'],
                action: function() {
                    window.location = href;
                }
            },
            cancel: {
                text: "Hủy",
                btnClass: 'btn-back',
                keys: ['enter'],
                action: function() {
                    console.log('the user clicked cancel');
                }
            },
        }
    });
});

$(".item-detail").click(function() {
    $('.item').remove();

    if($(this).hasClass("expand"))
    {
        $(this).removeClass("expand")
    }
    else{
        $('.item-detail').removeClass("expand");
        $(this).addClass("expand");
        id = $(this).parent().data('id');
        tag = $(this).closest('tr');
        $.ajax({
            method: "POST",
            url:  base_url + "/admin/order/item",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: id
            }
        }).done(function(res) {
            html = "<tr class='item'><td colspan='11'>" + res + "</td></tr>";
            $(html).insertAfter(tag);

        });
    }



});
$(".btn-restore-order").click(function() {
    e = $(this);
    id = $(this).closest('tr').find("input[name='ids[]']").val();
    $.confirm({
        title: e.attr('title'),
        content: "Bạn có muốn khôi phục đơn hàng này",
        type: 'blue',
        buttons: {
            ok: {
                text: "Xác nhận",
                btnClass: 'btn-primary',
                keys: ['enter'],
                action: function() {
                    $.ajax({
                        method: "POST",
                        url:  base_url + "/admin/order/update-status",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            order_id: id,
                            status: 1
                        }
                    }).done(function(res) {
                        location.reload();
                    });
                }
            },
            cancel: {
                text: "Hủy",
                btnClass: 'btn-back',
                keys: ['enter'],
                action: function() {
                    console.log('the user clicked cancel');
                }
            },
            // cancel: function(){
            //         console.log('the user clicked cancel');
            // }
        }
    });
});
$(".btn-cancel-order").click(function() {
    e = $(this);
    id = $(this).closest('tr').find("input[name='ids[]']").val();
    $.confirm({
        title: e.attr('title'),
        content: "Bạn có muốn hủy đơn hàng này",
        type: 'blue',
        buttons: {
            ok: {
                text: "Xác nhận",
                btnClass: 'btn-primary',
                keys: ['enter'],
                action: function() {
                    $.ajax({
                        method: "POST",
                        url: base_url + "/admin/order/update-status",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            order_id: id,
                            status: 5
                        }
                    }).done(function(res) {
                        location.reload();
                    });
                }
            },
            cancel: {
                text: "Hủy",
                btnClass: 'btn-back',
                keys: ['enter'],
                action: function() {
                    console.log('the user clicked cancel');
                }
            },
            // cancel: function(){
            //         console.log('the user clicked cancel');
            // }
        }
    });
});


function printOrder(id)
{
    // link = "http://crm.carton.info/admin/order/print/1";
    // $.get('', function(ketqua) {
    // 	$('#noidung').html(ketqua);
    // 	$('#noidung').html($('#chuoi-can-lay').html());
    // });
    // $("#modelOrderPrint").modal('show');
    $("#modelOrderPrint").html(`<iframe src="${base_url}/admin/order/print/${id}" style="width:100%:height: 800px"></iframe>`);
}
