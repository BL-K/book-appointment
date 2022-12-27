@extends('layouts.admin_app')

@section('content')
    <h1 class="page-title">Thông tin bệnh viện</h1>
    <hr style="height:2px; background-color:gray;">

    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel-heading">
                <h3>Bệnh viện</h3>
            </div>
            <div class="panel">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-8">
                            <div class="owl-carousel">
                                <img src="{{ URL::to('public/' . $user->hospital->hospital_image) }}"
                                    style="width: 350px; heiht: 450px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel">
                <div class="panel-body">
                    <div class="form-group">
                        <h4>Thông tin</h4>
                        <hr>
                        <div class="row">
                            <div class="col-sm-6">
                                <h4 class="mb-2 font-weight-bold">
                                    <p><span class="badge badge-pill badge-dark"
                                            style="font-size: 20px;">{{ $user->name }}</span></p>
                                    <p><i class="far fa-envelope fa-fw mr-1"></i> {{ $user->email }}</p>
                                    <p><i class="fas fa-phone fa-fw mr-1"></i> {{ $user->hospital->hospital_contact }}</p>
                                    <p><i class="fas fa-link fa-fw mr-1"></i> {{ $user->hospital->hospital_url }}</p>
                                </h4>
                                <h4><i class="far fa-clock fa-fw mr-1 mb-2"></i> Thời gian làm việc
                                    <br>
                                    <br class="col-xs-2"><span class="badge badge-info px-3 py-1">Thứ hai - Thứ sáu</span>
                                    <br><br>
                                    {{ date('H:i', strtotime($user->hospital->open_week)) }} --
                                    {{ date('H:i', strtotime($user->hospital->close_week)) }}
                                    <br>
                                    <br class="col-xs-2"><span class="badge badge-info px-3 py-1">Thứ bảy</span>
                                    <br><br>
                                    {{ date('H:i', strtotime($user->hospital->open_sat)) }} --
                                    {{ date('H:i', strtotime($user->hospital->close_sat)) }}
                                    <br>
                                    <br class="col-xs-2"><span class="badge badge-info px-3 py-1">Chủ nhật</span>
                                    <br><br>
                                    {{ date('H:i', strtotime($user->hospital->open_sun)) }} --
                                    {{ date('H:i', strtotime($user->hospital->close_sun)) }}
                                </h4>
                                <br>
                                <h4>
                                    <div id="map"><iframe
                                        src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAGx-OjyNn10KsJ_OsE7cl2_qxg6mNBZyI&q='{{ $user->hospital->hospital_address }}+{{ $user->hospital->hospital_city }}'"
                                        width="100%" height="100%" frameborder="0" style="border:0"
                                        allowfullscreen></iframe>
                                    </div>
                                    <br>
                                    <p class="mb-2"><i class="fas fa-map-marker-alt fa-fw"></i>
                                        {{ $user->hospital->hospital_address }}, {{ $user->hospital->hospital_city }}
                                    </p>
                                </h4>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <h4>Chuyên khoa</h4>
                                    <table id="datatable" class="table table-striped" style="width: 100%;">
                                        @foreach ($hospital_speciality as $hos_spe_list)
                                            <tbody>                
                                                <th>{{ $hos_spe_list->speciality_name }}</th>
                                            </tbody>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel">
                <div class="panel-body">
                    <div class="form-group">
                        <h4>Mô tả</h4>
                        <textarea class="form-control" id="hospital_desc" name="hospital_desc" rows="7">{{ strip_tags($user->hospital->hospital_desc) }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style type="text/css">
        td {
            background-color: white;
            font-size: 17px;
        }

        td>img {
            width: 30px;
            height: 30px;
        }
    </style>
@endsection
