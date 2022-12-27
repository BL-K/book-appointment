<table id="datatable" class="table" style="width:100%">
    <thead>
        <tr>
            <th>Bệnh nhân</th>
            <th>Ngày sinh</th>
            <th>Giới tính</th>
            <th>Số điện thoại</th>
            <th>Điạ chỉ Email</th>
            <th>Địa chỉ</th>
            <th>Tỉnh / Thành phố</th>
        </tr>
    </thead>
    @foreach ($patient as $pat_list)
        <tbody>
            <tr>
                <td>{{ $pat_list->patient_name }}</td>
                <td>{{ date('d-m-Y', strtotime($pat_list->patient_dob)) }}</td>
                <td>{{ $pat_list->patient_gender }}</td>
                <td>{{ $pat_list->patient_contact }}</td>
                <td>{{ $pat_list->patient_email }}</td>
                <td>{{ $pat_list->patient_address }}</td>
                <td>{{ $pat_list->patient_city }}</td>
            </tr>
        </tbody>
    @endforeach
</table>