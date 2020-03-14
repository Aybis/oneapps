<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{ asset('assets/img/logo-trans-min.png')}}">
    <title>OneApps</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/lib/perfect-scrollbar/css/perfect-scrollbar.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animate.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/lib/material-design-icons/css/material-design-iconic-font.min.css')}}"/><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link rel="stylesheet" href="assets/css/style.css" type="text/css"/>
        <style>
            #logo-pins{
                margin-bottom: 8%;
            }
            .form-control{
                border-radius: 5px;

            }
            form .btn-xl{
                border-radius:5px;
            }
            .app-logo {
                font-size: 20px;
                text-align: center;
                font-weight: 300;

                width: 100%;
                border-bottom: 1px solid #000;
                line-height: 0.1em;
                margin: 10px 0 35px;
            }
            .app-logo span {
                background: #fff;
                padding: 0 10px;
            }
        </style>
    </head>
    <body class="be-splash-screen">
        <div class="be-wrapper be-login">
            <div class="be-content">
                <div class="main-content container-fluid" style="padding-top:5%">

                    <div class="splash-container">
                        <div class="text-center animated fadeInDown" id="logo-pins">
                            <img src="{{ asset('assets/img/logo-trans-min.png')}}" class="" style="max-width:170px">
                        </div>
                        <div class="panel panel-default animated fadeInUp" style="border-radius:10px">
                            <div class="panel-heading" style="padding-top:20px">
                                <p class="app-logo animated fadeIn delay-1s"><span><b>One</b>Apps</span></p>
                            </div>
                            <div class="panel-body" style="padding:10px 20px;">
                                <form action="/login" method="post">
                                    @csrf
                                    <div class="login-form">
                                        <div class="form-group">
                                            <input name="username" type="text" class="form-control {{$errors->has('username') ? 'is-invalid' : '' }}" placeholder="Username" value="{{ old('username') }}" required autofocus>
                                            <span class="form-control-feedback"></span>

                                            @if ($errors->has('username'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('username') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <input name="password" type="hidden" value="gloryHorsePower">
                                        {{-- <input name="password" type="hidden" value="ijustmadeiteasyforyou"> --}}

                                        <div class="form-group row login-tools" hidden>
                                            <div class="col-xs-6 login-remember">
                                                <div class="be-checkbox">
                                                    <input type="checkbox" id="remember" >
                                                    <label for="remember">Remember Me</label>
                                                </div>
                                            </div>
                                            {{-- <div class="col-xs-6 login-forgot-password"><a href="#">Forgot Password?</a></div> --}}
                                        </div>
                                        <div class="form-group row login-submit">
                                            <div class="col-xs-12" hidden>
                                                <button data-dismiss="modal" type="submit" class="btn btn-default btn-xl">Register</button>
                                            </div>
                                            <div class="col-xs-12">
                                                <button data-dismiss="modal" type="submit" data-loading-text="Loading..." class="btn btn-primary btn-xl">Sign in</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('assets/lib/jquery/jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/js/main.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/lib/bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script type="text/javascript">
            //   const element =  document.querySelector('#logo-pins')
            //     element.classList.add('animated', 'fadeInDown')
        </script>
    </body>
    </html>
