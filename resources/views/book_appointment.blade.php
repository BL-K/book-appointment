@extends('layouts.patient_app')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header" style="margin-left: 11%; width: 78%;">
                        <h3>Đặt lịch hẹn</h3>
                    </div>
                    <form name="add_form" action="{{ URL::to('/booking') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="content">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="booking-doc-info">
                                                    <a href="{{ URL::to('doctor_detail/' . $doctor->doctor_id) }}"
                                                        class="booking-doc-img">
                                                        <img src="{{ URL::to('public/' . $doctor->doctor_avatar) }}"
                                                            alt="Hình bác sĩ">
                                                    </a>

                                                    <div class="booking-info">
                                                        <h4><input type="hidden" name="doctor_id" value="{{ $doctor->doctor_id }}">
                                                            <a href="{{ URL::to('doctor_detail/' . $doctor->doctor_id) }}">Bác
                                                                sĩ {{ $doctor->doctor_name }}</a>
                                                            
                                                            <p class="doc-department">Chuyên khoa:
                                                                {{ $doctor->speciality_name }}</p>
                                                        </h4>
                                                        <input type="hidden" name="user_id" value="{{ $doctor->user['id'] }}">
                                                        <p class="text-muted mb-0"><i class="fas fa-map-marker-alt"></i>
                                                            {{ $doctor->user['name'] }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if (session('success'))
                                        <div class="alert alert-success">
                                        {{session('success')}}
                                        </div>
                                        @endif
                                        
                                        @if (session('error'))
                                        <div class="alert alert-danger">
                                            {{session('error')}}
                                        </div>
                                        @endif
                                        <div class="row">
                                            <div class="col-12 col-sm-8 col-md-12 text-sm-right">
                                                <div class="bookingrange btn btn-sm mb-3">
                                                    <span>
                                                        <select name="slot_id" id="show_date"
                                                            class="form-control selectpicker">
                                                            <option value="0" selected disabled>Chọn
                                                                ngày</option>
                                                            @foreach ($slot as $slot_list)
                                                                <option value="{{ $slot_list->slot_id }}">Ngày
                                                                    {{ date('d-m-Y', strtotime($slot_list->date)) }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row" id="show_time">
                                                    <div class="col-md-12">
                                                        <h3 style="text-align: center;">Vui lòng chọn ngày và thời gian</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="info-widget">
                                            <h4 class="card-title">Thông tin bệnh nhân</h4>
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group card-label">
                                                        <label>Họ và tên</label>
                                                        <input type="text" name="patient_name" id="patient_name"
                                                            class="form-control @error('patient_name') is-invalid @enderror"
                                                            value="{{ old('patient_name') }}" required
                                                            autocomplete="patient_name">
                                                        @error('patient_name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group card-label">
                                                        <label>Giới tính</label>
                                                        <p>
                                                        <div class="row">
                                                            <div class="col-md-6 col-sm-12">
                                                                <div>
                                                                    <input type="radio" id="patient_gender"
                                                                        name="patient_gender" value="Nam">
                                                                    <label for="patient_gender">Nam</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-sm-12">
                                                                <div>
                                                                    <input type="radio" id="patient_gender"
                                                                        name="patient_gender" value="Nữ">
                                                                    <label for="patient_gender">Nữ</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </p>
                                                    </div>
                                                    @error('patient_gender')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <div class="form-group card-label">
                                                        <label>Ngày sinh</label>
                                                        <input type="date" name="patient_dob" id="datepicker"
                                                            max="{{ date('Y-m-d') }}"
                                                            class="form-control @error('patient_dob') is-invalid @enderror"
                                                            value="{{ old('patient_dob') }}" required
                                                            autocomplete="patient_dob">
                                                        @error('patient_dob')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <div class="form-group card-label">
                                                        <label>Số điện thoại</label>
                                                        <input type="tel" name="patient_contact" id="patient_contact"
                                                            class="form-control @error('patient_contact') is-invalid @enderror"
                                                            value="{{ old('patient_contact') }}" required
                                                            autocomplete="patient_contact">
                                                        @error('patient_contact')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <div class="form-group card-label">
                                                        <label>Địa chỉ Email</label>
                                                        <input type="text" name="patient_email" id="datepicker"
                                                            max="{{ date('Y-m-d') }}"
                                                            class="form-control @error('patient_email') is-invalid @enderror"
                                                            value="{{ old('patient_email') }}" required
                                                            autocomplete="patient_email">
                                                        @error('patient_email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group card-label">
                                                        <label>Địa chỉ</label>
                                                        <input id="patient_address" type="text"
                                                            class="form-control @error('patient_address') is-invalid @enderror"
                                                            name="patient_address" value="{{ old('patient_address') }}"
                                                            required autocomplete="patient_address">
                                                        @error('patient_address')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group card-label">
                                                        <label>Tỉnh / Thành phố</label>
                                                        <input id="patient_city" type="text"
                                                            class="form-control @error('patient_city') is-invalid @enderror"
                                                            name="patient_city" value="{{ old('patient_city') }}"
                                                            required autocomplete="patient_city">
                                                        @error('patient_city')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="form-group card-label">
                                                        <label>Lý do khám</label>
                                                        <textarea class="form-control" type="text" name="reason" rows="5"></textarea>
                                                        @error('reason')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Bệnh án (Nếu có)</label>
                                                        <input id="medical_record" type="file"
                                                            class="form-control @error('medical_record') is-invalid @enderror"
                                                            name="medical_record[]" accept="image/*" multiple>
                                                        @error('medical_record')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="submit-section mt-2">
                                                <button style="min-width: 100%" type="submit"
                                                    class="btn btn-primary submit-btn" name="save">Đặt lịch hẹn</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                        <script>
                            $('#show_date').on('change', function(e) {
                                var slot_id = e.target.value;
                                $.get('/show_time?slot_id=' + slot_id, function(data) {
                                    $('#show_time').empty();
                                    $.each(data, function(index, areaObj) {
                                        $('#show_time').append(
                                            '<div class="col-sm-4"><label class="btn btn-outline-secondary btn-block"><input type="radio" name="time" value="'+ areaObj.time +'"> <span>' +
                                            areaObj.time + '</span></label>@error('time')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror</div>'
                                            )
                                    });
                                });
                            });
                        </script>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style type="text/css">
        button {
            size: 16px;
        }
        
        strong {
            margin-left: 450px;
            font-size: 20px;
        }
    </style>
@endsection
