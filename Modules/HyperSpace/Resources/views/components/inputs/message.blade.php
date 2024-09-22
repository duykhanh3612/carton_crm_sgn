@php
$colLeft = empty($colLeft) ? 12 : $colLeft;
if($colLeft == 12){
$colRight = 12;
}
$type = (isset($type) && in_array($type, ['text', 'number', 'date', 'password', 'file', 'hidden' , 'email'])) ? $type : 'text';
$value = old( $name??"", $value ?? '' );
if($value && is_array($value)){
$value = implode(', ', $value);
}
@endphp
<div class="{{ $rowClass ?? 'col-md-12' }}" @if(!empty($rowData)) @foreach($rowData as $dataKey=> $dataVal)
    data-{{$dataKey}}="{{ $dataVal }}"
    @endforeach
    @endif
    >
    <div class="col-md-{{$colLeft}}">
        <div class="form-group">
            @if(!empty($text))
                <label for="{{ $text }}">{{ $text }} @if(!empty($required)) <span class="text-danger">*</span>@endif</label>
            @endif
            <textarea name="message" id="message" class="form-control" style="display:none;">{{@$record->message}}</textarea>
            <div id="message_content">
                <section id="Messages">
                    <div id="userMessagesView">
                        <div class="loader-center" ng-if="!doneLoading">
                            <div class="loader">
                                <i class="icon ion-loading-c"></i>
                            </div>
                        </div>
                        <div id="UserMessages" class="has-header has-footer">
                        </div>
                        <div class="sendMessageForm">
                            <ion-footer-bar class="bar-stable item-input-inset message-footer">
                                <label class="item-input-wrapper">
                                    <textarea id="input_message" data-user="{{auth()->user()->full_name}}" placeholder="Send a message..."></textarea>
                                </label>
                                <div class="footer-btn-wrap">
                                    <button class="button button-icon icon ion-android-send" type="button" id="btn_add_message">
                                        <i class="fa  fa-paper-plane"></i>
                                    </button>
                                </div>
                            </ion-footer-bar>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
@push('js')
<style type="text/css">
    #userMessagesView {
        border: 1px solid #ccc;
    }

    #UserMessages {

        padding-bottom: 30px;
    }

    .sendMessageForm {
        border-color: #b2b2b2;
        border-top: 1px solid #b2b2b2;
    }

    .bar-footer {
        overflow: visible !important;
    }

    .bar-footer textarea {
        resize: none;
        height: 25px;
    }

    .footer-btn-wrap {
        position: relative;
        height: 100%;
        width: 50px;
        top: 7px;
    }

    .message-footer {
        display: flex;
        background: #f4f4f4 !important;
    }

    .message-footer .item-input-wrapper {
        width: 100%;

    }

    .message-footer #input_message {
        padding: 10px 0 0 10px;
        width: 100%;
        border: 0;
        height: 40px;
    }

    .message-footer #input_message:focus {
        outline: none;
        border: 0;
    }

    .message-footer #btn_add_message {
        border: 0;
        background: transparent;
        font-size: 28px;
        color: #B0B0B0;
    }

    .footer-btn {
        position: absolute !important;
        bottom: 0;
    }

    img.profile-pic {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        position: absolute;
        bottom: 10px;
    }

    img.profile-pic.left {
        left: 10px;
    }

    img.profile-pic.right {
        right: 10px;
    }

    .profile-user {
        position: absolute;
        bottom: 10px;
        display: block;
        line-height: 39px;
        font-weight: 600;
        top: 50px;
    }

    .profile-user.left {
        left: 10px;
    }

    .profile-user.right {
        right: 10px;
    }

    .ion-email {
        float: right;
        font-size: 32px;
        vertical-align: middle;
    }

    .message {
        font-size: 14px;
    }

    .message-detail {
        white-space: nowrap;
        font-size: 14px;
    }

    .bar.item-input-inset .item-input-wrapper input {
        width: 100% !important;
    }

    .message-wrapper {
        position: relative;
    }

    .message-wrapper:last-child {
        margin-bottom: 10px;
    }

    .chat-bubble {
        border-radius: 5px;
        display: inline-block;
        padding: 10px 18px;
        position: relative;
        margin: 10px;
        max-width: 80%;
    }

    .chat-bubble:before {
        content: "\00a0";
        display: block;
        height: 16px;
        width: 9px;
        position: absolute;
        bottom: -7.5px;
    }

    .chat-bubble.left {
        background-color: #e6e5eb;
        float: left;
        margin-left: 55px;
    }

    .chat-bubble.left:before {
        background-color: #e6e5eb;
        left: 10px;
        -webkit-transform: rotate(70deg) skew(5deg);
    }

    .chat-bubble.right {
        background-color: #158ffe;
        color: #fff;
        float: right;
        margin-right: 55px;
    }

    .chat-bubble.right:before {
        background-color: #158ffe;
        right: 10px;
        -webkit-transform: rotate(118deg) skew(-5deg);
    }

    .chat-bubble.right a.autolinker {
        color: #fff;
        font-weight: bold;
    }

    .user-messages-top-icon {
        font-size: 28px;
        display: inline-block;
        vertical-align: middle;
        position: relative;
        top: -3px;
        right: 5px;
    }

    .msg-header-username {
        display: inline-block;
        vertical-align: middle;
        position: relative;
        top: -3px;
    }

    .sendMessageForm .item-input-wrapper {
        background-color: #f4f4f4 !important;
    }

    .bold {
        font-weight: bold;
    }

    .cf {
        clear: both !important;
    }

    a.autolinker {
        color: #3b88c3;
        text-decoration: none;
    }

    /* loading */
    .loader-center {
        height: 100%;
        display: -webkit-box;
        display: -moz-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-box-direction: normal;
        -moz-box-direction: normal;
        -webkit-box-orient: horizontal;
        -moz-box-orient: horizontal;
        -webkit-flex-direction: row;
        -ms-flex-direction: row;
        flex-direction: row;
        -webkit-flex-wrap: nowrap;
        -ms-flex-wrap: nowrap;
        flex-wrap: nowrap;
        -webkit-box-pack: center;
        -moz-box-pack: center;
        -webkit-justify-content: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-align-content: stretch;
        -ms-flex-line-pack: stretch;
        align-content: stretch;
        -webkit-box-align: center;
        -moz-box-align: center;
        -webkit-align-items: center;
        -ms-flex-align: center;
        align-items: center;
    }

    .loader .ion-loading-c {
        font-size: 64px;
    }
</style>
<script>
    var message_text = '{{ @$record->message }}';
    var auth_user= "{{auth()->user()->full_name}}";
    if(message_text=="")
    {
        var message_json = [];
    }
    else{
        var message_json = jQuery.parseJSON(String(message_text).replace(/(&quot\;)/g,"\""));
        $.each(message_json,function(index, item){
            bind_html = ` <div ng-repeat="message in messages" class="message-wrapper"
                                on-hold="onMessageHold($event, $index, message)">
                                `;
            if(item.user == auth_user)
            {
                bind_html += ` <div ng-if="user._id === message.userId">
                                    <img ng-click="viewProfile(message)" class="profile-pic right" style="display:none" />
                                    <span class="profile-user right">${item.user}</span>
                                    <div class="chat-bubble right">
                                        <div class="message" ng-bind-html="message.text | nl2br" autolinker>
                                        </div>
                                        <div class="message-detail">
                                            <span ng-click="viewProfile(message)"
                                                class="bold">${item.message}</span>,
                                            <span am-time-ago="message.date"></span>
                                        </div>
                                    </div>
                                </div>`;
            }
            else{
                bind_html += `<div ng-if="user._id !== message.userId">
                                    <img ng-click="viewProfile(message)" class="profile-pic left" style="display:none" />
                                    <span class="profile-user left">${item.user}</span>
                                    <div class="chat-bubble left">
                                        <div class="message" ng-bind-html="message.text | nl2br" autolinker>
                                        </div>
                                        <div class="message-detail">
                                            <span ng-click="viewProfile(message)"
                                                class="bold">${item.message}</span>,
                                            <span am-time-ago="message.date"></span>
                                        </div>
                                    </div>
                                </div>`;
            }
            bind_html += `<div class="cf"></div></div>`;
            $("#UserMessages").append(bind_html);
        });
    }



    // var message_json = [];
    // var str = '[{"user":"Admin","message":"123","date":"2023/7/21"},{"user":"Admin","message":"222","date":"2023/7/21"}]';
    // var message_json = jQuery.parseJSON(str);
    $("#input_message").on("keydown", function(event) {
        if(event.which == 13)
        {
            addMessage();
        }
    });
    $("#btn_add_message").on("click", function() {
        addMessage();
    });
    function addMessage()
    {
        let message = $("#input_message").val();
        let user = $("#input_message").data('user');
        var d = new Date();
        var date = d.getFullYear() + "/" + (d.getMonth()+1) + "/" + d.getDate()
        let obj = {
            user: user,
            message: message,
            date: date
        }
        message_json.push(obj);
        $("#message").val(JSON.stringify(message_json));

        bind_mess_html = ` <div ng-repeat="message in messages" class="message-wrapper"
                                on-hold="onMessageHold($event, $index, message)">
                                `;
        if(user == auth_user)
        {
            bind_mess_html += ` <div ng-if="user._id === message.userId">
                                <img ng-click="viewProfile(message)" class="profile-pic right" style="display:none" />
                                <span class="profile-user right">${user}</span>
                                <div class="chat-bubble right">
                                    <div class="message" ng-bind-html="message.text | nl2br" autolinker>
                                    </div>
                                    <div class="message-detail">
                                        <span ng-click="viewProfile(message)"
                                            class="bold">${message}</span>,
                                        <span am-time-ago="message.date"></span>
                                    </div>
                                </div>
                            </div>`;
        }
        else{
            bind_mess_html += `<div ng-if="user._id !== message.userId">
                                <img ng-click="viewProfile(message)" class="profile-pic left" style="display:none" />
                                <span class="profile-user left">${user}</span>
                                <div class="chat-bubble left">
                                    <div class="message" ng-bind-html="message.text | nl2br" autolinker>
                                    </div>
                                    <div class="message-detail">
                                        <span ng-click="viewProfile(message)"
                                            class="bold">${message}</span>,
                                        <span am-time-ago="message.date"></span>
                                    </div>
                                </div>
                            </div>`;
        }
        bind_mess_html += `<div class="cf"></div></div>`;
        $("#UserMessages").append(bind_mess_html);
        $("#input_message").val('')
    }
</script>
@endpush
