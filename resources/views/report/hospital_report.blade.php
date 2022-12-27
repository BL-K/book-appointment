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

    <h1 style="text-align: center;">Danh sách bệnh viện</h1>
    <br>
    <table>
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
    <br>
    <div style="margin-right: 60%;">
        <table>
            <tr>
                <th>
                    <ul>Tổng bệnh viện</ul>
                </th>
                <th>
                    <ul>{{ $hospital->count() }}</ul>
                </th>
            </tr>
        </table>
    </div>
</body>

</html>