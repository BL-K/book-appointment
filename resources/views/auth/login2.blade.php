<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Medical Register - Login</title>

  <!-- start: Css -->
  <link rel="stylesheet" type="text/css" href="{{ asset ('admin_hospital/css/bootstrap.min.css') }}">

  <!-- plugins -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" type="text/css" href="{{ asset ('admin_hospital/css/plugins/fontawesome.min.css') }}"/>
  <link rel="stylesheet" type="text/css" href="{{ asset ('admin_hospital/css/plugins/simple-line-icons.css') }}"/>
  <link rel="stylesheet" type="text/css" href="{{ asset ('admin_hospital/css/plugins/animate.min.css') }}"/>
  <link rel="stylesheet" type="text/css" href="{{ asset ('admin_hospital/css/plugins/icheck/skins/flat/aero.css') }}"/>
  <link href="{{ asset ('admin_hospital/css/style.css') }}" rel="stylesheet">
  <!-- end: Css -->

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
    </head>

    <body style="background-color: rgb(91, 217, 226)">

      <div class="container">

        <form class="form-signin" method="POST" action="{{ route('login') }}">
          @csrf
            <div class="panel periodic-login">
                <div class="panel-body text-center">
                <h1 class="atomic-number">Medical Register</h1>
                <br>
                @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
                @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
                <div class="panel-body text-center">
                  <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <label style="margin-top: -35px;">{{ __('Email Address') }}</label>
                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                  </div>
                  <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <label style="margin-top: -35px;">{{ __('Password') }}</label>
                    <input style="border-radius: 0%;" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                  </div>
                  <div>
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                      {{ __('Remember Me') }}
                  </label>
                  </div>
                  <input type="submit" class="btn col-md-12" value="Sign In"/>
                </div>

                <div class="text-center" style="padding:5px;">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                </div>
          </div>
          </div>
        </form>

      </div>

      <!-- end: Content -->
      <!-- start: Javascript -->
      <script src="{{ asset ('admin_hospital/js/jquery.min.js') }}"></script>
      <script src="{{ asset ('admin_hospital/js/jquery.ui.min.js') }}"></script>
      <script src="{{ asset ('admin_hospital/js/bootstrap.min.js') }}"></script>

      <script src="{{ asset ('admin_hospital/js/plugins/moment.min.js') }}"></script>
      <script src="{{ asset ('admin_hospital/js/plugins/icheck.min.js') }}"></script>

      <!-- custom -->
      <script src="{{ asset ('admin_hospital/js/main.js') }}"></script>
      <script type="text/javascript">
       $(document).ready(function(){
         $('input').iCheck({
          checkboxClass: 'icheckbox_flat-aero',
          radioClass: 'iradio_flat-aero'
        });
       });
     </script>
     <!-- end: Javascript -->
   </body>
   </html>