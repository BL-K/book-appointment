@extends('layouts.hospital_app')

@section('content')
    <h1 class="page-title">Thông tin bệnh viện</h1>
    <hr style="height:2px; background-color:gray;">

    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <form name="add_form" method="POST"
                action="{{ URL::to('hospital/hospital_profile_edit/' . $user->id) }}"
                enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="panel-heading">
                    <h3>Cập nhật thông tin</h3>
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
                        <div class="form-group row">
                            <div class="form-group col-md-6">
                                <label for="name">Bệnh viện</label>
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ $user->name }}" required disabled>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Địa chỉ Email</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ $user->email }}" required disabled>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="hospital_contact">Số điện thoại</label>
                                <input id="hospital_contact" type="tel"
                                    class="form-control @error('hospital_contact') is-invalid @enderror"
                                    name="hospital_contact" value="{{ $user->hospital->hospital_contact }}" required
                                    autofocus>
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
                                    value="{{ $user->hospital->hospital_url }}" required 
                                    autofocus>
                                @error('hospital_url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="hospital_image">Hình ảnh bệnh viện</label>
                                <br>
                                <div class="col-md-4">
                                    <div class="imageupload">
                                        <img src="{{ URL::to('public/' . $user->hospital->hospital_image) }}"
                                            style="width: 300%; height:300%;" id="output" class="img-fluid thumbnail"
                                            alt="Hospital-Image" title="Hospital-Image">
                                        <div class="col-sm-6" style="width:350px">
                                            <input id="hospital_image" type="file" class="form-control"
                                                name="hospital_image" value="{{ $user->hospital->hospital_image }}"
                                                accept="image/*" onchange="openFile(event)">
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
                                        <label for="inputBusinessHourWeek" class="col-sm-3 col-form-label">Thứ hai - Thứ
                                            sáu</label>
                                        <div class="col-sm-4">
                                            <input id="open_week" type="time"
                                                class="form-control @error('open_week') is-invalid @enderror"
                                                name="open_week" value="{{ $user->hospital->open_week }}" required autofocus>
                                            @error('open_week')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-4">
                                            <input id="close_week" type="time"
                                                class="form-control @error('close_week') is-invalid @enderror"
                                                name="close_week" value="{{ $user->hospital->close_week }}" required autofocus>
                                            @error('close_week')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </span>
                                    <span class="form-group row">
                                        <label for="inputBusinessHourSat" class="col-sm-3 col-form-label">Thứ bảy</label>
                                        <div class="col-sm-4">
                                            <input id="open_sat" type="time"
                                                class="form-control @error('open_sat') is-invalid @enderror"
                                                name="open_sat" value="{{ $user->hospital->open_sat }}" required autofocus>
                                            @error('open_sat')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-4">
                                            <input id="close_sat" type="time"
                                                class="form-control @error('close_sat') is-invalid @enderror"
                                                name="close_sat" value="{{ $user->hospital->close_sat }}" required autofocus>
                                            @error('close_sat')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </span>

                                    <span class="form-group row">
                                        <label for="inputBusinessHourSun" class="col-sm-3 col-form-label">Chủ nhật</label>
                                        <div class="col-sm-4">
                                            <input id="open_sun" type="time"
                                                class="form-control @error('open_sun') is-invalid @enderror"
                                                name="open_sun" value="{{ $user->hospital->open_sun }}" required autofocus>
                                            @error('open_sun')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-4">
                                            <input id="close_sun" type="time"
                                                class="form-control @error('close_sun') is-invalid @enderror"
                                                name="close_sun" value="{{ $user->hospital->close_sun }}" required autofocus>
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
                                            onclick=" for(c in document.getElementsByName('speciality_name[]')) document.getElementsByName('speciality_name[]').item(c).checked=this.checked">
                                    </p>
                                    <table id="datatable" class="table table-striped" style="width:100%">
                                        @foreach ($speciality as $spe_list)
                                            <tbody>
                                                <tr>
                                                    <td style="background-color: white;">
                                                        <input type="checkbox" name="speciality_name[]" style="width: 10%;" value="{{ $spe_list->speciality_name }}"
                                                            @if (isset($hospital_speciality))
                                                                {{ $hospital_speciality->contains('speciality_name', $spe_list->speciality_name) ? 'checked' : '' }}
                                                            @endif>
                                                            {{ $spe_list->speciality_name }}
                                                    </td>
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
                            <textarea id="hospital_desc" name="hospital_desc" class="form-control ckeditor"> {{ $user->hospital->hospital_desc }}</textarea>
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
                                name="hospital_address" value="{{ $user->hospital->hospital_address }}" required
                                autofocus>
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
                                value="{{ $user->hospital->hospital_city }}" required autofocus>
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
                    <button type="submit" class="btn btn-primary btn-block" name="save">Cập nhật</button>
                </div>
        </div>
        </form>
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
