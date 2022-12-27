@extends('layouts.patient_app')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header" style="margin-left: 11%; width: 78%;">
                        <h3>Thông tin bệnh viện</h3>
                    </div>

                    <div class="content">
                        <div class="container">
                            <div class="card">
                                <div class="card-body">
                                    <div class="doctor-widget">
                                        <div class="doc-info-left">
                                            <div class="doctor-img">
                                                <img src="{{URL::to ('public/'.$user->hospital->hospital_image)}}" class="img-fluid" alt="Hình bệnh viện">
                                            </div>
                                            <div class="doc-info-cont">
                                                <h4 class="doc-name">{{ $user->name }}</h4>
                                                <br>
                                                <div class="clinic-details">
                                                    <p class="doc-location"><i class="fas fa-phone-alt fa-fw mr-2"></i>{{ $user->hospital->hospital_contact }}</p>
                                                    <p class="doc-location"><i class="far fa-envelope fa-fw mr-2"></i>{{ $user->hospital->hospital_email }}</p>
                                                    <p class="doc-location"><i class="fas fa-map-marker-alt fa-fw mr-2"></i>{{ $user->hospital->hospital_address }} {{$user->hospital->hospital_city}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="doc-info-right">
                                            <div class="clinic-booking">
                                                <a class="apt-btn" href="{{URL::to ('hospital_speciality/'. $user->id)}}">Chọn chuyên khoa</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body pt-0">
                                    <nav class="user-tabs mb-4">
                                        <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                                            <li class="nav-item">
                                                <a class="nav-link active" href="#doc_overview"
                                                    data-toggle="tab">Tổng quan</a>
                                            </li>
                                        </ul>
                                    </nav>

                                    <div class="tab-content pt-0">
                                        <div role="tabpanel" id="doc_overview" class="tab-pane fade show active">
                                            <div class="row">
                                                <div class="col-md-12 col-lg-9">

                                                    <div class="widget about-widget">
                                                        <h4 class="widget-title">Thông tin</h4>
                                                        <p>{!!$user->hospital->hospital_desc!!}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
