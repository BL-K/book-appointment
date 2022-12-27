<table id="datatable" class="table" style="width:100%">
    <thead>
        <tr>
            <th>Bác sĩ</th>
            <th>Bệnh viện</th>
            <th>Chuyên khoa</th>
            <th>Kinh nghiệm</th>
            <th>Số điện thoại</th>
            <th>Địa chỉ Email</th>
            <th>Ngày sinh</th>
            <th>Giới tính</th>
            <th>Địa chỉ</th>
            <th>Tỉnh/Thành phố</th>
        </tr>
    </thead>
    @foreach ($doctor as $doc_list)
        <tbody>
            <tr>
                <td>{{ $doc_list->doctor_name }}</td>
                <td>{{ $doc_list->user['name'] }}</td>
                <td>{{ $doc_list->speciality_name }}</td>
                <td>{{ $doc_list->doctor_experience	 }} năm</td>
                <td>{{ $doc_list->doctor_contact }}</td>
                <td>{{ $doc_list->doctor_email }}</td>
                <td>{{ $doc_list->doctor_dob }}</td>
                <td>{{ $doc_list->doctor_gender }}</td>
                <td>{{ $doc_list->doctor_address }}</td>
                <td>{{ $doc_list->doctor_city }}</td>
            </tr>
        </tbody>
    @endforeach
</table>