@extends('layouts.patient_hospital')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header" style="margin-left: 11%; width: 78%;">
                        <h3>Danh sách bệnh viện</h3>
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
                        @foreach ($user as $user_list)
                            <div class="card">
                                <div class="card-body">
                                    <div class="doctor-widget">
                                        <div class="doc-info-left">
                                            <div class="doctor-img">
                                                <a href="{{ URL::to('hospital_detail/' . $user_list->id) }}">
                                                    <img src="{{ URL::to('public/' . $user_list->hospital->hospital_image) }}"
                                                        class="img-fluid" alt="Hình ảnh bệnh viện">
                                                </a>
                                            </div>
                                            <div class="doc-info-cont">
                                                <h4 class="doc-name"><a
                                                        href="{{ URL::to('hospital_detail/' . $user_list->id) }}">{{ $user_list->hospital->hospital_name }}</a>
                                                </h4>
                                                <br>
                                                <button type="button" class="btn btn-secondary" data-toggle="modal"
                                                    data-target="#exampleModal{{ $user_list->id }}"
                                                    style="margin-top: -10px;">Thông tin</button>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="doc-info-right">
                                            <div class="clinic-booking">
                                                <a class="view-pro-btn"
                                                    href="{{ URL::to('hospital_detail/' . $user_list->id) }}">Xem chi
                                                    tiết</a>
                                                <a class="apt-btn"
                                                    href="{{ URL::to('hospital_speciality/' . $user_list->id) }}">Chọn
                                                    chuyên khoa</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <br>
                        <div class="">
                            {{ $user->appends(request()->all())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
