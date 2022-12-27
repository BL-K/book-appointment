@extends('layouts.hospital_app')

@section('content')
    <h1 class="page-title">Thông tin lịch hẹn</h1>
    <hr style="height:2px; background-color:gray;">

    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel-heading">
                <h3>Thông tin lịch hẹn</h3>
            </div>
            <div class="panel">
                <div class="panel-body">
                    <div class="form-group">
                        <h4>Thông tin</h4>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h4 class="mb-2 font-weight-bold">
                                    <p><i class="fa-solid fa-hospital-user"></i> Bệnh nhân:
                                        {{ $appointment->patient_name }}</p>
                                    <p><i class="fas fa-phone-alt fa-fw mr-3"></i>
                                        {{ $appointment->patient_contact }}</p>
                                    <p><i class="far fa-envelope fa-fw mr-3"></i>
                                        {{ $appointment->patient_email }}</p>
                                </h4>
                            </div>
                            <div class="col-sm-3">
                                <h4>
                                    <p><i class="fa-solid fa-user-doctor"></i> Bác sĩ:
                                        {{ $appointment->doctor_name }}</p>
                                    <p><i class="fa-solid fa-book-medical"></i> Chuyên khoa:
                                        {{ $appointment->doctor->speciality_name }}</p>
                                </h4>
                            </div>
                            <div class="col-sm-3">
                                <h4 class="mb-2 font-weight-bold">
                                    <p><i class="fa-solid fa-calendar-days"></i> Ngày:
                                        {{ date('d-m-Y', strtotime($appointment->slot->date)) }}</p>
                                    <p><i class="fa-solid fa-clock"></i> Thời gian: {{ $appointment->time }}</p>
                                </h4>
                            </div>
                            <div class="col-sm-3">
                                <h4>
                                    <p><i class="fa-solid fa-check"></i>
                                        @if ($appointment->confirm === 1)
                                            <span class="badge badge-success">Đã xác nhận</span>
                                        @else
                                            <span class="badge badge-danger">Chưa xác nhận</span>
                                        @endif
                                    </p>
                                    <p><i class="fa-sharp fa-solid fa-check-double"></i>
                                        @if ($appointment->receive === 1)
                                            <span class="badge badge-success">Đã tiếp nhận</span>
                                        @else
                                            <span class="badge badge-danger">Chưa tiếp nhận</span>
                                        @endif
                                    </p>
                                    <p><i class="fa-solid fa-calendar-check"></i>
                                        @if ($appointment->status === 1)
                                            <span class="badge badge-success">Đã đến</span>
                                        @else
                                            <span class="badge badge-danger">Chưa đến / Không đến</span>
                                        @endif
                                    </p>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel">
                <div class="panel-body">
                    <div class="form-group">
                        <h4>Lý do khám</h4>
                        <textarea class="form-control" id="reason" name="reason" rows="10">{{ strip_tags($appointment->reason) }}</textarea>
                    </div>
                </div>
            </div>

            <div class="panel">
                <div class="panel-body">
                    <div class="form-group">
                        <h4>Bệnh án</h4>
                        @foreach ($medical_record as $med_rec_list)
                            <div class="col-md-3">
                                <div class="card bd-secondary mb-3">
                                    <div class="card-body">
                                        <img src="/public/medical_record/{{$med_rec_list->medical_record}}" class="img-fluid thumbnail"  style="width: 25rem; height: 40rem;">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
