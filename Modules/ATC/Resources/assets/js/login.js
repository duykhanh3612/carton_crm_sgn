(function($) {
    $.fn.addAnimate = function(animate) {
        var animateClass = animate + ' animated';
        this.removeClass(animateClass).addClass(animateClass).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
            $(this).removeClass(animateClass);
        });
        return this;
    }
})(jQuery);

var resetpass_step = 0;
$(document).ready(function() {
    setTimeout(function () {
        $('input[name="username"]').focus();
    }, 2000);

    $('.form-1').submit(function () {
        var username = $('input[name="username"]').val().trim(),
            password = $('input[name="password"]').val().trim();
        if (username == '') {
            $('input[name="username"]').parent().addAnimate('shake');
            $('input[name="username"]').focus();
            return false;
        }
        if (password == '') {
            $('input[name="password"]').parent().addAnimate('shake');
            $('input[name="password"]').focus();
            return false;
        }
        $('button[type="submit"], input[type="text"]').attr('disabled', true);
        $.ajax({
            url: site_url + '/auth/process-login',
            type: 'POST',
            cache: false,
            data: {
                username: username,
                password: password
            },
            success: function(res) {
                $('button[type="submit"], input[type="text"]').attr('disabled', false);
                if (res.success) {
                    $('.failed').text('Đăng nhập thành công').slideDown();
                    setTimeout(function() {
                        window.location = site_url;
                    }, 2000);
                } else {
                    $('.failed').slideDown();
                }
            }
        });
        return false;
    });

    $('#forgotpass').bind('click', function() {
        resetpass_step = 1;
        $('#forgotpass').unbind('click');
        $('.form-1').bind('submit', function() {
            return false;
        });
        $('.failed').text('Nhập tên đăng nhập của bạn để tiếp tục').slideDown();
        $('input[type="password"]').parent().parent().slideUp();
        $('input[name="username"]').focus();
        $('.submit').text('Tiếp tục').bind('click', function() {
            var code = '',
                user = '',
                pass = '';
            if (resetpass_step == 1) {
                user = $('input[name="username"]').val().trim();
                if (user == '') {
                    $('input[name="username"]').parent().addAnimate('shake');
                    $('input[name="username"]').focus();
                    return false;
                }
                $('button[type="submit"], input[type="text"]').attr('disabled', true);
                $('.failed').text('Đăng kiểm tra tên đăng nhập ...');
                $.ajax({
                    url: site_url + 'dashboard/reset_password',
                    type: 'POST',
                    cache: false,
                    data: {
                        step: resetpass_step,
                        user: user
                    },
                    success: function(status) {
                        $('button[type="submit"], input[type="text"]').attr('disabled', false);
                        $('input[name="username"]').val(user);
                        if (status == 1) {
                            $('input[name="username"]').parent().parent().fadeOut(function() {
                                $('input[name="code"]').parent().parent().fadeIn(function () {
                                    $('.failed').text('Kiểm tra email và nhập mã xác nhận để tiếp tục');
                                    $('.submit').text('Xác nhận');
                                });
                            });
                            resetpass_step = 2;
                        } else if (status == 2) {
                            $('.failed').text('Bạn chưa cập nhật email!');
                        } else if (status == 0) {
                            $('.failed').text('Tên đăng nhập không tồn tại!');
                        } else {
                            $('.failed').text('Gửi email thất bại! Gọi chúng tôi để được hỗ trợ');
                        }
                        console.log({status});
                    }
                });
            } else if (resetpass_step == 2) {
                code = $('input[name="code"]').val().trim();
                if (code == '') {
                    $('input[name="code"]').parent().addAnimate('shake');
                    $('input[name="code"]').focus();
                    return false;
                }
                $('button[type="submit"], input[type="text"]').attr('disabled', true);
                $.ajax({
                    url: site_url + 'dashboard/reset_password',
                    type: 'POST',
                    cache: false,
                    data: {
                        step: resetpass_step,
                        code: code
                    },
                    success: function(status) {
                        $('button[type="submit"], input[type="text"]').attr('disabled', false);
                        if (status == 1) {
                            $('input[name="code"]').parent().parent().fadeOut(function() {
                                $('input[type="password"]').parent().parent().slideDown();
                                $('.failed').text('Nhập mật khẩu mới và tiếp tục');
                            });
                            resetpass_step = 3;
                        } else if (status == 2) {
                            $('.failed').text('Mã xác nhận không chính xác!');
                        }
                    }
                });
            } else if (resetpass_step == 3) {
                code = $('input[name="code"]').val().trim();
                pass = $('input[name="password"]').val().trim();
                if (code == '') {
                    $('input[name="code"]').parent().addAnimate('shake');
                    $('input[name="code"]').focus();
                    return false;
                }
                if (pass == '') {
                    $('input[name="password"]').parent().addAnimate('shake');
                    $('input[name="password"]').focus();
                    return false;
                }
                $('button[type="submit"], input[type="text"]').attr('disabled', true);
                $.ajax({
                    url: site_url + 'dashboard/reset_password',
                    type: 'POST',
                    cache: false,
                    data: {
                        step: resetpass_step,
                        code: code,
                        pass: pass
                    },
                    success: function() {
                        $('.failed').text('Đang đăng nhập hệ thống!');
                        setTimeout(function() {
                            window.location = window.location;
                        }, 2000);
                    }
                });
            }
        });
    });
});