@extends('layouts.patient_app')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header" style="margin-left: 11%; width: 78%;">
                        <h3>Danh sách chuyên khoa</h3>
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
                    <div class="table-responsive" style="width: 75%; margin-left: auto; margin-right: auto;">
                        @foreach ($speciality as $spe_list)
                            <div class="card">
                                <div class="card-body">
                                    <div class="doctor-widget">
                                        <div class="doc-info-left">
                                            <div class="doctor-img">
                                                <a
                                                    href="{{ URL::to('speciality_doctor', ['doctor_id' => $spe_list->speciality_id]) }}">
                                                    <img src="{{ URL::to('public/' . $spe_list->speciality_icon) }}"
                                                        class="img-fluid" alt="Biểu tượng chuyên khoa" style="width: 80%; height: 80%;">
                                                </a>
                                            </div>
                                            <div class="doc-info-cont" style="margin-left: 20px; margin-top: 20px;">
                                                <h4 class="doc-name"><a
                                                        href="{{ URL::to('speciality_doctor', ['doctor_id' => $spe_list->speciality_name]) }}">{{ $spe_list->speciality_name }}</a>
                                                </h4>
                                            </div>
                                        </div>
                                        <div class="doc-info-right">
                                            <div class="clinic-booking">
                                                <a class="view-pro-btn"
                                                    href="{{ URL::to('speciality_doctor', ['doctor_id' => $spe_list->speciality_name]) }}">Danh
                                                    sách bác sĩ</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <br>
                        <div class="">
                            {{ $speciality->appends(request()->all())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
