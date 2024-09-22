<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{user_setting("site_title")}} | Login System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="{{ asset('plugin/assets/login/polanquette/dist') }}/style.css">

</head>

<body>
    <!-- partial:index.partial.html -->
    <div id="login" class="login-form-container">
        <header><i class="fa fa-lock"></i> ĐĂNG NHẬP</header>
        <form action="{{route("user.process_login")}}" method="POST">
            <fieldset>
                <div class="input-wrapper">
                    <input type="text" name="email" placeholder="Email/Mã đăng nhập" required />
                </div>
                <div class="input-wrapper">
                    <input type="password" name="password" placeholder="Mật khẩu" required />
                </div>
                <button type="submit"><i class="fa fa-key"></i> Đăng nhập</button>
                @csrf
            </fieldset>
        </form>
    </div>
    <!-- partial -->
    <script src="{{ asset('plugin/assets/login/polanquette/dist') }}/script.js"></script>
    <style type="text/css">
        body{
            background: #0b87c9;
        }
        .login-form-container{
            background: #Fff;
            color:#000;
        }
        .login-form-container header{
            background: #Fff;
            color: #478fca !important;
            font-size: 23px;
            text-align: left;
            padding: 0.5em 1.5em;
        }
        .login-form-container .input-wrapper:before {
            font-family: FontAwesome;
            position: absolute;
            display: inline-block;
            top: 9px;
            left: auto;
            right: 8px;
            font-size: 14px;
            color: #909090;
        }
        .login-form-container .input-wrapper{
            margin: 0.5em 2em auto;
            border: 1px solid #d5d5d5;
            padding: 0px 15px;
        }
        .login-form-container .input-wrapper input{
            padding: 0.3em 0.5em;
            color: #909090;
        }
        button[type=submit]
        {
            margin: 1em auto;
            width: 170px;
            padding: 0.5em 0;
            background-color: #428bca !important;
            border-color: #428bca;
            cursor: pointer;
        }
        .login-form-container button:hover{
            border: 0 !important;
             padding: 0.6em 0;
        }
        .fa.fa-key::before{
            font-family: FontAwesome;
            content: "\f084";
        }
        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus,
        textarea:-webkit-autofill,
        textarea:-webkit-autofill:hover,
        textarea:-webkit-autofill:focus,
        select:-webkit-autofill,
        select:-webkit-autofill:hover,
        select:-webkit-autofill:focus {
        /* border: 1px solid green; */
        -webkit-text-fill-color: #909090 !important;
        /* -webkit-box-shadow: 0 0 0px 1000px #000 inset; */
        transition: background-color 5000s ease-in-out 0s;
        }
    </style>
</body>

</html>
