@extends('layouts.patient_app')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div style="text-align: center;">
                        <h2>Hợp tác với Medical Register</h2>
                        <h4>Medical Register rất hân hạnh được hợp tác với các bác sĩ và cơ sở y tế. Vui lòng gửi thông tin,
                            chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất.</h4>
                    </div>
                    <br><br>
                    @if (session('success'))
                        <div class="alert alert-success" align="center">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger" align="center">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form name="regform" method="POST" action="{{ URL::to('send_cooperation') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="panel" style="margin-left: 20%;">
                            <div class="panel-body">
                                <div class="form-group col-md-6">
                                    <label for="hospital_name">Bệnh viện</label>
                                    <input id="hospital_name" type="text"
                                        class="form-control @error('hospital_name') is-invalid @enderror"
                                        name="hospital_name" value="{{ old('hospital_name') }}" required
                                        autocomplete="hospital_name">
                                    @error('hospital_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="person_name">Người liên hệ</label>
                                    <input id="person_name" type="text"
                                        class="form-control @error('person_name') is-invalid @enderror" name="person_name"
                                        value="{{ old('person_name') }}" required autocomplete="person_name">
                                    @error('person_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="person_contact">Số điện thoại</label>
                                    <input id="person_contact" type="tel"
                                        class="form-control @error('person_contact') is-invalid @enderror"
                                        name="person_contact" value="{{ old('person_contact') }}" required
                                        autocomplete="person_contact">
                                    @error('person_contact')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="person_email">Địa chỉ Email</label>
                                    <input id="person_email" type="email"
                                        class="form-control @error('person_email') is-invalid @enderror" name="person_email"
                                        value="{{ old('person_email') }}" required autocomplete="person_email">
                                    @error('person_email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-8">
                                    <label for="hospital_address">Địa chỉ</label>
                                    <input id="hospital_address" type="text"
                                        class="form-control @error('hospital_address') is-invalid @enderror" name="hospital_address"
                                        value="{{ old('hospital_address') }}" required autocomplete="hospital_address">
                                    @error('hospital_address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-8">
                                    <label for="cooperation_content">Nội dung</label>
                                    <textarea class="form-control" id="cooperation_content" name="cooperation_content" rows="7"></textarea>
                                    @error('cooperation_content')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-8">
                                    <button type="submit" class="btn btn-primary btn-block" name="save">Gửi yêu
                                        cầu</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
