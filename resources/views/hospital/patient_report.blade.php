@extends('layouts.hospital_app')

@section('content')
    <h1 class="page-title">Báo cáo bệnh nhân</h1>
    <hr style="height:2px; background-color:gray;">

    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <h3>Báo cáo bệnh nhân</h3>
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
                <div class="panel-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="doctor_dob">Từ ngày</label>
                            <input type="date" name="doctor_dob" id="datepicker" max="{{ date("Y-m-d")}}"
                                class="form-control @error('doctor_dob') is-invalid @enderror"
                                 required autocomplete="doctor_dob">
                            @error('doctor_dob')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="doctor_dob">Đến ngày</label>
                            <input type="date" name="doctor_dob" id="datepicker" max="{{ date("Y-m-d")}}"
                                class="form-control @error('doctor_dob') is-invalid @enderror"
                                 required autocomplete="doctor_dob">
                            @error('doctor_dob')
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
    </div>
@endsection
