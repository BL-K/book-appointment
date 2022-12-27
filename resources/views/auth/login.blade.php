@extends('layouts.patient_app')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="account-content">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-7 col-lg-6 login-left">
                                <img src="{{ asset('patient/img/login-banner.png') }}" class="img-fluid" alt="Doccure Login">
                            </div>
                            <div class="col-md-12 col-lg-6 login-right">
                                <div class="login-header">
                                    <h3>Đăng nhập <span>Medical Register</span></h3>
                                </div>
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
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group form-focus">
                                        <input id="email" type="text"
                                            class="form-control floating @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}" required autocomplete="email"
                                            autofocus>
                                        <label class="focus-label">Email</label>
                                    </div>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div class="form-group form-focus">
                                        <input id="password" type="password"
                                            class="form-control floating @error('password') is-invalid @enderror"
                                            name="password" required autocomplete="current-password">
                                        <label class="focus-label">Mật khẩu</label>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div class="text-right">
                                        @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}">
                                                {{ __('Quên mật khẩu?') }}
                                            </a>
                                        @endif
                                    </div>
                                    <br>
                                    <input type="submit" class="btn btn-primary btn-block btn-lg login-btn"
                                        value="Đăng nhập">
                                        
                                    <div class="login-or">
                                        <span class="or-line"></span>
                                        <span class="span-or">Hoặc</span>
                                    </div>
                                    <div class="row form-row social-login">
                                        <div class="col-12">
                                            <a href="{{ URL::to('cooperation') }}" class="btn btn-facebook btn-block">Liên hệ hợp tác</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
