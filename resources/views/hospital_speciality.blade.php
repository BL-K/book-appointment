@extends('layouts.patient_app')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header" style="margin-left: 11%; width: 78%;">
                        <h3>Danh sách chuyên khoa {{ $user->name }}</h3>
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
                        @foreach ($hospital_speciality as $hos_spe_list)
                            <div class="card">
                                <div class="card-body">
                                    <div class="doctor-widget">
                                        <div class="doc-info-left" style="margin-left: 5%;">
                                            <div class="doc-info-cont">
                                                <h4 class="doc-name"><a
                                                        href="{{ url('hospital_speciality_doctor', [$hos_spe_list->user_id, $hos_spe_list->speciality_name]) }}">{{ $hos_spe_list->speciality_name }}</a>
                                                </h4>
                                            </div>
                                        </div>
                                        <div class="doc-info-right">
                                            <div class="clinic-booking">
                                                <a class="view-pro-btn"
                                                href="{{ url('hospital_speciality_doctor', [$hos_spe_list->user_id, $hos_spe_list->speciality_name]) }}">Danh
                                                    sách bác sĩ</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <br>
                        <div class="">
                            {{$hospital_speciality->appends(request()->all())->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
