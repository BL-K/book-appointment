@extends('layouts.hospital_app')

@section('content')
    <h1 class="page-title">Lịch hẹn</h1>
    <hr style="height:2px; background-color:gray;">

    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <h3>Tất cả lịch hẹn</h3>
                    <a href="{{ URL::to('hospital/appointment_export')}}" class="btn btn-outline-success" style="margin-left: 80%; margin-top: -5%; background-color: rgb(14, 161, 71); color: white;">File Excel</a>
                    <a href="{{ URL::to('hospital/appointment_report')}}" class="btn btn-outline-success" style="margin-left: 90%; margin-top: -8.2%; background-color: rgb(232, 71, 71); color: white;">File PDF</a>
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
                                    <th>STT</th>
                                    <th>Bệnh nhân</th>
                                    <th>Số điện thoại</th>
                                    <th>Địa chỉ Email</th>
                                    <th>Ngày</th>
                                    <th>Thời gian</th>
                                    <th>Bác sĩ</th>
                                    <th>Chuyên khoa</th>
                                    <th>Xác nhận</th>
                                    <th>Tiếp nhận</th>
                                    <th>Trạng thái</th>
                                    <th>Hoạt động</th>
                                </tr>
                            </thead>
                            @php $i=1; @endphp
                            @foreach ($appointment as $app_list)
                                <tbody>
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $app_list->patient_name }}</td>
                                        <td>{{ $app_list->patient_contact }}</td>
                                        <td>{{ $app_list->patient_email }}</td>
                                        <td>{{ date('d-m-Y', strtotime($app_list->slot['date'])) }}</td>
                                        <td>{{ $app_list->time }}</td>
                                        <td>{{ $app_list->doctor['doctor_name'] }}</td>
                                        <td>{{ $app_list->doctor->speciality_name }}</td>
                                        <td>
                                            @if ($app_list->confirm === 1)
                                                <span class="badge badge-pill badge-success">Đã xác nhận</span>
                                            @else
                                                <span class="badge badge-pill badge-danger">Chưa xác nhận</span>
                                            @endif
                                        </td>
                                        <td id="btn_receive">
                                            <a href="{{ URL::to('hospital/appointment_receive/' . $app_list->appointment_id) }}">
                                                @if ($app_list->receive === 1)
                                                    <span class="badge badge-pill badge-success">Đã tiếp nhận</span>
                                                @else
                                                    <button
                                                        onclick="return confirm('Bạn có muốn tiếp nhận bệnh nhận {{$app_list->patient_name}}?');"
                                                        class="badge badge-pill badge-danger" type="submit"
                                                        name="save">Chưa tiếp nhận</button>
                                                @endif
                                            </a>
                                        </td>
                                        <td id="btn_status">
                                            <a href="{{ URL::to('hospital/appointment_status/' . $app_list->appointment_id) }}">
                                                @if ($app_list->status === 1)
                                                    <span class="badge badge-pill badge-success">Đã đến</span>
                                                @else
                                                    <button
                                                        onclick="return confirm('Bạn có muốn xác nhận bệnh nhận {{$app_list->patient_name}} đã đến?');"
                                                        class="badge badge-pill badge-danger" type="submit"
                                                        name="save">Chưa đến / Không đến</button>
                                                @endif
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ URL::to('hospital/appointment_view/' . $app_list->appointment_id) }}"
                                                class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                                            {{-- <a onclick="return confirm('Bạn có muốn xóa cuộc hẹn của bệnh nhân {{$app_list->patient_name}}?');"
                                                href="{{ URL::to('hospital/delete_appointment/' . $app_list->appointment_id) }}"
                                                class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a> --}}
                                        </td>
                                    </tr>
                                </tbody>
                            @endforeach
                            <tfoot>
                                <tr>
                                    <th>STT</th>
                                    <th>Bệnh nhân</th>
                                    <th>Số điện thoại</th>
                                    <th>Địa chỉ Email</th>
                                    <th>Ngày</th>
                                    <th>Thời gian</th>
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
                            {{ $appointment->appends(request()->all())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        document.getElementById('btn_receive').addEventListener('click', function handleClick() {
            const initialText = 'Chưa tiếp nhận';

            document.getElementById('btn_receive').innerHTML =
                `<span class="badge badge-pill badge-success">Đã tiếp nhận</span>`;
        });

        document.getElementById('btn_status').addEventListener('click', function handleClick() {
            const initialText = 'Chưa đến';

            document.getElementById('btn_status').innerHTML =
                `<span class="badge badge-pill badge-success">Đã đến</span>`;
        });
    </script>
@endsection
