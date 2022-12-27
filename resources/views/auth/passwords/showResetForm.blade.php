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
                                    <h3>Đặt lại mật khẩu</h3>
                                </div>

                                <form method="POST" action="{{ route('password.update') }}">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <div class="form-group form-focus">
                                        <input id="email" type="text"
                                            class="form-control floating @error('email') is-invalid @enderror"
                                            name="email" value="{{ $email ?? old('email') }}" required
                                            autocomplete="email" autofocus>
                                        <label class="focus-label">Địa chỉ Email</label>
                                    </div>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <div class="form-group form-focus">
                                        <input id="password" type="password"
                                            class="form-control floating @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="new-password">
                                        <label class="focus-label">Mật khẩu</label>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <div class="form-group form-focus">
                                        <input id="password-confirm" type="password" class="form-control floating"
                                            name="password_confirmation" required autocomplete="new-password">
                                        <label class="focus-label">Nhập lại mật khẩu</label>
                                    </div>
                                    <br>
                                    <input type="submit" class="btn btn-primary btn-block btn-lg login-btn"
                                        value="Đặt lại mật khẩu">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
