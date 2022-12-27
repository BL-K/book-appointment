@extends('layouts.patient_app')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header" style="margin-left: 11%; width: 78%;">
                        <h3>Blog - Nội dung</h3>
                    </div>

                    <div class="content">
                        <div class="container">
                            <div class="card">
                                <div class="card-body">
                                    <div class="doctor-widget">
                                        <div class="doc-info-left">
                                            <div class="doctor-img" style="width: 300px;">
                                                <img src="{{URL::to ('public/' . $blog->blog_image)}}" class="img-fluid" alt="Hình ảnh blog">
                                            </div>
                                            <div class="doc-info-cont">
                                                <h3>{{ $blog->blog_title }}</h3>
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
                                                    data-toggle="tab">Nội dung</a>
                                            </li>
                                        </ul>
                                    </nav>

                                    <div class="tab-content pt-0">
                                        <div role="tabpanel" id="doc_overview" class="tab-pane fade show active">
                                            <div class="row">
                                                <div class="col-md-12 col-lg-9">
                                                    <div class="widget about-widget">
                                                        <h4><p>{!! $blog->blog_content !!}</p></h4>
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
