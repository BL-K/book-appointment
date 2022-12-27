@extends('layouts.patient_doctor')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header" style="margin-left: 11%; width: 78%;">
                        <h3>Danh sách bác sĩ chuyên khoa bệnh viện {{$user->name}}</h3>
                        <form action="" type="get">
                            @csrf
                            <ul class="nav navbar-nav search-nav">
                                <li>
                                    <div class="search">
                                        <input type="text" id="keyword" name="keyword" class="form-control"
                                            placeholder="Tìm kiếm" required style="width: 40%;">
                                            <button type="submit" class="btn btn-primary"
                                            style="margin-left: 40.5%; margin-top: -67px; width: 45px; height: 44px;"><i class="fas fa-search"></i></button>
                                    </div>
                                </li>
                            </ul>
                        </form>
                    </div>
                    <div class="responsive-table" style="width: 75%; margin-left: auto; margin-right: auto;">
                        @foreach ($doctor as $doc_list)
                            <div class="card">
                                <div class="card-body">
                                    <div class="doctor-widget">
                                        <div class="doc-info-left">
                                            <div class="doctor-img">
                                                <a href="{{ URL::to('doctor_detail/' . $doc_list->doctor_id) }}">
                                                    <img src="{{ URL::to('public/' . $doc_list->doctor_avatar) }}"
                                                        class="img-fluid" alt="Hình bác sĩ">
                                                </a>
                                            </div>
                                            <div class="doc-info-cont" style="margin-left: 30px;">
                                                <h4 class="doc-name"><a
                                                        href="{{ URL::to('doctor_detail/' . $doc_list->doctor_id) }}">Bác sĩ
                                                        {{ $doc_list->doctor_name }}</a></h4>
                                                <p class="doc-department">Chuyên khoa:
                                                    {{ $doc_list->speciality_name }}</p>
                                                <div class="clinic-details">
                                                    <p class="doc-location"><i class="fas fa-map-marker-alt"></i>
                                                        {{ $doc_list->user['name'] }}</p>
                                                    <button type="button" class="btn btn-secondary" data-toggle="modal"
                                                        data-target="#exampleModal{{ $doc_list->doctor_id }}">Thông tin</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="doc-info-right">
                                            <div class="clinic-booking">
                                                <a class="view-pro-btn"
                                                    href="{{ URL::to('doctor_detail/' . $doc_list->doctor_id) }}">Xem chi
                                                    tiết</a>
                                                <a class="apt-btn"
                                                    href="{{ URL::to('book_appointment/' . $doc_list->doctor_id) }}">Đặt lịch
                                                    hẹn</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <br>
                        <div class="">
                            {{ $doctor->appends(request()->all())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
