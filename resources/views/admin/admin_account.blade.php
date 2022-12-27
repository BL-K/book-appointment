@extends('layouts.admin_app')

@section('content')
    <h1 class="page-title">Tài khoản quản lý</h1>
    <hr style="height:2px; background-color:gray;">

    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <form name="regform" method="POST" action="{{ route('admin.admin_change_profile') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="panel-heading">
                    <h3>Tài khoản quản lý</h3>
                </div>
                <div class="panel">
                    @if (session('success_1'))
                        <div class="alert alert-success">
                            {{ session('success_1') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="panel-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Họ và tên</label>
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" id="name"
                                    value="{{ Auth::user()->name }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="email">Địa chỉ Email</label>
                                <input type="text" name="email"
                                    class="form-control @error('email') is-invalid @enderror" id="email"
                                    value="{{ Auth::user()->email }}">
                            </div>
                        </div>
                        <div class="md-3 mt-3">
                            <button type="submit" class="btn btn-primary btn-block">Thay đổi</button>
                        </div>
                    </div>
                </div>
        </div>
        </form>

        <div class="col-md-12">
            <form name="resetform" method="POST" action="{{ route('admin.admin_change_password') }}">
                @csrf
                <div class="panel-heading">
                    <h3>Thay đổi mật khẩu</h3>
                </div>
                <div class="panel">
                    @foreach ($errors->all() as $error)
                        <p class="text-danger">{{ $error }}</p>
                    @endforeach
                    @if (session('success_2'))
                        <div class="alert alert-success">
                            {{ session('success_2') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="password">Mật khẩu cũ</label>
                            <input type="password" name="current_password" class="form-control" id="current_password"
                                autocomplete="current-password">
                        </div>
                        <div class="form-group">
                            <label for="password">Mật khẩu mới</label>
                            <input type="password" name="new_password" class="form-control" id="new_password"
                                autocomplete="current-password">
                        </div>
                        <div class="form-group">
                            <label for="password">Nhập lại mật khẩu mới</label>
                            <input type="password" name="new_confirm_password" class="form-control"
                                id="new_confirm_password" autocomplete="current-password">
                        </div>
                        <div class="md-3 mt-3">
                            <button type="submit" class="btn btn-primary btn-block">Đổi mật khẩu</button>
                        </div>
                    </div>
                </div>
        </div>
        </form>
    </div>

    <style>
        label {
            font-size: 15px;
        }
    </style>
@endsection
