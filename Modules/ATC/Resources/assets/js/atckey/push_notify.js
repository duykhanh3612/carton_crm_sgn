function requestPermission() {
    return new Promise(function (resolve, reject) {
        const permissionResult = Notification.requestPermission(function (result) {
            resolve(result);
        });
        if (permissionResult) {
            permissionResult.then(resolve, reject);
        }
    }).then(function (permissionResult) {
        if (permissionResult !== 'granted') {
            throw new Error('Permission not granted.');
        }
    });
}

function getpermission() {
    Push.Permission.request();
}

//my check
function checkpermission() {
    if (!Push.Permission.has()) {
        alert('need Permission');
    } else {
        alert('has Permission');
    }
}

function Notify(title = '', content = '', callback = false) {
    Push.Permission.has();//check
    if (!title) title = $.cookie('notify_title') || "CRM - Thông báo từ hệ thống fCMS";
    title = title.replace(/\+/gi, " ");
    if (!content) content = $.cookie('notify_content') || "This is a test";
    content = content.replace(/\+/gi, " ");
    //setNotification(title, content, site_url + '/assets/img/email/logonew.png');
    Push.create(title, {
        body: content,
        icon: site_url + '/assets/img/email/logonew.png',
        timeout: 4000,
        vibrate: 200,
        onClick: function () {
            if (!!callback) {
                callback();
            } else {
                window.focus();
                this.close();
            }
        }
    });
}

if ($.cookie('push_notify') == 'true') {
    $.cookie('push_notify', "false", {
        path: '/'
    });
    Notify();
} else {
    Push.clear();
}

function setSettingListHeightAndScroll(isFirstTime) {
    var height = $(window).height() - ($('.navbar').innerHeight() + $('.right-sidebar .nav-tabs').outerHeight());
    var $el = $('.right-sidebar .demo-settings');

    if (!isFirstTime) {
        $el.slimScroll({destroy: true}).height('auto');
        $el.parent().find('.slimScrollBar, .slimScrollRail').remove();
    }

    $el.slimscroll({
        height: height + 'px',
        color: 'rgba(0,0,0,0.5)',
        size: '6px',
        alwaysVisible: false,
        borderRadius: '0',
        railBorderRadius: '0'
    });
}

$(function () {
    $('#slimer-action').slimscroll({
        height: '254px',
        color: 'rgba(0,0,0,0.5)',
        size: '4px',
        alwaysVisible: false,
        borderRadius: '0',
        railBorderRadius: '0'
    });
    setSettingListHeightAndScroll(true);
    $(window).resize(function () {
        setSettingListHeightAndScroll(false);
    });
});

$('.notify').bind('mousewheel DOMMouseScroll', function (e) {
    var scrollTo = null;
    if (e.type == 'mousewheel') scrollTo = (e.originalEvent.wheelDelta * -1);
    else if (e.type == 'DOMMouseScroll') scrollTo = 40 * e.originalEvent.detail;

    if (scrollTo) {
        e.preventDefault();
        $(this).scrollTop(scrollTo + $(this).scrollTop());
    }
});

var isOpenNofity = false;
$('body').on('click', '.press-notify', function () {
    var id = $(this).data('id');
    if (!!id) $.ajax({url: site_url + 'ajax/update_notify', type: 'POST', cache: false, data: {id: id}})
});

function setNotification(title, mesage, icon) {
    showDesktopNotification(title, mesage, icon);
    // sendNodeNotification(title, mesage, icon);
}

//check denied
var Notification = window.Notification || window.mozNotification || window.webkitNotification;
Notification.requestPermission(function (permission) {
});

function requestNotificationPermissions() {
    if (Notification.permission !== 'denied') {
        Notification.requestPermission(function (permission) {
        });
    }
}

function showDesktopNotification(message, body, icon, sound, timeout) {
    if (!timeout) {
        timeout = 4000;
    }
    requestNotificationPermissions();
    var instance = new Notification(
        message, {
            body: body,
            icon: icon,
            sound: sound
        }
    );
    instance.onclick = function () {

    };
    instance.onerror = function () {

    };
    instance.onshow = function () {

    };
    instance.onclose = function () {

    };
    if (sound) {
        instance.sound;
    }
    setTimeout(instance.close.bind(instance), timeout);
    return false;
}
// var socket = io.connect('http://' + window.location.hostname + ':3000',{secure: true});
$('#submitBtn').click(function () {
    var module = $('#moduleInfo').data('table') == 'customer_request_management';
    if (!!module) {
        var notify = {};
        var duid = $('#lead_create').val() || [];
        var owner = $('#lead_owner').val();
        duid = [...duid, ...arrChannelManage];
        duid = duid.filter((value, index, self) => self.indexOf(value) === index);
        Array.prototype.remove = function () {
            var what, a = arguments, L = a.length, ax;
            while (L && this.length) {
                what = a[--L];
                while ((ax = this.indexOf(what)) !== -1) {
                    this.splice(ax, 1);
                }
            }
            return this;
        };
        duid.remove(owner);
        if (!!duid) $.each(duid, (i, key) => notify[key] = 'non-owner');
        notify[owner] = 'owner';
        var assignTo = $('.assign_to').last().val();
        if (!!assignTo) notify[assignTo] = 'assign';
        var id = $('#id').val();
        if (!id) {
            $.ajax({
                url: site_url + 'customer_request_management/ajax_query_maxid',
                type: 'POST',
                cache: false,
                success: res => id = res
            });
        }
        notify['id'] = id;
        socket.emit('notify', notify);
    }
});

// socket.on('notify', data => {
//     var login = $('#login').val();
//     var id = data['id'];
//     delete data['id'];
//     var link = '';
//     var content = 'You have successfully created leads id#' + id;
//     if (!!id) link = site_url + 'customer_request_management/update/' + id;
//     var d = new Date(), month = d.getMonth() + 1, day = d.getDate();
//     var date = '1 second\' before, at ' + d.getFullYear() + (month < 10 ? '0' : '') + month + '/' + (day < 10 ? '0' : '') + day;
//     if (!!login && !!data[login]) {
//         switch (data[login]) {
//             case 'non-owner':
//                 content = 'You have joined the leads id#' + id;
//                 break;
//             case 'assign':
//                 content = 'Your leads id# ' + id + ' have been updated';
//                 break;
//         }
//         var notify = {title: 'CRM - Notification from fMCS system', link: link, date: date, content: content, id: id};
//         var stt = parseInt($('.notify .badge-info').text());
//         $('.notify .badge-info').text(stt + 1);
//         var html_li = '<div href="' + notify.link + '" class="press-notify" data-id="' + notify.id + '"> <div class="icon-circle" style="background:#0093d9"> <i class="fa  fa-bell"></i> </div> <div class="menu-info"> <a href="' + notify.link + '" class="text-notify  font-bold">' + notify.content + '</a> <p><i class="fa fa-clock-o"></i> ' + notify.date + '</p> </div> <div class="inline" style="float: right"><a href="javascript:;" data-placement="bottom" title="Xóa" class="delRestoreLink none-type" data-id="' + notify.id + '" data-table="notification"><div class="icon glyphicons bin waves-effect waves-circle"></div></a></div> </div>';
//         if ($('.notify-new').length > 0) $('.mnotify .notify-new').append('<li>' + html_li + '</li>'); else $('.mnotify ul').prepend('<li class="notify-new"><a class="noHover font-bold">New</a></li><li>' + html_li + '</li>');
//         Push.create(notify.title, {
//             body: notify.content,
//             icon: site_url + '/assets/img/email/logonew.png',
//             timeout: 4000,
//             vibrate: 200,
//             onClick: function () {
//                 window.focus();
//                 this.close();
//             }
//         });
//     }
// });
