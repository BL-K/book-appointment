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

    <h1 style="text-align: center;">Danh sách hợp tác</h1>
    <br>
    <table>
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
    <br>
    <div style="margin-right: 60%;">
        <table>
            <tr>
                <th>
                    <ul>Tổng hợp tác</ul>
                </th>
                <th>
                    <ul>{{ $cooperation->count() }}</ul>
                </th>
            </tr>
        </table>
    </div>
</body>

</html>