@php
             $list_follower =  \Zalo_Official::get_list_followers();
             $oa = \Zalo_Official::get_oa();
@endphp

<div class="form-group {{  $ctrl->width}} desktop " id="zalo_official">
    <div class="form-group" style="padding:30px;">
        <div class="row">
            <div class="col-md-3">
                @foreach($list_follower->data->followers as $follow)
            @php $profile = Zalo_Official::get_profile($follow->user_id);
            @endphp
                <div class="row user" id="{{$follow->user_id}}">
                    <div class="col-md-4">
                        <img src="{{$profile->data->avatar}}" />
                    </div>
                    <div class="col-md-8">
                        <label class="name" data-user-id="{{$follow->user_id}}">{{$profile->data->display_name}}</label>
                        <br />
                        <label>Giới tính: {{$profile->data->user_gender==1?'Nam':'Nữ'}}</label>
                        @if($profile->data->birth_date!=0)
                        <br />
                        <label>Ngày sinh: {{$profile->data->birth_date}}</label>
                        @endif
                        <br />
                        <label class="time_contact_newest">
                            Liên hệ gần nhất đã
                            <span style="font-weight:600;color:#ff0000"></span>
                        </label>
                    </div>

                </div>
                @endforeach
            </div>
            <div class="col-md-6">
                <div id="content_message"></div>
                <div class="form-group col-md-12" id="chat_content">
                    <textarea class="form-control" id="chat_message" placeholder="Nhấn Enter để gửi, Shifl + Enter để xuống dòng"></textarea>
                    <input type="checkbox" value="1" class="sender_box" name="sender_box" /> Gửi cho toàn bộ người quan tâm
                    <span class="btn" id="btn_send_chat" style="display:none;">Send</span>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</div>

<style>
    #zalo_official .user{
        background:#CCCCCC;
        padding:10px;
    }
    #zalo_official .user img{
        border-radius: 50%;
    }
    #zalo_official .name{
        font-weight:800;
        cursor:pointer;
    }
    #zalo_official #content_message{
        background:#E6DDD8;
        padding: 10px;
        height:400px;
        overflow:auto;
    }
    #zalo_official #chat_content{
        padding:10px 0px 10px 0px;
    }
    #zalo_official #content_message .row_message.client{
        text-align:right;
    }
    #zalo_official #content_message .row_message label{
        background:#ffffff;
        border-radius: 10px;
        padding:5px;
    }

    #zalo_official #content_message .row_message label small{
        color:#808080;
    }

     #zalo_official #content_message .row_message img{
        border-radius: 50%;
        height:50px;
        margin-bottom:20px;
        margin-left:10px;
        margin-right:10px;
    }
     #chat_message{
         border: 1px solid #808080;
         height:100px;
     }
     #btn_send_chat{
         background:#0275d8;
         border-radius:15px;
         color:#fff;
         margin-top: 5px;
     }
</style>
<script>
    var DateDiff = {

        inHours: function (d1, d2) {
            var t2 = d2.getTime();
            var t1 = d1.getTime();
            var hour = parseInt((t2 - t1) / (3600 * 1000));
            var min = parseInt((t2 - t1) / (1000) / 60)
            return hour + ' giờ ' + (min - hour * 60) + ' phút';
        },

        inDays: function (d1, d2) {
            var t2 = d2.getTime();
            var t1 = d1.getTime();

            return parseInt((t2 - t1) / (24 * 3600 * 1000));
        },

        inWeeks: function (d1, d2) {
            var t2 = d2.getTime();
            var t1 = d1.getTime();

            return parseInt((t2 - t1) / (24 * 3600 * 1000 * 7));
        },

        inMonths: function (d1, d2) {
            var d1Y = d1.getFullYear();
            var d2Y = d2.getFullYear();
            var d1M = d1.getMonth();
            var d2M = d2.getMonth();

            return (d2M + 12 * d2Y) - (d1M + 12 * d1Y);
        },

        inYears: function (d1, d2) {
            return d2.getFullYear() - d1.getFullYear();
        }
    }
         /*var dString = "May, 20, 1984";

var d1 = new Date(dString);
var d2 = new Date();

document.write("<br />Number of <b>days</b> since " + dString + ": " + DateDiff.inDays(d1, d2));
document.write("<br />Number of <b>weeks</b> since " + dString + ": " + DateDiff.inWeeks(d1, d2));
document.write("<br />Number of <b>months</b> since " + dString + ": " + DateDiff.inMonths(d1, d2));
document.write("<br />Number of <b>years</b> since " + dString + ": " + DateDiff.inYears(d1, d2));*/
</script>
<script>
    var zalo_user_id='';
    $('#zalo_official').find('.name').click(function () {
        zalo_user_id = $(this).data('user-id');
        countdown();
    });

    function countdown()//remsec in second
    {
        zalo_get_chat();
	    delay=10000;
	    setTimeout(function(){countdown();}, delay);
	}
    $(document).ready(function () {
        $('#chat_message').keydown(function () {
            var message = $("#chat_message").val();
            let sender_box = $('.sender_box:checked').val();
            if (event.keyCode == 13) {
                if (message == "") {
                    alert("Enter Some Text In Textarea");
                } else {

                    if (zalo_user_id != "" || sender_box != undefined)
                        zalo_send_text();
                    else
                        alert("Chọn User ID hoặc Check Gửi cho toàn bộ người quan tâm ");
                }
                return false;
            }
        });
    });

    $('#btn_send_chat').click(function () {
        zalo_send_text();
    });
    function zalo_get_chat() {
        let user_id = zalo_user_id;
        $.ajax({
        url: 'http://asm.info/admin/ajax/get_conversation',
        type: 'get',
        datatype:'json',
        headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
        },
        data: { 'user_id': user_id },
        success: function (response) {
            var result = response.data;
            $('#content_message').html('');
            $('#chat_content').show();
            $.each(result, function (key, value) {

                if (key == 0) {
                    $('#' + user_id).find('.time_contact_newest').find('span').html(DateDiff.inHours(new Date(convert(value.time)), new Date()));
                    //$('#' + user_id).find('.time_contact_newest').find('span').html(convert(value.time,'y-m-d'));
                }
                if (value.type == "text") {
                    var div = '<div class="row_message ' + (value.from_id == user_id ? 'client' : 'offical') + '">' +
                        (value.from_id == user_id ? '' : '<img src="{{$oa->data->avatar}}" />')  +
                        '<label class="message">' +
                        value.message +
                        '<br/><small>' + convert(value.time,'custom') + '</small>' +
                        '</label>' + (value.from_id == user_id ? '<img src="{{$profile->data->avatar}}" />' : '') +'</div>';

                    $('#content_message').append(div);
                }
            });
        }
    });//end ajax
    }
    function zalo_send_text() {
        let user_id = zalo_user_id;
        let message = $('#chat_message').val();
        let sender_box = $('.sender_box:checked').val();
        $.ajax({
            url: 'http://asm.info/admin/ajax/send_chat',
            type: 'get',
            datatype: 'json',
            headers: {
                'X-CSRF-Token': $('meta[name="_token"]').attr('content')
            },
            data: { 'user_id': user_id, 'message': message, 'sender_box': sender_box },
            success: function (response) {
                $.ajax({
                    url: 'http://asm.info/admin/ajax/get_conversation',
                    type: 'get',
                    datatype: 'json',
                    headers: {
                        'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                    },
                    data: {
                        'user_id': user_id},
                    success: function (response) {
                        var result = response.data;
                        $('#content_message').html('');
                        $('#chat_message').val('');
                        $.each(result, function (key, value) {
                            if (value.type == "text") {
                                var div = '<div class="row_message ' + (value.from_id == user_id ? 'client' : 'offical') + '">' +
                                (value.from_id == user_id ? '' : '<img src="{{$oa->data->avatar}}" />')  +
                                '<label class="message">' +
                                value.message +
                                '<br/><small>' + convert(value.time,'custom') + '</small>' +
                                '</label>' + (value.from_id == user_id ? '<img src="{{$profile->data->avatar}}" />' : '') +'</div>';

                                $('#content_message').append(div);
                            }
                        });



                    }
                });//end ajax



            }
        });//end ajax
    }
    function convert(unixtimestamp,format) {

        // Unixtimestamp

        // Months array
        //var months_arr = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        var months_arr = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'];
        // Convert timestamp to milliseconds

        unixtimestamp = parseInt(unixtimestamp / 1000);
        var date = new Date(unixtimestamp*1000);

        // Year
        var year = date.getFullYear();

        // Month
        var month = months_arr[date.getMonth()];

        // Day
        var day = date.getDate();

        // Hours
        var hours = date.getHours();

        // Minutes
        var minutes = "0" + date.getMinutes();

        // Seconds
        var seconds = "0" + date.getSeconds();

        // Display date time in MM-dd-yyyy h:m:s format
        if (format == "h:i")
            var convdataTime = hours + ':' + minutes.substr(-2);
        else if (format == "y-m-d")
            var convdataTime = year + '-' + month + '-' + day;
        else if (format == "custom") {
            var d = new Date();
            var convdataTime = ((d.getFullYear() == year && months_arr[d.getMonth()] == month & d.getDate() == day) ? '' : year + '-' + month + '-' + day + ' ') + hours + ':' + minutes.substr(-2);
        }
        else
            var convdataTime = year + '-' + month + '-' + day +  ' ' + hours + ':' + minutes.substr(-2) + ':' + seconds.substr(-2);
        return convdataTime;

    }




</script>

