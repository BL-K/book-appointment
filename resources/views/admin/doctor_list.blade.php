@extends('layouts.admin_app')

@section('content')
    <h1 class="page-title">Danh sách bác sĩ</h1>
    <hr style="height:2px; background-color:gray;">

    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <h3>Danh sách bác sĩ</h3>
                    <a href="{{ URL::to('admin/doctor_export')}}" class="btn btn-outline-success" style="margin-left: 80%; margin-top: -5%; background-color: rgb(14, 161, 71); color: white;">File Excel</a>
                    <a href="{{ URL::to('admin/doctor_report')}}" class="btn btn-outline-success" style="margin-left: 90%; margin-top: -8.2%; background-color: rgb(232, 71, 71); color: white;">File PDF</a>
                </div>
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
                    <div class="responsive-table">
                        <table id="datatable" class="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Bác sĩ</th>
                                    <th>Bệnh viện</th>
                                    <th>Chuyên khoa</th>
                                    <th>Địa chỉ Email</th>
                                    <th>Hoạt động</th>
                                </tr>
                            </thead>
                            @foreach ($doctor as $doc_list)
                                <tbody>
                                    <tr>
                                        <td>{{ $doc_list->doctor_name }}</td>
                                        <td>{{ $doc_list->user['name'] }}</td>
                                        <td>{{ $doc_list->speciality_name }}</td>
                                        <td>{{ $doc_list->doctor_email }}</td>
                                        <td>
                                            <a href="{{ URL::to('admin/doctor_view/' . $doc_list->doctor_id) }}"
                                                class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                                            <a href="{{ URL::to('admin/doctor_edit/' . $doc_list->doctor_id) }}"
                                                class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                            <a onclick="return confirm('Bạn có muốn xóa bác sĩ {{$doc_list->doctor_name}}?');"
                                                href="{{ URL::to('admin/delete_doctor/' . $doc_list->doctor_id) }}"
                                                class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            @endforeach
                            <tfoot>
                                <tr>
                                    <th>Bác sĩ</th>
                                    <th>Bệnh viện</th>
                                    <th>Chuyên khoa</th>
                                    <th>Địa chỉ Email</th>
                                    <th>Hoạt động</th>
                                </tr>
                            </tfoot>
                        </table>
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
