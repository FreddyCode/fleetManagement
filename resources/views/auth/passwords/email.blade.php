<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Fleet Management Portal">
    <meta name="author" content="Fleet Management Portal">
    <meta name="keyword" content="Fleet Management Portal">
    <link rel="shortcut icon" href="../assets/img/enshikalogo.jpg">

    <title>Fleet Management Portal</title>

    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/bootstrap-theme.css" rel="stylesheet">
    <link href="../assets/css/elegant-icons-style.css" rel="stylesheet" />
    <link href=../"assets/css/font-awesome.css" rel="stylesheet" />
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/style-responsive.css" rel="stylesheet" />
</head>

<body class="login-img3-body">
<div style="background-color: #FFFFFF; height: 120px; text-align: center; color: white;
     font-size:4vw; position: relative; padding-top: 10px">
    <img src="../assets/img/logo_new.png"
         height="100px" width="400px">
</div>
<div class="container">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <form class="login-form" method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="login-wrap">
            <p >Reset Password</p>
            <div class="input-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <span class="input-group-addon"><i class="icon_profile"></i></span>
                <div >
                    <input id="email" type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
                </div>
            </div>
            <div>
                @if ($errors->has('email'))
                    <span class="help-block" style="color: red">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <span class="pull-right"> <a href="/"><font color="#FF8000"> Back to Login</font></a></span>
            <button class="btn btn btn-lg btn-block" type="submit">{{ __('Send Password Reset Link') }}</button>
        </div>
    </form>
</div>
<script src="{{ asset('js/app.js') }}"></script>
<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
</script>
</body>
</html>
