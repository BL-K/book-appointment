@extends('layouts.admin_app')

@section('content')
    <h1 class="page-title">Tạo bệnh viện</h1>
    <hr style="height:2px; background-color:gray;">

    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <form name="add_form" method="POST" action="{{ URL::to('admin/insert_hospital') }}" enctype="multipart/form-data">
                @csrf
                <div class="panel-heading">
                    <h3>Tạo bệnh viện </h3>
                </div>
                <div class="panel">
                    <div class="panel-body">
                        <div class="form-group row">
                            <div class="form-group col-md-6">
                                <label for="name">Bệnh viện</label>
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="hospital_contact">Số điện thoại</label>
                                <input id="hospital_contact" type="tel"
                                    class="form-control @error('hospital_contact') is-invalid @enderror"
                                    name="hospital_contact" value="{{ old('hospital_contact') }}" required autofocus>
                                @error('hospital_contact')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="hospital_url">Địa chỉ URL</label>
                                <input id="hospital_url" type="url"
                                    class="form-control @error('hospital_url') is-invalid @enderror" name="hospital_url"
                                    value="{{ old('hospital_url') }}" required autofocus>
                                @error('hospital_url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Địa chỉ Email</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password">Mật khẩu</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password-confirm">Nhập lại mật khẩu</label>
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Hình ảnh bệnh viện</label>
                                <br>
                                <div class="col-md-4">
                                    <div class="imageupload">
                                        <img src="{{ URL::to('admin_hospital/img/icon.png') }}"
                                            style="width: 300%; height:300%;" id="output" class="img-fluid thumbnail"
                                            title="Hình ảnh bệnh viện">
                                        <div class="col-sm-6" style="width: 300%;">
                                            <input id="hospital_image" type="file"
                                                class="form-control @error('hospital_image') is-invalid @enderror"
                                                name="hospital_image" value="{{ old('hospital_image') }}" required
                                                autofocus accept="image/*" onchange="openFile(event)">
                                        </div>
                                    </div>
                                    @error('hospital_image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-12" style="margin-top: 5%;">
                                    <label class="form-row col-md-12">Thời gian làm việc</label>
                                    <br>
                                    <span class="form-group row">
                                        <span for="inputBusinessHourWeek" class="col-sm-3 col-form-label">Thứ hai - Thứ
                                            sáu</span>
                                        <div class="col-sm-4">
                                            <input id="open_week" type="time"
                                                class="form-control @error('open_week') is-invalid @enderror"
                                                name="open_week" value="{{ old('open_week') }}" required autofocus>
                                            @error('open_week')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-4">
                                            <input id="close_week" type="time"
                                                class="form-control @error('close_week') is-invalid @enderror"
                                                name="close_week" value="{{ old('close_week') }}" required autofocus>
                                            @error('close_week')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </span>
                                    <span class="form-group row">
                                        <span for="inputBusinessHourSat" class="col-sm-3 col-form-label">Thứ bảy</span>
                                        <div class="col-sm-4">
                                            <input id="open_sat" type="time"
                                                class="form-control @error('open_sat') is-invalid @enderror"
                                                name="open_sat" value="{{ old('open_sat') }}" required autofocus>
                                            @error('open_sat')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-4">
                                            <input id="close_sat" type="time"
                                                class="form-control @error('close_sat') is-invalid @enderror"
                                                name="close_sat" value="{{ old('close_sat') }}" required autofocus>
                                            @error('close_sat')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </span>

                                    <span class="form-group row">
                                        <span for="inputBusinessHourSun" class="col-sm-3 col-form-label">Chủ nhật</span>
                                        <div class="col-sm-4">
                                            <input id="open_sun" type="time"
                                                class="form-control @error('open_sun') is-invalid @enderror"
                                                name="open_sun" value="{{ old('open_sun') }}" required autofocus>
                                            @error('open_sun')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-4">
                                            <input id="close_sun" type="time"
                                                class="form-control @error('close_sun') is-invalid @enderror"
                                                name="close_sun" value="{{ old('close_sun') }}" required autofocus>
                                            @error('close_sun')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </span>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="speciality_name">Chuyên khoa</label>
                                    <br>
                                    @error('speciality_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <p>Chọn tất cả
                                        <input type="checkbox"
                                            onclick=" for(c in document.getElementsByName('speciality_name[]')) document.getElementsByName('speciality_id[]').item(c).checked=this.checked">
                                    </p>
                                    <table id="datatable" class="table table-striped" style="width:100%">
                                        @foreach ($speciality as $spe_list)
                                            <tbody>
                                                <tr>
                                                    <td style="background-color: white;"><input type="checkbox"
                                                            name="speciality_name[]" value="{{ $spe_list->speciality_name }}"
                                                            style="width: 10%;"> {{ $spe_list->speciality_name }}</td>
                                                </tr>
                                            </tbody>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel">
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="hospital_desc">Mô tả</label>
                            <textarea type="text" id="hospital_desc" name="hospital_desc" class="form-control ckeditor"></textarea>
                            @error('hospital_desc')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="panel">
                    <div class="panel-body">
                        <div class="form-group col-md-6">
                            <label for="hospital_address">Địa chỉ</label>
                            <input id="hospital_address" type="text"
                                class="form-control @error('hospital_address') is-invalid @enderror"
                                name="hospital_address" value="{{ old('hospital_address') }}" required autofocus>
                            @error('hospital_address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="hospital_city">Tỉnh / Thành phố</label>
                            <input id="hospital_city" type="text"
                                class="form-control @error('hospital_city') is-invalid @enderror" name="hospital_city"
                                value="{{ old('hospital_city') }}" required autofocus>
                            @error('hospital_city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <button type="reset" class="btn btn-outline-secondary btn-block">Xóa</button>
                </div>
                <div class="form-group col-md-6">
                    <button type="submit" class="btn btn-primary btn-block">Tạo</button>
                </div>
            </form>
        </div>
    </div>

    <style type="text/css">
        input[type="checkbox"] {
            zoom: 1.1;
        }

        table,
        p {
            font-size: 15px;
        }

        p {
            margin-left: 80%;
        }

        label {
            font-size: 15px;
        }
    </style>

    <script>
        var openFile = function(file) {
            var input = file.target;

            var reader = new FileReader();
            reader.onload = function() {
                var dataURL = reader.result;
                var output = document.getElementById('output');
                output.src = dataURL;
            };
            reader.readAsDataURL(input.files[0]);
        };
    </script>
@endsection
