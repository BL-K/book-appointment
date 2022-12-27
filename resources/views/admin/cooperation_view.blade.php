@extends('layouts.admin_app')

@section('content')
    <h1 class="page-title">Thông tin hợp tác</h1>
    <hr style="height:2px; background-color:gray;">

    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel-heading">
                <h3>Thông tin</h3>
            </div>

            <div class="panel">
                <div class="panel-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <h4 class="mb-2 font-weight-bold">
                                    <p><i class="fa-solid fa-hospital"></i> {{ $cooperation->hospital_name }}</p>
                                    <p><i class="fas fa-user fa-fw mr-3"></i> {{ $cooperation->person_name }}</p>
                                    <p><i class="fas fa-phone-alt fa-fw mr-3"></i> {{ $cooperation->person_contact }}</p>
                                    <p><i class="far fa-envelope fa-fw mr-3"></i> {{ $cooperation->person_email }}</p>
                                </h4>
                            </div>
                            <div class="col-sm-6">
                                <h5>
                                    <p class="mb-2"><i class="fas fa-map-marker-alt fa-fw"></i>
                                        {{ $cooperation->hospital_address }}
                                    </p>
                                </h5>
                                <div id="map"><iframe
                                        src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAGx-OjyNn10KsJ_OsE7cl2_qxg6mNBZyI&q='{{ $cooperation->address }}'"
                                        width="450" height="350" frameborder="0" style="border:0"
                                        allowfullscreen></iframe></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel">
                <div class="panel-body">
                    <div class="form-group">
                        <h4>Nội dung</h4>
                        <textarea class="form-control" id="cooperation_content" name="cooperation_content" rows="7">{{ strip_tags($cooperation->cooperation_content) }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
