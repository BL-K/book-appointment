@extends('layouts.admin_app')

@section('content')
    <h1 class="page-title">Thông tin bác sĩ</h1>
    <hr style="height:2px; background-color:gray;">

    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel-heading">
                <h3>Thông tin</h3>
            </div>
            <div class="panel">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="owl-carousel">
                                <img src="{{ URL::to('public/' . $doctor->doctor_avatar) }}" alt=""
                                    style="width: 300px; height: 350px;">
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <h3 class="font-weight-bold mb-2">Bác sĩ {{ $doctor->doctor_name }}</h3>
                            <h4>
                                <p>
                                    Bệnh viện: {{ $doctor->user['name'] }}
                                </p>
                                <p>
                                    Chuyên khoa: {{ $doctor->speciality_name }}
                                </p>

                                <p><i class="fas fa-vote-yea fa-fw mr-3"></i> {{ $doctor->doctor_experience }} Năm Kinh
                                    Nghiệm</p>
                                <p><i class="fas fa-phone-alt fa-fw mr-3"></i> {{ $doctor->doctor_contact }}</p>
                                <p><i class="far fa-envelope fa-fw mr-3"></i> {{ $doctor->doctor_email }}</p>
                                <p><i class="far fa-calendar fa-fw mr-3"></i> {{date('d-m-Y', strtotime($doctor->doctor_dob))}}</p>
                                <p><i class="fas fa-venus-mars fa-fw mr-3"></i> {{ $doctor->doctor_gender }}</p>
                                <p class="mb-2"><i class="fas fa-map-marker-alt fa-fw"></i>
                                    {{ $doctor->doctor_address }}, {{ $doctor->doctor_city }}
                                </p>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel">
                <div class="panel-body">
                    <div class="form-group">
                        <h4>Mô tả</h4>
                        <textarea class="form-control" id="hospital_desc" name="hospital_desc" rows="7">{{ strip_tags($doctor->doctor_desc) }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


