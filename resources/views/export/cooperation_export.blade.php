<table id="datatable" class="table" style="width:100%">
    <thead>
        <tr>
            <th>Bệnh viện</th>
            <th>Người liên hệ</th>
            <th>Số điện thoại</th>
            <th>Địa chỉ Email</th>
            <th>Địa chỉ</th>
        </tr>
    </thead>
    @foreach ($cooperation as $coop_list)
        <tbody>
            <tr>
                <td>{{ $coop_list->hospital_name }}</td>
                <td>{{ $coop_list->person_name }}</td>
                <td>{{ $coop_list->person_contact }}</td>
                <td>{{ $coop_list->person_email }}</td>
                <td>{{ $coop_list->hospital_address }}</td>
            </tr>
        </tbody>
    @endforeach
</table>