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

    <h1 style="text-align: center;">Danh sách bác sĩ</h1>
    <br>
    <h3>{{ $user->name }}</h3>
    <br>
    <table>
        <thead>
            <tr>
                <th>Bác sĩ</th>
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
    <br>
    <div style="margin-right: 60%;">
        <table>
            <tr>
                <th>
                    <ul>Tổng bác sĩ</ul>
                </th>
                <th>
                    <ul>{{ $doctor->count() }}</ul>
                </th>
            </tr>
        </table>
    </div>
</body>

</html>