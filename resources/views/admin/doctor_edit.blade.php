@extends('layouts.admin_app')

@section('content')
    <h1 class="page-title">Cập nhật bác sĩ</h1>
    <hr style="height:2px; background-color:gray;">

    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <form name="regform" method="POST" action="{{ URL::to('admin/update_doctor/' . $doctor->doctor_id) }}"
                enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="panel-heading">
                    <h3>Cập nhật bác sĩ</h3>
                </div>
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
                <br>
                <div class="panel">
                    <div class="panel">
                        <div class="panel-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="user_id">Bệnh viện</label>
                                    <select name="user_id" id="show_user" class="form-control selectpicker"
                                        data-live-search="true">
                                        <option value="0" selected disabled>Chọn bệnh viện</option>
                                        @foreach ($user as $user_list)
                                            <option value="{{ $user_list->id }}">{{ $user_list->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="doctor_name">Họ và tên</label>
                                    <input type="text" name="doctor_name" id="doctor_name"
                                        class="form-control @error('doctor_name') is-invalid @enderror"
                                        value="{{ $doctor->doctor_name }}" required autocomplete="doctor_name">
                                    @error('doctor_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="speciality_name">Chuyên khoa</label>
                                <select name="speciality_name" id="show_speciality" class="form-control selectpicker"
                                    data-live-search="true">
                                    <option value="0" selected disabled>Chọn chuyên khoa</option>
                                    @foreach ($hospital_speciality as $hos_spe_list)
                                        <option value="{{ $hos_spe_list->speciality_name }}">{{ $hos_spe_list->speciality_name }}</option>
                                    @endforeach
                                </select>
                                @error('speciality_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="doctor_experience">Kinh nghiệm</label>
                                <input type="text" name="doctor_experience" id="doctor_experience"
                                    class="form-control @error('doctor_experience') is-invalid @enderror"
                                    value="{{ $doctor->doctor_experience }}" required autocomplete="doctor_experience">
                                @error('doctor_experience')
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
                            <div class="col-sm-4">
                                <label for="doctor_avatar">Hình ảnh bác sĩ</label>
                                <br>
                                <div class="card col-md-3">
                                    <div class="imageupload">
                                        <img src="{{ URL::to('public/' . $doctor->doctor_avatar) }}"
                                            style="width: 445%; height:520%;" id="output" class="img-fluid thumbnail"
                                            alt="Hình ảnh bác sĩ" title="Hình ảnh bác sĩ">
                                        <div class="file-tab" style="width: 290px;">
                                            <input type="file" name="doctor_avatar" id="doctor_avatar"
                                                class="form-control" value="{{ $doctor->doctor_avatar }}" accept="image/*"
                                                onchange="openFile(event)">
                                        </div>
                                        @error('doctor_avatar')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="doctor_dob">Ngày sinh</label>
                                        <input type="date" name="doctor_dob" id="datepicker"
                                            class="form-control @error('doctor_dob') is-invalid @enderror"
                                            value="{{ $doctor->doctor_dob }}" required autocomplete="doctor_dob">
                                        @error('doctor_dob')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="doctor_gender">Giới tính</label>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="doctor_gender" name="doctor_gender"
                                                        class="custom-control-input @error('doctor_dob') is-invalid @enderror"
                                                        value="Nam" @if (old('doctor_gender', $doctor->doctor_gender) == 'Nam') checked @endif>
                                                    <label class="custom-control-label" for="doctor_gender">Nam</label>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="doctor_gender" name="doctor_gender"
                                                        class="custom-control-input @error('doctor_dob') is-invalid @enderror"
                                                        value="Nữ" @if (old('doctor_gender', $doctor->doctor_gender) == 'Nữ') checked @endif>
                                                    <label class="custom-control-label" for="doctor_gender">Nữ</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="doctor_contact">Số điện thoại</label>
                                        <input type="text" name="doctor_contact" id="doctor_contact"
                                            class="form-control @error('doctor_contact') is-invalid @enderror"
                                            value="{{ $doctor->doctor_contact }}" required autocomplete="doctor_contact">
                                        @error('doctor_contact')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="doctor_email">Địa chỉ Email</label>
                                        <input type="text" name="doctor_email" id="doctor_email"
                                            class="form-control @error('doctor_email') is-invalid @enderror"
                                            value="{{ $doctor->doctor_email }}" required autocomplete="doctor_email">
                                        @error('doctor_email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel">
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="doctor_desc">Mô tả</label>
                            <textarea class="form-control ckeditor" id="doctor_desc" name="doctor_desc" rows="10">{{ $doctor->doctor_desc }}</textarea>
                            @error('doctor_desc')
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
                            <label for="doctor_address">Địa chỉ</label>
                            <input id="doctor_address" type="text"
                                class="form-control @error('doctor_address') is-invalid @enderror" name="doctor_address"
                                value="{{ $doctor->doctor_address }}" required autocomplete="doctor_address">
                            @error('doctor_address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="doctor_city">Tỉnh / Thành phố</label>
                            <input id="doctor_city" type="text"
                                class="form-control @error('doctor_city') is-invalid @enderror" name="doctor_city"
                                value="{{ $doctor->doctor_city }}" required autocomplete="doctor_city">
                            @error('doctor_city')
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

                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                <script type="text/javascript">
                    $('#show_user').on('change', function(e) {
                        var user_id = e.target.value;
                        $.get('/admin/show_speciality?id=' + user_id, function(data) {
                            $('#show_speciality').empty();
                            $.each(data, function(index, areaObj) {
                                $('#show_speciality').append(
                                    '<option name="speciality_name" value="' + areaObj
                                    .speciality_name + '">' + areaObj.speciality_name + '</option>'
                                )
                            });
                        });
                    });
                </script>
            </form>
        </div>
    </div>

    <style type="text/css">
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
