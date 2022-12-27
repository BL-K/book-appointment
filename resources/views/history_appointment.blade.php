@extends('layouts.patient_app')

@section('content')
    <section class="section">
        <div class="container-fluid">
            <div class="banner-header text-center">
                <h1 style="margin-top: 100px;">Lịch sử đặt lịch hẹn của bạn</h1>
                <br>
                <table id="datatable" class="table" style="width: 75%; margin-left: auto; margin-right: auto;">
                    <thead>
                        <tr>
                            <th>Bệnh viện</th>
                            <th>Bác sĩ</th>
                            <th>Chuyên khoa</th>
                            <th>Ngày</th>
                            <th>Giờ</th>
                            <th>Xác nhận</th>
                            <th>Tiếp nhận</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    @foreach ($appointment as $app_list)
                        <tbody>
                                <td>{{ $app_list->user['name'] }}</td>
                                <td>{{ $app_list->doctor['doctor_name'] }}</td>
                                <td>{{ $app_list->doctor->speciality_name }}</td>
                                <td>{{ date('d-m-Y', strtotime($app_list->slot['date'])) }}</td>
                                <td>{{ $app_list->time }}</td>
                                <td>
                                    @if ($app_list->confirm === 1)
                                        <span class="badge badge-pill badge-success">Đã xác nhận</span>
                                    @else
                                        <span class="badge badge-pill badge-danger">Chưa xác nhận</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($app_list->receive === 1)
                                        <span class="badge badge-pill badge-success">Đã tiếp nhận</span>
                                    @else
                                        <span class="badge badge-pill badge-danger">Chưa tiếp nhận</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($app_list->status === 1)
                                        <span class="badge badge-pill badge-success">Đã đến</span>
                                    @else
                                        <span class="badge badge-pill badge-danger">Chưa đến</span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </section>
    <br>
@endsection
