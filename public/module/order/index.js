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

$(document).on("click",".action-export-excel",function(){
    tag = $("#invoicesTable");
    check_list = tag.find("input.listItemids:checked").length;
    ids = [];
    if(check_list == 0)
    {
        // showNoti("Chọn đơn hàng để Export","Thông báo","warning");
        // return false;
    }
    else{
        tag.find("input.listItemids:checked").each(function(){
            ids.push($(this).val());
        });
    }

    const params = {
        page: $(".current_page").val(),
        current_tab: $("#current_tab").val(),
        limit: $("select.limit-changed").val(),
        keywords: $("#nameFilter,#keywords").val(),
        weborder: weborder,
        sort_column: $("#sort_column").val(),
        sort_field: $("#sort_field").val(),
        sort_order: $("#sort_order").val(),
    };
    $(".datatable-filter").each(function () {
        if (this.type === "radio" || this.type === "checkbox") {
            params[this.name] = this.checked ? 1 : null;
        } else {
            params[this.name] = $(this).val();
        }
    });

    data = {
        ids: ids,
        startDate: $("#filter_created_at_form").val(),
        endDate: $("#filter_created_at_to").val(),
        keywords:  $("#keywords").val(),
        filter: params
        // type: "json"
    }
    window.location = base_url + "/admin/order/export/orders?"+$.param(data);
    // $.ajax({
    //     method: "POST",
    //     url:base_url + "/admin/order/export/orders",
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     },
    //     data: {
    //         ids: ids,
    //         startDate: $("#filter_created_at_form").val(),
    //         endDate: $("#filter_created_at_to").val(),
    //         type: "json"
    //     }
    // }).done(function(res) {
    //     showNoti('Update Comment Success', 'Order', 'War');
    //     downloadFile(res.data.file,res.data.name);
    // });

});
function downloadFile(fileUrl, fileName) {
    var link = document.createElement('a');
    link.href = fileUrl;

    // Set the download attribute if a filename is specified
    if (fileName) {
        link.download = fileName;
    }

    // Append the anchor to the body
    document.body.appendChild(link);

    // Trigger click event
    link.click();

    // Remove the anchor from the DOM after triggering the download
    document.body.removeChild(link);
}
