<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: DejaVu Sans !important;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>

<body>

    <h1 style="text-align: center;">Tất cả lịch hẹn</h1>
    <br>
    <table>
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
            </tr>
        </thead>
        @foreach ($appointment as $app_list)
            <tbody>
                <tr>
                    <td>{{ $app_list->patient_name }}</td>
                    <td>{{ $app_list->patient_contact }}</td>
                    <td>{{ $app_list->patient_email }}</td>
                    <td>{{ date('d-m-Y', strtotime($app_list->slot['date'])) }}</td>
                    <td>{{ $app_list->time }}</td>
                    <td>{{ $app_list->user['name']}}</td>
                    <td>{{ $app_list->doctor['doctor_name'] }}</td>
                    <td>{{ $app_list->doctor->speciality_name }}</td>
                    <td>
                        @if ($app_list->confirm === 1)
                            <span>Đã xác nhận</span>
                        @else
                            <span>Chưa xác nhận</span>
                        @endif
                    </td>
                    <td>
                        @if ($app_list->receive === 1)
                            <span>Đã tiếp nhận</span>
                        @else
                            <span>Chưa tiếp nhận</span>
                        @endif
                    </td>
                    <td>
                        @if ($app_list->status === 1)
                            <span>Đã đến</span>
                        @else
                            <span>Chưa đến / Không đến</span>
                        @endif
                    </td>
                </tr>
            </tbody>
        @endforeach
    </table>
    <br>
    <div style="margin-right: 60%;">
        <table>
            <tr>
                <th>
                    <ul>Tổng lịch hẹn</ul>
                    <ul>Đã đến</ul>
                    <ul>Chưa đến / Không đến</ul>
                </th>
                <th>
                    <ul>{{ $appointment->count() }}</ul>
                    <ul>{{ $arrived->count() }}</ul>
                    <ul>{{ $not_arrived->count() }}</ul>
                </th>
            </tr>
        </table>
    </div>
</body>

</html>
