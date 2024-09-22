$(document).ready(function () {
    $("#Exportexcel").click(function(){
        var list = [];
        $('#itemList table').find('input:checked:not(".cb-all")').each(function () {
            list.push($(this).val());
            var did = $(this).val();
            $.ajax({
                url: site_url + $('#act').val() + '/updateNumberOC',
                type: 'POST',
                cache: false,
                data: {did: did},
                success: function (data) {

                }
            })
        });
        var String = list.join("&did[]=");
        // var did = String.split(",");
        var id =  $('#id').val();
        window.open(site_url + $('#act').val() + '/exportexcellist/?id='+id+'&did[]='+String);
        location.reload();
    }).on('change', '#NumberOfShipment', function() {
        var val = $(this).val();
        $('[data-shipped]').attr('data-shipped', val);
        anrDataRequired();
    });

});