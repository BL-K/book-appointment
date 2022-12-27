@extends('layouts.hospital_app')

@section('content')
    <h1 class="page-title">Thay đổi mật khẩu</h1>
    <hr style="height:2px; background-color:gray;">

    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <form name="resetform" method="POST"
                action="{{ route('hospital.hospital_change_password') }}">
                @csrf
                <div class="panel-heading">
                    <h3>Thay đổi mật khẩu</h3>
                </div>
                <div class="panel">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
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
