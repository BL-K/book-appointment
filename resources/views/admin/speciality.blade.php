@extends('layouts.admin_app')

@section('content')
    <h1 class="page-title">Chuyên khoa</h1>
    <hr style="height:2px; background-color:gray;">

    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel-heading">
                <h3>Tạo chuyên khoa</h3>
            </div>
            <div class="panel">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <br>
                <div class="panel-body">
                    <form name="add_form" class="inline-form" method="POST"
                        action="{{ URL::to('admin/insert_speciality') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="speciality_name" class="col-sm-3 col-form-label text-right">Chuyên khoa</label>
                            <div class="col-sm-6">
                                <input id="speciality_name" type="text"
                                    class="form-control @error('speciality_name') is-invalid @enderror"
                                    name="speciality_name" value="{{ old('speciality_name') }}" required
                                    autocomplete="speciality_name">

                                @error('speciality_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="speciality_icon" class="col-sm-3 col-form-label text-right">Biểu tượng</label>
                            <div class="col-sm-6">
                                <input id="speciality_icon" type="file"
                                    class="form-control @error('speciality_icon') is-invalid @enderror"
                                    name="speciality_icon" value="{{ old('speciality_icon') }}" required
                                    autocomplete="speciality_icon" accept="image/*" onchange="openFile(event)">
                                <script>
                                    var openFile = function(file) {
                                        var input = file.target;

                                        var reader = new FileReader();
                                        reader.onload = function() {
                                            var dataURL = reader.result;
                                            var output = document.getElementById('output');
                                            output.src = dataURL;
                                        };
                                        reader.readAsDataURL(input.files[0]);
                                    };
                                </script>
                                @error('speciality_icon')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row" align="center">
                            <label for="inputIcon" class="col-sm-3 col-form-label text-right"></label>
                            <div class="col-sm-6">
                                <img src="{{ URL::to('admin_hospital/img/icon.png') }}" id="output"
                                    class="img-fluid thumbnail" width="60px" height="60px">
                            </div>
                        </div>
                        <div class="form-group row" style="text-align: center;">
                            <button type="reset" class="btn btn-light btn-sm px-5 mr-2" name="clear">Xóa</button>
                            <button type="submit" class="btn btn-primary btn-sm px-5" name="save">Tạo</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="panel">
                <div class="panel-heading">
                    <h3>Danh sách chuyên khoa</h3>
                </div>
                <form action="" type="get">
                    @csrf
                    <ul class="nav navbar-nav search-nav">
                        <li>
                            <div class="search">
                                <div class="form-group form-animate-text">
                                    <input type="text" id="keyword" name="keyword" class="form-text"
                                        placeholder="Tìm kiếm" required>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <button type="submit" class="btn btn-primary" style="height: 45px"><i
                            class="fas fa-search"></i></button>
                </form>
                <div class="panel-body">
                    <div class="data-tables">
                        <table id="datatable" class="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Biểu tượng</th>
                                    <th>Chuyên khoa</th>
                                    <th>Hoạt động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($speciality as $spe_list)
                                    <tr>
                                        <td><img src="{{ URL::to('public/' . $spe_list->speciality_icon) }}"></td>
                                        <td>{{ $spe_list->speciality_name }}</td>
                                        <td>
                                            <a href="{{ URL::to('admin/speciality_edit/' . $spe_list->speciality_id) }}"
                                                class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                            <a onclick="return confirm('Bạn có muốn xóa chuyên khoa {{$spe_list->speciality_name}}?');"
                                                href="{{ URL::to('admin/delete_speciality/' . $spe_list->speciality_id) }}"
                                                class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Biểu tượng</th>
                                    <th>Chuyên khoa</th>
                                    <th>Hoạt động</th>
                                </tr>
                            </tfoot>
                        </table>
                        <br>
                        <div class="">
                            {{ $speciality->appends(request()->all())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style type="text/css">
        td>img {
            width: 45px;
            height: 45px;
        }
    </style>
@endsection
