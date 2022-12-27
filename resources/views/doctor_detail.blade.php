@extends('layouts.patient_app')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header" style="margin-left: 11%; width: 78%;">
                        <h3>Thông tin bác sĩ</h3>
                    </div>

                    <div class="content">
                        <div class="container">
                            <div class="card">
                                <div class="card-body">
                                    <div class="doctor-widget">
                                        <div class="doc-info-left">
                                            <div class="doctor-img">
                                                <img src="{{URL::to ('public/'.$doctor->doctor_avatar)}}" class="img-fluid" alt="Hình bác sĩ">
                                            </div>
                                            <div class="doc-info-cont">
                                                <h4 class="doc-name">Bác sĩ {{ $doctor->doctor_name }}</h4>
                                                <p class="doc-department">Chuyên khoa: {{ $doctor->speciality_name }}</p>
                                                <div class="clinic-details">
                                                    <p class="doc-location"><i class="fas fa-map-marker-alt"></i> {{ $doctor->user['name'] }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="doc-info-right">
                                            <div class="clinic-booking">
                                                <a class="apt-btn" href="{{URL::to ('book_appointment/'.$doctor->doctor_id)}}">Đặt lịch hẹn</a>
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
                                            <li class="nav-item">
                                                <a class="nav-link" href="#doc_reviews" data-toggle="tab">Đánh giá</a>
                                            </li>
                                        </ul>
                                    </nav>

                                    <div class="tab-content pt-0">
                                        <div role="tabpanel" id="doc_overview" class="tab-pane fade show active">
                                            <div class="row">
                                                <div class="col-md-12 col-lg-9">
                                                    <div class="widget about-widget">
                                                        <h4 class="widget-title">Thông tin</h4>
                                                        <p>{!!$doctor->doctor_desc!!}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div role="tabpanel" id="doc_reviews" class="tab-pane fade">
                                            <form>
                                                @csrf                                               
                                                <div id="review_show"></div>
                                                        <div class="widget review-listing">
                                                            <input type="hidden" name="doctor_id" class="doctor_id" value="{{$doctor->doctor_id}}">
                                                        </div>
                                            </form>

                                            <div class="write-review">
                                                <h4>Viết đánh giá về <strong>Bác sĩ {{ $doctor->doctor_name }}</strong></h4>
                                                <form>
                                                    <div id="notify_review"></div>
                                                    <div class="form-group">
                                                        <label>Tên của bạn</label>
                                                        <input class="form-control review_name" type="text">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Đánh giá của bạn</label>
                                                        <textarea name="review" maxlength="100" class="form-control review_content" rows="4"></textarea>
                                                    </div>
                                                    <div class="submit-section">
                                                        <button style="min-width: 100%" type="button" class="btn btn-primary submit-btn send-review">Đánh giá</button>
                                                    </div>
                                                </form>
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
