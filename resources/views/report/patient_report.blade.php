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

    <h1 style="text-align: center;">Danh sách bệnh nhân</h1>
    <br>
    <h3>{{ $user->name }}</h3>
    <br>
    <table>
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
    <br>
    <div style="margin-right: 60%;">
        <table>
            <tr>
                <th>
                    <ul>Tổng bệnh nhân</ul>
                </th>
                <th>
                    <ul>{{ $patient->count() }}</ul>
                </th>
            </tr>
        </table>
    </div>
</body>

</html>