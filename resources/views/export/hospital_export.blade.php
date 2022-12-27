<table id="datatable" class="table" style="width:100%">
    <thead>
        <tr>
            <th>Bệnh viện</th>
            <th>Số điện thoại</th>
            <th>Địa chỉ Email</th>
            <th>Địa chỉ Url</th>
            <th>Địa chỉ</th>
            <th>Tỉnh/Thành phố</th>
        </tr>
    </thead>
    @foreach ($hospital as $hos_list)
        <tbody>
            <tr>
                <td>{{ $hos_list->hospital_name }}</td>
                <td>{{ $hos_list->hospital_contact }}</td>
                <td>{{ $hos_list->hospital_email }}</td>
                <td>{{ $hos_list->hospital_url }}</td>
                <td>{{ $hos_list->hospital_address }}</td>
                <td>{{ $hos_list->hospital_city }}</td>
            </tr>
        </tbody>
    @endforeach
</table>