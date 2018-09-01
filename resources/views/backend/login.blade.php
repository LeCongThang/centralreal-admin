<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>.:Đăng Nhập:.</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <base href="{{asset('')}}">
    <link rel="stylesheet" href="{{asset('/')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('/')}}/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('/')}}/css/AdminLTE.min.css">
    <link rel="stylesheet" href="{{asset('/')}}/css/blue.css">
    <link rel="shortcut icon" href="img/logo.ico" type="image/vnd.microsoft.icon">

    <style type="text/css">
        body{
            background: url("{{asset('img/background.jpg')}}") !important;
            background-repeat: no-repeat;
            background-size: cover !important;
        }
        .se-pre-con {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url(img/loading.gif) center no-repeat rgba(255, 255, 255, 0.73);
        }
    </style>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition login-page" style="overflow: hidden">
<div class="login-box">
    <div class="login-logo">
        <img style="width: 150px;background: #fff;padding: 10px;" src="{{asset('img/logo.png')}}" alt="Logo">
    </div>
    <div class="login-box-body" style="border: 4px solid rgba(36, 36, 37, 0);background: #fff9;">
        <p class="login-box-msg">Mời đăng nhập</p>
        <form action="login" method="post" autocomplete="on">
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            @include('backend.partial.alert')
            <div class="form-group has-feedback">
                    <input type="text" class="form-control" required autofocus value="{{ session()->has('nhoemail') ? session('nhoemail') : old('email')}}" name="email"
                       placeholder="Email...">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" required name="password" value="{{ session('nhopass')}}" placeholder="Mật khẩu...">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" name="remember"> Ghi nhớ
                        </label>
                    </div>
                </div>
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Đăng nhập</button>
                </div>
            </div>
        </form>

        {{--<a href="#thankyou" data-toggle="modal">Quên mật khẩu?</a>--}}
    </div>
</div>
<div class="modal fade" id="thankyou">
    <div class="modal-dialog">
        <form action="{{asset('forget-password')}}" id="form-forget" autocomplete="off" method="post" role="form">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="modal-content" style="font-family: 'Lato', sans-serif;border:4px solid rgba(36, 36, 37, 0.5);">
                <div class="modal-header" style="background: rgb(230, 249, 236);">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Khôi phục mật khẩu</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for=""></label>
                        <input type="email" required autofocus class="form-control" name="email"
                               placeholder="Nhập địa chỉ email quản trị để lấy lại mật khẩu...">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Gửi</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="se-pre-con" style="display:none"></div>
@include('backend.partial.js')
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%'
    });
    $('#form-forget').submit(function () {
        $('.se-pre-con').css('display', 'block');
    });
</script>

<script>var language = '{{$language or 'vi'}}'</script>
{{--<script src="js/marker.js"></script>--}}
</body>
</html>
