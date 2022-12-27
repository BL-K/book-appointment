@extends('layouts.admin_app')

@section('content')
    <h1 class="page-title">Lịch hẹn</h1>
    <hr style="height:2px; background-color:gray;">

    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <h3>Lịch hẹn trong ngày</h3>
                    <a href="{{ URL::to('admin/appointment_day_export')}}" class="btn btn-outline-success" style="margin-left: 80%; margin-top: -5%; background-color: rgb(14, 161, 71); color: white;">File Excel</a>
                    <a href="{{ URL::to('admin/appointment_day_report')}}" class="btn btn-outline-success" style="margin-left: 90%; margin-top: -8.2%; background-color: rgb(232, 71, 71); color: white;">File PDF</a>
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
                                    <th>Bệnh nhân</th>
                                    <th>Số điện thoại</th>
                                    <th>Địa chỉ Email</th>
                                    <th>Ngày</th>
                                    <th>Thời gian</th>
                                    <th>Bệnh viện</th>
                                    <th>Bác sĩ</th>
                                    <th>Chuyên khoa</th>
                                    <th>Xác nhận</th>
                                    <th>Tiếp nhận</th>
                                    <th>Trạng thái</th>
                                    <th>Hoạt động</th>
                                </tr>
                            </thead>
                            @foreach ($appointment_day as $app_list)
                                <tbody>
                                    <tr>
                                        <td>{{ $app_list->patient_name }}</td>
                                        <td>{{ $app_list->patient_contact }}</td>
                                        <td>{{ $app_list->patient_email }}</td>
                                        <td>{{ date('d-m-Y', strtotime($app_list->slot['date'])) }}</td>
                                        <td>{{ $app_list->time }}</td>
                                        <td>{{ $app_list->doctor->user['name'] }}</td>
                                        <td>{{ $app_list->doctor->doctor_name }}</td>
                                        <td>{{ $app_list->doctor->speciality_name }}</td>
                                        <td>                                         
                                            @if ($app_list->confirm === 1)
                                                <span class="badge badge-pill badge-success">Đã xác nhận</span>
                                            @else
                                                <span class="badge badge-pill badge-danger">Chưa xác nhận</span>
                                            @endif
                                        </td>
                                        <td>                                         
                                            @if ($app_list->recevie === 1)
                                                <span class="badge badge-pill badge-success">Đã tiếp nhận</span>
                                            @else
                                                <span class="badge badge-pill badge-danger">Chưa tiếp nhận</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($app_list->status === 1)
                                                <span class="badge badge-pill badge-success">Đã đến</span>
                                            @else
                                                <span class="badge badge-pill badge-danger">Chưa đến / Không đến</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ URL::to('admin/appointment_view/' . $app_list->appointment_id) }}"
                                                class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                                            <a onclick="return confirm('Bạn có muốn xóa cuộc hẹn của bệnh nhận {{$app_list->patient_name}}?');"
                                                href="{{ URL::to('admin/delete_appointment/' . $app_list->appointment_id) }}"
                                                class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            @endforeach
                            <tfoot>
                                <tr>
                                    <th>Bệnh nhân</th>
                                    <th>Số điện thoại</th>
                                    <th>Địa chỉ Email</th>
                                    <th>Ngày</th>
                                    <th>Thời gian</th>
                                    <th>Bệnh viện</th>
                                    <th>Bác sĩ</th>
                                    <th>Chuyên khoa</th>
                                    <th>Xác nhận</th>
                                    <th>Tiếp nhận</th>
                                    <th>Trạng thái</th>
                                    <th>Hoạt động</th>
                                </tr>
                            </tfoot>
                        </table>
                        <br>
                        <div class="">
                            {{ $appointment_day->appends(request()->all())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
