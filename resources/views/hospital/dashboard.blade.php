@extends('layouts.hospital_app')

@section('content')
    <h1 class="page-title">Bảng điều khiển</h1>
    <hr style="height:2px; background-color:gray;">

    <div class="col-md-12">
        <div class="col-md-6">
            <div class="panel box-v1">
                <div class="panel-heading bg-orange border-none">
                    <div class="col-md-6 col-sm-6 col-xs-6 text-left padding-0">
                        <h4 class="text-left">Tổng bác sĩ</h4>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                        <h4>
                            <span class="fa-solid fa-user-doctor"></span>
                        </h4>
                    </div>
                </div>
                <div class="panel-body text-center">
                    <h1>{{ $doctor->count() }}</h1>
                    <hr/>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel box-v1">
                <div class="panel-heading bg-blue border-none">
                    <div class="col-md-6 col-sm-6 col-xs-6 text-left padding-0">
                        <h4 class="text-left">Tổng bệnh nhân</h4>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                        <h4>
                            <span class="fa-solid fa-hospital-user"></span>
                        </h4>
                    </div>
                </div>
                <div class="panel-body text-center">
                    <h1>{{ $patient->count() }}</h1>
                    <hr/>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="col-md-6">
            <div class="panel box-v1">
                <div class="panel-heading bg-red border-none">
                    <div class="col-md-6 col-sm-6 col-xs-6 text-left padding-0">
                        <h4 class="text-left">Tổng lịch hẹn</h4>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                        <h4>
                            <span class="fa-solid fa-calendar-check"></span>
                        </h4>
                    </div>
                </div>
                <div class="panel-body text-center">
                    <h1>{{ $appointment->count() }}</h1>
                    <hr/>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel box-v1">
                <div class="panel-heading bg-pink border-none">
                    <div class="col-md-6 col-sm-6 col-xs-6 text-left padding-0">
                        <h4 class="text-left">Lịch hẹn trong ngày</h4>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                        <h4>
                            <span class="fa-regular fa-calendar-check"></span>
                        </h4>
                    </div>
                </div>
                <div class="panel-body text-center">
                    <h1>{{ $appointment_day->count() }}</h1>
                    <hr/>
                </div>
            </div>
        </div>
    </div>
@endsection
