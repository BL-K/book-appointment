@extends('layouts.patient_app')

@section('content')
    <section class="section">
        <div class="container-fluid">
            <div class="banner-wrapper">
                <div class="banner-header text-center">
                    <h1 style="margin-top: 100px;">Vui lòng nhập Email của bạn</h1>
                    <br>
                    <form action="" type="get">
                        @csrf
                        <ul class="nav navbar-nav search-nav">
                            <li>
                                <div class="search">
                                    <input type="text" id="patient_email" name="patient_email" class="form-control"
                                        placeholder="Tìm kiếm" required style="width: 45%;  margin-left: 19%;">
                                    <button type="submit" class="btn btn-primary"
                                        style="margin-top: -70px; margin-left: 40.5%; height: 44px; width: 45px;"><i
                                            class="fas fa-search"></i></button>
                                </div>
                            </li>
                        </ul>
                    </form>
                    <table id="datatable" class="table" style="width:100%">
                        <thead>
                            <tr>
                                <th>Họ và tên</th>
                                <th>Địa chỉ Email</th>
                            </tr>
                        </thead>
                        @foreach ($patient as $pat_list)
                            <tbody>
                                <tr>
                                    <td>{{ $pat_list->patient_name }}</td>
                                    <td>{{ $pat_list->patient_email }}</td>
                                    <td>
                                        <a
                                            href="{{ URL::to('history_appointment', ['patient_email' => $pat_list->patient_email]) }}">
                                            <button class="btn btn-secondary">Lịch sử đật lịch</button>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
