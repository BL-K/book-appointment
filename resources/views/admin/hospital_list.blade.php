@extends('layouts.admin_app')

@section('content')
    <h1 class="page-title">Danh sách bệnh viện</h1>
    <hr style="height:2px; background-color:gray;">

    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <h3>Danh sách bệnh viện</h3>
                    <a href="{{ URL::to('admin/hospital_export')}}" class="btn btn-outline-success" style="margin-left: 80%; margin-top: -5%; background-color: rgb(14, 161, 71); color: white;">File Excel</a>
                    <a href="{{ URL::to('admin/hospital_report')}}" class="btn btn-outline-success" style="margin-left: 90%; margin-top: -8.2%; background-color: rgb(232, 71, 71); color: white;">File PDF</a>
                </div>
                @include('flash::message')
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <br>
                <form action="" type="get">
                    @csrf
                    <ul class="nav navbar-nav search-nav">
                        <li>
                            <div class="search">
                                <div class="form-group form-animate-text">
                                    <input type="text" id="keyword" name="keyword" class="form-text"
                                        placeholder="Tìm kiếm" required>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <button type="submit" class="btn btn-primary" style="height: 45px"><i
                            class="fas fa-search"></i></button>
                </form>
                <div class="panel-body">
                    <div class="responsive-table">
                        <table id="datatable" class="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Bệnh viện</th>
                                    <th>Địa chỉ Email</th>
                                    <th>Hoạt động</th>
                                </tr>
                            </thead>
                            @foreach ($user as $user_list)
                                <tbody>
                                    <tr>
                                        <td>{{ $user_list->name }}</td>
                                        <td>{{ $user_list->email }}</td>
                                        <td>
                                            <a href="{{ URL::to('admin/hospital_view/' . $user_list->id) }}"
                                                class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                                            <a href="{{ URL::to('admin/hospital_edit/' . $user_list->id) }}"
                                                class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                            <a onclick="return confirm('Bạn có muốn xóa {{$user_list->name}}?');"
                                            href="{{ URL::to('admin/delete_user/' . $user_list->id) }}"
                                            class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>                                   
                                </tbody>
                            @endforeach
                            <tfoot>
                                <tr>
                                    <th>Bệnh viện</th>
                                    <th>Địa chỉ Email</th>
                                    <th>Hoạt động</th>
                                </tr>
                            </tfoot>
                        </table>
                        <br>
                        <div class="">
                            {{ $user->appends(request()->all())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
