(function($) {
    $.alerts = {
        verticalOffset: -75,
        horizontalOffset: 0,
        repositionOnResize: true,
        overlayOpacity: .5,
        overlayColor: '#000',
        okButton: ' OK ',
        cancelButton: ' Cancel ',
        dialogClass: null,

        alert: function(message, title, callback) {
            if (title == null) title = 'Alert';
            $.alerts._show(title, message, null, 'alert', function(result) {
                if (callback) callback(result);
            });
        },

        confirm: function(message, title, callback) {
            if (title == null) title = 'Confirm';
            $.alerts._show(title, message, null, 'confirm', function(result) {
                if (callback) callback(result);
            });
        },
        confirm1: function(message, title, callback) {
            if (title == null) title = 'Confirm';
            $.alerts._show(title, message, null, 'confirm1', function(result) {
                if (callback) callback(result);
            });
        },
        _show: function(title, msg, value, type, callback) {
            $.alerts._hide();
            $.alerts._overlay('show');
            $("BODY").append('<div id="popup_container">' + '<h1 id="popup_title"></h1>' + '<div id="popup_content">' + '<div id="popup_message"></div>' + '</div>' + '</div>').addClass('in');
            if ($.alerts.dialogClass) $("#popup_container").addClass($.alerts.dialogClass);
            $("#popup_container").css({
                position: 'fixed',
                zIndex: 99999,
                padding: 0,
                margin: 0
            });
            $("#popup_title").text(title);
            $("#popup_message").text(msg);
            $("#popup_message").html($("#popup_message").text().replace(/\n/g, '<br />'));
            $("#popup_container").css({
                minWidth: $("#popup_container").outerWidth(),
                maxWidth: $("#popup_container").outerWidth()
            });
            $.alerts._reposition();
            $.alerts._maintainPosition(true);
            switch (type) {
                case 'alert':
                    $("#popup_message").after('<div id="popup_panel"><button class="btn btn-alt btn-border border-primary btn-hover font-primary" id="popup_ok"><span>' + $.alerts.okButton + '</span><i class="glyph-icon icon-check"></i></button></div>');
                    $("#popup_ok").click(function() {
                        $.alerts._hide();
                        callback(true);
                    });
                    $("#popup_ok").focus().keypress(function(e) {
                        if (e.keyCode == 13 || e.keyCode == 27) $("#popup_ok").trigger('click');
                    });
                    break;
                case 'confirm':
                    $("#popup_message").after('<div id="popup_panel"><button class="btn btn-alt btn-border border-primary btn-hover font-primary" id="popup_ok"><span>' + $.alerts.okButton + '</span><i class="glyph-icon icon-check"></i></button> <button class="btn btn-alt btn-border border-red btn-hover font-red" id="popup_cancel"><span>' + $.alerts.cancelButton + '</span><i class="glyph-icon icon-remove"></i></button></div>');
                    $("#popup_ok").click(function() {
                        $.alerts._hide();
                        if (callback) callback(true);
                    });
                    $("#popup_cancel").click(function() {
                        $.alerts._hide( );
                        if (callback) callback(false);
                    });
                    $("#popup_ok").focus();
                    $("#popup_ok, #popup_cancel").keypress(function(e) {
                        if (e.keyCode == 13) $("#popup_ok").trigger('click');
                        if (e.keyCode == 27) $("#popup_cancel").trigger('click');
                    });
                    break;
                    case 'confirm1':
                        $("#popup_message").after('<div id="popup_panel"><button class="btn btn-alt btn-border border-primary btn-hover font-primary" id="popup_ok"><span> Approve </span><i class="glyph-icon icon-check"></i></button> <button class="btn btn-alt btn-border border-warning btn-hover font-warning" id="popup_non"><span> Non Approve </span><i class="glyph-icon icon-check"></i></button>&nbsp;<button class="btn btn-alt btn-border border-red btn-hover font-red" id="popup_cancel"><span>' + $.alerts.cancelButton + '</span><i class="glyph-icon icon-remove"></i></button></div>');
                       $("#popup_ok").click(function() {
                            $.alerts._hide();
                            if (callback) callback(true);
                        });
                        $("#popup_non").click(function() {
                            $.alerts._hide();
                            if (callback) callback("a");
                        });
                        $("#popup_cancel").click(function() {
                            $.alerts._hide( );
                            if (callback) callback(false);
                        });
                        $("#popup_ok").focus();
                        $("#popup_ok, #popup_non, #popup_cancel").keypress(function(e) {
                            if (e.keyCode == 13) $("#popup_ok").trigger('click');
                            if (e.keyCode == 13) $("#popup_non").trigger('click');
                            if (e.keyCode == 27) $("#popup_cancel").trigger('click');
                        });
                        break;
            }
        },
        _hide: function() {
            $("#popup_container").remove();
            $("BODY").removeClass('in');
            $.alerts._overlay('hide');
            $.alerts._maintainPosition(false);
        },
        _overlay: function(status) {
            switch (status) {
                case 'show':
                    $.alerts._overlay('hide');
                    $("BODY").append('<div id="popup_overlay"></div>');
                    $("#popup_overlay").css({
                        position: 'fixed',
                        zIndex: 99998,
                        top: '0px',
                        left: '0px',
                        width: '100%',
                        height: $(document).height(),
                        background: $.alerts.overlayColor,
                        opacity: $.alerts.overlayOpacity
                    });
                    $("#popup_overlay").fadeIn(100);
                    break;
                case 'hide':
                    $("#popup_overlay").remove();
                    break;
            }
        },
        _reposition: function() {
            var top = (($(window).height() / 2) - ($("#popup_container").outerHeight() / 2)) + $.alerts.verticalOffset;
            var left = (($(window).width() / 2) - ($("#popup_container").outerWidth() / 2)) + $.alerts.horizontalOffset;
            if (top < 0) top = 0;
            if (left < 0) left = 0;
            $("#popup_container").css({
                top: top + 'px',
                left: left + 'px'
            });
            $("#popup_overlay").height($(document).height());
        },
        _maintainPosition: function(status) {
            if ($.alerts.repositionOnResize) {
                switch (status) {
                    case true:
                        $(window).bind('resize', $.alerts._reposition);
                    break;
                    case false:
                        $(window).unbind('resize', $.alerts._reposition);
                    break;
                }
            }
        }

    }
})(jQuery); 