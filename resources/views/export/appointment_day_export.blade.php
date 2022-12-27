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
        </tr>
    </thead>
    @foreach ($appointment_day as $app_list)
        <tbody>
            <tr>
                <td>{{ $app_list->patient_name }}</td>
                <td>{{ $app_list->patient_contact}}</td>
                <td>{{ $app_list->patient_email }}</td>
                <td>{{ date('d-m-Y', strtotime($app_list->slot['date'])) }}</td>
                <td>{{ $app_list->time }}</td>
                <td>{{ $app_list->user['name'] }}</td>
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
                        <span class="badge badge-pill badge-danger">Chưa đến / Không đến</span>
                    @endif
                </td>
            </tr>
        </tbody>
    @endforeach
</table>