
$("#load").hide();

$(".box-open").click(function(){
    $(".btn-support-click").css("display", "none");
    $("#massage-to-user").css("display", "block");
    var dataString = {
        chat_message : 'Xin chào, tôi có thể giúp gì cho bạn?'
    };
    $.ajax({
        type: "POST",
        url: "fCMS/messenger/submit",
        data: dataString,
        dataType: "json",
        cache : false,
        success: function(data){
            if(data.success == true){
                $("#guest_id").val(data.guest_id);
                $("#ip").val(data.ip);
                $("#country").val(data.country);
                // $("#notif").html(data.notif);
                var socket = io.connect( 'http://'+window.location.hostname+':3000' );
                socket.emit('new_message', {
                    session_id: data.session_id,
                    guest_id: data.guest_id,
                    chat_message: data.chat_message,
                    created_at: data.created_at,
                    ip: data.ip,
                    country: data.country,
                    user_id: data.user_id,
                    chat_id: data.chat_id
                });
            }
        } ,error: function(xhr, status, error) {
            alert(error);
        },
    });
});
// if($.cookie("close-box") == 'block'){
//     $(".box-close").css("display", "block");
//     $("#massage-to-user").css("display", "none");
// }else {
//     $(".box-close").css("display", "none");
//     $("#massage-to-user").css("display", "block");
// }
$(".fa-minus").click(function(){
    $.cookie('close-box','block');
    $(".box-close").css("display", "block");
    $("#massage-to-user").css("display", "none");
});
$(".box-close").click(function(){
    $.cookie('close-box','none');
    $(".box-close").css("display", "none");
    $("#massage-to-user").css("display", "block");
});
        $('#send_message_chat').click(function (e) {
              return sendmessage();
        });
        $('.message_input').keyup(function (e) {
            if (e.which === 13) {
                return sendmessage();
            }
        });
function sendmessage() {
    var dataString = {
        guest_id : $("#guest_id").val(),
        session_id : $("#session_id").val(),
        ip : $("#ip").val(),
        country : $("#country").val(),
        // guest_id : guest_id,
        chat_message : $('.message_input').val()
    };
    if ($('.message_input').val() === '') {
                return;
            }
    $.ajax({
        type: "POST",
        url: "fCMS/messenger/sendmess",
        data: dataString,
        dataType: "json",
        cache : false,
        success: function(data){
            if(data.success == true){
                var socket = io.connect( 'http://'+window.location.hostname+':3000' );
                $("#guest_id").val(data.guest_id);
                $('.message_input').val('');
                socket.emit('new_message', {
                    session_id: data.session_id,
                    guest_id: data.guest_id,
                    chat_message: data.chat_message,
                    created_at: data.created_at,
                    user_id: data.user_id,
                    chat_id: data.chat_id
                });
                return $( ".messages" ).animate({ scrollTop: $( ".messages" ).prop('scrollHeight') }, 300);
            }
        } ,error: function(xhr, status, error) {
            alert(error);
        },
    });
}
$("#send_message_offline").click(function(){
    $( "#load" ).show();
    var dataString = {
        name : $("#name").val(),
        email : $("#email").val(),
        phone : $("#phone").val(),
        message : $("#message").val()
    };
    $.ajax({
        type: "POST",
        url: "fCMS/messenger/messageoffline",
        data: dataString,
        dataType: "json",
        cache : false,
        success: function(data){
            $( "#load" ).hide();
            if(data.success == true){
                $("#notif").html(data.notif);
                $("#notif").show();
                $( "#send_repeat" ).show();
                $( "#send_message_offline" ).hide();
                $( "#message_offline" ).hide();
            }else if(data.success == false) {
                $("#notif").html(data.notif);
                $("#notif").show();
                $( "#send_repeat" ).show();
                $( "#send_message_offline" ).hide();
                $( "#message_offline" ).hide();

            }
        } ,error: function(xhr, status, error) {
            alert(error);
        },
    });
});
$("#box-send-off .fa-minus").click(function(){
    $("#box-send-off" ).hide();
});
$(".btn-repeat").click(function(){
    $( "#load" ).hide();
    $("#name").val('');
    $("#email").val('');
    $("#message").val('');
    $("#notif").hide();
    $("#send_repeat" ).hide();
    $("#send_message_offline" ).show();
    $("#message_offline" ).show();
});
$(".btn-repeat-off").click(function(){
    $( "#load" ).hide();
    $("#notif").hide();
    $("#send_repeat" ).hide();
    $("#send_message_offline" ).show();
    $("#message_offline" ).show();
});
$(".box-offline").click(function(){
    $("#box-offline" ).hide();
    $("#box-send-off" ).show();
});
// var socket = io.connect( 'http://'+window.location.hostname+':3000' );
var socket = io.connect( 'http://112.78.4.10:3000',{secure: true} );
// var url = window.location.hostname;alert(url);
socket.on('new_message', function( data ) {
    var userid = data.user_id;
    var guest_id = $("#guest_id").val();
    if (guest_id == data.guest_id){
        if( userid != '0' ){
            $( "#new_message_user" ).append('<li class="message left appeared"><div class="avatar" style="background-color:unset"> <img style="width: 60px" itemprop="image" src="fCMS/assets/img/customer.jpg"></div><div class="text_wrapper"> <div class="text">'+data.chat_message+'</div></div><span class="time_date_left" style="">'+data.created_at+'</span></li>');
        }
        else {
            $( "#new_message_user" ).append('<li class="message right appeared"><div class="avatar" style="background-color:unset"> <img style="width: 60px" itemprop="image" src="fCMS/assets/img/guest.png"></div><div class="text_wrapper"> <div class="text">'+data.chat_message+'</div></div><span class="time_date_right" style="">'+data.created_at+'</span></li>');
        }
    }
    return $( ".messages" ).animate({ scrollTop: $( ".messages" ).prop('scrollHeight') }, 300);
});
socket.on('check_online', function( data ) {
    $(".box-offline").hide();
    $(".box-open").show();
});

