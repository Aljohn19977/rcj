<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sign In | RCJ Fashion Admin</title>
    <!-- Favicon-->
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    {!! Html::style('plugins/GoogleFonts/google-fonts.css') !!}
    {!! Html::style('plugins/iconfont/material-icons.css') !!}

    <!-- Bootstrap Core Css -->
    {!! Html::style('plugins/bootstrap/css/bootstrap.css') !!}

    <!-- Waves Effect Css -->
     {!! Html::style('plugins/node-waves/waves.css') !!}

    <!-- Animation Css -->
     {!! Html::style('plugins/animate-css/animate.css') !!}

    <!-- Custom Css -->
    {!! Html::style('css/style.css') !!}




</head>

<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">RCJ<b>FASHION</b></a>
            <small>RCJ Fashion - Admin Panel</small>
        </div>
        <div class="card">
            <div class="body">
                    @if (session('status'))
                        <div class="alert bg-red alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                {{ session('status') }}
                        </div>
                    @endif
                    @if ($errors->has('password'))
                         <div class="alert bg-red alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                {{ $errors->first('password') }}
                        </div>            
                    @endif   
                    @if ($errors->has('password_confirmation'))
                          <div class="alert bg-red alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                {{ $errors->first('password_confirmation') }}
                         </div>                               
                    @endif                 
                <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.password.request') }}">
                
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">


                    <div class="msg">Reset Password</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" placeholder="Email" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                                <input id="password" type="password" class="form-control" name="password" placeholder="Enter your new password." required>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Enter your new confirm password." required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 p-t-5">
                        </div>
                        <div class="col-xs-12">
                            <button class="btn btn-block bg-pink waves-effect" type="submit">Reset Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
       {{ Html::script('plugins/jquery/jquery.min.js') }}

    <!-- Bootstrap Core Js -->
       {{ Html::script('plugins/bootstrap/js/bootstrap.js') }}

    <!-- Waves Effect Plugin Js -->
       {{ Html::script('plugins/node-waves/waves.js') }}

    <!-- Validation Plugin Js -->
       {{ Html::script('plugins/jquery-validation/jquery.validate.js') }}

    <!-- Custom Js -->
       {{ Html::script('js/admin.js') }}
       
       {{ Html::script('js/pages/examples/sign-in.js') }}

</body>

</html>